-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 01, 2019 at 08:20 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bmsnep_gajuridainik`
--

-- --------------------------------------------------------

--
-- Table structure for table `abibhahit_pramanpatra`
--

CREATE TABLE `abibhahit_pramanpatra` (
  `id` int(11) NOT NULL,
  `form_id` bigint(20) NOT NULL,
  `session_id` int(11) NOT NULL,
  `ward_login` int(11) NOT NULL,
  `status` tinyint(3) NOT NULL,
  `nepali_date` varchar(50) NOT NULL,
  `child_name` text NOT NULL,
  `gender` int(11) NOT NULL,
  `father_name` text NOT NULL,
  `mother_name` text NOT NULL,
  `date` date NOT NULL,
  `state` int(11) NOT NULL,
  `district` int(11) NOT NULL,
  `local_body` int(11) NOT NULL,
  `ward` int(11) NOT NULL,
  `old_place` int(11) NOT NULL,
  `documents` text NOT NULL,
  `documents_type` varchar(50) NOT NULL,
  `darta_documents` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `abibhahit_pramanpatra`
--

INSERT INTO `abibhahit_pramanpatra` (`id`, `form_id`, `session_id`, `ward_login`, `status`, `nepali_date`, `child_name`, `gender`, `father_name`, `mother_name`, `date`, `state`, `district`, `local_body`, `ward`, `old_place`, `documents`, `documents_type`, `darta_documents`, `created_at`, `updated_at`) VALUES
(1, 4756120983, 2, 2, 3, '2076-04-12', 'df', 1, 'Ram Basnet', 'स्रिस्टी श्रेष्ठ', '2019-07-28', 3, 514, 2556, 2, 1, '', '', 'Sys32.jpg.jpg', '2019-07-28 03:16:33', '2019-07-28 09:32:36');

-- --------------------------------------------------------

--
-- Table structure for table `add_classroom`
--

CREATE TABLE `add_classroom` (
  `id` int(11) NOT NULL,
  `form_id` bigint(20) NOT NULL,
  `session_id` int(11) NOT NULL,
  `ward_login` int(11) NOT NULL,
  `status` tinyint(3) NOT NULL,
  `nepali_date` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `school_name` text NOT NULL,
  `state` int(11) NOT NULL,
  `district` int(11) NOT NULL,
  `local_body` int(11) NOT NULL,
  `ward` int(11) NOT NULL,
  `old_place` int(11) NOT NULL,
  `documents` text NOT NULL,
  `documents_type` varchar(20) NOT NULL,
  `darta_documents` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `add_classroom`
--

INSERT INTO `add_classroom` (`id`, `form_id`, `session_id`, `ward_login`, `status`, `nepali_date`, `date`, `school_name`, `state`, `district`, `local_body`, `ward`, `old_place`, `documents`, `documents_type`, `darta_documents`, `created_at`, `updated_at`) VALUES
(1, 2031869754, 2, 2, 3, '2076-04-12', '2019-07-28', 'Satya Narayan Bidhyalaya', 3, 514, 2556, 2, 1, '', '', 'Screenshot_(1).png.png', '2019-07-28 03:38:50', '2019-07-28 09:55:43');

-- --------------------------------------------------------

--
-- Table structure for table `antarik_basai_sarai`
--

CREATE TABLE `antarik_basai_sarai` (
  `id` int(11) NOT NULL,
  `form_id` bigint(20) NOT NULL,
  `session_id` int(11) NOT NULL,
  `ward_login` int(11) NOT NULL,
  `status` tinyint(3) NOT NULL,
  `nepali_date` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `applicant_name` text NOT NULL,
  `father_name` varchar(125) NOT NULL,
  `mother_name` varchar(125) NOT NULL,
  `from_nepali_date` varchar(50) NOT NULL,
  `from_english_date` date NOT NULL,
  `old_state` int(11) NOT NULL,
  `old_district` int(11) NOT NULL,
  `old_local_body` int(11) NOT NULL,
  `old_ward` int(11) NOT NULL,
  `old_tole` text NOT NULL,
  `present_tole` text NOT NULL,
  `present_state` int(11) NOT NULL,
  `present_district` int(11) NOT NULL,
  `present_local_body` int(11) NOT NULL,
  `present_ward` int(11) NOT NULL,
  `documents` text NOT NULL,
  `documents_type` varchar(20) NOT NULL,
  `darta_documents` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `antarik_basai_sarai`
--

INSERT INTO `antarik_basai_sarai` (`id`, `form_id`, `session_id`, `ward_login`, `status`, `nepali_date`, `date`, `applicant_name`, `father_name`, `mother_name`, `from_nepali_date`, `from_english_date`, `old_state`, `old_district`, `old_local_body`, `old_ward`, `old_tole`, `present_tole`, `present_state`, `present_district`, `present_local_body`, `present_ward`, `documents`, `documents_type`, `darta_documents`, `created_at`, `updated_at`) VALUES
(1, 2154386790, 2, 2, 3, '2076-04-10', '2019-07-26', 'धिरज प्रधान', 'निर कुमार प्रधान', 'रुपा प्रधान', '2076-04-10', '2019-07-26', 3, 514, 2556, 2, 'test1', 'test2', 3, 514, 2556, 3, '', '', 'Screenshot_(1).png.png', '2019-07-26 11:52:27', '2019-07-26 06:39:14');

-- --------------------------------------------------------

--
-- Table structure for table `antarik_basai_sarai_detail`
--

CREATE TABLE `antarik_basai_sarai_detail` (
  `id` int(11) NOT NULL,
  `darta_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `relation` int(11) NOT NULL,
  `citizenship_no` varchar(15) NOT NULL,
  `ghar_no` int(11) NOT NULL,
  `road_name` text NOT NULL,
  `age` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `antarik_basai_sarai_detail`
--

INSERT INTO `antarik_basai_sarai_detail` (`id`, `darta_id`, `name`, `relation`, `citizenship_no`, `ghar_no`, `road_name`, `age`, `created_at`) VALUES
(1, 1, 'धिरज', 1, '७९७७९४', 18, 'Test', 23, '2019-07-26 11:52:27'),
(2, 1, 'निर', 4, '८८५७७', 18, 'Test', 52, '2019-07-26 11:52:27');

-- --------------------------------------------------------

--
-- Table structure for table `apanga_pramanpatra`
--

CREATE TABLE `apanga_pramanpatra` (
  `id` int(11) NOT NULL,
  `form_id` bigint(20) NOT NULL,
  `session_id` int(11) NOT NULL,
  `ward_login` int(11) NOT NULL,
  `status` tinyint(3) NOT NULL,
  `nepali_date` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `applicant_name` text NOT NULL,
  `gender` tinyint(2) NOT NULL,
  `disable_type` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `district` int(11) NOT NULL,
  `local_body` int(11) NOT NULL,
  `ward` int(11) NOT NULL,
  `old_place` int(11) NOT NULL,
  `documents` text NOT NULL,
  `documents_type` varchar(20) NOT NULL,
  `darta_documents` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `apanga_pramanpatra`
--

INSERT INTO `apanga_pramanpatra` (`id`, `form_id`, `session_id`, `ward_login`, `status`, `nepali_date`, `date`, `applicant_name`, `gender`, `disable_type`, `state`, `district`, `local_body`, `ward`, `old_place`, `documents`, `documents_type`, `darta_documents`, `created_at`, `updated_at`) VALUES
(1, 9372140685, 2, 2, 3, '2076-04-12', '2019-07-28', 'df', 1, 1, 3, 514, 2556, 2, 1, '', '', 'Screenshot_(1).png.png', '2019-07-28 03:32:42', '2019-07-28 09:47:53');

-- --------------------------------------------------------

--
-- Table structure for table `arthik_saheta`
--

CREATE TABLE `arthik_saheta` (
  `id` int(11) NOT NULL,
  `form_id` bigint(20) NOT NULL,
  `session_id` int(11) NOT NULL,
  `ward_login` int(11) NOT NULL,
  `status` tinyint(3) NOT NULL,
  `nepali_date` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `applicant_name` text NOT NULL,
  `culprit_name` text NOT NULL,
  `state` int(11) NOT NULL,
  `district` int(11) NOT NULL,
  `local_body` int(11) NOT NULL,
  `ward` int(11) NOT NULL,
  `old_place` int(11) NOT NULL,
  `documents` text NOT NULL,
  `documents_type` varchar(20) NOT NULL,
  `darta_documents` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `arthik_saheta`
--

INSERT INTO `arthik_saheta` (`id`, `form_id`, `session_id`, `ward_login`, `status`, `nepali_date`, `date`, `applicant_name`, `culprit_name`, `state`, `district`, `local_body`, `ward`, `old_place`, `documents`, `documents_type`, `darta_documents`, `created_at`, `updated_at`) VALUES
(1, 5867320914, 2, 2, 3, '2076-04-12', '2019-07-28', 'df', 'asdasdad', 3, 514, 2556, 2, 1, '', '', 'Screenshot_(1).png.png', '2019-07-28 03:49:19', '2019-07-28 10:04:28');

-- --------------------------------------------------------

--
-- Table structure for table `asthai_basobas`
--

CREATE TABLE `asthai_basobas` (
  `id` int(11) NOT NULL,
  `form_id` bigint(20) NOT NULL,
  `session_id` int(11) NOT NULL,
  `ward_login` int(11) NOT NULL,
  `status` tinyint(3) NOT NULL,
  `nepali_date` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `applicant_name` text NOT NULL,
  `owner_name` text NOT NULL,
  `citizenship_no` varchar(15) NOT NULL,
  `citizenship_district` int(11) NOT NULL,
  `nepali_citizenship_date` varchar(50) NOT NULL,
  `english_citizenship_date` date NOT NULL,
  `state` int(11) NOT NULL,
  `district` int(11) NOT NULL,
  `local_body` int(11) NOT NULL,
  `ward` int(11) NOT NULL,
  `old_place` int(11) NOT NULL,
  `nepali_permission_date` varchar(50) NOT NULL,
  `english_permission_date` date NOT NULL,
  `tole` text NOT NULL,
  `road` text NOT NULL,
  `ghar_no` int(11) NOT NULL,
  `documents` text NOT NULL,
  `documents_type` varchar(20) NOT NULL,
  `darta_documents` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `asthai_basobas`
--

INSERT INTO `asthai_basobas` (`id`, `form_id`, `session_id`, `ward_login`, `status`, `nepali_date`, `date`, `applicant_name`, `owner_name`, `citizenship_no`, `citizenship_district`, `nepali_citizenship_date`, `english_citizenship_date`, `state`, `district`, `local_body`, `ward`, `old_place`, `nepali_permission_date`, `english_permission_date`, `tole`, `road`, `ghar_no`, `documents`, `documents_type`, `darta_documents`, `created_at`, `updated_at`) VALUES
(1, 1769530428, 2, 2, 3, '2076-04-10', '2019-07-26', 'Amulya Sharma', 'Amulya Sharma', '98777', 490, '2076-04-02', '2019-07-18', 3, 514, 2556, 2, 1, '2076-04-10', '2019-07-26', 'Test Tole', 'Hanuman Das Road', 18, '', '', 'Sys32.jpg.jpg', '2019-07-26 12:32:07', '2019-07-28 08:48:05');

-- --------------------------------------------------------

--
-- Table structure for table `bato_kayam`
--

CREATE TABLE `bato_kayam` (
  `id` int(11) NOT NULL,
  `form_id` bigint(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `ward_login` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `nepali_date` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `land_owner_name` text NOT NULL,
  `kitta_no` varchar(50) NOT NULL,
  `biggha` float NOT NULL,
  `kattha` float NOT NULL,
  `dhur` float NOT NULL,
  `paisa` float NOT NULL,
  `land_type` enum('hill','terai') NOT NULL,
  `state` int(11) NOT NULL,
  `district` int(11) NOT NULL,
  `local_body` int(11) NOT NULL,
  `ward` int(11) NOT NULL,
  `old_place` text NOT NULL,
  `direction` text NOT NULL,
  `road_length` float NOT NULL,
  `road_width` float NOT NULL,
  `documents` text NOT NULL,
  `documents_type` int(11) NOT NULL,
  `darta_documents` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bato_kayam`
--

INSERT INTO `bato_kayam` (`id`, `form_id`, `session_id`, `ward_login`, `status`, `nepali_date`, `date`, `land_owner_name`, `kitta_no`, `biggha`, `kattha`, `dhur`, `paisa`, `land_type`, `state`, `district`, `local_body`, `ward`, `old_place`, `direction`, `road_length`, `road_width`, `documents`, `documents_type`, `darta_documents`, `created_at`, `updated_at`) VALUES
(1, 3672804159, 2, 2, 3, '2076-04-12', '2019-07-28', 'sASDF', '123', 12, 1, 1, 0, 'hill', 3, 514, 2556, 2, 'dgdv', 'East', 12, 23, '', 0, 'Screenshot_(1).png.png', '2019-07-28 01:37:57', '2019-07-28 07:53:13');

-- --------------------------------------------------------

--
-- Table structure for table `bebasaya_banda`
--

CREATE TABLE `bebasaya_banda` (
  `id` int(11) NOT NULL,
  `form_id` bigint(20) NOT NULL,
  `session_id` int(11) NOT NULL,
  `ward_login` int(11) NOT NULL,
  `status` tinyint(3) NOT NULL,
  `nepali_date` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `org_name` text NOT NULL,
  `owner_name` text NOT NULL,
  `darta_no` varchar(15) NOT NULL,
  `org_type` text NOT NULL,
  `org_size` text NOT NULL,
  `org_state` int(11) NOT NULL,
  `org_district` int(11) NOT NULL,
  `org_local_body` int(11) NOT NULL,
  `org_ward` int(11) NOT NULL,
  `old_new_address` int(11) NOT NULL,
  `new_place` varchar(80) NOT NULL,
  `tole` text NOT NULL,
  `road_name` text NOT NULL,
  `home_no` int(11) NOT NULL,
  `nepali_closed_date` varchar(80) NOT NULL,
  `english_closed_date` date NOT NULL,
  `nepali_observed_date` varchar(80) NOT NULL,
  `english_observed_date` date NOT NULL,
  `documents` text NOT NULL,
  `documents_type` text NOT NULL,
  `darta_documents` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bebasaya_banda`
--

INSERT INTO `bebasaya_banda` (`id`, `form_id`, `session_id`, `ward_login`, `status`, `nepali_date`, `date`, `org_name`, `owner_name`, `darta_no`, `org_type`, `org_size`, `org_state`, `org_district`, `org_local_body`, `org_ward`, `old_new_address`, `new_place`, `tole`, `road_name`, `home_no`, `nepali_closed_date`, `english_closed_date`, `nepali_observed_date`, `english_observed_date`, `documents`, `documents_type`, `darta_documents`, `created_at`, `updated_at`) VALUES
(1, 1258734609, 2, 2, 3, '2076-04-12', '2019-07-28', 'लालु चिया पसल', 'Dhiraj Pradhan', '123', 'Test Shop', 'asdda', 3, 514, 2556, 2, 1, 'गजुरी गाउँपालिका १', 'Test Tole', 'प्रगति टोल', 123, '2076-04-12', '2019-07-28', '2076-04-12', '2019-07-28', '', '', 'Screenshot_(1).png.png', '2019-07-28 12:15:17', '2019-07-28 06:31:09');

-- --------------------------------------------------------

--
-- Table structure for table `bebasaya_darta`
--

CREATE TABLE `bebasaya_darta` (
  `id` int(11) NOT NULL,
  `form_id` bigint(20) NOT NULL,
  `session_id` int(11) NOT NULL,
  `ward_login` int(11) NOT NULL,
  `status` tinyint(3) NOT NULL,
  `nepali_date` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `certificate_no` bigint(20) NOT NULL,
  `org_name` text NOT NULL,
  `owner_name` text NOT NULL,
  `org_type` text NOT NULL,
  `org_size` text NOT NULL,
  `org_state` int(11) NOT NULL,
  `org_district` int(11) NOT NULL,
  `org_local_body` int(11) NOT NULL,
  `org_ward` int(11) NOT NULL,
  `prop_state` int(11) NOT NULL,
  `prop_district` int(11) NOT NULL,
  `prop_local_body` int(11) NOT NULL,
  `prop_ward` int(11) NOT NULL,
  `citizenship_no` varchar(32) NOT NULL,
  `citizenship_district` int(11) NOT NULL,
  `citizenship_date` varchar(80) NOT NULL,
  `father_name` text NOT NULL,
  `lagat_pungi` double NOT NULL,
  `sign_board` varchar(32) NOT NULL,
  `description` text NOT NULL,
  `tole` text NOT NULL,
  `road_name` text NOT NULL,
  `house_own_name` text NOT NULL,
  `home_no` bigint(20) NOT NULL,
  `org_email` varchar(80) NOT NULL,
  `org_contact_no` varchar(15) NOT NULL,
  `documents` text NOT NULL,
  `documents_type` varchar(50) NOT NULL,
  `darta_documents` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bebasaya_darta`
--

INSERT INTO `bebasaya_darta` (`id`, `form_id`, `session_id`, `ward_login`, `status`, `nepali_date`, `date`, `certificate_no`, `org_name`, `owner_name`, `org_type`, `org_size`, `org_state`, `org_district`, `org_local_body`, `org_ward`, `prop_state`, `prop_district`, `prop_local_body`, `prop_ward`, `citizenship_no`, `citizenship_district`, `citizenship_date`, `father_name`, `lagat_pungi`, `sign_board`, `description`, `tole`, `road_name`, `house_own_name`, `home_no`, `org_email`, `org_contact_no`, `documents`, `documents_type`, `darta_documents`, `created_at`, `updated_at`) VALUES
(1, 7238541069, 2, 2, 3, '2076-05-11', '2019-08-28', 123456789, 'लालु चिया पसल', 'लालु', 'पसल', '', 3, 514, 2556, 2, 3, 514, 2556, 2, '7878964', 514, '2076-05-11', 'लाल बाबु', 100000, '15', 'testing', 'प्रगति टोल', '', 'लालु', 12, 'lalu@gmail.com', '9842134241', '5fc0d610726acafbbe0d25c69bd08ab8.jpg', '', 'Screenshot_(1)1.png', '2019-08-28 02:14:28', '2019-08-30 04:59:24');

-- --------------------------------------------------------

--
-- Table structure for table `bebasaya_sifaris`
--

CREATE TABLE `bebasaya_sifaris` (
  `id` int(11) NOT NULL,
  `form_id` bigint(20) NOT NULL,
  `session_id` int(11) NOT NULL,
  `ward_login` int(11) NOT NULL,
  `status` tinyint(3) NOT NULL,
  `nepali_date` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `org_name` text NOT NULL,
  `org_type` text NOT NULL,
  `org_state` int(11) NOT NULL,
  `org_district` int(11) NOT NULL,
  `org_local_body` int(11) NOT NULL,
  `org_ward` int(11) NOT NULL,
  `org_road_name` text NOT NULL,
  `org_home_no` varchar(8) NOT NULL,
  `org_phone` varchar(50) NOT NULL,
  `org_establish_nep_date` varchar(50) NOT NULL,
  `org_establish_eng_date` date NOT NULL,
  `org_punji` varchar(25) NOT NULL,
  `org_ownership` text NOT NULL,
  `home_owner` text NOT NULL,
  `home_owner_phone` varchar(50) NOT NULL,
  `home_fare` double NOT NULL,
  `kitta_no` varchar(25) NOT NULL,
  `land_type` enum('hill','terai') NOT NULL,
  `biggha` double NOT NULL,
  `kattha` double NOT NULL,
  `dhur` double NOT NULL,
  `paisa` double NOT NULL,
  `prop_name` text NOT NULL,
  `prop_phone` int(11) NOT NULL,
  `prop_road_name` text NOT NULL,
  `prop_home_no` int(11) NOT NULL,
  `prop_state` int(11) NOT NULL,
  `prop_district` int(11) NOT NULL,
  `prop_local_body` int(11) NOT NULL,
  `prop_ward` int(11) NOT NULL,
  `applicant_name` text NOT NULL,
  `applicant_phone` varchar(50) NOT NULL,
  `applicant_address` text NOT NULL,
  `documents` text NOT NULL,
  `documents_type` varchar(50) NOT NULL,
  `darta_documents` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bebasaya_sifaris`
--

INSERT INTO `bebasaya_sifaris` (`id`, `form_id`, `session_id`, `ward_login`, `status`, `nepali_date`, `date`, `org_name`, `org_type`, `org_state`, `org_district`, `org_local_body`, `org_ward`, `org_road_name`, `org_home_no`, `org_phone`, `org_establish_nep_date`, `org_establish_eng_date`, `org_punji`, `org_ownership`, `home_owner`, `home_owner_phone`, `home_fare`, `kitta_no`, `land_type`, `biggha`, `kattha`, `dhur`, `paisa`, `prop_name`, `prop_phone`, `prop_road_name`, `prop_home_no`, `prop_state`, `prop_district`, `prop_local_body`, `prop_ward`, `applicant_name`, `applicant_phone`, `applicant_address`, `documents`, `documents_type`, `darta_documents`, `created_at`, `updated_at`) VALUES
(2, 6745219380, 2, 2, 3, '2076-05-13', '2019-08-30', 'PDMT', 'IT Company', 3, 514, 2556, 2, 'Hanuman Das Road', '5', '9842134241', '2076-05-01', '2019-08-18', '1100000', 'Own', 'Dhiraj Pradhan', '9842134241', 0, '123', 'terai', 12, 2, 2, 0, 'Dhiraj Pradhan', 2147483647, 'Hanumandas road', 5, 3, 514, 2556, 2, 'Dhiraj Pradhan', '9842134241', 'Biratnagar-03', '5e84dc7f90c791500cb476ee640c808d.png', '', 'Visit-Nepal-100.png.png', '2019-08-30 02:47:31', '2019-08-30 09:02:49');

-- --------------------------------------------------------

--
-- Table structure for table `bibaha_pramanit`
--

CREATE TABLE `bibaha_pramanit` (
  `id` int(11) NOT NULL,
  `form_id` bigint(20) NOT NULL,
  `session_id` int(11) NOT NULL,
  `ward_login` int(11) NOT NULL,
  `status` tinyint(3) NOT NULL,
  `nepali_date` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `marriage_date` date NOT NULL,
  `marriage_date_nepali` varchar(50) NOT NULL,
  `marriage_type` int(11) NOT NULL,
  `g_name` text NOT NULL,
  `g_grand_father_name` text NOT NULL,
  `g_father_name` text NOT NULL,
  `g_mother_name` text NOT NULL,
  `g_state` int(11) NOT NULL,
  `g_district` int(11) NOT NULL,
  `g_local_body` int(11) NOT NULL,
  `g_ward` int(11) NOT NULL,
  `g_old_address` int(11) NOT NULL,
  `g_citizenship_no` varchar(125) NOT NULL,
  `b_citizenship_no` varchar(125) NOT NULL,
  `b_name` text NOT NULL,
  `b_grand_father_name` text NOT NULL,
  `b_father_name` text NOT NULL,
  `b_mother_name` text NOT NULL,
  `b_state` text NOT NULL,
  `b_district` text NOT NULL,
  `b_local_body` text NOT NULL,
  `b_ward` text NOT NULL,
  `b_old_address` int(11) NOT NULL,
  `documents` text NOT NULL,
  `documents_type` varchar(50) NOT NULL,
  `darta_documents` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bibaha_pramanit`
--

INSERT INTO `bibaha_pramanit` (`id`, `form_id`, `session_id`, `ward_login`, `status`, `nepali_date`, `date`, `marriage_date`, `marriage_date_nepali`, `marriage_type`, `g_name`, `g_grand_father_name`, `g_father_name`, `g_mother_name`, `g_state`, `g_district`, `g_local_body`, `g_ward`, `g_old_address`, `g_citizenship_no`, `b_citizenship_no`, `b_name`, `b_grand_father_name`, `b_father_name`, `b_mother_name`, `b_state`, `b_district`, `b_local_body`, `b_ward`, `b_old_address`, `documents`, `documents_type`, `darta_documents`, `created_at`, `updated_at`) VALUES
(1, 4682950371, 2, 2, 3, '2076-04-10', '2019-07-26', '2019-07-26', '2076-04-10', 1, 'Pradip Chaudhary', 'Ram chaudhary', 'Hari Chaudhary', 'Sita Chaudhary', 3, 514, 2556, 2, 1, '987547', '4474', 'Sushma Chaudhary', 'Harka chaudhary', 'shyam Chaudhary', 'fulkumari chaudhary', '3', '514', '2556', '2', 2, '', '', 'Screenshot_(1).png.png', '2019-07-26 12:39:35', '2019-07-26 06:55:26');

-- --------------------------------------------------------

--
-- Table structure for table `bidhut_jadan`
--

CREATE TABLE `bidhut_jadan` (
  `id` int(11) NOT NULL,
  `form_id` bigint(20) NOT NULL,
  `session_id` int(11) NOT NULL,
  `ward_login` int(11) NOT NULL,
  `status` tinyint(3) NOT NULL,
  `nepali_date` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `land_type` text NOT NULL,
  `name` text NOT NULL,
  `electricity_use_type` int(11) NOT NULL,
  `house_type` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `district` int(11) NOT NULL,
  `local_body` int(11) NOT NULL,
  `ward_no` varchar(50) NOT NULL,
  `old_address` int(11) NOT NULL,
  `ampere` varchar(50) NOT NULL,
  `kitta_no` text NOT NULL,
  `documents` text NOT NULL,
  `documents_type` varchar(50) NOT NULL,
  `darta_documents` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bidhut_jadan`
--

INSERT INTO `bidhut_jadan` (`id`, `form_id`, `session_id`, `ward_login`, `status`, `nepali_date`, `date`, `land_type`, `name`, `electricity_use_type`, `house_type`, `state`, `district`, `local_body`, `ward_no`, `old_address`, `ampere`, `kitta_no`, `documents`, `documents_type`, `darta_documents`, `created_at`, `updated_at`) VALUES
(1, 5709128463, 2, 2, 3, '2076-04-12', '2019-07-28', 'निजि', 'Dhiraj Pradhan', 1, 2, 3, 514, 2556, '2', 0, '123', '123', '', '', 'Screenshot_(1).png.png', '2019-07-28 05:04:24', '2019-07-28 11:19:32');

-- --------------------------------------------------------

--
-- Table structure for table `chalani`
--

CREATE TABLE `chalani` (
  `id` int(11) NOT NULL,
  `form_id` bigint(10) NOT NULL,
  `session_id` int(11) NOT NULL,
  `darta_id` int(11) NOT NULL,
  `is_muncipality` enum('0','1') NOT NULL,
  `type` int(11) NOT NULL,
  `chalani_type` enum('1','2','') DEFAULT '',
  `chalani_no` bigint(20) NOT NULL,
  `ward_login` int(11) NOT NULL,
  `applicant_name` text NOT NULL,
  `nepali_chalani_miti` varchar(80) NOT NULL,
  `english_chalani_miti` date NOT NULL,
  `uri` varchar(80) NOT NULL,
  `letter_subject` text NOT NULL,
  `department` int(11) NOT NULL,
  `department_other` text NOT NULL,
  `office` int(11) NOT NULL,
  `patra_miti_nep` varchar(80) NOT NULL,
  `patra_miti_eng` date NOT NULL,
  `patra_wahak_naam` text NOT NULL,
  `patra_wahak_contact` bigint(20) NOT NULL,
  `description` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `chalani_documents` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chalani`
--

INSERT INTO `chalani` (`id`, `form_id`, `session_id`, `darta_id`, `is_muncipality`, `type`, `chalani_type`, `chalani_no`, `ward_login`, `applicant_name`, `nepali_chalani_miti`, `english_chalani_miti`, `uri`, `letter_subject`, `department`, `department_other`, `office`, `patra_miti_nep`, `patra_miti_eng`, `patra_wahak_naam`, `patra_wahak_contact`, `description`, `user_id`, `chalani_documents`) VALUES
(1, 2154386790, 2, 1, '0', 20, '1', 1, 2, 'धिरज प्रधान', '2076-4-10', '2019-07-26', 'antarik-basai-sarai', '', 0, '', 0, '', '0000-00-00', '', 0, '', 17, ''),
(2, 1769530428, 2, 1, '0', 19, '1', 25, 2, 'Amulya Sharma', '2076-4-12', '2019-07-28', 'asthai-basobas', '', 0, '', 0, '', '0000-00-00', '', 0, '', 17, ''),
(3, 4682950371, 0, 1, '0', 23, '1', 2, 2, '', '', '0000-00-00', '', '', 0, '', 0, '', '0000-00-00', '', 0, '', 0, ''),
(4, 4215980736, 2, 1, '0', 24, '1', 3, 2, 'Dhiraj Pradhan', '2076-4-10', '2019-07-26', 'khanepani-jadan', '', 0, '', 0, '', '0000-00-00', '', 0, '', 17, ''),
(5, 4278619503, 2, 1, '0', 30, '1', 4, 2, 'Dhiraj Pradhan', '2076-4-10', '2019-07-26', 'sadak-khanne-swikriti', '', 0, '', 0, '', '0000-00-00', '', 0, '', 17, ''),
(6, 7984162530, 2, 1, '0', 35, '1', 5, 2, 'एत्स्त', '2076-4-10', '2019-07-26', 'nata-pramanit', '', 0, '', 0, '', '0000-00-00', '', 0, '', 17, ''),
(7, 1543987026, 2, 1, '0', 2, '1', 6, 2, 'Dhiraj Pradhan', '2076-4-10', '2019-07-26', 'home-road-certify', '', 0, '', 0, '', '0000-00-00', '', 0, '', 17, ''),
(8, 6053729418, 2, 1, '0', 5, '1', 7, 2, 'लालु चिया पसल', '2076-4-10', '2019-07-26', 'sanstha-darta-pramanpatra', '', 0, '', 0, '', '0000-00-00', '', 0, '', 17, ''),
(9, 3248059671, 2, 1, '0', 10, '1', 8, 2, 'Dhiraj Pradhan', '2076-4-10', '2019-07-26', 'income-verification', '', 0, '', 0, '', '0000-00-00', '', 0, '', 17, ''),
(10, 1309245687, 2, 1, '0', 16, '1', 9, 2, 'Dhiraj Pradhan', '2076-4-10', '2019-07-26', 'char-killa', '', 0, '', 0, '', '0000-00-00', '', 0, '', 17, ''),
(11, 791254683, 2, 1, '0', 39, '1', 10, 2, 'Dhiraj Pradhan', '2076-4-10', '2019-07-26', 'ghar-patala', '', 0, '', 0, '', '0000-00-00', '', 0, '', 17, ''),
(12, 1264583907, 2, 1, '1', 1, '1', 1, 1, 'Dhiraj Pradhan', '2076-4-12', '2019-07-28', 'home-recommend', '', 1, '', 0, '', '0000-00-00', '', 0, '', 1, ''),
(13, 1845762039, 2, 2, '0', 1, '1', 11, 2, 'Dhiraj Pradhan', '2076-4-12', '2019-07-28', 'home-recommend', '', 0, '', 0, '', '0000-00-00', '', 0, '', 17, ''),
(14, 6089472315, 2, 1, '0', 3, '1', 12, 2, 'Ram Bahadur Thapa', '2076-4-12', '2019-07-28', 'ghar-jagga-namsari', '', 0, '', 0, '', '0000-00-00', '', 0, '', 17, ''),
(15, 8601547932, 2, 1, '0', 4, '1', 13, 2, 'Dhiraj Pradhan', '2076-4-12', '2019-07-28', 'kitta-kat-sifaris', '', 0, '', 0, '', '0000-00-00', '', 0, '', 17, ''),
(16, 8046591372, 2, 1, '0', 6, '1', 14, 2, 'लालु चिया पसल', '2076-4-12', '2019-07-28', 'bebasaya-darta', '', 0, '', 0, '', '0000-00-00', '', 0, '', 17, ''),
(17, 1258734609, 2, 1, '0', 7, '1', 15, 2, 'लालु चिया पसल', '2076-4-12', '2019-07-28', 'bebasaya-banda', '', 0, '', 0, '', '0000-00-00', '', 0, '', 17, ''),
(18, 7529683041, 2, 1, '0', 8, '1', 16, 2, 'लालु चिया पसल', '2076-4-12', '2019-07-28', 'sanstha-darta', '', 0, '', 0, '', '0000-00-00', '', 0, '', 17, ''),
(19, 8260914573, 2, 1, '0', 9, '1', 17, 2, 'लालु चिया पसल', '2076-4-12', '2019-07-28', 'sanstha-nabikaran', '', 0, '', 0, '', '0000-00-00', '', 0, '', 17, ''),
(20, 2815479603, 2, 1, '0', 17, '1', 18, 2, 'asdasas', '2076-4-12', '2019-07-28', 'mohi-lagat-katta', '', 0, '', 0, '', '0000-00-00', '', 0, '', 17, ''),
(21, 7836495120, 2, 1, '0', 15, '1', 19, 2, 'Dhiraj Pradhan', '2076-4-12', '2019-07-28', 'purjama-ghar-kayam', '', 0, '', 0, '', '0000-00-00', '', 0, '', 17, ''),
(22, 3672804159, 2, 1, '0', 14, '1', 20, 2, 'sASDF', '2076-4-12', '2019-07-28', 'bato-kayam', '', 0, '', 0, '', '0000-00-00', '', 0, '', 17, ''),
(23, 8942013675, 2, 1, '0', 13, '1', 21, 2, 'Dhiraj Pradhan', '2076-4-12', '2019-07-28', 'lalpurja-pratilipi', '', 0, '', 0, '', '0000-00-00', '', 0, '', 17, ''),
(24, 2543079618, 2, 1, '0', 11, '1', 22, 2, 'df', '2076-4-12', '2019-07-28', 'property-valuation', '', 0, '', 0, '', '0000-00-00', '', 0, '', 17, ''),
(25, 834912765, 2, 1, '0', 12, '2', 23, 2, 'Dhiraj Pradhan', '2076-4-12', '2019-07-28', 'tax-clearance', '', 0, '', 0, '', '0000-00-00', '', 0, '', 17, ''),
(26, 7912835046, 2, 1, '0', 18, '1', 24, 2, 'Dhiraj Pradhan', '2076-4-12', '2019-07-28', 'sthai-basobas', '', 0, '', 0, '', '0000-00-00', '', 0, '', 17, ''),
(27, 3720695841, 2, 1, '0', 41, '1', 26, 2, 'df', '2076-4-12', '2019-07-28', 'mirtyu-darta', '', 0, '', 0, '', '0000-00-00', '', 0, '', 17, ''),
(28, 4756120983, 2, 1, '0', 26, '1', 27, 2, 'Ram Basnet', '2076-4-12', '2019-07-28', 'abibhahit-pramanpatra', '', 0, '', 0, '', '0000-00-00', '', 0, '', 17, ''),
(29, 2019534768, 2, 1, '0', 27, '1', 28, 2, 'dasdasd', '2076-4-12', '2019-07-28', 'janma-miti-pramanit', '', 0, '', 0, '', '0000-00-00', '', 0, '', 17, ''),
(30, 9372140685, 2, 1, '0', 41, '1', 29, 2, 'df', '2076-4-12', '2019-07-28', 'apanga-pramanpatra', '', 0, '', 0, '', '0000-00-00', '', 0, '', 17, ''),
(31, 8607953421, 2, 1, '0', 34, '1', 30, 2, 'Dhiraj Pradhan', '2076-4-12', '2019-07-28', 'kotha-khali-suchana', '', 0, '', 0, '', '0000-00-00', '', 0, '', 17, ''),
(32, 2031869754, 2, 1, '0', 40, '1', 31, 2, 'Satya Narayan Bidhyalaya', '2076-4-12', '2019-07-28', 'add-classroom', '', 0, '', 0, '', '0000-00-00', '', 0, '', 17, ''),
(33, 5867320914, 2, 1, '0', 38, '1', 32, 2, 'df', '2076-4-12', '2019-07-28', 'arthik-saheta', '', 0, '', 0, '', '0000-00-00', '', 0, '', 17, ''),
(34, 8192473605, 2, 1, '0', 37, '1', 33, 2, '-', '2076-4-12', '2019-07-28', 'prabhidik-mulyankan', '', 0, '', 0, '', '0000-00-00', '', 0, '', 17, ''),
(35, 8642571930, 2, 1, '0', 36, '1', 34, 2, 'Ram Basnet', '2076-4-12', '2019-07-28', 'tin-pusta-pramanit', '', 0, '', 0, '', '0000-00-00', '', 0, '', 17, ''),
(36, 7341960825, 2, 1, '0', 33, '1', 35, 2, 'Dhiraj Pradhan', '2076-4-12', '2019-07-28', 'court-fee', '', 0, '', 0, '', '0000-00-00', '', 0, '', 17, ''),
(37, 6810259473, 2, 1, '0', 31, '1', 36, 2, 'Dhiraj Pradhan', '2076-4-12', '2019-07-28', 'hakdar-pramanit', '', 0, '', 0, '', '0000-00-00', '', 0, '', 17, ''),
(38, 7891536420, 2, 2, '0', 30, '1', 37, 2, 'Dhiraj Pradhan', '2076-4-12', '2019-07-28', 'sadak-khanne-swikriti', '', 0, '', 0, '', '0000-00-00', '', 0, '', 17, ''),
(39, 7016385249, 2, 1, '0', 29, '1', 38, 2, 'Dhiraj Pradhanq', '2076-4-12', '2019-07-28', 'farak-nam-thar', '', 0, '', 0, '', '0000-00-00', '', 0, '', 17, ''),
(40, 5614837290, 2, 1, '0', 28, '1', 39, 2, '-', '2076-4-12', '2019-07-28', 'jet-machine', '', 0, '', 0, '', '0000-00-00', '', 0, '', 17, ''),
(41, 5709128463, 2, 1, '0', 25, '1', 40, 2, '-', '2076-4-12', '2019-07-28', 'biduth-jadan', '', 0, '', 0, '', '0000-00-00', '', 0, '', 17, ''),
(42, 7108942635, 0, 0, '0', 0, '1', 0, 0, '', '', '0000-00-00', '', '', 0, '', 0, '', '0000-00-00', '', 0, '', 0, ''),
(43, 7031645982, 0, 0, '0', 0, '1', 0, 0, '', '', '0000-00-00', '', '', 0, '', 0, '', '0000-00-00', '', 0, '', 0, ''),
(44, 8651407392, 0, 0, '0', 0, '1', 0, 0, '', '', '0000-00-00', '', '', 0, '', 0, '', '0000-00-00', '', 0, '', 0, ''),
(45, 2076539481, 0, 0, '0', 0, '1', 0, 0, '', '', '0000-00-00', '', '', 0, '', 0, '', '0000-00-00', '', 0, '', 0, ''),
(46, 7496513820, 0, 0, '0', 0, '1', 0, 0, '', '', '0000-00-00', '', '', 0, '', 0, '', '0000-00-00', '', 0, '', 0, ''),
(47, 8723501496, 0, 0, '0', 0, '1', 0, 0, '', '', '0000-00-00', '', '', 0, '', 0, '', '0000-00-00', '', 0, '', 0, ''),
(48, 8721365409, 0, 0, '0', 0, '1', 0, 0, '', '', '0000-00-00', '', '', 0, '', 0, '', '0000-00-00', '', 0, '', 0, ''),
(49, 6428791503, 0, 0, '0', 0, '1', 0, 0, '', '', '0000-00-00', '', '', 0, '', 0, '', '0000-00-00', '', 0, '', 0, ''),
(50, 3982561074, 0, 0, '0', 0, '1', 0, 0, '', '', '0000-00-00', '', '', 0, '', 0, '', '0000-00-00', '', 0, '', 0, ''),
(51, 5764038291, 0, 0, '0', 0, '1', 0, 0, '', '', '0000-00-00', '', '', 0, '', 0, '', '0000-00-00', '', 0, '', 0, ''),
(52, 7914053286, 0, 0, '0', 0, '1', 0, 0, '', '', '0000-00-00', '', '', 0, '', 0, '', '0000-00-00', '', 0, '', 0, ''),
(53, 5381290746, 0, 0, '0', 0, '1', 0, 0, '', '', '0000-00-00', '', '', 0, '', 0, '', '0000-00-00', '', 0, '', 0, ''),
(54, 687251394, 0, 0, '0', 0, '1', 0, 0, '', '', '0000-00-00', '', '', 0, '', 0, '', '0000-00-00', '', 0, '', 0, ''),
(55, 1879346520, 2, 0, '0', 0, '1', 41, 2, '', '2076-4-21', '2019-08-06', '', 'पुल निर्माण', 0, '', 0, '', '0000-00-00', '', 0, '', 17, ''),
(56, 5370281649, 0, 0, '0', 0, '1', 0, 0, '', '', '0000-00-00', '', '', 0, '', 0, '', '0000-00-00', '', 0, '', 0, ''),
(57, 815923467, 0, 0, '0', 0, '1', 0, 0, '', '', '0000-00-00', '', '', 0, '', 0, '', '0000-00-00', '', 0, '', 0, ''),
(58, 549268173, 0, 0, '0', 0, '1', 0, 0, '', '', '0000-00-00', '', '', 0, '', 0, '', '0000-00-00', '', 0, '', 0, ''),
(59, 486372591, 0, 0, '0', 0, '1', 0, 0, '', '', '0000-00-00', '', '', 0, '', 0, '', '0000-00-00', '', 0, '', 0, ''),
(60, 2754903861, 0, 0, '0', 0, '1', 0, 0, '', '', '0000-00-00', '', '', 0, '', 0, '', '0000-00-00', '', 0, '', 0, ''),
(61, 2438769510, 2, 0, '0', 0, '1', 42, 2, 'asdsda', '2076-4-21', '2019-08-06', '', 'पुल निर्माण', 0, '', 0, '', '0000-00-00', '', 0, '', 17, ''),
(62, 4527106839, 0, 0, '0', 0, '1', 0, 0, '', '', '0000-00-00', '', '', 0, '', 0, '', '0000-00-00', '', 0, '', 0, ''),
(63, 5083174296, 0, 0, '0', 0, '1', 0, 0, '', '', '0000-00-00', '', '', 0, '', 0, '', '0000-00-00', '', 0, '', 0, ''),
(64, 9645387210, 0, 0, '0', 0, '1', 0, 0, '', '', '0000-00-00', '', '', 0, '', 0, '', '0000-00-00', '', 0, '', 0, ''),
(65, 2068745193, 0, 0, '0', 0, '1', 0, 0, '', '', '0000-00-00', '', '', 0, '', 0, '', '0000-00-00', '', 0, '', 0, ''),
(66, 6453702891, 0, 0, '0', 0, '1', 0, 0, '', '', '0000-00-00', '', '', 0, '', 0, '', '0000-00-00', '', 0, '', 0, ''),
(67, 7432658109, 0, 0, '0', 0, '1', 0, 0, '', '', '0000-00-00', '', '', 0, '', 0, '', '0000-00-00', '', 0, '', 0, ''),
(68, 6752103948, 0, 0, '0', 0, '1', 0, 0, '', '', '0000-00-00', '', '', 0, '', 0, '', '0000-00-00', '', 0, '', 0, ''),
(69, 6549203718, 0, 0, '0', 0, '1', 0, 0, '', '', '0000-00-00', '', '', 0, '', 0, '', '0000-00-00', '', 0, '', 0, ''),
(70, 3980674521, 2, 0, '1', 0, '1', 2, 1, 'Dhiraj Pradhan', '2076-4-29', '2019-08-14', '', 'संस्था दर्ता', 0, '', 0, '2076-04-29', '2019-08-14', 'Amit Khanal', 9842134241, 'sad', 0, ''),
(71, 7452386091, 2, 0, '1', 0, '1', 3, 1, 'Dhiraj Pradhan124', '2076-4-29', '2019-08-14', '', 'संस्था दर्ता', 0, '', 0, '2076-04-29', '2019-08-14', 'asdasd', 9842134241, 'sad', 0, ''),
(72, 1793045862, 2, 0, '1', 0, '1', 4, 1, 'Sanjay Karki123', '2076-4-29', '2019-08-14', '', 'संस्था दर्ता', 0, '', 0, '2076-04-29', '2019-08-14', 'Amulya Sharma', 9842134241, 'sad', 0, ''),
(73, 7238541069, 2, 1, '0', 6, '1', 43, 2, 'लालु चिया पसल', '2076-5-11', '2019-08-28', 'bebasaya-darta', '', 0, '', 0, '', '0000-00-00', '', 0, '', 17, ''),
(77, 6745219380, 2, 2, '0', 2, '1', 44, 2, 'PDMT', '2076-5-13', '2019-08-30', 'bebasaya-sifaris', '', 0, '', 0, '', '0000-00-00', '', 0, '', 17, ''),
(78, 6745219380, 2, 0, '0', 2, '2', 45, 2, 'PDMT', '2076-5-13', '2019-08-30', 'bebasaya-sifaris', '', 0, '', 0, '', '0000-00-00', '', 0, '', 17, '');

-- --------------------------------------------------------

--
-- Table structure for table `charkilla_details`
--

CREATE TABLE `charkilla_details` (
  `id` int(11) NOT NULL,
  `killa_id` int(11) NOT NULL,
  `old_address` int(11) NOT NULL,
  `new_address` text NOT NULL,
  `map_sheet_no` varchar(50) NOT NULL,
  `kitta_no` varchar(50) NOT NULL,
  `biggha` float NOT NULL,
  `kattha` float NOT NULL,
  `dhur` float NOT NULL,
  `paisa` float NOT NULL,
  `road` float NOT NULL,
  `road_type` float NOT NULL,
  `east_piller` text NOT NULL,
  `west_piller` text NOT NULL,
  `north_piller` text NOT NULL,
  `south_piller` text NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `charkilla_details`
--

INSERT INTO `charkilla_details` (`id`, `killa_id`, `old_address`, `new_address`, `map_sheet_no`, `kitta_no`, `biggha`, `kattha`, `dhur`, `paisa`, `road`, `road_type`, `east_piller`, `west_piller`, `north_piller`, `south_piller`, `description`) VALUES
(1, 1, 1, 'गजुरी गाउँपालिका १', '१२', '12', 1, 2, 1, 2, 1, 1, 'कि.न. ३२६, गोरेटो', 'बाटो', '३२७', 'खोला', '                            ');

-- --------------------------------------------------------

--
-- Table structure for table `char_killa`
--

CREATE TABLE `char_killa` (
  `id` int(11) NOT NULL,
  `form_id` bigint(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `ward_login` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `office` int(11) NOT NULL,
  `nepali_date` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `applicant_name` text NOT NULL,
  `state` int(11) NOT NULL,
  `district` int(11) NOT NULL,
  `local_body` int(11) NOT NULL,
  `ward` int(11) NOT NULL,
  `land_type` enum('hill','terai') NOT NULL,
  `documents` text NOT NULL,
  `documents_type` int(11) NOT NULL,
  `darta_documents` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `char_killa`
--

INSERT INTO `char_killa` (`id`, `form_id`, `session_id`, `ward_login`, `status`, `office`, `nepali_date`, `date`, `applicant_name`, `state`, `district`, `local_body`, `ward`, `land_type`, `documents`, `documents_type`, `darta_documents`, `created_at`, `updated_at`) VALUES
(1, 1309245687, 2, 2, 3, 2, '2019-7-26', '2019-07-26', 'Dhiraj Pradhan', 3, 514, 2556, 2, 'hill', '', 0, 'Screenshot_(1).png.png', '2019-07-26 04:07:21', '2019-07-26 10:22:31');

-- --------------------------------------------------------

--
-- Table structure for table `citizen_certificate`
--

CREATE TABLE `citizen_certificate` (
  `id` int(11) NOT NULL,
  `form_id` bigint(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `ward_login` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `nepali_date` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `office` text NOT NULL,
  `nep_first_name` text NOT NULL,
  `nep_middle_name` text NOT NULL,
  `nep_last_name` text NOT NULL,
  `eng_first_name` text NOT NULL,
  `eng_middle_name` text NOT NULL,
  `eng_last_name` text NOT NULL,
  `gender` text NOT NULL,
  `nep_dob` varchar(50) NOT NULL,
  `eng_dob` date NOT NULL,
  `b_state` int(11) NOT NULL,
  `b_district` int(11) NOT NULL,
  `b_local_body` int(11) NOT NULL,
  `b_ward` int(11) NOT NULL,
  `nep_bp_tole` text NOT NULL,
  `eng_bp_tole` text NOT NULL,
  `p_state` int(11) NOT NULL,
  `p_district` int(11) NOT NULL,
  `p_local_body` int(11) NOT NULL,
  `p_ward` int(11) NOT NULL,
  `nep_tole` text NOT NULL,
  `eng_tole` text NOT NULL,
  `father_name` text NOT NULL,
  `f_citizenship_no` varchar(50) NOT NULL,
  `f_state` int(11) NOT NULL,
  `f_district` int(11) NOT NULL,
  `f_local_body` int(11) NOT NULL,
  `f_ward` int(11) NOT NULL,
  `f_tole` text NOT NULL,
  `mother_name` text NOT NULL,
  `m_citizenship_no` text NOT NULL,
  `m_state` int(11) NOT NULL,
  `m_district` int(11) NOT NULL,
  `m_local_body` int(11) NOT NULL,
  `m_ward` int(11) NOT NULL,
  `m_tole` text NOT NULL,
  `husband_wife_name` text NOT NULL,
  `hw_citizenship_no` text NOT NULL,
  `hw_state` int(11) NOT NULL,
  `hw_district` int(11) NOT NULL,
  `hw_local_body` int(11) NOT NULL,
  `hw_ward` int(11) NOT NULL,
  `hw_tole` text NOT NULL,
  `protector_name` text NOT NULL,
  `s_state` int(11) NOT NULL,
  `s_district` int(11) NOT NULL,
  `s_local_body` int(11) NOT NULL,
  `s_ward` int(11) NOT NULL,
  `p_tole` text NOT NULL,
  `documents` text NOT NULL,
  `documents_type` text NOT NULL,
  `darta_documents` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `citizen_certificate`
--

INSERT INTO `citizen_certificate` (`id`, `form_id`, `session_id`, `ward_login`, `status`, `nepali_date`, `date`, `office`, `nep_first_name`, `nep_middle_name`, `nep_last_name`, `eng_first_name`, `eng_middle_name`, `eng_last_name`, `gender`, `nep_dob`, `eng_dob`, `b_state`, `b_district`, `b_local_body`, `b_ward`, `nep_bp_tole`, `eng_bp_tole`, `p_state`, `p_district`, `p_local_body`, `p_ward`, `nep_tole`, `eng_tole`, `father_name`, `f_citizenship_no`, `f_state`, `f_district`, `f_local_body`, `f_ward`, `f_tole`, `mother_name`, `m_citizenship_no`, `m_state`, `m_district`, `m_local_body`, `m_ward`, `m_tole`, `husband_wife_name`, `hw_citizenship_no`, `hw_state`, `hw_district`, `hw_local_body`, `hw_ward`, `hw_tole`, `protector_name`, `s_state`, `s_district`, `s_local_body`, `s_ward`, `p_tole`, `documents`, `documents_type`, `darta_documents`, `created_at`, `updated_at`) VALUES
(1, 582917346, 2, 2, 3, '2076-05-12', '2019-08-29', 'qweqw', 'धिरज', '', 'प्रधान', 'Dhiraj', '', 'Pradhan', 'Male', '2054-07-22', '1997-11-07', 3, 514, 2556, 2, 'प्रगति टोल', 'Pragati Tole', 3, 514, 2556, 2, 'प्रगति टोल', 'Pragati Tole', 'निर कुमार प्रधान', '154578', 3, 514, 2556, 2, 'प्रगति टोल', 'रुपा प्रधान', '7977', 3, 514, 2556, 2, 'प्रगति टोल', '', '', 3, 0, 0, 0, '', 'निर कुमार प्रधान', 3, 514, 2556, 2, 'प्रगति टोल', 'a5bb029a9d49c9d83c4b7a1a04dfee92.png', '5', 'Visit-Nepal-100.png.png', '2019-08-29 05:04:33', '2019-08-29 11:23:17');

-- --------------------------------------------------------

--
-- Table structure for table `citizen_certificate_pratilipi`
--

CREATE TABLE `citizen_certificate_pratilipi` (
  `id` int(11) NOT NULL,
  `form_id` bigint(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `ward_login` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `nepali_date` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `office` text NOT NULL,
  `nep_first_name` text NOT NULL,
  `nep_middle_name` text NOT NULL,
  `nep_last_name` text NOT NULL,
  `eng_first_name` text NOT NULL,
  `eng_middle_name` text NOT NULL,
  `eng_last_name` text NOT NULL,
  `gender` text NOT NULL,
  `nep_dob` varchar(50) NOT NULL,
  `eng_dob` date NOT NULL,
  `b_state` int(11) NOT NULL,
  `b_district` int(11) NOT NULL,
  `b_local_body` int(11) NOT NULL,
  `b_ward` int(11) NOT NULL,
  `nep_bp_tole` text NOT NULL,
  `eng_bp_tole` text NOT NULL,
  `p_state` int(11) NOT NULL,
  `p_district` int(11) NOT NULL,
  `p_local_body` int(11) NOT NULL,
  `p_ward` int(11) NOT NULL,
  `nep_tole` text NOT NULL,
  `eng_tole` text NOT NULL,
  `father_name` text NOT NULL,
  `f_citizenship_no` varchar(50) NOT NULL,
  `f_state` int(11) NOT NULL,
  `f_district` int(11) NOT NULL,
  `f_local_body` int(11) NOT NULL,
  `f_ward` int(11) NOT NULL,
  `f_tole` text NOT NULL,
  `mother_name` text NOT NULL,
  `m_citizenship_no` text NOT NULL,
  `m_state` int(11) NOT NULL,
  `m_district` int(11) NOT NULL,
  `m_local_body` int(11) NOT NULL,
  `m_ward` int(11) NOT NULL,
  `m_tole` text NOT NULL,
  `husband_wife_name` text NOT NULL,
  `hw_citizenship_no` text NOT NULL,
  `hw_state` int(11) NOT NULL,
  `hw_district` int(11) NOT NULL,
  `hw_local_body` int(11) NOT NULL,
  `hw_ward` int(11) NOT NULL,
  `hw_tole` text NOT NULL,
  `protector_name` text NOT NULL,
  `s_state` int(11) NOT NULL,
  `s_district` int(11) NOT NULL,
  `s_local_body` int(11) NOT NULL,
  `s_ward` int(11) NOT NULL,
  `p_tole` text NOT NULL,
  `documents` text NOT NULL,
  `documents_type` text NOT NULL,
  `darta_documents` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `citizenship_no` varchar(50) NOT NULL,
  `citizenship_reg_date` varchar(50) NOT NULL,
  `citizenship_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `court_fee`
--

CREATE TABLE `court_fee` (
  `id` int(11) NOT NULL,
  `form_id` bigint(20) NOT NULL,
  `session_id` int(11) NOT NULL,
  `ward_login` int(11) NOT NULL,
  `status` tinyint(3) NOT NULL,
  `nepali_date` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `applicant_name` text NOT NULL,
  `gender` int(1) NOT NULL,
  `husband_wife_name` text NOT NULL,
  `court_name` int(11) NOT NULL,
  `case_type` text NOT NULL,
  `nepali_visit_date` varchar(50) NOT NULL,
  `english_visit_date` date NOT NULL,
  `state` int(11) NOT NULL,
  `district` int(11) NOT NULL,
  `local_body` int(11) NOT NULL,
  `ward` int(11) NOT NULL,
  `old_place` text NOT NULL,
  `documents` text NOT NULL,
  `documents_type` varchar(20) NOT NULL,
  `darta_documents` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `court_fee`
--

INSERT INTO `court_fee` (`id`, `form_id`, `session_id`, `ward_login`, `status`, `nepali_date`, `date`, `applicant_name`, `gender`, `husband_wife_name`, `court_name`, `case_type`, `nepali_visit_date`, `english_visit_date`, `state`, `district`, `local_body`, `ward`, `old_place`, `documents`, `documents_type`, `darta_documents`, `created_at`, `updated_at`) VALUES
(1, 7341960825, 2, 2, 3, '2076-04-12', '2019-07-28', 'Dhiraj Pradhan', 1, 'asasd', 481, 'sadasd', '2076-04-12', '2019-07-28', 3, 514, 2556, 2, 'dgdv', '', '', 'Screenshot_(1).png.png', '2019-07-28 04:22:05', '2019-07-28 10:37:17');

-- --------------------------------------------------------

--
-- Table structure for table `darta`
--

CREATE TABLE `darta` (
  `id` int(11) NOT NULL,
  `form_id` bigint(20) NOT NULL,
  `session_id` int(11) NOT NULL,
  `is_muncipality` enum('0','1') NOT NULL,
  `darta_no` bigint(20) NOT NULL,
  `patra_chalani_no` int(11) NOT NULL,
  `is_complete` enum('0','1') NOT NULL DEFAULT '0',
  `ward_login` int(11) NOT NULL,
  `department` varchar(10) NOT NULL,
  `link` text NOT NULL,
  `nepali_darta_miti` varchar(50) NOT NULL,
  `english_darta_miti` date NOT NULL,
  `sifaris_id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `applicant_name` text NOT NULL,
  `uri` varchar(100) NOT NULL,
  `letter_subject` text NOT NULL,
  `letter_type` enum('important','most_important','deadlined') NOT NULL,
  `state` int(11) NOT NULL,
  `district` int(11) NOT NULL,
  `local_body` int(11) NOT NULL,
  `ward` int(11) NOT NULL,
  `darta_documents` text NOT NULL,
  `description` text NOT NULL,
  `deadline_nep` varchar(80) NOT NULL,
  `deadline_eng` date NOT NULL,
  `transfer_date_nep` varchar(80) NOT NULL,
  `transfer_date_eng` date NOT NULL,
  `patra_miti_nep` varchar(80) NOT NULL,
  `patra_miti_eng` date NOT NULL,
  `karmachari_name` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `maujuda_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `darta`
--

INSERT INTO `darta` (`id`, `form_id`, `session_id`, `is_muncipality`, `darta_no`, `patra_chalani_no`, `is_complete`, `ward_login`, `department`, `link`, `nepali_darta_miti`, `english_darta_miti`, `sifaris_id`, `type`, `applicant_name`, `uri`, `letter_subject`, `letter_type`, `state`, `district`, `local_body`, `ward`, `darta_documents`, `description`, `deadline_nep`, `deadline_eng`, `transfer_date_nep`, `transfer_date_eng`, `patra_miti_nep`, `patra_miti_eng`, `karmachari_name`, `user_id`, `maujuda_id`) VALUES
(1, 0, 0, '1', 1, 0, '0', 0, '', '', '2076-4-10', '2019-07-26', 0, 0, '', '', '', 'important', 0, 0, 0, 0, '', '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 0, 0),
(2, 0, 0, '1', 2, 0, '0', 1, '', '', '2076-4-10', '2019-07-26', 0, 0, '', '', '', 'important', 0, 0, 0, 0, '', '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 0, 0),
(3, 2154386790, 2, '0', 1, 0, '0', 2, '', '', '2076-4-10', '2019-07-26', 1, 1, 'धिरज प्रधान', 'antarik-basai-sarai', '', 'important', 0, 0, 0, 0, 'Screenshot_(1).png.png', '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 17, 0),
(4, 4682950371, 2, '0', 2, 0, '0', 2, '', '', '2076-4-10', '2019-07-26', 1, 1, 'Pradip Chaudhary', 'bibaha-pramanit', '', 'important', 0, 0, 0, 0, 'Screenshot_(1).png.png', '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 17, 0),
(5, 4215980736, 2, '0', 3, 0, '0', 2, '', '', '2076-4-10', '2019-07-26', 1, 1, 'Dhiraj Pradhan', 'khanepani-jadan', '', 'important', 0, 0, 0, 0, 'Screenshot_(1).png.png', '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 17, 0),
(6, 4278619503, 2, '0', 4, 0, '0', 2, '', '', '2076-4-10', '2019-07-26', 1, 1, 'Dhiraj Pradhan', 'sadak-khanne-swikriti', '', 'important', 0, 0, 0, 0, 'Screenshot_(1).png.png', '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 17, 0),
(7, 7984162530, 2, '0', 5, 0, '0', 2, '', '', '2076-4-10', '2019-07-26', 1, 1, 'एत्स्त', 'nata-pramanit', '', 'important', 0, 0, 0, 0, 'Screenshot_(1).png.png', '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 17, 0),
(8, 1543987026, 2, '0', 6, 0, '0', 2, '', '', '2076-4-10', '2019-07-26', 1, 1, 'Dhiraj Pradhan', 'home-road-certify', '', 'important', 0, 0, 0, 0, 'Screenshot_(1).png.png', '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 17, 0),
(9, 6053729418, 2, '0', 7, 0, '0', 2, '', '', '2076-4-10', '2019-07-26', 1, 1, 'लालु चिया पसल', 'sanstha-darta-pramanpatra', '', 'important', 0, 0, 0, 0, 'Screenshot_(1).png.png', '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 17, 0),
(10, 3248059671, 2, '0', 8, 0, '0', 2, '', '', '2076-4-10', '2019-07-26', 1, 1, 'Dhiraj Pradhan', 'income-verification', '', 'important', 0, 0, 0, 0, 'Screenshot_(1).png.png', '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 17, 0),
(11, 1309245687, 2, '0', 9, 0, '0', 2, '', '', '2076-4-10', '2019-07-26', 1, 1, 'Dhiraj Pradhan', 'char-killa', '', 'important', 0, 0, 0, 0, 'Screenshot_(1).png.png', '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 17, 0),
(12, 791254683, 2, '0', 10, 0, '0', 2, '', '', '2076-4-10', '2019-07-26', 1, 1, 'Dhiraj Pradhan', 'ghar-patala', '', 'important', 0, 0, 0, 0, 'Screenshot_(1).png.png', '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 17, 0),
(13, 0, 0, '1', 3, 0, '0', 1, '', '', '2076-4-12', '2019-07-28', 0, 0, '', '', '', 'important', 0, 0, 0, 0, '', '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 0, 0),
(14, 0, 0, '1', 4, 0, '0', 1, '', '', '2076-4-12', '2019-07-28', 0, 0, '', '', '', 'important', 0, 0, 0, 0, '', '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 0, 0),
(15, 1264583907, 2, '1', 5, 0, '0', 1, '1', '', '2076-4-12', '2019-07-28', 1, 1, 'Dhiraj Pradhan', 'home-recommend', '', 'important', 0, 0, 0, 0, 'Screenshot_(1).png.png', '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 1, 0),
(16, 1845762039, 2, '0', 11, 0, '0', 2, '', '', '2076-4-12', '2019-07-28', 2, 1, 'Dhiraj Pradhan', 'home-recommend', '', 'important', 0, 0, 0, 0, 'Screenshot_(1)1.png', '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 17, 0),
(17, 6089472315, 2, '0', 12, 0, '0', 2, '', '', '2076-4-12', '2019-07-28', 1, 1, 'Ram Bahadur Thapa', 'ghar-jagga-namsari', '', 'important', 0, 0, 0, 0, 'Screenshot_(1).png.png', '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 17, 0),
(18, 8601547932, 2, '0', 13, 0, '0', 2, '', '', '2076-4-12', '2019-07-28', 1, 1, 'Dhiraj Pradhan', 'kitta-kat-sifaris', '', 'important', 0, 0, 0, 0, 'Screenshot_(1).png.png', '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 17, 0),
(19, 8046591372, 2, '0', 14, 0, '0', 2, '', '', '2076-4-12', '2019-07-28', 1, 1, 'लालु चिया पसल', 'bebasaya-darta', '', 'important', 0, 0, 0, 0, 'Screenshot_(1).png.png', '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 17, 0),
(20, 1258734609, 2, '0', 15, 0, '0', 2, '', '', '2076-4-12', '2019-07-28', 1, 1, 'लालु चिया पसल', 'bebasaya-banda', '', 'important', 0, 0, 0, 0, 'Screenshot_(1).png.png', '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 17, 0),
(21, 1258734609, 2, '0', 15, 0, '0', 2, '', '', '2076-4-12', '2019-07-28', 1, 1, 'लालु चिया पसल', 'bebasaya-banda', '', 'important', 0, 0, 0, 0, 'Screenshot_(1).png.png', '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 17, 0),
(22, 2815479603, 2, '0', 16, 0, '0', 2, '', '', '2076-4-12', '2019-07-28', 1, 1, 'asdasas', 'mohi-lagat-katta', '', 'important', 0, 0, 0, 0, 'Screenshot_(1).png.png', '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 17, 0),
(23, 7836495120, 2, '0', 17, 0, '0', 2, '', '', '2076-4-12', '2019-07-28', 1, 1, 'Dhiraj Pradhan', 'purjama-ghar-kayam', '', 'important', 0, 0, 0, 0, 'Screenshot_(1).png.png', '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 17, 0),
(24, 3672804159, 2, '0', 18, 0, '0', 2, '', '', '2076-4-12', '2019-07-28', 1, 1, 'sASDF', 'bato-kayam', '', 'important', 0, 0, 0, 0, 'Screenshot_(1).png.png', '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 17, 0),
(25, 8942013675, 2, '0', 19, 0, '0', 2, '', '', '2076-4-12', '2019-07-28', 1, 1, 'Dhiraj Pradhan', 'lalpurja-pratilipi', '', 'important', 0, 0, 0, 0, 'Screenshot_(1).png.png', '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 17, 0),
(26, 2543079618, 2, '0', 20, 0, '0', 2, '', '', '2076-4-12', '2019-07-28', 1, 1, 'df', 'property-valuation', '', 'important', 0, 0, 0, 0, 'Screenshot_(1).png.png', '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 17, 0),
(27, 834912765, 2, '0', 21, 0, '0', 2, '', '', '2076-4-12', '2019-07-28', 1, 1, 'Dhiraj Pradhan', 'tax-clearance', '', 'important', 0, 0, 0, 0, 'Screenshot_(1).png.png', '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 17, 0),
(28, 7912835046, 2, '0', 22, 0, '0', 2, '', '', '2076-4-12', '2019-07-28', 1, 1, 'Dhiraj Pradhan', 'sthai-basobas', '', 'important', 0, 0, 0, 0, 'Sys32.jpg.jpg', '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 17, 0),
(29, 1769530428, 2, '0', 23, 0, '0', 2, '', '', '2076-4-12', '2019-07-28', 1, 1, 'Amulya Sharma', 'asthai-basobas', '', 'important', 0, 0, 0, 0, 'Sys32.jpg.jpg', '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 17, 0),
(30, 3720695841, 2, '0', 24, 0, '0', 2, '', '', '2076-4-12', '2019-07-28', 1, 1, 'df', 'mirtyu-darta', '', 'important', 0, 0, 0, 0, 'Sys32.jpg.jpg', '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 17, 0),
(31, 4756120983, 2, '0', 25, 0, '0', 2, '', '', '2076-4-12', '2019-07-28', 1, 1, 'Ram Basnet', 'abibhahit-pramanpatra', '', 'important', 0, 0, 0, 0, 'Sys32.jpg.jpg', '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 17, 0),
(32, 2019534768, 2, '0', 26, 0, '0', 2, '', '', '2076-4-12', '2019-07-28', 1, 1, 'dasdasd', 'janma-miti-pramanit', '', 'important', 0, 0, 0, 0, 'Screenshot_(1).png.png', '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 17, 0),
(33, 9372140685, 2, '0', 27, 0, '0', 2, '', '', '2076-4-12', '2019-07-28', 1, 1, 'df', 'apanga-pramanpatra', '', 'important', 0, 0, 0, 0, 'Screenshot_(1).png.png', '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 17, 0),
(34, 8607953421, 2, '0', 28, 0, '0', 2, '', '', '2076-4-12', '2019-07-28', 1, 1, 'Dhiraj Pradhan', 'kotha-khali-suchana', '', 'important', 0, 0, 0, 0, 'Screenshot_(1).png.png', '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 17, 0),
(35, 2031869754, 2, '0', 29, 0, '0', 2, '', '', '2076-4-12', '2019-07-28', 1, 1, 'Satya Narayan Bidhyalaya', 'add-classroom', '', 'important', 0, 0, 0, 0, 'Screenshot_(1).png.png', '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 17, 0),
(36, 5867320914, 2, '0', 30, 0, '0', 2, '', '', '2076-4-12', '2019-07-28', 1, 1, 'df', 'arthik-saheta', '', 'important', 0, 0, 0, 0, 'Screenshot_(1).png.png', '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 17, 0),
(37, 8192473605, 2, '0', 31, 0, '0', 2, '', '', '2076-4-12', '2019-07-28', 1, 1, '-', 'prabhidik-mulyankan', '', 'important', 0, 0, 0, 0, 'Screenshot_(1).png.png', '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 17, 0),
(38, 8642571930, 2, '0', 32, 0, '0', 2, '', '', '2076-4-12', '2019-07-28', 1, 1, 'Ram Basnet', 'tin-pusta-pramanit', '', 'important', 0, 0, 0, 0, 'Screenshot_(1).png.png', '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 17, 0),
(39, 7341960825, 2, '0', 33, 0, '0', 2, '', '', '2076-4-12', '2019-07-28', 1, 1, 'Dhiraj Pradhan', 'court-fee', '', 'important', 0, 0, 0, 0, 'Screenshot_(1).png.png', '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 17, 0),
(40, 6810259473, 2, '0', 34, 0, '0', 2, '', '', '2076-4-12', '2019-07-28', 1, 1, 'Dhiraj Pradhan', 'hakdar-pramanit', '', 'important', 0, 0, 0, 0, 'Screenshot_(1).png.png', '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 17, 0),
(41, 7891536420, 2, '0', 35, 0, '0', 2, '', '', '2076-4-12', '2019-07-28', 2, 1, 'Dhiraj Pradhan', 'sadak-khanne-swikriti', '', 'important', 0, 0, 0, 0, 'Screenshot_(1)1.png', '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 17, 0),
(42, 7016385249, 2, '0', 36, 0, '0', 2, '', '', '2076-4-12', '2019-07-28', 1, 1, 'Dhiraj Pradhanq', 'farak-nam-thar', '', 'important', 0, 0, 0, 0, 'Screenshot_(1).png.png', '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 17, 0),
(43, 5614837290, 2, '0', 37, 0, '0', 2, '', '', '2076-4-12', '2019-07-28', 1, 1, '-', 'jet-machine', '', 'important', 0, 0, 0, 0, 'Screenshot_(1).png.png', '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 17, 0),
(44, 5709128463, 2, '0', 38, 0, '0', 2, '', '', '2076-4-12', '2019-07-28', 1, 1, '-', 'biduth-jadan', '', 'important', 0, 0, 0, 0, 'Screenshot_(1).png.png', '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 17, 0),
(45, 7108942635, 2, '1', 6, 123123, '0', 1, '1+4', '', '2076-4-15', '2019-07-31', 0, 0, 'Dhiraj Pradhan', '', 'asdasd', 'important', 0, 0, 0, 0, '', 'fsfasdsadad', '', '0000-00-00', '', '0000-00-00', '2076-04-15', '2019-07-31', 'test+asdasdasd', 1, 0),
(46, 7031645982, 2, '1', 6, 123123, '0', 1, '1+4', '', '2076-4-15', '2019-07-31', 0, 0, 'Dhiraj Pradhan123', '', 'asdasd', 'important', 0, 0, 0, 0, '', 'fsfasdsadad', '', '0000-00-00', '', '0000-00-00', '2076-04-15', '2019-07-31', 'test+asdasdasd', 1, 0),
(47, 8651407392, 2, '1', 6, 123123, '0', 1, '1', '', '2076-4-15', '2019-07-31', 0, 0, 'Dhiraj Pradhan123', '', 'asdasd', 'important', 0, 0, 0, 0, '', 'fsfasdsadad', '', '0000-00-00', '', '0000-00-00', '2076-04-15', '2019-07-31', 'test', 1, 0),
(48, 2076539481, 2, '1', 7, 123, '1', 1, '', '', '2076-4-15', '2019-07-31', 0, 0, 'wrf', '', '12312321', 'important', 0, 0, 0, 0, '', '', '', '0000-00-00', '', '0000-00-00', '2076-04-15', '2019-07-31', 'ASDSAD', 1, 0),
(49, 5083174296, 2, '1', 8, 123, '0', 1, '1', '', '2076-4-15', '2019-07-31', 0, 0, 'asdsd123hellodisco', '', 'asdsad', 'important', 0, 0, 0, 0, '', '', '', '0000-00-00', '', '0000-00-00', '2076-04-15', '2019-07-31', 'asdsad', 1, 0),
(50, 1879346520, 2, '0', 39, 0, '0', 2, '', '', '2076-4-21', '2019-08-06', 0, 1, 'Dhiraj Pradhan', '', 'पुल निर्माण', 'important', 0, 0, 0, 0, 'Screenshot_(1).png.png', '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 17, 0),
(51, 2438769510, 2, '0', 40, 0, '0', 2, '', '', '2076-4-21', '2019-08-06', 0, 1, 'asdsda', '', 'पुल निर्माण', 'important', 0, 0, 0, 0, 'Screenshot_(1)1.png', '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 17, 0),
(52, 6752103948, 2, '1', 9, 123, '0', 1, '1', '', '2076-4-22', '2019-08-07', 0, 0, 'Dhiraj Pradhan', '', 'dasd', 'important', 0, 0, 0, 0, '', '', '', '0000-00-00', '', '0000-00-00', '2076-04-22', '2019-08-07', 'asdasd', 1, 0),
(53, 6549203718, 2, '1', 10, 123, '0', 1, '2', '', '2076-4-22', '2019-08-07', 0, 0, 'Dhiraj Pradhan', '', 'adasd', 'important', 0, 0, 0, 0, '', '', '', '0000-00-00', '', '0000-00-00', '2076-04-22', '2019-08-07', 'asdasd', 1, 0),
(54, 7238541069, 2, '0', 41, 0, '0', 2, '', '', '2076-5-11', '2019-08-28', 1, 1, 'लालु चिया पसल', 'bebasaya-darta', '', 'important', 0, 0, 0, 0, 'Screenshot_(1)1.png', '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 17, 0),
(55, 582917346, 2, '0', 42, 0, '0', 2, '', '', '2076-5-12', '2019-08-29', 1, 1, 'धिरज  प्रधान', 'citizenship-certificate', '', 'important', 0, 0, 0, 0, 'Visit-Nepal-100.png.png', '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 17, 0),
(56, 5631482709, 2, '0', 43, 0, '0', 2, '', '', '2076-5-13', '2019-08-30', 1, 1, 'PDMT123', 'bebasaya-sifaris', '', 'important', 0, 0, 0, 0, 'Visit-Nepal-150.png.png', '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 17, 0),
(57, 6745219380, 2, '0', 44, 0, '0', 2, '', '', '2076-5-13', '2019-08-30', 2, 1, 'PDMT', 'bebasaya-sifaris', '', 'important', 0, 0, 0, 0, 'Visit-Nepal-100.png.png', '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 17, 0);

-- --------------------------------------------------------

--
-- Table structure for table `farak_nam_thar`
--

CREATE TABLE `farak_nam_thar` (
  `id` int(11) NOT NULL,
  `form_id` bigint(20) NOT NULL,
  `session_id` int(11) NOT NULL,
  `ward_login` int(11) NOT NULL,
  `status` tinyint(3) NOT NULL,
  `nepali_date` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `applicant_name` text NOT NULL,
  `farak_name` text NOT NULL,
  `farak_bhayeko_document` text NOT NULL,
  `state` int(11) NOT NULL,
  `district` int(11) NOT NULL,
  `local_body` int(11) NOT NULL,
  `ward` int(11) NOT NULL,
  `old_place` int(11) NOT NULL,
  `documents` text NOT NULL,
  `documents_type` varchar(20) NOT NULL,
  `darta_documents` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `farak_nam_thar`
--

INSERT INTO `farak_nam_thar` (`id`, `form_id`, `session_id`, `ward_login`, `status`, `nepali_date`, `date`, `applicant_name`, `farak_name`, `farak_bhayeko_document`, `state`, `district`, `local_body`, `ward`, `old_place`, `documents`, `documents_type`, `darta_documents`, `created_at`, `updated_at`) VALUES
(1, 7016385249, 2, 2, 3, '2076-04-12', '2019-07-28', 'Dhiraj Pradhanq', 'Dhiraj Pradhan', 'asdadas', 3, 514, 2556, 2, 1, '', '', 'Screenshot_(1).png.png', '2019-07-28 04:45:58', '2019-07-28 11:01:06');

-- --------------------------------------------------------

--
-- Table structure for table `ghar_jagga_namsari`
--

CREATE TABLE `ghar_jagga_namsari` (
  `id` int(11) NOT NULL,
  `form_id` bigint(20) NOT NULL,
  `session_id` int(11) NOT NULL,
  `ward_login` int(11) NOT NULL,
  `status` tinyint(3) NOT NULL,
  `nepali_date` text NOT NULL,
  `date` date NOT NULL,
  `applicant_name` text NOT NULL,
  `applicant_relation` int(11) NOT NULL,
  `owner_name` text NOT NULL,
  `nepali_dod` text NOT NULL,
  `english_dod` date NOT NULL,
  `hakdar_ko_name` text NOT NULL,
  `hakdar_ko_nata` int(11) NOT NULL,
  `father_husband_name` text NOT NULL,
  `citizenship_no` text NOT NULL,
  `home_no` int(11) NOT NULL,
  `kitta` int(11) NOT NULL,
  `biggha` float NOT NULL,
  `kattha` float NOT NULL,
  `dhur` float NOT NULL,
  `paisa` float NOT NULL,
  `land_type` enum('hill','terai') NOT NULL,
  `map_sheet_no` int(11) NOT NULL,
  `kitta_no` int(11) NOT NULL,
  `road_name` text NOT NULL,
  `road_type` int(11) NOT NULL,
  `ward` int(11) NOT NULL,
  `description` text NOT NULL,
  `documents` text NOT NULL,
  `darta_documents` text NOT NULL,
  `created_at` datetime NOT NULL,
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ghar_jagga_namsari`
--

INSERT INTO `ghar_jagga_namsari` (`id`, `form_id`, `session_id`, `ward_login`, `status`, `nepali_date`, `date`, `applicant_name`, `applicant_relation`, `owner_name`, `nepali_dod`, `english_dod`, `hakdar_ko_name`, `hakdar_ko_nata`, `father_husband_name`, `citizenship_no`, `home_no`, `kitta`, `biggha`, `kattha`, `dhur`, `paisa`, `land_type`, `map_sheet_no`, `kitta_no`, `road_name`, `road_type`, `ward`, `description`, `documents`, `darta_documents`, `created_at`, `update_at`) VALUES
(1, 6089472315, 2, 2, 3, '2076-04-12', '2019-07-28', 'Ram Bahadur Thapa', 1, 'Test Narayan', '2076-04-02', '2019-07-18', 'Ram Bahadur Thapa', 1, 'Test Narayan', '147', 145, 12, 12, 2, 2, 2, 'hill', 132, 12312, '123sdasdad', 1, 3, '    asdasdsa                                                                                        ', '', 'Screenshot_(1).png.png', '2019-07-28 11:41:07', '2019-07-28 05:56:16');

-- --------------------------------------------------------

--
-- Table structure for table `ghar_kayam`
--

CREATE TABLE `ghar_kayam` (
  `id` int(11) NOT NULL,
  `form_id` bigint(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `ward_login` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `nepali_date` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `applicant_name` text NOT NULL,
  `kitta_no` varchar(50) NOT NULL,
  `biggha` float NOT NULL,
  `kattha` float NOT NULL,
  `dhur` float NOT NULL,
  `paisa` float NOT NULL,
  `land_type` enum('hill','terai') NOT NULL,
  `state` int(11) NOT NULL,
  `district` int(11) NOT NULL,
  `local_body` int(11) NOT NULL,
  `ward` int(11) NOT NULL,
  `old_place` text NOT NULL,
  `documents` text NOT NULL,
  `documents_type` int(11) NOT NULL,
  `darta_documents` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `samyukta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ghar_kayam`
--

INSERT INTO `ghar_kayam` (`id`, `form_id`, `session_id`, `ward_login`, `status`, `nepali_date`, `date`, `applicant_name`, `kitta_no`, `biggha`, `kattha`, `dhur`, `paisa`, `land_type`, `state`, `district`, `local_body`, `ward`, `old_place`, `documents`, `documents_type`, `darta_documents`, `created_at`, `updated_at`, `samyukta`) VALUES
(1, 7836495120, 2, 2, 3, '2076-04-12', '2019-07-28', 'Dhiraj Pradhan', '123', 12, 2, 2, 2, 'hill', 3, 514, 2556, 2, 'asda', '', 0, 'Screenshot_(1).png.png', '2019-07-28 01:30:58', '2019-07-28 07:46:08', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ghar_patala`
--

CREATE TABLE `ghar_patala` (
  `id` int(11) NOT NULL,
  `form_id` bigint(20) NOT NULL,
  `session_id` int(11) NOT NULL,
  `ward_login` int(11) NOT NULL,
  `status` tinyint(3) NOT NULL,
  `nepali_date` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `applicant_name` text NOT NULL,
  `kitta_no` varchar(15) NOT NULL,
  `biggha` float NOT NULL,
  `kattha` float NOT NULL,
  `dhur` float NOT NULL,
  `state` int(11) NOT NULL,
  `district` int(11) NOT NULL,
  `local_body` int(11) NOT NULL,
  `ward` int(11) NOT NULL,
  `old_place` int(11) NOT NULL,
  `documents` text NOT NULL,
  `documents_type` varchar(20) NOT NULL,
  `darta_documents` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ghar_patala`
--

INSERT INTO `ghar_patala` (`id`, `form_id`, `session_id`, `ward_login`, `status`, `nepali_date`, `date`, `applicant_name`, `kitta_no`, `biggha`, `kattha`, `dhur`, `state`, `district`, `local_body`, `ward`, `old_place`, `documents`, `documents_type`, `darta_documents`, `created_at`, `updated_at`) VALUES
(1, 791254683, 2, 2, 3, '2076-04-10', '2019-07-26', 'Dhiraj Pradhan', '123', 1, 2, 3, 3, 514, 2556, 2, 1, '', '', 'Screenshot_(1).png.png', '2019-07-26 04:15:31', '2019-07-26 10:30:44');

-- --------------------------------------------------------

--
-- Table structure for table `hakdar_pramanit`
--

CREATE TABLE `hakdar_pramanit` (
  `id` int(11) NOT NULL,
  `form_id` bigint(20) NOT NULL,
  `session_id` int(11) NOT NULL,
  `ward_login` int(11) NOT NULL,
  `status` tinyint(3) NOT NULL,
  `nepali_date` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `applicant_name` text NOT NULL,
  `mritak_ko_name` text NOT NULL,
  `hakdar_ko_no` int(11) NOT NULL,
  `hakdar_ko_name` text NOT NULL,
  `citizenship_no` varchar(15) NOT NULL,
  `relation` int(11) NOT NULL,
  `father_husband_name` text NOT NULL,
  `ghar_no` varchar(15) NOT NULL,
  `kitta_no` varchar(15) NOT NULL,
  `home_type` int(11) NOT NULL,
  `nep_darta_date` varchar(50) NOT NULL,
  `eng_darta_date` date NOT NULL,
  `darta_no` bigint(20) NOT NULL,
  `state` int(11) NOT NULL,
  `district` int(11) NOT NULL,
  `local_body` int(11) NOT NULL,
  `ward` int(11) NOT NULL,
  `old_place` text NOT NULL,
  `documents` text NOT NULL,
  `documents_type` varchar(20) NOT NULL,
  `darta_documents` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hakdar_pramanit`
--

INSERT INTO `hakdar_pramanit` (`id`, `form_id`, `session_id`, `ward_login`, `status`, `nepali_date`, `date`, `applicant_name`, `mritak_ko_name`, `hakdar_ko_no`, `hakdar_ko_name`, `citizenship_no`, `relation`, `father_husband_name`, `ghar_no`, `kitta_no`, `home_type`, `nep_darta_date`, `eng_darta_date`, `darta_no`, `state`, `district`, `local_body`, `ward`, `old_place`, `documents`, `documents_type`, `darta_documents`, `created_at`, `updated_at`) VALUES
(1, 6810259473, 2, 2, 3, '2076-04-12', '2019-07-28', 'Dhiraj Pradhan', 'बम काजी थापा', 1, 'राम थापा', '7878964', 1, 'Test Narayan', '18', '123', 2, '2076-04-12', '2019-07-28', 12, 3, 514, 2556, 2, 'asdsad', '', '', 'Screenshot_(1).png.png', '2019-07-28 04:27:39', '2019-07-28 10:42:48');

-- --------------------------------------------------------

--
-- Table structure for table `home_recommend`
--

CREATE TABLE `home_recommend` (
  `id` int(11) NOT NULL,
  `form_id` bigint(20) NOT NULL,
  `session_id` int(11) NOT NULL,
  `ward_login` int(11) NOT NULL,
  `status` tinyint(3) NOT NULL,
  `nepali_date` text NOT NULL,
  `date` date NOT NULL,
  `applicant_name` text NOT NULL,
  `office` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `district` int(11) NOT NULL,
  `local_body` int(11) NOT NULL,
  `ward` int(11) NOT NULL,
  `old_new_address` int(11) NOT NULL,
  `map_sheet_no` int(11) NOT NULL,
  `kitta_no` int(11) NOT NULL,
  `biggha` float NOT NULL,
  `kattha` float NOT NULL,
  `dhur` float NOT NULL,
  `paisa` float NOT NULL,
  `land_type` enum('hill','terai','','') NOT NULL,
  `home_no` int(11) NOT NULL,
  `home_type` int(11) NOT NULL,
  `road_name` text NOT NULL,
  `home_created_year` int(11) NOT NULL,
  `darta_documents` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `home_recommend`
--

INSERT INTO `home_recommend` (`id`, `form_id`, `session_id`, `ward_login`, `status`, `nepali_date`, `date`, `applicant_name`, `office`, `state`, `district`, `local_body`, `ward`, `old_new_address`, `map_sheet_no`, `kitta_no`, `biggha`, `kattha`, `dhur`, `paisa`, `land_type`, `home_no`, `home_type`, `road_name`, `home_created_year`, `darta_documents`, `created_at`, `updated_at`) VALUES
(1, 1264583907, 2, 1, 3, '2076-04-12', '2019-07-28', 'Dhiraj Pradhan', 1, 3, 514, 2556, 1, 1, 12, 123213, 12, 2, 2, 2, 'hill', 12, 1, '', 2008, 'Screenshot_(1).png.png', '2019-07-28 11:15:39', '2019-07-28 05:33:10'),
(2, 1845762039, 2, 2, 3, '2076-04-12', '2019-07-28', 'Dhiraj Pradhan', 2, 3, 514, 2556, 2, 1, 124, 23, 12, 2, 2, 2, 'hill', 123, 1, '', 0, 'Screenshot_(1)1.png', '2019-07-28 11:18:55', '2019-07-28 05:34:05');

-- --------------------------------------------------------

--
-- Table structure for table `home_road_certify`
--

CREATE TABLE `home_road_certify` (
  `id` int(11) NOT NULL,
  `form_id` bigint(20) NOT NULL,
  `session_id` int(11) NOT NULL,
  `ward_login` int(11) NOT NULL,
  `status` tinyint(3) NOT NULL,
  `nepali_date` text NOT NULL,
  `date` date NOT NULL,
  `office` int(11) NOT NULL,
  `applicant_name` text NOT NULL,
  `state` int(11) NOT NULL,
  `district` int(11) NOT NULL,
  `ward` int(11) NOT NULL,
  `local_body` int(11) NOT NULL,
  `land_type` enum('hill','terai') NOT NULL,
  `document` text NOT NULL,
  `document_type` text NOT NULL,
  `darta_documents` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `home_road_certify`
--

INSERT INTO `home_road_certify` (`id`, `form_id`, `session_id`, `ward_login`, `status`, `nepali_date`, `date`, `office`, `applicant_name`, `state`, `district`, `ward`, `local_body`, `land_type`, `document`, `document_type`, `darta_documents`, `created_at`, `updated_at`) VALUES
(1, 1543987026, 2, 2, 3, '2076-04-10', '2019-07-26', 2, 'Dhiraj Pradhan', 3, 514, 2, 2556, 'hill', '', '', 'Screenshot_(1).png.png', '2019-07-26 03:44:12', '2019-07-26 09:59:23');

-- --------------------------------------------------------

--
-- Table structure for table `home_road_certify_land`
--

CREATE TABLE `home_road_certify_land` (
  `id` int(11) NOT NULL,
  `darta_id` bigint(20) NOT NULL,
  `old_new_address` int(11) NOT NULL,
  `map_sheet_no` int(11) NOT NULL,
  `kitta_no` int(11) NOT NULL,
  `biggha` float NOT NULL,
  `kattha` float NOT NULL,
  `dhur` float NOT NULL,
  `paisa` float NOT NULL,
  `home` int(11) NOT NULL,
  `home_type` int(11) NOT NULL,
  `estimated_cost` float NOT NULL,
  `road` int(11) NOT NULL,
  `road_type` int(11) NOT NULL,
  `description` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `home_road_certify_land`
--

INSERT INTO `home_road_certify_land` (`id`, `darta_id`, `old_new_address`, `map_sheet_no`, `kitta_no`, `biggha`, `kattha`, `dhur`, `paisa`, `home`, `home_type`, `estimated_cost`, `road`, `road_type`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 123, 12, 12, 12, 2, 2, 0, 0, 0, 0, 0, 'asda', '2019-07-26 03:44:12', '2019-07-26 09:59:12'),
(2, 1, 1, 12, 23, 2, 3, 3, 1, 1, 1, 12312, 1, 2, 'asd', '2019-07-26 03:44:12', '2019-07-26 09:59:12');

-- --------------------------------------------------------

--
-- Table structure for table `income_verification`
--

CREATE TABLE `income_verification` (
  `id` int(11) NOT NULL,
  `form_id` bigint(20) NOT NULL,
  `session_id` int(11) NOT NULL,
  `ward_login` int(11) NOT NULL,
  `status` tinyint(3) NOT NULL,
  `nepali_date` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `applicant_name` text NOT NULL,
  `state` int(11) NOT NULL,
  `district` int(11) NOT NULL,
  `local_body` int(11) NOT NULL,
  `ward` int(11) NOT NULL,
  `documents` text NOT NULL,
  `documents_type` varchar(20) NOT NULL,
  `darta_documents` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `income_verification`
--

INSERT INTO `income_verification` (`id`, `form_id`, `session_id`, `ward_login`, `status`, `nepali_date`, `date`, `applicant_name`, `state`, `district`, `local_body`, `ward`, `documents`, `documents_type`, `darta_documents`, `created_at`, `updated_at`) VALUES
(1, 3248059671, 2, 2, 3, '2076-04-10', '2019-07-26', 'Dhiraj Pradhan', 3, 514, 2556, 2, '', '', 'Screenshot_(1).png.png', '2019-07-26 03:58:27', '2019-07-26 10:13:43');

-- --------------------------------------------------------

--
-- Table structure for table `income_verification_detail`
--

CREATE TABLE `income_verification_detail` (
  `id` int(11) NOT NULL,
  `darta_id` int(11) NOT NULL,
  `relation` int(11) NOT NULL,
  `parties_name` text NOT NULL,
  `annual_income` float NOT NULL,
  `remark` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `income_verification_detail`
--

INSERT INTO `income_verification_detail` (`id`, `darta_id`, `relation`, `parties_name`, `annual_income`, `remark`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 'Nir Kumar Pradhan', 1200000, '                                    ', '2019-07-26 03:58:27', '2019-07-26 10:13:27');

-- --------------------------------------------------------

--
-- Table structure for table `janma_miti_pramanit`
--

CREATE TABLE `janma_miti_pramanit` (
  `id` int(11) NOT NULL,
  `form_id` bigint(20) NOT NULL,
  `session_id` int(11) NOT NULL,
  `status` tinyint(3) NOT NULL,
  `ward_login` int(11) NOT NULL,
  `nepali_date` varchar(50) NOT NULL,
  `child_name` text NOT NULL,
  `gender` int(11) NOT NULL,
  `nepali_dob` varchar(50) NOT NULL,
  `english_dob` date NOT NULL,
  `birth_place` text NOT NULL,
  `father_name` text NOT NULL,
  `mother_name` text NOT NULL,
  `suchak_name` text NOT NULL,
  `father_citizenship_no` varchar(125) NOT NULL,
  `mother_citizenship_no` varchar(125) NOT NULL,
  `suchak_citizenship_no` varchar(125) NOT NULL,
  `date` date NOT NULL,
  `state` int(11) NOT NULL,
  `district` int(11) NOT NULL,
  `local_body` int(11) NOT NULL,
  `ward` int(11) NOT NULL,
  `old_place` int(11) NOT NULL,
  `documents` text NOT NULL,
  `documents_type` varchar(50) NOT NULL,
  `darta_documents` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `janma_miti_pramanit`
--

INSERT INTO `janma_miti_pramanit` (`id`, `form_id`, `session_id`, `status`, `ward_login`, `nepali_date`, `child_name`, `gender`, `nepali_dob`, `english_dob`, `birth_place`, `father_name`, `mother_name`, `suchak_name`, `father_citizenship_no`, `mother_citizenship_no`, `suchak_citizenship_no`, `date`, `state`, `district`, `local_body`, `ward`, `old_place`, `documents`, `documents_type`, `darta_documents`, `created_at`, `updated_at`) VALUES
(1, 2019534768, 2, 3, 2, '2076-04-12', 'df', 1, '2076-04-12', '2019-07-28', 'asdas', 'dasdasd', 'sadasgaw', 'asdasd', '123123', '1431', '1223', '2019-07-28', 3, 514, 2556, 2, 1, '', '', 'Screenshot_(1).png.png', '2019-07-28 03:27:09', '2019-07-28 09:42:23');

-- --------------------------------------------------------

--
-- Table structure for table `jet_machine`
--

CREATE TABLE `jet_machine` (
  `id` int(11) NOT NULL,
  `form_id` bigint(20) NOT NULL,
  `session_id` int(11) NOT NULL,
  `ward_login` int(11) NOT NULL,
  `status` tinyint(3) NOT NULL,
  `nepali_date` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `machine_dine_tham` text NOT NULL,
  `road_name` text NOT NULL,
  `state` int(11) NOT NULL,
  `district` int(11) NOT NULL,
  `local_body` int(11) NOT NULL,
  `ward` int(11) NOT NULL,
  `documents` text NOT NULL,
  `documents_type` varchar(20) NOT NULL,
  `darta_documents` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jet_machine`
--

INSERT INTO `jet_machine` (`id`, `form_id`, `session_id`, `ward_login`, `status`, `nepali_date`, `date`, `machine_dine_tham`, `road_name`, `state`, `district`, `local_body`, `ward`, `documents`, `documents_type`, `darta_documents`, `created_at`, `updated_at`) VALUES
(1, 5614837290, 2, 2, 3, '2076-04-12', '2019-07-28', 'Brt', 'hanumandas road', 3, 514, 2556, 2, '', '', 'Screenshot_(1).png.png', '2019-07-28 04:50:46', '2019-07-28 11:05:55');

-- --------------------------------------------------------

--
-- Table structure for table `khanepani_jadan`
--

CREATE TABLE `khanepani_jadan` (
  `id` int(11) NOT NULL,
  `form_id` bigint(20) NOT NULL,
  `session_id` int(11) NOT NULL,
  `ward_login` int(11) NOT NULL,
  `status` tinyint(3) NOT NULL,
  `nepali_date` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `applicant_name` text NOT NULL,
  `nepali_permission_date` text NOT NULL,
  `permission_date` date NOT NULL,
  `state` int(11) NOT NULL,
  `district` int(11) NOT NULL,
  `local_body` int(11) NOT NULL,
  `ward_no` varchar(50) NOT NULL,
  `old_address` int(11) NOT NULL,
  `kitta_no` text NOT NULL,
  `documents` text NOT NULL,
  `documents_type` varchar(50) NOT NULL,
  `darta_documents` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `khanepani_jadan`
--

INSERT INTO `khanepani_jadan` (`id`, `form_id`, `session_id`, `ward_login`, `status`, `nepali_date`, `date`, `applicant_name`, `nepali_permission_date`, `permission_date`, `state`, `district`, `local_body`, `ward_no`, `old_address`, `kitta_no`, `documents`, `documents_type`, `darta_documents`, `created_at`, `updated_at`) VALUES
(1, 4215980736, 2, 2, 3, '2076-04-10', '2019-07-26', 'Dhiraj Pradhan', '2076-04-10', '2019-07-26', 3, 514, 2556, '2', 1, '123', '', '', 'Screenshot_(1).png.png', '2019-07-26 12:52:11', '2019-07-26 07:07:25');

-- --------------------------------------------------------

--
-- Table structure for table `kitta_kat_sifaris`
--

CREATE TABLE `kitta_kat_sifaris` (
  `id` int(11) NOT NULL,
  `form_id` bigint(20) NOT NULL,
  `session_id` int(11) NOT NULL,
  `ward_login` int(11) NOT NULL,
  `status` tinyint(3) NOT NULL,
  `nepali_date` text NOT NULL,
  `date` date NOT NULL,
  `owner_name` text NOT NULL,
  `kittakat_area` varchar(20) NOT NULL,
  `state` int(11) NOT NULL,
  `district` int(11) NOT NULL,
  `local_body` int(11) NOT NULL,
  `ward` int(11) NOT NULL,
  `old_place` int(11) NOT NULL,
  `direction` int(11) NOT NULL,
  `biggha` float NOT NULL,
  `kattha` int(11) NOT NULL,
  `dhur` int(11) NOT NULL,
  `paisa` float NOT NULL,
  `land_type` enum('hill','terai') NOT NULL,
  `map_sheet_no` int(11) NOT NULL,
  `kitta_no` int(11) NOT NULL,
  `ghar_area` text NOT NULL,
  `first_floor_home_area` text NOT NULL,
  `paune_far` text NOT NULL,
  `reason` text NOT NULL,
  `technician_name` text NOT NULL,
  `documents` text NOT NULL,
  `documents_type` text NOT NULL,
  `darta_documents` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kitta_kat_sifaris`
--

INSERT INTO `kitta_kat_sifaris` (`id`, `form_id`, `session_id`, `ward_login`, `status`, `nepali_date`, `date`, `owner_name`, `kittakat_area`, `state`, `district`, `local_body`, `ward`, `old_place`, `direction`, `biggha`, `kattha`, `dhur`, `paisa`, `land_type`, `map_sheet_no`, `kitta_no`, `ghar_area`, `first_floor_home_area`, `paune_far`, `reason`, `technician_name`, `documents`, `documents_type`, `darta_documents`, `created_at`, `updated_at`) VALUES
(1, 8601547932, 2, 2, 3, '2076-04-12', '2019-07-28', 'Dhiraj Pradhan', '0-0-4', 3, 514, 2556, 2, 1, 1, 12, 2, 2, 2, 'hill', 123, 123, '122', '122', '12', '123123', 'adasdsa', '', '', 'Screenshot_(1).png.png', '2019-07-28 11:54:00', '2019-07-28 06:09:10');

-- --------------------------------------------------------

--
-- Table structure for table `kotha_khali_suchana`
--

CREATE TABLE `kotha_khali_suchana` (
  `id` int(11) NOT NULL,
  `form_id` bigint(20) NOT NULL,
  `session_id` int(11) NOT NULL,
  `ward_login` int(11) NOT NULL,
  `status` tinyint(3) NOT NULL,
  `nepali_date` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `applicant_name` text NOT NULL,
  `state` int(11) NOT NULL,
  `district` int(11) NOT NULL,
  `local_body` int(11) NOT NULL,
  `ward` int(11) NOT NULL,
  `old_place` int(11) NOT NULL,
  `documents` text NOT NULL,
  `documents_type` varchar(20) NOT NULL,
  `darta_documents` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kotha_khali_suchana`
--

INSERT INTO `kotha_khali_suchana` (`id`, `form_id`, `session_id`, `ward_login`, `status`, `nepali_date`, `date`, `applicant_name`, `state`, `district`, `local_body`, `ward`, `old_place`, `documents`, `documents_type`, `darta_documents`, `created_at`, `updated_at`) VALUES
(1, 8607953421, 2, 2, 3, '2076-04-12', '2019-07-28', 'Dhiraj Pradhan', 3, 514, 2556, 2, 1, '', '', 'Screenshot_(1).png.png', '2019-07-28 03:37:40', '2019-07-28 09:52:50');

-- --------------------------------------------------------

--
-- Table structure for table `lalpurja_pratilipi`
--

CREATE TABLE `lalpurja_pratilipi` (
  `id` int(11) NOT NULL,
  `form_id` bigint(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `ward_login` int(11) NOT NULL,
  `nepali_date` varbinary(50) NOT NULL,
  `date` date NOT NULL,
  `applicant_name` text NOT NULL,
  `citizenship_no` varchar(50) NOT NULL,
  `nep_citizenship_date` varchar(50) NOT NULL,
  `eng_citizenship_date` date NOT NULL,
  `father_name` text NOT NULL,
  `grandfather_name` text NOT NULL,
  `a_state` int(11) NOT NULL,
  `a_district` int(11) NOT NULL,
  `a_local_body` int(11) NOT NULL,
  `a_ward` int(11) NOT NULL,
  `a_old_place` int(11) NOT NULL,
  `land_owner_name` text NOT NULL,
  `kitta_no` varchar(50) NOT NULL,
  `biggha` float NOT NULL,
  `land_type` enum('hill','terai') NOT NULL,
  `kattha` float NOT NULL,
  `dhur` float NOT NULL,
  `paisa` float NOT NULL,
  `l_state` int(11) NOT NULL,
  `l_district` int(11) NOT NULL,
  `l_local_body` int(11) NOT NULL,
  `l_ward_no` int(11) NOT NULL,
  `l_old_place` text NOT NULL,
  `documents` text NOT NULL,
  `documents_type` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(11) NOT NULL,
  `darta_documents` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lalpurja_pratilipi`
--

INSERT INTO `lalpurja_pratilipi` (`id`, `form_id`, `session_id`, `ward_login`, `nepali_date`, `date`, `applicant_name`, `citizenship_no`, `nep_citizenship_date`, `eng_citizenship_date`, `father_name`, `grandfather_name`, `a_state`, `a_district`, `a_local_body`, `a_ward`, `a_old_place`, `land_owner_name`, `kitta_no`, `biggha`, `land_type`, `kattha`, `dhur`, `paisa`, `l_state`, `l_district`, `l_local_body`, `l_ward_no`, `l_old_place`, `documents`, `documents_type`, `created_at`, `updated_at`, `status`, `darta_documents`) VALUES
(1, 8942013675, 2, 2, 0x323037362d30342d3132, '2019-07-28', 'Dhiraj Pradhan', '147', '2076-04-03', '2019-07-19', 'Nir Kumar Pradhan', 'पुण्य प्रसाद श्रेष्ठ', 3, 514, 2556, 2, 0, 'Select any one', '123', 12, 'hill', 2, 1, 1, 3, 514, 2556, 2, 'asdas', '', '', '2019-07-28 01:43:40', '2019-07-28 07:58:52', 3, 'Screenshot_(1).png.png');

-- --------------------------------------------------------

--
-- Table structure for table `maujuda_suchi`
--

CREATE TABLE `maujuda_suchi` (
  `id` int(11) NOT NULL,
  `contact_name` text NOT NULL,
  `contact_number` varchar(30) NOT NULL,
  `work_type` int(11) NOT NULL,
  `service_type` int(11) NOT NULL,
  `niwedan_darta_miti_eng` date NOT NULL,
  `niwedan_darta_miti_nep` varchar(50) NOT NULL,
  `sanstha_darta_no` bigint(20) NOT NULL,
  `darta_type` enum('pan','vat') NOT NULL,
  `pan_vat_no` bigint(20) NOT NULL,
  `is_renewed` enum('yes','no') NOT NULL,
  `karyanubhab` text NOT NULL,
  `lakshit_group` text NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `maujuda_suchi`
--

INSERT INTO `maujuda_suchi` (`id`, `contact_name`, `contact_number`, `work_type`, `service_type`, `niwedan_darta_miti_eng`, `niwedan_darta_miti_nep`, `sanstha_darta_no`, `darta_type`, `pan_vat_no`, `is_renewed`, `karyanubhab`, `lakshit_group`, `created_at`) VALUES
(4, 'Dhiraj', '9842134241', 1, 1, '2019-08-06', '2076-04-21', 123, 'pan', 123123, 'yes', '', '', '2019-08-06 13:54:13'),
(5, 'df', '9842134241', 0, 0, '2019-08-06', '2076-04-21', 123, 'pan', 12, 'yes', 'asdasd', 'asdsadsadsad', '2019-08-06 13:54:55');

-- --------------------------------------------------------

--
-- Table structure for table `mirtyu_darta`
--

CREATE TABLE `mirtyu_darta` (
  `id` int(11) NOT NULL,
  `form_id` bigint(20) NOT NULL,
  `session_id` int(11) NOT NULL,
  `ward_login` int(11) NOT NULL,
  `status` tinyint(3) NOT NULL,
  `nepali_date` varchar(50) NOT NULL,
  `gender` int(11) NOT NULL,
  `applicant_name` varchar(125) NOT NULL,
  `death_person_name` varchar(125) NOT NULL,
  `grandfather_name` varchar(125) NOT NULL,
  `nep_dod` varchar(100) NOT NULL,
  `eng_dod` date NOT NULL,
  `citizenship_no` varchar(50) NOT NULL,
  `citizenship_nep_date` varchar(100) NOT NULL,
  `citizenship_eng_date` date NOT NULL,
  `citizenship_district` int(11) NOT NULL,
  `father_name` text NOT NULL,
  `mother_name` text NOT NULL,
  `husband_wife_name` text NOT NULL,
  `date` date NOT NULL,
  `age` int(11) NOT NULL,
  `death_state` int(11) NOT NULL,
  `death_district` int(11) NOT NULL,
  `death_local_body` int(11) NOT NULL,
  `death_ward` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `district` int(11) NOT NULL,
  `local_body` int(11) NOT NULL,
  `ward` int(11) NOT NULL,
  `documents` text NOT NULL,
  `documents_type` varchar(50) NOT NULL,
  `darta_documents` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mirtyu_darta`
--

INSERT INTO `mirtyu_darta` (`id`, `form_id`, `session_id`, `ward_login`, `status`, `nepali_date`, `gender`, `applicant_name`, `death_person_name`, `grandfather_name`, `nep_dod`, `eng_dod`, `citizenship_no`, `citizenship_nep_date`, `citizenship_eng_date`, `citizenship_district`, `father_name`, `mother_name`, `husband_wife_name`, `date`, `age`, `death_state`, `death_district`, `death_local_body`, `death_ward`, `state`, `district`, `local_body`, `ward`, `documents`, `documents_type`, `darta_documents`, `created_at`, `updated_at`) VALUES
(1, 3720695841, 2, 2, 3, '2076-04-12', 1, 'df', 'विलियम श्रेष्ठ', 'पुण्य प्रसाद श्रेष्ठ', '2076-04-10', '2019-07-26', '7878964', '2076-04-11', '2019-07-27', 514, 'Ram Basnet', 'स्रिस्टी श्रेष्ठ', 'ada', '2019-07-28', 23, 3, 514, 2556, 2, 3, 514, 2556, 2, '', '', 'Sys32.jpg.jpg', '2019-07-28 02:52:47', '2019-07-28 09:08:02');

-- --------------------------------------------------------

--
-- Table structure for table `mohi_lagat`
--

CREATE TABLE `mohi_lagat` (
  `id` int(11) NOT NULL,
  `form_id` bigint(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `ward_login` int(11) NOT NULL,
  `nepali_date` varbinary(50) NOT NULL,
  `date` date NOT NULL,
  `applicant_name` text NOT NULL,
  `land_owner_name` text NOT NULL,
  `kitta_no` varchar(50) NOT NULL,
  `biggha` float NOT NULL,
  `kattha` float NOT NULL,
  `dhur` float NOT NULL,
  `paisa` float NOT NULL,
  `land_type` enum('hill','terai') NOT NULL,
  `documents` text NOT NULL,
  `documents_type` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(11) NOT NULL,
  `darta_documents` text NOT NULL,
  `mohi_name` text NOT NULL,
  `map_sheet_no` varchar(50) NOT NULL,
  `nepali_visit_date` varchar(50) NOT NULL,
  `english_visit_date` date NOT NULL,
  `local_body` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `ward` int(11) NOT NULL,
  `district` int(11) NOT NULL,
  `old_place` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mohi_lagat`
--

INSERT INTO `mohi_lagat` (`id`, `form_id`, `session_id`, `ward_login`, `nepali_date`, `date`, `applicant_name`, `land_owner_name`, `kitta_no`, `biggha`, `kattha`, `dhur`, `paisa`, `land_type`, `documents`, `documents_type`, `created_at`, `updated_at`, `status`, `darta_documents`, `mohi_name`, `map_sheet_no`, `nepali_visit_date`, `english_visit_date`, `local_body`, `state`, `ward`, `district`, `old_place`) VALUES
(1, 2815479603, 2, 2, 0x323037362d30342d3132, '2019-07-28', '', 'asdasas', '123', 12, 2, 2, 0, 'hill', '', '', '2019-07-28 01:02:30', '2019-07-28 07:18:50', 3, 'Screenshot_(1).png.png', 'asdsad', '123123', '2076-04-06', '2019-07-22', 2556, 3, 2, 514, 'asdasdasd');

-- --------------------------------------------------------

--
-- Table structure for table `nabalak_pramanit`
--

CREATE TABLE `nabalak_pramanit` (
  `id` int(11) NOT NULL,
  `form_id` bigint(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `ward_login` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `nepali_date` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `nep_first_name` text NOT NULL,
  `nep_middle_name` text NOT NULL,
  `nep_last_name` text NOT NULL,
  `eng_first_name` text NOT NULL,
  `eng_middle_name` text NOT NULL,
  `eng_last_name` text NOT NULL,
  `gender` text NOT NULL,
  `nep_dob` varchar(50) NOT NULL,
  `eng_dob` date NOT NULL,
  `p_state` int(11) NOT NULL,
  `p_district` int(11) NOT NULL,
  `p_local_body` int(11) NOT NULL,
  `p_ward` int(11) NOT NULL,
  `documents` text NOT NULL,
  `documents_type` text NOT NULL,
  `darta_documents` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `applicant_name` text NOT NULL,
  `relationship` text NOT NULL,
  `birthplace_nep` text NOT NULL,
  `birthplace_eng` text NOT NULL,
  `father_name_nep` text NOT NULL,
  `father_name_eng` text NOT NULL,
  `mother_name_nep` text NOT NULL,
  `mother_name_eng` text NOT NULL,
  `gurdians_name_nep` text NOT NULL,
  `gurdians_name_eng` text NOT NULL,
  `gurdians_address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nata_pramanit`
--

CREATE TABLE `nata_pramanit` (
  `id` int(11) NOT NULL,
  `form_id` bigint(20) NOT NULL,
  `session_id` int(11) NOT NULL,
  `ward_login` int(11) NOT NULL,
  `status` tinyint(3) NOT NULL,
  `nepali_date` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `applicant_name` text NOT NULL,
  `state` int(11) NOT NULL,
  `district` int(11) NOT NULL,
  `local_body` int(11) NOT NULL,
  `ward` int(11) NOT NULL,
  `documents` text NOT NULL,
  `documents_type` varchar(20) NOT NULL,
  `darta_documents` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nata_pramanit`
--

INSERT INTO `nata_pramanit` (`id`, `form_id`, `session_id`, `ward_login`, `status`, `nepali_date`, `date`, `applicant_name`, `state`, `district`, `local_body`, `ward`, `documents`, `documents_type`, `darta_documents`, `created_at`, `updated_at`) VALUES
(1, 7984162530, 2, 2, 3, '2076-04-10', '2019-07-26', 'एत्स्त', 3, 514, 2556, 2, '', '', 'Screenshot_(1).png.png', '2019-07-26 03:22:39', '2019-07-26 09:37:48');

-- --------------------------------------------------------

--
-- Table structure for table `nata_pramanit_detail`
--

CREATE TABLE `nata_pramanit_detail` (
  `id` int(11) NOT NULL,
  `darta_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `relation` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nata_pramanit_detail`
--

INSERT INTO `nata_pramanit_detail` (`id`, `darta_id`, `name`, `relation`, `created_at`, `updated_at`) VALUES
(1, 1, 'अस्दस्द', 1, '2019-07-26 03:22:39', '2019-07-26 09:37:39');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `form_id` bigint(20) NOT NULL,
  `from_department` int(11) NOT NULL,
  `to_department` int(11) NOT NULL,
  `is_seen` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `modified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `form_id`, `from_department`, `to_department`, `is_seen`, `created_at`, `modified_at`) VALUES
(1, 6549203718, 1, 2, '1', '2019-08-07 10:38:33', '2019-08-07 10:38:33'),
(2, 7432658109, 23, 1, '1', '2019-08-13 06:53:33', '2019-08-13 06:53:33');

-- --------------------------------------------------------

--
-- Table structure for table `prabhidik_mulyankan`
--

CREATE TABLE `prabhidik_mulyankan` (
  `id` int(11) NOT NULL,
  `form_id` bigint(20) NOT NULL,
  `session_id` int(11) NOT NULL,
  `ward_login` int(11) NOT NULL,
  `status` tinyint(3) NOT NULL,
  `nepali_date` varchar(50) NOT NULL,
  `nepali_chalani_date` varchar(50) NOT NULL,
  `english_chalani_date` date NOT NULL,
  `chalani_no` bigint(20) NOT NULL,
  `date` date NOT NULL,
  `documents` text NOT NULL,
  `documents_type` varchar(20) NOT NULL,
  `darta_documents` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `prabhidik_mulyankan`
--

INSERT INTO `prabhidik_mulyankan` (`id`, `form_id`, `session_id`, `ward_login`, `status`, `nepali_date`, `nepali_chalani_date`, `english_chalani_date`, `chalani_no`, `date`, `documents`, `documents_type`, `darta_documents`, `created_at`, `updated_at`) VALUES
(1, 8192473605, 2, 2, 3, '2076-04-12', '2076-04-12', '2019-07-28', 142, '2019-07-28', '', '', 'Screenshot_(1).png.png', '2019-07-28 03:52:52', '2019-07-28 10:08:00');

-- --------------------------------------------------------

--
-- Table structure for table `print_details`
--

CREATE TABLE `print_details` (
  `id` int(11) NOT NULL,
  `uri` varchar(125) NOT NULL,
  `form_id` bigint(20) NOT NULL,
  `worker_id` int(11) NOT NULL,
  `office_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `print_details`
--

INSERT INTO `print_details` (`id`, `uri`, `form_id`, `worker_id`, `office_id`, `created_at`, `updated_at`) VALUES
(3, 'home-recommend', 1845762039, 2, 3, '2019-07-29 14:40:52', '2019-08-29 16:56:20'),
(4, 'home-road-certify', 1543987026, 2, 4, '2019-07-29 16:33:23', '2019-08-29 16:15:26'),
(5, 'ghar-jagga-namsari', 6089472315, 2, 3, '2019-07-29 16:42:48', '2019-08-29 16:15:48'),
(6, 'kitta-kat-sifaris', 8601547932, 2, 2, '2019-07-29 16:48:55', '2019-08-29 16:16:01'),
(7, 'bebasaya-banda', 1258734609, 2, 2, '2019-07-29 17:01:05', '0000-00-00 00:00:00'),
(8, 'bebasaya-darta', 7238541069, 0, 0, '2019-07-29 17:04:10', '2019-08-30 11:51:18'),
(9, 'sanstha-darta', 7529683041, 2, 2, '2019-07-29 17:06:32', '0000-00-00 00:00:00'),
(10, 'sanstha-darta-pramanpatra', 6053729418, 2, 3, '2019-07-29 17:08:01', '0000-00-00 00:00:00'),
(11, 'sanstha-nabikaran', 8260914573, 2, 2, '2019-07-29 17:08:57', '2019-07-30 10:35:26'),
(12, 'bato-kayam', 3672804159, 2, 3, '2019-07-30 10:48:19', '0000-00-00 00:00:00'),
(13, 'char-killa', 1309245687, 2, 2, '2019-07-30 10:49:50', '0000-00-00 00:00:00'),
(14, 'lalpurja-pratilipi', 8942013675, 2, 5, '2019-07-30 10:50:54', '0000-00-00 00:00:00'),
(15, 'mohi-lagat-katta', 2815479603, 2, 3, '2019-07-30 10:51:46', '0000-00-00 00:00:00'),
(16, 'purjama-ghar-kayam', 7836495120, 2, 4, '2019-07-30 10:52:55', '0000-00-00 00:00:00'),
(17, 'antarik-basai-sarai', 2154386790, 2, 3, '2019-07-30 10:58:50', '0000-00-00 00:00:00'),
(18, 'asthai-basobas', 1769530428, 2, 3, '2019-07-30 11:00:53', '2019-07-30 11:07:18'),
(19, 'sthai-basobas', 7912835046, 2, 3, '2019-07-30 11:12:04', '0000-00-00 00:00:00'),
(20, 'abibhahit-pramanpatra', 4756120983, 2, 4, '2019-07-30 11:46:30', '0000-00-00 00:00:00'),
(21, 'add-classroom', 2031869754, 2, 3, '2019-07-30 11:47:32', '0000-00-00 00:00:00'),
(22, 'apanga-pramanpatra', 9372140685, 2, 3, '2019-07-30 11:48:21', '0000-00-00 00:00:00'),
(23, 'arthik-saheta', 5867320914, 2, 2, '2019-07-30 11:49:22', '0000-00-00 00:00:00'),
(24, 'bibaha-pramanit', 4682950371, 2, 3, '2019-07-30 11:54:06', '2019-07-30 11:54:50'),
(25, 'biduth-jadan', 5709128463, 2, 2, '2019-07-30 11:56:03', '0000-00-00 00:00:00'),
(26, 'court-fee', 7341960825, 2, 2, '2019-07-30 11:56:58', '0000-00-00 00:00:00'),
(27, 'farak-nam-thar', 7016385249, 2, 2, '2019-07-30 11:57:45', '0000-00-00 00:00:00'),
(28, 'ghar-patala', 791254683, 2, 2, '2019-07-30 11:58:33', '0000-00-00 00:00:00'),
(29, 'hakdar-pramanit', 6810259473, 2, 2, '2019-07-30 11:59:26', '0000-00-00 00:00:00'),
(30, 'janma-miti-pramanit', 2019534768, 2, 3, '2019-07-30 12:00:16', '0000-00-00 00:00:00'),
(31, 'jet-machine', 5614837290, 2, 2, '2019-07-30 12:01:05', '0000-00-00 00:00:00'),
(32, 'khanepani-jadan', 4215980736, 2, 3, '2019-07-30 12:02:01', '0000-00-00 00:00:00'),
(33, 'kotha-khali-suchana', 8607953421, 2, 3, '2019-07-30 12:02:46', '0000-00-00 00:00:00'),
(34, 'mirtyu-darta', 3720695841, 2, 3, '2019-07-30 12:04:00', '0000-00-00 00:00:00'),
(35, 'nata-pramanit', 7984162530, 2, 3, '2019-07-30 12:06:19', '0000-00-00 00:00:00'),
(36, 'prabhidik-mulyankan', 8192473605, 2, 2, '2019-07-30 12:07:12', '0000-00-00 00:00:00'),
(37, 'sadak-khanne-swikriti', 4278619503, 0, 3, '2019-07-30 12:11:09', '2019-07-30 12:11:20'),
(38, 'tin-pusta-pramanit', 8642571930, 2, 2, '2019-07-30 12:26:13', '0000-00-00 00:00:00'),
(39, 'letter-form', 1879346520, 2, 3, '2019-08-06 12:35:47', '0000-00-00 00:00:00'),
(40, 'bebasaya-sifaris', 6745219380, 2, 24, '2019-09-01 10:25:23', '2019-09-01 11:41:39');

-- --------------------------------------------------------

--
-- Table structure for table `property_valuation`
--

CREATE TABLE `property_valuation` (
  `id` int(11) NOT NULL,
  `form_id` bigint(20) NOT NULL,
  `session_id` int(11) NOT NULL,
  `ward_login` int(11) NOT NULL,
  `status` tinyint(3) NOT NULL,
  `nepali_date` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `applicant_name` text NOT NULL,
  `state` int(11) NOT NULL,
  `district` int(11) NOT NULL,
  `local_body` int(11) NOT NULL,
  `ward` int(11) NOT NULL,
  `land_type` enum('hill','terai') NOT NULL,
  `documents` text NOT NULL,
  `documents_type` varchar(20) NOT NULL,
  `darta_documents` text NOT NULL,
  `created_at` datetime NOT NULL,
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `property_valuation`
--

INSERT INTO `property_valuation` (`id`, `form_id`, `session_id`, `ward_login`, `status`, `nepali_date`, `date`, `applicant_name`, `state`, `district`, `local_body`, `ward`, `land_type`, `documents`, `documents_type`, `darta_documents`, `created_at`, `update_at`) VALUES
(1, 2543079618, 2, 2, 3, '2076-04-12', '2019-07-28', 'df', 3, 514, 2556, 2, 'hill', '', '', 'Screenshot_(1).png.png', '2019-07-28 01:58:03', '2019-07-28 08:13:16');

-- --------------------------------------------------------

--
-- Table structure for table `property_valuation_detail`
--

CREATE TABLE `property_valuation_detail` (
  `id` int(11) NOT NULL,
  `darta_id` int(11) NOT NULL,
  `owner` text NOT NULL,
  `plot_no` varchar(20) NOT NULL,
  `biggha` float NOT NULL,
  `kattha` float NOT NULL,
  `dhur` float NOT NULL,
  `paisa` float NOT NULL,
  `total_value` float NOT NULL,
  `remark` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `property_valuation_detail`
--

INSERT INTO `property_valuation_detail` (`id`, `darta_id`, `owner`, `plot_no`, `biggha`, `kattha`, `dhur`, `paisa`, `total_value`, `remark`, `created_at`, `updated_at`) VALUES
(1, 1, 'df', '1547', 2, 2, 2, 0, 212122, '                                    ', '2019-07-28 01:58:03', '2019-07-28 08:13:03'),
(2, 1, 'cf', '1223', 23, 2, 0, 0, 1212320000, '                    ', '2019-07-28 01:58:03', '2019-07-28 08:13:03');

-- --------------------------------------------------------

--
-- Table structure for table `sachiwalaya_darta`
--

CREATE TABLE `sachiwalaya_darta` (
  `id` int(11) NOT NULL,
  `form_id` bigint(20) NOT NULL,
  `session_id` int(11) NOT NULL,
  `is_muncipality` enum('0','1') NOT NULL,
  `darta_no` bigint(20) NOT NULL,
  `patra_chalani_no` int(11) NOT NULL,
  `is_complete` enum('0','1') NOT NULL DEFAULT '0',
  `ward_login` int(11) NOT NULL,
  `department` varchar(10) NOT NULL,
  `link` text NOT NULL,
  `nepali_darta_miti` varchar(50) NOT NULL,
  `english_darta_miti` date NOT NULL,
  `applicant_name` text NOT NULL,
  `letter_subject` text NOT NULL,
  `letter_type` enum('important','most_important','deadlined') NOT NULL,
  `state` int(11) NOT NULL,
  `district` int(11) NOT NULL,
  `local_body` int(11) NOT NULL,
  `ward` int(11) NOT NULL,
  `darta_documents` text NOT NULL,
  `description` text NOT NULL,
  `deadline_nep` varchar(80) NOT NULL,
  `deadline_eng` date NOT NULL,
  `transfer_date_nep` varchar(80) NOT NULL,
  `transfer_date_eng` date NOT NULL,
  `patra_miti_nep` varchar(80) NOT NULL,
  `patra_miti_eng` date NOT NULL,
  `karmachari_name` text NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sachiwalaya_darta`
--

INSERT INTO `sachiwalaya_darta` (`id`, `form_id`, `session_id`, `is_muncipality`, `darta_no`, `patra_chalani_no`, `is_complete`, `ward_login`, `department`, `link`, `nepali_darta_miti`, `english_darta_miti`, `applicant_name`, `letter_subject`, `letter_type`, `state`, `district`, `local_body`, `ward`, `darta_documents`, `description`, `deadline_nep`, `deadline_eng`, `transfer_date_nep`, `transfer_date_eng`, `patra_miti_nep`, `patra_miti_eng`, `karmachari_name`, `user_id`) VALUES
(1, 6453702891, 2, '0', 1, 12, '0', 0, '1', '', '2076-4-22', '2019-08-07', 'Dhiraj Pradhan', 'dasd', 'important', 1, 481, 2191, 1, '', '', '', '0000-00-00', '', '0000-00-00', '2076-04-22', '2019-08-07', 'asdsa', 23),
(2, 7432658109, 2, '0', 2, 12, '0', 0, '4', '', '2076-4-22', '2019-08-07', 'Dhiraj Pradhan', 'test', 'important', 4, 520, 2615, 4, '', '', '', '0000-00-00', '', '0000-00-00', '2076-04-22', '2019-08-07', 'test', 21);

-- --------------------------------------------------------

--
-- Table structure for table `sachiwalaya_darta_details`
--

CREATE TABLE `sachiwalaya_darta_details` (
  `id` int(11) NOT NULL,
  `sachiwalaya_id` int(11) NOT NULL,
  `sent_by` int(11) NOT NULL,
  `sent_to` int(11) NOT NULL,
  `note` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `modified_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sachiwalaya_darta_details`
--

INSERT INTO `sachiwalaya_darta_details` (`id`, `sachiwalaya_id`, `sent_by`, `sent_to`, `note`, `created_at`, `modified_at`) VALUES
(2, 2, 23, 1, 'Testing the transfer', '2019-08-13 06:38:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sadak_khanne_swikriti`
--

CREATE TABLE `sadak_khanne_swikriti` (
  `id` int(11) NOT NULL,
  `form_id` bigint(20) NOT NULL,
  `session_id` int(11) NOT NULL,
  `ward_login` int(11) NOT NULL,
  `status` tinyint(3) NOT NULL,
  `nepali_date` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `applicant_name` text NOT NULL,
  `gender` int(11) NOT NULL,
  `nep_applicated_date` varchar(50) NOT NULL,
  `eng_applicated_date` date NOT NULL,
  `completion_time` int(11) NOT NULL,
  `road_name` text NOT NULL,
  `road_quantity` float NOT NULL,
  `refundable_amount` float NOT NULL,
  `state` int(11) NOT NULL,
  `district` int(11) NOT NULL,
  `local_body` int(11) NOT NULL,
  `ward` int(11) NOT NULL,
  `old_place` text NOT NULL,
  `documents` text NOT NULL,
  `documents_type` varchar(20) NOT NULL,
  `darta_documents` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sadak_khanne_swikriti`
--

INSERT INTO `sadak_khanne_swikriti` (`id`, `form_id`, `session_id`, `ward_login`, `status`, `nepali_date`, `date`, `applicant_name`, `gender`, `nep_applicated_date`, `eng_applicated_date`, `completion_time`, `road_name`, `road_quantity`, `refundable_amount`, `state`, `district`, `local_body`, `ward`, `old_place`, `documents`, `documents_type`, `darta_documents`, `created_at`, `updated_at`) VALUES
(1, 4278619503, 2, 2, 3, '2076-04-10', '2019-07-26', 'Dhiraj Pradhan', 1, '2076-04-10', '2019-07-26', 12, 'Jahada Chowk Road', 123, 12413, 3, 514, 2556, 2, '', '', '', 'Screenshot_(1).png.png', '2019-07-26 03:11:16', '2019-07-26 09:26:25'),
(2, 7891536420, 2, 2, 3, '2076-04-12', '2019-07-28', 'Dhiraj Pradhan', 1, '2076-04-12', '2019-07-28', 123, '123', 12312, 1234, 3, 514, 2556, 2, '', '', '', 'Screenshot_(1)1.png', '2019-07-28 04:30:52', '2019-07-28 10:46:00');

-- --------------------------------------------------------

--
-- Table structure for table `sanstha_darta`
--

CREATE TABLE `sanstha_darta` (
  `id` int(11) NOT NULL,
  `form_id` bigint(20) NOT NULL,
  `session_id` int(11) NOT NULL,
  `ward_login` int(11) NOT NULL,
  `status` tinyint(3) NOT NULL,
  `nepali_date` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `org_name` text NOT NULL,
  `state` int(11) NOT NULL,
  `district` int(11) NOT NULL,
  `local_body` int(11) NOT NULL,
  `ward` int(11) NOT NULL,
  `old_new_address` int(11) NOT NULL,
  `documents` text NOT NULL,
  `documents_type` varchar(50) NOT NULL,
  `darta_documents` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sanstha_darta`
--

INSERT INTO `sanstha_darta` (`id`, `form_id`, `session_id`, `ward_login`, `status`, `nepali_date`, `date`, `org_name`, `state`, `district`, `local_body`, `ward`, `old_new_address`, `documents`, `documents_type`, `darta_documents`, `created_at`, `updated_at`) VALUES
(1, 7529683041, 2, 2, 3, '2076-04-12', '2019-07-28', 'लालु चिया पसल', 3, 514, 2556, 2, 1, '', '', 'Screenshot_(1).png.png', '2019-07-28 12:20:41', '2019-07-28 06:37:24');

-- --------------------------------------------------------

--
-- Table structure for table `sanstha_darta_pramanpatra`
--

CREATE TABLE `sanstha_darta_pramanpatra` (
  `id` int(11) NOT NULL,
  `form_id` bigint(20) NOT NULL,
  `session_id` int(11) NOT NULL,
  `ward_login` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `nepali_date` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `org_name` text NOT NULL,
  `subjected_area` text NOT NULL,
  `darta_no` varchar(15) NOT NULL,
  `nepali_darta_miti` varchar(50) NOT NULL,
  `english_darta_miti` date NOT NULL,
  `org_state` int(11) NOT NULL,
  `org_district` int(11) NOT NULL,
  `org_local_body` int(11) NOT NULL,
  `org_ward` int(11) NOT NULL,
  `org_email` varchar(80) NOT NULL,
  `org_contact_no` varchar(50) NOT NULL,
  `nationality` int(11) NOT NULL,
  `nepali_transact_date` varchar(80) NOT NULL,
  `english_transact_date` date NOT NULL,
  `owner_name` text NOT NULL,
  `own_email` varchar(80) NOT NULL,
  `own_state` int(11) NOT NULL,
  `own_district` int(11) NOT NULL,
  `own_local_body` int(11) NOT NULL,
  `own_ward` int(11) NOT NULL,
  `own_contact_no` varchar(20) NOT NULL,
  `documents` text NOT NULL,
  `documents_type` text NOT NULL,
  `darta_documents` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sanstha_darta_pramanpatra`
--

INSERT INTO `sanstha_darta_pramanpatra` (`id`, `form_id`, `session_id`, `ward_login`, `status`, `nepali_date`, `date`, `org_name`, `subjected_area`, `darta_no`, `nepali_darta_miti`, `english_darta_miti`, `org_state`, `org_district`, `org_local_body`, `org_ward`, `org_email`, `org_contact_no`, `nationality`, `nepali_transact_date`, `english_transact_date`, `owner_name`, `own_email`, `own_state`, `own_district`, `own_local_body`, `own_ward`, `own_contact_no`, `documents`, `documents_type`, `darta_documents`, `created_at`, `updated_at`) VALUES
(1, 6053729418, 2, 2, 3, '2076-04-10', '2019-07-26', 'लालु चिया पसल', 'Testing is all the way', '123', '2076-04-10', '2019-07-26', 3, 514, 2556, 2, 'dpr4dhan@gmail.com', '9842134241', 1, '2076-04-09', '2019-07-25', 'Dhiraj Pradhan', 'dpr4dhan@gmail.com', 3, 514, 2556, 2, '2147483647', '', '', 'Screenshot_(1).png.png', '2019-07-26 03:53:11', '2019-07-26 10:08:21');

-- --------------------------------------------------------

--
-- Table structure for table `sanstha_nabikaran`
--

CREATE TABLE `sanstha_nabikaran` (
  `id` int(11) NOT NULL,
  `form_id` bigint(20) NOT NULL,
  `session_id` int(11) NOT NULL,
  `ward_login` int(11) NOT NULL,
  `status` tinyint(3) NOT NULL,
  `nepali_date` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `org_name` text NOT NULL,
  `state` int(11) NOT NULL,
  `district` int(11) NOT NULL,
  `local_body` int(11) NOT NULL,
  `ward` int(11) NOT NULL,
  `old_new_address` int(11) NOT NULL,
  `documents` text NOT NULL,
  `documents_type` varchar(50) NOT NULL,
  `darta_documents` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sanstha_nabikaran`
--

INSERT INTO `sanstha_nabikaran` (`id`, `form_id`, `session_id`, `ward_login`, `status`, `nepali_date`, `date`, `org_name`, `state`, `district`, `local_body`, `ward`, `old_new_address`, `documents`, `documents_type`, `darta_documents`, `created_at`, `updated_at`) VALUES
(1, 8260914573, 2, 2, 3, '2076-04-12', '2019-07-28', 'लालु चिया पसल', 3, 514, 2556, 2, 1, '', '', 'Screenshot_(1).png.png', '2019-07-28 12:28:25', '2019-07-28 06:44:21');

-- --------------------------------------------------------

--
-- Table structure for table `scholarship`
--

CREATE TABLE `scholarship` (
  `id` int(11) NOT NULL,
  `form_id` bigint(20) NOT NULL,
  `session_id` int(11) NOT NULL,
  `ward_login` int(11) NOT NULL,
  `status` tinyint(3) NOT NULL,
  `nepali_date` varchar(50) NOT NULL,
  `father_name` text NOT NULL,
  `mother_name` text NOT NULL,
  `resident_type` varchar(10) NOT NULL,
  `finance_condition` varchar(4) NOT NULL,
  `date` date NOT NULL,
  `state` int(11) NOT NULL,
  `district` int(11) NOT NULL,
  `local_body` int(11) NOT NULL,
  `ward` int(11) NOT NULL,
  `old_place` int(11) NOT NULL,
  `documents` text NOT NULL,
  `documents_type` varchar(20) NOT NULL,
  `darta_documents` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `scholarship`
--

INSERT INTO `scholarship` (`id`, `form_id`, `session_id`, `ward_login`, `status`, `nepali_date`, `father_name`, `mother_name`, `resident_type`, `finance_condition`, `date`, `state`, `district`, `local_body`, `ward`, `old_place`, `documents`, `documents_type`, `darta_documents`, `created_at`, `updated_at`) VALUES
(1, 8642571930, 2, 2, 3, '2076-04-12', 'Ram Basnet', 'स्रिस्टी श्रेष्ठ', 'Permanent', 'Weak', '2019-07-28', 3, 514, 2556, 2, 1, '', '', 'Screenshot_(1).png.png', '2019-07-28 03:58:17', '2019-07-28 10:13:25');

-- --------------------------------------------------------

--
-- Table structure for table `scholarship_detail`
--

CREATE TABLE `scholarship_detail` (
  `id` int(11) NOT NULL,
  `darta_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `relation` int(11) NOT NULL,
  `ghar_no` varchar(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `scholarship_detail`
--

INSERT INTO `scholarship_detail` (`id`, `darta_id`, `name`, `relation`, `ghar_no`, `created_at`, `updated_at`) VALUES
(1, 1, 'df', 1, '18', '2019-07-28 03:58:17', '2019-07-28 10:13:17');

-- --------------------------------------------------------

--
-- Table structure for table `settings_department`
--

CREATE TABLE `settings_department` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings_department`
--

INSERT INTO `settings_department` (`id`, `name`) VALUES
(1, 'आर्थिक'),
(2, 'खेलकुद'),
(3, 'सामान्य प्रसाशन '),
(4, 'शिक्षा '),
(5, 'स्वास्थ '),
(6, 'योजना शाखा'),
(11, 'जिन्सी '),
(12, 'दर्ता / चलानी'),
(13, 'सुचना / प्रविधी'),
(14, 'सहकारी'),
(15, 'प्राविधिक');

-- --------------------------------------------------------

--
-- Table structure for table `settings_direction`
--

CREATE TABLE `settings_direction` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings_direction`
--

INSERT INTO `settings_direction` (`id`, `name`) VALUES
(1, 'पुर्व'),
(2, 'पश्चिम'),
(3, 'उत्तर'),
(4, 'दक्षिण');

-- --------------------------------------------------------

--
-- Table structure for table `settings_disable_type`
--

CREATE TABLE `settings_disable_type` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings_disable_type`
--

INSERT INTO `settings_disable_type` (`id`, `name`) VALUES
(1, 'शरीरक अपाङ्ग वा विकलाङ्ग'),
(2, 'दृष्टिविहिन र न्युन दृष्टिविहिन'),
(3, 'स्वर वोलाई वा वोल्न नसक्ने'),
(4, 'सुस्त श्रवण'),
(5, 'वौद्धिक अपाङ्ग वा सुस्त मनस्थिति'),
(6, 'श्रवण दृष्टिविहिन'),
(7, 'अटिजम'),
(8, 'होमोफेरिया'),
(9, 'मनो समाजीक अपाङ्गता');

-- --------------------------------------------------------

--
-- Table structure for table `settings_district`
--

CREATE TABLE `settings_district` (
  `id` int(11) NOT NULL,
  `name` text CHARACTER SET utf8 NOT NULL,
  `state` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings_district`
--

INSERT INTO `settings_district` (`id`, `name`, `state`) VALUES
(481, 'ताप्लेजुङ', 1),
(482, 'पाँचथर', 1),
(483, 'ईलाम', 1),
(484, 'झापा', 1),
(485, 'मोरङ', 1),
(486, 'सुनसरी', 1),
(487, 'धनकुटा', 1),
(488, 'तेहथुम', 1),
(489, 'संखुवासभा', 1),
(490, 'भोजपुर', 1),
(491, 'सोलुखुम्बु', 1),
(492, 'ओखलढुंगा', 1),
(493, 'खोटाङ', 1),
(494, 'उदयपुर', 1),
(495, 'सप्तरी', 2),
(496, 'सप्तरी', 2),
(497, 'सिराहा', 2),
(498, 'धनुषा', 2),
(499, 'महोत्तरी', 2),
(500, 'सर्लाही', 2),
(501, 'रौतहट', 2),
(502, 'वारा', 2),
(503, 'पर्सा', 2),
(504, 'सिन्धुली', 3),
(505, 'रामेछाप', 3),
(506, 'दोलखा', 3),
(507, 'सिन्धुपाल्चोक', 3),
(508, 'काभ्रेपलान्चोक', 3),
(509, 'ललितपुर', 3),
(510, 'भक्तपुर', 3),
(511, 'काठमाण्डौ', 3),
(512, 'नुवाकोट', 3),
(513, 'रसुवा', 3),
(514, 'धादिङ', 3),
(515, 'मकवानपुर', 3),
(516, 'चितवन', 3),
(517, 'गोरखा', 4),
(518, 'लमजुङ', 4),
(519, 'तनहुँ', 4),
(520, 'स्याङजा', 4),
(521, 'कास्की', 4),
(522, 'मुस्ताङ', 4),
(523, 'म्याग्दी', 4),
(524, 'पर्वत', 4),
(525, 'वाग्लुङ', 4),
(526, 'नवलपरासी (बर्दघाट सुस्ता पूर्व)', 4),
(527, 'गुल्मी', 5),
(528, 'पाल्पा', 5),
(529, 'रुपन्देही', 5),
(530, 'कपिलबस्तु', 5),
(531, 'अर्घाखाँची', 5),
(532, 'प्यूठान', 5),
(533, 'रोल्पा', 5),
(534, 'रुकुम (पूर्वी भाग)', 5),
(535, 'दाङ', 5),
(536, 'बाँके', 5),
(537, 'बर्दिया', 5),
(538, 'नवलपरासी (बर्दघाट सुस्ता पश्चिम)', 5),
(539, 'रुकुम (पश्चिम भाग)', 6),
(540, 'सल्यान', 6),
(541, 'सुर्खेत', 6),
(542, 'दैलेख', 6),
(543, 'जाजरकोट', 6),
(544, 'डोल्पा', 6),
(545, 'जुम्ला', 6),
(546, 'कालिकोट', 6),
(547, 'मुगु', 6),
(548, 'हुम्ला', 6),
(549, 'बाजुरा', 7),
(550, 'बझाङ', 7),
(551, 'अछाम', 7),
(552, 'डोटी', 7),
(553, 'कैलाली', 7),
(554, 'कञ्चनपुर', 7),
(555, 'डडेलधुरा', 7),
(556, 'बैतडी', 7),
(557, 'दार्चुला', 7);

-- --------------------------------------------------------

--
-- Table structure for table `settings_document`
--

CREATE TABLE `settings_document` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `patra_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings_document`
--

INSERT INTO `settings_document` (`id`, `name`, `patra_id`) VALUES
(1, 'घर जग्गा नामसारी सम्बन्धी निवेदन', 3),
(2, 'नागरिकता प्रमाणपत्रको प्रतिलिपि', 3),
(3, 'निवेदन', 2),
(4, 'निवेदन', 21),
(5, 'जन्म/विवाह/बसाइसराइ/मृत्यु दर्ता प्रतिलिपी', 21),
(6, 'शैक्षिक याेग्यताकाे प्रमाण-पत्रकाे प्रतिलिपी', 21),
(7, 'बाबु/आमा/पति/पत्नीकाे नागरीकता प्रमाण-पत्रकाे प्रतिलिपी', 21);

-- --------------------------------------------------------

--
-- Table structure for table `settings_eutype`
--

CREATE TABLE `settings_eutype` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings_eutype`
--

INSERT INTO `settings_eutype` (`id`, `name`) VALUES
(1, 'घरायसी'),
(2, 'ब्यापारिक'),
(3, 'उत्तर'),
(4, 'दक्षिण'),
(5, 'कृषि');

-- --------------------------------------------------------

--
-- Table structure for table `settings_home_type`
--

CREATE TABLE `settings_home_type` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings_home_type`
--

INSERT INTO `settings_home_type` (`id`, `name`) VALUES
(1, 'अन्य फुसको कच्ची घर'),
(2, 'काठको फुसको कच्ची घर'),
(3, 'काठको भुइँतले कच्ची घर टिन वा टायलको छाना'),
(4, 'काठको टाँडे घर, टिन वा टायलको छाना'),
(5, 'पक्की ईटाको जोडाईमा टिनको छाना'),
(6, 'पक्की छतको ढलान'),
(7, 'माटोको कच्ची घर ');

-- --------------------------------------------------------

--
-- Table structure for table `settings_letter_subject`
--

CREATE TABLE `settings_letter_subject` (
  `id` int(11) NOT NULL,
  `letter_type` int(11) NOT NULL,
  `subject` text NOT NULL,
  `content` longtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings_letter_subject`
--

INSERT INTO `settings_letter_subject` (`id`, `letter_type`, `subject`, `content`, `created_at`, `updated_at`) VALUES
(1, 1, 'बाटो निर्मण', '<p>Please open an account in my/our name with under mentioned details texting the text. Amulya Sharma is a Web Developer.</p>\r\n', '2019-08-08 05:07:30', '2019-08-06 05:50:24'),
(2, 1, 'पुल निर्माण', '<p>यस बैंकमा मेरो नाममा रहेको तपशिलको खातामा जम्मा रहेको तथा जम्मा हुन आउने सम्पूर्ण रकमहरु मेरो मृत्यु भएको अवस्थामा मेरो शेषपछि मैले इच्छाएको तपसिलमा व्यक्ति / व्यक्तिहरुले पाउने गरि यसै इच्छापत्रद्वारा निज / निजहरुलाई सो खाताको रकम पाउने गरि इच्छाएको व्यक्ति / व्यक्तिहरुका रुपमा मनोनीत गर्दछु |</p>\r\n', '2019-08-08 05:07:33', '2019-08-06 10:13:14');

-- --------------------------------------------------------

--
-- Table structure for table `settings_local_body`
--

CREATE TABLE `settings_local_body` (
  `id` int(11) NOT NULL,
  `name` text CHARACTER SET utf8 NOT NULL,
  `district_id` int(11) NOT NULL,
  `type` text CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings_local_body`
--

INSERT INTO `settings_local_body` (`id`, `name`, `district_id`, `type`) VALUES
(2191, 'फुङलिङ नगरपालिका', 481, 'नगरपालिका'),
(2192, 'आठराई त्रिवेणी गाउँपालिका', 481, 'गाउँपालिका'),
(2193, 'सिदिङ्वा गाउँपालिका', 481, 'गाउँपालिका'),
(2194, 'फक्ताङलुङ गाउँपालिका', 481, 'गाउँपालिका'),
(2195, 'मिक्वाखोला गाउँपालिका', 481, 'गाउँपालिका'),
(2196, 'मेरिङदेन गाउँपालिका', 481, 'गाउँपालिका'),
(2197, 'मैवाखोला गाउँपालिका', 481, 'गाउँपालिका'),
(2198, 'याङवरक गाउँपालिका', 481, 'गाउँपालिका'),
(2199, 'सिरीजङ्घा गाउँपालिका', 481, 'गाउँपालिका'),
(2200, 'फिदिम नगरपालिका', 482, 'नगरपालिका'),
(2201, 'फालेलुंग गाउँपालिका', 482, 'गाउँपालिका'),
(2202, 'फाल्गुनन्द गाउँपालिका', 482, 'गाउँपालिका'),
(2203, 'हिलिहाङ गाउँपालिका', 482, 'गाउँपालिका'),
(2204, 'कुम्मायक गाउँपालिका', 482, 'गाउँपालिका'),
(2205, 'मिक्लाजुङ गाउँपालिका', 482, 'गाउँपालिका'),
(2206, 'तुम्बेवा गाउँपालिका', 482, 'गाउँपालिका'),
(2207, 'याङवरक गाउँपालिका', 482, 'गाउँपालिका'),
(2208, 'ईलाम नगरपालिका', 483, 'नगरपालिका'),
(2209, 'देउमाई नगरपालिका', 483, 'नगरपालिका'),
(2210, 'माई नगरपालिका', 483, 'नगरपालिका'),
(2211, 'सूर्योदय नगरपालिका', 483, 'नगरपालिका'),
(2212, 'फाकफोकथुम गाउँपालिका', 483, 'गाउँपालिका'),
(2213, 'चुलाचुली गाउँपालिका', 483, 'गाउँपालिका'),
(2214, 'माईजोगमाई गाउँपालिका', 483, 'गाउँपालिका'),
(2215, 'माङसेबुङ गाउँपालिका', 483, 'गाउँपालिका'),
(2216, 'रोङ गाउँपालिका', 483, 'गाउँपालिका'),
(2217, 'सन्दकपुर गाउँपालिका', 483, 'गाउँपालिका'),
(2218, 'मेचीनगर नगरपालिका', 484, 'नगरपालिका'),
(2219, 'दमक नगरपालिका', 484, 'नगरपालिका'),
(2220, 'कन्काई नगरपालिका', 484, 'नगरपालिका'),
(2221, 'भद्रपुर नगरपालिका', 484, 'नगरपालिका'),
(2222, 'अर्जुनधारा नगरपालिका', 484, 'नगरपालिका'),
(2223, 'शिवशताक्षी नगरपालिका', 484, 'नगरपालिका'),
(2224, 'गौरादह नगरपालिका', 484, 'नगरपालिका'),
(2225, 'विर्तामोड नगरपालिका', 484, 'नगरपालिका'),
(2226, 'कमल गाउँपालिका', 484, 'गाउँपालिका'),
(2227, 'गौरीगंज गाउँपालिका', 484, 'गाउँपालिका'),
(2228, 'बाह्रदशी गाउँपालिका', 484, 'गाउँपालिका'),
(2229, 'झापा गाउँपालिका', 484, 'गाउँपालिका'),
(2230, 'बुद्धशान्ति गाउँपालिका', 484, 'गाउँपालिका'),
(2231, 'हल्दिवारी गाउँपालिका', 484, 'गाउँपालिका'),
(2232, 'कचनकवल गाउँपालिका', 484, 'गाउँपालिका'),
(2233, 'विराटनगर महानगरपालिका', 485, 'महानगरपालिका'),
(2234, 'बेलवारी नगरपालिका', 485, 'नगरपालिका'),
(2235, 'लेटाङ नगरपालिका', 485, 'नगरपालिका'),
(2236, 'पथरी शनिश्चरे नगरपालिका', 485, 'नगरपालिका'),
(2237, 'रंगेली नगरपालिका', 485, 'नगरपालिका'),
(2238, 'रतुवामाई नगरपालिका', 485, 'नगरपालिका'),
(2239, 'सुनवर्षि नगरपालिका', 485, 'नगरपालिका'),
(2240, 'उर्लावारी नगरपालिका', 485, 'नगरपालिका'),
(2241, 'सुन्दरहरैचा नगरपालिका', 485, 'नगरपालिका'),
(2242, 'बुढीगंगा गाउँपालिका', 485, 'गाउँपालिका'),
(2243, 'धनपालथान गाउँपालिका', 485, 'गाउँपालिका'),
(2244, 'ग्रामथान गाउँपालिका', 485, 'गाउँपालिका'),
(2245, 'जहदा गाउँपालिका', 485, 'गाउँपालिका'),
(2246, 'कानेपोखरी गाउँपालिका', 485, 'गाउँपालिका'),
(2247, 'कटहरी गाउँपालिका', 485, 'गाउँपालिका'),
(2248, 'केरावारी गाउँपालिका', 485, 'गाउँपालिका'),
(2249, 'मिक्लाजुङ गाउँपालिका', 485, 'गाउँपालिका'),
(2250, 'ईटहरी उपमहानगरपालिका', 486, 'उपमहानगरपालिका'),
(2251, 'धरान उपमहानगरपालिका', 486, 'उपमहानगरपालिका'),
(2252, 'ईनरुवा नगरपालिका', 486, 'नगरपालिका'),
(2253, 'दुहवी नगरपालिका', 486, 'नगरपालिका'),
(2254, 'रामधुनी नगरपालिका', 486, 'नगरपालिका'),
(2255, 'बराह नगरपालिका', 486, 'नगरपालिका'),
(2256, 'देवानगञ्ज गाउँपालिका', 486, 'गाउँपालिका'),
(2257, 'कोशी गाउँपालिका', 486, 'गाउँपालिका'),
(2258, 'गढी गाउँपालिका', 486, 'गाउँपालिका'),
(2259, 'बर्जु गाउँपालिका', 486, 'गाउँपालिका'),
(2260, 'भोक्राहा गाउँपालिका', 486, 'गाउँपालिका'),
(2261, 'हरिनगरा गाउँपालिका', 486, 'गाउँपालिका'),
(2262, 'पाख्रिबास नगरपालिका', 487, 'नगरपालिका'),
(2263, 'धनकुटा नगरपालिका', 487, 'नगरपालिका'),
(2264, 'महालक्ष्मी नगरपालिका', 487, 'नगरपालिका'),
(2265, 'साँगुरीगढी गाउँपालिका', 487, 'गाउँपालिका'),
(2266, 'खाल्सा छिन्ताङ सहिदभूमि गाउँपालिका', 487, 'गाउँपालिका'),
(2267, 'छथर जोरपाटी गाउँपालिका', 487, 'गाउँपालिका'),
(2268, 'चौविसे गाउँपालिका', 487, 'गाउँपालिका'),
(2269, 'म्याङलुङ नगरपालिका', 488, 'नगरपालिका'),
(2270, 'लालीगुराँस नगरपालिका', 488, 'नगरपालिका'),
(2271, 'आठराई गाउँपालिका', 488, 'गाउँपालिका'),
(2272, 'छथर गाउँपालिका', 488, 'गाउँपालिका'),
(2273, 'फेदाप गाउँपालिका', 488, 'गाउँपालिका'),
(2274, 'मेन्छयायेम गाउँपालिका', 488, 'गाउँपालिका'),
(2275, 'चैनपुर नगरपालिका', 489, 'नगरपालिका'),
(2276, 'धर्मदेवी नगरपालिका', 489, 'नगरपालिका'),
(2277, 'खाँदवारी नगरपालिका', 489, 'नगरपालिका'),
(2278, 'मादी नगरपालिका', 489, 'नगरपालिका'),
(2279, 'पाँचखपन नगरपालिका', 489, 'नगरपालिका'),
(2280, 'भोटखोला गाउँपालिका', 489, 'गाउँपालिका'),
(2281, 'चिचिला गाउँपालिका', 489, 'गाउँपालिका'),
(2282, 'मकालु गाउँपालिका', 489, 'गाउँपालिका'),
(2283, 'सभापोखरी गाउँपालिका', 489, 'गाउँपालिका'),
(2284, 'सिलीचोङ गाउँपालिका', 489, 'गाउँपालिका'),
(2285, 'भोजपुर नगरपालिका', 490, 'नगरपालिका'),
(2286, 'षडानन्द नगरपालिका', 490, 'नगरपालिका'),
(2287, 'ट्याम्केमैयुम गाउँपालिका', 490, 'गाउँपालिका'),
(2288, 'रामप्रसाद राई गाउँपालिका', 490, 'गाउँपालिका'),
(2289, 'अरुण गाउँपालिका', 490, 'गाउँपालिका'),
(2290, 'पौवादुङमा गाउँपालिका', 490, 'गाउँपालिका'),
(2291, 'साल्पासिलिछो गाउँपालिका', 490, 'गाउँपालिका'),
(2292, 'आमचोक गाउँपालिका', 490, 'गाउँपालिका'),
(2293, 'हतुवागढी गाउँपालिका', 490, 'गाउँपालिका'),
(2294, 'सोलुदुधकुण्ड नगरपालिका', 491, 'नगरपालिका'),
(2295, 'दुधकोसी गाउँपालिका', 491, 'गाउँपालिका'),
(2296, 'खुम्वु पासाङल्हमु गाउँपालिका', 491, 'गाउँपालिका'),
(2297, 'दुधकौशिका गाउँपालिका', 491, 'गाउँपालिका'),
(2298, 'नेचासल्यान गाउँपालिका', 491, 'गाउँपालिका'),
(2299, 'माहाकुलुङ गाउँपालिका', 491, 'गाउँपालिका'),
(2300, 'लिखु पिके गाउँपालिका', 491, 'गाउँपालिका'),
(2301, 'सोताङ गाउँपालिका', 491, 'गाउँपालिका'),
(2302, 'सिद्दिचरण नगरपालिका', 492, 'नगरपालिका'),
(2303, 'खिजिदेम्बा गाउँपालिका', 492, 'गाउँपालिका'),
(2304, 'चम्पादेवी गाउँपालिका', 492, 'गाउँपालिका'),
(2305, 'चिशंखुगढी गाउँपालिका', 492, 'गाउँपालिका'),
(2306, 'मानेभञ्याङ गाउँपालिका', 492, 'गाउँपालिका'),
(2307, 'मोलुङ गाउँपालिका', 492, 'गाउँपालिका'),
(2308, 'लिखु गाउँपालिका', 492, 'गाउँपालिका'),
(2309, 'सुनकोशी गाउँपालिका', 492, 'गाउँपालिका'),
(2310, 'हलेसी तुवाचुङ नगरपालिका', 493, 'नगरपालिका'),
(2311, 'रुपाकोट मझुवागढी नगरपालिका', 493, 'नगरपालिका'),
(2312, 'ऐसेलुखर्क गाउँपालिका', 493, 'गाउँपालिका'),
(2313, 'लामीडाँडा गाउँपालिका', 493, 'गाउँपालिका'),
(2314, 'जन्तेढुंगा गाउँपालिका', 493, 'गाउँपालिका'),
(2315, 'खोटेहाङ गाउँपालिका', 493, 'गाउँपालिका'),
(2316, 'केपिलासगढी गाउँपालिका', 493, 'गाउँपालिका'),
(2317, 'दिप्रुङ गाउँपालिका', 493, 'गाउँपालिका'),
(2318, 'साकेला गाउँपालिका', 493, 'गाउँपालिका'),
(2319, 'वराहपोखरी गाउँपालिका', 493, 'गाउँपालिका'),
(2320, 'कटारी नगरपालिका', 494, 'नगरपालिका'),
(2321, 'चौदण्डीगढी नगरपालिका', 494, 'नगरपालिका'),
(2322, 'त्रियुगा नगरपालिका', 494, 'नगरपालिका'),
(2323, 'वेलका नगरपालिका', 494, 'नगरपालिका'),
(2324, 'उदयपुरगढी गाउँपालिका', 494, 'गाउँपालिका'),
(2325, 'ताप्ली गाउँपालिका', 494, 'गाउँपालिका'),
(2326, 'रौतामाई गाउँपालिका', 494, 'गाउँपालिका'),
(2327, 'सुनकोशी गाउँपालिका', 494, 'गाउँपालिका'),
(2328, 'राजविराज नगरपालिका', 496, 'नगरपालिका'),
(2329, 'कञ्चनरुप नगरपालिका', 496, 'नगरपालिका'),
(2330, 'डाक्नेश्वरी नगरपालिका', 496, 'नगरपालिका'),
(2331, 'बोदेबरसाईन नगरपालिका', 496, 'नगरपालिका'),
(2332, 'खडक नगरपालिका', 496, 'नगरपालिका'),
(2333, 'शम्भुनाथ नगरपालिका', 496, 'नगरपालिका'),
(2334, 'सुरुङ्‍गा नगरपालिका', 496, 'नगरपालिका'),
(2335, 'हनुमाननगर कङ्‌कालिनी नगरपालिका', 496, 'नगरपालिका'),
(2336, 'सप्तकोशी नगरपालिका', 496, 'नगरपालिका'),
(2337, 'अग्निसाइर कृष्णासवरन गाउँपालिका', 496, 'गाउँपालिका'),
(2338, 'छिन्नमस्ता गाउँपालिका', 496, 'गाउँपालिका'),
(2339, 'महादेवा गाउँपालिका', 496, 'गाउँपालिका'),
(2340, 'तिरहुत गाउँपालिका', 496, 'गाउँपालिका'),
(2341, 'तिलाठी कोईलाडी गाउँपालिका', 496, 'गाउँपालिका'),
(2342, 'रुपनी गाउँपालिका', 496, 'गाउँपालिका'),
(2343, 'बेल्ही चपेना गाउँपालिका', 496, 'गाउँपालिका'),
(2344, 'बिष्णुपुर गाउँपालिका', 496, 'गाउँपालिका'),
(2345, 'बलान-बिहुल गाउँपालिका', 496, 'गाउँपालिका'),
(2346, 'लहान नगरपालिका', 497, 'नगरपालिका'),
(2347, 'धनगढीमाई नगरपालिका', 497, 'नगरपालिका'),
(2348, 'सिरहा नगरपालिका', 497, 'नगरपालिका'),
(2349, 'गोलबजार नगरपालिका', 497, 'नगरपालिका'),
(2350, 'मिर्चैयाँ नगरपालिका', 497, 'नगरपालिका'),
(2351, 'कल्याणपुर नगरपालिका', 497, 'नगरपालिका'),
(2352, 'कर्जन्हा नगरपालिका', 497, 'नगरपालिका'),
(2353, 'सुखीपुर नगरपालिका', 497, 'नगरपालिका'),
(2354, 'भगवानपुर गाउँपालिका', 497, 'गाउँपालिका'),
(2355, 'औरही गाउँपालिका', 497, 'गाउँपालिका'),
(2356, 'विष्णुपुर गाउँपालिका', 497, 'गाउँपालिका'),
(2357, 'बरियारपट्टी गाउँपालिका', 497, 'गाउँपालिका'),
(2358, 'लक्ष्मीपुर पतारी गाउँपालिका', 497, 'गाउँपालिका'),
(2359, 'नरहा गाउँपालिका', 497, 'गाउँपालिका'),
(2360, 'सखुवानान्कारकट्टी गाउँपालिका', 497, 'गाउँपालिका'),
(2361, 'अर्नमा गाउँपालिका', 497, 'गाउँपालिका'),
(2362, 'नवराजपुर गाउँपालिका', 497, 'गाउँपालिका'),
(2363, 'जनकपुर उपमहानगरपालिका', 498, 'उपमहानगरपालिका'),
(2364, 'क्षिरेश्वरनाथ नगरपालिका', 498, 'नगरपालिका'),
(2365, 'गणेशमान चारनाथ नगरपालिका', 498, 'नगरपालिका'),
(2366, 'धनुषाधाम नगरपालिका', 498, 'नगरपालिका'),
(2367, 'नगराइन नगरपालिका', 498, 'नगरपालिका'),
(2368, 'विदेह नगरपालिका', 498, 'नगरपालिका'),
(2369, 'मिथिला नगरपालिका', 498, 'नगरपालिका'),
(2370, 'शहीदनगर नगरपालिका', 498, 'नगरपालिका'),
(2371, 'सबैला नगरपालिका', 498, 'नगरपालिका'),
(2372, 'कमला नगरपालिका', 498, 'नगरपालिका'),
(2373, 'मिथिला बिहारी नगरपालिका', 498, 'नगरपालिका'),
(2374, 'हंसपुर नगरपालिका', 498, 'नगरपालिका'),
(2375, 'जनकनन्दिनी गाउँपालिका', 498, 'गाउँपालिका'),
(2376, 'बटेश्वर गाउँपालिका', 498, 'गाउँपालिका'),
(2377, 'मुखियापट्टी मुसहरमिया गाउँपालिका', 498, 'गाउँपालिका'),
(2378, 'लक्ष्मीनिया गाउँपालिका', 498, 'गाउँपालिका'),
(2379, 'औरही गाउँपालिका', 498, 'गाउँपालिका'),
(2380, 'धनौजी गाउँपालिका', 498, 'गाउँपालिका'),
(2381, 'जलेश्वर नगरपालिका', 499, 'नगरपालिका'),
(2382, 'बर्दिबास नगरपालिका', 499, 'नगरपालिका'),
(2383, 'गौशाला नगरपालिका', 499, 'नगरपालिका'),
(2384, 'लोहरपट्टी नगरपालिका', 499, 'नगरपालिका'),
(2385, 'रामगोपालपुर नगरपालिका', 499, 'नगरपालिका'),
(2386, 'मनरा शिसवा नगरपालिका', 499, 'नगरपालिका'),
(2387, 'मटिहानी नगरपालिका', 499, 'नगरपालिका'),
(2388, 'भँगाहा नगरपालिका', 499, 'नगरपालिका'),
(2389, 'बलवा नगरपालिका', 499, 'नगरपालिका'),
(2390, 'औरही नगरपालिका', 499, 'नगरपालिका'),
(2391, 'एकडारा गाउँपालिका', 499, 'गाउँपालिका'),
(2392, 'सोनमा गाउँपालिका', 499, 'गाउँपालिका'),
(2393, 'साम्सी गाउँपालिका', 499, 'गाउँपालिका'),
(2394, 'महोत्तरी गाउँपालिका', 499, 'गाउँपालिका'),
(2395, 'पिपरा गाउँपालिका', 499, 'गाउँपालिका'),
(2396, 'ईश्वरपुर नगरपालिका', 500, 'नगरपालिका'),
(2397, 'मलंगवा नगरपालिका', 500, 'नगरपालिका'),
(2398, 'लालबन्दी नगरपालिका', 500, 'नगरपालिका'),
(2399, 'हरिपुर नगरपालिका', 500, 'नगरपालिका'),
(2400, 'हरिपुर्वा नगरपालिका', 500, 'नगरपालिका'),
(2401, 'हरिवन नगरपालिका', 500, 'नगरपालिका'),
(2402, 'बरहथवा नगरपालिका', 500, 'नगरपालिका'),
(2403, 'बलरा नगरपालिका', 500, 'नगरपालिका'),
(2404, 'गोडैटा नगरपालिका', 500, 'नगरपालिका'),
(2405, 'बागमती नगरपालिका', 500, 'नगरपालिका'),
(2406, 'कविलासी नगरपालिका', 500, 'नगरपालिका'),
(2407, 'चक्रघट्टा गाउँपालिका', 500, 'गाउँपालिका'),
(2408, 'चन्द्रनगर गाउँपालिका', 500, 'गाउँपालिका'),
(2409, 'धनकौल गाउँपालिका', 500, 'गाउँपालिका'),
(2410, 'ब्रह्मपुरी गाउँपालिका', 500, 'गाउँपालिका'),
(2411, 'रामनगर गाउँपालिका', 500, 'गाउँपालिका'),
(2412, 'विष्णु गाउँपालिका', 500, 'गाउँपालिका'),
(2413, 'कौडेना गाउँपालिका', 500, 'गाउँपालिका'),
(2414, 'पर्सा गाउँपालिका', 500, 'गाउँपालिका'),
(2415, 'बसबरीया गाउँपालिका', 500, 'गाउँपालिका'),
(2416, 'चन्द्रपुर नगरपालिका', 501, 'नगरपालिका'),
(2417, 'गरुडा नगरपालिका', 501, 'नगरपालिका'),
(2418, 'गौर नगरपालिका', 501, 'नगरपालिका'),
(2419, 'बौधीमाई नगरपालिका', 501, 'नगरपालिका'),
(2420, 'बृन्दावन नगरपालिका', 501, 'नगरपालिका'),
(2421, 'देवाही गोनाही नगरपालिका', 501, 'नगरपालिका'),
(2422, 'गढीमाई नगरपालिका', 501, 'नगरपालिका'),
(2423, 'गुजरा नगरपालिका', 501, 'नगरपालिका'),
(2424, 'कटहरिया नगरपालिका', 501, 'नगरपालिका'),
(2425, 'माधव नारायण नगरपालिका', 501, 'नगरपालिका'),
(2426, 'मौलापुर नगरपालिका', 501, 'नगरपालिका'),
(2427, 'फतुवाबिजयपुर नगरपालिका', 501, 'नगरपालिका'),
(2428, 'ईशनाथ नगरपालिका', 501, 'नगरपालिका'),
(2429, 'परोहा नगरपालिका', 501, 'नगरपालिका'),
(2430, 'राजपुर नगरपालिका', 501, 'नगरपालिका'),
(2431, 'राजदेवी नगरपालिका', 501, 'नगरपालिका'),
(2432, 'दुर्गा भगवती गाउँपालिका', 501, 'गाउँपालिका'),
(2433, 'यमुनामाई गाउँपालिका', 501, 'गाउँपालिका'),
(2434, 'कलैया उपमहानगरपालिका', 502, 'उपमहानगरपालिका'),
(2435, 'जीतपुर सिमरा उपमहानगरपालिका', 502, 'उपमहानगरपालिका'),
(2436, 'कोल्हवी नगरपालिका', 502, 'नगरपालिका'),
(2437, 'निजगढ नगरपालिका', 502, 'नगरपालिका'),
(2438, 'महागढीमाई नगरपालिका', 502, 'नगरपालिका'),
(2439, 'सिम्रौनगढ नगरपालिका', 502, 'नगरपालिका'),
(2440, 'पचरौता नगरपालिका', 502, 'नगरपालिका'),
(2441, 'आदर्श कोटवाल गाउँपालिका', 502, 'गाउँपालिका'),
(2442, 'करैयामाई गाउँपालिका', 502, 'गाउँपालिका'),
(2443, 'देवताल गाउँपालिका', 502, 'गाउँपालिका'),
(2444, 'परवानीपुर गाउँपालिका', 502, 'गाउँपालिका'),
(2445, 'प्रसौनी गाउँपालिका', 502, 'गाउँपालिका'),
(2446, 'फेटा गाउँपालिका', 502, 'गाउँपालिका'),
(2447, 'बारागढीगाउँपालिका', 502, 'गाउँपालिका'),
(2448, 'सुवर्ण गाउँपालिका', 502, 'गाउँपालिका'),
(2449, 'विश्रामपुर गाउँपालिका', 502, 'गाउँपालिका'),
(2450, 'बिरगंज महानगरपालिका', 503, 'महानगरपालिका'),
(2451, 'पोखरिया नगरपालिका', 503, 'नगरपालिका'),
(2452, 'बहुदरमाई नगरपालिका', 503, 'नगरपालिका'),
(2453, 'पर्सागढी नगरपालिका', 503, 'नगरपालिका'),
(2454, 'ठोरी गाउँपालिका', 503, 'गाउँपालिका'),
(2455, 'जगरनाथपुर गाउँपालिका', 503, 'गाउँपालिका'),
(2456, 'धोबीनी गाउँपालिका', 503, 'गाउँपालिका'),
(2457, 'छिपहरमाई गाउँपालिका', 503, 'गाउँपालिका'),
(2458, 'पकाहा मैनपुर गाउँपालिका', 503, 'गाउँपालिका'),
(2459, 'बिन्दबासिनी गाउँपालिका', 503, 'गाउँपालिका'),
(2460, 'सखुवा प्रसौनी गाउँपालिका', 503, 'गाउँपालिका'),
(2461, 'पटेर्वा सुगौली गाउँपालिका', 503, 'गाउँपालिका'),
(2462, 'कालिकामाई गाउँपालिका', 503, 'गाउँपालिका'),
(2463, 'जिरा भवानी गाउँपालिका', 503, 'गाउँपालिका'),
(2464, 'कमलामाई नगरपालिका', 504, 'नगरपालिका'),
(2465, 'दुधौली नगरपालिका', 504, 'नगरपालिका'),
(2466, 'गोलन्जर गाउँपालिका', 504, 'गाउँपालिका'),
(2467, 'घ्याङलेख गाउँपालिका', 504, 'गाउँपालिका'),
(2468, 'तीनपाटन गाउँपालिका', 504, 'गाउँपालिका'),
(2469, 'फिक्कल गाउँपालिका', 504, 'गाउँपालिका'),
(2470, 'मरिण गाउँपालिका', 504, 'गाउँपालिका'),
(2471, 'सुनकोशी गाउँपालिका', 504, 'गाउँपालिका'),
(2472, 'हरिहरपुरगढी गाउँपालिका', 504, 'गाउँपालिका'),
(2473, 'मन्थली नगरपालिका', 505, 'नगरपालिका'),
(2474, 'रामेछाप नगरपालिका', 505, 'नगरपालिका'),
(2475, 'उमाकुण्ड गाउँपालिका', 505, 'गाउँपालिका'),
(2476, 'खाँडादेवी गाउँपालिका', 505, 'गाउँपालिका'),
(2477, 'गोकुलगङ्गा गाउँपालिका', 505, 'गाउँपालिका'),
(2478, 'दोरम्बा गाउँपालिका', 505, 'गाउँपालिका'),
(2479, 'लिखु गाउँपालिका', 505, 'गाउँपालिका'),
(2480, 'सुनापती गाउँपालिका', 505, 'गाउँपालिका'),
(2481, 'जिरी नगरपालिका', 506, 'नगरपालिका'),
(2482, 'भिमेश्वर नगरपालिका', 506, 'नगरपालिका'),
(2483, 'कालिन्चोक गाउँपालिका', 506, 'गाउँपालिका'),
(2484, 'गौरीशङ्कर गाउँपालिका', 506, 'गाउँपालिका'),
(2485, 'तामाकोशी गाउँपालिका', 506, 'गाउँपालिका'),
(2486, 'मेलुङ्ग गाउँपालिका', 506, 'गाउँपालिका'),
(2487, 'विगु गाउँपालिका', 506, 'गाउँपालिका'),
(2488, 'वैतेश्वर गाउँपालिका', 506, 'गाउँपालिका'),
(2489, 'शैलुङ्ग गाउँपालिका', 506, 'गाउँपालिका'),
(2490, 'चौतारा साँगाचोकगढी नगरपालिका', 507, 'नगरपालिका'),
(2491, 'बाह्रविसे नगरपालिका', 507, 'नगरपालिका'),
(2492, 'मेलम्ची नगरपालिका', 507, 'नगरपालिका'),
(2493, 'ईन्द्रावती गाउँपालिका', 507, 'गाउँपालिका'),
(2494, 'जुगल गाउँपालिका', 507, 'गाउँपालिका'),
(2495, 'पाँचपोखरी थाङपाल गाउँपालिका', 507, 'गाउँपालिका'),
(2496, 'बलेफी गाउँपालिका', 507, 'गाउँपालिका'),
(2497, 'भोटेकोशी गाउँपालिका', 507, 'गाउँपालिका'),
(2498, 'लिसङ्खु पाखर गाउँपालिका', 507, 'गाउँपालिका'),
(2499, 'सुनकोशी गाउँपालिका', 507, 'गाउँपालिका'),
(2500, 'हेलम्बु गाउँपालिका', 507, 'गाउँपालिका'),
(2501, 'त्रिपुरासुन्दरी गाउँपालिका', 507, 'गाउँपालिका'),
(2502, 'धुलिखेल नगरपालिका', 508, 'नगरपालिका'),
(2503, 'बनेपा नगरपालिका', 508, 'नगरपालिका'),
(2504, 'पनौती नगरपालिका', 508, 'नगरपालिका'),
(2505, 'पाँचखाल नगरपालिका', 508, 'नगरपालिका'),
(2506, 'नमोबुद्ध नगरपालिका', 508, 'नगरपालिका'),
(2507, 'मण्डनदेउपुर नगरपालिका', 508, 'नगरपालिका'),
(2508, 'खानीखोला गाउँपालिका', 508, 'गाउँपालिका'),
(2509, 'चौंरीदेउराली गाउँपालिका', 508, 'गाउँपालिका'),
(2510, 'तेमाल गाउँपालिका', 508, 'गाउँपालिका'),
(2511, 'बेथानचोक गाउँपालिका', 508, 'गाउँपालिका'),
(2512, 'भुम्लु गाउँपालिका', 508, 'गाउँपालिका'),
(2513, 'महाभारत गाउँपालिका', 508, 'गाउँपालिका'),
(2514, 'रोशी गाउँपालिका', 508, 'गाउँपालिका'),
(2515, 'ललितपुर महानगरपालिका', 509, 'महानगरपालिका'),
(2516, 'गोदावरी नगरपालिका', 509, 'नगरपालिका'),
(2517, 'महालक्ष्मी नगरपालिका', 509, 'नगरपालिका'),
(2518, 'कोन्ज्योसोम गाउँपालिका', 509, 'गाउँपालिका'),
(2519, 'बागमती गाउँपालिका', 509, 'गाउँपालिका'),
(2520, 'महाङ्काल गाउँपालिका', 509, 'गाउँपालिका'),
(2521, 'चाँगुनारायण नगरपालिका', 510, 'नगरपालिका'),
(2522, 'भक्तपुर नगरपालिका', 510, 'नगरपालिका'),
(2523, 'मध्यपुर थिमी नगरपालिका', 510, 'नगरपालिका'),
(2524, 'सूर्यविनायक नगरपालिका', 510, 'नगरपालिका'),
(2525, 'काठमाण्डौं महानगरपालिका', 511, 'महानगरपालिका'),
(2526, 'कागेश्वरी मनोहरा नगरपालिका', 511, 'नगरपालिका'),
(2527, 'कीर्तिपुर नगरपालिका', 511, 'नगरपालिका'),
(2528, 'गोकर्णेश्वर नगरपालिका', 511, 'नगरपालिका'),
(2529, 'चन्द्रागिरी नगरपालिका', 511, 'नगरपालिका'),
(2530, 'टोखा नगरपालिका', 511, 'नगरपालिका'),
(2531, 'तारकेश्वर नगरपालिका', 511, 'नगरपालिका'),
(2532, 'दक्षिणकाली नगरपालिका', 511, 'नगरपालिका'),
(2533, 'नागार्जुन नगरपालिका', 511, 'नगरपालिका'),
(2534, 'बुढानिलकण्ठ नगरपालिका', 511, 'नगरपालिका'),
(2535, 'शङ्खरापुर नगरपालिका', 511, 'नगरपालिका'),
(2536, 'विदुर नगरपालिका', 512, 'नगरपालिका'),
(2537, 'बेलकोटगढी नगरपालिका', 512, 'नगरपालिका'),
(2538, 'ककनी गाउँपालिका', 512, 'गाउँपालिका'),
(2539, 'किस्पाङ गाउँपालिका', 512, 'गाउँपालिका'),
(2540, 'तादी गाउँपालिका', 512, 'गाउँपालिका'),
(2541, 'तारकेश्वर गाउँपालिका', 512, 'गाउँपालिका'),
(2542, 'दुप्चेश्वर गाउँपालिका', 512, 'गाउँपालिका'),
(2543, 'पञ्चकन्या गाउँपालिका', 512, 'गाउँपालिका'),
(2544, 'लिखु गाउँपालिका', 512, 'गाउँपालिका'),
(2545, 'मेघाङ गाउँपालिका', 512, 'गाउँपालिका'),
(2546, 'शिवपुरी गाउँपालिका', 512, 'गाउँपालिका'),
(2547, 'सुर्यगढी गाउँपालिका', 512, 'गाउँपालिका'),
(2548, 'उत्तरगया गाउँपालिका', 513, 'गाउँपालिका'),
(2549, 'कालिका गाउँपालिका', 513, 'गाउँपालिका'),
(2550, 'गोसाईकुण्ड गाउँपालिका', 513, 'गाउँपालिका'),
(2551, 'नौकुण्ड गाउँपालिका', 513, 'गाउँपालिका'),
(2552, 'पार्वतीकुण्ड गाउँपालिका', 513, 'गाउँपालिका'),
(2553, 'धुनीबेंशी नगरपालिका', 514, 'नगरपालिका'),
(2554, 'निलकण्ठ नगरपालिका', 514, 'नगरपालिका'),
(2555, 'खनियाबास गाउँपालिका', 514, 'गाउँपालिका'),
(2556, 'गजुरी गाउँपालिका', 514, 'गाउँपालिका'),
(2557, 'गल्छी गाउँपालिका', 514, 'गाउँपालिका'),
(2558, 'गङ्गाजमुना गाउँपालिका', 514, 'गाउँपालिका'),
(2559, 'ज्वालामूखी गाउँपालिका', 514, 'गाउँपालिका'),
(2560, 'थाक्रे गाउँपालिका', 514, 'गाउँपालिका'),
(2561, 'नेत्रावति गाउँपालिका', 514, 'गाउँपालिका'),
(2562, 'बेनीघाट रोराङ गाउँपालिका', 514, 'गाउँपालिका'),
(2563, 'रुवी भ्याली गाउँपालिका', 514, 'गाउँपालिका'),
(2564, 'सिद्धलेक गाउँपालिका', 514, 'गाउँपालिका'),
(2565, 'त्रिपुरासुन्दरी गाउँपालिका', 514, 'गाउँपालिका'),
(2566, 'हेटौडा उपमहानगरपालिका', 515, 'उपमहानगरपालिका'),
(2567, 'थाहा नगरपालिका', 515, 'नगरपालिका'),
(2568, 'इन्द्रसरोबर गाउँपालिका', 515, 'गाउँपालिका'),
(2569, 'कैलाश गाउँपालिका', 515, 'गाउँपालिका'),
(2570, 'बकैया गाउँपालिका', 515, 'गाउँपालिका'),
(2571, 'बाग्मति गाउँपालिका', 515, 'गाउँपालिका'),
(2572, 'भिमफेदी गाउँपालिका', 515, 'गाउँपालिका'),
(2573, 'मकवानपुरगढी गाउँपालिका', 515, 'गाउँपालिका'),
(2574, 'मनहरी गाउँपालिका', 515, 'गाउँपालिका'),
(2575, 'राक्सिराङ्ग गाउँपालिका', 515, 'गाउँपालिका'),
(2576, 'भरतपुर महानगरपालिका', 516, 'महानगरपालिका'),
(2577, 'कालिका नगरपालिका', 516, 'नगरपालिका'),
(2578, 'खैरहनी नगरपालिका', 516, 'नगरपालिका'),
(2579, 'माडी नगरपालिका', 516, 'नगरपालिका'),
(2580, 'रत्ननगर नगरपालिका', 516, 'नगरपालिका'),
(2581, 'राप्ती नगरपालिका', 516, 'नगरपालिका'),
(2582, 'इच्छाकामना गाउँपालिका', 516, 'गाउँपालिका'),
(2583, 'गोरखा नगरपालिका', 517, 'नगरपालिका'),
(2584, 'पालुङटार नगरपालिका', 517, 'नगरपालिका'),
(2585, 'सुलीकोट गाउँपालिका', 517, 'गाउँपालिका'),
(2586, 'सिरानचोक गाउँपालिका', 517, 'गाउँपालिका'),
(2587, 'अजिरकोट गाउँपालिका', 517, 'गाउँपालिका'),
(2588, 'आरूघाट गाउँपालिका', 517, 'गाउँपालिका'),
(2589, 'गण्डकी गाउँपालिका', 517, 'गाउँपालिका'),
(2590, 'चुमनुव्री गाउँपालिका', 517, 'गाउँपालिका'),
(2591, 'धार्चे गाउँपालिका', 517, 'गाउँपालिका'),
(2592, 'भिमसेन गाउँपालिका', 517, 'गाउँपालिका'),
(2593, 'शहिद लखन गाउँपालिका', 517, 'गाउँपालिका'),
(2594, 'बेसीशहर नगरपालिका', 518, 'नगरपालिका'),
(2595, 'मध्यनेपाल नगरपालिका', 518, 'नगरपालिका'),
(2596, 'रार्इनास नगरपालिका', 518, 'नगरपालिका'),
(2597, 'सुन्दरबजार नगरपालिका', 518, 'नगरपालिका'),
(2598, 'क्व्होलासोथार गाउँपालिका', 518, 'गाउँपालिका'),
(2599, 'दूधपोखरी गाउँपालिका', 518, 'गाउँपालिका'),
(2600, 'दोर्दी गाउँपालिका', 518, 'गाउँपालिका'),
(2601, 'मर्स्याङदी गाउँपालिका', 518, 'गाउँपालिका'),
(2602, 'भानु नगरपालिका', 519, 'नगरपालिका'),
(2603, 'भिमाद नगरपालिका', 519, 'नगरपालिका'),
(2604, 'व्यास नगरपालिका', 519, 'नगरपालिका'),
(2605, 'शुक्लागण्डकी नगरपालिका', 519, 'नगरपालिका'),
(2606, 'आँबुखैरेनी गाउँपालिका', 519, 'गाउँपालिका'),
(2607, 'ऋषिङ्ग गाउँपालिका', 519, 'गाउँपालिका'),
(2608, 'घिरिङ गाउँपालिका', 519, 'गाउँपालिका'),
(2609, 'देवघाट गाउँपालिका', 519, 'गाउँपालिका'),
(2610, 'म्याग्दे गाउँपालिका', 519, 'गाउँपालिका'),
(2611, 'वन्दिपुर गाउँपालिका', 519, 'गाउँपालिका'),
(2612, 'गल्याङ नगरपालिका', 520, 'नगरपालिका'),
(2613, 'चापाकोट नगरपालिका', 520, 'नगरपालिका'),
(2614, 'पुतलीबजार नगरपालिका', 520, 'नगरपालिका'),
(2615, 'भीरकोट नगरपालिका', 520, 'नगरपालिका'),
(2616, 'वालिङ नगरपालिका', 520, 'नगरपालिका'),
(2617, 'अर्जुनचौपारी गाउँपालिका', 520, 'गाउँपालिका'),
(2618, 'आँधिखोला गाउँपालिका', 520, 'गाउँपालिका'),
(2619, 'कालीगण्डकी गाउँपालिका', 520, 'गाउँपालिका'),
(2620, 'फेदीखोला गाउँपालिका', 520, 'गाउँपालिका'),
(2621, 'बिरुवा गाउँपालिका', 520, 'गाउँपालिका'),
(2622, 'हरिनास गाउँपालिका', 520, 'गाउँपालिका'),
(2623, 'पोखरा लेखनाथ महानगरपालिका', 521, 'महानगरपालिका'),
(2624, 'अन्नपूर्ण गाउँपालिका', 521, 'गाउँपालिका'),
(2625, 'माछापुच्छ्रे गाउँपालिका', 521, 'गाउँपालिका'),
(2626, 'मादी गाउँपालिका', 521, 'गाउँपालिका'),
(2627, 'रूपा गाउँपालिका', 521, 'गाउँपालिका'),
(2628, 'चामे गाउँपालिका', 0, 'गाउँपालिका'),
(2629, 'नारफू गाउँपालिका', 0, 'गाउँपालिका'),
(2630, 'नाशोङ गाउँपालिका', 0, 'गाउँपालिका'),
(2631, 'नेस्याङ गाउँपालिका', 0, 'गाउँपालिका'),
(2632, 'घरपझोङ गाउँपालिका', 522, 'गाउँपालिका'),
(2633, 'थासाङ गाउँपालिका', 522, 'गाउँपालिका'),
(2634, 'दालोमे गाउँपालिका', 522, 'गाउँपालिका'),
(2635, 'लोमन्थाङ गाउँपालिका', 522, 'गाउँपालिका'),
(2636, 'वाह्रगाउँ मुक्तिक्षेत्र गाउँपालिका', 522, 'गाउँपालिका'),
(2637, 'बेनी नगरपालिका', 523, 'नगरपालिका'),
(2638, 'अन्नपूर्ण गाउँपालिका', 523, 'गाउँपालिका'),
(2639, 'धवलागिरी गाउँपालिका', 523, 'गाउँपालिका'),
(2640, 'मंगला गाउँपालिका', 523, 'गाउँपालिका'),
(2641, 'मालिका गाउँपालिका', 523, 'गाउँपालिका'),
(2642, 'रघुगंगा गाउँपालिका', 523, 'गाउँपालिका'),
(2643, 'कुश्मा नगरपालिका', 524, 'नगरपालिका'),
(2644, 'फलेवास नगरपालिका', 524, 'नगरपालिका'),
(2645, 'जलजला गाउँपालिका', 524, 'गाउँपालिका'),
(2646, 'पैयूं गाउँपालिका', 524, 'गाउँपालिका'),
(2647, 'महाशिला गाउँपालिका', 524, 'गाउँपालिका'),
(2648, 'मोदी गाउँपालिका', 524, 'गाउँपालिका'),
(2649, 'विहादी गाउँपालिका', 524, 'गाउँपालिका'),
(2650, 'बागलुङ नगरपालिका', 525, 'नगरपालिका'),
(2651, 'गल्कोट नगरपालिका', 525, 'नगरपालिका'),
(2652, 'जैमूनी नगरपालिका', 525, 'नगरपालिका'),
(2653, 'ढोरपाटन नगरपालिका', 525, 'नगरपालिका'),
(2654, 'वरेङ गाउँपालिका', 525, 'गाउँपालिका'),
(2655, 'काठेखोला गाउँपालिका', 525, 'गाउँपालिका'),
(2656, 'तमानखोला गाउँपालिका', 525, 'गाउँपालिका'),
(2657, 'ताराखोला गाउँपालिका', 525, 'गाउँपालिका'),
(2658, 'निसीखोला गाउँपालिका', 525, 'गाउँपालिका'),
(2659, 'वडिगाड गाउँपालिका', 525, 'गाउँपालिका'),
(2660, 'कावासोती नगरपालिका', 526, 'नगरपालिका'),
(2661, 'गैडाकोट नगरपालिका', 526, 'नगरपालिका'),
(2662, 'देवचुली नगरपालिका', 526, 'नगरपालिका'),
(2663, 'मध्यविन्दु नगरपालिका', 526, 'नगरपालिका'),
(2664, 'बुङ्दीकाली गाउँपालिका', 526, 'गाउँपालिका'),
(2665, 'बुलिङटार गाउँपालिका', 526, 'गाउँपालिका'),
(2666, 'विनयी त्रिवेणी गाउँपालिका', 526, 'गाउँपालिका'),
(2667, 'हुप्सेकोट गाउँपालिका', 526, 'गाउँपालिका'),
(2668, 'मुसिकोट नगरपालिका', 527, 'नगरपालिका'),
(2669, 'रेसुङ्गा नगरपालिका', 527, 'नगरपालिका'),
(2670, 'ईस्मा गाउँपालिका', 527, 'गाउँपालिका'),
(2671, 'कालीगण्डकी गाउँपालिका', 527, 'गाउँपालिका'),
(2672, 'गुल्मी दरबार गाउँपालिका', 527, 'गाउँपालिका'),
(2673, 'सत्यवती गाउँपालिका', 527, 'गाउँपालिका'),
(2674, 'चन्द्रकोट गाउँपालिका', 527, 'गाउँपालिका'),
(2675, 'रुरु गाउँपालिका', 527, 'गाउँपालिका'),
(2676, 'छत्रकोट गाउँपालिका', 527, 'गाउँपालिका'),
(2677, 'धुर्कोट गाउँपालिका', 527, 'गाउँपालिका'),
(2678, 'मदाने गाउँपालिका', 527, 'गाउँपालिका'),
(2679, 'मालिका गाउँपालिका', 527, 'गाउँपालिका'),
(2680, 'रामपुर नगरपालिका', 528, 'नगरपालिका'),
(2681, 'तानसेन नगरपालिका', 528, 'नगरपालिका'),
(2682, 'निस्दी गाउँपालिका', 528, 'गाउँपालिका'),
(2683, 'पूर्वखोला गाउँपालिका', 528, 'गाउँपालिका'),
(2684, 'रम्भा गाउँपालिका', 528, 'गाउँपालिका'),
(2685, 'माथागढी गाउँपालिका', 528, 'गाउँपालिका'),
(2686, 'तिनाउ गाउँपालिका', 528, 'गाउँपालिका'),
(2687, 'बगनासकाली गाउँपालिका', 528, 'गाउँपालिका'),
(2688, 'रिब्दिकोट गाउँपालिका', 528, 'गाउँपालिका'),
(2689, 'रैनादेवी छहरा गाउँपालिका', 528, 'गाउँपालिका'),
(2690, 'बुटवल उपमहानगरपालिका', 529, 'उपमहानगरपालिका'),
(2691, 'देवदह नगरपालिका', 529, 'नगरपालिका'),
(2692, 'लुम्बिनी सांस्कृतिक नगरपालिका', 529, 'नगरपालिका'),
(2693, 'सैनामैना नगरपालिका', 529, 'नगरपालिका'),
(2694, 'सिद्धार्थनगर नगरपालिका', 529, 'नगरपालिका'),
(2695, 'तिलोत्तमा नगरपालिका', 529, 'नगरपालिका'),
(2696, 'गैडहवा गाउँपालिका', 529, 'गाउँपालिका'),
(2697, 'कन्चन गाउँपालिका', 529, 'गाउँपालिका'),
(2698, 'कोटहीमाई गाउँपालिका', 529, 'गाउँपालिका'),
(2699, 'मर्चवारी गाउँपालिका', 529, 'गाउँपालिका'),
(2700, 'मायादेवी गाउँपालिका', 529, 'गाउँपालिका'),
(2701, 'ओमसतिया गाउँपालिका', 529, 'गाउँपालिका'),
(2702, 'रोहिणी गाउँपालिका', 529, 'गाउँपालिका'),
(2703, 'सम्मरीमाई गाउँपालिका', 529, 'गाउँपालिका'),
(2704, 'सियारी गाउँपालिका', 529, 'गाउँपालिका'),
(2705, 'शुद्धोधन गाउँपालिका', 529, 'गाउँपालिका'),
(2706, 'कपिलवस्तु नगरपालिका', 530, 'नगरपालिका'),
(2707, 'बुद्धभूमी नगरपालिका', 530, 'नगरपालिका'),
(2708, 'शिवराज नगरपालिका', 530, 'नगरपालिका'),
(2709, 'महाराजगंज नगरपालिका', 530, 'नगरपालिका'),
(2710, 'कृष्णनगर नगरपालिका', 530, 'नगरपालिका'),
(2711, 'बाणगंगा नगरपालिका', 530, 'नगरपालिका'),
(2712, 'मायादेवी गाउँपालिका', 530, 'गाउँपालिका'),
(2713, 'यसोधरा गाउँपालिका', 530, 'गाउँपालिका'),
(2714, 'सुद्धोधन गाउँपालिका', 530, 'गाउँपालिका'),
(2715, 'विजयनगर गाउँपालिका', 530, 'गाउँपालिका'),
(2716, 'सन्धिखर्क नगरपालिका', 531, 'नगरपालिका'),
(2717, 'शितगंगा नगरपालिका', 531, 'नगरपालिका'),
(2718, 'भूमिकास्थान नगरपालिका', 531, 'नगरपालिका'),
(2719, 'छत्रदेव गाउँपालिका', 531, 'गाउँपालिका'),
(2720, 'पाणिनी गाउँपालिका', 531, 'गाउँपालिका'),
(2721, 'मालारानी गाउँपालिका', 531, 'गाउँपालिका'),
(2722, 'प्यूठान नगरपालिका', 532, 'नगरपालिका'),
(2723, 'स्वर्गद्वारी नगरपालिका', 532, 'नगरपालिका'),
(2724, 'गौमुखी गाउँपालिका', 532, 'गाउँपालिका'),
(2725, 'माण्डवी गाउँपालिका', 532, 'गाउँपालिका'),
(2726, 'सरुमारानी गाउँपालिका', 532, 'गाउँपालिका'),
(2727, 'मल्लरानी गाउँपालिका', 532, 'गाउँपालिका'),
(2728, 'नौवहिनी गाउँपालिका', 532, 'गाउँपालिका'),
(2729, 'झिमरुक गाउँपालिका', 532, 'गाउँपालिका'),
(2730, 'ऐरावती गाउँपालिका', 532, 'गाउँपालिका'),
(2731, 'रोल्पा नगरपालिका', 533, 'नगरपालिका'),
(2732, 'त्रिवेणी गाउँपालिका', 533, 'गाउँपालिका'),
(2733, 'दुईखोली गाउँपालिका', 533, 'गाउँपालिका'),
(2734, 'माडी गाउँपालिका', 533, 'गाउँपालिका'),
(2735, 'रुन्टीगढी गाउँपालिका', 533, 'गाउँपालिका'),
(2736, 'लुङग्री गाउँपालिका', 533, 'गाउँपालिका'),
(2737, 'सुकिदह गाउँपालिका', 533, 'गाउँपालिका'),
(2738, 'सुनछहरी गाउँपालिका', 533, 'गाउँपालिका'),
(2739, 'सुवर्णावती गाउँपालिका', 533, 'गाउँपालिका'),
(2740, 'थवाङ गाउँपालिका', 533, 'गाउँपालिका'),
(2741, 'पुथा उत्तरगंगा गाउँपालिका', 534, 'गाउँपालिका'),
(2742, 'भूमे गाउँपालिका', 534, 'गाउँपालिका'),
(2743, 'सिस्ने गाउँपालिका', 534, 'गाउँपालिका'),
(2744, 'तुल्सीपुर उपमहानगरपालिका', 535, 'उपमहानगरपालिका'),
(2745, 'घोराही उपमहानगरपालिका', 535, 'उपमहानगरपालिका'),
(2746, 'लमही नगरपालिका', 535, 'नगरपालिका'),
(2747, 'बंगलाचुली गाउँपालिका', 535, 'गाउँपालिका'),
(2748, 'दंगीशरण गाउँपालिका', 535, 'गाउँपालिका'),
(2749, 'गढवा गाउँपालिका', 535, 'गाउँपालिका'),
(2750, 'राजपुर गाउँपालिका', 535, 'गाउँपालिका'),
(2751, 'राप्ती गाउँपालिका', 535, 'गाउँपालिका'),
(2752, 'शान्तिनगर गाउँपालिका', 535, 'गाउँपालिका'),
(2753, 'बबई गाउँपालिका', 535, 'गाउँपालिका'),
(2754, 'नेपालगंज उपमहानगरपालिका', 536, 'उपमहानगरपालिका'),
(2755, 'कोहलपुर नगरपालिका', 536, 'नगरपालिका'),
(2756, 'नरैनापुर गाउँपालिका', 536, 'गाउँपालिका'),
(2757, 'राप्तीसोनारी गाउँपालिका', 536, 'गाउँपालिका'),
(2758, 'बैजनाथ गाउँपालिका', 536, 'गाउँपालिका'),
(2759, 'खजुरा गाउँपालिका', 536, 'गाउँपालिका'),
(2760, 'डुडुवा गाउँपालिका', 536, 'गाउँपालिका'),
(2761, 'जानकी गाउँपालिका', 536, 'गाउँपालिका'),
(2762, 'गुलरिया नगरपालिका', 537, 'नगरपालिका'),
(2763, 'मधुवन नगरपालिका', 537, 'नगरपालिका'),
(2764, 'राजापुर नगरपालिका', 537, 'नगरपालिका'),
(2765, 'ठाकुरबाबा नगरपालिका', 537, 'नगरपालिका'),
(2766, 'बाँसगढी नगरपालिका', 537, 'नगरपालिका'),
(2767, 'बारबर्दिया नगरपालिका', 537, 'नगरपालिका'),
(2768, 'बढैयाताल गाउँपालिका', 537, 'गाउँपालिका'),
(2769, 'गेरुवा गाउँपालिका', 537, 'गाउँपालिका'),
(2770, 'बर्दघाट नगरपालिका', 538, 'नगरपालिका'),
(2771, 'रामग्राम नगरपालिका', 538, 'नगरपालिका'),
(2772, 'सुनवल नगरपालिका', 538, 'नगरपालिका'),
(2773, 'सुस्ता गाउँपालिका', 538, 'गाउँपालिका'),
(2774, 'पाल्हीनन्दन गाउँपालिका', 538, 'गाउँपालिका'),
(2775, 'प्रतापपुर गाउँपालिका', 538, 'गाउँपालिका'),
(2776, 'सरावल गाउँपालिका', 538, 'गाउँपालिका'),
(2777, 'मुसिकोट नगरपालिका', 539, 'नगरपालिका'),
(2778, 'चौरजहारी नगरपालिका', 539, 'नगरपालिका'),
(2779, 'आठबिसकोट नगरपालिका', 539, 'नगरपालिका'),
(2780, 'बाँफिकोट गाउँपालिका', 539, 'गाउँपालिका'),
(2781, 'त्रिवेणी गाउँपालिका', 539, 'गाउँपालिका'),
(2782, 'सानी भेरी गाउँपालिका', 539, 'गाउँपालिका'),
(2783, 'शारदा नगरपालिका', 540, 'नगरपालिका'),
(2784, 'बागचौर नगरपालिका', 540, 'नगरपालिका'),
(2785, 'बनगाड कुपिण्डे नगरपालिका', 540, 'नगरपालिका'),
(2786, 'कालिमाटी गाउँपालिका', 540, 'गाउँपालिका'),
(2787, 'त्रिवेणी गाउँपालिका', 540, 'गाउँपालिका'),
(2788, 'कपुरकोट गाउँपालिका', 540, 'गाउँपालिका'),
(2789, 'छत्रेश्वरी गाउँपालिका', 540, 'गाउँपालिका'),
(2790, 'ढोरचौर गाउँपालिका', 540, 'गाउँपालिका'),
(2791, 'कुमाखमालिका गाउँपालिका', 540, 'गाउँपालिका'),
(2792, 'दार्मा गाउँपालिका', 540, 'गाउँपालिका'),
(2793, 'बीरेन्द्रनगर नगरपालिका', 541, 'नगरपालिका'),
(2794, 'भेरीगंगा नगरपालिका', 541, 'नगरपालिका'),
(2795, 'गुर्भाकोट नगरपालिका', 541, 'नगरपालिका'),
(2796, 'पञ्चपुरी नगरपालिका', 541, 'नगरपालिका'),
(2797, 'लेकवेशी नगरपालिका', 541, 'नगरपालिका'),
(2798, 'चौकुने गाउँपालिका', 541, 'गाउँपालिका'),
(2799, 'बराहताल गाउँपालिका', 541, 'गाउँपालिका'),
(2800, 'चिङ्गाड गाउँपालिका', 541, 'गाउँपालिका'),
(2801, 'सिम्ता गाउँपालिका', 541, 'गाउँपालिका'),
(2802, 'नारायण नगरपालिका', 542, 'नगरपालिका'),
(2803, 'दुल्लु नगरपालिका', 542, 'नगरपालिका'),
(2804, 'चामुण्डा विन्द्रासैनी नगरपालिका', 542, 'नगरपालिका'),
(2805, 'आठबीस नगरपालिका', 542, 'नगरपालिका'),
(2806, 'भगवतीमाई गाउँपालिका', 542, 'गाउँपालिका'),
(2807, 'गुराँस गाउँपालिका', 542, 'गाउँपालिका'),
(2808, 'डुंगेश्वर गाउँपालिका', 542, 'गाउँपालिका'),
(2809, 'नौमुले गाउँपालिका', 542, 'गाउँपालिका'),
(2810, 'महावु गाउँपालिका', 542, 'गाउँपालिका'),
(2811, 'भैरवी गाउँपालिका', 542, 'गाउँपालिका'),
(2812, 'ठाँटीकाँध गाउँपालिका', 542, 'गाउँपालिका'),
(2813, 'भेरी नगरपालिका', 543, 'नगरपालिका'),
(2814, 'छेडागाड नगरपालिका', 543, 'नगरपालिका'),
(2815, 'त्रिवेणी नलगाड नगरपालिका', 543, 'नगरपालिका'),
(2816, 'बारेकोट गाउँपालिका', 543, 'गाउँपालिका'),
(2817, 'कुसे गाउँपालिका', 543, 'गाउँपालिका'),
(2818, 'जुनीचाँदे गाउँपालिका', 543, 'गाउँपालिका'),
(2819, 'शिवालय गाउँपालिका', 543, 'गाउँपालिका'),
(2820, 'ठुली भेरी नगरपालिका', 544, 'नगरपालिका'),
(2821, 'त्रिपुरासुन्दरी नगरपालिका', 544, 'नगरपालिका'),
(2822, 'डोल्पो बुद्ध गाउँपालिका', 544, 'गाउँपालिका'),
(2823, 'शे फोक्सुन्डो गाउँपालिका', 544, 'गाउँपालिका'),
(2824, 'जगदुल्ला गाउँपालिका', 544, 'गाउँपालिका'),
(2825, 'मुड्केचुला गाउँपालिका', 544, 'गाउँपालिका'),
(2826, 'काईके गाउँपालिका', 544, 'गाउँपालिका'),
(2827, 'छार्का ताङसोङ गाउँपालिका', 544, 'गाउँपालिका'),
(2828, 'चन्दननाथ नगरपालिका', 545, 'नगरपालिका'),
(2829, 'कनकासुन्दरी गाउँपालिका', 545, 'गाउँपालिका'),
(2830, 'सिंजा गाउँपालिका', 545, 'गाउँपालिका'),
(2831, 'हिमा गाउँपालिका', 545, 'गाउँपालिका'),
(2832, 'तिला गाउँपालिका', 545, 'गाउँपालिका'),
(2833, 'गुठिचौर गाउँपालिका', 545, 'गाउँपालिका'),
(2834, 'तातोपानी गाउँपालिका', 545, 'गाउँपालिका'),
(2835, 'पातारासी गाउँपालिका', 545, 'गाउँपालिका'),
(2836, 'खाँडाचक्र नगरपालिका', 546, 'नगरपालिका'),
(2837, 'रास्कोट नगरपालिका', 546, 'नगरपालिका'),
(2838, 'तिलागुफा नगरपालिका', 546, 'नगरपालिका'),
(2839, 'पचालझरना गाउँपालिका', 546, 'गाउँपालिका'),
(2840, 'सान्नी त्रिवेणी गाउँपालिका', 546, 'गाउँपालिका'),
(2841, 'नरहरिनाथ गाउँपालिका', 546, 'गाउँपालिका'),
(2842, 'कालिका गाउँपालिका', 546, 'गाउँपालिका'),
(2843, 'महावै गाउँपालिका', 546, 'गाउँपालिका'),
(2844, 'पलाता गाउँपालिका', 546, 'गाउँपालिका'),
(2845, 'छायाँनाथ रारा नगरपालिका', 547, 'नगरपालिका'),
(2846, 'मुगुम कार्मारोंग गाउँपालिका', 547, 'गाउँपालिका'),
(2847, 'सोरु गाउँपालिका', 547, 'गाउँपालिका'),
(2848, 'खत्याड गाउँपालिका', 547, 'गाउँपालिका'),
(2849, 'सिमकोट गाउँपालिका', 548, 'गाउँपालिका'),
(2850, 'नाम्खा गाउँपालिका', 548, 'गाउँपालिका'),
(2851, 'खार्पुनाथ गाउँपालिका', 548, 'गाउँपालिका'),
(2852, 'सर्केगाड गाउँपालिका', 548, 'गाउँपालिका'),
(2853, 'चंखेली गाउँपालिका', 548, 'गाउँपालिका'),
(2854, 'अदानचुली गाउँपालिका', 548, 'गाउँपालिका'),
(2855, 'ताँजाकोट गाउँपालिका', 548, 'गाउँपालिका'),
(2856, 'बडीमालिका नगरपालिका', 549, 'नगरपालिका'),
(2857, 'त्रिवेणी नगरपालिका', 549, 'नगरपालिका'),
(2858, 'बुढीगंगा नगरपालिका', 549, 'नगरपालिका'),
(2859, 'बुढीनन्दा नगरपालिका', 549, 'नगरपालिका'),
(2860, 'गौमुल गाउँपालिका', 549, 'गाउँपालिका'),
(2861, 'पाण्डव गुफा गाउँपालिका', 549, 'गाउँपालिका'),
(2862, 'स्वामीकार्तिक गाउँपालिका', 549, 'गाउँपालिका'),
(2863, 'छेडेदह गाउँपालिका', 549, 'गाउँपालिका'),
(2864, 'हिमाली गाउँपालिका', 549, 'गाउँपालिका'),
(2865, 'जयपृथ्वी नगरपालिका', 550, 'नगरपालिका'),
(2866, 'बुंगल नगरपालिका', 550, 'नगरपालिका'),
(2867, 'तलकोट गाउँपालिका', 550, 'गाउँपालिका'),
(2868, 'मष्टा गाउँपालिका', 550, 'गाउँपालिका'),
(2869, 'खप्तडछान्ना गाउँपालिका', 550, 'गाउँपालिका'),
(2870, 'थलारा गाउँपालिका', 550, 'गाउँपालिका'),
(2871, 'वित्थडचिर गाउँपालिका', 550, 'गाउँपालिका'),
(2872, 'सूर्मा गाउँपालिका', 550, 'गाउँपालिका'),
(2873, 'छबिसपाथिभेरा गाउँपालिका', 550, 'गाउँपालिका'),
(2874, 'दुर्गाथली गाउँपालिका', 550, 'गाउँपालिका'),
(2875, 'केदारस्युँ गाउँपालिका', 550, 'गाउँपालिका'),
(2876, 'काँडा गाउँपालिका', 550, 'गाउँपालिका'),
(2877, 'मंगलसेन नगरपालिका', 551, 'नगरपालिका'),
(2878, 'कमलबजार नगरपालिका', 551, 'नगरपालिका'),
(2879, 'साँफेबगर नगरपालिका', 551, 'नगरपालिका'),
(2880, 'पन्चदेवल विनायक नगरपालिका', 551, 'नगरपालिका'),
(2881, 'चौरपाटी गाउँपालिका', 551, 'गाउँपालिका'),
(2882, 'मेल्लेख गाउँपालिका', 551, 'गाउँपालिका'),
(2883, 'बान्निगढी जयगढ गाउँपालिका', 551, 'गाउँपालिका'),
(2884, 'रामारोशन गाउँपालिका', 551, 'गाउँपालिका'),
(2885, 'ढकारी गाउँपालिका', 551, 'गाउँपालिका'),
(2886, 'तुर्माखाँद गाउँपालिका', 551, 'गाउँपालिका'),
(2887, 'दिपायल सिलगढी नगरपालिका', 552, 'नगरपालिका'),
(2888, 'शिखर नगरपालिका', 552, 'नगरपालिका'),
(2889, 'पूर्वीचौकी गाउँपालिका', 552, 'गाउँपालिका'),
(2890, 'बडीकेदार गाउँपालिका', 552, 'गाउँपालिका'),
(2891, 'जोरायल गाउँपालिका', 552, 'गाउँपालिका'),
(2892, 'सायल गाउँपालिका', 552, 'गाउँपालिका'),
(2893, 'आदर्श गाउँपालिका', 552, 'गाउँपालिका'),
(2894, 'के.आई.सिं. गाउँपालिका', 552, 'गाउँपालिका'),
(2895, 'बोगटान गाउँपालिका', 552, 'गाउँपालिका'),
(2896, 'धनगढी उपमहानगरपालिका', 553, 'उपमहानगरपालिका'),
(2897, 'टिकापुर नगरपालिका', 553, 'नगरपालिका'),
(2898, 'घोडाघोडी नगरपालिका', 553, 'नगरपालिका'),
(2899, 'लम्कीचुहा नगरपालिका', 553, 'नगरपालिका'),
(2900, 'भजनी नगरपालिका', 553, 'नगरपालिका'),
(2901, 'गोदावरी नगरपालिका', 553, 'नगरपालिका'),
(2902, 'गौरीगंगा नगरपालिका', 553, 'नगरपालिका'),
(2903, 'जानकी गाउँपालिका', 553, 'गाउँपालिका'),
(2904, 'बर्दगोरिया गाउँपालिका', 553, 'गाउँपालिका'),
(2905, 'मोहन्याल गाउँपालिका', 553, 'गाउँपालिका'),
(2906, 'कैलारी गाउँपालिका', 553, 'गाउँपालिका'),
(2907, 'जोशीपुर गाउँपालिका', 553, 'गाउँपालिका'),
(2908, 'चुरे गाउँपालिका', 553, 'गाउँपालिका'),
(2909, 'भीमदत्त नगरपालिका', 554, 'नगरपालिका'),
(2910, 'पुर्नवास नगरपालिका', 554, 'नगरपालिका'),
(2911, 'वेदकोट नगरपालिका', 554, 'नगरपालिका'),
(2912, 'महाकाली नगरपालिका', 554, 'नगरपालिका'),
(2913, 'शुक्लाफाँटा नगरपालिका', 554, 'नगरपालिका'),
(2914, 'बेलौरी नगरपालिका', 554, 'नगरपालिका'),
(2915, 'कृष्णपुर नगरपालिका', 554, 'नगरपालिका'),
(2916, 'बेलडाडी गाउँपालिका', 554, 'गाउँपालिका'),
(2917, 'लालझाडी गाउँपालिका', 554, 'गाउँपालिका'),
(2918, 'अमरगढी नगरपालिका', 555, 'नगरपालिका'),
(2919, 'परशुराम नगरपालिका', 555, 'नगरपालिका'),
(2920, 'आलिताल गाउँपालिका', 555, 'गाउँपालिका'),
(2921, 'भागेश्वर गाउँपालिका', 555, 'गाउँपालिका'),
(2922, 'नवदुर्गा गाउँपालिका', 555, 'गाउँपालिका'),
(2923, 'अजयमेरु गाउँपालिका', 555, 'गाउँपालिका'),
(2924, 'गन्यापधुरा गाउँपालिका', 555, 'गाउँपालिका'),
(2925, 'दशरथचन्द नगरपालिका', 556, 'नगरपालिका'),
(2926, 'पाटन नगरपालिका', 556, 'नगरपालिका'),
(2927, 'मेलौली नगरपालिका', 556, 'नगरपालिका'),
(2928, 'पुर्चौडी नगरपालिका', 556, 'नगरपालिका'),
(2929, 'सुर्नया गाउँपालिका', 556, 'गाउँपालिका'),
(2930, 'सिगास गाउँपालिका', 556, 'गाउँपालिका'),
(2931, 'शिवनाथ गाउँपालिका', 556, 'गाउँपालिका'),
(2932, 'पञ्चेश्वर गाउँपालिका', 556, 'गाउँपालिका'),
(2933, 'दोगडाकेदार गाउँपालिका', 556, 'गाउँपालिका'),
(2934, 'डीलासैनी गाउँपालिका', 556, 'गाउँपालिका'),
(2935, 'महाकाली नगरपालिका', 557, 'नगरपालिका'),
(2936, 'शैल्यशिखर नगरपालिका', 557, 'नगरपालिका'),
(2937, 'मालिकार्जुन गाउँपालिका', 557, 'गाउँपालिका'),
(2938, 'अपिहिमाल गाउँपालिका', 557, 'गाउँपालिका'),
(2939, 'दुहुँ गाउँपालिका', 557, 'गाउँपालिका'),
(2940, 'नौगाड गाउँपालिका', 557, 'गाउँपालिका'),
(2941, 'मार्मा गाउँपालिका', 557, 'गाउँपालिका'),
(2942, 'लेकम गाउँपालिका', 557, 'गाउँपालिका'),
(2943, 'ब्याँस गाउँपालिका', 557, 'गाउँपालिका');

-- --------------------------------------------------------

--
-- Table structure for table `settings_marriage_types`
--

CREATE TABLE `settings_marriage_types` (
  `id` int(11) NOT NULL,
  `name` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings_marriage_types`
--

INSERT INTO `settings_marriage_types` (`id`, `name`) VALUES
(1, 'मागी');

-- --------------------------------------------------------

--
-- Table structure for table `settings_office`
--

CREATE TABLE `settings_office` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `address` text NOT NULL,
  `sambodhan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings_office`
--

INSERT INTO `settings_office` (`id`, `name`, `address`, `sambodhan`) VALUES
(1, 'वडा कार्यालय', 'गजुरी, धादिङ्ग, प्रदेश नं. ३, नेपाल', 'श्री प्रमुख प्रशासकीय अधिकृत ज्यु'),
(2, 'मालपोत कार्यालय ', 'गजुरी, धादिङ्ग, प्रदेश नं. ३, नेपाल', 'श्री प्रमुख प्रशासकीय अधिकृत ज्यु'),
(3, 'जिल्ला प्रशासन कार्यालय', 'गजुरी, धादिङ्ग, प्रदेश नं. ३, नेपाल', 'श्री प्रमुख प्रशासकीय अधिकृत ज्यु'),
(4, 'जो जस संग सम्बन्ध छ', '', ''),
(5, 'जल्ला प्रसाशन कार्यालय', 'गजुरी, धादिङ्ग, प्रदेश नं. ३, नेपाल', 'श्री प्रमुख प्रशासकीय अधिकृत ज्यु'),
(6, 'यातायात कार्यालय', 'गजुरी, धादिङ्ग, प्रदेश नं. ३, नेपाल', 'श्री प्रमुख प्रशासकीय अधिकृत ज्यु'),
(7, 'खानेपानी कार्यालय', 'गजुरी, धादिङ्ग, प्रदेश नं. ३, नेपाल', 'श्री प्रमुख प्रशासकीय अधिकृत ज्यु'),
(15, 'test', 'Biratnagar-03', 'test'),
(16, 'testtasdas', 'jafjsdsa', 'test'),
(17, 'Test1', 'Test2', 'Test'),
(18, 'अन्तरिक राजस्व कार्यालय', 'धनगडी, कैलाली', ''),
(19, 'test', 'test', 'test'),
(20, 'dhiraj', 'dhiraj', 'dhiraj'),
(21, 'asdasdasd', 'sadh;fdf;eqofg', 'asda'),
(22, 'go ', 'go', 'lether '),
(23, 'gogo', 'gogogogog', 'go'),
(24, 'asdsd', 'asd', 'asdasd'),
(25, 'asdsadsa', 'asdsads', 'sdasdasd');

-- --------------------------------------------------------

--
-- Table structure for table `settings_oldnew_address`
--

CREATE TABLE `settings_oldnew_address` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `new_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings_oldnew_address`
--

INSERT INTO `settings_oldnew_address` (`id`, `name`, `new_name`) VALUES
(1, 'गजुरी गा.वि.स. - १', 'गजुरी गाउँपालिका १'),
(2, 'गजुरी गा.वि.स. - ३', 'गजुरी गाउँपालिका १'),
(3, 'गजुरी गा.वि.स. - २', 'गजुरी गाउँपालिका २');

-- --------------------------------------------------------

--
-- Table structure for table `settings_patra_category`
--

CREATE TABLE `settings_patra_category` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings_patra_category`
--

INSERT INTO `settings_patra_category` (`id`, `name`) VALUES
(1, 'घर सम्बन्धित'),
(2, 'संस्था/व्यवसाय सम्बन्धित'),
(3, 'सम्पत्ति सम्बन्धित'),
(4, 'जग्गा सम्बन्धित'),
(5, 'बसोबास सम्बन्धित'),
(6, 'नागरिकता सम्बन्धित'),
(7, 'अन्य');

-- --------------------------------------------------------

--
-- Table structure for table `settings_patra_item`
--

CREATE TABLE `settings_patra_item` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `uri` varchar(100) NOT NULL,
  `model` varchar(125) NOT NULL,
  `image_link` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings_patra_item`
--

INSERT INTO `settings_patra_item` (`id`, `category_id`, `name`, `uri`, `model`, `image_link`) VALUES
(1, 1, 'घर कायमको सिफारिस', 'home-recommend', 'Mdl_home_recommend', 'home/home_recommend/'),
(2, 1, 'घर बाटो प्रमाणित', 'home-road-certify', 'Mdl_home_road_certify', 'home/road/'),
(3, 1, 'घर जग्गा नामसारी', 'ghar-jagga-namsari', 'Mdl_ghar_jagga_namsari', 'home/ghar_jagga_namsari/'),
(4, 1, 'कित्ताकाट सिफारिस', 'kitta-kat-sifaris', 'Mdl_kitta_kat_sifaris', 'home/kitta_kat_sifaris/'),
(5, 2, 'गैर नाफामुलक संस्था दर्ता प्रमाणपत्र', 'sanstha-darta-pramanpatra', 'Mdl_sanstha_darta_pramanpatra', 'business/sanstha_darta_pramanpatra/'),
(6, 2, 'व्यवसाय दर्ता प्रमाणपत्र', 'bebasaya-darta', 'Mdl_bebasaya_darta', 'business/bebasaya_darta/'),
(7, 2, 'व्यवसाय बन्द बारे', 'bebasaya-banda', 'Mdl_bebasaya_banda', 'business/bebasaya_banda/'),
(8, 2, 'संस्था दर्ता सिफारिस', 'sanstha-darta', 'Mdl_sanstha_darta', 'business/sanstha_darta/'),
(9, 2, 'संस्था नविकरण सिफारिस', 'sanstha-nabikaran', 'Mdl_sanstha_nabikaran', 'business/sanstha_nabikaran/'),
(10, 3, 'वार्षिक आय प्रमाणीकरण', 'income-verification', 'Mdl_income_verification', 'property/income_verification/'),
(11, 3, 'सम्पत्ति मूल्यांकन', 'property-valuation', 'Mdl_property_valuation', 'property/property_valuation/'),
(12, 3, 'कर सावधानी प्रमाणपत्र', 'tax-clearance', 'Mdl_tax_clearance', 'property/tax_clearance/'),
(13, 4, 'जग्गाधनी लाल पुर्जा प्रतिलिपि', 'lalpurja-pratilipi', 'Mdl_lalpurja_pratilipi', 'land/lalpurja/'),
(14, 4, 'बाटो कायम', 'bato-kayam', 'Mdl_batokayam', 'land/bato/'),
(15, 4, 'जग्गाधनी पुर्जामा घर कायम', 'purjama-ghar-kayam', 'Mdl_purjamagharkayam', 'land/ghar/'),
(16, 4, 'चार किल्ला सम्बन्धमा', 'char-killa', 'Mdl_charkilla', 'land/char_killa/'),
(17, 4, 'मोही लागत कट्टा', 'mohi-lagat-katta', 'Mdl_mohi_lagat_katta', 'land/mohi/'),
(18, 5, 'स्थायी बसोबास', 'sthai-basobas', 'Mdl_sthai_basobas', 'settlement/sthai_basobas/'),
(19, 5, 'अस्थायी बसोबास', 'asthai-basobas', 'Mdl_asthai_basobas', 'settlement/asthai_basobas/'),
(20, 5, 'अन्तरिक बसाई सराई', 'antarik-basai-sarai', 'Mdl_antarik_basai_sarai', 'settlement/antarik_basaisarai/'),
(21, 6, 'नागरिकता प्रमाणपत्र', 'citizenship-certificate', 'Mdl_certificate', 'land/citcertificate/'),
(22, 6, 'नागरिकता प्रमंपत्रको प्रतिलिपि', 'citizenship-certificate-pratilipi', 'Mdl_certificate_pratilipi', 'certificate/citcertificate_pratilipi/'),
(23, 7, ' विवाह प्रमाणित', 'bibaha-pramanit', 'Mdl_bibaha_pramanit', 'others/bibaha_pramanit/'),
(24, 7, 'खानेपानी जडान', 'khanepani-jadan', 'Mdl_khanepani_jadan', 'others/khanepani_jadan/'),
(25, 7, 'बिद्युत जडान', 'biduth-jadan', 'Mdl_biduth_jadan', 'others/biduth_jadan/'),
(26, 7, 'अविवाहित प्रमाणपत्र', 'abibhahit-pramanpatra', 'Mdl_abibhahit_pramanpatra', 'others/abibhahit_pramanpatra/'),
(27, 7, 'जन्म मिति प्रमाणित', 'janma-miti-pramanit', 'Mdl_janma_miti_pramanit', 'others/janma_miti_pramanit/'),
(28, 7, 'जेट मेशिन', 'jet-machine', 'Mdl_jet_machine', 'others/jet_machine/'),
(29, 7, 'फरक नाम थर सिफारिस', 'farak-nam-thar', 'Mdl_farak_nam_thar', 'others/farak_nam_thar/'),
(30, 7, 'सडक खन्ने स्वीकृति', 'sadak-khanne-swikriti', 'Mdl_sadak_khanne_swikriti', 'others/sadak_khanne_swikriti/'),
(31, 7, 'हकदार प्रमाणित', 'hakdar-pramanit', 'Mdl_hakdar_pramanit', 'others/hakdar_pramanit/'),
(32, 7, 'नाबालक परिचयपत्र', 'nabalak-pramanit', 'Mdl_nabalak_pramanit', 'others/nabalak_pramanit/'),
(33, 7, 'अदालत शुल्क मिनाह', 'court-fee', 'Mdl_court_fee', 'others/court_fee/'),
(34, 7, 'कोठा खाली सूचना', 'kotha-khali-suchana', 'Mdl_kotha_khali_suchana', 'others/kotha_khali_suchana/'),
(35, 7, 'नाता प्रमाणित', 'nata-pramanit', 'Mdl_nata_pramanit', 'others/nata_pramanit/'),
(36, 7, 'छात्रवृति मुल्यांकन', 'scholarship', 'Mdl_scholarship', 'others/scholarship/'),
(37, 7, ' प्राविधिक मुल्यांकन', 'prabhidik-mulyankan', 'Mdl_prabhidik_mulyankan', 'others/prabhidik_mulyankan/'),
(38, 7, 'आर्थिक सहायता', 'arthik-saheta', 'Mdl_arthik_saheta', 'others/arthik_saheta/'),
(39, 7, 'घर पाताल भएको', 'ghar-patala', 'Mdl_ghar_patala', 'others/ghar_patala/'),
(40, 7, 'कक्षा कोठा थप', 'add-classroom', 'Mdl_add_classroom', 'others/add_classroom/'),
(41, 7, 'अपाङ्ग प्रमाणपत्र', 'apanga-pramanpatra', 'Mdl_apanga_pramanpatra', 'others/apanga_pramanpatra/'),
(42, 7, 'मृत्यु दर्ता', 'mirtyu-darta', 'Mdl_mirtyu_darta', 'others/mirtyu_darta/'),
(43, 2, 'व्यवसाय दर्ता सिफारिस', 'bebasaya-sifaris', 'Mdl_bebasaya_sifaris', 'business/bebasaya_sifaris/');

-- --------------------------------------------------------

--
-- Table structure for table `settings_post`
--

CREATE TABLE `settings_post` (
  `id` int(11) NOT NULL,
  `name` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings_post`
--

INSERT INTO `settings_post` (`id`, `name`) VALUES
(1, 'अध्यक्ष्य'),
(2, 'उप-अध्यक्ष्य'),
(3, 'कोसाध्यक्ष्य	'),
(4, 'सचिव'),
(5, 'उप-सचिव'),
(6, 'संयोजक'),
(7, 'सदस्य');

-- --------------------------------------------------------

--
-- Table structure for table `settings_relation`
--

CREATE TABLE `settings_relation` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings_relation`
--

INSERT INTO `settings_relation` (`id`, `name`) VALUES
(1, 'छोरा'),
(2, 'छोरी'),
(3, 'श्रीमती'),
(4, 'बुवा'),
(5, 'दाजु'),
(6, 'आमा'),
(7, 'भिनाजु ');

-- --------------------------------------------------------

--
-- Table structure for table `settings_road_type`
--

CREATE TABLE `settings_road_type` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings_road_type`
--

INSERT INTO `settings_road_type` (`id`, `name`) VALUES
(1, 'कालो पत्रे सडक'),
(2, 'कच्ची सडक'),
(3, 'ग्राभेल सडक'),
(4, 'कच्ची तथा ग्राभेल सडक');

-- --------------------------------------------------------

--
-- Table structure for table `settings_service`
--

CREATE TABLE `settings_service` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings_service`
--

INSERT INTO `settings_service` (`id`, `name`) VALUES
(1, 'निर्माण सम्बन्धि'),
(2, 'कम्पुटर सफ्टवेयर');

-- --------------------------------------------------------

--
-- Table structure for table `settings_session`
--

CREATE TABLE `settings_session` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `is_current` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings_session`
--

INSERT INTO `settings_session` (`id`, `name`, `is_current`) VALUES
(1, '2075/76', 0),
(2, '2076/77', 1);

-- --------------------------------------------------------

--
-- Table structure for table `settings_state`
--

CREATE TABLE `settings_state` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings_state`
--

INSERT INTO `settings_state` (`id`, `name`) VALUES
(1, 'प्रदेश १'),
(2, 'प्रदेश २'),
(3, 'प्रदेश ३'),
(4, 'गण्डकी प्रदेश'),
(6, 'प्रदेश ६'),
(7, 'प्रदेश ७');

-- --------------------------------------------------------

--
-- Table structure for table `settings_vdc_municipality`
--

CREATE TABLE `settings_vdc_municipality` (
  `id` int(11) NOT NULL,
  `name` text CHARACTER SET utf8 NOT NULL,
  `district_id` int(11) NOT NULL,
  `type` text CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings_vdc_municipality`
--

INSERT INTO `settings_vdc_municipality` (`id`, `name`, `district_id`, `type`) VALUES
(2191, 'फुङलिङ नगरपालिका', 481, 'नगरपालिका'),
(2192, 'आठराई त्रिवेणी गाउँपालिका', 481, 'गाउँपालिका'),
(2193, 'सिदिङ्वा गाउँपालिका', 481, 'गाउँपालिका'),
(2194, 'फक्ताङलुङ गाउँपालिका', 481, 'गाउँपालिका'),
(2195, 'मिक्वाखोला गाउँपालिका', 481, 'गाउँपालिका'),
(2196, 'मेरिङदेन गाउँपालिका', 481, 'गाउँपालिका'),
(2197, 'मैवाखोला गाउँपालिका', 481, 'गाउँपालिका'),
(2198, 'याङवरक गाउँपालिका', 481, 'गाउँपालिका'),
(2199, 'सिरीजङ्घा गाउँपालिका', 481, 'गाउँपालिका'),
(2200, 'फिदिम नगरपालिका', 482, 'नगरपालिका'),
(2201, 'फालेलुंग गाउँपालिका', 482, 'गाउँपालिका'),
(2202, 'फाल्गुनन्द गाउँपालिका', 482, 'गाउँपालिका'),
(2203, 'हिलिहाङ गाउँपालिका', 482, 'गाउँपालिका'),
(2204, 'कुम्मायक गाउँपालिका', 482, 'गाउँपालिका'),
(2205, 'मिक्लाजुङ गाउँपालिका', 482, 'गाउँपालिका'),
(2206, 'तुम्बेवा गाउँपालिका', 482, 'गाउँपालिका'),
(2207, 'याङवरक गाउँपालिका', 482, 'गाउँपालिका'),
(2208, 'ईलाम नगरपालिका', 483, 'नगरपालिका'),
(2209, 'देउमाई नगरपालिका', 483, 'नगरपालिका'),
(2210, 'माई नगरपालिका', 483, 'नगरपालिका'),
(2211, 'सूर्योदय नगरपालिका', 483, 'नगरपालिका'),
(2212, 'फाकफोकथुम गाउँपालिका', 483, 'गाउँपालिका'),
(2213, 'चुलाचुली गाउँपालिका', 483, 'गाउँपालिका'),
(2214, 'माईजोगमाई गाउँपालिका', 483, 'गाउँपालिका'),
(2215, 'माङसेबुङ गाउँपालिका', 483, 'गाउँपालिका'),
(2216, 'रोङ गाउँपालिका', 483, 'गाउँपालिका'),
(2217, 'सन्दकपुर गाउँपालिका', 483, 'गाउँपालिका'),
(2218, 'मेचीनगर नगरपालिका', 484, 'नगरपालिका'),
(2219, 'दमक नगरपालिका', 484, 'नगरपालिका'),
(2220, 'कन्काई नगरपालिका', 484, 'नगरपालिका'),
(2221, 'भद्रपुर नगरपालिका', 484, 'नगरपालिका'),
(2222, 'अर्जुनधारा नगरपालिका', 484, 'नगरपालिका'),
(2223, 'शिवशताक्षी नगरपालिका', 484, 'नगरपालिका'),
(2224, 'गौरादह नगरपालिका', 484, 'नगरपालिका'),
(2225, 'विर्तामोड नगरपालिका', 484, 'नगरपालिका'),
(2226, 'कमल गाउँपालिका', 484, 'गाउँपालिका'),
(2227, 'गौरीगंज गाउँपालिका', 484, 'गाउँपालिका'),
(2228, 'बाह्रदशी गाउँपालिका', 484, 'गाउँपालिका'),
(2229, 'झापा गाउँपालिका', 484, 'गाउँपालिका'),
(2230, 'बुद्धशान्ति गाउँपालिका', 484, 'गाउँपालिका'),
(2231, 'हल्दिवारी गाउँपालिका', 484, 'गाउँपालिका'),
(2232, 'कचनकवल गाउँपालिका', 484, 'गाउँपालिका'),
(2233, 'विराटनगर महानगरपालिका', 485, 'महानगरपालिका'),
(2234, 'बेलवारी नगरपालिका', 485, 'नगरपालिका'),
(2235, 'लेटाङ नगरपालिका', 485, 'नगरपालिका'),
(2236, 'पथरी शनिश्चरे नगरपालिका', 485, 'नगरपालिका'),
(2237, 'रंगेली नगरपालिका', 485, 'नगरपालिका'),
(2238, 'रतुवामाई नगरपालिका', 485, 'नगरपालिका'),
(2239, 'सुनवर्षि नगरपालिका', 485, 'नगरपालिका'),
(2240, 'उर्लावारी नगरपालिका', 485, 'नगरपालिका'),
(2241, 'सुन्दरहरैचा नगरपालिका', 485, 'नगरपालिका'),
(2242, 'बुढीगंगा गाउँपालिका', 485, 'गाउँपालिका'),
(2243, 'धनपालथान गाउँपालिका', 485, 'गाउँपालिका'),
(2244, 'ग्रामथान गाउँपालिका', 485, 'गाउँपालिका'),
(2245, 'जहदा गाउँपालिका', 485, 'गाउँपालिका'),
(2246, 'कानेपोखरी गाउँपालिका', 485, 'गाउँपालिका'),
(2247, 'कटहरी गाउँपालिका', 485, 'गाउँपालिका'),
(2248, 'केरावारी गाउँपालिका', 485, 'गाउँपालिका'),
(2249, 'मिक्लाजुङ गाउँपालिका', 485, 'गाउँपालिका'),
(2250, 'ईटहरी उपमहानगरपालिका', 486, 'उपमहानगरपालिका'),
(2251, 'धरान उपमहानगरपालिका', 486, 'उपमहानगरपालिका'),
(2252, 'ईनरुवा नगरपालिका', 486, 'नगरपालिका'),
(2253, 'दुहवी नगरपालिका', 486, 'नगरपालिका'),
(2254, 'रामधुनी नगरपालिका', 486, 'नगरपालिका'),
(2255, 'बराह नगरपालिका', 486, 'नगरपालिका'),
(2256, 'देवानगञ्ज गाउँपालिका', 486, 'गाउँपालिका'),
(2257, 'कोशी गाउँपालिका', 486, 'गाउँपालिका'),
(2258, 'गढी गाउँपालिका', 486, 'गाउँपालिका'),
(2259, 'बर्जु गाउँपालिका', 486, 'गाउँपालिका'),
(2260, 'भोक्राहा गाउँपालिका', 486, 'गाउँपालिका'),
(2261, 'हरिनगरा गाउँपालिका', 486, 'गाउँपालिका'),
(2262, 'पाख्रिबास नगरपालिका', 487, 'नगरपालिका'),
(2263, 'धनकुटा नगरपालिका', 487, 'नगरपालिका'),
(2264, 'महालक्ष्मी नगरपालिका', 487, 'नगरपालिका'),
(2265, 'साँगुरीगढी गाउँपालिका', 487, 'गाउँपालिका'),
(2266, 'खाल्सा छिन्ताङ सहिदभूमि गाउँपालिका', 487, 'गाउँपालिका'),
(2267, 'छथर जोरपाटी गाउँपालिका', 487, 'गाउँपालिका'),
(2268, 'चौविसे गाउँपालिका', 487, 'गाउँपालिका'),
(2269, 'म्याङलुङ नगरपालिका', 488, 'नगरपालिका'),
(2270, 'लालीगुराँस नगरपालिका', 488, 'नगरपालिका'),
(2271, 'आठराई गाउँपालिका', 488, 'गाउँपालिका'),
(2272, 'छथर गाउँपालिका', 488, 'गाउँपालिका'),
(2273, 'फेदाप गाउँपालिका', 488, 'गाउँपालिका'),
(2274, 'मेन्छयायेम गाउँपालिका', 488, 'गाउँपालिका'),
(2275, 'चैनपुर नगरपालिका', 489, 'नगरपालिका'),
(2276, 'धर्मदेवी नगरपालिका', 489, 'नगरपालिका'),
(2277, 'खाँदवारी नगरपालिका', 489, 'नगरपालिका'),
(2278, 'मादी नगरपालिका', 489, 'नगरपालिका'),
(2279, 'पाँचखपन नगरपालिका', 489, 'नगरपालिका'),
(2280, 'भोटखोला गाउँपालिका', 489, 'गाउँपालिका'),
(2281, 'चिचिला गाउँपालिका', 489, 'गाउँपालिका'),
(2282, 'मकालु गाउँपालिका', 489, 'गाउँपालिका'),
(2283, 'सभापोखरी गाउँपालिका', 489, 'गाउँपालिका'),
(2284, 'सिलीचोङ गाउँपालिका', 489, 'गाउँपालिका'),
(2285, 'भोजपुर नगरपालिका', 490, 'नगरपालिका'),
(2286, 'षडानन्द नगरपालिका', 490, 'नगरपालिका'),
(2287, 'ट्याम्केमैयुम गाउँपालिका', 490, 'गाउँपालिका'),
(2288, 'रामप्रसाद राई गाउँपालिका', 490, 'गाउँपालिका'),
(2289, 'अरुण गाउँपालिका', 490, 'गाउँपालिका'),
(2290, 'पौवादुङमा गाउँपालिका', 490, 'गाउँपालिका'),
(2291, 'साल्पासिलिछो गाउँपालिका', 490, 'गाउँपालिका'),
(2292, 'आमचोक गाउँपालिका', 490, 'गाउँपालिका'),
(2293, 'हतुवागढी गाउँपालिका', 490, 'गाउँपालिका'),
(2294, 'सोलुदुधकुण्ड नगरपालिका', 491, 'नगरपालिका'),
(2295, 'दुधकोसी गाउँपालिका', 491, 'गाउँपालिका'),
(2296, 'खुम्वु पासाङल्हमु गाउँपालिका', 491, 'गाउँपालिका'),
(2297, 'दुधकौशिका गाउँपालिका', 491, 'गाउँपालिका'),
(2298, 'नेचासल्यान गाउँपालिका', 491, 'गाउँपालिका'),
(2299, 'माहाकुलुङ गाउँपालिका', 491, 'गाउँपालिका'),
(2300, 'लिखु पिके गाउँपालिका', 491, 'गाउँपालिका'),
(2301, 'सोताङ गाउँपालिका', 491, 'गाउँपालिका'),
(2302, 'सिद्दिचरण नगरपालिका', 492, 'नगरपालिका'),
(2303, 'खिजिदेम्बा गाउँपालिका', 492, 'गाउँपालिका'),
(2304, 'चम्पादेवी गाउँपालिका', 492, 'गाउँपालिका'),
(2305, 'चिशंखुगढी गाउँपालिका', 492, 'गाउँपालिका'),
(2306, 'मानेभञ्याङ गाउँपालिका', 492, 'गाउँपालिका'),
(2307, 'मोलुङ गाउँपालिका', 492, 'गाउँपालिका'),
(2308, 'लिखु गाउँपालिका', 492, 'गाउँपालिका'),
(2309, 'सुनकोशी गाउँपालिका', 492, 'गाउँपालिका'),
(2310, 'हलेसी तुवाचुङ नगरपालिका', 493, 'नगरपालिका'),
(2311, 'रुपाकोट मझुवागढी नगरपालिका', 493, 'नगरपालिका'),
(2312, 'ऐसेलुखर्क गाउँपालिका', 493, 'गाउँपालिका'),
(2313, 'लामीडाँडा गाउँपालिका', 493, 'गाउँपालिका'),
(2314, 'जन्तेढुंगा गाउँपालिका', 493, 'गाउँपालिका'),
(2315, 'खोटेहाङ गाउँपालिका', 493, 'गाउँपालिका'),
(2316, 'केपिलासगढी गाउँपालिका', 493, 'गाउँपालिका'),
(2317, 'दिप्रुङ गाउँपालिका', 493, 'गाउँपालिका'),
(2318, 'साकेला गाउँपालिका', 493, 'गाउँपालिका'),
(2319, 'वराहपोखरी गाउँपालिका', 493, 'गाउँपालिका'),
(2320, 'कटारी नगरपालिका', 494, 'नगरपालिका'),
(2321, 'चौदण्डीगढी नगरपालिका', 494, 'नगरपालिका'),
(2322, 'त्रियुगा नगरपालिका', 494, 'नगरपालिका'),
(2323, 'वेलका नगरपालिका', 494, 'नगरपालिका'),
(2324, 'उदयपुरगढी गाउँपालिका', 494, 'गाउँपालिका'),
(2325, 'ताप्ली गाउँपालिका', 494, 'गाउँपालिका'),
(2326, 'रौतामाई गाउँपालिका', 494, 'गाउँपालिका'),
(2327, 'सुनकोशी गाउँपालिका', 494, 'गाउँपालिका'),
(2328, 'राजविराज नगरपालिका', 496, 'नगरपालिका'),
(2329, 'कञ्चनरुप नगरपालिका', 496, 'नगरपालिका'),
(2330, 'डाक्नेश्वरी नगरपालिका', 496, 'नगरपालिका'),
(2331, 'बोदेबरसाईन नगरपालिका', 496, 'नगरपालिका'),
(2332, 'खडक नगरपालिका', 496, 'नगरपालिका'),
(2333, 'शम्भुनाथ नगरपालिका', 496, 'नगरपालिका'),
(2334, 'सुरुङ्‍गा नगरपालिका', 496, 'नगरपालिका'),
(2335, 'हनुमाननगर कङ्‌कालिनी नगरपालिका', 496, 'नगरपालिका'),
(2336, 'सप्तकोशी नगरपालिका', 496, 'नगरपालिका'),
(2337, 'अग्निसाइर कृष्णासवरन गाउँपालिका', 496, 'गाउँपालिका'),
(2338, 'छिन्नमस्ता गाउँपालिका', 496, 'गाउँपालिका'),
(2339, 'महादेवा गाउँपालिका', 496, 'गाउँपालिका'),
(2340, 'तिरहुत गाउँपालिका', 496, 'गाउँपालिका'),
(2341, 'तिलाठी कोईलाडी गाउँपालिका', 496, 'गाउँपालिका'),
(2342, 'रुपनी गाउँपालिका', 496, 'गाउँपालिका'),
(2343, 'बेल्ही चपेना गाउँपालिका', 496, 'गाउँपालिका'),
(2344, 'बिष्णुपुर गाउँपालिका', 496, 'गाउँपालिका'),
(2345, 'बलान-बिहुल गाउँपालिका', 496, 'गाउँपालिका'),
(2346, 'लहान नगरपालिका', 497, 'नगरपालिका'),
(2347, 'धनगढीमाई नगरपालिका', 497, 'नगरपालिका'),
(2348, 'सिरहा नगरपालिका', 497, 'नगरपालिका'),
(2349, 'गोलबजार नगरपालिका', 497, 'नगरपालिका'),
(2350, 'मिर्चैयाँ नगरपालिका', 497, 'नगरपालिका'),
(2351, 'कल्याणपुर नगरपालिका', 497, 'नगरपालिका'),
(2352, 'कर्जन्हा नगरपालिका', 497, 'नगरपालिका'),
(2353, 'सुखीपुर नगरपालिका', 497, 'नगरपालिका'),
(2354, 'भगवानपुर गाउँपालिका', 497, 'गाउँपालिका'),
(2355, 'औरही गाउँपालिका', 497, 'गाउँपालिका'),
(2356, 'विष्णुपुर गाउँपालिका', 497, 'गाउँपालिका'),
(2357, 'बरियारपट्टी गाउँपालिका', 497, 'गाउँपालिका'),
(2358, 'लक्ष्मीपुर पतारी गाउँपालिका', 497, 'गाउँपालिका'),
(2359, 'नरहा गाउँपालिका', 497, 'गाउँपालिका'),
(2360, 'सखुवानान्कारकट्टी गाउँपालिका', 497, 'गाउँपालिका'),
(2361, 'अर्नमा गाउँपालिका', 497, 'गाउँपालिका'),
(2362, 'नवराजपुर गाउँपालिका', 497, 'गाउँपालिका'),
(2363, 'जनकपुर उपमहानगरपालिका', 498, 'उपमहानगरपालिका'),
(2364, 'क्षिरेश्वरनाथ नगरपालिका', 498, 'नगरपालिका'),
(2365, 'गणेशमान चारनाथ नगरपालिका', 498, 'नगरपालिका'),
(2366, 'धनुषाधाम नगरपालिका', 498, 'नगरपालिका'),
(2367, 'नगराइन नगरपालिका', 498, 'नगरपालिका'),
(2368, 'विदेह नगरपालिका', 498, 'नगरपालिका'),
(2369, 'मिथिला नगरपालिका', 498, 'नगरपालिका'),
(2370, 'शहीदनगर नगरपालिका', 498, 'नगरपालिका'),
(2371, 'सबैला नगरपालिका', 498, 'नगरपालिका'),
(2372, 'कमला नगरपालिका', 498, 'नगरपालिका'),
(2373, 'मिथिला बिहारी नगरपालिका', 498, 'नगरपालिका'),
(2374, 'हंसपुर नगरपालिका', 498, 'नगरपालिका'),
(2375, 'जनकनन्दिनी गाउँपालिका', 498, 'गाउँपालिका'),
(2376, 'बटेश्वर गाउँपालिका', 498, 'गाउँपालिका'),
(2377, 'मुखियापट्टी मुसहरमिया गाउँपालिका', 498, 'गाउँपालिका'),
(2378, 'लक्ष्मीनिया गाउँपालिका', 498, 'गाउँपालिका'),
(2379, 'औरही गाउँपालिका', 498, 'गाउँपालिका'),
(2380, 'धनौजी गाउँपालिका', 498, 'गाउँपालिका'),
(2381, 'जलेश्वर नगरपालिका', 499, 'नगरपालिका'),
(2382, 'बर्दिबास नगरपालिका', 499, 'नगरपालिका'),
(2383, 'गौशाला नगरपालिका', 499, 'नगरपालिका'),
(2384, 'लोहरपट्टी नगरपालिका', 499, 'नगरपालिका'),
(2385, 'रामगोपालपुर नगरपालिका', 499, 'नगरपालिका'),
(2386, 'मनरा शिसवा नगरपालिका', 499, 'नगरपालिका'),
(2387, 'मटिहानी नगरपालिका', 499, 'नगरपालिका'),
(2388, 'भँगाहा नगरपालिका', 499, 'नगरपालिका'),
(2389, 'बलवा नगरपालिका', 499, 'नगरपालिका'),
(2390, 'औरही नगरपालिका', 499, 'नगरपालिका'),
(2391, 'एकडारा गाउँपालिका', 499, 'गाउँपालिका'),
(2392, 'सोनमा गाउँपालिका', 499, 'गाउँपालिका'),
(2393, 'साम्सी गाउँपालिका', 499, 'गाउँपालिका'),
(2394, 'महोत्तरी गाउँपालिका', 499, 'गाउँपालिका'),
(2395, 'पिपरा गाउँपालिका', 499, 'गाउँपालिका'),
(2396, 'ईश्वरपुर नगरपालिका', 500, 'नगरपालिका'),
(2397, 'मलंगवा नगरपालिका', 500, 'नगरपालिका'),
(2398, 'लालबन्दी नगरपालिका', 500, 'नगरपालिका'),
(2399, 'हरिपुर नगरपालिका', 500, 'नगरपालिका'),
(2400, 'हरिपुर्वा नगरपालिका', 500, 'नगरपालिका'),
(2401, 'हरिवन नगरपालिका', 500, 'नगरपालिका'),
(2402, 'बरहथवा नगरपालिका', 500, 'नगरपालिका'),
(2403, 'बलरा नगरपालिका', 500, 'नगरपालिका'),
(2404, 'गोडैटा नगरपालिका', 500, 'नगरपालिका'),
(2405, 'बागमती नगरपालिका', 500, 'नगरपालिका'),
(2406, 'कविलासी नगरपालिका', 500, 'नगरपालिका'),
(2407, 'चक्रघट्टा गाउँपालिका', 500, 'गाउँपालिका'),
(2408, 'चन्द्रनगर गाउँपालिका', 500, 'गाउँपालिका'),
(2409, 'धनकौल गाउँपालिका', 500, 'गाउँपालिका'),
(2410, 'ब्रह्मपुरी गाउँपालिका', 500, 'गाउँपालिका'),
(2411, 'रामनगर गाउँपालिका', 500, 'गाउँपालिका'),
(2412, 'विष्णु गाउँपालिका', 500, 'गाउँपालिका'),
(2413, 'कौडेना गाउँपालिका', 500, 'गाउँपालिका'),
(2414, 'पर्सा गाउँपालिका', 500, 'गाउँपालिका'),
(2415, 'बसबरीया गाउँपालिका', 500, 'गाउँपालिका'),
(2416, 'चन्द्रपुर नगरपालिका', 501, 'नगरपालिका'),
(2417, 'गरुडा नगरपालिका', 501, 'नगरपालिका'),
(2418, 'गौर नगरपालिका', 501, 'नगरपालिका'),
(2419, 'बौधीमाई नगरपालिका', 501, 'नगरपालिका'),
(2420, 'बृन्दावन नगरपालिका', 501, 'नगरपालिका'),
(2421, 'देवाही गोनाही नगरपालिका', 501, 'नगरपालिका'),
(2422, 'गढीमाई नगरपालिका', 501, 'नगरपालिका'),
(2423, 'गुजरा नगरपालिका', 501, 'नगरपालिका'),
(2424, 'कटहरिया नगरपालिका', 501, 'नगरपालिका'),
(2425, 'माधव नारायण नगरपालिका', 501, 'नगरपालिका'),
(2426, 'मौलापुर नगरपालिका', 501, 'नगरपालिका'),
(2427, 'फतुवाबिजयपुर नगरपालिका', 501, 'नगरपालिका'),
(2428, 'ईशनाथ नगरपालिका', 501, 'नगरपालिका'),
(2429, 'परोहा नगरपालिका', 501, 'नगरपालिका'),
(2430, 'राजपुर नगरपालिका', 501, 'नगरपालिका'),
(2431, 'राजदेवी नगरपालिका', 501, 'नगरपालिका'),
(2432, 'दुर्गा भगवती गाउँपालिका', 501, 'गाउँपालिका'),
(2433, 'यमुनामाई गाउँपालिका', 501, 'गाउँपालिका'),
(2434, 'कलैया उपमहानगरपालिका', 502, 'उपमहानगरपालिका'),
(2435, 'जीतपुर सिमरा उपमहानगरपालिका', 502, 'उपमहानगरपालिका'),
(2436, 'कोल्हवी नगरपालिका', 502, 'नगरपालिका'),
(2437, 'निजगढ नगरपालिका', 502, 'नगरपालिका'),
(2438, 'महागढीमाई नगरपालिका', 502, 'नगरपालिका'),
(2439, 'सिम्रौनगढ नगरपालिका', 502, 'नगरपालिका'),
(2440, 'पचरौता नगरपालिका', 502, 'नगरपालिका'),
(2441, 'आदर्श कोटवाल गाउँपालिका', 502, 'गाउँपालिका'),
(2442, 'करैयामाई गाउँपालिका', 502, 'गाउँपालिका'),
(2443, 'देवताल गाउँपालिका', 502, 'गाउँपालिका'),
(2444, 'परवानीपुर गाउँपालिका', 502, 'गाउँपालिका'),
(2445, 'प्रसौनी गाउँपालिका', 502, 'गाउँपालिका'),
(2446, 'फेटा गाउँपालिका', 502, 'गाउँपालिका'),
(2447, 'बारागढीगाउँपालिका', 502, 'गाउँपालिका'),
(2448, 'सुवर्ण गाउँपालिका', 502, 'गाउँपालिका'),
(2449, 'विश्रामपुर गाउँपालिका', 502, 'गाउँपालिका'),
(2450, 'बिरगंज महानगरपालिका', 503, 'महानगरपालिका'),
(2451, 'पोखरिया नगरपालिका', 503, 'नगरपालिका'),
(2452, 'बहुदरमाई नगरपालिका', 503, 'नगरपालिका'),
(2453, 'पर्सागढी नगरपालिका', 503, 'नगरपालिका'),
(2454, 'ठोरी गाउँपालिका', 503, 'गाउँपालिका'),
(2455, 'जगरनाथपुर गाउँपालिका', 503, 'गाउँपालिका'),
(2456, 'धोबीनी गाउँपालिका', 503, 'गाउँपालिका'),
(2457, 'छिपहरमाई गाउँपालिका', 503, 'गाउँपालिका'),
(2458, 'पकाहा मैनपुर गाउँपालिका', 503, 'गाउँपालिका'),
(2459, 'बिन्दबासिनी गाउँपालिका', 503, 'गाउँपालिका'),
(2460, 'सखुवा प्रसौनी गाउँपालिका', 503, 'गाउँपालिका'),
(2461, 'पटेर्वा सुगौली गाउँपालिका', 503, 'गाउँपालिका'),
(2462, 'कालिकामाई गाउँपालिका', 503, 'गाउँपालिका'),
(2463, 'जिरा भवानी गाउँपालिका', 503, 'गाउँपालिका'),
(2464, 'कमलामाई नगरपालिका', 504, 'नगरपालिका'),
(2465, 'दुधौली नगरपालिका', 504, 'नगरपालिका'),
(2466, 'गोलन्जर गाउँपालिका', 504, 'गाउँपालिका'),
(2467, 'घ्याङलेख गाउँपालिका', 504, 'गाउँपालिका'),
(2468, 'तीनपाटन गाउँपालिका', 504, 'गाउँपालिका'),
(2469, 'फिक्कल गाउँपालिका', 504, 'गाउँपालिका'),
(2470, 'मरिण गाउँपालिका', 504, 'गाउँपालिका'),
(2471, 'सुनकोशी गाउँपालिका', 504, 'गाउँपालिका'),
(2472, 'हरिहरपुरगढी गाउँपालिका', 504, 'गाउँपालिका'),
(2473, 'मन्थली नगरपालिका', 505, 'नगरपालिका'),
(2474, 'रामेछाप नगरपालिका', 505, 'नगरपालिका'),
(2475, 'उमाकुण्ड गाउँपालिका', 505, 'गाउँपालिका'),
(2476, 'खाँडादेवी गाउँपालिका', 505, 'गाउँपालिका'),
(2477, 'गोकुलगङ्गा गाउँपालिका', 505, 'गाउँपालिका'),
(2478, 'दोरम्बा गाउँपालिका', 505, 'गाउँपालिका'),
(2479, 'लिखु गाउँपालिका', 505, 'गाउँपालिका'),
(2480, 'सुनापती गाउँपालिका', 505, 'गाउँपालिका'),
(2481, 'जिरी नगरपालिका', 506, 'नगरपालिका'),
(2482, 'भिमेश्वर नगरपालिका', 506, 'नगरपालिका'),
(2483, 'कालिन्चोक गाउँपालिका', 506, 'गाउँपालिका'),
(2484, 'गौरीशङ्कर गाउँपालिका', 506, 'गाउँपालिका'),
(2485, 'तामाकोशी गाउँपालिका', 506, 'गाउँपालिका'),
(2486, 'मेलुङ्ग गाउँपालिका', 506, 'गाउँपालिका'),
(2487, 'विगु गाउँपालिका', 506, 'गाउँपालिका'),
(2488, 'वैतेश्वर गाउँपालिका', 506, 'गाउँपालिका'),
(2489, 'शैलुङ्ग गाउँपालिका', 506, 'गाउँपालिका'),
(2490, 'चौतारा साँगाचोकगढी नगरपालिका', 507, 'नगरपालिका'),
(2491, 'बाह्रविसे नगरपालिका', 507, 'नगरपालिका'),
(2492, 'मेलम्ची नगरपालिका', 507, 'नगरपालिका'),
(2493, 'ईन्द्रावती गाउँपालिका', 507, 'गाउँपालिका'),
(2494, 'जुगल गाउँपालिका', 507, 'गाउँपालिका'),
(2495, 'पाँचपोखरी थाङपाल गाउँपालिका', 507, 'गाउँपालिका'),
(2496, 'बलेफी गाउँपालिका', 507, 'गाउँपालिका'),
(2497, 'भोटेकोशी गाउँपालिका', 507, 'गाउँपालिका'),
(2498, 'लिसङ्खु पाखर गाउँपालिका', 507, 'गाउँपालिका'),
(2499, 'सुनकोशी गाउँपालिका', 507, 'गाउँपालिका'),
(2500, 'हेलम्बु गाउँपालिका', 507, 'गाउँपालिका'),
(2501, 'त्रिपुरासुन्दरी गाउँपालिका', 507, 'गाउँपालिका'),
(2502, 'धुलिखेल नगरपालिका', 508, 'नगरपालिका'),
(2503, 'बनेपा नगरपालिका', 508, 'नगरपालिका'),
(2504, 'पनौती नगरपालिका', 508, 'नगरपालिका'),
(2505, 'पाँचखाल नगरपालिका', 508, 'नगरपालिका'),
(2506, 'नमोबुद्ध नगरपालिका', 508, 'नगरपालिका'),
(2507, 'मण्डनदेउपुर नगरपालिका', 508, 'नगरपालिका'),
(2508, 'खानीखोला गाउँपालिका', 508, 'गाउँपालिका'),
(2509, 'चौंरीदेउराली गाउँपालिका', 508, 'गाउँपालिका'),
(2510, 'तेमाल गाउँपालिका', 508, 'गाउँपालिका'),
(2511, 'बेथानचोक गाउँपालिका', 508, 'गाउँपालिका'),
(2512, 'भुम्लु गाउँपालिका', 508, 'गाउँपालिका'),
(2513, 'महाभारत गाउँपालिका', 508, 'गाउँपालिका'),
(2514, 'रोशी गाउँपालिका', 508, 'गाउँपालिका'),
(2515, 'ललितपुर महानगरपालिका', 509, 'महानगरपालिका'),
(2516, 'गोदावरी नगरपालिका', 509, 'नगरपालिका'),
(2517, 'महालक्ष्मी नगरपालिका', 509, 'नगरपालिका'),
(2518, 'कोन्ज्योसोम गाउँपालिका', 509, 'गाउँपालिका'),
(2519, 'बागमती गाउँपालिका', 509, 'गाउँपालिका'),
(2520, 'महाङ्काल गाउँपालिका', 509, 'गाउँपालिका'),
(2521, 'चाँगुनारायण नगरपालिका', 510, 'नगरपालिका'),
(2522, 'भक्तपुर नगरपालिका', 510, 'नगरपालिका'),
(2523, 'मध्यपुर थिमी नगरपालिका', 510, 'नगरपालिका'),
(2524, 'सूर्यविनायक नगरपालिका', 510, 'नगरपालिका'),
(2525, 'काठमाण्डौं महानगरपालिका', 511, 'महानगरपालिका'),
(2526, 'कागेश्वरी मनोहरा नगरपालिका', 511, 'नगरपालिका'),
(2527, 'कीर्तिपुर नगरपालिका', 511, 'नगरपालिका'),
(2528, 'गोकर्णेश्वर नगरपालिका', 511, 'नगरपालिका'),
(2529, 'चन्द्रागिरी नगरपालिका', 511, 'नगरपालिका'),
(2530, 'टोखा नगरपालिका', 511, 'नगरपालिका'),
(2531, 'तारकेश्वर नगरपालिका', 511, 'नगरपालिका'),
(2532, 'दक्षिणकाली नगरपालिका', 511, 'नगरपालिका'),
(2533, 'नागार्जुन नगरपालिका', 511, 'नगरपालिका'),
(2534, 'बुढानिलकण्ठ नगरपालिका', 511, 'नगरपालिका'),
(2535, 'शङ्खरापुर नगरपालिका', 511, 'नगरपालिका'),
(2536, 'विदुर नगरपालिका', 512, 'नगरपालिका'),
(2537, 'बेलकोटगढी नगरपालिका', 512, 'नगरपालिका'),
(2538, 'ककनी गाउँपालिका', 512, 'गाउँपालिका'),
(2539, 'किस्पाङ गाउँपालिका', 512, 'गाउँपालिका'),
(2540, 'तादी गाउँपालिका', 512, 'गाउँपालिका'),
(2541, 'तारकेश्वर गाउँपालिका', 512, 'गाउँपालिका'),
(2542, 'दुप्चेश्वर गाउँपालिका', 512, 'गाउँपालिका'),
(2543, 'पञ्चकन्या गाउँपालिका', 512, 'गाउँपालिका'),
(2544, 'लिखु गाउँपालिका', 512, 'गाउँपालिका'),
(2545, 'मेघाङ गाउँपालिका', 512, 'गाउँपालिका'),
(2546, 'शिवपुरी गाउँपालिका', 512, 'गाउँपालिका'),
(2547, 'सुर्यगढी गाउँपालिका', 512, 'गाउँपालिका'),
(2548, 'उत्तरगया गाउँपालिका', 513, 'गाउँपालिका'),
(2549, 'कालिका गाउँपालिका', 513, 'गाउँपालिका'),
(2550, 'गोसाईकुण्ड गाउँपालिका', 513, 'गाउँपालिका'),
(2551, 'नौकुण्ड गाउँपालिका', 513, 'गाउँपालिका'),
(2552, 'पार्वतीकुण्ड गाउँपालिका', 513, 'गाउँपालिका'),
(2553, 'धुनीबेंशी नगरपालिका', 514, 'नगरपालिका'),
(2554, 'निलकण्ठ नगरपालिका', 514, 'नगरपालिका'),
(2555, 'खनियाबास गाउँपालिका', 514, 'गाउँपालिका'),
(2556, 'गजुरी गाउँपालिका', 514, 'गाउँपालिका'),
(2557, 'गल्छी गाउँपालिका', 514, 'गाउँपालिका'),
(2558, 'गङ्गाजमुना गाउँपालिका', 514, 'गाउँपालिका'),
(2559, 'ज्वालामूखी गाउँपालिका', 514, 'गाउँपालिका'),
(2560, 'थाक्रे गाउँपालिका', 514, 'गाउँपालिका'),
(2561, 'नेत्रावति गाउँपालिका', 514, 'गाउँपालिका'),
(2562, 'बेनीघाट रोराङ गाउँपालिका', 514, 'गाउँपालिका'),
(2563, 'रुवी भ्याली गाउँपालिका', 514, 'गाउँपालिका'),
(2564, 'सिद्धलेक गाउँपालिका', 514, 'गाउँपालिका'),
(2565, 'त्रिपुरासुन्दरी गाउँपालिका', 514, 'गाउँपालिका'),
(2566, 'हेटौडा उपमहानगरपालिका', 515, 'उपमहानगरपालिका'),
(2567, 'थाहा नगरपालिका', 515, 'नगरपालिका'),
(2568, 'इन्द्रसरोबर गाउँपालिका', 515, 'गाउँपालिका'),
(2569, 'कैलाश गाउँपालिका', 515, 'गाउँपालिका'),
(2570, 'बकैया गाउँपालिका', 515, 'गाउँपालिका'),
(2571, 'बाग्मति गाउँपालिका', 515, 'गाउँपालिका'),
(2572, 'भिमफेदी गाउँपालिका', 515, 'गाउँपालिका'),
(2573, 'मकवानपुरगढी गाउँपालिका', 515, 'गाउँपालिका'),
(2574, 'मनहरी गाउँपालिका', 515, 'गाउँपालिका'),
(2575, 'राक्सिराङ्ग गाउँपालिका', 515, 'गाउँपालिका'),
(2576, 'भरतपुर महानगरपालिका', 516, 'महानगरपालिका'),
(2577, 'कालिका नगरपालिका', 516, 'नगरपालिका'),
(2578, 'खैरहनी नगरपालिका', 516, 'नगरपालिका'),
(2579, 'माडी नगरपालिका', 516, 'नगरपालिका'),
(2580, 'रत्ननगर नगरपालिका', 516, 'नगरपालिका'),
(2581, 'राप्ती नगरपालिका', 516, 'नगरपालिका'),
(2582, 'इच्छाकामना गाउँपालिका', 516, 'गाउँपालिका'),
(2583, 'गोरखा नगरपालिका', 517, 'नगरपालिका'),
(2584, 'पालुङटार नगरपालिका', 517, 'नगरपालिका'),
(2585, 'सुलीकोट गाउँपालिका', 517, 'गाउँपालिका'),
(2586, 'सिरानचोक गाउँपालिका', 517, 'गाउँपालिका'),
(2587, 'अजिरकोट गाउँपालिका', 517, 'गाउँपालिका'),
(2588, 'आरूघाट गाउँपालिका', 517, 'गाउँपालिका'),
(2589, 'गण्डकी गाउँपालिका', 517, 'गाउँपालिका'),
(2590, 'चुमनुव्री गाउँपालिका', 517, 'गाउँपालिका'),
(2591, 'धार्चे गाउँपालिका', 517, 'गाउँपालिका'),
(2592, 'भिमसेन गाउँपालिका', 517, 'गाउँपालिका'),
(2593, 'शहिद लखन गाउँपालिका', 517, 'गाउँपालिका'),
(2594, 'बेसीशहर नगरपालिका', 518, 'नगरपालिका'),
(2595, 'मध्यनेपाल नगरपालिका', 518, 'नगरपालिका'),
(2596, 'रार्इनास नगरपालिका', 518, 'नगरपालिका'),
(2597, 'सुन्दरबजार नगरपालिका', 518, 'नगरपालिका'),
(2598, 'क्व्होलासोथार गाउँपालिका', 518, 'गाउँपालिका'),
(2599, 'दूधपोखरी गाउँपालिका', 518, 'गाउँपालिका'),
(2600, 'दोर्दी गाउँपालिका', 518, 'गाउँपालिका'),
(2601, 'मर्स्याङदी गाउँपालिका', 518, 'गाउँपालिका'),
(2602, 'भानु नगरपालिका', 519, 'नगरपालिका'),
(2603, 'भिमाद नगरपालिका', 519, 'नगरपालिका'),
(2604, 'व्यास नगरपालिका', 519, 'नगरपालिका'),
(2605, 'शुक्लागण्डकी नगरपालिका', 519, 'नगरपालिका'),
(2606, 'आँबुखैरेनी गाउँपालिका', 519, 'गाउँपालिका'),
(2607, 'ऋषिङ्ग गाउँपालिका', 519, 'गाउँपालिका'),
(2608, 'घिरिङ गाउँपालिका', 519, 'गाउँपालिका'),
(2609, 'देवघाट गाउँपालिका', 519, 'गाउँपालिका'),
(2610, 'म्याग्दे गाउँपालिका', 519, 'गाउँपालिका'),
(2611, 'वन्दिपुर गाउँपालिका', 519, 'गाउँपालिका'),
(2612, 'गल्याङ नगरपालिका', 520, 'नगरपालिका'),
(2613, 'चापाकोट नगरपालिका', 520, 'नगरपालिका'),
(2614, 'पुतलीबजार नगरपालिका', 520, 'नगरपालिका'),
(2615, 'भीरकोट नगरपालिका', 520, 'नगरपालिका'),
(2616, 'वालिङ नगरपालिका', 520, 'नगरपालिका'),
(2617, 'अर्जुनचौपारी गाउँपालिका', 520, 'गाउँपालिका'),
(2618, 'आँधिखोला गाउँपालिका', 520, 'गाउँपालिका'),
(2619, 'कालीगण्डकी गाउँपालिका', 520, 'गाउँपालिका'),
(2620, 'फेदीखोला गाउँपालिका', 520, 'गाउँपालिका'),
(2621, 'बिरुवा गाउँपालिका', 520, 'गाउँपालिका'),
(2622, 'हरिनास गाउँपालिका', 520, 'गाउँपालिका'),
(2623, 'पोखरा लेखनाथ महानगरपालिका', 521, 'महानगरपालिका'),
(2624, 'अन्नपूर्ण गाउँपालिका', 521, 'गाउँपालिका'),
(2625, 'माछापुच्छ्रे गाउँपालिका', 521, 'गाउँपालिका'),
(2626, 'मादी गाउँपालिका', 521, 'गाउँपालिका'),
(2627, 'रूपा गाउँपालिका', 521, 'गाउँपालिका'),
(2628, 'चामे गाउँपालिका', 0, 'गाउँपालिका'),
(2629, 'नारफू गाउँपालिका', 0, 'गाउँपालिका'),
(2630, 'नाशोङ गाउँपालिका', 0, 'गाउँपालिका'),
(2631, 'नेस्याङ गाउँपालिका', 0, 'गाउँपालिका'),
(2632, 'घरपझोङ गाउँपालिका', 522, 'गाउँपालिका'),
(2633, 'थासाङ गाउँपालिका', 522, 'गाउँपालिका'),
(2634, 'दालोमे गाउँपालिका', 522, 'गाउँपालिका'),
(2635, 'लोमन्थाङ गाउँपालिका', 522, 'गाउँपालिका'),
(2636, 'वाह्रगाउँ मुक्तिक्षेत्र गाउँपालिका', 522, 'गाउँपालिका'),
(2637, 'बेनी नगरपालिका', 523, 'नगरपालिका'),
(2638, 'अन्नपूर्ण गाउँपालिका', 523, 'गाउँपालिका'),
(2639, 'धवलागिरी गाउँपालिका', 523, 'गाउँपालिका'),
(2640, 'मंगला गाउँपालिका', 523, 'गाउँपालिका'),
(2641, 'मालिका गाउँपालिका', 523, 'गाउँपालिका'),
(2642, 'रघुगंगा गाउँपालिका', 523, 'गाउँपालिका'),
(2643, 'कुश्मा नगरपालिका', 524, 'नगरपालिका'),
(2644, 'फलेवास नगरपालिका', 524, 'नगरपालिका'),
(2645, 'जलजला गाउँपालिका', 524, 'गाउँपालिका'),
(2646, 'पैयूं गाउँपालिका', 524, 'गाउँपालिका'),
(2647, 'महाशिला गाउँपालिका', 524, 'गाउँपालिका'),
(2648, 'मोदी गाउँपालिका', 524, 'गाउँपालिका'),
(2649, 'विहादी गाउँपालिका', 524, 'गाउँपालिका'),
(2650, 'बागलुङ नगरपालिका', 525, 'नगरपालिका'),
(2651, 'गल्कोट नगरपालिका', 525, 'नगरपालिका'),
(2652, 'जैमूनी नगरपालिका', 525, 'नगरपालिका'),
(2653, 'ढोरपाटन नगरपालिका', 525, 'नगरपालिका'),
(2654, 'वरेङ गाउँपालिका', 525, 'गाउँपालिका'),
(2655, 'काठेखोला गाउँपालिका', 525, 'गाउँपालिका'),
(2656, 'तमानखोला गाउँपालिका', 525, 'गाउँपालिका'),
(2657, 'ताराखोला गाउँपालिका', 525, 'गाउँपालिका'),
(2658, 'निसीखोला गाउँपालिका', 525, 'गाउँपालिका'),
(2659, 'वडिगाड गाउँपालिका', 525, 'गाउँपालिका'),
(2660, 'कावासोती नगरपालिका', 526, 'नगरपालिका'),
(2661, 'गैडाकोट नगरपालिका', 526, 'नगरपालिका'),
(2662, 'देवचुली नगरपालिका', 526, 'नगरपालिका'),
(2663, 'मध्यविन्दु नगरपालिका', 526, 'नगरपालिका'),
(2664, 'बुङ्दीकाली गाउँपालिका', 526, 'गाउँपालिका'),
(2665, 'बुलिङटार गाउँपालिका', 526, 'गाउँपालिका'),
(2666, 'विनयी त्रिवेणी गाउँपालिका', 526, 'गाउँपालिका'),
(2667, 'हुप्सेकोट गाउँपालिका', 526, 'गाउँपालिका'),
(2668, 'मुसिकोट नगरपालिका', 527, 'नगरपालिका'),
(2669, 'रेसुङ्गा नगरपालिका', 527, 'नगरपालिका'),
(2670, 'ईस्मा गाउँपालिका', 527, 'गाउँपालिका'),
(2671, 'कालीगण्डकी गाउँपालिका', 527, 'गाउँपालिका'),
(2672, 'गुल्मी दरबार गाउँपालिका', 527, 'गाउँपालिका'),
(2673, 'सत्यवती गाउँपालिका', 527, 'गाउँपालिका'),
(2674, 'चन्द्रकोट गाउँपालिका', 527, 'गाउँपालिका'),
(2675, 'रुरु गाउँपालिका', 527, 'गाउँपालिका'),
(2676, 'छत्रकोट गाउँपालिका', 527, 'गाउँपालिका'),
(2677, 'धुर्कोट गाउँपालिका', 527, 'गाउँपालिका'),
(2678, 'मदाने गाउँपालिका', 527, 'गाउँपालिका'),
(2679, 'मालिका गाउँपालिका', 527, 'गाउँपालिका'),
(2680, 'रामपुर नगरपालिका', 528, 'नगरपालिका'),
(2681, 'तानसेन नगरपालिका', 528, 'नगरपालिका'),
(2682, 'निस्दी गाउँपालिका', 528, 'गाउँपालिका'),
(2683, 'पूर्वखोला गाउँपालिका', 528, 'गाउँपालिका'),
(2684, 'रम्भा गाउँपालिका', 528, 'गाउँपालिका'),
(2685, 'माथागढी गाउँपालिका', 528, 'गाउँपालिका'),
(2686, 'तिनाउ गाउँपालिका', 528, 'गाउँपालिका'),
(2687, 'बगनासकाली गाउँपालिका', 528, 'गाउँपालिका'),
(2688, 'रिब्दिकोट गाउँपालिका', 528, 'गाउँपालिका'),
(2689, 'रैनादेवी छहरा गाउँपालिका', 528, 'गाउँपालिका'),
(2690, 'बुटवल उपमहानगरपालिका', 529, 'उपमहानगरपालिका'),
(2691, 'देवदह नगरपालिका', 529, 'नगरपालिका'),
(2692, 'लुम्बिनी सांस्कृतिक नगरपालिका', 529, 'नगरपालिका'),
(2693, 'सैनामैना नगरपालिका', 529, 'नगरपालिका'),
(2694, 'सिद्धार्थनगर नगरपालिका', 529, 'नगरपालिका'),
(2695, 'तिलोत्तमा नगरपालिका', 529, 'नगरपालिका'),
(2696, 'गैडहवा गाउँपालिका', 529, 'गाउँपालिका'),
(2697, 'कन्चन गाउँपालिका', 529, 'गाउँपालिका'),
(2698, 'कोटहीमाई गाउँपालिका', 529, 'गाउँपालिका'),
(2699, 'मर्चवारी गाउँपालिका', 529, 'गाउँपालिका'),
(2700, 'मायादेवी गाउँपालिका', 529, 'गाउँपालिका'),
(2701, 'ओमसतिया गाउँपालिका', 529, 'गाउँपालिका'),
(2702, 'रोहिणी गाउँपालिका', 529, 'गाउँपालिका'),
(2703, 'सम्मरीमाई गाउँपालिका', 529, 'गाउँपालिका'),
(2704, 'सियारी गाउँपालिका', 529, 'गाउँपालिका'),
(2705, 'शुद्धोधन गाउँपालिका', 529, 'गाउँपालिका'),
(2706, 'कपिलवस्तु नगरपालिका', 530, 'नगरपालिका'),
(2707, 'बुद्धभूमी नगरपालिका', 530, 'नगरपालिका'),
(2708, 'शिवराज नगरपालिका', 530, 'नगरपालिका'),
(2709, 'महाराजगंज नगरपालिका', 530, 'नगरपालिका'),
(2710, 'कृष्णनगर नगरपालिका', 530, 'नगरपालिका'),
(2711, 'बाणगंगा नगरपालिका', 530, 'नगरपालिका'),
(2712, 'मायादेवी गाउँपालिका', 530, 'गाउँपालिका'),
(2713, 'यसोधरा गाउँपालिका', 530, 'गाउँपालिका'),
(2714, 'सुद्धोधन गाउँपालिका', 530, 'गाउँपालिका'),
(2715, 'विजयनगर गाउँपालिका', 530, 'गाउँपालिका'),
(2716, 'सन्धिखर्क नगरपालिका', 531, 'नगरपालिका'),
(2717, 'शितगंगा नगरपालिका', 531, 'नगरपालिका'),
(2718, 'भूमिकास्थान नगरपालिका', 531, 'नगरपालिका'),
(2719, 'छत्रदेव गाउँपालिका', 531, 'गाउँपालिका'),
(2720, 'पाणिनी गाउँपालिका', 531, 'गाउँपालिका'),
(2721, 'मालारानी गाउँपालिका', 531, 'गाउँपालिका'),
(2722, 'प्यूठान नगरपालिका', 532, 'नगरपालिका'),
(2723, 'स्वर्गद्वारी नगरपालिका', 532, 'नगरपालिका'),
(2724, 'गौमुखी गाउँपालिका', 532, 'गाउँपालिका'),
(2725, 'माण्डवी गाउँपालिका', 532, 'गाउँपालिका'),
(2726, 'सरुमारानी गाउँपालिका', 532, 'गाउँपालिका'),
(2727, 'मल्लरानी गाउँपालिका', 532, 'गाउँपालिका'),
(2728, 'नौवहिनी गाउँपालिका', 532, 'गाउँपालिका'),
(2729, 'झिमरुक गाउँपालिका', 532, 'गाउँपालिका'),
(2730, 'ऐरावती गाउँपालिका', 532, 'गाउँपालिका'),
(2731, 'रोल्पा नगरपालिका', 533, 'नगरपालिका'),
(2732, 'त्रिवेणी गाउँपालिका', 533, 'गाउँपालिका'),
(2733, 'दुईखोली गाउँपालिका', 533, 'गाउँपालिका'),
(2734, 'माडी गाउँपालिका', 533, 'गाउँपालिका'),
(2735, 'रुन्टीगढी गाउँपालिका', 533, 'गाउँपालिका'),
(2736, 'लुङग्री गाउँपालिका', 533, 'गाउँपालिका'),
(2737, 'सुकिदह गाउँपालिका', 533, 'गाउँपालिका'),
(2738, 'सुनछहरी गाउँपालिका', 533, 'गाउँपालिका'),
(2739, 'सुवर्णावती गाउँपालिका', 533, 'गाउँपालिका'),
(2740, 'थवाङ गाउँपालिका', 533, 'गाउँपालिका'),
(2741, 'पुथा उत्तरगंगा गाउँपालिका', 534, 'गाउँपालिका'),
(2742, 'भूमे गाउँपालिका', 534, 'गाउँपालिका'),
(2743, 'सिस्ने गाउँपालिका', 534, 'गाउँपालिका'),
(2744, 'तुल्सीपुर उपमहानगरपालिका', 535, 'उपमहानगरपालिका'),
(2745, 'घोराही उपमहानगरपालिका', 535, 'उपमहानगरपालिका'),
(2746, 'लमही नगरपालिका', 535, 'नगरपालिका'),
(2747, 'बंगलाचुली गाउँपालिका', 535, 'गाउँपालिका'),
(2748, 'दंगीशरण गाउँपालिका', 535, 'गाउँपालिका'),
(2749, 'गढवा गाउँपालिका', 535, 'गाउँपालिका'),
(2750, 'राजपुर गाउँपालिका', 535, 'गाउँपालिका'),
(2751, 'राप्ती गाउँपालिका', 535, 'गाउँपालिका'),
(2752, 'शान्तिनगर गाउँपालिका', 535, 'गाउँपालिका'),
(2753, 'बबई गाउँपालिका', 535, 'गाउँपालिका'),
(2754, 'नेपालगंज उपमहानगरपालिका', 536, 'उपमहानगरपालिका'),
(2755, 'कोहलपुर नगरपालिका', 536, 'नगरपालिका'),
(2756, 'नरैनापुर गाउँपालिका', 536, 'गाउँपालिका'),
(2757, 'राप्तीसोनारी गाउँपालिका', 536, 'गाउँपालिका'),
(2758, 'बैजनाथ गाउँपालिका', 536, 'गाउँपालिका'),
(2759, 'खजुरा गाउँपालिका', 536, 'गाउँपालिका'),
(2760, 'डुडुवा गाउँपालिका', 536, 'गाउँपालिका'),
(2761, 'जानकी गाउँपालिका', 536, 'गाउँपालिका'),
(2762, 'गुलरिया नगरपालिका', 537, 'नगरपालिका'),
(2763, 'मधुवन नगरपालिका', 537, 'नगरपालिका'),
(2764, 'राजापुर नगरपालिका', 537, 'नगरपालिका'),
(2765, 'ठाकुरबाबा नगरपालिका', 537, 'नगरपालिका'),
(2766, 'बाँसगढी नगरपालिका', 537, 'नगरपालिका'),
(2767, 'बारबर्दिया नगरपालिका', 537, 'नगरपालिका'),
(2768, 'बढैयाताल गाउँपालिका', 537, 'गाउँपालिका'),
(2769, 'गेरुवा गाउँपालिका', 537, 'गाउँपालिका'),
(2770, 'बर्दघाट नगरपालिका', 538, 'नगरपालिका'),
(2771, 'रामग्राम नगरपालिका', 538, 'नगरपालिका'),
(2772, 'सुनवल नगरपालिका', 538, 'नगरपालिका'),
(2773, 'सुस्ता गाउँपालिका', 538, 'गाउँपालिका'),
(2774, 'पाल्हीनन्दन गाउँपालिका', 538, 'गाउँपालिका'),
(2775, 'प्रतापपुर गाउँपालिका', 538, 'गाउँपालिका'),
(2776, 'सरावल गाउँपालिका', 538, 'गाउँपालिका'),
(2777, 'मुसिकोट नगरपालिका', 539, 'नगरपालिका'),
(2778, 'चौरजहारी नगरपालिका', 539, 'नगरपालिका'),
(2779, 'आठबिसकोट नगरपालिका', 539, 'नगरपालिका'),
(2780, 'बाँफिकोट गाउँपालिका', 539, 'गाउँपालिका'),
(2781, 'त्रिवेणी गाउँपालिका', 539, 'गाउँपालिका'),
(2782, 'सानी भेरी गाउँपालिका', 539, 'गाउँपालिका'),
(2783, 'शारदा नगरपालिका', 540, 'नगरपालिका'),
(2784, 'बागचौर नगरपालिका', 540, 'नगरपालिका'),
(2785, 'बनगाड कुपिण्डे नगरपालिका', 540, 'नगरपालिका'),
(2786, 'कालिमाटी गाउँपालिका', 540, 'गाउँपालिका'),
(2787, 'त्रिवेणी गाउँपालिका', 540, 'गाउँपालिका'),
(2788, 'कपुरकोट गाउँपालिका', 540, 'गाउँपालिका'),
(2789, 'छत्रेश्वरी गाउँपालिका', 540, 'गाउँपालिका'),
(2790, 'ढोरचौर गाउँपालिका', 540, 'गाउँपालिका'),
(2791, 'कुमाखमालिका गाउँपालिका', 540, 'गाउँपालिका'),
(2792, 'दार्मा गाउँपालिका', 540, 'गाउँपालिका'),
(2793, 'बीरेन्द्रनगर नगरपालिका', 541, 'नगरपालिका'),
(2794, 'भेरीगंगा नगरपालिका', 541, 'नगरपालिका'),
(2795, 'गुर्भाकोट नगरपालिका', 541, 'नगरपालिका'),
(2796, 'पञ्चपुरी नगरपालिका', 541, 'नगरपालिका'),
(2797, 'लेकवेशी नगरपालिका', 541, 'नगरपालिका'),
(2798, 'चौकुने गाउँपालिका', 541, 'गाउँपालिका'),
(2799, 'बराहताल गाउँपालिका', 541, 'गाउँपालिका'),
(2800, 'चिङ्गाड गाउँपालिका', 541, 'गाउँपालिका'),
(2801, 'सिम्ता गाउँपालिका', 541, 'गाउँपालिका'),
(2802, 'नारायण नगरपालिका', 542, 'नगरपालिका'),
(2803, 'दुल्लु नगरपालिका', 542, 'नगरपालिका'),
(2804, 'चामुण्डा विन्द्रासैनी नगरपालिका', 542, 'नगरपालिका'),
(2805, 'आठबीस नगरपालिका', 542, 'नगरपालिका'),
(2806, 'भगवतीमाई गाउँपालिका', 542, 'गाउँपालिका'),
(2807, 'गुराँस गाउँपालिका', 542, 'गाउँपालिका'),
(2808, 'डुंगेश्वर गाउँपालिका', 542, 'गाउँपालिका'),
(2809, 'नौमुले गाउँपालिका', 542, 'गाउँपालिका'),
(2810, 'महावु गाउँपालिका', 542, 'गाउँपालिका'),
(2811, 'भैरवी गाउँपालिका', 542, 'गाउँपालिका'),
(2812, 'ठाँटीकाँध गाउँपालिका', 542, 'गाउँपालिका'),
(2813, 'भेरी नगरपालिका', 543, 'नगरपालिका'),
(2814, 'छेडागाड नगरपालिका', 543, 'नगरपालिका'),
(2815, 'त्रिवेणी नलगाड नगरपालिका', 543, 'नगरपालिका'),
(2816, 'बारेकोट गाउँपालिका', 543, 'गाउँपालिका'),
(2817, 'कुसे गाउँपालिका', 543, 'गाउँपालिका'),
(2818, 'जुनीचाँदे गाउँपालिका', 543, 'गाउँपालिका'),
(2819, 'शिवालय गाउँपालिका', 543, 'गाउँपालिका'),
(2820, 'ठुली भेरी नगरपालिका', 544, 'नगरपालिका'),
(2821, 'त्रिपुरासुन्दरी नगरपालिका', 544, 'नगरपालिका'),
(2822, 'डोल्पो बुद्ध गाउँपालिका', 544, 'गाउँपालिका'),
(2823, 'शे फोक्सुन्डो गाउँपालिका', 544, 'गाउँपालिका'),
(2824, 'जगदुल्ला गाउँपालिका', 544, 'गाउँपालिका'),
(2825, 'मुड्केचुला गाउँपालिका', 544, 'गाउँपालिका'),
(2826, 'काईके गाउँपालिका', 544, 'गाउँपालिका'),
(2827, 'छार्का ताङसोङ गाउँपालिका', 544, 'गाउँपालिका'),
(2828, 'चन्दननाथ नगरपालिका', 545, 'नगरपालिका'),
(2829, 'कनकासुन्दरी गाउँपालिका', 545, 'गाउँपालिका'),
(2830, 'सिंजा गाउँपालिका', 545, 'गाउँपालिका'),
(2831, 'हिमा गाउँपालिका', 545, 'गाउँपालिका'),
(2832, 'तिला गाउँपालिका', 545, 'गाउँपालिका'),
(2833, 'गुठिचौर गाउँपालिका', 545, 'गाउँपालिका'),
(2834, 'तातोपानी गाउँपालिका', 545, 'गाउँपालिका'),
(2835, 'पातारासी गाउँपालिका', 545, 'गाउँपालिका'),
(2836, 'खाँडाचक्र नगरपालिका', 546, 'नगरपालिका'),
(2837, 'रास्कोट नगरपालिका', 546, 'नगरपालिका'),
(2838, 'तिलागुफा नगरपालिका', 546, 'नगरपालिका'),
(2839, 'पचालझरना गाउँपालिका', 546, 'गाउँपालिका'),
(2840, 'सान्नी त्रिवेणी गाउँपालिका', 546, 'गाउँपालिका'),
(2841, 'नरहरिनाथ गाउँपालिका', 546, 'गाउँपालिका'),
(2842, 'कालिका गाउँपालिका', 546, 'गाउँपालिका'),
(2843, 'महावै गाउँपालिका', 546, 'गाउँपालिका'),
(2844, 'पलाता गाउँपालिका', 546, 'गाउँपालिका'),
(2845, 'छायाँनाथ रारा नगरपालिका', 547, 'नगरपालिका'),
(2846, 'मुगुम कार्मारोंग गाउँपालिका', 547, 'गाउँपालिका'),
(2847, 'सोरु गाउँपालिका', 547, 'गाउँपालिका'),
(2848, 'खत्याड गाउँपालिका', 547, 'गाउँपालिका'),
(2849, 'सिमकोट गाउँपालिका', 548, 'गाउँपालिका'),
(2850, 'नाम्खा गाउँपालिका', 548, 'गाउँपालिका'),
(2851, 'खार्पुनाथ गाउँपालिका', 548, 'गाउँपालिका'),
(2852, 'सर्केगाड गाउँपालिका', 548, 'गाउँपालिका'),
(2853, 'चंखेली गाउँपालिका', 548, 'गाउँपालिका'),
(2854, 'अदानचुली गाउँपालिका', 548, 'गाउँपालिका'),
(2855, 'ताँजाकोट गाउँपालिका', 548, 'गाउँपालिका'),
(2856, 'बडीमालिका नगरपालिका', 549, 'नगरपालिका'),
(2857, 'त्रिवेणी नगरपालिका', 549, 'नगरपालिका'),
(2858, 'बुढीगंगा नगरपालिका', 549, 'नगरपालिका'),
(2859, 'बुढीनन्दा नगरपालिका', 549, 'नगरपालिका'),
(2860, 'गौमुल गाउँपालिका', 549, 'गाउँपालिका'),
(2861, 'पाण्डव गुफा गाउँपालिका', 549, 'गाउँपालिका'),
(2862, 'स्वामीकार्तिक गाउँपालिका', 549, 'गाउँपालिका'),
(2863, 'छेडेदह गाउँपालिका', 549, 'गाउँपालिका'),
(2864, 'हिमाली गाउँपालिका', 549, 'गाउँपालिका'),
(2865, 'जयपृथ्वी नगरपालिका', 550, 'नगरपालिका'),
(2866, 'बुंगल नगरपालिका', 550, 'नगरपालिका'),
(2867, 'तलकोट गाउँपालिका', 550, 'गाउँपालिका'),
(2868, 'मष्टा गाउँपालिका', 550, 'गाउँपालिका'),
(2869, 'खप्तडछान्ना गाउँपालिका', 550, 'गाउँपालिका'),
(2870, 'थलारा गाउँपालिका', 550, 'गाउँपालिका'),
(2871, 'वित्थडचिर गाउँपालिका', 550, 'गाउँपालिका'),
(2872, 'सूर्मा गाउँपालिका', 550, 'गाउँपालिका'),
(2873, 'छबिसपाथिभेरा गाउँपालिका', 550, 'गाउँपालिका'),
(2874, 'दुर्गाथली गाउँपालिका', 550, 'गाउँपालिका'),
(2875, 'केदारस्युँ गाउँपालिका', 550, 'गाउँपालिका'),
(2876, 'काँडा गाउँपालिका', 550, 'गाउँपालिका'),
(2877, 'मंगलसेन नगरपालिका', 551, 'नगरपालिका'),
(2878, 'कमलबजार नगरपालिका', 551, 'नगरपालिका'),
(2879, 'साँफेबगर नगरपालिका', 551, 'नगरपालिका'),
(2880, 'पन्चदेवल विनायक नगरपालिका', 551, 'नगरपालिका'),
(2881, 'चौरपाटी गाउँपालिका', 551, 'गाउँपालिका'),
(2882, 'मेल्लेख गाउँपालिका', 551, 'गाउँपालिका'),
(2883, 'बान्निगढी जयगढ गाउँपालिका', 551, 'गाउँपालिका'),
(2884, 'रामारोशन गाउँपालिका', 551, 'गाउँपालिका'),
(2885, 'ढकारी गाउँपालिका', 551, 'गाउँपालिका'),
(2886, 'तुर्माखाँद गाउँपालिका', 551, 'गाउँपालिका'),
(2887, 'दिपायल सिलगढी नगरपालिका', 552, 'नगरपालिका'),
(2888, 'शिखर नगरपालिका', 552, 'नगरपालिका'),
(2889, 'पूर्वीचौकी गाउँपालिका', 552, 'गाउँपालिका'),
(2890, 'बडीकेदार गाउँपालिका', 552, 'गाउँपालिका'),
(2891, 'जोरायल गाउँपालिका', 552, 'गाउँपालिका'),
(2892, 'सायल गाउँपालिका', 552, 'गाउँपालिका'),
(2893, 'आदर्श गाउँपालिका', 552, 'गाउँपालिका'),
(2894, 'के.आई.सिं. गाउँपालिका', 552, 'गाउँपालिका'),
(2895, 'बोगटान गाउँपालिका', 552, 'गाउँपालिका'),
(2896, 'धनगढी उपमहानगरपालिका', 553, 'उपमहानगरपालिका'),
(2897, 'टिकापुर नगरपालिका', 553, 'नगरपालिका'),
(2898, 'घोडाघोडी नगरपालिका', 553, 'नगरपालिका'),
(2899, 'लम्कीचुहा नगरपालिका', 553, 'नगरपालिका'),
(2900, 'भजनी नगरपालिका', 553, 'नगरपालिका'),
(2901, 'गोदावरी नगरपालिका', 553, 'नगरपालिका'),
(2902, 'गौरीगंगा नगरपालिका', 553, 'नगरपालिका'),
(2903, 'जानकी गाउँपालिका', 553, 'गाउँपालिका'),
(2904, 'बर्दगोरिया गाउँपालिका', 553, 'गाउँपालिका'),
(2905, 'मोहन्याल गाउँपालिका', 553, 'गाउँपालिका'),
(2906, 'कैलारी गाउँपालिका', 553, 'गाउँपालिका'),
(2907, 'जोशीपुर गाउँपालिका', 553, 'गाउँपालिका'),
(2908, 'चुरे गाउँपालिका', 553, 'गाउँपालिका'),
(2909, 'भीमदत्त नगरपालिका', 554, 'नगरपालिका'),
(2910, 'पुर्नवास नगरपालिका', 554, 'नगरपालिका'),
(2911, 'वेदकोट नगरपालिका', 554, 'नगरपालिका'),
(2912, 'महाकाली नगरपालिका', 554, 'नगरपालिका'),
(2913, 'शुक्लाफाँटा नगरपालिका', 554, 'नगरपालिका'),
(2914, 'बेलौरी नगरपालिका', 554, 'नगरपालिका'),
(2915, 'कृष्णपुर नगरपालिका', 554, 'नगरपालिका'),
(2916, 'बेलडाडी गाउँपालिका', 554, 'गाउँपालिका'),
(2917, 'लालझाडी गाउँपालिका', 554, 'गाउँपालिका'),
(2918, 'अमरगढी नगरपालिका', 555, 'नगरपालिका'),
(2919, 'परशुराम नगरपालिका', 555, 'नगरपालिका'),
(2920, 'आलिताल गाउँपालिका', 555, 'गाउँपालिका'),
(2921, 'भागेश्वर गाउँपालिका', 555, 'गाउँपालिका'),
(2922, 'नवदुर्गा गाउँपालिका', 555, 'गाउँपालिका'),
(2923, 'अजयमेरु गाउँपालिका', 555, 'गाउँपालिका'),
(2924, 'गन्यापधुरा गाउँपालिका', 555, 'गाउँपालिका'),
(2925, 'दशरथचन्द नगरपालिका', 556, 'नगरपालिका'),
(2926, 'पाटन नगरपालिका', 556, 'नगरपालिका'),
(2927, 'मेलौली नगरपालिका', 556, 'नगरपालिका'),
(2928, 'पुर्चौडी नगरपालिका', 556, 'नगरपालिका'),
(2929, 'सुर्नया गाउँपालिका', 556, 'गाउँपालिका'),
(2930, 'सिगास गाउँपालिका', 556, 'गाउँपालिका'),
(2931, 'शिवनाथ गाउँपालिका', 556, 'गाउँपालिका'),
(2932, 'पञ्चेश्वर गाउँपालिका', 556, 'गाउँपालिका'),
(2933, 'दोगडाकेदार गाउँपालिका', 556, 'गाउँपालिका'),
(2934, 'डीलासैनी गाउँपालिका', 556, 'गाउँपालिका'),
(2935, 'महाकाली नगरपालिका', 557, 'नगरपालिका'),
(2936, 'शैल्यशिखर नगरपालिका', 557, 'नगरपालिका'),
(2937, 'मालिकार्जुन गाउँपालिका', 557, 'गाउँपालिका'),
(2938, 'अपिहिमाल गाउँपालिका', 557, 'गाउँपालिका'),
(2939, 'दुहुँ गाउँपालिका', 557, 'गाउँपालिका'),
(2940, 'नौगाड गाउँपालिका', 557, 'गाउँपालिका'),
(2941, 'मार्मा गाउँपालिका', 557, 'गाउँपालिका'),
(2942, 'लेकम गाउँपालिका', 557, 'गाउँपालिका'),
(2943, 'ब्याँस गाउँपालिका', 557, 'गाउँपालिका');

-- --------------------------------------------------------

--
-- Table structure for table `settings_ward`
--

CREATE TABLE `settings_ward` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `address` text NOT NULL,
  `address_eng` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings_ward`
--

INSERT INTO `settings_ward` (`id`, `name`, `address`, `address_eng`) VALUES
(1, '१', 'सुखड', ''),
(2, '2', 'साढेपानी जङ्गपुर', 'Sadepani Jungpur'),
(3, '३', 'निम्दी', 'Nimdi'),
(4, '४', 'सिम्थरी', ''),
(5, '5', 'वनखेत', ''),
(6, '6', 'साढेपानी', ''),
(7, '7', 'निम्दी', ''),
(8, '8', 'दिपनगर', ''),
(9, '9', 'रतिकपुर', ''),
(10, '10', 'पहलमानपुर', ''),
(11, '11', 'आम्वासा', ''),
(12, '12', 'त्रिवेणी बजार', '');

-- --------------------------------------------------------

--
-- Table structure for table `settings_ward_worker`
--

CREATE TABLE `settings_ward_worker` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `ward` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings_ward_worker`
--

INSERT INTO `settings_ward_worker` (`id`, `name`, `ward`, `post_id`) VALUES
(1, 'धिरज', 1, 1),
(2, 'अमुल्य शर्मा', 2, 1),
(3, 'संजय कार्की', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `settings_work`
--

CREATE TABLE `settings_work` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings_work`
--

INSERT INTO `settings_work` (`id`, `name`) VALUES
(1, 'निर्माण सम्बन्धि'),
(2, 'परामर्श सेवा');

-- --------------------------------------------------------

--
-- Table structure for table `settings_worker`
--

CREATE TABLE `settings_worker` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `department_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings_worker`
--

INSERT INTO `settings_worker` (`id`, `name`, `department_id`, `post_id`) VALUES
(1, 'धिरज प्रधान', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sthai_basobas`
--

CREATE TABLE `sthai_basobas` (
  `id` int(11) NOT NULL,
  `form_id` bigint(20) NOT NULL,
  `session_id` int(11) NOT NULL,
  `ward_login` int(11) NOT NULL,
  `status` tinyint(3) NOT NULL,
  `nepali_date` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `applicant_name` text NOT NULL,
  `resident_name` text NOT NULL,
  `citizenship_no` varchar(15) NOT NULL,
  `citizenship_district` int(11) NOT NULL,
  `nepali_citizenship_date` varchar(50) NOT NULL,
  `english_citizenship_date` date NOT NULL,
  `state` int(11) NOT NULL,
  `district` int(11) NOT NULL,
  `local_body` int(11) NOT NULL,
  `ward` int(11) NOT NULL,
  `old_place` int(11) NOT NULL,
  `nepali_permission_date` varchar(50) NOT NULL,
  `english_permission_date` date NOT NULL,
  `tole` text NOT NULL,
  `road` text NOT NULL,
  `ghar_no` int(11) NOT NULL,
  `documents` text NOT NULL,
  `documents_type` varchar(20) NOT NULL,
  `darta_documents` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sthai_basobas`
--

INSERT INTO `sthai_basobas` (`id`, `form_id`, `session_id`, `ward_login`, `status`, `nepali_date`, `date`, `applicant_name`, `resident_name`, `citizenship_no`, `citizenship_district`, `nepali_citizenship_date`, `english_citizenship_date`, `state`, `district`, `local_body`, `ward`, `old_place`, `nepali_permission_date`, `english_permission_date`, `tole`, `road`, `ghar_no`, `documents`, `documents_type`, `darta_documents`, `created_at`, `updated_at`) VALUES
(1, 7912835046, 2, 2, 3, '2076-04-12', '2019-07-28', 'Dhiraj Pradhan', 'Dhiraj Pradhan', '7878964', 482, '2076-04-12', '2019-07-28', 3, 514, 2556, 2, 1, '2076-04-12', '2019-07-28', 'Test Tole', 'Biratnagar-03', 18, '', '', 'Sys32.jpg.jpg', '2019-07-28 02:26:02', '2019-07-28 08:41:39');

-- --------------------------------------------------------

--
-- Table structure for table `suchi_darta`
--

CREATE TABLE `suchi_darta` (
  `id` int(11) NOT NULL,
  `form_id` bigint(20) NOT NULL,
  `session_id` int(11) NOT NULL,
  `maujuda_id` int(11) NOT NULL,
  `is_muncipality` enum('0','1') NOT NULL,
  `darta_no` bigint(20) NOT NULL,
  `patra_chalani_no` int(11) NOT NULL,
  `is_complete` enum('0','1') NOT NULL DEFAULT '0',
  `ward_login` int(11) NOT NULL,
  `department` varchar(10) NOT NULL,
  `link` text NOT NULL,
  `nepali_darta_miti` varchar(50) NOT NULL,
  `english_darta_miti` date NOT NULL,
  `applicant_name` text NOT NULL,
  `letter_subject` text NOT NULL,
  `letter_type` enum('important','most_important','deadlined') NOT NULL,
  `state` int(11) NOT NULL,
  `district` int(11) NOT NULL,
  `local_body` int(11) NOT NULL,
  `ward` int(11) NOT NULL,
  `darta_documents` text NOT NULL,
  `description` text NOT NULL,
  `deadline_nep` varchar(80) NOT NULL,
  `deadline_eng` date NOT NULL,
  `transfer_date_nep` varchar(80) NOT NULL,
  `transfer_date_eng` date NOT NULL,
  `patra_miti_nep` varchar(80) NOT NULL,
  `patra_miti_eng` date NOT NULL,
  `karmachari_name` text NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `suchi_darta`
--

INSERT INTO `suchi_darta` (`id`, `form_id`, `session_id`, `maujuda_id`, `is_muncipality`, `darta_no`, `patra_chalani_no`, `is_complete`, `ward_login`, `department`, `link`, `nepali_darta_miti`, `english_darta_miti`, `applicant_name`, `letter_subject`, `letter_type`, `state`, `district`, `local_body`, `ward`, `darta_documents`, `description`, `deadline_nep`, `deadline_eng`, `transfer_date_nep`, `transfer_date_eng`, `patra_miti_nep`, `patra_miti_eng`, `karmachari_name`, `user_id`) VALUES
(3, 486372591, 2, 4, '1', 1, 0, '0', 0, '1', '', '2076-4-21', '2019-08-06', 'Dhiraj Pradhan', '', 'important', 3, 514, 2556, 1, '', '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', 'asdasd', 1),
(4, 2754903861, 2, 5, '1', 2, 0, '0', 0, '2', '', '2076-4-21', '2019-08-06', 'df', '', 'important', 3, 514, 2556, 1, '', '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', 'asdasd', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tax_clearance`
--

CREATE TABLE `tax_clearance` (
  `id` int(11) NOT NULL,
  `form_id` bigint(20) NOT NULL,
  `session_id` int(11) NOT NULL,
  `ward_login` int(11) NOT NULL,
  `status` tinyint(3) NOT NULL,
  `nepali_date` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `applicant_name` text NOT NULL,
  `plot_no` varchar(15) NOT NULL,
  `property_tax` float NOT NULL,
  `property_ward` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `district` int(11) NOT NULL,
  `local_body` int(11) NOT NULL,
  `ward` int(11) NOT NULL,
  `documents` text NOT NULL,
  `documents_type` varchar(20) NOT NULL,
  `darta_documents` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tax_clearance`
--

INSERT INTO `tax_clearance` (`id`, `form_id`, `session_id`, `ward_login`, `status`, `nepali_date`, `date`, `applicant_name`, `plot_no`, `property_tax`, `property_ward`, `state`, `district`, `local_body`, `ward`, `documents`, `documents_type`, `darta_documents`, `created_at`, `updated_at`) VALUES
(1, 834912765, 2, 2, 3, '2076-04-12', '2019-07-28', 'Dhiraj Pradhan', '21312', 124567, 3, 3, 514, 2556, 2, '', '', 'Screenshot_(1).png.png', '2019-07-28 02:04:11', '2019-07-28 08:19:20');

-- --------------------------------------------------------

--
-- Table structure for table `template_form`
--

CREATE TABLE `template_form` (
  `id` int(11) NOT NULL,
  `applicant_name` text NOT NULL,
  `form_id` bigint(20) NOT NULL,
  `session_id` int(11) NOT NULL,
  `ward_login` int(11) DEFAULT NULL,
  `status` enum('1','2','3') NOT NULL,
  `nepali_date` varchar(80) NOT NULL,
  `date` date NOT NULL,
  `documents` text DEFAULT NULL,
  `darta_documents` text DEFAULT NULL,
  `letter_type` int(11) NOT NULL,
  `letter_subject` text NOT NULL,
  `content` longtext DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `template_form`
--

INSERT INTO `template_form` (`id`, `applicant_name`, `form_id`, `session_id`, `ward_login`, `status`, `nepali_date`, `date`, `documents`, `darta_documents`, `letter_type`, `letter_subject`, `content`, `created_at`, `updated_at`) VALUES
(2, 'Amulya Sharma', 687251394, 2, 1, '1', '2076-04-21', '2019-08-06', 'd9c61a649cab63f99e972d1d69ba695f.png', NULL, 0, '1', '<p>Please open an account in my/our name with under mentioned details texting the text. Amulya Sharma is a Web Developer.</p>\r\n', '2019-08-06 05:50:24', '2019-08-06 05:50:24'),
(3, 'Dhiraj Pradhan', 1879346520, 2, 1, '3', '2076-04-21', '2019-08-06', '7f6b1f8ee9f34af9f90cff53fe8caca5.jpg', '0', 0, '2', '<p>यस बैंकमा मेरो नाममा रहेको तपशिलको खातामा जम्मा रहेको तथा जम्मा हुन आउने सम्पूर्ण रकमहरु मेरो मृत्यु भएको अवस्थामा मेरो शेषपछि मैले इच्छाएको तपसिलमा व्यक्ति / व्यक्तिहरुले पाउने गरि यसै इच्छापत्रद्वारा निज / निजहरुलाई सो खाताको रकम पाउने गरि इच्छाएको व्यक्ति / व्यक्तिहरुका रुपमा मनोनीत गर्दछु |</p>\r\n', '2019-08-06 06:30:06', NULL),
(4, 'asdsda', 2438769510, 2, 2, '3', '2076-04-21', '2019-08-06', NULL, 'Screenshot_(1)1.png', 0, '2', '<p>यस बैंकमा मेरो नाममा रहेको तपशिलको खातामा जम्मा रहेको तथा जम्मा हुन आउने सम्पूर्ण रकमहरु मेरो मृत्यु भएको अवस्थामा मेरो शेषपछि मैले इच्छाएको तपसिलमा व्यक्ति / व्यक्तिहरुले पाउने गरि यसै इच्छापत्रद्वारा निज / निजहरुलाई सो खाताको रकम पाउने गरि इच्छाएको व्यक्ति / व्यक्तिहरुका रुपमा मनोनीत गर्दछु |</p>\r\n', '2019-08-06 10:14:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(30) NOT NULL,
  `email` varchar(125) NOT NULL,
  `ward` int(11) NOT NULL,
  `mode` varchar(15) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `is_muncipality` enum('0','1') NOT NULL,
  `department` int(11) NOT NULL,
  `is_sachib` enum('0','1') NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `address`, `phone`, `email`, `ward`, `mode`, `username`, `password`, `is_muncipality`, `department`, `is_sachib`, `created_at`) VALUES
(1, 'Dhiraj Pradhan', '', '9842134241', 'dpr4dhan@gmail.com', 1, 'superadmin', 'superadmin', '$2y$10$4DyQLJxmqO20q4aoO0wLO.dN2I412670d/s453MT63yy9RIet3j.m', '1', 1, '0', '2019-05-23 11:04:54'),
(14, 'Susmita Adhikari', '', '98', 'susmita@gmail.com', 0, 'administrator', 'darta', '$2y$10$Yp1O259o/3vhr5KIVIi8.ugD9OBwRzShKLOd8iJyGgj.sI0aZcqae', '1', 12, '0', '2019-07-18 11:05:09'),
(15, 'विवेक नेपाल', '', '9851160529', 'ito.gajurimun@gmail.com', 0, 'superadmin', 'gajurimun', '$2y$10$owh9IdolDkUwn2SrYb8.HuCT.UKSRiRDydw0LhP2kTg/FfmArAu9S', '1', 13, '0', '2019-07-18 11:57:13'),
(16, 'उषा अधिकारी', '', '9851160528', 'usha@gmail.com', 1, 'user', 'ward1', '$2y$10$jRK//XP8tY29DaNseViEkebZaBR8cdrx.r6R2tNnuyx.4iEvRTVay', '0', 0, '0', '2019-07-18 12:00:35'),
(17, 'गाेमा तामाङ', 'साढेपानी जङ्गपुर', '9851160529', 'goma@gmail.com', 2, 'user', 'ward2', '$2y$10$2xQe2EfpXtBSSovrFyuGRutQpDQLXhkeZ7UKdmY4MaUqCzKpUUn8W', '0', 0, '0', '2019-07-18 12:01:28'),
(18, 'सरिता चेपाङ', '', '9851160529', 'sarita@gmail.com', 3, 'user', 'ward3', '$2y$10$OoQ8GZRHnh8cEhZ6DqdGwe7i6zfcUBNZomklwlDB5T1wKFFSwKo9O', '0', 0, '0', '2019-07-18 12:02:41'),
(19, 'दिपक घतान', '', '9851160529', 'dipak@gmail.com', 5, 'user', 'ward5', '$2y$10$3U/WmO.8N2kne8Pdn9waLO1.Bal.HUfFgoYP9xvXZksLnSYDl8IUi', '0', 0, '0', '2019-07-21 12:23:45'),
(20, 'उमा बस्नेत', '', '9840060705', 'gajurirmun@gmail.com', 0, 'administrator', 'uma', '$2y$10$I/aVrd5G8Nb5Z5mVLHy0yefGJADMpE0jiAL8AFRAm/S1hS/npnPH6', '1', 3, '0', '2019-07-24 17:13:40'),
(21, 'Sachib', '', '987465', 'asdasd@gmail.com', 0, 'superadmin', 'sachib1', '$2y$10$TDefuihRPjmd.CYXSbhGwekIsPRjZx.5rAcqWt7ofp3xWz/ny1b4O', '1', 0, '1', '2019-08-07 14:05:04'),
(22, 'Dhiraj Pradhan', '', '9842134241', 'dpr4dhan@gmail.com', 0, 'user', 'sachib2', '$2y$10$ilWoJgKRbn6XvyD8Lr.Oiufj8rNw65wNfXiRsEM0rOZP5.QOGSiQK', '1', 0, '1', '2019-08-07 14:05:30'),
(23, 'sachib3', '', '97494', 'sanjayusk786@gmail.com', 0, 'user', 'sachib3', '$2y$10$znjAyjYRuXsn96JvCeLZOOij288FEilkEm9MmNb7tA4w5P6SQbXf.', '1', 0, '1', '2019-08-07 14:10:59'),
(24, 'Dhiraj Pradhan', '', '9842134241', 'dpr4dhan@gmail.com', 0, 'administrator', 'sports', '$2y$10$gDPDt2ayNnVdARe7Ua5cGOdT6ofubnDuReSUVNv2zehvWYE6C/YVW', '1', 2, '0', '2019-08-07 16:22:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abibhahit_pramanpatra`
--
ALTER TABLE `abibhahit_pramanpatra`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `add_classroom`
--
ALTER TABLE `add_classroom`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `antarik_basai_sarai`
--
ALTER TABLE `antarik_basai_sarai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `antarik_basai_sarai_detail`
--
ALTER TABLE `antarik_basai_sarai_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apanga_pramanpatra`
--
ALTER TABLE `apanga_pramanpatra`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `arthik_saheta`
--
ALTER TABLE `arthik_saheta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `asthai_basobas`
--
ALTER TABLE `asthai_basobas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bato_kayam`
--
ALTER TABLE `bato_kayam`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bebasaya_banda`
--
ALTER TABLE `bebasaya_banda`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bebasaya_darta`
--
ALTER TABLE `bebasaya_darta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bebasaya_sifaris`
--
ALTER TABLE `bebasaya_sifaris`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bibaha_pramanit`
--
ALTER TABLE `bibaha_pramanit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bidhut_jadan`
--
ALTER TABLE `bidhut_jadan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chalani`
--
ALTER TABLE `chalani`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `charkilla_details`
--
ALTER TABLE `charkilla_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `char_killa`
--
ALTER TABLE `char_killa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `citizen_certificate`
--
ALTER TABLE `citizen_certificate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `citizen_certificate_pratilipi`
--
ALTER TABLE `citizen_certificate_pratilipi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `court_fee`
--
ALTER TABLE `court_fee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `darta`
--
ALTER TABLE `darta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `farak_nam_thar`
--
ALTER TABLE `farak_nam_thar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ghar_jagga_namsari`
--
ALTER TABLE `ghar_jagga_namsari`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ghar_kayam`
--
ALTER TABLE `ghar_kayam`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ghar_patala`
--
ALTER TABLE `ghar_patala`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hakdar_pramanit`
--
ALTER TABLE `hakdar_pramanit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_recommend`
--
ALTER TABLE `home_recommend`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_road_certify`
--
ALTER TABLE `home_road_certify`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_road_certify_land`
--
ALTER TABLE `home_road_certify_land`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `income_verification`
--
ALTER TABLE `income_verification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `income_verification_detail`
--
ALTER TABLE `income_verification_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `janma_miti_pramanit`
--
ALTER TABLE `janma_miti_pramanit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jet_machine`
--
ALTER TABLE `jet_machine`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `khanepani_jadan`
--
ALTER TABLE `khanepani_jadan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kitta_kat_sifaris`
--
ALTER TABLE `kitta_kat_sifaris`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kotha_khali_suchana`
--
ALTER TABLE `kotha_khali_suchana`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lalpurja_pratilipi`
--
ALTER TABLE `lalpurja_pratilipi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `maujuda_suchi`
--
ALTER TABLE `maujuda_suchi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mirtyu_darta`
--
ALTER TABLE `mirtyu_darta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mohi_lagat`
--
ALTER TABLE `mohi_lagat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nabalak_pramanit`
--
ALTER TABLE `nabalak_pramanit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nata_pramanit`
--
ALTER TABLE `nata_pramanit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nata_pramanit_detail`
--
ALTER TABLE `nata_pramanit_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prabhidik_mulyankan`
--
ALTER TABLE `prabhidik_mulyankan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `print_details`
--
ALTER TABLE `print_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_valuation`
--
ALTER TABLE `property_valuation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_valuation_detail`
--
ALTER TABLE `property_valuation_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sachiwalaya_darta`
--
ALTER TABLE `sachiwalaya_darta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sachiwalaya_darta_details`
--
ALTER TABLE `sachiwalaya_darta_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sadak_khanne_swikriti`
--
ALTER TABLE `sadak_khanne_swikriti`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sanstha_darta`
--
ALTER TABLE `sanstha_darta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sanstha_darta_pramanpatra`
--
ALTER TABLE `sanstha_darta_pramanpatra`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sanstha_nabikaran`
--
ALTER TABLE `sanstha_nabikaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scholarship`
--
ALTER TABLE `scholarship`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scholarship_detail`
--
ALTER TABLE `scholarship_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings_department`
--
ALTER TABLE `settings_department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings_direction`
--
ALTER TABLE `settings_direction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings_disable_type`
--
ALTER TABLE `settings_disable_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings_district`
--
ALTER TABLE `settings_district`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings_document`
--
ALTER TABLE `settings_document`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings_eutype`
--
ALTER TABLE `settings_eutype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings_home_type`
--
ALTER TABLE `settings_home_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings_letter_subject`
--
ALTER TABLE `settings_letter_subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings_local_body`
--
ALTER TABLE `settings_local_body`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings_marriage_types`
--
ALTER TABLE `settings_marriage_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings_office`
--
ALTER TABLE `settings_office`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings_oldnew_address`
--
ALTER TABLE `settings_oldnew_address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings_patra_category`
--
ALTER TABLE `settings_patra_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings_patra_item`
--
ALTER TABLE `settings_patra_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings_post`
--
ALTER TABLE `settings_post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings_relation`
--
ALTER TABLE `settings_relation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings_road_type`
--
ALTER TABLE `settings_road_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings_service`
--
ALTER TABLE `settings_service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings_session`
--
ALTER TABLE `settings_session`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings_state`
--
ALTER TABLE `settings_state`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings_vdc_municipality`
--
ALTER TABLE `settings_vdc_municipality`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings_ward`
--
ALTER TABLE `settings_ward`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings_ward_worker`
--
ALTER TABLE `settings_ward_worker`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings_work`
--
ALTER TABLE `settings_work`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings_worker`
--
ALTER TABLE `settings_worker`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sthai_basobas`
--
ALTER TABLE `sthai_basobas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suchi_darta`
--
ALTER TABLE `suchi_darta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tax_clearance`
--
ALTER TABLE `tax_clearance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_form`
--
ALTER TABLE `template_form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `abibhahit_pramanpatra`
--
ALTER TABLE `abibhahit_pramanpatra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `add_classroom`
--
ALTER TABLE `add_classroom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `antarik_basai_sarai`
--
ALTER TABLE `antarik_basai_sarai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `antarik_basai_sarai_detail`
--
ALTER TABLE `antarik_basai_sarai_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `apanga_pramanpatra`
--
ALTER TABLE `apanga_pramanpatra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `arthik_saheta`
--
ALTER TABLE `arthik_saheta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `asthai_basobas`
--
ALTER TABLE `asthai_basobas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bato_kayam`
--
ALTER TABLE `bato_kayam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bebasaya_banda`
--
ALTER TABLE `bebasaya_banda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bebasaya_darta`
--
ALTER TABLE `bebasaya_darta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bebasaya_sifaris`
--
ALTER TABLE `bebasaya_sifaris`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bibaha_pramanit`
--
ALTER TABLE `bibaha_pramanit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bidhut_jadan`
--
ALTER TABLE `bidhut_jadan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `chalani`
--
ALTER TABLE `chalani`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `charkilla_details`
--
ALTER TABLE `charkilla_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `char_killa`
--
ALTER TABLE `char_killa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `citizen_certificate`
--
ALTER TABLE `citizen_certificate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `citizen_certificate_pratilipi`
--
ALTER TABLE `citizen_certificate_pratilipi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `court_fee`
--
ALTER TABLE `court_fee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `darta`
--
ALTER TABLE `darta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `farak_nam_thar`
--
ALTER TABLE `farak_nam_thar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ghar_jagga_namsari`
--
ALTER TABLE `ghar_jagga_namsari`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ghar_kayam`
--
ALTER TABLE `ghar_kayam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ghar_patala`
--
ALTER TABLE `ghar_patala`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hakdar_pramanit`
--
ALTER TABLE `hakdar_pramanit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `home_recommend`
--
ALTER TABLE `home_recommend`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `home_road_certify`
--
ALTER TABLE `home_road_certify`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `home_road_certify_land`
--
ALTER TABLE `home_road_certify_land`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `income_verification`
--
ALTER TABLE `income_verification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `income_verification_detail`
--
ALTER TABLE `income_verification_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `janma_miti_pramanit`
--
ALTER TABLE `janma_miti_pramanit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jet_machine`
--
ALTER TABLE `jet_machine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `khanepani_jadan`
--
ALTER TABLE `khanepani_jadan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kitta_kat_sifaris`
--
ALTER TABLE `kitta_kat_sifaris`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kotha_khali_suchana`
--
ALTER TABLE `kotha_khali_suchana`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lalpurja_pratilipi`
--
ALTER TABLE `lalpurja_pratilipi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `maujuda_suchi`
--
ALTER TABLE `maujuda_suchi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mirtyu_darta`
--
ALTER TABLE `mirtyu_darta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mohi_lagat`
--
ALTER TABLE `mohi_lagat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `nabalak_pramanit`
--
ALTER TABLE `nabalak_pramanit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nata_pramanit`
--
ALTER TABLE `nata_pramanit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `nata_pramanit_detail`
--
ALTER TABLE `nata_pramanit_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `prabhidik_mulyankan`
--
ALTER TABLE `prabhidik_mulyankan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `print_details`
--
ALTER TABLE `print_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `property_valuation`
--
ALTER TABLE `property_valuation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `property_valuation_detail`
--
ALTER TABLE `property_valuation_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sachiwalaya_darta`
--
ALTER TABLE `sachiwalaya_darta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sachiwalaya_darta_details`
--
ALTER TABLE `sachiwalaya_darta_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sadak_khanne_swikriti`
--
ALTER TABLE `sadak_khanne_swikriti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sanstha_darta`
--
ALTER TABLE `sanstha_darta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sanstha_darta_pramanpatra`
--
ALTER TABLE `sanstha_darta_pramanpatra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sanstha_nabikaran`
--
ALTER TABLE `sanstha_nabikaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `scholarship`
--
ALTER TABLE `scholarship`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `scholarship_detail`
--
ALTER TABLE `scholarship_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `settings_department`
--
ALTER TABLE `settings_department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `settings_direction`
--
ALTER TABLE `settings_direction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `settings_disable_type`
--
ALTER TABLE `settings_disable_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `settings_document`
--
ALTER TABLE `settings_document`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `settings_eutype`
--
ALTER TABLE `settings_eutype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `settings_home_type`
--
ALTER TABLE `settings_home_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `settings_letter_subject`
--
ALTER TABLE `settings_letter_subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `settings_marriage_types`
--
ALTER TABLE `settings_marriage_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `settings_office`
--
ALTER TABLE `settings_office`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `settings_oldnew_address`
--
ALTER TABLE `settings_oldnew_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `settings_patra_category`
--
ALTER TABLE `settings_patra_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `settings_patra_item`
--
ALTER TABLE `settings_patra_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `settings_post`
--
ALTER TABLE `settings_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `settings_relation`
--
ALTER TABLE `settings_relation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `settings_road_type`
--
ALTER TABLE `settings_road_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `settings_service`
--
ALTER TABLE `settings_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `settings_session`
--
ALTER TABLE `settings_session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `settings_state`
--
ALTER TABLE `settings_state`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `settings_ward`
--
ALTER TABLE `settings_ward`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `settings_ward_worker`
--
ALTER TABLE `settings_ward_worker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `settings_work`
--
ALTER TABLE `settings_work`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `settings_worker`
--
ALTER TABLE `settings_worker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sthai_basobas`
--
ALTER TABLE `sthai_basobas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `suchi_darta`
--
ALTER TABLE `suchi_darta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tax_clearance`
--
ALTER TABLE `tax_clearance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `template_form`
--
ALTER TABLE `template_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
