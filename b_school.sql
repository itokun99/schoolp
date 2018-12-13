-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2018 at 07:09 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.0.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `school_master`
--

-- --------------------------------------------------------

--
-- Table structure for table `b_school`
--

CREATE TABLE `b_school` (
  `schoolid` int(11) NOT NULL,
  `school_code` varchar(10) COLLATE latin1_general_ci NOT NULL,
  `school_name` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `school_quez` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `school_email` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `school_phone` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `school_address` text COLLATE latin1_general_ci NOT NULL,
  `school_contact` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `school_publish` tinyint(4) NOT NULL,
  `picture` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `datez` datetime NOT NULL,
  `member_id` int(11) NOT NULL,
  `lastupdate` datetime NOT NULL,
  `school_dbase` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `lesson_hour` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `b_school`
--

INSERT INTO `b_school` (`schoolid`, `school_code`, `school_name`, `school_quez`, `school_email`, `school_phone`, `school_address`, `school_contact`, `school_publish`, `picture`, `datez`, `member_id`, `lastupdate`, `school_dbase`, `lesson_hour`) VALUES
(1, 'BPK01', 'BPK Penabur Jakarta', 'lpfVtbDSYs1MsYK50VELd34hbAQBuc', 'bpk-penabur@gmail.com', '(021) 5666965 ', 'Jl. Pluit Karang Molek II No.4, RT.1/RW.8, Pluit, Penjaringan, Kota Jkt Utara, Daerah Khusus Ibukota Jakarta 14450, Indonesia', 'Andi', 1, '2xPO1IJ9lRaafN6usS0a.jpg', '2017-08-22 13:04:12', 1, '2018-11-12 17:43:01', 'school_client_bpk01', 45),
(2, '20103290', 'SMAN 105 JAKARTA', 'JjqtV753rt0E0JEoPIXRDNr8EO2Pz5', 'sman.105.jakarta@gmail.com', '0218719206', 'Jln. Usman Kelapa Dua Wetan', 'Eman Sulaeman', 1, '', '2018-07-10 10:12:04', 1, '2018-07-10 10:12:04', '', 0),
(3, '20103191', 'SMAS TRISOKO JAKARTA', 'BXxbBETSuVceglaCn22SNzvl02ORW3', 'trisokosmas@gmail.com', '021-8095130', 'JL. RAYA PONDOK GEDE DUKUH II/IV', 'IMAM MULYANTO', 1, '', '2018-07-10 10:12:04', 1, '2018-07-10 10:12:04', '', 0),
(4, '20103256', 'SMAN 99 JAKARTA', 'jtUoybh6khTrSCGZUx7RDTbEM1lrzK', 'sman99jkt@yahoo.com', '021-8700979', 'JL.Cibubur  II', 'Faham Sanjaya', 1, '', '2018-07-10 10:12:04', 1, '2018-07-10 10:12:04', '', 0),
(5, '20103179', 'SMAS MUHAMMADIYAH 4 JAKARTA', 'hrdhSVWcx015IMFMoQCB3h5qDHNACb', 'ka_sma_muh4@yahoo.co.id', '80873736', 'JL. DEWI SARTIKA 316 A', 'Heri Setiawan', 1, '', '2018-07-10 10:12:04', 1, '2018-07-16 17:22:01', 'school_client_20103179', 0),
(6, '20103192', 'SMA TELADAN 1 JAKARTA', 'dDlCQYMNWvACcxddQXF9A4pxFKoXNj', 'teladan_jkt@yahoo.co.id', '02187797748', 'JL. MADRASAH  NO.49', 'Rahmadhani Siregar', 1, '', '2018-07-10 10:12:04', 1, '2018-07-10 10:12:04', '', 0),
(7, '69948476', 'SMA PERGURUAN ADVENT XV', 'JiCbyPv4sn3yqvWZVlpfVtbDSYs1Ms', 'sma15pac@gmail.com', '02121387618', 'Jl. Pembaharuan Kelapa Dua Wetan', 'YOSEPH IRIANDI', 1, '', '2018-07-10 10:13:27', 1, '2018-07-10 10:13:27', '', 0),
(8, '69977033', 'SMA Islam Al Azhar 19', 'YK50VELd34hbAQBucldfao42akDYq1', 'smaia19jakarta@gmail.com', '021-22987122', 'Jl. Centex Rt 08/010', 'Mukhlis Cahyadi', 1, '', '2018-07-10 10:13:27', 1, '2018-07-10 10:13:27', '', 0),
(9, '69967066', 'SMAIT Buahati Islamic School', 'B5iAyaagooIXzT8w3faijx28kmrlyO', 'smaitbuahati2011@gmail.com', '02129842021', 'Jln. Kelapa Dua Wetan No. 1 RT. 006/001', 'SUKARNO', 1, '', '2018-07-10 10:13:27', 1, '2018-07-10 10:13:27', '', 0),
(10, '20103403', 'SMAS BINA DHARMA JAKARTA', 'JqAbXlbehyL5oqPNvMj0mYILaPZHEI', 'smabinadharma39@gmail.com', '021 8712207', 'JL. RAYA CIRACAS NO. 39', 'REXY AULIA JUNIARSYAH', 1, '', '2018-07-10 10:13:27', 1, '2018-07-10 10:13:27', '', 0),
(11, '20112282', 'SMAS CHARTAR BUANA', 'RnapzZzuCRSqYAMz7fwM0rNn6hQdok', 'smacb_2007@yahoo.co.id', '8711098', 'JL. PERUM CIBUBUR INDAH II', 'Nurhasanah', 1, '', '2018-07-10 10:13:27', 1, '2018-07-10 10:13:27', '', 0),
(12, '20109491', 'SMAS ISLAM AL-MARUF', 'GHQkEbCL8w9BYE1xx4lOEKH7E8cHoc', 'smaalmaruf14@gmail.com', '87710597', 'JL. RAYA LAPANGAN TEMBAK - CIBUBUR', 'Hermat M Santoso', 1, '', '2018-07-10 10:14:38', 1, '2018-07-10 10:14:38', '', 0),
(13, '20103183', 'SMAS PKP', 'pfeqr0ZLSG0IPv9dSbLJ7VFg9tdg42', 'smapkp@yahoo.com', '8720627', 'JL. KELAPA DUA WETAN', 'Annisa Auliani', 1, '', '2018-07-10 10:14:38', 1, '2018-07-10 10:14:38', '', 0),
(14, '20107199', 'SMAS PRATAMA', 'EoP7FD86xbiHDvo8LA26jSjP5lN2rt', 'smapratama@gmail.com', '021-8715500', 'JL.USMAN NO. 71', 'Eko Adhi Sumariyanto', 1, '', '2018-07-10 10:14:55', 1, '2018-07-10 10:14:55', '', 0),
(15, '69772648', 'SMAS LAKESIDE MONTESSORI', 'qLLxwg3qmaI8xa56bu0lQSPhEvnVb8', '', '', 'VILLA CIBUBUR INDAH U1-16 CIBUBUR', 'Teguh Prasetyo', 1, '', '2018-07-10 10:14:55', 1, '2018-07-10 10:14:55', '', 0),
(16, '69772648', 'SMAS LAKESIDE MONTESSORI', 'Hl44bPLuTuHocNX0VK71pMhGwS3HBu', '', '', 'VILLA CIBUBUR INDAH U1-16 CIBUBUR', 'Teguh Prasetyo', 1, '', '2018-07-10 10:14:38', 1, '2018-07-10 10:14:38', '', 0),
(18, '20103289', 'SMAN 106 JAKARTA', 'vitCgbuHoAvJudQ9FjnXvzqB5dP32X', 'tim_sas_sman106@yahoo.com', '8701692', 'JL. GANDARIA I PEKAYON PASAR REBO JAKARTA TIMUR', 'F. FATAHILLAH', 1, '', '2018-07-10 10:14:38', 1, '2018-07-10 10:14:38', '', 0),
(19, '20103291', 'SMAN 104 JAKARTA', 'IHrOZ0NzpZbG6Qr6DkUj6Cqg7skqL4', 'sman10438@yahoo.co.id', '8408247', 'JL. H. TAIMAN BARAT KEL.GEDONG,JAKARTA TIMUR', 'Mochamad Ichsan', 1, '', '2018-07-10 10:14:55', 1, '2018-07-10 10:14:55', '', 0),
(20, '20103186', 'SMAS WIDYA MANGGALA JAKARTA', 'ZVXItqa4Be5RmXpqcHoA61IJx3DFtm', 'smawidyammangala@yahoo.co.id', '8406013', 'JL. MUJAHIDIN NO. 17', 'Irwan Maulana', 1, '', '2018-07-10 10:23:41', 1, '2018-07-10 10:23:41', '', 0),
(21, '20103185', 'SMAS WIJAYA KUSUMA', '1mWUSujU0LEhF1VDyCB3ToE8oGyYil', 'smawijayakusuma@yahoo.co.id', '8416056', 'JL. MUJAHIDIN NO. 17A RAMBUTAN. JAKTIM', 'ika kartika', 1, '', '2018-07-10 10:23:41', 1, '2018-07-10 10:23:41', '', 0),
(22, '20103296', 'SMAN 39 JAKARTA', 'faiIeOCDttZsphD02NfEP94dKUO3fa', 'sman39jkt@yahoo.com', '8400278', 'JL. RA FADILAH CIJANTUNG', 'DARUL FAHMI', 1, '', '2018-07-10 10:23:41', 1, '2018-07-10 10:23:41', '', 0),
(23, '20103214', 'SMAS BUDHI WARMAN 2', 'ziPHfkLE4tgHK4NWuYkY2wkSBzKgTr', 'smabudhiwarman2@gmail.com', '8711833', 'JL. RAYA BOGOR KM.28', 'Krisnayanti', 1, '', '2018-07-10 10:23:41', 1, '2018-07-10 10:23:41', '', 0),
(24, '20103257', 'SMAN 98 JAKARTA', 'dF49I89tjCSoYHXh9tCXQxzNuY1C4o', 'sma_98_klsr@yahoo.co.id', '8714579', 'JL.JAHA   NO. 1', 'AGUS SUSILO', 1, '', '2018-07-10 10:23:41', 1, '2018-07-10 10:23:41', '', 0),
(25, '20103230', 'SMAS ISLAM PB SOEDIRMAN', 'KBa9QcuGbZ3I6rVrsvIAAFvnjSUw0D', 'info@smasoedirman24.sch.id', '8400387', 'JL. RAYA BOGOR KM 24', 'SUBAGYO', 1, '', '2018-07-10 13:25:12', 1, '2018-07-10 13:25:12', '', 0),
(26, '20103300', 'SMAN 88 JAKARTA', 'ZKLQ4PE1QulIUramlUZWLB9WfKuio4', 'sman88jkt@gmail.com', '021 8701460', 'JL. SAWO', 'SUMISDI', 1, '', '2018-07-10 13:25:12', 1, '2018-07-10 13:25:12', '', 0),
(27, '20177806', 'SMA TARUNA PERSADA', 'ues3b2zxmSS6PIYsW1WPxLoWYqpZ6W', 'sma_tarunapersada@yahoo.co.id', '87797729', 'JALAN MASJID NO 29', 'FAKHRUDDIN', 1, '', '2018-07-10 13:25:12', 1, '2018-07-10 13:25:12', '', 0),
(28, '20103238', 'SMAS IGN SLAMET RIYADI', 'AIeN1keYiysVwBICicnxGyhDjoLofV', 'smaslamer@yahoo.co.id', '8403545', 'JL. RAYA BOGOR KM.24', 'DML Mardjoko K', 1, '', '2018-07-10 13:25:12', 1, '2018-07-10 13:25:12', '', 0),
(29, '20103314', 'SMAN 48 JAKARTA', 'YQJXE2lqKRTkCLqR7JzKyepeOexZcc', 'sman_48_jkt@yahoo.com', '0218006204', 'JL. PINANG RANTI II TMII', 'DWI RIYANTO', 1, '', '2018-07-10 13:25:12', 1, '2018-07-10 13:25:12', '', 0),
(30, '20103231', 'SMAS MALAHAYATI', 'Jptl1sZLYPeCx7Secp9tUjNF9T1FUL', 'sma_malahayaticijantung@yahoo.com', '0218701744', 'JL. BIMA NO.3', 'Asep Budiman', 1, '', '2018-07-16 17:11:18', 1, '2018-07-16 17:11:18', '', 0),
(31, '20103301', 'SMAN 81 JAKARTA', '6jyKguKjIPTfG9YaSOt9xEkNl02cyI', 'sma81.jt2@gmail.com', '021-8629940', 'JL. KARTIKA EKAPAKSI KPAD JATIWARINGI KALIMALANG JAKARTA TIMUR', 'Tulus Sarkoro', 1, '', '2018-07-16 17:11:18', 1, '2018-07-16 17:11:18', '', 0),
(32, '20103297', 'SMAN 42 JAKARTA', 'V5hL4bqF1CGifvgsJqTwVtMlOfEeQQ', 'sman42jkt@yahoo.co.id', '8093926', 'JL. RAJAWALI HALIM PERDANA KUSUMA JAKARTA TIMUR', 'Taat Waluyo', 1, '', '2018-07-16 17:11:18', 1, '2018-07-16 17:11:18', '', 0),
(33, '20103279', 'SMAN 9 JAKARTA', 'o21Fc7vXd76E8phQcN298EOD8NAVVB', 'adm@sma9jkt.sch.id', '021-8005964', 'JL. SMU 9  HALIM PERDANA KUSUMA,JAKARTA TIMUR', 'Pujo Wiyono', 1, '', '2018-07-16 17:11:18', 1, '2018-07-16 17:11:18', '', 0),
(34, '20103176', 'SMAS PANGUDI RAHAYU', 'dunDrs7C7jR6eDlpfwLp9zSpnTRiV2', 'sma.pangudi.rahayu@gmail.com', '87798114', 'JL. RAYA BOGOR KM 24,5', 'Darwanto Adi Nugroho', 1, '', '2018-07-16 17:11:18', 1, '2018-07-16 17:11:18', '', 0),
(35, '20103426', 'SMAS ANGKASA 1 H PERDANAKUSUMA', 'qzLMrasHIlFL66XHXSsH7EJuVTTidA', 'smaangkasasatu_hp@yahoo.com', '8001055', 'JL. TRIKORA RAYA', 'R. Rasban', 1, '', '2018-07-17 10:01:14', 1, '2018-07-17 10:01:14', '', 0),
(36, '20103189', 'SMAS USWATUN HASANAH JAKARTA', 'wQlaJk8C6vYqIyEwbdypBHv3yJRU8w', 'sma_uswatun_hasanah@yahoo.com', '8001152', 'JL. DEPNAKER NO. 2', 'FEBRI ARSIADI', 1, '', '2018-07-17 10:01:14', 1, '2018-07-17 10:01:14', '', 0),
(37, '20103304', 'SMAN 67 JAKARTA', 'rWWNCD4MdX6aBm9cAPNBwP8zhkKPaN', 'info@sman67-jkt.sch.id', '8090386', 'JL. SQUADRON', 'Sriyono', 1, '', '2018-07-17 10:01:14', 1, '2018-07-17 10:01:14', '', 0),
(38, '20103425', 'SMAS ANGKASA 2 H PERDANAKUSUMA', 'LC3bJChZM5GauIBbXJS0MRS72jqtkO', 'sma_angkasa2@yahoo.co.id', '8001532', 'AVIA KOMPLEK SKADRON', 'dwi purwoko', 1, '', '2018-07-17 10:01:14', 1, '2018-07-17 10:01:14', '', 0),
(39, '20103424', 'SMAS ARENA SISWA 2', 'RxKA3iUkjdSgvff8YS88y480BhjWWu', 'arenasiswadua@Yahoo.co.id', '(021) 25999635', 'JL. KRAMAT ASEM RAYA NO. 46', 'SUTARMIN', 1, '', '2018-07-17 10:01:14', 1, '2018-07-17 10:01:14', '', 0),
(40, '20103282', 'SMAN 22 JAKARTA', 'rVegKtH6QQOpOdq9gjRNhnYjs67aTI', 'ka_sman_22@yahoo.co.id', '8563352', 'JL. Kramat Asem, Kec. Matraman, Jakarta Timur 13120', 'Julaeha', 1, '', '2018-07-17 10:06:06', 1, '2018-07-17 10:06:06', '', 0),
(41, '20103281', 'SMAN 31 JAKARTA', '7lbVkipYAZazfUzV90bLDL7jy9YgeC', 'sma31jakarta@yahoo.com', '021 8508665', 'JL. KAYUMANIS TIMUR NO. 17', 'ENDANG TORO', 1, '', '2018-07-17 10:06:06', 1, '2018-07-17 10:06:06', '', 0),
(42, '20103181', 'SMAS MUHAMMADIYAH 12 JAKARTA', 'PRx9hPNdqmRLRb4iGwgKt5NCk7vRRj', 'smam12jakarta@gmail.com', '0218583014', 'JL. KHA DAHLAN NO. 20', 'Niko Kuncoro Jati', 1, '', '2018-07-17 10:06:06', 1, '2018-07-17 10:06:06', '', 0),
(43, '20103316', 'SMAS BINA PANGUDI LUHUR JAKARTA', 'KW8TlPLAEZPBvpWFgybZKn8iklVOQr', 'smabpljakarta@gmail.com', '021-8563339', 'JL. KRAMAT ASEM RAYA NO. 54', 'FIRLY LAHITA', 1, '', '2018-07-17 10:06:06', 1, '2018-07-17 10:06:06', '', 0),
(44, '20103309', 'SMAN 58 JAKARTA', '7eC8ONvnCeRFBJwWo1PG3kCRbnfWTm', 'sma58jkt@yahoo.co.id', '8710377', 'JL. RAYA CIRACAS NO. 2', 'Nanang Hadi Kusmanto', 1, '', '2018-07-17 10:06:06', 1, '2018-07-17 10:06:06', '', 0),
(45, '20103219', 'SMAS FONS VITAE 1 JAKARTA', 'hFVb7qpirUJjkkIdoqJrHqBZR1HjXr', 'info@fonsvitae-1.sch.id', '(021) 8510733', 'JL. MATRAMAN RAYA NO. 129', 'Yakobus Sugeng Suprihantono', 1, '', '2018-07-17 10:10:45', 1, '2018-07-17 10:10:45', '', 0),
(46, '20103430', 'SMAS PSKD II JAKARTA', 'PoBpnGR89ammviagi2TBRTDz2NXUae', 'pskddua@gmail.com', '8580342', 'JL. TAMAN SLAMET RIYADI NO. 03', 'TUGINO DWI HASTO', 1, '', '2018-07-17 10:10:45', 1, '2018-07-17 10:10:45', '', 0),
(47, '', '', 'ZO6ai1b4ZJgUEGF8o5fKMEmdWBPtrF', '', '', '', '', 1, '', '2018-07-17 10:10:45', 1, '2018-07-17 10:10:45', '', 0),
(48, '20107269', 'SMAS AL CHASANAH', '01o4KOnvnkucKwkScRYLAl3zepCv01', 'smaalchasanah@yahoo.com', '5637640', 'JL. TANJUNG DUREN BARAT 3/1', 'Lia Kurniasari', 1, '', '2018-07-17 10:10:45', 1, '2018-07-17 10:10:45', '', 0),
(49, '20101351', 'SMAS 2 GALATIA', 'ijeGabLkORWsmxB0mX6tWkiNGmutGi', 'ka_sma_galatia02@yahoo.com', '5605122', 'JL. MERPATI RAYA NO. 1', 'Kamidi', 1, '', '2018-07-17 10:10:45', 1, '2018-07-17 10:10:45', '', 0),
(50, '20101306', 'SMAS 1 KRISTEN BPK PENABUR', 'yswPPdjb9JD5SsBLQnMUoWhLn8H27q', 'smak1@bpkpenaburjakarta.or.id', '021-5666962', 'JL. TANJUNG DUREN RAYA NO. 4', 'Wahyu Dwi Prasetyo', 1, '', '2018-07-17 10:10:45', 1, '2018-07-17 10:10:45', '', 0),
(51, '20101619', 'SMAS 1 YADIKA', '7WtL8dNDQ3V0QccldRsCzJ3iZ4Pl5A', 'ka_sma_yadika1@yahoo.com', '5672649', 'JL. TANJUNG DUREN BARAT IV/8', 'Evi Henry Fernandos Ambarita, A.Md', 1, '', '2018-07-17 10:10:45', 1, '2018-07-17 10:10:45', '', 0),
(52, '20101332', 'SMAS BUNDA HATI KUDUS', '7eVtMW6t9VKO49pbT6dPrJJr5w5gEq', 'sma_bunda_hati_kudus@yahoo.co.id', '5686329', 'JL. RAHAYU NO. 22', 'Teguh Riyanto', 1, '', '2018-07-17 10:10:45', 1, '2018-07-17 10:10:45', '', 0),
(53, '20104412', 'SMAS DHARMA JAYA', 'Q0vV6SsZsCS51rAbm2XJAFOJh1uCyk', 'smadharmajaya@gmail.com', '5658159', 'JL. KAV. POLRI BLOK D. XV/1', 'Ade Sukendar', 1, '', '2018-07-17 10:10:45', 1, '2018-07-17 10:10:45', '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `b_school`
--
ALTER TABLE `b_school`
  ADD PRIMARY KEY (`schoolid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `b_school`
--
ALTER TABLE `b_school`
  MODIFY `schoolid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
