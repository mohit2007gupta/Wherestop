-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2014 at 06:16 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `wherestop`
--

-- --------------------------------------------------------

--
-- Table structure for table `city_state_map`
--

CREATE TABLE IF NOT EXISTS `city_state_map` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stateId` int(11) NOT NULL,
  `cityId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `city_state_map`
--

INSERT INTO `city_state_map` (`id`, `stateId`, `cityId`) VALUES
(1, 16, 17),
(2, 16, 1),
(3, 7, 18),
(4, 19, 20),
(5, 16, 21),
(6, 16, 15),
(7, 7, 22),
(8, 23, 24),
(9, 7, 25),
(10, 26, 18),
(11, 16, 27);

-- --------------------------------------------------------

--
-- Table structure for table `component`
--

CREATE TABLE IF NOT EXISTS `component` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `fronttemplate` varchar(30) NOT NULL DEFAULT 'common',
  `model` varchar(200) NOT NULL,
  `dataDB` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `component`
--

INSERT INTO `component` (`id`, `name`, `slug`, `fronttemplate`, `model`, `dataDB`) VALUES
(1, 'stay', 'stay', 'common', '', 'com_stay'),
(2, 'eat', 'eat', 'common', '', 'com_eat'),
(3, 'shop', 'shop', 'common', '', 'com_shop'),
(4, 'drink', 'drink', 'common', '', 'com_drink');

-- --------------------------------------------------------

--
-- Table structure for table `component_widget`
--

CREATE TABLE IF NOT EXISTS `component_widget` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `component_id` int(11) NOT NULL,
  `widget_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `component_widget`
--

INSERT INTO `component_widget` (`id`, `component_id`, `widget_id`) VALUES
(3, 1, 1),
(6, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `com_bar`
--

CREATE TABLE IF NOT EXISTS `com_bar` (
  `id` int(11) NOT NULL,
  `elementId` int(11) NOT NULL,
  `pint_cost` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `com_bar_drink`
--

CREATE TABLE IF NOT EXISTS `com_bar_drink` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `com_contactinfo`
--

CREATE TABLE IF NOT EXISTS `com_contactinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `elementId` int(11) NOT NULL,
  `addressLine1` int(11) NOT NULL,
  `addressLine2` int(11) NOT NULL,
  `placeId` int(11) NOT NULL,
  `countryId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `com_eat`
--

CREATE TABLE IF NOT EXISTS `com_eat` (
  `id` int(11) NOT NULL,
  `elementId` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `menu` varchar(250) NOT NULL,
  `speciality` text NOT NULL,
  `album` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `com_eat`
--

INSERT INTO `com_eat` (`id`, `elementId`, `type`, `menu`, `speciality`, `album`) VALUES
(0, 1, 9900, 'Menu not uploaded', 'Non veg', 70);

-- --------------------------------------------------------

--
-- Table structure for table `com_eat_cuisine`
--

CREATE TABLE IF NOT EXISTS `com_eat_cuisine` (
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `com_eat_cuisine`
--

INSERT INTO `com_eat_cuisine` (`name`) VALUES
('Non Veg'),
('Chinese');

-- --------------------------------------------------------

--
-- Table structure for table `com_eat_element_cuisine`
--

CREATE TABLE IF NOT EXISTS `com_eat_element_cuisine` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `elementId` int(11) NOT NULL,
  `cuisine` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `com_eat_element_cuisine`
--

INSERT INTO `com_eat_element_cuisine` (`id`, `elementId`, `cuisine`) VALUES
(1, 1, 'Non veg'),
(2, 1, 'Chinese');

-- --------------------------------------------------------

--
-- Table structure for table `com_eat_timing`
--

CREATE TABLE IF NOT EXISTS `com_eat_timing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `elementId` int(11) NOT NULL,
  `day` int(11) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `com_eat_timing`
--

INSERT INTO `com_eat_timing` (`id`, `elementId`, `day`, `start_time`, `end_time`) VALUES
(1, 1, 0, '09:00:00', '18:00:00'),
(2, 1, 6, '11:00:00', '21:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `com_stay`
--

CREATE TABLE IF NOT EXISTS `com_stay` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `elementId` int(11) NOT NULL,
  `rating` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `com_stay`
--

INSERT INTO `com_stay` (`id`, `elementId`, `rating`) VALUES
(1, 1, 3.5);

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iso` char(2) NOT NULL,
  `name` varchar(80) NOT NULL,
  `nicename` varchar(80) NOT NULL,
  `iso3` char(3) DEFAULT NULL,
  `numcode` smallint(6) DEFAULT NULL,
  `phonecode` int(5) NOT NULL,
  `latitude` varchar(20) NOT NULL,
  `longitude` varchar(20) NOT NULL,
  `zoom` int(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=240 ;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`, `latitude`, `longitude`, `zoom`) VALUES
(1, 'AF', 'AFGHANISTAN', 'Afghanistan', 'AFG', 4, 93, '', '', 0),
(2, 'AL', 'ALBANIA', 'Albania', 'ALB', 8, 355, '', '', 0),
(3, 'DZ', 'ALGERIA', 'Algeria', 'DZA', 12, 213, '', '', 0),
(4, 'AS', 'AMERICAN SAMOA', 'American Samoa', 'ASM', 16, 1684, '', '', 0),
(5, 'AD', 'ANDORRA', 'Andorra', 'AND', 20, 376, '', '', 0),
(6, 'AO', 'ANGOLA', 'Angola', 'AGO', 24, 244, '', '', 0),
(7, 'AI', 'ANGUILLA', 'Anguilla', 'AIA', 660, 1264, '', '', 0),
(8, 'AQ', 'ANTARCTICA', 'Antarctica', NULL, NULL, 0, '', '', 0),
(9, 'AG', 'ANTIGUA AND BARBUDA', 'Antigua and Barbuda', 'ATG', 28, 1268, '', '', 0),
(10, 'AR', 'ARGENTINA', 'Argentina', 'ARG', 32, 54, '', '', 0),
(11, 'AM', 'ARMENIA', 'Armenia', 'ARM', 51, 374, '', '', 0),
(12, 'AW', 'ARUBA', 'Aruba', 'ABW', 533, 297, '', '', 0),
(13, 'AU', 'AUSTRALIA', 'Australia', 'AUS', 36, 61, '', '', 0),
(14, 'AT', 'AUSTRIA', 'Austria', 'AUT', 40, 43, '', '', 0),
(15, 'AZ', 'AZERBAIJAN', 'Azerbaijan', 'AZE', 31, 994, '', '', 0),
(16, 'BS', 'BAHAMAS', 'Bahamas', 'BHS', 44, 1242, '', '', 0),
(17, 'BH', 'BAHRAIN', 'Bahrain', 'BHR', 48, 973, '', '', 0),
(18, 'BD', 'BANGLADESH', 'Bangladesh', 'BGD', 50, 880, '', '', 0),
(19, 'BB', 'BARBADOS', 'Barbados', 'BRB', 52, 1246, '', '', 0),
(20, 'BY', 'BELARUS', 'Belarus', 'BLR', 112, 375, '', '', 0),
(21, 'BE', 'BELGIUM', 'Belgium', 'BEL', 56, 32, '', '', 0),
(22, 'BZ', 'BELIZE', 'Belize', 'BLZ', 84, 501, '', '', 0),
(23, 'BJ', 'BENIN', 'Benin', 'BEN', 204, 229, '', '', 0),
(24, 'BM', 'BERMUDA', 'Bermuda', 'BMU', 60, 1441, '', '', 0),
(25, 'BT', 'BHUTAN', 'Bhutan', 'BTN', 64, 975, '', '', 0),
(26, 'BO', 'BOLIVIA', 'Bolivia', 'BOL', 68, 591, '', '', 0),
(27, 'BA', 'BOSNIA AND HERZEGOVINA', 'Bosnia and Herzegovina', 'BIH', 70, 387, '', '', 0),
(28, 'BW', 'BOTSWANA', 'Botswana', 'BWA', 72, 267, '', '', 0),
(29, 'BV', 'BOUVET ISLAND', 'Bouvet Island', NULL, NULL, 0, '', '', 0),
(30, 'BR', 'BRAZIL', 'Brazil', 'BRA', 76, 55, '', '', 0),
(31, 'IO', 'BRITISH INDIAN OCEAN TERRITORY', 'British Indian Ocean Territory', NULL, NULL, 246, '', '', 0),
(32, 'BN', 'BRUNEI DARUSSALAM', 'Brunei Darussalam', 'BRN', 96, 673, '', '', 0),
(33, 'BG', 'BULGARIA', 'Bulgaria', 'BGR', 100, 359, '', '', 0),
(34, 'BF', 'BURKINA FASO', 'Burkina Faso', 'BFA', 854, 226, '', '', 0),
(35, 'BI', 'BURUNDI', 'Burundi', 'BDI', 108, 257, '', '', 0),
(36, 'KH', 'CAMBODIA', 'Cambodia', 'KHM', 116, 855, '', '', 0),
(37, 'CM', 'CAMEROON', 'Cameroon', 'CMR', 120, 237, '', '', 0),
(38, 'CA', 'CANADA', 'Canada', 'CAN', 124, 1, '', '', 0),
(39, 'CV', 'CAPE VERDE', 'Cape Verde', 'CPV', 132, 238, '', '', 0),
(40, 'KY', 'CAYMAN ISLANDS', 'Cayman Islands', 'CYM', 136, 1345, '', '', 0),
(41, 'CF', 'CENTRAL AFRICAN REPUBLIC', 'Central African Republic', 'CAF', 140, 236, '', '', 0),
(42, 'TD', 'CHAD', 'Chad', 'TCD', 148, 235, '', '', 0),
(43, 'CL', 'CHILE', 'Chile', 'CHL', 152, 56, '', '', 0),
(44, 'CN', 'CHINA', 'China', 'CHN', 156, 86, '', '', 0),
(45, 'CX', 'CHRISTMAS ISLAND', 'Christmas Island', NULL, NULL, 61, '', '', 0),
(46, 'CC', 'COCOS (KEELING) ISLANDS', 'Cocos (Keeling) Islands', NULL, NULL, 672, '', '', 0),
(47, 'CO', 'COLOMBIA', 'Colombia', 'COL', 170, 57, '', '', 0),
(48, 'KM', 'COMOROS', 'Comoros', 'COM', 174, 269, '', '', 0),
(49, 'CG', 'CONGO', 'Congo', 'COG', 178, 242, '', '', 0),
(50, 'CD', 'CONGO, THE DEMOCRATIC REPUBLIC OF THE', 'Congo, the Democratic Republic of the', 'COD', 180, 242, '', '', 0),
(51, 'CK', 'COOK ISLANDS', 'Cook Islands', 'COK', 184, 682, '', '', 0),
(52, 'CR', 'COSTA RICA', 'Costa Rica', 'CRI', 188, 506, '', '', 0),
(53, 'CI', 'COTE D''IVOIRE', 'Cote D''Ivoire', 'CIV', 384, 225, '', '', 0),
(54, 'HR', 'CROATIA', 'Croatia', 'HRV', 191, 385, '', '', 0),
(55, 'CU', 'CUBA', 'Cuba', 'CUB', 192, 53, '', '', 0),
(56, 'CY', 'CYPRUS', 'Cyprus', 'CYP', 196, 357, '', '', 0),
(57, 'CZ', 'CZECH REPUBLIC', 'Czech Republic', 'CZE', 203, 420, '', '', 0),
(58, 'DK', 'DENMARK', 'Denmark', 'DNK', 208, 45, '', '', 0),
(59, 'DJ', 'DJIBOUTI', 'Djibouti', 'DJI', 262, 253, '', '', 0),
(60, 'DM', 'DOMINICA', 'Dominica', 'DMA', 212, 1767, '', '', 0),
(61, 'DO', 'DOMINICAN REPUBLIC', 'Dominican Republic', 'DOM', 214, 1809, '', '', 0),
(62, 'EC', 'ECUADOR', 'Ecuador', 'ECU', 218, 593, '', '', 0),
(63, 'EG', 'EGYPT', 'Egypt', 'EGY', 818, 20, '', '', 0),
(64, 'SV', 'EL SALVADOR', 'El Salvador', 'SLV', 222, 503, '', '', 0),
(65, 'GQ', 'EQUATORIAL GUINEA', 'Equatorial Guinea', 'GNQ', 226, 240, '', '', 0),
(66, 'ER', 'ERITREA', 'Eritrea', 'ERI', 232, 291, '', '', 0),
(67, 'EE', 'ESTONIA', 'Estonia', 'EST', 233, 372, '', '', 0),
(68, 'ET', 'ETHIOPIA', 'Ethiopia', 'ETH', 231, 251, '', '', 0),
(69, 'FK', 'FALKLAND ISLANDS (MALVINAS)', 'Falkland Islands (Malvinas)', 'FLK', 238, 500, '', '', 0),
(70, 'FO', 'FAROE ISLANDS', 'Faroe Islands', 'FRO', 234, 298, '', '', 0),
(71, 'FJ', 'FIJI', 'Fiji', 'FJI', 242, 679, '', '', 0),
(72, 'FI', 'FINLAND', 'Finland', 'FIN', 246, 358, '', '', 0),
(73, 'FR', 'FRANCE', 'France', 'FRA', 250, 33, '', '', 0),
(74, 'GF', 'FRENCH GUIANA', 'French Guiana', 'GUF', 254, 594, '', '', 0),
(75, 'PF', 'FRENCH POLYNESIA', 'French Polynesia', 'PYF', 258, 689, '', '', 0),
(76, 'TF', 'FRENCH SOUTHERN TERRITORIES', 'French Southern Territories', NULL, NULL, 0, '', '', 0),
(77, 'GA', 'GABON', 'Gabon', 'GAB', 266, 241, '', '', 0),
(78, 'GM', 'GAMBIA', 'Gambia', 'GMB', 270, 220, '', '', 0),
(79, 'GE', 'GEORGIA', 'Georgia', 'GEO', 268, 995, '', '', 0),
(80, 'DE', 'GERMANY', 'Germany', 'DEU', 276, 49, '', '', 0),
(81, 'GH', 'GHANA', 'Ghana', 'GHA', 288, 233, '', '', 0),
(82, 'GI', 'GIBRALTAR', 'Gibraltar', 'GIB', 292, 350, '', '', 0),
(83, 'GR', 'GREECE', 'Greece', 'GRC', 300, 30, '', '', 0),
(84, 'GL', 'GREENLAND', 'Greenland', 'GRL', 304, 299, '', '', 0),
(85, 'GD', 'GRENADA', 'Grenada', 'GRD', 308, 1473, '', '', 0),
(86, 'GP', 'GUADELOUPE', 'Guadeloupe', 'GLP', 312, 590, '', '', 0),
(87, 'GU', 'GUAM', 'Guam', 'GUM', 316, 1671, '', '', 0),
(88, 'GT', 'GUATEMALA', 'Guatemala', 'GTM', 320, 502, '', '', 0),
(89, 'GN', 'GUINEA', 'Guinea', 'GIN', 324, 224, '', '', 0),
(90, 'GW', 'GUINEA-BISSAU', 'Guinea-Bissau', 'GNB', 624, 245, '', '', 0),
(91, 'GY', 'GUYANA', 'Guyana', 'GUY', 328, 592, '', '', 0),
(92, 'HT', 'HAITI', 'Haiti', 'HTI', 332, 509, '', '', 0),
(93, 'HM', 'HEARD ISLAND AND MCDONALD ISLANDS', 'Heard Island and Mcdonald Islands', NULL, NULL, 0, '', '', 0),
(94, 'VA', 'HOLY SEE (VATICAN CITY STATE)', 'Holy See (Vatican City State)', 'VAT', 336, 39, '', '', 0),
(95, 'HN', 'HONDURAS', 'Honduras', 'HND', 340, 504, '', '', 0),
(96, 'HK', 'HONG KONG', 'Hong Kong', 'HKG', 344, 852, '', '', 0),
(97, 'HU', 'HUNGARY', 'Hungary', 'HUN', 348, 36, '', '', 0),
(98, 'IS', 'ICELAND', 'Iceland', 'ISL', 352, 354, '', '', 0),
(99, 'IN', 'INDIA', 'India', 'IND', 356, 91, '23.721002677385624', '79.87013925781254', 4),
(100, 'ID', 'INDONESIA', 'Indonesia', 'IDN', 360, 62, '', '', 0),
(101, 'IR', 'IRAN, ISLAMIC REPUBLIC OF', 'Iran, Islamic Republic of', 'IRN', 364, 98, '', '', 0),
(102, 'IQ', 'IRAQ', 'Iraq', 'IRQ', 368, 964, '', '', 0),
(103, 'IE', 'IRELAND', 'Ireland', 'IRL', 372, 353, '', '', 0),
(104, 'IL', 'ISRAEL', 'Israel', 'ISR', 376, 972, '', '', 0),
(105, 'IT', 'ITALY', 'Italy', 'ITA', 380, 39, '43.097785400270986', '12.007590429687983', 5),
(106, 'JM', 'JAMAICA', 'Jamaica', 'JAM', 388, 1876, '', '', 0),
(107, 'JP', 'JAPAN', 'Japan', 'JPN', 392, 81, '', '', 0),
(108, 'JO', 'JORDAN', 'Jordan', 'JOR', 400, 962, '', '', 0),
(109, 'KZ', 'KAZAKHSTAN', 'Kazakhstan', 'KAZ', 398, 7, '', '', 0),
(110, 'KE', 'KENYA', 'Kenya', 'KEN', 404, 254, '', '', 0),
(111, 'KI', 'KIRIBATI', 'Kiribati', 'KIR', 296, 686, '', '', 0),
(112, 'KP', 'KOREA, DEMOCRATIC PEOPLE''S REPUBLIC OF', 'Korea, Democratic People''s Republic of', 'PRK', 408, 850, '', '', 0),
(113, 'KR', 'KOREA, REPUBLIC OF', 'Korea, Republic of', 'KOR', 410, 82, '', '', 0),
(114, 'KW', 'KUWAIT', 'Kuwait', 'KWT', 414, 965, '', '', 0),
(115, 'KG', 'KYRGYZSTAN', 'Kyrgyzstan', 'KGZ', 417, 996, '', '', 0),
(116, 'LA', 'LAO PEOPLE''S DEMOCRATIC REPUBLIC', 'Lao People''s Democratic Republic', 'LAO', 418, 856, '', '', 0),
(117, 'LV', 'LATVIA', 'Latvia', 'LVA', 428, 371, '', '', 0),
(118, 'LB', 'LEBANON', 'Lebanon', 'LBN', 422, 961, '', '', 0),
(119, 'LS', 'LESOTHO', 'Lesotho', 'LSO', 426, 266, '', '', 0),
(120, 'LR', 'LIBERIA', 'Liberia', 'LBR', 430, 231, '', '', 0),
(121, 'LY', 'LIBYAN ARAB JAMAHIRIYA', 'Libyan Arab Jamahiriya', 'LBY', 434, 218, '', '', 0),
(122, 'LI', 'LIECHTENSTEIN', 'Liechtenstein', 'LIE', 438, 423, '', '', 0),
(123, 'LT', 'LITHUANIA', 'Lithuania', 'LTU', 440, 370, '', '', 0),
(124, 'LU', 'LUXEMBOURG', 'Luxembourg', 'LUX', 442, 352, '', '', 0),
(125, 'MO', 'MACAO', 'Macao', 'MAC', 446, 853, '', '', 0),
(126, 'MK', 'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF', 'Macedonia, the Former Yugoslav Republic of', 'MKD', 807, 389, '', '', 0),
(127, 'MG', 'MADAGASCAR', 'Madagascar', 'MDG', 450, 261, '', '', 0),
(128, 'MW', 'MALAWI', 'Malawi', 'MWI', 454, 265, '', '', 0),
(129, 'MY', 'MALAYSIA', 'Malaysia', 'MYS', 458, 60, '', '', 0),
(130, 'MV', 'MALDIVES', 'Maldives', 'MDV', 462, 960, '', '', 0),
(131, 'ML', 'MALI', 'Mali', 'MLI', 466, 223, '', '', 0),
(132, 'MT', 'MALTA', 'Malta', 'MLT', 470, 356, '', '', 0),
(133, 'MH', 'MARSHALL ISLANDS', 'Marshall Islands', 'MHL', 584, 692, '', '', 0),
(134, 'MQ', 'MARTINIQUE', 'Martinique', 'MTQ', 474, 596, '', '', 0),
(135, 'MR', 'MAURITANIA', 'Mauritania', 'MRT', 478, 222, '', '', 0),
(136, 'MU', 'MAURITIUS', 'Mauritius', 'MUS', 480, 230, '', '', 0),
(137, 'YT', 'MAYOTTE', 'Mayotte', NULL, NULL, 269, '', '', 0),
(138, 'MX', 'MEXICO', 'Mexico', 'MEX', 484, 52, '', '', 0),
(139, 'FM', 'MICRONESIA, FEDERATED STATES OF', 'Micronesia, Federated States of', 'FSM', 583, 691, '', '', 0),
(140, 'MD', 'MOLDOVA, REPUBLIC OF', 'Moldova, Republic of', 'MDA', 498, 373, '', '', 0),
(141, 'MC', 'MONACO', 'Monaco', 'MCO', 492, 377, '', '', 0),
(142, 'MN', 'MONGOLIA', 'Mongolia', 'MNG', 496, 976, '', '', 0),
(143, 'MS', 'MONTSERRAT', 'Montserrat', 'MSR', 500, 1664, '', '', 0),
(144, 'MA', 'MOROCCO', 'Morocco', 'MAR', 504, 212, '', '', 0),
(145, 'MZ', 'MOZAMBIQUE', 'Mozambique', 'MOZ', 508, 258, '', '', 0),
(146, 'MM', 'MYANMAR', 'Myanmar', 'MMR', 104, 95, '', '', 0),
(147, 'NA', 'NAMIBIA', 'Namibia', 'NAM', 516, 264, '', '', 0),
(148, 'NR', 'NAURU', 'Nauru', 'NRU', 520, 674, '', '', 0),
(149, 'NP', 'NEPAL', 'Nepal', 'NPL', 524, 977, '27.562839421921183', '84.16579355468798', 6),
(150, 'NL', 'NETHERLANDS', 'Netherlands', 'NLD', 528, 31, '', '', 0),
(151, 'AN', 'NETHERLANDS ANTILLES', 'Netherlands Antilles', 'ANT', 530, 599, '', '', 0),
(152, 'NC', 'NEW CALEDONIA', 'New Caledonia', 'NCL', 540, 687, '', '', 0),
(153, 'NZ', 'NEW ZEALAND', 'New Zealand', 'NZL', 554, 64, '', '', 0),
(154, 'NI', 'NICARAGUA', 'Nicaragua', 'NIC', 558, 505, '', '', 0),
(155, 'NE', 'NIGER', 'Niger', 'NER', 562, 227, '', '', 0),
(156, 'NG', 'NIGERIA', 'Nigeria', 'NGA', 566, 234, '', '', 0),
(157, 'NU', 'NIUE', 'Niue', 'NIU', 570, 683, '', '', 0),
(158, 'NF', 'NORFOLK ISLAND', 'Norfolk Island', 'NFK', 574, 672, '', '', 0),
(159, 'MP', 'NORTHERN MARIANA ISLANDS', 'Northern Mariana Islands', 'MNP', 580, 1670, '', '', 0),
(160, 'NO', 'NORWAY', 'Norway', 'NOR', 578, 47, '', '', 0),
(161, 'OM', 'OMAN', 'Oman', 'OMN', 512, 968, '', '', 0),
(162, 'PK', 'PAKISTAN', 'Pakistan', 'PAK', 586, 92, '', '', 0),
(163, 'PW', 'PALAU', 'Palau', 'PLW', 585, 680, '', '', 0),
(164, 'PS', 'PALESTINIAN TERRITORY, OCCUPIED', 'Palestinian Territory, Occupied', NULL, NULL, 970, '', '', 0),
(165, 'PA', 'PANAMA', 'Panama', 'PAN', 591, 507, '', '', 0),
(166, 'PG', 'PAPUA NEW GUINEA', 'Papua New Guinea', 'PNG', 598, 675, '', '', 0),
(167, 'PY', 'PARAGUAY', 'Paraguay', 'PRY', 600, 595, '', '', 0),
(168, 'PE', 'PERU', 'Peru', 'PER', 604, 51, '', '', 0),
(169, 'PH', 'PHILIPPINES', 'Philippines', 'PHL', 608, 63, '', '', 0),
(170, 'PN', 'PITCAIRN', 'Pitcairn', 'PCN', 612, 0, '', '', 0),
(171, 'PL', 'POLAND', 'Poland', 'POL', 616, 48, '', '', 0),
(172, 'PT', 'PORTUGAL', 'Portugal', 'PRT', 620, 351, '', '', 0),
(173, 'PR', 'PUERTO RICO', 'Puerto Rico', 'PRI', 630, 1787, '', '', 0),
(174, 'QA', 'QATAR', 'Qatar', 'QAT', 634, 974, '', '', 0),
(175, 'RE', 'REUNION', 'Reunion', 'REU', 638, 262, '', '', 0),
(176, 'RO', 'ROMANIA', 'Romania', 'ROM', 642, 40, '', '', 0),
(177, 'RU', 'RUSSIAN FEDERATION', 'Russian Federation', 'RUS', 643, 70, '', '', 0),
(178, 'RW', 'RWANDA', 'Rwanda', 'RWA', 646, 250, '', '', 0),
(179, 'SH', 'SAINT HELENA', 'Saint Helena', 'SHN', 654, 290, '', '', 0),
(180, 'KN', 'SAINT KITTS AND NEVIS', 'Saint Kitts and Nevis', 'KNA', 659, 1869, '', '', 0),
(181, 'LC', 'SAINT LUCIA', 'Saint Lucia', 'LCA', 662, 1758, '', '', 0),
(182, 'PM', 'SAINT PIERRE AND MIQUELON', 'Saint Pierre and Miquelon', 'SPM', 666, 508, '', '', 0),
(183, 'VC', 'SAINT VINCENT AND THE GRENADINES', 'Saint Vincent and the Grenadines', 'VCT', 670, 1784, '', '', 0),
(184, 'WS', 'SAMOA', 'Samoa', 'WSM', 882, 684, '', '', 0),
(185, 'SM', 'SAN MARINO', 'San Marino', 'SMR', 674, 378, '', '', 0),
(186, 'ST', 'SAO TOME AND PRINCIPE', 'Sao Tome and Principe', 'STP', 678, 239, '', '', 0),
(187, 'SA', 'SAUDI ARABIA', 'Saudi Arabia', 'SAU', 682, 966, '', '', 0),
(188, 'SN', 'SENEGAL', 'Senegal', 'SEN', 686, 221, '', '', 0),
(189, 'CS', 'SERBIA AND MONTENEGRO', 'Serbia and Montenegro', NULL, NULL, 381, '', '', 0),
(190, 'SC', 'SEYCHELLES', 'Seychelles', 'SYC', 690, 248, '', '', 0),
(191, 'SL', 'SIERRA LEONE', 'Sierra Leone', 'SLE', 694, 232, '', '', 0),
(192, 'SG', 'SINGAPORE', 'Singapore', 'SGP', 702, 65, '', '', 0),
(193, 'SK', 'SLOVAKIA', 'Slovakia', 'SVK', 703, 421, '', '', 0),
(194, 'SI', 'SLOVENIA', 'Slovenia', 'SVN', 705, 386, '', '', 0),
(195, 'SB', 'SOLOMON ISLANDS', 'Solomon Islands', 'SLB', 90, 677, '', '', 0),
(196, 'SO', 'SOMALIA', 'Somalia', 'SOM', 706, 252, '', '', 0),
(197, 'ZA', 'SOUTH AFRICA', 'South Africa', 'ZAF', 710, 27, '', '', 0),
(198, 'GS', 'SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS', 'South Georgia and the South Sandwich Islands', NULL, NULL, 0, '', '', 0),
(199, 'ES', 'SPAIN', 'Spain', 'ESP', 724, 34, '', '', 0),
(200, 'LK', 'SRI LANKA', 'Sri Lanka', 'LKA', 144, 94, '', '', 0),
(201, 'SD', 'SUDAN', 'Sudan', 'SDN', 736, 249, '', '', 0),
(202, 'SR', 'SURINAME', 'Suriname', 'SUR', 740, 597, '', '', 0),
(203, 'SJ', 'SVALBARD AND JAN MAYEN', 'Svalbard and Jan Mayen', 'SJM', 744, 47, '', '', 0),
(204, 'SZ', 'SWAZILAND', 'Swaziland', 'SWZ', 748, 268, '', '', 0),
(205, 'SE', 'SWEDEN', 'Sweden', 'SWE', 752, 46, '', '', 0),
(206, 'CH', 'SWITZERLAND', 'Switzerland', 'CHE', 756, 41, '', '', 0),
(207, 'SY', 'SYRIAN ARAB REPUBLIC', 'Syrian Arab Republic', 'SYR', 760, 963, '', '', 0),
(208, 'TW', 'TAIWAN, PROVINCE OF CHINA', 'Taiwan, Province of China', 'TWN', 158, 886, '', '', 0),
(209, 'TJ', 'TAJIKISTAN', 'Tajikistan', 'TJK', 762, 992, '', '', 0),
(210, 'TZ', 'TANZANIA, UNITED REPUBLIC OF', 'Tanzania, United Republic of', 'TZA', 834, 255, '', '', 0),
(211, 'TH', 'THAILAND', 'Thailand', 'THA', 764, 66, '', '', 0),
(212, 'TL', 'TIMOR-LESTE', 'Timor-Leste', NULL, NULL, 670, '', '', 0),
(213, 'TG', 'TOGO', 'Togo', 'TGO', 768, 228, '', '', 0),
(214, 'TK', 'TOKELAU', 'Tokelau', 'TKL', 772, 690, '', '', 0),
(215, 'TO', 'TONGA', 'Tonga', 'TON', 776, 676, '', '', 0),
(216, 'TT', 'TRINIDAD AND TOBAGO', 'Trinidad and Tobago', 'TTO', 780, 1868, '', '', 0),
(217, 'TN', 'TUNISIA', 'Tunisia', 'TUN', 788, 216, '', '', 0),
(218, 'TR', 'TURKEY', 'Turkey', 'TUR', 792, 90, '', '', 0),
(219, 'TM', 'TURKMENISTAN', 'Turkmenistan', 'TKM', 795, 7370, '', '', 0),
(220, 'TC', 'TURKS AND CAICOS ISLANDS', 'Turks and Caicos Islands', 'TCA', 796, 1649, '', '', 0),
(221, 'TV', 'TUVALU', 'Tuvalu', 'TUV', 798, 688, '', '', 0),
(222, 'UG', 'UGANDA', 'Uganda', 'UGA', 800, 256, '', '', 0),
(223, 'UA', 'UKRAINE', 'Ukraine', 'UKR', 804, 380, '', '', 0),
(224, 'AE', 'UNITED ARAB EMIRATES', 'United Arab Emirates', 'ARE', 784, 971, '', '', 0),
(225, 'GB', 'UNITED KINGDOM', 'United Kingdom', 'GBR', 826, 44, '', '', 0),
(226, 'US', 'UNITED STATES', 'United States', 'USA', 840, 1, '38.30374421705212', '-95.175026757812', 3),
(227, 'UM', 'UNITED STATES MINOR OUTLYING ISLANDS', 'United States Minor Outlying Islands', NULL, NULL, 1, '', '', 0),
(228, 'UY', 'URUGUAY', 'Uruguay', 'URY', 858, 598, '', '', 0),
(229, 'UZ', 'UZBEKISTAN', 'Uzbekistan', 'UZB', 860, 998, '', '', 0),
(230, 'VU', 'VANUATU', 'Vanuatu', 'VUT', 548, 678, '', '', 0),
(231, 'VE', 'VENEZUELA', 'Venezuela', 'VEN', 862, 58, '', '', 0),
(232, 'VN', 'VIET NAM', 'Viet Nam', 'VNM', 704, 84, '', '', 0),
(233, 'VG', 'VIRGIN ISLANDS, BRITISH', 'Virgin Islands, British', 'VGB', 92, 1284, '', '', 0),
(234, 'VI', 'VIRGIN ISLANDS, U.S.', 'Virgin Islands, U.s.', 'VIR', 850, 1340, '', '', 0),
(235, 'WF', 'WALLIS AND FUTUNA', 'Wallis and Futuna', 'WLF', 876, 681, '', '', 0),
(236, 'EH', 'WESTERN SAHARA', 'Western Sahara', 'ESH', 732, 212, '', '', 0),
(237, 'YE', 'YEMEN', 'Yemen', 'YEM', 887, 967, '', '', 0),
(238, 'ZM', 'ZAMBIA', 'Zambia', 'ZMB', 894, 260, '', '', 0),
(239, 'ZW', 'ZIMBABWE', 'Zimbabwe', 'ZWE', 716, 263, '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `element`
--

CREATE TABLE IF NOT EXISTS `element` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `address` varchar(200) NOT NULL,
  `place` varchar(150) NOT NULL,
  `placeId` int(10) NOT NULL,
  `countryId` int(11) NOT NULL,
  `placeJson` text NOT NULL,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL,
  `zoom` int(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `element`
--

INSERT INTO `element` (`id`, `title`, `slug`, `description`, `address`, `place`, `placeId`, `countryId`, `placeJson`, `latitude`, `longitude`, `zoom`) VALUES
(1, 'Khan Chacha', 'khan-chacha', '', '', 'Khan Market, Rabindra Nagar, New Delhi, Delhi 110003, India', 18, 99, '{"address_components":[{"long_name":"Khan Market","short_name":"Khan Market","types":["sublocality","political"]},{"long_name":"Rabindra Nagar","short_name":"Rabindra Nagar","types":["sublocality","political"]},{"long_name":"New Delhi","short_name":"New Delhi","types":["locality","political"]},{"long_name":"New Delhi","short_name":"New Delhi","types":["administrative_area_level_2","political"]},{"long_name":"Delhi","short_name":"DL","types":["administrative_area_level_1","political"]},{"long_name":"India","short_name":"IN","types":["country","political"]},{"long_name":"110003","short_name":"110003","types":["postal_code"]}],"adr_address":"<span class=\\"extended-address\\">Khan Market, Rabindra Nagar<\\/span>, <span class=\\"locality\\">New Delhi<\\/span>, <span class=\\"region\\">Delhi<\\/span> <span class=\\"postal-code\\">110003<\\/span>, <span class=\\"country-name\\">India<\\/span>","formatted_address":"Khan Market, Rabindra Nagar, New Delhi, Delhi 110003, India","geometry":{"location":{"k":28.6002778,"A":77.2268056},"viewport":{"Ba":{"k":28.59917,"j":28.601702},"ra":{"j":77.2242069,"k":77.2282981}}},"icon":"http:\\/\\/maps.gstatic.com\\/mapfiles\\/place_api\\/icons\\/geocode-71.png","id":"ad38b7e62d0f508f30c884200a7729659d82a199","name":"Khan Market","reference":"CqQBnwAAAKgt23RM1lNdfSmDU-Ipc94ZepYpg6DpMGE2pVa4pHG6xzSEQdZHhwg6OfLJPQ9CRDx05rO9twVzBlNjYENB6qFLa6U1s9byot_wXkplfe_GpNbpOzAqIGoHavSkotQZWHnTcK9qJKzeWO5SFdUUvgyAJdnp9L-94AeBn6qh6tFRz7gIfK4n_Wmxk-5vJp4W6tzY8wVtsByaF2mi9x98CMoSEHgh04x-lOp4w5thb8tBYE4aFM1dSPq179lTxV4mWm6y5d3ad8xu","types":["sublocality","political"],"url":"https:\\/\\/maps.google.com\\/maps\\/place?q=Khan+Market,+Rabindra+Nagar,+New+Delhi,+Delhi+110003,+India&ftid=0x390ce2c289887b17:0x17e087ce57578460","vicinity":"Khan Market","html_attributions":[]}', 28.6003, 77.2268, 0),
(2, 'Taj Mahaj', 'taj-mahaj', 'hello', 'Near Agra fort', 'Agra, Uttar Pradesh, India', 15, 99, '{"address_components":[{"long_name":"Agra","short_name":"Agra","types":["locality","political"]},{"long_name":"Agra","short_name":"Agra","types":["administrative_area_level_2","political"]},{"long_name":"Uttar Pradesh","short_name":"UP","types":["administrative_area_level_1","political"]},{"long_name":"India","short_name":"IN","types":["country","political"]}],"adr_address":"<span class=\\"locality\\">Agra<\\/span>, <span class=\\"region\\">Uttar Pradesh<\\/span>, <span class=\\"country-name\\">India<\\/span>","formatted_address":"Agra, Uttar Pradesh, India","geometry":{"location":{"k":27.1766701,"A":78.0080745},"viewport":{"Ba":{"k":27.0978719,"j":27.2544771},"ra":{"j":77.8779602,"k":78.0820657}}},"icon":"http:\\/\\/maps.gstatic.com\\/mapfiles\\/place_api\\/icons\\/geocode-71.png","id":"595255bec56b96cddc3e50c0249c8e37e9af3d3e","name":"Agra","reference":"CoQBfQAAANKYtqck_F4Q1aWeB_pJUw72-OXLpM1khz2VMalN2p_FID4fFDvDaEo09xUmjpo0yKOHlx5C6iIc6ysjuDrMmEPPY-ujXTivppiKG2gq4wwSxSpTUtdZQnz_BUO-W_c6M4bxCzvjPJysd_K_pDrw056i6RRteetY0LRWz5pCK8IKEhBvzPaFfkkVdQRg8ZnzkwlPGhQcYzLuRVhqSi_q4MX7WENCw1GD1w","types":["locality","political"],"url":"https:\\/\\/maps.google.com\\/maps\\/place?q=Agra,+Uttar+Pradesh,+India&ftid=0x39740d857c2f41d9:0x784aef38a9523b42","vicinity":"Agra","html_attributions":[]}', 27.1767, 78.0081, 0),
(3, 'JHV Mall', 'jhv-mall', '', '', 'Varanasi Cantt, Varanasi, Uttar Pradesh, India', 1, 99, '{"address_components":[{"long_name":"Varanasi Cantt","short_name":"Varanasi Cantt","types":["sublocality","political"]},{"long_name":"Varanasi","short_name":"Varanasi","types":["locality","political"]},{"long_name":"Varanasi","short_name":"Varanasi","types":["administrative_area_level_2","political"]},{"long_name":"Uttar Pradesh","short_name":"UP","types":["administrative_area_level_1","political"]},{"long_name":"India","short_name":"IN","types":["country","political"]}],"adr_address":"<span class=\\"extended-address\\">Varanasi Cantt<\\/span>, <span class=\\"locality\\">Varanasi<\\/span>, <span class=\\"region\\">Uttar Pradesh<\\/span>, <span class=\\"country-name\\">India<\\/span>","formatted_address":"Varanasi Cantt, Varanasi, Uttar Pradesh, India","geometry":{"location":{"k":25.3323527,"A":82.9689738},"viewport":{"Ba":{"k":25.3179931,"j":25.342434},"ra":{"j":82.9536859,"k":82.986292}}},"icon":"http:\\/\\/maps.gstatic.com\\/mapfiles\\/place_api\\/icons\\/geocode-71.png","id":"36a04794407088afd1702decc68b6d9224fad340","name":"Varanasi Cantt","reference":"CqQBkgAAACGWPSs3b5I95bQRZXAKhRWTOuYfKgXJuoqEJva6EVuK3ApQDTdCEtDmmunrArcgQsQyjR7CFCsfkmE4GcdRjUmO8_VAaa47ImCUOp8MCq7oi-OyAtVeEU3Hn_AR4upJp-NuVdS9j_M5rfuprH1fqMK0ILJ-FitD8RXYR4OPX5MUm17KFDemQQXtyE3VowJ91cMN9ELIkcJc3Q1bZbQ1RKESEBea-KolsULoHRTioCJfLg0aFBuKZt4DxDp2PrZRnDcQv6Ya0FYS","types":["sublocality","political"],"url":"https:\\/\\/maps.google.com\\/maps\\/place?q=Varanasi+Cantt,+Varanasi,+Uttar+Pradesh,+India&ftid=0x398e2dbfc355d889:0xaa55a9ef2b061b79","vicinity":"Varanasi Cantt","html_attributions":[]}', 25.3324, 82.969, 0),
(8, 'Red Fort', 'red-fort', '', '', 'Chandni Chowk, New Delhi, Delhi, India', 22, 99, '{"address_components":[{"long_name":"Chandni Chowk","short_name":"Chandni Chowk","types":["sublocality","political"]},{"long_name":"New Delhi","short_name":"New Delhi","types":["locality","political"]},{"long_name":"North Delhi","short_name":"North Delhi","types":["administrative_area_level_2","political"]},{"long_name":"Delhi","short_name":"DL","types":["administrative_area_level_1","political"]},{"long_name":"India","short_name":"IN","types":["country","political"]}],"adr_address":"<span class=\\"extended-address\\">Chandni Chowk<\\/span>, <span class=\\"locality\\">New Delhi<\\/span>, <span class=\\"region\\">Delhi<\\/span>, <span class=\\"country-name\\">India<\\/span>","formatted_address":"Chandni Chowk, New Delhi, Delhi, India","geometry":{"location":{"k":28.6505535,"A":77.2318934},"viewport":{"Ba":{"k":28.6399641,"j":28.6627981},"ra":{"j":77.218266,"k":77.24507}}},"icon":"http:\\/\\/maps.gstatic.com\\/mapfiles\\/place_api\\/icons\\/geocode-71.png","id":"4fec48334e63ba5ee025baae21ec9540210c4a6b","name":"Chandni Chowk","reference":"CpQBigAAADsZ4EiFscrCf8i7GuDnvAtcfatcatE7Uq7llEtLOOCqR2nBM2pwOm2yM10Be1EVgmyHcE9dQlMas53nGfcRCF_RUvCtY9ecNNFKgKeqn8-UHUsopa1nwaTcjBo6r_OqqHfJxP1i9OKCeqEY3x26GRmXU4IACryypXDKnvQPwJfY-Lgp9F8pNMjaL7vSLWG_phIQsNbTyEawVyu7B48yG4jeVRoUsl3jYQX97Nk3q-PPcEmXLhAZs9o","types":["sublocality","political"],"url":"https:\\/\\/maps.google.com\\/maps\\/place?q=Chandni+Chowk,+New+Delhi,+Delhi,+India&ftid=0x390cfd1a88dcc559:0x24fa43c081dbe51","vicinity":"Chandni Chowk","html_attributions":[]}', 28.6506, 77.2319, 0),
(9, 'Gandhi maidan', 'gandhi-maidan', '', '', 'Patna, Bihar, India', 24, 99, '{"address_components":[{"long_name":"Patna","short_name":"Patna","types":["locality","political"]},{"long_name":"Patna","short_name":"Patna","types":["administrative_area_level_2","political"]},{"long_name":"Bihar","short_name":"BR","types":["administrative_area_level_1","political"]},{"long_name":"India","short_name":"IN","types":["country","political"]}],"adr_address":"<span class=\\"locality\\">Patna<\\/span>, <span class=\\"region\\">Bihar<\\/span>, <span class=\\"country-name\\">India<\\/span>","formatted_address":"Patna, Bihar, India","geometry":{"location":{"k":25.6125,"A":85.1283333},"viewport":{"Ba":{"k":25.5614771,"j":25.6564425},"ra":{"j":85.0595855,"k":85.2687289}}},"icon":"http:\\/\\/maps.gstatic.com\\/mapfiles\\/place_api\\/icons\\/geocode-71.png","id":"4fc282a7b1c8d08f121b0e74132c2dad67f1198d","name":"Patna","reference":"CoQBdgAAADdFG9er_Vctk2XX52fMVjGJP1uXD1Eq0dFEviyb9xFpF54lDhb8Sowlpo3CUuKmThgbS-CN0lOgwWDq_iYoLrETGbicpRkGHPs3sDu6wo3Let4dBj51UihH_ajKu3gTDPbdTvzoyBjtwviAlaXU-hxEhK6PDvIAv3tzStcH8BW8EhCihIS3HjP-Ogblf2GvQ2SdGhSyGShL75ZIG0Kcv07r8skwV6qu_Q","types":["locality","political"],"url":"https:\\/\\/maps.google.com\\/maps\\/place?q=Patna,+Bihar,+India&ftid=0x39f29937c52d4f05:0x831a0e05f607b270","vicinity":"Patna","html_attributions":[]}', 25.6125, 85.1283, 0),
(10, 'Jama Mosque', 'jama-mosque', '', '', 'Jama Masjid, Chandni Chowk, New Delhi, Delhi 110006, India', 22, 99, '{"address_components":[{"long_name":"Jama Masjid","short_name":"Jama Masjid","types":["sublocality","political"]},{"long_name":"Chandni Chowk","short_name":"Chandni Chowk","types":["sublocality","political"]},{"long_name":"New Delhi","short_name":"New Delhi","types":["locality","political"]},{"long_name":"North Delhi","short_name":"North Delhi","types":["administrative_area_level_2","political"]},{"long_name":"Delhi","short_name":"DL","types":["administrative_area_level_1","political"]},{"long_name":"India","short_name":"IN","types":["country","political"]},{"long_name":"110006","short_name":"110006","types":["postal_code"]}],"adr_address":"<span class=\\"extended-address\\">Jama Masjid, Chandni Chowk<\\/span>, <span class=\\"locality\\">New Delhi<\\/span>, <span class=\\"region\\">Delhi<\\/span> <span class=\\"postal-code\\">110006<\\/span>, <span class=\\"country-name\\">India<\\/span>","formatted_address":"Jama Masjid, Chandni Chowk, New Delhi, Delhi 110006, India","geometry":{"location":{"k":28.6516128,"A":77.2354859},"viewport":{"Ba":{"k":28.648293,"j":28.653233},"ra":{"j":77.2323259,"k":77.24003}}},"icon":"http:\\/\\/maps.gstatic.com\\/mapfiles\\/place_api\\/icons\\/geocode-71.png","id":"a34575ff53b409cb593ef5140fe7f47525795f90","name":"Jama Masjid","reference":"CqQBngAAAKar6N2J4BXVKEKQsphYXSBDFr5Y9E7gjEEU4D_chJvMSV4ZVkCii9TIYRRlWIiTOtPF5UL8-p_H7zDb1EfEVzci1z--U3Be-ZUGTnTulh4AEY_nkPQTs51yQXKE-McFvhOAyn3KR-ISPQpofNmviC2EPiwhu7kYeV7nxAxpm-IFp8EACa2q2vvP8boQ3valrWvyI0SdsRiqWpc5D4FEgXYSEOQstpC02MWEp_pnGHUMaucaFIbQ3Is92YRCN10WdjTlOhUT8y4H","types":["sublocality","political"],"url":"https:\\/\\/maps.google.com\\/maps\\/place?q=Jama+Masjid,+Chandni+Chowk,+New+Delhi,+Delhi+110006,+India&ftid=0x390cfd1f21d3e5ef:0xacc90ea5513db022","vicinity":"Jama Masjid","html_attributions":[]}', 28.6516, 77.2355, 0),
(11, 'India Gate', 'india-gate', '', '', 'India Gate, New Delhi, Delhi, India', 18, 99, '{"address_components":[{"long_name":"India Gate","short_name":"India Gate","types":["sublocality","political"]},{"long_name":"New Delhi","short_name":"New Delhi","types":["locality","political"]},{"long_name":"New Delhi","short_name":"New Delhi","types":["administrative_area_level_2","political"]},{"long_name":"Delhi","short_name":"DL","types":["administrative_area_level_1","political"]},{"long_name":"India","short_name":"IN","types":["country","political"]}],"adr_address":"<span class=\\"extended-address\\">India Gate<\\/span>, <span class=\\"locality\\">New Delhi<\\/span>, <span class=\\"region\\">Delhi<\\/span>, <span class=\\"country-name\\">India<\\/span>","formatted_address":"India Gate, New Delhi, Delhi, India","geometry":{"location":{"k":28.6091153,"A":77.2333304},"viewport":{"Ba":{"k":28.597225,"j":28.620872},"ra":{"j":77.2250439,"k":77.2407659}}},"icon":"http:\\/\\/maps.gstatic.com\\/mapfiles\\/place_api\\/icons\\/geocode-71.png","id":"ef18a0ff2e28feb76b18d23d74ed52e06b106dad","name":"India Gate","reference":"CpQBhgAAANMBmsAwsy-4b-p7Uh-sPWLIqxsXfnOBUukwp27E_0shhPjGv6uUTpDULgqeTKEFQFoSP-vDb7z3G1BN_JWcD6k2bGlIVO64vfc7kS0-_MHW3Y5zqRKU8S6JZZCnChgdYXdlJ2yrLQqvo8rADO5MlXdSMaKAi83cAdeSdmwtxMyNLzTySbCBgjFsn1ywLoqyIxIQ-EyAN14GEmc4xLeQEfabABoUIi8qpvGmDPfRFzToPTYKDeTutZ4","types":["sublocality","political"],"url":"https:\\/\\/maps.google.com\\/maps\\/place?q=India+Gate,+New+Delhi,+Delhi,+India&ftid=0x390ce2db961be393:0xf6c7ef5ee6dd10ae","vicinity":"India Gate","html_attributions":[]}', 28.6091, 77.2333, 0),
(12, 'Qutub Minar', 'qutub-minar', '', '', 'Qutab Institutional Area, New Delhi, Delhi, India', 25, 99, '{"address_components":[{"long_name":"Qutab Institutional Area","short_name":"Qutab Institutional Area","types":["sublocality","political"]},{"long_name":"New Delhi","short_name":"New Delhi","types":["locality","political"]},{"long_name":"South Delhi","short_name":"South Delhi","types":["administrative_area_level_2","political"]},{"long_name":"Delhi","short_name":"DL","types":["administrative_area_level_1","political"]},{"long_name":"India","short_name":"IN","types":["country","political"]}],"adr_address":"<span class=\\"extended-address\\">Qutab Institutional Area<\\/span>, <span class=\\"locality\\">New Delhi<\\/span>, <span class=\\"region\\">Delhi<\\/span>, <span class=\\"country-name\\">India<\\/span>","formatted_address":"Qutab Institutional Area, New Delhi, Delhi, India","geometry":{"location":{"k":28.5384902,"A":77.1844619},"viewport":{"Ba":{"k":28.530136,"j":28.5446029},"ra":{"j":77.17312,"k":77.1975221}}},"icon":"http:\\/\\/maps.gstatic.com\\/mapfiles\\/place_api\\/icons\\/geocode-71.png","id":"83ed5931d6fc65adde68daf869ae7d4fc0e41f00","name":"Qutab Institutional Area","reference":"CqQBlQAAAHVLpkiI0jLuV_ZhCR-ATr2Td1wXaqTWPdeKyTF1itZAzmtEYcJDqvqlgFSHwDbbQ-e4L1zrOn4m9Qdg5B5uw_AfL_GQizJKSWd_e7Vck6COoNCEno5ksD5a63k_umztb318U2qMXgMk_-iobuHRkQJ14QiWBkd8a8GP6pkyuh8V4Oi__aIlPs9EoCjve040PDPtDbNdqA2Q0BnNtukwA0oSENh8tsy5IJkn4PRkPD0yI_kaFLZlNUJa25g6dkqyWf0LMSK5Nnp-","types":["sublocality","political"],"url":"https:\\/\\/maps.google.com\\/maps\\/place?q=Qutab+Institutional+Area,+New+Delhi,+Delhi,+India&ftid=0x390d1dfa7710b521:0x325dcf1cd3e72135","vicinity":"Qutab Institutional Area","html_attributions":[]}', 28.5385, 77.1845, 0),
(13, 'Starbucks Cafe', 'starbucks-cafe', '', '', 'Rajeev Chowk, Connaught Place, New Delhi, Delhi 110001, India', 18, 99, '{"address_components":[{"long_name":"Rajeev Chowk","short_name":"Rajeev Chowk","types":["sublocality","political"]},{"long_name":"Connaught Place","short_name":"CP","types":["sublocality","political"]},{"long_name":"New Delhi","short_name":"New Delhi","types":["locality","political"]},{"long_name":"New Delhi","short_name":"New Delhi","types":["administrative_area_level_2","political"]},{"long_name":"Delhi","short_name":"DL","types":["administrative_area_level_1","political"]},{"long_name":"India","short_name":"IN","types":["country","political"]},{"long_name":"110001","short_name":"110001","types":["postal_code"]}],"adr_address":"<span class=\\"extended-address\\">Rajeev Chowk, Connaught Place<\\/span>, <span class=\\"locality\\">New Delhi<\\/span>, <span class=\\"region\\">Delhi<\\/span> <span class=\\"postal-code\\">110001<\\/span>, <span class=\\"country-name\\">India<\\/span>","formatted_address":"Rajeev Chowk, Connaught Place, New Delhi, Delhi 110001, India","geometry":{"location":{"k":28.6327778,"A":77.2197222},"viewport":{"Ba":{"k":28.6316329,"j":28.633914},"ra":{"j":77.2184101,"k":77.221003}}},"icon":"http:\\/\\/maps.gstatic.com\\/mapfiles\\/place_api\\/icons\\/geocode-71.png","id":"effda970b04fddfcbf04d71f237a46386a787d11","name":"Rajeev Chowk","reference":"CrQBoQAAAJzAI73L8d8vvChB1aIndbyoYTl-EgmX0HTzFWnt1a8AHjhx6FOUglBmzlg2utwiwdVCSiinTt5uti_dHxNv1h3CfGQcJi3cxyMFhrYUfQLhKjBjo92w2HZxbiDZAbOEt4_9dLCq2tcpLvFP_cXsXeo1XVvXKKJPcolSe4nmKd-Kwmypg6vg3ehFWjI-D75lnbU1VoCYin1FoZAGdci3clqqGMYFV17Dsjt1IHBv8vrwEhDX1KOQcR2OluqtN9q9C1yFGhRAwDJ_RFOw2i7CY0b_TxsAfOyJ0A","types":["sublocality","political"],"url":"https:\\/\\/maps.google.com\\/maps\\/place?q=Rajeev+Chowk,+Connaught+Place,+New+Delhi,+Delhi+110001,+India&ftid=0x390cfd37afda7319:0xfe032d0adfdb0938","vicinity":"Rajeev Chowk","html_attributions":[]}', 28.6328, 77.2197, 0),
(14, 'Parliament House', 'parliament-house', '', '', 'Central Secretariat, New Delhi, Delhi, India', 18, 99, '{"address_components":[{"long_name":"Central Secretariat","short_name":"Central Secretariat","types":["sublocality","political"]},{"long_name":"New Delhi","short_name":"New Delhi","types":["locality","political"]},{"long_name":"New Delhi","short_name":"New Delhi","types":["administrative_area_level_2","political"]},{"long_name":"Delhi","short_name":"DL","types":["administrative_area_level_1","political"]},{"long_name":"India","short_name":"IN","types":["country","political"]}],"adr_address":"<span class=\\"extended-address\\">Central Secretariat<\\/span>, <span class=\\"locality\\">New Delhi<\\/span>, <span class=\\"region\\">Delhi<\\/span>, <span class=\\"country-name\\">India<\\/span>","formatted_address":"Central Secretariat, New Delhi, Delhi, India","geometry":{"location":{"k":28.6139545,"A":77.2088987},"viewport":{"Ba":{"k":28.607845,"j":28.620279},"ra":{"j":77.2016369,"k":77.2277741}}},"icon":"http:\\/\\/maps.gstatic.com\\/mapfiles\\/place_api\\/icons\\/geocode-71.png","id":"3ff1b494a3831108ba7baf44de200a8821b95af0","name":"Central Secretariat","reference":"CpQBkAAAAJjC5IbKZ3W5ZEOEO0bYvCw-X82wTnBxrKxPdo9hW0ixcARbt1iMx0q8HuHdb_nIjbI9jckVuKfjQi75qLTYo_V6JicgGmOvU48hZjEoU5naDULlJ50BwNvP3q0i6XrIO30ZANKswoQ3hWlNRW97_FLEGecBRlcrRe4H8NIBczI-8-cJq-fWVj3LvhPZ6uTQoxIQkDe19qo6_k54W9EGzrR-QBoUT-H4zwlBFkHCI-pB-ya8Cp7Sd1c","types":["sublocality","political"],"url":"https:\\/\\/maps.google.com\\/maps\\/place?q=Central+Secretariat,+New+Delhi,+Delhi,+India&ftid=0x390ce2b7a9e9d153:0x440c804f37cc4083","vicinity":"Central Secretariat","html_attributions":[]}', 28.614, 77.2089, 0),
(15, 'Firoz Shah Kotla', 'firoz-shah-kotla', '', '', 'Pragati Maidan, New Delhi, Delhi, India', 18, 99, '{"address_components":[{"long_name":"Pragati Maidan","short_name":"Pragati Maidan","types":["sublocality","political"]},{"long_name":"New Delhi","short_name":"New Delhi","types":["locality","political"]},{"long_name":"New Delhi","short_name":"New Delhi","types":["administrative_area_level_2","political"]},{"long_name":"Delhi","short_name":"DL","types":["administrative_area_level_1","political"]},{"long_name":"India","short_name":"IN","types":["country","political"]}],"adr_address":"<span class=\\"extended-address\\">Pragati Maidan<\\/span>, <span class=\\"locality\\">New Delhi<\\/span>, <span class=\\"region\\">Delhi<\\/span>, <span class=\\"country-name\\">India<\\/span>","formatted_address":"Pragati Maidan, New Delhi, Delhi, India","geometry":{"location":{"k":28.6115068,"A":77.2433891},"viewport":{"Ba":{"k":28.6057449,"j":28.62611},"ra":{"j":77.2399609,"k":77.2521181}}},"icon":"http:\\/\\/maps.gstatic.com\\/mapfiles\\/place_api\\/icons\\/geocode-71.png","id":"7c921fc6157ab9e619b50eceeb055d5d1d1b650c","name":"Pragati Maidan","reference":"CpQBiwAAADegujd9DUwceamvNJTOBahYK6ktgj_l48u7-yUbQly9nn-CNlLqTwFC2e_Dasy4F138rEq7vI0OwkjeVuOncYmLlWr4fljjUW4GnJehyGyDaa2cc7BN2gPL63I2CV4pmywBuf7Ci2LhncDZfVCwdbYhN1L_31CAWmzwD4FBH63jSfHSYkRNY1_SyWsXxhC1pRIQ9sL1_6hXjk-m9QkgqC_c8BoU7vJ_ij-pXY_bR1umz9F1VNVOoP8","types":["sublocality","political"],"url":"https:\\/\\/maps.google.com\\/maps\\/place?q=Pragati+Maidan,+New+Delhi,+Delhi,+India&ftid=0x390ce328b5a553f7:0x795cf6ea0f8b5378","vicinity":"Pragati Maidan","html_attributions":[]}', 28.6115, 77.2434, 0),
(16, 'Sankat Mochan Temple', 'sankat-mochan-temple', '', '', 'Saket Nagar Colony, Lanka, Varanasi, Uttar Pradesh, India', 1, 99, '{"address_components":[{"long_name":"Saket Nagar Colony","short_name":"Saket Nagar Colony","types":["sublocality","political"]},{"long_name":"Lanka","short_name":"Lanka","types":["sublocality","political"]},{"long_name":"Varanasi","short_name":"Varanasi","types":["locality","political"]},{"long_name":"Varanasi","short_name":"Varanasi","types":["administrative_area_level_2","political"]},{"long_name":"Uttar Pradesh","short_name":"UP","types":["administrative_area_level_1","political"]},{"long_name":"India","short_name":"IN","types":["country","political"]}],"adr_address":"<span class=\\"extended-address\\">Saket Nagar Colony, Lanka<\\/span>, <span class=\\"locality\\">Varanasi<\\/span>, <span class=\\"region\\">Uttar Pradesh<\\/span>, <span class=\\"country-name\\">India<\\/span>","formatted_address":"Saket Nagar Colony, Lanka, Varanasi, Uttar Pradesh, India","geometry":{"location":{"k":25.2814092,"A":82.9978626},"viewport":{"Ba":{"k":25.277819,"j":25.2845311},"ra":{"j":82.9915211,"k":83.003072}}},"icon":"http:\\/\\/maps.gstatic.com\\/mapfiles\\/place_api\\/icons\\/geocode-71.png","id":"609b7ba08a66abce95f55a237b7ae96b45e1d1c0","name":"Saket Nagar Colony","reference":"CqQBnQAAALYEAb5uEacv6HpfUd_f7Hv-hMmZIAOYj5KErZOphShGjhx6SzWhdRP8kjTxfoC1iMTPqjAnQVWwPHsh5NiXGuyEaSDVIPF0BYzmbsUo4AG4Ln7THIb_gFfIeWhp6FPzb6iSe4VoB_APP6FDPeExyvLM5_mKfOxSqchFQnzX6HWgWczPas5tHXGaEYgtQYJQKYh6boo23CXeXxRwPQR9hQcSEFdGzLHnKB9zKAHgUVKm1vAaFHmF7ip_vf9407zeDKewtOjYRZkI","types":["sublocality","political"],"url":"https:\\/\\/maps.google.com\\/maps\\/place?q=Saket+Nagar+Colony,+Lanka,+Varanasi,+Uttar+Pradesh,+India&ftid=0x398e318b731bff83:0xdc3624945213597d","vicinity":"Saket Nagar Colony","html_attributions":[]}', 25.2814, 82.9979, 0),
(17, 'Ramnagar Fort', 'ramnagar-fort', '', '', 'Ramnagar, Uttar Pradesh, India', 1, 99, '{"address_components":[{"long_name":"Ramnagar","short_name":"Ramnagar","types":["locality","political"]},{"long_name":"Varanasi","short_name":"Varanasi","types":["administrative_area_level_2","political"]},{"long_name":"Uttar Pradesh","short_name":"UP","types":["administrative_area_level_1","political"]},{"long_name":"India","short_name":"IN","types":["country","political"]}],"adr_address":"<span class=\\"locality\\">Ramnagar<\\/span>, <span class=\\"region\\">Uttar Pradesh<\\/span>, <span class=\\"country-name\\">India<\\/span>","formatted_address":"Ramnagar, Uttar Pradesh, India","geometry":{"location":{"k":25.28,"A":83.03},"viewport":{"Ba":{"k":25.2671299,"j":25.2831959},"ra":{"j":83.0194759,"k":83.0439378}}},"icon":"http:\\/\\/maps.gstatic.com\\/mapfiles\\/place_api\\/icons\\/geocode-71.png","id":"928e4c117b2c9e5ffe0c8a139efd10562c4d3d63","name":"Ramnagar","reference":"CpQBgQAAALyrJoPTphw4mOh1t1NbHuQUBL8rhxbyPqknlLB__vn4kN8Gpscod5EsUsrWLP8wqL8L_dcFRFq5sYtYRounV06Zi9bAdeGXE5ad7ym4JURbIRXkymZXp4u25slu9YsNSETl02-ElMeRnRsUffvNb3zFuGjd_1RjAUNK3t9yBuYzWmvNHqUMsP5mfvXsZ2IpMhIQ6k9xNAtVSmXsl-7aJYVruRoUx4ECW44cgPtsBnGRpJYi2B2kHDQ","types":["locality","political"],"url":"https:\\/\\/maps.google.com\\/maps\\/place?q=Ramnagar,+Uttar+Pradesh,+India&ftid=0x398e304d4339a155:0x8d476eeb94e5df6f","vicinity":"Ramnagar","html_attributions":[]}', 25.28, 83.03, 0),
(18, 'Banaras Hindu University', 'banaras-hindu-university', '', '', 'Banaras Hindu University Campus, Varanasi, Uttar Pradesh, India', 1, 99, '{"address_components":[{"long_name":"Banaras Hindu University Campus","short_name":"Banaras Hindu University Campus","types":["sublocality","political"]},{"long_name":"Varanasi","short_name":"Varanasi","types":["locality","political"]},{"long_name":"Varanasi","short_name":"Varanasi","types":["administrative_area_level_2","political"]},{"long_name":"Uttar Pradesh","short_name":"UP","types":["administrative_area_level_1","political"]},{"long_name":"India","short_name":"IN","types":["country","political"]}],"adr_address":"<span class=\\"extended-address\\">Banaras Hindu University Campus<\\/span>, <span class=\\"locality\\">Varanasi<\\/span>, <span class=\\"region\\">Uttar Pradesh<\\/span>, <span class=\\"country-name\\">India<\\/span>","formatted_address":"Banaras Hindu University Campus, Varanasi, Uttar Pradesh, India","geometry":{"location":{"k":25.2685304,"A":82.9904737},"viewport":{"Ba":{"k":25.252232,"j":25.2808251},"ra":{"j":82.9811859,"k":83.0045769}}},"icon":"http:\\/\\/maps.gstatic.com\\/mapfiles\\/place_api\\/icons\\/geocode-71.png","id":"b6c4531eeff3fae69b67cb6379465d9b803c9ab4","name":"Banaras Hindu University Campus","reference":"CrQBowAAANbU2aFLFvsoegnu6pGG-0cj5JOJVzCEToX47wjqadClRC0TAstMycZUmSt6x9hUarWBzwYsOxHLcDw7wssUqJzJcblYmJnoQZDTMmznEkTfQC-ePgRLyBwN2kKjzEE3TeGCpxo4U4ntihz6NwYjFZwvRCHu3UCW2n7nVauhL6vp1dChdiUunW_I2Ici2aQ1Smv4hfjecE9Uc-XGDxvCdQ4QIiFbZuKl3laTZKzgyoCvEhBr_geFyLTcC7WVscRAJ6j_GhRWtvPk7S5Z4EPfiJZYiPsLth8K8A","types":["sublocality","political"],"url":"https:\\/\\/maps.google.com\\/maps\\/place?q=Banaras+Hindu+University+Campus,+Varanasi,+Uttar+Pradesh,+India&ftid=0x398e3229c09228a9:0xfd5449baf28cd0bb","vicinity":"Banaras Hindu University Campus","html_attributions":[]}', 25.2685, 82.9905, 0),
(19, 'Dashashmegh Ghat', 'dashashmegh-ghat', '', '', 'Dashashmedh Rd, Bangali Tola, Varanasi, Uttar Pradesh, India', 1, 99, '{"address_components":[{"long_name":"Dashashmedh Rd","short_name":"Dashashmedh Rd","types":["route"]},{"long_name":"Bangali Tola","short_name":"Bangali Tola","types":["sublocality","political"]},{"long_name":"Varanasi","short_name":"Varanasi","types":["locality","political"]},{"long_name":"Varanasi","short_name":"Varanasi","types":["administrative_area_level_2","political"]},{"long_name":"Uttar Pradesh","short_name":"Uttar Pradesh","types":["administrative_area_level_1","political"]},{"long_name":"India","short_name":"IN","types":["country","political"]},{"long_name":"221001","short_name":"221001","types":["postal_code"]}],"adr_address":"<span class=\\"street-address\\">Dashashmedh Rd<\\/span>, <span class=\\"extended-address\\">Bangali Tola<\\/span>, <span class=\\"locality\\">Varanasi<\\/span>, <span class=\\"region\\">Uttar Pradesh<\\/span> <span class=\\"postal-code\\">221001<\\/span>, <span class=\\"country-name\\">India<\\/span>","formatted_address":"Dashashmedh Rd, Bangali Tola, Varanasi, Uttar Pradesh, India","geometry":{"location":{"k":25.306306,"A":83.010048}},"icon":"http:\\/\\/maps.gstatic.com\\/mapfiles\\/place_api\\/icons\\/worship_hindu-71.png","id":"6a16a61c3cd421fbbf3f0cec2addd0115737a7f1","name":"Dashashwamedh Ghat","photos":[{"height":585,"html_attributions":["<a href=\\"https:\\/\\/plus.google.com\\/112181888310848875068\\">ankush lohiya<\\/a>"],"width":800}],"reference":"CnRrAAAAwsVLUG1bVWyjcYPICETKU3dDUPTOly-F34WEbgIo0cAdOJ6U-irpuFi_lfbu6d8_k8INT7fm4kFYAWCvL8gz4UrMzbbrEALAsBgWo5ryO2ifp2y8zg_KRPNGOaSJOmoHz0BaMepr29lcDDS6D-r2QRIQ0cIkJjlibtAXlBTxTzCMBxoUK_Wigtda6VTAY7nsWW1Xk00INyE","reviews":[{"aspects":[{"rating":3,"type":"overall"}],"author_name":"Ganesh Khiste","author_url":"https:\\/\\/plus.google.com\\/113695587232204055476","language":"en","rating":5,"text":"One of the main Gate to visit gangas in varanasi","time":1390978871},{"aspects":[{"rating":1,"type":"overall"}],"author_name":"Rajat Dubey","author_url":"https:\\/\\/plus.google.com\\/114417874406088430782","language":"en","rating":3,"text":"It is very lovely place","time":1399567666},{"aspects":[{"rating":3,"type":"overall"}],"author_name":"Anshuman Pant","author_url":"https:\\/\\/plus.google.com\\/111872247003179458546","language":"en","rating":5,"text":"","time":1394410627}],"types":["hindu_temple","place_of_worship","establishment"],"url":"https:\\/\\/plus.google.com\\/118283425716409966651\\/about?hl=en","user_ratings_total":3,"utc_offset":330,"vicinity":"Dashashmedh Rd, Bangali Tola, Varanasi","html_attributions":[],"tz":"GMT+0530"}', 25.3063, 83.01, 0),
(20, 'Assi Ghat', 'assi-ghat', '', '', 'Assi ghat, Shivala, Varanasi, Uttar Pradesh 221005, India', 1, 99, '{"address_components":[{"long_name":"Assi ghat","short_name":"Assi ghat","types":["neighborhood","political"]},{"long_name":"Shivala","short_name":"Shivala","types":["sublocality","political"]},{"long_name":"Varanasi","short_name":"Varanasi","types":["locality","political"]},{"long_name":"Varanasi","short_name":"Varanasi","types":["administrative_area_level_2","political"]},{"long_name":"Uttar Pradesh","short_name":"UP","types":["administrative_area_level_1","political"]},{"long_name":"India","short_name":"IN","types":["country","political"]},{"long_name":"221005","short_name":"221005","types":["postal_code"]}],"adr_address":"<span class=\\"extended-address\\">Assi ghat, Shivala<\\/span>, <span class=\\"locality\\">Varanasi<\\/span>, <span class=\\"region\\">Uttar Pradesh<\\/span> <span class=\\"postal-code\\">221005<\\/span>, <span class=\\"country-name\\">India<\\/span>","formatted_address":"Assi ghat, Shivala, Varanasi, Uttar Pradesh 221005, India","geometry":{"location":{"k":25.2886478,"A":83.0067619},"viewport":{"Ba":{"k":25.2881846,"j":25.2891646},"ra":{"j":83.0060782,"k":83.007312}}},"icon":"http:\\/\\/maps.gstatic.com\\/mapfiles\\/place_api\\/icons\\/geocode-71.png","id":"b20f21ec72d7e36c120b43297182c06d004222a5","name":"Assi ghat","reference":"CqQBnQAAAFR94j86OcmKgRxXff827_vOydAGE3G-N7dBeUGBhQLhO7RqFcY3JwJ1pPjUQSjKhTt3qD91GZTreTdFGGaf3K_o_Aa3Gw5RAxHtpLGL0WY9zstNFxoDHO9QgGhsCLTS7SyvTWC2GHt5TZXt-5u7AUWibU9XxixbSbIrRSKAL223xzVoMj58O5SMa9iMHGuy_lcG-xXo_wXyHqLqH1BhycQSECApuqlrLIiWzP3wbtVOVDYaFC4Xam8cMGKey80qCbAsIALJXmzy","types":["neighborhood","political"],"url":"https:\\/\\/maps.google.com\\/maps\\/place?q=Assi+ghat,+Shivala,+Varanasi,+Uttar+Pradesh+221005,+India&ftid=0x398e31ec350fb8ab:0xa8fd115260e2f177","vicinity":"Shivala","html_attributions":[]}', 25.2886, 83.0068, 0),
(21, 'Sarnath', 'sarnath', '', '', 'Sarnath, Varanasi, Uttar Pradesh 221007, India', 1, 99, '{"address_components":[{"long_name":"Sarnath","short_name":"Sarnath","types":["sublocality","political"]},{"long_name":"Varanasi","short_name":"Varanasi","types":["locality","political"]},{"long_name":"Varanasi","short_name":"Varanasi","types":["administrative_area_level_2","political"]},{"long_name":"Uttar Pradesh","short_name":"UP","types":["administrative_area_level_1","political"]},{"long_name":"India","short_name":"IN","types":["country","political"]},{"long_name":"221007","short_name":"221007","types":["postal_code"]}],"adr_address":"<span class=\\"extended-address\\">Sarnath<\\/span>, <span class=\\"locality\\">Varanasi<\\/span>, <span class=\\"region\\">Uttar Pradesh<\\/span> <span class=\\"postal-code\\">221007<\\/span>, <span class=\\"country-name\\">India<\\/span>","formatted_address":"Sarnath, Varanasi, Uttar Pradesh 221007, India","geometry":{"location":{"k":25.3811111,"A":83.0213889},"viewport":{"Ba":{"k":25.357813,"j":25.388048},"ra":{"j":83.01278,"k":83.0369299}}},"icon":"http:\\/\\/maps.gstatic.com\\/mapfiles\\/place_api\\/icons\\/geocode-71.png","id":"b876e4c9f06c77268ba13a293038765ac6e63e55","name":"Sarnath","reference":"CqQBkgAAAOM-K_g7j31OfpOxU5YAbF9JMup-ags9IeAkC1Kxd3tz-oFD2IHnRRuw1z3dAKIzG3p2g8hQRGj1iks0UkYuBPOxw-VYzw6S3d2X1CF5daf8kK4IW4WnfCNJhyXhctLHZpKh0DzqYhOctVdOoRXBkA2W0g97Cc5xs0QwFEX8q8JiPKtEHhTDpqRbSbzDQZAoGMdw1VYOWdQpT2J-HHqagG8SEFK2jj5LnSZ2-e8Fhw7mfwMaFCY4bW8gvtyBVJRBr7VGmWw798rI","types":["sublocality","political"],"url":"https:\\/\\/maps.google.com\\/maps\\/place?q=Sarnath,+Varanasi,+Uttar+Pradesh+221007,+India&ftid=0x398e2ee870d6a12b:0xa1c385b2ea1fa974","vicinity":"Sarnath","html_attributions":[]}', 25.3811, 83.0214, 0),
(22, 'Durgakund', 'durgakund', '', '', 'Near Durgakund, Sankat Mochan Rd, Anandbagh, Birdopur, Varanasi, Uttar Pradesh, India', 1, 99, '{"address_components":[{"long_name":"Near Durgakund","short_name":"Near Durgakund","types":["street_number"]},{"long_name":"Sankat Mochan Rd","short_name":"Sankat Mochan Rd","types":["route"]},{"long_name":"Anandbagh","short_name":"Anandbagh","types":["sublocality","political"]},{"long_name":"Birdopur","short_name":"Birdopur","types":["sublocality","political"]},{"long_name":"Varanasi","short_name":"Varanasi","types":["locality","political"]},{"long_name":"Varanasi","short_name":"Varanasi","types":["administrative_area_level_2","political"]},{"long_name":"Uttar Pradesh","short_name":"Uttar Pradesh","types":["administrative_area_level_1","political"]},{"long_name":"India","short_name":"IN","types":["country","political"]},{"long_name":"221005","short_name":"221005","types":["postal_code"]}],"adr_address":"<span class=\\"street-address\\">Near Durgakund, Sankat Mochan Rd<\\/span>, <span class=\\"extended-address\\">Anandbagh, Birdopur<\\/span>, <span class=\\"locality\\">Varanasi<\\/span>, <span class=\\"region\\">Uttar Pradesh<\\/span> <span class=\\"postal-code\\">221005<\\/span>, <span class=\\"country-name\\">India<\\/span>","formatted_address":"Near Durgakund, Sankat Mochan Rd, Anandbagh, Birdopur, Varanasi, Uttar Pradesh, India","geometry":{"location":{"k":25.288742,"A":82.999087}},"icon":"http:\\/\\/maps.gstatic.com\\/mapfiles\\/place_api\\/icons\\/worship_hindu-71.png","id":"1102d527ed1b953f2ea646435a8206b1c36fd6f6","name":"Durgakund Temple","photos":[{"height":320,"html_attributions":["<a href=\\"https:\\/\\/plus.google.com\\/105455619108973764191\\">mohini gupta<\\/a>"],"width":240},{"height":1296,"html_attributions":["<a href=\\"https:\\/\\/plus.google.com\\/112215686795625737356\\">sethurajan sethu<\\/a>"],"width":776},{"height":720,"html_attributions":["<a href=\\"https:\\/\\/plus.google.com\\/101575236807898540946\\">arun gautam<\\/a>"],"width":540},{"height":1632,"html_attributions":["<a href=\\"https:\\/\\/plus.google.com\\/108499095310253740564\\">kranthi kumar<\\/a>"],"width":1224},{"height":600,"html_attributions":["<a href=\\"https:\\/\\/plus.google.com\\/114724864661178305164\\">Aaj dubey<\\/a>"],"width":800},{"height":1024,"html_attributions":["From a Google User"],"width":768},{"height":223,"html_attributions":["From a Google User"],"width":320},{"height":418,"html_attributions":["<a href=\\"https:\\/\\/plus.google.com\\/101575236807898540946\\">arun gautam<\\/a>"],"width":264}],"rating":4.5,"reference":"CnRqAAAA-MGicIsQKyW9jVhHj9N1OOfZ8cs7I1ko2-f2K0Hx-sQfV9qbKRi1zjZNpi86UOLGYVLaI_86_-x5eem2D3ZHS5QnhlZOmh52Jp9lD7BnI-KuAviijMLsForR1C5Ti6PUQd8vRyZKESSywREeljVCDhIQ6Zv6Llj7BuETkpjqxYzBTRoU8_I6NcQpUwiw20XnCam7Oz9f4mY","reviews":[{"aspects":[{"rating":3,"type":"quality"}],"author_name":"Ashish Raj","author_url":"https:\\/\\/plus.google.com\\/104836915089770542294","language":"en","rating":5,"text":"Jai mata di","time":1379059137},{"aspects":[{"rating":3,"type":"overall"}],"author_name":"Rakesh Yadav","author_url":"https:\\/\\/plus.google.com\\/101085300970279015444","language":"en","rating":5,"text":"JAI MATA DI","time":1381651734},{"aspects":[{"rating":3,"type":"quality"}],"author_name":"Amit Jaiswal","author_url":"https:\\/\\/plus.google.com\\/116160202734925789975","language":"en","rating":5,"text":"!! JAI MATA DI !!","time":1342415350},{"aspects":[{"rating":2,"type":"overall"}],"author_name":"A Google User","language":"en","rating":4,"text":"it is so ancient and one of the best temple in varanasi...a hindu goddess named DURGA is situated here and hindu do worship of her in this temple.","time":1309568811},{"aspects":[{"rating":3,"type":"overall"}],"author_name":"A Google User","language":"en","rating":5,"text":"Jai mata Di...","time":1342342999}],"types":["hindu_temple","place_of_worship","establishment"],"url":"https:\\/\\/plus.google.com\\/101681751552278700258\\/about?hl=en","user_ratings_total":13,"utc_offset":330,"vicinity":"Near Durgakund, Sankat Mochan Rd, Anandbagh, Birdopur, Varanasi","website":"http:\\/\\/www.shridurgamandir.com\\/","html_attributions":[],"tz":"GMT+0530"}', 25.2887, 82.9991, 0),
(23, 'Klj', 'klj', '', '', 'Varanasi, Uttar Pradesh, India', 1, 99, '{"address_components":[{"long_name":"Varanasi","short_name":"Varanasi","types":["locality","political"]},{"long_name":"Varanasi","short_name":"Varanasi","types":["administrative_area_level_2","political"]},{"long_name":"Uttar Pradesh","short_name":"UP","types":["administrative_area_level_1","political"]},{"long_name":"India","short_name":"IN","types":["country","political"]}],"adr_address":"<span class=\\"locality\\">Varanasi<\\/span>, <span class=\\"region\\">Uttar Pradesh<\\/span>, <span class=\\"country-name\\">India<\\/span>","formatted_address":"Varanasi, Uttar Pradesh, India","geometry":{"location":{"k":25.3176452,"A":82.9739144},"viewport":{"Ba":{"k":25.2458603,"j":25.3956651},"ra":{"j":82.9214574,"k":83.0607605}}},"icon":"http:\\/\\/maps.gstatic.com\\/mapfiles\\/place_api\\/icons\\/geocode-71.png","id":"11d69f9b2a92b4592aae2fc71462aa244bf0cd40","name":"Varanasi","reference":"CpQBgQAAACp9sBDsAhqq89WXH4X7ArSImymQXZjibbw27y77ryiwsCcyFLcsd0XhoyrOSC0JMVf7r6XeXFImBNJPDpKLzjaXq-Q16JDWN5XFDRqzyim_7LxT3bUUDvygSAyyPIGDQDAIEgHe6Uzdu-18gHq4CqL4lX8uCuPuyARhqB7KjPvS0bN9fej8hyjWxVB2iqMaPRIQa6DT9hFMXGBeYKwmVPRMfxoUDH0Q-9Qy7hOH4eqc6KQ58lRKLeE","types":["locality","political"],"url":"https:\\/\\/maps.google.com\\/maps\\/place?q=Varanasi,+Uttar+Pradesh,+India&ftid=0x398e2db76febcf4d:0x68131710853ff0b5","vicinity":"Varanasi","html_attributions":[]}', 25.3176, 82.9739, 0),
(24, 'Ramnagar Fort', 'ramnagar-fort', '', '', 'Ramnagar, Uttar Pradesh, India', 1, 99, '{"address_components":[{"long_name":"Ramnagar","short_name":"Ramnagar","types":["locality","political"]},{"long_name":"Varanasi","short_name":"Varanasi","types":["administrative_area_level_2","political"]},{"long_name":"Uttar Pradesh","short_name":"UP","types":["administrative_area_level_1","political"]},{"long_name":"India","short_name":"IN","types":["country","political"]}],"adr_address":"<span class=\\"locality\\">Ramnagar<\\/span>, <span class=\\"region\\">Uttar Pradesh<\\/span>, <span class=\\"country-name\\">India<\\/span>","formatted_address":"Ramnagar, Uttar Pradesh, India","geometry":{"location":{"k":25.28,"A":83.03},"viewport":{"ya":{"k":25.2671299,"j":25.2831959},"pa":{"j":83.0194759,"k":83.0439378}}},"icon":"http:\\/\\/maps.gstatic.com\\/mapfiles\\/place_api\\/icons\\/geocode-71.png","id":"928e4c117b2c9e5ffe0c8a139efd10562c4d3d63","name":"Ramnagar","place_id":"ChIJVaE5Q00wjjkRb9_llOtuR40","reference":"CpQBgQAAAF9BUrDldfD116fZDX8rMllozx4Yj5111JC4dR0u1fyVrQlk3NtcV-aj3o1OVbm2O1vgPuKkKSUJbwmVBLkJaJt3IIQ4e8iQyeEoURF8aVjq4Jj7VPjhmChUgNVDwx6qBQLHG_Jzqof9FmpFV6cZfVxro4zDQMGswUh5dgkPo90xG_i5BJ4Ho3nIOwvmSmdbABIQcSgs6iDbbMS8pDygebjpHRoUra9wnQUqB4MHyRDvtcbPmrW9xzY","scope":"GOOGLE","types":["locality","political"],"url":"https:\\/\\/maps.google.com\\/maps\\/place?q=Ramnagar,+Uttar+Pradesh,+India&ftid=0x398e304d4339a155:0x8d476eeb94e5df6f","vicinity":"Ramnagar","html_attributions":[]}', 25.28, 83.03, 0),
(27, 'akshardham Temple', 'akshardham-temple', '', '', 'National Highway 24, Near Noida Mor, New Delhi, DL, India', 18, 99, '{"address_components":[{"long_name":"New Delhi","short_name":"New Delhi","types":["locality","political"]},{"long_name":"DL","short_name":"DL","types":["administrative_area_level_1","political"]},{"long_name":"India","short_name":"IN","types":["country","political"]},{"long_name":"110092","short_name":"110092","types":["postal_code"]}],"adr_address":"National Highway 24, Near Noida Mor, <span class=\\"locality\\">New Delhi<\\/span>, <span class=\\"region\\">DL<\\/span> <span class=\\"postal-code\\">110092<\\/span>, <span class=\\"country-name\\">India<\\/span>","formatted_address":"National Highway 24, Near Noida Mor, New Delhi, DL, India","formatted_phone_number":"011 2202 6688","geometry":{"location":{"k":28.612661,"A":77.277258}},"icon":"http:\\/\\/maps.gstatic.com\\/mapfiles\\/place_api\\/icons\\/worship_hindu-71.png","id":"3e6e6ce0fcf6f4bc49e646ee71e278aa44342a49","international_phone_number":"+91 11 2202 6688","name":"Akshardham Temple","opening_hours":{"open_now":false,"periods":[{"close":{"day":0,"time":"1830","hours":18,"minutes":30,"nextDate":1404046800000},"open":{"day":0,"time":"0930","hours":9,"minutes":30,"nextDate":1404014400000}},{"close":{"day":2,"time":"1830","hours":18,"minutes":30,"nextDate":1404219600000},"open":{"day":2,"time":"0930","hours":9,"minutes":30,"nextDate":1404187200000}},{"close":{"day":3,"time":"1830","hours":18,"minutes":30,"nextDate":1404306000000},"open":{"day":3,"time":"0930","hours":9,"minutes":30,"nextDate":1404273600000}},{"close":{"day":4,"time":"1830","hours":18,"minutes":30,"nextDate":1404392400000},"open":{"day":4,"time":"0930","hours":9,"minutes":30,"nextDate":1404360000000}},{"close":{"day":5,"time":"1830","hours":18,"minutes":30,"nextDate":1404478800000},"open":{"day":5,"time":"0930","hours":9,"minutes":30,"nextDate":1404446400000}},{"close":{"day":6,"time":"1830","hours":18,"minutes":30,"nextDate":1404565200000},"open":{"day":6,"time":"0930","hours":9,"minutes":30,"nextDate":1404532800000}}]},"photos":[{"height":1519,"html_attributions":["<a href=\\"https:\\/\\/plus.google.com\\/116182582139394244701\\">Pankaj Kumar<\\/a>"],"width":2415}],"place_id":"ChIJ-7F1mVvjDDkRKrLzXiafoGk","rating":4.7,"reference":"CnRqAAAAxGSw9Qz9fctVlVOTyOkj4Hek7Pr4FvJUDf6DF9TMf19ENVtUYf6Av71UUUpZF9DdJEnt926k6rCsxYbhnxKnEDVXsNlFSY4mMbIxtS5nMhcv43-G3o5DeamINpjTdZlyu0JuGgg0ScquCsdDRusAgRIQub8Ky4s3pkSgiCYskn0ZqxoUsMc4yt_Ey2n2ksUxsevEh1bKBsU","reviews":[{"aspects":[{"rating":3,"type":"overall"}],"author_name":"saurabh verma","author_url":"https:\\/\\/plus.google.com\\/111274209123016912995","language":"en","rating":5,"text":"Really nice, whatever you want is here in the Tramples - The awesome beauty with peaceful environment, \\nDevotion - Shri Swami Narayana''s most beautiful statue in temple as well as in the open area.\\nBeauty in Architecture, The stone used, the ventilation and of course the exterior compound.\\nEntertainment with Knowledge (PAID of course) - Musical fountain + the hall show - but true value for money.\\nEnjoyment - Open Garden with different structure for knowledge base. Food courts, decent locations.\\nEasy to reach - Metro + Bus service + your own Car or bus.\\n\\nNEGATIVE FACTS\\n\\nNo Camera and electronic gadgets Allowed.\\n\\n","time":1400568556},{"aspects":[{"rating":3,"type":"overall"}],"author_name":"Vandana Verma","author_url":"https:\\/\\/plus.google.com\\/107173983741395516505","language":"en","rating":5,"text":"One of the best place to visit in Delhi, it really awesome & beautiful, its architecture is great & mind blowing, my experience is just amazing & wow. my relatives come with me this temple they say this place is like \\"Heaven\\".  ","time":1400931970},{"aspects":[{"rating":2,"type":"overall"}],"author_name":"Narender Singh Phartyal","author_url":"https:\\/\\/plus.google.com\\/101059188971852804961","language":"en","rating":4,"text":"Beautiful temple!!!! Awesome place to visit. Amazing architectural design. Musical Fountain show is also great. \\n\\nOne should visit at least once to explore its beauty!!!!!!!","time":1399885056},{"aspects":[{"rating":3,"type":"quality"}],"author_name":"Aalok Pratap Singh","author_url":"https:\\/\\/plus.google.com\\/102328881641017652104","language":"en","rating":5,"text":"Best, temple ever visited by me. You will enjoy it alongwith getting peace here. This is the biggest temple in the world.","time":1401729755},{"aspects":[{"rating":3,"type":"quality"}],"author_name":"dharminder kumar","author_url":"https:\\/\\/plus.google.com\\/107014426874760637050","language":"en","rating":5,"text":" Bahut achi jagha hai family layak","time":1392637399}],"scope":"GOOGLE","types":["hindu_temple","place_of_worship","establishment"],"url":"https:\\/\\/plus.google.com\\/116873126550754591244\\/about?hl=en","user_ratings_total":259,"utc_offset":330,"vicinity":"National Highway 24, Near Noida Mor, New Delhi","website":"http:\\/\\/www.akshardham.com\\/","html_attributions":[],"tz":"GMT+0530"}', 28.6127, 77.2773, 0),
(28, 'Mahagun Metro Mall', 'mahagun-metro-mall', '', '', 'Sector 3, Vaishali, Ghaziabad, Uttar Pradesh, India', 17, 99, '{"address_components":[{"long_name":"Ghaziabad","short_name":"Ghaziabad","types":["locality","political"]},{"long_name":"Uttar Pradesh","short_name":"Uttar Pradesh","types":["administrative_area_level_1","political"]},{"long_name":"India","short_name":"IN","types":["country","political"]},{"long_name":"201012","short_name":"201012","types":["postal_code"]}],"adr_address":"Sector 3, Vaishali, <span class=\\"locality\\">Ghaziabad<\\/span>, <span class=\\"region\\">Uttar Pradesh<\\/span> <span class=\\"postal-code\\">201012<\\/span>, <span class=\\"country-name\\">India<\\/span>","formatted_address":"Sector 3, Vaishali, Ghaziabad, Uttar Pradesh, India","formatted_phone_number":"0120 474 1030","geometry":{"location":{"k":28.641221,"A":77.337468}},"icon":"http:\\/\\/maps.gstatic.com\\/mapfiles\\/place_api\\/icons\\/generic_business-71.png","id":"bf0a07f95f1fd434e63a2808a32aeaa5cea27b97","international_phone_number":"+91 120 474 1030","name":"Mahagun Metro Mall","photos":[{"height":612,"html_attributions":["<a href=\\"https:\\/\\/plus.google.com\\/116642638870571580709\\">Sendil Kumar<\\/a>"],"width":816}],"place_id":"ChIJNUWMc9f6DDkR2zf1z0_uZ1k","rating":4.5,"reference":"CnRrAAAA5Xj3qRsy2CfLTEMwFq4W4Yn1h7Wd1Fdi1VvZhQdU1JtmEmjZiogqFzpwYw-mcOZoW63pUcXprnohMOfuKYq71WFDcU3YKqk3we0UWRrwlWOGKdswEtCVF6HjPhxDE2RIi0lvucN2bx8fPWtgO7HFwxIQxa1zQtbL7XFoih6NkHdqHhoUcKkuVfopMiYS44xcEzQNJg19BlA","reviews":[{"aspects":[{"rating":3,"type":"overall"}],"author_name":"Akshat Verma","author_url":"https:\\/\\/plus.google.com\\/113354430153286920073","language":"en","rating":5,"text":"Cool place good better than ansal plaza","time":1398428549},{"aspects":[{"rating":3,"type":"overall"}],"author_name":"mahendra singh","author_url":"https:\\/\\/plus.google.com\\/116098675880020340101","language":"en","rating":5,"text":"Very cool better then ansal plaza","time":1400823532},{"aspects":[{"rating":2,"type":"overall"}],"author_name":"Ashok Nahata","author_url":"https:\\/\\/plus.google.com\\/107616188666843235813","language":"en","rating":4,"text":"One of the best malls  around.","time":1401287268},{"aspects":[{"rating":2,"type":"overall"}],"author_name":"samer ahmed","author_url":"https:\\/\\/plus.google.com\\/107084003034897604220","language":"en","rating":4,"text":"Good place to visit","time":1402952936},{"aspects":[{"rating":2,"type":"overall"}],"author_name":"SHEETAL SABLOK","author_url":"https:\\/\\/plus.google.com\\/111144414266535988382","language":"en","rating":4,"text":"It has great things","time":1397030133}],"scope":"GOOGLE","types":["shopping_mall","establishment"],"url":"https:\\/\\/plus.google.com\\/110190729333136710464\\/about?hl=en","user_ratings_total":22,"utc_offset":330,"vicinity":"Sector 3, Vaishali, Ghaziabad","html_attributions":[],"tz":"GMT+0530"}', 28.6412, 77.3375, 0),
(29, 'Ansal Plaza', 'ansal-plaza', '', '', 'Vaishali, Ghaziabad, DL, India', 18, 99, '{"address_components":[{"long_name":"Vaishali","short_name":"Vaishali","types":["sublocality","political"]},{"long_name":"Ghaziabad","short_name":"Ghaziabad","types":["locality","political"]},{"long_name":"New Delhi","short_name":"New Delhi","types":["administrative_area_level_2","political"]},{"long_name":"DL","short_name":"DL","types":["administrative_area_level_1","political"]},{"long_name":"India","short_name":"IN","types":["country","political"]}],"adr_address":"<span class=\\"extended-address\\">Vaishali<\\/span>, <span class=\\"locality\\">Ghaziabad<\\/span>, <span class=\\"region\\">DL<\\/span>, <span class=\\"country-name\\">India<\\/span>","formatted_address":"Vaishali, Ghaziabad, DL, India","geometry":{"location":{"k":28.64536,"A":77.332922}},"icon":"http:\\/\\/maps.gstatic.com\\/mapfiles\\/place_api\\/icons\\/generic_business-71.png","id":"58031ec174e4e8997abfc5e1bb6b70c561eaf1df","name":"Ansal Plaza","place_id":"ChIJBezI-9f6DDkRPIQu1A4jrSQ","rating":4.3,"reference":"CnRkAAAAbDu68akrxepImdwvzAxtwJDRZoYk8wcwm1HJ0ngsVcG7lFoB99uhPgGIaX2wxeSar0D0-oYuykHSC11vpK8z8kjMHKUdpg2pZ9aw8mEXm4PmtDQiMqLNmmNhM9shrbn3INbKGoYL0Mu63rN2narYzxIQmfqalluU7q_47gLzKk6rCxoUZX5mbKpcLvUCj0QxD--HC_Q8c4w","reviews":[{"aspects":[{"rating":2,"type":"overall"}],"author_name":"Vishal Latther","author_url":"https:\\/\\/plus.google.com\\/107442081811835431172","language":"en","rating":4,"text":"Good app","time":1390867368},{"aspects":[{"rating":3,"type":"overall"}],"author_name":"KBNOWS S","author_url":"https:\\/\\/plus.google.com\\/109079533082402505098","language":"en","rating":5,"text":"KBNOWS SOCIETY","time":1388831587},{"aspects":[{"rating":3,"type":"quality"},{"rating":2,"type":"appeal"},{"rating":2,"type":"service"}],"author_name":"Saurav Yadav","author_url":"https:\\/\\/plus.google.com\\/102110178179413651746","language":"en","rating":4,"text":"Nice","time":1376217364},{"aspects":[{"rating":3,"type":"overall"}],"author_name":"Sushant Chawla","author_url":"https:\\/\\/plus.google.com\\/109554582555214438898","language":"en","rating":5,"text":"","time":1390566916},{"aspects":[{"rating":3,"type":"overall"}],"author_name":"Devanshu Pundir","author_url":"https:\\/\\/plus.google.com\\/107851402131771081812","language":"en","rating":5,"text":"","time":1374069287}],"scope":"GOOGLE","types":["shopping_mall","establishment"],"url":"https:\\/\\/plus.google.com\\/100572539687041023812\\/about?hl=en","user_ratings_total":9,"utc_offset":330,"vicinity":"Vaishali, Ghaziabad","html_attributions":[],"tz":"GMT+0530"}', 28.6454, 77.3329, 0);
INSERT INTO `element` (`id`, `title`, `slug`, `description`, `address`, `place`, `placeId`, `countryId`, `placeJson`, `latitude`, `longitude`, `zoom`) VALUES
(30, 'Mahagun Sarovar Portico', 'mahagun-sarovar-portico', '', '', 'Mahagun Metro Mall, VC 3, Sector 3, Vaishali, Ghaziabad, Uttar Pradesh, India', 27, 99, '{"address_components":[{"long_name":"Vaishali, Ghaziabad","short_name":"Vaishali, Ghaziabad","types":["locality","political"]},{"long_name":"Uttar Pradesh","short_name":"Uttar Pradesh","types":["administrative_area_level_1","political"]},{"long_name":"India","short_name":"IN","types":["country","political"]},{"long_name":"201010","short_name":"201010","types":["postal_code"]}],"adr_address":"Mahagun Metro Mall, VC 3, Sector 3, <span class=\\"locality\\">Vaishali, Ghaziabad<\\/span>, <span class=\\"region\\">Uttar Pradesh<\\/span> <span class=\\"postal-code\\">201010<\\/span>, <span class=\\"country-name\\">India<\\/span>","formatted_address":"Mahagun Metro Mall, VC 3, Sector 3, Vaishali, Ghaziabad, Uttar Pradesh, India","formatted_phone_number":"0120 467 7000","geometry":{"location":{"k":28.644443,"A":77.335204}},"icon":"http:\\/\\/maps.gstatic.com\\/mapfiles\\/place_api\\/icons\\/lodging-71.png","id":"a39104cac1e74bdb0826b23a2c22f13a3c3f7b83","international_phone_number":"+91 120 467 7000","name":"Mahagun Sarovar Portico","photos":[{"height":667,"html_attributions":[],"width":1000}],"place_id":"ChIJWy77oNf6DDkRSI7TIQSupec","rating":4.1,"reference":"CoQBcQAAAB85JPAyWeSckjuGvi64ekFcDd2QyFq3mFdew0lz4i6MJqjrG6q6bM1pTSEZ5V6XgdxShWOJlYHEhzediQCp_J8Q0PWyLSfTxOe9RdumfeouJU18V4uUwIg7uaI-jHPF1vCWdentP2SQZvW5CF5GDfneYAI8yux7FnXNDbzhtjnYEhDRmJNs8maMqM8cmjQdcvPuGhTHAV_8Fff_BlSRjTglmLyW4LZqrg","reviews":[{"aspects":[{"rating":1,"type":"overall"}],"author_name":"Vikrant Kumar","author_url":"https:\\/\\/plus.google.com\\/116931714670683164435","language":"en","rating":3,"text":"Decent hotel in the locality, can improve food & ambience","time":1381392982},{"aspects":[{"rating":3,"type":"overall"}],"author_name":"Amit Solanki","author_url":"https:\\/\\/plus.google.com\\/114849204495723076389","language":"en","rating":5,"text":"Nice mall","time":1399025621},{"aspects":[{"rating":2,"type":"overall"}],"author_name":"Promen Sharma","author_url":"https:\\/\\/plus.google.com\\/108620525634712101889","language":"en","rating":4,"text":"Promen","time":1374593597},{"aspects":[{"rating":3,"type":"overall"}],"author_name":"sanu max","author_url":"https:\\/\\/plus.google.com\\/108472465392333950572","language":"en","rating":5,"text":"","time":1383139226},{"aspects":[{"rating":1,"type":"overall"}],"author_name":"Rahul Bisht","author_url":"https:\\/\\/plus.google.com\\/108146120565930661920","language":"en","rating":3,"text":"","time":1397965837}],"scope":"GOOGLE","types":["lodging","establishment"],"url":"https:\\/\\/plus.google.com\\/109940006157927654646\\/about?hl=en","user_ratings_total":7,"utc_offset":330,"vicinity":"Mahagun Metro Mall, VC 3, Sector 3, Vaishali, Ghaziabad","website":"http:\\/\\/www.sarovarhotels.com\\/","html_attributions":[],"tz":"GMT+0530"}', 28.6444, 77.3352, 0),
(32, 'Durga Temple', 'durga-temple', '', '', 'Ramnagar, Uttar Pradesh, India', 1, 99, '{"address_components":[{"long_name":"Ramnagar","short_name":"Ramnagar","types":["locality","political"]},{"long_name":"Varanasi","short_name":"Varanasi","types":["administrative_area_level_2","political"]},{"long_name":"Uttar Pradesh","short_name":"UP","types":["administrative_area_level_1","political"]},{"long_name":"India","short_name":"IN","types":["country","political"]}],"adr_address":"<span class=\\"locality\\">Ramnagar<\\/span>, <span class=\\"region\\">Uttar Pradesh<\\/span>, <span class=\\"country-name\\">India<\\/span>","formatted_address":"Ramnagar, Uttar Pradesh, India","geometry":{"location":{"k":25.28,"A":83.03},"viewport":{"ya":{"k":25.2671299,"j":25.2831959},"pa":{"j":83.0194759,"k":83.0439378}}},"icon":"http:\\/\\/maps.gstatic.com\\/mapfiles\\/place_api\\/icons\\/geocode-71.png","id":"928e4c117b2c9e5ffe0c8a139efd10562c4d3d63","name":"Ramnagar","place_id":"ChIJVaE5Q00wjjkRb9_llOtuR40","reference":"CpQBgQAAAAebEusIAL1neqI2mZfU8rIM_fHNd2oThIFLBiuMXN1BSLbSS9pVCOuXQ8BM8kEjlJW6r8eij7K08qF8faX2slHIzz697zPmKJfFtAEXm-mj8fcgz-yvhdg9WZEGTTvOmZRROr33oL-CiS-kaBa8LjlOlvFGQcG88_7RlU9q3a8OWAXj7MAxqYHUhWY_y-1zjhIQFTQYaevr40xsOtVmxltNpxoU3DHJ0mrw5Znicaa1EAYB7G2WNVA","scope":"GOOGLE","types":["locality","political"],"url":"https:\\/\\/maps.google.com\\/maps\\/place?q=Ramnagar,+Uttar+Pradesh,+India&ftid=0x398e304d4339a155:0x8d476eeb94e5df6f","vicinity":"Ramnagar","html_attributions":[]}', 25.28, 83.03, 0),
(33, 'Tulsi Manas Mandir', 'tulsi-manas-mandir', '', '', 'Anandbagh, Bhelupur, Varanasi, Uttar Pradesh, India', 1, 99, '{"address_components":[{"long_name":"Anandbagh","short_name":"Anandbagh","types":["sublocality","political"]},{"long_name":"Bhelupur","short_name":"Bhelupur","types":["sublocality","political"]},{"long_name":"Varanasi","short_name":"Varanasi","types":["locality","political"]},{"long_name":"Varanasi","short_name":"Varanasi","types":["administrative_area_level_2","political"]},{"long_name":"Uttar Pradesh","short_name":"Uttar Pradesh","types":["administrative_area_level_1","political"]},{"long_name":"India","short_name":"IN","types":["country","political"]},{"long_name":"221005","short_name":"221005","types":["postal_code"]}],"adr_address":"<span class=\\"extended-address\\">Anandbagh, Bhelupur<\\/span>, <span class=\\"locality\\">Varanasi<\\/span>, <span class=\\"region\\">Uttar Pradesh<\\/span> <span class=\\"postal-code\\">221005<\\/span>, <span class=\\"country-name\\">India<\\/span>","formatted_address":"Anandbagh, Bhelupur, Varanasi, Uttar Pradesh, India","geometry":{"location":{"k":25.287215,"A":83.000445}},"icon":"http:\\/\\/maps.gstatic.com\\/mapfiles\\/place_api\\/icons\\/worship_hindu-71.png","id":"095d3e69024972e8f8c496cf6304fcd406d26de4","name":"TULSI MANAS MANDIR","place_id":"ChIJY_SjpfMxjjkRn8Lo6e2VlNY","reference":"CnRsAAAAQaWGG62-rWAup1XnF9HC52YarEI_ouHyMK_h9dw-wQUANj1cr9Cbsf7izzbb3xb8TBZnOSslcVnlT1e0mGnkl9oieHEWIkYtBcH3ajNbsIHK61njcBG868vynMzepVbb29T0DJZTsyDPifitGpxZsRIQmqDldwiYKkcAzF7Hd85y-BoUCHXTf80DG9SklH8P-aG64rfzjLg","scope":"GOOGLE","types":["hindu_temple","place_of_worship","establishment"],"url":"https:\\/\\/plus.google.com\\/110195667994038868071\\/about?hl=en","utc_offset":330,"vicinity":"Anandbagh, Bhelupur, Varanasi","html_attributions":[],"tz":"GMT+0530"}', 25.2872, 83.0004, 0);

-- --------------------------------------------------------

--
-- Table structure for table `element_component`
--

CREATE TABLE IF NOT EXISTS `element_component` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `elementId` int(11) NOT NULL,
  `componentId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `element_component`
--

INSERT INTO `element_component` (`id`, `elementId`, `componentId`) VALUES
(1, 1, 2),
(4, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `element_contact`
--

CREATE TABLE IF NOT EXISTS `element_contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `elementId` int(11) NOT NULL,
  `value` varchar(50) NOT NULL,
  `valid` int(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `element_contact`
--

INSERT INTO `element_contact` (`id`, `elementId`, `value`, `valid`) VALUES
(1, 1, '+91 9971119874', 1),
(2, 1, '+91 9562629874', 1);

-- --------------------------------------------------------

--
-- Table structure for table `element_locality`
--

CREATE TABLE IF NOT EXISTS `element_locality` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `elementId` int(11) NOT NULL,
  `localityId` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `element_locality`
--

INSERT INTO `element_locality` (`id`, `elementId`, `localityId`, `timestamp`) VALUES
(28, 0, 28, '2014-06-28 18:12:05'),
(29, 29, 29, '2014-06-28 18:14:11'),
(30, 29, 26, '2014-06-28 18:14:11'),
(31, 30, 26, '2014-06-28 18:17:08'),
(32, 31, 18, '2014-06-28 18:23:53'),
(33, 32, 18, '2014-06-28 18:25:45'),
(34, 33, 0, '2014-06-30 13:34:49'),
(35, 33, 23, '2014-06-30 13:34:49'),
(36, 33, 27, '2014-06-30 13:34:49');

-- --------------------------------------------------------

--
-- Table structure for table `keys`
--

CREATE TABLE IF NOT EXISTS `keys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(40) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `mod_album`
--

CREATE TABLE IF NOT EXISTS `mod_album` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `elementId` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `mod_album`
--

INSERT INTO `mod_album` (`id`, `elementId`, `timestamp`) VALUES
(1, 1, '2014-02-22 19:20:53'),
(2, 1, '2014-02-22 19:56:35');

-- --------------------------------------------------------

--
-- Table structure for table `mod_comment`
--

CREATE TABLE IF NOT EXISTS `mod_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `elementId` int(11) NOT NULL,
  `comment` text NOT NULL,
  `userId` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `mod_comment`
--

INSERT INTO `mod_comment` (`id`, `elementId`, `comment`, `userId`, `timestamp`) VALUES
(1, 1, 'First comment for element', 1, '2013-12-17 18:30:00'),
(2, 1, 'Loving this place.... Great place', 1, '2013-12-19 18:30:00'),
(3, 1, 'last comment for this element', 1, '2013-12-22 17:18:09');

-- --------------------------------------------------------

--
-- Table structure for table `mod_photo`
--

CREATE TABLE IF NOT EXISTS `mod_photo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `albumId` int(11) NOT NULL,
  `host` varchar(200) NOT NULL DEFAULT '0',
  `path` varchar(200) NOT NULL DEFAULT 'photo/',
  `media` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `mod_photo`
--

INSERT INTO `mod_photo` (`id`, `albumId`, `host`, `path`, `media`) VALUES
(1, 1, '0', 'photo/', 'tajmahal.jpg'),
(2, 1, '0', 'photo/', 'tajmahal2.jpg'),
(3, 1, '0', 'photo/', 'tajmahal3.jpg'),
(4, 1, '0', 'photo/', 'tajmahal4.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `mod_rating`
--

CREATE TABLE IF NOT EXISTS `mod_rating` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `elementId` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `mod_rating`
--

INSERT INTO `mod_rating` (`id`, `elementId`, `rating`, `userId`, `timestamp`) VALUES
(1, 1, 30, 1, '2013-12-25 17:06:35'),
(2, 1, 80, 1, '2013-12-25 17:06:35'),
(3, 1, 40, 1, '2013-12-25 17:06:53');

-- --------------------------------------------------------

--
-- Table structure for table `mod_url`
--

CREATE TABLE IF NOT EXISTS `mod_url` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `elementId` int(11) NOT NULL,
  `facebook` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `mod_url`
--

INSERT INTO `mod_url` (`id`, `elementId`, `facebook`) VALUES
(1, 1, 'http://facebook.com/');

-- --------------------------------------------------------

--
-- Table structure for table `place`
--

CREATE TABLE IF NOT EXISTS `place` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `shortname` varchar(20) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `type` varchar(10) NOT NULL DEFAULT 'CITY',
  `cover_image` varchar(100) NOT NULL,
  `countryId` int(11) NOT NULL DEFAULT '99',
  `description` text NOT NULL,
  `latitude` varchar(20) NOT NULL,
  `longitude` varchar(20) NOT NULL,
  `zoom` int(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `place`
--

INSERT INTO `place` (`id`, `name`, `shortname`, `slug`, `type`, `cover_image`, `countryId`, `description`, `latitude`, `longitude`, `zoom`) VALUES
(1, 'Varanasi', '', 'varanasi', 'CITY', 'varanasi.jpg', 99, 'Alternatively known as <b>Benaras</b> and <b>Kashi</b>, the holy city of Varanasi (Banaras) (Banaras) lies on the banks of the Ganges. Said to have been founded by Lord Shiva himself, this place finds mention in the epic sagas of ''Ramayana'' and the ''Mahabharata''. Most people conforming to the Hindu faith strive to visit Varanasi (Banaras) (Banaras) at least once in their lives. Many of the temples here are centuries old, with some of the most prominent ones being Vishwanath Temple, Gauri Matha Temple and Kaal Bhairav Temple. Viewing the holy Ghats from a boat and taking a dip in the Ganges are considered as one of the ''must experienced'' things in one''s lifetime . Sari connoisseurs will have a field day here selecting some of the finest silks Varanasi (Banaras) (Banaras) is known for.', '25.31772544686744', '82.98304666748051', 12),
(2, 'Lucknow', '', 'lucknow', 'CITY', 'lucknow.jpg', 99, 'Lucknow has been closely associated with the history of India itself, particularly since it was one of the places where the First War of Indian Independence in 1857 emerged. Of this, the ruins of the Lucknow Residency and Museum are standing witnesses, with marks of cannon-balls still existing on its walls. The outcome of a long standing tryst with the Nawabi culture, Lucknow exemplifies both "tehzeeb" and "adab", each defining the grace, beauty and charm of a typical Lucknowi way of life. Home to some of the most delicious Awadhi and Mughlai food, Lucknow offers a great opportunity for those on a culinary pilgrimage. The renowned "chikankaari" embroidery has become synonymous with this city, available as garments or for home decor. The capital of one of the most prominent states in India, Lucknow continues to be a seat of politics, industry and a vibrant cultural heritage of central India.\n', '26.852022966387228', '80.94714273681645', 11),
(3, 'Udaipur', '', 'udaipur', 'CITY', 'udaipur.jpg', 99, 'Udaipur is a charming city that is often referred to as "Venice of the East". It is home to numerous historical monuments, palaces and forts that stand as a remembrance to Maharana Udai Singh II who was the founder of the city. The most amazing attribute of the city is that it is settled on the bank of three interconnected lakes namely, Swaroop Sagar Lake, Pichola Lake, and Fateh Sagar Lake. The major tourist places of the city includes the antique cars museum, the majestic Udaipur palace, Fateh sagar lake etc. This splendorous destination overflows with tourists both foreign and domestic.\n', '', '', 0),
(4, 'Kashmir', '', 'kashmir', 'CITY', 'kashmir.jpg', 99, 'Formerly a part of the erstwhile Princely State of Kashmir and Jammu, which governed the larger historic region of Kashmir, this territory is disputed among China, India and Pakistan. Pakistan, which claims the territory as disputed,[1] refers to it alternatively as Indian-occupied Kashmir or Indian-held Kashmir, while some international agencies such as the United Nations[2] call it Indian-administered Kashmir. The regions under the control of Pakistan is referred to as Pakistan-occupied Kashmir or PoK within India and Pakistan-administered Kashmir generally. Jammu and Kashmir (Kashmir) consists of three regions: Jammu, the Kashmir valley and Ladakh. Srinagar is the summer capital, and Jammu is the winter capital. While the Kashmir valley is famous for its beautiful mountainous landscape, Jammu''s numerous shrines attract tens of thousands of Hindu pilgrims every year. Ladakh, also known as "Little Tibet", is renowned for its remote mountain beauty and Buddhist culture.', '', '', 0),
(5, 'Nainital', '', 'nainital', 'CITY', 'nainital.jpg', 99, 'Deriving its name from goddess Naina Devi, Nainital is located in the hill state of Uttrakhand. This hill station is not only famous for its natural beauty but also for its marvelous architecture of the British era. Like many of India''s classic hill stations, Nainital is criticised for tourists, traffic and commercialisation, and yet manages to take your breath away at the odd moment. It is still possible to track down the soul of the place, especially in off-season spring or autumn, in its emrald lake, lovely old houses and its rich bounty of flowers. Nainital now stands for honeymooner''s haven, Gujarati''s thalis, cable car and boat rides, as well as schools of high repute, some nice hotels, views, birds and the ever-present snow-capped Kumaon hills in the distance. With places like Naini Lake, Governer''s House and St John in the Wilderness Church, Nainital is a cherished tourist spot for domestic and foreign tourists alike. The place also features many prestigious educational institutions. Not only that, Nainital also has some delicious treats in store for you, Kadhi Chawal being the most popular among them. What a trip! Awesome scenery with some amazing food, right? ', '', '', 0),
(6, 'Jaipur', '', 'jaipur', 'CITY', 'jaipur.jpg', 99, 'Studded with massive hilltop forts and mesmerising palatial residences, well laid gardens and wonders in stone, Jaipur is topped off with a sprinkling of heart warming Rajasthani hospitality. Discover this oasis of colours in the desert, when you shop for trinkets and handicrafts at Chaura Rasta and Tripolia Bazar; be mesmerised by the marvels of Amber Fort; get a taste of ''king size'' life when you visit the City Palace and get the true taste of Rajasthan when you visit the well loved Chokhi Dhaani. Come March and an all new life is unleashed on the city with the celebrations of the Elephant Festival.\n', '', '', 0),
(7, 'Delhi', '', 'delhi', 'CITY', 'delhi.png', 99, 'Delhi is undoubtedly the most multi-ethnic city in the country that has preserved its history but has not forgotten to develop in its due course to become one of the most modern and tolerant cities in the country. Laden with few of the best universities in the world, Delhi also boasts of the best research centers, theaters, performing art centers and museums. The city features architectural brilliance of the British and Mughal buildings such as the Rashtrapati Bhawan and Red Fort to the contemporary brilliance of several amusement parks, shopping malls, and party hubs. Not only is the city popular for its culture and celebrations, it is also known for its diversely delicious food from all the regions of the country. From multi-cuisine buffets to streetfood - you will find it all here to satisfy the foodie in you. \n\nThe city has been an imperial capital for the most part of the last thousand years, was the British colonial capital, is the capital of the Indian Republic, and has, for all these centuries, attracted migrants from vastly different geographies and cultures in search of a living, money, fame or patronage.... Delhi is now a metropolis of more than 16 million people. It’s a business, finance and higher education hub, sees more than 2.5 lakh migrants coming in every year and welcomes an average of 15 million tourists each year. It is home to the Indian Parliament, the Supreme Court, and to homes and offices of Central ministers and the bureaucratic elite. It hosts three World Heritage Sites (Qutub Minar, Humayun’s Tomb and Red Fort), many posh colonies as well as slum areas. It has grown to a total area of about 1,483 sq km. For its role as Commonwealth Games host for 2010, Delhi has seen modernisation-on-steroids. But the swanky redesigned airport, new Metro lines or speedy flyovers still lead you to places where emperors sighed, poets dreamed and warriors coveted.', '28.608409460087636', '77.2090445922852', 10),
(8, 'Mumbai', '', 'mumbai', 'CITY', 'mumbai.jpg', 99, 'Set amidst chaos, mayhem and obdurate beauty is the Gateway Of India and the love of Mumbai (Bombay) tourism, Mumbai (Bombay). A city with a historic past, a vibrant present and a bright future, Mumbai (Bombay) is rightly called the City of Dreams. The largest city in the country is an intriguing witness to the stark disparity between the glistening skyscrapers and the biggest slum dwelling in India. Also home to the world famous Indian entertainment industry, the Financial Capital of India is touted as one of the most cosmopolitan cities. An inspiring cultural pot, Mumbai (Bombay) plays host to diverse ethnicities and distinct spiritual beliefs. A visit to this mystic, charming and enthralling metropolitan will not disappoint you.', '', '', 0),
(9, 'Kolkata', '', 'kolkata', 'CITY', 'kolkata.jpg', 99, 'Dotted with bright yellow cabs, Kolkata (Calcutta), the bustling capital city of West Bengal, is the hub of Bengali culture in India. The city boasts of a rich cultural heritage, evident in its distinct cuisine, clothing, lifestyle, its literature and even architecture. The cradle to Communist parties in India, the city is an embodiment of its ideologies, which grant it its uniqueness in terms of the pace of life. You must visit the famous Howrah bridge, especially at night to see its twinkling city lights, reflected in the gently lapping Hooghly river. Visitors shoud also try traveling by the unique tramway, for a complete ''Calcutta'' experience. Come during the grand Durga Puja ceremony and lose yourself in the fervent, pious and celebratory air of the city.', '', '', 0),
(10, 'GorakhPur', '', 'gorakhpur', 'CITY', '', 99, '', '', '', 0),
(11, 'Bhraich', '', 'bhraich', 'CITY', '', 99, '', '', '', 0),
(12, 'Noida', '', 'noida', 'CITY', '', 99, '', '', '', 0),
(13, 'mohit', '', 'mohit', 'CITY', '', 99, '', '', '', 0),
(14, 'Bhupendra', '', 'bhupendra', 'CITY', '', 99, '', '', '', 0),
(15, 'Agra', '', 'agra', 'CITY', '', 99, '', '', '', 0),
(16, 'Uttar Pradesh', 'UP', 'uttar-pradesh', 'STATE', '', 99, '', '', '', 0),
(17, 'Ghaziabad', 'Ghaziabad', 'ghaziabad', 'CITY', '', 99, '', '', '', 0),
(18, 'New Delhi', 'New Delhi', 'new-delhi', 'CITY', '', 99, '', '', '', 0),
(19, 'Central Region', 'Central Region', 'central-region', 'STATE', '', 149, '', '', '', 0),
(20, 'Janakpur', 'Janakpur', 'janakpur', 'CITY', '', 149, '', '', '', 0),
(21, 'Bagpat', 'Bagpat', 'bagpat', 'CITY', '', 99, '', '', '', 0),
(22, 'North Delhi', 'North Delhi', 'north-delhi', 'CITY', '', 99, '', '', '', 0),
(23, 'Bihar', 'BR', 'bihar', 'STATE', '', 99, '', '', '', 0),
(24, 'Patna', 'Patna', 'patna', 'CITY', '', 99, '', '', '', 0),
(25, 'South Delhi', 'South Delhi', 'south-delhi', 'CITY', '', 99, '', '', '', 0),
(26, 'DL', 'DL', 'dl', 'STATE', '', 99, '', '', '', 0),
(27, 'Vaishali, Ghaziabad', 'Vaishali, Ghaziabad', 'vaishali,-ghaziabad', 'CITY', '', 99, '', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `place_locality`
--

CREATE TABLE IF NOT EXISTS `place_locality` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `shortname` varchar(20) NOT NULL,
  `parent` int(11) NOT NULL,
  `cityId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `place_locality`
--

INSERT INTO `place_locality` (`id`, `name`, `shortname`, `parent`, `cityId`) VALUES
(3, 'Khan Market', 'Khan Market', 0, 18),
(4, 'Rabindra Nagar', 'Rabindra Nagar', 0, 18),
(5, 'Varanasi Cantt', 'Varanasi Cantt', 0, 1),
(6, 'New Delhi', 'New Delhi', 0, 22),
(7, 'Chandni Chowk', 'Chandni Chowk', 6, 22),
(8, 'Jama Masjid', 'Jama Masjid', 6, 22),
(9, 'India Gate', 'India Gate', 0, 18),
(10, 'New Delhi', 'New Delhi', 0, 25),
(11, 'Qutab Institutional Area', 'Qutab Institutional ', 10, 25),
(12, 'Rajeev Chowk', 'Rajeev Chowk', 0, 18),
(13, 'CP', 'CP', 0, 18),
(14, 'Central Secretariat', 'Central Secretariat', 0, 18),
(15, 'Pragati Maidan', 'Pragati Maidan', 0, 18),
(16, 'Saket Nagar Colony', 'Saket Nagar Colony', 0, 1),
(17, 'Lanka', 'Lanka', 0, 1),
(18, 'Ramnagar', 'Ramnagar', 0, 1),
(19, 'Banaras Hindu University Campus', 'Banaras Hindu Univer', 0, 1),
(20, 'Bangali Tola', 'Bangali Tola', 0, 1),
(21, 'Shivala', 'Shivala', 0, 1),
(22, 'Sarnath', 'Sarnath', 0, 1),
(23, 'Anandbagh', 'Anandbagh', 0, 1),
(24, 'Birdopur', 'Birdopur', 0, 1),
(25, 'Ghaziabad', 'Ghaziabad', 0, 18),
(26, 'Vaishali', 'Vaishali', 25, 18),
(27, 'Bhelupur', 'Bhelupur', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE IF NOT EXISTS `user_info` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `userid` int(10) NOT NULL,
  `name` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`id`, `userid`, `name`) VALUES
(1, 1, 'Mohit Kumar Gupta'),
(2, 2, 'Superuser');

-- --------------------------------------------------------

--
-- Table structure for table `user_login`
--

CREATE TABLE IF NOT EXISTS `user_login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emailid` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `valid` int(2) NOT NULL DEFAULT '1',
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `user_login`
--

INSERT INTO `user_login` (`id`, `emailid`, `password`, `valid`, `first_name`, `last_name`) VALUES
(1, 'mohit2007gupta@gmail.com', 'd8052f9e09a17e6907629e76bbd261cc', 1, '', ''),
(2, 'superuser', 'd8052f9e09a17e6907629e76bbd261cc', 1, '', ''),
(11, 'mohit@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', 1, 'Bhupi', 'Mohit');

-- --------------------------------------------------------

--
-- Table structure for table `widget`
--

CREATE TABLE IF NOT EXISTS `widget` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `label` varchar(200) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `widget`
--

INSERT INTO `widget` (`id`, `name`, `label`, `description`) VALUES
(1, 'contactinfo', 'ContactInfo', '');

-- --------------------------------------------------------

--
-- Table structure for table `wid_contactinfo`
--

CREATE TABLE IF NOT EXISTS `wid_contactinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `elementId` int(11) NOT NULL,
  `addressLine1` varchar(200) NOT NULL,
  `addressLine2` varchar(200) NOT NULL,
  `placeId` int(11) NOT NULL,
  `countryId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `wid_contactinfo`
--

INSERT INTO `wid_contactinfo` (`id`, `elementId`, `addressLine1`, `addressLine2`, `placeId`, `countryId`) VALUES
(12, 1, 'Line 112', 'Line 223', 4, 99),
(13, 2, '1111', '2222', 0, 0),
(14, 3, '121212', '212121', 0, 0),
(15, 6, 'dsadas', 'sasd', 2, 99),
(16, 7, 'dsadas', 'sasd', 2, 99),
(17, 8, 'dsadas', 'sasd', 2, 99),
(18, 9, 'mohit', 'hello', 1, 99),
(19, 10, 'm', 'h', 5, 99),
(20, 11, 'hhhhhhh', 'hhhhhhhhhhoijko', 1, 99),
(21, 12, 'MOHIT', 'gUPTA', 6, 99),
(22, 14, 'fddsf', 'fdsfdf', 12, 99);

-- --------------------------------------------------------

--
-- Table structure for table `wid_rating_register`
--

CREATE TABLE IF NOT EXISTS `wid_rating_register` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `component_id` int(11) NOT NULL,
  `enable` int(2) NOT NULL DEFAULT '1',
  `last_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `wid_rating_register`
--

INSERT INTO `wid_rating_register` (`id`, `component_id`, `enable`, `last_modified`) VALUES
(1, 1, 1, '2013-11-21 16:13:10'),
(2, 2, 1, '2013-11-21 16:13:10');

-- --------------------------------------------------------

--
-- Table structure for table `wid_review_register`
--

CREATE TABLE IF NOT EXISTS `wid_review_register` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `component_id` int(11) NOT NULL,
  `enable` int(2) NOT NULL DEFAULT '1',
  `last_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `wid_review_register`
--

INSERT INTO `wid_review_register` (`id`, `component_id`, `enable`, `last_modified`) VALUES
(1, 1, 1, '2013-11-21 16:13:28');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
