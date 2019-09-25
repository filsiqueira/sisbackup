-- MySQL dump 10.16  Distrib 10.1.41-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: sisbackup
-- ------------------------------------------------------
-- Server version	10.1.41-MariaDB-0ubuntu0.18.04.1

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
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=utf8 COMMENT='esta tabela diz quais documentos serao copiados de cada usuario';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `associar_doc_computador`
--

LOCK TABLES `associar_doc_computador` WRITE;
/*!40000 ALTER TABLE `associar_doc_computador` DISABLE KEYS */;
INSERT INTO `associar_doc_computador` VALUES (48,8,1),(49,8,2),(65,3,1),(66,3,2),(73,7,1),(74,7,2),(111,1,1),(112,1,3),(113,1,2);
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
) ENGINE=InnoDB AUTO_INCREMENT=133 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `associar_extensao_arquivo_computador`
--

LOCK TABLES `associar_extensao_arquivo_computador` WRITE;
/*!40000 ALTER TABLE `associar_extensao_arquivo_computador` DISABLE KEYS */;
INSERT INTO `associar_extensao_arquivo_computador` VALUES (50,7,8),(51,3,8),(70,7,3),(71,3,3),(80,99999,7),(129,7,1),(130,3,1),(131,1,1),(132,2,1);
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
) ENGINE=InnoDB AUTO_INCREMENT=132 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auditoria_acoes`
--

LOCK TABLES `auditoria_acoes` WRITE;
/*!40000 ALTER TABLE `auditoria_acoes` DISABLE KEYS */;
INSERT INTO `auditoria_acoes` VALUES (1,'admin','inclusao','Cadastro de Serviço de Envio de Email','2019-08-14 00:42:56','Serviço de Email gmail cadastrado por admin'),(2,'admin','inclusao','Cadastro de Servidor de Backup','2019-08-14 00:45:28','Servidor de Backup Srv-Sisbackup cadastrado por admin'),(3,'admin','inclusao','Cadastro de Sistemas Operacionais','2019-08-14 00:48:35','Sistema Operacional windows 8 cadastrado por admin'),(4,'admin','inclusao','Cadastro de Documentos','2019-08-14 00:48:59','Documento Area de Trabalho cadastrado por admin'),(5,'admin','inclusao','Cadastro de Documentos','2019-08-14 00:49:11','Documento Meus Documentos cadastrado por admin'),(6,'admin','inclusao','Cadastro de Setor','2019-08-14 00:49:53','Setor TI cadastrado por admin'),(7,'admin','inclusao','Cadastro de Setor','2019-08-14 00:50:01','Setor Financeiro cadastrado por admin'),(8,'admin','inclusao','Cadastro de Computadores','2019-08-14 00:52:50','Computador do usuário Filipe Siqueira cadastrado por admin'),(9,'admin','alteracao','Manutenção de Computadores','2019-08-14 11:32:02','Computador do usuário <b>FILIPE SIQUEIRA </b> alterado por admin'),(10,'admin','alteracao','Manutenção de Computadores','2019-08-14 11:38:50','Computador do usuário <b>FILIPE SIQUEIRA </b> alterado por admin'),(11,'admin','inclusao','Cadastro de Documentos','2019-08-14 11:40:56','Documento Downloads cadastrado por admin'),(12,'admin','alteracao','Manutenção de Computadores','2019-08-14 11:41:15','Computador do usuário <b>FILIPE SIQUEIRA </b> alterado por admin'),(13,'admin','inclusao','Cadastro de Servidor de Backup','2019-08-14 11:46:00','Servidor de Backup Server2016 cadastrado por admin'),(14,'admin','alteracao','Manutenção de Computadores','2019-08-14 11:46:31','Computador do usuário <b>FILIPE SIQUEIRA </b> alterado por admin'),(15,'admin','alteracao','Manutenção de Computadores','2019-08-14 12:00:04','Computador do usuário <b>FILIPE SIQUEIRA </b> alterado por admin'),(16,'admin','alteracao','Manutenção de Computadores','2019-08-14 12:12:01','Computador do usuário <b>FILIPE SIQUEIRA </b> alterado por admin'),(17,'admin','alteracao','Manutenção de Computadores','2019-08-14 12:01:50','Computador do usuário <b>FILIPE SIQUEIRA </b> alterado por admin'),(18,'admin','exclusao','Cadastro de Serviço de Envio de Email','2019-08-14 13:21:28','Serviço de Email GMAIL excluído por admin'),(19,'admin','inclusao','Cadastro de Serviço de Envio de Email','0000-00-00 00:00:00','Serviço de Email a cadastrado por admin'),(20,'admin','exclusao','Cadastro de Serviço de Envio de Email','2019-08-14 13:45:18','Serviço de Email a excluído por admin'),(21,'admin','inclusao','Cadastro de Serviço de Envio de Email','0000-00-00 00:00:00','Serviço de Email hotmail cadastrado por admin'),(22,'admin','exclusao','Cadastro de Serviço de Envio de Email','2019-08-14 13:46:59','Serviço de Email hotmail excluído por admin'),(23,'admin','inclusao','Cadastro de Serviço de Envio de Email','2019-08-14 13:47:20','Serviço de Email Rivelli cadastrado por admin'),(24,'admin','exclusao','Cadastro de Serviço de Envio de Email','2019-08-14 13:50:05','Serviço de Email Rivelli excluído por admin'),(25,'admin','inclusao','Cadastro de Serviço de Envio de Email','2019-08-14 13:50:21','Serviço de Email abc cadastrado por admin'),(26,'admin','exclusao','Cadastro de Serviço de Envio de Email','2019-08-14 13:53:32','Serviço de Email abc excluído por admin'),(27,'admin','inclusao','Cadastro de Serviço de Envio de Email','2019-08-14 13:54:05','Serviço de Email gmail cadastrado por admin'),(28,'admin','exclusao','Cadastro de Serviço de Envio de Email','2019-08-14 13:54:31','Serviço de Email gmail excluído por admin'),(29,'admin','inclusao','Cadastro de Serviço de Envio de Email','2019-08-14 13:54:55','Serviço de Email gmail cadastrado por admin'),(30,'admin','alteracao','Manutenção de Computadores','2019-08-16 21:31:48','Computador do usuário <b>FILIPE SIQUEIRA </b> alterado por admin'),(31,'admin','inclusao','Cadastro de Computadores','2019-08-18 21:10:33','Computador do usuário Tayana Stela Rodrigues Siqueira cadastrado por admin'),(32,'admin','alteracao','Manutenção de Computadores','2019-08-18 21:10:50','Computador do usuário <b>TAYANA STELA RODRIGUES da silva SIQUEIRA </b> alterado por admin'),(33,'admin','inclusao','Cadastro de Computadores','2019-08-18 21:13:59','Computador do usuário João da Silva Santos cadastrado por admin'),(34,'admin','inclusao','Cadastro de Computadores','2019-08-18 21:16:56','Computador do usuário Marcelo Assunção de SOuza cadastrado por admin'),(35,'admin','inclusao','Cadastro de Setor','2019-08-18 21:17:17','Setor Marketing cadastrado por admin'),(36,'admin','inclusao','Cadastro de Setor','2019-08-18 21:17:27','Setor Contabilidade cadastrado por admin'),(37,'admin','inclusao','Cadastro de Setor','2019-08-18 21:17:56','Setor RH cadastrado por admin'),(38,'admin','inclusao','Cadastro de Setor','2019-08-18 21:18:08','Setor Logística cadastrado por admin'),(39,'admin','inclusao','Cadastro de Setor','2019-08-18 21:18:25','Setor Depto.Pessoal cadastrado por admin'),(40,'admin','inclusao','Cadastro de Setor','2019-08-18 21:18:58','Setor Manutenção_Elétrica cadastrado por admin'),(41,'admin','inclusao','Cadastro de Setor','2019-08-18 21:19:15','Setor Almoxarifado cadastrado por admin'),(42,'admin','inclusao','Cadastro de Setor','2019-08-18 21:19:25','Setor Compras cadastrado por admin'),(43,'admin','inclusao','Cadastro de Setor','2019-08-18 21:19:34','Setor Recepção cadastrado por admin'),(44,'admin','inclusao','Cadastro de Setor','2019-08-18 21:19:44','Setor Portaria cadastrado por admin'),(45,'admin','alteracao','Manutenção de Computadores','2019-08-18 21:20:12','Computador do usuário <b>FILIPE SIQUEIRA </b> alterado por admin'),(46,'admin','alteracao','Manutenção de Computadores','2019-08-18 21:20:24','Computador do usuário <b>JOÃO DA SILVA SANTOS </b> alterado por admin'),(47,'admin','inclusao','Cadastro de Computadores','2019-08-18 21:21:14','Computador do usuário Carlos Henrique Miguel cadastrado por admin'),(48,'admin','inclusao','Cadastro de Computadores','2019-08-18 21:22:26','Computador do usuário Adriana Souza Fonseca cadastrado por admin'),(49,'admin','alteracao','Manutenção de Computadores','2019-08-18 21:22:48','Computador do usuário <b>CARLOS HENRIQUE MIGUEL </b> alterado por admin'),(50,'admin','alteracao','Manutenção de Setor','2019-08-18 21:25:57','Setor MANUT_ELÉTRICA alterado por admin'),(51,'admin','alteracao','Manutenção de Computadores','2019-08-18 21:26:17','Computador do usuário <b>ADRIANA SOUZA FONSECA </b> alterado por admin'),(52,'admin','inclusao','Cadastro de Sistemas Operacionais','2019-08-18 21:28:24','Sistema Operacional WINDOWS 10 cadastrado por admin'),(53,'admin','alteracao','Manutenção de Documentos','2019-08-18 21:29:28','Documento AREA DE TRABALHO alterado por admin'),(54,'admin','alteracao','Manutenção de Documentos','2019-08-18 21:31:11','Documento MEUS DOCUMENTOS alterado por admin'),(55,'admin','alteracao','Manutenção de Documentos','2019-08-18 21:31:22','Documento DOWNLOADS alterado por admin'),(56,'admin','inclusao','Cadastro de Usuários','2019-08-18 21:33:02','Usuário Filipe Siqueira cadastrado por admin'),(57,'filipe','inclusao','Cadastro de Computadores','2019-08-18 21:38:44','Computador do usuário Henrique siqueira cadastrado por filipe'),(58,'filipe','inclusao','Cadastro de Computadores','2019-08-18 21:40:13','Computador do usuário Junior Fonseca cadastrado por filipe'),(59,'filipe','alteracao','Manutenção de Computadores','2019-08-18 21:40:59','Computador do usuário <b>ADRIANA SOUZA FONSECA </b> alterado por filipe'),(60,'filipe','inclusao','Cadastro de Servidor de Backup','2019-08-18 21:48:04','Servidor de Backup Teste cadastrado por filipe'),(61,'filipe','exclusao','Servidores de Backup','2019-08-18 21:48:10','Servidor de Backup Teste excluído por filipe'),(62,'filipe','inclusao','Cadastro de Sistemas Operacionais','2019-08-18 21:48:47','Sistema Operacional ubuntu cadastrado por filipe'),(63,'filipe','exclusao','Exclusão de Sistemas Operacionais','2019-08-18 21:48:52','Sistema Operacional  excluído por filipe'),(64,'filipe','inclusao','Cadastro de Sistemas Operacionais','2019-08-18 21:56:50','Sistema Operacional rereer cadastrado por filipe'),(65,'filipe','inclusao','Cadastro de Sistemas Operacionais','2019-08-18 21:56:55','Sistema Operacional eeeeee cadastrado por filipe'),(66,'filipe','exclusao','Exclusão de Sistemas Operacionais','2019-08-18 21:56:59','Sistema Operacionalexcluído por filipe'),(67,'filipe','exclusao','Exclusão de Sistemas Operacionais','2019-08-18 22:01:38','Sistema Operacionalexcluído por filipe'),(68,'filipe','inclusao','Cadastro de Sistemas Operacionais','2019-08-18 22:02:16','Sistema Operacional aaaaaaaaaaaaa cadastrado por filipe'),(69,'filipe','exclusao','Exclusão de Sistemas Operacionais','2019-08-18 22:02:20','Sistema Operacional  excluído por filipe'),(70,'filipe','inclusao','Cadastro de Sistemas Operacionais','2019-08-18 22:04:44','Sistema Operacional aaaaaaaaaaasssssss cadastrado por filipe'),(71,'filipe','inclusao','Cadastro de Sistemas Operacionais','2019-08-18 22:06:26','Sistema Operacional nnnnnnnnnnnnnnn cadastrado por filipe'),(72,'filipe','exclusao','Exclusão de Sistemas Operacionais','2019-08-18 22:06:30','Sistema Operacional NNNNNNNNNNNNNNN excluído por filipe'),(73,'filipe','inclusao','Cadastro de Sistemas Operacionais','2019-08-18 22:06:51','Sistema Operacional debian cadastrado por filipe'),(74,'filipe','inclusao','Cadastro de Sistemas Operacionais','2019-08-18 22:06:56','Sistema Operacional fedora cadastrado por filipe'),(75,'filipe','inclusao','Cadastro de Sistemas Operacionais','2019-08-18 22:07:02','Sistema Operacional mint cadastrado por filipe'),(76,'filipe','exclusao','Exclusão de Sistemas Operacionais','2019-08-18 22:07:09','Sistema Operacional DEBIAN excluído por filipe'),(77,'filipe','exclusao','Exclusão de Sistemas Operacionais','2019-08-18 22:07:14','Sistema Operacional FEDORA excluído por filipe'),(78,'filipe','exclusao','Exclusão de Sistemas Operacionais','2019-08-18 22:07:18','Sistema Operacional MINT excluído por filipe'),(79,'filipe','inclusao','Cadastro de Documentos','2019-08-18 22:09:11','Documento teste cadastrado por filipe'),(80,'filipe','exclusao','Manutenção de Documentos','2019-08-18 22:09:15','Documento TESTE excluído por filipe'),(81,'filipe','exclusao','Manutenção de Setor','2019-08-18 22:09:34','Setor COMPRAS excluído por filipe'),(82,'filipe','exclusao','Manutenção de Computadores','2019-08-18 22:11:36','Computador do usuário CARLOS HENRIQUE MIGUEL excluído do sistema por filipe'),(83,'filipe','restore','Restore de Banco de Dados','2019-08-18 22:13:45','Backup do Banco de Dados restaurado por filipe'),(84,'admin','alteracao','Manutenção de Computadores','2019-08-22 19:23:42','Computador do usuário <b>ADRIANA SOUZA FONSECA </b> alterado por admin'),(85,'admin','alteracao','Manutenção de Computadores','2019-08-22 19:32:47','Computador do usuário <b>FILIPE SIQUEIRA </b> alterado por admin'),(86,'admin','alteracao','Manutenção de Computadores','2019-08-22 19:33:25','Computador do usuário <b>FILIPE SIQUEIRA </b> alterado por admin'),(87,'admin','alteracao','Manutenção de Computadores','2019-08-22 19:39:29','Computador do usuário <b>FILIPE SIQUEIRA </b> alterado por admin'),(88,'admin','alteracao','Manutenção de Computadores','2019-08-22 19:40:58','Computador do usuário <b>ADRIANA SOUZA FONSECA </b> alterado por admin'),(89,'admin','alteracao','Manutenção de Computadores','2019-08-22 19:41:09','Computador do usuário <b>JOÃO DA SILVA SANTOS </b> alterado por admin'),(90,'admin','exclusao','Manutenção de Computadores','2019-08-22 19:52:25','Computador do usuário ADRIANA SOUZA FONSECA excluído do sistema por admin'),(91,'admin','exclusao','Manutenção de Computadores','2019-08-22 19:52:33','Computador do usuário MARCELO ASSUNÇÃO DE SOUZA excluído do sistema por admin'),(92,'admin','exclusao','Manutenção de Computadores','2019-08-22 19:52:38','Computador do usuário TAYANA STELA RODRIGUES DA SILVA SIQUEIRA excluído do sistema por admin'),(93,'admin','alteracao','Manutenção de Computadores','2019-08-29 19:18:50','Computador do usuário <b>FILIPE SIQUEIRA </b> alterado por admin'),(94,'admin','alteracao','Manutenção de Computadores','2019-08-29 19:33:42','Computador do usuário <b>FILIPE SIQUEIRA </b> alterado por admin'),(95,'admin','alteracao','Alteração de Servidor de Backup','2019-08-29 20:20:37','Servidor de Backup Server2016 alterado por admin'),(96,'admin','alteracao','Manutenção de Computadores','2019-08-29 20:21:13','Computador do usuário <b>HENRIQUE SIQUEIRA </b> alterado por admin'),(97,'admin','exclusao','Servidores de Backup','2019-08-29 20:21:19','Servidor de Backup Server2016 excluído por admin'),(98,'admin','alteracao','Manutenção de Usuários','2019-08-29 20:22:03','Usuário FILIPE SIQUEIRA alterado por admin'),(99,'admin','alteracao','Manutenção de Senha','2019-08-29 20:22:20','Senha do usuário Administrador alterada por admin'),(100,'admin','alteracao','Manutenção de Senha','2019-08-29 20:22:30','Senha do usuário Administrador alterada por admin'),(101,'admin','alteracao','Manutenção de Usuários','2019-08-29 20:22:46','Usuário FILIPE SIQUEIRA alterado por admin'),(102,'admin','exportar_database','Exportar Base de Dados','2019-08-29 20:25:39','Base de Dados exportada por admin'),(103,'admin','alteracao','Manutenção de Computadores','2019-08-29 21:12:12','Computador do usuário <b>FILIPE SIQUEIRA </b> alterado por admin'),(104,'admin','alteracao','Manutenção de Computadores','2019-08-29 21:17:20','Computador do usuário <b>FILIPE SIQUEIRA </b> alterado por admin'),(105,'admin','alteracao','Alteração de Servidor de Backup','2019-08-29 21:21:13','Servidor de Backup Srv-Sisbackup alterado por admin'),(106,'admin','alteracao','Manutenção de Computadores','2019-08-30 13:02:21','Computador do usuário <b>FILIPE SIQUEIRA </b> alterado por admin'),(107,'admin','alteracao','Manutenção de Computadores','2019-08-30 13:10:02','Computador do usuário <b>FILIPE SIQUEIRA </b> alterado por admin'),(108,'admin','alteracao','Manutenção de Computadores','2019-08-30 13:15:06','Computador do usuário <b>FILIPE SIQUEIRA </b> alterado por admin'),(109,'admin','alteracao','Alteração de Servidor de Backup','2019-08-30 13:24:48','Servidor de Backup Srv-Sisbackup alterado por admin'),(110,'admin','alteracao','Manutenção de Computadores','2019-08-30 13:30:20','Computador do usuário <b>FILIPE SIQUEIRA </b> alterado por admin'),(111,'admin','alteracao','Manutenção de Computadores','2019-08-31 10:08:35','Computador do usuário <b>FILIPE SIQUEIRA </b> alterado por admin'),(112,'admin','alteracao','Manutenção de Computadores','2019-08-31 10:11:16','Computador do usuário <b>FILIPE SIQUEIRA </b> alterado por admin'),(113,'admin','exclusao','Cadastro de Serviço de Envio de Email','2019-09-01 18:43:46','Serviço de Email GMAIL excluído por admin'),(114,'admin','inclusao','Cadastro de Serviço de Envio de Email','2019-09-01 18:44:00','Serviço de Email jhkj cadastrado por admin'),(115,'admin','exclusao','Cadastro de Serviço de Envio de Email','2019-09-01 18:44:09','Serviço de Email JHKJ excluído por admin'),(116,'admin','inclusao','Cadastro de Serviço de Envio de Email','2019-09-01 18:44:31','Serviço de Email joio cadastrado por admin'),(117,'admin','exclusao','Cadastro de Serviço de Envio de Email','2019-09-01 20:13:10','Serviço de Email JOIO excluído por admin'),(118,'admin','inclusao','Cadastro de Serviço de Envio de Email','2019-09-01 20:14:03','Serviço de Email mkmkmkmMKMK cadastrado por admin'),(119,'admin','alteracao','Alteração de Serviço de Envio de Email','2019-09-01 20:51:57','Serviço de Email MKMKMKMMKMK alterado por admin'),(120,'admin','exclusao','Cadastro de Serviço de Envio de Email','2019-09-01 20:52:02','Serviço de Email MKMKMKMMKMK excluído por admin'),(121,'admin','inclusao','Cadastro de Serviço de Envio de Email','2019-09-01 20:52:15','Serviço de Email ipipoi cadastrado por admin'),(122,'admin','exclusao','Cadastro de Serviço de Envio de Email','2019-09-01 20:55:54','Serviço de Email IPIPOI excluído por admin'),(123,'admin','alteracao','Manutenção de Computadores','2019-09-01 21:59:07','Computador do usuário <b>FILIPE SIQUEIRA </b> alterado por admin'),(124,'admin','inclusao','Cadastro de Serviço de Envio de Email','2019-09-01 22:02:22','Serviço de Email gmail cadastrado por admin'),(125,'admin','alteracao','Manutenção de Computadores','2019-09-01 22:11:42','Computador do usuário <b>FILIPE SIQUEIRA </b> alterado por admin'),(126,'admin','alteracao','Manutenção de Computadores','2019-09-01 22:11:57','Computador do usuário <b>FILIPE SIQUEIRA </b> alterado por admin'),(127,'admin','inclusao','Cadastro de Servidor de Backup','2019-09-01 22:33:58','Servidor de Backup Server2016 cadastrado por admin'),(128,'admin','alteracao','Manutenção de Computadores','2019-09-01 22:34:56','Computador do usuário <b>FILIPE SIQUEIRA </b> alterado por admin'),(129,'filipe','reduz_backup','Reduzir Backup','2019-09-01 22:45:28','Backup do usuário FILIPE SIQUEIRA reduzido por filipe'),(130,'admin','alteracao','Manutenção de Computadores','2019-09-01 22:49:18','Computador do usuário <b>FILIPE SIQUEIRA </b> alterado por admin'),(131,'admin','alteracao','Manutenção de Usuários','2019-09-01 22:54:10','Usuário FILIPE SIQUEIRA alterado por admin');
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
  `backup_status` varchar(255) NOT NULL,
  PRIMARY KEY (`backup_id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `backups_realizados`
--

LOCK TABLES `backups_realizados` WRITE;
/*!40000 ALTER TABLE `backups_realizados` DISABLE KEYS */;
INSERT INTO `backups_realizados` VALUES (23,6,'2019-08-20 13:00:26','AUTOMATICO','SUCESSO'),(25,4,'2019-08-20 14:00:14','AUTOMATICO','SUCESSO'),(35,2,'2019-08-21 15:00:33','AUTOMATICO','SUCESSO'),(37,7,'2019-08-21 16:00:20','AUTOMATICO','SUCESSO'),(38,1,'2019-08-30 13:46:25','MANUAL',''),(39,1,'2019-08-31 10:11:26','MANUAL','SUCESSO'),(40,1,'2019-08-31 10:35:52','MANUAL',''),(41,1,'2019-09-01 22:01:48','MANUAL','SUCESSO'),(42,1,'2019-09-01 22:05:08','MANUAL','SUCESSO'),(43,1,'2019-09-01 22:08:09','MANUAL','SUCESSO'),(44,1,'2019-09-01 22:14:49','MANUAL','SUCESSO'),(45,1,'2019-09-01 22:37:37','MANUAL','SUCESSO'),(46,1,'2019-09-01 22:47:29','MANUAL','SUCESSO');
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='Tabela que armazena o cadastro dos computadores';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `computadores`
--

LOCK TABLES `computadores` WRITE;
/*!40000 ALTER TABLE `computadores` DISABLE KEYS */;
INSERT INTO `computadores` VALUES (1,'FILIPE SIQUEIRA','filipe','MTIz','10.0.0.106','4a:s5:d4:f8:g7:h9','1',0,1,1,1,1,1,1,'23',2,'NÃO','NÃO','8','2019-08-14 00:52:50','2019-09-01 22:49:17','filipe','SIM'),(3,'JOÃO DA SILVA SANTOS','Joao','Wzg3NTQ1NDU0NDU=','10.0.0.100','as:df:66:59:89:89','1',1,0,1,0,1,0,1,'14',1,'NÃO','NÃO','3','2019-08-18 21:13:58','2019-08-22 19:41:08','Administrador','NÃO'),(7,'HENRIQUE SIQUEIRA','Henrique','MjYrNDYrNSs2NSs5','10.0.0.12','98:d7:f8:9g:7h:98','2',1,0,1,0,1,0,1,'16',1,'NÃO','NÃO','7','2019-08-18 21:38:44','2019-08-29 20:21:13','Administrador','NÃO'),(8,'JUNIOR FONSECA','Junior','MTMxMjMxMzI=','10.0.0.11','1s:d6:f5:48:94:89','2',0,0,0,0,0,0,0,'15',1,'NÃO','NÃO','12','2019-08-18 21:40:13','0000-00-00 00:00:00','Administrador','NÃO');
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='tabela que armazena informacao do diretorio do documento em cada sistema operacional';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `diretorio_documentos`
--

LOCK TABLES `diretorio_documentos` WRITE;
/*!40000 ALTER TABLE `diretorio_documentos` DISABLE KEYS */;
INSERT INTO `diretorio_documentos` VALUES (4,1,2,'C:/Users/usuario/Desktop'),(5,1,1,'C:/Users/usuario/Desktop'),(6,2,2,'C:/Users/usuario/Documents'),(7,2,1,'C:/Users/usuario/Documents'),(8,3,2,'C:/Users/usuario/Downloads'),(9,3,1,'C:/Users/usuario/Downloads');
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='tabela que armazena o cadastro de documentos';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documentos`
--

LOCK TABLES `documentos` WRITE;
/*!40000 ALTER TABLE `documentos` DISABLE KEYS */;
INSERT INTO `documentos` VALUES (1,'AREA DE TRABALHO'),(2,'MEUS DOCUMENTOS'),(3,'DOWNLOADS');
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registro_backup`
--

LOCK TABLES `registro_backup` WRITE;
/*!40000 ALTER TABLE `registro_backup` DISABLE KEYS */;
INSERT INTO `registro_backup` VALUES (1,'sisbackup-18-08-2019-22:12:40.sql'),(2,'sisbackup-22-08-2019-19:56:16.sql'),(3,'sisbackup-01-09-2019-22:54:40.sql');
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
INSERT INTO `servidores` VALUES (1,'Srv-Sisbackup','127.0.0.1','root','MDVhZDAwc3A=','sisbackup','Linux'),(2,'Server2016','10.0.0.115','Administrator','MDVBZDAwc3Aq','BackupUsers','Windows');
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='cadastro de setores';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `setores`
--

LOCK TABLES `setores` WRITE;
/*!40000 ALTER TABLE `setores` DISABLE KEYS */;
INSERT INTO `setores` VALUES (1,'sisbackup','sisbackup'),(2,'TI','Setor de tecnologia da informação'),(3,'FINANCEIRO','Setor de financeiro'),(4,'MARKETING','Setor de marketing da empresa'),(5,'CONTABILIDADE','Setor de contabilidade'),(6,'RH','Setor de recursos humanos da empresa'),(7,'LOGÍSTICA','Setor de logística da empresa'),(8,'DEPTO.PESSOAL','Setor de departamento pessoal'),(9,'MANUT_ELÉTRICA','Manutenção Elétrica'),(10,'ALMOXARIFADO','Almoxarifado'),(12,'RECEPÇÃO','Setor de recepção'),(13,'PORTARIA','Setor de portaria');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='tabela que armazena o cadastro de sistema operacional';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sistemas_operacionais`
--

LOCK TABLES `sistemas_operacionais` WRITE;
/*!40000 ALTER TABLE `sistemas_operacionais` DISABLE KEYS */;
INSERT INTO `sistemas_operacionais` VALUES (1,'WINDOWS 8','WINDOWS'),(2,'WINDOWS 10','LINUX');
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `smtp`
--

LOCK TABLES `smtp` WRITE;
/*!40000 ALTER TABLE `smtp` DISABLE KEYS */;
INSERT INTO `smtp` VALUES (15,'GMAIL','backuplinux2017@gmail.com','smtp.gmail.com',587,'MDVhZDAwc3A=');
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
INSERT INTO `usuarios` VALUES (1,'Administrador','admin','a2de5d65f926d068f3f6513ec7c9644e','ATIVO',1,'filipe4009@hotmail.com',0,NULL),(2,'FILIPE SIQUEIRA','filipe','ac50e462b183996f05086e9bb08e35ab','BLOQUEADO',2,'filipe4009@hotmail.com',0,'0000-00-00 00:00:00');
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

-- Dump completed on 2019-09-01 22:54:41
