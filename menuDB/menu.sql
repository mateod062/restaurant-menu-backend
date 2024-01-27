-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2024 at 04:58 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `menu`
--

-- --------------------------------------------------------

--
-- Table structure for table `daily_menus`
--

CREATE TABLE `daily_menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `daily_menus`
--

INSERT INTO `daily_menus` (`id`, `title`, `created_at`, `updated_at`) VALUES
(3, 'Lunch', '2024-01-20 15:55:21', '2024-01-20 15:55:21'),
(4, 'Dinner', '2024-01-20 15:55:36', '2024-01-20 15:55:36');

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
-- Table structure for table `meals`
--

CREATE TABLE `meals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `category` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `meals`
--

INSERT INTO `meals` (`id`, `name`, `price`, `category`, `created_at`, `updated_at`) VALUES
(1, 'Proljetna juha', 0.50, 'Soup', NULL, '2024-01-26 21:01:56'),
(2, 'Pohani pureci odrezak', 1.99, 'Main meal', '2024-01-11 10:34:31', '2024-01-22 16:17:14'),
(3, 'Spaghetti bolognese', 1.99, 'Main meal', '2024-01-11 10:35:10', '2024-01-22 16:17:02'),
(5, 'Pomfrit', 0.99, 'Side dish', '2024-01-11 11:47:56', '2024-01-22 16:16:25'),
(6, 'Cupava kata', 0.99, 'Dessert', '2024-01-11 11:48:15', '2024-01-22 16:16:33'),
(7, 'Kremsnita', 0.99, 'Dessert', '2024-01-12 09:49:43', '2024-01-22 16:16:40'),
(9, 'Margherita', 0.99, 'Pizza', '2024-01-18 18:10:38', '2024-01-27 13:25:14'),
(10, 'Mijesana bez gljiva', 0.99, 'Pizza', '2024-01-18 18:11:08', '2024-01-22 15:22:49'),
(14, 'Rizoto sunka sir', 2.00, 'Main meal', '2024-01-21 13:18:32', '2024-01-21 13:18:32'),
(16, 'Spikovana junetina', 2.20, 'Main meal', '2024-01-22 16:06:44', '2024-01-22 16:06:44'),
(17, 'Juneci gulas', 2.99, 'Main meal', '2024-01-22 16:42:43', '2024-01-26 20:54:53'),
(19, 'Lasagne', 1.99, 'Main meal', '2024-01-26 20:58:30', '2024-01-26 20:58:30'),
(30, 'Pizza od tune', 0.99, 'Pizza', '2024-01-27 13:50:21', '2024-01-27 13:50:21');

-- --------------------------------------------------------

--
-- Table structure for table `meal_menu`
--

CREATE TABLE `meal_menu` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `meal_id` bigint(20) UNSIGNED NOT NULL,
  `menu_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `meal_menu`
--

INSERT INTO `meal_menu` (`id`, `meal_id`, `menu_id`, `created_at`, `updated_at`) VALUES
(9, 1, 19, NULL, NULL),
(10, 1, 20, NULL, NULL),
(11, 1, 21, NULL, NULL),
(12, 1, 22, NULL, NULL),
(13, 1, 23, NULL, NULL),
(14, 1, 24, NULL, NULL),
(18, 5, 19, '2024-01-20 15:56:17', '2024-01-20 15:56:17'),
(22, 5, 20, '2024-01-20 15:56:27', '2024-01-20 15:56:27'),
(25, 3, 21, '2024-01-20 15:56:34', '2024-01-20 15:56:34'),
(26, 5, 21, '2024-01-20 15:56:34', '2024-01-20 15:56:34'),
(27, 7, 21, '2024-01-20 15:56:34', '2024-01-20 15:56:34'),
(29, 3, 22, '2024-01-20 15:56:44', '2024-01-20 15:56:44'),
(30, 5, 22, '2024-01-20 15:56:44', '2024-01-20 15:56:44'),
(31, 7, 22, '2024-01-20 15:56:44', '2024-01-20 15:56:44'),
(33, 3, 23, '2024-01-20 15:56:51', '2024-01-20 15:56:51'),
(34, 5, 23, '2024-01-20 15:56:51', '2024-01-20 15:56:51'),
(35, 7, 23, '2024-01-20 15:56:51', '2024-01-20 15:56:51'),
(37, 3, 24, '2024-01-20 15:56:57', '2024-01-20 15:56:57'),
(38, 5, 24, '2024-01-20 15:56:57', '2024-01-20 15:56:57'),
(40, 6, 24, '2024-01-20 17:23:24', '2024-01-20 17:23:24'),
(47, 17, 20, '2024-01-23 09:04:12', '2024-01-23 09:04:12'),
(50, 6, 20, '2024-01-23 09:19:24', '2024-01-23 09:19:24'),
(58, 19, 19, '2024-01-27 13:44:21', '2024-01-27 13:44:21'),
(59, 7, 19, '2024-01-27 13:44:21', '2024-01-27 13:44:21');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `daily_menu_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `title`, `daily_menu_id`, `created_at`, `updated_at`) VALUES
(19, 'Menu 1', 3, '2024-01-20 15:56:17', '2024-01-20 15:56:17'),
(20, 'Menu 2', 3, '2024-01-20 15:56:27', '2024-01-20 15:56:27'),
(21, 'Menu 3', 3, '2024-01-20 15:56:34', '2024-01-20 15:56:34'),
(22, 'Menu 1', 4, '2024-01-20 15:56:44', '2024-01-20 15:56:44'),
(23, 'Menu 2', 4, '2024-01-20 15:56:51', '2024-01-20 15:56:51'),
(24, 'Menu 3', 4, '2024-01-20 15:56:57', '2024-01-20 15:56:57');

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
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_12_27_150701_create_meals_table', 2),
(6, '2023_12_27_150356_create_meals_table', 3),
(7, '2023_12_27_150357_create_daily_menus_table', 4),
(8, '2023_12_27_151357_create_menus_table', 5),
(9, '2023_12_27_151358_create_meal_menu_table', 5);

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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `last_name`, `email`, `email_verified_at`, `password`, `is_admin`, `remember_token`, `created_at`, `updated_at`) VALUES
(5, 'Bruno', 'Bursic', 'bursic@gmail.com', '2023-12-23 14:41:53', '$2y$12$8pUBJo8pxlyDStbWcYJaH.vReKr6BAg.nAuVFfbcg70rG0hQAo0vK', 1, '9gb44Eqdbc', '2023-12-23 14:41:53', '2023-12-23 14:41:53'),
(6, 'Mateo', 'Dokic', 'mateodok@gmail.com', '2024-01-26 07:58:46', '$2y$12$NyEj9FR4mg0guoT2debo6.sUoR.u6K3tUAu.hQPUzQl.Vkk/lzZ0q', 1, 'LWJ2mp5nQf', '2024-01-26 07:58:47', '2024-01-26 07:58:47'),
(7, 'Jurko', 'Milanic', 'jurkomil@gmail.com', '2024-01-26 08:01:28', '$2y$12$uMQrx0D1kYp/Zkax/uQMweN5QqBwhYA988zXl7f0XSBvDdWbkRa92', 0, 'IdCMH3CoJ6', '2024-01-26 08:01:28', '2024-01-26 08:01:28'),
(9, 'Dominik', 'Kovacevic', 'laganojutro15@gmail.com', '2024-01-26 14:25:42', '$2y$12$jGqP0rGecaG4G.CUXWu6xugW6T9FyJTNkzLkjxNCjBDjT7PSD7CZK', 0, 'zXTt4y8kh0', '2024-01-26 14:25:42', '2024-01-26 14:25:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `daily_menus`
--
ALTER TABLE `daily_menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `meals`
--
ALTER TABLE `meals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meal_menu`
--
ALTER TABLE `meal_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_fk` (`menu_id`),
  ADD KEY `meal_fk` (`meal_id`) USING BTREE;

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menus_fk` (`daily_menu_id`);

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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

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
-- AUTO_INCREMENT for table `daily_menus`
--
ALTER TABLE `daily_menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `meals`
--
ALTER TABLE `meals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `meal_menu`
--
ALTER TABLE `meal_menu`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `meal_menu`
--
ALTER TABLE `meal_menu`
  ADD CONSTRAINT `meal_fk` FOREIGN KEY (`meal_id`) REFERENCES `meals` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `menu_fk` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `menus`
--
ALTER TABLE `menus`
  ADD CONSTRAINT `menus_fk` FOREIGN KEY (`daily_menu_id`) REFERENCES `daily_menus` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
