-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-10-2023 a las 21:41:38
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `petconnect`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(1, 'seremo', 'seremo@gmail.com', '$2y$10$IBNRkf3edUWR7yR3FbBiUO5cGY6ECgb81wJMYCgEGDuKqCnNk2nMe'),
(2, 'santiago', 'santiago@gmail.com', '$2y$10$RzlOyvkKfIZSWYexbSdPUO2z0d1OtSVvkysMuoWuAojpe85a003.2'),
(3, 'silvia ', 'silvia@hotmail.com', '$2y$10$DLEwlrcXD0jRlpe3HM0TCuyn9XQT66BvV/3BdS/jql.Um/n0kjm86'),
(4, '', '', '$2y$10$pQjLOqDgSKa6Bx46OoxHuuOcS3JZRZQKdpP0dLCK87fkOsSRiu3Cy'),
(9, 'mamani', 'mamani@gmail.com', '$2y$10$E1sGZwkyOoyKccMf0oDeA.LjVOeKKA5yYetHtvGSHjwEn.6bLmiZu'),
(10, 'josefina', 'josefina@gmail.com', '$2y$10$IbAbk07wAP.NLj/2hAC2OO6hU5jxn/O53ypDkGmhYFHPyUB6EgSOO'),
(11, 'silvia', 'ssa@hotmail.com', '$2y$10$UB0Tu8GqRev6a3WZqvnaLuOhzamvLF.ctkiTYhOzMsyaR2dTwcrIm'),
(12, 'carmelo', 'carmelo@gmail.com', '$2y$10$5WgbI0pilLMhlWlXyMWu7.RbRlH18CyAl/jKG7bmx5tvglAeJpRpq'),
(14, 'martin', 'martin@gmail.com', '$2y$10$V8K6YzrlYRJtrBTYzaUTuuauD4ueTyJjEbQCcAqZMJkBeb8xHmlru'),
(15, 'carlos', 'carlos@gmail.com', '$2y$10$hRRCLjYi0Ya1VxJw.7GQEuCwgTZSJGDzjnLqE1ltkKPaHT3OBFcB2');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
