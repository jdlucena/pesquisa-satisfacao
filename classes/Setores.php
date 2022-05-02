<?php

class Setores extends Conexao
{

    private $cont = 0;

    public function __construct()
    {
        if (isset($_POST['enviarSetores'])) {
            $this->atualizarSetores();
        } else {
            $this->exibirSetores();
        }
        
    }

    private function exibirSetores()
    {
        // se existir conexão com o banco MySQL
        if (parent::conexaoMysql()) {

            // consulta os setores cadastrados
            $query_consulta_setores = $this->db_mysql->prepare("SELECT * FROM setores");
            $query_consulta_setores->execute();
            
            // verifica se retornou algum valor
            if ($query_consulta_setores->rowCount()) {
                
                // armazena o resultado como objeto
                while ($res_consulta_setores = $query_consulta_setores->fetchObject()) {
                    $this->result_consulta_setores[] = $res_consulta_setores;
                }
            } else {
                $this->errors[] = "Nenhum resultado encontrado";
            }
            
        }
    }
    
    private function atualizarSetores()
    {
        // se existir conexão com o banco MySQL
        if (parent::conexaoMysql()) {

            // lista os setores da constante SETORES
            foreach (SETORES as $key => $value) {

                // organiza os inputs
                $novosetor = "setor".$key;
                $novoresp = "resp".$key;
                $novoemail = "email".$key;
                
                // armazena os valores do POST
                $setor = $_POST[$novosetor];
                $responsavel = $_POST[$novoresp];
                $email = $_POST[$novoemail];                
            
                // atualizando setores no banco
                $query_new_registro = $this->db_mysql->prepare("UPDATE `setores` SET `setor` = '$setor', `responsavel` = '$responsavel', `email` = '$email' WHERE codigo = '$key';");
                $query_new_registro->execute();

                if ($query_new_registro->rowCount()) {
                    $this->cont++;
                }
            }

            // verifica se afetou alguma linha
            if ($this->cont > 0) {
                $this->messages[] = SETORES_ATUALIZADOS;
            } else {
                $this->errors[] = SETORES_NAO_ATUALIZADOS;
            }

        }
        
        // função para exibir os setores
        $this->exibirSetores();
    }

}
