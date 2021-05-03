-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 20, 2020 at 08:03 AM
-- Server version: 5.7.24
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penilaian`
--

-- --------------------------------------------------------

--
-- Table structure for table `aktivitas`
--

CREATE TABLE `aktivitas` (
  `id_aktivitas` int(11) NOT NULL,
  `id_kelompok` int(11) NOT NULL,
  `id_ceklis` char(5) DEFAULT NULL,
  `h` int(11) NOT NULL,
  `h1` int(11) NOT NULL,
  `h2` int(11) NOT NULL,
  `h3` int(11) NOT NULL,
  `tipe` enum('2','3') NOT NULL COMMENT '2 : TELEGRAM\r\n3 : TELEPON'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `aktivitas`
--

INSERT INTO `aktivitas` (`id_aktivitas`, `id_kelompok`, `id_ceklis`, `h`, `h1`, `h2`, `h3`, `tipe`) VALUES
(1, 1, 'C35', 5, 5, 4, 4, '2'),
(2, 2, 'C35', 4, 1, 2, 3, '2'),
(3, 2, 'C36', 1, 1, 1, 1, '3');

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `id_anggota` int(11) NOT NULL,
  `id_pangkat` int(11) DEFAULT NULL,
  `id_kelompok` int(11) DEFAULT NULL,
  `nrp` char(20) DEFAULT NULL,
  `nama` char(100) NOT NULL,
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id_anggota`, `id_pangkat`, `id_kelompok`, `nrp`, `nama`, `password`) VALUES
(4, NULL, 1, '11940027940773', 'Edi Saputra, S.I.P.', NULL),
(5, NULL, 1, '523352', 'I Gusti Putu Setia D, S.T., M.M.', NULL),
(6, NULL, 1, '11960044180874', 'Deni Sukwara, S.E., M.Si.', NULL),
(7, NULL, 1, '-', 'Mamao Monis Tandayao (Filipina)', NULL),
(8, NULL, 1, '11960039310274', 'Safta Feryansyah, S.E., S.I.P.', NULL),
(9, NULL, 1, '12617/P', 'Muhammad Nizar Gadafi, S.E.', NULL),
(10, NULL, 1, '11960051260775', 'Wulang Nur Yudhanto', NULL),
(11, NULL, 1, '518843', 'Ridha Hermawan, S.H.', NULL),
(12, NULL, 1, '11950044840774', 'Surya Wibawa Suparman', NULL),
(13, NULL, 1, '12262/P', 'Arya Delano, S.E., MPD.', NULL),
(14, NULL, 1, '11970039301175', 'Ferry Irawan, S.I.P.', NULL),
(15, NULL, 1, '520294', 'Visnu Hermawan, S.E., M.M.', NULL),
(16, NULL, 1, '11950038580771', 'Teguh Pudji Rahardjo', NULL),
(17, NULL, 1, '11897/P', 'I Komang Teguh A, S.T., M.AP.', NULL),
(18, NULL, 1, '11950050690571', 'Wiwin Sugiono, S.I.P.', NULL),
(19, NULL, 1, '12702/P', 'Ferry Mulyadi Arifin', NULL),
(20, NULL, 1, '11970044900676', 'Mohammad Sjahroni, S.E.', NULL),
(21, NULL, 1, '68080524', 'I Ketut Yudha Karyana, S.I.K.', NULL),
(22, NULL, 1, '11960048970275', 'Erwin, S.I.P.', NULL),
(23, NULL, 1, '517477', 'Djoko Triono', NULL),
(24, NULL, 1, '11960047231274', 'Wijang Rimoko Ardani, S.Sos.', NULL),
(25, NULL, 1, '73060608', 'Akhmad Yusep gunawan, S.H., S.I.K.', NULL),
(26, NULL, 2, '11459/P', 'Mauriadi, S.E.', NULL),
(27, NULL, 2, '11960045901074', 'Otto Sollu, S.E.', NULL),
(28, NULL, 2, '11970037570875', 'Aji Mimbarno, S.A.P.', NULL),
(29, NULL, 2, '73040543', 'Guruh Arif Darmawan, S.I.K., M.H.', NULL),
(30, NULL, 2, '12624/P', 'Rakhmat Arief Bintoro, S.Kel.', NULL),
(31, NULL, 2, '11960032610173', 'Muhammad Aidi, S.I.P., M.Si.', NULL),
(32, NULL, 2, '523357', 'A. Donie Prihandono, S.E.', NULL),
(33, NULL, 2, '12644/P', 'Wawan Trisatya Atmaja, S.E.', NULL),
(34, NULL, 2, '11960034440473', 'Renal Aprindo Sinaga', NULL),
(35, NULL, 2, '521812', 'Ali Gusman, S.T., M.M.', NULL),
(36, NULL, 2, '11970036820875', 'Maychel Asmi, P.Sc., S.E.', NULL),
(37, NULL, 2, '12647/P', 'Dores Afrianto Ardi, S.E., M.Si.', NULL),
(38, NULL, 2, '11960040790474', 'Ari Estefanus, S.Sos., M.Sc.', NULL),
(39, NULL, 2, '11964/P', 'Sunaryadi, S.E., M.Si.', NULL),
(40, NULL, 2, '11970040521175', 'Susanto Lastua Manurung, S.I.P.', NULL),
(41, NULL, 2, '10683/P', 'Uki Prasetia, S.T., M.M.', NULL),
(42, NULL, 2, '69100444', 'Dr. Hadi Utomo, S.H., M.Hum.', NULL),
(43, NULL, 2, '521835', 'Darmawan Hendro W, M.Eng.Sc.', NULL),
(44, NULL, 2, '11970048700474', 'Brantas Suharyo G', NULL),
(45, NULL, 2, '521755', 'Rudy Nursofjan, S.T.', NULL),
(46, NULL, 2, '11980060491175', 'Zulhadrie S Mara', NULL),
(47, NULL, 3, '11970050420875', 'Johanes Toar Pioh, S.I.P., M.Si. (Han)', NULL),
(48, NULL, 3, '11923/P', 'Oky IZ Dipura, S.H., M.P.A.', NULL),
(49, NULL, 3, '521806', 'Arman Rusmanto, S.T.', NULL),
(50, NULL, 3, '-', 'JD Masurkar (India)', NULL),
(51, NULL, 3, '11950036641270', 'Andi Asmara Dewa', NULL),
(52, NULL, 3, '12713/P', 'Kresno Pratowo, S.E.', NULL),
(53, NULL, 3, '11960051420875', 'Agus Bhakti, S.I.P.', NULL),
(54, NULL, 3, '11950043771172', 'Musa David M. Hasibuan, S.I.P.', NULL),
(55, NULL, 3, '12627/P', 'Endra Hartono, S.H.', NULL),
(56, NULL, 3, '11960050010375', 'Marthen Venry Rorintulus, S.E.', NULL),
(57, NULL, 3, '521782', 'Arif Budiyanto, S.E.', NULL),
(58, NULL, 3, '11950049971173', 'Donova Pri Pamungkas', NULL),
(59, NULL, 3, '11906/P', 'Adi Lumaksana, S.Sos.', NULL),
(60, NULL, 3, '11960052171073', 'Vincentius Agung Cahya K, S.I.P.', NULL),
(61, NULL, 3, '11926/P', 'Siswanto, S.T., M.T.', NULL),
(62, NULL, 3, '11960043920874', 'M. Taufiq Zega, S.I.P., M.Si.', NULL),
(63, NULL, 3, '521785', 'Benny Bayu Nirwan, S.T.', NULL),
(64, NULL, 3, '11960050920675', 'Jones Sasmita Muliawan, S.I.P., M.M.', NULL),
(65, NULL, 3, '72070702', 'E. Zulpan, S.I.K., M.Si.', NULL),
(66, NULL, 3, '11980053710877', 'Aulia Dwi Nasrullah', NULL),
(67, NULL, 3, '70090398', 'Nanang Masbudi, S.I.K., M.Si.', NULL),
(68, NULL, 4, '521845', 'Jhonson Henrico Simatupang', NULL),
(69, NULL, 4, '11970049460175', 'Candy Cristian Riantory, S.I.P.', NULL),
(70, NULL, 4, '11908/P', 'Henricus Prihantoko', NULL),
(71, NULL, 4, '72030201', 'Rickynaldo Chairul, S.I.K., M.M.', NULL),
(72, NULL, 4, '520244', 'Budi Setyo, S.H.', NULL),
(73, NULL, 4, '11970034500375', 'Purnomosidi, S.I.P., M.AP.', NULL),
(74, NULL, 4, '11931/P', 'Reza Kusumanegara, M.A.P.', NULL),
(75, NULL, 4, '521759', 'Bambang Sudewo', NULL),
(76, NULL, 4, '11960044260974', 'Horasman Pakpahan, S.I.P.', NULL),
(77, NULL, 4, '12732/P', 'Agus Gunawan Wibisono, S.H., M.M.', NULL),
(78, NULL, 4, '11970041440176', 'Willy Brodus Yos Rohadi', NULL),
(79, NULL, 4, '523392', 'Toto ginanto, S.T., M.AP.', NULL),
(80, NULL, 4, '11970033930275', 'Hendi Ahmad Pribadi, S.I.P.', NULL),
(81, NULL, 4, '13292/P', 'Wahyu Cahyono, S.T., M.M.', NULL),
(82, NULL, 4, '11960052741074', 'Herfin Kartika Aji, S.I.P.', NULL),
(83, NULL, 4, '521832', 'Purwanto Adi Nugroho', NULL),
(84, NULL, 4, '11960044420974', 'Chrisbianto Arimurti', NULL),
(85, NULL, 4, '11980053220777', 'Andre Julian, S.I.P., M.Sos.', NULL),
(86, NULL, 4, '70090406', 'Leonardus Eric Bhismo, S.I.K., S.H., M.Hum.', NULL),
(87, NULL, 4, '520299', 'Rudiyanto, S.T., M.M.', NULL),
(88, NULL, 4, '11970032110774', 'Muhammad Thohir', NULL),
(89, NULL, 5, '523407', 'Rony Armanto, S.E., M.M.', NULL),
(90, NULL, 5, '11970042350376', 'Tamimi Hendra Kesuma, S.H., M.A.P.', NULL),
(91, NULL, 5, '11950043020972', 'Lalu Habibburrahim WD, S.I.P. M.Si.', NULL),
(92, NULL, 5, '-', 'Muhammad Anjum Saeed (Pakistan)', NULL),
(93, NULL, 5, '523332', 'Andreas Ardianto D, S.E., M.Si. (Han)., M.sc.', NULL),
(94, NULL, 5, '11960048630275', 'Andrian Susanto, S.I.P.', NULL),
(95, NULL, 5, '11888/P', 'Baharudin Anwar, S.T., M.M.', NULL),
(96, NULL, 5, '11970043670576', 'Endra Saputra Kusuma, ZR., S.E.', NULL),
(97, NULL, 5, '521877', 'Henri Ahmad Badawi', NULL),
(98, NULL, 5, '11960039640274', 'Slamet Riadi, S.I.P.', NULL),
(99, NULL, 5, '11994/P', 'Dede Harsana', NULL),
(100, NULL, 5, '11970041510176', 'Patar Mospa Natanael Sitorus', NULL),
(101, NULL, 5, '521823', 'Saeful Rakhmat', NULL),
(102, NULL, 5, '11960048061274', 'Teddy Arifiyanto Setimiharja, S.I.P.', NULL),
(103, NULL, 5, '523405', 'Rizaldy Efranza, S.T.', NULL),
(104, NULL, 5, '70121127', 'Djadjuli, S.I.K., M.Si.', NULL),
(105, NULL, 5, '1195005317', 'Harvin Kidingalio', NULL),
(106, NULL, 5, '74040735', 'Didi Hayamansyah, S.H., S.I.K., M.H.', NULL),
(107, NULL, 5, '523397', 'Antonius Adi Nur W, S.E.', NULL),
(108, NULL, 5, '11960046401174', 'Mochamad Andi Prihantoro', NULL),
(109, NULL, 5, '12688/P', 'Abraham OP Sahureka, S.T., MMT.', NULL),
(110, NULL, 5, '74020330', 'Abdul Karim, S.I.K., M.Si.', NULL),
(111, NULL, 6, '11970044330576', 'Yudha Rismansyah', NULL),
(112, NULL, 6, '11357/P', 'Sumartono, S.E.', NULL),
(113, NULL, 6, '11960049050275', 'Yuri Elias Mamahi', NULL),
(114, NULL, 6, '71010253', 'F. Barung Mangera, S.I.K.', NULL),
(115, NULL, 6, '11950049891173', 'Haerus Shaleh, S.Sos.', NULL),
(116, NULL, 6, '523339', 'R. Endri Kargono', NULL),
(117, NULL, 6, '13278/P', 'Tunggul', NULL),
(118, NULL, 6, '11960043500874', 'Andy Mustafa Akad, S.E.', NULL),
(119, NULL, 6, '11924/P', 'Irwan SP. Siagian', NULL),
(120, NULL, 6, '523330', 'Rano Kristiyono, S.T.', NULL),
(121, NULL, 6, '11970045320776', 'Fransiscus Ari Susetio, S.E.', NULL),
(122, NULL, 6, '11970032520974', 'Riza Anom Putranto, S.I.P., M.Si.', NULL),
(123, NULL, 6, '523361', 'Jajang Setiawan, S.M.', NULL),
(124, NULL, 6, '11960039720274', 'Wahyudi Dwi Santoso, S.E.', NULL),
(125, NULL, 6, '74090552', 'Hando Wibowo, S.I.K., M.Si.', NULL),
(126, NULL, 6, '11970045990876', 'Ade David Siregar', NULL),
(127, NULL, 6, '520298', 'Mukhtar Bakhrong, S.E., M.M.', NULL),
(128, NULL, 6, '11950037830671', 'Jaelan, S.I.P.', NULL),
(129, NULL, 6, '523401', 'Erick Rofiq Nurdin', NULL),
(130, NULL, 6, '11960047801274', 'Dody Triwinarto, S.I.P.', NULL),
(131, NULL, 6, '10769/P', 'Yudi Harsono, S.T.', NULL),
(132, NULL, 7, '11364/P', 'Kunto Tjahjono, S.E.', NULL),
(133, NULL, 7, '11940027450573', 'M. Arif Suryandaru', NULL),
(134, NULL, 7, '518840', 'Videon Nugroho S, S.T.', NULL),
(135, NULL, 7, '-', 'Maxmillion Goh (Singapura)', NULL),
(136, NULL, 7, '13288/P', 'Harry Setiawan, S.E.', NULL),
(137, NULL, 7, '518852', 'Mochammad Untung Suropati, S.E.', NULL),
(138, NULL, 7, '11970057371075', 'Edwin Adrian Sumantha, S.H., PG Dipl.', NULL),
(139, NULL, 7, '11920/P', 'Bayu Alisyahbana, S.M.', NULL),
(140, NULL, 7, '11960030970572', 'Teguh Heri, S.E., M.M.', NULL),
(141, NULL, 7, '523340', 'Lilik Eko Susanto, S.E., M.M.', NULL),
(142, NULL, 7, '11970043420476', 'Jarot Suprihanto', NULL),
(143, NULL, 7, '11915/P', 'Bagus Handoko, S.H., M.Si.', NULL),
(144, NULL, 7, '11960032041072', 'Agus Soeprianto', NULL),
(145, NULL, 7, '11395/P', 'Ahmad Alfajar, S.T.', NULL),
(146, NULL, 7, '11970048050676', 'Yudi Prasetio, S.I.P.', NULL),
(147, NULL, 7, '11934/P', 'Christanto Pratomo, S.T., M.A.P.', NULL),
(148, NULL, 7, '11970054630576', 'M. Andhy Kusuma, S.Sos., M.M.', NULL),
(149, NULL, 7, '11980041500375', 'Sutrisno Pujiono, S.E., M.M.', NULL),
(150, NULL, 7, '74050394', 'Muji Ediyanto, S.H., S.I.K.', NULL),
(151, NULL, 7, '11940011500969', 'Wahyu Handoyo, S.I.P.', NULL),
(152, NULL, 7, '71030329', 'Christiyanto Goetomo, S.I.K., S.H., M.H.', NULL),
(153, NULL, 8, '12738/P', 'Didiet Hendra Wijaya, MMP.', NULL),
(154, NULL, 8, '521754', 'Nana Setiawan, S.E.', NULL),
(155, NULL, 8, '11950048230574', 'Franz Yohannes Purba, S.I.P.', NULL),
(156, NULL, 8, '523412', 'Feri Yunaldi, S.E.', NULL),
(157, NULL, 8, '11481/P', 'Arif Handono, S.A.P.', NULL),
(158, NULL, 8, '11960046811174', 'Deki Zulkarnaen, S.I.P.', NULL),
(159, NULL, 8, '523390', 'Vincentius Endy, H.P.', NULL),
(160, NULL, 8, '11470/P', 'Amir Kasman, S.E., M.M.', NULL),
(161, NULL, 8, '11960047561274', 'Asep Sukarna, S.Sos., S.I.P., M.M.', NULL),
(162, NULL, 8, '523341', 'Sidik Setiyono, S.E.', NULL),
(163, NULL, 8, '11970043340476', 'Adek Chandra Kurniawan', NULL),
(164, NULL, 8, '11412/P', 'Agung Setiawan', NULL),
(165, NULL, 8, '11970037650975', 'Iwan Setiawan, S.I.P.', NULL),
(166, NULL, 8, '11963/P', 'DR. Hery Setiyo N, S.E., M.AP.', NULL),
(167, NULL, 8, '71050218', 'Chaidir, S.H., S.I.K., M.Si., M.P.P.', NULL),
(168, NULL, 8, '11885/P', 'Anung Sutanto, S.Sos., M.Si.', NULL),
(169, NULL, 8, '11970053720575', 'Asep Rahmat Sukmana, S.I.P.', NULL),
(170, NULL, 8, '523345', 'Roni Widodo', NULL),
(171, NULL, 8, '11940023310572', 'Yudi Ruskandar, S.I.P.', NULL),
(172, NULL, 8, '11416/P', 'Budiman Marpaung, S.T., S.E.', NULL),
(173, NULL, 8, '74060705', 'Dayan Victor Imanuel Blegur, S.I.K., M.H.', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ceklis`
--

CREATE TABLE `ceklis` (
  `id_ceklis` char(5) NOT NULL,
  `nama_ceklis` varchar(100) NOT NULL,
  `tipe` enum('1','2','3','4','5') NOT NULL COMMENT '5 : perorangan\r\n\r\n1 : Penilaian produk\r\n2 : Penilaian Telegram\r\n3 : Penilaian telepon\r\n4 : Penilaian Posko'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ceklis`
--

INSERT INTO `ceklis` (`id_ceklis`, `nama_ceklis`, `tipe`) VALUES
('C1', 'CEKLIS PENILAIAN POSKO', '4'),
('C10', 'LAI ASREN', '5'),
('C11', 'LAI ASKOMLEK', '5'),
('C12', 'PENILAIAN PRODUK RENCANA WAKTU', '1'),
('C13', 'PENILAIAN PRODUK PETUNJUK PERENCANAAN AWAL ', '1'),
('C14', 'PENILAIAN PRODUK PERINTAH PERINGATAN AWAL', '1'),
('C15', 'PENILAIAN PRODUK ATP PANGLIMA', '1'),
('C16', 'PENILAIAN PRODUK ATS INTEL', '1'),
('C17', 'PENILAIAN PRODUK ATS OPS', '1'),
('C18', 'PENILAIAN PRODUK ATS PERS', '1'),
('C19', 'PENILAIAN PRODUK ATS LOG', '1'),
('C2', 'CHEKLIST PENILAIAN AKTIVITAS PANGKOGASGABPAD', '5'),
('C20', 'PENILAIAN PRODUK ATS TER', '1'),
('C21', 'PENILAIAN PRODUK ATS REN', '1'),
('C22', 'PENILAIAN PRODUK ATS KOMLEK', '1'),
('C23', 'PENILAIAN PRODUK JUKCAN', '1'),
('C24', 'PENILAIAN PERINTAH PERSIAPAN', '1'),
('C25', 'PENILAIAN PRODUK ANALISA CB PANGLIMA', '1'),
('C26', 'PENILAIAN PRODUK ANALISA CB ASINTEL', '1'),
('C27', 'PENILAIAN PRODUK ANALISA CB ASOPS', '1'),
('C28', 'CEKLIS PENILAIAN PRODUK ANALISA CB ASPERS', '1'),
('C29', 'PENILAIAN PRODUK ANALISA CB ASLOG', '1'),
('C3', 'CEKLIS PENILAIAN AKTIVITAS STAF SAHLI', '5'),
('C30', 'PENILAIAN PRODUK ANALISA CB ASTER', '1'),
('C31', 'PENILAIAN PRODUK ANALISA CB ASREN', '1'),
('C32', 'PENILAIAN PRODUK ANALISA CB ASKOMLEK', '1'),
('C33', 'PENILAIAN PRODUK KEPUTUSAN DAN KUO', '1'),
('C34', 'PENILAIAN PRODUK KONSEP RO', '1'),
('C35', 'AKTIVITAS TELEGRAM', '2'),
('C36', 'AKTIVITAS TELEPON', '3'),
('C4', 'CEKLIS PENILAIAN AKTIVITAS KEPALA STAF', '5'),
('C5', 'LAI ASINTEL', '5'),
('C6', 'LAI ASOPS', '5'),
('C7', 'LAI ASPERS', '5'),
('C8', 'LAI ASLOG', '5'),
('C9', 'LAI ASTER', '5'),
('uwu', 'uwu', '2');

-- --------------------------------------------------------

--
-- Table structure for table `detail_penilaian_kelompok`
--

CREATE TABLE `detail_penilaian_kelompok` (
  `id_detail_penilaian_kelompok` int(11) NOT NULL,
  `id_penilaian_kelompok` int(11) NOT NULL,
  `id_soal_kelompok` int(11) NOT NULL,
  `id_kelompok` int(11) NOT NULL,
  `id_ceklis` char(5) NOT NULL,
  `nilai` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_penilaian_kelompok`
--

INSERT INTO `detail_penilaian_kelompok` (`id_detail_penilaian_kelompok`, `id_penilaian_kelompok`, `id_soal_kelompok`, `id_kelompok`, `id_ceklis`, `nilai`) VALUES
(1, 1, 187, 1, 'C1', 40),
(2, 1, 188, 1, 'C1', 38),
(3, 1, 189, 1, 'C1', 30),
(4, 1, 190, 1, 'C1', 13),
(5, 1, 191, 1, 'C1', 13),
(6, 2, 1, 1, 'C12', 50),
(7, 2, 2, 1, 'C12', 15),
(8, 2, 3, 1, 'C12', 5),
(9, 2, 4, 1, 'C12', 5);

-- --------------------------------------------------------

--
-- Table structure for table `detail_penilaian_perorangan`
--

CREATE TABLE `detail_penilaian_perorangan` (
  `id_detail_penilaian_perorangan` int(11) NOT NULL,
  `id_penilaian_perorangan` int(11) NOT NULL,
  `id_soal_perorangan` int(11) NOT NULL,
  `id_anggota` int(11) NOT NULL,
  `nilai` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `kelompok`
--

CREATE TABLE `kelompok` (
  `id_kelompok` int(11) NOT NULL,
  `nama_kelompok` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelompok`
--

INSERT INTO `kelompok` (`id_kelompok`, `nama_kelompok`) VALUES
(1, 'KOGASGABPAD A'),
(2, 'KOGASGABPAD B'),
(3, 'KOGASGABPAD C'),
(4, 'KOGASGABPAD D'),
(5, 'KOGASGABPAD E'),
(6, 'KOGASGABPAD F'),
(7, 'KOGASGABPAD G'),
(8, 'KOGASGABPAD H');

-- --------------------------------------------------------

--
-- Table structure for table `pangkat`
--

CREATE TABLE `pangkat` (
  `id_pangkat` int(11) NOT NULL,
  `nama_pangkat` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pangkat`
--

INSERT INTO `pangkat` (`id_pangkat`, `nama_pangkat`) VALUES
(1, 'Kolonel Inf'),
(2, 'Kolonel Pnb'),
(3, 'Kolonel Laut (P)'),
(4, 'Kolonel Arh'),
(5, 'Kolonel Czi'),
(6, 'Kolonel Kav'),
(7, 'Kolonel Laut (E)'),
(12, 'uwu');

-- --------------------------------------------------------

--
-- Table structure for table `penilaian_kelompok`
--

CREATE TABLE `penilaian_kelompok` (
  `id_penilaian_kelompok` int(11) NOT NULL,
  `id_kelompok` int(11) NOT NULL,
  `id_ceklis` char(5) NOT NULL,
  `ket` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penilaian_kelompok`
--

INSERT INTO `penilaian_kelompok` (`id_penilaian_kelompok`, `id_kelompok`, `id_ceklis`, `ket`) VALUES
(1, 1, 'C1', '-'),
(2, 1, 'C12', '-'),
(3, 1, 'C35', ''),
(5, 2, 'C35', ''),
(6, 2, 'C36', '');

-- --------------------------------------------------------

--
-- Table structure for table `penilaian_perorangan`
--

CREATE TABLE `penilaian_perorangan` (
  `id_penilaian_perorangan` int(11) NOT NULL,
  `id_anggota` int(11) NOT NULL,
  `id_ceklis` char(5) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `soal_kelompok`
--

CREATE TABLE `soal_kelompok` (
  `id_soal_kelompok` int(11) NOT NULL,
  `maks` float NOT NULL,
  `id_ceklis` char(5) NOT NULL,
  `aspek` varchar(255) NOT NULL,
  `tipe_nilai` tinyint(4) NOT NULL,
  `is_aktif` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `soal_kelompok`
--

INSERT INTO `soal_kelompok` (`id_soal_kelompok`, `maks`, `id_ceklis`, `aspek`, `tipe_nilai`, `is_aktif`) VALUES
(1, 70, 'C12', 'Kesesuaian dengan Buku I dan IIA', 1, 1),
(2, 20, 'C12', 'Urut-urutan kegiatan sesuai Proses Biltus', 1, 1),
(3, 5, 'C12', 'Ketepatan waktu', 1, 1),
(4, 5, 'C12', 'Kerapihan', 1, 1),
(6, 10, 'C13', 'Jadwal Waktu Sementara/Awal Pelaksanaan Operasi.', 1, 1),
(7, 10, 'C13', 'Koordinasi yang harus dilakukan.', 1, 1),
(8, 15, 'C13', 'Menentukan Pergerakan Termasuk Posisi Kodal.', 1, 1),
(9, 20, 'C13', 'Tugas Tambahan bagi masing-masing Staf termasuk Informasi-informasi Khusus yang diperlukan.', 1, 1),
(10, 20, 'C13', 'Mengembangkan Rencana Waktu dengan kondisi Daerah Operasi (jika diinginkan).', 1, 1),
(11, 20, 'C13', 'Informasi tentang Persoalan-Persoalan Intelijen Lainnya dan Unsur Utama Keterangan bagi Komandan (jika diperlukan).', 1, 1),
(12, 2.5, 'C13', 'Ketepatan waktu', 1, 1),
(13, 2.5, 'C13', 'Kerapihan', 1, 1),
(14, 10, 'C14', 'Jenis Operasi.', 1, 1),
(15, 10, 'C14', 'Lokasi pelaksanaan operasi secara umum.', 1, 1),
(16, 15, 'C14', 'Jadwal waktu operasi.', 1, 1),
(17, 20, 'C14', 'Pergerakan untuk mendukung operasi.', 1, 1),
(18, 20, 'C14', 'Keperluan informasi awal yang diperlukan guna mendukung pelaksana-an operasi.', 1, 1),
(19, 20, 'C14', 'Tugas-tugas intelijen', 1, 1),
(20, 2.5, 'C14', 'Ketepatan waktu', 1, 1),
(21, 2.5, 'C14', 'Kerapihan', 1, 1),
(22, 10, 'C15', 'Analisa Direktif /Prinsiap Komando Atas', 1, 1),
(23, 15, 'C15', 'Analisa Pusat kekuatan sendiri', 1, 1),
(24, 10, 'C15', 'Analisa Praanggapan', 1, 1),
(25, 10, 'C15', 'Analisa Tugas dari aspek operasional', 1, 1),
(26, 10, 'C15', 'Analisa waktu operasi', 1, 1),
(27, 15, 'C15', 'Kemungkinan-kemungkinan CB', 1, 1),
(28, 10, 'C15', 'Struktur Susunan Tugas', 1, 1),
(29, 15, 'C15', 'Strategi operasional pasukan sendiri', 1, 1),
(30, 2.5, 'C15', 'Ketepatan waktu', 1, 1),
(31, 2.5, 'C15', 'Kerapihan', 1, 1),
(32, 15, 'C16', 'Analisa Situasi dan kondisi Daerah operasi', 1, 1),
(33, 10, 'C16', 'Analisa Praanggapan', 1, 1),
(34, 20, 'C16', 'Analisa Pusat kekuatan ancaman', 1, 1),
(35, 20, 'C16', 'Kebutuhan informasi yang diperlukan', 1, 1),
(36, 30, 'C16', 'Analisa berbagai bentuk ancaman', 1, 1),
(37, 2.5, 'C16', 'Ketepatan waktu', 1, 1),
(38, 2.5, 'C16', 'Kerapihan', 1, 1),
(39, 15, 'C17', 'Analisa pusat kekuatan sendiri.', 1, 1),
(40, 10, 'C17', 'Analisa praanggapan.', 1, 1),
(41, 15, 'C17', 'Analisa tugas dari aspek operasional.', 1, 1),
(42, 10, 'C17', 'Analisa waktu operasi.', 1, 1),
(43, 15, 'C17', 'Kemungkinan-kemungkinan CB untuk melaksanakan Tupok yang sudah dianalisa.', 1, 1),
(44, 10, 'C17', 'Saran awal tentang struktur susunan tugas (Orgas kogasgabpad & jajarannya).', 1, 1),
(45, 10, 'C17', 'Kebutuhan informasi yang diperlukan dari aspek operasi.', 1, 1),
(46, 10, 'C17', 'Strategi operasional pasukan sendiri.', 1, 1),
(47, 2.5, 'C17', 'Kerapihan ', 1, 1),
(48, 2.5, 'C18', 'Ketepatan waktu penyerahan produk', 1, 1),
(49, 15, 'C18', 'Analisa keadaan personel. ', 1, 1),
(50, 10, 'C18', 'Analisa praanggapan.', 1, 1),
(51, 15, 'C18', 'Analisa Tugas dari aspek dukungan personel.', 1, 1),
(52, 15, 'C18', 'Analisa kendala yang dihadapi dan upaya mengatasi dari aspek personel.', 1, 1),
(53, 15, 'C18', 'Analisa hambatan yang dihadapi dan bantuan yang diperlukan.', 1, 1),
(54, 10, 'C18', 'Kebutuhan informasi yang diperlukan dari aspek dukungan personil.', 1, 1),
(55, 15, 'C18', 'Strategi operasional aspek personil.', 1, 1),
(56, 2.5, 'C18', 'Kerapihan ', 1, 1),
(57, 2.5, 'C18', 'Ketepatan waktu penyerahan produk', 1, 1),
(58, 15, 'C19', 'Analisa keadaan logistik ', 1, 1),
(59, 10, 'C19', 'Analisa praanggapan.', 1, 1),
(60, 15, 'C19', 'Analisa tugas dari aspek dukungan logistik.', 1, 1),
(61, 15, 'C19', 'Analisa kendala yang dihadapi dan upaya mengatasi dari aspek logistik.', 1, 1),
(62, 15, 'C19', 'Analisa hambatan-hambatan yang dihadapi dan bantuan yang diperlukan.', 1, 1),
(63, 10, 'C19', 'Kebutuhan informasi yang diperlukan dari aspek logistik.', 1, 1),
(64, 15, 'C19', 'Strategi operasional aspek logistik', 1, 1),
(65, 2.5, 'C19', 'Kerapihan', 1, 1),
(66, 2.5, 'C19', 'Ketepatan waktu penyerahan produk', 1, 1),
(67, 15, 'C20', 'Analisa Keadaan Teritorial  ', 1, 1),
(68, 10, 'C20', 'Analisa praanggapan.', 1, 1),
(69, 15, 'C20', 'Analisa tugas dari aspek teritorial.', 1, 1),
(70, 15, 'C20', 'Analisa kendala yang dihadapi dan upaya mengatasi dari aspek teritorial.', 1, 1),
(71, 15, 'C20', 'Analisa hambatan-hambatan yang dihadapi dan bantuan yang diperlukan.', 1, 1),
(72, 10, 'C20', 'Kebutuhan informasi yang diperlukan dari aspek teritorial.', 1, 1),
(73, 15, 'C20', 'Strategi operasional aspek teritorial', 1, 1),
(74, 2.5, 'C20', 'Kerapihan ', 1, 1),
(75, 2.5, 'C20', 'Ketepatan waktu penyerahan produk', 1, 1),
(76, 15, 'C21', 'Analisa pusat kekuatan sendiri.', 1, 1),
(77, 10, 'C21', 'Analisa praanggapan.', 1, 1),
(78, 15, 'C21', 'Analisa tugas dari aspek perencanaan.', 1, 1),
(79, 10, 'C21', 'Analisa waktu perencanaan.', 1, 1),
(80, 10, 'C21', 'Kemungkinan-kemungkinan CB untuk melaksanakan Tupok yang sudah dianalisa.', 1, 1),
(81, 10, 'C21', 'Saran awal tentang struktur susunan tugas (Orgas kogasgabpad & jajarannya).', 1, 1),
(82, 10, 'C21', 'Kebutuhan informasi yang diperlukan dari aspek operasi dan aspek perencanaan', 1, 1),
(83, 15, 'C21', 'Strategi operasional pasukan sendiri.', 1, 1),
(84, 2.5, 'C21', 'Kerapihan', 1, 1),
(85, 2.5, 'C21', 'Ketepatan waktu penyerahan produk', 1, 1),
(86, 15, 'C22', 'Analisa keadaan  komunikasi dan elektronika.', 1, 1),
(87, 10, 'C22', 'Analisa praanggapan.', 1, 1),
(88, 15, 'C22', 'Analisa tugas-tugas dari aspek dukungan komlek.', 1, 1),
(89, 15, 'C22', 'Analisa kendala-kendala yang dihadapi dan upaya mengatasi dari aspek komlek.', 1, 1),
(90, 15, 'C22', 'Analisa hambatan-hambatan yang dihadapi dan bantuan yang diperlukan.', 1, 1),
(91, 10, 'C22', 'Kebutuhan informasi yang diperlukan dari aspek komlek', 1, 1),
(92, 15, 'C22', 'Strategi operasional aspek komlek.', 1, 1),
(93, 2.5, 'C22', 'Kerapihan', 1, 1),
(94, 2.5, 'C22', 'Ketepatan waktu penyerahan produk', 1, 1),
(95, 5, 'C23', 'Situasi', 1, 1),
(96, 10, 'C23', 'Tugas Pokok yang Dinyatakan Kembali', 1, 1),
(97, 10, 'C23', 'Keinginan Panglima', 1, 1),
(98, 5, 'C23', 'Kegiatan-kegiatan yang Menentukan', 1, 1),
(99, 10, 'C23', 'CB yang Dikembangkan', 1, 1),
(100, 5, 'C23', 'Pengembangan Konsep CB', 1, 1),
(101, 5, 'C23', 'Rencana Waktu', 1, 1),
(102, 5, 'C23', 'Rencana Duklog', 1, 1),
(103, 5, 'C23', 'Keperluan Info Intelijen', 1, 1),
(104, 5, 'C23', 'Rencana Operasi Pengamanan', 1, 1),
(105, 5, 'C23', 'Petunjuk Pengintaian dan Pengamatan', 1, 1),
(106, 5, 'C23', 'Resiko yang akan Dihadapi', 1, 1),
(107, 5, 'C23', 'Kerja sama Operasi yang akan Dilaksanakan', 1, 1),
(108, 5, 'C23', 'Jenis Perintah yang akan Dikeluarkan', 1, 1),
(109, 5, 'C23', 'Rencana Uji RO', 1, 1),
(110, 5, 'C23', 'Rencana Waktu (Penutup)', 1, 1),
(111, 2.5, 'C23', 'Kerapihan produk', 1, 1),
(112, 2.5, 'C23', 'Ketepatan waktu penyerahan produk', 1, 1),
(113, 10, 'C24', 'Situasi', 1, 1),
(114, 10, 'C24', 'Tugas Pokok', 1, 1),
(115, 10, 'C24', 'Keinginan Pangkogasgab (Konsep Strategi Operasional)', 1, 1),
(116, 10, 'C24', 'Organisasi Tugas', 1, 1),
(117, 10, 'C24', 'UUK/PIL', 1, 1),
(118, 10, 'C24', 'Petunjuk Resiko', 1, 1),
(119, 10, 'C24', 'Instruksi Pengamatan dan Pengintaian', 1, 1),
(120, 10, 'C24', 'Instruksi Pergerakan Awal', 1, 1),
(121, 10, 'C24', 'Tindakan Keamanan', 1, 1),
(122, 2.5, 'C24', 'Pengecekan Kesiapan Personel dan Materiil', 1, 1),
(123, 2.5, 'C24', 'Penutup', 1, 1),
(124, 2.5, 'C24', 'Ketepatan waktu', 1, 1),
(125, 2.5, 'C24', 'Kerapihan', 1, 1),
(126, 10, 'C25', 'Situasi', 1, 1),
(127, 30, 'C25', 'Cara Bertindak', 1, 1),
(128, 30, 'C25', 'Analisa alternatif CB', 1, 1),
(129, 20, 'C25', 'Kesimpulan', 1, 1),
(130, 5, 'C25', 'Kerapian produk', 1, 1),
(131, 5, 'C25', 'Ketepatan waktu penyerahan produk', 1, 1),
(132, 10, 'C26', 'Situasi', 1, 1),
(133, 30, 'C26', 'Cara Bertindak', 1, 1),
(134, 30, 'C26', 'Analisa alternatif CB', 1, 1),
(135, 30, 'C26', 'Kesimpulan', 1, 1),
(136, 5, 'C26', 'Kerapian produk', 1, 1),
(137, 5, 'C26', 'Ketepatan waktu penyerahan produk', 1, 1),
(138, 10, 'C27', 'Situasi', 1, 1),
(139, 30, 'C27', 'Cara Bertindak', 1, 1),
(140, 30, 'C27', 'Analisa alternatif CB', 1, 1),
(141, 20, 'C27', 'Kesimpulan', 1, 1),
(142, 5, 'C27', 'Kerapian produk', 1, 1),
(143, 5, 'C27', 'Ketepatan waktu penyerahan produk', 1, 1),
(144, 10, 'C28', 'Situasi', 1, 1),
(145, 30, 'C28', 'Cara Bertindak', 1, 1),
(146, 30, 'C28', 'Analisa alternatif CB', 1, 1),
(147, 20, 'C28', 'Kesimpulan', 1, 1),
(148, 5, 'C28', 'Kerapian produk', 1, 1),
(149, 5, 'C28', 'Ketepatan waktu penyerahan produ', 1, 1),
(150, 10, 'C29', 'Situasi', 1, 1),
(151, 30, 'C29', 'Cara Bertindak', 1, 1),
(152, 30, 'C29', 'Analisa alternatif CB', 1, 1),
(153, 20, 'C29', 'Kesimpulan', 1, 1),
(154, 5, 'C29', 'Kerapian produk', 1, 1),
(155, 5, 'C29', 'Ketepatan waktu penyerahan produk', 1, 1),
(156, 10, 'C30', 'Situasi', 1, 1),
(157, 30, 'C30', 'Cara Bertindak', 1, 1),
(158, 30, 'C30', 'Analisa alternatif CB', 1, 1),
(159, 20, 'C30', 'Kesimpulan', 1, 1),
(160, 5, 'C30', 'Kerapian produk', 1, 1),
(161, 5, 'C30', 'Ketepatan waktu penyerahan produk', 1, 1),
(162, 10, 'C31', 'Situasi', 1, 1),
(163, 30, 'C31', 'Cara Bertindak', 1, 1),
(164, 30, 'C31', 'Analisa alternatif CB', 1, 1),
(165, 20, 'C31', 'Kesimpulan', 1, 1),
(166, 5, 'C31', 'Kerapian produk', 1, 1),
(167, 5, 'C31', 'Ketepatan waktu penyerahan produk', 1, 1),
(168, 10, 'C32', 'Situasi', 1, 1),
(169, 30, 'C32', 'Cara Bertindak', 1, 1),
(170, 30, 'C32', 'Analisa alternatif CB', 1, 1),
(171, 20, 'C32', 'Kesimpulan', 1, 1),
(172, 5, 'C32', 'Kerapian produk', 1, 1),
(173, 5, 'C32', 'Ketepatan waktu penyerahan produk', 1, 1),
(174, 10, 'C33', 'Keputusan', 1, 1),
(175, 30, 'C33', 'Konsep Umum Operasi', 1, 1),
(176, 30, 'C33', 'Pokok-pokok Tugas yang harus dikerjakan (Satuan Bawah)', 1, 1),
(177, 20, 'C33', 'Lain-lain', 1, 1),
(178, 5, 'C33', 'Kerapian produk', 1, 1),
(179, 5, 'C33', 'Ketepatan waktu penyerahan produk', 1, 1),
(180, 15, 'C34', 'Situasi', 1, 1),
(181, 20, 'C34', 'Tugas Pokok', 1, 1),
(182, 45, 'C34', 'Pelaksanaan\r\na. Konsep operasi\r\nb. Tugas satuan-satuan manuver yang termasuk dalam susunan tugas/organisasi tugas.\r\nc.	Instruksi koordinasi.\r\n', 1, 1),
(183, 5, 'C34', 'Administrasi dan logistik', 1, 1),
(184, 5, 'C34', 'Komando kendali dan komlek', 1, 1),
(185, 5, 'C34', 'Kerapihan', 1, 1),
(186, 5, 'C34', 'Ketepatan waktu penyerahan produk', 1, 1),
(187, 40, 'C1', 'Peta  :', 4, 1),
(188, 40, 'C1', 'Peta  :\r\na.  Induk\r\nb.  Situasi\r\nc.  Operasi\r\nd.  Olah Yudha ', 4, 1),
(189, 30, 'C1', 'Recording Data', 4, 1),
(190, 15, 'C1', 'Tata ruang', 4, 1),
(191, 15, 'C1', 'Kerapihan/kreatifitas', 4, 1),
(197, 100, 'uwu', 'uwu', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `soal_perorangan`
--

CREATE TABLE `soal_perorangan` (
  `id_soal_perorangan` int(11) NOT NULL,
  `id_ceklis` char(5) NOT NULL,
  `indeks` tinyint(4) NOT NULL,
  `tindakan_macam` text NOT NULL,
  `nilmax` tinyint(4) NOT NULL,
  `is_aktif` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `soal_perorangan`
--

INSERT INTO `soal_perorangan` (`id_soal_perorangan`, `id_ceklis`, `indeks`, `tindakan_macam`, `nilmax`, `is_aktif`) VALUES
(1, 'C2', 10, 'Pangkogasgabpad menerima direktif Pang TNI, apakah melakukan kegiatan', 5, 1),
(2, 'C2', 10, 'Apakah Pangkogasgabpad memahami Direktif yang diberikan oleh Panglima TNI dan melaksanakan Analisa Tugas Pokok yang mencakup', 5, 1),
(3, 'C2', 5, 'Pada saat Briefing analisa tugas, apakah Panglima menerima paparan dari semua asisten? Membandingkan hasil analisa tugas pokok yang dilakukan sendiri oleh Panglima, selanjutnya Panglima memberi arahan kepada Staf untuk menyusun petunjuk perencanaan dan perintah persiapan.', 5, 1),
(4, 'C2', 10, 'Apakah Panglima menyampaikan petunjuk perencanaan kepada staf dan menyampaikan perintah persiapan kepada satuan bawah?', 5, 1),
(5, 'C2', 5, 'Apakah Panglima dengan staf melaksanakan proses pengembangan, analisa dan perbandingan  CB untuk menghasilkan CB terpilih?', 5, 1),
(6, 'C2', 5, 'Apakah Panglima ikut serta/mengawasi proses olah yudha yang dilaksanakan oleh staf ?', 5, 1),
(7, 'C2', 10, 'Apakah Panglima menerima paparan Kas mengenai CB terbaik, selanjutnya Panglima menentukan CB terbaik dengan membandingkan CB yang dibuat Panglima sendiri? Apakah Panglima memberi petunjuk dan memodifikasi CB apabila diperlukan serta mensimulasikannya kembali?', 5, 1),
(8, 'C2', 5, 'Apakah Pangkogasgabpad menyampaikan Keputusan dan Konsep Umum Operasi kepada para Asisten dan Unsur-unsur bawah (sat bawahan) serta unsur terkait.', 5, 1),
(9, 'C2', 5, 'Apakah Keputusan & KUO Pangkogasgabpad mencakup Keputusan, Konsep Umum Operasi, Pokok-pokok tugas yang harus dikerjakan (oleh Satwah), Lain-lain / Instruksi Koordinasi.', 5, 1),
(10, 'C2', 5, 'Apakah dalam Kep & KUO Pangkogasgabpad sudah tercantum waktu perencanaan / perintah akan dikeluarkan.', 5, 1),
(11, 'C2', 10, 'Apakah dalam Rencana Operasi yang telah dibuat lengkap dengan lampiran-lampiran sebagai berikut', 5, 1),
(12, 'C2', 5, 'Apakah Rencana Operasi yang telah dibuat selanjutnya di uji melalui TFG atau dengan metode yang lain', 5, 1),
(13, 'C2', 5, 'Apakah RO yang sudah disempurnakan dilaporkan/dipaparkan kepada Panglima TNI.', 5, 1),
(14, 'C2', 10, 'Apakah Pangkogasgabpad membuat produk tertulis berupa', 5, 1),
(15, 'C3', 10, 'Apakah Pa Sahli memberikan saran dan penjelasan yang diperlukan panglima sesuai fungsinya', 5, 1),
(16, 'C3', 10, 'Apakah Pa Sahli selalu aktif koordinasi dengan staf lain.', 5, 1),
(17, 'C3', 10, 'Apakah Pa Sahli mengerti tentang tugas pokok satuan tempat ditugaskan', 5, 1),
(18, 'C3', 10, 'Apakah Pa Sahli dapat mengembangkan petunjuk yang diberikan Panglima', 5, 1),
(19, 'C3', 10, 'Apakah Pa Sahli dapat memberikan keterangan yang bersifat teknis tentang operasi yang dilaksanakan', 5, 1),
(20, 'C3', 10, 'Apakah Pa Sahli mengikuti perkembangan situasi secara terus menerus pelaksanaan operasi yang berjalan.', 5, 1),
(21, 'C3', 10, 'Apakah Pa Sahli terampil dan aktif dalam penyelesaian tugas-tugas sesuai bidang tugasnya', 5, 1),
(22, 'C3', 10, 'Apakah Pa Sahli selalu melaporkan sesuai bidang tugasnya yang diperlukan kepada satuan Komando Atas ', 5, 1),
(23, 'C3', 10, 'Apakah Pa Sahli mengetahui dan memiliki data kemampuan kekuatan sendiri yang dibutuhkan dalam operasi oleh satuan tempat bertugas.', 5, 1),
(24, 'C3', 10, 'Apakah Pa Sahli secara aktif mengikuti dan mengetahui rangkaian kegiatan satuan tempat bertugas.', 5, 1),
(25, 'C4', 10, 'Apakah Kas mengkoordinir staf dan menyiapsiagakan staf untuk siapkan proses perencanaan dan siapkan personel yang mampu untuk melaksanakan tugas sesuai dengan Protap yang ada?', 5, 1),
(26, 'C4', 3, 'Apakah Kas membantu Panglima merumuskan tujuan, konsep operasi serta kekuatan yang akan digunakan dalam Operasi.', 5, 1),
(27, 'C4', 2, 'Apakah Kas membantu Panglima dalam melaksanakan koordinasi ke Ko Atas, samping dan bawah sesuai fungsi bidang tugasnya', 5, 1),
(28, 'C4', 10, 'Apakah Kas mengkoordinir staf dalam melakukan analisa tugas staf? Apakah Kas melaksanakan briefing staf untuk menganalisa tugas bersama staf?', 5, 1),
(29, 'C4', 3, 'Apakah Kas membantu Panglima  mempelajari situasi tentang musuh dan menentukan sasaran-sasaran strategis yang menjadi sasaran Operasi.', 5, 1),
(30, 'C4', 2, 'Apakah Kas mengikuti perkembangan situasi yang terjadi ', 5, 1),
(31, 'C4', 10, 'Apakah Kas mengkoordinir staf menyusun petunjuk perencanaan dan perintah persiapan Panglima?', 5, 1),
(32, 'C4', 5, 'Apakah Kas membantu Panglima  membagi waktu untuk keleluasaan dan kesiapan satuan / komando bawah.', 5, 1),
(33, 'C4', 10, 'Apakah Kas mengkoordinir staf dan mengecek kesiapan personel untuk menerima petunjuk perencanaan dan perintah persiapan Panglima', 5, 1),
(34, 'C4', 10, 'Apakah Kas membantu Panglima  menganalisa Cara Bertindak dan mendiskusikannya beserta Asisten dan staf khusus di atas maket / peta?', 5, 1),
(35, 'C4', 5, 'Apakah Kas mengkoordinir staf dan menyiapkan sarana dan prasarana yang diperlukan seperti Peta darat, laut dan udara untuk perbandingan CB? ', 5, 1),
(36, 'C4', 10, 'Apakah Kas membantu Panglima  menyampaikan Keputusan dan Konsep Umum Operasi kepada para Asisten dan Komandan Satgas (sat bawahan) serta unsur terkait.', 5, 1),
(37, 'C4', 5, 'Apakah Kas membantu Panglima  menentukan organisasi satuan-satuan dan kewenangan garis komando.', 5, 1),
(38, 'C4', 5, 'Apakah Kas membantu Panglima  melaksanakan koordinasi untuk mengerahkan dan mempertahankan sumber daya yang ada untuk kebutuhan Operasi.', 5, 1),
(39, 'C4', 10, 'Apakah Kas membantu dalam kesiapan kegiatan Uji RO yang dilaksanakan melalui TFG', 5, 1),
(40, 'C5', 5, 'Apakah Asintel melaksanakan analisa tugas sesuai dengan bidang tugas intelejen.', 5, 1),
(41, 'C5', 5, 'Apakah Asintel  membuat tabulasi data dan Peta Situasi.', 5, 1),
(42, 'C5', 5, 'Apakah Asintel  berusaha mencari ke-terangan – keterangan melalui Satuan Atas, Bawah dan Samping.', 5, 1),
(43, 'C5', 5, 'Apakah Asintel  memberikan Info/keterangan dan terus meyakinkan terpenuhinya kebutuhan intelejen yang memadai dan pelaporan untuk mengungkapkan ancaman / lawan segera mungkin.', 5, 1),
(44, 'C5', 10, 'Apakah Asintel  berusaha menggunakan badan-badan pengumpulan keterangan yang ada di kesatuan.', 5, 1),
(45, 'C5', 10, 'Apakah Asintel  mempersiapkan  : <br/>\r\n1)  Buku Harian. <br/>\r\n2)  Buku Kerja. <br/>\r\n3)  Peta – peta yang diperlukan.', 5, 1),
(46, 'C5', 10, 'Apakah Asintel  berpartisipasi aktif dalam staf perencanaan dalam merencanakan, mengkoordinir, mengarahkan, memadukan, dan mengontrol konsentrasi dari upaya intel tentang kepentingan ancaman/lawan yang tepat waktu serta tepat sasaran.', 5, 1),
(47, 'C5', 10, 'Apakah Asintel  berusaha memberikan ke-terangan–keterangan yang diperlukan oleh Pa Staf lain dalam rangka keberhasilan tugas.', 5, 1),
(48, 'C5', 5, 'Apakah Asintel  memperhatikan Minu Staf Duty dalam membuat Produk Staf.', 5, 1),
(49, 'C5', 5, 'Apakah Asintel dapat memberikan saran berupa Analisa Intelijen tepat pada waktu yang telah ditentukan.', 5, 1),
(50, 'C5', 5, 'Apakah Asintel mengikuti perkembangan secara terus menerus dan memberikan masukan kepada Panglima dalam menghadapi situasi kritis.', 5, 1),
(51, 'C5', 5, 'Apakah Asintel loyal kepada keputusan Pang.', 5, 1),
(52, 'C5', 5, 'Apakah Asintel memberikan keterangan ancaman/lawan pada Staf Ops dalam rangka membuat RO.', 5, 1),
(53, 'C5', 5, 'Apakah Asintel ikut aktif mengawasi pelaksanaan perintah oleh satuan bawah.', 5, 1),
(54, 'C5', 10, 'Apakah Asintel membuat produk lainnya berupa :', 5, 1),
(55, 'C6', 5, 'Apakah Asops  mempersiapkan buku harian, lembaran kerja dan Peta Ops.', 5, 1),
(56, 'C6', 5, 'Apakah  Asops  memberikan keterangan-keterangan yang diperlukan Panglima untuk menganalisa tugas.', 5, 1),
(57, 'C6', 5, 'Apakah Asops  memberikan saran-saran yang diperlukan sewaktu Pang memberikan Briefing.', 5, 1),
(58, 'C6', 5, 'Apakah Asops memberikan keterangan yang diperlukan dari  :\r\na. Satuan Atas.\r\nb. Satuan Samping. \r\nc. Satuan Bawah.', 5, 1),
(59, 'C6', 5, 'Apakah Asops mengadakan koordinasi dengan Pa Staf lainnya guna mencari keterangan yang diperlukan.', 5, 1),
(60, 'C6', 5, 'Apakah Asops  mengerjakan dan berusaha untuk mengerti atas Jukcan yang diberikan Panglima.', 5, 1),
(61, 'C6', 5, 'Apakah Asops berusaha berkoordinasi dengan staf lain sebelum memulai membuat saran Staf.', 5, 1),
(62, 'C6', 5, 'Apakah Asops  berusaha memberikan keterangan-keterangan Taktis sebelum Panglima memberikan Jukcan.', 5, 1),
(63, 'C5', 5, 'Apakah Asops  memberikan perintah persiapan dan peringatan kepada satuan jajarannya sesuai keinginan Panglima', 5, 1),
(64, 'C6', 5, 'Apakah Asops menyiapkan dan menyampaikan Cara Bertindak sesuai keinginan dari Kogasgabpad ', 5, 1),
(65, 'C6', 5, 'Apakah Asops dapat menyelesaikan dan menyampaikan saran staf bidang operasi tepat pada waktunya.', 5, 1),
(66, 'C6', 5, 'Apakah Asops terampil dalam menangani masalah – masalah Operasi yang bersangkutan dengan fungsinya.', 5, 1),
(67, 'C6', 5, 'Apakah Asops menyiapkan dan menyelesaikan Kep dan KUO sesuai dengan keinginan Panglima.', 5, 1),
(68, 'C6', 10, 'Apakah Asops koordinasi dengan Pa Staf lainnya didalam menyelesaikan Konsep Rencana Operasi.', 5, 1),
(69, 'C6', 5, 'Apakah Asops menyiapkan dan menyelesaikan Rencana Operasi beserta lampirannya  tepat pada waktunya.', 5, 1),
(70, 'C6', 5, 'Apakah Asops mengikuti perkembangan situasi sesuai jajarannya saat perencanaan.', 5, 1),
(71, 'C6', 3, 'Apakah Asops ikut mengawasi pelaksanaan perintah Panglima oleh Satuan-satuan bawah.', 5, 1),
(72, 'C6', 2, 'Apakah Asops  mempersiapkan Peta Operasi.', 5, 1),
(73, 'C6', 3, 'Apakah Asops mengeplot semua peristiwa Operasi pada Peta Operasi.', 5, 1),
(74, 'C6', 5, 'Apakah Asop membuat produk lampiran :\r\n    a. ATS\r\n    b. Prinsiap, pringat\r\n    c. Jukcan Panglima\r\n    d. Saran staf bidang operasi\r\n    e. Keputusan dan konsep operasi\r\n    f. Rencana Operasi beserta lampirannya:\r\n        1) Susunan tugas\r\n        2) Peta operasi \r\n        3) Rencana Rule of Engangement\r\n        4) Lain-lain sesuai kebutuhan', 5, 1),
(75, 'C6', 2, 'Apakah Asops  memasukkan berita-berita yang masuk pada Buku Harian atau Lembaran Kerja Staf.', 5, 1),
(76, 'C6', 2, 'Apakah Asops  membuat/menyiapkan alat-alat pertolongan/miniatur untuk mempermudah Pengendalian Operasi.', 5, 1),
(77, 'C6', 3, 'Apakah Asops  menentukan letak umum untuk Posko Kogasgabpad.', 5, 1),
(78, 'C7', 5, 'Apakah  Aspers  menganalisa tugas sesuai dengan fungsinya', 5, 1),
(79, 'C7', 5, 'Apakah Aspers mempersiapkan dan mencatat semua berita yang diterima, dan memasukkan pada buku harian, lembaran kerja dan blangko-blangko administrasi buku jurnal.', 5, 1),
(80, 'C7', 5, 'Apakah Aspers  menyampaikan berita tersebut  :\r\na. Semuanya pada Panglima.\r\nb. Pada alamat masing-masing.', 5, 1),
(81, 'C7', 5, 'Apakah Aspers berpartisipasi sejak awal dalam proses perencanaan dan pengambilan keputusan', 5, 1),
(82, 'C7', 5, 'Apakah Aspers mencari keterangan dengan  :\r\na. Satuan Atas.\r\nb. Satuan Samping. \r\nc. Satuan Bawah.', 5, 1),
(83, 'C7', 5, 'Apakah Aspers mendata kekuatan personel dari satuan induk dan satuan-satuan yang membantu dan melaporkan keadaan/ kebutuhan personel kepada panglima.', 5, 1),
(84, 'C7', 5, 'Apakah Aspers berusaha mengerti terhadap Jukcan Panglima.', 5, 1),
(85, 'C7', 5, 'Apakah Aspers dapat mengembangkan Jukcan Panglima yang bersangkutan dengan bidang tugasnya.', 5, 1),
(86, 'C7', 5, 'Apakah Aspers merencanakan dan menyiapkan tenaga pengganti.', 5, 1),
(87, 'C7', 5, 'Apakah Aspers mencatat mengadakan koordinasi dengan Staf lainnya sebelum membuat Analisa staf Personel .', 5, 1),
(88, 'C7', 5, 'Apakah Aspers berusaha memberikan keterangan-keterangan tentang keadaan personel kepada Staf lainnya.', 5, 1),
(89, 'C7', 5, 'Apakah Aspers dapat mengembangkan petunjuk-petunjuk Panglima yang berkaitan dengan bidangnya.', 5, 1),
(90, 'C7', 5, 'Apakah Aspers dapat menyampaikan saran berupa Analisa Personel sesuai bidang personel tepat pada waktunya yang telah ditentukan oleh Panglima.', 5, 1),
(91, 'C7', 5, 'Apakah Aspers berusaha memberikan saran-saran yang diperlukan Panglima dalam mengambil keputusan dan menyusun KUO.', 5, 1),
(92, 'C7', 5, 'Apakah Aspers membantu untuk melengkapi RO', 5, 1),
(93, 'C7', 5, 'Apakah Aspers ikut mengawasi pelaksanaan perintah Panglima oleh satuan bawah.', 5, 1),
(94, 'C7', 5, 'Apakah Aspers dapat mengatasi semua  persoalan (operasi) yang  menyangkut dengan bidang tugasnya.', 5, 1),
(95, 'C7', 5, 'Apakah Aspers menentukan letak pasti kedudukan Mako.', 5, 1),
(96, 'C7', 5, 'Apakah Aspers menentukan prosedur penataan dan penggunaan pekerja sipil setempat.', 5, 1),
(97, 'C7', 5, 'Apakah Aspers membuat membuat produk berupa :\r\n    a. ATS\r\n    b. Analisa CB Staf Personel\r\n    c. Lampiran perencanaan dukungan personel', 5, 1),
(98, 'C8', 5, 'Apakah Aslog  menganalisa tugas sesuai fungsi bidang tugasnya', 5, 1),
(99, 'C8', 5, 'Apakah Aslog mempersiapkan dan mencatat semua berita sesuai bidangnya pada buku harian, lembar kerja dan mengolah data berita tersebut.', 5, 1),
(100, 'C8', 5, 'Apakah Aslog mencari keterangan dari :\r\na. Satuan  Atas.\r\nb. Satuan Samping.\r\nc. Satuan Bawah.', 5, 1),
(101, 'C8', 5, 'Apakah Aslog memberi saran kepada Panglima tentang kemampuan dukungan dibidang logistik yang dapat mempengauhi CB/pelaksanan tugas pokok Kogasgabpad.', 5, 1),
(102, 'C8', 5, 'Apakah Aslog mengikuti perkembangan keadaan logistik di satuannya.', 5, 1),
(103, 'C8', 5, 'Apakah Aslog berusaha mengerti akan  isi Jukcan Panglima.', 5, 1),
(104, 'C8', 5, 'Apakah Aslog dapat mengembangkan Jukcan Panglima sesuai bidang tugasnya.', 5, 1),
(105, 'C8', 5, 'Apakah Aslog mengadakan koordinasi dengan Staf lainnya sebelum membuat Analisa.', 5, 1),
(106, 'C8', 5, 'Apakah Aslog berusaha memberikan keterangan tentang logistik kepada Staf lainnya.', 5, 1),
(107, 'C8', 5, 'Apakah Aslog dapat menyampaikan saran kepada Panglima tepat pada waktunya.', 5, 1),
(108, 'C8', 10, 'Apakah Aslog membantu Staf Ops membuat lampiran rencana bantuan logistik (Rencana pelayanan logistik operasi) beserta Sub lampirannya ', 5, 1),
(109, 'C8', 5, 'Apakah Aslog merawat dan membekali pasukan yang terlibat operasi, sehingga menjamin keberhasilan pelaksanaan tugas sesuai tugas pokok', 5, 1),
(110, 'C8', 5, 'Apakah Aslog mengkoordinasikan semua fungsi logistik dan ketentuan-ketentuan, bantuan logistik dan pertahankan seluruh aset yang dimiliki', 5, 1),
(111, 'C8', 5, 'Apakah Aslog memformulasikan dan menentukan ketentuan-ketentuan tentang logistik yang berkelanjutan untuk perencanaan dan pelaksanan kebijakan logistik Kogasgabpad', 5, 1),
(112, 'C8', 5, 'Apakah Aslog mengembangkan lampiran logistik pada RO', 5, 1),
(113, 'C8', 5, 'Apakah Aslog mengkoordinasikan secara umum dengan satuan penyiap logistik, satuan tugas yang menyokong dukungan logistik, bantuan pembekalan sesuai dengan perintah penugasan dalam lampiran (Logistik pada RO)', 5, 1),
(114, 'C8', 5, 'Apakah Aslog mengkoordinasikan bantuan dan pembekalan angkatan, pengadaan dan pengendalian setempat (lokal) dan mengalokasikan fasilitas daerah setempat serta sumbangan daerah logistik yang dapat digunakan di daerah persiapan di wilayah ', 5, 1),
(115, 'C8', 10, 'Apakah Aslog membuat produk tertulis berupa:\r\n    a. ATS\r\n    b. Analisa CB Staf logistik.\r\n    c. Rencana bantuan logistik (Rencana dukungan pelayanan logistik operasi)\r\n    d. Sub lampiran matrik dukungan pelayanan logistik operasi\r\n    e. Sub lampiran peta dukungan pelayanan operasi\r\n    f. Sub lampiran rencana dukungan bantuan logistik kewilayahan', 5, 1),
(116, 'C9', 10, 'Apakah Aster melaksanakan tugas pokok sesuai dengan fungsi tugas teritorial.', 5, 1),
(117, 'C9', 5, 'Apakah Aster membantu panglima dalam pembinaan pertimbangan aspek teritorial yang berkaitan dalam pelaksanaan operasi', 5, 1),
(118, 'C9', 5, 'Apakah Aster memahami saran dan masukan kepada Panglima berkaitan dengan pembinaan yang terjadi dari faktor Ipoleksosbud yang dapat mempengaruhi keberhasilan tugas ', 5, 1),
(119, 'C9', 10, 'Apakah Aster membuat Data KBA, Geografi, Demografi, Politik, Tokoh – Tokoh Formal dan Informal.', 5, 1),
(120, 'C9', 5, 'Apakah Aster membuat Peta Geografi, Demografi dan politik.', 5, 1),
(121, 'C9', 5, 'Apakah Aster berusaha mencari data dan brosur-brosur tentang Teritorial kepada Satuan Atas maupun Kowil.', 5, 1),
(122, 'C9', 5, 'Apakah Aster berusaha menggunakan badan-badan pengumpul keterangan yang ada di kesatuan.', 5, 1),
(123, 'C9', 10, 'Apakah Aster mempersiapkan:\r\na. Buku Harian\r\nb. Lembaran Kerja\r\nc. Peta – peta yang diperlukan.', 5, 1),
(124, 'C9', 5, 'Apakah Aster mengelola keterangan yang diterima untuk kepentingan Panglima.', 5, 1),
(125, 'C9', 5, 'Apakah Aster berusaha memberikan keterangan yang diperlukan oleh Pa Staf lain untuk keberhasilan tugas.', 5, 1),
(126, 'C9', 5, 'Apakah Aster  bekerja sama dengan aparat terkait untuk memanfaatkan wilayah baik SDM,SDA maupun sumber daya penting lainya guna keberhasilan tugas.', 5, 1),
(127, 'C9', 5, 'Apakah Aster memberikan saran tepat pada waktu yang telah ditentukan.', 5, 1),
(128, 'C9', 5, 'Apakah Aster mengikuti perkembangan secara  terus menerus dan memberikannya kepada Panglima dalam menghadapi situasi kritis.', 5, 1),
(129, 'C9', 5, 'Apakah Aster menganalisa kemungkinan ancaman dibidang teritorial di wilayah operasi yang diperkirakan akan mempengaruhi pelaksanaan tugas pokok.', 5, 1),
(130, 'C9', 5, 'Apakah Aster memberikan keterangan bidang teritorial pada Staf Ops dalam rangka membuat RO.', 5, 1),
(131, 'C9', 5, 'Apakah Aster membuat produk tertulis berupa:\r\n    a. ATS\r\n    b. Analisa CB Staf teritorial.\r\n    c. Rencana bantuan teritorial.', 5, 1),
(132, 'C9', 5, 'Apakah Aster ikut aktif mengawasi pelaksanaan perintah Panglima oleh Satwah.', 5, 1),
(133, 'C10', 10, 'Apakah Asren  menganalisa tugas sesuai bidang tugasnya.', 5, 1),
(134, 'C10', 5, 'Apakah Asren menyiapkan dan mengkoordinasikan kebutuhan RO  untuk mendukung tugas Kogasgabpad.', 5, 1),
(135, 'C10', 10, 'Apakah Asren menyiapkan RO sebagai dasar kegiatan untuk mendukung operasi di masa datang .', 5, 1),
(136, 'C10', 5, 'Apakah Asren merencanakan kebutuhan dan kesiapan kekuatan dan mengkoordinasikan rencana penggelaran sesuai CB terpilih.', 5, 1),
(137, 'C10', 5, 'Apakah Asren melaksanakan koordinasi dan mengkaji masukan bagi perencanaan waktu penggelaran.', 5, 1),
(138, 'C10', 5, 'Apakah Asren berkoordinasi dengan staf personel  untuk memastikan tindakan militer dan politik sejalan dengan pandangan strategi dan politik nasional.', 5, 1),
(139, 'C10', 5, 'Apakah Asren ikut berpartisipasi dalam pengembangan Rule Of Engagemen (ROE).', 5, 1),
(140, 'C10', 10, 'Apakah Asren membuat parameter untuk Operasi yang sedang berlangsung. ', 5, 1),
(141, 'C10', 5, 'Apakah Asren menetapkan waktu pengambilan keputusan untuk memberi peluang lebih luas bagi pelaksanaan RO.', 5, 1),
(142, 'C10', 10, 'Apakah Asren mengantisipasi situasi taktis dan operasional  yang menguntungkan, resiko dan saran untuk mendukung Rencana Pelibatan (ROE).', 5, 1),
(143, 'C10', 5, 'Apakah Asren melaksanakan sinkronisasi seluruh kekuatan untuk mendukung setiap CB terpilih.', 5, 1),
(144, 'C10', 5, 'Apakah Asren memperhatikan dengan seksama hubungan komando dengan Komando Atasan, Komando Bawahan ataupun Komando yang setingkat.', 5, 1),
(145, 'C10', 10, 'Apakah Asren merencanakan dan menentukan tugas khusus serta menentukan  wilayah operasi.', 5, 1),
(146, 'C10', 10, 'Apakah Asren membuat produk tertuis berupa:\r\n    a. ATS.\r\n    b. Analisa CB Asren\r\n    c. Renbut kuat.\r\n    d. Renbut Ops.', 5, 1),
(147, 'C11', 5, 'Apakah Askomlek  menganalisa tugas sesuai fungsi bidang tugasnya', 5, 1),
(148, 'C11', 5, 'Apakah Askomlek mempersiapkan dan mencatat semua berita sesuai bidangnya pada buku harian, lembar kerja dan mengolah data berita tersebut.', 5, 1),
(149, 'C11', 5, 'Apakah Askomlek mencari keterangan dari :\r\na. Satuan  Atas.\r\nb. Satuan Samping.\r\nc. Satuan Bawah.', 5, 1),
(150, 'C11', 5, 'Apakah Askomlek memberi saran kepada Panglima tentang kemampuan dukungan dibidang komlek yang dapat mempengauhi CB / pelaksanan tugas Kogasgabpad.', 5, 1),
(151, 'C11', 5, 'Apakah Askomlek mengikuti perkembangan keadaan komlek di satuannya.', 5, 1),
(152, 'C11', 5, 'Apakah Askomlek berusaha mengerti akan  isi Jukcan Panglima.', 5, 1),
(153, 'C11', 5, 'Apakah Askomlek dapat mengembangkan Jukcan Panglima sesuai bidang tugasnya', 5, 1),
(154, 'C11', 5, 'Apakah Askomlek mengadakan koordinasi dengan Staf lainnya sebelum membuat ATS', 5, 1),
(155, 'C11', 5, 'Apakah Askomlek berusaha memberikan keterangan tentang komlek kepada Staf lainnya.', 5, 1),
(156, 'C11', 5, 'Apakah Askomlek dapat menyampaikan saran kepada Panglima tepat pada waktunya.', 5, 1),
(157, 'C11', 10, 'Apakah Askomlek membantu Staf Ops membuat lampiran rencana komlek, serta Sub lampirannya ', 5, 1),
(158, 'C11', 5, 'Apakah Askomlek merawat dan membekali pasukan sehingga menjamin kemungkinan unsur kekuatan manuver secara leluasa melaksanakan konsepsi pelaksanaan tupoknya.', 5, 1),
(159, 'C11', 5, 'Apakah Askomlek mengkoordinasikan semua fungsi komlek dan ketentuan-ketentuan komlek dan pertahankan seluruh aset yang dimiliki', 5, 1),
(160, 'C11', 5, 'Apakah Askomlek memformulasikan dan menentukan ketentuan-ketentuan tentang komlek yang berkelanjutan untuk perencanaan dan pelaksanan kebijakan komlek Kogasgabpad.', 5, 1),
(161, 'C11', 5, 'Apakah Askomlek mengembangkan lampiran komlek pada RO ', 5, 1),
(162, 'C11', 5, 'Apakah Askomlek mengkoordinasikan secara umum dengan satuan penyiap komlek, satuan tugas yang menyokong dukungan komlek, bantuan pembekalan sesuai dengan perintah penugasan dalam lampiran (Komlek pada RO)', 5, 1),
(163, 'C11', 5, 'Apakah Askomlek mengkoordinasikan bantuan dan pembekalan angkatan, pengadaan dan pengendalian setempat (lokal) dan mengalokasikan fasilitas daerah setempat. ', 5, 1),
(164, 'C11', 10, 'Apakah Askomlek membuat produk tertulis berupa:\r\n    a. ATS\r\n    b. Analisa CB Staf Komlek\r\n    c. Rencana Komlek (Rencana Komlek)\r\n    d. Sub lampiran matrik dukungan pelayanan Komlek', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `username` char(50) NOT NULL,
  `password` char(50) NOT NULL,
  `level` enum('1','2','3','4') NOT NULL,
  `akses` text NOT NULL,
  `akses_kelompok` text NOT NULL,
  `id_anggota` int(11) DEFAULT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `username`, `password`, `level`, `akses`, `akses_kelompok`, `id_anggota`, `status`) VALUES
(1, 'Sekretaris', 'sekretaris', '67ccb39f0ec81c363d058774c2a1598d', '2', '', '2', NULL, '1'),
(2, 'Kolat', 'kolat', '67ccb39f0ec81c363d058774c2a1598d', '2', '[{\"value\":\"1\"},{\"value\":\"2\"},{\"value\":\"3\"}]', '[{\"value\":\"KOGASGABPAD A\"}]', NULL, '1'),
(3, 'Ruangan', 'ruangan', '67ccb39f0ec81c363d058774c2a1598d', '2', '[{\"value\":\"4\"}]', '[{\"value\":\"KOGASGABPAD A\"}]', NULL, '1'),
(11, 'admin', 'admin', '580097c0183509887837571145ccc3ad', '1', '', '', NULL, '1'),
(12, 'Dany Rakca Andalasawan, S.A.P.', '1920031270470', '67ccb39f0ec81c363d058774c2a1598d', '2', '[{\"value\":\"4\"}]', '[{\"value\":\"KOGASGABPAD A\"}]', NULL, '1'),
(13, 'Binsar P. Nainggolan, S.E.', '11452/P', '67ccb39f0ec81c363d058774c2a1598d', '2', '[{\"value\":\"4\"}]', '[{\"value\":\"KOGASGABPAD A\"}]', NULL, '1'),
(14, 'Wawan Tjahjono, S.H., M.M.', '32718', '67ccb39f0ec81c363d058774c2a1598d', '2', '[{\"value\":\"4\"}]', '[{\"value\":\"KOGASGABPAD B\"}]', NULL, '1'),
(15, 'Elistar Silaen, S.T.', '520254', '67ccb39f0ec81c363d058774c2a1598d', '2', '[{\"value\":\"4\"}]', '[{\"value\":\"KOGASGABPAD B\"}]', NULL, '1'),
(16, 'I.B.K. Swagata P, S.T.', '510418', '67ccb39f0ec81c363d058774c2a1598d', '2', '[{\"value\":\"4\"}]', '[{\"value\":\"KOGASGABPAD C\"}]', NULL, '1'),
(17, 'Wahyu Eko Purnomo', '11930085860670', '67ccb39f0ec81c363d058774c2a1598d', '2', '[{\"value\":\"4\"}]', '[{\"value\":\"KOGASGABPAD C\"}]', NULL, '1'),
(18, 'Hari Rahardjanto, S.Sos.', '1930082060671', '67ccb39f0ec81c363d058774c2a1598d', '2', '[{\"value\":\"4\"}]', '[{\"value\":\"KOGASGABPAD D\"}]', NULL, '1'),
(19, 'Bonifasius G. Andjioe, S.T., M.A.P.', '10759/P', '67ccb39f0ec81c363d058774c2a1598d', '2', '[{\"value\":\"4\"}]', '[{\"value\":\"KOGASGABPAD D\"}]', NULL, '1'),
(20, 'Sumantri', '10791/P', '67ccb39f0ec81c363d058774c2a1598d', '2', '[{\"value\":\"4\"}]', '[{\"value\":\"KOGASGABPAD E\"}]', NULL, '1'),
(21, 'Djonne Ricky Lumintang, S.Sos.', '11940017620471', '67ccb39f0ec81c363d058774c2a1598d', '2', '[{\"value\":\"4\"}]', '[{\"value\":\"KOGASGABPAD E\"}]', NULL, '1'),
(22, 'Imam Suyudi', '9277/P', '67ccb39f0ec81c363d058774c2a1598d', '2', '[{\"value\":\"4\"}]', '[{\"value\":\"KOGASGABPAD F\"}]', NULL, '1'),
(23, 'Antoninho Rangel Dasilva, S.I.P.', '1920024670668', '67ccb39f0ec81c363d058774c2a1598d', '2', '[{\"value\":\"4\"}]', '[{\"value\":\"KOGASGABPAD F\"}]', NULL, '1'),
(24, 'Eriyawan, S.E.', ' 9620/P', '67ccb39f0ec81c363d058774c2a1598d', '2', '[{\"value\":\"4\"}]', '[{\"value\":\"KOGASGABPAD G\"}]', NULL, '1'),
(25, 'Hendro Arif H, S.Sos.', '520303', '67ccb39f0ec81c363d058774c2a1598d', '2', '[{\"value\":\"4\"}]', '[{\"value\":\"KOGASGABPAD G\"}]', NULL, '1'),
(26, 'Bambang Eko Pratolo, S.E., M.Tr (Han)', '32776', '67ccb39f0ec81c363d058774c2a1598d', '2', '[{\"value\":\"4\"}]', '[{\"value\":\"KOGASGABPAD H\"}]', NULL, '1'),
(27, 'Wahyu Endriawan, S.H., M.H.', '11899/P', '67ccb39f0ec81c363d058774c2a1598d', '2', '[{\"value\":\"4\"}]', '[{\"value\":\"KOGASGABPAD H\"}]', NULL, '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aktivitas`
--
ALTER TABLE `aktivitas`
  ADD PRIMARY KEY (`id_aktivitas`),
  ADD KEY `id_kelompok` (`id_kelompok`),
  ADD KEY `id_kelompok_2` (`id_kelompok`),
  ADD KEY `id_ceklis` (`id_ceklis`);

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id_anggota`),
  ADD KEY `id_pangkat` (`id_pangkat`),
  ADD KEY `id_kelompok` (`id_kelompok`);

--
-- Indexes for table `ceklis`
--
ALTER TABLE `ceklis`
  ADD PRIMARY KEY (`id_ceklis`),
  ADD UNIQUE KEY `id_ceklis` (`id_ceklis`);

--
-- Indexes for table `detail_penilaian_kelompok`
--
ALTER TABLE `detail_penilaian_kelompok`
  ADD PRIMARY KEY (`id_detail_penilaian_kelompok`),
  ADD KEY `id_penilaian_kelompok` (`id_penilaian_kelompok`),
  ADD KEY `id_soal_kelompok` (`id_soal_kelompok`),
  ADD KEY `id_kelompok` (`id_kelompok`),
  ADD KEY `id_ceklis` (`id_ceklis`);

--
-- Indexes for table `detail_penilaian_perorangan`
--
ALTER TABLE `detail_penilaian_perorangan`
  ADD PRIMARY KEY (`id_detail_penilaian_perorangan`),
  ADD KEY `id_penilaian_perorangan` (`id_penilaian_perorangan`),
  ADD KEY `id_soal_perorangan` (`id_soal_perorangan`),
  ADD KEY `id_anggota` (`id_anggota`);

--
-- Indexes for table `kelompok`
--
ALTER TABLE `kelompok`
  ADD PRIMARY KEY (`id_kelompok`);

--
-- Indexes for table `pangkat`
--
ALTER TABLE `pangkat`
  ADD PRIMARY KEY (`id_pangkat`);

--
-- Indexes for table `penilaian_kelompok`
--
ALTER TABLE `penilaian_kelompok`
  ADD PRIMARY KEY (`id_penilaian_kelompok`),
  ADD KEY `id_kelompok` (`id_kelompok`),
  ADD KEY `id_ceklis` (`id_ceklis`);

--
-- Indexes for table `penilaian_perorangan`
--
ALTER TABLE `penilaian_perorangan`
  ADD PRIMARY KEY (`id_penilaian_perorangan`),
  ADD KEY `id_anggota` (`id_anggota`),
  ADD KEY `id_ceklis` (`id_ceklis`);

--
-- Indexes for table `soal_kelompok`
--
ALTER TABLE `soal_kelompok`
  ADD PRIMARY KEY (`id_soal_kelompok`),
  ADD KEY `id_ceklis` (`id_ceklis`);

--
-- Indexes for table `soal_perorangan`
--
ALTER TABLE `soal_perorangan`
  ADD PRIMARY KEY (`id_soal_perorangan`),
  ADD KEY `id_ceklis` (`id_ceklis`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aktivitas`
--
ALTER TABLE `aktivitas`
  MODIFY `id_aktivitas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=174;

--
-- AUTO_INCREMENT for table `detail_penilaian_kelompok`
--
ALTER TABLE `detail_penilaian_kelompok`
  MODIFY `id_detail_penilaian_kelompok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `detail_penilaian_perorangan`
--
ALTER TABLE `detail_penilaian_perorangan`
  MODIFY `id_detail_penilaian_perorangan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kelompok`
--
ALTER TABLE `kelompok`
  MODIFY `id_kelompok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pangkat`
--
ALTER TABLE `pangkat`
  MODIFY `id_pangkat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `penilaian_kelompok`
--
ALTER TABLE `penilaian_kelompok`
  MODIFY `id_penilaian_kelompok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `penilaian_perorangan`
--
ALTER TABLE `penilaian_perorangan`
  MODIFY `id_penilaian_perorangan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `soal_kelompok`
--
ALTER TABLE `soal_kelompok`
  MODIFY `id_soal_kelompok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=198;

--
-- AUTO_INCREMENT for table `soal_perorangan`
--
ALTER TABLE `soal_perorangan`
  MODIFY `id_soal_perorangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aktivitas`
--
ALTER TABLE `aktivitas`
  ADD CONSTRAINT `aktivitas_ibfk_1` FOREIGN KEY (`id_ceklis`) REFERENCES `ceklis` (`id_ceklis`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `aktivitas_ibfk_2` FOREIGN KEY (`id_kelompok`) REFERENCES `kelompok` (`id_kelompok`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `anggota`
--
ALTER TABLE `anggota`
  ADD CONSTRAINT `ANGGOTA_ibfk_1` FOREIGN KEY (`id_pangkat`) REFERENCES `pangkat` (`id_pangkat`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ANGGOTA_ibfk_2` FOREIGN KEY (`id_kelompok`) REFERENCES `kelompok` (`id_kelompok`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_penilaian_kelompok`
--
ALTER TABLE `detail_penilaian_kelompok`
  ADD CONSTRAINT `DETAIL_CEKLIS` FOREIGN KEY (`id_ceklis`) REFERENCES `ceklis` (`id_ceklis`),
  ADD CONSTRAINT `DETAIL_KELOMPOK` FOREIGN KEY (`id_kelompok`) REFERENCES `kelompok` (`id_kelompok`),
  ADD CONSTRAINT `DETAIL_PENILAIAN_KELOMPOK_ibfk_1` FOREIGN KEY (`id_penilaian_kelompok`) REFERENCES `penilaian_kelompok` (`id_penilaian_kelompok`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `DETAIL_PENILAIAN_KELOMPOK_ibfk_2` FOREIGN KEY (`id_soal_kelompok`) REFERENCES `soal_kelompok` (`id_soal_kelompok`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_penilaian_perorangan`
--
ALTER TABLE `detail_penilaian_perorangan`
  ADD CONSTRAINT `DETAIL_PENILAIAN_PERORANGAN_ibfk_2` FOREIGN KEY (`id_soal_perorangan`) REFERENCES `soal_perorangan` (`id_soal_perorangan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `DETAIL_PENILAIAN_PERORANGAN_ibfk_3` FOREIGN KEY (`id_penilaian_perorangan`) REFERENCES `penilaian_perorangan` (`id_penilaian_perorangan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penilaian_kelompok`
--
ALTER TABLE `penilaian_kelompok`
  ADD CONSTRAINT `PENILAIAN_KELOMPOK_ibfk_1` FOREIGN KEY (`id_kelompok`) REFERENCES `kelompok` (`id_kelompok`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `PENILAIAN_KELOMPOK_ibfk_2` FOREIGN KEY (`id_ceklis`) REFERENCES `ceklis` (`id_ceklis`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penilaian_perorangan`
--
ALTER TABLE `penilaian_perorangan`
  ADD CONSTRAINT `PENILAIAN_PERORANGAN_ibfk_2` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `PENILAIAN_PERORANGAN_ibfk_4` FOREIGN KEY (`id_ceklis`) REFERENCES `ceklis` (`id_ceklis`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `soal_kelompok`
--
ALTER TABLE `soal_kelompok`
  ADD CONSTRAINT `SOAL_KELOMPOK_ibfk_1` FOREIGN KEY (`id_ceklis`) REFERENCES `ceklis` (`id_ceklis`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `soal_perorangan`
--
ALTER TABLE `soal_perorangan`
  ADD CONSTRAINT `SOAL_PERORANGAN_ibfk_1` FOREIGN KEY (`id_ceklis`) REFERENCES `ceklis` (`id_ceklis`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
