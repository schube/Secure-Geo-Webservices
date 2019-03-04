-- phpMyAdmin SQL Dump
-- version 2.11.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Server Version: 4.1.22
-- PHP-Version: 5.2.14-pl0-gentoo

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `oauth_consumer_registry`
--

DROP TABLE IF EXISTS `oauth_consumer_registry`;
CREATE TABLE IF NOT EXISTS `oauth_consumer_registry` (
  `ocr_id` int(11) NOT NULL auto_increment,
  `ocr_usa_id_ref` int(11) default NULL,
  `ocr_consumer_key` varchar(64) character set utf8 collate utf8_bin NOT NULL default '',
  `ocr_consumer_secret` varchar(64) character set utf8 collate utf8_bin NOT NULL default '',
  `ocr_signature_methods` varchar(255) NOT NULL default 'HMAC-SHA1,PLAINTEXT',
  `ocr_server_uri` varchar(255) NOT NULL default '',
  `ocr_server_uri_host` varchar(128) NOT NULL default '',
  `ocr_server_uri_path` varchar(128) character set utf8 collate utf8_bin NOT NULL default '',
  `ocr_request_token_uri` varchar(255) NOT NULL default '',
  `ocr_authorize_uri` varchar(255) NOT NULL default '',
  `ocr_access_token_uri` varchar(255) NOT NULL default '',
  `ocr_timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`ocr_id`),
  UNIQUE KEY `ocr_consumer_key` (`ocr_consumer_key`,`ocr_usa_id_ref`),
  KEY `ocr_server_uri` (`ocr_server_uri`),
  KEY `ocr_server_uri_host` (`ocr_server_uri_host`,`ocr_server_uri_path`),
  KEY `ocr_usa_id_ref` (`ocr_usa_id_ref`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `oauth_consumer_registry`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `oauth_consumer_token`
--

DROP TABLE IF EXISTS `oauth_consumer_token`;
CREATE TABLE IF NOT EXISTS `oauth_consumer_token` (
  `oct_id` int(11) NOT NULL auto_increment,
  `oct_ocr_id_ref` int(11) NOT NULL default '0',
  `oct_usa_id_ref` int(11) NOT NULL default '0',
  `oct_name` varchar(64) character set utf8 collate utf8_bin NOT NULL default '',
  `oct_token` varchar(64) character set utf8 collate utf8_bin NOT NULL default '',
  `oct_token_secret` varchar(64) character set utf8 collate utf8_bin NOT NULL default '',
  `oct_token_type` enum('request','authorized','access') default NULL,
  `oct_token_ttl` datetime NOT NULL default '9999-12-31 00:00:00',
  `oct_timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`oct_id`),
  UNIQUE KEY `oct_ocr_id_ref` (`oct_ocr_id_ref`,`oct_token`),
  UNIQUE KEY `oct_usa_id_ref` (`oct_usa_id_ref`,`oct_ocr_id_ref`,`oct_token_type`,`oct_name`),
  KEY `oct_token_ttl` (`oct_token_ttl`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `oauth_consumer_token`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `oauth_log`
--

DROP TABLE IF EXISTS `oauth_log`;
CREATE TABLE IF NOT EXISTS `oauth_log` (
  `olg_id` int(11) NOT NULL auto_increment,
  `olg_osr_consumer_key` varchar(64) character set utf8 collate utf8_bin default NULL,
  `olg_ost_token` varchar(64) character set utf8 collate utf8_bin default NULL,
  `olg_ocr_consumer_key` varchar(64) character set utf8 collate utf8_bin default NULL,
  `olg_oct_token` varchar(64) character set utf8 collate utf8_bin default NULL,
  `olg_usa_id_ref` int(11) default NULL,
  `olg_received` text NOT NULL,
  `olg_sent` text NOT NULL,
  `olg_base_string` text NOT NULL,
  `olg_notes` text NOT NULL,
  `olg_timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `olg_remote_ip` bigint(20) NOT NULL default '0',
  PRIMARY KEY  (`olg_id`),
  KEY `olg_osr_consumer_key` (`olg_osr_consumer_key`,`olg_id`),
  KEY `olg_ost_token` (`olg_ost_token`,`olg_id`),
  KEY `olg_ocr_consumer_key` (`olg_ocr_consumer_key`,`olg_id`),
  KEY `olg_oct_token` (`olg_oct_token`,`olg_id`),
  KEY `olg_usa_id_ref` (`olg_usa_id_ref`,`olg_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `oauth_log`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `oauth_server_nonce`
--

DROP TABLE IF EXISTS `oauth_server_nonce`;
CREATE TABLE IF NOT EXISTS `oauth_server_nonce` (
  `osn_id` int(11) NOT NULL auto_increment,
  `osn_consumer_key` varchar(64) character set utf8 collate utf8_bin NOT NULL default '',
  `osn_token` varchar(64) character set utf8 collate utf8_bin NOT NULL default '',
  `osn_timestamp` bigint(20) NOT NULL default '0',
  `osn_nonce` varchar(80) character set utf8 collate utf8_bin NOT NULL default '',
  PRIMARY KEY  (`osn_id`),
  UNIQUE KEY `osn_consumer_key` (`osn_consumer_key`,`osn_token`,`osn_timestamp`,`osn_nonce`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `oauth_server_nonce`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `oauth_server_registry`
--

DROP TABLE IF EXISTS `oauth_server_registry`;
CREATE TABLE IF NOT EXISTS `oauth_server_registry` (
  `osr_id` int(11) NOT NULL auto_increment,
  `osr_usa_id_ref` int(11) default NULL,
  `osr_consumer_key` varchar(64) character set utf8 collate utf8_bin NOT NULL default '',
  `osr_consumer_secret` varchar(64) character set utf8 collate utf8_bin NOT NULL default '',
  `osr_enabled` tinyint(1) NOT NULL default '1',
  `osr_status` varchar(16) NOT NULL default '',
  `osr_requester_name` varchar(64) NOT NULL default '',
  `osr_requester_email` varchar(64) NOT NULL default '',
  `osr_callback_uri` varchar(255) NOT NULL default '',
  `osr_application_uri` varchar(255) NOT NULL default '',
  `osr_application_title` varchar(80) NOT NULL default '',
  `osr_application_descr` text NOT NULL,
  `osr_application_notes` text NOT NULL,
  `osr_application_type` varchar(20) NOT NULL default '',
  `osr_application_commercial` tinyint(1) NOT NULL default '0',
  `osr_issue_date` datetime NOT NULL default '0000-00-00 00:00:00',
  `osr_timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`osr_id`),
  UNIQUE KEY `osr_consumer_key` (`osr_consumer_key`),
  KEY `osr_usa_id_ref` (`osr_usa_id_ref`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Daten für Tabelle `oauth_server_registry`
--

INSERT INTO `oauth_server_registry` (`osr_id`, `osr_usa_id_ref`, `osr_consumer_key`, `osr_consumer_secret`, `osr_enabled`, `osr_status`, `osr_requester_name`, `osr_requester_email`, `osr_callback_uri`, `osr_application_uri`, `osr_application_title`, `osr_application_descr`, `osr_application_notes`, `osr_application_type`, `osr_application_commercial`, `osr_issue_date`, `osr_timestamp`) VALUES
(1, 1, '8a347776ca45bab6584e0aa32d6ad52f04bddf0a3', '32afc043f6f49b3a96d83efb18806324', 1, 'active', 'Bernhard', 'office@schubec.com', 'http://www.orf.at', 'http://www.schubec.at', '', '', '', '', 0, '2010-05-02 23:37:39', '2010-05-02 23:37:39');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `oauth_server_token`
--

DROP TABLE IF EXISTS `oauth_server_token`;
CREATE TABLE IF NOT EXISTS `oauth_server_token` (
  `ost_id` int(11) NOT NULL auto_increment,
  `ost_osr_id_ref` int(11) NOT NULL default '0',
  `ost_usa_id_ref` int(11) NOT NULL default '0',
  `ost_token` varchar(64) character set utf8 collate utf8_bin NOT NULL default '',
  `ost_token_secret` varchar(64) character set utf8 collate utf8_bin NOT NULL default '',
  `ost_token_type` enum('request','access') default NULL,
  `ost_authorized` tinyint(1) NOT NULL default '0',
  `ost_referrer_host` varchar(128) NOT NULL default '',
  `ost_token_ttl` datetime NOT NULL default '9999-12-31 00:00:00',
  `ost_timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`ost_id`),
  UNIQUE KEY `ost_token` (`ost_token`),
  KEY `ost_osr_id_ref` (`ost_osr_id_ref`),
  KEY `ost_token_ttl` (`ost_token_ttl`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `oauth_server_token`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL auto_increment,
  `username` varchar(255) NOT NULL default '',
  `password` varchar(50) default NULL,
  `type` enum('user_pw','openid') NOT NULL default 'user_pw',
  `credit` float NOT NULL default '0',
  `read_filter` longtext,
  `write_filter` longtext,
  PRIMARY KEY  (`user_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `type`, `credit`, `read_filter`, `write_filter`) VALUES
(1, 'schube', 'schube', 'user_pw', 100, '<ogc:Filter xmlns:ogc="http://www.opengis.net/ogc" xmlns:gml2="http://www.opengis.net/gml" xmlns:gmgml="http://www.intergraph.com/geomedia/gml">\r\n  	<ogc:BBOX>\r\n  	<ogc:PropertyName>the_geom</ogc:PropertyName>\r\n  	<gml2:Box srsName="http://www.opengis.net/gml/srs/epsg.xml#4326">\r\n  	<gml2:coordinates>\r\n  	-73.5,40.2 -74,44.2\r\n  	</gml2:coordinates>\r\n  	</gml2:Box >\r\n  	</ogc:BBOX>\r\n  	</ogc:Filter>', '<ogc:Filter xmlns:ogc="http://www.opengis.net/ogc" xmlns:gml2="http://www.opengis.net/gml" xmlns:gmgml="http://www.intergraph.com/geomedia/gml">\r\n  	<ogc:BBOX>\r\n  	<ogc:PropertyName>the_geom</ogc:PropertyName>\r\n  	<gml2:Box srsName="http://www.opengis.net/gml/srs/epsg.xml#4326">\r\n  	<gml2:coordinates>\r\n  	-73.5,40.2 -74,44.2\r\n  	</gml2:coordinates>\r\n  	</gml2:Box >\r\n  	</ogc:BBOX>\r\n  	</ogc:Filter>'),
(2, 'rebe', 'rebe', 'user_pw', 100, '<ogc:Filter xmlns:ogc="http://www.opengis.net/ogc" xmlns:gml="http://www.opengis.net/gml" xmlns:gmgml="http://www.intergraph.com/geomedia/gml">\r\n  	<ogc:BBOX>\r\n  	<ogc:PropertyName>the_geom</ogc:PropertyName>\r\n  	<gml:Box srsName="http://www.opengis.net/gml/srs/epsg.xml#4326">\r\n  	<gml:coordinates>\r\n  	-73.5,40 -74,44\r\n  	</gml:coordinates>\r\n  	</gml:Box >\r\n  	</ogc:BBOX>\r\n  	</ogc:Filter>', NULL),
(3, 'mabo', 'mabo', 'user_pw', 100, NULL, NULL),
(4, 'drheistracher', 'drheistracher', 'user_pw', 100, NULL, NULL),
(5, 'http://schubec.myopenid.com/', NULL, 'openid', 50, '<ogc:Filter xmlns:ogc="http://www.opengis.net/ogc" xmlns:gml="http://www.opengis.net/gml" xmlns:gmgml="http://www.intergraph.com/geomedia/gml">\r\n  	<ogc:BBOX>\r\n  	<ogc:PropertyName>the_geom</ogc:PropertyName>\r\n  	<gml:Box srsName="http://www.opengis.net/gml/srs/epsg.xml#4326">\r\n  	<gml:coordinates>\r\n  	-72,39 -77,48\r\n  	</gml:coordinates>\r\n  	</gml:Box >\r\n  	</ogc:BBOX>\r\n  	</ogc:Filter>', NULL),
(6, 'http://bresch.myopenid.com/', NULL, 'openid', 50, '<ogc:Filter xmlns:ogc="http://www.opengis.net/ogc" xmlns:gml="http://www.opengis.net/gml" xmlns:gmgml="http://www.intergraph.com/geomedia/gml">\r\n  	<ogc:BBOX>\r\n  	<ogc:PropertyName>the_geom</ogc:PropertyName>\r\n  	<gml:Box srsName="http://www.opengis.net/gml/srs/epsg.xml#4326">\r\n  	<gml:coordinates>\r\n  	-72,39 -77,48\r\n  	</gml:coordinates>\r\n  	</gml:Box >\r\n  	</ogc:BBOX>\r\n  	</ogc:Filter>', NULL);
