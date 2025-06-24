-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-06-2025 a las 20:24:25
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
-- Base de datos: `iventario_examen`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `cantidad` int(10) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `foto` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `cantidad`, `precio`, `foto`) VALUES
(8, 'Banca de press', 'color rojo con negro', 1, 500000.00, 0x62616e63612e706e67),
(9, 'Gluteo', 'Rosado', 2, 15500.00, 0x676c7574656f2e706e67),
(10, 'Press de Bancooo', 'Banca de color negro', 1, 170000.00, 0x62616e63612e706e67),
(11, 'Maquina', 'tamaño regular', 2, 24500.00, 0x6d617175696e612e706e67),
(12, 'Mancuernas', '20 kilos', 2, 39000.00, 0x6d616e637565726e61732e706e67);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `apellido` varchar(100) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `contrasena` text DEFAULT NULL,
  `tipo` enum('admin','usuario') NOT NULL,
  `estado` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `nombre`, `apellido`, `correo`, `contrasena`, `tipo`, `estado`) VALUES
(5, 'Yur', 'Yurgueen', 'Chaves', 'Yurcha@gmail.com', '$2y$10$1YdjDf3hbIJwdh3WvzXSzuugL24LVVub2zdVsToitklIgCYw0ZfqS', 'admin', 1),
(6, 'Mey', 'Meilyn', 'Chaves', 'meychabre@gmail.com', '$2y$10$WnUYpOsLORVlzwFXvWPQCOFOD4D7n1C/is926fhGmYvFGtgt4rQ/K', 'admin', 1),
(19, 'Pao3', 'Paola', 'Quesada', 'Pao2ques@gmail.com', '$2y$10$El8bwKdaNjz4sEu1i75NjO3kULoqJH9.WDe9CUNPZ.y7lYxJmUZo.', 'usuario', 0),
(20, 'Hil', 'hilda', 'vargas', 'Hilque@gmail.com', '$2y$10$ZiVdHRcVsPjdxVXDkz8KCucYtLKP7Z5cweYqqU3XKOP8xBkj4ppKe', 'usuario', 0),
(31, 'Val', 'Valeria', 'Calderon', 'ValCal3@gmail.com', '$2y$10$zLiC6Zh/S3bcRaPTiVukOeiXYQHxdFbiYKuMAmecOTTv0oS4w3iRa', 'usuario', 1),
(32, 'Jane', 'Janeth', 'Aguilar', 'JanAgui1@gmail.com', '$2y$10$z.d87ak9Roj.bwC0Zj7.XO//uLLoLowfV0DU7Aod6xm5yXhfZcbLm', 'admin', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
