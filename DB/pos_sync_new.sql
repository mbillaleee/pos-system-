-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2023 at 06:22 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos_sync_new`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_transections`
--

CREATE TABLE `account_transections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shop_id` bigint(20) UNSIGNED NOT NULL,
  `vouch_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vouch_date` date NOT NULL,
  `chartofacc_id` bigint(20) UNSIGNED NOT NULL,
  `debit` double DEFAULT NULL,
  `credit` double DEFAULT NULL,
  `supplier_id` bigint(20) UNSIGNED DEFAULT NULL,
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `account_transections`
--

INSERT INTO `account_transections` (`id`, `shop_id`, `vouch_no`, `vouch_date`, `chartofacc_id`, `debit`, `credit`, `supplier_id`, `customer_id`, `created_at`, `updated_at`) VALUES
(1, 1, '5345232', '2023-01-09', 5, 800, NULL, 1, NULL, '2023-01-09 05:35:01', '2023-01-09 05:35:01'),
(2, 1, '5345232', '2023-01-09', 7, NULL, 800, 1, NULL, '2023-01-09 05:35:01', '2023-01-09 05:35:01'),
(3, 1, '5345232', '2023-01-01', 6, NULL, 12000, NULL, 7, '2023-01-09 05:38:33', '2023-01-09 05:38:33'),
(4, 1, '5345232', '2023-01-01', 8, 12000, NULL, NULL, 7, '2023-01-09 05:38:33', '2023-01-09 05:38:33'),
(5, 1, '5345232', '2023-01-01', 6, NULL, 5000, NULL, 7, '2023-01-09 05:39:17', '2023-01-09 05:39:17'),
(6, 1, '5345232', '2023-01-01', 8, 5000, NULL, NULL, 7, '2023-01-09 05:39:17', '2023-01-09 05:39:17'),
(7, 1, '5345232', '2023-01-09', 5, 9600, NULL, 1, NULL, '2023-01-09 05:42:05', '2023-01-09 05:42:05'),
(8, 1, '5345232', '2023-01-09', 7, NULL, 9600, 1, NULL, '2023-01-09 05:42:05', '2023-01-09 05:42:05'),
(9, 1, '5345232', '2023-01-09', 6, NULL, 5000, NULL, 7, '2023-01-09 05:43:05', '2023-01-09 05:43:05'),
(10, 1, '5345232', '2023-01-09', 8, 5000, NULL, NULL, 7, '2023-01-09 05:43:06', '2023-01-09 05:43:06'),
(11, 1, '2412423423', '2023-01-10', 5, 1000, NULL, 1, NULL, '2023-01-10 04:26:30', '2023-01-10 04:26:30'),
(12, 1, '2412423423', '2023-01-10', 9, NULL, 100, 1, NULL, '2023-01-10 04:26:30', '2023-01-10 04:26:30'),
(13, 1, '2412423423', '2023-01-10', 7, NULL, 900, 1, NULL, '2023-01-10 04:26:31', '2023-01-10 04:26:31'),
(14, 1, '111111111', '2023-01-09', 5, 1000, NULL, 1, NULL, '2023-01-10 04:28:08', '2023-01-10 04:28:08'),
(15, 1, '111111111', '2023-01-09', 9, NULL, 200, 1, NULL, '2023-01-10 04:28:08', '2023-01-10 04:28:08'),
(16, 1, '11111111', '2023-01-08', 6, NULL, 1100, NULL, 7, '2023-01-10 04:32:07', '2023-01-10 04:32:07'),
(17, 1, '11111111', '2023-01-08', 8, 1100, NULL, NULL, 7, '2023-01-10 04:32:07', '2023-01-10 04:32:07'),
(18, 1, '11111111', '2023-01-08', 6, NULL, 1200, NULL, 7, '2023-01-10 04:34:00', '2023-01-10 04:34:00'),
(19, 1, '11111111', '2023-01-08', 9, 100, NULL, NULL, 7, '2023-01-10 04:34:00', '2023-01-10 04:34:00'),
(20, 1, '11111111', '2023-01-08', 8, 1100, NULL, NULL, 7, '2023-01-10 04:34:00', '2023-01-10 04:34:00'),
(21, 1, '5345232', '2023-01-01', 6, NULL, 2700, NULL, 7, '2023-01-10 04:37:51', '2023-01-10 04:37:51'),
(22, 1, '5345232', '2023-01-01', 8, 2700, NULL, NULL, 7, '2023-01-10 04:37:51', '2023-01-10 04:37:51'),
(23, 1, '342352354', '2023-01-01', 6, NULL, 6300, NULL, 7, '2023-01-10 04:50:31', '2023-01-10 04:50:31'),
(24, 1, '342352354', '2023-01-01', 9, 5000, NULL, NULL, 7, '2023-01-10 04:50:31', '2023-01-10 04:50:31'),
(25, 1, '342352354', '2023-01-01', 8, 1300, NULL, NULL, 7, '2023-01-10 04:50:31', '2023-01-10 04:50:31'),
(26, 1, '31224124', '2023-01-01', 6, NULL, 2400, NULL, 6, '2023-01-10 04:51:36', '2023-01-10 04:51:36'),
(27, 1, '31224124', '2023-01-01', 9, 2000, NULL, NULL, 6, '2023-01-10 04:51:36', '2023-01-10 04:51:36'),
(28, 1, '31224124', '2023-01-01', 8, 400, NULL, NULL, 6, '2023-01-10 04:51:36', '2023-01-10 04:51:36'),
(29, 1, '8678678635', '2023-01-01', 5, 2115, NULL, 1, NULL, '2023-01-10 05:38:59', '2023-01-10 05:38:59'),
(30, 1, '8678678635', '2023-01-01', 9, NULL, 2000, 1, NULL, '2023-01-10 05:38:59', '2023-01-10 05:38:59'),
(31, 1, '8678678635', '2023-01-01', 7, NULL, 115, 1, NULL, '2023-01-10 05:38:59', '2023-01-10 05:38:59'),
(32, 1, '2412423423', '2023-01-10', 6, NULL, 3825, NULL, 7, '2023-01-10 05:51:03', '2023-01-10 05:51:03'),
(33, 1, '2412423423', '2023-01-10', 9, 3000, NULL, NULL, 7, '2023-01-10 05:51:03', '2023-01-10 05:51:03'),
(34, 1, '2412423423', '2023-01-10', 8, 825, NULL, NULL, 7, '2023-01-10 05:51:03', '2023-01-10 05:51:03'),
(35, 1, '5345232', '2023-01-01', 6, NULL, 2400, NULL, 6, '2023-01-11 02:36:24', '2023-01-11 02:36:24'),
(36, 1, '5345232', '2023-01-01', 9, 200, NULL, NULL, 6, '2023-01-11 02:36:24', '2023-01-11 02:36:24'),
(37, 1, '5345232', '2023-01-01', 8, 2200, NULL, NULL, 6, '2023-01-11 02:36:24', '2023-01-11 02:36:24'),
(38, 1, '78678679674', '2023-01-11', 6, NULL, 7505, NULL, 6, '2023-01-11 05:03:48', '2023-01-11 05:03:48'),
(39, 1, '78678679674', '2023-01-11', 9, 7000, NULL, NULL, 6, '2023-01-11 05:03:48', '2023-01-11 05:03:48'),
(40, 1, '78678679674', '2023-01-11', 8, 505, NULL, NULL, 6, '2023-01-11 05:03:48', '2023-01-11 05:03:48');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_desc` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `short_desc`, `shop_id`, `created_at`, `updated_at`) VALUES
(1, 'Walton', 'Enter Short description  update', 1, '2022-11-16 23:28:30', '2022-12-03 17:16:21'),
(3, 'HP', NULL, 1, '2022-11-16 23:30:42', '2022-11-16 23:30:42'),
(4, 'Arong', 'Best brand of Bangladesh', 1, '2022-11-24 04:32:46', '2022-11-24 04:32:46'),
(5, 'Loto', 'Best Brand in the World', 1, '2022-11-24 04:33:29', '2022-11-24 04:33:29'),
(6, 'Easy', 'good Product', 1, '2022-11-24 04:36:01', '2022-11-24 04:36:01'),
(7, 'Gentle Park', NULL, 1, '2022-11-24 04:36:36', '2022-11-24 04:36:36'),
(8, 'Gentle Man', NULL, 1, '2022-11-24 04:36:58', '2022-11-24 04:36:58'),
(9, 'Pakija', 'Good Product:Sari', 1, '2022-12-03 17:13:00', '2022-12-03 17:13:00'),
(10, 'Asus', NULL, 1, '2023-01-09 04:15:28', '2023-01-09 04:17:26');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `shop_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `parent_id`, `shop_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Mobile 1', 0, 1, '2022-11-16 23:22:07', '2022-12-03 17:14:41', NULL),
(2, 'TV update', 0, 1, '2022-11-16 23:22:20', '2022-12-03 17:15:03', NULL),
(3, 'Laptop', 0, 1, '2022-11-16 23:22:42', '2022-11-16 23:22:42', NULL),
(4, 'HP Laptop', 3, 1, '2022-11-16 23:23:05', '2022-11-16 23:23:05', NULL),
(6, 'Mobile', 0, 1, '2022-11-18 22:19:36', '2022-12-17 22:46:18', NULL),
(7, 'Men\'s Fashion', 0, 1, '2022-11-24 04:29:48', '2022-11-24 04:29:48', NULL),
(8, 'Shirt Update', 7, 1, '2022-11-24 04:30:08', '2022-12-03 17:15:27', NULL),
(9, 'Women\'s Fashion', 0, 1, '2022-11-24 04:31:02', '2022-12-17 22:39:57', NULL),
(10, 'Three-piece', 9, 1, '2022-11-24 04:31:44', '2022-11-24 04:31:44', NULL),
(11, 'HP Pavilion', 3, 1, '2022-12-03 17:14:05', '2022-12-03 17:14:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `chart_of_accounts`
--

CREATE TABLE `chart_of_accounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `opening_balance` double(8,2) NOT NULL,
  `head_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT 'Active=1, Inactive=0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chart_of_accounts`
--

INSERT INTO `chart_of_accounts` (`id`, `parent_id`, `name`, `opening_balance`, `head_type`, `status`, `created_at`, `updated_at`) VALUES
(1, 0, 'Assets', 0.00, 'A', 1, '2022-11-17 03:30:35', '2022-11-17 03:30:35'),
(2, 0, 'Liabilities', 0.00, 'L', 1, '2022-11-17 03:30:35', '2022-11-17 03:30:35'),
(3, 0, 'Income', 0.00, 'I', 1, '2022-11-17 03:32:20', '2022-11-17 03:32:20'),
(4, 0, 'Expenses', 0.00, 'E', 1, '2022-11-17 03:32:20', '2022-11-17 03:32:20'),
(5, 4, 'Purchases', 0.00, 'E', 1, '2022-11-26 01:20:03', '2022-11-26 01:20:03'),
(6, 3, 'Sales', 0.00, 'I', 1, '2022-11-26 01:22:12', '2022-11-26 01:22:12'),
(7, 2, 'Account Payable', 0.00, 'L', 1, '2022-11-26 01:22:48', '2022-11-26 01:22:48'),
(8, 1, 'Account Receivable', 0.00, 'A', 1, '2022-11-26 01:23:07', '2022-11-26 01:23:07'),
(9, 1, 'Cash', 0.00, 'A', 1, '2022-11-26 17:27:05', '2022-11-26 17:27:05'),
(10, 1, 'Bank', 0.00, 'A', 1, '2022-11-26 17:27:18', '2022-11-26 17:27:18'),
(11, 3, 'Income 1', 0.00, 'I', 1, '2022-11-26 01:22:12', '2022-11-26 01:22:12'),
(12, 3, 'Income 2', 0.00, 'I', 1, '2022-11-26 01:22:12', '2022-11-26 01:22:12'),
(13, 4, 'Expense 1', 0.00, 'E', 1, '2022-11-26 01:20:03', '2022-11-26 01:20:03'),
(14, 4, 'Expense 2', 0.00, 'E', 1, '2022-11-26 01:20:03', '2022-11-26 01:20:03');

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `country`, `currency_name`, `currency_code`, `created_at`, `updated_at`) VALUES
(3, 'AFGHANISTAN', 'Afghani', 'AFN', NULL, NULL),
(4, 'ALBANIA', 'Lek', 'ALL', NULL, NULL),
(26, 'AMERICAN SAMOA', 'US Dollar', 'USD', NULL, NULL),
(27, 'ANDORRA', 'Euro', 'EUR', NULL, NULL),
(28, 'ANGOLA', 'Kwanza', 'AOA', NULL, NULL),
(29, 'ANGUILLA', 'East Caribbean Dollar', 'XCD', NULL, NULL),
(30, 'ANTARCTICA', 'No universal currency', 'AFN', NULL, NULL),
(31, 'ANTIGUA AND BARBUDA', 'East Caribbean Dollar', 'XCD', NULL, NULL),
(32, 'ARGENTINA', 'Argentine Peso', 'ARS', NULL, NULL),
(33, 'ARMENIA', 'Armenian Dram', 'AMD', NULL, NULL),
(34, 'ARUBA', 'Aruban Florin', 'AWG', NULL, NULL),
(35, 'South Aftrica', 'South Aftrica Rand', 'ZAR', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shop_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price_group_id` int(11) NOT NULL,
  `tax_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `opening_balance` double(8,2) NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zip_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT 'Active=1, Inactive=0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `shop_id`, `name`, `company_name`, `phone`, `email`, `price_group_id`, `tax_number`, `opening_balance`, `address`, `city`, `state`, `country`, `zip_code`, `status`, `created_at`, `updated_at`) VALUES
(6, 1, 'Asish Kumar Das', 'Chilli Communications Limited', '01711454988', 'asish@chillicom.agency', 3, 'W34Q', 0.00, 'Block A, House 82 Rd No 2,', 'Dhaka', 'Dhaka', 'Bangladesh', '1212', 1, '2022-12-27 05:16:32', '2022-12-27 05:16:32'),
(7, 1, 'Khandoker Hirokul Islam', 'Creepes', '01979009229', 'hirokbd20@gmail.com', 2, 'W34Q', 0.00, '436/a (1st Floor) North Kazipara', 'Dhaka', 'Dhaka', 'Bangladesh', '1216', 1, '2022-12-27 05:16:48', '2022-12-27 05:16:48');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shop_id` bigint(20) UNSIGNED NOT NULL,
  `supplier_id` bigint(20) UNSIGNED DEFAULT NULL,
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `reference_num` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `att_document` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expense_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_method` int(11) NOT NULL,
  `total_amount` double NOT NULL,
  `paid_amount` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `group_product_prices`
--

CREATE TABLE `group_product_prices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `price_group_id` bigint(20) UNSIGNED NOT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shop_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `group_product_prices`
--

INSERT INTO `group_product_prices` (`id`, `product_id`, `price_group_id`, `price`, `shop_id`, `created_at`, `updated_at`) VALUES
(9, 1, 3, '2500', 1, '2022-12-21 06:14:07', '2022-12-21 06:14:07'),
(12, 2, 3, '3000', 1, '2022-12-27 04:18:15', '2022-12-27 04:18:15');

-- --------------------------------------------------------

--
-- Table structure for table `incomes`
--

CREATE TABLE `incomes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shop_id` bigint(20) UNSIGNED NOT NULL,
  `supplier_id` bigint(20) UNSIGNED DEFAULT NULL,
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `reference_num` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `att_document` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `income_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_method` int(11) NOT NULL,
  `total_amount` double NOT NULL,
  `paid_amount` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_11_000000_create_shops_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2022_09_10_135212_create_takealots_table', 1),
(7, '2022_09_11_083642_create_takealot_apis_table', 1),
(8, '2022_09_11_110728_create_takealot_sales_table', 1),
(9, '2022_09_13_080801_create_my_pos_table', 1),
(10, '2022_09_13_084330_create_my_pos_apis_table', 1),
(11, '2022_09_16_052934_create_pos_min_prices_table', 1),
(12, '2022_09_19_102917_create_shopifies_table', 1),
(13, '2022_09_19_103205_create_shopify_apis_table', 1),
(14, '2022_09_24_082318_create_shopify_sales_table', 1),
(15, '2022_09_24_104059_create_shopify_sale_details_table', 1),
(16, '2022_09_24_104257_create_shopify_sale_refunds_table', 1),
(19, '2022_10_22_044019_create_brands_table', 1),
(20, '2022_10_22_044102_create_categories_table', 1),
(26, '2022_10_29_093209_create_chart_of_accounts_table', 1),
(27, '2022_10_29_093320_create_account_transections_table', 1),
(30, '2022_11_08_051144_create_units_table', 1),
(31, '2022_11_09_101954_create_variants_table', 1),
(35, '2022_11_14_101859_create_currencies_table', 1),
(36, '2014_10_12_000000_create_users_table', 2),
(37, '2022_11_09_102028_create_values_table', 3),
(39, '2022_10_16_090713_create_suppliers_table', 4),
(40, '2022_10_16_095822_create_customers_table', 4),
(62, '2022_10_22_094510_create_products_table', 5),
(63, '2022_10_24_141055_create_purchases_table', 5),
(64, '2022_10_25_064739_create_purchase_extras_table', 5),
(65, '2022_10_27_040157_create_sales_table', 5),
(66, '2022_10_27_043839_create_sale_extras_table', 5),
(67, '2022_11_01_100648_create_expenses_table', 5),
(68, '2022_11_01_100733_create_incomes_table', 5),
(69, '2022_11_10_093523_create_product_variants_table', 5),
(70, '2022_11_20_170802_create_product_combo_values_table', 5),
(71, '2022_11_21_040139_create_product_variant_values_table', 5),
(72, '2022_11_26_071513_create_purchase_variants_table', 5),
(73, '2022_11_27_072256_create_sale_variants_table', 5),
(75, '2022_12_20_095822_create_price_groups_table', 6),
(76, '2022_12_20_115419_create_group_product_prices_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `my_pos`
--

CREATE TABLE `my_pos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shop_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tsin` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cost` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rack_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price_group_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `my_pos_apis`
--

CREATE TABLE `my_pos_apis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shop_id` bigint(20) UNSIGNED NOT NULL,
  `api_url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pos_min_prices`
--

CREATE TABLE `pos_min_prices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shop_id` bigint(20) UNSIGNED NOT NULL,
  `pos_id` int(11) NOT NULL,
  `product_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_min_price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_staus` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tsin` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rack_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sku` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `price_groups`
--

CREATE TABLE `price_groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shop_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `price_groups`
--

INSERT INTO `price_groups` (`id`, `name`, `shop_id`, `created_at`, `updated_at`) VALUES
(2, 'Wholsale', 1, '2022-12-20 04:37:32', '2022-12-20 04:37:32'),
(3, 'Retail', 1, '2022-12-20 04:37:54', '2022-12-20 04:37:54');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sub_category_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sku` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `barcode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `barcode_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) UNSIGNED NOT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `image` varchar(2000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_boosear` varchar(2000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit` int(11) DEFAULT NULL,
  `model_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rack_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alert_query` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `weight` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_type` int(11) NOT NULL,
  `sell_price` double(20,2) DEFAULT NULL,
  `purchase_price` double(20,2) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT 'Active=1, Inactive=0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `sub_category_id`, `name`, `sku`, `barcode`, `barcode_type`, `shop_id`, `category_id`, `brand_id`, `supplier_id`, `image`, `product_boosear`, `unit`, `model_no`, `rack_no`, `alert_query`, `description`, `weight`, `product_type`, `sell_price`, `purchase_price`, `status`, `created_at`, `updated_at`) VALUES
(1, '4', 'Bangladesh', NULL, NULL, '1', 1, 3, 1, NULL, 'bangladesh-1671533583.png', 'png-1671533583.png', 1, '46346346456', '11', '1', '<p>dhrthjg hhgerthg</p>', NULL, 1, 300.00, 250.00, 1, '2022-12-20 04:53:03', '2023-01-09 07:18:09'),
(2, '4', 'HP LAPTOP (Varient Product)', NULL, NULL, '3', 1, 3, 3, NULL, 'download-1673345443.png', 'png-1671533719.png', 1, '46346346457575785', '5', '1', '<p>8678678678fghj56rfyjg rfghrtdhgv rstdfhg</p>', NULL, 2, 800.00, 700.00, 1, '2022-12-20 04:55:19', '2023-01-10 04:10:43'),
(3, '8', 'TV', NULL, NULL, '3', 1, 7, 4, 1, '13-1671533801.jpg', 'jpg-1671533801.jpg', 2, '463463464567444', '10', '1', '<p>75354fgrdyfj fthgbrtsdgnv rthdfbwersdg wretdhfbr wrtdfv</p>', NULL, 1, 1000.00, 800.00, 1, '2022-12-20 04:56:41', '2023-01-10 04:11:08'),
(4, '4', 'Laptop', NULL, NULL, '1', 1, 3, 1, NULL, 'download-1673259611.jpg', 'jpg-1673259611.jpg', 2, '46346346456', '11', '1', '<p>gerfgbgsedfbxv</p>', NULL, 1, 300.00, 250.00, 1, '2023-01-09 04:20:11', '2023-01-10 04:07:32'),
(5, '4', 'Dell Laptop  (Variable product 2)', NULL, NULL, '1', 1, 3, 7, 1, 'download-1673268325.jpg', 'png-1673268325.png', 1, '46346346456', '11', '1', '<p>Desct</p>', NULL, 2, 1100.00, 1050.00, 1, '2023-01-09 06:45:25', '2023-01-10 04:12:06'),
(6, '4', 'Combo Product', NULL, NULL, '1', 1, 3, 6, 1, 'dream-business-1673268911.jpg', 'jpg-1673268911.jpg', 1, '46346346456', '11', '1', '<p>Desc</p>', NULL, 3, 3000.00, 2800.00, 1, '2023-01-09 06:55:11', '2023-01-10 04:49:03'),
(7, '8', 'Panjabi (simple)', '2525', '5457645645633', '1', 1, 7, 7, 1, 'e6507b1c5661a0d878905dfcbe665d94-1673345884.jpg', 'jpg-1673345884.jpg', 1, '46346346456', NULL, '1', '<p>Desc</p>', '62', 1, 1100.00, 1000.00, 1, '2023-01-10 04:18:04', '2023-01-10 04:18:04'),
(9, '8', 'Panjabi (varient)', 'c59-m90', '7', '1', 1, 7, 6, 1, 'e6507b1c5661a0d878905dfcbe665d94-1673416361.jpg', 'e6507b1c5661a0d878905dfcbe665d94-1673416361.jpg', 1, '46346346456', '5', '1', '<p>Desc</p>', '62', 2, 550.00, 450.00, 1, '2023-01-10 23:52:41', '2023-01-10 23:52:41');

-- --------------------------------------------------------

--
-- Table structure for table `product_combo_values`
--

CREATE TABLE `product_combo_values` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `combo_product_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `combo_quantity` int(11) NOT NULL,
  `combo_purchase_price` double NOT NULL,
  `total_amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_combo_values`
--

INSERT INTO `product_combo_values` (`id`, `combo_product_id`, `product_id`, `combo_quantity`, `combo_purchase_price`, `total_amount`, `created_at`, `updated_at`) VALUES
(9, 2, 6, 2, 700, '1400', NULL, NULL),
(10, 3, 6, 3, 800, '1400', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_variants`
--

CREATE TABLE `product_variants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_variants_id` bigint(20) UNSIGNED NOT NULL,
  `variants_value_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `variant_purchase_price` double DEFAULT NULL,
  `variant_sell_price` double DEFAULT NULL,
  `variable_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_variants`
--

INSERT INTO `product_variants` (`id`, `product_variants_id`, `variants_value_id`, `product_id`, `variant_purchase_price`, `variant_sell_price`, `variable_image`, `created_at`, `updated_at`) VALUES
(1, 2, 5, 2, 450, 550, 'adhiyar-fb-profile-1671533719.jpg', NULL, NULL),
(2, 2, 6, 2, 500, 580, 'welldevs-fb-profile-1671533719.jpg', NULL, NULL),
(3, 2, 7, 2, 550, 650, 'fiverr-gig=promote-1671533719.png', NULL, NULL),
(4, 1, 1, 5, 1050, 1089, 'download-1673268325.jpg', NULL, '2023-01-10 04:09:30'),
(5, 1, 2, 5, 1050, 1090, 'download-1673268325.jpg', NULL, '2023-01-10 04:09:30'),
(8, 1, 1, 9, NULL, NULL, 'e6507b1c5661a0d878905dfcbe665d94-1673416361.jpg', NULL, NULL),
(9, 1, 2, 9, NULL, NULL, 'e6507b1c5661a0d878905dfcbe665d94-1673416361.jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shop_id` bigint(20) UNSIGNED NOT NULL,
  `supplier_id` bigint(20) UNSIGNED NOT NULL,
  `reference_num` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purchase_date` date NOT NULL,
  `payment_method` int(11) NOT NULL,
  `sub_total` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_percent` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `grand_total` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paid_amount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `due_amount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `shop_id`, `supplier_id`, `reference_num`, `purchase_date`, `payment_method`, `sub_total`, `discount_percent`, `grand_total`, `paid_amount`, `due_amount`, `note`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '5345232', '2023-01-09', 9, '800', NULL, '800', '0', '800', 'note', '2023-01-09 05:35:01', '2023-01-09 05:35:01'),
(2, 1, 1, '5345232', '2023-01-09', 9, '9600', NULL, '9600', '0', '9600', 'note', '2023-01-09 05:42:04', '2023-01-09 05:42:04'),
(3, 1, 1, '2412423423', '2023-01-10', 9, '1000', NULL, '1000', '100', '900', 'Note', '2023-01-10 04:26:30', '2023-01-10 04:26:30'),
(4, 1, 1, '111111111', '2023-01-09', 9, '1000', NULL, '1000', '200', '0', 'Note', '2023-01-10 04:28:08', '2023-01-10 04:28:08'),
(5, 1, 1, '8678678635', '2023-01-01', 9, '2350', '10', '2115', '2000', '115', 'This is test note', '2023-01-10 05:38:58', '2023-01-10 05:38:58');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_extras`
--

CREATE TABLE `purchase_extras` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `purchase_id` bigint(20) UNSIGNED NOT NULL,
  `purchase_variants_id` bigint(20) UNSIGNED DEFAULT NULL,
  `purchase_variants_value_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_type` int(11) NOT NULL,
  `quantity` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `purchase_price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_extras`
--

INSERT INTO `purchase_extras` (`id`, `product_id`, `purchase_id`, `purchase_variants_id`, `purchase_variants_value_id`, `product_type`, `quantity`, `purchase_price`, `total_amount`, `created_at`, `updated_at`) VALUES
(1, 3, 2, NULL, NULL, 1, '12', '800', '9600', NULL, NULL),
(2, 7, 3, NULL, NULL, 1, '1', '1000', '1000', NULL, NULL),
(5, 2, 5, 2, 5, 2, '1', '700', '700', NULL, NULL),
(6, 2, 5, 2, 6, 2, '1', '700', '700', NULL, NULL),
(7, 2, 5, 2, 7, 2, '1', '700', '700', NULL, NULL),
(8, 1, 5, NULL, NULL, 1, '1', '250', '250', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_variants`
--

CREATE TABLE `purchase_variants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `purchase_id` bigint(20) UNSIGNED NOT NULL,
  `purchase_variants_id` bigint(20) UNSIGNED NOT NULL,
  `purchase_variants_value_id` bigint(20) UNSIGNED NOT NULL,
  `product_type` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `purchase_price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shop_id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `reference_num` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sale_date` date NOT NULL,
  `payment_method` int(11) NOT NULL,
  `sub_total` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_percent` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `grand_total` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paid_amount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `due_amount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `shop_id`, `customer_id`, `reference_num`, `sale_date`, `payment_method`, `sub_total`, `discount_percent`, `grand_total`, `paid_amount`, `due_amount`, `note`, `created_at`, `updated_at`) VALUES
(11, 1, 6, '78678679674', '2023-01-11', 9, '7900', '5', '7505', '7000', '505', 'note for test', '2023-01-11 05:03:48', '2023-01-11 05:03:48');

-- --------------------------------------------------------

--
-- Table structure for table `sale_extras`
--

CREATE TABLE `sale_extras` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `sale_id` bigint(20) UNSIGNED NOT NULL,
  `sales_variants_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sales_variants_value_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_type` int(11) NOT NULL,
  `quantity` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sell_price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sale_extras`
--

INSERT INTO `sale_extras` (`id`, `product_id`, `sale_id`, `sales_variants_id`, `sales_variants_value_id`, `product_type`, `quantity`, `sell_price`, `total_amount`, `created_at`, `updated_at`) VALUES
(23, 2, 11, 2, 5, 2, '1', '800', '800', NULL, NULL),
(24, 2, 11, 2, 6, 2, '1', '800', '800', NULL, NULL),
(25, 2, 11, 2, 7, 2, '1', '800', '800', NULL, NULL),
(26, 1, 11, NULL, NULL, 1, '1', '2500', '2500', NULL, NULL),
(27, 6, 11, NULL, NULL, 3, '1', '3000', '3000', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sale_variants`
--

CREATE TABLE `sale_variants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `sale_id` bigint(20) UNSIGNED NOT NULL,
  `sales_variants_id` bigint(20) UNSIGNED NOT NULL,
  `sales_variants_value_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `sell_price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shopifies`
--

CREATE TABLE `shopifies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shop_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `variants_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `regular_price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sku` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `barcode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shopify_apis`
--

CREATE TABLE `shopify_apis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shop_id` bigint(20) UNSIGNED NOT NULL,
  `api` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shopify_sales`
--

CREATE TABLE `shopify_sales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shop_id` bigint(20) UNSIGNED NOT NULL,
  `sales_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sales_date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cust_firstname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cust_lastname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sales_status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_method` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_address1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_address2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_province` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_zip` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_address1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_address2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_province` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_zip` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `collectno` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `waybillno` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `booking_status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shopify_sale_details`
--

CREATE TABLE `shopify_sale_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shop_id` bigint(20) UNSIGNED NOT NULL,
  `sales_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lineitems_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_total` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shopify_sale_refunds`
--

CREATE TABLE `shopify_sale_refunds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shop_id` bigint(20) UNSIGNED NOT NULL,
  `sales_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `refund_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_total` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shops`
--

CREATE TABLE `shops` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `business_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `upload_logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_contact` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alternate_contact` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zip_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `land_mark` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time_zone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shops`
--

INSERT INTO `shops` (`id`, `business_name`, `start_date`, `currency`, `upload_logo`, `website`, `business_contact`, `alternate_contact`, `country`, `state`, `city`, `zip_code`, `land_mark`, `time_zone`, `created_at`, `updated_at`) VALUES
(1, 'WoowPos', '2022-01-11', '35', NULL, 'https://woowpos.com', '5454', '5454546853', 'South Africa', 'Cape Town', 'Cape Town', '6665', 'inayat82', 'Antarctica/Vostok', '2022-11-15 06:20:40', '2022-12-11 01:47:40');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shop_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tax_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `opening_balance` double(8,2) NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zip_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT 'Active=1, Inactive=0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `shop_id`, `name`, `company_name`, `phone`, `email`, `tax_number`, `opening_balance`, `address`, `city`, `state`, `country`, `zip_code`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Asish Kumar Das', 'Chilli Communications Limited', '01711454988', 'asish@chillicom.agency', 'W34Q', 0.00, 'Block A, House 82 Rd No 2,', 'Dhaka', 'Dhaka', 'Bangladesh', '1212', 1, '2023-01-09 05:33:42', '2023-01-09 05:33:42'),
(2, 1, 'Khandoker Hirok', 'WellXperts', '01979009229', 'hirokbd20@gmail.com', NULL, 0.00, '436/a (1st Floor) North Kazipara, Mirpur', 'Dhaka', 'Dhaka', 'Bangladesh', '1216', 1, '2023-01-11 01:16:59', '2023-01-11 01:16:59');

-- --------------------------------------------------------

--
-- Table structure for table `takealots`
--

CREATE TABLE `takealots` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shop_id` bigint(20) UNSIGNED NOT NULL,
  `tsin` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `offer_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `selling_price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rrp` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sku` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `barcode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `takealot_url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `takealot_apis`
--

CREATE TABLE `takealot_apis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shop_id` bigint(20) UNSIGNED NOT NULL,
  `api_key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `takealot_apis`
--

INSERT INTO `takealot_apis` (`id`, `shop_id`, `api_key`, `created_at`, `updated_at`) VALUES
(2, 1, 'b61a80dfaa06c34ea7a16927295c2d0de7022f0c2ae57bec9eed18da3d52d0e4ee024a8deb0cd96bcd315ae5352a619c4bbb89b36307d8ec9ff866388fb5c320', '2022-12-11 01:26:09', '2022-12-11 01:26:09');

-- --------------------------------------------------------

--
-- Table structure for table `takealot_sales`
--

CREATE TABLE `takealot_sales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shop_id` bigint(20) UNSIGNED NOT NULL,
  `tsin` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_item_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `selling_price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sale_status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cust_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dc` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT 'Active=1, Inactive=0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `name`, `short_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Pieces', 'PCS', 1, '2022-11-16 23:39:02', '2022-11-16 23:39:02'),
(2, 'Packes', 'PCK', 1, '2022-11-16 23:39:21', '2022-11-16 23:39:21');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shop_id` bigint(20) UNSIGNED NOT NULL,
  `fname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_role` int(11) NOT NULL DEFAULT 1 COMMENT 'Owner=1, Manager=2,  SuperAdmin=3,\r\nSalesagent=4',
  `status` int(11) NOT NULL DEFAULT 1 COMMENT 'Active=1, Inactive=0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `shop_id`, `fname`, `lname`, `username`, `image`, `email`, `phone`, `email_verified_at`, `password`, `remember_token`, `user_role`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Masum', '82', 'masum82', 'masum82-1670743929.webp', 'masum@admin.com', '01963478543', NULL, '$2y$10$rPLLt/eeiXMttRlHwnWk1ug0ZbyPrU/y1riBS.ThclAWW0mOB21JK', 'QA193vDanNG1Ev3JKO2B3iFTH1Iq9TPLW4ShwdfULjJxTU48viQd7SCIregw', 1, 1, '2022-11-15 06:20:40', '2022-12-11 01:32:09'),
(2, 0, 'Super', 'Admin', 'superadmin', NULL, 'super@admin.com', '01963478545', NULL, '$2y$10$rPLLt/eeiXMttRlHwnWk1ug0ZbyPrU/y1riBS.ThclAWW0mOB21JK', NULL, 3, 1, '2022-11-15 23:14:14', '2022-11-15 23:14:14');

-- --------------------------------------------------------

--
-- Table structure for table `values`
--

CREATE TABLE `values` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `value_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `variants_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `values`
--

INSERT INTO `values` (`id`, `value_name`, `variants_id`, `created_at`, `updated_at`) VALUES
(1, 'Red', 1, NULL, NULL),
(2, 'Yellow', 1, NULL, NULL),
(3, 'Black', 1, NULL, NULL),
(4, 'Blue', 1, NULL, NULL),
(5, 'M', 2, NULL, NULL),
(6, 'XL', 2, NULL, NULL),
(7, 'XXL', 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `variants`
--

CREATE TABLE `variants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vari_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shop_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `variants`
--

INSERT INTO `variants` (`id`, `vari_name`, `shop_id`, `created_at`, `updated_at`) VALUES
(1, 'Color', 1, '2022-11-26 03:20:06', '2022-11-26 03:20:06'),
(2, 'Size', 1, '2022-11-26 03:28:00', '2022-11-26 03:28:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_transections`
--
ALTER TABLE `account_transections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_transections_shop_id_foreign` (`shop_id`),
  ADD KEY `account_transections_chartofacc_id_foreign` (`chartofacc_id`),
  ADD KEY `account_transections_supplier_id_foreign` (`supplier_id`),
  ADD KEY `account_transections_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chart_of_accounts`
--
ALTER TABLE `chart_of_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `currencies_country_unique` (`country`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_phone_unique` (`phone`),
  ADD UNIQUE KEY `customers_email_unique` (`email`),
  ADD KEY `customers_shop_id_foreign` (`shop_id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expenses_shop_id_foreign` (`shop_id`),
  ADD KEY `expenses_supplier_id_foreign` (`supplier_id`),
  ADD KEY `expenses_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `group_product_prices`
--
ALTER TABLE `group_product_prices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_product_prices_product_id_foreign` (`product_id`),
  ADD KEY `group_product_prices_price_group_id_foreign` (`price_group_id`),
  ADD KEY `group_product_prices_shop_id_foreign` (`shop_id`);

--
-- Indexes for table `incomes`
--
ALTER TABLE `incomes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `incomes_shop_id_foreign` (`shop_id`),
  ADD KEY `incomes_supplier_id_foreign` (`supplier_id`),
  ADD KEY `incomes_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `my_pos`
--
ALTER TABLE `my_pos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `my_pos_shop_id_foreign` (`shop_id`);

--
-- Indexes for table `my_pos_apis`
--
ALTER TABLE `my_pos_apis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `my_pos_apis_shop_id_foreign` (`shop_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `pos_min_prices`
--
ALTER TABLE `pos_min_prices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pos_min_prices_shop_id_foreign` (`shop_id`);

--
-- Indexes for table `price_groups`
--
ALTER TABLE `price_groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `price_groups_shop_id_foreign` (`shop_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_shop_id_foreign` (`shop_id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`),
  ADD KEY `unit_price` (`sell_price`);

--
-- Indexes for table `product_combo_values`
--
ALTER TABLE `product_combo_values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_combo_values_product_id_foreign` (`product_id`),
  ADD KEY `product_combo_values_combo_product_id_foreign` (`combo_product_id`);

--
-- Indexes for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_variants_product_variants_id_foreign` (`product_variants_id`),
  ADD KEY `product_variants_variants_value_id_foreign` (`variants_value_id`),
  ADD KEY `product_variants_product_id_foreign` (`product_id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchases_shop_id_foreign` (`shop_id`),
  ADD KEY `purchases_supplier_id_foreign` (`supplier_id`);

--
-- Indexes for table `purchase_extras`
--
ALTER TABLE `purchase_extras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_extras_product_id_foreign` (`product_id`),
  ADD KEY `purchase_extras_purchase_id_foreign` (`purchase_id`),
  ADD KEY `purchase_extras_purchase_variants_id_foreign` (`purchase_variants_id`),
  ADD KEY `purchase_extras_purchase_variants_value_id_foreign` (`purchase_variants_value_id`);

--
-- Indexes for table `purchase_variants`
--
ALTER TABLE `purchase_variants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_variants_product_id_foreign` (`product_id`),
  ADD KEY `purchase_variants_purchase_id_foreign` (`purchase_id`),
  ADD KEY `purchase_variants_purchase_variants_id_foreign` (`purchase_variants_id`),
  ADD KEY `purchase_variants_purchase_variants_value_id_foreign` (`purchase_variants_value_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sales_shop_id_foreign` (`shop_id`),
  ADD KEY `sales_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `sale_extras`
--
ALTER TABLE `sale_extras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_extras_product_id_foreign` (`product_id`),
  ADD KEY `sale_extras_sale_id_foreign` (`sale_id`),
  ADD KEY `sale_extras_sales_variants_id_foreign` (`sales_variants_id`),
  ADD KEY `sale_extras_sales_variants_value_id_foreign` (`sales_variants_value_id`);

--
-- Indexes for table `sale_variants`
--
ALTER TABLE `sale_variants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_variants_product_id_foreign` (`product_id`),
  ADD KEY `sale_variants_sale_id_foreign` (`sale_id`),
  ADD KEY `sale_variants_sales_variants_id_foreign` (`sales_variants_id`),
  ADD KEY `sale_variants_sales_variants_value_id_foreign` (`sales_variants_value_id`);

--
-- Indexes for table `shopifies`
--
ALTER TABLE `shopifies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shopifies_shop_id_foreign` (`shop_id`);

--
-- Indexes for table `shopify_apis`
--
ALTER TABLE `shopify_apis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shopify_apis_shop_id_foreign` (`shop_id`);

--
-- Indexes for table `shopify_sales`
--
ALTER TABLE `shopify_sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shopify_sales_shop_id_foreign` (`shop_id`);

--
-- Indexes for table `shopify_sale_details`
--
ALTER TABLE `shopify_sale_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shopify_sale_details_shop_id_foreign` (`shop_id`);

--
-- Indexes for table `shopify_sale_refunds`
--
ALTER TABLE `shopify_sale_refunds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shopify_sale_refunds_shop_id_foreign` (`shop_id`);

--
-- Indexes for table `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `suppliers_phone_unique` (`phone`),
  ADD UNIQUE KEY `suppliers_email_unique` (`email`),
  ADD KEY `suppliers_shop_id_foreign` (`shop_id`);

--
-- Indexes for table `takealots`
--
ALTER TABLE `takealots`
  ADD PRIMARY KEY (`id`),
  ADD KEY `takealots_shop_id_foreign` (`shop_id`);

--
-- Indexes for table `takealot_apis`
--
ALTER TABLE `takealot_apis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `takealot_apis_shop_id_foreign` (`shop_id`);

--
-- Indexes for table `takealot_sales`
--
ALTER TABLE `takealot_sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `takealot_sales_shop_id_foreign` (`shop_id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`),
  ADD KEY `users_shop_id_foreign` (`shop_id`);

--
-- Indexes for table `values`
--
ALTER TABLE `values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `values_variants_id_foreign` (`variants_id`);

--
-- Indexes for table `variants`
--
ALTER TABLE `variants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `variants_vari_name_unique` (`vari_name`),
  ADD KEY `variants_shop_id_foreign` (`shop_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_transections`
--
ALTER TABLE `account_transections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `chart_of_accounts`
--
ALTER TABLE `chart_of_accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `group_product_prices`
--
ALTER TABLE `group_product_prices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `incomes`
--
ALTER TABLE `incomes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `my_pos`
--
ALTER TABLE `my_pos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `my_pos_apis`
--
ALTER TABLE `my_pos_apis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pos_min_prices`
--
ALTER TABLE `pos_min_prices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `price_groups`
--
ALTER TABLE `price_groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `product_combo_values`
--
ALTER TABLE `product_combo_values`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `product_variants`
--
ALTER TABLE `product_variants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `purchase_extras`
--
ALTER TABLE `purchase_extras`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `purchase_variants`
--
ALTER TABLE `purchase_variants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `sale_extras`
--
ALTER TABLE `sale_extras`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `sale_variants`
--
ALTER TABLE `sale_variants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shopifies`
--
ALTER TABLE `shopifies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shopify_apis`
--
ALTER TABLE `shopify_apis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shopify_sales`
--
ALTER TABLE `shopify_sales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shopify_sale_details`
--
ALTER TABLE `shopify_sale_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shopify_sale_refunds`
--
ALTER TABLE `shopify_sale_refunds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shops`
--
ALTER TABLE `shops`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `takealots`
--
ALTER TABLE `takealots`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `takealot_apis`
--
ALTER TABLE `takealot_apis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `takealot_sales`
--
ALTER TABLE `takealot_sales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `values`
--
ALTER TABLE `values`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `variants`
--
ALTER TABLE `variants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account_transections`
--
ALTER TABLE `account_transections`
  ADD CONSTRAINT `account_transections_chartofacc_id_foreign` FOREIGN KEY (`chartofacc_id`) REFERENCES `chart_of_accounts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `account_transections_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `account_transections_shop_id_foreign` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `account_transections_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_shop_id_foreign` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expenses_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `expenses_shop_id_foreign` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `expenses_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `group_product_prices`
--
ALTER TABLE `group_product_prices`
  ADD CONSTRAINT `group_product_prices_price_group_id_foreign` FOREIGN KEY (`price_group_id`) REFERENCES `price_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `group_product_prices_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `group_product_prices_shop_id_foreign` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `incomes`
--
ALTER TABLE `incomes`
  ADD CONSTRAINT `incomes_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `incomes_shop_id_foreign` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `incomes_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `my_pos`
--
ALTER TABLE `my_pos`
  ADD CONSTRAINT `my_pos_shop_id_foreign` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `my_pos_apis`
--
ALTER TABLE `my_pos_apis`
  ADD CONSTRAINT `my_pos_apis_shop_id_foreign` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pos_min_prices`
--
ALTER TABLE `pos_min_prices`
  ADD CONSTRAINT `pos_min_prices_shop_id_foreign` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `price_groups`
--
ALTER TABLE `price_groups`
  ADD CONSTRAINT `price_groups_shop_id_foreign` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_shop_id_foreign` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_combo_values`
--
ALTER TABLE `product_combo_values`
  ADD CONSTRAINT `product_combo_values_combo_product_id_foreign` FOREIGN KEY (`combo_product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_combo_values_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD CONSTRAINT `product_variants_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_variants_product_variants_id_foreign` FOREIGN KEY (`product_variants_id`) REFERENCES `variants` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_variants_variants_value_id_foreign` FOREIGN KEY (`variants_value_id`) REFERENCES `values` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `purchases`
--
ALTER TABLE `purchases`
  ADD CONSTRAINT `purchases_shop_id_foreign` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `purchases_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
