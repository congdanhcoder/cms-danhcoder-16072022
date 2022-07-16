-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:8889
-- Thời gian đã tạo: Th7 16, 2022 lúc 02:51 AM
-- Phiên bản máy phục vụ: 5.7.34
-- Phiên bản PHP: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `danhcoder`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cat_posts`
--

CREATE TABLE `cat_posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `content` text COLLATE utf8mb4_unicode_ci,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `cat_posts`
--

INSERT INTO `cat_posts` (`id`, `title`, `slug`, `description`, `content`, `avatar`, `parent_id`) VALUES
(1, 'Tin tức', 'category/tin-tuc.html', NULL, NULL, 'public/uploads/images/anh2.jpeg', 0),
(3, 'Tin 24/7', 'category/tin-247.html', NULL, NULL, NULL, 1),
(5, 'Blog PHP', 'category/blog-php.html', NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cat_products`
--

CREATE TABLE `cat_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `content` text COLLATE utf8mb4_unicode_ci,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `cat_products`
--

INSERT INTO `cat_products` (`id`, `title`, `slug`, `description`, `content`, `avatar`, `parent_id`) VALUES
(1, 'Điện thoại', 'category/dien-thoai.html', NULL, NULL, 'public/uploads/images/9-300x300-copy(8).jpg', 0),
(2, 'Điện thoại Iphone', 'category/dien-thoai-iphone.html', NULL, NULL, 'public/uploads/images/cf3-copy.jpg', 1),
(3, 'Điện thoại Xoami', 'category/dien-thoai-xoami.html', NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `gallerys`
--

CREATE TABLE `gallerys` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `gallerys`
--

INSERT INTO `gallerys` (`id`, `slug`, `created_at`, `updated_at`) VALUES
(285, 'public/uploads/images/011-300x300.jpg', NULL, NULL),
(295, 'public/uploads/images/hop-tac-nhan-giong-cho-canh-1 (1)-copy(1).png', NULL, NULL),
(306, 'public/uploads/images/8-300x300.jpg', NULL, NULL),
(307, 'public/uploads/images/08-300x300.jpg', NULL, NULL),
(308, 'public/uploads/images/9-300x300.jpg', NULL, NULL),
(309, 'public/uploads/images/10-300x300.jpg', NULL, NULL),
(311, 'public/uploads/images/Banner-Dogs.jpeg', NULL, NULL),
(312, 'public/uploads/images/cho-canh-1.png', NULL, NULL),
(315, 'public/uploads/images/9-300x300-copy.jpg', NULL, NULL),
(316, 'public/uploads/images/cho-canh-1-copy.png', NULL, NULL),
(317, 'public/uploads/images/hop-tac-nhan-giong-cho-canh-1 (1)-copy.png', NULL, NULL),
(318, 'public/uploads/images/Banner-Dogs-copy.jpeg', NULL, NULL),
(319, 'public/uploads/images/08-300x300-copy(1).jpg', NULL, NULL),
(320, 'public/uploads/images/10-300x300-copy.jpg', NULL, NULL),
(322, 'public/uploads/images/hop-tac-nhan-giong-cho-canh-1 (1).png', NULL, NULL),
(323, 'public/uploads/images/hop-tac-nhan-giong-cho-canh-1.png', NULL, NULL),
(324, 'public/uploads/images/meo-canh-1.png', NULL, NULL),
(325, 'public/uploads/images/pet-seasonal-allergies-banner-1500x600.jpeg', NULL, NULL),
(327, 'public/uploads/images/PLSA630-petilfesa-web-dog-banner-image-FA.jpeg', NULL, NULL),
(328, 'public/uploads/images/slider-222.jpg', NULL, NULL),
(329, 'public/uploads/images/spa-cho-meo-1.png', NULL, NULL),
(331, 'public/uploads/images/9-300x300-copy(1).jpg', NULL, NULL),
(333, 'public/uploads/images/011-300x300-copy.jpg', NULL, NULL),
(334, 'public/uploads/images/Banner-Dogs-copy(1).jpeg', NULL, NULL),
(335, 'public/uploads/images/cho-canh-1-copy(1).png', NULL, NULL),
(336, 'public/uploads/images/08-300x300-copy.jpg', NULL, NULL),
(337, 'public/uploads/images/9-300x300-copy(2).jpg', NULL, NULL),
(338, 'public/uploads/images/10-300x300-copy(1).jpg', NULL, NULL),
(339, 'public/uploads/images/011-300x300-copy(1).jpg', NULL, NULL),
(340, 'public/uploads/images/10-300x300-copy(2).jpg', NULL, NULL),
(341, 'public/uploads/images/011-300x300-copy(2).jpg', NULL, NULL),
(342, 'public/uploads/images/Banner-Dogs-copy(2).jpeg', NULL, NULL),
(343, 'public/uploads/images/cho-canh-1-copy(2).png', NULL, NULL),
(344, 'public/uploads/images/hop-tac-nhan-giong-cho-canh-1 (1)-copy(2).png', NULL, NULL),
(345, 'public/uploads/images/hop-tac-nhan-giong-cho-canh-1-copy.png', NULL, NULL),
(346, 'public/uploads/images/meo-canh-1-copy.png', NULL, NULL),
(347, 'public/uploads/images/pet-seasonal-allergies-banner-1500x600-copy.jpeg', NULL, NULL),
(348, 'public/uploads/images/01-300x300.jpg', NULL, NULL),
(349, 'public/uploads/images/5-1-300x300.jpg', NULL, NULL),
(350, 'public/uploads/images/07-300x300.jpg', NULL, NULL),
(351, 'public/uploads/images/8-300x300-copy.jpg', NULL, NULL),
(352, 'public/uploads/images/08-300x300-copy(2).jpg', NULL, NULL),
(353, 'public/uploads/images/9-300x300-copy(3).jpg', NULL, NULL),
(354, 'public/uploads/images/10-300x300-copy(3).jpg', NULL, NULL),
(355, 'public/uploads/images/01-300x300-copy.jpg', NULL, NULL),
(356, 'public/uploads/images/5-1-300x300-copy.jpg', NULL, NULL),
(357, 'public/uploads/images/07-300x300-copy.jpg', NULL, NULL),
(358, 'public/uploads/images/8-300x300-copy(1).jpg', NULL, NULL),
(359, 'public/uploads/images/08-300x300-copy(3).jpg', NULL, NULL),
(360, 'public/uploads/images/9-300x300-copy(4).jpg', NULL, NULL),
(361, 'public/uploads/images/10-300x300-copy(4).jpg', NULL, NULL),
(363, 'public/uploads/images/5-1-300x300-copy(1).jpg', NULL, NULL),
(364, 'public/uploads/images/07-300x300-copy(1).jpg', NULL, NULL),
(365, 'public/uploads/images/8-300x300-copy(2).jpg', NULL, NULL),
(366, 'public/uploads/images/08-300x300-copy(4).jpg', NULL, NULL),
(367, 'public/uploads/images/9-300x300-copy(5).jpg', NULL, NULL),
(368, 'public/uploads/images/10-300x300-copy(5).jpg', NULL, NULL),
(369, 'public/uploads/images/01-300x300-copy(2).jpg', NULL, NULL),
(372, 'public/uploads/images/8-300x300-copy(3).jpg', NULL, NULL),
(373, 'public/uploads/images/08-300x300-copy(5).jpg', NULL, NULL),
(374, 'public/uploads/images/9-300x300-copy(6).jpg', NULL, NULL),
(375, 'public/uploads/images/10-300x300-copy(6).jpg', NULL, NULL),
(378, 'public/uploads/images/07-300x300-copy(3).jpg', NULL, NULL),
(379, 'public/uploads/images/8-300x300-copy(4).jpg', NULL, NULL),
(380, 'public/uploads/images/08-300x300-copy(6).jpg', NULL, NULL),
(381, 'public/uploads/images/9-300x300-copy(7).jpg', NULL, NULL),
(385, 'public/uploads/images/07-300x300-copy(4).jpg', NULL, NULL),
(387, 'public/uploads/images/08-300x300-copy(7).jpg', NULL, NULL),
(398, 'public/uploads/images/9-300x300-copy(9).jpg', NULL, NULL),
(401, 'public/uploads/images/011-300x300-copy(3).jpg', NULL, NULL),
(402, 'public/uploads/images/5-1.jpg', NULL, NULL),
(403, 'public/uploads/images/01-300x300-copy(5).jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `image_products`
--

CREATE TABLE `image_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `image_products`
--

INSERT INTO `image_products` (`id`, `slug`, `product_id`) VALUES
(20, 'public/uploads/images/08-300x300-copy(7).jpg', 9),
(21, 'public/uploads/images/07-300x300-copy(4).jpg', 9);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loyal_customers`
--

CREATE TABLE `loyal_customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_06_17_053040_loyal_customers', 1),
(6, '2022_06_20_022929_create_posts_table', 2),
(7, '2022_06_20_023002_create_cat_posts_table', 2),
(8, '2022_06_20_023039_create_posts_and_cats_table', 2),
(9, '2022_06_23_084513_create_cat_products__table', 3),
(10, '2022_06_23_084529_create_products_table', 3),
(11, '2022_06_23_084740_create_products_and_cats_table', 4),
(12, '2022_06_24_123359_create_roles_table', 5),
(13, '2022_06_24_123432_create_roles_and_users_table', 5),
(14, '2022_06_25_003358_create_position_table', 6),
(15, '2022_06_25_003503_create_posititons_and_roles_table', 6),
(16, '2022_06_26_084959_create_gallerys_table', 7),
(17, '2022_06_26_085025_create_image_products_table', 7);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('congdanhbmt2498@gmail.com', '$2y$10$lwo5ggm10reVfJ9sEwQEvO0TTKNxeih36.WK.mKtw7STQnPdL0DGG', '2022-07-12 19:09:51');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `positions`
--

CREATE TABLE `positions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `describe` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `positions`
--

INSERT INTO `positions` (`id`, `title`, `describe`) VALUES
(1, 'SuperAdmin', ''),
(2, 'Admin', ''),
(3, 'Manager', ''),
(4, 'Content', ''),
(5, 'ShopManager', ''),
(6, 'Customer', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `positions_and_roles`
--

CREATE TABLE `positions_and_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_position` bigint(20) UNSIGNED NOT NULL,
  `id_role` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `content` text COLLATE utf8mb4_unicode_ci,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `index` int(11) DEFAULT NULL,
  `user_id` bigint(11) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `posts`
--

INSERT INTO `posts` (`id`, `title`, `slug`, `description`, `content`, `avatar`, `status`, `index`, `user_id`, `created_at`, `updated_at`) VALUES
(2, 'OPPO Watch Free giá cực tốt mừng sinh nhật MWG, giảm siêu yêu chờ bạn tới rước', 'posts/oppo-watch-free-gia-cuc-tot-mung-sinh-nhat-mwg-giam-sieu-yeu-cho-ban-toi-ruoc.html', NULL, '<p>Sở hữu diện mạo độc đ&aacute;o với sự kết hợp của chiếc&nbsp;v&agrave; đồng hồ th&ocirc;ng minh đ&atilde; tạo n&ecirc;n vẻ hiện đại, năng động, trẻ trung. M&agrave;n h&igrave;nh cong 2.5D k&iacute;ch thước 1.64 inch, sở hữu tấm nền AMOLED sắc n&eacute;t.</p>\r\n\r\n<p>Tha hồ lựa chọn với hơn 40 mặt đồng hồ được trang bị sẵn hoặc tự thiết kế theo sở th&iacute;ch với Light Paint. Đặc biệt, đồng hồ c&ograve;n c&oacute; thể tuỳ chỉnh giao diện đồng bộ với m&agrave;u trang phục của m&igrave;nh theo ng&agrave;y nhờ t&iacute;nh năng AI Outfit độc đ&aacute;o.</p>\r\n\r\n<p>Trang bị nhiều cảm biến hiện đại như cảm biến nhịp tim quang học, cảm biến oxy trong m&aacute;u quang học,... gi&uacute;p theo d&otilde;i, ph&acirc;n t&iacute;ch c&aacute;c chỉ số sức khoẻ li&ecirc;n tục. T&iacute;nh năng đ&aacute;ng ch&uacute; &yacute; nhất l&agrave; theo d&otilde;i giấc ngủ to&agrave;n cảnh với OSleep, nhắc nhở giờ ngủ, đ&aacute;nh gi&aacute; tiếng ng&aacute;y... kết hợp dữ liệu SpO2 v&agrave; nhịp tim để đ&aacute;nh gi&aacute; nguy cơ mắc c&aacute;c vấn đề về h&ocirc; hấp gi&uacute;p bạn hiểu r&otilde; v&agrave; cải thiện chất lượng giấc ngủ của m&igrave;nh.</p>', 'public/uploads/images/5-1.jpg', 1, 0, 1, '2022-07-13 21:10:20', '2022-07-13 21:10:36'),
(3, 'Chỉ 1 ngày nữa sự kiện Tech-Offline Galaxy A53 | A73 5G sẽ chính thức diễn ra: Đấu PUBG nhận quà xịn', 'posts/chi-1-ngay-nua-su-kien-tech-offline-galaxy-a53-a73-5g-se-chinh-thuc-dien-ra-dau-pubg-nhan-qua-xin.html', NULL, '<h2><a href=\"https://www.thegioididong.com/samsung\" target=\"_blank\" title=\"Samsung\" type=\"Samsung\">Samsung</a>&nbsp;đ&atilde; ra mắt nhiều mẫu&nbsp;<a href=\"http://thegioididong.com/dtdd\" target=\"_blank\" title=\"smartphone\" type=\"smartphone\">smartphone</a>&nbsp;thuộc d&ograve;ng&nbsp;<a href=\"https://www.thegioididong.com/dtdd-samsung-galaxy-a\" target=\"_blank\" title=\"Galaxy A\" type=\"Galaxy A\">Galaxy A</a>&nbsp;trong năm 2022, trong đ&oacute; c&oacute;&nbsp;<a href=\"https://www.thegioididong.com/dtdd/samsung-galaxy-a53\" target=\"_blank\" title=\"Galaxy A53 5G\" type=\"Galaxy A53 5G\">Galaxy A53 5G</a>&nbsp;v&agrave;&nbsp;<a href=\"https://www.thegioididong.com/dtdd/samsung-galaxy-a73\" target=\"_blank\" title=\"Galaxy A 73 5G\" type=\"Galaxy A 73 5G\">Galaxy A73 5G</a>. Mới đ&acirc;y, mọi người đ&atilde; c&oacute; thể đăng k&yacute; tham gia &quot;Sự kiện Tech-Offline Galaxy A53 | A73 5G&quot;. C&ugrave;ng&nbsp;<a href=\"https://www.thegioididong.com/tin-tuc\" target=\"_blank\" title=\"24h Công nghệ\" type=\"24h Công nghệ\">24h C&ocirc;ng nghệ</a>&nbsp;t&igrave;m hiểu nh&eacute;!</h2>\r\n\r\n<p>Theo kế hoạch th&igrave; sự kiện sẽ diễn ra từ&nbsp;9h30 đến 11h30 v&agrave;o thứ s&aacute;u, ng&agrave;y 15/7/2022, tại The Factory Contemporary Arts Centre.</p>\r\n\r\n<p>Sự kiện sẽ bao gồm c&aacute;c hoạt động hấp dẫn như: Nhiều trận battle PUBG cực hay, giải thưởng xịn s&ograve;. Đi k&egrave;m l&agrave; &quot;Lucky Draw&quot; v&ograve;ng quay may mắn chứa qu&agrave; tặng hấp dẫn.</p>', 'public/uploads/images/011-300x300-copy(3).jpg', 0, 0, 1, '2022-07-13 21:11:36', '2022-07-13 21:11:36');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `posts_and_cats`
--

CREATE TABLE `posts_and_cats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_post` bigint(20) UNSIGNED DEFAULT NULL,
  `id_cat` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `posts_and_cats`
--

INSERT INTO `posts_and_cats` (`id`, `id_post`, `id_cat`) VALUES
(8, 2, 3),
(10, 3, 5);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `price_sale` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `star_rating` int(11) DEFAULT NULL,
  `share_code` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `index` int(11) DEFAULT NULL,
  `user_id` bigint(11) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `title`, `slug`, `description`, `content`, `avatar`, `price`, `price_sale`, `amount`, `star_rating`, `share_code`, `status`, `index`, `user_id`, `created_at`, `updated_at`) VALUES
(9, 'điện thoại 1', 'products/dien-thoai-1.html', NULL, NULL, 'public/uploads/images/07-300x300-copy(4).jpg', NULL, NULL, NULL, NULL, NULL, 1, NULL, 7, '2022-07-15 19:18:04', '2022-07-15 19:18:04');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products_and_cats`
--

CREATE TABLE `products_and_cats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_product` bigint(20) UNSIGNED DEFAULT NULL,
  `id_cat` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products_and_cats`
--

INSERT INTO `products_and_cats` (`id`, `id_product`, `id_cat`) VALUES
(6, 9, 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `roles`
--

INSERT INTO `roles` (`id`, `title`) VALUES
(1, 'SuperAdmin'),
(2, 'Admin'),
(3, 'Manager'),
(4, 'Content'),
(5, 'Customer');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `positions_id` bigint(20) UNSIGNED DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `status`, `email_verified_at`, `password`, `positions_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Hoàng Công Danh', 'congdanhbmt2498@gmail.com', NULL, 1, NULL, '$2y$10$Yf2OvkgV8o8zFRr5Ur8Kw.2Dfll67tLm4eGGPV.5CyvYhH0FICgOe', 1, NULL, '2022-06-24 19:25:09', '2022-06-24 19:25:09'),
(7, 'Hoàng Danh', 'nhadat47@gmail.com', '977985999', 0, NULL, '$2y$10$N7YpBU7cD0jxU4Szo2N0W.1bUYQBoNLNNm/28RaAeD507q5xyZqZO', 2, NULL, '2022-07-13 19:22:15', '2022-07-13 19:22:15');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `cat_posts`
--
ALTER TABLE `cat_posts`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `cat_products`
--
ALTER TABLE `cat_products`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `gallerys`
--
ALTER TABLE `gallerys`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `image_products`
--
ALTER TABLE `image_products`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `loyal_customers`
--
ALTER TABLE `loyal_customers`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `positions_and_roles`
--
ALTER TABLE `positions_and_roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `positions_id` (`id_position`),
  ADD KEY `roles_id` (`id_role`);

--
-- Chỉ mục cho bảng `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `posts_and_cats`
--
ALTER TABLE `posts_and_cats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cat` (`id_cat`),
  ADD KEY `id_post` (`id_post`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `products_and_cats`
--
ALTER TABLE `products_and_cats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cat` (`id_cat`),
  ADD KEY `id_product` (`id_product`);

--
-- Chỉ mục cho bảng `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `positions_id` (`positions_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `cat_posts`
--
ALTER TABLE `cat_posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `cat_products`
--
ALTER TABLE `cat_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `gallerys`
--
ALTER TABLE `gallerys`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=404;

--
-- AUTO_INCREMENT cho bảng `image_products`
--
ALTER TABLE `image_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `loyal_customers`
--
ALTER TABLE `loyal_customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `positions`
--
ALTER TABLE `positions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `positions_and_roles`
--
ALTER TABLE `positions_and_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `posts_and_cats`
--
ALTER TABLE `posts_and_cats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `products_and_cats`
--
ALTER TABLE `products_and_cats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `positions_and_roles`
--
ALTER TABLE `positions_and_roles`
  ADD CONSTRAINT `positions_and_roles_ibfk_1` FOREIGN KEY (`id_position`) REFERENCES `positions` (`id`),
  ADD CONSTRAINT `positions_and_roles_ibfk_2` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id`);

--
-- Các ràng buộc cho bảng `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `posts_and_cats`
--
ALTER TABLE `posts_and_cats`
  ADD CONSTRAINT `posts_and_cats_ibfk_1` FOREIGN KEY (`id_cat`) REFERENCES `cat_posts` (`id`),
  ADD CONSTRAINT `posts_and_cats_ibfk_2` FOREIGN KEY (`id_post`) REFERENCES `posts` (`id`);

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `products_and_cats`
--
ALTER TABLE `products_and_cats`
  ADD CONSTRAINT `products_and_cats_ibfk_1` FOREIGN KEY (`id_cat`) REFERENCES `cat_products` (`id`),
  ADD CONSTRAINT `products_and_cats_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`);

--
-- Các ràng buộc cho bảng `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`positions_id`) REFERENCES `positions` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
