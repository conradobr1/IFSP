-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2025 at 05:36 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistema_escolar`
--

-- --------------------------------------------------------

--
-- Table structure for table `historico`
--

CREATE TABLE `historico` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `semestre` varchar(100) DEFAULT NULL,
  `disciplina` varchar(255) DEFAULT NULL,
  `nota` decimal(5,2) DEFAULT NULL,
  `situacao` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `historico`
--

INSERT INTO `historico` (`id`, `user_id`, `semestre`, `disciplina`, `nota`, `situacao`) VALUES
(52, 2, '2024/1', 'ALGORITMO E PROGRAMAÇÃO', 6.00, 'Aprovado'),
(53, 2, '2024/1', 'INGLÊS TÉCNICO', 8.60, 'Aprovado'),
(54, 2, '2024/1', 'INTRODUÇÃO À ADMINISTRAÇÃO', 10.00, 'Aprovado'),
(55, 2, '2024/1', 'INTRODUÇÃO À COMPUTAÇÃO', 6.00, 'Aprovado'),
(56, 2, '2024/1', 'LINGUAGEM DE PROGRAMAÇÃO', 7.50, 'Aprovado'),
(57, 2, '2024/1', 'MATEMÁTICA', 10.00, 'Aprovado'),
(58, 2, '2024/2', 'ARQUITETURA DE COMPUTADORES', 7.20, 'Aprovado'),
(59, 2, '2024/2', 'BANCO DE DADOS', 10.00, 'Aprovado'),
(60, 2, '2024/2', 'ESTRUTURAS DE DADOS', 5.60, 'Reprovado'),
(61, 2, '2024/2', 'ESTATÍSTICA', 7.70, 'Aprovado'),
(62, 2, '2024/2', 'GESTÃO DE PROJETOS', 9.50, 'Aprovado'),
(63, 2, '2024/2', 'SISTEMAS OPERACIONAIS', 6.00, 'Aprovado'),
(64, 2, '2025/1', 'BANCO DE DADOS 2', 10.00, 'Aprovado'),
(65, 2, '2025/1', 'DESENVOLVIMENTO WEB', 9.30, 'Aprovado'),
(66, 2, '2025/1', 'ENGENHARIA DE SOFTWARE', 9.50, 'Aprovado'),
(67, 2, '2025/1', 'ESTRUTURAS DE DADOS 2', 0.00, 'Reprovado'),
(68, 2, '2025/1', 'REDES DE COMPUTADORES', 7.90, 'Aprovado'),
(144, 1, '2024/1', 'ALGORITMO E PROGRAMAÇÃO', 6.00, 'Aprovado'),
(145, 1, '2024/1', 'INGLÊS TÉCNICO', 8.60, 'Aprovado'),
(146, 1, '2024/1', 'INTRODUÇÃO À ADMINISTRAÇÃO', 10.00, 'Aprovado'),
(147, 1, '2024/1', 'INTRODUÇÃO À COMPUTAÇÃO', 6.00, 'Aprovado'),
(148, 1, '2024/1', 'LINGUAGEM DE PROGRAMAÇÃO', 7.50, 'Aprovado'),
(149, 1, '2024/1', 'MATEMÁTICA', 10.00, 'Aprovado'),
(150, 1, '2024/2', 'ARQUITETURA DE COMPUTADORES', 7.20, 'Aprovado'),
(151, 1, '2024/2', 'BANCO DE DADOS', 10.00, 'Aprovado'),
(152, 1, 'Futuro (sem 2)', 'ESTRUTURAS DE DADOS', NULL, 'A Cursar'),
(153, 1, '2024/2', 'ESTRUTURAS DE DADOS', 5.60, 'Reprovado'),
(154, 1, '2024/2', 'ESTATÍSTICA', 7.70, 'Aprovado'),
(155, 1, '2024/2', 'GESTÃO DE PROJETOS', 9.50, 'Aprovado'),
(156, 1, '2024/2', 'SISTEMAS OPERACIONAIS', 6.00, 'Aprovado'),
(157, 1, '2025/1', 'BANCO DE DADOS 2', 10.00, 'Aprovado'),
(158, 1, '2025/1', 'DESENVOLVIMENTO WEB', 9.30, 'Aprovado'),
(159, 1, '2025/1', 'ENGENHARIA DE SOFTWARE', 9.50, 'Aprovado'),
(160, 1, 'Futuro (sem 3)', 'ESTRUTURAS DE DADOS 2', NULL, 'A Cursar'),
(161, 1, '2025/1', 'ESTRUTURAS DE DADOS 2', 0.00, 'Reprovado'),
(162, 1, '2025/1', 'REDES DE COMPUTADORES', 7.90, 'Aprovado'),
(163, 1, '2025/2', 'ANÁLISE DE SISTEMAS', NULL, 'Cursando'),
(164, 1, '2025/2', 'DESENVOLVIMENTO WEB 2', NULL, 'Cursando'),
(165, 1, '2025/2', 'EMPREENDEDORISMO', NULL, 'Cursando'),
(166, 1, '2025/2', 'INTERAÇÃO HUMANO-COMPUTADOR', NULL, 'Cursando'),
(167, 1, '2025/2', 'PROGRAMAÇÃO ORIENTADA A OBJETOS', NULL, 'Cursando'),
(168, 1, '2025/2', 'REDE DE COMPUTADORES 2', NULL, 'Cursando'),
(169, 1, 'Futuro (sem 5)', 'COMPUTAÇÃO NA NUVEM', NULL, 'A Cursar'),
(170, 1, 'Futuro (sem 5)', 'DESENVOLVIMENTO WEB 3', NULL, 'A Cursar'),
(171, 1, 'Futuro (sem 5)', 'INTERNET DAS COISAS', NULL, 'A Cursar'),
(172, 1, 'Futuro (sem 5)', 'LINGUAGEM DE PROGRAMAÇÃO 2', NULL, 'A Cursar'),
(173, 1, 'Futuro (sem 5)', 'PROJETO E DESENVOLVIMENTO DE SISTEMAS', NULL, 'A Cursar'),
(174, 1, 'Futuro (sem 6)', 'CIÊNCIA DE DADOS', NULL, 'A Cursar'),
(175, 1, 'Futuro (sem 6)', 'DESENVOLVIMENTO PARA DISPOSITIVOS MÓVEIS', NULL, 'A Cursar'),
(176, 1, 'Futuro (sem 6)', 'PROJETO E DESENVOLVIMENTO DE SISTEMAS 2', NULL, 'A Cursar'),
(177, 1, 'Futuro (sem 6)', 'SEGURANÇA DA INFORMAÇÃO', NULL, 'A Cursar'),
(178, 1, 'Futuro (sem 6)', 'TÓPICOS AVANÇADOS', NULL, 'A Cursar'),
(249, 4, '2024/1', 'ALGORITMO E PROGRAMAÇÃO', 6.00, 'Aprovado'),
(250, 4, '2024/1', 'INGLÊS TÉCNICO', 8.60, 'Aprovado'),
(251, 4, '2024/1', 'INTRODUÇÃO À ADMINISTRAÇÃO', 10.00, 'Aprovado'),
(252, 4, '2024/1', 'INTRODUÇÃO À COMPUTAÇÃO', 6.00, 'Aprovado'),
(253, 4, '2024/1', 'LINGUAGEM DE PROGRAMAÇÃO', 7.50, 'Aprovado'),
(254, 4, '2024/1', 'MATEMÁTICA', 10.00, 'Aprovado'),
(255, 4, '2024/2', 'ARQUITETURA DE COMPUTADORES', 7.20, 'Aprovado'),
(256, 4, '2024/2', 'BANCO DE DADOS', 10.00, 'Aprovado'),
(257, 4, 'Futuro (sem 2)', 'ESTRUTURAS DE DADOS', NULL, 'A Cursar'),
(258, 4, '2024/2', 'ESTRUTURAS DE DADOS', 5.60, 'Reprovado'),
(259, 4, '2024/2', 'ESTATÍSTICA', 7.70, 'Aprovado'),
(260, 4, '2024/2', 'GESTÃO DE PROJETOS', 9.50, 'Aprovado'),
(261, 4, '2024/2', 'SISTEMAS OPERACIONAIS', 6.00, 'Aprovado'),
(262, 4, '2025/1', 'BANCO DE DADOS 2', 10.00, 'Aprovado'),
(263, 4, '2025/1', 'DESENVOLVIMENTO WEB', 9.30, 'Aprovado'),
(264, 4, '2025/1', 'ENGENHARIA DE SOFTWARE', 9.50, 'Aprovado'),
(265, 4, 'Futuro (sem 3)', 'ESTRUTURAS DE DADOS 2', NULL, 'A Cursar'),
(266, 4, '2025/1', 'ESTRUTURAS DE DADOS 2', 0.00, 'Reprovado'),
(267, 4, '2025/1', 'REDES DE COMPUTADORES', 7.90, 'Aprovado'),
(268, 4, '2025/2', 'ANÁLISE DE SISTEMAS', NULL, 'Cursando'),
(269, 4, '2025/2', 'DESENVOLVIMENTO WEB 2', NULL, 'Cursando'),
(270, 4, '2025/2', 'EMPREENDEDORISMO', NULL, 'Cursando'),
(271, 4, '2025/2', 'INTERAÇÃO HUMANO-COMPUTADOR', NULL, 'Cursando'),
(272, 4, '2025/2', 'PROGRAMAÇÃO ORIENTADA A OBJETOS', NULL, 'Cursando'),
(273, 4, '2025/2', 'REDE DE COMPUTADORES 2', NULL, 'Cursando'),
(274, 4, 'Futuro (sem 5)', 'COMPUTAÇÃO NA NUVEM', NULL, 'A Cursar'),
(275, 4, 'Futuro (sem 5)', 'DESENVOLVIMENTO WEB 3', NULL, 'A Cursar'),
(276, 4, 'Futuro (sem 5)', 'INTERNET DAS COISAS', NULL, 'A Cursar'),
(277, 4, 'Futuro (sem 5)', 'LINGUAGEM DE PROGRAMAÇÃO 2', NULL, 'A Cursar'),
(278, 4, 'Futuro (sem 5)', 'PROJETO E DESENVOLVIMENTO DE SISTEMAS', NULL, 'A Cursar'),
(279, 4, 'Futuro (sem 6)', 'CIÊNCIA DE DADOS', NULL, 'A Cursar'),
(280, 4, 'Futuro (sem 6)', 'DESENVOLVIMENTO PARA DISPOSITIVOS MÓVEIS', NULL, 'A Cursar'),
(281, 4, 'Futuro (sem 6)', 'PROJETO E DESENVOLVIMENTO DE SISTEMAS 2', NULL, 'A Cursar'),
(282, 4, 'Futuro (sem 6)', 'SEGURANÇA DA INFORMAÇÃO', NULL, 'A Cursar'),
(283, 4, 'Futuro (sem 6)', 'TÓPICOS AVANÇADOS', NULL, 'A Cursar'),
(354, 5, '2024/1', 'ALGORITMO E PROGRAMAÇÃO', 6.00, 'Aprovado'),
(355, 5, '2024/1', 'INGLÊS TÉCNICO', 8.60, 'Aprovado'),
(356, 5, '2024/1', 'INTRODUÇÃO À ADMINISTRAÇÃO', 10.00, 'Aprovado'),
(357, 5, '2024/1', 'INTRODUÇÃO À COMPUTAÇÃO', 6.00, 'Aprovado'),
(358, 5, '2024/1', 'LINGUAGEM DE PROGRAMAÇÃO', 7.50, 'Aprovado'),
(359, 5, '2024/1', 'MATEMÁTICA', 10.00, 'Aprovado'),
(360, 5, '2024/2', 'ARQUITETURA DE COMPUTADORES', 7.20, 'Aprovado'),
(361, 5, '2024/2', 'BANCO DE DADOS', 10.00, 'Aprovado'),
(362, 5, 'Futuro (sem 2)', 'ESTRUTURAS DE DADOS', NULL, 'A Cursar'),
(363, 5, '2024/2', 'ESTRUTURAS DE DADOS', 5.60, 'Reprovado'),
(364, 5, '2024/2', 'ESTATÍSTICA', 7.70, 'Aprovado'),
(365, 5, '2024/2', 'GESTÃO DE PROJETOS', 9.50, 'Aprovado'),
(366, 5, '2024/2', 'SISTEMAS OPERACIONAIS', 6.00, 'Aprovado'),
(367, 5, '2025/1', 'BANCO DE DADOS 2', 10.00, 'Aprovado'),
(368, 5, '2025/1', 'DESENVOLVIMENTO WEB', 9.30, 'Aprovado'),
(369, 5, '2025/1', 'ENGENHARIA DE SOFTWARE', 9.50, 'Aprovado'),
(370, 5, 'Futuro (sem 3)', 'ESTRUTURAS DE DADOS 2', NULL, 'A Cursar'),
(371, 5, '2025/1', 'ESTRUTURAS DE DADOS 2', 0.00, 'Reprovado'),
(372, 5, '2025/1', 'REDES DE COMPUTADORES', 7.90, 'Aprovado'),
(373, 5, '2025/2', 'ANÁLISE DE SISTEMAS', NULL, 'Cursando'),
(374, 5, '2025/2', 'DESENVOLVIMENTO WEB 2', NULL, 'Cursando'),
(375, 5, '2025/2', 'EMPREENDEDORISMO', NULL, 'Cursando'),
(376, 5, '2025/2', 'INTERAÇÃO HUMANO-COMPUTADOR', NULL, 'Cursando'),
(377, 5, '2025/2', 'PROGRAMAÇÃO ORIENTADA A OBJETOS', NULL, 'Cursando'),
(378, 5, '2025/2', 'REDE DE COMPUTADORES 2', NULL, 'Cursando'),
(379, 5, 'Futuro (sem 5)', 'COMPUTAÇÃO NA NUVEM', NULL, 'A Cursar'),
(380, 5, 'Futuro (sem 5)', 'DESENVOLVIMENTO WEB 3', NULL, 'A Cursar'),
(381, 5, 'Futuro (sem 5)', 'INTERNET DAS COISAS', NULL, 'A Cursar'),
(382, 5, 'Futuro (sem 5)', 'LINGUAGEM DE PROGRAMAÇÃO 2', NULL, 'A Cursar'),
(383, 5, 'Futuro (sem 5)', 'PROJETO E DESENVOLVIMENTO DE SISTEMAS', NULL, 'A Cursar'),
(384, 5, 'Futuro (sem 6)', 'CIÊNCIA DE DADOS', NULL, 'A Cursar'),
(385, 5, 'Futuro (sem 6)', 'DESENVOLVIMENTO PARA DISPOSITIVOS MÓVEIS', NULL, 'A Cursar'),
(386, 5, 'Futuro (sem 6)', 'PROJETO E DESENVOLVIMENTO DE SISTEMAS 2', NULL, 'A Cursar'),
(387, 5, 'Futuro (sem 6)', 'SEGURANÇA DA INFORMAÇÃO', NULL, 'A Cursar'),
(388, 5, 'Futuro (sem 6)', 'TÓPICOS AVANÇADOS', NULL, 'A Cursar');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `email` varchar(150) NOT NULL,
  `senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `email`, `senha`) VALUES
(1, 'test@gmail.com', '$2y$10$ue87abdDr5RTp7qXyEb.y.FlGLDmsabGivQBU75enCmRolv2Abwse'),
(2, 'teste2@gmail.com', '$2y$10$y8yDI.9Xuw7aRx3CdoqIqehM6K31MNN6Kqy8y1pRS.VEuwdSk9vry'),
(3, 'conrado@gmail.com', '$2y$10$HX4QuiJmYIcZ24ugKUr/XeNSJRFnIx8W6uNDFFoxVvZH4mxS5PzeG'),
(4, 'test4@gmail.com', '$2y$10$VcI4GQOplQoavS/QAkHfIu3wdkksrhihs9CVJsmg.66UXAm4oQzOi'),
(5, 'test5@gmail.com', '$2y$10$lushwz4SmqnwgRdaLE6VaOXK080o1SEwlkD3feC9OC4nTGY9JAZPO');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `historico`
--
ALTER TABLE `historico`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `historico`
--
ALTER TABLE `historico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=389;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `historico`
--
ALTER TABLE `historico`
  ADD CONSTRAINT `historico_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
