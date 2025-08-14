-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2024 at 09:29 AM
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
-- Database: `vpn_codecanyon`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(3) UNSIGNED DEFAULT 0 COMMENT '0: active, 1: blocked',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `name`, `email`, `email_verified_at`, `password`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Abu Motaleb', 'admin@gmail.com', NULL, '$2y$12$ryUdY7MTej2G7mnEWzitfOCx6FWdC9K7y/beISI.Vu9Oa/C2khHNe', 0, 'oKpRJMkpkAJcotDh7VVjRpEC4oXJ7LycHEDfhETytkhnlVoAxdFr50z2SsYU', '2024-12-19 06:24:59', '2024-12-19 06:24:59');

-- --------------------------------------------------------

--
-- Table structure for table `advertisements`
--

CREATE TABLE `advertisements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admob_android_publisher_account_id` varchar(255) DEFAULT NULL,
  `admob_android_banner_ad_unit_id` varchar(255) DEFAULT NULL,
  `admob_android_interstitial_ad_unit_id` varchar(255) DEFAULT NULL,
  `admob_android_native_ad_unit_id` varchar(255) DEFAULT NULL,
  `admob_android_reward_ad_unit_id` varchar(255) DEFAULT NULL,
  `admob_android_app_open_ad_unit_id` varchar(255) DEFAULT NULL,
  `admob_ios_banner_ad_unit_id` varchar(255) DEFAULT NULL,
  `admob_ios_interstitial_ad_unit_id` varchar(255) DEFAULT NULL,
  `admob_ios_native_ad_unit_id` varchar(255) DEFAULT NULL,
  `admob_ios_reward_ad_unit_id` varchar(255) DEFAULT NULL,
  `admob_ios_app_open_ad_unit_id` varchar(255) DEFAULT NULL,
  `facebook_android_banner_ad_unit_id` varchar(255) DEFAULT NULL,
  `facebook_android_interstitial_ad_unit_id` varchar(255) DEFAULT NULL,
  `facebook_android_native_ad_unit_id` varchar(255) DEFAULT NULL,
  `facebook_android_reward_ad_unit_id` varchar(255) DEFAULT NULL,
  `facebook_ios_banner_ad_unit_id` varchar(255) DEFAULT NULL,
  `facebook_ios_interstitial_ad_unit_id` varchar(255) DEFAULT NULL,
  `facebook_ios_native_ad_unit_id` varchar(255) DEFAULT NULL,
  `facebook_ios_reward_ad_unit_id` varchar(255) DEFAULT NULL,
  `unity_game_id` varchar(255) DEFAULT NULL,
  `unity_banner_ad_placement_id` varchar(255) DEFAULT NULL,
  `unity_interstitial_ad_placement_id` varchar(255) DEFAULT NULL,
  `ironsource_app_key` varchar(255) DEFAULT NULL,
  `interstitial_ad_interval` varchar(255) DEFAULT NULL,
  `native_ad_index` varchar(255) DEFAULT NULL,
  `ads_type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_settings`
--

CREATE TABLE `app_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `login_system_type` enum('device_id_required','email_password_only') NOT NULL DEFAULT 'email_password_only' COMMENT 'Configures the login system. Options: "device_id_required" (login requires device ID) or "email_password_only".',
  `faq_url` varchar(255) DEFAULT NULL,
  `contact_us_url` varchar(255) DEFAULT NULL,
  `privacy_policy_url` varchar(255) DEFAULT NULL,
  `terms_and_conditions_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
('spatie.permission.cache', 'a:3:{s:5:\"alias\";a:5:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"d\";s:10:\"group_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:40:{i:0;a:5:{s:1:\"a\";i:1;s:1:\"b\";s:14:\"dashboard.view\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:9:\"dashboard\";s:1:\"r\";a:1:{i:0;i:1;}}i:1;a:5:{s:1:\"a\";i:2;s:1:\"b\";s:9:\"role.view\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:4:\"role\";s:1:\"r\";a:1:{i:0;i:1;}}i:2;a:5:{s:1:\"a\";i:3;s:1:\"b\";s:11:\"role.create\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:4:\"role\";s:1:\"r\";a:1:{i:0;i:1;}}i:3;a:5:{s:1:\"a\";i:4;s:1:\"b\";s:9:\"role.edit\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:4:\"role\";s:1:\"r\";a:1:{i:0;i:1;}}i:4;a:5:{s:1:\"a\";i:5;s:1:\"b\";s:11:\"role.delete\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:4:\"role\";s:1:\"r\";a:1:{i:0;i:1;}}i:5;a:5:{s:1:\"a\";i:6;s:1:\"b\";s:10:\"admin.view\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:6;a:5:{s:1:\"a\";i:7;s:1:\"b\";s:12:\"admin.create\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:7;a:5:{s:1:\"a\";i:8;s:1:\"b\";s:10:\"admin.edit\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:8;a:5:{s:1:\"a\";i:9;s:1:\"b\";s:12:\"admin.delete\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:9;a:5:{s:1:\"a\";i:10;s:1:\"b\";s:9:\"user.view\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:4:\"user\";s:1:\"r\";a:1:{i:0;i:1;}}i:10;a:5:{s:1:\"a\";i:11;s:1:\"b\";s:9:\"user.edit\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:4:\"user\";s:1:\"r\";a:1:{i:0;i:1;}}i:11;a:5:{s:1:\"a\";i:12;s:1:\"b\";s:11:\"user.delete\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:4:\"user\";s:1:\"r\";a:1:{i:0;i:1;}}i:12;a:5:{s:1:\"a\";i:13;s:1:\"b\";s:12:\"country.view\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:7:\"country\";s:1:\"r\";a:1:{i:0;i:1;}}i:13;a:5:{s:1:\"a\";i:14;s:1:\"b\";s:14:\"country.create\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:7:\"country\";s:1:\"r\";a:1:{i:0;i:1;}}i:14;a:5:{s:1:\"a\";i:15;s:1:\"b\";s:12:\"country.edit\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:7:\"country\";s:1:\"r\";a:1:{i:0;i:1;}}i:15;a:5:{s:1:\"a\";i:16;s:1:\"b\";s:14:\"country.delete\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:7:\"country\";s:1:\"r\";a:1:{i:0;i:1;}}i:16;a:5:{s:1:\"a\";i:17;s:1:\"b\";s:11:\"server.view\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:6:\"server\";s:1:\"r\";a:1:{i:0;i:1;}}i:17;a:5:{s:1:\"a\";i:18;s:1:\"b\";s:13:\"server.create\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:6:\"server\";s:1:\"r\";a:1:{i:0;i:1;}}i:18;a:5:{s:1:\"a\";i:19;s:1:\"b\";s:11:\"server.edit\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:6:\"server\";s:1:\"r\";a:1:{i:0;i:1;}}i:19;a:5:{s:1:\"a\";i:20;s:1:\"b\";s:13:\"server.delete\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:6:\"server\";s:1:\"r\";a:1:{i:0;i:1;}}i:20;a:5:{s:1:\"a\";i:21;s:1:\"b\";s:20:\"package_pricing.view\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:15:\"package_pricing\";s:1:\"r\";a:1:{i:0;i:1;}}i:21;a:5:{s:1:\"a\";i:22;s:1:\"b\";s:22:\"package_pricing.create\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:15:\"package_pricing\";s:1:\"r\";a:1:{i:0;i:1;}}i:22;a:5:{s:1:\"a\";i:23;s:1:\"b\";s:20:\"package_pricing.edit\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:15:\"package_pricing\";s:1:\"r\";a:1:{i:0;i:1;}}i:23;a:5:{s:1:\"a\";i:24;s:1:\"b\";s:22:\"package_pricing.delete\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:15:\"package_pricing\";s:1:\"r\";a:1:{i:0;i:1;}}i:24;a:5:{s:1:\"a\";i:25;s:1:\"b\";s:17:\"notification.send\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:12:\"notification\";s:1:\"r\";a:1:{i:0;i:1;}}i:25;a:5:{s:1:\"a\";i:26;s:1:\"b\";s:9:\"page.view\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:4:\"page\";s:1:\"r\";a:1:{i:0;i:1;}}i:26;a:5:{s:1:\"a\";i:27;s:1:\"b\";s:11:\"page.create\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:4:\"page\";s:1:\"r\";a:1:{i:0;i:1;}}i:27;a:5:{s:1:\"a\";i:28;s:1:\"b\";s:9:\"page.edit\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:4:\"page\";s:1:\"r\";a:1:{i:0;i:1;}}i:28;a:5:{s:1:\"a\";i:29;s:1:\"b\";s:11:\"page.delete\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:4:\"page\";s:1:\"r\";a:1:{i:0;i:1;}}i:29;a:5:{s:1:\"a\";i:30;s:1:\"b\";s:19:\"email-settings.view\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:14:\"email-settings\";s:1:\"r\";a:1:{i:0;i:1;}}i:30;a:5:{s:1:\"a\";i:31;s:1:\"b\";s:24:\"email-configuration.edit\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:14:\"email-settings\";s:1:\"r\";a:1:{i:0;i:1;}}i:31;a:5:{s:1:\"a\";i:32;s:1:\"b\";s:20:\"email-templates.edit\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:14:\"email-settings\";s:1:\"r\";a:1:{i:0;i:1;}}i:32;a:5:{s:1:\"a\";i:33;s:1:\"b\";s:27:\"email-global-templates.edit\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:14:\"email-settings\";s:1:\"r\";a:1:{i:0;i:1;}}i:33;a:5:{s:1:\"a\";i:34;s:1:\"b\";s:13:\"settings.view\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:8:\"settings\";s:1:\"r\";a:1:{i:0;i:1;}}i:34;a:5:{s:1:\"a\";i:35;s:1:\"b\";s:26:\"notification-settings.view\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:8:\"settings\";s:1:\"r\";a:1:{i:0;i:1;}}i:35;a:5:{s:1:\"a\";i:36;s:1:\"b\";s:26:\"notification-settings.edit\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:8:\"settings\";s:1:\"r\";a:1:{i:0;i:1;}}i:36;a:5:{s:1:\"a\";i:37;s:1:\"b\";s:27:\"advertisement-settings.view\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:8:\"settings\";s:1:\"r\";a:1:{i:0;i:1;}}i:37;a:5:{s:1:\"a\";i:38;s:1:\"b\";s:27:\"advertisement-settings.edit\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:8:\"settings\";s:1:\"r\";a:1:{i:0;i:1;}}i:38;a:5:{s:1:\"a\";i:39;s:1:\"b\";s:17:\"app-settings.view\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:8:\"settings\";s:1:\"r\";a:1:{i:0;i:1;}}i:39;a:5:{s:1:\"a\";i:40;s:1:\"b\";s:17:\"app-settings.edit\";s:1:\"c\";s:5:\"admin\";s:1:\"d\";s:8:\"settings\";s:1:\"r\";a:1:{i:0;i:1;}}}s:5:\"roles\";a:1:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:11:\"Super Admin\";s:1:\"c\";s:5:\"admin\";}}}', 1734675925);

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
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `status` tinyint(3) UNSIGNED DEFAULT 0 COMMENT '0: active, 1: inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `icon`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Bangladesh', 'assets/uploads/countries/1733908259_1732794653_16.Flag-Bangladesh.webp', 0, '2024-12-11 03:10:59', '2024-12-11 03:10:59'),
(2, 'India', 'assets/uploads/countries/1733908269_1732794662_1699126075_935.download.jpg', 0, '2024-12-11 03:11:09', '2024-12-11 03:11:09'),
(3, 'Pakistan', 'assets/uploads/countries/1733908279_1732794736_1699126143_137.istockphoto-1069756720-612x612.jpg', 0, '2024-12-11 03:11:19', '2024-12-11 03:11:19');

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

CREATE TABLE `devices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `device_id` varchar(255) NOT NULL,
  `fcm_token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `devices`
--

INSERT INTO `devices` (`id`, `device_id`, `fcm_token`, `created_at`, `updated_at`) VALUES
(1, 'SKQ1.211019.001', 'd2_XEaToQSisJY5CEc9gtr:APA91bGAkdYRvWr2quFFkLbETd7LhPuMcWPVzFWQ5A-9FMqw0Q3eUcPq_cIgU9cT67QrQyFqaf54ltIoTkk-_HrX5b0EhGXRxLb0tO65RX0garL6OKDKYZQ', '2024-12-19 06:36:52', '2024-12-19 08:25:03');

-- --------------------------------------------------------

--
-- Table structure for table `email_configurations`
--

CREATE TABLE `email_configurations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email_send_method` varchar(255) DEFAULT NULL,
  `mail_host` varchar(255) DEFAULT NULL,
  `mail_port` varchar(255) DEFAULT NULL,
  `mail_encryption_method` varchar(255) DEFAULT NULL,
  `mail_username` varchar(255) DEFAULT NULL,
  `mail_password` varchar(255) DEFAULT NULL,
  `mail_from_address` varchar(255) DEFAULT NULL,
  `mail_from_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_configurations`
--

INSERT INTO `email_configurations` (`id`, `email_send_method`, `mail_host`, `mail_port`, `mail_encryption_method`, `mail_username`, `mail_password`, `mail_from_address`, `mail_from_name`, `created_at`, `updated_at`) VALUES
(1, 'smtp', 'sandbox.smtp.mailtrap.io', '2525', NULL, '2d2be775bb62bf', 'b3dd151a1a7924', 'vpn@gmail.com', 'VPN', '2024-12-12 00:07:34', '2024-12-12 00:07:34');

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE `email_templates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `name`, `slug`, `subject`, `content`, `created_at`, `updated_at`) VALUES
(1, 'Password Reset Link', 'password-reset-link', 'Reset Your Password', '<p>Dear <strong>{{ user_name }}</strong>, &nbsp;</p>\r\n\r\n<p>We received a request to reset your password. You can reset your password by clicking the button below: &nbsp;</p>\r\n\r\n<p>{{ reset_button }} &nbsp;</p>\r\n\r\n<p>If you didn&rsquo;t request this, you can safely ignore this email. Rest assured, your account security is important to us. &nbsp;</p>\r\n\r\n<p>If you experience any issues with the reset link or need further assistance, please don&rsquo;t hesitate to reach out to our support team. &nbsp;</p>\r\n\r\n<p>Best regards, &nbsp;<br />\r\n<strong>VPN</strong><br />\r\n&nbsp;</p>', NULL, '2024-12-12 00:23:04'),
(2, 'Password Reset OTP', 'password-reset-otp', 'Your OTP for Password Reset', '<p>Dear <strong>{{ user_name }}</strong>,</p>\r\n\r\n<p>We&rsquo;ve received a request to verify your account. Please use the following One-Time Password (OTP) to proceed with the verification process:</p>\r\n\r\n<p><strong>**{{ otp_code }}**</strong></p>\r\n\r\n<p>This OTP is valid for {{ validity_duration }} minutes. Please ensure you complete the process within this timeframe.</p>\r\n\r\n<p>If you did not request this verification, please disregard this email. Your account security is important to us.</p>\r\n\r\n<p>If you encounter any issues or need further assistance, feel free to reach out to our support team.</p>\r\n\r\n<p>Best regards, &nbsp;<br />\r\n<strong>VPN</strong><br />\r\n&nbsp;</p>', '2024-12-12 00:20:17', '2024-12-12 00:12:23');

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
-- Table structure for table `global_email_templates`
--

CREATE TABLE `global_email_templates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email_header` text NOT NULL DEFAULT '',
  `email_footer` varchar(255) NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `global_email_templates`
--

INSERT INTO `global_email_templates` (`id`, `email_header`, `email_footer`, `created_at`, `updated_at`) VALUES
(1, 'assets/uploads/email_templates/1733983532_logo.png', '<p>vpn@example.com</p>', '2024-12-12 00:05:32', '2024-12-12 00:06:22');

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
(36, '0001_01_01_000000_create_users_table', 1),
(37, '0001_01_01_000001_create_cache_table', 1),
(38, '0001_01_01_000002_create_jobs_table', 1),
(39, '2024_08_08_100120_create_admins_table', 1),
(40, '2024_08_08_101551_create_personal_access_tokens_table', 1),
(41, '2024_08_11_060739_create_permission_tables', 1),
(42, '2024_08_12_082558_create_email_configurations_table', 1),
(43, '2024_08_12_082620_create_email_templates_table', 1),
(44, '2024_08_12_082641_create_global_email_templates_table', 1),
(45, '2024_09_04_184356_create_pages_table', 1),
(46, '2024_09_11_151600_create_devices_table', 1),
(47, '2024_09_11_175416_create_advertisements_table', 1),
(48, '2024_11_28_144738_create_countries_table', 1),
(49, '2024_11_28_170208_create_app_settings_table', 1),
(50, '2024_12_03_151759_create_servers_table', 1),
(51, '2024_12_05_133050_create_package_pricings_table', 1),
(52, '2024_12_10_160551_create_user_packages_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\Admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `package_pricings`
--

CREATE TABLE `package_pricings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `package_name` varchar(255) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `package_duration` int(11) NOT NULL,
  `package_price` decimal(10,2) NOT NULL,
  `status` tinyint(3) UNSIGNED DEFAULT 0 COMMENT '0: active, 1: inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `package_pricings`
--

INSERT INTO `package_pricings` (`id`, `package_name`, `product_id`, `package_duration`, `package_price`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Basic Plan', '123', 7, 5.99, 0, '2024-12-11 03:40:10', '2024-12-11 03:40:47'),
(2, 'Advanced Plan', '345', 30, 19.99, 0, '2024-12-11 03:41:12', '2024-12-11 03:41:12'),
(3, 'Premium Plan', '789', 90, 40.00, 0, '2024-12-11 03:41:30', '2024-12-11 03:41:30'),
(4, 'New Pack', '142', 3, 12.00, 1, '2024-12-18 23:31:36', '2024-12-19 08:01:11');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `page_content` text NOT NULL,
  `status` tinyint(3) UNSIGNED DEFAULT 0 COMMENT '0: active, 1: inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `group_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `group_name`, `created_at`, `updated_at`) VALUES
(1, 'dashboard.view', 'admin', 'dashboard', '2024-12-19 06:24:59', '2024-12-19 06:24:59'),
(2, 'role.view', 'admin', 'role', '2024-12-19 06:24:59', '2024-12-19 06:24:59'),
(3, 'role.create', 'admin', 'role', '2024-12-19 06:24:59', '2024-12-19 06:24:59'),
(4, 'role.edit', 'admin', 'role', '2024-12-19 06:24:59', '2024-12-19 06:24:59'),
(5, 'role.delete', 'admin', 'role', '2024-12-19 06:24:59', '2024-12-19 06:24:59'),
(6, 'admin.view', 'admin', 'admin', '2024-12-19 06:24:59', '2024-12-19 06:24:59'),
(7, 'admin.create', 'admin', 'admin', '2024-12-19 06:24:59', '2024-12-19 06:24:59'),
(8, 'admin.edit', 'admin', 'admin', '2024-12-19 06:24:59', '2024-12-19 06:24:59'),
(9, 'admin.delete', 'admin', 'admin', '2024-12-19 06:24:59', '2024-12-19 06:24:59'),
(10, 'user.view', 'admin', 'user', '2024-12-19 06:24:59', '2024-12-19 06:24:59'),
(11, 'user.edit', 'admin', 'user', '2024-12-19 06:24:59', '2024-12-19 06:24:59'),
(12, 'user.delete', 'admin', 'user', '2024-12-19 06:24:59', '2024-12-19 06:24:59'),
(13, 'country.view', 'admin', 'country', '2024-12-19 06:24:59', '2024-12-19 06:24:59'),
(14, 'country.create', 'admin', 'country', '2024-12-19 06:24:59', '2024-12-19 06:24:59'),
(15, 'country.edit', 'admin', 'country', '2024-12-19 06:24:59', '2024-12-19 06:24:59'),
(16, 'country.delete', 'admin', 'country', '2024-12-19 06:24:59', '2024-12-19 06:24:59'),
(17, 'server.view', 'admin', 'server', '2024-12-19 06:24:59', '2024-12-19 06:24:59'),
(18, 'server.create', 'admin', 'server', '2024-12-19 06:24:59', '2024-12-19 06:24:59'),
(19, 'server.edit', 'admin', 'server', '2024-12-19 06:24:59', '2024-12-19 06:24:59'),
(20, 'server.delete', 'admin', 'server', '2024-12-19 06:24:59', '2024-12-19 06:24:59'),
(21, 'package_pricing.view', 'admin', 'package_pricing', '2024-12-19 06:24:59', '2024-12-19 06:24:59'),
(22, 'package_pricing.create', 'admin', 'package_pricing', '2024-12-19 06:24:59', '2024-12-19 06:24:59'),
(23, 'package_pricing.edit', 'admin', 'package_pricing', '2024-12-19 06:24:59', '2024-12-19 06:24:59'),
(24, 'package_pricing.delete', 'admin', 'package_pricing', '2024-12-19 06:24:59', '2024-12-19 06:24:59'),
(25, 'notification.send', 'admin', 'notification', '2024-12-19 06:24:59', '2024-12-19 06:24:59'),
(26, 'page.view', 'admin', 'page', '2024-12-19 06:24:59', '2024-12-19 06:24:59'),
(27, 'page.create', 'admin', 'page', '2024-12-19 06:24:59', '2024-12-19 06:24:59'),
(28, 'page.edit', 'admin', 'page', '2024-12-19 06:24:59', '2024-12-19 06:24:59'),
(29, 'page.delete', 'admin', 'page', '2024-12-19 06:24:59', '2024-12-19 06:24:59'),
(30, 'email-settings.view', 'admin', 'email-settings', '2024-12-19 06:24:59', '2024-12-19 06:24:59'),
(31, 'email-configuration.edit', 'admin', 'email-settings', '2024-12-19 06:24:59', '2024-12-19 06:24:59'),
(32, 'email-templates.edit', 'admin', 'email-settings', '2024-12-19 06:24:59', '2024-12-19 06:24:59'),
(33, 'email-global-templates.edit', 'admin', 'email-settings', '2024-12-19 06:24:59', '2024-12-19 06:24:59'),
(34, 'settings.view', 'admin', 'settings', '2024-12-19 06:24:59', '2024-12-19 06:24:59'),
(35, 'notification-settings.view', 'admin', 'settings', '2024-12-19 06:24:59', '2024-12-19 06:24:59'),
(36, 'notification-settings.edit', 'admin', 'settings', '2024-12-19 06:24:59', '2024-12-19 06:24:59'),
(37, 'advertisement-settings.view', 'admin', 'settings', '2024-12-19 06:24:59', '2024-12-19 06:24:59'),
(38, 'advertisement-settings.edit', 'admin', 'settings', '2024-12-19 06:24:59', '2024-12-19 06:24:59'),
(39, 'app-settings.view', 'admin', 'settings', '2024-12-19 06:24:59', '2024-12-19 06:24:59'),
(40, 'app-settings.edit', 'admin', 'settings', '2024-12-19 06:24:59', '2024-12-19 06:24:59');

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

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(5, 'App\\Models\\User', 1, 'user_token', 'db4e9ec4440c6775a755f1d7c5d78cd23c500c60fff2522ebdac6a8af5d72d70', '[\"*\"]', '2024-12-19 07:45:08', NULL, '2024-12-19 07:41:21', '2024-12-19 07:45:08'),
(6, 'App\\Models\\User', 1, 'user_token', 'f47cc6d919f17c201b405360b702fc395b5e24aeb0e49090408962540b931ec2', '[\"*\"]', NULL, NULL, '2024-12-19 07:45:46', '2024-12-19 07:45:46'),
(7, 'App\\Models\\User', 1, 'user_token', '414a0a923d00dec182d2d835a466f6024a1eb0a01c4a6d54ca7fc1cb374e4aa4', '[\"*\"]', NULL, NULL, '2024-12-19 07:47:12', '2024-12-19 07:47:12'),
(8, 'App\\Models\\User', 1, 'user_token', '8d22e4f6aeb4f2170e4b279ed1ec72ed5250d4fb55084a28603c2a4254da2210', '[\"*\"]', '2024-12-19 07:48:19', NULL, '2024-12-19 07:48:18', '2024-12-19 07:48:19'),
(9, 'App\\Models\\User', 1, 'user_token', '0575047cf72efdacd9c76fa808cf3bc56cba782c82629064e4b17bf598770d3c', '[\"*\"]', '2024-12-19 08:12:17', NULL, '2024-12-19 08:12:17', '2024-12-19 08:12:17'),
(10, 'App\\Models\\User', 1, 'user_token', 'cbd3d6a933d10fa223e5a90df4b1495d7d39e521c5064837833a7095baff523d', '[\"*\"]', '2024-12-19 08:23:13', NULL, '2024-12-19 08:12:36', '2024-12-19 08:23:13'),
(11, 'App\\Models\\User', 1, 'user_token', '8795b56f34b9fade686783e9ab61cf3a384f0e62b0a89d152f323496a6898cd4', '[\"*\"]', '2024-12-19 08:25:02', NULL, '2024-12-19 08:25:02', '2024-12-19 08:25:02');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'admin', '2024-12-19 06:24:59', '2024-12-19 06:24:59');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1);

-- --------------------------------------------------------

--
-- Table structure for table `servers`
--

CREATE TABLE `servers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `vpn_country` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `vpn_credentials_username` varchar(255) NOT NULL,
  `vpn_credentials_password` varchar(255) NOT NULL,
  `udp_configuration` text DEFAULT NULL,
  `tcp_configuration` text DEFAULT NULL,
  `access_type` varchar(255) NOT NULL COMMENT 'The type of access: free or premium',
  `status` tinyint(3) UNSIGNED DEFAULT 0 COMMENT '0: active, 1: inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `servers`
--

INSERT INTO `servers` (`id`, `country_id`, `vpn_country`, `name`, `vpn_credentials_username`, `vpn_credentials_password`, `udp_configuration`, `tcp_configuration`, `access_type`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Bangladesh', 'United States', 'tigervpn', 'tigervpn', 'client\r\ndev tun\r\nproto udp\r\nremote 5.161.82.201 1194\r\nresolv-retry infinite\r\nnobind\r\npersist-key\r\npersist-tun\r\nremote-cert-tls server\r\nauth SHA256\r\ncipher AES-128-GCM\r\nignore-unknown-option block-outside-dns block-ipv6\r\nverb 3\r\n<ca>\r\n-----BEGIN CERTIFICATE-----\r\nMIIDSzCCAjOgAwIBAgIUZFVpEeWpimhP4LyrRbqAWwRxRGswDQYJKoZIhvcNAQEL\r\nBQAwFjEUMBIGA1UEAwwLRWFzeS1SU0EgQ0EwHhcNMjQxMTI4MTA0MzQ4WhcNMzQx\r\nMTI2MTA0MzQ4WjAWMRQwEgYDVQQDDAtFYXN5LVJTQSBDQTCCASIwDQYJKoZIhvcN\r\nAQEBBQADggEPADCCAQoCggEBALHY+nRwzoMAhhLFRN+vp939cACLdfoY2mD4uhc/\r\n2L10seJaFp1IzzRFClQ8KPnEOciIdYjuW7DLFUUlIEhA5VcsIi99WPrZTTlUyEel\r\nxzdD6nHr2yK1oE4dAGPpufDN+GZuOnBNK7rQaUyf15hrvy1SzoCqzyW8ZOVY12nL\r\nDedm/mQqQ1Z5bVvE3weiONZ5N2XTj8QNS+W60TNCFRllxcfbCLmEZezs+haJDcmB\r\nbmBuHOeF5aWbrR0Ef+5CUTanv5OwGRPuddlV4w0fW6zPNhcOr5BAsjVMlst/nT7X\r\nf5be33EaKw/RgSAxXY6sabrhDXVJqGheT8XG7z6YKUbGjOMCAwEAAaOBkDCBjTAM\r\nBgNVHRMEBTADAQH/MB0GA1UdDgQWBBRz7lqEB2tchkD/SrpR9/r5nC9sTzBRBgNV\r\nHSMESjBIgBRz7lqEB2tchkD/SrpR9/r5nC9sT6EapBgwFjEUMBIGA1UEAwwLRWFz\r\neS1SU0EgQ0GCFGRVaRHlqYpoT+C8q0W6gFsEcURrMAsGA1UdDwQEAwIBBjANBgkq\r\nhkiG9w0BAQsFAAOCAQEALuuKOVksdPFptBwoFAjN6XmA5l1BFWVjEjuBhJcxOQ2q\r\nmlIM/sMRPE+EtAozAIDIe+aeJ4pHy1d5JBIdu+dGrYfwbGvH+IBH9d7hqoNLmPbQ\r\np1XLdAXX45ktQTePLRCn0K/vHkwshg6m9oCj3oagZdOVf5u83foOWNM1btCThTLm\r\nhCFBjWasOrmXVDHPfLJm7PYyWpaAg0Jm165d+2sgwwz6cXH/Qcxrjstn1caF0IaE\r\nQ1P7Sd3r/ymMBFZChHVxxp9MXb5I8wioBgKzUrBjAQLOyP7Pifw7MJ1FaDEZ+SJg\r\n2oIfufskdRGm5SMj/StYfmfGp6LiDxL5CeWozWDb0A==\r\n-----END CERTIFICATE-----\r\n</ca>\r\n<cert>\r\n-----BEGIN CERTIFICATE-----\r\nMIIDVzCCAj+gAwIBAgIRAKG45XnOG+w72hA5jhtSqC4wDQYJKoZIhvcNAQELBQAw\r\nFjEUMBIGA1UEAwwLRWFzeS1SU0EgQ0EwHhcNMjQxMTI4MTA0MzQ4WhcNMzQxMTI2\r\nMTA0MzQ4WjATMREwDwYDVQQDDAh0aWdlcnZwbjCCASIwDQYJKoZIhvcNAQEBBQAD\r\nggEPADCCAQoCggEBALnE3ldahKDARa2ScWVNC7W2EbHMFgxuudAkaRSlpzoZZ9aF\r\nB7EYqrzV2W6vTx6vuHjPLX/HhO3ptu/Ty/lpw6eY9KnE5CMT9IBzH3Y8KkjXkkLZ\r\nu+2eTRhJdRjuOlrpWxMTCnZXC3xD1oi+OyXZw+SXjrxDFK2KSuYaVpQcCV4tkvZN\r\nwfx4nBT6uJgln6iGXwDFdplzyOcD0npJoajJW00NMV29Xnya0Z7GxyZeUiJS2XEu\r\nEgQoW95tPdRdq52bYvt40ydluQGodiiNVRgCCd9t8divk/PjqC9qETv/KzLhUizG\r\ndIqj0xIEBO1P/S/z8C6UaFx7hmm5q6LKZSfwOOMCAwEAAaOBojCBnzAJBgNVHRME\r\nAjAAMB0GA1UdDgQWBBQY7ufvJPS12PMnEYf2ixew/7R9AzBRBgNVHSMESjBIgBRz\r\n7lqEB2tchkD/SrpR9/r5nC9sT6EapBgwFjEUMBIGA1UEAwwLRWFzeS1SU0EgQ0GC\r\nFGRVaRHlqYpoT+C8q0W6gFsEcURrMBMGA1UdJQQMMAoGCCsGAQUFBwMCMAsGA1Ud\r\nDwQEAwIHgDANBgkqhkiG9w0BAQsFAAOCAQEAqTjinF0Bo+Pjo/CdN2KeGCmVtNGh\r\nFqde+pg1i2MFn8o0L7MinKSgu9kQ//A7hFAyF9synAH7UK7qVEBVzeafSanV6a0j\r\nOnHzrUTLzQXaVLLUGaAkNcdHI07wJUIXdnEVZNGdPGz6a0LqZjUZKXmE2RLf3Hp4\r\nil9UShiygSt8/OQ49l3lzsYs69Eri03OPN1dGpH3DSKcZ3IaJknfDUCKFcORONTN\r\nGBtDZq9FUP49lI4YL2JvTL2GI5qDLR8iUVBW3h2y/zbBTV5RJ4X96CUy/Vq7HUG0\r\n6gBVhgRd6HkOWd067+f17IhrB7zvHHG7HvNVEBGWYFK8yAkbKaPYLdbAAw==\r\n-----END CERTIFICATE-----\r\n</cert>\r\n<key>\r\n-----BEGIN PRIVATE KEY-----\r\nMIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQC5xN5XWoSgwEWt\r\nknFlTQu1thGxzBYMbrnQJGkUpac6GWfWhQexGKq81dlur08er7h4zy1/x4Tt6bbv\r\n08v5acOnmPSpxOQjE/SAcx92PCpI15JC2bvtnk0YSXUY7jpa6VsTEwp2Vwt8Q9aI\r\nvjsl2cPkl468QxStikrmGlaUHAleLZL2TcH8eJwU+riYJZ+ohl8AxXaZc8jnA9J6\r\nSaGoyVtNDTFdvV58mtGexscmXlIiUtlxLhIEKFvebT3UXaudm2L7eNMnZbkBqHYo\r\njVUYAgnfbfHYr5Pz46gvahE7/ysy4VIsxnSKo9MSBATtT/0v8/AulGhce4Zpuaui\r\nymUn8DjjAgMBAAECggEACwhMj6tSBhcoUpfh9FStIqdp784bHxwYtlCuc7bBmPs3\r\nEsl6vMM/9imZf9Yy4Jn2xPUoEn2GAPhPNqxnrp75d8O0AAl8s2XOsJQyfm7+fRRd\r\n9mqZtRGgkK+U7M9oSsuu1RHdhLKqfXPf7H+m4c2uSxSb7V7q5I8g38wZPGZZdHmU\r\njQrMPFWAzqUl5QyRekxrSTx6l+dOsxrT+N1fVh38wN580pbJnQ8zJS2sdmTzFQPB\r\nq0qHvSBKesrPTAEzWGe6ZXywfRP03b250UjdEt8dtqaWdz3yQL/Qes7wEOPdMurI\r\nuoKrkdw7CtFmi6JbA8Q8I+h/aVxGbncKMJfbXDIyzQKBgQDzgtmzH+n/+yo2Hl5O\r\nZokwTwbHD6F5mj/BT3cjnbK5Ch7H4KNlh8HbsAxHJlLPsF444G8Tl6FNFhdTYofD\r\nkvd05vkYzfvej5Tl7guCr/LGrmt5HQN672kZy9lw1Gabhsa2iMrUaeH5T254G6a2\r\nXP4B7JihcqUPJeZS7zLIrEtbVQKBgQDDS+Zr1NUmY1cD8ik72bXvzczFyMziGBQx\r\n3TgFfIILjkXkcti5aKl1TJtcGknA10jssH0gIthk0P+vu84zcd5D3KNGINg7lnhH\r\nl+UILmOw+IrYzQ/qxZt2Drpod+mdlbPMv3uz00nMnX3DDd1GSjMWT7pS4JIvp2PU\r\nRqq/gRlzVwKBgB910VBuGBpFRc/WHpL8dk7ydsqy/0apogEEljzYu+ViJFXodNPC\r\nNU5/sSZkEiDZBWNNw6wBVAqUhxDz0tx2mVfWG2qT+i1n2XHXTk9lEfWPRT1RfUid\r\ns7NsfbwxBMylHfkpNSM6RsKh+4Cy+dfnrb1r5tA88oxBdj9SvfnlIJs9AoGBAKer\r\nYFav0Zg1rZ1bqP8TeVo67FXagdyTI7Nz5AcB0HyvV149I8h7DRICBVhb0XpY2ukq\r\n1SJkCDj2Hq73pJ8SYesNYLhytnLiSr3csOwHN9vWZw6fb8z2fvQqzOuoF9ANmOJu\r\ne3v2KOQdSr3OB22zgozjQmqpF5kGM3UqfqoP4pPdAoGAWI9rfNN9H0pfsbImhPir\r\nrtZK5SamUynx64G5JmqmbfkokfUYiw3N6vCJvCIPYHRdOXhip1GsIy4vp6soj52t\r\nBMyo/C1KwTtEcBap2duCoK4zMqnZmU1+TYYtr3djwtoEl9ak2X5FgUFgcq+z6uZ9\r\nWd2MELfncJSlettZ5+ZMxPE=\r\n-----END PRIVATE KEY-----\r\n</key>\r\n<tls-crypt>\r\n-----BEGIN OpenVPN Static key V1-----\r\nb40c8c28783d78e030a7ec25e834b360\r\nbc8d9d1421e555efe017b231655f7951\r\n5dfb449202a778dd4c6bd470ac9d36fb\r\ne97d932ee6a8845a68901071dde180e2\r\n5c7c9215bd98df7b4f16bafc31802871\r\n54136b9f5eccb3af8f671efb9d50bbe8\r\nd3db1a86973084b62b56c6add1f198a9\r\n73abea2130c4225ba170421e596f4a9e\r\n6b74d15f4865e4cb2b0bfc7952e1e70a\r\n3174bdbaf8827d834904421f4e3cd27c\r\n4b9fe048a5b6fbc96c64c25c0b87e54d\r\n826c6f0174393554544c30ed826b0fbe\r\nf7ff46b84eb64d7742ff4c0673ce39fe\r\n10f5f68034d457948299457d0c9a1526\r\n2b375651e7d160fd9bb1f892e90a3935\r\n5a86463d955243dd7b943f13013d4444\r\n-----END OpenVPN Static key V1-----\r\n</tls-crypt>', 'client\r\ndev tun\r\nproto udp\r\nremote 5.161.82.201 1194\r\nresolv-retry infinite\r\nnobind\r\npersist-key\r\npersist-tun\r\nremote-cert-tls server\r\nauth SHA256\r\ncipher AES-128-GCM\r\nignore-unknown-option block-outside-dns block-ipv6\r\nverb 3\r\n<ca>\r\n-----BEGIN CERTIFICATE-----\r\nMIIDSzCCAjOgAwIBAgIUZFVpEeWpimhP4LyrRbqAWwRxRGswDQYJKoZIhvcNAQEL\r\nBQAwFjEUMBIGA1UEAwwLRWFzeS1SU0EgQ0EwHhcNMjQxMTI4MTA0MzQ4WhcNMzQx\r\nMTI2MTA0MzQ4WjAWMRQwEgYDVQQDDAtFYXN5LVJTQSBDQTCCASIwDQYJKoZIhvcN\r\nAQEBBQADggEPADCCAQoCggEBALHY+nRwzoMAhhLFRN+vp939cACLdfoY2mD4uhc/\r\n2L10seJaFp1IzzRFClQ8KPnEOciIdYjuW7DLFUUlIEhA5VcsIi99WPrZTTlUyEel\r\nxzdD6nHr2yK1oE4dAGPpufDN+GZuOnBNK7rQaUyf15hrvy1SzoCqzyW8ZOVY12nL\r\nDedm/mQqQ1Z5bVvE3weiONZ5N2XTj8QNS+W60TNCFRllxcfbCLmEZezs+haJDcmB\r\nbmBuHOeF5aWbrR0Ef+5CUTanv5OwGRPuddlV4w0fW6zPNhcOr5BAsjVMlst/nT7X\r\nf5be33EaKw/RgSAxXY6sabrhDXVJqGheT8XG7z6YKUbGjOMCAwEAAaOBkDCBjTAM\r\nBgNVHRMEBTADAQH/MB0GA1UdDgQWBBRz7lqEB2tchkD/SrpR9/r5nC9sTzBRBgNV\r\nHSMESjBIgBRz7lqEB2tchkD/SrpR9/r5nC9sT6EapBgwFjEUMBIGA1UEAwwLRWFz\r\neS1SU0EgQ0GCFGRVaRHlqYpoT+C8q0W6gFsEcURrMAsGA1UdDwQEAwIBBjANBgkq\r\nhkiG9w0BAQsFAAOCAQEALuuKOVksdPFptBwoFAjN6XmA5l1BFWVjEjuBhJcxOQ2q\r\nmlIM/sMRPE+EtAozAIDIe+aeJ4pHy1d5JBIdu+dGrYfwbGvH+IBH9d7hqoNLmPbQ\r\np1XLdAXX45ktQTePLRCn0K/vHkwshg6m9oCj3oagZdOVf5u83foOWNM1btCThTLm\r\nhCFBjWasOrmXVDHPfLJm7PYyWpaAg0Jm165d+2sgwwz6cXH/Qcxrjstn1caF0IaE\r\nQ1P7Sd3r/ymMBFZChHVxxp9MXb5I8wioBgKzUrBjAQLOyP7Pifw7MJ1FaDEZ+SJg\r\n2oIfufskdRGm5SMj/StYfmfGp6LiDxL5CeWozWDb0A==\r\n-----END CERTIFICATE-----\r\n</ca>\r\n<cert>\r\n-----BEGIN CERTIFICATE-----\r\nMIIDVzCCAj+gAwIBAgIRAKG45XnOG+w72hA5jhtSqC4wDQYJKoZIhvcNAQELBQAw\r\nFjEUMBIGA1UEAwwLRWFzeS1SU0EgQ0EwHhcNMjQxMTI4MTA0MzQ4WhcNMzQxMTI2\r\nMTA0MzQ4WjATMREwDwYDVQQDDAh0aWdlcnZwbjCCASIwDQYJKoZIhvcNAQEBBQAD\r\nggEPADCCAQoCggEBALnE3ldahKDARa2ScWVNC7W2EbHMFgxuudAkaRSlpzoZZ9aF\r\nB7EYqrzV2W6vTx6vuHjPLX/HhO3ptu/Ty/lpw6eY9KnE5CMT9IBzH3Y8KkjXkkLZ\r\nu+2eTRhJdRjuOlrpWxMTCnZXC3xD1oi+OyXZw+SXjrxDFK2KSuYaVpQcCV4tkvZN\r\nwfx4nBT6uJgln6iGXwDFdplzyOcD0npJoajJW00NMV29Xnya0Z7GxyZeUiJS2XEu\r\nEgQoW95tPdRdq52bYvt40ydluQGodiiNVRgCCd9t8divk/PjqC9qETv/KzLhUizG\r\ndIqj0xIEBO1P/S/z8C6UaFx7hmm5q6LKZSfwOOMCAwEAAaOBojCBnzAJBgNVHRME\r\nAjAAMB0GA1UdDgQWBBQY7ufvJPS12PMnEYf2ixew/7R9AzBRBgNVHSMESjBIgBRz\r\n7lqEB2tchkD/SrpR9/r5nC9sT6EapBgwFjEUMBIGA1UEAwwLRWFzeS1SU0EgQ0GC\r\nFGRVaRHlqYpoT+C8q0W6gFsEcURrMBMGA1UdJQQMMAoGCCsGAQUFBwMCMAsGA1Ud\r\nDwQEAwIHgDANBgkqhkiG9w0BAQsFAAOCAQEAqTjinF0Bo+Pjo/CdN2KeGCmVtNGh\r\nFqde+pg1i2MFn8o0L7MinKSgu9kQ//A7hFAyF9synAH7UK7qVEBVzeafSanV6a0j\r\nOnHzrUTLzQXaVLLUGaAkNcdHI07wJUIXdnEVZNGdPGz6a0LqZjUZKXmE2RLf3Hp4\r\nil9UShiygSt8/OQ49l3lzsYs69Eri03OPN1dGpH3DSKcZ3IaJknfDUCKFcORONTN\r\nGBtDZq9FUP49lI4YL2JvTL2GI5qDLR8iUVBW3h2y/zbBTV5RJ4X96CUy/Vq7HUG0\r\n6gBVhgRd6HkOWd067+f17IhrB7zvHHG7HvNVEBGWYFK8yAkbKaPYLdbAAw==\r\n-----END CERTIFICATE-----\r\n</cert>\r\n<key>\r\n-----BEGIN PRIVATE KEY-----\r\nMIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQC5xN5XWoSgwEWt\r\nknFlTQu1thGxzBYMbrnQJGkUpac6GWfWhQexGKq81dlur08er7h4zy1/x4Tt6bbv\r\n08v5acOnmPSpxOQjE/SAcx92PCpI15JC2bvtnk0YSXUY7jpa6VsTEwp2Vwt8Q9aI\r\nvjsl2cPkl468QxStikrmGlaUHAleLZL2TcH8eJwU+riYJZ+ohl8AxXaZc8jnA9J6\r\nSaGoyVtNDTFdvV58mtGexscmXlIiUtlxLhIEKFvebT3UXaudm2L7eNMnZbkBqHYo\r\njVUYAgnfbfHYr5Pz46gvahE7/ysy4VIsxnSKo9MSBATtT/0v8/AulGhce4Zpuaui\r\nymUn8DjjAgMBAAECggEACwhMj6tSBhcoUpfh9FStIqdp784bHxwYtlCuc7bBmPs3\r\nEsl6vMM/9imZf9Yy4Jn2xPUoEn2GAPhPNqxnrp75d8O0AAl8s2XOsJQyfm7+fRRd\r\n9mqZtRGgkK+U7M9oSsuu1RHdhLKqfXPf7H+m4c2uSxSb7V7q5I8g38wZPGZZdHmU\r\njQrMPFWAzqUl5QyRekxrSTx6l+dOsxrT+N1fVh38wN580pbJnQ8zJS2sdmTzFQPB\r\nq0qHvSBKesrPTAEzWGe6ZXywfRP03b250UjdEt8dtqaWdz3yQL/Qes7wEOPdMurI\r\nuoKrkdw7CtFmi6JbA8Q8I+h/aVxGbncKMJfbXDIyzQKBgQDzgtmzH+n/+yo2Hl5O\r\nZokwTwbHD6F5mj/BT3cjnbK5Ch7H4KNlh8HbsAxHJlLPsF444G8Tl6FNFhdTYofD\r\nkvd05vkYzfvej5Tl7guCr/LGrmt5HQN672kZy9lw1Gabhsa2iMrUaeH5T254G6a2\r\nXP4B7JihcqUPJeZS7zLIrEtbVQKBgQDDS+Zr1NUmY1cD8ik72bXvzczFyMziGBQx\r\n3TgFfIILjkXkcti5aKl1TJtcGknA10jssH0gIthk0P+vu84zcd5D3KNGINg7lnhH\r\nl+UILmOw+IrYzQ/qxZt2Drpod+mdlbPMv3uz00nMnX3DDd1GSjMWT7pS4JIvp2PU\r\nRqq/gRlzVwKBgB910VBuGBpFRc/WHpL8dk7ydsqy/0apogEEljzYu+ViJFXodNPC\r\nNU5/sSZkEiDZBWNNw6wBVAqUhxDz0tx2mVfWG2qT+i1n2XHXTk9lEfWPRT1RfUid\r\ns7NsfbwxBMylHfkpNSM6RsKh+4Cy+dfnrb1r5tA88oxBdj9SvfnlIJs9AoGBAKer\r\nYFav0Zg1rZ1bqP8TeVo67FXagdyTI7Nz5AcB0HyvV149I8h7DRICBVhb0XpY2ukq\r\n1SJkCDj2Hq73pJ8SYesNYLhytnLiSr3csOwHN9vWZw6fb8z2fvQqzOuoF9ANmOJu\r\ne3v2KOQdSr3OB22zgozjQmqpF5kGM3UqfqoP4pPdAoGAWI9rfNN9H0pfsbImhPir\r\nrtZK5SamUynx64G5JmqmbfkokfUYiw3N6vCJvCIPYHRdOXhip1GsIy4vp6soj52t\r\nBMyo/C1KwTtEcBap2duCoK4zMqnZmU1+TYYtr3djwtoEl9ak2X5FgUFgcq+z6uZ9\r\nWd2MELfncJSlettZ5+ZMxPE=\r\n-----END PRIVATE KEY-----\r\n</key>\r\n<tls-crypt>\r\n-----BEGIN OpenVPN Static key V1-----\r\nb40c8c28783d78e030a7ec25e834b360\r\nbc8d9d1421e555efe017b231655f7951\r\n5dfb449202a778dd4c6bd470ac9d36fb\r\ne97d932ee6a8845a68901071dde180e2\r\n5c7c9215bd98df7b4f16bafc31802871\r\n54136b9f5eccb3af8f671efb9d50bbe8\r\nd3db1a86973084b62b56c6add1f198a9\r\n73abea2130c4225ba170421e596f4a9e\r\n6b74d15f4865e4cb2b0bfc7952e1e70a\r\n3174bdbaf8827d834904421f4e3cd27c\r\n4b9fe048a5b6fbc96c64c25c0b87e54d\r\n826c6f0174393554544c30ed826b0fbe\r\nf7ff46b84eb64d7742ff4c0673ce39fe\r\n10f5f68034d457948299457d0c9a1526\r\n2b375651e7d160fd9bb1f892e90a3935\r\n5a86463d955243dd7b943f13013d4444\r\n-----END OpenVPN Static key V1-----\r\n</tls-crypt>', 'premium', 0, '2024-12-11 03:37:34', '2024-12-19 08:23:04'),
(2, 3, 'Pakistan', 'Helsinki', 'dovpn', 'vpn', 'client\r\ndev tun\r\nproto udp\r\nremote 65.109.1.226 1194\r\nresolv-retry infinite\r\nnobind\r\npersist-key\r\npersist-tun\r\nremote-cert-tls server\r\nauth SHA512\r\nignore-unknown-option block-outside-dns\r\nverb 3\r\n<ca>\r\n-----BEGIN CERTIFICATE-----\r\nMIIDSzCCAjOgAwIBAgIUYQePwvJgyGwT+Jn3YdcZOHIrs7wwDQYJKoZIhvcNAQEL\r\nBQAwFjEUMBIGA1UEAwwLRWFzeS1SU0EgQ0EwHhcNMjQxMTI2MDYzMTQwWhcNMzQx\r\nMTI0MDYzMTQwWjAWMRQwEgYDVQQDDAtFYXN5LVJTQSBDQTCCASIwDQYJKoZIhvcN\r\nAQEBBQADggEPADCCAQoCggEBAKCDJWdnFzpWTs9GUO/ue0M9b7RYthmB/jG3+nGx\r\nb5Ay38S4EfbMOaRcsQIlKkX0SRnHSshysQJ8DRHypv3Fv76O6AgZ+Z1RpfVyTT6p\r\nvzRnUxA3NakpPV5KebI/dl31oT7Bj2v4HLDw1OdZDArdrF1QfWnCAWlrTg8Ak4Mg\r\n6Rv0h/NLJE45vmc3JwST64bYtfKtLfXXYsn/Ke5dOjBMbTBVuwOrS+zukOUSqQYg\r\nrz9yN47dBidQVoQ8CNNJIIRVVPhGErL7v8u2tiIlZwCD+QXqLVqpXFNEnaL4tVQA\r\nQn5zMLC+8qEl9pSxsBY3Q/Wvdl4nIHmPkOAlFt5ebxXOaqkCAwEAAaOBkDCBjTAM\r\nBgNVHRMEBTADAQH/MB0GA1UdDgQWBBSmA9CJfAiUVoDe43bWXP4D3Hdz6DBRBgNV\r\nHSMESjBIgBSmA9CJfAiUVoDe43bWXP4D3Hdz6KEapBgwFjEUMBIGA1UEAwwLRWFz\r\neS1SU0EgQ0GCFGEHj8LyYMhsE/iZ92HXGThyK7O8MAsGA1UdDwQEAwIBBjANBgkq\r\nhkiG9w0BAQsFAAOCAQEAP/ov7VmJ8GKFGU7m1C1ZCIztSyBdNyDOKOs4d6dm1URw\r\nJKh7yQFhhEPndqbjiRs/+G85HZkFNYXR3C9be60cQhwxLyFp7ews7av2sZxUY50n\r\nQ+m5dvQFcHN1hEmSioIZxfmNYq8MHat28gjewKiRiUCeeB5jER/4N94maqa1qrKh\r\nFPkHPBPpv3aQBO/oQWQjOmPzhhmD+xDSgsiWmy+6Wum9cAGqNqVf/jFiIqLs9B+T\r\nLKMV56G+fPOb5XUgZJ8SQAkOEZ7nnGPZVv13pfV8nahCIwk0acd4z6aH66HAEZgd\r\nz1HNlc23KK74NTUX9DVl6QutMc9UhIgOpfhfYX/Okg==\r\n-----END CERTIFICATE-----\r\n</ca>\r\n<cert>\r\n-----BEGIN CERTIFICATE-----\r\nMIIDVDCCAjygAwIBAgIRAIuFJFn6ZtDFKYVqkbNhgeQwDQYJKoZIhvcNAQELBQAw\r\nFjEUMBIGA1UEAwwLRWFzeS1SU0EgQ0EwHhcNMjQxMTI2MDYzMTQxWhcNMzQxMTI0\r\nMDYzMTQxWjAQMQ4wDAYDVQQDDAVkb3ZwbjCCASIwDQYJKoZIhvcNAQEBBQADggEP\r\nADCCAQoCggEBAKs7XqiOmiSig+7G0uTEiHHFd5ICa34NJqeXgoWipvxfGRZMWCC1\r\nRgm+W08FtVCOwICWreBJuk5tP+M2XaQhYN4vRjjtBGEKJL6Nu3dmWC5DdBGReU42\r\nJUafQAiwOnvNiuj4wj7/osNV5wTZ/ojK/RYfWq2en2B/rocZ4gWVdDhSHMSTfGR7\r\nQWVYZ/l3wy4iTtV8qJmbMQjp8JHdBUjlt1wsln783mAtpHSoV1mlJaODjmtbj9Kv\r\n55xHVr8vfo66qPznoyDqx9W/qwuvQh9TgXCg/CRbpOmUSdyQHnX/2kSnJRSIiT9p\r\n/Iaw1hys8+LEJoeugsdM2ZIAyYHpwt4hL0cCAwEAAaOBojCBnzAJBgNVHRMEAjAA\r\nMB0GA1UdDgQWBBQw1ZHWs85wYaHDSdgv33vbb+YlHjBRBgNVHSMESjBIgBSmA9CJ\r\nfAiUVoDe43bWXP4D3Hdz6KEapBgwFjEUMBIGA1UEAwwLRWFzeS1SU0EgQ0GCFGEH\r\nj8LyYMhsE/iZ92HXGThyK7O8MBMGA1UdJQQMMAoGCCsGAQUFBwMCMAsGA1UdDwQE\r\nAwIHgDANBgkqhkiG9w0BAQsFAAOCAQEAdiHXuvmaz8Ug/OlRjHoTMAmMZyHvI0hs\r\nmBOJDhIiPk+V0LJNW06f5sIt+e8EZCrOHapZzVYed1V1rD5k8+f9G/f98eKblzU7\r\nPhlbCWzS3kfOKmi1RgTSzxph2Y5C7RMztYCiOOXJ/gkkDMPrX96Mebr5jWX5j2VR\r\nuK0TxjK8/GejNjVSaVbGbqiQhIMjuusoe9eAvPFZ9enR/9vpAL2gUI4G78ObwWF5\r\n9ujEhqNHNEWI4CyoKHJUd9H0A8VekQ1VZ8M36kxVagicH9O1nJKg4fHLCbdDBZHp\r\n++k0Vo+AX8LJfg5lKH3jiDIY6QDHxOeDJ2CfveXUMvQCUgiVSTDg/w==\r\n-----END CERTIFICATE-----\r\n</cert>\r\n<key>\r\n-----BEGIN PRIVATE KEY-----\r\nMIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQCrO16ojpokooPu\r\nxtLkxIhxxXeSAmt+DSanl4KFoqb8XxkWTFggtUYJvltPBbVQjsCAlq3gSbpObT/j\r\nNl2kIWDeL0Y47QRhCiS+jbt3ZlguQ3QRkXlONiVGn0AIsDp7zYro+MI+/6LDVecE\r\n2f6Iyv0WH1qtnp9gf66HGeIFlXQ4UhzEk3xke0FlWGf5d8MuIk7VfKiZmzEI6fCR\r\n3QVI5bdcLJZ+/N5gLaR0qFdZpSWjg45rW4/Sr+ecR1a/L36Ouqj856Mg6sfVv6sL\r\nr0IfU4FwoPwkW6TplEnckB51/9pEpyUUiIk/afyGsNYcrPPixCaHroLHTNmSAMmB\r\n6cLeIS9HAgMBAAECggEAHP9kY+Ima37UHeswysoXm0DII4NiZcnfWnFXir8FTWbj\r\nbjnGkN9x+XNxrhu23WoXYo9h6cJCmUZ6E8XgrMt0Rpw15a0J2U8o8tY4wZsk4szM\r\niq8anmqf/Go6o14IwW+JDzQVXSrYiwDwqwspxkut+YGczxs2PVbSHRH+i1iIgoLq\r\nYXX4iNnHejjIsmNaK4F1fT2WWBPkeRRuZTmQYSESjltMnzKf4TE+/d/AcGN32MXf\r\n0zUChYrGS6el5AzE8rVoeT8Cm2emrSdtYQM1zo7X+DxRxO3oSa6BDGyUZ0yjpPtu\r\nNi9pTOa1JHMAWkUg8Zw9v2dK41Ze+08rBeMD2HOvJQKBgQDZxQtD0uzTjF+YiFUZ\r\nNHuumMbqYijK9QcTb8Ej53NZRFmPm8W7FQobmfuAWpjyzcO0HTb4N98k8DWT/0FM\r\nBCI6eJo7IeAAYD7zbJtQIezVhCb4z/nn2U7pE8FNMp0cxTz4LnPJ0DoWm0TEfpqM\r\nDQKtFzQqh1UJgPVYs0agNwCipQKBgQDJStXH9q7LfwflwSaeVH56tyS5WIekOuqX\r\nb2eUyPIgeTCkONfHzkRjW3uNPSrBfmSID5ddPwFXcGj2HRFocpNIo3oH+UUE9Tq4\r\n4UCypNi1y1LneLIG4oMzn1rhFuPaviogrrsc6hJuGUY+rrniW2Wd2JMcb6+btrbN\r\nnNkX5KrCewKBgQDDmKg1kw4ENODoMAu/R9SPTcncW64oHUztuELR7OE+HJYU1uUS\r\n1CLwB65N6xHVg9tzu4nUCNr0Yoy9EVek31GfExP0aMi5jbj9C1+06cO/Q6N9d9AO\r\n3rBxyLymif90B/RrNc3qRozmIS/zDYPipwzwSxcf284Vay7zLJMS9FQtwQKBgB9U\r\n56vFaPXB4x/PDczNSBaf1TaIYiydAxDpRU0ybgXB92FIe8XdBGYWwkd8wt/1ZX6M\r\nNrpL6VCL7bqJUcFZPDWtRHxjP2wDI83NOf3UjOrXKCNhdQx/S37IiiPJJVRSD0qh\r\nB/z7Lj027+kn10U1hr6oDFX7yHDLYu7kQCJo9G9rAoGACjyovK3bLwjMRts1d6Kg\r\nzQdJ5kQ9PxFp6xRuI57Zvv5z3jlKt+AxSHH30DchYeS5BcKl66pRfPYHAxYv70Fy\r\nEs+w7UrrLXwNauFPX+90xK39BB9BBfJXxW5eZqFBDmrOJJtTDw5ZWiAAo07fNmMG\r\n9+i4J9qD7mBgL9iInlm6cYg=\r\n-----END PRIVATE KEY-----\r\n</key>\r\n<tls-crypt>\r\n-----BEGIN OpenVPN Static key V1-----\r\n595a02632495ac51e9ac1810ded87d2e\r\nfca292b3e8dfb485d747d6eb9b0471b6\r\nec63bd72471a81c9050c4659de395431\r\n3149bd6a112c14fb5f664a982b6d3d3d\r\n7c409d82514197c51e4982167c441f6f\r\nc87296ab2e0f4dba0e7003b341321a6e\r\nb6fb3041dee0469140f9e00bc3d5d076\r\n0271cf8b03a7b469b3cdd83e0d589fc6\r\nf93ed33f24eefe32928d070370d0a090\r\n61f6f738fe985a1508fa4bcb372494df\r\n3fbea74f360a1f498a5bff94554c49de\r\nc24888ec696ca8082f51e7611ec47d9f\r\nb6be45558d9fa67eb3823ac24c45f264\r\n4aac1da77c43e8399e77bcc094cacf42\r\n44821e1295736aeaa60ebf4bebd91dd6\r\n777198cb2c5327838b194285bb3244ae\r\n-----END OpenVPN Static key V1-----\r\n</tls-crypt>', 'client\r\ndev tun\r\nproto udp\r\nremote 65.109.1.226 1194\r\nresolv-retry infinite\r\nnobind\r\npersist-key\r\npersist-tun\r\nremote-cert-tls server\r\nauth SHA512\r\nignore-unknown-option block-outside-dns\r\nverb 3\r\n<ca>\r\n-----BEGIN CERTIFICATE-----\r\nMIIDSzCCAjOgAwIBAgIUYQePwvJgyGwT+Jn3YdcZOHIrs7wwDQYJKoZIhvcNAQEL\r\nBQAwFjEUMBIGA1UEAwwLRWFzeS1SU0EgQ0EwHhcNMjQxMTI2MDYzMTQwWhcNMzQx\r\nMTI0MDYzMTQwWjAWMRQwEgYDVQQDDAtFYXN5LVJTQSBDQTCCASIwDQYJKoZIhvcN\r\nAQEBBQADggEPADCCAQoCggEBAKCDJWdnFzpWTs9GUO/ue0M9b7RYthmB/jG3+nGx\r\nb5Ay38S4EfbMOaRcsQIlKkX0SRnHSshysQJ8DRHypv3Fv76O6AgZ+Z1RpfVyTT6p\r\nvzRnUxA3NakpPV5KebI/dl31oT7Bj2v4HLDw1OdZDArdrF1QfWnCAWlrTg8Ak4Mg\r\n6Rv0h/NLJE45vmc3JwST64bYtfKtLfXXYsn/Ke5dOjBMbTBVuwOrS+zukOUSqQYg\r\nrz9yN47dBidQVoQ8CNNJIIRVVPhGErL7v8u2tiIlZwCD+QXqLVqpXFNEnaL4tVQA\r\nQn5zMLC+8qEl9pSxsBY3Q/Wvdl4nIHmPkOAlFt5ebxXOaqkCAwEAAaOBkDCBjTAM\r\nBgNVHRMEBTADAQH/MB0GA1UdDgQWBBSmA9CJfAiUVoDe43bWXP4D3Hdz6DBRBgNV\r\nHSMESjBIgBSmA9CJfAiUVoDe43bWXP4D3Hdz6KEapBgwFjEUMBIGA1UEAwwLRWFz\r\neS1SU0EgQ0GCFGEHj8LyYMhsE/iZ92HXGThyK7O8MAsGA1UdDwQEAwIBBjANBgkq\r\nhkiG9w0BAQsFAAOCAQEAP/ov7VmJ8GKFGU7m1C1ZCIztSyBdNyDOKOs4d6dm1URw\r\nJKh7yQFhhEPndqbjiRs/+G85HZkFNYXR3C9be60cQhwxLyFp7ews7av2sZxUY50n\r\nQ+m5dvQFcHN1hEmSioIZxfmNYq8MHat28gjewKiRiUCeeB5jER/4N94maqa1qrKh\r\nFPkHPBPpv3aQBO/oQWQjOmPzhhmD+xDSgsiWmy+6Wum9cAGqNqVf/jFiIqLs9B+T\r\nLKMV56G+fPOb5XUgZJ8SQAkOEZ7nnGPZVv13pfV8nahCIwk0acd4z6aH66HAEZgd\r\nz1HNlc23KK74NTUX9DVl6QutMc9UhIgOpfhfYX/Okg==\r\n-----END CERTIFICATE-----\r\n</ca>\r\n<cert>\r\n-----BEGIN CERTIFICATE-----\r\nMIIDVDCCAjygAwIBAgIRAIuFJFn6ZtDFKYVqkbNhgeQwDQYJKoZIhvcNAQELBQAw\r\nFjEUMBIGA1UEAwwLRWFzeS1SU0EgQ0EwHhcNMjQxMTI2MDYzMTQxWhcNMzQxMTI0\r\nMDYzMTQxWjAQMQ4wDAYDVQQDDAVkb3ZwbjCCASIwDQYJKoZIhvcNAQEBBQADggEP\r\nADCCAQoCggEBAKs7XqiOmiSig+7G0uTEiHHFd5ICa34NJqeXgoWipvxfGRZMWCC1\r\nRgm+W08FtVCOwICWreBJuk5tP+M2XaQhYN4vRjjtBGEKJL6Nu3dmWC5DdBGReU42\r\nJUafQAiwOnvNiuj4wj7/osNV5wTZ/ojK/RYfWq2en2B/rocZ4gWVdDhSHMSTfGR7\r\nQWVYZ/l3wy4iTtV8qJmbMQjp8JHdBUjlt1wsln783mAtpHSoV1mlJaODjmtbj9Kv\r\n55xHVr8vfo66qPznoyDqx9W/qwuvQh9TgXCg/CRbpOmUSdyQHnX/2kSnJRSIiT9p\r\n/Iaw1hys8+LEJoeugsdM2ZIAyYHpwt4hL0cCAwEAAaOBojCBnzAJBgNVHRMEAjAA\r\nMB0GA1UdDgQWBBQw1ZHWs85wYaHDSdgv33vbb+YlHjBRBgNVHSMESjBIgBSmA9CJ\r\nfAiUVoDe43bWXP4D3Hdz6KEapBgwFjEUMBIGA1UEAwwLRWFzeS1SU0EgQ0GCFGEH\r\nj8LyYMhsE/iZ92HXGThyK7O8MBMGA1UdJQQMMAoGCCsGAQUFBwMCMAsGA1UdDwQE\r\nAwIHgDANBgkqhkiG9w0BAQsFAAOCAQEAdiHXuvmaz8Ug/OlRjHoTMAmMZyHvI0hs\r\nmBOJDhIiPk+V0LJNW06f5sIt+e8EZCrOHapZzVYed1V1rD5k8+f9G/f98eKblzU7\r\nPhlbCWzS3kfOKmi1RgTSzxph2Y5C7RMztYCiOOXJ/gkkDMPrX96Mebr5jWX5j2VR\r\nuK0TxjK8/GejNjVSaVbGbqiQhIMjuusoe9eAvPFZ9enR/9vpAL2gUI4G78ObwWF5\r\n9ujEhqNHNEWI4CyoKHJUd9H0A8VekQ1VZ8M36kxVagicH9O1nJKg4fHLCbdDBZHp\r\n++k0Vo+AX8LJfg5lKH3jiDIY6QDHxOeDJ2CfveXUMvQCUgiVSTDg/w==\r\n-----END CERTIFICATE-----\r\n</cert>\r\n<key>\r\n-----BEGIN PRIVATE KEY-----\r\nMIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQCrO16ojpokooPu\r\nxtLkxIhxxXeSAmt+DSanl4KFoqb8XxkWTFggtUYJvltPBbVQjsCAlq3gSbpObT/j\r\nNl2kIWDeL0Y47QRhCiS+jbt3ZlguQ3QRkXlONiVGn0AIsDp7zYro+MI+/6LDVecE\r\n2f6Iyv0WH1qtnp9gf66HGeIFlXQ4UhzEk3xke0FlWGf5d8MuIk7VfKiZmzEI6fCR\r\n3QVI5bdcLJZ+/N5gLaR0qFdZpSWjg45rW4/Sr+ecR1a/L36Ouqj856Mg6sfVv6sL\r\nr0IfU4FwoPwkW6TplEnckB51/9pEpyUUiIk/afyGsNYcrPPixCaHroLHTNmSAMmB\r\n6cLeIS9HAgMBAAECggEAHP9kY+Ima37UHeswysoXm0DII4NiZcnfWnFXir8FTWbj\r\nbjnGkN9x+XNxrhu23WoXYo9h6cJCmUZ6E8XgrMt0Rpw15a0J2U8o8tY4wZsk4szM\r\niq8anmqf/Go6o14IwW+JDzQVXSrYiwDwqwspxkut+YGczxs2PVbSHRH+i1iIgoLq\r\nYXX4iNnHejjIsmNaK4F1fT2WWBPkeRRuZTmQYSESjltMnzKf4TE+/d/AcGN32MXf\r\n0zUChYrGS6el5AzE8rVoeT8Cm2emrSdtYQM1zo7X+DxRxO3oSa6BDGyUZ0yjpPtu\r\nNi9pTOa1JHMAWkUg8Zw9v2dK41Ze+08rBeMD2HOvJQKBgQDZxQtD0uzTjF+YiFUZ\r\nNHuumMbqYijK9QcTb8Ej53NZRFmPm8W7FQobmfuAWpjyzcO0HTb4N98k8DWT/0FM\r\nBCI6eJo7IeAAYD7zbJtQIezVhCb4z/nn2U7pE8FNMp0cxTz4LnPJ0DoWm0TEfpqM\r\nDQKtFzQqh1UJgPVYs0agNwCipQKBgQDJStXH9q7LfwflwSaeVH56tyS5WIekOuqX\r\nb2eUyPIgeTCkONfHzkRjW3uNPSrBfmSID5ddPwFXcGj2HRFocpNIo3oH+UUE9Tq4\r\n4UCypNi1y1LneLIG4oMzn1rhFuPaviogrrsc6hJuGUY+rrniW2Wd2JMcb6+btrbN\r\nnNkX5KrCewKBgQDDmKg1kw4ENODoMAu/R9SPTcncW64oHUztuELR7OE+HJYU1uUS\r\n1CLwB65N6xHVg9tzu4nUCNr0Yoy9EVek31GfExP0aMi5jbj9C1+06cO/Q6N9d9AO\r\n3rBxyLymif90B/RrNc3qRozmIS/zDYPipwzwSxcf284Vay7zLJMS9FQtwQKBgB9U\r\n56vFaPXB4x/PDczNSBaf1TaIYiydAxDpRU0ybgXB92FIe8XdBGYWwkd8wt/1ZX6M\r\nNrpL6VCL7bqJUcFZPDWtRHxjP2wDI83NOf3UjOrXKCNhdQx/S37IiiPJJVRSD0qh\r\nB/z7Lj027+kn10U1hr6oDFX7yHDLYu7kQCJo9G9rAoGACjyovK3bLwjMRts1d6Kg\r\nzQdJ5kQ9PxFp6xRuI57Zvv5z3jlKt+AxSHH30DchYeS5BcKl66pRfPYHAxYv70Fy\r\nEs+w7UrrLXwNauFPX+90xK39BB9BBfJXxW5eZqFBDmrOJJtTDw5ZWiAAo07fNmMG\r\n9+i4J9qD7mBgL9iInlm6cYg=\r\n-----END PRIVATE KEY-----\r\n</key>\r\n<tls-crypt>\r\n-----BEGIN OpenVPN Static key V1-----\r\n595a02632495ac51e9ac1810ded87d2e\r\nfca292b3e8dfb485d747d6eb9b0471b6\r\nec63bd72471a81c9050c4659de395431\r\n3149bd6a112c14fb5f664a982b6d3d3d\r\n7c409d82514197c51e4982167c441f6f\r\nc87296ab2e0f4dba0e7003b341321a6e\r\nb6fb3041dee0469140f9e00bc3d5d076\r\n0271cf8b03a7b469b3cdd83e0d589fc6\r\nf93ed33f24eefe32928d070370d0a090\r\n61f6f738fe985a1508fa4bcb372494df\r\n3fbea74f360a1f498a5bff94554c49de\r\nc24888ec696ca8082f51e7611ec47d9f\r\nb6be45558d9fa67eb3823ac24c45f264\r\n4aac1da77c43e8399e77bcc094cacf42\r\n44821e1295736aeaa60ebf4bebd91dd6\r\n777198cb2c5327838b194285bb3244ae\r\n-----END OpenVPN Static key V1-----\r\n</tls-crypt>', 'free', 0, '2024-12-11 03:38:07', '2024-12-19 08:22:25'),
(3, 2, 'India', 'Nuremberg-1', 'tigervpn', 'tigervpn', 'client\r\ndev tun\r\nproto udp\r\nremote 128.140.42.2 1194\r\nresolv-retry infinite\r\nnobind\r\npersist-key\r\npersist-tun\r\nremote-cert-tls server\r\nauth SHA256\r\ncipher AES-128-GCM\r\nignore-unknown-option block-outside-dns block-ipv6\r\nverb 3\r\n<ca>\r\n-----BEGIN CERTIFICATE-----\r\nMIIDSzCCAjOgAwIBAgIUB+bC82HvQtwyta3VzlWFuXCtQ6swDQYJKoZIhvcNAQEL\r\nBQAwFjEUMBIGA1UEAwwLRWFzeS1SU0EgQ0EwHhcNMjQxMTI4MDczOTA5WhcNMzQx\r\nMTI2MDczOTA5WjAWMRQwEgYDVQQDDAtFYXN5LVJTQSBDQTCCASIwDQYJKoZIhvcN\r\nAQEBBQADggEPADCCAQoCggEBALU8LSRfr9FsVANVNpcv6PwDTClPL9wLwUh6R1xr\r\n2+n34AeGbL4QuiEbBLr2P+7vrzgDQhYJzzb54MPtP985J+prsesf5UOTO8wNksF0\r\nAMpAcE0VQ6AOZrANwq9THnKB1TmbGKdKASJ7FaW1vZ0NLrACTqO5K+eRlXg0cmD1\r\nPVC21H14vrTGGD1c9FAwydQdcWBVXKx5FucKnLs0SRvy4zW6SEHew1X5yIcg0WYw\r\nftL8vt3soqluXLH3OVgEyX+V3AqnS//zqrBew5rtj6ylJssD2W0TSh71+5wsrg8B\r\nRLzF6M0+0zaS0K1WhZj+qMKZu4K7MiqreWXmmHBsUBmjXI8CAwEAAaOBkDCBjTAM\r\nBgNVHRMEBTADAQH/MB0GA1UdDgQWBBQ+FJfTqNjeaTWC+4SphlGoCxzIyzBRBgNV\r\nHSMESjBIgBQ+FJfTqNjeaTWC+4SphlGoCxzIy6EapBgwFjEUMBIGA1UEAwwLRWFz\r\neS1SU0EgQ0GCFAfmwvNh70LcMrWt1c5VhblwrUOrMAsGA1UdDwQEAwIBBjANBgkq\r\nhkiG9w0BAQsFAAOCAQEAj2FuBaUCxpc/HtscgE4NyX4NuN0u4i2+B8XJCC7YO24C\r\nvA4rXVlVHEqkGT4nw58evBLeEfkVEny1d/N1De6lKHYL43jarIye0QKTnN+MlErP\r\nI/PS/EpX/eXF224c4SHs9DAtEjMSXMSQHm0o3cyq7tz0DlWvDhIRbMMnhE/DPNws\r\n9UJsBE/RtBpNdM9iRH4J/m22CGMr4DS6t9IVb4VZnRvA5kO8aFeattXQL/ofyJEY\r\nfBVNuE+uHUEEhRShC3HXpZEZGWW6vpIe8jMFvvGOfMUVMnUkqIoTJSExHT4b52Jr\r\nrDcz5fPObloxP9sF1D3Sb7x42HH/D7vFG/nK5+UbWg==\r\n-----END CERTIFICATE-----\r\n</ca>\r\n<cert>\r\n-----BEGIN CERTIFICATE-----\r\nMIIDVzCCAj+gAwIBAgIRAPx+zM0WKbaulM1FjhMKopYwDQYJKoZIhvcNAQELBQAw\r\nFjEUMBIGA1UEAwwLRWFzeS1SU0EgQ0EwHhcNMjQxMTI4MDczOTEwWhcNMzQxMTI2\r\nMDczOTEwWjATMREwDwYDVQQDDAh0aWdlcnZwbjCCASIwDQYJKoZIhvcNAQEBBQAD\r\nggEPADCCAQoCggEBAN4sPIgTi1wopQ2mjHQkUpR5XHZ+etcatq6SjIrRI/CmDMVN\r\ny2RBXI5b2vUkl3+ZgD+v9ldLClZvitJtigua2Ky5uamCQkXCSVXR5G9QCp+dEGhA\r\nFrGRAZHawAMd53mnN/zX1MTMjcEaDh882mbcStWrQctWS1ObawDNGODTjUlgnsru\r\nv5wg2kS6I3Dg1ZtBID7v9KoOtAG4MfNq0qLkPMASQYeQ8sHd+O/Tysg9P5BJZWBQ\r\n0wWIYQDHFRFf6oVuDPRxpgtloDGmLNr4EThY61ZGPzm5+Jrc1J6XE21gM85qYLge\r\n155nBdW04MFgPhvpLtN7dAPExWUiKsbJcNH/ZrkCAwEAAaOBojCBnzAJBgNVHRME\r\nAjAAMB0GA1UdDgQWBBTyJ2MCQ+55NCRXnU9ZPmg8PpbcJzBRBgNVHSMESjBIgBQ+\r\nFJfTqNjeaTWC+4SphlGoCxzIy6EapBgwFjEUMBIGA1UEAwwLRWFzeS1SU0EgQ0GC\r\nFAfmwvNh70LcMrWt1c5VhblwrUOrMBMGA1UdJQQMMAoGCCsGAQUFBwMCMAsGA1Ud\r\nDwQEAwIHgDANBgkqhkiG9w0BAQsFAAOCAQEASf1X62VoLK4WW8tbgRaFLAqSfaBS\r\nRk0TpxvEwTuvz3mQw+XKLL2Z4VDJVCcTyobbrHgbiBfgnp/QDfzKQFz6jwvxPnLb\r\nBubeFB9d+e/EEi/m5AI4pJCGws/PTIwa7ImlzcsHbfoqwHKD9nvj0irOHgfTHLLZ\r\njWr6EXrER6zCacDR+0wegCcqhUjos7Izr3evhFNvfCcOrKw2K1vylMBW2tkBYS42\r\nIWtimU1QJOHtSoYnZhGEhxtCirV8/v5myIN55elt/LOyFaxdUIXKt6Hq1y0HQuG5\r\nOJLGU9FlhOeilGdMlkpETYwIYAr4pOWMp4JWeZIDJCfALLA9OvdqyRonzA==\r\n-----END CERTIFICATE-----\r\n</cert>\r\n<key>\r\n-----BEGIN PRIVATE KEY-----\r\nMIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQDeLDyIE4tcKKUN\r\npox0JFKUeVx2fnrXGraukoyK0SPwpgzFTctkQVyOW9r1JJd/mYA/r/ZXSwpWb4rS\r\nbYoLmtisubmpgkJFwklV0eRvUAqfnRBoQBaxkQGR2sADHed5pzf819TEzI3BGg4f\r\nPNpm3ErVq0HLVktTm2sAzRjg041JYJ7K7r+cINpEuiNw4NWbQSA+7/SqDrQBuDHz\r\natKi5DzAEkGHkPLB3fjv08rIPT+QSWVgUNMFiGEAxxURX+qFbgz0caYLZaAxpiza\r\n+BE4WOtWRj85ufia3NSelxNtYDPOamC4HteeZwXVtODBYD4b6S7Te3QDxMVlIirG\r\nyXDR/2a5AgMBAAECggEAGzn8k7MhdEJ0MlS4svrzNnLGRqx/9/W0HCH6yyrku/b9\r\nav3Pm7z5ehCo/TsQvc2yjnDNQCwCsPkBCtdAVY+9Ad3OHNxzrAIqjokm9LqFssMY\r\nDE6I+WsLGt6zLS6a+/48DuY8PX8mgrA4uXycSdgGlmINsWd6hQfEzdep4X4guwm7\r\nqFIOaCdzxGZA7QxqSICuX/85yA7R4aw5HcAWYwW27+5DTji+v6aM3oHNn4ppxUWR\r\nBdZ5ya+QiLancEa2d9SsueZFrGnKPbkrYInbE3+s9yYbAxeqzKQDT3CWNRWRWHWS\r\nCevScvft8frDFD0LfHdgTd90yr/n9enpGHGm2oaTaQKBgQD5tLqCdGgDBRENCDj2\r\n06gh+UN4NquqeBVZVBIAdQHRhX/7NgCFtKPfbwmLR+mSpgdijjy6OaQopvaTM5hM\r\n9LzpjcYfQR5Kcn/HIINu3ycdE8/8H24r32ftC6FrNee35SCdNg8cF4OZ7+YWDX5D\r\nqynVbH4ikQaJw3ejknhXUpw9owKBgQDjxdhk3Wo3yulpbxgidAhhK3bAbnALVATO\r\nJaFoMNsx8yduqDhw3TPrp3cMvARpy8j7d0ATRCqdXW5/ORC8ECKIRzsFVXvjCGr6\r\nmDmSOAqrYhcpq7Bb0hVYLK+mNVpRAadwhXdFwUAV1nFSRIc6VXTCD87YH/OiEBCE\r\niWu/lS/X8wKBgQCw2xkyJmI4qVD/SvCVmSk/Dr2Dmi0RqsVsJEgvvK+SBxyy/vd1\r\nu5BJQuqelEtRS3h1jEpkl0i2ZjLD5UocT0axoHFPV56tmdT4YwXT9AdO5+ZqKpSs\r\nTCneUVt9hIteytDDqDMhcWILGEd9HQdtw//4IkRgFRltX10QJEBJkMAKQwKBgFZ7\r\nAO1TEAg896B7eMtkCOZz7TOk+s+iR+zJZt47Zo4xhzBBmKRpqFP6En54SKiuohGw\r\nNljaUd/L4K9XSF5PNf1OJj+hNFeAE7Yv4/P7aTmnFapRsLU8L7R5yvstWKxXF27m\r\njeGjPSTNddtJf5qLZbhk7iErCILo3Iyl7I4iI7c3AoGAYzKx7UcQY4EbisBzEb1j\r\nQsVAa+1bbC1uyr46JFwi3T4o9xMy56Z4wWNbTNiROjSIQAj0nphW54uE+Z81yxfW\r\nVyZjaN/F0D4X6HS4htABDhW1VngujGZySGAClhrSbvKa8sHqxugr0K8zKdC71YhX\r\nSfPmwQurY8JXW6X8OEX/VzM=\r\n-----END PRIVATE KEY-----\r\n</key>\r\n<tls-crypt>\r\n-----BEGIN OpenVPN Static key V1-----\r\n854fdf796e3e80d9651c3d5909605a6f\r\n636dd18c4b0da5f47e5130bc516002b2\r\nd5431a11aeaba51dc77660990d5110ae\r\ne6e4492549b55c9ae33e2c06fe955932\r\n67f2952a6b4b93537d6e218c06f23551\r\n6fcf672b360d1f4bbe5d9bd742fa2981\r\n988f7cfe1104855ec6ceb9ea3c286f6d\r\n5ab36c6c1a0223bec1d24925d6c65934\r\n4918e57269e38f4b89aa7cbfb5d79015\r\nf2bc7c85f44d028dad642b0ba1fb1b3b\r\n4959a61ee09c4240635a51d1f513f741\r\n2c845fc033a430bf628edc79ba5131a9\r\n93f870a366d3d25285f9c789388b2a68\r\n5a864f08f5b7b6941b884cfb54a1dff1\r\n1b01839088d408e14ea3b065cd681ecf\r\nda5ce5cd9b4df37bef920ecf4487489d\r\n-----END OpenVPN Static key V1-----\r\n</tls-crypt>', 'client\r\ndev tun\r\nproto udp\r\nremote 128.140.42.2 1194\r\nresolv-retry infinite\r\nnobind\r\npersist-key\r\npersist-tun\r\nremote-cert-tls server\r\nauth SHA256\r\ncipher AES-128-GCM\r\nignore-unknown-option block-outside-dns block-ipv6\r\nverb 3\r\n<ca>\r\n-----BEGIN CERTIFICATE-----\r\nMIIDSzCCAjOgAwIBAgIUB+bC82HvQtwyta3VzlWFuXCtQ6swDQYJKoZIhvcNAQEL\r\nBQAwFjEUMBIGA1UEAwwLRWFzeS1SU0EgQ0EwHhcNMjQxMTI4MDczOTA5WhcNMzQx\r\nMTI2MDczOTA5WjAWMRQwEgYDVQQDDAtFYXN5LVJTQSBDQTCCASIwDQYJKoZIhvcN\r\nAQEBBQADggEPADCCAQoCggEBALU8LSRfr9FsVANVNpcv6PwDTClPL9wLwUh6R1xr\r\n2+n34AeGbL4QuiEbBLr2P+7vrzgDQhYJzzb54MPtP985J+prsesf5UOTO8wNksF0\r\nAMpAcE0VQ6AOZrANwq9THnKB1TmbGKdKASJ7FaW1vZ0NLrACTqO5K+eRlXg0cmD1\r\nPVC21H14vrTGGD1c9FAwydQdcWBVXKx5FucKnLs0SRvy4zW6SEHew1X5yIcg0WYw\r\nftL8vt3soqluXLH3OVgEyX+V3AqnS//zqrBew5rtj6ylJssD2W0TSh71+5wsrg8B\r\nRLzF6M0+0zaS0K1WhZj+qMKZu4K7MiqreWXmmHBsUBmjXI8CAwEAAaOBkDCBjTAM\r\nBgNVHRMEBTADAQH/MB0GA1UdDgQWBBQ+FJfTqNjeaTWC+4SphlGoCxzIyzBRBgNV\r\nHSMESjBIgBQ+FJfTqNjeaTWC+4SphlGoCxzIy6EapBgwFjEUMBIGA1UEAwwLRWFz\r\neS1SU0EgQ0GCFAfmwvNh70LcMrWt1c5VhblwrUOrMAsGA1UdDwQEAwIBBjANBgkq\r\nhkiG9w0BAQsFAAOCAQEAj2FuBaUCxpc/HtscgE4NyX4NuN0u4i2+B8XJCC7YO24C\r\nvA4rXVlVHEqkGT4nw58evBLeEfkVEny1d/N1De6lKHYL43jarIye0QKTnN+MlErP\r\nI/PS/EpX/eXF224c4SHs9DAtEjMSXMSQHm0o3cyq7tz0DlWvDhIRbMMnhE/DPNws\r\n9UJsBE/RtBpNdM9iRH4J/m22CGMr4DS6t9IVb4VZnRvA5kO8aFeattXQL/ofyJEY\r\nfBVNuE+uHUEEhRShC3HXpZEZGWW6vpIe8jMFvvGOfMUVMnUkqIoTJSExHT4b52Jr\r\nrDcz5fPObloxP9sF1D3Sb7x42HH/D7vFG/nK5+UbWg==\r\n-----END CERTIFICATE-----\r\n</ca>\r\n<cert>\r\n-----BEGIN CERTIFICATE-----\r\nMIIDVzCCAj+gAwIBAgIRAPx+zM0WKbaulM1FjhMKopYwDQYJKoZIhvcNAQELBQAw\r\nFjEUMBIGA1UEAwwLRWFzeS1SU0EgQ0EwHhcNMjQxMTI4MDczOTEwWhcNMzQxMTI2\r\nMDczOTEwWjATMREwDwYDVQQDDAh0aWdlcnZwbjCCASIwDQYJKoZIhvcNAQEBBQAD\r\nggEPADCCAQoCggEBAN4sPIgTi1wopQ2mjHQkUpR5XHZ+etcatq6SjIrRI/CmDMVN\r\ny2RBXI5b2vUkl3+ZgD+v9ldLClZvitJtigua2Ky5uamCQkXCSVXR5G9QCp+dEGhA\r\nFrGRAZHawAMd53mnN/zX1MTMjcEaDh882mbcStWrQctWS1ObawDNGODTjUlgnsru\r\nv5wg2kS6I3Dg1ZtBID7v9KoOtAG4MfNq0qLkPMASQYeQ8sHd+O/Tysg9P5BJZWBQ\r\n0wWIYQDHFRFf6oVuDPRxpgtloDGmLNr4EThY61ZGPzm5+Jrc1J6XE21gM85qYLge\r\n155nBdW04MFgPhvpLtN7dAPExWUiKsbJcNH/ZrkCAwEAAaOBojCBnzAJBgNVHRME\r\nAjAAMB0GA1UdDgQWBBTyJ2MCQ+55NCRXnU9ZPmg8PpbcJzBRBgNVHSMESjBIgBQ+\r\nFJfTqNjeaTWC+4SphlGoCxzIy6EapBgwFjEUMBIGA1UEAwwLRWFzeS1SU0EgQ0GC\r\nFAfmwvNh70LcMrWt1c5VhblwrUOrMBMGA1UdJQQMMAoGCCsGAQUFBwMCMAsGA1Ud\r\nDwQEAwIHgDANBgkqhkiG9w0BAQsFAAOCAQEASf1X62VoLK4WW8tbgRaFLAqSfaBS\r\nRk0TpxvEwTuvz3mQw+XKLL2Z4VDJVCcTyobbrHgbiBfgnp/QDfzKQFz6jwvxPnLb\r\nBubeFB9d+e/EEi/m5AI4pJCGws/PTIwa7ImlzcsHbfoqwHKD9nvj0irOHgfTHLLZ\r\njWr6EXrER6zCacDR+0wegCcqhUjos7Izr3evhFNvfCcOrKw2K1vylMBW2tkBYS42\r\nIWtimU1QJOHtSoYnZhGEhxtCirV8/v5myIN55elt/LOyFaxdUIXKt6Hq1y0HQuG5\r\nOJLGU9FlhOeilGdMlkpETYwIYAr4pOWMp4JWeZIDJCfALLA9OvdqyRonzA==\r\n-----END CERTIFICATE-----\r\n</cert>\r\n<key>\r\n-----BEGIN PRIVATE KEY-----\r\nMIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQDeLDyIE4tcKKUN\r\npox0JFKUeVx2fnrXGraukoyK0SPwpgzFTctkQVyOW9r1JJd/mYA/r/ZXSwpWb4rS\r\nbYoLmtisubmpgkJFwklV0eRvUAqfnRBoQBaxkQGR2sADHed5pzf819TEzI3BGg4f\r\nPNpm3ErVq0HLVktTm2sAzRjg041JYJ7K7r+cINpEuiNw4NWbQSA+7/SqDrQBuDHz\r\natKi5DzAEkGHkPLB3fjv08rIPT+QSWVgUNMFiGEAxxURX+qFbgz0caYLZaAxpiza\r\n+BE4WOtWRj85ufia3NSelxNtYDPOamC4HteeZwXVtODBYD4b6S7Te3QDxMVlIirG\r\nyXDR/2a5AgMBAAECggEAGzn8k7MhdEJ0MlS4svrzNnLGRqx/9/W0HCH6yyrku/b9\r\nav3Pm7z5ehCo/TsQvc2yjnDNQCwCsPkBCtdAVY+9Ad3OHNxzrAIqjokm9LqFssMY\r\nDE6I+WsLGt6zLS6a+/48DuY8PX8mgrA4uXycSdgGlmINsWd6hQfEzdep4X4guwm7\r\nqFIOaCdzxGZA7QxqSICuX/85yA7R4aw5HcAWYwW27+5DTji+v6aM3oHNn4ppxUWR\r\nBdZ5ya+QiLancEa2d9SsueZFrGnKPbkrYInbE3+s9yYbAxeqzKQDT3CWNRWRWHWS\r\nCevScvft8frDFD0LfHdgTd90yr/n9enpGHGm2oaTaQKBgQD5tLqCdGgDBRENCDj2\r\n06gh+UN4NquqeBVZVBIAdQHRhX/7NgCFtKPfbwmLR+mSpgdijjy6OaQopvaTM5hM\r\n9LzpjcYfQR5Kcn/HIINu3ycdE8/8H24r32ftC6FrNee35SCdNg8cF4OZ7+YWDX5D\r\nqynVbH4ikQaJw3ejknhXUpw9owKBgQDjxdhk3Wo3yulpbxgidAhhK3bAbnALVATO\r\nJaFoMNsx8yduqDhw3TPrp3cMvARpy8j7d0ATRCqdXW5/ORC8ECKIRzsFVXvjCGr6\r\nmDmSOAqrYhcpq7Bb0hVYLK+mNVpRAadwhXdFwUAV1nFSRIc6VXTCD87YH/OiEBCE\r\niWu/lS/X8wKBgQCw2xkyJmI4qVD/SvCVmSk/Dr2Dmi0RqsVsJEgvvK+SBxyy/vd1\r\nu5BJQuqelEtRS3h1jEpkl0i2ZjLD5UocT0axoHFPV56tmdT4YwXT9AdO5+ZqKpSs\r\nTCneUVt9hIteytDDqDMhcWILGEd9HQdtw//4IkRgFRltX10QJEBJkMAKQwKBgFZ7\r\nAO1TEAg896B7eMtkCOZz7TOk+s+iR+zJZt47Zo4xhzBBmKRpqFP6En54SKiuohGw\r\nNljaUd/L4K9XSF5PNf1OJj+hNFeAE7Yv4/P7aTmnFapRsLU8L7R5yvstWKxXF27m\r\njeGjPSTNddtJf5qLZbhk7iErCILo3Iyl7I4iI7c3AoGAYzKx7UcQY4EbisBzEb1j\r\nQsVAa+1bbC1uyr46JFwi3T4o9xMy56Z4wWNbTNiROjSIQAj0nphW54uE+Z81yxfW\r\nVyZjaN/F0D4X6HS4htABDhW1VngujGZySGAClhrSbvKa8sHqxugr0K8zKdC71YhX\r\nSfPmwQurY8JXW6X8OEX/VzM=\r\n-----END PRIVATE KEY-----\r\n</key>\r\n<tls-crypt>\r\n-----BEGIN OpenVPN Static key V1-----\r\n854fdf796e3e80d9651c3d5909605a6f\r\n636dd18c4b0da5f47e5130bc516002b2\r\nd5431a11aeaba51dc77660990d5110ae\r\ne6e4492549b55c9ae33e2c06fe955932\r\n67f2952a6b4b93537d6e218c06f23551\r\n6fcf672b360d1f4bbe5d9bd742fa2981\r\n988f7cfe1104855ec6ceb9ea3c286f6d\r\n5ab36c6c1a0223bec1d24925d6c65934\r\n4918e57269e38f4b89aa7cbfb5d79015\r\nf2bc7c85f44d028dad642b0ba1fb1b3b\r\n4959a61ee09c4240635a51d1f513f741\r\n2c845fc033a430bf628edc79ba5131a9\r\n93f870a366d3d25285f9c789388b2a68\r\n5a864f08f5b7b6941b884cfb54a1dff1\r\n1b01839088d408e14ea3b065cd681ecf\r\nda5ce5cd9b4df37bef920ecf4487489d\r\n-----END OpenVPN Static key V1-----\r\n</tls-crypt>', 'premium', 0, '2024-12-11 03:38:49', '2024-12-19 08:19:43');

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
('FrgN3tcm349add7DUCa10AHGn3hIh50ZE92p7m3e', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiV2kxNURzYjRtM2VLa2IyQlVLR0JUZ0E0SXdyMHlnYjlXUnc4R2VFdSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTM6Imh0dHA6Ly9sb2NhbGhvc3QvVlBOQ29kZUNhbnlvbi9wdWJsaWMvYWRtaW4vZGFzaGJvYXJkIjt9czo1MjoibG9naW5fYWRtaW5fNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1734595277),
('fYs7SjMlJhsnksraYhZnvShqPs1I0uNOZ9FHocuA', NULL, '192.168.68.102', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVUlvVVIwTkl0NlFtRG5TU2ZjaU4xWEhTbUdPOVV6bVNaWnZTc0M1YSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjM6Imh0dHA6Ly8xOTIuMTY4LjY4LjExNC9WUE5Db2RlQ2FueW9uL3B1YmxpYy9hZG1pbi9zZXJ2ZXJzLzMvZWRpdCI7fXM6NTI6ImxvZ2luX2FkbWluXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1734596759),
('qaB12P2d0ZpR7cLjJO35zmlu94CuuV6KOIrcuuwD', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTXlZZXNHbkpYSFNlaEt6YkJRU3B4dEc4a0FsRE9PaHRkb0ppdVlObyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi91c2VycyI7fXM6NTI6ImxvZ2luX2FkbWluXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1734589789);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `otp` varchar(6) DEFAULT NULL,
  `expires_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_verified` tinyint(1) NOT NULL DEFAULT 0,
  `login_mode` varchar(20) NOT NULL DEFAULT 'guest',
  `device_id` varchar(255) NOT NULL,
  `profile_image` text DEFAULT NULL,
  `status` tinyint(3) UNSIGNED DEFAULT 0 COMMENT '0: active, 1: blocked',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `password`, `otp`, `expires_at`, `is_verified`, `login_mode`, `device_id`, `profile_image`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Test Dev', 'test.dev@gmail.com', '+88051967678789', '$2y$12$ajiQOL428/8NjSiTaMJ7ZO0fUGXxnOlKacG6MjWkkaJzoem9NVavS', NULL, '2024-12-19 07:45:46', 0, 'pro', 'SKQ1.211019.001', NULL, 0, NULL, '2024-12-19 06:36:52', '2024-12-19 07:45:46');

-- --------------------------------------------------------

--
-- Table structure for table `user_packages`
--

CREATE TABLE `user_packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `package_id` bigint(20) UNSIGNED NOT NULL,
  `package_duration` int(11) DEFAULT NULL,
  `purchased_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_packages`
--

INSERT INTO `user_packages` (`id`, `user_id`, `package_id`, `package_duration`, `purchased_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 7, '2024-12-19 06:46:12', '2024-12-26 06:46:12', '2024-12-19 06:46:12', '2024-12-19 06:46:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_username_unique` (`username`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `advertisements`
--
ALTER TABLE `advertisements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_settings`
--
ALTER TABLE `app_settings`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `devices_device_id_fcm_token_unique` (`device_id`,`fcm_token`),
  ADD KEY `devices_device_id_index` (`device_id`),
  ADD KEY `devices_fcm_token_index` (`fcm_token`);

--
-- Indexes for table `email_configurations`
--
ALTER TABLE `email_configurations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_templates`
--
ALTER TABLE `email_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_templates_slug_unique` (`slug`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `global_email_templates`
--
ALTER TABLE `global_email_templates`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `package_pricings`
--
ALTER TABLE `package_pricings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pages_slug_unique` (`slug`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `servers`
--
ALTER TABLE `servers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `servers_country_id_foreign` (`country_id`);

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
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- Indexes for table `user_packages`
--
ALTER TABLE `user_packages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_packages_user_id_foreign` (`user_id`),
  ADD KEY `user_packages_package_id_foreign` (`package_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `advertisements`
--
ALTER TABLE `advertisements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_settings`
--
ALTER TABLE `app_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `devices`
--
ALTER TABLE `devices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `email_configurations`
--
ALTER TABLE `email_configurations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `global_email_templates`
--
ALTER TABLE `global_email_templates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `package_pricings`
--
ALTER TABLE `package_pricings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `servers`
--
ALTER TABLE `servers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_packages`
--
ALTER TABLE `user_packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `servers`
--
ALTER TABLE `servers`
  ADD CONSTRAINT `servers_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_packages`
--
ALTER TABLE `user_packages`
  ADD CONSTRAINT `user_packages_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `package_pricings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_packages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
