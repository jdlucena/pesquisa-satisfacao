<?php

class PacientesInternados extends Conexao
{
    
    // retorna os pacientes internados, consulta feita no SQL
    public function __construct()
    {
        // se existir conexão com o bd
        if (parent::__construct()) {

            // retorna todos os pacientes internados para a tela selecionarPaciente
            $query_user = $this->db_connection->prepare("SELECT PAC_REG, PAC_NOME, PAC_NOME_MAE, PAC_FONE, STR_NOME, LOC_NOME, '<span class=\"badge bg-danger\">NÃO</span></h6>' AS ENTREVISTA 
                                                        FROM LOC JOIN PAC ON LOC_PAC = PAC_REG JOIN STR ON LOC_STR = STR_COD WHERE LOC_PAC IS NOT NULL AND LOC_STR <> 'CCI' ORDER BY STR_NOME");
            $query_user->execute();

            // armazena o resultado como objeto
            while ($result_row = $query_user->fetchObject()){
                $this->a[] = $result_row;
            }

            // quantidade de pacientes internados
            $this->paciente_internados = $query_user->rowCount();

            // consulta as pesquisas cadastradas no mysql para apontar se já foi entrevistado
            $this->consultaPaciente();
            
        } else {
            return false;
        }
    }

    // consulta os registros dos pacientes que realizaram pesquisa nos últimos 30 dias
    private function consultaPaciente()
    {
        // se existir conexão com o bd
        if (parent::conexaoMysql()) {

            $query_user = $this->db_mysql->prepare('SELECT DISTINCT registro FROM questionario WHERE dtRegistro > DATE_SUB(now(), INTERVAL 30 DAY)');
            $query_user->execute();
            
            $this->registros_count = $query_user->rowCount();
            
            // armazena resultado no objeto
            while ($result_row = $query_user->fetchObject()){
                $this->result_mysql[] = $result_row;
            }

            foreach ($this->result_mysql as $value) {
                $this->registros[] = $value->registro;
            }

        } else {
            $this->usuario_encontrado = false;
        }
    }
}