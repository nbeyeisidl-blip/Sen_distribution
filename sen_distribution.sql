-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 27 sep. 2026 à 15:48
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `sen_distribution`
--

-- --------------------------------------------------------

--
-- Structure de la table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `name`, `slug`, `description`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 7, 'vetement homme', 'vetement-homme', NULL, 0, '2026-09-20 23:47:30', '2026-09-26 17:54:56'),
(2, 8, 'vetement femme', 'vetement-femme', NULL, 0, '2026-09-21 00:12:12', '2026-09-26 17:54:37'),
(5, 8, 'acessoire', 'acessoire', 'zgduiqshds', 0, '2026-09-25 15:06:04', '2026-09-25 15:21:40'),
(7, NULL, 'Homme', 'Homme', NULL, 1, '2026-09-25 15:19:56', '2026-09-25 15:19:56'),
(8, NULL, 'Femme', 'Femme', NULL, 1, '2026-09-25 15:20:17', '2026-09-25 15:20:17'),
(9, NULL, 'Enfant', 'Enfant', NULL, 1, '2026-09-25 15:20:35', '2026-09-25 15:20:35'),
(10, 9, 'vetement garçon', 'vetement-garcon', NULL, 0, '2026-09-25 23:50:29', '2026-09-26 17:55:25'),
(11, 9, 'vetement fille', 'vetement-fille', NULL, 0, '2026-09-25 23:51:11', '2026-09-26 17:55:39'),
(13, 7, 'accessoire', 'accessoire', NULL, 0, '2026-09-25 23:53:14', '2026-09-25 23:53:33');

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `adresse` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`id`, `nom`, `prenom`, `telephone`, `email`, `adresse`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'nogaye beye', NULL, NULL, 'nb@gmail.com', NULL, 1, '2026-09-26 15:20:39', '2026-09-26 15:20:39');

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE `commentaire` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `rating` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `product_id`, `user_id`, `rating`, `content`, `created_at`, `updated_at`) VALUES
(7, 23, NULL, 5, 'Conforme à la description et aux photos. Le style streetwear est au rendez-vous et la taille correspond bien. Très bon rapport qualité-prix', '2026-09-26 15:01:01', '2026-09-26 15:01:01'),
(8, 23, NULL, 5, 'Conforme à la description et aux photos. Le style streetwear est au rendez-vous et la taille correspond bien. Très bon rapport qualité-prix', '2026-09-26 15:01:02', '2026-09-26 15:01:02'),
(9, 23, 7, 5, 'Très belle qualité et super style ! La coupe est top et le pantalon tombe super bien. Très satisfait de ma commande', '2026-09-26 15:03:44', '2026-09-26 15:03:44'),
(10, 23, 8, 4, 'Excellent produit ! Le jean est très confortable, la coupe wide leg est exacte et le tissu denim est de très bonne qualité. La taille M me va parfaitement. Livraison très rapide, je recommande vivement !', '2026-09-26 15:05:38', '2026-09-26 15:05:38');

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
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
-- Structure de la table `fournisseurs`
--

CREATE TABLE `fournisseurs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `adresse` text DEFAULT NULL,
  `entreprise` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `jobs`
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
-- Structure de la table `job_batches`
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
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_08_29_185712_add_role_to_users_table', 1),
(5, '2026_08_29_200000_create_categories_table', 1),
(6, '2026_08_29_204852_create_products_table', 1),
(24, '2026_08_29_224818_add_image_to_products_table', 2),
(25, '2026_08_29_231356_create_clients_table', 2),
(26, '2026_08_29_233523_create_sales_table', 2),
(27, '2026_08_29_233526_create_sale_items_table', 2),
(28, '2026_08_30_004130_create_fournisseurs_table', 2),
(29, '2026_08_30_010000_create_stock_movements_table', 2),
(30, '2026_08_30_010430_create_stock_entries_table', 2),
(31, '2026_08_30_010532_create_stock_entry_items_table', 2),
(32, '2026_08_30_214354_create_orders_table', 2),
(33, '2026_08_30_214359_create_order_items_table', 2),
(34, '2026_08_30_232720_create_notifications_table', 2),
(35, '2026_09_04_235312_create_carts_table', 2),
(36, '2026_09_04_235328_create_cart_items_table', 2),
(37, '2026_09_05_005337_change_subtotal_nullable_on_order_items', 2),
(38, '2026_09_05_010948_add_address_and_phone_to_orders_table', 2),
(39, '2026_09_05_011501_add_delivery_fields_to_orders_table', 2),
(40, '2026_09_05_143518_add_user_id_to_sales_table', 2);

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(255) NOT NULL,
  `notifiable_type` varchar(255) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('b861db08-a291-4c04-ac1c-a599f2153611', 'App\\Notifications\\NewOrderNotification', 'App\\Models\\User', 1, '{\"type\":\"new_order\",\"order_id\":1,\"client_nom\":\"nogaye beye\",\"total\":35000,\"message\":\"Nouvelle commande #1 en attente de validation.\"}', NULL, '2026-09-26 15:20:42', '2026-09-26 15:20:42');

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED DEFAULT NULL,
  `total` decimal(12,2) NOT NULL DEFAULT 0.00,
  `payment_method` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `shipping_address` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `orders`
--

INSERT INTO `orders` (`id`, `client_id`, `total`, `payment_method`, `status`, `shipping_address`, `address`, `phone`, `notes`, `created_at`, `updated_at`) VALUES
(1, 1, 35000.00, 'orange_money', 'shipped', 'diourbel, Diourbel', 'diourbel', '762440000', NULL, '2026-09-26 15:20:39', '2026-09-26 18:14:47'),
(2, 1, 24980.00, 'espèces', 'completed', NULL, NULL, NULL, NULL, '2026-09-26 16:22:26', '2026-09-26 16:22:26');

-- --------------------------------------------------------

--
-- Structure de la table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `subtotal`, `created_at`, `updated_at`) VALUES
(1, 2, 11, 1, 8000.00, NULL, '2026-09-26 16:22:26', '2026-09-26 16:22:26'),
(2, 2, 13, 1, 17000.00, NULL, '2026-09-26 16:22:26', '2026-09-26 16:22:26');

-- --------------------------------------------------------

--
-- Structure de la table `paiement`
--

CREATE TABLE `paiement` (
  `id` int(11) NOT NULL,
  `montant` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `image` varchar(255) DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `external_source` varchar(100) DEFAULT NULL,
  `external_ref` varchar(255) DEFAULT NULL,
  `size` varchar(50) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `gender` enum('homme','femme','mixte','enfant') DEFAULT 'mixte',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `stock`, `image`, `category_id`, `external_source`, `external_ref`, `size`, `color`, `gender`, `created_at`, `updated_at`) VALUES
(10, 'Ensemble robe et veste rouge fille', 'Magnifique ensemble 2 pièces rouge pour fille, idéal pour offrir un style chic et élégant. Fabriqué dans un tissu confortable et résistant, parfaitement adapté pour les enfants de 2 ans. Convient aussi bien pour un usage quotidien que pour les événements et sorties spéciales.', 14000.00, 23, '1790380862_6ab70b3ed96c8.jpg', 11, NULL, NULL, '2ans', 'rouge', 'enfant', '2026-09-26 00:00:32', '2026-09-26 16:54:14'),
(11, 'Ensemble chemise et pantalon fille', 'Ensemble 2 pièces pour fille composé d\'une chemise marron et d\'un pantalon assorti blanc à motifs. Conçu en tissu doux et confortable, idéal pour les enfants de 3 ans. Parfait pour un look élégant au quotidien ou lors d\'occasions spéciales.', 8000.00, 48, '1790429715_6ab7ca139dec7.webp', 11, NULL, NULL, '3ans', 'marron blanc', 'enfant', '2026-09-26 13:31:47', '2026-09-26 16:56:43'),
(12, 'Ensemble chemise-veste à carreaux et pantalon garçon', 'Très bel ensemble pour petit garçon composé d\'une veste à carreaux tendance, d\'un haut blanc, d\'un pantalon en jean confortable et d\'un bonnet assorti. Conçu dans une matière douce et chaude, il offre un style moderne et confortable pour les journées fraîches ou les sorties en famille.', 15000.00, 28, '1790430426_6ab7ccda209d1.jpg', 10, NULL, NULL, '4ans', 'Bleu, blanc et noir', 'enfant', '2026-09-26 13:46:25', '2026-09-26 18:42:22'),
(13, 'Costume de cérémonie pour petit garçon', 'Superbe ensemble élégant pour petit garçon comprenant une chemise blanche, un gilet sans manches, un pantalon assorti avec bretelles et un nœud papillon. Un style chic et raffiné, parfait pour les cérémonies, baptêmes, mariages ou événements spéciaux. Conçu dans un tissu doux pour garantir le confort de l\'enfant tout au long de la journée.', 17000.00, 19, '1790430616_6ab7cd9852f94.webp', 10, NULL, NULL, '4ans', 'Marron foncé / Bordeau et blanc', 'enfant', '2026-09-26 13:49:58', '2026-09-26 16:22:26'),
(14, 'Coffret bijoux et montre dorée', 'Sublime coffret d\'accessoires de luxe comprenant une montre élégante au cadran raffiné et des bracelets assortis dorés et argentés. Fabriqué avec une finition soignée et de qualité supérieure, cet ensemble apporte une touche chic et intemporelle à toutes vos tenues. Idéal pour les grandes occasions ou pour offrir un cadeau d\'exception.', 9000.00, 26, '1790430826_6ab7ce6ad556f.webp', 5, NULL, NULL, NULL, 'Doré / Argenté', 'mixte', '2026-09-26 13:53:26', '2026-09-27 00:53:17'),
(15, 'Costume 3 pièces bleu avec cravate garçon', 'Elegant costume complet bleu roi pour garçon, comprenant une veste cintrée, un pantalon assorti et une cravate. Conçu dans un tissu de qualité supérieure qui offre chic et confort. Idéal pour les grandes occasions, mariages, baptêmes, fêtes et cérémonies.', 22000.00, 23, '1790430982_6ab7cf062d5b7.webp', 10, NULL, NULL, '7ans', 'Bleu roi / Bleu marine', 'enfant', '2026-09-26 13:56:03', '2026-09-27 00:59:43'),
(16, 'Robe bleue à volants avec ceinture pour fille', 'Charmante robe bleue pour fille avec encolure à volants et bretelles fines. Accompagnée d\'une jolie ceinture dorée à la taille, elle offre un style léger, élégant et moderne. Conçue dans un tissu fluide et agréable à porter, elle est parfaite pour les journées ensoleillées, les sorties en famille ou les événements spéciaux.', 5000.00, 26, '1790431350_6ab7d07614e0c.jpeg', 11, NULL, NULL, '10ans', 'Bleu roi / Bleu intense', 'enfant', '2026-09-26 14:02:07', '2026-09-26 18:55:31'),
(17, 'Ensemble décontracté t-shirt à capuche bicolore et short garçon', 'Ensemble 2 pièces tendance pour garçon composé d\'un t-shirt bicolore avec capuche et d\'un bas assorti. Conçu dans une matière douce et respirante, cet ensemble offre un style streetwear moderne idéal pour les activités quotidiennes, le sport ou les sorties estivales. Coupes légères et confortables garantissant une excellente liberté de mouvement.', 11000.00, 19, '1790431458_6ab7d0e255e49.webp', 10, NULL, NULL, NULL, 'Noir et gris / Blanc', 'enfant', '2026-09-26 14:03:54', '2026-09-26 14:04:18'),
(18, 'Ensemble chic 3 pièces beige pour femme', 'Très élégant ensemble tailleur 3 pièces pour femme comprenant une veste blazer, un gilet sans manches ajusté et un pantalon taille haute coupe droite. Conçu dans une matière fluide et confortable au tomber impeccable. Cet ensemble offre un look raffiné, moderne et professionnel, idéal pour le travail, les événements formels ou les soirées chics.', 15000.00, 32, '1790431688_6ab7d1c8aae99.jpg', 2, NULL, NULL, 'M', 'Beige / Nude / Rose poudré', 'femme', '2026-09-26 14:07:46', '2026-09-26 14:08:08'),
(19, 'Ensemble jean cargo large et haut manches longues fille', 'Ensemble tendance style streetwear pour fille composé d\'un jean cargo ample à poches plaquées et d\'un haut blanc ajusté à manches longues. Offre un look moderne, décontracté et très confortable au quotidien.', 8000.00, 24, '1790431809_6ab7d24182fc5.jpg', 11, NULL, NULL, '10ans', 'Bleu jean et blanc', 'enfant', '2026-09-26 14:09:48', '2026-09-26 16:57:18'),
(20, 'Sandales élégantes à plateforme et talons aiguilles', 'Élégantes sandales à talons hauts pour femme avec plateforme à l\'avant et bride ajustable à la cheville. Leur design chic et intemporel affine la silhouette tout en assurant un bon maintien. Parfaites pour compléter une tenue de soirée ou une occasion spéciale.', 6000.00, 0, '1790431930_6ab7d2bab2d05.jpg', 2, NULL, NULL, '41', 'Noir', 'femme', '2026-09-26 14:11:43', '2026-09-27 00:58:49'),
(21, 'Veste longue d\'hiver chic marron et blanche', 'Superbe manteau long d\'hiver pour femme en ton marron/camel avec finitions douces et chaleureuses sur le col et les poignets. Coupe élégante et moderne, idéale pour rester au chaud tout en gardant un style raffiné durant la saison froide.', 10000.00, 28, '1790432212_6ab7d3d43f36c.webp', 2, NULL, NULL, 'M/L', 'Marron / Camel et blanc', 'femme', '2026-09-26 14:16:28', '2026-09-26 14:16:52'),
(22, 'Chaussures de ville en cuir Derbies noires homme', 'Élégantes chaussures de ville en cuir noir pour homme, au design classique et épuré. Dotées d\'une fermeture à lacets et d\'une finition brillante soignée, elles offrent un confort optimal et une grande durabilité. Parfaites pour le travail, les réunions professionnelles, les cérémonies et les événements formels.', 12000.00, 4, '1790432334_6ab7d44e192e0.webp', 1, NULL, NULL, '39', 'Noir', 'homme', '2026-09-26 14:18:36', '2026-09-27 01:09:29'),
(23, 'Jean ample style streetwear décontracté femme', 'Jean pour femme à coupe très large (wide leg) et fluide, idéal pour créer un look streetwear chic et tendance. Conçu dans un denim de qualité supérieure offrant confort et liberté de mouvement tout au long de la journée. Se marie parfaitement avec un crop top, un t-shirt ajusté ou un pull tendance.', 6000.00, 14, '1790432467_6ab7d4d3de565.jpg', 2, NULL, NULL, 'M', 'Noir / Gris délavé', 'femme', '2026-09-26 14:20:49', '2026-09-26 15:20:39'),
(24, 'Montre de luxe élégante avec bracelet en cuir femme', 'Superbe montre analogique de luxe pour femme alliant élégance et raffinement. Dotée d\'un cadran soigneusement travaillé et d\'un bracelet confortable, elle apporte une touche sophistiquée à votre poignet. Un accessoire intemporel parfait pour le quotidien comme pour les grandes occasions.', 4000.00, 20, '1790432570_6ab7d53a14973.jpg', 5, NULL, NULL, NULL, 'Marron / Argenté / Doré', 'femme', '2026-09-26 14:22:19', '2026-09-26 14:22:50'),
(25, 'Montre élégante bracelet en cuir et cadran bleu nuit homme', 'Montre de prestige pour homme dotée d\'un cadran bleu profond aux détails dorés et d\'un bracelet en cuir raffiné. Conçue avec un mécanisme de précision et un design masculin affirmé, elle s\'associe idéalement avec un costume ou une tenue chic décontractée', 5000.00, 21, '1790432692_6ab7d5b45bfd4.jpg', 1, NULL, NULL, NULL, 'Bleu marine / Doré / Noir', 'homme', '2026-09-26 14:24:28', '2026-09-26 14:24:52'),
(26, 'Robe longue moulante en maille à manches longues femme', 'Sublime robe longue moulante à manches longues et col dégagé, conçue dans une maille extensible et confortable. Sa coupe près du corps met élégamment en valeur la silhouette tout en offrant une liberté de mouvement optimale. Idéale pour un style chic et décontracté au quotidien ou lors de vos sorties.', 5500.00, 20, '1790433956_6ab7daa4e591d.jpg', 2, NULL, NULL, 'M/L', 'Gris / Noir', 'femme', '2026-09-26 14:45:24', '2026-09-27 01:06:13'),
(27, 'Tenue classique chic homme (Chemise & Pantalon)', 'Ensemble masculin élégant et moderne comprenant une chemise cintrée bleu marine à manches longues et un pantalon ajusté gris clair. Un style classique chic impeccable, idéal pour les rendez-vous professionnels, les événements ou les sorties élégantes. Coupes soigneusement travaillées garantissant confort et allure soignée.', 14000.00, 5, '1790434124_6ab7db4c9a24a.jpg', 1, NULL, NULL, 'XL', 'Bleu marine et gris clair', 'homme', '2026-09-26 14:47:52', '2026-09-27 00:58:16');

-- --------------------------------------------------------

--
-- Structure de la table `remise`
--

CREATE TABLE `remise` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `sales`
--

CREATE TABLE `sales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED DEFAULT NULL,
  `total` decimal(12,2) NOT NULL DEFAULT 0.00,
  `payment_method` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sales`
--

INSERT INTO `sales` (`id`, `user_id`, `client_id`, `total`, `payment_method`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, 14000.00, 'Espèces', '2026-09-26 16:54:14', '2026-09-26 16:54:14'),
(2, NULL, NULL, 8000.00, 'Wave', '2026-09-26 16:56:43', '2026-09-26 16:56:43'),
(3, NULL, NULL, 13000.00, 'Orange Money', '2026-09-26 16:57:18', '2026-09-26 16:57:18'),
(4, NULL, NULL, 15000.00, 'Espèces', '2026-09-26 17:31:22', '2026-09-26 17:31:22'),
(5, NULL, NULL, 12000.00, 'Orange Money', '2026-09-26 17:45:07', '2026-09-26 17:45:07'),
(9, NULL, NULL, 12000.00, 'Espèces', '2026-09-26 19:00:31', '2026-09-26 19:00:31'),
(10, NULL, NULL, 22000.00, 'Espèces', '2026-09-26 19:11:57', '2026-09-26 19:11:57');

-- --------------------------------------------------------

--
-- Structure de la table `sale_items`
--

CREATE TABLE `sale_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sale_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `subtotal` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `sessions`
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
-- Déchargement des données de la table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('8DyGf1wtB3YgUuo6SG7yWMYSIjVsgjngYuJGELQg', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiN0hjZnJBck5qZXhXMDlLdml6eWtNejJRRkl2N3VyeHo4T0lURnd4OCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1790472111),
('gFgPGQ95zalogiFEpotX57bwaLd5glxE5Stkqn7j', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZUNOcTR3NEJTelZkZW9mSnpad1hZY3E2QmVWN1hVRlc4OGpGMDNpTCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9zdG9jayI7czo1OiJyb3V0ZSI7czoxNzoiYWRtaW4uc3RvY2suaW5kZXgiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1790472676);

-- --------------------------------------------------------

--
-- Structure de la table `stock_entries`
--

CREATE TABLE `stock_entries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fournisseur_id` bigint(20) UNSIGNED DEFAULT NULL,
  `total` decimal(12,2) NOT NULL DEFAULT 0.00,
  `observation` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `stock_entry_items`
--

CREATE TABLE `stock_entry_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `stock_entry_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `purchase_price` decimal(12,2) NOT NULL,
  `subtotal` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `stock_movements`
--

CREATE TABLE `stock_movements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `reference` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'client'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'admin', 'n@gmail.com', NULL, '$2y$12$jXzSlEWPOugJAF6BY9Ri3.6Nfr1y2VTZTK3Bp1dDGtfDdPPlnanIK', NULL, '2026-09-15 22:23:59', '2026-09-15 22:23:59', 'admin'),
(2, 'fatou', 'f@gmail.com', NULL, '$2y$12$HWYR5YH.FupghjVJjMLkKOrfUx/iMgBzoCZGgQs4AoQ0dnipWJpZ6', NULL, '2026-09-16 19:38:44', '2026-09-16 19:38:44', 'client'),
(3, 'iba beye', 'i@gmail.com', NULL, '$2y$12$1qyBtNNLHmIQrPdYP4BBFu6yXDleDPpfcWNKhoKY9auqwXnzqNgmi', NULL, '2026-09-16 20:29:26', '2026-09-16 20:29:26', 'cashier'),
(4, 'coumba', 'c@gmail.com', NULL, '$2y$12$bo0jIkvE58FVJMlhE2NpgeieE3nKcgctQPCVSJYWQ60y1uTb.aM/W', NULL, '2026-09-16 21:23:41', '2026-09-16 21:23:41', 'magasinier'),
(5, 'papa', 'p@gmail.com', NULL, '$2y$12$97kADsi4d5XS04TV2MPeMeIzLnfL3BYvTvCMFJ.HYFWBoJ.vkYuMq', NULL, '2026-09-16 21:54:02', '2026-09-16 21:54:02', 'client'),
(6, 'coumba', 'c1@gmail.com', NULL, '$2y$12$vU/fuZmzCaL1WSBYyyUYR.bpNgCoNparZHjte2DDymkzTfMI3Gnrq', NULL, '2026-09-21 18:14:56', '2026-09-21 18:14:56', 'client'),
(7, 'nogaye beye', 'nb@gmail.com', NULL, '$2y$12$aOIcqUjWoMQJOZsp4c5Qfu0BmpgY/hM1mfdNx20BgzdN5EwOWQcC.', NULL, '2026-09-26 15:02:53', '2026-09-26 15:02:53', 'client'),
(8, 'ndeye', 'b@gmail.com', NULL, '$2y$12$M/ERq2WrKalkG.J2hJglV.EQf090lqGILgZ2brVq9BUtGKS9IjBVe', NULL, '2026-09-26 15:04:37', '2026-09-26 15:04:37', 'client'),
(9, 'coumba', 'co@gmail.com', NULL, '$2y$12$W/0W25zSBoujvsIWj42lYeyxH72w9wyrLneaMJvbRvW3IGTNkeV8e', NULL, '2026-09-26 15:25:09', '2026-09-26 15:25:09', 'client'),
(10, 'coumba', 'ca@gmail.com', NULL, '$2y$12$MOKAOYLT6eclOIY4mTzfjOXjjv9JAYdYXMfq2myoZ3d6dzMCpFI2i', NULL, '2026-09-26 15:27:36', '2026-09-26 15:27:36', 'caissier'),
(11, 'talla', 't@gmail.com', NULL, '$2y$12$4RHrYbdxOjjPiYIpirZuj.a09Vt0BmaImS/F0xOuAIRQt5E/sk22e', NULL, '2026-09-27 00:38:20', '2026-09-27 00:38:20', 'magasinier');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Index pour la table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Index pour la table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`),
  ADD KEY `carts_product_id_foreign` (`product_id`);

--
-- Index pour la table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `fournisseurs`
--
ALTER TABLE `fournisseurs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Index pour la table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Index pour la table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_client_id_foreign` (`client_id`);

--
-- Index pour la table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Index pour la table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Index pour la table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Index pour la table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sales_client_id_foreign` (`client_id`),
  ADD KEY `sales_user_id_foreign` (`user_id`);

--
-- Index pour la table `sale_items`
--
ALTER TABLE `sale_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_items_sale_id_foreign` (`sale_id`),
  ADD KEY `sale_items_product_id_foreign` (`product_id`);

--
-- Index pour la table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Index pour la table `stock_entries`
--
ALTER TABLE `stock_entries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stock_entries_fournisseur_id_foreign` (`fournisseur_id`);

--
-- Index pour la table `stock_entry_items`
--
ALTER TABLE `stock_entry_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stock_entry_items_stock_entry_id_foreign` (`stock_entry_id`),
  ADD KEY `stock_entry_items_product_id_foreign` (`product_id`);

--
-- Index pour la table `stock_movements`
--
ALTER TABLE `stock_movements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stock_movements_product_id_foreign` (`product_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `fournisseurs`
--
ALTER TABLE `fournisseurs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT pour la table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `sale_items`
--
ALTER TABLE `sale_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `stock_entries`
--
ALTER TABLE `stock_entries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `stock_entry_items`
--
ALTER TABLE `stock_entry_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `stock_movements`
--
ALTER TABLE `stock_movements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `sales_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `sale_items`
--
ALTER TABLE `sale_items`
  ADD CONSTRAINT `sale_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sale_items_sale_id_foreign` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `stock_entries`
--
ALTER TABLE `stock_entries`
  ADD CONSTRAINT `stock_entries_fournisseur_id_foreign` FOREIGN KEY (`fournisseur_id`) REFERENCES `fournisseurs` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `stock_entry_items`
--
ALTER TABLE `stock_entry_items`
  ADD CONSTRAINT `stock_entry_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stock_entry_items_stock_entry_id_foreign` FOREIGN KEY (`stock_entry_id`) REFERENCES `stock_entries` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `stock_movements`
--
ALTER TABLE `stock_movements`
  ADD CONSTRAINT `stock_movements_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
