<?php

class NovaPesquisa extends Conexao
{
    public $usuario_encontrado;

    public function __construct()
    {

        $this->usuario_encontrado = true;

        // paciente selecionado na tela inicial
        if (isset($_GET['registro_paciente'])) {
            $this->consultaPaciente($_GET['registro_paciente']);

        // cadastra a pesquisa
        } elseif (isset($_POST['cadastrar'])) {
            $this->cadastrarPesquisa($_POST);

        // editar a pesquisa selecionada
        } elseif (isset($_GET['idRegistro']) && isset($_POST['editar'])) {
            $this->editarPesquisa($_POST);

        // exibir a pesquisa selecionada
        } elseif (isset($_GET['idRegistro'])) {
            $this->exibirPesquisa($_GET['idRegistro']);

        // excluir a pesquisa selecionada
        } elseif (isset($_POST['id_pesquisa_excluir']) && isset($_POST['excluir'])) {
            $this->excluirPesquisa($_POST['id_pesquisa_excluir']);
        
        } else {
            $this->usuario_encontrado = false;
        }

        
    }

    // consulta o paciente no banco Sql
    private function consultaPaciente($registro_paciente)
    {
        // se existir conexão com o bd
        if (parent::__construct()) {

            // verifica se o registro é inteiro
            if (filter_var($registro_paciente, FILTER_VALIDATE_INT)) {

                // busca os dados do paciente no banco Sql
                $query_paciente = $this->db_connection->prepare("SELECT TOP 1 PAC_REG, PAC_NOME, CASE PAC_SEXO WHEN 'F' THEN 'FEMININO' ELSE 'MASCULINO' END AS SEXO, STR_NOME, LOC_NOME, CDE_NOME, PAC_UF,
                                                            (SELECT TOP 1 DATEDIFF(DAY, HSP_DTHRE, GETDATE()) FROM HSP WHERE HSP_PAC = PAC_REG AND HSP_STAT = 'A' AND HSP_DTHRA IS NULL) AS ENTRADA 
                                                            FROM LOC INNER JOIN PAC ON LOC_PAC = PAC_REG INNER JOIN STR ON LOC_STR = STR_COD 
                                                            LEFT JOIN CDE ON PAC_CID = CDE_COD WHERE PAC_REG = :registro_paciente");
                $query_paciente->bindValue(':registro_paciente', $registro_paciente, PDO::PARAM_INT);
                $query_paciente->execute();

                // verifica se retornou algum paciente
                if ($query_paciente->rowCount()) {   

                    // armazena o resultado como objeto e envia para a classe exibePaciente()
                    $this->exibePaciente($query_paciente->fetchObject());    

                } else {
                    $this->errors[] = PACIENTE_NAO_INTERNADO;
                    $this->usuario_encontrado = false;
                }
            } else {
                $this->errors[] = REGISTRO_INVALIDO;
                $this->usuario_encontrado = false;
            }
        } else {
            $this->usuario_encontrado = false;
        }
    }

    // retorna os dados da consulta no banco com as informações do paciente acima do questionário
    private function exibePaciente($resultado_consulta)
    {
        // se retornou algum valor na consulta
        if ($resultado_consulta) {
            $this->dados_do_paciente = $resultado_consulta;
        } else {
            $this->usuario_encontrado = false;
        }
    }

    // cadastra a pesquisa no banco MySql
    private function cadastrarPesquisa($questoes)
    {

        // se existir conexão com o bd
        if (parent::conexaoMysql()) {

            // dados do paciente
            $registro = $questoes['registro'];
            $nomePaciente = rtrim($questoes['paciente']);
            $genero = $questoes['genero'];
            $municipio = $questoes['municipio'];
            $setor = rtrim($questoes['setor']);
            $leito = rtrim($questoes['leito']);
            $diasInternado = $questoes['internado'];

            // respostas do questionario
            $qtAcolhimento = $questoes['qtAcolhimento'];
            $qtCohi = $questoes['qtCohi'];
            $qtMedica = $questoes['qtMedica'];
            $qtEnfermagem = $questoes['qtEnfermagem'];
            $qtLaboratorio = $questoes['qtLaboratorio'];
            $qtFisioterapia = $questoes['qtFisioterapia'];
            $qtFonoaudiologia = $questoes['qtFonoaudiologia'];
            $qtPsicologia = $questoes['qtPsicologia'];
            $qtSocial = $questoes['qtSocial'];
            $qtNutricao = $questoes['qtNutricao'];
            $qtCasa = $questoes['qtCasa'];
            $qtCpr = $questoes['qtCpr'];
            $qtHigienizacao = $questoes['qtHigienizacao'];
            $qtBrinquedoteca = $questoes['qtBrinquedotca'];
            $qtPedagogia = $questoes['qtPedagogia'];
            $qtManutencao = $questoes['qtManutencao'];
            $qtPatrimonio = $questoes['qtPatrimonio'];
            $qtPesquisa = $questoes['qtPesquisa'];

            #$observacao = filter_var($questoes['observacoes'], FILTER_SANITIZE_ADD_SLASHES); // não utilizado

            // campos de observações de cada questão
            $obsqtAcolhimento = $this->formatarObservacao($questoes['obsqtAcolhimento']);
            $obsqtCohi = $this->formatarObservacao($questoes['obsqtCohi']);
            $obsqtMedica = $this->formatarObservacao($questoes['obsqtMedica']);
            $obsqtEnfermagem = $this->formatarObservacao($questoes['obsqtEnfermagem']);
            $obsqtLaboratorio = $this->formatarObservacao($questoes['obsqtLaboratorio']);
            $obsqtFisioterapia = $this->formatarObservacao($questoes['obsqtFisioterapia']);
            $obsqtFonoaudiologia = $this->formatarObservacao($questoes['obsqtFonoaudiologia']);
            $obsqtPsicologia = $this->formatarObservacao($questoes['obsqtPsicologia']);
            $obsqtSocial = $this->formatarObservacao($questoes['obsqtSocial']);
            $obsqtNutricao = $this->formatarObservacao($questoes['obsqtNutricao']);
            $obsqtCasa = $this->formatarObservacao($questoes['obsqtCasa']);
            $obsqtCpr = $this->formatarObservacao($questoes['obsqtCpr']);
            $obsqtHigienizacao = $this->formatarObservacao($questoes['obsqtHigienizacao']);
            $obsqtBrinquedoteca = $this->formatarObservacao($questoes['obsqtBrinquedotca']);
            $obsqtPedagogia = $this->formatarObservacao($questoes['obsqtPedagogia']);
            $obsqtManutencao = $this->formatarObservacao($questoes['obsqtManutencao']);
            $obsqtPatrimonio = $this->formatarObservacao($questoes['obsqtPatrimonio']);
            $obsqtPesquisa = $this->formatarObservacao($questoes['obsqtPesquisa']);

            // gravando questionario no banco
            $query_new_registro = $this->db_mysql->prepare("INSERT INTO `questionario` (`id`, `registro`, `nomePaciente`, `genero`, `municipio`, `setor`, `leito`, `diasInternado`, `dtRegistro`, `qtAcolhimento`, 
                                                        `qtCohi`, `qtMedica`, `qtEnfermagem`, `qtLaboratorio`, `qtFisioterapia`, `qtFonoaudiologia`, `qtPsicologia`, `qtSocial`, `qtNutricao`, `qtCasa`, `qtCpr`, `qtHigienizacao`, `qtBrinquedotca`, `qtPedagogia`, `qtManutencao`, `qtPatrimonio`, `qtPesquisa`, `obsqtAcolhimento`, `obsqtCohi`, `obsqtMedica`, `obsqtEnfermagem`, `obsqtLaboratorio`, `obsqtFisioterapia`, `obsqtFonoaudiologia`, `obsqtPsicologia`, `obsqtSocial`, `obsqtNutricao`, `obsqtCasa`, `obsqtCpr`, `obsqtHigienizacao`, `obsqtBrinquedotca`, `obsqtPedagogia`, `obsqtManutencao`, `obsqtPatrimonio`, `obsqtPesquisa`, `dtAtualizacao`) VALUES (NULL, '$registro', '$nomePaciente', '$genero', '$municipio', '$setor', '$leito', '$diasInternado', NOW(), '$qtAcolhimento', '$qtCohi', '$qtMedica', '$qtEnfermagem', '$qtLaboratorio', '$qtFisioterapia', '$qtFonoaudiologia', '$qtPsicologia', '$qtSocial', '$qtNutricao', '$qtCasa', '$qtCpr', '$qtHigienizacao', '$qtBrinquedoteca', '$qtPedagogia', '$qtManutencao', '$qtPatrimonio', '$qtPesquisa', $obsqtAcolhimento, $obsqtCohi, $obsqtMedica, $obsqtEnfermagem, $obsqtLaboratorio, $obsqtFisioterapia, $obsqtFonoaudiologia, $obsqtPsicologia, $obsqtSocial, $obsqtNutricao, $obsqtCasa, $obsqtCpr, $obsqtHigienizacao, $obsqtBrinquedoteca, $obsqtPedagogia, $obsqtManutencao, $obsqtPatrimonio, $obsqtPesquisa, NULL);");
            $query_new_registro->execute();

            // verifica se afetou alguma linha
            if ($query_new_registro->rowCount()) {
                $this->messages[] = PESQUISA_CADASTRADA;
            } else {
                $this->errors[] = PESQUISA_NA0_CADASTRADA;
            }
        }
    }    

    // exibir a pesquisa selecionada para editar ou excluir
    private function exibirPesquisa($id_registro)
    {
        // verifica se o registro é inteiro
        if (filter_var($id_registro, FILTER_VALIDATE_INT)) {

            // se existir conexão com o bd
            if (parent::conexaoMysql()) {

                // busca os dados do paciente no banco smart
                $query_questionario = $this->db_mysql->prepare("SELECT * FROM questionario WHERE id = :id_registro_pesquisa LIMIT 1");
                $query_questionario->bindValue(':id_registro_pesquisa', $id_registro, PDO::PARAM_INT);
                $query_questionario->execute();

                // verifica se afetou alguma linha
                if ($query_questionario->rowCount()) {
                    // armazena o resultado como objeto
                    $this->exibePaciente = $query_questionario->fetchObject();
                } else {
                    $this->errors[] = ID_PESQUISA_NAO_ENCONTRADO;
                    $this->usuario_encontrado = false;
                }
            }
        } else {
            $this->errors[] = ID_PESQUISA_INVALIDO;
            $this->usuario_encontrado = false;
        }
    }

    // edita as questões da pesquisa
    private function editarPesquisa($questoes)
    {

        if (parent::conexaoMysql()) {
            
            // id da pesquisa
            $id_pesquisa = $questoes['id_pesquisa'];
            
            // respostas do questionario
            $qtAcolhimento = $questoes['qtAcolhimento'];
            $qtCohi = $questoes['qtCohi'];
            $qtMedica = $questoes['qtMedica'];
            $qtEnfermagem = $questoes['qtEnfermagem'];
            $qtLaboratorio = $questoes['qtLaboratorio'];
            $qtFisioterapia = $questoes['qtFisioterapia'];
            $qtFonoaudiologia = $questoes['qtFonoaudiologia'];
            $qtPsicologia = $questoes['qtPsicologia'];
            $qtSocial = $questoes['qtSocial'];
            $qtNutricao = $questoes['qtNutricao'];
            $qtCasa = $questoes['qtCasa'];
            $qtCpr = $questoes['qtCpr'];
            $qtHigienizacao = $questoes['qtHigienizacao'];
            $qtBrinquedoteca = $questoes['qtBrinquedotca'];
            $qtPedagogia = $questoes['qtPedagogia'];
            $qtManutencao = $questoes['qtManutencao'];
            $qtPatrimonio = $questoes['qtPatrimonio'];
            $qtPesquisa = $questoes['qtPesquisa'];

            #$observacao = filter_var($questoes['observacoes'], FILTER_SANITIZE_ADD_SLASHES); // não utilizado

            // campos de observações de cada questão
            $obsqtAcolhimento = $this->formatarObservacao($questoes['obsqtAcolhimento']);
            $obsqtCohi = $this->formatarObservacao($questoes['obsqtCohi']);
            $obsqtMedica = $this->formatarObservacao($questoes['obsqtMedica']);
            $obsqtEnfermagem = $this->formatarObservacao($questoes['obsqtEnfermagem']);
            $obsqtLaboratorio = $this->formatarObservacao($questoes['obsqtLaboratorio']);
            $obsqtFisioterapia = $this->formatarObservacao($questoes['obsqtFisioterapia']);
            $obsqtFonoaudiologia = $this->formatarObservacao($questoes['obsqtFonoaudiologia']);
            $obsqtPsicologia = $this->formatarObservacao($questoes['obsqtPsicologia']);
            $obsqtSocial = $this->formatarObservacao($questoes['obsqtSocial']);
            $obsqtNutricao = $this->formatarObservacao($questoes['obsqtNutricao']);
            $obsqtCasa = $this->formatarObservacao($questoes['obsqtCasa']);
            $obsqtCpr = $this->formatarObservacao($questoes['obsqtCpr']);
            $obsqtHigienizacao = $this->formatarObservacao($questoes['obsqtHigienizacao']);
            $obsqtBrinquedoteca = $this->formatarObservacao($questoes['obsqtBrinquedotca']);
            $obsqtPedagogia = $this->formatarObservacao($questoes['obsqtPedagogia']);
            $obsqtManutencao = $this->formatarObservacao($questoes['obsqtManutencao']);
            $obsqtPatrimonio = $this->formatarObservacao($questoes['obsqtPatrimonio']);
            $obsqtPesquisa = $this->formatarObservacao($questoes['obsqtPesquisa']);


            // gravando novo ativo no banco
            $query_update_registro = $this->db_mysql->prepare("UPDATE `questionario` SET `qtAcolhimento` = '$qtAcolhimento', `qtCohi` = '$qtCohi', `qtMedica` = '$qtMedica', `qtEnfermagem` = '$qtEnfermagem', 
                                                            `qtLaboratorio` = '$qtLaboratorio', `qtFisioterapia` = '$qtFisioterapia', `qtFonoaudiologia` = '$qtFonoaudiologia', `qtPsicologia` = '$qtPsicologia', 
                                                            `qtSocial` = '$qtSocial', `qtNutricao` = '$qtNutricao', `qtCasa` = '$qtCasa', `qtCpr` = '$qtCpr', `qtHigienizacao` = '$qtHigienizacao', 
                                                            `qtBrinquedotca` = '$qtBrinquedoteca', `qtPedagogia` = '$qtPedagogia', `qtManutencao` = '$qtManutencao', `qtPatrimonio` = '$qtPatrimonio', 
                                                            `qtPesquisa` = '$qtPesquisa', `obsqtAcolhimento` = $obsqtAcolhimento, `obsqtCohi` = $obsqtCohi, `obsqtMedica` = $obsqtMedica, 
                                                            `obsqtEnfermagem` = $obsqtEnfermagem, `obsqtLaboratorio` = $obsqtLaboratorio, `obsqtFisioterapia` = $obsqtFisioterapia, 
                                                            `obsqtFonoaudiologia` = $obsqtFonoaudiologia, `obsqtPsicologia` = $obsqtPsicologia, `obsqtSocial` = $obsqtSocial, `obsqtNutricao` = $obsqtNutricao, 
                                                            `obsqtCasa` = $obsqtCasa, `obsqtCpr` = $obsqtCpr, `obsqtHigienizacao` = $obsqtHigienizacao, `obsqtBrinquedotca` = $obsqtBrinquedoteca, 
                                                            `obsqtPedagogia` = $obsqtPedagogia, `obsqtManutencao` = $obsqtManutencao, `obsqtPatrimonio` = $obsqtPatrimonio, `obsqtPesquisa` = $obsqtPesquisa, 
                                                            `dtAtualizacao` = NOW() WHERE id = $id_pesquisa;");
            $query_update_registro->execute();

            // verifica se teve linha modificada
            if ($query_update_registro->rowCount()) {
                $this->messages[] = PESQUISA_ALTERADA;
            } else {
                $this->errors[] = PESQUISA_NAO_ALTERADA;
            }

            // retorna os dados na tela
            $this->exibirPesquisa($questoes['id_pesquisa']);            
        }
    }

    // exclui a pesquisa no banco MySql
    private function excluirPesquisa($id_registro)
    {
        if (parent::conexaoMysql()) {

            // busca os dados do paciente no banco smart
            $query_delete = $this->db_mysql->prepare("DELETE FROM questionario WHERE id = :id_registro_excluir");
            $query_delete->bindValue(':id_registro_excluir', $id_registro, PDO::PARAM_INT);
            $query_delete->execute();

            // verifica se teve linha modificada
            if ($query_delete->rowCount()) {
                $this->messages[] = PESQUISA_EXCLUIDA;
            } else {
                $this->errors[] = PESQUISA_NAO_EXCLUIDA;
            }
        }
    }

    // formata os campos observações de cada questão
    private function formatarObservacao($variavelx)
    {
        // ajusta adicionando barras a uma string devido aspas e barras
        $aspas = filter_var($variavelx, FILTER_SANITIZE_ADD_SLASHES);
        
        return !empty($aspas) ? "'$aspas'" : "NULL";
    }
}
