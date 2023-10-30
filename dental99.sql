-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-10-2023 a las 22:47:04
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`idcitas`, `fecha`, `observaciones`, `idestados`, `idpaciente`, `idpersonal`) VALUES
(2, '2023-10-21 17:04:23', 'n', 2, 2, 4),
(5, '2023-10-22 08:00:00', ' limpieza ', 1, 2, 4),
(6, '2023-10-23 10:00:00', 'dolor de muela', 1, 2, 4),
(7, '2023-10-23 10:00:00', 'dolor de muela', 1, 2, 4),
(12, '2023-10-24 08:00:00', 'Endodoncia ', 1, 2, 4),
(13, '2023-10-24 08:00:00', ' limpieza de d', 1, 2, 4),
(14, '2023-10-24 08:00:00', ' limpieza de d', 1, 2, 4),
(15, '2023-10-24 08:00:00', ' limpieza de gggg', 1, 2, 4),
(17, '2023-09-28 14:30:27', 'n', 2, 3, 4),
(19, '2023-10-24 08:00:00', 'dolor de muelaaaaa', 1, 3, 4),
(20, '2023-10-27 10:00:00', 'endo', 1, 3, 4);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dientes`
--

CREATE TABLE `dientes` (
  `iddientes` int(11) NOT NULL,
  `ubicacion` int(11) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dientes`
--

INSERT INTO `dientes` (`iddientes`, `ubicacion`, `nombre`) VALUES
(1, 11, 'Incisivo central'),
(2, 21, 'Incisivo central'),
(3, 12, 'Incisivo lateral');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `idestados` int(11) NOT NULL,
  `nombre` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formas_pagos`
--

CREATE TABLE `formas_pagos` (
  `idpagos` int(11) NOT NULL,
  `forma` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `idpersonas` int(11) NOT NULL,
  `idpersonas1` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--

CREATE TABLE `paciente` (
  `idpersonas` int(11) NOT NULL,
  `idtipo_paciente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `paciente`
--

INSERT INTO `paciente` (`idpersonas`, `idtipo_paciente`) VALUES
(3, 1),
(1, 2),
(2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal`
--

CREATE TABLE `personal` (
  `idpersonas` int(11) NOT NULL,
  `colegiatura` varchar(9) DEFAULT NULL,
  `idtipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `personal`
--

INSERT INTO `personal` (`idpersonas`, `colegiatura`, `idtipo`) VALUES
(1, 'A-999', 1),
(4, '789', 2);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`idpersonas`, `nombre`, `apellido`, `dni`, `direccion`, `fecha_nacimiento`, `telefono`, `correo`, `usuario`, `clave`, `fecha_alta`, `estados_idestados`, `idsexos`) VALUES
(1, 'Carlitos', 'Flores', '12345678', 'Av. Bolivar 123', '2000-05-10', '95214578', 'carlitos@gmail.com', 'carlitos01', 'c3949ba59abbe560adc3949ba', '0000-00-00 00:00:00', 2, 3),
(2, 'Juan', 'Perez', '24578956', 'Balta 2332', '1998-10-10', '95587788', 'juan@gmail.com', 'juan', 'c3949ba59abbe560adc3949ba', '2023-09-11 00:00:00', 1, 2),
(3, 'Mario', 'Montero', '24589865', 'Las Bugambillas 332', '1985-05-15', '99985478', 'mario@gmail.com', 'mario', 'c3949ba59abbe560adc3949ba', '2023-09-11 00:00:00', 1, 2),
(4, 'Doctor', '', '', '', '0000-00-00', '', 'doctor@gmail.com', 'Doctor01', 'c3949ba59abbe560adc3949ba', '0000-00-00 00:00:00', 2, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios_odontologicos`
--

CREATE TABLE `servicios_odontologicos` (
  `idservicio` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  `precio` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sesion_profilaxis`
--

CREATE TABLE `sesion_profilaxis` (
  `idsesion_profilaxis` int(11) NOT NULL,
  `fecha` datetime DEFAULT NULL,
  `sesion` varchar(45) DEFAULT NULL,
  `idhistorias_clinicas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sexos`
--

CREATE TABLE `sexos` (
  `idsexos` int(11) NOT NULL,
  `nombre` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='	';

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_comprobantes`
--

INSERT INTO `tipo_comprobantes` (`idtipo_comprobantes`, `tipo`, `ultimo_numero`) VALUES
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Estructura para la vista `v_cita01`
--
DROP TABLE IF EXISTS `v_cita01`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_cita01`  AS SELECT `c`.`idcitas` AS `idcitas`, `c`.`fecha` AS `fecha`, `c`.`observaciones` AS `observaciones`, `c`.`idpaciente` AS `idpaciente`, `c`.`idpersonal` AS `idpersonal`, `pl`.`nombre` AS `NomPersonal`, `p`.`nombre` AS `NomPaciente`, `e`.`nombre` AS `NomEstado`, addtime(`c`.`fecha`,'00:30:00') AS `fin` FROM (((`citas` `c` join `estados` `e` on(`c`.`idestados` = `e`.`idestados`)) join `v_pacientes` `p` on(`c`.`idpaciente` = `p`.`idpersonas`)) join `v_personal01` `pl` on(`c`.`idpersonal` = `pl`.`idpersonas`)) ;

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
  ADD KEY `fk_historias_clinicas_paciente1_idx` (`idpersonas`),
  ADD KEY `fk_historias_clinicas_personal1_idx` (`idpersonas1`);

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
  MODIFY `idcitas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `comprobante_pago`
--
ALTER TABLE `comprobante_pago`
  MODIFY `idpago` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalles_comprobante`
--
ALTER TABLE `detalles_comprobante`
  MODIFY `iddetalles_comprobante` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `dientes`
--
ALTER TABLE `dientes`
  MODIFY `iddientes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `idhistorias_clinicas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `odontogramas`
--
ALTER TABLE `odontogramas`
  MODIFY `idodontogramas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `idpersonas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `servicios_odontologicos`
--
ALTER TABLE `servicios_odontologicos`
  MODIFY `idservicio` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `idtipo_comprobantes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  ADD CONSTRAINT `fk_historias_clinicas_paciente1` FOREIGN KEY (`idpersonas`) REFERENCES `paciente` (`idpersonas`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_historias_clinicas_personal1` FOREIGN KEY (`idpersonas1`) REFERENCES `personal` (`idpersonas`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
