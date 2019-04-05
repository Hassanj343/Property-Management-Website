-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 25, 2014 at 01:25 PM
-- Server version: 5.5.33
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `whp_2`
--

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `value` longblob,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `name`, `value`, `title`) VALUES
(1, 'aboutus', 0x3c70207374796c653d22746578742d616c69676e3a206a7573746966793b206c696e652d6865696768743a20313470783b206d617267696e3a203070782030707820313470783b2070616464696e673a203070783b20666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e733b223e266e6273703b3c2f703e0a3c70207374796c653d22746578742d616c69676e3a206a7573746966793b206c696e652d6865696768743a20313470783b206d617267696e3a203070782030707820313470783b2070616464696e673a203070783b20666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e733b223e5075626c696320536563746f7220736b696c6c732e2041732061207370656369616c69737420686f7573696e672070726f766964657220576869746568616c6c2050726f7065727479204d616e6167656d656e7420616374206f6e20626568616c66206f66206c6f63616c20636f756e63696c207465616d732c20686f7573696e67206173736f63696174696f6e7320616e6420766172696f7573206f746865722063686172697461626c65206f7267616e69736174696f6e732e20496e2073756368206120636f6e746578742077652063616e2070726f7669646520686f7573696e6720746f2074686f73652076756c6e657261626c652070656f706c65207365656b696e6720737570706f72746564206163636f6d6d6f646174696f6e2e3c2f703e0a3c70207374796c653d22746578742d616c69676e3a206a7573746966793b206c696e652d6865696768743a20313470783b206d617267696e3a203070782030707820313470783b2070616464696e673a203070783b20666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e733b223e50726976617465204c6574732e20576520616c736f2068617665207374726f6e672065787065727469736520696e2070726f766964696e672053686f7274205465726d204c65747320666f7220636f6d70616e6965732077686f2068617665206120686f7573696e6720726571756972656d656e7420666f72207374616666207370656369616c69736520696e2073686f7274207465726d206c65747320666f72207374616666206f6e2073686f7274207465726d20656d706c6f796d656e7420636f6e7472616374732e3c2f703e0a3c70207374796c653d22746578742d616c69676e3a206a7573746966793b206c696e652d6865696768743a20313470783b206d617267696e3a203070782030707820313470783b2070616464696e673a203070783b20666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e733b223e3c666f6e7420666163653d22417269616c2c2048656c7665746963612c2073616e73223e3c7370616e207374796c653d226c696e652d6865696768743a20313470783b223e5768657468657220796f7520617265207669736974696e672042726164666f72642c2057616b656669656c64206f7220487564646572736669656c6420616e642074686520737572726f756e64696e6720617265617320666f7220627573696e6573732077652063616e2066696e64207468652072696768742073686f7274207465726d206163636f6d6d6f646174696f6e20666f7220796f757220737461792e20266e6273703b436f6e73696465722072656e74696e67206f6e65206f66206f7572206d616e792066756c6c79206675726e697368656420666c6174732e20266e6273703b5468697320697320612073656e7369626c6520616e6420636f73742065666665637469766520616c7465726e617469766520746f2073746179696e67206c6f6e67207465726d20696e206120686f74656c2c20616e642070726f766964657320796f7520616e6420796f757220627573696e657373207769746820666172206772656174657220666c65786962696c6974792e3c2f7370616e3e3c2f666f6e743e3c2f703e0a3c70207374796c653d22746578742d616c69676e3a206a7573746966793b206c696e652d6865696768743a20313470783b206d617267696e3a203070782030707820313470783b2070616464696e673a203070783b20666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e733b223e3c666f6e7420666163653d22417269616c2c2048656c7665746963612c2073616e73223e3c7370616e207374796c653d226c696e652d6865696768743a20313470783b223e4f75722073686f727420737461792c2053656c662d6361746572696e67206163636f6d6d6f646174696f6e206973207065726665637420666f722066616d696c69657320616e642067726f757073206f6620667269656e64732e204561636820686f6d652069732066756c6c79206675726e697368656420616e642065717569707065642077697468206b69746368656e20616e64206c61756e64727920666163696c6974696573206f6e20736974652c207768696368206d616b6520796f7572206c696665206d7563682065617369657220647572696e67207468652073686f7274207374617920696e2042726164666f72642e20456e7465727461696e206c6f63616c20667269656e64732c2074616b6520796f7572206d65616c73207768656e20796f752077616e742c20616e642073696d706c7920656e6a6f79207468652066726565646f6d206f66206265696e672061626c6520746f20636f6d6520616e6420676f20617320796f7520706c656173652e3c2f7370616e3e3c2f666f6e743e3c2f703e0a3c70207374796c653d22746578742d616c69676e3a206a7573746966793b206c696e652d6865696768743a20313470783b206d617267696e3a203070782030707820313470783b2070616464696e673a203070783b20666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e733b223e4f757220436f72706f7261746520486f7573696e672069732066756c6c79206675726e697368656420616e6420657175697070656420746f206f6666657220796f752074686520696465616c2073686f727420737461792c207065726665637420666f7220616e20657874656e64656420737461792e204166666f726461626c6520686f6c696461792073747564696f73206f72206c75787572696f75732065786563757469766520686f6d65732c20747261646974696f6e616c20616e6420686f6d656c79206f72207769746820736c65656b206d6f6465726e20696e746572696f72732c20696e2042726164666f7264206f7220736c696768746c79206d6f726520737562757262616e2061726561732e20266e6273703b596f752067657420746f2063686f6f73652077686174206265737420737569747320796f757220746173746520616e6420796f7572206275646765742e20266e6273703b576861746576657220796f757220707265666572656e6365207468657265206973206120636f6d666f727461626c6520686f6d6520746f207375697420626f7468206c65697375726520616e6420627573696e6573732074726176656c6c65727320647572696e6720796f75722073686f7274207374617920696e2042726164666f726420616e6420737572726f756e64696e672061726561732e3c2f703e0a3c70207374796c653d22746578742d616c69676e3a206a7573746966793b206c696e652d6865696768743a20313470783b206d617267696e3a203070782030707820313470783b2070616464696e673a203070783b20666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e733b223e416c6c207468652053686f7274205374617920686f6d6573207765206f666665722061726520636f6e76656e69656e746c79206c6f636174656420696e20706f70756c6172206c6f636174696f6e732c20636c6f736520746f207075626c6963207472616e73706f727420616e642068616e647920666f72207468652073757065726d61726b65742e2057652077696c6c206f6e6c79206f6666657220796f75206163636f6d6d6f646174696f6e20746861742069732066756c6c792065717569707065642c20736f206a757374206272696e6720796f7572207375697463617365213c2f703e0a3c70207374796c653d22746578742d616c69676e3a206a7573746966793b206c696e652d6865696768743a20313470783b206d617267696e3a203070782030707820313470783b2070616464696e673a203070783b20666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e733b223e266e6273703b3c2f703e0a3c70207374796c653d22746578742d616c69676e3a206a7573746966793b206c696e652d6865696768743a20313470783b206d617267696e3a203070782030707820313470783b2070616464696e673a203070783b20666f6e742d66616d696c793a20417269616c2c2048656c7665746963612c2073616e733b223e266e6273703b3c2f703e, 'Why Whitehall ...'),
(2, '', '', 'Investor Properties');

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `postcode` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `beds` varchar(255) DEFAULT NULL,
  `description` longtext,
  `images` longtext,
  `lat` float(10,6) NOT NULL,
  `lng` float(10,6) NOT NULL,
  `features` longtext NOT NULL,
  `type` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `name`, `address`, `postcode`, `city`, `price`, `beds`, `description`, `images`, `lat`, `lng`, `features`, `type`) VALUES
(3, 'Property 1', '75 Mannigham Lane', 'BD1 3BA', 'Bradford', '99,999,999', '5', '<p>Quisque cursus magna at lectus condimentum, in commodo odio ullamcorper. Duis ac nisl quis ligula vestibulum ornare. Maecenas elementum porttitor aliquam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum porta, massa eu cursus faucibus, elit ligula rutrum diam, sit amet hendrerit lorem ante id purus. Quisque ultrices nunc in ipsum lobortis, a convallis magna posuere. Nam id laoreet mi. Ut viverra porta arcu. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Praesent nec urna eros. Sed feugiat nisi eget ligula rutrum auctor. Integer lorem sem, blandit nec tristique laoreet, elementum ut dolor.</p>', '07051009', 53.800091, -1.759213, 'Feature 1\r\nFeature 2\r\nFeature 3\r\nFeature 4\r\nFeature 5', 'sale'),
(4, 'Property 2', '75 Mannigham Lane', 'LS1 2HL', 'Bradford', '999,999', '5', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla lorem ligula, dignissim id egestas vitae, facilisis eu dui. Pellentesque a ultricies risus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Pellentesque nec sapien augue. Nunc suscipit urna aliquam porta venenatis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Ut dui elit, aliquet sit amet imperdiet vel, pulvinar eu purus. Cras porttitor sollicitudin arcu, id blandit est mattis eget. Nullam sagittis dignissim placerat. Quisque aliquet facilisis quam dignissim sagittis. Duis ligula leo, molestie quis porttitor id, scelerisque nec augue. Duis a ornare mi. Nulla sed vulputate ipsum, sed laoreet elit. Cras et laoreet dui. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. <strong>Quisque cursus magna at lectus condimentum, in commodo odio ullamcorper. Duis ac nisl quis ligula vestibulum ornare. Maecenas elementum porttitor aliquam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum porta, massa eu cursus faucibus, elit ligula rutrum diam, sit amet hendrerit lorem ante id purus. Quisque ultrices nunc in ipsum lobortis, a convallis magna posuere. Nam id laoreet mi. Ut viverra porta arcu. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Praesent nec urna eros. Sed feugiat nisi eget ligula rutrum auctor. Integer lorem sem, blandit nec tristique laoreet, elementum ut dolor.</strong></p>', '07051009', 53.797333, -1.549829, 'sadasdas\r\ndasdas\r\ndasd\r\nas\r\ndasdsad', 'sale'),
(5, 'Property 1', '75 Mannigham Lane', 'BD1 3BA', 'Bradford', '999 p/w', '5', '<p>Quisque cursus magna at lectus condimentum, in commodo odio ullamcorper. Duis ac nisl quis ligula vestibulum ornare. Maecenas elementum porttitor aliquam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum porta, massa eu cursus faucibus, elit ligula rutrum diam, sit amet hendrerit lorem ante id purus. Quisque ultrices nunc in ipsum lobortis, a convallis magna posuere. Nam id laoreet mi. Ut viverra porta arcu. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Praesent nec urna eros. Sed feugiat nisi eget ligula rutrum auctor. Integer lorem sem, blandit nec tristique laoreet, elementum ut dolor.</p>', '07051009', 53.800091, -1.759213, 'Feature 1\r\nFeature 2\r\nFeature 3\r\nFeature 4\r\nFeature 5', 'rent'),
(6, 'PCV1233', '99 Test Lane', 'BD99 9BA', 'Bradford', '999 p/w', '4', '<p>Feature 1Feature 1Feature 1Feature 1Feature 1Feature 1Feature 1Feature 1Feature 1Feature 1Feature 1Feature 1Feature 1Feature 1Feature 1Feature 1Feature 1Feature 1Feature 1Feature 1Feature 1Feature 1Feature 1Feature 1Feature 1Feature 1Feature 1Feature 1Feature 1Feature 1Feature 1Feature 1Feature 1Feature 1</p>', '16034143', 53.800091, -1.759213, 'Feature 1\r\nFeature 1\r\nFeature 1\r\nFeature 1\r\nFeature 1', 'rent');

-- --------------------------------------------------------

--
-- Table structure for table `rent`
--

CREATE TABLE `rent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `postcode` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `beds` varchar(255) DEFAULT NULL,
  `description` longtext,
  `images` longtext,
  `lat` float(10,6) NOT NULL,
  `lng` float(10,6) NOT NULL,
  `features` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `rent`
--

INSERT INTO `rent` (`id`, `name`, `address`, `postcode`, `city`, `price`, `beds`, `description`, `images`, `lat`, `lng`, `features`) VALUES
(3, 'Property 1', '75 Mannigham Lane', 'BD1 3BA', 'Bradford', '999 p/w', '5', '<p>Quisque cursus magna at lectus condimentum, in commodo odio ullamcorper. Duis ac nisl quis ligula vestibulum ornare. Maecenas elementum porttitor aliquam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum porta, massa eu cursus faucibus, elit ligula rutrum diam, sit amet hendrerit lorem ante id purus. Quisque ultrices nunc in ipsum lobortis, a convallis magna posuere. Nam id laoreet mi. Ut viverra porta arcu. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Praesent nec urna eros. Sed feugiat nisi eget ligula rutrum auctor. Integer lorem sem, blandit nec tristique laoreet, elementum ut dolor.</p>', '07051009', 53.800091, -1.759213, 'Feature 1\r\nFeature 2\r\nFeature 3\r\nFeature 4\r\nFeature 5'),
(4, 'Property 2', '75 Mannigham Lane', 'LS1 2HL', 'Bradford', '999 p/w', '5', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla lorem ligula, dignissim id egestas vitae, facilisis eu dui. Pellentesque a ultricies risus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Pellentesque nec sapien augue. Nunc suscipit urna aliquam porta venenatis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Ut dui elit, aliquet sit amet imperdiet vel, pulvinar eu purus. Cras porttitor sollicitudin arcu, id blandit est mattis eget. Nullam sagittis dignissim placerat. Quisque aliquet facilisis quam dignissim sagittis. Duis ligula leo, molestie quis porttitor id, scelerisque nec augue. Duis a ornare mi. Nulla sed vulputate ipsum, sed laoreet elit. Cras et laoreet dui. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. <strong>Quisque cursus magna at lectus condimentum, in commodo odio ullamcorper. Duis ac nisl quis ligula vestibulum ornare. Maecenas elementum porttitor aliquam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum porta, massa eu cursus faucibus, elit ligula rutrum diam, sit amet hendrerit lorem ante id purus. Quisque ultrices nunc in ipsum lobortis, a convallis magna posuere. Nam id laoreet mi. Ut viverra porta arcu. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Praesent nec urna eros. Sed feugiat nisi eget ligula rutrum auctor. Integer lorem sem, blandit nec tristique laoreet, elementum ut dolor.</strong></p>', '07051009', 53.797333, -1.549829, 'sadasdas\r\ndasdas\r\ndasd\r\nas\r\ndasdsad'),
(5, 'Property 3', '75 Mannigham Lane', 'BD1 3BA', 'Bradford', '999 p/w', '5', '<p>Quisque cursus magna at lectus condimentum, in commodo odio ullamcorper. Duis ac nisl quis ligula vestibulum ornare. Maecenas elementum porttitor aliquam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum porta, massa eu cursus faucibus, elit ligula rutrum diam, sit amet hendrerit lorem ante id purus. Quisque ultrices nunc in ipsum lobortis, a convallis magna posuere. Nam id laoreet mi. Ut viverra porta arcu. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Praesent nec urna eros. Sed feugiat nisi eget ligula rutrum auctor. Integer lorem sem, blandit nec tristique laoreet, elementum ut dolor.</p>', '07051009', 53.800091, -1.759213, 'Feature 1\r\nFeature 2\r\nFeature 3\r\nFeature 4\r\nFeature 5');

-- --------------------------------------------------------

--
-- Table structure for table `sale`
--

CREATE TABLE `sale` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `postcode` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `beds` varchar(255) DEFAULT NULL,
  `description` longtext,
  `images` longtext,
  `lat` float(10,6) NOT NULL,
  `lng` float(10,6) NOT NULL,
  `features` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `sale`
--

INSERT INTO `sale` (`id`, `name`, `address`, `postcode`, `city`, `price`, `beds`, `description`, `images`, `lat`, `lng`, `features`) VALUES
(3, 'Property 1', '75 Mannigham Lane', 'BD1 3BA', 'Bradford', '999999', '5', '<p>Quisque cursus magna at lectus condimentum, in commodo odio ullamcorper. Duis ac nisl quis ligula vestibulum ornare. Maecenas elementum porttitor aliquam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum porta, massa eu cursus faucibus, elit ligula rutrum diam, sit amet hendrerit lorem ante id purus. Quisque ultrices nunc in ipsum lobortis, a convallis magna posuere. Nam id laoreet mi. Ut viverra porta arcu. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Praesent nec urna eros. Sed feugiat nisi eget ligula rutrum auctor. Integer lorem sem, blandit nec tristique laoreet, elementum ut dolor.</p>', '07051009', 53.800091, -1.759213, 'Feature 1\r\nFeature 2\r\nFeature 3\r\nFeature 4\r\nFeature 5'),
(4, 'Property 2', '75 Mannigham Lane', 'LS1 2HL', 'Bradford', '999999', '5', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla lorem ligula, dignissim id egestas vitae, facilisis eu dui. Pellentesque a ultricies risus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Pellentesque nec sapien augue. Nunc suscipit urna aliquam porta venenatis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Ut dui elit, aliquet sit amet imperdiet vel, pulvinar eu purus. Cras porttitor sollicitudin arcu, id blandit est mattis eget. Nullam sagittis dignissim placerat. Quisque aliquet facilisis quam dignissim sagittis. Duis ligula leo, molestie quis porttitor id, scelerisque nec augue. Duis a ornare mi. Nulla sed vulputate ipsum, sed laoreet elit. Cras et laoreet dui. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. <strong>Quisque cursus magna at lectus condimentum, in commodo odio ullamcorper. Duis ac nisl quis ligula vestibulum ornare. Maecenas elementum porttitor aliquam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum porta, massa eu cursus faucibus, elit ligula rutrum diam, sit amet hendrerit lorem ante id purus. Quisque ultrices nunc in ipsum lobortis, a convallis magna posuere. Nam id laoreet mi. Ut viverra porta arcu. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Praesent nec urna eros. Sed feugiat nisi eget ligula rutrum auctor. Integer lorem sem, blandit nec tristique laoreet, elementum ut dolor.</strong></p>', '07051009', 53.797333, -1.549829, 'sadasdas\r\ndasdas\r\ndasd\r\nas\r\ndasdsad');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `value` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `value`) VALUES
(1, 'fblink', 'https://www.facebook.com/WhitehallProperties'),
(2, 'smtp_host', 'smtp.gmail.com'),
(3, 'smtp_user', 'hassanjalil65@gmail.com'),
(4, 'smtp_pass', 'hassanj343'),
(5, 'contact_address', '75 Mannigham Lane'),
(6, 'contact_postcode', 'BD1 3BA'),
(7, 'contact_city', 'Bradford'),
(8, 'contact_tel', '01274749091'),
(9, 'contact_email', 'pcvisionltd@yahoo.co.uk'),
(10, 'homepage_box1', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod             tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,              quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo             consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse             cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non             proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'),
(11, 'homepage_box2', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod             tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,              quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo             consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse             cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non             proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'),
(12, 'homepage_box1_title', 'Testimonials'),
(13, 'homepage_box2_title', 'Professional Services'),
(14, 'featuredproperty', 'a:2:{i:3;s:1:"3";i:4;s:1:"4";}');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author` varchar(255) DEFAULT NULL,
  `description` longblob NOT NULL,
  `rating` int(11) NOT NULL,
  `avtar` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `author`, `description`, `rating`, `avtar`) VALUES
(11, 'Will Fry', 0x4120706c65617375726520746f20737461792061742054686520476174656861757320696e2042726164666f72642e205765277665206265656e20746f7572696e67207769746820746865204c696f6e204b696e672073686f7720616e64206f6674656e2068617665206e696768746d617265732077697468206c657474696e67206167656e74732062757420536165656420616e642053616c2066726f6d20576869746568616c6c2070726f70657274696573206d61646520697420736f206561737920666f7220757320616e642077652066656c7420617420686f6d6520696d6d6564696174656c792e205468652076696577732066726f6d20666c6f6f722039206f6620746865206761746568617573206d75737420626520736f6d65206f6620746865206265737420696e2042726164666f726420616e642074686520666c617420697320636c65616e2c206d6f6465726e20616e6420636f6d666f727461626c65207769746820612073686f72742077616c6b20746f2074686520746f776e2063656e74726520616e642074686520747261696e2073746174696f6e2e204920776f756c64206c6f766520746f207374617920616761696e2069662077652063616d6520746f20427261666f72642f4c656564732e205468616e6b7321, 5, '05031221.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `permission` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `email`, `permission`) VALUES
(1, 'pcv', 'pcv', '$2a$07$6QZTyvbWLhSnD3V3dr4h0uw.OOGlH7uQbsPZ66ivzeEbeWKwvB5uu', '', 4),
(3, 'Admin', 'Admin', '$2a$07$6QZTyvbWLhSnD3V3dr4h0uE5fNlxqHZkH.drTAl414XIpyet1zaje', NULL, 4);
