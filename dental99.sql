-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-02-2024 a las 17:08:23
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
-- Base de datos: `dental99`
--

DELIMITER $$
--
-- Funciones
--
CREATE DEFINER=`root`@`localhost` FUNCTION `getNumeroTicket` () RETURNS VARCHAR(10) CHARSET utf8mb4 COLLATE utf8mb4_general_ci  BEGIN
Declare Contador int DEFAULT 0;

Select max(right(numero,8)) into Contador from comprobante_pago;
IF (Contador IS NULL) THEN
	set Contador=0;
end if;	
return concat('T-',right(concat('00000000',Contador+1),8)) ;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auditoria`
--

CREATE TABLE `auditoria` (
  `idauditoria` int(11) NOT NULL,
  `tabla` varchar(45) DEFAULT NULL,
  `data_new` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`data_new`)),
  `data_old` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`data_old`)),
  `usuario` varchar(45) DEFAULT NULL,
  `ip` varchar(45) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `operacion` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `idcitas` int(11) NOT NULL,
  `fecha` datetime DEFAULT NULL,
  `observaciones` varchar(250) DEFAULT NULL,
  `idestados` int(11) NOT NULL,
  `idpaciente` int(11) NOT NULL,
  `idpersonal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`idcitas`, `fecha`, `observaciones`, `idestados`, `idpaciente`, `idpersonal`) VALUES
(1, '2023-09-16 10:00:00', 'Extracción dental', 1, 1, 3),
(2, '2023-09-13 11:00:00', 'Limpieza', 1, 1, 3),
(6, '2023-09-15 09:00:00', 'Extracción', 1, 1, 3),
(7, '2023-09-16 08:00:00', 'Extracción', 1, 1, 3),
(8, '2023-11-01 18:30:19', 'Extracción dental000', 1, 1, 3),
(9, '2023-09-22 10:30:00', 'Extracción001', 1, 1, 3),
(10, '2023-09-25 21:30:00', 'Extracción dental000', 1, 1, 3),
(11, '2023-09-26 11:30:00', 'Extracción000000', 1, 1, 3),
(12, '2023-09-27 15:00:00', 'Extracción002', 1, 1, 3),
(13, '2023-09-28 13:00:00', 'Consulta', 1, 1, 3),
(14, '2023-09-28 10:00:00', 'Extracción dental000', 1, 4, 3),
(15, '2023-09-30 13:00:00', 'Chequeo', 1, 4, 3),
(16, '2023-10-03 15:00:00', 'Extracción de muela', 1, 4, 3),
(21, '2023-11-09 08:00:00', 'Extracción dental', 1, 4, 2),
(22, '2023-11-09 11:00:00', 'Endodoncia', 1, 4, 2),
(23, '2023-11-10 10:00:00', 'Otra consulta', 1, 4, 2),
(24, '2023-11-10 12:00:00', 'Extracción002', 1, 4, 2),
(25, '2023-11-11 11:00:00', 'Revision', 1, 4, 2),
(26, '2023-11-09 08:30:00', 'Otro servicio', 1, 4, 2),
(27, '2023-11-11 08:30:00', 'Cita a ciegas', 1, 4, 2),
(28, '2023-11-17 10:00:00', 'Extracción', 1, 4, 2),
(29, '2023-11-17 11:00:00', 'Permiso por Salud', 1, 4, 2),
(30, '2023-11-16 07:00:00', 'Extracción002', 1, 4, 2),
(37, '2024-02-01 10:52:37', 'Ninguno', 1, 3, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comprobante_pago`
--

CREATE TABLE `comprobante_pago` (
  `idpago` int(11) NOT NULL,
  `numero` varchar(20) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `total` decimal(12,2) DEFAULT NULL,
  `idcomprobante` int(11) NOT NULL,
  `idtipo_comprobantes` int(11) NOT NULL,
  `idpagos` int(11) NOT NULL,
  `idpersonas` int(11) NOT NULL,
  `idpersonas1` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `comprobante_pago`
--

INSERT INTO `comprobante_pago` (`idpago`, `numero`, `fecha`, `total`, `idcomprobante`, `idtipo_comprobantes`, `idpagos`, `idpersonas`, `idpersonas1`) VALUES
(4, 'T-00000001', '2024-02-09 11:04:57', 550.00, 3, 2, 1, 6, 0),
(5, 'T-00000002', '2024-02-09 13:43:35', 160.00, 3, 2, 1, 6, 0),
(6, 'T-00000003', '2024-02-09 13:45:27', 60.00, 3, 2, 1, 4, 0),
(7, 'T-00000004', '2024-02-09 20:15:15', 160.00, 3, 2, 1, 4, 0),
(8, 'T-00000005', '2024-02-09 20:26:41', 200.00, 3, 2, 1, 1, 0),
(10, 'T-00000006', '2024-02-10 13:36:34', 280.00, 3, 2, 1, 4, 0),
(12, 'T-00000007', '2024-02-10 22:17:45', 145.00, 3, 2, 1, 4, 0),
(13, 'T-00000008', '2024-02-10 23:15:51', 325.00, 3, 2, 1, 4, 0),
(14, 'T-00000009', '2024-02-11 09:14:21', 195.00, 3, 2, 1, 4, 0),
(15, 'T-00000010', '2024-02-11 10:26:00', 245.00, 3, 2, 1, 11, 0),
(16, 'T-00000011', '2024-02-11 10:27:12', 295.00, 3, 2, 1, 12, 0),
(17, 'T-00000012', '2024-02-11 10:27:27', 180.00, 3, 2, 1, 12, 0),
(19, 'T-00000013', '2024-02-11 10:51:40', 25.00, 3, 2, 1, 3, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_comprobante`
--

CREATE TABLE `detalles_comprobante` (
  `iddetalles_comprobante` int(11) NOT NULL,
  `precio` decimal(12,2) DEFAULT NULL,
  `descuento` decimal(12,2) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `igv` decimal(12,2) DEFAULT NULL,
  `idpago` int(11) NOT NULL,
  `idservicio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `detalles_comprobante`
--

INSERT INTO `detalles_comprobante` (`iddetalles_comprobante`, `precio`, `descuento`, `cantidad`, `igv`, `idpago`, `idservicio`) VALUES
(1, 150.00, 0.00, 3, 0.00, 4, 3),
(2, 50.00, 0.00, 2, 0.00, 4, 2),
(3, 60.00, 0.00, 1, 0.00, 5, 1),
(4, 50.00, 0.00, 2, 0.00, 5, 2),
(5, 60.00, 0.00, 1, 0.00, 6, 1),
(6, 60.00, 0.00, 1, 0.00, 7, 1),
(7, 50.00, 0.00, 2, 0.00, 7, 2),
(8, 50.00, 0.00, 1, 0.00, 8, 2),
(9, 150.00, 0.00, 1, 0.00, 8, 3),
(10, 50.00, 0.00, 2, 0.00, 10, 2),
(11, 60.00, 0.00, 3, 0.00, 10, 1),
(12, 25.00, 0.00, 1, 0.00, 12, 0),
(13, 60.00, 0.00, 2, 0.00, 12, 1),
(14, 25.00, 0.00, 1, 0.00, 13, 0),
(15, 150.00, 0.00, 2, 0.00, 13, 3),
(16, 25.00, 0.00, 1, 0.00, 14, 0),
(17, 60.00, 0.00, 2, 0.00, 14, 1),
(18, 50.00, 0.00, 1, 0.00, 14, 2),
(19, 25.00, 0.00, 1, 0.00, 15, 0),
(20, 60.00, 0.00, 2, 0.00, 15, 1),
(21, 50.00, 0.00, 2, 0.00, 15, 2),
(22, 25.00, 0.00, 1, 0.00, 16, 0),
(23, 60.00, 0.00, 2, 0.00, 16, 1),
(24, 50.00, 0.00, 3, 0.00, 16, 2),
(25, 60.00, 0.00, 3, 0.00, 17, 1),
(26, 25.00, 0.00, 1, 0.00, 19, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dientes`
--

CREATE TABLE `dientes` (
  `iddientes` int(11) NOT NULL,
  `ubicacion` int(11) DEFAULT NULL,
  `nombre` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `dientes`
--

INSERT INTO `dientes` (`iddientes`, `ubicacion`, `nombre`) VALUES
(1, 1, 'Tercer Molar Derecho'),
(2, 2, 'Segundo Molar Derecho'),
(3, 3, 'Primer Molar Derecho'),
(4, 4, 'Segundo Premolar Derecho'),
(5, 5, 'Primer Premolar Derecho'),
(6, 6, 'Canino Derecho'),
(7, 7, 'Incisivo Central Derecho'),
(8, 8, 'Incisivo Central Derecho'),
(9, 8, 'Incisivo Central Derecho');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `idestados` int(11) NOT NULL,
  `nombre` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`idestados`, `nombre`) VALUES
(1, 'Pendiente'),
(2, 'Activo(a)'),
(3, 'Anulado(a)');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados_comprobante`
--

CREATE TABLE `estados_comprobante` (
  `idcomprobante` int(11) NOT NULL,
  `estado` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `estados_comprobante`
--

INSERT INTO `estados_comprobante` (`idcomprobante`, `estado`) VALUES
(1, 'PAGADO'),
(2, 'ANULADO'),
(3, 'PENDIENTE PAGO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_dental`
--

CREATE TABLE `estado_dental` (
  `idestado_dental` int(11) NOT NULL,
  `icono` varchar(45) DEFAULT NULL,
  `descripcion` varchar(120) DEFAULT NULL,
  `color` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formas_pagos`
--

CREATE TABLE `formas_pagos` (
  `idpagos` int(11) NOT NULL,
  `forma` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `formas_pagos`
--

INSERT INTO `formas_pagos` (`idpagos`, `forma`) VALUES
(1, 'EFECTIVO'),
(2, 'TARJETA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historias_clinicas`
--

CREATE TABLE `historias_clinicas` (
  `idhistorias_clinicas` int(11) NOT NULL,
  `fecha` datetime DEFAULT NULL,
  `observaciones` varchar(120) DEFAULT NULL,
  `idpaciente` int(11) NOT NULL,
  `iddoctor` int(11) NOT NULL,
  `enfermedades` varchar(80) NOT NULL,
  `alergias` varchar(80) NOT NULL,
  `presion` int(11) NOT NULL,
  `sensibilidad` varchar(80) NOT NULL,
  `temperatura` decimal(5,2) NOT NULL,
  `gestacion` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `historias_clinicas`
--

INSERT INTO `historias_clinicas` (`idhistorias_clinicas`, `fecha`, `observaciones`, `idpaciente`, `iddoctor`, `enfermedades`, `alergias`, `presion`, `sensibilidad`, `temperatura`, `gestacion`) VALUES
(1, '2023-10-13 23:24:54', '-', 6, 1, '-', '-', 80, '-', 37.50, '-'),
(6, '2024-02-10 00:00:00', 'No', 6, 2, 'No', 'No', 0, 'on', 37.00, 'no'),
(7, '2024-02-09 00:00:00', 'No', 1, 2, 'No', 'No', 0, 'on', 37.00, 'no'),
(8, '2024-02-10 00:00:00', 'No', 4, 2, 'No', 'No', 0, 'on', 37.00, 'no'),
(9, '0000-00-00 00:00:00', 'No', 4, 2, 'No', 'No', 0, 'on', 37.00, 'no'),
(10, '2024-02-02 00:00:00', 'No', 16, 2, 'No', 'No', 0, 'on', 37.00, 'no'),
(11, '2024-02-05 00:00:00', 'No', 16, 2, 'No', 'No', 0, 'on', 37.00, 'no'),
(12, '2024-01-28 00:00:00', 'No', 12, 2, 'No', 'No', 0, 'on', 36.00, 'no'),
(13, '2024-01-18 00:00:00', 'No', 11, 2, 'No', 'No', 0, 'on', 36.00, 'no'),
(14, '2023-12-20 00:00:00', 'No', 11, 2, 'No', 'No', 0, 'on', 36.00, 'no'),
(15, '2023-12-20 00:00:00', 'No', 4, 2, 'No', 'No', 0, 'on', 36.00, 'no'),
(16, '2023-12-20 00:00:00', 'No', 1, 2, 'No', 'No', 0, 'on', 36.00, 'no'),
(17, '2024-01-31 00:00:00', 'No', 3, 2, 'No', 'No', 0, 'on', 37.00, 'no'),
(18, '2024-01-28 00:00:00', 'No', 6, 2, 'No', 'No', 0, 'on', 37.00, 'no'),
(19, '2024-01-09 00:00:00', 'No', 4, 0, 'No', 'No', 0, 'on', 37.00, 'no'),
(20, '2024-01-09 00:00:00', 'No', 4, 0, 'No', 'No', 0, 'on', 37.00, 'no');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `odontogramas`
--

CREATE TABLE `odontogramas` (
  `idodontogramas` int(11) NOT NULL,
  `observaciones` varchar(250) DEFAULT NULL,
  `placa` varchar(100) DEFAULT NULL,
  `idhistorias_clinicas` int(11) NOT NULL,
  `idestado_dental` int(11) NOT NULL,
  `iddientes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--

CREATE TABLE `paciente` (
  `idpersonas` int(11) NOT NULL,
  `idtipo_paciente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `paciente`
--

INSERT INTO `paciente` (`idpersonas`, `idtipo_paciente`) VALUES
(1, 2),
(3, 2),
(4, 2),
(6, 2),
(11, 2),
(12, 2),
(16, 2),
(17, 2),
(18, 2),
(20, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal`
--

CREATE TABLE `personal` (
  `idpersonas` int(11) NOT NULL,
  `colegiatura` varchar(9) DEFAULT NULL,
  `idtipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `personal`
--

INSERT INTO `personal` (`idpersonas`, `colegiatura`, `idtipo`) VALUES
(0, '', 2),
(1, 'A-999', 1),
(2, 'asasasa', 2),
(3, '124578', 2),
(13, '110123', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `idpersonas` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `apellido` varchar(45) DEFAULT NULL,
  `dni` varchar(10) DEFAULT NULL,
  `direccion` varchar(45) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `telefono` varchar(12) DEFAULT NULL,
  `correo` varchar(76) DEFAULT NULL,
  `usuario` varchar(45) DEFAULT NULL,
  `clave` varchar(40) DEFAULT NULL,
  `fecha_alta` datetime DEFAULT NULL,
  `estados_idestados` int(11) NOT NULL,
  `idsexos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`idpersonas`, `nombre`, `apellido`, `dni`, `direccion`, `fecha_nacimiento`, `telefono`, `correo`, `usuario`, `clave`, `fecha_alta`, `estados_idestados`, `idsexos`) VALUES
(0, 'Henrryque', 'Avalos Valdivia', '04422478', 'Piura Pj. 06', '1970-06-19', '987541478', 'doctor@gmail.com', 'Doctor1', 'c3949ba59abbe560adc3949ba', '0000-00-00 00:00:00', 2, 3),
(1, 'Carlitos', 'Flores', '12345678', 'Av. Bolivar 123', '2000-05-10', '95214578', 'carlitos@gmail.com', 'carlitos', 'c3949ba59abbe560adc3949ba', '0000-00-00 00:00:00', 2, 2),
(2, 'Juan', 'Perez', '24578956', 'Balta 2332', '2023-10-01', '95587788', 'juan@gmail.com', 'juan', 'c3949ba59abbe560adc3949ba', '0000-00-00 00:00:00', 2, 1),
(3, 'Mario', 'Montero', '24589865', 'Las Bugambillas 332', '1985-05-15', '99985478', 'mario@gmail.com', 'mario', '1234', '2023-09-11 00:00:00', 1, 2),
(4, 'Maria', 'Vargas', '32145678', 'Av. Bolivar 123', '2017-06-13', '98765432', 'mvargas@gmail.com', 'maria', 'c3949ba59abbe560adc3949ba', '0000-00-00 00:00:00', 2, 1),
(6, 'Walter', 'Coayla', '11145678', 'Asoc. José Olaya Ñ-49', '2000-01-01', '990220266', 'walter.coayla@gmail.com', 'walter', 'c3949ba59abbe560adc3949ba', '0000-00-00 00:00:00', 2, 2),
(11, 'Roberto', 'Ramirez', '87654321', 'Bolivar 3423', '2023-10-02', '95959856', 'rramirez@gmail.com', 'roberto', '123456', '2023-10-23 23:58:46', 2, 2),
(12, 'Rosa', 'Rivera', '45454521', 'Su Casa', '2023-10-04', '123123123', 'rosa@gmail.com', 'rosa', 'c3949ba59abbe560adc3949ba', '0000-00-00 00:00:00', 2, 3),
(13, 'Admin', 'N', '00000000', 'N', '0000-00-00', '', 'admin@gmail.com', 'Admin1', 'c3949ba59abbe560adc3949ba', '0000-00-00 00:00:00', 2, 3),
(15, 'Paciente', 'N', '00000000', 'N', '0000-00-00', '', 'paciente@gmail.com', 'Paciente1', 'c3949ba59abbe560adc3949ba', '0000-00-00 00:00:00', 2, 3),
(16, 'Espenser ', 'Flores Causa', '73860174', 'Piura S/N', '1999-04-08', '987542654', 'espenser@gmail.com', 'Espenser1', 'c3949ba59abbe560adc3949ba', '0000-00-00 00:00:00', 2, 3),
(17, 'Fernando', 'Flores Causa', '74825145', 'Piura S/N', '1999-02-11', '987542654', 'fernando@gmail.com', 'Fernando1', 'c3949ba59abbe560adc3949ba', '0000-00-00 00:00:00', 2, 3),
(18, 'Miguel ', 'Sanches Huaranga', '72851425', 'Piura pasaje las Americas', '1997-02-12', '987564512', 'miguel@gmail.com', 'Miguel1', 'c3949ba59abbe560adc3949ba', '0000-00-00 00:00:00', 2, 3),
(19, 'Yoel', 'Mirando Prado', '74851478', 'Av. Piura 125', '2006-03-10', '987542689', 'yoel@gmail.com', 'yoel1', 'c3949ba59abbe560adc3949ba', '0000-00-00 00:00:00', 2, 3),
(20, 'Roues', 'Bardo Salina', '74154124', 'Calle las Americas', '1995-06-12', '987564789', 'roues@gmail.com', 'Roue1', 'c3949ba59abbe560adc3949ba', '0000-00-00 00:00:00', 2, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios_odontologicos`
--

CREATE TABLE `servicios_odontologicos` (
  `idservicio` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  `precio` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `servicios_odontologicos`
--

INSERT INTO `servicios_odontologicos` (`idservicio`, `nombre`, `descripcion`, `precio`) VALUES
(0, 'Consulta', 'Odontológica ', 25),
(1, 'Extracción', 'Extracción de Muela', 60),
(2, 'Endodoncia', 'Curación de Dientes', 50),
(3, 'Corona', 'Corona de muelas', 150);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sesion_profilaxis`
--

CREATE TABLE `sesion_profilaxis` (
  `idsesion_profilaxis` int(11) NOT NULL,
  `fecha` datetime DEFAULT NULL,
  `sesion` varchar(45) DEFAULT NULL,
  `idhistorias_clinicas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sexos`
--

CREATE TABLE `sexos` (
  `idsexos` int(11) NOT NULL,
  `nombre` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='	';

--
-- Volcado de datos para la tabla `sexos`
--

INSERT INTO `sexos` (`idsexos`, `nombre`) VALUES
(1, 'FEMENINO'),
(2, 'MASCULINO'),
(3, 'PREFIERO NO DECIRLO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_comprobantes`
--

CREATE TABLE `tipo_comprobantes` (
  `idtipo_comprobantes` int(11) NOT NULL,
  `tipo` varchar(45) DEFAULT NULL,
  `ultimo_numero` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tipo_comprobantes`
--

INSERT INTO `tipo_comprobantes` (`idtipo_comprobantes`, `tipo`, `ultimo_numero`) VALUES
(0, 'PRESUPUESTO', '1'),
(1, 'FACTURA', '1'),
(2, 'BOLETA', '1'),
(3, 'RECIBO', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_paciente`
--

CREATE TABLE `tipo_paciente` (
  `idtipo_paciente` int(11) NOT NULL,
  `tipo` varchar(10) DEFAULT NULL,
  `cantidad_dientes` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tipo_paciente`
--

INSERT INTO `tipo_paciente` (`idtipo_paciente`, `tipo`, `cantidad_dientes`) VALUES
(1, 'NIÑOS', 20),
(2, 'ADULTO', 32);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_personal`
--

CREATE TABLE `tipo_personal` (
  `idtipo` int(11) NOT NULL,
  `tipo` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tipo_personal`
--

INSERT INTO `tipo_personal` (`idtipo`, `tipo`) VALUES
(1, 'ADMINISTRADOR'),
(2, 'DOCTOR'),
(3, 'ASISTENTE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tratamiento`
--

CREATE TABLE `tratamiento` (
  `idtratamiento` int(11) NOT NULL,
  `fecha` datetime DEFAULT NULL,
  `tratamiento` varchar(45) DEFAULT NULL,
  `idodontogramas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_cita`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_cita` (
`idcitas` int(11)
,`fecha` datetime
,`observaciones` varchar(250)
,`idestados` int(11)
,`idpaciente` int(11)
,`idpersonal` int(11)
,`fin` datetime
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_cita01`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_cita01` (
`idcitas` int(11)
,`fecha` datetime
,`observaciones` varchar(250)
,`idpaciente` int(11)
,`idpersonal` int(11)
,`NomPersonal` varchar(45)
,`NomPaciente` varchar(45)
,`NomEstado` varchar(30)
,`fin` datetime
,`ApePaciente` varchar(45)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_comprobante00`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_comprobante00` (
`idpersonas` int(11)
,`nombre` varchar(45)
,`apellido` varchar(45)
,`dni` varchar(10)
,`direccion` varchar(45)
,`fecha_nacimiento` date
,`telefono` varchar(12)
,`correo` varchar(76)
,`usuario` varchar(45)
,`clave` varchar(40)
,`fecha_alta` datetime
,`estados_idestados` int(11)
,`idsexos` int(11)
,`idtipo_paciente` int(11)
,`tipo` varchar(10)
,`sexo` varchar(20)
,`idpago` int(11)
,`numero` varchar(20)
,`total` decimal(12,2)
,`fecha` datetime
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_comprobantepresupuesto`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_comprobantepresupuesto` (
`idpersonas` int(11)
,`nombre` varchar(45)
,`apellido` varchar(45)
,`dni` varchar(10)
,`sexo` varchar(20)
,`tipo` varchar(10)
,`idpago` int(11)
,`numero` varchar(20)
,`fecha` datetime
,`total` decimal(12,2)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_estadisticapacientes`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_estadisticapacientes` (
`idpersonas` int(11)
,`monto` decimal(34,2)
,`cantidad` bigint(21)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_estadisticas_citas`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_estadisticas_citas` (
`idpaciente` int(11)
,`cantidad` bigint(21)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_historias_clinicas`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_historias_clinicas` (
`idhistorias_clinicas` int(11)
,`fecha` datetime
,`observaciones` varchar(120)
,`idpaciente` int(11)
,`iddoctor` int(11)
,`enfermedades` varchar(80)
,`alergias` varchar(80)
,`presion` int(11)
,`sensibilidad` varchar(80)
,`temperatura` decimal(5,2)
,`gestacion` varchar(80)
,`nomPaciente` varchar(45)
,`apePaciente` varchar(45)
,`dni` varchar(10)
,`direccion` varchar(45)
,`telefono` varchar(12)
,`fecha_nacimiento` date
,`sexo` varchar(20)
,`tipo` varchar(10)
,`nomDoctor` varchar(45)
,`apeDoctor` varchar(45)
,`colegiatura` varchar(9)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_pacientes`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_pacientes` (
`idpersonas` int(11)
,`nombre` varchar(45)
,`apellido` varchar(45)
,`dni` varchar(10)
,`direccion` varchar(45)
,`fecha_nacimiento` date
,`telefono` varchar(12)
,`correo` varchar(76)
,`usuario` varchar(45)
,`clave` varchar(40)
,`fecha_alta` datetime
,`estados_idestados` int(11)
,`idsexos` int(11)
,`idtipo_paciente` int(11)
,`tipo` varchar(10)
,`sexo` varchar(20)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_personal`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_personal` (
`idpersonas` int(11)
,`colegiatura` varchar(9)
,`idtipo` int(11)
,`tipo` varchar(45)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_personal01`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_personal01` (
`idpersonas` int(11)
,`nombre` varchar(45)
,`apellido` varchar(45)
,`colegiatura` varchar(9)
,`tipo` varchar(45)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_siguienteidpersona`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_siguienteidpersona` (
`siguiente` bigint(12)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_ticketspago`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_ticketspago` (
`idpago` int(11)
,`numero` varchar(20)
,`fecha` datetime
,`total` decimal(12,2)
,`idcomprobante` int(11)
,`idtipo_comprobantes` int(11)
,`idpagos` int(11)
,`idpersonas` int(11)
,`idpersonas1` int(11)
,`precio` decimal(12,2)
,`cantidad` int(11)
,`idservicio` int(11)
,`nombreServicio` varchar(45)
,`descripcion` varchar(250)
,`nombrePaciente` varchar(45)
,`apellidoPaciente` varchar(45)
,`dni` varchar(10)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `v_cita`
--
DROP TABLE IF EXISTS `v_cita`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_cita`  AS SELECT `citas`.`idcitas` AS `idcitas`, `citas`.`fecha` AS `fecha`, `citas`.`observaciones` AS `observaciones`, `citas`.`idestados` AS `idestados`, `citas`.`idpaciente` AS `idpaciente`, `citas`.`idpersonal` AS `idpersonal`, addtime(`citas`.`fecha`,'00:30:00') AS `fin` FROM `citas` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_cita01`
--
DROP TABLE IF EXISTS `v_cita01`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_cita01`  AS SELECT `c`.`idcitas` AS `idcitas`, `c`.`fecha` AS `fecha`, `c`.`observaciones` AS `observaciones`, `c`.`idpaciente` AS `idpaciente`, `c`.`idpersonal` AS `idpersonal`, `pl`.`nombre` AS `NomPersonal`, `p`.`nombre` AS `NomPaciente`, `e`.`nombre` AS `NomEstado`, addtime(`c`.`fecha`,'00:30:00') AS `fin`, `p`.`apellido` AS `ApePaciente` FROM (((`citas` `c` join `estados` `e` on(`c`.`idestados` = `e`.`idestados`)) join `v_pacientes` `p` on(`c`.`idpaciente` = `p`.`idpersonas`)) join `v_personal01` `pl` on(`c`.`idpersonal` = `pl`.`idpersonas`)) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_comprobante00`
--
DROP TABLE IF EXISTS `v_comprobante00`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_comprobante00`  AS SELECT `pe`.`idpersonas` AS `idpersonas`, `pe`.`nombre` AS `nombre`, `pe`.`apellido` AS `apellido`, `pe`.`dni` AS `dni`, `pe`.`direccion` AS `direccion`, `pe`.`fecha_nacimiento` AS `fecha_nacimiento`, `pe`.`telefono` AS `telefono`, `pe`.`correo` AS `correo`, `pe`.`usuario` AS `usuario`, `pe`.`clave` AS `clave`, `pe`.`fecha_alta` AS `fecha_alta`, `pe`.`estados_idestados` AS `estados_idestados`, `pe`.`idsexos` AS `idsexos`, `pa`.`idtipo_paciente` AS `idtipo_paciente`, `t`.`tipo` AS `tipo`, `s`.`nombre` AS `sexo`, `cp`.`idpago` AS `idpago`, `cp`.`numero` AS `numero`, `cp`.`total` AS `total`, `cp`.`fecha` AS `fecha` FROM ((((`personas` `pe` join `paciente` `pa` on(`pa`.`idpersonas` = `pe`.`idpersonas`)) join `tipo_paciente` `t` on(`pa`.`idtipo_paciente` = `t`.`idtipo_paciente`)) join `sexos` `s` on(`pe`.`idsexos` = `s`.`idsexos`)) left join `comprobante_pago` `cp` on(`cp`.`idpersonas` = `pa`.`idpersonas`)) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_comprobantepresupuesto`
--
DROP TABLE IF EXISTS `v_comprobantepresupuesto`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_comprobantepresupuesto`  AS SELECT `vp`.`idpersonas` AS `idpersonas`, `vp`.`nombre` AS `nombre`, `vp`.`apellido` AS `apellido`, `vp`.`dni` AS `dni`, `vp`.`sexo` AS `sexo`, `vp`.`tipo` AS `tipo`, `cp`.`idpago` AS `idpago`, `cp`.`numero` AS `numero`, `cp`.`fecha` AS `fecha`, `cp`.`total` AS `total` FROM (`v_pacientes` `vp` left join `comprobante_pago` `cp` on(`vp`.`idpersonas` = `cp`.`idpersonas`)) WHERE `cp`.`idtipo_comprobantes` = 0 ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_estadisticapacientes`
--
DROP TABLE IF EXISTS `v_estadisticapacientes`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_estadisticapacientes`  AS SELECT `cp`.`idpersonas` AS `idpersonas`, sum(`cp`.`total`) AS `monto`, count(`cp`.`idpago`) AS `cantidad` FROM `comprobante_pago` AS `cp` GROUP BY `cp`.`idpersonas` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_estadisticas_citas`
--
DROP TABLE IF EXISTS `v_estadisticas_citas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_estadisticas_citas`  AS SELECT `citas`.`idpaciente` AS `idpaciente`, count(`citas`.`idpaciente`) AS `cantidad` FROM `citas` GROUP BY `citas`.`idpaciente` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_historias_clinicas`
--
DROP TABLE IF EXISTS `v_historias_clinicas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_historias_clinicas`  AS SELECT `hc`.`idhistorias_clinicas` AS `idhistorias_clinicas`, `hc`.`fecha` AS `fecha`, `hc`.`observaciones` AS `observaciones`, `hc`.`idpaciente` AS `idpaciente`, `hc`.`iddoctor` AS `iddoctor`, `hc`.`enfermedades` AS `enfermedades`, `hc`.`alergias` AS `alergias`, `hc`.`presion` AS `presion`, `hc`.`sensibilidad` AS `sensibilidad`, `hc`.`temperatura` AS `temperatura`, `hc`.`gestacion` AS `gestacion`, `p`.`nombre` AS `nomPaciente`, `p`.`apellido` AS `apePaciente`, `p`.`dni` AS `dni`, `p`.`direccion` AS `direccion`, `p`.`telefono` AS `telefono`, `p`.`fecha_nacimiento` AS `fecha_nacimiento`, `p`.`sexo` AS `sexo`, `p`.`tipo` AS `tipo`, `d`.`nombre` AS `nomDoctor`, `d`.`apellido` AS `apeDoctor`, `d`.`colegiatura` AS `colegiatura` FROM ((`historias_clinicas` `hc` join `v_pacientes` `p` on(`hc`.`idpaciente` = `p`.`idpersonas`)) join `v_personal01` `d` on(`hc`.`iddoctor` = `d`.`idpersonas`)) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_pacientes`
--
DROP TABLE IF EXISTS `v_pacientes`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pacientes`  AS SELECT `pe`.`idpersonas` AS `idpersonas`, `pe`.`nombre` AS `nombre`, `pe`.`apellido` AS `apellido`, `pe`.`dni` AS `dni`, `pe`.`direccion` AS `direccion`, `pe`.`fecha_nacimiento` AS `fecha_nacimiento`, `pe`.`telefono` AS `telefono`, `pe`.`correo` AS `correo`, `pe`.`usuario` AS `usuario`, `pe`.`clave` AS `clave`, `pe`.`fecha_alta` AS `fecha_alta`, `pe`.`estados_idestados` AS `estados_idestados`, `pe`.`idsexos` AS `idsexos`, `pa`.`idtipo_paciente` AS `idtipo_paciente`, `t`.`tipo` AS `tipo`, `s`.`nombre` AS `sexo` FROM (((`personas` `pe` join `paciente` `pa` on(`pa`.`idpersonas` = `pe`.`idpersonas`)) join `tipo_paciente` `t` on(`pa`.`idtipo_paciente` = `t`.`idtipo_paciente`)) join `sexos` `s` on(`pe`.`idsexos` = `s`.`idsexos`)) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_personal`
--
DROP TABLE IF EXISTS `v_personal`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_personal`  AS SELECT `personal`.`idpersonas` AS `idpersonas`, `personal`.`colegiatura` AS `colegiatura`, `personal`.`idtipo` AS `idtipo`, `tipo_personal`.`tipo` AS `tipo` FROM (`personal` join `tipo_personal` on(`personal`.`idtipo` = `tipo_personal`.`idtipo`)) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_personal01`
--
DROP TABLE IF EXISTS `v_personal01`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_personal01`  AS SELECT `personas`.`idpersonas` AS `idpersonas`, `personas`.`nombre` AS `nombre`, `personas`.`apellido` AS `apellido`, `personal`.`colegiatura` AS `colegiatura`, `tipo_personal`.`tipo` AS `tipo` FROM ((`personal` join `tipo_personal` on(`personal`.`idtipo` = `tipo_personal`.`idtipo`)) join `personas` on(`personal`.`idpersonas` = `personas`.`idpersonas`)) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_siguienteidpersona`
--
DROP TABLE IF EXISTS `v_siguienteidpersona`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_siguienteidpersona`  AS SELECT max(`personas`.`idpersonas`) + 1 AS `siguiente` FROM `personas` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_ticketspago`
--
DROP TABLE IF EXISTS `v_ticketspago`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_ticketspago`  AS SELECT `cp`.`idpago` AS `idpago`, `cp`.`numero` AS `numero`, `cp`.`fecha` AS `fecha`, `cp`.`total` AS `total`, `cp`.`idcomprobante` AS `idcomprobante`, `cp`.`idtipo_comprobantes` AS `idtipo_comprobantes`, `cp`.`idpagos` AS `idpagos`, `cp`.`idpersonas` AS `idpersonas`, `cp`.`idpersonas1` AS `idpersonas1`, `dc`.`precio` AS `precio`, `dc`.`cantidad` AS `cantidad`, `dc`.`idservicio` AS `idservicio`, `so`.`nombre` AS `nombreServicio`, `so`.`descripcion` AS `descripcion`, `pe`.`nombre` AS `nombrePaciente`, `pe`.`apellido` AS `apellidoPaciente`, `pe`.`dni` AS `dni` FROM ((((`comprobante_pago` `cp` join `detalles_comprobante` `dc` on(`dc`.`idpago` = `cp`.`idpago`)) join `servicios_odontologicos` `so` on(`so`.`idservicio` = `dc`.`idservicio`)) join `paciente` `p` on(`p`.`idpersonas` = `cp`.`idpersonas`)) join `personas` `pe` on(`pe`.`idpersonas` = `p`.`idpersonas`)) ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `auditoria`
--
ALTER TABLE `auditoria`
  ADD PRIMARY KEY (`idauditoria`);

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`idcitas`),
  ADD KEY `fk_citas_estados1_idx` (`idestados`),
  ADD KEY `fk_citas_paciente1_idx` (`idpaciente`),
  ADD KEY `fk_citas_personal1_idx` (`idpersonal`);

--
-- Indices de la tabla `comprobante_pago`
--
ALTER TABLE `comprobante_pago`
  ADD PRIMARY KEY (`idpago`),
  ADD KEY `fk_comprobante_pago_estados_comprobante1_idx` (`idcomprobante`),
  ADD KEY `fk_comprobante_pago_tipo_comprobantes1_idx` (`idtipo_comprobantes`),
  ADD KEY `fk_comprobante_pago_formas_pagos1_idx` (`idpagos`),
  ADD KEY `fk_comprobante_pago_paciente1_idx` (`idpersonas`),
  ADD KEY `fk_comprobante_pago_personal1_idx` (`idpersonas1`);

--
-- Indices de la tabla `detalles_comprobante`
--
ALTER TABLE `detalles_comprobante`
  ADD PRIMARY KEY (`iddetalles_comprobante`),
  ADD KEY `fk_detalles_comprobante_comprobante_pago1_idx` (`idpago`),
  ADD KEY `fk_detalles_comprobante_servicios_odontologicos1_idx` (`idservicio`);

--
-- Indices de la tabla `dientes`
--
ALTER TABLE `dientes`
  ADD PRIMARY KEY (`iddientes`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`idestados`);

--
-- Indices de la tabla `estados_comprobante`
--
ALTER TABLE `estados_comprobante`
  ADD PRIMARY KEY (`idcomprobante`);

--
-- Indices de la tabla `estado_dental`
--
ALTER TABLE `estado_dental`
  ADD PRIMARY KEY (`idestado_dental`);

--
-- Indices de la tabla `formas_pagos`
--
ALTER TABLE `formas_pagos`
  ADD PRIMARY KEY (`idpagos`);

--
-- Indices de la tabla `historias_clinicas`
--
ALTER TABLE `historias_clinicas`
  ADD PRIMARY KEY (`idhistorias_clinicas`),
  ADD KEY `fk_historias_clinicas_paciente1_idx` (`idpaciente`),
  ADD KEY `fk_historias_clinicas_personal1_idx` (`iddoctor`);

--
-- Indices de la tabla `odontogramas`
--
ALTER TABLE `odontogramas`
  ADD PRIMARY KEY (`idodontogramas`),
  ADD KEY `fk_odontogramas_historias_clinicas1_idx` (`idhistorias_clinicas`),
  ADD KEY `fk_odontogramas_estado_dental1_idx` (`idestado_dental`),
  ADD KEY `fk_odontogramas_dientes1_idx` (`iddientes`);

--
-- Indices de la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`idpersonas`),
  ADD KEY `fk_paciente_tipo_paciente1_idx` (`idtipo_paciente`);

--
-- Indices de la tabla `personal`
--
ALTER TABLE `personal`
  ADD PRIMARY KEY (`idpersonas`),
  ADD KEY `fk_personal_tipo_personal1_idx` (`idtipo`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`idpersonas`),
  ADD KEY `fk_personas_estados1_idx` (`estados_idestados`),
  ADD KEY `fk_personas_sexos1_idx` (`idsexos`);

--
-- Indices de la tabla `servicios_odontologicos`
--
ALTER TABLE `servicios_odontologicos`
  ADD PRIMARY KEY (`idservicio`);

--
-- Indices de la tabla `sesion_profilaxis`
--
ALTER TABLE `sesion_profilaxis`
  ADD PRIMARY KEY (`idsesion_profilaxis`),
  ADD KEY `fk_sesion_profilaxis_historias_clinicas1_idx` (`idhistorias_clinicas`);

--
-- Indices de la tabla `sexos`
--
ALTER TABLE `sexos`
  ADD PRIMARY KEY (`idsexos`);

--
-- Indices de la tabla `tipo_comprobantes`
--
ALTER TABLE `tipo_comprobantes`
  ADD PRIMARY KEY (`idtipo_comprobantes`);

--
-- Indices de la tabla `tipo_paciente`
--
ALTER TABLE `tipo_paciente`
  ADD PRIMARY KEY (`idtipo_paciente`);

--
-- Indices de la tabla `tipo_personal`
--
ALTER TABLE `tipo_personal`
  ADD PRIMARY KEY (`idtipo`);

--
-- Indices de la tabla `tratamiento`
--
ALTER TABLE `tratamiento`
  ADD PRIMARY KEY (`idtratamiento`),
  ADD KEY `fk_tratamiento_odontogramas1_idx` (`idodontogramas`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `auditoria`
--
ALTER TABLE `auditoria`
  MODIFY `idauditoria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `idcitas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `comprobante_pago`
--
ALTER TABLE `comprobante_pago`
  MODIFY `idpago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `detalles_comprobante`
--
ALTER TABLE `detalles_comprobante`
  MODIFY `iddetalles_comprobante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `dientes`
--
ALTER TABLE `dientes`
  MODIFY `iddientes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `idestados` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `estados_comprobante`
--
ALTER TABLE `estados_comprobante`
  MODIFY `idcomprobante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `estado_dental`
--
ALTER TABLE `estado_dental`
  MODIFY `idestado_dental` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `formas_pagos`
--
ALTER TABLE `formas_pagos`
  MODIFY `idpagos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `historias_clinicas`
--
ALTER TABLE `historias_clinicas`
  MODIFY `idhistorias_clinicas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `odontogramas`
--
ALTER TABLE `odontogramas`
  MODIFY `idodontogramas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `idpersonas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `servicios_odontologicos`
--
ALTER TABLE `servicios_odontologicos`
  MODIFY `idservicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `sesion_profilaxis`
--
ALTER TABLE `sesion_profilaxis`
  MODIFY `idsesion_profilaxis` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sexos`
--
ALTER TABLE `sexos`
  MODIFY `idsexos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipo_comprobantes`
--
ALTER TABLE `tipo_comprobantes`
  MODIFY `idtipo_comprobantes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tipo_paciente`
--
ALTER TABLE `tipo_paciente`
  MODIFY `idtipo_paciente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_personal`
--
ALTER TABLE `tipo_personal`
  MODIFY `idtipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tratamiento`
--
ALTER TABLE `tratamiento`
  MODIFY `idtratamiento` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `fk_citas_estados1` FOREIGN KEY (`idestados`) REFERENCES `estados` (`idestados`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_citas_paciente1` FOREIGN KEY (`idpaciente`) REFERENCES `paciente` (`idpersonas`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_citas_personal1` FOREIGN KEY (`idpersonal`) REFERENCES `personal` (`idpersonas`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `comprobante_pago`
--
ALTER TABLE `comprobante_pago`
  ADD CONSTRAINT `fk_comprobante_pago_estados_comprobante1` FOREIGN KEY (`idcomprobante`) REFERENCES `estados_comprobante` (`idcomprobante`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_comprobante_pago_formas_pagos1` FOREIGN KEY (`idpagos`) REFERENCES `formas_pagos` (`idpagos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_comprobante_pago_paciente1` FOREIGN KEY (`idpersonas`) REFERENCES `paciente` (`idpersonas`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_comprobante_pago_personal1` FOREIGN KEY (`idpersonas1`) REFERENCES `personal` (`idpersonas`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_comprobante_pago_tipo_comprobantes1` FOREIGN KEY (`idtipo_comprobantes`) REFERENCES `tipo_comprobantes` (`idtipo_comprobantes`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalles_comprobante`
--
ALTER TABLE `detalles_comprobante`
  ADD CONSTRAINT `fk_detalles_comprobante_comprobante_pago1` FOREIGN KEY (`idpago`) REFERENCES `comprobante_pago` (`idpago`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalles_comprobante_servicios_odontologicos1` FOREIGN KEY (`idservicio`) REFERENCES `servicios_odontologicos` (`idservicio`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `historias_clinicas`
--
ALTER TABLE `historias_clinicas`
  ADD CONSTRAINT `fk_historias_clinicas_paciente1` FOREIGN KEY (`idpaciente`) REFERENCES `paciente` (`idpersonas`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_historias_clinicas_personal1` FOREIGN KEY (`iddoctor`) REFERENCES `personal` (`idpersonas`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `odontogramas`
--
ALTER TABLE `odontogramas`
  ADD CONSTRAINT `fk_odontogramas_dientes1` FOREIGN KEY (`iddientes`) REFERENCES `dientes` (`iddientes`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_odontogramas_estado_dental1` FOREIGN KEY (`idestado_dental`) REFERENCES `estado_dental` (`idestado_dental`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_odontogramas_historias_clinicas1` FOREIGN KEY (`idhistorias_clinicas`) REFERENCES `historias_clinicas` (`idhistorias_clinicas`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD CONSTRAINT `fk_paciente_personas1` FOREIGN KEY (`idpersonas`) REFERENCES `personas` (`idpersonas`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_paciente_tipo_paciente1` FOREIGN KEY (`idtipo_paciente`) REFERENCES `tipo_paciente` (`idtipo_paciente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `personal`
--
ALTER TABLE `personal`
  ADD CONSTRAINT `fk_personal_personas1` FOREIGN KEY (`idpersonas`) REFERENCES `personas` (`idpersonas`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_personal_tipo_personal1` FOREIGN KEY (`idtipo`) REFERENCES `tipo_personal` (`idtipo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `personas`
--
ALTER TABLE `personas`
  ADD CONSTRAINT `fk_personas_estados1` FOREIGN KEY (`estados_idestados`) REFERENCES `estados` (`idestados`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_personas_sexos1` FOREIGN KEY (`idsexos`) REFERENCES `sexos` (`idsexos`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `sesion_profilaxis`
--
ALTER TABLE `sesion_profilaxis`
  ADD CONSTRAINT `fk_sesion_profilaxis_historias_clinicas1` FOREIGN KEY (`idhistorias_clinicas`) REFERENCES `historias_clinicas` (`idhistorias_clinicas`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tratamiento`
--
ALTER TABLE `tratamiento`
  ADD CONSTRAINT `fk_tratamiento_odontogramas1` FOREIGN KEY (`idodontogramas`) REFERENCES `odontogramas` (`idodontogramas`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
