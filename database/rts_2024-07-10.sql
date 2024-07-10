# ************************************************************
# Sequel Ace SQL dump
# Version 20067
#
# https://sequel-ace.com/
# https://github.com/Sequel-Ace/Sequel-Ace
#
# Host: 127.0.0.1 (MySQL 8.2.0)
# Database: desaku
# Generation Time: 2024-07-10 10:31:57 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE='NO_AUTO_VALUE_ON_ZERO', SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table rts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `rts`;

CREATE TABLE `rts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ketua` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rw_id` int NOT NULL,
  `dusun_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `rts` WRITE;
/*!40000 ALTER TABLE `rts` DISABLE KEYS */;

INSERT INTO `rts` (`id`, `nama`, `ketua`, `rw_id`, `dusun_id`, `created_at`, `updated_at`)
VALUES
	(1,'RT 001','Suwito Mulyadi',1,1,NULL,NULL),
	(2,'RT 002','Wawan Situmorang',1,1,NULL,NULL),
	(3,'RT 003','Didin Hastuti',1,1,NULL,NULL),
	(4,'RT 004','Mansur Puspitasari',1,1,NULL,NULL),
	(5,'RT 005','Riski Rohmah',2,1,NULL,NULL),
	(6,'RT 006','Gunawan Simanjuntak',2,1,NULL,NULL),
	(7,'RT 007','Suparman Simanjuntak',2,1,NULL,NULL),
	(8,'RT 008','Suradi Utomo',2,1,NULL,NULL),
	(9,'RT 009','Dede Rohayati',3,2,NULL,NULL),
	(10,'RT 010','Rizki Hidayat',3,2,NULL,NULL),
	(11,'RT 011','Untung Haryati',3,2,NULL,NULL),
	(12,'RT 012','Acep Iskandar',3,2,NULL,NULL),
	(13,'RT 013','Saleh Aminah',4,2,NULL,NULL),
	(14,'RT 014','Lukman Masitoh',4,2,NULL,NULL),
	(15,'RT 015','Ibnu Panggabean',4,2,NULL,NULL),
	(16,'RT 016','Suroso Gulo',4,2,NULL,NULL),
	(17,'RT 017','Fajar Sitorus',5,3,NULL,NULL),
	(18,'RT 018','Mulyadi Prayitno',5,3,NULL,NULL),
	(19,'RT 019','Acep Hamdani',5,3,NULL,NULL),
	(20,'RT 020','Muhammad Janah',5,3,NULL,NULL),
	(21,'RT 021','Gede Ningrum',6,3,NULL,NULL),
	(22,'RT 022','Khairul Mariana',6,3,NULL,NULL),
	(23,'RT 023','Andika Pramono',6,3,NULL,NULL),
	(24,'RT 024','Chandra Halim',6,3,NULL,NULL),
	(25,'RT 025','Sukardi Manik',7,4,NULL,NULL),
	(26,'RT 026','Khairul Astuti',7,4,NULL,NULL),
	(27,'RT 027','Yohanes Nurhayati',7,4,NULL,NULL),
	(28,'RT 028','Abdullah Royani',7,4,NULL,NULL),
	(29,'RT 029','Yayan Susilawati',8,5,NULL,NULL),
	(30,'RT 030','Mujiono Sumarni',8,5,NULL,NULL),
	(31,'RT 031','Supriadi Hidayat',8,5,NULL,NULL);

/*!40000 ALTER TABLE `rts` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
