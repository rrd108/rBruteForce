CREATE TABLE IF NOT EXISTS `rbruteforcelogs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `data` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `rbruteforces` (
  `ip` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `expire` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`expire`),
  KEY `ip` (`ip`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
