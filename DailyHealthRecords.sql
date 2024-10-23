-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 25, 2024 at 01:26 AM
-- Server version: 8.0.36
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myHealthyData`
--

-- --------------------------------------------------------

--
-- Table structure for table `DailyHealthRecords`
--

CREATE TABLE `DailyHealthRecords` (
  `record_date` date NOT NULL,
  `blood_glucose_level` decimal(5,2) NOT NULL,
  `blood_pressure` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `weight_kg` decimal(5,2) NOT NULL,
  `exercise_duration_minutes` int NOT NULL,
  `dietary_intake` text COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `DailyHealthRecords`
--

INSERT INTO `DailyHealthRecords` (`record_date`, `blood_glucose_level`, `blood_pressure`, `weight_kg`, `exercise_duration_minutes`, `dietary_intake`) VALUES
('2024-05-01', 110.50, '120/80', 70.50, 30, 'oatmeal, salad, chicken and vegetables'),
('2024-05-02', 108.00, '118/78', 70.30, 45, 'smoothie, sandwich, pasta'),
('2024-05-03', 112.00, '121/81', 70.60, 60, 'cereal, soup, fish and rice'),
('2024-05-04', 107.50, '119/79', 70.40, 30, 'eggs, salad, steak and vegetables'),
('2024-05-05', 105.20, '117/76', 70.20, 60, 'toast, sushi, chicken and potatoes'),
('2024-05-06', 109.00, '120/80', 70.50, 20, 'bagel, burger, pizza'),
('2024-05-07', 106.80, '116/77', 70.30, 60, 'fruit, salad, salmon and quinoa'),
('2024-06-23', 185.00, '138/85', 70.00, 10, 'Breakfast: Yogurt, strawberries; Lunch: Roasted beef slices, mung bean soup; Dinner: Chicken salad, whole wheat crackers.'),
('2024-06-25', 170.00, '142/90', 72.00, 21, 'Breakfast: Boiled eggs, whole wheat bread; Lunch: Veggie pizza, salad; Dinner: Grilled tofu, mixed vegetable fried rice.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `DailyHealthRecords`
--
ALTER TABLE `DailyHealthRecords`
  ADD PRIMARY KEY (`record_date`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
