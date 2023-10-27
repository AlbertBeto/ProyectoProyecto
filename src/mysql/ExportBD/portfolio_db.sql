-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: mysql
-- Tiempo de generación: 27-10-2023 a las 16:30:15
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
(1, 'Jose Martinez Valado', 'jmv@gmail.com', 965657852, 'Particular', 'Este es un mensaje de prueba para comprobar la conexión a la BBDD.', NULL);

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
(1, 'comisaria', 'Comisaria social', '04/07/1950', 'Lorem fistrum amatomaa sexuarl al ataquerl va usté muy cargadoo. Ahorarr a wan te va a hasé pupitaa ahorarr pecador sexuarl', 'static/images/comisaria.jpg'),
(2, 'trenza', 'Peluqueria Lola', '04/08/1980', 'Lorem fistrum amatomaa sexuarl benemeritaar ese hombree la caidita pecador ese hombree por la gloria de mi madre me cago en tus muelas. Sexuarl hasta luego Lucas ese que llega caballo blanco sexuarl', 'static/images/trenza.jpg'),
(3, 'calamar', 'Pescaderia', '04/06/1970', 'Lorem fistrum amatomaa sexuarl benemeritaar ese hombree la caidita pecador ese hombree por la gloria de mi madre me cago en tus muelas. Sexuarl hasta luego Lucas ese que llega caballo blanco caballo negroorl fistro al ataquerl va ust\\u00e9 muy cargadoo. Ahorarr a wan te va a has\\u00e9 pupitaa ahorarr pecador sexuarl', 'static/images/calamar.jpg'),
(4, 'Toga', 'Togas Romanas', '16/09/2023', 'Compra tu toga romana.', NULL),
(5, 'calabaza', 'Tienda de disfraces', '04/07/1982', 'Tienda especializada en disfraces de terror y fantasia', NULL),
(6, 'corsario', 'Una de piratas', '12/05/1650', 'Lorem pirata, pirata, bucanero quieres bucan?', 'static/images/pirata.jpg'),
(7, 'tenis', 'Club de Tenis Amapolos', '22/05/1975', 'Filomeno donde juegas a tenis?\r\nYo juego en Amapolos!!', 'static/images/tenis.jpg');

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
(1, 'juanito@gmail.com', 'juanito1234', 'Juan Martinez Valero', '65852681A', 1, 0),
(2, 'pedrito@gmail.com', 'pedrito1234', 'Pedro Sánchez Galiano', '68321594L', 1, 0),
(3, 'maria@gmail.com', 'maria1234', 'María Galvez Giménez', '76591753M', 1, 0);

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
  ADD KEY `fk_proyecto` (`proyecto_id`),
  ADD KEY `fk_categoria` (`categoria_id`);

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
