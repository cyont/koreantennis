﻿-- phpMyAdmin SQL Dump
-- version 2.6.4-pl3
-- http://www.phpmyadmin.net
-- 
-- Host: db2191.perfora.net
-- Generation Time: Mar 09, 2011 at 08:31 AM
-- Server version: 5.0.91
-- PHP Version: 5.2.6-1+lenny9
-- 
-- Database: `db361004340`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `admin`
-- 
USE db361004340;
CREATE TABLE `admin` (
  `id` int(190) NOT NULL auto_increment,
  `admin` varchar(190) NOT NULL default '',
  `pass` varchar(190) NOT NULL default '',
  `email` varchar(190) NOT NULL default '',
  `hits` int(190) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- 
-- Dumping data for table `admin`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `announcement`
-- 

CREATE TABLE `announcement` (
  `id` int(11) NOT NULL auto_increment,
  `lid` tinyint(3) default NULL,
  `title` varchar(255) character set euckr default NULL,
  `announcement` varchar(4000) character set euckr default NULL,
  `active` tinyint(1) default '1',
  `koreantennis` tinyint(1) default '0',
  `timestamp` timestamp NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=latin1 AUTO_INCREMENT=76 ;

-- 
-- Dumping data for table `announcement`
-- 

INSERT INTO `announcement` (`id`, `lid`, `title`, `announcement`, `active`, `koreantennis`, `timestamp`) VALUES (61, 21, 'Looking for the sponsors', 'The president of Tucson Korean Tennis Association is looking for the sponsors to support our tennis club. You can check the website, <a href="sponsors.php">http://koreantennis.la21c.com/eng/sponsors.php</a>, for more details. If you want to be a sponsor, please let us know. You can either email tucsonkoreantennis@gmail.com or create a new post on Forum.', 0, 1, '2011-01-15 12:00:00');
INSERT INTO `announcement` (`id`, `lid`, `title`, `announcement`, `active`, `koreantennis`, `timestamp`) VALUES (62, 44, '테니스 협회 스폰서를 찾고 있습니다.', '투산 한인 테니스 협회를 지원해 줄 스폰서를 찾고 있습니다. 자세한 사항은 웹사이트 스폰서 페이지를 참조하세요: <a href="sponsors.php">http://koreantennis.la21c.com/kor/sponsors.php</a>. 협회의 발전을 위해 어떤 형태로든 스폰서가 되기를 원하시면 회장이나 총무에게 알려 주세요. tucsonkoreantennis@gmail.com 으로 이메일 주셔도 되고, 게시판에 글을 남기셔도 되고요.', 0, 1, '2011-01-15 12:00:00');
INSERT INTO `announcement` (`id`, `lid`, `title`, `announcement`, `active`, `koreantennis`, `timestamp`) VALUES (65, 21, 'End of the Year Celebration at Mr. Kim''s', 'We will celebrate the end of the year at the house of Mr. Han Yong Kim (Henry Kim) and Mrs. Young Hee Kim.  Please send a courteous RSVP email to tucsonkoreantennis@gmail.com to indicate if you will be coming and how many.  You will be replied with the home address and a map to find the house.\r\n<div style="margin-left:20px;">\r\n<b>When:</b> Dec. 26 (Sun), 6:00 PM <br />\r\n<b>Where: </b>Mr. Han Yong Kim''s house (near Sunrise & Craycroft)</div>', 0, 1, '2011-01-18 09:45:00');
INSERT INTO `announcement` (`id`, `lid`, `title`, `announcement`, `active`, `koreantennis`, `timestamp`) VALUES (66, 44, '연말 파티', '투산 한인 테니스 협회의 연말 파티를 위해서 김한용 (Henry Kim)/김영희 집사님께서 장소를 제공해 주시겠습니다.   참석하실 수 있는지, 몇 명이 오실지 tucsonkoreantennis@gmail.com로 이메일 주시면 감사하겠습니다. 이메일 주시면 집 주소와 약도를 보내 드리겠습니다. \r\n<div style="margin-left:20px;">\r\n<b>시간:</b> Dec. 26 (Sun), 6:00 PM <br />\r\n<b>장소: </b>김한용/김영희 집사님 댁 (near Sunrise & Craycroft)</div>', 0, 1, '2011-01-18 09:46:00');
INSERT INTO `announcement` (`id`, `lid`, `title`, `announcement`, `active`, `koreantennis`, `timestamp`) VALUES (67, 21, 'Sponsors So Far', 'These are the sponsors registered so far.\r\n<ul>\r\n<li>Kimpo Oriental Market (10% discount)</li>\r\n<li>Family Doctor Eun Min Lee, M.D. (50% discount for non-insurance payment)</li>\r\n<li>Prince Pizza Restaurant (15% discount)</li>\r\n<li>Sushi Ten Japanese Restaurant (15% discount)</li>\r\n<li>Korea House Restaurant (15% discount)</li>\r\n<li>Tucson Foreign Car Specialist (10% discount)</li>\r\n</ul>', 1, 1, '2011-01-18 17:08:09');
INSERT INTO `announcement` (`id`, `lid`, `title`, `announcement`, `active`, `koreantennis`, `timestamp`) VALUES (68, 44, '현재까지 등록된 스폰서', '현재까지 등록된 스폰서입니다.\r\n<ul>\r\n<li>Kimpo Oriental Market (10% discount)</li>\r\n<li>Family Doctor Eun Min Lee, M.D. (50% discount for non-insurance payment)</li>\r\n<li>Prince Pizza Restaurant (15% discount)</li>\r\n<li>Sushi Ten Japanese Restaurant (15% discount)</li>\r\n<li>Korea House Restaurant (15% discount)</li>\r\n<li>Tucson Foreign Car Specialist (10% discount)</li>\r\n</ul>', 1, 1, '2011-01-18 17:10:33');
INSERT INTO `announcement` (`id`, `lid`, `title`, `announcement`, `active`, `koreantennis`, `timestamp`) VALUES (69, 21, 'New Sponsors', 'These are recently added sponsors.\r\n<ul>\r\n<li>LAZ Express (Moving) (10% discount)</li>\r\n<li>Heritage Shoe Repair (30% discount)</li>\r\n<li>Long Realty - Young Lee</li>\r\n<li>Tanque Verde Cleaners (30% discount)</li>\r\n</ul>', 1, 1, '2011-01-31 17:59:41');
INSERT INTO `announcement` (`id`, `lid`, `title`, `announcement`, `active`, `koreantennis`, `timestamp`) VALUES (70, 44, '새로 등록된 스폰서', '최근에 새로 등록된 스폰서입니다.\r\n<ul>\r\n<li>LAZ Express (Moving) (10% discount)</li>\r\n<li>Heritage Shoe Repair (30% discount)</li>\r\n<li>Long Realty - Young Lee</li>\r\n<li>Tanque Verde Cleaners (30% discount)</li>\r\n</ul>', 1, 1, '2011-01-31 18:01:09');
INSERT INTO `announcement` (`id`, `lid`, `title`, `announcement`, `active`, `koreantennis`, `timestamp`) VALUES (71, 21, 'New Sponsors', 'These are recently added sponsors.\r\n<ul>\r\n<li>Champion Auto Body & Painting</li>\r\n<li>North Pointe Dental - Jane Koo, D.D.S (10% discount)</li>\r\n<li>Beauty Salon - Cha Eun Sook (10% discount)</li>\r\n</ul>', 1, 1, '2011-02-22 15:31:00');
INSERT INTO `announcement` (`id`, `lid`, `title`, `announcement`, `active`, `koreantennis`, `timestamp`) VALUES (72, 44, '새로 등록된 스폰서', '이번 달에 새로 등록된 스폰서입니다.\r\n<ul>\r\n<li>Champion Auto Body & Painting</li>\r\n<li>North Pointe Dental - Jane Koo, D.D.S (10% discount)</li>\r\n<li>Beauty Salon - Cha Eun Sook (10% discount)</li>\r\n</ul>', 1, 1, '2011-02-22 15:34:00');
INSERT INTO `announcement` (`id`, `lid`, `title`, `announcement`, `active`, `koreantennis`, `timestamp`) VALUES (73, 21, 'Mido Sushi Korean Tennis Tournament', 'Korean tennis tournament sponsored by Mido Sushi Restaurant will be held.\r\n<div style="margin-left:20px;">\r\n<b>TIME:</b> Apr. 2 (Sat).  10:00 AM <br />\r\n<b>LOCATION: </b>Kiwanis Recreation Center (Tempe)<br />\r\n<a href="http://maps.google.com/maps?hl=en&expIds=17259,25907,26637,26992,27183,27284&sugexp=ldymls&xhr=t&cp=41&newwindow=1&rls=com.microsoft:en-us&wrapid=tljp128812506183200&um=1&ie=UTF-8&q=6111+S.+All+American+Way,+Tempe,+AZ+85283&fb=1&gl=us&hnear=Tucson,+AZ&cid=0,0,3378536215625187567&ei=_zrHTMXyMYuusAOYqrjfDQ&sa=X&oi=local_result&ct=image&resnum=1&sqi=2&ved=0CBcQnwIwAA" target="_blank">6111 S. All American Way, Tempe, AZ 85283</a>\r\n</div>\r\nCheck the website for Details: <a href="http://koreantennis.la21c.com/eng/tournament_2011_spring.php">Mido Sushi Korean Tennis Tournament</a>', 1, 1, '2011-03-02 15:55:23');
INSERT INTO `announcement` (`id`, `lid`, `title`, `announcement`, `active`, `koreantennis`, `timestamp`) VALUES (74, 44, '미도 수시배 한인 테니스 대회', '미도 수시배 한인 테니스 대회가 개최됩니다.\r\n<div style="margin-left:20px;">\r\n<b>TIME:</b> Apr. 2 (Sat).  10:00 AM <br />\r\n<b>LOCATION: </b>Kiwanis Recreation Center (Tempe)<br />\r\n<a href="http://maps.google.com/maps?hl=en&expIds=17259,25907,26637,26992,27183,27284&sugexp=ldymls&xhr=t&cp=41&newwindow=1&rls=com.microsoft:en-us&wrapid=tljp128812506183200&um=1&ie=UTF-8&q=6111+S.+All+American+Way,+Tempe,+AZ+85283&fb=1&gl=us&hnear=Tucson,+AZ&cid=0,0,3378536215625187567&ei=_zrHTMXyMYuusAOYqrjfDQ&sa=X&oi=local_result&ct=image&resnum=1&sqi=2&ved=0CBcQnwIwAA" target="_blank">6111 S. All American Way, Tempe, AZ 85283</a>\r\n</div>\r\n웹사이트에서 자세한 사항을 확인하세요: <a href="http://koreantennis.la21c.com/eng/tournament_2011_spring.php">미도 수시배 한인 테니스 대회</a>', 1, 1, '2011-03-02 18:05:39');

-- --------------------------------------------------------

-- 
-- Table structure for table `comments`
-- 

CREATE TABLE `comments` (
  `id` int(190) NOT NULL auto_increment,
  `imgid` int(11) NOT NULL default '0',
  `name2` varchar(190) NOT NULL,
  `comment2` text NOT NULL,
  `date` varchar(190) NOT NULL default '',
  `status` tinyint(3) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `comments`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `courts`
-- 

CREATE TABLE `courts` (
  `id` tinyint(1) NOT NULL auto_increment,
  `name` varchar(50) default NULL,
  `region` varchar(10) default NULL,
  `location` varchar(50) default NULL,
  `address` varchar(255) default NULL,
  `zip` varchar(20) default NULL,
  `city` varchar(20) default NULL,
  `time` varchar(2000) default NULL,
  `cost` varchar(2000) default NULL,
  `court_num` tinyint(3) default NULL,
  `lights` varchar(255) default NULL,
  `maintenance` varchar(20) default NULL,
  `website` varchar(255) default NULL,
  `phone` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

-- 
-- Dumping data for table `courts`
-- 

INSERT INTO `courts` (`id`, `name`, `region`, `location`, `address`, `zip`, `city`, `time`, `cost`, `court_num`, `lights`, `maintenance`, `website`, `phone`) VALUES (1, 'Jim Reffkin Tennis Center', 'Central', 'Tucson Parks and Recreation', '50 S. Alvernon Way', '85716', 'Tucson', 'Mon - Fri: 7am in Summer/ 8am in Winter - 1pm, 5pm - 9:30pm\r\nSat - Sun: 7am in Summer/ 8am in Winter - 1pm', '$2.50 per person', 25, 'Weekday - Yes, Weekends -No', 'Excellent', 'http://www.reffkintenniscenter.com', '520-791-4896');
INSERT INTO `courts` (`id`, `name`, `region`, `location`, `address`, `zip`, `city`, `time`, `cost`, `court_num`, `lights`, `maintenance`, `website`, `phone`) VALUES (2, 'Himmel Park Tennis Center', 'Central', 'Himmel Park', '1000 N. Tucson Blvd', '85719', 'Tucson', 'Mon - Thu: 8am - noon, 5pm - 8pm\r\nSat - Sun: ?', '$2.50 per person', 8, '?', 'Good', NULL, NULL);
INSERT INTO `courts` (`id`, `name`, `region`, `location`, `address`, `zip`, `city`, `time`, `cost`, `court_num`, `lights`, `maintenance`, `website`, `phone`) VALUES (3, 'Fort Lowell Park Tennis Center', 'Central', 'Fort Lowell Park', '2900 N. Craycroft', '85712', 'Tucson', '?', '$2.50 per person', 8, 'Yes', 'Good', 'http://www.tucsontennis.com/', '520-791-2584');
INSERT INTO `courts` (`id`, `name`, `region`, `location`, `address`, `zip`, `city`, `time`, `cost`, `court_num`, `lights`, `maintenance`, `website`, `phone`) VALUES (4, 'Pima Community College-West Campus', 'West', 'Pima Community College-West Campus', '2202 W. Anklam Rd', '85745', 'Tucson', '?', 'Free', 8, '?', 'Good', NULL, '520-206-6640');
INSERT INTO `courts` (`id`, `name`, `region`, `location`, `address`, `zip`, `city`, `time`, `cost`, `court_num`, `lights`, `maintenance`, `website`, `phone`) VALUES (5, 'Stefan Gollub Park', 'East', 'Stefan Gollub Park', '401 S. Prudence Rd', '85710', 'Tucson', NULL, 'Free', 4, 'Yes', 'Good', NULL, NULL);
INSERT INTO `courts` (`id`, `name`, `region`, `location`, `address`, `zip`, `city`, `time`, `cost`, `court_num`, `lights`, `maintenance`, `website`, `phone`) VALUES (6, 'Robson Tennis Center', 'Central', 'University of Arizona', '1836 E. 2nd', '85719', 'Tucson', '5:30pm-10:30pm (M - F)\r\n8:30am-8:30pm (Sat)\r\n10:30am-10:30pm (Sun)', 'Free with CatCard, $2 without CatCard', 17, 'Yes', 'Excellent', 'http://campusrec.arizona.edu/hours/robson.html', '520-621-9902');
INSERT INTO `courts` (`id`, `name`, `region`, `location`, `address`, `zip`, `city`, `time`, `cost`, `court_num`, `lights`, `maintenance`, `website`, `phone`) VALUES (7, 'Catalina High Magnet School', 'Central', 'Catalina High Magnet School', '3645 East Pima Street', '85716', 'Tucson', NULL, 'Free on weekends', 10, '?', 'Good', 'http://edweb.tusd.k12.az.us/catalina/', '520-791-4245');
INSERT INTO `courts` (`id`, `name`, `region`, `location`, `address`, `zip`, `city`, `time`, `cost`, `court_num`, `lights`, `maintenance`, `website`, `phone`) VALUES (8, 'Udall Recreation Center', 'East', 'Udall Recreation Center', '7200 East Tanque Verde Road', '85715', 'Tucson', NULL, 'Free', 4, 'Yes', 'Poor', NULL, '520-791-4931');
INSERT INTO `courts` (`id`, `name`, `region`, `location`, `address`, `zip`, `city`, `time`, `cost`, `court_num`, `lights`, `maintenance`, `website`, `phone`) VALUES (9, 'Palo Verde Park', 'East', 'Palo Verde Park', '6800 E. Julia', '85710', 'Tucson', NULL, 'Free', 2, 'No', 'Poor', NULL, NULL);
INSERT INTO `courts` (`id`, `name`, `region`, `location`, `address`, `zip`, `city`, `time`, `cost`, `court_num`, `lights`, `maintenance`, `website`, `phone`) VALUES (10, 'Santa Rita High School', 'East', 'Santa Rita High School', '3951 S. Pantano Road', '85730', 'Tucson', NULL, 'Free on weekends', 10, 'No', 'Poor', 'http://edweb.tusd.k12.az.us/Santa_Rita/', '520-731-7500');

-- --------------------------------------------------------

-- 
-- Table structure for table `games`
-- 

CREATE TABLE `games` (
  `Id` int(11) NOT NULL auto_increment,
  `person1` int(6) NOT NULL,
  `person1_score` tinyint(3) NOT NULL,
  `person2` int(6) NOT NULL,
  `person2_score` tinyint(3) NOT NULL,
  `r_group` varchar(3) NOT NULL,
  `game_date` datetime NOT NULL,
  PRIMARY KEY  (`Id`),
  UNIQUE KEY `Id` (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=euckr AUTO_INCREMENT=34 ;

-- 
-- Dumping data for table `games`
-- 

INSERT INTO `games` (`Id`, `person1`, `person1_score`, `person2`, `person2_score`, `r_group`, `game_date`) VALUES (16, 1, 5, 92, 2, 'B', '2011-03-04 00:00:00');
INSERT INTO `games` (`Id`, `person1`, `person1_score`, `person2`, `person2_score`, `r_group`, `game_date`) VALUES (17, 48, 5, 49, 1, 'C', '2011-03-04 00:00:00');
INSERT INTO `games` (`Id`, `person1`, `person1_score`, `person2`, `person2_score`, `r_group`, `game_date`) VALUES (18, 92, 5, 1, 4, 'B', '2011-03-04 00:00:00');
INSERT INTO `games` (`Id`, `person1`, `person1_score`, `person2`, `person2_score`, `r_group`, `game_date`) VALUES (19, 45, 7, 23, 5, 'B', '2011-03-04 00:00:00');
INSERT INTO `games` (`Id`, `person1`, `person1_score`, `person2`, `person2_score`, `r_group`, `game_date`) VALUES (20, 45, 5, 1, 1, 'B', '2011-03-04 00:00:00');
INSERT INTO `games` (`Id`, `person1`, `person1_score`, `person2`, `person2_score`, `r_group`, `game_date`) VALUES (21, 14, 7, 92, 5, 'B', '2011-03-04 00:00:00');
INSERT INTO `games` (`Id`, `person1`, `person1_score`, `person2`, `person2_score`, `r_group`, `game_date`) VALUES (22, 43, 6, 25, 3, 'A', '2011-03-04 00:00:00');
INSERT INTO `games` (`Id`, `person1`, `person1_score`, `person2`, `person2_score`, `r_group`, `game_date`) VALUES (23, 43, 5, 25, 2, 'A', '2011-03-04 00:00:00');
INSERT INTO `games` (`Id`, `person1`, `person1_score`, `person2`, `person2_score`, `r_group`, `game_date`) VALUES (24, 28, 5, 43, 2, 'A', '2011-03-07 00:00:00');
INSERT INTO `games` (`Id`, `person1`, `person1_score`, `person2`, `person2_score`, `r_group`, `game_date`) VALUES (25, 76, 5, 45, 4, 'B', '2011-03-07 00:00:00');
INSERT INTO `games` (`Id`, `person1`, `person1_score`, `person2`, `person2_score`, `r_group`, `game_date`) VALUES (26, 1, 6, 94, 4, 'B', '2011-03-07 00:00:00');
INSERT INTO `games` (`Id`, `person1`, `person1_score`, `person2`, `person2_score`, `r_group`, `game_date`) VALUES (27, 43, 6, 28, 4, 'A', '2011-03-07 00:00:00');
INSERT INTO `games` (`Id`, `person1`, `person1_score`, `person2`, `person2_score`, `r_group`, `game_date`) VALUES (28, 1, 5, 76, 3, 'B', '2011-03-07 00:00:00');
INSERT INTO `games` (`Id`, `person1`, `person1_score`, `person2`, `person2_score`, `r_group`, `game_date`) VALUES (29, 45, 6, 92, 4, 'B', '2011-03-07 00:00:00');
INSERT INTO `games` (`Id`, `person1`, `person1_score`, `person2`, `person2_score`, `r_group`, `game_date`) VALUES (30, 17, 6, 28, 4, 'A', '2011-03-07 00:00:00');
INSERT INTO `games` (`Id`, `person1`, `person1_score`, `person2`, `person2_score`, `r_group`, `game_date`) VALUES (31, 17, 6, 10, 3, 'A', '2011-03-07 00:00:00');
INSERT INTO `games` (`Id`, `person1`, `person1_score`, `person2`, `person2_score`, `r_group`, `game_date`) VALUES (32, 14, 5, 45, 4, 'B', '2011-03-07 00:00:00');
INSERT INTO `games` (`Id`, `person1`, `person1_score`, `person2`, `person2_score`, `r_group`, `game_date`) VALUES (33, 36, 6, 76, 3, 'B', '2011-03-07 00:00:00');

-- --------------------------------------------------------

-- 
-- Table structure for table `groups`
-- 

CREATE TABLE `groups` (
  `Id` int(11) NOT NULL default '0',
  `nickname_kor` varchar(50) character set euckr default NULL,
  `nickname_eng` varchar(50) default NULL,
  `inactive` tinyint(3) default '0',
  `r_group` varchar(3) default NULL,
  `points` int(11) default '1000',
  `hide_list` tinyint(1) default '0',
  `total_wins` smallint(6) default '0',
  `total_losses` smallint(6) default '0',
  `current_wins` smallint(6) default '0',
  `current_losses` smallint(6) default '0',
  PRIMARY KEY  (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `groups`
-- 

INSERT INTO `groups` (`Id`, `nickname_kor`, `nickname_eng`, `inactive`, `r_group`, `points`, `hide_list`, `total_wins`, `total_losses`, `current_wins`, `current_losses`) VALUES (1, NULL, NULL, 0, 'B', 1020, 0, 3, 2, 3, 2);
INSERT INTO `groups` (`Id`, `nickname_kor`, `nickname_eng`, `inactive`, `r_group`, `points`, `hide_list`, `total_wins`, `total_losses`, `current_wins`, `current_losses`) VALUES (2, NULL, NULL, 1, 'C', 1000, 0, 0, 0, 0, 0);
INSERT INTO `groups` (`Id`, `nickname_kor`, `nickname_eng`, `inactive`, `r_group`, `points`, `hide_list`, `total_wins`, `total_losses`, `current_wins`, `current_losses`) VALUES (3, NULL, NULL, 1, 'C', 1000, 0, 0, 0, 0, 0);
INSERT INTO `groups` (`Id`, `nickname_kor`, `nickname_eng`, `inactive`, `r_group`, `points`, `hide_list`, `total_wins`, `total_losses`, `current_wins`, `current_losses`) VALUES (4, NULL, NULL, 0, 'C', 1000, 0, 0, 0, 0, 0);
INSERT INTO `groups` (`Id`, `nickname_kor`, `nickname_eng`, `inactive`, `r_group`, `points`, `hide_list`, `total_wins`, `total_losses`, `current_wins`, `current_losses`) VALUES (5, NULL, NULL, 0, 'A', 1000, 0, 0, 0, 0, 0);
INSERT INTO `groups` (`Id`, `nickname_kor`, `nickname_eng`, `inactive`, `r_group`, `points`, `hide_list`, `total_wins`, `total_losses`, `current_wins`, `current_losses`) VALUES (6, NULL, NULL, 1, 'C', 1000, 0, 0, 0, 0, 0);
INSERT INTO `groups` (`Id`, `nickname_kor`, `nickname_eng`, `inactive`, `r_group`, `points`, `hide_list`, `total_wins`, `total_losses`, `current_wins`, `current_losses`) VALUES (8, NULL, NULL, 0, 'A', 1000, 0, 0, 0, 0, 0);
INSERT INTO `groups` (`Id`, `nickname_kor`, `nickname_eng`, `inactive`, `r_group`, `points`, `hide_list`, `total_wins`, `total_losses`, `current_wins`, `current_losses`) VALUES (10, NULL, NULL, 0, 'A', 970, 0, 0, 1, 0, 1);
INSERT INTO `groups` (`Id`, `nickname_kor`, `nickname_eng`, `inactive`, `r_group`, `points`, `hide_list`, `total_wins`, `total_losses`, `current_wins`, `current_losses`) VALUES (11, NULL, NULL, 1, 'C', 1000, 0, 0, 0, 0, 0);
INSERT INTO `groups` (`Id`, `nickname_kor`, `nickname_eng`, `inactive`, `r_group`, `points`, `hide_list`, `total_wins`, `total_losses`, `current_wins`, `current_losses`) VALUES (12, NULL, NULL, 1, 'C', 1000, 0, 0, 0, 0, 0);
INSERT INTO `groups` (`Id`, `nickname_kor`, `nickname_eng`, `inactive`, `r_group`, `points`, `hide_list`, `total_wins`, `total_losses`, `current_wins`, `current_losses`) VALUES (13, NULL, NULL, 0, 'A', 1000, 0, 0, 0, 0, 0);
INSERT INTO `groups` (`Id`, `nickname_kor`, `nickname_eng`, `inactive`, `r_group`, `points`, `hide_list`, `total_wins`, `total_losses`, `current_wins`, `current_losses`) VALUES (14, NULL, NULL, 0, 'B', 1030, 0, 2, 0, 2, 0);
INSERT INTO `groups` (`Id`, `nickname_kor`, `nickname_eng`, `inactive`, `r_group`, `points`, `hide_list`, `total_wins`, `total_losses`, `current_wins`, `current_losses`) VALUES (16, NULL, NULL, 1, 'C', 1000, 0, 0, 0, 0, 0);
INSERT INTO `groups` (`Id`, `nickname_kor`, `nickname_eng`, `inactive`, `r_group`, `points`, `hide_list`, `total_wins`, `total_losses`, `current_wins`, `current_losses`) VALUES (17, NULL, NULL, 0, 'A', 1050, 0, 2, 0, 2, 0);
INSERT INTO `groups` (`Id`, `nickname_kor`, `nickname_eng`, `inactive`, `r_group`, `points`, `hide_list`, `total_wins`, `total_losses`, `current_wins`, `current_losses`) VALUES (18, NULL, NULL, 1, 'B', 1000, 0, 0, 0, 0, 0);
INSERT INTO `groups` (`Id`, `nickname_kor`, `nickname_eng`, `inactive`, `r_group`, `points`, `hide_list`, `total_wins`, `total_losses`, `current_wins`, `current_losses`) VALUES (19, NULL, NULL, 1, 'C', 1000, 0, 0, 0, 0, 0);
INSERT INTO `groups` (`Id`, `nickname_kor`, `nickname_eng`, `inactive`, `r_group`, `points`, `hide_list`, `total_wins`, `total_losses`, `current_wins`, `current_losses`) VALUES (21, NULL, NULL, 1, 'B', 1000, 0, 0, 0, 0, 0);
INSERT INTO `groups` (`Id`, `nickname_kor`, `nickname_eng`, `inactive`, `r_group`, `points`, `hide_list`, `total_wins`, `total_losses`, `current_wins`, `current_losses`) VALUES (22, NULL, NULL, 1, 'A', 1000, 0, 0, 0, 0, 0);
INSERT INTO `groups` (`Id`, `nickname_kor`, `nickname_eng`, `inactive`, `r_group`, `points`, `hide_list`, `total_wins`, `total_losses`, `current_wins`, `current_losses`) VALUES (23, NULL, NULL, 0, 'B', 980, 0, 0, 1, 0, 1);
INSERT INTO `groups` (`Id`, `nickname_kor`, `nickname_eng`, `inactive`, `r_group`, `points`, `hide_list`, `total_wins`, `total_losses`, `current_wins`, `current_losses`) VALUES (24, NULL, NULL, 1, 'C', 1000, 0, 0, 0, 0, 0);
INSERT INTO `groups` (`Id`, `nickname_kor`, `nickname_eng`, `inactive`, `r_group`, `points`, `hide_list`, `total_wins`, `total_losses`, `current_wins`, `current_losses`) VALUES (25, NULL, NULL, 0, 'A', 940, 0, 0, 2, 0, 2);
INSERT INTO `groups` (`Id`, `nickname_kor`, `nickname_eng`, `inactive`, `r_group`, `points`, `hide_list`, `total_wins`, `total_losses`, `current_wins`, `current_losses`) VALUES (26, NULL, NULL, 1, 'B', 1000, 0, 0, 0, 0, 0);
INSERT INTO `groups` (`Id`, `nickname_kor`, `nickname_eng`, `inactive`, `r_group`, `points`, `hide_list`, `total_wins`, `total_losses`, `current_wins`, `current_losses`) VALUES (28, NULL, NULL, 0, 'A', 990, 0, 1, 2, 1, 2);
INSERT INTO `groups` (`Id`, `nickname_kor`, `nickname_eng`, `inactive`, `r_group`, `points`, `hide_list`, `total_wins`, `total_losses`, `current_wins`, `current_losses`) VALUES (29, NULL, NULL, 1, 'B', 1000, 0, 0, 0, 0, 0);
INSERT INTO `groups` (`Id`, `nickname_kor`, `nickname_eng`, `inactive`, `r_group`, `points`, `hide_list`, `total_wins`, `total_losses`, `current_wins`, `current_losses`) VALUES (32, NULL, NULL, 1, 'C', 1000, 0, 0, 0, 0, 0);
INSERT INTO `groups` (`Id`, `nickname_kor`, `nickname_eng`, `inactive`, `r_group`, `points`, `hide_list`, `total_wins`, `total_losses`, `current_wins`, `current_losses`) VALUES (35, NULL, NULL, 0, 'B', 1000, 0, 0, 0, 0, 0);
INSERT INTO `groups` (`Id`, `nickname_kor`, `nickname_eng`, `inactive`, `r_group`, `points`, `hide_list`, `total_wins`, `total_losses`, `current_wins`, `current_losses`) VALUES (36, NULL, NULL, 0, 'B', 1030, 0, 1, 0, 1, 0);
INSERT INTO `groups` (`Id`, `nickname_kor`, `nickname_eng`, `inactive`, `r_group`, `points`, `hide_list`, `total_wins`, `total_losses`, `current_wins`, `current_losses`) VALUES (37, NULL, NULL, 0, 'B', 1000, 0, 0, 0, 0, 0);
INSERT INTO `groups` (`Id`, `nickname_kor`, `nickname_eng`, `inactive`, `r_group`, `points`, `hide_list`, `total_wins`, `total_losses`, `current_wins`, `current_losses`) VALUES (38, NULL, NULL, 1, 'C', 1000, 0, 0, 0, 0, 0);
INSERT INTO `groups` (`Id`, `nickname_kor`, `nickname_eng`, `inactive`, `r_group`, `points`, `hide_list`, `total_wins`, `total_losses`, `current_wins`, `current_losses`) VALUES (39, NULL, NULL, 1, 'A', 1000, 0, 0, 0, 0, 0);
INSERT INTO `groups` (`Id`, `nickname_kor`, `nickname_eng`, `inactive`, `r_group`, `points`, `hide_list`, `total_wins`, `total_losses`, `current_wins`, `current_losses`) VALUES (41, NULL, NULL, 1, 'C', 1000, 0, 0, 0, 0, 0);
INSERT INTO `groups` (`Id`, `nickname_kor`, `nickname_eng`, `inactive`, `r_group`, `points`, `hide_list`, `total_wins`, `total_losses`, `current_wins`, `current_losses`) VALUES (43, NULL, NULL, 0, 'A', 1050, 0, 3, 1, 3, 1);
INSERT INTO `groups` (`Id`, `nickname_kor`, `nickname_eng`, `inactive`, `r_group`, `points`, `hide_list`, `total_wins`, `total_losses`, `current_wins`, `current_losses`) VALUES (44, NULL, NULL, 1, 'B', 1000, 0, 0, 0, 0, 0);
INSERT INTO `groups` (`Id`, `nickname_kor`, `nickname_eng`, `inactive`, `r_group`, `points`, `hide_list`, `total_wins`, `total_losses`, `current_wins`, `current_losses`) VALUES (45, NULL, NULL, 0, 'B', 1060, 0, 3, 2, 3, 2);
INSERT INTO `groups` (`Id`, `nickname_kor`, `nickname_eng`, `inactive`, `r_group`, `points`, `hide_list`, `total_wins`, `total_losses`, `current_wins`, `current_losses`) VALUES (46, NULL, NULL, 1, 'C', 1000, 0, 0, 0, 0, 0);
INSERT INTO `groups` (`Id`, `nickname_kor`, `nickname_eng`, `inactive`, `r_group`, `points`, `hide_list`, `total_wins`, `total_losses`, `current_wins`, `current_losses`) VALUES (48, NULL, NULL, 0, 'C', 1040, 0, 1, 0, 1, 0);
INSERT INTO `groups` (`Id`, `nickname_kor`, `nickname_eng`, `inactive`, `r_group`, `points`, `hide_list`, `total_wins`, `total_losses`, `current_wins`, `current_losses`) VALUES (49, NULL, NULL, 0, 'C', 960, 0, 0, 1, 0, 1);
INSERT INTO `groups` (`Id`, `nickname_kor`, `nickname_eng`, `inactive`, `r_group`, `points`, `hide_list`, `total_wins`, `total_losses`, `current_wins`, `current_losses`) VALUES (50, NULL, NULL, 1, 'C', 1000, 0, 0, 0, 0, 0);
INSERT INTO `groups` (`Id`, `nickname_kor`, `nickname_eng`, `inactive`, `r_group`, `points`, `hide_list`, `total_wins`, `total_losses`, `current_wins`, `current_losses`) VALUES (51, NULL, NULL, 1, 'C', 1000, 0, 0, 0, 0, 0);
INSERT INTO `groups` (`Id`, `nickname_kor`, `nickname_eng`, `inactive`, `r_group`, `points`, `hide_list`, `total_wins`, `total_losses`, `current_wins`, `current_losses`) VALUES (52, NULL, NULL, 1, 'C', 1000, 0, 0, 0, 0, 0);
INSERT INTO `groups` (`Id`, `nickname_kor`, `nickname_eng`, `inactive`, `r_group`, `points`, `hide_list`, `total_wins`, `total_losses`, `current_wins`, `current_losses`) VALUES (53, NULL, NULL, 1, 'C', 1000, 0, 0, 0, 0, 0);
INSERT INTO `groups` (`Id`, `nickname_kor`, `nickname_eng`, `inactive`, `r_group`, `points`, `hide_list`, `total_wins`, `total_losses`, `current_wins`, `current_losses`) VALUES (54, NULL, NULL, 1, 'C', 1000, 0, 0, 0, 0, 0);
INSERT INTO `groups` (`Id`, `nickname_kor`, `nickname_eng`, `inactive`, `r_group`, `points`, `hide_list`, `total_wins`, `total_losses`, `current_wins`, `current_losses`) VALUES (55, NULL, NULL, 1, 'C', 1000, 0, 0, 0, 0, 0);
INSERT INTO `groups` (`Id`, `nickname_kor`, `nickname_eng`, `inactive`, `r_group`, `points`, `hide_list`, `total_wins`, `total_losses`, `current_wins`, `current_losses`) VALUES (56, NULL, NULL, 1, 'C', 1000, 0, 0, 0, 0, 0);
INSERT INTO `groups` (`Id`, `nickname_kor`, `nickname_eng`, `inactive`, `r_group`, `points`, `hide_list`, `total_wins`, `total_losses`, `current_wins`, `current_losses`) VALUES (57, NULL, NULL, 1, 'C', 1000, 0, 0, 0, 0, 0);
INSERT INTO `groups` (`Id`, `nickname_kor`, `nickname_eng`, `inactive`, `r_group`, `points`, `hide_list`, `total_wins`, `total_losses`, `current_wins`, `current_losses`) VALUES (58, NULL, NULL, 1, 'C', 1000, 0, 0, 0, 0, 0);
INSERT INTO `groups` (`Id`, `nickname_kor`, `nickname_eng`, `inactive`, `r_group`, `points`, `hide_list`, `total_wins`, `total_losses`, `current_wins`, `current_losses`) VALUES (59, NULL, NULL, 1, 'C', 1000, 0, 0, 0, 0, 0);
INSERT INTO `groups` (`Id`, `nickname_kor`, `nickname_eng`, `inactive`, `r_group`, `points`, `hide_list`, `total_wins`, `total_losses`, `current_wins`, `current_losses`) VALUES (60, NULL, NULL, 1, 'C', 1000, 0, 0, 0, 0, 0);
INSERT INTO `groups` (`Id`, `nickname_kor`, `nickname_eng`, `inactive`, `r_group`, `points`, `hide_list`, `total_wins`, `total_losses`, `current_wins`, `current_losses`) VALUES (61, NULL, NULL, 1, 'C', 1000, 0, 0, 0, 0, 0);
INSERT INTO `groups` (`Id`, `nickname_kor`, `nickname_eng`, `inactive`, `r_group`, `points`, `hide_list`, `total_wins`, `total_losses`, `current_wins`, `current_losses`) VALUES (62, NULL, NULL, 0, 'C', 1000, 0, 0, 0, 0, 0);
INSERT INTO `groups` (`Id`, `nickname_kor`, `nickname_eng`, `inactive`, `r_group`, `points`, `hide_list`, `total_wins`, `total_losses`, `current_wins`, `current_losses`) VALUES (63, NULL, NULL, 1, 'C', 1000, 0, 0, 0, 0, 0);
INSERT INTO `groups` (`Id`, `nickname_kor`, `nickname_eng`, `inactive`, `r_group`, `points`, `hide_list`, `total_wins`, `total_losses`, `current_wins`, `current_losses`) VALUES (64, NULL, NULL, 1, 'C', 1000, 0, 0, 0, 0, 0);
INSERT INTO `groups` (`Id`, `nickname_kor`, `nickname_eng`, `inactive`, `r_group`, `points`, `hide_list`, `total_wins`, `total_losses`, `current_wins`, `current_losses`) VALUES (65, NULL, NULL, 1, 'C', 1000, 0, 0, 0, 0, 0);
INSERT INTO `groups` (`Id`, `nickname_kor`, `nickname_eng`, `inactive`, `r_group`, `points`, `hide_list`, `total_wins`, `total_losses`, `current_wins`, `current_losses`) VALUES (67, NULL, NULL, 1, 'C', 1000, 0, 0, 0, 0, 0);
INSERT INTO `groups` (`Id`, `nickname_kor`, `nickname_eng`, `inactive`, `r_group`, `points`, `hide_list`, `total_wins`, `total_losses`, `current_wins`, `current_losses`) VALUES (68, NULL, NULL, 1, 'C', 1000, 0, 0, 0, 0, 0);
INSERT INTO `groups` (`Id`, `nickname_kor`, `nickname_eng`, `inactive`, `r_group`, `points`, `hide_list`, `total_wins`, `total_losses`, `current_wins`, `current_losses`) VALUES (69, NULL, NULL, 1, 'C', 1000, 0, 0, 0, 0, 0);
INSERT INTO `groups` (`Id`, `nickname_kor`, `nickname_eng`, `inactive`, `r_group`, `points`, `hide_list`, `total_wins`, `total_losses`, `current_wins`, `current_losses`) VALUES (70, NULL, NULL, 1, 'C', 1000, 0, 0, 0, 0, 0);
INSERT INTO `groups` (`Id`, `nickname_kor`, `nickname_eng`, `inactive`, `r_group`, `points`, `hide_list`, `total_wins`, `total_losses`, `current_wins`, `current_losses`) VALUES (71, NULL, NULL, 1, 'C', 1000, 0, 0, 0, 0, 0);
INSERT INTO `groups` (`Id`, `nickname_kor`, `nickname_eng`, `inactive`, `r_group`, `points`, `hide_list`, `total_wins`, `total_losses`, `current_wins`, `current_losses`) VALUES (72, NULL, NULL, 1, 'C', 1000, 0, 0, 0, 0, 0);
INSERT INTO `groups` (`Id`, `nickname_kor`, `nickname_eng`, `inactive`, `r_group`, `points`, `hide_list`, `total_wins`, `total_losses`, `current_wins`, `current_losses`) VALUES (73, NULL, NULL, 1, 'B', 1000, 0, 0, 0, 0, 0);
INSERT INTO `groups` (`Id`, `nickname_kor`, `nickname_eng`, `inactive`, `r_group`, `points`, `hide_list`, `total_wins`, `total_losses`, `current_wins`, `current_losses`) VALUES (74, NULL, NULL, 1, 'C', 1000, 0, 0, 0, 0, 0);
INSERT INTO `groups` (`Id`, `nickname_kor`, `nickname_eng`, `inactive`, `r_group`, `points`, `hide_list`, `total_wins`, `total_losses`, `current_wins`, `current_losses`) VALUES (76, NULL, NULL, 0, 'B', 960, 0, 1, 2, 1, 2);
INSERT INTO `groups` (`Id`, `nickname_kor`, `nickname_eng`, `inactive`, `r_group`, `points`, `hide_list`, `total_wins`, `total_losses`, `current_wins`, `current_losses`) VALUES (77, NULL, NULL, 0, 'C', 1000, 0, 0, 0, 0, 0);
INSERT INTO `groups` (`Id`, `nickname_kor`, `nickname_eng`, `inactive`, `r_group`, `points`, `hide_list`, `total_wins`, `total_losses`, `current_wins`, `current_losses`) VALUES (78, NULL, NULL, 0, 'A', 1000, 0, 0, 0, 0, 0);
INSERT INTO `groups` (`Id`, `nickname_kor`, `nickname_eng`, `inactive`, `r_group`, `points`, `hide_list`, `total_wins`, `total_losses`, `current_wins`, `current_losses`) VALUES (79, NULL, NULL, 1, 'C', 1000, 0, 0, 0, 0, 0);
INSERT INTO `groups` (`Id`, `nickname_kor`, `nickname_eng`, `inactive`, `r_group`, `points`, `hide_list`, `total_wins`, `total_losses`, `current_wins`, `current_losses`) VALUES (81, NULL, NULL, 1, 'C', 1000, 0, 0, 0, 0, 0);
INSERT INTO `groups` (`Id`, `nickname_kor`, `nickname_eng`, `inactive`, `r_group`, `points`, `hide_list`, `total_wins`, `total_losses`, `current_wins`, `current_losses`) VALUES (82, NULL, NULL, 1, 'C', 1000, 0, 0, 0, 0, 0);
INSERT INTO `groups` (`Id`, `nickname_kor`, `nickname_eng`, `inactive`, `r_group`, `points`, `hide_list`, `total_wins`, `total_losses`, `current_wins`, `current_losses`) VALUES (83, NULL, NULL, 1, 'A', 1000, 0, 0, 0, 0, 0);
INSERT INTO `groups` (`Id`, `nickname_kor`, `nickname_eng`, `inactive`, `r_group`, `points`, `hide_list`, `total_wins`, `total_losses`, `current_wins`, `current_losses`) VALUES (84, NULL, NULL, 0, 'C', 1000, 0, 0, 0, 0, 0);
INSERT INTO `groups` (`Id`, `nickname_kor`, `nickname_eng`, `inactive`, `r_group`, `points`, `hide_list`, `total_wins`, `total_losses`, `current_wins`, `current_losses`) VALUES (85, NULL, NULL, 1, 'B', 1000, 0, 0, 0, 0, 0);
INSERT INTO `groups` (`Id`, `nickname_kor`, `nickname_eng`, `inactive`, `r_group`, `points`, `hide_list`, `total_wins`, `total_losses`, `current_wins`, `current_losses`) VALUES (86, NULL, NULL, 1, 'C', 1000, 0, 0, 0, 0, 0);
INSERT INTO `groups` (`Id`, `nickname_kor`, `nickname_eng`, `inactive`, `r_group`, `points`, `hide_list`, `total_wins`, `total_losses`, `current_wins`, `current_losses`) VALUES (87, NULL, NULL, 1, 'C', 1000, 0, 0, 0, 0, 0);
INSERT INTO `groups` (`Id`, `nickname_kor`, `nickname_eng`, `inactive`, `r_group`, `points`, `hide_list`, `total_wins`, `total_losses`, `current_wins`, `current_losses`) VALUES (91, NULL, NULL, 0, 'C', 1000, 0, 0, 0, 0, 0);
INSERT INTO `groups` (`Id`, `nickname_kor`, `nickname_eng`, `inactive`, `r_group`, `points`, `hide_list`, `total_wins`, `total_losses`, `current_wins`, `current_losses`) VALUES (92, NULL, NULL, 0, 'B', 940, 0, 1, 3, 1, 3);
INSERT INTO `groups` (`Id`, `nickname_kor`, `nickname_eng`, `inactive`, `r_group`, `points`, `hide_list`, `total_wins`, `total_losses`, `current_wins`, `current_losses`) VALUES (94, NULL, NULL, 0, 'B', 980, 0, 0, 1, 0, 1);
INSERT INTO `groups` (`Id`, `nickname_kor`, `nickname_eng`, `inactive`, `r_group`, `points`, `hide_list`, `total_wins`, `total_losses`, `current_wins`, `current_losses`) VALUES (95, NULL, NULL, 0, 'A', 1000, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `members`
-- 

CREATE TABLE `members` (
  `Id` int(11) NOT NULL auto_increment,
  `first_name` varchar(50) character set euckr default NULL,
  `last_name` varchar(50) character set euckr default NULL,
  `first_name_eng` varchar(50) default NULL,
  `last_name_eng` varchar(50) default NULL,
  `active_member` tinyint(3) default '1',
  `username` varchar(50) default NULL,
  `password` varchar(50) default NULL,
  `phone_cell` varchar(25) default NULL,
  `phone_home` varchar(25) default NULL,
  `email` varchar(50) default NULL,
  `address` varchar(250) default NULL,
  `city` varchar(25) default NULL,
  `zip` varchar(10) default NULL,
  `gender` varchar(4) default NULL,
  `status_student` tinyint(4) default NULL,
  `ethnicity_korean` tinyint(4) default NULL,
  `language_korean` tinyint(4) default NULL,
  `access_level` tinyint(3) default '1',
  PRIMARY KEY  (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=latin1 AUTO_INCREMENT=96 ;

-- 
-- Dumping data for table `members`
-- 

INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (1, '연택', '최', 'Yontaek', 'Choi', 1, 'cyont', '55dano', '520-309-1300', '520-309-1300', 'yontaek@hotmail.com', '7625 E. Cholla Overlook', 'Tucson', '85710', 'M', 0, 1, 1, 3);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (2, '민철', '강', 'Mincheol', 'Kang', 1, NULL, NULL, '520-818-4467', NULL, 'bandal8284@hanmail.net', '820 E. Grant', 'Tucson', '85719', 'M', 1, 1, 1, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (3, '순천', '권', 'Suncheon', 'Kwon', 1, NULL, NULL, '646-221-4412', NULL, 'ksc0607@gmail.com', '3700 N. Campbell, #514', 'Tucson', '85719', 'M', 1, 1, 1, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (4, '민수', '김', 'Minsoo', 'Kim', 1, NULL, NULL, '520-780-7824', NULL, 'minsoo76@email.arizona.edu', '3548 E. 3rd St.', 'Tucson', '85716', 'M', 1, 1, 1, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (5, '석후', '김', 'Seokhu', 'Kim', 1, NULL, NULL, '520-250-6102', '520-797-0449', NULL, '2471 W. Rapallo Way', 'Tucson', '85741', 'M', 0, 1, 1, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (6, '정희', '김', 'Jeong Hee', 'Kim', 1, NULL, NULL, '520-780-6154', NULL, 'hera0522@hotmail.com', '3548 E. 3rd St.', 'Tucson', '85716', 'F', 0, 1, 1, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (7, '준규', '김', NULL, NULL, 0, NULL, NULL, '520-203-2327', NULL, 'joon0007@yahoo.co.kr', NULL, NULL, NULL, 'M', 0, 1, 1, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (8, '한용', '김', 'Henri', 'Kim', 1, NULL, NULL, NULL, '520-529-2918', 'hardkim@comcast.net', '5516 E. Paseo Cimarron', 'Tucson', '85750', 'M', 0, 1, 0, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (9, '형수', '김', NULL, NULL, 0, NULL, NULL, '520-429-8211', NULL, 'hskim113@gmail.com', '4901 E. Sunrise Dr, #1102', 'Tucson', '85718', 'M', 1, 1, 1, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (10, '형철', '김', 'Hyungcheol', 'Kim', 1, NULL, NULL, '520-544-0480', '520-245-3787', NULL, '2444 W. Rousseau', 'Tucson', '85741', 'M', 0, 1, 1, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (11, '민석', '박', 'Minseok', 'Park', 1, NULL, NULL, '602-377-9362', NULL, 'syhm1212@gmail.com', '3535 N. 1st Ave., #R212', 'Tucson', '85719', 'M', 1, 1, 1, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (12, '현진', '박', 'Hyunjin', 'Park', 1, NULL, NULL, '520-370-6633', NULL, 'phj2569@hotmail.com', '2350 E. Water St. #13216', 'Tucson', '85719', 'M', 1, 1, 1, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (13, '영우', '서', 'Youngwoo', 'Seo', 1, NULL, NULL, '520-818-8870', NULL, 'youngwoo1314@gmail.com', '5999 N. Campo Abierto', 'Tucson', '85718', 'M', 1, 1, 0, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (14, '청만', '서', 'Chungman', 'Seo', 1, NULL, NULL, '520-990-6730', NULL, 'uracbul@gmail.com', '8075 E. Sundew Dr', 'Tucson', '85710', 'M', 0, 1, 1, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (15, '다할', '석', NULL, NULL, 0, NULL, NULL, '520-270-8288', NULL, 'daseok@email.arizona.edu', '4327 Rio Cancion Dr', 'Tucson', '85718', 'M', 1, 1, 0, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (16, '병훈', '유', 'Byung hoon', 'Yoo', 1, NULL, NULL, '520-560-2817', NULL, 'ybhwin@hanmail.net', '820 E. Grant', 'Tucson', '85719', 'M', 1, 1, 1, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (17, '기연', '윤', 'Ki', 'Yoon', 1, NULL, NULL, '520-444-9895', NULL, 'kime1@cox.net', '4794 S. Chilean Loop', 'Tucson', '85730', 'M', 0, 1, 1, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (18, '욱진', '윤', 'Wookjin', 'Yoon', 1, NULL, NULL, '520-343-8375', '520-575-4050', 'yunook@gmail.com', '12601 N, Yellow Bird Rd.', 'Oro Valley', '85755', 'M', 0, 1, 1, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (19, '경원', '이', 'Kyongwon', 'Lee', 1, NULL, NULL, '480-560-2817', NULL, 'ruddnjs0812@hotmail.com', '60 W. Stone Loop, #2212', 'Tucson', NULL, 'F', 1, 1, 1, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (20, '세훈', '이', 'Sehun', 'Lee', 0, NULL, NULL, '520-979-5927', NULL, 'snsceo.lee@gmail.com', '11 E. Orange Grove, #223', 'Tucson', NULL, 'M', 1, 1, 1, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (21, '은정', '이', 'Eunjeong', 'Lee', 1, NULL, NULL, '520-661-6019', NULL, 'hmmm95@gmail.com', '60 W. Stone Loop, #2526', 'Tucson', NULL, 'F', 1, 1, 1, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (22, '희산', '이', 'Heesan', 'Lee', 1, NULL, NULL, '520-429-6428', '520-878-8138', 'hesaw914@yahoo.com', '2398 W. Mono Way', 'Tucson', '85741', 'M', 1, 1, 0, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (23, '경룡', '장', 'Kyungryong', 'Jang', 1, NULL, NULL, '916-844-6308', NULL, 'mirjang57@yahoo.com', '820 E. Grant', 'Tucson', '85719', 'M', 1, 1, 1, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (24, '선애', '장', 'Sunae', 'Jang', 1, NULL, NULL, '520-465-1867', NULL, 'sunae.chang@comcast.net', NULL, NULL, NULL, 'F', 0, 1, 1, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (25, '원호', '정', 'Won Ho', 'Jung', 1, NULL, NULL, '520-331-3609', '520-546-3711', 'wonho6015@hotmail.com', '7731 E. Windriver Dr', 'Tucson', '85750', 'M', 0, 1, 1, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (26, '인철', '정', 'Incheol', 'Jeong', 1, NULL, NULL, '520-307-4120', NULL, 'eddiegolfer@gmail.com', '8619 N. Crosswater Lp', 'Tucson', NULL, 'M', 0, 1, 1, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (28, '재호', '최', 'Jae', 'Choi', 1, NULL, NULL, '520-603-2002', '520-529-5682', 'jchoimd@yahoo.com', '6123 E. Hawks Nest', 'Tucson', '85752', 'M', 0, 1, 0, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (29, 'Abhi', 'Nair', 'Abhi', 'Nair', 1, NULL, NULL, '520-400-9136', NULL, 'abhinair01@gmail.com', '3300 N. Paseo De Los Rios, #8106', 'Tucson', '85712', 'M', 0, 0, 0, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (30, 'Chota', 'Kuniyushi', NULL, NULL, 0, NULL, NULL, '520-203-6087', NULL, 'subaru_m45@hotmail.co.jp', '4126 E. North St', NULL, NULL, 'M', 1, 0, 0, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (32, 'John', 'Laurie', 'John', 'Laurie', 1, NULL, NULL, '520-241-5285', '520-303-4125', 'jlaurie@email.arizona.edu', '5174 E. Circulo Las Cabanos', 'Tucson', '85711', 'M', 1, 0, 0, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (34, 'Nathalie', 'Dieudonne', NULL, NULL, 0, NULL, NULL, '520-834-2109', NULL, 'nretreat3@hotmail.com', '2922 E. Linden St', NULL, NULL, 'F', 0, 0, 0, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (35, 'Prasad', 'Kari', 'Prasad', 'Kari', 1, NULL, NULL, '520-780-6634', NULL, 'prasadkari@gmail.com', NULL, NULL, NULL, 'M', 0, 0, 0, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (36, '형석', '조', 'Hyung-Seok', 'Cho', 1, NULL, NULL, '520-471-3106', NULL, 'hscho@posco.com', '3750 E. Via Palomita, #14203', NULL, NULL, 'M', 0, 1, 1, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (37, '영기', '윤', 'John', 'Yoon', 1, NULL, NULL, '520-977-2784', NULL, 'emailjy@gmail.com', NULL, NULL, NULL, 'M', 0, 1, 0, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (38, '진우', '송', 'Jinwoo', 'Song', 1, NULL, NULL, '520-664-5109', NULL, 'songj@email.arizona.edu', NULL, NULL, NULL, 'M', 1, 1, 1, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (39, '용훈', '황', 'Neil', 'Hwang', 1, NULL, NULL, '248-756-5874', NULL, 'neilhwang@gmail.com', '5050 E 5th St, APT F08', 'Tucson', '85711', 'M', 0, 1, 0, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (40, '재경', '이', NULL, NULL, 0, NULL, NULL, '714-702-0840', NULL, 'fatboydrummer@hotmail.com', '4140 E. Hawks Wing Dr', 'Tucson', NULL, 'M', 1, 1, 0, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (41, '영희', '김', 'Younghee', 'Kim', 1, NULL, NULL, '520-204-0800', '520-529-2918', 'hardkim@comcast.net', '5516 E. Paseo Cimarron', 'Tucson', '85750', 'F', 0, 1, 1, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (42, '상현', '박', NULL, NULL, 0, NULL, NULL, '520-248-1507', '520-344-0656', 'sanghyun@cs.yonsei.ac.kr', '5673 N. Verde Mountain Dr.', 'Tucson', NULL, 'M', 0, 1, 1, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (43, 'Steve', 'Bae', 'Steve', 'Bae', 1, 'steve', '717jeheon', '520-343-1715', NULL, 'hajun@yahoo.com', '13839 E. Sae Hills Dr', 'Vail', NULL, 'M', 0, 1, 1, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (44, '규상', '박', 'Kyusang', 'Park', 1, NULL, NULL, '805-252-6648', NULL, 'dufresne@empal.com', NULL, NULL, NULL, 'M', 1, 1, 1, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (45, '형중', '권', 'Hyung Joong', 'Kwon', 1, NULL, NULL, '520-395-6803', NULL, 'kwonhj@hotmail.com', '3750 E. Via Palomita 17104', 'Tucson', NULL, 'M', 1, 1, 1, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (46, '아리', '송', 'Ari', 'Song', 1, NULL, NULL, '520-461-4870', NULL, 'eggy5101@hotmail.com', '3750 E. Via Palomita 17104', 'Tucson', NULL, 'F', 0, 1, 1, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (47, '지영', '김', '', NULL, 0, NULL, NULL, NULL, '520-207-6180', 'cros502@naver.com', NULL, 'Tucson', NULL, 'M', 1, 1, 1, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (48, 'Young', 'Lee', 'Young', 'Lee', 1, NULL, NULL, NULL, '520-207-6180', 'yslee@longrealty.com', NULL, 'Tucson', NULL, 'F', 0, 1, 1, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (49, '형애', '이', 'HyungAe', 'Lee', 1, NULL, NULL, NULL, '520-207-6180', 'oso19@hanmail.net', NULL, 'Tucson', NULL, 'F', 0, 1, 1, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (50, 'Manu', 'Alexander', 'Manu', 'Alexander', 1, NULL, NULL, '520-981-6248', '520-742-3770', 'manualex@yahoo.com', NULL, 'Tucson', NULL, 'M', 0, 0, 0, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (51, '본정', '구', 'Jane', 'Koo', 1, NULL, NULL, '520-981-6681', '520-742-3770', 'janekoo29@yahoo.com', NULL, NULL, NULL, 'F', 0, 1, 0, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (52, '인애', '이', 'Inae', 'Lee', 1, NULL, NULL, NULL, NULL, 'inaelee88@yahoo.com', NULL, 'Tucson', NULL, 'F', 1, 1, 1, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (53, '동민', '장', 'Dongmin', 'Jang', 1, NULL, NULL, '520-401-0862', NULL, 'jdm0712@hotmail.com', NULL, 'Tucson', NULL, 'M', 1, 1, 1, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (54, '사랑', 'Laurie', 'Sarang', 'Laurie', 1, NULL, NULL, '520-407-6528', NULL, 'ekidai@hotmail.com', NULL, 'Tucson', NULL, 'F', 0, 1, 0, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (55, '슬기', '이', 'Seulki', 'Lee', 1, NULL, NULL, '520-873-7619', NULL, 'n018464@hotmail.com', NULL, 'Tucson', NULL, 'F', 1, 1, 1, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (56, 'Elra', 'Lee', 'Elra', 'Lee', 1, NULL, NULL, '714-743-3837', NULL, 'sui10047@hotmail.com', NULL, 'Tucson', NULL, 'F', 1, 1, 1, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (57, '순모', '가', 'Sunmo', 'Ka', 1, NULL, NULL, '520-780-7284', NULL, 'epilogue345@hotmail.com', NULL, 'Tucson', NULL, 'M', 1, 1, 1, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (58, '정현', '서', 'Jeonghyung', 'Seo', 1, NULL, NULL, '405-269-6152', NULL, 'joshsuh1976@hotmail.com', NULL, 'Tucson', NULL, 'M', 1, 1, 1, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (59, '언적', '최', 'Eonjeok', 'Choi', 1, NULL, NULL, '520-722-3664', NULL, 'unjok.choi@gmail.com', NULL, 'Tucson', NULL, 'M', 1, 1, 1, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (60, '창수', '이', 'Changsoo', 'Lee', 1, NULL, NULL, '602-448-1614', NULL, 'kaylee88@gmail.com', NULL, 'Tucson', NULL, 'M', 1, 1, 1, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (61, '성민', '천', 'Seongmin', 'Cheon', 1, NULL, NULL, '520-609-0810', NULL, 'cheonsm@hotmail.com', NULL, 'Tucson', NULL, 'M', 1, 1, 1, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (62, '민욱', '구', 'Minwook', 'Ku', 1, NULL, NULL, '520-465-6142', NULL, 'alitheia.ku@gmail.com', NULL, 'Tucson', NULL, 'M', 1, 1, 1, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (63, '성룡', '차', 'Frank', 'Cha', 1, NULL, NULL, '520-481-4595', NULL, 'chengLong417@hotmail.com', NULL, 'Tucson', NULL, 'M', 1, 1, 1, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (64, '남정', '김', 'Nam-Jeong', 'Kim', 1, NULL, NULL, '520-471-7150', NULL, 'nj0518@dreamwiz.com', NULL, 'Tucson', NULL, 'F', 0, 1, 1, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (65, '정연', '서', 'Jeongyon', 'Seo', 1, NULL, NULL, '520-730-5412', NULL, 'happyuracbul@gmail.com', NULL, 'Tucson', NULL, 'F', 0, 1, 1, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (66, '미경', '심', NULL, NULL, 0, NULL, NULL, '520-429-8407', NULL, 'pharmsuni@naver.com', NULL, 'Tucson', NULL, 'F', 0, 1, 1, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (67, '혜진', '홍', 'Hyejin', 'Hong', 1, NULL, NULL, '520-465-6189', NULL, 'kongne.hong@gmail.com', NULL, 'Tucson', NULL, 'F', 0, 1, 1, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (68, '수진', '김', 'Sujin', 'Kim', 1, NULL, NULL, '213-270-3827', NULL, 'ssangksj@naver.com', NULL, 'Tucson', NULL, 'F', 1, 1, 1, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (69, '은이', '김', 'Euni', 'Kim', 1, NULL, NULL, '480-861-7823', NULL, 'juliekim422@gmail.com', NULL, 'Tucson', NULL, 'F', 1, 1, 1, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (70, '상현', '박', 'Sanghyon', 'Park', 1, NULL, NULL, '520-834-6919', NULL, 'twoxheart@gmail.com', NULL, 'Tucson', NULL, 'M', 1, 1, 1, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (71, '창종', '이', 'Changjong', 'Lee', 1, NULL, NULL, '213-572-9716', NULL, 'changl@email.arizona.edu', NULL, 'Tucson', NULL, 'M', 1, 1, 1, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (72, '우나', '고', 'Una', 'Ko', 1, NULL, NULL, '520-243-0711', NULL, 'kohuna88@email.arizona.edu', NULL, 'Tucson', NULL, 'F', 1, 1, 1, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (73, '수환', '양', 'Josh', 'Yang', 1, NULL, NULL, '562-477-1202', NULL, 'joshyang12@hotmail.com', NULL, 'Tucson', NULL, 'M', 1, 1, 0, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (74, '민희', '강', 'Minhee', 'Kang', 1, NULL, NULL, '520-548-8998', NULL, 'mindy113@email.arizona.edu', NULL, 'Tucson', NULL, 'F', 1, 1, 1, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (75, '정훈', '윤', 'Jeonghun', 'Yoon', 0, NULL, NULL, '520-465-3533', NULL, 'coffeey@gmail.com', NULL, 'Tucson', NULL, 'M', 1, 1, 1, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (76, '기환', '남', 'Kihwan', 'Nam', 1, NULL, NULL, '312-519-2144', NULL, 'namkihwan@hotmail.com', NULL, 'Tucson', NULL, 'M', 1, 1, 1, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (77, '수진', '양', 'Sujin', 'Yang', 1, NULL, NULL, '520-576-7456', NULL, 'ysoo1121@gmail.com', NULL, 'Tucson', NULL, 'F', 1, 1, 1, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (78, '은민', '이', 'Eun Min', 'Lee', 1, NULL, NULL, '520-419-3987', NULL, 'eunminlee@hotmail.com', NULL, 'Tucson', NULL, 'M', 0, 1, 0, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (79, '혜정', '김', 'Hyejeong', 'Kim', 1, NULL, NULL, '520-730-4774', NULL, 'kyaz1004@hotmail.com', NULL, 'Tucson', NULL, 'F', 1, 1, 1, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (80, 'Ray', 'Gee', NULL, NULL, 0, NULL, NULL, '520-349-6180', NULL, 'rgee@amphi.com', NULL, 'Tucson', NULL, 'M', 0, 0, 0, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (81, '희진', '이', 'Heejin', 'Lee', 1, NULL, NULL, '520-342-7159', NULL, 'kh2jin@gmail.com', NULL, 'Tucson', NULL, 'M', 1, 1, 1, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (82, '기빈', '길', 'Kibin', 'Kil', 1, NULL, NULL, '520-306-7123', NULL, 'gil@email.arizona.edu', NULL, 'Tucson', NULL, 'M', 1, 1, 0, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (83, 'Kevin', 'Cho', 'Kevin', 'Cho', 1, NULL, NULL, '213-604-2791', NULL, 'ckevin87@email.arizona.edu', NULL, 'Tucson', NULL, 'M', 1, 1, 0, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (84, '종정', '김', 'Jongjeong', 'Kim', 1, NULL, NULL, NULL, NULL, 'dontorzz@gmail.com', NULL, 'Tucson', NULL, 'M', 1, 1, 1, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (85, 'Mae', 'Holdmann', 'Mae', 'Holdmann', 1, NULL, NULL, NULL, '520-271-7765', 'aholdman@asu.edu', NULL, 'Tucson', NULL, 'F', 0, 0, 0, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (86, '지원', '유', 'Jiwon', 'Yoo', 1, NULL, NULL, '520-991-2676', NULL, 'jineasy@gmail.com', NULL, 'Tucson', NULL, 'F', 1, 1, 1, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (87, '나단', '이', 'Nathan', 'Lee', 1, NULL, NULL, '520-419-7793', NULL, 'nate139@gmail.com', NULL, NULL, NULL, 'M', 1, 1, 0, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (91, '세진', '원', 'Sejin', 'Won', 1, NULL, NULL, '520-878-8350', NULL, 'ggobuk1942@naver.com', NULL, NULL, NULL, 'M', 1, 1, 1, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (92, 'Raymon', 'Cruz', 'Raymon', 'Cruz', 1, NULL, NULL, '520-979-6399', NULL, 'raymoncruz@rocketmail.com', NULL, NULL, NULL, 'M', 0, 0, 0, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (94, '규완', '김', 'Kyoo Wan', 'Kim', 1, NULL, NULL, '443-540-6922', NULL, 'kimkyoo52@aol.com', NULL, NULL, NULL, 'M', 0, 1, 1, 1);
INSERT INTO `members` (`Id`, `first_name`, `last_name`, `first_name_eng`, `last_name_eng`, `active_member`, `username`, `password`, `phone_cell`, `phone_home`, `email`, `address`, `city`, `zip`, `gender`, `status_student`, `ethnicity_korean`, `language_korean`, `access_level`) VALUES (95, '지연', '오', 'Roger', 'Oh', 1, NULL, NULL, '480-516-8964', NULL, 'rogeroh2000@yahoo.co.kr', NULL, NULL, NULL, 'M', 0, 1, 1, 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `pics`
-- 

CREATE TABLE `pics` (
  `id` int(190) NOT NULL auto_increment,
  `caption` varchar(1000) NOT NULL default '',
  `descc` varchar(4000) NOT NULL default '',
  `img` varchar(190) NOT NULL default '',
  `width_big` smallint(6) default NULL,
  `height_big` smallint(6) default NULL,
  `width_small` smallint(6) default NULL,
  `height_small` smallint(6) default NULL,
  `hits` tinyint(3) NOT NULL default '0',
  `date_uploaded` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=196 DEFAULT CHARSET=latin1 AUTO_INCREMENT=196 ;

-- 
-- Dumping data for table `pics`
-- 

INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (118, '&#44608;&#54805;&#49688;', '', 'CIMG1090_20849.JPG', 800, 598, 150, 112, 58, '2010-01-22 00:00:00');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (119, '&#51221;&#50896;&#54840; & &#51060;&#49464;&#54984;', '', 'CIMG1102_21002.JPG', 800, 521, 150, 97, 66, '2010-01-22 00:00:00');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (120, '&#44608;&#54620;&#50857; & &#44608;&#54805;&#49688;', '', 'CIMG1119_21234.JPG', 800, 547, 150, 102, 67, '2010-01-22 00:00:00');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (121, '&#44608;&#51456;&#44508; & &#51060;&#49464;&#54984;', '', 'CIMG1131_21314.JPG', 786, 540, 150, 103, 68, '2010-01-22 00:00:00');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (122, '&#51221;&#50896;&#54840; & &#52572;&#51116;&#54840;', '', 'CIMG1135_21342.JPG', 800, 563, 150, 105, 65, '2010-01-22 00:00:00');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (123, '&#51221;&#50896;&#54840;', '', 'CIMG1136_21358.JPG', 640, 480, 150, 112, 69, '2010-01-22 00:00:00');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (124, '&#44608;&#54620;&#50857; & &#52572;&#51116;&#54840; & &#51221;&#50896;&#54840;', '', 'CIMG1141_21442.JPG', 640, 480, 150, 112, 72, '2010-01-22 00:00:00');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (125, '&#51109;&#44221;&#47329;', '', 'CIMG1186_21458.JPG', 600, 800, 150, 150, 73, '2010-01-22 00:00:00');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (126, '&#51221;&#50896;&#54840;', '', 'CIMG1198_21532.JPG', 600, 800, 112, 150, 66, '2010-01-22 00:00:00');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (127, '&#44608;&#54805;&#52384;', '', 'CIMG1201_21557.JPG', 600, 800, 112, 150, 60, '2010-01-22 00:00:00');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (128, '&#44608;&#54620;&#50857;', '', 'CIMG1202_21612.JPG', 600, 800, 112, 150, 71, '2010-01-22 00:00:00');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (129, '&#44608;&#49437;&#54980;', '', 'CIMG1203_21638.JPG', 600, 800, 112, 150, 81, '2010-01-22 00:00:00');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (130, '&#51060;&#49464;&#54984;', '', 'CIMG1209_21655.JPG', 600, 800, 112, 150, 82, '2010-01-22 00:00:00');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (131, '&#44608;&#49437;&#54980; & &#44608;&#54805;&#52384;', '', 'CIMG1441_225320.JPG', 800, 600, 150, 112, 71, '2010-02-02 22:53:21');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (132, '&#51221;&#50896;&#54840; & &#52572;&#51116;&#54840;', '', 'CIMG1442_225422.JPG', 800, 600, 150, 112, 64, '2010-02-02 22:54:23');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (133, '&#44608;&#51456;&#44508; & Abhi Nair', '&#44608;&#51456;&#44508; & Abhi Nair', 'CIMG1444_225505.JPG', 800, 600, 150, 112, 69, '2010-02-02 22:55:05');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (134, 'Abhi Nair & &#44608;&#51456;&#44508;', '', 'CIMG1454_225550.JPG', 800, 600, 150, 112, 74, '2010-02-02 22:55:50');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (135, '&#49436;&#52397;&#47564; & &#44608;&#54620;&#50857;', '', 'CIMG1458_225609.JPG', 800, 600, 150, 112, 93, '2010-02-02 22:56:09');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (136, 'John Laurie', '', 'CIMG1475_152332.JPG', 800, 713, 150, 133, 115, '2010-02-06 15:23:33');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (137, '&#44608;&#54805;&#49688;', '', 'CIMG1479_152351.JPG', 800, 600, 150, 112, 85, '2010-02-06 15:23:51');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (138, '3060;1464;6984; & 3221;2896;6840;', '', 'CIMG1495_152421.JPG', 800, 571, 150, 107, 87, '2010-02-06 00:00:00');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (139, '&#49436;&#50689;&#50864;', '', 'CIMG0063_101138.JPG', 800, 600, 150, 112, 127, '2010-04-17 10:11:38');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (140, '&#44608;&#48124;&#49688;', '', 'CIMG0064_101223.JPG', 800, 600, 150, 112, 113, '2010-04-17 10:12:24');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (141, '&#49436;&#50689;&#50864; & &#44608;&#54805;&#49688; & &#51060;&#51116;&#44221;', '', 'CIMG0065_101252.JPG', 800, 600, 150, 112, 110, '2010-04-17 10:12:52');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (142, '&#54889;&#50857;&#54984; & &#44608;&#51456;&#44508;', '', 'CIMG0071_101341.JPG', 800, 600, 150, 112, 127, '2010-04-17 10:13:42');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (143, '&#54889;&#50857;&#54984;', '', 'CIMG0073_101533.JPG', 800, 600, 150, 112, 85, '2010-04-17 10:15:33');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (144, '&#44608;&#51456;&#44508;', '', 'CIMG0074_101615.JPG', 800, 688, 150, 129, 92, '2010-04-17 10:16:15');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (145, '&#50980;&#44592;&#50672;', '', 'CIMG0075_101635.JPG', 800, 600, 150, 112, 80, '2010-04-17 10:16:35');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (146, '&#51228; 2&#54924; &#54620;&#51064;&#54924;&#51109;&#48176; &#53580;&#45768;&#49828; &#45824;&#54924;', '', 'IMG_6149_155829.JPG', 800, 533, 150, 99, 71, '2010-05-01 15:58:29');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (147, '&#51312;&#54805;&#49437; - &#51228; 2&#54924; &#54620;&#51064;&#54924;&#51109;&#48176; &#53580;&#45768;&#49828; &#45824;&#54924;', '', 'IMG_6155_155938.JPG', 600, 900, 100, 150, 64, '2010-05-01 15:59:38');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (148, '&#52572;&#51116;&#54840; - &#51228; 2&#54924; &#54620;&#51064;&#54924;&#51109;&#48176; &#53580;&#45768;&#49828; &#45824;&#54924;', '', 'IMG_6160_160033.JPG', 600, 900, 100, 150, 69, '2010-05-01 16:00:33');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (149, '&#51060;&#49464;&#54984; - &#51228; 2&#54924; &#54620;&#51064;&#54924;&#51109;&#48176; &#53580;&#45768;&#49828; &#45824;&#54924; &#48373;&#49885; &#50864;&#49849;', '', 'IMG_6161_160043.JPG', 600, 900, 100, 150, 69, '2010-05-01 16:00:44');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (150, '&#51060;&#49464;&#54984; & &#52572;&#51116;&#54840; - &#51228; 2&#54924; &#54620;&#51064;&#54924;&#51109;&#48176; &#53580;&#45768;&#49828; &#45824;&#54924;', '', 'IMG_6162_160101.JPG', 600, 900, 100, 150, 86, '2010-05-01 16:01:01');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (151, '&#44608;&#51456;&#44508; - &#51228; 2&#54924; &#54620;&#51064;&#54924;&#51109;&#48176; &#53580;&#45768;&#49828; &#45824;&#54924; B&#51312; &#50864;&#49849;', '', 'IMG_6164_160437.JPG', 600, 900, 100, 150, 74, '2010-05-01 16:04:37');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (152, '&#44608;&#48124;&#49688; - &#51228; 2&#54924; &#54620;&#51064;&#54924;&#51109;&#48176; &#53580;&#45768;&#49828; &#45824;&#54924;', '', 'IMG_6166_160507.JPG', 600, 900, 100, 150, 70, '2010-05-01 16:05:07');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (153, '&#51228; 2&#54924; &#54620;&#51064;&#54924;&#51109;&#48176; &#53580;&#45768;&#49828; &#45824;&#54924;', '', 'IMG_6169_160520.JPG', 800, 533, 150, 99, 75, '2010-05-01 16:05:21');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (154, '&#51060;&#55148;&#49328; - &#51228; 2&#54924; &#54620;&#51064;&#54924;&#51109;&#48176; &#53580;&#45768;&#49828; &#45824;&#54924;', '', 'IMG_6174_160538.JPG', 800, 533, 150, 99, 74, '2010-05-01 16:05:38');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (155, '&#51221;&#50896;&#54840; & &#52572;&#51116;&#54840; - &#51228; 2&#54924; &#54620;&#51064;&#54924;&#51109;&#48176; &#53580;&#45768;&#49828; &#45824;&#54924;', '', 'IMG_6176_160632.JPG', 800, 533, 150, 99, 78, '2010-05-01 16:06:32');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (156, '&#50980;&#50689;&#44592; & &#50980;&#44592;&#50672; - &#51228; 2&#54924; &#54620;&#51064;&#54924;&#51109;&#48176; &#53580;&#45768;&#49828; &#45824;&#54924;', '', 'IMG_6179_160700.JPG', 800, 533, 150, 99, 79, '2010-05-01 16:07:00');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (157, '&#51312;&#54805;&#49437; - &#51228; 2&#54924; &#54620;&#51064;&#54924;&#51109;&#48176; &#53580;&#45768;&#49828; &#45824;&#54924; C&#51312; &#50864;&#49849;', '', 'IMG_6188_160752.JPG', 800, 533, 150, 99, 75, '2010-05-01 16:07:52');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (158, '&#50980;&#44592;&#50672; - &#51228; 2&#54924; &#54620;&#51064;&#54924;&#51109;&#48176; &#53580;&#45768;&#49828; &#45824;&#54924;', '', 'IMG_6192_160901.JPG', 800, 533, 150, 99, 86, '2010-05-01 16:09:01');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (159, '&#51221;&#50896;&#54840; - &#51228; 2&#54924; &#54620;&#51064;&#54924;&#51109;&#48176; &#53580;&#45768;&#49828; &#45824;&#54924;', '', 'IMG_6193_160913.JPG', 800, 533, 150, 99, 69, '2010-05-01 16:09:13');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (160, '&#52572;&#50672;&#53469; - &#51228; 2&#54924; &#54620;&#51064;&#54924;&#51109;&#48176; &#53580;&#45768;&#49828; &#45824;&#54924;', '', 'IMG_6198_160924.JPG', 800, 533, 150, 99, 84, '2010-05-01 16:09:24');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (161, '&#51228; 2&#54924; &#54620;&#51064;&#54924;&#51109;&#48176; &#53580;&#45768;&#49828; &#45824;&#54924;', '', 'IMG_6201_160937.JPG', 800, 533, 150, 99, 88, '2010-05-01 16:09:37');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (162, 'John Laurie - &#51228; 2&#54924; &#54620;&#51064;&#54924;&#51109;&#48176; &#53580;&#45768;&#49828; &#45824;&#54924; C&#51312; &#51456;&#50864;&#49849;', '', 'IMG_6207_160954.JPG', 800, 533, 150, 99, 83, '2010-05-01 16:09:54');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (163, '&#51312;&#54805;&#49437; & &#44608;&#48124;&#49688; & John Laurie', '', 'IMG_6208_161026.JPG', 800, 533, 150, 99, 76, '2010-05-01 16:10:27');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (164, '&#51228; 2&#54924; &#54620;&#51064;&#54924;&#51109;&#48176; &#53580;&#45768;&#49828; &#45824;&#54924;', '', 'IMG_6209_161133.JPG', 800, 533, 150, 99, 84, '2010-05-01 16:11:33');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (165, '&#51228; 2&#54924; &#54620;&#51064;&#54924;&#51109;&#48176; &#53580;&#45768;&#49828; &#45824;&#54924;', '', 'IMG_6211_161143.JPG', 800, 533, 150, 99, 101, '2010-05-01 16:11:43');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (167, 'Tennis Lesson', 'Mr. Sehun Lee is giving a lesson on forehand stroke.', 'CIMG0240_163214.JPG', 800, 514, 150, 96, 66, '2010-06-01 16:32:14');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (168, 'Picnic at Ft. Lowell Park', '', 'CIMG0247_164211.JPG', 800, 600, 150, 112, 84, '2010-06-01 16:42:11');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (169, 'Picnic at Ft. Lowell Park', '', 'CIMG0248_164222.JPG', 800, 600, 150, 112, 72, '2010-06-01 16:42:23');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (170, 'Picnic at Ft. Lowell Park', '', 'CIMG0251_164258.JPG', 800, 600, 150, 112, 64, '2010-06-01 16:42:59');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (171, 'Picnic at Ft. Lowell Park', '', 'CIMG0252_164308.JPG', 800, 600, 150, 112, 76, '2010-06-01 16:43:08');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (172, 'Lake at Ft. Lowell Park', '', 'CIMG0258_164325.JPG', 800, 600, 150, 112, 73, '2010-06-01 16:43:25');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (173, 'Picnic at Ft. Lowell Park', '', 'CIMG0271_164333.JPG', 800, 600, 150, 112, 74, '2010-06-01 16:43:34');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (174, 'Picnic at Ft. Lowell Park', '', 'CIMG0272_164342.JPG', 800, 600, 150, 112, 75, '2010-06-01 16:43:42');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (175, 'Picnic at Ft. Lowell Park', '', 'CIMG0274_164350.JPG', 800, 600, 150, 112, 76, '2010-06-01 16:43:51');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (177, 'Tennis Lesson', '', 'CIMG0279_144033.JPG', 800, 552, 150, 103, 88, '2010-06-07 14:40:34');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (178, '&#53804;&#49328; &#46496;&#45208;&#44592; &#51204; &#44608;&#51456;&#44508; &#48149;&#49324;&#45784;&#51032; &#47560;&#51648;&#47561; &#44221;&#44592;', '', 'CIMG0281_144252.JPG', 800, 438, 150, 82, 108, '2010-06-07 14:42:52');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (179, '&#44032;&#51313;&#51060; &#45796; &#50752;&#49436; &#51025;&#50896; &#51473;', '', 'CIMG0791_140150.JPG', 800, 600, 150, 112, 99, '2010-08-16 14:01:50');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (180, '&#53580;&#45768;&#49828; &#47112;&#49832; &#51473;', '', 'CIMG0795_140221.JPG', 800, 559, 150, 104, 89, '2010-08-16 14:02:21');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (181, '&#53580;&#45768;&#49828; &#47112;&#49832; &#51473;', '', 'CIMG0796_140229.JPG', 800, 468, 150, 87, 70, '2010-08-16 14:02:29');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (182, '&#51228; 1&#54924; &#52404;&#50977;&#54924;&#51109;&#48176; &#53580;&#45768;&#49828; &#45824;&#54924; (Phoenix)', '', 'CIMG1028_164813.JPG', 800, 600, 150, 112, 54, '2010-11-30 16:48:13');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (183, '&#51228; 1&#54924; &#52404;&#50977;&#54924;&#51109;&#48176; &#53580;&#45768;&#49828; &#45824;&#54924; (&#44428;&#49692;&#52380; & &#52992;&#48712;&#51312;)', '', 'CIMG1023_164954.JPG', 800, 600, 150, 112, 47, '2010-11-30 16:49:54');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (184, '&#51228; 1&#54924; &#52404;&#50977;&#54924;&#51109;&#48176; &#53580;&#45768;&#49828; &#45824;&#54924; (&#51060;&#51008;&#48124; & &#54637;&#50857;&#54984;)', '', 'CIMG1024_165020.JPG', 800, 600, 150, 112, 46, '2010-11-30 16:50:20');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (185, '&#51228; 1&#54924; &#52404;&#50977;&#54924;&#51109;&#48176; &#53580;&#45768;&#49828; &#45824;&#54924; (&#51060;&#51008;&#48124;)', '', 'CIMG1027_165036.JPG', 800, 600, 150, 112, 59, '2010-11-30 16:50:36');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (186, 'Party at Mr. Henry Kim''s', '', 'CIMG1426_140559.JPG', 800, 600, 150, 112, 44, '2010-12-27 14:05:59');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (187, 'Party at Mr. Henry Kim''s', '', 'CIMG1428_140618.JPG', 800, 600, 150, 112, 47, '2010-12-27 14:06:18');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (188, 'Party at Mr. Henry Kim''s (&#51060;&#51008;&#48124; & &#44428;&#49692;&#52380;)', '', 'CIMG1431_140643.JPG', 800, 600, 150, 112, 54, '2010-12-27 14:06:43');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (189, 'Party at Mr. Henry Kim''s', '', 'CIMG1432_140707.JPG', 800, 600, 150, 112, 47, '2010-12-27 14:07:07');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (190, 'Party at Mr. Henry Kim''s', '', 'CIMG1434_140739.JPG', 800, 600, 150, 112, 53, '2010-12-27 14:07:39');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (191, 'Party at Mr. Henry Kim''s', '', 'CIMG1438_140751.JPG', 800, 600, 150, 112, 49, '2010-12-27 14:07:51');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (192, 'Party at Mr. Henry Kim''s', '', 'CIMG1440_140802.JPG', 800, 600, 150, 112, 49, '2010-12-27 14:08:02');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (193, 'Party at Mr. Henry Kim''s', '', 'CIMG1442_140814.JPG', 800, 600, 150, 112, 54, '2010-12-27 14:08:14');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (194, 'Steve Bae & &#49436;&#52397;&#47564;', '', 'CIMG1528_111401.JPG', 800, 593, 150, 111, 36, '2011-01-04 11:14:01');
INSERT INTO `pics` (`id`, `caption`, `descc`, `img`, `width_big`, `height_big`, `width_small`, `height_small`, `hits`, `date_uploaded`) VALUES (195, '&#52572;&#51116;&#54840; & &#50980;&#50689;&#44592;', '', 'CIMG1535_111442.JPG', 800, 542, 150, 101, 32, '2011-01-04 11:14:42');
