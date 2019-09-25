-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 10-Jul-2019 às 00:13
-- Versão do servidor: 5.7.26-0ubuntu0.16.04.1
-- PHP Version: 7.0.33-0ubuntu0.16.04.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sisbackup`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `associar_doc_computador`
--

CREATE TABLE `associar_doc_computador` (
  `assoc_id` int(11) NOT NULL,
  `assoc_id_computador` int(11) DEFAULT NULL,
  `assoc_id_documentos` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='esta tabela diz quais documentos serao copiados de cada usuario';

-- --------------------------------------------------------

--
-- Estrutura da tabela `associar_extensao_arquivo_computador`
--

CREATE TABLE `associar_extensao_arquivo_computador` (
  `associar_id` int(11) NOT NULL,
  `associar_extensao_id` int(11) NOT NULL,
  `associar_computador_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `auditoria_acoes`
--

CREATE TABLE `auditoria_acoes` (
  `auditoria_id` int(11) NOT NULL,
  `auditoria_usuario` varchar(255) NOT NULL,
  `auditoria_acao` varchar(255) NOT NULL,
  `auditoria_tela` varchar(255) NOT NULL,
  `auditoria_data_hora` datetime NOT NULL,
  `auditoria_descricao` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `backups_realizados`
--

CREATE TABLE `backups_realizados` (
  `backup_id` int(11) NOT NULL,
  `backup_id_computador` int(11) NOT NULL,
  `backup_data` datetime NOT NULL,
  `backup_origem` varchar(45) NOT NULL,
  `backup_status` varchar(45) NOT NULL	
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `computadores`
--

CREATE TABLE `computadores` (
  `comp_id` int(11) NOT NULL COMMENT 'id do computador',
  `comp_nome_usuario` varchar(100) NOT NULL COMMENT 'nome do usuario da maquina',
  `comp_login` varchar(45) NOT NULL,
  `comp_senha` varchar(100) DEFAULT NULL COMMENT 'senha da conta de usuario do computador',
  `comp_ip` varchar(15) NOT NULL COMMENT 'enredeço ip do computador',
  `comp_mac` varchar(45) DEFAULT NULL COMMENT 'endereço mac do computador',
  `comp_sistema_operacional` varchar(45) NOT NULL COMMENT 'sistema operacional do computador',
  `comp_dia_0` int(11) DEFAULT NULL COMMENT 'dia(s) que serão executado o backup',
  `comp_dia_1` int(11) DEFAULT NULL,
  `comp_dia_2` int(11) DEFAULT NULL,
  `comp_dia_3` int(11) DEFAULT NULL,
  `comp_dia_4` int(11) DEFAULT NULL,
  `comp_dia_5` int(11) DEFAULT NULL,
  `comp_dia_6` int(11) DEFAULT NULL,
  `comp_hora_backup` varchar(45) NOT NULL,
  `comp_servidor_backup` int(11) DEFAULT NULL COMMENT 'diretorio onde sera salvo o backup do usuario',
  `comp_liga_computador` varchar(4) NOT NULL COMMENT 'informa se o computador sera ligado antes do backup',
  `comp_desliga_computador` varchar(4) NOT NULL,
  `comp_setor` varchar(100) DEFAULT NULL,
  `comp_data_cadastro` datetime NOT NULL,
  `comp_data_alteracao` varchar(25) NOT NULL,
  `comp_usuario_adm` varchar(255) NOT NULL,
  `comp_backup_ativo` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela que armazena o cadastro dos computadores';

-- --------------------------------------------------------

--
-- Estrutura da tabela `diretorio_documentos`
--

CREATE TABLE `diretorio_documentos` (
  `diretorio_id` int(11) NOT NULL,
  `diretorio_id_documentos` int(11) DEFAULT NULL,
  `diretorio_id_sistema_operacional` int(11) DEFAULT NULL,
  `diretorio_documentos` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='tabela que armazena informacao do diretorio do documento em cada sistema operacional';

-- --------------------------------------------------------

--
-- Estrutura da tabela `documentos`
--

CREATE TABLE `documentos` (
  `documento_id` int(11) NOT NULL COMMENT 'id do documento',
  `documento_nome` varchar(45) NOT NULL COMMENT 'nome do documento'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='tabela que armazena o cadastro de documentos';

-- --------------------------------------------------------

--
-- Estrutura da tabela `extensao_arquivo`
--

CREATE TABLE `extensao_arquivo` (
  `extensao_arquivo_id` int(11) NOT NULL,
  `extensao_arquivo` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `extensao_arquivo`
--

INSERT INTO `extensao_arquivo` (`extensao_arquivo_id`, `extensao_arquivo`) VALUES
(1, '.mp3'),
(2, '.mp4'),
(3, '.iso'),
(4, '.exe'),
(5, '.avi'),
(6, '.wmv'),
(7, '.ini'),
(99999, 'default');

-- --------------------------------------------------------

--
-- Estrutura da tabela `registro_backup`
--

CREATE TABLE `registro_backup` (
  `registro_backup_id` int(11) NOT NULL,
  `registro_backup` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `servidores`
--

CREATE TABLE `servidores` (
  `servidor_id` int(11) NOT NULL,
  `servidor_nome` varchar(255) NOT NULL,
  `servidor_ip` varchar(255) NOT NULL,
  `servidor_user_privilegio` varchar(255) NOT NULL,
  `servidor_senha_acesso` varchar(255) NOT NULL,
  `servidor_nome_compartilhamento` varchar(255) NOT NULL,
  `servidor_plataforma` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `setores`
--

CREATE TABLE `setores` (
  `setor_id` int(11) NOT NULL,
  `setor_nome` varchar(45) NOT NULL,
  `setor_descricao` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='cadastro de setores';

--
-- Extraindo dados da tabela `setores`
--

INSERT INTO `setores` (`setor_id`, `setor_nome`, `setor_descricao`) VALUES
(1, 'sisbackup', 'sisbackup');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sistemas_operacionais`
--

CREATE TABLE `sistemas_operacionais` (
  `sistema_operacional_id` int(11) NOT NULL COMMENT 'id do sistema operacional',
  `sistema_operacional_nome` varchar(45) NOT NULL COMMENT 'nome do sistema operacional',
  `sistema_operacional_plataforma` varchar(45) NOT NULL COMMENT 'plataforma do sistema operacional'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='tabela que armazena o cadastro de sistema operacional';

-- --------------------------------------------------------

--
-- Estrutura da tabela `smtp`
--

CREATE TABLE `smtp` (
  `smtp_id` int(11) NOT NULL,
  `smtp_nome` varchar(255) NOT NULL,
  `smtp_email_admin` varchar(255) NOT NULL,
  `smtp_endereco` varchar(255) NOT NULL,
  `smtp_porta` int(11) NOT NULL,
  `smtp_senha` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `usuario_id` int(11) NOT NULL,
  `usuario_nome` varchar(45) NOT NULL,
  `usuario_login` varchar(45) NOT NULL,
  `usuario_senha` varchar(45) NOT NULL,
  `usuario_status` varchar(10) DEFAULT NULL,
  `usuario_id_setor` int(11) DEFAULT NULL,
  `usuario_email` varchar(100) NOT NULL,
  `usuario_tentativas_invalidas` int(11) NOT NULL,
  `usuario_data_bloqueio` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='tabela que armazena o cadastro de usuarios';

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`usuario_id`, `usuario_nome`, `usuario_login`, `usuario_senha`, `usuario_status`, `usuario_id_setor`, `usuario_email`, `usuario_tentativas_invalidas`, `usuario_data_bloqueio`) VALUES
(1, 'Administrador', 'admin', 'a2de5d65f926d068f3f6513ec7c9644e', 'ATIVO', 1, 'filipe4009@hotmail.com', 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `associar_doc_computador`
--
ALTER TABLE `associar_doc_computador`
  ADD PRIMARY KEY (`assoc_id`),
  ADD KEY `fk_assoc_doc_cad_comp_idx` (`assoc_id_computador`),
  ADD KEY `fk_assosiar_doc_cad_doc_idx` (`assoc_id_documentos`);

--
-- Indexes for table `associar_extensao_arquivo_computador`
--
ALTER TABLE `associar_extensao_arquivo_computador`
  ADD PRIMARY KEY (`associar_id`);

--
-- Indexes for table `auditoria_acoes`
--
ALTER TABLE `auditoria_acoes`
  ADD PRIMARY KEY (`auditoria_id`);

--
-- Indexes for table `backups_realizados`
--
ALTER TABLE `backups_realizados`
  ADD PRIMARY KEY (`backup_id`);

--
-- Indexes for table `computadores`
--
ALTER TABLE `computadores`
  ADD PRIMARY KEY (`comp_id`);

--
-- Indexes for table `diretorio_documentos`
--
ALTER TABLE `diretorio_documentos`
  ADD PRIMARY KEY (`diretorio_id`),
  ADD KEY `fk_diretorio_doc_cad_doc_idx` (`diretorio_id_documentos`),
  ADD KEY `fk_diretorio_doc_cad_so_idx` (`diretorio_id_sistema_operacional`);

--
-- Indexes for table `documentos`
--
ALTER TABLE `documentos`
  ADD PRIMARY KEY (`documento_id`);

--
-- Indexes for table `extensao_arquivo`
--
ALTER TABLE `extensao_arquivo`
  ADD PRIMARY KEY (`extensao_arquivo_id`);

--
-- Indexes for table `registro_backup`
--
ALTER TABLE `registro_backup`
  ADD PRIMARY KEY (`registro_backup_id`);

--
-- Indexes for table `servidores`
--
ALTER TABLE `servidores`
  ADD PRIMARY KEY (`servidor_id`);

--
-- Indexes for table `setores`
--
ALTER TABLE `setores`
  ADD PRIMARY KEY (`setor_id`);

--
-- Indexes for table `sistemas_operacionais`
--
ALTER TABLE `sistemas_operacionais`
  ADD PRIMARY KEY (`sistema_operacional_id`);

--
-- Indexes for table `smtp`
--
ALTER TABLE `smtp`
  ADD PRIMARY KEY (`smtp_id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usuario_id`),
  ADD KEY `fk_usuario_setor_idx` (`usuario_id_setor`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `associar_doc_computador`
--
ALTER TABLE `associar_doc_computador`
  MODIFY `assoc_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `associar_extensao_arquivo_computador`
--
ALTER TABLE `associar_extensao_arquivo_computador`
  MODIFY `associar_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `auditoria_acoes`
--
ALTER TABLE `auditoria_acoes`
  MODIFY `auditoria_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `backups_realizados`
--
ALTER TABLE `backups_realizados`
  MODIFY `backup_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `computadores`
--
ALTER TABLE `computadores`
  MODIFY `comp_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id do computador';
--
-- AUTO_INCREMENT for table `diretorio_documentos`
--
ALTER TABLE `diretorio_documentos`
  MODIFY `diretorio_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `documentos`
--
ALTER TABLE `documentos`
  MODIFY `documento_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id do documento';
--
-- AUTO_INCREMENT for table `extensao_arquivo`
--
ALTER TABLE `extensao_arquivo`
  MODIFY `extensao_arquivo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100001;
--
-- AUTO_INCREMENT for table `registro_backup`
--
ALTER TABLE `registro_backup`
  MODIFY `registro_backup_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `servidores`
--
ALTER TABLE `servidores`
  MODIFY `servidor_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `setores`
--
ALTER TABLE `setores`
  MODIFY `setor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `sistemas_operacionais`
--
ALTER TABLE `sistemas_operacionais`
  MODIFY `sistema_operacional_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id do sistema operacional';
--
-- AUTO_INCREMENT for table `smtp`
--
ALTER TABLE `smtp`
  MODIFY `smtp_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `usuario_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
