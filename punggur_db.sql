-- MySQL dump 10.14  Distrib 5.5.44-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: punggur_db
-- ------------------------------------------------------
-- Server version	5.5.42-MariaDB-cll-lve

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
-- Table structure for table `smapunggur_admin`
--

DROP TABLE IF EXISTS `smapunggur_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `smapunggur_admin` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `nama_lengkap` varchar(30) NOT NULL,
  `nip` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `smapunggur_admin`
--

LOCK TABLES `smapunggur_admin` WRITE;
/*!40000 ALTER TABLE `smapunggur_admin` DISABLE KEYS */;
INSERT INTO `smapunggur_admin` (`id_admin`, `username`, `password`, `nama_lengkap`, `nip`) VALUES (1,'admin','admin','Sukiman','16271261211');
/*!40000 ALTER TABLE `smapunggur_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `smapunggur_nilai`
--

DROP TABLE IF EXISTS `smapunggur_nilai`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `smapunggur_nilai` (
  `id_nilai` int(5) NOT NULL AUTO_INCREMENT,
  `username` text NOT NULL,
  `nilai_mtk` decimal(5,2) NOT NULL,
  `nilai_bing` decimal(5,2) NOT NULL,
  `nilai_bindo` decimal(5,2) NOT NULL,
  `nilai_ipa` decimal(5,2) NOT NULL,
  `nilai_ips` decimal(5,2) NOT NULL,
  PRIMARY KEY (`id_nilai`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `smapunggur_nilai`
--

LOCK TABLES `smapunggur_nilai` WRITE;
/*!40000 ALTER TABLE `smapunggur_nilai` DISABLE KEYS */;
INSERT INTO `smapunggur_nilai` (`id_nilai`, `username`, `nilai_mtk`, `nilai_bing`, `nilai_bindo`, `nilai_ipa`, `nilai_ips`) VALUES (20,'9948811776',90.88,87.88,89.00,98.00,89.77),(21,'0001517915',80.70,81.23,87.77,80.56,81.78),(22,'0007153235',78.90,90.00,88.88,88.88,87.88),(23,'178216271',89.99,98.99,90.99,98.00,76.88),(24,'9940630093',80.00,79.00,78.88,88.99,90.77),(25,'0000373465',88.88,78.98,89.88,88.90,80.90);
/*!40000 ALTER TABLE `smapunggur_nilai` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `smapunggur_pengumuman`
--

DROP TABLE IF EXISTS `smapunggur_pengumuman`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `smapunggur_pengumuman` (
  `id_pengumuman` int(11) NOT NULL AUTO_INCREMENT,
  `judul_pengumuman` varchar(250) NOT NULL,
  `isi_pengumuman` text NOT NULL,
  `tanggal_pengumuman` datetime NOT NULL,
  PRIMARY KEY (`id_pengumuman`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `smapunggur_pengumuman`
--

LOCK TABLES `smapunggur_pengumuman` WRITE;
/*!40000 ALTER TABLE `smapunggur_pengumuman` DISABLE KEYS */;
INSERT INTO `smapunggur_pengumuman` (`id_pengumuman`, `judul_pengumuman`, `isi_pengumuman`, `tanggal_pengumuman`) VALUES (2,'Pengumuman Terbaru','Pengumuman terbaru ','2015-08-20 13:50:22');
/*!40000 ALTER TABLE `smapunggur_pengumuman` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `smapunggur_siswa`
--

DROP TABLE IF EXISTS `smapunggur_siswa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `smapunggur_siswa` (
  `id_siswa` int(11) NOT NULL AUTO_INCREMENT,
  `username` text NOT NULL,
  `password` varchar(30) NOT NULL,
  `nama_lengkap` varchar(30) NOT NULL,
  `jenis_kelamin` int(1) NOT NULL,
  `agama` int(1) NOT NULL,
  `tempat_lahir` varchar(30) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `nama_ortu` varchar(30) NOT NULL,
  `alamat_siswa` varchar(30) NOT NULL,
  `sekolah_asal` varchar(30) NOT NULL,
  `foto` varchar(200) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `nilai_tes` decimal(5,2) DEFAULT NULL,
  `tahun_ajaran` varchar(10) DEFAULT NULL,
  `tanggal_acc` date DEFAULT NULL,
  PRIMARY KEY (`id_siswa`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `smapunggur_siswa`
--

LOCK TABLES `smapunggur_siswa` WRITE;
/*!40000 ALTER TABLE `smapunggur_siswa` DISABLE KEYS */;
INSERT INTO `smapunggur_siswa` (`id_siswa`, `username`, `password`, `nama_lengkap`, `jenis_kelamin`, `agama`, `tempat_lahir`, `tanggal_lahir`, `nama_ortu`, `alamat_siswa`, `sekolah_asal`, `foto`, `status`, `nilai_tes`, `tahun_ajaran`, `tanggal_acc`) VALUES (35,'9948811776','masuk123','Setiawan Nugraha',0,0,'Mataram','1997-03-03','Sutiyah','Seputih Mataram','SMP Negeri 5 Way Seputih Matar','baby.jpg',0,NULL,'2015/2016',NULL),(36,'0001517915','123456','Afni Nurvita Dewi',1,0,'Pujo Asri','1999-05-17','Sumoyo','Pujo Asri, Lampung Tengah','SMP N 3 TRIMURO','baby.jpg',1,80.00,'2015/2016','2015-09-11'),(37,'0007153235','12345','Klara Vinanti',1,2,'Sritejokencono','2000-08-20','VALENTINUSEDI WAHYONO','Sritejo Kencono','smp n 1 Kotagajah','initpintu_å‰¯æœ¬.jpg',1,88.00,'2015/2016','2015-09-11'),(38,'178216271','178216271','DIMAS DWI ARYANTO',0,0,'Metro','1990-09-14','sukir','metro','Mts Negeri 1 Metro','aneh.jpg',1,90.00,'2015/2016','2015-09-11'),(39,'9940630093','masuk123','Fajar Rahmat',0,3,'Gunung Sugih','1999-08-23','Khoiruddin','Gunung Sugih, Lampung Tengah','SMP N 1 Punggur','Windows-8-logo-300x300.jpg',2,NULL,'2015/2016',NULL),(40,'0000373465','tes123','Dyah Adelian Putri',1,0,'Totokaton','2000-06-20','Supendi','Totokaton, Kec. Punggur, Lampu','SMP N 2 Punggur','aneh.jpg',2,NULL,'2015/2016',NULL);
/*!40000 ALTER TABLE `smapunggur_siswa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `smapunggur_tes`
--

DROP TABLE IF EXISTS `smapunggur_tes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `smapunggur_tes` (
  `id_tes` int(5) NOT NULL AUTO_INCREMENT,
  `username` text NOT NULL,
  `tes_akademis` int(1) NOT NULL,
  `tes_akademis_bakat` int(1) NOT NULL,
  `tes_bakat` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_tes`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `smapunggur_tes`
--

LOCK TABLES `smapunggur_tes` WRITE;
/*!40000 ALTER TABLE `smapunggur_tes` DISABLE KEYS */;
INSERT INTO `smapunggur_tes` (`id_tes`, `username`, `tes_akademis`, `tes_akademis_bakat`, `tes_bakat`) VALUES (17,'9948811776',0,0,2),(18,'0001517915',0,0,1),(19,'0007153235',0,0,1),(20,'178216271',0,0,3),(21,'9940630093',0,0,2),(22,'0000373465',0,0,1);
/*!40000 ALTER TABLE `smapunggur_tes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `smapunggur_waktutest`
--

DROP TABLE IF EXISTS `smapunggur_waktutest`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `smapunggur_waktutest` (
  `id_waktutes` int(5) NOT NULL AUTO_INCREMENT,
  `nama_test` varchar(25) NOT NULL,
  `keterangan` varchar(250) DEFAULT NULL,
  `waktu_test` datetime DEFAULT NULL,
  PRIMARY KEY (`id_waktutes`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `smapunggur_waktutest`
--

LOCK TABLES `smapunggur_waktutest` WRITE;
/*!40000 ALTER TABLE `smapunggur_waktutest` DISABLE KEYS */;
INSERT INTO `smapunggur_waktutest` (`id_waktutes`, `nama_test`, `keterangan`, `waktu_test`) VALUES (1,'Tes Akademis',NULL,'2015-08-31 08:00:00'),(2,'Tes Bakat',NULL,'2015-08-13 09:00:00'),(3,'Tempat Test','Halaman SMA',NULL);
/*!40000 ALTER TABLE `smapunggur_waktutest` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'punggur_db'
--

--
-- Dumping routines for database 'punggur_db'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-09-21  3:34:36
