-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema dental99
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `dental99` ;

-- -----------------------------------------------------
-- Schema dental99
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `dental99` DEFAULT CHARACTER SET utf8 ;
USE `dental99` ;

-- -----------------------------------------------------
-- Table `dental99`.`estados`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dental99`.`estados` ;

CREATE TABLE IF NOT EXISTS `dental99`.`estados` (
  `idestados` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(30) NULL,
  PRIMARY KEY (`idestados`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dental99`.`sexos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dental99`.`sexos` ;

CREATE TABLE IF NOT EXISTS `dental99`.`sexos` (
  `idsexos` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(20) NULL,
  PRIMARY KEY (`idsexos`))
ENGINE = InnoDB
COMMENT = '	';


-- -----------------------------------------------------
-- Table `dental99`.`personas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dental99`.`personas` ;

CREATE TABLE IF NOT EXISTS `dental99`.`personas` (
  `idpersonas` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL,
  `apellido` VARCHAR(45) NULL,
  `dni` VARCHAR(10) NULL,
  `direccion` VARCHAR(45) NULL,
  `fecha_nacimiento` DATE NULL,
  `telefono` VARCHAR(12) NULL,
  `correo` VARCHAR(76) NULL,
  `usuario` VARCHAR(45) NULL,
  `clave` VARCHAR(40) NULL,
  `fecha_alta` DATETIME NULL,
  `estados_idestados` INT NOT NULL,
  `idsexos` INT NOT NULL,
  PRIMARY KEY (`idpersonas`),
  INDEX `fk_personas_estados1_idx` (`estados_idestados` ASC) ,
  INDEX `fk_personas_sexos1_idx` (`idsexos` ASC) ,
  CONSTRAINT `fk_personas_estados1`
    FOREIGN KEY (`estados_idestados`)
    REFERENCES `dental99`.`estados` (`idestados`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_personas_sexos1`
    FOREIGN KEY (`idsexos`)
    REFERENCES `dental99`.`sexos` (`idsexos`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dental99`.`tipo_personal`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dental99`.`tipo_personal` ;

CREATE TABLE IF NOT EXISTS `dental99`.`tipo_personal` (
  `idtipo` INT NOT NULL AUTO_INCREMENT,
  `tipo` VARCHAR(45) NULL,
  PRIMARY KEY (`idtipo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dental99`.`personal`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dental99`.`personal` ;

CREATE TABLE IF NOT EXISTS `dental99`.`personal` (
  `idpersonas` INT NOT NULL,
  `colegiatura` VARCHAR(9) NULL,
  `idtipo` INT NOT NULL,
  PRIMARY KEY (`idpersonas`),
  INDEX `fk_personal_tipo_personal1_idx` (`idtipo` ASC) ,
  CONSTRAINT `fk_personal_personas1`
    FOREIGN KEY (`idpersonas`)
    REFERENCES `dental99`.`personas` (`idpersonas`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_personal_tipo_personal1`
    FOREIGN KEY (`idtipo`)
    REFERENCES `dental99`.`tipo_personal` (`idtipo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dental99`.`tipo_paciente`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dental99`.`tipo_paciente` ;

CREATE TABLE IF NOT EXISTS `dental99`.`tipo_paciente` (
  `idtipo_paciente` INT NOT NULL AUTO_INCREMENT,
  `tipo` VARCHAR(10) NULL,
  `cantidad_dientes` INT NULL,
  PRIMARY KEY (`idtipo_paciente`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dental99`.`paciente`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dental99`.`paciente` ;

CREATE TABLE IF NOT EXISTS `dental99`.`paciente` (
  `idpersonas` INT NOT NULL,
  `idtipo_paciente` INT NOT NULL,
  PRIMARY KEY (`idpersonas`),
  INDEX `fk_paciente_tipo_paciente1_idx` (`idtipo_paciente` ASC) ,
  CONSTRAINT `fk_paciente_personas1`
    FOREIGN KEY (`idpersonas`)
    REFERENCES `dental99`.`personas` (`idpersonas`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_paciente_tipo_paciente1`
    FOREIGN KEY (`idtipo_paciente`)
    REFERENCES `dental99`.`tipo_paciente` (`idtipo_paciente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dental99`.`historias_clinicas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dental99`.`historias_clinicas` ;

CREATE TABLE IF NOT EXISTS `dental99`.`historias_clinicas` (
  `idhistorias_clinicas` INT NOT NULL AUTO_INCREMENT,
  `fecha` DATETIME NULL,
  `observaciones` VARCHAR(120) NULL,
  `personal_idpersonal` INT NOT NULL,
  `paciente_idpaciente` INT NOT NULL,
  `idpersonas` INT NOT NULL,
  `idpersonas1` INT NOT NULL,
  PRIMARY KEY (`idhistorias_clinicas`),
  INDEX `fk_historias_clinicas_paciente1_idx` (`idpersonas` ASC) ,
  INDEX `fk_historias_clinicas_personal1_idx` (`idpersonas1` ASC) ,
  CONSTRAINT `fk_historias_clinicas_paciente1`
    FOREIGN KEY (`idpersonas`)
    REFERENCES `dental99`.`paciente` (`idpersonas`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_historias_clinicas_personal1`
    FOREIGN KEY (`idpersonas1`)
    REFERENCES `dental99`.`personal` (`idpersonas`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dental99`.`citas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dental99`.`citas` ;

CREATE TABLE IF NOT EXISTS `dental99`.`citas` (
  `idcitas` INT NOT NULL AUTO_INCREMENT,
  `fecha` DATETIME NULL,
  `paciente_idpaciente` INT NOT NULL,
  `personal_idpersonal` INT NOT NULL,
  `observaciones` VARCHAR(250) NULL,
  `idestados` INT NOT NULL,
  PRIMARY KEY (`idcitas`),
  INDEX `fk_citas_estados1_idx` (`idestados` ASC) ,
  CONSTRAINT `fk_citas_estados1`
    FOREIGN KEY (`idestados`)
    REFERENCES `dental99`.`estados` (`idestados`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dental99`.`formas_pagos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dental99`.`formas_pagos` ;

CREATE TABLE IF NOT EXISTS `dental99`.`formas_pagos` (
  `idpagos` INT NOT NULL AUTO_INCREMENT,
  `forma` VARCHAR(45) NULL,
  PRIMARY KEY (`idpagos`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dental99`.`estados_comprobante`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dental99`.`estados_comprobante` ;

CREATE TABLE IF NOT EXISTS `dental99`.`estados_comprobante` (
  `idcomprobante` INT NOT NULL AUTO_INCREMENT,
  `estado` VARCHAR(45) NULL,
  PRIMARY KEY (`idcomprobante`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dental99`.`tipo_comprobantes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dental99`.`tipo_comprobantes` ;

CREATE TABLE IF NOT EXISTS `dental99`.`tipo_comprobantes` (
  `idtipo_comprobantes` INT NOT NULL AUTO_INCREMENT,
  `tipo` VARCHAR(45) NULL,
  `ultimo_numero` VARCHAR(20) NULL,
  PRIMARY KEY (`idtipo_comprobantes`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dental99`.`comprobante_pago`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dental99`.`comprobante_pago` ;

CREATE TABLE IF NOT EXISTS `dental99`.`comprobante_pago` (
  `idpago` INT NOT NULL AUTO_INCREMENT,
  `numero` VARCHAR(20) NULL,
  `fecha` DATETIME NULL,
  `total` DECIMAL(12,2) NULL,
  `idcomprobante` INT NOT NULL,
  `idtipo_comprobantes` INT NOT NULL,
  `idpagos` INT NOT NULL,
  `idpersonas` INT NOT NULL,
  `idpersonas1` INT NOT NULL,
  PRIMARY KEY (`idpago`),
  INDEX `fk_comprobante_pago_estados_comprobante1_idx` (`idcomprobante` ASC) ,
  INDEX `fk_comprobante_pago_tipo_comprobantes1_idx` (`idtipo_comprobantes` ASC) ,
  INDEX `fk_comprobante_pago_formas_pagos1_idx` (`idpagos` ASC) ,
  INDEX `fk_comprobante_pago_paciente1_idx` (`idpersonas` ASC) ,
  INDEX `fk_comprobante_pago_personal1_idx` (`idpersonas1` ASC) ,
  CONSTRAINT `fk_comprobante_pago_estados_comprobante1`
    FOREIGN KEY (`idcomprobante`)
    REFERENCES `dental99`.`estados_comprobante` (`idcomprobante`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_comprobante_pago_tipo_comprobantes1`
    FOREIGN KEY (`idtipo_comprobantes`)
    REFERENCES `dental99`.`tipo_comprobantes` (`idtipo_comprobantes`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_comprobante_pago_formas_pagos1`
    FOREIGN KEY (`idpagos`)
    REFERENCES `dental99`.`formas_pagos` (`idpagos`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_comprobante_pago_paciente1`
    FOREIGN KEY (`idpersonas`)
    REFERENCES `dental99`.`paciente` (`idpersonas`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_comprobante_pago_personal1`
    FOREIGN KEY (`idpersonas1`)
    REFERENCES `dental99`.`personal` (`idpersonas`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dental99`.`servicios_odontologicos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dental99`.`servicios_odontologicos` ;

CREATE TABLE IF NOT EXISTS `dental99`.`servicios_odontologicos` (
  `idservicio` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL,
  `descripcion` VARCHAR(250) NULL,
  `precio` DOUBLE NULL,
  PRIMARY KEY (`idservicio`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dental99`.`detalles_comprobante`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dental99`.`detalles_comprobante` ;

CREATE TABLE IF NOT EXISTS `dental99`.`detalles_comprobante` (
  `iddetalles_comprobante` INT NOT NULL AUTO_INCREMENT,
  `precio` DECIMAL(12,2) NULL,
  `descuento` DECIMAL(12,2) NULL,
  `cantidad` INT NULL,
  `igv` DECIMAL(12,2) NULL,
  `idpago` INT NOT NULL,
  `idservicio` INT NOT NULL,
  PRIMARY KEY (`iddetalles_comprobante`),
  INDEX `fk_detalles_comprobante_comprobante_pago1_idx` (`idpago` ASC) ,
  INDEX `fk_detalles_comprobante_servicios_odontologicos1_idx` (`idservicio` ASC) ,
  CONSTRAINT `fk_detalles_comprobante_comprobante_pago1`
    FOREIGN KEY (`idpago`)
    REFERENCES `dental99`.`comprobante_pago` (`idpago`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_detalles_comprobante_servicios_odontologicos1`
    FOREIGN KEY (`idservicio`)
    REFERENCES `dental99`.`servicios_odontologicos` (`idservicio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dental99`.`estado_dental`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dental99`.`estado_dental` ;

CREATE TABLE IF NOT EXISTS `dental99`.`estado_dental` (
  `idestado_dental` INT NOT NULL AUTO_INCREMENT,
  `icono` VARCHAR(45) NULL,
  `descripcion` VARCHAR(120) NULL,
  `color` VARCHAR(20) NULL,
  PRIMARY KEY (`idestado_dental`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dental99`.`dientes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dental99`.`dientes` ;

CREATE TABLE IF NOT EXISTS `dental99`.`dientes` (
  `iddientes` INT NOT NULL AUTO_INCREMENT,
  `ubicacion` INT NULL,
  `nombre` VARCHAR(15) NULL,
  PRIMARY KEY (`iddientes`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dental99`.`odontogramas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dental99`.`odontogramas` ;

CREATE TABLE IF NOT EXISTS `dental99`.`odontogramas` (
  `idodontogramas` INT NOT NULL AUTO_INCREMENT,
  `observaciones` VARCHAR(250) NULL,
  `placa` VARCHAR(100) NULL,
  `idhistorias_clinicas` INT NOT NULL,
  `idestado_dental` INT NOT NULL,
  `iddientes` INT NOT NULL,
  PRIMARY KEY (`idodontogramas`),
  INDEX `fk_odontogramas_historias_clinicas1_idx` (`idhistorias_clinicas` ASC) ,
  INDEX `fk_odontogramas_estado_dental1_idx` (`idestado_dental` ASC) ,
  INDEX `fk_odontogramas_dientes1_idx` (`iddientes` ASC) ,
  CONSTRAINT `fk_odontogramas_historias_clinicas1`
    FOREIGN KEY (`idhistorias_clinicas`)
    REFERENCES `dental99`.`historias_clinicas` (`idhistorias_clinicas`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_odontogramas_estado_dental1`
    FOREIGN KEY (`idestado_dental`)
    REFERENCES `dental99`.`estado_dental` (`idestado_dental`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_odontogramas_dientes1`
    FOREIGN KEY (`iddientes`)
    REFERENCES `dental99`.`dientes` (`iddientes`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dental99`.`tratamiento`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dental99`.`tratamiento` ;

CREATE TABLE IF NOT EXISTS `dental99`.`tratamiento` (
  `idtratamiento` INT NOT NULL AUTO_INCREMENT,
  `fecha` DATETIME NULL,
  `tratamiento` VARCHAR(45) NULL,
  `idodontogramas` INT NOT NULL,
  PRIMARY KEY (`idtratamiento`),
  INDEX `fk_tratamiento_odontogramas1_idx` (`idodontogramas` ASC) ,
  CONSTRAINT `fk_tratamiento_odontogramas1`
    FOREIGN KEY (`idodontogramas`)
    REFERENCES `dental99`.`odontogramas` (`idodontogramas`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dental99`.`sesion_profilaxis`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dental99`.`sesion_profilaxis` ;

CREATE TABLE IF NOT EXISTS `dental99`.`sesion_profilaxis` (
  `idsesion_profilaxis` INT NOT NULL AUTO_INCREMENT,
  `fecha` DATETIME NULL,
  `sesion` VARCHAR(45) NULL,
  `idhistorias_clinicas` INT NOT NULL,
  PRIMARY KEY (`idsesion_profilaxis`),
  INDEX `fk_sesion_profilaxis_historias_clinicas1_idx` (`idhistorias_clinicas` ASC) ,
  CONSTRAINT `fk_sesion_profilaxis_historias_clinicas1`
    FOREIGN KEY (`idhistorias_clinicas`)
    REFERENCES `dental99`.`historias_clinicas` (`idhistorias_clinicas`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dental99`.`auditoria`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dental99`.`auditoria` ;

CREATE TABLE IF NOT EXISTS `dental99`.`auditoria` (
  `idauditoria` INT NOT NULL AUTO_INCREMENT,
  `tabla` VARCHAR(45) NULL,
  `data_new` JSON NULL,
  `data_old` JSON NULL,
  `usuario` VARCHAR(45) NULL,
  `ip` VARCHAR(45) NULL,
  `fecha` DATETIME NULL,
  `operacion` VARCHAR(45) NULL,
  PRIMARY KEY (`idauditoria`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `dental99`.`estados`
-- -----------------------------------------------------
START TRANSACTION;
USE `dental99`;
INSERT INTO `dental99`.`estados` (`idestados`, `nombre`) VALUES (1, 'Pendiente');
INSERT INTO `dental99`.`estados` (`idestados`, `nombre`) VALUES (2, 'Activo(a)');
INSERT INTO `dental99`.`estados` (`idestados`, `nombre`) VALUES (3, 'Anulado(a)');

COMMIT;


-- -----------------------------------------------------
-- Data for table `dental99`.`sexos`
-- -----------------------------------------------------
START TRANSACTION;
USE `dental99`;
INSERT INTO `dental99`.`sexos` (`idsexos`, `nombre`) VALUES (1, 'FEMENINO');
INSERT INTO `dental99`.`sexos` (`idsexos`, `nombre`) VALUES (2, 'MASCULINO');
INSERT INTO `dental99`.`sexos` (`idsexos`, `nombre`) VALUES (3, 'PREFIERO NO DECIRLO');

COMMIT;


-- -----------------------------------------------------
-- Data for table `dental99`.`personas`
-- -----------------------------------------------------
START TRANSACTION;
USE `dental99`;
INSERT INTO `dental99`.`personas` (`idpersonas`, `nombre`, `apellido`, `dni`, `direccion`, `fecha_nacimiento`, `telefono`, `correo`, `usuario`, `clave`, `fecha_alta`, `estados_idestados`, `idsexos`) VALUES (1, 'Carlitos', 'Flores', '12345678', 'Av. Bolivar 123', '2000/05/10', '95214578', 'carlitos@gmail.com', 'carlitos', '123456', '2023/08/08', 1, 2);

COMMIT;


-- -----------------------------------------------------
-- Data for table `dental99`.`tipo_personal`
-- -----------------------------------------------------
START TRANSACTION;
USE `dental99`;
INSERT INTO `dental99`.`tipo_personal` (`idtipo`, `tipo`) VALUES (1, 'ADMINISTRADOR');
INSERT INTO `dental99`.`tipo_personal` (`idtipo`, `tipo`) VALUES (2, 'DOCTOR');
INSERT INTO `dental99`.`tipo_personal` (`idtipo`, `tipo`) VALUES (3, 'ASISTENTE');

COMMIT;


-- -----------------------------------------------------
-- Data for table `dental99`.`personal`
-- -----------------------------------------------------
START TRANSACTION;
USE `dental99`;
INSERT INTO `dental99`.`personal` (`idpersonas`, `colegiatura`, `idtipo`) VALUES (1, 'A-999', 1);

COMMIT;


-- -----------------------------------------------------
-- Data for table `dental99`.`tipo_paciente`
-- -----------------------------------------------------
START TRANSACTION;
USE `dental99`;
INSERT INTO `dental99`.`tipo_paciente` (`idtipo_paciente`, `tipo`, `cantidad_dientes`) VALUES (1, 'NIÑOS', 20);
INSERT INTO `dental99`.`tipo_paciente` (`idtipo_paciente`, `tipo`, `cantidad_dientes`) VALUES (2, 'ADULTO', 32);

COMMIT;


-- -----------------------------------------------------
-- Data for table `dental99`.`formas_pagos`
-- -----------------------------------------------------
START TRANSACTION;
USE `dental99`;
INSERT INTO `dental99`.`formas_pagos` (`idpagos`, `forma`) VALUES (1, 'EFECTIVO');
INSERT INTO `dental99`.`formas_pagos` (`idpagos`, `forma`) VALUES (2, 'TARJETA');

COMMIT;


-- -----------------------------------------------------
-- Data for table `dental99`.`estados_comprobante`
-- -----------------------------------------------------
START TRANSACTION;
USE `dental99`;
INSERT INTO `dental99`.`estados_comprobante` (`idcomprobante`, `estado`) VALUES (1, 'PAGADO');
INSERT INTO `dental99`.`estados_comprobante` (`idcomprobante`, `estado`) VALUES (2, 'ANULADO');
INSERT INTO `dental99`.`estados_comprobante` (`idcomprobante`, `estado`) VALUES (3, 'PENDIENTE PAGO');

COMMIT;


-- -----------------------------------------------------
-- Data for table `dental99`.`tipo_comprobantes`
-- -----------------------------------------------------
START TRANSACTION;
USE `dental99`;
INSERT INTO `dental99`.`tipo_comprobantes` (`idtipo_comprobantes`, `tipo`, `ultimo_numero`) VALUES (1, 'FACTURA', '1');
INSERT INTO `dental99`.`tipo_comprobantes` (`idtipo_comprobantes`, `tipo`, `ultimo_numero`) VALUES (2, 'BOLETA', '1');
INSERT INTO `dental99`.`tipo_comprobantes` (`idtipo_comprobantes`, `tipo`, `ultimo_numero`) VALUES (3, 'RECIBO', '1');

COMMIT;

