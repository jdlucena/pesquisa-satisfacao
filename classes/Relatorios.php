<?php

class Relatorios extends Conexao
{

    public function __construct()
    {        
        // imprimir relatorio mensal
        if (isset($_GET['month']) && isset($_GET['year']) && isset($_GET['setor'])) {
            $this->impressaoRelatorio($_GET['month'], $_GET['year'], $_GET['setor']);
        }       
    }

    // consulta os dados e envia para gerar o PDF
    private function impressaoRelatorio($month, $year, $sector)
    {
        // se existir conexão com o banco MySQL
        if (parent::conexaoMysql()) {

            // mês, ano e setor selecionado no botão de impressão
            $mes = $month;
            $ano = $year;
            $setor = $sector;

            // cabeçalho do PDF
            $query_result_cabecalho = $this->db_mysql->prepare("SELECT codigo, setor, responsavel, email, 
                                                                UPPER( DATE_FORMAT( CONCAT ('{$ano}', '-', '{$mes}', '-01'), '%M DE %Y' ) ) AS competencia, ( SELECT count({$setor}) FROM questionario 
                                                                WHERE year(dtRegistro) = '{$ano}' AND month(dtRegistro) = '{$mes}' AND {$setor} <> 0 ) AS quantidade, ( SELECT count({$setor}) FROM questionario 
                                                                WHERE year(dtRegistro) = '{$ano}' AND month(dtRegistro) = '{$mes}' ) AS total FROM setores WHERE codigo = '{$setor}'");
            $query_result_cabecalho->execute();

            // armazena o resultado como objeto
            $this->cabecalho = $query_result_cabecalho->fetchObject();
            
            // consulta as questões do gráfico
            $query_result_print = $this->db_mysql->prepare("SELECT codigo, questao,( SELECT count(*) FROM questionario WHERE {$setor} = codigo AND month(dtRegistro) = '{$mes}' AND year(dtRegistro) = '{$ano}' ) 
                                                            AS questoes FROM respostas");
            $query_result_print->execute();

            // armazena o resultado como objeto
            while ($res_print = $query_result_print->fetchObject()) {
                $this->result_print[] = $res_print;
            }

            // Observações finais do setor
            $query_result_observacoes = $this->db_mysql->prepare("SELECT {$setor} AS observacao from obsmensal where obsano = {$ano} and obsmes = {$mes}");
            $query_result_observacoes->execute();

            // armazena o resultado como objeto
            $res_observacoes = $query_result_observacoes->fetchObject();

            // se não houver observações referente ao setor, se for NULL, exibe mensagem padrão 'sem comentários'
            if (!is_null($res_observacoes->observacao)) {

                // armazena observação do setor
                $this->result_observacoes = $res_observacoes->observacao;

            } else {

                // mensagem padrão para setores sem observações
                $this->result_observacoes = NAO_HOUVE_COMENTARIOS;
            }            
        }
    }

}
