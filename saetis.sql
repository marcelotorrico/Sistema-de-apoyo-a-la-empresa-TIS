-- MySQL Script generated by MySQL Workbench
-- 11/09/14 11:03:07
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema saetis
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema saetis
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `saetis` DEFAULT CHARACTER SET latin1 ;
-- -----------------------------------------------------
-- Schema new_schema1
-- -----------------------------------------------------
USE `saetis` ;

-- -----------------------------------------------------
-- Table `saetis`.`aplicacion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `saetis`.`aplicacion` (
  `APLICACION_A` VARCHAR(50) NOT NULL,
  PRIMARY KEY USING BTREE (`APLICACION_A`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `saetis`.`estado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `saetis`.`estado` (
  `ESTADO_E` VARCHAR(50) NOT NULL,
  PRIMARY KEY USING BTREE (`ESTADO_E`))
ENGINE = InnoDB
AVG_ROW_LENGTH = 8192
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `saetis`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `saetis`.`usuario` (
  `NOMBRE_U` VARCHAR(50) NOT NULL,
  `ESTADO_E` VARCHAR(50) NOT NULL,
  `PASSWORD_U` VARCHAR(50) NOT NULL,
  `TELEFONO_U` VARCHAR(8) NOT NULL,
  `CORREO_ELECTRONICO_U` VARCHAR(50) NOT NULL,
  PRIMARY KEY USING BTREE (`NOMBRE_U`),
  INDEX `FK_ESTADO__USUARIO` USING BTREE (`ESTADO_E` ASC),
  CONSTRAINT `FK_ESTADO__USUARIO`
    FOREIGN KEY (`ESTADO_E`)
    REFERENCES `saetis`.`estado` (`ESTADO_E`))
ENGINE = InnoDB
AVG_ROW_LENGTH = 2048
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `saetis`.`asesor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `saetis`.`asesor` (
  `NOMBRE_U` VARCHAR(50) NOT NULL,
  `NOMBRES_A` VARCHAR(50) NOT NULL,
  `APELLIDOS_A` VARCHAR(50) NOT NULL,
  PRIMARY KEY USING BTREE (`NOMBRE_U`),
  CONSTRAINT `FK_USUARIO__ASESOR`
    FOREIGN KEY (`NOMBRE_U`)
    REFERENCES `saetis`.`usuario` (`NOMBRE_U`))
ENGINE = InnoDB
AVG_ROW_LENGTH = 4096
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `saetis`.`tipo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `saetis`.`tipo` (
  `TIPO_T` VARCHAR(50) NOT NULL,
  PRIMARY KEY USING BTREE (`TIPO_T`))
ENGINE = InnoDB
AVG_ROW_LENGTH = 8192
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `saetis`.`registro`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `saetis`.`registro` (
  `ID_R` INT(11) NOT NULL AUTO_INCREMENT,
  `NOMBRE_U` VARCHAR(50) NOT NULL,
  `TIPO_T` VARCHAR(50) NOT NULL,
  `ESTADO_E` VARCHAR(50) NOT NULL,
  `NOMBRE_R` VARCHAR(50) NOT NULL,
  `FECHA_R` DATE NOT NULL,
  `HORA_R` TIME NOT NULL,
  PRIMARY KEY USING BTREE (`ID_R`),
  INDEX `FK_ESTADO__REGISTRO` USING BTREE (`ESTADO_E` ASC),
  INDEX `FK_TIPO__REGISTRO` USING BTREE (`TIPO_T` ASC),
  INDEX `FK_USUARIO_REGISTRO` USING BTREE (`NOMBRE_U` ASC),
  CONSTRAINT `FK_ESTADO__REGISTRO`
    FOREIGN KEY (`ESTADO_E`)
    REFERENCES `saetis`.`estado` (`ESTADO_E`),
  CONSTRAINT `FK_TIPO__REGISTRO`
    FOREIGN KEY (`TIPO_T`)
    REFERENCES `saetis`.`tipo` (`TIPO_T`),
  CONSTRAINT `FK_USUARIO_REGISTRO`
    FOREIGN KEY (`NOMBRE_U`)
    REFERENCES `saetis`.`usuario` (`NOMBRE_U`))
ENGINE = InnoDB
AUTO_INCREMENT = 78
AVG_ROW_LENGTH = 8192
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `saetis`.`asignacion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `saetis`.`asignacion` (
  `ID_R` INT(11) NOT NULL,
  `EMISOR_A` VARCHAR(30) NOT NULL,
  `RECEPTOR_A` VARCHAR(30) NOT NULL,
  PRIMARY KEY USING BTREE (`ID_R`),
  CONSTRAINT `FK_REGISTRO__ASIGNACION`
    FOREIGN KEY (`ID_R`)
    REFERENCES `saetis`.`registro` (`ID_R`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `saetis`.`asistencia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `saetis`.`asistencia` (
  `ID_R` INT(11) NOT NULL,
  `CODIGO_SOCIO_A` INT(11) NOT NULL,
  `ASISTENCIA_A` TINYINT(1) NOT NULL,
  `LICENCIA_A` TINYINT(1) NOT NULL,
  PRIMARY KEY USING BTREE (`ID_R`, `CODIGO_SOCIO_A`),
  CONSTRAINT `FK_REGISTRO__ASISTENCIA`
    FOREIGN KEY (`ID_R`)
    REFERENCES `saetis`.`registro` (`ID_R`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `saetis`.`descripcion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `saetis`.`descripcion` (
  `ID_R` INT(11) NOT NULL,
  `DESCRIPCION_D` VARCHAR(100) NOT NULL,
  PRIMARY KEY USING BTREE (`ID_R`))
ENGINE = InnoDB
AVG_ROW_LENGTH = 8192
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `saetis`.`documento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `saetis`.`documento` (
  `ID_D` INT(11) NOT NULL AUTO_INCREMENT,
  `ID_R` INT(11) NOT NULL,
  `TAMANIO_D` INT(11) NOT NULL,
  `RUTA_D` VARCHAR(100) NOT NULL,
  `VISUALIZABLE_D` TINYINT(1) NOT NULL,
  `DESCARGABLE_D` TINYINT(1) NOT NULL,
  PRIMARY KEY USING BTREE (`ID_D`),
  INDEX `FK_REGISTRO_DOCUMENTO` USING BTREE (`ID_R` ASC),
  CONSTRAINT `FK_REGISTRO_DOCUMENTO`
    FOREIGN KEY (`ID_R`)
    REFERENCES `saetis`.`registro` (`ID_R`))
ENGINE = InnoDB
AUTO_INCREMENT = 34
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `saetis`.`entrega`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `saetis`.`entrega` (
  `ID_R` INT(11) NOT NULL,
  `ENTREGABLE_P` VARCHAR(30) NOT NULL,
  `ENTREGADO_P` TINYINT(1) NOT NULL,
  PRIMARY KEY USING BTREE (`ID_R`, `ENTREGABLE_P`),
  CONSTRAINT `FK_REGISTRO__PRESENTACION`
    FOREIGN KEY (`ID_R`)
    REFERENCES `saetis`.`registro` (`ID_R`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `saetis`.`grupo_empresa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `saetis`.`grupo_empresa` (
  `NOMBRE_U` VARCHAR(50) NOT NULL,
  `NOMBRE_CORTO_GE` CHAR(50) NOT NULL,
  `NOMBRE_LARGO_GE` VARCHAR(50) NOT NULL,
  `DIRECCION_GE` VARCHAR(50) NOT NULL,
  `REPRESENTANTE_LEGAL_GE` VARCHAR(45) NULL,
  PRIMARY KEY USING BTREE (`NOMBRE_U`),
  CONSTRAINT `FK_USUARIO__GRUPO_EMPRESA`
    FOREIGN KEY (`NOMBRE_U`)
    REFERENCES `saetis`.`usuario` (`NOMBRE_U`))
ENGINE = InnoDB
AVG_ROW_LENGTH = 4096
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `saetis`.`planificacion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `saetis`.`planificacion` (
  `NOMBRE_U` VARCHAR(50) NOT NULL,
  `ESTADO_E` VARCHAR(50) NOT NULL,
  `FECHA_INICIO_P` DATE NOT NULL,
  `FECHA_FIN_P` DATE NOT NULL,
  PRIMARY KEY USING BTREE (`NOMBRE_U`),
  INDEX `FK_ESTADO__PLANIFICACION` USING BTREE (`ESTADO_E` ASC),
  CONSTRAINT `FK_ESTADO__PLANIFICACION`
    FOREIGN KEY (`ESTADO_E`)
    REFERENCES `saetis`.`estado` (`ESTADO_E`),
  CONSTRAINT `FK_GRUPO_EMPRESA__PLANIFICACION`
    FOREIGN KEY (`NOMBRE_U`)
    REFERENCES `saetis`.`grupo_empresa` (`NOMBRE_U`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `saetis`.`entregable`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `saetis`.`entregable` (
  `NOMBRE_U` VARCHAR(50) NOT NULL,
  `ENTREGABLE_E` CHAR(30) NOT NULL,
  `DESCRIPCION_E` VARCHAR(50) NOT NULL,
  PRIMARY KEY USING BTREE (`NOMBRE_U`, `ENTREGABLE_E`),
  CONSTRAINT `FK_PLANIFICACION__ENTREGABLE`
    FOREIGN KEY (`NOMBRE_U`)
    REFERENCES `saetis`.`planificacion` (`NOMBRE_U`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `saetis`.`fecha_realizacion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `saetis`.`fecha_realizacion` (
  `ID_R` INT(11) NOT NULL,
  `FECHA_FR` DATE NOT NULL,
  PRIMARY KEY USING BTREE (`ID_R`),
  CONSTRAINT `FK_REGISTRO__FECHA_REALIZACION`
    FOREIGN KEY (`ID_R`)
    REFERENCES `saetis`.`registro` (`ID_R`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `saetis`.`gestion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `saetis`.`gestion` (
  `ID_G` INT(11) NOT NULL AUTO_INCREMENT,
  `NOM_G` VARCHAR(45) NOT NULL,
  `FECHA_INICIO_G` DATE NOT NULL,
  `FECHA_FIN_G` DATE NOT NULL,
  PRIMARY KEY USING BTREE (`ID_G`))
ENGINE = InnoDB
AUTO_INCREMENT = 3
AVG_ROW_LENGTH = 8192
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `saetis`.`proyecto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `saetis`.`proyecto` (
  `CODIGO_P` INT(11) NOT NULL AUTO_INCREMENT,
  `NOMBRE_P` VARCHAR(50) NOT NULL,
  `DESCRIPCION_P` VARCHAR(200) NOT NULL,
  PRIMARY KEY USING BTREE (`CODIGO_P`))
ENGINE = InnoDB
AUTO_INCREMENT = 3
AVG_ROW_LENGTH = 8192
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `saetis`.`inscripcion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `saetis`.`inscripcion` (
  `NOMBRE_UA` VARCHAR(50) NOT NULL,
  `NOMBRE_UGE` VARCHAR(50) NOT NULL,
  `ID_G` INT(11) NOT NULL,
  `CODIGO_P` INT(11) NOT NULL,
  PRIMARY KEY USING BTREE (`NOMBRE_UGE`, `NOMBRE_UA`, `ID_G`, `CODIGO_P`),
  INDEX `FK_ASESOR__INSCRIPCION` USING BTREE (`NOMBRE_UA` ASC),
  INDEX `FK_GESTION__INSCRIPCION` USING BTREE (`ID_G` ASC),
  INDEX `FK_PROYECTO__INSCRIPCION` USING BTREE (`CODIGO_P` ASC),
  CONSTRAINT `FK_ASESOR__INSCRIPCION`
    FOREIGN KEY (`NOMBRE_UA`)
    REFERENCES `saetis`.`asesor` (`NOMBRE_U`),
  CONSTRAINT `FK_GESTION__INSCRIPCION`
    FOREIGN KEY (`ID_G`)
    REFERENCES `saetis`.`gestion` (`ID_G`),
  CONSTRAINT `FK_GRUPO_EMPRESA__INSCRIPCION`
    FOREIGN KEY (`NOMBRE_UGE`)
    REFERENCES `saetis`.`grupo_empresa` (`NOMBRE_U`),
  CONSTRAINT `FK_PROYECTO__INSCRIPCION`
    FOREIGN KEY (`CODIGO_P`)
    REFERENCES `saetis`.`proyecto` (`CODIGO_P`))
ENGINE = InnoDB
AVG_ROW_LENGTH = 4096
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `saetis`.`mensaje`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `saetis`.`mensaje` (
  `ID_R` INT(11) NOT NULL,
  `ASUNTO_M` VARCHAR(30) NOT NULL,
  `MENSAJE_M` VARCHAR(100) NOT NULL,
  PRIMARY KEY USING BTREE (`ID_R`),
  CONSTRAINT `FK_REGISTRO__MENSAJE`
    FOREIGN KEY (`ID_R`)
    REFERENCES `saetis`.`registro` (`ID_R`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `saetis`.`pago`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `saetis`.`pago` (
  `ID_R` INT(11) NOT NULL,
  `MONTO_P` DECIMAL(10,0) NOT NULL,
  `PORCENTAJE_DEL_TOTAL_P` INT(11) NOT NULL,
  PRIMARY KEY USING BTREE (`ID_R`),
  CONSTRAINT `FK_REGISTRO__PAGO`
    FOREIGN KEY (`ID_R`)
    REFERENCES `saetis`.`registro` (`ID_R`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `saetis`.`plazo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `saetis`.`plazo` (
  `ID_R` INT(11) NOT NULL,
  `FECHA_INICIO_PL` DATE NOT NULL,
  `FECHA_FIN_PL` DATE NOT NULL,
  `HORA_INICIO_PL` TIME NOT NULL,
  `HORA_FIN_PL` TIME NOT NULL,
  PRIMARY KEY USING BTREE (`ID_R`),
  CONSTRAINT `FK_REGISTRO__PLAZO`
    FOREIGN KEY (`ID_R`)
    REFERENCES `saetis`.`registro` (`ID_R`))
ENGINE = InnoDB
AVG_ROW_LENGTH = 8192
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `saetis`.`precio`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `saetis`.`precio` (
  `NOMBRE_U` VARCHAR(50) NOT NULL,
  `PRECIO_P` DECIMAL(10,0) NOT NULL,
  PRIMARY KEY USING BTREE (`NOMBRE_U`),
  CONSTRAINT `FK_PLANIFICACION__PRECIO`
    FOREIGN KEY (`NOMBRE_U`)
    REFERENCES `saetis`.`planificacion` (`NOMBRE_U`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `saetis`.`rol_reporte`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `saetis`.`rol_reporte` (
  `ROL_RR` VARCHAR(50) NOT NULL,
  PRIMARY KEY USING BTREE (`ROL_RR`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `saetis`.`reporte`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `saetis`.`reporte` (
  `ID_R` INT(11) NOT NULL,
  `ROL_RR` VARCHAR(50) NOT NULL,
  `ACTIVIDAD_R` VARCHAR(100) NOT NULL,
  `HECHO_R` TINYINT(1) NOT NULL,
  `RESULTADO_R` VARCHAR(200) NOT NULL,
  `CONCLUSION_R` VARCHAR(200) NOT NULL,
  `OBSERVACION_R` VARCHAR(200) NOT NULL,
  PRIMARY KEY USING BTREE (`ID_R`, `ROL_RR`),
  INDEX `FK_ROL_REPORTE__REPORTE` USING BTREE (`ROL_RR` ASC),
  CONSTRAINT `FK_REGISTRO__REPORTE`
    FOREIGN KEY (`ID_R`)
    REFERENCES `saetis`.`registro` (`ID_R`),
  CONSTRAINT `FK_ROL_REPORTE__REPORTE`
    FOREIGN KEY (`ROL_RR`)
    REFERENCES `saetis`.`rol_reporte` (`ROL_RR`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `saetis`.`rol`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `saetis`.`rol` (
  `ROL_R` VARCHAR(50) NOT NULL,
  PRIMARY KEY USING BTREE (`ROL_R`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `saetis`.`rol_aplicacion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `saetis`.`rol_aplicacion` (
  `ROL_R` VARCHAR(50) NOT NULL,
  `APLICACION_A` VARCHAR(50) NOT NULL,
  PRIMARY KEY USING BTREE (`ROL_R`, `APLICACION_A`),
  INDEX `FK_APLICACION__ROL_APLICACION` USING BTREE (`APLICACION_A` ASC),
  CONSTRAINT `FK_APLICACION__ROL_APLICACION`
    FOREIGN KEY (`APLICACION_A`)
    REFERENCES `saetis`.`aplicacion` (`APLICACION_A`),
  CONSTRAINT `FK_ROL__ROL_APLICACION`
    FOREIGN KEY (`ROL_R`)
    REFERENCES `saetis`.`rol` (`ROL_R`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `saetis`.`sesion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `saetis`.`sesion` (
  `ID_S` INT(11) NOT NULL AUTO_INCREMENT,
  `NOMBRE_U` VARCHAR(50) NOT NULL,
  `FECHA_S` DATE NOT NULL,
  `HORA_S` TIME NOT NULL,
  `IP_S` VARCHAR(50) NOT NULL,
  PRIMARY KEY USING BTREE (`ID_S`),
  INDEX `FK_USUARIO_SESION` USING BTREE (`NOMBRE_U` ASC),
  CONSTRAINT `FK_USUARIO_SESION`
    FOREIGN KEY (`NOMBRE_U`)
    REFERENCES `saetis`.`usuario` (`NOMBRE_U`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `saetis`.`socio`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `saetis`.`socio` (
  `CODIGO_S` INT(11) NOT NULL AUTO_INCREMENT,
  `NOMBRE_U` VARCHAR(50) NOT NULL,
  `NOMBRES_S` VARCHAR(50) NOT NULL,
  `APELLIDOS_S` VARCHAR(50) NOT NULL,
  `LOGIN_S` VARCHAR(45) NOT NULL,
  `PASSWORD_S` VARCHAR(45) NOT NULL,
  PRIMARY KEY USING BTREE (`CODIGO_S`),
  INDEX `FK_GRUPO_EMPRESA__SOCIO` USING BTREE (`NOMBRE_U` ASC),
  CONSTRAINT `FK_GRUPO_EMPRESA__SOCIO`
    FOREIGN KEY (`NOMBRE_U`)
    REFERENCES `saetis`.`grupo_empresa` (`NOMBRE_U`))
ENGINE = InnoDB
AUTO_INCREMENT = 21
AVG_ROW_LENGTH = 819
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `saetis`.`usuario_rol`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `saetis`.`usuario_rol` (
  `NOMBRE_U` VARCHAR(50) NOT NULL,
  `ROL_R` VARCHAR(50) NOT NULL,
  PRIMARY KEY USING BTREE (`NOMBRE_U`, `ROL_R`),
  INDEX `FK_ROL__USUARIO_ROL` USING BTREE (`ROL_R` ASC),
  CONSTRAINT `FK_ROL__USUARIO_ROL`
    FOREIGN KEY (`ROL_R`)
    REFERENCES `saetis`.`rol` (`ROL_R`),
  CONSTRAINT `FK_USUARIO__USUARIO_ROL`
    FOREIGN KEY (`NOMBRE_U`)
    REFERENCES `saetis`.`usuario` (`NOMBRE_U`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `saetis`.`menu`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `saetis`.`menu` (
  `id_menu` INT NOT NULL AUTO_INCREMENT,
  `nom_menu` VARCHAR(45) NOT NULL,
  `url` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_menu`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `saetis`.`permisos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `saetis`.`permisos` (
  `ROL_R` VARCHAR(50) NOT NULL,
  `id_permiso` INT NOT NULL AUTO_INCREMENT,
  `menu_id_menu` INT NOT NULL,
  PRIMARY KEY (`id_permiso`),
  INDEX `fk_rol_has_menu_rol1_idx` (`ROL_R` ASC),
  INDEX `fk_permisos_menu1_idx` (`menu_id_menu` ASC),
  CONSTRAINT `id_menu`
    FOREIGN KEY (`ROL_R`)
    REFERENCES `saetis`.`rol` (`ROL_R`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_permisos_menu1`
    FOREIGN KEY (`menu_id_menu`)
    REFERENCES `saetis`.`menu` (`id_menu`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `saetis`.`periodo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `saetis`.`periodo` (
  `ID_R` INT(11) NOT NULL,
  `fecha_p` DATE NOT NULL,
  `hora_p` TIME NOT NULL,
  PRIMARY KEY (`ID_R`),
  CONSTRAINT `fk_periodo_registro1`
    FOREIGN KEY (`ID_R`)
    REFERENCES `saetis`.`registro` (`ID_R`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `saetis`.`NOTICIAS`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `saetis`.`NOTICIAS` (
  `ID_N` INT NOT NULL AUTO_INCREMENT,
  `NOMBRE_U` VARCHAR(50) NOT NULL,
  `TITULO` TEXT NOT NULL,
  `FECHA_N` DATETIME NOT NULL,
  `VIEWS` INT NOT NULL,
  `TEXTO` TEXT NOT NULL,
  PRIMARY KEY (`ID_N`, `NOMBRE_U`),
  INDEX `fk_noticias_usuario1_idx` (`NOMBRE_U` ASC),
  CONSTRAINT `fk_noticias_usuario1`
    FOREIGN KEY (`NOMBRE_U`)
    REFERENCES `saetis`.`usuario` (`NOMBRE_U`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `saetis`.`COMENTARIOS`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `saetis`.`COMENTARIOS` (
  `ID_C` INT NOT NULL AUTO_INCREMENT,
  `NOMBRE_U` VARCHAR(50) NOT NULL,
  `ID_N` INT NOT NULL,
  `COMENTARIO` TEXT NOT NULL,
  `FECHA_C` DATETIME NOT NULL,
  `AUTOR_C` TEXT NOT NULL,
  PRIMARY KEY (`ID_C`, `NOMBRE_U`, `ID_N`),
  INDEX `fk_comentarios_noticias1_idx` (`ID_N` ASC, `NOMBRE_U` ASC),
  CONSTRAINT `fk_comentarios_noticias1`
    FOREIGN KEY (`ID_N` , `NOMBRE_U`)
    REFERENCES `saetis`.`NOTICIAS` (`ID_N` , `NOMBRE_U`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `saetis`.`formulario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `saetis`.`formulario` (
  `ID_FORM` INT NOT NULL AUTO_INCREMENT,
  `NOMBRE_U` VARCHAR(50) NOT NULL,
  `NOMBRE_FORM` VARCHAR(45) NOT NULL,
  `ESTADO_FORM` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`ID_FORM`, `NOMBRE_U`),
  INDEX `fk_formulario_asesor1_idx` (`NOMBRE_U` ASC),
  CONSTRAINT `fk_formulario_asesor1`
    FOREIGN KEY (`NOMBRE_U`)
    REFERENCES `saetis`.`asesor` (`NOMBRE_U`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `saetis`.`puntaje`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `saetis`.`puntaje` (
  `PUNTAJE_ID` INT NOT NULL AUTO_INCREMENT,
  `ID_FORM` INT NOT NULL,
  `PUNTAJE` INT NOT NULL,
  PRIMARY KEY (`PUNTAJE_ID`, `ID_FORM`),
  INDEX `fk_puntaje_formulario1_idx` (`ID_FORM` ASC),
  CONSTRAINT `fk_puntaje_formulario1`
    FOREIGN KEY (`ID_FORM`)
    REFERENCES `saetis`.`formulario` (`ID_FORM`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `saetis`.`criterio_evaluacion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `saetis`.`criterio_evaluacion` (
  `ID_CRITERIO_E` INT NOT NULL AUTO_INCREMENT,
  `NOMBRE_U` VARCHAR(50) NOT NULL,
  `NOMBRE_CRITERIO_E` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`ID_CRITERIO_E`, `NOMBRE_U`),
  INDEX `fk_criterio_evaluacion_asesor1_idx` (`NOMBRE_U` ASC),
  CONSTRAINT `fk_criterio_evaluacion_asesor1`
    FOREIGN KEY (`NOMBRE_U`)
    REFERENCES `saetis`.`asesor` (`NOMBRE_U`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `saetis`.`criterioCalificacion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `saetis`.`criterioCalificacion` (
  `ID_CRITERIO_C` INT NOT NULL AUTO_INCREMENT,
  `NOMBRE_U` VARCHAR(50) NOT NULL,
  `NOMBRE_CRITERIO_C` VARCHAR(45) NOT NULL,
  `TIPO_CRITERIO` INT NOT NULL,
  PRIMARY KEY (`ID_CRITERIO_C`, `NOMBRE_U`),
  INDEX `fk_criterioCalificacion_asesor1_idx` (`NOMBRE_U` ASC),
  CONSTRAINT `fk_criterioCalificacion_asesor1`
    FOREIGN KEY (`NOMBRE_U`)
    REFERENCES `saetis`.`asesor` (`NOMBRE_U`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `saetis`.`indicador`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `saetis`.`indicador` (
  `ID_INDICADOR` INT NOT NULL AUTO_INCREMENT,
  `ID_CRITERIO_C` INT NOT NULL,
  `NOMBRE_INDICADOR` VARCHAR(45) NOT NULL,
  `PUNTAJE_INDICADOR` INT NOT NULL,
  PRIMARY KEY (`ID_INDICADOR`, `ID_CRITERIO_C`),
  INDEX `fk_indicador_criterioCalificacion1_idx` (`ID_CRITERIO_C` ASC),
  CONSTRAINT `fk_indicador_criterioCalificacion1`
    FOREIGN KEY (`ID_CRITERIO_C`)
    REFERENCES `saetis`.`criterioCalificacion` (`ID_CRITERIO_C`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `saetis`.`Form_Crit_E`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `saetis`.`Form_Crit_E` (
  `ID_FORM_CRIT_E` INT NOT NULL AUTO_INCREMENT,
  `ID_FORM` INT NOT NULL,
  `ID_CRITERIO_E` INT NOT NULL,
  PRIMARY KEY (`ID_FORM_CRIT_E`),
  INDEX `fk_formulario_has_criterio_evaluacion_criterio_evaluacion1_idx` (`ID_CRITERIO_E` ASC),
  INDEX `fk_formulario_has_criterio_evaluacion_formulario1_idx` (`ID_FORM` ASC),
  CONSTRAINT `fk_formulario_has_criterio_evaluacion_formulario1`
    FOREIGN KEY (`ID_FORM`)
    REFERENCES `saetis`.`formulario` (`ID_FORM`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_formulario_has_criterio_evaluacion_criterio_evaluacion1`
    FOREIGN KEY (`ID_CRITERIO_E`)
    REFERENCES `saetis`.`criterio_evaluacion` (`ID_CRITERIO_E`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `saetis`.`From_Crit_C`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `saetis`.`From_Crit_C` (
  `ID_FORM_CRIT_C` INT NOT NULL AUTO_INCREMENT,
  `ID_CRITERIO_C` INT NOT NULL,
  `ID_FORM` INT NOT NULL,
  PRIMARY KEY (`ID_FORM_CRIT_C`),
  INDEX `fk_criterioCalificacion_has_formulario_formulario1_idx` (`ID_FORM` ASC),
  INDEX `fk_criterioCalificacion_has_formulario_criterioCalificacion_idx` (`ID_CRITERIO_C` ASC),
  CONSTRAINT `fk_criterioCalificacion_has_formulario_criterioCalificacion1`
    FOREIGN KEY (`ID_CRITERIO_C`)
    REFERENCES `saetis`.`criterioCalificacion` (`ID_CRITERIO_C`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_criterioCalificacion_has_formulario_formulario1`
    FOREIGN KEY (`ID_FORM`)
    REFERENCES `saetis`.`formulario` (`ID_FORM`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `saetis`.`Administrador`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `saetis`.`Administrador` (
  `NOMBRE_U` VARCHAR(50) NOT NULL,
  `NOMBRES_AD` VARCHAR(45) NOT NULL,
  `APELLIDOS_AD` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`NOMBRE_U`),
  CONSTRAINT `fk_Administrador_usuario1`
    FOREIGN KEY (`NOMBRE_U`)
    REFERENCES `saetis`.`usuario` (`NOMBRE_U`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `saetis`.`nota`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `saetis`.`nota` (
  `ID_N` INT NOT NULL AUTO_INCREMENT,
  `NOMBRE_U` VARCHAR(50) NOT NULL,
  `CALIF_N` INT NULL,
  PRIMARY KEY (`ID_N`, `NOMBRE_U`),
  INDEX `fk_nota_grupo_empresa1_idx` (`NOMBRE_U` ASC),
  CONSTRAINT `fk_nota_grupo_empresa1`
    FOREIGN KEY (`NOMBRE_U`)
    REFERENCES `saetis`.`grupo_empresa` (`NOMBRE_U`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
