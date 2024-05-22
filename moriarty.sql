-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 12/09/2023 às 15:46
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `moriarty`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `attendances`
--

CREATE TABLE `attendances` (
  `id` int(11) NOT NULL,
  `pacient_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `alert_reference` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `attendances`
--

INSERT INTO `attendances` (`id`, `pacient_id`, `user_id`, `title`, `description`, `status`, `alert_reference`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 'Reis reis', 'Reis reis', 'atendido', '5', '2023-06-15 18:40:22', '2023-06-15 18:40:22', NULL),
(2, 1, 1, NULL, '', '1', '1', '2023-06-15 19:50:42', '2023-06-15 19:50:42', NULL),
(3, 1, 1, NULL, '', '1', '1', '2023-06-15 19:51:49', '2023-06-15 19:51:49', NULL),
(4, 1, 1, NULL, '            Paciente : qwe <br>\r\n            Data : 15/06/2023 16:53:48 <br>\r\n            Atendente : Admin nistrador <br>\r\n\r\n        ', '1', '1', '2023-06-15 19:53:54', '2023-06-15 19:53:54', NULL),
(5, 1, 1, NULL, '            Paciente : qwe <br>\r\n            Data : 15/06/2023 16:55:27 <br>\r\n            Atendente : Admin nistrador <br>\r\n\r\n        ', '1', '1', '2023-06-15 19:55:30', '2023-06-15 19:55:30', NULL),
(6, 1, 1, NULL, '            Paciente : qwe <br>\r\n            Data : 03/07/2023 13:25:01 <br>\r\n            Atendente : Admin nistrador <br>\r\n\r\n        ', '2', '2', '2023-07-03 16:25:09', '2023-07-03 16:25:09', NULL),
(7, 3, 1, NULL, '            Paciente : Pedro Noronha <br>\r\n            Data : 03/07/2023 13:25:52 <br>\r\n            Atendente : Admin nistrador <br>\r\n\r\n        ', '1', '1', '2023-07-03 16:25:55', '2023-07-03 16:25:55', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'category test'),
(2, 'Categoria 1'),
(3, 'Categoria 2');

-- --------------------------------------------------------

--
-- Estrutura para tabela `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `pacient_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `kinship` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `contacts`
--

INSERT INTO `contacts` (`id`, `pacient_id`, `name`, `kinship`, `phone`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, 1, '123123', '2132132', '(12) 3123-213_', '2023-06-12 19:53:40', '2023-06-12 19:53:40', NULL),
(5, 1, 'PEDRO H P NORONHA', 'Parente!', '(61) 9 9800-9987', '2023-06-12 19:59:19', '2023-06-12 19:59:19', NULL),
(7, 1, 'PEDRO H P NORONHA', '23123123', '(61) 31__-____', '2023-07-03 17:59:16', '2023-07-03 17:59:16', NULL),
(8, 1, 'PEDRO H P NORONHA', 'qweeeeeeee', '(61) 9 9800-9987', '2023-07-03 17:59:28', '2023-07-03 17:59:28', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `custom_fields`
--

CREATE TABLE `custom_fields` (
  `id` int(11) NOT NULL,
  `belongs_to` varchar(512) NOT NULL,
  `owner_id` varchar(512) NOT NULL,
  `type` varchar(512) NOT NULL,
  `options` blob NOT NULL,
  `name` varchar(512) NOT NULL,
  `display` varchar(512) NOT NULL,
  `placeholder` text NOT NULL,
  `category_id` varchar(512) NOT NULL,
  `mask` varchar(1024) NOT NULL,
  `description` blob NOT NULL,
  `validations` varchar(512) NOT NULL,
  `required` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `custom_fields`
--

INSERT INTO `custom_fields` (`id`, `belongs_to`, `owner_id`, `type`, `options`, `name`, `display`, `placeholder`, `category_id`, `mask`, `description`, `validations`, `required`, `created_at`, `deleted_at`) VALUES
(7, '1', '1', 'radio', 0x7177652c7177652c717765, 'test_custom_field', 'Test Custom Field', '', '1', 'qwe', 0x546869732069732061207465737420637573746f6d206669656c64, '', 1, '2023-06-13 12:25:10', '2023-06-13 13:50:13'),
(8, '1', '1', 'radio', '', 'test_custom_fieldx', 'Test Custom Field', '', '1', '', 0x546869732069732061207465737420637573746f6d206669656c64, '', 1, '2023-06-13 12:25:10', '2023-06-13 13:50:14'),
(9, '', '', 'qwe', '', 'PEDRO H P NORONHA', 'Test Category X', '', '', '123', 0x717765, '', 0, '2023-06-13 13:31:17', '2023-06-13 13:50:16'),
(10, '', '', 'radio', 0x7177652c747931323378, 'qwe', 'qwe', 'qwe 123', '', 'qwe', 0x777165, '', 0, '2023-06-13 13:53:32', NULL),
(11, '', '', 'select', 0x223132332c31323322, 'PEDRO H P NORONHA', 'Test Category YYYY', '', '', 'qwe 123', 0x7177652031327a, '', 0, '2023-06-13 13:54:17', NULL),
(12, '', '', 'textarea', '', 'PEDRO H P NORONHA', 'Test Category X', '', '', 'qwe', 0x717765717765, '', 0, '2023-06-13 14:02:20', NULL),
(13, '', '', 'checkbox', 0x717765, 'PEDRO H P NORONHA', 'Test Category X', '', '', 'qwe', 0x717765, '', 0, '2023-06-13 14:40:08', NULL),
(14, '', '', 'radio', 0x717765717765, 'teste', 'teste', '', '', '123qwe,qwewqe1235yt', 0x71776520717765, '', 0, '2023-06-13 14:40:27', NULL),
(15, '', '', 'radio', 0x7177657177652c7177657177, 'PEDRO H P NORONHA', 'Test Category X', '', '', '213213', 0x717765777165, '', 0, '2023-06-13 14:41:08', NULL),
(16, '1', '1', 'text', '', 'test_custom_field', 'Test Custom Field', '', '1', '', 0x546869732069732061207465737420637573746f6d206669656c64, '', 1, '2023-06-13 14:44:26', NULL),
(17, '1', '1', 'text', '', 'test_custom_field', 'Test Custom Field', '', '1', '', 0x546869732069732061207465737420637573746f6d206669656c64, '', 1, '2023-06-13 14:44:26', NULL),
(18, '', '', 'checkbox', 0x7177652071776520, 'PEDRO H P NORONHA', 'Test Category X', 'Sobrenome', '', 'qwe', 0x717765, '', 0, '2023-06-13 14:46:59', NULL),
(19, '', '', 'text', 0x3132332c3132332c313233, 'PEDRO H P NORONHA', 'Test Category X', 'Sobrenome', '', 'we', 0x717765, '', 0, '2023-06-13 14:47:13', NULL),
(20, '', '', 'text', 0x777165, 'PEDRO H P NORONHA', 'Test Category X', 'qwe', '5', 'qwe', 0x717765, '', 1, '2023-06-13 14:47:55', NULL),
(21, '', '', 'text', '', 'rua', 'rua', 'rua', '13', '', '', '', 1, '2023-06-13 14:50:05', NULL),
(22, '', '', 'text', '', 'numero', 'Número', 'numero', '13', '', '', '', 1, '2023-06-13 14:50:25', NULL),
(23, '', '', 'text', '', 'complemento', 'Complemento', 'complemento', '13', '', '', '', 1, '2023-06-13 14:50:55', NULL),
(24, '', '', 'text', '', 'bairro', 'Bairro', 'bairro', '13', '', '', '', 1, '2023-06-13 14:51:04', NULL),
(25, '', '', 'text', '', 'cidade', 'Cidade', 'cidade', '13', '', '', '', 1, '2023-06-13 14:51:16', NULL),
(26, '', '', 'text', '', 'estado', 'Estado', 'estado', '13', '', '', '', 1, '2023-06-13 14:51:30', NULL),
(27, '', '', 'text', '', 'cep', 'Cep', 'CEP', '13', '', '', '', 1, '2023-06-13 14:51:42', NULL),
(28, '', '', 'checkbox', 0x3132332c3132332c313233, 'Campo Customizado 1', 'Campo Customizado 1', 'ata', '13', 'qwe', 0x717765, '', 0, '2023-06-13 15:41:39', NULL),
(29, '', '', 'file', 0x3132332c3132332c313233, 'Foto Paciente', 'Foto Paciente', 'xata', '13', 'qwe', 0x717765, '', 0, '2023-06-13 15:41:49', NULL),
(30, '', '', 'date', 0x3132332c3132332c313233, 'Data de Inserção', 'Data de Inserção', 'xata', '13', 'qwe', 0x717765, '', 0, '2023-06-13 15:42:02', NULL),
(31, '', '', 'radio', 0x73696d2c6ec3a36f, 'doencas_cronicas', 'Possui doenças Cronicas?', 'Possui doenças Cronicas?', '14', '', '', '', 0, '2023-06-13 17:14:47', NULL),
(32, '', '', 'select', 0x73696d2c6ec3a36f, 'pressao_alta', 'Pressão Alta', 'Pressão Alta', '14', '', '', '', 0, '2023-06-13 17:15:14', NULL),
(33, '', '', 'select', 0x73696d2c6ec3a36f, 'pressao_baixa', 'Pressão Baixa', 'Pressão Baixa', '14', '', '', '', 0, '2023-06-13 17:15:26', NULL),
(34, '', '', 'text', '', 'nome_plano', 'Nome do Plano de Saúde', 'Nome do Plano de Saúde', '15', '', '', '', 0, '2023-06-13 17:19:58', NULL),
(35, '', '', 'select', 0x416d62756c61746f7269612c204162756d6c61746f7269616c2065204f62737465747269612c204162756c61746f7269616c206520496e74656e61c3a7c3a36f, 'tipo_plano_de_saude', 'Tipo do plano de saúde', 'tipo do Plano de Saúde', '15', '', '', '', 0, '2023-06-13 17:20:38', NULL),
(36, '', '', 'text', '', 'numero_carteirinha', 'Número da Carteirinha', 'Número carteirinha', '15', '', '', '', 0, '2023-06-13 17:20:53', NULL),
(37, '', '', 'text', '', 'telefone_contato', 'Telefone de Contato', 'Telefone de Contato', '15', '', '', '', 0, '2023-06-13 17:21:09', NULL),
(38, '', '', 'text', '', 'observacoes', 'Observações', '', '13', '', '', '', 0, '2023-06-13 17:23:36', NULL),
(39, '', '', 'text', '', 'titulo', 'Titulo', '', '16', '', '', '', 0, '2023-06-15 15:05:51', NULL),
(40, '', '', 'textarea', '', 'descricao', 'Descrição', 'Descreva sobre o paciente', '16', '', '', '', 0, '2023-06-15 15:06:46', NULL),
(41, '', '', 'select', 0x6174656e6469646f2c616775617264616e646f206174656e64696d656e746f2c20656d20616c657274612c2066616c736f20706f73697469766f2c206368616d61646120646520616d62756cc3a26e636961, 'status', 'Status do Atendimento', 'Selecione', '16', '', '', '', 0, '2023-06-15 15:07:34', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `custom_fields_categories`
--

CREATE TABLE `custom_fields_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(512) NOT NULL,
  `display` varchar(1024) NOT NULL,
  `groups` blob NOT NULL,
  `description` blob NOT NULL,
  `displayAt` varchar(512) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `custom_fields_categories`
--

INSERT INTO `custom_fields_categories` (`id`, `name`, `display`, `groups`, `description`, `displayAt`, `created_at`, `deleted_at`) VALUES
(3, 'test_category', 'Test Category', 0x31, 0x54686973206973206120746573742063617465676f7279, 'pacient_profile', '2023-06-13 12:16:35', '2023-06-13 13:12:37'),
(4, 'test_category', 'Test Category', 0x31, 0x54686973206973206120746573742063617465676f7279, 'pacient_profile', '2023-06-13 12:16:35', '2023-06-13 13:13:24'),
(5, 'test_category', 'Test Category X', 0x31, 0x54686973206973206120746573742063617465676f7279, 'pacient_profile', '2023-06-13 12:19:49', '2023-06-13 14:48:57'),
(6, 'test_category', 'Test Category YYYY', 0x31, 0x54686973206973206120746573742063617465676f7279, 'pacient_profile', '2023-06-13 12:19:49', '2023-06-13 14:49:00'),
(7, 'test_category', 'Test Category', 0x31, 0x54686973206973206120746573742063617465676f7279, 'pacient_profile', '2023-06-13 12:19:52', '2023-06-13 13:13:36'),
(8, 'test_category', 'Test Category', 0x31, 0x54686973206973206120746573742063617465676f7279, 'pacient_profile', '2023-06-13 12:19:52', '2023-06-13 14:48:59'),
(9, 'test_category', 'Test Category WYZ', 0x31, 0x54686973206973206120746573742063617465676f7279, 'pacient_profile', '2023-06-13 12:19:54', '2023-06-13 14:49:03'),
(10, 'test_category', 'Test Category', 0x31, 0x54686973206973206120746573742063617465676f7279, 'pacient_profile', '2023-06-13 12:19:54', '2023-06-13 13:13:39'),
(11, '12312321', 'qweqwe', 0x313233, 0x717765717765, 'pacient_profile', '2023-06-13 13:16:04', '2023-06-13 14:49:02'),
(12, '1234321', '1234321', 0x74, 0x313233323133, 'pacient_profile', '2023-06-13 13:16:16', '2023-06-13 14:49:05'),
(13, 'pacient_data', 'Dados do Paciente', 0x70616369656e74732c7573657273, 0x4461646f732063616461737472616973, 'pacient', '2023-06-13 14:49:30', NULL),
(14, 'pacient_anamnese', 'Anamnese', 0x70616369656e74, 0x416e616d6e65736573, 'pacient', '2023-06-13 17:13:51', NULL),
(15, 'pacient_plano_de_saude', 'Plano de Saúde', 0x70616369656e74, 0x506c616e6f206465205361c3ba6465, 'pacient', '2023-06-13 17:18:23', NULL),
(16, 'pacient_prontuary', 'Prontuarios', 0x61646d696e2c70616369656e742c7573657273, 0x50726f6e7475c3a172696f7320646f732050616369656e746573, 'pacient_profile', '2023-06-15 15:05:16', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `custom_fields_values`
--

CREATE TABLE `custom_fields_values` (
  `id` int(11) NOT NULL,
  `custom_field_id` int(9) NOT NULL,
  `category_id` int(11) NOT NULL,
  `reference` varchar(512) NOT NULL,
  `value` text NOT NULL,
  `description` varchar(512) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `custom_fields_values`
--

INSERT INTO `custom_fields_values` (`id`, `custom_field_id`, `category_id`, `reference`, `value`, `description`, `created_at`, `deleted_at`) VALUES
(107, 21, 13, 'paciente:1', 'Qr 122 Cj 04 Cada GG', 'rua', '2023-06-13 16:54:46', NULL),
(108, 22, 13, 'paciente:1', '05', 'numero', '2023-06-13 16:54:46', NULL),
(109, 23, 13, 'paciente:1', '12qwewq', 'complemento', '2023-06-13 16:54:46', NULL),
(110, 24, 13, 'paciente:1', '123', 'bairro', '2023-06-13 16:54:46', NULL),
(111, 25, 13, 'paciente:1', 'Brasília', 'cidade', '2023-06-13 16:54:46', NULL),
(112, 26, 13, 'paciente:1', 'DF', 'estado', '2023-06-13 16:54:46', NULL),
(113, 27, 13, 'paciente:1', '72304204', 'cep', '2023-06-13 16:54:46', NULL),
(114, 28, 13, 'paciente:1', '123', 'ata', '2023-06-13 16:54:46', NULL),
(115, 30, 13, 'paciente:1', '2132-03-12', 'dxata', '2023-06-13 16:54:46', NULL),
(116, 29, 13, 'paciente:1', 'cf9f1142-9ebd-4193-8812-6d397f63d16f.jfif', 'xata', '2023-06-13 16:54:46', NULL),
(117, 31, 14, 'paciente:1', 'sim', 'doencas_cronicas', '2023-06-13 17:15:40', NULL),
(118, 32, 14, 'paciente:1', 'sim', 'pressao_alta', '2023-06-13 17:15:40', NULL),
(119, 33, 14, 'paciente:1', 'sim', 'pressao_baixa', '2023-06-13 17:15:40', NULL),
(120, 34, 15, 'paciente:1', 'ASK SOFT', 'nome_plano', '2023-06-13 17:21:25', NULL),
(121, 35, 15, 'paciente:1', 'Ambulatoria', 'tipo_plano_de_saude', '2023-06-13 17:21:25', NULL),
(122, 36, 15, 'paciente:1', '123123123', 'numero_carteirinha', '2023-06-13 17:21:25', NULL),
(123, 37, 15, 'paciente:1', '12312312321', 'telefone_contato', '2023-06-13 17:21:25', NULL),
(124, 39, 16, 'prontuario_paciente:1', 'qweqwe', 'titulo', '2023-06-15 15:32:31', NULL),
(125, 40, 16, 'prontuario_paciente:1', 'qwewq', 'descricao', '2023-06-15 15:32:31', NULL),
(126, 41, 16, 'prontuario_paciente:1', 'aguardando atendimento', 'status', '2023-06-15 15:32:31', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `devices`
--

CREATE TABLE `devices` (
  `id` int(11) NOT NULL,
  `pacient_id` int(11) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `fence_enabled` tinyint(1) DEFAULT NULL,
  `fence_lat` float DEFAULT NULL,
  `fence_lng` float DEFAULT NULL,
  `fence_radius` int(10) NOT NULL,
  `step_enabled` tinyint(1) DEFAULT NULL,
  `step_min` int(11) DEFAULT NULL,
  `fall_enabled` tinyint(1) DEFAULT NULL,
  `fall_level` int(11) DEFAULT NULL,
  `sync_interval` int(11) DEFAULT NULL,
  `imei` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `sn` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `devices`
--

INSERT INTO `devices` (`id`, `pacient_id`, `status`, `fence_enabled`, `fence_lat`, `fence_lng`, `fence_radius`, `step_enabled`, `step_min`, `fall_enabled`, `fall_level`, `sync_interval`, `imei`, `phone`, `sn`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Em separação', NULL, NULL, NULL, 0, 1, 600, 1, 0, 5, '123123', '123123', '123123', '2023-06-05 19:34:10', '2023-06-06 21:05:43', NULL),
(2, 1, '512312', NULL, NULL, NULL, 0, 1, 900, 1, 0, 10, '123123', '123123123', '2112312112', '2023-06-06 21:05:03', '2023-06-06 21:05:03', NULL),
(3, 1, 'eqwe', NULL, NULL, NULL, 0, 1, 300, 1, 0, 8, '123123', '213123', '123123123', '2023-06-15 20:10:25', '2023-06-15 20:10:25', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User');

-- --------------------------------------------------------

--
-- Estrutura para tabela `healthplans`
--

CREATE TABLE `healthplans` (
  `id` int(11) NOT NULL,
  `pacient_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `coverage` varchar(255) DEFAULT NULL,
  `identification` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `healthplans`
--

INSERT INTO `healthplans` (`id`, `pacient_id`, `name`, `phone`, `coverage`, `identification`, `created_at`, `updated_at`, `deleted_at`) VALUES
(12, 1, 'qwe123', '(61) 2312-3122', 'one', 'qweqwe 123', '2023-05-28 21:04:00', '2023-06-12 19:43:26', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` varchar(512) NOT NULL,
  `title` varchar(512) NOT NULL,
  `description` varchar(512) NOT NULL,
  `message` varchar(512) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `icon` varchar(512) NOT NULL,
  `origin` int(11) NOT NULL,
  `status` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `type`, `title`, `description`, `message`, `created_at`, `icon`, `origin`, `status`) VALUES
(1, 1, 'Alert', 'Alerta', '45% less alerts last 4 weeks', 'Olá, sua conta foi inativada, por favor acesse www.suaconta.com.br', '2023-05-25 17:00:20', 'cafe-outline', 1, 'deleted'),
(2, 1, '', 'Notificação de teste', 'Esta é uma notificação de teste', '', '2023-05-25 19:43:21', '', 0, 'read'),
(3, 1, '', 'Notificação de teste', 'Esta é uma notificação de teste', '', '2023-05-25 19:43:21', '', 0, 'read'),
(4, 1, '', 'Notificação de teste', 'Esta é uma notificação de teste', '', '2023-05-25 19:43:21', '', 0, 'read'),
(5, 1, '', 'Notificação de teste', 'Esta é uma notificação de teste', '', '2023-05-25 19:43:21', '', 0, 'read'),
(6, 1, '', 'Notificação de teste', 'Esta é uma notificação de teste', '', '2023-05-25 19:43:21', '', 0, 'read'),
(7, 1, '', 'Notificação de teste', 'Esta é uma notificação de teste', '', '2023-05-25 19:43:21', '', 0, 'deleted'),
(8, 1, '', 'Notificação de teste', 'Esta é uma notificação de teste', '', '2023-05-25 19:43:21', '', 0, 'read'),
(9, 1, '', 'Notificação de teste', 'Esta é uma notificação de teste', '', '2023-05-25 19:43:21', '', 0, 'read'),
(10, 1, '', 'Notificação de teste', 'Esta é uma notificação de teste', '', '2023-05-25 19:43:21', '', 0, 'read'),
(11, 1, '', 'Notificação de teste', 'Esta é uma notificação de teste', '', '2023-05-25 19:43:21', '', 0, 'deleted');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pacients`
--

CREATE TABLE `pacients` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `cpf` varchar(14) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `pin` varchar(4) DEFAULT NULL,
  `zip` varchar(512) NOT NULL,
  `address` varchar(512) NOT NULL,
  `number` varchar(512) NOT NULL,
  `state` varchar(512) NOT NULL,
  `city` varchar(512) NOT NULL,
  `complement` varchar(512) NOT NULL,
  `bodyparams` blob NOT NULL,
  `extra_info` blob NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pacients`
--

INSERT INTO `pacients` (`id`, `name`, `birthdate`, `gender`, `cpf`, `phone`, `picture`, `email`, `pin`, `zip`, `address`, `number`, `state`, `city`, `complement`, `bodyparams`, `extra_info`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Pedro Noronha', '2023-05-16', 'Masculino', '05434961129', '5612312321', 'qwe', 'qwe', '1', 'qwe', 'qwe', 'qwe', '', '', '', 0x7b2274656d705f6d696e223a22313233222c2274656d705f6d6178223a22313233222c227369735f6d696e223a22313233222c227369735f6d6178223a22313233222c226469735f6d696e223a22313233313233222c226469735f6d6178223a22323133222c227361745f6d696e223a22313233222c227361745f6d6178223a22313233227d, 0x3c703e0d0a09323c2f703e0d0a, '2023-05-28 18:13:25', '2023-09-12 13:28:29', NULL),
(2, 'PEDRO HENRIQUE PONTES DE NORONHA', '1996-04-02', 'Masculino', '254.910.950-36', '61998009987', 'ddd9d-gdf.png', 'myserywork@gmail.com', '4431', '72304204', 'Qr 122 Cj 04 Cada', '05', 'Distrito Federal', 'Brasília', '123', '', '', '2023-07-03 16:16:03', '2023-07-03 16:16:03', NULL),
(3, 'Pedro Noronha', '2023-07-12', 'Feminino', '24788376172', '61998009987', NULL, 'pedromoriarty@hotmail.com', NULL, '70719-900', '', '', 'Amapá', 'Asa Norte', '', 0x7b2274656d705f6d696e223a2233342e35222c2274656d705f6d6178223a2233372e30222c227369735f6d696e223a22313233222c227369735f6d6178223a22313431222c226469735f6d696e223a223630222c226469735f6d6178223a22313030222c227361745f6d696e223a223938222c227361745f6d6178223a22313030227d, 0x31, '2023-07-03 16:23:09', '2023-07-03 16:25:55', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(254) NOT NULL,
  `activation_selector` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `forgotten_password_selector` varchar(255) DEFAULT NULL,
  `forgotten_password_code` varchar(255) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_selector` varchar(255) DEFAULT NULL,
  `remember_code` varchar(255) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `cpf` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `cpf`) VALUES
(1, '127.0.0.1', 'administrator', '$2y$10$50vIASSePN943X5zAZ2xcuhVazBYdx3JJUu2zDS7jv7pQXBzwCU.G', 'admin@admin.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1268889823, 1694525220, 1, 'Admin', 'nistrador', 'ADMIN', '0', '05434961129'),
(4, '', 'admin', '$2y$10$s0PbZLpAjCtU.LAlj7MGUOXaACN1M8/X.NJH./jAAIvMmbJRcxNFe', 'pedromoriarty@hotmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'Pedro', 'Noronha', 'ePrev Saúde', '61998009987', '512312312'),
(6, '', 'moriarty', '$2y$10$3OMJ2l7SRvzwHUgLiHllju1iA/qom9RbLNpx/ovcyCfwiDZN/9b9S', 'myserywork@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'PEDRO', 'DE NORONHA', 'ePrev Saúde', '61998009987', '512312312'),
(7, '', 'admin', '$2y$10$MzsmdyC1BZSbCBrUCOzIWuRbg9mXzvwcWMApHXw6K/PM8YiDLFJze', 'pedromoriar4ty@hotmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'Pedro', 'Noronha', 'ePrev Saúde', '61998009987', '213123'),
(8, '', 'pedromoriarty', '$2y$10$3ZVJx8eddzIpnZ1a/kcl6OcjKNesMwSf1j5FyAwJHmD4/posUU7y2', 'dota1234@live.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'qweqwe', 'qwe', 'qwe', 'qwe', 'qwe'),
(9, '', 'pedromoriarty123', 'dota1234', 'myserywork4@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'PEDRO', 'DE NORONHA', 'ePrev Saúde', '61998009987', '254.910.950-36'),
(10, '', 'pedromoriarty', '$2y$10$vYRmj0GU86GkQEl2YsXM3eSq7QzuywCmjvgIrhSPh22ga/yzH7j9.', 'my4serywork@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'PEDRO', 'DE NORONHA', 'my4serywork@gmail.com', '61998009987', '2312321');

-- --------------------------------------------------------

--
-- Estrutura para tabela `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 1, 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `user_params`
--

CREATE TABLE `user_params` (
  `id` int(11) NOT NULL,
  `pacient_id` int(11) DEFAULT NULL,
  `temp_min` float DEFAULT NULL,
  `temp_max` float DEFAULT NULL,
  `sis_min` int(11) DEFAULT NULL,
  `sis_max` int(11) DEFAULT NULL,
  `dis_min` int(11) DEFAULT NULL,
  `dis_max` int(11) DEFAULT NULL,
  `sat_min` int(11) DEFAULT NULL,
  `sat_max` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pacient_id` (`pacient_id`);

--
-- Índices de tabela `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pacient_id` (`pacient_id`);

--
-- Índices de tabela `custom_fields`
--
ALTER TABLE `custom_fields`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `custom_fields_categories`
--
ALTER TABLE `custom_fields_categories`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `custom_fields_values`
--
ALTER TABLE `custom_fields_values`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pacient_id` (`pacient_id`);

--
-- Índices de tabela `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `healthplans`
--
ALTER TABLE `healthplans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pacient_id` (`pacient_id`);

--
-- Índices de tabela `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `pacients`
--
ALTER TABLE `pacients`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_email` (`email`),
  ADD UNIQUE KEY `uc_activation_selector` (`activation_selector`),
  ADD UNIQUE KEY `uc_forgotten_password_selector` (`forgotten_password_selector`),
  ADD UNIQUE KEY `uc_remember_selector` (`remember_selector`);

--
-- Índices de tabela `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- Índices de tabela `user_params`
--
ALTER TABLE `user_params`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pacient_id` (`pacient_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `custom_fields`
--
ALTER TABLE `custom_fields`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de tabela `custom_fields_categories`
--
ALTER TABLE `custom_fields_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `custom_fields_values`
--
ALTER TABLE `custom_fields_values`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT de tabela `devices`
--
ALTER TABLE `devices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `healthplans`
--
ALTER TABLE `healthplans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `pacients`
--
ALTER TABLE `pacients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `user_params`
--
ALTER TABLE `user_params`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `attendances`
--
ALTER TABLE `attendances`
  ADD CONSTRAINT `attendances_ibfk_1` FOREIGN KEY (`pacient_id`) REFERENCES `pacients` (`id`);

--
-- Restrições para tabelas `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_ibfk_1` FOREIGN KEY (`pacient_id`) REFERENCES `pacients` (`id`);

--
-- Restrições para tabelas `devices`
--
ALTER TABLE `devices`
  ADD CONSTRAINT `devices_ibfk_1` FOREIGN KEY (`pacient_id`) REFERENCES `pacients` (`id`);

--
-- Restrições para tabelas `healthplans`
--
ALTER TABLE `healthplans`
  ADD CONSTRAINT `healthplans_ibfk_1` FOREIGN KEY (`pacient_id`) REFERENCES `pacients` (`id`);

--
-- Restrições para tabelas `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Restrições para tabelas `user_params`
--
ALTER TABLE `user_params`
  ADD CONSTRAINT `user_params_ibfk_1` FOREIGN KEY (`pacient_id`) REFERENCES `pacients` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
