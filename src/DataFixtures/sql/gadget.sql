-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 30 avr. 2021 à 14:07
-- Version du serveur :  10.4.17-MariaDB
-- Version de PHP : 8.0.1

SET SQL_MODE
= "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone
= "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `wad10`
--

--
-- Déchargement des données de la table `gadget`
--

--
-- Dumping data for table `gadget`
--

INSERT INTO `gadget` (`id`, `sample_picture`, `description`, `type`, `prix`) VALUES
(1, 'tshirt.jpg', '100 % fine jersey cotton, relaxed fit, unisex, Made in EU.', 'T-shirt', 25),
(2, 'mousepad.jpg', 'Water repellent, high precision, non-slip rubber base, designed by gamers and very suitable for gaming/office work.', 'Mousepad', 10),
(3, 'poster.jpg', 'Laminated, tear-resistant, very durable, high quality ink.', 'Poster', 15);



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
