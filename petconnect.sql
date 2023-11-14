-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 03-11-2023 a las 13:56:30
-- Versión del servidor: 8.1.0
-- Versión de PHP: 8.1.10

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
-- Estructura de tabla para la tabla `reset_tokens`
--

CREATE TABLE `reset_tokens` (
  `id` int NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `token` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `expires` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reset_tokens`
--

INSERT INTO `reset_tokens` (`id`, `email`, `token`, `expires`) VALUES
(2, 'bailarina69uni@gmail.com', 'b3cc7d85c996a8bc4194cd1b6c079344e329a201bf4d304f5844dc8c7c725be9fa984b559eed4d04d8b25a239e4656ba74f0', '2023-10-31 17:34:01'),
(3, 'bailarina69uni@gmail.com', '96d2fd873df9f3ee2104430e964f33ed908842a2ce56d13410599642db8c3bf805cca5c409a3a9fef0e973eeea2b1038bb9c', '2023-10-31 17:34:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `userprofiles`
--

CREATE TABLE `userprofiles` (
  `id` int NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellido` varchar(50) DEFAULT NULL,
  `edad` int DEFAULT NULL,
  `CI` varchar(20) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `user_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `userprofiles`
--

INSERT INTO `userprofiles` (`id`, `nombre`, `apellido`, `edad`, `CI`, `telefono`, `direccion`, `profile_image`, `user_id`) VALUES
(6, 'Alexander', 'Navarro', 30, '56445684', '54645646', 'JuanPantota', 'profile_images/Buena.png', 17);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
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
(15, 'carlos', 'carlos@gmail.com', '$2y$10$hRRCLjYi0Ya1VxJw.7GQEuCwgTZSJGDzjnLqE1ltkKPaHT3OBFcB2'),
(16, 'bebe', 'bailarina69uni@gmail.com', '$2y$10$znHbKtmb3b0/7k9MQghV0Oq30.QW2/Qpxc/fWZb3HyoKF/YjhZ9kC'),
(17, 'jose', 'jose@gmail.com', '$2y$10$5dW2JRRlZxW2N6gYhzX6g.G6JQayiTRTqlOx/sVB927nM/CIbJlOC');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `reset_tokens`
--
ALTER TABLE `reset_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `userprofiles`
--
ALTER TABLE `userprofiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

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
-- AUTO_INCREMENT de la tabla `reset_tokens`
--
ALTER TABLE `reset_tokens`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `userprofiles`
--
ALTER TABLE `userprofiles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `userprofiles`
--
ALTER TABLE `userprofiles`
  ADD CONSTRAINT `userprofiles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
