-- phpMyAdmin SQL Dump
-- version 4.0.6deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 13-09-2014 a las 13:04:20
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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CategoriaArticulo`
--

CREATE TABLE IF NOT EXISTS `CategoriaArticulo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Comentario`
--

CREATE TABLE IF NOT EXISTS `Comentario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `padre_id` int(11) DEFAULT NULL,
  `autor_id` int(11) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `texto` varchar(900) COLLATE utf8_unicode_ci NOT NULL,
  `fechaHora` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4CCE4D24B89032C` (`post_id`),
  KEY `IDX_4CCE4D2613CEC58` (`padre_id`),
  KEY `IDX_4CCE4D214D45BBE` (`autor_id`),
  KEY `IDX_4CCE4D29F5A440B` (`estado_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Estado`
--

CREATE TABLE IF NOT EXISTS `Estado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ambito` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_21F1E4D53A909126` (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

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
-- Estructura de tabla para la tabla `Mensaje`
--

CREATE TABLE IF NOT EXISTS `Mensaje` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emisor_id` int(11) DEFAULT NULL,
  `receptor_id` int(11) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `padre_id` int(11) DEFAULT NULL,
  `texto` varchar(2000) COLLATE utf8_unicode_ci NOT NULL,
  `asunto` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `fechaHora` datetime NOT NULL,
  `leido` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_54DE249D613CEC58` (`padre_id`),
  KEY `IDX_54DE249D6BDF87DF` (`emisor_id`),
  KEY `IDX_54DE249D386D8D01` (`receptor_id`),
  KEY `IDX_54DE249D9F5A440B` (`estado_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Perfil`
--

CREATE TABLE IF NOT EXISTS `Perfil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) DEFAULT NULL,
  `avatar` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descripcion` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_91C97371DB38439E` (`usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Persona`
--

CREATE TABLE IF NOT EXISTS `Persona` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `estado_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `sexo_id` int(11) DEFAULT NULL,
  `nombre` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `apellido` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `fechaNacimiento` datetime DEFAULT NULL,
  `lugarNacimiento` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `numDocumento` int(11) DEFAULT NULL,
  `tipoDocumento_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_9E588F07DB38439E` (`usuario_id`),
  KEY `IDX_9E588F073668888B` (`tipoDocumento_id`),
  KEY `IDX_9E588F079F5A440B` (`estado_id`),
  KEY `IDX_9E588F072B32DB58` (`sexo_id`)
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Proyecto`
--

CREATE TABLE IF NOT EXISTS `Proyecto` (
  `id` int(11) NOT NULL,
  `tipo_id` int(11) DEFAULT NULL,
  `fechaInicio` datetime DEFAULT NULL,
  `duracionMeses` int(11) DEFAULT NULL,
  `cupo` int(11) DEFAULT NULL,
  `version` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `codename` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_96A460EFA9276E6C` (`tipo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Sexo`
--

CREATE TABLE IF NOT EXISTS `Sexo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8C0BF9AC3A909126` (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TipoProyecto`
--

CREATE TABLE IF NOT EXISTS `TipoProyecto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuario`
--

CREATE TABLE IF NOT EXISTS `Usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `estado_id` int(11) DEFAULT NULL,
  `nombre` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_EDD889C13A909126` (`nombre`),
  UNIQUE KEY `UNIQ_EDD889C1E7927C74` (`email`),
  KEY `IDX_EDD889C19F5A440B` (`estado_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

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
  ADD CONSTRAINT `FK_2D9ACBFFD3382E62` FOREIGN KEY (`categoriaarticulo_id`) REFERENCES `CategoriaArticulo` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_2D9ACBFF2DBC2FC9` FOREIGN KEY (`articulo_id`) REFERENCES `Articulo` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `Comentario`
--
ALTER TABLE `Comentario`
  ADD CONSTRAINT `FK_4CCE4D29F5A440B` FOREIGN KEY (`estado_id`) REFERENCES `Estado` (`id`),
  ADD CONSTRAINT `FK_4CCE4D214D45BBE` FOREIGN KEY (`autor_id`) REFERENCES `Usuario` (`id`),
  ADD CONSTRAINT `FK_4CCE4D24B89032C` FOREIGN KEY (`post_id`) REFERENCES `Post` (`id`),
  ADD CONSTRAINT `FK_4CCE4D2613CEC58` FOREIGN KEY (`padre_id`) REFERENCES `Comentario` (`id`);

--
-- Filtros para la tabla `InscripcionProyecto`
--
ALTER TABLE `InscripcionProyecto`
  ADD CONSTRAINT `FK_95390519F625D1BA` FOREIGN KEY (`proyecto_id`) REFERENCES `Proyecto` (`id`),
  ADD CONSTRAINT `FK_953905194BAB96C` FOREIGN KEY (`rol_id`) REFERENCES `Rol` (`id`),
  ADD CONSTRAINT `FK_953905199F5A440B` FOREIGN KEY (`estado_id`) REFERENCES `Estado` (`id`),
  ADD CONSTRAINT `FK_95390519F5F88DB9` FOREIGN KEY (`persona_id`) REFERENCES `Persona` (`id`);

--
-- Filtros para la tabla `Mensaje`
--
ALTER TABLE `Mensaje`
  ADD CONSTRAINT `FK_54DE249D613CEC58` FOREIGN KEY (`padre_id`) REFERENCES `Mensaje` (`id`),
  ADD CONSTRAINT `FK_54DE249D386D8D01` FOREIGN KEY (`receptor_id`) REFERENCES `Usuario` (`id`),
  ADD CONSTRAINT `FK_54DE249D6BDF87DF` FOREIGN KEY (`emisor_id`) REFERENCES `Usuario` (`id`),
  ADD CONSTRAINT `FK_54DE249D9F5A440B` FOREIGN KEY (`estado_id`) REFERENCES `Estado` (`id`);

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
  ADD CONSTRAINT `FK_FAB8C3B39F5A440B` FOREIGN KEY (`estado_id`) REFERENCES `Estado` (`id`),
  ADD CONSTRAINT `FK_FAB8C3B314D45BBE` FOREIGN KEY (`autor_id`) REFERENCES `Usuario` (`id`);

--
-- Filtros para la tabla `Proyecto`
--
ALTER TABLE `Proyecto`
  ADD CONSTRAINT `FK_96A460EFBF396750` FOREIGN KEY (`id`) REFERENCES `Post` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_96A460EFA9276E6C` FOREIGN KEY (`tipo_id`) REFERENCES `TipoProyecto` (`id`);

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
