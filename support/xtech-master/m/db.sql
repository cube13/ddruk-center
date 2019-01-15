-- --------------------------------------------------------
-- Сервер:                       127.0.0.1
-- Server version:               5.6.13-log - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Версія:              8.0.0.4396
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table xtech.tbl_migration
DROP TABLE IF EXISTS `tbl_migration`;
CREATE TABLE IF NOT EXISTS `tbl_migration` (
  `version` varchar(255) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table xtech.tbl_migration: ~16 rows (approximately)
DELETE FROM `tbl_migration`;
/*!40000 ALTER TABLE `tbl_migration` DISABLE KEYS */;
INSERT INTO `tbl_migration` (`version`, `apply_time`) VALUES
	('m000000_000000_base', 1399455895),
	('m140507_090025_organizations', 1399455903),
	('m140507_094700_insert_organization', 1399456317),
	('m140507_112456_branches', 1399463670),
	('m140507_112643_insert_branches', 1399471149),
	('m140507_112959_departmens', 1399471249),
	('m140507_113034_insert_departmens', 1399471249),
	('m140507_113458_cabinets', 1399471249),
	('m140507_113510_insert_cabinets', 1399471249),
	('m140507_141128_employees', 1399473324),
	('m140507_142642_insert_employee', 1399473324),
	('m140507_143643_type_dev', 1399473736),
	('m140507_143657_ins_type_dev', 1399473736),
	('m140508_082448_devices', 1399539187),
	('m140508_083633_device_pc', 1399539187),
	('m140508_114310_users', 1399549639),
	('m140515_070545_ins_dev', 1400138373),
	('m140515_073309_ins_devpc', 1400139386);
/*!40000 ALTER TABLE `tbl_migration` ENABLE KEYS */;


-- Dumping structure for table xtech.t_branches
DROP TABLE IF EXISTS `t_branches`;
CREATE TABLE IF NOT EXISTS `t_branches` (
  `id_branch` int(2) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `id_organization` int(2) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `telephones` varchar(255) DEFAULT NULL,
  `emails` varchar(500) DEFAULT NULL,
  `www` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_branch`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Dumping data for table xtech.t_branches: ~4 rows (approximately)
DELETE FROM `t_branches`;
/*!40000 ALTER TABLE `t_branches` DISABLE KEYS */;
INSERT INTO `t_branches` (`id_branch`, `name`, `id_organization`, `description`, `telephones`, `emails`, `www`, `address`) VALUES
	(2, 'Миру 27', 1, 'Branch on Mira', '40977', 'pfu@i.ua', 'www.pfu.dp.ua', '52501, Sinelnikovo, Mira, 27'),
	(3, 'Енгельса 3а', 1, 'Branch on Engelsa street', '41382', 'pfupp@i.ua', '', '52500, Sinelnikovo, Engelsa, 3a'),
	(6, 'Миру', 4, '', '4-07-90, 4-11-76', 'pfusin54@i.ua', '', '27, вул. Миру, м. Синельникове, Дніпропетровська обл., Україна, 52501'),
	(7, 'Енгельса', 4, '', '4-29-19, 4-30-45, 4-29-87', 'pfusin54@i.ua', '', '3а, вул. Енгельса, м. Синельникове, Дніпропетровська обл., Україна, 52500');
/*!40000 ALTER TABLE `t_branches` ENABLE KEYS */;


-- Dumping structure for table xtech.t_cabinets
DROP TABLE IF EXISTS `t_cabinets`;
CREATE TABLE IF NOT EXISTS `t_cabinets` (
  `id_cabinet` int(2) NOT NULL AUTO_INCREMENT,
  `id_department` int(2) DEFAULT NULL,
  `number` varchar(20) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `telephones` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_cabinet`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- Dumping data for table xtech.t_cabinets: ~15 rows (approximately)
DELETE FROM `t_cabinets`;
/*!40000 ALTER TABLE `t_cabinets` DISABLE KEYS */;
INSERT INTO `t_cabinets` (`id_cabinet`, `id_department`, `number`, `description`, `telephones`) VALUES
	(1, 1, '9a', 'servers room', NULL),
	(2, 1, '9', 'second floor', '4-06-92'),
	(3, 2, '8', 'zagal', '4-11-62'),
	(4, 2, '11', 'zagal nach', '4-06-18'),
	(5, 3, '1', 'цуацуа', ''),
	(7, 6, '9', '', '4-06-92'),
	(8, 7, '15', '', '4-07-90'),
	(9, 8, '15а', '', '4-11-76'),
	(10, 9, '14', '', '4-05-49'),
	(11, 10, '12', '', '4-10-05'),
	(12, 11, '11', '', '4-06-92'),
	(13, 11, '8', '', '4-12-69'),
	(14, 12, '1', '', '4-04-11'),
	(15, 13, '3а', '', '4-05-96'),
	(16, 13, '3', '', '4-05-96');
/*!40000 ALTER TABLE `t_cabinets` ENABLE KEYS */;


-- Dumping structure for table xtech.t_departmens
DROP TABLE IF EXISTS `t_departmens`;
CREATE TABLE IF NOT EXISTS `t_departmens` (
  `id_department` int(2) NOT NULL AUTO_INCREMENT,
  `id_branch` int(2) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `telephones` varchar(255) DEFAULT NULL,
  `emails` varchar(500) DEFAULT NULL,
  `boss` int(2) DEFAULT NULL,
  PRIMARY KEY (`id_department`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- Dumping data for table xtech.t_departmens: ~9 rows (approximately)
DELETE FROM `t_departmens`;
/*!40000 ALTER TABLE `t_departmens` DISABLE KEYS */;
INSERT INTO `t_departmens` (`id_department`, `id_branch`, `name`, `description`, `telephones`, `emails`, `boss`) VALUES
	(1, 2, 'ispz', 'ispz department', '40692', NULL, NULL),
	(2, 2, 'zagal', 'zagal department', '41162', NULL, NULL),
	(3, 3, 'zvern', 'zvern department', '43045', NULL, NULL),
	(6, 6, 'Відділ інформаційних систем та програмного забезпечення', '', '4-06-29', '', 1),
	(7, 6, 'Начальник управління', '', '4-07-90', '', 11),
	(8, 6, 'Приймальня начальника', '', '4-11-76', '', 11),
	(9, 6, 'Перший заступник начальника управління', '', '4-05-49', '', 11),
	(10, 6, 'Юридичний відділ', '', '4-10-05', '', 14),
	(11, 6, 'Загальний відділ', '', '4-06-92', '', 17),
	(12, 6, 'Сектор персоналу', '', '4-04-11', '', NULL),
	(13, 6, 'Відділ виконання бюджету, бухгалтерського обліку та звітності', '', '4-05-96', '', 28);
/*!40000 ALTER TABLE `t_departmens` ENABLE KEYS */;


-- Dumping structure for table xtech.t_devices
DROP TABLE IF EXISTS `t_devices`;
CREATE TABLE IF NOT EXISTS `t_devices` (
  `id_device` int(11) NOT NULL AUTO_INCREMENT,
  `id_employee` int(2) DEFAULT NULL,
  `id_type` int(2) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `inv_number` varchar(10) DEFAULT NULL,
  `sn` varchar(255) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `end_varantly_yesr` int(11) DEFAULT NULL,
  `service` varchar(255) DEFAULT NULL,
  `expluatation` tinyint(1) DEFAULT NULL,
  `expluatation_data` date DEFAULT NULL,
  `private` tinyint(1) DEFAULT NULL,
  `break` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_device`)
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=utf8;

-- Dumping data for table xtech.t_devices: ~78 rows (approximately)
DELETE FROM `t_devices`;
/*!40000 ALTER TABLE `t_devices` DISABLE KEYS */;
INSERT INTO `t_devices` (`id_device`, `id_employee`, `id_type`, `name`, `description`, `inv_number`, `sn`, `year`, `end_varantly_yesr`, `service`, `expluatation`, `expluatation_data`, `private`, `break`) VALUES
	(4, 4, 3, 'asus', 'bad book', '10480098', 'sa1564785112', 2013, 2015, 'asus', 1, '2013-10-16', 0, 0),
	(6, 3, 6, 'zerox a70', 'regergerg', '113113', '22222221111', 2010, 2013, 'rthrtht', 1, '2013-07-31', 0, 0),
	(7, 3, 2, 'bms', 'weqdwefwe', '45345', 'trhtrh', 2014, 2019, 'rthtrhtrh', 1, '2014-07-02', 0, 0),
	(9, 3, 2, 'bms', 'ewfwefwef', '45345', '345345', 2014, 2019, '34t34t', 0, '0000-00-00', 0, 0),
	(20, 3, 2, 'dfgdfg1', 'dfgfg', '1134545', '456456', 2014, 2019, '4564545fbdb', 0, '1970-01-01', 0, 0),
	(22, 2, 1, 'FLATRON LG L 1942 S', '', '1137042', '807NDDM35306', 2008, 2009, '', 1, '2008-01-01', 0, 0),
	(25, 4, 1, '1111111', 'ergeg', '435345', 'ergerg56', 2014, 2019, 'e5hthrth', 1, '2014-09-01', 0, 0),
	(26, 3, 2, 'trhtrh', 'trhrth', '476567', '567567', 2014, 2019, 'tyjtyj', 1, '2014-08-13', 0, 0),
	(27, 4, 1, 'ergeg', 'ggergeerg', '345645645', 'hth 67567', 2014, 2019, 'hrehr', 1, '2014-08-06', 0, 0),
	(28, 1, 2, 'HP', '', '10480124', 'C2C8453VG3', 2009, 2010, '', 1, '2009-01-01', 0, 0),
	(29, 1, 1, 'FLATRON LG L 1942 S', '', '1137041', '807NDVW35319', 2008, 2009, '', 1, '2008-01-01', 0, 0),
	(30, 1, 4, 'Samsung ML 1210', '', '10480121', 'D24010634701665', 2003, 2004, '', 1, '2004-01-01', 0, 0),
	(31, 2, 2, 'Siver Mark C300', '', '10480121', 'D24010634701665', 2006, 2007, '', 1, '2006-01-01', 0, 0),
	(32, 2, 13, 'ScanLide70', '', '1137036', 'QC2-2921-DB03-01', 2008, 2009, '', 1, '2008-01-01', 0, 0),
	(33, 11, 2, 'Grand', '', NULL, '', 2013, 2014, '', 0, '1970-01-01', 1, 0),
	(34, 11, 1, 'Acer v193hqv', '', NULL, '21701287743', 2013, 2014, '', 0, '0000-00-00', 1, 0),
	(35, 11, 7, 'Panasonic KX-NT343', 'Системний телефонний апарат', '10490024', '7IAVB001186', 2010, 2011, '', 1, '2010-01-01', 0, 0),
	(36, 12, 2, 'ВМS', '', '10480021', '301010302002', 1998, 1999, '', 1, '0000-00-00', 0, 0),
	(37, 12, 4, 'НР LaserJet 1022n', '', '10480119', 'VNC3D04197', 2006, 2007, '', 1, '0000-00-00', 0, 0),
	(38, 12, 1, 'Samtron 76E', '', '10480101', 'AV17NDBWC21915W', 2003, 2004, '', 1, '0000-00-00', 0, 0),
	(40, 13, 3, 'LG M1', '', '10480194', 'G09KSDW003890', 2006, 2007, '', 1, '1970-01-01', 0, 0),
	(41, 14, 2, 'ROMA', '', '10480049', '21620976,001-99', 2002, 2003, '', 1, '0000-00-00', 0, 0),
	(42, 14, 1, 'Acer G195HQV', '', '1137132/4', '23500290385', 2012, 2013, '', 1, '1970-01-01', 0, 0),
	(43, 14, 4, 'Samsung ML-1661', '', '1137120', 'Z5BBBKBZAO1980K', 2012, 2013, '', 1, '0000-00-00', 0, 0),
	(44, 14, 6, 'Xerox Canon - FC 108', '', '1137100', 'TTL00583', 2000, 2000, '', 1, '0000-00-00', 0, 0),
	(45, 14, 5, 'Patriot Pro-II 400', '', '10480041', '', 2000, 2000, '', 1, '0000-00-00', 0, 0),
	(46, 16, 2, 'ROMA', '', '10480126', '', 2000, 2000, '', 1, '0000-00-00', 0, 0),
	(47, 16, 1, 'SAMSUNG Sync Master 551 S', '', '10480164', 'AN15HSBW522316M', 2003, 2004, '', 1, '0000-00-00', 0, 0),
	(48, NULL, 2, '№1Book', 'Термінальна станція по факту  Робоча станція №1Book', '10480128', '', 2003, 2004, '', 1, '0000-00-00', 0, 0),
	(49, 17, 2, '№1Book', 'Термінальна станція по факту  Робоча станція №1Book', '10480128', '', 2003, 2004, '', 1, '1970-01-01', 0, 0),
	(50, 17, 1, 'FLATRON LG L 1942 S', '', '1137124/2', '807NDRF1V382', 2008, 2009, '', 1, '0000-00-00', 0, 0),
	(51, 17, 4, 'Samsung SCX 4016 ', '', '10480146', 'B50X400058E', 2000, 2000, '', 1, '0000-00-00', 0, 0),
	(52, 18, 2, 'Liter', 'Термінальна станція  Liter', '10480091', '34711497', 2003, 2004, '', 1, '0000-00-00', 0, 0),
	(53, 18, 1, 'AOC E970Sw', '', '1137136/1', '', 2012, 2013, '', 1, '0000-00-00', 0, 0),
	(54, 19, 2, 'BMS ', '', '10480187', '', 2000, 2000, '', 1, '0000-00-00', 0, 0),
	(55, 19, 14, 'Panasonic KX-F982', '', '1137141', '3CAFP056332', 2000, 2000, '', 1, '0000-00-00', 0, 0),
	(56, 19, 4, 'HP Lazer 1020', '', '1137117', 'CNC2B96599', 2006, 2007, '', 1, '0000-00-00', 0, 0),
	(57, 19, 1, 'Wiewsonic', 'Особисто працівника', '', '', 2006, 2007, '', 0, '0000-00-00', 1, 0),
	(58, 20, 2, 'Silver Mark С-300', '', '10480122', 'D24010634702534', 2006, 2007, '', 1, '0000-00-00', 0, 0),
	(59, 20, 1, 'AOC e950swnk', '', '', '', 2013, 2014, '', 0, '0000-00-00', 1, 0),
	(60, 20, 4, 'Lexmark X5150', '', '10480107', '9330632833', 2004, 2005, '', 1, '0000-00-00', 0, 0),
	(61, 20, 4, 'Sumsung ML -2165', '', '1137133/2', 'Z7B0138GCAF00NMK', 2012, 2013, '', 1, '0000-00-00', 0, 0),
	(62, 20, 1, 'Acer GD157P', '', '10480025', '8905002334', 1999, 2000, '', 1, '0000-00-00', 0, 0),
	(63, 21, 1, 'Samtron 76 DF', '', '10480191', 'AN17AHGEW400052Y', 2003, 2004, '', 1, '0000-00-00', 0, 0),
	(64, 21, 2, 'BMS', '', '10480064', '30101301404', 2001, 2002, '', 1, '0000-00-00', 0, 0),
	(65, 21, 4, 'Epson LX-300+', '', '10480067', 'C29412005L101220342', 2000, 2000, '', 1, '0000-00-00', 0, 0),
	(66, 22, 2, 'ПК Folgat', '', '10480069', 'DT15HJEN600853H', 2003, 2004, '', 1, '0000-00-00', 0, 0),
	(67, 22, 1, 'Samsung SuncMaster 793 DF', '', '1137023', 'LB17HMAY911346T', 2005, 2006, '', 1, '0000-00-00', 0, 0),
	(68, 23, 2, 'ПК Совинтех ', '', '10480114', '20230995,001-99', 2004, 2005, '', 1, '0000-00-00', 0, 0),
	(69, 23, 1, 'Samsung SAMATRON 76 E', '', '', '', 2000, 2000, '', 0, '0000-00-00', 1, 0),
	(70, 23, 1, 'AOC E970Sw', '', '1137136/2', 'FPKD7HA041803', 2013, 2014, '', 1, '0000-00-00', 0, 0),
	(71, 23, 4, 'Samsung - ML 1661', '', '1137046', 'Z5BBBKBZA01897N', 2010, 2011, '', 1, '0000-00-00', 0, 0),
	(72, 23, 5, 'SINАPSE 5101-525', '', '1137016/2', 'M71543F021132-B', 2000, 2000, '', 1, '0000-00-00', 0, 0),
	(73, 24, 2, 'ПК Roma', 'Не в мережі. Для системи Клієнт-банк', '10480071', '', 2003, 2004, '', 1, '0000-00-00', 0, 0),
	(74, 24, 1, 'Sumsung SuncMaster 550b', '', '10480207', 'LB17HMAY911346T', 2002, 2003, '', 1, '0000-00-00', 0, 0),
	(75, 24, 4, 'Sumsung ML -2165', '', '1137133/3', 'Z7BOB8GLAF00QCA', 2012, 2013, '', 1, '0000-00-00', 0, 0),
	(76, 25, 2, 'Термінальна станція', '', '10480131', '3471162', 2004, 2005, '', 1, '0000-00-00', 0, 0),
	(77, 25, 1, 'SyncMaster753DFX', '', '10480105', 'CZC8453XGH', 2003, 2004, '', 1, '0000-00-00', 0, 0),
	(78, 26, 2, 'ПК Roma', '', '10480234', '191113-3-41', 2013, 2014, 'Roma', 1, '0000-00-00', 0, 0),
	(79, 26, 1, 'Wievsonic VA1911a -LED', '', '1137135/2', 'T6N132303828', 2013, 2014, '', 1, '0000-00-00', 0, 0),
	(80, 27, 2, 'HP Compaq', '', '10480202', 'AN17HMAWA22312M', 2009, 2010, '', 1, '0000-00-00', 0, 0),
	(81, 27, 1, 'Acer G195 HQV', '', '1137132/1', 'ETLPB0D02123500B6B8509', 2012, 2013, '', 1, '0000-00-00', 0, 0),
	(82, 27, 4, 'HP Lazer JET 1020', '', '1137034', 'CNC2635372', 2007, 2008, '', 1, '0000-00-00', 0, 0),
	(83, 28, 2, 'ВМS ', '', '10480058', '', 2002, 2003, '', 1, '1970-01-01', 0, 0),
	(84, 28, 1, 'Wievsonic VA1911a -LED', '', '1137135/1', 'T6N132303454', 2013, 2014, '', 1, '0000-00-00', 0, 0),
	(85, 28, 5, 'APC-650', '', '10480047', '', 2001, 2002, '', 1, '0000-00-00', 0, 0),
	(86, 28, 6, 'Canon FC 208', '', '10480093', 'TTE70617', 2000, 2000, '', 1, '0000-00-00', 0, 0),
	(87, 28, 14, 'Panasonic KX-FT78', '', '10490006', 'PFGT2072XA', 2000, 2000, '', 1, '0000-00-00', 0, 0),
	(88, 3, 10, 'faerr', 'erwwefwefwef', '34234', 'wewfw34324523', 2014, 2019, 'sefef', 0, '0000-00-00', 0, 0),
	(89, 3, 1, 'trhrth', 'dfdb', '5465', 'dbdfb', 2014, 2019, 'dfbdfb', 0, '0000-00-00', 0, 0),
	(90, 3, 1, 'gregr', 'ergg', '34535', 'eggre', 2014, 2019, 'ergerg', 0, '0000-00-00', 0, 0),
	(91, 4, 1, 'dfhdfh', 'df', '456456', 'dhfh', 2014, 2019, 'dfdb', 0, '0000-00-00', 0, 0),
	(92, 3, 1, 'ergerg', '', '345345345', 'gsgwerger', 2014, 2019, 'efwef', 0, '0000-00-00', 0, 0),
	(93, 3, 1, 'fgnfgn', '', '35435', 'dfgdfg', 2014, 2019, 'dfg', 0, '0000-00-00', 0, 0),
	(94, 3, 1, 'rtrthtrh', '', '3454535', 'rthrht', 2014, 2019, '', 0, '0000-00-00', 0, 0),
	(95, 3, 1, 'wefwef', '', '435345', 'rgerg', 2014, 2019, 'erg', 0, '0000-00-00', 0, 0),
	(96, 3, 1, 'rthtrh', '', '564645', '45gergerg', 2014, 2019, 'erg', 0, '0000-00-00', 0, 0),
	(97, 3, 1, 'trtrtrtrtraaaaaaahhh', '', '123123', 'regerg', 2014, 2019, '', 0, '0000-00-00', 0, 0);
/*!40000 ALTER TABLE `t_devices` ENABLE KEYS */;


-- Dumping structure for table xtech.t_devices_types
DROP TABLE IF EXISTS `t_devices_types`;
CREATE TABLE IF NOT EXISTS `t_devices_types` (
  `id_device_type` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_device_type`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- Dumping data for table xtech.t_devices_types: ~12 rows (approximately)
DELETE FROM `t_devices_types`;
/*!40000 ALTER TABLE `t_devices_types` DISABLE KEYS */;
INSERT INTO `t_devices_types` (`id_device_type`, `name`, `description`) VALUES
	(1, 'Монітор', ''),
	(2, 'Системний блок', ''),
	(3, 'Ноутбук', 'description of monitors'),
	(4, 'Принтер', 'description of monitors'),
	(5, 'ДБЖ', 'description of monitors'),
	(6, 'Копіювальний апарат', 'description of monitors'),
	(7, 'Телефонний апарат', 'description of monitors'),
	(8, 'Хаб', 'description of monitors'),
	(9, 'Свіч', 'description of monitors'),
	(10, 'Модем', 'description of monitors'),
	(11, 'Клавіатура', 'description of monitors'),
	(12, 'Маніпулятор миша', 'description of monitors'),
	(13, 'Сканер', ''),
	(14, 'Факс', '');
/*!40000 ALTER TABLE `t_devices_types` ENABLE KEYS */;


-- Dumping structure for table xtech.t_device_pc
DROP TABLE IF EXISTS `t_device_pc`;
CREATE TABLE IF NOT EXISTS `t_device_pc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_device_pc` int(11) DEFAULT NULL,
  `mb` varchar(255) DEFAULT NULL,
  `cpu_name` varchar(255) DEFAULT NULL,
  `cpu_p` double DEFAULT NULL,
  `hdd_name` varchar(255) DEFAULT NULL,
  `hdd_p` double DEFAULT NULL,
  `ram_name` varchar(255) DEFAULT NULL,
  `ram_p` double DEFAULT NULL,
  `video_name` varchar(255) DEFAULT NULL,
  `video_p` int(11) DEFAULT NULL,
  `cdrom_name` varchar(255) DEFAULT NULL,
  `lan_name` varchar(255) DEFAULT NULL,
  `os` varchar(255) DEFAULT NULL,
  `net_name` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_t_device_pc_t_devices` (`id_device_pc`),
  CONSTRAINT `FK_t_device_pc_t_devices` FOREIGN KEY (`id_device_pc`) REFERENCES `t_devices` (`id_device`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- Dumping data for table xtech.t_device_pc: ~22 rows (approximately)
DELETE FROM `t_device_pc`;
/*!40000 ALTER TABLE `t_device_pc` DISABLE KEYS */;
INSERT INTO `t_device_pc` (`id`, `id_device_pc`, `mb`, `cpu_name`, `cpu_p`, `hdd_name`, `hdd_p`, `ram_name`, `ram_p`, `video_name`, `video_p`, `cdrom_name`, `lan_name`, `os`, `net_name`, `ip`) VALUES
	(2, 20, 'dfgdfg', 'dfgfdg', 44, 'dfg', 456, 'dfgdfg', 34, 'dfgg', 45, 'dfg', 'gdf', 'dfg', 'd', '___.___.___.___'),
	(3, 26, 'tyjtyj', 'tyj', 6, '', NULL, '', NULL, '', NULL, '', '', '', '', ''),
	(4, 28, 'HP Compaq dx2400', 'DualCore Intel Celeron E1200', 1.6, 'WDC WD1600AAJS-60B4A0', 149, '', 2048, 'Intel(R) G33/G31 Express Chipset Family ', 384, 'ATAPI DVD D  DH16D3S', 'Realtek RTL8168C(P)/8111C(P) PCI-E Gigabit Ethernet NIC', 'Microsoft Windows XP Professional 5.1.2600 SP 2', 'nach-ispz', '170.40.96.163'),
	(5, 31, 'ECS 915GV-M2', 'Intel Celeron D 346', 3, 'SAMSUNG HD080HJ', 80, '', 1024, 'NVIDIA GeForce 210 ', 1024, '', 'Realtek RTL8139/810x Family Fast Ethernet NIC ', 'Microsoft Windows XP Professional 5.1.2600 (WinXP RTM)', 'spec-ispz', '172.40.96.3'),
	(6, 33, 'Не визначено', 'AMD Sempron ', 2, 'WDC WD 1600AAJB', 150, 'Не визначено', 2048, 'nVidia nForce 7025 630a', NULL, 'Відсутня', 'nVidia nForce 10/100 Mb', 'Microsoft Windows XP Professional 5.1.2600', 'ED_OKNO-1', '170.40.96.76'),
	(7, 36, 'Gigabyte GA-6VXE7+', 'Intel Celeron', 0.6, 'SAMSUNG SV0511D ', 4, 'Не визначено', 512, 'S3 Inc. Trio3D/2X', 4, 'Відсутня', 'Realtek RTL8139/810x Family Fast Ethernet NIC', 'Microsoft Windows XP Professional 5.1.2600', 'PRUIOMNAYA_NACH', '172.45.96.45'),
	(8, 40, 'Не визначено', 'Не визначено', 1.6, 'FUJITSU MHV2060AT PL', 60, 'Не визначено', 512, 'Mobile Intel(R) 945 Express Chipset Family', 128, 'HL-DT-ST DVDRAM GSA-4082N', 'Agere Systems ET-131x PCI-E Gigabit Ethernet Controller', 'Microsoft Windows XP Professional 5.1.2600', 'Kuprin', '172.40.96.25'),
	(9, 41, 'Soltek i815 Motherboard', 'Intel Celeron-S', 1.1, 'SAMSUNG SP0812N', 80, 'Не визначено', 192, 'RAGE 128 PRO Ultra GL AGP', NULL, 'Відсутня', 'Realtek RTL8139 Family PCI Fast Ethernet NIC', 'Microsoft Windows XP Professional 5.1.2600', 'YURIST', '172.40.96.5'),
	(10, 46, 'Gigabyte GA-6VXE7+', 'Intel Celeron', 0.6, 'SAMSUNG SV0511D', 4, 'Не визначено', 272, 'RAGE 128 PRO AGP 4X TMDS', NULL, 'Відсутня', 'Acer ALN-330 10/100 PCI Fast Ethernet адаптер', 'Microsoft Windows XP Professional 5.1.2600', 'Yur_spec', '172.40.96.46'),
	(11, 48, 'MSI MS-6535', 'Intel Pentium 4', 4.2, 'SAMSUNG SV4002H', 40, 'Не визначено', 512, 'SiS 650_651_M650_740', 32, 'SAMSUNG CD-ROM SC-152A', 'Realtek RTL8139/810x Family Fast Ethernet NIC', 'Microsoft Windows XP Professional 5.1.2600', 'NACH_ZAGALNUU', '172.40.96.164'),
	(12, 49, 'MSI MS-6535', 'Intel Pentium 4', 2.4, 'SAMSUNG SV4002H', 40, 'Не визначено', 512, 'SiS 650_651_M650_740', 32, 'SAMSUNG CD-ROM SC-152A', 'Realtek RTL8139/810x Family Fast Ethernet NIC', 'Microsoft Windows XP Professional 5.1.2600', 'NACH_ZAGALNUU', '172.40.96.164'),
	(13, 52, 'PCChips M810DLU', 'AMD Duron', 0.8, 'SAMSUNG SV4002H', 40, 'Не визначено', 256, 'SiS 650_651_M650_M652_740', 32, 'Відсутня', 'SiS 900 PCI Fast Ethernet Adapter', 'Microsoft Windows XP Professional 5.1.2600', 'ZAIKA', '172.40.96.137'),
	(14, 54, 'Chaintech 6EPA2/6ESA(2)/6ESV/6LIA/6LTL/6LTM(2)/6LTS', 'Intel Celeron-A', 0.4, 'GENERIC IDE  DISK TYPE47 ', 4, 'Не визначено', 64, 'RAGE IIC AGP', NULL, 'Відсутня', 'Realtek RTL8139/810x Family Fast Ethernet NIC', 'Microsoft Windows 98 SE 4.10.2222A (Win98 SE)', 'Zagalnui', '172.40.96.170'),
	(15, 58, 'ECS 915GV-M2', 'Intel Celeron D 346', 3, 'SAMSUNG HD080HJ', 80, 'Не визначено', 512, 'Intel GMA 900', NULL, 'NEC CD-ROM CD-3002C', 'Realtek RTL8139/810x Family Fast Ethernet NIC', 'Microsoft Windows XP Professional 5.1.2600', 'zav_personalom', '172.40.96.31'),
	(16, 64, 'Gigabyte GA-6VXE7+', 'Intel Celeron', 0.6, 'Не визначено', 4, 'Не визначено', 128, 'RAGE 128 ULTRA', NULL, 'Не визначено', 'Realtek 8139-series PCI NIC', 'Microsoft Windows 98 SE 4.10.2222A', 'spec_personal', '170.40.96.179'),
	(17, 66, 'Asus TUSI-M', 'Intel Celeron-S', 1.2, 'SAMSUNG SV2011H', 20, 'Не визначено', 128, 'SiS 300/305/630/540/730', NULL, 'Відсутня', 'SiS 900 PCI Fast Ethernet Adapter', 'Microsoft Windows XP Professional 5.1.2600', 'BUH_BUDGET2', '172.40.96.134'),
	(18, 68, 'Asus P4S8X-MX', 'Intel Celeron D 325', 2.5, 'SAMSUNG SP0822N', 80, 'Не визначено', 256, 'SiS 661 series', 32, 'HL-DT-ST CD-ROM GCR-8522B', 'SiS 900-Based PCI Fast Ethernet Adapter', 'Microsoft Windows XP Professional 5.1.2600', 'BUH_BUDGET1', '172.40.96.149'),
	(19, 73, 'MSI MS-6534', 'Intel Celeron', 1.8, 'Не визначено', 40, 'Не визначено', 128, 'NVIDIA GeForce2 MX/MX 400', 32, 'SAMSUNG CD-ROM SC-152A ', 'Realtek RTL8139/810x Family Fast Ethernet NIC', 'Microsoft Windows XP Professional 5.1.2600', 'Не визначено', '___.___.___.___'),
	(20, 76, 'PCChips M810DLU', 'AMD Duron', 0.8, 'Не визначено', 10, 'Не визначено', 352, 'SiS 650_651_M650_M652_740 ', 32, 'Відсутня', 'SiS 900 PCI Fast Ethernet Adapter ', 'Microsoft Windows XP Professional 5.1.2600', 'buh_aparat', '172.40.96.138'),
	(21, 78, 'AMD A75', 'AMD A4-4000', 3, 'TOSHIBA DT01ACA050 SATA', 500, 'Не визначено', 2048, 'AMD Radeon HD 7480D', 512, 'Не визначено', 'Realtek PCIe GBE Family Controller', 'Microsoft Windows 7 Professional 6.1.7601', 'BUH_ZP', '172.40.96.19'),
	(22, 80, 'HP Compaq dx2400', 'DualCore Intel Celeron E1200', 1.6, 'WDC WD1600AAJS-60B4A0', 150, 'Не визначено', 512, 'Intel(R) G33/G31 Express Chipset Family  ', 256, 'Відсутня', 'Realtek RTL8168C(P)/8111C(P) PCI-E Gigabit Ethernet NIC', 'Microsoft Windows XP Professional 5.1.2600', 'ZAM_BUH', '172.40.96.18'),
	(23, 83, 'MSI MS-6526GL', 'Intel Celeron', 1.7, 'SAMSUNG SV0602H', 60, 'Не визначено', 256, 'Intel(R) 82845G/GL/GE/PE/GV Graphics Controller', 64, 'Відсутня', 'Realtek RTL8139/810x Family Fast Ethernet NIC', 'Microsoft Windows XP Professional 5.1.2600', 'GLOV_BUH', '172.40.96.143');
/*!40000 ALTER TABLE `t_device_pc` ENABLE KEYS */;


-- Dumping structure for table xtech.t_employees
DROP TABLE IF EXISTS `t_employees`;
CREATE TABLE IF NOT EXISTS `t_employees` (
  `id_employee` int(11) NOT NULL AUTO_INCREMENT,
  `id_cabinet` int(2) DEFAULT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `telephones` varchar(255) DEFAULT NULL,
  `post` varchar(255) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `login` varchar(50) DEFAULT NULL,
  `tab_number` int(10) DEFAULT NULL,
  `home_address` varchar(255) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `pasp` varchar(255) DEFAULT NULL,
  `fired` tinyint(1) DEFAULT NULL,
  `dof` date DEFAULT NULL,
  PRIMARY KEY (`id_employee`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

-- Dumping data for table xtech.t_employees: ~26 rows (approximately)
DELETE FROM `t_employees`;
/*!40000 ALTER TABLE `t_employees` DISABLE KEYS */;
INSERT INTO `t_employees` (`id_employee`, `id_cabinet`, `firstname`, `lastname`, `surname`, `description`, `telephones`, `post`, `email`, `login`, `tab_number`, `home_address`, `dob`, `pasp`, `fired`, `dof`) VALUES
	(1, 7, 'Галушко', 'Дмитро', 'Олександрович', 'cool men', '38(066)4297689', NULL, 'sinelnikovodima@mail.ru', 'jazzz', 37, '26/27, вул. Миру, м. Синельникове, Дніпропетровська обл., Україна, 52501', '1983-05-04', 'AK 833702', 0, '1970-01-01'),
	(2, 7, 'Монах ', 'Олександр', 'Васильович', '', '38(099)2161987', NULL, '', '', NULL, '', '1970-01-01', '', 0, '1970-01-01'),
	(3, 3, 'Zaika', 'Lil', 'Sergo', 'girl', '05648548545', NULL, 'mail@mail.ru', 'lilo', 333, 'USSR', '2014-01-09', 'AK 156156', 0, '1970-01-01'),
	(4, 4, 'Reutova', 'Luda', 'Oleksandrovich', 'the', '0664297689', NULL, 'luda@mail.ru', 'reut', 4444, 'USSR', '1983-04-05', 'AK 156156', 0, NULL),
	(5, NULL, 'a', 'b', 'c', '', '', NULL, '', '', NULL, '', '2014-08-09', '', 0, '1970-01-01'),
	(6, NULL, 'aa', 'bb', 'cc', '', '', NULL, '', '', NULL, '', '2014-07-07', '', 0, '2014-09-03'),
	(7, 3, 'John', 'Ivan', 'Petrovich', '', '', '', '', '', NULL, '', '0000-00-00', '', 0, '0000-00-00'),
	(8, 5, 'йцвйц', 'йцвйц', 'йцвйцв', '', '', '', '', '', NULL, '', '0000-00-00', '', 0, '0000-00-00'),
	(9, NULL, 'кккккккккккккк', 'ккккккккккккккк', 'кккккккккккккккк', 'впвап', '', '', '', '', NULL, '', '1970-01-01', '', 0, '1970-01-01'),
	(10, NULL, 'zcsa', 'ascas', 'ascasc', 'ascasc', '3453', NULL, '', 'sdfgsdf', 345345345, '', '0000-00-00', 'df 34545', 0, '0000-00-00'),
	(11, 8, 'Турченюк', 'Сергій', 'Леонідович', '', '4-07-90', NULL, '', '', 1, '', '0000-00-00', '', 0, '0000-00-00'),
	(12, 9, 'Мітаревська', 'Вікторія', 'Валентинівна', 'Секретар керівника', '4-11-76, 3-72-98, 066-645-22-26', NULL, '', '', NULL, '', '0000-00-00', '', 0, '0000-00-00'),
	(13, 10, 'Купрін ', 'Олександр ', 'Васильович', '', '4-05-49, 050-842-75-61', NULL, '', '', NULL, '', '0000-00-00', '', 0, '0000-00-00'),
	(14, 11, 'Подоляк', 'Тетяна', 'Юріївна', '', '4-10-05, 093-920-82-30', NULL, '', '', NULL, '', '0000-00-00', '', 0, '0000-00-00'),
	(16, 11, 'Кривонос', 'Наталя ', 'Олександрівна', '', '4-10-05,4-11-00,097-581-18-87', NULL, '', '', NULL, '', '0000-00-00', '', 0, '0000-00-00'),
	(17, 12, 'Реутова', 'Людмила', 'Олександрівна', '', '4-06-92,4-13-43,050-153-40-88,097-409-13-31', NULL, '', '', NULL, '', '0000-00-00', '', 0, '0000-00-00'),
	(18, 13, 'Заїка', 'Лілія', 'Сергіївна', '', '4-12-69,4-40-64,067-593-36-27', NULL, '', '', NULL, '', '0000-00-00', '', 0, '0000-00-00'),
	(19, 13, 'Погорєлова', 'Юлія', 'Євгеніївна', '', '4-12-69,3-93-21,095-670-01-70', NULL, '', '', NULL, '', '0000-00-00', '', 0, '0000-00-00'),
	(20, 14, 'Красько', 'Ольга', 'Олександрівна', '', '4-04-11,63-1-00,067-181-91-92,063-042-62-16', NULL, '', '', NULL, '', '0000-00-00', '', 0, '0000-00-00'),
	(21, 14, 'Донковцева', 'Вероніка', 'Сергіївна', '', '4-04-11,4-14-64,099-07-31-624', NULL, '', '', NULL, '', '0000-00-00', '', 0, '0000-00-00'),
	(22, 15, 'Золотухіна', 'Ірина', 'Семенівна', '', '', NULL, '', '', NULL, '', '0000-00-00', '', 0, '0000-00-00'),
	(23, 15, 'Григорчук', 'Вєста', 'Олександрівна', '', '', NULL, '', '', NULL, '', '0000-00-00', '', 0, '0000-00-00'),
	(24, 16, 'Клієнт-Банк', 'Клієнт-Банк', 'Клієнт-Банк', '', '', NULL, '', '', NULL, '', '0000-00-00', '', 0, '0000-00-00'),
	(25, 16, 'Померанцева', 'Світлана', 'Миколаївна', '', '4-05-96,097-843-17-65', NULL, '', '', NULL, '', '0000-00-00', '', 0, '0000-00-00'),
	(26, 16, 'Довбня', 'Яна', 'Валеріївна', '', '4-05-96,4-14-06,093-685-18-37', NULL, '', '', NULL, '', '0000-00-00', '', 0, '0000-00-00'),
	(27, 16, 'Філончук', 'Тетяна', 'Петрівна', '', '4-05-96,050-481-02-58', NULL, '', '', NULL, '', '0000-00-00', '', 0, '0000-00-00'),
	(28, 16, 'Петручик', 'Ірина', 'Анатоліївна', '', '4-05-96,4-72-37,066-889-71-15', NULL, '', '', NULL, '', '0000-00-00', '', 0, '0000-00-00');
/*!40000 ALTER TABLE `t_employees` ENABLE KEYS */;


-- Dumping structure for table xtech.t_log
DROP TABLE IF EXISTS `t_log`;
CREATE TABLE IF NOT EXISTS `t_log` (
  `id_log` int(10) NOT NULL AUTO_INCREMENT,
  `id_device` int(10) NOT NULL,
  `date` datetime NOT NULL,
  `change` varchar(1024) NOT NULL,
  PRIMARY KEY (`id_log`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- Dumping data for table xtech.t_log: ~12 rows (approximately)
DELETE FROM `t_log`;
/*!40000 ALTER TABLE `t_log` DISABLE KEYS */;
INSERT INTO `t_log` (`id_log`, `id_device`, `date`, `change`) VALUES
	(2, 6, '2014-09-18 13:09:23', 'Змінено Назва з zerox a68 на zerox a69'),
	(3, 6, '2014-09-18 13:09:01', 'Змінено Інв. номер з 2147483647 на 10425648'),
	(4, 6, '2014-09-18 13:27:40', 'Змінено Назва з zerox a69 на zerox a70'),
	(5, 6, '2014-09-18 13:28:20', 'Змінено Серійний номер з 456456456 на 111122222'),
	(6, 6, '2014-09-18 13:28:20', 'Змінено Рік випуску з 2012 на 2010'),
	(7, 6, '2014-09-18 13:29:10', 'Змінено Інв. номер з 10425648 на 113113'),
	(8, 6, '2014-09-18 13:29:10', 'Змінено Серійний номер з 111122222 на 2222222'),
	(9, 6, '2014-09-18 13:53:23', 'Змінено Серійний номер з 2222222 на 22222221111'),
	(10, 97, '2014-09-18 14:12:21', 'Створено новий пристрій Монітор - trtrtrtrtraaaaaaahhh. Співробітник Zaika, інвентарний №123123'),
	(11, 20, '2014-09-18 15:42:50', 'Змінено Назва з dfgdfg на dfgdfg1'),
	(12, 20, '2014-09-18 15:42:50', 'Змінено Дата введення в експлуатацію з 0000-00-00 на 1970-01-01'),
	(13, 20, '2014-09-18 15:44:00', 'Змінено Інв. номер з 56456 на 1134545');
/*!40000 ALTER TABLE `t_log` ENABLE KEYS */;


-- Dumping structure for table xtech.t_organizations
DROP TABLE IF EXISTS `t_organizations`;
CREATE TABLE IF NOT EXISTS `t_organizations` (
  `id_organization` int(2) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `telephones` varchar(255) DEFAULT NULL,
  `emails` varchar(500) DEFAULT NULL,
  `www` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `boss` int(10) DEFAULT NULL,
  `buh` int(10) DEFAULT NULL,
  `okpo` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_organization`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Dumping data for table xtech.t_organizations: ~3 rows (approximately)
DELETE FROM `t_organizations`;
/*!40000 ALTER TABLE `t_organizations` DISABLE KEYS */;
INSERT INTO `t_organizations` (`id_organization`, `name`, `description`, `telephones`, `emails`, `www`, `address`, `boss`, `buh`, `okpo`) VALUES
	(1, 'УПФУ в м. Синельниковому та Синельниківському районі', 'Pens fond of Ukraine is very big big big organization111111111', '0664297689, 40692, 40429', 'pfumail44@mail.com', 'http://www.pfusin.gov.ua', '52500, Sinelnikovo, Mira, 27', 3, 2, '15646761'),
	(4, 'Управління Пенсійного фонду України в м. Синельниковому та Синельниківському районі', '', '4-07-90, 4-11-76, 4-29-19', 'pfusin54@i.ua', '', '27, вул.Миру, м.Синельникове, Дніпропетровська обл., 52501', 11, NULL, '37741841');
/*!40000 ALTER TABLE `t_organizations` ENABLE KEYS */;


-- Dumping structure for table xtech.t_users
DROP TABLE IF EXISTS `t_users`;
CREATE TABLE IF NOT EXISTS `t_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(128) DEFAULT NULL,
  `password` varchar(128) DEFAULT NULL,
  `salt` varchar(128) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `profile` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table xtech.t_users: ~1 rows (approximately)
DELETE FROM `t_users`;
/*!40000 ALTER TABLE `t_users` DISABLE KEYS */;
INSERT INTO `t_users` (`id`, `username`, `password`, `salt`, `email`, `profile`) VALUES
	(1, 'admin', 'admin', NULL, '', NULL);
/*!40000 ALTER TABLE `t_users` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
