-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 25/05/2025 às 13:24
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
-- Banco de dados: `crud_law`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `genero`
--

CREATE TABLE `genero` (
  `id` int(11) NOT NULL,
  `nome_genero` varchar(50) NOT NULL,
  `corredor` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `genero`
--

INSERT INTO `genero` (`id`, `nome_genero`, `corredor`) VALUES
(1, 'Heavy Metal', 'Corredor 1A'),
(2, 'Prog Rock', 'Corredor 1B'),
(4, 'Texas Blues', 'Corredor 2B');

-- --------------------------------------------------------

--
-- Estrutura para tabela `locacao`
--

CREATE TABLE `locacao` (
  `id` int(11) NOT NULL,
  `data_hora` datetime NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `data_devolucao` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `locacao`
--

INSERT INTO `locacao` (`id`, `data_hora`, `id_cliente`, `data_devolucao`) VALUES
(4, '2025-05-24 16:29:00', 18, '2025-05-31'),
(5, '2025-05-25 07:54:00', 19, '2025-06-01'),
(6, '2025-05-25 08:22:00', 18, '2025-06-01');

-- --------------------------------------------------------

--
-- Estrutura para tabela `vinil`
--

CREATE TABLE `vinil` (
  `id` int(11) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `banda` varchar(50) NOT NULL,
  `id_genero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `vinil`
--

INSERT INTO `vinil` (`id`, `titulo`, `banda`, `id_genero`) VALUES
(1, 'Black Sabbath', 'Black Sabbath', 1),
(2, 'The Dark Side of The Moon', 'Pink Floyd', 2),
(4, 'Couldn\'t Stand The Weather', 'Stevie Ray Voughan', 4);

-- --------------------------------------------------------

--
-- Estrutura para tabela `vinil_locacao`
--

CREATE TABLE `vinil_locacao` (
  `id_vinil` int(11) NOT NULL,
  `id_locacao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `vinil_locacao`
--

INSERT INTO `vinil_locacao` (`id_vinil`, `id_locacao`) VALUES
(4, 5),
(1, 5),
(2, 5),
(1, 4);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `genero`
--
ALTER TABLE `genero`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `locacao`
--
ALTER TABLE `locacao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Índices de tabela `vinil`
--
ALTER TABLE `vinil`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_genero` (`id_genero`);

--
-- Índices de tabela `vinil_locacao`
--
ALTER TABLE `vinil_locacao`
  ADD KEY `vinil_locacao_ibfk_2` (`id_vinil`),
  ADD KEY `vinil_locacao_ibfk_1` (`id_locacao`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `genero`
--
ALTER TABLE `genero`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `locacao`
--
ALTER TABLE `locacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `vinil`
--
ALTER TABLE `vinil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `locacao`
--
ALTER TABLE `locacao`
  ADD CONSTRAINT `locacao_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id`);

--
-- Restrições para tabelas `vinil`
--
ALTER TABLE `vinil`
  ADD CONSTRAINT `vinil_ibfk_1` FOREIGN KEY (`id_genero`) REFERENCES `genero` (`id`);

--
-- Restrições para tabelas `vinil_locacao`
--
ALTER TABLE `vinil_locacao`
  ADD CONSTRAINT `vinil_locacao_ibfk_1` FOREIGN KEY (`id_locacao`) REFERENCES `locacao` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `vinil_locacao_ibfk_2` FOREIGN KEY (`id_vinil`) REFERENCES `vinil` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
