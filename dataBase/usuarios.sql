-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-11-2024 a las 18:13:40
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `transporte`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `IdUser` int(11) NOT NULL,
  `Apellido` varchar(50) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `DNI` int(8) NOT NULL,
  `Clave` varchar(100) DEFAULT NULL,
  `Activo` tinyint(1) DEFAULT NULL,
  `IdNivel` int(11) NOT NULL,
  `FechaCreación` date NOT NULL DEFAULT current_timestamp(),
  `Imagen` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`IdUser`, `Apellido`, `Nombre`, `DNI`, `Clave`, `Activo`, `IdNivel`, `FechaCreación`, `Imagen`) VALUES
(7, 'Maia', 'Cristina', 21518473, '236', 1, 1, '2024-11-18', 'bombon.jpg'),
(8, 'Lopez', 'Cele', 23056963, '754', 1, 2, '2024-11-18', 'messages-1.jpg'),
(12, 'Congregado', 'Franco', 19520236, '147ñ', 1, 3, '2024-11-22', NULL),
(17, 'Lopez', 'Exequiel', 36256236, '4789d', 1, 3, '2024-11-22', NULL),
(21, 'Lopez', 'Ludmila', 45123698, '789io', 0, 3, '2024-11-22', NULL),
(26, 'Gomez', 'Ignacio N', 36589456, '', 0, 3, '2024-11-23', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`IdUser`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `IdUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
