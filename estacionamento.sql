-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 30-Mar-2024 às 19:07
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `estacionamento`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE `categoria` (
  `id_Categoria` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `taxa` float NOT NULL,
  `id_Estacionamento` int(11) NOT NULL,
  `QuantidadeVeiculo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`id_Categoria`, `nome`, `taxa`, `id_Estacionamento`, `QuantidadeVeiculo`) VALUES
(54, 'carro', 4, 20, 50),
(55, 'moto', 4, 20, 50),
(56, 'caminhão', 4, 20, 50),
(57, 'SUV', 7, 20, 12);

-- --------------------------------------------------------

--
-- Estrutura da tabela `estacionamento`
--

CREATE TABLE `estacionamento` (
  `id_Estacionamento` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `estacionamento`
--

INSERT INTO `estacionamento` (`id_Estacionamento`, `nome`, `email`, `senha`) VALUES
(20, 'Estacionamento 1', 'Estacionamento1@gmail.com', 'Estacionamento');

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario`
--

CREATE TABLE `funcionario` (
  `id_Funcionario` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(20) NOT NULL,
  `id_Estacionamento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `funcionario`
--

INSERT INTO `funcionario` (`id_Funcionario`, `nome`, `email`, `senha`, `id_Estacionamento`) VALUES
(6, 'Funcionario', 'Funcionario@gmail.com', 'Funcionario', 20);

-- --------------------------------------------------------

--
-- Estrutura da tabela `veiculo`
--

CREATE TABLE `veiculo` (
  `id_Veiculo` int(11) NOT NULL,
  `placa` varchar(50) NOT NULL,
  `id_Categoria` int(11) NOT NULL,
  `entrada` datetime DEFAULT NULL,
  `saida` datetime DEFAULT NULL,
  `id_Funcionario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `veiculo`
--

INSERT INTO `veiculo` (`id_Veiculo`, `placa`, `id_Categoria`, `entrada`, `saida`, `id_Funcionario`) VALUES
(86, '33535', 54, '2024-03-30 15:01:00', '2024-03-30 15:01:00', NULL),
(87, '4747', 56, '2024-03-30 15:01:00', NULL, NULL),
(88, '132324', 55, '2024-03-30 15:01:00', NULL, NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_Categoria`),
  ADD KEY `fk_ID_estacionamento` (`id_Estacionamento`);

--
-- Índices para tabela `estacionamento`
--
ALTER TABLE `estacionamento`
  ADD PRIMARY KEY (`id_Estacionamento`);

--
-- Índices para tabela `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`id_Funcionario`),
  ADD KEY `fk2_ID_estacionamento` (`id_Estacionamento`);

--
-- Índices para tabela `veiculo`
--
ALTER TABLE `veiculo`
  ADD PRIMARY KEY (`id_Veiculo`),
  ADD KEY `fk_ID_categoria` (`id_Categoria`),
  ADD KEY `fk_ID_funcionario` (`id_Funcionario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_Categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT de tabela `estacionamento`
--
ALTER TABLE `estacionamento`
  MODIFY `id_Estacionamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `funcionario`
--
ALTER TABLE `funcionario`
  MODIFY `id_Funcionario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `veiculo`
--
ALTER TABLE `veiculo`
  MODIFY `id_Veiculo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `categoria`
--
ALTER TABLE `categoria`
  ADD CONSTRAINT `fk_ID_estacionamento` FOREIGN KEY (`id_Estacionamento`) REFERENCES `estacionamento` (`id_Estacionamento`);

--
-- Limitadores para a tabela `funcionario`
--
ALTER TABLE `funcionario`
  ADD CONSTRAINT `fk2_ID_estacionamento` FOREIGN KEY (`id_Estacionamento`) REFERENCES `estacionamento` (`id_Estacionamento`);

--
-- Limitadores para a tabela `veiculo`
--
ALTER TABLE `veiculo`
  ADD CONSTRAINT `fk_ID_categoria` FOREIGN KEY (`id_Categoria`) REFERENCES `categoria` (`id_Categoria`),
  ADD CONSTRAINT `fk_ID_funcionario` FOREIGN KEY (`id_Funcionario`) REFERENCES `funcionario` (`id_Funcionario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
