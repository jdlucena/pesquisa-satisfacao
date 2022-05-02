<?php

class Dashboard extends Conexao
{

    public $usuario_encontrado;
    public $exibir = false;

    public function __construct()
    {
        // tela dashboard
        if ($_SERVER['PHP_SELF'] == '/pesquisa/dashboard.php') {
            
            // quantidade de pesquisas nos ultimos 6 meses (grafico linha)
            $this->quantidadePesquisaMes();

            // ultimas 20 pesquisas realizadas
            $this->ultimasPesquisas();
        
        // exibe as pesquisas realizadas de acordo com o mês e ano selecionado
        } elseif(isset($_GET['year']) && isset($_GET['month'])) {
            // consulta os dados para o gráfico
            $this->resultPesquisaMes($_GET['year'], $_GET['month']);

            // consulta as observações dos setores
            $this->resultPesquisaMesObservacoes($_GET['year'], $_GET['month']);

            // atualiza a observação final do setor para o relatório PDF
            if (isset($_POST['editarObs']) && isset($_POST['observacaoFinal'])) {
                $this->atualizaObservacaoRelatorioMensalPDF($_GET['year'], $_GET['month'], $_POST['setor'], $_POST['observacaoFinal']);
            }

            $this->usuario_encontrado = true;
        
        // tela relatório mensal
        } elseif ($_SERVER['PHP_SELF'] == '/pesquisa/reportMensal.php') {
            
            // lista os anos que tem pesquisas
            $this->obterAno();

            $this->usuario_encontrado = true;
        }
        
        
    }

    // quantidade de pesquisas nos últimos 6 meses (grafico linha)
    private function quantidadePesquisaMes()
    {
        // se existir conexão com o banco MySQL
        if (parent::conexaoMysql()) {

            // consulta para gerar o gráfico dos últimos 6 meses (gráfico linha)
            $query_consulta_mes = $this->db_mysql->prepare("SELECT date_format(dtRegistro, '%Y%m') AS anomes, date_format(dtRegistro, '%M') mensal, count(*) AS quantidade FROM questionario 
                                                            GROUP BY date_format(dtRegistro, '%Y%m') ORDER BY anomes DESC limit 6");
            $query_consulta_mes->execute();

            // armazena o resultado como objeto
            while($res_consulta_mes = $query_consulta_mes->fetchObject()){
                $this->result_consulta_mes[] = $res_consulta_mes;
            }
        }
    }

    // ultimas 20 pesquisas realizadas
    private function ultimasPesquisas()
    {
        // se existir conexão com o banco MySQL
        if (parent::conexaoMysql()) {

            // consulta as últimas 20 pesquisas por ordem de envio
            $query_ultimas = $this->db_mysql->prepare("SELECT id, nomePaciente, leito, setor, date_format(dtRegistro, '%d%/%m%/%y %H%:%i') dtRegistro FROM questionario ORDER BY id DESC LIMIT 20");
            $query_ultimas->execute();

            // armazena o resultado como objeto
            while($res_ultimas = $query_ultimas->fetchObject()){
                $this->result_questionario[] = $res_ultimas;
            }
        }
    }

    // lista os anos que tem pesquisa cadastrada
    private function obterAno()
    {
        // se existir conexão com o banco MySQL
        if (parent::conexaoMysql()) {

            // consulta para listar os anos na tela Relatório > Mensal
            $query_ano = $this->db_mysql->prepare("SELECT date_format(dtRegistro, '%Y') as ano, count(*) as quantidade from questionario group by date_format(dtRegistro, '%Y') order by ano desc");
            $query_ano->execute();

            // armazena o resultado como objeto
            while($res_ano = $query_ano->fetchObject()){
                $this->result_ano[] = $res_ano;
            }
        }
    }

    // Gráfico: resultado da pesquisa no mês e ano selecionado
    private function resultPesquisaMes($year, $month)
    {
        // se existir conexão com o banco MySQL
        if (parent::conexaoMysql()) {

            // consulta a quantidade de questões respondidas de cada setor (Ótimo, Bom, ...)
            $query_result_pesquisa = $this->db_mysql->prepare("SELECT codigo, questao,
                                                        ( SELECT count(*) FROM questionario WHERE qtAcolhimento = codigo AND month(dtRegistro) = '$month' AND year(dtRegistro) = '$year' ) AS qtAcolhimento,
                                                        ( SELECT count(*) FROM questionario WHERE qtCohi = codigo AND month(dtRegistro) = '$month' AND year(dtRegistro) = '$year' ) AS qtCohi,
                                                        ( SELECT count(*) FROM questionario WHERE qtMedica = codigo AND month(dtRegistro) = '$month' AND year(dtRegistro) = '$year' ) AS qtMedica,
                                                        ( SELECT count(*) FROM questionario WHERE qtEnfermagem = codigo AND month(dtRegistro) = '$month' AND year(dtRegistro) = '$year' ) AS qtEnfermagem,
                                                        ( SELECT count(*) FROM questionario WHERE qtLaboratorio = codigo AND month(dtRegistro) = '$month' AND year(dtRegistro) = '$year' ) AS qtLaboratorio,
                                                        ( SELECT count(*) FROM questionario WHERE qtFisioterapia = codigo AND month(dtRegistro) = '$month' AND year(dtRegistro) = '$year' ) AS qtFisioterapia,
                                                        ( SELECT count(*) FROM questionario WHERE qtFonoaudiologia = codigo AND month(dtRegistro) = '$month' AND year(dtRegistro) = '$year' ) AS qtFonoaudiologia,
                                                        ( SELECT count(*) FROM questionario WHERE qtPsicologia = codigo AND month(dtRegistro) = '$month' AND year(dtRegistro) = '$year' ) AS qtPsicologia,
                                                        ( SELECT count(*) FROM questionario WHERE qtSocial = codigo AND month(dtRegistro) = '$month' AND year(dtRegistro) = '$year' ) AS qtSocial,
                                                        ( SELECT count(*) FROM questionario WHERE qtNutricao = codigo AND month(dtRegistro) = '$month' AND year(dtRegistro) = '$year' ) AS qtNutricao,
                                                        ( SELECT count(*) FROM questionario WHERE qtCasa = codigo AND month(dtRegistro) = '$month' AND year(dtRegistro) = '$year' ) AS qtCasa,
                                                        ( SELECT count(*) FROM questionario WHERE qtCpr = codigo AND month(dtRegistro) = '$month' AND year(dtRegistro) = '$year' ) AS qtCpr,
                                                        ( SELECT count(*) FROM questionario WHERE qtHigienizacao = codigo AND month(dtRegistro) = '$month' AND year(dtRegistro) = '$year' ) AS qtHigienizacao,
                                                        ( SELECT count(*) FROM questionario WHERE qtBrinquedotca = codigo AND month(dtRegistro) = '$month' AND year(dtRegistro) = '$year' ) AS qtBrinquedotca,
                                                        ( SELECT count(*) FROM questionario WHERE qtPedagogia = codigo AND month(dtRegistro) = '$month' AND year(dtRegistro) = '$year' ) AS qtPedagogia,
                                                        ( SELECT count(*) FROM questionario WHERE qtManutencao = codigo AND month(dtRegistro) = '$month' AND year(dtRegistro) = '$year' ) AS qtManutencao, 
                                                        ( SELECT count(*) FROM questionario WHERE qtPatrimonio = codigo AND month(dtRegistro) = '$month' AND year(dtRegistro) = '$year' ) AS qtPatrimonio, 
                                                        ( SELECT count(*) FROM questionario WHERE qtPesquisa = codigo AND month(dtRegistro) = '$month' AND year(dtRegistro) = '$year' ) AS qtPesquisa 
                                                        FROM respostas");
            $query_result_pesquisa->execute();

            // armazena o resultado como objeto
            while($res_pesquisa = $query_result_pesquisa->fetchObject()){
                $this->result_pesquisa[] = $res_pesquisa;
            }

            // permite exibir a tela reportMensalResultado.php
            $this->exibir = true;
        }
    }

    // Observações: resultado da pesquisa no mês e ano selecionado 
    private function resultPesquisaMesObservacoes($year, $month)
    {
        // se existir conexão com o banco MySQL
        if (parent::conexaoMysql()) {

            // consulta as observações de cada setor
            $query_result_pesquisa_obs = $this->db_mysql->prepare("SELECT id, obsqtAcolhimento, obsqtCohi, obsqtMedica, obsqtEnfermagem, obsqtLaboratorio, obsqtFisioterapia, obsqtFonoaudiologia, 
                                                                obsqtPedagogia, obsqtPsicologia, obsqtSocial, obsqtNutricao, obsqtCasa, obsqtCpr, obsqtHigienizacao, obsqtBrinquedotca, obsqtPedagogia, 
                                                                obsqtManutencao, obsqtPatrimonio, obsqtPesquisa FROM questionario WHERE year(dtRegistro) = :year AND month(dtRegistro) = :month");
            
            $query_result_pesquisa_obs->bindValue(':year', $year, PDO::PARAM_INT);
            $query_result_pesquisa_obs->bindValue(':month', $month, PDO::PARAM_INT);
            $query_result_pesquisa_obs->execute();
            
            // armazena o resultado como objeto
            while($res_pesquisa_obs = $query_result_pesquisa_obs->fetchObject()){
                $this->result_pesquisa_obs[] = $res_pesquisa_obs;
            }

            // permite exibir a tela reportMensalResultado.php
            $this->exibir = true;
        }
    }

    // Observações finais para relatório mensal PDF
    public function observacaoRelatorioMensalPDF($year, $month, $setor)
    {
        // se existir conexão com o banco MySQL
        if (parent::conexaoMysql()) {

            // consulta as observações de cada setor
            $query_result_obspdf = $this->db_mysql->prepare("SELECT * FROM obsmensal WHERE obsano = :year AND obsmes = :month LIMIT 1");            
            $query_result_obspdf->bindValue(':year', $year, PDO::PARAM_INT);
            $query_result_obspdf->bindValue(':month', $month, PDO::PARAM_INT);
            $query_result_obspdf->execute();
            
            // armazena o resultado como objeto
            $res_obspdf = $query_result_obspdf->fetchObject();
            
            // retorna o campo do setor selecionado
            return stripcslashes($res_obspdf->$setor);
        }
    }

    // Atualiza a observação final para relatório mensal PDF
    private function atualizaObservacaoRelatorioMensalPDF($year, $month, $setor, $observacao)
    {
        // se existir conexão com o banco MySQL
        if (parent::conexaoMysql()) {

            $observFinal = $this->formatarObservacao($observacao);

            // atualiza observação final
            $update_result_obspdf = $this->db_mysql->prepare("UPDATE `obsmensal` SET `$setor` = :obsFinal WHERE obsano = :year AND obsmes = :month");            
            $update_result_obspdf->bindValue(':year', $year, PDO::PARAM_INT);
            $update_result_obspdf->bindValue(':month', $month, PDO::PARAM_INT);
            $update_result_obspdf->bindValue(':obsFinal', $observFinal, PDO::PARAM_STR);
            $update_result_obspdf->execute();
            
            // verifica se a linha foi afetada
            if ($update_result_obspdf->rowCount()) {
                $this->messages[] = OBSERVACAO_ATUALIZADA;
            } else {
                $this->errors[] = OBSERVACAO_NAO_ATUALIZADA;
            }
        }
    }

    // lista os meses que tem pesquisa referente ao ano informado
    public function listarMeses($ano)
    {
        // se existir conexão com o banco MySQL
        if (parent::conexaoMysql()) {

            // verifica se a variável é inteiro
            if (filter_var($ano, FILTER_VALIDATE_INT)) {

                $query_comp = $this->db_mysql->prepare("SELECT date_format(dtRegistro, '%Y%m') as competencia, date_format(dtRegistro, '%b') as nomeMes, year(dtRegistro) as ano, month(dtRegistro) as mes, 
                                                        count(*) as quantidade from questionario where year(dtRegistro) = $ano group by date_format(dtRegistro, '%M') order by competencia");
                $query_comp->bindValue(':ano_referencia', $ano, PDO::PARAM_INT);
                $query_comp->execute();

                // armazena o resultado como objeto
                while($resComp = $query_comp->fetchObject()){
                    $this->result_comp[] = $resComp;
                }
            }
        }
    }

    // retorna o mês para o título na tela reportMensalResultado.php
    public function nomeMes($mes){
        $meses = [
            1 => 'janeiro',
            2 => 'fevereiro',
            3 => 'março',
            4 => 'abril',
            5 => 'maio',
            6 => 'junho',
            7 => 'julho',
            8 => 'agosto',
            9 => 'setembro',
            10 => 'outubro',
            11 => 'novembro',
            12 => 'dezembro',
        ];
        
        return $meses[$mes];
    }

    // formata os campos observações de cada questão
    private function formatarObservacao($variavelx)
    {
        // ajusta adicionando barras a uma string devido aspas e barras
        $aspas = filter_var($variavelx, FILTER_SANITIZE_ADD_SLASHES);

        // remove os espaços no começo e fim
        $espacos = trim($aspas);
        
        return !empty($espacos) ? "$espacos" : NULL;
    }
}
