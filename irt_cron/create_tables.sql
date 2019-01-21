



CREATE TABLE IF NOT EXISTS `api_token` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `token` varchar(16) NOT NULL,
  `status` bit(1) NOT NULL DEFAULT b'0',
  `flags` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `dirt_oval` (
  `id` mediumint(8) unsigned NOT NULL,
  `driver` varchar(255) NOT NULL,
  `location` varchar(2) NOT NULL,
  `club` varchar(32) NOT NULL,
  `starts` smallint(5) unsigned NOT NULL,
  `wins` smallint(5) unsigned NOT NULL,
  `avg_start` tinyint(3) unsigned NOT NULL,
  `avg_finish` tinyint(4) NOT NULL,
  `avg_inc` decimal(5,2) unsigned NOT NULL,
  `safetyrating` varchar(6) NOT NULL,
  `irating` smallint(6) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `dirt_road` (
  `id` mediumint(8) unsigned NOT NULL,
  `driver` varchar(255) NOT NULL,
  `location` varchar(2) NOT NULL,
  `club` varchar(32) NOT NULL,
  `starts` smallint(5) unsigned NOT NULL,
  `wins` smallint(5) unsigned NOT NULL,
  `avg_start` tinyint(3) unsigned NOT NULL,
  `avg_finish` tinyint(4) NOT NULL,
  `avg_inc` decimal(5,2) unsigned NOT NULL,
  `safetyrating` varchar(6) NOT NULL,
  `irating` smallint(6) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `oval` (
  `id` mediumint(8) unsigned NOT NULL,
  `driver` varchar(255) NOT NULL,
  `location` varchar(2) NOT NULL,
  `club` varchar(32) NOT NULL,
  `starts` smallint(5) unsigned NOT NULL,
  `wins` smallint(5) unsigned NOT NULL,
  `avg_start` tinyint(3) unsigned NOT NULL,
  `avg_finish` tinyint(4) NOT NULL,
  `avg_inc` decimal(5,2) unsigned NOT NULL,
  `safetyrating` varchar(6) NOT NULL,
  `irating` smallint(6) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `road` (
  `id` mediumint(8) unsigned NOT NULL,
  `driver` varchar(255) NOT NULL,
  `location` varchar(2) NOT NULL,
  `club` varchar(32) NOT NULL,
  `starts` smallint(5) unsigned NOT NULL,
  `wins` smallint(5) unsigned NOT NULL,
  `avg_start` tinyint(3) unsigned NOT NULL,
  `avg_finish` tinyint(4) NOT NULL,
  `avg_inc` decimal(5,2) unsigned NOT NULL,
  `safetyrating` varchar(6) NOT NULL,
  `irating` smallint(6) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
