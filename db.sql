-- MySQL dump 10.13  Distrib 5.7.28, for Linux (x86_64)
--
-- Host: localhost    Database: studentrecordmanagment
-- ------------------------------------------------------
-- Server version	5.7.28-0ubuntu0.16.04.2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Matricziauddinscience`
--

DROP TABLE IF EXISTS `Matricziauddinscience`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Matricziauddinscience` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `enrollmentnumber` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `EnglishMarks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `UrduMarks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `MathsMarks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `IslamiatorethicsMarks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `TotalMarks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `PassingStatus` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `EnglishPercentage` decimal(5,2) NOT NULL,
  `UrduPercentage` decimal(5,2) NOT NULL,
  `MathsPercentage` decimal(5,2) NOT NULL,
  `IslamiatorethicsPercentage` decimal(5,2) NOT NULL,
  `PhysicsPercentage` decimal(5,2) NOT NULL,
  `OverallPercentage` decimal(5,2) NOT NULL,
  `Totalclearedpaper` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `grade` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `examtype` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `OptionalSubjectCode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `physicstheorymarks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `physicspracticalmarks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `totalphysicsmarks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `matricsciencekey` (`enrollmentnumber`),
  CONSTRAINT `matricsciencekey` FOREIGN KEY (`enrollmentnumber`) REFERENCES `students` (`matricexamuniquekey`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Matricziauddinscience`
--

LOCK TABLES `Matricziauddinscience` WRITE;
/*!40000 ALTER TABLE `Matricziauddinscience` DISABLE KEYS */;
INSERT INTO `Matricziauddinscience` VALUES (1,'Matric202019','72','73','73','71','375','pass',96.00,97.33,73.00,94.67,86.00,88.24,'5','A','Annual','1','2020-02-06 08:01:41','2020-02-06 08:01:41','72','A','86'),(2,'10010M2020','70','70','90','70','381','pass',93.33,93.33,90.00,93.33,81.00,89.65,'5','A','Annual','1','2020-02-08 08:53:59','2020-02-08 08:53:59','68','A','81'),(3,'100055M2020','70','68','89','70','381','pass',93.33,90.67,89.00,93.33,84.00,89.65,'5','A','Annual','1','2020-02-08 09:44:23','2020-02-08 09:44:23','71','13','84');
/*!40000 ALTER TABLE `Matricziauddinscience` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `firstyearpreengineeringbatches`
--

DROP TABLE IF EXISTS `firstyearpreengineeringbatches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `firstyearpreengineeringbatches` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `schoolid` int(10) unsigned NOT NULL,
  `studentname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `studentfathername` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `studentrollnumber` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `englishmarks` int(10) unsigned NOT NULL,
  `urdumarks` int(10) unsigned NOT NULL,
  `islamiatmarks` int(10) unsigned NOT NULL,
  `physicsmarks` int(10) unsigned NOT NULL,
  `chemistrymarks` int(10) unsigned NOT NULL,
  `mathsmarks` int(10) unsigned NOT NULL,
  `totalmarks` int(10) unsigned NOT NULL,
  `percentage` decimal(5,2) NOT NULL,
  `grade` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `firstyearpreengineeringbatches_studentrollnumber_unique` (`studentrollnumber`),
  KEY `firstyearpreengineeringbatches_schoolid_foreign` (`schoolid`),
  CONSTRAINT `firstyearpreengineeringbatches_schoolid_foreign` FOREIGN KEY (`schoolid`) REFERENCES `schools` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `firstyearpreengineeringbatches`
--

LOCK TABLES `firstyearpreengineeringbatches` WRITE;
/*!40000 ALTER TABLE `firstyearpreengineeringbatches` DISABLE KEYS */;
INSERT INTO `firstyearpreengineeringbatches` VALUES (1,5,'Muhammad Obaid','Muhammad Usman','firstyear01',75,78,78,78,87,65,396,66.00,'C','2020-01-14 09:50:29','2020-01-14 09:50:29'),(2,4,'Muhammad Obaid','Muhammad Usman','bulk01',78,78,78,78,78,90,480,96.00,'A','2020-01-14 10:02:59','2020-01-14 10:02:59'),(3,5,'Khurram Irfan Adhami','Irfan Adami','bulk02',89,89,89,89,89,90,535,107.00,'A','2020-01-14 10:02:59','2020-01-14 10:02:59'),(4,4,'Muhammad Obaid','Muhammad Usman','bulk03',78,78,78,78,78,90,480,96.00,'A','2020-01-14 10:02:59','2020-01-14 10:02:59'),(5,5,'Khurram Irfan Adhami','Irfan Adami','bulk04',89,89,89,89,89,90,535,107.00,'A','2020-01-14 10:02:59','2020-01-14 10:02:59'),(6,4,'Muhammad Obaid','Muhammad Usman','bulk05',78,78,78,78,78,90,480,96.00,'A','2020-01-14 10:02:59','2020-01-14 10:02:59'),(7,5,'Khurram Irfan Adhami','Irfan Adami','bulk06',89,89,89,89,89,90,535,107.00,'A','2020-01-14 10:02:59','2020-01-14 10:02:59'),(8,4,'Muhammad Obaid','Muhammad Usman','bulk07',78,78,78,78,78,90,480,96.00,'A','2020-01-14 10:02:59','2020-01-14 10:02:59'),(9,5,'Khurram Irfan Adhami','Irfan Adami','bulk08',89,89,89,89,89,90,535,107.00,'A','2020-01-14 10:02:59','2020-01-14 10:02:59'),(10,4,'Muhammad Obaid','Muhammad Usman','bulk09',78,78,78,78,78,90,480,96.00,'A','2020-01-14 10:02:59','2020-01-14 10:02:59'),(11,5,'Khurram Irfan Adhami','Irfan Adami','bulk10',89,89,89,89,89,90,535,107.00,'A','2020-01-14 10:02:59','2020-01-14 10:02:59'),(12,4,'Muhammad Obaid','Muhammad Usman','bulk11',78,78,78,78,78,90,480,96.00,'A','2020-01-14 10:02:59','2020-01-14 10:02:59'),(13,5,'Khurram Irfan Adhami','Irfan Adami','bulk12',89,89,89,89,89,90,535,107.00,'A','2020-01-14 10:02:59','2020-01-14 10:02:59'),(14,4,'Muhammad Obaid','Muhammad Usman','bulk13',78,78,78,78,78,90,480,96.00,'A','2020-01-14 10:02:59','2020-01-14 10:02:59'),(15,5,'Khurram Irfan Adhami','Irfan Adami','bulk14',89,89,89,89,89,90,535,107.00,'A','2020-01-14 10:02:59','2020-01-14 10:02:59'),(16,3,'ABHH','HHJ','HHH',76,56,76,87,76,45,371,61.83,'C','2020-01-15 05:01:33','2020-01-15 05:01:33');
/*!40000 ALTER TABLE `firstyearpreengineeringbatches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `firstyearpremedicalbatches`
--

DROP TABLE IF EXISTS `firstyearpremedicalbatches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `firstyearpremedicalbatches` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `schoolid` int(10) unsigned NOT NULL,
  `studentname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `studentfathername` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `studentrollnumber` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `englishmarks` int(10) unsigned NOT NULL,
  `urdumarks` int(10) unsigned NOT NULL,
  `islamiatmarks` int(10) unsigned NOT NULL,
  `physicsmarks` int(10) unsigned NOT NULL,
  `chemistrymarks` int(10) unsigned NOT NULL,
  `biologymarks` int(10) unsigned NOT NULL,
  `totalmarks` int(10) unsigned NOT NULL,
  `percentage` decimal(5,2) NOT NULL,
  `grade` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `firstyearpremedicalbatches_studentrollnumber_unique` (`studentrollnumber`),
  KEY `firstyearpremedicalbatches_schoolid_foreign` (`schoolid`),
  CONSTRAINT `firstyearpremedicalbatches_schoolid_foreign` FOREIGN KEY (`schoolid`) REFERENCES `schools` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `firstyearpremedicalbatches`
--

LOCK TABLES `firstyearpremedicalbatches` WRITE;
/*!40000 ALTER TABLE `firstyearpremedicalbatches` DISABLE KEYS */;
/*!40000 ALTER TABLE `firstyearpremedicalbatches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `matricziauddingenerals`
--

DROP TABLE IF EXISTS `matricziauddingenerals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `matricziauddingenerals` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `enrollmentnumberunique` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `EnglishMarks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `UrduMarks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `IslamiatorethicsMarks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `IslamicstudiesMarks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CommerceMarks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `GeographyMarks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CivicsMarks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `EconomicsMarks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `EnglishPercentage` decimal(5,2) NOT NULL,
  `UrduPercentage` decimal(5,2) NOT NULL,
  `Optionalsubjectspercentage` decimal(5,2) NOT NULL,
  `TotalMarks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `OverallPercentage` decimal(5,2) NOT NULL,
  `Totalclearedpaper` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `grade` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `examtype` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `OptionalSubjectCode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `IslamiatorethicsPercentage` decimal(5,2) NOT NULL,
  `PassingStatus` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `grouptype` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `matricziauddingenerals_enrollmentnumberunique_unique` (`enrollmentnumberunique`),
  CONSTRAINT `matricziauddingenerals_enrollmentnumberunique_foreign` FOREIGN KEY (`enrollmentnumberunique`) REFERENCES `students` (`matricexamuniquekey`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `matricziauddingenerals`
--

LOCK TABLES `matricziauddingenerals` WRITE;
/*!40000 ALTER TABLE `matricziauddingenerals` DISABLE KEYS */;
INSERT INTO `matricziauddingenerals` VALUES (1,'matriccommerce012020','72','72','71','71','71','71','71','71',96.00,96.00,0.00,'215',50.59,'3','D','Annual','1',94.67,'failed','2020-02-07 13:16:21','2020-02-06 08:42:27','Private');
/*!40000 ALTER TABLE `matricziauddingenerals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_01_06_062140_create_schools_table',1),(4,'2019_08_19_000000_create_failed_jobs_table',1),(5,'2020_01_06_062713_create_ninthcomputerbatches_table',1),(6,'2020_01_06_063104_create_ninthmedicalbatches_table',1),(7,'2020_01_06_063936_create_matricbatches_table',1),(8,'2020_01_06_064251_create_firstyearpreengineeringbatches_table',1),(9,'2020_01_06_064300_create_firstyearpremedicalbatches_table',1),(10,'2020_01_06_064317_create_secondyearpreengineeringbatches_table',1),(11,'2020_01_06_064326_create_secondyearpremedicalbatches_table',1),(12,'2020_01_21_094758_create_roles_table',2),(13,'2020_01_21_095109_create_role_user_table',2),(14,'2020_01_23_080834_create_students_table',3),(16,'2020_01_23_081706_create_ninthziauddinboardcomputers_table',4),(17,'2020_01_27_181220_create_ninthziauddinboardbios_table',5),(18,'2020_01_27_185232_create_ninthziauddinboardgeneralgroups_table',5),(19,'2020_01_30_105318_create_matric_science_table',6),(21,'2020_02_04_094239_editstudenttable',7),(22,'2020_02_05_141551_create_matricziauddingenerals_table',8),(23,'2020_02_05_170302_deletephysicsmarksfrommatricgeneral',9),(24,'2020_02_05_171029_addcolumnsinmatricgeneralgroup',10);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ninthziauddinboardbios`
--

DROP TABLE IF EXISTS `ninthziauddinboardbios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ninthziauddinboardbios` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `enrollmentnumber` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `englishmarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sindhimarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pakistanstudiesmark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `chemistrytheorymarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `chemistrypracticalmarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `biotheorymarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `biopracticalmarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `totalbiomarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `totalchemistrymarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `totalmarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passingstatus` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `englishpercentage` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sindhipercentage` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pakistanstudiespercentage` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `chemistrypercentage` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `biopercentage` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `overallpercentage` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `totalclearedpaper` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `grade` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `examtype` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `nintthbioforeignkey` (`enrollmentnumber`),
  CONSTRAINT `nintthbioforeignkey` FOREIGN KEY (`enrollmentnumber`) REFERENCES `students` (`ninthexamuniquekey`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ninthziauddinboardbios`
--

LOCK TABLES `ninthziauddinboardbios` WRITE;
/*!40000 ALTER TABLE `ninthziauddinboardbios` DISABLE KEYS */;
INSERT INTO `ninthziauddinboardbios` VALUES (1,'Ned702019','68','67','71','72','13','71','13','84','85','375','pass','90.67','89.33','94.67','85.00','84.00','88.24','5','A','Annual','2020-02-06 07:36:55','2020-02-06 07:36:55'),(2,'122102012','67','73','18','72','13','70','13','83','85','326','failed','89.33','97.33','24.00','85.00','83.00','76.71','4','B','Annual','2020-02-08 08:41:42','2020-02-08 08:41:42'),(3,'Med20202009','71','71','71','71','13','71','13','84','84','381','pass','94.66666666666667','94.66666666666667','94.66666666666667','84','84','89.64705882352942','5','D','Annual','2020-02-14 07:45:59','2020-02-14 07:45:59'),(4,'2000942020','45','60','70','72','13','80','10','90','85','350','pass','60','80','93.33333333333333','85','90','82.35294117647058','5','D','Annual','2020-02-14 09:06:03','2020-02-14 09:06:03'),(5,'2000952020','45','60','29','72','13','80','10','90','85','309','pass','60','80','38.666666666666664','85','90','72.70588235294117','5','E','Annual','2020-02-14 09:06:04','2020-02-14 09:06:04'),(6,'2000962020','45','60','A','72','13','80','10','90','85','280','failed','60','80','0','85','90','65.88235294117646','4','E','Annual','2020-02-14 09:06:04','2020-02-14 09:06:04');
/*!40000 ALTER TABLE `ninthziauddinboardbios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ninthziauddinboardcomputers`
--

DROP TABLE IF EXISTS `ninthziauddinboardcomputers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ninthziauddinboardcomputers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `enrollmentnumber` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `englishmarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sindhimarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pakistanstudiesmark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `computertheorymarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `computerpracticalmarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `totalcomputermarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `totalmarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passingstatus` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `englishpercentage` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sindhipercentage` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pakistanstudiespercentage` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `chemistrypercentage` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `computerpercentage` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `overallpercentage` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `totalclearedpaper` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `grade` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `examtype` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `chemistrytheorymarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `chemistrypracticalmarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `totalchemistrymarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `nintthcomputerforeignkey` (`enrollmentnumber`),
  CONSTRAINT `nintthcomputerforeignkey` FOREIGN KEY (`enrollmentnumber`) REFERENCES `students` (`ninthexamuniquekey`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ninthziauddinboardcomputers`
--

LOCK TABLES `ninthziauddinboardcomputers` WRITE;
/*!40000 ALTER TABLE `ninthziauddinboardcomputers` DISABLE KEYS */;
INSERT INTO `ninthziauddinboardcomputers` VALUES (2,'2020','67','67','72','72','14','86','292','failed','89.33','89.33','96.00','0.00','86.00','68.71','4','C','2020-02-05 02:56:42','2020-02-05 02:56:42','Annual','61','61','0'),(3,'0000022019','70','70','70','72','13','85','295','failed','93.33','93.33','93.33','0.00','85.00','69.41','4','C','2020-02-05 04:17:27','2020-02-05 04:17:27','Annual','61','61','0'),(4,'Ned202019','67','67','71','71','13','84','432','pass','89.33','89.33','94.67','143.00','84.00','101.65','5','A','2020-02-06 07:24:21','2020-02-06 07:24:21','Annual','72','71','143'),(5,'100002017','67','69','71','70','13','83','375','pass','89.33333333333333','92','94.66666666666667','85','83','88.23529411764706','5','A','2020-02-08 08:39:04','2020-02-08 08:39:04','Annual','72','13','85'),(6,'1000552020','45','60','70','80','10','90','350','pass','60','80','93.33333333333333','85','90','82.35294117647058','5','A','2020-02-08 09:17:13','2020-02-08 09:17:13','Annual','72','13','85'),(7,'1000552020','45','45','45','75','15','90','315','pass','60','60','60','90','90','74.11764705882354','5','B','2020-02-08 10:58:03','2020-02-08 10:58:03','Annual','75','15','90'),(8,'1000562020','33','33','33','66','15','81','261','pass','44','44','44','81','81','61.411764705882355','5','C','2020-02-08 10:58:04','2020-02-08 10:58:04','Annual','66','15','81'),(9,'1000572020','32','32','32','62','15','77','250','pass','42.66666666666667','42.66666666666667','42.66666666666667','77','77','58.82352941176471','5','D','2020-02-08 10:58:04','2020-02-08 10:58:04','Annual','62','15','77'),(10,'1000582020','64','64','64','64','11','75','342','pass','85.33333333333334','85.33333333333334','85.33333333333334','75','75','80.47058823529412','5','A','2020-02-08 10:58:04','2020-02-08 10:58:04','Annual','64','11','75'),(11,'1000592020','51','51','51','65','11','76','305','pass','68','68','68','76','76','71.76470588235294','5','B','2020-02-08 10:58:05','2020-02-08 10:58:05','Annual','65','11','76'),(12,'1000602020','38','38','38','71','11','82','278','pass','50.66666666666667','50.66666666666667','50.66666666666667','82','82','65.41176470588236','5','C','2020-02-08 10:58:05','2020-02-08 10:58:05','Annual','71','11','82'),(13,'1000612020','62','62','62','73','12','85','356','pass','82.66666666666667','82.66666666666667','82.66666666666667','85','85','83.76470588235294','5','A','2020-02-08 10:58:05','2020-02-08 10:58:05','Annual','73','12','85'),(14,'1000622020','66','66','66','59','13','72','342','pass','88','88','88','72','72','80.47058823529412','5','A','2020-02-08 10:58:05','2020-02-08 10:58:05','Annual','59','13','72'),(15,'1000632020','64','64','64','61','13','74','340','pass','85.33333333333334','85.33333333333334','85.33333333333334','74','74','80','5','B','2020-02-08 10:58:05','2020-02-08 10:58:05','Annual','61','13','74'),(16,'1000642020','32','32','32','66','14','80','256','pass','42.66666666666667','42.66666666666667','42.66666666666667','80','80','60.23529411764705','5','C','2020-02-08 10:58:05','2020-02-08 10:58:05','Annual','66','14','80'),(17,'1000652020','55','55','55','70','11','81','327','pass','73.33333333333333','73.33333333333333','73.33333333333333','81','81','76.94117647058823','5','B','2020-02-08 10:58:05','2020-02-08 10:58:05','Annual','70','11','81'),(18,'1000662020','54','54','54','60','12','72','306','pass','72','72','72','72','72','72','5','B','2020-02-08 10:58:05','2020-02-08 10:58:05','Annual','60','12','72'),(19,'1000672020','53','53','53','50','14','64','287','pass','70.66666666666667','70.66666666666667','70.66666666666667','64','64','67.52941176470588','5','C','2020-02-08 10:58:05','2020-02-08 10:58:05','Annual','50','14','64'),(20,'1000682020','57','57','57','49','10','59','289','pass','76','76','76','59','59','68','5','C','2020-02-08 10:58:05','2020-02-08 10:58:05','Annual','49','10','59'),(21,'1000692020','59','59','59','59','15','74','325','pass','78.66666666666666','78.66666666666666','78.66666666666666','74','74','76.47058823529412','5','B','2020-02-08 10:58:05','2020-02-08 10:58:05','Annual','59','15','74'),(22,'1000702020','52','52','52','52','15','67','290','pass','69.33333333333334','69.33333333333334','69.33333333333334','67','67','68.23529411764706','5','C','2020-02-08 10:58:05','2020-02-08 10:58:05','Annual','52','15','67'),(23,'1000712019','45','45','45','75','15','90','315','pass','60','60','60','90','90','74.11764705882354','5','B','2020-02-08 10:59:30','2020-02-08 10:59:30','Annual','75','15','90'),(24,'1000722019','33','33','33','66','15','81','261','pass','44','44','44','81','81','61.411764705882355','5','C','2020-02-08 10:59:30','2020-02-08 10:59:30','Annual','66','15','81'),(25,'1000732019','32','32','32','62','15','77','250','pass','42.66666666666667','42.66666666666667','42.66666666666667','77','77','58.82352941176471','5','D','2020-02-08 10:59:30','2020-02-08 10:59:30','Annual','62','15','77'),(26,'1000742019','64','64','64','64','11','75','342','pass','85.33333333333334','85.33333333333334','85.33333333333334','75','75','80.47058823529412','5','A','2020-02-08 10:59:30','2020-02-08 10:59:30','Annual','64','11','75'),(27,'1000752019','51','51','51','65','11','76','305','pass','68','68','68','76','76','71.76470588235294','5','B','2020-02-08 10:59:30','2020-02-08 10:59:30','Annual','65','11','76'),(28,'1000762019','38','38','38','71','11','82','278','pass','50.66666666666667','50.66666666666667','50.66666666666667','82','82','65.41176470588236','5','C','2020-02-08 10:59:30','2020-02-08 10:59:30','Annual','71','11','82'),(29,'1000772019','62','62','62','73','12','85','356','pass','82.66666666666667','82.66666666666667','82.66666666666667','85','85','83.76470588235294','5','A','2020-02-08 10:59:30','2020-02-08 10:59:30','Annual','73','12','85'),(30,'1000782019','66','66','66','59','13','72','342','pass','88','88','88','72','72','80.47058823529412','5','A','2020-02-08 10:59:30','2020-02-08 10:59:30','Annual','59','13','72'),(31,'1000792019','64','64','64','61','13','74','340','pass','85.33333333333334','85.33333333333334','85.33333333333334','74','74','80','5','B','2020-02-08 10:59:31','2020-02-08 10:59:31','Annual','61','13','74'),(32,'1000802019','32','32','32','66','14','80','256','pass','42.66666666666667','42.66666666666667','42.66666666666667','80','80','60.23529411764705','5','C','2020-02-08 10:59:31','2020-02-08 10:59:31','Annual','66','14','80'),(33,'1000812019','55','55','55','70','11','81','327','pass','73.33333333333333','73.33333333333333','73.33333333333333','81','81','76.94117647058823','5','B','2020-02-08 10:59:31','2020-02-08 10:59:31','Annual','70','11','81'),(34,'1000822019','54','54','54','60','12','72','306','pass','72','72','72','72','72','72','5','B','2020-02-08 10:59:31','2020-02-08 10:59:31','Annual','60','12','72'),(35,'1000832019','53','53','53','50','14','64','287','pass','70.66666666666667','70.66666666666667','70.66666666666667','64','64','67.52941176470588','5','C','2020-02-08 10:59:31','2020-02-08 10:59:31','Annual','50','14','64'),(36,'1000842019','57','57','57','49','10','59','289','pass','76','76','76','59','59','68','5','C','2020-02-08 10:59:31','2020-02-08 10:59:31','Annual','49','10','59'),(37,'1000852019','59','59','59','59','15','74','325','pass','78.66666666666666','78.66666666666666','78.66666666666666','74','74','76.47058823529412','5','B','2020-02-08 10:59:31','2020-02-08 10:59:31','Annual','59','15','74'),(38,'1000862019','52','52','52','52','15','67','290','pass','69.33333333333334','69.33333333333334','69.33333333333334','67','67','68.23529411764706','5','C','2020-02-08 10:59:31','2020-02-08 10:59:31','Annual','52','15','67'),(39,'test20102017','70','65','67','71','13','84','369','pass','93.33333333333333','86.66666666666667','89.33333333333333','83','84','86.82352941176471','5','D','2020-02-14 07:41:32','2020-02-14 07:41:32','Annual','70','13','83'),(40,'1000942020','45','60','70','80','10','90','350','pass','60','80','93.33333333333333','85','90','82.35294117647058','5','D','2020-02-14 08:53:15','2020-02-14 08:53:15','Annual','72','13','85'),(41,'1000952020','45','60','29','80','10','90','309','pass','60','80','38.666666666666664','85','90','72.70588235294117','5','E','2020-02-14 08:53:15','2020-02-14 08:53:15','Annual','72','13','85'),(42,'1000962020','45','60','A','80','10','90','280','failed','60','80','0','85','90','65.88235294117646','4','E','2020-02-14 08:53:16','2020-02-14 08:53:16','Annual','72','13','85');
/*!40000 ALTER TABLE `ninthziauddinboardcomputers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ninthziauddinboardgeneralgroups`
--

DROP TABLE IF EXISTS `ninthziauddinboardgeneralgroups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ninthziauddinboardgeneralgroups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `enrollmentnumber` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `englishmarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sindhimarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pakistanstudiesmark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `generalsciencemarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mathsmarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `totalmarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passingstatus` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `englishpercentage` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sindhipercentage` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pakistanstudiespercentage` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `generalsciencepercentage` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mathspercentage` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `overallpercentage` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `totalclearedpaper` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `grade` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `examtype` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `nintthgeneralkey` (`enrollmentnumber`),
  CONSTRAINT `nintthgeneralkey` FOREIGN KEY (`enrollmentnumber`) REFERENCES `students` (`ninthexamuniquekey`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ninthziauddinboardgeneralgroups`
--

LOCK TABLES `ninthziauddinboardgeneralgroups` WRITE;
/*!40000 ALTER TABLE `ninthziauddinboardgeneralgroups` DISABLE KEYS */;
INSERT INTO `ninthziauddinboardgeneralgroups` VALUES (1,'commerce012019','73','72','72','87','87','391','pass','97.33','96.00','96.00','87.00','87.00','92.00','5','A','Annual','Private','2020-02-06 07:46:45','2020-02-06 07:46:45'),(2,'1291232019','70','71','12','70','70','293','failed','93.33','94.67','16.00','70.00','70.00','68.94','4','C','Annual','Private','2020-02-08 08:42:37','2020-02-08 08:42:37'),(3,'com012019','71','72','71','73','89','376','pass','94.67','96.00','94.67','73.00','89.00','88.47','5','A','Annual','Private','2020-02-13 06:31:11','2020-02-13 06:31:11'),(4,'commerce2012019','71','70','71','80','80','372','pass','94.67','93.33','94.67','80.00','80.00','87.53','5','A','Annual','Regular','2020-02-14 05:27:31','2020-02-14 05:27:31'),(5,'private2012019','71','70','71','80','80','372','pass','94.67','93.33','94.67','80.00','80.00','87.53','5','A','Annual','Private','2020-02-14 05:28:21','2020-02-14 05:28:21'),(6,'privatetest20202019','71','17','70','18','70','246','failed','94.67','22.67','93.33','18.00','70.00','57.88','3','D','Annual','Private','2020-02-14 05:39:36','2020-02-14 05:39:36'),(7,'','45','60','70','72','40','287','pass','60','80','93.33333333333333','72','40','67.52941176470588','5','E','Annual','Regular','2020-02-14 09:14:51','2020-02-14 09:14:51'),(8,'','45','60','29','72','90','296','pass','60','80','38.666666666666664','72','90','69.6470588235294','5','E','Annual','Regular','2020-02-14 09:14:56','2020-02-14 09:14:56'),(9,'','45','60','70','89','91','355','pass','60','80','93.33333333333333','89','91','83.52941176470588','5','D','Annual','Private','2020-02-14 09:14:56','2020-02-14 09:14:56'),(10,'4000942020','45','60','70','72','40','287','pass','60','80','93.33333333333333','72','40','67.52941176470588','5','E','Annual','Regular','2020-02-14 09:24:54','2020-02-14 09:24:54'),(11,'4000952020','45','60','29','72','90','296','pass','60','80','38.666666666666664','72','90','69.6470588235294','5','E','Annual','Regular','2020-02-14 09:24:54','2020-02-14 09:24:54'),(12,'4000962020','45','60','70','89','91','355','pass','60','80','93.33333333333333','89','91','83.52941176470588','5','D','Annual','Private','2020-02-14 09:24:54','2020-02-14 09:24:54');
/*!40000 ALTER TABLE `ninthziauddinboardgeneralgroups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_user`
--

DROP TABLE IF EXISTS `role_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_user`
--

LOCK TABLES `role_user` WRITE;
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;
INSERT INTO `role_user` VALUES (1,1,1,NULL,NULL),(2,2,3,NULL,NULL);
/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin','Admin Rights',NULL,NULL),(2,'operator','Data entry operator',NULL,NULL);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `schools`
--

DROP TABLE IF EXISTS `schools`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `schools` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `schoolname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `schools_schoolname_unique` (`schoolname`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `schools`
--

LOCK TABLES `schools` WRITE;
/*!40000 ALTER TABLE `schools` DISABLE KEYS */;
INSERT INTO `schools` VALUES (1,'Falcon House Grammar School',NULL,NULL),(2,'Jinnah Grammar School','2020-01-10 05:15:02','2020-01-10 05:15:02'),(3,'BVS Grammar School','2020-01-10 06:43:34','2020-01-10 06:43:34'),(4,'Test School','2020-01-13 09:02:49','2020-01-13 09:02:49'),(5,'ABC School','2020-01-13 09:02:49','2020-01-13 09:02:49'),(6,'Adamjee Institute','2020-01-23 08:14:56','2020-01-23 08:14:56'),(7,'DJ College','2020-01-23 09:32:47','2020-01-23 09:32:47'),(8,'Test1 School','2020-01-24 02:55:47','2020-01-24 02:55:47'),(9,'Private','2020-02-06 07:45:23','2020-02-06 07:45:23'),(10,'Whitehouse Grammar School','2020-02-06 07:57:23','2020-02-06 07:57:23'),(11,'Practical Schooling System','2020-02-08 10:58:04','2020-02-08 10:58:04');
/*!40000 ALTER TABLE `schools` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `secondyearpreengineeringbatches`
--

DROP TABLE IF EXISTS `secondyearpreengineeringbatches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `secondyearpreengineeringbatches` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `schoolid` int(10) unsigned NOT NULL,
  `studentname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `studentfathername` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `studentrollnumber` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `englishmarks` int(10) unsigned NOT NULL,
  `urdumarks` int(10) unsigned NOT NULL,
  `pakistanstudiesmarks` int(10) unsigned NOT NULL,
  `physicsmarks` int(10) unsigned NOT NULL,
  `chemistrymarks` int(10) unsigned NOT NULL,
  `mathmarks` int(10) unsigned NOT NULL,
  `totalmarks` int(10) unsigned NOT NULL,
  `percentage` decimal(5,2) NOT NULL,
  `grade` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `secondyearpreengineeringbatches_studentrollnumber_unique` (`studentrollnumber`),
  KEY `secondyearpreengineeringbatches_schoolid_foreign` (`schoolid`),
  CONSTRAINT `secondyearpreengineeringbatches_schoolid_foreign` FOREIGN KEY (`schoolid`) REFERENCES `schools` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `secondyearpreengineeringbatches`
--

LOCK TABLES `secondyearpreengineeringbatches` WRITE;
/*!40000 ALTER TABLE `secondyearpreengineeringbatches` DISABLE KEYS */;
INSERT INTO `secondyearpreengineeringbatches` VALUES (1,5,'Muhammad Obaid','Muhamamd Usman','secondyear01',89,89,89,89,89,89,534,106.80,'A','2020-01-14 10:29:42','2020-01-14 10:29:42'),(2,1,'Muhammad Obaid','Muhammad Usman','secondyear02',87,89,87,76,67,67,473,94.60,'A','2020-01-15 00:59:58','2020-01-15 00:59:58'),(3,4,'Muhammad Obaid','Muhammad Usman','bulk01',78,78,78,90,78,78,480,96.00,'A','2020-01-15 01:03:48','2020-01-15 01:03:48'),(4,5,'Khurram Irfan Adhami','Irfan Adami','bulk02',89,89,89,90,89,89,535,107.00,'A','2020-01-15 01:03:48','2020-01-15 01:03:48'),(5,4,'Muhammad Obaid','Muhammad Usman','bulk03',78,78,78,90,78,78,480,96.00,'A','2020-01-15 01:03:48','2020-01-15 01:03:48'),(6,5,'Khurram Irfan Adhami','Irfan Adami','bulk04',89,89,89,90,89,89,535,107.00,'A','2020-01-15 01:03:48','2020-01-15 01:03:48'),(7,4,'Muhammad Obaid','Muhammad Usman','bulk05',78,78,78,90,78,78,480,96.00,'A','2020-01-15 01:03:48','2020-01-15 01:03:48'),(8,5,'Khurram Irfan Adhami','Irfan Adami','bulk06',89,89,89,90,89,89,535,107.00,'A','2020-01-15 01:03:48','2020-01-15 01:03:48'),(9,4,'Muhammad Obaid','Muhammad Usman','bulk07',78,78,78,90,78,78,480,96.00,'A','2020-01-15 01:03:48','2020-01-15 01:03:48'),(10,5,'Khurram Irfan Adhami','Irfan Adami','bulk08',89,89,89,90,89,89,535,107.00,'A','2020-01-15 01:03:48','2020-01-15 01:03:48'),(11,4,'Muhammad Obaid','Muhammad Usman','bulk09',78,78,78,90,78,78,480,96.00,'A','2020-01-15 01:03:48','2020-01-15 01:03:48'),(12,5,'Khurram Irfan Adhami','Irfan Adami','bulk10',89,89,89,90,89,89,535,107.00,'A','2020-01-15 01:03:48','2020-01-15 01:03:48'),(13,4,'Muhammad Obaid','Muhammad Usman','bulk11',78,78,78,90,78,78,480,96.00,'A','2020-01-15 01:03:48','2020-01-15 01:03:48'),(14,5,'Khurram Irfan Adhami','Irfan Adami','bulk12',89,89,89,90,89,89,535,107.00,'A','2020-01-15 01:03:48','2020-01-15 01:03:48'),(15,4,'Muhammad Obaid','Muhammad Usman','bulk13',78,78,78,90,78,78,480,96.00,'A','2020-01-15 01:03:48','2020-01-15 01:03:48'),(16,5,'Khurram Irfan Adhami','Irfan Adami','bulk14',89,89,89,90,89,89,535,107.00,'A','2020-01-15 01:03:48','2020-01-15 01:03:48'),(17,2,'Test','Test','final01',87,78,78,98,87,78,506,101.20,'A','2020-01-15 05:02:01','2020-01-15 05:02:01');
/*!40000 ALTER TABLE `secondyearpreengineeringbatches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `secondyearpremedicalbatches`
--

DROP TABLE IF EXISTS `secondyearpremedicalbatches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `secondyearpremedicalbatches` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `schoolid` int(10) unsigned NOT NULL,
  `studentname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `studentfathername` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `studentrollnumber` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `englishmarks` int(10) unsigned NOT NULL,
  `urdumarks` int(10) unsigned NOT NULL,
  `pakistanstudiesmarks` int(10) unsigned NOT NULL,
  `physicsmarks` int(10) unsigned NOT NULL,
  `chemistrymarks` int(10) unsigned NOT NULL,
  `biologymarks` int(10) unsigned NOT NULL,
  `totalmarks` int(10) unsigned NOT NULL,
  `percentage` decimal(5,2) NOT NULL,
  `grade` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `secondyearpremedicalbatches_studentrollnumber_unique` (`studentrollnumber`),
  KEY `secondyearpremedicalbatches_schoolid_foreign` (`schoolid`),
  CONSTRAINT `secondyearpremedicalbatches_schoolid_foreign` FOREIGN KEY (`schoolid`) REFERENCES `schools` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `secondyearpremedicalbatches`
--

LOCK TABLES `secondyearpremedicalbatches` WRITE;
/*!40000 ALTER TABLE `secondyearpremedicalbatches` DISABLE KEYS */;
/*!40000 ALTER TABLE `secondyearpremedicalbatches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `students` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `studentname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `schoolid` int(10) unsigned NOT NULL,
  `fathername` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `dateofbirth` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ninthexamuniquekey` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `matricexamuniquekey` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firstyearexamuniquekey` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secondyearexamuniquekey` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `enrollmentnumber` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `matricenrollmentnumber` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firstyearenrollmentnumber` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secondyearenrollmentnumber` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ninthexamuniquekey` (`ninthexamuniquekey`),
  UNIQUE KEY `matricexamuniquekey` (`matricexamuniquekey`),
  UNIQUE KEY `firstyearexamuniquekey` (`firstyearexamuniquekey`),
  UNIQUE KEY `secondyearexamuniquekey` (`secondyearexamuniquekey`),
  KEY `students_schoolid_foreign` (`schoolid`),
  CONSTRAINT `students_schoolid_foreign` FOREIGN KEY (`schoolid`) REFERENCES `schools` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `students`
--

LOCK TABLES `students` WRITE;
/*!40000 ALTER TABLE `students` DISABLE KEYS */;
INSERT INTO `students` VALUES (1,'Muhammad Obaid',6,'Muhammad Usman','2020-02-05 02:46:29','2020-02-05 02:46:29','12/12/1993',NULL,NULL,NULL,NULL,'000001',NULL,NULL,NULL),(2,'Muhammad Obaid',6,'Muhammad Usman','2020-02-05 02:47:14','2020-02-05 02:47:14','12/12/1993',NULL,NULL,NULL,NULL,'000001',NULL,NULL,NULL),(3,'Muhammad Obaid',6,'Muhammad Usman','2020-02-05 02:47:52','2020-02-05 02:47:52','12/12/1993',NULL,NULL,NULL,NULL,'000001',NULL,NULL,NULL),(4,'Muhammad Obaid',6,'Muhammad Usman','2020-02-05 02:56:42','2020-02-05 02:56:42','12/12/1993','2020',NULL,NULL,NULL,'000001',NULL,NULL,NULL),(5,'Muhammad Obaid',5,'Muhammad Usman','2020-02-05 04:17:26','2020-02-05 04:17:26','12/12/1995','0000022019',NULL,NULL,NULL,'000002',NULL,NULL,NULL),(6,'Muhammad Obaid',10,'Muhammad Usman','2020-02-06 07:24:20','2020-02-06 08:01:41','12/12/1994','Ned202019','Matric202019',NULL,NULL,'Ned20','Matric20',NULL,NULL),(7,'Khurram Irfan Adhami',5,'Irfan Adhami','2020-02-06 07:35:30','2020-02-06 07:35:30','12/12/1994','Ned702019',NULL,NULL,NULL,'Ned70',NULL,NULL,NULL),(8,'Talha Hussain',9,'Yaseen Hussain','2020-02-06 07:45:23','2020-02-06 08:42:27','12/12/1994','commerce012019','matriccommerce012020',NULL,NULL,'commerce01','matriccommerce01',NULL,NULL),(9,'Zain',7,'Tariq','2020-02-08 08:37:48','2020-02-08 08:53:58','12/12/1995','100002017','10010M2020',NULL,NULL,'10000','10010M',NULL,NULL),(10,'Zain',6,'Tariq','2020-02-08 08:41:41','2020-02-08 08:41:41','12/08/1993','122102012',NULL,NULL,NULL,'12210',NULL,NULL,NULL),(11,'Zain',9,'Tariq Mahmood','2020-02-08 08:42:37','2020-02-08 08:42:37','12/02/1993','1291232019',NULL,NULL,NULL,'129123',NULL,NULL,NULL),(12,'Junaid Khan',4,'Syed Khan','2020-02-08 09:17:13','2020-02-08 09:44:23','12/12/90','1000552020','100055M2020',NULL,NULL,'100055','100055M',NULL,NULL),(13,'Hafiz Abid',11,'Mohammad Ali','2020-02-08 10:58:04','2020-02-08 10:58:04','12/12/1990','1000562020',NULL,NULL,NULL,'100056',NULL,NULL,NULL),(14,'Syed Atif',11,'Ali Ahmad','2020-02-08 10:58:04','2020-02-08 10:58:04','12/12/1990','1000572020',NULL,NULL,NULL,'100057',NULL,NULL,NULL),(15,'Wahaj Hamid',11,'Hamid Ali','2020-02-08 10:58:04','2020-02-08 10:58:04','12/12/1990','1000582020',NULL,NULL,NULL,'100058',NULL,NULL,NULL),(16,'Mahnoor Jabeen',11,'Mustafa Ali','2020-02-08 10:58:05','2020-02-08 10:58:05','12/12/1990','1000592020',NULL,NULL,NULL,'100059',NULL,NULL,NULL),(17,'Mishel Ali Shah',11,'Ali Shah','2020-02-08 10:58:05','2020-02-08 10:58:05','12/12/1990','1000602020',NULL,NULL,NULL,'100060',NULL,NULL,NULL),(18,'Jawwad Ali Shah',11,'Ali Shah','2020-02-08 10:58:05','2020-02-08 10:58:05','12/12/1990','1000612020',NULL,NULL,NULL,'100061',NULL,NULL,NULL),(19,'Sami Haroon',11,'Haroon Khan','2020-02-08 10:58:05','2020-02-08 10:58:05','12/12/1990','1000622020',NULL,NULL,NULL,'100062',NULL,NULL,NULL),(20,'Pakiza Ali',11,'Ali Iftikhar','2020-02-08 10:58:05','2020-02-08 10:58:05','12/12/1990','1000632020',NULL,NULL,NULL,'100063',NULL,NULL,NULL),(21,'Batool Kazmi',11,'Haider Ali','2020-02-08 10:58:05','2020-02-08 10:58:05','12/12/1990','1000642020',NULL,NULL,NULL,'100064',NULL,NULL,NULL),(22,'Palwisha Khan',11,'Jahanzeb Khan','2020-02-08 10:58:05','2020-02-08 10:58:05','12/12/1990','1000652020',NULL,NULL,NULL,'100065',NULL,NULL,NULL),(23,'Sameer Ahmed Khan',11,'Ahmed','2020-02-08 10:58:05','2020-02-08 10:58:05','12/12/1990','1000662020',NULL,NULL,NULL,'100066',NULL,NULL,NULL),(24,'Murtuza Ali',11,'Kamran Ali','2020-02-08 10:58:05','2020-02-08 10:58:05','12/12/1990','1000672020',NULL,NULL,NULL,'100067',NULL,NULL,NULL),(25,'Rafay Khan',11,'Abdul Rehman','2020-02-08 10:58:05','2020-02-08 10:58:05','12/12/1990','1000682020',NULL,NULL,NULL,'100068',NULL,NULL,NULL),(26,'Muhammad Obaid',11,'Muhammad Usman','2020-02-08 10:58:05','2020-02-08 10:58:05','12/12/1990','1000692020',NULL,NULL,NULL,'100069',NULL,NULL,NULL),(27,'Syed Junaid Khurshid',11,'Khurshid Ali','2020-02-08 10:58:05','2020-02-08 10:58:05','12/12/1990','1000702020',NULL,NULL,NULL,'100070',NULL,NULL,NULL),(28,'Junaid Khan',1,'Syed Khan','2020-02-08 10:59:30','2020-02-08 10:59:30','12/12/1990','1000712019',NULL,NULL,NULL,'100071',NULL,NULL,NULL),(29,'Hafiz Abid',1,'Mohammad Ali','2020-02-08 10:59:30','2020-02-08 10:59:30','12/12/1990','1000722019',NULL,NULL,NULL,'100072',NULL,NULL,NULL),(30,'Syed Atif',1,'Ali Ahmad','2020-02-08 10:59:30','2020-02-08 10:59:30','12/12/1990','1000732019',NULL,NULL,NULL,'100073',NULL,NULL,NULL),(31,'Wahaj Hamid',1,'Hamid Ali','2020-02-08 10:59:30','2020-02-08 10:59:30','12/12/1990','1000742019',NULL,NULL,NULL,'100074',NULL,NULL,NULL),(32,'Mahnoor Jabeen',1,'Mustafa Ali','2020-02-08 10:59:30','2020-02-08 10:59:30','12/12/1990','1000752019',NULL,NULL,NULL,'100075',NULL,NULL,NULL),(33,'Mishel Ali Shah',1,'Ali Shah','2020-02-08 10:59:30','2020-02-08 10:59:30','12/12/1990','1000762019',NULL,NULL,NULL,'100076',NULL,NULL,NULL),(34,'Jawwad Ali Shah',1,'Ali Shah','2020-02-08 10:59:30','2020-02-08 10:59:30','12/12/1990','1000772019',NULL,NULL,NULL,'100077',NULL,NULL,NULL),(35,'Sami Haroon',1,'Haroon Khan','2020-02-08 10:59:30','2020-02-08 10:59:30','12/12/1990','1000782019',NULL,NULL,NULL,'100078',NULL,NULL,NULL),(36,'Pakiza Ali',1,'Ali Iftikhar','2020-02-08 10:59:31','2020-02-08 10:59:31','12/12/1990','1000792019',NULL,NULL,NULL,'100079',NULL,NULL,NULL),(37,'Batool Kazmi',1,'Haider Ali','2020-02-08 10:59:31','2020-02-08 10:59:31','12/12/1990','1000802019',NULL,NULL,NULL,'100080',NULL,NULL,NULL),(38,'Palwisha Khan',1,'Jahanzeb Khan','2020-02-08 10:59:31','2020-02-08 10:59:31','12/12/1990','1000812019',NULL,NULL,NULL,'100081',NULL,NULL,NULL),(39,'Sameer Ahmed Khan',1,'Ahmed','2020-02-08 10:59:31','2020-02-08 10:59:31','12/12/1990','1000822019',NULL,NULL,NULL,'100082',NULL,NULL,NULL),(40,'Murtuza Ali',1,'Kamran Ali','2020-02-08 10:59:31','2020-02-08 10:59:31','12/12/1990','1000832019',NULL,NULL,NULL,'100083',NULL,NULL,NULL),(41,'Rafay Khan',1,'Abdul Rehman','2020-02-08 10:59:31','2020-02-08 10:59:31','12/12/1990','1000842019',NULL,NULL,NULL,'100084',NULL,NULL,NULL),(42,'Muhammad Obaid',1,'Muhammad Usman','2020-02-08 10:59:31','2020-02-08 10:59:31','12/12/1990','1000852019',NULL,NULL,NULL,'100085',NULL,NULL,NULL),(43,'Syed Junaid Khurshid',1,'Khurshid Ali','2020-02-08 10:59:31','2020-02-08 10:59:31','12/12/1990','1000862019',NULL,NULL,NULL,'100086',NULL,NULL,NULL),(44,'Jalal Ud Din Roomi',9,'Shams','2020-02-13 06:31:10','2020-02-13 06:31:10','18/03/1993','com012019',NULL,NULL,NULL,'com01',NULL,NULL,NULL),(45,'Test',7,'Test','2020-02-14 05:27:31','2020-02-14 05:27:31','12/12/1993','commerce2012019',NULL,NULL,NULL,'commerce201',NULL,NULL,NULL),(46,'Test',7,'Test','2020-02-14 05:28:21','2020-02-14 05:28:21','12/12/1993','private2012019',NULL,NULL,NULL,'private201',NULL,NULL,NULL),(47,'Test',9,'Test','2020-02-14 05:39:36','2020-02-14 05:39:36','12/12/1991','privatetest20202019',NULL,NULL,NULL,'privatetest2020',NULL,NULL,NULL),(48,'Test',2,'Data','2020-02-14 07:40:45','2020-02-14 07:40:45','12/02/1993','test20102017',NULL,NULL,NULL,'test2010',NULL,NULL,NULL),(49,'Test',3,'Test','2020-02-14 07:43:46','2020-02-14 07:43:46','12/01/1992','Med20202009',NULL,NULL,NULL,'Med2020',NULL,NULL,NULL),(50,'Junaid Khan',8,'Syed Khan','2020-02-14 08:28:11','2020-02-14 08:28:11','12/12/90','1000912020',NULL,NULL,NULL,'100091',NULL,NULL,NULL),(51,'Ramsha Yousuf',8,'Yousuf Alli','2020-02-14 08:28:11','2020-02-14 08:28:11','12/12/90','1000922020',NULL,NULL,NULL,'100092',NULL,NULL,NULL),(52,'Laraib Manzar',8,'Manzar Khan','2020-02-14 08:28:11','2020-02-14 08:28:11','12/12/90','1000932020',NULL,NULL,NULL,'100093',NULL,NULL,NULL),(53,'Junaid Khan',8,'Syed Khan','2020-02-14 08:53:15','2020-02-14 08:53:15','12/12/90','1000942020',NULL,NULL,NULL,'100094',NULL,NULL,NULL),(54,'Ramsha Yousuf',8,'Yousuf Alli','2020-02-14 08:53:15','2020-02-14 08:53:15','12/12/90','1000952020',NULL,NULL,NULL,'100095',NULL,NULL,NULL),(55,'Laraib Manzar',8,'Manzar Khan','2020-02-14 08:53:16','2020-02-14 08:53:16','12/12/90','1000962020',NULL,NULL,NULL,'100096',NULL,NULL,NULL),(56,'Junaid Khan',8,'Syed Khan','2020-02-14 09:06:04','2020-02-14 09:06:04','12/12/90','2000942020',NULL,NULL,NULL,'200094',NULL,NULL,NULL),(57,'Ramsha Yousuf',8,'Yousuf Alli','2020-02-14 09:06:04','2020-02-14 09:06:04','12/12/90','2000952020',NULL,NULL,NULL,'200095',NULL,NULL,NULL),(58,'Laraib Manzar',8,'Manzar Khan','2020-02-14 09:06:04','2020-02-14 09:06:04','12/12/90','2000962020',NULL,NULL,NULL,'200096',NULL,NULL,NULL),(59,'Junaid Khan',9,'Syed Khan','2020-02-14 09:14:55','2020-02-14 09:14:55','12/12/90','',NULL,NULL,NULL,'300094',NULL,NULL,NULL),(60,'Junaid Khan',8,'Syed Khan','2020-02-14 09:24:54','2020-02-14 09:24:54','12/12/90','4000942020',NULL,NULL,NULL,'400094',NULL,NULL,NULL),(61,'Ramsha Yousuf',8,'Yousuf Alli','2020-02-14 09:24:54','2020-02-14 09:24:54','12/12/90','4000952020',NULL,NULL,NULL,'400095',NULL,NULL,NULL),(62,'Laraib Manzar',9,'Manzar Khan','2020-02-14 09:24:54','2020-02-14 09:24:54','12/12/90','4000962020',NULL,NULL,NULL,'400096',NULL,NULL,NULL);
/*!40000 ALTER TABLE `students` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'MohammadObaid','mobaid56@gmail.com',NULL,'$2y$10$GCy9mhTF.l1AvQ0NxQjt9.bo1Q51ZJm0w7QiZ6ZfCfQDUZrGUH50C',NULL,'2020-01-06 09:41:51','2020-01-06 09:41:51','admin'),(3,'BlockShift','info@blockshift.com.pk',NULL,'$2y$10$IQhO/xMHP4M7EWP.1b70aO6y1ST/tG2Zz8/VG6G6wuu8Rjk8hoaoO',NULL,'2020-01-15 03:13:51','2020-01-15 03:13:51','operator'),(4,'Khurram','khurram@blockshift.com.pk',NULL,'$2y$10$k46wGEQDQx5s4.q32QtSs.ds0bH6mPvyEGSnPcLkoAhZGH4QVI8tq',NULL,'2020-02-13 14:03:08','2020-02-13 14:03:08','admin'),(5,'Atif','atif@blockshift.com.pk',NULL,'$2y$10$gwfcsO1Vv.118qpUOFX3x.zg12MH3a6GJwmMTg9MTnFTbguKdHqdO',NULL,'2020-02-13 14:07:22','2020-02-13 23:31:18','operator');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-02-16 23:39:14
