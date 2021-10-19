-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1:3306
-- Vytvořeno: Čtv 14. říj 2021, 17:01
-- Verze serveru: 5.7.31
-- Verze PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `mezzio`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `availability`
--

DROP TABLE IF EXISTS `availability`;
CREATE TABLE IF NOT EXISTS `availability` (
  `id` int(11) NOT NULL,
  `level` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabulky `confidentiality`
--

DROP TABLE IF EXISTS `confidentiality`;
CREATE TABLE IF NOT EXISTS `confidentiality` (
  `id` int(11) NOT NULL,
  `level` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabulky `forgot`
--

DROP TABLE IF EXISTS `forgot`;
CREATE TABLE IF NOT EXISTS `forgot` (
  `user_id` int(11) UNSIGNED NOT NULL,
  `token` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`user_id`),
  KEY `token` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `impact`
--

DROP TABLE IF EXISTS `impact`;
CREATE TABLE IF NOT EXISTS `impact` (
  `id` int(11) NOT NULL,
  `description` text NOT NULL,
  `level` int(11) NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabulky `integrity`
--

DROP TABLE IF EXISTS `integrity`;
CREATE TABLE IF NOT EXISTS `integrity` (
  `id` int(11) NOT NULL,
  `level` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabulky `risk_limits`
--

DROP TABLE IF EXISTS `risk_limits`;
CREATE TABLE IF NOT EXISTS `risk_limits` (
  `id` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `min_value` int(11) NOT NULL,
  `max_value` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `risk_limits`
--

INSERT INTO `risk_limits` (`id`, `level`, `min_value`, `max_value`, `description`) VALUES
(1, 1, 3, 99, 'Riziko je považováno za přijatelné.'),
(1, 2, 100, 249, 'Riziko může být sníženo méně náročnými opatřeními nebo v případě vyšší náročnosti opatření je riziko přijatelné.'),
(3, 3, 250, 399, 'Riziko je dlouhodobě nepřípustné a musí být zahájeny systematické kroky k jeho odstranění.'),
(4, 4, 300, 810, 'Riziko je nepřípustné a musí být neprodleně zahájeny kroky k jeho odstranění.');

-- --------------------------------------------------------

--
-- Struktura tabulky `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `role_id` tinyint(1) UNSIGNED NOT NULL AUTO_INCREMENT,
  `role` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Vypisuji data pro tabulku `roles`
--

INSERT INTO `roles` (`role_id`, `role`) VALUES
(1, 'admin'),
(2, 'member'),
(3, 'guest');

-- --------------------------------------------------------

--
-- Struktura tabulky `test`
--

DROP TABLE IF EXISTS `test`;
CREATE TABLE IF NOT EXISTS `test` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabulky `threat`
--

DROP TABLE IF EXISTS `threat`;
CREATE TABLE IF NOT EXISTS `threat` (
  `id` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `description` int(11) NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabulky `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthdate` date DEFAULT NULL,
  `gender` enum('Female','Male','Other') COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'avatar.jpg',
  `role_id` tinyint(1) NOT NULL DEFAULT '2',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `role_id` (`role_id`),
  KEY `created` (`created`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Vypisuji data pro tabulku `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `birthdate`, `gender`, `picture`, `role_id`, `active`, `created`) VALUES
(1, 'stulda', 'stulik@webimage.cz', 'laska', '1978-02-02', 'Female', 'avatar.jpg', 2, 1, '1978-02-02 00:00:00'),
(2, 'Admin', 'admin@webimage.cz', '$2y$10$9EbzomvBWV/wDtURPj6F0eOxMmzg.wC.OtRoQ397qjdPtyxFjNd2m', NULL, 'Male', 'avatar.jpg', 1, 1, '2021-10-09 08:45:17');

-- --------------------------------------------------------

--
-- Struktura tabulky `valuation`
--

DROP TABLE IF EXISTS `valuation`;
CREATE TABLE IF NOT EXISTS `valuation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aktiva_id` int(11) DEFAULT NULL,
  `level1` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Vypisuji data pro tabulku `valuation`
--

INSERT INTO `valuation` (`id`, `aktiva_id`, `level1`) VALUES
(1, 200, '1'),
(2, 201, '4'),
(3, 202, '3');

-- --------------------------------------------------------

--
-- Struktura tabulky `vulnerability`
--

DROP TABLE IF EXISTS `vulnerability`;
CREATE TABLE IF NOT EXISTS `vulnerability` (
  `id` int(11) NOT NULL,
  `level` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `forgot`
--
ALTER TABLE `forgot`
  ADD CONSTRAINT `forgot_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
