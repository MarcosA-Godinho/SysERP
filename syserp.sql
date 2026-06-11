-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           8.0.30 - MySQL Community Server - GPL
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para syserp
CREATE DATABASE IF NOT EXISTS `syserp` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `syserp`;

-- Copiando estrutura para tabela syserp.funcionarios
CREATE TABLE IF NOT EXISTS `funcionarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `cargo` varchar(50) NOT NULL,
  `salario` decimal(10,2) NOT NULL,
  `data_cadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ativo` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `cpf` (`cpf`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela syserp.funcionarios: ~7 rows (aproximadamente)
INSERT INTO `funcionarios` (`id`, `nome`, `cpf`, `cargo`, `salario`, `data_cadastro`, `ativo`) VALUES
	(4, 'Marcos Aurélio Godinho Corrêa da Silva', '62729693092', 'CEO', 4500.00, '2026-04-07 14:04:40', 0),
	(5, 'Samuel Godoi', '99999999999', 'Diretor de Marketing', 57000.27, '2026-04-08 22:08:51', 1),
	(7, 'Joao das Couves', '12345678910', 'Administrativo', 3000.00, '2026-04-16 20:04:02', 1),
	(8, 'Wagner Junio Cordeiro', '99999999998', 'Professor', 25000.00, '2026-04-23 00:05:58', 0),
	(9, 'teste teste', '21312', 'asdasd', 1231.00, '2026-05-06 22:36:53', 1),
	(10, '3123123', '12222222231', '123123', 321312.00, '2026-05-06 22:37:05', 1),
	(14, 'Pedro', '12312412312', 'Montador', 2500.00, '2026-06-10 23:59:47', 1);

-- Copiando estrutura para tabela syserp.lancamentos
CREATE TABLE IF NOT EXISTS `lancamentos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) NOT NULL,
  `observacao` text,
  `valor` decimal(10,2) NOT NULL,
  `data_emissao` date NOT NULL DEFAULT '2026-04-15',
  `data_vencimento` date NOT NULL,
  `data_pagamento` date DEFAULT NULL,
  `tipo` enum('Pagar','Receber') NOT NULL,
  `status` enum('Pendente','Pago','Recebido') DEFAULT 'Pendente',
  `data_cadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela syserp.lancamentos: ~5 rows (aproximadamente)
INSERT INTO `lancamentos` (`id`, `descricao`, `observacao`, `valor`, `data_emissao`, `data_vencimento`, `data_pagamento`, `tipo`, `status`, `data_cadastro`) VALUES
	(11, 'Venda 01', '', 272.50, '2026-06-10', '2026-06-10', '2026-06-11', 'Receber', 'Recebido', '2026-06-11 00:15:52'),
	(12, 'COMPRA DE PRODUTOS - REVENDA', '', 5250.00, '2026-06-10', '2026-06-10', NULL, 'Pagar', 'Pendente', '2026-06-11 00:17:01'),
	(13, 'Venda 03', '', 8700.00, '2026-06-10', '2026-06-10', NULL, 'Receber', 'Pendente', '2026-06-11 00:17:20'),
	(14, 'Salario', '', 1500.00, '2026-06-10', '2026-06-10', '2026-06-11', 'Pagar', 'Pago', '2026-06-11 00:17:45'),
	(15, 'Venda 10', '', 272.50, '2026-06-10', '2026-06-10', '2026-06-11', 'Receber', 'Recebido', '2026-06-11 00:20:55');

-- Copiando estrutura para tabela syserp.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `login` varchar(50) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `perfil` enum('admin','usuario') DEFAULT 'usuario',
  `ativo` tinyint(1) DEFAULT '1',
  `data_cadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela syserp.usuarios: ~5 rows (aproximadamente)
INSERT INTO `usuarios` (`id`, `nome`, `login`, `senha`, `perfil`, `ativo`, `data_cadastro`) VALUES
	(4, 'Administrador Master', 'admin', '$2y$12$wdimYb3juYPCmdE7VpZajOYpA.vmTilfnFXWy.HmV/rwyYB5J4oku', 'admin', 1, '2026-04-15 23:29:50'),
	(5, 'Thaís da Silva Vieira', 'thais.vieira', '$2y$12$djWkl9xG3VjPutvNBHxu2efFrYhVfIAzr4fJKcTIErnp.WNBy9XFG', 'admin', 1, '2026-04-15 23:35:32'),
	(6, 'Bruno Abreu', 'bruno.galvao', '$2y$12$.sOHbdcPl9QMRtksNUBxaeJDF6KmLalNZSE9odf9aVChqlN2ZKXZ.', 'admin', 1, '2026-04-15 23:35:51'),
	(7, 'Teste Testado', 'teste.testado', '$2y$12$d9/uW4CvjOXX4J111aj7fOrEWzCTcZzrqqbwiuJvSu86uPku6OMce', 'admin', 1, '2026-04-15 23:56:49'),
	(8, 'Samuel Godoi', 'samuel.godoi', '$2y$12$X9248lIOWICmoGqgmHYRVecBufRwddwZ9zyPRGCJ3Jm9i8eU2Lo4i', 'usuario', 1, '2026-06-11 00:03:39');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
