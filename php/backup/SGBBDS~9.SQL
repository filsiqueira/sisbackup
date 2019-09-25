-- MySQL dump 10.15  Distrib 10.0.36-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: sisbackup
-- ------------------------------------------------------
-- Server version	10.0.36-MariaDB-0ubuntu0.16.04.1

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
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8 COMMENT='esta tabela diz quais documentos serao copiados de cada usuario';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `associar_doc_computador`
--

LOCK TABLES `associar_doc_computador` WRITE;
/*!40000 ALTER TABLE `associar_doc_computador` DISABLE KEYS */;
INSERT INTO `associar_doc_computador` VALUES (21,1,1),(22,1,3),(23,1,2),(24,1,4),(25,2,1),(26,2,3),(27,2,2),(28,2,4),(29,3,1),(30,3,3),(31,3,2),(32,3,4),(40,4,1),(41,4,3),(42,4,2),(43,4,4);
/*!40000 ALTER TABLE `associar_doc_computador` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `backups_realizados`
--

LOCK TABLES `backups_realizados` WRITE;
/*!40000 ALTER TABLE `backups_realizados` DISABLE KEYS */;
INSERT INTO `backups_realizados` VALUES (1,1,'2018-09-23 12:00:02','AUTOMATICO'),(2,1,'2018-09-23 12:00:03','AUTOMATICO'),(3,1,'2018-09-23 12:00:04','AUTOMATICO'),(4,1,'2018-09-23 12:00:05','AUTOMATICO'),(5,2,'2018-09-23 12:00:05','AUTOMATICO'),(6,2,'2018-09-23 12:00:06','AUTOMATICO'),(7,2,'2018-09-23 12:00:08','AUTOMATICO'),(8,2,'2018-09-23 12:00:09','AUTOMATICO'),(9,3,'2018-09-23 12:00:10','AUTOMATICO'),(10,3,'2018-09-23 12:00:12','AUTOMATICO'),(11,3,'2018-09-23 12:00:13','AUTOMATICO'),(12,3,'2018-09-23 12:00:14','AUTOMATICO'),(13,4,'2018-09-23 12:00:17','AUTOMATICO'),(14,4,'2018-09-23 12:00:22','AUTOMATICO'),(15,4,'2018-09-23 12:00:26','AUTOMATICO'),(16,4,'2018-09-23 12:00:30','AUTOMATICO'),(17,1,'2018-09-23 12:15:39','AUTOMATICO');
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
  `comp_email` varchar(45) DEFAULT NULL COMMENT 'email que sera enviado dados da execução do backup',
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
  PRIMARY KEY (`comp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='Tabela que armazena o cadastro dos computadores';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `computadores`
--

LOCK TABLES `computadores` WRITE;
/*!40000 ALTER TABLE `computadores` DISABLE KEYS */;
INSERT INTO `computadores` VALUES (1,'ADMINISTRADOR','Administrador','','05ad00sp','192.168.0.112','44:71:44:44:15:96','2',0,1,1,1,1,1,1,'12',1,'NÃO','NÃO','1','2018-09-23 16:20:16','2018-09-23 12:00:46'),(2,'CHAVES SANDUICHE DE PRESUNTO','Chaves','','05ad00sp','192.168.0.112','32:61:61:65:51:56','2',0,1,1,1,1,1,1,'12',1,'NÃO','NÃO','2','2018-09-23 12:00:43','0000-00-00 00:00:00'),(3,'CHIQUINHA DA SILVA','Chiquinha','','05ad00sp','192.168.0.112','10:16:51:a2:q0:20','2',0,1,1,1,1,1,1,'12',2,'NÃO','NÃO','11','2018-09-23 12:01:24','0000-00-00 00:00:00'),(4,'FILIPE SIQUEIRA','filipe','','05ad00sp','192.168.0.112','25:65:49:84:98:48','2',0,1,1,1,1,1,1,'12',3,'NÃO','NÃO','1','2018-09-23 12:02:26','2018-09-23 12:01:28');
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='tabela que armazena informacao do diretorio do documento em cada sistema operacional';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `diretorio_documentos`
--

LOCK TABLES `diretorio_documentos` WRITE;
/*!40000 ALTER TABLE `diretorio_documentos` DISABLE KEYS */;
INSERT INTO `diretorio_documentos` VALUES (1,1,1,'\"Área\\ de\\ Trabalho\"'),(2,1,3,'Desktop'),(3,1,2,'Desktop'),(4,2,1,'Documentos'),(5,2,3,'Documents'),(6,2,2,'Documents'),(7,3,1,'Downloads'),(8,3,3,'Downloads'),(9,3,2,'Downloads'),(10,4,1,'.thunderbird'),(11,4,3,'Appdata/Roaming/Thunderbird'),(12,4,2,'Appdata/Roaming/Thunderbird');
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='tabela que armazena o cadastro de documentos';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documentos`
--

LOCK TABLES `documentos` WRITE;
/*!40000 ALTER TABLE `documentos` DISABLE KEYS */;
INSERT INTO `documentos` VALUES (1,'AREA DE TRABALHO'),(2,'MEUS DOCUMENTOS'),(3,'DOWNLOADS'),(4,'THUNDERBIRD');
/*!40000 ALTER TABLE `documentos` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servidores`
--

LOCK TABLES `servidores` WRITE;
/*!40000 ALTER TABLE `servidores` DISABLE KEYS */;
INSERT INTO `servidores` VALUES (1,'Local','127.0.0.1','root','MDVhZDAwc3A=','sisbackup','Linux'),(2,'SrvArquivos','192.168.0.110','Administrator','V2dGcDY1NA==','BackupUsuarios','Windows'),(3,'srv-backup','192.168.0.111','root','MDVhZDAwc3A=','backup_usuarios','Linux');
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='cadastro de setores';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `setores`
--

LOCK TABLES `setores` WRITE;
/*!40000 ALTER TABLE `setores` DISABLE KEYS */;
INSERT INTO `setores` VALUES (1,'TECNOLOGIA DA INFORMAÇÃO','Setor responsável pela área de TI da empresa'),(2,'ADMINISTRATIVO','Setor responsável pela área administrativa da empresa'),(3,'MARKETING','Setor responsável pela área de Marketing da empresa'),(4,'CONTROLADORIA','Setor responsável pela área de Controladoria da empresa'),(5,'DIRETORIA','Setor responsável pela direção da empresa'),(6,'MEIO AMBIENTE','Setor responsável pela área de meio ambiente da empresa'),(7,'FINANCEIRO','Setor responsável pela área financeira da empresa'),(8,'LOGÍSTICA','Setor responsável pela área de logística da empresa'),(9,'COMPRAS','Setor responsável pela área de compras da empresa'),(10,'DEPARTAMENTO PESSOAL','Setor responsável pela área de DP da empresa'),(11,'RECURSOS HUMANOS','Setor responsável pela área de RH da empresa');
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
INSERT INTO `sistemas_operacionais` VALUES (1,'UBUNTU','LINUX'),(2,'WINDOWS8','WINDOWS'),(3,'WINDOWS7','WINDOWS');
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
INSERT INTO `smtp` VALUES (1,'GMAIL','backuplinux2017@gmail.com','smtp.gmail.com',587,'MDVhZDAwc3A=');
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
  `usuario_data_bloqueio` datetime NOT NULL,
  PRIMARY KEY (`usuario_id`),
  KEY `fk_usuario_setor_idx` (`usuario_id_setor`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='tabela que armazena o cadastro de usuarios';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'ADMINISTRADOR','admin','8d3a648190cc6debfc56d473b5641e0d','ATIVO',1,'filipe040990@gmail.com',0,'0000-00-00 00:00:00');
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

-- Dump completed on 2018-09-23 19:50:34
