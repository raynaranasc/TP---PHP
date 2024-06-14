-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 04/06/2024 às 02:22
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `crud_operation`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `notas`
--

-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `sobrenome` varchar(50) NOT NULL,
  `curso` varchar(50) NOT NULL,
  `nota1` decimal(3,2) DEFAULT NULL,
  `nota2` decimal(3,2) DEFAULT NULL,
  `trabalho` decimal(3,2) DEFAULT NULL,
  `media` decimal(3,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`nome`, `sobrenome`, `curso`, `nota1`, `nota2`, `trabalho`, `media`) VALUES
('Raynara', 'Nascimento', 'Analise e Desenvolvimento de Sistemas', 9.99, 8.00, 8.00, 8.67),
('Carlos', 'Lima', 'Direito', 5, 5, 5, 5),
('Guilherme', 'Soares', 'Analise e Desenvolvimento de Sistemas', 6, 6, 6, 6),
('Lucas', 'Sepriano', 'Analise Desenvolvimento', 7, 7, 7, 7);
