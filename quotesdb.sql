-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2026 at 12:29 AM
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
-- Database: `quotesdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `id` int(11) NOT NULL,
  `author` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`id`, `author`) VALUES
(1, 'Abraham Lincoln'),
(2, 'Princess Diana'),
(3, 'Steve Jobs'),
(4, 'Confucius'),
(5, 'Jesse Jackson');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`) VALUES
(1, 'Leadership'),
(2, 'Humanitarianism'),
(3, 'Innovation'),
(4, 'Wisdom'),
(5, 'Inspiration');

-- --------------------------------------------------------

--
-- Table structure for table `quotes`
--

CREATE TABLE `quotes` (
  `id` int(11) NOT NULL,
  `quote` text NOT NULL,
  `author_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quotes`
--

INSERT INTO `quotes` (`id`, `quote`, `author_id`, `category_id`) VALUES
(1, 'I am not bound to win, but I am bound to be true. I am not bound to succeed, but I am bound to live by the light that I have. I must stand with anybody that stands right, and stand with him while he is right, and part with him when he goes wrong.', 1, 1),
(2, 'You cannot escape the responsibility of tomorrow by evading it today.', 1, 1),
(3, 'My dream is of a place and a time where America will once again be seen as the last best hope of earth.', 1, 5),
(4, 'Be sure you put your feet in the right place, then stand firm.', 1, 5),
(5, 'Give me six hours to chop down a tree and I will spend the first four sharpening the axe.', 1, 4),
(6, 'Only do what your heart tells you.', 2, 5),
(7, 'I think the biggest disease the world suffers from in this day and age is the disease of people feeling unloved. I know that I can give love for a minute, for half an hour, for a day, for a month, but I can give. I am very happy to do that, I want to do that.', 2, 2),
(8, 'HIV does not make people dangerous to know, so you can shake their hands and give them a hug: Heaven knows they need it.', 2, 2),
(9, 'Everyone of us needs to show how much we care for each other and, in the process, care for ourselves.', 2, 2),
(10, 'Nothing brings me more happiness than trying to help the most vulnerable people in society. It is a goal and an essential part of my life - a kind of destiny. Whoever is in distress can call on me. I will come running wherever they are.', 2, 5),
(11, 'Remembering that I\'ll be dead soon is the most important tool I\'ve ever encountered to help me make the big choices in life. Because almost everything - all external expectations, all pride, all fear of embarrassment or failure - these things just fall away in the face of death, leaving only what is truly important.', 3, 5),
(12, 'It\'s not a faith in technology. It\'s faith in people.', 3, 3),
(13, 'Design is a funny word. Some people think design means how it looks. But of course, if you dig deeper, it\'s really how it works.', 3, 3),
(14, 'Everyone here has the sense that right now is one of those moments when we are influencing the future.', 3, 3),
(15, 'Great things in business are never done by one person. They\'re done by a team of people.', 3, 1),
(16, 'Life is really simple, but we insist on making it complicated.', 4, 4),
(17, 'Everything has beauty, but not everyone sees it.', 4, 4),
(18, 'It does not matter how slowly you go as long as you do not stop.', 4, 5),
(19, 'When anger rises, think of the consequences.', 4, 4),
(20, 'Better a diamond with a flaw than a pebble without.', 4, 4),
(21, 'If you fall behind, run faster. Never give up, never surrender, and rise up against the odds.', 5, 5),
(22, 'Your children need your presence more than your presents.', 5, 4),
(23, 'I was born in a slum, but the slum wasn\'t born in me.', 5, 5),
(24, 'If there are occasions when my grape turned into a raisin and my joy bell lost its resonance, please forgive me. Charge it to my head and not to my heart.', 5, 4),
(25, 'Leadership cannot just go along to get along. Leadership must meet the moral challenge of the day.', 5, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotes`
--
ALTER TABLE `quotes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_author_id` (`author_id`),
  ADD KEY `fk_category_id` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `quotes`
--
ALTER TABLE `quotes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `quotes`
--
ALTER TABLE `quotes`
  ADD CONSTRAINT `fk_author_id` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`),
  ADD CONSTRAINT `fk_category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
