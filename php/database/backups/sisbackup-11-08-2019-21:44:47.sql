-- MySQL dump 10.15  Distrib 10.0.38-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: sisbackup
-- ------------------------------------------------------
-- Server version	10.0.38-MariaDB-0ubuntu0.16.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `associar_doc_computador`
--

DROP TABLE IF EXISTS `associar_doc_computador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `associar_doc_computador` (
  `assoc_id` int(11) NOT NULL AUTO_INCREMENT,
  `assoc_id_computador` int(11) DEFAULT NULL,
  `assoc_id_documentos` int(11) DEFAULT NULL,
  PRIMARY KEY (`assoc_id`),
  KEY `fk_assoc_doc_cad_comp_idx` (`assoc_id_computador`),
  KEY `fk_assosiar_doc_cad_doc_idx` (`assoc_id_documentos`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COMMENT='esta tabela diz quais documentos serao copiados de cada usuario';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `associar_doc_computador`
--

LOCK TABLES `associar_doc_computador` WRITE;
/*!40000 ALTER TABLE `associar_doc_computador` DISABLE KEYS */;
INSERT INTO `associar_doc_computador` VALUES (1,1,1),(2,1,3),(3,1,2),(4,2,1),(5,2,3),(6,2,2),(7,3,1),(8,3,3),(9,3,2),(10,3,5),(11,3,4),(12,4,1),(13,4,2),(14,5,1),(15,5,2),(16,5,5),(19,7,1),(20,7,3),(21,7,2),(22,6,1),(23,6,3);
/*!40000 ALTER TABLE `associar_doc_computador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `associar_extensao_arquivo_computador`
--

DROP TABLE IF EXISTS `associar_extensao_arquivo_computador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `associar_extensao_arquivo_computador` (
  `associar_id` int(11) NOT NULL AUTO_INCREMENT,
  `associar_extensao_id` int(11) NOT NULL,
  `associar_computador_id` int(11) NOT NULL,
  PRIMARY KEY (`associar_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `associar_extensao_arquivo_computador`
--

LOCK TABLES `associar_extensao_arquivo_computador` WRITE;
/*!40000 ALTER TABLE `associar_extensao_arquivo_computador` DISABLE KEYS */;
INSERT INTO `associar_extensao_arquivo_computador` VALUES (1,7,1),(2,3,1),(3,7,2),(4,3,2),(5,7,3),(6,3,3),(7,3,4),(8,7,5),(9,3,5),(12,3,7),(13,7,6),(14,3,6);
/*!40000 ALTER TABLE `associar_extensao_arquivo_computador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auditoria_acoes`
--

DROP TABLE IF EXISTS `auditoria_acoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auditoria_acoes` (
  `auditoria_id` int(11) NOT NULL AUTO_INCREMENT,
  `auditoria_usuario` varchar(255) NOT NULL,
  `auditoria_acao` varchar(255) NOT NULL,
  `auditoria_tela` varchar(255) NOT NULL,
  `auditoria_data_hora` datetime NOT NULL,
  `auditoria_descricao` varchar(255) NOT NULL,
  PRIMARY KEY (`auditoria_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auditoria_acoes`
--

LOCK TABLES `auditoria_acoes` WRITE;
/*!40000 ALTER TABLE `auditoria_acoes` DISABLE KEYS */;
INSERT INTO `auditoria_acoes` VALUES (1,'admin','inclusao','Cadastro de Serviço de Envio de Email','2019-08-11 20:55:33','Serviço de Email Gmail cadastrado por admin'),(2,'admin','inclusao','Cadastro de Servidor de Backup','2019-08-11 20:58:00','Servidor de Backup Srv-Sisbackup cadastrado por admin'),(3,'admin','inclusao','Cadastro de Servidor de Backup','2019-08-11 20:59:57','Servidor de Backup Srv-Backup cadastrado por admin'),(4,'admin','inclusao','Cadastro de Sistemas Operacionais','2019-08-11 21:00:32','Sistema Operacional windows 7 cadastrado por admin'),(5,'admin','inclusao','Cadastro de Sistemas Operacionais','2019-08-11 21:00:40','Sistema Operacional windows 8 cadastrado por admin'),(6,'admin','inclusao','Cadastro de Sistemas Operacionais','2019-08-11 21:00:48','Sistema Operacional windows 10 cadastrado por admin'),(7,'admin','inclusao','Cadastro de Documentos','2019-08-11 21:01:34','Documento Area de Trabalho cadastrado por admin'),(8,'admin','inclusao','Cadastro de Documentos','2019-08-11 21:01:51','Documento Meus Documentos cadastrado por admin'),(9,'admin','inclusao','Cadastro de Documentos','2019-08-11 21:02:06','Documento Downloads cadastrado por admin'),(10,'admin','inclusao','Cadastro de Documentos','2019-08-11 21:02:26','Documento Minhas Imagens cadastrado por admin'),(11,'admin','inclusao','Cadastro de Setor','2019-08-11 21:03:03','Setor TI cadastrado por admin'),(12,'admin','inclusao','Cadastro de Setor','2019-08-11 21:05:13','Setor Financeiro cadastrado por admin'),(13,'admin','inclusao','Cadastro de Setor','2019-08-11 21:08:56','Setor Diretoria cadastrado por admin'),(14,'admin','inclusao','Cadastro de Setor','2019-08-11 21:09:11','Setor Jurídico cadastrado por admin'),(15,'admin','inclusao','Cadastro de Setor','2019-08-11 21:09:32','Setor Compras cadastrado por admin'),(16,'admin','inclusao','Cadastro de Setor','2019-08-11 21:09:47','Setor Administração cadastrado por admin'),(17,'admin','inclusao','Cadastro de Setor','2019-08-11 21:10:01','Setor Contabilidade cadastrado por admin'),(18,'admin','inclusao','Cadastro de Setor','2019-08-11 21:11:13','Setor Recursos_Humanos cadastrado por admin'),(19,'admin','inclusao','Cadastro de Setor','2019-08-11 21:11:34','Setor Depto.Pessoal cadastrado por admin'),(20,'admin','inclusao','Cadastro de Usuários','2019-08-11 21:15:40','Usuário Filipe Siqueira cadastrado por admin'),(21,'admin','inclusao','Cadastro de Documentos','2019-08-11 21:19:23','Documento Meus Videos cadastrado por admin'),(22,'admin','inclusao','Cadastro de Computadores','2019-08-11 21:21:26','Computador do usuário Filipe Siqueira cadastrado por admin'),(23,'admin','inclusao','Cadastro de Computadores','2019-08-11 21:24:23','Computador do usuário joão da Silva cadastrado por admin'),(24,'admin','inclusao','Cadastro de Computadores','2019-08-11 21:27:02','Computador do usuário Maria Fernanda Souza cadastrado por admin'),(25,'admin','inclusao','Cadastro de Computadores','2019-08-11 21:29:36','Computador do usuário Chaves da Vila cadastrado por admin'),(26,'admin','inclusao','Cadastro de Computadores','2019-08-11 21:31:55','Computador do usuário Kiko Tesouro da Mamãe cadastrado por admin'),(27,'admin','inclusao','Cadastro de Computadores','2019-08-11 21:34:55','Computador do usuário Dona Florinda cadastrado por admin'),(28,'admin','inclusao','Cadastro de Computadores','2019-08-11 21:36:43','Computador do usuário Seu Madruga cadastrado por admin'),(29,'admin','alteracao','Manutenção de Computadores','2019-08-11 21:43:10','Computador do usuário <b>DONA FLORINDA </b> alterado por admin');
/*!40000 ALTER TABLE `auditoria_acoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `backups_realizados`
--

DROP TABLE IF EXISTS `backups_realizados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `backups_realizados` (
  `backup_id` int(11) NOT NULL AUTO_INCREMENT,
  `backup_id_computador` int(11) NOT NULL,
  `backup_data` datetime NOT NULL,
  `backup_origem` varchar(45) NOT NULL,
  PRIMARY KEY (`backup_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `backups_realizados`
--

LOCK TABLES `backups_realizados` WRITE;
/*!40000 ALTER TABLE `backups_realizados` DISABLE KEYS */;
/*!40000 ALTER TABLE `backups_realizados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `computadores`
--

DROP TABLE IF EXISTS `computadores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `computadores` (
  `comp_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id do computador',
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
  `comp_data_alteracao` datetime NOT NULL,
  `comp_usuario_adm` varchar(255) NOT NULL,
  `comp_backup_ativo` varchar(3) NOT NULL,
  PRIMARY KEY (`comp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='Tabela que armazena o cadastro dos computadores';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `computadores`
--

LOCK TABLES `computadores` WRITE;
/*!40000 ALTER TABLE `computadores` DISABLE KEYS */;
INSERT INTO `computadores` VALUES (1,'FILIPE SIQUEIRA','filipe','MTIz','10.0.0.100','1s:5d:4f:98:e7:79','2',1,0,1,0,1,0,1,'12',1,'NÃO','NÃO','7','2019-08-11 21:21:25','0000-00-00 00:00:00','Administrador','SIM'),(2,'JOÃO DA SILVA','joao','MTIz','10.0.0.100','sd:16:54:98:a1:23','2',1,0,1,0,1,0,1,'14',1,'NÃO','NÃO','6','2019-08-11 21:24:23','0000-00-00 00:00:00','Administrador','SIM'),(3,'MARIA FERNANDA SOUZA','Maria Fernanda','MTIz','10.0.0.100','1s:65:d4:f8:94:r9','2',0,0,0,0,0,0,0,'15',1,'NÃO','NÃO','4','2019-08-11 21:27:01','0000-00-00 00:00:00','Administrador','SIM'),(4,'CHAVES DA VILA','Chaves','MTU0NTYxMjMxMTM=','10.0.0.150','4x:56:c4:78:97:89','1',1,1,0,1,0,1,0,'16',2,'NÃO','NÃO','8','2019-08-11 21:29:35','0000-00-00 00:00:00','Administrador','SIM'),(5,'KIKO TESOURO DA MAMÃE','Kiko','MTIzMTMyZDEz','10.0.0.25','15:45:64:89:47:89','3',1,0,0,0,0,0,1,'15',2,'NÃO','NÃO','5','2019-08-11 21:31:55','0000-00-00 00:00:00','Administrador','SIM'),(6,'DONA FLORINDA','Florinda','MTUxNjU1NjQ=','10.0.0.123','54:84:89:77:84:65','2',0,0,0,0,0,0,0,'15',1,'NÃO','NÃO','9','2019-08-11 21:34:54','2019-08-11 21:43:10','Administrador','SIM'),(7,'SEU MADRUGA','Madruga','MTE1NDg5Nzk3OQ==','10.0.0.55','16:58:48:97:89:77','2',1,0,1,0,1,0,1,'13',2,'NÃO','NÃO','4','2019-08-11 21:36:43','0000-00-00 00:00:00','Administrador','SIM');
/*!40000 ALTER TABLE `computadores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `diretorio_documentos`
--

DROP TABLE IF EXISTS `diretorio_documentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `diretorio_documentos` (
  `diretorio_id` int(11) NOT NULL AUTO_INCREMENT,
  `diretorio_id_documentos` int(11) DEFAULT NULL,
  `diretorio_id_sistema_operacional` int(11) DEFAULT NULL,
  `diretorio_documentos` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`diretorio_id`),
  KEY `fk_diretorio_doc_cad_doc_idx` (`diretorio_id_documentos`),
  KEY `fk_diretorio_doc_cad_so_idx` (`diretorio_id_sistema_operacional`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COMMENT='tabela que armazena informacao do diretorio do documento em cada sistema operacional';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `diretorio_documentos`
--

LOCK TABLES `diretorio_documentos` WRITE;
/*!40000 ALTER TABLE `diretorio_documentos` DISABLE KEYS */;
INSERT INTO `diretorio_documentos` VALUES (1,1,3,'C:/Users/usuario/Desktop'),(2,1,1,'C:/Users/usuario/Desktop'),(3,1,2,'C:/Users/usuario/Desktop'),(4,2,3,'C:/Users/usuario/Documents'),(5,2,1,'C:/Users/usuario/Documents'),(6,2,2,'C:/Users/usuario/Documents'),(7,3,3,'C:/Users/usuario/Downloads'),(8,3,1,'C:/Users/usuario/Downloads'),(9,3,2,'C:/Users/usuario/Downloads'),(10,4,3,'C:/Users/usuario/Pictures'),(11,4,1,'C:/Users/usuario/Pictures'),(12,4,2,'C:/Users/usuario/Pictures'),(13,5,3,'C:/Users/usuario/Videos'),(14,5,1,'C:/Users/usuario/Videos'),(15,5,2,'C:/Users/usuario/Videos');
/*!40000 ALTER TABLE `diretorio_documentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `documentos`
--

DROP TABLE IF EXISTS `documentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `documentos` (
  `documento_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id do documento',
  `documento_nome` varchar(45) NOT NULL COMMENT 'nome do documento',
  PRIMARY KEY (`documento_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='tabela que armazena o cadastro de documentos';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documentos`
--

LOCK TABLES `documentos` WRITE;
/*!40000 ALTER TABLE `documentos` DISABLE KEYS */;
INSERT INTO `documentos` VALUES (1,'AREA DE TRABALHO'),(2,'MEUS DOCUMENTOS'),(3,'DOWNLOADS'),(4,'MINHAS IMAGENS'),(5,'MEUS VIDEOS');
/*!40000 ALTER TABLE `documentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `extensao_arquivo`
--

DROP TABLE IF EXISTS `extensao_arquivo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `extensao_arquivo` (
  `extensao_arquivo_id` int(11) NOT NULL AUTO_INCREMENT,
  `extensao_arquivo` varchar(10) NOT NULL,
  PRIMARY KEY (`extensao_arquivo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=100000 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `extensao_arquivo`
--

LOCK TABLES `extensao_arquivo` WRITE;
/*!40000 ALTER TABLE `extensao_arquivo` DISABLE KEYS */;
INSERT INTO `extensao_arquivo` VALUES (1,'.mp3'),(2,'.mp4'),(3,'.iso'),(4,'.exe'),(5,'.avi'),(6,'.wmv'),(7,'.ini'),(99999,'default');
/*!40000 ALTER TABLE `extensao_arquivo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registro_backup`
--

DROP TABLE IF EXISTS `registro_backup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `registro_backup` (
  `registro_backup_id` int(11) NOT NULL AUTO_INCREMENT,
  `registro_backup` varchar(255) NOT NULL,
  PRIMARY KEY (`registro_backup_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registro_backup`
--

LOCK TABLES `registro_backup` WRITE;
/*!40000 ALTER TABLE `registro_backup` DISABLE KEYS */;
INSERT INTO `registro_backup` VALUES (1,'sisbackup-11-08-2019-21:44:47.sql');
/*!40000 ALTER TABLE `registro_backup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servidores`
--

DROP TABLE IF EXISTS `servidores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `servidores` (
  `servidor_id` int(11) NOT NULL AUTO_INCREMENT,
  `servidor_nome` varchar(255) NOT NULL,
  `servidor_ip` varchar(255) NOT NULL,
  `servidor_user_privilegio` varchar(255) NOT NULL,
  `servidor_senha_acesso` varchar(255) NOT NULL,
  `servidor_nome_compartilhamento` varchar(255) NOT NULL,
  `servidor_plataforma` varchar(255) NOT NULL,
  PRIMARY KEY (`servidor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servidores`
--

LOCK TABLES `servidores` WRITE;
/*!40000 ALTER TABLE `servidores` DISABLE KEYS */;
INSERT INTO `servidores` VALUES (1,'Srv-Sisbackup','127.0.0.1','root','MDVhZDAwc3A=','sisbackup','Linux'),(2,'Srv-Backup','10.0.0.107','Administrator','MDVBZDAwc3Aq','Backup_Usuarios','Windows');
/*!40000 ALTER TABLE `servidores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `setores`
--

DROP TABLE IF EXISTS `setores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `setores` (
  `setor_id` int(11) NOT NULL AUTO_INCREMENT,
  `setor_nome` varchar(45) NOT NULL,
  `setor_descricao` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`setor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='cadastro de setores';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `setores`
--

LOCK TABLES `setores` WRITE;
/*!40000 ALTER TABLE `setores` DISABLE KEYS */;
INSERT INTO `setores` VALUES (1,'sisbackup','sisbackup'),(2,'TI','Setor de tecnologia da informação'),(3,'FINANCEIRO','Setor de financeiro da empresa'),(4,'DIRETORIA','Setor de diretoria da empresa'),(5,'JURÍDICO','Setor jurídico da empresa'),(6,'COMPRAS','Setor de compras'),(7,'ADMINISTRAÇÃO','Setor administrativo da empresa'),(8,'CONTABILIDADE','Setor de contabilidade'),(9,'RECURSOS_HUMANOS','Setor de RH'),(10,'DEPTO.PESSOAL','Setor de departamento pessoal');
/*!40000 ALTER TABLE `setores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sistemas_operacionais`
--

DROP TABLE IF EXISTS `sistemas_operacionais`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sistemas_operacionais` (
  `sistema_operacional_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id do sistema operacional',
  `sistema_operacional_nome` varchar(45) NOT NULL COMMENT 'nome do sistema operacional',
  `sistema_operacional_plataforma` varchar(45) NOT NULL COMMENT 'plataforma do sistema operacional',
  PRIMARY KEY (`sistema_operacional_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='tabela que armazena o cadastro de sistema operacional';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sistemas_operacionais`
--

LOCK TABLES `sistemas_operacionais` WRITE;
/*!40000 ALTER TABLE `sistemas_operacionais` DISABLE KEYS */;
INSERT INTO `sistemas_operacionais` VALUES (1,'WINDOWS 7','WINDOWS'),(2,'WINDOWS 8','WINDOWS'),(3,'WINDOWS 10','WINDOWS');
/*!40000 ALTER TABLE `sistemas_operacionais` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `smtp`
--

DROP TABLE IF EXISTS `smtp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `smtp` (
  `smtp_id` int(11) NOT NULL AUTO_INCREMENT,
  `smtp_nome` varchar(255) NOT NULL,
  `smtp_email_admin` varchar(255) NOT NULL,
  `smtp_endereco` varchar(255) NOT NULL,
  `smtp_porta` int(11) NOT NULL,
  `smtp_senha` varchar(32) NOT NULL,
  PRIMARY KEY (`smtp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `smtp`
--

LOCK TABLES `smtp` WRITE;
/*!40000 ALTER TABLE `smtp` DISABLE KEYS */;
INSERT INTO `smtp` VALUES (1,'GMAIL','sisbackupsistemas@gmail.com','smtp.gmail.com',587,'MDVhZDAwc3A=');
/*!40000 ALTER TABLE `smtp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `usuario_id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_nome` varchar(45) NOT NULL,
  `usuario_login` varchar(45) NOT NULL,
  `usuario_senha` varchar(45) NOT NULL,
  `usuario_status` varchar(10) DEFAULT NULL,
  `usuario_id_setor` int(11) DEFAULT NULL,
  `usuario_email` varchar(100) NOT NULL,
  `usuario_tentativas_invalidas` int(11) NOT NULL,
  `usuario_data_bloqueio` datetime DEFAULT NULL,
  PRIMARY KEY (`usuario_id`),
  KEY `fk_usuario_setor_idx` (`usuario_id_setor`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='tabela que armazena o cadastro de usuarios';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Administrador','admin','a2de5d65f926d068f3f6513ec7c9644e','ATIVO',1,'admin@email.com',0,'2019-08-11 00:00:00'),(2,'FILIPE SIQUEIRA','filipe','729481e8b6b52c291428388bc65edd51','ATIVO',2,'filipe@email.com',0,'0000-00-00 00:00:00');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-08-11 21:44:47
