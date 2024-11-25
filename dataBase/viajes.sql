-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-11-2024 a las 18:13:25
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
-- Estructura de tabla para la tabla `viajes`
--

CREATE TABLE `viajes` (
  `IdViajes` int(11) NOT NULL,
  `IdChofer` int(11) NOT NULL,
  `IdTransporte` int(11) NOT NULL,
  `FechaViaje` date NOT NULL,
  `IdDestino` int(11) NOT NULL,
  `FechaCreacion` date NOT NULL DEFAULT current_timestamp(),
  `IdUsurRegistra` int(11) NOT NULL,
  `Costo` decimal(10,0) NOT NULL,
  `PorcentajeChofer` decimal(5,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `viajes`
--

INSERT INTO `viajes` (`IdViajes`, `IdChofer`, `IdTransporte`, `FechaViaje`, `IdDestino`, `FechaCreacion`, `IdUsurRegistra`, `Costo`, `PorcentajeChofer`) VALUES
(1, 21, 6, '2024-11-28', 6, '2024-11-23', 0, 123601, 26),
(2, 21, 6, '2024-11-28', 4, '2024-11-23', 0, 124, 24),
(3, 21, 6, '2024-11-28', 4, '2024-11-23', 0, 124, 24),
(4, 17, 6, '2024-11-29', 5, '2024-11-23', 0, 123601, 22),
(5, 17, 6, '2024-11-29', 5, '2024-11-23', 0, 123601, 22);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `viajes`
--
ALTER TABLE `viajes`
  ADD PRIMARY KEY (`IdViajes`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `viajes`
--
ALTER TABLE `viajes`
  MODIFY `IdViajes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
