-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 29, 2025 at 10:27 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `refeitorio`
--

-- --------------------------------------------------------

--
-- Table structure for table `cardapios`
--

CREATE TABLE `cardapios` (
  `id` int NOT NULL,
  `dia_semana` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cardapios`
--

INSERT INTO `cardapios` (`id`, `dia_semana`, `updated_at`) VALUES
(1, 'segunda', '2025-07-25 13:50:02'),
(2, 'terca', '2025-07-25 13:43:10'),
(3, 'quarta', '2025-07-17 15:30:04'),
(4, 'quinta', NULL),
(5, 'sexta', NULL),
(6, 'sabado', NULL),
(7, 'domingo', '2025-07-25 13:50:21');

-- --------------------------------------------------------

--
-- Table structure for table `cardapio_itens`
--

CREATE TABLE `cardapio_itens` (
  `id` int NOT NULL,
  `cardapio_id` int NOT NULL,
  `nome` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tipo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cardapio_itens`
--

INSERT INTO `cardapio_itens` (`id`, `cardapio_id`, `nome`, `tipo`) VALUES
(4, 1, 'teste janta 1', 1),
(5, 1, 'teste janta 2', 1),
(6, 1, 'teste janta 3', 1),
(7, 1, 'teste janta 4', 1),
(8, 1, 'teste janta 5', 1),
(12, 2, 'teste almoço terça  1', 0),
(13, 2, 'teste janta terça 1', 1),
(14, 1, 'teste almoço 1', 0),
(15, 1, 'teste almoço 2 teste', 0),
(16, 7, 'teste janta 1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `configuracoes`
--

CREATE TABLE `configuracoes` (
  `id` int NOT NULL,
  `chave` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `valor` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `configuracoes`
--

INSERT INTO `configuracoes` (`id`, `chave`, `valor`) VALUES
(1, 'hora_inicio_almoco', '07:00'),
(2, 'hora_fim_almoco', '10:00'),
(3, 'hora_inicio_janta', '13:00'),
(4, 'hora_fim_janta', '17:00'),
(5, 'hora_inicio_cafe', '05:00'),
(6, 'hora_fim_cafe', '06:00'),
(7, 'hora_inicio_madrugada', '22:00'),
(8, 'hora_fim_madrugada', '23:00');

-- --------------------------------------------------------

--
-- Table structure for table `funcionarios`
--

CREATE TABLE `funcionarios` (
  `id` int NOT NULL,
  `matricula` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nome` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `funcionarios`
--

INSERT INTO `funcionarios` (`id`, `matricula`, `nome`, `created_at`, `updated_at`) VALUES
(1, '10052', 'Cristian Ricardo Fontinele', '2025-07-01 17:04:36', '2025-07-28 08:53:11'),
(2, '10050', 'teste ', '2025-07-01 23:29:08', '2025-07-01 23:29:08'),
(3, '10000', 'teste 2', '2025-07-02 15:39:37', '2025-07-02 15:39:37'),
(4, '10001', 'teste 3', '2025-07-02 15:42:05', '2025-07-02 15:42:05'),
(5, '10002', 'teste 4', '2025-07-02 15:42:41', '2025-07-02 15:42:41'),
(6, '10003', 'teste 5', '2025-07-02 15:43:12', '2025-07-02 15:43:12'),
(7, '10004', 'teste 6', '2025-07-02 15:45:03', '2025-07-02 15:45:03'),
(8, '16560', 'hoader zoar', '2025-07-02 18:17:08', '2025-07-02 18:17:08'),
(17, '14414', 'ALINE', '2025-07-17 15:04:58', '2025-07-17 15:04:58');

-- --------------------------------------------------------

--
-- Table structure for table `lancamentos`
--

CREATE TABLE `lancamentos` (
  `id` int NOT NULL,
  `funcionario_id` int NOT NULL,
  `refeicao_id` int NOT NULL,
  `data` date NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lancamentos`
--

INSERT INTO `lancamentos` (`id`, `funcionario_id`, `refeicao_id`, `data`, `created_at`, `updated_at`) VALUES
(1, 1, 2, '2025-07-01', '2025-07-02 01:24:18', '2025-07-02 07:46:35'),
(2, 1, 1, '2025-07-01', '2025-07-01 10:23:30', '2025-07-01 10:23:30'),
(6, 1, 1, '2025-07-02', '2025-07-01 23:29:40', '2025-07-01 23:44:15'),
(7, 1, 2, '2025-07-02', '2025-07-01 23:50:43', '2025-07-01 23:50:43'),
(9, 2, 1, '2025-07-02', '2025-07-02 12:54:27', '2025-07-02 12:54:27'),
(10, 3, 1, '2025-07-02', '2025-07-02 15:40:09', '2025-07-02 15:40:09'),
(11, 8, 1, '2025-07-02', '2025-07-02 18:17:15', '2025-07-02 18:17:15'),
(12, 1, 1, '2025-07-03', '2025-07-03 11:47:25', '2025-07-03 11:47:25'),
(14, 2, 1, '2025-07-03', '2025-07-03 15:26:46', '2025-07-03 15:26:46'),
(15, 3, 1, '2025-07-03', '2025-07-03 15:32:05', '2025-07-03 15:32:05'),
(23, 3, 4, '2025-07-03', '2025-07-03 17:14:27', '2025-07-03 17:14:27'),
(26, 1, 2, '2025-07-09', '2025-07-09 15:31:47', '2025-07-09 15:31:47'),
(28, 17, 2, '2025-07-17', '2025-07-17 15:05:11', '2025-07-17 15:05:11'),
(29, 1, 2, '2025-07-17', '2025-07-17 15:40:14', '2025-07-17 15:40:14'),
(30, 1, 2, '2025-07-28', '2025-07-28 08:55:23', '2025-07-28 09:55:23');

-- --------------------------------------------------------

--
-- Table structure for table `refeicoes`
--

CREATE TABLE `refeicoes` (
  `id` int NOT NULL,
  `tipo` enum('almoço','janta','cafe_manha','cafe_madrugada') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `refeicoes`
--

INSERT INTO `refeicoes` (`id`, `tipo`, `created_at`, `updated_at`) VALUES
(1, 'almoço', '2025-07-01 22:23:55', '2025-07-01 22:23:55'),
(2, 'janta', '2025-07-01 22:23:55', '2025-07-01 22:23:55'),
(3, 'cafe_manha', '2025-07-01 22:23:55', '2025-07-01 22:23:55'),
(4, 'cafe_madrugada', '2025-07-01 22:23:55', '2025-07-01 22:23:55');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int NOT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `role` enum('admin','user') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'user',
  `ativo` tinyint(1) DEFAULT '1',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `password`, `role`, `ativo`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$yn2ZZS4VHok5OQZ7u6DfOO9TI8pjshIA4gJt4N1aBaGGX6R28nUAa', 'admin', 1, '2025-07-07 15:06:26', '2025-07-08 14:45:06'),
(2, 'cristiansilv50@gmail.com', '$2y$10$pkHi5c/eC8aUIkktvgMtsugpy4RGDgZM27dIXHLLaClmNvAtuGcr6', 'user', 1, '2025-07-08 09:52:56', '2025-07-25 09:20:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cardapios`
--
ALTER TABLE `cardapios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cardapio_itens`
--
ALTER TABLE `cardapio_itens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cardapio_id` (`cardapio_id`);

--
-- Indexes for table `configuracoes`
--
ALTER TABLE `configuracoes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `chave` (`chave`);

--
-- Indexes for table `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `matricula` (`matricula`);

--
-- Indexes for table `lancamentos`
--
ALTER TABLE `lancamentos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_funcionario_data_refeicao` (`funcionario_id`,`data`,`refeicao_id`),
  ADD KEY `refeicao_id` (`refeicao_id`);

--
-- Indexes for table `refeicoes`
--
ALTER TABLE `refeicoes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cardapios`
--
ALTER TABLE `cardapios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `cardapio_itens`
--
ALTER TABLE `cardapio_itens`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `configuracoes`
--
ALTER TABLE `configuracoes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `funcionarios`
--
ALTER TABLE `funcionarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `lancamentos`
--
ALTER TABLE `lancamentos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `refeicoes`
--
ALTER TABLE `refeicoes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `lancamentos`
--
ALTER TABLE `lancamentos`
  ADD CONSTRAINT `lancamentos_ibfk_1` FOREIGN KEY (`funcionario_id`) REFERENCES `funcionarios` (`id`),
  ADD CONSTRAINT `lancamentos_ibfk_2` FOREIGN KEY (`refeicao_id`) REFERENCES `refeicoes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
