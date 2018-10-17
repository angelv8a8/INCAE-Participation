-- MySQL dump 10.13  Distrib 8.0.12, for macos10.13 (x86_64)
--
-- Host: localhost    Database: incae_class
-- ------------------------------------------------------
-- Server version	8.0.12

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8mb4 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `course`
--

DROP TABLE IF EXISTS `course`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_169E6FB9AFC2B591` (`module_id`),
  CONSTRAINT `FK_169E6FB9AFC2B591` FOREIGN KEY (`module_id`) REFERENCES `module` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course`
--

LOCK TABLES `course` WRITE;
/*!40000 ALTER TABLE `course` DISABLE KEYS */;
INSERT INTO `course` VALUES (3,1,'Introducción a la administración','Introducción a la administración','INTRADM');
/*!40000 ALTER TABLE `course` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_students`
--

DROP TABLE IF EXISTS `course_students`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `course_students` (
  `course_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`course_id`,`user_id`),
  KEY `IDX_DDDE0E4591CC992` (`course_id`),
  KEY `IDX_DDDE0E4A76ED395` (`user_id`),
  CONSTRAINT `FK_DDDE0E4591CC992` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_DDDE0E4A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_students`
--

LOCK TABLES `course_students` WRITE;
/*!40000 ALTER TABLE `course_students` DISABLE KEYS */;
/*!40000 ALTER TABLE `course_students` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_teachers`
--

DROP TABLE IF EXISTS `course_teachers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `course_teachers` (
  `course_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`course_id`,`user_id`),
  KEY `IDX_44B372A0591CC992` (`course_id`),
  KEY `IDX_44B372A0A76ED395` (`user_id`),
  CONSTRAINT `FK_44B372A0591CC992` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_44B372A0A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_teachers`
--

LOCK TABLES `course_teachers` WRITE;
/*!40000 ALTER TABLE `course_teachers` DISABLE KEYS */;
INSERT INTO `course_teachers` VALUES (3,1);
/*!40000 ALTER TABLE `course_teachers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `module`
--

DROP TABLE IF EXISTS `module`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `module` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `program_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C2426283EB8070A` (`program_id`),
  CONSTRAINT `FK_C2426283EB8070A` FOREIGN KEY (`program_id`) REFERENCES `program` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `module`
--

LOCK TABLES `module` WRITE;
/*!40000 ALTER TABLE `module` DISABLE KEYS */;
INSERT INTO `module` VALUES (1,1,'Modulo 1','Modulo 1');
/*!40000 ALTER TABLE `module` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `program`
--

DROP TABLE IF EXISTS `program`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `program` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `program`
--

LOCK TABLES `program` WRITE;
/*!40000 ALTER TABLE `program` DISABLE KEYS */;
INSERT INTO `program` VALUES (1,'Liderazgo Latinoamericano 1','LL1',2018);
/*!40000 ALTER TABLE `program` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES (1,'Estudiante','Role Estudiante','ROLE_STUDENT'),(2,'Profesor','Profesor','ROLE_TEACHER'),(3,'Administrador','Administrador','ROLE_ADMIN');
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_users`
--

DROP TABLE IF EXISTS `role_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `role_users` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `IDX_E35F4DC6A76ED395` (`user_id`),
  KEY `IDX_E35F4DC6D60322AC` (`role_id`),
  CONSTRAINT `FK_E35F4DC6A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_E35F4DC6D60322AC` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_users`
--

LOCK TABLES `role_users` WRITE;
/*!40000 ALTER TABLE `role_users` DISABLE KEYS */;
INSERT INTO `role_users` VALUES (1,1),(1,2),(1,3);
/*!40000 ALTER TABLE `role_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `session`
--

DROP TABLE IF EXISTS `session`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `session` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` datetime NOT NULL,
  `student_can_update` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `IDX_D044D5D4591CC992` (`course_id`),
  CONSTRAINT `FK_D044D5D4591CC992` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `session`
--

LOCK TABLES `session` WRITE;
/*!40000 ALTER TABLE `session` DISABLE KEYS */;
INSERT INTO `session` VALUES (1,3,'Sesión 1','Sesión 1','2018-10-15 15:34:08',1),(2,3,'Sesión 2','Sesión 2','2018-10-15 15:36:29',1),(4,3,'Sesión 3','Sesión 3','2018-10-15 17:18:21',1),(5,3,'Sesión 4','Sesión 4','2018-10-16 00:22:30',0),(6,3,'Sesión 5','Sesión 5','2018-10-16 05:46:32',0),(7,3,'Sesión 6','Sesión 6','2018-10-16 06:00:14',0),(8,3,'Sesión 7','Realice la aportación que habla sobre al adlsfjaksdf ñasdlkfj adñflkjeñlfk salñdfkjewopi3jr203fjadlsñfkjasdf ñlwqekfj asdlfkjsd flskjf asldfjk asldfkjs adlfkjsa dlfksaj dff','2018-10-16 18:57:50',1),(9,3,'Sesión 8','Sesión 8','2018-10-16 19:07:50',1);
/*!40000 ALTER TABLE `session` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `incae_id` int(11) NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`),
  UNIQUE KEY `UNIQ_8D93D649CEC56B5B` (`incae_id`)
) ENGINE=InnoDB AUTO_INCREMENT=212 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'$2y$13$se6DfvparAQUymxBRw9xgOPaxE5QvaOdZDKpMFsdnSeDShc0ckCFW','admin@incae.edu','662c0ef4029ba48fa79a037245aff26f.jpeg','Super Admin',0,'Super','Admin'),(127,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','adriana.ortizf@mba2019.incae.edu',NULL,'Adriana Ortiz Flamenco',887472,'Adriana','Ortiz Flamenco'),(128,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','alejandro.almendarez@mba2019.incae.edu',NULL,'Alejandro José Almendárez Lacayo',81335865,'Alejandro José','Almendárez Lacayo'),(129,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','alex.gonzalez@mba2019.incae.edu',NULL,'Alex Horacio González Murillo',81335531,'Alex Horacio','González Murillo'),(130,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','andrea.oyanguren@mba2019.incae.edu',NULL,'Andrea Oyanguren Cortijo',18636842,'Andrea','Oyanguren Cortijo'),(131,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','andrea.bonilla@mba2019.incae.edu',NULL,'Andrea Carolina Bonilla Medina',81330606,'Andrea Carolina','Bonilla Medina'),(132,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','andrea.lopez@mba2019.incae.edu',NULL,'Andrea Michelle López Rosa',81337817,'Andrea Michelle','López Rosa'),(133,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','polet.herrera@mba2019.incae.edu',NULL,'Andrea Polet Herrera Bucheli',73004068,'Andrea Polet','Herrera Bucheli'),(134,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','andres.leiton@mba2019.incae.edu',NULL,'Andrés Leiton Rojas',81336977,'Andrés','Leiton Rojas'),(135,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','andres.guzman@mba2019.incae.edu',NULL,'Andrés Alberto Guzmán Herrera',81334678,'Andrés Alberto','Guzmán Herrera'),(136,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','angel.mendieta@mba2019.incae.edu',NULL,'Ángel Santos Mendieta Barrios',81330642,'Ángel Santos','Mendieta Barrios'),(137,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','angel.ochoa@mba2019.incae.edu',NULL,'Angel Virgilio Ochoa Castillo',81336538,'Angel Virgilio','Ochoa Castillo'),(138,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','arnoldo.brenes@mba2019.incae.edu',NULL,'Arnoldo Brenes Simon',81335784,'Arnoldo','Brenes Simon'),(139,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','baggda.nolasco@mba2019.incae.edu',NULL,'Baggda Nolasco Fuentes',54320309,'Baggda','Nolasco Fuentes'),(140,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','carlos.gutierrez@mba2019.incae.edu',NULL,'Carlos Andres Gutiérrez Garbanzo',81336259,'Carlos Andres','Gutiérrez Garbanzo'),(141,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','carlos.acosta@mba2019.incae.edu',NULL,'Carlos Andrés Acosta Zúñiga',81330976,'Carlos Andrés','Acosta Zúñiga'),(142,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','christian.urroz@mba2019.incae.edu',NULL,'Christian Adrian Urroz Reyes',79375526,'Christian Adrian','Urroz Reyes'),(143,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','cristina.arindia@mba2019.incae.edu',NULL,'Cristina Elizabeth Arindia Cordero',81337822,'Cristina Elizabeth','Arindia Cordero'),(144,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','daniel.hidalgo@mba2019.incae.edu',NULL,'Daniel Paul Hidalgo Cevallos',81335075,'Daniel Paul','Hidalgo Cevallos'),(145,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','david.burneo@mba2019.incae.edu',NULL,'David Burneo Burneo',81335609,'David','Burneo Burneo'),(146,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','dennis.concha@mba2019.incae.edu',NULL,'Dennis André Concha Sierralta',81334314,'Dennis André','Concha Sierralta'),(147,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','dulce.duarte@mba2019.incae.edu',NULL,'Dulce María Duarte',81330196,'Dulce María','Duarte'),(148,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','eduardo.ramirez@mba2019.incae.edu',NULL,'Eduardo José Ramírez Díaz',81330963,'Eduardo José','Ramírez Díaz'),(149,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','eduardo.demenaruffo@mba2019.incae.edu',NULL,'Eduardo Miguel De Mena Ruffo',81330183,'Eduardo Miguel','De Mena Ruffo'),(150,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','efrain.chacon@mba2019.incae.edu',NULL,'Efraín Chacón Buendía',81337587,'Efraín','Chacón Buendía'),(151,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','eliberth.ascue@mba2019.incae.edu',NULL,'Eliberth Donavic Ascue Pallqui',81335905,'Eliberth Donavic','Ascue Pallqui'),(152,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','elsy.cordero@mba2019.incae.edu',NULL,'Elsy Yesenia Cordero Mejia',81336305,'Elsy Yesenia','Cordero Mejia'),(153,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','enaida.castillo@mba2019.incae.edu',NULL,'Enaida del Carmen Castillo De Gracia',51608059,'Enaida del Carmen','Castillo De Gracia'),(154,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','felipe.teran@mba2019.incae.edu',NULL,'Felipe Terán González',81331691,'Felipe','Terán González'),(155,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','felix.perez@mba2019.incae.edu',NULL,'Felix Alberto Perez Fumarola',81333390,'Felix Alberto','Perez Fumarola'),(156,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','felix.hernandez@mba2019.incae.edu',NULL,'Félix Magdiel Hernández Castillo',6272302,'Félix Magdiel','Hernández Castillo'),(157,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','fiorella.lazo@mba2019.incae.edu',NULL,'Fiorella Lazo Antonio',81334002,'Fiorella','Lazo Antonio'),(158,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','francisco.flores@mba2019.incae.edu',NULL,'Francisco José Flores Flores',81335820,'Francisco José','Flores Flores'),(159,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','gabriel.alvarenga@mba2019.incae.edu',NULL,'Gabriel Alexander Alvarenga',81337362,'Gabriel Alexander','Alvarenga'),(160,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','guerald.flores@mba2019.incae.edu',NULL,'Guerald Eduardo Flores Hurtado',81338157,'Guerald Eduardo','Flores Hurtado'),(161,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','hector.velasquez@mba2019.incae.edu',NULL,'Héctor José Velásquez Moreno',57470510,'Héctor José','Velásquez Moreno'),(162,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','ignacio.sandi@mba2019.incae.edu',NULL,'Ignacio Alejandro Sandí Fonseca',81335894,'Ignacio Alejandro','Sandí Fonseca'),(163,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','italo.sosa@mba2019.incae.edu',NULL,'Italo Cesar Sosa Hernández',58629894,'Italo Cesar','Sosa Hernández'),(164,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','jaime.samayoa@mba2019.incae.edu',NULL,'Jaime Manolo Samayoa González',68743753,'Jaime Manolo','Samayoa González'),(165,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','jennifer.bravo@mba2019.incae.edu',NULL,'Jennifer Bravo Hoyos',100,'Jennifer','Bravo Hoyos'),(166,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','jesus.ramirez@mba2019.incae.edu',NULL,'Jesús Alberto Ramírez Costales',31157916,'Jesús Alberto','Ramírez Costales'),(167,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','jesus.pacheco@mba2019.incae.edu',NULL,'Jesús Josué Pacheco Brizuela',81332067,'Jesús Josué','Pacheco Brizuela'),(168,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','joan.zevallos@mba2019.incae.edu',NULL,'Joan Rosell Zevallos',81338134,'Joan','Rosell Zevallos'),(169,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','jose.flamenco@mba2019.incae.edu',NULL,'José Angel Flamenco Francés',81333825,'José Angel','Flamenco Francés'),(170,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','jose.ardon@mba2019.incae.edu',NULL,'José Antonio Ardón Gutiérrez',54305028,'José Antonio','Ardón Gutiérrez'),(171,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','jose.degracia@mba2019.incae.edu',NULL,'José Fernando De Gracia Santamaria',81336324,'José Fernando','De Gracia Santamaria'),(172,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','josel.chavez@mba2019.incae.edu',NULL,'José Luis Chávez Montoya',81338152,'José Luis','Chávez Montoya'),(173,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','jose.quirosm@mba2019.incae.edu',NULL,'José Miguel Quirós Montoya',81336775,'José Miguel','Quirós Montoya'),(174,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','joshua.hernandez@mba2019.incae.edu',NULL,'Joshua Alexander Hernández Panduro',81336656,'Joshua Alexander','Hernández Panduro'),(175,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','josue.mejia@mba2019.incae.edu',NULL,'Josué Alejandro Mejía Fernández',81333325,'Josué Alejandro','Mejía Fernández'),(176,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','josue.cabrera@mba2019.incae.edu',NULL,'Josué Jesús Cabrera Ruilova',81334341,'Josué Jesús','Cabrera Ruilova'),(177,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','juan.angeles@mba2019.incae.edu',NULL,'Juan Augusto Angeles Quevedo',69256280,'Juan Augusto','Angeles Quevedo'),(178,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','juan.estrada@mba2019.incae.edu',NULL,'Juan Carlos Estrada Rivera',81336179,'Juan Carlos','Estrada Rivera'),(179,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','juan.ochoa@mba2019.incae.edu',NULL,'Juan Carlos Ochoa Rodríguez',33964361,'Juan Carlos','Ochoa Rodríguez'),(180,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','juan.rojass@mba2019.incae.edu',NULL,'Juan Esteban Rojas Soto',81336755,'Juan Esteban','Rojas Soto'),(181,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','juan.cazenave@mba2019.incae.edu',NULL,'Juan Martin Cazenave Serratti',81335594,'Juan Martin','Cazenave Serratti'),(182,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','laura.colindres@mba2019.incae.edu',NULL,'Laura Melissa Colindres Flores',52264726,'Laura Melissa','Colindres Flores'),(183,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','leonardo.velasquez@mba2019.incae.edu',NULL,'Leonardo Velásquez Torres',81338185,'Leonardo','Velásquez Torres'),(184,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','leymer.garzon@mba2019.incae.edu',NULL,'Leymer Ivan Garzón Castillo',81334768,'Leymer Ivan','Garzón Castillo'),(185,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','lucia.urrutia@mba2019.incae.edu',NULL,'Lucía Carolina Urrutia Hurtado',61037493,'Lucía Carolina','Urrutia Hurtado'),(186,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','luis.serrano@mba2019.incae.edu',NULL,'Luis Alfonso Serrano Ayon',81336644,'Luis Alfonso','Serrano Ayon'),(187,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','luis.acuna@mba2019.incae.edu',NULL,'Luis Gilbert Acuña Flores',81335109,'Luis Gilbert','Acuña Flores'),(188,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','luisa.lopez@mba2019.incae.edu',NULL,'Luisa Fernanda López Cuellar',81333477,'Luisa Fernanda','López Cuellar'),(189,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','maria.torres@mba2019.incae.edu',NULL,'María de los Ángeles Torres Rodríguez',73390311,'María de los Ángeles','Torres Rodríguez'),(190,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','maria.medina@mba2019.incae.edu',NULL,'Maria Jose Medina Carmona',81333339,'Maria Jose','Medina Carmona'),(191,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','maria.ramirezp@mba2019.incae.edu',NULL,'María José Ramírez Penagos',81332615,'María José','Ramírez Penagos'),(192,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','mariana.ordinola@mba2019.incae.edu',NULL,'Mariana Milagros Ordinola Macha',81336274,'Mariana Milagros','Ordinola Macha'),(193,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','marlon.canase@mba2019.incae.edu',NULL,'Marlon Abercio Cañas Enamorado',56533118,'Marlon Abercio','Cañas Enamorado'),(194,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','mercy.ayala@mba2019.incae.edu',NULL,'Mercy Lorena Ayala Rivera',81337875,'Mercy Lorena','Ayala Rivera'),(195,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','miguel.juarez@mba2019.incae.edu',NULL,'Miguel Antonio Juarez Illescas',37638872,'Miguel Antonio','Juarez Illescas'),(196,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','milagros.munoz@mba2019.incae.edu',NULL,'Milagros Raquel Muñoz Tenorio',81335631,'Milagros Raquel','Muñoz Tenorio'),(197,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','narda.gonzalez@mba2019.incae.edu',NULL,'Narda Soledad González Morales',77804071,'Narda Soledad','González Morales'),(198,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','noel.chamorro@mba2019.incae.edu',NULL,'Noel Chamorro Tijerino',81333538,'Noel','Chamorro Tijerino'),(199,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','oscar.ochoa@mba2019.incae.edu',NULL,'Óscar David Ochoa Fernández',51729943,'Óscar David','Ochoa Fernández'),(200,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','rainiero.dinarte@mba2019.incae.edu',NULL,'Rainiero Dinarte Chavarría',81338249,'Rainiero','Dinarte Chavarría'),(201,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','ramiro.rodas@mba2019.incae.edu',NULL,'Ramiro Alejandro Rodas Gutiérrez',81332743,'Ramiro Alejandro','Rodas Gutiérrez'),(202,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','rebeca.soto@mba2019.incae.edu',NULL,'Rebeca Soto Salguero',81337549,'Rebeca','Soto Salguero'),(203,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','roberto.chiclote@mba2019.incae.edu',NULL,'Roberto Chiclote Valdivia',81335364,'Roberto','Chiclote Valdivia'),(204,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','roberto.samayoa@mba2019.incae.edu',NULL,'Roberto Andrés Samayoa Morales',81337917,'Roberto Andrés','Samayoa Morales'),(205,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','robin.lopez@mba2019.incae.edu',NULL,'Robín Alejandro López Mayorquin',210738,'Robín Alejandro','López Mayorquin'),(206,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','roderick.gonzalez@mba2019.incae.edu',NULL,'Roderick Orestes González Caballero',81332672,'Roderick Orestes','González Caballero'),(207,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','sergio.argueta@mba2019.incae.edu',NULL,'Sergio Abraham Argueta Juárez',81335586,'Sergio Abraham','Argueta Juárez'),(208,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','veronica.benalcazar@mba2019.incae.edu',NULL,'Verónica Lucía Benalcázar Sandoval',65230819,'Verónica Lucía','Benalcázar Sandoval'),(209,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','virgie.castro@mba2019.incae.edu',NULL,'Virgie Marie Castro-Conde Agüero',81330145,'Virgie Marie','Castro-Conde Agüero'),(210,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','yasnary.castellanos@mba2019.incae.edu',NULL,'Yasnary Missiel Castellanos Betancourth',81331070,'Yasnary Missiel','Castellanos Betancourth'),(211,'$2y$13$0xBe0rh8/M31.C/Of59RhO02oPXuVl87wpnGpWvdEtU3UJkcqMLOW','angela.zambrano@mba2019.incae.edu',NULL,'Angela  Zambrano',200,'Angela ','Zambrano');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_course`
--

DROP TABLE IF EXISTS `user_course`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `user_course` (
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`course_id`),
  KEY `IDX_73CC7484A76ED395` (`user_id`),
  KEY `IDX_73CC7484591CC992` (`course_id`),
  CONSTRAINT `FK_73CC7484591CC992` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_73CC7484A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_course`
--

LOCK TABLES `user_course` WRITE;
/*!40000 ALTER TABLE `user_course` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_course` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_course_session`
--

DROP TABLE IF EXISTS `user_course_session`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `user_course_session` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_note` int(11) DEFAULT '0',
  `teacher_note` int(11) DEFAULT NULL,
  `teacher_reviewed` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` int(11) DEFAULT NULL,
  `course_session_id` int(11) DEFAULT NULL,
  `student_reviewed` tinyint(1) NOT NULL DEFAULT '0',
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B3020F61A76ED395` (`user_id`),
  KEY `IDX_B3020F61BEDDA25C` (`course_session_id`),
  CONSTRAINT `FK_B3020F61A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_B3020F61BEDDA25C` FOREIGN KEY (`course_session_id`) REFERENCES `session` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=445 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_course_session`
--

LOCK TABLES `user_course_session` WRITE;
/*!40000 ALTER TABLE `user_course_session` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_course_session` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-10-17  1:57:32
