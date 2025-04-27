-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2025 at 12:53 PM
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
('184A-23FS-A4A2', 112, 1),
('184A-23FS-VSA2', 106, 1),
('184A-23FS-VSAH', 114, 1),
('184A-23FS-VSAJ', 108, 0),
('184A-G3FS-VSA2', 120, 1),
('953A-23FS-VSA2', 114, 1),
('982A-23FS-VSA2', 104, 1),
('982A-23FS-VSHS', 104, 1),
('982A-73FS-VS31', 108, 1),
('982A-73FS-VSA3', 102, 1),
('A1D4-FS7G-BNM3', 103, 0),
('A7D3-FG4K-LMN5', 107, 0),
('A9D1-FS4G-BNM7', 102, 1),
('AD3F-SFA4-SAFD', 100, 0),
('ADAF-SFA4-SAFD', 112, 0),
('ADAF-SFA4-SAFG', 117, 1),
('AF2A-73FS-VSA2', 115, 1),
('AF3D-ZXMS-QWER', 118, 1),
('ASD1-FGH2-JKL3', 113, 1),
('ASD1-FGH2-JKL8', 117, 1),
('ASD4-YUI5-JKL6', 114, 1),
('ASDF-BVCX-QWER', 115, 0),
('ASDF-GHMK-ZXCV', 119, 1),
('B4E7-HY78-PLKM', 116, 0),
('B4G6-HJ7K-PLM9', 100, 0),
('B4G7-HY78-PLKM', 112, 0),
('B7C5-VX3N-LMO1', 109, 1),
('B8C6-VX4N-LMO2', 110, 0),
('BVC7-POI8-PLM9', 114, 1),
('C2V5-XT8U-KJH9', 103, 1),
('C2X6-VB9M-NOP3', 106, 0),
('C5V3-XT8U-PLM2', 102, 1),
('C6X2-VB3M-NOP9', 108, 0),
('C8D2-QR5T-VBN6', 100, 0),
('E3R6-YQ9T-OPZ1', 104, 1),
('E6R4-YQ9T-OPZ5', 102, 1),
('E9F1-YU3I-OPZ4', 100, 0),
('F3D6-GH9K-LME1', 108, 1),
('F3D6-GH9K-LMN1', 106, 1),
('F7D3-GH4K-LM9N', 105, 0),
('G4H7-AS2D-XCV5', 104, 1),
('G5H3-XC8V-BNM1', 100, 0),
('G7H2-AS1D-KJH8', 102, 1),
('H4J9-KG2D-MLN6', 109, 1),
('H5J1-KG3D-MLN7', 110, 1),
('H9J3-KL4M-NOP5', 104, 1),
('HG6D-KO8S-LMNP', 118, 1),
('J4K7-HG2D-MLN5', 108, 1),
('J4K7-HG3D-MLN5', 106, 1),
('J4K8-HG2D-MLN9', 107, 0),
('J7K4-DF9Q-WER2', 100, 1),
('J8K5-WE3R-XCV9', 102, 1),
('JKL0-BVC1-XCV2', 114, 1),
('K1L3-MN4O-PQZ5', 109, 1),
('K2L4-MN5O-PQZ6', 110, 1),
('K8J2-HG5D-MLN9', 105, 0),
('KEH8-TR45-YUIO', 116, 1),
('KJH8-TR45-YUIO', 112, 1),
('LKJ0-POI1-ASD2', 113, 1),
('LKJ0-POI1-ASUL', 117, 1),
('LKJH-G1DS-QWER', 122, 0),
('LKJH-GFC6-WERT', 119, 1),
('LKJH-TRFG-YTRE', 115, 0),
('LKOP-MN9V-CXZ3', 120, 0),
('M8N6-PO1L-KJH5', 101, 0),
('M9N7-PO2L-QT5R', 102, 1),
('MABV-CX23-UIOP', 116, 1),
('MN34-ASD5-FGH6', 114, 1),
('MNBV-C8ZS-RTYU', 122, 0),
('MNBV-CX23-UIOP', 112, 1),
('MNBV-CX9Y-LOPQ', 118, 1),
('MNBV-CXJS-RTYU', 119, 1),
('OA90-ASDF-QWER', 116, 1),
('OP90-ASDF-QWER', 112, 1),
('P1O5-QT7R-YU8I', 105, 0),
('P1Q3-YU4I-BNM6', 103, 1),
('P2Q4-YT7U-XCV3', 101, 1),
('P8Q2-YO5T-AXW9', 109, 1),
('P9O5-QY7T-RUI8', 107, 0),
('P9Q3-YO6T-AXW1', 110, 1),
('PLKM-JN8B-GVF6', 120, 1),
('PLKM-JNCB-GVF6', 122, 1),
('POIU-Y8RE-WXCV', 122, 1),
('POIU-YTME-BNMQ', 119, 1),
('POIU-YTRE-MNBV', 115, 1),
('Q5T7-UI8O-PZX2', 104, 1),
('QAZW-ED8V-TYUI', 118, 1),
('QAZW-EXCV-TYUI', 122, 1),
('QWDS-FG4B-YUIO', 120, 1),
('QWE4-RTY5-UIO6', 113, 1),
('QWE4-RTY5-UIOR', 117, 1),
('QWER-POIU-LKJH', 115, 1),
('QWERT-YNIOP-PLMN', 119, 1),
('R3T6-YQ9O-APD1', 105, 1),
('R5S2-DF9Q-XT7U', 103, 1),
('R9D3-GH4K-LMN5', 108, 1),
('R9S1-AS4D-GHJ7', 101, 1),
('RTY3-FGH4-VBN5', 113, 1),
('RTY3-FGH4-VPI5', 117, 1),
('RTY7-MNB8-UIO9', 114, 1),
('S9D3-GK4H-LMN5', 106, 1),
('T5U3-WE8R-PLM2', 101, 1),
('T6R8-UI9O-WXP2', 109, 1),
('T6U4-WE8R-KJH1', 103, 1),
('T7Q2-YO4P-AWX6', 107, 0),
('T7R9-UI1O-WXP3', 110, 1),
('T8Q2-YO3P-AWX9', 108, 1),
('T8Q2-YO5P-AWX9', 106, 1),
('TGBN-YHDD-WSXC', 118, 1),
('TR67-GH56-V9NM', 116, 1),
('TR67-GH56-VBNM', 112, 1),
('TYU6-HJK7-UIO8', 113, 1),
('TYU6-HJR7-UIO8', 117, 1),
('TYUI-VB4M-ASDF', 120, 1),
('UA3A-24FS-VSA2', 117, 1),
('UY2A-24FS-VSA2', 101, 1),
('UY2A-24FS-VSAN', 106, 1),
('UY2A-73FS-VSA2', 100, 1),
('V6B4-XC9N-OPZ7', 101, 1),
('V7B3-XC9N-OPZ5', 103, 1),
('VFR6-TG5N-MKLO', 118, 1),
('W1E5-RY7Q-AOP8', 106, 1),
('W2E5-RY7Q-AOP8', 108, 1),
('W3E5-RY9Q-AOP1', 107, 0),
('W3E6-RY9Q-AS1D', 104, 1),
('X2C6-VB9N-MOP3', 105, 1),
('X6C2-VB3N-MOP5', 107, 1),
('XCDS-FV4B-HNJK', 120, 1),
('XCDS-FV8B-HNJK', 122, 1),
('XCV1-TRE2-RTY3', 114, 1),
('Y8U2-QT5R-KJH3', 101, 1),
('Y9U2-QT5R-PLM8', 103, 1),
('YU78-MA34-ASDF', 116, 1),
('YU78-MN34-ASDF', 112, 1),
('YUIO-RTYU-GHJK', 115, 1),
('Z3E6-RY7Q-AOP1', 109, 1),
('Z4E7-RY8Q-AOP2', 110, 1),
('Z4Y7-UI3O-PQX5', 105, 1),
('ZXC7-VBN8-MNB9', 113, 1),
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
  `Kljuc_ID` varchar(19) NOT NULL,
  `Datum` timestamp NULL DEFAULT NULL,
  `broj_racuna` varchar(50) NOT NULL,
  `Cena` decimal(8,2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `Datum` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Kolicina` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
('6wIuSZdvvRKeaA1GdfRlNWMbHNek8mi4OZQ6ED20', 21, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36 Herring/90.1.1620.7', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoieWdzR0ppSHhxNVQwOXdpRFlOSHg4QzlMeDVtZnFaZThXRndoWThnTiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTg6Imh0dHA6Ly9nYW1taW5nLm9yZyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjIxO30=', 1745758381);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Ime` varchar(255) NOT NULL,
  `prezime` varchar(25) NOT NULL,
  `broj_racuna` bigint(20) UNSIGNED DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `broj_kupljenih_igara` int(10) UNSIGNED DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `Ime`, `prezime`, `broj_racuna`, `email`, `email_verified_at`, `password`, `status`, `broj_kupljenih_igara`, `remember_token`, `created_at`, `updated_at`) VALUES
(21, 'Michael', 'Johnson', NULL, 'Johnson_23@gmail.com', NULL, '$2y$12$65ZEMUWHYcQ8G4OrOlync.Rrgm3pAAlGZSBMopLO0aTWRWOtOYx5q', 1, NULL, NULL, '2025-04-27 10:48:28', '2025-04-27 10:48:28'),
(22, 'Andrija', 'Nikodinovic', NULL, 'Nikodinovic_42@gmail.com', NULL, '$2y$12$mfU9Nb3hzLcMjNi4b.aA6elG18CqCHUU8gtOZzJXP/M7pE6qtoHK.', 0, NULL, NULL, '2025-04-27 10:50:11', '2025-04-27 10:50:11'),
(23, 'Pera', 'Ilic', NULL, 'IlicPera@gmail.com', NULL, '$2y$12$yVUi0NKn3tF99wEBFY/jmeSk9SOMiBgMtRk8E6f/T01buBF4cgq0u', 0, NULL, NULL, '2025-04-27 10:52:34', '2025-04-27 10:52:34');

-- --------------------------------------------------------

--
-- Table structure for table `video_igra`
--

CREATE TABLE `video_igra` (
  `Igra_ID` int(10) UNSIGNED NOT NULL,
  `Izdavac_ID` int(10) UNSIGNED DEFAULT NULL,
  `Naziv` varchar(120) NOT NULL,
  `Cena_Igre` decimal(8,2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `video_igra`
--

INSERT INTO `video_igra` (`Igra_ID`, `Izdavac_ID`, `Naziv`, `Cena_Igre`) VALUES
(100, 1, 'FIFA 24', 7000.00),
(101, 1, 'Battlefield 2042', 6500.00),
(102, 1, 'The Sims 4', 3000.00),
(103, 1, 'Need for Speed Unbound', 6000.00),
(104, 1, 'Mass Effect Legendary Edition', 5500.00),
(105, 2, 'Assassin’s Creed Mirage', 7000.00),
(106, 2, 'Far Cry 6', 6500.00),
(107, 2, 'Tom Clancy’s Rainbow Six Siege', 4000.00),
(108, 1, 'Watch Dogs Legion', 3500.00),
(109, 2, 'Immortals Fenyx Rising', 5500.00),
(110, 3, 'Call of Duty Modern Warfare II', 7500.00),
(112, 3, 'World of Warcraft Dragonflight', 4500.00),
(113, 3, 'Crash Bandicoot 4 It’s About Time', 5000.00),
(114, 3, 'Diablo II Resurrected', 4500.00),
(115, 4, 'God of War Ragnarok', 8000.00),
(116, 4, 'The Last of Us Part II', 5500.00),
(117, 4, 'Marvel’s Spider-Man Miles Morales', 6000.00),
(118, 4, 'Horizon Forbidden West', 7000.00),
(119, 4, 'Ratchet & Clank Rift Apart', 6500.00),
(120, 5, 'The Legend of Zelda Tears of the Kingdom', 7000.00),
(122, 5, 'Mario Kart 8 Deluxe', 5000.00),
(123, 2, 'Tom Clancy’s The Division 2', 5600.00);

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
  ADD KEY `fk_kupovina_korisnik` (`Korisnik_ID`);

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
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `BrojRacuna` (`broj_racuna`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kupovina`
--
ALTER TABLE `kupovina`
  MODIFY `Kupovina_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rezervacija`
--
ALTER TABLE `rezervacija`
  MODIFY `Rezervacija_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `video_igra`
--
ALTER TABLE `video_igra`
  MODIFY `Igra_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

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
