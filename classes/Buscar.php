<?php

class Buscar extends Conexao
{
    public $dtinicial, $dtfinal;

    public function __construct()
    {
        $this->dtinicial = $_POST['dtinicio'] ?? date('Y-m-d');
        $this->dtfinal = $_POST['dtfim'] ?? date('Y-m-d');

        if (isset($_GET['periodo']) && $_GET['periodo'] == 'hoje') {
            
            $this->buscarPesquisas(date('Y-m-d'), date('Y-m-d'));
            
        } elseif (isset($_GET['periodo']) && $_GET['periodo'] == 'ontem') {
            
            $this->buscarPesquisas(date('Y-m-d', strtotime("-1 days")), date('Y-m-d', strtotime("-1 days")));

        } elseif (isset($_GET['periodo']) && $_GET['periodo'] == 'ultimaSemana') {

            $this->buscarPesquisas(date('Y-m-d', strtotime("-6 days")), date('Y-m-d'));

        } elseif (isset($_POST['dtinicio']) && isset($_POST['dtfim'])) {
            
            $this->buscarPesquisas($_POST['dtinicio'], $_POST['dtfim']);
        } else {
            $this->retornoPadrao();
        }
    }

    private function buscarPesquisas($inicio, $fim)
    {
        // se existir conexão com o banco MySQL
        if (parent::conexaoMysql()) {

            // se data for válida
            if ($this->validateDate($inicio) && $this->validateDate($fim)) {

                // consulta pesquisas no período informado
                $query_consulta_pesquisa = $this->db_mysql->prepare("SELECT id, nomePaciente, leito, setor, date_format(dtRegistro, '%d%/%m%/%y %H%:%i') dtRegistro FROM questionario 
                                                                    WHERE date_format(dtRegistro, '%Y%-%m%-%d') BETWEEN :dataInicio AND :dataFim ORDER BY id");
                $query_consulta_pesquisa->bindValue(':dataInicio', $inicio, PDO::PARAM_STR);
                $query_consulta_pesquisa->bindValue(':dataFim', $fim, PDO::PARAM_STR);
                $query_consulta_pesquisa->execute();
                
                // verifica se retornou algum valor
                if ($query_consulta_pesquisa->rowCount()) {
                    
                    // armazena o resultado como objeto
                    while ($res_consulta_pesquisa = $query_consulta_pesquisa->fetchObject()) {
                        $this->result_consulta_pesquisa[] = $res_consulta_pesquisa;
                    }
                } else {
                    $this->retornoPadrao();                    
                    $this->errors[] = "Nenhum resultado encontrado";
                }
                
                $this->dtinicial = $inicio;
                $this->dtfinal = $fim;
            }
        }
    }

    private function retornoPadrao()
    {
        return $this->result_consulta_pesquisa[] = (object) ['id' => '', 'nomePaciente' => '', 'leito' => '', 'setor' => '', 'dtRegistro' => ''];
    }

    // função para validar data
    private function validateDate($date, $format = 'Y-m-d')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }
}
