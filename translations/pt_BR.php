<?php

// Setores do questionário (colocar em uma tabela no banco?)
define("SETORES", ['qtAcolhimento' => 'Acolhimento', 'qtCohi' => 'Centro de Onco-Hematologia Infantil (COHI)', 'qtMedica' => 'Equipe Médica', 'qtEnfermagem' => 'Equipe de Enfermagem', 
                    'qtLaboratorio' => 'Laboratório', 'qtFisioterapia' => 'Fisioterapia', 'qtFonoaudiologia' => 'Fonoaudiologia', 'qtPsicologia' => 'Psicologia', 
                    'qtSocial' => 'Serviço Social', 'qtNutricao' => 'Nutrição', 'qtCasa' => 'Casa de Apoio Nazinha Lamartine', 'qtCpr' => 'Centro de Processamento de Roupas', 
                    'qtHigienizacao' => 'Higienização', 'qtBrinquedotca' => 'Brinquedoteca', 'qtPedagogia' => 'Pedagogia em Classe Hospitalar', 'qtManutencao' => 'Manutenção', 
                    'qtPatrimonio' => 'Patrimônio', 'qtPesquisa' => 'Pesquisa de Satisfação']);

// colunas referente aos campos de observações de cada questão                    
define("SETORES_OBS", ['qtAcolhimento' => 'obsqtAcolhimento', 'qtCohi' => 'obsqtCohi', 'qtMedica' => 'obsqtMedica', 'qtEnfermagem' => 'obsqtEnfermagem', 
                    'qtLaboratorio' => 'obsqtLaboratorio', 'qtFisioterapia' => 'obsqtFisioterapia', 'qtFonoaudiologia' => 'obsqtFonoaudiologia', 'qtPsicologia' => 'obsqtPsicologia', 
                    'qtSocial' => 'obsqtSocial', 'qtNutricao' => 'obsqtNutricao', 'qtCasa' => 'obsqtCasa', 'qtCpr' => 'obsqtCpr', 
                    'qtHigienizacao' => 'obsqtHigienizacao', 'qtBrinquedotca' => 'obsqtBrinquedotca', 'qtPedagogia' => 'obsqtPedagogia', 'qtManutencao' => 'obsqtManutencao'
                    , 'qtPatrimonio' => 'obsqtPatrimonio', 'qtPesquisa' => 'obsqtPesquisa']);

// classes
define("PACIENTE_NAO_INTERNADO", "Esse paciente não está internado");
define("REGISTRO_INVALIDO", "Esse registro do paciente é inválido");
define("PESQUISA_CADASTRADA", "Pesquisa de satisfação cadastrada");
define("PESQUISA_NA0_CADASTRADA", "Não foi possível cadastrar a pesquisa");
define("ID_PESQUISA_NAO_ENCONTRADO", "Pesquisa de satisfação não encontrada");
define("ID_PESQUISA_INVALIDO", "Essa pesquisa é inválida");
define("PESQUISA_ALTERADA", "Pesquisa de satisfação alterada");
define("PESQUISA_NAO_ALTERADA", "Não foi possível alterar a pesquisa");
define("PESQUISA_EXCLUIDA", "Pesquisa de satisfação excluída");
define("PESQUISA_NAO_EXCLUIDA", "Não foi possível excluir a pesquisa");
define("OBSERVACAO_ATUALIZADA", "Observação atualizada com sucesso");
define("OBSERVACAO_NAO_ATUALIZADA", "Erro ao atualizar observação");
define("SETORES_ATUALIZADOS", "Setores atualizados");
define("SETORES_NAO_ATUALIZADOS", "Nenhum setor foi atualizado");
define("NAO_HOUVE_COMENTARIOS", "Não houve comentário ou sugestão dos entrevistados referente a esse setor.");

// para não ocorrer erro na hora de gerar o pdf
define("ENDERECO", $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST']."/pesquisa/");