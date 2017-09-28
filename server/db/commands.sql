
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE IF NOT EXISTS `commands` (
  `command` varchar(128) NOT NULL,
  `enabled` varchar(128) NOT NULL,
  PRIMARY KEY (`command`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


INSERT INTO `commands` (`command`, `enabled`) VALUES
('mine', 'false'),
('coin', ''),
('cores', ''),
('update', 'false'),
('newfile', ''),
('kill', 'false');
