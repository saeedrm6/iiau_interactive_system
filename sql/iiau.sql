-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2017 at 01:28 PM
-- Server version: 5.7.14
-- PHP Version: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `iiau`
--

-- --------------------------------------------------------

--
-- Table structure for table `0_95961`
--

CREATE TABLE `0_95961` (
  `id` int(11) NOT NULL,
  `code` int(11) DEFAULT NULL,
  `name` varchar(40) COLLATE utf8_persian_ci DEFAULT NULL,
  `unit` int(11) DEFAULT NULL,
  `description` varchar(60) COLLATE utf8_persian_ci DEFAULT NULL,
  `exam_time` varchar(15) COLLATE utf8_persian_ci DEFAULT NULL,
  `teacher` varchar(60) COLLATE utf8_persian_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `1520_95961`
--

CREATE TABLE `1520_95961` (
  `id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `name` varchar(40) COLLATE utf8_persian_ci NOT NULL,
  `unit` int(11) NOT NULL,
  `description` varchar(60) COLLATE utf8_persian_ci NOT NULL,
  `exam_time` varchar(15) COLLATE utf8_persian_ci NOT NULL,
  `teacher` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `TeacherCode` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `1520_95961`
--

INSERT INTO `1520_95961` (`id`, `code`, `name`, `unit`, `description`, `exam_time`, `teacher`, `TeacherCode`) VALUES
(778, 81024, 'هوش مصنوعي', 3, 'يکشنبه15:15 13:00 شماره کلاس 6312عادي', '95/11/04', 'بهروز احدزاده عربلو', 0),
(1996, 810015, 'نظريه زبانها وماشين ها', 3, 'سه شنبه13:15 11:00 شماره کلاس 2408عادي', '95/10/27', 'آيدا اميني مطلق', 0),
(774, 810026, 'مهندسي نرم افزار1', 3, 'يکشنبه10:15 08:00 شماره کلاس 2316عادي', '95/10/23', 'سعيد حقگو', 45375),
(775, 810028, 'مهندسي نرم افزار2', 3, 'يکشنبه12:45 10:30 شماره کلاس 2316عادي', '95/10/26', 'سعيد حقگو', 45375),
(745, 810016, 'طراحي و پياده سازي زبانهاي برنامه سازي', 3, 'شنبه18:15 16:00 شماره کلاس 2401عادي', '95/11/06', 'کريم حيدري', 0),
(2349, 810029, 'آزمايشگاه سيستم عامل', 1, 'يکشنبه17:00 15:30 شماره کلاس 6202عادي', '', 'ميثم کريمي', 0),
(2369, 810045, 'آزمايشگاه سيستم عامل', 1, 'يکشنبه17:00 15:30 شماره کلاس 6202عادي', '12/10/95', 'احد زاده', 15789),
(840, 103863, 'آزمايشگاه پايگاه داده ها ', 1, 'پنج شنبه12:30 11:00 شماره کلاس 6201عادي', 'ندارد', 'شيما باقرموسوي', 9650);

-- --------------------------------------------------------

--
-- Table structure for table `3250_95961`
--

CREATE TABLE `3250_95961` (
  `id` int(11) NOT NULL,
  `code` int(11) DEFAULT NULL,
  `name` varchar(40) COLLATE utf8_persian_ci DEFAULT NULL,
  `unit` int(11) DEFAULT NULL,
  `description` varchar(60) COLLATE utf8_persian_ci DEFAULT NULL,
  `exam_time` varchar(15) COLLATE utf8_persian_ci DEFAULT NULL,
  `teacher` varchar(60) COLLATE utf8_persian_ci DEFAULT NULL,
  `TeacherCode` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `3250_95961`
--

INSERT INTO `3250_95961` (`id`, `code`, `name`, `unit`, `description`, `exam_time`, `teacher`, `TeacherCode`) VALUES
(1234, 7485, 'فقه 1', 3, 'توضیح ندارد', '13/12/95', 'عسگری راد', 47965);

-- --------------------------------------------------------

--
-- Table structure for table `81024_95961`
--

CREATE TABLE `81024_95961` (
  `id` int(11) NOT NULL,
  `jalase` varchar(30) COLLATE utf8_persian_ci DEFAULT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `PDF` varchar(200) COLLATE utf8_persian_ci DEFAULT NULL,
  `voice` varchar(200) COLLATE utf8_persian_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `103863_95961`
--

CREATE TABLE `103863_95961` (
  `id` int(11) NOT NULL,
  `jalase` varchar(30) COLLATE utf8_persian_ci DEFAULT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `PDF` varchar(200) COLLATE utf8_persian_ci DEFAULT NULL,
  `voice` varchar(200) COLLATE utf8_persian_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `810015_95961`
--

CREATE TABLE `810015_95961` (
  `id` int(11) NOT NULL,
  `jalase` varchar(30) COLLATE utf8_persian_ci NOT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `PDF` varchar(200) COLLATE utf8_persian_ci NOT NULL,
  `voice` varchar(200) COLLATE utf8_persian_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `810015_95961`
--

INSERT INTO `810015_95961` (`id`, `jalase`, `date`, `PDF`, `voice`) VALUES
(1, 'اول', '2016-12-02 09:07:00', 'http://localhost/cms/uploads/810015_95961/bootstrap.pdf', '');

-- --------------------------------------------------------

--
-- Table structure for table `810016_95961`
--

CREATE TABLE `810016_95961` (
  `id` int(11) NOT NULL,
  `jalase` varchar(30) COLLATE utf8_persian_ci DEFAULT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `PDF` varchar(200) COLLATE utf8_persian_ci DEFAULT NULL,
  `voice` varchar(200) COLLATE utf8_persian_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `810026_95961`
--

CREATE TABLE `810026_95961` (
  `id` int(11) NOT NULL,
  `jalase` varchar(30) COLLATE utf8_persian_ci DEFAULT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `PDF` varchar(200) COLLATE utf8_persian_ci DEFAULT NULL,
  `voice` varchar(200) COLLATE utf8_persian_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `810029_95961`
--

CREATE TABLE `810029_95961` (
  `id` int(11) NOT NULL,
  `jalase` varchar(30) COLLATE utf8_persian_ci DEFAULT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `PDF` varchar(200) COLLATE utf8_persian_ci DEFAULT NULL,
  `voice` varchar(200) COLLATE utf8_persian_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `930247933_95961`
--

CREATE TABLE `930247933_95961` (
  `id` int(11) NOT NULL,
  `code` int(11) DEFAULT NULL,
  `name` varchar(40) COLLATE utf8_persian_ci DEFAULT NULL,
  `unit` int(11) DEFAULT NULL,
  `description` varchar(60) COLLATE utf8_persian_ci DEFAULT NULL,
  `exam_time` varchar(15) COLLATE utf8_persian_ci DEFAULT NULL,
  `teacher` varchar(60) COLLATE utf8_persian_ci DEFAULT NULL,
  `exam_point` int(2) DEFAULT NULL,
  `reexam_point` int(2) DEFAULT NULL,
  `eteraz` int(1) DEFAULT NULL,
  `eteraz_desc` varchar(250) COLLATE utf8_persian_ci DEFAULT NULL,
  `TeacherCode` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `930247933_95961`
--

INSERT INTO `930247933_95961` (`id`, `code`, `name`, `unit`, `description`, `exam_time`, `teacher`, `exam_point`, `reexam_point`, `eteraz`, `eteraz_desc`, `TeacherCode`) VALUES
(774, 810026, 'مهندسي نرم افزار1', 3, 'يکشنبه10:15 08:00 شماره کلاس 2316عادي', '95/10/23', 'سعيد حقگو', NULL, NULL, 1, 'اعتراض', 45375),
(2349, 810029, 'آزمايشگاه سيستم عامل', 1, 'يکشنبه17:00 15:30 شماره کلاس 6202عادي', '', 'ميثم کريمي', NULL, NULL, NULL, NULL, 0),
(840, 103863, 'آزمايشگاه پايگاه داده ها ', 1, 'پنج شنبه12:30 11:00 شماره کلاس 6201عادي', 'ندارد', 'شيما باقرموسوي', NULL, NULL, NULL, NULL, 9650);

-- --------------------------------------------------------

--
-- Table structure for table `930247934_95961`
--

CREATE TABLE `930247934_95961` (
  `id` int(11) NOT NULL,
  `code` int(11) DEFAULT NULL,
  `name` varchar(40) COLLATE utf8_persian_ci DEFAULT NULL,
  `unit` int(11) DEFAULT NULL,
  `description` varchar(60) COLLATE utf8_persian_ci DEFAULT NULL,
  `exam_time` varchar(15) COLLATE utf8_persian_ci DEFAULT NULL,
  `teacher` varchar(60) COLLATE utf8_persian_ci DEFAULT NULL,
  `exam_point` int(2) DEFAULT NULL,
  `reexam_point` int(2) DEFAULT NULL,
  `eteraz` int(1) DEFAULT NULL,
  `eteraz_desc` varchar(250) COLLATE utf8_persian_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `930247934_95961`
--

INSERT INTO `930247934_95961` (`id`, `code`, `name`, `unit`, `description`, `exam_time`, `teacher`, `exam_point`, `reexam_point`, `eteraz`, `eteraz_desc`) VALUES
(745, 810016, 'طراحي و پياده سازي زبانهاي برنامه سازي', 3, 'شنبه18:15 16:00 شماره کلاس 2401عادي', '95/11/06', 'کريم حيدري', NULL, NULL, 1, 'استاد غلط کردم');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `sex` tinyint(1) NOT NULL,
  `Fname` varchar(30) COLLATE utf8_persian_ci NOT NULL,
  `Lname` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `fother` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `AdminCode` int(11) NOT NULL,
  `password` varchar(60) COLLATE utf8_persian_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `sex`, `Fname`, `Lname`, `fother`, `AdminCode`, `password`) VALUES
(1, 0, 'احمد', 'ابریشمی', 'محمدرضا', 900247933, '$2y$10$MTUwMjc5MjEyZGQzYmFiNe0.oc8TVKJMzTevj6YqbHEFBcfiXYXXq'),
(2, 0, 'علی', 'کامکار', 'حسین', 910247933, '$2y$10$YThiZTNkNmM5YWRkN2JhN.HXic2p5yC1KQLMYgYUUs7Ma0ByQ.Ooi');

-- --------------------------------------------------------

--
-- Table structure for table `fieldcode`
--

CREATE TABLE `fieldcode` (
  `id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_persian_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `fieldcode`
--

INSERT INTO `fieldcode` (`id`, `code`, `name`) VALUES
(1, 1520, 'مهندسی نرم افزار'),
(2, 3250, 'حقوق'),
(3, 1521, 'حسابداری'),
(4, 8524, 'برق'),
(5, 2564, 'مکانیک');

-- --------------------------------------------------------

--
-- Table structure for table `general_message`
--

CREATE TABLE `general_message` (
  `id` int(11) NOT NULL,
  `message` text COLLATE utf8_persian_ci,
  `time` timestamp NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `general_message`
--

INSERT INTO `general_message` (`id`, `message`, `time`) VALUES
(1, '!!!براي دانشجويان بدهکار گواهي اشتغال به تحصيل صادر نمي گردد !!!', '2016-10-26 03:58:24'),
(2, 'لطفا نسبت به ارسال عکس پرسنلی اقدام نمایید', '2016-10-25 23:30:00'),
(3, 'کارت امتحانی نیم سال اول در دسترس از پرتال می باشد', '2016-12-21 07:37:49'),
(4, 'لاسیابدتنسیابنتسیب', '2016-12-25 05:51:06');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `term` int(11) NOT NULL,
  `term_name` varchar(50) COLLATE utf8_persian_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `term`, `term_name`) VALUES
(3, 95961, 'نیم سال اول 96-95');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(10) NOT NULL,
  `sex` tinyint(1) NOT NULL,
  `Fname` varchar(30) COLLATE utf8_persian_ci NOT NULL,
  `Lname` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `fother` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `StudentCode` int(11) NOT NULL,
  `field` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `level` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_persian_ci NOT NULL,
  `fieldcode` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `sex`, `Fname`, `Lname`, `fother`, `StudentCode`, `field`, `level`, `password`, `fieldcode`) VALUES
(1, 0, 'سعید', 'رحیمی منش', 'غلامرضا', 930247933, 'مهندسی نرم افزار', 'کارشناسی پیوسته', '$2y$10$MTUwMjc5MjEyZGQzYmFiNe0.oc8TVKJMzTevj6YqbHEFBcfiXYXXq', 1520),
(2, 0, 'فرهاد', 'نعیمی', 'ابراهیم', 930247934, 'مهندسی نرم افزار', 'کارشناسی پیوسته', '$2y$10$ZGNiMTdjZGRhYzBmMjI1OOzaiKvqLgC/kfTQ6.cozZr7hdCKRsZgm', 1520),
(3, 0, 'اکبر', 'اسکندری', 'قادر', 930247935, 'مهندسی نرم افزار', 'کارشناسی پیوسته', '$2y$10$MmQ2ZjljNmU1MGU5ZmJiMOmoLL8uiM1YYx0VvPREr3xeHb0bN.UO2', 1520);

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `sex` tinyint(1) NOT NULL,
  `Fname` varchar(30) COLLATE utf8_persian_ci NOT NULL,
  `Lname` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `fother` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `TeacherCode` int(11) NOT NULL,
  `field` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `level` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_persian_ci NOT NULL,
  `fieldcode` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `sex`, `Fname`, `Lname`, `fother`, `TeacherCode`, `field`, `level`, `password`, `fieldcode`) VALUES
(2, 0, 'سعید', 'حق گو', 'ابراهیم', 45375, 'مهندسی نرم افزار', 'دکتری', '$2y$10$ZGNiMTdjZGRhYzBmMjI1OOzaiKvqLgC/kfTQ6.cozZr7hdCKRsZgm', 1520);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `0_95961`
--
ALTER TABLE `0_95961`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `1520_95961`
--
ALTER TABLE `1520_95961`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `3250_95961`
--
ALTER TABLE `3250_95961`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `81024_95961`
--
ALTER TABLE `81024_95961`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `103863_95961`
--
ALTER TABLE `103863_95961`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `810015_95961`
--
ALTER TABLE `810015_95961`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `810016_95961`
--
ALTER TABLE `810016_95961`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `810026_95961`
--
ALTER TABLE `810026_95961`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `810029_95961`
--
ALTER TABLE `810029_95961`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `930247933_95961`
--
ALTER TABLE `930247933_95961`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `930247934_95961`
--
ALTER TABLE `930247934_95961`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`AdminCode`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `fieldcode`
--
ALTER TABLE `fieldcode`
  ADD PRIMARY KEY (`code`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `general_message`
--
ALTER TABLE `general_message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`StudentCode`),
  ADD KEY `StudentCode` (`StudentCode`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`TeacherCode`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `810015_95961`
--
ALTER TABLE `810015_95961`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `810026_95961`
--
ALTER TABLE `810026_95961`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `fieldcode`
--
ALTER TABLE `fieldcode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `general_message`
--
ALTER TABLE `general_message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
