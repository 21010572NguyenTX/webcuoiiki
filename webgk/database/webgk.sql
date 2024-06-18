-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2024 at 08:25 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webgk`
--

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_06_07_131251_create_products_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `price` int(50) NOT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 'APOLLO I01 (I7 14700K/RTX 4070 TI) (POWERED BY ASUS)', 62999000, 'Thông số sản phẩm\r\nCPU : INTEL i7-14700K\r\nMAIN : Z790M\r\nRAM : 32GB (2x16GB) DDR5\r\nSSD : 512GB SSD\r\nVGA: RTX 4070 Ti\r\nNGUỒN : 850W\r\nTẢN NHIỆT NƯỚC ASUS TUF LC 360 ARGB', 'images/pfCvGgt1cV7PNHuL9bonE5BHQlYuVvldNT5Mom5q.webp', '2024-06-07 06:55:25', '2024-06-07 10:16:11'),
(2, 'MINI C2 WHITE V2 (I5 12400F/GTX 1660 SUPER)', 15499000, 'Thông số sản phẩm\r\nCPU : INTEL i5-12400F\r\nMAIN : B660M\r\nRAM : 8GB (1x8G) DDR4\r\nSSD : 500 GB SSD\r\nVGA: GTX 1660 Super\r\nNGUỒN : 550W', 'images/2y2ne5k63iD5DQNUu8BsxyhSj9bLREOmhL7Ne23e.webp', '2024-06-07 21:19:18', '2024-06-07 21:19:18'),
(3, 'POSEIDON (I7 13700F/RTX 4070)', 50599000, 'hông số sản phẩm\r\nCPU : INTEL i7-13700F\r\nMAIN : Z690\r\nRAM : 32GB (2x16G) DDR4\r\nSSD : 1TB SSD\r\nVGA: RTX 4070 12G\r\nNGUỒN : 750W', 'images/Im5FoHX5MVJhP35ntlurEZ3QB6hKdqcBJ97LVojC.webp', '2024-06-07 21:21:27', '2024-06-07 21:21:27'),
(4, 'SNIPER (R5 4600G/RADEON GRAPHICS)', 8499000, 'Thông số sản phẩm\r\nCPU : AMD Ryzen 5 4600G\r\nMAIN : B450\r\nRAM : 16GB DDR4\r\nSSD : 500GB SSD\r\nVGA: Radeon™ Graphics\r\nNGUỒN : 500W', 'images/Klhl7RWKWDPkNM5CoEKVDtm7pvWA0a60J7Po9wxN.webp', '2024-06-07 21:22:24', '2024-06-07 21:22:24'),
(5, 'SNIPER (I5 12400F/GTX 1660 SUPER)', 15299000, 'Thông số sản phẩm\r\nCPU : INTEL i5-12400F\r\nMAIN : B660M\r\nRAM : 8GB (1x8GB) DDR4\r\nSSD : 250GB SSD\r\nVGA: GTX 1660 Super 6GB\r\nNGUỒN : 500W', 'images/4jsDomirxeL9UwH13TuKXXRRgYdUjjJtnQ2BC6pr.webp', '2024-06-07 21:24:34', '2024-06-07 21:24:34'),
(6, 'ARES A6 (I3 1200F/GTX 1650/)', 10899000, 'Thông số sản phẩm\r\nCPU : Intel Core i3-12100F\r\nMAIN : H610\r\nRAM : 8GB DDR4\r\nSSD : 250GB\r\nVGA: GTX 1660\r\nNGUỒN: 550W', 'images/qmBV7VMcKPNOfIwZComWLUirRnAUmDoz3AbRJrG5.webp', '2024-06-07 21:25:26', '2024-06-07 21:25:26'),
(7, 'ARES A7 (I3 1200F/GTX 1030)', 8799000, 'Thông số sản phẩm\r\nCPU : Intel Core i3-12100F\r\nMAIN : H610\r\nRAM : 8GB DDR4\r\nSSD : 250GB\r\nVGA: GTX 1030\r\nNGUỒN: 450W', 'images/AidaJRozqcWPdlEOAeyr1EO8i0Vbn1VyaYzhn0Q5.webp', '2024-06-07 22:41:50', '2024-06-07 22:41:50'),
(8, 'MSI - I5 13400F/RTX 3050 ( POWER BY MSI )', 19499000, 'Thông số sản phẩm\r\nCPU : Intel i5-13400F\r\nMAIN : B760\r\nRAM :16GB (2x8GB) DDR4\r\nSSD : 500G SSD\r\nVGA: NVIDIA 3050\r\nNGUỒN : 550W', 'images/mxl7eJqqaBGdNkgKbOYM27mPqcnyeDZNhaDsZdJo.webp', '2024-06-07 23:08:38', '2024-06-07 23:08:38'),
(9, 'SNIPER S28 ( I5 12400F/GTX 1660S)', 14999000, 'Thông số sản phẩm\r\nCPU : Intel core i5-12400F\r\nMAIN : B660\r\nRAM : 8GBx2 DDR4\r\nSSD : 250GB\r\nVGA : GTX 1660S\r\nNGUỒN : 550W', 'images/dvfYqvFf1CnR63RCj1UnqCAqacznKec8XWEM8sZE.webp', '2024-06-07 23:09:07', '2024-06-07 23:09:07'),
(10, 'APOLLO I14 (I7 14700K/RTX 4070TI SUPER )', 81999000, 'Thông số sản phẩm\r\nPC GAMING tản nước custom cao cấp Fitting Corsair x EKWB\r\nCPU : Intel Core i7-14700K\r\nRAM : 32GB DDR5 ( 16x2)\r\nSSD : 500GB\r\nVGA: RTX 4070TI Super\r\nNGUỒN: 1000W', 'images/2LUx4OgVPZMmpI0USfuyPAA6XF0QmISldOU89wUu.webp', '2024-06-07 23:09:42', '2024-06-07 23:10:28'),
(11, 'SNIPER S33 ( I5 13400F/RTX 4060)', 21499000, 'Thông số sản phẩm\r\nCPU : INTEL i5-12400F\r\nMAIN : B760M\r\nRAM : 16GB (2x8GB) DDR4\r\nSSD : 512GB SSD\r\nVGA: RTX 4060\r\nNGUỒN : 600W', 'images/f4kt24deU4TjbkoNlmF5r7NX5Et6XWymkF99x0EU.webp', '2024-06-07 23:10:12', '2024-06-07 23:11:09'),
(12, 'SNIPER S34 ( I5 12400F/RTX 3060)', 18999000, 'Thông số sản phẩm\r\nCPU : INTEL i5-12400F\r\nMAIN : B760M\r\nRAM : 16GB (2x8GB) DDR4\r\nSSD : 512GB SSD\r\nVGA: RTX 3060\r\nNGUỒN : 550W', 'images/ZmRRbdDpf52qlZW3zgyJFbo7HmBknKtGfYAWGFHc.webp', '2024-06-07 23:12:06', '2024-06-07 23:12:06');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Bui Vuong Truong', 'buitruong132100@gmail.com', NULL, '$2y$10$NVwAd4ibCMFFMGLnhOhcTuqTm2h2n3bylc8/wNphdPyWakIX8Ycge', NULL, '2024-06-07 06:03:15', '2024-06-07 06:03:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
