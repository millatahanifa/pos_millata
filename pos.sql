/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19-12.3.2-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: pos
-- ------------------------------------------------------
-- Server version	12.3.2-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*M!100616 SET @OLD_NOTE_VERBOSITY=@@NOTE_VERBOSITY, NOTE_VERBOSITY=0 */;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` bigint(20) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` bigint(20) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` varchar(255) NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `item_penjualan`
--

DROP TABLE IF EXISTS `item_penjualan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `item_penjualan` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `penjualan_id` bigint(20) unsigned NOT NULL,
  `produk_id` bigint(20) unsigned NOT NULL,
  `kuantitas` int(11) NOT NULL,
  `harga_satuan` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `item_penjualan_penjualan_id_foreign` (`penjualan_id`),
  KEY `item_penjualan_produk_id_foreign` (`produk_id`),
  CONSTRAINT `item_penjualan_penjualan_id_foreign` FOREIGN KEY (`penjualan_id`) REFERENCES `penjualan` (`id`),
  CONSTRAINT `item_penjualan_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item_penjualan`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `item_penjualan` WRITE;
/*!40000 ALTER TABLE `item_penjualan` DISABLE KEYS */;
INSERT INTO `item_penjualan` VALUES
(1,1,8,2,143318,286636,'2026-07-21 23:14:02','2026-07-21 23:14:02'),
(2,1,2,5,149297,746485,'2026-07-21 23:14:02','2026-07-21 23:14:02'),
(3,1,2,10,149297,1492970,'2026-07-21 23:14:02','2026-07-21 23:14:02'),
(4,1,1,8,52186,417488,'2026-07-21 23:14:02','2026-07-21 23:14:02'),
(5,2,8,3,143318,429954,'2026-07-21 23:14:02','2026-07-21 23:14:02'),
(6,3,10,4,179009,716036,'2026-07-21 23:14:02','2026-07-21 23:14:02'),
(7,3,3,2,76706,153412,'2026-07-21 23:14:02','2026-07-21 23:14:02'),
(8,3,5,5,186944,934720,'2026-07-21 23:14:02','2026-07-21 23:14:02'),
(9,3,10,9,179009,1611081,'2026-07-21 23:14:02','2026-07-21 23:14:02'),
(10,3,8,5,143318,716590,'2026-07-21 23:14:02','2026-07-21 23:14:02'),
(11,4,8,9,143318,1289862,'2026-07-21 23:14:02','2026-07-21 23:14:02'),
(12,4,9,9,121126,1090134,'2026-07-21 23:14:02','2026-07-21 23:14:02'),
(13,5,6,6,131585,789510,'2026-07-21 23:14:02','2026-07-21 23:14:02'),
(14,5,3,5,76706,383530,'2026-07-21 23:14:02','2026-07-21 23:14:02'),
(15,5,1,8,52186,417488,'2026-07-21 23:14:02','2026-07-21 23:14:02'),
(16,6,3,4,76706,306824,'2026-07-21 23:14:02','2026-07-21 23:14:02'),
(17,7,4,6,36773,220638,'2026-07-21 23:14:02','2026-07-21 23:14:02'),
(18,7,4,5,36773,183865,'2026-07-21 23:14:02','2026-07-21 23:14:02'),
(19,8,4,9,36773,330957,'2026-07-21 23:14:02','2026-07-21 23:14:02'),
(20,9,8,9,143318,1289862,'2026-07-21 23:14:02','2026-07-21 23:14:02'),
(21,9,3,2,76706,153412,'2026-07-21 23:14:02','2026-07-21 23:14:02'),
(22,9,6,4,131585,526340,'2026-07-21 23:14:02','2026-07-21 23:14:02'),
(23,9,7,2,69413,138826,'2026-07-21 23:14:02','2026-07-21 23:14:02'),
(24,9,4,8,36773,294184,'2026-07-21 23:14:02','2026-07-21 23:14:02'),
(25,10,10,4,179009,716036,'2026-07-21 23:14:02','2026-07-21 23:14:02'),
(26,10,5,2,186944,373888,'2026-07-21 23:14:02','2026-07-21 23:14:02'),
(27,10,7,1,69413,69413,'2026-07-21 23:14:02','2026-07-21 23:14:02'),
(28,10,1,4,52186,208744,'2026-07-21 23:14:02','2026-07-21 23:14:02');
/*!40000 ALTER TABLE `item_penjualan` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` smallint(5) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES
(1,'0000_01_01_000000_create_roles_table',1),
(2,'0001_01_01_000000_create_users_table',1),
(3,'0001_01_01_000001_create_cache_table',1),
(4,'0001_01_01_000002_create_jobs_table',1),
(5,'2026_07_21_143238_create_produk_table',1),
(6,'2026_07_21_151041_create_penjualan_table',1),
(7,'2026_07_21_151430_create_item_penjualan_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `penjualan`
--

DROP TABLE IF EXISTS `penjualan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `penjualan` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `total_pembayaran` int(11) NOT NULL,
  `metode_pembayaran` varchar(255) NOT NULL,
  `status` enum('OPEN','COMPLETED') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `penjualan_user_id_foreign` (`user_id`),
  CONSTRAINT `penjualan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `penjualan`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `penjualan` WRITE;
/*!40000 ALTER TABLE `penjualan` DISABLE KEYS */;
INSERT INTO `penjualan` VALUES
(1,7,2943579,'QRIS','OPEN','2026-07-21 23:14:02','2026-07-21 23:14:02'),
(2,8,429954,'cash','COMPLETED','2026-07-21 23:14:02','2026-07-21 23:14:02'),
(3,9,4131839,'QRIS','OPEN','2026-07-21 23:14:02','2026-07-21 23:14:02'),
(4,10,2379996,'QRIS','COMPLETED','2026-07-21 23:14:02','2026-07-21 23:14:02'),
(5,11,1590528,'cash','OPEN','2026-07-21 23:14:02','2026-07-21 23:14:02'),
(6,12,306824,'cash','OPEN','2026-07-21 23:14:02','2026-07-21 23:14:02'),
(7,13,404503,'TRANSFER','OPEN','2026-07-21 23:14:02','2026-07-21 23:14:02'),
(8,14,330957,'QRIS','OPEN','2026-07-21 23:14:02','2026-07-21 23:14:02'),
(9,15,2402624,'TRANSFER','COMPLETED','2026-07-21 23:14:02','2026-07-21 23:14:02'),
(10,16,1368081,'cash','COMPLETED','2026-07-21 23:14:02','2026-07-21 23:14:02');
/*!40000 ALTER TABLE `penjualan` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `produk`
--

DROP TABLE IF EXISTS `produk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `produk` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `foto` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `produk_user_id_foreign` (`user_id`),
  KEY `produk_nama_index` (`nama`),
  CONSTRAINT `produk_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produk`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `produk` WRITE;
/*!40000 ALTER TABLE `produk` DISABLE KEYS */;
INSERT INTO `produk` VALUES
(1,1,'produk/648abca0-550f-3478-ae67-696e7ebe41bf','Aqua 600ml',29138,52186,2,'2026-07-21 23:14:02','2026-07-21 23:14:02'),
(2,1,'produk/2a3c56bc-135c-3a4c-94c8-d71958368357','Saus Sambal ABC',76353,149297,4,'2026-07-21 23:14:02','2026-07-21 23:14:02'),
(3,1,'produk/4bcd5a3e-077b-37eb-90a6-d2a79a854d13','Gula Pasir 1kg',69371,76706,2,'2026-07-21 23:14:02','2026-07-21 23:14:02'),
(4,1,'produk/d01ede85-15db-3711-9644-f8776d96d051','Pasta Gigi Pepsodent',23129,36773,2,'2026-07-21 23:14:02','2026-07-21 23:14:02'),
(5,1,'produk/6f43998b-007a-3a76-b27a-fc6679ec8336','Minyak Goreng 1L',87608,186944,3,'2026-07-21 23:14:02','2026-07-21 23:14:02'),
(6,1,'produk/dda815ea-6915-3a7b-9c05-4f8e60db7e20','Kecap Bango',33289,131585,1,'2026-07-21 23:14:02','2026-07-21 23:14:02'),
(7,1,'produk/7ec4cd45-1047-3161-8b9d-0452cf3f6b73','Pasta Gigi Pepsodent',11128,69413,4,'2026-07-21 23:14:02','2026-07-21 23:14:02'),
(8,1,'produk/e57f441e-8f45-3fb5-844d-293d5b281752','Kopi Kapal Api',51807,143318,4,'2026-07-21 23:14:02','2026-07-21 23:14:02'),
(9,1,'produk/89e39426-9626-3f19-9eb0-b3e45789345a','Saus Sambal ABC',53996,121126,3,'2026-07-21 23:14:02','2026-07-21 23:14:02'),
(10,1,'produk/9c3079c7-f624-32e4-84d0-42b0e275dede','Saus Sambal ABC',87923,179009,0,'2026-07-21 23:14:02','2026-07-21 23:14:02'),
(11,1,'default.jpg','Indomie Goreng',2500,3500,0,NULL,NULL),
(12,1,'default.jpg','Aqua 600ml',2500,4000,0,NULL,NULL),
(13,1,'default.jpg','Teh Botol Sosro',3000,5000,125,NULL,NULL),
(14,1,'default.jpg','Pop Mie Ayam',5000,7500,42,NULL,NULL),
(15,1,'default.jpg','Chitato 68g',8000,11000,0,NULL,NULL),
(16,1,'default.jpg','Pocari Sweat',6000,9000,200,NULL,NULL),
(17,1,'default.jpg','SilverQueen 65g',12000,16000,35,NULL,NULL),
(18,1,'default.jpg','Good Day Cappuccino',1500,2500,300,NULL,NULL),
(19,1,'default.jpg','Roti Coklat',5000,7000,0,NULL,NULL),
(20,1,'default.jpg','Teh Pucuk Harum',2500,4000,175,NULL,NULL);
/*!40000 ALTER TABLE `produk` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES
(1,'admin','2026-07-21 23:14:00','2026-07-21 23:14:00'),
(2,'kasir','2026-07-21 23:14:00','2026-07-21 23:14:00');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES
('IBUNdG9WWy0T4TBXYfjtFeGRSj96jkN86MxBZYkB',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36','eyJfdG9rZW4iOiJxRnFrQlpUZk5xYU9LREo5cVJadUY0bEh6eE93ejZVN0JWcnZaOGRYIiwidXJsIjp7ImludGVuZGVkIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL2FkbWluXC91c2VycyJ9LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL2FkbWluXC91c2VycyIsInJvdXRlIjoiYWRtaW4udXNlcnMifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6MX0=',1784729048),
('mcza5yKZf6izdT0V78nkbZgK7hTlX6Gd6HOD56zF',2,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36','eyJfdG9rZW4iOiJsMGN5Y1ZxVVc3N0NOUDZwMU53U1Y3YWpHclk5TEM1UXhsTVVDU1lhIiwiX2ZsYXNoIjp7Im5ldyI6W10sIm9sZCI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL2Rhc2hib2FyZCIsInJvdXRlIjoiZGFzaGJvYXJkIn0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjoyfQ==',1784705615);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_id_foreign` (`role_id`),
  FULLTEXT KEY `users_name_email_fulltext` (`name`,`email`),
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES
(1,1,'Admin','admin@gmail.com','2026-07-21 23:14:01','$2y$12$YzI2DlK25d7jEZGGfq8x3uUuPPBoYEG3GSq4vWXVjSBH092btgJou','StwCHFGdvJQraOAaL9NzThRM1UzNNNcGM8TOZF2YcRjm4UU1pD5CjMXFE8mo','2026-07-21 23:14:02','2026-07-21 23:14:02'),
(2,2,'Dr. Jason Terry','guy23@example.com','2026-07-21 23:14:02','$2y$12$YzI2DlK25d7jEZGGfq8x3uUuPPBoYEG3GSq4vWXVjSBH092btgJou','zw9lmyXGvu','2026-07-21 23:14:02','2026-07-21 23:14:02'),
(3,2,'Prof. Gardner Vandervort Jr.','yhauck@example.com','2026-07-21 23:14:02','$2y$12$YzI2DlK25d7jEZGGfq8x3uUuPPBoYEG3GSq4vWXVjSBH092btgJou','kmp5ejpZ2XH1DGHjr6E9DQP2ITAjRC7vrSEInKYGMwRPWbKE7Cdr5dkwBfyP','2026-07-21 23:14:02','2026-07-21 23:14:02'),
(4,2,'Dr. Lou Jaskolski','eveline38@example.org','2026-07-21 23:14:02','$2y$12$YzI2DlK25d7jEZGGfq8x3uUuPPBoYEG3GSq4vWXVjSBH092btgJou','H8xmNcYWZV','2026-07-21 23:14:02','2026-07-21 23:14:02'),
(5,2,'Fiona Hermiston','schmitt.roderick@example.net','2026-07-21 23:14:02','$2y$12$YzI2DlK25d7jEZGGfq8x3uUuPPBoYEG3GSq4vWXVjSBH092btgJou','oEehjHhFtN','2026-07-21 23:14:02','2026-07-21 23:14:02'),
(6,2,'Ms. Mayra Ferry MD','foster93@example.net','2026-07-21 23:14:02','$2y$12$YzI2DlK25d7jEZGGfq8x3uUuPPBoYEG3GSq4vWXVjSBH092btgJou','CwRmUHCUo8','2026-07-21 23:14:02','2026-07-21 23:14:02'),
(7,1,'Claudine Monahan','lockman.daren@example.net','2026-07-21 23:14:02','$2y$12$YzI2DlK25d7jEZGGfq8x3uUuPPBoYEG3GSq4vWXVjSBH092btgJou','oj68r4IylR','2026-07-21 23:14:02','2026-07-21 23:14:02'),
(8,1,'Jordy Shields','marisol58@example.net','2026-07-21 23:14:02','$2y$12$YzI2DlK25d7jEZGGfq8x3uUuPPBoYEG3GSq4vWXVjSBH092btgJou','X27zKhex7X','2026-07-21 23:14:02','2026-07-21 23:14:02'),
(9,1,'Noe O\'Reilly','felipa.becker@example.org','2026-07-21 23:14:02','$2y$12$YzI2DlK25d7jEZGGfq8x3uUuPPBoYEG3GSq4vWXVjSBH092btgJou','VnXbhhf956','2026-07-21 23:14:02','2026-07-21 23:14:02'),
(10,1,'Madison Hodkiewicz MD','anika.hyatt@example.net','2026-07-21 23:14:02','$2y$12$YzI2DlK25d7jEZGGfq8x3uUuPPBoYEG3GSq4vWXVjSBH092btgJou','zxRUOJVyKD','2026-07-21 23:14:02','2026-07-21 23:14:02'),
(11,1,'Aliza Blanda I','doyle.monserrat@example.org','2026-07-21 23:14:02','$2y$12$YzI2DlK25d7jEZGGfq8x3uUuPPBoYEG3GSq4vWXVjSBH092btgJou','hAlYNZJVlH','2026-07-21 23:14:02','2026-07-21 23:14:02'),
(12,1,'Jody Hickle','sipes.davon@example.com','2026-07-21 23:14:02','$2y$12$YzI2DlK25d7jEZGGfq8x3uUuPPBoYEG3GSq4vWXVjSBH092btgJou','0r0zWFRXzW','2026-07-21 23:14:02','2026-07-21 23:14:02'),
(13,1,'Mr. Garett Schiller','vwaelchi@example.net','2026-07-21 23:14:02','$2y$12$YzI2DlK25d7jEZGGfq8x3uUuPPBoYEG3GSq4vWXVjSBH092btgJou','iC0qOXjj0f','2026-07-21 23:14:02','2026-07-21 23:14:02'),
(14,1,'Prof. Darius Aufderhar DDS','bbartell@example.com','2026-07-21 23:14:02','$2y$12$YzI2DlK25d7jEZGGfq8x3uUuPPBoYEG3GSq4vWXVjSBH092btgJou','m83Q9E1AP7','2026-07-21 23:14:02','2026-07-21 23:14:02'),
(15,1,'Vicente Murazik','schuster.martina@example.org','2026-07-21 23:14:02','$2y$12$YzI2DlK25d7jEZGGfq8x3uUuPPBoYEG3GSq4vWXVjSBH092btgJou','dP7FHIFGLx','2026-07-21 23:14:02','2026-07-21 23:14:02'),
(16,1,'Vida Rolfson','hilpert.ryley@example.com','2026-07-21 23:14:02','$2y$12$YzI2DlK25d7jEZGGfq8x3uUuPPBoYEG3GSq4vWXVjSBH092btgJou','azxNGmtGq5','2026-07-21 23:14:02','2026-07-21 23:14:02');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*M!100616 SET NOTE_VERBOSITY=@OLD_NOTE_VERBOSITY */;

-- Dump completed on 2026-07-23  5:29:48
