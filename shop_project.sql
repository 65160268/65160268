-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2024 at 09:43 PM
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
-- Database: `shop_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL COMMENT 'รหัสหมวดหมู่',
  `category_name` varchar(100) NOT NULL COMMENT 'ชื่อหมวดหมู่'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(1, 'แฟชั่น'),
(2, 'อิเล็กทรอนิก'),
(3, 'ความสะดวกสบาย');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(10) NOT NULL COMMENT 'รหัสสินค้า',
  `product_name` varchar(100) NOT NULL COMMENT 'ชื่อสินค้า',
  `product_description` varchar(100) NOT NULL COMMENT 'คำอธิบายสินค้า',
  `product_price` decimal(10,2) NOT NULL COMMENT 'ราคาสินค้า',
  `product_group` int(50) NOT NULL COMMENT 'กลุ่มสินค้า',
  `product_img` varchar(100) NOT NULL COMMENT 'รูปภาพสินค้า'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_description`, `product_price`, `product_group`, `product_img`) VALUES
(1, 'นาฬิกา', 'นาฬิกาเงินของ Kasoi สีเงินรุ่น Limited', 5000.00, 1, 'Watch1.jpg'),
(2, 'เสื้อยืดคอมกลม', 'เสื้อยืดคอกลมของ Maiyued ไซส์ L ', 6000.00, 1, 'Clothes1.jpg'),
(3, 'หูฟังรุ่น Razor Draken 7.1', 'หูฟังเกมมิ่งเกียร์สำหรับเล่นเกมโดยเฉพาะ ด้วยระบบเสียงสุดทันสมัย 7.1 suround', 7000.00, 2, 'Headphones1.jpg'),
(4, 'กล้องถ่ายรูป Kanon M3000 ', 'กล้องถ่ายรูปของ Kanon M3000 รองตัวท็อป', 8000.00, 2, 'Camera1.jpg'),
(5, 'PC ประกอบพร้อมเล่น(อุปกรณ์มืองสอง)', 'สเปคเล่นเกมลื่นๆ \r\nCPU:I3 7000F\r\nGPU:FTX 760\r\nRAM: 4GB\r\nHDD: 120GB', 9000.00, 2, 'Pc1.jpg'),
(6, 'แก้วน้ำเก็บความเย็น Maiyen', 'แก้วน้ำเก็บอุณภูมิที่เก็บนานได้สูงสุด 24 ชม.', 3000.00, 3, 'Stanley1.jpg'),
(7, 'ลำโพง Marshell รุ่นเก่าแต่เก๋า', 'ลำโพง Marshell เชื่อมต่อไร้สายผ่าน Bluetooth 5.0 สำหรับกับสมาร์ทโฟนหรือแท็บเล็ตแบตเตอรี่ใช้งานได้ประ', 9900.00, 2, 'Marshell1.jpg'),
(8, 'ไฟฉายส่องกบสุดแรง', 'ไฟฉายหากบที่สามารถส่งได้ทุกหนแห่ง ส่องได้ไกลที่สุด 30 กม.', 2500.00, 3, 'Flashlight1.jpg'),
(9, 'ทีวี 99 นิ้ว จอ Super OLED', 'ทีวีขนาด 99 นิ้วสุดใหญ่ ดูตาแตกเพราะสีสดเหมือนจริง', 15000.00, 2, 'TV1.jpg'),
(10, 'เครื่องฟอกอากาศ Maisaart ฟอกได้ถึง 99.99%', 'เครื่องฟอกอากาศ Maisaart สามารถฟอกอากาศได้ถึง 99.99%', 5500.00, 3, 'xiaomi1.jpg'),
(13, 'ที่นอนแมว', 'ที่นอนสำหรับน้องแมว', 3500.00, 3, 'Catbed.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_phone` varchar(15) NOT NULL,
  `user_group` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `user_pass`, `user_email`, `user_phone`, `user_group`) VALUES
(5, 'admin', '$2y$10$C6l9rehCr353cSbKuExyr.2s3zNIhw.tlkvll/t.HloEyll3R8uMy', 'admin@gmail.com', '-', 'seller'),
(6, 'user', '$2y$10$9.KnRbJL73jJ3xhJ4yvc8eHyCucI4ZJKTQ2MB5juR1./Zsa8f12.O', 'asd@gmail.com', '-', 'buyer'),
(7, 'sell', '$2y$10$Tr/aLQ4Ul6L3ah0Cq.jxq.XIo3hjC.yNRMHUWH1vSH8VLD98JbUeC', 'asd@gmail.com', '-', 'seller'),
(10, '65160022', '$2y$10$aWQPg5GHt3x51axIqNGwyeoBEiyEUkN4f12y95pkWCcjGkMObbXrq', '65160022@go.buu.ac.th', '65160022', 'seller'),
(11, '65160268', '$2y$10$BiesNz1LLDfVOHwKhyp0W.dQJuoAP4mLj5D6XoWGCH/QI6uNA9516', '65160268@go.buu.ac.th', '65160268', 'buyer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `product_group` (`product_group`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสหมวดหมู่', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'รหัสสินค้า', AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`product_group`) REFERENCES `category` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
