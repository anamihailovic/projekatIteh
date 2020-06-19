/*
SQLyog Community v13.1.6 (64 bit)
MySQL - 10.4.11-MariaDB : Database - nitro
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`nitro` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `nitro`;

/*Table structure for table `kategorija` */

DROP TABLE IF EXISTS `kategorija`;

CREATE TABLE `kategorija` (
  `id` int(11) NOT NULL,
  `naziv` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `kategorija` */

insert  into `kategorija`(`id`,`naziv`) values 
(1,'zaposleni'),
(2,'poslodavac');

/*Table structure for table `sastanak` */

DROP TABLE IF EXISTS `sastanak`;

CREATE TABLE `sastanak` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datum` date DEFAULT NULL,
  `tema` varchar(50) DEFAULT NULL,
  `tip` int(11) DEFAULT NULL,
  `zaposleni` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tip` (`tip`),
  KEY `zaposleni` (`zaposleni`),
  CONSTRAINT `sastanak_ibfk_1` FOREIGN KEY (`tip`) REFERENCES `tip_sastanka` (`id`),
  CONSTRAINT `sastanak_ibfk_2` FOREIGN KEY (`zaposleni`) REFERENCES `zaposleni` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

/*Data for the table `sastanak` */

insert  into `sastanak`(`id`,`datum`,`tema`,`tip`,`zaposleni`) values 
(7,'2020-06-23','promenjeno',1,2),
(8,'2020-06-17','TEma2',4,2),
(12,'2020-06-17','dsfdsgf',3,2),
(13,'2020-06-17','sfdsg',3,2),
(15,'2020-06-23','uspeh',3,2),
(16,'2020-06-23','zx',3,2),
(18,'2020-06-16','adfsg',3,2);

/*Table structure for table `tip_sastanka` */

DROP TABLE IF EXISTS `tip_sastanka`;

CREATE TABLE `tip_sastanka` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tip_sastanka` */

insert  into `tip_sastanka`(`id`,`naziv`) values 
(1,'dnevni'),
(2,'mesecni'),
(3,'vanredni'),
(4,'ostalo');

/*Table structure for table `zaposleni` */

DROP TABLE IF EXISTS `zaposleni`;

CREATE TABLE `zaposleni` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ime` varchar(30) DEFAULT NULL,
  `prezime` varchar(30) DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(30) DEFAULT NULL,
  `kategorija` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kategorija` (`kategorija`),
  CONSTRAINT `zaposleni_ibfk_1` FOREIGN KEY (`kategorija`) REFERENCES `kategorija` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `zaposleni` */

insert  into `zaposleni`(`id`,`ime`,`prezime`,`username`,`password`,`kategorija`) values 
(2,'Ana','Mihailovic','ana','ana',1),
(3,'Sanja ','Vujic','sanja','sanja',2);

/*Table structure for table `zaposleni_sastanak` */

DROP TABLE IF EXISTS `zaposleni_sastanak`;

CREATE TABLE `zaposleni_sastanak` (
  `zaposleni` int(11) NOT NULL,
  `sastanak` int(11) NOT NULL,
  PRIMARY KEY (`zaposleni`,`sastanak`),
  KEY `zaposleni_sastanak_ibfk_2` (`sastanak`),
  CONSTRAINT `zaposleni_sastanak_ibfk_1` FOREIGN KEY (`zaposleni`) REFERENCES `zaposleni` (`id`),
  CONSTRAINT `zaposleni_sastanak_ibfk_2` FOREIGN KEY (`sastanak`) REFERENCES `sastanak` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `zaposleni_sastanak` */

insert  into `zaposleni_sastanak`(`zaposleni`,`sastanak`) values 
(2,7),
(2,8),
(2,12),
(2,13),
(2,15),
(2,16),
(2,18),
(3,7),
(3,8),
(3,15),
(3,18);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
