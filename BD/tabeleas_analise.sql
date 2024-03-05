-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 26/01/2024 às 07:45
-- Versão do servidor: 8.0.35-0ubuntu0.20.04.1
-- Versão do PHP: 7.4.3-4ubuntu2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `Estoque_prod`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int NOT NULL,
  `nome` varchar(40) NOT NULL,
  `codigo` varchar(5) NOT NULL,
  `lead_time` int DEFAULT NULL,
  `qtde` int DEFAULT NULL,
  `funcionario` varchar(30) NOT NULL,
  `descricao` varchar(80) DEFAULT NULL,
  `frequencia` enum('diario','semanal','mensal','trimestral','semestral','anual') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT 'diario',
  `data` date NOT NULL,
  `unidade` enum('un','mg','g','kg','cm','m','ml','l') NOT NULL DEFAULT 'un',
  `valor_venda` double DEFAULT NULL,
  `valor_producao` double DEFAULT NULL,
  `maximo` int NOT NULL,
  `minimo` int NOT NULL,
  `observacao` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `codigo`, `lead_time`, `qtde`, `funcionario`, `descricao`, `frequencia`, `data`, `unidade`, `valor_venda`, `valor_producao`, `maximo`, `minimo`, `observacao`) VALUES
(1, 'Pão', '001', 20, 10, 'Antonio', 'Pão de leite', 'semanal', '2024-01-25', 'un', 0.5, 0.1, 20, 10, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos_movimentacoes`
--

CREATE TABLE `produtos_movimentacoes` (
  `id` int NOT NULL,
  `produto_id` int NOT NULL,
  `tipo` enum('entrada','saida','troca','devolucao','outros') NOT NULL DEFAULT 'entrada',
  `responsavel` varchar(30) NOT NULL,
  `cliente` varchar(30) DEFAULT NULL,
  `qtde` int NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Despejando dados para a tabela `produtos_movimentacoes`
--

INSERT INTO `produtos_movimentacoes` (`id`, `produto_id`, `tipo`, `responsavel`, `cliente`, `qtde`, `data`) VALUES
(1, 1, 'entrada', 'Camila', 'Jeniffer', 10, '2024-01-25');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `produtos_movimentacoes`
--
ALTER TABLE `produtos_movimentacoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_produtos_movimentacoes_produtos` (`produto_id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `produtos_movimentacoes`
--
ALTER TABLE `produtos_movimentacoes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `produtos_movimentacoes`
--
ALTER TABLE `produtos_movimentacoes`
  ADD CONSTRAINT `fk_produtos_movimentacoes_produtos` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
