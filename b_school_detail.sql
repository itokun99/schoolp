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
-- Table structure for table `b_school_detail`
--

CREATE TABLE `b_school_detail` (
  `schooldetailid` int(11) NOT NULL,
  `school_id` int(11) NOT NULL,
  `jenjang_pendidikan` varchar(30) CHARACTER SET latin1 NOT NULL,
  `rt` varchar(50) CHARACTER SET latin1 NOT NULL,
  `rw` varchar(50) CHARACTER SET latin1 NOT NULL,
  `kode_pos` varchar(10) CHARACTER SET latin1 NOT NULL,
  `kelurahan` varchar(100) CHARACTER SET latin1 NOT NULL,
  `provinsi_id` varchar(50) CHARACTER SET latin1 NOT NULL,
  `kabupaten_id` varchar(50) CHARACTER SET latin1 NOT NULL,
  `kecamatan_id` varchar(50) CHARACTER SET latin1 NOT NULL,
  `sk_pendirian` varchar(30) CHARACTER SET latin1 NOT NULL,
  `tanggal_pendirian` date NOT NULL,
  `sk_izin` varchar(30) CHARACTER SET latin1 NOT NULL,
  `tanggal_izin` date NOT NULL,
  `kebutuhan_khusus` varchar(50) CHARACTER SET latin1 NOT NULL,
  `no_rekening` varchar(30) CHARACTER SET latin1 NOT NULL,
  `nama_bank` varchar(30) CHARACTER SET latin1 NOT NULL,
  `cabang` varchar(50) CHARACTER SET latin1 NOT NULL,
  `account_name` varchar(50) CHARACTER SET latin1 NOT NULL,
  `mbs` varchar(50) CHARACTER SET latin1 NOT NULL,
  `tanah_milik` varchar(10) CHARACTER SET latin1 NOT NULL,
  `tanah_bukan_milik` varchar(10) CHARACTER SET latin1 NOT NULL,
  `nwp` varchar(50) CHARACTER SET latin1 NOT NULL,
  `npwp` varchar(30) CHARACTER SET latin1 NOT NULL,
  `no_fax` varchar(30) CHARACTER SET latin1 NOT NULL,
  `website` varchar(100) CHARACTER SET latin1 NOT NULL,
  `waktu_penyelenggaraan` varchar(30) CHARACTER SET latin1 NOT NULL,
  `bersedia_menerima_bos` varchar(20) CHARACTER SET latin1 NOT NULL,
  `sertifikasi_iso` varchar(30) CHARACTER SET latin1 NOT NULL,
  `sumber_listrik` varchar(20) CHARACTER SET latin1 NOT NULL,
  `daya_listrik` varchar(10) CHARACTER SET latin1 NOT NULL,
  `akses_internet` varchar(30) CHARACTER SET latin1 NOT NULL,
  `internet_alternatif` varchar(30) CHARACTER SET latin1 NOT NULL,
  `kepsek` varchar(30) CHARACTER SET latin1 NOT NULL,
  `operator` varchar(30) CHARACTER SET latin1 NOT NULL,
  `akreditasi` varchar(2) CHARACTER SET latin1 NOT NULL,
  `kurikulum` varchar(30) CHARACTER SET latin1 NOT NULL,
  `status_sekolah` varchar(30) CHARACTER SET latin1 NOT NULL,
  `status_kepemilikan` varchar(50) CHARACTER SET latin1 NOT NULL,
  `tguru` int(11) NOT NULL,
  `tsiswa_pria` int(11) NOT NULL,
  `tsiswa_wanita` int(11) NOT NULL,
  `rombel` int(11) NOT NULL,
  `ruang_kelas` tinyint(4) NOT NULL,
  `laboratorium` tinyint(4) NOT NULL,
  `perpustakaan` tinyint(4) NOT NULL,
  `sanitasi` tinyint(4) NOT NULL,
  `latitude` decimal(9,6) NOT NULL DEFAULT '0.000000',
  `longitude` decimal(9,6) NOT NULL DEFAULT '0.000000',
  `detail_picture` varchar(100) CHARACTER SET latin1 NOT NULL,
  `kurikulum_id` int(11) NOT NULL,
  `edulevel_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `b_school_detail`
--

INSERT INTO `b_school_detail` (`schooldetailid`, `school_id`, `jenjang_pendidikan`, `rt`, `rw`, `kode_pos`, `kelurahan`, `provinsi_id`, `kabupaten_id`, `kecamatan_id`, `sk_pendirian`, `tanggal_pendirian`, `sk_izin`, `tanggal_izin`, `kebutuhan_khusus`, `no_rekening`, `nama_bank`, `cabang`, `account_name`, `mbs`, `tanah_milik`, `tanah_bukan_milik`, `nwp`, `npwp`, `no_fax`, `website`, `waktu_penyelenggaraan`, `bersedia_menerima_bos`, `sertifikasi_iso`, `sumber_listrik`, `daya_listrik`, `akses_internet`, `internet_alternatif`, `kepsek`, `operator`, `akreditasi`, `kurikulum`, `status_sekolah`, `status_kepemilikan`, `tguru`, `tsiswa_pria`, `tsiswa_wanita`, `rombel`, `ruang_kelas`, `laboratorium`, `perpustakaan`, `sanitasi`, `latitude`, `longitude`, `detail_picture`, `kurikulum_id`, `edulevel_id`) VALUES
(1, 2, 'SMA', '2', '4', '13730', 'Kelapa Dua Wetan', '31', '3172', '3172020', '-', '2017-09-20', '-', '2017-09-20', 'Tidak ada', 'SMU Negeri 105 Jakarta', 'DKI', 'Otista', '', '', '7130', '0', '', '', '0219714217', 'http://www.sman105-jkt.sch.id', 'Sehari penuh (5 h/m)', 'Bersedia Menerima', 'Belum Bersertifikat', 'PLN', '125000', 'Lainnya (Serat Optik)', '', 'IMAM PRASAJA', 'Eman Sulaeman', 'A', 'Kurikulum 2013', 'Negeri', 'Pemerintah Daerah', 46, 323, 420, 21, 27, 3, 1, 2, '-6.331600', '106.883700', '', 1, 0),
(2, 3, 'SMA', '5', '1', '13550', 'Dukuh', '31', '3172', '3172050', 'c-202-HT.03.01', '2006-12-04', '6925/-1.851.68', '2013-08-29', 'Tidak ada', 'SMA TRISOKO JAKARTA', 'BANK DKI', 'PASAR INDUK KRAMAT JATI', '', '', '2595', '0', '', '', '-', '', 'Siang', 'Bersedia Menerima', 'Belum Bersertifikat', 'PLN', '12000', 'Tidak Ada', '', 'SUPATMAN', 'IMAM MULYANTO', 'A', 'Kurikulum 2013', 'Swasta', 'Yayasan', 10, 90, 95, 6, 6, 2, 1, 2, '-6.268400', '106.860700', '', 1, 0),
(3, 4, 'SMA', '9', '3', '13720', 'Cibubur', '31', '3172', '3172020', '-', '2015-09-02', '-', '2015-09-02', 'Tidak ada', 'SMU NEGERI 99', 'BANK DKI', 'OTISTA', '', '', '11280', '0', '', '', '021-87704317', 'http://www.sman99-jkt.sch.id/', 'Pagi', 'Bersedia Menerima', '9001:2000', 'PLN', '66000', 'Firstmedia', '', 'TULUS WINARDI', 'Faham Sanjaya', 'A', 'Kurikulum 2013', 'Negeri', 'Pemerintah Daerah', 62, 400, 641, 29, 30, 3, 1, 1, '-6.342500', '106.872900', '', 1, 0),
(4, 5, 'SMA', '8', '4', '13630', 'Cawang', '31', '3172', '3172050', 'SP.422/I01.1A/I.85', '1970-01-01', '1627/-1.851.68', '1970-01-01', 'Tidak ada', 'SMAS MUHAMMADIYAH 4 JAKARTA', 'BNI CAB. TEBET', '-', '', '', '2474', '0', '', '', '80873736', 'HTTP://www.smamuhammadiyah-4.sch.id', 'Sehari penuh (5 h/m)', 'Bersedia Menerima', 'Belum Bersertifikat', 'PLN', '80000', 'Telkom Speedy', '', 'Riyanta', 'Heri Setiawan', 'A', 'Kurikulum 2013', 'Swasta', 'Yayasan', 22, 274, 329, 19, 20, 5, 1, 5, '-6.249400', '106.866200', '', 1, 3),
(5, 6, 'SMA', '10', '5', '13750', 'SUSUKAN', '31', '3172', '3172020', '', '0000-00-00', '', '0000-00-00', 'K - Kesulitan Belajar', 'SMA Teladan I', 'DKI', 'PASAR INDUK', '', '', '0', '1500', '', '', '', 'http://www.smateladan1.com', 'Sehari penuh (5 h/m)', 'Bersedia Menerima', 'Belum Bersertifikat', 'PLN', '3500', 'Axis', '', 'Surachman', 'Rahmadhani Siregar', 'A', 'Kurikulum 2013', 'Swasta', 'Yayasan', 11, 57, 76, 6, 7, 0, 0, 0, '-6.318200', '106.896600', '', 1, 0),
(6, 7, 'SMA', '0', '0', '13730', 'Kelapa Dua Wetan', '31', '3172', '3172020', '-', '2014-09-12', '18951/1.10/31.75.00.000//-1.85', '2016-08-13', 'Tidak ada', 'SMA PERGURUAN ADVENT XV', 'BANK DKI', 'DEPOK', '', '', '1000', '0', '', '', '', 'http://pac15.sch.id/', 'Sehari penuh (5 h/m)', 'Bersedia Menerima', 'Belum Bersertifikat', 'PLN', '11000', 'Lainnya', '', 'LAURI SIAHAAN', 'YOSEPH IRIANDI', '', 'Kurikulum 2013', 'Swasta', 'Yayasan', 14, 89, 94, 7, 7, 3, 1, 2, '-6.344100', '106.883200', '', 1, 0),
(7, 8, 'SMA', '8', '10', '13740', 'Ciracas', '31', '3172', '3172020', '26254/1.11/31.75.00.000/-/', '2016-11-08', '1/A.2.1/31.75.09/-1.851/2018', '2018-02-15', 'Tidak ada', 'Dr. Harimurti Wulandjani, SE, ', 'Kospinjasa', 'Cibubur', '', '', '4700', '0', '', '', '', 'http://www.smaialazhar19.sch.id/', 'Sehari penuh (5 h/m)', 'Tidak Bersedia Menri', 'Belum Bersertifikat', 'PLN', '36000', 'Telkom Speedy', '', 'SRI HARTOYO', 'Mukhlis Cahyadi', '', 'Kurikulum 2013', 'Swasta', 'Yayasan', 20, 101, 64, 7, 15, 3, 1, 6, '-6.319800', '106.877300', '', 1, 0),
(8, 9, 'SMA', '6', '1', '13740', 'Kelapa Dua Wetan', '31', '3172', '3172020', '2/A.2/31.75.09/-1.851/2017/', '2017-09-13', '2/A.2/31.75.09/-1.851/2017/', '2017-09-13', 'Tidak ada', '', '', '', '', '', '5000', '0', '', '', '02129842021', 'http://www.buahati.com', 'Sehari penuh (5 h/m)', 'Bersedia Menerima', 'Proses Sertifikasi', 'PLN', '12000', 'Tidak Ada', '', 'Arif Rahman Hakim', 'SUKARNO', '', 'KTSP', 'Swasta', 'Yayasan', 11, 67, 49, 5, 6, 0, 0, 2, '0.000000', '0.000000', '', 1, 0),
(9, 10, 'SMA', '5', '6', '13740', 'CIRACAS', '31', '3172', '3172020', '665/c7/kp/5', '1984-04-19', 'Kep.25.11/IO1.A1/PP/1998', '1998-04-15', 'Tidak ada', 'SMA BINA DHARMA', 'BANK DKI', 'OTISTA', '', '', '5386', '0', '', '', '8712207', 'http://www.sma-binadharma.sch.id', 'Pagi', 'Bersedia Menerima', 'Belum Bersertifikat', 'PLN', '100000', 'Telkom Speedy', '', 'TRI WINARNI', 'REXY AULIA JUNIARSYAH', 'A', 'Kurikulum 2013', 'Swasta', 'Yayasan', 31, 400, 375, 23, 24, 2, 1, 2, '-6.327500', '106.884700', '', 1, 0),
(10, 11, 'SMA', '2', '7', '13730', 'Kelapa Dua Wetan', '31', '3172', '3172020', '', '1900-01-01', '-', '2016-02-27', 'Tidak ada', 'SMA CHARTAR BUANA', 'BANK DKI', 'CABANG PASAR INDUK', '', '', '2000', '2000', '', '', '8719694', 'http://smacb_2007.com', 'Pagi', 'Bersedia Menerima', 'Belum Bersertifikat', 'PLN', '3600', 'Tidak Ada', '', 'LASRIA HASIBUAN', 'Nurhasanah', 'A', 'Kurikulum 2013', 'Swasta', 'Yayasan', 16, 145, 214, 13, 13, 3, 1, 2, '-6.338000', '106.890300', '', 1, 0),
(11, 12, 'SMA', '3', '10', '13730', 'KELAPA DUA WETAN', '31', '3172', '3172020', '', '1900-01-01', '', '0000-00-00', 'Tidak ada', 'SMA ISLAM AL MA RUF', 'Bank DKI', 'OTISTA', '', '', '600', '600', '', '', '87710597', 'http://www.almaruf.net', 'Sehari penuh (5 h/m)', 'Bersedia Menerima', 'Belum Bersertifikat', 'PLN', '3600', 'Tidak Ada', '', 'Marnita Ma&#039;roef', 'Hermat M Santoso', 'A', 'Kurikulum 2013', 'Swasta', 'Yayasan', 18, 124, 101, 9, 9, 0, 0, 2, '-6.341600', '106.886300', '', 1, 0),
(12, 13, 'SMA', '8', '1', '13730', 'Ciracas', '31', '3172', '3172020', '30', '2017-07-21', '-', '2017-07-21', 'Tidak ada', 'SMA PKP JAKARTA ISLAMIC SCHOOL', 'BANK DKI', 'PKP', '', '', '18000', '0', '', '', '8720627', 'http://smapkpjis.sch.id', 'Sehari penuh (5 h/m)', 'Bersedia Menerima', '9001:2008', 'PLN', '100500', 'Tidak Ada', '', 'YAYAT WAHYAT HERIANTO', 'Annisa Auliani', 'A', 'Kurikulum 2013', 'Swasta', 'Yayasan', 41, 353, 302, 21, 23, 4, 1, 1, '-6.339000', '106.883400', '', 1, 0),
(13, 14, 'SMA', '7', '11', '13730', 'Kelapa Dua Wetan', '31', '3172', '3172020', '4114/-1.712.3', '2008-11-06', '9514/-1.851.68', '2013-11-12', 'Tidak ada', 'SMA Pratama', 'Bank DKI', 'Otista', '', '', '3400', '0', '', '', '', 'http://www.smapratama.com', 'Pagi', 'Bersedia Menerima', 'Proses Sertifikasi', 'PLN', '6000', 'Smartfren', '', 'Ekhsan', 'Eko Adhi Sumariyanto', 'B', 'Kurikulum 2013', 'Swasta', 'Yayasan', 4, 48, 27, 3, 3, 0, 1, 2, '-6.332400', '106.883600', '', 1, 0),
(14, 15, 'SMA', '11', '6', '13720', 'CIBUBUR', '31', '3172', '3172020', '', '0000-00-00', '', '0000-00-00', 'Tidak ada', '', '', '', '', '', '3000', '2000', '', '', '', '', 'Sehari penuh (5 h/m)', 'Tidak Bersedia Menri', 'Belum Bersertifikat', 'PLN', '20000', 'Tidak Ada', '', 'Supriyatno', 'Teguh Prasetyo', '', 'KTSP', 'Swasta', 'Yayasan', 5, 2, 0, 1, 1, 1, 1, 2, '-6.351000', '106.876800', '', 1, 0),
(15, 16, 'SMA', '11', '6', '13720', 'CIBUBUR', '31', '3172', '3172020', '', '0000-00-00', '', '0000-00-00', 'Tidak ada', '', '', '', '', '', '3000', '2000', '', '', '', '', 'Sehari penuh (5 h/m)', 'Tidak Bersedia Menri', 'Belum Bersertifikat', 'PLN', '20000', 'Tidak Ada', '', 'Supriyatno', 'Teguh Prasetyo', '', 'KTSP', 'Swasta', 'Yayasan', 5, 2, 0, 1, 1, 1, 1, 2, '-6.351000', '106.876800', '', 1, 0),
(29, 1, 'SD', '007', '010', '12345', 'Muara Karang Barat', '31', '3175', '3175010', 'SP.422/I01.1A/I.85', '1994-05-10', '1627/-1.851.68', '1998-11-16', 'Tidak ada', 'BPK Penabur Jakarta', 'BCA', 'KCP PLUIT', 'BPK Penabur', '', '100', '50', '', '', '(021) 7538833', 'www.bpkpenabur.com', 'Sehari penuh (5 h/m)', 'Bersedia Menerima', 'Belum Bersertifikat', 'PLN', '100000', 'Telkom Speedy', '', 'Sule', 'Andi', 'A', 'Kurikulum 2013', 'Swasta', 'Yayasan', 20, 300, 300, 20, 15, 7, 5, 2, '-6.114118', '106.774801', '', 1, 1),
(17, 18, 'SMA', '12', '9', '13710', 'Pekayon', '31', '3172', '3172010', '0283/O/1991', '1991-05-30', '0283/O/1991', '1991-05-30', 'Tidak ada', 'SMA NEGERI 106', 'BANK DKI', 'OTISTA', '', '', '9345', '0', '', '', '87713964', 'http://www.sman106jkt.sch.id', 'Sehari penuh (5 h/m)', 'Bersedia Menerima', 'Belum Bersertifikat', 'PLN', '60000', 'Firstmedia', '', 'SALAMET', 'F. FATAHILLAH', 'A', 'Kurikulum 2013', 'Negeri', 'Pemerintah Daerah', 46, 340, 414, 21, 21, 4, 1, 2, '-6.314800', '106.874800', '', 1, 0),
(18, 19, 'SMA', '1', '2', '13760', 'GEDONG', '31', '3172', '3172010', '0283/0/1991', '1991-05-30', '0283/0/1991', '1991-05-30', 'Tidak ada', 'SMAN 104 JAKARTA', 'DKI', 'Otista', '', '', '9700', '0', '', '', '8408247', 'http://sman104jkt.sch.id', 'Pagi', 'Bersedia Menerima', '9001:2008', 'PLN', '70000', 'Telkom Speedy', '', 'M. Musyafa', 'Mochamad Ichsan', 'A', 'Kurikulum 2013', 'Negeri', 'Pemerintah Pusat', 41, 367, 494, 24, 25, 4, 1, 1, '-6.299100', '106.862200', '', 1, 0),
(19, 20, 'SMA', '5', '2', '', 'Rambutan', '31', '3172', '3172020', 'Kep. 332 A/101.A1.190', '1989-08-28', '1285/-1.851.68', '2014-02-24', 'Tidak ada', 'SMA Widya Manggala', 'DKI', 'PS.Induk KramatJati', '', '', '1300', '2', '', '', '8406013', 'http://smawidyamanggala.com', 'Pagi', 'Bersedia Menerima', 'Belum Bersertifikat', 'PLN', '9000', 'Telkomsel Flash', '', 'Muhammad Fauzi Ramdhan', 'Irwan Maulana', 'A', 'Kurikulum 2013', 'Swasta', 'Yayasan', 23, 253, 166, 11, 11, 0, 0, 1, '-6.303200', '106.872500', '', 1, 0),
(20, 21, 'SMA', '11', '2', '13830', 'Rambutan', '31', '3172', '3172020', '211', '2015-09-14', '-', '2015-09-14', 'Tidak ada', 'WIJAYA KUSUMA,SMA', 'BANK DKI', '-', '', '', '2000', '0', '', '', '0218416056', 'http://smawijayakusuma.sch.id', 'Pagi', 'Bersedia Menerima', 'Belum Bersertifikat', 'PLN', '4000', 'Tidak Ada', '', 'SUTOPO', 'ika kartika', 'A', 'Kurikulum 2013', 'Swasta', 'Yayasan', 18, 185, 206, 12, 12, 1, 1, 2, '-6.308400', '106.880300', '', 1, 0),
(21, 22, 'SMA', '5', '5', '13780', 'Baru', '31', '3172', '3172010', '0298/O/1978', '2015-08-20', '-', '2015-08-20', 'Tidak ada', 'SMA Negeri 39 Jakarta', 'Bank DKI', 'Gunadarma', '', '', '9278', '9278', '', '', '87794718', 'http://sman39jkt.sch.id', 'Sehari penuh (5 h/m)', 'Bersedia Menerima', '9001:2000', 'PLN', '749996', 'Lainnya (Serat Optik)', '', 'Horale Tua Simanullang', 'DARUL FAHMI', 'A', 'Kurikulum 2013', 'Negeri', 'Pemerintah Daerah', 75, 419, 657, 30, 30, 6, 1, 2, '-6.320900', '106.850100', '', 1, 0),
(22, 23, 'SMA', '5', '1', '13710', 'Pekayon', '31', '3172', '3172010', 'KEP/834/10/1/90', '1990-01-13', '11883/-1.851.68', '2014-11-24', 'Tidak ada', 'SMA BUDHI WARMAN II', 'BANK DKI', '-', '', '', '6236', '6236', '', '', '8705582', 'http://www.budhiwarman2.com', 'Pagi', 'Bersedia Menerima', 'Belum Bersertifikat', 'PLN', '97500', 'Tidak Ada', '', 'Pardi Supardi', 'Krisnayanti', 'A', 'Kurikulum 2013', 'Swasta', 'Yayasan', 40, 356, 318, 17, 19, 2, 1, 2, '-6.340700', '106.865000', '', 1, 0),
(23, 24, 'SMA', '2', '9', '13790', 'Kalisari', '31', '3172', '3172010', '-', '2015-11-26', '-', '2015-11-26', 'Tidak ada', 'SMA Negeri 98 Jakarta', 'BANK DKI', 'OTISTA', '', '', '6411', '6411', '', '', '8708519', 'http://www.sman98jakarta.sch.id', 'Sehari penuh (5 h/m)', 'Bersedia Menerima', 'Belum Bersertifikat', 'PLN', '65000', 'Tidak Ada', '', 'HERMAN SYAFRI', 'AGUS SUSILO', 'A', 'Kurikulum 2013', 'Negeri', 'Pemerintah Daerah', 58, 449, 557, 28, 28, 3, 1, 2, '-6.332400', '106.857300', '', 1, 0),
(24, 25, 'SMA', '3', '4', '13740', 'Cijantung', '31', '3172', '3172010', '1967', '2015-11-16', '-', '2015-11-16', 'J - Bakat Istimewa', 'SMA ISLAM PB SOEDIRMAN', 'BANK DKI', '-', '', '', '3500', '3500', '', '', '8411579', 'http://www.smasoedirman24.sch.id', 'Sehari penuh (5 h/m)', 'Bersedia Menerima', '9001:2008', 'PLN', '15000', 'Telkom Speedy', '', 'SUROTO', 'SUBAGYO', 'A', 'Kurikulum 2013', 'Swasta', 'Yayasan', 46, 380, 216, 24, 28, 4, 1, 0, '-6.313600', '106.862000', '', 1, 0),
(25, 26, 'SMA', '7', '2', '13780', 'Baru', '31', '3172', '3172010', '-', '2015-09-07', '-', '2015-09-07', 'Tidak ada', 'SMA 88', 'BANK DKI', 'OTISTA', '', '', '3110', '3568', '', '', '021 87704525', 'http://www.sman88jakarta.sch.id', 'Sehari penuh (5 h/m)', 'Bersedia Menerima', 'Belum Bersertifikat', 'PLN', '76000', 'Telkom Speedy', '', 'SUSILA HARTONO', 'SUMISDI', 'A', 'Kurikulum 2013', 'Negeri', 'Pemerintah Daerah', 43, 374, 198, 16, 16, 0, 1, 2, '-6.327800', '106.847000', '', 1, 0),
(26, 27, 'SMA', '8', '1', '13760', 'GEDONG', '31', '3172', '3172010', '02', '2011-01-03', '10124/-1.851.68', '2013-11-27', 'Tidak ada', 'SMA TARUNA PERSADA', 'BNI', '-', '', '', '0', '1800', '', '', '87797729', 'http://www.smatp-jaktim.blogspot.com', 'Sehari penuh (5 h/m)', 'Bersedia Menerima', 'Belum Bersertifikat', 'PLN', '4400', 'Tidak Ada', '', 'MUSBIR', 'FAKHRUDDIN', 'B', 'Kurikulum 2013', 'Swasta', 'Yayasan', 2, 36, 0, 3, 3, 2, 1, 1, '-6.299300', '106.857900', '', 1, 0),
(27, 28, 'SMA', '2', '4', '13770', 'CIJANTUNG', '31', '3172', '3172010', 'Kep.949A/101-A1/I/94', '1994-11-25', '798/-1.851.68', '2013-01-31', 'Tidak ada', 'SMA IGNATIUS SLAMET RIYADI', 'BANK DKI', 'OTISTA', '', '', '2600', '2600', '', '', '8403545', 'http://www.smaignslametriyadi.sch.id', 'Sehari penuh (5 h/m)', 'Bersedia Menerima', 'Belum Bersertifikat', 'PLN', '5000', '3 (Tri)', '', 'NINA DWI ESTI PRABANDARI', 'DML Mardjoko K', 'A', 'Kurikulum 2013', 'Swasta', 'Yayasan', 16, 118, 144, 10, 11, 4, 1, 2, '-6.316900', '106.862400', '', 1, 0),
(28, 29, 'SMA', '14', '1', '13560', 'Pinang Ranti', '31', '3172', '3172040', '-', '2015-09-14', '-', '2015-09-14', 'Tidak ada', 'SMA NEGERI 48 JAKARTA', 'BANK DKI', 'Otista', '', '', '5703', '0', '', '', '0218009437', 'http://www.sman48-jkt.sch.id', 'Sehari penuh (5 h/m)', 'Bersedia Menerima', 'Belum Bersertifikat', 'PLN', '177000', 'Tidak Ada', '', 'ACAH RIANTO', 'DWI RIYANTO', 'A', 'Kurikulum 2013', 'Negeri', 'Pemerintah Pusat', 58, 335, 524, 24, 24, 3, 1, 0, '-6.287700', '106.883100', '', 1, 0),
(30, 30, 'SMA', '8', '7', '13770', 'Cijantung', '31', '3172', '3172010', '2139/A2.1.2/KP/1997', '1998-04-15', '9589/-1.851.68', '2013-11-14', 'Tidak ada', 'SMA MALAHAYATI', 'BANK DKI', 'Otista', '', '', '2370', '800', '', '', '0218701743', 'http://malahayatiislamicscholl.com', 'Kombinasi', 'Bersedia Menerima', 'Belum Bersertifikat', 'PLN &amp; Diesel', '18000', 'Smartfren', '', 'Alip Arodabiro', 'Asep Budiman', 'A', 'Kurikulum 2013', 'Swasta', 'Yayasan', 15, 231, 235, 14, 17, 2, 1, 2, '-6.324900', '106.859400', '', 1, 3),
(31, 31, 'SMA', '0', '0', '13620', 'Cipinang Melayu', '31', '3172', '3172040', 'Kep.70/I01.E1/R/92', '1992-05-29', 'Kep.70/I01.E1/R/92', '1992-05-29', 'Tidak ada', 'SMAN 81 JAKARTA', 'DKI', 'KALIMALANG', '', '', '8460', '0', '', '', '021-86608034', 'http://sman81jkt.sch.id', 'Sehari penuh (5 h/m)', 'Bersedia Menerima', '9001:2008', 'PLN', '198000', 'Lainnya (Serat Optik)', '', 'SHOHIBUL BAKHRI', 'Tulus Sarkoro', 'A', 'Kurikulum 2013', 'Negeri', 'Pemerintah Daerah', 55, 367, 497, 24, 24, 4, 1, 3, '-6.251100', '106.917900', '', 1, 3),
(32, 32, 'SMA', '3', '11', '13610', 'Halim Perdana Kusumah', '31', '3172', '3172040', '-', '2015-07-02', '-', '2015-07-02', 'Tidak ada', 'SMAN 42 JKT', 'BANK DKI', 'Matraman', '', '', '0', '9250', '', '', '80887233', 'http://www.sman42-jkt.sch.id', 'Sehari penuh (5 h/m)', 'Bersedia Menerima', '9001:2008', 'PLN', '135000', 'Lainnya (Wavelan)', '', 'Sonny Juhersoni', 'Taat Waluyo', 'A', 'Kurikulum 2013', 'Negeri', 'Pemerintah Daerah', 55, 381, 481, 24, 25, 3, 1, 2, '-6.255900', '106.891200', '', 1, 3),
(33, 33, 'SMA', '12', '4', '13650', 'Kebon Pala', '31', '3172', '3172040', '-', '2016-07-26', '-', '2016-07-26', 'Tidak ada', 'SMAN 9 Jakarta', 'DKI', 'KCP Pasar Induk Kramat Jati', '', '', '5304', '0', '', '', '021-80882463', 'http://www.sma9jkt.sch.id', 'Pagi', 'Bersedia Menerima', 'Belum Bersertifikat', 'PLN', '151100', 'Tidak Ada', '', 'MARIHOT MALAU', 'Pujo Wiyono', 'A', 'Kurikulum 2013', 'Negeri', 'Pemerintah Daerah', 44, 362, 393, 21, 21, 2, 1, 5, '-6.258700', '106.881500', '', 1, 3),
(34, 34, 'SMA', '4', '6', '13770', 'CIJANTUNG', '31', '3172', '3172010', '', '0000-00-00', 'Kep.483A/101.A1/I/90', '0000-00-00', 'Tidak ada', 'SMA Pangudi Rahayu', 'Bank DKI', 'Dewi Sartika', '', '', '3000', '0', '', '', '', '', 'Sehari penuh (5 h/m)', 'Bersedia Menerima', 'Belum Bersertifikat', 'PLN', '2200', 'Tidak Ada', '', 'Jesayas Anggiat Sirait', 'Darwanto Adi Nugroho', 'B', 'Kurikulum 2013', 'Swasta', 'Yayasan', 5, 47, 33, 6, 6, 0, 1, 2, '-6.319800', '106.864200', '', 1, 3),
(35, 35, 'SMA', '2', '14', '13610', 'Halim Perdana Kusumah', '31', '3172', '3172040', '-', '2016-11-04', '-', '2016-11-04', 'Tidak ada', 'SMA ANGKASA 1', 'DKI', 'Otista', '', '', '5000', '0', '', '', '8012249', 'http://angkasa1-jakarta.sch.id', 'Sehari penuh (5 h/m)', 'Bersedia Menerima', 'Belum Bersertifikat', 'PLN', '100000', 'Telkomsel Flash', '', 'Any Adhayani', 'R. Rasban', 'A', 'Kurikulum 2013', 'Swasta', 'Yayasan', 35, 397, 289, 21, 21, 4, 1, 1, '-6.250200', '106.882300', '', 1, 3),
(36, 36, 'SMA', '13', '1', '13560', 'PINANG RANTI', '31', '3172', '3172040', 'Kep.768A/101.A1/1/91', '1901-01-01', '626/.1.851.68', '1900-01-01', 'Tidak ada', 'SMA USWATUN HASANAH', 'BNI', '120 TEBET', '', '', '2175', '0', '', '', '8001152', 'http://smauswatunhasanahjaktim.sch.id', 'Sehari penuh (5 h/m)', 'Bersedia Menerima', 'Belum Bersertifikat', 'PLN', '15000', 'Tidak Ada', '', 'JALALUDDIN', 'FEBRI ARSIADI', 'A', 'Kurikulum 2013', 'Swasta', 'Yayasan', 19, 152, 139, 9, 9, 1, 1, 2, '-6.285200', '106.882200', '', 1, 3),
(37, 37, 'SMA', '13', '4', '13610', 'Halim Perdana Kusumah', '31', '3172', '3172040', '-', '2015-08-12', '-', '2015-08-12', 'Tidak ada', 'SMA NEGERI 67', 'BANK DKI', '-', '', '', '0', '9484', '', '', '8090386', 'http://www.sman67-jkt.sch.id', 'Sehari penuh (5 h/m)', 'Bersedia Menerima', 'Belum Bersertifikat', 'PLN', '0', 'Tidak Ada', '', 'Sukawi', 'Sriyono', 'A', 'Kurikulum 2013', 'Negeri', 'Pemerintah Pusat', 56, 352, 511, 24, 24, 5, 1, 4, '-6.276000', '106.887100', '', 1, 3),
(38, 38, 'SMA', '4', '4', '13610', 'Halim Perdana Kusumah', '31', '3172', '3172040', '138C/I01.A1/PP/1999', '1999-10-22', '6587/-1.851.68', '2014-05-28', 'Tidak ada', 'SMA ANGKASA 2', 'Bank DKI', '-', '', '', '7100', '5000', '', '', '80871476', 'http://www.angkasa-2.com', 'Sehari penuh (5 h/m)', 'Bersedia Menerima', 'Belum Bersertifikat', 'PLN', '150000', 'Firstmedia', '', 'Tata Tavip Budiawan', 'dwi purwoko', 'A', 'Kurikulum 2013', 'Swasta', 'Yayasan', 42, 481, 371, 25, 25, 4, 1, 2, '-6.277200', '106.885900', '', 1, 3),
(39, 39, 'SMA', '9', '5', '13120', 'UTAN KAYU SELATAN', '31', '3172', '3172100', '', '0000-00-00', 'No.525/101-4/R4-1980', '0000-00-00', 'Tidak ada', 'SMA ARENA SISWA,II', 'Bank BNI', '243 RAWAMANGUN', '', '', '10', '6200', '', '', '', 'http://arenasiswadua.com', 'Siang', 'Bersedia Menerima', 'Belum Bersertifikat', 'PLN', '2200', 'Smartfren', '', 'ANTO', 'SUTARMIN', 'C', 'KTSP', 'Swasta', 'Yayasan', 3, 20, 7, 3, 3, 0, 0, 0, '-6.203500', '106.870700', '', 0, 3),
(40, 40, 'SMA', '0', '0', '13120', 'Utan Kayu Selatan', '31', '3172', '3172100', '-', '2016-03-08', '-', '2016-03-08', 'Tidak ada', 'SMA NEGERI 22 JAKARTA', 'DKI', 'MATRAMAN', '', '', '6314', '0', '', '', '85903290', 'http://www.sman22jakarta.sch.id', 'Sehari penuh (5 h/m)', 'Bersedia Menerima', 'Belum Bersertifikat', 'PLN', '209200', 'Telkom Speedy', '', 'SRI SARIWARNI', 'Julaeha', 'A', 'Kurikulum 2013', 'Negeri', 'Pemerintah Daerah', 47, 396, 497, 25, 25, 4, 1, 4, '-6.202600', '106.869400', '', 1, 3),
(41, 41, 'SMA', '3', '2', '13120', 'Utan Kayu Selatan', '31', '3172', '3172100', '-', '2015-02-18', '-', '2015-02-18', 'Tidak ada', 'SMA Negeri 31 Jakarta', 'Bank DKI', 'Matraman', '', '', '12000', '0', '', '', '021 8573708', 'http://www.sman31jkt.sch.id/', 'Sehari penuh (5 h/m)', 'Bersedia Menerima', 'Belum Bersertifikat', 'PLN', '0', 'Telkom Speedy', '', 'Burhanuddin', 'ENDANG TORO', 'A', 'Kurikulum 2013', 'Negeri', 'Pemerintah Daerah', 63, 462, 645, 31, 32, 4, 1, 2, '-6.202600', '106.864500', '', 1, 3),
(42, 42, 'SMA', '1', '9', '13130', 'Kayu Manis', '31', '3172', '3172100', '4012/II-08/DKI82/1982', '1982-04-03', '7212/-1.851.68', '2014-06-17', 'Tidak ada', 'SMA MUHAMMADIYAH 12', 'Bank DKI', '-', '', '', '13540', '560', '', '', '0218583014', 'http://smamuhammadiyah12.blogspot.com', 'Pagi', 'Bersedia Menerima', 'Belum Bersertifikat', 'PLN', '41500', 'Tidak Ada', '', 'SM HASYIR', 'Niko Kuncoro Jati', 'A', 'Kurikulum 2013', 'Swasta', 'Yayasan', 16, 197, 179, 12, 12, 1, 1, 2, '-6.208800', '106.863000', '', 1, 3),
(43, 43, 'SMA', '25', '6', '13120', 'Utan Kayu Selatan', '31', '3172', '3172100', '-', '2015-11-04', '-', '2015-11-04', 'Tidak ada', 'SMA BINA PANGUDI LUHUR', 'Bank DKI', 'Matraman', '', '', '1948', '0', '', '', '021-8563339', 'http://smabpl.blogspot.com', 'Pagi', 'Bersedia Menerima', 'Belum Bersertifikat', 'PLN', '6600', 'Smartfren', '', 'SUKARDI', 'FIRLY LAHITA', 'A', 'Kurikulum 2013', 'Swasta', 'Yayasan', 15, 153, 130, 10, 18, 1, 1, 2, '-6.203500', '106.870100', '', 1, 3),
(44, 44, 'SMA', '7', '3', '13740', 'CIRACAS', '31', '3172', '3172020', '6895728', '0000-00-00', '', '0000-00-00', 'Tidak ada', 'SMA Negeri 58 Jakarta', 'DKI', 'Gunadarma', '', '', '4659', '0', '', '', '87706918', 'http://www.sman58-jkt.sch.id', 'Sehari penuh (5 h/m)', 'Bersedia Menerima', 'Belum Bersertifikat', 'PLN', '60000', 'Lainnya (Kabel)', '', 'Umaryadi', 'Nanang Hadi Kusmanto', 'A', 'Kurikulum 2013', 'Negeri', 'Pemerintah Daerah', 51, 349, 513, 24, 24, 4, 1, 6, '-6.328200', '106.877500', '', 1, 3),
(45, 45, 'SMA', '19', '8', '13140', 'Pal Meriem', '31', '3172', '3172100', '941/PI/MB/PB/T/1990', '2016-05-15', '-', '2016-05-15', 'Tidak ada', 'SR. THERESIE SRI MARWATI', 'DKI', '-', '', '', '32767', '0', '', '', '(021) 85908687', 'http://www.fonsvitae-1.sch.id', 'Sehari penuh (5 h/m)', 'Bersedia Menerima', 'Belum Bersertifikat', 'PLN', '120000', 'Smartfren', '', 'Sr. M. Theresie, OSF, S.Pd., M', 'Yakobus Sugeng Suprihantono', 'A', 'Kurikulum 2013', 'Swasta', 'Yayasan', 39, 285, 264, 21, 21, 5, 1, 2, '-6.207400', '106.859400', '', 1, 3),
(46, 46, 'SMA', '1', '4', '13150', 'Kebon Manggis', '31', '3172', '3172100', 'SP.323A/I01.G4/I/87', '2016-01-29', '-', '2016-01-29', 'Tidak ada', 'SMA PSKD 2', 'DKI', 'MATRAMAN', '', '', '3300', '0', '', '', '8580342', '', 'Sehari penuh (5 h/m)', 'Bersedia Menerima', 'Belum Bersertifikat', 'PLN', '41000', 'Tidak Ada', '', 'SUKIS SUWARSIH', 'TUGINO DWI HASTO', 'A', 'Kurikulum 2013', 'Swasta', 'Yayasan', 12, 28, 28, 6, 6, 3, 1, 2, '-6.211500', '106.858900', '', 1, 3),
(48, 48, 'SMA', '6', '5', '11470', 'TANJUNG DUREN UTARA', '31', '3174', '3174040', '17', '2011-09-29', '4800/-1.851.68', '2013-07-24', 'Tidak ada', 'SMA AL-CHASANAH', 'DKI', 'Capem Tanjung Duren', '', '', '2260', '0', '', '', '5637640', 'http://www.smaalchasanah-jkt.sch.co.id', 'Pagi', 'Bersedia Menerima', 'Belum Bersertifikat', 'PLN', '13000', 'Telkom Speedy', '', 'SUYANTO', 'Lia Kurniasari', 'A', 'Kurikulum 2013', 'Swasta', 'Yayasan', 15, 157, 130, 9, 9, 2, 1, 2, '-6.174200', '106.779900', '', 1, 3),
(49, 49, 'SMA', '3', '6', '11460', 'Wijaya Kesuma', '31', '3174', '3174040', '-', '2015-10-16', '-', '2015-10-16', 'Tidak ada', '41199.51426', '', '', '', '', '1050', '0', '', '', '', 'http://www.smagalatia2@yahoo.co.id', 'Sehari penuh (5 h/m)', 'Bersedia Menerima', 'Belum Bersertifikat', 'PLN', '44000', 'Telkomsel Flash', '', 'ARIARTO NUGRAHA', 'Kamidi', 'B', 'Kurikulum 2013', 'Swasta', 'Yayasan', 8, 8, 4, 2, 5, 1, 1, 2, '-6.155900', '106.776000', '', 1, 3),
(50, 50, 'SMA', '0', '0', '11470', 'Tanjung Duren Utara', '31', '3174', '3174040', 'no 89 tgl 19 juli 1950', '1950-07-19', '4053/-1.851.68', '2013-05-28', 'Tidak ada', 'SMAK 1 PENABUR Jakarta', 'Mandiri', 'Tanjung Duren', '', '', '20490', '2', '', '', '021-56961513', 'http://www.smak1.bpkpenaburjakarta.or.id', 'Sehari penuh (5 h/m)', 'Tidak Bersedia Menri', 'Proses Sertifikasi', 'PLN &amp; Diesel', '197000', 'Telkomsel Flash', '', 'Endang Setyowati', 'Wahyu Dwi Prasetyo', 'A', 'Kurikulum 2013', 'Swasta', 'Yayasan', 61, 447, 515, 28, 35, 5, 1, 0, '-6.174300', '106.781300', '', 1, 3),
(51, 51, 'SMA', '9', '5', '11470', 'TANJUNG DUREN UTARA', '31', '3174', '3174040', 'SP.345/I01.1A/I.85', '1985-02-09', '1411/101-4/R.4/1979', '1979-09-26', 'Tidak ada', 'SMA YADIKA 1', 'BANK DKI', '-', '', '', '3410', '0', '', '', '5671833', 'http://www.smayadika1.com', 'Sehari penuh (5 h/m)', 'Bersedia Menerima', 'Proses Sertifikasi', 'PLN', '0', 'Tidak Ada', '', 'LUKY MARDIANA', 'Evi Henry Fernandos Ambarita, ', 'A', 'Kurikulum 2013', 'Swasta', 'Yayasan', 21, 219, 162, 12, 12, 4, 1, 2, '-6.178000', '106.781700', '', 1, 3),
(52, 52, 'SMA', '12', '4', '11460', 'JELAMBAR', '31', '3174', '3174040', 'A.022/SWT/PMUA/1975', '1975-01-06', 'Kep.467A/101.A1/1/90', '1990-03-19', 'Tidak ada', 'SMA BUNDA HATI KUDUS', 'BANK DKI', 'Juanda', '', '', '3655', '0', '', '', '5637339', 'http://astidharma.sch.id', 'Sehari penuh (5 h/m)', 'Bersedia Menerima', 'Belum Bersertifikat', 'PLN &amp; Diesel', '131000', 'Tidak Ada', '', 'B. RENITA MULYANINGTYAS', 'Teguh Riyanto', 'A', 'Kurikulum 2013', 'Swasta', 'Yayasan', 27, 207, 152, 15, 21, 5, 1, 1, '-6.164200', '106.785700', '', 1, 3),
(53, 53, 'SMA', '7', '1', '11460', 'Jelambar', '31', '3174', '3174040', '478A/101.A1/I/1990', '1990-04-02', '796/-1.851.68', '2014-02-06', 'Tidak ada', 'SMA Dharma Jaya', 'BANK DKI', 'Capem Tanjung Duren', '', '', '4000', '0', '', '', '5658156', 'http://www.dharmajaya.ac.id', 'Sehari penuh (5 h/m)', 'Bersedia Menerima', 'Belum Bersertifikat', 'PLN', '3000', 'Telkom Speedy', '', 'Iyun Anomsari Antonio', 'Ade Sukendar', 'A', 'Kurikulum 2013', 'Swasta', 'Yayasan', 9, 77, 48, 7, 7, 3, 1, 2, '-6.156000', '106.785900', '', 1, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `b_school_detail`
--
ALTER TABLE `b_school_detail`
  ADD PRIMARY KEY (`schooldetailid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `b_school_detail`
--
ALTER TABLE `b_school_detail`
  MODIFY `schooldetailid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
