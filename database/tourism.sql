-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2021 at 01:12 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tourism`
--

-- --------------------------------------------------------

--
-- Table structure for table `attractive_points`
--

CREATE TABLE `attractive_points` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `category` varchar(41) NOT NULL,
  `pic` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `location` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attractive_points`
--

INSERT INTO `attractive_points` (`id`, `name`, `address`, `category`, `pic`, `description`, `location`) VALUES
(2, 'Dubin Castle', 'Dame St, Dublin 2, Ireland', 'Historical', 'images/files/dubincastle.jpg', 'One of Dublin\'s most popular attractions. Established and designed in 1830 by Decimus Burton, it opened the following year. The zoo describes its role as conservation, study, and education', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2382.0204969588144!2d-6.269617084615012!3d53.342889282671955!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48670e873566ff89%3A0x50fcdf6c0e15686!2sDublin%20Castle!5e0!3m2!1sen!2s!4v1587127581927!5m2!1sen!2s\" width=\"600\" height=\"450\" frameborder=\"0\" style=\"border:0;\" allowfullscreen=\"\" aria-hidden=\"false\" tabindex=\"0\"></iframe>'),
(4, 'Ashford Castle', 'Ashford Castle Estate, Cong, Co. Mayo, F31 CA48, Ireland', 'Historical', 'images/files/ashford.jpg', 'Dublin, is a zoo in Ireland, and one of Dublin\'s most popular attractions. Established and designed in 1830 by Decimus Burton, it opened the following year. The zoo describes its role as conservation, study, and education', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2381.8198262459255!2d-6.257048384614863!3d53.34648138240288!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48670e8559e69a47%3A0x518855d04274e42c!2sAshford%20House%2C%20Tara%20St%2C%20Dublin%202%2C%20Ireland!5e0!3m2!1sen!2s!4v1587127527369!5m2!1sen!2s\" width=\"600\" height=\"450\" frameborder=\"0\" style=\"border:0;\" allowfullscreen=\"\" aria-hidden=\"false\" tabindex=\"0\"></iframe>'),
(5, 'Guinness Storehouse', 'The Liberties, Dublin 8, Ireland', 'Attractive Spots', 'images/files/guiness.jpg', 'Dublin, is a zoo in Ireland, and one of Dublin\'s most popular attractions. Established and designed in 1830 by Decimus Burton, it opened the following year. The zoo describes its role as conservation, study, and education', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2382.077035684277!2d-6.288897984615082!3d53.34187718274779!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48670e8440c5056b%3A0xb31933927505e7a2!2sGuinness%20Storehouse!5e0!3m2!1sen!2s!4v1587127449938!5m2!1sen!2s\" width=\"600\" height=\"450\" frameborder=\"0\" style=\"border:0;\" allowfullscreen=\"\" aria-hidden=\"false\" tabindex=\"0\"></iframe>'),
(6, 'St Patricks Cathedral, Dublin', 'St Patricks Close, Wood Quay, Dublin 8, A96 P599, Ireland', 'Attractive Spots', 'images/files/stparthk.jpg', 'Dublin, is a zoo in Ireland, and one of Dublin\'s most popular attractions. Established and designed in 1830 by Decimus Burton, it opened the following year. The zoo describes its role as conservation, study, and education', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2382.208790766338!2d-6.2736653846151444!3d53.33951858292439!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4844a7096c3558a5%3A0x92c8e69bb625b154!2sSt%20Patrick&#39;s%20Cathedral!5e0!3m2!1sen!2s!4v1587127428514!5m2!1sen!2s\" width=\"600\" height=\"450\" frameborder=\"0\" style=\"border:0;\" allowfullscreen=\"\" aria-hidden=\"false\" tabindex=\"0\"></iframe>'),
(10, 'Dublin Zoo', 'Saint James (part of Phoenix Park), Dublin 8, Ireland', 'Historical', 'images/files/1586693778zoo.jpg', 'Dublin Zoo, in Phoenix Park, Dublin, is a zoo in Ireland, and one of Dublin\'s most popular attractions. Established and designed in 1830 by Decimus Burton, it opened the following year. The zoo describes its role as conservation, study, and education', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2381.277039396372!2d-6.30747848461443!3d53.35619668167503!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48670c4b4afd1245%3A0x8aa7e3087b6a1b88!2sDublin%20Zoo!5e0!3m2!1sen!2s!4v1587127403486!5m2!1sen!2s\" width=\"600\" height=\"450\" frameborder=\"0\" style=\"border:0;\" allowfullscreen=\"\" aria-hidden=\"false\" tabindex=\"0\"></iframe>'),
(11, 'Chapter One Restaurant', '18-19 Parnell Square N, Rotund', 'Bars', 'images/files/1586693879Chapteronesign.jpg', 'Chapter One is one seriously blokey restaurant. It’s staffed by blokes, either in chefs whites or the cook’s aprons worn by all floor staff including the ever-suave owner, Olivier Meisonnave. The clientele is mostly suited-and-booted blokes, from Baggotonia’s better-appointed offices', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d9525.522434227978!2d-6.2640925!3d53.354343!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x9d52daf7f4cdca6!2sChapter%20One%20Restaurant!5e0!3m2!1sen!2s!4v1587126867415!5m2!1sen!2s\" width=\"600\" height=\"450\" frameborder=\"0\" style=\"border:0;\" allowfullscreen=\"\" aria-hidden=\"false\" tabindex=\"0\"></iframe>'),
(12, 'Dax Restaurant', 'Pembroke Street Upper Pembroke Street Upper, Saint Peters', 'Restaurants', 'images/files/1586693923dax.png', 'Dax is one seriously blokey restaurant. It’s staffed by blokes, either in chefs whites or the cook’s aprons worn by all floor staff including the ever-suave owner, Olivier Meisonnave. The clientele is mostly suited-and-booted blokes, from Baggotonia’s better-appointed offices', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2382.471573846377!2d-6.256706684615357!3d53.334814183276734!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48670ea29cebadd9%3A0x6eb8bdc207dc8b12!2sDax%20Restaurant!5e0!3m2!1sen!2s!4v1587127379197!5m2!1sen!2s\" width=\"600\" height=\"450\" frameborder=\"0\" style=\"border:0;\" allowfullscreen=\"\" aria-hidden=\"false\" tabindex=\"0\"></iframe>'),
(13, 'Etto', '18 Merrion Row, Saint Peters, Dublin', 'Hotel', 'images/files/1586693965etto.jpg', 'Clean white walls and wooden tables adorn this casual eatery serving seasonal, locally sourced fare.', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2382.2864476200566!2d-6.25612368461519!3d53.33812838302849!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48670e99c935e9c9%3A0x8dff0c5e8772492f!2sEtto!5e0!3m2!1sen!2s!4v1587127356514!5m2!1sen!2s\" width=\"600\" height=\"450\" frameborder=\"0\" style=\"border:0;\" allowfullscreen=\"\" aria-hidden=\"false\" tabindex=\"0\"></iframe>'),
(17, 'Mr Fox', '38 Parnell Square W, Rotunda, Dublin, Ireland', 'Bars', 'images/files/1587134068fox.jpg', 'Clean white walls and wooden tables adorn this casual eatery serving seasonal, locally sourced fare.', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d9525.838797914748!2d-6.2648181!3d53.3529274!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x7ca49e7197727478!2sMr%20Fox!5e0!3m2!1sen!2s!4v1587127289989!5m2!1sen!2s\" width=\"600\" height=\"450\" frameborder=\"0\" style=\"border:0;\" allowfullscreen=\"\" aria-hidden=\"false\" tabindex=\"0\"></iframe>');

-- --------------------------------------------------------

--
-- Table structure for table `bookingflight`
--

CREATE TABLE `bookingflight` (
  `id` int(11) NOT NULL,
  `flightid` int(11) NOT NULL,
  `userid` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `seat` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookingflight`
--

INSERT INTO `bookingflight` (`id`, `flightid`, `userid`, `status`, `seat`) VALUES
(4, 2, '1', 1, 3),
(7, 3, '1', 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `bookingplace`
--

CREATE TABLE `bookingplace` (
  `id` int(11) NOT NULL,
  `placeid` int(11) NOT NULL,
  `userid` varchar(255) NOT NULL,
  `date` varchar(40) NOT NULL,
  `time` varchar(40) NOT NULL,
  `total` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookingplace`
--

INSERT INTO `bookingplace` (`id`, `placeid`, `userid`, `date`, `time`, `total`, `status`) VALUES
(1, 11, '1', '04/18/2020', '22:30', 2, 1),
(2, 11, '1', '04/24/2020', '01:30', 2, 0),
(6, 11, '1', '04/24/2020', '12:20', 1, 0),
(9, 17, '1', '04/24/2020', '00:30', 3, 0),
(10, 17, '1', '04/24/2020', '06:01', 5, 0),
(11, 12, '1', '03/05/2021', '01:56', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `flight_schedule`
--

CREATE TABLE `flight_schedule` (
  `id` int(11) NOT NULL,
  `departure` varchar(255) NOT NULL,
  `arrival` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `seats` int(11) NOT NULL,
  `company_name` varchar(41) NOT NULL,
  `fair` int(11) NOT NULL,
  `return_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `flight_schedule`
--

INSERT INTO `flight_schedule` (`id`, `departure`, `arrival`, `date`, `time`, `seats`, `company_name`, `fair`, `return_date`) VALUES
(2, 'California', 'Dublin', '2020-04-25', '09:00:00', 89, 'American Airlines', 650, '2020-04-28'),
(3, 'California', 'Dublin', '2020-04-25', '09:00:00', 90, 'American Airlines', 650, '2020-04-28'),
(5, 'Los Angeles', 'Dublin', '2020-04-25', '08:00:00', 93, 'Alaska Airlines', 670, '2020-04-28'),
(6, 'Los Angeles', 'Dublin', '2020-04-25', '23:00:00', 93, 'Alaska Airlines', 670, '2020-04-28'),
(7, 'Washington DC', 'Dublin', '2020-04-25', '23:00:00', 70, 'Delta Airlines', 670, '2020-04-28'),
(8, 'Washington DC', 'Dublin', '2020-04-25', '23:00:00', 70, 'Delta Airlines', 660, '2020-04-28'),
(9, 'California', 'Dublin', '2020-04-25', '18:00:00', 65, 'American Airlines', 650, '2020-04-28'),
(10, 'california', 'dublin', '2020-04-25', '13:30:00', 90, 'Delta Airline', 700, '2020-04-29');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `from` varchar(255) NOT NULL,
  `to_id` varchar(255) NOT NULL,
  `sender_id` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `from`, `to_id`, `sender_id`, `message`, `time`) VALUES
(6, 'rjarslan82@gmail.com', '1', 'rjarslan82@gmail.com', 'hy', '2020-04-08 21:51:52'),
(8, 'rjarslan82@gmail.com', '1', 'rjarslan82@gmail.com', 'hello boy', '2020-04-08 22:05:20'),
(10, '1', 'rjarslan82@gmail.com', '1', 'yes man', '2020-04-08 22:16:59'),
(11, 'rjarslan82@gmail.com', '1', 'rjarslan82@gmail.com', 'hehe', '2020-04-08 22:17:09'),
(12, '1', 'rjarslan82@gmail.com', '1', 'what', '2020-04-08 22:17:14'),
(13, 'rjarslan82@gmail.com', '1', 'rjarslan82@gmail.com', 'nothing', '2020-04-08 22:28:41'),
(14, 'rjarslan82@gmail.com', '2', 'rjarslan82@gmail.com', 'nothing', '2020-04-08 22:38:41'),
(15, 'rjarslan82@gmail.com', '2', 'rjarslan82@gmail.com', 'hello u there', '2020-04-08 23:04:46'),
(16, '1', 'rjarslan82@gmail.com', '1', 'okay', '2020-04-08 23:09:02'),
(17, '1', '2', '1', 'hello', '2020-04-08 23:10:24'),
(18, '1', '2', '1', 'whatsup', '2020-04-08 23:10:42'),
(19, '2', '1', '2', 'nothing test', '2020-04-08 23:18:41'),
(20, '1', '2', '1', 'okay', '2020-04-08 23:19:40'),
(21, '1', '2', '1', 'hello test 2', '2020-04-08 23:24:53'),
(22, '1', 'rjarslan82@gmail.com', '1', 'hello arslan', '2020-04-08 23:25:12'),
(23, 'rjarslan82@gmail.com', '1', 'rjarslan82@gmail.com', 'yes test', '2020-04-08 23:26:14'),
(24, '2', 'rjarslan82@gmail.com', '2', 'yes arslan', '2020-04-08 23:29:00'),
(26, '6', 'rjarslan82@gmail.com', '6', 'hello arslan', '2020-04-08 23:44:06'),
(27, 'rjarslan82@gmail.com', '6', 'rjarslan82@gmail.com', 'yes requel', '2020-04-08 23:44:45'),
(28, 'rjarslan82@gmail.com', '2', 'rjarslan82@gmail.com', 'whatsup', '2020-04-08 23:53:19'),
(32, 'rjarslan82@gmail.com', '1', 'rjarslan82@gmail.com', 'hello tokyo', '2020-04-11 21:54:01'),
(33, '9', '1', '9', 'hello tokyo i am berlin', '2020-04-12 01:50:03'),
(34, 'rjarslan82@gmail.com', '2', 'rjarslan82@gmail.com', 'hello', '2020-10-31 04:40:27'),
(35, '1', 'rjarslan82@gmail.com', '1', 'helloo', '2021-01-31 03:38:54'),
(36, 'rjarslan82@gmail.com', '1', 'rjarslan82@gmail.com', 'hello tokyo', '2021-03-04 04:47:31'),
(37, 'rjarslan82@gmail.com', '1', 'rjarslan82@gmail.com', 'i am professor', '2021-03-04 04:47:41'),
(38, '1', 'rjarslan82@gmail.com', '1', 'yes professor', '2021-03-04 04:48:35');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `gender` varchar(11) NOT NULL,
  `travelling_from` varchar(255) NOT NULL,
  `travelling_to` varchar(255) NOT NULL,
  `travelling_month` varchar(20) NOT NULL,
  `age` int(11) NOT NULL,
  `interest` text NOT NULL,
  `language` text NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `smoker_box` varchar(255) DEFAULT NULL,
  `drinking_box` varchar(255) DEFAULT NULL,
  `about` text DEFAULT NULL,
  `pic` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `user_id`, `name`, `gender`, `travelling_from`, `travelling_to`, `travelling_month`, `age`, `interest`, `language`, `phone`, `smoker_box`, `drinking_box`, `about`, `pic`, `username`) VALUES
(2, '2', 'John', 'male', 'california', 'dublin', 'Aprill', 23, 'Travelling, drinking', 'English, spanish', '147', 'yes', 'yes', 'testing', 'images/1587123273img_avatar.png', 'john223'),
(5, '1', 'Tokyo', 'Female', 'california', 'dublin', 'April', 22, 'Travelling', 'English', '555', 'no', 'no', 'nothing', 'images/1587677947WTF-192026-Teal_1024x1024.jpg', 'tokyo225'),
(6, 'rjarslan82@gmail.com', 'Arslan', 'Male', 'Los Angeles', 'dublin', 'April', 22, 'Travelling', 'English', '5555', 'no', 'no', 'nothing', 'images/1614890732download.jpg', 'arslan445'),
(7, '6', 'Requel', 'Female', 'california', 'dublin', 'April', 22, 'Travelling, drinking', 'English', '55', 'yes', 'yes', 'nothing', 'images/1587123273img_avatar.png', 'requel980'),
(9, '9', 'Berlin', 'male', 'california', 'dublin', 'April', 23, 'Travelling, drinking', 'English', '55', 'yes', 'yes', 'nothing', 'images/1587123273img_avatar.png', 'berlin9984'),
(12, 'maevewiley823@gmail.com', 'Maeve', 'Female', 'california', 'dublin', 'April', 22, 'Travelling', 'English, spanish', '55', 'yes', 'yes', 'nothing', 'images/1587123273img_avatar.png', 'maeve554'),
(13, '10', 'hassan', 'male', 'california', 'dublin', 'April', 22, 'Travelling', 'English', '55', 'no', 'yes', 'nothing', 'images/1587140026img_avatar.png', 'hassan332'),
(17, '11', 'Lisa', 'female', 'california', 'dublin', 'April', 22, 'Travelling', 'English', '55', 'no', 'yes', 'nothing', 'images/1587145574img_avatar.png', 'lisa123'),
(19, '14', 'Faizan', 'male', 'california', 'dublin', 'April', 22, 'Travelling', 'English', '55', 'no', 'no', 'nothing', 'images/1587162039img_avatar.png', 'Faizan1587162039'),
(21, 'muhammadhamdant@gmail.com', 'Hamdan Tahir', 'male', 'california', 'dublin', 'April', 22, 'Travelling, drinking', 'English', '5555555555', 'yes', 'yes', 'n', 'images/1587678037MTH481014-WNE_4_copy_1024x1024.jpg', 'Hamdan Tahir1587678027');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `place_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `detail` text NOT NULL,
  `status` int(11) DEFAULT 0,
  `type` varchar(20) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `place_id`, `name`, `detail`, `status`, `type`, `user_id`) VALUES
(6, 11, 'John', 'dont like', 1, 'place', '11'),
(7, 11, 'Anonymous', 'good', 1, 'place', '2'),
(8, 0, 'John', 'I was very delighted about the friendliness wherever we came. I felt that they did not try to charge too much for everything a tourist want to see. Hop-on-hop-off: We paid 16 euros each for TWO days! And the driver was the guide, telling jokes and history about Dublin. And to experience live music and dance, you did not have to pay for a 3-meal-course, we could just choose what we wanted, and enjoy. And there were lots of things to see, not just pubs and Guinness. Dublinia Viking Museum, Dublin Castle, and lots of other things to see. A very nice city to visit!', 1, 'dublin', '11'),
(9, 0, 'John', 'Be aware you drive on LT side of road and most rentals are manual shift. We left for Ireland via Akron-Canton aprt. to Laguardia and spent our layover visiting Manhattan principally Grand Central Station which I find fascinating. We did this via a shuttle from Laguardia to Grand Central we also walked to the Chrysler Bldg. one of my all time favorites. We had to keep watching our time as we needed to be at JFK by 3:45pm for a 5:45 flight to Dublin and the traffic in NYC is very heavy. Fortunately the weather was very good. (BTW Laguardia is a grundgy apart', 1, 'dublin', '9'),
(10, 0, 'Anonymous', 'This is our first visit to Dublin . I can highly recommend Dublin Hop On Hop Off Sightseeing Tour Bus for getting around and seeing all the attractions of which there are many. You can hop on and off as you please and the tickets are valid for two days. The 2-day ticket for the tour bus was a great way to become familiar with the layout of the city and get to the attractions we really wanted to see while learning more about the city through the interesting commentary. The running taped commentary is a bit repetitive but we know it is necessary as it is communicated.', 1, 'dublin', '6'),
(11, 0, 'Anonymous', 'I was very delighted about the friendliness wherever we came. I felt that they did not try to charge too much for everything a tourist want to see. Hop-on-hop-off: We paid 16 euros each for TWO days! And the driver was the guide, telling jokes and history about Dublin. And to experience live music and dance, you did not have to pay for a 3-meal-course, we could just choose what we wanted, and enjoy. And there were lots of things to see, not just pubs and Guinness. Dublinia Viking Museum, Dublin Castle, and lots of other things to see. A very nice city to visit!', 0, 'dublin', '2'),
(12, 11, 'Tokyo', 'good', 1, 'place', '1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile` tinyint(4) DEFAULT 0,
  `status` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `profile`, `status`) VALUES
(1, 'Tokyo', 'test@gmail.com', '123456', 1, 1),
(2, 'John', 'test2@gmail.com', '123456', 1, 1),
(4, 'Arslan', 'rjarslan82@gmail.com', 'auth from google', 1, 1),
(5, 'Maeve', 'maevewiley823@gmail.com', 'auth from google', 1, 1),
(6, 'Requel', 'test3@gmail.com', '123456', 1, 1),
(8, 'Admin', 'admin@admin.com', '123456', 1, 1),
(9, 'Berlin', 'test4@gmail.com', '123456', 1, 1),
(10, 'hassan', 'hassan@gmail.com', '123456', 1, 1),
(11, 'Lisa', 'test6@gmail.com', '123456', 1, 1),
(14, 'Faizan', 'faizan@gmail.com', '123456', 1, 2),
(17, 'Aman', 'aman@gmail.com', '123456', 0, 1),
(19, 'Hamdan Tahir', 'muhammadhamdant@gmail.com', 'auth from google', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attractive_points`
--
ALTER TABLE `attractive_points`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookingflight`
--
ALTER TABLE `bookingflight`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookingplace`
--
ALTER TABLE `bookingplace`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flight_schedule`
--
ALTER TABLE `flight_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attractive_points`
--
ALTER TABLE `attractive_points`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `bookingflight`
--
ALTER TABLE `bookingflight`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `bookingplace`
--
ALTER TABLE `bookingplace`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `flight_schedule`
--
ALTER TABLE `flight_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
