-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 26/11/2024 às 20:55
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `clinica_odontologica`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `agendamentos`
--

CREATE TABLE `agendamentos` (
  `id` int(11) NOT NULL,
  `id_servico` int(11) NOT NULL,
  `data_agendamento` date NOT NULL,
  `horario` time DEFAULT NULL,
  `id_paciente` int(11) DEFAULT NULL,
  `status` enum('A Realizar','Atrasada','Concluída') DEFAULT 'A Realizar'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `agendamentos`
--

INSERT INTO `agendamentos` (`id`, `id_servico`, `data_agendamento`, `horario`, `id_paciente`, `status`) VALUES
(37, 3, '2024-11-28', '16:00:00', 6, 'A Realizar'),
(38, 3, '2024-11-28', '13:00:00', 6, 'A Realizar'),
(39, 3, '2024-11-25', '17:00:00', 6, 'A Realizar'),
(40, 3, '2024-11-25', '17:00:00', 6, 'A Realizar'),
(41, 5, '2024-11-26', '15:30:00', 6, 'A Realizar'),
(42, 1, '2024-11-25', '08:30:00', 21, 'A Realizar'),
(43, 1, '2024-11-25', '09:00:00', 21, 'A Realizar'),
(44, 1, '2024-11-25', '17:00:00', 21, 'A Realizar'),
(46, 1, '2024-11-29', '14:30:00', 22, 'A Realizar'),
(47, 1, '2024-11-29', '14:30:00', 22, 'A Realizar'),
(48, 1, '2024-11-29', '15:30:00', 22, 'A Realizar'),
(49, 6, '2024-11-28', '14:30:00', 23, 'A Realizar'),
(50, 6, '2024-11-28', '17:30:00', 23, 'A Realizar'),
(51, 6, '2024-11-28', '15:30:00', 23, 'A Realizar'),
(52, 6, '2024-11-28', '09:30:00', 23, 'A Realizar'),
(53, 5, '2024-11-27', '08:00:00', 24, 'A Realizar'),
(54, 5, '2024-11-27', '13:30:00', 24, 'A Realizar'),
(55, 5, '2024-11-27', '11:30:00', 24, 'A Realizar'),
(56, 5, '2024-12-30', '13:30:00', 24, 'A Realizar'),
(57, 5, '2024-12-25', '13:30:00', 24, 'A Realizar'),
(58, 5, '2025-01-23', '16:00:00', 24, 'A Realizar'),
(59, 4, '2024-11-28', '13:30:00', 25, 'A Realizar'),
(60, 4, '2025-01-23', '11:30:00', 25, 'A Realizar'),
(61, 4, '2024-11-27', '14:00:00', 25, 'A Realizar'),
(62, 7, '2024-11-28', '11:30:00', 27, 'A Realizar'),
(63, 7, '2024-11-29', '17:30:00', 27, 'A Realizar'),
(64, 7, '2024-11-29', '10:30:00', 27, 'A Realizar'),
(66, 2, '2024-11-26', '17:30:00', 28, 'A Realizar'),
(68, 2, '2024-11-29', '08:30:00', 28, 'A Realizar'),
(69, 2, '2024-11-27', '17:30:00', 28, 'A Realizar'),
(70, 5, '2024-11-27', '09:00:00', 29, 'A Realizar'),
(71, 5, '2024-11-27', '08:30:00', 29, 'A Realizar'),
(72, 5, '2024-11-28', '11:00:00', 29, 'A Realizar'),
(73, 7, '2024-11-28', '09:00:00', 29, 'A Realizar'),
(74, 7, '2024-11-28', '14:00:00', 29, 'A Realizar'),
(75, 7, '2024-11-29', '09:00:00', 29, 'A Realizar'),
(76, 7, '2024-11-28', '08:30:00', 29, 'A Realizar'),
(77, 5, '2024-11-28', '08:30:00', 29, 'A Realizar'),
(78, 4, '2024-11-29', '09:00:00', 30, 'A Realizar'),
(79, 1, '2024-11-29', '08:30:00', 33, 'A Realizar'),
(80, 2, '0000-00-00', '08:00:00', 34, 'Concluída'),
(81, 2, '2024-11-26', '08:00:00', 34, 'Concluída'),
(82, 2, '0000-00-00', '08:30:00', 34, 'Concluída'),
(83, 2, '0000-00-00', '15:00:00', 6, 'A Realizar');

-- --------------------------------------------------------

--
-- Estrutura para tabela `funcionarios`
--

CREATE TABLE `funcionarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `sexo` varchar(10) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `cpf` varchar(14) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `estado` varchar(17) DEFAULT NULL,
  `cidade` varchar(255) DEFAULT NULL,
  `bairro` varchar(20) DEFAULT NULL,
  `rua` varchar(55) DEFAULT NULL,
  `numero_residencia` int(11) DEFAULT NULL,
  `cep` varchar(9) DEFAULT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `cargo` varchar(100) DEFAULT NULL,
  `nivel` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `funcionarios`
--

INSERT INTO `funcionarios` (`id`, `nome`, `sexo`, `data_nascimento`, `cpf`, `senha`, `estado`, `cidade`, `bairro`, `rua`, `numero_residencia`, `cep`, `telefone`, `email`, `cargo`, `nivel`) VALUES
(1, 'Miguel Antonio Teixeira ', 'Masculino', '2006-08-29', '120.635.149-76', '81dc9bdb52d04dc20036dbd8313ed055', 'SC', 'Rua Pica-Pau 686', 'Aventureio', 'Alfred', 555, '45454-888', '(47) 99707-8168', 'admin@gmail.com', 'ADMINISTRADOR', 1),
(2, 'Aline Cristine Ferreira', 'Feminino', '1990-06-14', '074.090.309-84', '81dc9bdb52d04dc20036dbd8313ed055', 'SC', 'Rua dos Serralheiros', NULL, NULL, NULL, '45454-888', '(47) 99989-1570', 'alinecristine@gmail.com', 'ADMINISTRADOR', 1),
(3, 'Vinicius Manoel Souza', 'Masculino', '2006-09-07', '123.456.789-12', '81dc9bdb52d04dc20036dbd8313ed055', 'SC', 'Rua inventada 87', 'Bairro', 'Ruaa', 505, '45454-888', '(47) 99190-8640', 'dentista@gmail.com', 'Dentista', 3),
(4, 'Gabriel Pereira Ebertz', 'Masculino', '2004-08-17', '234.567.891-23', '81dc9bdb52d04dc20036dbd8313ed055', 'SC', 'Rua falsa 852', NULL, NULL, NULL, '45454-888', '(47) 99201-8003', 'secretario@gmail.com', 'Secretario', 2),
(51, 'Pessoa ', 'Feminino', '2024-11-04', '000.000.000-00', '202cb962ac59075b964b07152d234b70', 'RO', 'Cidade', 'Bairro', 'Rua', 54, '87458-581', '(99)99999-9999', 'contactmiguel0509@gmail.com', 'sim', 2),
(58, 'adoletaa', 'Feminino', '2024-11-12', '4', '37693cfc748049e45d87b8c7d8b9aacd', 'RS', 'asf', 'afs', 'af', 235, '252r3', '235', 'email@email.com', '23', 2),
(59, 'a', 'Feminino', '2024-11-12', '4', '37693cfc748049e45d87b8c7d8b9aacd', 'RS', 'asf', 'afs', 'af', 235, '252r3', '235', 'email@email.com', '23', 2),
(60, 'a', 'Feminino', '2024-11-12', '4', '37693cfc748049e45d87b8c7d8b9aacd', 'RS', 'asf', 'afs', 'af', 235, '252r3', '235', 'email@email.com', '23', 2),
(61, '[value-2]', '[value-3]', '0000-00-00', '[value-5]', '[value-6]', '[value-7]', '[value-8]', '[value-9]', '[value-10]', 0, '[value-12', '[value-13]', '[value-14]', '[value-15]', 0),
(62, 'a', 'Feminino', '2024-11-06', '000.000.000-00', '37693cfc748049e45d87b8c7d8b9aacd', 'DF', 'asf', 'Bairro', '23', 32, '232332232', '23232323232323', 'contactmiguel0509@gmail.com', '3232323232323232', 3),
(63, 'a', 'Feminino', '2024-11-06', '000.000.000-00', '37693cfc748049e45d87b8c7d8b9aacd', 'DF', 'asf', 'Bairro', '23', 32, '232332232', '23232323232323', 'contactmiguel0509@gmail.com', '3232323232323232', 3),
(65, 'Pessoa Ficticia', 'Feminino', '2024-10-31', '000.000.000-00', '37693cfc748049e45d87b8c7d8b9aacd', 'ES', 'Cidade', 'Bairro', 'Rua', 2, '87458-585', '(99)99999-9999', 'vitoradriano1601@gmail.com', 'secretario', 2),
(66, '[value-2]', '[value-3]', '0000-00-00', '[value-5]', '[value-6]', '[value-7]', '[value-8]', '[value-9]', '[value-10]', 0, '[value-12', '[value-13]', '[value-14]', '[value-15]', 0),
(67, '[value-2]', '[value-3]', '0000-00-00', '[value-5]', '[value-6]', '[value-7]', '[value-8]', '[value-9]', '[value-10]', 0, '[value-12', '[value-13]', '[value-14]', '[value-15]', 0),
(68, 'Pessoa Ficticia', 'Masculino', '2000-09-05', '6556555555555', 'bcbe3365e6ac95ea2c0343a2395834dd', 'RS', 'Cidade', 'Bairro', 'Rua', 1, '88888-888', '888888888888', 'a@g.a', 'secretario', 2),
(69, 'Pessoa Ficticia', 'Masculino', '2000-09-05', '6556555555555', 'bcbe3365e6ac95ea2c0343a2395834dd', 'RS', 'Cidade', 'Bairro', 'Rua', 1, '88888-888', '888888888888', 'a@g.a', 'secretario', 2),
(70, 'Pessoa Ficticia', 'Masculino', '2000-09-05', '6556555555555', 'bcbe3365e6ac95ea2c0343a2395834dd', 'RS', 'Cidade', 'Bairro', 'Rua', 1, '88888-888', '888888888888', 'a@g.a', 'secretario', 2),
(71, 'Pessoa Ficticia', 'Masculino', '2000-09-05', '6556555555555', 'bcbe3365e6ac95ea2c0343a2395834dd', 'RS', 'Cidade', 'Bairro', 'Rua', 1, '88888-888', '888888888888', 'a@g.a', 'secretario', 2),
(72, 'Pessoa Ficticia', 'Masculino', '2000-09-05', '6556555555555', 'bcbe3365e6ac95ea2c0343a2395834dd', 'RS', 'Cidade', 'Bairro', 'Rua', 1, '88888-888', '888888888888', 'a@g.a', 'secretario', 2),
(73, 'Pessoa Ficticia', 'Masculino', '2000-09-05', '6556555555555', 'bcbe3365e6ac95ea2c0343a2395834dd', 'RS', 'Cidade', 'Bairro', 'Rua', 1, '88888-888', '888888888888', 'a@g.a', 'secretario', 1),
(74, 'Pessoa Ficticia', 'Masculino', '2000-09-05', '6556555555555', '81dc9bdb52d04dc20036dbd8313ed055', 'RS', 'Cidade', 'Bairro', 'Rua', 1, '88888-888', '888888888888', 'a@gmail.com', 'Secretario', 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `pacientes`
--

CREATE TABLE `pacientes` (
  `id_paciente` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `sexo` enum('masculino','feminino','N/A') NOT NULL DEFAULT 'N/A',
  `data_nascimento` date NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `estado` char(2) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `rua` varchar(150) NOT NULL,
  `numero_residencia` varchar(10) NOT NULL,
  `cep` varchar(9) NOT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pacientes`
--

INSERT INTO `pacientes` (`id_paciente`, `nome`, `sexo`, `data_nascimento`, `cpf`, `estado`, `cidade`, `bairro`, `rua`, `numero_residencia`, `cep`, `telefone`, `email`) VALUES
(1, 'a', 'masculino', '2222-02-22', '2', '2', '2', '2', '2', '2', '2', '+22 22 222222-2', 'a@g.c'),
(2, '2', '', '2222-02-22', '2', '2', '22', '2', '22', '22', '2', '2', 'contactmiguel0509@gmail.com'),
(3, 'a', '', '0002-02-02', '2', 'a', 'a', 'a', 'a', '2', '2', '2', 'a@g.c'),
(5, 'a', '', '0002-02-02', '21', 'a', 'a', 'a', 'a', '2', '2', '2', 'contactmiguel0509@gmail.com'),
(6, 'a', '', '0002-02-02', '120.635.149-76', 'a', 'a', 'a', 'a', '2', '2', '2', 'contactmiguel0509@gmail.com'),
(7, 'a', '', '2024-11-14', '222.222.222-22', 'a', 'a', 'a', 'a', '2', '2', '+99 99 9999999', 'contactmiguel0509@gmail.com'),
(8, 'a', '', '2024-11-14', '222.222.225', 'a', 'a', 'a', 'a', '2', '2', '+99 99 9999999', 'contactmiguel0509@gmail.com'),
(10, 'Pessoa Ficticia', '', '2024-10-29', '120.555.555-55', 'a', 'a', 'a', 'a', '2242', '11111-111', '+55 47 99707-81', 'contactmiguel0509@gmail.com'),
(11, 'Pessoa Ficticia', '', '2024-10-29', '120.555.555-5', 'a', 'a', 'a', 'a', '2242', '11111-111', '+55 47 99707-81', 'contactmiguel0509@gmail.com'),
(12, 'Pessoa Ficticia', '', '2024-10-29', '120.555.555-57', 'a', 'a', 'a', 'a', '2242', '11111-111', '+55 47 99707-81', 'contactmiguel0509@gmail.com'),
(13, 'Miguel', '', '2024-10-30', '98', 'a', 'a', 'a', 'a', '32', '23', '+22 22 222222-2', 'vitoradriano1601@gmail.com'),
(14, 'Miguel', '', '2024-10-30', '985', 'a', 'a', 'a', 'a', '32', '23', '+22 22 222222-2', 'vitoradriano1601@gmail.com'),
(15, 'Miguel', '', '2024-10-30', '985.5', 'a', 'a', 'a', 'a', '32', '23', '+22 22 222222-2', 'vitoradriano1601@gmail.com'),
(16, 'Miguel', 'masculino', '2024-10-30', '985.54', 'a', 'a', 'a', 'a', '32', '23', '+22 22 222222-2', 'vitoradriano1601@gmail.com'),
(17, 'Miguel', 'feminino', '2024-10-30', '985.544', 'a', 'a', 'a', 'a', '32', '23', '+22 22 222222-2', 'vitoradriano1601@gmail.com'),
(18, 'Miguel', '', '2024-10-30', '985.544.4', 'a', 'a', 'a', 'a', '32', '23', '+22 22 222222-2', 'vitoradriano1601@gmail.com'),
(19, 'Miguel', '', '2024-10-30', '985.544.477-7', 'a', 'a', 'a', 'a', '32', '23', '+22 22 222222-2', 'vitoradriano1601@gmail.com'),
(20, 'a', '', '2024-11-19', '224.44', 'a', 'a', 'a', 'a', '2', '2', '+24 42', 'vitoradriano1601@gmail.com'),
(21, 'rose', 'feminino', '1969-07-08', '888.888.888-88', 'sc', 'joiinvlle', 'mmmm', '85858', '9566', '87458-585', '+66 66 665', 'rozeadriano@hotmail.com'),
(22, 'a', 'masculino', '2024-11-11', '211.1', 'a', 'a', 'a', 'a', '2', '42', '2', 'a@g.c'),
(23, 'a', 'N/A', '2024-10-29', '0', 'a', 'a', 'a', 'a', '2', '52525-2', '2', 'contactmiguel0509@gmail.com'),
(24, 'a', 'masculino', '2024-11-14', '244.242', 'a', 'a', 'a', 'a', '255', '5', '+22 22 22222-22', 'vitoradriano1601@gmail.com'),
(25, 'a', 'masculino', '2024-11-11', '242.245.252-52', 'a', 'a', '1', 'a', '1', '1', '24', 'vitoradriano1601@gmail.com'),
(26, '2asd', 'N/A', '2024-11-11', '4', 'a', 'a', 'a', 'a', '24', '5', '+22 22 22222-22', 'vitoradriano1601@gmail.com'),
(27, 'a', 'feminino', '2024-11-04', '222.344.2', 'a', 'a', 'a', 'a', '42', '234', '2', 'a@g.c'),
(28, 'a', 'masculino', '2003-09-05', '123.456.789-00', 'a', 'a', 'a', 'a', '23', '87458-585', '+55 47 99707-81', 'email@teste.com'),
(29, 'Pessoa Ficticia', 'feminino', '2024-11-13', '000.000.000-00', 'a', 'Cidade', 'Bairro', 'a', '1', '42444-444', '+22 22 22222-22', 'contactmiguel0509@gmail.com'),
(30, 'Pessoa Ficticia', 'feminino', '2007-06-11', '999.999.999-99', 'Es', 'Cidade', 'Bairro', 'Rua', '1', '22222-222', '+55 47 12345-67', 'teste@gmail.com'),
(31, 'Santigo', 'masculino', '2000-08-05', '134.232.354-53', 'SC', 'ciadade', 'bairro', 'rua', '87', '89484-984', '84 84984-88849', 'Contatao@gmac.com'),
(32, 'Santigo', 'masculino', '2000-08-05', '134.232.354-5', 'SC', 'ciadade', 'bairro', 'rua', '87', '89484-984', '84 84984-88849', 'Contatao@gmac.co'),
(33, 'Pessoa F', 'masculino', '2024-10-29', '224.424.242-42', 'a', 'a', 'a', 'a', '2', '24242-442', '+22 22 22222-22', 'admin@gmail.com'),
(34, 'Pessoa Ficti', 'masculino', '4242-04-22', '444', 'a', 'a', 'a', 'a', '4', '44242-424', '+24 42 42424242', 'secretario@gmail.com');

-- --------------------------------------------------------

--
-- Estrutura para tabela `prontuarios`
--

CREATE TABLE `prontuarios` (
  `id` int(11) NOT NULL,
  `id_agendamento` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `id_servico` int(11) NOT NULL,
  `uso_anestesia` enum('sim','nao') NOT NULL,
  `sangramento` enum('sim','nao') NOT NULL,
  `alergia` enum('sim','nao') NOT NULL,
  `alergia_qual` varchar(255) DEFAULT NULL,
  `higiene` enum('normal','regular','ruim') NOT NULL,
  `tartaro` enum('ausente','pouco','muito') NOT NULL,
  `gengiva` enum('normal','gengivite','periodontite') NOT NULL,
  `mucosa` enum('normal','alterada') NOT NULL,
  `halitose` enum('ausente','moderada','forte') NOT NULL,
  `observacoes` text DEFAULT NULL,
  `doenca_metabolica` enum('Sim','Não') NOT NULL DEFAULT 'Não',
  `doenca_cardiaca` enum('Sim','Não') NOT NULL DEFAULT 'Não',
  `doenca_respiratoria` enum('Sim','Não') NOT NULL DEFAULT 'Não',
  `doenca_vascular` enum('Sim','Não') NOT NULL DEFAULT 'Não',
  `doenca_neurologica` enum('Sim','Não') NOT NULL DEFAULT 'Não',
  `doenca_gastrointestinal` enum('Sim','Não') NOT NULL DEFAULT 'Não',
  `doenca_visual` enum('Sim','Não') NOT NULL DEFAULT 'Não',
  `doenca_endocrina` enum('Sim','Não') NOT NULL DEFAULT 'Não',
  `diabetes` enum('Sim','Não') NOT NULL DEFAULT 'Não',
  `hipertensao` enum('Sim','Não') NOT NULL DEFAULT 'Não',
  `neoplasias` enum('Sim','Não') NOT NULL DEFAULT 'Não'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `prontuarios`
--

INSERT INTO `prontuarios` (`id`, `id_agendamento`, `id_paciente`, `id_servico`, `uso_anestesia`, `sangramento`, `alergia`, `alergia_qual`, `higiene`, `tartaro`, `gengiva`, `mucosa`, `halitose`, `observacoes`, `doenca_metabolica`, `doenca_cardiaca`, `doenca_respiratoria`, `doenca_vascular`, `doenca_neurologica`, `doenca_gastrointestinal`, `doenca_visual`, `doenca_endocrina`, `diabetes`, `hipertensao`, `neoplasias`) VALUES
(1, 66, 28, 5, 'nao', 'nao', 'nao', NULL, 'normal', 'ausente', 'normal', 'normal', 'ausente', '', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não'),
(2, 81, 34, 7, 'sim', 'nao', 'sim', NULL, '', 'ausente', 'normal', 'normal', 'ausente', 'teste de Campo de Observação', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não'),
(3, 81, 34, 7, 'sim', 'nao', 'sim', NULL, '', 'ausente', 'normal', 'normal', 'ausente', 'teste de Campo de Observação', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não'),
(4, 81, 34, 7, 'sim', 'nao', 'sim', NULL, '', 'ausente', 'normal', 'normal', 'ausente', 'teste de Campo de Observação', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não'),
(5, 81, 34, 7, 'sim', 'nao', 'sim', NULL, '', 'ausente', 'gengivite', 'normal', 'ausente', 'teste de Campo de Observação', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não'),
(6, 81, 34, 7, 'sim', 'nao', 'sim', NULL, '', 'ausente', 'gengivite', 'normal', 'ausente', 'teste de Campo de Observação', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não'),
(7, 81, 34, 7, 'nao', 'nao', 'nao', NULL, 'normal', 'ausente', 'normal', 'normal', 'ausente', '', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não'),
(8, 81, 34, 2, 'nao', 'nao', 'nao', NULL, 'normal', 'ausente', 'normal', 'normal', 'ausente', '', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não'),
(9, 81, 34, 2, 'nao', 'nao', 'nao', NULL, 'normal', 'ausente', 'normal', 'normal', 'ausente', '', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não'),
(10, 81, 34, 7, 'nao', 'nao', 'nao', NULL, 'normal', 'ausente', 'normal', 'normal', 'ausente', '', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não'),
(11, 81, 34, 2, 'nao', 'nao', 'nao', '', 'normal', 'ausente', 'normal', '', '', '', 'Não', 'Não', 'Sim', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não'),
(12, 81, 34, 7, 'sim', 'sim', 'sim', 'ALERGIA TESTE', '', 'pouco', 'periodontite', '', '', 'OBSERVAÇÂO TESTE', 'Não', 'Não', 'Sim', 'Não', 'Não', 'Não', 'Sim', 'Sim', 'Não', 'Não', 'Não'),
(13, 81, 34, 7, 'sim', 'sim', 'sim', 'ALERGIA TESTE', '', 'pouco', 'periodontite', '', '', 'OBSERVAÇÂO TESTE', 'Não', 'Não', 'Sim', 'Não', 'Não', 'Não', 'Sim', 'Sim', 'Não', 'Não', 'Não'),
(14, 81, 34, 7, 'sim', 'sim', 'sim', 'ALERGIA TESTE', '', 'pouco', 'periodontite', '', '', 'OBSERVAÇÂO TESTE', 'Não', 'Não', 'Sim', 'Não', 'Não', 'Não', 'Sim', 'Sim', 'Não', 'Não', 'Não'),
(15, 81, 34, 1, 'nao', 'nao', 'nao', '', 'normal', 'ausente', 'normal', '', '', '', 'Não', 'Não', 'Não', 'Não', 'Sim', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não'),
(16, 81, 34, 1, 'nao', 'nao', 'nao', '', 'normal', 'ausente', 'normal', '', '', '', 'Não', 'Não', 'Não', 'Não', 'Sim', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não'),
(17, 66, 28, 2, 'nao', 'nao', 'nao', '', 'normal', 'ausente', 'normal', '', '', '', 'Não', 'Não', 'Não', 'Não', 'Não', 'Sim', 'Não', 'Não', 'Não', 'Não', 'Não'),
(18, 81, 34, 2, 'nao', 'nao', 'nao', '', 'normal', 'ausente', 'normal', '', '', '', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Sim', 'Não', 'Não', 'Não'),
(19, 66, 28, 2, 'nao', 'nao', 'nao', '', 'normal', 'ausente', 'normal', '', '', '', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Sim', 'Não', 'Não', 'Não', 'Não'),
(20, 81, 34, 2, 'nao', 'nao', 'nao', '', 'normal', 'ausente', 'normal', '', '', '', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não'),
(21, 81, 34, 2, 'nao', 'nao', 'nao', '', 'normal', 'ausente', 'normal', '', '', '', 'Não', 'Não', 'Não', 'Não', 'Sim', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não');

-- --------------------------------------------------------

--
-- Estrutura para tabela `servicos`
--

CREATE TABLE `servicos` (
  `id_servico` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `descricao` varchar(255) NOT NULL,
  `valor` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `servicos`
--

INSERT INTO `servicos` (`id_servico`, `nome`, `descricao`, `valor`) VALUES
(1, 'Limpeza Dentaria', 'A limpeza dentária é essencial para a saúde bucal. Nossa equipe realiza profilaxia, removendo placa, tártaro e manchas, prevenindo cáries e doenças gengivais. Agende sua consulta e tenha um sorriso saudável!', '385.00'),
(2, 'Clareamento Dental', 'O clareamento dental proporciona dentes mais brancos e um sorriso saudável. Realizado com técnicas seguras e eficazes, sem causar danos ao esmalte dental.', '750.00'),
(3, 'Tratamento de Canal', 'O tratamento de canal é indicado para eliminar infecções na raiz do dente, prevenindo problemas mais graves e mantendo a saúde do dente afetado.', '950.00'),
(4, 'Implantes Dentários', 'Os implantes dentários são uma solução eficaz para substituição de dentes perdidos, proporcionando uma aparência natural e restaurando a função mastigatória.', '2500.00'),
(5, 'Prótese Dentária', 'As próteses dentárias são usadas para substituir dentes perdidos. Elas oferecem uma solução confortável e esteticamente agradável, com fixação segura.', '1.200.00'),
(6, 'Limpeza de Tártaro', 'A limpeza de tártaro remove o acúmulo de placa bacteriana e tártaro nos dentes, prevenindo gengivite e outras doenças bucais.', '150.00'),
(7, 'Ortodontia', 'A ortodontia corrige dentes e mandíbulas desalinhados, melhorando estética e funcionalidade. Com aparelhos modernos e confortáveis, garantimos um sorriso mais bonito e saudável. Agende sua consulta e conquiste o sorriso dos seus sonhos!', '2000.00'),
(8, 'Extração de Dente', 'Remoção de dentes que não podem ser salvos devido a cáries graves, infecções ou outros problemas.', '250,00');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `agendamentos`
--
ALTER TABLE `agendamentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_servico` (`id_servico`),
  ADD KEY `fk_id_paciente` (`id_paciente`);

--
-- Índices de tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id_paciente`);

--
-- Índices de tabela `prontuarios`
--
ALTER TABLE `prontuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_agendamento` (`id_agendamento`),
  ADD KEY `id_paciente` (`id_paciente`),
  ADD KEY `id_servico` (`id_servico`);

--
-- Índices de tabela `servicos`
--
ALTER TABLE `servicos`
  ADD PRIMARY KEY (`id_servico`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `agendamentos`
--
ALTER TABLE `agendamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT de tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT de tabela `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id_paciente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de tabela `prontuarios`
--
ALTER TABLE `prontuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `servicos`
--
ALTER TABLE `servicos`
  MODIFY `id_servico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `agendamentos`
--
ALTER TABLE `agendamentos`
  ADD CONSTRAINT `agendamentos_ibfk_1` FOREIGN KEY (`id_servico`) REFERENCES `servicos` (`id_servico`),
  ADD CONSTRAINT `fk_id_paciente` FOREIGN KEY (`id_paciente`) REFERENCES `pacientes` (`id_paciente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `prontuarios`
--
ALTER TABLE `prontuarios`
  ADD CONSTRAINT `prontuarios_ibfk_1` FOREIGN KEY (`id_agendamento`) REFERENCES `agendamentos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `prontuarios_ibfk_2` FOREIGN KEY (`id_paciente`) REFERENCES `pacientes` (`id_paciente`),
  ADD CONSTRAINT `prontuarios_ibfk_3` FOREIGN KEY (`id_servico`) REFERENCES `servicos` (`id_servico`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
