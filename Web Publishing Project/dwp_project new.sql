-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2024 at 08:08 AM
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
-- Database: `dwp_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_register`
--

CREATE TABLE `admin_register` (
  `admin_id` varchar(6) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `admin_phone` varchar(15) DEFAULT NULL,
  `admin_birthday` date DEFAULT NULL,
  `admin_email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_register`
--

INSERT INTO `admin_register` (`admin_id`, `admin_password`, `admin_name`, `admin_phone`, `admin_birthday`, `admin_email`) VALUES
('ADM1d8', 'panzhixin0729', 'Pan Zhi Xin', '0194104101', '2005-07-07', 'panzhixin@gmail.com'),
('ADM7ae', 'lawrence0429', 'Lawrence Miguel Tan Qi Yuan  ', '0173123123', '2005-04-29', 'lawrence@gmail.com'),
('ADMae3', 'loyyuxuan0219', 'Loy Yu Xuan', '0197657456', '2005-02-19', 'loyyuxuan@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `booklist`
--

CREATE TABLE `booklist` (
  `BookID` int(4) NOT NULL,
  `Book_Name` varchar(255) DEFAULT NULL,
  `Price` decimal(5,2) NOT NULL,
  `Author` varchar(255) DEFAULT NULL,
  `Publisher` varchar(255) DEFAULT NULL,
  `Synopsis` varchar(255) DEFAULT NULL,
  `BookIMG` varchar(255) NOT NULL,
  `Category` varchar(255) DEFAULT 'BookType'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booklist`
--

INSERT INTO `booklist` (`BookID`, `Book_Name`, `Price`, `Author`, `Publisher`, `Synopsis`, `BookIMG`, `Category`) VALUES
(1, 'Flippy The Silly Little Fish', 12.00, 'Noah Grantt', 'Dream Publisher', 'Flippy is a silly little fish that got separated from his family due to a strong undercurrent. To reunite with his family, he embarked on a solo journey. Along the way, he encountered various ocean residents, including a shark who loves planting coral.', 'Flippy The Silly Little Fish.png', 'Picture Book'),
(2, 'That Thing Under My Bed', 15.00, 'William Colin', 'Dream Publisher', 'As a good kid, I always hit the sack right after giving my Mon and Dad a goodnight kiss at 10p.m. However, I just can\'t sleep, not this night. There\'s something under my bed. I know it, I heard its claw scratching the floor, its tail swinging at the bed.', 'That Thing Under My Bed.png', 'Picture Book'),
(3, 'Me and My Pet Dinosaur', 10.00, 'Julie May', 'Candy Publisher', 'I go to bed early. I eat my vegetable. I do all my homework. I say thank you to anyone who helps. I look like a normal kid. I look like a good kid. I look like I have nothing to hide. However, I do... \"RAWR!\" Oh! It\'s the dinosaur.', 'Me and My Pet Dinosaur.png', 'Picture Book'),
(4, 'Children of The Star', 20.00, 'Stella Drew', 'Star Publisher', 'Star light, star bright; Like a diamond in the sky. I wish I may, I wish I might; Dear children of star please don\'t cry. Legend says that every 1000 years, hundreds of purple light will shoot across Earth.', 'Children of The Star.png', 'Novel'),
(5, 'Twins', 22.00, 'Sherlin. K', 'Star Publisher', 'There\'s someone else around me since I was a child. I never saw her, I just know her. Another sentence written in Laura\'s diary. It might be weird, but Laura\'s not lying, she can tell that there is another existence hovering around her when she feels it.', 'Twins.png', 'Novel'),
(6, 'My Mind is A Mess', 36.00, 'Yicell L. Y. Xyan', 'Hope Publisher', 'What did you just say? Second place? Again? \"Yes, I\'m sorry\" \"Oh, don\'t worry. I\'m not mad, just disappointed. Go back to your room. Your tuition session will be intensified starting from tomorrow.\" Carol went back to her bedroom.', 'My Mind is A Mess.png', 'Novel'),
(7, '100 Ways To Bake', 40.00, 'Law Ryance', 'Life Publisher', 'Welcome to The Art of Bakery, a delightful journey through the heart and soul of baking. This recipe book is inspired by the quaint, charming town of Oakwood and the beloved bakery, “Heavenly Bites,” where tradition meets innovation in every bite.', '100 Ways To Bake.png', 'Guide Book'),
(8, 'Knit It', 48.00, 'Panzy Syin', 'Life Publisher', 'Knitting is never easy at the starting line. I can swear that I once saw a guy knitted a pile of thread with a thread. As silly as it can be! But fear not, as a professional knitter who have 10 million subscribers on my YouTube channel, I proudly present.', 'Knit It.png', 'Guide Book'),
(9, 'Cook Like A Pro', 70.00, 'Lethew Jean', 'Life Publisher', 'Are you ready to embark on a culinary adventure that will fill your home with the tantalizing aromas of freshly baked bread, pastries, and cakes? Cook Like A Pro is your ultimate guide to mastering the art of baking, whether you\'re a novice or a seasoned ', 'Cook Like A Pro.png', 'Guide Book'),
(10, 'Know Your Plants', 50.00, 'Wong Shelly', 'Life Publisher', 'Dive into the enchanting world of gardening with our guidebook, Know Your Plants. Bursting with innovative techniques, creative strategies, and seasoned advice, this book is your passport to cultivating a thriving oasis right in your backyard.', 'Know Your Plants.png', 'Guide Book');

-- --------------------------------------------------------

--
-- Table structure for table `book_category`
--

CREATE TABLE `book_category` (
  `CategoryID` int(5) NOT NULL,
  `CategoryName` varchar(255) NOT NULL,
  `Total_book` int(11) NOT NULL,
  `AddedDate` date DEFAULT NULL,
  `Category_Description` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book_category`
--

INSERT INTO `book_category` (`CategoryID`, `CategoryName`, `Total_book`, `AddedDate`, `Category_Description`) VALUES
(1, 'Picture Book', 3, '2024-01-01', 'Teaching a toddler is a challenge, since the wisest sentence coming out from a toddler’s mouth is either “Gugugaga” or “Gagageegee”. But fear not, a picture book with colourful illustrations and basic vocabulary is all you need! Let them become Einstein from a young age!'),
(2, 'Novel', 3, '2024-01-01', 'Imagine diving into the world of a novel. It\'s like embarking on an epic adventure without ever leaving your chair. Whether you\'re uncovering secrets in a mystery, exploring distant galaxies in sci-fi, or falling in love in a romance, a novel lets your mind explore endless possibilities.'),
(3, 'Guide Book', 4, '2024-01-01', 'When it comes to mastering a new skill or hobby, nothing beats a guidebook. Think of it as your personal mentor, patiently walking you through each step with clear instructions and helpful tips. Whether you\'re looking to cook gourmet meals, build a birdhouse, or start a garden, a guidebook provides you with the knowledge and confidence to succeed.');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `CartID` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `BookIMG` varchar(255) DEFAULT NULL,
  `Book_Name` varchar(255) DEFAULT NULL,
  `Price` decimal(10,2) DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `Category` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_record`
--

CREATE TABLE `contact_record` (
  `ContactID` int(4) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Contact_Number` int(12) NOT NULL,
  `UserEmail` varchar(255) NOT NULL,
  `Message` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_record`
--

INSERT INTO `contact_record` (`ContactID`, `Username`, `Contact_Number`, `UserEmail`, `Message`) VALUES
(1, 'Gatito Gitty', 170010111, 'gatito@gmail.com', 'Function of this webpage design is not suitable for me but I like the color palette of this webpage shows'),
(2, 'Celine Kong Lee Ching', 1187152435, 'celine@gmail.com', 'ok');

-- --------------------------------------------------------

--
-- Table structure for table `dashboard`
--

CREATE TABLE `dashboard` (
  `total_sales` decimal(10,2) DEFAULT NULL,
  `total_orders` int(11) DEFAULT NULL,
  `total_rate` int(11) DEFAULT NULL,
  `total_comments` int(11) DEFAULT NULL,
  `total_Order_of_each_Category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `order_date` date DEFAULT curdate(),
  `Book_Name` varchar(255) DEFAULT NULL,
  `Price` decimal(10,2) DEFAULT NULL,
  `receiver_name` varchar(30) DEFAULT NULL,
  `receiver_email` varchar(50) DEFAULT NULL,
  `Category` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `username`, `email`, `order_date`, `Book_Name`, `Price`, `receiver_name`, `receiver_email`, `Category`) VALUES
(1, 3, 'Lim Siew Jin', 'lim@gmail.com', '2024-06-30', 'Flippy The Silly Little Fish', 12.00, 'Lim Siew Jin', 'lim@gmail.com', 'Picture Book'),
(2, 3, 'Lim Siew Jin', 'lim@gmail.com', '2024-06-30', 'Me and My Pet Dinosaur', 10.00, 'Lim Siew Jin', 'lim@gmail.com', 'Picture Book'),
(3, 1, 'Kong Lee Ching', 'celine@gmail.com', '2024-05-31', 'Me and My Pet Dinosaur', 10.00, 'Kong Lee Ching', 'celine@gmail.com', 'Picture Book'),
(4, 1, 'Kong Lee Ching', 'celine@gmail.com', '2024-07-02', 'That Thing Under My Bed', 15.00, 'Kong Lee Ching', 'celine@gmail.com', 'Picture Book'),
(5, 1, 'Kong Lee Ching', 'celine@gmail.com', '2024-07-02', 'Twins', 22.00, 'Kong Lee Ching', 'celine@gmail.com', 'Novel'),
(6, 2, 'Wong Xuan Ting', 'wong@gmail.com', '2024-07-02', 'Me and My Pet Dinosaur', 10.00, 'Wong Xuan Ting', 'wong@gmail.com', 'Picture Book'),
(7, 2, 'Wong Xuan Ting', 'wong@gmail.com', '2024-07-02', 'That Thing Under My Bed', 15.00, 'Wong Xuan Ting', 'wong@gmail.com', 'Picture Book'),
(8, 2, 'Wong Xuan Ting', 'wong@gmail.com', '2024-07-02', 'Flippy The Silly Little Fish', 12.00, 'Wong Xuan Ting', 'wong@gmail.com', 'Picture Book'),
(9, 2, 'Wong Xuan Ting', 'wong@gmail.com', '2024-07-02', 'Cook Like A Pro', 70.00, 'Wong Xuan Ting', 'wong@gmail.com', 'Guide Book');

-- --------------------------------------------------------

--
-- Table structure for table `ratingreview`
--

CREATE TABLE `ratingreview` (
  `RateID` int(11) NOT NULL,
  `user_id` int(6) UNSIGNED NOT NULL,
  `Rating` int(11) NOT NULL,
  `UserEmail` varchar(255) NOT NULL,
  `Comment` text DEFAULT NULL,
  `Rate_Date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ratingreview`
--

INSERT INTO `ratingreview` (`RateID`, `user_id`, `Rating`, `UserEmail`, `Comment`, `Rate_Date`) VALUES
(1, 1, 3, 'celine@gmail.com', 'Everything is fine but I prefer a different colour of website (not offensive)', '2024-07-02'),
(2, 6, 4, 'omar@gmail.com', '＼（〇_ｏ）／', '2024-07-02');

-- --------------------------------------------------------

--
-- Table structure for table `user_register`
--

CREATE TABLE `user_register` (
  `id` int(6) UNSIGNED NOT NULL,
  `username` varchar(30) NOT NULL,
  `userpass` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_register`
--

INSERT INTO `user_register` (`id`, `username`, `userpass`, `email`, `profile_picture`, `birthday`, `phone`) VALUES
(1, 'Kong Lee Ching', 'celine0605', 'celine@gmail.com', 'celine.png', '2005-06-05', '010-2282675'),
(2, 'Wong Xuan Ting', 'wong0330', 'wong@gmail.com', 'xuanting.png', '2005-03-30', '018-7730806'),
(3, 'Lim Siew Jin', 'siewjin0530', 'lim@gmail.com', 'siewjin.png', '2005-05-30', '010-8822297'),
(4, 'Xavier Kumar', 'xavier0111', 'xavier@gmail.com', 'xavier.png', '2005-01-11', '011-1111111'),
(5, 'Gatito Gitty', 'gatito0000', 'gatito@gmail.com', 'gatito.png', '2005-01-01', '013-3364448'),
(6, 'Omar Kuskal', 'omar1111', 'omar@gmail.com', 'omar.png', '2005-11-11', '017-6316311');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_register`
--
ALTER TABLE `admin_register`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `booklist`
--
ALTER TABLE `booklist`
  ADD PRIMARY KEY (`BookID`),
  ADD UNIQUE KEY `BookIMG` (`BookIMG`),
  ADD UNIQUE KEY `Price` (`Price`),
  ADD UNIQUE KEY `Book_Name` (`Book_Name`),
  ADD KEY `Category` (`Category`);

--
-- Indexes for table `book_category`
--
ALTER TABLE `book_category`
  ADD PRIMARY KEY (`CategoryID`),
  ADD UNIQUE KEY `CategoryName` (`CategoryName`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`CartID`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `contact_record`
--
ALTER TABLE `contact_record`
  ADD PRIMARY KEY (`ContactID`),
  ADD KEY `Username` (`Username`),
  ADD KEY `UserEmail` (`UserEmail`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `fk_order_user` (`user_id`);

--
-- Indexes for table `ratingreview`
--
ALTER TABLE `ratingreview`
  ADD PRIMARY KEY (`RateID`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- Indexes for table `user_register`
--
ALTER TABLE `user_register`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booklist`
--
ALTER TABLE `booklist`
  MODIFY `BookID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `book_category`
--
ALTER TABLE `book_category`
  MODIFY `CategoryID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `CartID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_record`
--
ALTER TABLE `contact_record`
  MODIFY `ContactID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ratingreview`
--
ALTER TABLE `ratingreview`
  MODIFY `RateID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_register`
--
ALTER TABLE `user_register`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
