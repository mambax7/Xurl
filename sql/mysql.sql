CREATE TABLE `xurl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(32) DEFAULT NULL,
  `url` text NOT NULL,
  `user` varchar(25) NOT NULL,
  `hits` mediumint(8) DEFAULT 0,
  `restrict` tinyint(1) unsigned NOT NULL DEFAULT 0,
  `group` varchar(50) NOT NULL DEFAULT '1,2',
  `d_added` varchar(50) NOT NULL DEFAULT 0,
  `d_l_click` varchar(50) NOT NULL DEFAULT 0,  
  `spam_mark` mediumint(8) DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`key`)
);

INSERT INTO `xurl` (`id`, `key`, `url`, `user`, `hits`) VALUES 
(1, '1', 'http://www.designburo.nl', 'designburo', 1),
(2, '2', 'http://spoox.designburo.nl', 'designburo', 1),
(3, '3', 'http://www.yardsales.nl', 'designburo', 1),
(4, '4', 'http://www.designburo.nl/blog', 'designburo', 1);
