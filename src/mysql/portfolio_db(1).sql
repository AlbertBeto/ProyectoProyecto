-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: mysql
-- Tiempo de generación: 24-10-2023 a las 06:45:19
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
  `Proyecto` int(11) NOT NULL,
  `Categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categoria_proyecto`
--

INSERT INTO `categoria_proyecto` (`id`, `Proyecto`, `Categoria`) VALUES
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
  `Clave` varchar(30) NOT NULL,
  `Titulo` varchar(40) NOT NULL,
  `Fecha` date NOT NULL,
  `Descripcion` varchar(400) NOT NULL,
  `imagen` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `proyecto`
--

INSERT INTO `proyecto` (`id`, `Clave`, `Titulo`, `Fecha`, `Descripcion`, `imagen`) VALUES
(1, 'proyecto1', 'Pet-Care', '2022-10-13', 'Ecuentra gente que cuidaría de tu mascota, dias concretos o períodos vacacionales', 'static/images/pet_care.jpg'),
(2, 'proyecto2', 'Finanzas domésticas', '2021-06-10', 'Ayuda a mantener una economía de hogar clara y presupuestada.', 'static/images/finanzas.webp'),
(3, 'proyecto3', 'Ordena tu biblioteca', '2023-01-21', 'Mantén una lista actualizada de tus libros y gestionalos como si de una biblioteca se tratase.', 'static/images/libreria.jpg'),
(4, 'proyecto4', 'Vende tu bici', '2023-09-21', 'Tasamos tu bicicleta para que puedas sacarle el máximo beneficio en su venta.', NULL),
(5, 'proyecto5', 'ViniVintage', '2022-05-15', 'Encuentra ese vinilo deseado o véndelo si te quieres deshacer de él.', 'static/images/vinilos.jpg'),
(6, 'proyecto6', 'Hobby-fun', '2023-04-25', 'Comparte tus aficiones con gente de tu vecindario.', 'static/images/hobby.webp'),
(7, 'proyecto7', 'Prueba', '2023-10-12', 'Esto es una prueba, para comprobar el funcionamiento de la creación de proyectos.', 'static/images/ordenador2000.jpg');

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
  ADD KEY `fk_proyecto` (`Proyecto`),
  ADD KEY `fk_categoria` (`Categoria`);

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
  ADD UNIQUE KEY `Clave` (`Clave`);

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
  ADD CONSTRAINT `fk_categoria` FOREIGN KEY (`Categoria`) REFERENCES `categoria` (`id`),
  ADD CONSTRAINT `fk_proyecto` FOREIGN KEY (`Proyecto`) REFERENCES `proyecto` (`id`);

--
-- Filtros para la tabla `sesion`
--
ALTER TABLE `sesion`
  ADD CONSTRAINT `fk_usuario` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
