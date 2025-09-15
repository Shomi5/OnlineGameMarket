-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 07, 2025 at 09:44 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_prodaja_igara`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('5c785c036466adea360111aa28563bfd556b5fba', 'i:1;', 1756844131),
('5c785c036466adea360111aa28563bfd556b5fba:timer', 'i:1756844131;', 1756844131);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `izdavac`
--

CREATE TABLE `izdavac` (
  `Izdavac_ID` int(10) UNSIGNED NOT NULL,
  `Naziv` varchar(50) NOT NULL,
  `PIB` bigint(20) UNSIGNED NOT NULL,
  `Adresa` varchar(150) NOT NULL,
  `BrojRacuna` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `izdavac`
--

INSERT INTO `izdavac` (`Izdavac_ID`, `Naziv`, `PIB`, `Adresa`, `BrojRacuna`) VALUES
(1, 'Electronic Arts (EA)', 987654321, '209 Redwood Shores Parkway, Redwood City, CA 94065, USA', '10-3456789012345678-90'),
(2, 'Ubisoft', 123456789, ' 28 Rue Armand Carrel, 93100 Montreuil, France', '20-4567890123456789-10'),
(3, 'Activision Blizzard', 564738291, '2701 Olympic Boulevard, Santa Monica, CA 90404, USA', '30-5678901234567890-20'),
(4, 'Sony Interactive Entertainment', 876543210, '2207 Bridgepointe Parkway, San Mateo, CA 94404, USA', '40-6789012345678901-30'),
(5, 'Nintendo', 192837465, '11-1 Hokotate-cho, Kamitoba, Minami-ku, Kyoto 601-8501, Japan', '50-7890123456789012-40');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

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
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategorija`
--

CREATE TABLE `kategorija` (
  `Kategorija_ID` int(10) UNSIGNED NOT NULL,
  `NazviKategorije` varchar(50) NOT NULL,
  `BrojIgara` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategorija_igra`
--

CREATE TABLE `kategorija_igra` (
  `Igra_ID` int(10) UNSIGNED NOT NULL,
  `Kategorija_ID` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kljuc`
--

CREATE TABLE `kljuc` (
  `Kljuc_ID` varchar(19) NOT NULL,
  `Igra_ID` int(10) UNSIGNED NOT NULL,
  `Status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kljuc`
--

INSERT INTO `kljuc` (`Kljuc_ID`, `Igra_ID`, `Status`) VALUES
('184A-23FS-A4A2', 112, 0),
('184A-23FS-VSAH', 114, 1),
('184A-G3FS-VSA2', 120, 1),
('7KX9-2LPQ-M5ZD', 141, 1),
('953A-23FS-VSA2', 114, 1),
('982A-23FS-2456', 105, 0),
('982A-23FS-24GD', 106, 1),
('982A-23FS-AAAA', 106, 0),
('982A-23FS-DFDG', 117, 0),
('982A-23FS-GB54', 104, 1),
('982A-23FS-H53F', 105, 1),
('982A-23FS-HHGJ', 103, 1),
('982A-23FS-HHHH', 106, 0),
('982A-23FS-HJFD', 106, 1),
('982A-23FS-JY3B', 106, 1),
('982A-23FS-VD42', 120, 1),
('982A-23FS-VGS2', 114, 1),
('982A-23FS-VSA2', 104, 1),
('982A-23FS-VSHS', 104, 1),
('982A-73FS-VS31', 108, 1),
('ADAF-SFA4-SAFG', 117, 1),
('AF2A-73FS-VSA2', 115, 1),
('AF3D-ZXMS-QWER', 118, 1),
('ASD1-FGH2-JKL8', 117, 1),
('ASD4-YUI5-JKL6', 114, 1),
('ASDF-GHMK-ZXCV', 119, 1),
('B7C5-VX3N-LMO1', 109, 0),
('B7QL-KN9X-RW4P', 142, 0),
('BVC7-POI8-PLM9', 114, 1),
('C2V5-XT8U-KJH9', 103, 1),
('D7PX-QV6Z-JE1M', 141, 1),
('D93K-WQTL-7ZMX', 142, 1),
('E3R6-YQ9T-OPZ1', 104, 1),
('E9F1-YU3I-OPZ4', 118, 1),
('F3D6-GH9K-LME1', 108, 1),
('G4H7-AS2D-XCV5', 104, 1),
('H4J9-KG2D-MLN6', 109, 0),
('H5J1-KG3D-MLN7', 110, 0),
('H9J3-KL4M-NOP5', 104, 1),
('HG6D-KO8S-LMNP', 118, 1),
('J3A4-WXNT-7V6K', 141, 1),
('J4K7-HG2D-MLN5', 108, 1),
('JKL0-BVC1-XCV2', 114, 1),
('JX7P-QT4L-9ZFD', 142, 1),
('K0Y3-R2WB-GN6V', 141, 1),
('K1L3-MN4O-PQZ5', 109, 1),
('K2L4-MN5O-PQZ6', 110, 1),
('KDL4-ZXQM-R9TP', 142, 1),
('KEH8-TR45-YUIO', 116, 1),
('KJH8-TR45-YUIO', 112, 1),
('L6VB-XPQ9-0AZW', 141, 1),
('LKJ0-POI1-ASUL', 117, 1),
('LKJH-GFC6-WERT', 119, 1),
('MABV-CX23-UIOP', 116, 1),
('MN34-ASD5-FGH6', 114, 1),
('MNBV-CX23-UIOP', 112, 1),
('MNBV-CX9Y-LOPQ', 118, 1),
('MNBV-CXJS-RTYU', 119, 1),
('MW2C-8LKV-ZX93', 142, 1),
('OA90-ASDF-QWER', 116, 1),
('OP90-ASDF-QWER', 112, 1),
('P1Q3-YU4I-BNM6', 103, 1),
('P8Q2-YO5T-AXW9', 109, 1),
('P9Q3-YO6T-AXW1', 110, 1),
('PLKM-JN8B-GVF6', 120, 1),
('PLKM-JNCB-GVF6', 122, 1),
('POIU-Y8RE-WXCV', 122, 1),
('POIU-YTME-BNMQ', 119, 1),
('POIU-YTRE-MNBV', 115, 1),
('Q5T7-UI8O-PZX2', 104, 1),
('Q98D-KL7B-ZX5P', 141, 1),
('QAZW-ED8V-TYUI', 118, 1),
('QAZW-EXCV-TYUI', 122, 1),
('QWDS-FG4B-YUIO', 120, 1),
('QWE4-RTY5-UIOR', 117, 1),
('QWER-POIU-LKJH', 115, 1),
('QWERT-YNIOP-PLMN', 119, 1),
('R3T6-YQ9O-APD1', 105, 0),
('R5S2-DF9Q-XT7U', 103, 1),
('R9D3-GH4K-LMN5', 108, 1),
('RPLD-MN3X-KTV7', 142, 1),
('RTY3-FGH4-VPI5', 117, 1),
('RTY7-MNB8-UIO9', 114, 1),
('T6R8-UI9O-WXP2', 109, 1),
('T6U4-WE8R-KJH1', 103, 1),
('T7R9-UI1O-WXP3', 110, 1),
('T8Q2-YO3P-AWX9', 108, 1),
('TGBN-YHDD-WSXC', 118, 1),
('TR67-GH56-V9NM', 116, 1),
('TR67-GH56-VBNM', 112, 1),
('TR7M-XQL8-BN39', 142, 1),
('TRM4-9YQE-21AX', 141, 1),
('TYU6-HJR7-UIO8', 117, 1),
('TYUI-VB4M-ASDF', 120, 1),
('UA3A-24FS-VSA2', 117, 1),
('V7B3-XC9N-OPZ5', 103, 1),
('VFR6-TG5N-MKLO', 118, 1),
('W2E5-RY7Q-AOP8', 108, 1),
('W3E6-RY9Q-AS1D', 104, 1),
('WMC7-PLQZ-48XK', 142, 1),
('X2C6-VB9N-MOP3', 105, 1),
('X6C2-VB3N-MOP5', 107, 1),
('XCDS-FV4B-HNJK', 120, 1),
('XCDS-FV8B-HNJK', 122, 1),
('XCV1-TRE2-RTY3', 114, 1),
('XPTL-93KD-MCZ8', 142, 1),
('Y4CZ-MN8V-KJ3D', 141, 1),
('Y9U2-QT5R-PLM8', 103, 1),
('YU78-MA34-ASDF', 116, 1),
('YU78-MN34-ASDF', 112, 1),
('YUIO-RTYU-GHJK', 115, 1),
('Z3E6-RY7Q-AOP1', 109, 1),
('Z4E7-RY8Q-AOP2', 110, 1),
('Z4Y7-UI3O-PQX5', 105, 1),
('Z9FK-2PLD-VXNM', 142, 1),
('ZXC7-VJK0-MNB9', 117, 1),
('ZXCV-ASDF-QWER', 114, 1),
('ZXCV-BN96-WERT', 120, 1),
('ZXCV-BNM7-PLKJ', 112, 1),
('ZXCV-BNM7-PLLJ', 116, 1),
('ZXCV-MNBV-ASDF', 115, 1);

-- --------------------------------------------------------

--
-- Table structure for table `kupovina`
--

CREATE TABLE `kupovina` (
  `Kupovina_ID` int(10) UNSIGNED NOT NULL,
  `Korisnik_ID` bigint(20) UNSIGNED NOT NULL,
  `Igra_ID` int(10) UNSIGNED NOT NULL,
  `Kljuc_ID` varchar(19) NOT NULL,
  `Datum` timestamp NULL DEFAULT NULL,
  `broj_racuna` varchar(50) NOT NULL,
  `Cena` decimal(8,2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kupovina`
--

INSERT INTO `kupovina` (`Kupovina_ID`, `Korisnik_ID`, `Igra_ID`, `Kljuc_ID`, `Datum`, `broj_racuna`, `Cena`) VALUES
(91, 25, 106, '982A-23FS-HHHH', '2025-07-30 21:31:49', '12-23133241-24', 6500.00),
(93, 25, 106, '982A-23FS-AAAA', '2025-07-30 21:33:46', '12-23133241-24', 6500.00),
(105, 25, 117, '982A-23FS-DFDG', '2025-08-18 10:35:53', '12-23133241-24', 4000.00),
(108, 25, 105, '982A-23FS-2456', '2025-08-30 13:07:20', '12-23133241-24', 7000.00),
(109, 25, 110, 'H5J1-KG3D-MLN7', '2025-08-30 19:43:17', '12-23133241-24', 7500.00),
(110, 29, 142, 'B7QL-KN9X-RW4P', '2025-09-01 07:28:54', '12-23133541-24', 4500.00);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rezervacija`
--

CREATE TABLE `rezervacija` (
  `Rezervacija_ID` int(10) UNSIGNED NOT NULL,
  `Igra_ID` int(10) UNSIGNED NOT NULL,
  `Korisnik_ID` bigint(20) UNSIGNED NOT NULL,
  `Datum` timestamp NOT NULL DEFAULT current_timestamp(),
  `datumObrade` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `Kolicina` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `statusRezervacija` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rezervacija`
--

INSERT INTO `rezervacija` (`Rezervacija_ID`, `Igra_ID`, `Korisnik_ID`, `Datum`, `datumObrade`, `Kolicina`, `statusRezervacija`) VALUES
(67, 142, 28, '2025-09-01 09:25:57', NULL, 1, 0),
(68, 141, 28, '2025-09-01 09:26:19', NULL, 1, 0),
(69, 142, 29, '2025-09-01 09:26:51', '2025-09-01 09:28:54', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('lFCDgyQsiq4s7sSqWw7fhuM87O9G3WeBHd40Zsoy', 25, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSHRBMHEwTFdaUmVYNGs5WHpNWTJadXlqVUJZSFJZVGh0UFJhWkx1YyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Nzg6Imh0dHA6Ly9nYW1taW5nLmNvbS9wcm9kYWphL0NyYXNoJTIwQmFuZGljb290JTIwNCUyMEl0JUUyJTgwJTk5cyUyMEFib3V0JTIwVGltZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI1O30=', 1756719989),
('yrFSiobz3JtPkZAutRgdW7r1g6Z49K2fxMFG6NWb', 25, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZ0Q0V1J3Y1hsQk1OelliSEl4dkF5NVZsQkNKNXJYUWlzbDY1SjdGRCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTI6Imh0dHA6Ly9nYW1taW5nLmNvbS9hZG1pblBhbmVsL3VwcmF2bGphbmplVmlkZW9JZ3JhbWEiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyNTt9', 1756844532);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Ime` varchar(255) NOT NULL,
  `prezime` varchar(25) NOT NULL,
  `broj_racuna` varchar(50) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `statusRezerKorisnika` tinyint(4) NOT NULL DEFAULT 0,
  `broj_kupljenih_igara` int(10) UNSIGNED DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `Ime`, `prezime`, `broj_racuna`, `email`, `email_verified_at`, `password`, `status`, `statusRezerKorisnika`, `broj_kupljenih_igara`, `remember_token`, `created_at`, `updated_at`) VALUES
(25, 'Admin', 'Lazarević', '12-23133241-24', 'admin@gmail.com', NULL, '$2y$12$5KtvKFLh6r7a/wPiaN.Z9uRWJgV4Dy0AGB0C4/tkuSYxBEp/WLDKa', 1, 1, NULL, NULL, '2025-07-23 10:42:18', '2025-08-31 15:40:48'),
(28, 'Sanja', 'Dimitrijević', NULL, 'dimi123@gmail.com', NULL, '$2y$12$bvYsnhwZZbrN0HoPP723CeTPDTKABC9zT.1chzxsp9H3Yx7KRhwna', 2, 0, NULL, NULL, '2025-08-10 19:47:42', '2025-09-01 07:21:57'),
(29, 'Pera', 'Nikolic', '12-23133541-24', 'niko123@gmail.com', NULL, '$2y$12$1.PfHpAC0MxiySK/XZzO5.hCND.xfdEZ.EJhHg//LiaTtSazcreG6', 0, 0, NULL, NULL, '2025-08-26 11:16:44', '2025-09-01 07:28:54');

-- --------------------------------------------------------

--
-- Table structure for table `video_igra`
--

CREATE TABLE `video_igra` (
  `Igra_ID` int(10) UNSIGNED NOT NULL,
  `Izdavac_ID` int(10) UNSIGNED DEFAULT NULL,
  `Naziv` varchar(120) NOT NULL,
  `opisIgre` varchar(500) DEFAULT NULL,
  `Cena_Igre` decimal(8,2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `video_igra`
--

INSERT INTO `video_igra` (`Igra_ID`, `Izdavac_ID`, `Naziv`, `opisIgre`, `Cena_Igre`) VALUES
(103, 1, 'Need for Speed Unbound', 'Ušunjite se u ulične trke u Need for Speed Unbound! Izazovite zakone, pobedite rivalstva i ostvarite legendarni status u ovoj arkanoidnoj trci za prvaka. Brzina, stil i pobeda - sve je dozvoljeno!', 6000.00),
(104, 1, 'Mass Effect Legendary Edition', 'Uđi u svemirsku avanturu u Mass Effect Legendary Edition! Kao kapetan Shepard, spasi čovečanstvo od uništenja u ratu protiv neprijateljskih vanzemaljaca. Istraži galaksiju, razvijaj svoje sposobnosti i donesi odluke koje će promeniti sudbinu svemira.', 5500.00),
(105, 2, 'Assassin’s Creed Mirage', 'Ušunjite se u srce Bagdada, 9. veka, kao Basim Ibn Ishaq, mlad i ambiciozan asasin. Istražujte uske ulice i veličanstvene palate, boreći se protiv templara i otkrivajući misterije davnog grada.', 7000.00),
(106, 2, 'Far Cry 6', 'Ušunjite se u srce revolucije na ostrvu Yara, gdje se boriš protiv diktatorske vladavine Antona Kastila. Sa oružjem, eksplozivom i lukavstvom, vodi pobunu i oslobodi narod od tiranije.', 6500.00),
(107, 2, 'Tom Clancy’s Rainbow Six Siege', 'Ušunjite se u svet elitnih antiterorističkih jedinica u Tom Clancy\'s Rainbow Six Siege. Strategija, timski rad i brza reakcija su ključ uspeha u ovom napetu takmičarskom shooteru.', 4000.00),
(108, 1, 'Watch Dogs Legion', 'U Londonu budućnosti, revolucija je u punom zamahu. Pridruži se otporu kao bilo koji građanin koji se bori protiv tiranske vlade i korporativne vlasti. Svaki lik ima svoju jedinstvenu priču i vještine, a ti određuješ koji će biti heroj ovog otpora.', 3500.00),
(109, 2, 'Immortals Fenyx Rising', 'U ovom akcijsko-avanturističkom romanu, uzećete ulogu Fenyx, poluboga koji se bori protiv mitoloških čudovišta u ancient Grčkoj. Istražujte božanske krajobraze, rešavajte zagonetke i oslobodite bogove koji su zarobljeni u svojim vlastitim rajevima.', 5500.00),
(110, 3, 'Call of Duty Modern Warfare II', 'Ušunjeno u moderni rat, ti se boriš protiv globalne terorističke pretnje kao član elitnog tima specijalnih snaga. Intenzivne borbe, brze akcije i šokantne činjenice čekaju te u Call of Duty Modern Warfare II.', 7500.00),
(112, 3, 'World of Warcraft Dragonflight', 'Leti sa zmajevima kroz Azeroth! U World of Warcraft: Dragonflight, otkrij novu eru zmajeva i istražuj prostrane krajeve, dok se boriš protiv mraka koji preti ovom svetu. Sjedini se sa zmajevima i spasi Azeroth!', 4500.00),
(114, 3, 'Diablo II Resurrected', 'Vraćaj se u mraku koji je oblio san, u svet demonske osvete. Diablo II Resurrected donosi obnovljeni klasik, sa poboljšanim grafikom i istim užasnim bojama koji će te zadržati na ivici stolice.', 4500.00),
(115, 4, 'God of War Ragnarok', 'Uzmi čelik u ruke i pripremi se za epsku borbu! God of War Ragnarok donosi novu avanturu Kratosa i Atrea kroz mračne zemlje Nordlanda, gde ih čekaju strašni bogovi i čudovišta. Borba za opstanak počinje!', 8400.00),
(116, 4, 'The Last of Us Part II', 'U post-apokaliptičnom svetu zaraze, Ellie kreće u osvetničku misiju protiv onih koji su joj uništili život. Suočena sa mržnjom, gorčinom i uništenjem, mora da se suoči sa samom sobom i otkrije šta joj ostaje od čovečnosti.', 5500.00),
(117, 4, 'Marvel’s Spider-Man Miles Morales', 'U ovom akcionom avanturi, preuzmite kontrolu nad Milesom Moralesom, mladim Spider-Manom koji se bori protiv zlikovaca na ulicama New Yorka. Istražite grad, koristite svoje čudesne moći i spasite grad od uništenja!', 4000.00),
(118, 4, 'Horizon Forbidden West', 'Ušunjena zemlja, izgubljena civilizacija, a ti si Aloy, lovkinja koji se bori za opstanak u svetu zauzetom mehaničkim stvorenjima. Istraži tajanstvenu Zapadnu granicu, otkrij skrivene tajne i pobedi neprijatelje u ovom epskom avanturi.', 7000.00),
(119, 4, 'Ratchet & Clank Rift Apart', 'Uzmi oružje i pridruži se Ratchetu i Clanku u njihovom najnovijem avanturi! Proputujte se kroz dimenzije, spremajući se za čiste akcije, ludilo i neverovatne tehničke inovacije u Rift Apart, najboljoj igri iz serijala!', 5500.00),
(120, 5, 'The Legend of Zelda Tears of the Kingdom', 'U novom čudesnom svetu Hyrulea, Link mora da spasi kraljevstvo od uništenja. Sa svojom snagom i mudrošću, mora da razreši misterije i pobedi neprijatelje kako bi vratio mir u kraljevstvo.', 7000.00),
(122, 5, 'Mario Kart 8 Deluxe', 'Utrkajte se sa prijateljima i porodicom u najbržoj i najluđoj trci ikad! Mario Kart 8 Deluxe donosi neverovatne staze, novitetne vozilo i karaktere, kao i mogućnost igranja sa 8 igrača lokalno ili online. Pripremite se za neverovatnu zabavu!', 5000.00),
(123, 2, 'Tom Clancy’s The Division 2', 'U ruševnom Washingtonu D.C., kao član elitne jedinice Division, borite se protiv kriminala i korupcije. Istražite razorene ulice, skupljajte resurse i savladajte neprijatelje kako biste obnovili red i stabilnost u gradu.', 5600.00),
(141, 1, 'FIFA 25', 'Na vratima svetskog fudbala, FIFA 25 donosi novu razinu konkurencije. Igraj kao najbolji tim u svetu, ili kao jedan od njih. Izbor od preko 20.000 igrača i 700 timova. Kreativni napadi, precizni udarci i strategija pobede. FIFA 25 - jedan jezik, jedan svet, jedan fudbal.', 3500.00),
(142, 3, 'Battlefield 2042', 'Battlefield 2042 je episka prva ličinska igra sa velikim okružjem, koja vam pruža nevjerojatnu doživljaj ratovanja u budućnosti. Igrajte kao član elitne jedinice koji se bori za prevlast u svetu koji je na granici propasti.', 4500.00),
(143, 5, 'Crash Bandicoot 4 It’s About Time', 'U svemiru se odvija episka avantura Crash Bandicoota, koji se suočava sa novoizdanim neprijateljem - Džejkuom i njegovom sestrom. U ovom nastavku, Crash mora da se suoči sa teškim izazovima, raznovrsnim karakterima i izvrsnim grafikama. Igrač će morati da upotrebi Crashove sposobnosti da bi otkrio tajne svemira i spasao svetske zvezde.', 3400.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `izdavac`
--
ALTER TABLE `izdavac`
  ADD PRIMARY KEY (`Izdavac_ID`),
  ADD UNIQUE KEY `PIB` (`PIB`),
  ADD UNIQUE KEY `BrojRacuna` (`BrojRacuna`),
  ADD UNIQUE KEY `BrojRacuna_2` (`BrojRacuna`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategorija`
--
ALTER TABLE `kategorija`
  ADD PRIMARY KEY (`Kategorija_ID`);

--
-- Indexes for table `kategorija_igra`
--
ALTER TABLE `kategorija_igra`
  ADD PRIMARY KEY (`Igra_ID`,`Kategorija_ID`),
  ADD KEY `fk_kateigra_kategorija` (`Kategorija_ID`);

--
-- Indexes for table `kljuc`
--
ALTER TABLE `kljuc`
  ADD PRIMARY KEY (`Kljuc_ID`),
  ADD KEY `fk_kljuc_igra` (`Igra_ID`);

--
-- Indexes for table `kupovina`
--
ALTER TABLE `kupovina`
  ADD PRIMARY KEY (`Kupovina_ID`,`Korisnik_ID`,`Kljuc_ID`) USING BTREE,
  ADD UNIQUE KEY `Kljuc_ID` (`Kljuc_ID`),
  ADD KEY `fk_kupovina_korisnik` (`Korisnik_ID`),
  ADD KEY `fk_kupovina_igra` (`Igra_ID`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `rezervacija`
--
ALTER TABLE `rezervacija`
  ADD PRIMARY KEY (`Rezervacija_ID`,`Igra_ID`,`Korisnik_ID`),
  ADD KEY `fk_rezervacija_igra` (`Igra_ID`),
  ADD KEY `fk_rezervacija_korisnik` (`Korisnik_ID`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `video_igra`
--
ALTER TABLE `video_igra`
  ADD PRIMARY KEY (`Igra_ID`),
  ADD KEY `fk_igra_izdavac` (`Izdavac_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `izdavac`
--
ALTER TABLE `izdavac`
  MODIFY `Izdavac_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kupovina`
--
ALTER TABLE `kupovina`
  MODIFY `Kupovina_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rezervacija`
--
ALTER TABLE `rezervacija`
  MODIFY `Rezervacija_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `video_igra`
--
ALTER TABLE `video_igra`
  MODIFY `Igra_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kategorija_igra`
--
ALTER TABLE `kategorija_igra`
  ADD CONSTRAINT `fk_kateigra_igra` FOREIGN KEY (`Igra_ID`) REFERENCES `video_igra` (`Igra_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_kateigra_kategorija` FOREIGN KEY (`Kategorija_ID`) REFERENCES `kategorija` (`Kategorija_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kljuc`
--
ALTER TABLE `kljuc`
  ADD CONSTRAINT `fk_kljuc_igra` FOREIGN KEY (`Igra_ID`) REFERENCES `video_igra` (`Igra_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kupovina`
--
ALTER TABLE `kupovina`
  ADD CONSTRAINT `fk_kupovina_igra` FOREIGN KEY (`Igra_ID`) REFERENCES `video_igra` (`Igra_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_kupovina_kljuc` FOREIGN KEY (`Kljuc_ID`) REFERENCES `kljuc` (`Kljuc_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_kupovina_korisnik` FOREIGN KEY (`Korisnik_ID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rezervacija`
--
ALTER TABLE `rezervacija`
  ADD CONSTRAINT `fk_rezervacija_igra` FOREIGN KEY (`Igra_ID`) REFERENCES `video_igra` (`Igra_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rezervacija_korisnik` FOREIGN KEY (`Korisnik_ID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `video_igra`
--
ALTER TABLE `video_igra`
  ADD CONSTRAINT `fk_igra_izdavac` FOREIGN KEY (`Izdavac_ID`) REFERENCES `izdavac` (`Izdavac_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
