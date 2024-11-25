-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-11-2024 a las 23:50:38
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
-- Estructura de tabla para la tabla `destinos`
--

CREATE TABLE `destinos` (
  `IdDestinos` varchar(8) NOT NULL,
  `Denominacion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `IdMarcas` int(11) NOT NULL,
  `Marcas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nivelesuser`
--

CREATE TABLE `nivelesuser` (
  `IdNiveles` int(11) NOT NULL,
  `Denominacion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `nivelesuser`
--

INSERT INTO `nivelesuser` (`IdNiveles`, `Denominacion`) VALUES
(1, 'Admin'),
(2, 'Operador'),
(3, 'Chofer');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos`
--

CREATE TABLE `tipos` (
  `IdTipos` int(11) NOT NULL,
  `Tipos` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transportes`
--

CREATE TABLE `transportes` (
  `IdTransportes` int(11) NOT NULL,
  `IdMarca` int(11) NOT NULL,
  `IdTipo` int(11) NOT NULL,
  `Patente` varchar(7) NOT NULL,
  `Modelo` varchar(25) NOT NULL,
  `Disponible` tinyint(1) NOT NULL,
  `Combustible` varchar(20) NOT NULL,
  `FechaCarga` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
(3, 'Maia', 'Cristina', 21518473, '$2y$10$816o5impluht4nhx1vwhke47Z0thieOzDBboELYtkF0Z7AAA9t.Q2', 1, 0, '2024-11-18', 'bombon.jpg'),
(4, 'Maizon', 'Matias', 23056963, '$2y$10$dpLX6/2msYSS9qOIcCTvA.w8XHUtUFB5w9umNbBCGUKDVjb9YJXJK', 0, 2, '2024-11-18', 'foto-3.jpg'),
(6, 'Carpio', 'José', 25321123, '$2y$10$k4MGmLVyYWV1gBPnN3cJLuWnccU.90M3y7HZQCESn2FwaFY97q9yi', 0, 2, '2024-11-18', 'profile-img.jpg');

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
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `destinos`
--
ALTER TABLE `destinos`
  ADD PRIMARY KEY (`IdDestinos`);

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`IdMarcas`);

--
-- Indices de la tabla `nivelesuser`
--
ALTER TABLE `nivelesuser`
  ADD PRIMARY KEY (`IdNiveles`);

--
-- Indices de la tabla `tipos`
--
ALTER TABLE `tipos`
  ADD PRIMARY KEY (`IdTipos`);

--
-- Indices de la tabla `transportes`
--
ALTER TABLE `transportes`
  ADD PRIMARY KEY (`IdTransportes`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`IdUser`);

--
-- Indices de la tabla `viajes`
--
ALTER TABLE `viajes`
  ADD PRIMARY KEY (`IdViajes`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `IdMarcas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipos`
--
ALTER TABLE `tipos`
  MODIFY `IdTipos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `transportes`
--
ALTER TABLE `transportes`
  MODIFY `IdTransportes` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `IdUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `viajes`
--
ALTER TABLE `viajes`
  MODIFY `IdViajes` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
