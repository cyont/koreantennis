-- phpMyAdmin SQL Dump
-- version 2.6.4-pl3
-- http://www.phpmyadmin.net
-- 
-- Host: db2855.perfora.net
-- Generation Time: Nov 17, 2011 at 11:26 AM
-- Server version: 5.0.91
-- PHP Version: 5.3.3-7+squeeze3
-- 
-- Database: `db361004340`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `pics`
-- 

DROP TABLE IF EXISTS `pics`;
CREATE TABLE `pics` (
  `id` int(190) NOT NULL auto_increment,
  `caption` varchar(1000) NOT NULL default '',
  `descc` varchar(4000) NOT NULL default '',
  `img` varchar(190) NOT NULL default '',
  `width_big` smallint(6) default NULL,
  `height_big` smallint(6) default NULL,
  `width_small` smallint(6) default NULL,
  `height_small` smallint(6) default NULL,
  `hits` smallint(4) NOT NULL default '0',
  `date_uploaded` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=231 DEFAULT CHARSET=latin1 AUTO_INCREMENT=231 ;

-- 
-- Dumping data for table `pics`
-- 

INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (118, '&#44608;&#54805;&#49688;', '', 'CIMG1090_20849.JPG', 800, 598, 150, 112, 119, '2010-01-22 00:00:00');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (119, '&#51221;&#50896;&#54840; & &#51060;&#49464;&#54984;', '', 'CIMG1102_21002.JPG', 800, 521, 150, 97, 114, '2010-01-22 00:00:00');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (120, '&#44608;&#54620;&#50857; & &#44608;&#54805;&#49688;', '', 'CIMG1119_21234.JPG', 800, 547, 150, 102, 115, '2010-01-22 00:00:00');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (121, '&#44608;&#51456;&#44508; & &#51060;&#49464;&#54984;', '', 'CIMG1131_21314.JPG', 786, 540, 150, 103, 124, '2010-01-22 00:00:00');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (122, '&#51221;&#50896;&#54840; & &#52572;&#51116;&#54840;', '', 'CIMG1135_21342.JPG', 800, 563, 150, 105, 110, '2010-01-22 00:00:00');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (123, '&#51221;&#50896;&#54840;', '', 'CIMG1136_21358.JPG', 640, 480, 150, 112, 127, '2010-01-22 00:00:00');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (124, '&#44608;&#54620;&#50857; & &#52572;&#51116;&#54840; & &#51221;&#50896;&#54840;', '', 'CIMG1141_21442.JPG', 640, 480, 150, 112, 127, '2010-01-22 00:00:00');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (125, '&#51109;&#44221;&#47329;', '', 'CIMG1186_21458.JPG', 600, 800, 150, 150, 127, '2010-01-22 00:00:00');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (126, '&#51221;&#50896;&#54840;', '', 'CIMG1198_21532.JPG', 600, 800, 112, 150, 127, '2010-01-22 00:00:00');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (127, '&#44608;&#54805;&#52384;', '', 'CIMG1201_21557.JPG', 600, 800, 112, 150, 99, '2010-01-22 00:00:00');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (128, '&#44608;&#54620;&#50857;', '', 'CIMG1202_21612.JPG', 600, 800, 112, 150, 121, '2010-01-22 00:00:00');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (129, '&#44608;&#49437;&#54980;', '', 'CIMG1203_21638.JPG', 600, 800, 112, 150, 127, '2010-01-22 00:00:00');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (130, '&#51060;&#49464;&#54984;', '', 'CIMG1209_21655.JPG', 600, 800, 112, 150, 126, '2010-01-22 00:00:00');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (131, '&#44608;&#49437;&#54980; & &#44608;&#54805;&#52384;', '', 'CIMG1441_225320.JPG', 800, 600, 150, 112, 112, '2010-02-02 22:53:21');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (132, '&#51221;&#50896;&#54840; & &#52572;&#51116;&#54840;', '', 'CIMG1442_225422.JPG', 800, 600, 150, 112, 99, '2010-02-02 22:54:23');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (133, '&#44608;&#51456;&#44508; & Abhi Nair', '&#44608;&#51456;&#44508; & Abhi Nair', 'CIMG1444_225505.JPG', 800, 600, 150, 112, 106, '2010-02-02 22:55:05');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (134, 'Abhi Nair & &#44608;&#51456;&#44508;', '', 'CIMG1454_225550.JPG', 800, 600, 150, 112, 123, '2010-02-02 22:55:50');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (135, '&#49436;&#52397;&#47564; & &#44608;&#54620;&#50857;', '', 'CIMG1458_225609.JPG', 800, 600, 150, 112, 127, '2010-02-02 22:56:09');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (136, 'John Laurie', '', 'CIMG1475_152332.JPG', 800, 713, 150, 133, 127, '2010-02-06 15:23:33');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (137, '&#44608;&#54805;&#49688;', '', 'CIMG1479_152351.JPG', 800, 600, 150, 112, 122, '2010-02-06 15:23:51');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (138, '3060;1464;6984; & 3221;2896;6840;', '', 'CIMG1495_152421.JPG', 800, 571, 150, 107, 127, '2010-02-06 00:00:00');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (139, '&#49436;&#50689;&#50864;', '', 'CIMG0063_101138.JPG', 800, 600, 150, 112, 127, '2010-04-17 10:11:38');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (140, '&#44608;&#48124;&#49688;', '', 'CIMG0064_101223.JPG', 800, 600, 150, 112, 127, '2010-04-17 10:12:24');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (141, '&#49436;&#50689;&#50864; & &#44608;&#54805;&#49688; & &#51060;&#51116;&#44221;', '', 'CIMG0065_101252.JPG', 800, 600, 150, 112, 127, '2010-04-17 10:12:52');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (142, '&#54889;&#50857;&#54984; & &#44608;&#51456;&#44508;', '', 'CIMG0071_101341.JPG', 800, 600, 150, 112, 127, '2010-04-17 10:13:42');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (143, '&#54889;&#50857;&#54984;', '', 'CIMG0073_101533.JPG', 800, 600, 150, 112, 126, '2010-04-17 10:15:33');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (144, '&#44608;&#51456;&#44508;', '', 'CIMG0074_101615.JPG', 800, 688, 150, 129, 127, '2010-04-17 10:16:15');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (145, '&#50980;&#44592;&#50672;', '', 'CIMG0075_101635.JPG', 800, 600, 150, 112, 124, '2010-04-17 10:16:35');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (146, '&#51228; 2&#54924; &#54620;&#51064;&#54924;&#51109;&#48176; &#53580;&#45768;&#49828; &#45824;&#54924;', '', 'IMG_6149_155829.JPG', 800, 533, 150, 99, 127, '2010-05-01 15:58:29');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (147, '&#51312;&#54805;&#49437; - &#51228; 2&#54924; &#54620;&#51064;&#54924;&#51109;&#48176; &#53580;&#45768;&#49828; &#45824;&#54924;', '', 'IMG_6155_155938.JPG', 600, 900, 100, 150, 127, '2010-05-01 15:59:38');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (148, '&#52572;&#51116;&#54840; - &#51228; 2&#54924; &#54620;&#51064;&#54924;&#51109;&#48176; &#53580;&#45768;&#49828; &#45824;&#54924;', '', 'IMG_6160_160033.JPG', 600, 900, 100, 150, 127, '2010-05-01 16:00:33');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (149, '&#51060;&#49464;&#54984; - &#51228; 2&#54924; &#54620;&#51064;&#54924;&#51109;&#48176; &#53580;&#45768;&#49828; &#45824;&#54924; &#48373;&#49885; &#50864;&#49849;', '', 'IMG_6161_160043.JPG', 600, 900, 100, 150, 127, '2010-05-01 16:00:44');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (150, '&#51060;&#49464;&#54984; & &#52572;&#51116;&#54840; - &#51228; 2&#54924; &#54620;&#51064;&#54924;&#51109;&#48176; &#53580;&#45768;&#49828; &#45824;&#54924;', '', 'IMG_6162_160101.JPG', 600, 900, 100, 150, 127, '2010-05-01 16:01:01');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (151, '&#44608;&#51456;&#44508; - &#51228; 2&#54924; &#54620;&#51064;&#54924;&#51109;&#48176; &#53580;&#45768;&#49828; &#45824;&#54924; B&#51312; &#50864;&#49849;', '', 'IMG_6164_160437.JPG', 600, 900, 100, 150, 127, '2010-05-01 16:04:37');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (152, '&#44608;&#48124;&#49688; - &#51228; 2&#54924; &#54620;&#51064;&#54924;&#51109;&#48176; &#53580;&#45768;&#49828; &#45824;&#54924;', '', 'IMG_6166_160507.JPG', 600, 900, 100, 150, 127, '2010-05-01 16:05:07');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (153, '&#51228; 2&#54924; &#54620;&#51064;&#54924;&#51109;&#48176; &#53580;&#45768;&#49828; &#45824;&#54924;', '', 'IMG_6169_160520.JPG', 800, 533, 150, 99, 127, '2010-05-01 16:05:21');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (154, '&#51060;&#55148;&#49328; - &#51228; 2&#54924; &#54620;&#51064;&#54924;&#51109;&#48176; &#53580;&#45768;&#49828; &#45824;&#54924;', '', 'IMG_6174_160538.JPG', 800, 533, 150, 99, 127, '2010-05-01 16:05:38');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (155, '&#51221;&#50896;&#54840; & &#52572;&#51116;&#54840; - &#51228; 2&#54924; &#54620;&#51064;&#54924;&#51109;&#48176; &#53580;&#45768;&#49828; &#45824;&#54924;', '', 'IMG_6176_160632.JPG', 800, 533, 150, 99, 127, '2010-05-01 16:06:32');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (156, '&#50980;&#50689;&#44592; & &#50980;&#44592;&#50672; - &#51228; 2&#54924; &#54620;&#51064;&#54924;&#51109;&#48176; &#53580;&#45768;&#49828; &#45824;&#54924;', '', 'IMG_6179_160700.JPG', 800, 533, 150, 99, 127, '2010-05-01 16:07:00');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (157, '&#51312;&#54805;&#49437; - &#51228; 2&#54924; &#54620;&#51064;&#54924;&#51109;&#48176; &#53580;&#45768;&#49828; &#45824;&#54924; C&#51312; &#50864;&#49849;', '', 'IMG_6188_160752.JPG', 800, 533, 150, 99, 127, '2010-05-01 16:07:52');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (158, '&#50980;&#44592;&#50672; - &#51228; 2&#54924; &#54620;&#51064;&#54924;&#51109;&#48176; &#53580;&#45768;&#49828; &#45824;&#54924;', '', 'IMG_6192_160901.JPG', 800, 533, 150, 99, 127, '2010-05-01 16:09:01');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (159, '&#51221;&#50896;&#54840; - &#51228; 2&#54924; &#54620;&#51064;&#54924;&#51109;&#48176; &#53580;&#45768;&#49828; &#45824;&#54924;', '', 'IMG_6193_160913.JPG', 800, 533, 150, 99, 127, '2010-05-01 16:09:13');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (160, '&#52572;&#50672;&#53469; - &#51228; 2&#54924; &#54620;&#51064;&#54924;&#51109;&#48176; &#53580;&#45768;&#49828; &#45824;&#54924;', '', 'IMG_6198_160924.JPG', 800, 533, 150, 99, 127, '2010-05-01 16:09:24');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (161, '&#51228; 2&#54924; &#54620;&#51064;&#54924;&#51109;&#48176; &#53580;&#45768;&#49828; &#45824;&#54924;', '', 'IMG_6201_160937.JPG', 800, 533, 150, 99, 127, '2010-05-01 16:09:37');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (162, 'John Laurie - &#51228; 2&#54924; &#54620;&#51064;&#54924;&#51109;&#48176; &#53580;&#45768;&#49828; &#45824;&#54924; C&#51312; &#51456;&#50864;&#49849;', '', 'IMG_6207_160954.JPG', 800, 533, 150, 99, 127, '2010-05-01 16:09:54');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (163, '&#51312;&#54805;&#49437; & &#44608;&#48124;&#49688; & John Laurie', '', 'IMG_6208_161026.JPG', 800, 533, 150, 99, 113, '2010-05-01 16:10:27');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (164, '&#51228; 2&#54924; &#54620;&#51064;&#54924;&#51109;&#48176; &#53580;&#45768;&#49828; &#45824;&#54924;', '', 'IMG_6209_161133.JPG', 800, 533, 150, 99, 127, '2010-05-01 16:11:33');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (165, '&#51228; 2&#54924; &#54620;&#51064;&#54924;&#51109;&#48176; &#53580;&#45768;&#49828; &#45824;&#54924;', '', 'IMG_6211_161143.JPG', 800, 533, 150, 99, 127, '2010-05-01 16:11:43');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (167, 'Tennis Lesson', 'Mr. Sehun Lee is giving a lesson on forehand stroke.', 'CIMG0240_163214.JPG', 800, 514, 150, 96, 127, '2010-06-01 16:32:14');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (168, 'Picnic at Ft. Lowell Park', '', 'CIMG0247_164211.JPG', 800, 600, 150, 112, 123, '2010-06-01 16:42:11');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (169, 'Picnic at Ft. Lowell Park', '', 'CIMG0248_164222.JPG', 800, 600, 150, 112, 110, '2010-06-01 16:42:23');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (170, 'Picnic at Ft. Lowell Park', '', 'CIMG0251_164258.JPG', 800, 600, 150, 112, 104, '2010-06-01 16:42:59');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (171, 'Picnic at Ft. Lowell Park', '', 'CIMG0252_164308.JPG', 800, 600, 150, 112, 120, '2010-06-01 16:43:08');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (172, 'Lake at Ft. Lowell Park', '', 'CIMG0258_164325.JPG', 800, 600, 150, 112, 113, '2010-06-01 16:43:25');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (173, 'Picnic at Ft. Lowell Park', '', 'CIMG0271_164333.JPG', 800, 600, 150, 112, 119, '2010-06-01 16:43:34');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (174, 'Picnic at Ft. Lowell Park', '', 'CIMG0272_164342.JPG', 800, 600, 150, 112, 121, '2010-06-01 16:43:42');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (175, 'Picnic at Ft. Lowell Park', '', 'CIMG0274_164350.JPG', 800, 600, 150, 112, 126, '2010-06-01 16:43:51');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (177, 'Tennis Lesson', '', 'CIMG0279_144033.JPG', 800, 552, 150, 103, 127, '2010-06-07 14:40:34');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (178, '&#53804;&#49328; &#46496;&#45208;&#44592; &#51204; &#44608;&#51456;&#44508; &#48149;&#49324;&#45784;&#51032; &#47560;&#51648;&#47561; &#44221;&#44592;', '', 'CIMG0281_144252.JPG', 800, 438, 150, 82, 127, '2010-06-07 14:42:52');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (179, '&#44032;&#51313;&#51060; &#45796; &#50752;&#49436; &#51025;&#50896; &#51473;', '', 'CIMG0791_140150.JPG', 800, 600, 150, 112, 127, '2010-08-16 14:01:50');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (180, '&#53580;&#45768;&#49828; &#47112;&#49832; &#51473;', '', 'CIMG0795_140221.JPG', 800, 559, 150, 104, 127, '2010-08-16 14:02:21');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (181, '&#53580;&#45768;&#49828; &#47112;&#49832; &#51473;', '', 'CIMG0796_140229.JPG', 800, 468, 150, 87, 116, '2010-08-16 14:02:29');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (182, '&#51228; 1&#54924; &#52404;&#50977;&#54924;&#51109;&#48176; &#53580;&#45768;&#49828; &#45824;&#54924; (Phoenix)', '', 'CIMG1028_164813.JPG', 800, 600, 150, 112, 127, '2010-11-30 16:48:13');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (183, '&#51228; 1&#54924; &#52404;&#50977;&#54924;&#51109;&#48176; &#53580;&#45768;&#49828; &#45824;&#54924; (&#44428;&#49692;&#52380; & &#52992;&#48712;&#51312;)', '', 'CIMG1023_164954.JPG', 800, 600, 150, 112, 127, '2010-11-30 16:49:54');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (184, '&#51228; 1&#54924; &#52404;&#50977;&#54924;&#51109;&#48176; &#53580;&#45768;&#49828; &#45824;&#54924; (&#51060;&#51008;&#48124; & &#54637;&#50857;&#54984;)', '', 'CIMG1024_165020.JPG', 800, 600, 150, 112, 127, '2010-11-30 16:50:20');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (185, '&#51228; 1&#54924; &#52404;&#50977;&#54924;&#51109;&#48176; &#53580;&#45768;&#49828; &#45824;&#54924; (&#51060;&#51008;&#48124;)', '', 'CIMG1027_165036.JPG', 800, 600, 150, 112, 127, '2010-11-30 16:50:36');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (186, 'Party at Mr. Henry Kim''s', '', 'CIMG1426_140559.JPG', 800, 600, 150, 112, 112, '2010-12-27 14:05:59');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (187, 'Party at Mr. Henry Kim''s', '', 'CIMG1428_140618.JPG', 800, 600, 150, 112, 127, '2010-12-27 14:06:18');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (188, 'Party at Mr. Henry Kim''s (&#51060;&#51008;&#48124; & &#44428;&#49692;&#52380;)', '', 'CIMG1431_140643.JPG', 800, 600, 150, 112, 127, '2010-12-27 14:06:43');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (189, 'Party at Mr. Henry Kim''s', '', 'CIMG1432_140707.JPG', 800, 600, 150, 112, 127, '2010-12-27 14:07:07');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (190, 'Party at Mr. Henry Kim''s', '', 'CIMG1434_140739.JPG', 800, 600, 150, 112, 127, '2010-12-27 14:07:39');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (191, 'Party at Mr. Henry Kim''s', '', 'CIMG1438_140751.JPG', 800, 600, 150, 112, 127, '2010-12-27 14:07:51');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (192, 'Party at Mr. Henry Kim''s', '', 'CIMG1440_140802.JPG', 800, 600, 150, 112, 127, '2010-12-27 14:08:02');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (193, 'Party at Mr. Henry Kim''s', '', 'CIMG1442_140814.JPG', 800, 600, 150, 112, 127, '2010-12-27 14:08:14');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (194, 'Steve Bae & &#49436;&#52397;&#47564;', '', 'CIMG1528_111401.JPG', 800, 593, 150, 111, 125, '2011-01-04 11:14:01');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (195, '&#52572;&#51116;&#54840; & &#50980;&#50689;&#44592;', '', 'CIMG1535_111442.JPG', 800, 542, 150, 101, 127, '2011-01-04 11:14:42');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (196, 'Young Woo Seo Leaving Tucson', '', 'SAM_0322_132921.jpg', 800, 551, 150, 103, 32, '2011-09-01 13:36:01');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (197, '&#49436;&#52397;&#47564; & &#45224;&#44592;&#54872;', '', 'IMG_0699_134244.JPG', 800, 600, 150, 112, 26, '2011-09-16 00:00:00');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (198, '&#45224;&#44592;&#54872; & &#49436;&#52397;&#47564;', '', 'IMG_0700_134314.JPG', 800, 600, 150, 112, 25, '2011-09-16 00:00:00');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (199, '&#51221;&#50896;&#54840; & &#52572;&#50672;&#53469;', '', 'IMG_0701_134345.JPG', 800, 600, 150, 112, 23, '2011-09-16 00:00:00');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (200, '&#44608;&#54620;&#50857; & &#44396;&#48124;&#50865;', '', 'IMG_0703_134400.JPG', 800, 600, 150, 112, 25, '2011-09-16 00:00:00');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (201, '&#44608;&#48124;&#49688; & &#44608;&#54644;&#46304;', '', 'IMG_0696_134414.JPG', 800, 600, 150, 112, 29, '2011-09-16 00:00:00');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (202, 'Tennis night', '', 'tennis_9_16_B_141528.jpg', 800, 500, 150, 93, 27, '2011-09-16 00:00:00');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (203, '&#54644;&#46304;&#51060;&#46020; &#46041;&#52280;', '', 'tennis_9_16_C_141818.jpg', 800, 452, 150, 84, 27, '2011-09-16 00:00:00');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (204, 'Singles match C&#51312; 1&#46321; &#44608;&#48124;&#49688;', '', 'tennis_9_16_I_141945.jpg', 800, 450, 150, 84, 32, '2011-09-16 00:00:00');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (205, '2011 Tucson Korean Tennis Tournament', '', 'IMG_0772_192712.JPG', 800, 600, 150, 112, 23, '2011-10-01 00:00:00');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (206, '&#51221;&#50896;&#54840;', '', 'IMG_0781_192908.JPG', 800, 600, 150, 112, 16, '2011-10-01 00:00:00');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (207, '&#51060;&#51008;&#48124;', '', 'IMG_0785_192921.JPG', 800, 600, 150, 112, 19, '2011-10-01 00:00:00');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (208, '&#51109;&#44221;&#47329;', '', 'IMG_0788_192935.JPG', 800, 600, 150, 112, 22, '2011-10-01 00:00:00');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (209, '&#44608;&#48124;&#49688;', '', 'IMG_0816_192945.JPG', 800, 600, 150, 112, 22, '2011-10-01 00:00:00');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (210, '&#51060;&#52285;&#45432;', '', 'IMG_0817_192956.JPG', 800, 600, 150, 112, 23, '2011-10-01 00:00:00');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (211, '&#52572;&#51116;&#54840;', '', 'IMG_0854_193008.JPG', 800, 600, 150, 112, 22, '2011-10-01 00:00:00');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (212, '&#44608;&#54620;&#50857;', '', 'IMG_0861_193018.JPG', 800, 600, 150, 112, 23, '2011-10-01 00:00:00');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (213, '&#44608;&#54620;&#50857; & &#51221;&#50896;&#54840;', '', 'IMG_0881_193030.JPG', 800, 600, 150, 112, 22, '2011-10-01 00:00:00');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (214, '&#44608;&#54805;&#52384; & &#48149;&#50689;&#51652;', '', 'IMG_0899_193043.JPG', 800, 600, 150, 112, 26, '2011-10-01 00:00:00');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (219, 'PIcnic at Ft Lowell Park', '', 'SAM_0533_181140.JPG', 800, 600, 150, 112, 5, '2011-11-16 00:00:00');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (220, 'PIcnic at Ft Lowell Park', '', 'SAM_0535_221857.JPG', 800, 600, 150, 112, 4, '2011-11-16 00:00:00');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (221, 'PIcnic at Ft Lowell Park', '', 'SAM_0539_223343.JPG', 800, 600, 150, 112, 5, '2011-11-16 00:00:00');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (222, 'PIcnic at Ft Lowell Park', '', 'SAM_0540_223417.JPG', 800, 600, 150, 112, 3, '2011-11-16 00:00:00');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (223, 'PIcnic at Ft Lowell Park', '', 'SAM_0546_223428.JPG', 800, 600, 150, 112, 3, '2011-11-16 00:00:00');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (224, 'PIcnic at Ft Lowell Park', '', 'SAM_0551_223437.JPG', 800, 600, 150, 112, 3, '2011-11-16 00:00:00');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (225, 'PIcnic at Ft Lowell Park', '', 'SAM_0552_223447.JPG', 800, 600, 150, 112, 3, '2011-11-16 00:00:00');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (226, 'PIcnic at Ft Lowell Park', '', 'SAM_0558_223509.JPG', 800, 600, 150, 112, 3, '2011-11-16 00:00:00');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (227, 'PIcnic at Ft Lowell Park', '', 'SAM_0562_223517.JPG', 800, 600, 150, 112, 3, '2011-11-16 00:00:00');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (228, 'PIcnic at Ft Lowell Park', '', 'SAM_0563_223525.JPG', 800, 600, 150, 112, 3, '2011-11-16 00:00:00');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (229, 'PIcnic at Ft Lowell Park', '', 'SAM_0569_223533.JPG', 800, 600, 150, 112, 3, '2011-11-16 00:00:00');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (230, 'PIcnic at Ft Lowell Park', '', 'SAM_0583_223541.JPG', 800, 600, 150, 112, 3, '2011-11-16 00:00:00');
