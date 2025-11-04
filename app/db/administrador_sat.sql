-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 04, 2025 at 01:50 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `administrador_sat`
--
CREATE DATABASE IF NOT EXISTS `administrador_sat`;
USE `administrador_sat`;

-- --------------------------------------------------------

--
-- Table structure for table `areas`
--

CREATE TABLE IF NOT EXISTS `areas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre_area` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- --------------------------------------------------------

--
-- Table structure for table `colaboradores`
--

CREATE TABLE IF NOT EXISTS `colaboradores` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `rfc` varchar(20) NOT NULL,
  `rfc_corto` varchar(20) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `pass` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `area` int DEFAULT NULL,
  `administrador` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `area` (`area`)
) ENGINE=InnoDB AUTO_INCREMENT=5;

--
-- Dumping data for table `colaboradores`
--

INSERT INTO `colaboradores` (`id`, `nombre`, `apellidos`, `rfc`, `rfc_corto`, `usuario`, `pass`, `area`, `administrador`) VALUES
(2, 'Misael', 'Juarez Aguilar', 'JUAM010420E79', 'JUAM010420', 'misael', '$2y$10$yqxQEpYeSy890GXn4gVox.IT2.1/SjQWMA7Kuj/rXuac7/GHxm2Na', NULL, 1),
(3, 'Luis', 'Torres Puebla', '12345', '123', 'luis', '$2y$10$L8eqKQXKyCobHqltzt34f.UzqerdJ1cOla3TdpLRHmfGVtZbKtQ5G', NULL, 2),
(4, 'Karla', 'Guzman Gomez', '1234567', '12345', 'karla', '$2y$10$gh3hY836R8S1HtHhOIJOyer8OSsxgItTP31ZMIbyITyx1qgSf8Zw2', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ips`
--

CREATE TABLE IF NOT EXISTS `ips` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ip` varchar(50) NOT NULL,
  `activo` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- --------------------------------------------------------

--
-- Table structure for table `resguardos`
--

CREATE TABLE IF NOT EXISTS `resguardos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `marca` varchar(100) NOT NULL,
  `modelo` varchar(100) NOT NULL,
  `n_serie` varchar(100) NOT NULL,
  `hostname` varchar(50) NOT NULL,
  `activo` int NOT NULL,
  `ip` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ip` (`ip`)
) ENGINE=InnoDB;

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `rfc` varchar(20) NOT NULL,
  `rfc_corto` varchar(20) NOT NULL,
  `puesto` varchar(50) NOT NULL,
  `n_empleado` int NOT NULL,
  `administracion_general` varchar(50) NOT NULL,
  `activo` int NOT NULL,
  `area` int NOT NULL,
  `equipo_computo` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `equipo_computo` (`equipo_computo`),
  UNIQUE KEY `area` (`area`)
) ENGINE=InnoDB AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `colaboradores`
--
ALTER TABLE `colaboradores`
  ADD CONSTRAINT `colaboradores_ibfk_1` FOREIGN KEY (`area`) REFERENCES `areas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `resguardos`
--
ALTER TABLE `resguardos`
  ADD CONSTRAINT `resguardos_ibfk_1` FOREIGN KEY (`ip`) REFERENCES `ips` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`equipo_computo`) REFERENCES `resguardos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`area`) REFERENCES `areas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
