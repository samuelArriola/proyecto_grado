-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-02-2021 a las 00:48:41
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gproyectos_inex`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inex_actividades`
--

CREATE TABLE `inex_actividades` (
  `item_acti` int(11) NOT NULL,
  `nomb_acti` varchar(250) DEFAULT NULL,
  `descripcion_a` text NOT NULL,
  `valo_acti` double DEFAULT 0,
  `esta_acti` int(11) DEFAULT 0,
  `item_proy` int(11) DEFAULT NULL,
  `fecha_ia` date NOT NULL,
  `fecha_fa` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `inex_actividades`
--

INSERT INTO `inex_actividades` (`item_acti`, `nomb_acti`, `descripcion_a`, `valo_acti`, `esta_acti`, `item_proy`, `fecha_ia`, `fecha_fa`) VALUES
(160, 'favore', ' fa', 180000, 0, 93, '2020-11-09', '2020-11-16'),
(161, 'jugemos a jugar con todos', 'gg', 36000, 0, 93, '2020-11-23', '2020-11-25'),
(162, 'actividad 1', 'd', 45222, 0, 94, '2020-10-18', '2020-11-06'),
(164, 'actividad 1', 'actividad', 250000, 0, 95, '2020-11-03', '2021-01-20'),
(165, 'actividad 1', ' actividad 102', 316000, 0, 96, '2020-11-03', '2020-12-08'),
(166, 'actividad 1', 'actividad 1', 780000, 0, 97, '2021-02-01', '2021-07-06'),
(167, 'actividad 1 26/02/2021', 'MI PRIMER ACTIVIDAS', 180000, 0, 99, '2021-02-22', '2021-02-23'),
(168, 'primera actividad de cordinado', 'mi prii', 165000, 0, 98, '2021-02-16', '2021-02-24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inex_dependencias`
--

CREATE TABLE `inex_dependencias` (
  `item_dep` int(11) NOT NULL,
  `nombre_dep` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `inex_dependencias`
--

INSERT INTO `inex_dependencias` (`item_dep`, `nombre_dep`) VALUES
(1, 'INVESTIGACIÓN'),
(2, 'PROYECCIÓN SOCIAL'),
(3, 'INVESTIGACION Y PROYECCIÓN SOCIAL');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inex_evidencia`
--

CREATE TABLE `inex_evidencia` (
  `id_e` int(11) NOT NULL,
  `item_acti` int(11) NOT NULL,
  `estado_e` int(100) NOT NULL DEFAULT 0 COMMENT '0: no visto \r\n1: visto',
  `nombre_e` varchar(50) NOT NULL,
  `ruta_e` varchar(150) NOT NULL,
  `fecha_e` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `inex_evidencia`
--

INSERT INTO `inex_evidencia` (`id_e`, `item_acti`, `estado_e`, `nombre_e`, `ruta_e`, `fecha_e`) VALUES
(82, 160, 0, 'samuel', '../evidencias/07f0d7b69ef071571e4ada2f4d6a053a-icono-de-instagram-colorido-by-vexels.png', '2020-11-09'),
(85, 160, 0, 'OISMER', '../evidencias/1200px-YouTube_full-color_icon_(2017).svg.png', '2020-11-09'),
(88, 165, 0, 'activida 1', '../evidencias/aclara dudas.PNG', '2020-11-26'),
(104, 162, 0, 'OISMER compra', '../evidencias/2021-02-20 10-37-03contraduria_page-0001.jpg', '2021-02-19'),
(106, 162, 0, 'OISMER compra', '../evidencias/2021-02-20 08-40-27contraduria_page-0001.jpg', '2021-02-19'),
(107, 165, 1, 'pueba de niños', '../evidencias/2021-02-23 15-29-37contraduria_page-0001.jpg', '2021-02-22'),
(108, 165, 1, '8:26', '../evidencias/2021-02-24 08-27-21procuraduria (2)_page-0001.jpg', '2021-02-23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inex_proyectos`
--

CREATE TABLE `inex_proyectos` (
  `item_proy` int(11) NOT NULL,
  `nomb_proy` varchar(250) DEFAULT NULL,
  `desc_proy` text DEFAULT NULL,
  `jefe_proy` varchar(20) DEFAULT NULL,
  `esta_proy` int(11) DEFAULT 0,
  `visto` int(120) NOT NULL COMMENT '1: visto\r\n0: no visto',
  `vistoL` int(100) NOT NULL COMMENT 'visto para lider',
  `item_dep` int(11) NOT NULL,
  `liderAcargo` varchar(500) NOT NULL,
  `fecha_ip` date NOT NULL,
  `fecha_fp` date NOT NULL,
  `comentarios_p` varchar(1200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `inex_proyectos`
--

INSERT INTO `inex_proyectos` (`item_proy`, `nomb_proy`, `desc_proy`, `jefe_proy`, `esta_proy`, `visto`, `vistoL`, `item_dep`, `liderAcargo`, `fecha_ip`, `fecha_fp`, `comentarios_p`) VALUES
(92, 'subir proyecto', 'subir 1', '1002188186', 3, 0, 1, 1, '1002188186', '2020-09-15', '2020-10-14', 'noseson hp'),
(93, 'niños con hambre ', 'SAMUEL   ALCON   ', '1002188186', 3, 1, 1, 1, '', '2020-11-02', '2020-11-25', 'cambiar nombre'),
(94, 'niños con hambre en la consolata', 'dada', '1002188186', 2, 1, 1, 1, '', '2020-11-14', '2020-11-26', 'Proyecto Exitoso'),
(95, 'proyecto 12 para la ayuda, recolecta de plantas y abono dando una mejor oxígenos a nuestro planeta ', 'proyecto   ', '1002188186', 1, 1, 0, 1, '', '2020-11-02', '2021-03-11', 'este proyecto esta jopo'),
(96, 'priyecto', 'proyecto  ', '1002188186', 2, 1, 1, 1, '', '2020-11-02', '2020-12-17', 'titulo'),
(97, 'notificacion actividades ', 'ss', '1002188186', 0, 0, 1, 1, '', '2021-02-01', '2021-07-08', 'Proyecto Exitoso'),
(98, 'proyecto 1', 'dfggd', '1002188186', 0, 0, 1, 1, '', '2021-02-15', '2021-02-24', 'Proyecto Exitoso'),
(99, 'priyecto prueba 20', 'PRUEBA 21', '1002491546', 1, 0, 0, 1, '', '2021-02-21', '2021-02-28', 'Proyecto Exitoso'),
(100, '26/02/2021', 'coordinado         ', '1002491546', 0, 0, 1, 1, '1002188186', '2020-11-02', '2021-02-16', 'Proyecto Exitoso');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inex_usuarios`
--

CREATE TABLE `inex_usuarios` (
  `iden_usua` varchar(20) NOT NULL,
  `nomb_usua` varchar(40) DEFAULT NULL,
  `apel_usua` varchar(40) DEFAULT NULL,
  `correo` varchar(300) NOT NULL,
  `role_usua` varchar(100) DEFAULT 'L',
  `item_dep` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `inex_usuarios`
--

INSERT INTO `inex_usuarios` (`iden_usua`, `nomb_usua`, `apel_usua`, `correo`, `role_usua`, `item_dep`) VALUES
('1001900748', 'juan', 'rios', 'jriosb21@curnvirtual.edu.co', 'D', 1),
('1002188186', 'Samuel', 'arriola', 'sarriolam21@curnvirtual.edu.co', 'L', 1),
('1002491546', 'oismer', 'sehuanes', 'osehuanes21@curnvirtual.edu.co', 'C', 1),
('100365963', 'carlos andres', 'fabra ortega', 'candres@curnvirtual.edu.co', 'L', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `inex_actividades`
--
ALTER TABLE `inex_actividades`
  ADD PRIMARY KEY (`item_acti`),
  ADD KEY `item_proy` (`item_proy`);

--
-- Indices de la tabla `inex_dependencias`
--
ALTER TABLE `inex_dependencias`
  ADD PRIMARY KEY (`item_dep`);

--
-- Indices de la tabla `inex_evidencia`
--
ALTER TABLE `inex_evidencia`
  ADD PRIMARY KEY (`id_e`),
  ADD UNIQUE KEY `ruta_e` (`ruta_e`),
  ADD KEY `item_acti` (`item_acti`);

--
-- Indices de la tabla `inex_proyectos`
--
ALTER TABLE `inex_proyectos`
  ADD PRIMARY KEY (`item_proy`),
  ADD KEY `jefe_proy` (`jefe_proy`),
  ADD KEY `dep_proy` (`item_dep`),
  ADD KEY `dep_proy_2` (`item_dep`);

--
-- Indices de la tabla `inex_usuarios`
--
ALTER TABLE `inex_usuarios`
  ADD PRIMARY KEY (`iden_usua`),
  ADD KEY `item_dep` (`item_dep`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `inex_actividades`
--
ALTER TABLE `inex_actividades`
  MODIFY `item_acti` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;

--
-- AUTO_INCREMENT de la tabla `inex_evidencia`
--
ALTER TABLE `inex_evidencia`
  MODIFY `id_e` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT de la tabla `inex_proyectos`
--
ALTER TABLE `inex_proyectos`
  MODIFY `item_proy` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `inex_actividades`
--
ALTER TABLE `inex_actividades`
  ADD CONSTRAINT `inex_actividades_ibfk_1` FOREIGN KEY (`item_proy`) REFERENCES `inex_proyectos` (`item_proy`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `inex_evidencia`
--
ALTER TABLE `inex_evidencia`
  ADD CONSTRAINT `inex_evidencia_ibfk_1` FOREIGN KEY (`item_acti`) REFERENCES `inex_actividades` (`item_acti`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `inex_proyectos`
--
ALTER TABLE `inex_proyectos`
  ADD CONSTRAINT `inex_proyectos_ibfk_1` FOREIGN KEY (`jefe_proy`) REFERENCES `inex_usuarios` (`iden_usua`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `inex_proyectos_ibfk_2` FOREIGN KEY (`item_dep`) REFERENCES `inex_dependencias` (`item_dep`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `inex_usuarios`
--
ALTER TABLE `inex_usuarios`
  ADD CONSTRAINT `inex_usuarios_ibfk_1` FOREIGN KEY (`item_dep`) REFERENCES `inex_dependencias` (`item_dep`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
