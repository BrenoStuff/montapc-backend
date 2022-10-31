-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 31-Out-2022 às 21:52
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `montapc`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `graphicscards`
--

CREATE TABLE `graphicscards` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  `pciexpress` varchar(5) NOT NULL,
  `price` varchar(10) DEFAULT NULL,
  `image` varchar(400) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `graphicscards`
--

INSERT INTO `graphicscards` (`id`, `name`, `description`, `pciexpress`, `price`, `image`) VALUES
(1, 'graphics test', 'graphiuc descpt', '3.0', '90,00', 'graphic.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `motherboards`
--

CREATE TABLE `motherboards` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  `socket` varchar(10) NOT NULL,
  `typememory` varchar(6) NOT NULL,
  `pciexpress` varchar(5) NOT NULL,
  `price` varchar(10) DEFAULT NULL,
  `image` varchar(400) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `motherboards`
--

INSERT INTO `motherboards` (`id`, `name`, `description`, `socket`, `typememory`, `pciexpress`, `price`, `image`) VALUES
(3, 'motherboard', 'test descip', 'lga2003', 'DDR3', '3.0', '1200,00', 'image.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `processors`
--

CREATE TABLE `processors` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  `socket` varchar(10) NOT NULL,
  `typememory` varchar(6) NOT NULL,
  `pciexpress` varchar(5) NOT NULL,
  `price` varchar(10) NOT NULL,
  `image` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `processors`
--

INSERT INTO `processors` (`id`, `name`, `description`, `socket`, `typememory`, `pciexpress`, `price`, `image`) VALUES
(0, 'processor test', 'processor top descpt', 'LGA113', 'DDR4', '3.0', '500,00', 'processor.png'),
(0, 'processor test', 'processor top descpt', 'LGA113', 'DDR4', '3.0', '500,00', 'processor.png');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `graphicscards`
--
ALTER TABLE `graphicscards`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `motherboards`
--
ALTER TABLE `motherboards`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `graphicscards`
--
ALTER TABLE `graphicscards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `motherboards`
--
ALTER TABLE `motherboards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
