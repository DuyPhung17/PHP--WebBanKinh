-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 07, 2020 at 04:49 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_bankinh`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `username` varchar(50) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `password` varchar(50) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `admin` bit(1) DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `image` varchar(50) COLLATE utf8_vietnamese_ci DEFAULT 'avatar.png',
  `email` varchar(50) COLLATE utf8_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `name`, `username`, `password`, `admin`, `phone`, `address`, `image`, `email`) VALUES
(1, 'Phùng Bá Duy', 'duy', '123', b'1', '0986858382', '14 Ngọc Thảo, Nha Trang', 'panda.png', 'duyphung@gmail.com'),
(2, 'Nguyễn Xuân Huy', 'huy', '123', NULL, '0916858382', 'Ninh Thuận', 'avatar.png', 'springhuy@gmail.com'),
(3, 'Diệp Túy Dũng', 'dung', '123', NULL, '0913320382', 'Cam Ranh', 'avatar.png', 'dunglu@gmail.com'),
(4, 'Nguyễn Ngọc Hoàng', 'hoang', '123', NULL, '0913320382', 'Phú Yên', 'avatar.png', 'hoangdiem@gmail.com'),
(5, 'Vũ Ngọc Đoàn', 'doan', '123', NULL, '01625320382', 'Nha Trang', 'avatar.png', 'doanmelodit@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_customer` int(11) DEFAULT NULL,
  `date_order` date DEFAULT NULL,
  `total` float DEFAULT NULL COMMENT 'tổng tiền',
  `payment` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'hình thức thanh toán',
  `note` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`id`, `id_customer`, `date_order`, `total`, `payment`, `note`, `created_at`, `updated_at`) VALUES
(14, 14, '2017-03-23', 160000, 'COD', 'k', '2017-03-23 04:46:05', '2017-03-23 04:46:05'),
(13, 13, '2017-03-21', 400000, 'ATM', 'Vui lòng giao hàng trước 5h', '2017-03-21 07:29:31', '2017-03-21 07:29:31'),
(12, 12, '2017-03-21', 520000, 'COD', 'Vui lòng chuyển đúng hạn', '2017-03-21 07:20:07', '2017-03-21 07:20:07'),
(11, 11, '2017-03-21', 420000, 'COD', 'không chú', '2017-03-21 07:16:09', '2017-03-21 07:16:09'),
(15, 15, '2017-03-24', 220000, 'COD', 'e', '2017-03-24 07:14:32', '2017-03-24 07:14:32');

-- --------------------------------------------------------

--
-- Table structure for table `bill_detail`
--

CREATE TABLE `bill_detail` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_bill` int(10) NOT NULL,
  `id_product` int(10) NOT NULL,
  `quantity` int(11) NOT NULL COMMENT 'số lượng',
  `unit_price` double NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bill_detail`
--

INSERT INTO `bill_detail` (`id`, `id_bill`, `id_product`, `quantity`, `unit_price`, `created_at`, `updated_at`) VALUES
(18, 15, 62, 5, 220000, '2017-03-24 07:14:32', '2017-03-24 07:14:32'),
(17, 14, 2, 1, 160000, '2017-03-23 04:46:05', '2017-03-23 04:46:05'),
(16, 13, 60, 1, 200000, '2017-03-21 07:29:31', '2017-03-21 07:29:31'),
(15, 13, 59, 1, 200000, '2017-03-21 07:29:31', '2017-03-21 07:29:31'),
(14, 12, 60, 2, 200000, '2017-03-21 07:20:07', '2017-03-21 07:20:07'),
(13, 12, 61, 1, 120000, '2017-03-21 07:20:07', '2017-03-21 07:20:07'),
(12, 11, 61, 1, 120000, '2017-03-21 07:16:09', '2017-03-21 07:16:09'),
(11, 11, 57, 2, 150000, '2017-03-21 07:16:09', '2017-03-21 07:16:09');

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `image` varchar(100) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `country` varchar(50) COLLATE utf8_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `name`, `image`, `country`) VALUES
(1, 'Coach', 'coach.png', 'Mỹ'),
(2, 'Dolce & Gabbana', 'd&g.png', 'Ý'),
(3, 'Fendi', 'fendi.png', 'Ý'),
(4, 'Maui Jim', 'mauijim.png', 'Mỹ'),
(5, 'Oakley', 'oakley.png', 'Mỹ'),
(6, 'Prada', 'prada.png', 'Ý'),
(7, 'Ray-Ban', 'rayban.png', 'Mỹ'),
(8, 'Saint Laurent', 'saint.png', 'Pháp'),
(9, 'Tory Burch', 'tory.png', 'Mỹ'),
(10, 'Versace', 'versace.png', 'Ý');

-- --------------------------------------------------------

--
-- Table structure for table `glasses`
--

CREATE TABLE `glasses` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `id_brand` int(11) DEFAULT NULL,
  `image` varchar(100) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `normal_price` int(11) DEFAULT NULL,
  `sale_price` int(20) DEFAULT NULL,
  `rating` smallint(11) DEFAULT 4,
  `new` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `glasses`
--

INSERT INTO `glasses` (`id`, `name`, `id_brand`, `image`, `normal_price`, `sale_price`, `rating`, `new`) VALUES
(1, 'Fendi FF011', 3, 'fendi1.png', 3246000, NULL, 4, b'1'),
(2, 'Fendi FF021', 3, 'fendi2.png', 3546000, 3326000, 4, NULL),
(5, 'Fendi Orchidea', 3, 'fendi3.png', 4820000, 4690000, 5, NULL),
(6, 'Fendi F08', 3, 'fendi4.png', 3286000, NULL, 3, NULL),
(7, 'Fendi FF132', 3, 'fendi5.png', 3501000, NULL, 4, NULL),
(8, 'Fendi FF026', 3, 'fendi6.png', 3747000, 3682000, 4, NULL),
(9, 'Fendi FFM30', 3, 'fendi7.png', 4880000, NULL, 5, NULL),
(10, 'Fendi FFM70', 3, 'fendi8.png', 4106000, NULL, 5, NULL),
(11, 'Coach Fanny', 1, 'Coach1.png', 4230000, NULL, 3, NULL),
(12, 'Coach LH023', 1, 'Coach2.png', 2737000, NULL, 4, b'1'),
(13, 'Coach LH091', 1, 'Coach3.png', 3024000, 2920000, 3, NULL),
(14, 'Coach LH037', 1, 'Coach4.png', 2667000, NULL, 4, NULL),
(15, 'Coach LH044', 1, 'Coach5.png', 2449000, 2038000, 4, NULL),
(16, 'D&G DG441', 2, 'd&g1.png', 5124000, NULL, 5, NULL),
(17, 'D&G DG441', 2, 'd&g2.png', 3747000, NULL, 5, b'1'),
(18, 'D&G DG356', 2, 'd&g3.png', 6280000, NULL, 5, NULL),
(19, 'D&G DG441', 2, 'd&g4.png', 7124000, NULL, 5, NULL),
(20, 'D&G DG441', 2, 'd&g5.png', 6737000, NULL, 5, NULL),
(21, 'Oakley FLAX04', 5, 'Oakley1.png', 3064000, NULL, 4, NULL),
(22, 'Oakley FLAX03', 5, 'Oakley2.png', 3577000, NULL, 5, b'1'),
(23, 'Oakley FLAX06', 5, 'Oakley3.png', 3923000, NULL, 4, NULL),
(24, 'Oakley Jacket', 5, 'Oakley4.png', 3308000, 3268000, 4, NULL),
(25, 'Oakley FLAX35', 5, 'Oakley5.png', 5130000, NULL, 5, NULL),
(26, 'MJ Hikina', 4, 'Maui_jim1.png', 5394000, NULL, 5, NULL),
(27, 'MJ Arch', 4, 'Maui_jim2.png', 6037000, NULL, 5, b'1'),
(28, 'MJ Pokawai', 4, 'Maui_jim3.png', 5286000, NULL, 4, NULL),
(29, 'MJ Redsand', 4, 'Maui_jim4.png', 5436000, NULL, 5, NULL),
(30, 'MJ Sitowa', 4, 'Maui_jim5.png', 5336000, NULL, 4, NULL),
(31, 'MJ Kaupo', 4, 'Maui_jim6.png', 5501000, NULL, 5, b'1'),
(32, 'MJ Pokawai', 4, 'Maui_jim7.png', 5286000, NULL, 4, NULL),
(33, 'MJ Redsand', 4, 'Maui_jim8.png', 5436000, NULL, 5, NULL),
(34, 'MJ Swell', 4, 'Maui_jim9.png', 4836000, NULL, 5, NULL),
(35, 'MJ Byron', 4, 'Maui_jim10.png', 5063000, NULL, 4, NULL),
(36, 'Prada Monorch', 6, 'Prada1.png', 7940000, 6760000, 5, NULL),
(37, 'Prada Decode', 6, 'Prada2.png', 7730000, NULL, 5, NULL),
(38, 'Prada P3001', 6, 'Prada3.png', 6580000, NULL, 5, NULL),
(39, 'Prada P3008', 6, 'Prada4.png', 6637000, NULL, 5, NULL),
(40, 'Prada P3010', 6, 'Prada5.png', 6780000, NULL, 5, b'1'),
(41, 'Prada P3011', 6, 'Prada6.png', 6407000, NULL, 5, NULL),
(42, 'Prada P3015', 6, 'Prada7.png', 6780000, NULL, 5, NULL),
(43, 'Prada P3018', 6, 'Prada8.png', 6811000, NULL, 5, NULL),
(44, 'Ray-Ban OB4', 7, 'ray1.png', 2673000, 2289000, 3, NULL),
(45, 'Ray-Ban OBN', 7, 'ray2.png', 3173000, NULL, 4, NULL),
(46, 'Ray-Ban Club', 7, 'ray3.png', 3702000, NULL, 3, NULL),
(47, 'Ray-Ban Club-M', 7, 'ray4.png', 4306000, NULL, 4, NULL),
(48, 'Ray-Ban OBM', 7, 'ray5.png', 2673000, NULL, 3, NULL),
(49, 'Ray-Ban Aviat', 7, 'ray6.png', 5473000, NULL, 4, NULL),
(50, 'Ray-Ban Aviat2', 7, 'ray7.png', 3702000, NULL, 5, NULL),
(51, 'Ray-Ban Aviat3', 7, 'ray8.png', 4306000, 4103000, 5, NULL),
(52, 'Ray-Ban Aviat4', 7, 'ray9.png', 3702000, NULL, 3, NULL),
(53, 'Ray-Ban Aviat5', 7, 'ray10.png', 7113000, NULL, 5, NULL),
(54, 'Ray-Ban Justin', 7, 'ray11.png', 6883000, NULL, 5, b'1'),
(55, 'Ray-Ban Leo', 7, 'ray12.png', 7213000, NULL, 5, NULL),
(56, 'Ray-Ban Eric', 7, 'ray13.png', 6683000, NULL, 5, NULL),
(57, 'Ray-Ban Marsh', 7, 'ray14.png', 6891000, NULL, 5, NULL),
(58, 'YSL SL291', 8, 'Saint1.png', 8240000, NULL, 5, b'1'),
(59, 'YSL SL383', 8, 'Saint2.png', 8360000, NULL, 5, NULL),
(60, 'YSL SL294', 8, 'Saint3.png', 8110000, NULL, 5, NULL),
(61, 'YSL SL319', 8, 'Saint4.png', 8500000, NULL, 5, NULL),
(62, 'YSL SL110', 8, 'Saint5.png', 8470000, NULL, 5, NULL),
(63, 'Tory TY711', 9, 'Tory1.png', 3306000, 3126000, 4, NULL),
(64, 'Tory TY844', 9, 'Tory2.png', 3712000, NULL, 4, NULL),
(65, 'Tory TY722', 9, 'Tory3.png', 3545000, NULL, 4, NULL),
(66, 'Tory TY769', 9, 'Tory4.png', 3540000, NULL, 4, NULL),
(67, 'Tory TY730', 9, 'Tory5.png', 3622000, NULL, 4, b'1'),
(68, 'Versace VE029', 10, 'versace1.png', 6114000, NULL, 5, NULL),
(69, 'Versace VE031', 10, 'versace2.png', 6224000, NULL, 5, NULL),
(70, 'Versace VE004', 10, 'versace3.png', 7372000, NULL, 5, NULL),
(71, 'Versace VE214', 10, 'versace4.png', 7190000, NULL, 5, NULL),
(72, 'Versace VE184', 10, 'versace5.png', 7328000, 7028000, 5, NULL),
(73, 'Versace VE019', 10, 'versace6.png', 8322000, 8238000, 5, NULL),
(74, 'Versace VE082', 10, 'versace7.png', 7765000, NULL, 5, NULL),
(75, 'Versace VE084', 10, 'versace8.png', 7620000, NULL, 5, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bills_ibfk_1` (`id_customer`);

--
-- Indexes for table `bill_detail`
--
ALTER TABLE `bill_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bill_detail_ibfk_2` (`id_product`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `glasses`
--
ALTER TABLE `glasses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `glasses_ibfk_1` (`id_brand`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `bill_detail`
--
ALTER TABLE `bill_detail`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `glasses`
--
ALTER TABLE `glasses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `glasses`
--
ALTER TABLE `glasses`
  ADD CONSTRAINT `glasses_ibfk_1` FOREIGN KEY (`id_brand`) REFERENCES `brand` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
