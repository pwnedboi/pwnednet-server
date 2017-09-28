SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


CREATE TABLE IF NOT EXISTS `bots` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `hwid` varchar(256) NOT NULL,
  `ip` varchar(40) NOT NULL,
  `version` varchar(128) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `hwid` (`hwid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;
