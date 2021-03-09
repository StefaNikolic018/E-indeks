-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Mar 09, 2021 at 03:17 PM
-- Server version: 8.0.18
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `evidencija_studenata`
--

-- --------------------------------------------------------

--
-- Table structure for table `dogadjaji`
--

DROP TABLE IF EXISTS `dogadjaji`;
CREATE TABLE IF NOT EXISTS `dogadjaji` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naslov` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `predmet` int(11) NOT NULL,
  `godina_studija` int(11) NOT NULL,
  `izbor` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `pocetak` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `zavrsetak` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `boja` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `ceo_dan` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `predmet` (`predmet`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `dogadjaji`
--

INSERT INTO `dogadjaji` (`id`, `naslov`, `predmet`, `godina_studija`, `izbor`, `pocetak`, `zavrsetak`, `boja`, `ceo_dan`) VALUES
(1, '2. kolokvijum KSS', 44, 3, 'Kolokvijum', '3.3.2021. 00:00:00', '4.3.2021. 00:00:00', '#592e83', 'true'),
(2, 'Ispit Net tehnologije', 44, 3, 'Ispit', '2.3.2021. 11:00:00', '2.3.2021. 15:00:00', '#db5461', 'false');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `obavestenja`
--

DROP TABLE IF EXISTS `obavestenja`;
CREATE TABLE IF NOT EXISTS `obavestenja` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naslov` varchar(255) NOT NULL,
  `obavestenje` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `potpis` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `datum` date NOT NULL,
  `odobrenje` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `potpis` (`potpis`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `obavestenja`
--

INSERT INTO `obavestenja` (`id`, `naslov`, `obavestenje`, `potpis`, `datum`, `odobrenje`) VALUES
(1, 'neki naslov tamo', 'nesto tamo negde', 'superAdmin', '2020-12-21', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ocene`
--

DROP TABLE IF EXISTS `ocene`;
CREATE TABLE IF NOT EXISTS `ocene` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `predmet_id` int(11) NOT NULL,
  `ocena` decimal(6,2) NOT NULL,
  `datum` date NOT NULL,
  `student_predmet` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `foreign` (`predmet_id`),
  KEY `student_id` (`student_id`)
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8;

--
-- Triggers `ocene`
--
DROP TRIGGER IF EXISTS `t_espb`;
DELIMITER $$
CREATE TRIGGER `t_espb` AFTER DELETE ON `ocene` FOR EACH ROW UPDATE studenti
SET studenti.espb=studenti.espb-(SELECT espb FROM predmeti WHERE id=old.predmet_id)
WHERE studenti.id=old.student_id
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `t_espb_decrement`;
DELIMITER $$
CREATE TRIGGER `t_espb_decrement` AFTER UPDATE ON `ocene` FOR EACH ROW UPDATE studenti
SET studenti.espb=studenti.espb-(SELECT espb FROM predmeti WHERE id=old.predmet_id)+(SELECT espb FROM predmeti WHERE id=new.predmet_id)
WHERE studenti.id=old.student_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `predmeti`
--

DROP TABLE IF EXISTS `predmeti`;
CREATE TABLE IF NOT EXISTS `predmeti` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sifra` varchar(30) NOT NULL,
  `naziv` varchar(50) NOT NULL,
  `godina_studija` smallint(6) NOT NULL,
  `espb` int(11) NOT NULL,
  `obavezni_izborni` varchar(10) NOT NULL,
  `smerovi` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sifra` (`sifra`),
  KEY `smerovi` (`smerovi`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `predmeti`
--

INSERT INTO `predmeti` (`id`, `sifra`, `naziv`, `godina_studija`, `espb`, `obavezni_izborni`, `smerovi`) VALUES
(39, 'KSS1', 'Klijent Server Sistemi', 3, 6, 'Obavezni', 8),
(40, 'TKT1', 'Telekomunikacije', 2, 6, 'Obavezni', 9),
(42, 'WP1', 'Web Programiranje', 3, 6, 'Obavezni', 8),
(43, 'TE2', 'Tehnički Engleski 2', 3, 6, 'Obavezni', 8),
(44, 'NT1', 'Net tehnologije', 3, 6, 'Obavezni', 8),
(45, 'ABP01', 'Administriranje Baza Podataka', 3, 6, 'Obavezni', 8),
(46, 'TKT3', 'Telekomunikacije', 2, 5, 'Obavezni', 8),
(47, 'M01', 'Matematika', 1, 6, 'Obavezni', 9);

--
-- Triggers `predmeti`
--
DROP TRIGGER IF EXISTS `t_espb_predmet`;
DELIMITER $$
CREATE TRIGGER `t_espb_predmet` BEFORE DELETE ON `predmeti` FOR EACH ROW UPDATE studenti
SET studenti.espb=studenti.espb-(SELECT espb FROM predmeti WHERE id=old.id)
WHERE studenti.id=(SELECT student_id FROM ocene WHERE predmet_id=old.id)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `profesori`
--

DROP TABLE IF EXISTS `profesori`;
CREATE TABLE IF NOT EXISTS `profesori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email_korisnika` varchar(191) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ime` varchar(255) NOT NULL,
  `prezime` varchar(255) NOT NULL,
  `zvanje` varchar(255) NOT NULL,
  `bio` text NOT NULL,
  `datum_rodjenja` date NOT NULL,
  `datum_zaposljenja` int(255) NOT NULL,
  `predmeti` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_korisnika` (`email_korisnika`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `profesori`
--

INSERT INTO `profesori` (`id`, `email_korisnika`, `ime`, `prezime`, `zvanje`, `bio`, `datum_rodjenja`, `datum_zaposljenja`, `predmeti`) VALUES
(4, 'milos.k@gmail.com', 'Milos', 'Kosanovic', 'dipl. Inzinjer', 'neka dostignuca', '1988-01-11', 2014, 'Klijent Server Sistemi'),
(6, 'slavimir.s@gmail.com', 'Slavimir', 'Stošović', 'dr. Elektrotehnike', 'Neka biografija', '1981-02-10', 2005, 'Web Programiranje');

-- --------------------------------------------------------

--
-- Table structure for table `raspored`
--

DROP TABLE IF EXISTS `raspored`;
CREATE TABLE IF NOT EXISTS `raspored` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `smer` int(11) NOT NULL,
  `godina_studija` int(11) NOT NULL,
  `ponedeljak` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `utorak` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `sreda` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cetvrtak` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `petak` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `smer_id` (`smer`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `raspored`
--

INSERT INTO `raspored` (`id`, `smer`, `godina_studija`, `ponedeljak`, `utorak`, `sreda`, `cetvrtak`, `petak`) VALUES
(5, 8, 3, '42,13:15-14:00,Vežbe,A1.42,14:15-15:00,Vežbe,A1.44,15:15-16:00,Predavanja,A2', '43,13:15-14:00,Predavanja,A3.43,14:15-15:00,Predavanja,A3', '44,13:15-14:00,Vežbe,A1.44,14:15-15:00,Vežbe,A1', '39,15:15-16:00,Vežbe,A1.39,16:15-17:00,Vežbe,A1', ''),
(7, 9, 1, '39,13:15-14:00,Predavanja,A2', '40,13:15-14:00,Predavanja,A1', 'Nema predavanja', 'Nema predavanja', 'Nema predavanja');

-- --------------------------------------------------------

--
-- Table structure for table `smerovi`
--

DROP TABLE IF EXISTS `smerovi`;
CREATE TABLE IF NOT EXISTS `smerovi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `opis` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `espb` int(11) NOT NULL,
  `akreditovan` varchar(4) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `smerovi`
--

INSERT INTO `smerovi` (`id`, `naziv`, `opis`, `espb`, `akreditovan`) VALUES
(8, 'Savremene Računarske Tehnologije', 'Ovaj studijski program se bavi izučavanjem modernih računarskih tehnologija', 180, '2017'),
(9, 'Telekomunikacione Tehnologije', 'nesto tamo', 180, '2015');

-- --------------------------------------------------------

--
-- Table structure for table `studenti`
--

DROP TABLE IF EXISTS `studenti`;
CREATE TABLE IF NOT EXISTS `studenti` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ime` varchar(20) NOT NULL,
  `ime_roditelja` varchar(20) NOT NULL,
  `prezime` varchar(20) NOT NULL,
  `broj_indeksa` varchar(10) NOT NULL,
  `godina_studija` int(11) NOT NULL,
  `jmbg` bigint(255) NOT NULL,
  `datum_rodjenja` varchar(10) NOT NULL,
  `espb` int(11) DEFAULT '0',
  `prosek_ocena` decimal(11,2) DEFAULT '0.00',
  `broj_telefona` int(11) NOT NULL,
  `email` varchar(191) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `smer` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `broj_indeksa` (`broj_indeksa`),
  UNIQUE KEY `email` (`email`),
  KEY `ind_smer` (`smer`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ime` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `prezime` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `role` (`role`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ime`, `prezime`, `email`, `password`, `role`) VALUES
(5, 'Stefan', 'Nikolic', 'stefanikolic018@gmail.com', '$2y$10$h/8aI2xWp41QJE.V6qj5DeNsmJdS.oJDmubMfHVUlOvwiaPOV4y16', 'user'),
(7, 'Slavimir', 'Stošović', 'slavimir.s@gmail.com', '$2y$10$MnfsQXpzsDuhQZI.PFhmpeijsYu.vzXLmBumEZq2rt1nQAN4rJFKe', 'admin'),
(8, 'Irina', 'Irinovic', 'irina.i@gmail.com', '$2y$10$WeS0gf0Ph0AXpgHunXR/seeEOpv..vS/Nccr/yaVtFtVPubpX3.OK', 'superAdmin'),
(11, 'Milos', 'Kosanovic', 'milos.k@gmail.com', '$2y$10$dx.O2y99FyPVIGX5w4Mqn.bXCjYY.wRJcHhTenmCN0xmPo39njq1O', 'admin'),
(12, 'Nikola', 'Dimitrijevic', 'nidza.dim@gmail.com', '$2y$10$pacecHqclH7PnHCWrgl5oOOhj3ZfBvAa9Q9c4cknq1NMOFfOcEeJa', 'user');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dogadjaji`
--
ALTER TABLE `dogadjaji`
  ADD CONSTRAINT `dogadjaji_ibfk_1` FOREIGN KEY (`predmet`) REFERENCES `predmeti` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `obavestenja`
--
ALTER TABLE `obavestenja`
  ADD CONSTRAINT `obavestenja_ibfk_1` FOREIGN KEY (`potpis`) REFERENCES `users` (`role`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ocene`
--
ALTER TABLE `ocene`
  ADD CONSTRAINT `ocene_ibfk_1` FOREIGN KEY (`predmet_id`) REFERENCES `predmeti` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ocene_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `studenti` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `predmeti`
--
ALTER TABLE `predmeti`
  ADD CONSTRAINT `predmeti_ibfk_1` FOREIGN KEY (`smerovi`) REFERENCES `smerovi` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `profesori`
--
ALTER TABLE `profesori`
  ADD CONSTRAINT `profesori_ibfk_1` FOREIGN KEY (`email_korisnika`) REFERENCES `users` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `raspored`
--
ALTER TABLE `raspored`
  ADD CONSTRAINT `raspored_ibfk_1` FOREIGN KEY (`smer`) REFERENCES `smerovi` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `studenti`
--
ALTER TABLE `studenti`
  ADD CONSTRAINT `studenti_ibfk_1` FOREIGN KEY (`email`) REFERENCES `users` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `studenti_ibfk_2` FOREIGN KEY (`smer`) REFERENCES `smerovi` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
