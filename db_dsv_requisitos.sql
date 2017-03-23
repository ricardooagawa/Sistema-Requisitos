-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 23-Mar-2017 às 20:31
-- Versão do servidor: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_dsv_requisitos`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_bas_funcionalidade`
--

CREATE TABLE IF NOT EXISTS `tb_bas_funcionalidade` (
  `cod_funcionalidade` int(11) NOT NULL AUTO_INCREMENT,
  `des_funcionalidade` varchar(255) DEFAULT NULL,
  `flg_ativo` char(1) DEFAULT 'S',
  PRIMARY KEY (`cod_funcionalidade`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Extraindo dados da tabela `tb_bas_funcionalidade`
--

INSERT INTO `tb_bas_funcionalidade` (`cod_funcionalidade`, `des_funcionalidade`, `flg_ativo`) VALUES
(1, 'Perfil', 'S'),
(2, 'Usuários', 'S'),
(3, 'Projeto', 'S'),
(4, 'Requisitos', 'S'),
(5, 'Assunto - Requisitos', 'S');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_bas_funcionalidade_acao`
--

CREATE TABLE IF NOT EXISTS `tb_bas_funcionalidade_acao` (
  `cod_funcionalidade_acao` int(11) NOT NULL AUTO_INCREMENT,
  `cod_funcionalidade` int(11) DEFAULT NULL,
  `cod_acao` char(1) DEFAULT NULL,
  PRIMARY KEY (`cod_funcionalidade_acao`),
  KEY `cod_funcionalidade` (`cod_funcionalidade`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Extraindo dados da tabela `tb_bas_funcionalidade_acao`
--

INSERT INTO `tb_bas_funcionalidade_acao` (`cod_funcionalidade_acao`, `cod_funcionalidade`, `cod_acao`) VALUES
(1, 1, 'I'),
(2, 1, 'A'),
(3, 1, 'L'),
(4, 1, 'E'),
(5, 1, 'V'),
(6, 2, 'I'),
(7, 2, 'A'),
(8, 2, 'L'),
(9, 2, 'E'),
(10, 2, 'V'),
(11, 3, 'I'),
(12, 3, 'A'),
(13, 3, 'L'),
(14, 3, 'E'),
(15, 3, 'V'),
(17, 4, 'L'),
(18, 4, 'R'),
(19, 5, 'I'),
(20, 5, 'A'),
(21, 5, 'L'),
(22, 5, 'E'),
(23, 5, 'V');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_cad_assunto`
--

CREATE TABLE IF NOT EXISTS `tb_cad_assunto` (
  `cod_assunto` bigint(20) NOT NULL AUTO_INCREMENT,
  `cod_projeto` int(11) DEFAULT NULL,
  `des_assunto` varchar(5000) DEFAULT NULL,
  `des_descricao` varchar(5000) DEFAULT NULL,
  `dat_inicio` timestamp NULL DEFAULT NULL,
  `dat_termino` timestamp NULL DEFAULT NULL,
  `dat_cadastro` timestamp NULL DEFAULT NULL,
  `cod_id_usuario` int(11) DEFAULT NULL,
  `dat_atualizacao` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`cod_assunto`),
  KEY `FK_tb_cad_assunto_tb_cad_projeto` (`cod_projeto`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `tb_cad_assunto`
--

INSERT INTO `tb_cad_assunto` (`cod_assunto`, `cod_projeto`, `des_assunto`, `des_descricao`, `dat_inicio`, `dat_termino`, `dat_cadastro`, `cod_id_usuario`, `dat_atualizacao`) VALUES
(1, 1, 'INT.1 - Ônibus', 'O que você sabe do ônibus?', '2015-12-20 11:24:08', '2016-01-01 12:24:11', '2015-12-29 12:24:49', 1, '2015-12-29 12:24:54');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_cad_assunto_topico`
--

CREATE TABLE IF NOT EXISTS `tb_cad_assunto_topico` (
  `cod_assunto_topico` bigint(20) NOT NULL AUTO_INCREMENT,
  `cod_assunto` bigint(20) DEFAULT NULL,
  `des_topico` varchar(5000) DEFAULT NULL,
  `cod_id_usuario` int(11) DEFAULT NULL,
  `dat_atualizacao` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`cod_assunto_topico`),
  KEY `FK_tb_cad_assunto_topico_tb_cad_assunto` (`cod_assunto`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `tb_cad_assunto_topico`
--

INSERT INTO `tb_cad_assunto_topico` (`cod_assunto_topico`, `cod_assunto`, `des_topico`, `cod_id_usuario`, `dat_atualizacao`) VALUES
(1, 1, 'Descreva tudo que você sabe sobre ônibus?\r\n', 1, '2015-12-29 14:35:19'),
(2, 1, 'Quais são os problemas do ônibus?\r\n', 1, '2015-12-29 14:35:19'),
(3, 1, 'Quais são as melhorias que você deseja para o ônibus?\r\n', 1, '2015-12-29 14:35:19');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_cad_log`
--

CREATE TABLE IF NOT EXISTS `tb_cad_log` (
  `cod_log` bigint(20) NOT NULL AUTO_INCREMENT,
  `des_funcionalidade` varchar(255) DEFAULT NULL,
  `des_log` varchar(5000) DEFAULT NULL,
  `des_ip` varchar(20) DEFAULT NULL,
  `cod_usuario` int(11) DEFAULT NULL,
  `dat_atualizacao` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`cod_log`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Extraindo dados da tabela `tb_cad_log`
--

INSERT INTO `tb_cad_log` (`cod_log`, `des_funcionalidade`, `des_log`, `des_ip`, `cod_usuario`, `dat_atualizacao`) VALUES
(1, 'Login', 'Usuário ''ricardo'' logou no sistema', '::1', 3, '2017-03-23 22:26:00'),
(2, 'Perfil de Acesso', 'Usuário ''Ricardo Ogawa'' alterou o Perfil de Acesso ''Usuário Chave''', '::1', 3, '2017-03-23 22:33:00'),
(3, 'Perfil de Acesso', 'Usuário ''Ricardo Ogawa'' visualizou o Perfil de Acesso ''Usuário Chave''', '::1', 3, '2017-03-23 22:33:00'),
(4, 'Perfil de Acesso', 'Usuário ''Ricardo Ogawa'' visualizou o Perfil de Acesso ''Usuário Chave''', '::1', 3, '2017-03-23 22:33:00'),
(5, 'Perfil de Acesso', 'Usuário ''Ricardo Ogawa'' incluiu o Perfil de Acesso ''teste''', '::1', 3, '2017-03-23 22:34:00'),
(6, 'Perfil de Acesso', 'Usuário ''Ricardo Ogawa'' visualizou o Perfil de Acesso ''teste''', '::1', 3, '2017-03-23 22:34:00'),
(7, 'Projeto', 'Usuário ''Ricardo Ogawa'' alterou o projeto ''Consultoria e Desenvolvimeno''', '::1', 3, '2017-03-23 22:48:00'),
(8, 'Projeto', 'Usuário ''Ricardo Ogawa'' visualizou o projeto ''Consultoria e Desenvolvimeno''', '::1', 3, '2017-03-23 22:48:00'),
(9, 'Perfil de Acesso', 'Usuário ''Ricardo Ogawa'' visualizou o Perfil de Acesso ''Administrador''', '::1', 3, '2017-03-23 23:04:00'),
(10, 'Projeto', 'Usuário ''Ricardo Ogawa'' visualizou o projeto ''Consultoria e Desenvolvimeno''', '::1', 3, '2017-03-23 23:05:00'),
(11, 'Projeto', 'Usuário ''Ricardo Ogawa'' visualizou o projeto ''Consultoria e Desenvolvimeno''', '::1', 3, '2017-03-23 23:07:00'),
(12, 'Usuário', 'Usuário ''Ricardo Ogawa'' visualizou o usuário ''Teste''', '::1', 3, '2017-03-23 23:09:00'),
(13, 'Usuário', 'Usuário ''Ricardo Ogawa'' visualizou o usuário ''Teste''', '::1', 3, '2017-03-23 23:10:00'),
(14, 'Usuário', 'Usuário ''Ricardo Ogawa'' visualizou o usuário ''Teste''', '::1', 3, '2017-03-23 23:10:00'),
(15, 'Usuário', 'Usuário ''Ricardo Ogawa'' visualizou o usuário ''Teste''', '::1', 3, '2017-03-23 23:11:00'),
(16, 'Login', 'O Usuário ''Ricardo Ogawa'' saiu do sistema.', '::1', 3, '2017-03-23 23:11:00'),
(17, 'Login', 'Usuário ''ricardo'' logou no sistema', '::1', 3, '2017-03-23 23:13:00'),
(18, 'Login', 'Usuário ''ricardo'' logou no sistema', '::1', 3, '2017-03-23 23:26:00'),
(19, 'Login', 'Tentativa de Login para o usuário ''ricardoogawa'' teve os seguintes erros ', '::1', NULL, '2017-03-23 23:29:00'),
(20, 'Login', 'Usuário ''ricardo'' logou no sistema', '::1', 3, '2017-03-23 23:30:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_cad_parametro`
--

CREATE TABLE IF NOT EXISTS `tb_cad_parametro` (
  `cod_parametro` int(11) NOT NULL AUTO_INCREMENT,
  `des_parametro` varchar(50) DEFAULT NULL,
  `des_sigla` char(3) DEFAULT NULL,
  `val_parametro` varchar(255) DEFAULT NULL,
  `val_ordem` int(11) DEFAULT NULL,
  `cod_usuario` int(11) DEFAULT NULL,
  `dat_atualizacao` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`cod_parametro`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_cad_perfil`
--

CREATE TABLE IF NOT EXISTS `tb_cad_perfil` (
  `cod_perfil` int(11) NOT NULL AUTO_INCREMENT,
  `des_perfil` varchar(50) DEFAULT NULL,
  `cod_usuario` int(11) DEFAULT NULL,
  `dat_atualizacao` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`cod_perfil`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Extraindo dados da tabela `tb_cad_perfil`
--

INSERT INTO `tb_cad_perfil` (`cod_perfil`, `des_perfil`, `cod_usuario`, `dat_atualizacao`) VALUES
(1, 'Administrador', 1, '2015-12-29 13:47:00'),
(2, 'Usuário Chave', 3, '2017-03-23 22:33:00'),
(5, 'teste', 3, '2017-03-23 22:34:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_cad_perfil_funcionalidade`
--

CREATE TABLE IF NOT EXISTS `tb_cad_perfil_funcionalidade` (
  `cod_perfil_funcionalidade` int(11) NOT NULL AUTO_INCREMENT,
  `cod_perfil` int(11) DEFAULT NULL,
  `cod_funcionalidade_acao` int(11) DEFAULT NULL,
  PRIMARY KEY (`cod_perfil_funcionalidade`),
  KEY `cod_perfil` (`cod_perfil`),
  KEY `cod_funcionalidade_acao` (`cod_funcionalidade_acao`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=136 ;

--
-- Extraindo dados da tabela `tb_cad_perfil_funcionalidade`
--

INSERT INTO `tb_cad_perfil_funcionalidade` (`cod_perfil_funcionalidade`, `cod_perfil`, `cod_funcionalidade_acao`) VALUES
(26, 1, 1),
(27, 1, 2),
(28, 1, 3),
(29, 1, 4),
(30, 1, 5),
(31, 1, 6),
(32, 1, 7),
(33, 1, 8),
(34, 1, 9),
(35, 1, 10),
(36, 1, 11),
(37, 1, 12),
(38, 1, 13),
(39, 1, 14),
(40, 1, 15),
(41, 1, 17),
(42, 1, 18),
(112, 2, 17),
(113, 2, 18),
(114, 5, 1),
(115, 5, 2),
(116, 5, 3),
(117, 5, 4),
(118, 5, 5),
(119, 5, 6),
(120, 5, 7),
(121, 5, 8),
(122, 5, 9),
(123, 5, 10),
(124, 5, 11),
(125, 5, 12),
(126, 5, 13),
(127, 5, 14),
(128, 5, 15),
(129, 5, 17),
(130, 5, 18),
(131, 5, 19),
(132, 5, 20),
(133, 5, 21),
(134, 5, 22),
(135, 5, 23);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_cad_projeto`
--

CREATE TABLE IF NOT EXISTS `tb_cad_projeto` (
  `cod_projeto` int(11) NOT NULL AUTO_INCREMENT,
  `des_projeto` varchar(80) DEFAULT NULL,
  `flg_ativo` char(1) DEFAULT 'S',
  `cod_id_usuario` int(11) DEFAULT NULL,
  `dat_atualizacao` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`cod_projeto`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `tb_cad_projeto`
--

INSERT INTO `tb_cad_projeto` (`cod_projeto`, `des_projeto`, `flg_ativo`, `cod_id_usuario`, `dat_atualizacao`) VALUES
(1, 'Consultoria e Desenvolvimeno', 'S', 3, '2017-03-23 22:48:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_cad_resposta`
--

CREATE TABLE IF NOT EXISTS `tb_cad_resposta` (
  `cod_resposta` bigint(20) NOT NULL AUTO_INCREMENT,
  `cod_assunto` bigint(20) DEFAULT NULL,
  `cod_usuario` int(11) DEFAULT NULL,
  `cod_id_usuario` int(11) DEFAULT NULL,
  `dat_atualizacao` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`cod_resposta`),
  KEY `FK_tb_cad_resposta_tb_cad_assunto` (`cod_assunto`),
  KEY `FK_tb_cad_resposta_tb_cad_usuario` (`cod_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `tb_cad_resposta`
--

INSERT INTO `tb_cad_resposta` (`cod_resposta`, `cod_assunto`, `cod_usuario`, `cod_id_usuario`, `dat_atualizacao`) VALUES
(1, 1, 1, 1, '2015-12-30 12:46:00'),
(2, 1, 3, 3, '2015-12-30 16:44:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_cad_resposta_topico`
--

CREATE TABLE IF NOT EXISTS `tb_cad_resposta_topico` (
  `cod_resposta_topico` bigint(20) NOT NULL AUTO_INCREMENT,
  `cod_resposta` bigint(20) DEFAULT NULL,
  `cod_assunto_topico` bigint(20) DEFAULT NULL,
  `des_resposta_topico` varchar(5000) DEFAULT NULL,
  `cod_id_usuario` int(11) DEFAULT NULL,
  `dat_atualizacao` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`cod_resposta_topico`),
  KEY `FK_tb_cad_resposta_topico_tb_cad_resposta` (`cod_resposta`),
  KEY `FK_tb_cad_resposta_topico_tb_cad_assunto_topico` (`cod_assunto_topico`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Extraindo dados da tabela `tb_cad_resposta_topico`
--

INSERT INTO `tb_cad_resposta_topico` (`cod_resposta_topico`, `cod_resposta`, `cod_assunto_topico`, `des_resposta_topico`, `cod_id_usuario`, `dat_atualizacao`) VALUES
(1, 1, 1, '<p>teste dedo duro&nbsp;</p>', 1, '2015-12-30 12:46:00'),
(5, 1, 2, '<p>teste 2</p>', 1, '2015-12-30 12:45:00'),
(6, 2, 1, '<p>teste Ricardo 30/12 1</p>', 3, '2015-12-30 16:44:00'),
(7, 2, 2, '<p><span style="line-height:20.8px">teste Ricardo 30/12 2</span></p>', 3, '2015-12-30 16:44:00'),
(8, 2, 3, '<p><span style="line-height:20.8px">teste Ricardo 30/12 3</span></p>', 3, '2015-12-30 16:44:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_cad_usuario`
--

CREATE TABLE IF NOT EXISTS `tb_cad_usuario` (
  `cod_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `cod_perfil` int(11) DEFAULT NULL,
  `cod_projeto` int(11) DEFAULT NULL,
  `nom_usuario` varchar(255) DEFAULT NULL,
  `des_email` varchar(255) DEFAULT NULL,
  `des_login` varchar(20) NOT NULL,
  `des_senha` varchar(50) DEFAULT NULL,
  `flg_ativo` char(1) DEFAULT 'S',
  `dat_cadastro` timestamp NULL DEFAULT NULL,
  `cod_id_usuario` int(11) DEFAULT NULL,
  `dat_atualizacao` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`cod_usuario`),
  KEY `cod_perfil_fk` (`cod_perfil`),
  KEY `cod_unidade` (`cod_projeto`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `tb_cad_usuario`
--

INSERT INTO `tb_cad_usuario` (`cod_usuario`, `cod_perfil`, `cod_projeto`, `nom_usuario`, `des_email`, `des_login`, `des_senha`, `flg_ativo`, `dat_cadastro`, `cod_id_usuario`, `dat_atualizacao`) VALUES
(1, 1, 1, 'Teste', 'teste@teste.com.br', 'teste', '1234', 'S', '2015-12-28 17:10:50', 1, '2015-12-29 10:28:00'),
(3, 1, 1, 'Ricardo Ogawa', 'ricardo.ogawa@electra.com.br', 'ricardo', '1234', 'S', '2015-12-30 16:41:00', 1, '2015-12-30 16:41:00');

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `tb_bas_funcionalidade_acao`
--
ALTER TABLE `tb_bas_funcionalidade_acao`
  ADD CONSTRAINT `cod_funcionalidade` FOREIGN KEY (`cod_funcionalidade`) REFERENCES `tb_bas_funcionalidade` (`cod_funcionalidade`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `tb_cad_assunto`
--
ALTER TABLE `tb_cad_assunto`
  ADD CONSTRAINT `FK_tb_cad_assunto_tb_cad_projeto` FOREIGN KEY (`cod_projeto`) REFERENCES `tb_cad_projeto` (`cod_projeto`) ON DELETE NO ACTION;

--
-- Limitadores para a tabela `tb_cad_assunto_topico`
--
ALTER TABLE `tb_cad_assunto_topico`
  ADD CONSTRAINT `FK_tb_cad_assunto_topico_tb_cad_assunto` FOREIGN KEY (`cod_assunto`) REFERENCES `tb_cad_assunto` (`cod_assunto`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `tb_cad_perfil_funcionalidade`
--
ALTER TABLE `tb_cad_perfil_funcionalidade`
  ADD CONSTRAINT `cod_funcionalidade_acao` FOREIGN KEY (`cod_funcionalidade_acao`) REFERENCES `tb_bas_funcionalidade_acao` (`cod_funcionalidade_acao`) ON DELETE CASCADE,
  ADD CONSTRAINT `cod_perfil` FOREIGN KEY (`cod_perfil`) REFERENCES `tb_cad_perfil` (`cod_perfil`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `tb_cad_resposta`
--
ALTER TABLE `tb_cad_resposta`
  ADD CONSTRAINT `FK_tb_cad_resposta_tb_cad_assunto` FOREIGN KEY (`cod_assunto`) REFERENCES `tb_cad_assunto` (`cod_assunto`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_tb_cad_resposta_tb_cad_usuario` FOREIGN KEY (`cod_usuario`) REFERENCES `tb_cad_usuario` (`cod_usuario`) ON DELETE NO ACTION;

--
-- Limitadores para a tabela `tb_cad_resposta_topico`
--
ALTER TABLE `tb_cad_resposta_topico`
  ADD CONSTRAINT `FK_tb_cad_resposta_topico_tb_cad_assunto_topico` FOREIGN KEY (`cod_assunto_topico`) REFERENCES `tb_cad_assunto_topico` (`cod_assunto_topico`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_tb_cad_resposta_topico_tb_cad_resposta` FOREIGN KEY (`cod_resposta`) REFERENCES `tb_cad_resposta` (`cod_resposta`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `tb_cad_usuario`
--
ALTER TABLE `tb_cad_usuario`
  ADD CONSTRAINT `cod_perfil_fk` FOREIGN KEY (`cod_perfil`) REFERENCES `tb_cad_perfil` (`cod_perfil`),
  ADD CONSTRAINT `cod_projeto` FOREIGN KEY (`cod_projeto`) REFERENCES `tb_cad_projeto` (`cod_projeto`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
