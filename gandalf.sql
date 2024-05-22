-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 30-Abr-2024 às 20:52
-- Versão do servidor: 10.4.11-MariaDB
-- versão do PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `gandalf`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `contatos`
--

CREATE TABLE `contatos` (
  `id` int(11) NOT NULL,
  `paciente_id` varchar(1024) NOT NULL,
  `relacao` varchar(1024) NOT NULL,
  `telefone` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `doencascronicas`
--

CREATE TABLE `doencascronicas` (
  `id` int(11) NOT NULL,
  `nome` varchar(512) NOT NULL,
  `descricao` varchar(1024) NOT NULL,
  `foto` varchar(1024) NOT NULL,
  `habilitada` tinyint(1) NOT NULL,
  `tipo` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User');

-- --------------------------------------------------------

--
-- Estrutura da tabela `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `login_attempts`
--

INSERT INTO `login_attempts` (`id`, `ip_address`, `login`, `time`) VALUES
(12, '127.0.0.1', 'myserywork@gmail.com', 1714478147);

-- --------------------------------------------------------

--
-- Estrutura da tabela `notifications`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `notifications`
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
-- Estrutura da tabela `pacientes`
--

CREATE TABLE `pacientes` (
  `id` int(11) NOT NULL,
  `nome` varchar(512) DEFAULT NULL,
  `genero` varchar(20) DEFAULT NULL,
  `dataNascimento` date DEFAULT NULL,
  `foto` varchar(1024) DEFAULT NULL,
  `cpf` varchar(15) DEFAULT NULL,
  `rg` varchar(15) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `naturalidade` varchar(128) DEFAULT NULL,
  `peso` varchar(14) DEFAULT NULL,
  `altura` varchar(14) DEFAULT NULL,
  `pin` varchar(1024) DEFAULT NULL,
  `cep` varchar(512) DEFAULT NULL,
  `endereco` varchar(512) DEFAULT NULL,
  `numero` varchar(512) DEFAULT NULL,
  `estado` varchar(512) DEFAULT NULL,
  `cidade` varchar(512) DEFAULT NULL,
  `complemento` varchar(512) DEFAULT NULL,
  `estadoCivil` varchar(512) DEFAULT NULL,
  `profissaoAtual` varchar(512) DEFAULT NULL,
  `profissaoAnterior` varchar(512) DEFAULT NULL,
  `observacoes` varchar(1024) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `pacientes`
--

INSERT INTO `pacientes` (`id`, `nome`, `genero`, `dataNascimento`, `foto`, `cpf`, `rg`, `email`, `naturalidade`, `peso`, `altura`, `pin`, `cep`, `endereco`, `numero`, `estado`, `cidade`, `complemento`, `estadoCivil`, `profissaoAtual`, `profissaoAnterior`, `observacoes`, `created_at`, `deleted_at`) VALUES
(1, 'João Silva', 'Masculino', '1990-01-15', 'assets/images/products/01.png', '123.456.789-00', 'MG-12.345.678', 'joao.silva@email.com', 'Brasileira', '80kg', '1.80m', 'pin_1234', '31000-000', 'Rua dos Bobos', '0', 'MG', 'Belo Horizonte', 'Apto 101', 'Casado', 'Engenheiro', 'Técnico', 'Nenhuma', '2024-04-30 10:48:34', NULL),
(2, 'Maria Oliveira', 'Feminino', '1985-07-20', 'assets/images/products/01.png', '987.654.321-00', 'SP-98.765.432', 'maria.oliveira@email.com', 'Brasileira', '65kg', '1.65m', 'pin_5678', '02000-000', 'Av. Paulista', '1000', 'SP', 'São Paulo', 'Casa', 'Solteira', 'Advogada', 'Estudante', 'Alergia a penicilina', '2024-04-30 10:48:34', NULL),
(3, 'Carlos Pereira', 'Masculino', '1972-05-30', 'assets/images/products/01.png', '111.222.333-44', 'RJ-22.333.444', 'carlos.pereira@email.com', 'Brasileira', '90kg', '1.75m', 'pin_91011', '22000-000', 'Rua Voluntários da Pátria', '200', 'RJ', 'Rio de Janeiro', 'Bloco B', 'Divorciado', 'Médico', 'Enfermeiro', 'Diabético', '2024-04-30 10:48:34', NULL),
(4, 'Ana Costa', 'Feminino', '1995-12-10', 'assets/images/products/01.png', '444.555.666-77', 'ES-55.666.777', 'ana.costa@email.com', 'Brasileira', '70kg', '1.70m', 'pin_121314', '29000-000', 'Av. Vitória', '300', 'ES', 'Vitória', 'Sem complemento', 'Solteira', 'Professora', 'Bibliotecária', 'Vegana', '2024-04-30 10:48:34', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `paciente_data`
--

CREATE TABLE `paciente_data` (
  `id` int(11) NOT NULL,
  `paciente_id` int(11) NOT NULL,
  `data` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `paciente_doencas`
--

CREATE TABLE `paciente_doencas` (
  `id` int(11) NOT NULL,
  `paciente_id` int(11) NOT NULL,
  `doenca_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `observacao` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `sintomas`
--

CREATE TABLE `sintomas` (
  `id` int(11) NOT NULL,
  `doencaId` int(11) NOT NULL,
  `titulo` varchar(1024) NOT NULL,
  `pergunta` varchar(1024) NOT NULL,
  `recomendacao` varchar(2048) NOT NULL,
  `opcoes` varchar(1024) NOT NULL,
  `habilitada` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `cpf`) VALUES
(1, '127.0.0.1', 'administrator', '$2y$10$50vIASSePN943X5zAZ2xcuhVazBYdx3JJUu2zDS7jv7pQXBzwCU.G', 'admin@admin.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1268889823, 1714496036, 1, 'Admin', 'nistrador', 'ADMIN', '0', '05434961129'),
(4, '', 'admin', '$2y$10$s0PbZLpAjCtU.LAlj7MGUOXaACN1M8/X.NJH./jAAIvMmbJRcxNFe', 'pedromoriarty@hotmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'Pedro', 'Noronha', 'ePrev Saúde', '61998009987', '512312312'),
(6, '', 'moriarty', '$2y$10$3OMJ2l7SRvzwHUgLiHllju1iA/qom9RbLNpx/ovcyCfwiDZN/9b9S', 'myserywork@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'PEDRO', 'DE NORONHA', 'ePrev Saúde', '61998009987', '512312312'),
(7, '', 'admin', '$2y$10$MzsmdyC1BZSbCBrUCOzIWuRbg9mXzvwcWMApHXw6K/PM8YiDLFJze', 'pedromoriar4ty@hotmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'Pedro', 'Noronha', 'ePrev Saúde', '61998009987', '213123'),
(8, '', 'pedromoriarty', '$2y$10$3ZVJx8eddzIpnZ1a/kcl6OcjKNesMwSf1j5FyAwJHmD4/posUU7y2', 'dota1234@live.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'qweqwe', 'qwe', 'qwe', 'qwe', 'qwe'),
(9, '', 'pedromoriarty123', 'dota1234', 'myserywork4@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'PEDRO', 'DE NORONHA', 'ePrev Saúde', '61998009987', '254.910.950-36'),
(10, '', 'pedromoriarty', '$2y$10$vYRmj0GU86GkQEl2YsXM3eSq7QzuywCmjvgIrhSPh22ga/yzH7j9.', 'my4serywork@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'PEDRO', 'DE NORONHA', 'my4serywork@gmail.com', '61998009987', '2312321');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 1, 2);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `contatos`
--
ALTER TABLE `contatos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `doencascronicas`
--
ALTER TABLE `doencascronicas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `paciente_data`
--
ALTER TABLE `paciente_data`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `paciente_doencas`
--
ALTER TABLE `paciente_doencas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `sintomas`
--
ALTER TABLE `sintomas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_email` (`email`),
  ADD UNIQUE KEY `uc_activation_selector` (`activation_selector`),
  ADD UNIQUE KEY `uc_forgotten_password_selector` (`forgotten_password_selector`),
  ADD UNIQUE KEY `uc_remember_selector` (`remember_selector`);

--
-- Índices para tabela `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `contatos`
--
ALTER TABLE `contatos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `doencascronicas`
--
ALTER TABLE `doencascronicas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `paciente_data`
--
ALTER TABLE `paciente_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `paciente_doencas`
--
ALTER TABLE `paciente_doencas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `sintomas`
--
ALTER TABLE `sintomas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
