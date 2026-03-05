-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 04, 2026 at 09:53 AM
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
-- Database: `stitch_&_wash`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `label` varchar(50) DEFAULT NULL,
  `address_line1` varchar(250) NOT NULL,
  `address_line2` varchar(250) DEFAULT NULL,
  `area` varchar(100) DEFAULT NULL,
  `city` varchar(100) NOT NULL DEFAULT 'Dubai',
  `emirate` varchar(100) DEFAULT NULL,
  `country` char(2) DEFAULT 'AE',
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `is_default` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-902ba3cda1883801594b6e1b452790cc53948fda', 'i:1;', 1772612504),
('laravel-cache-902ba3cda1883801594b6e1b452790cc53948fda:timer', 'i:1772612504;', 1772612504),
('laravel-cache-livewire-rate-limiter:16d36dff9abd246c67dfac3e63b993a169af77e6', 'i:3;', 1772612431),
('laravel-cache-livewire-rate-limiter:16d36dff9abd246c67dfac3e63b993a169af77e6:timer', 'i:1772612431;', 1772612431),
('stitch-wash-cache-902ba3cda1883801594b6e1b452790cc53948fda', 'i:1;', 1772614243),
('stitch-wash-cache-902ba3cda1883801594b6e1b452790cc53948fda:timer', 'i:1772614243;', 1772614243),
('stitch-wash-cache-livewire-rate-limiter:16d36dff9abd246c67dfac3e63b993a169af77e6', 'i:4;', 1772614271),
('stitch-wash-cache-livewire-rate-limiter:16d36dff9abd246c67dfac3e63b993a169af77e6:timer', 'i:1772614271;', 1772614271);

-- --------------------------------------------------------

--
-- Table structure for table `customer_wallets`
--

CREATE TABLE `customer_wallets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `balance` decimal(10,2) NOT NULL DEFAULT 0.00,
  `currency` char(3) DEFAULT 'AED',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `driver_locations`
--

CREATE TABLE `driver_locations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `driver_id` bigint(20) UNSIGNED NOT NULL,
  `latitude` decimal(10,8) NOT NULL,
  `longitude` decimal(11,8) NOT NULL,
  `speed_kmh` decimal(5,2) DEFAULT NULL,
  `heading` decimal(5,2) DEFAULT NULL,
  `recorded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fabrics`
--

CREATE TABLE `fabrics` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `fabric_code` varchar(50) DEFAULT NULL,
  `material_type` varchar(100) DEFAULT NULL,
  `color` varchar(100) DEFAULT NULL,
  `pattern` varchar(100) DEFAULT NULL,
  `price_per_meter` decimal(10,2) DEFAULT NULL,
  `price_per_piece` decimal(10,2) DEFAULT NULL,
  `currency` char(3) DEFAULT 'AED',
  `stock_status` enum('available','out_of_stock','coming_soon') DEFAULT 'available',
  `care_instructions` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `odoo_product_id` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fabric_favorites`
--

CREATE TABLE `fabric_favorites` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `fabric_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fabric_images`
--

CREATE TABLE `fabric_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fabric_id` bigint(20) UNSIGNED NOT NULL,
  `image_url` varchar(500) NOT NULL,
  `is_primary` tinyint(1) DEFAULT 0,
  `sort_order` tinyint(3) UNSIGNED DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_assignments`
--

CREATE TABLE `job_assignments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `assignment_type` enum('laundry_pickup','laundry_delivery','tailor_visit') NOT NULL,
  `reference_id` bigint(20) UNSIGNED NOT NULL,
  `reference_type` varchar(30) NOT NULL,
  `assigned_to` bigint(20) UNSIGNED NOT NULL,
  `assigned_by` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('assigned','en_route','arrived','completed','failed') DEFAULT 'assigned',
  `scheduled_at` timestamp NULL DEFAULT NULL,
  `started_at` timestamp NULL DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `proof_photo_url` varchar(500) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_assignments`
--

INSERT INTO `job_assignments` (`id`, `assignment_type`, `reference_id`, `reference_type`, `assigned_to`, `assigned_by`, `status`, `scheduled_at`, `started_at`, `completed_at`, `notes`, `proof_photo_url`, `created_at`) VALUES
(1, 'laundry_pickup', 1, 'laundry_order', 2, 1, 'assigned', NULL, NULL, NULL, NULL, NULL, '2026-02-28 00:20:49');

-- --------------------------------------------------------

--
-- Table structure for table `laundry_items`
--

CREATE TABLE `laundry_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `currency` char(3) DEFAULT 'AED',
  `icon_url` varchar(500) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `sort_order` tinyint(3) UNSIGNED DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `laundry_items`
--

INSERT INTO `laundry_items` (`id`, `category_id`, `name`, `price`, `currency`, `icon_url`, `is_active`, `sort_order`) VALUES
(1, 1, 'Shirt', 18.00, 'AED', NULL, 1, 0),
(2, 1, 'T Shirt', 18.00, 'AED', NULL, 1, 0),
(3, 1, 'Shorts', 18.00, 'AED', NULL, 1, 0),
(4, 1, 'Pants / Jeans', 23.00, 'AED', NULL, 1, 0),
(5, 1, 'Suit Jacket', 52.00, 'AED', NULL, 1, 0),
(6, 1, 'Underwear', 4.00, 'AED', NULL, 1, 0),
(7, 1, 'Socks', 4.00, 'AED', NULL, 1, 0),
(8, 1, 'Tie', 11.00, 'AED', NULL, 1, 0),
(9, 6, 'Shirt', 11.00, 'AED', NULL, 1, 0),
(10, 6, 'T Shirt', 11.00, 'AED', NULL, 1, 0),
(11, 6, 'Shorts', 16.00, 'AED', NULL, 1, 0),
(12, 6, 'Pants / Jeans', 17.00, 'AED', NULL, 1, 0),
(13, 6, 'Suit Jacket', 38.00, 'AED', NULL, 1, 0),
(14, 6, 'Underwear', 4.00, 'AED', NULL, 1, 0),
(15, 6, 'Socks', 4.00, 'AED', NULL, 1, 0),
(16, 6, 'Tie', 11.00, 'AED', NULL, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `laundry_item_categories`
--

CREATE TABLE `laundry_item_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_type_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `sort_order` tinyint(3) UNSIGNED DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `laundry_item_categories`
--

INSERT INTO `laundry_item_categories` (`id`, `service_type_id`, `name`, `sort_order`) VALUES
(1, 1, 'Men', 1),
(2, 1, 'Women', 2),
(3, 1, 'Traditional', 3),
(4, 1, 'Home', 4),
(5, 1, 'Winter', 5),
(6, 2, 'Men', 1),
(7, 2, 'Women', 2),
(8, 2, 'Traditional', 3),
(9, 2, 'Home', 4),
(10, 2, 'Winter', 5);

-- --------------------------------------------------------

--
-- Table structure for table `laundry_orders`
--

CREATE TABLE `laundry_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_number` varchar(30) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `service_type_id` bigint(20) UNSIGNED NOT NULL,
  `pickup_type` enum('pickup','dropoff') NOT NULL DEFAULT 'pickup',
  `pickup_address_id` bigint(20) UNSIGNED DEFAULT NULL,
  `delivery_address_id` bigint(20) UNSIGNED DEFAULT NULL,
  `pickup_slot_id` bigint(20) UNSIGNED NOT NULL,
  `pickup_slot_date` date NOT NULL,
  `delivery_slot_id` bigint(20) UNSIGNED DEFAULT NULL,
  `delivery_slot_date` date DEFAULT NULL,
  `promo_code_id` bigint(20) UNSIGNED DEFAULT NULL,
  `subtotal` decimal(10,2) NOT NULL DEFAULT 0.00,
  `discount_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `vat_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `delivery_fee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `payment_status` enum('pending','paid','failed','refunded') DEFAULT 'pending',
  `customer_notes` text DEFAULT NULL,
  `is_urgent` tinyint(1) DEFAULT 0,
  `current_stage` enum('order_confirmed','pickup_scheduled','picked_up','at_facility','inspection','washing','drying','ironing','quality_check','packaging','out_for_delivery','delivered','cancelled') NOT NULL DEFAULT 'order_confirmed',
  `odoo_order_id` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `laundry_order_bags`
--

CREATE TABLE `laundry_order_bags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `bag_number` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `item_count` smallint(5) UNSIGNED DEFAULT 0,
  `extra_items` smallint(5) UNSIGNED DEFAULT 0,
  `bag_price` decimal(8,2) NOT NULL,
  `extra_charge` decimal(8,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `laundry_order_items`
--

CREATE TABLE `laundry_order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `laundry_item_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` smallint(5) UNSIGNED NOT NULL DEFAULT 1,
  `unit_price` decimal(8,2) NOT NULL,
  `total_price` decimal(8,2) NOT NULL,
  `notes` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `laundry_order_photos`
--

CREATE TABLE `laundry_order_photos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `stage_id` bigint(20) UNSIGNED DEFAULT NULL,
  `photo_type` enum('before','after','stain','qc','pickup_proof','delivery_proof') NOT NULL,
  `file_url` varchar(500) NOT NULL,
  `thumbnail_url` varchar(500) DEFAULT NULL,
  `uploaded_by` bigint(20) UNSIGNED DEFAULT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `laundry_order_stages`
--

CREATE TABLE `laundry_order_stages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `stage` varchar(50) NOT NULL,
  `staff_id` bigint(20) UNSIGNED DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `is_customer_visible` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `laundry_service_types`
--

CREATE TABLE `laundry_service_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `icon_url` varchar(500) DEFAULT NULL,
  `bag_color` varchar(20) DEFAULT NULL,
  `pricing_model` enum('per_bag','per_item') NOT NULL DEFAULT 'per_item',
  `bag_price` decimal(8,2) DEFAULT NULL,
  `bag_capacity_kg` decimal(5,2) DEFAULT NULL,
  `bag_max_items` smallint(6) DEFAULT NULL,
  `extra_item_price` decimal(8,2) DEFAULT NULL,
  `sort_order` tinyint(3) UNSIGNED DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `laundry_service_types`
--

INSERT INTO `laundry_service_types` (`id`, `name`, `slug`, `description`, `icon_url`, `bag_color`, `pricing_model`, `bag_price`, `bag_capacity_kg`, `bag_max_items`, `extra_item_price`, `sort_order`, `is_active`) VALUES
(1, 'Clean & Press', 'clean-and-press', 'Dry clean or wash. 50+ cleaning programs depending on fabric.', NULL, NULL, 'per_item', NULL, NULL, NULL, NULL, 1, 1),
(2, 'Press Only', 'press-only', 'Steam pressing safe on all fabrics. Use Press Only Sticker.', NULL, NULL, 'per_item', NULL, NULL, NULL, NULL, 2, 1),
(3, 'Bed & Bath', 'bed-and-bath', 'Fill bag with up to 15 home linens — perfectly cleaned & pressed.', NULL, NULL, 'per_bag', 85.00, NULL, NULL, NULL, 3, 1),
(4, 'Wash & Fold', 'wash-and-fold', '40°C wash & tumble dry. Fill bag with any suitable item. No ironing.', NULL, NULL, 'per_bag', 75.00, 12.00, NULL, NULL, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `laundry_stain_markers`
--

CREATE TABLE `laundry_stain_markers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `photo_id` bigint(20) UNSIGNED NOT NULL,
  `x_percent` decimal(5,2) NOT NULL,
  `y_percent` decimal(5,2) NOT NULL,
  `description` varchar(255) DEFAULT NULL
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

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(200) NOT NULL,
  `body` text NOT NULL,
  `type` enum('push','sms','both') DEFAULT 'both',
  `channel` enum('booking','status_update','payment','promotion','system') NOT NULL,
  `reference_type` varchar(50) DEFAULT NULL,
  `reference_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `sent_at` timestamp NULL DEFAULT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `odoo_settings`
--

CREATE TABLE `odoo_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `setting_key` varchar(100) NOT NULL,
  `setting_value` text DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `odoo_settings`
--

INSERT INTO `odoo_settings` (`id`, `setting_key`, `setting_value`, `updated_at`) VALUES
(1, 'odoo_url', 'https://your-odoo.com', '2026-02-27 22:06:32'),
(2, 'odoo_db', 'your_db', '2026-02-27 22:06:32'),
(3, 'odoo_username', '', '2026-02-27 22:06:32'),
(4, 'odoo_api_key', '', '2026-02-27 22:06:32'),
(5, 'sync_interval_min', '15', '2026-02-27 22:06:32'),
(6, 'sync_customers', 'true', '2026-02-27 22:06:32'),
(7, 'sync_orders', 'true', '2026-02-27 22:06:32'),
(8, 'sync_inventory', 'true', '2026-02-27 22:06:32'),
(9, 'sync_invoices', 'false', '2026-02-27 22:06:32');

-- --------------------------------------------------------

--
-- Table structure for table `odoo_sync_log`
--

CREATE TABLE `odoo_sync_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `entity_type` enum('customer','laundry_order','tailor_booking','fabric','invoice') NOT NULL,
  `local_id` bigint(20) UNSIGNED NOT NULL,
  `odoo_id` varchar(100) DEFAULT NULL,
  `sync_action` enum('create','update','delete') NOT NULL,
  `status` enum('pending','success','failed') DEFAULT 'pending',
  `request_payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`request_payload`)),
  `response_body` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`response_body`)),
  `error_message` text DEFAULT NULL,
  `retries` tinyint(3) UNSIGNED DEFAULT 0,
  `synced_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `otp_verifications`
--

CREATE TABLE `otp_verifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `phone` varchar(20) NOT NULL,
  `otp_code` varchar(10) NOT NULL,
  `purpose` enum('login','signup','reset') NOT NULL,
  `is_used` tinyint(1) DEFAULT 0,
  `expires_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `payment_reference` varchar(100) NOT NULL,
  `order_type` enum('laundry','tailor') NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `currency` char(3) DEFAULT 'AED',
  `payment_method` enum('card','apple_pay','google_pay','cash','wallet') NOT NULL,
  `gateway` enum('stripe','telr','paytabs','network_international','manual') DEFAULT NULL,
  `gateway_ref` varchar(255) DEFAULT NULL,
  `status` enum('pending','processing','paid','failed','refunded') DEFAULT 'pending',
  `gateway_response` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`gateway_response`)),
  `paid_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `payment_reference`, `order_type`, `order_id`, `user_id`, `amount`, `currency`, `payment_method`, `gateway`, `gateway_ref`, `status`, `gateway_response`, `paid_at`, `created_at`, `updated_at`) VALUES
(1, 'PAY-69A21D8A14D12-1772232074', 'laundry', 1, 1, 500.00, 'AED', 'card', 'stripe', NULL, 'pending', NULL, NULL, '2026-02-27 17:41:14', '2026-02-27 17:41:14');

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
-- Table structure for table `promo_codes`
--

CREATE TABLE `promo_codes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `discount_type` enum('percentage','fixed') NOT NULL,
  `discount_value` decimal(8,2) NOT NULL,
  `min_order_amount` decimal(8,2) DEFAULT 0.00,
  `max_discount_cap` decimal(8,2) DEFAULT NULL,
  `max_uses_total` int(11) DEFAULT NULL,
  `max_uses_per_user` int(11) DEFAULT 1,
  `used_count` int(11) DEFAULT 0,
  `valid_from` date NOT NULL,
  `valid_until` date NOT NULL,
  `applicable_to` enum('all','laundry','tailor') DEFAULT 'all',
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `refunds`
--

CREATE TABLE `refunds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `payment_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `gateway_ref` varchar(255) DEFAULT NULL,
  `status` enum('pending','processed','failed') DEFAULT 'pending',
  `processed_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `order_type` enum('laundry','tailor') NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `rating` tinyint(3) UNSIGNED NOT NULL,
  `comment` text DEFAULT NULL,
  `is_public` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `service_areas`
--

CREATE TABLE `service_areas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL DEFAULT 'Dubai',
  `is_active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
('lOr3nZuGtFX9rSYohaOVxrJifI5tyw42sPF2oI7T', 7, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:148.0) Gecko/20100101 Firefox/148.0', 'YTo4OntzOjM6InVybCI7YTowOnt9czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi91c2VycyI7czo1OiJyb3V0ZSI7czozNjoiZmlsYW1lbnQuYWRtaW4ucmVzb3VyY2VzLnVzZXJzLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo2OiJfdG9rZW4iO3M6NDA6Ik9Ga203R0tMY1N1OHFRRVpSdnViaTdZbEZ2enZVZEZ3WHd4d3AxaHMiO3M6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjc7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjQ6IjQzY2ZjNTA1OWJmY2FiMmUwYmJmNDMwZjZlZGM4MjcwMGM4MzMzYjlmYTUzZjYzNGJkMDc5NmRhMjQ0ZmFhN2MiO3M6NjoidGFibGVzIjthOjE6e3M6NDA6ImU2NDQ4MzNmNGU0ZTA4NzEyMzE1ZGE3MWIzM2ZhY2QyX2NvbHVtbnMiO2E6MTA6e2k6MDthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czo0OiJuYW1lIjtzOjU6ImxhYmVsIjtzOjQ6Ik5hbWUiO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjoxO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjowO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7Tjt9aToxO2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjU6ImVtYWlsIjtzOjU6ImxhYmVsIjtzOjEzOiJFbWFpbCBhZGRyZXNzIjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MTtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MDtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO047fWk6MjthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czoxNzoiZW1haWxfdmVyaWZpZWRfYXQiO3M6NToibGFiZWwiO3M6MTc6IkVtYWlsIHZlcmlmaWVkIGF0IjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MTtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MDtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO047fWk6MzthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czo1OiJwaG9uZSI7czo1OiJsYWJlbCI7czo1OiJQaG9uZSI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjE7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjA7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtOO31pOjQ7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6MTc6InByb2ZpbGVfcGhvdG9fdXJsIjtzOjU6ImxhYmVsIjtzOjE3OiJQcm9maWxlIHBob3RvIHVybCI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjE7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjA7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtOO31pOjU7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6NDoicm9sZSI7czo1OiJsYWJlbCI7czo0OiJSb2xlIjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MTtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MDtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO047fWk6NjthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czo5OiJpc19hY3RpdmUiO3M6NToibGFiZWwiO3M6OToiSXMgYWN0aXZlIjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MTtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MDtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO047fWk6NzthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czoxMzoibGFzdF9sb2dpbl9hdCI7czo1OiJsYWJlbCI7czoxMzoiTGFzdCBsb2dpbiBhdCI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjE7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjA7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtOO31pOjg7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6MTA6ImNyZWF0ZWRfYXQiO3M6NToibGFiZWwiO3M6MTA6IkNyZWF0ZWQgYXQiO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjowO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjoxO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7YjoxO31pOjk7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6MTA6InVwZGF0ZWRfYXQiO3M6NToibGFiZWwiO3M6MTA6IlVwZGF0ZWQgYXQiO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjowO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjoxO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7YjoxO319fXM6ODoiZmlsYW1lbnQiO2E6MDp7fX0=', 1772613857),
('ULDoYeYh7TLP2GvpTPufwaE5MPpOJLXqrr1rlGLO', 7, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:148.0) Gecko/20100101 Firefox/148.0', 'YTo3OntzOjM6InVybCI7YTowOnt9czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi91c2VycyI7czo1OiJyb3V0ZSI7czozNjoiZmlsYW1lbnQuYWRtaW4ucmVzb3VyY2VzLnVzZXJzLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo2OiJfdG9rZW4iO3M6NDA6IjBZbUVOWVNpSktxZjJhQnpzODhJV21aam1TNEtwZUcwT3dqekpXa3EiO3M6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjc7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjQ6IjQzY2ZjNTA1OWJmY2FiMmUwYmJmNDMwZjZlZGM4MjcwMGM4MzMzYjlmYTUzZjYzNGJkMDc5NmRhMjQ0ZmFhN2MiO3M6NjoidGFibGVzIjthOjE6e3M6NDA6ImU2NDQ4MzNmNGU0ZTA4NzEyMzE1ZGE3MWIzM2ZhY2QyX2NvbHVtbnMiO2E6MTA6e2k6MDthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czo0OiJuYW1lIjtzOjU6ImxhYmVsIjtzOjQ6Ik5hbWUiO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjoxO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjowO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7Tjt9aToxO2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjU6ImVtYWlsIjtzOjU6ImxhYmVsIjtzOjEzOiJFbWFpbCBhZGRyZXNzIjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MTtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MDtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO047fWk6MjthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czoxNzoiZW1haWxfdmVyaWZpZWRfYXQiO3M6NToibGFiZWwiO3M6MTc6IkVtYWlsIHZlcmlmaWVkIGF0IjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MTtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MDtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO047fWk6MzthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czo1OiJwaG9uZSI7czo1OiJsYWJlbCI7czo1OiJQaG9uZSI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjE7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjA7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtOO31pOjQ7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6MTc6InByb2ZpbGVfcGhvdG9fdXJsIjtzOjU6ImxhYmVsIjtzOjEzOiJQcm9maWxlIFBob3RvIjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MTtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MDtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO047fWk6NTthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czo0OiJyb2xlIjtzOjU6ImxhYmVsIjtzOjQ6IlJvbGUiO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjoxO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjowO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7Tjt9aTo2O2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjk6ImlzX2FjdGl2ZSI7czo1OiJsYWJlbCI7czo5OiJJcyBhY3RpdmUiO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjoxO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjowO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7Tjt9aTo3O2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjEzOiJsYXN0X2xvZ2luX2F0IjtzOjU6ImxhYmVsIjtzOjEzOiJMYXN0IGxvZ2luIGF0IjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MTtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MDtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO047fWk6ODthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czoxMDoiY3JlYXRlZF9hdCI7czo1OiJsYWJlbCI7czoxMDoiQ3JlYXRlZCBhdCI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjA7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjE7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtiOjE7fWk6OTthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czoxMDoidXBkYXRlZF9hdCI7czo1OiJsYWJlbCI7czoxMDoiVXBkYXRlZCBhdCI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjA7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjE7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtiOjE7fX19fQ==', 1772614290);

-- --------------------------------------------------------

--
-- Table structure for table `slot_availability`
--

CREATE TABLE `slot_availability` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `time_slot_id` bigint(20) UNSIGNED NOT NULL,
  `slot_date` date NOT NULL,
  `booked_count` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `is_blocked` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sms_logs`
--

CREATE TABLE `sms_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `phone` varchar(20) NOT NULL,
  `message` text NOT NULL,
  `provider` varchar(50) DEFAULT NULL,
  `provider_ref` varchar(255) DEFAULT NULL,
  `status` enum('pending','sent','delivered','failed') DEFAULT 'pending',
  `sent_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `setting_key` varchar(150) NOT NULL,
  `setting_value` text DEFAULT NULL,
  `group_name` varchar(100) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `system_settings`
--

INSERT INTO `system_settings` (`id`, `setting_key`, `setting_value`, `group_name`, `updated_at`) VALUES
(1, 'vat_rate_percent', '5', 'pricing', '2026-02-27 22:06:32'),
(2, 'delivery_fee_aed', '15', 'pricing', '2026-02-27 22:06:32'),
(3, 'free_delivery_threshold', '150', 'pricing', '2026-02-27 22:06:32'),
(4, 'min_order_amount', '50', 'pricing', '2026-02-27 22:06:32'),
(5, 'express_surcharge_pct', '30', 'pricing', '2026-02-27 22:06:32'),
(6, 'sms_provider', 'twilio', 'notifications', '2026-02-27 22:06:32'),
(7, 'push_provider', 'firebase', 'notifications', '2026-02-27 22:06:32'),
(8, 'business_hours_start', '08:00', 'operations', '2026-02-27 22:06:32'),
(9, 'business_hours_end', '22:00', 'operations', '2026-02-27 22:06:32'),
(10, 'support_phone', '', 'contact', '2026-02-27 22:06:32'),
(11, 'support_email', '', 'contact', '2026-02-27 22:06:32');

-- --------------------------------------------------------

--
-- Table structure for table `tailor_bookings`
--

CREATE TABLE `tailor_bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_number` varchar(30) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `address_id` bigint(20) UNSIGNED NOT NULL,
  `time_slot_id` bigint(20) UNSIGNED NOT NULL,
  `booking_date` date NOT NULL,
  `preferred_time_note` varchar(255) DEFAULT NULL,
  `customer_notes` text DEFAULT NULL,
  `assigned_tailor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('requested','confirmed','tailor_assigned','visit_started','visit_completed','cancelled') NOT NULL DEFAULT 'requested',
  `completion_notes` text DEFAULT NULL,
  `odoo_lead_id` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tailor_measurements`
--

CREATE TABLE `tailor_measurements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` bigint(20) UNSIGNED NOT NULL,
  `chest` decimal(5,2) DEFAULT NULL,
  `shoulder` decimal(5,2) DEFAULT NULL,
  `waist` decimal(5,2) DEFAULT NULL,
  `hip` decimal(5,2) DEFAULT NULL,
  `sleeve_length` decimal(5,2) DEFAULT NULL,
  `trouser_length` decimal(5,2) DEFAULT NULL,
  `neck` decimal(5,2) DEFAULT NULL,
  `extra_notes` text DEFAULT NULL,
  `unit` enum('cm','inch') DEFAULT 'cm',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tailor_services`
--

CREATE TABLE `tailor_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `icon_url` varchar(500) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tailor_services`
--

INSERT INTO `tailor_services` (`id`, `name`, `description`, `icon_url`, `is_active`) VALUES
(1, 'Measurement', 'Home visit for full body measurements', NULL, 1),
(2, 'Alteration Consultation', 'Discuss and plan clothing alterations', NULL, 1),
(3, 'Custom Stitching Consultation', 'Plan custom garment with our tailor', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `time_slots`
--

CREATE TABLE `time_slots` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slot_type` enum('pickup','delivery','tailor_visit') NOT NULL,
  `day_of_week` tinyint(3) UNSIGNED NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `max_bookings` smallint(5) UNSIGNED NOT NULL DEFAULT 20,
  `is_active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `time_slots`
--

INSERT INTO `time_slots` (`id`, `slot_type`, `day_of_week`, `start_time`, `end_time`, `max_bookings`, `is_active`) VALUES
(1, 'pickup', 1, '09:00:00', '19:00:00', 20, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `profile_photo_url` varchar(500) DEFAULT NULL,
  `role` enum('customer','admin','driver','laundry_staff','tailor_staff') NOT NULL DEFAULT 'customer',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `fcm_token` varchar(500) DEFAULT NULL,
  `last_login_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `phone`, `password`, `profile_photo_url`, `role`, `is_active`, `fcm_token`, `last_login_at`, `created_at`, `updated_at`) VALUES
(1, 'Admin User', 'admin@stitchandwash.com', '2026-02-27 17:35:55', '+971500000000', '$2y$12$eVQDc4FdqiPOKnR.x6E/V.Z5uGSvB9E1vagsrh6snwFXFGbkHjTee', NULL, 'admin', 1, NULL, NULL, '2026-02-27 17:35:56', '2026-02-27 17:35:56'),
(2, 'Syed Safwan Abbas', 'safwan.naqvi@gmail.com', NULL, '+923058901993', '$2y$12$3rf.0GKHiZHhR/ollEU9cexNKf3qeJlB7cW377Mx3lHk2nyp3t3T6', NULL, 'laundry_staff', 1, NULL, NULL, '2026-02-27 17:42:35', '2026-02-27 17:42:35'),
(4, 'Syed Saleh Abbas', 'saleh@gmail.com', NULL, '+923058901995', NULL, NULL, 'driver', 1, NULL, NULL, '2026-02-27 18:51:44', '2026-02-27 18:51:44'),
(6, 'Saim Abbas', 'saim@gmail.com', NULL, '+923058901997', NULL, NULL, 'customer', 1, NULL, NULL, '2026-02-27 20:17:01', '2026-02-27 20:17:01'),
(7, 'admin', 'admin@admin.com', NULL, NULL, '$2y$12$6MncDvm7O4siwJWHtZO5BeCJVMZSQApIAWiMk0stK9veLFVZlIi46', NULL, 'admin', 1, NULL, NULL, '2026-03-04 00:48:52', '2026-03-04 07:22:59'),
(8, 'Test', 'testing@gmail.com', NULL, '987868767686', '$2y$12$BuW0Mx8/GCFIJmbkc2QrSuxs4YB1tNqePlrieMqjX5DttZSnLlSl6', 'profile-photos/01KJW0KX721BWNW2QAK2Z5SKC8.jpeg', 'customer', 1, NULL, NULL, '2026-03-04 02:26:29', '2026-03-04 03:49:46'),
(9, 'shirt', 'shirt@shirt.com', NULL, '7687676678', '$2y$12$DQkaeJf7eNjsqbsIyhQX5O6IquMFJV3Ls6v6hdHBxenIjlfjc9EyK', 'profile-photos/01KJVYZTGS1478FSAWFDBA0YT8.png', 'tailor_staff', 1, NULL, NULL, '2026-03-04 03:21:19', '2026-03-04 03:21:19');

-- --------------------------------------------------------

--
-- Table structure for table `user_sessions`
--

CREATE TABLE `user_sessions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `token_hash` varchar(255) NOT NULL,
  `device_type` enum('ios','android','web') NOT NULL,
  `device_name` varchar(150) DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `expires_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wallet_transactions`
--

CREATE TABLE `wallet_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `wallet_id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('credit','debit') NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `reference_type` varchar(50) DEFAULT NULL,
  `reference_id` bigint(20) UNSIGNED DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `customer_wallets`
--
ALTER TABLE `customer_wallets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `driver_locations`
--
ALTER TABLE `driver_locations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_driver_loc` (`driver_id`,`recorded_at`);

--
-- Indexes for table `fabrics`
--
ALTER TABLE `fabrics`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `fabric_code` (`fabric_code`),
  ADD KEY `idx_fabrics_status` (`stock_status`);

--
-- Indexes for table `fabric_favorites`
--
ALTER TABLE `fabric_favorites`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_user_fabric` (`user_id`,`fabric_id`),
  ADD KEY `fabric_id` (`fabric_id`);

--
-- Indexes for table `fabric_images`
--
ALTER TABLE `fabric_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fabric_id` (`fabric_id`);

--
-- Indexes for table `job_assignments`
--
ALTER TABLE `job_assignments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assigned_by` (`assigned_by`),
  ADD KEY `idx_job_assignments_driver` (`assigned_to`,`status`);

--
-- Indexes for table `laundry_items`
--
ALTER TABLE `laundry_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `laundry_item_categories`
--
ALTER TABLE `laundry_item_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_type_id` (`service_type_id`);

--
-- Indexes for table `laundry_orders`
--
ALTER TABLE `laundry_orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `order_number` (`order_number`),
  ADD KEY `service_type_id` (`service_type_id`),
  ADD KEY `pickup_address_id` (`pickup_address_id`),
  ADD KEY `delivery_address_id` (`delivery_address_id`),
  ADD KEY `pickup_slot_id` (`pickup_slot_id`),
  ADD KEY `delivery_slot_id` (`delivery_slot_id`),
  ADD KEY `promo_code_id` (`promo_code_id`),
  ADD KEY `idx_laundry_orders_user` (`user_id`),
  ADD KEY `idx_laundry_orders_stage` (`current_stage`),
  ADD KEY `idx_laundry_orders_pickup_date` (`pickup_slot_date`);

--
-- Indexes for table `laundry_order_bags`
--
ALTER TABLE `laundry_order_bags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `laundry_order_items`
--
ALTER TABLE `laundry_order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `laundry_item_id` (`laundry_item_id`);

--
-- Indexes for table `laundry_order_photos`
--
ALTER TABLE `laundry_order_photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `stage_id` (`stage_id`),
  ADD KEY `uploaded_by` (`uploaded_by`);

--
-- Indexes for table `laundry_order_stages`
--
ALTER TABLE `laundry_order_stages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `staff_id` (`staff_id`);

--
-- Indexes for table `laundry_service_types`
--
ALTER TABLE `laundry_service_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `laundry_stain_markers`
--
ALTER TABLE `laundry_stain_markers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `photo_id` (`photo_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_notif_user_read` (`user_id`,`is_read`);

--
-- Indexes for table `odoo_settings`
--
ALTER TABLE `odoo_settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `setting_key` (`setting_key`);

--
-- Indexes for table `odoo_sync_log`
--
ALTER TABLE `odoo_sync_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_odoo_entity` (`entity_type`,`local_id`),
  ADD KEY `idx_odoo_status` (`status`);

--
-- Indexes for table `otp_verifications`
--
ALTER TABLE `otp_verifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_otp_phone` (`phone`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `payment_reference` (`payment_reference`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `idx_payments_order` (`order_type`,`order_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `promo_codes`
--
ALTER TABLE `promo_codes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `refunds`
--
ALTER TABLE `refunds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_id` (`payment_id`),
  ADD KEY `processed_by` (`processed_by`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_review` (`user_id`,`order_type`,`order_id`);

--
-- Indexes for table `service_areas`
--
ALTER TABLE `service_areas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `slot_availability`
--
ALTER TABLE `slot_availability`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_slot_date` (`time_slot_id`,`slot_date`);

--
-- Indexes for table `sms_logs`
--
ALTER TABLE `sms_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_settings`
--
ALTER TABLE `system_settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `setting_key` (`setting_key`);

--
-- Indexes for table `tailor_bookings`
--
ALTER TABLE `tailor_bookings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `booking_number` (`booking_number`),
  ADD KEY `service_id` (`service_id`),
  ADD KEY `address_id` (`address_id`),
  ADD KEY `time_slot_id` (`time_slot_id`),
  ADD KEY `assigned_tailor_id` (`assigned_tailor_id`),
  ADD KEY `idx_tailor_bookings_user` (`user_id`),
  ADD KEY `idx_tailor_bookings_status` (`status`),
  ADD KEY `idx_tailor_bookings_date` (`booking_date`);

--
-- Indexes for table `tailor_measurements`
--
ALTER TABLE `tailor_measurements`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `booking_id` (`booking_id`);

--
-- Indexes for table `tailor_services`
--
ALTER TABLE `tailor_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `time_slots`
--
ALTER TABLE `time_slots`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_sessions`
--
ALTER TABLE `user_sessions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token_hash` (`token_hash`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `wallet_transactions`
--
ALTER TABLE `wallet_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wallet_id` (`wallet_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_wallets`
--
ALTER TABLE `customer_wallets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `driver_locations`
--
ALTER TABLE `driver_locations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fabrics`
--
ALTER TABLE `fabrics`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fabric_favorites`
--
ALTER TABLE `fabric_favorites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fabric_images`
--
ALTER TABLE `fabric_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_assignments`
--
ALTER TABLE `job_assignments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `laundry_items`
--
ALTER TABLE `laundry_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `laundry_item_categories`
--
ALTER TABLE `laundry_item_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `laundry_orders`
--
ALTER TABLE `laundry_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `laundry_order_bags`
--
ALTER TABLE `laundry_order_bags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `laundry_order_items`
--
ALTER TABLE `laundry_order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `laundry_order_photos`
--
ALTER TABLE `laundry_order_photos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `laundry_order_stages`
--
ALTER TABLE `laundry_order_stages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `laundry_service_types`
--
ALTER TABLE `laundry_service_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `laundry_stain_markers`
--
ALTER TABLE `laundry_stain_markers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `odoo_settings`
--
ALTER TABLE `odoo_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `odoo_sync_log`
--
ALTER TABLE `odoo_sync_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `otp_verifications`
--
ALTER TABLE `otp_verifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `promo_codes`
--
ALTER TABLE `promo_codes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `refunds`
--
ALTER TABLE `refunds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service_areas`
--
ALTER TABLE `service_areas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `slot_availability`
--
ALTER TABLE `slot_availability`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sms_logs`
--
ALTER TABLE `sms_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tailor_bookings`
--
ALTER TABLE `tailor_bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tailor_measurements`
--
ALTER TABLE `tailor_measurements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tailor_services`
--
ALTER TABLE `tailor_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `time_slots`
--
ALTER TABLE `time_slots`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_sessions`
--
ALTER TABLE `user_sessions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wallet_transactions`
--
ALTER TABLE `wallet_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `customer_wallets`
--
ALTER TABLE `customer_wallets`
  ADD CONSTRAINT `customer_wallets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `driver_locations`
--
ALTER TABLE `driver_locations`
  ADD CONSTRAINT `driver_locations_ibfk_1` FOREIGN KEY (`driver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `fabric_favorites`
--
ALTER TABLE `fabric_favorites`
  ADD CONSTRAINT `fabric_favorites_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fabric_favorites_ibfk_2` FOREIGN KEY (`fabric_id`) REFERENCES `fabrics` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `fabric_images`
--
ALTER TABLE `fabric_images`
  ADD CONSTRAINT `fabric_images_ibfk_1` FOREIGN KEY (`fabric_id`) REFERENCES `fabrics` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `job_assignments`
--
ALTER TABLE `job_assignments`
  ADD CONSTRAINT `job_assignments_ibfk_1` FOREIGN KEY (`assigned_to`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `job_assignments_ibfk_2` FOREIGN KEY (`assigned_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `laundry_items`
--
ALTER TABLE `laundry_items`
  ADD CONSTRAINT `laundry_items_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `laundry_item_categories` (`id`);

--
-- Constraints for table `laundry_item_categories`
--
ALTER TABLE `laundry_item_categories`
  ADD CONSTRAINT `laundry_item_categories_ibfk_1` FOREIGN KEY (`service_type_id`) REFERENCES `laundry_service_types` (`id`);

--
-- Constraints for table `laundry_orders`
--
ALTER TABLE `laundry_orders`
  ADD CONSTRAINT `laundry_orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `laundry_orders_ibfk_2` FOREIGN KEY (`service_type_id`) REFERENCES `laundry_service_types` (`id`),
  ADD CONSTRAINT `laundry_orders_ibfk_3` FOREIGN KEY (`pickup_address_id`) REFERENCES `addresses` (`id`),
  ADD CONSTRAINT `laundry_orders_ibfk_4` FOREIGN KEY (`delivery_address_id`) REFERENCES `addresses` (`id`),
  ADD CONSTRAINT `laundry_orders_ibfk_5` FOREIGN KEY (`pickup_slot_id`) REFERENCES `time_slots` (`id`),
  ADD CONSTRAINT `laundry_orders_ibfk_6` FOREIGN KEY (`delivery_slot_id`) REFERENCES `time_slots` (`id`),
  ADD CONSTRAINT `laundry_orders_ibfk_7` FOREIGN KEY (`promo_code_id`) REFERENCES `promo_codes` (`id`);

--
-- Constraints for table `laundry_order_bags`
--
ALTER TABLE `laundry_order_bags`
  ADD CONSTRAINT `laundry_order_bags_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `laundry_orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `laundry_order_items`
--
ALTER TABLE `laundry_order_items`
  ADD CONSTRAINT `laundry_order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `laundry_orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `laundry_order_items_ibfk_2` FOREIGN KEY (`laundry_item_id`) REFERENCES `laundry_items` (`id`);

--
-- Constraints for table `laundry_order_photos`
--
ALTER TABLE `laundry_order_photos`
  ADD CONSTRAINT `laundry_order_photos_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `laundry_orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `laundry_order_photos_ibfk_2` FOREIGN KEY (`stage_id`) REFERENCES `laundry_order_stages` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `laundry_order_photos_ibfk_3` FOREIGN KEY (`uploaded_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `laundry_order_stages`
--
ALTER TABLE `laundry_order_stages`
  ADD CONSTRAINT `laundry_order_stages_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `laundry_orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `laundry_order_stages_ibfk_2` FOREIGN KEY (`staff_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `laundry_stain_markers`
--
ALTER TABLE `laundry_stain_markers`
  ADD CONSTRAINT `laundry_stain_markers_ibfk_1` FOREIGN KEY (`photo_id`) REFERENCES `laundry_order_photos` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `refunds`
--
ALTER TABLE `refunds`
  ADD CONSTRAINT `refunds_ibfk_1` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`id`),
  ADD CONSTRAINT `refunds_ibfk_2` FOREIGN KEY (`processed_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `slot_availability`
--
ALTER TABLE `slot_availability`
  ADD CONSTRAINT `slot_availability_ibfk_1` FOREIGN KEY (`time_slot_id`) REFERENCES `time_slots` (`id`);

--
-- Constraints for table `tailor_bookings`
--
ALTER TABLE `tailor_bookings`
  ADD CONSTRAINT `tailor_bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `tailor_bookings_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `tailor_services` (`id`),
  ADD CONSTRAINT `tailor_bookings_ibfk_3` FOREIGN KEY (`address_id`) REFERENCES `addresses` (`id`),
  ADD CONSTRAINT `tailor_bookings_ibfk_4` FOREIGN KEY (`time_slot_id`) REFERENCES `time_slots` (`id`),
  ADD CONSTRAINT `tailor_bookings_ibfk_5` FOREIGN KEY (`assigned_tailor_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `tailor_measurements`
--
ALTER TABLE `tailor_measurements`
  ADD CONSTRAINT `tailor_measurements_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `tailor_bookings` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_sessions`
--
ALTER TABLE `user_sessions`
  ADD CONSTRAINT `user_sessions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wallet_transactions`
--
ALTER TABLE `wallet_transactions`
  ADD CONSTRAINT `wallet_transactions_ibfk_1` FOREIGN KEY (`wallet_id`) REFERENCES `customer_wallets` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
