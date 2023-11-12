-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: mysql
-- Tiempo de generación: 12-11-2023 a las 19:53:33
-- Versión del servidor: 5.7.43
-- Versión de PHP: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `portfolio_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `Nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `Nombre`) VALUES
(1, 'PHP'),
(2, 'Python'),
(3, 'Docker'),
(4, 'MySQL'),
(5, 'JavaScript');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_proyecto`
--

CREATE TABLE `categoria_proyecto` (
  `id` int(11) NOT NULL,
  `proyecto_id` int(11) NOT NULL,
  `categoria_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categoria_proyecto`
--

INSERT INTO `categoria_proyecto` (`id`, `proyecto_id`, `categoria_id`) VALUES
(1, 1, 3),
(2, 1, 4),
(3, 2, 5),
(4, 3, 5),
(5, 4, 2),
(6, 5, 4),
(7, 5, 1),
(8, 6, 3),
(9, 6, 4),
(10, 6, 2),
(11, 7, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto`
--

CREATE TABLE `contacto` (
  `id` int(11) NOT NULL,
  `NombreApellidos` varchar(50) NOT NULL,
  `e-mail` varchar(40) NOT NULL,
  `Telefono` int(9) NOT NULL,
  `Particular/empresa` varchar(10) NOT NULL,
  `Mensaje` varchar(400) NOT NULL,
  `Archivo` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `contacto`
--

INSERT INTO `contacto` (`id`, `NombreApellidos`, `e-mail`, `Telefono`, `Particular/empresa`, `Mensaje`, `Archivo`) VALUES
(1, 'Romano Pradi', 'RPradi@ggg.com', 966112233, 'Particular', 'Contactenme lo antes posible. ', NULL),
(2, 'Joseph Wolf', 'jwolf@ggg.com', 933112255, 'empresa', 'Contactenme lo antes posible. ', 'uploads/bannefragata.jpg'),
(3, 'Wittaker', 'Wittaker@ggg.com', 938812255, 'empresa', 'Contactenme lo antes posible o te crujo', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto`
--

CREATE TABLE `proyecto` (
  `id` int(11) NOT NULL,
  `clave` varchar(30) NOT NULL,
  `titulo` varchar(40) NOT NULL,
  `fecha` varchar(10) NOT NULL,
  `descripcion` varchar(400) NOT NULL,
  `imagen` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `proyecto`
--

INSERT INTO `proyecto` (`id`, `clave`, `titulo`, `fecha`, `descripcion`, `imagen`) VALUES
(1, 'comisaria', 'Comisaria social', '04/07/1950', 'Ves a alguien realizar un delito?\r\nDenuncialo en tu comisaria social mas cercana. \r\nSolo con pruebas y testigos. ', 'static/images/comisaria.jpg'),
(2, 'trenza', 'Peluqueria Lola', '04/08/1980', 'Lola, la mejor. \r\nEntraras guapo y saldras de la muelte. ', 'static/images/trenza.jpg'),
(3, 'calamar', 'Pescaderia', '04/06/1970', 'Ay calamar, que a la placha te vas. \r\nLo mejor del mar cerca de tu casa.', 'static/images/calamar.jpg'),
(4, 'tenis', 'Club deportivo', '04/02/1990', 'Para amapolos y amapolas. \r\nEspecial descuento a fachalecos y sobrados de la vida.', 'static/images/tenis.jpg'),
(5, 'corso', 'Una de Piratas', '04/10/1960', 'Hohoho la botella de ron. \r\nLibres fueron hasta que los mataron. \r\nAnarquia en el mar.\r\nSu historia.', 'static/images/pirata.jpg'),
(6, 'Calabazas', 'Disfraces Hallowen/Terror', '11/10/2023', 'Tienda de disfraces especializados para Hallowen o tematica de terror', NULL),
(7, 'Bustos', 'Marmoleria y Moldes Bach', '08/08/2005', 'Especializados en venta y realización de bustos de personajes clásicos o modernos', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sesion`
--

CREATE TABLE `sesion` (
  `id` int(11) NOT NULL,
  `usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sesion`
--

INSERT INTO `sesion` (`id`, `usuario`) VALUES
(1, 1),
(2, 3),
(3, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `e-mail` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `NombreApellidos` varchar(50) NOT NULL,
  `DNI` varchar(9) NOT NULL,
  `Activo` tinyint(4) NOT NULL DEFAULT '1',
  `Admin` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `e-mail`, `password`, `NombreApellidos`, `DNI`, `Activo`, `Admin`) VALUES
(1, 'albert@ggg.com', 'Albert78', 'Albert Perez Baleyto', '38111111E', 1, 0),
(2, 'cristi@ggg.com', 'Cristi78', 'Cristina B B', '38444555t', 1, 0),
(3, 'mai@ggg.com', 'Mai45678', 'Mai Mai B', '48666777J', 1, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categoria_proyecto`
--
ALTER TABLE `categoria_proyecto`
  ADD KEY `fk_categoria` (`categoria_id`),
  ADD KEY `fk_proyecto` (`proyecto_id`);

--
-- Indices de la tabla `contacto`
--
ALTER TABLE `contacto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Clave` (`clave`);

--
-- Indices de la tabla `sesion`
--
ALTER TABLE `sesion`
  ADD KEY `fk_usuario` (`usuario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `e-mail` (`e-mail`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `categoria_proyecto`
--
ALTER TABLE `categoria_proyecto`
  ADD CONSTRAINT `fk_categoria` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`id`),
  ADD CONSTRAINT `fk_proyecto` FOREIGN KEY (`proyecto_id`) REFERENCES `proyecto` (`id`);

--
-- Filtros para la tabla `sesion`
--
ALTER TABLE `sesion`
  ADD CONSTRAINT `fk_usuario` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
