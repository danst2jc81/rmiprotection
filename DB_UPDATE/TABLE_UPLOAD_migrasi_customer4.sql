/*
SQLyog Ultimate v12.4.3 (64 bit)
MySQL - 10.4.6-MariaDB : Database - rmiprotection
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`rmiprotection` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `rmiprotection`;

/*Table structure for table `migrasi_customer4` */

DROP TABLE IF EXISTS `migrasi_customer4`;

CREATE TABLE `migrasi_customer4` (
  `customer_id` bigint(22) DEFAULT 0,
  `customer_contact_person` varchar(255) DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `customer_address` varchar(255) DEFAULT NULL,
  `province_id` int(10) DEFAULT 0,
  `province_name` varchar(255) DEFAULT NULL,
  `city_id` int(10) DEFAULT 0,
  `city_name` varchar(255) DEFAULT NULL,
  `customer_mobile_phone` varchar(255) DEFAULT NULL,
  `customer_mobile_phone1` varchar(255) DEFAULT NULL,
  `customer_unit` varchar(255) DEFAULT NULL,
  `customer_email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `migrasi_customer4` */

insert  into `migrasi_customer4`(`customer_id`,`customer_contact_person`,`customer_name`,`customer_address`,`province_id`,`province_name`,`city_id`,`city_name`,`customer_mobile_phone`,`customer_mobile_phone1`,`customer_unit`,`customer_email`) values 
(117,'Fajar','Fama rental motor','Banda aceh',1,'Aceh',19,'KOTA BANDA ACEH','081260757848','081262611434','5 - 10 unit','fama.rentalmotor@gmail.com'),
(118,'Rahmat','Nethenrental','jl  seroja dalam III nomor 11. semarang tengah',13,'Jawa tengah',220,'KOTA SEMARANG','081314240770','087738908578','21 - 30 unit','Anggusbudi@gmail.com'),
(119,'Arifin Hidayat ','STS Rent Solo','Purwosari Solo',13,'Jawa Tengah',218,'KOTA SURAKARTA','0818-0620-7929 ','082-136-550-957 ','21 - 30 unit','ah.smashred@gmail.com'),
(120,'Ahmadi','Rental motor batam','Ruko kda blok c no 3',10,'Kepri',153,'KOTA BATAM','08117777165','08117789165','31 - 50 unit','Ahmadi165@gmail.com'),
(121,'Dayat','SUN RENTAL MALANG STASIUN','Jl.trunojoyo 80 klojen',15,'Jawa timur',259,'KOTA MALANG','082232376667','085648156088','5 - 10 unit','sunrentalmotor@gmail.com'),
(122,'Andrean e Susatya','Leandragroup','Taman gunung anyar B 60',15,'Jawa timur',264,'KOTA SURABAYA','081230567000','089518981444','diatas 50 unit','groupleandra@gmail.com'),
(123,'Sunday Motorent','Sunday Motorent','Jl. Jl giripalma 1 no 66\nPerumahan giripalma\nTidar atas\nKarangwidoro, Dau\nMalang 65151',15,'Jawa Timur',259,'KOTA MALANG','085288774000','082230149593','31 - 50 unit','rentalmotormalang@gmail.com'),
(66,'Taufiqur Rahman ','T&J TRANS_WISATA ','Jalan Joyosari 1 no.26b RT/RW 05/06',15,'Jawatimur',259,'KOTA MALANG','087859907757','+62 857-3024-8106','5 - 10 unit','tjtranswisata@gmail.com '),
(125,'Desi puji lestari','Jipta rent','Rejosari rt 01 rw 07',13,'Jawa tengah',218,'KOTA SURAKARTA','081390072249','081390072249','5 - 10 unit','desixavi@gmail.com'),
(123,'Sunday Motorent','Sunday Motorent','Jl giripalma 1 no 66\nPerumahan giripalma\nTidar atas\nKarangwidoro, Dau\nMalang 65151',15,'Jawa timur',259,'KOTA MALANG','085288774000','082230149593','31 - 50 unit','rentalmotormalang@gmail.com'),
(127,'Samsul Anam','FRent Jogja','Jalan Mawar V No. 8, Baciro, Gondokusuman',14,'DIY',227,'KOTA YOGYAKARTA','081331046756','087838938806','31 - 50 unit','frent.motor@gmail.com'),
(128,'Sumaryono','BDA Rental Motor Solo','Kampung sewu surakarta',13,'Jateng',218,'KOTA SURAKARTA','085642679109','0882-3212-8265','5 - 10 unit','aryomaryono7@gmail.com'),
(129,'Dayat','SUN rental motor malang','Jalan trunojoyo 80 klojen',15,'Jawa timur',259,'KOTA MALANG','082232376667','085648156088','5 - 10 unit','sunmotorental@gmail.com'),
(84,'Zainal','Chibi Rental Motor Malang','Jl Sriwijaya no 1',15,'Jawa Timur',259,'KOTA MALANG','081234300331','081331009293','21 - 30 unit','chibiadm@gmail.com'),
(118,'Rahmat','Nethenrental','Jl seroja dalam III nomor 11. semarang tengah.  .............. ',13,'Jawa tengah',220,'KOTA SEMARANG','081314240770','082220707244','21 - 30 unit','anggusbudi@gmail.com'),
(132,'AGUS LESTARIADI','ONGISTRANS MALANG','Jl. Sultan agung 12C',15,'JAWA TIMUR',259,'KOTA MALANG','081393032525','085648244488','21 - 30 unit','agus.lestari9@gmail.com'),
(133,'Arnie Dewie','FAMRENT SEMARANG ','Jl. Sanggung Barat ll no. 3 Jatingaleh Candisari ',13,'Jawa Tengah',220,'KOTA SEMARANG','088215524526','081227915895','5 - 10 unit','arniedewie2@gmail.com'),
(134,'Putut','Parapappa','Sultan agung 12 malang',15,'Jawa timur ',259,'KOTA MALANG','081945999245','081217314635','21 - 30 unit','parapappatransport@gmail.com'),
(135,'Eko haryanto','Oke rental motor cirebon','Perum banjarwangunan blok c3 no 11, banjarwangunan, mundu, cirebon',12,'Jawa barat',169,'KABUPATEN CIREBON','0857-2419-8194','-','11 - 20 unit','Haryantoeko354@gmail.com');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
