-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 24-Jun-2024 às 04:13
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `trabintegrador`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `agenda`
--

CREATE TABLE `agenda` (
  `age_cod` int(11) NOT NULL,
  `usu_cod` int(11) DEFAULT NULL,
  `age_titulo` text DEFAULT NULL,
  `age_descricao` text DEFAULT NULL,
  `vei_cod` int(11) DEFAULT NULL,
  `age_hora_ini` varchar(100) DEFAULT NULL,
  `age_hora_fim` varchar(100) DEFAULT NULL,
  `cid_cod` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cidade`
--

CREATE TABLE `cidade` (
  `cid_cod` int(11) NOT NULL,
  `cid_nome` varchar(100) NOT NULL,
  `est_uf` varchar(2) NOT NULL,
  `cid_situacao` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `cidade`
--

INSERT INTO `cidade` (`cid_cod`, `cid_nome`, `est_uf`, `cid_situacao`) VALUES
(1, 'AGUAS DE CHAPECÓ', 'SC', 1),
(2, 'AGUAS FRIAS', 'SC', 1),
(3, 'ARVOREDO', 'SC', 1),
(4, 'CAXAMBÚ DO SUL', 'SC', 1),
(5, 'CHAPECÓ', 'SC', 1),
(6, 'CORDILHEIRA ALTA', 'SC', 1),
(7, 'CORONEL FREITAS', 'SC', 1),
(8, 'FORMOSA DO SUL', 'SC', 1),
(9, 'GUATAMBU', 'SC', 1),
(10, 'JARDINÓPOLIS', 'SC', 1),
(11, 'NOVA ERECHIM', 'SC', 1),
(12, 'NOVA ITABERABA', 'SC', 1),
(13, 'PAIAL', 'SC', 1),
(14, 'PINHALZINHO', 'SC', 1),
(15, 'PLANALTO ALEGRE', 'SC', 1),
(16, 'SANTIAGO DO SUL', 'SC', 1),
(17, 'SERRA ALTA', 'SC', 1),
(18, 'SUL BRASIL', 'SC', 1),
(19, 'SÃO CARLOS', 'SC', 1),
(20, 'UNIÃO DO OESTE', 'SC', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario`
--

CREATE TABLE `funcionario` (
  `fun_cod` int(11) NOT NULL,
  `fun_nome` varchar(100) DEFAULT NULL,
  `fun_cargo` varchar(30) DEFAULT NULL,
  `set_cod` int(11) NOT NULL,
  `fun_tel` int(11) DEFAULT NULL,
  `fun_mail` varchar(100) DEFAULT NULL,
  `usu_cod` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `funcionario`
--

INSERT INTO `funcionario` (`fun_cod`, `fun_nome`, `fun_cargo`, `set_cod`, `fun_tel`, `fun_mail`, `usu_cod`) VALUES
(1, 'funcionario', NULL, 1, NULL, 'funcionario@gmail.com', 7);

-- --------------------------------------------------------

--
-- Estrutura da tabela `setor`
--

CREATE TABLE `setor` (
  `set_cod` int(11) NOT NULL,
  `set_nome` text DEFAULT NULL,
  `set_descricao` text DEFAULT NULL,
  `set_situacao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `setor`
--

INSERT INTO `setor` (`set_cod`, `set_nome`, `set_descricao`, `set_situacao`) VALUES
(1, 'Informática', 'Informática', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `solicitacao`
--

CREATE TABLE `solicitacao` (
  `sol_cod` int(11) NOT NULL,
  `set_cod` int(11) NOT NULL,
  `cli_cod` int(11) NOT NULL,
  `sol_data` date DEFAULT NULL,
  `sol_status` int(11) NOT NULL DEFAULT 0 COMMENT '0-pendente, 1-andamento, 2-concluido, 3-cancelado',
  `sol_descricao` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `to_do_list`
--

CREATE TABLE `to_do_list` (
  `td_cod` int(11) NOT NULL,
  `td_texto` text DEFAULT NULL,
  `td_stts` text DEFAULT NULL,
  `td_data` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `usu_cod` int(11) NOT NULL,
  `usu_nome` varchar(100) NOT NULL,
  `usu_login` varchar(50) NOT NULL,
  `usu_senha` varchar(2000) NOT NULL,
  `usu_email` varchar(200) DEFAULT NULL,
  `upe_cod` int(11) NOT NULL COMMENT 'usuario_permissao',
  `usu_situacao` int(11) NOT NULL DEFAULT 1,
  `set_cod` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`usu_cod`, `usu_nome`, `usu_login`, `usu_senha`, `usu_email`, `upe_cod`, `usu_situacao`, `set_cod`) VALUES
(7, 'ADMIN', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@gmail.com', 1, 1, 1),
(8, 'FUNCIONARIO', 'funcionario', 'cc7a84634199040d54376793842fe035', 'funcionario@gmail.com', 2, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario_permissao`
--

CREATE TABLE `usuario_permissao` (
  `upe_cod` int(11) NOT NULL,
  `upe_descricao` varchar(30) NOT NULL,
  `upe_situacao` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `usuario_permissao`
--

INSERT INTO `usuario_permissao` (`upe_cod`, `upe_descricao`, `upe_situacao`) VALUES
(1, 'Administrador', 1),
(2, 'Funcionário', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `veiculo`
--

CREATE TABLE `veiculo` (
  `vei_cod` int(11) NOT NULL,
  `vei_nome` varchar(40) NOT NULL,
  `vei_placa` varchar(7) NOT NULL,
  `vei_situacao` int(11) NOT NULL DEFAULT 1,
  `vei_cor` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `veiculo`
--

INSERT INTO `veiculo` (`vei_cod`, `vei_nome`, `vei_placa`, `vei_situacao`, `vei_cor`) VALUES
(1, 'VOLKSWAGEN GOL', 'IPV4T43', 1, '#ecf000'),
(2, 'CHEVROLET CORSA', 'GRE-321', 1, '#e40101');

-- --------------------------------------------------------

--
-- Estrutura da tabela `viagem`
--

CREATE TABLE `viagem` (
  `via_cod` int(11) NOT NULL,
  `age_cod` int(11) NOT NULL,
  `via_km_inicial` int(11) DEFAULT NULL,
  `via_km_final` int(11) DEFAULT NULL,
  `via_gastos` varchar(500) DEFAULT NULL,
  `via_observacoes` varchar(500) DEFAULT NULL,
  `via_preenchido` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`age_cod`),
  ADD KEY `fk_agenda_usuario` (`usu_cod`),
  ADD KEY `fk_agenda_veiculo` (`vei_cod`),
  ADD KEY `fk_agenda_cidade` (`cid_cod`);

--
-- Índices para tabela `cidade`
--
ALTER TABLE `cidade`
  ADD PRIMARY KEY (`cid_cod`);

--
-- Índices para tabela `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`fun_cod`),
  ADD KEY `fk_funcionario_setor` (`set_cod`),
  ADD KEY `fk_funcionario_usuario` (`usu_cod`);

--
-- Índices para tabela `setor`
--
ALTER TABLE `setor`
  ADD PRIMARY KEY (`set_cod`);

--
-- Índices para tabela `solicitacao`
--
ALTER TABLE `solicitacao`
  ADD PRIMARY KEY (`sol_cod`);

--
-- Índices para tabela `to_do_list`
--
ALTER TABLE `to_do_list`
  ADD PRIMARY KEY (`td_cod`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usu_cod`),
  ADD KEY `fk_usuario_perm` (`upe_cod`),
  ADD KEY `fk_usuario_setor` (`set_cod`);

--
-- Índices para tabela `usuario_permissao`
--
ALTER TABLE `usuario_permissao`
  ADD PRIMARY KEY (`upe_cod`);

--
-- Índices para tabela `veiculo`
--
ALTER TABLE `veiculo`
  ADD PRIMARY KEY (`vei_cod`);

--
-- Índices para tabela `viagem`
--
ALTER TABLE `viagem`
  ADD PRIMARY KEY (`via_cod`),
  ADD KEY `fk_agenda_viagem` (`age_cod`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `agenda`
--
ALTER TABLE `agenda`
  MODIFY `age_cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `cidade`
--
ALTER TABLE `cidade`
  MODIFY `cid_cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `funcionario`
--
ALTER TABLE `funcionario`
  MODIFY `fun_cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `setor`
--
ALTER TABLE `setor`
  MODIFY `set_cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `solicitacao`
--
ALTER TABLE `solicitacao`
  MODIFY `sol_cod` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `to_do_list`
--
ALTER TABLE `to_do_list`
  MODIFY `td_cod` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usu_cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `usuario_permissao`
--
ALTER TABLE `usuario_permissao`
  MODIFY `upe_cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `veiculo`
--
ALTER TABLE `veiculo`
  MODIFY `vei_cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `viagem`
--
ALTER TABLE `viagem`
  MODIFY `via_cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `agenda`
--
ALTER TABLE `agenda`
  ADD CONSTRAINT `fk_agenda_cidade` FOREIGN KEY (`cid_cod`) REFERENCES `cidade` (`cid_cod`),
  ADD CONSTRAINT `fk_agenda_usuario` FOREIGN KEY (`usu_cod`) REFERENCES `usuario` (`usu_cod`),
  ADD CONSTRAINT `fk_agenda_veiculo` FOREIGN KEY (`vei_cod`) REFERENCES `veiculo` (`vei_cod`);

--
-- Limitadores para a tabela `funcionario`
--
ALTER TABLE `funcionario`
  ADD CONSTRAINT `fk_funcionario_setor` FOREIGN KEY (`set_cod`) REFERENCES `setor` (`set_cod`),
  ADD CONSTRAINT `fk_funcionario_usuario` FOREIGN KEY (`usu_cod`) REFERENCES `usuario` (`usu_cod`);

--
-- Limitadores para a tabela `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_perm` FOREIGN KEY (`upe_cod`) REFERENCES `usuario_permissao` (`upe_cod`),
  ADD CONSTRAINT `fk_usuario_setor` FOREIGN KEY (`set_cod`) REFERENCES `setor` (`set_cod`);

--
-- Limitadores para a tabela `viagem`
--
ALTER TABLE `viagem`
  ADD CONSTRAINT `fk_agenda_viagem` FOREIGN KEY (`age_cod`) REFERENCES `agenda` (`age_cod`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
