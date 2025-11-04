-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 04/11/2025 às 01:11
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
-- Banco de dados: `clube_escrita`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `atividades`
--

CREATE TABLE `atividades` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `comentario` text DEFAULT NULL,
  `data_criacao` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `atividades`
--

INSERT INTO `atividades` (`id`, `usuario_id`, `titulo`, `comentario`, `data_criacao`) VALUES
(1, 1, 'Top', 'Top', '2025-11-03 19:48:59'),
(2, 3, 'Revolução dos bichos', 'muito bom', '2025-11-03 21:03:16');

-- --------------------------------------------------------

--
-- Estrutura para tabela `avaliacoes`
--

CREATE TABLE `avaliacoes` (
  `id` int(11) NOT NULL,
  `submissao_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `aprovado` tinyint(1) DEFAULT NULL,
  `comentario` text DEFAULT NULL,
  `data_avaliacao` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `avaliacoes`
--

INSERT INTO `avaliacoes` (`id`, `submissao_id`, `usuario_id`, `aprovado`, `comentario`, `data_avaliacao`) VALUES
(1, 1, 1, 0, 'Não foi salvo corretamente', '2025-11-03 19:48:43'),
(2, 1, 2, 0, 'ok', '2025-11-03 19:49:57'),
(3, 1, 1, 0, 'nao', '2025-11-03 19:51:06'),
(4, 2, 2, 1, 'Muito Bom', '2025-11-03 20:24:20'),
(5, 3, 1, 1, 'Bom', '2025-11-03 20:26:40'),
(6, 3, 1, 1, 'Otimo', '2025-11-03 20:28:58'),
(7, 4, 3, 1, 'ok', '2025-11-03 21:02:58'),
(8, 5, 1, 1, 'Testado', '2025-11-03 21:05:26');

-- --------------------------------------------------------

--
-- Estrutura para tabela `participacoes`
--

CREATE TABLE `participacoes` (
  `id` int(11) NOT NULL,
  `atividade_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `comentario` text DEFAULT NULL,
  `data_participacao` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `participacoes`
--

INSERT INTO `participacoes` (`id`, `atividade_id`, `usuario_id`, `comentario`, `data_participacao`) VALUES
(1, 1, 1, 'Muito Top', '2025-11-03 19:49:09'),
(2, 1, 2, 'ok', '2025-11-03 19:50:10'),
(3, 2, 1, 'ok', '2025-11-03 21:05:38');

-- --------------------------------------------------------

--
-- Estrutura para tabela `submissoes`
--

CREATE TABLE `submissoes` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `observacoes` text DEFAULT NULL,
  `arquivo` varchar(255) NOT NULL,
  `data_submissao` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `submissoes`
--

INSERT INTO `submissoes` (`id`, `usuario_id`, `titulo`, `observacoes`, `arquivo`, `data_submissao`) VALUES
(1, 1, '1984', 'Livro muito bom ', '6909304fbf0c5.pdf', '2025-11-03 19:44:31'),
(2, 1, '1984-2', 'Top', '69093130b7c40.pdf', '2025-11-03 19:48:16'),
(3, 2, 'Pai Rico Pai Pobre', 'Muito Bom', '690939ea61a60.pdf', '2025-11-03 20:25:30'),
(4, 2, 'Revolução dos bichos', 'ok', '6909429f4d3a1.pdf', '2025-11-03 21:02:39'),
(5, 3, 'Test3', 'test3', '6909432f11f25.txt', '2025-11-03 21:05:03');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome_completo` varchar(150) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `data_nascimento` date DEFAULT NULL,
  `cpf` varchar(14) DEFAULT NULL,
  `senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome_completo`, `usuario`, `email`, `data_nascimento`, `cpf`, `senha`) VALUES
(1, 'Conrado', 'Conrado', 'conrado@gmail.com', '2018-01-11', '11111111111111', '$2y$10$P9X.4.rTBVp1lzqf3IUjkeXrrczAJNF.GyEr8G2VmojoTiy9fxdA.'),
(2, 'test', 'test', 'test@gmail.com', '2025-10-28', '12312321321321', '$2y$10$GtlqQEFJVGb0ReT35Uv6yO0tZ8qM6JLKubdprshRdaRONfA6.VqVC'),
(3, 'test3', 'test3', 'test3@gmail.com', '2025-10-29', '33333333333333', '$2y$10$0K9yRABqy0doGuF.lvtvdOxLhSrzBCRIOXDFIFKR1nQNi2CYXPZg.');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `atividades`
--
ALTER TABLE `atividades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices de tabela `avaliacoes`
--
ALTER TABLE `avaliacoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `submissao_id` (`submissao_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices de tabela `participacoes`
--
ALTER TABLE `participacoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `atividade_id` (`atividade_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices de tabela `submissoes`
--
ALTER TABLE `submissoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `cpf` (`cpf`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `atividades`
--
ALTER TABLE `atividades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `avaliacoes`
--
ALTER TABLE `avaliacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `participacoes`
--
ALTER TABLE `participacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `submissoes`
--
ALTER TABLE `submissoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `atividades`
--
ALTER TABLE `atividades`
  ADD CONSTRAINT `atividades_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Restrições para tabelas `avaliacoes`
--
ALTER TABLE `avaliacoes`
  ADD CONSTRAINT `avaliacoes_ibfk_1` FOREIGN KEY (`submissao_id`) REFERENCES `submissoes` (`id`),
  ADD CONSTRAINT `avaliacoes_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Restrições para tabelas `participacoes`
--
ALTER TABLE `participacoes`
  ADD CONSTRAINT `participacoes_ibfk_1` FOREIGN KEY (`atividade_id`) REFERENCES `atividades` (`id`),
  ADD CONSTRAINT `participacoes_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Restrições para tabelas `submissoes`
--
ALTER TABLE `submissoes`
  ADD CONSTRAINT `submissoes_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
