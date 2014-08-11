-- phpMyAdmin SQL Dump
-- version 4.0.6deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 11-08-2014 a las 04:57:21
-- Versión del servidor: 5.5.37-0ubuntu0.13.10.1
-- Versión de PHP: 5.5.3-1ubuntu2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `cmsblog`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Articulo`
--

CREATE TABLE IF NOT EXISTS `Articulo` (
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `Articulo`
--

INSERT INTO `Articulo` (`id`) VALUES
(1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos_categoria`
--

CREATE TABLE IF NOT EXISTS `articulos_categoria` (
  `articulo_id` int(11) NOT NULL,
  `categoriaarticulo_id` int(11) NOT NULL,
  PRIMARY KEY (`articulo_id`,`categoriaarticulo_id`),
  KEY `IDX_2D9ACBFF2DBC2FC9` (`articulo_id`),
  KEY `IDX_2D9ACBFFD3382E62` (`categoriaarticulo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `articulos_categoria`
--

INSERT INTO `articulos_categoria` (`articulo_id`, `categoriaarticulo_id`) VALUES
(1, 4),
(1, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CategoriaArticulo`
--

CREATE TABLE IF NOT EXISTS `CategoriaArticulo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `estado_id` int(11) DEFAULT NULL,
  `nombre` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C81B00EE9F5A440B` (`estado_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `CategoriaArticulo`
--

INSERT INTO `CategoriaArticulo` (`id`, `estado_id`, `nombre`, `descripcion`) VALUES
(4, 1, 'portada', NULL),
(5, 1, 'blog', NULL),
(6, 1, 'noticia', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Comentario`
--

CREATE TABLE IF NOT EXISTS `Comentario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `padre_id` int(11) DEFAULT NULL,
  `texto` varchar(900) COLLATE utf8_unicode_ci NOT NULL,
  `fechaHora` datetime NOT NULL,
  `autor_id` int(11) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4CCE4D24B89032C` (`post_id`),
  KEY `IDX_4CCE4D214D45BBE` (`autor_id`),
  KEY `IDX_4CCE4D29F5A440B` (`estado_id`),
  KEY `IDX_4CCE4D2613CEC58` (`padre_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

--
-- Volcado de datos para la tabla `Comentario`
--

INSERT INTO `Comentario` (`id`, `post_id`, `padre_id`, `texto`, `fechaHora`, `autor_id`, `estado_id`) VALUES
(1, 1, NULL, 'hola maquinola', '2014-08-11 01:25:21', 4, 1),
(2, 1, 1, 'hola tu', '2014-08-11 01:32:24', 4, 1),
(3, 1, 2, 'hola linces', '2014-08-11 01:41:20', 4, 1),
(4, 1, 3, 'hay que poner un limite de respuestas??', '2014-08-11 01:41:36', 4, 1),
(5, 1, NULL, 'hola a todosÂ¡Â¡Â¡Â¡', '2014-08-11 01:48:37', 4, 1),
(6, 1, 5, 'hola linceÂ¡Â¡', '2014-08-11 01:56:39', 5, 1),
(7, 7, NULL, 'hola soy un comentario del proyecto', '2014-08-11 03:28:40', 4, 1),
(8, 7, NULL, 'mierda mierda que onda esta bosta', '2014-08-11 03:47:12', 4, 1),
(9, 7, 7, 'duhÂ¡Â¡', '2014-08-11 03:47:27', 4, 1),
(10, 1, NULL, 'hola a todosÂ¿Â¿Â¿', '2014-08-11 04:28:01', 4, 1),
(11, 1, NULL, 'The default codes include: [b]bold[/b], [i]italics[/i], [u]underlining[/u], [url=http://jbbcode.com]links[/url], [color=red]color![/color] and more.', '2014-08-11 04:43:32', 4, 1),
(12, 7, NULL, '[script] alert(''hola'');[script]', '2014-08-11 04:49:54', 4, 1),
(13, 7, NULL, '[script] alert(''hola'');[/script]', '2014-08-11 04:50:15', 4, 1),
(14, 7, NULL, '[url=http://taringa.net]taringa[/url]', '2014-08-11 04:50:52', 4, 1),
(15, 7, NULL, '[img=alt goku]http://img4.wikia.nocookie.net/__cb20100904021049/dragonball/es/images/5/58/Gogeta-super-saiyan-41.jpg[/img]', '2014-08-11 04:53:29', 4, 1),
(16, 7, NULL, '[url=https://github.com/josmanban] Mi proyectos [/url]', '2014-08-11 04:55:04', 4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Estado`
--

CREATE TABLE IF NOT EXISTS `Estado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_21F1E4D53A909126` (`nombre`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `Estado`
--

INSERT INTO `Estado` (`id`, `nombre`, `descripcion`) VALUES
(1, 'activo', NULL),
(2, 'desactivo', NULL),
(3, 'pendiente', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `InscripcionProyecto`
--

CREATE TABLE IF NOT EXISTS `InscripcionProyecto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `persona_id` int(11) DEFAULT NULL,
  `rol_id` int(11) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `proyecto_id` int(11) DEFAULT NULL,
  `descripcionActividad` varchar(350) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaInscripcion` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_95390519F5F88DB9` (`persona_id`),
  KEY `IDX_953905194BAB96C` (`rol_id`),
  KEY `IDX_953905199F5A440B` (`estado_id`),
  KEY `IDX_95390519F625D1BA` (`proyecto_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Perfil`
--

CREATE TABLE IF NOT EXISTS `Perfil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `avatar` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descripcion` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_91C97371DB38439E` (`usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Persona`
--

CREATE TABLE IF NOT EXISTS `Persona` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `apellido` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `fechaNacimiento` datetime DEFAULT NULL,
  `lugarNacimiento` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `numDocumento` int(11) DEFAULT NULL,
  `sexo_id` int(11) DEFAULT NULL,
  `tipoDocumento_id` int(11) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_9E588F07DB38439E` (`usuario_id`),
  KEY `IDX_9E588F073668888B` (`tipoDocumento_id`),
  KEY `IDX_9E588F072B32DB58` (`sexo_id`),
  KEY `IDX_9E588F079F5A440B` (`estado_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Post`
--

CREATE TABLE IF NOT EXISTS `Post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `autor_id` int(11) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `titulo` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `texto` longtext COLLATE utf8_unicode_ci NOT NULL,
  `imagen` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `fechaHoraPublicacion` datetime NOT NULL,
  `numVisitas` int(11) DEFAULT NULL,
  `discr` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_FAB8C3B314D45BBE` (`autor_id`),
  KEY `IDX_FAB8C3B39F5A440B` (`estado_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `Post`
--

INSERT INTO `Post` (`id`, `autor_id`, `estado_id`, `titulo`, `texto`, `imagen`, `fechaHoraPublicacion`, `numVisitas`, `discr`) VALUES
(1, 4, 1, 'Primer articulo', 'llfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas llfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas llfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas llfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas llfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas', 'http://localhost/sites/cmsblog/img/post/post1.png', '2014-08-11 00:41:02', NULL, 'articulo'),
(7, 4, 1, 'MVC Fundasoft', 'llfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas llfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas llfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas llfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas llfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas Ã±jllfajslfkjas Ã±fjas ', 'http://localhost/sites/cmsblog/img/post/post7.jpg', '2014-08-11 03:17:45', NULL, 'proyecto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Proyecto`
--

CREATE TABLE IF NOT EXISTS `Proyecto` (
  `id` int(11) NOT NULL,
  `tipo_id` int(11) DEFAULT NULL,
  `fechaInicio` datetime DEFAULT NULL,
  `version` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `codename` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `duracionMeses` int(11) DEFAULT NULL,
  `cupo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_96A460EFA9276E6C` (`tipo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `Proyecto`
--

INSERT INTO `Proyecto` (`id`, `tipo_id`, `fechaInicio`, `version`, `codename`, `duracionMeses`, `cupo`) VALUES
(7, 2, '2014-08-11 00:00:00', '1', 'D.E.S.A.', 15, 25);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Rol`
--

CREATE TABLE IF NOT EXISTS `Rol` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ambito` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_361879D73A909126` (`nombre`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

--
-- Volcado de datos para la tabla `Rol`
--

INSERT INTO `Rol` (`id`, `nombre`, `descripcion`, `ambito`) VALUES
(1, 'normal', NULL, 'administracion'),
(2, 'administrador', NULL, 'administracion'),
(3, 'publicador', NULL, 'administracion'),
(4, 'administradorArticulo', NULL, 'administracion'),
(5, 'administradorProyecto', '', 'administracion'),
(6, 'publicadorProyecto', NULL, 'administracion'),
(7, 'maquetador', NULL, 'proyecto'),
(8, 'desarrollador', NULL, 'proyecto'),
(9, 'participante', NULL, 'proyecto'),
(10, 'exponente', NULL, 'proyecto'),
(11, 'projectManager', NULL, 'proyecto'),
(12, 'profesor', NULL, 'proyecto'),
(13, 'asistente', NULL, 'proyecto'),
(14, 'alumno', NULL, 'proyecto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Sexo`
--

CREATE TABLE IF NOT EXISTS `Sexo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8C0BF9AC3A909126` (`nombre`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `Sexo`
--

INSERT INTO `Sexo` (`id`, `nombre`) VALUES
(2, 'FEMENINO'),
(1, 'MASCULINO'),
(4, 'MIXTO'),
(3, 'TRANSEXUAL');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TipoDocumento`
--

CREATE TABLE IF NOT EXISTS `TipoDocumento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_7F3BF8383A909126` (`nombre`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `TipoDocumento`
--

INSERT INTO `TipoDocumento` (`id`, `nombre`, `descripcion`) VALUES
(1, 'DNI', NULL),
(2, 'CEDULA', NULL),
(3, 'PASAPORTE', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TipoProyecto`
--

CREATE TABLE IF NOT EXISTS `TipoProyecto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `TipoProyecto`
--

INSERT INTO `TipoProyecto` (`id`, `nombre`, `descripcion`) VALUES
(1, 'curso', 'Curso'),
(2, 'desarrollo', 'Desarrollo'),
(3, 'charla', 'Charla');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuario`
--

CREATE TABLE IF NOT EXISTS `Usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `estado_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_EDD889C13A909126` (`nombre`),
  UNIQUE KEY `UNIQ_EDD889C1E7927C74` (`email`),
  KEY `IDX_EDD889C19F5A440B` (`estado_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `Usuario`
--

INSERT INTO `Usuario` (`id`, `nombre`, `password`, `email`, `estado_id`) VALUES
(4, 'josmanban', '5f7956078131d2fb57032a901c7e7426', 'josemanuelbanda@gmail.com', 1),
(5, 'fundasoft', 'd1f1c246b66cb44ebe32b8e6c9351b93', 'fundasoft@gmail.com', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_roles`
--

CREATE TABLE IF NOT EXISTS `usuarios_roles` (
  `usuario_id` int(11) NOT NULL,
  `rol_id` int(11) NOT NULL,
  PRIMARY KEY (`usuario_id`,`rol_id`),
  KEY `IDX_CE0972BADB38439E` (`usuario_id`),
  KEY `IDX_CE0972BA4BAB96C` (`rol_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios_roles`
--

INSERT INTO `usuarios_roles` (`usuario_id`, `rol_id`) VALUES
(4, 1),
(4, 2),
(4, 3),
(4, 4),
(4, 5),
(5, 1);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Articulo`
--
ALTER TABLE `Articulo`
  ADD CONSTRAINT `FK_909F2CC7BF396750` FOREIGN KEY (`id`) REFERENCES `Post` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `articulos_categoria`
--
ALTER TABLE `articulos_categoria`
  ADD CONSTRAINT `FK_2D9ACBFF2DBC2FC9` FOREIGN KEY (`articulo_id`) REFERENCES `Articulo` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_2D9ACBFFD3382E62` FOREIGN KEY (`categoriaarticulo_id`) REFERENCES `CategoriaArticulo` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `CategoriaArticulo`
--
ALTER TABLE `CategoriaArticulo`
  ADD CONSTRAINT `FK_C81B00EE9F5A440B` FOREIGN KEY (`estado_id`) REFERENCES `Estado` (`id`);

--
-- Filtros para la tabla `Comentario`
--
ALTER TABLE `Comentario`
  ADD CONSTRAINT `FK_4CCE4D214D45BBE` FOREIGN KEY (`autor_id`) REFERENCES `Usuario` (`id`),
  ADD CONSTRAINT `FK_4CCE4D24B89032C` FOREIGN KEY (`post_id`) REFERENCES `Post` (`id`),
  ADD CONSTRAINT `FK_4CCE4D2613CEC58` FOREIGN KEY (`padre_id`) REFERENCES `Comentario` (`id`),
  ADD CONSTRAINT `FK_4CCE4D29F5A440B` FOREIGN KEY (`estado_id`) REFERENCES `Estado` (`id`);

--
-- Filtros para la tabla `InscripcionProyecto`
--
ALTER TABLE `InscripcionProyecto`
  ADD CONSTRAINT `FK_953905194BAB96C` FOREIGN KEY (`rol_id`) REFERENCES `Rol` (`id`),
  ADD CONSTRAINT `FK_953905199F5A440B` FOREIGN KEY (`estado_id`) REFERENCES `Estado` (`id`),
  ADD CONSTRAINT `FK_95390519F5F88DB9` FOREIGN KEY (`persona_id`) REFERENCES `Persona` (`id`),
  ADD CONSTRAINT `FK_95390519F625D1BA` FOREIGN KEY (`proyecto_id`) REFERENCES `Proyecto` (`id`);

--
-- Filtros para la tabla `Perfil`
--
ALTER TABLE `Perfil`
  ADD CONSTRAINT `FK_91C97371DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuario` (`id`);

--
-- Filtros para la tabla `Persona`
--
ALTER TABLE `Persona`
  ADD CONSTRAINT `FK_9E588F072B32DB58` FOREIGN KEY (`sexo_id`) REFERENCES `Sexo` (`id`),
  ADD CONSTRAINT `FK_9E588F073668888B` FOREIGN KEY (`tipoDocumento_id`) REFERENCES `TipoDocumento` (`id`),
  ADD CONSTRAINT `FK_9E588F079F5A440B` FOREIGN KEY (`estado_id`) REFERENCES `Estado` (`id`),
  ADD CONSTRAINT `FK_9E588F07DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuario` (`id`);

--
-- Filtros para la tabla `Post`
--
ALTER TABLE `Post`
  ADD CONSTRAINT `FK_FAB8C3B314D45BBE` FOREIGN KEY (`autor_id`) REFERENCES `Usuario` (`id`),
  ADD CONSTRAINT `FK_FAB8C3B39F5A440B` FOREIGN KEY (`estado_id`) REFERENCES `Estado` (`id`);

--
-- Filtros para la tabla `Proyecto`
--
ALTER TABLE `Proyecto`
  ADD CONSTRAINT `FK_96A460EFA9276E6C` FOREIGN KEY (`tipo_id`) REFERENCES `TipoProyecto` (`id`),
  ADD CONSTRAINT `FK_96A460EFBF396750` FOREIGN KEY (`id`) REFERENCES `Post` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `Usuario`
--
ALTER TABLE `Usuario`
  ADD CONSTRAINT `FK_EDD889C19F5A440B` FOREIGN KEY (`estado_id`) REFERENCES `Estado` (`id`);

--
-- Filtros para la tabla `usuarios_roles`
--
ALTER TABLE `usuarios_roles`
  ADD CONSTRAINT `FK_CE0972BA4BAB96C` FOREIGN KEY (`rol_id`) REFERENCES `Rol` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_CE0972BADB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `Usuario` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
