-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 02-Maio-2022 às 16:07
-- Versão do servidor: 5.7.36
-- versão do PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `pesquisa`
--
DROP DATABASE IF EXISTS `pesquisa`;
CREATE DATABASE IF NOT EXISTS `pesquisa` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `pesquisa`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `obsmensal`
--

DROP TABLE IF EXISTS `obsmensal`;
CREATE TABLE IF NOT EXISTS `obsmensal` (
  `obsano` smallint(4) NOT NULL COMMENT 'ano',
  `obsmes` tinyint(2) NOT NULL COMMENT 'mes',
  `qtAcolhimento` text COLLATE utf8_unicode_ci COMMENT 'observacao setor acolhimento',
  `qtCohi` text COLLATE utf8_unicode_ci COMMENT 'observacao setor cohi',
  `qtMedica` text COLLATE utf8_unicode_ci COMMENT 'observacao setor equipe medica',
  `qtEnfermagem` text COLLATE utf8_unicode_ci COMMENT 'observacao setor enfermagem',
  `qtLaboratorio` text COLLATE utf8_unicode_ci COMMENT 'observacao setor laboratorio',
  `qtFisioterapia` text COLLATE utf8_unicode_ci COMMENT 'observacao setor fisioterapia',
  `qtFonoaudiologia` text COLLATE utf8_unicode_ci COMMENT 'observacao setor fonoaudiologia',
  `qtPsicologia` text COLLATE utf8_unicode_ci COMMENT 'observacao setor psicologia',
  `qtSocial` text COLLATE utf8_unicode_ci COMMENT 'observacao setor servico social',
  `qtNutricao` text COLLATE utf8_unicode_ci COMMENT 'observacao setor nutricao',
  `qtCasa` text COLLATE utf8_unicode_ci COMMENT 'observacao setor casa de apoio',
  `qtCpr` text COLLATE utf8_unicode_ci COMMENT 'observacao setor cpr',
  `qtHigienizacao` text COLLATE utf8_unicode_ci COMMENT 'observacao setor higienizacao',
  `qtBrinquedotca` text COLLATE utf8_unicode_ci COMMENT 'observacao setor brinquedoteca',
  `qtPedagogia` text COLLATE utf8_unicode_ci COMMENT 'observacao setor pedagogia',
  `qtManutencao` text COLLATE utf8_unicode_ci COMMENT 'observacao setor manutencao',
  `qtPatrimonio` text COLLATE utf8_unicode_ci COMMENT 'observacao setor patrimonio',
  `qtPesquisa` text COLLATE utf8_unicode_ci COMMENT 'observacao setor pesquisa'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='observações que são exibidas no relatório mensal pdf';

-- --------------------------------------------------------

--
-- Estrutura da tabela `questionario`
--

DROP TABLE IF EXISTS `questionario`;
CREATE TABLE IF NOT EXISTS `questionario` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id de registro',
  `registro` mediumint(9) NOT NULL COMMENT 'registro do paciente',
  `nomePaciente` varchar(200) COLLATE utf8_unicode_ci NOT NULL COMMENT 'nome do paciente',
  `genero` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'genero do paciente',
  `municipio` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'municipio do paciente',
  `setor` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'setor de internacao',
  `leito` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'leito do paciente',
  `diasInternado` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'quantidade de dias internado',
  `dtRegistro` datetime NOT NULL COMMENT 'data realizada a pesquisa',
  `qtAcolhimento` tinyint(1) NOT NULL COMMENT 'resposta setor acolhimento',
  `qtCohi` tinyint(1) NOT NULL COMMENT 'resposta setor cohi',
  `qtMedica` tinyint(1) NOT NULL COMMENT 'resposta setor equipe medica',
  `qtEnfermagem` tinyint(1) NOT NULL COMMENT 'resposta setor equipe enfermagem',
  `qtLaboratorio` tinyint(1) NOT NULL COMMENT 'resposta setor laboratorio',
  `qtFisioterapia` tinyint(1) NOT NULL COMMENT 'resposta setor fisioterapia',
  `qtFonoaudiologia` tinyint(1) NOT NULL COMMENT 'resposta setor fonoaudiologia',
  `qtPsicologia` tinyint(1) NOT NULL COMMENT 'resposta setor psicologia',
  `qtSocial` tinyint(1) NOT NULL COMMENT 'resposta setor servico social',
  `qtNutricao` tinyint(1) NOT NULL COMMENT 'resposta setor nutricao',
  `qtCasa` tinyint(1) NOT NULL COMMENT 'resposta setor casa de apoio',
  `qtCpr` tinyint(1) NOT NULL COMMENT 'resposta setor cpr',
  `qtHigienizacao` tinyint(1) NOT NULL COMMENT 'resposta setor higienizacao',
  `qtBrinquedotca` tinyint(1) NOT NULL COMMENT 'resposta setor brinquedoteca',
  `qtPedagogia` tinyint(1) NOT NULL COMMENT 'resposta setor pegagogia',
  `qtManutencao` tinyint(1) NOT NULL COMMENT 'resposta setor manutencao',
  `qtPatrimonio` tinyint(1) NOT NULL COMMENT 'resposta setor patrimonio',
  `qtPesquisa` tinyint(1) NOT NULL COMMENT 'resposta setor pesquisa',
  `observacao` text COLLATE utf8_unicode_ci COMMENT 'resposta da observacao',
  `obsqtAcolhimento` text COLLATE utf8_unicode_ci COMMENT 'observacao setor acolhimento',
  `obsqtCohi` text COLLATE utf8_unicode_ci COMMENT 'observacao setor cohi',
  `obsqtMedica` text COLLATE utf8_unicode_ci COMMENT 'observacao setor medica',
  `obsqtEnfermagem` text COLLATE utf8_unicode_ci COMMENT 'observacao setor enfermagem',
  `obsqtLaboratorio` text COLLATE utf8_unicode_ci COMMENT 'observacao setor laboratorio',
  `obsqtFisioterapia` text COLLATE utf8_unicode_ci COMMENT 'observacao setor fisioterapia',
  `obsqtFonoaudiologia` text COLLATE utf8_unicode_ci COMMENT 'observacao setor fonoaudiologia',
  `obsqtPsicologia` text COLLATE utf8_unicode_ci COMMENT 'observacao setor psicologia',
  `obsqtSocial` text COLLATE utf8_unicode_ci COMMENT 'observacao setor social',
  `obsqtNutricao` text COLLATE utf8_unicode_ci COMMENT 'observacao setor nutricao',
  `obsqtCasa` text COLLATE utf8_unicode_ci COMMENT 'observacao setor casa de apoio',
  `obsqtCpr` text COLLATE utf8_unicode_ci COMMENT 'observacao setor cpr',
  `obsqtHigienizacao` text COLLATE utf8_unicode_ci COMMENT 'observacao setor higienizacao',
  `obsqtBrinquedotca` text COLLATE utf8_unicode_ci COMMENT 'observacao setor brinquedoteca',
  `obsqtPedagogia` text COLLATE utf8_unicode_ci COMMENT 'observacao setor pedagogia',
  `obsqtManutencao` text COLLATE utf8_unicode_ci COMMENT 'observacao setor manutencao',
  `obsqtPatrimonio` text COLLATE utf8_unicode_ci COMMENT 'observacao setor patrimonio',
  `obsqtPesquisa` text COLLATE utf8_unicode_ci COMMENT 'observacao setor pesquisa',
  `dtAtualizacao` datetime DEFAULT NULL COMMENT 'data que foi atualizado a pesquisa',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='respostas da pesquisa de satisfacao';

--
-- Acionadores `questionario`
--
DROP TRIGGER IF EXISTS `questionario_after_insert`;
DELIMITER $$
CREATE TRIGGER `questionario_after_insert` AFTER INSERT ON `questionario` FOR EACH ROW BEGIN 

	IF NOT EXISTS ( SELECT * FROM obsmensal WHERE obsmes = month(NOW()) AND obsano = year(NOW()) ) THEN
		INSERT INTO obsmensal VALUES (year(NOW()), month(NOW()), NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
	END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `respostas`
--

DROP TABLE IF EXISTS `respostas`;
CREATE TABLE IF NOT EXISTS `respostas` (
  `codigo` tinyint(4) NOT NULL,
  `questao` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='respostas das questoes';

--
-- Extraindo dados da tabela `respostas`
--

INSERT INTO `respostas` (`codigo`, `questao`) VALUES
(1, 'Ótimo'),
(2, 'Bom'),
(3, 'Regular'),
(4, 'Ruim'),
(5, 'Péssimo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `setores`
--

DROP TABLE IF EXISTS `setores`;
CREATE TABLE IF NOT EXISTS `setores` (
  `codigo` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'codigo do setor',
  `setor` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'descricao do setor',
  `responsavel` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'responsavel do setor',
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'email do setor'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='informações sobre os setores';
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
