-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-01-2020 a las 13:19:21
-- Versión del servidor: 10.1.19-MariaDB
-- Versión de PHP: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `inverconbd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas`
--

CREATE TABLE `areas` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `geolocations` text NOT NULL,
  `keywords` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `areas`
--

INSERT INTO `areas` (`id`, `name`, `geolocations`, `keywords`) VALUES
(1, 'TEST', '-0.11432647705078125,51.503186376638006,-0.0954437255859375,51.50767403407925,-0.11140823364257812,51.51152024583139', 'TEST');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `asesor`
--
CREATE TABLE `asesor` (
`nombre` varchar(100)
,`apellido` varchar(50)
,`login` varchar(100)
,`password` varchar(20)
,`ci` varchar(20)
,`id_rol` int(11)
,`id_sucursal` int(11)
,`email` varchar(50)
,`telefono_fijo01` varchar(100)
,`telefono_fijo02` varchar(100)
,`celular` varchar(100)
,`celular2` varchar(100)
,`direccion` text
,`cargo` varchar(100)
,`id_institucion` int(11)
,`especialidad` varchar(100)
,`status` int(11)
,`codigo` varchar(5)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `audittrail`
--

CREATE TABLE `audittrail` (
  `id` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `script` varchar(80) DEFAULT NULL,
  `user` varchar(80) DEFAULT NULL,
  `action` varchar(80) DEFAULT NULL,
  `table` varchar(80) DEFAULT NULL,
  `field` varchar(80) DEFAULT NULL,
  `keyvalue` longtext,
  `oldvalue` longtext,
  `newvalue` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `audittrail`
--

INSERT INTO `audittrail` (`id`, `datetime`, `script`, `user`, `action`, `table`, `field`, `keyvalue`, `oldvalue`, `newvalue`) VALUES
(1, '2019-08-19 15:09:07', '/invercon/login.php', 'eprep.test05@yahoo.com', 'Inicia sesión', '::1', '', '', '', ''),
(2, '2019-08-19 22:15:09', '/invercon/logout.php', 'eprep.test05@yahoo.com', 'Cierra sesión', '::1', '', '', '', ''),
(3, '2019-08-19 22:15:15', '/invercon/login.php', 'Luke.Skywalker.Force01@gmail.com', 'Inicia sesión', '::1', '', '', '', ''),
(4, '2019-08-19 22:16:01', '/invercon/logout.php', 'Luke.Skywalker.Force01@gmail.com', 'Cierra sesión', '::1', '', '', '', ''),
(5, '2019-08-19 22:16:09', '/invercon/login.php', 'admin', 'Inicia sesión', '::1', '', '', '', ''),
(6, '2019-08-19 22:18:55', '/invercon/logout.php', 'Administrador', 'Cierra sesión', '::1', '', '', '', ''),
(7, '2019-08-19 22:19:05', '/invercon/login.php', 'eprep.test05@yahoo.com', 'Inicia sesión', '::1', '', '', '', ''),
(8, '2019-08-19 22:19:41', '/invercon/logout.php', 'eprep.test05@yahoo.com', 'Cierra sesión', '::1', '', '', '', ''),
(9, '2019-08-19 22:19:47', '/invercon/login.php', 'carlos.gerd.claros.orellana@gmx.es', 'Inicia sesión', '::1', '', '', '', ''),
(10, '2019-08-19 22:37:19', '/invercon/logout.php', 'carlos.gerd.claros.orellana@gmx.es', 'Cierra sesión', '::1', '', '', '', ''),
(11, '2019-08-19 22:37:34', '/invercon/login.php', 'eprep.test05@yahoo.com', 'Inicia sesión', '::1', '', '', '', ''),
(12, '2019-08-20 16:19:04', '/invercon/login.php', 'eprep.test05@yahoo.com', 'Inicia sesión', '::1', '', '', '', ''),
(13, '2019-08-20 16:30:21', '/invercon/logout.php', 'eprep.test05@yahoo.com', 'Cierra sesión', '::1', '', '', '', ''),
(14, '2019-08-20 16:30:26', '/invercon/login.php', 'admin', 'Inicia sesión', '::1', '', '', '', ''),
(15, '2019-08-20 16:32:22', '/invercon/logout.php', 'Administrador', 'Cierra sesión', '::1', '', '', '', ''),
(16, '2019-08-20 16:33:31', '/invercon/login.php', 'eprep.test05@yahoo.com', 'Inicia sesión', '::1', '', '', '', ''),
(17, '2019-08-21 12:57:15', '/invercon/login.php', 'eprep.test05@yahoo.com', 'Inicia sesión', '::1', '', '', '', ''),
(18, '2019-08-21 15:17:26', '/invercon/logout.php', 'eprep.test05@yahoo.com', 'Cierra sesión', '::1', '', '', '', ''),
(19, '2019-08-21 15:17:33', '/invercon/login.php', 'admin', 'Inicia sesión', '::1', '', '', '', ''),
(20, '2019-08-21 15:20:29', '/invercon/logout.php', 'Administrador', 'Cierra sesión', '::1', '', '', '', ''),
(21, '2019-08-21 15:20:38', '/invercon/login.php', 'eprep.test05@yahoo.com', 'Inicia sesión', '::1', '', '', '', ''),
(22, '2019-08-21 15:20:38', '/invercon/login.php', 'eprep.test05@yahoo.com', 'Inicia sesión', '::1', '', '', '', ''),
(23, '2019-08-21 19:37:15', '/invercon/logout.php', 'eprep.test05@yahoo.com', 'Cierra sesión', '::1', '', '', '', ''),
(24, '2019-08-21 19:37:21', '/invercon/login.php', 'ADMIN', 'Inicia sesión', '::1', '', '', '', ''),
(25, '2019-08-21 19:41:58', '/invercon/logout.php', 'Administrador', 'Cierra sesión', '::1', '', '', '', ''),
(26, '2019-08-21 19:42:09', '/invercon/login.php', 'admin', 'Inicia sesión', '::1', '', '', '', ''),
(27, '2019-08-21 19:46:30', '/invercon/logout.php', 'Administrador', 'Cierra sesión', '::1', '', '', '', ''),
(28, '2019-08-21 19:46:40', '/invercon/login.php', 'eprep.test05@yahoo.com', 'Inicia sesión', '::1', '', '', '', ''),
(29, '2019-08-22 13:12:54', '/invercon/login.php', 'eprep.test05@yahoo.com', 'Inicia sesión', '::1', '', '', '', ''),
(30, '2019-08-22 19:31:27', '/invercon/logout.php', 'eprep.test05@yahoo.com', 'Cierra sesión', '::1', '', '', '', ''),
(31, '2019-08-22 19:31:38', '/invercon/login.php', 'admin', 'Inicia sesión', '::1', '', '', '', ''),
(32, '2019-08-24 17:58:26', '/invercon/login.php', 'admin', 'Inicia sesión', '::1', '', '', '', ''),
(33, '2019-08-24 21:27:59', '/invercon/logout.php', 'Administrador', 'Cierra sesión', '::1', '', '', '', ''),
(34, '2019-08-24 21:28:11', '/invercon/login.php', 'eprep.test05@yahoo.com', 'Inicia sesión', '::1', '', '', '', ''),
(35, '2019-08-25 01:35:33', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', '*** Actualización múltiple iniciada ***', 'avaluo', '', '', '', ''),
(36, '2019-08-25 01:35:33', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', 'U', 'avaluo', 'codigoavaluo', '1', NULL, 'sdfsdfsd'),
(37, '2019-08-25 01:35:33', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', 'U', 'avaluo', 'id_inspector', '1', NULL, 'richard.gecko01test@gmail.com'),
(38, '2019-08-25 01:35:33', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', 'U', 'avaluo', 'codigoavaluo', '2', NULL, 'sdfsdfsd'),
(39, '2019-08-25 01:35:33', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', 'U', 'avaluo', 'id_inspector', '2', NULL, 'richard.gecko01test@gmail.com'),
(40, '2019-08-25 01:35:34', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', '*** Actualización múltiple exitosa ***', 'avaluo', '', '', '', ''),
(41, '2019-08-25 01:38:07', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', '*** Actualización múltiple iniciada ***', 'avaluo', '', '', '', ''),
(42, '2019-08-25 01:38:08', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', 'U', 'avaluo', 'codigoavaluo', '3', NULL, '12234444'),
(43, '2019-08-25 01:38:08', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', 'U', 'avaluo', 'id_inspector', '3', NULL, 'Luke.Skywalker.Force01@gmail.com'),
(44, '2019-08-25 01:38:08', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', 'U', 'avaluo', 'codigoavaluo', '4', NULL, '12234444'),
(45, '2019-08-25 01:38:08', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', 'U', 'avaluo', 'id_inspector', '4', NULL, 'Luke.Skywalker.Force01@gmail.com'),
(46, '2019-08-25 01:38:08', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', '*** Actualización múltiple exitosa ***', 'avaluo', '', '', '', ''),
(47, '2019-08-25 01:50:52', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', '*** Actualización múltiple iniciada ***', 'avaluo', '', '', '', ''),
(48, '2019-08-25 01:50:52', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', 'U', 'avaluo', 'codigoavaluo', '3', '12234444', '231321'),
(49, '2019-08-25 01:50:52', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', 'U', 'avaluo', 'codigoavaluo', '4', '12234444', '231321'),
(50, '2019-08-25 01:50:52', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', '*** Actualización múltiple exitosa ***', 'avaluo', '', '', '', ''),
(51, '2019-08-25 01:55:11', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', '*** Actualización múltiple iniciada ***', 'avaluo', '', '', '', ''),
(52, '2019-08-25 01:55:11', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', '*** Actualización múltiple exitosa ***', 'avaluo', '', '', '', ''),
(53, '2019-08-25 01:56:33', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', '*** Actualización múltiple iniciada ***', 'avaluo', '', '', '', ''),
(54, '2019-08-25 01:56:34', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', 'U', 'avaluo', 'codigoavaluo', '3', '231321', '2313213'),
(55, '2019-08-25 01:56:34', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', 'U', 'avaluo', 'codigoavaluo', '4', '231321', '2313213'),
(56, '2019-08-25 01:56:34', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', '*** Actualización múltiple exitosa ***', 'avaluo', '', '', '', ''),
(57, '2019-08-25 01:57:25', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', '*** Actualización múltiple iniciada ***', 'avaluo', '', '', '', ''),
(58, '2019-08-25 01:57:25', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', 'U', 'avaluo', 'codigoavaluo', '3', '2313213', '2313213423'),
(59, '2019-08-25 01:57:25', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', 'U', 'avaluo', 'estado', '3', '1', '2'),
(60, '2019-08-25 01:57:25', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', 'U', 'avaluo', 'codigoavaluo', '4', '2313213', '2313213423'),
(61, '2019-08-25 01:57:25', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', 'U', 'avaluo', 'estado', '4', '1', '2'),
(62, '2019-08-25 01:57:25', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', '*** Actualización múltiple exitosa ***', 'avaluo', '', '', '', ''),
(63, '2019-08-25 02:05:18', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', '*** Actualización múltiple iniciada ***', 'avaluo', '', '', '', ''),
(64, '2019-08-25 02:05:18', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', '*** Actualización múltiple exitosa ***', 'avaluo', '', '', '', ''),
(65, '2019-08-25 02:06:03', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', '*** Actualización múltiple iniciada ***', 'avaluo', '', '', '', ''),
(66, '2019-08-25 02:06:04', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', 'U', 'avaluo', 'estado', '3', '1', '2'),
(67, '2019-08-25 02:06:04', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', 'U', 'avaluo', 'estado', '4', '1', '2'),
(68, '2019-08-25 02:06:04', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', '*** Actualización múltiple exitosa ***', 'avaluo', '', '', '', ''),
(69, '2019-08-25 02:34:13', '/invercon/logout.php', 'eprep.test05@yahoo.com', 'Cierra sesión', '::1', '', '', '', ''),
(70, '2019-08-25 02:34:26', '/invercon/login.php', 'admin', 'Inicia sesión', '::1', '', '', '', ''),
(71, '2019-08-25 02:37:18', '/invercon/logout.php', 'Administrador', 'Cierra sesión', '::1', '', '', '', ''),
(72, '2019-08-25 02:37:36', '/invercon/login.php', 'eprep.test05@yahoo.com', 'Inicia sesión', '::1', '', '', '', ''),
(73, '2019-08-25 13:32:29', '/invercon/avaluoadd.php', 'eprep.test05@yahoo.com', 'A', 'avaluo', 'tipoinmueble', '5', '', 'departamento'),
(74, '2019-08-25 13:32:29', '/invercon/avaluoadd.php', 'eprep.test05@yahoo.com', 'A', 'avaluo', 'id_solicitud', '5', '', '2'),
(75, '2019-08-25 13:32:29', '/invercon/avaluoadd.php', 'eprep.test05@yahoo.com', 'A', 'avaluo', 'id_oficialcredito', '5', '', 'carlos.gerd.claros.orellana@gmx.es'),
(76, '2019-08-25 13:32:29', '/invercon/avaluoadd.php', 'eprep.test05@yahoo.com', 'A', 'avaluo', 'id', '5', '', '5'),
(77, '2019-08-25 13:33:28', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', '*** Actualización múltiple iniciada ***', 'avaluo', '', '', '', ''),
(78, '2019-08-25 13:33:28', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', 'U', 'avaluo', 'codigoavaluo', '5', NULL, '2313213423'),
(79, '2019-08-25 13:33:28', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', 'U', 'avaluo', 'id_inspector', '5', NULL, 'Luke.Skywalker.Force01@gmail.com'),
(80, '2019-08-25 13:33:28', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', 'U', 'avaluo', 'fecha_avaluo', '5', NULL, '2019-08-30 09:32:49'),
(81, '2019-08-25 13:33:28', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', 'U', 'avaluo', 'estado', '5', '1', '2'),
(82, '2019-08-25 13:33:28', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', '*** Actualización múltiple exitosa ***', 'avaluo', '', '', '', ''),
(83, '2019-08-25 13:33:53', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', '*** Actualización múltiple iniciada ***', 'avaluo', '', '', '', ''),
(84, '2019-08-25 13:33:53', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', 'U', 'avaluo', 'fecha_avaluo', '3', NULL, '2019-08-30 09:33:47'),
(85, '2019-08-25 13:33:53', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', 'U', 'avaluo', 'fecha_avaluo', '4', NULL, '2019-08-30 09:33:47'),
(86, '2019-08-25 13:33:53', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', '*** Actualización múltiple exitosa ***', 'avaluo', '', '', '', ''),
(87, '2019-08-25 14:07:20', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', '*** Actualización múltiple iniciada ***', 'avaluo', '', '', '', ''),
(88, '2019-08-25 14:07:20', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', 'U', 'avaluo', 'fecha_avaluo', '1', NULL, '2019-08-22 10:06:52'),
(89, '2019-08-25 14:07:20', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', 'U', 'avaluo', 'estado', '1', '1', '2'),
(90, '2019-08-25 14:07:20', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', 'U', 'avaluo', 'fecha_avaluo', '2', NULL, '2019-08-22 10:06:52'),
(91, '2019-08-25 14:07:20', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', 'U', 'avaluo', 'estado', '2', '1', '2'),
(92, '2019-08-25 14:07:20', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', '*** Actualización múltiple exitosa ***', 'avaluo', '', '', '', ''),
(93, '2019-08-25 14:08:41', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', '*** Actualización múltiple iniciada ***', 'avaluo', '', '', '', ''),
(94, '2019-08-25 14:08:41', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', 'U', 'avaluo', 'codigoavaluo', '1', 'sdfsdfsd', '123'),
(95, '2019-08-25 14:08:41', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', 'U', 'avaluo', 'codigoavaluo', '2', 'sdfsdfsd', '123'),
(96, '2019-08-25 14:08:41', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', '*** Actualización múltiple exitosa ***', 'avaluo', '', '', '', ''),
(97, '2019-08-25 14:20:57', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', '*** Actualización múltiple iniciada ***', 'avaluo', '', '', '', ''),
(98, '2019-08-25 14:20:58', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', 'U', 'avaluo', 'codigoavaluo', '6', NULL, '12345'),
(99, '2019-08-25 14:20:58', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', 'U', 'avaluo', 'id_inspector', '6', NULL, 'Luke.Skywalker.Force01@gmail.com'),
(100, '2019-08-25 14:20:58', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', 'U', 'avaluo', 'fecha_avaluo', '6', NULL, '2019-08-22 10:20:36'),
(101, '2019-08-25 14:20:58', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', 'U', 'avaluo', 'estado', '6', '1', '2'),
(102, '2019-08-25 14:20:58', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', 'U', 'avaluo', 'estadointerno', '6', '1', '2'),
(103, '2019-08-25 14:20:58', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', 'U', 'avaluo', 'codigoavaluo', '7', NULL, '12345'),
(104, '2019-08-25 14:20:58', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', 'U', 'avaluo', 'id_inspector', '7', NULL, 'Luke.Skywalker.Force01@gmail.com'),
(105, '2019-08-25 14:20:58', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', 'U', 'avaluo', 'fecha_avaluo', '7', NULL, '2019-08-22 10:20:36'),
(106, '2019-08-25 14:20:58', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', 'U', 'avaluo', 'estado', '7', '1', '2'),
(107, '2019-08-25 14:20:58', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', 'U', 'avaluo', 'estadointerno', '7', '1', '2'),
(108, '2019-08-25 14:20:58', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', 'U', 'avaluo', 'codigoavaluo', '8', NULL, '12345'),
(109, '2019-08-25 14:20:58', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', 'U', 'avaluo', 'id_inspector', '8', NULL, 'Luke.Skywalker.Force01@gmail.com'),
(110, '2019-08-25 14:20:58', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', 'U', 'avaluo', 'fecha_avaluo', '8', NULL, '2019-08-22 10:20:36'),
(111, '2019-08-25 14:20:58', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', 'U', 'avaluo', 'estado', '8', '1', '2'),
(112, '2019-08-25 14:20:58', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', 'U', 'avaluo', 'estadointerno', '8', '1', '2'),
(113, '2019-08-25 14:20:58', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', '*** Actualización múltiple exitosa ***', 'avaluo', '', '', '', ''),
(114, '2019-08-25 14:23:32', '/invercon/logout.php', 'eprep.test05@yahoo.com', 'Cierra sesión', '::1', '', '', '', ''),
(115, '2019-08-25 14:46:10', '/invercon/login.php', 'admin', 'Inicia sesión', '::1', '', '', '', ''),
(116, '2019-08-25 14:55:24', '/invercon/logout.php', 'Administrador', 'Cierra sesión', '::1', '', '', '', ''),
(117, '2019-08-25 15:03:13', '/invercon/login.php', 'admin', 'Inicia sesión', '::1', '', '', '', ''),
(118, '2019-08-25 15:16:21', '/invercon/logout.php', 'Administrador', 'Cierra sesión', '::1', '', '', '', ''),
(119, '2019-08-25 15:16:33', '/invercon/login.php', 'richard.gecko01test@gmail.com', 'Inicia sesión', '::1', '', '', '', ''),
(120, '2019-08-25 15:18:38', '/invercon/logout.php', 'richard.gecko01test@gmail.com', 'Cierra sesión', '::1', '', '', '', ''),
(121, '2019-08-25 15:18:49', '/invercon/login.php', 'admin', 'Inicia sesión', '::1', '', '', '', ''),
(122, '2019-08-25 15:30:08', '/invercon/logout.php', 'Administrador', 'Cierra sesión', '::1', '', '', '', ''),
(123, '2019-08-25 15:30:16', '/invercon/login.php', 'richard.gecko01test@gmail.com', 'Inicia sesión', '::1', '', '', '', ''),
(124, '2019-08-25 15:31:18', '/invercon/logout.php', 'richard.gecko01test@gmail.com', 'Cierra sesión', '::1', '', '', '', ''),
(125, '2019-08-25 15:31:28', '/invercon/login.php', 'richard.gecko01test@gmail.com', 'Inicia sesión', '::1', '', '', '', ''),
(126, '2019-08-25 15:47:47', '/invercon/logout.php', 'richard.gecko01test@gmail.com', 'Cierra sesión', '::1', '', '', '', ''),
(127, '2019-08-25 15:47:57', '/invercon/login.php', 'richard.gecko01test@gmail.com', 'Inicia sesión', '::1', '', '', '', ''),
(128, '2019-08-25 15:55:34', '/invercon/logout.php', 'richard.gecko01test@gmail.com', 'Cierra sesión', '::1', '', '', '', ''),
(129, '2019-08-25 15:55:45', '/invercon/login.php', 'Luke.Skywalker.Force01@gmail.com', 'Inicia sesión', '::1', '', '', '', ''),
(130, '2019-08-25 15:57:28', '/invercon/logout.php', 'Luke.Skywalker.Force01@gmail.com', 'Cierra sesión', '::1', '', '', '', ''),
(131, '2019-08-25 15:57:51', '/invercon/login.php', 'eprep.test05@yahoo.com', 'Inicia sesión', '::1', '', '', '', ''),
(132, '2019-08-25 16:06:23', '/invercon/logout.php', 'eprep.test05@yahoo.com', 'Cierra sesión', '::1', '', '', '', ''),
(133, '2019-08-25 16:06:34', '/invercon/login.php', 'Luke.Skywalker.Force01@gmail.com', 'Inicia sesión', '::1', '', '', '', ''),
(134, '2019-08-25 16:10:52', '/invercon/logout.php', 'Luke.Skywalker.Force01@gmail.com', 'Cierra sesión', '::1', '', '', '', ''),
(135, '2019-08-25 16:11:08', '/invercon/login.php', 'eprep.test05@yahoo.com', 'Inicia sesión', '::1', '', '', '', ''),
(136, '2019-08-25 16:14:31', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', '*** Actualización múltiple iniciada ***', 'avaluo', '', '', '', ''),
(137, '2019-08-25 16:14:31', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', '*** Actualización múltiple exitosa ***', 'avaluo', '', '', '', ''),
(138, '2019-08-25 16:16:28', '/invercon/logout.php', 'eprep.test05@yahoo.com', 'Cierra sesión', '::1', '', '', '', ''),
(139, '2019-08-25 16:16:38', '/invercon/login.php', 'admin', 'Inicia sesión', '::1', '', '', '', ''),
(140, '2019-08-25 16:17:28', '/invercon/logout.php', 'Administrador', 'Cierra sesión', '::1', '', '', '', ''),
(141, '2019-08-25 16:17:45', '/invercon/login.php', 'eprep.test05@yahoo.com', 'Inicia sesión', '::1', '', '', '', ''),
(142, '2019-08-25 18:44:00', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', '*** Actualización múltiple iniciada ***', 'avaluo', '', '', '', ''),
(143, '2019-08-25 18:44:00', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', 'U', 'avaluo', 'codigoavaluo', '1', NULL, 'dddd'),
(144, '2019-08-25 18:44:00', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', 'U', 'avaluo', 'id_inspector', '1', NULL, 'Luke.Skywalker.Force01@gmail.com'),
(145, '2019-08-25 18:44:00', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', 'U', 'avaluo', 'fecha_avaluo', '1', NULL, '2019-08-25 14:43:37'),
(146, '2019-08-25 18:44:00', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', 'U', 'avaluo', 'estado', '1', '1', '2'),
(147, '2019-08-25 18:44:00', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', 'U', 'avaluo', 'estadointerno', '1', '1', '2'),
(148, '2019-08-25 18:44:00', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', 'U', 'avaluo', 'codigoavaluo', '2', NULL, 'dddd'),
(149, '2019-08-25 18:44:00', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', 'U', 'avaluo', 'id_inspector', '2', NULL, 'Luke.Skywalker.Force01@gmail.com'),
(150, '2019-08-25 18:44:00', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', 'U', 'avaluo', 'fecha_avaluo', '2', NULL, '2019-08-25 14:43:37'),
(151, '2019-08-25 18:44:00', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', 'U', 'avaluo', 'estado', '2', '1', '2'),
(152, '2019-08-25 18:44:00', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', 'U', 'avaluo', 'estadointerno', '2', '1', '2'),
(153, '2019-08-25 18:44:01', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', '*** Actualización múltiple exitosa ***', 'avaluo', '', '', '', ''),
(154, '2019-08-25 18:44:13', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', '*** Actualización múltiple iniciada ***', 'avaluo', '', '', '', ''),
(155, '2019-08-25 18:44:13', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', 'U', 'avaluo', 'codigoavaluo', '1', 'dddd', '1234'),
(156, '2019-08-25 18:44:13', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', 'U', 'avaluo', 'codigoavaluo', '2', 'dddd', '1234'),
(157, '2019-08-25 18:44:14', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', '*** Actualización múltiple exitosa ***', 'avaluo', '', '', '', ''),
(158, '2019-08-25 18:44:36', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', '*** Actualización múltiple iniciada ***', 'avaluo', '', '', '', ''),
(159, '2019-08-25 18:44:36', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', '*** Actualización múltiple exitosa ***', 'avaluo', '', '', '', ''),
(160, '2019-08-25 18:46:53', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', '*** Actualización múltiple iniciada ***', 'avaluo', '', '', '', ''),
(161, '2019-08-25 18:46:53', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', '*** Actualización múltiple exitosa ***', 'avaluo', '', '', '', ''),
(162, '2019-08-25 18:47:15', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', '*** Actualización múltiple iniciada ***', 'avaluo', '', '', '', ''),
(163, '2019-08-25 18:47:15', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', '*** Actualización múltiple exitosa ***', 'avaluo', '', '', '', ''),
(164, '2019-08-25 18:47:51', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', '*** Actualización múltiple iniciada ***', 'avaluo', '', '', '', ''),
(165, '2019-08-25 18:47:52', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', '*** Actualización múltiple exitosa ***', 'avaluo', '', '', '', ''),
(166, '2019-08-25 18:56:37', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', '*** Actualización múltiple iniciada ***', 'avaluo', '', '', '', ''),
(167, '2019-08-25 18:56:37', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', '*** Actualización múltiple exitosa ***', 'avaluo', '', '', '', ''),
(168, '2019-08-25 19:01:56', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', '*** Actualización múltiple iniciada ***', 'avaluo', '', '', '', ''),
(169, '2019-08-25 19:01:56', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', '*** Actualización múltiple exitosa ***', 'avaluo', '', '', '', ''),
(170, '2019-08-25 19:15:29', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', '*** Actualización múltiple iniciada ***', 'avaluo', '', '', '', ''),
(171, '2019-08-25 19:15:33', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', '*** Actualización múltiple exitosa ***', 'avaluo', '', '', '', ''),
(175, '2019-08-25 19:17:43', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', '*** Actualización múltiple iniciada ***', 'avaluo', '', '', '', ''),
(176, '2019-08-25 19:17:47', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', '*** Actualización múltiple exitosa ***', 'avaluo', '', '', '', ''),
(177, '2019-08-25 19:18:28', '/invercon/logout.php', 'eprep.test05@yahoo.com', 'Cierra sesión', '::1', '', '', '', ''),
(178, '2019-08-25 19:18:40', '/invercon/login.php', 'eprep.test05@yahoo.com', 'Inicia sesión', '::1', '', '', '', ''),
(179, '2019-08-25 19:19:12', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', '*** Actualización múltiple iniciada ***', 'avaluo', '', '', '', ''),
(180, '2019-08-25 19:19:16', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', '*** Actualización múltiple exitosa ***', 'avaluo', '', '', '', ''),
(181, '2019-08-25 19:21:23', '/invercon/logout.php', 'eprep.test05@yahoo.com', 'Cierra sesión', '::1', '', '', '', ''),
(182, '2019-08-25 19:21:39', '/invercon/login.php', 'Luke.Skywalker.Force01@gmail.com', 'Inicia sesión', '::1', '', '', '', ''),
(183, '2019-08-25 21:09:47', '/invercon/logout.php', 'Luke.Skywalker.Force01@gmail.com', 'Cierra sesión', '::1', '', '', '', ''),
(184, '2019-08-25 21:10:20', '/invercon/login.php', 'eprep.test05@yahoo.com', 'Inicia sesión', '::1', '', '', '', ''),
(185, '2019-08-25 21:13:03', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', '*** Actualización múltiple iniciada ***', 'avaluo', '', '', '', ''),
(186, '2019-08-25 21:13:10', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', 'U', 'avaluo', 'codigoavaluo', '1', NULL, '123'),
(187, '2019-08-25 21:13:10', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', 'U', 'avaluo', 'id_inspector', '1', NULL, 'Luke.Skywalker.Force01@gmail.com'),
(188, '2019-08-25 21:13:10', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', 'U', 'avaluo', 'fecha_avaluo', '1', NULL, '2019-08-29 17:12:39'),
(189, '2019-08-25 21:13:10', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', 'U', 'avaluo', 'estado', '1', '1', '2'),
(190, '2019-08-25 21:13:10', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', 'U', 'avaluo', 'estadointerno', '1', '1', '2'),
(191, '2019-08-25 21:13:12', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', 'U', 'avaluo', 'codigoavaluo', '2', NULL, '123'),
(192, '2019-08-25 21:13:12', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', 'U', 'avaluo', 'id_inspector', '2', NULL, 'Luke.Skywalker.Force01@gmail.com'),
(193, '2019-08-25 21:13:12', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', 'U', 'avaluo', 'fecha_avaluo', '2', NULL, '2019-08-29 17:12:39'),
(194, '2019-08-25 21:13:12', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', 'U', 'avaluo', 'estado', '2', '1', '2'),
(195, '2019-08-25 21:13:12', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', 'U', 'avaluo', 'estadointerno', '2', '1', '2'),
(196, '2019-08-25 21:13:13', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', '*** Actualización múltiple exitosa ***', 'avaluo', '', '', '', ''),
(197, '2019-08-25 21:13:17', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', '*** Actualización múltiple iniciada ***', 'avaluo', '', '', '', ''),
(198, '2019-08-25 21:13:17', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', '*** Actualización múltiple exitosa ***', 'avaluo', '', '', '', ''),
(199, '2019-08-25 21:13:42', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', '*** Actualización múltiple iniciada ***', 'avaluo', '', '', '', ''),
(200, '2019-08-25 21:13:43', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', '*** Actualización múltiple exitosa ***', 'avaluo', '', '', '', ''),
(201, '2019-08-25 21:14:34', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', '*** Actualización múltiple iniciada ***', 'avaluo', '', '', '', ''),
(202, '2019-08-25 21:14:35', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', '*** Actualización múltiple exitosa ***', 'avaluo', '', '', '', ''),
(203, '2019-08-25 21:15:06', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', '*** Actualización múltiple iniciada ***', 'avaluo', '', '', '', ''),
(204, '2019-08-25 21:15:06', '/invercon/avaluoupdate.php', 'eprep.test05@yahoo.com', '*** Actualización múltiple exitosa ***', 'avaluo', '', '', '', ''),
(205, '2019-08-25 21:41:51', '/invercon/logout.php', 'eprep.test05@yahoo.com', 'Cierra sesión', '::1', '', '', '', ''),
(206, '2019-08-25 21:42:06', '/invercon/login.php', 'Luke.Skywalker.Force01@gmail.com', 'Inicia sesión', '::1', '', '', '', ''),
(207, '2019-08-25 23:46:19', '/invercon/logout.php', 'Luke.Skywalker.Force01@gmail.com', 'Cierra sesión', '::1', '', '', '', ''),
(208, '2019-08-25 23:46:34', '/invercon/login.php', 'Luke.Skywalker.Force01@gmail.com', 'Inicia sesión', '::1', '', '', '', ''),
(209, '2019-08-26 01:14:28', '/invercon/logout.php', 'Luke.Skywalker.Force01@gmail.com', 'Cierra sesión', '::1', '', '', '', ''),
(210, '2019-08-26 01:14:41', '/invercon/login.php', 'Luke.Skywalker.Force01@gmail.com', 'Inicia sesión', '::1', '', '', '', ''),
(211, '2019-08-26 01:26:40', '/invercon/logout.php', 'Luke.Skywalker.Force01@gmail.com', 'Cierra sesión', '::1', '', '', '', ''),
(212, '2019-08-26 01:26:56', '/invercon/login.php', 'eprep.test05@yahoo.com', 'Inicia sesión', '::1', '', '', '', ''),
(213, '2019-08-26 01:27:30', '/invercon/logout.php', 'eprep.test05@yahoo.com', 'Cierra sesión', '::1', '', '', '', ''),
(214, '2019-08-26 01:27:39', '/invercon/login.php', 'admin', 'Inicia sesión', '::1', '', '', '', ''),
(215, '2019-08-26 01:29:39', '/invercon/logout.php', 'Administrador', 'Cierra sesión', '::1', '', '', '', ''),
(216, '2019-08-26 01:29:50', '/invercon/login.php', 'Luke.Skywalker.Force01@gmail.com', 'Inicia sesión', '::1', '', '', '', ''),
(217, '2019-08-26 01:35:16', '/invercon/logout.php', 'Luke.Skywalker.Force01@gmail.com', 'Cierra sesión', '::1', '', '', '', ''),
(218, '2019-08-26 01:35:37', '/invercon/login.php', 'eprep.test01@yahoo.com', 'Inicia sesión', '::1', '', '', '', ''),
(219, '2019-08-26 02:19:27', '/invercon/logout.php', 'eprep.test01@yahoo.com', 'Cierra sesión', '::1', '', '', '', ''),
(220, '2019-08-26 02:20:03', '/invercon/login.php', 'Luke.Skywalker.Force01@gmail.com', 'Inicia sesión', '::1', '', '', '', ''),
(221, '2019-08-26 02:30:14', '/invercon/logout.php', 'Luke.Skywalker.Force01@gmail.com', 'Cierra sesión', '::1', '', '', '', ''),
(222, '2019-08-26 02:30:34', '/invercon/login.php', 'Luke.Skywalker.Force01@gmail.com', 'Inicia sesión', '::1', '', '', '', ''),
(223, '2019-08-26 02:39:17', '/invercon/logout.php', 'Luke.Skywalker.Force01@gmail.com', 'Cierra sesión', '::1', '', '', '', ''),
(224, '2019-08-26 02:39:32', '/invercon/login.php', 'Luke.Skywalker.Force01@gmail.com', 'Inicia sesión', '::1', '', '', '', ''),
(225, '2019-08-26 18:57:12', '/invercon/login.php', 'Luke.Skywalker.Force01@gmail.com', 'Inicia sesión', '::1', '', '', '', ''),
(226, '2019-08-26 21:39:51', '/invercon/logout.php', 'Luke.Skywalker.Force01@gmail.com', 'Cierra sesión', '::1', '', '', '', ''),
(227, '2019-08-26 21:40:04', '/invercon/login.php', 'admin', 'Inicia sesión', '::1', '', '', '', ''),
(228, '2019-08-26 21:41:47', '/invercon/logout.php', 'Administrador', 'Cierra sesión', '::1', '', '', '', ''),
(229, '2019-08-26 21:42:16', '/invercon/login.php', 'amy.winehouse.Testeprep@gmail.com', 'Inicia sesión', '::1', '', '', '', ''),
(230, '2019-08-26 21:42:51', '/invercon/logout.php', 'amy.winehouse.Testeprep@gmail.com', 'Cierra sesión', '::1', '', '', '', ''),
(231, '2019-08-26 21:42:58', '/invercon/login.php', 'admin', 'Inicia sesión', '::1', '', '', '', ''),
(232, '2019-08-26 21:45:36', '/invercon/logout.php', 'Administrador', 'Cierra sesión', '::1', '', '', '', ''),
(233, '2019-08-26 21:45:59', '/invercon/login.php', 'amy.winehouse.Testeprep@gmail.com', 'Inicia sesión', '::1', '', '', '', ''),
(234, '2019-08-26 21:46:56', '/invercon/logout.php', 'amy.winehouse.Testeprep@gmail.com', 'Cierra sesión', '::1', '', '', '', ''),
(235, '2019-08-27 13:21:43', '/invercon/login.php', 'carlos.gerd.claros.orellana@gmx.es', 'Inicia sesión', '::1', '', '', '', ''),
(236, '2019-08-27 14:17:59', '/invercon/logout.php', 'carlos.gerd.claros.orellana@gmx.es', 'Cierra sesión', '::1', '', '', '', ''),
(237, '2019-08-27 14:18:28', '/invercon/login.php', 'eprep.test05@yahoo.com', 'Inicia sesión', '::1', '', '', '', ''),
(238, '2019-08-27 14:19:40', '/invercon/logout.php', 'eprep.test05@yahoo.com', 'Cierra sesión', '::1', '', '', '', ''),
(239, '2019-08-27 14:19:53', '/invercon/login.php', 'admin', 'Inicia sesión', '::1', '', '', '', ''),
(240, '2019-08-27 14:20:36', '/invercon/logout.php', 'Administrador', 'Cierra sesión', '::1', '', '', '', ''),
(241, '2019-08-27 14:20:44', '/invercon/login.php', 'carlos.gerd.claros.orellana@gmx.es', 'Inicia sesión', '::1', '', '', '', ''),
(242, '2019-08-27 14:48:53', '/invercon/logout.php', 'carlos.gerd.claros.orellana@gmx.es', 'Cierra sesión', '::1', '', '', '', ''),
(243, '2019-08-27 14:49:02', '/invercon/login.php', 'admin', 'Inicia sesión', '::1', '', '', '', ''),
(244, '2019-08-27 14:49:29', '/invercon/logout.php', 'Administrador', 'Cierra sesión', '::1', '', '', '', ''),
(245, '2019-08-27 14:49:40', '/invercon/login.php', 'carlos.gerd.claros.orellana@gmx.es', 'Inicia sesión', '::1', '', '', '', ''),
(246, '2019-08-27 17:40:06', '/invercon/logout.php', 'carlos.gerd.claros.orellana@gmx.es', 'Cierra sesión', '::1', '', '', '', ''),
(247, '2019-08-27 17:40:12', '/invercon/login.php', 'admin', 'Inicia sesión', '::1', '', '', '', ''),
(248, '2019-08-27 17:40:42', '/invercon/logout.php', 'Administrador', 'Cierra sesión', '::1', '', '', '', ''),
(249, '2019-08-27 17:40:56', '/invercon/login.php', 'carlos.gerd.claros.orellana@gmx.es', 'Inicia sesión', '::1', '', '', '', ''),
(250, '2019-08-28 14:05:15', '/invercon/login.php', 'eprep.test05@yahoo.com', 'Inicia sesión', '::1', '', '', '', ''),
(251, '2019-08-28 14:07:33', '/invercon/logout.php', 'eprep.test05@yahoo.com', 'Cierra sesión', '::1', '', '', '', ''),
(252, '2019-08-28 14:07:45', '/invercon/login.php', 'admin', 'Inicia sesión', '::1', '', '', '', ''),
(253, '2019-08-28 14:20:08', '/invercon/logout.php', 'Administrador', 'Cierra sesión', '::1', '', '', '', ''),
(254, '2019-08-28 14:20:14', '/invercon/login.php', 'carlos.gerd.claros.orellana@gmx.es', 'Inicia sesión', '::1', '', '', '', ''),
(255, '2019-08-28 14:44:06', '/invercon/logout.php', 'carlos.gerd.claros.orellana@gmx.es', 'Cierra sesión', '::1', '', '', '', ''),
(256, '2019-08-28 14:44:12', '/invercon/login.php', 'admin', 'Inicia sesión', '::1', '', '', '', ''),
(257, '2019-08-28 15:00:10', '/invercon/logout.php', 'Administrador', 'Cierra sesión', '::1', '', '', '', ''),
(258, '2019-08-28 15:02:09', '/invercon/login.php', 'eprep.test05@yahoo.com', 'Inicia sesión', '::1', '', '', '', ''),
(259, '2019-08-28 15:15:24', '/invercon/logout.php', 'eprep.test05@yahoo.com', 'Cierra sesión', '::1', '', '', '', ''),
(260, '2019-08-28 15:18:07', '/invercon/login.php', 'carlos.gerd.claros.orellana@gmx.es', 'Inicia sesión', '::1', '', '', '', ''),
(261, '2019-08-28 15:18:52', '/invercon/logout.php', 'carlos.gerd.claros.orellana@gmx.es', 'Cierra sesión', '::1', '', '', '', ''),
(262, '2019-08-28 15:18:57', '/invercon/login.php', 'admin', 'Inicia sesión', '::1', '', '', '', ''),
(263, '2019-08-28 15:38:21', '/invercon/logout.php', 'Administrador', 'Cierra sesión', '::1', '', '', '', ''),
(264, '2019-08-28 15:38:31', '/invercon/login.php', 'eprep.test05@yahoo.com', 'Inicia sesión', '::1', '', '', '', ''),
(265, '2019-08-28 19:58:44', '/invercon/logout.php', 'eprep.test05@yahoo.com', 'Cierra sesión', '::1', '', '', '', ''),
(266, '2019-08-28 22:26:43', '/invercon/login.php', 'admin', 'Inicia sesión', '190.181.51.196', '', '', '', ''),
(267, '2019-08-28 22:27:02', '/invercon/logout.php', 'Administrador', 'Cierra sesión', '190.181.51.196', '', '', '', ''),
(268, '2019-08-29 02:20:57', '/invercon/login.php', 'richard.gecko01test@gmail.com', 'Inicia sesión', '181.114.89.161', '', '', '', ''),
(269, '2019-09-08 00:52:28', '/invercon/login.php', 'amy.winehouse.Testeprep@gmail.com', 'Inicia sesión', '181.177.171.228', '', '', '', ''),
(270, '2019-09-08 00:55:25', '/invercon/login.php', 'emaraz@invercon-sgv.com', 'Inicia sesión', '181.177.171.228', '', '', '', ''),
(271, '2019-09-08 01:06:28', '/invercon/logout.php', 'amy.winehouse.Testeprep@gmail.com', 'Cierra sesión', '181.177.171.228', '', '', '', ''),
(272, '2019-09-08 01:06:35', '/invercon/login.php', 'admin', 'Inicia sesión', '181.177.171.228', '', '', '', ''),
(273, '2019-09-08 01:12:33', '/invercon/logout.php', 'Administrador', 'Cierra sesión', '181.177.171.228', '', '', '', ''),
(274, '2019-09-08 01:12:44', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', '*** Actualización múltiple iniciada ***', 'avaluo', '', '', '', ''),
(275, '2019-09-08 01:12:44', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'codigoavaluo', '1', NULL, '16000'),
(276, '2019-09-08 01:12:44', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'id_inspector', '1', NULL, 'mrivera@invercon-sgv.com'),
(277, '2019-09-08 01:12:44', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'fecha_avaluo', '1', NULL, '2019-09-13 12:50:00'),
(278, '2019-09-08 01:12:44', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'estado', '1', '1', '2'),
(279, '2019-09-08 01:12:44', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'estadointerno', '1', '1', '2'),
(280, '2019-09-08 01:12:45', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'codigoavaluo', '2', NULL, '16000'),
(281, '2019-09-08 01:12:45', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'id_inspector', '2', NULL, 'mrivera@invercon-sgv.com'),
(282, '2019-09-08 01:12:45', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'fecha_avaluo', '2', NULL, '2019-09-13 12:50:00'),
(283, '2019-09-08 01:12:45', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'estado', '2', '1', '2'),
(284, '2019-09-08 01:12:45', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'estadointerno', '2', '1', '2'),
(285, '2019-09-08 01:12:45', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', '*** Actualización múltiple exitosa ***', 'avaluo', '', '', '', ''),
(286, '2019-09-08 01:14:51', '/invercon/login.php', 'mrivera@invercon-sgv.com', 'Inicia sesión', '181.177.171.228', '', '', '', ''),
(287, '2019-09-08 01:26:35', '/invercon/logout.php', 'emaraz@invercon-sgv.com', 'Cierra sesión', '181.177.171.228', '', '', '', ''),
(288, '2019-09-08 01:28:03', '/invercon/login.php', 'fclaros@invercon-sgv.com', 'Inicia sesión', '181.177.171.228', '', '', '', ''),
(289, '2019-09-08 01:31:52', '/invercon/logout.php', 'mrivera@invercon-sgv.com', 'Cierra sesión', '181.177.171.228', '', '', '', ''),
(290, '2019-09-08 01:32:01', '/invercon/login.php', 'amy.winehouse.Testeprep@gmail.com', 'Inicia sesión', '181.177.171.228', '', '', '', ''),
(291, '2019-09-08 01:34:45', '/invercon/logout.php', 'amy.winehouse.Testeprep@gmail.com', 'Cierra sesión', '181.177.171.228', '', '', '', ''),
(292, '2019-09-08 01:35:01', '/invercon/login.php', 'emaraz@invercon-sgv.com', 'Inicia sesión', '181.177.171.228', '', '', '', ''),
(293, '2019-09-21 02:17:34', '/invercon/login.php', 'eprep.test05@yahoo.com', 'Inicia sesión', '181.177.171.228', '', '', '', ''),
(294, '2019-09-21 02:22:19', '/invercon/login.php', 'emaraz@invercon-sgv.com', 'Inicia sesión', '181.177.171.228', '', '', '', ''),
(295, '2019-09-21 03:12:11', '/invercon/login.php', 'eprep.test05@yahoo.com', 'Inicia sesión', '181.177.171.228', '', '', '', ''),
(296, '2019-09-21 03:12:56', '/invercon/login.php', 'emaraz@invercon-sgv.com', 'Inicia sesión', '181.177.171.228', '', '', '', ''),
(297, '2019-09-24 20:09:08', '/invercon/login.php', 'eprep.test01@yahoo.com', 'Inicia sesión', '190.181.51.196', '', '', '', ''),
(298, '2019-09-24 20:14:32', '/invercon/logout.php', 'eprep.test01@yahoo.com', 'Cierra sesión', '190.181.51.196', '', '', '', ''),
(299, '2019-09-24 20:14:41', '/invercon/login.php', 'emaraz@invercon-sgv.com', 'Inicia sesión', '190.181.51.196', '', '', '', ''),
(300, '2019-09-24 20:45:41', '/invercon/login.php', 'fclaros@invercon-sgv.com', 'Ingreso Automático', '190.181.53.60', '', '', '', ''),
(301, '2019-09-24 20:46:30', '/invercon/logout.php', 'fclaros@invercon-sgv.com', 'Cierra sesión', '190.181.53.60', '', '', '', ''),
(302, '2019-09-24 20:49:50', '/invercon/login.php', 'richard.gecko01test@gmail.com', 'Inicia sesión', '190.181.53.60', '', '', '', ''),
(303, '2019-09-24 20:58:05', '/invercon/login.php', 'emaraz@invercon-sgv.com', 'Inicia sesión', '190.181.53.60', '', '', '', ''),
(304, '2019-09-24 21:20:35', '/invercon/avaluoadd.php', 'emaraz@invercon-sgv.com', 'A', 'avaluo', 'tipoinmueble', '3', '', 'AUTO'),
(305, '2019-09-24 21:20:35', '/invercon/avaluoadd.php', 'emaraz@invercon-sgv.com', 'A', 'avaluo', 'id_solicitud', '3', '', '2'),
(306, '2019-09-24 21:20:35', '/invercon/avaluoadd.php', 'emaraz@invercon-sgv.com', 'A', 'avaluo', 'id_oficialcredito', '3', '', 'eprep.test05@yahoo.com'),
(307, '2019-09-24 21:20:35', '/invercon/avaluoadd.php', 'emaraz@invercon-sgv.com', 'A', 'avaluo', 'id', '3', '', '3'),
(308, '2019-09-24 21:34:07', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', '*** Actualización múltiple iniciada ***', 'avaluo', '', '', '', ''),
(309, '2019-09-24 21:34:07', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'codigoavaluo', '1', NULL, '1234'),
(310, '2019-09-24 21:34:07', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'id_oficialcredito', '1', 'richard.gecko01test@gmail.com', 'Luke.Skywalker.Force01@gmail.com'),
(311, '2019-09-24 21:34:07', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'id_inspector', '1', NULL, 'rvelasco@invercon-sgv.com'),
(312, '2019-09-24 21:34:07', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'fecha_avaluo', '1', NULL, '2019-09-19 17:33:35'),
(313, '2019-09-24 21:34:07', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'estado', '1', '1', '2'),
(314, '2019-09-24 21:34:07', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'estadointerno', '1', '1', '2'),
(315, '2019-09-24 21:34:07', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'codigoavaluo', '2', NULL, '1234'),
(316, '2019-09-24 21:34:07', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'id_oficialcredito', '2', 'richard.gecko01test@gmail.com', 'Luke.Skywalker.Force01@gmail.com'),
(317, '2019-09-24 21:34:07', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'id_inspector', '2', NULL, 'rvelasco@invercon-sgv.com'),
(318, '2019-09-24 21:34:07', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'fecha_avaluo', '2', NULL, '2019-09-19 17:33:35'),
(319, '2019-09-24 21:34:07', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'estado', '2', '1', '2'),
(320, '2019-09-24 21:34:07', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'estadointerno', '2', '1', '2'),
(321, '2019-09-24 21:34:07', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'codigoavaluo', '3', NULL, '1234'),
(322, '2019-09-24 21:34:07', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'id_oficialcredito', '3', 'eprep.test05@yahoo.com', 'Luke.Skywalker.Force01@gmail.com'),
(323, '2019-09-24 21:34:07', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'id_inspector', '3', NULL, 'rvelasco@invercon-sgv.com'),
(324, '2019-09-24 21:34:07', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'fecha_avaluo', '3', NULL, '2019-09-19 17:33:35'),
(325, '2019-09-24 21:34:07', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'estado', '3', '1', '2'),
(326, '2019-09-24 21:34:07', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'estadointerno', '3', '1', '2'),
(327, '2019-09-24 21:34:07', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'codigoavaluo', '4', NULL, '1234'),
(328, '2019-09-24 21:34:07', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'id_oficialcredito', '4', 'richard.gecko01test@gmail.com', 'Luke.Skywalker.Force01@gmail.com'),
(329, '2019-09-24 21:34:07', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'id_inspector', '4', NULL, 'rvelasco@invercon-sgv.com'),
(330, '2019-09-24 21:34:07', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'fecha_avaluo', '4', NULL, '2019-09-19 17:33:35'),
(331, '2019-09-24 21:34:07', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'estado', '4', '1', '2'),
(332, '2019-09-24 21:34:07', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'estadointerno', '4', '1', '2'),
(333, '2019-09-24 21:34:08', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', '*** Actualización múltiple exitosa ***', 'avaluo', '', '', '', ''),
(334, '2019-09-24 21:35:58', '/invercon/login.php', 'rvelasco@invercon-sgv.com', 'Inicia sesión', '190.181.53.60', '', '', '', ''),
(335, '2019-09-24 21:45:50', '/invercon/login.php', 'fclaros@invercon-sgv.com', 'Inicia sesión', '190.181.53.60', '', '', '', ''),
(336, '2019-09-24 21:47:08', '/invercon/avaluoupdate.php', 'fclaros@invercon-sgv.com', '*** Actualización múltiple iniciada ***', 'avaluo', '', '', '', ''),
(337, '2019-09-24 21:47:08', '/invercon/avaluoupdate.php', 'fclaros@invercon-sgv.com', '*** Actualización múltiple exitosa ***', 'avaluo', '', '', '', ''),
(338, '2019-09-24 21:55:16', '/invercon/logout.php', 'fclaros@invercon-sgv.com', 'Cierra sesión', '190.181.53.60', '', '', '', ''),
(339, '2019-09-24 21:55:21', '/invercon/login.php', 'admin', 'Inicia sesión', '190.181.53.60', '', '', '', ''),
(340, '2019-09-24 21:56:43', '/invercon/logout.php', 'Administrador', 'Cierra sesión', '190.181.53.60', '', '', '', ''),
(341, '2019-09-24 21:56:48', '/invercon/login.php', 'fclaros@invercon-sgv.com', 'Inicia sesión', '190.181.53.60', '', '', '', ''),
(342, '2019-12-07 14:26:32', '/invercon/login.php', 'richard.gecko01test@gmail.com', 'Inicia sesión', '181.114.66.62', '', '', '', ''),
(343, '2019-12-09 02:58:07', '/invercon/login.php', 'richard.gecko01test@gmail.com', 'Inicia sesión', '181.114.66.62', '', '', '', ''),
(344, '2019-12-09 16:42:49', '/invercon/login.php', 'richard.gecko01test@yahoo.com', 'Inicia sesión', '190.181.51.196', '', '', '', ''),
(345, '2019-12-09 17:41:10', '/invercon/logout.php', '-1', 'Cierra sesión', '190.181.51.196', '', '', '', ''),
(346, '2019-12-09 17:41:18', '/invercon/login.php', 'emaraz@invercon-sgv.com', 'Inicia sesión', '190.181.51.196', '', '', '', ''),
(347, '2019-12-15 13:18:49', '/invercon/login.php', 'carlos.gerd.claros.orellana@gmx.es', 'Inicia sesión', '181.114.66.62', '', '', '', ''),
(348, '2019-12-15 13:21:11', '/invercon/login.php', 'emaraz@invercon-sgv.com', 'Inicia sesión', '181.114.66.62', '', '', '', ''),
(349, '2019-12-15 14:47:06', '/invercon/login.php', 'emaraz@invercon-sgv.com', 'Inicia sesión', '181.114.66.62', '', '', '', ''),
(350, '2019-12-15 15:05:33', '/invercon/logout.php', 'carlos.gerd.claros.orellana@gmx.es', 'Cierra sesión', '181.114.66.62', '', '', '', ''),
(351, '2019-12-15 15:05:36', '/invercon/login.php', 'carlos.gerd.claros.orellana@gmx.es', 'Inicia sesión', '181.114.66.62', '', '', '', ''),
(352, '2019-12-15 15:48:49', '/invercon/login.php', 'carlos.gerd.claros.orellana@gmx.es', 'Inicia sesión', '181.114.66.62', '', '', '', ''),
(353, '2019-12-15 16:20:08', '/invercon/login.php', 'emaraz@invercon-sgv.com', 'Inicia sesión', '181.114.66.62', '', '', '', ''),
(354, '2019-12-15 16:50:53', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', '*** Actualización múltiple iniciada ***', 'avaluo', '', '', '', ''),
(355, '2019-12-15 16:50:53', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'codigoavaluo', '1', NULL, '222222'),
(356, '2019-12-15 16:50:53', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'id_inspector', '1', NULL, 'rmendoza@invercon-sgv.com'),
(357, '2019-12-15 16:50:53', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'fecha_avaluo', '1', NULL, '2019-12-15 07:30:35'),
(358, '2019-12-15 16:50:53', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'estado', '1', '1', '2'),
(359, '2019-12-15 16:50:53', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'estadointerno', '1', '1', '2'),
(360, '2019-12-15 16:50:53', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'codigoavaluo', '2', NULL, '222222'),
(361, '2019-12-15 16:50:53', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'id_inspector', '2', NULL, 'rmendoza@invercon-sgv.com'),
(362, '2019-12-15 16:50:53', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'fecha_avaluo', '2', NULL, '2019-12-15 07:30:35'),
(363, '2019-12-15 16:50:53', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'estado', '2', '1', '2'),
(364, '2019-12-15 16:50:53', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'estadointerno', '2', '1', '2'),
(365, '2019-12-15 16:50:53', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', '*** Actualización múltiple exitosa ***', 'avaluo', '', '', '', ''),
(366, '2019-12-15 17:09:35', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', '*** Actualización múltiple iniciada ***', 'avaluo', '', '', '', ''),
(367, '2019-12-15 17:09:35', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'codigoavaluo', '1', NULL, '11111'),
(368, '2019-12-15 17:09:35', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'id_inspector', '1', NULL, 'respindola@invercon-sgv.com'),
(369, '2019-12-15 17:09:35', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'fecha_avaluo', '1', NULL, '2019-12-05 13:09:50'),
(370, '2019-12-15 17:09:35', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'estado', '1', '1', '2'),
(371, '2019-12-15 17:09:35', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'estadointerno', '1', '1', '2'),
(372, '2019-12-15 17:09:35', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'codigoavaluo', '2', NULL, '11111'),
(373, '2019-12-15 17:09:35', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'id_inspector', '2', NULL, 'respindola@invercon-sgv.com'),
(374, '2019-12-15 17:09:35', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'fecha_avaluo', '2', NULL, '2019-12-05 13:09:50'),
(375, '2019-12-15 17:09:35', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'estado', '2', '1', '2'),
(376, '2019-12-15 17:09:35', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'estadointerno', '2', '1', '2');
INSERT INTO `audittrail` (`id`, `datetime`, `script`, `user`, `action`, `table`, `field`, `keyvalue`, `oldvalue`, `newvalue`) VALUES
(377, '2019-12-15 17:09:36', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', '*** Actualización múltiple exitosa ***', 'avaluo', '', '', '', ''),
(378, '2019-12-15 17:10:46', '/invercon/logout.php', 'emaraz@invercon-sgv.com', 'Cierra sesión', '181.114.66.62', '', '', '', ''),
(379, '2019-12-15 17:13:06', '/invercon/login.php', 'emaraz@invercon-sgv.com', 'Inicia sesión', '181.114.66.62', '', '', '', ''),
(380, '2019-12-15 17:14:03', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', '*** Actualización múltiple iniciada ***', 'avaluo', '', '', '', ''),
(381, '2019-12-15 17:14:03', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'codigoavaluo', '1', NULL, '1111'),
(382, '2019-12-15 17:14:03', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'id_inspector', '1', NULL, 'rmendoza@invercon-sgv.com'),
(383, '2019-12-15 17:14:03', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'fecha_avaluo', '1', NULL, '2019-12-13 13:14:06'),
(384, '2019-12-15 17:14:03', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'estado', '1', '1', '2'),
(385, '2019-12-15 17:14:03', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'estadointerno', '1', '1', '2'),
(386, '2019-12-15 17:14:03', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'codigoavaluo', '2', NULL, '1111'),
(387, '2019-12-15 17:14:03', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'id_inspector', '2', NULL, 'rmendoza@invercon-sgv.com'),
(388, '2019-12-15 17:14:03', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'fecha_avaluo', '2', NULL, '2019-12-13 13:14:06'),
(389, '2019-12-15 17:14:03', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'estado', '2', '1', '2'),
(390, '2019-12-15 17:14:03', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'estadointerno', '2', '1', '2'),
(391, '2019-12-15 17:14:03', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', '*** Actualización múltiple exitosa ***', 'avaluo', '', '', '', ''),
(392, '2019-12-15 17:14:25', '/invercon/logout.php', 'emaraz@invercon-sgv.com', 'Cierra sesión', '181.114.66.62', '', '', '', ''),
(393, '2019-12-15 17:20:31', '/invercon/login.php', 'emaraz@invercon-sgv.com', 'Inicia sesión', '181.114.66.62', '', '', '', ''),
(394, '2019-12-15 17:30:17', '/invercon/login.php', 'rmendoza@invercon-sgv.com', 'Inicia sesión', '181.114.66.62', '', '', '', ''),
(395, '2019-12-15 17:41:48', '/invercon/logout.php', 'emaraz@invercon-sgv.com', 'Cierra sesión', '181.114.66.62', '', '', '', ''),
(396, '2019-12-15 17:42:46', '/invercon/logout.php', 'rmendoza@invercon-sgv.com', 'Cierra sesión', '181.114.66.62', '', '', '', ''),
(397, '2019-12-15 17:42:50', '/invercon/login.php', 'fclaros@invercon-sgv.com', 'Inicia sesión', '181.114.66.62', '', '', '', ''),
(398, '2019-12-15 17:54:12', '/invercon/login.php', 'emaraz@invercon-sgv.com', 'Inicia sesión', '181.114.66.62', '', '', '', ''),
(399, '2019-12-15 19:44:29', '/invercon/login.php', 'carlos.gerd.claros.orellana@gmx.es', 'login', '181.114.66.62', '', '', '', ''),
(400, '2019-12-15 19:46:29', '/invercon/login.php', 'emaraz@invercon-sgv.com', 'login', '181.114.66.62', '', '', '', ''),
(401, '2019-12-15 20:06:38', '/invercon/login.php', 'fclaros@invercon-sgv.com', 'login', '181.188.162.73', '', '', '', ''),
(402, '2019-12-15 20:19:56', '/invercon/logout.php', 'carlos.gerd.claros.orellana@gmx.es', 'logout', '181.114.66.62', '', '', '', ''),
(403, '2019-12-15 20:21:16', '/invercon/logout.php', 'fclaros@invercon-sgv.com', 'logout', '181.188.162.73', '', '', '', ''),
(404, '2019-12-15 20:22:49', '/invercon/login.php', 'carlos.gerd.claros.orellana@gmx.es', 'login', '181.114.66.62', '', '', '', ''),
(405, '2019-12-15 20:23:53', '/invercon/logout.php', 'emaraz@invercon-sgv.com', 'logout', '181.114.66.62', '', '', '', ''),
(406, '2019-12-15 20:24:46', '/invercon/login.php', 'emaraz@invercon-sgv.com', 'login', '181.114.66.62', '', '', '', ''),
(407, '2019-12-15 20:38:56', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', '*** Batch update begin ***', 'avaluo', '', '', '', ''),
(408, '2019-12-15 20:38:56', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'codigoavaluo', '1', NULL, '11111'),
(409, '2019-12-15 20:38:56', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'id_inspector', '1', NULL, 'rmendoza@invercon-sgv.com'),
(410, '2019-12-15 20:38:56', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'fecha_avaluo', '1', NULL, '2019-12-15 16:43:15'),
(411, '2019-12-15 20:38:56', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'estado', '1', '1', '2'),
(412, '2019-12-15 20:38:56', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'estadointerno', '1', '1', '2'),
(413, '2019-12-15 20:38:56', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'codigoavaluo', '2', NULL, '11111'),
(414, '2019-12-15 20:38:56', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'id_inspector', '2', NULL, 'rmendoza@invercon-sgv.com'),
(415, '2019-12-15 20:38:56', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'fecha_avaluo', '2', NULL, '2019-12-15 16:43:15'),
(416, '2019-12-15 20:38:56', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'estado', '2', '1', '2'),
(417, '2019-12-15 20:38:56', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'estadointerno', '2', '1', '2'),
(418, '2019-12-15 20:38:56', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', '*** Batch update successful ***', 'avaluo', '', '', '', ''),
(419, '2019-12-15 20:42:18', '/invercon/logout.php', 'carlos.gerd.claros.orellana@gmx.es', 'logout', '181.114.66.62', '', '', '', ''),
(420, '2019-12-15 20:42:59', '/invercon/login.php', 'rmendoza@invercon-sgv.com', 'login', '181.114.66.62', '', '', '', ''),
(421, '2019-12-15 20:45:19', '/invercon/login.php', 'fclaros@invercon-sgv.com', 'login', '181.188.162.73', '', '', '', ''),
(422, '2019-12-15 20:45:36', '/invercon/logout.php', 'rmendoza@invercon-sgv.com', 'logout', '181.114.66.62', '', '', '', ''),
(423, '2019-12-15 20:45:54', '/invercon/login.php', 'fclaros@invercon-sgv.com', 'login', '181.114.66.62', '', '', '', ''),
(424, '2019-12-15 20:47:50', '/invercon/logout.php', 'fclaros@invercon-sgv.com', 'logout', '181.114.66.62', '', '', '', ''),
(425, '2019-12-15 20:48:54', '/invercon/login.php', 'carlos.gerd.claros.orellana@gmx.es', 'login', '181.114.66.62', '', '', '', ''),
(426, '2019-12-15 20:49:53', '/invercon/logout.php', 'carlos.gerd.claros.orellana@gmx.es', 'logout', '181.114.66.62', '', '', '', ''),
(427, '2019-12-15 20:59:24', '/invercon/login.php', 'carlos.gerd.claros.orellana@gmx.es', 'login', '181.114.66.62', '', '', '', ''),
(428, '2019-12-15 21:18:17', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', '*** Batch update begin ***', 'avaluo', '', '', '', ''),
(429, '2019-12-15 21:18:18', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'codigoavaluo', '3', NULL, '222222'),
(430, '2019-12-15 21:18:18', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'id_inspector', '3', NULL, 'rmendoza@invercon-sgv.com'),
(431, '2019-12-15 21:18:18', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'fecha_avaluo', '3', NULL, '2019-12-24 17:18:32'),
(432, '2019-12-15 21:18:18', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'estado', '3', '1', '2'),
(433, '2019-12-15 21:18:18', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'estadointerno', '3', '1', '2'),
(434, '2019-12-15 21:18:18', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'codigoavaluo', '4', NULL, '222222'),
(435, '2019-12-15 21:18:18', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'id_inspector', '4', NULL, 'rmendoza@invercon-sgv.com'),
(436, '2019-12-15 21:18:18', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'fecha_avaluo', '4', NULL, '2019-12-24 17:18:32'),
(437, '2019-12-15 21:18:18', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'estado', '4', '1', '2'),
(438, '2019-12-15 21:18:18', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'estadointerno', '4', '1', '2'),
(439, '2019-12-15 21:18:18', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'codigoavaluo', '5', NULL, '222222'),
(440, '2019-12-15 21:18:18', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'id_inspector', '5', NULL, 'rmendoza@invercon-sgv.com'),
(441, '2019-12-15 21:18:18', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'fecha_avaluo', '5', NULL, '2019-12-24 17:18:32'),
(442, '2019-12-15 21:18:18', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'estado', '5', '1', '2'),
(443, '2019-12-15 21:18:18', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'estadointerno', '5', '1', '2'),
(444, '2019-12-15 21:18:18', '/invercon/avaluoupdate.php', 'emaraz@invercon-sgv.com', '*** Batch update successful ***', 'avaluo', '', '', '', ''),
(445, '2019-12-15 21:18:44', '/invercon/logout.php', '-1', 'logout', '181.114.66.62', '', '', '', ''),
(446, '2019-12-15 21:19:20', '/invercon/login.php', 'rmendoza@invercon-sgv.com', 'login', '181.114.66.62', '', '', '', ''),
(447, '2019-12-15 21:20:52', '/invercon/logout.php', 'rmendoza@invercon-sgv.com', 'logout', '181.114.66.62', '', '', '', ''),
(448, '2019-12-15 21:21:09', '/invercon/login.php', 'fclaros@invercon-sgv.com', 'login', '181.114.66.62', '', '', '', ''),
(449, '2019-12-15 21:28:12', '/invercon/logout.php', 'carlos.gerd.claros.orellana@gmx.es', 'logout', '181.114.66.62', '', '', '', ''),
(450, '2019-12-15 21:28:17', '/invercon/login.php', 'carlos.gerd.claros.orellana@gmx.es', 'login', '181.114.66.62', '', '', '', ''),
(451, '2019-12-22 15:45:25', '/invercon/login.php', 'emaraz@invercon-sgv.com', 'login', '190.107.60.200', '', '', '', ''),
(452, '2019-12-26 19:03:38', '/invercon/login.php', 'admin', 'login', '190.107.60.200', '', '', '', ''),
(453, '2019-12-26 19:04:20', '/invercon/logout.php', 'Administrator', 'logout', '190.107.60.200', '', '', '', ''),
(454, '2019-12-26 19:19:33', '/invercon/login.php', 'admin', 'login', '190.107.60.200', '', '', '', ''),
(455, '2019-12-26 19:19:35', '/invercon/login.php', 'admin', 'login', '190.107.60.200', '', '', '', ''),
(456, '2019-12-26 19:57:53', '/invercon/logout.php', 'Administrator', 'Cierra sesión', '190.107.60.200', '', '', '', ''),
(457, '2019-12-26 19:57:56', '/invercon/login.php', 'carlos.gerd.claros.orellana@gmx.es', 'Inicia sesión', '190.107.60.200', '', '', '', ''),
(458, '2019-12-26 20:01:12', '/invercon/login.php', 'emaraz@invercon-sgv.com', 'Inicia sesión', '190.107.60.200', '', '', '', ''),
(459, '2019-12-26 20:01:19', '/invercon/login.php', 'fclaros@invercon-sgv.com', 'Inicia sesión', '190.107.60.200', '', '', '', ''),
(460, '2019-12-26 20:10:15', '/invercon/logout.php', 'carlos.gerd.claros.orellana@gmx.es', 'Cierra sesión', '190.107.60.200', '', '', '', ''),
(461, '2019-12-26 20:10:22', '/invercon/login.php', 'admin', 'Inicia sesión', '190.107.60.200', '', '', '', ''),
(462, '2019-12-26 20:11:22', '/invercon/logout.php', 'Administrador', 'Cierra sesión', '190.107.60.200', '', '', '', ''),
(463, '2019-12-26 20:12:06', '/invercon/logout.php', 'emaraz@invercon-sgv.com', 'Cierra sesión', '190.107.60.200', '', '', '', ''),
(464, '2019-12-26 20:12:18', '/invercon/login.php', 'emaraz@invercon-sgv.com', 'Inicia sesión', '190.107.60.200', '', '', '', ''),
(465, '2019-12-26 23:45:13', '/invercon/login.php', 'carlos.gerd.claros.orellana@gmx.es', 'Inicia sesión', '190.107.60.200', '', '', '', ''),
(466, '2019-12-26 23:48:25', '/invercon/logout.php', 'carlos.gerd.claros.orellana@gmx.es', 'Cierra sesión', '190.107.60.200', '', '', '', ''),
(467, '2019-12-26 23:48:39', '/invercon/login.php', 'admin', 'Inicia sesión', '190.107.60.200', '', '', '', ''),
(468, '2019-12-26 23:52:13', '/invercon/logout.php', 'Administrador', 'Cierra sesión', '190.107.60.200', '', '', '', ''),
(469, '2019-12-26 23:52:30', '/invercon/login.php', 'carlos.gerd.claros.orellana@gmx.es', 'Inicia sesión', '190.107.60.200', '', '', '', ''),
(470, '2019-12-27 00:08:26', '/invercon/login.php', 'emaraz@invercon-sgv.com', 'Inicia sesión', '190.107.60.200', '', '', '', ''),
(471, '2019-12-27 00:09:28', '/invercon/login.php', 'emaraz@invercon-sgv.com', 'Inicia sesión', '181.188.162.73', '', '', '', ''),
(472, '2019-12-27 00:18:17', '/invercon/logout.php', 'carlos.gerd.claros.orellana@gmx.es', 'Cierra sesión', '190.107.60.200', '', '', '', ''),
(473, '2019-12-27 00:20:14', '/invercon/login.php', 'moros@invercon-sgv.com', 'Inicia sesión', '190.107.60.200', '', '', '', ''),
(474, '2019-12-27 00:21:50', '/invercon/avaluolist.php', 'moros@invercon-sgv.com', 'U', 'avaluo', 'id_inspector', '8', NULL, 'jlarrazabal@invercon-sgv.com'),
(475, '2019-12-27 00:21:50', '/invercon/avaluolist.php', 'moros@invercon-sgv.com', 'U', 'avaluo', 'fecha_avaluo', '8', NULL, '2019-12-28 20:22:10'),
(476, '2019-12-27 00:21:50', '/invercon/avaluolist.php', 'moros@invercon-sgv.com', 'U', 'avaluo', 'estado', '8', '1', '2'),
(477, '2019-12-27 00:21:50', '/invercon/avaluolist.php', 'moros@invercon-sgv.com', 'U', 'avaluo', 'estadointerno', '8', '1', '2'),
(478, '2019-12-27 00:42:54', '/invercon/avaluolist.php', 'moros@invercon-sgv.com', 'U', 'avaluo', 'codigoavaluo', '6', NULL, '123456'),
(479, '2019-12-27 00:42:54', '/invercon/avaluolist.php', 'moros@invercon-sgv.com', 'U', 'avaluo', 'id_inspector', '6', NULL, 'rmendoza@invercon-sgv.com'),
(480, '2019-12-27 00:42:54', '/invercon/avaluolist.php', 'moros@invercon-sgv.com', 'U', 'avaluo', 'fecha_avaluo', '6', NULL, '2019-12-26 20:43:34'),
(481, '2019-12-27 00:42:54', '/invercon/avaluolist.php', 'moros@invercon-sgv.com', 'U', 'avaluo', 'estado', '6', '1', '2'),
(482, '2019-12-27 00:42:54', '/invercon/avaluolist.php', 'moros@invercon-sgv.com', 'U', 'avaluo', 'estadointerno', '6', '1', '2'),
(483, '2019-12-27 00:43:24', '/invercon/logout.php', 'emaraz@invercon-sgv.com', 'Cierra sesión', '190.107.60.200', '', '', '', ''),
(484, '2019-12-27 00:44:10', '/invercon/logout.php', '-1', 'Cierra sesión', '190.107.60.200', '', '', '', ''),
(485, '2019-12-27 00:44:18', '/invercon/login.php', 'rmendoza@invercon-sgv.com', 'Inicia sesión', '190.107.60.200', '', '', '', ''),
(486, '2019-12-27 00:45:09', '/invercon/logout.php', 'rmendoza@invercon-sgv.com', 'Cierra sesión', '190.107.60.200', '', '', '', ''),
(487, '2019-12-27 00:45:15', '/invercon/login.php', 'fclaros@invercon-sgv.com', 'Inicia sesión', '190.107.60.200', '', '', '', ''),
(488, '2019-12-27 00:47:04', '/invercon/logout.php', 'fclaros@invercon-sgv.com', 'Cierra sesión', '190.107.60.200', '', '', '', ''),
(489, '2019-12-27 00:47:41', '/invercon/login.php', 'emaraz@invercon-sgv.com', 'Inicia sesión', '190.107.60.200', '', '', '', ''),
(490, '2019-12-27 01:25:34', '/invercon/logout.php', 'moros@invercon-sgv.com', 'Cierra sesión', '190.107.60.200', '', '', '', ''),
(491, '2019-12-27 01:25:41', '/invercon/login.php', 'admin', 'Inicia sesión', '190.107.60.200', '', '', '', ''),
(492, '2019-12-27 01:27:23', '/invercon/logout.php', 'Administrador', 'Cierra sesión', '190.107.60.200', '', '', '', ''),
(493, '2019-12-27 01:27:28', '/invercon/login.php', 'carlos.gerd.claros.orellana@gmx.es', 'Inicia sesión', '190.107.60.200', '', '', '', ''),
(494, '2019-12-27 01:30:59', '/invercon/logout.php', 'carlos.gerd.claros.orellana@gmx.es', 'Cierra sesión', '190.107.60.200', '', '', '', ''),
(495, '2019-12-30 23:50:26', '/invercon/login.php', 'carlos.gerd.claros.orellana@gmx.es', 'Inicia sesión', '181.177.174.250', '', '', '', ''),
(496, '2020-01-02 12:13:37', '/invercon/index.php', 'emaraz@invercon-sgv.com', 'Ingreso Automático', '181.188.164.100', '', '', '', ''),
(497, '2020-01-02 13:34:11', '/invercon/login.php', 'carlos.gerd.claros.orellana@gmx.es', 'Inicia sesión', '181.188.164.100', '', '', '', ''),
(498, '2020-01-02 13:58:40', '/invercon/login.php', 'emaraz@invercon-sgv.com', 'Inicia sesión', '181.188.164.100', '', '', '', ''),
(499, '2020-01-02 14:28:02', '/invercon/logout.php', 'emaraz@invercon-sgv.com', 'Cierra sesión', '181.188.164.100', '', '', '', ''),
(500, '2020-01-02 14:28:12', '/invercon/login.php', 'admin', 'Inicia sesión', '181.188.164.100', '', '', '', ''),
(501, '2020-01-02 14:45:54', '/invercon/login.php', 'carlos.gerd.claros.orellana@gmx.es', 'Inicia sesión', '181.188.164.100', '', '', '', ''),
(502, '2020-01-02 14:46:30', '/invercon/logout.php', 'carlos.gerd.claros.orellana@gmx.es', 'Cierra sesión', '181.188.164.100', '', '', '', ''),
(503, '2020-01-02 14:46:45', '/invercon/login.php', 'emaraz@invercon-sgv.com', 'Inicia sesión', '181.188.164.100', '', '', '', ''),
(504, '2020-01-02 19:17:50', '/invercon/login.php', 'carlos.gerd.claros.orellana@gmx.es', 'Inicia sesión', '181.114.111.105', '', '', '', ''),
(505, '2020-01-02 19:17:59', '/invercon/logout.php', 'carlos.gerd.claros.orellana@gmx.es', 'Cierra sesión', '181.114.111.105', '', '', '', ''),
(506, '2020-01-02 19:18:14', '/invercon/login.php', 'emaraz@invercon-sgv.com', 'Inicia sesión', '181.114.111.105', '', '', '', ''),
(507, '2020-01-02 19:19:48', '/invercon/solicitudedit.php', 'emaraz@invercon-sgv.com', '*** Actualización múltiple iniciada ***', 'avaluo', '', '', '', ''),
(508, '2020-01-02 19:19:48', '/invercon/solicitudedit.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'codigoavaluo', '1', NULL, '123'),
(509, '2020-01-02 19:19:48', '/invercon/solicitudedit.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'id_inspector', '1', NULL, 'rmendoza@invercon-sgv.com'),
(510, '2020-01-02 19:19:48', '/invercon/solicitudedit.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'fecha_avaluo', '1', NULL, '2020-01-02 15:19:04'),
(511, '2020-01-02 19:19:48', '/invercon/solicitudedit.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'comentario', '1', NULL, 'xxx'),
(512, '2020-01-02 19:19:48', '/invercon/solicitudedit.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'estado', '1', '1', '2'),
(513, '2020-01-02 19:19:48', '/invercon/solicitudedit.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'estadointerno', '1', '1', '2'),
(514, '2020-01-02 19:19:48', '/invercon/solicitudedit.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'codigoavaluo', '2', NULL, '123'),
(515, '2020-01-02 19:19:48', '/invercon/solicitudedit.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'id_inspector', '2', NULL, 'rmendoza@invercon-sgv.com'),
(516, '2020-01-02 19:19:48', '/invercon/solicitudedit.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'fecha_avaluo', '2', NULL, '2020-01-02 15:19:04'),
(517, '2020-01-02 19:19:48', '/invercon/solicitudedit.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'comentario', '2', NULL, 'cccc'),
(518, '2020-01-02 19:19:48', '/invercon/solicitudedit.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'estado', '2', '1', '2'),
(519, '2020-01-02 19:19:48', '/invercon/solicitudedit.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'estadointerno', '2', '1', '2'),
(520, '2020-01-02 19:19:48', '/invercon/solicitudedit.php', 'emaraz@invercon-sgv.com', '*** Actualización múltiple exitosa ***', 'avaluo', '', '', '', ''),
(521, '2020-01-03 15:54:31', '/invercon/login.php', 'emaraz@invercon-sgv.com', 'Inicia sesión', '181.114.111.62', '', '', '', ''),
(522, '2020-01-03 15:54:32', '/invercon/login.php', 'emaraz@invercon-sgv.com', 'Inicia sesión', '181.114.111.62', '', '', '', ''),
(523, '2020-01-03 15:56:20', '/inverconV1.1.1/logout.php', 'emaraz@invercon-sgv.com', 'Cierra sesión', '181.114.111.62', '', '', '', ''),
(524, '2020-01-03 15:56:36', '/inverconV1.1.1/login.php', 'emaraz@invercon-sgv.com', 'Inicia sesión', '181.114.111.62', '', '', '', ''),
(525, '2020-01-03 15:56:47', '/inverconV1.1.1/login.php', 'emaraz@invercon-sgv.com', 'Inicia sesión', '181.114.111.62', '', '', '', ''),
(526, '2020-01-03 19:56:57', '/inverconV1.1.1/logout.php', '-1', 'Cierra sesión', '181.114.111.62', '', '', '', ''),
(527, '2020-01-03 20:00:41', '/invercon/login.php', 'carlos.gerd.claros.orellana@gmx.es', 'Inicia sesión', '181.114.111.62', '', '', '', ''),
(528, '2020-01-03 20:04:50', '/invercon/logout.php', 'carlos.gerd.claros.orellana@gmx.es', 'Cierra sesión', '181.114.111.62', '', '', '', ''),
(529, '2020-01-03 20:04:57', '/invercon/login.php', 'admin', 'Inicia sesión', '181.114.111.62', '', '', '', ''),
(530, '2020-01-03 20:06:35', '/invercon/logout.php', 'Administrador', 'Cierra sesión', '181.114.111.62', '', '', '', ''),
(531, '2020-01-03 20:06:38', '/invercon/login.php', 'carlos.gerd.claros.orellana@gmx.es', 'Inicia sesión', '181.114.111.62', '', '', '', ''),
(532, '2020-01-03 20:06:44', '/invercon/login.php', 'carlos.gerd.claros.orellana@gmx.es', 'Inicia sesión', '181.114.111.62', '', '', '', ''),
(533, '2020-01-03 20:39:43', '/invercon/logout.php', 'carlos.gerd.claros.orellana@gmx.es', 'Cierra sesión', '181.114.111.62', '', '', '', ''),
(534, '2020-01-03 20:39:59', '/invercon/login.php', 'emaraz@invercon-sgv.com', 'Inicia sesión', '181.114.111.62', '', '', '', ''),
(535, '2020-01-03 20:46:17', '/invercon/avaluolist.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'codigoavaluo', '3', NULL, '123'),
(536, '2020-01-03 20:46:17', '/invercon/avaluolist.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'id_inspector', '3', NULL, 'rmendoza@invercon-sgv.com'),
(537, '2020-01-03 20:46:17', '/invercon/avaluolist.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'fecha_avaluo', '3', NULL, '2020-01-03 16:45:24'),
(538, '2020-01-03 20:46:17', '/invercon/avaluolist.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'comentario', '3', NULL, 'Comentarios secretaria'),
(539, '2020-01-03 20:46:17', '/invercon/avaluolist.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'estado', '3', '1', '2'),
(540, '2020-01-03 20:46:17', '/invercon/avaluolist.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'estadointerno', '3', '1', '2'),
(541, '2020-01-03 20:46:44', '/invercon/logout.php', 'emaraz@invercon-sgv.com', 'Cierra sesión', '181.114.111.62', '', '', '', ''),
(542, '2020-01-03 20:46:54', '/invercon/login.php', 'rmendoza@invercon-sgv.com', 'Inicia sesión', '181.114.111.62', '', '', '', ''),
(543, '2020-01-03 20:49:31', '/invercon/logout.php', 'rmendoza@invercon-sgv.com', 'Cierra sesión', '181.114.111.62', '', '', '', ''),
(544, '2020-01-03 20:49:55', '/invercon/login.php', 'emaraz@invercon-sgv.com', 'Inicia sesión', '181.114.111.62', '', '', '', ''),
(545, '2020-01-03 21:12:57', '/invercon/logout.php', 'emaraz@invercon-sgv.com', 'Cierra sesión', '181.114.111.62', '', '', '', ''),
(546, '2020-01-03 21:16:55', '/invercon/logout.php', '-1', 'Cierra sesión', '181.114.111.62', '', '', '', ''),
(547, '2020-01-03 21:17:19', '/invercon/login.php', 'admin', 'Inicia sesión', '181.114.111.62', '', '', '', ''),
(548, '2020-01-03 21:42:08', '/invercon/logout.php', 'Administrador', 'Cierra sesión', '181.114.111.62', '', '', '', ''),
(549, '2020-01-03 21:42:20', '/invercon/login.php', 'emaraz@invercon-sgv.com', 'Inicia sesión', '181.114.111.62', '', '', '', ''),
(550, '2020-01-03 21:42:33', '/invercon/login.php', 'emaraz@invercon-sgv.com', 'Inicia sesión', '181.114.111.62', '', '', '', ''),
(551, '2020-01-04 19:01:40', '/invercon/login.php', 'rmendoza@invercon-sgv.com', 'Inicia sesión', '181.188.164.100', '', '', '', ''),
(552, '2020-01-04 19:01:43', '/invercon/login.php', 'rmendoza@invercon-sgv.com', 'Inicia sesión', '181.188.164.100', '', '', '', ''),
(553, '2020-01-04 19:01:47', '/invercon/login.php', 'rmendoza@invercon-sgv.com', 'Inicia sesión', '181.188.164.100', '', '', '', ''),
(554, '2020-01-04 19:02:32', '/invercon/logout.php', 'rmendoza@invercon-sgv.com', 'Cierra sesión', '181.188.164.100', '', '', '', ''),
(555, '2020-01-04 19:02:52', '/invercon/login.php', 'emaraz@invercon-sgv.com', 'Inicia sesión', '181.188.164.100', '', '', '', ''),
(556, '2020-01-05 22:27:28', '/invercon/logout.php', 'eprep.test01@yahoo.com', 'Cierra sesión', '::1', '', '', '', ''),
(557, '2020-01-05 22:27:36', '/invercon/login.php', 'admin', 'Inicia sesión', '::1', '', '', '', ''),
(558, '2020-01-05 22:30:45', '/invercon/logout.php', 'Administrador', 'Cierra sesión', '::1', '', '', '', ''),
(559, '2020-01-05 22:30:55', '/invercon/login.php', 'emaraz@invercon-sgv.com', 'Inicia sesión', '::1', '', '', '', ''),
(560, '2020-01-05 22:59:48', '/invercon/logout.php', 'emaraz@invercon-sgv.com', 'Cierra sesión', '::1', '', '', '', ''),
(561, '2020-01-05 22:59:54', '/invercon/login.php', 'admin', 'Inicia sesión', '::1', '', '', '', ''),
(562, '2020-01-05 23:01:08', '/invercon/logout.php', 'Administrador', 'Cierra sesión', '::1', '', '', '', ''),
(563, '2020-01-05 23:01:15', '/invercon/login.php', 'emaraz@invercon-sgv.com', 'Inicia sesión', '::1', '', '', '', ''),
(564, '2020-01-05 23:36:00', '/invercon/avaluolist.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'id_inspector', '1', NULL, 'jlarrazabal@invercon-sgv.com'),
(565, '2020-01-05 23:36:00', '/invercon/avaluolist.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'fecha_avaluo', '1', NULL, '2020-01-05 19:35:10'),
(566, '2020-01-05 23:36:00', '/invercon/avaluolist.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'comentario', '1', NULL, 'INICIO'),
(567, '2020-01-05 23:36:00', '/invercon/avaluolist.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'estado', '1', '1', '2'),
(568, '2020-01-05 23:36:00', '/invercon/avaluolist.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'estadointerno', '1', '1', '2'),
(569, '2020-01-05 23:40:41', '/invercon/logout.php', 'emaraz@invercon-sgv.com', 'Cierra sesión', '::1', '', '', '', ''),
(570, '2020-01-05 23:41:02', '/invercon/login.php', 'amy.winehouse.Testeprep@gmail.com', 'Inicia sesión', '::1', '', '', '', ''),
(571, '2020-01-05 23:42:12', '/invercon/logout.php', 'amy.winehouse.Testeprep@gmail.com', 'Cierra sesión', '::1', '', '', '', ''),
(572, '2020-01-05 23:42:19', '/invercon/login.php', 'emaraz@invercon-sgv.com', 'Inicia sesión', '::1', '', '', '', ''),
(573, '2020-01-05 23:43:36', '/invercon/avaluolist.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'codigoavaluo', '4', NULL, '12345'),
(574, '2020-01-05 23:43:36', '/invercon/avaluolist.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'id_inspector', '4', NULL, 'rmendoza@invercon-sgv.com'),
(575, '2020-01-05 23:43:36', '/invercon/avaluolist.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'fecha_avaluo', '4', NULL, '2020-01-05 19:42:45'),
(576, '2020-01-05 23:43:36', '/invercon/avaluolist.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'comentario', '4', NULL, 'INICIO'),
(577, '2020-01-05 23:43:36', '/invercon/avaluolist.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'estado', '4', '1', '2'),
(578, '2020-01-05 23:43:36', '/invercon/avaluolist.php', 'emaraz@invercon-sgv.com', 'U', 'avaluo', 'estadointerno', '4', '1', '2'),
(579, '2020-01-05 23:44:11', '/invercon/logout.php', 'emaraz@invercon-sgv.com', 'Cierra sesión', '::1', '', '', '', ''),
(580, '2020-01-05 23:44:31', '/invercon/login.php', 'rmendoza@invercon-sgv.com', 'Inicia sesión', '::1', '', '', '', ''),
(581, '2020-01-05 23:44:55', '/invercon/logout.php', 'rmendoza@invercon-sgv.com', 'Cierra sesión', '::1', '', '', '', ''),
(582, '2020-01-05 23:45:05', '/invercon/login.php', 'admin', 'Inicia sesión', '::1', '', '', '', ''),
(583, '2020-01-05 23:46:56', '/invercon/logout.php', 'Administrador', 'Cierra sesión', '::1', '', '', '', ''),
(584, '2020-01-05 23:47:03', '/invercon/login.php', 'rmendoza@invercon-sgv.com', 'Inicia sesión', '::1', '', '', '', ''),
(585, '2020-01-05 23:51:42', '/invercon/logout.php', 'rmendoza@invercon-sgv.com', 'Cierra sesión', '::1', '', '', '', ''),
(586, '2020-01-05 23:52:04', '/invercon/login.php', 'fclaros@invercon-sgv.com', 'Inicia sesión', '::1', '', '', '', ''),
(587, '2020-01-05 23:52:19', '/invercon/logout.php', 'fclaros@invercon-sgv.com', 'Cierra sesión', '::1', '', '', '', ''),
(588, '2020-01-05 23:52:32', '/invercon/login.php', 'admin', 'Inicia sesión', '::1', '', '', '', ''),
(589, '2020-01-05 23:53:51', '/invercon/logout.php', 'Administrador', 'Cierra sesión', '::1', '', '', '', ''),
(590, '2020-01-05 23:53:59', '/invercon/login.php', 'fclaros@invercon-sgv.com', 'Inicia sesión', '::1', '', '', '', ''),
(591, '2020-01-05 23:57:24', '/invercon/logout.php', 'fclaros@invercon-sgv.com', 'Cierra sesión', '::1', '', '', '', ''),
(592, '2020-01-05 23:57:35', '/invercon/login.php', 'emaraz@invercon-sgv.com', 'Inicia sesión', '::1', '', '', '', ''),
(593, '2020-01-28 00:53:29', '/invercon/logout.php', '-1', 'Cierra sesión', '::1', '', '', '', ''),
(594, '2020-01-28 00:53:55', '/invercon/login.php', 'emaraz@invercon-sgv.com', 'Inicia sesión', '::1', '', '', '', ''),
(595, '2020-01-30 00:56:48', '/invercon01/logout.php', 'carlos.gerd.claros.orellana@gmx.es', 'logout', '::1', '', '', '', ''),
(596, '2020-01-30 00:56:56', '/invercon01/login.php', 'admin', 'login', '::1', '', '', '', ''),
(597, '2020-01-30 00:58:33', '/invercon01/logout.php', 'Administrator', 'logout', '::1', '', '', '', ''),
(598, '2020-01-30 00:58:50', '/invercon01/login.php', 'carlos.gerd.claros.orellana@gmx.es', 'login', '::1', '', '', '', ''),
(599, '2020-01-30 01:05:59', '/invercon01/logout.php', 'carlos.gerd.claros.orellana@gmx.es', 'logout', '::1', '', '', '', ''),
(600, '2020-01-30 01:06:06', '/invercon01/login.php', 'rmendoza@invercon-sgv.com', 'login', '::1', '', '', '', ''),
(601, '2020-01-31 03:00:49', '/invercon/logout.php', 'rmendoza@invercon-sgv.com', 'logout', '::1', '', '', '', ''),
(602, '2020-01-31 03:00:58', '/invercon/login.php', 'admin', 'login', '::1', '', '', '', ''),
(603, '2020-01-31 03:03:56', '/invercon/logout.php', 'Administrator', 'logout', '::1', '', '', '', ''),
(604, '2020-01-31 03:04:06', '/invercon/login.php', 'rmendoza@invercon-sgv.com', 'login', '::1', '', '', '', ''),
(605, '2020-01-31 03:04:35', '/invercon/logout.php', 'rmendoza@invercon-sgv.com', 'logout', '::1', '', '', '', ''),
(606, '2020-01-31 03:04:43', '/invercon/login.php', 'rmendoza@invercon-sgv.com', 'login', '::1', '', '', '', ''),
(607, '2020-01-31 03:07:45', '/invercon/logout.php', 'rmendoza@invercon-sgv.com', 'logout', '::1', '', '', '', ''),
(608, '2020-01-31 03:07:52', '/invercon/login.php', 'admin', 'login', '::1', '', '', '', ''),
(609, '2020-01-31 03:07:57', '/invercon/logout.php', 'Administrator', 'logout', '::1', '', '', '', ''),
(610, '2020-01-31 03:08:05', '/invercon/login.php', 'rmendoza@invercon-sgv.com', 'login', '::1', '', '', '', ''),
(611, '2020-01-31 03:08:41', '/invercon/logout.php', 'rmendoza@invercon-sgv.com', 'logout', '::1', '', '', '', ''),
(612, '2020-01-31 03:08:57', '/invercon/login.php', 'eprep.test01@yahoo.com', 'login', '::1', '', '', '', ''),
(613, '2020-01-31 03:09:03', '/invercon/logout.php', 'eprep.test01@yahoo.com', 'logout', '::1', '', '', '', ''),
(614, '2020-01-31 03:09:10', '/invercon/login.php', 'admin', 'login', '::1', '', '', '', ''),
(615, '2020-01-31 03:10:03', '/invercon/logout.php', 'Administrator', 'logout', '::1', '', '', '', ''),
(616, '2020-01-31 03:10:25', '/invercon/login.php', 'rmendoza@invercon-sgv.com', 'login', '::1', '', '', '', ''),
(617, '2020-01-31 03:11:06', '/invercon/logout.php', 'rmendoza@invercon-sgv.com', 'logout', '::1', '', '', '', ''),
(618, '2020-01-31 03:11:13', '/invercon/login.php', 'admin', 'login', '::1', '', '', '', ''),
(619, '2020-01-31 03:17:03', '/invercon/logout.php', 'Administrator', 'logout', '::1', '', '', '', ''),
(620, '2020-01-31 03:17:27', '/invercon/login.php', 'rmendoza@invercon-sgv.com', 'login', '::1', '', '', '', ''),
(621, '2020-01-31 03:23:56', '/invercon/logout.php', 'rmendoza@invercon-sgv.com', 'logout', '::1', '', '', '', ''),
(622, '2020-01-31 03:24:03', '/invercon/login.php', 'admin', 'login', '::1', '', '', '', ''),
(623, '2020-01-31 03:24:33', '/invercon/logout.php', 'Administrator', 'logout', '::1', '', '', '', ''),
(624, '2020-01-31 03:24:54', '/invercon/login.php', 'rmendoza@invercon-sgv.com', 'login', '::1', '', '', '', ''),
(625, '2020-01-31 03:28:03', '/invercon/logout.php', 'rmendoza@invercon-sgv.com', 'logout', '::1', '', '', '', ''),
(626, '2020-01-31 03:28:15', '/invercon/login.php', 'fclaros@invercon-sgv.com', 'login', '::1', '', '', '', ''),
(627, '2020-01-31 03:48:58', '/invercon/logout.php', 'fclaros@invercon-sgv.com', 'logout', '::1', '', '', '', ''),
(628, '2020-01-31 03:49:10', '/invercon/login.php', 'admin', 'login', '::1', '', '', '', ''),
(629, '2020-01-31 03:52:12', '/invercon/logout.php', 'Administrator', 'logout', '::1', '', '', '', ''),
(630, '2020-01-31 03:53:04', '/invercon/login.php', 'fclaros@invercon-sgv.com', 'login', '::1', '', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `avaluo`
--

CREATE TABLE `avaluo` (
  `id` int(11) NOT NULL,
  `tipoinmueble` varchar(255) DEFAULT NULL,
  `codigoavaluo` varchar(50) DEFAULT NULL,
  `id_solicitud` int(11) DEFAULT NULL,
  `id_oficialcredito` varchar(100) DEFAULT NULL,
  `id_inspector` varchar(100) DEFAULT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `estado` tinyint(1) DEFAULT '1',
  `estadointerno` int(15) DEFAULT '1',
  `estadopago` int(11) DEFAULT '1',
  `fecha_avaluo` datetime DEFAULT NULL,
  `montoincial` double DEFAULT '0',
  `id_metodopago` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `DateModified` datetime DEFAULT NULL,
  `DateDeleted` datetime DEFAULT NULL,
  `CreatedBy` varchar(100) DEFAULT NULL,
  `ModifiedBy` varchar(100) DEFAULT NULL,
  `DeletedBy` varchar(100) DEFAULT NULL,
  `id_sucursal` int(11) DEFAULT NULL,
  `informe` blob,
  `monto_pago` double DEFAULT '0',
  `comentario` text,
  `documento_pago` blob
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `avaluo`
--

INSERT INTO `avaluo` (`id`, `tipoinmueble`, `codigoavaluo`, `id_solicitud`, `id_oficialcredito`, `id_inspector`, `id_cliente`, `is_active`, `estado`, `estadointerno`, `estadopago`, `fecha_avaluo`, `montoincial`, `id_metodopago`, `created_at`, `DateModified`, `DateDeleted`, `CreatedBy`, `ModifiedBy`, `DeletedBy`, `id_sucursal`, `informe`, `monto_pago`, `comentario`, `documento_pago`) VALUES
(1, 'Casa', NULL, 1, 'carlos.gerd.claros.orellana@gmx.es', 'jlarrazabal@invercon-sgv.com', 51, 1, 2, 2, 1, '2020-01-05 19:35:10', 0, NULL, '2020-01-03 16:02:11', NULL, NULL, NULL, NULL, NULL, 3, NULL, 0, 'INICIO', NULL),
(2, 'departamento', NULL, 1, 'carlos.gerd.claros.orellana@gmx.es', NULL, 51, 1, 1, 1, 1, NULL, 0, NULL, '2020-01-03 16:02:11', NULL, NULL, NULL, NULL, NULL, 3, NULL, 0, NULL, NULL),
(3, 'Casa', '123', 2, 'carlos.gerd.claros.orellana@gmx.es', 'rmendoza@invercon-sgv.com', 52, 1, 2, 2, 2, '2020-01-03 16:45:24', 10, NULL, '2020-01-03 16:03:15', NULL, NULL, NULL, NULL, NULL, 3, NULL, 10, 'INFORME TERMINADO\r\npor el superisor', NULL),
(4, 'Casa', '12345', 3, 'amy.winehouse.Testeprep@gmail.com', 'rmendoza@invercon-sgv.com', 53, 1, 2, 2, 1, '2020-01-05 19:42:45', 0, NULL, '2020-01-05 19:41:43', NULL, NULL, NULL, NULL, NULL, 3, NULL, 0, 'ACEPTAR', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banco`
--

CREATE TABLE `banco` (
  `id` int(11) NOT NULL,
  `short_name` varchar(100) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `banco`
--

INSERT INTO `banco` (`id`, `short_name`, `name`, `is_active`) VALUES
(1, 'bcp', 'BANCO', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `phone_cell` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id`, `name`, `lastname`, `email`, `address`, `phone`, `phone_cell`, `is_active`, `created_at`) VALUES
(1, 'carlos', 'gerd', 'carlitos.gerd@gmail.com', 'fsdfsf', '24234234', '42342', 1, '2019-08-27 15:02:04'),
(2, 'Dane', 'Safe', 'danesafe@gmail.com', 'fsdfsd``', '23432', '23423234', 1, '0000-00-00 00:00:00'),
(3, 'Dane111', 'Safe', 'danesafe@gmail.com', 'fsdfsd``', '23432', '23423234', 1, '0000-00-00 00:00:00'),
(4, 'dane44', 'Safe', 'danesafe@gmail.com', 'fsdfsd``', '23432', '23423234', 1, '2019-08-28 21:49:35'),
(5, 'Dane555', 'Safe', 'danesafe@gmail.com', 'fsdfsd``', '23432', '23423234', 1, '2019-08-28 23:11:05'),
(6, 'dane55', 'Safe', 'danesafe@gmail.com', 'fsdfsd``', '23432', '23423234', 1, '0000-00-00 00:00:00'),
(7, 'Martin', 'claros', 'carlitos.gerd@gmail.com', '34294772947', '24242', '53453', 1, '2019-09-07 20:53:25'),
(8, 'Juan Pedro', 'HURTADO LOPES', 'carlitosgerd@gmail.com', 'ajsddj', '242342342', '22434234', 1, '2019-09-20 22:18:26'),
(9, 'MARCELO', 'JUAN', 'carlitos.gerd@gmail.com', 'DASDA', '24234234', '42342', 1, '2019-09-20 23:13:34'),
(10, 'JULIO', 'LEON PRADO', 'carlitos.gerd@gmail.com', '4535353', '534534', '34535345', 1, '2019-09-20 23:18:23'),
(11, 'SANTO', 'LAGUNA', 'carlitosgerd@gmail.com', '53454', '53453', '545345', 1, '2019-09-20 23:21:56'),
(12, 'JULIO', 'LEON PRADO', 'carlitos.gerd@gmail.com', '4535353', '534534', '34535345', 1, '2019-09-20 23:35:17'),
(13, 'JULIO', 'LEON PRADO', 'carlitos.gerd@gmail.com', '4535353', '534534', '34535345', 1, '2019-09-20 23:40:47'),
(14, 'dasdasd', 'gerd', 'carlitos.gerd@gmail.com', 'dsdas', '2342342', '42342', 1, '2019-09-24 16:14:17'),
(15, 'Martin', 'Duran', 'carlitos.gerd@gmail.com', '', '4402971', '78414140', 1, '2019-09-24 17:01:01'),
(16, 'mario', 'gmail', 'carlitos.gerd@gmail.com', '34294772947', '7844141', '7844141', 1, '2019-09-24 17:03:13'),
(17, 'fsdfsf', 'fsdf', 'carlitos.gerd@gmail.com', 'erwr', '24234234', '53453', 1, '2019-12-09 16:45:02'),
(18, 'carlos', 'gerd', 'carlitos.gerd@gmail.com', 'fsdfsf', '24234234', '7444544564', 1, '0000-00-00 00:00:00'),
(19, 'Martin', 'marquina', 'carlitos.gerd@gmail.com', '', '', '', 1, '2019-12-15 09:19:35'),
(20, 'Martin', 'claros', 'carlitos.gerd@gmail.com', '', '', '', 1, '2019-12-15 09:37:51'),
(21, 'Martin', 'marquina', 'carlitos.gerd@gmail.com', '', '', '', 1, '2019-12-15 10:10:57'),
(22, 'Martin', 'marquina', 'carlitos.gerd@gmail.com', '', '', '', 1, '2019-12-15 10:29:19'),
(23, 'carlos', 'duran', 'carlitos.gerd@gmail.com', '', '', '', 1, '2019-12-15 10:43:33'),
(24, 'MARIO', 'GUZMA', 'carlitos.gerd@gmail.com', '', '', '', 1, '2019-12-15 10:45:27'),
(25, 'MARIO', 'GUZMA', 'carlitos.gerd@gmail.com', '', '', '', 1, '2019-12-15 10:47:30'),
(26, 'MARIO', 'GUZMA', 'carlitos.gerd@gmail.com', '', '', '', 1, '2019-12-15 10:54:59'),
(27, 'MARIO', 'GUZMA', 'carlitos.gerd@gmail.com', '', '', '', 1, '2019-12-15 10:55:42'),
(28, 'Martin', 'GUZMA', 'carlitos.gerd@gmail.com', '34294772947', '', '', 1, '2019-12-15 10:56:02'),
(29, 'Martin', 'GUZMA', 'carlitos.gerd@gmail.com', '34294772947', '', '', 1, '2019-12-15 11:00:36'),
(30, 'Martin', 'GUZMA', 'carlitos.gerd@gmail.com', '34294772947', '', '', 1, '2019-12-15 11:01:47'),
(31, 'Martin', 'GUZMA', 'carlitos.gerd@gmail.com', '', '', '', 1, '2019-12-15 11:03:58'),
(32, 'Juan', 'marquina', 'carlitos.gerd@gmail.com', '', '', '', 1, '2019-12-15 11:05:59'),
(33, 'Martin', 'GUZMA', 'carlitos.gerd@gmail.com', '', '', '', 1, '2019-12-15 11:07:12'),
(34, 'Martin', 'GUZMA', 'carlitos.gerd@gmail.com', '', '', '', 1, '2019-12-15 11:49:02'),
(35, 'tranferencia', 'GUZMA', 'carlitos.gerd@gmail.com', '', '', '', 1, '2019-12-15 11:52:40'),
(36, 'Martin', 'GUZMA', 'carlitos.gerd@gmail.com', '34294772947', '', '', 1, '2019-12-15 11:55:59'),
(37, 'Martin', 'GUZMA', 'carlitos.gerd@gmail.com', '34294772947', '24242', '', 1, '2019-12-15 12:08:03'),
(38, 'fsdfsd', 'GUZMA', 'carlitos.gerd@gmail.com', '34294772947', '', '', 1, '2019-12-15 12:11:59'),
(39, 'Martin', 'GUZMA', 'carlitos.gerd@gmail.com', '', '', '', 1, '2019-12-15 12:18:33'),
(40, 'Martin', 'GUZMA', 'carlitos.gerd@gmail.com', '34294772947', '24242', '53453', 1, '2019-12-15 12:19:42'),
(41, 'Martin', 'GUZMA', 'carlitos.gerd@gmail.com', '34294772947', '24242', '53453', 1, '2019-12-15 12:29:03'),
(42, 'Martin', 'GUZMA', 'carlitos.gerd@gmail.com', '34294772947', '', '', 1, '2019-12-15 12:31:51'),
(43, 'Martin', 'GUZMA', 'carlitos.gerd@gmail.com', '34294772947', '', '', 1, '2019-12-15 12:34:22'),
(44, 'Martin', 'GUZMA', 'carlitos.gerd@gmail.com', '', '', '', 1, '2019-12-15 12:53:21'),
(45, 'Martin', 'GUZMA', 'carlitos.gerd@gmail.com', '', '', '', 1, '2019-12-15 13:12:56'),
(46, 'nombre', 'apellidos', 'carlitos.gerd@gmail.com', '', '', '', 1, '2019-12-15 16:23:36'),
(47, 'Juan', 'martinez', 'carlitos.gerd@gmail.com', '', '', '', 1, '2019-12-15 16:49:28'),
(48, 'carlos', 'claros', 'carlitos.gerd@gmail.com', '34294772947', '24242', '53453', 1, '2019-12-26 20:06:09'),
(49, 'Julio', 'Leon', 'carlitos.gerd@gmail.com', 'direccion', '440424393', '7841410', 1, '2019-12-26 20:09:48'),
(50, 'Martin', 'duran', 'carlitos.gerd@gmail.com', '7', '7', '59178441410', 1, '2020-01-02 09:51:44'),
(51, 'MARIO', '78441410', 'carlitos.gerd@gmail.com', 'XXXX', '24242', '59178441410', 1, '2020-01-03 16:02:11'),
(52, 'martin duran', '78441410', 'carlitos.gerd@gmail.com', 'XXXX', '24242', '59178441410', 1, '2020-01-03 16:03:15'),
(53, 'PRUEBA', '78441410', 'carlitos.gerd@gmail.com', 'XXXX', '78441410', '59178441410', 1, '2020-01-05 19:41:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentariosavaluo`
--

CREATE TABLE `comentariosavaluo` (
  `id` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `id_avaluo` int(11) DEFAULT NULL,
  `usuario` varchar(30) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `comentariosavaluo`
--

INSERT INTO `comentariosavaluo` (`id`, `descripcion`, `id_avaluo`, `usuario`, `created_at`) VALUES
(1, 'Comentarios secretaria', 3, NULL, '2020-01-03 16:46:17'),
(2, 'comentairosde inspercto', 3, NULL, '2020-01-03 16:47:50'),
(3, 'INICIO', 1, NULL, '2020-01-05 19:36:00'),
(4, 'INICIO', 4, NULL, '2020-01-05 19:43:36'),
(5, 'ACEPTAR', 4, NULL, '2020-01-05 19:48:39'),
(6, 'INFORME TERMINADO', 3, NULL, '2020-01-05 19:51:11'),
(7, 'INFORME TERMINADO\r\npor el superisor', 3, NULL, '2020-01-05 19:56:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `company` varchar(255) NOT NULL,
  `details` text NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `keywords` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE `configuracion` (
  `id` int(11) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `detalle` text NOT NULL,
  `keywords` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datossolicitud`
--

CREATE TABLE `datossolicitud` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `id_tipoinmueble` int(11) NOT NULL,
  `estatus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `datossolicitud`
--

INSERT INTO `datossolicitud` (`id`, `nombre`, `id_tipoinmueble`, `estatus`) VALUES
(1, 'ubicacion', 0, 1),
(2, 'ddrr', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE `departamento` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`id`, `nombre`) VALUES
(1, 'Cochabamba'),
(2, 'Oruro'),
(3, 'Santa Cruz');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentosavaluo`
--

CREATE TABLE `documentosavaluo` (
  `id` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `imagen` blob,
  `avaluo` int(11) DEFAULT NULL,
  `path_drive` varchar(200) DEFAULT NULL,
  `id_tipodocumento` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `documentosavaluo`
--

INSERT INTO `documentosavaluo` (`id`, `descripcion`, `imagen`, `avaluo`, `path_drive`, `id_tipodocumento`, `created_at`) VALUES
(18, 'dddd', 0x504b030414000600080000002100ddfc95376601000020050000130008025b436f6e74656e745f54797065735d2e786d6c20a2040228a000020000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000b454cb6ec23010bc57ea3f44be5689a187aaaa081cfa38b648a51f60ec0d58f54bf6f2fafb6e0244550b412ae5122959efccececc483d1da9a6c093169ef4ad62f7a2c0327bdd26e56b28fc94b7ecfb284c22961bc83926d20b1d1f0fa6a30d904481975bb54b2396278e03cc93958910a1fc051a5f2d10aa4d738e341c84f31037edbebdd71e91d82c31c6b0c361c3c41251606b3e7357dde2a896012cb1eb7076bae9289108c960249295f3af58325df3114d4d99c49731dd20dc960fc20435d394eb0eb7b236ba256908d45c4576149065ff9a8b8f272616986a21be6804e5f555a42db5fa385e825a4449e5b53b4152bb4dbeb3faa23e1c640fa7f155bdc2e7ad2398e3e244e7b399b1feacd2b5039591120a2867675c7470744b2ec12c3ef90bbc66f52809477e0cdb37fb6070dcc49ca8a7e8989981a389bef57f25ae8932256307dbf98fbdfc0bb84b4f9933efec18cfd7551771f481d6feeb7e117000000ffff0300504b0304140006000800000021001e911ab7f30000004e0200000b0008025f72656c732f2e72656c7320a2040228a0000200000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000008c92db4a03410c86ef05df61c87d37db0a22d2d9de48a17722eb038499ec01770ecca4dabebda320ba50db5ee6f4e7cb4fd69b839bd43ba73c06af6159d5a0d89b6047df6b786db78b075059c85b9a82670d47ceb0696e6fd62f3c9194a13c8c31aba2e2b38641243e226633b0a35c85c8be54ba901c4909538f91cc1bf58cabbabec7f457039a99a6da590d6967ef40b5c758365fd60e5d371a7e0a66efd8cb8915c807616fd92e622a6c49c6728d6a29f52c1a6c30cf259d9162ac0a36e069a2d5f544ff5f8b8e852c09a10989cff37c759c035a5e0f74d9a279c7af3b1f21592c167d7bfb4383b32f683e010000ffff0300504b030414000600080000002100d664b351fa000000310300001c000801776f72642f5f72656c732f646f63756d656e742e786d6c2e72656c7320a2040128a0000100000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000ac92cd6ac3301084ef85be83d87b2d3bfda184c8b99440aeadfb008abdfea1b224b49bb67efb0a43528706f7e28b604668e693b49bed776fc42706ea9c5590252908b4a5ab3adb28782f7677cf2088b5adb47116150c48b0cd6f6f36af6834c743d4769e444cb1a4a065f66b29a96cb1d794388f36eed42ef49aa30c8df4bafcd00dca559a3ec930cd80fc2253ec2b05615fdd8328061f9bffcf7675dd95f8e2ca638f96af54c82f3cbc2173bc1cc5581d1a6405133389b420af83ac9604a13f1427670e215b148107133ff3fc0c34eab9fac725eb398e08feb68f528e6b36c7f0b02443ed2c17fa60261c67eb04212f063dff010000ffff0300504b030414000600080000002100cb9fd35c28070000fa26000011000000776f72642f646f63756d656e742e786d6cec585d6fda30147d9fb4ff6045da9e46132865152b54a88ca952a775fdd09e8d634254c7b66c27947fbf6b3b615008aa285d5ba94f81d83ee75cdf0f5fe7e4f43e63a8a04aa782f782e6411420ca8988539ef482db9b51e33840da601e632638ed0573aa83d3fec70f27b36e2c489e516e104070dd2d60746a8cec86a126539a617d2024e53038112ac306feaa24ccb0bacb6583884c62938e53969a79d88aa24e50c2885e902bde2d211a594a94d06262ec92ae984c5242cb47b5423d86d7af1c96921d63a828030d82eb692a758596ed8a06264e2b90629b1145c6aa7933f918b658e119f823635ef64ca8582a41a8d6f076e8071788cd681b77b9811662b1e2311256392b25194ef902c646c703ff2f9c7700ce0b3d7768a1fe19027bd187581a8b786e9f66cccac7a52a7f5c9b39a368d62d30eb053778cc30119ce4385624673808cb697f60caac1740fc02ca5c82189c1bb118be10e2ae0289da83c80e848e6f41f443a5b1054be0792698c76bb68f8e3dc8caebc3a3a6837838bbd5d9f4faf0b0ed403c61c563145040e2c557203beab4da9dd691556f5fdd405047d159d43cfbda741b6488b393946a4969ae93076bbcc5f1bddb0f4b534e94f51457978e6395f76a48273867664991e5959e56f9c7d8ef9dfb075cd56045b5826b576f58060afb37e025e703e70970b7c5f25e298ddd68b2dbfa376af2906aa252698bce0e96376d74bd51cb2fa9227056e0642797dbfc79a386ff1a6baa0a7fced4fbdca6ac2f782f5c1436e7bf97d63fcfe0dc29a83df4eb4db1c567ef895b23abb6e498fe00aa7f430a096784a1e83a979239e198a181941acd523345036330995a7bf40e063d251f6b0c721bd76f46d1a71df4b86366c73459d2b374ea947e3f836e8d5143e37a51af3180d70d797501ecfd3d2044e4d0480fb19e8e05565bf6b936bbf6148ca34167d8fa1e585da5f35f3618d7f5bc07a36b749fd2062d257bd9fe397f6fa9a63fb1be0b6f395ceaee688c8c4812e8c93fe34c7eb3d594cd919d800447d794d8ee06695cec72d2ef298a97adf22976fc9215755dceef013ae7084ed344c135eebdacfe87ee6ed158addd4f4cff9c1b9a28db285ce4648e923c8d21cc5b8dd1005da70947b9fc822e448252fe058de03386304862aded55b6de77cf5daad7a3ea654bf5ba9ef752fde452bd12ac55815eafdfe5c8e583af065b62de7e6eeb6a89097c29915084e09242837ed589ac4435b40215f3037c68b3171d342407aa9617299d51b502f2b8cbfd9eeaff7ae7f74ca9f1170000ffffec584b6edb3010bdcac040d14d82c8f2271f24061ac7098a2285101728b2a4c5b14c54160592b2e3ae7a87deb027e9909252c98d52c7add32cb2912d92430e67de9b8f52589e282df8cd59cbf3fa7eb7eff75ae5d0054e59161b3b33f4dac3c3766b704aabedc30c86729ec668909f1ed857fba4197aa6ee69c2fc275fadca2d2b7b15439f5465cc6d4d92b46318e4a2e1675ab83c6bb5bbbd23ab9959a578d6e277ac75501c942fac5da450b73cf5d18bbc9fa74a2e708e8969be8a55e841b53abdb6b7ad5a81bbfa66462faf92cb54dc6106b83f1651c24ca61016a8c45484cc089900d3301e7fdc835b640ae414264299d91eb08443c0b45e4ac561c1e20c3530922503a0420e3fbe7d877befc22433b04498b10502038e29261c93706537bc66fa8b06618160cde74eddc2866dbfbfb50d1f75ed51efcd16ea743adddd20ed3c8b602aee4412814880501729d4baa62191a8f4b4a5c5e5bbfe853f6a39e4c1dd3c3ed1290b09fe2909a25a606b006c22c94373f2c4c68eb0847de56525eead858b1ac74a773400ad9caec9387f0d6e308dc95b6066081f6e0318254ac6b1250a8c892b9926967184a53033b7c60e62c3aa1a486a41b63132ed8c556dcf7b51b4ba8f55cd467a8988af703b27e360986923e7a8800245f35d1a1dfef7a9688d0715c85795ad43be326306d71704f4fd8ee775601f024aab82a37aab41cf28c17060691a97c9496888a40d8546deafd4701e5068d40619b7f9e54ac92c25f1f3600b73fc23fc57ee57b8e9ffe2ff777db6c77fb157e1d09d5462f5236e1a209507cce7c4ff9a5e79f85e1b6c50b619ff0fa7e89c14feb1e713296a40a6625949391d299bf4f3c256a718c7940994b1f56da51ca86998db6b446540bad186a384ff71bb879507cd5696a5b646b66406e26d220d158b369911a75dfaba464ebc16dc558b94ef56b6a0ac69b6839cb599b772533d07679fa2cf2b6709f1d4d53d2967ad19b8c68892944fe66c91b3fcee718fe859eda584d6d41abda2b8fc065098df45a59c559ba3d8166093d84ad5faf48bcb7e7bf4e0078762c6c5408da1096a7d515d6e4cf3b65b2a46dd29d1f86b8eb0b6ef775d7739a36f08bd23faeff64ca36b6a8a492b99da6f0bf91225a219ed54be4ea4a17aecd77b8cd3caec8c8a14a40efed073dde2544a6a9fef5fa3ccb8d7e2b850c69a4e2bda372be2b4e032bc5214369727b148301026242d3bd40dd32c992cbfb8fb3b917ce5fe9048667b88c14f000000ffff0300504b030414000600080000002100266c541b9a060000521b000015000000776f72642f7468656d652f7468656d65312e786d6cec594d6f1b4518be23f11f467b6f6327761a4775aad8b11b48d346b15bd4e37877bc3bcdecce6a669cd437d41e9190100571a012370e08a8d44a5ccaaf09144191fa1778676677bd13af49d24650417d48bcb3cffbfd31ef8caf5ebb1f33744884a43c697bf5cb350f91c4e7014dc2b6777bd8bfb4e621a9701260c613d2f6a6447ad736de7fef2a5e5711890902fa44aee3b6172995ae2f2d491f96b1bccc5392c0bb31173156f028c2a540e023e01bb3a5e55a6d7529c634f1508263603b041a1410746b3ca63ef13672f63d06321225f582cfc4403327194d091b1cd435424e659709748859db0349013f1a92fbca430c4b052fda5ecd7cbca58dab4b783d23626a016d89ae6f3e195d46101c2c1b99221c1542ebfd46ebca56c1df00989ac7f57abd6eaf5ef03300ecfb60a9d5a5ccb3d15fab77729e2590fd3acfbb5b6bd61a2ebec47f654ee756a7d369b6325d2c5303b25f1b73f8b5da6a6373d9c11b90c537e7f08dce66b7bbeae00dc8e257e7f0fd2badd5868b37a088d1e4600ead03daef67dc0bc898b3ed4af81ac0d76a197c86826c28b24b8b18f3442dcab518dfe3a20f000d6458d104a9694ac6d8873ceee2782428d602f03ac1a53776c997734b5a1692bea0a96a7b1fa6186a62c6efd5f3ef5f3d7f8a8e1f3c3b7ef0d3f1c387c70f7eb48c1caa6d9c8465aa97df7ef6e7e38fd11f4fbf79f9e88b6abc2ce37ffde1935f7efebc1a08e53353e7c5974f7e7bf6e4c5579ffefedda30af8a6c0a3327c486322d14d7284f6790c8619afb89a9391381fc530c2b44cb199841227584ba9e0df539183be39c52c8b8ea34787b81ebc23a07d5401af4fee390a0f223151b442f24e143bc05dce59878b4a2fec685925370f2749582d5c4ccab87d8c0fab647771e2c4b73749a16fe669e918de8d88a3e61ec389c221498842fa1d3f20a4c2babb943a7edda5bee0928f15ba4b5107d34a970ce9c8c9a619d1368d212ed32a9b21de8e6f76efa00e6755566f9143170955815985f243c21c375ec71385e32a96431cb3b2c36f6015552939980abf8ceb4905910e09e3a8171029ab686e09b0b714f41d0c1dab32ecbb6c1abb48a1e84115cf1b98f332728b1f74231ca755d8014da232f6037900298ad11e5755f05dee56887e8638e06461b8ef50e284fbf46e709b868e4ab304d16f2642c7125ab5d381639afc5d3b6614fab1cd818b6bc7d0005f7cfdb822b3ded646bc097b5255256c9f68bf8b70279b6e978b80befd3d770b4f923d02693ebff1bc6bb9ef5aaef79f6fb98beaf9ac8d76d65ba1edeab9c10ec566448e174ec863cad8404d19b921cd902c619f08fab0a8e9ccf9901427a63482af595f7770a1c0860609ae3ea22a1a44388501bbee6926a1cc588712a55cc2c1ce2c57f2d67818d2953d1636f581c1f60389d52e0fecf28a5ececf05051bb3db84e6f0990b5ad10cce2a6ce54ac614cc7e1d6175add499a5d58d6aa6d539d20a932186f3a6c162e14d1840108c2de0e55538a16bd17030c18c04daef76efcdc362a2709121921186f3bf39ba37b5ddf331aa9b20e5b9626e0220772a62a40f79a778ad24ada5d9be81b4b304a92caeb1405c1ebd3789529ec1b328e9ba3d518e2c2917274bd051db6b35979b1ef271daf6c670a685af710a51977ae6c32c84ab215f099bf6a716b3a9f259345bb9616e11d4e19ac2fa7dce60a70fa442aa2d2c239b1ae65596022cd192acfecb4d70eb45196033fd35b458598364f8d7b4003fbaa125e331f15539d8a515ed3bfb98b5523e51440ca2e0088dd844ec6308bf4e55b027a012ae264c47d00f708fa6bd6d5eb9cd392bbaf2ed95c1d975ccd20867ed5697685ec9166eeab8d0c13c95d403db2a7537c69ddf1453f217644a398dff67a6e8fd046e0a56021d011f2e720546ba5edb1e172ae2d085d288fa7d018383e91d902d70170baf21a9e03ad9fc17e450ffb735677998b286039fdaa7211214f623150942f6a02d99ec3b85593ddbbb2c4b96313219555257a656ed1139246ca87be0aadedb3d1441aa9b6e92b501833b997fee735641a3500f39e57a737a48b1f7da1af8a7271f5bcc6094db87cd4093fbbf50b16257b5f4863cdf7bcb86e817b331ab915705082b6d05adacec5f5385736eb5b663cd59bcdccc958328ce5b0c8bc54094c27d0fd27f60ffa3c267f69709bda10ef93ef456043f346866903690d597ece0817483b48b23189ceca24d26cdcaba361b9db4d7f2cdfa8227dd42ee09676bcdce12ef733abb18ce5c714e2d5ea4b3330f3bbeb66b0b5d0d913d59a2b034ce0f322630e647adf2af4e7c740f02bd05f7fb13a6a44926f84d4960183d07a60ea0f8ad4443baf117000000ffff0300504b030414000600080000002100f92f0b53e10200007e06000011000000776f72642f73657474696e67732e786d6c9c55db52db30107def4cffc1e3e706c72684d6836168427a19683b357cc0da966d0dba8da4c4a45fdf956d61685386e953e473768ff6aa9c5d3c7016ec8836548a2c8c8fe6614044292b2a9a2cbcbbddccde8781b1202a6052902cdc13135e9cbf7d73d6a586588b66264009615299855b2d5253b6848399715a6a69646d67a5e4a9ac6b5a92f1271c3d7416b6d6aa348a46a723a98840b55a6a0ed61c49dd4483e75a965b4e848d92f97c1969c2c062c0a6a5ca7835febf6a7855eb45762f25b1e3ccdb75f1fc25cb31dd4eeaead1e335e13907a565498cc1ca7236a4cb810a2f63d86b74867a5ed34283de3f1139c7b6fd9292075daa882eb1a0d8f3e3791839022f96756ec112a48d228cf543503202787d97361a38076cda80f43e15a961cbec2d14b9950a8d7680019e26a364d98286d2129d2b28516d2585d59279bb4a7e937625b9d298f010040e8b02db6be34c56c605e60e3fa5b4de0d4720592c9393c1c3b113135f2e3face343ccbf7d56f378757ad067bd59c65707efd95c2ed7c995bb271a02c44879ea46e987f6a70d661bf0a1242be085a610dcb861432f9e16fafe23159e2f080e3d79cae4dbc293b3d940180e8c6db0a29ec0391b988a1ab526752fcc6e40379372df0a9eea8328f6efeba39a9b07a23f69b955836aa7417d1115c2fec278b118f5a8b0d7947bdc6c8bdc7b099cb927d45654df77da09465381bad4e233415c85ae4134be7f44ccee7267daa525d3b97b4ac80d2885a3832645136721a34d6b63378f16bf2ad0f7fd47d1242397f41c7e39aeff80d26586d6e3c1190c47b41a0f1376ecb1e3095b786c3161271e3b99b0a5c7960e6bf7b864b844f7b8b2fee8f05a32263b527df66016fe050d45302d28827d753b860326d31e1897ce04bb943ce006938a5a7ca515ad383c6461323fe97b345a33d8cbad7d66eb949cb17a86061558c0f7a06fd533e77ec8ff88a54b2b52521cc87ccf8b69a5df0d81336a6c4e146ebf951a53ee9f859ec375f17f1ce7bf010000ffff0300504b030414000600080000002100aede8aab870100000704000012000000776f72642f666f6e745461626c652e786d6ca492df6e823014c6ef97ec1d48ef2705ff4c89688c9b97bb58dc031cb14813da929e2af3ed77a0c82ecc32dd4a42c277da8f737efde6cb4f55062761511a9db268c059207466f6521f52f6b1dd3c4d59800ef41e4aa345cace02d972f1f830af93dc6887019dd798d89415ce55491862560805383095d054cb8d55e0e8d31e4293e732132f263b2aa15d18733e09ad28c1d1bfb19015b2ceadbec5ad36765f599309446a5695de4f81d46cd17517d48906455dafa1943b2bdb4205daa088a8768232653ce61b3ea677f38cf8b079b3b071c80ab0285cbf917b390725cbf345c55a22fa42255d565cf4135809bb52f812ca03158eb8e3297be5b4e2cd8679254ad98884d5ba57626acaafa8db33ec15ba1e6aacf569b744b3d68714f2e94eb57d86fe7eae486ca51218bc893a78370a3caa6b22319f108931f168c80cef22625bdf96e01d44e2553f3f4db2a6519ea7a3cbfcdf4466bf13f13eb7135983a268c00fd9680878120d91fbb2f13712d7d9e0a39ecd3789360994a8ff64a30b092ebe000000ffff0300504b0304140006000800000021004ad88a92bb0000000401000014000000776f72642f77656253657474696e67732e786d6c8ccec16ac3300cc6f17b61ef10745f9df5304a485228a32fd0f5015c47690cb164246ddef6f4356c97dd7a149ff8f1ef0f5f696d3e5134320df0b26da1410a3c45ba0d70793f3defa151f334f9950907f84685c3f8b4e94b57f07a46b3faa94d55483b196031cb9d731a164c5eb79c91ea36b3246ff5949be3798e01df387c242473bbb67d7582abb75aa04bcc0a7f5a79442b2c53160ea85a43d2faeb251f09c6dac8d9628a3f7862390a17457163effeb58f77000000ffff0300504b030414000600080000002100cdc76e79f1010000e903000010000801646f6350726f70732f6170702e786d6c20a2040128a00001000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000009c53c16edb300cbd0fd83f18be274ab26e6b0246c59062c8615b03c46dcf9a4c274265c99098acd93fed2bf663a5e2c671b69de613f948534f8f4f70f35cdb6c8f211aefe6f97838ca3374da97c66de6f97df179709d6791942b95f50ee7f901637e23dfbe8155f00d063218331ee1e23cdf12353321a2de62ade290cb8e2b950fb5224ec346f8aa321a6fbdded5e8484c46a30f029f095d89e5a0e906e6edc4d99efe7768e975e2171f8a43c384251458375611ca6f898e05d101507852b63035cac93bc6bb0c566a83518e41b4013cfa50727e3505d186b0d8aaa034b17af2fa3d37f672f8d434d66845acabfc6a74f0d15794dd1d15c8d2ff20fa2dc0aaac51ef82a1831c81e8a7f0c53866f211441b30b3a0364135db577a5d066bad2c2ef8eab25236228833004b5469ad2b65982fec69b6474d3e64d1fce4c54ef2ecbb8a98049be77b158c72c4c2a5b63639c6b6891464f1fb17edac07c1d5163986fdc67e6cae928adccbc16563025b165cb8e45718b218ef2abe2bfd83eeb84ff7c8a125dba3d30bbb33fe98baf075a3dc412ef18745a2c14ae9279556732a24e99fe27d53f8dbe49e57512fc19e0d1e0d6dd78dd2bcade9947d723644af026bb60d96bce1d3bc33004bd63fd87428ffeb36589e7afe2e248b3db42f578e27c3117f474f9d30366ef7a4e40b000000ffff0300504b03041400060008000000210060a4a3f84f0100007b02000011000801646f6350726f70732f636f72652e786d6c20a2040128a00001000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000008c925f4bc33014c5df05bf43c97b9bb40371a1ebf00f03c1a1b80dc5b790dc6dc1260d495cb76f6fda6e5d873ef878734e7ef7dc9be4d3bd2aa31d58272b3d41694250049a5742eacd04ad96b3f81645ce332d58596998a00338342daeaf726e28af2cbcdaca80f5125c1448da516e2668ebbda1183bbe05c55c121c3a88ebca2ae6436937d830fec5368033426eb002cf04f30c37c0d8f44474440ade23cdb72d5b80e0184a50a0bdc36992e2b3d78355eecf0bad32702ae90f26cc748c3b640bde89bd7bef646faceb3aa9476d8c903fc51ff3e7453b6a2c75b32b0ea8c805a7dc02f3952d568bd5dddbd34b8e0767cdfe4ae6fc3cac7a2d41dc1fceb6df52e3b6b093cd2b15698e8765e8d40ed6b5031185a8b41beca4bc8f1e1e973354642423314963922dd3311d8d29219f4daa8bfb4df4ee401db3fd8f98114ab24be20950b4892fbf4bf1030000ffff0300504b0304140006000800000021003509b7ceba0700003e3d00000f000000776f72642f7374796c65732e786d6cd49b4b53db4810c7ef5bb5df41a57b0236c44ea838290261a12a0f12c3ee792c8df154648d578f00f9f4dbd3230d42b2ac6e4b39ec29e831fdeb99eef9b720d36fdf3fac23efa74c52a5e3993f7a79e87b320e74a8e2bb997f7b73f1e2b5efa599884311e958cefc4799faefdffdf9c7dbfb93347b8c64ea8181383d4966fe2acb3627070769b0926b91bed41b19c3b3a54ed62283cbe4ee402f972a90e73ac8d732ce0ec6878793834446220378ba529bd42facdd53acddeb24dc243a90690adeae236b6f2d54ecbf03f7421d9ccba5c8a32c3597c975525c1657f8cf858eb3d4bb3f1169a0d40d380e535cab582797a771aa7c7822459a9da64a6c7db8326f6d7d12a459c5da07152affc010d35f60f3a78866fe785cde39331e3cbb1789f8aebc27e317b7f3aa2733dfdd5a80dd992f9217f35363ec00a759fe5b99eee6d9e4e10a5dd98800160e386299490820c4c3702265023d9e4eca8bef790437449ee90282060056350b97b51587b84294e7364be0a95c7ed2c10f19ce337830f39105376fafae13a513953dcefc376f0c136ecee55a5daa309426298b7bb7f14a85f29f958c6f53193eddff76812956580c741e67e0fe648a5910a5e1c787406e4c8a81e95898087f3103226336ad70d0a15c3d79636fd4a878f3df1239b231dc4a594961b69187feef04e1acf3dea0b1995175026897e5eb517f13c7fd4dbcea6f0293b7df5a4cfb7b01e2d9372236372a59490f6aa6039b7cd575387ab32365cd884616758e68244de788468e748e68a444e7884606748e6804bc734423be9d231ae1dc392210285cf52c3ac2d5206dec1b9545d28cdf2940a39e5257941aef5a24e22e119b95670a6bdded5d6239cf1719cd5594d3fdc5729e253abeeb5c11a8ce66ebeeadc91fd79b9548157cd1742cfdb8e7d2df884524bdbf121576a25ed9e46bcc093f4cb696b0eb480472a5a35026de8d7cb011658cffa2bdb9fdcae874ae67583fa9bb55e6cd5758723b619396456f5f096bff934a710d766ea649cb54ba8c93623869c9cb76e39f65a8f275b93484af9189d57346986b087471f7121d9b10357757e72c4c002853b0e5823f05b44ff0df1617be7d13638affb614ed699fe0bf2d5c7bdac7fcd81d5fb6d29c8be48747da5e53f6de3dd3914e967954ee814e7998b277b043d0a6c0dec4ce3e4924a6ec1dfc4c3ebdd32080dfdc2879ca8ec5938e3228ec70580a6e36fa5cd841a9c9de88312376806aac3183d54f6b1920b6e87e973f95f9c313b718a04abb6fcdceed7cd4b202508248dfd0df729d757f438f5b348f4ab98ae1cf25a9f468b4a3969d47a515f964eb1d23c6fd0a1f03d4af023240fd4a2103d4921feddf3cae26d221fd8b2383c5966557c530edc8ca3c652bb303f14ac0407593f0fdd5b27bdb73a15937091476809a7593406147a756cb5cdd24b006ab9b04564bd5688f515553399362d7cd2ac87d091066348c781340c3883701348c781340fdc5bb1b329c7813586c6d709a5a156f02085fe1fcaaef4055f12680d8da60d5aef89b5159f7d0caee5f6e07106f02851da0a6781328ece8b489378185af7032a1c6725247600d23de04d030e24d000d23de04d030e24d000d23de04507ff1ee860c27de04165b1b9ca656c59b0062cb830355c59b00c25738dab055bc71d7ff76f12650d8016a8a3781c28e4e4d50dd472a81c50e508de5c49bc0c25738c950b030b939931a46bc09331a46bc09a061c49b001a46bc09a0fee2dd0d194ebc092cb636384dad8a3701c4960707aa8a3701c4d686ade28d9bf1b78b3781c20e5053bc091476746a82ea748ec06207a8c672e24d6061bef4166f02085fd917c499d130e24d98d130e24d000d23de04507ff1ee860c27de04165b1b9ca656c59b0062cb830355c59b00626bc356f1c63df2dbc59b406107a829de040a3b3a354175e24d60b103546339a923b086116f020813b3b7781340f8ca1e20dc459c300d23de84190d23de04507ff1ee860c27de04165b1b9ca656c59b0062cb830355c59b00626b8339670be745c9c753472d49403d67509e6a2003c72d41a2028b097e974b99402793ec3e1dd21358ce90416c490fea143f68fdc3a31dec3e6a4910324a2d22a5f148f7239ed2a934221c4d777412dc7c3df32e6d034c631ca6d4f39337d03d546d17c2f624d338047e668f1b68d9d99427cb8d356810327d5d450b10f6a15d414350d1d663069b3e1f78119baa8adbf8ffb605157f869eb7b07ce7f0f0fc6232faf8aa687042934d278215781140afd40e272e72383a2743b94912b1d49b047e3403ea4eb59c9847c79eda354af78a93f3cfcb18bc0bcbd6e26a668e85ef70d31c1b17d0e766faa0eabed905f3f064b90d71d323e8d4425f9f3ef9acebcf8e94e2adea92678bc8f69ec10f57b1597de8f4c3ff4eb3510e1f84350bcfcf64147d16d8a996e94dfbab915c66f6e9e8104b63cdd44267995eb78f4ff0e4387ab2cd002c71d5197b6926d1bef671be5ec8045abf76acff5cc5119c65165b16df1e83b5cbe9b61bf88fc94c5df776ef5c66b87d83b910e838c845980479d4740a53c13619a05f0b011d785f4d431d3a85068a646af11b7a0ff0c9f34d37191f4fc6b8e9b09910775cbd2b11d3a3e8493c7617db7b123156e40cfb000da4d0f96aa836c37032a699b46899f935f3ed5fbfc0a7b263313087899fba2141b76cfeed35d6e5e65ea3cbccdd6bb082ced5505e9621e4ceda0eff7bbfe176135597ffffb4ddcbad95befb0f0000ffff0300504b01022d0014000600080000002100ddfc953766010000200500001300000000000000000000000000000000005b436f6e74656e745f54797065735d2e786d6c504b01022d00140006000800000021001e911ab7f30000004e0200000b000000000000000000000000009f0300005f72656c732f2e72656c73504b01022d0014000600080000002100d664b351fa000000310300001c00000000000000000000000000c3060000776f72642f5f72656c732f646f63756d656e742e786d6c2e72656c73504b01022d0014000600080000002100cb9fd35c28070000fa2600001100000000000000000000000000ff080000776f72642f646f63756d656e742e786d6c504b01022d0014000600080000002100266c541b9a060000521b0000150000000000000000000000000056100000776f72642f7468656d652f7468656d65312e786d6c504b01022d0014000600080000002100f92f0b53e10200007e060000110000000000000000000000000023170000776f72642f73657474696e67732e786d6c504b01022d0014000600080000002100aede8aab87010000070400001200000000000000000000000000331a0000776f72642f666f6e745461626c652e786d6c504b01022d00140006000800000021004ad88a92bb000000040100001400000000000000000000000000ea1b0000776f72642f77656253657474696e67732e786d6c504b01022d0014000600080000002100cdc76e79f1010000e90300001000000000000000000000000000d71c0000646f6350726f70732f6170702e786d6c504b01022d001400060008000000210060a4a3f84f0100007b0200001100000000000000000000000000fe1f0000646f6350726f70732f636f72652e786d6c504b01022d00140006000800000021003509b7ceba0700003e3d00000f0000000000000000000000000084220000776f72642f7374796c65732e786d6c504b0506000000000b000b00c10200006b2a00000000, 3, NULL, 4, '2020-01-03 16:44:31');
INSERT INTO `documentosavaluo` (`id`, `descripcion`, `imagen`, `avaluo`, `path_drive`, `id_tipodocumento`, `created_at`) VALUES
(17, 'ddd', 0x255044462d312e370a25c2b3c7d80d0a312030206f626a0d3c3c2f4e616d6573203c3c2f44657374732034203020523e3e202f4f75746c696e6573203520302052202f5061676573203220302052202f54797065202f436174616c6f673e3e0d656e646f626a0d332030206f626a0d3c3c2f417574686f722028504329202f436f6d6d656e7473202829202f436f6d70616e79202829202f4372656174696f6e446174652028443a32303139303930353131353134352b30332735312729202f43726561746f722028feff00570050005300208868683c29202f4b6579776f726473202829202f4d6f64446174652028443a32303139303930353131353134352b30332735312729202f50726f6475636572202829202f536f757263654d6f6469666965642028443a32303139303930353131353134352b30332735312729202f5375626a656374202829202f5469746c65202829202f54726170706564202f46616c73653e3e0d656e646f626a0d382030206f626a0d3c3c2f4149532066616c7365202f424d202f4e6f726d616c202f43412031202f54797065202f457874475374617465202f636120313e3e0d656e646f626a0d32342030206f626a0d3c3c2f42697473506572436f6d706f6e656e742038202f436f6c6f725370616365202f446576696365524742202f46696c746572202f4443544465636f6465202f48656967687420323638202f4c656e677468203132383234202f53756274797065202f496d616765202f54797065202f584f626a656374202f5769647468203330353e3e0d0a73747265616d0d0affd8ffe000104a46494600010100000100010000ffdb004300080606070605080707070909080a0c140d0c0b0b0c1912130f141d1a1f1e1d1a1c1c20242e2720222c231c1c2837292c30313434341f27393d38323c2e333432ffdb0043010909090c0b0c180d0d1832211c213232323232323232323232323232323232323232323232323232323232323232323232323232323232323232323232323232ffc0001108010c013103012200021101031101ffc4001f0000010501010101010100000000000000000102030405060708090a0bffc400b5100002010303020403050504040000017d01020300041105122131410613516107227114328191a1082342b1c11552d1f02433627282090a161718191a25262728292a3435363738393a434445464748494a535455565758595a636465666768696a737475767778797a838485868788898a92939495969798999aa2a3a4a5a6a7a8a9aab2b3b4b5b6b7b8b9bac2c3c4c5c6c7c8c9cad2d3d4d5d6d7d8d9dae1e2e3e4e5e6e7e8e9eaf1f2f3f4f5f6f7f8f9faffc4001f0100030101010101010101010000000000000102030405060708090a0bffc400b51100020102040403040705040400010277000102031104052131061241510761711322328108144291a1b1c109233352f0156272d10a162434e125f11718191a262728292a35363738393a434445464748494a535455565758595a636465666768696a737475767778797a82838485868788898a92939495969798999aa2a3a4a5a6a7a8a9aab2b3b4b5b6b7b8b9bac2c3c4c5c6c7c8c9cad2d3d4d5d6d7d8d9dae2e3e4e5e6e7e8e9eaf2f3f4f5f6f7f8f9faffda000c03010002110311003f00f7fa28a2800a28a2800a28a2800ac6d4fc59a0e8ebbafb54b68fe62bb55b7b6475185c9ad77fb8d8f4af95b5cb5d47c61e208ad34886d4cb0c2a1d2d4b12e1783bc01907d7ebd69a133e8fb4f18f872fa3df06b5658f479421fc9b06af0d6b4a6191a9d99fa4ebfe35f3547e12f15464a37832e1f03aa49281fa9ac7d45a7d23505b0d4b409ed2ed94308e49dd491ea38e4706819f54bebfa480426a5672480711a4e858fe19aa16fe2a56d516c6f2c26b4327faa9188647fa11c57ceba3e95ab6a715c5e695a05e4b1c3c4b24376463be3eee4fd2a4b19b56d5e68f4db4b2d4ee242d91126a3c023be0af1f5a00fa660d6b4aba98436fa95a4b29e88932927f006af57cb3aae91aae812c5fda1a16a76af265a3637e9ce3ae085ebc8abfa5e9de29d5ed8dce9da76bb34218a164d4d38603dc7b8a56607d2f457ce9ff0008f78ed7a695e241eb8d4529a746f1f2fddd3bc5007b5ea9a00fa368af9b8e99f1097a58f8a73ff5f40d33ec5f1155b9b3f1563da6cd3b01f4a515f37087e20a8e6dbc583f5feb467e202f583c5a3fed993fd68b08fa46aadf6a365a64026beba8ade32701a460327d057cec66f8800f3178ac0ef981aade87aed9ea0b7d67e2192fb51ba11b7d91e462cb1b0073d0fb0a1ab2b8d6a7bd58eb5a66a471657f6f3b7f752404fe5d6af57cbd6d2aaccfbcba6d526375383bbb0a98dfdeb2f1732b1ff6a4357c84f31f4bcf3c76f1992560abfcfd8567d9ea93dcc4f2c96a20419da8eff311efe95f3cc9712c880e583e390ce48cd0267645dd90c3ae1b20d350427267d2c93c4e81848b823d690dd5bafde9e21f5715f34c721fde79abc7f011d73ef4bba97b31f31f4c47224abba37575f553914eaf9e341d7eef41d4a2b9b79582061e6c79e1d7b822be858e459624910e55c0607d41a9946c34ee3a8a28a91851451400514514005145140051451400514514005145140051451400578b693e18f15f80bc5da8dd691a42ea76b71b82b6f0bb909dc39ce411d0d7b4d14d3b01e7dff092fc427195f0740bfef5c8ff001af25f88d3f8aafb5eb2d535fd3058af9661b740bf2e3bf393cf35f4dd721e3dbbd22e343bbd1eeafac21be9630d0add3e36f3c37438e869a7a89a389f829ab4314d7fa6cf2ac72dc15921427ef919ce3df18af6148218e4691228d5dfef32a804fd4d7cc3a95aff0060ebb8b0d452e16360f05d40dd476fa115bb7ff1135bbdb474fb54d0caf2239789f68c04da401e84f3f5a53bef15708f6677df18501d06c1c8e56e4807eaa7fc2acfc233ff0014a4e3d2edbff415af1a9f5dd4efecd6dafef66b9c36ecc8e4f3cf6fa1af46f871e2fd1b43d0a7b5d46e8c3235c1751b49e3007f4a15f975561bb2968cf5da2b975f889e166ff98aa0faa37f856fe9fa85a6ab649796532cd6f2676baf438383fa8a4059a28a2800a28a2800ac7f115a5bb787efd8a6dd96f230d8c57f84f5c75fc6b629b24692c6d1c8a191815653d083da803c37e1e787b4ef116b1749a9333ac31865843952fce3391ce071f98ad2f1af86b49d27c4fe17b1d3ed7ca8af6e824ebe6336f5dca31c9e3827a56cbfc258e3bd79ac7599ad9093b14479651e9bb70a49fe15c5b0cf79e20b9758d4b1764fba0724f24d69757dc9b1e42e9796dacdd5bdc249108dd8794eb82b835d2783aca0d4fc5ba7da5d462481dc9743d0e149fe9546eeded350d5c58f867edda91446799a48b6f0bdd47a7d7d6a0d2f529f4ad4adefed88f36070eb9e87d41fa8e2afa127d043c2da08e9a459ff00dfa14f1e1bd1074d2acffefcad3f43d66db5ed261bfb56cab8c32f746eea6b46b1bb343e74f12db4361e25d4adad976c31dc32a2ff007467a57bf68e08d12c01ebf668f3ff007c8af03f169cf8bb56ff00afa907eb5eff0062562d32d5598281120e4e3b0aa96c895b96a8a40ca7a107e8696a0a0a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800af9afc6fa98d5fc63a8dd23ee884be5c67b155f9463f2cfe35ef9e2ad4c68fe18d42f776d648884ff0078f03f535f3495cd0055bb6090e4b8439e1bd2a8beac07950e43b921176a925893c547af4ec248e1456242e4e077358301bcb5d4adaf92da573048af8d879c1cd5a7644b5767aeda7c3bd7a7b688cb35b4400e03125b9e79c55b8be1adf0558e5d4a32abfdd4248fcea2b2f892c204f39248b2323cd8caff00315a10fc44b77e3cc889f6715cd2a958d14604f6bf0e6d2220dc5f5d4847f75140fe75df787e78f40d1e1d3608e492288b10cf8cf2c4f6fad711178e6ddfae0fd0d5f8bc6566d8cb0acdd4abd4ae589dfaebea7ef40df91ff0a9575cb73d548fa9c570f1f89ec1ff00e5a2d594d7acdfa4a3f3a5ed66b741ca8ed9754b66e8c7f4ff001a956f616ee7f2ae31355b6703128fceaca5ec47a4a0d52aefaa1721d60b988ff17e94f13467f8c572a2f107fcb45a78be23eeb0fcea95788b919d3f9b1938f3173f5a8af6dd6f6c2e2d4c9b04d1347b872464633fad73dfda129e8c3f3a3fb4641db3f9557b68872b2e7853c356fe17d1d6c62904efbd99a6f2c2b364e707af4af36f895e10fec9b96d66c2202ca76fdf22ff00cb290f7fa1fd0fd6bbf5d4dffbb51dd5e4579692db5c47be1954aba37420d52ad1bdee2706790785fc6d7be149e53046b3c128f9e076c0cf620f635d21f8cbaa48d84d2ad57eacc6b9dd4edf4ff0f6c816c92f1a567705ce084cfcbfa52e872e93aa999a5b116c91100b99885e7df8aeae54ccf632ee6fa4bfd4e6beb823cd9a532be060649c9ae9f53f10de6a70d95b34c56dada15409bbef38cfcff96063daa4baf0a5a229b8de9e411b861f3f2f7e6b95b5b59ef49fb35b4b37390b1a162076e95cf89c2caae8a5646d4aaaa7d2e763e18bff00ecdd7a0b8b99c9895d8954e4e083818ef5e909e33d21ce374ebf58ebc6a0f0d6bb23031695780f62622bfa9abc9e0af12cbd6c9d7fdf957fc6950c2aa316b982ad6751dda3d7bfe12cd140cbde04ff007948a17c5de1f6ff0098b5a8ff0079f1fcebca93e1debf27de5b74ff007a5ff0aa7ae783b50d034f4bcbb9add91a411ed8d8939209ee07a56ea11ee65767bcc7224d12cb1b8747019594e4107bd3aa9690bb345b15f4b78c7fe3a2aed645051451400514514011cd3c36d119679638a31d5e460a07e26b2eefc53a2593aa4da8c3b997701192fc7fc073e959de3bd06ff5ed1520d3e2b49a5493734374ccaae31d8a91835e437be0ad5f4f04de783afc27fcf4d2ef7ccffc770c7f95007b0bf8f3414fbb3caffeec47fad5693e22e92bf721ba7fa281fd6bc3a516b68dcea9ad69cc3fe59df5892a3f107fa558b692eee1b6d9f88746b93d96663013ff007d851fad1a01ebb2fc4b807faad3646ff7e50bfd0d5393e255d9ff0055a7c2bfef396ff0af3a74f11db732e882e93fbd633aca3ff1d2d555f5f8e06db79637b6cddc49174a7a01e8b27c44d5dbee456c9ff0027fad567f1debcfd2e634ff007625fea2b88875fd2e6200bc4463d9c15fd48c55f8e5865198a7864ff72456fe4680362ff59bfd621f2750b869e2dc1bcb6036e47b74aad1416cbd20887d1055750c392a71f4a9e37a605e8d221d234ffbe45594c01c0154a37ab28d4c44cca18608047bd529f4eb39bfd6da4127fbd183fd2ae839a461401cedd7863459fef69b6ea7d625f2cffe3b8acc93c21a729cc2f790ff00b972e47ea4d75ceb55644a5603946f0e3c7feab54bb5ff00782b7f4a89b48d5e3e61d5e36f692df1fa86fe95d348b5011834b950ce7447e2780f0d6528ff00664653fa8a95752f12c3f7b4f66c7fcf3b853fcf15b9452e5417662ffc257ab5b9fdf69da82fb88b78fcc66a48fe21f9471299e33e9242c3fa56b52100f500fd697b38f61dd9043f11607c017717d0b62b421f1cc6e389636fa30acf96ced25ff5b6d03ffbf183fceb3ee344d01f996d6d53fdd3b3f91153ec623e66752be32c9ea0fe356a0f139bb905bc6b9793e515e753691e1b8f95bb684ffd33b93fe26b7fc0da658bea9717365a84f3f91111b6624a863d3b7d69c6845b0e7657f14196eb54b8b88a68d61853cb01b39c28c1edeb9ab5e1fd0cdcf85db7861249fbe1b064e49e38fa5675ee99a85d37d984407992052e5b1c679eb5d7691aad8db6a6fa579fb6e2241f26c24738c723f9574c526db919cb5562b6a6b369de15f2e46c34a56345ee0118fe42bacf869a68b6d126bd6187b87dabfee2f03f526b8cf15de1bdd46d6ca33b8c6bb8e3bb3702bd7748b05d3348b5b25e7c98c293ea7b9fcf3455765608a2ed1451581415e57f143c63a6472c1e1ffdefdad6e937b15c22e533c9cffb62bd52be77f89fe1ad4ae3e20dc6a2d66ff639a5455762155808d0707393ce474a6af7d04cfa434fc0d36d71d3c94fe42acd456d1f936b0c5fdc455fc854b4861451450014514500145145003248a39576c91a38f46506b98f10f827c357da65dcb2e8765e7ac2ecb2471046dc0120e5704d75550ddaefb29d3fbd1b0fd2803e55bfd3e2b4d4255b669210b1abaec7239201af4ed13c05e20bcd02cb51d33c61709f688839b7b9432203e9c93fcabcff00578c8d4c71f7adc7e9815ef7f0ee4f37c05a4b7a46cbf93b0a4079edf7803c6473e769de1bd507af922173f8a85fe75cdddf84eeacc9fed4f005fa63ac9a65d1603dff008c57d1b45303e582da0c52325beafae69922920a4f0eeda47625483fa55bb67bc93e5b1f17e9d3fa2dd831b1fc5d7fad47e2a40be2dd6548ff0097d9bff4335c9eb20431c6d1aaa92d8381d6803bfdfe2eb61b85859dea0ead6d2ac991ff00006a77fc25d3da61750d02f6dcf76073fa103f9d79525f4f11ca3907d4122bb0d22e75d92d925b5d6ae23c807634848a1cac3b5ceb62f1de8c7ef9b888fa3c5fe06b42dfc55a25ce366a11293da4ca7f3ae32e2f3c40f9fb4dbe9f7a3b9781371fc700d538eead52eedcea3e1b4589664691a0675ca03c8ea47228530e53d30df59b26e175015f5f30566dcebba5424abdec448ea14eefe55e757934b77753cedb8ab499c1ede9fa557d8dfdd3f95592773378a74b19daf23fd10ff5aa32f8aad7f82095beb815c9b657aa9fcaad697632eab3b451feef6e325fdf3fe14681a9b0fe2a73c476a3fe04f9aaafe27bd3f75215ff008093fd6ad47e1a9dadcbb5d80216e36a73dbbd735aacb1d8ea775684b3345215dfc0cfe14ae83534e4f116a4dd260bf4515524d5f5093ef5dcbf8363f956399d9fa5c63ea94dfdfb7dd991bfe05b7f9d174068c9733bfdf9a46fab13501258f726ab092e53f85bf0e68fb648bf787e6b45c09882bd548fc2ba68aee5d0bc10d3c5218ae2f660148383b7ff00d43f5ae6a0b969a548907ccec14007b9ad3f1ccc05e5969ab9f2eda1cb01ea7ffac3f5aa83dd899b3e14d7756d5b558e192fa69218d0b32962471c0ebef5d4db69206bcfa8bc3867c1628de9deb8bf04dcc7a4583dec90976b893cb5e7180bff00ebfd2bd0b51bc5834992e23e0ba145e7b9e3fad690b35664df5b15fc2d6835cf1aa4841312ca653feea741f9e3f3af67af3df85da67976b77a8b0fbc4431fd0727f98fcabd0ab2a8eecb414514540c2b82f88e3ccb9d161fef4adfa9515ded70be381e6788fc3b17f7a703f3751550dc4f63d2e8a28a91851451400514514005145437575058dacb75752ac5044a59dd8f0a3d68026a4719461ea2b9693e2068925bcafa6bcba8c91758e0420fe05b00fe1935cdb7c6bd1d217f374ad444ab9051421c7d492280387d76c36ead08c7fcb2913fef9723fa57ad7c35e3c09a7aff00777ffe844ff5af36d46eedb5396c2fad583c3399ca91eeee715e91f0d9b3e0cb61fdd665a480eb68a28a607ccfe324dbe33d647fd3dc87ff001e35c6eba316b19ff6ff00a5777e384dbe36d5c7fd3c31fcf9ae275f4ff4053e920fe468039be48ce38abf63abdd58616260547f09acf39a558f72bb7f740a2c07550f8a9b8f36061feeb035a30f892ce5c069361ff6c62b878e292e2454452cc7801475ab93e9f3da401e528149c6dde0907dc75152e087cccee12f6d2e07caf1b7d0d0d142fd315e7e36e47ca41f50715efbf07bc37a4ebde06925d52cd2e265bb7412313b800178c834b92c1cc79e9b28dba115a3a35a8b7b82c3bb28fd4d7ad5efc27d0a7c9b59eeed5bb0570ebf9119fd6b95d63c0f3785d619cdfadcc72cc88a3cbda473f53424d31dcc68ff00e3c2effdf3fc85715af692b3eb57726ce5a42735dd470b7f67de9f463ffa08acbd4ede7b6bf96496d655899b2b23210a47b1a6dd848e09f41f4245577d1a74fbae7f2aef01b793a814d6b385fa1153cec7ca79fb585d2760699fe9518c157c577eda6464718355a4d217190b4f9c5ca73be1b656d72192687222064c0519e3ff00d75d4df693a3ead7af732dc4f04d263716eddb8e0ff3aad6b622dae37edc6411534b5d34f58dc8968cdcb7d3b4eb7d160b0b6bc85fcb6c9762324e739c5335a91552ded63c151f39fe95cace71d2aff86c79da9c11b92ca678d707d3355cdaec23debc316074bf0e595b30c3f97bdffde6e4ff003c56be69838181466b9dbb963f3466999a5cd003f35c3f8a7f79e3bf0ca7a4e8dff9107f8576b9ae275df9fe2578793d36b7fe3c7fc2aa1b899e974514548c28a28a0028a28a002b37c41672ea3e1ed42d2050d34b6eeb1827196c71fae2b4a8a00f15d66e2ff402f1ea5a1225bc9732c914ad8dcfbb07ef29383dbf0af3bd66ef4dd4b529a6d40dcdbb39c2346aae853dc64127d4e6bea8bab4b7bdb7682ea08e785baa48a181fc0d79dfc4cf0469727826f27d2b44b717d6e032341161c2e46ec63af19a4b4d00f2fd3a51696d6d0d85dda6a10c6ece116731c8bb87236c807e84d7a4781bc67a4e83a30d3b5c69f4c9fcd664fb4c2c11813c618022b82b64f0b496d6765a4959c2c9ba51347890e557ef703386c8e2bb1f07f82edf59d0ef045a8ded93c77522048dc3c4573c6636041fd2803d4b4fd5b4ed563f334fbeb7ba4f58640d8fcaac4f710dac2d35c4d1c312fde79182a8fa935e41a87c2bd4ed499ed21b0bc9179596d5dacae07d3194fcc5606ac9e26b7d3dec354d435482d372b18f57b6f3e1254e4032a027a8f4a606478db5cd32e7c65a94d05dc6f13cdf2b0e41c0033f4e3ad725acde5b4d68f0c72879038fbbc8fcfa54b27862fa7d45ee8dafdbe0392574e995f1ee00c9007b8a6c8b6935b3590bf6b52303cbbd84ae31d832e7f5028039a20ab107822954b00c1790c306b465d12f541648c4f18192f6ee24007afca4e2b33ec3b5be498ab7a1e298892391ede64752430e415c822aedd5db5e0f3249647918827cc393d31d6a186250b8925955bd76075fe869cd0b74478e4ff75b07f238a0062a9760aa315eb1e01f154fe1ad39218c848646f3442cc4973dcfa735e5211ade4477474607237822bd6fe1df85a5f16d9c7704c2b696f26c798fdfe07dd03e87af4a181efb6b3add5a4370a0859635700fa119ae67c790f9ba659fb5dc5fab815d4c71ac51246830a8a140f402b0bc5a9bf4b83daee0ff00d1a9498cf3f8acbfe255ab9c7dc76ffd16a6bd47488c2e916f1919017041ae223880d2bc403fba49ff00c84b5ded90c59c607a524050bbf0b6857c4b5c69368cc7ab088293f88ac5bbf865e1db807ca4b8b56f58a527f46cd763451603cc6e7e1348a4fd8f58e3b2cd17f507fa5635efc38f125aae615b6bb1e914b83f9362bd9e8a5ca87767ceba9e8faae96aa750b09add4b60338e09f407a563cd5ec5f164ff00c486c47fd3d7fec8d5e39377ae8a6ad03393d4ce9eb4bc2633ad5a0f5ba8ff00f4215993d6b783c675db11eb791ffe8428ea07d0d9a5cd459a5cd62592668cd479a33401266b8bd44eff008afa2aff0076207ff43aec335c693e6fc60b15fee43ffb2b1feb551133d3a8a28a91851451400514514005145140051451401e37f10349b683c5526ac8ac2e03c30e01c295383d3d6b0bc19f11b53f0fc9796b77a54120927de6333886519f40dc37e75d5fc493b6fe7f67b77ffd0bfc2acfc3fb2b2d4df5ab5beb582e622d136c99030fba7d6901b963f137c3972e90decd369572c3222bf88c59f70df748f7cd75905c417902cb04b1cd0b8e1d18329fc45719aafc2ed16f222b612dc69bce7cb89bcc849f78df2bf962b90bcf873e24d09fcfd1a4df8eafa65c1b691bdda26cc67fe038a6061fc4cd3ed6d7c7373e44090e52371e50d9c91d78ae52ef52be584bcf38bc45c7eeef2359723d324647e75a7e253ac4ba986d5af41bef2d54c5a845f659768ce39fb8c3af3bb9ac2d445c5a5b017b693db890651dd728ff00eeb0e0fe140103cba2dc3877d326b197fbf6331c0f7daf9ffd0a992e8f05d3196d35a82e58ff00cb2bd53149f99e3ff1eaacbb5c65483f4a0c40f502ab94570b8d1ef2c903dd58dd4319e92c389233f43d3f5aa8620e408e6826f627637e4d5a16d3dd59b16b4b99a027af96e466af59ea48d790ff006ad85a5f41e62990bc7b1f6e79f9971fae69598ee8a569a3eb3241e64369749113804afcac7af7e0d74be17f0c6b57cce34ebc82cb550c4240d23db4b200324ab2f07e86ba6f16f8bad6c7cf8349b60d67f674d9191c07c6430fa67f4ae5b5a8b53d2e3b1bdb8bddd2dc422589e1ca328393d4742286e3f30d4e97fb67e2bf855f75cc17d736e9d567816e531fefa7cdfad6c68bf13aefc625f4dbcd3a082589e294c90c87071320c6d3c8ebeb5c2699f10fc61a54598f5ab99a139005caaca07e2c33fad575f12ebfaa5f6f6bb9a5b86eaf1c2a64c6e07a819c6714582e7b3a9ff41f122ffb24ff00e43ffeb5771612a496aa15d58af0c01ce0fbd7caf7ba96a626b882eef6f4cbbf6c88eecbbb1c7cc0ff005adfd0be1f788f5ad217c41e1fbd48646764f284ef14995f461c1fc714ad603e93a2be7b4d77e2b784016bd86f6e2d93ef7daa0f3e31f574e47e75b1a57c7d2595355d1323bc9672e7ff001d6ff1a00f6ca2b89d37e2cf83751c03aaada487aa5da1888fc4f1fad75f697d697f089acee61b888f4789c303f88a2c070df167fe407623fe9e7ff6535e37377af62f8b5ff206b0ff00af83ff00a09af1c9bbd6f0f8487b99d3d6cf82c67c41a78ffa7b43fa8ac59eb73c1033e22d3c7fd3c834ba81ef79a335c9f8ebc573784f4786f2082399e59847890900704e78fa55ff000b6af3eb7e1bb3d4ae163596752c446085fbc4719fa56259bbba9735106a375004b9ae334f3e67c653fec45ffb4bff00af5d7eeae3fc3ffbdf8c37adfdc84ffe80a2aa3d44cf53a28a2a46145145001451450014515c7c9e2dbe7bbbe8c69a61b3b7b86b6fb4a49e63923ab7978e83eb401d8515e3fabf8bbc556f2cd676fabc067689a7b4923811bce51d4608e0f5eb5c68bef1ff00897c4726849aedca5fa6e1240f30836ed1cf0bc53b01de7c50f96f263eb6f19fc8b7f8d4ff000be5ceb3aaa7f7a346fe42b89bff000eeb3e1ab196d35bba4b9b99a36943acad271951825803eb5d4fc2e97fe2a8bb5fef5a03fa8ff0a903d728a28a607847c660078cadf2010d62879ff7dc579fc52cd6c8df659e5873d551be56faaf435e87f1bc6cf13e9d27f7acf1f93b7f8d798c921fb3c9b7aed38a0074d756739db7763049281932da9f224c7b800aff00e3a29a6d6d9a3df65aa60f786fa3d87f075ca9fc71468b702cf4dbf8ae6d91fed4f1fef5bef2aae4903ea71f955f5468d4ae23fb394f9401fe7de8bbb87433668aeed23592eace4585ba4d1fef233f461c5323961987eee453ed9ab91c6d0316b7964849ebe5b119fa8aad753c4edb2eec61b83da541e5483f15e0fe20d5ea84591abdb5b2aa5e12df2ed5dbc9fc6b6f55bf3e26b4b28ede10bf658fcbc33804af63edf4ae424d3aca52b245752c2e3fe59dd212bf83aff502b461b9bab4894b5bb084365a6b522453f5c74acda57b8f5b16f57f0ceb7a1421b50b09a2b79002930f9a339e8430e2a4f02dc41a6f889e6ba99228de0640ee7033b9481fa57a1f887c5ba2eb5f08d74bd33578a6bf822884b03fc9210b80d80d8ce3dbb0acc8e2f01789b42b6b4b1827b3d6e0b44decaa543b2a8dc4f507904e7826a8471de259e2baf13ea534122c913dc31475390c33d41ad2d1fc2be317b01abe851deac5b8a96b3badaf91ea99e6b66dfe1cdb7da3528e5d42561691875db181bb3bbaf27fbbfad7b2782349b6d1bc2b696d6a6428c3cd2646c9cb75a2e078bdb7c52f1c786a6fb2eaa16e4aff00cb2d46d8c32e3fde18cfd4e6b46f7e2378735ed22e25d5bc150b5e6309202ac8cdeee30c3f0af72bab2b5be88c5776d0cf19fe195030fd6bcc7c7bf0d6c12cd352f0f69b15bcd149baea388950f1f7217a647b7bd2b8cf15b41a76a1a925bddffc4b2c24724bc40b88b8eb862491ed9a596d0697aa88f43d724b904fcb2d9472c6e7fe03ff00d7a4d4acae25d55e1b5b6964738da891924fe02bd1be1b7896c7c06b7b65e25b0bdd3e6b991648e492d9800b8c60e79fd29a7d44734353f144bb34fd7e7d41e254f3a04be8f6b75c6464648eb504d5d67c40d6f4dd77c5905d6977b15d422c554b467383bcf07d0d725356f1f8497b99b3d6ff0081067c49603fe9b13fa1ae7e7ae8bc0033e27b01fedb9ffc70d401d27c697ff8a6ec17d6ebff006535d478046df02e903fe98e7f535c9fc6347b8d2b4b8108dcd70c79381c2d75de0b1b3c19a4a820e2dd7383deb32ce8b3466a3dd46ea40499ae53c1bfbdf8abacbff76071ff008f20ae9f75733e001e67c43f104be88c3f371fe154b66267a8d14515230a28a2800a28a2800af3af167823537966d4343b991e592669a4b72db7938fba7f0ef5e8b450078049e0ef175cfda2eee3423760904891c4730206328c0e7f0391ed58ba4de2d9f89a0f1069d78c6fe172b2c3a9b15dc71b4af9a3e53c7aedafa66bc86e34cf107802692082db4fd4bc3d7fa92e639222f22f9879047b01d79fd69a039ff1578be7d76e986a7a7ff664a91797146cc5b78241c86c007a76ad6f85d27fc560467efd97f23573c7be1ab3d03c993485f221b812192d241e6c04819e11b217f0c63b570fa25dcba55fa5ee97e7e9d7c232ca614373032770c872ca3dc671480fa528af30d27e2acd0c0afaf69c1edfa7dbf4d3e6c5ff00035fbc87ebf9577ba46bfa4ebd6c2e34bbf82e50f508df32fd4751f8d007917c774c6a9a349fde8641f930ff001af2a84e5c0f535eb9f1e97e7d09fda71ffa0578fc2dfbc5fad00696d18c606298cf1c2bc9014536e2e1608cb13cd7357f7b24ec403c7a568dd893a25bdb76fbae0fd066849ade66e080de87ad72d6e72ca80904f079a991e69253b033907207534b982c755b148c1008aef7e1d780f45f14e9fa935d89e1b8864411cd6d29465041cf1d0f4f4af28b7d466894172597b8c7f5af77f81f7092d96ac54fde788807a9e1a87aa0463ebff047510a5b4cbcb5d413fb9749e54a3e8ebc1fc715cfe85e14d57c39af6350d2ef2d0082601dc7991b657a09071f857d25587e2f38f0cdd9ff0066a0a3854902ea3adee20036c8493f592bbbf095cc575e18b2789d5c08c29c1e847515e7a02cba96a91b80caf6aa083df97aeefc0d6f0db7842c160408ac81ce3b923934901d153648d268da39115d1c619586411e869d4530238e0861004712260051b540e07414dbab3b6bd84c3776f14f11ea92a061f91a9a8a00f1cf88be13d13c3ef6b79a558adacb74ceb2ac64ec38c1185e83af6af3b9ebd77e2e9ff44d287fb727f25af219eb78fc243dcce9eba4f87a33e27b2f6f30ff00e38d5cd4f5d37c3cff009196d4fa2c9ffa09a8633b2f883e1ebbd7ad6c9ad8c3e5da33c928909e576f60073d2b43c0b1c50784ad2389cb8190491df3ce3dab7c9c8c1aab6166b602748c8f29e53222018d99ea3f3c9fc6b328bd9a3351e6977500499ae7be1a0dfe2cf124be8c07e6edfe15bbbab0be14fcfaaf88e4fef4cbff00a13d35b311e9f4514521851451400514514005145140051451401c27c4e8b769d64f8e8f22fe69ff00d6ae0fe1f36cf19e907b14953ff1dffeb57a37c475ce836ede972a3f35615e2e9a85de91026a1632797756fe618df00e0e4f63480f75d67c11a26af21b930b595e0ff97ab36f29ff001c70df8835e53e29f0fc3e1bbb6bd9754b194af227b2b95b4bc1ee501daff8004d79e6a5e27f136bb295bcd52fae377fcb31210bf828e3f4a974ef02789f5861f66d1ef1c37f1bc6517fefa6c0fd6aac1736b5cd4759f1759db449aac5abad9ee31aba88ae70d8ce54fdfe83a126b8a9a49ed6629242d148a795704107e95e91a6fc0ff13ca55ae25b4b4ff7a5dc47fdf20ff3ab92f83ef5341d6daeaf61d41345959258af6dd80640a1bf77267703d78e9d0f7a40795ba5dde32911cb20239da9800d357c3d7d20cb2227fbcdfe15bf0bd8dc2a3e997cf665bfe5def7e68f3e8b20e9f881f5a9a6b99ec485d46d5e107812a7cf1b7b861c1ad23caf725dce565f0fdd45c9909c7751551ed66b73904ba8ea31cd77a9247326e8dd5d7d54e6a37b681b978d4fd455382e82b9c6c3bee502448ecdd3006715d9e9c66d3ede1114af1ca8bf7a362a41fa8a558d2218440a3d852134d46c17b9d9e93f13bc41a6058e7952fa25ed38f9b1fef0e7f3cd75377f11b4cf126873d88826b6bd742446df329c0c9c30f6f502bc7cb55dd19b1aac7fee49ff00a0354ca2ac34cf4089bfe26d7bef6e3f9b7f8d7a0f81db7783f4e3ff004c97f90af3789ffe26971ef00fe749a57c4c97c2f159e9d3d825cd98b78db7236d91495e7d8fd38ac52b94cf6aa2b92d17e24f8675a611a5f0b59cff00cb3ba1e5e7e87a1fcebab4759103a30653d083906980eaa9a86a963a4dbf9f7f770db459c069180c9f41eb56ebe71f8dba9473ebb188efda7203279382a200a7047b9273cd2b81da7c4cd6b4cd62db4d6d3afa0ba11bca1c44e095385ea3b57984f58de152c45d923fbbfd6b627ae88fc243dcce9eba8f877ff231c1ed1c87f4ae5a7aeabe1cff00c8c49ed13d431a3d7334b9a6668cd6650fcd19a666973400ecd62fc20f9ffb724fef4ebffb356bb36149f41593f060674ad564fef5c28ffc77ff00af4d6cc47a75145148614514500145145001451450014514500729f1097778601feedcc47ff1ec7f5af23d12dedee359d3ad6e5124864bc08f1b746527907f3afa02f2cadb50b66b6bb812685baa38c8fafd6b91f085b69f69e29f11d9da69cd6e2196228cf1f6d80704f3c9527df39a00ea2cb47d334d4d963a7dadb2fa430aaff215768a28019299042e615569003b558e013db26bc83c6fe19f18cfa06b6e8d1496f772a5ccd6f6e4ef2c00560bea3685ebe95ec545007c97e07f095d6bbe2eb4b73a7dc359c73ab4be6c640080e5b77e031f8d7bceadf0b347b912c9a44b269533f548c6f818ff00b511e08fa62bba0a074007d052d007cf3ab7c2dd5b4cb95924b611a33806fb4e398d013d6488f2077c8e056aeb5a4685e1d8c58dd1864b98a35b8f3dc921c7f74f6e71d315ee0e8b2232380cac3041ee2be7af1bf84f528b54bc86e2299a06c98e61ca941d39f50074a69b40ccbd575ed33523145630c7185c8c940ac7278fc318fd6b299d5582bb84e704b76a6ebb0a5bc1671a47182a83255403902b1f21a22e58f983aa9efef9aa8cdb57138d8d137484e172c7d16920d4a4b6b81344abb80206ef7047f5accb59b75c2e494c72a41c106b6f4c0bfda90923716639279ce41a776d082e35fd4a77767b992276503110db91fceb3fccdd93cfe2735a9e27ff0090cb1f58d3f9563b0298cf719a988d8135aba478b35cd01f3a6ea53c2bde3ddb90ff00c04f158ccd519354c47af687f1cee62c45ae69c938ff009ed6c76b7e2a783f8115ca78c74db1f19eb72eabe1cbe8266b83b9ec2e5c432a31ebb7710ac33cf07bd7125a9a4d4d8773b087c19ab784ed23975585206bdc98e212076017b9c6473bbd6ab4f55f47bcba9edde09ae25921871e5a3b921339ce01e99c0fcaa79cd6abe125ee674f5d67c38ff91833e903ff00315c94e6badf871ff21d7f681bf98acd8d1eadba8dd51efa37d41449ba973516ea766801978fe5d8dc3ff76363fa555f82ebff0014d5fbfadde3f245ff001a8f5ebc82cf41be9a799225103805d80c9da702acfc1800f836790721ef1883ea36253e823d168a28a430a28a2800a28a2800a28a2800a28a280239fcdfb3c9e46cf3b69d9bfeeeeed9f6af3db6d17c66be2b3a8c4c96c27da2ede4955e39141e02a8e781d33ea6bd1a8a0028a28a0028a28a0028a28a0029080c304023d0d2d1401cb6b9f0f3c39afdcadc5dd9b47283cb40e63ddf502bcebe237c34d13c3be19b8d674c6ba8de2641e4b387420903b8c8ebeb5edd54f54d32cf59d327d3afe1135acebb5d0f7eff009e79a00f9ca1f867a8ea7a7dbdde917ba76a2f2c0b31b78a70b2a6467041f4e9d6b127d1b5ad12fe1b5bbb39ece776c466542013ec7a7e55ed9a2fc308fc39e3fb3d5b4a2a9a6436ecaeb2ca5a4672a578e3a722bb0f14c2937867500e8adb612c370ce08e41fad3b8ac7cf56de1a6babb53a85dbc859371da79edc64fd6b135ab586cee2148576868433739c9c91fd2bbab53fe950fbc1fd16b93f12e93a9cab1ea5059cf25947108de645dcaac198e0e3a7045098da39c26985a99e6e473f98a4273d39a62149a4cd373499a00dbd08fcb71ff0001feb5766359fa21c473fd47f5ab73356abe127a94a63cd75df0e8e35a94fa5b9fe62b8e98f35d6fc3c6c6af39ff00a61ffb30acd8d1ea3e6526faade652892a0a2d07a786aaaaf52ab500707f171679740b648338deecd804e46318fd7f4af40f8296c6dfe1cdb925b324f23fcdd4745ffd96b9df166a9651685796cd75109de3dab1eecb13f4aecbe152edf87ba79c63734a7ebfbc6a7d047674514521851451400514514005145140051451400514514005145140051451400514514005145140051451400566f8806ef0f6a03fe9ddff009569550d6c6742bf1ff4c1ff0091a00f0fb43fbfb7ff00ae03f92d7a37c35ff9015c83ff003dcd79c59ffadb5ffaf71fc857a0f802eadecbc39793dd4f1c30a4edb9e460aa3f134805f137c30f0df8803c82dbec376dcf9f6a02e4fbaf43fcfdebc7fc47f0a3c41a2132da20d4ad873bedfefafd53afe59af53d7fe2f786f4bdd1da4926a33fa403083eac7fa66bcc35ff008bbe21d5098ec8c7a741ff004c865cfd58ff00402a80e05f7c4ec92a15753860c3041f7a8da551d39ae8b4df0978abc5f706e6d6c2eaeccadf35cca70a4ffbedc1aeb2f3e02f8920d2c5c4377657374396b64620ff00c0588009fae2988e234290b4539f7157666acbbbb0d57c3578d6b7d693da4c7929326370f51ea3dc5397525946245da7d474ab5256b09a1d29aeb7e1f36352b93ff4c3fa8ae3dd83720e4569e87ae49a24934b142b23c88146e3c0e7352c67afefaa379aee9ba7922e6f23461fc20e5bf21cd7965ff8af52bc2c25bc6553ff002ce2f947e9fd6b15aed8fdd5c7b9a9b01e9779f10e24cad8da33fa3cc703f215cbea1e31d4ef77096f9954ff00cb387e51f4e3fa9ac5d3349d575eb836fa759dc5dc8392b121217ebd87e35e8fa0fc0cd6ef5565d5eee1d3e33ff2cd7f7927e9c0fccd3d101e6af7ae7ee803dcf35f527c364d9f0ef45c800980b1c7bb13fd6b8af871f0f34949f5b4d52cedafcda5eb5b44f2a9270bd78ce3b8edeb5eb90c315bc290c11a47120daa8830147a0149bb80fa28a290c28a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a002a96ae33a35e8ff00a60ffc8d5daaba98dda55d8eb985ff0091a00f09b4e26b6ffae3fe15cfeb5a3eafae5fdbda69967737402b1291292aa77b727b0fa9adb8ae22864b5779142b2155e7a9f41eb5ea9f0eed2e6d748ba3736b3db99272ca268ca12bd8e0f3de840799685f03356bc559759bd8ac50ff00cb28c79927e3d87e66bd3341f85fe15d0511934f5bbb85ff0096f77fbc627e9f747e02bb2a28011542a85500003000ed4b4514014f52d274fd62d4db6a3670dd427f82540c07d3d2bca7c4df026c6e3ceb9f0f5db5ac982c2d66cbc64fa06ea3f1cd7b151401f134a935a5ccd6d323c53c2e639237182ac3a834c0ef249b3249270057bb7c6af0ccb3cd06b10db06b768ca5c3a2f2ae3eeb311ec719f6af1fd1bc3b79e22f11269d656d33c8c548645f950646589f4a7711d9787fe0af89756092df1874db73ce653b9c8f651fd48a350f82fe27b3d79edece24bdb0ff009653ee54cffbc09e315f48411f930471673b142e7e82a4a5719cdf81bc2e3c25e18834e631bdcf2f3c918e19cfbf52074ad9d4b54b1d22d0dd6a1731dbc20e37b9c73e9ef56eb375bd0b4ef1169cd63a9c1e7404e40c9054fa82280395f875ac58df7f6e4d04c0a5c6a9249131180e180c633df8e95de5735a1781f4af0f47e559c97461de1fcb9241b720e41e00cd74b4005145140051451400514514005145140051451400514514005145140051451400514514005145140051451400514545733adadacb70e18ac485c851924019e0500703e2ff000ed8c9e35f0d5cc082dee27b821de150a4ed1bb3c77ed5e875e47af78bafae6e34cf10c7650adad8dc388e23302ef9186c8c7a7e5ef5e93a0eb76de21d2a3bfb5575463b591c72ac3a8fd68b3034e8a28a0028a28a0028a28a00e5bc63e33b2f0cc2b6d2412dcdedcc6c61851783dbe627b67ea6b1fe1b6a36369a341a6dc40b67a83cd2261902998824f5ee403d0fa5763abe87a66bb6eb06a5689708a72a4e4329f50c391f8567699e09d0348be5bdb5b3637299d924b33c8573d480c4807de9e8074345145200a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a08c8c1a28a00c1b8f05786eeae0cf368f6c642727682a09f700806b66dad60b3b7582da18e18506152350aa3f0152d140051451400514514005145140051451400514514005145140051451400514514005145140051451401fffd90d0a656e6473747265616d0d656e646f626a0d32352030206f626a0d3c3c2f42697473506572436f6d706f6e656e742038202f436f6c6f725370616365202f446576696365524742202f46696c746572202f4443544465636f6465202f486569676874203730202f4c656e6774682032373730202f53756274797065202f496d616765202f54797065202f584f626a656374202f5769647468203130373e3e0d0a73747265616d0d0affd8ffe000104a46494600010100000100010000ffdb004300080606070605080707070909080a0c140d0c0b0b0c1912130f141d1a1f1e1d1a1c1c20242e2720222c231c1c2837292c30313434341f27393d38323c2e333432ffdb0043010909090c0b0c180d0d1832211c213232323232323232323232323232323232323232323232323232323232323232323232323232323232323232323232323232ffc00011080046006b03012200021101031101ffc4001f0000010501010101010100000000000000000102030405060708090a0bffc400b5100002010303020403050504040000017d01020300041105122131410613516107227114328191a1082342b1c11552d1f02433627282090a161718191a25262728292a3435363738393a434445464748494a535455565758595a636465666768696a737475767778797a838485868788898a92939495969798999aa2a3a4a5a6a7a8a9aab2b3b4b5b6b7b8b9bac2c3c4c5c6c7c8c9cad2d3d4d5d6d7d8d9dae1e2e3e4e5e6e7e8e9eaf1f2f3f4f5f6f7f8f9faffc4001f0100030101010101010101010000000000000102030405060708090a0bffc400b51100020102040403040705040400010277000102031104052131061241510761711322328108144291a1b1c109233352f0156272d10a162434e125f11718191a262728292a35363738393a434445464748494a535455565758595a636465666768696a737475767778797a82838485868788898a92939495969798999aa2a3a4a5a6a7a8a9aab2b3b4b5b6b7b8b9bac2c3c4c5c6c7c8c9cad2d3d4d5d6d7d8d9dae2e3e4e5e6e7e8e9eaf2f3f4f5f6f7f8f9faffda000c03010002110311003f00f7fa28a2800a2b335ed524d174993504b5fb4ac254c881c29084e0904f1c673cf6cd416fe28d3a4996dee8c9a7dcb7021bc5f2cb1ff65beeb7fc049a87520a5cadea6f1c3559c3da46375e5e5e5bfe06c48eb146d239c2a82c4fa0154745d62d75ed2a1d42d18f9720e55bef2377523d4557f154ed078575268cfef1e06890ff00b4ff002afeac2b32780f86e74d4ecd19ad046b1df40a33945181281fde51d7d57e82b9eb62952ab184b666d470f0a946ff0069bb2eda2d57cefa79e9d4eae8a624d14902ce922b44ca1d5c1e0ae339cfa5721aa6b9a85e40fa9e98e63d2ac1c4acfb72d78aac3785f440bbb9fe23edd76ab5e1495e4cca861a75a5cab4f37dfa2f56f4b7e899d95148acae81d482ac3208ee2aa5feada7e9681afaf218377dd0ee0337d0753f8568da4aecc63094e5cb15765ca2b2f47d76db5c6b936715c08addc466496231866c64800f3c0c7503a8ad4a232525743a94e74e5c935661451453202a95c6b1a6da5dada5cdf5bc170cbb96396408587a8cf5fc2aed62789345fed4b58ee208a27beb425e012805641fc51b67f85871ec707b545472516e2aecdb0f1a72a8a355d93ebf96fd3b9ad3450deda490c8164826428c3a8652306b9dd1145c6952e95a8224f2d8c86d6659543070b8d8c41ebb90a9fc4d41a7e8fa1ea36697b616d258b3e430b591edda37070cac108190720835774ed13fb3b51b8bc17f77706e235475b8656fbb9da72003d091ce7f4af0f158a8d78ad2cd1dbcb4e94274f99dd6a935669ad374dadbf245793c2d699892dae2eadad9268e56b4493742fb18301b5b3b7903eee2b77ad725e28f12de683af69aa91f9960d1bc976a172ca80a8dc3bf1bb3599a878b3504b092686f63890eb8d64b32c1e6ed8766410a3ef1efc75ae37cd2b5d9d4b038bc4c21293ba7b3f56f7d2f7f77cddac6f7fc23d705db4efb585d00b79bf655043927ac59ed1679c75e71d2b7cc31b406028be515d9b31c6dc6318f4ae2c6bd7f6f656d7abab7dbadff00b42282e0bd81b7d91b70786e4f2579acf1e36d55a1d548f2b74db5b49f907cc8663173ebd8d394a52b5dec692c062ebf55a7cb5ba4dbd37d9b6f5b2b9d459e89aa2d8c36575ae4c2da0411a25a2089994703739cb138f4db45dda58f87ed0cba758c4751b8610c0cf9692491ba6e739620724f3d01ade50422866dcc072718cd73f39d54789cde0d20dcdbdb45e5da1370883737df723939e8a38e99f5ad233756695496872d2ad3ab37ccd5b56d6914fcba5eef7bf4b9d0693a747a4e990d9a31728099246eb23939663ee4926aed727a8f89f56d3d13cdd26c92490e2288df33c921f454588926b6345b8d62eadbcfd5acedecd987cb04721765ff0078f4fc067eb5efd2ad4e7eed3e87257c3565175ea35abeeb5f44bfe197e06a514515b9c6158971e2ad3d2ee6b3b54b9bfbb84e2486d622db0ffb4c70a3f135b7599a968569a948b7077dbdea0c477701db22fb67f887b1c8f6aceafb4e5fdddafe66f877479bf7c9dbcbf5eb6f4d4c9d36df52feddb9bf7b38ac6cee50192dccfe63b4a380f8036a923838273815bb58df6ed4349b882db578d668a790430dedbae0331e81d3aa93ea323e95b35f375d4d547ed1599d389e6725276b5b4b6cd2d3d7c9df5ee66dde8d05e6af05fccc584504901888055d5f19cfe55870f80e0b4d2e3b1b3d42783c9bff00b74526c5628db7685e78207bd75d4565763a78dc4534a31969a7e17b7e6fef3027f0edc5fe8d7ba6ea7abcd78972142bb431a188839c8da0679c75f4a85fc1760cfa13091c7f640013007ef7182377e233f8d74b45176358ec44748cacb57a596eb95e8976d3fe0852302c84062a48c061d47bf34b59fae5cdd59687797564a8d710c464512296040e4f008cf19ef41cf4e0e73515bb76326c6d2f7c377735d4d687571293bef63ff8fa55fee95270547a211feed74da76ad63aac4d2595ca4a14e1d7a321f4653ca9f622b222b7f124b124b1ea1a3c91ba865616920c82383feb2a95f78735bbe956e1e5d2a3bb4184ba81258a55ff008106e47b1c8f6af6b0ef134928ca175f23b6a4695777ad38a9774dfe31b7e56f43b0a2b1f448b5fb78fcad66e2caeb0389e10c8e7fde5c60fd463e95b15e945dd5ec799569fb3938a69f9adbf40a28a29999c7eafad59378be2b595de43a745e62dbc31b4923cd20c0c2a827e54cf3d3e7abab2ebfa87fc7ad8c3a7447fe5adeb6f931ed1a1c7e6c3e95bf1c1144ced1c488d21dce55402c7d4fad495c52c142a5473a8ee774b150518a843656d75f5d345abef7397b2d7638348126ab3a25d432bdb4a1579924538f954724b0c3003b1ab5a6eae2fe79ede5b49ecee22dafe4ce00668dbeebe013c1c118ea08e6b422d1b4e83549f538ed2317b3637cc465ba01c7a70074eb8aa9aee8f717ed05d69d7296ba8404a2cccbb818db86523bf661eea3deb92796b516e2f5e85fb4c3549b4972dfabd93ed65d3757df6b2d0ab71e22b4b6d4bec8e921890849ae80fdd43237dd463d89fd3233d455cd52fd34cd32e2f5d0bf949908bd5dba051ee4903f1ab167a3d959e95fd9cb1092065225f37e63296fbccdea4f39ac03a3ea516a761a5306b8d1e39c5cacecd9645404ac4deb87d841ee073c8c98a9974a3cb6d6fb954d61aa4b4d1477bbf892edd9f9766adaa66ae9daa5bea51bf97be39a23b668251b6489bd187f5e87b563e9163ab6a36d751cde21b913dbdc496f2c6d6f0b2e01ca9fb80e0a153f8d6e6aba2477f225d4129b4d462188ee631938feeb0fe25f63f860f3585a56a17369e35365a85b1b6b8bfb7f9b6e4c52c9174746f742720f2360cf626e18354ab253578b34a2d4a9ce5437b5ecd26d5b7b5d6aacf75aab6bdce9748b03a56916b606769c5bc6231230c120703f4c0abb4515eba5656479539b9c9ca5bbd428a28a648514514005145140051451400514514005472c114e6332c6ae6360e848e558771e945140d36b544945145020a28a2803ffd90d0a656e6473747265616d0d656e646f626a0d362030206f626a0d3c3c2f436f6e74656e7473203720302052202f4d65646961426f78205b302030203539352e3235203834312e38355d202f506172656e74203220302052202f5265736f7572636573203c3c2f457874475374617465203c3c2f4753382038203020523e3e202f466f6e74203c3c2f4654313420313420302052202f4654313920313920302052202f4654392039203020523e3e202f584f626a656374203c3c2f494d323420323420302052202f494d3235203235203020523e3e3e3e202f54797065202f506167653e3e0d656e646f626a0d372030206f626a0d3c3c2f46696c746572202f466c6174654465636f6465202f4c656e67746820363536393e3e0d0a73747265616d0d0a789ce53ddb0a25396eef81fe87f33c905a5fe41b8485e9b92c09ec4392867cc09259589884d93ce4f723d9752e96aae4529fee998130ccf6f459ab2cc9badab2fccb077f73f8cf3fd21f15fc56d3ed2f3f7ff8e543281b845b8c9bafb7046e8bf956aadf62b8fdfd3f3ffcc737b7ffc2316e830ab7f1bfa9c11652c46fb8ad417b1915ea96f22d02c1a6e8b60cb718f0bbf93166a0f0f7bfe2e03ffce9dfebedafff4340000434604abe05bf953ef94fdf7cf8570441a02d1f01795fb7166e3e87cd230519d17b803dc7fae6a6c191fe381b1c1322f2189ce3e940f08526dd07a6b0e57a3e3637fabff7b138aa7522711e3936b9bc25f6ddb3b1f7efe24238d8bfeb132de0f977c7d8f1dd792c31da1faf8d27d07d7510a83d81c63fbfae108d31a93c852685424cca2e3e06b9dbff7e08b73fe3bfff82fffe6da7eedffef4e1e3a727a57ff8f153bb8173b74f3f3d6846fe843a3465fc678c752bc913cf1a62fce9e70fffe45cf8f8c74f7fbb8546e33e7d8f3f40ed3f84f8f801d80fa9e00ffff0c327c2404e826249e84f93b8a842e4adb83643c4d827cdf93169a21f7ccaa778a67cf4c3e9acad6cd58427b2776b1ccf50399e1f3916831248e78873d23a836f3ec2254a00102192d689921f5588bc215e16daa191e01a4907be2252b6c40f9a6c41452c7cb1e0dd026a6760b2f51d473cb0254a95ff909449129ab8508201ad843a0e8e11121b430b3a9edebbdb9984cb118212bfa3f1db58386ebc5ce7c2305eeeee42d17879585a2f0f652b3edd4aa1e976962566bc24fd5c95a43513daf79db272be468c37e28485bad4be766f368d6fdaf8963ab7af4fd06a5f428d2d424e2071a3c47f3897a4232442a4c5a9d7b10e284c9c8fb170a43eda4da7a31f624aa7eb0d9a650c35a18501031d95b8bfa043fa2e21849e8308556f5c900f7971eaee504b5d29d7098bb8a201e3c289b0c15c4599a4c5174b284c1627bd13768a56459319b2810ed43f17191d1ded88d49ddafbcfb02362c475e34c43fc8b59f44fb3888a4266510a5edb80c27617508ff2dd25ffd8a7042668af914417c5f644f25b0ea1711f4d7043d879d28503de5a14683636e9e0cceb0f0ccda1d6c1c339615ae050220abf09ef923627d83b14fb95591f8fb8a7f17b4d886a9fbcc3e4207a0b25de45f4d26d458a100cc160cf2132c7bc2f6b693a334ef18c1e13ba68222de2d05839699dc5beb573160bccc53a76ddcde59478554d7c761bbae533520e83a0838f84cd3bfe918f419d17736d389df710a4a01fae99b37038acf2346e5c41bb94be304897da3d68b2e0858eb8640e326cec53c2d230b1e1b94ed1b44eadf5f49be1a50608a8809039bff4100115101cb73ec2060a8e1e5ab857f54a2be3a3265301f3801cb85dd02941a79332e7d7175e9400c8ae924c78414267288445c8ec770699c5187c8b42fd74341286eec06563ed23d62bbdb446df6a68150c158ac967844af929970d61f0e54a8b119c12e1129c16bb39c060cf8479741913112ea2dc331dc71ba7dff409dd8c30132a1a1ef321290a82fa3da877e7fcd1b2ae88497c30694a8c89d2f32f23a1a79360d02756cdffa04124daf334056811f533790ef239119a96eec7dc0e545a47acf8cd27be2aeb405ccf7a501f0b0f4717790f9a51be08523feb2af0e10a2c6229e185b81f53130a87fc75a6c8003cf25784e6ef693804b70591a6e868040ccf96aef0d70aaa5f330c3ee75bce0330944d26f9078c5b41e41b828c55b4a3635560cbc22fa85bde659c1a19e8287503111fc9d4811122058f6b903dd7d05891c8478a4059e5059da0559b3549ae6e95335cf0425813219b4b6bb2e2857a1292d0bba1b336f182b6b96ca9c97de7c5f7c3c49d15d762f16984f8e13d39485b237bf48a954e79d96ac80c40958186191930bad72260cfb58506693110e6892d58e8ae65047397e9ae6d8472af00924cb1afc325e2d0e16b96e4d0449ea6b2be6e3106031f3cf93c8a102e33c293cb4bde2cf9dc426ab1a3a7a3f0c6e9d037813286101caba5a35573630fc84d0f162c92eb078d33164b8d5eda009120f01c56ece38988ceb6c15803fed92c9463a0d93253284998085b845de094f19d69fd000a7d9a3399b3e00ae2cdd6586c5598a3a92f9cbb5386579858f91746ec8704be1e1e1234f4dab4591531ca0e8fd30fb11d33507c9c86ec463d04461337f23c06ad173778eedb24135661484caa4c625eb0e068493c391a8cb07d75c5f6045fdd2740383223e7995fdb3cd9ae9930fe4d3ea7a053db1201aa64f27c8e7dcbbba653c4419c4ef16955b340152339f169172523e49122c7d4b3654eda863624dacde1d37a6d11a0c45e4545c709a875fbac95cfea8fadcfbc4ae77528692b09e639746660d491a031ac8e8dcdb9fc0a8157f58c62f64458069c1b2dd8c549a5ccefe7293c40fb5a6a9470b15b6d0c6f3d34a52a50da00b691fa267f7d1b0114661df97918fd5103d9eb7e6610afed40a5005badc041540606cc75bbd99f40b4f091aa77fae1db0ca259a21403c65dcd440b0dad02315d18ca069533d9f385f2ba7450859258280d539c1259885c070cfe5b3e33233133090b9ad9a07589c4b1373e4afebe9dfa7bdf48be90c1c56fad15e61d9e41241c7bd297faa08f7c445715e006f4a2aa605ed44b1467bcf4f0cc93e9074ecaeec69eb6681c41b82762d1841855ad253689ff5e85081b0067f174b62b2a390e3e02c374ccc4a523df287cf4cb2ae8275840a727cdc47474f3257c75a667d7f59021a6d292c348c80cb464d8bce3e4c7c1d2c24a28afb214bf559d0d0d8c47b8b48c9a6b2dd6151a3a5c6c36e8a39a565091216dbb1b56a0651c6a53614c3f328710c6281d06a2afa42d481f5bcb399d7e50f2869bbb2577b922ca4f0a937a67e6c56a8f87e56e5bce97821edfe2d8f8b080405f0a130846fea5da403047a172abeb20c1b92dd0a1810504c52a99c8a74a8cbe956701495b32318cf61562364ed230fab2cde2dd562960b3800434bba69524bfdd0db501226f9eb6e02d20058303db4262e85d6cda1230f48ed5467d88bd04d6049236e76c2b89516175b695a44d806a53300c74828d7a0c745cb1ad6444fd326a0bc6e429d9788c294104232d6df3c536cb5ea06e024105039b11c3180dc0b69218a3052344196534169036ca680c20095326a3b6a4b8f966a325c1d81cb080e4b1396001c1c8c5d966c1a036182150c1aacd88e5b8d56a5bc98c496fb1ad6446054b3605cba860c9b692655c2732818451fd6c0141050b362697dcabaa2c1015fdb7711254b0605b16da93083639ae11d326db4a561be91533c66604a95b6ab6556c0e9db78dc10db52bdb48c780ba369b056bb4a3655bc6463b5ab6656c74fbd2a45d912eab9a18165d40e76d5a49aacf8468a29eea33832da48cae8eb4c202d2d079db66a113b6685a96e851bb6c369f4a49bdcd7b478ca86d42891a8fdecba46031a082d912c348d50046c430a0aeb6c43062409d6d8961a40baecdb692a161746c9b05036a23c330a02eb6c4906eeda56c5bc998d1791b114305b325861103ea1a6d2b097edc37b08090fbb2910fa860b6cc3062406d1417a8e8bc6d9324374e7e2c2061dfa43b04f96d1a56500f9244bb2e74884fee95da3d509658292b29f68bdf8fc38cf3b61598258c9d4703ebd266f3fda832e3d68905048d46b14967f61894d80407b38462cb766346ab61cb76a90747cc36f1cc1545c3a6379825545bb64bd5f4c6c8a7440c4a6c2b5952ef2b610241a361cb76236609c5d956b2a2b619a3a58a56c396edc60a9bb365bbb1a6fd20c40052369be45772ca36fd6abedf72378184510c6d01815158610141fdb225bbb1a17e15db42629ed06cc112d0856293b2005d67b425bbe0d27edc6900291893985612304f28b66417bc1b97882c20611ce25b40c881d9c8c73ca1d8125eeae3650b15c137eb99130454305bbe4b1765aa2ddf8500d63327a0da0a232975dcd3b28034eb9113446f3d72028ce510391b481ad5c71690623d7302cc138c674e00d4d3cca660108c674e00603d73024c138a2d7d03a0da322362cd7ae604c95bcf9c00f3846a4b6020a182d9f25d2ac5349e3941aac6332748e4c06c0a8621b5f1cc093067319e39414605b3e5bb9051c16cf92e60486d3c7382e2ac674e5050c18c93a082d9f25dcca5ac674e508a76e6f4bb6f60b6ca631f251e180817e777faeec55573e9945ae6be17e789cb2de7d5ccf213a7e52a87fbcf81fa997886b9be658d8142ab82d8f8c7c3cb294a09bf18c0ab9165fdfcb2c05ebb0a8c6eb477a39c117f2d09d44b30e980b26413af1e82d11246a367ac1a9ce145d64a05d8172e19bb578fbc22a98b80a7d3016064f55b3dc4bcb36aaeb222432bb00ebdb52b9b7359cf99b285ac7bede63405c7daabad57c0a33e2536e958dfc7c521b5909c3a9e648104d715f943e23fa894a237ee97165e2749e2aa8956244e87bc9ece2c274abf9b25d96b5740a87e9202b589d0c6c9507955d1ec077887db15bd7fa82b6e7fcb7f3055a93f0ef93e9fdb74ecd56d97e0f6caf450655c44ab3640c45d2c6e7b6489a52a04d49325173689ae647477254706f2b58d075db5687c52dd7ad0550be0fc5b78c6ba45ce0c693ff45b81092316e0b39a443a6290152a47e39ac1305890d8af51ccb3184dc85ec7cd8835d9100cc55b123c17faaac605057a95e23b3cc7c0364a3404cff9dd0bab1d895b10526c3524b137d63be0f9d29278bfb9f6d0d82f7ca5c105fc7864932c2c09954c3506226f9b724b72127756d68b56b335b6b833b47ed639e3b9085d7c3febb47003a31dce3f1ff449a85f42e078a9e609c31bda226520eaf56dc0ac2bf285d5dd3a5d49e5fcb2e963c2c0a0276ed3a46f9abc8cc4174e89356af2fdba14a3cd1636a55e6c6059698c93aa10404de743c550b816d342533bde6a5be84a5d07df5ae8bdb06bb5d05c61d585a6e2a718de5be8882952cd870bbdb6b3756bae9e668be2c6caf076fcfd84cbe669bfa2304fab9ba7fd8ac20cb248194792c966d1faa5df2f1ccc20e107c68fa81a2c8ce2a0dbb8695a55bf308a0b41607a988169615cf06f61fe908630da1eeed270d25fd970c74aec0fedc1d2b52edd8f759cd05a48cbd82d984116d292710d1a9f45a8b52de9c58fd1d6f80147b54d875a38b54b3f9cc4b2f18bbfd7766ca655e1d194de69b5616a1d4d78278f6e4570476ceb89ebc3229c12378ef51ba3ad1f2359302d7d479841e8e13906bb858388db85c2b0aa6673f7a906bc2baa8ed4687e6b52dcc98dba03a4720d8e877abd9fca94a9ad0f0331ed73ddfbb732f2d5869b74ee5ff9b4cbfa602993aaf58e74ee9fb93cbd6939a886b6b564b11c54dd4ac53a166ae9ba58e6f2e1d5a78ed03e49c15ed6aa7ab1fa5f5dcfa9736c0b267e3c3c6044ffd11e51c6ea8995440b3581c82c5be4e17a9e391a50cd1fd5fd064a212dfe8cb9eef17c7ffde200f3739084fc31ce527afb7a46ca5737f2385d0513a2117d75e40bb9d8f7aac3124e206f1af97123cf82f87e238f71f84d238f996788fca3ba91cfb197fd3310dbf67a41eb92f8b4aa91a77b5c46997ca8395587b8df5f679319af65d85afacb2e1329cbe0effb3ee0d97443c70bf3136aefc9f05a9d9df530760291bd125481a2465d554ccb772ed4440062af24b77074ef743283c8644cc8b56a38537f5492a1a1624e2d553367a0ff8ecfaaa6a219e83d53f609754725e75e23cc4054c7832a4b05bf16da506593e7ab22592c9ca81e1d87fe5ec95b128786819efb6288a9b97b8bbdb694818860cfb4ed4e5be620165fe529dd854372973c1588690244d7c5a8fcdd2041745fcccbb5559f4408be375ab3501ba0473b0b626d7b70fbfd280bb1fbfd2806a246a591eeeabe25a50ff79548f3ce3b71aeddd7d81ef2a7fd8bac551d74d093185e0bf79586259849f9d2ee6b3c4ec3f0d24f6f5bbf893c8358dd57ed57aed8b436f715366763283abc0a5c362e1e0b9efb22d842e1abb4705fd4e9c72ff1103fa8a15e2e5deb0d68d05bd0b12ed1b039f34295db6f0a47a5b6469ca50b4f83195e12b408832e76553441a7abdda90addd03d4dec059c2b9eda76777cecaf6759f0a037b7d35ac44ca24e3b22c0bff9b9e6b96ca53e1ee4e5bd6a8f8f7ccf77047cbfeb3d7f7471584daf5b723444d58ba810e587d7625b983354479c6e6c748ebea2b1a88381de9bc2422bddd8f095cf2244d01410d08e4081c63e2a9da67e7c3d1e206388a90fefdde527a7ad3ecba8c63214f65aed4b1995d8661052ab1a3557fb0dfc79d68580516fddca407e0309db7df584c6b2d881ba8658888db1770d61b31c1adbeb1276f7d6d3478d1286a68a2ee832c4ee124623d73d441f32470d26c3a5b3526aff4757b16690c5becb68ff3783acf75d64182a4af3783df3b20fa4aa0b68b37a583f93a657b5436f7b60e006b577a3b6078ce73a627b5d8f61967b5dcf04128e1f80e61b5582e7e7829cfaf5750bc7a0f4ebeb165aa06e14ab18189642bf8a6e9904835dba8ace8494ef9ecaec4a68ad7e0859c761cd4ccbaafc39444e8bac9ebdb4f3496fc0c507715fa9b06e9a44a7cdc1d86e9e40782181dade9fbc51dfba32cc4a6d7a2890ffaadcb81b9369928565d88dc90ca2eec2dd4b480cb3509bf6c4191632a7de16a7d2f60627565f04f0e8be812f82d8cde041c3c9cda6abe743188fa5c015e1c12fd7c76a37b3ce55ab61920af782f930cc04a629afea39ddb7e23fec4f1cb170c972ffeacb3ea1407e8ada0dcc845dbfc474674c74090d3e9c7a20ae54875543e7da1f7b1bf07992c5ebcba95f8d66207ac45b7af9f80c22258f071b2234b7dd24701b40319146edb402c773617362bfd8b2204d5a039e862c8bbf9657cd54878e8146cd82b255a091d11d59984177ad818b2cf0ad96e31849ffe1bd1d566a6063239e1ad8544ec9a2d829f556296649b09f8e1e76423fdfffcae45a2c94b4dadf2e61942c6bed5f04f09acda7130cfff45dfc590069e28fb548bba9fa854dbaef3d4667bc17f661ece33052c5c3f3272aa13c8ea40675d41aae029bf5ca9ef9096987e9f0e2122e26e9855ccbf4c5e33d0af13497782fecaa9da316629e4fda097ff966cff2f9dfcf538eb065c14bf9fc8650ca95be2435d02a656b827bfa21f4dece9631fcd0fa9eefaf53e52d17579d3ffb96fc629d65618d5e82881fab95e3b1ba2f15939079bd36326f35726a41478c3a42f149c42d36f5137bff512650e26cee68bb8fbee96fcf207bfcb7b6351531c369f0fb2bd699f1ba54acc348b15ece37663ad45bb405139e112d45e1784aa7f591aff432105e074cefc547d445d11513add9f52b7d6c4dde7bd927d7beaf307f73b9b953826720d2672c37fdc55e85ba6b50a957215fe84549f9e8d1bd405406306284e9ca103594ee71ff8ca9b60a5430dee3feebc4911ded71ff4cdca15df8fccd52aaed0ed58658a0f733b8b1596ba470d5dcb468578a624cbded8a054fbae0c9a558786e1951dcddccb5d38a482f2ad09107d5df1a0e58d552a74221b19fbfb968c119fae3df3316ffdf5ea43ae20cb535ec5b7ad77999dda82980bcc1f335c3b7ac70cc05b108ec9bcb9eb2a95606f29bbfb0469d48a96592859216baee32862eb7b697db37c203a92f5f7abf45ba4d63409cda83c13886c1bcfdf4f8450473cb8d2971e7de24d3b195bdc2e015af6583e67ea917132ff2b227a41cda64551be54e0bb31146df5a61d4ed4d782edae9e6fe780a23ed570dca0ff7e8a508d2cbb2f4cc0baddf539edebb1d411d1f13f5c69d3eaa0678d4f1b1bf323683988aa4805aa7f9b173fdc2f52fd3dceb7452eaf240ce769a74d1db13f61e3d139e5fb7e10e35bb74646ba649d5ad226a7659a8826c06d16222ea5cd9cfd96610f511718c56fa39db0ca26924f5a14c81d3a2bfe55e6a7f0e990ac5c2f31d71fde5f1304eba27105d022bb50ae393a8b1402dfdbd6436c96139fc61ddccb55d027a3fdb794e8b4a7ec2989a8eb52462e710695c63bd4e7e0aa8f692c7a24a486cbc68fa95e88d8dcabfb97a06bd5219da0c72ca749b6d0dfd1d872f74bdf86e5be78f5eb2ad0cc474f30c7c1dcebad141faaf665b3dbdf336cfb930adbb359ed1fccaa615e8710a60932e4ceb6e8d6710ddb4c2687f3683e8a635f7f66733c461ebbc73531b47fbb3e91bd74c6dc350b06493a99d40d48b2277533b4f72c9d4ce937c35537b9dfcbba99d11d32176537b9dfc87a99d6711d2f059a676fee625533b83a8a6f6f0448a2e44b9e36347a8a372811a683cf72cc742e747a9c91e7d47960205cf6b4f5e8eef46edc9dc0ff7b498ac84b11538a1a1578062765762e4206a9d2975708eb659e871c3c267d97713ea83b85019c3a25ed65fba0a5bf068a82968ac17780c9fd29e3ea5f055a97c21d58b90bef476f40644e909646a473f83ec27b54f3cf5d2d4512564991515963a7e31f60c5f16f86e8b28907a0a69e6ec09dc6b73c197df548bda301ca737f0186d6a3b26742b940259d8b13fae6a02295ba21d5a0bc8e87e630129be775332818cf6372690bdecc40252fa0b3d26903af6b40d207bcb5f1348e8a5dd2610b48c82637b35e64b2989106dcf7f1895228f6676c20b4875d12f66b9feacb28194e831d8899c947ddffa0551fd1e16fd695a273a866e9963ba1f0b681c54b75e63dea098549f5e40a45d050beae07a9f3013484093cd638005084624c6a5040cb0c5522e406a6f696e014974b3d10842ef5ddb38b63ffdc79cdcc785fe88bf8b945095637a5243c8cfa8e3a9bc8ea74c7f3fff249dc0723af6968c6d3eed123f9c6f6f53a30c1edde897df5bc255134103e7a774b5222c5d72980748221e12264d4df9e8cd0f1badf4585394b48a69d56f444ccf84c83e96fa2b3c4892a9fb07d57278cc4a60eb4534190386970749f624ef97c74b23a1e73b91eea521105d3aedf310c84fdf7404e791def7674ff4a18041073dc3447dc2ebad524ddfe2ab899ab0acbe4ae534a3a90afee1f10f00fdb3f46cac5f21fbca813e84dac81d0da4e74b9f1ce843a98ada1d8d25e3532f8edde9ba3676e7ec95b1c965a2fedad844afd26a634f1fb3b97fe2175c6fd7a149073cbd287723d7987b808062fd979f3ffce19fff8c91d5f7ff7dc3b96ff01c1d3a0750740113a5fef0d33e388dc1f77ffe0f8eefa5240d0a656e6473747265616d0d656e646f626a0d392030206f626a0d3c3c2f42617365466f6e74202f5245494d425a2b417269616c2d426f6c644974616c69634d54202f44657363656e64616e74466f6e7473205b3131203020525d202f456e636f64696e67202f4964656e746974792d48202f53756274797065202f5479706530202f546f556e69636f646520313020302052202f54797065202f466f6e743e3e0d656e646f626a0d31302030206f626a0d3c3c2f46696c746572202f466c6174654465636f6465202f4c656e677468203331353e3e0d0a73747265616d0d0a789c5dd25d6b83301406e07b7fc5b9ec2e8a9fd11644d8dc0a5eec83d9fd009b1c3b61c610ed85ff7e69ded2c1048587e4e48d3909ebe6b9d1c342e1879d64cb0bf5835696e7e96225d389cf830ee284d420979bfc578e9d094257dcaef3c263a3fb89ca32fc7463f36257da3caae9c40f14be5bc576d067da7cd5ad737b31e68747d60b4555458a7bb7cc6b67deba9129f455db46b9e16159b7aee46fc671354c89778cadc849f16c3ac9b6d3670ecac83d159507f754016bf56f3c895076eae57767fdf4d44d8fa224aabc0e50ed95ecbc32013d413baf14750275e91ecaa11ada7b6599571e43399442059441c8cb919761951cab88187a8112e800612f05f622049440c82b90279057204f20af409ec0ff153b7f70b713ba1ea1eb33ddfb232fd6bad6f8cbe07b72edc6a0f97e5fcc64c8555ddf5f8a60a3470d0a656e6473747265616d0d656e646f626a0d32362030206f626a0d3c3c2f4f72646572696e6720284964656e7469747929202f5265676973747279202841646f626529202f537570706c656d656e7420303e3e0d656e646f626a0d31312030206f626a0d3c3c2f42617365466f6e74202f5245494d425a2b417269616c2d426f6c644974616c69634d54202f43494453797374656d496e666f20323620302052202f434944546f4749444d6170202f4964656e74697479202f445720373530202f466f6e7444657363726970746f7220313220302052202f53756274797065202f434944466f6e745479706532202f54797065202f466f6e74202f57205b33205b3237375d203135205b3237375d203430205b3636365d203433205b3732325d203531205b3636365d203537205b3636365d203630205b3636365d203638205b3535365d203730205b353536203631305d203732205b3535365d203736205b3237375d20383120383320363130203835205b3338392035353620333333203631305d203931205b3535365d5d3e3e0d656e646f626a0d31322030206f626a0d3c3c2f417363656e742031303137202f417667576964746820343738202f43617048656967687420373135202f44657363656e74202d333736202f466c616773203936202f466f6e7442426f78205b2d353539202d333736203133393020313031375d202f466f6e7446616d696c792028417269616c29202f466f6e7446696c653220313320302052202f466f6e744e616d65202f5245494d425a2b417269616c2d426f6c644974616c69634d54202f466f6e7453747265746368202f4e6f726d616c202f466f6e7457656967687420373030202f4974616c6963416e676c65202d3132202f4d617857696474682031333333202f4d697373696e67576964746820373530202f5374656d56203630202f54797065202f466f6e7444657363726970746f72202f58486569676874203531383e3e0d656e646f626a0d31332030206f626a0d3c3c2f46696c746572202f466c6174654465636f6465202f4c656e677468203136393634202f4c656e677468312034303430303e3e0d0a73747265616d0d0a789ced7d79605445f6eea9aabb757792eeec9d05ba43561220610b04226902618b40d80912092a0882caa22cca082a82e242dc50710117146194100403a2a032e20ea3a2b8028a0a22232ae2c8d2f77d756f7708199779effddefb2b095f9faabab59c3a75ead439f7de34c488c8410b489067da8c09d3b2eedae425ea564f1431eff2f173a6c56c15c750e3df807fea95178f6713dff89e6820d03130e9f2abe62c7b35eb3011439b8ec593264d181f55e0e986ba1f0019c85ef2ed532f04917e0828bc74eadc89dd0b3e5a48747d1ba2d427264ebbf4f23d9376a612751a4ea45d74f1acabfc55ef4f3942d4b713f29b48f2a613c5455ff3c03877f12f469241f2e7f121db0a25fdf0dabad5a7169d3ee3f21919e0df81faccaa804fbd477010f572ae39b5e8e450978fd2643f677f2276c93af8fc898a692aa9c4c943f9349248edc9c791425c0b75c58b425843d789b758a132932e02c6e82d688bba93d6b06f5921ae2de66bcc6ad182de50fe4eab503f1e658341c7f022f329d45f08fc0ccc0326015d811b8027810f80c5328f3635c030f4b14ef663d1afe8b4fe0edda4ee340f63bca1c02b40a53a9286e35a8556441b651e63f5451fdd911e82f2b11afa417a2cae6f40dd6116dd496390be0ed74f20fd02d287f4dbe9983ad27c05e92328ef88f1e3d0d74acce70e8cff9132d33ccad7b018f43d16d707805e0b3a177436ea5e8174001889364331573fca07225d01f9f497e5c03ce52bf317d06b209f525c6f8b76cb91af41fa01f07537c6781fe94885a815ea8ce4e751ad68610ec5f8b7d8f3b6e62e791cde3027f06ff1f4fbb856f2d718367f677196b7ff40cd399849cf888e7400740e900bb4e1ef58eb3606d7fba95f632d0083580ee43407737b46b984561964be043e57a8cfd121e46f68c04c6aaf3c643e278ed3245c7b535b468fa29c787be004ade6dfd33d5a262d86fc4ad0ff54a00bfaf45afa7009d67ca6f93de895cad7e07f26ad06da6157bc149693940df2b7635d316ff3b4dc310a7419d031ef7dc019c907c6bf45ca5cae3b1b191448cb71ae91eb8f31670357a17d10f5ef96fa8cb5d1d1d7add638d63a84282075af31240f61587a168225fb35341378097856ca0a321b0474423a0ae80d1400fb317e4bd43fcfd257e88cd44da91f5237d057b95c2b4b67ed390c838e1d0ded9917d1fe08b01a7848fb3b3d0bbc0d3c88f91c93fb45eaace433dcb7d42da933616ae9f714ba0d7c79e53ca54e9da558ef233457f260ed41e85698ca7d27755f529147032dba872aa4ce4a7d0b5329178b7fec47b9271ae8d9b97e08de5bc97d8af60f5bba0e5d0cd3b02c1ae801aab4e47d0fe676023afc256cd507345a1d4cf344193daa3e8ab22990cf1e94e7d15c630fc5612d07a3ed034de8fd12fa1e7619c6daa3ac853c31be25d73dbc95b287a9ea5aac3bb137d4b5fc3a2bfd1fb429d876fb9aa4128daffdef96ff9f807fa8aea589487fa7ee314dcce72eb927f423ac00f08729caeb800540ae91c7ee37a6b07a7d047934a2e3c0954a80baa901eaa26cc7be8c87cd23ca44f908add4b2bbe330c6307684158a3dac508fa7db95341a2fc7e21f422700d93fe8b4467a748ece35d5a5300deb6b532af530a4539521fbdb3764db9a50f34d608f3c1ba47db6ce07d86860a8adafe68106fd7c832e061d1ad6cf73f5d4fca8917ebe03fd6cd3542f9b5279b648fb1edea7726f84e72feda3b471d2464a3b276d40b87e537ab63d93e7d37d961d7e87c684f6f6c3c01a6006aeb5c0b9f5aa6d87cd2318eba8b68766ea253453bc4133b597e9527d3a2dd476d2a598f7be8633759cb93e749e760c9fa5524e3817d787cf51b594122d7bf6125d60d99bcd946d9da3e04d9e9fdaa374482ba198905d3922f7a1dc83a833dc3a6f5e00dfbf9ac7c1fb23e2079a22cb955974af756db165d7bf51de37ff2dcf44f1004db3cea2bde6574a29cdb7daae30abb47c9c97cfd08d0dfdc93aa0b24cf2af273043390cfeb65b67fe75617b2cd7de78d9fcc018093bf1019d508ec0864da187d49741a50cd658fa38d46abbd39c68f535c5fc52cda0f3ad3a80d566bef949481e96bdb1ae8db4f2af58b2409f90c133963fb107725dc31cfa1eaad40fa3fe1eda8b7d8732603b2d93bc603f7e689dd7c7e11fedc1d95806ffe027bac6d2ff83e6dbd867a90de770146cfe49f35dd8de0ad4ed173aab075bbe05f68fe56f4047f43879c69aefab7974b3b286de42798d7e2d747235dd0a1e8662fff6552ea372ed08d29bccbd21bb3d52bc8c3eafa71b2dffa4c14f30fdfacbe6bbd01fdb5f903c483f45f2b39c2ac556ea8a399defc8c35ceae85122f352e01ee0ee10ee698450195d6ce7991f3447dc4d2740bfe21364b9f81c6969fb6b94a761d71fa478f194f94f65223da57c4723783e0d12836897729406a9829e42be4e6943ebc551d4fb376d025f835427e5f37cf357914069ca219aa5549aef61ce0f2b7554284cec672f4529f79a3fa15d9d5a4fabd58bcd93ca853408a893e085d88f0e5aa1dd4a83e478b27fe071f49f28a1cc357fb3da3582c56b1892e7c71af17c2fb513d75396c5efbd54d6985fc96b039fdbe969c9e3eff167f121fb453babcea78478c1fc0cc8b4697048239af05fe0b34654aec367d20797e782b6017a3d0eb66f0e7c964d54833e7f263a8d7a676e473d786a671e46d958a4bb031d906e85b2e9a077a2de47484f41f9bbc00e94952a29d43364a756238f58e8cc5ed035a097a34e3428ea9e7e9ee8d40f36cee421df134807a04fa705ca6f05ed6ad3e03768d71fb49f7ded741dda6c03de0c21c12e3bdd1b1884368b5056069c87fc4c608ad4edfff46bfe87e91f9c67ff2d6d747e9d94687a26fdd734bc9e7f419b9e5de1f5ff2bdac8073d9786e4109e47a3b3f44fcfcc30852a9634066c73116c54866597a56d843db6ec51885a7e80b48b33e13bcfa46701f8efe492b6d8b287b0c5d21ec2fe5e6e9df5a7c0cf4c9a10e64bda12e855bda830eb6107a4cd1da05d4897cbb341a6a5ddb6e84e7aa491ef52ae8d429d9134cef299bf2427d23d706e5c0dbbecb77c955f1163ceb1fc930aa04bd8ff906979e6e9fde906c8aa75d82fd6bb633dbe809cbe977c9abf58e78bed770c94672e3f80f87a0d7950ffd6501c790267ce4b568cb105f1b26d9f43fe31fcbdaf285d29a414a5d0fc38147f5f244ee2ec967ecc31f3172bd63c45b5ca33e01131be730d553a204b03f3718ca4b17a2ae63f832a9cdda4cf62e565dc3521bcbe589b69bfe3d3481f4d6fe4ab59736eaa9b167f85e61e79ce341e37dccee88773e506d2cec60f7fbec742ba96d554e7fe30de68aa7b67fdbb1390c5cdca23e676a5b5f97483af09dd5123e02344d0dfc2326eca4b782cc8a5ef1fedc9f01e01eeb1f446de57b0ef2dc02f850f6497c97b0cc3a107132c3f0abe803a16fec0ddd0d535e680d07d8780f20f6b4d9729efd2ca90af3032e40ff700a68a1ed6fd0c275f88f8b208b1f7ab34d0f2096cf4c71a6458732bb0ef0768ff049ea1f99a1bfe5b0bf39f8d700432f34bb901772b9bb0f736597edb3bfc0ed36f610d7c8f3ee6eda0016eef971ecabf6d1f0df53ed52c3fdc7c57b9829eb16477177414eb0fec5238fd03b80f88c07c4a2c599dc01877a31f3947ec6d516a5e80f65f8be516afd7281cfe21a74ce8e55c7d3ef4f56ee8ce4dd813f7d172ed79e02bba42eb0c9f7b007ca632ba44b981fa8bae344782dd66eee0c53407e82a213ad21c651afd539c47f3e43d2d79af2b7cbfc0f6bbd9031242a79f8103a17b5412732570ed63dbef6631401ad6e831c8a003e81e50ec557639e8cf213cd9081aeaa02d3d86b57a9d5d099e4ed215a2802e94e3080f2d6b0ad4bdc886f934e816796f4319051d3817bd9a026d25cd6f0a944b9ad914a1f2e4a640b9a4a54d81f2d2dfe1e38feafd111f7f549ed51428cffa1fe0e38ffa4d6f0a94a7ff097fe54d81f2f2ff0d3efe48ce194d81f28c3fe1635053a07c50533e70d60d06e6c08f7a0cf445d8ab36a0b341e17f99f0e9cce790864f47d2c79c64d731af07beb64129c0b548b7431f280f7e091c43fe6fc02ca014f9ef81c3c057c054f860a7501e857425701c78059862d735e1ff07d3800a603280ee835702f04f8309a1f6b1a0881d82cb81adc8af00e09f069784c693ed3f05ba210f5f50fac941698b31a6f901709dcd7bf069e00ba4b3d0fe02a4bf03be0d5d0f21783fb00fd77dc8b707a45c86012d803840f2fe0ba80e24236d02885f82f1c80f055eb57de4e08ed07d5187bc27aedc8833e605eaa39ea123fa8fb45c52696bad1876b2f959a3b34afae4c948578897cd9f34413394621aac5d496fc2cfd8a5f7377f85fd8e55abe825d47913675382f291f9bd3cc32c64c07ff800e7e7017a5c594933e123cd120be1b3600ce547ea29fd1779eecaf1c41ed8fa3dd4c6ba9f29635d3b26ac7156d106ad1b62a1bb61477752a9fe2aceb409f09d479a6fc00e7fa64f42fe529cb373c9d074ea69aca1befafbb89e41714abc79467b94556af9ccdd70fef5a143f0e31e08534722fc9d4f50fe18cdc1f9334c8ea797cab333f866786ccbd7e2742d6cec40c8730c7035d61394107b9c96b18215a35be7f71a3bbe0ddd0ffd451d017f7005759071bc154b877c45cd477b956f100f9f827c96523fe307c4e8e534587d879e536ea2bf35ba0f7a429e91da49c4f688a7c33ea4b6df3a2fd3c354fa1b61bf54ed83bdfc3415c87b0556bcbe13e7fa1e6a1ff64f1bfa90f71110cbcb7bc04dfd9ab01fd5e0df847cd58631c2f3f90a3e04cecf86f987e87ff81bdbb1e711f3cbfb13966fde94867892f727e43d82b03fab7f48e3f4ab413f665eed4ddaa866302fc6dd6838cd4ff485e6bbc620c8ed32ea67f96b38a3b58e74c2f138c9d80c31a289fd457176bc4f88d382eb41118799f21ae23bf300ca6a41cfa0fc8cf4bd01ec5ff3b80c43716db71deb05e1970727020751dedddecbc1cda09de53339d4ff3bf28fdb7dd31540ef10fa8680b8d5f2537b37baf718f6e59bd2b05f2fe538b7099ddd245ff0dfc672720fcb67457f74efb2112d046d75f69ea6596ac3f667c37e74531aba8f79d2a6a484f21785682ba96b961e37a14defcbffd17dfa3ff163878563148b9ee35f9b279bd0b10dcf1bfe8286fcefe5212a7d5dd85053dedfb90ef4bf8e21e5f33d793f314cfff3be6a28366ca021bfbce9f385b354c648cbed677696ff6e3fef90cf1cfe040dcfa67ea6ab809567298b9690fefdef416b49d700abf467693c707b985af74eff04da52b45b4aab0c1f8d076e6f4483124d9f05368560740db04ab993c603b737a2410bbfffdc709ef630c67d18e3a23e70bbfe06f87d03eda4ffff27d06eb0e678bb31cb9ae33e7916fe291ea75912c67d18e73eb4d98571765974af4458ee613986e5d2e8d9a7cd7378fc50bfffb7eb68c7db7f8cbf5a97ffa979ff19ef8d01bfe44eeb39bd4d5fb29edd9ec3b3941bf8be81166bdf40ef7fa6c5fa28f82cf2194143fcc2a2ff4497acfbef62022d166fd072d47fcf0664d5540fe4bd7e8950de7eae00dfe81b8c398026c97d209f69d86031bf271f1de340ff26e953401f471bf93cc28ec9b662affe2df4eec02b21dbd7dab199c6c016e848cb67cd738d5af37b85ccf795976962c8df1b6bdfe33403763c2d9fef5bcf4a8669c369ae78c4fc44eb87583416bec32a9a2081f9b50ca1228441c083e0fb33e061e02ee4bf024f8b6c5096846867be046cc5f5d743e7dce5b6cf6df9c8a742e8192a977e7740a2e1d9ef56f0528873593e37ffd9f2e1ae553e066f1f23e63d040a7f01fc0761c78ae5f31671805a5bcf12b686de03b0cf11f98c5fee9556d6f3f347a80ae905d6f5a7504f3e2f40dc2fd6d2e2d0f39705ea279466d509bfcb20ed6421a58a9f68a2f2bdf99df55c01b1bf229f55a00f2d9fde917e911247e3d5cf69bc388d98f634dda6b840f7da50bad187b29cad479ed3654a346825ca1f06fdd5aabf4c198f3aa780a791ee89b22174046ddf5427c19ec6d2fdc03f104f6f540ed246311431ff507a1031f546095e43b70023c4305acc2ea442118579bf823a45c065a8530c5c462f021b4415f566df2236ef4a0f018fa0de43a290de1633a89f9884983a85368929a8ff3dd0dafc00fda9bc9818eab645bd0bc524f37dd41986f105ea14a2cee55a0a65a877d1535a028d5093285e4da64dea361aa48ea63a2d0fe7f8df6904d6f621e03e09f91e0362fc02f8e8b741be64bfd36053be1690affca005d6c07a5787213aa2b5f69b3ed6fb19d0799cf983d423e6297d04d5e88fc2a783ad0e3dff7b1efd2fc6fa94438fbe451f85e83b5d6d4defa027741dfcda8ed7c825f50d7bf496f03d5049e53333a93b219fac1a754a4402c9f8ebeed07dadb9d0e94ff516e66be81f7a6066c217f8bb84f5ac698d793074aff284e844572b3dcccff558f3ebd0fdab1ed6f3ad17acfb48feb3fd91aaeea6807d1f15f51bdeb5317f41bff25d9ab622cb7a17e701ebdd1ad9bffdfe4ef8beda6cfb9e1a7c8a4dd8b3f24c98697ec1ef307b59f7d00acd77a03b33a1075b802bc5d596ce8c601be92ab6d17c55ea0d7445aef545c0d4102ee29dcd20e870c0c7475b3a351bb84714a14d11cd10d310835d46f5d81f1bf97e6ac536996f42b72e84ae4c1473a0475da916781a7ad39f3f42a32584a487a8b5f0d3f390690f601ae004a4cdbe037a9e039dee867e8ba15bef21ddc97e27ca7a3fa5ab5c27d473fdd5d9f6573ec15f9de17f555feca33bc08b024c95cf9543beb123fc5c1eb65afa94d049ebfe6202aeaf08f9580315fb7d26ebbd2ae5b0f923e2e1b7ffc377cba0abad773e427117e45305ac0010c79b3b815c203b14477494cfcab07fb215462921db9782fe6341b5d033dd6e967fb7c6ecdfc83f0ffbdb1d433a354bb99c2ac5bd88eb1e9571ab15cbc8fb256f03ab01c437c14f2cdffd0d6b1f8e05c5ce0cbe876b32267a19d80eacb3ef6704dfb09fb759365f963f19f2b5af69f0593713f6a23945eb8af20f689971017da77d4177638ddf16a9b40afaf41e7052bed322813366b0fd8e117d84b95c86bed680ef55cae374ad984b972b3793531986792f26b7328e8a945b69add2d192fd6265298d015d289eb5e2c411803c57e4bb7b3315f9ee5e777a5d09bdbba73e8ef8f234f4ee63aa7494d018f52d5a2d12cc9fd5fbed67e5d6be6d6ffea04ca3f3f96c7b1ff20a9c115f510eda4bbfff1a595f5eb3f467b7f9b2f22f8cbf9316293fc2c62cc2fe6d0df99d478bd418ba006d2f10bba983721c75dad0055a8e755ffe027500f4f9368c3f0ced4ee0dab588959330e723f4b07217d56b43e845e53173b7f224786a6d7ea9bd6deed036c3f76b83b8a51f452bb7a3cd8f988b1bba2679f83d489e243f8d20f9698c302f4d61f1d118928fa67d03729ed6bcc14bd3b1242c399c17aa0b798465d208aac5c7de73e5d418a167193608326bcca7945d1852868d9104db26651a46d339852065dd18d65cc380ec1b8079cb75b0e41f5ef744cc73b7b9d95e77f34b6b8ee04bcec99acb35e6e6f09ac35fd02cbe11e7cbb5575a9201bea6639ceb5579bfed31f341f54a5aa98ec55e97fd4bf985e465cd15fcc86b56df9237795dbe8f2179781332c69cc37295b2d4db983bf572c86b09fabe166d4660acd31857f67d14f930ff07ccc7655fda03e6e7ca48ea1596b5d566a3b9d3e23f34af06dee5fa4b99a24ff511ec13e8aaaaa3fe36e8ee2bd0f30fadf75b9ed6ea50f602f016ca0ec87532df1297487b65bdc33a0b700229d8f3f279432220df3b9d02a40319c04e6003f00f6beffeb7907bfcbf056cc139804df82b481bf057c01e9dd7386fd98cd9e66d42874fbe47a6e16bfd451fd22e35f8037f02d8ac9fc236abe918bcc25c0eac1277d244e8c600cb9635c6fbd4dbda2fa1fd0c59cf071eb0fd7fd8597976fc663db77b5af9843eb3eedf1d0c9d335fd126d8c4de388ba28c2cf8f687cd77e57d1bed41f31723cdfc508f36f75af5e0cb1b37c0eff799ef1aff80ad3d85b3c8be0f38585d13ba8fb4860af90cf8df2662f4cdd45749a70a350e7a7e10f968c40165e642fbbd26968873a5525d0effa80574197ebf8c1dd86d666751c852c0cb0df2ecb3dea77b95ca2d5fafd1fb39f25d95d0fb3d5faac7e845f8b443d45fe99fea37b44e7d895ec6d93752ed8f7df32a55e81780bfef698e7a15747735e2b0fb690cc6deaeaea0636a0a4d41dde9ea976877928668add0f6377a4afd0cfbf4495aa5be8eb6cbe933ed2df8b5d974b95680f9bc4e5bd51f31d634c4793720ff1bad465c3046fb8e366919e6e7da087a567b80e6f022d65abecfcbe6502edb4fe3b98f4d86af76b392ca46e859f0fdbe354d7502e29a0be14f7e87fc4ff0491fc0d927e3e09ed09b21341f3260bc3791eeb7dea79c0f39de69f99fabb187bf03fd1c655f530def61a65bfe640b73abbc2eb2cd2d18e34ee506f384159bc96ba887b25b659ff0a503e2261a69e50f9b372afbb03e8f53b59661bd175f2332a89fa1d05409cc6f8b6317d53486738de513e729d67bf0666b658f19e79c674e340ec3af7adf1cade6c0770ff9477a243da67725436d4757e85540355da1e6d215da67d456bb8f26f3a914609fd04c3e81e5b0c32c33ec0369efd309f51fb45c59003f6801652afd104ff6a338d543c580539ed152e71debccc35a90c63ae69887f4c934d6f8977958cfa0b1fa369457ff2745fff783ef0bfee81ea7e6a26f11031e08dde3acd05d74b17a0175d11dd0895b699e73316d301cf29ea4790a6b7517e611abb5311fd797d397483fa95d6df92073f4af6983d696ae417abd78017e4b2eb55773cd93d0ed76f0231f0afb59ca33986f1539cedee394eff09b77298f9bbf897dc0f3142b9e378f28579987817b956558f365348a3f439f6b7d6023965085318bfa6b1db0ee2da8542b862e2a905b4ba286f71f881cd867ff52eae912e8d062a0bbf215e398df286d11c6ee64c5eb561df512b49d4ed7411e5f2aa3e9712d0e723e6dd90ae93fa5859e578cd4075286761d7553079a774067baa9cfd3346507f6e17ed0e7414379f0e0c67cbe43fb48f9ce01a813f953a17bb83198f728f4990b3e96c9e70d8859cbb4767433f4ea37d43ba6b4a744ad9bf930f241f95ea79144cbac67585fe28c5c4e8fa969b41171d94d984f14fafa97b42fb01bbf392e451c78849cd67d0a85c663ec336a254587fe9662be3848d3307f173f857d310e71ddbfedf71994e5f0b9975b7675b1fe22cd93f72724e49a4b28eb11ebea3486ff9b4a9579401a62880594005ff631ad2f3d26df4f50ecf7237a60eca5c030c4b8f7caf74ad57cf311e573f35a651762c5adc127556fb016f40ee57c8a045fd7f21fd16f0dfa1849b789dbe86d6d0ff6c1241a8af117e91fd8ef674affc17e8e609e0ef41a313c50d2e3bce2eedd8aba7629ecdca96387f605f9eddab6c9cb6d9d939d959991de2acdef6bd922352539c99b98101f171b13ed71474546b89c0e43d7544570466dcad2fb54fb6bb3aa6b95acf47efddaca7cfa78148c6f54505deb47519f73ebd4faabad6afe736b06507362939a01bb66a0a126f3f88ba9b86d1b7f59babff69ddee9fe7a3666c868a46fef9d5ee9af3d6aa5075a6925cbca442293968616fe32efa4defe5a56ed2fabed336bd292b2eadee86fbdcbd92bbdd70467db36b4dee942d285546d62fab4f52cb107b3123cb1acdb7a4e4624b8aa4d4eef5d569b94de5bb2502b32cbc65f525b31647459ef94b4b4cab66d6a59af8bd32faaa5f4d25a779e55857a59c3d46abd6a756b18ff64391dbad5bfbecdf625b7d57be8a2eabc884bd22f193f7674ad185f29c788cec3b8bd6b13af39e83d9b45e731bd462f6e7c35452c29f34ef6cbec92258bfdb5db878c6e7c354d7e5656a20fb4e5997daa97f4c1d0b749297af3c188645f4ec59ed484f43259527d99bfd6915e9a3e69c965d55890e425b534746e5a5d727260b3b99f92cbfc4b868f4e4fab2d4949af1cdf3b757d1c2d193a774352c09f74ee95b66dd67ba26d69ae8f72871211918d13131aae5929abba4c950f6d1027931ca5f7871ad4fa2ff68393d1e9984857f931a12b2db9b82baae1a792a155ed255886c9b58e5ed54b3cdd64b96c5fab667ad2fd4b7e212c7bfad1efcf2d191f2ad1323dbf904c4ae56850305c0fa76bf3f26a7373a55ee8bdb090e0b18795efdcb6cdac7a3e327d9ac70f02f151c56834abec960f99a7a5c955bdb53e40172153bb60c8683befa78b52ea28909f5759cbabe595ede12bf123e49505e12b0dcdabd3a1becf597fef165f6b6435fc737b1262cb2675ab65097f7279827dbd7c587af99031a3fd654baa43b22d1f7e4ecebedeb5e15a28c5ec0b1078ad920949f54f87c60d1d335a16e09f9ad927bd6c72753fec30f0581bdb6bb448e195768aa708ab2ba8edd8869e65667484ec4bc9d42cb5bfa456406dad02e6ef53eba9ee677f563ad3d2feb04dbd6e346a546f1e93ad2c72b659684ab5ddf2cecd773f277f0e77114b04f855b278f9f0314b9638cfb9d607366ac9923ee9fe3e4baa978caf37175c94eef7a42fd92c7a895e4ba695558757bfdedc726b4a6d9fdb2a318949ac1b349b53e9fa7476f390f50176f3b031a3377b88fc370f1f5dc719ef555d5ab93e03d7466ff61305ac522e4b65a1ccf86586ca1936451d37acfa299b03440bacab8a5560e52fae67649519e1324617d773bbcc630f94650d14208e2b8a7d2510aeada0ccb0cb16d8b57342b50d5cf1c82b5b08669fac8bf68f342bbd868f6eac3bd686ac6c4bd43382868b31f29717520bf2894a319a8a41476fd05af80a5e1043c060400cae2bea18a817833778e23b80566c88889174e086fc8e16adebd1d1ca96f5b7b31556b66e8c4d26745c202fa6a4d86d62e26cea8aece0ee192f06e2b41e483f00824af03918580a988042eed0752ecedfc05af9aa5f14e5c897433801d17f43af5e1de66f13fd6905b00f10566981c554ff0d9d3bdb34bfbd4db3b36dda2a130347a07a09301fd8156aae5acd1db11df27ba68901b83400e32cc5e7366017b00ff80150c1d700ca070603d5c08a86d27d56ab8018b0a1753739de80d084076c70793a54f4f4887ee8b81f1af403bbf293a1493f74dbcf6ad66f83c3d32166b3b99d7f5617e8d9c14e14155b892f3614f7ecf041cf24fe051a15f0cf28005400d5c06e603f700cd0a1009fc1dbff8c5602b5e841e952d3b3157f0bed6af8eb724dad74c04a1758e9022bedb7d2fe509d55885056d12cb479023d3d419c3f11c81cb75fdbaff36dda369dafd3d6e97c85b642e783b5c13a776bee5099bb67952885804a21a052ccb2d45aca5248bc94c601eb80ed800968940fe59b0f7072e3d307c892126030b054fe3105b00d30681d3e99552f5c675ca8b50968e4e19d91eb6cf5d519753a43309d216959c6acab25c060592606e0b75494f22ef82dc46f67de19527ebb2ead9325eeb7c28937c38937c289d765a2dedcbee1f2e4628b1e4eee2c2fb00bea909005f3427456885687683b9bd6e576ea68918e36e96093f63629b049be4d726dd2da26393649b349a24d126c126f93389bc4da24c626913689b0894b920db92166b26d66b26d66b26d66b26d66b26d66b26d66b26d66b26d66b26d66b26d66b26d66b26d66b26d66b26d66b26d66b26d66b26d66b26d66b26d66b243124a9314ab90d1d9578f35b0c89b3679c326af075ca0976714fb0ecb3cbb20e0039d07cc02aa8176402e900da4c93aa2a4ee8ed6203d36f8d37de37a3ac4797425301f580a28a268833fcde7833dea0ab5ed0a45ed0ad5ed0ab55d81cf75c03640345ce3a2f326f4bbb4a418e3276d022bbf5aac6cb038646b6d32d226236c921218047a12f80e780f980d5c018c02ce077a01e7019d812e8c62f6b3638cc74c630b580d138c9183c1c1a5c444381131d146e0059e20bf7680df52373916fd6faccbb9143360cf21be61e4631bd8388bd6d2648baea56c9609ba067424e86375b98fa0d90a681fc8c3d030900975392d402ea9cbf1835c5c97530032be2ea7a794735df623be9e0e368ab20dd9e148ca65cb4147d4e5de82cbc36d32ac2eb71788cfeea1655dceddbe9e2ed68226f3b5a89b42d9164da25cbeb6ce7732bb5e6175bedfb2ebf9da4dbe5f7307fbbecbad37d826dfe1dcb9be3d39f59c05dcbe0fdabde37b2fed1ddfab39f9be5726a366c0e5db3ef91ddf4ba8be3ec3ea60792ea48de20772bbfaeecc8532b44331f2b3d17456ee5adf347485e1aef459b5af48ab67cb71f5f2ecbb7d1372aff7556723bfc9372e37d737aa5d3dcbacf30dc530a8783e722337f9ca3178ffd0c07d73f37cbd31782fc9679daf678ed563003db0408aefbcb483beeee0a14bbb177c9d73bbfbdab73be84bcf2df3b59a8c8e9ef78d8874443abad4d4b3f440a15ef3b95e3343af19a1d774d26bf2f59a3cbd264bafc9d46b5aea352df43823c6f018514684e1340c433314831b64c4d59bfb036de47733c4691e4934457e2a56dac3e527b7bfba813383d3008aa98d15e5bc7c58696dd7bcf27add1c5adb25afbcd6a8b860f47ac6eea894a5b5db2fa6f28bfcb52786a5d733279c2d35bd94d5c69453f9f0526f2dbf193ecbf0d1d072d9e0a61419df6c26c6926eba3d25442b2b7bc1ed58016d64332b29615689b724a64774519fdebff3511dfacc3bfbe36d94ce2baf98bb19eab17a83ee2bd4911d866c8dccd6c8acb745edb2f261a36bd7b4a8aced2013668bcaf2da5b86f9c78edeccbd3ca1acf7669e2849e5e8cdca06ee2d1b2acb950dbd2b2bcbb1c4563d9c6e5ed4a30c49502fca20bfac47fe28c3aac7d7daf57c0829512f4712d4f3ae229f55cfe75d65d55398acb77eb2bfacf77ac4adb24e3ad164abcee4746a5467331b4719a8959161d75ac9c6c95a6c5cfa4a59ab36cfea283b1b55da655b55582a655b1d65b354ab4ae7b355d24255c63554196755b9ed6c955cbb8a5813ae22d6a04adeffc0cf84d2b2c9c34a5979c5e8f5069556c2e7b76882675a0f4b3322937aac4ad942ef8923e44288e4448ced4ac7c15fe2cdf314b3fc2a34a89bcf5855a595fa41a6b4885a0dd57440f6d03dcd7b5d8afc6b84d5560f11288e0c5d6adbb36d4f79093a2f2f45c9003e74c97b5df7b4942d6c75e89207c5d118f7f7a63073e65579331b17fc6eadffee87bc65937bdbffbc21a0fbab2d5c35f32af933b3ac37fe5d45e5b5b9c3ca6bbbc2075fafeb6588967b57a2ac5db84c08ab6cbdc3013abe77e5ccd04fde55575f858120ad40fb00bc86005c8600fc85009c85003c8500dc84000ef0004eef008eee00ceed000eed004eec953d9d963fb7d2f2e75658e915383e3bb200bc8a005c8a000ef4004ef300dc84004ee700fc8b008ef5001c8c406e0b78d0d9d6475ac773846431d6e8a792f2306379e12a10fbd2d5796c66b8b8e1e72a0a0b2d4fdd4229169ea414254bfe1d40f86f02ccaf8353ccafe5b5e054f36bfe2dec59aa8dd0cf35f421cb665efa85c5d03a1c2d6fd273b497e5d23c7a875d42099448a77906f9990a87d04bc3690dbdc974aaa40de6615a4da3e87b9c8777d27ed68646d2db2c0ae7fa087a9806b178732d1d61dcdc8f1eba51050c4f9c3a4bddcb6e2095097e93994f91687923c5510f7a88de67f31c1bcd3dd4855e54ce377fa4fb9997e752144da36fe818f86bcbbbf22af3721a4ff3e965a6895eeadd661bba824e8b45e6e3e044a76118771c5d47f761d41e6c3b5fa75e42a95442fd60b8abe8727a929ee113d5639651cfa2a9e07d271d62cfb04fc521f19b6228172ab7a999c1128cd98a3a5257cc6c1c5d4433e936ba9f5e62c47c6c287b40ed70e67ac8c48f1edaa3ce02ba816ea10db81ac5a2593c1bc91ee6d7f15dfc5fcad3ea5e73176a7582c77f1d66f932fd838ed04f4c63ed5801bb816d66ff44303c979f147e93ccad94437d69288da5d9743dd5d00354475b21cd97f94004dbb345ad72443915dc411134063c5d4b1be80dda83758b61a93c8b7f2fd2c44de271f1b6f8053389556e44ddfd984501783c1fbfc330ff9958e7c574073d4a6b69136d013fbbe99ff4297d0daebbb2296c1e7b84bdc04eb0933c8db7e2c5fc4a7e2fafe55bf89722410c11c3c574b14c2c17af89f79568a55429571e5636299f686db543faf8e0aae057e62073b479bd7997f982f98af9bef92f7250243848a7363419b29e8e79cd87249fa597f0fb3a7d441fd327f4197d0dad2316c152586736800d6323d8543683ddc196b27bd8fdec1fec5deee4d13c9e0fe615fc52be88bfce778922d15dd42b394a07a54c19a34c51ae5216a91df03b50bd4d5dadae51d7aac7d4d35a8cb60627fcdb6772cf7c119c149c15fcdc749a51664bb3c09c6cfe82e8b225566f3c5d0a993c08993c01edf83b6da71df436a4f201b8fb8c3ea72f681f38fc994eb33896c0bcf84d616da05b83d8656c0ebb1eab783f7b903dce36b17ab695bdcade61bbd93fd97b6c2f3bc0be64dfb17fb1635cf024eee3e93c8f8fe393f87cfc2ee277f307f872fe26f46417dfcd3fe487f851e111ad04fc61fc168b9e08a49688b562b712af2442da8395ab956b20f12795edcacbca3f95af54523d6aac9aa1b651cbd55bd5edea4e6bce519a57cbd2aed06ed4166aabb47a5dd113f442fd06fd16fd41fd51fd0323ce4837561a2f6016392c892537fef629369abd06cffc7c56c916b3e12c922d619514c7f3e851653a1fa03cc497f25c6ebdbfa61529b5928aa7e90ec1b85ba91177b27b68233ceaeeb490f5a0d9ec2eacf46b6c1ab4ab0d2d17db4490f761300bec09d6954e885db0497b20ad4eac3deb4b03f8ebcabbeaceb18b7906bf907dac5ca83994d7e86efe8252ad745618643b17fed7cde2762aa47f8999e22076c5e54a0d76e43ca6d079bc3b1d07fd103ae46199bc1d95b0fe22895588892c19f3946df7c04a4ce6eb7909ed60f7f02922875dcb3ad02f14a40deaabf4803a54d9630e52369a7e945c6309630dfac11cd96da25a696d8e0afeca160b2f7f5964f1f3d84fca783e39f82c1bcc3af1af457b36935fc54e213ac88106bdc907f29e2c19b17d24faff1e3a749a7ea43ae56e71bbf985581b1cc2b752863a96de8345d36808dfc27ea6f749bee53b1feee85ef68c7c0b4d5c41c74435afe767d8affc577a849e85155ec7b3d9a73c4047b571ca7ef6f59551aca598089bc66915acf245e25fd4d33c004fef2a7397b98da560bf6c815dfa517d955f4977c15ebc048b721decd87868f3548a6073b103a2f0bb01baff13ec43229647850dbd02fb7439ece516d88b3db01a8770fd333a81bdfb007dca1955680f81f363f40ae6779219b4993ae0cc88c25e3a689e50de83ec9ea35b04a357f558ad87b2483e6fd67bd01ab30becfa15d49a96d126f689b29a5e5266283729a71bd46fe2ff054efcbf078f3b0bd1eecf8135fc5da83967a17df2e77024db70a23f573551e463e722eac3ff84673951f46aa258a78d388c93700991771151729bb3487da219cd6846339ad18c6634a319cd6846339ad18c6634a319cd6846339ad18c6634a319cd6846339ad18c6634a319cd6846339ad18c6634a319cd6846339ad18c6634a319ff1f21bf9f8654fc92209d8a9fe3ec794dafe7bf04bca42acf0b72eacaf38c920c4d7d9e8b5ac7b62fbc799e13c5678a07798e170f3c534c25487b4ee3a37d415a745a74263ee4ffcc7eda2fb69f0ea8748afcca76f927f0f1c157d806164f4eaa0eb4be55dcaa2f88104e832d11ccd01d9aa672e6d45e541dea62eaef7432072387c7c11df56c48c0e364fd9dabfd54409c9e75f5992919a83a78d473b06a3a951c3d58ec391a1d531453848fa2f605556c7a556c9aae697a97c2c22ee977b1b482d61b6b52fb0d8e5dc8e2bf7e6d95b8c9336ca4e4673866fd0f750bb9e850206f94638558a1af7029858e000f88518a6230bfd3efea428a6a3814c5e1f0118b43334d955f78e1d68d7c63b0516b6c3714c3211494416edce94062938b0c461e7d0b2f25cddc5e57d8599349172fdd1870563bb9730bbf8b042f0dc45640f4dcc3f379055756a07972a4b215d71c3c437e1565207a3bed265e4001aac0d2144750623d5fb37eaa374f4e7ffac13307078156cd1878f078d5c1e37907f33cf65a48441755e5832c56dbe5fdcdb3432fc6dab0aaaaaa8e2c4d4f133686b30e4a49c7d33ff4e1bf763ce3182b467452b7fc12dcf04b70c62f523a95445a4b4b3afb02ed463a2b22b9a18ce2a3b451ba42ba61b82008953b9c4e9fcb8873b90c95739f50e2845088490125e95a81c634c5e9727161380c4355b8e15284c77889f746a70a3ea15abc321037ceb5cbb5cf25f6b918b9562065ba14573d9bfa5c209245f27ad488dd2e760b5e2002a24208511ce14a149624ae91df54204571d433e378d5f41950088f948225077c5a1f31e74862713baf25104f71b1842515066948c4e253e97be68d5b82efb18eaced2cde65366b1b7c37f81e5f7a66babae5cc9bbcf0641f68e030e8cd23908c9b92697da0ad8327a839b1a3dc95b1a392af4cfd38765feae15867e7e4dda9bc289979502999c8c7781c633cda03d16c8c72bb5952b214924f704ecce0cc139f43ba47afd0f7eb8a7e7d7e6a20b53a55a4266f655544bc92b8a50c6c37e3052cc02a9860c529cc12c1258d95a1ea44d5c0a3b616d83ad05405aa30db34ccb24342427c5c14d7b5f4f42e1d3b141676ee9495959eceae9713e7c3576c9e3af26f35d7f47df5e50e553fac1c9b3fe2eebdea96f267e65cf9de753da39d3f172f1cdcb93736031d828654420e1abd19e8586254d218364619675c4af7d203ec01759be1f4187e6c922f98429ad64a55e25455610d7a823d9311b0d4c8968256cf6f08b83dea3875a52afc6a8dba5d15ea0bfc559812ce2b37e68b71828b7a7e5720daa3f8950a65a5a290e251f62b42d9ca3e81e55a245a90372fc90355385ee53d6a25bc472d61400f3c47cf5581f59afc16aecda460873a623a515e259461ba259e586843fbe04bc1df58db2d7c1ccb53b79c5aab8cc08c8f60c67d31e348363370bb50594c3f3e955fc797386e766ee69b8c2d919f38bfe74e3ff9999fa74576e55dd4a2c80146dfc85191938dcb5cd5eeabf599c6d58eb9ae69ee878d875c4ff227235fe7af393f14bbddc91ad71c9a53898c8fec23347d3b8f6c501adda52b2e5f44645c444424b4c3a5406b203f1ee1c2760aa98f4bca32b6226277c4fe08411105118188ea8869116a443dab7acead7fc721ecca0d2582892d6cbd54a980af9a310ff34b65aa8162ed6782902f40be9a4d631af6f0feba2896b885efe3ef91ad6455d3a71f3d5e75d4731482ad6ad03388560ad690925521da86441412e4cd3f6a0b7ac33d3ad3ebcdbd1ba2933ae9f25b865c9190795e952d7592df3e11888bf0b88b22bd5100a83fb288fb5d45d6f71cb0bc4a86a5c1c2c426241676e982ad2a3a07df9f1d9cca7a6eea9990d9fed65decc233d5bcbb981fbce8ded29efd5f61ad4f4fc05e1d6b7eabf4564a289ddab3a70297cfc959947c43ca4da94b72d41845687eea285c317d927ba7f4cfbe39f996eccdc96f247f9afc69f6892c574212cbeff8a138947fa8607fc7d379bfe4ff52606424758ba98c991c3329e9daa4cdf47cf2277c8ff7c3a443c9df651fc9891a9dc4da67a48a96517a34a334338365d4b38440726a0136f3b4d4dda9fb53d5d4b428b753b48d6dcb8fb5656de5772b75482ab1684e9c4dd3632c1a486de92e699b1de782121077e3238fc6d195380d8e41cfeb4546a0755a006dd30268981640abb4005ab8d39809f5cd5574bdb7af25f3b4f4b7e42deb795920396268744742053ecdbdddcdc9ed71fbdd056ed3adbaeb7949c0d9d10fe5ce7033c6646d6f6eefc44049e77189ac203190b82b715fa29298d4a1f44d6fde20b9a5f2061e3d3efd68954cce387ef434cc2e959c41317e701e971c950950eb083a3a1d6732938773224e6682adada219d3d974b9da1e16701611c0020e5087bdd29554c5320b0b3b768085d2742d3e2e312d2b5bd3d25b6575ee54d8a5507eef6a567a2b9c2cba7535419aaf2eecdbe0a1821ffef1ce8ee88eb9dee0e168a5e489610bfffee2cfef94c50ce83fb092b1e4bcbda5f9fdbaf79c5994c07ff3deb172d5ec82a9dfbc747eef61dd7af4297fe6e6fb37c5467b8b33daf528096ed5b5e40e19e775282bb9783284722df46721f427853605baa6a4b0dc884a5e29a6f029e25a7eadb8469dd6e2e69475f4345f23fe9efc744a1ddbc89f8fae6d119be7eccafb71c192282ac64df5bc55c095948d5dec66dbdccc2df32531d92e9d325809bb927137c35e3719cb4776305bca56b06dd882eede14e589f24789a8e4160919f27cf0ebc76001be4e6d3dd2f2808ecaf37fe0d1222cc48c7cb90a07ab66e023daf284eca36d065335c5125e4c06649aa86649e98504275ab1c4b2e04f756ffdab86b57a66ebfea8e00fceca7ec36a068e2d2b5bc06ada6e79e5a70f9e619dd6ef58d9a272f8bc5fa75e38f112f9dfd2cc35bf552badf32f95de0bdc97993258f48a181c37c03b20754eaadeddd9cddb2d65747c45cb052d9fa435093be95b3a14f52bfd2c7e7346e53a73e267c74c6ba9c40be86624672c2a32d9c563559e1829a218b9ddfe281617851473c666abae640829ca0d31d05056c360aee4776f8995ac16669125202f0d96ca5a7a32c89087cd3178635fb76089addfb14dd6519cfe904efed13ccb581dc56ff84084562616912dabc5519ee21d962182254a4beb12d237ead8211196c656324befb8921d3ce61d74dfb855ef30ffd10fa7cc64bed35d660e1fb478c8bc21d73d36b3bce781cf4cf6d01a9e79eac48c05533e9b30f38ee021486c36b4681ab4281127c3dec09d37c72cf1f1441f8bb9d57173e4c2a8a30e25d6f038129c22d548863fe58d4e8a8ff5c5f82b0d638967b1ef45c7a6a8b71d9f3abe32701238633cccc33dc2a3785a7a7cbd7d657ee7c8c88991d7e87362e6f86ed1eff53fee5815b955df66ec323e36763b3f711dd67f304eeabf193fc59d4a3dee4bc88bbe39868ff25dea7bcc29fc86779b9f2dc56155cf7f08244afb5fc178851433635a4c8bec58ddf1b621cd52664e274903f1492d3b55186c30dc5b4bdcbb2170d5a8e77d031d63b4ec089731cff1760befed5edec2cbbcbd29c193e04f10090b5af9336e449719b6dd39e656dc5fa7855518be1b3e674c3f2ef5b797fc9a27cdb68b9a1cb86da24d61e6b4907d94b40ec6cefe9e1b698460774a8e4a8b92d4421ac51601b46a212d630b69195b041a2a47cb9d029fa86a46310b6d100410d824b049d6d01ef3df75ce22871cc15964d8c4ca39ec9cc3ce4559b9f55145e1efe0c1e1846ed2ec6dd54595ea439d3b75294c93562c3364b27465ec99023677d45248b8fcd4431f068fcf5dc53abcfa4df024bbacb2f2f624b625da71d90df7e43df82073effb64cd373f7e3c696cac73d6ac453742838662e33d8e3d87088de981257e473f51e358e9d8ed38e6d01298577037770b78e886ea55bcea6a7d9de37565a7b653ff483bca8f8a434a64ba92aee63b0ab5427da43a4a5be058a62dd35769abf44322d2e0862087a8e5b5623b87abcd778b1ff80fc2e0980813384c88ab4c8363af334df3eb14274b6ac44a510b6f5cae4a625227512f3203510a224905ad7427ac15ce92fbeab4a1b07ef7215cc28152a3b3c1e0fe0e4387ebba797d688b4ecf83ef1a76264a8a3d27f2a637daa245565077d65d2719dd41dad3198e915024c316325f61f0404be6fb227840dd123c5d73ea1319c120c8535ec0ae4b625302cf397566c8ffcf5637dc4a8ca1f9532a0c91c4d9b39ecff4c3fa618f72880eb9bff388373d3b13767a3ff528cf453c1ff9babed3a53c195f676c723e87c030b18ff6a4f3c9482533b18bb34b64619c924919ceac48b1d7f991ebe328b1c6cdfeae3fed783a4accd5af75cff5883e4e787e4ec113bd5e98b98808b7c3e932e299d770b9fc116eb8736ee6f5fa93282e29895c1111de24674caeaa33d2dc1194e4710d8db03c81be9d6b22d80f116604f747ec8ae0ee88fc889208e18f981fc123ea7987408477e8e0249674477244629225d781a1a808bedaf4e9d81d47c31191347e216f2de406478584bc386ac70ed840fb23142a36fcc80d626f0fc33c56e72972c38b0371d65bb94890f59e22d6681be8a1e35b474815d67d0d19d689795227aebfe8c6fbd2fe163c705d6acf6e25cbdbf8732e081e50b2968c2e5f36afeb43679ee2172c4eee5272d9a81edb82e743efe7c172be85358c40acf56ca053ffa4dda9a7927e4b56de4a7a3399b7e6d9464e4c7652df98fe4915a91395394937271d4b7579a415f04803e0c916d035db9e481a28406162b6c31599a105720b3a6981be9db54059e775da2e8d8fd3966aeb345343b0e2d1fc5a85764c53b57a561e48f0a7b2d4b80c8ffc163f3f3c30415fa7b41e68992f78c3d34f5826280ff60bae8f84941f4416eba1b40e148fcf565959acd3d973b74be13c3690b98f3023b8297864d9a119a2c3ec0bab6a2ae65d38ab6206dbccb2d9b8e0994f83c1e0cd733e63e513af9df9e9d8198b262c256efe129ca2ec85343cd4924e056e1f18d92fa64f4259eac418b593abafbbc23f31669aff7e7ad0fda067353de9dee4de10f306ed8cdae9f9d6edb9cd7d9b8767383312b881bdee8e9d18bddbaff2e82837e3292c2a2e222a9a0b0fc3f9eba1388f9caa9602658c835187d1f666acc381c20d29b3a58669f071862c10f62950614c93a7002b7fdeef670b709c583bdf6def7c0f79d86e9c591ebf67018ead245f3d5bb67e64c8959c31107bdf532545383d6fc6d1ff3ca21b9dd03b2cc59c6e2b6458c73c08615b658b73ce6818ad6ce6491c75ffa8a7de5ab7ec9df7a7ce0c1e60fbe60eedbb70d48cd143170f50b22eefd7e39b83c103af3dbdf6ccc762ccbc5b2efd61e2ecf9577f256d46299190fae6a60381aa4c9ee9ece4d8293e8df83e421b2a6040b488c4884cca8acc8fee1259ae8f728d8bbe529fa62d66afd3cec89dee8f22bf8d8c891409fc41fdbe286584be4ce79c8bc828a67187c223595494df4d716ef8336ea7a39e3d1b702872bbe35894875a20eabcce151af3684c2a20d7a42b1eedd759b5be40e7fa1deba259749494e980e707c387bcc3e34670b699258482b3834765f83fe3a0a58c0ddb3d2cc8224b8e528a86f4736620e29a6149111e8e6ec94cee4f3f8bc85bb6ae47df2bb2db0c7860646e1fb931dffdd677246ada0b6f0537403a6db11b2f8374dab0bacd946eee0f3870b67afdf8c8acc7d1e9284a0709dce62af2b4f3b72b68176857d14e754619ad0b5d7d2366a77f1ab927f350a4a1a7ab9909e9b19919997d9c65e93a6493bcbb9df0b7ebd4aa30b3ac55dfcc40bb2aba206a787c45c2d0c45119c3b3c6b5a968373b6f51def2a835f12bf356b6a96df756fc5b09dbf376b4f92d39c5feef15fc69add23332b322e3724961893e2f737b7dde71de2b7116ca6029262635370e079215dcae64db99c2ea456ac01da3e4e6babcbdf3134b12075bb794c66e34327667b36cb91ad9aece94edc9f667176407b2d5ec3bdaf97a7b58463e311988f10a5a47bbe807522ce73e6230b68e67b787fba1e9f5ec890d6d4b6df7667ae8be947472f2ace839ece528b65552425e8e12f27224ad83d762c742584d3b7a7e4e61718c5355a5d53a10972a4d5caa747452a59d4b0d3434c17845d69649b41c9ce9345dfa37f2526c6682657c3a77cacecacec8ce0a39280809b2a50620d24a90bf08bbe0fcb6650999578cbba87bebf884f1c1d33dc65f7823e3efbc971afc353e3f3066cce09ca49bdfeb7b49f0db6f4eb1d66d46f76fd332af4562827f648741d75d77c1fc650bda756b915d9c9d93ecc939affbb0abeffbe269e8ce72f35be15797e1347e3bf0f360b154ec13f8c712157697718feb53455cabdca42c346e4a521873eb858a88148f88d7c56bcac7e2a0a2e588f96289109ceb8a2abf4550d71c9a378127a8d15ab4eef124441f32f67bbe4b3aa645ef4bd9cf0e2a0734659ffeb1b12ffae3246587b6c3f33efb50519e37b645ef603b15e5096395e349ef1349b5ec055d5b10bd20e56e6599b1ccb152d1467be738e67a17680bf4051ead555299d2d7315a8c7654c66bad8c2c87df9311dd363ecbabc13208bfe257d3b43470e27229de840491241248371417e9aae2c29e17090cd794286754b42756d4f37e81d68ae252840b4e711ceaeb6e622624938d681656f21874273bd615fd76ad5422f8d491dadb3a7c265367b5709b5ee06311851a300a0e177b7b05da754c922622de955193509bb03d41d8fef6f684e3096ac2167e3e25b378e9645937480f1e9f71d073f01acfbfa18edefce3c7a71fc47125a37444eec58ba3ecfb37e4cd97c163519efc70e367b17410a44f70ae4b20e378b81696df1cdba563974cd1514f17a1c34db763a72eb1cbdbdc96cefa0f5cd7a6b62a29b74becf96d070cba7f4966a518b267cd6bc19a3dc15e73a3d332f53deeab27b55fcfd6ca6f42877539ae6481ef018139dcf01475779c1737d03130ee09558d7546bbb8e1f55292378772bcfed47ede69a92b5377a73a299539c9c90cb7e149e25e4f527266446674d7e47ec923a286474f8c9c187549f46c7e75d455d18ba277a8af7b5e4bfc90ef4bf828f9582a6c476c4c6c5c8c5b28aaf0c4eaf1b151ee98e897cc93140528e6cfe4358f054aa37174b96360b56398a2f8bd140726082aead1a2639c7a6ebccb9b92e38e21af277af6fc985d31dc175312333846a0ba3f667ecc0f3122a61e315f9a92415e56e35de9adf56ef7eef6aa7e6f81977b1d3189de446f8a73c84869c58bb14bf3b140cc76dd6cc72dcfb39da429b77d37ac947af61e26eb8a1fb958d6299958b4d8f0ecc041197240a489cf83936c2f4c0fdea5b04b2cdce52ea10562ed98ef466fefce590306f548894db84cbacfc75bd6eeba71592b25ebccadd353db95b6e87e7e8f7693d8c9539fd43cbdecba2e4f60e2e6fbf0aabfc12ab97861e0e398e158b7481990c66ab1ba3fb222b23ad2700a5575b90a22039163690c1b678c768c74398b453fd14f9b48978a25b482968bbb35476bd15669ab66e919465ba73fb290178a42a3d05110594efd593f3e48942be5ea40ad9f3ec8514917884ac7149acc2e12d5ca25dac5aeab95398e6b9cb35d37d38d6cb16305ddc3ee77dcef7cc85513f98d6823346c3ea1c0eb54758ea3cde174184e15d6835cc45c8ac3e104d72e1ce70e4435ccd075555534a7cbc5e4039c83da4227736ee16330c3be01a7bc3376502cb46e8d8d798e2f3418e2dd3181886a7da55eab6fd7f7ebaa5ecfb3376987c54295a95bd14ee10348b0b702ad7c9cb9b98f8fe3c2c7fd2057f2f97c295fc7b7f15d7c1fff81bbf816e86e44689b6227ce3878fc6895e70c8e892a8f4c54c9ac748b3cd6d30cf909bbae1b9e62a378b1fcfcdb0eb9e4a1cc8ec5e1bbda1b29e049ec6439150e2428c7e196b9bd75a0f631215544c652d8c3d6cdb8689727a648004a40d2d82254dfbdc955447e97e5e96f8a2e124674915a6feeaf8b2ea27af3cbba18497e420ec1f05e79ddeb91d7b7079cee2297d78dbcdb0e0b42dfcc2befe25a41024b63d63d767cf2eec17f0757b223c19f58fb075924ab0ac6b288e02e961bfc1012d382ff64f9673e0e32fa5f442545460d0a656e6473747265616d0d656e646f626a0d31392030206f626a0d3c3c2f42617365466f6e74202f564d424351562b417269616c4d54202f44657363656e64616e74466f6e7473205b3231203020525d202f456e636f64696e67202f4964656e746974792d48202f53756274797065202f5479706530202f546f556e69636f646520323020302052202f54797065202f466f6e743e3e0d656e646f626a0d32302030206f626a0d3c3c2f46696c746572202f466c6174654465636f6465202f4c656e677468203439393e3e0d0a73747265616d0d0a789c5d94cb8adb301486f7790a2da78bc1968f8e34032190491ac8a2179af6011c5b490d8d6d1c6791b7afa26f98420d097c48f27f41c7c566bfddf7dd6c8aefd3d01ce26c4e5ddf4ef13adca6269a633c77fdc256a6ed9af99df27f73a9c745910e1feed7395ef6fd6930cb65f123ad5de7e96e9ed6ed708c9f4cf16d6ae3d4f567f3f46b73487cb88de39f7889fd6ccad5cab4f1945ef3a51ebfd697688a7cea79dfa6e56ebe3fa723ff76fcbc8fd154992d569aa18dd7b16ee254f7e7b85896e95999e52e3dab45ecdbffd6bd70ec786a7ed753de2e697b5956e52a934215142007bd421e7a835ea00df40a6da135b48336996c096d210b7d862a6807e14c70661d64217c0a3ead8704c2b5e0dabe400a9141c860d75080482424b2241212591209892af41c7a157a0ebd0a058742858243a142c1a19042677acb24f4e2e845e8c5d18bd08ba317a117a517a109a509c199e24c70a638139c29ce04678a33c199e24cc8ae647734ef69dea1e7d173e879f41c7a1e3d47f39ee61dea1e7587ba47dda1ee5177a8fb77755af2b4e4b84b9ebba474e6e94ce9ccd399d299a733a5b340674a8640062543208392219041c910c8a0b80eb8565c075c2bae03ae95fb12f27db1552659fb3c92efb3f718cef405311f93dfdca6290d7dfecce4697fcc79d7c78f2fd1388c269d7afcfe0213d218720d0a656e6473747265616d0d656e646f626a0d32312030206f626a0d3c3c2f42617365466f6e74202f564d424351562b417269616c4d54202f43494453797374656d496e666f20323620302052202f434944546f4749444d6170202f4964656e74697479202f445720373530202f466f6e7444657363726970746f7220323220302052202f53756274797065202f434944466f6e745479706532202f54797065202f466f6e74202f57205b33205b3237375d2035205b3335345d2037205b3535365d2039205b3636365d20313120313220333333203133205b3338395d203135205b323737203333335d2031372031382032373720313920323820353536203239205b3237375d20333820333920373232203431205b36313020373737203732325d203436205b3636365d203438205b3833332037323220373737203636365d203533205b37323220363636203631305d203537205b363636203934335d2035392036302036363620363820363920353536203730205b3530302035353620353536203237372035353620353536203232325d203738205b35303020323232203833332035353620353536203535365d203835205b3333332035303020323737203535365d203930205b3732322035303020353030203530305d20333031205b3739375d5d3e3e0d656e646f626a0d32322030206f626a0d3c3c2f417363656e742031303339202f417667576964746820343431202f43617048656967687420373136202f44657363656e74202d333234202f466c616773203332202f466f6e7442426f78205b2d363634202d333234203230303020313033395d202f466f6e7446616d696c792028417269616c29202f466f6e7446696c653220323320302052202f466f6e744e616d65202f564d424351562b417269616c4d54202f466f6e7453747265746368202f4e6f726d616c202f466f6e7457656967687420343030202f4974616c6963416e676c652030202f4d617857696474682032303030202f4d697373696e67576964746820373530202f5374656d56203536202f54797065202f466f6e7444657363726970746f72202f58486569676874203531383e3e0d656e646f626a0d32332030206f626a0d3c3c2f46696c746572202f466c6174654465636f6465202f4c656e677468203334393634202f4c656e677468312037393130383e3e0d0a73747265616d0d0a789cecbd09785445d6067caaeed24bba93cebe271d9a84a5814002844024cd16046427214122fb0eb204374409b21a1151470671c31d50b4130284653e187574640675dc66dc517117751c64dcc8fddfaa7b6f0871c199effb9fff79fe27e9bcf754d5adf5d4a9734ed5bd9d10232217559342be454b662cbab7eee34f89c6b625f2e42e9872e5a2c41b5d8f23c7b7807ffec269535c83436d88663c45543279f682a55796cdde8f5b2c09f109b367cf9812939f3209092f036d119dfed9b0b26308df09f49c35ffaa9943afdd3482e851d4bffeed998b662de8f560429068f052a288f0b4cb97fa771d7e6723d1a47144faa524fae64045ef3ef2e0a4a8a26f9ca94e123ff7bddfaea3a0afae3ef1f9f78f9f99e523e768390a264b90b83afa368ea0013efafef1ef97f9c84a6ffa89de2c52a27fcff750111d451b9c7c14a2b5445aa2f63969c475ab082f6c4298ff9d2e51ab281e18e248a72bb4322a67eb6802df49cb0594740aa98fd212e4dd89783fd003a22cf29702ef004540199062a50d07a60063451c79f78bb2a86391a847d22a9ae0cca4855a997106ed6dd69ea199c0dd08dfa7be4fdbf5425a80f803287758252a10795066b3be93b620fd4edc9f86b4bb41cb11bf17e18928d7d50abb1c3752b2a0808ef40ea8e7066bbced943f524fb5ca781763a9409d4381b56863146809300c796241fb03ebd833b49e3d63dc87fba0b40aedaf13e9c0408b5e887ad6e07e31cab5457c15c229e8870e1a056401edf9a354c8e3e810682ec63fde1c37f00ccd16636e1a13fa6ff5e9a730fb38ac39d0e61f80002f343e007535eb5b4bac6a81214a3e5583ce035281d1fc182d502f22067eddae7d408a002453f0e96de002753a8d409ca19f63b57ada2ae2c070892ae38c7a276d534e512fdc5ba66fc638a683dfdd80d394cb3fa7ce7a36ad807c0d44fd2b81bb51e7c7521ea6d338b4df05345ffd40cad05a6003dafad2e693e00de22b31af63d0d68f62c5a0fc586030e6a51a982ffa83f67305cfc5bcb3b2c642e43d813c1305909e2881b10b9914654479d4956dc9e17d6729dd873c3782afc74155205ef4c18694330bb8f734ea490674201de8027c00dc07cc037a03c380f6689bd0ae22e51532236453ca0764437b063c44dfa4cc9a63b85bcea7b966eeb5ea12ed64e98fd23c0b59a24eb15e84cca22fb576dd624d0999b1a994ef7952eebf10e31432d544b1f6d4cf68b0e8835c83902d9b8a75873e8bf5b09997d27a491fa555426645ff6c2af822644df2046bc2a245cdc6da55ae1150852860c9fa2a9bdabc68a2b3e901d439599f0a9db28d2e5497d285cacd3455fd8a062a1da88bd61569180ff286f96734c67984f231972311bfbd05dd22e07885cdd58e609c8f809fafd05de0e962f515de467d8569da23c6271ab167b547f8b532fc13da12ec88794f5081e6f7fed3f4ff06fc55ed11e8cc478c4fb5570c03e3b945ac09c767ac2be0b729d2eb806aa0a333c8b638e7b1064729f974a253c0423544bdb51015a847303ff1d0f3580b482fd5dea5c3ca8d98eb578cd758355573d4e188a7297c33741adae2afd22a01513fe8a26672748eccb594259bdaf2da920a9d6fc95426a88ef5f79c8513164e03df408e86412693856d10fa59da07e86860ad25af739be4f3597a10f4065b3e5bc8e9dc16f2e96929972da9b42dd0eff63a455bd7dbe317fa51e838a123859e137ac6cedf92362b5fc377428e851e3e4613ac75ddc6c250f4f13d6bed430f63bec71b865e623cacd71bdb951863bb9e87f03f00cd7818bcb8b2c9a6961b8d963ded60db52339d226c3baae5d3024b9f3d20f5cdd7f43b6947cb64ff5cfae3b442fb01f30e1d28fbbbcd5a83e027fa3d4f9d0c9e6fa50d1847b2b20eeb11e9c044c11339174449c22e089ba8dc063e0b5b7423ad52de80bf20cae653b4b417c5341e7d7f56a6c1a60a2ad2b4f1749ffe19e5a9a5d0b54768ba982b310ed11f31f7cecbc8eb8c879e7885baa93b90279edcc8b74df220440f4bb91065e7c107022f1cd3c801991d813ca2be7b659910c558fc7840f24296872f226458f00275eaf13446fa139fd13d5a298dc71abad7514df7eaa55873f1b41d753c887243455f502e45daebdbe862acaff5d04deba17348caff04e307e5118ce74ae87540a9068f1ea124ad1a3c9c27c73e503575ec3ab17e949d94236444bf0d7a58f813b7518d1aa441fa3cba1169376ad09368f706a4adc6fa0d62ed5e8ff29996de26b47d3dd245d962e1cb081f41ac17478862f56ae90790ec83f053d0bef209ddab0ca5f590e37ecedbc08735d4997ed38ff1a849191c4ce339c547d78016f07c7a112d44202c6ce87e7525cd51cb284fe986b51b4d9dd5bf61ad7e4777285134493d4a77a80db441c4d5586aaf8431fe7af89622fd791a25d2f98b886fa1096a11caafa74bd54954a5d442f65e26b73a13738d72da46c8495b94ff1af55a60efd304a50c6b6b2dc2dfc10e229f6ca3de1822a05e489d65b966907db5d1a2cf7c18463514738afe8af039fd455f9bfa69f7f167fa27c729ea45399147bd035e3b196f02d9266d1ccd6fa447806dfc751aa00ca7abd876e300985cd20217368fab3dd872a08bda83f6012b11ee04fa3fc0e3661cbe5b0f7a035883ba8f80ee16fb0201de9f7a0a8ab4bb812dc05fec7bcd21daf9b9f4e6d0528d03e7c4f7c0d600ec947140a0657ef0b927daeba95e601c10802c0e15d057509ce3728a53da213d03e55ac4b554aca73dd45621e3dfe7ebd3af013fdd9af131d47c8cf67c8026fc06bcd98cfa05b56cc37fddb7ff1698df68a0abe4ef17146fca10c5b2578dbf8396b157295ab90c320820de05f1589b9ff63c21fd5699de62fe787fa351f0bc657acb78cb793d5f9cefa649cd61cb41933cdc427d05d462e4075ac69dcf525f01fd4fb8f7a79fc6d587cf8309d451d92afa04196cf7d3b83e92da09f0b6e86b8a2883350734c59f878e00445e59de4b8305c4da15e0f5d8af014df77bd02081b37ca59e82afca56f3be3d3ff6bcb49c1ff4af9bfa1cf5036d07da1b742ce8509b365fb32dd76dcb345b97fc5c9e166ba3db2fd5f9ff2760ed1c059e019efe7fbb2d469055c007e86fc20f29861ff90afc938b6915d119e8921f738187a087c681fe1d69b0de8d1d002fc2d1489b057a17d10fdf20bc04e9af9830b89a4adb2cbf3219697badb24eabbeb166f91ffe4cf4fd29e071b3fc0f3b81b908ff13803dffe12dd03f826e41fe4f516e35e813e6fd339310bf1c3884f86788cf07ca11de041a0fda09880562507eb380f0477eb20ffd3fa73fbffff8ad143ecb34f433539c79812e6fb987f8cdd49ecff3d0967b0d7bfecf479b9d19b4a0261fb0677a0f7e5fb8f9dee7d7f63836c57c3636875a6a9c814fe9117eb4f06585ff2cfd478bcafd9bf463d12e519c4d85ef2cfc57e13b0bff15f45e7966a0c9fe948a7dbeec9765379aeb56768aee067c40aa45e721cf77bc9df11c744f14e4fb1bec8d1e10401c324665268ce761bba260eb0e43ef7e037a0cf174d06f6c9b66ebd69fe8d8f3d8b4ffebf87f6a23ff0b9b9a6761520bfc52ba8d5e168608b4b4c5ff29ce67bbff6b5bfe0b36bab99dfedfc66d3b6fc3d597f2041c21e380404bbff4277ec079e2e7f373ffd3784bbfe33f8eb7f04bec784bfce47e4bd9b3fd99144a69428b75f79f42ec2dd43d677d7fbb0f2dd771d37ab3e2e0d1a0e6801e686fd9d0fb807f4167a403b051c62d885febfc91f29cbb280ff1f500eca2510c4c17f7407bb21bc5f9b67106f1eb10f7a9c764de720bd3cf27cf2de556f8e7d23f04cfa41edc24fa4fb9401f2006a80516d8732df69068fb3887d515fb5c7582f18dfa1cd0c2073c2fed418b815d8847211e055d1ca747436f87e861711e0fea067543bf8f3e7bc6679cd197c93c43e5d9f252ba107afe52f51571f6653c25cff41a29cae191cf5156c18666dae77488c78bb321875f9c97180dd6f9dc64fd6bd8c1f1b0872e613bd06e997c26344f15e7b85fd3ef94081a689d21c7d967c9e27c4ad82bbd0bf9e43946f373e4f7e11b4fa48140b16a3ea72a15e72fca07f259cd3a71eeae8ca043d6f3adb07b27dded7a86ee764ea712e70af9bc69b37227ad42da9d8e8d74a71e94cf574a6dbb2a6ce2cf9cfd89b3cc94a6334d6bcc2d7d02d9bf897491388f69deae5dce59025bfab53c8732cf31cfe3dbc0c6d700d3cde715c6e99f3fef34fe6a9d7bceb66cfce54d36bfe539fd441aad5c8b7d9f7d26fb10e8ab7489ba16b078dcb22f765be0cb995ff2856cdf04e1f1f2accf7cde23cea0629b3d872b917cfe44ced71031679a176b384accbfb15f359fcff557af447e4ec9ea978079f6289fcf89b361603c7f0df9efc61abd146b0532a8de2a9fe1adb680bcc643b2dc7cf3b9993e162846bf66a2dc4ef1ecc806ad390be3845a4a3512f25ccdb88fc719fb4197f0bfc8678c51d6b3c06475038d93679a679f0926a9ede5b9757b751c80f907ae42bcad1cbb4525af4228174543e418c5d95c1722dc732a7dac33522baf631f95384290d7082ad176535b6521fc9723d0756998bba198d7285aa5bc47196a2f9aa644d3740156623cc73e0385a72ec03f45fa6ba037232e9efdfe9d2eb19fab99e7d3f483c451f80a80f52c57608600dfc9b2ace784155638dd0c23ad90f64ad875eca4879a01f98cf7801ff8efd0767f9ace1bd0c636f405ed283eacbf164099a916da5bed0c56c7638d9d8b012d81b282e6b604d205cd6e092b3da525902e68ff96407aff9fe9c72fe5fba57efc527a4e4b203de7ffa01fbf546fa025901ef895fe0d6b09a40ffb0ffaf14b7c6edb12486ffb2bfd18d112481fd1b21fd04fd8c7363e8dbde9a3a0ffb0ecfd27a0178142fa1a9f12e7d8c04c2bfe0f2bdfef01ec7f8ddb01ec958dfe16a0f30cb1075e07fa39807db531fa2c1a9f054d33cfc8ed768c5b818e4099d99628db78d06c5bc26ab371b759fecc2ed03fb78827001f9aedc9b685ee3d001a00b65ae35b6fb51b36fbde78ebd9fc8d69e61865b9f059180a3006e53341c79e45e31e13c693a08f01e25cf419ab5f229c61f1438c799fa8ebac5ea0efd5add019938960abe31c3b4daa5e4d17499dfbfc39b66a91d487efd376a9ef0ce8be22cad3bdf043eea2fec26f103a5c9b21f3dfa04d876d22f827f015a4bf709c34f54f94ac7d4093d44b69a0b2177ef160e85bb4219fcba06ea1b785cfa15c4fc301f9ac523e1312cf4eaea475ee7ae9bff890274efd08fdbd9d0e63cfb65e2b2786f2baa30be29b60d7efa52bb5ab699973011dd6bf12cf4c6926ec55a63e890ab5ebe8427b6fab2f2097e6815f6051e7169ae6e884f49de4573fa434d73af8752fd028f0acc06ebbe9d9bd83e290fe9079be22e50ff831085c24fb8cfec20f53b1b78eb3df1bd02ac193e9b23f23e433a71da4628f4eda97b0dd43a8bdc305df2b97d6bb92689b7e1ae3d0e1a706e573f99916efbb8ae74f8e59d44d5b4739f6de5d3f013e8f23b74dc5f338fb3c00bedbbdea6ce92fc6c8e75ad6794013b5eb10cfdbaa69837857a2a55f63fb514d3e857546d074e6608f0754d8cfa6f15bb499bf619e291c817f1a4f41f11c4f9e89b4a4569fe473bc239025cb9f751ca6a10e05f4219aa9afa5b1da70f02596c63a9ea418c7604a12fe99c321fdba05c2466bdfc1171d4b39989b0100f614c65cf3b9985161ad7171e6f677602216e325569a38abc09c1b11482fb5cae2be7199b9cf9079c4f3b31a2b3cc0c274338f287be62d2bffae666735ef9890fb107f733fd57a976aed4fe8d967f7427e4ace4b7fe3199a58c3e29daa9f79c6df92de0a3adb8ec3cf7b076bf41694f503baed47b7a4aaf9bcff5a934adf50d0072d7abf9035e1ebb5a42ddf5ff9a5f7597ec58f35d7994dcf7defc5a6975834a7e9bd9cf3d0e6efc99ca58661c5237febd99d75e69662d39f79ffc03c933b4bf59fec9f9a533927a4587eacf0df87cae7fce2dd9c5f41d33b5cd74106ce459980789fe0e7a0c3920838e69f0bcbcfff45e837a11ce0cc6c09e35f02e8f34a13c61d163eb3709f80c2b09706d49b5bc2f897c4cfbf5f3750bf0bed02cece261ccf9a90feffaf003c20072ca93346525dd8c25f05bc0c01c797166eb061180236df6d3eda7cc1d83ec4b86737f5d96edfaaf77f3b8fffdb79f9bf1af7aff5bd39ac77f46c2adeddd37fb6df981f897f9990efd2eca4580b3af87a107804386ae15601ac9514f1ae923203f23443beafd854e627727023f6a60256dc7aff46d7e1d93992cc7520defd3141153fc71fc70c53fe1ced4c3ec9f7764cdfeb038cc36bbd633bd3d27d6d5da3e85eeb3dd94ca15b6077c53aefaafe91669eebf31963cdfdb4711feca486fcd1da522ae17f31eed79641277c65fc595b015f00405bab2d3c6b619be9fb198f5bef41eaf27de09db4a339b0b7cd1010794c3b693c68f9dbc28f5d62a2f12333fd6cbf6cddab7c8b71fc40c9f2fdd290dc5f8f52e7604f3f879295cf701ffe8278dea44ca17ec266283de15b89776eaeb4de9715670f6f839af0822fa394edcdd6b778bf46bc5703c87772c43c3d0d1b20f23f2dcbdbfbfbf6f27c691ef4f81b9429dffdc13df94e0fea10ef3a09bf48c18e421b09b9188dbca38dbf295b402fb4f02d7029fa5b4673f86aeaacccc47ef805f83bf1485f0c2c443809340aa800ee042ea76e32fd07c8c9f7c80f282ae27f05d5b0b7d790f69d850d26c47db9dfde4bd3e1134f477d66be576419133a4d674fc8b6a62bfd511ff271ec941478144abc15d6717f0dca1d36f7efe25c41e497f7ec3caeb3791cd750897b269528ab4073e147f4330eb04fa8489d40d198532fd00373fd9cb57f10fba6e70170cbb81bf1a3bce57b01f673728b6abb688e760175d6cec03f781372709c8ab4d37487564cedf551b0638fd292e66f2e89f789e5bbc4af18cfd967df36f4728a77fd8906630e49bcbf6153fe0820de762a95f648be4bcfb0dba247cc3ae5fbd3e65a937eae6320adc23a2e012eb4defb9e693e1f830f8ab5a79aefa9b6571fa474d4c4cd3d5423b86588f53016baa1e9ec5550f14e9b902dcb17143ee6a3fc45b1af455f528c037c146558652f36f7a58638affe1d20ce2cef6cf6fc69b3c0ffd7cfb7788be750bff4bce87cef669cef5d8d9fc4ffc3672a2ddfdd38dfbb1ce78db778e672bee7659055e12397c0ae1cd6771aaf20be0fb819faf50101950c439e8f9afedaf54a04d6f652ec4187505beb4c549c9366407f65a81be499fe5ab33e8a856eea6f9ecd1b3f5adf7390e7a9e26c4ef8a54a92fc1e448af5bd0651ff50ebfc567e6fa2e99cb63b950a5d2b74aab419e2dd6eecd3a06fa60bddc29fa57cfea3a983d82b122474913c97ec8f3ef697548679474ba7f42717cfc7586e35a14419cf4a9d1469ea2c85505f83d067b0bfa6be4a57524cfdc55f3675107f1b796c9c023e15cf6ac47e5aeea9c5de6c87b44ddf9b7a52ea42710e89b0fc3e8ab97f8a126b507c0fe67cfe92e55b3ed2821eb4e9f9fc42abcc2356999fe6b79eddc096c44a9bfc0c7510eff636edbb88f2e5bbd11fcafdca85b82f7c90b37ebe7dde2ee70973643edb672df705e2798e985b7b4f6f9e9b35bedc8c4e3221edb4e0e347f0cbdcb0bb17c936a0e3e4f39e2ae394d54fb13f49869cded0b4f7b3f772f65e83a88f7a373da0cc822fd455bc9324edfda166fbdb0704e43b24cfd283f25d6650a41d43be0b4dbb216dc89f801780bf015f00af9ae754675e13df1d127c69da0fdd23de1f68dcafbd097e3d4d2ee74594ac1f30fd15a59a9688737101f1bd0201f9dd291b3bc57b35f25da83ed67b84625f3fd0a2d0b93444eaf92af97c63a21203ff6014e4a4842e40bc1bc217a8d7c0576f279f5395a957c9efc4942ac9e0c3d9ef57e58934f55ae4cb95eff78e55afa652ed4f34577b89a669dfd243aea1f410e89d0aa73e5a3ff3fb13ea122a11fb34f815ebb81bfbb52a1a01fb1009df678de88bec0ff28b7b72dd2e864dbb9eb6a84fe2de47a00b0127ec582ee25fd116f6296d51aa304fc8a31c92ef4d6f513f07ed86fb0b2cfa06d216403ff890ef2dba599d4d4ebd023a672139d5f9402465ead85341cf4c441dbd50a69b6ce723d8c4276993ecc3cf41f469a1d5270bec53e314fab411742ff0badd979690fd680ed18f967537c747567f5ab4272078d11c822fead7d405ed6f06fe00bc8c3ef505d66903cee5577388be36e19b73fb2d796843f0b225046f6d445a7cfe1908be37871cf7fcb3f3d004f040cc899c0b4b0694c7d0b6088b718b3c5f997d143220656402717bfe219317c97e7f28fbbb45cda6b9b26f68472b812ec0dc831722cf98a63a4d79da28cb897cb827e750f44df0f971ea20fbf08c94ada1a25d715ff0533f4551fa5ee4791d6d2420cf340ac8b645dd6bcdfec9b273a0c350973e0ef73361ab3e409a4082794ff6df1a5753dfc5fc8bbea34ecd6bf61dbee416acd18bf4f6a82b03f997c3af1432520a3c4d25fae372ae6294006d813e68d3fcfb5a40a29526be1b3604e808e45b7141dbc875fc5b21d6fb6fc5b7522734c79de783d0072d90d7324d4d301e6d1e17fa0318c1e7803e28c38ef3d5237494d04fe703ecd8c3b6fe6ad986d06502f001229bf45a736ca3f1cdf82f792fde85564fd25d027a047c9a57688df63eade139d0eb39a837873a0119c034a02b900aa45be860ddcbb1e24ea0bd673395447a840d300e44be28a9f0bdb1a20cec638c3bcee703b7f4f56c1fb0653ef8894fb2578d49a09f80aef9a5775d7e29def25d9a96efc49caf5f3ff1495bbed7546f1cd7c838ae6e363e564f181f3b26c2277c9df21c91a0b15418b14f3e8bea049efc88c03ca04ad096fdfcadeffdffd6718bf704a54f71ccdc73897dbc7c66f0a8e57f54d104ec4bc57eff5ac4d31d8f518c1e4f49fa08ba5bfb1f5ae7d8412efdf5a67758d63a3790d7114b49ae48d8d9e7ac671cd8e76bf7c3ff5a28cf4a63e5778985ffdd860e2bb990cd03d02b4be14b55c0aedc416eb93f14fbc137e1c36c12df1135c459cd40e13b8967f4c26fb5bedb2cbec33c472fa29d1165c613cea1464c8487f2206703cfd9b3be4a9c6d97eff297986994c247631fb69d3a344bbbd0a21d2c6aa75f2ae94fdeb734bee35de846f9dee5edd82b1c96fb78e18b44c1878e1550db19ff16103cff35a8d5d45640f90073d82c7cdefd628b77f4cffb0efe79deb93fef1ad987b52760af937954220019ca30fd4b41e579d448d0ef40f798cf4b8dc12dc2643eb713549e65b505c65bb8a50572cde7434677a09beddf8bbd7df3ef1e89ef0e597bfe8ef6f783d481f0112f005ad241cdc2823fc8afb4831eec4a716c1975411d978b330eed53c8df5f81035402592f91e147e13ffc19f428e47b293d20ef0da207d5427ad031831e844cdf0199bd033ab4487b886a64b9ad7487ee42998374b3b6d3f85cbb1d6b4bd4b585d6e9e391ef63dc4fb7da82bed406c3d75980f03c9aa3fa5167128dd2aea15e3af67c7a32fadb8df6ca77502e36ae625b8d7b792665b2d78d7a358dfaeb3be83af895ebd4fbe147ef005d00cca20b952f4191ae8db7ee218c3de13a7d17e2e3115f60de87bf5222c357d246c4af634f18f7ab0b8ca79487b03fc27dfe34f9641b019aa4ae9265447bd7e90f59ed2ea6fee0e53a199f657cab2ec278fe8531d6cbb5bf9f6fa1364e4ef305b417a8c4f90a5d27f1824923e251ae8ad29c67bf4337bce53a6097d0adf69948cb77077f7236d11fe56ea5deb6dd10ef1488ef486acf1847d479c6fdeefb899c1ba14f4aa17bd6805afb391de9fa50f8382514abeb26d461d8537e4dc5fac51867cb339616fa5eeccd30de05ec519a007a31e8087b5f87babb6a1ad6f93cec9b04b2208702b5169ca66febea6b9c715c04ba12b482863a3b8066d250c76ee8c6e33fa5f20c8c281dba31463c8b6ff64cd08cf7a0cdfc6af9fdc618c88faec3ca40879243873fd49306ba3fa3698ebbe433bc18e489d6efa538ed0ef0f34ae8e46580bd377c95cab51f20330f517be542f8ce0fcb755464ee8d8d13f6de519d4e45cabfa0e3ccfa74bb5e35167a7f20ad5336d128015501ef05aec13e0ee077a1aeb990f3276895a31632bb589cb7d01a9d6017a640373e27fb22be4f3a44b9800ecbbf35d180bda0c03d724f3844fe5d8a99589747d18e9547cb697a96fb80b291e2f400dd89395b0759f85e9c1159efd9add36763dccb2843eb23cf3063b509b035f990e37da0d341ad38fa9081fce26c40bcb7196f7dc75550e1c7c65bcf2e7b414fc4c9efd78aef335c25df4550e5beb71b156befc1f717f3b4953638759a2a9f5bb4a70265337cf074f821e2cce97dba04792a845d14ef15b8aea644759bf1a5a33b6ce24bd01155c677d63b07f26f74f0af117e1abaec2be3b48ef1a91badbfcf311579a7620edfa75bc5df8c00c64960ce05d41990c537a49fbe46d5698db2033cd02843f90be6f076f1acc03ab7aaa264eb99f13ab917ccc79c7e6c9c568f00af88733023417d05a0c68fc5998af0e7c53916f46b06fb01f58d41bd4fd17add4febd1fe6cc8b6a8b354ec73242fc4fbabbff12c5589c77a8b3feb17fec45f3a9f4d6c71f6085b538bb50bf563f435df036a14ef1888f797f3019f8933ab897e5c0b88ef20cd409e6ea0fb4c9bd7384b799bde752e252f3e14ba78cdd2aa258b172dbc74c1fc7973e7cc9e3573c6d4caf2f165a5e3468ee8172aee7b41519fde85bd0a7a74cfcfebd635b74be74ec18e1ddab7cbc96e1b6893e5cfcc484f4b4d494e4a4c888f8b8d89f645457a3d116e97d3a16baac219751a142899ec0fe74c0eab39810b2fec2ce281294898d22c6172d88fa49273f384fd936536ffb93943c839b345ce909933d49493f9fc4554d4b9937f50c01f3e3630e06f60134697237ce3c040853f7c528687cbf02619f6229c958502fe4149b307fac36cb27f50b8e4f2d93583260f4475b511ee01810133dc9d3b51ad3b02c10884c2898145b52cb12f93019e38a8772d27a7179d0aa704060e0a2707068a1e8495ec4153a687478d2e1f3430352baba273a7301b302d30354c81fee1a8a0cc42036433617d40d8219bf1cf11a3a11bfcb59d8ed46c68f0d1d4c941cff4c0f42913cbc3ca940ad1467410ed0e0c272e3b9174368aca630694af6b7e3755a9199434c72fa23535ebfce16da3cb9bdfcd12d78a0ad481b23cbb64724d099ade00260e1beb476b7c4d457998ad41937e3112312a737c33028344cae4b9feb02bd03f30bb66ee644c4d4a4d98c65c9555979212da6f1ca79441fe9a71e581ac70716aa062cac0b4da38aa1973d5eee4903ff9dc3b9d3bd5faa24dc6d6464659018fb7796046d33d1992d94568d89826ce32d1a3c0100844d83fcd8f9e940730a65ee232a317d54ceb856cf8a96028159e8e199913760d985ce3eb2dd245f9b096ed0bf86bbe214840e0e4e7e7a64cb152f46cdf372482424e9a440df7ed7038180c77ec2844c43100738a3ef695f11e9d3b5ddec00381453e3f08d847a3c0db2915bd73c1feac2c31c1373484682a22e1ead1e566dc4f5353eb28941bac08f3c9e2ce11fb4e7ca9b8536ddf692a3e390049ae97dff28c0f3b739a7ea37c09b18366f70eb3845fb93dc3bc3f6c6c60d8e809e5fe4135932dde0e1b774eccbcdfabe99e150ac70e285752b915e2a98abc0ba19cd8945944ca3d61351bbfba14eae90d0e27a452a6307f49d837f942f35ae1cecafa8d851a8caf442949ce16b3ba19ee1d3c37dee79cf839ddf3d428e8b09ac3878d9b5053e33ee71e44cd6c70884520f134ae3ccb3f204ca55899d9f86d308ef412a8480d87c0b2012203e4cf4cb2a2e7644cb5c215f811d2d9b95309145d4d4d49c05f5233b9664a83513d35e0f7056af6f327f813358b064db605a7c13870436ab864430578359bf5eedc2920eed4d44caf25251bcd84526b990c140cb8a1223c325811084f0d06b202e5333096dadee4c91a377900429cfad706d8fad1b521b67eec84f2fd301ffef5e3caeb38e30326f7afa86d8b7be5fbfd301532958b549128227e11a1610caca9e34e993f757f88a85ade5565828c4f6b6024d39c761aa3690ddc4cf3990de5c88642c4714735ef84ecdc2ad29c665ab599bbbd95db893b3e71e70036d1f087c44df3a7169171e5217741a877a84fa82f2fe6e08848aa43ca01e4edc368775f56cc526b51e71899dcc0aa6bfb8452f7cb9ac65839ab9153a45537a5a1e7225bb38ad09e39f0d2b323289d50bebb2fa17e79458efee247685a74a2f91a928a49c8f9f860b987d70c1b0b091437ddbd52ddcd6efb45c1300b842705aecc12a30b9705aeca426220ec87b646a65a1a9c565153e3c72700ae4c2b2b37afe216eb94869a2ac2d553edbca9699089b3510f8a4ab9da9d267448536b57dbad2d416b22506337179ef6b3ada1f76176b1b8ca5fd9fdda9e1430db8795361bad99583301f298154e170d5bfd403432ad42d6809e6c913d61d2384d834f3053ac25bf5072509381a1b57c4450522669cdd0c0a0e9c82100a3db039395e59f5e217205c4a21182ff8b9958b34cc290c8ca6b7c7dec18b362e6f2ad09cf3a373abb295a22001f25bb8ba9263016b964b3c27353c3f32b824d59a68831d7606df7160bbcb72c3c586032cccee070f5b429e822eccd906901240c4582bf7caac94161a86b84e7346d0a8a092e5b2d852f0d9e53257402838a42456238e1ea51fec915fec9d0216c34989dea0f6ba0fe99709f025384de18658e6714943fc8949ab1284b62da52c30ee8b39953660484720d0b7937b92ffaa8a27734b63c4ca9353501c810ba985d82cca83e27ace70c1104bf8b82812933846737533876334c9703dd95dc11b5a50e0a6455200bcf96bc04e3b0d0a68acbb41ae137564e0e8213d1353135fec21a2cf84ae82a35675ad964e835bfcf5fe297533d2515313061888855a02233a32b5b644479f99b135e10acad74649f4d91bf0b836666a7ac553a11e151761687fc45607130cc137be1a6183c1b3341da054c94609e963d04ec0d41aa524569aca27196d930cb0f114553ed09338b21a5c2360090f7da6cb67e54734d38311c336cccc5a9606ce7da716bfa45289dc487b7a174ca54824a472a02ed58a7a7673628ed77e72465be7048e940c701ae74a80ba667ee57da29e9757d32430d4a60774c7c5e54bfce8a1f2a38575efdb82e041e070e032a4d523290eec37505500d3c0e1c065e00b0cfc555dcf5030b817b80e3e28e92aea4d5f9337dfdda29c9289b8c21442989f42560000afa9988561369243009b809b807d0653e91b21058011c06be9277424a62dd2df9e87b62dd0d92ec9e3b3f4f46a798d1899532ba7b7c8549878f36e9c02166b6de66b66eddcde42efd4ddaae934963b2f3aa05757bf38ef44b501230c804747c11ae8c3f45518c51266d53e2290c7045b752424acceeb63979f71c5654620a57184da74ce388c2eabcd179fddcdce05f520c65f22ff849f30e3fb93b323aef9e7e43f97bf438701850f87bf8bccbdfa515fcb8e039aec5c03dc061e079e04b40e7c7f179079fb7f9db14c5dfa25ca0189804dc031c06be041cfc2d5c7dfc4de1e4c9ab0817039cbf89ab8fbf8161bd816b147f1da1d7f9ebe8da4b75058579fb6520986b0532b3ad4062aa158849c86be02fd67dd7011295839986441d54da505fca57dad4657783f825d515cdc96ce0efeff60733b7f5ebca5fa630c0d19397d1f2cbe4074601938145808ed0ab08bd4ad5c026601b10062065b8fa003f3f0afc157895ba02216014e0e42fd4a19906fe7c5d4effcc7e09fc39fe0c2582e3c7f89f25fd2b7f5ad2bff03f49fa2c6806e851fe745d4626f58bc07d42199f383504cdc57d8dff7177db984ca35f343f0cde65e29a0b1403238149c04d80ce0ff33675d3336350c9413a8afd7826afa34f247d88ee7352686e6628670004d02f2e39bd2f4008977bfcf7e4f050cee6db1115979c8db720242e39ab3720242e39cb5622242e39f32f47485c72a6cf45485c72264c42485c72468e430897067ef7beb6ed320b46ce63fe7e51fc0a70e90a70e90a70e90a52f915e243dfa9a26f77d475ec088e6d0d053b74ccac866f7388558f61d5f7b1ea19acfa5a56bd925517b1ea4b58759055a7b1ea0c561d62d507592fb0a29a85eacf8916869258f55156bd8b5557b1ea1c569dcdaadbb26a3f2b0835f0acba21f9920c9264773fb1e8402fe80bed13c5b3c0d12cc87c1674c2615c9f070c190b2193bf8d99393943d036bb3b169bf12ebdf31662f93c89824f621a9ea477001513f424c4e84954f2242a88c2b51898041c01be040c4047ee36e8f84df21a856b2e500c4c0256005f02baecce9700a78556171f971d139dceb53a3e1250f993f8b4c1278b6785d27d69bea0ef42e5a6341695c146661819bc801212b0cf8a8976463730efde7f7bbffdb7975cfd5c7c23bf49a86ebec9a237d57d07d5cdb6d4e51cccec17cf7e4f192a248f15520ecb06ed455532de83d29c8276a734fe08685e5d5a198a45d5e574ca3cc02245a9bd99dfa59dc8fc24ad8123f871dac1ccbffb1b545697f90a521ed99bf972daf599cfe63638917228a781811cf0cbacfbd37a65ee3a2ab3aec48dad7599d70ab237f39ab4c199f3d2e48d19e68d4baa100b45658ec999907921ea1b9836353354853af76616a75d925964e6ea21caeccdec8a2e04cd604774b6439a6c34908194facc1ea5a5050d6c76a89363b3a3dc31d2d1d391e7e8e4c872643ad21da98e38678cd3e78c747a9c6ea7d3a93b5527779233aec1381e0a8a3fa21ca7cbbfa52cde8a62a4cab08f8bab7cc513eb9a39390da570ac328c0f1bdb9f0d0b1f9946c3a6fac3a7c7061a981b1b3f2dd09fc1b2d2b071fdc3bd82c31a1cc69870417058d831eae2f25ac636562035ccd763eb32aebc811922694daa3862d94f8c45afb93155d0f66b6eaca8a0a484cb8b938a63fa4617960cfc99cb64eb1a3cfb93744e38bd7f78f3b0b1e5753d76ee4cef5f11ce9361c3407858f8567114b39f7dcdbe1a34703ffba72015e5fb95beeceb416344bad2776045c5b0065626f3919ffd13f9203aff94f99cb0d2221ff99d1966bead66be6c9447beb682209fcb45d9325fb6cb25f3a94ce4abad6a3b68606ddbb6324fa29faa649eaa447ff33c47b391273b5be649a8a6a332cfd1846a9127dc5766494b43968c349985a5509acc92c6526496b2b35972ad2cd73765b95eb6a4b0b379d2cc3cdee3761eef71e409fed69f19fd8341b6bb4fc5b489e2186b7260d00c6072f886cb6727098fdc5f3badc23adfca993c75da6c41e1935604660c0c4f0b0cf4d7f699f833b7278adb7d02036b69e2a071e5b513433306d6f509f519149832b062f7e051dd0bce69ebfaa6b6ba8ffa99ca4689caba8bb60617fccced02717bb068ab40b45520da1a1c1a2cdb2229eaa3ca6b9dd4bf62c04493eee6116e88ed64f8f1fd137c8bfa4a19ee9395746dea01b82edb29225811f604fa87bd80b8d5b95fe77ee2169696b81529ce2aad5b49d7f6c94a3dc0b65bb77c488e0ef4a7e0d2cbaa2ea3a44173069abf55f841d2d2cb04c3cd6bb0ea977e706f5038346560d552a261e18e6387858bb1f9ad7538903a590c29dcdb4e8b8818d4601c3113bb20b1b7485494a68c22ad48a4b95c56c69fceff65161d205641353fb89b8532d852aaaa50c219c3c671688471d6a1d0013856c25654556080552cc8aaec3aac6e078364c6498cd9c6d2cbac90c58ba516354ba24895cd92a61fc1ac6013c796ca6a253b8313cbfb452a3d955cea07dfb92b6867d0cea079a0794a6e28262753e105992e674166847b60a6431f9869d75a1124ed00250329dac394ace688f7400df1fcfb63411be7181f8bfb82f24fa1351b2c106da75d6c0eeda2c3f404fb0aa51ea7fd544fc2ab1a4877d272fa1dad83a59c8094eb690c3e1ad27fc7928d7acaa57b612befa563c83b9eaea50394c0928c4f6805ad515e42a935e4a53618cc285a4837b28b8ccb6822bda3aea202ba882ea545acda2837361ab7180fd083b45ff9b37186222885a6e173ccf842fb87f1261830916ea3dbe91d768b6b0f85d04a3572de454b68ab52a9326396f13d7a904557a00f2a0da763ec080fa2f619f4114b62cb9501a8e57e236c3c855c695449b3692b1d603dd8609ea54d34861bc728016d5c895a6fa73ada8b4f03fd815e671eed2be301e32b4aa64e3404e3a9a7e7d811a5f1cccac662f1e50170a90315e2ce42fa1f7a865e6001f647be50f368795a485b66bc4c71d48d4ad1db8751f243f66f7e2d3e2b94a7d512a33f45822f370b6ed39fe85d96c272d94856c63bf085fc6e650939d162377ca6d31cf07b0b6a7f1bc2b8977bf8f3cafdea23ea0f7a7ae371231233924377d05df447e6c548fdac8a5dc75e65eff3017c12bf83bfa7fc4edda1bee89882515f420be8467a84fecd62582f369a5dcc66b3e56c1dbb99ddce8eb117d8c7bc1f1fc7e7f12f95d9ca62e50f6a7f7cc6aa55ea2a6dad7683fe716379e3538d7f6bfcb79167aca5d1908795e8fd6d743746b69f9ea7d7f07987de631a8b6091f8f859162b6557e3732dbb91ddc7b6b31dac1eadbcc0de639fc0b07dc37ee030db5ce7a9f0a5844715e04be0b4fe8edfc99fc7e705fe39ff4e4954da60b3db4329522a9485e8d53a65133e7b9477d514f579d5009ff3b4cdda3dda76ed11ed09ed2bdde3b80e0ec35f7fbcff4cc7336f3752e3fac6cd8d758df5c6bb148f39840dc21eae08bd9f82cf5cccf76648dce3f412f3807729ac23ebcb2e026726b1b96c31bb129c5ccdb6b20765df1f6387c0a5bfb32fd1672f4f937deec27bf0fe7c243e97f0197c317cbb5b783d7f957faf389408254a89573a2a83954a6586b254b94ad9ac8495bf2a6f29ef29a7951ff13154b79aa9b65173d4a03a589da45ea6dead7ea47ea44dd4fea27da0bbf505fa5abd41ff275ca4be8e518ed18e4ac74d8ebd8e979d93219d4fd21edad7fcbb31ecb8b25219a4eca18d3c5f4dc6aee839c8f3249aae0ce79054be9dade7d7b07ade56bb52efc3fbb011f4959a035e3fcdefe1a7791f65381bc6c6d25cf15f00c48f1ea7ee0429529fa493ea218ced39d47ca5ee61d7f22f750fd531f37b347f52baaa41e52ff4baf20e73a8f7d21baa9b25b293fc616514a4e00f6a5fad9cb2943be9316531bb86f6f04144ee1f9c1b20c723d84ee885712c8f7dab18d8108f80141528efd32a9ac7ff4127b18ed7d3efd97475166da47cb69c3ea287b02a3a6897ea1df578f62c9fa3d6f058564f5cdd219e87b3b64cd1e26835ab54b6ea5ff2d7e8327a5e75d3dbcaa3e8fdf3fc3165b8fa953686cdc60ab886d6d26263255da595ab2fb259a4b032ca568f43bb2d57f2d42cd015d02a13a1d3f662751f801ee8a70c474a1224e722c8452934c4567cb6404fa890a03958e3e3a1c59ea37a7d1c6fa0595a2483d62152ffd2388626180fd1edc62cbad4b8853a431fac3396a3c6edf401dd44dbd99ac6ab691176a7af616d5fa495f0e7b512a333afe1aff1b17cf3b9f30b6e67b324fa149fc710e9ab1da41af5ef34968a8d0dc62b90eef6d0b0b7d35478bf2730ca2fd0c285ca11ca6f1cc16b8d126511c6fb0e8d361e3632999b661bf369241da2071d1a4d710431c761f622c67b35cde0638ca5ca8cc639e0c34de082f89f249741ff5caf2e5657a9dfd106acf9cdd037dbb06e7662e588b56fffccff29589e0935c1843ec1c2e7448e07889c4f9b708d032071ae6f2121571279de248a447edf36a258d8aff84b8912ff41947221516a2451c66ca22c84b30e9c1f815144d9dc422351fb36441d369f45a73626726105bb7d48948f7ef5c831d12b8ea80face40539268aef26ea8f3e963c4434a4ffaf63b89b68e432a231dd89c621fff8f644e5cf115d8cf155ae269a546f62ea8f44d3d18fd918e3dc3bc1b6af8916b637b1083cbc2c85e8f29789ae7cddc40af469e57aa2d59083b52fb7a215adf86fb1feed56b4a215ad68452b5ad18a56b4a215ad68452b5ad18a56b4a215ad68452b5ad18a56b4a215ad68452b5ad18a56b4a215ad68452b5ad18a56b4a215ad68452b5ad18a56b4a215ad68452b5ad18a56b4a215ad68452b5ad18a56fc06883ff24e1a3ea49083fad77376427734f0db43b1a4a92714723bd4138c929dba76822b87783772b1db59174a0afa4e179d291ae13b5534fc4c111523ecfb11976e5db3a2b3a2b37161a4d28f7ee5c88f218d7e20bf7a44fcb3f04b94ddfc0aed009a8ba05bc36b82e5fb898c6f77b7c9eeae3518df86dae474e81ea1bb1d1aa98c344d8ff8c2e5742a0a2787b3c81de5aa76715783712414ef8deaee7a9b296a1167216f747796ec59fc7052109d098adef8ce042b8b64a77cf89c29c28545c714160a74ebca82c1d49087a90e37693a778a3f6f99545cec7b2ab1b06bb78a58a5477ebc922faf9bf28e757eabdbb1aeca6e96f8d5578d9f9857c1a72146673556ef471da91bf5e279621ca1ece5194ceddaa967cfdc92acd2ac51b9953de72ad3729729576455e55edd735d5675eec69ebe6e0dc6dbfb220a33fcfeb6dd3b89bfbcd9c91fe83ed7d9ab6382a7c09fd0b16b5604c57b0ac0438a2fc8eadaf5a8a720cee329e8eac92a5013f3f406fec0de511ad34eb2b403fc014ae5bb762766be146c603d42eeb8f884eac4c4388d3a36b0823ae6ce436a7d87979837ed00eb85ac5bea7a54e508deb9630abbe68472aa73949c063e2614d53121313133d3efefd52b2faf430794be359440f17171c160b76e11116e77570a5135bd80c96ce09e904beb52b5d0b7c2c77d07d846d259af5054b136525ba1dda4a95a72e13337c859a81c7ef2d4e293a07202accf99e69122dc0c9e3c75928a4f21fd5451b1b8f8ce9c90bf9527a263120bd7457609ae8bbce6a928fc74eb9a34e0aad0d0ac024f6cdbec40769b6c458fc9898cf24671bd20abc74896df1e974eb15d4652570f2e3db37b8d6459fe825edddbe58da4fcbcced141dc0ec6c6e5467543966e9e08127d085a179332f117fe3a063bae5cc9c49f21ac649510137faf6ea188081624ea90d7a0e4ee9bdfc1abe93a73231c72cd67def8d4b4b4c44cc4f6cc4f4c8c8f0b2254371fb390541ccccfcf0de6e5e6e7168b2ba2b910bfdc9463f9791033ad4717deae20213121313aa75d4e4e8fee053d0b207222c19193d32e3a213183c7c7e98e7845d7e3e31212637bf6ecd13da71d6b5cb7e36af79ef81e17cd5db8b4ac72fdc5bbe7de35f1f2a403be19e5eb3b8d9b5bf8c51fe6ceb96ad6d573e75c3fe5e697eaa3c73fb1a1cdcd032747f00be2fb75dd39ffc815a362cacaa2864f7d246deee29833dfb589cd9e7b4be9c1ef5d7bf5f6bef5951397679f49f0de5935f58a5c21e3e5c6db5a3bed25caa44ed4936d9632fee765f14b1296242eebb22c776dc243b96f917373fafd09fcfadc553df9aab4d559bc3e814d4e9c92c513e243097349d999f17a02af4aab4ae797a52c49e597d1d509bc2671552adf11ff58025f9551e3e735ee5569fc2ffea7dbf163094fa4f203294fc7f1393d0f24f0398933f2f98c5c56963fb1272fc99f90c98727f44fe55d530a33794e6a5b3fa7ce9d333a7771bb293521213dde9f90e0f71f70778e73bb3be774f0b1ee1d327a2b11a96bd303974c8e5d14bb2d56c98d0dc5f2d837d36f4a62490d7c42282db96fc6127f3a4befd5abc325dbbcccbbaddb257e0773cc2d58bc4568b7ca93a72a850c9f3875b21204e113547ce264f149219891d7f89e724416ad8b14c4572403502d953ffd218ba68632187adc252135353e392929ddd7253ebebbcfef762b39e9a10c97d2bd41e9563f5f71f972a40cf99890217c528e416ea2f3ed4b6e7eb41d831c65eb7aa04d3bc84fcf0221453df3f312e2e334d6b3205177085162526e026da410312685293fafa772ace2c565efae9ef7f863d3fa3f7fd7e6c38d9f3147e7e4835dc7cca8be6a4163c66583260d1e32251060c31bf7de3273e375a377ed9a366dcbf2dbd7bf3176c9c6feab9f6c58f9b7df35d6962f6d7f64f9da8b6f2a51d60c9a5d3c6cd22503db0ceb78a607bb7dfc6d432a8ecc107f337879e3683e1932e4a311527edceda218f9621c4e9faf81e5efa67b229da0a168c73d919790e253fc8aa23c1a7dd706c9fe33a74ffa4e4341403708cea6eea62887604a31c6cd7278b45833f9ba039f781f63efdcf6dcf00987565ed5ee82005672e3e843ec5b16f9c5eb677e78a1a266f3c13f346636facfedd1e5b2479ef6bcbd8fbbdc60778c4bf4c97d8fc240ebe91ee592c806e3ab7a9f8f9722f06d7d54940c9ca8f77a65e0f35094dbcd4ba322332379e4a33156af8512f949cf5994cbee796c80a2bbb7c3a26f978fd51eefe36784ba697341bb652b0f4d18fe7ce368769cbd7b68ffe69a092ffe70e6f52f1abf6e748a7e879469fc15f43b899e95fd1e1ac122dca92cd5adba5d9ec8285fb4438f603c49fcdf3007a98a3331c6eb70e89af84f62f21f89793d1171aa437132b7ae4510f9fc712ceeb00e2bfca0dec06e0b79b50729141ddb9d9293176d300de9f053674e08b35e5954985b04758c5f166d5241ba752588745a8cd3eb8dd214e83e0d36c3478cb9a37c9a2f22e4d6c488a1eff27cc7f2a2f3738f01f9672559086f2c1420d8a03b9ac4b59dee6807490e75b9e7c25876b312376b4d9715cb2e587865ef91437b5dbe346fa5ba6b63af0e7b064ebbad7ba78d1d237bac2f1db9fec6a1a537754906877636becd56d13172d374c1a13d6eb8338f6070a342394c29e29cb95911b9b98208e9bd1cbd47d2245a482b681b7c916d11f78a257faaf2d409df49d8022a1657df49df9993c271e8d635758f4367e27fe324613de61e43e7f3a1aee344777b16ec3d366a7c5e2116d5b1c537e40c4f9e72317ad38f35f0b97c01f4e80572be9217f1450a1fce86a32301e229da22644a5617dd28987da2d2f721e50e3f099e2e86b8d45108bc03eb048f7a64c5f7e31d58c39e3d287000a2b00e6354a840d69ac4c5908acc813c4eea36e4d9a6de6baaaf4a4820aa84f4d91db7ba7de0d8b163f22f7a1b1ff142c89462726c3f29c6db7571851c3e4ac81f57f87b8571e51ee571852b97138b4309b88af007958f897f8c35b2630f91ba7b5992b09ea74efa4c795fa77509565e63ea42f859bbe12dda921fcff219dbb1a9b13c59fbfcfb38b85da5c6476ab476046b319d358a1ed472f31f0ca564a85a5c86d79b0867ef63b9ee4420942c169e2b9a3c2285123c1e5c3d228d72b1e88ee1720c239663aed57f5ad329d4a48b9a3ec40a96812f42c91111baa8d22752c8e7f188ab486baaf26c9da111aabe8eaf8f581ff56ca4e6724424f141b117c50f4d1e903a2e7662fcc4e431a9f31cf322a6c5ce8f9f973c39f52a7e857e79c4b2a875fa16c766dfb349aff357f55723de884a69ea523f9f718a3ce4c1f49451a2f1353ce2082bfcadf85f822c148a2e4bac7285b202ddbb427fb87cf07efbb951c8cee8323e3633ee2b736dca8cf6783c0d2c545f161d19116106b03811d85d165d45c2f5f3a0263f897f83626725a79595ccac7bcb68538670e27ca731747868b88a60e56219b458c12a175365980f08874695d7ebfe645f1a14651df747fc8f719c128018200ae8257e18505151915aeb8d8365ab9feff5aa29d2c4a99a69e28498fb6284ed4a88814294162dd627ec54b40fb6cba197ce7b69dbe5754bfbcf7de9de97afba79ff8ee5cb77ecb876f9d04afe1253d9058f4edadd68bcded8d8f8e4ae2dfbd85d8dbffff22b369bcdfd62ce5ac8f83bd874fc001973b3482161bbdd4d23b7036e9b5b6407dc262f9a9812ca2a53c42e639eba82dfc46f77aa8faacc45bac61597c63c9c1d754beebac53c1113ff00069ebdb41b087c1a8a96e29a26c535528a2bb8154a16c2684b9c94be148f16c2be461375458aba34e6d7421ad792230eb022b6864c55b1d89c11f98388b9fb2a16ca59ec6de06e988eacdce470e6d2439ae6621e97e075b17440a1d0c0f1ac40b4ae3b7a407de5f31feafbbd34eef7efe52e55afeebb3cf3b1c14727610c4558dd0e702e83b7936bd35c51ae689f372936562ff58a05151d2d035f845c3e1f4219715a8658a88922434686b89b9116893b191e31c28c067e107d722726fa337dd19cfb33853ff3b2e850ee31ca1502162c16d7a7f2c412e64d0d7a6262b86c30e48a8ae6763bc7431131b1bc34234ea489baeb50b550181111bc3451d867c9ed9f6b4dac6ad19e684d36161adc47eba31fd40eeb071dcf389f4d730cf15478c645cef34c8f5c16b32cf6fa9843311fa47c90fa558ae770c4be589ee1f63975fd685a4a5c5a5a8a332d059ad29992a678337cd8a2ed1e19cda21b58d21ed14f121ddbcdb8c77dce7277375beeeea6e5ee2d735725be04452b963c3bc857929f7cd86279a2f714f3497c215fc1557e80b7a54c7653ad5ca49550bca78342ffcad589bd6ef1496bfbc4ec3d9470554d2b662dd9902bd597e64bf765f8f4ff31be220716aa13d405d8ebb5570561ffb304ab564cad37d5e1f0f28c0625bf7e3ef7c4799b6d728a83c21d054b85331a9f95530081b27d4e611ca5430a41c3afeaf8b1802766dfbff5cbedb75f7ddd9d6c7fecb77f7be9f4850f3f71dfc48c5dbbfa154d3b72ed531fcc9c77eb9d35b1cfbff6e9aef29d871e583fa51b24b1ccf8504d802406d9e966562222392924e637298d985832410f22ac43c0ed8df24465b8dd1de233d2d48c0e695a076fc0eb494a8683e7f78945e877e4082911d97372858e8741c787620a8b8b61f24f6230279ff63d1d53e87b2a982720e4a3abe64df00ef2aef5aa83a2c7475f9eaa8c4998ef9b1b373de132ef55716bbd3571d7a73ee8754778bc91aa83a13d260441fc53be834cfc19732f36e31e4fbc9a24f6edc97c76c885de69e89e37e61cb98869261731cdcc404cd524ff423ff7278975e4af769c53c8d1ac90a3592147558eb41d398c727c391ca33eb54f94cfd9d439a981f5aa4b7e8989b30102f3229a2cc3a64e0dec164bb8c4061de26529ff53c1ca261b70e684584627cdadba296a4de255a7f915ac4e88518550476cb1102238866ac0e38d72cbad7254545a07d5da4e632f94162f252a4d4a94dc2c47638de6e71582588ea2b00652aa1c054d415bc0848439c495026d72caea336f9bb7e2f1fbaec9bf282e26a2aa61eddc391be2eab33e7deccaa3f3664ebf6e53e3c7affed160ab926e5f17be6ef9bd7177f32baf9976ddead5fe3dcfccaa9b3ee9ce2e197fd878a4f19b0fc559550a34a04f3b008fd2cbd384e41d228ff1bdc9f6fa32af6e1910cdb624ba1d7035d9163ba0d9b645b703ae266b63071c4e2bb3d30e386cebec7436e5b14c93d30e687640b7032e3b60d9b15041594cb967b667ab6787e7598f76917291f777aa120395451e5d7168ee08c5016be8f51e55d4384551152f718f179b8583fc201c47ceb685dca4aac84247dd6a039fb94fd3dca1f4ccee6edbccb94d9f4a06be90ce95bb811584bc8e509b40774775560fc7a6282ed6688437ae3b711ff773858bc2a20c0227f68a327c4f6403db2045ef73e17b082b774ad88422df873e69e47ca78a4e17451716cac3bc755d822a349b3c1c62f25f4f78e1bec614c24ebc1c8ac82f54da742e54d4f4f422f98f1b2088c8138af384220a3dd5a30a3da19c424f9b34d0ce85e6bf76603ff39f4d2898bad7a3ba74c5cb1b94bc7dc275218f6a9bd2607e7e9e694ba3b37ab0fce8fcf840b412cdf8e633abf95db73efd747d630f36e94165ef8f431f6cbc179afbb633f3a01084d79ba53d04bbea901e49ac2d23317620d663cd768c1d88f558531a83c07eb1d04d25b89f18b8ea156c646991ee8cf8f8b418616423a2543523cd1bc9c891041744bad0322015a6307f42e189858c619c790a4a4ee8b8ee31d24c47c9ebb094abd26bd237c73e1cfba4e755cf1ba94e576c5264c71425d61d1f131b7b34322a2e32362e32ca0b3d178a154d8722b7611f1c19158a675637f645a9ec25a103610c43d1a243d1937ce2f0f0269feafbcd3a2c49eab024ec227c493cc9d661499bfc3187580f8a62b72167afbac83d3fa7cb32cfd565e768b34ab1cb83fe923ca884a6a984f23fb1ced925a841aca8b9c1ac7775d5ba461c809d54a45e139a6d71a5f87720b6a34594e68d8d84bfa1c69b1a2e3e3e2a4d95ee6e9a372a0696b36e7e946a1bcc5c817cf338a7857a834e8bcd8acf52a0d7283ece015f38a7f40ff1b7cfbfae7ed786f11bdaefd8c85f3bb36fe4ea9b8f30e7d21b4ffdf90cabf6d5dcf0d47d5beb461627f07f3eda78f9c4c6d37f7be6e6bae318fe70485a3cec663a75649f34b39c99512c934d620a4b6d9f11f232af17ee54aad62623ceebce6094ed138e96dc6bf932127d427412a5dd4c947bad446b6374ece563be3fd9225479d2f754a510a1cef392d94047287e60f240ff849871fe79ca74c774e7dc98e9fea5cecbd2d638d7a6bdea7c3921dae11773d8ce54017a69403873a92294256f886e8df272742c95bd247cd1066131ed4e3261bb684ff639f293dd4c7eb29bc94f76954fca8f8f910faa0a63fb6a9ff0b97d9b3a4147f5da9d612fba0c5b0d67406b1e94f564b0c290b7387152e2c2c415896aa2cfca006e48b51a59969820aa4a4c107d4e6ce06d77079bb64ea6ad6c2e6f274dc3290d2618d6245cfb850356dfce1ff06735d8d2252a10b6b322750f639adbdb5eca94d79b1ad746ca549c3755932633553b2b5379a63431474e3bb96bd21dc23ac608f72bd086a27d05c256b2b866b2a6fcb03ba9d3907965fd4aa7f27e8766d59fb9e285d5ef369eb8ebfa8f77bd75a660e4c6114b1eb8efea653bd5b19173bb0eefdaf78b37a74d6efcf78b3527af65c3d872b6e38fdb9ff8f1adca9d150d776f79fc71ccd214f17f08b487c1fb1be4e944e4535ea6e2973b55178c8a504c5d39535d1e6f95a270312d23a557abf094286795eb331a09a99cc4956290856c05f676c991d60216cf1416170d3f757284efb4d8f388d306e1edc243305d5bacc7d47a974781ac88b5c6e45acb2fb64e5074527447a0674c4cc11465cf86c693c37a46ed57aefbd7f5eaf7bb36dcd618d3f843c31bbbd8a7ec993b49a1b15835c958358914a0aefce9b3eba6de43a9195d8419c3fe869776e9129395a16bed3362bc19c2e0cb438a537be51945304a9c1c8aa513656f484440de8c4a52ec6345c5cea5342d39a56dbc47648f9735c6cb25177ff62ce2dc830e61834e8a475ad679c73ed911ddee886e76e4843cf788b2cdacd5be4843e0c7501b91289a1525e3a5ee8f97233d3b3ebb31b4c572ad0ed810ab7e788f04d6216148c2909c0f3d9f74d55c5dd935740d5bae2e752e8e58e2b9ccbb2cf106aa611bd4b5ce9511ab3d6bbd3726fe35fae9d8180f652491072d6debc29a31f39c759dd16c5d67d8eb7a6f5946d5611773f58be1b328d82c77b059ee60332d10ac8a0af9a105a21845f9a2785403bbb93e2fc95efa49f6d24fb20f4192aac20a531af8acdd6ded4c6ded4c6ded4395b655f1f656dd1f1f8ae7f19bba3d63db1a6960e4e1c9a9267bd3e43cc714564a569a8f239bd4401be3785d9a3f054aa0ceefcf15a4b31f3efbf1da0e7ea9154cbb53b964312dc6be6c3738d745aa85d4543da6bd540b315e3d4baa05bd995a282c94e7e54d4f079a5c65424a6c5c336dd05c35b0b98be67f78f8c8a7f316acbbb1f1f46baf359ebe79eada79b3d75c3f73d6fade43368d5db97dd7752b1e56523b6c99bbedf577b6cdfc7d874e4fad3f64c0cd3f72d31fd9b8d9ab574d9ab66ef58fc6f04d231faabe6ee776b2cefbc4cacaa08e7cc2d933857d1199b0eed9d1b0eda7a5580a232fed42923828692fe432295a0a66b43c2f894e8aee148c689f214ede47462a919171348a31b909f4faa2f552265c8d3662f32db8fd54b0324f6adc3cc970c8ac58443e61bfdefa53d33943b34e9c7597421da5bf142dd7e22fb47a6e5b2d9aca6dde506870ef948b1242818b13c607662af31316a4cc0a2c4bb9266343ca0d195b1376a41c4af934e143ff697fec05097727ec4a507a7798aef3f61923232709bf2a4d34c25e1a655ac37ad16c66bf76cd643fb399ec67dab22fc2ac90229ae58b304e37e58b68962f82f50a459feb6c6dea246ced1ed85a7b1564dbab20db5e05d955d14dab203a14cda33705cf59053081d60ab0e4bfc9e53a6b020f523bf85601e3f8ee2cbfeeb7cf1f16b3ca0a6900d58848d30082e74d4e95b484cd4f219a0ca0e94ef5e53dbab713960f9420f831d1f2643187d98fc320ea8b76252c9f32f69a513d59cf830bf6fec81c4fdf74f2ea65ffbcefd1d7f95f1e5c7a65dd8ee5d7dccbc6fa965d7ad18a7f2cf22495cd63ce7fbcc37c5b1bdf6ffcbaf1a3c6dd8f1d56badfb1f7a93b37c0fc41bef713b1b56a8e7c8fc27cdee5c75e4177b8b85ea42a454c57ddbc086e3771714678afd37ae6b058d8b2933ef9a4a150aa84d43d9aeab41f02149b8f01f2e3c53b09fb8f1d3ba6541c3bf6e3c3c78ea18e99c647dae5da4b94ce72e5338f697c6e3a67a6c9d1c539e3c7a14922e4a73cef345a444bd3ab6975fa26daaa3da23ce8ddafd47b9ff1be4027d2ff951e1d19931e9d9eae74d4db47774cf3670ef696c58d8f2f4b9eadcd4bbf3ae68698adcaed915bd3b6b307f8f6e8572263298e527c71be14553c2ca86b5f28179fbf7da12f8a989a1a9be151523354972f276a28e5f8b14a523213b9254289b60825ba4d3fca5d9698e377326c7a65d45be6f4883e3b9333a64d341f45052b870be181ed172f16988e5474a2f92a47a5388b86b7b42435e4667040a27c3e8f9a8add5afd7c781ab108d4cdf728a690984f4fe591024bd4d5409bb6108e98b6f979aa78ea0eb1e0f171314230d4fa272e687cf283938d7fbfe37136e0893759a73e87f39fb875c7fb13177cb8f6fef738eff6e50f7f6497bef8012bad3dfe97cedb6eb9aff1cb9b0f367e527348c8c1dd44da04ed0045615e4c3988f167b201ceb4f40cce78b42f238a9ce2f4bff1174eff4f235dd8ad4cc11817cb94c75c2ebff0185c6ef9342449a608a7c1b4f72999e93e9bad3eb7b557f4998b167eaacf2f4fa5fdd691f469a9e064c03a8efebe5e9e4e3718ffae9707d2e2551cb73c94aecce83331a9e9c0b9b2e88cdc8f9bd1cab3878ef2c59f0157857a2aa90ea7eed49caa53d593935292b81ee1f6b8bd6e458f4f884b884d50f45425318bc544e292e44ccb6209eee82c0a8a33eb8ef859c92a536bc9274f1ac9c9d24d678e373d27c88fceca4b4c484c8057cb2379203b2bcf3a6e84cb9b7537fbee9109d7562cad1ab1ece6636b1a6b59e1cd0f761b34fcf7f347ec6afcab76203efda2a98dcf3ff57063e38e2979bb7a761bf4c9431ffebb6386781206f3a4aec18cb9e825395f6d742dc3e9bcc9c11c0e5254316be474dce9e7fe08ce532254972dcb4d87382eb7bd27709d97d7a108f3c995b5441b6d967f65b3dcddc7967b8be9c325d7a5f89f30fd5ea13fc51b35c27e694e7069df7c4d63e098da9c63c23f3499169f25b15d79ebc70f78f8cc28edc0aec6debbcecc444f174087ec870ec9660fcbb1a7a4c6a5c6f3c9edd825ce5816a3b46d4b5931893c9b32b85ce4f1a2b78ce98919910a5c36176339edb2db9e23cd6d9b4973db2669f696b5f52b0a78d86eb23cfd39213983c0d7f631d0eb520ab910eb48d10a5f52dd8eb54bb7999d6e333bbd4971a4e7f8ddccdda438dcd23d7027e74cbbf81cc5f1ff54f625805155e7fef79cbbefcbec4b92c96466b24c20210984c1682eca22229bc84890285651595402881b6a7c55c1a595da57976e60f559b5ed63498014ace6519ecfba3c78adc56aabd216156d69793eca532093ff39e7de3bb951fbfff71f987bbf3b733333b9e7fb7edffedd5946f749f74a1ae4526217ac6c41a3cb8953d2248c59c0be04e2e3294c4d22194fc69234a7e48c6c28579513b24cae261b552baaa9b01ea846270703291e1da5d96c3548ca88a18326da548ad5d55486461b722b53c4d8a4bac8fbc12c4e752776d3762653ad117765e74a00346cb9b5ec5ec9895620a045086c69f4a878a8533e84b16b7cd61c855ee1083f1622f8c2a510418b4100d66ed217c2eb1e2a1ddcf29bd2e6fe3e30f7b79b017838b7b5fa2bbb6eb867df4dd5133700f88d3b8e9f033b7f0c860eaf5ef35370d96f0e8135fdd70cfc73f3aade59f3ee9eb371f3fed2a7bd57b40313f1c85308d1d2483e6430cdc914ab8813c281501b43578ad216e9a0042516425940923f8a15041f2b081e2bec2c0a299ee770ac10b300223eb165cc031c893370381a10c2d2c101bc9e5c77af0a54287b7c207b7c203b7cb0bb28a7dcacdba02da12ff50f089fe00a9f0fefc28ef0292915a4d4b9ea127595ca9cd51545fe7b39dd56c63f879df21d0e3791c437b2e90908827c623b2da155b5d595344d0141a004161281443f6659249150a2470dda3eb50f9edab76f8863f70c3d0d179d9a06fb8666a1bfe61174cd2fc2d71c5e4ce4b2924eb717047152ad349e9b204d972ea1efa5dfa4f975d25bf45b085eb1d410b550c73ec8dccf3ec77c2cb01203c63387185c3379d816adea363a85374865f729050b3fdb878e0577cfe07d05d90ff65961fcfcbbf67931f499d9ecd982188b9dcd3444a3e72e406c264aa220b134c3a45829c8b2e808ad2817448b2a49140b19007919fddd120d654031037092ad37b3600bbb8d1d640fb30c7b81809f939b7990e27bf96d3ccd0fc07bfbfeee0a23d19653ffa0063be5ade8271e9c2a673d83edacfc88ce1a423617b6bbb06076e0e5ebe8c00fb436b87c01e7cbd03e4ac2cbbc6074081d60e6b6e8fc99db12f3163916eb222402ccf06f2676391e0c3e38dea798f8d21eb72388e00ccd6c130ccd6813312519aad14679f71026760bf9c12169534ca36bdc182b30f8914e145874dd778511192e70780964ab20a48305c60e16f092eccc223254f045a9bbf03b839ed5dd790a472513e82d398ea1d15210ee6346715fab5b398639105403f49f371fd9077f03f8a1c7e13f0d5343278f2346ac876f0efdeb99c7e0071f971874dd1fa3284e47bc68d07349cc5a68901d1b032262543c1a09b9236282a69a04ccffd28f09166789eb30a558f86556576891025010658d124428c91c5e5bd9c0eb29a365dc85cf920d0aa716dc55ffd45bf533fda3aa3e7034a47370d03878701027a2f2ee05a6bc2a902a3e45d0846c69b265c896255b01f34a0da620d1c908f2b1f2212ac889a74864cbe36f80594ac070514532692c505292d5a6930d8bec4ca0c9942000483221f8dd0841de642f2c521665c0a2adbaca9ff3c087bc2d85632bf9134d2788518518d2f963ba47d8c5bd3976c2be9382ba1084098159a7dcabbc8c2ea5324399a1d3f54c566dd416d29732ebd49bb50daa20435628a813b43970263d85b78559eab99af4187c9c7e847f447886fe21cf5950d7b466162231860272b29b5901918272917e11b0018482204a3242674d33f03a2db17a2d68ed81cf20201fb7834d090360dc4e4594242f9b253946a7589452b672a70ce43de8cfd6808cce850368a7036ab2e4734129a215140ce3544a5f650063001677a7d8256c2f4bb303f0993e13a3700c17677577448730ea1e8bc70c24c01d71dfe1916ecce31da36a8ce3c6b16358a237dcbe7f039267b41bd74ccddc262351ae9cb768e1cf2865f834e2d843141c3e44822b33b729e8b53abf98abc39f6ed724fca29b637a635775416bac2679a65ded05ada59d903bc7a067dd5c52be6b754f379245ecc05278bd548c86ac262802d48930b6927f9d8e7106c29109eda01a29035003ccc740065cda1c8e8d079703766fa9b8b5b490dd73fa936f9c3ff73bf49953d398574f8f670e9fc668f85da421aab0d50a21914a3aaa282fb8aaf6a8735177142dd9538b4254099350e3d17e973861d798e6b90b04856c21b2ce780181b800799a164406429117181a29f4d365854efb143aed3dbfb348a7380e89f89f8984b26585ce3ab28ef4ac1d2702d79d92414a9e2b2f9157c9bd322b0b7e0bdab5a9538e2657d157fec72c69e68bcabc6c4977457dd532f90ec22fdd3d273eafbd2d1c8e2b14363084593c54a7870fef46602ea4d08622e99e71cdd8a2439cd02fd8d30ae8120eee9a5610ec16876c29f008cbb14bbc2b86c81687c4cfd6385575724d81d782e811c0c72776051059e19015880c61f2d3ed6570073ea9771849a1050af09f07f58283e7001b14c0fcee7fd070cf7f9c2921aeb98bb913714cefe95ee4955e89ecfc77d837288d4a00c7a29819d741d0080613914482610c262847e404f36c6497f692464722d1044c55d8e69cc09c881d5fc82e142f311698970716452e8f16e397241e883c0e8d58254d5b95b2181a65f5857c4c12f2acbe5dc5500e9757bfe02b60e3112fe2e5e59dbc31218e134dcee3381c5e57de0b06f278c10928f3f1de0a50a17bd682eeb1905ef60bf41ce69c726d9beb20048a14e7c3dd58f2ca113fcb8b3074979965d6e70bdebabb7b12db658b841664918e111b9da67d356c54750b833d53629bb71b546b0b65b6c15c4d9aba126c04135e05d37ed45fdaf5e281d29e675e06156ffe16246ef9e81bff597a13be02ae03dfdb57fa97dfbd57dab2f365b0e885d2ff960e803690e803f2374bef3b31056608c9ba4a45c158c71e5c6aae08c299c6cce0a5c6a54146562a11905391a8e3ad5aa316e44bcb4afa8a564ed88b96c789926b4541c24b2018ae523c615bf83a09f1541ca0fff1a8ea5d71d5bbe26ad9ed55ff7fddde535f707b63fe4883676acf367a9c257197c3757e1d531b3b52db3585b8bf9a86dddfe897bbbf2da49d0256579b882e870b60fdc3b3563edcf597d22f4a1bc16dcf7fbffbc2717797ee63f768d6d25dd7ed2d0d0dfd98060fdeb9f8ab211547759e4068fb13b402512a0def242b506dc91ab0262417555d2d5c57c588a48c4f205b9e6c33081408379362394c281e217b843530fc873e2bde86f6c7fbd2b56d263eaea86d33dcbdeeeed1ebbfe9abc839afa3f30d778f5fb7672022ab5d90bc20355f5e9cbc2eb95abc59bb45bf47daa83faa3eab0fe847b50f7503c94ecad483a6a99bba225a09581d0f4b9c85ebebd8a8288623f15865e485e1415f246ad0f1c32211aa3a4df82a1ad5754da81cc55ca35334651faf32a77d97f3ea77398f13887317236e1e872f11d79dcaaccaf466e84c3a0abf908f29b357f41f652feeefea821aec067c31aae24a7cec48d48d6661c3c1e532e429a0834213a9a6738ae9d8726db3ef070334292f91045b2fe8c624d39a84211bf4109b4143c81f8f154ca41b2cf4d0ec64c14006bd91ae428f32d87725768831ecf8dbf2, 1, '1', 3, '2019-12-15 16:33:50');
INSERT INTO `documentosavaluo` (`id`, `descripcion`, `imagen`, `avaluo`, `path_drive`, `id_tipodocumento`, `created_at`) VALUES
(16, 'plano', 0x255044462d312e370a25c2b3c7d80d0a312030206f626a0d3c3c2f4e616d6573203c3c2f44657374732034203020523e3e202f4f75746c696e6573203520302052202f5061676573203220302052202f54797065202f436174616c6f673e3e0d656e646f626a0d332030206f626a0d3c3c2f417574686f722028504329202f436f6d6d656e7473202829202f436f6d70616e79202829202f4372656174696f6e446174652028443a32303139303930353131353134352b30332735312729202f43726561746f722028feff00570050005300208868683c29202f4b6579776f726473202829202f4d6f64446174652028443a32303139303930353131353134352b30332735312729202f50726f6475636572202829202f536f757263654d6f6469666965642028443a32303139303930353131353134352b30332735312729202f5375626a656374202829202f5469746c65202829202f54726170706564202f46616c73653e3e0d656e646f626a0d382030206f626a0d3c3c2f4149532066616c7365202f424d202f4e6f726d616c202f43412031202f54797065202f457874475374617465202f636120313e3e0d656e646f626a0d32342030206f626a0d3c3c2f42697473506572436f6d706f6e656e742038202f436f6c6f725370616365202f446576696365524742202f46696c746572202f4443544465636f6465202f48656967687420323638202f4c656e677468203132383234202f53756274797065202f496d616765202f54797065202f584f626a656374202f5769647468203330353e3e0d0a73747265616d0d0affd8ffe000104a46494600010100000100010000ffdb004300080606070605080707070909080a0c140d0c0b0b0c1912130f141d1a1f1e1d1a1c1c20242e2720222c231c1c2837292c30313434341f27393d38323c2e333432ffdb0043010909090c0b0c180d0d1832211c213232323232323232323232323232323232323232323232323232323232323232323232323232323232323232323232323232ffc0001108010c013103012200021101031101ffc4001f0000010501010101010100000000000000000102030405060708090a0bffc400b5100002010303020403050504040000017d01020300041105122131410613516107227114328191a1082342b1c11552d1f02433627282090a161718191a25262728292a3435363738393a434445464748494a535455565758595a636465666768696a737475767778797a838485868788898a92939495969798999aa2a3a4a5a6a7a8a9aab2b3b4b5b6b7b8b9bac2c3c4c5c6c7c8c9cad2d3d4d5d6d7d8d9dae1e2e3e4e5e6e7e8e9eaf1f2f3f4f5f6f7f8f9faffc4001f0100030101010101010101010000000000000102030405060708090a0bffc400b51100020102040403040705040400010277000102031104052131061241510761711322328108144291a1b1c109233352f0156272d10a162434e125f11718191a262728292a35363738393a434445464748494a535455565758595a636465666768696a737475767778797a82838485868788898a92939495969798999aa2a3a4a5a6a7a8a9aab2b3b4b5b6b7b8b9bac2c3c4c5c6c7c8c9cad2d3d4d5d6d7d8d9dae2e3e4e5e6e7e8e9eaf2f3f4f5f6f7f8f9faffda000c03010002110311003f00f7fa28a2800a28a2800a28a2800ac6d4fc59a0e8ebbafb54b68fe62bb55b7b6475185c9ad77fb8d8f4af95b5cb5d47c61e208ad34886d4cb0c2a1d2d4b12e1783bc01907d7ebd69a133e8fb4f18f872fa3df06b5658f479421fc9b06af0d6b4a6191a9d99fa4ebfe35f3547e12f15464a37832e1f03aa49281fa9ac7d45a7d23505b0d4b409ed2ed94308e49dd491ea38e4706819f54bebfa480426a5672480711a4e858fe19aa16fe2a56d516c6f2c26b4327faa9188647fa11c57ceba3e95ab6a715c5e695a05e4b1c3c4b24376463be3eee4fd2a4b19b56d5e68f4db4b2d4ee242d91126a3c023be0af1f5a00fa660d6b4aba98436fa95a4b29e88932927f006af57cb3aae91aae812c5fda1a16a76af265a3637e9ce3ae085ebc8abfa5e9de29d5ed8dce9da76bb34218a164d4d38603dc7b8a56607d2f457ce9ff0008f78ed7a695e241eb8d4529a746f1f2fddd3bc5007b5ea9a00fa368af9b8e99f1097a58f8a73ff5f40d33ec5f1155b9b3f1563da6cd3b01f4a515f37087e20a8e6dbc583f5feb467e202f583c5a3fed993fd68b08fa46aadf6a365a64026beba8ade32701a460327d057cec66f8800f3178ac0ef981aade87aed9ea0b7d67e2192fb51ba11b7d91e462cb1b0073d0fb0a1ab2b8d6a7bd58eb5a66a471657f6f3b7f752404fe5d6af57cbd6d2aaccfbcba6d526375383bbb0a98dfdeb2f1732b1ff6a4357c84f31f4bcf3c76f1992560abfcfd8567d9ea93dcc4f2c96a20419da8eff311efe95f3cc9712c880e583e390ce48cd0267645dd90c3ae1b20d350427267d2c93c4e81848b823d690dd5bafde9e21f5715f34c721fde79abc7f011d73ef4bba97b31f31f4c47224abba37575f553914eaf9e341d7eef41d4a2b9b79582061e6c79e1d7b822be858e459624910e55c0607d41a9946c34ee3a8a28a91851451400514514005145140051451400514514005145140051451400578b693e18f15f80bc5da8dd691a42ea76b71b82b6f0bb909dc39ce411d0d7b4d14d3b01e7dff092fc427195f0740bfef5c8ff001af25f88d3f8aafb5eb2d535fd3058af9661b740bf2e3bf393cf35f4dd721e3dbbd22e343bbd1eeafac21be9630d0add3e36f3c37438e869a7a89a389f829ab4314d7fa6cf2ac72dc15921427ef919ce3df18af6148218e4691228d5dfef32a804fd4d7cc3a95aff0060ebb8b0d452e16360f05d40dd476fa115bb7ff1135bbdb474fb54d0caf2239789f68c04da401e84f3f5a53bef15708f6677df18501d06c1c8e56e4807eaa7fc2acfc233ff0014a4e3d2edbff415af1a9f5dd4efecd6dafef66b9c36ecc8e4f3cf6fa1af46f871e2fd1b43d0a7b5d46e8c3235c1751b49e3007f4a15f975561bb2968cf5da2b975f889e166ff98aa0faa37f856fe9fa85a6ab649796532cd6f2676baf438383fa8a4059a28a2800a28a2800ac7f115a5bb787efd8a6dd96f230d8c57f84f5c75fc6b629b24692c6d1c8a191815653d083da803c37e1e787b4ef116b1749a9333ac31865843952fce3391ce071f98ad2f1af86b49d27c4fe17b1d3ed7ca8af6e824ebe6336f5dca31c9e3827a56cbfc258e3bd79ac7599ad9093b14479651e9bb70a49fe15c5b0cf79e20b9758d4b1764fba0724f24d69757dc9b1e42e9796dacdd5bdc249108dd8794eb82b835d2783aca0d4fc5ba7da5d462481dc9743d0e149fe9546eeded350d5c58f867edda91446799a48b6f0bdd47a7d7d6a0d2f529f4ad4adefed88f36070eb9e87d41fa8e2afa127d043c2da08e9a459ff00dfa14f1e1bd1074d2acffefcad3f43d66db5ed261bfb56cab8c32f746eea6b46b1bb343e74f12db4361e25d4adad976c31dc32a2ff007467a57bf68e08d12c01ebf668f3ff007c8af03f169cf8bb56ff00afa907eb5eff0062562d32d5598281120e4e3b0aa96c895b96a8a40ca7a107e8696a0a0a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800af9afc6fa98d5fc63a8dd23ee884be5c67b155f9463f2cfe35ef9e2ad4c68fe18d42f776d648884ff0078f03f535f3495cd0055bb6090e4b8439e1bd2a8beac07950e43b921176a925893c547af4ec248e1456242e4e077358301bcb5d4adaf92da573048af8d879c1cd5a7644b5767aeda7c3bd7a7b688cb35b4400e03125b9e79c55b8be1adf0558e5d4a32abfdd4248fcea2b2f892c204f39248b2323cd8caff00315a10fc44b77e3cc889f6715cd2a958d14604f6bf0e6d2220dc5f5d4847f75140fe75df787e78f40d1e1d3608e492288b10cf8cf2c4f6fad711178e6ddfae0fd0d5f8bc6566d8cb0acdd4abd4ae589dfaebea7ef40df91ff0a9575cb73d548fa9c570f1f89ec1ff00e5a2d594d7acdfa4a3f3a5ed66b741ca8ed9754b66e8c7f4ff001a956f616ee7f2ae31355b6703128fceaca5ec47a4a0d52aefaa1721d60b988ff17e94f13467f8c572a2f107fcb45a78be23eeb0fcea95788b919d3f9b1938f3173f5a8af6dd6f6c2e2d4c9b04d1347b872464633fad73dfda129e8c3f3a3fb4641db3f9557b68872b2e7853c356fe17d1d6c62904efbd99a6f2c2b364e707af4af36f895e10fec9b96d66c2202ca76fdf22ff00cb290f7fa1fd0fd6bbf5d4dffbb51dd5e4579692db5c47be1954aba37420d52ad1bdee2706790785fc6d7be149e53046b3c128f9e076c0cf620f635d21f8cbaa48d84d2ad57eacc6b9dd4edf4ff0f6c816c92f1a567705ce084cfcbfa52e872e93aa999a5b116c91100b99885e7df8aeae54ccf632ee6fa4bfd4e6beb823cd9a532be060649c9ae9f53f10de6a70d95b34c56dada15409bbef38cfcff96063daa4baf0a5a229b8de9e411b861f3f2f7e6b95b5b59ef49fb35b4b37390b1a162076e95cf89c2caae8a5646d4aaaa7d2e763e18bff00ecdd7a0b8b99c9895d8954e4e083818ef5e909e33d21ce374ebf58ebc6a0f0d6bb23031695780f62622bfa9abc9e0af12cbd6c9d7fdf957fc6950c2aa316b982ad6751dda3d7bfe12cd140cbde04ff007948a17c5de1f6ff0098b5a8ff0079f1fcebca93e1debf27de5b74ff007a5ff0aa7ae783b50d034f4bcbb9add91a411ed8d8939209ee07a56ea11ee65767bcc7224d12cb1b8747019594e4107bd3aa9690bb345b15f4b78c7fe3a2aed645051451400514514011cd3c36d119679638a31d5e460a07e26b2eefc53a2593aa4da8c3b997701192fc7fc073e959de3bd06ff5ed1520d3e2b49a5493734374ccaae31d8a91835e437be0ad5f4f04de783afc27fcf4d2ef7ccffc770c7f95007b0bf8f3414fbb3caffeec47fad5693e22e92bf721ba7fa281fd6bc3a516b68dcea9ad69cc3fe59df5892a3f107fa558b692eee1b6d9f88746b93d96663013ff007d851fad1a01ebb2fc4b807faad3646ff7e50bfd0d5393e255d9ff0055a7c2bfef396ff0af3a74f11db732e882e93fbd633aca3ff1d2d555f5f8e06db79637b6cddc49174a7a01e8b27c44d5dbee456c9ff0027fad567f1debcfd2e634ff007625fea2b88875fd2e6200bc4463d9c15fd48c55f8e5865198a7864ff72456fe4680362ff59bfd621f2750b869e2dc1bcb6036e47b74aad1416cbd20887d1055750c392a71f4a9e37a605e8d221d234ffbe45594c01c0154a37ab28d4c44cca18608047bd529f4eb39bfd6da4127fbd183fd2ae839a461401cedd7863459fef69b6ea7d625f2cffe3b8acc93c21a729cc2f790ff00b972e47ea4d75ceb55644a5603946f0e3c7feab54bb5ff00782b7f4a89b48d5e3e61d5e36f692df1fa86fe95d348b5011834b950ce7447e2780f0d6528ff00664653fa8a95752f12c3f7b4f66c7fcf3b853fcf15b9452e5417662ffc257ab5b9fdf69da82fb88b78fcc66a48fe21f9471299e33e9242c3fa56b52100f500fd697b38f61dd9043f11607c017717d0b62b421f1cc6e389636fa30acf96ced25ff5b6d03ffbf183fceb3ee344d01f996d6d53fdd3b3f91153ec623e66752be32c9ea0fe356a0f139bb905bc6b9793e515e753691e1b8f95bb684ffd33b93fe26b7fc0da658bea9717365a84f3f91111b6624a863d3b7d69c6845b0e7657f14196eb54b8b88a68d61853cb01b39c28c1edeb9ab5e1fd0cdcf85db7861249fbe1b064e49e38fa5675ee99a85d37d984407992052e5b1c679eb5d7691aad8db6a6fa579fb6e2241f26c24738c723f9574c526db919cb5562b6a6b369de15f2e46c34a56345ee0118fe42bacf869a68b6d126bd6187b87dabfee2f03f526b8cf15de1bdd46d6ca33b8c6bb8e3bb3702bd7748b05d3348b5b25e7c98c293ea7b9fcf3455765608a2ed1451581415e57f143c63a6472c1e1ffdefdad6e937b15c22e533c9cffb62bd52be77f89fe1ad4ae3e20dc6a2d66ff639a5455762155808d0707393ce474a6af7d04cfa434fc0d36d71d3c94fe42acd456d1f936b0c5fdc455fc854b4861451450014514500145145003248a39576c91a38f46506b98f10f827c357da65dcb2e8765e7ac2ecb2471046dc0120e5704d75550ddaefb29d3fbd1b0fd2803e55bfd3e2b4d4255b669210b1abaec7239201af4ed13c05e20bcd02cb51d33c61709f688839b7b9432203e9c93fcabcff00578c8d4c71f7adc7e9815ef7f0ee4f37c05a4b7a46cbf93b0a4079edf7803c6473e769de1bd507af922173f8a85fe75cdddf84eeacc9fed4f005fa63ac9a65d1603dff008c57d1b45303e582da0c52325beafae69922920a4f0eeda47625483fa55bb67bc93e5b1f17e9d3fa2dd831b1fc5d7fad47e2a40be2dd6548ff0097d9bff4335c9eb20431c6d1aaa92d8381d6803bfdfe2eb61b85859dea0ead6d2ac991ff00006a77fc25d3da61750d02f6dcf76073fa103f9d79525f4f11ca3907d4122bb0d22e75d92d925b5d6ae23c807634848a1cac3b5ceb62f1de8c7ef9b888fa3c5fe06b42dfc55a25ce366a11293da4ca7f3ae32e2f3c40f9fb4dbe9f7a3b9781371fc700d538eead52eedcea3e1b4589664691a0675ca03c8ea47228530e53d30df59b26e175015f5f30566dcebba5424abdec448ea14eefe55e757934b77753cedb8ab499c1ede9fa557d8dfdd3f95592773378a74b19daf23fd10ff5aa32f8aad7f82095beb815c9b657aa9fcaad697632eab3b451feef6e325fdf3fe14681a9b0fe2a73c476a3fe04f9aaafe27bd3f75215ff008093fd6ad47e1a9dadcbb5d80216e36a73dbbd735aacb1d8ea775684b3345215dfc0cfe14ae83534e4f116a4dd260bf4515524d5f5093ef5dcbf8363f956399d9fa5c63ea94dfdfb7dd991bfe05b7f9d174068c9733bfdf9a46fab13501258f726ab092e53f85bf0e68fb648bf787e6b45c09882bd548fc2ba68aee5d0bc10d3c5218ae2f660148383b7ff00d43f5ae6a0b969a548907ccec14007b9ad3f1ccc05e5969ab9f2eda1cb01ea7ffac3f5aa83dd899b3e14d7756d5b558e192fa69218d0b32962471c0ebef5d4db69206bcfa8bc3867c1628de9deb8bf04dcc7a4583dec90976b893cb5e7180bff00ebfd2bd0b51bc5834992e23e0ba145e7b9e3fad690b35664df5b15fc2d6835cf1aa4841312ca653feea741f9e3f3af67af3df85da67976b77a8b0fbc4431fd0727f98fcabd0ab2a8eecb414514540c2b82f88e3ccb9d161fef4adfa9515ded70be381e6788fc3b17f7a703f3751550dc4f63d2e8a28a91851451400514514005145437575058dacb75752ac5044a59dd8f0a3d68026a4719461ea2b9693e2068925bcafa6bcba8c91758e0420fe05b00fe1935cdb7c6bd1d217f374ad444ab9051421c7d492280387d76c36ead08c7fcb2913fef9723fa57ad7c35e3c09a7aff00777ffe844ff5af36d46eedb5396c2fad583c3399ca91eeee715e91f0d9b3e0cb61fdd665a480eb68a28a607ccfe324dbe33d647fd3dc87ff001e35c6eba316b19ff6ff00a5777e384dbe36d5c7fd3c31fcf9ae275f4ff4053e920fe468039be48ce38abf63abdd58616260547f09acf39a558f72bb7f740a2c07550f8a9b8f36061feeb035a30f892ce5c069361ff6c62b878e292e2454452cc7801475ab93e9f3da401e528149c6dde0907dc75152e087cccee12f6d2e07caf1b7d0d0d142fd315e7e36e47ca41f50715efbf07bc37a4ebde06925d52cd2e265bb7412313b800178c834b92c1cc79e9b28dba115a3a35a8b7b82c3bb28fd4d7ad5efc27d0a7c9b59eeed5bb0570ebf9119fd6b95d63c0f3785d619cdfadcc72cc88a3cbda473f53424d31dcc68ff00e3c2effdf3fc85715af692b3eb57726ce5a42735dd470b7f67de9f463ffa08acbd4ede7b6bf96496d655899b2b23210a47b1a6dd848e09f41f4245577d1a74fbae7f2aef01b793a814d6b385fa1153cec7ca79fb585d2760699fe9518c157c577eda6464718355a4d217190b4f9c5ca73be1b656d72192687222064c0519e3ff00d75d4df693a3ead7af732dc4f04d263716eddb8e0ff3aad6b622dae37edc6411534b5d34f58dc8968cdcb7d3b4eb7d160b0b6bc85fcb6c9762324e739c5335a91552ded63c151f39fe95cace71d2aff86c79da9c11b92ca678d707d3355cdaec23debc316074bf0e595b30c3f97bdffde6e4ff003c56be69838181466b9dbb963f3466999a5cd003f35c3f8a7f79e3bf0ca7a4e8dff9107f8576b9ae275df9fe2578793d36b7fe3c7fc2aa1b899e974514548c28a28a0028a28a002b37c41672ea3e1ed42d2050d34b6eeb1827196c71fae2b4a8a00f15d66e2ff402f1ea5a1225bc9732c914ad8dcfbb07ef29383dbf0af3bd66ef4dd4b529a6d40dcdbb39c2346aae853dc64127d4e6bea8bab4b7bdb7682ea08e785baa48a181fc0d79dfc4cf0469727826f27d2b44b717d6e032341161c2e46ec63af19a4b4d00f2fd3a51696d6d0d85dda6a10c6ece116731c8bb87236c807e84d7a4781bc67a4e83a30d3b5c69f4c9fcd664fb4c2c11813c618022b82b64f0b496d6765a4959c2c9ba51347890e557ef703386c8e2bb1f07f82edf59d0ef045a8ded93c77522048dc3c4573c6636041fd2803d4b4fd5b4ed563f334fbeb7ba4f58640d8fcaac4f710dac2d35c4d1c312fde79182a8fa935e41a87c2bd4ed499ed21b0bc9179596d5dacae07d3194fcc5606ac9e26b7d3dec354d435482d372b18f57b6f3e1254e4032a027a8f4a606478db5cd32e7c65a94d05dc6f13cdf2b0e41c0033f4e3ad725acde5b4d68f0c72879038fbbc8fcfa54b27862fa7d45ee8dafdbe0392574e995f1ee00c9007b8a6c8b6935b3590bf6b52303cbbd84ae31d832e7f5028039a20ab107822954b00c1790c306b465d12f541648c4f18192f6ee24007afca4e2b33ec3b5be498ab7a1e298892391ede64752430e415c822aedd5db5e0f3249647918827cc393d31d6a186250b8925955bd76075fe869cd0b74478e4ff75b07f238a0062a9760aa315eb1e01f154fe1ad39218c848646f3442cc4973dcfa735e5211ade4477474607237822bd6fe1df85a5f16d9c7704c2b696f26c798fdfe07dd03e87af4a181efb6b3add5a4370a0859635700fa119ae67c790f9ba659fb5dc5fab815d4c71ac51246830a8a140f402b0bc5a9bf4b83daee0ff00d1a9498cf3f8acbfe255ab9c7dc76ffd16a6bd47488c2e916f1919017041ae223880d2bc403fba49ff00c84b5ded90c59c607a524050bbf0b6857c4b5c69368cc7ab088293f88ac5bbf865e1db807ca4b8b56f58a527f46cd763451603cc6e7e1348a4fd8f58e3b2cd17f507fa5635efc38f125aae615b6bb1e914b83f9362bd9e8a5ca87767ceba9e8faae96aa750b09add4b60338e09f407a563cd5ec5f164ff00c486c47fd3d7fec8d5e39377ae8a6ad03393d4ce9eb4bc2633ad5a0f5ba8ff00f4215993d6b783c675db11eb791ffe8428ea07d0d9a5cd459a5cd62592668cd479a33401266b8bd44eff008afa2aff0076207ff43aec335c693e6fc60b15fee43ffb2b1feb551133d3a8a28a91851451400514514005145140051451401e37f10349b683c5526ac8ac2e03c30e01c295383d3d6b0bc19f11b53f0fc9796b77a54120927de6333886519f40dc37e75d5fc493b6fe7f67b77ffd0bfc2acfc3fb2b2d4df5ab5beb582e622d136c99030fba7d6901b963f137c3972e90decd369572c3222bf88c59f70df748f7cd75905c417902cb04b1cd0b8e1d18329fc45719aafc2ed16f222b612dc69bce7cb89bcc849f78df2bf962b90bcf873e24d09fcfd1a4df8eafa65c1b691bdda26cc67fe038a6061fc4cd3ed6d7c7373e44090e52371e50d9c91d78ae52ef52be584bcf38bc45c7eeef2359723d324647e75a7e253ac4ba986d5af41bef2d54c5a845f659768ce39fb8c3af3bb9ac2d445c5a5b017b693db890651dd728ff00eeb0e0fe140103cba2dc3877d326b197fbf6331c0f7daf9ffd0a992e8f05d3196d35a82e58ff00cb2bd53149f99e3ff1eaacbb5c65483f4a0c40f502ab94570b8d1ef2c903dd58dd4319e92c389233f43d3f5aa8620e408e6826f627637e4d5a16d3dd59b16b4b99a027af96e466af59ea48d790ff006ad85a5f41e62990bc7b1f6e79f9971fae69598ee8a569a3eb3241e64369749113804afcac7af7e0d74be17f0c6b57cce34ebc82cb550c4240d23db4b200324ab2f07e86ba6f16f8bad6c7cf8349b60d67f674d9191c07c6430fa67f4ae5b5a8b53d2e3b1bdb8bddd2dc422589e1ca328393d4742286e3f30d4e97fb67e2bf855f75cc17d736e9d567816e531fefa7cdfad6c68bf13aefc625f4dbcd3a082589e294c90c87071320c6d3c8ebeb5c2699f10fc61a54598f5ab99a139005caaca07e2c33fad575f12ebfaa5f6f6bb9a5b86eaf1c2a64c6e07a819c6714582e7b3a9ff41f122ffb24ff00e43ffeb5771612a496aa15d58af0c01ce0fbd7caf7ba96a626b882eef6f4cbbf6c88eecbbb1c7cc0ff005adfd0be1f788f5ad217c41e1fbd48646764f284ef14995f461c1fc714ad603e93a2be7b4d77e2b784016bd86f6e2d93ef7daa0f3e31f574e47e75b1a57c7d2595355d1323bc9672e7ff001d6ff1a00f6ca2b89d37e2cf83751c03aaada487aa5da1888fc4f1fad75f697d697f089acee61b888f4789c303f88a2c070df167fe407623fe9e7ff6535e37377af62f8b5ff206b0ff00af83ff00a09af1c9bbd6f0f8487b99d3d6cf82c67c41a78ffa7b43fa8ac59eb73c1033e22d3c7fd3c834ba81ef79a335c9f8ebc573784f4786f2082399e59847890900704e78fa55ff000b6af3eb7e1bb3d4ae163596752c446085fbc4719fa56259bbba9735106a375004b9ae334f3e67c653fec45ffb4bff00af5d7eeae3fc3ffbdf8c37adfdc84ffe80a2aa3d44cf53a28a2a46145145001451450014515c7c9e2dbe7bbbe8c69a61b3b7b86b6fb4a49e63923ab7978e83eb401d8515e3fabf8bbc556f2cd676fabc067689a7b4923811bce51d4608e0f5eb5c68bef1ff00897c4726849aedca5fa6e1240f30836ed1cf0bc53b01de7c50f96f263eb6f19fc8b7f8d4ff000be5ceb3aaa7f7a346fe42b89bff000eeb3e1ab196d35bba4b9b99a36943acad271951825803eb5d4fc2e97fe2a8bb5fef5a03fa8ff0a903d728a28a607847c660078cadf2010d62879ff7dc579fc52cd6c8df659e5873d551be56faaf435e87f1bc6cf13e9d27f7acf1f93b7f8d798c921fb3c9b7aed38a0074d756739db7763049281932da9f224c7b800aff00e3a29a6d6d9a3df65aa60f786fa3d87f075ca9fc71468b702cf4dbf8ae6d91fed4f1fef5bef2aae4903ea71f955f5468d4ae23fb394f9401fe7de8bbb87433668aeed23592eace4585ba4d1fef233f461c5323961987eee453ed9ab91c6d0316b7964849ebe5b119fa8aad753c4edb2eec61b83da541e5483f15e0fe20d5ea84591abdb5b2aa5e12df2ed5dbc9fc6b6f55bf3e26b4b28ede10bf658fcbc33804af63edf4ae424d3aca52b245752c2e3fe59dd212bf83aff502b461b9bab4894b5bb084365a6b522453f5c74acda57b8f5b16f57f0ceb7a1421b50b09a2b79002930f9a339e8430e2a4f02dc41a6f889e6ba99228de0640ee7033b9481fa57a1f887c5ba2eb5f08d74bd33578a6bf822884b03fc9210b80d80d8ce3dbb0acc8e2f01789b42b6b4b1827b3d6e0b44decaa543b2a8dc4f507904e7826a8471de259e2baf13ea534122c913dc31475390c33d41ad2d1fc2be317b01abe851deac5b8a96b3badaf91ea99e6b66dfe1cdb7da3528e5d42561691875db181bb3bbaf27fbbfad7b2782349b6d1bc2b696d6a6428c3cd2646c9cb75a2e078bdb7c52f1c786a6fb2eaa16e4aff00cb2d46d8c32e3fde18cfd4e6b46f7e2378735ed22e25d5bc150b5e6309202ac8cdeee30c3f0af72bab2b5be88c5776d0cf19fe195030fd6bcc7c7bf0d6c12cd352f0f69b15bcd149baea388950f1f7217a647b7bd2b8cf15b41a76a1a925bddffc4b2c24724bc40b88b8eb862491ed9a596d0697aa88f43d724b904fcb2d9472c6e7fe03ff00d7a4d4acae25d55e1b5b6964738da891924fe02bd1be1b7896c7c06b7b65e25b0bdd3e6b991648e492d9800b8c60e79fd29a7d44734353f144bb34fd7e7d41e254f3a04be8f6b75c6464648eb504d5d67c40d6f4dd77c5905d6977b15d422c554b467383bcf07d0d725356f1f8497b99b3d6ff0081067c49603fe9b13fa1ae7e7ae8bc0033e27b01fedb9ffc70d401d27c697ff8a6ec17d6ebff006535d478046df02e903fe98e7f535c9fc6347b8d2b4b8108dcd70c79381c2d75de0b1b3c19a4a820e2dd7383deb32ce8b3466a3dd46ea40499ae53c1bfbdf8abacbff76071ff008f20ae9f75733e001e67c43f104be88c3f371fe154b66267a8d14515230a28a2800a28a2800af3af167823537966d4343b991e592669a4b72db7938fba7f0ef5e8b450078049e0ef175cfda2eee3423760904891c4730206328c0e7f0391ed58ba4de2d9f89a0f1069d78c6fe172b2c3a9b15dc71b4af9a3e53c7aedafa66bc86e34cf107802692082db4fd4bc3d7fa92e639222f22f9879047b01d79fd69a039ff1578be7d76e986a7a7ff664a91797146cc5b78241c86c007a76ad6f85d27fc560467efd97f23573c7be1ab3d03c993485f221b812192d241e6c04819e11b217f0c63b570fa25dcba55fa5ee97e7e9d7c232ca614373032770c872ca3dc671480fa528af30d27e2acd0c0afaf69c1edfa7dbf4d3e6c5ff00035fbc87ebf9577ba46bfa4ebd6c2e34bbf82e50f508df32fd4751f8d007917c774c6a9a349fde8641f930ff001af2a84e5c0f535eb9f1e97e7d09fda71ffa0578fc2dfbc5fad00696d18c606298cf1c2bc9014536e2e1608cb13cd7357f7b24ec403c7a568dd893a25bdb76fbae0fd066849ade66e080de87ad72d6e72ca80904f079a991e69253b033907207534b982c755b148c1008aef7e1d780f45f14e9fa935d89e1b8864411cd6d29465041cf1d0f4f4af28b7d466894172597b8c7f5af77f81f7092d96ac54fde788807a9e1a87aa0463ebff047510a5b4cbcb5d413fb9749e54a3e8ebc1fc715cfe85e14d57c39af6350d2ef2d0082601dc7991b657a09071f857d25587e2f38f0cdd9ff0066a0a3854902ea3adee20036c8493f592bbbf095cc575e18b2789d5c08c29c1e847515e7a02cba96a91b80caf6aa083df97aeefc0d6f0db7842c160408ac81ce3b923934901d153648d268da39115d1c619586411e869d4530238e0861004712260051b540e07414dbab3b6bd84c3776f14f11ea92a061f91a9a8a00f1cf88be13d13c3ef6b79a558adacb74ceb2ac64ec38c1185e83af6af3b9ebd77e2e9ff44d287fb727f25af219eb78fc243dcce9eba4f87a33e27b2f6f30ff00e38d5cd4f5d37c3cff009196d4fa2c9ffa09a8633b2f883e1ebbd7ad6c9ad8c3e5da33c928909e576f60073d2b43c0b1c50784ad2389cb8190491df3ce3dab7c9c8c1aab6166b602748c8f29e53222018d99ea3f3c9fc6b328bd9a3351e6977500499ae7be1a0dfe2cf124be8c07e6edfe15bbbab0be14fcfaaf88e4fef4cbff00a13d35b311e9f4514521851451400514514005145140051451401c27c4e8b769d64f8e8f22fe69ff00d6ae0fe1f36cf19e907b14953ff1dffeb57a37c475ce836ede972a3f35615e2e9a85de91026a1632797756fe618df00e0e4f63480f75d67c11a26af21b930b595e0ff97ab36f29ff001c70df8835e53e29f0fc3e1bbb6bd9754b194af227b2b95b4bc1ee501daff8004d79e6a5e27f136bb295bcd52fae377fcb31210bf828e3f4a974ef02789f5861f66d1ef1c37f1bc6517fefa6c0fd6aac1736b5cd4759f1759db449aac5abad9ee31aba88ae70d8ce54fdfe83a126b8a9a49ed6629242d148a795704107e95e91a6fc0ff13ca55ae25b4b4ff7a5dc47fdf20ff3ab92f83ef5341d6daeaf61d41345959258af6dd80640a1bf77267703d78e9d0f7a40795ba5dde32911cb20239da9800d357c3d7d20cb2227fbcdfe15bf0bd8dc2a3e997cf665bfe5def7e68f3e8b20e9f881f5a9a6b99ec485d46d5e107812a7cf1b7b861c1ad23caf725dce565f0fdd45c9909c7751551ed66b73904ba8ea31cd77a9247326e8dd5d7d54e6a37b681b978d4fd455382e82b9c6c3bee502448ecdd3006715d9e9c66d3ede1114af1ca8bf7a362a41fa8a558d2218440a3d852134d46c17b9d9e93f13bc41a6058e7952fa25ed38f9b1fef0e7f3cd75377f11b4cf126873d88826b6bd742446df329c0c9c30f6f502bc7cb55dd19b1aac7fee49ff00a0354ca2ac34cf4089bfe26d7bef6e3f9b7f8d7a0f81db7783f4e3ff004c97f90af3789ffe26971ef00fe749a57c4c97c2f159e9d3d825cd98b78db7236d91495e7d8fd38ac52b94cf6aa2b92d17e24f8675a611a5f0b59cff00cb3ba1e5e7e87a1fcebab4759103a30653d083906980eaa9a86a963a4dbf9f7f770db459c069180c9f41eb56ebe71f8dba9473ebb188efda7203279382a200a7047b9273cd2b81da7c4cd6b4cd62db4d6d3afa0ba11bca1c44e095385ea3b57984f58de152c45d923fbbfd6b627ae88fc243dcce9eba8f877ff231c1ed1c87f4ae5a7aeabe1cff00c8c49ed13d431a3d7334b9a6668cd6650fcd19a666973400ecd62fc20f9ffb724fef4ebffb356bb36149f41593f060674ad564fef5c28ffc77ff00af4d6cc47a75145148614514500145145001451450014514500729f1097778601feedcc47ff1ec7f5af23d12dedee359d3ad6e5124864bc08f1b746527907f3afa02f2cadb50b66b6bb812685baa38c8fafd6b91f085b69f69e29f11d9da69cd6e2196228cf1f6d80704f3c9527df39a00ea2cb47d334d4d963a7dadb2fa430aaff215768a28019299042e615569003b558e013db26bc83c6fe19f18cfa06b6e8d1496f772a5ccd6f6e4ef2c00560bea3685ebe95ec545007c97e07f095d6bbe2eb4b73a7dc359c73ab4be6c640080e5b77e031f8d7bceadf0b347b912c9a44b269533f548c6f818ff00b511e08fa62bba0a074007d052d007cf3ab7c2dd5b4cb95924b611a33806fb4e398d013d6488f2077c8e056aeb5a4685e1d8c58dd1864b98a35b8f3dc921c7f74f6e71d315ee0e8b2232380cac3041ee2be7af1bf84f528b54bc86e2299a06c98e61ca941d39f50074a69b40ccbd575ed33523145630c7185c8c940ac7278fc318fd6b299d5582bb84e704b76a6ebb0a5bc1671a47182a83255403902b1f21a22e58f983aa9efef9aa8cdb57138d8d137484e172c7d16920d4a4b6b81344abb80206ef7047f5accb59b75c2e494c72a41c106b6f4c0bfda90923716639279ce41a776d082e35fd4a77767b992276503110db91fceb3fccdd93cfe2735a9e27ff0090cb1f58d3f9563b0298cf719a988d8135aba478b35cd01f3a6ea53c2bde3ddb90ff00c04f158ccd519354c47af687f1cee62c45ae69c938ff009ed6c76b7e2a783f8115ca78c74db1f19eb72eabe1cbe8266b83b9ec2e5c432a31ebb7710ac33cf07bd7125a9a4d4d8773b087c19ab784ed23975585206bdc98e212076017b9c6473bbd6ab4f55f47bcba9edde09ae25921871e5a3b921339ce01e99c0fcaa79cd6abe125ee674f5d67c38ff91833e903ff00315c94e6badf871ff21d7f681bf98acd8d1eadba8dd51efa37d41449ba973516ea766801978fe5d8dc3ff76363fa555f82ebff0014d5fbfadde3f245ff001a8f5ebc82cf41be9a799225103805d80c9da702acfc1800f836790721ef1883ea36253e823d168a28a430a28a2800a28a2800a28a2800a28a280239fcdfb3c9e46cf3b69d9bfeeeeed9f6af3db6d17c66be2b3a8c4c96c27da2ede4955e39141e02a8e781d33ea6bd1a8a0028a28a0028a28a0028a28a0029080c304023d0d2d1401cb6b9f0f3c39afdcadc5dd9b47283cb40e63ddf502bcebe237c34d13c3be19b8d674c6ba8de2641e4b387420903b8c8ebeb5edd54f54d32cf59d327d3afe1135acebb5d0f7eff009e79a00f9ca1f867a8ea7a7dbdde917ba76a2f2c0b31b78a70b2a6467041f4e9d6b127d1b5ad12fe1b5bbb39ece776c466542013ec7a7e55ed9a2fc308fc39e3fb3d5b4a2a9a6436ecaeb2ca5a4672a578e3a722bb0f14c2937867500e8adb612c370ce08e41fad3b8ac7cf56de1a6babb53a85dbc859371da79edc64fd6b135ab586cee2148576868433739c9c91fd2bbab53fe950fbc1fd16b93f12e93a9cab1ea5059cf25947108de645dcaac198e0e3a7045098da39c26985a99e6e473f98a4273d39a62149a4cd373499a00dbd08fcb71ff0001feb5766359fa21c473fd47f5ab73356abe127a94a63cd75df0e8e35a94fa5b9fe62b8e98f35d6fc3c6c6af39ff00a61ffb30acd8d1ea3e6526faade652892a0a2d07a786aaaaf52ab500707f171679740b648338deecd804e46318fd7f4af40f8296c6dfe1cdb925b324f23fcdd4745ffd96b9df166a9651685796cd75109de3dab1eecb13f4aecbe152edf87ba79c63734a7ebfbc6a7d047674514521851451400514514005145140051451400514514005145140051451400514514005145140051451400566f8806ef0f6a03fe9ddff009569550d6c6742bf1ff4c1ff0091a00f0fb43fbfb7ff00ae03f92d7a37c35ff9015c83ff003dcd79c59ffadb5ffaf71fc857a0f802eadecbc39793dd4f1c30a4edb9e460aa3f134805f137c30f0df8803c82dbec376dcf9f6a02e4fbaf43fcfdebc7fc47f0a3c41a2132da20d4ad873bedfefafd53afe59af53d7fe2f786f4bdd1da4926a33fa403083eac7fa66bcc35ff008bbe21d5098ec8c7a741ff004c865cfd58ff00402a80e05f7c4ec92a15753860c3041f7a8da551d39ae8b4df0978abc5f706e6d6c2eaeccadf35cca70a4ffbedc1aeb2f3e02f8920d2c5c4377657374396b64620ff00c0588009fae2988e234290b4539f7157666acbbbb0d57c3578d6b7d693da4c7929326370f51ea3dc5397525946245da7d474ab5256b09a1d29aeb7e1f36352b93ff4c3fa8ae3dd83720e4569e87ae49a24934b142b23c88146e3c0e7352c67afefaa379aee9ba7922e6f23461fc20e5bf21cd7965ff8af52bc2c25bc6553ff002ce2f947e9fd6b15aed8fdd5c7b9a9b01e9779f10e24cad8da33fa3cc703f215cbea1e31d4ef77096f9954ff00cb387e51f4e3fa9ac5d3349d575eb836fa759dc5dc8392b121217ebd87e35e8fa0fc0cd6ef5565d5eee1d3e33ff2cd7f7927e9c0fccd3d101e6af7ae7ee803dcf35f527c364d9f0ef45c800980b1c7bb13fd6b8af871f0f34949f5b4d52cedafcda5eb5b44f2a9270bd78ce3b8edeb5eb90c315bc290c11a47120daa8830147a0149bb80fa28a290c28a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a002a96ae33a35e8ff00a60ffc8d5daaba98dda55d8eb985ff0091a00f09b4e26b6ffae3fe15cfeb5a3eafae5fdbda69967737402b1291292aa77b727b0fa9adb8ae22864b5779142b2155e7a9f41eb5ea9f0eed2e6d748ba3736b3db99272ca268ca12bd8e0f3de840799685f03356bc559759bd8ac50ff00cb28c79927e3d87e66bd3341f85fe15d0511934f5bbb85ff0096f77fbc627e9f747e02bb2a28011542a85500003000ed4b4514014f52d274fd62d4db6a3670dd427f82540c07d3d2bca7c4df026c6e3ceb9f0f5db5ac982c2d66cbc64fa06ea3f1cd7b151401f134a935a5ccd6d323c53c2e639237182ac3a834c0ef249b3249270057bb7c6af0ccb3cd06b10db06b768ca5c3a2f2ae3eeb311ec719f6af1fd1bc3b79e22f11269d656d33c8c548645f950646589f4a7711d9787fe0af89756092df1874db73ce653b9c8f651fd48a350f82fe27b3d79edece24bdb0ff009653ee54cffbc09e315f48411f930471673b142e7e82a4a5719cdf81bc2e3c25e18834e631bdcf2f3c918e19cfbf52074ad9d4b54b1d22d0dd6a1731dbc20e37b9c73e9ef56eb375bd0b4ef1169cd63a9c1e7404e40c9054fa82280395f875ac58df7f6e4d04c0a5c6a9249131180e180c633df8e95de5735a1781f4af0f47e559c97461de1fcb9241b720e41e00cd74b4005145140051451400514514005145140051451400514514005145140051451400514514005145140051451400514545733adadacb70e18ac485c851924019e0500703e2ff000ed8c9e35f0d5cc082dee27b821de150a4ed1bb3c77ed5e875e47af78bafae6e34cf10c7650adad8dc388e23302ef9186c8c7a7e5ef5e93a0eb76de21d2a3bfb5575463b591c72ac3a8fd68b3034e8a28a0028a28a0028a28a00e5bc63e33b2f0cc2b6d2412dcdedcc6c61851783dbe627b67ea6b1fe1b6a36369a341a6dc40b67a83cd2261902998824f5ee403d0fa5763abe87a66bb6eb06a5689708a72a4e4329f50c391f8567699e09d0348be5bdb5b3637299d924b33c8573d480c4807de9e8074345145200a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a08c8c1a28a00c1b8f05786eeae0cf368f6c642727682a09f700806b66dad60b3b7582da18e18506152350aa3f0152d140051451400514514005145140051451400514514005145140051451400514514005145140051451401fffd90d0a656e6473747265616d0d656e646f626a0d32352030206f626a0d3c3c2f42697473506572436f6d706f6e656e742038202f436f6c6f725370616365202f446576696365524742202f46696c746572202f4443544465636f6465202f486569676874203730202f4c656e6774682032373730202f53756274797065202f496d616765202f54797065202f584f626a656374202f5769647468203130373e3e0d0a73747265616d0d0affd8ffe000104a46494600010100000100010000ffdb004300080606070605080707070909080a0c140d0c0b0b0c1912130f141d1a1f1e1d1a1c1c20242e2720222c231c1c2837292c30313434341f27393d38323c2e333432ffdb0043010909090c0b0c180d0d1832211c213232323232323232323232323232323232323232323232323232323232323232323232323232323232323232323232323232ffc00011080046006b03012200021101031101ffc4001f0000010501010101010100000000000000000102030405060708090a0bffc400b5100002010303020403050504040000017d01020300041105122131410613516107227114328191a1082342b1c11552d1f02433627282090a161718191a25262728292a3435363738393a434445464748494a535455565758595a636465666768696a737475767778797a838485868788898a92939495969798999aa2a3a4a5a6a7a8a9aab2b3b4b5b6b7b8b9bac2c3c4c5c6c7c8c9cad2d3d4d5d6d7d8d9dae1e2e3e4e5e6e7e8e9eaf1f2f3f4f5f6f7f8f9faffc4001f0100030101010101010101010000000000000102030405060708090a0bffc400b51100020102040403040705040400010277000102031104052131061241510761711322328108144291a1b1c109233352f0156272d10a162434e125f11718191a262728292a35363738393a434445464748494a535455565758595a636465666768696a737475767778797a82838485868788898a92939495969798999aa2a3a4a5a6a7a8a9aab2b3b4b5b6b7b8b9bac2c3c4c5c6c7c8c9cad2d3d4d5d6d7d8d9dae2e3e4e5e6e7e8e9eaf2f3f4f5f6f7f8f9faffda000c03010002110311003f00f7fa28a2800a2b335ed524d174993504b5fb4ac254c881c29084e0904f1c673cf6cd416fe28d3a4996dee8c9a7dcb7021bc5f2cb1ff65beeb7fc049a87520a5cadea6f1c3559c3da46375e5e5e5bfe06c48eb146d239c2a82c4fa0154745d62d75ed2a1d42d18f9720e55bef2377523d4557f154ed078575268cfef1e06890ff00b4ff002afeac2b32780f86e74d4ecd19ad046b1df40a33945181281fde51d7d57e82b9eb62952ab184b666d470f0a946ff0069bb2eda2d57cefa79e9d4eae8a624d14902ce922b44ca1d5c1e0ae339cfa5721aa6b9a85e40fa9e98e63d2ac1c4acfb72d78aac3785f440bbb9fe23edd76ab5e1495e4cca861a75a5cab4f37dfa2f56f4b7e899d95148acae81d482ac3208ee2aa5feada7e9681afaf218377dd0ee0337d0753f8568da4aecc63094e5cb15765ca2b2f47d76db5c6b936715c08addc466496231866c64800f3c0c7503a8ad4a232525743a94e74e5c935661451453202a95c6b1a6da5dada5cdf5bc170cbb96396408587a8cf5fc2aed62789345fed4b58ee208a27beb425e012805641fc51b67f85871ec707b545472516e2aecdb0f1a72a8a355d93ebf96fd3b9ad3450deda490c8164826428c3a8652306b9dd1145c6952e95a8224f2d8c86d6659543070b8d8c41ebb90a9fc4d41a7e8fa1ea36697b616d258b3e430b591edda37070cac108190720835774ed13fb3b51b8bc17f77706e235475b8656fbb9da72003d091ce7f4af0f158a8d78ad2cd1dbcb4e94274f99dd6a935669ad374dadbf245793c2d699892dae2eadad9268e56b4493742fb18301b5b3b7903eee2b77ad725e28f12de683af69aa91f9960d1bc976a172ca80a8dc3bf1bb3599a878b3504b092686f63890eb8d64b32c1e6ed8766410a3ef1efc75ae37cd2b5d9d4b038bc4c21293ba7b3f56f7d2f7f77cddac6f7fc23d705db4efb585d00b79bf655043927ac59ed1679c75e71d2b7cc31b406028be515d9b31c6dc6318f4ae2c6bd7f6f656d7abab7dbadff00b42282e0bd81b7d91b70786e4f2579acf1e36d55a1d548f2b74db5b49f907cc8663173ebd8d394a52b5dec692c062ebf55a7cb5ba4dbd37d9b6f5b2b9d459e89aa2d8c36575ae4c2da0411a25a2089994703739cb138f4db45dda58f87ed0cba758c4751b8610c0cf9692491ba6e739620724f3d01ade50422866dcc072718cd73f39d54789cde0d20dcdbdb45e5da1370883737df723939e8a38e99f5ad233756695496872d2ad3ab37ccd5b56d6914fcba5eef7bf4b9d0693a747a4e990d9a31728099246eb23939663ee4926aed727a8f89f56d3d13cdd26c92490e2288df33c921f454588926b6345b8d62eadbcfd5acedecd987cb04721765ff0078f4fc067eb5efd2ad4e7eed3e87257c3565175ea35abeeb5f44bfe197e06a514515b9c6158971e2ad3d2ee6b3b54b9bfbb84e2486d622db0ffb4c70a3f135b7599a968569a948b7077dbdea0c477701db22fb67f887b1c8f6aceafb4e5fdddafe66f877479bf7c9dbcbf5eb6f4d4c9d36df52feddb9bf7b38ac6cee50192dccfe63b4a380f8036a923838273815bb58df6ed4349b882db578d668a790430dedbae0331e81d3aa93ea323e95b35f375d4d547ed1599d389e6725276b5b4b6cd2d3d7c9df5ee66dde8d05e6af05fccc584504901888055d5f19cfe55870f80e0b4d2e3b1b3d42783c9bff00b74526c5628db7685e78207bd75d4565763a78dc4534a31969a7e17b7e6fef3027f0edc5fe8d7ba6ea7abcd78972142bb431a188839c8da0679c75f4a85fc1760cfa13091c7f640013007ef7182377e233f8d74b45176358ec44748cacb57a596eb95e8976d3fe0852302c84062a48c061d47bf34b59fae5cdd59687797564a8d710c464512296040e4f008cf19ef41cf4e0e73515bb76326c6d2f7c377735d4d687571293bef63ff8fa55fee95270547a211feed74da76ad63aac4d2595ca4a14e1d7a321f4653ca9f622b222b7f124b124b1ea1a3c91ba865616920c82383feb2a95f78735bbe956e1e5d2a3bb4184ba81258a55ff008106e47b1c8f6af6b0ef134928ca175f23b6a4695777ad38a9774dfe31b7e56f43b0a2b1f448b5fb78fcad66e2caeb0389e10c8e7fde5c60fd463e95b15e945dd5ec799569fb3938a69f9adbf40a28a29999c7eafad59378be2b595de43a745e62dbc31b4923cd20c0c2a827e54cf3d3e7abab2ebfa87fc7ad8c3a7447fe5adeb6f931ed1a1c7e6c3e95bf1c1144ced1c488d21dce55402c7d4fad495c52c142a5473a8ee774b150518a843656d75f5d345abef7397b2d7638348126ab3a25d432bdb4a1579924538f954724b0c3003b1ab5a6eae2fe79ede5b49ecee22dafe4ce00668dbeebe013c1c118ea08e6b422d1b4e83549f538ed2317b3637cc465ba01c7a70074eb8aa9aee8f717ed05d69d7296ba8404a2cccbb818db86523bf661eea3deb92796b516e2f5e85fb4c3549b4972dfabd93ed65d3757df6b2d0ab71e22b4b6d4bec8e921890849ae80fdd43237dd463d89fd3233d455cd52fd34cd32e2f5d0bf949908bd5dba051ee4903f1ab167a3d959e95fd9cb1092065225f37e63296fbccdea4f39ac03a3ea516a761a5306b8d1e39c5cacecd9645404ac4deb87d841ee073c8c98a9974a3cb6d6fb954d61aa4b4d1477bbf892edd9f9766adaa66ae9daa5bea51bf97be39a23b668251b6489bd187f5e87b563e9163ab6a36d751cde21b913dbdc496f2c6d6f0b2e01ca9fb80e0a153f8d6e6aba2477f225d4129b4d462188ee631938feeb0fe25f63f860f3585a56a17369e35365a85b1b6b8bfb7f9b6e4c52c9174746f742720f2360cf626e18354ab253578b34a2d4a9ce5437b5ecd26d5b7b5d6aacf75aab6bdce9748b03a56916b606769c5bc6231230c120703f4c0abb4515eba5656479539b9c9ca5bbd428a28a648514514005145140051451400514514005472c114e6332c6ae6360e848e558771e945140d36b544945145020a28a2803ffd90d0a656e6473747265616d0d656e646f626a0d362030206f626a0d3c3c2f436f6e74656e7473203720302052202f4d65646961426f78205b302030203539352e3235203834312e38355d202f506172656e74203220302052202f5265736f7572636573203c3c2f457874475374617465203c3c2f4753382038203020523e3e202f466f6e74203c3c2f4654313420313420302052202f4654313920313920302052202f4654392039203020523e3e202f584f626a656374203c3c2f494d323420323420302052202f494d3235203235203020523e3e3e3e202f54797065202f506167653e3e0d656e646f626a0d372030206f626a0d3c3c2f46696c746572202f466c6174654465636f6465202f4c656e67746820363536393e3e0d0a73747265616d0d0a789ce53ddb0a25396eef81fe87f33c905a5fe41b8485e9b92c09ec4392867cc09259589884d93ce4f723d9752e96aae4529fee998130ccf6f459ab2cc9badab2fccb077f73f8cf3fd21f15fc56d3ed2f3f7ff8e543281b845b8c9bafb7046e8bf956aadf62b8fdfd3f3ffcc737b7ffc2316e830ab7f1bfa9c11652c46fb8ad417b1915ea96f22d02c1a6e8b60cb718f0bbf93166a0f0f7bfe2e03ffce9dfebedafff4340000434604abe05bf953ef94fdf7cf8570441a02d1f01795fb7166e3e87cd230519d17b803dc7fae6a6c191fe381b1c1322f2189ce3e940f08526dd07a6b0e57a3e3637fabff7b138aa7522711e3936b9bc25f6ddb3b1f7efe24238d8bfeb132de0f977c7d8f1dd792c31da1faf8d27d07d7510a83d81c63fbfae108d31a93c852685424cca2e3e06b9dbff7e08b73fe3bfff82fffe6da7eedffef4e1e3a727a57ff8f153bb8173b74f3f3d6846fe843a3465fc678c752bc913cf1a62fce9e70fffe45cf8f8c74f7fbb8546e33e7d8f3f40ed3f84f8f801d80fa9e00ffff0c327c2404e826249e84f93b8a842e4adb83643c4d827cdf93169a21f7ccaa778a67cf4c3e9acad6cd58427b2776b1ccf50399e1f3916831248e78873d23a836f3ec2254a00102192d689921f5588bc215e16daa191e01a4907be2252b6c40f9a6c41452c7cb1e0dd026a6760b2f51d473cb0254a95ff909449129ab8508201ad843a0e8e11121b430b3a9edebbdb9984cb118212bfa3f1db58386ebc5ce7c2305eeeee42d17879585a2f0f652b3edd4aa1e976962566bc24fd5c95a43513daf79db272be468c37e28485bad4be766f368d6fdaf8963ab7af4fd06a5f428d2d424e2071a3c47f3897a4232442a4c5a9d7b10e284c9c8fb170a43eda4da7a31f624aa7eb0d9a650c35a18501031d95b8bfa043fa2e21849e8308556f5c900f7971eaee504b5d29d7098bb8a201e3c289b0c15c4599a4c5174b284c1627bd13768a56459319b2810ed43f17191d1ded88d49ddafbcfb02362c475e34c43fc8b59f44fb3888a4266510a5edb80c27617508ff2dd25ffd8a7042668af914417c5f644f25b0ea1711f4d7043d879d28503de5a14683636e9e0cceb0f0ccda1d6c1c339615ae050220abf09ef923627d83b14fb95591f8fb8a7f17b4d886a9fbcc3e4207a0b25de45f4d26d458a100cc160cf2132c7bc2f6b693a334ef18c1e13ba68222de2d05839699dc5beb573160bccc53a76ddcde59478554d7c761bbae533520e83a0838f84cd3bfe918f419d17736d389df710a4a01fae99b37038acf2346e5c41bb94be304897da3d68b2e0858eb8640e326cec53c2d230b1e1b94ed1b44eadf5f49be1a50608a8809039bff4100115101cb73ec2060a8e1e5ab857f54a2be3a3265301f3801cb85dd02941a79332e7d7175e9400c8ae924c78414267288445c8ec770699c5187c8b42fd74341286eec06563ed23d62bbdb446df6a68150c158ac967844af929970d61f0e54a8b119c12e1129c16bb39c060cf8479741913112ea2dc331dc71ba7dff409dd8c30132a1a1ef321290a82fa3da877e7fcd1b2ae88497c30694a8c89d2f32f23a1a79360d02756cdffa04124daf334056811f533790ef239119a96eec7dc0e545a47acf8cd27be2aeb405ccf7a501f0b0f4717790f9a51be08523feb2af0e10a2c6229e185b81f53130a87fc75a6c8003cf25784e6ef693804b70591a6e868040ccf96aef0d70aaa5f330c3ee75bce0330944d26f9078c5b41e41b828c55b4a3635560cbc22fa85bde659c1a19e8287503111fc9d4811122058f6b903dd7d05891c8478a4059e5059da0559b3549ae6e95335cf0425813219b4b6bb2e2857a1292d0bba1b336f182b6b96ca9c97de7c5f7c3c49d15d762f16984f8e13d39485b237bf48a954e79d96ac80c40958186191930bad72260cfb58506693110e6892d58e8ae65047397e9ae6d8472af00924cb1afc325e2d0e16b96e4d0449ea6b2be6e3106031f3cf93c8a102e33c293cb4bde2cf9dc426ab1a3a7a3f0c6e9d037813286101caba5a35573630fc84d0f162c92eb078d33164b8d5eda009120f01c56ece38988ceb6c15803fed92c9463a0d93253284998085b845de094f19d69fd000a7d9a3399b3e00ae2cdd6586c5598a3a92f9cbb5386579858f91746ec8704be1e1e1234f4dab4591531ca0e8fd30fb11d33507c9c86ec463d04461337f23c06ad173778eedb24135661484caa4c625eb0e068493c391a8cb07d75c5f6045fdd2740383223e7995fdb3cd9ae9930fe4d3ea7a053db1201aa64f27c8e7dcbbba653c4419c4ef16955b340152339f169172523e49122c7d4b3654eda863624dacde1d37a6d11a0c45e4545c709a875fbac95cfea8fadcfbc4ae77528692b09e639746660d491a031ac8e8dcdb9fc0a8157f58c62f64458069c1b2dd8c549a5ccefe7293c40fb5a6a9470b15b6d0c6f3d34a52a50da00b691fa267f7d1b0114661df97918fd5103d9eb7e6610afed40a5005badc041540606cc75bbd99f40b4f091aa77fae1db0ca259a21403c65dcd440b0dad02315d18ca069533d9f385f2ba7450859258280d539c1259885c070cfe5b3e33233133090b9ad9a07589c4b1373e4afebe9dfa7bdf48be90c1c56fad15e61d9e41241c7bd297faa08f7c445715e006f4a2aa605ed44b1467bcf4f0cc93e9074ecaeec69eb6681c41b82762d1841855ad253689ff5e85081b0067f174b62b2a390e3e02c374ccc4a523df287cf4cb2ae8275840a727cdc47474f3257c75a667d7f59021a6d292c348c80cb464d8bce3e4c7c1d2c24a28afb214bf559d0d0d8c47b8b48c9a6b2dd6151a3a5c6c36e8a39a565091216dbb1b56a0651c6a53614c3f328710c6281d06a2afa42d481f5bcb399d7e50f2869bbb2577b922ca4f0a937a67e6c56a8f87e56e5bce97821edfe2d8f8b080405f0a130846fea5da403047a172abeb20c1b92dd0a1810504c52a99c8a74a8cbe956701495b32318cf61562364ed230fab2cde2dd562960b3800434bba69524bfdd0db501226f9eb6e02d20058303db4262e85d6cda1230f48ed5467d88bd04d6049236e76c2b89516175b695a44d806a53300c74828d7a0c745cb1ad6444fd326a0bc6e429d9788c294104232d6df3c536cb5ea06e024105039b11c3180dc0b69218a3052344196534169036ca680c20095326a3b6a4b8f966a325c1d81cb080e4b1396001c1c8c5d966c1a036182150c1aacd88e5b8d56a5bc98c496fb1ad6446054b3605cba860c9b692655c2732818451fd6c0141050b362697dcabaa2c1015fdb7711254b0605b16da93083639ae11d326db4a561be91533c66604a95b6ab6556c0e9db78dc10db52bdb48c780ba369b056bb4a3655bc6463b5ab6656c74fbd2a45d912eab9a18165d40e76d5a49aacf8468a29eea33832da48cae8eb4c202d2d079db66a113b6685a96e851bb6c369f4a49bdcd7b478ca86d42891a8fdecba46031a082d912c348d50046c430a0aeb6c43062409d6d8961a40baecdb692a161746c9b05036a23c330a02eb6c4906eeda56c5bc998d1791b114305b325861103ea1a6d2b097edc37b08090fbb2910fa860b6cc3062406d1417a8e8bc6d9324374e7e2c2061dfa43b04f96d1a56500f9244bb2e74884fee95da3d509658292b29f68bdf8fc38cf3b61598258c9d4703ebd266f3fda832e3d68905048d46b14967f61894d80407b38462cb766346ab61cb76a90747cc36f1cc1545c3a6379825545bb64bd5f4c6c8a7440c4a6c2b5952ef2b610241a361cb76236609c5d956b2a2b619a3a58a56c396edc60a9bb365bbb1a6fd20c40052369be45772ca36fd6abedf72378184510c6d01815158610141fdb225bbb1a17e15db42629ed06cc112d0856293b2005d67b425bbe0d27edc6900291893985612304f28b66417bc1b97882c20611ce25b40c881d9c8c73ca1d8125eeae3650b15c137eb99130454305bbe4b1765aa2ddf8500d63327a0da0a232975dcd3b28034eb9113446f3d72028ce510391b481ad5c71690623d7302cc138c674e00d4d3cca660108c674e00603d73024c138a2d7d03a0da322362cd7ae604c95bcf9c00f3846a4b6020a182d9f25d2ac5349e3941aac6332748e4c06c0a8621b5f1cc093067319e39414605b3e5bb9051c16cf92e60486d3c7382e2ac674e5050c18c93a082d9f25dcca5ac674e508a76e6f4bb6f60b6ca631f251e180817e777faeec55573e9945ae6be17e789cb2de7d5ccf213a7e52a87fbcf81fa997886b9be658d8142ab82d8f8c7c3cb294a09bf18c0ab9165fdfcb2c05ebb0a8c6eb477a39c117f2d09d44b30e980b26413af1e82d11246a367ac1a9ce145d64a05d8172e19bb578fbc22a98b80a7d3016064f55b3dc4bcb36aaeb222432bb00ebdb52b9b7359cf99b285ac7bede63405c7daabad57c0a33e2536e958dfc7c521b5909c3a9e648104d715f943e23fa894a237ee97165e2749e2aa8956244e87bc9ece2c274abf9b25d96b5740a87e9202b589d0c6c9507955d1ec077887db15bd7fa82b6e7fcb7f3055a93f0ef93e9fdb74ecd56d97e0f6caf450655c44ab3640c45d2c6e7b6489a52a04d49325173689ae647477254706f2b58d075db5687c52dd7ad0550be0fc5b78c6ba45ce0c693ff45b81092316e0b39a443a6290152a47e39ac1305890d8af51ccb3184dc85ec7cd8835d9100cc55b123c17faaac605057a95e23b3cc7c0364a3404cff9dd0bab1d895b10526c3524b137d63be0f9d29278bfb9f6d0d82f7ca5c105fc7864932c2c09954c3506226f9b724b72127756d68b56b335b6b833b47ed639e3b9085d7c3febb47003a31dce3f1ff449a85f42e078a9e609c31bda226520eaf56dc0ac2bf285d5dd3a5d49e5fcb2e963c2c0a0276ed3a46f9abc8cc4174e89356af2fdba14a3cd1636a55e6c6059698c93aa10404de743c550b816d342533bde6a5be84a5d07df5ae8bdb06bb5d05c61d585a6e2a718de5be8882952cd870bbdb6b3756bae9e668be2c6caf076fcfd84cbe669bfa2304fab9ba7fd8ac20cb248194792c966d1faa5df2f1ccc20e107c68fa81a2c8ce2a0dbb8695a55bf308a0b41607a988169615cf06f61fe908630da1eeed270d25fd970c74aec0fedc1d2b52edd8f759cd05a48cbd82d984116d292710d1a9f45a8b52de9c58fd1d6f80147b54d875a38b54b3f9cc4b2f18bbfd7766ca655e1d194de69b5616a1d4d78278f6e4570476ceb89ebc3229c12378ef51ba3ad1f2359302d7d479841e8e13906bb858388db85c2b0aa6673f7a906bc2baa8ed4687e6b52dcc98dba03a4720d8e877abd9fca94a9ad0f0331ed73ddfbb732f2d5869b74ee5ff9b4cbfa602993aaf58e74ee9fb93cbd6939a886b6b564b11c54dd4ac53a166ae9ba58e6f2e1d5a78ed03e49c15ed6aa7ab1fa5f5dcfa9736c0b267e3c3c6044ffd11e51c6ea8995440b3581c82c5be4e17a9e391a50cd1fd5fd064a212dfe8cb9eef17c7ffde200f3739084fc31ce527afb7a46ca5737f2385d0513a2117d75e40bb9d8f7aac3124e206f1af97123cf82f87e238f71f84d238f996788fca3ba91cfb197fd3310dbf67a41eb92f8b4aa91a77b5c46997ca8395587b8df5f679319af65d85afacb2e1329cbe0effb3ee0d97443c70bf3136aefc9f05a9d9df530760291bd125481a2465d554ccb772ed4440062af24b77074ef743283c8644cc8b56a38537f5492a1a1624e2d553367a0ff8ecfaaa6a219e83d53f609754725e75e23cc4054c7832a4b05bf16da506593e7ab22592c9ca81e1d87fe5ec95b128786819efb6288a9b97b8bbdb694818860cfb4ed4e5be620165fe529dd854372973c1588690244d7c5a8fcdd2041745fcccbb5559f4408be375ab3501ba0473b0b626d7b70fbfd280bb1fbfd2806a246a591eeeabe25a50ff79548f3ce3b71aeddd7d81ef2a7fd8bac551d74d093185e0bf79586259849f9d2ee6b3c4ec3f0d24f6f5bbf893c8358dd57ed57aed8b436f715366763283abc0a5c362e1e0b9efb22d842e1abb4705fd4e9c72ff1103fa8a15e2e5deb0d68d05bd0b12ed1b039f34295db6f0a47a5b6469ca50b4f83195e12b408832e76553441a7abdda90addd03d4dec059c2b9eda76777cecaf6759f0a037b7d35ac44ca24e3b22c0bff9b9e6b96ca53e1ee4e5bd6a8f8f7ccf77047cbfeb3d7f7471584daf5b723444d58ba810e587d7625b983354479c6e6c748ebea2b1a88381de9bc2422bddd8f095cf2244d01410d08e4081c63e2a9da67e7c3d1e206388a90fefdde527a7ad3ecba8c63214f65aed4b1995d8661052ab1a3557fb0dfc79d68580516fddca407e0309db7df584c6b2d881ba8658888db1770d61b31c1adbeb1276f7d6d3478d1286a68a2ee832c4ee124623d73d441f32470d26c3a5b3526aff4757b16690c5becb68ff3783acf75d64182a4af3783df3b20fa4aa0b68b37a583f93a657b5436f7b60e006b577a3b6078ce73a627b5d8f61967b5dcf04128e1f80e61b5582e7e7829cfaf5750bc7a0f4ebeb165aa06e14ab18189642bf8a6e9904835dba8ace8494ef9ecaec4a68ad7e0859c761cd4ccbaafc39444e8bac9ebdb4f3496fc0c507715fa9b06e9a44a7cdc1d86e9e40782181dade9fbc51dfba32cc4a6d7a2890ffaadcb81b9369928565d88dc90ca2eec2dd4b480cb3509bf6c4191632a7de16a7d2f60627565f04f0e8be812f82d8cde041c3c9cda6abe743188fa5c015e1c12fd7c76a37b3ce55ab61920af782f930cc04a629afea39ddb7e23fec4f1cb170c972ffeacb3ea1407e8ada0dcc845dbfc474674c74090d3e9c7a20ae54875543e7da1f7b1bf07992c5ebcba95f8d66207ac45b7af9f80c22258f071b2234b7dd24701b40319146edb402c773617362bfd8b2204d5a039e862c8bbf9657cd54878e8146cd82b255a091d11d59984177ad818b2cf0ad96e31849ffe1bd1d566a6063239e1ad8544ec9a2d829f556296649b09f8e1e76423fdfffcae45a2c94b4dadf2e61942c6bed5f04f09acda7130cfff45dfc590069e28fb548bba9fa854dbaef3d4667bc17f661ece33052c5c3f3272aa13c8ea40675d41aae029bf5ca9ef9096987e9f0e2122e26e9855ccbf4c5e33d0af13497782fecaa9da316629e4fda097ff966cff2f9dfcf538eb065c14bf9fc8650ca95be2435d02a656b827bfa21f4dece9631fcd0fa9eefaf53e52d17579d3ffb96fc629d65618d5e82881fab95e3b1ba2f15939079bd36326f35726a41478c3a42f149c42d36f5137bff512650e26cee68bb8fbee96fcf207bfcb7b6351531c369f0fb2bd699f1ba54acc348b15ece37663ad45bb405139e112d45e1784aa7f591aff432105e074cefc547d445d11513add9f52b7d6c4dde7bd927d7beaf307f73b9b953826720d2672c37fdc55e85ba6b50a957215fe84549f9e8d1bd405406306284e9ca103594ee71ff8ca9b60a5430dee3feebc4911ded71ff4cdca15df8fccd52aaed0ed58658a0f733b8b1596ba470d5dcb468578a624cbded8a054fbae0c9a558786e1951dcddccb5d38a482f2ad09107d5df1a0e58d552a74221b19fbfb968c119fae3df3316ffdf5ea43ae20cb535ec5b7ad77999dda82980bcc1f335c3b7ac70cc05b108ec9bcb9eb2a95606f29bbfb0469d48a96592859216baee32862eb7b697db37c203a92f5f7abf45ba4d63409cda83c13886c1bcfdf4f8450473cb8d2971e7de24d3b195bdc2e015af6583e67ea917132ff2b227a41cda64551be54e0bb31146df5a61d4ed4d782edae9e6fe780a23ed570dca0ff7e8a508d2cbb2f4cc0baddf539edebb1d411d1f13f5c69d3eaa0678d4f1b1bf323683988aa4805aa7f9b173fdc2f52fd3dceb7452eaf240ce769a74d1db13f61e3d139e5fb7e10e35bb74646ba649d5ad226a7659a8826c06d16222ea5cd9cfd96610f511718c56fa39db0ca26924f5a14c81d3a2bfe55e6a7f0e990ac5c2f31d71fde5f1304eba27105d022bb50ae393a8b1402dfdbd6436c96139fc61ddccb55d027a3fdb794e8b4a7ec2989a8eb52462e710695c63bd4e7e0aa8f692c7a24a486cbc68fa95e88d8dcabfb97a06bd5219da0c72ca749b6d0dfd1d872f74bdf86e5be78f5eb2ad0cc474f30c7c1dcebad141faaf665b3dbdf336cfb930adbb359ed1fccaa615e8710a60932e4ceb6e8d6710ddb4c2687f3683e8a635f7f66733c461ebbc73531b47fbb3e91bd74c6dc350b06493a99d40d48b2277533b4f72c9d4ce937c35537b9dfcbba99d11d32176537b9dfc87a99d6711d2f059a676fee625533b83a8a6f6f0448a2e44b9e36347a8a372811a683cf72cc742e747a9c91e7d47960205cf6b4f5e8eef46edc9dc0ff7b498ac84b11538a1a1578062765762e4206a9d2975708eb659e871c3c267d97713ea83b85019c3a25ed65fba0a5bf068a82968ac17780c9fd29e3ea5f055a97c21d58b90bef476f40644e909646a473f83ec27b54f3cf5d2d4512564991515963a7e31f60c5f16f86e8b28907a0a69e6ec09dc6b73c197df548bda301ca737f0186d6a3b26742b940259d8b13fae6a02295ba21d5a0bc8e87e630129be775332818cf6372690bdecc40252fa0b3d26903af6b40d207bcb5f1348e8a5dd2610b48c82637b35e64b2989106dcf7f1895228f6676c20b4875d12f66b9feacb28194e831d8899c947ddffa0551fd1e16fd695a273a866e9963ba1f0b681c54b75e63dea098549f5e40a45d050beae07a9f3013484093cd638005084624c6a5040cb0c5522e406a6f696e014974b3d10842ef5ddb38b63ffdc79cdcc785fe88bf8b945095637a5243c8cfa8e3a9bc8ea74c7f3fff249dc0723af6968c6d3eed123f9c6f6f53a30c1edde897df5bc255134103e7a774b5222c5d72980748221e12264d4df9e8cd0f1badf4585394b48a69d56f444ccf84c83e96fa2b3c4892a9fb07d57278cc4a60eb4534190386970749f624ef97c74b23a1e73b91eea521105d3aedf310c84fdf7404e791def7674ff4a18041073dc3447dc2ebad524ddfe2ab899ab0acbe4ae534a3a90afee1f10f00fdb3f46cac5f21fbca813e84dac81d0da4e74b9f1ce843a98ada1d8d25e3532f8edde9ba3676e7ec95b1c965a2fedad844afd26a634f1fb3b97fe2175c6fd7a149073cbd287723d7987b808062fd979f3ffce19fff8c91d5f7ff7dc3b96ff01c1d3a0750740113a5fef0d33e388dc1f77ffe0f8eefa5240d0a656e6473747265616d0d656e646f626a0d392030206f626a0d3c3c2f42617365466f6e74202f5245494d425a2b417269616c2d426f6c644974616c69634d54202f44657363656e64616e74466f6e7473205b3131203020525d202f456e636f64696e67202f4964656e746974792d48202f53756274797065202f5479706530202f546f556e69636f646520313020302052202f54797065202f466f6e743e3e0d656e646f626a0d31302030206f626a0d3c3c2f46696c746572202f466c6174654465636f6465202f4c656e677468203331353e3e0d0a73747265616d0d0a789c5dd25d6b83301406e07b7fc5b9ec2e8a9fd11644d8dc0a5eec83d9fd009b1c3b61c610ed85ff7e69ded2c1048587e4e48d3909ebe6b9d1c342e1879d64cb0bf5835696e7e96225d389cf830ee284d420979bfc578e9d094257dcaef3c263a3fb89ca32fc7463f36257da3caae9c40f14be5bc576d067da7cd5ad737b31e68747d60b4555458a7bb7cc6b67deba9129f455db46b9e16159b7aee46fc671354c89778cadc849f16c3ac9b6d3670ecac83d159507f754016bf56f3c895076eae57767fdf4d44d8fa224aabc0e50ed95ecbc32013d413baf14750275e91ecaa11ada7b6599571e43399442059441c8cb919761951cab88187a8112e800612f05f622049440c82b90279057204f20af409ec0ff153b7f70b713ba1ea1eb33ddfb232fd6bad6f8cbe07b72edc6a0f97e5fcc64c8555ddf5f8a60a3470d0a656e6473747265616d0d656e646f626a0d32362030206f626a0d3c3c2f4f72646572696e6720284964656e7469747929202f5265676973747279202841646f626529202f537570706c656d656e7420303e3e0d656e646f626a0d31312030206f626a0d3c3c2f42617365466f6e74202f5245494d425a2b417269616c2d426f6c644974616c69634d54202f43494453797374656d496e666f20323620302052202f434944546f4749444d6170202f4964656e74697479202f445720373530202f466f6e7444657363726970746f7220313220302052202f53756274797065202f434944466f6e745479706532202f54797065202f466f6e74202f57205b33205b3237375d203135205b3237375d203430205b3636365d203433205b3732325d203531205b3636365d203537205b3636365d203630205b3636365d203638205b3535365d203730205b353536203631305d203732205b3535365d203736205b3237375d20383120383320363130203835205b3338392035353620333333203631305d203931205b3535365d5d3e3e0d656e646f626a0d31322030206f626a0d3c3c2f417363656e742031303137202f417667576964746820343738202f43617048656967687420373135202f44657363656e74202d333736202f466c616773203936202f466f6e7442426f78205b2d353539202d333736203133393020313031375d202f466f6e7446616d696c792028417269616c29202f466f6e7446696c653220313320302052202f466f6e744e616d65202f5245494d425a2b417269616c2d426f6c644974616c69634d54202f466f6e7453747265746368202f4e6f726d616c202f466f6e7457656967687420373030202f4974616c6963416e676c65202d3132202f4d617857696474682031333333202f4d697373696e67576964746820373530202f5374656d56203630202f54797065202f466f6e7444657363726970746f72202f58486569676874203531383e3e0d656e646f626a0d31332030206f626a0d3c3c2f46696c746572202f466c6174654465636f6465202f4c656e677468203136393634202f4c656e677468312034303430303e3e0d0a73747265616d0d0a789ced7d79605445f6eea9aabb757792eeec9d05ba43561220610b04226902618b40d80912092a0882caa22cca082a82e242dc50710117146194100403a2a032e20ea3a2b8028a0a22232ae2c8d2f77d756f7708199779effddefb2b095f9faabab59c3a75ead439f7de34c488c8410b489067da8c09d3b2eedae425ea564f1431eff2f173a6c56c15c750e3df807fea95178f6713dff89e6820d03130e9f2abe62c7b35eb3011439b8ec593264d181f55e0e986ba1f0019c85ef2ed532f04917e0828bc74eadc89dd0b3e5a48747d1ba2d427264ebbf4f23d9376a612751a4ea45d74f1acabfc55ef4f3942d4b713f29b48f2a613c5455ff3c03877f12f469241f2e7f121db0a25fdf0dabad5a7169d3ee3f21919e0df81faccaa804fbd477010f572ae39b5e8e450978fd2643f677f2276c93af8fc898a692aa9c4c943f9349248edc9c791425c0b75c58b425843d789b758a132932e02c6e82d688bba93d6b06f5921ae2de66bcc6ad182de50fe4eab503f1e658341c7f022f329d45f08fc0ccc0326015d811b8027810f80c5328f3635c030f4b14ef663d1afe8b4fe0edda4ee340f63bca1c02b40a53a9286e35a8556441b651e63f5451fdd911e82f2b11afa417a2cae6f40dd6116dd496390be0ed74f20fd02d287f4dbe9983ad27c05e92328ef88f1e3d0d74acce70e8cff9132d33ccad7b018f43d16d707805e0b3a177436ea5e8174001889364331573fca07225d01f9f497e5c03ce52bf317d06b209f525c6f8b76cb91af41fa01f07537c6781fe94885a815ea8ce4e751ad68610ec5f8b7d8f3b6e62e791cde3027f06ff1f4fbb856f2d718367f677196b7ff40cd399849cf888e7400740e900bb4e1ef58eb3606d7fba95f632d0083580ee43407737b46b984561964be043e57a8cfd121e46f68c04c6aaf3c643e278ed3245c7b535b468fa29c787be004ade6dfd33d5a262d86fc4ad0ff54a00bfaf45afa7009d67ca6f93de895cad7e07f26ad06da6157bc149693940df2b7635d316ff3b4dc310a7419d031ef7dc019c907c6bf45ca5cae3b1b191448cb71ae91eb8f31670357a17d10f5ef96fa8cb5d1d1d7add638d63a84282075af31240f61587a168225fb35341378097856ca0a321b0474423a0ae80d1400fb317e4bd43fcfd257e88cd44da91f5237d057b95c2b4b67ed390c838e1d0ded9917d1fe08b01a7848fb3b3d0bbc0d3c88f91c93fb45eaace433dcb7d42da933616ae9f714ba0d7c79e53ca54e9da558ef233457f260ed41e85698ca7d27755f529147032dba872aa4ce4a7d0b5329178b7fec47b9271ae8d9b97e08de5bc97d8af60f5bba0e5d0cd3b02c1ae801aab4e47d0fe676023afc256cd507345a1d4cf344193daa3e8ab22990cf1e94e7d15c630fc5612d07a3ed034de8fd12fa1e7619c6daa3ac853c31be25d73dbc95b287a9ea5aac3bb137d4b5fc3a2bfd1fb429d876fb9aa4128daffdef96ff9f807fa8aea589487fa7ee314dcce72eb927f423ac00f08729caeb800540ae91c7ee37a6b07a7d047934a2e3c0954a80baa901eaa26cc7be8c87cd23ca44f908add4b2bbe330c6307684158a3dac508fa7db95341a2fc7e21f422700d93fe8b4467a748ece35d5a5300deb6b532af530a4539521fbdb3764db9a50f34d608f3c1ba47db6ce07d86860a8adafe68106fd7c832e061d1ad6cf73f5d4fca8917ebe03fd6cd3542f9b5279b648fb1edea7726f84e72feda3b471d2464a3b276d40b87e537ab63d93e7d37d961d7e87c684f6f6c3c01a6006aeb5c0b9f5aa6d87cd2318eba8b68766ea253453bc4133b597e9527d3a2dd476d2a598f7be8633759cb93e749e760c9fa5524e3817d787cf51b594122d7bf6125d60d99bcd946d9da3e04d9e9fdaa374482ba198905d3922f7a1dc83a833dc3a6f5e00dfbf9ac7c1fb23e2079a22cb955974af756db165d7bf51de37ff2dcf44f1004db3cea2bde6574a29cdb7daae30abb47c9c97cfd08d0dfdc93aa0b24cf2af273043390cfeb65b67fe75617b2cd7de78d9fcc018093bf1019d508ec0864da187d49741a50cd658fa38d46abbd39c68f535c5fc52cda0f3ad3a80d566bef949481e96bdb1ae8db4f2af58b2409f90c133963fb107725dc31cfa1eaad40fa3fe1eda8b7d8732603b2d93bc603f7e689dd7c7e11fedc1d95806ffe027bac6d2ff83e6dbd867a90de770146cfe49f35dd8de0ad4ed173aab075bbe05f68fe56f4047f43879c69aefab7974b3b286de42798d7e2d747235dd0a1e8662fff6552ea372ed08d29bccbd21bb3d52bc8c3eafa71b2dffa4c14f30fdfacbe6bbd01fdb5f903c483f45f2b39c2ac556ea8a399defc8c35ceae85122f352e01ee0ee10ee698450195d6ce7991f3447dc4d2740bfe21364b9f81c6969fb6b94a761d71fa478f194f94f65223da57c4723783e0d12836897729406a9829e42be4e6943ebc551d4fb376d025f835427e5f37cf357914069ca219aa5549aef61ce0f2b7554284cec672f4529f79a3fa15d9d5a4fabd58bcd93ca853408a893e085d88f0e5aa1dd4a83e478b27fe071f49f28a1cc357fb3da3582c56b1892e7c71af17c2fb513d75396c5efbd54d6985fc96b039fdbe969c9e3eff167f121fb453babcea78478c1fc0cc8b4697048239af05fe0b34654aec367d20797e782b6017a3d0eb66f0e7c964d54833e7f263a8d7a676e473d786a671e46d958a4bb031d906e85b2e9a077a2de47484f41f9bbc00e94952a29d43364a756238f58e8cc5ed035a097a34e3428ea9e7e9ee8d40f36cee421df134807a04fa705ca6f05ed6ad3e03768d71fb49f7ded741dda6c03de0c21c12e3bdd1b1884368b5056069c87fc4c608ad4edfff46bfe87e91f9c67ff2d6d747e9d94687a26fdd734bc9e7f419b9e5de1f5ff2bdac8073d9786e4109e47a3b3f44fcfcc30852a9634066c73116c54866597a56d843db6ec51885a7e80b48b33e13bcfa46701f8efe492b6d8b287b0c5d21ec2fe5e6e9df5a7c0cf4c9a10e64bda12e855bda830eb6107a4cd1da05d4897cbb341a6a5ddb6e84e7aa491ef52ae8d429d9134cef299bf2427d23d706e5c0dbbecb77c955f1163ceb1fc930aa04bd8ff906979e6e9fde906c8aa75d82fd6bb633dbe809cbe977c9abf58e78bed770c94672e3f80f87a0d7950ffd6501c790267ce4b568cb105f1b26d9f43fe31fcbdaf285d29a414a5d0fc38147f5f244ee2ec967ecc31f3172bd63c45b5ca33e01131be730d553a204b03f3718ca4b17a2ae63f832a9cdda4cf62e565dc3521bcbe589b69bfe3d3481f4d6fe4ab59736eaa9b167f85e61e79ce341e37dccee88773e506d2cec60f7fbec742ba96d554e7fe30de68aa7b67fdbb1390c5cdca23e676a5b5f97483af09dd5123e02344d0dfc2326eca4b782cc8a5ef1fedc9f01e01eeb1f446de57b0ef2dc02f850f6497c97b0cc3a107132c3f0abe803a16fec0ddd0d535e680d07d8780f20f6b4d9729efd2ca90af3032e40ff700a68a1ed6fd0c275f88f8b208b1f7ab34d0f2096cf4c71a6458732bb0ef0768ff049ea1f99a1bfe5b0bf39f8d700432f34bb901772b9bb0f736597edb3bfc0ed36f610d7c8f3ee6eda0016eef971ecabf6d1f0df53ed52c3fdc7c57b9829eb16477177414eb0fec5238fd03b80f88c07c4a2c599dc01877a31f3947ec6d516a5e80f65f8be516afd7281cfe21a74ce8e55c7d3ef4f56ee8ce4dd813f7d172ed79e02bba42eb0c9f7b007ca632ba44b981fa8bae344782dd66eee0c53407e82a213ad21c651afd539c47f3e43d2d79af2b7cbfc0f6bbd9031242a79f8103a17b5412732570ed63dbef6631401ad6e831c8a003e81e50ec557639e8cf213cd9081aeaa02d3d86b57a9d5d099e4ed215a2802e94e3080f2d6b0ad4bdc886f934e816796f4319051d3817bd9a026d25cd6f0a944b9ad914a1f2e4a640b9a4a54d81f2d2dfe1e38feafd111f7f549ed51428cffa1fe0e38ffa4d6f0a94a7ff097fe54d81f2f2ff0d3efe48ce194d81f28c3fe1635053a07c50533e70d60d06e6c08f7a0cf445d8ab36a0b341e17f99f0e9cce790864f47d2c79c64d731af07beb64129c0b548b7431f280f7e091c43fe6fc02ca014f9ef81c3c057c054f860a7501e857425701c78059862d735e1ff07d3800a603280ee835702f04f8309a1f6b1a0881d82cb81adc8af00e09f069784c693ed3f05ba210f5f50fac941698b31a6f901709dcd7bf069e00ba4b3d0fe02a4bf03be0d5d0f21783fb00fd77dc8b707a45c86012d803840f2fe0ba80e24236d02885f82f1c80f055eb57de4e08ed07d5187bc27aedc8833e605eaa39ea123fa8fb45c52696bad1876b2f959a3b34afae4c948578897cd9f34413394621aac5d496fc2cfd8a5f7377f85fd8e55abe825d47913675382f291f9bd3cc32c64c07ff800e7e7017a5c594933e123cd120be1b3600ce547ea29fd1779eecaf1c41ed8fa3dd4c6ba9f29635d3b26ac7156d106ad1b62a1bb61477752a9fe2aceb409f09d479a6fc00e7fa64f42fe529cb373c9d074ea69aca1befafbb89e41714abc79467b94556af9ccdd70fef5a143f0e31e08534722fc9d4f50fe18cdc1f9334c8ea797cab333f866786ccbd7e2742d6cec40c8730c7035d61394107b9c96b18215a35be7f71a3bbe0ddd0ffd451d017f7005759071bc154b877c45cd477b956f100f9f827c96523fe307c4e8e534587d879e536ea2bf35ba0f7a429e91da49c4f688a7c33ea4b6df3a2fd3c354fa1b61bf54ed83bdfc3415c87b0556bcbe13e7fa1e6a1ff64f1bfa90f71110cbcb7bc04dfd9ab01fd5e0df847cd58631c2f3f90a3e04cecf86f987e87ff81bdbb1e711f3cbfb13966fde94867892f727e43d82b03fab7f48e3f4ab413f665eed4ddaa866302fc6dd6838cd4ff485e6bbc620c8ed32ea67f96b38a3b58e74c2f138c9d80c31a289fd457176bc4f88d382eb41118799f21ae23bf300ca6a41cfa0fc8cf4bd01ec5ff3b80c43716db71deb05e1970727020751dedddecbc1cda09de53339d4ff3bf28fdb7dd31540ef10fa8680b8d5f2537b37baf718f6e59bd2b05f2fe538b7099ddd245ff0dfc672720fcb67457f74efb2112d046d75f69ea6596ac3f667c37e74531aba8f79d2a6a484f21785682ba96b961e37a14defcbffd17dfa3ff163878563148b9ee35f9b279bd0b10dcf1bfe8286fcefe5212a7d5dd85053dedfb90ef4bf8e21e5f33d793f314cfff3be6a28366ca021bfbce9f385b354c648cbed677696ff6e3fef90cf1cfe040dcfa67ea6ab809567298b9690fefdef416b49d700abf467693c707b985af74eff04da52b45b4aab0c1f8d076e6f4483124d9f05368560740db04ab993c603b737a2410bbfffdc709ef630c67d18e3a23e70bbfe06f87d03eda4ffff27d06eb0e678bb31cb9ae33e7916fe291ea75912c67d18e73eb4d98571765974af4458ee613986e5d2e8d9a7cd7378fc50bfffb7eb68c7db7f8cbf5a97ffa979ff19ef8d01bfe44eeb39bd4d5fb29edd9ec3b3941bf8be81166bdf40ef7fa6c5fa28f82cf2194143fcc2a2ff4497acfbef62022d166fd072d47fcf0664d5540fe4bd7e8950de7eae00dfe81b8c398026c97d209f69d86031bf271f1de340ff26e953401f471bf93cc28ec9b662affe2df4eec02b21dbd7dab199c6c016e848cb67cd738d5af37b85ccf795976962c8df1b6bdfe33403763c2d9fef5bcf4a8669c369ae78c4fc44eb87583416bec32a9a2081f9b50ca1228441c083e0fb33e061e02ee4bf024f8b6c5096846867be046cc5f5d743e7dce5b6cf6df9c8a742e8192a977e7740a2e1d9ef56f0528873593e37ffd9f2e1ae553e066f1f23e63d040a7f01fc0761c78ae5f31671805a5bcf12b686de03b0cf11f98c5fee9556d6f3f347a80ae905d6f5a7504f3e2f40dc2fd6d2e2d0f39705ea279466d509bfcb20ed6421a58a9f68a2f2bdf99df55c01b1bf229f55a00f2d9fde917e911247e3d5cf69bc388d98f634dda6b840f7da50bad187b29cad479ed3654a346825ca1f06fdd5aabf4c198f3aa780a791ee89b22174046ddf5427c19ec6d2fdc03f104f6f540ed246311431ff507a1031f546095e43b70023c4305acc2ea442118579bf823a45c065a8530c5c462f021b4415f566df2236ef4a0f018fa0de43a290de1633a89f9884983a85368929a8ff3dd0dafc00fda9bc9818eab645bd0bc524f37dd41986f105ea14a2cee55a0a65a877d1535a028d5093285e4da64dea361aa48ea63a2d0fe7f8df6904d6f621e03e09f91e0362fc02f8e8b741be64bfd36053be1690affca005d6c07a5787213aa2b5f69b3ed6fb19d0799cf983d423e6297d04d5e88fc2a783ad0e3dff7b1efd2fc6fa94438fbe451f85e83b5d6d4defa027741dfcda8ed7c825f50d7bf496f03d5049e53333a93b219fac1a754a4402c9f8ebeed07dadb9d0e94ff516e66be81f7a6066c217f8bb84f5ac698d793074aff284e844572b3dcccff558f3ebd0fdab1ed6f3ad17acfb48feb3fd91aaeea6807d1f15f51bdeb5317f41bff25d9ab622cb7a17e701ebdd1ad9bffdfe4ef8beda6cfb9e1a7c8a4dd8b3f24c98697ec1ef307b59f7d00acd77a03b33a1075b802bc5d596ce8c601be92ab6d17c55ea0d7445aef545c0d4102ee29dcd20e870c0c7475b3a351bb84714a14d11cd10d310835d46f5d81f1bf97e6ac536996f42b72e84ae4c1473a0475da916781a7ad39f3f42a32584a487a8b5f0d3f390690f601ae004a4cdbe037a9e039dee867e8ba15bef21ddc97e27ca7a3fa5ab5c27d473fdd5d9f6573ec15f9de17f555feca33bc08b024c95cf9543beb123fc5c1eb65afa94d049ebfe6202aeaf08f9580315fb7d26ebbd2ae5b0f923e2e1b7ffc377cba0abad773e427117e45305ac0010c79b3b815c203b14477494cfcab07fb215462921db9782fe6341b5d033dd6e967fb7c6ecdfc83f0ffbdb1d433a354bb99c2ac5bd88eb1e9571ab15cbc8fb256f03ab01c437c14f2cdffd0d6b1f8e05c5ce0cbe876b32267a19d80eacb3ef6704dfb09fb759365f963f19f2b5af69f0593713f6a23945eb8af20f689971017da77d4177638ddf16a9b40afaf41e7052bed322813366b0fd8e117d84b95c86bed680ef55cae374ad984b972b3793531986792f26b7328e8a945b69add2d192fd6265298d015d289eb5e2c411803c57e4bb7b3315f9ee5e777a5d09bdbba73e8ef8f234f4ee63aa7494d018f52d5a2d12cc9fd5fbed67e5d6be6d6ffea04ca3f3f96c7b1ff20a9c115f510eda4bbfff1a595f5eb3f467b7f9b2f22f8cbf9316293fc2c62cc2fe6d0df99d478bd418ba006d2f10bba983721c75dad0055a8e755ffe027500f4f9368c3f0ced4ee0dab588959330e723f4b07217d56b43e845e53173b7f224786a6d7ea9bd6deed036c3f76b83b8a51f452bb7a3cd8f988b1bba2679f83d489e243f8d20f9698c302f4d61f1d118928fa67d03729ed6bcc14bd3b1242c399c17aa0b798465d208aac5c7de73e5d418a167193608326bcca7945d1852868d9104db26651a46d339852065dd18d65cc380ec1b8079cb75b0e41f5ef744cc73b7b9d95e77f34b6b8ee04bcec99acb35e6e6f09ac35fd02cbe11e7cbb5575a9201bea6639ceb5579bfed31f341f54a5aa98ec55e97fd4bf985e465cd15fcc86b56df9237795dbe8f2179781332c69cc37295b2d4db983bf572c86b09fabe166d4660acd31857f67d14f930ff07ccc7655fda03e6e7ca48ea1596b5d566a3b9d3e23f34af06dee5fa4b99a24ff511ec13e8aaaaa3fe36e8ee2bd0f30fadf75b9ed6ea50f602f016ca0ec87532df1297487b65bdc33a0b700229d8f3f279432220df3b9d02a40319c04e6003f00f6beffeb7907bfcbf056cc139804df82b481bf057c01e9dd7386fd98cd9e66d42874fbe47a6e16bfd451fd22e35f8037f02d8ac9fc236abe918bcc25c0eac1277d244e8c600cb9635c6fbd4dbda2fa1fd0c59cf071eb0fd7fd8597976fc663db77b5af9843eb3eedf1d0c9d335fd126d8c4de388ba28c2cf8f687cd77e57d1bed41f31723cdfc508f36f75af5e0cb1b37c0eff799ef1aff80ad3d85b3c8be0f38585d13ba8fb4860af90cf8df2662f4cdd45749a70a350e7a7e10f968c40165e642fbbd26968873a5525d0effa80574197ebf8c1dd86d666751c852c0cb0df2ecb3dea77b95ca2d5fafd1fb39f25d95d0fb3d5faac7e845f8b443d45fe99fea37b44e7d895ec6d93752ed8f7df32a55e81780bfef698e7a15747735e2b0fb690cc6deaeaea0636a0a4d41dde9ea976877928668add0f6377a4afd0cfbf4495aa5be8eb6cbe933ed2df8b5d974b95680f9bc4e5bd51f31d634c4793720ff1bad465c3046fb8e366919e6e7da087a567b80e6f022d65abecfcbe6502edb4fe3b98f4d86af76b392ca46e859f0fdbe354d7502e29a0be14f7e87fc4ff0491fc0d927e3e09ed09b21341f3260bc3791eeb7dea79c0f39de69f99fabb187bf03fd1c655f530def61a65bfe640b73abbc2eb2cd2d18e34ee506f384159bc96ba887b25b659ff0a503e2261a69e50f9b372afbb03e8f53b59661bd175f2332a89fa1d05409cc6f8b6317d53486738de513e729d67bf0666b658f19e79c674e340ec3af7adf1cade6c0770ff9477a243da67725436d4757e85540355da1e6d215da67d456bb8f26f3a914609fd04c3e81e5b0c32c33ec0369efd309f51fb45c59003f6801652afd104ff6a338d543c580539ed152e71debccc35a90c63ae69887f4c934d6f8977958cfa0b1fa369457ff2745fff783ef0bfee81ea7e6a26f11031e08dde3acd05d74b17a0175d11dd0895b699e73316d301cf29ea4790a6b7517e611abb5311fd797d397483fa95d6df92073f4af6983d696ae417abd78017e4b2eb55773cd93d0ed76f0231f0afb59ca33986f1539cedee394eff09b77298f9bbf897dc0f3142b9e378f28579987817b956558f365348a3f439f6b7d6023965085318bfa6b1db0ee2da8542b862e2a905b4ba286f71f881cd867ff52eae912e8d062a0bbf215e398df286d11c6ee64c5eb561df512b49d4ed7411e5f2aa3e9712d0e723e6dd90ae93fa5859e578cd4075286761d7553079a774067baa9cfd3346507f6e17ed0e7414379f0e0c67cbe43fb48f9ce01a813f953a17bb83198f728f4990b3e96c9e70d8859cbb4767433f4ea37d43ba6b4a744ad9bf930f241f95ea79144cbac67585fe28c5c4e8fa969b41171d94d984f14fafa97b42fb01bbf392e451c78849cd67d0a85c663ec336a254587fe9662be3848d3307f173f857d310e71ddbfedf71994e5f0b9975b7675b1fe22cd93f72724e49a4b28eb11ebea3486ff9b4a9579401a62880594005ff631ad2f3d26df4f50ecf7237a60eca5c030c4b8f7caf74ad57cf311e573f35a651762c5adc127556fb016f40ee57c8a045fd7f21fd16f0dfa1849b789dbe86d6d0ff6c1241a8af117e91fd8ef674affc17e8e609e0ef41a313c50d2e3bce2eedd8aba7629ecdca96387f605f9eddab6c9cb6d9d939d959991de2acdef6bd922352539c99b98101f171b13ed71474546b89c0e43d7544570466dcad2fb54fb6bb3aa6b95acf47efddaca7cfa78148c6f54505deb47519f73ebd4faabad6afe736b06507362939a01bb66a0a126f3f88ba9b86d1b7f59babff69ddee9fe7a3666c868a46fef9d5ee9af3d6aa5075a6925cbca442293968616fe32efa4defe5a56ed2fabed336bd292b2eadee86fbdcbd92bbdd70467db36b4dee942d285546d62fab4f52cb107b3123cb1acdb7a4e4624b8aa4d4eef5d569b94de5bb2502b32cbc65f525b31647459ef94b4b4cab66d6a59af8bd32faaa5f4d25a779e55857a59c3d46abd6a756b18ff64391dbad5bfbecdf625b7d57be8a2eabc884bd22f193f7674ad185f29c788cec3b8bd6b13af39e83d9b45e731bd462f6e7c35452c29f34ef6cbec92258bfdb5db878c6e7c354d7e5656a20fb4e5997daa97f4c1d0b749297af3c188645f4ec59ed484f43259527d99bfd6915e9a3e69c965d55890e425b534746e5a5d727260b3b99f92cbfc4b868f4e4fab2d4949af1cdf3b757d1c2d193a774352c09f74ee95b66dd67ba26d69ae8f72871211918d13131aae5929abba4c950f6d1027931ca5f7871ad4fa2ff68393d1e9984857f931a12b2db9b82baae1a792a155ed255886c9b58e5ed54b3cdd64b96c5fab667ad2fd4b7e212c7bfad1efcf2d191f2ad1323dbf904c4ae56850305c0fa76bf3f26a7373a55ee8bdb090e0b18795efdcb6cdac7a3e327d9ac70f02f151c56834abec960f99a7a5c955bdb53e40172153bb60c8683befa78b52ea28909f5759cbabe595ede12bf123e49505e12b0dcdabd3a1becf597fef165f6b6435fc737b1262cb2675ab65097f7279827dbd7c587af99031a3fd654baa43b22d1f7e4ecebedeb5e15a28c5ec0b1078ad920949f54f87c60d1d335a16e09f9ad927bd6c72753fec30f0581bdb6bb448e195768aa708ab2ba8edd8869e65667484ec4bc9d42cb5bfa456406dad02e6ef53eba9ee677f563ad3d2feb04dbd6e346a546f1e93ad2c72b659684ab5ddf2cecd773f277f0e77114b04f855b278f9f0314b9638cfb9d607366ac9923ee9fe3e4baa978caf37175c94eef7a42fd92c7a895e4ba695558757bfdedc726b4a6d9fdb2a318949ac1b349b53e9fa7476f390f50176f3b031a3377b88fc370f1f5dc719ef555d5ab93e03d7466ff61305ac522e4b65a1ccf86586ca1936451d37acfa299b03440bacab8a5560e52fae67649519e1324617d773bbcc630f94650d14208e2b8a7d2510aeada0ccb0cb16d8b57342b50d5cf1c82b5b08669fac8bf68f342bbd868f6eac3bd686ac6c4bd43382868b31f29717520bf2894a319a8a41476fd05af80a5e1043c060400cae2bea18a817833778e23b80566c88889174e086fc8e16adebd1d1ca96f5b7b31556b66e8c4d26745c202fa6a4d86d62e26cea8aece0ee192f06e2b41e483f00824af03918580a988042eed0752ecedfc05af9aa5f14e5c897433801d17f43af5e1de66f13fd6905b00f10566981c554ff0d9d3bdb34bfbd4db3b36dda2a130347a07a09301fd8156aae5acd1db11df27ba68901b83400e32cc5e7366017b00ff80150c1d700ca070603d5c08a86d27d56ab8018b0a1753739de80d084076c70793a54f4f4887ee8b81f1af403bbf293a1493f74dbcf6ad66f83c3d32166b3b99d7f5617e8d9c14e14155b892f3614f7ecf041cf24fe051a15f0cf28005400d5c06e603f700cd0a1009fc1dbff8c5602b5e841e952d3b3157f0bed6af8eb724dad74c04a1758e9022bedb7d2fe509d55885056d12cb479023d3d419c3f11c81cb75fdbaff36dda369dafd3d6e97c85b642e783b5c13a776bee5099bb67952885804a21a052ccb2d45aca5248bc94c601eb80ed800968940fe59b0f7072e3d307c892126030b054fe3105b00d30681d3e99552f5c675ca8b50968e4e19d91eb6cf5d519753a43309d216959c6acab25c060592606e0b75494f22ef82dc46f67de19527ebb2ead9325eeb7c28937c38937c289d765a2dedcbee1f2e4628b1e4eee2c2fb00bea909005f3427456885687683b9bd6e576ea68918e36e96093f63629b049be4d726dd2da26393649b349a24d126c126f93389bc4da24c626913689b0894b920db92166b26d66b26d66b26d66b26d66b26d66b26d66b26d66b26d66b26d66b26d66b26d66b26d66b26d66b26d66b26d66b26d66b26d66b26d66b26d66b243124a9314ab90d1d9578f35b0c89b3679c326af075ca0976714fb0ecb3cbb20e0039d07cc02aa8176402e900da4c93aa2a4ee8ed6203d36f8d37de37a3ac4797425301f580a28a268833fcde7833dea0ab5ed0a45ed0ad5ed0ab55d81cf75c03640345ce3a2f326f4bbb4a418e3276d022bbf5aac6cb038646b6d32d226236c921218047a12f80e780f980d5c018c02ce077a01e7019d812e8c62f6b3638cc74c630b580d138c9183c1c1a5c444381131d146e0059e20bf7680df52373916fd6faccbb9143360cf21be61e4631bd8388bd6d2648baea56c9609ba067424e86375b98fa0d90a681fc8c3d030900975392d402ea9cbf1835c5c97530032be2ea7a794735df623be9e0e368ab20dd9e148ca65cb4147d4e5de82cbc36d32ac2eb71788cfeea1655dceddbe9e2ed68226f3b5a89b42d9164da25cbeb6ce7732bb5e6175bedfb2ebf9da4dbe5f7307fbbecbad37d826dfe1dcb9be3d39f59c05dcbe0fdabde37b2fed1ddfab39f9be5726a366c0e5db3ef91ddf4ba8be3ec3ea60792ea48de20772bbfaeecc8532b44331f2b3d17456ee5adf347485e1aef459b5af48ab67cb71f5f2ecbb7d1372aff7556723bfc9372e37d737aa5d3dcbacf30dc530a8783e722337f9ca3178ffd0c07d73f37cbd31782fc9679daf678ed563003db0408aefbcb483beeee0a14bbb177c9d73bbfbdab73be84bcf2df3b59a8c8e9ef78d8874443abad4d4b3f440a15ef3b95e3343af19a1d774d26bf2f59a3cbd264bafc9d46b5aea352df43823c6f018514684e1340c433314831b64c4d59bfb036de47733c4691e4934457e2a56dac3e527b7bfba813383d3008aa98d15e5bc7c58696dd7bcf27add1c5adb25afbcd6a8b860f47ac6eea894a5b5db2fa6f28bfcb52786a5d733279c2d35bd94d5c69453f9f0526f2dbf193ecbf0d1d072d9e0a61419df6c26c6926eba3d25442b2b7bc1ed58016d64332b29615689b724a64774519fdebff3511dfacc3bfbe36d94ce2baf98bb19eab17a83ee2bd4911d866c8dccd6c8acb745edb2f261a36bd7b4a8aced2013668bcaf2da5b86f9c78edeccbd3ca1acf7669e2849e5e8cdca06ee2d1b2acb950dbd2b2bcbb1c4563d9c6e5ed4a30c49502fca20bfac47fe28c3aac7d7daf57c0829512f4712d4f3ae229f55cfe75d65d55398acb77eb2bfacf77ac4adb24e3ad164abcee4746a5467331b4719a8959161d75ac9c6c95a6c5cfa4a59ab36cfea283b1b55da655b55582a655b1d65b354ab4ae7b355d24255c63554196755b9ed6c955cbb8a5813ae22d6a04adeffc0cf84d2b2c9c34a5979c5e8f5069556c2e7b76882675a0f4b3322937aac4ad942ef8923e44288e4448ced4ac7c15fe2cdf314b3fc2a34a89bcf5855a595fa41a6b4885a0dd57440f6d03dcd7b5d8afc6b84d5560f11288e0c5d6adbb36d4f79093a2f2f45c9003e74c97b5df7b4942d6c75e89207c5d118f7f7a63073e65579331b17fc6eadffee87bc65937bdbffbc21a0fbab2d5c35f32af933b3ac37fe5d45e5b5b9c3ca6bbbc2075fafeb6588967b57a2ac5db84c08ab6cbdc3013abe77e5ccd04fde55575f858120ad40fb00bc86005c8600fc85009c85003c8500dc84000ef0004eef008eee00ceed000eed004eec953d9d963fb7d2f2e75658e915383e3bb200bc8a005c8a000ef4004ef300dc84004ee700fc8b008ef5001c8c406e0b78d0d9d6475ac773846431d6e8a792f2306379e12a10fbd2d5796c66b8b8e1e72a0a0b2d4fdd4229169ea414254bfe1d40f86f02ccaf8353ccafe5b5e054f36bfe2dec59aa8dd0cf35f421cb665efa85c5d03a1c2d6fd273b497e5d23c7a875d42099448a77906f9990a87d04bc3690dbdc974aaa40de6615a4da3e87b9c8777d27ed68646d2db2c0ae7fa087a9806b178732d1d61dcdc8f1eba51050c4f9c3a4bddcb6e2095097e93994f91687923c5510f7a88de67f31c1bcd3dd4855e54ce377fa4fb9997e752144da36fe818f86bcbbbf22af3721a4ff3e965a6895eeadd661bba824e8b45e6e3e044a76118771c5d47f761d41e6c3b5fa75e42a95442fd60b8abe8727a929ee113d5639651cfa2a9e07d271d62cfb04fc521f19b6228172ab7a999c1128cd98a3a5257cc6c1c5d4433e936ba9f5e62c47c6c287b40ed70e67ac8c48f1edaa3ce02ba816ea10db81ac5a2593c1bc91ee6d7f15dfc5fcad3ea5e73176a7582c77f1d66f932fd838ed04f4c63ed5801bb816d66ff44303c979f147e93ccad94437d69288da5d9743dd5d00354475b21cd97f94004dbb345ad72443915dc411134063c5d4b1be80dda83758b61a93c8b7f2fd2c44de271f1b6f8053389556e44ddfd984501783c1fbfc330ff9958e7c574073d4a6b69136d013fbbe99ff4297d0daebbb2296c1e7b84bdc04eb0933c8db7e2c5fc4a7e2fafe55bf89722410c11c3c574b14c2c17af89f79568a55429571e5636299f686db543faf8e0aae057e62073b479bd7997f982f98af9bef92f7250243848a7363419b29e8e79cd87249fa597f0fb3a7d441fd327f4197d0dad2316c152586736800d6323d8543683ddc196b27bd8fdec1fec5deee4d13c9e0fe615fc52be88bfce778922d15dd42b394a07a54c19a34c51ae5216a91df03b50bd4d5dadae51d7aac7d4d35a8cb60627fcdb6772cf7c119c149c15fcdc749a51664bb3c09c6cfe82e8b225566f3c5d0a993c08993c01edf83b6da71df436a4f201b8fb8c3ea72f681f38fc994eb33896c0bcf84d616da05b83d8656c0ebb1eab783f7b903dce36b17ab695bdcade61bbd93fd97b6c2f3bc0be64dfb17fb1635cf024eee3e93c8f8fe393f87cfc2ee277f307f872fe26f46417dfcd3fe487f851e111ad04fc61fc168b9e08a49688b562b712af2442da8395ab956b20f12795edcacbca3f95af54523d6aac9aa1b651cbd55bd5edea4e6bce519a57cbd2aed06ed4166aabb47a5dd113f442fd06fd16fd41fd51fd0323ce4837561a2f6016392c892537fef629369abd06cffc7c56c916b3e12c922d619514c7f3e851653a1fa03cc497f25c6ebdbfa61529b5928aa7e90ec1b85ba91177b27b68233ceaeeb490f5a0d9ec2eacf46b6c1ab4ab0d2d17db4490f761300bec09d6954e885db0497b20ad4eac3deb4b03f8ebcabbeaceb18b7906bf907dac5ca83994d7e86efe8252ad745618643b17fed7cde2762aa47f8999e22076c5e54a0d76e43ca6d079bc3b1d07fd103ae46199bc1d95b0fe22895588892c19f3946df7c04a4ce6eb7909ed60f7f02922875dcb3ad02f14a40deaabf4803a54d9630e52369a7e945c6309630dfac11cd96da25a696d8e0afeca160b2f7f5964f1f3d84fca783e39f82c1bcc3af1af457b36935fc54e213ac88106bdc907f29e2c19b17d24faff1e3a749a7ea43ae56e71bbf985581b1cc2b752863a96de8345d36808dfc27ea6f749bee53b1feee85ef68c7c0b4d5c41c74435afe767d8affc577a849e85155ec7b3d9a73c4047b571ca7ef6f59551aca598089bc66915acf245e25fd4d33c004fef2a7397b98da560bf6c815dfa517d955f4977c15ebc048b721decd87868f3548a6073b103a2f0bb01baff13ec43229647850dbd02fb7439ece516d88b3db01a8770fd333a81bdfb007dca1955680f81f363f40ae6779219b4993ae0cc88c25e3a689e50de83ec9ea35b04a357f558ad87b2483e6fd67bd01ab30becfa15d49a96d126f689b29a5e5266283729a71bd46fe2ff054efcbf078f3b0bd1eecf8135fc5da83967a17df2e77024db70a23f573551e463e722eac3ff84673951f46aa258a78d388c93700991771151729bb3487da219cd6846339ad18c6634a319cd6846339ad18c6634a319cd6846339ad18c6634a319cd6846339ad18c6634a319cd6846339ad18c6634a319cd6846339ad18c6634a319ff1f21bf9f8654fc92209d8a9fe3ec794dafe7bf04bca42acf0b72eacaf38c920c4d7d9e8b5ac7b62fbc799e13c5678a07798e170f3c534c25487b4ee3a37d415a745a74263ee4ffcc7eda2fb69f0ea8748afcca76f927f0f1c157d806164f4eaa0eb4be55dcaa2f88104e832d11ccd01d9aa672e6d45e541dea62eaef7432072387c7c11df56c48c0e364fd9dabfd54409c9e75f5992919a83a78d473b06a3a951c3d58ec391a1d531453848fa2f605556c7a556c9aae697a97c2c22ee977b1b482d61b6b52fb0d8e5dc8e2bf7e6d95b8c9336ca4e4673866fd0f750bb9e850206f94638558a1af7029858e000f88518a6230bfd3efea428a6a3814c5e1f0118b43334d955f78e1d68d7c63b0516b6c3714c3211494416edce94062938b0c461e7d0b2f25cddc5e57d8599349172fdd1870563bb9730bbf8b042f0dc45640f4dcc3f379055756a07972a4b215d71c3c437e1565207a3bed265e4001aac0d2144750623d5fb37eaa374f4e7ffac13307078156cd1878f078d5c1e37907f33cf65a48441755e5832c56dbe5fdcdb3432fc6dab0aaaaaa8e2c4d4f133686b30e4a49c7d33ff4e1bf763ce3182b467452b7fc12dcf04b70c62f523a95445a4b4b3afb02ed463a2b22b9a18ce2a3b451ba42ba61b82008953b9c4e9fcb8873b90c95739f50e2845088490125e95a81c634c5e9727161380c4355b8e15284c77889f746a70a3ea15abc321037ceb5cbb5cf25f6b918b9562065ba14573d9bfa5c209245f27ad488dd2e760b5e2002a24208511ce14a149624ae91df54204571d433e378d5f41950088f948225077c5a1f31e74862713baf25104f71b1842515066948c4e253e97be68d5b82efb18eaced2cde65366b1b7c37f81e5f7a66babae5cc9bbcf0641f68e030e8cd23908c9b92697da0ad8327a839b1a3dc95b1a392af4cfd38765feae15867e7e4dda9bc289979502999c8c7781c633cda03d16c8c72bb5952b214924f704ecce0cc139f43ba47afd0f7eb8a7e7d7e6a20b53a55a4266f655544bc92b8a50c6c37e3052cc02a9860c529cc12c1258d95a1ea44d5c0a3b616d83ad05405aa30db34ccb24342427c5c14d7b5f4f42e1d3b141676ee9495959eceae9713e7c3576c9e3af26f35d7f47df5e50e553fac1c9b3fe2eebdea96f267e65cf9de753da39d3f172f1cdcb93736031d828654420e1abd19e8586254d218364619675c4af7d203ec01759be1f4187e6c922f98429ad64a55e25455610d7a823d9311b0d4c8968256cf6f08b83dea3875a52afc6a8dba5d15ea0bfc559812ce2b37e68b71828b7a7e5720daa3f8950a65a5a290e251f62b42d9ca3e81e55a245a90372fc90355385ee53d6a25bc472d61400f3c47cf5581f59afc16aecda460873a623a515e259461ba259e586843fbe04bc1df58db2d7c1ccb53b79c5aab8cc08c8f60c67d31e348363370bb50594c3f3e955fc797386e766ee69b8c2d919f38bfe74e3ff9999fa74576e55dd4a2c80146dfc85191938dcb5cd5eeabf599c6d58eb9ae69ee878d875c4ff227235fe7af393f14bbddc91ad71c9a53898c8fec23347d3b8f6c501adda52b2e5f44645c444424b4c3a5406b203f1ee1c2760aa98f4bca32b6226277c4fe08411105118188ea8869116a443dab7acead7fc721ecca0d2582892d6cbd54a980af9a310ff34b65aa8162ed6782902f40be9a4d631af6f0feba2896b885efe3ef91ad6455d3a71f3d5e75d4731482ad6ad03388560ad690925521da86441412e4cd3f6a0b7ac33d3ad3ebcdbd1ba2933ae9f25b865c9190795e952d7592df3e11888bf0b88b22bd5100a83fb288fb5d45d6f71cb0bc4a86a5c1c2c426241676e982ad2a3a07df9f1d9cca7a6eea9990d9fed65decc233d5bcbb981fbce8ded29efd5f61ad4f4fc05e1d6b7eabf4564a289ddab3a70297cfc959947c43ca4da94b72d41845687eea285c317d927ba7f4cfbe39f996eccdc96f247f9afc69f6892c574212cbeff8a138947fa8607fc7d379bfe4ff52606424758ba98c991c3329e9daa4cdf47cf2277c8ff7c3a443c9df651fc9891a9dc4da67a48a96517a34a334338365d4b38440726a0136f3b4d4dda9fb53d5d4b428b753b48d6dcb8fb5656de5772b75482ab1684e9c4dd3632c1a486de92e699b1de782121077e3238fc6d195380d8e41cfeb4546a0755a006dd30268981640abb4005ab8d39809f5cd5574bdb7af25f3b4f4b7e42deb795920396268744742053ecdbdddcdc9ed71fbdd056ed3adbaeb7949c0d9d10fe5ce7033c6646d6f6eefc44049e77189ac203190b82b715fa29298d4a1f44d6fde20b9a5f2061e3d3efd68954cce387ef434cc2e959c41317e701e971c950950eb083a3a1d6732938773224e6682adada219d3d974b9da1e16701611c0020e5087bdd29554c5320b0b3b768085d2742d3e2e312d2b5bd3d25b6575ee54d8a5507eef6a567a2b9c2cba7535419aaf2eecdbe0a1821ffef1ce8ee88eb9dee0e168a5e489610bfffee2cfef94c50ce83fb092b1e4bcbda5f9fdbaf79c5994c07ff3deb172d5ec82a9dfbc747eef61dd7af4297fe6e6fb37c5467b8b33daf528096ed5b5e40e19e775282bb9783284722df46721f427853605baa6a4b0dc884a5e29a6f029e25a7eadb8469dd6e2e69475f4345f23fe9efc744a1ddbc89f8fae6d119be7eccafb71c192282ac64df5bc55c095948d5dec66dbdccc2df32531d92e9d325809bb927137c35e3719cb4776305bca56b06dd882eede14e589f24789a8e4160919f27cf0ebc76001be4e6d3dd2f2808ecaf37fe0d1222cc48c7cb90a07ab66e023daf284eca36d065335c5125e4c06649aa86649e98504275ab1c4b2e04f756ffdab86b57a66ebfea8e00fceca7ec36a068e2d2b5bc06ada6e79e5a70f9e619dd6ef58d9a272f8bc5fa75e38f112f9dfd2cc35bf552badf32f95de0bdc97993258f48a181c37c03b20754eaadeddd9cddb2d65747c45cb052d9fa435093be95b3a14f52bfd2c7e7346e53a73e267c74c6ba9c40be86624672c2a32d9c563559e1829a218b9ddfe281617851473c666abae640829ca0d31d05056c360aee4776f8995ac16669125202f0d96ca5a7a32c89087cd3178635fb76089addfb14dd6519cfe904efed13ccb581dc56ff84084562616912dabc5519ee21d962182254a4beb12d237ead8211196c656324befb8921d3ce61d74dfb855ef30ffd10fa7cc64bed35d660e1fb478c8bc21d73d36b3bce781cf4cf6d01a9e79eac48c05533e9b30f38ee021486c36b4681ab4281127c3dec09d37c72cf1f1441f8bb9d57173e4c2a8a30e25d6f038129c22d548863fe58d4e8a8ff5c5f82b0d638967b1ef45c7a6a8b71d9f3abe32701238633cccc33dc2a3785a7a7cbd7d657ee7c8c88991d7e87362e6f86ed1eff53fee5815b955df66ec323e36763b3f711dd67f304eeabf193fc59d4a3dee4bc88bbe39868ff25dea7bcc29fc86779b9f2dc56155cf7f08244afb5fc178851433635a4c8bec58ddf1b621cd52664e274903f1492d3b55186c30dc5b4bdcbb2170d5a8e77d031d63b4ec089731cff1760befed5edec2cbbcbd29c193e04f10090b5af9336e449719b6dd39e656dc5fa7855518be1b3e674c3f2ef5b797fc9a27cdb68b9a1cb86da24d61e6b4907d94b40ec6cefe9e1b698460774a8e4a8b92d4421ac51601b46a212d630b69195b041a2a47cb9d029fa86a46310b6d100410d824b049d6d01ef3df75ce22871cc15964d8c4ca39ec9cc3ce4559b9f55145e1efe0c1e1846ed2ec6dd54595ea439d3b75294c93562c3364b27465ec99023677d45248b8fcd4431f068fcf5dc53abcfa4df024bbacb2f2f624b625da71d90df7e43df82073effb64cd373f7e3c696cac73d6ac453742838662e33d8e3d87088de981257e473f51e358e9d8ed38e6d01298577037770b78e886ea55bcea6a7d9de37565a7b653ff483bca8f8a434a64ba92aee63b0ab5427da43a4a5be058a62dd35769abf44322d2e0862087a8e5b5623b87abcd778b1ff80fc2e0980813384c88ab4c8363af334df3eb14274b6ac44a510b6f5cae4a625227512f3203510a224905ad7427ac15ce92fbeab4a1b07ef7215cc28152a3b3c1e0fe0e4387ebba797d688b4ecf83ef1a76264a8a3d27f2a637daa245565077d65d2719dd41dad3198e915024c316325f61f0404be6fb227840dd123c5d73ea1319c120c8535ec0ae4b625302cf397566c8ffcf5637dc4a8ca1f9532a0c91c4d9b39ecff4c3fa618f72880eb9bff388373d3b13767a3ff528cf453c1ff9babed3a53c195f676c723e87c030b18ff6a4f3c9482533b18bb34b64619c924919ceac48b1d7f991ebe328b1c6cdfeae3fed783a4accd5af75cff5883e4e787e4ec113bd5e98b98808b7c3e932e299d770b9fc116eb8736ee6f5fa93282e29895c1111de24674caeaa33d2dc1194e4710d8db03c81be9d6b22d80f116604f747ec8ae0ee88fc889208e18f981fc123ea7987408477e8e0249674477244629225d781a1a808bedaf4e9d81d47c31191347e216f2de406478584bc386ac70ed840fb23142a36fcc80d626f0fc33c56e72972c38b0371d65bb94890f59e22d6681be8a1e35b474815d67d0d19d689795227aebfe8c6fbd2fe163c705d6acf6e25cbdbf8732e081e50b2968c2e5f36afeb43679ee2172c4eee5272d9a81edb82e743efe7c172be85358c40acf56ca053ffa4dda9a7927e4b56de4a7a3399b7e6d9464e4c7652df98fe4915a91395394937271d4b7579a415f04803e0c916d035db9e481a28406162b6c31599a105720b3a6981be9db54059e775da2e8d8fd3966aeb345343b0e2d1fc5a85764c53b57a561e48f0a7b2d4b80c8ffc163f3f3c30415fa7b41e68992f78c3d34f5826280ff60bae8f84941f4416eba1b40e148fcf565959acd3d973b74be13c3690b98f3023b8297864d9a119a2c3ec0bab6a2ae65d38ab6206dbccb2d9b8e0994f83c1e0cd733e63e513af9df9e9d8198b262c256efe129ca2ec85343cd4924e056e1f18d92fa64f4259eac418b593abafbbc23f31669aff7e7ad0fda067353de9dee4de10f306ed8cdae9f9d6edb9cd7d9b8767383312b881bdee8e9d18bddbaff2e82837e3292c2a2e222a9a0b0fc3f9eba1388f9caa9602658c835187d1f666acc381c20d29b3a58669f071862c10f62950614c93a7002b7fdeef670b709c583bdf6def7c0f79d86e9c591ebf67018ead245f3d5bb67e64c8959c31107bdf532545383d6fc6d1ff3ca21b9dd03b2cc59c6e2b6458c73c08615b658b73ce6818ad6ce6491c75ffa8a7de5ab7ec9df7a7ce0c1e60fbe60eedbb70d48cd143170f50b22eefd7e39b83c103af3dbdf6ccc762ccbc5b2efd61e2ecf9577f256d46299190fae6a60381aa4c9ee9ece4d8293e8df83e421b2a6040b488c4884cca8acc8fee1259ae8f728d8bbe529fa62d66afd3cec89dee8f22bf8d8c891409fc41fdbe286584be4ce79c8bc828a67187c223595494df4d716ef8336ea7a39e3d1b702872bbe35894875a20eabcce151af3684c2a20d7a42b1eedd759b5be40e7fa1deba259749494e980e707c387bcc3e34670b699258482b3834765f83fe3a0a58c0ddb3d2cc8224b8e528a86f4736620e29a6149111e8e6ec94cee4f3f8bc85bb6ae47df2bb2db0c7860646e1fb931dffdd677246ada0b6f0537403a6db11b2f8374dab0bacd946eee0f3870b67afdf8c8acc7d1e9284a0709dce62af2b4f3b72b68176857d14e754619ad0b5d7d2366a77f1ab927f350a4a1a7ab9909e9b19919997d9c65e93a6493bcbb9df0b7ebd4aa30b3ac55dfcc40bb2aba206a787c45c2d0c45119c3b3c6b5a968373b6f51def2a835f12bf356b6a96df756fc5b09dbf376b4f92d39c5feef15fc69add23332b322e3724961893e2f737b7dde71de2b7116ca6029262635370e079215dcae64db99c2ea456ac01da3e4e6babcbdf3134b12075bb794c66e34327667b36cb91ad9aece94edc9f667176407b2d5ec3bdaf97a7b58463e311988f10a5a47bbe807522ce73e6230b68e67b787fba1e9f5ec890d6d4b6df7667ae8be947472f2ace839ece528b65552425e8e12f27224ad83d762c742584d3b7a7e4e61718c5355a5d53a10972a4d5caa747452a59d4b0d3434c17845d69649b41c9ce9345dfa37f2526c6682657c3a77cacecacec8ce0a39280809b2a50620d24a90bf08bbe0fcb6650999578cbba87bebf884f1c1d33dc65f7823e3efbc971afc353e3f3066cce09ca49bdfeb7b49f0db6f4eb1d66d46f76fd332af4562827f648741d75d77c1fc650bda756b915d9c9d93ecc939affbb0abeffbe269e8ce72f35be15797e1347e3bf0f360b154ec13f8c712157697718feb53455cabdca42c346e4a521873eb858a88148f88d7c56bcac7e2a0a2e588f96289109ceb8a2abf4550d71c9a378127a8d15ab4eef124441f32f67bbe4b3aa645ef4bd9cf0e2a0734659ffeb1b12ffae3246587b6c3f33efb50519e37b645ef603b15e5096395e349ef1349b5ec055d5b10bd20e56e6599b1ccb152d1467be738e67a17680bf4051ead555299d2d7315a8c7654c66bad8c2c87df9311dd363ecbabc13208bfe257d3b43470e27229de840491241248371417e9aae2c29e17090cd794286754b42756d4f37e81d68ae252840b4e711ceaeb6e622624938d681656f21874273bd615fd76ad5422f8d491dadb3a7c265367b5709b5ee06311851a300a0e177b7b05da754c922622de955193509bb03d41d8fef6f684e3096ac2167e3e25b378e9645937480f1e9f71d073f01acfbfa18edefce3c7a71fc47125a37444eec58ba3ecfb37e4cd97c163519efc70e367b17410a44f70ae4b20e378b81696df1cdba563974cd1514f17a1c34db763a72eb1cbdbdc96cefa0f5cd7a6b62a29b74becf96d070cba7f4966a518b267cd6bc19a3dc15e73a3d332f53deeab27b55fcfd6ca6f42877539ae6481ef018139dcf01475779c1737d03130ee09558d7546bbb8e1f55292378772bcfed47ede69a92b5377a73a299539c9c90cb7e149e25e4f527266446674d7e47ec923a286474f8c9c187549f46c7e75d455d18ba277a8af7b5e4bfc90ef4bf828f9582a6c476c4c6c5c8c5b28aaf0c4eaf1b151ee98e897cc93140528e6cfe4358f054aa37174b96360b56398a2f8bd140726082aead1a2639c7a6ebccb9b92e38e21af277af6fc985d31dc175312333846a0ba3f667ecc0f3122a61e315f9a92415e56e35de9adf56ef7eef6aa7e6f81977b1d3189de446f8a73c84869c58bb14bf3b140cc76dd6cc72dcfb39da429b77d37ac947af61e26eb8a1fb958d6299958b4d8f0ecc041197240a489cf83936c2f4c0fdea5b04b2cdce52ea10562ed98ef466fefce590306f548894db84cbacfc75bd6eeba71592b25ebccadd353db95b6e87e7e8f7693d8c9539fd43cbdecba2e4f60e2e6fbf0aabfc12ab97861e0e398e158b7481990c66ab1ba3fb222b23ad2700a5575b90a22039163690c1b678c768c74398b453fd14f9b48978a25b482968bbb35476bd15669ab66e919465ba73fb290178a42a3d05110594efd593f3e48942be5ea40ad9f3ec8514917884ac7149acc2e12d5ca25dac5aeab95398e6b9cb35d37d38d6cb16305ddc3ee77dcef7cc85513f98d6823346c3ea1c0eb54758ea3cde174184e15d6835cc45c8ac3e104d72e1ce70e4435ccd075555534a7cbc5e4039c83da4227736ee16330c3be01a7bc3376502cb46e8d8d798e2f3418e2dd3181886a7da55eab6fd7f7ebaa5ecfb3376987c54295a95bd14ee10348b0b702ad7c9cb9b98f8fe3c2c7fd2057f2f97c295fc7b7f15d7c1fff81bbf816e86e44689b6227ce3878fc6895e70c8e892a8f4c54c9ac748b3cd6d30cf909bbae1b9e62a378b1fcfcdb0eb9e4a1cc8ec5e1bbda1b29e049ec6439150e2428c7e196b9bd75a0f631215544c652d8c3d6cdb8689727a648004a40d2d82254dfbdc955447e97e5e96f8a2e124674915a6feeaf8b2ea27af3cbba18497e420ec1f05e79ddeb91d7b7079cee2297d78dbcdb0e0b42dfcc2befe25a41024b63d63d767cf2eec17f0757b223c19f58fb075924ab0ac6b288e02e961bfc1012d382ff64f9673e0e32fa5f442545460d0a656e6473747265616d0d656e646f626a0d31392030206f626a0d3c3c2f42617365466f6e74202f564d424351562b417269616c4d54202f44657363656e64616e74466f6e7473205b3231203020525d202f456e636f64696e67202f4964656e746974792d48202f53756274797065202f5479706530202f546f556e69636f646520323020302052202f54797065202f466f6e743e3e0d656e646f626a0d32302030206f626a0d3c3c2f46696c746572202f466c6174654465636f6465202f4c656e677468203439393e3e0d0a73747265616d0d0a789c5d94cb8adb301486f7790a2da78bc1968f8e34032190491ac8a2179af6011c5b490d8d6d1c6791b7afa26f98420d097c48f27f41c7c566bfddf7dd6c8aefd3d01ce26c4e5ddf4ef13adca6269a633c77fdc256a6ed9af99df27f73a9c745910e1feed7395ef6fd6930cb65f123ad5de7e96e9ed6ed708c9f4cf16d6ae3d4f567f3f46b73487cb88de39f7889fd6ccad5cab4f1945ef3a51ebfd697688a7cea79dfa6e56ebe3fa723ff76fcbc8fd154992d569aa18dd7b16ee254f7e7b85896e95999e52e3dab45ecdbffd6bd70ec786a7ed753de2e697b5956e52a934215142007bd421e7a835ea00df40a6da135b48336996c096d210b7d862a6807e14c70661d64217c0a3ead8704c2b5e0dabe400a9141c860d75080482424b2241212591209892af41c7a157a0ebd0a058742858243a142c1a19042677acb24f4e2e845e8c5d18bd08ba317a117a517a109a509c199e24c70a638139c29ce04678a33c199e24cc8ae647734ef69dea1e7d173e879f41c7a1e3d47f39ee61dea1e7587ba47dda1ee5177a8fb77755af2b4e4b84b9ebba474e6e94ce9ccd399d299a733a5b340674a8640062543208392219041c910c8a0b80eb8565c075c2bae03ae95fb12f27db1552659fb3c92efb3f718cef405311f93dfdca6290d7dfecce4697fcc79d7c78f2fd1388c269d7afcfe0213d218720d0a656e6473747265616d0d656e646f626a0d32312030206f626a0d3c3c2f42617365466f6e74202f564d424351562b417269616c4d54202f43494453797374656d496e666f20323620302052202f434944546f4749444d6170202f4964656e74697479202f445720373530202f466f6e7444657363726970746f7220323220302052202f53756274797065202f434944466f6e745479706532202f54797065202f466f6e74202f57205b33205b3237375d2035205b3335345d2037205b3535365d2039205b3636365d20313120313220333333203133205b3338395d203135205b323737203333335d2031372031382032373720313920323820353536203239205b3237375d20333820333920373232203431205b36313020373737203732325d203436205b3636365d203438205b3833332037323220373737203636365d203533205b37323220363636203631305d203537205b363636203934335d2035392036302036363620363820363920353536203730205b3530302035353620353536203237372035353620353536203232325d203738205b35303020323232203833332035353620353536203535365d203835205b3333332035303020323737203535365d203930205b3732322035303020353030203530305d20333031205b3739375d5d3e3e0d656e646f626a0d32322030206f626a0d3c3c2f417363656e742031303339202f417667576964746820343431202f43617048656967687420373136202f44657363656e74202d333234202f466c616773203332202f466f6e7442426f78205b2d363634202d333234203230303020313033395d202f466f6e7446616d696c792028417269616c29202f466f6e7446696c653220323320302052202f466f6e744e616d65202f564d424351562b417269616c4d54202f466f6e7453747265746368202f4e6f726d616c202f466f6e7457656967687420343030202f4974616c6963416e676c652030202f4d617857696474682032303030202f4d697373696e67576964746820373530202f5374656d56203536202f54797065202f466f6e7444657363726970746f72202f58486569676874203531383e3e0d656e646f626a0d32332030206f626a0d3c3c2f46696c746572202f466c6174654465636f6465202f4c656e677468203334393634202f4c656e677468312037393130383e3e0d0a73747265616d0d0a789cecbd09785445d6067caaeed24bba93cebe271d9a84a5814002844024cd16046427214122fb0eb204374409b21a1151470671c31d50b4130284653e187574640675dc66dc517117751c64dcc8fddfaa7b6f0871c199effb9fff79fe27e9bcf754d5adf5d4a9734ed5bd9d10232217559342be454b662cbab7eee34f89c6b625f2e42e9872e5a2c41b5d8f23c7b7807ffec269535c83436d88663c45543279f682a55796cdde8f5b2c09f109b367cf9812939f3209092f036d119dfed9b0b26308df09f49c35ffaa9943afdd3482e851d4bffeed998b662de8f560429068f052a288f0b4cb97fa771d7e6723d1a47144faa524fae64045ef3ef2e0a4a8a26f9ca94e123ff7bddfaea3a0afae3ef1f9f78f9f99e523e768390a264b90b83afa368ea0013efafef1ef97f9c84a6ffa89de2c52a27fcff750111d451b9c7c14a2b5445aa2f63969c475ab082f6c4298ff9d2e51ab281e18e248a72bb4322a67eb6802df49cb0594740aa98fd212e4dd89783fd003a22cf29702ef004540199062a50d07a60063451c79f78bb2a86391a847d22a9ae0cca4855a997106ed6dd69ea199c0dd08dfa7be4fdbf5425a80f803287758252a10795066b3be93b620fd4edc9f86b4bb41cb11bf17e18928d7d50abb1c3752b2a0808ef40ea8e7066bbced943f524fb5ca781763a9409d4381b56863146809300c796241fb03ebd833b49e3d63dc87fba0b40aedaf13e9c0408b5e887ad6e07e31cab5457c15c229e8870e1a056401edf9a354c8e3e810682ec63fde1c37f00ccd16636e1a13fa6ff5e9a730fb38ac39d0e61f80002f343e007535eb5b4bac6a81214a3e5583ce035281d1fc182d502f22067eddae7d408a002453f0e96de002753a8d409ca19f63b57ada2ae2c070892ae38c7a276d534e512fdc5ba66fc638a683dfdd80d394cb3fa7ce7a36ad807c0d44fd2b81bb51e7c7521ea6d338b4df05345ffd40cad05a6003dafad2e693e00de22b31af63d0d68f62c5a0fc586030e6a51a982ffa83f67305cfc5bcb3b2c642e43d813c1305909e2881b10b9914654479d4956dc9e17d6729dd873c3782afc74155205ef4c18694330bb8f734ea490674201de8027c00dc07cc037a03c380f6689bd0ae22e51532236453ca0764437b063c44dfa4cc9a63b85bcea7b966eeb5ea12ed64e98fd23c0b59a24eb15e84cca22fb576dd624d0999b1a994ef7952eebf10e31432d544b1f6d4cf68b0e8835c83902d9b8a75873e8bf5b09997d27a491fa555426645ff6c2af822644df2046bc2a245cdc6da55ae1150852860c9fa2a9bdabc68a2b3e901d439599f0a9db28d2e5497d285cacd3455fd8a062a1da88bd61569180ff286f96734c67984f231972311bfbd05dd22e07885cdd58e609c8f809fafd05de0e962f515de467d8569da23c6271ab167b547f8b532fc13da12ec88794f5081e6f7fed3f4ff06fc55ed11e8cc478c4fb5570c03e3b945ac09c767ac2be0b729d2eb806aa0a333c8b638e7b1064729f974a253c0423544bdb51015a847303ff1d0f3580b482fd5dea5c3ca8d98eb578cd758355573d4e188a7297c33741adae2afd22a01513fe8a26672748eccb594259bdaf2da920a9d6fc95426a88ef5f79c8513164e03df408e86412693856d10fa59da07e86860ad25af739be4f3597a10f4065b3e5bc8e9dc16f2e96929972da9b42dd0eff63a455bd7dbe317fa51e838a123859e137ac6cedf92362b5fc377428e851e3e4613ac75ddc6c250f4f13d6bed430f63bec71b865e623cacd71bdb951863bb9e87f03f00cd7818bcb8b2c9a6961b8d963ded60db52339d226c3baae5d3024b9f3d20f5cdd7f43b6947cb64ff5cfae3b442fb01f30e1d28fbbbcd5a83e027fa3d4f9d0c9e6fa50d1847b2b20eeb11e9c044c11339174449c22e089ba8dc063e0b5b7423ad52de80bf20cae653b4b417c5341e7d7f56a6c1a60a2ad2b4f1749ffe19e5a9a5d0b54768ba982b310ed11f31f7cecbc8eb8c879e7885baa93b90279edcc8b74df220440f4bb91065e7c107022f1cd3c801991d813ca2be7b659910c558fc7840f24296872f226458f00275eaf13446fa139fd13d5a298dc71abad7514df7eaa55873f1b41d753c887243455f502e45daebdbe862acaff5d04deba17348caff04e307e5118ce74ae87540a9068f1ea124ad1a3c9c27c73e503575ec3ab17e949d94236444bf0d7a58f813b7518d1aa441fa3cba1169376ad09368f706a4adc6fa0d62ed5e8ff29996de26b47d3dd245d962e1cb081f41ac17478862f56ae90790ec83f053d0bef209ddab0ca5f590e37ecedbc08735d4997ed38ff1a849191c4ce339c547d78016f07c7a112d44202c6ce87e7525cd51cb284fe986b51b4d9dd5bf61ad7e4777285134493d4a77a80db441c4d5586aaf8431fe7af89622fd791a25d2f98b886fa1096a11caafa74bd54954a5d442f65e26b73a13738d72da46c8495b94ff1af55a60efd304a50c6b6b2dc2dfc10e229f6ca3de1822a05e489d65b966907db5d1a2cf7c18463514738afe8af039fd455f9bfa69f7f167fa27c729ea45399147bd035e3b196f02d9266d1ccd6fa447806dfc751aa00ca7abd876e300985cd20217368fab3dd872a08bda83f6012b11ee04fa3fc0e3661cbe5b0f7a035883ba8f80ee16fb0201de9f7a0a8ab4bb812dc05fec7bcd21daf9b9f4e6d0528d03e7c4f7c0d600ec947140a0657ef0b927daeba95e601c10802c0e15d057509ce3728a53da213d03e55ac4b554aca73dd45621e3dfe7ebd3af013fdd9af131d47c8cf67c8026fc06bcd98cfa05b56cc37fddb7ff1698df68a0abe4ef17146fca10c5b2578dbf8396b157295ab90c320820de05f1589b9ff63c21fd5699de62fe787fa351f0bc657acb78cb793d5f9cefa649cd61cb41933cdc427d05d462e4075ac69dcf525f01fd4fb8f7a79fc6d587cf8309d451d92afa04196cf7d3b83e92da09f0b6e86b8a2883350734c59f878e00445e59de4b8305c4da15e0f5d8af014df77bd02081b37ca59e82afca56f3be3d3ff6bcb49c1ff4af9bfa1cf5036d07da1b742ce8509b365fb32dd76dcb345b97fc5c9e166ba3db2fd5f9ff2760ed1c059e019efe7fbb2d469055c007e86fc20f29861ff90afc938b6915d119e8921f738187a087c681fe1d69b0de8d1d002fc2d1489b057a17d10fdf20bc04e9af9830b89a4adb2cbf3219697badb24eabbeb166f91ffe4cf4fd29e071b3fc0f3b81b908ff13803dffe12dd03f826e41fe4f516e35e813e6fd339310bf1c3884f86788cf07ca11de041a0fda09880562507eb380f0477eb20ffd3fa73fbffff8ad143ecb34f433539c79812e6fb987f8cdd49ecff3d0967b0d7bfecf479b9d19b4a0261fb0677a0f7e5fb8f9dee7d7f63836c57c3636875a6a9c814fe9117eb4f06585ff2cfd478bcafd9bf463d12e519c4d85ef2cfc57e13b0bff15f45e7966a0c9fe948a7dbeec9765379aeb56768aee067c40aa45e721cf77bc9df11c744f14e4fb1bec8d1e10401c324665268ce761bba260eb0e43ef7e037a0cf174d06f6c9b66ebd69fe8d8f3d8b4ffebf87f6a23ff0b9b9a6761520bfc52ba8d5e168608b4b4c5ff29ce67bbff6b5bfe0b36bab99dfedfc66d3b6fc3d597f2041c21e380404bbff4277ec079e2e7f373ffd3784bbfe33f8eb7f04bec784bfce47e4bd9b3fd99144a69428b75f79f42ec2dd43d677d7fbb0f2dd771d37ab3e2e0d1a0e6801e686fd9d0fb807f4167a403b051c62d885febfc91f29cbb280ff1f500eca2510c4c17f7407bb21bc5f9b67106f1eb10f7a9c764de720bd3cf27cf2de556f8e7d23f04cfa41edc24fa4fb9401f2006a80516d8732df69068fb3887d515fb5c7582f18dfa1cd0c2073c2fed418b815d8847211e055d1ca747436f87e861711e0fea067543bf8f3e7bc6679cd197c93c43e5d9f252ba107afe52f51571f6653c25cff41a29cae191cf5156c18666dae77488c78bb321875f9c97180dd6f9dc64fd6bd8c1f1b0872e613bd06e997c26344f15e7b85fd3ef94081a689d21c7d967c9e27c4ad82bbd0bf9e43946f373e4f7e11b4fa48140b16a3ea72a15e72fca07f259cd3a71eeae8ca043d6f3adb07b27dded7a86ee764ea712e70af9bc69b37227ad42da9d8e8d74a71e94cf574a6dbb2a6ce2cf9cfd89b3cc94a6334d6bcc2d7d02d9bf897491388f69deae5dce59025bfab53c8732cf31cfe3dbc0c6d700d3cde715c6e99f3fef34fe6a9d7bceb66cfce54d36bfe539fd441aad5c8b7d9f7d26fb10e8ab7489ba16b078dcb22f765be0cb995ff2856cdf04e1f1f2accf7cde23cea0629b3d872b917cfe44ced71031679a176b384accbfb15f359fcff557af447e4ec9ea978079f6289fcf89b361603c7f0df9efc61abd146b0532a8de2a9fe1adb680bcc643b2dc7cf3b9993e162846bf66a2dc4ef1ecc806ad390be3845a4a3512f25ccdb88fc719fb4197f0bfc8678c51d6b3c06475038d93679a679f0926a9ede5b9757b751c80f907ae42bcad1cbb4525af4228174543e418c5d95c1722dc732a7dac33522baf631f95384290d7082ad176535b6521fc9723d0756998bba198d7285aa5bc47196a2f9aa644d3740156623cc73e0385a72ec03f45fa6ba037232e9efdfe9d2eb19fab99e7d3f483c451f80a80f52c57608600dfc9b2ace784155638dd0c23ad90f64ad875eca4879a01f98cf7801ff8efd0767f9ace1bd0c636f405ed283eacbf164099a916da5bed0c56c7638d9d8b012d81b282e6b604d205cd6e092b3da525902e68ff96407aff9fe9c72fe5fba57efc527a4e4b203de7ffa01fbf546fa025901ef895fe0d6b09a40ffb0ffaf14b7c6edb12486ffb2bfd18d112481fd1b21fd04fd8c7363e8dbde9a3a0ffb0ecfd27a0178142fa1a9f12e7d8c04c2bfe0f2bdfef01ec7f8ddb01ec958dfe16a0f30cb1075e07fa39807db531fa2c1a9f054d33cfc8ed768c5b818e4099d99628db78d06c5bc26ab371b759fecc2ed03fb78827001f9aedc9b685ee3d001a00b65ae35b6fb51b36fbde78ebd9fc8d69e61865b9f059180a3006e53341c79e45e31e13c693a08f01e25cf419ab5f229c61f1438c799fa8ebac5ea0efd5add019938960abe31c3b4daa5e4d17499dfbfc39b66a91d487efd376a9ef0ce8be22cad3bdf043eea2fec26f103a5c9b21f3dfa04d876d22f827f015a4bf709c34f54f94ac7d4093d44b69a0b2177ef160e85bb4219fcba06ea1b785cfa15c4fc301f9ac523e1312cf4eaea475ee7ae9bff890274efd08fdbd9d0e63cfb65e2b2786f2baa30be29b60d7efa52bb5ab699973011dd6bf12cf4c6926ec55a63e890ab5ebe8427b6fab2f2097e6815f6051e7169ae6e884f49de4573fa434d73af8752fd028f0acc06ebbe9d9bd83e290fe9079be22e50ff831085c24fb8cfec20f53b1b78eb3df1bd02ac193e9b23f23e433a71da4628f4eda97b0dd43a8bdc305df2b97d6bb92689b7e1ae3d0e1a706e573f99916efbb8ae74f8e59d44d5b4739f6de5d3f013e8f23b74dc5f338fb3c00bedbbdea6ce92fc6c8e75ad6794013b5eb10cfdbaa69837857a2a55f63fb514d3e857546d074e6608f0754d8cfa6f15bb499bf619e291c817f1a4f41f11c4f9e89b4a4569fe473bc239025cb9f751ca6a10e05f4219aa9afa5b1da70f02596c63a9ea418c7604a12fe99c321fdba05c2466bdfc1171d4b39989b0100f614c65cf3b9985161ad7171e6f677602216e325569a38abc09c1b11482fb5cae2be7199b9cf9079c4f3b31a2b3cc0c274338f287be62d2bffae666735ef9890fb107f733fd57a976aed4fe8d967f7427e4ace4b7fe3199a58c3e29daa9f79c6df92de0a3adb8ec3cf7b076bf41694f503baed47b7a4aaf9bcff5a934adf50d0072d7abf9035e1ebb5a42ddf5ff9a5f7597ec58f35d7994dcf7defc5a6975834a7e9bd9cf3d0e6efc99ca58661c5237febd99d75e69662d39f79ffc03c933b4bf59fec9f9a533927a4587eacf0df87cae7fce2dd9c5f41d33b5cd74106ce459980789fe0e7a0c3920838e69f0bcbcfff45e837a11ce0cc6c09e35f02e8f34a13c61d163eb3709f80c2b09706d49b5bc2f897c4cfbf5f3750bf0bed02cece261ccf9a90feffaf003c20072ca93346525dd8c25f05bc0c01c797166eb061180236df6d3eda7cc1d83ec4b86737f5d96edfaaf77f3b8fffdb79f9bf1af7aff5bd39ac77f46c2adeddd37fb6df981f897f9990efd2eca4580b3af87a107804386ae15601ac9514f1ae923203f23443beafd854e627727023f6a60256dc7aff46d7e1d93992cc7520defd3141153fc71fc70c53fe1ced4c3ec9f7764cdfeb038cc36bbd633bd3d27d6d5da3e85eeb3dd94ca15b6077c53aefaafe91669eebf31963cdfdb4711feca486fcd1da522ae17f31eed79641277c65fc595b015f00405bab2d3c6b619be9fb198f5bef41eaf27de09db4a339b0b7cd1010794c3b693c68f9dbc28f5d62a2f12333fd6cbf6cddab7c8b71fc40c9f2fdd290dc5f8f52e7604f3f879295cf701ffe8278dea44ca17ec266283de15b89776eaeb4de9715670f6f839af0822fa394edcdd6b778bf46bc5703c87772c43c3d0d1b20f23f2dcbdbfbfbf6f27c691ef4f81b9429dffdc13df94e0fea10ef3a09bf48c18e421b09b9188dbca38dbf295b402fb4f02d7029fa5b4673f86aeaacccc47ef805f83bf1485f0c2c443809340aa800ee042ea76e32fd07c8c9f7c80f282ae27f05d5b0b7d790f69d850d26c47db9dfde4bd3e1134f477d66be576419133a4d674fc8b6a62bfd511ff271ec941478144abc15d6717f0dca1d36f7efe25c41e497f7ec3caeb3791cd750897b269528ab4073e147f4330eb04fa8489d40d198532fd00373fd9cb57f10fba6e70170cbb81bf1a3bce57b01f673728b6abb688e760175d6cec03f781372709c8ab4d37487564cedf551b0638fd292e66f2e89f789e5bbc4af18cfd967df36f4728a77fd8906630e49bcbf6153fe0820de762a95f648be4bcfb0dba247cc3ae5fbd3e65a937eae6320adc23a2e012eb4defb9e693e1f830f8ab5a79aefa9b6571fa474d4c4cd3d5423b86588f53016baa1e9ec5550f14e9b902dcb17143ee6a3fc45b1af455f528c037c146558652f36f7a58638affe1d20ce2cef6cf6fc69b3c0ffd7cfb7788be750bff4bce87cef669cef5d8d9fc4ffc3672a2ddfdd38dfbb1ce78db778e672bee7659055e12397c0ae1cd6771aaf20be0fb819faf50101950c439e8f9afedaf54a04d6f652ec4187505beb4c549c9366407f65a81be499fe5ab33e8a856eea6f9ecd1b3f5adf7390e7a9e26c4ef8a54a92fc1e448af5bd0651ff50ebfc567e6fa2e99cb63b950a5d2b74aab419e2dd6eecd3a06fa60bddc29fa57cfea3a983d82b122474913c97ec8f3ef697548679474ba7f42717cfc7586e35a14419cf4a9d1469ea2c85505f83d067b0bfa6be4a57524cfdc55f3675107f1b796c9c023e15cf6ac47e5aeea9c5de6c87b44ddf9b7a52ea42710e89b0fc3e8ab97f8a126b507c0fe67cfe92e55b3ed2821eb4e9f9fc42abcc2356999fe6b79eddc096c44a9bfc0c7510eff636edbb88f2e5bbd11fcafdca85b82f7c90b37ebe7dde2ee70973643edb672df705e2798e985b7b4f6f9e9b35bedc8c4e3221edb4e0e347f0cbdcb0bb17c936a0e3e4f39e2ae394d54fb13f49869cded0b4f7b3f772f65e83a88f7a373da0cc822fd455bc9324edfda166fbdb0704e43b24cfd283f25d6650a41d43be0b4dbb216dc89f801780bf015f00af9ae754675e13df1d127c69da0fdd23de1f68dcafbd097e3d4d2ee74594ac1f30fd15a59a9688737101f1bd0201f9dd291b3bc57b35f25da83ed67b84625f3fd0a2d0b93444eaf92af97c63a21203ff6014e4a4842e40bc1bc217a8d7c0576f279f5395a957c9efc4942ac9e0c3d9ef57e58934f55ae4cb95eff78e55afa652ed4f34577b89a669dfd243aea1f410e89d0aa73e5a3ff3fb13ea122a11fb34f815ebb81bfbb52a1a01fb1009df678de88bec0ff28b7b72dd2e864dbb9eb6a84fe2de47a00b0127ec582ee25fd116f6296d51aa304fc8a31c92ef4d6f513f07ed86fb0b2cfa06d216403ff890ef2dba599d4d4ebd023a672139d5f9402465ead85341cf4c441dbd50a69b6ce723d8c4276993ecc3cf41f469a1d5270bec53e314fab411742ff0badd979690fd680ed18f967537c747567f5ab4272078d11c822fead7d405ed6f06fe00bc8c3ef505d66903cee5577388be36e19b73fb2d796843f0b225046f6d445a7cfe1908be37871cf7fcb3f3d004f040cc899c0b4b0694c7d0b6088b718b3c5f997d143220656402717bfe219317c97e7f28fbbb45cda6b9b26f68472b812ec0dc831722cf98a63a4d79da28cb897cb827e750f44df0f971ea20fbf08c94ada1a25d715ff0533f4551fa5ee4791d6d2420cf340ac8b645dd6bcdfec9b273a0c350973e0ef73361ab3e409a4082794ff6df1a5753dfc5fc8bbea34ecd6bf61dbee416acd18bf4f6a82b03f997c3af1432520a3c4d25fae372ae6294006d813e68d3fcfb5a40a29526be1b3604e808e45b7141dbc875fc5b21d6fb6fc5b7522734c79de783d0072d90d7324d4d301e6d1e17fa0318c1e7803e28c38ef3d5237494d04fe703ecd8c3b6fe6ad986d06502f001229bf45a736ca3f1cdf82f792fde85564fd25d027a047c9a57688df63eade139d0eb39a837873a0119c034a02b900aa45be860ddcbb1e24ea0bd673395447a840d300e44be28a9f0bdb1a20cec638c3bcee703b7f4f56c1fb0653ef8894fb2578d49a09f80aef9a5775d7e29def25d9a96efc49caf5f3ff1495bbed7546f1cd7c838ae6e363e564f181f3b26c2277c9df21c91a0b15418b14f3e8bea049efc88c03ca04ad096fdfcadeffdffd6718bf704a54f71ccdc73897dbc7c66f0a8e57f54d104ec4bc57eff5ac4d31d8f518c1e4f49fa08ba5bfb1f5ae7d8412efdf5a67758d63a3790d7114b49ae48d8d9e7ac671cd8e76bf7c3ff5a28cf4a63e5778985ffdd860e2bb990cd03d02b4be14b55c0aedc416eb93f14fbc137e1c36c12df1135c459cd40e13b8967f4c26fb5bedb2cbec33c472fa29d1165c613cea1464c8487f2206703cfd9b3be4a9c6d97eff297986994c247631fb69d3a344bbbd0a21d2c6aa75f2ae94fdeb734bee35de846f9dee5edd82b1c96fb78e18b44c1878e1550db19ff16103cff35a8d5d45640f90073d82c7cdefd628b77f4cffb0efe79deb93fef1ad987b52760af937954220019ca30fd4b41e579d448d0ef40f798cf4b8dc12dc2643eb713549e65b505c65bb8a50572cde7434677a09beddf8bbd7df3ef1e89ef0e597bfe8ef6f783d481f0112f005ad241cdc2823fc8afb4831eec4a716c1975411d978b330eed53c8df5f81035402592f91e147e13ffc19f428e47b293d20ef0da207d5427ad031831e844cdf0199bd033ab4487b886a64b9ad7487ee42998374b3b6d3f85cbb1d6b4bd4b585d6e9e391ef63dc4fb7da82bed406c3d75980f03c9aa3fa5167128dd2aea15e3af67c7a32fadb8df6ca77502e36ae625b8d7b792665b2d78d7a358dfaeb3be83af895ebd4fbe147ef005d00cca20b952f4191ae8db7ee218c3de13a7d17e2e3115f60de87bf5222c357d246c4af634f18f7ab0b8ca79487b03fc27dfe34f9641b019aa4ae9265447bd7e90f59ed2ea6fee0e53a199f657cab2ec278fe8531d6cbb5bf9f6fa1364e4ef305b417a8c4f90a5d27f1824923e251ae8ad29c67bf4337bce53a6097d0adf69948cb77077f7236d11fe56ea5deb6dd10ef1488ef486acf1847d479c6fdeefb899c1ba14f4aa17bd6805afb391de9fa50f8382514abeb26d461d8537e4dc5fac51867cb339616fa5eeccd30de05ec519a007a31e8087b5f87babb6a1ad6f93cec9b04b2208702b5169ca66febea6b9c715c04ba12b482863a3b8066d250c76ee8c6e33fa5f20c8c281dba31463c8b6ff64cd08cf7a0cdfc6af9fdc618c88faec3ca40879243873fd49306ba3fa3698ebbe433bc18e489d6efa538ed0ef0f34ae8e46580bd377c95cab51f20330f517be542f8ce0fcb755464ee8d8d13f6de519d4e45cabfa0e3ccfa74bb5e35167a7f20ad5336d128015501ef05aec13e0ee077a1aeb990f3276895a31632bb589cb7d01a9d6017a640373e27fb22be4f3a44b9800ecbbf35d180bda0c03d724f3844fe5d8a99589747d18e9547cb697a96fb80b291e2f400dd89395b0759f85e9c1159efd9add36763dccb2843eb23cf3063b509b035f990e37da0d341ad38fa9081fce26c40bcb7196f7dc75550e1c7c65bcf2e7b414fc4c9efd78aef335c25df4550e5beb71b156befc1f717f3b4953638759a2a9f5bb4a70265337cf074f821e2cce97dba04792a845d14ef15b8aea644759bf1a5a33b6ce24bd01155c677d63b07f26f74f0af117e1abaec2be3b48ef1a91badbfcf311579a7620edfa75bc5df8c00c64960ce05d41990c537a49fbe46d5698db2033cd02843f90be6f076f1acc03ab7aaa264eb99f13ab917ccc79c7e6c9c568f00af88733023417d05a0c68fc5998af0e7c53916f46b06fb01f58d41bd4fd17add4febd1fe6cc8b6a8b354ec73242fc4fbabbff12c5589c77a8b3feb17fec45f3a9f4d6c71f6085b538bb50bf563f435df036a14ef1888f797f3019f8933ab897e5c0b88ef20cd409e6ea0fb4c9bd7384b799bde752e252f3e14ba78cdd2aa258b172dbc74c1fc7973e7cc9e3573c6d4caf2f165a5e3468ee8172aee7b41519fde85bd0a7a74cfcfebd635b74be74ec18e1ddab7cbc96e1b6893e5cfcc484f4b4d494e4a4c888f8b8d89f645457a3d116e97d3a16baac219751a142899ec0fe74c0eab39810b2fec2ce281294898d22c6172d88fa49273f384fd936536ffb93943c839b345ce909933d49493f9fc4554d4b9937f50c01f3e3630e06f60134697237ce3c040853f7c528687cbf02619f6229c958502fe4149b307fac36cb27f50b8e4f2d93583260f4475b511ee01810133dc9d3b51ad3b02c10884c2898145b52cb12f93019e38a8772d27a7179d0aa704060e0a2707068a1e8495ec4153a687478d2e1f3430352baba273a7301b302d30354c81fee1a8a0cc42036433617d40d8219bf1cf11a3a11bfcb59d8ed46c68f0d1d4c941cff4c0f42913cbc3ca940ad1467410ed0e0c272e3b9174368aca630694af6b7e3755a9199434c72fa23535ebfce16da3cb9bdfcd12d78a0ad481b23cbb64724d099ade00260e1beb476b7c4d457998ad41937e3112312a737c33028344cae4b9feb02bd03f30bb66ee644c4d4a4d98c65c9555979212da6f1ca79441fe9a71e581ac70716aa062cac0b4da38aa1973d5eee4903ff9dc3b9d3bd5faa24dc6d6464659018fb7796046d33d1992d94568d89826ce32d1a3c0100844d83fcd8f9e940730a65ee232a317d54ceb856cf8a96028159e8e199913760d985ce3eb2dd245f9b096ed0bf86bbe214840e0e4e7e7a64cb152f46cdf372482424e9a440df7ed7038180c77ec2844c43100738a3ef695f11e9d3b5ddec00381453e3f08d847a3c0db2915bd73c1feac2c31c1373484682a22e1ead1e566dc4f5353eb28941bac08f3c9e2ce11fb4e7ca9b8536ddf692a3e390049ae97dff28c0f3b739a7ea37c09b18366f70eb3845fb93dc3bc3f6c6c60d8e809e5fe4135932dde0e1b774eccbcdfabe99e150ac70e285752b915e2a98abc0ba19cd8945944ca3d61351bbfba14eae90d0e27a452a6307f49d837f942f35ae1cecafa8d851a8caf442949ce16b3ba19ee1d3c37dee79cf839ddf3d428e8b09ac3878d9b5053e33ee71e44cd6c70884520f134ae3ccb3f204ca55899d9f86d308ef412a8480d87c0b2012203e4cf4cb2a2e7644cb5c215f811d2d9b95309145d4d4d49c05f5233b9664a83513d35e0f7056af6f327f813358b064db605a7c13870436ab864430578359bf5eedc2920eed4d44caf25251bcd84526b990c140cb8a1223c325811084f0d06b202e5333096dadee4c91a377900429cfad706d8fad1b521b67eec84f2fd301ffef5e3caeb38e30326f7afa86d8b7be5fbfd301532958b549128227e11a1610caca9e34e993f757f88a85ade5565828c4f6b6024d39c761aa3690ddc4cf3990de5c88642c4714735ef84ecdc2ad29c665ab599bbbd95db893b3e71e70036d1f087c44df3a7169171e5217741a877a84fa82f2fe6e08848aa43ca01e4edc368775f56cc526b51e71899dcc0aa6bfb8452f7cb9ac65839ab9153a45537a5a1e7225bb38ad09e39f0d2b323289d50bebb2fa17e79458efee247685a74a2f91a928a49c8f9f860b987d70c1b0b091437ddbd52ddcd6efb45c1300b842705aecc12a30b9705aeca426220ec87b646a65a1a9c565153e3c72700ae4c2b2b37afe216eb94869a2ac2d553edbca9699089b3510f8a4ab9da9d267448536b57dbad2d416b22506337179ef6b3ada1f76176b1b8ca5fd9fdda9e1430db8795361bad99583301f298154e170d5bfd403432ad42d6809e6c913d61d2384d834f3053ac25bf5072509381a1b57c4450522669cdd0c0a0e9c82100a3db039395e59f5e217205c4a21182ff8b9958b34cc290c8ca6b7c7dec18b362e6f2ad09cf3a373abb295a22001f25bb8ba9263016b964b3c27353c3f32b824d59a68831d7606df7160bbcb72c3c586032cccee070f5b429e822eccd906901240c4582bf7caac94161a86b84e7346d0a8a092e5b2d852f0d9e53257402838a42456238e1ea51fec915fec9d0216c34989dea0f6ba0fe99709f025384de18658e6714943fc8949ab1284b62da52c30ee8b39953660484720d0b7937b92ffaa8a27734b63c4ca9353501c810ba985d82cca83e27ace70c1104bf8b82812933846737533876334c9703dd95dc11b5a50e0a6455200bcf96bc04e3b0d0a68acbb41ae137564e0e8213d1353135fec21a2cf84ae82a35675ad964e835bfcf5fe297533d2515313061888855a02233a32b5b644479f99b135e10acad74649f4d91bf0b836666a7ac553a11e151761687fc45607130cc137be1a6183c1b3341da054c94609e963d04ec0d41aa524569aca27196d930cb0f114553ed09338b21a5c2360090f7da6cb67e54734d38311c336cccc5a9606ce7da716bfa45289dc487b7a174ca54824a472a02ed58a7a7673628ed77e72465be7048e940c701ae74a80ba667ee57da29e9757d32430d4a60774c7c5e54bfce8a1f2a38575efdb82e041e070e032a4d523290eec37505500d3c0e1c065e00b0cfc555dcf5030b817b80e3e28e92aea4d5f9337dfdda29c9289b8c21442989f42560000afa9988561369243009b809b807d0653e91b21058011c06be9277424a62dd2df9e87b62dd0d92ec9e3b3f4f46a798d1899532ba7b7c8549878f36e9c02166b6de66b66eddcde42efd4ddaae934963b2f3aa05757bf38ef44b501230c804747c11ae8c3f45518c51266d53e2290c7045b752424acceeb63979f71c5654620a57184da74ce388c2eabcd179fddcdce05f520c65f22ff849f30e3fb93b323aef9e7e43f97bf438701850f87bf8bccbdfa515fcb8e039aec5c03dc061e079e04b40e7c7f179079fb7f9db14c5dfa25ca0189804dc031c06be041cfc2d5c7dfc4de1e4c9ab0817039cbf89ab8fbf8161bd816b147f1da1d7f9ebe8da4b75058579fb6520986b0532b3ad4062aa158849c86be02fd67dd7011295839986441d54da505fca57dad4657783f825d515cdc96ce0efeff60733b7f5ebca5fa630c0d19397d1f2cbe4074601938145808ed0ab08bd4ad5c026601b10062065b8fa003f3f0afc157895ba02216014e0e42fd4a19906fe7c5d4effcc7e09fc39fe0c2582e3c7f89f25fd2b7f5ad2bff03f49fa2c6806e851fe745d4626f58bc07d42199f383504cdc57d8dff7177db984ca35f343f0cde65e29a0b1403238149c04d80ce0ff33675d3336350c9413a8afd7826afa34f247d88ee7352686e6628670004d02f2e39bd2f4008977bfcf7e4f050cee6db1115979c8db720242e39ab3720242e39cb5622242e39f32f47485c72a6cf45485c72264c42485c72468e430897067ef7beb6ed320b46ce63fe7e51fc0a70e90a70e90a70e90a52f915e243dfa9a26f77d475ec088e6d0d053b74ccac866f7388558f61d5f7b1ea19acfa5a56bd925517b1ea4b58759055a7b1ea0c561d62d507592fb0a29a85eacf8916869258f55156bd8b5557b1ea1c569dcdaadbb26a3f2b0835f0acba21f9920c9264773fb1e8402fe80bed13c5b3c0d12cc87c1674c2615c9f070c190b2193bf8d99393943d036bb3b169bf12ebdf31662f93c89824f621a9ea477001513f424c4e84954f2242a88c2b51898041c01be040c4047ee36e8f84df21a856b2e500c4c0256005f02baecce9700a78556171f971d139dceb53a3e1250f993f8b4c1278b6785d27d69bea0ef42e5a6341695c146661819bc801212b0cf8a8976463730efde7f7bbffdb7975cfd5c7c23bf49a86ebec9a237d57d07d5cdb6d4e51cccec17cf7e4f192a248f15520ecb06ed455532de83d29c8276a734fe08685e5d5a198a45d5e574ca3cc02245a9bd99dfa59dc8fc24ad8123f871dac1ccbffb1b545697f90a521ed99bf972daf599cfe63638917228a781811cf0cbacfbd37a65ee3a2ab3aec48dad7599d70ab237f39ab4c199f3d2e48d19e68d4baa100b45658ec999907921ea1b9836353354853af76616a75d925964e6ea21caeccdec8a2e04cd604774b6439a6c34908194facc1ea5a5050d6c76a89363b3a3dc31d2d1d391e7e8e4c872643ad21da98e38678cd3e78c747a9c6ea7d3a93b5527779233aec1381e0a8a3fa21ca7cbbfa52cde8a62a4cab08f8bab7cc513eb9a39390da570ac328c0f1bdb9f0d0b1f9946c3a6fac3a7c7061a981b1b3f2dd09fc1b2d2b071fdc3bd82c31a1cc69870417058d831eae2f25ac636562035ccd763eb32aebc811922694daa3862d94f8c45afb93155d0f66b6eaca8a0a484cb8b938a63fa4617960cfc99cb64eb1a3cfb93744e38bd7f78f3b0b1e5753d76ee4cef5f11ce9361c3407858f8567114b39f7dcdbe1a34703ffba72015e5fb95beeceb416344bad2776045c5b0065626f3919ffd13f9203aff94f99cb0d2221ff99d1966bead66be6c9447beb682209fcb45d9325fb6cb25f3a94ce4abad6a3b68606ddbb6324fa29faa649eaa447ff33c47b391273b5be649a8a6a332cfd1846a9127dc5766494b43968c349985a5509acc92c6526496b2b35972ad2cd73765b95eb6a4b0b379d2cc3cdee3761eef71e409fed69f19fd8341b6bb4fc5b489e2186b7260d00c6072f886cb6727098fdc5f3badc23adfca993c75da6c41e1935604660c0c4f0b0cf4d7f699f833b7278adb7d02036b69e2a071e5b513433306d6f509f519149832b062f7e051dd0bce69ebfaa6b6ba8ffa99ca4689caba8bb60617fccced02717bb068ab40b45520da1a1c1a2cdb2229eaa3ca6b9dd4bf62c04493eee6116e88ed64f8f1fd137c8bfa4a19ee9395746dea01b82edb29225811f604fa87bd80b8d5b95fe77ee2169696b81529ce2aad5b49d7f6c94a3dc0b65bb77c488e0ef4a7e0d2cbaa2ea3a44173069abf55f841d2d2cb04c3cd6bb0ea977e706f5038346560d552a261e18e6387858bb1f9ad7538903a590c29dcdb4e8b8818d4601c3113bb20b1b7485494a68c22ad48a4b95c56c69fceff65161d205641353fb89b8532d852aaaa50c219c3c671688471d6a1d0013856c25654556080552cc8aaec3aac6e078364c6498cd9c6d2cbac90c58ba516354ba24895cd92a61fc1ac6013c796ca6a253b8313cbfb452a3d955cea07dfb92b6867d0cea079a0794a6e28262753e105992e674166847b60a6431f9869d75a1124ed00250329dac394ace688f7400df1fcfb63411be7181f8bfb82f24fa1351b2c106da75d6c0eeda2c3f404fb0aa51ea7fd544fc2ab1a4877d272fa1dad83a59c8094eb690c3e1ad27fc7928d7acaa57b612befa563c83b9eaea50394c0928c4f6805ad515e42a935e4a53618cc285a4837b28b8ccb6822bda3aea202ba882ea545acda2837361ab7180fd083b45ff9b37186222885a6e173ccf842fb87f1261830916ea3dbe91d768b6b0f85d04a3572de454b68ab52a9326396f13d7a904557a00f2a0da763ec080fa2f619f4114b62cb9501a8e57e236c3c855c695449b3692b1d603dd8609ea54d34861bc728016d5c895a6fa73ada8b4f03fd815e671eed2be301e32b4aa64e3404e3a9a7e7d811a5f1cccac662f1e50170a90315e2ce42fa1f7a865e6001f647be50f368795a485b66bc4c71d48d4ad1db8751f243f66f7e2d3e2b94a7d512a33f45822f370b6ed39fe85d96c272d94856c63bf085fc6e650939d162377ca6d31cf07b0b6a7f1bc2b8977bf8f3cafdea23ea0f7a7ae371231233924377d05df447e6c548fdac8a5dc75e65eff3017c12bf83bfa7fc4edda1bee89882515f420be8467a84fecd62582f369a5dcc66b3e56c1dbb99ddce8eb117d8c7bc1f1fc7e7f12f95d9ca62e50f6a7f7cc6aa55ea2a6dad7683fe716379e3538d7f6bfcb79167aca5d1908795e8fd6d743746b69f9ea7d7f07987de631a8b6091f8f859162b6557e3732dbb91ddc7b6b31dac1eadbcc0de639fc0b07dc37ee030db5ce7a9f0a5844715e04be0b4fe8edfc99fc7e705fe39ff4e4954da60b3db4329522a9485e8d53a65133e7b9477d514f579d5009ff3b4cdda3dda76ed11ed09ed2bdde3b80e0ec35f7fbcff4cc7336f3752e3fac6cd8d758df5c6bb148f39840dc21eae08bd9f82cf5cccf76648dce3f412f3807729ac23ebcb2e026726b1b96c31bb129c5ccdb6b20765df1f6387c0a5bfb32fd1672f4f937deec27bf0fe7c243e97f0197c317cbb5b783d7f957faf389408254a89573a2a83954a6586b254b94ad9ac8495bf2a6f29ef29a7951ff13154b79aa9b65173d4a03a589da45ea6dead7ea47ea44dd4fea27da0bbf505fa5abd41ff275ca4be8e518ed18e4ac74d8ebd8e979d93219d4fd21edad7fcbb31ecb8b25219a4eca18d3c5f4dc6aee839c8f3249aae0ce79054be9dade7d7b07ade56bb52efc3fbb011f4959a035e3fcdefe1a7791f65381bc6c6d25cf15f00c48f1ea7ee0429529fa493ea218ced39d47ca5ee61d7f22f750fd531f37b347f52baaa41e52ff4baf20e73a8f7d21baa9b25b293fc616514a4e00f6a5fad9cb2943be9316531bb86f6f04144ee1f9c1b20c723d84ee885712c8f7dab18d8108f80141528efd32a9ac7ff4127b18ed7d3efd97475166da47cb69c3ea287b02a3a6897ea1df578f62c9fa3d6f058564f5cdd219e87b3b64cd1e26835ab54b6ea5ff2d7e8327a5e75d3dbcaa3e8fdf3fc3165b8fa953686cdc60ab886d6d26263255da595ab2fb259a4b032ca568f43bb2d57f2d42cd015d02a13a1d3f662751f801ee8a70c474a1224e722c8452934c4567cb6404fa890a03958e3e3a1c59ea37a7d1c6fa0595a2483d62152ffd2388626180fd1edc62cbad4b8853a431fac3396a3c6edf401dd44dbd99ac6ab691176a7af616d5fa495f0e7b512a333afe1aff1b17cf3b9f30b6e67b324fa149fc710e9ab1da41af5ef34968a8d0dc62b90eef6d0b0b7d35478bf2730ca2fd0c285ca11ca6f1cc16b8d126511c6fb0e8d361e3632999b661bf369241da2071d1a4d710431c761f622c67b35cde0638ca5ca8cc639e0c34de082f89f249741ff5caf2e5657a9dfd106acf9cdd037dbb06e7662e588b56fffccff29589e0935c1843ec1c2e7448e07889c4f9b708d032071ae6f2121571279de248a447edf36a258d8aff84b8912ff41947221516a2451c66ca22c84b30e9c1f815144d9dc422351fb36441d369f45a73626726105bb7d48948f7ef5c831d12b8ea80face40539268aef26ea8f3e963c4434a4ffaf63b89b68e432a231dd89c621fff8f644e5cf115d8cf155ae269a546f62ea8f44d3d18fd918e3dc3bc1b6af8916b637b1083cbc2c85e8f29789ae7cddc40af469e57aa2d59083b52fb7a215adf86fb1feed56b4a215ad68452b5ad18a56b4a215ad68452b5ad18a56b4a215ad68452b5ad18a56b4a215ad68452b5ad18a56b4a215ad68452b5ad18a56b4a215ad68452b5ad18a56b4a215ad68452b5ad18a56b4a215ad68452b5ad18a56fc06883ff24e1a3ea49083fad77376427734f0db43b1a4a92714723bd4138c929dba76822b87783772b1db59174a0afa4e179d291ae13b5534fc4c111523ecfb11976e5db3a2b3a2b37161a4d28f7ee5c88f218d7e20bf7a44fcb3f04b94ddfc0aed009a8ba05bc36b82e5fb898c6f77b7c9eeae3518df86dae474e81ea1bb1d1aa98c344d8ff8c2e5742a0a2787b3c81de5aa76715783712414ef8deaee7a9b296a1167216f747796ec59fc7052109d098adef8ce042b8b64a77cf89c29c28545c714160a74ebca82c1d49087a90e37693a778a3f6f99545cec7b2ab1b06bb78a58a5477ebc922faf9bf28e757eabdbb1aeca6e96f8d5578d9f9857c1a72146673556ef471da91bf5e279621ca1ece5194ceddaa967cfdc92acd2ac51b9953de72ad3729729576455e55edd735d5675eec69ebe6e0dc6dbfb220a33fcfeb6dd3b89bfbcd9c91fe83ed7d9ab6382a7c09fd0b16b5604c57b0ac0438a2fc8eadaf5a8a720cee329e8eac92a5013f3f406fec0de511ad34eb2b403fc014ae5bb762766be146c603d42eeb8f884eac4c4388d3a36b0823ae6ce436a7d87979837ed00eb85ac5bea7a54e508deb9630abbe68472aa73949c063e2614d53121313133d3efefd52b2faf430794be359440f17171c160b76e11116e77570a5135bd80c96ce09e904beb52b5d0b7c2c77d07d846d259af5054b136525ba1dda4a95a72e13337c859a81c7ef2d4e293a07202accf99e69122dc0c9e3c75928a4f21fd5451b1b8f8ce9c90bf9527a263120bd7457609ae8bbce6a928fc74eb9a34e0aad0d0ac024f6cdbec40769b6c458fc9898cf24671bd20abc74896df1e974eb15d4652570f2e3db37b8d6459fe825edddbe58da4fcbcced141dc0ec6c6e5467543966e9e08127d085a179332f117fe3a063bae5cc9c49f21ac649510137faf6ea188081624ea90d7a0e4ee9bdfc1abe93a73231c72cd67def8d4b4b4c44cc4f6cc4f4c8c8f0b2254371fb390541ccccfcf0de6e5e6e7168b2ba2b910bfdc9463f9791033ad4717deae20213121313aa75d4e4e8fee053d0b207222c19193d32e3a213183c7c7e98e7845d7e3e31212637bf6ecd13da71d6b5cb7e36af79ef81e17cd5db8b4ac72fdc5bbe7de35f1f2a403be19e5eb3b8d9b5bf8c51fe6ceb96ad6d573e75c3fe5e697eaa3c73fb1a1cdcd032747f00be2fb75dd39ffc815a362cacaa2864f7d246deee29833dfb589cd9e7b4be9c1ef5d7bf5f6bef5951397679f49f0de5935f58a5c21e3e5c6db5a3bed25caa44ed4936d9632fee765f14b1296242eebb22c776dc243b96f917373fafd09fcfadc553df9aab4d559bc3e814d4e9c92c513e243097349d999f17a02af4aab4ae797a52c49e597d1d509bc2671552adf11ff58025f9551e3e735ee5569fc2ffea7dbf163094fa4f203294fc7f1393d0f24f0398933f2f98c5c56963fb1272fc99f90c98727f44fe55d530a33794e6a5b3fa7ce9d333a7771bb293521213dde9f90e0f71f70778e73bb3be774f0b1ee1d327a2b11a96bd303974c8e5d14bb2d56c98d0dc5f2d837d36f4a62490d7c42282db96fc6127f3a4befd5abc325dbbcccbbaddb257e0773cc2d58bc4568b7ca93a72a850c9f3875b21204e113547ce264f149219891d7f89e724416ad8b14c4572403502d953ffd218ba68632187adc252135353e392929ddd7253ebebbcfef762b39e9a10c97d2bd41e9563f5f71f972a40cf99890217c528e416ea2f3ed4b6e7eb41d831c65eb7aa04d3bc84fcf0221453df3f312e2e334d6b3205177085162526e026da410312685293fafa772ace2c565efae9ef7f863d3fa3f7fd7e6c38d9f3147e7e4835dc7cca8be6a4163c66583260d1e32251060c31bf7de3273e375a377ed9a366dcbf2dbd7bf3176c9c6feab9f6c58f9b7df35d6962f6d7f64f9da8b6f2a51d60c9a5d3c6cd22503db0ceb78a607bb7dfc6d432a8ecc107f337879e3683e1932e4a311527edceda218f9621c4e9faf81e5efa67b229da0a168c73d919790e253fc8aa23c1a7dd706c9fe33a74ffa4e4341403708cea6eea62887604a31c6cd7278b45833f9ba039f781f63efdcf6dcf00987565ed5ee82005672e3e843ec5b16f9c5eb677e78a1a266f3c13f346636facfedd1e5b2479ef6bcbd8fbbdc60778c4bf4c97d8fc240ebe91ee592c806e3ab7a9f8f9722f06d7d54940c9ca8f77a65e0f35094dbcd4ba322332379e4a33156af8512f949cf5994cbee796c80a2bbb7c3a26f978fd51eefe36784ba697341bb652b0f4d18fe7ce368769cbd7b68ffe69a092ffe70e6f52f1abf6e748a7e879469fc15f43b899e95fd1e1ac122dca92cd5adba5d9ec8285fb4438f603c49fcdf3007a98a3331c6eb70e89af84f62f21f89793d1171aa437132b7ae4510f9fc712ceeb00e2bfca0dec06e0b79b50729141ddb9d9293176d300de9f053674e08b35e5954985b04758c5f166d5241ba752588745a8cd3eb8dd214e83e0d36c3478cb9a37c9a2f22e4d6c488a1eff27cc7f2a2f3738f01f9672559086f2c1420d8a03b9ac4b59dee6807490e75b9e7c25876b312376b4d9715cb2e587865ef91437b5dbe346fa5ba6b63af0e7b064ebbad7ba78d1d237bac2f1db9fec6a1a537754906877636becd56d13172d374c1a13d6eb8338f6070a342394c29e29cb95911b9b98208e9bd1cbd47d2245a482b681b7c916d11f78a257faaf2d409df49d8022a1657df49df9993c271e8d635758f4367e27fe324613de61e43e7f3a1aee344777b16ec3d366a7c5e2116d5b1c537e40c4f9e72317ad38f35f0b97c01f4e80572be9217f1450a1fce86a32301e229da22644a5617dd28987da2d2f721e50e3f099e2e86b8d45108bc03eb048f7a64c5f7e31d58c39e3d287000a2b00e6354a840d69ac4c5908acc813c4eea36e4d9a6de6baaaf4a4820aa84f4d91db7ba7de0d8b163f22f7a1b1ff142c89462726c3f29c6db7571851c3e4ac81f57f87b8571e51ee571852b97138b4309b88af007958f897f8c35b2630f91ba7b5992b09ea74efa4c795fa77509565e63ea42f859bbe12dda921fcff219dbb1a9b13c59fbfcfb38b85da5c6476ab476046b319d358a1ed472f31f0ca564a85a5c86d79b0867ef63b9ee4420942c169e2b9a3c2285123c1e5c3d228d72b1e88ee1720c239663aed57f5ad329d4a48b9a3ec40a96812f42c91111baa8d22752c8e7f188ab486baaf26c9da111aabe8eaf8f581ff56ca4e6724424f141b117c50f4d1e903a2e7662fcc4e431a9f31cf322a6c5ce8f9f973c39f52a7e857e79c4b2a875fa16c766dfb349aff357f55723de884a69ea523f9f718a3ce4c1f49451a2f1353ce2082bfcadf85f822c148a2e4bac7285b202ddbb427fb87cf07efbb951c8cee8323e3633ee2b736dca8cf6783c0d2c545f161d19116106b03811d85d165d45c2f5f3a0263f897f83626725a79595ccac7bcb68538670e27ca731747868b88a60e56219b458c12a175365980f08874695d7ebfe645f1a14651df747fc8f719c128018200ae8257e18505151915aeb8d8365ab9feff5aa29d2c4a99a69e28498fb6284ed4a88814294162dd627ec54b40fb6cba197ce7b69dbe5754bfbcf7de9de97afba79ff8ee5cb77ecb876f9d04afe1253d9058f4edadd68bcded8d8f8e4ae2dfbd85d8dbffff22b369bcdfd62ce5ac8f83bd874fc001973b3482161bbdd4d23b7036e9b5b6407dc262f9a9812ca2a53c42e639eba82dfc46f77aa8faacc45bac61597c63c9c1d754beebac53c1113ff00069ebdb41b087c1a8a96e29a26c535528a2bb8154a16c2684b9c94be148f16c2be461375458aba34e6d7421ad792230eb022b6864c55b1d89c11f98388b9fb2a16ca59ec6de06e988eacdce470e6d2439ae6621e97e075b17440a1d0c0f1ac40b4ae3b7a407de5f31feafbbd34eef7efe52e55afeebb3cf3b1c14727610c4558dd0e702e83b7936bd35c51ae689f372936562ff58a05151d2d035f845c3e1f4219715a8658a88922434686b89b9116893b191e31c28c067e107d722726fa337dd19cfb33853ff3b2e850ee31ca1502162c16d7a7f2c412e64d0d7a6262b86c30e48a8ae6763bc7431131b1bc34234ea489baeb50b550181111bc3451d867c9ed9f6b4dac6ad19e684d36161adc47eba31fd40eeb071dcf389f4d730cf15478c645cef34c8f5c16b32cf6fa9843311fa47c90fa558ae770c4be589ee1f63975fd685a4a5c5a5a8a332d059ad29992a678337cd8a2ed1e19cda21b58d21ed14f121ddbcdb8c77dce7277375beeeea6e5ee2d735725be04452b963c3bc857929f7cd86279a2f714f3497c215fc1557e80b7a54c7653ad5ca49550bca78342ffcad589bd6ef1496bfbc4ec3d9470554d2b662dd9902bd597e64bf765f8f4ff31be220716aa13d405d8ebb5570561ffb304ab564cad37d5e1f0f28c0625bf7e3ef7c4799b6d728a83c21d054b85331a9f95530081b27d4e611ca5430a41c3afeaf8b1802766dfbff5cbedb75f7ddd9d6c7fecb77f7be9f4850f3f71dfc48c5dbbfa154d3b72ed531fcc9c77eb9d35b1cfbff6e9aef29d871e583fa51b24b1ccf8504d802406d9e966562222392924e637298d985832410f22ac43c0ed8df24465b8dd1de233d2d48c0e695a076fc0eb494a8683e7f78945e877e4082911d97372858e8741c787620a8b8b61f24f6230279ff63d1d53e87b2a982720e4a3abe64df00ef2aef5aa83a2c7475f9eaa8c4998ef9b1b373de132ef55716bbd3571d7a73ee8754778bc91aa83a13d260441fc53be834cfc19732f36e31e4fbc9a24f6edc97c76c885de69e89e37e61cb98869261731cdcc404cd524ff423ff7278975e4af769c53c8d1ac90a3592147558eb41d398c727c391ca33eb54f94cfd9d439a981f5aa4b7e8989b30102f3229a2cc3a64e0dec164bb8c4061de26529ff53c1ca261b70e684584627cdadba296a4de255a7f915ac4e88518550476cb1102238866ac0e38d72cbad7254545a07d5da4e632f94162f252a4d4a94dc2c47638de6e71582588ea2b00652aa1c054d415bc0848439c495026d72caea336f9bb7e2f1fbaec9bf282e26a2aa61eddc391be2eab33e7deccaa3f3664ebf6e53e3c7affed160ab926e5f17be6ef9bd7177f32baf9976ddead5fe3dcfccaa9b3ee9ce2e197fd878a4f19b0fc559550a34a04f3b008fd2cbd384e41d228ff1bdc9f6fa32af6e1910cdb624ba1d7035d9163ba0d9b645b703ae266b63071c4e2bb3d30e386cebec7436e5b14c93d30e687640b7032e3b60d9b15041594cb967b667ab6787e7598f76917291f777aa120395451e5d7168ee08c5016be8f51e55d4384551152f718f179b8583fc201c47ceb685dca4aac84247dd6a039fb94fd3dca1f4ccee6edbccb94d9f4a06be90ce95bb811584bc8e509b40774775560fc7a6282ed6688437ae3b711ff773858bc2a20c0227f68a327c4f6403db2045ef73e17b082b774ad88422df873e69e47ca78a4e17451716cac3bc755d822a349b3c1c62f25f4f78e1bec614c24ebc1c8ac82f54da742e54d4f4f422f98f1b2088c8138af384220a3dd5a30a3da19c424f9b34d0ce85e6bf76603ff39f4d2898bad7a3ba74c5cb1b94bc7dc275218f6a9bd2607e7e9e694ba3b37ab0fce8fcf840b412cdf8e633abf95db73efd747d630f36e94165ef8f431f6cbc179afbb633f3a01084d79ba53d04bbea901e49ac2d23317620d663cd768c1d88f558531a83c07eb1d04d25b89f18b8ea156c646991ee8cf8f8b418616423a2543523cd1bc9c891041744bad0322015a6307f42e189858c619c790a4a4ee8b8ee31d24c47c9ebb094abd26bd237c73e1cfba4e755cf1ba94e576c5264c71425d61d1f131b7b34322a2e32362e32ca0b3d178a154d8722b7611f1c19158a675637f645a9ec25a103610c43d1a243d1937ce2f0f0269feafbcd3a2c49eab024ec227c493cc9d661499bfc3187580f8a62b72167afbac83d3fa7cb32cfd565e768b34ab1cb83fe923ca884a6a984f23fb1ced925a841aca8b9c1ac7775d5ba461c809d54a45e139a6d71a5f87720b6a34594e68d8d84bfa1c69b1a2e3e3e2a4d95ee6e9a372a0696b36e7e946a1bcc5c817cf338a7857a834e8bcd8acf52a0d7283ece015f38a7f40ff1b7cfbfae7ed786f11bdaefd8c85f3bb36fe4ea9b8f30e7d21b4ffdf90cabf6d5dcf0d47d5beb461627f07f3eda78f9c4c6d37f7be6e6bae318fe70485a3cec663a75649f34b39c99512c934d620a4b6d9f11f232af17ee54aad62623ceebce6094ed138e96dc6bf932127d427412a5dd4c947bad446b6374ece563be3fd9225479d2f754a510a1cef392d94047287e60f240ff849871fe79ca74c774e7dc98e9fea5cecbd2d638d7a6bdea7c3921dae11773d8ce54017a69403873a92294256f886e8df272742c95bd247cd1066131ed4e3261bb684ff639f293dd4c7eb29bc94f76954fca8f8f910faa0a63fb6a9ff0b97d9b3a4147f5da9d612fba0c5b0d67406b1e94f564b0c290b7387152e2c2c415896aa2cfca006e48b51a59969820aa4a4c107d4e6ce06d77079bb64ea6ad6c2e6f274dc3290d2618d6245cfb850356dfce1ff06735d8d2252a10b6b322750f639adbdb5eca94d79b1ad746ca549c3755932633553b2b5379a63431474e3bb96bd21dc23ac608f72bd086a27d05c256b2b866b2a6fcb03ba9d3907965fd4aa7f27e8766d59fb9e285d5ef369eb8ebfa8f77bd75a660e4c6114b1eb8efea653bd5b19173bb0eefdaf78b37a74d6efcf78b3527af65c3d872b6e38fdb9ff8f1adca9d150d776f79fc71ccd214f17f08b487c1fb1be4e944e4535ea6e2973b55178c8a504c5d39535d1e6f95a270312d23a557abf094286795eb331a09a99cc4956290856c05f676c991d60216cf1416170d3f757284efb4d8f388d306e1edc243305d5bacc7d47a974781ac88b5c6e45acb2fb64e5074527447a0674c4cc11465cf86c693c37a46ed57aefbd7f5eaf7bb36dcd618d3f843c31bbbd8a7ec993b49a1b15835c958358914a0aefce9b3eba6de43a9195d8419c3fe869776e9129395a16bed3362bc19c2e0cb438a537be51945304a9c1c8aa513656f484440de8c4a52ec6345c5cea5342d39a56dbc47648f9735c6cb25177ff62ce2dc830e61834e8a475ad679c73ed911ddee886e76e4843cf788b2cdacd5be4843e0c7501b91289a1525e3a5ee8f97233d3b3ebb31b4c572ad0ed810ab7e788f04d6216148c2909c0f3d9f74d55c5dd935740d5bae2e752e8e58e2b9ccbb2cf106aa611bd4b5ce9511ab3d6bbd3726fe35fae9d8180f652491072d6debc29a31f39c759dd16c5d67d8eb7a6f5946d5611773f58be1b328d82c77b059ee60332d10ac8a0af9a105a21845f9a2785403bbb93e2fc95efa49f6d24fb20f4192aac20a531af8acdd6ded4c6ded4c6ded4395b655f1f656dd1f1f8ae7f19bba3d63db1a6960e4e1c9a9267bd3e43cc714564a569a8f239bd4401be3785d9a3f054aa0ceefcf15a4b31f3efbf1da0e7ea9154cbb53b964312dc6be6c3738d745aa85d4543da6bd540b315e3d4baa05bd995a282c94e7e54d4f079a5c65424a6c5c336dd05c35b0b98be67f78f8c8a7f316acbbb1f1f46baf359ebe79eada79b3d75c3f73d6fade43368d5db97dd7752b1e56523b6c99bbedf577b6cdfc7d874e4fad3f64c0cd3f72d31fd9b8d9ab574d9ab66ef58fc6f04d231faabe6ee776b2cefbc4cacaa08e7cc2d933857d1199b0eed9d1b0eda7a5580a232fed42923828692fe432295a0a66b43c2f894e8aee148c689f214ede47462a919171348a31b909f4faa2f552265c8d3662f32db8fd54b0324f6adc3cc970c8ac58443e61bfdefa53d33943b34e9c7597421da5bf142dd7e22fb47a6e5b2d9aca6dde506870ef948b1242818b13c607662af31316a4cc0a2c4bb9266343ca0d195b1376a41c4af934e143ff697fec05097727ec4a507a7798aef3f61923232709bf2a4d34c25e1a655ac37ad16c66bf76cd643fb399ec67dab22fc2ac90229ae58b304e37e58b68962f82f50a459feb6c6dea246ced1ed85a7b1564dbab20db5e05d955d14dab203a14cda33705cf59053081d60ab0e4bfc9e53a6b020f523bf85601e3f8ee2cbfeeb7cf1f16b3ca0a6900d58848d30082e74d4e95b484cd4f219a0ca0e94ef5e53dbab713960f9420f831d1f2643187d98fc320ea8b76252c9f32f69a513d59cf830bf6fec81c4fdf74f2ea65ffbcefd1d7f95f1e5c7a65dd8ee5d7dccbc6fa965d7ad18a7f2cf22495cd63ce7fbcc37c5b1bdf6ffcbaf1a3c6dd8f1d56badfb1f7a93b37c0fc41bef713b1b56a8e7c8fc27cdee5c75e4177b8b85ea42a454c57ddbc086e3771714678afd37ae6b058d8b2933ef9a4a150aa84d43d9aeab41f02149b8f01f2e3c53b09fb8f1d3ba6541c3bf6e3c3c78ea18e99c647dae5da4b94ce72e5338f697c6e3a67a6c9d1c539e3c7a14922e4a73cef345a444bd3ab6975fa26daaa3da23ce8ddafd47b9ff1be4027d2ff951e1d19931e9d9eae74d4db47774cf3670ef696c58d8f2f4b9eadcd4bbf3ae68698adcaed915bd3b6b307f8f6e8572263298e527c71be14553c2ca86b5f28179fbf7da12f8a989a1a9be151523354972f276a28e5f8b14a523213b9254289b60825ba4d3fca5d9698e377326c7a65d45be6f4883e3b9333a64d341f45052b870be181ed172f16988e5474a2f92a47a5388b86b7b42435e4667040a27c3e8f9a8add5afd7c781ab108d4cdf728a690984f4fe591024bd4d5409bb6108e98b6f979aa78ea0eb1e0f171314230d4fa272e687cf283938d7fbfe37136e0893759a73e87f39fb875c7fb13177cb8f6fef738eff6e50f7f6497bef8012bad3dfe97cedb6eb9aff1cb9b0f367e527348c8c1dd44da04ed0045615e4c3988f167b201ceb4f40cce78b42f238a9ce2f4bff1174eff4f235dd8ad4cc11817cb94c75c2ebff0185c6ef9342449a608a7c1b4f72999e93e9bad3eb7b557f4998b167eaacf2f4fa5fdd691f469a9e064c03a8efebe5e9e4e3718ffae9707d2e2551cb73c94aecce83331a9e9c0b9b2e88cdc8f9bd1cab3878ef2c59f0157857a2aa90ea7eed49caa53d593935292b81ee1f6b8bd6e458f4f884b884d50f45425318bc544e292e44ccb6209eee82c0a8a33eb8ef859c92a536bc9274f1ac9c9d24d678e373d27c88fceca4b4c484c8057cb2379203b2bcf3a6e84cb9b7537fbee9109d7562cad1ab1ece6636b1a6b59e1cd0f761b34fcf7f347ec6afcab76203efda2a98dcf3ff57063e38e2979bb7a761bf4c9431ffebb6386781206f3a4aec18cb9e825395f6d742dc3e9bcc9c11c0e5254316be474dce9e7fe08ce532254972dcb4d87382eb7bd27709d97d7a108f3c995b5441b6d967f65b3dcddc7967b8be9c325d7a5f89f30fd5ea13fc51b35c27e694e7069df7c4d63e098da9c63c23f3499169f25b15d79ebc70f78f8cc28edc0aec6debbcecc444f174087ec870ec9660fcbb1a7a4c6a5c6f3c9edd825ce5816a3b46d4b5931893c9b32b85ce4f1a2b78ce98919910a5c36176339edb2db9e23cd6d9b4973db2669f696b5f52b0a78d86eb23cfd39213983c0d7f631d0eb520ab910eb48d10a5f52dd8eb54bb7999d6e333bbd4971a4e7f8ddccdda438dcd23d7027e74cbbf81cc5f1ff54f625805155e7fef79cbbefcbec4b92c96466b24c20210984c1682eca22229bc84890285651595402881b6a7c55c1a595da57976e60f559b5ed63498014ace6519ecfba3c78adc56aabd216156d69793eca532093ff39e7de3bb951fbfff71f987bbf3b733333b9e7fb7edffedd5946f749f74a1ae4526217ac6c41a3cb8953d2248c59c0be04e2e3294c4d22194fc69234a7e48c6c28579513b24cae261b552baaa9b01ea846270703291e1da5d96c3548ca88a18326da548ad5d55486461b722b53c4d8a4bac8fbc12c4e752776d3762653ad117765e74a00346cb9b5ec5ec9895620a045086c69f4a878a8533e84b16b7cd61c855ee1083f1622f8c2a510418b4100d66ed217c2eb1e2a1ddcf29bd2e6fe3e30f7b79b017838b7b5fa2bbb6eb867df4dd5133700f88d3b8e9f033b7f0c860eaf5ef35370d96f0e8135fdd70cfc73f3aade59f3ee9eb371f3fed2a7bd57b40313f1c85308d1d2483e6430cdc914ab8813c281501b43578ad216e9a0042516425940923f8a15041f2b081e2bec2c0a299ee770ac10b300223eb165cc031c893370381a10c2d2c101bc9e5c77af0a54287b7c207b7c203b7cb0bb28a7dcacdba02da12ff50f089fe00a9f0fefc28ef0292915a4d4b9ea127595ca9cd51545fe7b39dd56c63f879df21d0e3791c437b2e90908827c623b2da155b5d595344d0141a004161281443f6659249150a2470dda3eb50f9edab76f8863f70c3d0d179d9a06fb8666a1bfe61174cd2fc2d71c5e4ce4b2924eb717047152ad349e9b204d972ea1efa5dfa4f975d25bf45b085eb1d410b550c73ec8dccf3ec77c2cb01203c63387185c3379d816adea363a85374865f729050b3fdb878e0577cfe07d05d90ff65961fcfcbbf67931f499d9ecd982188b9dcd3444a3e72e406c264aa220b134c3a45829c8b2e808ad2817448b2a49140b19007919fddd120d654031037092ad37b3600bbb8d1d640fb30c7b81809f939b7990e27bf96d3ccd0fc07bfbfeee0a23d19653ffa0063be5ade8271e9c2a673d83edacfc88ce1a423617b6bbb06076e0e5ebe8c00fb436b87c01e7cbd03e4ac2cbbc6074081d60e6b6e8fc99db12f3163916eb222402ccf06f2676391e0c3e38dea798f8d21eb72388e00ccd6c130ccd6813312519aad14679f71026760bf9c12169534ca36bdc182b30f8914e145874dd778511192e70780964ab20a48305c60e16f092eccc223254f045a9bbf03b839ed5dd790a472513e82d398ea1d15210ee6346715fab5b398639105403f49f371fd9077f03f8a1c7e13f0d5343278f2346ac876f0efdeb99c7e0071f971874dd1fa3284e47bc68d07349cc5a68901d1b032262543c1a09b9236282a69a04ccffd28f09166789eb30a558f86556576891025010658d124428c91c5e5bd9c0eb29a365dc85cf920d0aa716dc55ffd45bf533fda3aa3e7034a47370d03878701027a2f2ee05a6bc2a902a3e45d0846c69b265c896255b01f34a0da620d1c908f2b1f2212ac889a74864cbe36f80594ac070514532692c505292d5a6930d8bec4ca0c9942000483221f8dd0841de642f2c521665c0a2adbaca9ff3c087bc2d85632bf9134d2788518518d2f963ba47d8c5bd3976c2be9382ba1084098159a7dcabbc8c2ea5324399a1d3f54c566dd416d29732ebd49bb50daa20435628a813b43970263d85b78559eab99af4187c9c7e847f447886fe21cf5950d7b466162231860272b29b5901918272917e11b0018482204a3242674d33f03a2db17a2d68ed81cf20201fb7834d090360dc4e4594242f9b253946a7589452b672a70ce43de8cfd6808cce850368a7036ab2e4734129a215140ce3544a5f650063001677a7d8256c2f4bb303f0993e13a3700c17677577448730ea1e8bc70c24c01d71dfe1916ecce31da36a8ce3c6b16358a237dcbe7f039267b41bd74ccddc262351ae9cb768e1cf2865f834e2d843141c3e44822b33b729e8b53abf98abc39f6ed724fca29b637a635775416bac2679a65ded05ada59d903bc7a067dd5c52be6b754f379245ecc05278bd548c86ac262802d48930b6927f9d8e7106c29109eda01a29035003ccc740065cda1c8e8d079703766fa9b8b5b490dd73fa936f9c3ff73bf49953d398574f8f670e9fc668f85da421aab0d50a21914a3aaa282fb8aaf6a8735177142dd9538b4254099350e3d17e973861d798e6b90b04856c21b2ce780181b800799a164406429117181a29f4d365854efb143aed3dbfb348a7380e89f89f8984b26585ce3ab28ef4ac1d2702d79d92414a9e2b2f9157c9bd322b0b7e0bdab5a9538e2657d157fec72c69e68bcabc6c4977457dd532f90ec22fdd3d273eafbd2d1c8e2b14363084593c54a7870fef46602ea4d08622e99e71cdd8a2439cd02fd8d30ae8120eee9a5610ec16876c29f008cbb14bbc2b86c81687c4cfd6385575724d81d782e811c0c72776051059e19015880c61f2d3ed6570073ea9771849a1050af09f07f58283e7001b14c0fcee7fd070cf7f9c2921aeb98bb913714cefe95ee4955e89ecfc77d837288d4a00c7a29819d741d0080613914482610c262847e404f36c6497f692464722d1044c55d8e69cc09c881d5fc82e142f311698970716452e8f16e397241e883c0e8d58254d5b95b2181a65f5857c4c12f2acbe5dc5500e9757bfe02b60e3112fe2e5e59dbc31218e134dcee3381c5e57de0b06f278c10928f3f1de0a50a17bd682eeb1905ef60bf41ce69c726d9beb20048a14e7c3dd58f2ca113fcb8b3074979965d6e70bdebabb7b12db658b841664918e111b9da67d356c54750b833d53629bb71b546b0b65b6c15c4d9aba126c04135e05d37ed45fdaf5e281d29e675e06156ffe16246ef9e81bff597a13be02ae03dfdb57fa97dfbd57dab2f365b0e885d2ff960e803690e803f2374bef3b31056608c9ba4a45c158c71e5c6aae08c299c6cce0a5c6a54146562a11905391a8e3ad5aa316e44bcb4afa8a564ed88b96c789926b4541c24b2018ae523c615bf83a09f1541ca0fff1a8ea5d71d5bbe26ad9ed55ff7fddde535f707b63fe4883676acf367a9c257197c3757e1d531b3b52db3585b8bf9a86dddfe897bbbf2da49d0256579b882e870b60fdc3b3563edcf597d22f4a1bc16dcf7fbffbc2717797ee63f768d6d25dd7ed2d0d0dfd98060fdeb9f8ab211547759e4068fb13b402512a0def242b506dc91ab0262417555d2d5c57c588a48c4f205b9e6c33081408379362394c281e217b843530fc873e2bde86f6c7fbd2b56d263eaea86d33dcbdeeeed1ebbfe9abc839afa3f30d778f5fb7672022ab5d90bc20355f5e9cbc2eb95abc59bb45bf47daa83faa3eab0fe847b50f7503c94ecad483a6a99bba225a09581d0f4b9c85ebebd8a8288623f15865e485e1415f246ad0f1c32211aa3a4df82a1ad5754da81cc55ca35334651faf32a77d97f3ea77398f13887317236e1e872f11d79dcaaccaf466e84c3a0abf908f29b357f41f652feeefea821aec067c31aae24a7cec48d48d6661c3c1e532e429a0834213a9a6738ae9d8726db3ef070334292f91045b2fe8c624d39a84211bf4109b4143c81f8f154ca41b2cf4d0ec64c14006bd91ae428f32d87725768831ecf8dbf2, 2, NULL, 2, '2019-12-15 16:32:42');
INSERT INTO `documentosavaluo` (`id`, `descripcion`, `imagen`, `avaluo`, `path_drive`, `id_tipodocumento`, `created_at`) VALUES
(15, 'docuemntox', 0x255044462d312e370a25c2b3c7d80d0a312030206f626a0d3c3c2f4e616d6573203c3c2f44657374732034203020523e3e202f4f75746c696e6573203520302052202f5061676573203220302052202f54797065202f436174616c6f673e3e0d656e646f626a0d332030206f626a0d3c3c2f417574686f722028504329202f436f6d6d656e7473202829202f436f6d70616e79202829202f4372656174696f6e446174652028443a32303139303930353131353134352b30332735312729202f43726561746f722028feff00570050005300208868683c29202f4b6579776f726473202829202f4d6f64446174652028443a32303139303930353131353134352b30332735312729202f50726f6475636572202829202f536f757263654d6f6469666965642028443a32303139303930353131353134352b30332735312729202f5375626a656374202829202f5469746c65202829202f54726170706564202f46616c73653e3e0d656e646f626a0d382030206f626a0d3c3c2f4149532066616c7365202f424d202f4e6f726d616c202f43412031202f54797065202f457874475374617465202f636120313e3e0d656e646f626a0d32342030206f626a0d3c3c2f42697473506572436f6d706f6e656e742038202f436f6c6f725370616365202f446576696365524742202f46696c746572202f4443544465636f6465202f48656967687420323638202f4c656e677468203132383234202f53756274797065202f496d616765202f54797065202f584f626a656374202f5769647468203330353e3e0d0a73747265616d0d0affd8ffe000104a46494600010100000100010000ffdb004300080606070605080707070909080a0c140d0c0b0b0c1912130f141d1a1f1e1d1a1c1c20242e2720222c231c1c2837292c30313434341f27393d38323c2e333432ffdb0043010909090c0b0c180d0d1832211c213232323232323232323232323232323232323232323232323232323232323232323232323232323232323232323232323232ffc0001108010c013103012200021101031101ffc4001f0000010501010101010100000000000000000102030405060708090a0bffc400b5100002010303020403050504040000017d01020300041105122131410613516107227114328191a1082342b1c11552d1f02433627282090a161718191a25262728292a3435363738393a434445464748494a535455565758595a636465666768696a737475767778797a838485868788898a92939495969798999aa2a3a4a5a6a7a8a9aab2b3b4b5b6b7b8b9bac2c3c4c5c6c7c8c9cad2d3d4d5d6d7d8d9dae1e2e3e4e5e6e7e8e9eaf1f2f3f4f5f6f7f8f9faffc4001f0100030101010101010101010000000000000102030405060708090a0bffc400b51100020102040403040705040400010277000102031104052131061241510761711322328108144291a1b1c109233352f0156272d10a162434e125f11718191a262728292a35363738393a434445464748494a535455565758595a636465666768696a737475767778797a82838485868788898a92939495969798999aa2a3a4a5a6a7a8a9aab2b3b4b5b6b7b8b9bac2c3c4c5c6c7c8c9cad2d3d4d5d6d7d8d9dae2e3e4e5e6e7e8e9eaf2f3f4f5f6f7f8f9faffda000c03010002110311003f00f7fa28a2800a28a2800a28a2800ac6d4fc59a0e8ebbafb54b68fe62bb55b7b6475185c9ad77fb8d8f4af95b5cb5d47c61e208ad34886d4cb0c2a1d2d4b12e1783bc01907d7ebd69a133e8fb4f18f872fa3df06b5658f479421fc9b06af0d6b4a6191a9d99fa4ebfe35f3547e12f15464a37832e1f03aa49281fa9ac7d45a7d23505b0d4b409ed2ed94308e49dd491ea38e4706819f54bebfa480426a5672480711a4e858fe19aa16fe2a56d516c6f2c26b4327faa9188647fa11c57ceba3e95ab6a715c5e695a05e4b1c3c4b24376463be3eee4fd2a4b19b56d5e68f4db4b2d4ee242d91126a3c023be0af1f5a00fa660d6b4aba98436fa95a4b29e88932927f006af57cb3aae91aae812c5fda1a16a76af265a3637e9ce3ae085ebc8abfa5e9de29d5ed8dce9da76bb34218a164d4d38603dc7b8a56607d2f457ce9ff0008f78ed7a695e241eb8d4529a746f1f2fddd3bc5007b5ea9a00fa368af9b8e99f1097a58f8a73ff5f40d33ec5f1155b9b3f1563da6cd3b01f4a515f37087e20a8e6dbc583f5feb467e202f583c5a3fed993fd68b08fa46aadf6a365a64026beba8ade32701a460327d057cec66f8800f3178ac0ef981aade87aed9ea0b7d67e2192fb51ba11b7d91e462cb1b0073d0fb0a1ab2b8d6a7bd58eb5a66a471657f6f3b7f752404fe5d6af57cbd6d2aaccfbcba6d526375383bbb0a98dfdeb2f1732b1ff6a4357c84f31f4bcf3c76f1992560abfcfd8567d9ea93dcc4f2c96a20419da8eff311efe95f3cc9712c880e583e390ce48cd0267645dd90c3ae1b20d350427267d2c93c4e81848b823d690dd5bafde9e21f5715f34c721fde79abc7f011d73ef4bba97b31f31f4c47224abba37575f553914eaf9e341d7eef41d4a2b9b79582061e6c79e1d7b822be858e459624910e55c0607d41a9946c34ee3a8a28a91851451400514514005145140051451400514514005145140051451400578b693e18f15f80bc5da8dd691a42ea76b71b82b6f0bb909dc39ce411d0d7b4d14d3b01e7dff092fc427195f0740bfef5c8ff001af25f88d3f8aafb5eb2d535fd3058af9661b740bf2e3bf393cf35f4dd721e3dbbd22e343bbd1eeafac21be9630d0add3e36f3c37438e869a7a89a389f829ab4314d7fa6cf2ac72dc15921427ef919ce3df18af6148218e4691228d5dfef32a804fd4d7cc3a95aff0060ebb8b0d452e16360f05d40dd476fa115bb7ff1135bbdb474fb54d0caf2239789f68c04da401e84f3f5a53bef15708f6677df18501d06c1c8e56e4807eaa7fc2acfc233ff0014a4e3d2edbff415af1a9f5dd4efecd6dafef66b9c36ecc8e4f3cf6fa1af46f871e2fd1b43d0a7b5d46e8c3235c1751b49e3007f4a15f975561bb2968cf5da2b975f889e166ff98aa0faa37f856fe9fa85a6ab649796532cd6f2676baf438383fa8a4059a28a2800a28a2800ac7f115a5bb787efd8a6dd96f230d8c57f84f5c75fc6b629b24692c6d1c8a191815653d083da803c37e1e787b4ef116b1749a9333ac31865843952fce3391ce071f98ad2f1af86b49d27c4fe17b1d3ed7ca8af6e824ebe6336f5dca31c9e3827a56cbfc258e3bd79ac7599ad9093b14479651e9bb70a49fe15c5b0cf79e20b9758d4b1764fba0724f24d69757dc9b1e42e9796dacdd5bdc249108dd8794eb82b835d2783aca0d4fc5ba7da5d462481dc9743d0e149fe9546eeded350d5c58f867edda91446799a48b6f0bdd47a7d7d6a0d2f529f4ad4adefed88f36070eb9e87d41fa8e2afa127d043c2da08e9a459ff00dfa14f1e1bd1074d2acffefcad3f43d66db5ed261bfb56cab8c32f746eea6b46b1bb343e74f12db4361e25d4adad976c31dc32a2ff007467a57bf68e08d12c01ebf668f3ff007c8af03f169cf8bb56ff00afa907eb5eff0062562d32d5598281120e4e3b0aa96c895b96a8a40ca7a107e8696a0a0a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800af9afc6fa98d5fc63a8dd23ee884be5c67b155f9463f2cfe35ef9e2ad4c68fe18d42f776d648884ff0078f03f535f3495cd0055bb6090e4b8439e1bd2a8beac07950e43b921176a925893c547af4ec248e1456242e4e077358301bcb5d4adaf92da573048af8d879c1cd5a7644b5767aeda7c3bd7a7b688cb35b4400e03125b9e79c55b8be1adf0558e5d4a32abfdd4248fcea2b2f892c204f39248b2323cd8caff00315a10fc44b77e3cc889f6715cd2a958d14604f6bf0e6d2220dc5f5d4847f75140fe75df787e78f40d1e1d3608e492288b10cf8cf2c4f6fad711178e6ddfae0fd0d5f8bc6566d8cb0acdd4abd4ae589dfaebea7ef40df91ff0a9575cb73d548fa9c570f1f89ec1ff00e5a2d594d7acdfa4a3f3a5ed66b741ca8ed9754b66e8c7f4ff001a956f616ee7f2ae31355b6703128fceaca5ec47a4a0d52aefaa1721d60b988ff17e94f13467f8c572a2f107fcb45a78be23eeb0fcea95788b919d3f9b1938f3173f5a8af6dd6f6c2e2d4c9b04d1347b872464633fad73dfda129e8c3f3a3fb4641db3f9557b68872b2e7853c356fe17d1d6c62904efbd99a6f2c2b364e707af4af36f895e10fec9b96d66c2202ca76fdf22ff00cb290f7fa1fd0fd6bbf5d4dffbb51dd5e4579692db5c47be1954aba37420d52ad1bdee2706790785fc6d7be149e53046b3c128f9e076c0cf620f635d21f8cbaa48d84d2ad57eacc6b9dd4edf4ff0f6c816c92f1a567705ce084cfcbfa52e872e93aa999a5b116c91100b99885e7df8aeae54ccf632ee6fa4bfd4e6beb823cd9a532be060649c9ae9f53f10de6a70d95b34c56dada15409bbef38cfcff96063daa4baf0a5a229b8de9e411b861f3f2f7e6b95b5b59ef49fb35b4b37390b1a162076e95cf89c2caae8a5646d4aaaa7d2e763e18bff00ecdd7a0b8b99c9895d8954e4e083818ef5e909e33d21ce374ebf58ebc6a0f0d6bb23031695780f62622bfa9abc9e0af12cbd6c9d7fdf957fc6950c2aa316b982ad6751dda3d7bfe12cd140cbde04ff007948a17c5de1f6ff0098b5a8ff0079f1fcebca93e1debf27de5b74ff007a5ff0aa7ae783b50d034f4bcbb9add91a411ed8d8939209ee07a56ea11ee65767bcc7224d12cb1b8747019594e4107bd3aa9690bb345b15f4b78c7fe3a2aed645051451400514514011cd3c36d119679638a31d5e460a07e26b2eefc53a2593aa4da8c3b997701192fc7fc073e959de3bd06ff5ed1520d3e2b49a5493734374ccaae31d8a91835e437be0ad5f4f04de783afc27fcf4d2ef7ccffc770c7f95007b0bf8f3414fbb3caffeec47fad5693e22e92bf721ba7fa281fd6bc3a516b68dcea9ad69cc3fe59df5892a3f107fa558b692eee1b6d9f88746b93d96663013ff007d851fad1a01ebb2fc4b807faad3646ff7e50bfd0d5393e255d9ff0055a7c2bfef396ff0af3a74f11db732e882e93fbd633aca3ff1d2d555f5f8e06db79637b6cddc49174a7a01e8b27c44d5dbee456c9ff0027fad567f1debcfd2e634ff007625fea2b88875fd2e6200bc4463d9c15fd48c55f8e5865198a7864ff72456fe4680362ff59bfd621f2750b869e2dc1bcb6036e47b74aad1416cbd20887d1055750c392a71f4a9e37a605e8d221d234ffbe45594c01c0154a37ab28d4c44cca18608047bd529f4eb39bfd6da4127fbd183fd2ae839a461401cedd7863459fef69b6ea7d625f2cffe3b8acc93c21a729cc2f790ff00b972e47ea4d75ceb55644a5603946f0e3c7feab54bb5ff00782b7f4a89b48d5e3e61d5e36f692df1fa86fe95d348b5011834b950ce7447e2780f0d6528ff00664653fa8a95752f12c3f7b4f66c7fcf3b853fcf15b9452e5417662ffc257ab5b9fdf69da82fb88b78fcc66a48fe21f9471299e33e9242c3fa56b52100f500fd697b38f61dd9043f11607c017717d0b62b421f1cc6e389636fa30acf96ced25ff5b6d03ffbf183fceb3ee344d01f996d6d53fdd3b3f91153ec623e66752be32c9ea0fe356a0f139bb905bc6b9793e515e753691e1b8f95bb684ffd33b93fe26b7fc0da658bea9717365a84f3f91111b6624a863d3b7d69c6845b0e7657f14196eb54b8b88a68d61853cb01b39c28c1edeb9ab5e1fd0cdcf85db7861249fbe1b064e49e38fa5675ee99a85d37d984407992052e5b1c679eb5d7691aad8db6a6fa579fb6e2241f26c24738c723f9574c526db919cb5562b6a6b369de15f2e46c34a56345ee0118fe42bacf869a68b6d126bd6187b87dabfee2f03f526b8cf15de1bdd46d6ca33b8c6bb8e3bb3702bd7748b05d3348b5b25e7c98c293ea7b9fcf3455765608a2ed1451581415e57f143c63a6472c1e1ffdefdad6e937b15c22e533c9cffb62bd52be77f89fe1ad4ae3e20dc6a2d66ff639a5455762155808d0707393ce474a6af7d04cfa434fc0d36d71d3c94fe42acd456d1f936b0c5fdc455fc854b4861451450014514500145145003248a39576c91a38f46506b98f10f827c357da65dcb2e8765e7ac2ecb2471046dc0120e5704d75550ddaefb29d3fbd1b0fd2803e55bfd3e2b4d4255b669210b1abaec7239201af4ed13c05e20bcd02cb51d33c61709f688839b7b9432203e9c93fcabcff00578c8d4c71f7adc7e9815ef7f0ee4f37c05a4b7a46cbf93b0a4079edf7803c6473e769de1bd507af922173f8a85fe75cdddf84eeacc9fed4f005fa63ac9a65d1603dff008c57d1b45303e582da0c52325beafae69922920a4f0eeda47625483fa55bb67bc93e5b1f17e9d3fa2dd831b1fc5d7fad47e2a40be2dd6548ff0097d9bff4335c9eb20431c6d1aaa92d8381d6803bfdfe2eb61b85859dea0ead6d2ac991ff00006a77fc25d3da61750d02f6dcf76073fa103f9d79525f4f11ca3907d4122bb0d22e75d92d925b5d6ae23c807634848a1cac3b5ceb62f1de8c7ef9b888fa3c5fe06b42dfc55a25ce366a11293da4ca7f3ae32e2f3c40f9fb4dbe9f7a3b9781371fc700d538eead52eedcea3e1b4589664691a0675ca03c8ea47228530e53d30df59b26e175015f5f30566dcebba5424abdec448ea14eefe55e757934b77753cedb8ab499c1ede9fa557d8dfdd3f95592773378a74b19daf23fd10ff5aa32f8aad7f82095beb815c9b657aa9fcaad697632eab3b451feef6e325fdf3fe14681a9b0fe2a73c476a3fe04f9aaafe27bd3f75215ff008093fd6ad47e1a9dadcbb5d80216e36a73dbbd735aacb1d8ea775684b3345215dfc0cfe14ae83534e4f116a4dd260bf4515524d5f5093ef5dcbf8363f956399d9fa5c63ea94dfdfb7dd991bfe05b7f9d174068c9733bfdf9a46fab13501258f726ab092e53f85bf0e68fb648bf787e6b45c09882bd548fc2ba68aee5d0bc10d3c5218ae2f660148383b7ff00d43f5ae6a0b969a548907ccec14007b9ad3f1ccc05e5969ab9f2eda1cb01ea7ffac3f5aa83dd899b3e14d7756d5b558e192fa69218d0b32962471c0ebef5d4db69206bcfa8bc3867c1628de9deb8bf04dcc7a4583dec90976b893cb5e7180bff00ebfd2bd0b51bc5834992e23e0ba145e7b9e3fad690b35664df5b15fc2d6835cf1aa4841312ca653feea741f9e3f3af67af3df85da67976b77a8b0fbc4431fd0727f98fcabd0ab2a8eecb414514540c2b82f88e3ccb9d161fef4adfa9515ded70be381e6788fc3b17f7a703f3751550dc4f63d2e8a28a91851451400514514005145437575058dacb75752ac5044a59dd8f0a3d68026a4719461ea2b9693e2068925bcafa6bcba8c91758e0420fe05b00fe1935cdb7c6bd1d217f374ad444ab9051421c7d492280387d76c36ead08c7fcb2913fef9723fa57ad7c35e3c09a7aff00777ffe844ff5af36d46eedb5396c2fad583c3399ca91eeee715e91f0d9b3e0cb61fdd665a480eb68a28a607ccfe324dbe33d647fd3dc87ff001e35c6eba316b19ff6ff00a5777e384dbe36d5c7fd3c31fcf9ae275f4ff4053e920fe468039be48ce38abf63abdd58616260547f09acf39a558f72bb7f740a2c07550f8a9b8f36061feeb035a30f892ce5c069361ff6c62b878e292e2454452cc7801475ab93e9f3da401e528149c6dde0907dc75152e087cccee12f6d2e07caf1b7d0d0d142fd315e7e36e47ca41f50715efbf07bc37a4ebde06925d52cd2e265bb7412313b800178c834b92c1cc79e9b28dba115a3a35a8b7b82c3bb28fd4d7ad5efc27d0a7c9b59eeed5bb0570ebf9119fd6b95d63c0f3785d619cdfadcc72cc88a3cbda473f53424d31dcc68ff00e3c2effdf3fc85715af692b3eb57726ce5a42735dd470b7f67de9f463ffa08acbd4ede7b6bf96496d655899b2b23210a47b1a6dd848e09f41f4245577d1a74fbae7f2aef01b793a814d6b385fa1153cec7ca79fb585d2760699fe9518c157c577eda6464718355a4d217190b4f9c5ca73be1b656d72192687222064c0519e3ff00d75d4df693a3ead7af732dc4f04d263716eddb8e0ff3aad6b622dae37edc6411534b5d34f58dc8968cdcb7d3b4eb7d160b0b6bc85fcb6c9762324e739c5335a91552ded63c151f39fe95cace71d2aff86c79da9c11b92ca678d707d3355cdaec23debc316074bf0e595b30c3f97bdffde6e4ff003c56be69838181466b9dbb963f3466999a5cd003f35c3f8a7f79e3bf0ca7a4e8dff9107f8576b9ae275df9fe2578793d36b7fe3c7fc2aa1b899e974514548c28a28a0028a28a002b37c41672ea3e1ed42d2050d34b6eeb1827196c71fae2b4a8a00f15d66e2ff402f1ea5a1225bc9732c914ad8dcfbb07ef29383dbf0af3bd66ef4dd4b529a6d40dcdbb39c2346aae853dc64127d4e6bea8bab4b7bdb7682ea08e785baa48a181fc0d79dfc4cf0469727826f27d2b44b717d6e032341161c2e46ec63af19a4b4d00f2fd3a51696d6d0d85dda6a10c6ece116731c8bb87236c807e84d7a4781bc67a4e83a30d3b5c69f4c9fcd664fb4c2c11813c618022b82b64f0b496d6765a4959c2c9ba51347890e557ef703386c8e2bb1f07f82edf59d0ef045a8ded93c77522048dc3c4573c6636041fd2803d4b4fd5b4ed563f334fbeb7ba4f58640d8fcaac4f710dac2d35c4d1c312fde79182a8fa935e41a87c2bd4ed499ed21b0bc9179596d5dacae07d3194fcc5606ac9e26b7d3dec354d435482d372b18f57b6f3e1254e4032a027a8f4a606478db5cd32e7c65a94d05dc6f13cdf2b0e41c0033f4e3ad725acde5b4d68f0c72879038fbbc8fcfa54b27862fa7d45ee8dafdbe0392574e995f1ee00c9007b8a6c8b6935b3590bf6b52303cbbd84ae31d832e7f5028039a20ab107822954b00c1790c306b465d12f541648c4f18192f6ee24007afca4e2b33ec3b5be498ab7a1e298892391ede64752430e415c822aedd5db5e0f3249647918827cc393d31d6a186250b8925955bd76075fe869cd0b74478e4ff75b07f238a0062a9760aa315eb1e01f154fe1ad39218c848646f3442cc4973dcfa735e5211ade4477474607237822bd6fe1df85a5f16d9c7704c2b696f26c798fdfe07dd03e87af4a181efb6b3add5a4370a0859635700fa119ae67c790f9ba659fb5dc5fab815d4c71ac51246830a8a140f402b0bc5a9bf4b83daee0ff00d1a9498cf3f8acbfe255ab9c7dc76ffd16a6bd47488c2e916f1919017041ae223880d2bc403fba49ff00c84b5ded90c59c607a524050bbf0b6857c4b5c69368cc7ab088293f88ac5bbf865e1db807ca4b8b56f58a527f46cd763451603cc6e7e1348a4fd8f58e3b2cd17f507fa5635efc38f125aae615b6bb1e914b83f9362bd9e8a5ca87767ceba9e8faae96aa750b09add4b60338e09f407a563cd5ec5f164ff00c486c47fd3d7fec8d5e39377ae8a6ad03393d4ce9eb4bc2633ad5a0f5ba8ff00f4215993d6b783c675db11eb791ffe8428ea07d0d9a5cd459a5cd62592668cd479a33401266b8bd44eff008afa2aff0076207ff43aec335c693e6fc60b15fee43ffb2b1feb551133d3a8a28a91851451400514514005145140051451401e37f10349b683c5526ac8ac2e03c30e01c295383d3d6b0bc19f11b53f0fc9796b77a54120927de6333886519f40dc37e75d5fc493b6fe7f67b77ffd0bfc2acfc3fb2b2d4df5ab5beb582e622d136c99030fba7d6901b963f137c3972e90decd369572c3222bf88c59f70df748f7cd75905c417902cb04b1cd0b8e1d18329fc45719aafc2ed16f222b612dc69bce7cb89bcc849f78df2bf962b90bcf873e24d09fcfd1a4df8eafa65c1b691bdda26cc67fe038a6061fc4cd3ed6d7c7373e44090e52371e50d9c91d78ae52ef52be584bcf38bc45c7eeef2359723d324647e75a7e253ac4ba986d5af41bef2d54c5a845f659768ce39fb8c3af3bb9ac2d445c5a5b017b693db890651dd728ff00eeb0e0fe140103cba2dc3877d326b197fbf6331c0f7daf9ffd0a992e8f05d3196d35a82e58ff00cb2bd53149f99e3ff1eaacbb5c65483f4a0c40f502ab94570b8d1ef2c903dd58dd4319e92c389233f43d3f5aa8620e408e6826f627637e4d5a16d3dd59b16b4b99a027af96e466af59ea48d790ff006ad85a5f41e62990bc7b1f6e79f9971fae69598ee8a569a3eb3241e64369749113804afcac7af7e0d74be17f0c6b57cce34ebc82cb550c4240d23db4b200324ab2f07e86ba6f16f8bad6c7cf8349b60d67f674d9191c07c6430fa67f4ae5b5a8b53d2e3b1bdb8bddd2dc422589e1ca328393d4742286e3f30d4e97fb67e2bf855f75cc17d736e9d567816e531fefa7cdfad6c68bf13aefc625f4dbcd3a082589e294c90c87071320c6d3c8ebeb5c2699f10fc61a54598f5ab99a139005caaca07e2c33fad575f12ebfaa5f6f6bb9a5b86eaf1c2a64c6e07a819c6714582e7b3a9ff41f122ffb24ff00e43ffeb5771612a496aa15d58af0c01ce0fbd7caf7ba96a626b882eef6f4cbbf6c88eecbbb1c7cc0ff005adfd0be1f788f5ad217c41e1fbd48646764f284ef14995f461c1fc714ad603e93a2be7b4d77e2b784016bd86f6e2d93ef7daa0f3e31f574e47e75b1a57c7d2595355d1323bc9672e7ff001d6ff1a00f6ca2b89d37e2cf83751c03aaada487aa5da1888fc4f1fad75f697d697f089acee61b888f4789c303f88a2c070df167fe407623fe9e7ff6535e37377af62f8b5ff206b0ff00af83ff00a09af1c9bbd6f0f8487b99d3d6cf82c67c41a78ffa7b43fa8ac59eb73c1033e22d3c7fd3c834ba81ef79a335c9f8ebc573784f4786f2082399e59847890900704e78fa55ff000b6af3eb7e1bb3d4ae163596752c446085fbc4719fa56259bbba9735106a375004b9ae334f3e67c653fec45ffb4bff00af5d7eeae3fc3ffbdf8c37adfdc84ffe80a2aa3d44cf53a28a2a46145145001451450014515c7c9e2dbe7bbbe8c69a61b3b7b86b6fb4a49e63923ab7978e83eb401d8515e3fabf8bbc556f2cd676fabc067689a7b4923811bce51d4608e0f5eb5c68bef1ff00897c4726849aedca5fa6e1240f30836ed1cf0bc53b01de7c50f96f263eb6f19fc8b7f8d4ff000be5ceb3aaa7f7a346fe42b89bff000eeb3e1ab196d35bba4b9b99a36943acad271951825803eb5d4fc2e97fe2a8bb5fef5a03fa8ff0a903d728a28a607847c660078cadf2010d62879ff7dc579fc52cd6c8df659e5873d551be56faaf435e87f1bc6cf13e9d27f7acf1f93b7f8d798c921fb3c9b7aed38a0074d756739db7763049281932da9f224c7b800aff00e3a29a6d6d9a3df65aa60f786fa3d87f075ca9fc71468b702cf4dbf8ae6d91fed4f1fef5bef2aae4903ea71f955f5468d4ae23fb394f9401fe7de8bbb87433668aeed23592eace4585ba4d1fef233f461c5323961987eee453ed9ab91c6d0316b7964849ebe5b119fa8aad753c4edb2eec61b83da541e5483f15e0fe20d5ea84591abdb5b2aa5e12df2ed5dbc9fc6b6f55bf3e26b4b28ede10bf658fcbc33804af63edf4ae424d3aca52b245752c2e3fe59dd212bf83aff502b461b9bab4894b5bb084365a6b522453f5c74acda57b8f5b16f57f0ceb7a1421b50b09a2b79002930f9a339e8430e2a4f02dc41a6f889e6ba99228de0640ee7033b9481fa57a1f887c5ba2eb5f08d74bd33578a6bf822884b03fc9210b80d80d8ce3dbb0acc8e2f01789b42b6b4b1827b3d6e0b44decaa543b2a8dc4f507904e7826a8471de259e2baf13ea534122c913dc31475390c33d41ad2d1fc2be317b01abe851deac5b8a96b3badaf91ea99e6b66dfe1cdb7da3528e5d42561691875db181bb3bbaf27fbbfad7b2782349b6d1bc2b696d6a6428c3cd2646c9cb75a2e078bdb7c52f1c786a6fb2eaa16e4aff00cb2d46d8c32e3fde18cfd4e6b46f7e2378735ed22e25d5bc150b5e6309202ac8cdeee30c3f0af72bab2b5be88c5776d0cf19fe195030fd6bcc7c7bf0d6c12cd352f0f69b15bcd149baea388950f1f7217a647b7bd2b8cf15b41a76a1a925bddffc4b2c24724bc40b88b8eb862491ed9a596d0697aa88f43d724b904fcb2d9472c6e7fe03ff00d7a4d4acae25d55e1b5b6964738da891924fe02bd1be1b7896c7c06b7b65e25b0bdd3e6b991648e492d9800b8c60e79fd29a7d44734353f144bb34fd7e7d41e254f3a04be8f6b75c6464648eb504d5d67c40d6f4dd77c5905d6977b15d422c554b467383bcf07d0d725356f1f8497b99b3d6ff0081067c49603fe9b13fa1ae7e7ae8bc0033e27b01fedb9ffc70d401d27c697ff8a6ec17d6ebff006535d478046df02e903fe98e7f535c9fc6347b8d2b4b8108dcd70c79381c2d75de0b1b3c19a4a820e2dd7383deb32ce8b3466a3dd46ea40499ae53c1bfbdf8abacbff76071ff008f20ae9f75733e001e67c43f104be88c3f371fe154b66267a8d14515230a28a2800a28a2800af3af167823537966d4343b991e592669a4b72db7938fba7f0ef5e8b450078049e0ef175cfda2eee3423760904891c4730206328c0e7f0391ed58ba4de2d9f89a0f1069d78c6fe172b2c3a9b15dc71b4af9a3e53c7aedafa66bc86e34cf107802692082db4fd4bc3d7fa92e639222f22f9879047b01d79fd69a039ff1578be7d76e986a7a7ff664a91797146cc5b78241c86c007a76ad6f85d27fc560467efd97f23573c7be1ab3d03c993485f221b812192d241e6c04819e11b217f0c63b570fa25dcba55fa5ee97e7e9d7c232ca614373032770c872ca3dc671480fa528af30d27e2acd0c0afaf69c1edfa7dbf4d3e6c5ff00035fbc87ebf9577ba46bfa4ebd6c2e34bbf82e50f508df32fd4751f8d007917c774c6a9a349fde8641f930ff001af2a84e5c0f535eb9f1e97e7d09fda71ffa0578fc2dfbc5fad00696d18c606298cf1c2bc9014536e2e1608cb13cd7357f7b24ec403c7a568dd893a25bdb76fbae0fd066849ade66e080de87ad72d6e72ca80904f079a991e69253b033907207534b982c755b148c1008aef7e1d780f45f14e9fa935d89e1b8864411cd6d29465041cf1d0f4f4af28b7d466894172597b8c7f5af77f81f7092d96ac54fde788807a9e1a87aa0463ebff047510a5b4cbcb5d413fb9749e54a3e8ebc1fc715cfe85e14d57c39af6350d2ef2d0082601dc7991b657a09071f857d25587e2f38f0cdd9ff0066a0a3854902ea3adee20036c8493f592bbbf095cc575e18b2789d5c08c29c1e847515e7a02cba96a91b80caf6aa083df97aeefc0d6f0db7842c160408ac81ce3b923934901d153648d268da39115d1c619586411e869d4530238e0861004712260051b540e07414dbab3b6bd84c3776f14f11ea92a061f91a9a8a00f1cf88be13d13c3ef6b79a558adacb74ceb2ac64ec38c1185e83af6af3b9ebd77e2e9ff44d287fb727f25af219eb78fc243dcce9eba4f87a33e27b2f6f30ff00e38d5cd4f5d37c3cff009196d4fa2c9ffa09a8633b2f883e1ebbd7ad6c9ad8c3e5da33c928909e576f60073d2b43c0b1c50784ad2389cb8190491df3ce3dab7c9c8c1aab6166b602748c8f29e53222018d99ea3f3c9fc6b328bd9a3351e6977500499ae7be1a0dfe2cf124be8c07e6edfe15bbbab0be14fcfaaf88e4fef4cbff00a13d35b311e9f4514521851451400514514005145140051451401c27c4e8b769d64f8e8f22fe69ff00d6ae0fe1f36cf19e907b14953ff1dffeb57a37c475ce836ede972a3f35615e2e9a85de91026a1632797756fe618df00e0e4f63480f75d67c11a26af21b930b595e0ff97ab36f29ff001c70df8835e53e29f0fc3e1bbb6bd9754b194af227b2b95b4bc1ee501daff8004d79e6a5e27f136bb295bcd52fae377fcb31210bf828e3f4a974ef02789f5861f66d1ef1c37f1bc6517fefa6c0fd6aac1736b5cd4759f1759db449aac5abad9ee31aba88ae70d8ce54fdfe83a126b8a9a49ed6629242d148a795704107e95e91a6fc0ff13ca55ae25b4b4ff7a5dc47fdf20ff3ab92f83ef5341d6daeaf61d41345959258af6dd80640a1bf77267703d78e9d0f7a40795ba5dde32911cb20239da9800d357c3d7d20cb2227fbcdfe15bf0bd8dc2a3e997cf665bfe5def7e68f3e8b20e9f881f5a9a6b99ec485d46d5e107812a7cf1b7b861c1ad23caf725dce565f0fdd45c9909c7751551ed66b73904ba8ea31cd77a9247326e8dd5d7d54e6a37b681b978d4fd455382e82b9c6c3bee502448ecdd3006715d9e9c66d3ede1114af1ca8bf7a362a41fa8a558d2218440a3d852134d46c17b9d9e93f13bc41a6058e7952fa25ed38f9b1fef0e7f3cd75377f11b4cf126873d88826b6bd742446df329c0c9c30f6f502bc7cb55dd19b1aac7fee49ff00a0354ca2ac34cf4089bfe26d7bef6e3f9b7f8d7a0f81db7783f4e3ff004c97f90af3789ffe26971ef00fe749a57c4c97c2f159e9d3d825cd98b78db7236d91495e7d8fd38ac52b94cf6aa2b92d17e24f8675a611a5f0b59cff00cb3ba1e5e7e87a1fcebab4759103a30653d083906980eaa9a86a963a4dbf9f7f770db459c069180c9f41eb56ebe71f8dba9473ebb188efda7203279382a200a7047b9273cd2b81da7c4cd6b4cd62db4d6d3afa0ba11bca1c44e095385ea3b57984f58de152c45d923fbbfd6b627ae88fc243dcce9eba8f877ff231c1ed1c87f4ae5a7aeabe1cff00c8c49ed13d431a3d7334b9a6668cd6650fcd19a666973400ecd62fc20f9ffb724fef4ebffb356bb36149f41593f060674ad564fef5c28ffc77ff00af4d6cc47a75145148614514500145145001451450014514500729f1097778601feedcc47ff1ec7f5af23d12dedee359d3ad6e5124864bc08f1b746527907f3afa02f2cadb50b66b6bb812685baa38c8fafd6b91f085b69f69e29f11d9da69cd6e2196228cf1f6d80704f3c9527df39a00ea2cb47d334d4d963a7dadb2fa430aaff215768a28019299042e615569003b558e013db26bc83c6fe19f18cfa06b6e8d1496f772a5ccd6f6e4ef2c00560bea3685ebe95ec545007c97e07f095d6bbe2eb4b73a7dc359c73ab4be6c640080e5b77e031f8d7bceadf0b347b912c9a44b269533f548c6f818ff00b511e08fa62bba0a074007d052d007cf3ab7c2dd5b4cb95924b611a33806fb4e398d013d6488f2077c8e056aeb5a4685e1d8c58dd1864b98a35b8f3dc921c7f74f6e71d315ee0e8b2232380cac3041ee2be7af1bf84f528b54bc86e2299a06c98e61ca941d39f50074a69b40ccbd575ed33523145630c7185c8c940ac7278fc318fd6b299d5582bb84e704b76a6ebb0a5bc1671a47182a83255403902b1f21a22e58f983aa9efef9aa8cdb57138d8d137484e172c7d16920d4a4b6b81344abb80206ef7047f5accb59b75c2e494c72a41c106b6f4c0bfda90923716639279ce41a776d082e35fd4a77767b992276503110db91fceb3fccdd93cfe2735a9e27ff0090cb1f58d3f9563b0298cf719a988d8135aba478b35cd01f3a6ea53c2bde3ddb90ff00c04f158ccd519354c47af687f1cee62c45ae69c938ff009ed6c76b7e2a783f8115ca78c74db1f19eb72eabe1cbe8266b83b9ec2e5c432a31ebb7710ac33cf07bd7125a9a4d4d8773b087c19ab784ed23975585206bdc98e212076017b9c6473bbd6ab4f55f47bcba9edde09ae25921871e5a3b921339ce01e99c0fcaa79cd6abe125ee674f5d67c38ff91833e903ff00315c94e6badf871ff21d7f681bf98acd8d1eadba8dd51efa37d41449ba973516ea766801978fe5d8dc3ff76363fa555f82ebff0014d5fbfadde3f245ff001a8f5ebc82cf41be9a799225103805d80c9da702acfc1800f836790721ef1883ea36253e823d168a28a430a28a2800a28a2800a28a2800a28a280239fcdfb3c9e46cf3b69d9bfeeeeed9f6af3db6d17c66be2b3a8c4c96c27da2ede4955e39141e02a8e781d33ea6bd1a8a0028a28a0028a28a0028a28a0029080c304023d0d2d1401cb6b9f0f3c39afdcadc5dd9b47283cb40e63ddf502bcebe237c34d13c3be19b8d674c6ba8de2641e4b387420903b8c8ebeb5edd54f54d32cf59d327d3afe1135acebb5d0f7eff009e79a00f9ca1f867a8ea7a7dbdde917ba76a2f2c0b31b78a70b2a6467041f4e9d6b127d1b5ad12fe1b5bbb39ece776c466542013ec7a7e55ed9a2fc308fc39e3fb3d5b4a2a9a6436ecaeb2ca5a4672a578e3a722bb0f14c2937867500e8adb612c370ce08e41fad3b8ac7cf56de1a6babb53a85dbc859371da79edc64fd6b135ab586cee2148576868433739c9c91fd2bbab53fe950fbc1fd16b93f12e93a9cab1ea5059cf25947108de645dcaac198e0e3a7045098da39c26985a99e6e473f98a4273d39a62149a4cd373499a00dbd08fcb71ff0001feb5766359fa21c473fd47f5ab73356abe127a94a63cd75df0e8e35a94fa5b9fe62b8e98f35d6fc3c6c6af39ff00a61ffb30acd8d1ea3e6526faade652892a0a2d07a786aaaaf52ab500707f171679740b648338deecd804e46318fd7f4af40f8296c6dfe1cdb925b324f23fcdd4745ffd96b9df166a9651685796cd75109de3dab1eecb13f4aecbe152edf87ba79c63734a7ebfbc6a7d047674514521851451400514514005145140051451400514514005145140051451400514514005145140051451400566f8806ef0f6a03fe9ddff009569550d6c6742bf1ff4c1ff0091a00f0fb43fbfb7ff00ae03f92d7a37c35ff9015c83ff003dcd79c59ffadb5ffaf71fc857a0f802eadecbc39793dd4f1c30a4edb9e460aa3f134805f137c30f0df8803c82dbec376dcf9f6a02e4fbaf43fcfdebc7fc47f0a3c41a2132da20d4ad873bedfefafd53afe59af53d7fe2f786f4bdd1da4926a33fa403083eac7fa66bcc35ff008bbe21d5098ec8c7a741ff004c865cfd58ff00402a80e05f7c4ec92a15753860c3041f7a8da551d39ae8b4df0978abc5f706e6d6c2eaeccadf35cca70a4ffbedc1aeb2f3e02f8920d2c5c4377657374396b64620ff00c0588009fae2988e234290b4539f7157666acbbbb0d57c3578d6b7d693da4c7929326370f51ea3dc5397525946245da7d474ab5256b09a1d29aeb7e1f36352b93ff4c3fa8ae3dd83720e4569e87ae49a24934b142b23c88146e3c0e7352c67afefaa379aee9ba7922e6f23461fc20e5bf21cd7965ff8af52bc2c25bc6553ff002ce2f947e9fd6b15aed8fdd5c7b9a9b01e9779f10e24cad8da33fa3cc703f215cbea1e31d4ef77096f9954ff00cb387e51f4e3fa9ac5d3349d575eb836fa759dc5dc8392b121217ebd87e35e8fa0fc0cd6ef5565d5eee1d3e33ff2cd7f7927e9c0fccd3d101e6af7ae7ee803dcf35f527c364d9f0ef45c800980b1c7bb13fd6b8af871f0f34949f5b4d52cedafcda5eb5b44f2a9270bd78ce3b8edeb5eb90c315bc290c11a47120daa8830147a0149bb80fa28a290c28a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a0028a28a002a96ae33a35e8ff00a60ffc8d5daaba98dda55d8eb985ff0091a00f09b4e26b6ffae3fe15cfeb5a3eafae5fdbda69967737402b1291292aa77b727b0fa9adb8ae22864b5779142b2155e7a9f41eb5ea9f0eed2e6d748ba3736b3db99272ca268ca12bd8e0f3de840799685f03356bc559759bd8ac50ff00cb28c79927e3d87e66bd3341f85fe15d0511934f5bbb85ff0096f77fbc627e9f747e02bb2a28011542a85500003000ed4b4514014f52d274fd62d4db6a3670dd427f82540c07d3d2bca7c4df026c6e3ceb9f0f5db5ac982c2d66cbc64fa06ea3f1cd7b151401f134a935a5ccd6d323c53c2e639237182ac3a834c0ef249b3249270057bb7c6af0ccb3cd06b10db06b768ca5c3a2f2ae3eeb311ec719f6af1fd1bc3b79e22f11269d656d33c8c548645f950646589f4a7711d9787fe0af89756092df1874db73ce653b9c8f651fd48a350f82fe27b3d79edece24bdb0ff009653ee54cffbc09e315f48411f930471673b142e7e82a4a5719cdf81bc2e3c25e18834e631bdcf2f3c918e19cfbf52074ad9d4b54b1d22d0dd6a1731dbc20e37b9c73e9ef56eb375bd0b4ef1169cd63a9c1e7404e40c9054fa82280395f875ac58df7f6e4d04c0a5c6a9249131180e180c633df8e95de5735a1781f4af0f47e559c97461de1fcb9241b720e41e00cd74b4005145140051451400514514005145140051451400514514005145140051451400514514005145140051451400514545733adadacb70e18ac485c851924019e0500703e2ff000ed8c9e35f0d5cc082dee27b821de150a4ed1bb3c77ed5e875e47af78bafae6e34cf10c7650adad8dc388e23302ef9186c8c7a7e5ef5e93a0eb76de21d2a3bfb5575463b591c72ac3a8fd68b3034e8a28a0028a28a0028a28a00e5bc63e33b2f0cc2b6d2412dcdedcc6c61851783dbe627b67ea6b1fe1b6a36369a341a6dc40b67a83cd2261902998824f5ee403d0fa5763abe87a66bb6eb06a5689708a72a4e4329f50c391f8567699e09d0348be5bdb5b3637299d924b33c8573d480c4807de9e8074345145200a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a28a2800a08c8c1a28a00c1b8f05786eeae0cf368f6c642727682a09f700806b66dad60b3b7582da18e18506152350aa3f0152d140051451400514514005145140051451400514514005145140051451400514514005145140051451401fffd90d0a656e6473747265616d0d656e646f626a0d32352030206f626a0d3c3c2f42697473506572436f6d706f6e656e742038202f436f6c6f725370616365202f446576696365524742202f46696c746572202f4443544465636f6465202f486569676874203730202f4c656e6774682032373730202f53756274797065202f496d616765202f54797065202f584f626a656374202f5769647468203130373e3e0d0a73747265616d0d0affd8ffe000104a46494600010100000100010000ffdb004300080606070605080707070909080a0c140d0c0b0b0c1912130f141d1a1f1e1d1a1c1c20242e2720222c231c1c2837292c30313434341f27393d38323c2e333432ffdb0043010909090c0b0c180d0d1832211c213232323232323232323232323232323232323232323232323232323232323232323232323232323232323232323232323232ffc00011080046006b03012200021101031101ffc4001f0000010501010101010100000000000000000102030405060708090a0bffc400b5100002010303020403050504040000017d01020300041105122131410613516107227114328191a1082342b1c11552d1f02433627282090a161718191a25262728292a3435363738393a434445464748494a535455565758595a636465666768696a737475767778797a838485868788898a92939495969798999aa2a3a4a5a6a7a8a9aab2b3b4b5b6b7b8b9bac2c3c4c5c6c7c8c9cad2d3d4d5d6d7d8d9dae1e2e3e4e5e6e7e8e9eaf1f2f3f4f5f6f7f8f9faffc4001f0100030101010101010101010000000000000102030405060708090a0bffc400b51100020102040403040705040400010277000102031104052131061241510761711322328108144291a1b1c109233352f0156272d10a162434e125f11718191a262728292a35363738393a434445464748494a535455565758595a636465666768696a737475767778797a82838485868788898a92939495969798999aa2a3a4a5a6a7a8a9aab2b3b4b5b6b7b8b9bac2c3c4c5c6c7c8c9cad2d3d4d5d6d7d8d9dae2e3e4e5e6e7e8e9eaf2f3f4f5f6f7f8f9faffda000c03010002110311003f00f7fa28a2800a2b335ed524d174993504b5fb4ac254c881c29084e0904f1c673cf6cd416fe28d3a4996dee8c9a7dcb7021bc5f2cb1ff65beeb7fc049a87520a5cadea6f1c3559c3da46375e5e5e5bfe06c48eb146d239c2a82c4fa0154745d62d75ed2a1d42d18f9720e55bef2377523d4557f154ed078575268cfef1e06890ff00b4ff002afeac2b32780f86e74d4ecd19ad046b1df40a33945181281fde51d7d57e82b9eb62952ab184b666d470f0a946ff0069bb2eda2d57cefa79e9d4eae8a624d14902ce922b44ca1d5c1e0ae339cfa5721aa6b9a85e40fa9e98e63d2ac1c4acfb72d78aac3785f440bbb9fe23edd76ab5e1495e4cca861a75a5cab4f37dfa2f56f4b7e899d95148acae81d482ac3208ee2aa5feada7e9681afaf218377dd0ee0337d0753f8568da4aecc63094e5cb15765ca2b2f47d76db5c6b936715c08addc466496231866c64800f3c0c7503a8ad4a232525743a94e74e5c935661451453202a95c6b1a6da5dada5cdf5bc170cbb96396408587a8cf5fc2aed62789345fed4b58ee208a27beb425e012805641fc51b67f85871ec707b545472516e2aecdb0f1a72a8a355d93ebf96fd3b9ad3450deda490c8164826428c3a8652306b9dd1145c6952e95a8224f2d8c86d6659543070b8d8c41ebb90a9fc4d41a7e8fa1ea36697b616d258b3e430b591edda37070cac108190720835774ed13fb3b51b8bc17f77706e235475b8656fbb9da72003d091ce7f4af0f158a8d78ad2cd1dbcb4e94274f99dd6a935669ad374dadbf245793c2d699892dae2eadad9268e56b4493742fb18301b5b3b7903eee2b77ad725e28f12de683af69aa91f9960d1bc976a172ca80a8dc3bf1bb3599a878b3504b092686f63890eb8d64b32c1e6ed8766410a3ef1efc75ae37cd2b5d9d4b038bc4c21293ba7b3f56f7d2f7f77cddac6f7fc23d705db4efb585d00b79bf655043927ac59ed1679c75e71d2b7cc31b406028be515d9b31c6dc6318f4ae2c6bd7f6f656d7abab7dbadff00b42282e0bd81b7d91b70786e4f2579acf1e36d55a1d548f2b74db5b49f907cc8663173ebd8d394a52b5dec692c062ebf55a7cb5ba4dbd37d9b6f5b2b9d459e89aa2d8c36575ae4c2da0411a25a2089994703739cb138f4db45dda58f87ed0cba758c4751b8610c0cf9692491ba6e739620724f3d01ade50422866dcc072718cd73f39d54789cde0d20dcdbdb45e5da1370883737df723939e8a38e99f5ad233756695496872d2ad3ab37ccd5b56d6914fcba5eef7bf4b9d0693a747a4e990d9a31728099246eb23939663ee4926aed727a8f89f56d3d13cdd26c92490e2288df33c921f454588926b6345b8d62eadbcfd5acedecd987cb04721765ff0078f4fc067eb5efd2ad4e7eed3e87257c3565175ea35abeeb5f44bfe197e06a514515b9c6158971e2ad3d2ee6b3b54b9bfbb84e2486d622db0ffb4c70a3f135b7599a968569a948b7077dbdea0c477701db22fb67f887b1c8f6aceafb4e5fdddafe66f877479bf7c9dbcbf5eb6f4d4c9d36df52feddb9bf7b38ac6cee50192dccfe63b4a380f8036a923838273815bb58df6ed4349b882db578d668a790430dedbae0331e81d3aa93ea323e95b35f375d4d547ed1599d389e6725276b5b4b6cd2d3d7c9df5ee66dde8d05e6af05fccc584504901888055d5f19cfe55870f80e0b4d2e3b1b3d42783c9bff00b74526c5628db7685e78207bd75d4565763a78dc4534a31969a7e17b7e6fef3027f0edc5fe8d7ba6ea7abcd78972142bb431a188839c8da0679c75f4a85fc1760cfa13091c7f640013007ef7182377e233f8d74b45176358ec44748cacb57a596eb95e8976d3fe0852302c84062a48c061d47bf34b59fae5cdd59687797564a8d710c464512296040e4f008cf19ef41cf4e0e73515bb76326c6d2f7c377735d4d687571293bef63ff8fa55fee95270547a211feed74da76ad63aac4d2595ca4a14e1d7a321f4653ca9f622b222b7f124b124b1ea1a3c91ba865616920c82383feb2a95f78735bbe956e1e5d2a3bb4184ba81258a55ff008106e47b1c8f6af6b0ef134928ca175f23b6a4695777ad38a9774dfe31b7e56f43b0a2b1f448b5fb78fcad66e2caeb0389e10c8e7fde5c60fd463e95b15e945dd5ec799569fb3938a69f9adbf40a28a29999c7eafad59378be2b595de43a745e62dbc31b4923cd20c0c2a827e54cf3d3e7abab2ebfa87fc7ad8c3a7447fe5adeb6f931ed1a1c7e6c3e95bf1c1144ced1c488d21dce55402c7d4fad495c52c142a5473a8ee774b150518a843656d75f5d345abef7397b2d7638348126ab3a25d432bdb4a1579924538f954724b0c3003b1ab5a6eae2fe79ede5b49ecee22dafe4ce00668dbeebe013c1c118ea08e6b422d1b4e83549f538ed2317b3637cc465ba01c7a70074eb8aa9aee8f717ed05d69d7296ba8404a2cccbb818db86523bf661eea3deb92796b516e2f5e85fb4c3549b4972dfabd93ed65d3757df6b2d0ab71e22b4b6d4bec8e921890849ae80fdd43237dd463d89fd3233d455cd52fd34cd32e2f5d0bf949908bd5dba051ee4903f1ab167a3d959e95fd9cb1092065225f37e63296fbccdea4f39ac03a3ea516a761a5306b8d1e39c5cacecd9645404ac4deb87d841ee073c8c98a9974a3cb6d6fb954d61aa4b4d1477bbf892edd9f9766adaa66ae9daa5bea51bf97be39a23b668251b6489bd187f5e87b563e9163ab6a36d751cde21b913dbdc496f2c6d6f0b2e01ca9fb80e0a153f8d6e6aba2477f225d4129b4d462188ee631938feeb0fe25f63f860f3585a56a17369e35365a85b1b6b8bfb7f9b6e4c52c9174746f742720f2360cf626e18354ab253578b34a2d4a9ce5437b5ecd26d5b7b5d6aacf75aab6bdce9748b03a56916b606769c5bc6231230c120703f4c0abb4515eba5656479539b9c9ca5bbd428a28a648514514005145140051451400514514005472c114e6332c6ae6360e848e558771e945140d36b544945145020a28a2803ffd90d0a656e6473747265616d0d656e646f626a0d362030206f626a0d3c3c2f436f6e74656e7473203720302052202f4d65646961426f78205b302030203539352e3235203834312e38355d202f506172656e74203220302052202f5265736f7572636573203c3c2f457874475374617465203c3c2f4753382038203020523e3e202f466f6e74203c3c2f4654313420313420302052202f4654313920313920302052202f4654392039203020523e3e202f584f626a656374203c3c2f494d323420323420302052202f494d3235203235203020523e3e3e3e202f54797065202f506167653e3e0d656e646f626a0d372030206f626a0d3c3c2f46696c746572202f466c6174654465636f6465202f4c656e67746820363536393e3e0d0a73747265616d0d0a789ce53ddb0a25396eef81fe87f33c905a5fe41b8485e9b92c09ec4392867cc09259589884d93ce4f723d9752e96aae4529fee998130ccf6f459ab2cc9badab2fccb077f73f8cf3fd21f15fc56d3ed2f3f7ff8e543281b845b8c9bafb7046e8bf956aadf62b8fdfd3f3ffcc737b7ffc2316e830ab7f1bfa9c11652c46fb8ad417b1915ea96f22d02c1a6e8b60cb718f0bbf93166a0f0f7bfe2e03ffce9dfebedafff4340000434604abe05bf953ef94fdf7cf8570441a02d1f01795fb7166e3e87cd230519d17b803dc7fae6a6c191fe381b1c1322f2189ce3e940f08526dd07a6b0e57a3e3637fabff7b138aa7522711e3936b9bc25f6ddb3b1f7efe24238d8bfeb132de0f977c7d8f1dd792c31da1faf8d27d07d7510a83d81c63fbfae108d31a93c852685424cca2e3e06b9dbff7e08b73fe3bfff82fffe6da7eedffef4e1e3a727a57ff8f153bb8173b74f3f3d6846fe843a3465fc678c752bc913cf1a62fce9e70fffe45cf8f8c74f7fbb8546e33e7d8f3f40ed3f84f8f801d80fa9e00ffff0c327c2404e826249e84f93b8a842e4adb83643c4d827cdf93169a21f7ccaa778a67cf4c3e9acad6cd58427b2776b1ccf50399e1f3916831248e78873d23a836f3ec2254a00102192d689921f5588bc215e16daa191e01a4907be2252b6c40f9a6c41452c7cb1e0dd026a6760b2f51d473cb0254a95ff909449129ab8508201ad843a0e8e11121b430b3a9edebbdb9984cb118212bfa3f1db58386ebc5ce7c2305eeeee42d17879585a2f0f652b3edd4aa1e976962566bc24fd5c95a43513daf79db272be468c37e28485bad4be766f368d6fdaf8963ab7af4fd06a5f428d2d424e2071a3c47f3897a4232442a4c5a9d7b10e284c9c8fb170a43eda4da7a31f624aa7eb0d9a650c35a18501031d95b8bfa043fa2e21849e8308556f5c900f7971eaee504b5d29d7098bb8a201e3c289b0c15c4599a4c5174b284c1627bd13768a56459319b2810ed43f17191d1ded88d49ddafbcfb02362c475e34c43fc8b59f44fb3888a4266510a5edb80c27617508ff2dd25ffd8a7042668af914417c5f644f25b0ea1711f4d7043d879d28503de5a14683636e9e0cceb0f0ccda1d6c1c339615ae050220abf09ef923627d83b14fb95591f8fb8a7f17b4d886a9fbcc3e4207a0b25de45f4d26d458a100cc160cf2132c7bc2f6b693a334ef18c1e13ba68222de2d05839699dc5beb573160bccc53a76ddcde59478554d7c761bbae533520e83a0838f84cd3bfe918f419d17736d389df710a4a01fae99b37038acf2346e5c41bb94be304897da3d68b2e0858eb8640e326cec53c2d230b1e1b94ed1b44eadf5f49be1a50608a8809039bff4100115101cb73ec2060a8e1e5ab857f54a2be3a3265301f3801cb85dd02941a79332e7d7175e9400c8ae924c78414267288445c8ec770699c5187c8b42fd74341286eec06563ed23d62bbdb446df6a68150c158ac967844af929970d61f0e54a8b119c12e1129c16bb39c060cf8479741913112ea2dc331dc71ba7dff409dd8c30132a1a1ef321290a82fa3da877e7fcd1b2ae88497c30694a8c89d2f32f23a1a79360d02756cdffa04124daf334056811f533790ef239119a96eec7dc0e545a47acf8cd27be2aeb405ccf7a501f0b0f4717790f9a51be08523feb2af0e10a2c6229e185b81f53130a87fc75a6c8003cf25784e6ef693804b70591a6e868040ccf96aef0d70aaa5f330c3ee75bce0330944d26f9078c5b41e41b828c55b4a3635560cbc22fa85bde659c1a19e8287503111fc9d4811122058f6b903dd7d05891c8478a4059e5059da0559b3549ae6e95335cf0425813219b4b6bb2e2857a1292d0bba1b336f182b6b96ca9c97de7c5f7c3c49d15d762f16984f8e13d39485b237bf48a954e79d96ac80c40958186191930bad72260cfb58506693110e6892d58e8ae65047397e9ae6d8472af00924cb1afc325e2d0e16b96e4d0449ea6b2be6e3106031f3cf93c8a102e33c293cb4bde2cf9dc426ab1a3a7a3f0c6e9d037813286101caba5a35573630fc84d0f162c92eb078d33164b8d5eda009120f01c56ece38988ceb6c15803fed92c9463a0d93253284998085b845de094f19d69fd000a7d9a3399b3e00ae2cdd6586c5598a3a92f9cbb5386579858f91746ec8704be1e1e1234f4dab4591531ca0e8fd30fb11d33507c9c86ec463d04461337f23c06ad173778eedb24135661484caa4c625eb0e068493c391a8cb07d75c5f6045fdd2740383223e7995fdb3cd9ae9930fe4d3ea7a053db1201aa64f27c8e7dcbbba653c4419c4ef16955b340152339f169172523e49122c7d4b3654eda863624dacde1d37a6d11a0c45e4545c709a875fbac95cfea8fadcfbc4ae77528692b09e639746660d491a031ac8e8dcdb9fc0a8157f58c62f64458069c1b2dd8c549a5ccefe7293c40fb5a6a9470b15b6d0c6f3d34a52a50da00b691fa267f7d1b0114661df97918fd5103d9eb7e6610afed40a5005badc041540606cc75bbd99f40b4f091aa77fae1db0ca259a21403c65dcd440b0dad02315d18ca069533d9f385f2ba7450859258280d539c1259885c070cfe5b3e33233133090b9ad9a07589c4b1373e4afebe9dfa7bdf48be90c1c56fad15e61d9e41241c7bd297faa08f7c445715e006f4a2aa605ed44b1467bcf4f0cc93e9074ecaeec69eb6681c41b82762d1841855ad253689ff5e85081b0067f174b62b2a390e3e02c374ccc4a523df287cf4cb2ae8275840a727cdc47474f3257c75a667d7f59021a6d292c348c80cb464d8bce3e4c7c1d2c24a28afb214bf559d0d0d8c47b8b48c9a6b2dd6151a3a5c6c36e8a39a565091216dbb1b56a0651c6a53614c3f328710c6281d06a2afa42d481f5bcb399d7e50f2869bbb2577b922ca4f0a937a67e6c56a8f87e56e5bce97821edfe2d8f8b080405f0a130846fea5da403047a172abeb20c1b92dd0a1810504c52a99c8a74a8cbe956701495b32318cf61562364ed230fab2cde2dd562960b3800434bba69524bfdd0db501226f9eb6e02d20058303db4262e85d6cda1230f48ed5467d88bd04d6049236e76c2b89516175b695a44d806a53300c74828d7a0c745cb1ad6444fd326a0bc6e429d9788c294104232d6df3c536cb5ea06e024105039b11c3180dc0b69218a3052344196534169036ca680c20095326a3b6a4b8f966a325c1d81cb080e4b1396001c1c8c5d966c1a036182150c1aacd88e5b8d56a5bc98c496fb1ad6446054b3605cba860c9b692655c2732818451fd6c0141050b362697dcabaa2c1015fdb7711254b0605b16da93083639ae11d326db4a561be91533c66604a95b6ab6556c0e9db78dc10db52bdb48c780ba369b056bb4a3655bc6463b5ab6656c74fbd2a45d912eab9a18165d40e76d5a49aacf8468a29eea33832da48cae8eb4c202d2d079db66a113b6685a96e851bb6c369f4a49bdcd7b478ca86d42891a8fdecba46031a082d912c348d50046c430a0aeb6c43062409d6d8961a40baecdb692a161746c9b05036a23c330a02eb6c4906eeda56c5bc998d1791b114305b325861103ea1a6d2b097edc37b08090fbb2910fa860b6cc3062406d1417a8e8bc6d9324374e7e2c2061dfa43b04f96d1a56500f9244bb2e74884fee95da3d509658292b29f68bdf8fc38cf3b61598258c9d4703ebd266f3fda832e3d68905048d46b14967f61894d80407b38462cb766346ab61cb76a90747cc36f1cc1545c3a6379825545bb64bd5f4c6c8a7440c4a6c2b5952ef2b610241a361cb76236609c5d956b2a2b619a3a58a56c396edc60a9bb365bbb1a6fd20c40052369be45772ca36fd6abedf72378184510c6d01815158610141fdb225bbb1a17e15db42629ed06cc112d0856293b2005d67b425bbe0d27edc6900291893985612304f28b66417bc1b97882c20611ce25b40c881d9c8c73ca1d8125eeae3650b15c137eb99130454305bbe4b1765aa2ddf8500d63327a0da0a232975dcd3b28034eb9113446f3d72028ce510391b481ad5c71690623d7302cc138c674e00d4d3cca660108c674e00603d73024c138a2d7d03a0da322362cd7ae604c95bcf9c00f3846a4b6020a182d9f25d2ac5349e3941aac6332748e4c06c0a8621b5f1cc093067319e39414605b3e5bb9051c16cf92e60486d3c7382e2ac674e5050c18c93a082d9f25dcca5ac674e508a76e6f4bb6f60b6ca631f251e180817e777faeec55573e9945ae6be17e789cb2de7d5ccf213a7e52a87fbcf81fa997886b9be658d8142ab82d8f8c7c3cb294a09bf18c0ab9165fdfcb2c05ebb0a8c6eb477a39c117f2d09d44b30e980b26413af1e82d11246a367ac1a9ce145d64a05d8172e19bb578fbc22a98b80a7d3016064f55b3dc4bcb36aaeb222432bb00ebdb52b9b7359cf99b285ac7bede63405c7daabad57c0a33e2536e958dfc7c521b5909c3a9e648104d715f943e23fa894a237ee97165e2749e2aa8956244e87bc9ece2c274abf9b25d96b5740a87e9202b589d0c6c9507955d1ec077887db15bd7fa82b6e7fcb7f3055a93f0ef93e9fdb74ecd56d97e0f6caf450655c44ab3640c45d2c6e7b6489a52a04d49325173689ae647477254706f2b58d075db5687c52dd7ad0550be0fc5b78c6ba45ce0c693ff45b81092316e0b39a443a6290152a47e39ac1305890d8af51ccb3184dc85ec7cd8835d9100cc55b123c17faaac605057a95e23b3cc7c0364a3404cff9dd0bab1d895b10526c3524b137d63be0f9d29278bfb9f6d0d82f7ca5c105fc7864932c2c09954c3506226f9b724b72127756d68b56b335b6b833b47ed639e3b9085d7c3febb47003a31dce3f1ff449a85f42e078a9e609c31bda226520eaf56dc0ac2bf285d5dd3a5d49e5fcb2e963c2c0a0276ed3a46f9abc8cc4174e89356af2fdba14a3cd1636a55e6c6059698c93aa10404de743c550b816d342533bde6a5be84a5d07df5ae8bdb06bb5d05c61d585a6e2a718de5be8882952cd870bbdb6b3756bae9e668be2c6caf076fcfd84cbe669bfa2304fab9ba7fd8ac20cb248194792c966d1faa5df2f1ccc20e107c68fa81a2c8ce2a0dbb8695a55bf308a0b41607a988169615cf06f61fe908630da1eeed270d25fd970c74aec0fedc1d2b52edd8f759cd05a48cbd82d984116d292710d1a9f45a8b52de9c58fd1d6f80147b54d875a38b54b3f9cc4b2f18bbfd7766ca655e1d194de69b5616a1d4d78278f6e4570476ceb89ebc3229c12378ef51ba3ad1f2359302d7d479841e8e13906bb858388db85c2b0aa6673f7a906bc2baa8ed4687e6b52dcc98dba03a4720d8e877abd9fca94a9ad0f0331ed73ddfbb732f2d5869b74ee5ff9b4cbfa602993aaf58e74ee9fb93cbd6939a886b6b564b11c54dd4ac53a166ae9ba58e6f2e1d5a78ed03e49c15ed6aa7ab1fa5f5dcfa9736c0b267e3c3c6044ffd11e51c6ea8995440b3581c82c5be4e17a9e391a50cd1fd5fd064a212dfe8cb9eef17c7ffde200f3739084fc31ce527afb7a46ca5737f2385d0513a2117d75e40bb9d8f7aac3124e206f1af97123cf82f87e238f71f84d238f996788fca3ba91cfb197fd3310dbf67a41eb92f8b4aa91a77b5c46997ca8395587b8df5f679319af65d85afacb2e1329cbe0effb3ee0d97443c70bf3136aefc9f05a9d9df530760291bd125481a2465d554ccb772ed4440062af24b77074ef743283c8644cc8b56a38537f5492a1a1624e2d553367a0ff8ecfaaa6a219e83d53f609754725e75e23cc4054c7832a4b05bf16da506593e7ab22592c9ca81e1d87fe5ec95b128786819efb6288a9b97b8bbdb694818860cfb4ed4e5be620165fe529dd854372973c1588690244d7c5a8fcdd2041745fcccbb5559f4408be375ab3501ba0473b0b626d7b70fbfd280bb1fbfd2806a246a591eeeabe25a50ff79548f3ce3b71aeddd7d81ef2a7fd8bac551d74d093185e0bf79586259849f9d2ee6b3c4ec3f0d24f6f5bbf893c8358dd57ed57aed8b436f715366763283abc0a5c362e1e0b9efb22d842e1abb4705fd4e9c72ff1103fa8a15e2e5deb0d68d05bd0b12ed1b039f34295db6f0a47a5b6469ca50b4f83195e12b408832e76553441a7abdda90addd03d4dec059c2b9eda76777cecaf6759f0a037b7d35ac44ca24e3b22c0bff9b9e6b96ca53e1ee4e5bd6a8f8f7ccf77047cbfeb3d7f7471584daf5b723444d58ba810e587d7625b983354479c6e6c748ebea2b1a88381de9bc2422bddd8f095cf2244d01410d08e4081c63e2a9da67e7c3d1e206388a90fefdde527a7ad3ecba8c63214f65aed4b1995d8661052ab1a3557fb0dfc79d68580516fddca407e0309db7df584c6b2d881ba8658888db1770d61b31c1adbeb1276f7d6d3478d1286a68a2ee832c4ee124623d73d441f32470d26c3a5b3526aff4757b16690c5becb68ff3783acf75d64182a4af3783df3b20fa4aa0b68b37a583f93a657b5436f7b60e006b577a3b6078ce73a627b5d8f61967b5dcf04128e1f80e61b5582e7e7829cfaf5750bc7a0f4ebeb165aa06e14ab18189642bf8a6e9904835dba8ace8494ef9ecaec4a68ad7e0859c761cd4ccbaafc39444e8bac9ebdb4f3496fc0c507715fa9b06e9a44a7cdc1d86e9e40782181dade9fbc51dfba32cc4a6d7a2890ffaadcb81b9369928565d88dc90ca2eec2dd4b480cb3509bf6c4191632a7de16a7d2f60627565f04f0e8be812f82d8cde041c3c9cda6abe743188fa5c015e1c12fd7c76a37b3ce55ab61920af782f930cc04a629afea39ddb7e23fec4f1cb170c972ffeacb3ea1407e8ada0dcc845dbfc474674c74090d3e9c7a20ae54875543e7da1f7b1bf07992c5ebcba95f8d66207ac45b7af9f80c22258f071b2234b7dd24701b40319146edb402c773617362bfd8b2204d5a039e862c8bbf9657cd54878e8146cd82b255a091d11d59984177ad818b2cf0ad96e31849ffe1bd1d566a6063239e1ad8544ec9a2d829f556296649b09f8e1e76423fdfffcae45a2c94b4dadf2e61942c6bed5f04f09acda7130cfff45dfc590069e28fb548bba9fa854dbaef3d4667bc17f661ece33052c5c3f3272aa13c8ea40675d41aae029bf5ca9ef9096987e9f0e2122e26e9855ccbf4c5e33d0af13497782fecaa9da316629e4fda097ff966cff2f9dfcf538eb065c14bf9fc8650ca95be2435d02a656b827bfa21f4dece9631fcd0fa9eefaf53e52d17579d3ffb96fc629d65618d5e82881fab95e3b1ba2f15939079bd36326f35726a41478c3a42f149c42d36f5137bff512650e26cee68bb8fbee96fcf207bfcb7b6351531c369f0fb2bd699f1ba54acc348b15ece37663ad45bb405139e112d45e1784aa7f591aff432105e074cefc547d445d11513add9f52b7d6c4dde7bd927d7beaf307f73b9b953826720d2672c37fdc55e85ba6b50a957215fe84549f9e8d1bd405406306284e9ca103594ee71ff8ca9b60a5430dee3feebc4911ded71ff4cdca15df8fccd52aaed0ed58658a0f733b8b1596ba470d5dcb468578a624cbded8a054fbae0c9a558786e1951dcddccb5d38a482f2ad09107d5df1a0e58d552a74221b19fbfb968c119fae3df3316ffdf5ea43ae20cb535ec5b7ad77999dda82980bcc1f335c3b7ac70cc05b108ec9bcb9eb2a95606f29bbfb0469d48a96592859216baee32862eb7b697db37c203a92f5f7abf45ba4d63409cda83c13886c1bcfdf4f8450473cb8d2971e7de24d3b195bdc2e015af6583e67ea917132ff2b227a41cda64551be54e0bb31146df5a61d4ed4d782edae9e6fe780a23ed570dca0ff7e8a508d2cbb2f4cc0baddf539edebb1d411d1f13f5c69d3eaa0678d4f1b1bf323683988aa4805aa7f9b173fdc2f52fd3dceb7452eaf240ce769a74d1db13f61e3d139e5fb7e10e35bb74646ba649d5ad226a7659a8826c06d16222ea5cd9cfd96610f511718c56fa39db0ca26924f5a14c81d3a2bfe55e6a7f0e990ac5c2f31d71fde5f1304eba27105d022bb50ae393a8b1402dfdbd6436c96139fc61ddccb55d027a3fdb794e8b4a7ec2989a8eb52462e710695c63bd4e7e0aa8f692c7a24a486cbc68fa95e88d8dcabfb97a06bd5219da0c72ca749b6d0dfd1d872f74bdf86e5be78f5eb2ad0cc474f30c7c1dcebad141faaf665b3dbdf336cfb930adbb359ed1fccaa615e8710a60932e4ceb6e8d6710ddb4c2687f3683e8a635f7f66733c461ebbc73531b47fbb3e91bd74c6dc350b06493a99d40d48b2277533b4f72c9d4ce937c35537b9dfcbba99d11d32176537b9dfc87a99d6711d2f059a676fee625533b83a8a6f6f0448a2e44b9e36347a8a372811a683cf72cc742e747a9c91e7d47960205cf6b4f5e8eef46edc9dc0ff7b498ac84b11538a1a1578062765762e4206a9d2975708eb659e871c3c267d97713ea83b85019c3a25ed65fba0a5bf068a82968ac17780c9fd29e3ea5f055a97c21d58b90bef476f40644e909646a473f83ec27b54f3cf5d2d4512564991515963a7e31f60c5f16f86e8b28907a0a69e6ec09dc6b73c197df548bda301ca737f0186d6a3b26742b940259d8b13fae6a02295ba21d5a0bc8e87e630129be775332818cf6372690bdecc40252fa0b3d26903af6b40d207bcb5f1348e8a5dd2610b48c82637b35e64b2989106dcf7f1895228f6676c20b4875d12f66b9feacb28194e831d8899c947ddffa0551fd1e16fd695a273a866e9963ba1f0b681c54b75e63dea098549f5e40a45d050beae07a9f3013484093cd638005084624c6a5040cb0c5522e406a6f696e014974b3d10842ef5ddb38b63ffdc79cdcc785fe88bf8b945095637a5243c8cfa8e3a9bc8ea74c7f3fff249dc0723af6968c6d3eed123f9c6f6f53a30c1edde897df5bc255134103e7a774b5222c5d72980748221e12264d4df9e8cd0f1badf4585394b48a69d56f444ccf84c83e96fa2b3c4892a9fb07d57278cc4a60eb4534190386970749f624ef97c74b23a1e73b91eea521105d3aedf310c84fdf7404e791def7674ff4a18041073dc3447dc2ebad524ddfe2ab899ab0acbe4ae534a3a90afee1f10f00fdb3f46cac5f21fbca813e84dac81d0da4e74b9f1ce843a98ada1d8d25e3532f8edde9ba3676e7ec95b1c965a2fedad844afd26a634f1fb3b97fe2175c6fd7a149073cbd287723d7987b808062fd979f3ffce19fff8c91d5f7ff7dc3b96ff01c1d3a0750740113a5fef0d33e388dc1f77ffe0f8eefa5240d0a656e6473747265616d0d656e646f626a0d392030206f626a0d3c3c2f42617365466f6e74202f5245494d425a2b417269616c2d426f6c644974616c69634d54202f44657363656e64616e74466f6e7473205b3131203020525d202f456e636f64696e67202f4964656e746974792d48202f53756274797065202f5479706530202f546f556e69636f646520313020302052202f54797065202f466f6e743e3e0d656e646f626a0d31302030206f626a0d3c3c2f46696c746572202f466c6174654465636f6465202f4c656e677468203331353e3e0d0a73747265616d0d0a789c5dd25d6b83301406e07b7fc5b9ec2e8a9fd11644d8dc0a5eec83d9fd009b1c3b61c610ed85ff7e69ded2c1048587e4e48d3909ebe6b9d1c342e1879d64cb0bf5835696e7e96225d389cf830ee284d420979bfc578e9d094257dcaef3c263a3fb89ca32fc7463f36257da3caae9c40f14be5bc576d067da7cd5ad737b31e68747d60b4555458a7bb7cc6b67deba9129f455db46b9e16159b7aee46fc671354c89778cadc849f16c3ac9b6d3670ecac83d159507f754016bf56f3c895076eae57767fdf4d44d8fa224aabc0e50ed95ecbc32013d413baf14750275e91ecaa11ada7b6599571e43399442059441c8cb919761951cab88187a8112e800612f05f622049440c82b90279057204f20af409ec0ff153b7f70b713ba1ea1eb33ddfb232fd6bad6f8cbe07b72edc6a0f97e5fcc64c8555ddf5f8a60a3470d0a656e6473747265616d0d656e646f626a0d32362030206f626a0d3c3c2f4f72646572696e6720284964656e7469747929202f5265676973747279202841646f626529202f537570706c656d656e7420303e3e0d656e646f626a0d31312030206f626a0d3c3c2f42617365466f6e74202f5245494d425a2b417269616c2d426f6c644974616c69634d54202f43494453797374656d496e666f20323620302052202f434944546f4749444d6170202f4964656e74697479202f445720373530202f466f6e7444657363726970746f7220313220302052202f53756274797065202f434944466f6e745479706532202f54797065202f466f6e74202f57205b33205b3237375d203135205b3237375d203430205b3636365d203433205b3732325d203531205b3636365d203537205b3636365d203630205b3636365d203638205b3535365d203730205b353536203631305d203732205b3535365d203736205b3237375d20383120383320363130203835205b3338392035353620333333203631305d203931205b3535365d5d3e3e0d656e646f626a0d31322030206f626a0d3c3c2f417363656e742031303137202f417667576964746820343738202f43617048656967687420373135202f44657363656e74202d333736202f466c616773203936202f466f6e7442426f78205b2d353539202d333736203133393020313031375d202f466f6e7446616d696c792028417269616c29202f466f6e7446696c653220313320302052202f466f6e744e616d65202f5245494d425a2b417269616c2d426f6c644974616c69634d54202f466f6e7453747265746368202f4e6f726d616c202f466f6e7457656967687420373030202f4974616c6963416e676c65202d3132202f4d617857696474682031333333202f4d697373696e67576964746820373530202f5374656d56203630202f54797065202f466f6e7444657363726970746f72202f58486569676874203531383e3e0d656e646f626a0d31332030206f626a0d3c3c2f46696c746572202f466c6174654465636f6465202f4c656e677468203136393634202f4c656e677468312034303430303e3e0d0a73747265616d0d0a789ced7d79605445f6eea9aabb757792eeec9d05ba43561220610b04226902618b40d80912092a0882caa22cca082a82e242dc50710117146194100403a2a032e20ea3a2b8028a0a22232ae2c8d2f77d756f7708199779effddefb2b095f9faabab59c3a75ead439f7de34c488c8410b489067da8c09d3b2eedae425ea564f1431eff2f173a6c56c15c750e3df807fea95178f6713dff89e6820d03130e9f2abe62c7b35eb3011439b8ec593264d181f55e0e986ba1f0019c85ef2ed532f04917e0828bc74eadc89dd0b3e5a48747d1ba2d427264ebbf4f23d9376a612751a4ea45d74f1acabfc55ef4f3942d4b713f29b48f2a613c5455ff3c03877f12f469241f2e7f121db0a25fdf0dabad5a7169d3ee3f21919e0df81faccaa804fbd477010f572ae39b5e8e450978fd2643f677f2276c93af8fc898a692aa9c4c943f9349248edc9c791425c0b75c58b425843d789b758a132932e02c6e82d688bba93d6b06f5921ae2de66bcc6ad182de50fe4eab503f1e658341c7f022f329d45f08fc0ccc0326015d811b8027810f80c5328f3635c030f4b14ef663d1afe8b4fe0edda4ee340f63bca1c02b40a53a9286e35a8556441b651e63f5451fdd911e82f2b11afa417a2cae6f40dd6116dd496390be0ed74f20fd02d287f4dbe9983ad27c05e92328ef88f1e3d0d74acce70e8cff9132d33ccad7b018f43d16d707805e0b3a177436ea5e8174001889364331573fca07225d01f9f497e5c03ce52bf317d06b209f525c6f8b76cb91af41fa01f07537c6781fe94885a815ea8ce4e751ad68610ec5f8b7d8f3b6e62e791cde3027f06ff1f4fbb856f2d718367f677196b7ff40cd399849cf888e7400740e900bb4e1ef58eb3606d7fba95f632d0083580ee43407737b46b984561964be043e57a8cfd121e46f68c04c6aaf3c643e278ed3245c7b535b468fa29c787be004ade6dfd33d5a262d86fc4ad0ff54a00bfaf45afa7009d67ca6f93de895cad7e07f26ad06da6157bc149693940df2b7635d316ff3b4dc310a7419d031ef7dc019c907c6bf45ca5cae3b1b191448cb71ae91eb8f31670357a17d10f5ef96fa8cb5d1d1d7add638d63a84282075af31240f61587a168225fb35341378097856ca0a321b0474423a0ae80d1400fb317e4bd43fcfd257e88cd44da91f5237d057b95c2b4b67ed390c838e1d0ded9917d1fe08b01a7848fb3b3d0bbc0d3c88f91c93fb45eaace433dcb7d42da933616ae9f714ba0d7c79e53ca54e9da558ef233457f260ed41e85698ca7d27755f529147032dba872aa4ce4a7d0b5329178b7fec47b9271ae8d9b97e08de5bc97d8af60f5bba0e5d0cd3b02c1ae801aab4e47d0fe676023afc256cd507345a1d4cf344193daa3e8ab22990cf1e94e7d15c630fc5612d07a3ed034de8fd12fa1e7619c6daa3ac853c31be25d73dbc95b287a9ea5aac3bb137d4b5fc3a2bfd1fb429d876fb9aa4128daffdef96ff9f807fa8aea589487fa7ee314dcce72eb927f423ac00f08729caeb800540ae91c7ee37a6b07a7d047934a2e3c0954a80baa901eaa26cc7be8c87cd23ca44f908add4b2bbe330c6307684158a3dac508fa7db95341a2fc7e21f422700d93fe8b4467a748ece35d5a5300deb6b532af530a4539521fbdb3764db9a50f34d608f3c1ba47db6ce07d86860a8adafe68106fd7c832e061d1ad6cf73f5d4fca8917ebe03fd6cd3542f9b5279b648fb1edea7726f84e72feda3b471d2464a3b276d40b87e537ab63d93e7d37d961d7e87c684f6f6c3c01a6006aeb5c0b9f5aa6d87cd2318eba8b68766ea253453bc4133b597e9527d3a2dd476d2a598f7be8633759cb93e749e760c9fa5524e3817d787cf51b594122d7bf6125d60d99bcd946d9da3e04d9e9fdaa374482ba198905d3922f7a1dc83a833dc3a6f5e00dfbf9ac7c1fb23e2079a22cb955974af756db165d7bf51de37ff2dcf44f1004db3cea2bde6574a29cdb7daae30abb47c9c97cfd08d0dfdc93aa0b24cf2af273043390cfeb65b67fe75617b2cd7de78d9fcc018093bf1019d508ec0864da187d49741a50cd658fa38d46abbd39c68f535c5fc52cda0f3ad3a80d566bef949481e96bdb1ae8db4f2af58b2409f90c133963fb107725dc31cfa1eaad40fa3fe1eda8b7d8732603b2d93bc603f7e689dd7c7e11fedc1d95806ffe027bac6d2ff83e6dbd867a90de770146cfe49f35dd8de0ad4ed173aab075bbe05f68fe56f4047f43879c69aefab7974b3b286de42798d7e2d747235dd0a1e8662fff6552ea372ed08d29bccbd21bb3d52bc8c3eafa71b2dffa4c14f30fdfacbe6bbd01fdb5f903c483f45f2b39c2ac556ea8a399defc8c35ceae85122f352e01ee0ee10ee698450195d6ce7991f3447dc4d2740bfe21364b9f81c6969fb6b94a761d71fa478f194f94f65223da57c4723783e0d12836897729406a9829e42be4e6943ebc551d4fb376d025f835427e5f37cf357914069ca219aa5549aef61ce0f2b7554284cec672f4529f79a3fa15d9d5a4fabd58bcd93ca853408a893e085d88f0e5aa1dd4a83e478b27fe071f49f28a1cc357fb3da3582c56b1892e7c71af17c2fb513d75396c5efbd54d6985fc96b039fdbe969c9e3eff167f121fb453babcea78478c1fc0cc8b4697048239af05fe0b34654aec367d20797e782b6017a3d0eb66f0e7c964d54833e7f263a8d7a676e473d786a671e46d958a4bb031d906e85b2e9a077a2de47484f41f9bbc00e94952a29d43364a756238f58e8cc5ed035a097a34e3428ea9e7e9ee8d40f36cee421df134807a04fa705ca6f05ed6ad3e03768d71fb49f7ded741dda6c03de0c21c12e3bdd1b1884368b5056069c87fc4c608ad4edfff46bfe87e91f9c67ff2d6d747e9d94687a26fdd734bc9e7f419b9e5de1f5ff2bdac8073d9786e4109e47a3b3f44fcfcc30852a9634066c73116c54866597a56d843db6ec51885a7e80b48b33e13bcfa46701f8efe492b6d8b287b0c5d21ec2fe5e6e9df5a7c0cf4c9a10e64bda12e855bda830eb6107a4cd1da05d4897cbb341a6a5ddb6e84e7aa491ef52ae8d429d9134cef299bf2427d23d706e5c0dbbecb77c955f1163ceb1fc930aa04bd8ff906979e6e9fde906c8aa75d82fd6bb633dbe809cbe977c9abf58e78bed770c94672e3f80f87a0d7950ffd6501c790267ce4b568cb105f1b26d9f43fe31fcbdaf285d29a414a5d0fc38147f5f244ee2ec967ecc31f3172bd63c45b5ca33e01131be730d553a204b03f3718ca4b17a2ae63f832a9cdda4cf62e565dc3521bcbe589b69bfe3d3481f4d6fe4ab59736eaa9b167f85e61e79ce341e37dccee88773e506d2cec60f7fbec742ba96d554e7fe30de68aa7b67fdbb1390c5cdca23e676a5b5f97483af09dd5123e02344d0dfc2326eca4b782cc8a5ef1fedc9f01e01eeb1f446de57b0ef2dc02f850f6497c97b0cc3a107132c3f0abe803a16fec0ddd0d535e680d07d8780f20f6b4d9729efd2ca90af3032e40ff700a68a1ed6fd0c275f88f8b208b1f7ab34d0f2096cf4c71a6458732bb0ef0768ff049ea1f99a1bfe5b0bf39f8d700432f34bb901772b9bb0f736597edb3bfc0ed36f610d7c8f3ee6eda0016eef971ecabf6d1f0df53ed52c3fdc7c57b9829eb16477177414eb0fec5238fd03b80f88c07c4a2c599dc01877a31f3947ec6d516a5e80f65f8be516afd7281cfe21a74ce8e55c7d3ef4f56ee8ce4dd813f7d172ed79e02bba42eb0c9f7b007ca632ba44b981fa8bae344782dd66eee0c53407e82a213ad21c651afd539c47f3e43d2d79af2b7cbfc0f6bbd9031242a79f8103a17b5412732570ed63dbef6631401ad6e831c8a003e81e50ec557639e8cf213cd9081aeaa02d3d86b57a9d5d099e4ed215a2802e94e3080f2d6b0ad4bdc886f934e816796f4319051d3817bd9a026d25cd6f0a944b9ad914a1f2e4a640b9a4a54d81f2d2dfe1e38feafd111f7f549ed51428cffa1fe0e38ffa4d6f0a94a7ff097fe54d81f2f2ff0d3efe48ce194d81f28c3fe1635053a07c50533e70d60d06e6c08f7a0cf445d8ab36a0b341e17f99f0e9cce790864f47d2c79c64d731af07beb64129c0b548b7431f280f7e091c43fe6fc02ca014f9ef81c3c057c054f860a7501e857425701c78059862d735e1ff07d3800a603280ee835702f04f8309a1f6b1a0881d82cb81adc8af00e09f069784c693ed3f05ba210f5f50fac941698b31a6f901709dcd7bf069e00ba4b3d0fe02a4bf03be0d5d0f21783fb00fd77dc8b707a45c86012d803840f2fe0ba80e24236d02885f82f1c80f055eb57de4e08ed07d5187bc27aedc8833e605eaa39ea123fa8fb45c52696bad1876b2f959a3b34afae4c948578897cd9f34413394621aac5d496fc2cfd8a5f7377f85fd8e55abe825d47913675382f291f9bd3cc32c64c07ff800e7e7017a5c594933e123cd120be1b3600ce547ea29fd1779eecaf1c41ed8fa3dd4c6ba9f29635d3b26ac7156d106ad1b62a1bb61477752a9fe2aceb409f09d479a6fc00e7fa64f42fe529cb373c9d074ea69aca1befafbb89e41714abc79467b94556af9ccdd70fef5a143f0e31e08534722fc9d4f50fe18cdc1f9334c8ea797cab333f866786ccbd7e2742d6cec40c8730c7035d61394107b9c96b18215a35be7f71a3bbe0ddd0ffd451d017f7005759071bc154b877c45cd477b956f100f9f827c96523fe307c4e8e534587d879e536ea2bf35ba0f7a429e91da49c4f688a7c33ea4b6df3a2fd3c354fa1b61bf54ed83bdfc3415c87b0556bcbe13e7fa1e6a1ff64f1bfa90f71110cbcb7bc04dfd9ab01fd5e0df847cd58631c2f3f90a3e04cecf86f987e87ff81bdbb1e711f3cbfb13966fde94867892f727e43d82b03fab7f48e3f4ab413f665eed4ddaa866302fc6dd6838cd4ff485e6bbc620c8ed32ea67f96b38a3b58e74c2f138c9d80c31a289fd457176bc4f88d382eb41118799f21ae23bf300ca6a41cfa0fc8cf4bd01ec5ff3b80c43716db71deb05e1970727020751dedddecbc1cda09de53339d4ff3bf28fdb7dd31540ef10fa8680b8d5f2537b37baf718f6e59bd2b05f2fe538b7099ddd245ff0dfc672720fcb67457f74efb2112d046d75f69ea6596ac3f667c37e74531aba8f79d2a6a484f21785682ba96b961e37a14defcbffd17dfa3ff163878563148b9ee35f9b279bd0b10dcf1bfe8286fcefe5212a7d5dd85053dedfb90ef4bf8e21e5f33d793f314cfff3be6a28366ca021bfbce9f385b354c648cbed677696ff6e3fef90cf1cfe040dcfa67ea6ab809567298b9690fefdef416b49d700abf467693c707b985af74eff04da52b45b4aab0c1f8d076e6f4483124d9f05368560740db04ab993c603b737a2410bbfffdc709ef630c67d18e3a23e70bbfe06f87d03eda4ffff27d06eb0e678bb31cb9ae33e7916fe291ea75912c67d18e73eb4d98571765974af4458ee613986e5d2e8d9a7cd7378fc50bfffb7eb68c7db7f8cbf5a97ffa979ff19ef8d01bfe44eeb39bd4d5fb29edd9ec3b3941bf8be81166bdf40ef7fa6c5fa28f82cf2194143fcc2a2ff4497acfbef62022d166fd072d47fcf0664d5540fe4bd7e8950de7eae00dfe81b8c398026c97d209f69d86031bf271f1de340ff26e953401f471bf93cc28ec9b662affe2df4eec02b21dbd7dab199c6c016e848cb67cd738d5af37b85ccf795976962c8df1b6bdfe33403763c2d9fef5bcf4a8669c369ae78c4fc44eb87583416bec32a9a2081f9b50ca1228441c083e0fb33e061e02ee4bf024f8b6c5096846867be046cc5f5d743e7dce5b6cf6df9c8a742e8192a977e7740a2e1d9ef56f0528873593e37ffd9f2e1ae553e066f1f23e63d040a7f01fc0761c78ae5f31671805a5bcf12b686de03b0cf11f98c5fee9556d6f3f347a80ae905d6f5a7504f3e2f40dc2fd6d2e2d0f39705ea279466d509bfcb20ed6421a58a9f68a2f2bdf99df55c01b1bf229f55a00f2d9fde917e911247e3d5cf69bc388d98f634dda6b840f7da50bad187b29cad479ed3654a346825ca1f06fdd5aabf4c198f3aa780a791ee89b22174046ddf5427c19ec6d2fdc03f104f6f540ed246311431ff507a1031f546095e43b70023c4305acc2ea442118579bf823a45c065a8530c5c462f021b4415f566df2236ef4a0f018fa0de43a290de1633a89f9884983a85368929a8ff3dd0dafc00fda9bc9818eab645bd0bc524f37dd41986f105ea14a2cee55a0a65a877d1535a028d5093285e4da64dea361aa48ea63a2d0fe7f8df6904d6f621e03e09f91e0362fc02f8e8b741be64bfd36053be1690affca005d6c07a5787213aa2b5f69b3ed6fb19d0799cf983d423e6297d04d5e88fc2a783ad0e3dff7b1efd2fc6fa94438fbe451f85e83b5d6d4defa027741dfcda8ed7c825f50d7bf496f03d5049e53333a93b219fac1a754a4402c9f8ebeed07dadb9d0e94ff516e66be81f7a6066c217f8bb84f5ac698d793074aff284e844572b3dcccff558f3ebd0fdab1ed6f3ad17acfb48feb3fd91aaeea6807d1f15f51bdeb5317f41bff25d9ab622cb7a17e701ebdd1ad9bffdfe4ef8beda6cfb9e1a7c8a4dd8b3f24c98697ec1ef307b59f7d00acd77a03b33a1075b802bc5d596ce8c601be92ab6d17c55ea0d7445aef545c0d4102ee29dcd20e870c0c7475b3a351bb84714a14d11cd10d310835d46f5d81f1bf97e6ac536996f42b72e84ae4c1473a0475da916781a7ad39f3f42a32584a487a8b5f0d3f390690f601ae004a4cdbe037a9e039dee867e8ba15bef21ddc97e27ca7a3fa5ab5c27d473fdd5d9f6573ec15f9de17f555feca33bc08b024c95cf9543beb123fc5c1eb65afa94d049ebfe6202aeaf08f9580315fb7d26ebbd2ae5b0f923e2e1b7ffc377cba0abad773e427117e45305ac0010c79b3b815c203b14477494cfcab07fb215462921db9782fe6341b5d033dd6e967fb7c6ecdfc83f0ffbdb1d433a354bb99c2ac5bd88eb1e9571ab15cbc8fb256f03ab01c437c14f2cdffd0d6b1f8e05c5ce0cbe876b32267a19d80eacb3ef6704dfb09fb759365f963f19f2b5af69f0593713f6a23945eb8af20f689971017da77d4177638ddf16a9b40afaf41e7052bed322813366b0fd8e117d84b95c86bed680ef55cae374ad984b972b3793531986792f26b7328e8a945b69add2d192fd6265298d015d289eb5e2c411803c57e4bb7b3315f9ee5e777a5d09bdbba73e8ef8f234f4ee63aa7494d018f52d5a2d12cc9fd5fbed67e5d6be6d6ffea04ca3f3f96c7b1ff20a9c115f510eda4bbfff1a595f5eb3f467b7f9b2f22f8cbf9316293fc2c62cc2fe6d0df99d478bd418ba006d2f10bba983721c75dad0055a8e755ffe027500f4f9368c3f0ced4ee0dab588959330e723f4b07217d56b43e845e53173b7f224786a6d7ea9bd6deed036c3f76b83b8a51f452bb7a3cd8f988b1bba2679f83d489e243f8d20f9698c302f4d61f1d118928fa67d03729ed6bcc14bd3b1242c399c17aa0b798465d208aac5c7de73e5d418a167193608326bcca7945d1852868d9104db26651a46d339852065dd18d65cc380ec1b8079cb75b0e41f5ef744cc73b7b9d95e77f34b6b8ee04bcec99acb35e6e6f09ac35fd02cbe11e7cbb5575a9201bea6639ceb5579bfed31f341f54a5aa98ec55e97fd4bf985e465cd15fcc86b56df9237795dbe8f2179781332c69cc37295b2d4db983bf572c86b09fabe166d4660acd31857f67d14f930ff07ccc7655fda03e6e7ca48ea1596b5d566a3b9d3e23f34af06dee5fa4b99a24ff511ec13e8aaaaa3fe36e8ee2bd0f30fadf75b9ed6ea50f602f016ca0ec87532df1297487b65bdc33a0b700229d8f3f279432220df3b9d02a40319c04e6003f00f6beffeb7907bfcbf056cc139804df82b481bf057c01e9dd7386fd98cd9e66d42874fbe47a6e16bfd451fd22e35f8037f02d8ac9fc236abe918bcc25c0eac1277d244e8c600cb9635c6fbd4dbda2fa1fd0c59cf071eb0fd7fd8597976fc663db77b5af9843eb3eedf1d0c9d335fd126d8c4de388ba28c2cf8f687cd77e57d1bed41f31723cdfc508f36f75af5e0cb1b37c0eff799ef1aff80ad3d85b3c8be0f38585d13ba8fb4860af90cf8df2662f4cdd45749a70a350e7a7e10f968c40165e642fbbd26968873a5525d0effa80574197ebf8c1dd86d666751c852c0cb0df2ecb3dea77b95ca2d5fafd1fb39f25d95d0fb3d5faac7e845f8b443d45fe99fea37b44e7d895ec6d93752ed8f7df32a55e81780bfef698e7a15747735e2b0fb690cc6deaeaea0636a0a4d41dde9ea976877928668add0f6377a4afd0cfbf4495aa5be8eb6cbe933ed2df8b5d974b95680f9bc4e5bd51f31d634c4793720ff1bad465c3046fb8e366919e6e7da087a567b80e6f022d65abecfcbe6502edb4fe3b98f4d86af76b392ca46e859f0fdbe354d7502e29a0be14f7e87fc4ff0491fc0d927e3e09ed09b21341f3260bc3791eeb7dea79c0f39de69f99fabb187bf03fd1c655f530def61a65bfe640b73abbc2eb2cd2d18e34ee506f384159bc96ba887b25b659ff0a503e2261a69e50f9b372afbb03e8f53b59661bd175f2332a89fa1d05409cc6f8b6317d53486738de513e729d67bf0666b658f19e79c674e340ec3af7adf1cade6c0770ff9477a243da67725436d4757e85540355da1e6d215da67d456bb8f26f3a914609fd04c3e81e5b0c32c33ec0369efd309f51fb45c59003f6801652afd104ff6a338d543c580539ed152e71debccc35a90c63ae69887f4c934d6f8977958cfa0b1fa369457ff2745fff783ef0bfee81ea7e6a26f11031e08dde3acd05d74b17a0175d11dd0895b699e73316d301cf29ea4790a6b7517e611abb5311fd797d397483fa95d6df92073f4af6983d696ae417abd78017e4b2eb55773cd93d0ed76f0231f0afb59ca33986f1539cedee394eff09b77298f9bbf897dc0f3142b9e378f28579987817b956558f365348a3f439f6b7d6023965085318bfa6b1db0ee2da8542b862e2a905b4ba286f71f881cd867ff52eae912e8d062a0bbf215e398df286d11c6ee64c5eb561df512b49d4ed7411e5f2aa3e9712d0e723e6dd90ae93fa5859e578cd4075286761d7553079a774067baa9cfd3346507f6e17ed0e7414379f0e0c67cbe43fb48f9ce01a813f953a17bb83198f728f4990b3e96c9e70d8859cbb4767433f4ea37d43ba6b4a744ad9bf930f241f95ea79144cbac67585fe28c5c4e8fa969b41171d94d984f14fafa97b42fb01bbf392e451c78849cd67d0a85c663ec336a254587fe9662be3848d3307f173f857d310e71ddbfedf71994e5f0b9975b7675b1fe22cd93f72724e49a4b28eb11ebea3486ff9b4a9579401a62880594005ff631ad2f3d26df4f50ecf7237a60eca5c030c4b8f7caf74ad57cf311e573f35a651762c5adc127556fb016f40ee57c8a045fd7f21fd16f0dfa1849b789dbe86d6d0ff6c1241a8af117e91fd8ef674affc17e8e609e0ef41a313c50d2e3bce2eedd8aba7629ecdca96387f605f9eddab6c9cb6d9d939d959991de2acdef6bd922352539c99b98101f171b13ed71474546b89c0e43d7544570466dcad2fb54fb6bb3aa6b95acf47efddaca7cfa78148c6f54505deb47519f73ebd4faabad6afe736b06507362939a01bb66a0a126f3f88ba9b86d1b7f59babff69ddee9fe7a3666c868a46fef9d5ee9af3d6aa5075a6925cbca442293968616fe32efa4defe5a56ed2fabed336bd292b2eadee86fbdcbd92bbdd70467db36b4dee942d285546d62fab4f52cb107b3123cb1acdb7a4e4624b8aa4d4eef5d569b94de5bb2502b32cbc65f525b31647459ef94b4b4cab66d6a59af8bd32faaa5f4d25a779e55857a59c3d46abd6a756b18ff64391dbad5bfbecdf625b7d57be8a2eabc884bd22f193f7674ad185f29c788cec3b8bd6b13af39e83d9b45e731bd462f6e7c35452c29f34ef6cbec92258bfdb5db878c6e7c354d7e5656a20fb4e5997daa97f4c1d0b749297af3c188645f4ec59ed484f43259527d99bfd6915e9a3e69c965d55890e425b534746e5a5d727260b3b99f92cbfc4b868f4e4fab2d4949af1cdf3b757d1c2d193a774352c09f74ee95b66dd67ba26d69ae8f72871211918d13131aae5929abba4c950f6d1027931ca5f7871ad4fa2ff68393d1e9984857f931a12b2db9b82baae1a792a155ed255886c9b58e5ed54b3cdd64b96c5fab667ad2fd4b7e212c7bfad1efcf2d191f2ad1323dbf904c4ae56850305c0fa76bf3f26a7373a55ee8bdb090e0b18795efdcb6cdac7a3e327d9ac70f02f151c56834abec960f99a7a5c955bdb53e40172153bb60c8683befa78b52ea28909f5759cbabe595ede12bf123e49505e12b0dcdabd3a1becf597fef165f6b6435fc737b1262cb2675ab65097f7279827dbd7c587af99031a3fd654baa43b22d1f7e4ecebedeb5e15a28c5ec0b1078ad920949f54f87c60d1d335a16e09f9ad927bd6c72753fec30f0581bdb6bb448e195768aa708ab2ba8edd8869e65667484ec4bc9d42cb5bfa456406dad02e6ef53eba9ee677f563ad3d2feb04dbd6e346a546f1e93ad2c72b659684ab5ddf2cecd773f277f0e77114b04f855b278f9f0314b9638cfb9d607366ac9923ee9fe3e4baa978caf37175c94eef7a42fd92c7a895e4ba695558757bfdedc726b4a6d9fdb2a318949ac1b349b53e9fa7476f390f50176f3b031a3377b88fc370f1f5dc719ef555d5ab93e03d7466ff61305ac522e4b65a1ccf86586ca1936451d37acfa299b03440bacab8a5560e52fae67649519e1324617d773bbcc630f94650d14208e2b8a7d2510aeada0ccb0cb16d8b57342b50d5cf1c82b5b08669fac8bf68f342bbd868f6eac3bd686ac6c4bd43382868b31f29717520bf2894a319a8a41476fd05af80a5e1043c060400cae2bea18a817833778e23b80566c88889174e086fc8e16adebd1d1ca96f5b7b31556b66e8c4d26745c202fa6a4d86d62e26cea8aece0ee192f06e2b41e483f00824af03918580a988042eed0752ecedfc05af9aa5f14e5c897433801d17f43af5e1de66f13fd6905b00f10566981c554ff0d9d3bdb34bfbd4db3b36dda2a130347a07a09301fd8156aae5acd1db11df27ba68901b83400e32cc5e7366017b00ff80150c1d700ca070603d5c08a86d27d56ab8018b0a1753739de80d084076c70793a54f4f4887ee8b81f1af403bbf293a1493f74dbcf6ad66f83c3d32166b3b99d7f5617e8d9c14e14155b892f3614f7ecf041cf24fe051a15f0cf28005400d5c06e603f700cd0a1009fc1dbff8c5602b5e841e952d3b3157f0bed6af8eb724dad74c04a1758e9022bedb7d2fe509d55885056d12cb479023d3d419c3f11c81cb75fdbaff36dda369dafd3d6e97c85b642e783b5c13a776bee5099bb67952885804a21a052ccb2d45aca5248bc94c601eb80ed800968940fe59b0f7072e3d307c892126030b054fe3105b00d30681d3e99552f5c675ca8b50968e4e19d91eb6cf5d519753a43309d216959c6acab25c060592606e0b75494f22ef82dc46f67de19527ebb2ead9325eeb7c28937c38937c289d765a2dedcbee1f2e4628b1e4eee2c2fb00bea909005f3427456885687683b9bd6e576ea68918e36e96093f63629b049be4d726dd2da26393649b349a24d126c126f93389bc4da24c626913689b0894b920db92166b26d66b26d66b26d66b26d66b26d66b26d66b26d66b26d66b26d66b26d66b26d66b26d66b26d66b26d66b26d66b26d66b26d66b26d66b26d66b243124a9314ab90d1d9578f35b0c89b3679c326af075ca0976714fb0ecb3cbb20e0039d07cc02aa8176402e900da4c93aa2a4ee8ed6203d36f8d37de37a3ac4797425301f580a28a268833fcde7833dea0ab5ed0a45ed0ad5ed0ab55d81cf75c03640345ce3a2f326f4bbb4a418e3276d022bbf5aac6cb038646b6d32d226236c921218047a12f80e780f980d5c018c02ce077a01e7019d812e8c62f6b3638cc74c630b580d138c9183c1c1a5c444381131d146e0059e20bf7680df52373916fd6faccbb9143360cf21be61e4631bd8388bd6d2648baea56c9609ba067424e86375b98fa0d90a681fc8c3d030900975392d402ea9cbf1835c5c97530032be2ea7a794735df623be9e0e368ab20dd9e148ca65cb4147d4e5de82cbc36d32ac2eb71788cfeea1655dceddbe9e2ed68226f3b5a89b42d9164da25cbeb6ce7732bb5e6175bedfb2ebf9da4dbe5f7307fbbecbad37d826dfe1dcb9be3d39f59c05dcbe0fdabde37b2fed1ddfab39f9be5726a366c0e5db3ef91ddf4ba8be3ec3ea60792ea48de20772bbfaeecc8532b44331f2b3d17456ee5adf347485e1aef459b5af48ab67cb71f5f2ecbb7d1372aff7556723bfc9372e37d737aa5d3dcbacf30dc530a8783e722337f9ca3178ffd0c07d73f37cbd31782fc9679daf678ed563003db0408aefbcb483beeee0a14bbb177c9d73bbfbdab73be84bcf2df3b59a8c8e9ef78d8874443abad4d4b3f440a15ef3b95e3343af19a1d774d26bf2f59a3cbd264bafc9d46b5aea352df43823c6f018514684e1340c433314831b64c4d59bfb036de47733c4691e4934457e2a56dac3e527b7bfba813383d3008aa98d15e5bc7c58696dd7bcf27add1c5adb25afbcd6a8b860f47ac6eea894a5b5db2fa6f28bfcb52786a5d733279c2d35bd94d5c69453f9f0526f2dbf193ecbf0d1d072d9e0a61419df6c26c6926eba3d25442b2b7bc1ed58016d64332b29615689b724a64774519fdebff3511dfacc3bfbe36d94ce2baf98bb19eab17a83ee2bd4911d866c8dccd6c8acb745edb2f261a36bd7b4a8aced2013668bcaf2da5b86f9c78edeccbd3ca1acf7669e2849e5e8cdca06ee2d1b2acb950dbd2b2bcbb1c4563d9c6e5ed4a30c49502fca20bfac47fe28c3aac7d7daf57c0829512f4712d4f3ae229f55cfe75d65d55398acb77eb2bfacf77ac4adb24e3ad164abcee4746a5467331b4719a8959161d75ac9c6c95a6c5cfa4a59ab36cfea283b1b55da655b55582a655b1d65b354ab4ae7b355d24255c63554196755b9ed6c955cbb8a5813ae22d6a04adeffc0cf84d2b2c9c34a5979c5e8f5069556c2e7b76882675a0f4b3322937aac4ad942ef8923e44288e4448ced4ac7c15fe2cdf314b3fc2a34a89bcf5855a595fa41a6b4885a0dd57440f6d03dcd7b5d8afc6b84d5560f11288e0c5d6adbb36d4f79093a2f2f45c9003e74c97b5df7b4942d6c75e89207c5d118f7f7a63073e65579331b17fc6eadffee87bc65937bdbffbc21a0fbab2d5c35f32af933b3ac37fe5d45e5b5b9c3ca6bbbc2075fafeb6588967b57a2ac5db84c08ab6cbdc3013abe77e5ccd04fde55575f858120ad40fb00bc86005c8600fc85009c85003c8500dc84000ef0004eef008eee00ceed000eed004eec953d9d963fb7d2f2e75658e915383e3bb200bc8a005c8a000ef4004ef300dc84004ee700fc8b008ef5001c8c406e0b78d0d9d6475ac773846431d6e8a792f2306379e12a10fbd2d5796c66b8b8e1e72a0a0b2d4fdd4229169ea414254bfe1d40f86f02ccaf8353ccafe5b5e054f36bfe2dec59aa8dd0cf35f421cb665efa85c5d03a1c2d6fd273b497e5d23c7a875d42099448a77906f9990a87d04bc3690dbdc974aaa40de6615a4da3e87b9c8777d27ed68646d2db2c0ae7fa087a9806b178732d1d61dcdc8f1eba51050c4f9c3a4bddcb6e2095097e93994f91687923c5510f7a88de67f31c1bcd3dd4855e54ce377fa4fb9997e752144da36fe818f86bcbbbf22af3721a4ff3e965a6895eeadd661bba824e8b45e6e3e044a76118771c5d47f761d41e6c3b5fa75e42a95442fd60b8abe8727a929ee113d5639651cfa2a9e07d271d62cfb04fc521f19b6228172ab7a999c1128cd98a3a5257cc6c1c5d4433e936ba9f5e62c47c6c287b40ed70e67ac8c48f1edaa3ce02ba816ea10db81ac5a2593c1bc91ee6d7f15dfc5fcad3ea5e73176a7582c77f1d66f932fd838ed04f4c63ed5801bb816d66ff44303c979f147e93ccad94437d69288da5d9743dd5d00354475b21cd97f94004dbb345ad72443915dc411134063c5d4b1be80dda83758b61a93c8b7f2fd2c44de271f1b6f8053389556e44ddfd984501783c1fbfc330ff9958e7c574073d4a6b69136d013fbbe99ff4297d0daebbb2296c1e7b84bdc04eb0933c8db7e2c5fc4a7e2fafe55bf89722410c11c3c574b14c2c17af89f79568a55429571e5636299f686db543faf8e0aae057e62073b479bd7997f982f98af9bef92f7250243848a7363419b29e8e79cd87249fa597f0fb3a7d441fd327f4197d0dad2316c152586736800d6323d8543683ddc196b27bd8fdec1fec5deee4d13c9e0fe615fc52be88bfce778922d15dd42b394a07a54c19a34c51ae5216a91df03b50bd4d5dadae51d7aac7d4d35a8cb60627fcdb6772cf7c119c149c15fcdc749a51664bb3c09c6cfe82e8b225566f3c5d0a993c08993c01edf83b6da71df436a4f201b8fb8c3ea72f681f38fc994eb33896c0bcf84d616da05b83d8656c0ebb1eab783f7b903dce36b17ab695bdcade61bbd93fd97b6c2f3bc0be64dfb17fb1635cf024eee3e93c8f8fe393f87cfc2ee277f307f872fe26f46417dfcd3fe487f851e111ad04fc61fc168b9e08a49688b562b712af2442da8395ab956b20f12795edcacbca3f95af54523d6aac9aa1b651cbd55bd5edea4e6bce519a57cbd2aed06ed4166aabb47a5dd113f442fd06fd16fd41fd51fd0323ce4837561a2f6016392c892537fef629369abd06cffc7c56c916b3e12c922d619514c7f3e851653a1fa03cc497f25c6ebdbfa61529b5928aa7e90ec1b85ba91177b27b68233ceaeeb490f5a0d9ec2eacf46b6c1ab4ab0d2d17db4490f761300bec09d6954e885db0497b20ad4eac3deb4b03f8ebcabbeaceb18b7906bf907dac5ca83994d7e86efe8252ad745618643b17fed7cde2762aa47f8999e22076c5e54a0d76e43ca6d079bc3b1d07fd103ae46199bc1d95b0fe22895588892c19f3946df7c04a4ce6eb7909ed60f7f02922875dcb3ad02f14a40deaabf4803a54d9630e52369a7e945c6309630dfac11cd96da25a696d8e0afeca160b2f7f5964f1f3d84fca783e39f82c1bcc3af1af457b36935fc54e213ac88106bdc907f29e2c19b17d24faff1e3a749a7ea43ae56e71bbf985581b1cc2b752863a96de8345d36808dfc27ea6f749bee53b1feee85ef68c7c0b4d5c41c74435afe767d8affc577a849e85155ec7b3d9a73c4047b571ca7ef6f59551aca598089bc66915acf245e25fd4d33c004fef2a7397b98da560bf6c815dfa517d955f4977c15ebc048b721decd87868f3548a6073b103a2f0bb01baff13ec43229647850dbd02fb7439ece516d88b3db01a8770fd333a81bdfb007dca1955680f81f363f40ae6779219b4993ae0cc88c25e3a689e50de83ec9ea35b04a357f558ad87b2483e6fd67bd01ab30becfa15d49a96d126f689b29a5e5266283729a71bd46fe2ff054efcbf078f3b0bd1eecf8135fc5da83967a17df2e77024db70a23f573551e463e722eac3ff84673951f46aa258a78d388c93700991771151729bb3487da219cd6846339ad18c6634a319cd6846339ad18c6634a319cd6846339ad18c6634a319cd6846339ad18c6634a319cd6846339ad18c6634a319cd6846339ad18c6634a319ff1f21bf9f8654fc92209d8a9fe3ec794dafe7bf04bca42acf0b72eacaf38c920c4d7d9e8b5ac7b62fbc799e13c5678a07798e170f3c534c25487b4ee3a37d415a745a74263ee4ffcc7eda2fb69f0ea8748afcca76f927f0f1c157d806164f4eaa0eb4be55dcaa2f88104e832d11ccd01d9aa672e6d45e541dea62eaef7432072387c7c11df56c48c0e364fd9dabfd54409c9e75f5992919a83a78d473b06a3a951c3d58ec391a1d531453848fa2f605556c7a556c9aae697a97c2c22ee977b1b482d61b6b52fb0d8e5dc8e2bf7e6d95b8c9336ca4e4673866fd0f750bb9e850206f94638558a1af7029858e000f88518a6230bfd3efea428a6a3814c5e1f0118b43334d955f78e1d68d7c63b0516b6c3714c3211494416edce94062938b0c461e7d0b2f25cddc5e57d8599349172fdd1870563bb9730bbf8b042f0dc45640f4dcc3f379055756a07972a4b215d71c3c437e1565207a3bed265e4001aac0d2144750623d5fb37eaa374f4e7ffac13307078156cd1878f078d5c1e37907f33cf65a48441755e5832c56dbe5fdcdb3432fc6dab0aaaaaa8e2c4d4f133686b30e4a49c7d33ff4e1bf763ce3182b467452b7fc12dcf04b70c62f523a95445a4b4b3afb02ed463a2b22b9a18ce2a3b451ba42ba61b82008953b9c4e9fcb8873b90c95739f50e2845088490125e95a81c634c5e9727161380c4355b8e15284c77889f746a70a3ea15abc321037ceb5cbb5cf25f6b918b9562065ba14573d9bfa5c209245f27ad488dd2e760b5e2002a24208511ce14a149624ae91df54204571d433e378d5f41950088f948225077c5a1f31e74862713baf25104f71b1842515066948c4e253e97be68d5b82efb18eaced2cde65366b1b7c37f81e5f7a66babae5cc9bbcf0641f68e030e8cd23908c9b92697da0ad8327a839b1a3dc95b1a392af4cfd38765feae15867e7e4dda9bc289979502999c8c7781c633cda03d16c8c72bb5952b214924f704ecce0cc139f43ba47afd0f7eb8a7e7d7e6a20b53a55a4266f655544bc92b8a50c6c37e3052cc02a9860c529cc12c1258d95a1ea44d5c0a3b616d83ad05405aa30db34ccb24342427c5c14d7b5f4f42e1d3b141676ee9495959eceae9713e7c3576c9e3af26f35d7f47df5e50e553fac1c9b3fe2eebdea96f267e65cf9de753da39d3f172f1cdcb93736031d828654420e1abd19e8586254d218364619675c4af7d203ec01759be1f4187e6c922f98429ad64a55e25455610d7a823d9311b0d4c8968256cf6f08b83dea3875a52afc6a8dba5d15ea0bfc559812ce2b37e68b71828b7a7e5720daa3f8950a65a5a290e251f62b42d9ca3e81e55a245a90372fc90355385ee53d6a25bc472d61400f3c47cf5581f59afc16aecda460873a623a515e259461ba259e586843fbe04bc1df58db2d7c1ccb53b79c5aab8cc08c8f60c67d31e348363370bb50594c3f3e955fc797386e766ee69b8c2d919f38bfe74e3ff9999fa74576e55dd4a2c80146dfc85191938dcb5cd5eeabf599c6d58eb9ae69ee878d875c4ff227235fe7af393f14bbddc91ad71c9a53898c8fec23347d3b8f6c501adda52b2e5f44645c444424b4c3a5406b203f1ee1c2760aa98f4bca32b6226277c4fe08411105118188ea8869116a443dab7acead7fc721ecca0d2582892d6cbd54a980af9a310ff34b65aa8162ed6782902f40be9a4d631af6f0feba2896b885efe3ef91ad6455d3a71f3d5e75d4731482ad6ad03388560ad690925521da86441412e4cd3f6a0b7ac33d3ad3ebcdbd1ba2933ae9f25b865c9190795e952d7592df3e11888bf0b88b22bd5100a83fb288fb5d45d6f71cb0bc4a86a5c1c2c426241676e982ad2a3a07df9f1d9cca7a6eea9990d9fed65decc233d5bcbb981fbce8ded29efd5f61ad4f4fc05e1d6b7eabf4564a289ddab3a70297cfc959947c43ca4da94b72d41845687eea285c317d927ba7f4cfbe39f996eccdc96f247f9afc69f6892c574212cbeff8a138947fa8607fc7d379bfe4ff52606424758ba98c991c3329e9daa4cdf47cf2277c8ff7c3a443c9df651fc9891a9dc4da67a48a96517a34a334338365d4b38440726a0136f3b4d4dda9fb53d5d4b428b753b48d6dcb8fb5656de5772b75482ab1684e9c4dd3632c1a486de92e699b1de782121077e3238fc6d195380d8e41cfeb4546a0755a006dd30268981640abb4005ab8d39809f5cd5574bdb7af25f3b4f4b7e42deb795920396268744742053ecdbdddcdc9ed71fbdd056ed3adbaeb7949c0d9d10fe5ce7033c6646d6f6eefc44049e77189ac203190b82b715fa29298d4a1f44d6fde20b9a5f2061e3d3efd68954cce387ef434cc2e959c41317e701e971c950950eb083a3a1d6732938773224e6682adada219d3d974b9da1e16701611c0020e5087bdd29554c5320b0b3b768085d2742d3e2e312d2b5bd3d25b6575ee54d8a5507eef6a567a2b9c2cba7535419aaf2eecdbe0a1821ffef1ce8ee88eb9dee0e168a5e489610bfffee2cfef94c50ce83fb092b1e4bcbda5f9fdbaf79c5994c07ff3deb172d5ec82a9dfbc747eef61dd7af4297fe6e6fb37c5467b8b33daf528096ed5b5e40e19e775282bb9783284722df46721f427853605baa6a4b0dc884a5e29a6f029e25a7eadb8469dd6e2e69475f4345f23fe9efc744a1ddbc89f8fae6d119be7eccafb71c192282ac64df5bc55c095948d5dec66dbdccc2df32531d92e9d325809bb927137c35e3719cb4776305bca56b06dd882eede14e589f24789a8e4160919f27cf0ebc76001be4e6d3dd2f2808ecaf37fe0d1222cc48c7cb90a07ab66e023daf284eca36d065335c5125e4c06649aa86649e98504275ab1c4b2e04f756ffdab86b57a66ebfea8e00fceca7ec36a068e2d2b5bc06ada6e79e5a70f9e619dd6ef58d9a272f8bc5fa75e38f112f9dfd2cc35bf552badf32f95de0bdc97993258f48a181c37c03b20754eaadeddd9cddb2d65747c45cb052d9fa435093be95b3a14f52bfd2c7e7346e53a73e267c74c6ba9c40be86624672c2a32d9c563559e1829a218b9ddfe281617851473c666abae640829ca0d31d05056c360aee4776f8995ac16669125202f0d96ca5a7a32c89087cd3178635fb76089addfb14dd6519cfe904efed13ccb581dc56ff84084562616912dabc5519ee21d962182254a4beb12d237ead8211196c656324befb8921d3ce61d74dfb855ef30ffd10fa7cc64bed35d660e1fb478c8bc21d73d36b3bce781cf4cf6d01a9e79eac48c05533e9b30f38ee021486c36b4681ab4281127c3dec09d37c72cf1f1441f8bb9d57173e4c2a8a30e25d6f038129c22d548863fe58d4e8a8ff5c5f82b0d638967b1ef45c7a6a8b71d9f3abe32701238633cccc33dc2a3785a7a7cbd7d657ee7c8c88991d7e87362e6f86ed1eff53fee5815b955df66ec323e36763b3f711dd67f304eeabf193fc59d4a3dee4bc88bbe39868ff25dea7bcc29fc86779b9f2dc56155cf7f08244afb5fc178851433635a4c8bec58ddf1b621cd52664e274903f1492d3b55186c30dc5b4bdcbb2170d5a8e77d031d63b4ec089731cff1760befed5edec2cbbcbd29c193e04f10090b5af9336e449719b6dd39e656dc5fa7855518be1b3e674c3f2ef5b797fc9a27cdb68b9a1cb86da24d61e6b4907d94b40ec6cefe9e1b698460774a8e4a8b92d4421ac51601b46a212d630b69195b041a2a47cb9d029fa86a46310b6d100410d824b049d6d01ef3df75ce22871cc15964d8c4ca39ec9cc3ce4559b9f55145e1efe0c1e1846ed2ec6dd54595ea439d3b75294c93562c3364b27465ec99023677d45248b8fcd4431f068fcf5dc53abcfa4df024bbacb2f2f624b625da71d90df7e43df82073effb64cd373f7e3c696cac73d6ac453742838662e33d8e3d87088de981257e473f51e358e9d8ed38e6d01298577037770b78e886ea55bcea6a7d9de37565a7b653ff483bca8f8a434a64ba92aee63b0ab5427da43a4a5be058a62dd35769abf44322d2e0862087a8e5b5623b87abcd778b1ff80fc2e0980813384c88ab4c8363af334df3eb14274b6ac44a510b6f5cae4a625227512f3203510a224905ad7427ac15ce92fbeab4a1b07ef7215cc28152a3b3c1e0fe0e4387ebba797d688b4ecf83ef1a76264a8a3d27f2a637daa245565077d65d2719dd41dad3198e915024c316325f61f0404be6fb227840dd123c5d73ea1319c120c8535ec0ae4b625302cf397566c8ffcf5637dc4a8ca1f9532a0c91c4d9b39ecff4c3fa618f72880eb9bff388373d3b13767a3ff528cf453c1ff9babed3a53c195f676c723e87c030b18ff6a4f3c9482533b18bb34b64619c924919ceac48b1d7f991ebe328b1c6cdfeae3fed783a4accd5af75cff5883e4e787e4ec113bd5e98b98808b7c3e932e299d770b9fc116eb8736ee6f5fa93282e29895c1111de24674caeaa33d2dc1194e4710d8db03c81be9d6b22d80f116604f747ec8ae0ee88fc889208e18f981fc123ea7987408477e8e0249674477244629225d781a1a808bedaf4e9d81d47c31191347e216f2de406478584bc386ac70ed840fb23142a36fcc80d626f0fc33c56e72972c38b0371d65bb94890f59e22d6681be8a1e35b474815d67d0d19d689795227aebfe8c6fbd2fe163c705d6acf6e25cbdbf8732e081e50b2968c2e5f36afeb43679ee2172c4eee5272d9a81edb82e743efe7c172be85358c40acf56ca053ffa4dda9a7927e4b56de4a7a3399b7e6d9464e4c7652df98fe4915a91395394937271d4b7579a415f04803e0c916d035db9e481a28406162b6c31599a105720b3a6981be9db54059e775da2e8d8fd3966aeb345343b0e2d1fc5a85764c53b57a561e48f0a7b2d4b80c8ffc163f3f3c30415fa7b41e68992f78c3d34f5826280ff60bae8f84941f4416eba1b40e148fcf565959acd3d973b74be13c3690b98f3023b8297864d9a119a2c3ec0bab6a2ae65d38ab6206dbccb2d9b8e0994f83c1e0cd733e63e513af9df9e9d8198b262c256efe129ca2ec85343cd4924e056e1f18d92fa64f4259eac418b593abafbbc23f31669aff7e7ad0fda067353de9dee4de10f306ed8cdae9f9d6edb9cd7d9b8767383312b881bdee8e9d18bddbaff2e82837e3292c2a2e222a9a0b0fc3f9eba1388f9caa9602658c835187d1f666acc381c20d29b3a58669f071862c10f62950614c93a7002b7fdeef670b709c583bdf6def7c0f79d86e9c591ebf67018ead245f3d5bb67e64c8959c31107bdf532545383d6fc6d1ff3ca21b9dd03b2cc59c6e2b6458c73c08615b658b73ce6818ad6ce6491c75ffa8a7de5ab7ec9df7a7ce0c1e60fbe60eedbb70d48cd143170f50b22eefd7e39b83c103af3dbdf6ccc762ccbc5b2efd61e2ecf9577f256d46299190fae6a60381aa4c9ee9ece4d8293e8df83e421b2a6040b488c4884cca8acc8fee1259ae8f728d8bbe529fa62d66afd3cec89dee8f22bf8d8c891409fc41fdbe286584be4ce79c8bc828a67187c223595494df4d716ef8336ea7a39e3d1b702872bbe35894875a20eabcce151af3684c2a20d7a42b1eedd759b5be40e7fa1deba259749494e980e707c387bcc3e34670b699258482b3834765f83fe3a0a58c0ddb3d2cc8224b8e528a86f4736620e29a6149111e8e6ec94cee4f3f8bc85bb6ae47df2bb2db0c7860646e1fb931dffdd677246ada0b6f0537403a6db11b2f8374dab0bacd946eee0f3870b67afdf8c8acc7d1e9284a0709dce62af2b4f3b72b68176857d14e754619ad0b5d7d2366a77f1ab927f350a4a1a7ab9909e9b19919997d9c65e93a6493bcbb9df0b7ebd4aa30b3ac55dfcc40bb2aba206a787c45c2d0c45119c3b3c6b5a968373b6f51def2a835f12bf356b6a96df756fc5b09dbf376b4f92d39c5feef15fc69add23332b322e3724961893e2f737b7dde71de2b7116ca6029262635370e079215dcae64db99c2ea456ac01da3e4e6babcbdf3134b12075bb794c66e34327667b36cb91ad9aece94edc9f667176407b2d5ec3bdaf97a7b58463e311988f10a5a47bbe807522ce73e6230b68e67b787fba1e9f5ec890d6d4b6df7667ae8be947472f2ace839ece528b65552425e8e12f27224ad83d762c742584d3b7a7e4e61718c5355a5d53a10972a4d5caa747452a59d4b0d3434c17845d69649b41c9ce9345dfa37f2526c6682657c3a77cacecacec8ce0a39280809b2a50620d24a90bf08bbe0fcb6650999578cbba87bebf884f1c1d33dc65f7823e3efbc971afc353e3f3066cce09ca49bdfeb7b49f0db6f4eb1d66d46f76fd332af4562827f648741d75d77c1fc650bda756b915d9c9d93ecc939affbb0abeffbe269e8ce72f35be15797e1347e3bf0f360b154ec13f8c712157697718feb53455cabdca42c346e4a521873eb858a88148f88d7c56bcac7e2a0a2e588f96289109ceb8a2abf4550d71c9a378127a8d15ab4eef124441f32f67bbe4b3aa645ef4bd9cf0e2a0734659ffeb1b12ffae3246587b6c3f33efb50519e37b645ef603b15e5096395e349ef1349b5ec055d5b10bd20e56e6599b1ccb152d1467be738e67a17680bf4051ead555299d2d7315a8c7654c66bad8c2c87df9311dd363ecbabc13208bfe257d3b43470e27229de840491241248371417e9aae2c29e17090cd794286754b42756d4f37e81d68ae252840b4e711ceaeb6e622624938d681656f21874273bd615fd76ad5422f8d491dadb3a7c265367b5709b5ee06311851a300a0e177b7b05da754c922622de955193509bb03d41d8fef6f684e3096ac2167e3e25b378e9645937480f1e9f71d073f01acfbfa18edefce3c7a71fc47125a37444eec58ba3ecfb37e4cd97c163519efc70e367b17410a44f70ae4b20e378b81696df1cdba563974cd1514f17a1c34db763a72eb1cbdbdc96cefa0f5cd7a6b62a29b74becf96d070cba7f4966a518b267cd6bc19a3dc15e73a3d332f53deeab27b55fcfd6ca6f42877539ae6481ef018139dcf01475779c1737d03130ee09558d7546bbb8e1f55292378772bcfed47ede69a92b5377a73a299539c9c90cb7e149e25e4f527266446674d7e47ec923a286474f8c9c187549f46c7e75d455d18ba277a8af7b5e4bfc90ef4bf828f9582a6c476c4c6c5c8c5b28aaf0c4eaf1b151ee98e897cc93140528e6cfe4358f054aa37174b96360b56398a2f8bd140726082aead1a2639c7a6ebccb9b92e38e21af277af6fc985d31dc175312333846a0ba3f667ecc0f3122a61e315f9a92415e56e35de9adf56ef7eef6aa7e6f81977b1d3189de446f8a73c84869c58bb14bf3b140cc76dd6cc72dcfb39da429b77d37ac947af61e26eb8a1fb958d6299958b4d8f0ecc041197240a489cf83936c2f4c0fdea5b04b2cdce52ea10562ed98ef466fefce590306f548894db84cbacfc75bd6eeba71592b25ebccadd353db95b6e87e7e8f7693d8c9539fd43cbdecba2e4f60e2e6fbf0aabfc12ab97861e0e398e158b7481990c66ab1ba3fb222b23ad2700a5575b90a22039163690c1b678c768c74398b453fd14f9b48978a25b482968bbb35476bd15669ab66e919465ba73fb290178a42a3d05110594efd593f3e48942be5ea40ad9f3ec8514917884ac7149acc2e12d5ca25dac5aeab95398e6b9cb35d37d38d6cb16305ddc3ee77dcef7cc85513f98d6823346c3ea1c0eb54758ea3cde174184e15d6835cc45c8ac3e104d72e1ce70e4435ccd075555534a7cbc5e4039c83da4227736ee16330c3be01a7bc3376502cb46e8d8d798e2f3418e2dd3181886a7da55eab6fd7f7ebaa5ecfb3376987c54295a95bd14ee10348b0b702ad7c9cb9b98f8fe3c2c7fd2057f2f97c295fc7b7f15d7c1fff81bbf816e86e44689b6227ce3878fc6895e70c8e892a8f4c54c9ac748b3cd6d30cf909bbae1b9e62a378b1fcfcdb0eb9e4a1cc8ec5e1bbda1b29e049ec6439150e2428c7e196b9bd75a0f631215544c652d8c3d6cdb8689727a648004a40d2d82254dfbdc955447e97e5e96f8a2e124674915a6feeaf8b2ea27af3cbba18497e420ec1f05e79ddeb91d7b7079cee2297d78dbcdb0e0b42dfcc2befe25a41024b63d63d767cf2eec17f0757b223c19f58fb075924ab0ac6b288e02e961bfc1012d382ff64f9673e0e32fa5f442545460d0a656e6473747265616d0d656e646f626a0d31392030206f626a0d3c3c2f42617365466f6e74202f564d424351562b417269616c4d54202f44657363656e64616e74466f6e7473205b3231203020525d202f456e636f64696e67202f4964656e746974792d48202f53756274797065202f5479706530202f546f556e69636f646520323020302052202f54797065202f466f6e743e3e0d656e646f626a0d32302030206f626a0d3c3c2f46696c746572202f466c6174654465636f6465202f4c656e677468203439393e3e0d0a73747265616d0d0a789c5d94cb8adb301486f7790a2da78bc1968f8e34032190491ac8a2179af6011c5b490d8d6d1c6791b7afa26f98420d097c48f27f41c7c566bfddf7dd6c8aefd3d01ce26c4e5ddf4ef13adca6269a633c77fdc256a6ed9af99df27f73a9c745910e1feed7395ef6fd6930cb65f123ad5de7e96e9ed6ed708c9f4cf16d6ae3d4f567f3f46b73487cb88de39f7889fd6ccad5cab4f1945ef3a51ebfd697688a7cea79dfa6e56ebe3fa723ff76fcbc8fd154992d569aa18dd7b16ee254f7e7b85896e95999e52e3dab45ecdbffd6bd70ec786a7ed753de2e697b5956e52a934215142007bd421e7a835ea00df40a6da135b48336996c096d210b7d862a6807e14c70661d64217c0a3ead8704c2b5e0dabe400a9141c860d75080482424b2241212591209892af41c7a157a0ebd0a058742858243a142c1a19042677acb24f4e2e845e8c5d18bd08ba317a117a517a109a509c199e24c70a638139c29ce04678a33c199e24cc8ae647734ef69dea1e7d173e879f41c7a1e3d47f39ee61dea1e7587ba47dda1ee5177a8fb77755af2b4e4b84b9ebba474e6e94ce9ccd399d299a733a5b340674a8640062543208392219041c910c8a0b80eb8565c075c2bae03ae95fb12f27db1552659fb3c92efb3f718cef405311f93dfdca6290d7dfecce4697fcc79d7c78f2fd1388c269d7afcfe0213d218720d0a656e6473747265616d0d656e646f626a0d32312030206f626a0d3c3c2f42617365466f6e74202f564d424351562b417269616c4d54202f43494453797374656d496e666f20323620302052202f434944546f4749444d6170202f4964656e74697479202f445720373530202f466f6e7444657363726970746f7220323220302052202f53756274797065202f434944466f6e745479706532202f54797065202f466f6e74202f57205b33205b3237375d2035205b3335345d2037205b3535365d2039205b3636365d20313120313220333333203133205b3338395d203135205b323737203333335d2031372031382032373720313920323820353536203239205b3237375d20333820333920373232203431205b36313020373737203732325d203436205b3636365d203438205b3833332037323220373737203636365d203533205b37323220363636203631305d203537205b363636203934335d2035392036302036363620363820363920353536203730205b3530302035353620353536203237372035353620353536203232325d203738205b35303020323232203833332035353620353536203535365d203835205b3333332035303020323737203535365d203930205b3732322035303020353030203530305d20333031205b3739375d5d3e3e0d656e646f626a0d32322030206f626a0d3c3c2f417363656e742031303339202f417667576964746820343431202f43617048656967687420373136202f44657363656e74202d333234202f466c616773203332202f466f6e7442426f78205b2d363634202d333234203230303020313033395d202f466f6e7446616d696c792028417269616c29202f466f6e7446696c653220323320302052202f466f6e744e616d65202f564d424351562b417269616c4d54202f466f6e7453747265746368202f4e6f726d616c202f466f6e7457656967687420343030202f4974616c6963416e676c652030202f4d617857696474682032303030202f4d697373696e67576964746820373530202f5374656d56203536202f54797065202f466f6e7444657363726970746f72202f58486569676874203531383e3e0d656e646f626a0d32332030206f626a0d3c3c2f46696c746572202f466c6174654465636f6465202f4c656e677468203334393634202f4c656e677468312037393130383e3e0d0a73747265616d0d0a789cecbd09785445d6067caaeed24bba93cebe271d9a84a5814002844024cd16046427214122fb0eb204374409b21a1151470671c31d50b4130284653e187574640675dc66dc517117751c64dcc8fddfaa7b6f0871c199effb9fff79fe27e9bcf754d5adf5d4a9734ed5bd9d10232217559342be454b662cbab7eee34f89c6b625f2e42e9872e5a2c41b5d8f23c7b7807ffec269535c83436d88663c45543279f682a55796cdde8f5b2c09f109b367cf9812939f3209092f036d119dfed9b0b26308df09f49c35ffaa9943afdd3482e851d4bffeed998b662de8f560429068f052a288f0b4cb97fa771d7e6723d1a47144faa524fae64045ef3ef2e0a4a8a26f9ca94e123ff7bddfaea3a0afae3ef1f9f78f9f99e523e768390a264b90b83afa368ea0013efafef1ef97f9c84a6ffa89de2c52a27fcff750111d451b9c7c14a2b5445aa2f63969c475ab082f6c4298ff9d2e51ab281e18e248a72bb4322a67eb6802df49cb0594740aa98fd212e4dd89783fd003a22cf29702ef004540199062a50d07a60063451c79f78bb2a86391a847d22a9ae0cca4855a997106ed6dd69ea199c0dd08dfa7be4fdbf5425a80f803287758252a10795066b3be93b620fd4edc9f86b4bb41cb11bf17e18928d7d50abb1c3752b2a0808ef40ea8e7066bbced943f524fb5ca781763a9409d4381b56863146809300c796241fb03ebd833b49e3d63dc87fba0b40aedaf13e9c0408b5e887ad6e07e31cab5457c15c229e8870e1a056401edf9a354c8e3e810682ec63fde1c37f00ccd16636e1a13fa6ff5e9a730fb38ac39d0e61f80002f343e007535eb5b4bac6a81214a3e5583ce035281d1fc182d502f22067eddae7d408a002453f0e96de002753a8d409ca19f63b57ada2ae2c070892ae38c7a276d534e512fdc5ba66fc638a683dfdd80d394cb3fa7ce7a36ad807c0d44fd2b81bb51e7c7521ea6d338b4df05345ffd40cad05a6003dafad2e693e00de22b31af63d0d68f62c5a0fc586030e6a51a982ffa83f67305cfc5bcb3b2c642e43d813c1305909e2881b10b9914654479d4956dc9e17d6729dd873c3782afc74155205ef4c18694330bb8f734ea490674201de8027c00dc07cc037a03c380f6689bd0ae22e51532236453ca0764437b063c44dfa4cc9a63b85bcea7b966eeb5ea12ed64e98fd23c0b59a24eb15e84cca22fb576dd624d0999b1a994ef7952eebf10e31432d544b1f6d4cf68b0e8835c83902d9b8a75873e8bf5b09997d27a491fa555426645ff6c2af822644df2046bc2a245cdc6da55ae1150852860c9fa2a9bdabc68a2b3e901d439599f0a9db28d2e5497d285cacd3455fd8a062a1da88bd61569180ff286f96734c67984f231972311bfbd05dd22e07885cdd58e609c8f809fafd05de0e962f515de467d8569da23c6271ab167b547f8b532fc13da12ec88794f5081e6f7fed3f4ff06fc55ed11e8cc478c4fb5570c03e3b945ac09c767ac2be0b729d2eb806aa0a333c8b638e7b1064729f974a253c0423544bdb51015a847303ff1d0f3580b482fd5dea5c3ca8d98eb578cd758355573d4e188a7297c33741adae2afd22a01513fe8a26672748eccb594259bdaf2da920a9d6fc95426a88ef5f79c8513164e03df408e86412693856d10fa59da07e86860ad25af739be4f3597a10f4065b3e5bc8e9dc16f2e96929972da9b42dd0eff63a455bd7dbe317fa51e838a123859e137ac6cedf92362b5fc377428e851e3e4613ac75ddc6c250f4f13d6bed430f63bec71b865e623cacd71bdb951863bb9e87f03f00cd7818bcb8b2c9a6961b8d963ded60db52339d226c3baae5d3024b9f3d20f5cdd7f43b6947cb64ff5cfae3b442fb01f30e1d28fbbbcd5a83e027fa3d4f9d0c9e6fa50d1847b2b20eeb11e9c044c11339174449c22e089ba8dc063e0b5b7423ad52de80bf20cae653b4b417c5341e7d7f56a6c1a60a2ad2b4f1749ffe19e5a9a5d0b54768ba982b310ed11f31f7cecbc8eb8c879e7885baa93b90279edcc8b74df220440f4bb91065e7c107022f1cd3c801991d813ca2be7b659910c558fc7840f24296872f226458f00275eaf13446fa139fd13d5a298dc71abad7514df7eaa55873f1b41d753c887243455f502e45daebdbe862acaff5d04deba17348caff04e307e5118ce74ae87540a9068f1ea124ad1a3c9c27c73e503575ec3ab17e949d94236444bf0d7a58f813b7518d1aa441fa3cba1169376ad09368f706a4adc6fa0d62ed5e8ff29996de26b47d3dd245d962e1cb081f41ac17478862f56ae90790ec83f053d0bef209ddab0ca5f590e37ecedbc08735d4997ed38ff1a849191c4ce339c547d78016f07c7a112d44202c6ce87e7525cd51cb284fe986b51b4d9dd5bf61ad7e4777285134493d4a77a80db441c4d5586aaf8431fe7af89622fd791a25d2f98b886fa1096a11caafa74bd54954a5d442f65e26b73a13738d72da46c8495b94ff1af55a60efd304a50c6b6b2dc2dfc10e229f6ca3de1822a05e489d65b966907db5d1a2cf7c18463514738afe8af039fd455f9bfa69f7f167fa27c729ea45399147bd035e3b196f02d9266d1ccd6fa447806dfc751aa00ca7abd876e300985cd20217368fab3dd872a08bda83f6012b11ee04fa3fc0e3661cbe5b0f7a035883ba8f80ee16fb0201de9f7a0a8ab4bb812dc05fec7bcd21daf9b9f4e6d0528d03e7c4f7c0d600ec947140a0657ef0b927daeba95e601c10802c0e15d057509ce3728a53da213d03e55ac4b554aca73dd45621e3dfe7ebd3af013fdd9af131d47c8cf67c8026fc06bcd98cfa05b56cc37fddb7ff1698df68a0abe4ef17146fca10c5b2578dbf8396b157295ab90c320820de05f1589b9ff63c21fd5699de62fe787fa351f0bc657acb78cb793d5f9cefa649cd61cb41933cdc427d05d462e4075ac69dcf525f01fd4fb8f7a79fc6d587cf8309d451d92afa04196cf7d3b83e92da09f0b6e86b8a2883350734c59f878e00445e59de4b8305c4da15e0f5d8af014df77bd02081b37ca59e82afca56f3be3d3ff6bcb49c1ff4af9bfa1cf5036d07da1b742ce8509b365fb32dd76dcb345b97fc5c9e166ba3db2fd5f9ff2760ed1c059e019efe7fbb2d469055c007e86fc20f29861ff90afc938b6915d119e8921f738187a087c681fe1d69b0de8d1d002fc2d1489b057a17d10fdf20bc04e9af9830b89a4adb2cbf3219697badb24eabbeb166f91ffe4cf4fd29e071b3fc0f3b81b908ff13803dffe12dd03f826e41fe4f516e35e813e6fd339310bf1c3884f86788cf07ca11de041a0fda09880562507eb380f0477eb20ffd3fa73fbffff8ad143ecb34f433539c79812e6fb987f8cdd49ecff3d0967b0d7bfecf479b9d19b4a0261fb0677a0f7e5fb8f9dee7d7f63836c57c3636875a6a9c814fe9117eb4f06585ff2cfd478bcafd9bf463d12e519c4d85ef2cfc57e13b0bff15f45e7966a0c9fe948a7dbeec9765379aeb56768aee067c40aa45e721cf77bc9df11c744f14e4fb1bec8d1e10401c324665268ce761bba260eb0e43ef7e037a0cf174d06f6c9b66ebd69fe8d8f3d8b4ffebf87f6a23ff0b9b9a6761520bfc52ba8d5e168608b4b4c5ff29ce67bbff6b5bfe0b36bab99dfedfc66d3b6fc3d597f2041c21e380404bbff4277ec079e2e7f373ffd3784bbfe33f8eb7f04bec784bfce47e4bd9b3fd99144a69428b75f79f42ec2dd43d677d7fbb0f2dd771d37ab3e2e0d1a0e6801e686fd9d0fb807f4167a403b051c62d885febfc91f29cbb280ff1f500eca2510c4c17f7407bb21bc5f9b67106f1eb10f7a9c764de720bd3cf27cf2de556f8e7d23f04cfa41edc24fa4fb9401f2006a80516d8732df69068fb3887d515fb5c7582f18dfa1cd0c2073c2fed418b815d8847211e055d1ca747436f87e861711e0fea067543bf8f3e7bc6679cd197c93c43e5d9f252ba107afe52f51571f6653c25cff41a29cae191cf5156c18666dae77488c78bb321875f9c97180dd6f9dc64fd6bd8c1f1b0872e613bd06e997c26344f15e7b85fd3ef94081a689d21c7d967c9e27c4ad82bbd0bf9e43946f373e4f7e11b4fa48140b16a3ea72a15e72fca07f259cd3a71eeae8ca043d6f3adb07b27dded7a86ee764ea712e70af9bc69b37227ad42da9d8e8d74a71e94cf574a6dbb2a6ce2cf9cfd89b3cc94a6334d6bcc2d7d02d9bf897491388f69deae5dce59025bfab53c8732cf31cfe3dbc0c6d700d3cde715c6e99f3fef34fe6a9d7bceb66cfce54d36bfe539fd441aad5c8b7d9f7d26fb10e8ab7489ba16b078dcb22f765be0cb995ff2856cdf04e1f1f2accf7cde23cea0629b3d872b917cfe44ced71031679a176b384accbfb15f359fcff557af447e4ec9ea978079f6289fcf89b361603c7f0df9efc61abd146b0532a8de2a9fe1adb680bcc643b2dc7cf3b9993e162846bf66a2dc4ef1ecc806ad390be3845a4a3512f25ccdb88fc719fb4197f0bfc8678c51d6b3c06475038d93679a679f0926a9ede5b9757b751c80f907ae42bcad1cbb4525af4228174543e418c5d95c1722dc732a7dac33522baf631f95384290d7082ad176535b6521fc9723d0756998bba198d7285aa5bc47196a2f9aa644d3740156623cc73e0385a72ec03f45fa6ba037232e9efdfe9d2eb19fab99e7d3f483c451f80a80f52c57608600dfc9b2ace784155638dd0c23ad90f64ad875eca4879a01f98cf7801ff8efd0767f9ace1bd0c636f405ed283eacbf164099a916da5bed0c56c7638d9d8b012d81b282e6b604d205cd6e092b3da525902e68ff96407aff9fe9c72fe5fba57efc527a4e4b203de7ffa01fbf546fa025901ef895fe0d6b09a40ffb0ffaf14b7c6edb12486ffb2bfd18d112481fd1b21fd04fd8c7363e8dbde9a3a0ffb0ecfd27a0178142fa1a9f12e7d8c04c2bfe0f2bdfef01ec7f8ddb01ec958dfe16a0f30cb1075e07fa39807db531fa2c1a9f054d33cfc8ed768c5b818e4099d99628db78d06c5bc26ab371b759fecc2ed03fb78827001f9aedc9b685ee3d001a00b65ae35b6fb51b36fbde78ebd9fc8d69e61865b9f059180a3006e53341c79e45e31e13c693a08f01e25cf419ab5f229c61f1438c799fa8ebac5ea0efd5add019938960abe31c3b4daa5e4d17499dfbfc39b66a91d487efd376a9ef0ce8be22cad3bdf043eea2fec26f103a5c9b21f3dfa04d876d22f827f015a4bf709c34f54f94ac7d4093d44b69a0b2177ef160e85bb4219fcba06ea1b785cfa15c4fc301f9ac523e1312cf4eaea475ee7ae9bff890274efd08fdbd9d0e63cfb65e2b2786f2baa30be29b60d7efa52bb5ab699973011dd6bf12cf4c6926ec55a63e890ab5ebe8427b6fab2f2097e6815f6051e7169ae6e884f49de4573fa434d73af8752fd028f0acc06ebbe9d9bd83e290fe9079be22e50ff831085c24fb8cfec20f53b1b78eb3df1bd02ac193e9b23f23e433a71da4628f4eda97b0dd43a8bdc305df2b97d6bb92689b7e1ae3d0e1a706e573f99916efbb8ae74f8e59d44d5b4739f6de5d3f013e8f23b74dc5f338fb3c00bedbbdea6ce92fc6c8e75ad6794013b5eb10cfdbaa69837857a2a55f63fb514d3e857546d074e6608f0754d8cfa6f15bb499bf619e291c817f1a4f41f11c4f9e89b4a4569fe473bc239025cb9f751ca6a10e05f4219aa9afa5b1da70f02596c63a9ea418c7604a12fe99c321fdba05c2466bdfc1171d4b39989b0100f614c65cf3b9985161ad7171e6f677602216e325569a38abc09c1b11482fb5cae2be7199b9cf9079c4f3b31a2b3cc0c274338f287be62d2bffae666735ef9890fb107f733fd57a976aed4fe8d967f7427e4ace4b7fe3199a58c3e29daa9f79c6df92de0a3adb8ec3cf7b076bf41694f503baed47b7a4aaf9bcff5a934adf50d0072d7abf9035e1ebb5a42ddf5ff9a5f7597ec58f35d7994dcf7defc5a6975834a7e9bd9cf3d0e6efc99ca58661c5237febd99d75e69662d39f79ffc03c933b4bf59fec9f9a533927a4587eacf0df87cae7fce2dd9c5f41d33b5cd74106ce459980789fe0e7a0c3920838e69f0bcbcfff45e837a11ce0cc6c09e35f02e8f34a13c61d163eb3709f80c2b09706d49b5bc2f897c4cfbf5f3750bf0bed02cece261ccf9a90feffaf003c20072ca93346525dd8c25f05bc0c01c797166eb061180236df6d3eda7cc1d83ec4b86737f5d96edfaaf77f3b8fffdb79f9bf1af7aff5bd39ac77f46c2adeddd37fb6df981f897f9990efd2eca4580b3af87a107804386ae15601ac9514f1ae923203f23443beafd854e627727023f6a60256dc7aff46d7e1d93992cc7520defd3141153fc71fc70c53fe1ced4c3ec9f7764cdfeb038cc36bbd633bd3d27d6d5da3e85eeb3dd94ca15b6077c53aefaafe91669eebf31963cdfdb4711feca486fcd1da522ae17f31eed79641277c65fc595b015f00405bab2d3c6b619be9fb198f5bef41eaf27de09db4a339b0b7cd1010794c3b693c68f9dbc28f5d62a2f12333fd6cbf6cddab7c8b71fc40c9f2fdd290dc5f8f52e7604f3f879295cf701ffe8278dea44ca17ec266283de15b89776eaeb4de9715670f6f839af0822fa394edcdd6b778bf46bc5703c87772c43c3d0d1b20f23f2dcbdbfbfbf6f27c691ef4f81b9429dffdc13df94e0fea10ef3a09bf48c18e421b09b9188dbca38dbf295b402fb4f02d7029fa5b4673f86aeaacccc47ef805f83bf1485f0c2c443809340aa800ee042ea76e32fd07c8c9f7c80f282ae27f05d5b0b7d790f69d850d26c47db9dfde4bd3e1134f477d66be576419133a4d674fc8b6a62bfd511ff271ec941478144abc15d6717f0dca1d36f7efe25c41e497f7ec3caeb3791cd750897b269528ab4073e147f4330eb04fa8489d40d198532fd00373fd9cb57f10fba6e70170cbb81bf1a3bce57b01f673728b6abb688e760175d6cec03f781372709c8ab4d37487564cedf551b0638fd292e66f2e89f789e5bbc4af18cfd967df36f4728a77fd8906630e49bcbf6153fe0820de762a95f648be4bcfb0dba247cc3ae5fbd3e65a937eae6320adc23a2e012eb4defb9e693e1f830f8ab5a79aefa9b6571fa474d4c4cd3d5423b86588f53016baa1e9ec5550f14e9b902dcb17143ee6a3fc45b1af455f528c037c146558652f36f7a58638affe1d20ce2cef6cf6fc69b3c0ffd7cfb7788be750bff4bce87cef669cef5d8d9fc4ffc3672a2ddfdd38dfbb1ce78db778e672bee7659055e12397c0ae1cd6771aaf20be0fb819faf50101950c439e8f9afedaf54a04d6f652ec4187505beb4c549c9366407f65a81be499fe5ab33e8a856eea6f9ecd1b3f5adf7390e7a9e26c4ef8a54a92fc1e448af5bd0651ff50ebfc567e6fa2e99cb63b950a5d2b74aab419e2dd6eecd3a06fa60bddc29fa57cfea3a983d82b122474913c97ec8f3ef697548679474ba7f42717cfc7586e35a14419cf4a9d1469ea2c85505f83d067b0bfa6be4a57524cfdc55f3675107f1b796c9c023e15cf6ac47e5aeea9c5de6c87b44ddf9b7a52ea42710e89b0fc3e8ab97f8a126b507c0fe67cfe92e55b3ed2821eb4e9f9fc42abcc2356999fe6b79eddc096c44a9bfc0c7510eff636edbb88f2e5bbd11fcafdca85b82f7c90b37ebe7dde2ee70973643edb672df705e2798e985b7b4f6f9e9b35bedc8c4e3221edb4e0e347f0cbdcb0bb17c936a0e3e4f39e2ae394d54fb13f49869cded0b4f7b3f772f65e83a88f7a373da0cc822fd455bc9324edfda166fbdb0704e43b24cfd283f25d6650a41d43be0b4dbb216dc89f801780bf015f00af9ae754675e13df1d127c69da0fdd23de1f68dcafbd097e3d4d2ee74594ac1f30fd15a59a9688737101f1bd0201f9dd291b3bc57b35f25da83ed67b84625f3fd0a2d0b93444eaf92af97c63a21203ff6014e4a4842e40bc1bc217a8d7c0576f279f5395a957c9efc4942ac9e0c3d9ef57e58934f55ae4cb95eff78e55afa652ed4f34577b89a669dfd243aea1f410e89d0aa73e5a3ff3fb13ea122a11fb34f815ebb81bfbb52a1a01fb1009df678de88bec0ff28b7b72dd2e864dbb9eb6a84fe2de47a00b0127ec582ee25fd116f6296d51aa304fc8a31c92ef4d6f513f07ed86fb0b2cfa06d216403ff890ef2dba599d4d4ebd023a672139d5f9402465ead85341cf4c441dbd50a69b6ce723d8c4276993ecc3cf41f469a1d5270bec53e314fab411742ff0badd979690fd680ed18f967537c747567f5ab4272078d11c822fead7d405ed6f06fe00bc8c3ef505d66903cee5577388be36e19b73fb2d796843f0b225046f6d445a7cfe1908be37871cf7fcb3f3d004f040cc899c0b4b0694c7d0b6088b718b3c5f997d143220656402717bfe219317c97e7f28fbbb45cda6b9b26f68472b812ec0dc831722cf98a63a4d79da28cb897cb827e750f44df0f971ea20fbf08c94ada1a25d715ff0533f4551fa5ee4791d6d2420cf340ac8b645dd6bcdfec9b273a0c350973e0ef73361ab3e409a4082794ff6df1a5753dfc5fc8bbea34ecd6bf61dbee416acd18bf4f6a82b03f997c3af1432520a3c4d25fae372ae6294006d813e68d3fcfb5a40a29526be1b3604e808e45b7141dbc875fc5b21d6fb6fc5b7522734c79de783d0072d90d7324d4d301e6d1e17fa0318c1e7803e28c38ef3d5237494d04fe703ecd8c3b6fe6ad986d06502f001229bf45a736ca3f1cdf82f792fde85564fd25d027a047c9a57688df63eade139d0eb39a837873a0119c034a02b900aa45be860ddcbb1e24ea0bd673395447a840d300e44be28a9f0bdb1a20cec638c3bcee703b7f4f56c1fb0653ef8894fb2578d49a09f80aef9a5775d7e29def25d9a96efc49caf5f3ff1495bbed7546f1cd7c838ae6e363e564f181f3b26c2277c9df21c91a0b15418b14f3e8bea049efc88c03ca04ad096fdfcadeffdffd6718bf704a54f71ccdc73897dbc7c66f0a8e57f54d104ec4bc57eff5ac4d31d8f518c1e4f49fa08ba5bfb1f5ae7d8412efdf5a67758d63a3790d7114b49ae48d8d9e7ac671cd8e76bf7c3ff5a28cf4a63e5778985ffdd860e2bb990cd03d02b4be14b55c0aedc416eb93f14fbc137e1c36c12df1135c459cd40e13b8967f4c26fb5bedb2cbec33c472fa29d1165c613cea1464c8487f2206703cfd9b3be4a9c6d97eff297986994c247631fb69d3a344bbbd0a21d2c6aa75f2ae94fdeb734bee35de846f9dee5edd82b1c96fb78e18b44c1878e1550db19ff16103cff35a8d5d45640f90073d82c7cdefd628b77f4cffb0efe79deb93fef1ad987b52760af937954220019ca30fd4b41e579d448d0ef40f798cf4b8dc12dc2643eb713549e65b505c65bb8a50572cde7434677a09beddf8bbd7df3ef1e89ef0e597bfe8ef6f783d481f0112f005ad241cdc2823fc8afb4831eec4a716c1975411d978b330eed53c8df5f81035402592f91e147e13ffc19f428e47b293d20ef0da207d5427ad031831e844cdf0199bd033ab4487b886a64b9ad7487ee42998374b3b6d3f85cbb1d6b4bd4b585d6e9e391ef63dc4fb7da82bed406c3d75980f03c9aa3fa5167128dd2aea15e3af67c7a32fadb8df6ca77502e36ae625b8d7b792665b2d78d7a358dfaeb3be83af895ebd4fbe147ef005d00cca20b952f4191ae8db7ee218c3de13a7d17e2e3115f60de87bf5222c357d246c4af634f18f7ab0b8ca79487b03fc27dfe34f9641b019aa4ae9265447bd7e90f59ed2ea6fee0e53a199f657cab2ec278fe8531d6cbb5bf9f6fa1364e4ef305b417a8c4f90a5d27f1824923e251ae8ad29c67bf4337bce53a6097d0adf69948cb77077f7236d11fe56ea5deb6dd10ef1488ef486acf1847d479c6fdeefb899c1ba14f4aa17bd6805afb391de9fa50f8382514abeb26d461d8537e4dc5fac51867cb339616fa5eeccd30de05ec519a007a31e8087b5f87babb6a1ad6f93cec9b04b2208702b5169ca66febea6b9c715c04ba12b482863a3b8066d250c76ee8c6e33fa5f20c8c281dba31463c8b6ff64cd08cf7a0cdfc6af9fdc618c88faec3ca40879243873fd49306ba3fa3698ebbe433bc18e489d6efa538ed0ef0f34ae8e46580bd377c95cab51f20330f517be542f8ce0fcb755464ee8d8d13f6de519d4e45cabfa0e3ccfa74bb5e35167a7f20ad5336d128015501ef05aec13e0ee077a1aeb990f3276895a31632bb589cb7d01a9d6017a640373e27fb22be4f3a44b9800ecbbf35d180bda0c03d724f3844fe5d8a99589747d18e9547cb697a96fb80b291e2f400dd89395b0759f85e9c1159efd9add36763dccb2843eb23cf3063b509b035f990e37da0d341ad38fa9081fce26c40bcb7196f7dc75550e1c7c65bcf2e7b414fc4c9efd78aef335c25df4550e5beb71b156befc1f717f3b4953638759a2a9f5bb4a70265337cf074f821e2cce97dba04792a845d14ef15b8aea644759bf1a5a33b6ce24bd01155c677d63b07f26f74f0af117e1abaec2be3b48ef1a91badbfcf311579a7620edfa75bc5df8c00c64960ce05d41990c537a49fbe46d5698db2033cd02843f90be6f076f1acc03ab7aaa264eb99f13ab917ccc79c7e6c9c568f00af88733023417d05a0c68fc5998af0e7c53916f46b06fb01f58d41bd4fd17add4febd1fe6cc8b6a8b354ec73242fc4fbabbff12c5589c77a8b3feb17fec45f3a9f4d6c71f6085b538bb50bf563f435df036a14ef1888f797f3019f8933ab897e5c0b88ef20cd409e6ea0fb4c9bd7384b799bde752e252f3e14ba78cdd2aa258b172dbc74c1fc7973e7cc9e3573c6d4caf2f165a5e3468ee8172aee7b41519fde85bd0a7a74cfcfebd635b74be74ec18e1ddab7cbc96e1b6893e5cfcc484f4b4d494e4a4c888f8b8d89f645457a3d116e97d3a16baac219751a142899ec0fe74c0eab39810b2fec2ce281294898d22c6172d88fa49273f384fd936536ffb93943c839b345ce909933d49493f9fc4554d4b9937f50c01f3e3630e06f60134697237ce3c040853f7c528687cbf02619f6229c958502fe4149b307fac36cb27f50b8e4f2d93583260f4475b511ee01810133dc9d3b51ad3b02c10884c2898145b52cb12f93019e38a8772d27a7179d0aa704060e0a2707068a1e8495ec4153a687478d2e1f3430352baba273a7301b302d30354c81fee1a8a0cc42036433617d40d8219bf1cf11a3a11bfcb59d8ed46c68f0d1d4c941cff4c0f42913cbc3ca940ad1467410ed0e0c272e3b9174368aca630694af6b7e3755a9199434c72fa23535ebfce16da3cb9bdfcd12d78a0ad481b23cbb64724d099ade00260e1beb476b7c4d457998ad41937e3112312a737c33028344cae4b9feb02bd03f30bb66ee644c4d4a4d98c65c9555979212da6f1ca79441fe9a71e581ac70716aa062cac0b4da38aa1973d5eee4903ff9dc3b9d3bd5faa24dc6d6464659018fb7796046d33d1992d94568d89826ce32d1a3c0100844d83fcd8f9e940730a65ee232a317d54ceb856cf8a96028159e8e199913760d985ce3eb2dd245f9b096ed0bf86bbe214840e0e4e7e7a64cb152f46cdf372482424e9a440df7ed7038180c77ec2844c43100738a3ef695f11e9d3b5ddec00381453e3f08d847a3c0db2915bd73c1feac2c31c1373484682a22e1ead1e566dc4f5353eb28941bac08f3c9e2ce11fb4e7ca9b8536ddf692a3e390049ae97dff28c0f3b739a7ea37c09b18366f70eb3845fb93dc3bc3f6c6c60d8e809e5fe4135932dde0e1b774eccbcdfabe99e150ac70e285752b915e2a98abc0ba19cd8945944ca3d61351bbfba14eae90d0e27a452a6307f49d837f942f35ae1cecafa8d851a8caf442949ce16b3ba19ee1d3c37dee79cf839ddf3d428e8b09ac3878d9b5053e33ee71e44cd6c70884520f134ae3ccb3f204ca55899d9f86d308ef412a8480d87c0b2012203e4cf4cb2a2e7644cb5c215f811d2d9b95309145d4d4d49c05f5233b9664a83513d35e0f7056af6f327f813358b064db605a7c13870436ab864430578359bf5eedc2920eed4d44caf25251bcd84526b990c140cb8a1223c325811084f0d06b202e5333096dadee4c91a377900429cfad706d8fad1b521b67eec84f2fd301ffef5e3caeb38e30326f7afa86d8b7be5fbfd301532958b549128227e11a1610caca9e34e993f757f88a85ade5565828c4f6b6024d39c761aa3690ddc4cf3990de5c88642c4714735ef84ecdc2ad29c665ab599bbbd95db893b3e71e70036d1f087c44df3a7169171e5217741a877a84fa82f2fe6e08848aa43ca01e4edc368775f56cc526b51e71899dcc0aa6bfb8452f7cb9ac65839ab9153a45537a5a1e7225bb38ad09e39f0d2b323289d50bebb2fa17e79458efee247685a74a2f91a928a49c8f9f860b987d70c1b0b091437ddbd52ddcd6efb45c1300b842705aecc12a30b9705aeca426220ec87b646a65a1a9c565153e3c72700ae4c2b2b37afe216eb94869a2ac2d553edbca9699089b3510f8a4ab9da9d267448536b57dbad2d416b22506337179ef6b3ada1f76176b1b8ca5fd9fdda9e1430db8795361bad99583301f298154e170d5bfd403432ad42d6809e6c913d61d2384d834f3053ac25bf5072509381a1b57c4450522669cdd0c0a0e9c82100a3db039395e59f5e217205c4a21182ff8b9958b34cc290c8ca6b7c7dec18b362e6f2ad09cf3a373abb295a22001f25bb8ba9263016b964b3c27353c3f32b824d59a68831d7606df7160bbcb72c3c586032cccee070f5b429e822eccd906901240c4582bf7caac94161a86b84e7346d0a8a092e5b2d852f0d9e53257402838a42456238e1ea51fec915fec9d0216c34989dea0f6ba0fe99709f025384de18658e6714943fc8949ab1284b62da52c30ee8b39953660484720d0b7937b92ffaa8a27734b63c4ca9353501c810ba985d82cca83e27ace70c1104bf8b82812933846737533876334c9703dd95dc11b5a50e0a6455200bcf96bc04e3b0d0a68acbb41ae137564e0e8213d1353135fec21a2cf84ae82a35675ad964e835bfcf5fe297533d2515313061888855a02233a32b5b644479f99b135e10acad74649f4d91bf0b836666a7ac553a11e151761687fc45607130cc137be1a6183c1b3341da054c94609e963d04ec0d41aa524569aca27196d930cb0f114553ed09338b21a5c2360090f7da6cb67e54734d38311c336cccc5a9606ce7da716bfa45289dc487b7a174ca54824a472a02ed58a7a7673628ed77e72465be7048e940c701ae74a80ba667ee57da29e9757d32430d4a60774c7c5e54bfce8a1f2a38575efdb82e041e070e032a4d523290eec37505500d3c0e1c065e00b0cfc555dcf5030b817b80e3e28e92aea4d5f9337dfdda29c9289b8c21442989f42560000afa9988561369243009b809b807d0653e91b21058011c06be9277424a62dd2df9e87b62dd0d92ec9e3b3f4f46a798d1899532ba7b7c8549878f36e9c02166b6de66b66eddcde42efd4ddaae934963b2f3aa05757bf38ef44b501230c804747c11ae8c3f45518c51266d53e2290c7045b752424acceeb63979f71c5654620a57184da74ce388c2eabcd179fddcdce05f520c65f22ff849f30e3fb93b323aef9e7e43f97bf438701850f87bf8bccbdfa515fcb8e039aec5c03dc061e079e04b40e7c7f179079fb7f9db14c5dfa25ca0189804dc031c06be041cfc2d5c7dfc4de1e4c9ab0817039cbf89ab8fbf8161bd816b147f1da1d7f9ebe8da4b75058579fb6520986b0532b3ad4062aa158849c86be02fd67dd7011295839986441d54da505fca57dad4657783f825d515cdc96ce0efeff60733b7f5ebca5fa630c0d19397d1f2cbe4074601938145808ed0ab08bd4ad5c026601b10062065b8fa003f3f0afc157895ba02216014e0e42fd4a19906fe7c5d4effcc7e09fc39fe0c2582e3c7f89f25fd2b7f5ad2bff03f49fa2c6806e851fe745d4626f58bc07d42199f383504cdc57d8dff7177db984ca35f343f0cde65e29a0b1403238149c04d80ce0ff33675d3336350c9413a8afd7826afa34f247d88ee7352686e6628670004d02f2e39bd2f4008977bfcf7e4f050cee6db1115979c8db720242e39ab3720242e39cb5622242e39f32f47485c72a6cf45485c72264c42485c72468e430897067ef7beb6ed320b46ce63fe7e51fc0a70e90a70e90a70e90a52f915e243dfa9a26f77d475ec088e6d0d053b74ccac866f7388558f61d5f7b1ea19acfa5a56bd925517b1ea4b58759055a7b1ea0c561d62d507592fb0a29a85eacf8916869258f55156bd8b5557b1ea1c569dcdaadbb26a3f2b0835f0acba21f9920c9264773fb1e8402fe80bed13c5b3c0d12cc87c1674c2615c9f070c190b2193bf8d99393943d036bb3b169bf12ebdf31662f93c89824f621a9ea477001513f424c4e84954f2242a88c2b51898041c01be040c4047ee36e8f84df21a856b2e500c4c0256005f02baecce9700a78556171f971d139dceb53a3e1250f993f8b4c1278b6785d27d69bea0ef42e5a6341695c146661819bc801212b0cf8a8976463730efde7f7bbffdb7975cfd5c7c23bf49a86ebec9a237d57d07d5cdb6d4e51cccec17cf7e4f192a248f15520ecb06ed455532de83d29c8276a734fe08685e5d5a198a45d5e574ca3cc02245a9bd99dfa59dc8fc24ad8123f871dac1ccbffb1b545697f90a521ed99bf972daf599cfe63638917228a781811cf0cbacfbd37a65ee3a2ab3aec48dad7599d70ab237f39ab4c199f3d2e48d19e68d4baa100b45658ec999907921ea1b9836353354853af76616a75d925964e6ea21caeccdec8a2e04cd604774b6439a6c34908194facc1ea5a5050d6c76a89363b3a3dc31d2d1d391e7e8e4c872643ad21da98e38678cd3e78c747a9c6ea7d3a93b5527779233aec1381e0a8a3fa21ca7cbbfa52cde8a62a4cab08f8bab7cc513eb9a39390da570ac328c0f1bdb9f0d0b1f9946c3a6fac3a7c7061a981b1b3f2dd09fc1b2d2b071fdc3bd82c31a1cc69870417058d831eae2f25ac636562035ccd763eb32aebc811922694daa3862d94f8c45afb93155d0f66b6eaca8a0a484cb8b938a63fa4617960cfc99cb64eb1a3cfb93744e38bd7f78f3b0b1e5753d76ee4cef5f11ce9361c3407858f8567114b39f7dcdbe1a34703ffba72015e5fb95beeceb416344bad2776045c5b0065626f3919ffd13f9203aff94f99cb0d2221ff99d1966bead66be6c9447beb682209fcb45d9325fb6cb25f3a94ce4abad6a3b68606ddbb6324fa29faa649eaa447ff33c47b391273b5be649a8a6a332cfd1846a9127dc5766494b43968c349985a5509acc92c6526496b2b35972ad2cd73765b95eb6a4b0b379d2cc3cdee3761eef71e409fed69f19fd8341b6bb4fc5b489e2186b7260d00c6072f886cb6727098fdc5f3badc23adfca993c75da6c41e1935604660c0c4f0b0cf4d7f699f833b7278adb7d02036b69e2a071e5b513433306d6f509f519149832b062f7e051dd0bce69ebfaa6b6ba8ffa99ca4689caba8bb60617fccced02717bb068ab40b45520da1a1c1a2cdb2229eaa3ca6b9dd4bf62c04493eee6116e88ed64f8f1fd137c8bfa4a19ee9395746dea01b82edb29225811f604fa87bd80b8d5b95fe77ee2169696b81529ce2aad5b49d7f6c94a3dc0b65bb77c488e0ef4a7e0d2cbaa2ea3a44173069abf55f841d2d2cb04c3cd6bb0ea977e706f5038346560d552a261e18e6387858bb1f9ad7538903a590c29dcdb4e8b8818d4601c3113bb20b1b7485494a68c22ad48a4b95c56c69fceff65161d205641353fb89b8532d852aaaa50c219c3c671688471d6a1d0013856c25654556080552cc8aaec3aac6e078364c6498cd9c6d2cbac90c58ba516354ba24895cd92a61fc1ac6013c796ca6a253b8313cbfb452a3d955cea07dfb92b6867d0cea079a0794a6e28262753e105992e674166847b60a6431f9869d75a1124ed00250329dac394ace688f7400df1fcfb63411be7181f8bfb82f24fa1351b2c106da75d6c0eeda2c3f404fb0aa51ea7fd544fc2ab1a4877d272fa1dad83a59c8094eb690c3e1ad27fc7928d7acaa57b612befa563c83b9eaea50394c0928c4f6805ad515e42a935e4a53618cc285a4837b28b8ccb6822bda3aea202ba882ea545acda2837361ab7180fd083b45ff9b37186222885a6e173ccf842fb87f1261830916ea3dbe91d768b6b0f85d04a3572de454b68ab52a9326396f13d7a904557a00f2a0da763ec080fa2f619f4114b62cb9501a8e57e236c3c855c695449b3692b1d603dd8609ea54d34861bc728016d5c895a6fa73ada8b4f03fd815e671eed2be301e32b4aa64e3404e3a9a7e7d811a5f1cccac662f1e50170a90315e2ce42fa1f7a865e6001f647be50f368795a485b66bc4c71d48d4ad1db8751f243f66f7e2d3e2b94a7d512a33f45822f370b6ed39fe85d96c272d94856c63bf085fc6e650939d162377ca6d31cf07b0b6a7f1bc2b8977bf8f3cafdea23ea0f7a7ae371231233924377d05df447e6c548fdac8a5dc75e65eff3017c12bf83bfa7fc4edda1bee89882515f420be8467a84fecd62582f369a5dcc66b3e56c1dbb99ddce8eb117d8c7bc1f1fc7e7f12f95d9ca62e50f6a7f7cc6aa55ea2a6dad7683fe716379e3538d7f6bfcb79167aca5d1908795e8fd6d743746b69f9ea7d7f07987de631a8b6091f8f859162b6557e3732dbb91ddc7b6b31dac1eadbcc0de639fc0b07dc37ee030db5ce7a9f0a5844715e04be0b4fe8edfc99fc7e705fe39ff4e4954da60b3db4329522a9485e8d53a65133e7b9477d514f579d5009ff3b4cdda3dda76ed11ed09ed2bdde3b80e0ec35f7fbcff4cc7336f3752e3fac6cd8d758df5c6bb148f39840dc21eae08bd9f82cf5cccf76648dce3f412f3807729ac23ebcb2e026726b1b96c31bb129c5ccdb6b20765df1f6387c0a5bfb32fd1672f4f937deec27bf0fe7c243e97f0197c317cbb5b783d7f957faf389408254a89573a2a83954a6586b254b94ad9ac8495bf2a6f29ef29a7951ff13154b79aa9b65173d4a03a589da45ea6dead7ea47ea44dd4fea27da0bbf505fa5abd41ff275ca4be8e518ed18e4ac74d8ebd8e979d93219d4fd21edad7fcbb31ecb8b25219a4eca18d3c5f4dc6aee839c8f3249aae0ce79054be9dade7d7b07ade56bb52efc3fbb011f4959a035e3fcdefe1a7791f65381bc6c6d25cf15f00c48f1ea7ee0429529fa493ea218ced39d47ca5ee61d7f22f750fd531f37b347f52baaa41e52ff4baf20e73a8f7d21baa9b25b293fc616514a4e00f6a5fad9cb2943be9316531bb86f6f04144ee1f9c1b20c723d84ee885712c8f7dab18d8108f80141528efd32a9ac7ff4127b18ed7d3efd97475166da47cb69c3ea287b02a3a6897ea1df578f62c9fa3d6f058564f5cdd219e87b3b64cd1e26835ab54b6ea5ff2d7e8327a5e75d3dbcaa3e8fdf3fc3165b8fa953686cdc60ab886d6d26263255da595ab2fb259a4b032ca568f43bb2d57f2d42cd015d02a13a1d3f662751f801ee8a70c474a1224e722c8452934c4567cb6404fa890a03958e3e3a1c59ea37a7d1c6fa0595a2483d62152ffd2388626180fd1edc62cbad4b8853a431fac3396a3c6edf401dd44dbd99ac6ab691176a7af616d5fa495f0e7b512a333afe1aff1b17cf3b9f30b6e67b324fa149fc710e9ab1da41af5ef34968a8d0dc62b90eef6d0b0b7d35478bf2730ca2fd0c285ca11ca6f1cc16b8d126511c6fb0e8d361e3632999b661bf369241da2071d1a4d710431c761f622c67b35cde0638ca5ca8cc639e0c34de082f89f249741ff5caf2e5657a9dfd106acf9cdd037dbb06e7662e588b56fffccff29589e0935c1843ec1c2e7448e07889c4f9b708d032071ae6f2121571279de248a447edf36a258d8aff84b8912ff41947221516a2451c66ca22c84b30e9c1f815144d9dc422351fb36441d369f45a73626726105bb7d48948f7ef5c831d12b8ea80face40539268aef26ea8f3e963c4434a4ffaf63b89b68e432a231dd89c621fff8f644e5cf115d8cf155ae269a546f62ea8f44d3d18fd918e3dc3bc1b6af8916b637b1083cbc2c85e8f29789ae7cddc40af469e57aa2d59083b52fb7a215adf86fb1feed56b4a215ad68452b5ad18a56b4a215ad68452b5ad18a56b4a215ad68452b5ad18a56b4a215ad68452b5ad18a56b4a215ad68452b5ad18a56b4a215ad68452b5ad18a56b4a215ad68452b5ad18a56b4a215ad68452b5ad18a56fc06883ff24e1a3ea49083fad77376427734f0db43b1a4a92714723bd4138c929dba76822b87783772b1db59174a0afa4e179d291ae13b5534fc4c111523ecfb11976e5db3a2b3a2b37161a4d28f7ee5c88f218d7e20bf7a44fcb3f04b94ddfc0aed009a8ba05bc36b82e5fb898c6f77b7c9eeae3518df86dae474e81ea1bb1d1aa98c344d8ff8c2e5742a0a2787b3c81de5aa76715783712414ef8deaee7a9b296a1167216f747796ec59fc7052109d098adef8ce042b8b64a77cf89c29c28545c714160a74ebca82c1d49087a90e37693a778a3f6f99545cec7b2ab1b06bb78a58a5477ebc922faf9bf28e757eabdbb1aeca6e96f8d5578d9f9857c1a72146673556ef471da91bf5e279621ca1ece5194ceddaa967cfdc92acd2ac51b9953de72ad3729729576455e55edd735d5675eec69ebe6e0dc6dbfb220a33fcfeb6dd3b89bfbcd9c91fe83ed7d9ab6382a7c09fd0b16b5604c57b0ac0438a2fc8eadaf5a8a720cee329e8eac92a5013f3f406fec0de511ad34eb2b403fc014ae5bb762766be146c603d42eeb8f884eac4c4388d3a36b0823ae6ce436a7d87979837ed00eb85ac5bea7a54e508deb9630abbe68472aa73949c063e2614d53121313133d3efefd52b2faf430794be359440f17171c160b76e11116e77570a5135bd80c96ce09e904beb52b5d0b7c2c77d07d846d259af5054b136525ba1dda4a95a72e13337c859a81c7ef2d4e293a07202accf99e69122dc0c9e3c75928a4f21fd5451b1b8f8ce9c90bf9527a263120bd7457609ae8bbce6a928fc74eb9a34e0aad0d0ac024f6cdbec40769b6c458fc9898cf24671bd20abc74896df1e974eb15d4652570f2e3db37b8d6459fe825edddbe58da4fcbcced141dc0ec6c6e5467543966e9e08127d085a179332f117fe3a063bae5cc9c49f21ac649510137faf6ea188081624ea90d7a0e4ee9bdfc1abe93a73231c72cd67def8d4b4b4c44cc4f6cc4f4c8c8f0b2254371fb390541ccccfcf0de6e5e6e7168b2ba2b910bfdc9463f9791033ad4717deae20213121313aa75d4e4e8fee053d0b207222c19193d32e3a213183c7c7e98e7845d7e3e31212637bf6ecd13da71d6b5cb7e36af79ef81e17cd5db8b4ac72fdc5bbe7de35f1f2a403be19e5eb3b8d9b5bf8c51fe6ceb96ad6d573e75c3fe5e697eaa3c73fb1a1cdcd032747f00be2fb75dd39ffc815a362cacaa2864f7d246deee29833dfb589cd9e7b4be9c1ef5d7bf5f6bef5951397679f49f0de5935f58a5c21e3e5c6db5a3bed25caa44ed4936d9632fee765f14b1296242eebb22c776dc243b96f917373fafd09fcfadc553df9aab4d559bc3e814d4e9c92c513e243097349d999f17a02af4aab4ae797a52c49e597d1d509bc2671552adf11ff58025f9551e3e735ee5569fc2ffea7dbf163094fa4f203294fc7f1393d0f24f0398933f2f98c5c56963fb1272fc99f90c98727f44fe55d530a33794e6a5b3fa7ce9d333a7771bb293521213dde9f90e0f71f70778e73bb3be774f0b1ee1d327a2b11a96bd303974c8e5d14bb2d56c98d0dc5f2d837d36f4a62490d7c42282db96fc6127f3a4befd5abc325dbbcccbbaddb257e0773cc2d58bc4568b7ca93a72a850c9f3875b21204e113547ce264f149219891d7f89e724416ad8b14c4572403502d953ffd218ba68632187adc252135353e392929ddd7253ebebbcfef762b39e9a10c97d2bd41e9563f5f71f972a40cf99890217c528e416ea2f3ed4b6e7eb41d831c65eb7aa04d3bc84fcf0221453df3f312e2e334d6b3205177085162526e026da410312685293fafa772ace2c565efae9ef7f863d3fa3f7fd7e6c38d9f3147e7e4835dc7cca8be6a4163c66583260d1e32251060c31bf7de3273e375a377ed9a366dcbf2dbd7bf3176c9c6feab9f6c58f9b7df35d6962f6d7f64f9da8b6f2a51d60c9a5d3c6cd22503db0ceb78a607bb7dfc6d432a8ecc107f337879e3683e1932e4a311527edceda218f9621c4e9faf81e5efa67b229da0a168c73d919790e253fc8aa23c1a7dd706c9fe33a74ffa4e4341403708cea6eea62887604a31c6cd7278b45833f9ba039f781f63efdcf6dcf00987565ed5ee82005672e3e843ec5b16f9c5eb677e78a1a266f3c13f346636facfedd1e5b2479ef6bcbd8fbbdc60778c4bf4c97d8fc240ebe91ee592c806e3ab7a9f8f9722f06d7d54940c9ca8f77a65e0f35094dbcd4ba322332379e4a33156af8512f949cf5994cbee796c80a2bbb7c3a26f978fd51eefe36784ba697341bb652b0f4d18fe7ce368769cbd7b68ffe69a092ffe70e6f52f1abf6e748a7e879469fc15f43b899e95fd1e1ac122dca92cd5adba5d9ec8285fb4438f603c49fcdf3007a98a3331c6eb70e89af84f62f21f89793d1171aa437132b7ae4510f9fc712ceeb00e2bfca0dec06e0b79b50729141ddb9d9293176d300de9f053674e08b35e5954985b04758c5f166d5241ba752588745a8cd3eb8dd214e83e0d36c3478cb9a37c9a2f22e4d6c488a1eff27cc7f2a2f3738f01f9672559086f2c1420d8a03b9ac4b59dee6807490e75b9e7c25876b312376b4d9715cb2e587865ef91437b5dbe346fa5ba6b63af0e7b064ebbad7ba78d1d237bac2f1db9fec6a1a537754906877636becd56d13172d374c1a13d6eb8338f6070a342394c29e29cb95911b9b98208e9bd1cbd47d2245a482b681b7c916d11f78a257faaf2d409df49d8022a1657df49df9993c271e8d635758f4367e27fe324613de61e43e7f3a1aee344777b16ec3d366a7c5e2116d5b1c537e40c4f9e72317ad38f35f0b97c01f4e80572be9217f1450a1fce86a32301e229da22644a5617dd28987da2d2f721e50e3f099e2e86b8d45108bc03eb048f7a64c5f7e31d58c39e3d287000a2b00e6354a840d69ac4c5908acc813c4eea36e4d9a6de6baaaf4a4820aa84f4d91db7ba7de0d8b163f22f7a1b1ff142c89462726c3f29c6db7571851c3e4ac81f57f87b8571e51ee571852b97138b4309b88af007958f897f8c35b2630f91ba7b5992b09ea74efa4c795fa77509565e63ea42f859bbe12dda921fcff219dbb1a9b13c59fbfcfb38b85da5c6476ab476046b319d358a1ed472f31f0ca564a85a5c86d79b0867ef63b9ee4420942c169e2b9a3c2285123c1e5c3d228d72b1e88ee1720c239663aed57f5ad329d4a48b9a3ec40a96812f42c91111baa8d22752c8e7f188ab486baaf26c9da111aabe8eaf8f581ff56ca4e6724424f141b117c50f4d1e903a2e7662fcc4e431a9f31cf322a6c5ce8f9f973c39f52a7e857e79c4b2a875fa16c766dfb349aff357f55723de884a69ea523f9f718a3ce4c1f49451a2f1353ce2082bfcadf85f822c148a2e4bac7285b202ddbb427fb87cf07efbb951c8cee8323e3633ee2b736dca8cf6783c0d2c545f161d19116106b03811d85d165d45c2f5f3a0263f897f83626725a79595ccac7bcb68538670e27ca731747868b88a60e56219b458c12a175365980f08874695d7ebfe645f1a14651df747fc8f719c128018200ae8257e18505151915aeb8d8365ab9feff5aa29d2c4a99a69e28498fb6284ed4a88814294162dd627ec54b40fb6cba197ce7b69dbe5754bfbcf7de9de97afba79ff8ee5cb77ecb876f9d04afe1253d9058f4edadd68bcded8d8f8e4ae2dfbd85d8dbffff22b369bcdfd62ce5ac8f83bd874fc001973b3482161bbdd4d23b7036e9b5b6407dc262f9a9812ca2a53c42e639eba82dfc46f77aa8faacc45bac61597c63c9c1d754beebac53c1113ff00069ebdb41b087c1a8a96e29a26c535528a2bb8154a16c2684b9c94be148f16c2be461375458aba34e6d7421ad792230eb022b6864c55b1d89c11f98388b9fb2a16ca59ec6de06e988eacdce470e6d2439ae6621e97e075b17440a1d0c0f1ac40b4ae3b7a407de5f31feafbbd34eef7efe52e55afeebb3cf3b1c14727610c4558dd0e702e83b7936bd35c51ae689f372936562ff58a05151d2d035f845c3e1f4219715a8658a88922434686b89b9116893b191e31c28c067e107d722726fa337dd19cfb33853ff3b2e850ee31ca1502162c16d7a7f2c412e64d0d7a6262b86c30e48a8ae6763bc7431131b1bc34234ea489baeb50b550181111bc3451d867c9ed9f6b4dac6ad19e684d36161adc47eba31fd40eeb071dcf389f4d730cf15478c645cef34c8f5c16b32cf6fa9843311fa47c90fa558ae770c4be589ee1f63975fd685a4a5c5a5a8a332d059ad29992a678337cd8a2ed1e19cda21b58d21ed14f121ddbcdb8c77dce7277375beeeea6e5ee2d735725be04452b963c3bc857929f7cd86279a2f714f3497c215fc1557e80b7a54c7653ad5ca49550bca78342ffcad589bd6ef1496bfbc4ec3d9470554d2b662dd9902bd597e64bf765f8f4ff31be220716aa13d405d8ebb5570561ffb304ab564cad37d5e1f0f28c0625bf7e3ef7c4799b6d728a83c21d054b85331a9f95530081b27d4e611ca5430a41c3afeaf8b1802766dfbff5cbedb75f7ddd9d6c7fecb77f7be9f4850f3f71dfc48c5dbbfa154d3b72ed531fcc9c77eb9d35b1cfbff6e9aef29d871e583fa51b24b1ccf8504d802406d9e966562222392924e637298d985832410f22ac43c0ed8df24465b8dd1de233d2d48c0e695a076fc0eb494a8683e7f78945e877e4082911d97372858e8741c787620a8b8b61f24f6230279ff63d1d53e87b2a982720e4a3abe64df00ef2aef5aa83a2c7475f9eaa8c4998ef9b1b373de132ef55716bbd3571d7a73ee8754778bc91aa83a13d260441fc53be834cfc19732f36e31e4fbc9a24f6edc97c76c885de69e89e37e61cb98869261731cdcc404cd524ff423ff7278975e4af769c53c8d1ac90a3592147558eb41d398c727c391ca33eb54f94cfd9d439a981f5aa4b7e8989b30102f3229a2cc3a64e0dec164bb8c4061de26529ff53c1ca261b70e684584627cdadba296a4de255a7f915ac4e88518550476cb1102238866ac0e38d72cbad7254545a07d5da4e632f94162f252a4d4a94dc2c47638de6e71582588ea2b00652aa1c054d415bc0848439c495026d72caea336f9bb7e2f1fbaec9bf282e26a2aa61eddc391be2eab33e7deccaa3f3664ebf6e53e3c7affed160ab926e5f17be6ef9bd7177f32baf9976ddead5fe3dcfccaa9b3ee9ce2e197fd878a4f19b0fc559550a34a04f3b008fd2cbd384e41d228ff1bdc9f6fa32af6e1910cdb624ba1d7035d9163ba0d9b645b703ae266b63071c4e2bb3d30e386cebec7436e5b14c93d30e687640b7032e3b60d9b15041594cb967b667ab6787e7598f76917291f777aa120395451e5d7168ee08c5016be8f51e55d4384551152f718f179b8583fc201c47ceb685dca4aac84247dd6a039fb94fd3dca1f4ccee6edbccb94d9f4a06be90ce95bb811584bc8e509b40774775560fc7a6282ed6688437ae3b711ff773858bc2a20c0227f68a327c4f6403db2045ef73e17b082b774ad88422df873e69e47ca78a4e17451716cac3bc755d822a349b3c1c62f25f4f78e1bec614c24ebc1c8ac82f54da742e54d4f4f422f98f1b2088c8138af384220a3dd5a30a3da19c424f9b34d0ce85e6bf76603ff39f4d2898bad7a3ba74c5cb1b94bc7dc275218f6a9bd2607e7e9e694ba3b37ab0fce8fcf840b412cdf8e633abf95db73efd747d630f36e94165ef8f431f6cbc179afbb633f3a01084d79ba53d04bbea901e49ac2d23317620d663cd768c1d88f558531a83c07eb1d04d25b89f18b8ea156c646991ee8cf8f8b418616423a2543523cd1bc9c891041744bad0322015a6307f42e189858c619c790a4a4ee8b8ee31d24c47c9ebb094abd26bd237c73e1cfba4e755cf1ba94e576c5264c71425d61d1f131b7b34322a2e32362e32ca0b3d178a154d8722b7611f1c19158a675637f645a9ec25a103610c43d1a243d1937ce2f0f0269feafbcd3a2c49eab024ec227c493cc9d661499bfc3187580f8a62b72167afbac83d3fa7cb32cfd565e768b34ab1cb83fe923ca884a6a984f23fb1ced925a841aca8b9c1ac7775d5ba461c809d54a45e139a6d71a5f87720b6a34594e68d8d84bfa1c69b1a2e3e3e2a4d95ee6e9a372a0696b36e7e946a1bcc5c817cf338a7857a834e8bcd8acf52a0d7283ece015f38a7f40ff1b7cfbfae7ed786f11bdaefd8c85f3bb36fe4ea9b8f30e7d21b4ffdf90cabf6d5dcf0d47d5beb461627f07f3eda78f9c4c6d37f7be6e6bae318fe70485a3cec663a75649f34b39c99512c934d620a4b6d9f11f232af17ee54aad62623ceebce6094ed138e96dc6bf932127d427412a5dd4c947bad446b6374ece563be3fd9225479d2f754a510a1cef392d94047287e60f240ff849871fe79ca74c774e7dc98e9fea5cecbd2d638d7a6bdea7c3921dae11773d8ce54017a69403873a92294256f886e8df272742c95bd247cd1066131ed4e3261bb684ff639f293dd4c7eb29bc94f76954fca8f8f910faa0a63fb6a9ff0b97d9b3a4147f5da9d612fba0c5b0d67406b1e94f564b0c290b7387152e2c2c415896aa2cfca006e48b51a59969820aa4a4c107d4e6ce06d77079bb64ea6ad6c2e6f274dc3290d2618d6245cfb850356dfce1ff06735d8d2252a10b6b322750f639adbdb5eca94d79b1ad746ca549c3755932633553b2b5379a63431474e3bb96bd21dc23ac608f72bd086a27d05c256b2b866b2a6fcb03ba9d3907965fd4aa7f27e8766d59fb9e285d5ef369eb8ebfa8f77bd75a660e4c6114b1eb8efea653bd5b19173bb0eefdaf78b37a74d6efcf78b3527af65c3d872b6e38fdb9ff8f1adca9d150d776f79fc71ccd214f17f08b487c1fb1be4e944e4535ea6e2973b55178c8a504c5d39535d1e6f95a270312d23a557abf094286795eb331a09a99cc4956290856c05f676c991d60216cf1416170d3f757284efb4d8f388d306e1edc243305d5bacc7d47a974781ac88b5c6e45acb2fb64e5074527447a0674c4cc11465cf86c693c37a46ed57aefbd7f5eaf7bb36dcd618d3f843c31bbbd8a7ec993b49a1b15835c958358914a0aefce9b3eba6de43a9195d8419c3fe869776e9129395a16bed3362bc19c2e0cb438a537be51945304a9c1c8aa513656f484440de8c4a52ec6345c5cea5342d39a56dbc47648f9735c6cb25177ff62ce2dc830e61834e8a475ad679c73ed911ddee886e76e4843cf788b2cdacd5be4843e0c7501b91289a1525e3a5ee8f97233d3b3ebb31b4c572ad0ed810ab7e788f04d6216148c2909c0f3d9f74d55c5dd935740d5bae2e752e8e58e2b9ccbb2cf106aa611bd4b5ce9511ab3d6bbd3726fe35fae9d8180f652491072d6debc29a31f39c759dd16c5d67d8eb7a6f5946d5611773f58be1b328d82c77b059ee60332d10ac8a0af9a105a21845f9a2785403bbb93e2fc95efa49f6d24fb20f4192aac20a531af8acdd6ded4c6ded4c6ded4395b655f1f656dd1f1f8ae7f19bba3d63db1a6960e4e1c9a9267bd3e43cc714564a569a8f239bd4401be3785d9a3f054aa0ceefcf15a4b31f3efbf1da0e7ea9154cbb53b964312dc6be6c3738d745aa85d4543da6bd540b315e3d4baa05bd995a282c94e7e54d4f079a5c65424a6c5c336dd05c35b0b98be67f78f8c8a7f316acbbb1f1f46baf359ebe79eada79b3d75c3f73d6fade43368d5db97dd7752b1e56523b6c99bbedf577b6cdfc7d874e4fad3f64c0cd3f72d31fd9b8d9ab574d9ab66ef58fc6f04d231faabe6ee776b2cefbc4cacaa08e7cc2d933857d1199b0eed9d1b0eda7a5580a232fed42923828692fe432295a0a66b43c2f894e8aee148c689f214ede47462a919171348a31b909f4faa2f552265c8d3662f32db8fd54b0324f6adc3cc970c8ac58443e61bfdefa53d33943b34e9c7597421da5bf142dd7e22fb47a6e5b2d9aca6dde506870ef948b1242818b13c607662af31316a4cc0a2c4bb9266343ca0d195b1376a41c4af934e143ff697fec05097727ec4a507a7798aef3f61923232709bf2a4d34c25e1a655ac37ad16c66bf76cd643fb399ec67dab22fc2ac90229ae58b304e37e58b68962f82f50a459feb6c6dea246ced1ed85a7b1564dbab20db5e05d955d14dab203a14cda33705cf59053081d60ab0e4bfc9e53a6b020f523bf85601e3f8ee2cbfeeb7cf1f16b3ca0a6900d58848d30082e74d4e95b484cd4f219a0ca0e94ef5e53dbab713960f9420f831d1f2643187d98fc320ea8b76252c9f32f69a513d59cf830bf6fec81c4fdf74f2ea65ffbcefd1d7f95f1e5c7a65dd8ee5d7dccbc6fa965d7ad18a7f2cf22495cd63ce7fbcc37c5b1bdf6ffcbaf1a3c6dd8f1d56badfb1f7a93b37c0fc41bef713b1b56a8e7c8fc27cdee5c75e4177b8b85ea42a454c57ddbc086e3771714678afd37ae6b058d8b2933ef9a4a150aa84d43d9aeab41f02149b8f01f2e3c53b09fb8f1d3ba6541c3bf6e3c3c78ea18e99c647dae5da4b94ce72e5338f697c6e3a67a6c9d1c539e3c7a14922e4a73cef345a444bd3ab6975fa26daaa3da23ce8ddafd47b9ff1be4027d2ff951e1d19931e9d9eae74d4db47774cf3670ef696c58d8f2f4b9eadcd4bbf3ae68698adcaed915bd3b6b307f8f6e8572263298e527c71be14553c2ca86b5f28179fbf7da12f8a989a1a9be151523354972f276a28e5f8b14a523213b9254289b60825ba4d3fca5d9698e377326c7a65d45be6f4883e3b9333a64d341f45052b870be181ed172f16988e5474a2f92a47a5388b86b7b42435e4667040a27c3e8f9a8add5afd7c781ab108d4cdf728a690984f4fe591024bd4d5409bb6108e98b6f979aa78ea0eb1e0f171314230d4fa272e687cf283938d7fbfe37136e0893759a73e87f39fb875c7fb13177cb8f6fef738eff6e50f7f6497bef8012bad3dfe97cedb6eb9aff1cb9b0f367e527348c8c1dd44da04ed0045615e4c3988f167b201ceb4f40cce78b42f238a9ce2f4bff1174eff4f235dd8ad4cc11817cb94c75c2ebff0185c6ef9342449a608a7c1b4f72999e93e9bad3eb7b557f4998b167eaacf2f4fa5fdd691f469a9e064c03a8efebe5e9e4e3718ffae9707d2e2551cb73c94aecce83331a9e9c0b9b2e88cdc8f9bd1cab3878ef2c59f0157857a2aa90ea7eed49caa53d593935292b81ee1f6b8bd6e458f4f884b884d50f45425318bc544e292e44ccb6209eee82c0a8a33eb8ef859c92a536bc9274f1ac9c9d24d678e373d27c88fceca4b4c484c8057cb2379203b2bcf3a6e84cb9b7537fbee9109d7562cad1ab1ece6636b1a6b59e1cd0f761b34fcf7f347ec6afcab76203efda2a98dcf3ff57063e38e2979bb7a761bf4c9431ffebb6386781206f3a4aec18cb9e825395f6d742dc3e9bcc9c11c0e5254316be474dce9e7fe08ce532254972dcb4d87382eb7bd27709d97d7a108f3c995b5441b6d967f65b3dcddc7967b8be9c325d7a5f89f30fd5ea13fc51b35c27e694e7069df7c4d63e098da9c63c23f3499169f25b15d79ebc70f78f8cc28edc0aec6debbcecc444f174087ec870ec9660fcbb1a7a4c6a5c6f3c9edd825ce5816a3b46d4b5931893c9b32b85ce4f1a2b78ce98919910a5c36176339edb2db9e23cd6d9b4973db2669f696b5f52b0a78d86eb23cfd39213983c0d7f631d0eb520ab910eb48d10a5f52dd8eb54bb7999d6e333bbd4971a4e7f8ddccdda438dcd23d7027e74cbbf81cc5f1ff54f625805155e7fef79cbbefcbec4b92c96466b24c20210984c1682eca22229bc84890285651595402881b6a7c55c1a595da57976e60f559b5ed63498014ace6519ecfba3c78adc56aabd216156d69793eca532093ff39e7de3bb951fbfff71f987bbf3b733333b9e7fb7edffedd5946f749f74a1ae4526217ac6c41a3cb8953d2248c59c0be04e2e3294c4d22194fc69234a7e48c6c28579513b24cae261b552baaa9b01ea846270703291e1da5d96c3548ca88a18326da548ad5d55486461b722b53c4d8a4bac8fbc12c4e752776d3762653ad117765e74a00346cb9b5ec5ec9895620a045086c69f4a878a8533e84b16b7cd61c855ee1083f1622f8c2a510418b4100d66ed217c2eb1e2a1ddcf29bd2e6fe3e30f7b79b017838b7b5fa2bbb6eb867df4dd5133700f88d3b8e9f033b7f0c860eaf5ef35370d96f0e8135fdd70cfc73f3aade59f3ee9eb371f3fed2a7bd57b40313f1c85308d1d2483e6430cdc914ab8813c281501b43578ad216e9a0042516425940923f8a15041f2b081e2bec2c0a299ee770ac10b300223eb165cc031c893370381a10c2d2c101bc9e5c77af0a54287b7c207b7c203b7cb0bb28a7dcacdba02da12ff50f089fe00a9f0fefc28ef0292915a4d4b9ea127595ca9cd51545fe7b39dd56c63f879df21d0e3791c437b2e90908827c623b2da155b5d595344d0141a004161281443f6659249150a2470dda3eb50f9edab76f8863f70c3d0d179d9a06fb8666a1bfe61174cd2fc2d71c5e4ce4b2924eb717047152ad349e9b204d972ea1efa5dfa4f975d25bf45b085eb1d410b550c73ec8dccf3ec77c2cb01203c63387185c3379d816adea363a85374865f729050b3fdb878e0577cfe07d05d90ff65961fcfcbbf67931f499d9ecd982188b9dcd3444a3e72e406c264aa220b134c3a45829c8b2e808ad2817448b2a49140b19007919fddd120d654031037092ad37b3600bbb8d1d640fb30c7b81809f939b7990e27bf96d3ccd0fc07bfbfeee0a23d19653ffa0063be5ade8271e9c2a673d83edacfc88ce1a423617b6bbb06076e0e5ebe8c00fb436b87c01e7cbd03e4ac2cbbc6074081d60e6b6e8fc99db12f3163916eb222402ccf06f2676391e0c3e38dea798f8d21eb72388e00ccd6c130ccd6813312519aad14679f71026760bf9c12169534ca36bdc182b30f8914e145874dd778511192e70780964ab20a48305c60e16f092eccc223254f045a9bbf03b839ed5dd790a472513e82d398ea1d15210ee6346715fab5b398639105403f49f371fd9077f03f8a1c7e13f0d5343278f2346ac876f0efdeb99c7e0071f971874dd1fa3284e47bc68d07349cc5a68901d1b032262543c1a09b9236282a69a04ccffd28f09166789eb30a558f86556576891025010658d124428c91c5e5bd9c0eb29a365dc85cf920d0aa716dc55ffd45bf533fda3aa3e7034a47370d03878701027a2f2ee05a6bc2a902a3e45d0846c69b265c896255b01f34a0da620d1c908f2b1f2212ac889a74864cbe36f80594ac070514532692c505292d5a6930d8bec4ca0c9942000483221f8dd0841de642f2c521665c0a2adbaca9ff3c087bc2d85632bf9134d2788518518d2f963ba47d8c5bd3976c2be9382ba1084098159a7dcabbc8c2ea5324399a1d3f54c566dd416d29732ebd49bb50daa20435628a813b43970263d85b78559eab99af4187c9c7e847f447886fe21cf5950d7b466162231860272b29b5901918272917e11b0018482204a3242674d33f03a2db17a2d68ed81cf20201fb7834d090360dc4e4594242f9b253946a7589452b672a70ce43de8cfd6808cce850368a7036ab2e4734129a215140ce3544a5f650063001677a7d8256c2f4bb303f0993e13a3700c17677577448730ea1e8bc70c24c01d71dfe1916ecce31da36a8ce3c6b16358a237dcbe7f039267b41bd74ccddc262351ae9cb768e1cf2865f834e2d843141c3e44822b33b729e8b53abf98abc39f6ed724fca29b637a635775416bac2679a65ded05ada59d903bc7a067dd5c52be6b754f379245ecc05278bd548c86ac262802d48930b6927f9d8e7106c29109eda01a29035003ccc740065cda1c8e8d079703766fa9b8b5b490dd73fa936f9c3ff73bf49953d398574f8f670e9fc668f85da421aab0d50a21914a3aaa282fb8aaf6a8735177142dd9538b4254099350e3d17e973861d798e6b90b04856c21b2ce780181b800799a164406429117181a29f4d365854efb143aed3dbfb348a7380e89f89f8984b26585ce3ab28ef4ac1d2702d79d92414a9e2b2f9157c9bd322b0b7e0bdab5a9538e2657d157fec72c69e68bcabc6c4977457dd532f90ec22fdd3d273eafbd2d1c8e2b14363084593c54a7870fef46602ea4d08622e99e71cdd8a2439cd02fd8d30ae8120eee9a5610ec16876c29f008cbb14bbc2b86c81687c4cfd6385575724d81d782e811c0c72776051059e19015880c61f2d3ed6570073ea9771849a1050af09f07f58283e7001b14c0fcee7fd070cf7f9c2921aeb98bb913714cefe95ee4955e89ecfc77d837288d4a00c7a29819d741d0080613914482610c262847e404f36c6497f692464722d1044c55d8e69cc09c881d5fc82e142f311698970716452e8f16e397241e883c0e8d58254d5b95b2181a65f5857c4c12f2acbe5dc5500e9757bfe02b60e3112fe2e5e59dbc31218e134dcee3381c5e57de0b06f278c10928f3f1de0a50a17bd682eeb1905ef60bf41ce69c726d9beb20048a14e7c3dd58f2ca113fcb8b3074979965d6e70bdebabb7b12db658b841664918e111b9da67d356c54750b833d53629bb71b546b0b65b6c15c4d9aba126c04135e05d37ed45fdaf5e281d29e675e06156ffe16246ef9e81bff597a13be02ae03dfdb57fa97dfbd57dab2f365b0e885d2ff960e803690e803f2374bef3b31056608c9ba4a45c158c71e5c6aae08c299c6cce0a5c6a54146562a11905391a8e3ad5aa316e44bcb4afa8a564ed88b96c789926b4541c24b2018ae523c615bf83a09f1541ca0fff1a8ea5d71d5bbe26ad9ed55ff7fddde535f707b63fe4883676acf367a9c257197c3757e1d531b3b52db3585b8bf9a86dddfe897bbbf2da49d0256579b882e870b60fdc3b3563edcf597d22f4a1bc16dcf7fbffbc2717797ee63f768d6d25dd7ed2d0d0dfd98060fdeb9f8ab211547759e4068fb13b402512a0def242b506dc91ab0262417555d2d5c57c588a48c4f205b9e6c33081408379362394c281e217b843530fc873e2bde86f6c7fbd2b56d263eaea86d33dcbdeeeed1ebbfe9abc839afa3f30d778f5fb7672022ab5d90bc20355f5e9cbc2eb95abc59bb45bf47daa83faa3eab0fe847b50f7503c94ecad483a6a99bba225a09581d0f4b9c85ebebd8a8288623f15865e485e1415f246ad0f1c32211aa3a4df82a1ad5754da81cc55ca35334651faf32a77d97f3ea77398f13887317236e1e872f11d79dcaaccaf466e84c3a0abf908f29b357f41f652feeefea821aec067c31aae24a7cec48d48d6661c3c1e532e429a0834213a9a6738ae9d8726db3ef070334292f91045b2fe8c624d39a84211bf4109b4143c81f8f154ca41b2cf4d0ec64c14006bd91ae428f32d87725768831ecf8dbf2, 1, NULL, 3, '2019-12-15 16:32:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `emailnotificaciones`
--

CREATE TABLE `emailnotificaciones` (
  `id` int(11) NOT NULL,
  `enviadopor` varchar(300) NOT NULL,
  `recibidopor` varchar(300) NOT NULL,
  `cc` varchar(300) DEFAULT NULL,
  `bcc` varchar(300) DEFAULT NULL,
  `mensaje` text NOT NULL,
  `leido` int(1) NOT NULL DEFAULT '0',
  `estado` int(1) NOT NULL DEFAULT '0',
  `fechaenvio` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fecharecibido` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_avaluo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `emailnotificaciones`
--

INSERT INTO `emailnotificaciones` (`id`, `enviadopor`, `recibidopor`, `cc`, `bcc`, `mensaje`, `leido`, `estado`, `fechaenvio`, `fecharecibido`, `id_avaluo`) VALUES
(1, 'carlos.gerd.claros.orellana@gmx.es', 'emaraz@invercon-sgv.com', NULL, NULL, '<p>DATOS </p><p>Casa</p><p>departamento</p>', 0, 0, '2020-01-03 20:02:11', '2020-01-03 20:02:11', NULL),
(2, 'carlos.gerd.claros.orellana@gmx.es', 'moros@invercon-sgv.com', NULL, NULL, '<p>DATOS </p><p>Casa</p><p>departamento</p>', 0, 0, '2020-01-03 20:02:11', '2020-01-03 20:02:11', NULL),
(3, 'carlos.gerd.claros.orellana@gmx.es', 'emaraz@invercon-sgv.com', NULL, NULL, '<p>DATOS </p><p>Casa</p>', 0, 0, '2020-01-03 20:03:15', '2020-01-03 20:03:15', NULL),
(4, 'carlos.gerd.claros.orellana@gmx.es', 'moros@invercon-sgv.com', NULL, NULL, '<p>DATOS </p><p>Casa</p>', 0, 0, '2020-01-03 20:03:15', '2020-01-03 20:03:15', NULL),
(5, 'emaraz@invercon-sgv.com', 'rmendoza@invercon-sgv.com', NULL, NULL, 'El avaluo cambio de estado en progreso', 0, 0, '2020-01-03 20:46:17', '2020-01-03 20:46:17', NULL),
(6, 'emaraz@invercon-sgv.com', 'carlos.gerd.claros.orellana@gmx.es', NULL, NULL, 'El avaluo cambio de estado en progreso', 0, 0, '2020-01-03 20:46:17', '2020-01-03 20:46:17', NULL),
(7, 'rmendoza@invercon-sgv.com', 'emaraz@invercon-sgv.com', NULL, NULL, 'El avaluo fue terminado por inspector', 0, 0, '2020-01-03 20:47:50', '2020-01-03 20:47:50', NULL),
(8, 'rmendoza@invercon-sgv.com', 'moros@invercon-sgv.com', NULL, NULL, 'El avaluo fue terminado por inspector', 0, 0, '2020-01-03 20:47:50', '2020-01-03 20:47:50', NULL),
(9, 'rmendoza@invercon-sgv.com', 'carlos.gerd.claros.orellana@gmx.es', NULL, NULL, 'El avaluo fue terminado por inspector', 0, 0, '2020-01-03 20:47:50', '2020-01-03 20:47:50', NULL),
(10, 'rmendoza@invercon-sgv.com', 'carlos.gerd.claros.orellana@gmx.es', NULL, NULL, 'El avaluo fue terminado por inspector', 0, 0, '2020-01-03 20:47:50', '2020-01-03 20:47:50', NULL),
(11, 'emaraz@invercon-sgv.com', 'jlarrazabal@invercon-sgv.com', NULL, NULL, 'El avaluo cambio de estado en progreso', 0, 0, '2020-01-05 23:36:00', '2020-01-05 23:36:00', NULL),
(12, 'emaraz@invercon-sgv.com', 'carlos.gerd.claros.orellana@gmx.es', NULL, NULL, 'El avaluo cambio de estado en progreso', 0, 0, '2020-01-05 23:36:00', '2020-01-05 23:36:00', NULL),
(13, 'amy.winehouse.Testeprep@gmail.com', 'emaraz@invercon-sgv.com', NULL, NULL, '<p>DATOS </p><p>Casa</p>', 0, 0, '2020-01-05 23:42:05', '2020-01-05 23:42:05', NULL),
(14, 'amy.winehouse.Testeprep@gmail.com', 'moros@invercon-sgv.com', NULL, NULL, '<p>DATOS </p><p>Casa</p>', 0, 0, '2020-01-05 23:42:05', '2020-01-05 23:42:05', NULL),
(15, 'emaraz@invercon-sgv.com', 'rmendoza@invercon-sgv.com', NULL, NULL, 'El avaluo cambio de estado en progreso', 0, 0, '2020-01-05 23:43:36', '2020-01-05 23:43:36', NULL),
(16, 'emaraz@invercon-sgv.com', 'amy.winehouse.Testeprep@gmail.com', NULL, NULL, 'El avaluo cambio de estado en progreso', 0, 0, '2020-01-05 23:43:36', '2020-01-05 23:43:36', NULL),
(17, 'rmendoza@invercon-sgv.com', 'emaraz@invercon-sgv.com', NULL, NULL, 'El avaluo fue terminado por inspector', 0, 0, '2020-01-05 23:48:38', '2020-01-05 23:48:38', NULL),
(18, 'rmendoza@invercon-sgv.com', 'moros@invercon-sgv.com', NULL, NULL, 'El avaluo fue terminado por inspector', 0, 0, '2020-01-05 23:48:39', '2020-01-05 23:48:39', NULL),
(19, 'rmendoza@invercon-sgv.com', 'amy.winehouse.Testeprep@gmail.com', NULL, NULL, 'El avaluo fue terminado por inspector', 0, 0, '2020-01-05 23:48:39', '2020-01-05 23:48:39', NULL),
(20, 'rmendoza@invercon-sgv.com', 'amy.winehouse.Testeprep@gmail.com', NULL, NULL, 'El avaluo fue terminado por inspector', 0, 0, '2020-01-05 23:48:39', '2020-01-05 23:48:39', NULL);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `especial`
--
CREATE TABLE `especial` (
`name` varchar(50)
,`id` int(11)
,`lastname` varchar(50)
,`email` varchar(255)
,`address` varchar(255)
,`phone` varchar(255)
,`cell` varchar(255)
,`id_sucursal` int(11)
,`tipoespecial` varchar(200)
,`imagen_tipoespecial01` blob
,`documentos` varchar(100)
,`longitud` double
,`latitud` double
,`tipoinmueble` varchar(255)
,`nombre_contacto` varchar(200)
,`email_contacto` varchar(50)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`id`, `descripcion`) VALUES
(1, 'SOLICITUD'),
(2, 'PROGRESO'),
(3, 'TERMINADO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadointerno`
--

CREATE TABLE `estadointerno` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  `owner` varchar(20) DEFAULT NULL,
  `time` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estadointerno`
--

INSERT INTO `estadointerno` (`id`, `descripcion`, `owner`, `time`) VALUES
(1, 'SOLICITUD', 'secreatria', 0),
(2, 'AVALUO ASIGNADO', 'secreatria', 0),
(3, 'AVALUO EN INSPECCION', 'inspector', 0),
(4, 'INSPECCION NO REALIZADA', 'inspector', 0),
(5, 'INFORME TERMINADO INSPECTOR', 'inspector', 0),
(6, 'REVISION AVALUO', 'supervisor', 24),
(7, 'REVISION TERMINADA AVALUO', 'supervisor', 24),
(8, 'AVALUO TERMINADO', 'secreatria', 24);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadopago`
--

CREATE TABLE `estadopago` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estadopago`
--

INSERT INTO `estadopago` (`id`, `descripcion`) VALUES
(1, 'INICIO'),
(2, 'PAGO A CUENTA'),
(3, 'PAGO TOTAL'),
(4, 'PAGO FINALIZADO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_sms`
--

CREATE TABLE `estado_sms` (
  `ESTADO` varchar(3) COLLATE utf8_spanish_ci NOT NULL,
  `DESCRIPCION` varchar(20) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `estado_sms`
--

INSERT INTO `estado_sms` (`ESTADO`, `DESCRIPCION`) VALUES
('LIS', 'LISTO PARA ENVIAR'),
('OK', 'ENVIADO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historico`
--

CREATE TABLE `historico` (
  `id` int(11) NOT NULL,
  `proceso` varchar(50) NOT NULL,
  `responsable` varchar(30) NOT NULL,
  `ingreso` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `salida` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comentario` text,
  `id_solicitud` int(11) NOT NULL,
  `id_avaluo` int(11) NOT NULL,
  `id_sucursal` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `historico`
--

INSERT INTO `historico` (`id`, `proceso`, `responsable`, `ingreso`, `salida`, `comentario`, `id_solicitud`, `id_avaluo`, `id_sucursal`) VALUES
(1, '2', 'rmendoza@invercon-sgv.com', '2020-01-03 16:46:17', '2020-01-03 16:46:17', 'Comentarios secretaria', 2, 3, NULL),
(2, '3', 'rmendoza@invercon-sgv.com', '2020-01-03 16:47:50', '2020-01-03 16:47:50', 'comentairosde inspercto', 2, 3, NULL),
(3, '2', 'jlarrazabal@invercon-sgv.com', '2020-01-05 19:36:00', '2020-01-05 19:36:00', 'INICIO', 1, 1, NULL),
(4, '2', 'rmendoza@invercon-sgv.com', '2020-01-05 19:43:36', '2020-01-05 19:43:36', 'INICIO', 3, 4, NULL),
(5, '3', 'rmendoza@invercon-sgv.com', '2020-01-05 19:48:39', '2020-01-05 19:48:39', 'ACEPTAR', 3, 4, NULL),
(6, '5', 'rmendoza@invercon-sgv.com', '2020-01-05 19:51:11', '2020-01-05 19:51:11', 'INFORME TERMINADO', 2, 3, NULL),
(7, '7', 'fclaros@invercon-sgv.com', '2020-01-05 19:56:01', '2020-01-05 19:56:01', 'INFORME TERMINADO\r\npor el superisor', 2, 3, NULL);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `inmueble`
--
CREATE TABLE `inmueble` (
`lastname` varchar(50)
,`email` varchar(255)
,`address` varchar(255)
,`phone` varchar(255)
,`cell` varchar(255)
,`tipoinmueble` varchar(255)
,`id_ciudad_inmueble` int(11)
,`id_provincia_inmueble` int(11)
,`imagen_inmueble01` blob
,`imagen_inmueble02` blob
,`imagen_inmueble03` blob
,`name` varchar(50)
,`id_sucursal` int(11)
,`longitud` double
,`latitud` double
,`created_at` datetime
,`id` int(11)
,`nombre_contacto` varchar(200)
,`email_contacto` varchar(50)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `inspector`
--
CREATE TABLE `inspector` (
`nombre` varchar(100)
,`apellido` varchar(50)
,`login` varchar(100)
,`password` varchar(20)
,`ci` varchar(20)
,`id_rol` int(11)
,`id_sucursal` int(11)
,`email` varchar(50)
,`telefono_fijo01` varchar(100)
,`telefono_fijo02` varchar(100)
,`celular` varchar(100)
,`celular2` varchar(100)
,`direccion` text
,`cargo` varchar(100)
,`id_institucion` int(11)
,`especialidad` varchar(100)
,`status` int(11)
,`color` varchar(20)
,`avatar` blob
,`codigo` varchar(5)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `maquinaria`
--
CREATE TABLE `maquinaria` (
`id` int(11)
,`name` varchar(50)
,`lastname` varchar(50)
,`email` varchar(255)
,`address` varchar(255)
,`cell` varchar(255)
,`phone` varchar(255)
,`id_sucursal` int(11)
,`tipomaquinaria` varchar(255)
,`id_ciudad_maquinaria` int(11)
,`id_provincia_maquinaria` int(11)
,`imagen_maquinaria01` blob
,`imagen_maquinaria02` blob
,`imagen_maquinaria03` blob
,`tipoinmueble` varchar(255)
,`longitud` double
,`latitud` double
,`nombre_contacto` varchar(200)
,`email_contacto` varchar(50)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensaje`
--

CREATE TABLE `mensaje` (
  `MENSAJE_ID` int(11) NOT NULL,
  `TELEFONOS` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `MENSAJE` varchar(120) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `mensaje`
--

INSERT INTO `mensaje` (`MENSAJE_ID`, `TELEFONOS`, `MENSAJE`) VALUES
(1, '70769804', 'Prueba puchera');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `mercaderia`
--
CREATE TABLE `mercaderia` (
`id` int(11)
,`name` varchar(50)
,`lastname` varchar(50)
,`email` varchar(255)
,`address` varchar(255)
,`phone` varchar(255)
,`cell` varchar(255)
,`id_sucursal` int(11)
,`tipomercaderia` varchar(200)
,`imagen_mercaderia01` blob
,`documento_mercaderia` varchar(100)
,`longitud` double
,`latitud` double
,`tipoinmueble` varchar(255)
,`nombre_contacto` varchar(200)
,`email_contacto` varchar(50)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `metodopago`
--

CREATE TABLE `metodopago` (
  `id` int(11) NOT NULL,
  `short_name` varchar(100) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '0',
  `DateModified` datetime DEFAULT NULL,
  `DateDeleted` datetime DEFAULT NULL,
  `CreatedBy` varchar(100) DEFAULT NULL,
  `ModifiedBy` varchar(100) DEFAULT NULL,
  `DeletedBy` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `metodopago`
--

INSERT INTO `metodopago` (`id`, `short_name`, `name`, `is_active`, `DateModified`, `DateDeleted`, `CreatedBy`, `ModifiedBy`, `DeletedBy`) VALUES
(1, 'deposito', 'Deposito Bancario', 1, NULL, NULL, NULL, NULL, NULL),
(2, 'deliver', 'Pago Contra entrega', 1, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE `notificaciones` (
  `id` int(30) NOT NULL,
  `mensaje` varchar(300) NOT NULL,
  `creadopor` varchar(300) NOT NULL,
  `recibidopor` varchar(300) NOT NULL,
  `leido` int(1) NOT NULL DEFAULT '0',
  `estado` int(1) NOT NULL DEFAULT '0',
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fechaleido` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `desde` varchar(20) DEFAULT NULL,
  `id_avaluo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `notificaciones`
--

INSERT INTO `notificaciones` (`id`, `mensaje`, `creadopor`, `recibidopor`, `leido`, `estado`, `fecha`, `fechaleido`, `desde`, `id_avaluo`) VALUES
(1, '<p>DATOS </p><p>Casa</p><p>departamento</p>', 'carlos.gerd.claros.orellana@gmx.es', 'emaraz@invercon-sgv.com', 0, 0, '2020-01-03 20:02:11', '2020-01-03 20:02:11', NULL, NULL),
(2, '<p>DATOS </p><p>Casa</p><p>departamento</p>', 'carlos.gerd.claros.orellana@gmx.es', 'moros@invercon-sgv.com', 0, 0, '2020-01-03 20:02:11', '2020-01-03 20:02:11', NULL, NULL),
(3, '<p>DATOS </p><p>Casa</p>', 'carlos.gerd.claros.orellana@gmx.es', 'emaraz@invercon-sgv.com', 0, 0, '2020-01-03 20:03:15', '2020-01-03 20:03:15', NULL, NULL),
(4, '<p>DATOS </p><p>Casa</p>', 'carlos.gerd.claros.orellana@gmx.es', 'moros@invercon-sgv.com', 0, 0, '2020-01-03 20:03:15', '2020-01-03 20:03:15', NULL, NULL),
(5, 'El avaluo cambio de estado en progreso', 'emaraz@invercon-sgv.com', 'rmendoza@invercon-sgv.com', 0, 0, '2020-01-03 20:46:17', '2020-01-03 20:46:17', NULL, NULL),
(6, 'El avaluo cambio de estado en progreso', 'emaraz@invercon-sgv.com', 'carlos.gerd.claros.orellana@gmx.es', 0, 0, '2020-01-03 20:46:17', '2020-01-03 20:46:17', NULL, NULL),
(7, 'El avaluo fue terminado por inspector', 'rmendoza@invercon-sgv.com', 'emaraz@invercon-sgv.com', 0, 0, '2020-01-03 20:47:50', '2020-01-03 20:47:50', NULL, NULL),
(8, 'El avaluo fue terminado por inspector', 'rmendoza@invercon-sgv.com', 'moros@invercon-sgv.com', 0, 0, '2020-01-03 20:47:50', '2020-01-03 20:47:50', NULL, NULL),
(9, 'El avaluo cambio de estado en progreso', 'emaraz@invercon-sgv.com', 'jlarrazabal@invercon-sgv.com', 0, 0, '2020-01-05 23:36:00', '2020-01-05 23:36:00', NULL, NULL),
(10, 'El avaluo cambio de estado en progreso', 'emaraz@invercon-sgv.com', 'carlos.gerd.claros.orellana@gmx.es', 0, 0, '2020-01-05 23:36:00', '2020-01-05 23:36:00', NULL, NULL),
(11, '<p>DATOS </p><p>Casa</p>', 'amy.winehouse.Testeprep@gmail.com', 'emaraz@invercon-sgv.com', 0, 0, '2020-01-05 23:42:05', '2020-01-05 23:42:05', NULL, NULL),
(12, '<p>DATOS </p><p>Casa</p>', 'amy.winehouse.Testeprep@gmail.com', 'moros@invercon-sgv.com', 0, 0, '2020-01-05 23:42:05', '2020-01-05 23:42:05', NULL, NULL),
(13, 'El avaluo cambio de estado en progreso', 'emaraz@invercon-sgv.com', 'rmendoza@invercon-sgv.com', 0, 0, '2020-01-05 23:43:36', '2020-01-05 23:43:36', NULL, NULL),
(14, 'El avaluo cambio de estado en progreso', 'emaraz@invercon-sgv.com', 'amy.winehouse.Testeprep@gmail.com', 0, 0, '2020-01-05 23:43:36', '2020-01-05 23:43:36', NULL, NULL),
(15, 'El avaluo fue terminado por inspector', 'rmendoza@invercon-sgv.com', 'emaraz@invercon-sgv.com', 0, 0, '2020-01-05 23:48:39', '2020-01-05 23:48:39', NULL, NULL),
(16, 'El avaluo fue terminado por inspector', 'rmendoza@invercon-sgv.com', 'moros@invercon-sgv.com', 0, 0, '2020-01-05 23:48:39', '2020-01-05 23:48:39', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `offline_messages`
--

CREATE TABLE `offline_messages` (
  `id` int(11) NOT NULL,
  `timestamp` datetime NOT NULL,
  `name` varchar(700) NOT NULL,
  `email` varchar(700) NOT NULL,
  `message` varchar(700) NOT NULL,
  `ip` varchar(700) NOT NULL,
  `user_agent` varchar(700) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `offline_messages`
--

INSERT INTO `offline_messages` (`id`, `timestamp`, `name`, `email`, `message`, `ip`, `user_agent`) VALUES
(1, '2019-08-22 00:45:54', 'adedaed', 'danesafe@gmail.com', 'xczsadcsadcsacas', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36 OPR/62.0.3331.116'),
(2, '2019-08-22 14:37:40', 'carlos', 'carlitos.gerd@gmail.com', 'mensaje', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36'),
(3, '2019-08-22 15:06:45', 'Guest', 'carlitos.gerd@gmail.com', 'fsdfsf', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36'),
(4, '2019-08-22 18:29:28', 'Guest', 'carlitos.gerd@gmail.com', 'dfsdfsdf', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `oficialcredito`
--
CREATE TABLE `oficialcredito` (
`nombre` varchar(100)
,`apellido` varchar(50)
,`login` varchar(100)
,`password` varchar(20)
,`ci` varchar(20)
,`id_rol` int(11)
,`id_sucursal` int(11)
,`email` varchar(50)
,`telefono_fijo01` varchar(100)
,`telefono_fijo02` varchar(100)
,`celular` varchar(100)
,`celular2` varchar(100)
,`direccion` text
,`cargo` varchar(100)
,`id_institucion` int(11)
,`especialidad` varchar(100)
,`status` int(11)
,`avatar` blob
,`codigo` varchar(5)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago`
--

CREATE TABLE `pago` (
  `id` int(11) NOT NULL,
  `k` varchar(20) DEFAULT NULL,
  `code` varchar(20) DEFAULT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `metodopago_id` int(11) DEFAULT NULL,
  `documento_pago` mediumblob
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago_avaluo`
--

CREATE TABLE `pago_avaluo` (
  `id` int(11) NOT NULL,
  `pago_id` int(11) DEFAULT NULL,
  `avaluo_id` int(11) DEFAULT NULL,
  `q` int(11) DEFAULT '1',
  `id_metodopago` int(11) NOT NULL,
  `id_banco` int(11) DEFAULT NULL,
  `monto` double NOT NULL,
  `documentopago` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pago_avaluo`
--

INSERT INTO `pago_avaluo` (`id`, `pago_id`, `avaluo_id`, `q`, `id_metodopago`, `id_banco`, `monto`, `documentopago`) VALUES
(1, NULL, 3, 1, 1, 1, 10, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincia`
--

CREATE TABLE `provincia` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `id_departamento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `provincia`
--

INSERT INTO `provincia` (`id`, `nombre`, `id_departamento`) VALUES
(1, 'Cercado', 1),
(2, 'cercado oruro', 2),
(3, 'montero', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sms_data`
--

CREATE TABLE `sms_data` (
  `id` int(11) NOT NULL,
  `CELULAR` int(11) NOT NULL,
  `MENSAJE` varchar(350) NOT NULL,
  `ESTADO` varchar(3) NOT NULL DEFAULT 'LIS',
  `FECHA` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sms_data`
--

INSERT INTO `sms_data` (`id`, `CELULAR`, `MENSAJE`, `ESTADO`, `FECHA`) VALUES
(1, 70769804, 'Prueba puchera', 'OK', '2020-01-02 18:59:54'),
(2, 72857911, 'Prueba CECY', 'OK', '2020-01-02 18:59:55'),
(3, 72152388, 'mensaje demo', 'OK', '2020-01-02 19:04:24'),
(4, 0, 'Su avaluo fue terminado pase por la oficina para cancelar el costo', 'ERR', '2020-01-02 19:20:15'),
(5, 2147483647, 'Su avaluo fue terminado pase por la oficina para cancelar el costo', 'OK', '2020-01-02 19:25:07'),
(6, 2147483647, 'Su avaluo fue terminado pase por la oficina para cancelar el costo', 'OK', '2020-01-02 19:27:04'),
(7, 78441410, 'Su avaluo fue terminado pase por la oficina para cancelar el costo', 'OK', '2020-01-02 19:32:10'),
(8, 76007970, 'Su avaluo fue terminado pase por la oficina para cancelar el costo', 'OK', '2020-01-02 19:59:28'),
(9, 76007970, 'Su avaluo fue terminado pase por la oficina para cancelar el costo', 'OK', '2020-01-02 19:59:29'),
(10, 78441410, 'Su avaluo fue terminado pase por la oficina para cancelar el costo', 'OK', '2020-01-02 20:42:39'),
(11, 78441410, 'Su avaluo fue terminado pase por la oficina para cancelar el costo', 'OK', '2020-01-02 20:42:40'),
(12, 2147483647, 'Su avaluo fue terminado pase por la oficina para cancelar el saldo', 'LIS', '2020-01-03 21:45:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud`
--

CREATE TABLE `solicitud` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `nombre_contacto` varchar(200) DEFAULT NULL,
  `email_contacto` varchar(50) DEFAULT NULL,
  `latitud` double DEFAULT NULL,
  `longitud` double DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `cell` varchar(255) DEFAULT NULL,
  `id_sucursal` int(11) NOT NULL,
  `tipoinmueble` varchar(255) DEFAULT NULL,
  `id_ciudad_inmueble` int(11) DEFAULT NULL,
  `id_provincia_inmueble` int(11) DEFAULT NULL,
  `imagen_inmueble01` blob,
  `imagen_inmueble02` blob,
  `imagen_inmueble03` blob,
  `imagen_inmueble04` blob,
  `imagen_inmueble05` blob,
  `imagen_inmueble06` blob,
  `imagen_inmueble07` blob,
  `imagen_inmueble08` blob,
  `tipovehiculo` varchar(255) DEFAULT NULL,
  `id_ciudad_vehiculo` int(11) DEFAULT NULL,
  `id_provincia_vehiculo` int(11) DEFAULT NULL,
  `imagen_vehiculo01` blob,
  `imagen_vehiculo02` blob,
  `imagen_vehiculo03` blob,
  `imagen_vehiculo04` blob,
  `imagen_vehiculo05` blob,
  `imagen_vehiculo06` blob,
  `imagen_vehiculo07` blob,
  `imagen_vehiculo08` blob,
  `tipomaquinaria` varchar(255) DEFAULT NULL,
  `id_ciudad_maquinaria` int(11) DEFAULT NULL,
  `id_provincia_maquinaria` int(11) DEFAULT NULL,
  `imagen_maquinaria01` blob,
  `imagen_maquinaria02` blob,
  `imagen_maquinaria03` blob,
  `imagen_maquinaria04` blob,
  `imagen_maquinaria05` blob,
  `imagen_maquinaria06` blob,
  `imagen_maquinaria07` blob,
  `imagen_maquinaria08` blob,
  `tipomercaderia` varchar(200) DEFAULT NULL,
  `imagen_mercaderia01` blob,
  `documento_mercaderia` varchar(100) DEFAULT NULL,
  `tipoespecial` varchar(200) DEFAULT NULL,
  `imagen_tipoespecial01` blob,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `documentos` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `DateModified` datetime DEFAULT NULL,
  `DateDeleted` datetime DEFAULT NULL,
  `CreatedBy` varchar(100) DEFAULT NULL,
  `ModifiedBy` varchar(100) DEFAULT NULL,
  `DeletedBy` varchar(100) DEFAULT NULL,
  `monto_inicial` double DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `solicitud`
--

INSERT INTO `solicitud` (`id`, `name`, `lastname`, `email`, `address`, `nombre_contacto`, `email_contacto`, `latitud`, `longitud`, `phone`, `cell`, `id_sucursal`, `tipoinmueble`, `id_ciudad_inmueble`, `id_provincia_inmueble`, `imagen_inmueble01`, `imagen_inmueble02`, `imagen_inmueble03`, `imagen_inmueble04`, `imagen_inmueble05`, `imagen_inmueble06`, `imagen_inmueble07`, `imagen_inmueble08`, `tipovehiculo`, `id_ciudad_vehiculo`, `id_provincia_vehiculo`, `imagen_vehiculo01`, `imagen_vehiculo02`, `imagen_vehiculo03`, `imagen_vehiculo04`, `imagen_vehiculo05`, `imagen_vehiculo06`, `imagen_vehiculo07`, `imagen_vehiculo08`, `tipomaquinaria`, `id_ciudad_maquinaria`, `id_provincia_maquinaria`, `imagen_maquinaria01`, `imagen_maquinaria02`, `imagen_maquinaria03`, `imagen_maquinaria04`, `imagen_maquinaria05`, `imagen_maquinaria06`, `imagen_maquinaria07`, `imagen_maquinaria08`, `tipomercaderia`, `imagen_mercaderia01`, `documento_mercaderia`, `tipoespecial`, `imagen_tipoespecial01`, `is_active`, `documentos`, `created_at`, `DateModified`, `DateDeleted`, `CreatedBy`, `ModifiedBy`, `DeletedBy`, `monto_inicial`) VALUES
(1, 'MARIO', '78441410', 'carlitos.gerd@gmail.com', 'XXXX', 'juan carlos', 'carlos.gerd.claros.orellana@gmx.es', NULL, NULL, '24242', '59178441410', 3, 'Casa,departamento', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020-01-03 16:02:11', NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'martin duran', '78441410', 'carlitos.gerd@gmail.com', 'XXXX', 'carlos claros orellanas', 'carlos.gerd.claros.orellana@gmx.es', NULL, NULL, '24242', '59178441410', 3, 'Casa', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020-01-03 16:03:15', NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'PRUEBA', '78441410', 'carlitos.gerd@gmail.com', 'XXXX', 'juan carlos', 'amy.winehouse.Testeprep@gmail.com', NULL, NULL, '78441410', '59178441410', 3, 'Casa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020-01-05 19:41:43', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `streets`
--

CREATE TABLE `streets` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `geolocations` text NOT NULL,
  `keywords` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursal`
--

CREATE TABLE `sucursal` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `direccion` text,
  `nombre_contacto` varchar(100) DEFAULT NULL,
  `email_contacto` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sucursal`
--

INSERT INTO `sucursal` (`id`, `nombre`, `direccion`, `nombre_contacto`, `email_contacto`) VALUES
(1, 'Cochabamba', NULL, NULL, NULL),
(2, 'La Paz', NULL, NULL, NULL),
(3, 'Santa Cruz', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `supervisor`
--
CREATE TABLE `supervisor` (
`nombre` varchar(100)
,`apellido` varchar(50)
,`login` varchar(100)
,`password` varchar(20)
,`ci` varchar(20)
,`id_rol` int(11)
,`id_sucursal` int(11)
,`email` varchar(50)
,`telefono_fijo01` varchar(100)
,`telefono_fijo02` varchar(100)
,`celular` varchar(100)
,`celular2` varchar(100)
,`direccion` text
,`cargo` varchar(100)
,`id_institucion` int(11)
,`especialidad` varchar(100)
,`status` int(11)
,`avatar` blob
,`color` varchar(20)
,`codigo` varchar(5)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `table 19`
--

CREATE TABLE `table 19` (
  `COL 1` varchar(24) DEFAULT NULL,
  `COL 2` varchar(39) DEFAULT NULL,
  `COL 3` varchar(45) DEFAULT NULL,
  `COL 4` varchar(56) DEFAULT NULL,
  `COL 5` varchar(32) DEFAULT NULL,
  `COL 6` varchar(23) DEFAULT NULL,
  `COL 7` varchar(11) DEFAULT NULL,
  `COL 8` varchar(12) DEFAULT NULL,
  `COL 9` varchar(12) DEFAULT NULL,
  `COL 10` varchar(10) DEFAULT NULL,
  `COL 11` varchar(8) DEFAULT NULL,
  `COL 12` varchar(8) DEFAULT NULL,
  `COL 13` varchar(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `table 19`
--

INSERT INTO `table 19` (`COL 1`, `COL 2`, `COL 3`, `COL 4`, `COL 5`, `COL 6`, `COL 7`, `COL 8`, `COL 9`, `COL 10`, `COL 11`, `COL 12`, `COL 13`) VALUES
('Asistente', 'Osvaldo Cruz Mamani', 'OCM', '', '', '', 'Activo', '06/11/1977', '6424913 Cbba', 'Cochabamba', '79783039', '', '4508476'),
('Asistente Administrativa', 'Andrea Rosazza Morales', 'ARM', 'Calle Idelfonso Murgu?a, O-1978', 'andrea_9998@?hotmail.com', 'Administraci?n;Activo', '21/08/1982', '', 'Cochabamba', '70741149', '', '4240654', NULL),
('Asistente Administrativa', 'Claudia Tavera C?ceres', 'CTC', '', '', 'Administraci?n;En licen', '04/08/1969', '2317307 Lpz', 'Santa Cruz', '72525154', '', '3433014', NULL),
('Asistente Administrativa', 'Elda Maraz Villalba', 'EMV', 'B. Heroes del Chaco, calle Froilan Tejerina n? 14', 'sgvsantacruz@gmail.com ', 'Administraci?n;Activo', '06/09/1973', '3894212 SC', 'Santa Cruz', '70947970', '', '3482697', NULL),
('Asistente Administrativa', 'Fresia Paola Iturri Albarrac?n;FIA', '', 'paolaiturri07@gmail.com', 'Administraci?n;Activo', '25/05/1983', '6750467 Lpz', 'La Paz', '70177395', '', '2352967', NULL, NULL),
('Asistente Administrativa', 'Karen Loma Ruiz', 'KLR', '', '', 'Administraci?n;En licen', '25/02/1980', '', 'Cochabamba', '73988839', '', '4549947', NULL),
('Asistente Administrativa', 'Mar?a Angelica Lobo Morales', 'MLM', 'Calle Sartre esq. Max Raux', '', 'Administraci?n;En licen', '02/06/1998', '13697112', 'Santa Cruz', '60015429', '', '', NULL),
('Asistente Administrativa', 'Maria Fernanda Oros Suarez', 'FOS', '', 'sgvsantacruzrecepcion@gmail.com ', 'Administraci?n;Activo', '12/08/1995', '', 'Santa Cruz', '70030626', '70288632', '', NULL),
('Asistente Administrativa', 'Marly Parada Ardaya', 'MPA', 'Av. Argentina Cond. Argentino ', '', 'Administraci?n;En licen', '19/07/1988', '8165291', 'Santa Cruz', '65436144', '', '3301954', NULL),
('Asistente Administrativa', 'Mireya Loma Ruiz', 'MLR', '', '', 'Administraci?n;En licen', '04/10/1985', '6485225 Cbba', 'Cochabamba', '79722433', '', '4244450', NULL),
('Asistente Administrativa', 'Ver?nica Loma Ruiz', 'VLR', '', '', 'Administraci?n;En licen', '18/12/1979', '5156389 Cbba', 'Cochabamba', '72249002', '', '4304850', NULL),
('Contadora', 'Nancy Veliz Condori', 'NVC', '', '', 'Contable', 'Activo', '13/06/1971', '5203998', 'Cochabamba', '70348848', '70760651', ''),
('Gerente', 'Franco Claros Orellana', 'FCO', 'Calle Max Raux', 'cheloki@gmail.com', 'Supervision', 'Activo', '25/06/1976', '2822590', 'Santa Cruz', '76007970', '', ''),
('Gerente', 'Rudy Barbosa Levy', 'RBL', '', '', 'Supervision', 'Activo', '07/01/1953', '780113 Cbba', 'Cochabamba', '70362000', '', '4292523'),
('Gerente', 'Vladimir Rosazza Morales', 'VRM', 'Pasaje Juan de La Rosa s/n', 'rosazza@supernet.com.bo', 'Supervision', 'Activo', '09/03/1968', '2878085', 'Cochabamba', '72287563', '71722162', '4285027'),
('Inspector', 'Antonio Alejandro Salinas Balderrama', 'ASB', 'Avenida Circunvalaci?n Este N? 25', '', 'Inmuebles', 'En licencia', '24/11/1974', '3748230 cbba', 'Cochabamba', '70767967', '', '4492354'),
('Inspector', 'Blanca Ulunque Rocha', 'BUR', 'Av. Cuarto Anillo casi Radial 13', 'ark.blanquis@gmail.com ', 'Inmuebles', 'En licencia', '01/06/1979', '4710374 SCZ', 'Santa Cruz', '77828068', '', ''),
('Inspector', 'Carlos Fernando Aguila Bracamonte', 'CFAB', 'Tarija', 'aguilabracamonte@gmail.com ', 'Inmuebles', 'En licencia', '', '', 'Tarija', '77485052', '', ''),
('Inspector', 'Cesar Javier Herrera Martinez', 'CHM', 'Barrio Petrolero Oriente, Calle 1 N? 7', '', 'Inmuebles', 'En licencia', '03/12/1978', '4709532 SCZ', 'Santa Cruz', '77057622', '', '3530634'),
('Inspector', 'Cidar Oliva Rocha', 'COR', '', '', 'Maquinaria', 'Activo', '', '', 'Cochabamba', '72270999', '', '4231765'),
('Inspector', 'Dante Rodriguez Rojas', 'DRR', 'Calle Isaac Hurtado N? 42, Barrio Guaracal', 'danterodrirojas.12@gmail.com ', 'Inmueble', 'En licencia', '12/04/1990', '7619290 Beni', 'Santa Cruz', '79870489', '77355600', ''),
('Inspector', 'David Dennis Tapia Toledo', 'DDT', 'Zona Mariscal Santa Cruz Periferica, Calle 25 de Julio', '', 'Inmuebles', 'Activo', '27/12/1984', '6156439 LP', 'La Paz', '60678889', '', ''),
('Inspector', 'David Placer Rossendi', 'DPR', 'Trojes, s/n', 'david_plaro@hotmail.com', 'Inmuebles', 'En licencia', '05/07/1979', '4505836 Cbba', 'Cochabamba', '79364964', '', '4412158'),
('Inspector', 'David Vila Quinteros', 'DVQ', 'Tiquipaya', '', 'Inmuebles', 'En licencia', '01/04/1982', '4504710', 'Cochabamba', '70399939', '', '4288589'),
('Inspector', 'Eduardo Lima Pelaez', 'ELP', '', '', 'Inmuebles', 'En licencia', '', '', 'La Paz', '', '', ''),
('Inspector', 'Edwin Hugo Tapia Baptista', 'ETB', 'Km 8 Capit?n Ust?riz', 'edwint66@hotmail.com', 'Inmuebles', 'Activo', '21/07/1978', '4538309 cbba', 'Cochabamba', '72214511', '', '4379105'),
('Inspector', 'Eliana Martha Zegarra Tapia', 'EZT', 'Calle Lincoln N? 3, Barrio Olender', '', 'Inmuebles', 'En licencia', '01/11/1976', '4577242', 'Santa Cruz', '76606823', '', '3604817'),
('Inspector', 'Elma Lizbeth D?valos Rojas', 'EDR', 'Calle Dar?o Monta?o #736', '', 'Inmuebles', 'Activo', '10/11/1974', '3437743', 'Cochabamba', '77499483', '', '4233991'),
('Inspector', 'Erick Orellana M?ndez', 'EOM', '', '', 'Inmuebles', 'En licencia', '', '', 'Santa Cruz', '', '', ''),
('Inspector', 'Fabiana Canedo', 'FACR', 'Tarija', 'tierna_fabi@hotmail.com ', 'Inmuebles', 'En licencia', '', '', 'Santa Cruz', '75122846', '', ''),
('Inspector', 'Felix Maraz Villalba', 'FMV', 'Av. Centinelas del Chaco, Barrio 1 de Agosto', '', 'Maquinaria, veh?culos', 'En licencia', '06/06/1987', '7776694 SC', 'Santa Cruz', '76315228', '', ''),
('Inspector', 'Fernando Toledo Azurduy', 'FTA', '', 'fertoledo_a@hotmail.com', 'Inmuebles', 'Activo', '21/11/1972', '3729595', 'Cochabamba', '72710665', '', '4243443'),
('Inspector', 'Gonzalo Adalid Serrano Aguilar', 'GSA', 'Av. Pando 106 y calle Bolivar 1102', '', 'Inmuebles', 'En licencia', '17/03/1979', '3309932', 'La Paz', '76211310', '', ''),
('Inspector', 'Gustavo Adolfo Mendoza Choque', 'GMC', 'Calle Enrique Arze 748', 'gustavo_mendoza81@hotmail.com', 'Inmuebles', 'Activo', '11/01/1981', '8846912 Cbba', 'Cochabamba', '', '', ''),
('Inspector', 'Gustavo Ramos Cortez', 'GRC', 'Avenida Km 7, N? 1543', '', 'Inmuebles', 'En licencia', '13/11/1979', '4451867 Cbba', 'Cochabamba', '76997030', '', '4283565'),
('Inspector', 'Henrry Dur?n Cabrera', 'HDC', 'Enrique Arze #300, Temporal', 'hepatryck@hotmail.com', 'Inmuebles', 'Activo', '16/11/1978', '4536807 cbb', 'Cochabamba', '77452233', '', '4474037'),
('Inspector', 'Irene Patricia Quisbert Condori', 'IQC', '', '', 'Inmuebles', 'Activo', '05/10/1984', '', 'La Paz', '77599500', '', ''),
('Inspector', 'Juan Carlos Rojas Velasquez', 'CRV', 'Pasillo 1, 3 Anillo Externo', '', 'Inmuebles', 'En licencia', '', '', 'Santa Cruz', '', '', ''),
('Inspector', 'Juan Marcelo Guillen Ortega', 'JGO', 'Av. Tacahua 1581', 'machiguillen6@gmail.com', 'Inmuebles', 'En licencia', '15/09/1975', '4756690', 'La Paz', '73086154', '', '2493146'),
('Inspector', 'Juan Pablo Heredia Monz?n;JHM', '', '', 'Inmuebles', 'En licencia', '05/04/1985', '6291573', 'La Paz', '73009232', '', '', NULL),
('Inspector', 'Julio Cesar Larrazabal Mansilla', 'JLM', 'Avenida Las Palmeras N? 313, Barrio  Banzer', '', 'Inmuebles', 'Activo', '26/01/1989', '7725499 SCZ', 'Santa Cruz', '79816378', '72186476', ''),
('Inspector', 'Karem Isela Valencia Condori', 'KVM', 'Av. Quintanilla Suazo Nro 1563', '', 'Inmuebles', 'Activo', '29/12/1985', '6150769 LP', 'La Paz', '72589916', '', ''),
('Inspector', 'Karin Tania Moscoso Lafuente', 'KTML', 'J. N. Rosales s/n', 'karin741@hotmail.com', 'Inmuebles', 'Activo', '28/03/1975', '3765450', 'Cochabamba', '72703657', '', '4248497'),
('Inspector', 'Karl Friederich Wilheim Berkhan Almanza', 'KBA', 'Quillacollo', 'kberkhan@hotmail.com', 'Inmuebles', 'Activo', '20/04/1975', '3144852 Cbba', 'Cochabamba', '72239699', '', '4261630'),
('Inspector', 'Laura Natalia Davila Crespo', 'LDC', 'Calle Alma Cruce?a (5), Barrio La Colorada', 'naity-24@hotmail.com', 'Inmuebles', 'En licencia', '24/09/1989', '7686889 SC', 'Santa Cruz', '76077191', '', ''),
('Inspector', 'Ludwig Carlos Galvez Z??iga', 'LGZ', 'Avenida Mario Mercado #243', '', 'Inmuebles', 'En licencia', '31/03/1976', '2307952', 'La Paz', '70580013', '', '2500818'),
('Inspector', 'Mabel Rivera Silva', 'MRS', 'Calle Neptuno N? 11, Barrio 7 de Julio', 'mabel-rivera@outlook.com ', 'Inmuebles', 'Activo', '12/09/1990', '8157753', 'Santa Cruz', '70203912', '', ''),
('Inspector', 'Marcelo Raul Aranda Valencia', 'MAV', 'Barrio Ferroviario #180, calle 3', '', 'Inmuebles', 'En licencia', '21/01/1981', '', 'La Paz', '', '', ''),
('Inspector', 'Marco Antonio Copa Callisaya', 'MCC', 'Calle Manuel Mar?a Caballero, Barrio Villa Warnes', '', 'Inmuebles', 'En licencia', '08/04/1988', '7809152 SC', 'Santa Cruz', '73977177', '', ''),
('Inspector', 'Mar?a Elena M?rida Zurita ', 'MMZ', 'Calle Andr?s Ferrufino # 80, Barrio Periodista', '', 'Inmuebles', 'Activo', '27/10/1982', '5903725 Cbba', 'Cochabamba', '76971796', '', '4422834'),
('Inspector', 'Mar?a Valeria Diaz Carre?o;VDC', 'Calle Las Azucenas N? 212, Barrio Sirari', '', 'Inmuebles', 'En licencia', '30/05/1990', '7169834 Tja', 'Santa Cruz', '78701222', '', '', NULL),
('Inspector', 'Mario Antonio Fern?ndez Sol?s;MFS', 'Calle Dar?o Monta?o E-0763', 'mariopkminoso@hotmail.com', 'Inmuebles', 'Activo', '12/09/1974', '3602116', 'Cochabamba', '70739956', '', '4796775', NULL),
('Inspector', 'Mauricio Flores Le?n;MFLE', 'Apurimak entre Chiriguanos y calle innominada', '', 'Inmuebles', 'Activo', '27/10/1979', '4036085 OR', 'Cochabamba', '70380317', '', '', NULL),
('Inspector', 'Naomi Paola Torrico Konno', 'NTK', 'Calle Adela Zamudio 1629', 'naomipaola@hotmail.com', 'Inmuebles', 'Activo', '06/12/1983', '1908142 Beni', 'Cochabamba', '70728289', '72739573', ''),
('Inspector', 'Nardy Carrillo Romero', 'NCR', 'Calle Gualberto Villarroel 316, Barrio Don Bosco', '', 'Inmuebles', 'En licencia', '26/11/1979', '4733100 SC', 'Santa Cruz', '76680180', '', '3355509'),
('Inspector', 'Percy Tapia Bengolea', 'PTB', '', '', 'Inmuebles', 'En licencia', '22/04/1978', '', 'La Paz', '72599437', '', '2787184'),
('Inspector', 'Raul Alejandro Zamora Tavera', 'RAZT', 'Calle Tatarenda N?1,Urbari', '', 'Maquinaria y vehiculos', 'En licencia', '23/10/1990', '5005273 Tja', 'Santa Cruz', '72112785', '', '3516112'),
('Inspector', 'Renor Linares Costano', 'RLC', '', '', 'Inmuebles', 'En licencia', '28/04/1984', '3449009 LP', 'La Paz', '70557907', '', '2470734'),
('Inspector', 'Rodrigo Alonso Velasco Antelo', 'RVA', 'Calle Girasoles #28', '', 'Veh?culos y maquinaria', 'Activo', '12/03/1978', '3773837', 'Santa Cruz', '72208216', '', ''),
('Inspector', 'Ronny Orlando MENDOZA Tosubeth', 'RMT', 'Barrio 12 de Octubre, Calle 7', 'ronnymendoza@gmail.com ', 'Inmuebles', 'Activo', '30/08/1977', '3930470', 'Santa Cruz', '73158668', '', '3422539'),
('Inspector', 'Rosa Nair Vargas Seas', 'NVS', 'Calle 4 N? 47, Urb. Palma Real, 6 anillo y santos dumont', '', 'Inmuebles', 'En licencia', '11/05/1989', '7769772', 'Santa Cruz', '70875367', '', '3204015'),
('Inspector', 'Ruben Espindola Miranda', 'RESM', 'Calle innominada, Barrio Jardin del Sur', '', 'Inmuebles', 'Activo', '30/06/1987', '8965585 SCZ', 'Santa Cruz', '73171789', '61331321', ''),
('Inspector', 'Sarah Fernanda Acha Araoz', 'SAA', 'Condominio Genesis 88', '', 'Avaluo inmuebles', 'En licencia', '24/07/1989', '5150609', 'Santa Cruz', '67785094', '', ''),
('Inspector', 'Sergio M?rida Espinoza', 'SME', 'Calle Acre 1334', 'S.meridae@gmail.com', 'Inmuebles', 'Activo', '05/02/1992', '5311147 Cbba', 'Cochabamba', '79707491', '', '4024500'),
('Inspector', 'Toty Gisela Severiche Mendoza', 'TSM', 'Avenida Moscu Barrio 6 de Agosto', '', 'Inmuebles', 'En licencia', '25/03/1978', '4730301 SC', 'Santa Cruz', '72603999', '', '3557197'),
('Inspector', 'Vanessa Wendy Valdivia Guevara', 'VVG', 'Zona Chimba, Calle Fort?n Vanguardia esq. Gambeti', '', 'Inmuebles', 'Activo', '31/01/1980', '4524887', 'Cochabamba', '7226106', '', '4445647'),
('Inspector', 'William Gustavo Garc?a Terrazas', 'WGT', 'Calle J. Ayarza N? 3000', 'gt.william@gmail.com', 'Inmuebles', 'En licencia', '16/06/1977', '4618599 SC', 'Santa Cruz', '73125324', '', '3466488'),
('Inspector', 'Erick Wolf', 'EWG', '', 'erickwolffg@gmail.com ', 'Inmuebles', 'En licencia', '', '', 'La Paz', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipodocumento`
--

CREATE TABLE `tipodocumento` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipodocumento`
--

INSERT INTO `tipodocumento` (`id`, `nombre`, `estado`) VALUES
(1, 'DOCUMENTOS', 1),
(2, 'FOLIO REAL', 1),
(3, 'PLANO', 1),
(4, 'IMPUESTOS', 1),
(5, 'RUAT', 1),
(6, 'POLIZA', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoinmueble`
--

CREATE TABLE `tipoinmueble` (
  `id_tipoinmueble` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `tipo` varchar(20) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipoinmueble`
--

INSERT INTO `tipoinmueble` (`id_tipoinmueble`, `nombre`, `tipo`, `estado`) VALUES
(1, 'Casa', 'INMUEBLE', 1),
(2, 'departamento', 'INMUEBLE', 1),
(3, 'AUTO', 'VEHICULO', 1),
(4, 'AGRICOLA', 'MAQUINARIA', 1),
(5, 'LINEA BLANCA', 'MERCADERIA', 1),
(6, 'COMESTIBLE PRERECEDERO', 'ESPECIAL', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `userlevelpermissions`
--

CREATE TABLE `userlevelpermissions` (
  `userlevelid` int(11) NOT NULL,
  `tablename` varchar(255) NOT NULL,
  `permission` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `userlevelpermissions`
--

INSERT INTO `userlevelpermissions` (`userlevelid`, `tablename`, `permission`) VALUES
(-2, '{30AA0C25-B486-48CC-AF92-47D039BF725C}asesor', 0),
(-2, '{30AA0C25-B486-48CC-AF92-47D039BF725C}audittrail', 0),
(-2, '{30AA0C25-B486-48CC-AF92-47D039BF725C}avaluo', 0),
(-2, '{30AA0C25-B486-48CC-AF92-47D039BF725C}avaluocore.php', 0),
(-2, '{30AA0C25-B486-48CC-AF92-47D039BF725C}banco', 0),
(-2, '{30AA0C25-B486-48CC-AF92-47D039BF725C}cliente', 0),
(-2, '{30AA0C25-B486-48CC-AF92-47D039BF725C}comentariosavaluo', 0),
(-2, '{30AA0C25-B486-48CC-AF92-47D039BF725C}corenotificacion.php', 0),
(-2, '{30AA0C25-B486-48CC-AF92-47D039BF725C}datossolicitud', 0),
(-2, '{30AA0C25-B486-48CC-AF92-47D039BF725C}departamento', 0),
(-2, '{30AA0C25-B486-48CC-AF92-47D039BF725C}documentosavaluo', 0),
(-2, '{30AA0C25-B486-48CC-AF92-47D039BF725C}estado', 0),
(-2, '{30AA0C25-B486-48CC-AF92-47D039BF725C}estadointerno', 0),
(-2, '{30AA0C25-B486-48CC-AF92-47D039BF725C}estadopago', 0),
(-2, '{30AA0C25-B486-48CC-AF92-47D039BF725C}inspector', 0),
(-2, '{30AA0C25-B486-48CC-AF92-47D039BF725C}metodopago', 0),
(-2, '{30AA0C25-B486-48CC-AF92-47D039BF725C}notificaciones', 0),
(-2, '{30AA0C25-B486-48CC-AF92-47D039BF725C}oficialcredito', 0),
(-2, '{30AA0C25-B486-48CC-AF92-47D039BF725C}provincia', 0),
(-2, '{30AA0C25-B486-48CC-AF92-47D039BF725C}reservacion.php', 0),
(-2, '{30AA0C25-B486-48CC-AF92-47D039BF725C}solicitud', 0),
(-2, '{30AA0C25-B486-48CC-AF92-47D039BF725C}solicitudcore.php', 0),
(-2, '{30AA0C25-B486-48CC-AF92-47D039BF725C}sucursal', 0),
(-2, '{30AA0C25-B486-48CC-AF92-47D039BF725C}supervisor', 0),
(-2, '{30AA0C25-B486-48CC-AF92-47D039BF725C}table 19', 0),
(-2, '{30AA0C25-B486-48CC-AF92-47D039BF725C}tipoinmueble', 0),
(-2, '{30AA0C25-B486-48CC-AF92-47D039BF725C}usuario', 0),
(0, '{30AA0C25-B486-48CC-AF92-47D039BF725C}asesor', 0),
(0, '{30AA0C25-B486-48CC-AF92-47D039BF725C}audittrail', 0),
(0, '{30AA0C25-B486-48CC-AF92-47D039BF725C}avaluo', 0),
(0, '{30AA0C25-B486-48CC-AF92-47D039BF725C}avaluocore.php', 0),
(0, '{30AA0C25-B486-48CC-AF92-47D039BF725C}banco', 0),
(0, '{30AA0C25-B486-48CC-AF92-47D039BF725C}cliente', 0),
(0, '{30AA0C25-B486-48CC-AF92-47D039BF725C}comentariosavaluo', 0),
(0, '{30AA0C25-B486-48CC-AF92-47D039BF725C}corenotificacion.php', 0),
(0, '{30AA0C25-B486-48CC-AF92-47D039BF725C}datossolicitud', 0),
(0, '{30AA0C25-B486-48CC-AF92-47D039BF725C}departamento', 0),
(0, '{30AA0C25-B486-48CC-AF92-47D039BF725C}documentosavaluo', 0),
(0, '{30AA0C25-B486-48CC-AF92-47D039BF725C}estado', 0),
(0, '{30AA0C25-B486-48CC-AF92-47D039BF725C}estadointerno', 0),
(0, '{30AA0C25-B486-48CC-AF92-47D039BF725C}estadopago', 0),
(0, '{30AA0C25-B486-48CC-AF92-47D039BF725C}inspector', 0),
(0, '{30AA0C25-B486-48CC-AF92-47D039BF725C}metodopago', 0),
(0, '{30AA0C25-B486-48CC-AF92-47D039BF725C}notificaciones', 0),
(0, '{30AA0C25-B486-48CC-AF92-47D039BF725C}oficialcredito', 0),
(0, '{30AA0C25-B486-48CC-AF92-47D039BF725C}provincia', 0),
(0, '{30AA0C25-B486-48CC-AF92-47D039BF725C}reservacion.php', 0),
(0, '{30AA0C25-B486-48CC-AF92-47D039BF725C}solicitud', 0),
(0, '{30AA0C25-B486-48CC-AF92-47D039BF725C}solicitudcore.php', 0),
(0, '{30AA0C25-B486-48CC-AF92-47D039BF725C}sucursal', 0),
(0, '{30AA0C25-B486-48CC-AF92-47D039BF725C}supervisor', 0),
(0, '{30AA0C25-B486-48CC-AF92-47D039BF725C}table 19', 0),
(0, '{30AA0C25-B486-48CC-AF92-47D039BF725C}tipoinmueble', 0),
(0, '{30AA0C25-B486-48CC-AF92-47D039BF725C}usuario', 0),
(1, '{30AA0C25-B486-48CC-AF92-47D039BF725C}areas', 0),
(1, '{30AA0C25-B486-48CC-AF92-47D039BF725C}asesor', 0),
(1, '{30AA0C25-B486-48CC-AF92-47D039BF725C}audittrail', 0),
(1, '{30AA0C25-B486-48CC-AF92-47D039BF725C}avaluo', 0),
(1, '{30AA0C25-B486-48CC-AF92-47D039BF725C}avaluocore.php', 0),
(1, '{30AA0C25-B486-48CC-AF92-47D039BF725C}banco', 0),
(1, '{30AA0C25-B486-48CC-AF92-47D039BF725C}calendario.php', 0),
(1, '{30AA0C25-B486-48CC-AF92-47D039BF725C}cliente', 0),
(1, '{30AA0C25-B486-48CC-AF92-47D039BF725C}comentariosavaluo', 0),
(1, '{30AA0C25-B486-48CC-AF92-47D039BF725C}companies', 0),
(1, '{30AA0C25-B486-48CC-AF92-47D039BF725C}configuracion', 0),
(1, '{30AA0C25-B486-48CC-AF92-47D039BF725C}core.php', 0),
(1, '{30AA0C25-B486-48CC-AF92-47D039BF725C}corenotificacion.php', 0),
(1, '{30AA0C25-B486-48CC-AF92-47D039BF725C}dashboardv1.php', 0),
(1, '{30AA0C25-B486-48CC-AF92-47D039BF725C}dashboardv2.php', 0),
(1, '{30AA0C25-B486-48CC-AF92-47D039BF725C}datossolicitud', 0),
(1, '{30AA0C25-B486-48CC-AF92-47D039BF725C}departamento', 0),
(1, '{30AA0C25-B486-48CC-AF92-47D039BF725C}documentosavaluo', 0),
(1, '{30AA0C25-B486-48CC-AF92-47D039BF725C}emailnotificaciones', 0),
(1, '{30AA0C25-B486-48CC-AF92-47D039BF725C}especial', 0),
(1, '{30AA0C25-B486-48CC-AF92-47D039BF725C}estado', 0),
(1, '{30AA0C25-B486-48CC-AF92-47D039BF725C}estadointerno', 0),
(1, '{30AA0C25-B486-48CC-AF92-47D039BF725C}estadopago', 0),
(1, '{30AA0C25-B486-48CC-AF92-47D039BF725C}estado_sms', 0),
(1, '{30AA0C25-B486-48CC-AF92-47D039BF725C}getApiRestWordPress.php', 0),
(1, '{30AA0C25-B486-48CC-AF92-47D039BF725C}historico', 0),
(1, '{30AA0C25-B486-48CC-AF92-47D039BF725C}historicoview.php', 0),
(1, '{30AA0C25-B486-48CC-AF92-47D039BF725C}inmueble', 0),
(1, '{30AA0C25-B486-48CC-AF92-47D039BF725C}inspector', 0),
(1, '{30AA0C25-B486-48CC-AF92-47D039BF725C}maquinaria', 0),
(1, '{30AA0C25-B486-48CC-AF92-47D039BF725C}mensaje', 0),
(1, '{30AA0C25-B486-48CC-AF92-47D039BF725C}mercaderia', 0),
(1, '{30AA0C25-B486-48CC-AF92-47D039BF725C}metodopago', 0),
(1, '{30AA0C25-B486-48CC-AF92-47D039BF725C}notificaciones', 0),
(1, '{30AA0C25-B486-48CC-AF92-47D039BF725C}offline_messages', 0),
(1, '{30AA0C25-B486-48CC-AF92-47D039BF725C}oficialcredito', 111),
(1, '{30AA0C25-B486-48CC-AF92-47D039BF725C}pago', 0),
(1, '{30AA0C25-B486-48CC-AF92-47D039BF725C}pago_avaluo', 0),
(1, '{30AA0C25-B486-48CC-AF92-47D039BF725C}provincia', 0),
(1, '{30AA0C25-B486-48CC-AF92-47D039BF725C}reservacion.php', 0),
(1, '{30AA0C25-B486-48CC-AF92-47D039BF725C}reservacionesviewsecretaria.php', 0),
(1, '{30AA0C25-B486-48CC-AF92-47D039BF725C}sms_data', 0),
(1, '{30AA0C25-B486-48CC-AF92-47D039BF725C}solicitud', 0),
(1, '{30AA0C25-B486-48CC-AF92-47D039BF725C}solicitudcore.php', 0),
(1, '{30AA0C25-B486-48CC-AF92-47D039BF725C}streets', 0),
(1, '{30AA0C25-B486-48CC-AF92-47D039BF725C}sucursal', 0),
(1, '{30AA0C25-B486-48CC-AF92-47D039BF725C}supervisor', 0),
(1, '{30AA0C25-B486-48CC-AF92-47D039BF725C}table 19', 0),
(1, '{30AA0C25-B486-48CC-AF92-47D039BF725C}tipodocumento', 0),
(1, '{30AA0C25-B486-48CC-AF92-47D039BF725C}tipoinmueble', 0),
(1, '{30AA0C25-B486-48CC-AF92-47D039BF725C}userlevelpermissions', 0),
(1, '{30AA0C25-B486-48CC-AF92-47D039BF725C}userlevels', 0),
(1, '{30AA0C25-B486-48CC-AF92-47D039BF725C}usuario', 0),
(1, '{30AA0C25-B486-48CC-AF92-47D039BF725C}vehiculo', 0),
(1, '{30AA0C25-B486-48CC-AF92-47D039BF725C}viewavaluo', 111),
(1, '{30AA0C25-B486-48CC-AF92-47D039BF725C}viewavaluoinspector', 0),
(1, '{30AA0C25-B486-48CC-AF92-47D039BF725C}viewavaluoinspectorhistorico', 0),
(1, '{30AA0C25-B486-48CC-AF92-47D039BF725C}viewavaluosc', 0),
(1, '{30AA0C25-B486-48CC-AF92-47D039BF725C}viewavaluosofprocesados', 111),
(1, '{30AA0C25-B486-48CC-AF92-47D039BF725C}viewavaluosupervisor', 0),
(1, '{30AA0C25-B486-48CC-AF92-47D039BF725C}viewavaluosupervisorhistorial', 0),
(1, '{30AA0C25-B486-48CC-AF92-47D039BF725C}viewdocumentoinspector', 0),
(1, '{30AA0C25-B486-48CC-AF92-47D039BF725C}viewdocumentooficialcredito', 111),
(1, '{30AA0C25-B486-48CC-AF92-47D039BF725C}viewdocumentosavaluoframe', 0),
(1, '{30AA0C25-B486-48CC-AF92-47D039BF725C}viewdocumentosavaluosc', 0),
(1, '{30AA0C25-B486-48CC-AF92-47D039BF725C}viewdocumentosupervisor', 0),
(1, '{30AA0C25-B486-48CC-AF92-47D039BF725C}viewpagoavaluos', 0),
(1, '{30AA0C25-B486-48CC-AF92-47D039BF725C}viewsolicitud', 111),
(1, '{30AA0C25-B486-48CC-AF92-47D039BF725C}viewsolicitudframe', 0),
(1, '{30AA0C25-B486-48CC-AF92-47D039BF725C}viewsolicitudinspector', 0),
(1, '{30AA0C25-B486-48CC-AF92-47D039BF725C}viewsolicitudsupervisor', 0),
(2, '{30AA0C25-B486-48CC-AF92-47D039BF725C}asesor', 108),
(2, '{30AA0C25-B486-48CC-AF92-47D039BF725C}audittrail', 0),
(2, '{30AA0C25-B486-48CC-AF92-47D039BF725C}avaluo', 108),
(2, '{30AA0C25-B486-48CC-AF92-47D039BF725C}avaluocore.php', 0),
(2, '{30AA0C25-B486-48CC-AF92-47D039BF725C}banco', 0),
(2, '{30AA0C25-B486-48CC-AF92-47D039BF725C}calendario.php', 0),
(2, '{30AA0C25-B486-48CC-AF92-47D039BF725C}cliente', 0),
(2, '{30AA0C25-B486-48CC-AF92-47D039BF725C}comentariosavaluo', 0),
(2, '{30AA0C25-B486-48CC-AF92-47D039BF725C}corenotificacion.php', 0),
(2, '{30AA0C25-B486-48CC-AF92-47D039BF725C}datossolicitud', 0),
(2, '{30AA0C25-B486-48CC-AF92-47D039BF725C}departamento', 0),
(2, '{30AA0C25-B486-48CC-AF92-47D039BF725C}documentosavaluo', 0),
(2, '{30AA0C25-B486-48CC-AF92-47D039BF725C}emailnotificaciones', 104),
(2, '{30AA0C25-B486-48CC-AF92-47D039BF725C}especial', 0),
(2, '{30AA0C25-B486-48CC-AF92-47D039BF725C}estado', 0),
(2, '{30AA0C25-B486-48CC-AF92-47D039BF725C}estadointerno', 0),
(2, '{30AA0C25-B486-48CC-AF92-47D039BF725C}estadopago', 0),
(2, '{30AA0C25-B486-48CC-AF92-47D039BF725C}inmueble', 0),
(2, '{30AA0C25-B486-48CC-AF92-47D039BF725C}inspector', 0),
(2, '{30AA0C25-B486-48CC-AF92-47D039BF725C}maquinaria', 0),
(2, '{30AA0C25-B486-48CC-AF92-47D039BF725C}mercaderia', 0),
(2, '{30AA0C25-B486-48CC-AF92-47D039BF725C}metodopago', 0),
(2, '{30AA0C25-B486-48CC-AF92-47D039BF725C}notificaciones', 104),
(2, '{30AA0C25-B486-48CC-AF92-47D039BF725C}oficialcredito', 0),
(2, '{30AA0C25-B486-48CC-AF92-47D039BF725C}provincia', 0),
(2, '{30AA0C25-B486-48CC-AF92-47D039BF725C}reservacion.php', 0),
(2, '{30AA0C25-B486-48CC-AF92-47D039BF725C}solicitud', 108),
(2, '{30AA0C25-B486-48CC-AF92-47D039BF725C}solicitudcore.php', 0),
(2, '{30AA0C25-B486-48CC-AF92-47D039BF725C}sucursal', 0),
(2, '{30AA0C25-B486-48CC-AF92-47D039BF725C}supervisor', 0),
(2, '{30AA0C25-B486-48CC-AF92-47D039BF725C}table 19', 0),
(2, '{30AA0C25-B486-48CC-AF92-47D039BF725C}tipoinmueble', 0),
(2, '{30AA0C25-B486-48CC-AF92-47D039BF725C}userlevelpermissions', 0),
(2, '{30AA0C25-B486-48CC-AF92-47D039BF725C}userlevels', 0),
(2, '{30AA0C25-B486-48CC-AF92-47D039BF725C}usuario', 0),
(2, '{30AA0C25-B486-48CC-AF92-47D039BF725C}vehiculo', 0),
(3, '{30AA0C25-B486-48CC-AF92-47D039BF725C}areas', 0),
(3, '{30AA0C25-B486-48CC-AF92-47D039BF725C}asesor', 111),
(3, '{30AA0C25-B486-48CC-AF92-47D039BF725C}audittrail', 111),
(3, '{30AA0C25-B486-48CC-AF92-47D039BF725C}avaluo', 111),
(3, '{30AA0C25-B486-48CC-AF92-47D039BF725C}avaluocore.php', 111),
(3, '{30AA0C25-B486-48CC-AF92-47D039BF725C}banco', 111),
(3, '{30AA0C25-B486-48CC-AF92-47D039BF725C}calendario.php', 111),
(3, '{30AA0C25-B486-48CC-AF92-47D039BF725C}cliente', 111),
(3, '{30AA0C25-B486-48CC-AF92-47D039BF725C}comentariosavaluo', 111),
(3, '{30AA0C25-B486-48CC-AF92-47D039BF725C}companies', 0),
(3, '{30AA0C25-B486-48CC-AF92-47D039BF725C}configuracion', 0),
(3, '{30AA0C25-B486-48CC-AF92-47D039BF725C}core.php', 111),
(3, '{30AA0C25-B486-48CC-AF92-47D039BF725C}corenotificacion.php', 111),
(3, '{30AA0C25-B486-48CC-AF92-47D039BF725C}dashboardv1.php', 111),
(3, '{30AA0C25-B486-48CC-AF92-47D039BF725C}dashboardv2.php', 0),
(3, '{30AA0C25-B486-48CC-AF92-47D039BF725C}datossolicitud', 111),
(3, '{30AA0C25-B486-48CC-AF92-47D039BF725C}departamento', 111),
(3, '{30AA0C25-B486-48CC-AF92-47D039BF725C}documentosavaluo', 111),
(3, '{30AA0C25-B486-48CC-AF92-47D039BF725C}emailnotificaciones', 0),
(3, '{30AA0C25-B486-48CC-AF92-47D039BF725C}especial', 0),
(3, '{30AA0C25-B486-48CC-AF92-47D039BF725C}estado', 111),
(3, '{30AA0C25-B486-48CC-AF92-47D039BF725C}estadointerno', 111),
(3, '{30AA0C25-B486-48CC-AF92-47D039BF725C}estadopago', 111),
(3, '{30AA0C25-B486-48CC-AF92-47D039BF725C}getApiRestWordPress.php', 0),
(3, '{30AA0C25-B486-48CC-AF92-47D039BF725C}historico', 111),
(3, '{30AA0C25-B486-48CC-AF92-47D039BF725C}historicoview.php', 111),
(3, '{30AA0C25-B486-48CC-AF92-47D039BF725C}inmueble', 0),
(3, '{30AA0C25-B486-48CC-AF92-47D039BF725C}inspector', 111),
(3, '{30AA0C25-B486-48CC-AF92-47D039BF725C}maquinaria', 0),
(3, '{30AA0C25-B486-48CC-AF92-47D039BF725C}mercaderia', 0),
(3, '{30AA0C25-B486-48CC-AF92-47D039BF725C}metodopago', 111),
(3, '{30AA0C25-B486-48CC-AF92-47D039BF725C}notificaciones', 0),
(3, '{30AA0C25-B486-48CC-AF92-47D039BF725C}offline_messages', 0),
(3, '{30AA0C25-B486-48CC-AF92-47D039BF725C}oficialcredito', 111),
(3, '{30AA0C25-B486-48CC-AF92-47D039BF725C}pago', 111),
(3, '{30AA0C25-B486-48CC-AF92-47D039BF725C}pago_avaluo', 111),
(3, '{30AA0C25-B486-48CC-AF92-47D039BF725C}provincia', 111),
(3, '{30AA0C25-B486-48CC-AF92-47D039BF725C}reservacion.php', 111),
(3, '{30AA0C25-B486-48CC-AF92-47D039BF725C}reservacionesviewsecretaria.php', 0),
(3, '{30AA0C25-B486-48CC-AF92-47D039BF725C}solicitud', 111),
(3, '{30AA0C25-B486-48CC-AF92-47D039BF725C}solicitudcore.php', 111),
(3, '{30AA0C25-B486-48CC-AF92-47D039BF725C}streets', 0),
(3, '{30AA0C25-B486-48CC-AF92-47D039BF725C}sucursal', 111),
(3, '{30AA0C25-B486-48CC-AF92-47D039BF725C}supervisor', 111),
(3, '{30AA0C25-B486-48CC-AF92-47D039BF725C}table 19', 0),
(3, '{30AA0C25-B486-48CC-AF92-47D039BF725C}tipodocumento', 0),
(3, '{30AA0C25-B486-48CC-AF92-47D039BF725C}tipoinmueble', 111),
(3, '{30AA0C25-B486-48CC-AF92-47D039BF725C}userlevelpermissions', 0),
(3, '{30AA0C25-B486-48CC-AF92-47D039BF725C}userlevels', 0),
(3, '{30AA0C25-B486-48CC-AF92-47D039BF725C}usuario', 0),
(3, '{30AA0C25-B486-48CC-AF92-47D039BF725C}vehiculo', 0),
(3, '{30AA0C25-B486-48CC-AF92-47D039BF725C}viewavaluo', 0),
(3, '{30AA0C25-B486-48CC-AF92-47D039BF725C}viewavaluoinspector', 0),
(3, '{30AA0C25-B486-48CC-AF92-47D039BF725C}viewavaluoinspectorhistorico', 0),
(3, '{30AA0C25-B486-48CC-AF92-47D039BF725C}viewavaluosc', 111),
(3, '{30AA0C25-B486-48CC-AF92-47D039BF725C}viewavaluosupervisor', 0),
(3, '{30AA0C25-B486-48CC-AF92-47D039BF725C}viewavaluosupervisorhistorial', 0),
(3, '{30AA0C25-B486-48CC-AF92-47D039BF725C}viewdocumentoinspector', 0),
(3, '{30AA0C25-B486-48CC-AF92-47D039BF725C}viewdocumentooficialcredito', 0),
(3, '{30AA0C25-B486-48CC-AF92-47D039BF725C}viewdocumentosavaluoframe', 111),
(3, '{30AA0C25-B486-48CC-AF92-47D039BF725C}viewdocumentosavaluosc', 111),
(3, '{30AA0C25-B486-48CC-AF92-47D039BF725C}viewdocumentosupervisor', 0),
(3, '{30AA0C25-B486-48CC-AF92-47D039BF725C}viewpagoavaluos', 111),
(3, '{30AA0C25-B486-48CC-AF92-47D039BF725C}viewsolicitud', 0),
(3, '{30AA0C25-B486-48CC-AF92-47D039BF725C}viewsolicitudframe', 111),
(3, '{30AA0C25-B486-48CC-AF92-47D039BF725C}viewsolicitudinspector', 0),
(3, '{30AA0C25-B486-48CC-AF92-47D039BF725C}viewsolicitudsupervisor', 0),
(4, '{30AA0C25-B486-48CC-AF92-47D039BF725C}areas', 0),
(4, '{30AA0C25-B486-48CC-AF92-47D039BF725C}asesor', 0),
(4, '{30AA0C25-B486-48CC-AF92-47D039BF725C}audittrail', 111),
(4, '{30AA0C25-B486-48CC-AF92-47D039BF725C}avaluo', 0),
(4, '{30AA0C25-B486-48CC-AF92-47D039BF725C}avaluocore.php', 111),
(4, '{30AA0C25-B486-48CC-AF92-47D039BF725C}banco', 111),
(4, '{30AA0C25-B486-48CC-AF92-47D039BF725C}calendario.php', 0),
(4, '{30AA0C25-B486-48CC-AF92-47D039BF725C}cliente', 111),
(4, '{30AA0C25-B486-48CC-AF92-47D039BF725C}comentariosavaluo', 111),
(4, '{30AA0C25-B486-48CC-AF92-47D039BF725C}companies', 0),
(4, '{30AA0C25-B486-48CC-AF92-47D039BF725C}configuracion', 0),
(4, '{30AA0C25-B486-48CC-AF92-47D039BF725C}core.php', 0),
(4, '{30AA0C25-B486-48CC-AF92-47D039BF725C}corenotificacion.php', 111),
(4, '{30AA0C25-B486-48CC-AF92-47D039BF725C}dashboardv1.php', 0),
(4, '{30AA0C25-B486-48CC-AF92-47D039BF725C}dashboardv2.php', 0),
(4, '{30AA0C25-B486-48CC-AF92-47D039BF725C}datossolicitud', 111),
(4, '{30AA0C25-B486-48CC-AF92-47D039BF725C}departamento', 111),
(4, '{30AA0C25-B486-48CC-AF92-47D039BF725C}documentosavaluo', 111),
(4, '{30AA0C25-B486-48CC-AF92-47D039BF725C}emailnotificaciones', 111),
(4, '{30AA0C25-B486-48CC-AF92-47D039BF725C}especial', 0),
(4, '{30AA0C25-B486-48CC-AF92-47D039BF725C}estado', 111),
(4, '{30AA0C25-B486-48CC-AF92-47D039BF725C}estadointerno', 111),
(4, '{30AA0C25-B486-48CC-AF92-47D039BF725C}estadopago', 111),
(4, '{30AA0C25-B486-48CC-AF92-47D039BF725C}estado_sms', 0),
(4, '{30AA0C25-B486-48CC-AF92-47D039BF725C}getApiRestWordPress.php', 0),
(4, '{30AA0C25-B486-48CC-AF92-47D039BF725C}historico', 111),
(4, '{30AA0C25-B486-48CC-AF92-47D039BF725C}historicoview.php', 0),
(4, '{30AA0C25-B486-48CC-AF92-47D039BF725C}inmueble', 0),
(4, '{30AA0C25-B486-48CC-AF92-47D039BF725C}inspector', 0),
(4, '{30AA0C25-B486-48CC-AF92-47D039BF725C}maquinaria', 0),
(4, '{30AA0C25-B486-48CC-AF92-47D039BF725C}mensaje', 0),
(4, '{30AA0C25-B486-48CC-AF92-47D039BF725C}mercaderia', 0),
(4, '{30AA0C25-B486-48CC-AF92-47D039BF725C}metodopago', 111),
(4, '{30AA0C25-B486-48CC-AF92-47D039BF725C}notificaciones', 111),
(4, '{30AA0C25-B486-48CC-AF92-47D039BF725C}offline_messages', 0),
(4, '{30AA0C25-B486-48CC-AF92-47D039BF725C}oficialcredito', 0),
(4, '{30AA0C25-B486-48CC-AF92-47D039BF725C}pago', 111),
(4, '{30AA0C25-B486-48CC-AF92-47D039BF725C}pago_avaluo', 111),
(4, '{30AA0C25-B486-48CC-AF92-47D039BF725C}provincia', 111),
(4, '{30AA0C25-B486-48CC-AF92-47D039BF725C}reservacion.php', 111),
(4, '{30AA0C25-B486-48CC-AF92-47D039BF725C}reservacionesviewsecretaria.php', 0),
(4, '{30AA0C25-B486-48CC-AF92-47D039BF725C}sms_data', 0),
(4, '{30AA0C25-B486-48CC-AF92-47D039BF725C}solicitud', 0),
(4, '{30AA0C25-B486-48CC-AF92-47D039BF725C}solicitudcore.php', 111),
(4, '{30AA0C25-B486-48CC-AF92-47D039BF725C}streets', 0),
(4, '{30AA0C25-B486-48CC-AF92-47D039BF725C}sucursal', 111),
(4, '{30AA0C25-B486-48CC-AF92-47D039BF725C}supervisor', 111),
(4, '{30AA0C25-B486-48CC-AF92-47D039BF725C}table 19', 0),
(4, '{30AA0C25-B486-48CC-AF92-47D039BF725C}tipodocumento', 0),
(4, '{30AA0C25-B486-48CC-AF92-47D039BF725C}tipoinmueble', 111),
(4, '{30AA0C25-B486-48CC-AF92-47D039BF725C}userlevelpermissions', 111),
(4, '{30AA0C25-B486-48CC-AF92-47D039BF725C}userlevels', 0),
(4, '{30AA0C25-B486-48CC-AF92-47D039BF725C}usuario', 111),
(4, '{30AA0C25-B486-48CC-AF92-47D039BF725C}vehiculo', 0),
(4, '{30AA0C25-B486-48CC-AF92-47D039BF725C}viewavaluo', 0),
(4, '{30AA0C25-B486-48CC-AF92-47D039BF725C}viewavaluoinspector', 0),
(4, '{30AA0C25-B486-48CC-AF92-47D039BF725C}viewavaluoinspectorhistorico', 0),
(4, '{30AA0C25-B486-48CC-AF92-47D039BF725C}viewavaluosc', 0),
(4, '{30AA0C25-B486-48CC-AF92-47D039BF725C}viewavaluosofprocesados', 0),
(4, '{30AA0C25-B486-48CC-AF92-47D039BF725C}viewavaluosupervisor', 111),
(4, '{30AA0C25-B486-48CC-AF92-47D039BF725C}viewavaluosupervisorhistorial', 111),
(4, '{30AA0C25-B486-48CC-AF92-47D039BF725C}viewdocumentoinspector', 0),
(4, '{30AA0C25-B486-48CC-AF92-47D039BF725C}viewdocumentooficialcredito', 0),
(4, '{30AA0C25-B486-48CC-AF92-47D039BF725C}viewdocumentosavaluoframe', 111),
(4, '{30AA0C25-B486-48CC-AF92-47D039BF725C}viewdocumentosavaluosc', 0),
(4, '{30AA0C25-B486-48CC-AF92-47D039BF725C}viewdocumentosupervisor', 111),
(4, '{30AA0C25-B486-48CC-AF92-47D039BF725C}viewpagoavaluos', 111),
(4, '{30AA0C25-B486-48CC-AF92-47D039BF725C}viewsolicitud', 0),
(4, '{30AA0C25-B486-48CC-AF92-47D039BF725C}viewsolicitudframe', 0),
(4, '{30AA0C25-B486-48CC-AF92-47D039BF725C}viewsolicitudinspector', 0),
(4, '{30AA0C25-B486-48CC-AF92-47D039BF725C}viewsolicitudsupervisor', 111),
(5, '{30AA0C25-B486-48CC-AF92-47D039BF725C}areas', 0),
(5, '{30AA0C25-B486-48CC-AF92-47D039BF725C}asesor', 111),
(5, '{30AA0C25-B486-48CC-AF92-47D039BF725C}audittrail', 111),
(5, '{30AA0C25-B486-48CC-AF92-47D039BF725C}avaluo', 111),
(5, '{30AA0C25-B486-48CC-AF92-47D039BF725C}avaluocore.php', 111),
(5, '{30AA0C25-B486-48CC-AF92-47D039BF725C}banco', 111),
(5, '{30AA0C25-B486-48CC-AF92-47D039BF725C}calendario.php', 0),
(5, '{30AA0C25-B486-48CC-AF92-47D039BF725C}cliente', 111),
(5, '{30AA0C25-B486-48CC-AF92-47D039BF725C}comentariosavaluo', 111),
(5, '{30AA0C25-B486-48CC-AF92-47D039BF725C}companies', 0),
(5, '{30AA0C25-B486-48CC-AF92-47D039BF725C}configuracion', 0),
(5, '{30AA0C25-B486-48CC-AF92-47D039BF725C}core.php', 0),
(5, '{30AA0C25-B486-48CC-AF92-47D039BF725C}corenotificacion.php', 111),
(5, '{30AA0C25-B486-48CC-AF92-47D039BF725C}datossolicitud', 111),
(5, '{30AA0C25-B486-48CC-AF92-47D039BF725C}departamento', 111),
(5, '{30AA0C25-B486-48CC-AF92-47D039BF725C}documentosavaluo', 111),
(5, '{30AA0C25-B486-48CC-AF92-47D039BF725C}emailnotificaciones', 0),
(5, '{30AA0C25-B486-48CC-AF92-47D039BF725C}especial', 0),
(5, '{30AA0C25-B486-48CC-AF92-47D039BF725C}estado', 111),
(5, '{30AA0C25-B486-48CC-AF92-47D039BF725C}estadointerno', 111),
(5, '{30AA0C25-B486-48CC-AF92-47D039BF725C}estadopago', 111),
(5, '{30AA0C25-B486-48CC-AF92-47D039BF725C}getApiRestWordPress.php', 111),
(5, '{30AA0C25-B486-48CC-AF92-47D039BF725C}inmueble', 0),
(5, '{30AA0C25-B486-48CC-AF92-47D039BF725C}inspector', 111),
(5, '{30AA0C25-B486-48CC-AF92-47D039BF725C}maquinaria', 0),
(5, '{30AA0C25-B486-48CC-AF92-47D039BF725C}mercaderia', 0),
(5, '{30AA0C25-B486-48CC-AF92-47D039BF725C}metodopago', 111),
(5, '{30AA0C25-B486-48CC-AF92-47D039BF725C}notificaciones', 111),
(5, '{30AA0C25-B486-48CC-AF92-47D039BF725C}offline_messages', 0),
(5, '{30AA0C25-B486-48CC-AF92-47D039BF725C}oficialcredito', 111),
(5, '{30AA0C25-B486-48CC-AF92-47D039BF725C}pago', 111),
(5, '{30AA0C25-B486-48CC-AF92-47D039BF725C}pago_avaluo', 111),
(5, '{30AA0C25-B486-48CC-AF92-47D039BF725C}provincia', 111),
(5, '{30AA0C25-B486-48CC-AF92-47D039BF725C}reservacion.php', 111),
(5, '{30AA0C25-B486-48CC-AF92-47D039BF725C}solicitud', 111),
(5, '{30AA0C25-B486-48CC-AF92-47D039BF725C}solicitudcore.php', 111),
(5, '{30AA0C25-B486-48CC-AF92-47D039BF725C}streets', 0),
(5, '{30AA0C25-B486-48CC-AF92-47D039BF725C}sucursal', 111),
(5, '{30AA0C25-B486-48CC-AF92-47D039BF725C}supervisor', 111),
(5, '{30AA0C25-B486-48CC-AF92-47D039BF725C}table 19', 111),
(5, '{30AA0C25-B486-48CC-AF92-47D039BF725C}tipodocumento', 0),
(5, '{30AA0C25-B486-48CC-AF92-47D039BF725C}tipoinmueble', 111),
(5, '{30AA0C25-B486-48CC-AF92-47D039BF725C}userlevelpermissions', 0),
(5, '{30AA0C25-B486-48CC-AF92-47D039BF725C}userlevels', 0),
(5, '{30AA0C25-B486-48CC-AF92-47D039BF725C}usuario', 111),
(5, '{30AA0C25-B486-48CC-AF92-47D039BF725C}vehiculo', 0),
(5, '{30AA0C25-B486-48CC-AF92-47D039BF725C}viewavaluo', 0),
(5, '{30AA0C25-B486-48CC-AF92-47D039BF725C}viewavaluoinspector', 0),
(5, '{30AA0C25-B486-48CC-AF92-47D039BF725C}viewavaluosc', 0),
(5, '{30AA0C25-B486-48CC-AF92-47D039BF725C}viewavaluosupervisor', 111),
(5, '{30AA0C25-B486-48CC-AF92-47D039BF725C}viewdocumentoinspector', 0),
(5, '{30AA0C25-B486-48CC-AF92-47D039BF725C}viewdocumentosavaluosc', 0),
(5, '{30AA0C25-B486-48CC-AF92-47D039BF725C}viewdocumentosupervisor', 111),
(5, '{30AA0C25-B486-48CC-AF92-47D039BF725C}viewsolicitud', 0),
(5, '{30AA0C25-B486-48CC-AF92-47D039BF725C}viewsolicitudinspector', 0),
(5, '{30AA0C25-B486-48CC-AF92-47D039BF725C}viewsolicitudsupervisor', 111),
(6, '{30AA0C25-B486-48CC-AF92-47D039BF725C}areas', 0),
(6, '{30AA0C25-B486-48CC-AF92-47D039BF725C}asesor', 0),
(6, '{30AA0C25-B486-48CC-AF92-47D039BF725C}audittrail', 0),
(6, '{30AA0C25-B486-48CC-AF92-47D039BF725C}avaluo', 0),
(6, '{30AA0C25-B486-48CC-AF92-47D039BF725C}avaluocore.php', 111),
(6, '{30AA0C25-B486-48CC-AF92-47D039BF725C}banco', 0),
(6, '{30AA0C25-B486-48CC-AF92-47D039BF725C}calendario.php', 111),
(6, '{30AA0C25-B486-48CC-AF92-47D039BF725C}cliente', 0),
(6, '{30AA0C25-B486-48CC-AF92-47D039BF725C}comentariosavaluo', 0),
(6, '{30AA0C25-B486-48CC-AF92-47D039BF725C}companies', 0),
(6, '{30AA0C25-B486-48CC-AF92-47D039BF725C}configuracion', 0),
(6, '{30AA0C25-B486-48CC-AF92-47D039BF725C}core.php', 111),
(6, '{30AA0C25-B486-48CC-AF92-47D039BF725C}corenotificacion.php', 0),
(6, '{30AA0C25-B486-48CC-AF92-47D039BF725C}dashboardv1.php', 111),
(6, '{30AA0C25-B486-48CC-AF92-47D039BF725C}dashboardv2.php', 0),
(6, '{30AA0C25-B486-48CC-AF92-47D039BF725C}datossolicitud', 0),
(6, '{30AA0C25-B486-48CC-AF92-47D039BF725C}departamento', 0),
(6, '{30AA0C25-B486-48CC-AF92-47D039BF725C}documentosavaluo', 0),
(6, '{30AA0C25-B486-48CC-AF92-47D039BF725C}emailnotificaciones', 111),
(6, '{30AA0C25-B486-48CC-AF92-47D039BF725C}especial', 0),
(6, '{30AA0C25-B486-48CC-AF92-47D039BF725C}estado', 0),
(6, '{30AA0C25-B486-48CC-AF92-47D039BF725C}estadointerno', 0),
(6, '{30AA0C25-B486-48CC-AF92-47D039BF725C}estadopago', 0),
(6, '{30AA0C25-B486-48CC-AF92-47D039BF725C}estado_sms', 0),
(6, '{30AA0C25-B486-48CC-AF92-47D039BF725C}getApiRestWordPress.php', 0),
(6, '{30AA0C25-B486-48CC-AF92-47D039BF725C}historico', 111),
(6, '{30AA0C25-B486-48CC-AF92-47D039BF725C}historicoview.php', 0),
(6, '{30AA0C25-B486-48CC-AF92-47D039BF725C}inmueble', 0),
(6, '{30AA0C25-B486-48CC-AF92-47D039BF725C}inspector', 111),
(6, '{30AA0C25-B486-48CC-AF92-47D039BF725C}maquinaria', 0),
(6, '{30AA0C25-B486-48CC-AF92-47D039BF725C}mensaje', 0),
(6, '{30AA0C25-B486-48CC-AF92-47D039BF725C}mercaderia', 0),
(6, '{30AA0C25-B486-48CC-AF92-47D039BF725C}metodopago', 0),
(6, '{30AA0C25-B486-48CC-AF92-47D039BF725C}notificaciones', 0),
(6, '{30AA0C25-B486-48CC-AF92-47D039BF725C}offline_messages', 0),
(6, '{30AA0C25-B486-48CC-AF92-47D039BF725C}oficialcredito', 0),
(6, '{30AA0C25-B486-48CC-AF92-47D039BF725C}pago', 0),
(6, '{30AA0C25-B486-48CC-AF92-47D039BF725C}pago_avaluo', 111),
(6, '{30AA0C25-B486-48CC-AF92-47D039BF725C}provincia', 0),
(6, '{30AA0C25-B486-48CC-AF92-47D039BF725C}reservacion.php', 0),
(6, '{30AA0C25-B486-48CC-AF92-47D039BF725C}reservacionesviewsecretaria.php', 0),
(6, '{30AA0C25-B486-48CC-AF92-47D039BF725C}sms_data', 0),
(6, '{30AA0C25-B486-48CC-AF92-47D039BF725C}solicitud', 0),
(6, '{30AA0C25-B486-48CC-AF92-47D039BF725C}solicitudcore.php', 0),
(6, '{30AA0C25-B486-48CC-AF92-47D039BF725C}streets', 0),
(6, '{30AA0C25-B486-48CC-AF92-47D039BF725C}sucursal', 0),
(6, '{30AA0C25-B486-48CC-AF92-47D039BF725C}supervisor', 0),
(6, '{30AA0C25-B486-48CC-AF92-47D039BF725C}table 19', 0),
(6, '{30AA0C25-B486-48CC-AF92-47D039BF725C}tipodocumento', 0),
(6, '{30AA0C25-B486-48CC-AF92-47D039BF725C}tipoinmueble', 0),
(6, '{30AA0C25-B486-48CC-AF92-47D039BF725C}userlevelpermissions', 0),
(6, '{30AA0C25-B486-48CC-AF92-47D039BF725C}userlevels', 0),
(6, '{30AA0C25-B486-48CC-AF92-47D039BF725C}usuario', 0),
(6, '{30AA0C25-B486-48CC-AF92-47D039BF725C}vehiculo', 0),
(6, '{30AA0C25-B486-48CC-AF92-47D039BF725C}viewavaluo', 0),
(6, '{30AA0C25-B486-48CC-AF92-47D039BF725C}viewavaluoinspector', 111),
(6, '{30AA0C25-B486-48CC-AF92-47D039BF725C}viewavaluoinspectorhistorico', 111),
(6, '{30AA0C25-B486-48CC-AF92-47D039BF725C}viewavaluosc', 0),
(6, '{30AA0C25-B486-48CC-AF92-47D039BF725C}viewavaluosofprocesados', 0),
(6, '{30AA0C25-B486-48CC-AF92-47D039BF725C}viewavaluosupervisor', 0),
(6, '{30AA0C25-B486-48CC-AF92-47D039BF725C}viewavaluosupervisorhistorial', 0),
(6, '{30AA0C25-B486-48CC-AF92-47D039BF725C}viewdocumentoinspector', 111),
(6, '{30AA0C25-B486-48CC-AF92-47D039BF725C}viewdocumentooficialcredito', 0),
(6, '{30AA0C25-B486-48CC-AF92-47D039BF725C}viewdocumentosavaluoframe', 111),
(6, '{30AA0C25-B486-48CC-AF92-47D039BF725C}viewdocumentosavaluosc', 0),
(6, '{30AA0C25-B486-48CC-AF92-47D039BF725C}viewdocumentosupervisor', 0),
(6, '{30AA0C25-B486-48CC-AF92-47D039BF725C}viewpagoavaluos', 111),
(6, '{30AA0C25-B486-48CC-AF92-47D039BF725C}viewsolicitud', 0),
(6, '{30AA0C25-B486-48CC-AF92-47D039BF725C}viewsolicitudframe', 111),
(6, '{30AA0C25-B486-48CC-AF92-47D039BF725C}viewsolicitudinspector', 111),
(6, '{30AA0C25-B486-48CC-AF92-47D039BF725C}viewsolicitudsupervisor', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `userlevels`
--

CREATE TABLE `userlevels` (
  `userlevelid` int(11) NOT NULL,
  `userlevelname` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `userlevels`
--

INSERT INTO `userlevels` (`userlevelid`, `userlevelname`) VALUES
(-2, 'Anonymous'),
(-1, 'Administrator'),
(0, 'Default'),
(1, 'oficialcredito'),
(2, 'asesor'),
(3, 'secreatria'),
(4, 'supervisor'),
(5, 'gerencia'),
(6, 'inspector');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `login` varchar(100) NOT NULL,
  `password` varchar(20) NOT NULL,
  `ci` varchar(20) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `id_sucursal` int(11) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `telefono_fijo01` varchar(100) DEFAULT NULL,
  `telefono_fijo02` varchar(100) DEFAULT NULL,
  `celular` varchar(100) DEFAULT NULL,
  `celular2` varchar(100) DEFAULT NULL,
  `direccion` text NOT NULL,
  `cargo` varchar(100) DEFAULT NULL,
  `id_institucion` int(11) DEFAULT NULL,
  `especialidad` varchar(100) DEFAULT NULL,
  `avatar` blob,
  `color` varchar(20) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `codigo` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`nombre`, `apellido`, `login`, `password`, `ci`, `id_rol`, `id_sucursal`, `email`, `telefono_fijo01`, `telefono_fijo02`, `celular`, `celular2`, `direccion`, `cargo`, `id_institucion`, `especialidad`, `avatar`, `color`, `status`, `created_at`, `codigo`) VALUES
('mauricio', 'oficialcredito', 'amy.winehouse.Testeprep@gmail.com', 'Password1!', '3245345', 1, 3, '', '', '', '', '', '', '', 0, 'supervisor', NULL, '#60b611', 1, '2019-07-27 23:17:12', NULL),
('carlos claros', 'oficialcredito', 'carlos.gerd.claros.orellana@gmx.es', 'Password1!', '3245345', 1, 3, '', '', '', '', '', '', '', 0, 'oficialcredito', NULL, '#60b611', 1, '2019-07-27 23:17:12', NULL),
('Elda', 'Maraz Villalba', 'emaraz@invercon-sgv.com', 'Password1!', '3245345', 3, 3, '', '', '', '', '', '', '', 0, 'Secretaria', NULL, '#60b611', 1, '2019-07-27 23:17:12', NULL),
('carlos', 'oficialcredito', 'eprep.test01@yahoo.com', 'Password1!', '3245345', 1, 3, '', '', '', '', '', '', '', 0, 'Secretaria', NULL, '#60b611', 1, '2019-07-27 23:17:12', NULL),
('martin', 'oficialcredito', 'eprep.test05@yahoo.com', 'Password1!', '3245345', 1, 3, NULL, NULL, '353453', '534534534', NULL, 'SGFGDFGDF', '', 1, 'Secretaria', NULL, '#60b611', 1, '2019-08-14 01:24:50', NULL),
('Franco', 'Claros', 'fclaros@invercon-sgv.com', 'Password1!', '3245345', 4, 3, '', '', '', '', '', '', '', 0, 'supervisor', NULL, '#60b611', 1, '2019-07-27 23:17:12', NULL),
('mauricio', 'Asesor', 'hulk.hogan535@gmail.com', 'Password1!', '3245345', 2, 3, '', '', '', '', '', '', '', 0, 'Asesor', NULL, '#60b611', 1, '2019-07-27 23:17:12', NULL),
('Julio Cesar\r\n', 'Larrazabal Mansilla', 'jlarrazabal@invercon-sgv.com', 'Password1!', '3245345', 6, 3, '', '', '', '', '', '', '', 0, 'Inspector', NULL, '#1ed3d2', 1, '2019-07-27 23:17:12', NULL),
('mauricio', 'oficialcredito', 'Luke.Skywalker.Force01@gmail.com', 'Password1!', '3245345', 1, 3, '', '', '', '', '', '', '', 0, 'Inspector', NULL, '#60b611', 1, '2019-07-27 23:17:12', NULL),
('Maria Fernanda', 'Oros Suarez', 'moros@invercon-sgv.com', 'Password1!', '3245345', 3, 3, '', '', '', '', '', '', '', 0, 'Secretaria', NULL, '#60b611', 1, '2019-07-27 23:17:12', NULL),
('Mabel Rivera Silva\r\n\r\n', 'Rivera Silva', 'mrivera@invercon-sgv.com', 'Password1!', '3245345', 6, 3, '', '', '', '', '', '', '', 0, 'Inspector', NULL, '#75d31e', 1, '2019-07-27 23:17:12', NULL),
('Ruben', 'Espindola Miranda', 'respindola@invercon-sgv.com', 'Password1!', '3245345', 6, 3, '', '', '', '', '', '', '', 0, 'Inspector', NULL, '#60b611', 1, '2019-07-27 23:17:12', NULL),
('juanes', 'oficialcredito', 'richard.gecko01test@gmail.com', 'Password1!', '3245345', 1, 3, '', '', '', '', '', '', '', 0, 'Inspector', NULL, '#60b611', 1, '2019-07-27 23:17:12', NULL),
('mauricio', 'oficialcredito', 'richard.gecko01test@yahoo.com', 'Password1!', '3245345', 1, 3, '', '', '', '', '', '', '', 0, 'gerencia', NULL, '#60b611', 1, '2019-07-27 23:17:12', NULL),
('Ronny Orlando\r\n\r\n', ' MENDOZA Tosubeth', 'rmendoza@invercon-sgv.com', 'Password1!', '3245345', 6, 3, '', '', '', '', '', '', '', 0, 'Inspector', NULL, '#d31e4a', 1, '2019-07-27 23:17:12', NULL),
('Rodrigo Alonso\r\n\r\n', ' Velasco Antelo', 'rvelasco@invercon-sgv.com', 'Password1!', '3245345', 6, 3, '', '', '', '', '', '', '', 0, 'Inspector', NULL, '#211ed3', 1, '2019-07-27 23:17:12', NULL);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vehiculo`
--
CREATE TABLE `vehiculo` (
`id` int(11)
,`name` varchar(50)
,`email` varchar(255)
,`lastname` varchar(50)
,`address` varchar(255)
,`phone` varchar(255)
,`cell` varchar(255)
,`id_sucursal` int(11)
,`tipovehiculo` varchar(255)
,`id_ciudad_vehiculo` int(11)
,`id_provincia_vehiculo` int(11)
,`imagen_vehiculo01` blob
,`imagen_vehiculo02` blob
,`imagen_vehiculo03` blob
,`longitud` double
,`latitud` double
,`nombre_contacto` varchar(200)
,`email_contacto` varchar(50)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `viewavaluo`
--
CREATE TABLE `viewavaluo` (
`id` int(11)
,`tipoinmueble` varchar(255)
,`codigoavaluo` varchar(50)
,`id_solicitud` int(11)
,`id_oficialcredito` varchar(100)
,`id_inspector` varchar(100)
,`id_cliente` int(11)
,`is_active` tinyint(1)
,`estado` tinyint(1)
,`estadointerno` int(15)
,`estadopago` int(11)
,`fecha_avaluo` datetime
,`montoincial` double
,`id_metodopago` int(11)
,`created_at` datetime
,`DateModified` datetime
,`DateDeleted` datetime
,`CreatedBy` varchar(100)
,`ModifiedBy` varchar(100)
,`DeletedBy` varchar(100)
,`id_sucursal` int(11)
,`informe` blob
,`comentario` text
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `viewavaluoinspector`
--
CREATE TABLE `viewavaluoinspector` (
`id` int(11)
,`tipoinmueble` varchar(255)
,`codigoavaluo` varchar(50)
,`id_solicitud` int(11)
,`id_oficialcredito` varchar(100)
,`id_inspector` varchar(100)
,`id_cliente` int(11)
,`is_active` tinyint(1)
,`estado` tinyint(1)
,`estadointerno` int(15)
,`estadopago` int(11)
,`fecha_avaluo` datetime
,`montoincial` double
,`id_metodopago` int(11)
,`created_at` datetime
,`DateModified` datetime
,`DateDeleted` datetime
,`CreatedBy` varchar(100)
,`ModifiedBy` varchar(100)
,`DeletedBy` varchar(100)
,`comentario` text
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `viewavaluoinspectorhistorico`
--
CREATE TABLE `viewavaluoinspectorhistorico` (
`id` int(11)
,`tipoinmueble` varchar(255)
,`codigoavaluo` varchar(50)
,`id_solicitud` int(11)
,`id_oficialcredito` varchar(100)
,`id_inspector` varchar(100)
,`id_cliente` int(11)
,`is_active` tinyint(1)
,`estado` tinyint(1)
,`estadointerno` int(15)
,`estadopago` int(11)
,`fecha_avaluo` datetime
,`montoincial` double
,`id_metodopago` int(11)
,`created_at` datetime
,`DateModified` datetime
,`DateDeleted` datetime
,`CreatedBy` varchar(100)
,`ModifiedBy` varchar(100)
,`DeletedBy` varchar(100)
,`comentario` text
,`id_sucursal` int(11)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `viewavaluosc`
--
CREATE TABLE `viewavaluosc` (
`id` int(11)
,`tipoinmueble` varchar(255)
,`codigoavaluo` varchar(50)
,`id_solicitud` int(11)
,`id_oficialcredito` varchar(100)
,`id_inspector` varchar(100)
,`id_cliente` int(11)
,`is_active` tinyint(1)
,`estado` tinyint(1)
,`estadointerno` int(15)
,`estadopago` int(11)
,`fecha_avaluo` datetime
,`montoincial` double
,`id_metodopago` int(11)
,`created_at` datetime
,`DateModified` datetime
,`DateDeleted` datetime
,`CreatedBy` varchar(100)
,`ModifiedBy` varchar(100)
,`DeletedBy` varchar(100)
,`monto_pago` double
,`comentario` text
,`documento_pago` blob
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `viewavaluosofprocesados`
--
CREATE TABLE `viewavaluosofprocesados` (
`id` int(11)
,`tipoinmueble` varchar(255)
,`codigoavaluo` varchar(50)
,`id_solicitud` int(11)
,`id_oficialcredito` varchar(100)
,`id_inspector` varchar(100)
,`id_cliente` int(11)
,`is_active` tinyint(1)
,`estado` tinyint(1)
,`estadointerno` int(15)
,`estadopago` int(11)
,`fecha_avaluo` datetime
,`montoincial` double
,`id_metodopago` int(11)
,`created_at` datetime
,`DateModified` datetime
,`DateDeleted` datetime
,`CreatedBy` varchar(100)
,`ModifiedBy` varchar(100)
,`DeletedBy` varchar(100)
,`id_sucursal` int(11)
,`informe` blob
,`comentario` text
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `viewavaluosupervisor`
--
CREATE TABLE `viewavaluosupervisor` (
`id` int(11)
,`tipoinmueble` varchar(255)
,`codigoavaluo` varchar(50)
,`id_solicitud` int(11)
,`id_oficialcredito` varchar(100)
,`id_inspector` varchar(100)
,`id_cliente` int(11)
,`is_active` tinyint(1)
,`estado` tinyint(1)
,`estadointerno` int(15)
,`estadopago` int(11)
,`fecha_avaluo` datetime
,`montoincial` double
,`id_metodopago` int(11)
,`created_at` datetime
,`DateModified` datetime
,`DateDeleted` datetime
,`CreatedBy` varchar(100)
,`ModifiedBy` varchar(100)
,`DeletedBy` varchar(100)
,`id_sucursal` int(11)
,`informe` blob
,`monto_pago` double
,`comentario` text
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `viewavaluosupervisorhistorial`
--
CREATE TABLE `viewavaluosupervisorhistorial` (
`id` int(11)
,`tipoinmueble` varchar(255)
,`codigoavaluo` varchar(50)
,`id_solicitud` int(11)
,`id_oficialcredito` varchar(100)
,`id_inspector` varchar(100)
,`id_cliente` int(11)
,`is_active` tinyint(1)
,`estado` tinyint(1)
,`estadointerno` int(15)
,`estadopago` int(11)
,`fecha_avaluo` datetime
,`montoincial` double
,`id_metodopago` int(11)
,`created_at` datetime
,`DateModified` datetime
,`DateDeleted` datetime
,`CreatedBy` varchar(100)
,`ModifiedBy` varchar(100)
,`DeletedBy` varchar(100)
,`id_sucursal` int(11)
,`informe` blob
,`monto_pago` double
,`comentario` text
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `viewdocumentoinspector`
--
CREATE TABLE `viewdocumentoinspector` (
`id` int(11)
,`descripcion` text
,`imagen` blob
,`avaluo` int(11)
,`path_drive` varchar(200)
,`id_tipodocumento` int(11)
,`created_at` datetime
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `viewdocumentooficialcredito`
--
CREATE TABLE `viewdocumentooficialcredito` (
`id` int(11)
,`descripcion` text
,`imagen` blob
,`avaluo` int(11)
,`path_drive` varchar(200)
,`id_tipodocumento` int(11)
,`created_at` datetime
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `viewdocumentosavaluoframe`
--
CREATE TABLE `viewdocumentosavaluoframe` (
`id` int(11)
,`descripcion` text
,`imagen` blob
,`avaluo` int(11)
,`path_drive` varchar(200)
,`id_tipodocumento` int(11)
,`created_at` datetime
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `viewdocumentosavaluosc`
--
CREATE TABLE `viewdocumentosavaluosc` (
`id` int(11)
,`descripcion` text
,`imagen` blob
,`avaluo` int(11)
,`path_drive` varchar(200)
,`id_tipodocumento` int(11)
,`created_at` datetime
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `viewdocumentosupervisor`
--
CREATE TABLE `viewdocumentosupervisor` (
`id` int(11)
,`descripcion` text
,`imagen` blob
,`avaluo` int(11)
,`path_drive` varchar(200)
,`id_tipodocumento` int(11)
,`created_at` datetime
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `viewpagoavaluos`
--
CREATE TABLE `viewpagoavaluos` (
`id` int(11)
,`pago_id` int(11)
,`avaluo_id` int(11)
,`q` int(11)
,`id_metodopago` int(11)
,`id_banco` int(11)
,`monto` double
,`documentopago` blob
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `viewsolicitud`
--
CREATE TABLE `viewsolicitud` (
`id` int(11)
,`name` varchar(50)
,`lastname` varchar(50)
,`email` varchar(255)
,`address` varchar(255)
,`nombre_contacto` varchar(200)
,`email_contacto` varchar(50)
,`latitud` double
,`longitud` double
,`phone` varchar(255)
,`cell` varchar(255)
,`id_sucursal` int(11)
,`tipoinmueble` varchar(255)
,`id_ciudad_inmueble` int(11)
,`id_provincia_inmueble` int(11)
,`imagen_inmueble01` blob
,`imagen_inmueble02` blob
,`imagen_inmueble03` blob
,`imagen_inmueble04` blob
,`imagen_inmueble05` blob
,`imagen_inmueble06` blob
,`imagen_inmueble07` blob
,`imagen_inmueble08` blob
,`tipovehiculo` varchar(255)
,`id_ciudad_vehiculo` int(11)
,`id_provincia_vehiculo` int(11)
,`imagen_vehiculo01` blob
,`imagen_vehiculo02` blob
,`imagen_vehiculo03` blob
,`imagen_vehiculo04` blob
,`imagen_vehiculo05` blob
,`imagen_vehiculo06` blob
,`imagen_vehiculo07` blob
,`imagen_vehiculo08` blob
,`tipomaquinaria` varchar(255)
,`id_ciudad_maquinaria` int(11)
,`id_provincia_maquinaria` int(11)
,`imagen_maquinaria01` blob
,`imagen_maquinaria02` blob
,`imagen_maquinaria03` blob
,`imagen_maquinaria04` blob
,`imagen_maquinaria05` blob
,`imagen_maquinaria06` blob
,`imagen_maquinaria07` blob
,`imagen_maquinaria08` blob
,`tipomercaderia` varchar(200)
,`imagen_mercaderia01` blob
,`documento_mercaderia` varchar(100)
,`tipoespecial` varchar(200)
,`imagen_tipoespecial01` blob
,`is_active` tinyint(1)
,`documentos` varchar(100)
,`created_at` datetime
,`DateModified` datetime
,`DateDeleted` datetime
,`CreatedBy` varchar(100)
,`ModifiedBy` varchar(100)
,`DeletedBy` varchar(100)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `viewsolicitudframe`
--
CREATE TABLE `viewsolicitudframe` (
`id` int(11)
,`name` varchar(50)
,`lastname` varchar(50)
,`email` varchar(255)
,`address` varchar(255)
,`nombre_contacto` varchar(200)
,`email_contacto` varchar(50)
,`latitud` double
,`longitud` double
,`phone` varchar(255)
,`cell` varchar(255)
,`id_sucursal` int(11)
,`tipoinmueble` varchar(255)
,`id_ciudad_inmueble` int(11)
,`id_provincia_inmueble` int(11)
,`imagen_inmueble01` blob
,`imagen_inmueble02` blob
,`imagen_inmueble03` blob
,`imagen_inmueble04` blob
,`imagen_inmueble05` blob
,`imagen_inmueble06` blob
,`imagen_inmueble07` blob
,`imagen_inmueble08` blob
,`tipovehiculo` varchar(255)
,`id_ciudad_vehiculo` int(11)
,`id_provincia_vehiculo` int(11)
,`imagen_vehiculo01` blob
,`imagen_vehiculo02` blob
,`imagen_vehiculo03` blob
,`imagen_vehiculo04` blob
,`imagen_vehiculo05` blob
,`imagen_vehiculo06` blob
,`imagen_vehiculo07` blob
,`imagen_vehiculo08` blob
,`tipomaquinaria` varchar(255)
,`id_ciudad_maquinaria` int(11)
,`id_provincia_maquinaria` int(11)
,`imagen_maquinaria01` blob
,`imagen_maquinaria02` blob
,`imagen_maquinaria03` blob
,`imagen_maquinaria04` blob
,`imagen_maquinaria05` blob
,`imagen_maquinaria06` blob
,`imagen_maquinaria07` blob
,`imagen_maquinaria08` blob
,`tipomercaderia` varchar(200)
,`imagen_mercaderia01` blob
,`documento_mercaderia` varchar(100)
,`tipoespecial` varchar(200)
,`imagen_tipoespecial01` blob
,`is_active` tinyint(1)
,`documentos` varchar(100)
,`created_at` datetime
,`DateModified` datetime
,`DateDeleted` datetime
,`CreatedBy` varchar(100)
,`ModifiedBy` varchar(100)
,`DeletedBy` varchar(100)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `viewsolicitudinspector`
--
CREATE TABLE `viewsolicitudinspector` (
`id` int(11)
,`name` varchar(50)
,`lastname` varchar(50)
,`email` varchar(255)
,`address` varchar(255)
,`nombre_contacto` varchar(200)
,`email_contacto` varchar(50)
,`latitud` double
,`longitud` double
,`phone` varchar(255)
,`cell` varchar(255)
,`id_sucursal` int(11)
,`tipoinmueble` varchar(255)
,`id_ciudad_inmueble` int(11)
,`id_provincia_inmueble` int(11)
,`imagen_inmueble01` blob
,`imagen_inmueble02` blob
,`imagen_inmueble03` blob
,`imagen_inmueble04` blob
,`imagen_inmueble05` blob
,`imagen_inmueble06` blob
,`imagen_inmueble07` blob
,`imagen_inmueble08` blob
,`tipovehiculo` varchar(255)
,`id_ciudad_vehiculo` int(11)
,`id_provincia_vehiculo` int(11)
,`imagen_vehiculo01` blob
,`imagen_vehiculo02` blob
,`imagen_vehiculo03` blob
,`imagen_vehiculo04` blob
,`imagen_vehiculo05` blob
,`imagen_vehiculo06` blob
,`imagen_vehiculo07` blob
,`imagen_vehiculo08` blob
,`tipomaquinaria` varchar(255)
,`id_ciudad_maquinaria` int(11)
,`id_provincia_maquinaria` int(11)
,`imagen_maquinaria01` blob
,`imagen_maquinaria02` blob
,`imagen_maquinaria03` blob
,`imagen_maquinaria04` blob
,`imagen_maquinaria05` blob
,`imagen_maquinaria06` blob
,`imagen_maquinaria07` blob
,`imagen_maquinaria08` blob
,`tipomercaderia` varchar(200)
,`imagen_mercaderia01` blob
,`documento_mercaderia` varchar(100)
,`tipoespecial` varchar(200)
,`imagen_tipoespecial01` blob
,`is_active` tinyint(1)
,`documentos` varchar(100)
,`created_at` datetime
,`DateModified` datetime
,`DateDeleted` datetime
,`CreatedBy` varchar(100)
,`ModifiedBy` varchar(100)
,`DeletedBy` varchar(100)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `viewsolicitudsupervisor`
--
CREATE TABLE `viewsolicitudsupervisor` (
`id` int(11)
,`name` varchar(50)
,`lastname` varchar(50)
,`email` varchar(255)
,`address` varchar(255)
,`nombre_contacto` varchar(200)
,`email_contacto` varchar(50)
,`latitud` double
,`longitud` double
,`phone` varchar(255)
,`cell` varchar(255)
,`id_sucursal` int(11)
,`tipoinmueble` varchar(255)
,`id_ciudad_inmueble` int(11)
,`id_provincia_inmueble` int(11)
,`imagen_inmueble01` blob
,`imagen_inmueble02` blob
,`imagen_inmueble03` blob
,`imagen_inmueble04` blob
,`imagen_inmueble05` blob
,`imagen_inmueble06` blob
,`imagen_inmueble07` blob
,`imagen_inmueble08` blob
,`tipovehiculo` varchar(255)
,`id_ciudad_vehiculo` int(11)
,`id_provincia_vehiculo` int(11)
,`imagen_vehiculo01` blob
,`imagen_vehiculo02` blob
,`imagen_vehiculo03` blob
,`imagen_vehiculo04` blob
,`imagen_vehiculo05` blob
,`imagen_vehiculo06` blob
,`imagen_vehiculo07` blob
,`imagen_vehiculo08` blob
,`tipomaquinaria` varchar(255)
,`id_ciudad_maquinaria` int(11)
,`id_provincia_maquinaria` int(11)
,`imagen_maquinaria01` blob
,`imagen_maquinaria02` blob
,`imagen_maquinaria03` blob
,`imagen_maquinaria04` blob
,`imagen_maquinaria05` blob
,`imagen_maquinaria06` blob
,`imagen_maquinaria07` blob
,`imagen_maquinaria08` blob
,`tipomercaderia` varchar(200)
,`imagen_mercaderia01` blob
,`documento_mercaderia` varchar(100)
,`tipoespecial` varchar(200)
,`imagen_tipoespecial01` blob
,`is_active` tinyint(1)
,`documentos` varchar(100)
,`created_at` datetime
,`DateModified` datetime
,`DateDeleted` datetime
,`CreatedBy` varchar(100)
,`ModifiedBy` varchar(100)
,`DeletedBy` varchar(100)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `asesor`
--
DROP TABLE IF EXISTS `asesor`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `asesor`  AS  select `usuario`.`nombre` AS `nombre`,`usuario`.`apellido` AS `apellido`,`usuario`.`login` AS `login`,`usuario`.`password` AS `password`,`usuario`.`ci` AS `ci`,`usuario`.`id_rol` AS `id_rol`,`usuario`.`id_sucursal` AS `id_sucursal`,`usuario`.`email` AS `email`,`usuario`.`telefono_fijo01` AS `telefono_fijo01`,`usuario`.`telefono_fijo02` AS `telefono_fijo02`,`usuario`.`celular` AS `celular`,`usuario`.`celular2` AS `celular2`,`usuario`.`direccion` AS `direccion`,`usuario`.`cargo` AS `cargo`,`usuario`.`id_institucion` AS `id_institucion`,`usuario`.`especialidad` AS `especialidad`,`usuario`.`status` AS `status`,`usuario`.`codigo` AS `codigo` from `usuario` where (`usuario`.`id_rol` = 2) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `especial`
--
DROP TABLE IF EXISTS `especial`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `especial`  AS  select `solicitud`.`name` AS `name`,`solicitud`.`id` AS `id`,`solicitud`.`lastname` AS `lastname`,`solicitud`.`email` AS `email`,`solicitud`.`address` AS `address`,`solicitud`.`phone` AS `phone`,`solicitud`.`cell` AS `cell`,`solicitud`.`id_sucursal` AS `id_sucursal`,`solicitud`.`tipoespecial` AS `tipoespecial`,`solicitud`.`imagen_tipoespecial01` AS `imagen_tipoespecial01`,`solicitud`.`documentos` AS `documentos`,`solicitud`.`longitud` AS `longitud`,`solicitud`.`latitud` AS `latitud`,`solicitud`.`tipoinmueble` AS `tipoinmueble`,`solicitud`.`nombre_contacto` AS `nombre_contacto`,`solicitud`.`email_contacto` AS `email_contacto` from `solicitud` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `inmueble`
--
DROP TABLE IF EXISTS `inmueble`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `inmueble`  AS  select `solicitud`.`lastname` AS `lastname`,`solicitud`.`email` AS `email`,`solicitud`.`address` AS `address`,`solicitud`.`phone` AS `phone`,`solicitud`.`cell` AS `cell`,`solicitud`.`tipoinmueble` AS `tipoinmueble`,`solicitud`.`id_ciudad_inmueble` AS `id_ciudad_inmueble`,`solicitud`.`id_provincia_inmueble` AS `id_provincia_inmueble`,`solicitud`.`imagen_inmueble01` AS `imagen_inmueble01`,`solicitud`.`imagen_inmueble02` AS `imagen_inmueble02`,`solicitud`.`imagen_inmueble03` AS `imagen_inmueble03`,`solicitud`.`name` AS `name`,`solicitud`.`id_sucursal` AS `id_sucursal`,`solicitud`.`longitud` AS `longitud`,`solicitud`.`latitud` AS `latitud`,`solicitud`.`created_at` AS `created_at`,`solicitud`.`id` AS `id`,`solicitud`.`nombre_contacto` AS `nombre_contacto`,`solicitud`.`email_contacto` AS `email_contacto` from `solicitud` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `inspector`
--
DROP TABLE IF EXISTS `inspector`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `inspector`  AS  select `usuario`.`nombre` AS `nombre`,`usuario`.`apellido` AS `apellido`,`usuario`.`login` AS `login`,`usuario`.`password` AS `password`,`usuario`.`ci` AS `ci`,`usuario`.`id_rol` AS `id_rol`,`usuario`.`id_sucursal` AS `id_sucursal`,`usuario`.`email` AS `email`,`usuario`.`telefono_fijo01` AS `telefono_fijo01`,`usuario`.`telefono_fijo02` AS `telefono_fijo02`,`usuario`.`celular` AS `celular`,`usuario`.`celular2` AS `celular2`,`usuario`.`direccion` AS `direccion`,`usuario`.`cargo` AS `cargo`,`usuario`.`id_institucion` AS `id_institucion`,`usuario`.`especialidad` AS `especialidad`,`usuario`.`status` AS `status`,`usuario`.`color` AS `color`,`usuario`.`avatar` AS `avatar`,`usuario`.`codigo` AS `codigo` from `usuario` where (`usuario`.`id_rol` = 6) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `maquinaria`
--
DROP TABLE IF EXISTS `maquinaria`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `maquinaria`  AS  select `solicitud`.`id` AS `id`,`solicitud`.`name` AS `name`,`solicitud`.`lastname` AS `lastname`,`solicitud`.`email` AS `email`,`solicitud`.`address` AS `address`,`solicitud`.`cell` AS `cell`,`solicitud`.`phone` AS `phone`,`solicitud`.`id_sucursal` AS `id_sucursal`,`solicitud`.`tipomaquinaria` AS `tipomaquinaria`,`solicitud`.`id_ciudad_maquinaria` AS `id_ciudad_maquinaria`,`solicitud`.`id_provincia_maquinaria` AS `id_provincia_maquinaria`,`solicitud`.`imagen_maquinaria01` AS `imagen_maquinaria01`,`solicitud`.`imagen_maquinaria02` AS `imagen_maquinaria02`,`solicitud`.`imagen_maquinaria03` AS `imagen_maquinaria03`,`solicitud`.`tipoinmueble` AS `tipoinmueble`,`solicitud`.`longitud` AS `longitud`,`solicitud`.`latitud` AS `latitud`,`solicitud`.`nombre_contacto` AS `nombre_contacto`,`solicitud`.`email_contacto` AS `email_contacto` from `solicitud` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `mercaderia`
--
DROP TABLE IF EXISTS `mercaderia`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `mercaderia`  AS  select `solicitud`.`id` AS `id`,`solicitud`.`name` AS `name`,`solicitud`.`lastname` AS `lastname`,`solicitud`.`email` AS `email`,`solicitud`.`address` AS `address`,`solicitud`.`phone` AS `phone`,`solicitud`.`cell` AS `cell`,`solicitud`.`id_sucursal` AS `id_sucursal`,`solicitud`.`tipomercaderia` AS `tipomercaderia`,`solicitud`.`imagen_mercaderia01` AS `imagen_mercaderia01`,`solicitud`.`documento_mercaderia` AS `documento_mercaderia`,`solicitud`.`longitud` AS `longitud`,`solicitud`.`latitud` AS `latitud`,`solicitud`.`tipoinmueble` AS `tipoinmueble`,`solicitud`.`nombre_contacto` AS `nombre_contacto`,`solicitud`.`email_contacto` AS `email_contacto` from `solicitud` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `oficialcredito`
--
DROP TABLE IF EXISTS `oficialcredito`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `oficialcredito`  AS  select `usuario`.`nombre` AS `nombre`,`usuario`.`apellido` AS `apellido`,`usuario`.`login` AS `login`,`usuario`.`password` AS `password`,`usuario`.`ci` AS `ci`,`usuario`.`id_rol` AS `id_rol`,`usuario`.`id_sucursal` AS `id_sucursal`,`usuario`.`email` AS `email`,`usuario`.`telefono_fijo01` AS `telefono_fijo01`,`usuario`.`telefono_fijo02` AS `telefono_fijo02`,`usuario`.`celular` AS `celular`,`usuario`.`celular2` AS `celular2`,`usuario`.`direccion` AS `direccion`,`usuario`.`cargo` AS `cargo`,`usuario`.`id_institucion` AS `id_institucion`,`usuario`.`especialidad` AS `especialidad`,`usuario`.`status` AS `status`,`usuario`.`avatar` AS `avatar`,`usuario`.`codigo` AS `codigo` from `usuario` where (`usuario`.`id_rol` = 1) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `supervisor`
--
DROP TABLE IF EXISTS `supervisor`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `supervisor`  AS  select `usuario`.`nombre` AS `nombre`,`usuario`.`apellido` AS `apellido`,`usuario`.`login` AS `login`,`usuario`.`password` AS `password`,`usuario`.`ci` AS `ci`,`usuario`.`id_rol` AS `id_rol`,`usuario`.`id_sucursal` AS `id_sucursal`,`usuario`.`email` AS `email`,`usuario`.`telefono_fijo01` AS `telefono_fijo01`,`usuario`.`telefono_fijo02` AS `telefono_fijo02`,`usuario`.`celular` AS `celular`,`usuario`.`celular2` AS `celular2`,`usuario`.`direccion` AS `direccion`,`usuario`.`cargo` AS `cargo`,`usuario`.`id_institucion` AS `id_institucion`,`usuario`.`especialidad` AS `especialidad`,`usuario`.`status` AS `status`,`usuario`.`avatar` AS `avatar`,`usuario`.`color` AS `color`,`usuario`.`codigo` AS `codigo` from `usuario` where (`usuario`.`id_rol` = 4) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vehiculo`
--
DROP TABLE IF EXISTS `vehiculo`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vehiculo`  AS  select `solicitud`.`id` AS `id`,`solicitud`.`name` AS `name`,`solicitud`.`email` AS `email`,`solicitud`.`lastname` AS `lastname`,`solicitud`.`address` AS `address`,`solicitud`.`phone` AS `phone`,`solicitud`.`cell` AS `cell`,`solicitud`.`id_sucursal` AS `id_sucursal`,`solicitud`.`tipovehiculo` AS `tipovehiculo`,`solicitud`.`id_ciudad_vehiculo` AS `id_ciudad_vehiculo`,`solicitud`.`id_provincia_vehiculo` AS `id_provincia_vehiculo`,`solicitud`.`imagen_vehiculo01` AS `imagen_vehiculo01`,`solicitud`.`imagen_vehiculo02` AS `imagen_vehiculo02`,`solicitud`.`imagen_vehiculo03` AS `imagen_vehiculo03`,`solicitud`.`longitud` AS `longitud`,`solicitud`.`latitud` AS `latitud`,`solicitud`.`nombre_contacto` AS `nombre_contacto`,`solicitud`.`email_contacto` AS `email_contacto` from `solicitud` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `viewavaluo`
--
DROP TABLE IF EXISTS `viewavaluo`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `viewavaluo`  AS  select `avaluo`.`id` AS `id`,`avaluo`.`tipoinmueble` AS `tipoinmueble`,`avaluo`.`codigoavaluo` AS `codigoavaluo`,`avaluo`.`id_solicitud` AS `id_solicitud`,`avaluo`.`id_oficialcredito` AS `id_oficialcredito`,`avaluo`.`id_inspector` AS `id_inspector`,`avaluo`.`id_cliente` AS `id_cliente`,`avaluo`.`is_active` AS `is_active`,`avaluo`.`estado` AS `estado`,`avaluo`.`estadointerno` AS `estadointerno`,`avaluo`.`estadopago` AS `estadopago`,`avaluo`.`fecha_avaluo` AS `fecha_avaluo`,`avaluo`.`montoincial` AS `montoincial`,`avaluo`.`id_metodopago` AS `id_metodopago`,`avaluo`.`created_at` AS `created_at`,`avaluo`.`DateModified` AS `DateModified`,`avaluo`.`DateDeleted` AS `DateDeleted`,`avaluo`.`CreatedBy` AS `CreatedBy`,`avaluo`.`ModifiedBy` AS `ModifiedBy`,`avaluo`.`DeletedBy` AS `DeletedBy`,`avaluo`.`id_sucursal` AS `id_sucursal`,`avaluo`.`informe` AS `informe`,`avaluo`.`comentario` AS `comentario` from `avaluo` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `viewavaluoinspector`
--
DROP TABLE IF EXISTS `viewavaluoinspector`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `viewavaluoinspector`  AS  select `avaluo`.`id` AS `id`,`avaluo`.`tipoinmueble` AS `tipoinmueble`,`avaluo`.`codigoavaluo` AS `codigoavaluo`,`avaluo`.`id_solicitud` AS `id_solicitud`,`avaluo`.`id_oficialcredito` AS `id_oficialcredito`,`avaluo`.`id_inspector` AS `id_inspector`,`avaluo`.`id_cliente` AS `id_cliente`,`avaluo`.`is_active` AS `is_active`,`avaluo`.`estado` AS `estado`,`avaluo`.`estadointerno` AS `estadointerno`,`avaluo`.`estadopago` AS `estadopago`,`avaluo`.`fecha_avaluo` AS `fecha_avaluo`,`avaluo`.`montoincial` AS `montoincial`,`avaluo`.`id_metodopago` AS `id_metodopago`,`avaluo`.`created_at` AS `created_at`,`avaluo`.`DateModified` AS `DateModified`,`avaluo`.`DateDeleted` AS `DateDeleted`,`avaluo`.`CreatedBy` AS `CreatedBy`,`avaluo`.`ModifiedBy` AS `ModifiedBy`,`avaluo`.`DeletedBy` AS `DeletedBy`,`avaluo`.`comentario` AS `comentario` from `avaluo` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `viewavaluoinspectorhistorico`
--
DROP TABLE IF EXISTS `viewavaluoinspectorhistorico`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `viewavaluoinspectorhistorico`  AS  select `avaluo`.`id` AS `id`,`avaluo`.`tipoinmueble` AS `tipoinmueble`,`avaluo`.`codigoavaluo` AS `codigoavaluo`,`avaluo`.`id_solicitud` AS `id_solicitud`,`avaluo`.`id_oficialcredito` AS `id_oficialcredito`,`avaluo`.`id_inspector` AS `id_inspector`,`avaluo`.`id_cliente` AS `id_cliente`,`avaluo`.`is_active` AS `is_active`,`avaluo`.`estado` AS `estado`,`avaluo`.`estadointerno` AS `estadointerno`,`avaluo`.`estadopago` AS `estadopago`,`avaluo`.`fecha_avaluo` AS `fecha_avaluo`,`avaluo`.`montoincial` AS `montoincial`,`avaluo`.`id_metodopago` AS `id_metodopago`,`avaluo`.`created_at` AS `created_at`,`avaluo`.`DateModified` AS `DateModified`,`avaluo`.`DateDeleted` AS `DateDeleted`,`avaluo`.`CreatedBy` AS `CreatedBy`,`avaluo`.`ModifiedBy` AS `ModifiedBy`,`avaluo`.`DeletedBy` AS `DeletedBy`,`avaluo`.`comentario` AS `comentario`,`avaluo`.`id_sucursal` AS `id_sucursal` from `avaluo` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `viewavaluosc`
--
DROP TABLE IF EXISTS `viewavaluosc`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `viewavaluosc`  AS  select `avaluo`.`id` AS `id`,`avaluo`.`tipoinmueble` AS `tipoinmueble`,`avaluo`.`codigoavaluo` AS `codigoavaluo`,`avaluo`.`id_solicitud` AS `id_solicitud`,`avaluo`.`id_oficialcredito` AS `id_oficialcredito`,`avaluo`.`id_inspector` AS `id_inspector`,`avaluo`.`id_cliente` AS `id_cliente`,`avaluo`.`is_active` AS `is_active`,`avaluo`.`estado` AS `estado`,`avaluo`.`estadointerno` AS `estadointerno`,`avaluo`.`estadopago` AS `estadopago`,`avaluo`.`fecha_avaluo` AS `fecha_avaluo`,`avaluo`.`montoincial` AS `montoincial`,`avaluo`.`id_metodopago` AS `id_metodopago`,`avaluo`.`created_at` AS `created_at`,`avaluo`.`DateModified` AS `DateModified`,`avaluo`.`DateDeleted` AS `DateDeleted`,`avaluo`.`CreatedBy` AS `CreatedBy`,`avaluo`.`ModifiedBy` AS `ModifiedBy`,`avaluo`.`DeletedBy` AS `DeletedBy`,`avaluo`.`monto_pago` AS `monto_pago`,`avaluo`.`comentario` AS `comentario`,`avaluo`.`documento_pago` AS `documento_pago` from `avaluo` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `viewavaluosofprocesados`
--
DROP TABLE IF EXISTS `viewavaluosofprocesados`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `viewavaluosofprocesados`  AS  select `avaluo`.`id` AS `id`,`avaluo`.`tipoinmueble` AS `tipoinmueble`,`avaluo`.`codigoavaluo` AS `codigoavaluo`,`avaluo`.`id_solicitud` AS `id_solicitud`,`avaluo`.`id_oficialcredito` AS `id_oficialcredito`,`avaluo`.`id_inspector` AS `id_inspector`,`avaluo`.`id_cliente` AS `id_cliente`,`avaluo`.`is_active` AS `is_active`,`avaluo`.`estado` AS `estado`,`avaluo`.`estadointerno` AS `estadointerno`,`avaluo`.`estadopago` AS `estadopago`,`avaluo`.`fecha_avaluo` AS `fecha_avaluo`,`avaluo`.`montoincial` AS `montoincial`,`avaluo`.`id_metodopago` AS `id_metodopago`,`avaluo`.`created_at` AS `created_at`,`avaluo`.`DateModified` AS `DateModified`,`avaluo`.`DateDeleted` AS `DateDeleted`,`avaluo`.`CreatedBy` AS `CreatedBy`,`avaluo`.`ModifiedBy` AS `ModifiedBy`,`avaluo`.`DeletedBy` AS `DeletedBy`,`avaluo`.`id_sucursal` AS `id_sucursal`,`avaluo`.`informe` AS `informe`,`avaluo`.`comentario` AS `comentario` from `avaluo` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `viewavaluosupervisor`
--
DROP TABLE IF EXISTS `viewavaluosupervisor`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `viewavaluosupervisor`  AS  select `avaluo`.`id` AS `id`,`avaluo`.`tipoinmueble` AS `tipoinmueble`,`avaluo`.`codigoavaluo` AS `codigoavaluo`,`avaluo`.`id_solicitud` AS `id_solicitud`,`avaluo`.`id_oficialcredito` AS `id_oficialcredito`,`avaluo`.`id_inspector` AS `id_inspector`,`avaluo`.`id_cliente` AS `id_cliente`,`avaluo`.`is_active` AS `is_active`,`avaluo`.`estado` AS `estado`,`avaluo`.`estadointerno` AS `estadointerno`,`avaluo`.`estadopago` AS `estadopago`,`avaluo`.`fecha_avaluo` AS `fecha_avaluo`,`avaluo`.`montoincial` AS `montoincial`,`avaluo`.`id_metodopago` AS `id_metodopago`,`avaluo`.`created_at` AS `created_at`,`avaluo`.`DateModified` AS `DateModified`,`avaluo`.`DateDeleted` AS `DateDeleted`,`avaluo`.`CreatedBy` AS `CreatedBy`,`avaluo`.`ModifiedBy` AS `ModifiedBy`,`avaluo`.`DeletedBy` AS `DeletedBy`,`avaluo`.`id_sucursal` AS `id_sucursal`,`avaluo`.`informe` AS `informe`,`avaluo`.`monto_pago` AS `monto_pago`,`avaluo`.`comentario` AS `comentario` from `avaluo` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `viewavaluosupervisorhistorial`
--
DROP TABLE IF EXISTS `viewavaluosupervisorhistorial`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `viewavaluosupervisorhistorial`  AS  select `avaluo`.`id` AS `id`,`avaluo`.`tipoinmueble` AS `tipoinmueble`,`avaluo`.`codigoavaluo` AS `codigoavaluo`,`avaluo`.`id_solicitud` AS `id_solicitud`,`avaluo`.`id_oficialcredito` AS `id_oficialcredito`,`avaluo`.`id_inspector` AS `id_inspector`,`avaluo`.`id_cliente` AS `id_cliente`,`avaluo`.`is_active` AS `is_active`,`avaluo`.`estado` AS `estado`,`avaluo`.`estadointerno` AS `estadointerno`,`avaluo`.`estadopago` AS `estadopago`,`avaluo`.`fecha_avaluo` AS `fecha_avaluo`,`avaluo`.`montoincial` AS `montoincial`,`avaluo`.`id_metodopago` AS `id_metodopago`,`avaluo`.`created_at` AS `created_at`,`avaluo`.`DateModified` AS `DateModified`,`avaluo`.`DateDeleted` AS `DateDeleted`,`avaluo`.`CreatedBy` AS `CreatedBy`,`avaluo`.`ModifiedBy` AS `ModifiedBy`,`avaluo`.`DeletedBy` AS `DeletedBy`,`avaluo`.`id_sucursal` AS `id_sucursal`,`avaluo`.`informe` AS `informe`,`avaluo`.`monto_pago` AS `monto_pago`,`avaluo`.`comentario` AS `comentario` from `avaluo` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `viewdocumentoinspector`
--
DROP TABLE IF EXISTS `viewdocumentoinspector`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `viewdocumentoinspector`  AS  select `documentosavaluo`.`id` AS `id`,`documentosavaluo`.`descripcion` AS `descripcion`,`documentosavaluo`.`imagen` AS `imagen`,`documentosavaluo`.`avaluo` AS `avaluo`,`documentosavaluo`.`path_drive` AS `path_drive`,`documentosavaluo`.`id_tipodocumento` AS `id_tipodocumento`,`documentosavaluo`.`created_at` AS `created_at` from `documentosavaluo` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `viewdocumentooficialcredito`
--
DROP TABLE IF EXISTS `viewdocumentooficialcredito`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `viewdocumentooficialcredito`  AS  select `documentosavaluo`.`id` AS `id`,`documentosavaluo`.`descripcion` AS `descripcion`,`documentosavaluo`.`imagen` AS `imagen`,`documentosavaluo`.`avaluo` AS `avaluo`,`documentosavaluo`.`path_drive` AS `path_drive`,`documentosavaluo`.`id_tipodocumento` AS `id_tipodocumento`,`documentosavaluo`.`created_at` AS `created_at` from `documentosavaluo` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `viewdocumentosavaluoframe`
--
DROP TABLE IF EXISTS `viewdocumentosavaluoframe`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `viewdocumentosavaluoframe`  AS  select `documentosavaluo`.`id` AS `id`,`documentosavaluo`.`descripcion` AS `descripcion`,`documentosavaluo`.`imagen` AS `imagen`,`documentosavaluo`.`avaluo` AS `avaluo`,`documentosavaluo`.`path_drive` AS `path_drive`,`documentosavaluo`.`id_tipodocumento` AS `id_tipodocumento`,`documentosavaluo`.`created_at` AS `created_at` from `documentosavaluo` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `viewdocumentosavaluosc`
--
DROP TABLE IF EXISTS `viewdocumentosavaluosc`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `viewdocumentosavaluosc`  AS  select `documentosavaluo`.`id` AS `id`,`documentosavaluo`.`descripcion` AS `descripcion`,`documentosavaluo`.`imagen` AS `imagen`,`documentosavaluo`.`avaluo` AS `avaluo`,`documentosavaluo`.`path_drive` AS `path_drive`,`documentosavaluo`.`id_tipodocumento` AS `id_tipodocumento`,`documentosavaluo`.`created_at` AS `created_at` from `documentosavaluo` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `viewdocumentosupervisor`
--
DROP TABLE IF EXISTS `viewdocumentosupervisor`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `viewdocumentosupervisor`  AS  select `documentosavaluo`.`id` AS `id`,`documentosavaluo`.`descripcion` AS `descripcion`,`documentosavaluo`.`imagen` AS `imagen`,`documentosavaluo`.`avaluo` AS `avaluo`,`documentosavaluo`.`path_drive` AS `path_drive`,`documentosavaluo`.`id_tipodocumento` AS `id_tipodocumento`,`documentosavaluo`.`created_at` AS `created_at` from `documentosavaluo` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `viewpagoavaluos`
--
DROP TABLE IF EXISTS `viewpagoavaluos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `viewpagoavaluos`  AS  select `pago_avaluo`.`id` AS `id`,`pago_avaluo`.`pago_id` AS `pago_id`,`pago_avaluo`.`avaluo_id` AS `avaluo_id`,`pago_avaluo`.`q` AS `q`,`pago_avaluo`.`id_metodopago` AS `id_metodopago`,`pago_avaluo`.`id_banco` AS `id_banco`,`pago_avaluo`.`monto` AS `monto`,`pago_avaluo`.`documentopago` AS `documentopago` from `pago_avaluo` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `viewsolicitud`
--
DROP TABLE IF EXISTS `viewsolicitud`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `viewsolicitud`  AS  select `solicitud`.`id` AS `id`,`solicitud`.`name` AS `name`,`solicitud`.`lastname` AS `lastname`,`solicitud`.`email` AS `email`,`solicitud`.`address` AS `address`,`solicitud`.`nombre_contacto` AS `nombre_contacto`,`solicitud`.`email_contacto` AS `email_contacto`,`solicitud`.`latitud` AS `latitud`,`solicitud`.`longitud` AS `longitud`,`solicitud`.`phone` AS `phone`,`solicitud`.`cell` AS `cell`,`solicitud`.`id_sucursal` AS `id_sucursal`,`solicitud`.`tipoinmueble` AS `tipoinmueble`,`solicitud`.`id_ciudad_inmueble` AS `id_ciudad_inmueble`,`solicitud`.`id_provincia_inmueble` AS `id_provincia_inmueble`,`solicitud`.`imagen_inmueble01` AS `imagen_inmueble01`,`solicitud`.`imagen_inmueble02` AS `imagen_inmueble02`,`solicitud`.`imagen_inmueble03` AS `imagen_inmueble03`,`solicitud`.`imagen_inmueble04` AS `imagen_inmueble04`,`solicitud`.`imagen_inmueble05` AS `imagen_inmueble05`,`solicitud`.`imagen_inmueble06` AS `imagen_inmueble06`,`solicitud`.`imagen_inmueble07` AS `imagen_inmueble07`,`solicitud`.`imagen_inmueble08` AS `imagen_inmueble08`,`solicitud`.`tipovehiculo` AS `tipovehiculo`,`solicitud`.`id_ciudad_vehiculo` AS `id_ciudad_vehiculo`,`solicitud`.`id_provincia_vehiculo` AS `id_provincia_vehiculo`,`solicitud`.`imagen_vehiculo01` AS `imagen_vehiculo01`,`solicitud`.`imagen_vehiculo02` AS `imagen_vehiculo02`,`solicitud`.`imagen_vehiculo03` AS `imagen_vehiculo03`,`solicitud`.`imagen_vehiculo04` AS `imagen_vehiculo04`,`solicitud`.`imagen_vehiculo05` AS `imagen_vehiculo05`,`solicitud`.`imagen_vehiculo06` AS `imagen_vehiculo06`,`solicitud`.`imagen_vehiculo07` AS `imagen_vehiculo07`,`solicitud`.`imagen_vehiculo08` AS `imagen_vehiculo08`,`solicitud`.`tipomaquinaria` AS `tipomaquinaria`,`solicitud`.`id_ciudad_maquinaria` AS `id_ciudad_maquinaria`,`solicitud`.`id_provincia_maquinaria` AS `id_provincia_maquinaria`,`solicitud`.`imagen_maquinaria01` AS `imagen_maquinaria01`,`solicitud`.`imagen_maquinaria02` AS `imagen_maquinaria02`,`solicitud`.`imagen_maquinaria03` AS `imagen_maquinaria03`,`solicitud`.`imagen_maquinaria04` AS `imagen_maquinaria04`,`solicitud`.`imagen_maquinaria05` AS `imagen_maquinaria05`,`solicitud`.`imagen_maquinaria06` AS `imagen_maquinaria06`,`solicitud`.`imagen_maquinaria07` AS `imagen_maquinaria07`,`solicitud`.`imagen_maquinaria08` AS `imagen_maquinaria08`,`solicitud`.`tipomercaderia` AS `tipomercaderia`,`solicitud`.`imagen_mercaderia01` AS `imagen_mercaderia01`,`solicitud`.`documento_mercaderia` AS `documento_mercaderia`,`solicitud`.`tipoespecial` AS `tipoespecial`,`solicitud`.`imagen_tipoespecial01` AS `imagen_tipoespecial01`,`solicitud`.`is_active` AS `is_active`,`solicitud`.`documentos` AS `documentos`,`solicitud`.`created_at` AS `created_at`,`solicitud`.`DateModified` AS `DateModified`,`solicitud`.`DateDeleted` AS `DateDeleted`,`solicitud`.`CreatedBy` AS `CreatedBy`,`solicitud`.`ModifiedBy` AS `ModifiedBy`,`solicitud`.`DeletedBy` AS `DeletedBy` from `solicitud` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `viewsolicitudframe`
--
DROP TABLE IF EXISTS `viewsolicitudframe`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `viewsolicitudframe`  AS  select `solicitud`.`id` AS `id`,`solicitud`.`name` AS `name`,`solicitud`.`lastname` AS `lastname`,`solicitud`.`email` AS `email`,`solicitud`.`address` AS `address`,`solicitud`.`nombre_contacto` AS `nombre_contacto`,`solicitud`.`email_contacto` AS `email_contacto`,`solicitud`.`latitud` AS `latitud`,`solicitud`.`longitud` AS `longitud`,`solicitud`.`phone` AS `phone`,`solicitud`.`cell` AS `cell`,`solicitud`.`id_sucursal` AS `id_sucursal`,`solicitud`.`tipoinmueble` AS `tipoinmueble`,`solicitud`.`id_ciudad_inmueble` AS `id_ciudad_inmueble`,`solicitud`.`id_provincia_inmueble` AS `id_provincia_inmueble`,`solicitud`.`imagen_inmueble01` AS `imagen_inmueble01`,`solicitud`.`imagen_inmueble02` AS `imagen_inmueble02`,`solicitud`.`imagen_inmueble03` AS `imagen_inmueble03`,`solicitud`.`imagen_inmueble04` AS `imagen_inmueble04`,`solicitud`.`imagen_inmueble05` AS `imagen_inmueble05`,`solicitud`.`imagen_inmueble06` AS `imagen_inmueble06`,`solicitud`.`imagen_inmueble07` AS `imagen_inmueble07`,`solicitud`.`imagen_inmueble08` AS `imagen_inmueble08`,`solicitud`.`tipovehiculo` AS `tipovehiculo`,`solicitud`.`id_ciudad_vehiculo` AS `id_ciudad_vehiculo`,`solicitud`.`id_provincia_vehiculo` AS `id_provincia_vehiculo`,`solicitud`.`imagen_vehiculo01` AS `imagen_vehiculo01`,`solicitud`.`imagen_vehiculo02` AS `imagen_vehiculo02`,`solicitud`.`imagen_vehiculo03` AS `imagen_vehiculo03`,`solicitud`.`imagen_vehiculo04` AS `imagen_vehiculo04`,`solicitud`.`imagen_vehiculo05` AS `imagen_vehiculo05`,`solicitud`.`imagen_vehiculo06` AS `imagen_vehiculo06`,`solicitud`.`imagen_vehiculo07` AS `imagen_vehiculo07`,`solicitud`.`imagen_vehiculo08` AS `imagen_vehiculo08`,`solicitud`.`tipomaquinaria` AS `tipomaquinaria`,`solicitud`.`id_ciudad_maquinaria` AS `id_ciudad_maquinaria`,`solicitud`.`id_provincia_maquinaria` AS `id_provincia_maquinaria`,`solicitud`.`imagen_maquinaria01` AS `imagen_maquinaria01`,`solicitud`.`imagen_maquinaria02` AS `imagen_maquinaria02`,`solicitud`.`imagen_maquinaria03` AS `imagen_maquinaria03`,`solicitud`.`imagen_maquinaria04` AS `imagen_maquinaria04`,`solicitud`.`imagen_maquinaria05` AS `imagen_maquinaria05`,`solicitud`.`imagen_maquinaria06` AS `imagen_maquinaria06`,`solicitud`.`imagen_maquinaria07` AS `imagen_maquinaria07`,`solicitud`.`imagen_maquinaria08` AS `imagen_maquinaria08`,`solicitud`.`tipomercaderia` AS `tipomercaderia`,`solicitud`.`imagen_mercaderia01` AS `imagen_mercaderia01`,`solicitud`.`documento_mercaderia` AS `documento_mercaderia`,`solicitud`.`tipoespecial` AS `tipoespecial`,`solicitud`.`imagen_tipoespecial01` AS `imagen_tipoespecial01`,`solicitud`.`is_active` AS `is_active`,`solicitud`.`documentos` AS `documentos`,`solicitud`.`created_at` AS `created_at`,`solicitud`.`DateModified` AS `DateModified`,`solicitud`.`DateDeleted` AS `DateDeleted`,`solicitud`.`CreatedBy` AS `CreatedBy`,`solicitud`.`ModifiedBy` AS `ModifiedBy`,`solicitud`.`DeletedBy` AS `DeletedBy` from `solicitud` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `viewsolicitudinspector`
--
DROP TABLE IF EXISTS `viewsolicitudinspector`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `viewsolicitudinspector`  AS  select `solicitud`.`id` AS `id`,`solicitud`.`name` AS `name`,`solicitud`.`lastname` AS `lastname`,`solicitud`.`email` AS `email`,`solicitud`.`address` AS `address`,`solicitud`.`nombre_contacto` AS `nombre_contacto`,`solicitud`.`email_contacto` AS `email_contacto`,`solicitud`.`latitud` AS `latitud`,`solicitud`.`longitud` AS `longitud`,`solicitud`.`phone` AS `phone`,`solicitud`.`cell` AS `cell`,`solicitud`.`id_sucursal` AS `id_sucursal`,`solicitud`.`tipoinmueble` AS `tipoinmueble`,`solicitud`.`id_ciudad_inmueble` AS `id_ciudad_inmueble`,`solicitud`.`id_provincia_inmueble` AS `id_provincia_inmueble`,`solicitud`.`imagen_inmueble01` AS `imagen_inmueble01`,`solicitud`.`imagen_inmueble02` AS `imagen_inmueble02`,`solicitud`.`imagen_inmueble03` AS `imagen_inmueble03`,`solicitud`.`imagen_inmueble04` AS `imagen_inmueble04`,`solicitud`.`imagen_inmueble05` AS `imagen_inmueble05`,`solicitud`.`imagen_inmueble06` AS `imagen_inmueble06`,`solicitud`.`imagen_inmueble07` AS `imagen_inmueble07`,`solicitud`.`imagen_inmueble08` AS `imagen_inmueble08`,`solicitud`.`tipovehiculo` AS `tipovehiculo`,`solicitud`.`id_ciudad_vehiculo` AS `id_ciudad_vehiculo`,`solicitud`.`id_provincia_vehiculo` AS `id_provincia_vehiculo`,`solicitud`.`imagen_vehiculo01` AS `imagen_vehiculo01`,`solicitud`.`imagen_vehiculo02` AS `imagen_vehiculo02`,`solicitud`.`imagen_vehiculo03` AS `imagen_vehiculo03`,`solicitud`.`imagen_vehiculo04` AS `imagen_vehiculo04`,`solicitud`.`imagen_vehiculo05` AS `imagen_vehiculo05`,`solicitud`.`imagen_vehiculo06` AS `imagen_vehiculo06`,`solicitud`.`imagen_vehiculo07` AS `imagen_vehiculo07`,`solicitud`.`imagen_vehiculo08` AS `imagen_vehiculo08`,`solicitud`.`tipomaquinaria` AS `tipomaquinaria`,`solicitud`.`id_ciudad_maquinaria` AS `id_ciudad_maquinaria`,`solicitud`.`id_provincia_maquinaria` AS `id_provincia_maquinaria`,`solicitud`.`imagen_maquinaria01` AS `imagen_maquinaria01`,`solicitud`.`imagen_maquinaria02` AS `imagen_maquinaria02`,`solicitud`.`imagen_maquinaria03` AS `imagen_maquinaria03`,`solicitud`.`imagen_maquinaria04` AS `imagen_maquinaria04`,`solicitud`.`imagen_maquinaria05` AS `imagen_maquinaria05`,`solicitud`.`imagen_maquinaria06` AS `imagen_maquinaria06`,`solicitud`.`imagen_maquinaria07` AS `imagen_maquinaria07`,`solicitud`.`imagen_maquinaria08` AS `imagen_maquinaria08`,`solicitud`.`tipomercaderia` AS `tipomercaderia`,`solicitud`.`imagen_mercaderia01` AS `imagen_mercaderia01`,`solicitud`.`documento_mercaderia` AS `documento_mercaderia`,`solicitud`.`tipoespecial` AS `tipoespecial`,`solicitud`.`imagen_tipoespecial01` AS `imagen_tipoespecial01`,`solicitud`.`is_active` AS `is_active`,`solicitud`.`documentos` AS `documentos`,`solicitud`.`created_at` AS `created_at`,`solicitud`.`DateModified` AS `DateModified`,`solicitud`.`DateDeleted` AS `DateDeleted`,`solicitud`.`CreatedBy` AS `CreatedBy`,`solicitud`.`ModifiedBy` AS `ModifiedBy`,`solicitud`.`DeletedBy` AS `DeletedBy` from `solicitud` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `viewsolicitudsupervisor`
--
DROP TABLE IF EXISTS `viewsolicitudsupervisor`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `viewsolicitudsupervisor`  AS  select `solicitud`.`id` AS `id`,`solicitud`.`name` AS `name`,`solicitud`.`lastname` AS `lastname`,`solicitud`.`email` AS `email`,`solicitud`.`address` AS `address`,`solicitud`.`nombre_contacto` AS `nombre_contacto`,`solicitud`.`email_contacto` AS `email_contacto`,`solicitud`.`latitud` AS `latitud`,`solicitud`.`longitud` AS `longitud`,`solicitud`.`phone` AS `phone`,`solicitud`.`cell` AS `cell`,`solicitud`.`id_sucursal` AS `id_sucursal`,`solicitud`.`tipoinmueble` AS `tipoinmueble`,`solicitud`.`id_ciudad_inmueble` AS `id_ciudad_inmueble`,`solicitud`.`id_provincia_inmueble` AS `id_provincia_inmueble`,`solicitud`.`imagen_inmueble01` AS `imagen_inmueble01`,`solicitud`.`imagen_inmueble02` AS `imagen_inmueble02`,`solicitud`.`imagen_inmueble03` AS `imagen_inmueble03`,`solicitud`.`imagen_inmueble04` AS `imagen_inmueble04`,`solicitud`.`imagen_inmueble05` AS `imagen_inmueble05`,`solicitud`.`imagen_inmueble06` AS `imagen_inmueble06`,`solicitud`.`imagen_inmueble07` AS `imagen_inmueble07`,`solicitud`.`imagen_inmueble08` AS `imagen_inmueble08`,`solicitud`.`tipovehiculo` AS `tipovehiculo`,`solicitud`.`id_ciudad_vehiculo` AS `id_ciudad_vehiculo`,`solicitud`.`id_provincia_vehiculo` AS `id_provincia_vehiculo`,`solicitud`.`imagen_vehiculo01` AS `imagen_vehiculo01`,`solicitud`.`imagen_vehiculo02` AS `imagen_vehiculo02`,`solicitud`.`imagen_vehiculo03` AS `imagen_vehiculo03`,`solicitud`.`imagen_vehiculo04` AS `imagen_vehiculo04`,`solicitud`.`imagen_vehiculo05` AS `imagen_vehiculo05`,`solicitud`.`imagen_vehiculo06` AS `imagen_vehiculo06`,`solicitud`.`imagen_vehiculo07` AS `imagen_vehiculo07`,`solicitud`.`imagen_vehiculo08` AS `imagen_vehiculo08`,`solicitud`.`tipomaquinaria` AS `tipomaquinaria`,`solicitud`.`id_ciudad_maquinaria` AS `id_ciudad_maquinaria`,`solicitud`.`id_provincia_maquinaria` AS `id_provincia_maquinaria`,`solicitud`.`imagen_maquinaria01` AS `imagen_maquinaria01`,`solicitud`.`imagen_maquinaria02` AS `imagen_maquinaria02`,`solicitud`.`imagen_maquinaria03` AS `imagen_maquinaria03`,`solicitud`.`imagen_maquinaria04` AS `imagen_maquinaria04`,`solicitud`.`imagen_maquinaria05` AS `imagen_maquinaria05`,`solicitud`.`imagen_maquinaria06` AS `imagen_maquinaria06`,`solicitud`.`imagen_maquinaria07` AS `imagen_maquinaria07`,`solicitud`.`imagen_maquinaria08` AS `imagen_maquinaria08`,`solicitud`.`tipomercaderia` AS `tipomercaderia`,`solicitud`.`imagen_mercaderia01` AS `imagen_mercaderia01`,`solicitud`.`documento_mercaderia` AS `documento_mercaderia`,`solicitud`.`tipoespecial` AS `tipoespecial`,`solicitud`.`imagen_tipoespecial01` AS `imagen_tipoespecial01`,`solicitud`.`is_active` AS `is_active`,`solicitud`.`documentos` AS `documentos`,`solicitud`.`created_at` AS `created_at`,`solicitud`.`DateModified` AS `DateModified`,`solicitud`.`DateDeleted` AS `DateDeleted`,`solicitud`.`CreatedBy` AS `CreatedBy`,`solicitud`.`ModifiedBy` AS `ModifiedBy`,`solicitud`.`DeletedBy` AS `DeletedBy` from `solicitud` ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `audittrail`
--
ALTER TABLE `audittrail`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `avaluo`
--
ALTER TABLE `avaluo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `banco`
--
ALTER TABLE `banco`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `comentariosavaluo`
--
ALTER TABLE `comentariosavaluo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `datossolicitud`
--
ALTER TABLE `datossolicitud`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `documentosavaluo`
--
ALTER TABLE `documentosavaluo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `emailnotificaciones`
--
ALTER TABLE `emailnotificaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estadointerno`
--
ALTER TABLE `estadointerno`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estadopago`
--
ALTER TABLE `estadopago`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estado_sms`
--
ALTER TABLE `estado_sms`
  ADD PRIMARY KEY (`ESTADO`);

--
-- Indices de la tabla `historico`
--
ALTER TABLE `historico`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD PRIMARY KEY (`MENSAJE_ID`);

--
-- Indices de la tabla `metodopago`
--
ALTER TABLE `metodopago`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `offline_messages`
--
ALTER TABLE `offline_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pago`
--
ALTER TABLE `pago`
  ADD PRIMARY KEY (`id`),
  ADD KEY `metodopago_id` (`metodopago_id`),
  ADD KEY `cliente_id` (`cliente_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Indices de la tabla `pago_avaluo`
--
ALTER TABLE `pago_avaluo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pago_id` (`pago_id`),
  ADD KEY `avaluo_id` (`avaluo_id`);

--
-- Indices de la tabla `provincia`
--
ALTER TABLE `provincia`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sms_data`
--
ALTER TABLE `sms_data`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `solicitud`
--
ALTER TABLE `solicitud`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `streets`
--
ALTER TABLE `streets`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipodocumento`
--
ALTER TABLE `tipodocumento`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipoinmueble`
--
ALTER TABLE `tipoinmueble`
  ADD PRIMARY KEY (`id_tipoinmueble`);

--
-- Indices de la tabla `userlevelpermissions`
--
ALTER TABLE `userlevelpermissions`
  ADD PRIMARY KEY (`userlevelid`,`tablename`);

--
-- Indices de la tabla `userlevels`
--
ALTER TABLE `userlevels`
  ADD PRIMARY KEY (`userlevelid`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`login`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `areas`
--
ALTER TABLE `areas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `audittrail`
--
ALTER TABLE `audittrail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=631;
--
-- AUTO_INCREMENT de la tabla `avaluo`
--
ALTER TABLE `avaluo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `banco`
--
ALTER TABLE `banco`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT de la tabla `comentariosavaluo`
--
ALTER TABLE `comentariosavaluo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `datossolicitud`
--
ALTER TABLE `datossolicitud`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `departamento`
--
ALTER TABLE `departamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `documentosavaluo`
--
ALTER TABLE `documentosavaluo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de la tabla `emailnotificaciones`
--
ALTER TABLE `emailnotificaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `estadointerno`
--
ALTER TABLE `estadointerno`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `estadopago`
--
ALTER TABLE `estadopago`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `historico`
--
ALTER TABLE `historico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  MODIFY `MENSAJE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `metodopago`
--
ALTER TABLE `metodopago`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `pago`
--
ALTER TABLE `pago`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `pago_avaluo`
--
ALTER TABLE `pago_avaluo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `provincia`
--
ALTER TABLE `provincia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `sms_data`
--
ALTER TABLE `sms_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `solicitud`
--
ALTER TABLE `solicitud`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `streets`
--
ALTER TABLE `streets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `tipodocumento`
--
ALTER TABLE `tipodocumento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `tipoinmueble`
--
ALTER TABLE `tipoinmueble`
  MODIFY `id_tipoinmueble` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
