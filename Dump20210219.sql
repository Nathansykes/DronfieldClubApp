-- MySQL dump 10.13  Distrib 8.0.22, for Win64 (x86_64)
--
-- Host: localhost    Database: dronfield
-- ------------------------------------------------------
-- Server version	8.0.22

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `archivestudents`
--

DROP TABLE IF EXISTS `archivestudents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `archivestudents` (
  `studentNum` varchar(8) DEFAULT NULL,
  `studentName` char(30) DEFAULT NULL,
  `studentDOB` date DEFAULT NULL,
  `studentAddress` varchar(26) DEFAULT NULL,
  `parentName` char(26) DEFAULT NULL,
  `parentEmail` varchar(26) DEFAULT NULL,
  `parentPhone` varchar(15) DEFAULT NULL,
  `studentMedical` varchar(1000) DEFAULT NULL,
  `timeOfArchive` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `archivestudents`
--

LOCK TABLES `archivestudents` WRITE;
/*!40000 ALTER TABLE `archivestudents` DISABLE KEYS */;
/*!40000 ALTER TABLE `archivestudents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `attendance`
--

DROP TABLE IF EXISTS `attendance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `attendance` (
  `classId` int NOT NULL,
  `studentNum` varchar(8) NOT NULL,
  `timeOfAttendance` datetime NOT NULL,
  `attendance` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`classId`,`studentNum`,`timeOfAttendance`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attendance`
--

LOCK TABLES `attendance` WRITE;
/*!40000 ALTER TABLE `attendance` DISABLE KEYS */;
INSERT INTO `attendance` VALUES (1,'34t58342','2021-02-15 00:00:00',0),(1,'34t58342','2021-02-16 00:00:00',0),(1,'34t58342','2021-02-19 00:00:00',1),(1,'a3457802','2021-02-15 00:00:00',1),(1,'a3457802','2021-02-16 00:00:00',1),(1,'Ben','2021-02-19 00:00:00',1),(1,'d7791876','2021-02-16 00:00:00',1),(1,'d7791876','2021-02-17 00:00:00',1),(1,'p7786254','2021-02-16 00:00:00',1),(1,'p7786254','2021-02-17 00:00:00',1),(1,'u5917308','2021-02-17 00:00:00',1),(1,'u5917308','2021-02-18 00:00:00',1),(1,'w4378631','2021-02-16 00:00:00',1),(1,'w4378631','2021-02-17 00:00:00',1),(1,'w4378631','2021-02-18 00:00:00',1),(1,'w4378631','2021-02-19 00:00:00',0),(2,'a3457802','2021-02-18 00:00:00',1),(2,'d7791876','2021-02-18 00:00:00',0),(2,'p7786254','2021-02-18 00:00:00',1),(5,'23432434','2021-02-15 00:00:00',1),(5,'34t58342','2021-02-15 00:00:00',1),(5,'4653h898','2021-02-15 00:00:00',1);
/*!40000 ALTER TABLE `attendance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `classes`
--

DROP TABLE IF EXISTS `classes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `classes` (
  `classId` int NOT NULL AUTO_INCREMENT,
  `classDay` char(20) DEFAULT NULL,
  `classTime` datetime DEFAULT NULL,
  `classStaff` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`classId`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `classes`
--

LOCK TABLES `classes` WRITE;
/*!40000 ALTER TABLE `classes` DISABLE KEYS */;
INSERT INTO `classes` VALUES (1,'Tuesday','0000-00-00 16:00:00','Mr. Hazey'),(2,'Tuesday','0000-00-00 18:00:00','Mrs. Jane'),(3,'Tuesday','0000-00-00 17:00:00','Mr. Fritz'),(4,'Tuesday','0000-00-00 16:00:00','Miss. Smith'),(5,'Tuesday','0000-00-00 20:00:00','Ms. Scott'),(6,'Tuesday','0000-00-00 19:00:00','Mr. Thorn'),(7,'Tuesday','0000-00-00 17:00:00','Mrs. Lee');
/*!40000 ALTER TABLE `classes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `classmember`
--

DROP TABLE IF EXISTS `classmember`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `classmember` (
  `classId` int NOT NULL,
  `studentNum` varchar(8) NOT NULL,
  PRIMARY KEY (`classId`,`studentNum`),
  KEY `student_FK` (`studentNum`),
  CONSTRAINT `class_FK` FOREIGN KEY (`classId`) REFERENCES `classes` (`classId`),
  CONSTRAINT `student_FK` FOREIGN KEY (`studentNum`) REFERENCES `students` (`studentNum`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `classmember`
--

LOCK TABLES `classmember` WRITE;
/*!40000 ALTER TABLE `classmember` DISABLE KEYS */;
INSERT INTO `classmember` VALUES (6,'23432434'),(5,'4653h898'),(1,'a3457802'),(2,'a3457802'),(5,'a6573940'),(7,'a7843532'),(2,'d7791876'),(3,'f7266398'),(4,'i2877639'),(4,'j7693792'),(2,'p7786254'),(7,'s5554337'),(4,'s6682838'),(6,'s891313'),(3,'u5917308'),(1,'w2569813'),(2,'w4378631');
/*!40000 ALTER TABLE `classmember` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `students` (
  `studentNum` varchar(8) NOT NULL,
  `studentName` char(50) DEFAULT NULL,
  `studentDOB` date DEFAULT NULL,
  `studentAddress` varchar(50) DEFAULT NULL,
  `parentName` char(50) DEFAULT NULL,
  `parentEmail` varchar(80) DEFAULT NULL,
  `parentPhone` varchar(15) DEFAULT NULL,
  `studentMedical` varchar(1000) DEFAULT 'N/A',
  `lastPaidDate` datetime DEFAULT NULL,
  PRIMARY KEY (`studentNum`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `students`
--

LOCK TABLES `students` WRITE;
/*!40000 ALTER TABLE `students` DISABLE KEYS */;
INSERT INTO `students` VALUES ('23432434','Trevor Johnson','2005-03-20','6 Oakview Street','Joanne Johnson','joannej798@gmail.com','07235423543','Null',NULL),('4653h898','Daniel James','2009-07-27','23 Bobby Avenue ','Claire Gem','Cgem@mymail.com','07404203176','N/A','2021-02-04 00:00:00'),('a3457802','James Chester','2009-02-21','1 High Street','Merry Chester','chris@email.com','07526739021','N/A',NULL),('a4968274','Nathan Sykes','2006-06-22','1 Top Street','Garry','Nathansykes10@hotmail.com','082478462','',NULL),('a6573940','Bilbo Brandagamba','2005-06-10','49 Guildry Street','Deagol Brandagamba','Deagol@jourrapide.com','079 6226 7129','',NULL),('a7459375','Edward Sanchez','2011-02-19','1124 Hinkle Lake Road','Joe Sanchez','Joe@mail.com','084654564','',NULL),('a7843532','Jack Pott','2003-03-12','long road','jo','jo@mail.com','058945984','',NULL),('d7791876','Jos Buttler','2007-02-13','Smack Road','Micheal Vaugh','mvagh@mymail.com','07568234495','N/A',NULL),('f7266398','Virat Kohli','2008-03-18','Vicky Street','Ravi Shashtri','Ravis@mymail.com','07936651287','N/A',NULL),('g7563012','Adelard Bolger-Baggins','2004-06-09','9 Great Western Road','Cotman Bolger-Baggins','CotmanBolger-Baggins@armyspy.com','078 8502 5089','',NULL),('h934890','Ben Jefferson','2020-10-19','17 Frozen Pines','Neil Jefferson','benjefferson182@gmail.com','08342943434','N/A',NULL),('i2877639','Marnus Labuchagne','2009-09-15','Aussie Way','Barry Handler','Barry@mymail.com','07966525128','N/A',NULL),('j1579365','Moshitakatotemo Rinkushishikilukikutate','2004-06-19','42 Simone Weil Avenue','Takumotokashite Rinkushishikilukikutate','Takumotokashite.Rinkushishikilukikutate@armyspy.com','07769781956','',NULL),('j7693792','Ricky Ponting','2010-07-30','Windy Street','Nathan Small','Nathan@mymail.com','07396656235','N/A',NULL),('p7786254','Faf Duplesis','2010-05-06','3 Dome Way','Jack Kallis','Kallis@mymail.com','07557712433','N/A','2020-12-31 00:00:00'),('s5554337','Sean O Hearty','1999-02-03','85 Zoo Lane','Padding Zero','pzero@myhack.net','Same as above','',NULL),('s6682838','Steve Smith','2009-08-27','Century Road','Fin Flem','Flem@mymail.com','07947263888','N/A',NULL),('s891313','Wee Man','1986-12-08','65 Stinky Street','Parent Name','email@mymail.com','Jeff','N/A',NULL),('u5917308','Emily Jacob','2008-01-11','7 Margin Street','Stuart Kary','Stuart76@mymail.com','07942671542','N/A','2021-02-16 00:00:00'),('w2569813','Lorem Ipsum','2004-03-20','Dronfield Street','Jeff Ipsum','jipsum@git.scm','Same as above','N/A',NULL),('w4378631','Andre Russel','2009-06-22','Long Avenue ','Melissa Russel','Chris@mymail.com','07924463277','N/A','2020-12-23 00:00:00');
/*!40000 ALTER TABLE `students` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `userName` varchar(12) NOT NULL,
  `userPass` varchar(60) DEFAULT NULL,
  `fullName` char(50) DEFAULT 'N/A',
  `accessLevel` int DEFAULT '1',
  `resetPassword` tinyint DEFAULT '0',
  PRIMARY KEY (`userName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('adam12','$2y$08$qu2F3W0VrBsXHJ2fN8jYPOaDkkjyNBMEjWjfJhRbuvg1IVPgB5VP.','Adam John',2,0),('Ben580','$2y$08$V87.UCR3EkR4sqHw2ujTgekz/epa25xijlpp7x9rmt9R2iEV8.YHO','Ben Foakes',1,0),('Coach563','$2y$08$I7WnWO8dbDiqP7W9wE14v.wQkYAwodvEp7bDY4gn9PbZKl76jV.2e','Coach',1,0),('Dave5772','$2y$08$mX4g/FUNxLEcPhAAeItCH.q0T4jKKy3lypVUV2.OGFpYDHNTEzoGq','Dave',1,0),('Harry493','$2y$08$O6osHvOZUoerG/nTJ1XJV.4XkqIzlTqNzcqz5RMhPBql5t532PxyO','Harry Milkon',1,1),('Larry3538','$2y$08$a8yWeaSVmHuhMU12BbG14efk.tryQqg13qef9A0joKhLAt/.6chGO','Larry Bradford',2,0),('mark12','$2y$08$jiX46FQLIUacAhsAcU2WAurvXM/AEja6KwNlHI1el5pzur9.Rafcy','Mark Rich',1,0),('michel471','$2y$08$2T6E3Z6uM0kgLwzUv6ktQeRK5lnsjjyMYRXz7SkTxq3/nex2rpcy6','Michel Fume',1,1),('person12','$2y$08$LjjquqQpzG/4CyV7aikGIeMHBMKqOy9EpvZc9KM9KDJxJfndDQWA.','James Parson',1,0),('person2','$2y$08$vR6LDPYg8F1FawOJBzNpiesRj.ZUnKP6qf6DZGx/eNzQgt3lL7bLS','Amy Parson',1,0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'dronfield'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-02-19 15:47:25
