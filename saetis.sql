/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50527
Source Host           : localhost:3306
Source Database       : saetis

Target Server Type    : MYSQL
Target Server Version : 50527
File Encoding         : 65001

Date: 2015-04-16 09:13:55
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `administrador`
-- ----------------------------
DROP TABLE IF EXISTS `administrador`;
CREATE TABLE `administrador` (
  `NOMBRE_U` varchar(50) NOT NULL,
  `NOMBRES_AD` varchar(45) NOT NULL,
  `APELLIDOS_AD` varchar(45) NOT NULL,
  PRIMARY KEY (`NOMBRE_U`),
  CONSTRAINT `fk_Administrador_usuario1` FOREIGN KEY (`NOMBRE_U`) REFERENCES `usuario` (`NOMBRE_U`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of administrador
-- ----------------------------
INSERT INTO `administrador` VALUES ('Admin1', 'Ivan', 'Morales');
INSERT INTO `administrador` VALUES ('Admin2', 'Joaquin ', 'Rodriguez');

-- ----------------------------
-- Table structure for `aplicacion`
-- ----------------------------
DROP TABLE IF EXISTS `aplicacion`;
CREATE TABLE `aplicacion` (
  `APLICACION_A` varchar(50) NOT NULL,
  PRIMARY KEY (`APLICACION_A`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of aplicacion
-- ----------------------------

-- ----------------------------
-- Table structure for `asesor`
-- ----------------------------
DROP TABLE IF EXISTS `asesor`;
CREATE TABLE `asesor` (
  `NOMBRE_U` varchar(50) NOT NULL,
  `NOMBRES_A` varchar(50) NOT NULL,
  `APELLIDOS_A` varchar(50) NOT NULL,
  PRIMARY KEY (`NOMBRE_U`) USING BTREE,
  CONSTRAINT `FK_USUARIO__ASESOR` FOREIGN KEY (`NOMBRE_U`) REFERENCES `usuario` (`NOMBRE_U`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=4096;

-- ----------------------------
-- Records of asesor
-- ----------------------------
INSERT INTO `asesor` VALUES ('Corina', 'Corina', 'Flores Villarroel');
INSERT INTO `asesor` VALUES ('David', 'David', 'Escalera Fernandez');
INSERT INTO `asesor` VALUES ('LeticiaB', 'Leticia', 'Blanco Coca');
INSERT INTO `asesor` VALUES ('MarcoA', 'Marco Antonio', 'Montecinos Choque');
INSERT INTO `asesor` VALUES ('Patricia', 'Patricia', 'Rodriguez Bilbao');

-- ----------------------------
-- Table structure for `asignacion`
-- ----------------------------
DROP TABLE IF EXISTS `asignacion`;
CREATE TABLE `asignacion` (
  `ID_R` int(11) NOT NULL,
  `EMISOR_A` varchar(30) NOT NULL,
  `RECEPTOR_A` varchar(30) NOT NULL,
  PRIMARY KEY (`ID_R`) USING BTREE,
  CONSTRAINT `FK_REGISTRO__ASIGNACION` FOREIGN KEY (`ID_R`) REFERENCES `registro` (`ID_R`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of asignacion
-- ----------------------------

-- ----------------------------
-- Table structure for `asistencia`
-- ----------------------------
DROP TABLE IF EXISTS `asistencia`;
CREATE TABLE `asistencia` (
  `ID_R` int(11) NOT NULL,
  `CODIGO_SOCIO_A` int(11) NOT NULL,
  `ASISTENCIA_A` tinyint(1) NOT NULL,
  `LICENCIA_A` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID_R`,`CODIGO_SOCIO_A`) USING BTREE,
  CONSTRAINT `FK_REGISTRO__ASISTENCIA` FOREIGN KEY (`ID_R`) REFERENCES `registro` (`ID_R`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of asistencia
-- ----------------------------

-- ----------------------------
-- Table structure for `asistencia_semanal`
-- ----------------------------
DROP TABLE IF EXISTS `asistencia_semanal`;
CREATE TABLE `asistencia_semanal` (
  `ID_AS` int(11) NOT NULL AUTO_INCREMENT,
  `ID_R` int(11) NOT NULL,
  `GRUPO_AS` varchar(25) NOT NULL,
  `CODIGO_SOCIO_AS` int(11) NOT NULL,
  `ASISTENCIA_AS` tinyint(1) NOT NULL,
  `LICENCIA_AS` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID_AS`) USING BTREE,
  KEY `FK_REGISTRO__ASISTENCIA_SEMANAL` (`ID_R`),
  CONSTRAINT `FK_REGISTRO__ASISTENCIA_SEMANAL` FOREIGN KEY (`ID_R`) REFERENCES `registro` (`ID_R`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of asistencia_semanal
-- ----------------------------

-- ----------------------------
-- Table structure for `comentarios`
-- ----------------------------
DROP TABLE IF EXISTS `comentarios`;
CREATE TABLE `comentarios` (
  `ID_C` int(11) NOT NULL AUTO_INCREMENT,
  `NOMBRE_U` varchar(50) NOT NULL,
  `ID_N` int(11) NOT NULL,
  `COMENTARIO` text NOT NULL,
  `FECHA_C` datetime NOT NULL,
  `AUTOR_C` text NOT NULL,
  PRIMARY KEY (`ID_C`,`NOMBRE_U`,`ID_N`),
  KEY `fk_comentarios_noticias1_idx` (`ID_N`,`NOMBRE_U`),
  CONSTRAINT `fk_comentarios_noticias1` FOREIGN KEY (`ID_N`, `NOMBRE_U`) REFERENCES `noticias` (`ID_N`, `NOMBRE_U`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of comentarios
-- ----------------------------
INSERT INTO `comentarios` VALUES ('1', 'LeticiaB', '2', 'Leer PTIS<br>', '2015-03-28 20:36:42', 'Patricia');
INSERT INTO `comentarios` VALUES ('2', 'Oasis', '3', 'Que parte de que proyecto?<br>', '2015-03-28 20:50:23', 'LeticiaB');

-- ----------------------------
-- Table structure for `criterio_evaluacion`
-- ----------------------------
DROP TABLE IF EXISTS `criterio_evaluacion`;
CREATE TABLE `criterio_evaluacion` (
  `ID_CRITERIO_E` int(11) NOT NULL AUTO_INCREMENT,
  `NOMBRE_U` varchar(50) NOT NULL,
  `NOMBRE_CRITERIO_E` varchar(45) NOT NULL,
  PRIMARY KEY (`ID_CRITERIO_E`,`NOMBRE_U`),
  KEY `fk_criterio_evaluacion_asesor1_idx` (`NOMBRE_U`),
  CONSTRAINT `fk_criterio_evaluacion_asesor1` FOREIGN KEY (`NOMBRE_U`) REFERENCES `asesor` (`NOMBRE_U`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of criterio_evaluacion
-- ----------------------------
INSERT INTO `criterio_evaluacion` VALUES ('1', 'LeticiaB', 'Puntualidad');
INSERT INTO `criterio_evaluacion` VALUES ('2', 'LeticiaB', 'Cumplimiento');
INSERT INTO `criterio_evaluacion` VALUES ('3', 'LeticiaB', 'Organizacion\r\n');

-- ----------------------------
-- Table structure for `criteriocalificacion`
-- ----------------------------
DROP TABLE IF EXISTS `criteriocalificacion`;
CREATE TABLE `criteriocalificacion` (
  `ID_CRITERIO_C` int(11) NOT NULL AUTO_INCREMENT,
  `NOMBRE_U` varchar(50) NOT NULL,
  `NOMBRE_CRITERIO_C` varchar(45) NOT NULL,
  `TIPO_CRITERIO` int(11) NOT NULL,
  PRIMARY KEY (`ID_CRITERIO_C`,`NOMBRE_U`),
  KEY `fk_criterioCalificacion_asesor1_idx` (`NOMBRE_U`),
  CONSTRAINT `fk_criterioCalificacion_asesor1` FOREIGN KEY (`NOMBRE_U`) REFERENCES `asesor` (`NOMBRE_U`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of criteriocalificacion
-- ----------------------------
INSERT INTO `criteriocalificacion` VALUES ('1', 'LeticiaB', 'PUNTAJE', '4');
INSERT INTO `criteriocalificacion` VALUES ('2', 'Patricia', 'PUNTAJE', '4');
INSERT INTO `criteriocalificacion` VALUES ('3', 'Corina', 'PUNTAJE', '4');
INSERT INTO `criteriocalificacion` VALUES ('4', 'MarcoA', 'PUNTAJE', '4');
INSERT INTO `criteriocalificacion` VALUES ('5', 'David', 'PUNTAJE', '4');
INSERT INTO `criteriocalificacion` VALUES ('6', 'LeticiaB', 'A(100)B(80)C(60)D(30)', '1');
INSERT INTO `criteriocalificacion` VALUES ('7', 'LeticiaB', 'Verdadero(100)Falso(50)', '2');
INSERT INTO `criteriocalificacion` VALUES ('8', 'LeticiaB', 'Excelente(100)Bueno(80)Regular(50)Malo(30)Pes', '1');

-- ----------------------------
-- Table structure for `descripcion`
-- ----------------------------
DROP TABLE IF EXISTS `descripcion`;
CREATE TABLE `descripcion` (
  `ID_R` int(11) NOT NULL,
  `DESCRIPCION_D` varchar(100) NOT NULL,
  PRIMARY KEY (`ID_R`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=8192;

-- ----------------------------
-- Records of descripcion
-- ----------------------------
INSERT INTO `descripcion` VALUES ('66', 'Descripcion');
INSERT INTO `descripcion` VALUES ('67', 'Descripcionn');
INSERT INTO `descripcion` VALUES ('68', '<b>Ya salio la convocatoria....</b> CPETIS<br>');
INSERT INTO `descripcion` VALUES ('69', 'Leer el pdf de liderazgo.<br>');
INSERT INTO `descripcion` VALUES ('72', 'Notificacion de Conformidad');
INSERT INTO `descripcion` VALUES ('83', 'Contrato');
INSERT INTO `descripcion` VALUES ('84', 'Parte R Descripicion');
INSERT INTO `descripcion` VALUES ('86', 'Orden de Cambio');
INSERT INTO `descripcion` VALUES ('88', 'Notificacion de Conformidad');

-- ----------------------------
-- Table structure for `documento`
-- ----------------------------
DROP TABLE IF EXISTS `documento`;
CREATE TABLE `documento` (
  `ID_D` int(11) NOT NULL AUTO_INCREMENT,
  `ID_R` int(11) NOT NULL,
  `TAMANIO_D` int(11) NOT NULL,
  `RUTA_D` varchar(100) NOT NULL,
  `VISUALIZABLE_D` tinyint(1) NOT NULL,
  `DESCARGABLE_D` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID_D`) USING BTREE,
  KEY `FK_REGISTRO_DOCUMENTO` (`ID_R`) USING BTREE,
  CONSTRAINT `FK_REGISTRO_DOCUMENTO` FOREIGN KEY (`ID_R`) REFERENCES `registro` (`ID_R`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of documento
-- ----------------------------
INSERT INTO `documento` VALUES ('14', '68', '1024', '', '0', '0');
INSERT INTO `documento` VALUES ('15', '69', '1024', '', '0', '0');
INSERT INTO `documento` VALUES ('16', '70', '120214', '/Repositorio/FreeValue/APLICACION DE LA NORMA ISO 9126.pdf', '1', '1');
INSERT INTO `documento` VALUES ('17', '71', '91746', '/Repositorio/FreeValue/ise_38_creacion_cajs_negras.pdf', '1', '1');
INSERT INTO `documento` VALUES ('18', '72', '1024', '../Repositorio/FreeValue/NC/NotificacionConformidad.pdf', '0', '0');
INSERT INTO `documento` VALUES ('19', '83', '1024', '../Repositorio/LeticiaB/Contratos/ContratoFreeValue.pdf', '0', '0');
INSERT INTO `documento` VALUES ('20', '85', '91746', '/Repositorio/Oasis/ise_38_creacion_cajs_negras (1).pdf', '1', '1');
INSERT INTO `documento` VALUES ('21', '86', '1024', '../Repositorio/Oasis/OC/OrdenCambio.pdf', '0', '0');
INSERT INTO `documento` VALUES ('22', '87', '126054', '/Repositorio/Power/CronogramaVerano3-2014yGestion1-2015v2_2014-12-19_04-00.pdf', '1', '1');
INSERT INTO `documento` VALUES ('23', '88', '1024', '../Repositorio/Power/NC/NotificacionConformidad.pdf', '0', '0');

-- ----------------------------
-- Table structure for `documento_r`
-- ----------------------------
DROP TABLE IF EXISTS `documento_r`;
CREATE TABLE `documento_r` (
  `ID_R` int(11) NOT NULL AUTO_INCREMENT,
  `CODIGO_P` int(11) NOT NULL,
  PRIMARY KEY (`ID_R`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of documento_r
-- ----------------------------
INSERT INTO `documento_r` VALUES ('66', '4');
INSERT INTO `documento_r` VALUES ('67', '4');
INSERT INTO `documento_r` VALUES ('84', '5');

-- ----------------------------
-- Table structure for `entrega`
-- ----------------------------
DROP TABLE IF EXISTS `entrega`;
CREATE TABLE `entrega` (
  `ID_R` int(11) NOT NULL,
  `ENTREGABLE_P` varchar(30) NOT NULL,
  `ENTREGADO_P` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID_R`,`ENTREGABLE_P`) USING BTREE,
  CONSTRAINT `FK_REGISTRO__PRESENTACION` FOREIGN KEY (`ID_R`) REFERENCES `registro` (`ID_R`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of entrega
-- ----------------------------
INSERT INTO `entrega` VALUES ('78', 'Diagramas UML', '0');
INSERT INTO `entrega` VALUES ('79', 'HU', '0');
INSERT INTO `entrega` VALUES ('79', 'Sw', '0');
INSERT INTO `entrega` VALUES ('80', 'HU', '0');
INSERT INTO `entrega` VALUES ('80', 'Manuales', '0');
INSERT INTO `entrega` VALUES ('81', 'HU', '0');
INSERT INTO `entrega` VALUES ('81', 'Sw', '0');
INSERT INTO `entrega` VALUES ('82', 'Manuales', '0');

-- ----------------------------
-- Table structure for `entregable`
-- ----------------------------
DROP TABLE IF EXISTS `entregable`;
CREATE TABLE `entregable` (
  `NOMBRE_U` varchar(50) NOT NULL,
  `ENTREGABLE_E` char(30) NOT NULL,
  `DESCRIPCION_E` varchar(50) NOT NULL,
  PRIMARY KEY (`NOMBRE_U`,`ENTREGABLE_E`) USING BTREE,
  CONSTRAINT `FK_PLANIFICACION__ENTREGABLE` FOREIGN KEY (`NOMBRE_U`) REFERENCES `planificacion` (`NOMBRE_U`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of entregable
-- ----------------------------
INSERT INTO `entregable` VALUES ('FreeValue', 'Diagramas UML', ' Tecnico y de Instalacion\n');
INSERT INTO `entregable` VALUES ('FreeValue', 'HU', 'Diagramas');
INSERT INTO `entregable` VALUES ('FreeValue', 'Manuales', 'Usuario');
INSERT INTO `entregable` VALUES ('FreeValue', 'Sw', 'Software');
INSERT INTO `entregable` VALUES ('Power', '', '');

-- ----------------------------
-- Table structure for `estado`
-- ----------------------------
DROP TABLE IF EXISTS `estado`;
CREATE TABLE `estado` (
  `ESTADO_E` varchar(50) NOT NULL,
  PRIMARY KEY (`ESTADO_E`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=8192;

-- ----------------------------
-- Records of estado
-- ----------------------------
INSERT INTO `estado` VALUES ('asistencia registrada');
INSERT INTO `estado` VALUES ('Deshabilitado');
INSERT INTO `estado` VALUES ('en proceso');
INSERT INTO `estado` VALUES ('Habilitado');
INSERT INTO `estado` VALUES ('planificacion registrada');
INSERT INTO `estado` VALUES ('registrar costo total proyecto');
INSERT INTO `estado` VALUES ('registrar entregables');
INSERT INTO `estado` VALUES ('registrar plan pagos');
INSERT INTO `estado` VALUES ('registrar planificacion');
INSERT INTO `estado` VALUES ('seguimiento registrado');

-- ----------------------------
-- Table structure for `evaluacion`
-- ----------------------------
DROP TABLE IF EXISTS `evaluacion`;
CREATE TABLE `evaluacion` (
  `ID_R` int(11) NOT NULL,
  `ID_E` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `NOTA_E` int(11) NOT NULL,
  `PORCENTAJE` int(11) NOT NULL,
  PRIMARY KEY (`ID_R`,`ID_E`) USING BTREE,
  UNIQUE KEY `ID_E` (`ID_E`),
  CONSTRAINT `FK_REGISTRO__EVALUACION` FOREIGN KEY (`ID_R`) REFERENCES `registro` (`ID_R`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of evaluacion
-- ----------------------------

-- ----------------------------
-- Table structure for `fecha_realizacion`
-- ----------------------------
DROP TABLE IF EXISTS `fecha_realizacion`;
CREATE TABLE `fecha_realizacion` (
  `ID_R` int(11) NOT NULL,
  `FECHA_FR` date NOT NULL,
  PRIMARY KEY (`ID_R`) USING BTREE,
  CONSTRAINT `FK_REGISTRO__FECHA_REALIZACION` FOREIGN KEY (`ID_R`) REFERENCES `registro` (`ID_R`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fecha_realizacion
-- ----------------------------
INSERT INTO `fecha_realizacion` VALUES ('73', '2015-03-28');
INSERT INTO `fecha_realizacion` VALUES ('74', '2015-04-08');
INSERT INTO `fecha_realizacion` VALUES ('75', '2015-04-17');
INSERT INTO `fecha_realizacion` VALUES ('76', '2015-04-23');
INSERT INTO `fecha_realizacion` VALUES ('77', '2015-05-05');
INSERT INTO `fecha_realizacion` VALUES ('78', '0000-00-00');
INSERT INTO `fecha_realizacion` VALUES ('79', '0000-00-00');
INSERT INTO `fecha_realizacion` VALUES ('80', '0000-00-00');
INSERT INTO `fecha_realizacion` VALUES ('81', '0000-00-00');
INSERT INTO `fecha_realizacion` VALUES ('82', '0000-00-00');
INSERT INTO `fecha_realizacion` VALUES ('89', '2015-03-27');
INSERT INTO `fecha_realizacion` VALUES ('90', '2015-04-10');
INSERT INTO `fecha_realizacion` VALUES ('91', '2015-04-20');
INSERT INTO `fecha_realizacion` VALUES ('92', '2015-04-30');

-- ----------------------------
-- Table structure for `form_crit_e`
-- ----------------------------
DROP TABLE IF EXISTS `form_crit_e`;
CREATE TABLE `form_crit_e` (
  `ID_FORM_CRIT_E` int(11) NOT NULL AUTO_INCREMENT,
  `ID_FORM` int(11) NOT NULL,
  `ID_CRITERIO_E` int(11) NOT NULL,
  PRIMARY KEY (`ID_FORM_CRIT_E`),
  KEY `fk_formulario_has_criterio_evaluacion_criterio_evaluacion1_idx` (`ID_CRITERIO_E`),
  KEY `fk_formulario_has_criterio_evaluacion_formulario1_idx` (`ID_FORM`),
  CONSTRAINT `fk_formulario_has_criterio_evaluacion_criterio_evaluacion1` FOREIGN KEY (`ID_CRITERIO_E`) REFERENCES `criterio_evaluacion` (`ID_CRITERIO_E`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_formulario_has_criterio_evaluacion_formulario1` FOREIGN KEY (`ID_FORM`) REFERENCES `formulario` (`ID_FORM`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of form_crit_e
-- ----------------------------
INSERT INTO `form_crit_e` VALUES ('7', '3', '2');
INSERT INTO `form_crit_e` VALUES ('8', '3', '1');

-- ----------------------------
-- Table structure for `formulario`
-- ----------------------------
DROP TABLE IF EXISTS `formulario`;
CREATE TABLE `formulario` (
  `ID_FORM` int(11) NOT NULL AUTO_INCREMENT,
  `NOMBRE_U` varchar(50) NOT NULL,
  `NOMBRE_FORM` varchar(45) NOT NULL,
  `ESTADO_FORM` varchar(45) NOT NULL,
  PRIMARY KEY (`ID_FORM`,`NOMBRE_U`),
  KEY `fk_formulario_asesor1_idx` (`NOMBRE_U`),
  CONSTRAINT `fk_formulario_asesor1` FOREIGN KEY (`NOMBRE_U`) REFERENCES `asesor` (`NOMBRE_U`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of formulario
-- ----------------------------
INSERT INTO `formulario` VALUES ('3', 'LeticiaB', 'formulario1', 'Habilitado');

-- ----------------------------
-- Table structure for `from_crit_c`
-- ----------------------------
DROP TABLE IF EXISTS `from_crit_c`;
CREATE TABLE `from_crit_c` (
  `ID_FORM_CRIT_C` int(11) NOT NULL AUTO_INCREMENT,
  `ID_CRITERIO_C` int(11) NOT NULL,
  `ID_FORM` int(11) NOT NULL,
  PRIMARY KEY (`ID_FORM_CRIT_C`),
  KEY `fk_criterioCalificacion_has_formulario_formulario1_idx` (`ID_FORM`),
  KEY `fk_criterioCalificacion_has_formulario_criterioCalificacion_idx` (`ID_CRITERIO_C`),
  CONSTRAINT `fk_criterioCalificacion_has_formulario_criterioCalificacion1` FOREIGN KEY (`ID_CRITERIO_C`) REFERENCES `criteriocalificacion` (`ID_CRITERIO_C`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_criterioCalificacion_has_formulario_formulario1` FOREIGN KEY (`ID_FORM`) REFERENCES `formulario` (`ID_FORM`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of from_crit_c
-- ----------------------------
INSERT INTO `from_crit_c` VALUES ('5', '8', '3');
INSERT INTO `from_crit_c` VALUES ('6', '7', '3');

-- ----------------------------
-- Table structure for `gestion`
-- ----------------------------
DROP TABLE IF EXISTS `gestion`;
CREATE TABLE `gestion` (
  `ID_G` int(11) NOT NULL AUTO_INCREMENT,
  `NOM_G` varchar(45) NOT NULL,
  `FECHA_INICIO_G` date NOT NULL,
  `FECHA_FIN_G` date NOT NULL,
  PRIMARY KEY (`ID_G`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=8192;

-- ----------------------------
-- Records of gestion
-- ----------------------------
INSERT INTO `gestion` VALUES ('1', 'I/2015', '2015-01-01', '2015-06-30');
INSERT INTO `gestion` VALUES ('2', '1', '2020-03-04', '2030-01-01');
INSERT INTO `gestion` VALUES ('3', '4', '2020-03-04', '1990-12-12');
INSERT INTO `gestion` VALUES ('4', '2', '2020-03-04', '2030-01-01');
INSERT INTO `gestion` VALUES ('5', '2', '2000-01-01', '2003-01-01');
INSERT INTO `gestion` VALUES ('6', '1', '2015-04-16', '2030-01-01');
INSERT INTO `gestion` VALUES ('7', '1222', '2015-01-01', '2016-01-01');
-- ----------------------------
-- Table structure for grupo_empresa
-- ----------------------------
DROP TABLE IF EXISTS `grupo_empresa`;
CREATE TABLE `grupo_empresa` (
  `NOMBRE_U` varchar(50) NOT NULL,
  `NOMBRE_CORTO_GE` char(50) NOT NULL,
  `NOMBRE_LARGO_GE` varchar(50) NOT NULL,
  `DIRECCION_GE` varchar(50) NOT NULL,
  `REPRESENTANTE_LEGAL_GE` varchar(45) DEFAULT NULL,
  `NUM_SOCIOS` int(11) DEFAULT NULL,
  PRIMARY KEY (`NOMBRE_U`) USING BTREE,
  CONSTRAINT `FK_USUARIO__GRUPO_EMPRESA` FOREIGN KEY (`NOMBRE_U`) REFERENCES `usuario` (`NOMBRE_U`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=4096;

-- ----------------------------
-- Records of grupo_empresa
-- ----------------------------
INSERT INTO `grupo_empresa` VALUES ('AgileA', 'Agile', 'AgileAction', 'Calle Agil', 'Nombre1 Apellido1','5');
INSERT INTO `grupo_empresa` VALUES ('Arkano', 'Arkano', 'Arkano Soft', 'Av Santa Cruz', '','5');
INSERT INTO `grupo_empresa` VALUES ('Camaleon', 'Camaleon', 'Camaleon Soft', 'Calle 3', 'Jimena Salazar','5');
INSERT INTO `grupo_empresa` VALUES ('Colective', 'Colectivo', 'Colectivo Virtual SRL', 'Av Oquendo', '','5');
INSERT INTO `grupo_empresa` VALUES ('FreeValue', 'FreeValue', 'FreeValue SRL', 'Calle F', 'Oscar Gamboa Acho','5');
INSERT INTO `grupo_empresa` VALUES ('Oasis', 'Oasis', 'Oasis SRL', 'Calle Jordan', 'Pablo Sahonero','5');
INSERT INTO `grupo_empresa` VALUES ('Power', 'Power', 'Power Soft SRL', 'Calle Power', 'Javier Rojas','5');

-- ----------------------------
-- Table structure for `indicador`
-- ----------------------------
DROP TABLE IF EXISTS `indicador`;
CREATE TABLE `indicador` (
  `ID_INDICADOR` int(11) NOT NULL AUTO_INCREMENT,
  `ID_CRITERIO_C` int(11) NOT NULL,
  `NOMBRE_INDICADOR` varchar(45) NOT NULL,
  `PUNTAJE_INDICADOR` int(11) NOT NULL,
  PRIMARY KEY (`ID_INDICADOR`,`ID_CRITERIO_C`),
  KEY `fk_indicador_criterioCalificacion1_idx` (`ID_CRITERIO_C`),
  CONSTRAINT `fk_indicador_criterioCalificacion1` FOREIGN KEY (`ID_CRITERIO_C`) REFERENCES `criteriocalificacion` (`ID_CRITERIO_C`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of indicador
-- ----------------------------
INSERT INTO `indicador` VALUES ('1', '6', 'A', '100');
INSERT INTO `indicador` VALUES ('2', '6', 'B', '80');
INSERT INTO `indicador` VALUES ('3', '6', 'C', '60');
INSERT INTO `indicador` VALUES ('4', '6', 'D', '30');
INSERT INTO `indicador` VALUES ('5', '7', 'Verdadero', '100');
INSERT INTO `indicador` VALUES ('6', '7', 'Falso', '50');
INSERT INTO `indicador` VALUES ('7', '8', 'Excelente', '100');
INSERT INTO `indicador` VALUES ('8', '8', 'Bueno', '80');
INSERT INTO `indicador` VALUES ('9', '8', 'Regular', '50');
INSERT INTO `indicador` VALUES ('10', '8', 'Malo', '30');
INSERT INTO `indicador` VALUES ('11', '8', 'Pesimo', '10');

-- ----------------------------
-- Table structure for `inscripcion`
-- ----------------------------
DROP TABLE IF EXISTS `inscripcion`;
CREATE TABLE `inscripcion` (
  `NOMBRE_UA` varchar(50) NOT NULL,
  `NOMBRE_UGE` varchar(50) NOT NULL,
  `ESTADO_INSCRIPCION` varchar(45) NOT NULL,
  PRIMARY KEY (`NOMBRE_UA`,`NOMBRE_UGE`) USING BTREE,
  KEY `FK_ASESOR__INSCRIPCION` (`NOMBRE_UA`) USING BTREE,
  KEY `FK_GRUPO_EMPRESA__INSCRIPCION` (`NOMBRE_UGE`),
  CONSTRAINT `FK_ASESOR__INSCRIPCION` FOREIGN KEY (`NOMBRE_UA`) REFERENCES `asesor` (`NOMBRE_U`) ON UPDATE CASCADE,
  CONSTRAINT `FK_GRUPO_EMPRESA__INSCRIPCION` FOREIGN KEY (`NOMBRE_UGE`) REFERENCES `grupo_empresa` (`NOMBRE_U`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=4096;

-- ----------------------------
-- Records of inscripcion
-- ----------------------------
INSERT INTO `inscripcion` VALUES ('LeticiaB', 'AgileA', 'Habilitado');
INSERT INTO `inscripcion` VALUES ('LeticiaB', 'Camaleon', 'Deshabilitado');
INSERT INTO `inscripcion` VALUES ('LeticiaB', 'FreeValue', 'Habilitado');
INSERT INTO `inscripcion` VALUES ('LeticiaB', 'Power', 'Habilitado');
INSERT INTO `inscripcion` VALUES ('Patricia', 'Oasis', 'Habilitado');

-- ----------------------------
-- Table structure for `inscripcion_proyecto`
-- ----------------------------
DROP TABLE IF EXISTS `inscripcion_proyecto`;
CREATE TABLE `inscripcion_proyecto` (
  `CODIGO_P` int(11) NOT NULL,
  `NOMBRE_U` varchar(50) NOT NULL,
  `ESTADO_CONTRATO` varchar(11) NOT NULL,
  PRIMARY KEY (`CODIGO_P`,`NOMBRE_U`),
  KEY `fk_inscripcion_proyecto_proyecto1_idx` (`CODIGO_P`),
  KEY `fk_inscripcion_proyecto_grupo_empresa1_idx` (`NOMBRE_U`),
  CONSTRAINT `fk_inscripcion_proyecto_grupo_empresa1` FOREIGN KEY (`NOMBRE_U`) REFERENCES `grupo_empresa` (`NOMBRE_U`) ON UPDATE CASCADE,
  CONSTRAINT `fk_inscripcion_proyecto_proyecto1` FOREIGN KEY (`CODIGO_P`) REFERENCES `proyecto` (`CODIGO_P`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of inscripcion_proyecto
-- ----------------------------
INSERT INTO `inscripcion_proyecto` VALUES ('4', 'AgileA', 'Sin Firmar');
INSERT INTO `inscripcion_proyecto` VALUES ('4', 'FreeValue', 'Firmado');
INSERT INTO `inscripcion_proyecto` VALUES ('5', 'Oasis', 'Sin Firmar');
INSERT INTO `inscripcion_proyecto` VALUES ('5', 'Power', 'Sin Firmar');

-- ----------------------------
-- Table structure for `lista_ge`
-- ----------------------------
DROP TABLE IF EXISTS `lista_ge`;
CREATE TABLE `lista_ge` (
  `NOMBRE_CORTO` varchar(100) NOT NULL,
  `NOMBRE_LARGO` varchar(100) NOT NULL,
  `DIRECCION` varchar(100) NOT NULL,
  `REPRESENTANTE_LEGAL` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lista_ge
-- ----------------------------
INSERT INTO `lista_ge` VALUES ('FreeValue', 'FreeValue SRL', 'Calle F', null);
INSERT INTO `lista_ge` VALUES ('Oasis', 'Oasis SRL', 'Calle Jordan', null);
INSERT INTO `lista_ge` VALUES ('Power', 'Power Soft SRL', 'Calle Power', null);
INSERT INTO `lista_ge` VALUES ('Agile', 'AgileAction', 'Calle Agil', null);

-- ----------------------------
-- Table structure for `mensaje`
-- ----------------------------
DROP TABLE IF EXISTS `mensaje`;
CREATE TABLE `mensaje` (
  `ID_R` int(11) NOT NULL,
  `ASUNTO_M` varchar(30) NOT NULL,
  `MENSAJE_M` varchar(100) NOT NULL,
  PRIMARY KEY (`ID_R`) USING BTREE,
  CONSTRAINT `FK_REGISTRO__MENSAJE` FOREIGN KEY (`ID_R`) REFERENCES `registro` (`ID_R`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mensaje
-- ----------------------------

-- ----------------------------
-- Table structure for `menu`
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL AUTO_INCREMENT,
  `nom_menu` varchar(45) NOT NULL,
  `url` varchar(45) NOT NULL,
  PRIMARY KEY (`id_menu`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of menu
-- ----------------------------

-- ----------------------------
-- Table structure for `nota`
-- ----------------------------
DROP TABLE IF EXISTS `nota`;
CREATE TABLE `nota` (
  `ID_N` int(11) NOT NULL AUTO_INCREMENT,
  `ID_FORM` int(50) NOT NULL,
  `NOMBRE_U` varchar(50) NOT NULL,
  `CALIF_N` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_N`,`NOMBRE_U`),
  KEY `fk_nota_grupo_empresa1_idx` (`NOMBRE_U`),
  KEY `fk_nota_formulario_idx` (`ID_FORM`),
  CONSTRAINT `fk_nota_formulario` FOREIGN KEY (`ID_FORM`) REFERENCES `formulario` (`ID_FORM`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_nota_grupo_empresa1` FOREIGN KEY (`NOMBRE_U`) REFERENCES `grupo_empresa` (`NOMBRE_U`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of nota
-- ----------------------------

-- ----------------------------
-- Table structure for `nota_final`
-- ----------------------------
DROP TABLE IF EXISTS `nota_final`;
CREATE TABLE `nota_final` (
  `ID_NF` int(11) NOT NULL AUTO_INCREMENT,
  `NOMBRE_U` varchar(50) NOT NULL,
  `NOTA_F` float NOT NULL,
  PRIMARY KEY (`ID_NF`,`NOMBRE_U`),
  KEY `fk_nota_final_grupo_empresa1_idx` (`NOMBRE_U`),
  CONSTRAINT `fk_nota_final_grupo_empresa1` FOREIGN KEY (`NOMBRE_U`) REFERENCES `grupo_empresa` (`NOMBRE_U`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of nota_final
-- ----------------------------

-- ----------------------------
-- Table structure for `noticias`
-- ----------------------------
DROP TABLE IF EXISTS `noticias`;
CREATE TABLE `noticias` (
  `ID_N` int(11) NOT NULL AUTO_INCREMENT,
  `NOMBRE_U` varchar(50) NOT NULL,
  `TITULO` text NOT NULL,
  `FECHA_N` datetime NOT NULL,
  `VIEWS` int(11) NOT NULL,
  `TEXTO` text NOT NULL,
  `POSTEADO` varchar(50) NOT NULL,
  PRIMARY KEY (`ID_N`,`NOMBRE_U`),
  KEY `fk_noticias_usuario1_idx` (`NOMBRE_U`),
  CONSTRAINT `fk_noticias_usuario1` FOREIGN KEY (`NOMBRE_U`) REFERENCES `usuario` (`NOMBRE_U`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of noticias
-- ----------------------------
INSERT INTO `noticias` VALUES ('2', 'LeticiaB', 'Entrega de Partes A y B', '2015-03-28 20:32:40', '3', 'Subir los documentos hasta la fecha indicada, cualquier duda por aca....<br>', 'LeticiaB');
INSERT INTO `noticias` VALUES ('3', 'Oasis', 'Dudas', '2015-03-28 20:37:07', '8', 'En la parte...<br>', 'Oasis');

-- ----------------------------
-- Table structure for `pago`
-- ----------------------------
DROP TABLE IF EXISTS `pago`;
CREATE TABLE `pago` (
  `ID_R` int(11) NOT NULL,
  `MONTO_P` decimal(10,0) NOT NULL,
  `PORCENTAJE_DEL_TOTAL_P` int(11) NOT NULL,
  PRIMARY KEY (`ID_R`) USING BTREE,
  CONSTRAINT `FK_REGISTRO__PAGO` FOREIGN KEY (`ID_R`) REFERENCES `registro` (`ID_R`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pago
-- ----------------------------
INSERT INTO `pago` VALUES ('78', '20000', '20');
INSERT INTO `pago` VALUES ('79', '25000', '25');
INSERT INTO `pago` VALUES ('80', '25000', '25');
INSERT INTO `pago` VALUES ('81', '20000', '20');
INSERT INTO `pago` VALUES ('82', '10000', '10');

-- ----------------------------
-- Table structure for `periodo`
-- ----------------------------
DROP TABLE IF EXISTS `periodo`;
CREATE TABLE `periodo` (
  `ID_R` int(11) NOT NULL,
  `fecha_p` date NOT NULL,
  `hora_p` time NOT NULL,
  PRIMARY KEY (`ID_R`),
  CONSTRAINT `fk_periodo_registro1` FOREIGN KEY (`ID_R`) REFERENCES `registro` (`ID_R`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of periodo
-- ----------------------------
INSERT INTO `periodo` VALUES ('68', '2014-03-28', '12:30:00');
INSERT INTO `periodo` VALUES ('69', '2015-03-28', '12:30:00');
INSERT INTO `periodo` VALUES ('72', '2015-03-29', '01:01:39');
INSERT INTO `periodo` VALUES ('86', '2015-03-29', '01:01:58');
INSERT INTO `periodo` VALUES ('88', '2015-03-29', '03:03:03');

-- ----------------------------
-- Table structure for `permisos`
-- ----------------------------
DROP TABLE IF EXISTS `permisos`;
CREATE TABLE `permisos` (
  `ROL_R` varchar(50) NOT NULL,
  `id_permiso` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id_menu` int(11) NOT NULL,
  PRIMARY KEY (`id_permiso`),
  KEY `fk_rol_has_menu_rol1_idx` (`ROL_R`),
  KEY `fk_permisos_menu1_idx` (`menu_id_menu`),
  CONSTRAINT `fk_permisos_menu1` FOREIGN KEY (`menu_id_menu`) REFERENCES `menu` (`id_menu`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `id_menu` FOREIGN KEY (`ROL_R`) REFERENCES `rol` (`ROL_R`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of permisos
-- ----------------------------

-- ----------------------------
-- Table structure for `planificacion`
-- ----------------------------
DROP TABLE IF EXISTS `planificacion`;
CREATE TABLE `planificacion` (
  `NOMBRE_U` varchar(50) NOT NULL,
  `ESTADO_E` varchar(50) NOT NULL,
  `FECHA_INICIO_P` date NOT NULL,
  `FECHA_FIN_P` date NOT NULL,
  PRIMARY KEY (`NOMBRE_U`) USING BTREE,
  KEY `FK_ESTADO__PLANIFICACION` (`ESTADO_E`) USING BTREE,
  CONSTRAINT `FK_ESTADO__PLANIFICACION` FOREIGN KEY (`ESTADO_E`) REFERENCES `estado` (`ESTADO_E`),
  CONSTRAINT `FK_GRUPO_EMPRESA__PLANIFICACION` FOREIGN KEY (`NOMBRE_U`) REFERENCES `grupo_empresa` (`NOMBRE_U`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of planificacion
-- ----------------------------
INSERT INTO `planificacion` VALUES ('AgileA', 'registrar planificacion', '2014-12-12', '2020-12-12');
INSERT INTO `planificacion` VALUES ('FreeValue', 'planificacion registrada', '2014-12-12', '2020-12-12');
INSERT INTO `planificacion` VALUES ('Oasis', 'registrar planificacion', '2014-12-12', '2020-12-12');
INSERT INTO `planificacion` VALUES ('Power', 'registrar plan pagos', '2014-12-12', '2020-12-12');

-- ----------------------------
-- Table structure for `plazo`
-- ----------------------------
DROP TABLE IF EXISTS `plazo`;
CREATE TABLE `plazo` (
  `ID_R` int(11) NOT NULL,
  `FECHA_INICIO_PL` date NOT NULL,
  `FECHA_FIN_PL` date NOT NULL,
  `HORA_INICIO_PL` time NOT NULL,
  `HORA_FIN_PL` time NOT NULL,
  PRIMARY KEY (`ID_R`) USING BTREE,
  CONSTRAINT `FK_REGISTRO__PLAZO` FOREIGN KEY (`ID_R`) REFERENCES `registro` (`ID_R`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=8192;

-- ----------------------------
-- Records of plazo
-- ----------------------------
INSERT INTO `plazo` VALUES ('66', '2015-03-12', '2015-04-12', '12:12:00', '12:12:00');
INSERT INTO `plazo` VALUES ('67', '2015-03-12', '2015-04-12', '12:12:00', '12:12:00');
INSERT INTO `plazo` VALUES ('84', '2015-03-22', '2015-04-12', '12:12:00', '12:12:00');

-- ----------------------------
-- Table structure for `precio`
-- ----------------------------
DROP TABLE IF EXISTS `precio`;
CREATE TABLE `precio` (
  `NOMBRE_U` varchar(50) NOT NULL,
  `PRECIO_P` decimal(10,0) NOT NULL,
  `PORCENTAJE_A` int(11) NOT NULL,
  PRIMARY KEY (`NOMBRE_U`) USING BTREE,
  CONSTRAINT `FK_PLANIFICACION__PRECIO` FOREIGN KEY (`NOMBRE_U`) REFERENCES `planificacion` (`NOMBRE_U`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of precio
-- ----------------------------
INSERT INTO `precio` VALUES ('FreeValue', '100000', '70');
INSERT INTO `precio` VALUES ('Power', '100000', '68');

-- ----------------------------
-- Table structure for `proyecto`
-- ----------------------------
DROP TABLE IF EXISTS `proyecto`;
CREATE TABLE `proyecto` (
  `CODIGO_P` int(11) NOT NULL AUTO_INCREMENT,
  `ID_G` int(11) NOT NULL,
  `NOMBRE_P` varchar(50) NOT NULL,
  `DESCRIPCION_P` varchar(200) NOT NULL,
  `CONVOCATORIA` varchar(50) NOT NULL,
  PRIMARY KEY (`CODIGO_P`,`ID_G`) USING BTREE,
  KEY `fk_proyecto_gestion1_idx` (`ID_G`),
  CONSTRAINT `fk_proyecto_gestion1` FOREIGN KEY (`ID_G`) REFERENCES `gestion` (`ID_G`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=8192;

-- ----------------------------
-- Records of proyecto
-- ----------------------------
INSERT INTO `proyecto` VALUES ('4', '1', 'SAETIS', 'Sistema de apoyo a la empresa TIS', 'CPTIS2015');
INSERT INTO `proyecto` VALUES ('5', '1', 'Proyecto2', 'Descripcion del proyecto', 'CPTISS2015');

-- ----------------------------
-- Table structure for `puntaje`
-- ----------------------------
DROP TABLE IF EXISTS `puntaje`;
CREATE TABLE `puntaje` (
  `PUNTAJE_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_FORM` int(11) NOT NULL,
  `PUNTAJE` int(11) NOT NULL,
  PRIMARY KEY (`PUNTAJE_ID`,`ID_FORM`),
  KEY `fk_puntaje_formulario1_idx` (`ID_FORM`),
  CONSTRAINT `fk_puntaje_formulario1` FOREIGN KEY (`ID_FORM`) REFERENCES `formulario` (`ID_FORM`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of puntaje
-- ----------------------------
INSERT INTO `puntaje` VALUES ('5', '3', '70');
INSERT INTO `puntaje` VALUES ('6', '3', '30');

-- ----------------------------
-- Table structure for `puntaje_ge`
-- ----------------------------
DROP TABLE IF EXISTS `puntaje_ge`;
CREATE TABLE `puntaje_ge` (
  `ID_PGE` int(50) NOT NULL AUTO_INCREMENT,
  `ID_N` int(50) NOT NULL,
  `NUM_CE` int(50) NOT NULL,
  `CALIFICACION` int(50) NOT NULL,
  PRIMARY KEY (`ID_PGE`),
  KEY `fk_ PUNTAJE_GE_nota_idx` (`ID_N`),
  CONSTRAINT `fk_PUNTAJE_GE_nota` FOREIGN KEY (`ID_N`) REFERENCES `nota` (`ID_N`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of puntaje_ge
-- ----------------------------

-- ----------------------------
-- Table structure for `receptor`
-- ----------------------------
DROP TABLE IF EXISTS `receptor`;
CREATE TABLE `receptor` (
  `ID_R` int(11) NOT NULL,
  `RECEPTOR_R` varchar(150) NOT NULL,
  PRIMARY KEY (`ID_R`),
  CONSTRAINT `fk_receptor_registro1` FOREIGN KEY (`ID_R`) REFERENCES `registro` (`ID_R`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of receptor
-- ----------------------------
INSERT INTO `receptor` VALUES ('68', 'PUBLICO');
INSERT INTO `receptor` VALUES ('69', 'PUBLICO');
INSERT INTO `receptor` VALUES ('72', 'FreeValue SRL');
INSERT INTO `receptor` VALUES ('83', 'FreeValue SRL');
INSERT INTO `receptor` VALUES ('86', 'Oasis SRL');
INSERT INTO `receptor` VALUES ('88', 'Power Soft SRL');

-- ----------------------------
-- Table structure for `registro`
-- ----------------------------
DROP TABLE IF EXISTS `registro`;
CREATE TABLE `registro` (
  `ID_R` int(11) NOT NULL AUTO_INCREMENT,
  `NOMBRE_U` varchar(50) NOT NULL,
  `TIPO_T` varchar(50) NOT NULL,
  `ESTADO_E` varchar(50) NOT NULL,
  `NOMBRE_R` varchar(50) NOT NULL,
  `FECHA_R` date NOT NULL,
  `HORA_R` time NOT NULL,
  PRIMARY KEY (`ID_R`) USING BTREE,
  KEY `FK_ESTADO__REGISTRO` (`ESTADO_E`) USING BTREE,
  KEY `FK_TIPO__REGISTRO` (`TIPO_T`) USING BTREE,
  KEY `FK_USUARIO_REGISTRO` (`NOMBRE_U`) USING BTREE,
  CONSTRAINT `FK_ESTADO__REGISTRO` FOREIGN KEY (`ESTADO_E`) REFERENCES `estado` (`ESTADO_E`),
  CONSTRAINT `FK_TIPO__REGISTRO` FOREIGN KEY (`TIPO_T`) REFERENCES `tipo` (`TIPO_T`),
  CONSTRAINT `FK_USUARIO_REGISTRO` FOREIGN KEY (`NOMBRE_U`) REFERENCES `usuario` (`NOMBRE_U`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=8192;

-- ----------------------------
-- Records of registro
-- ----------------------------
INSERT INTO `registro` VALUES ('66', 'LeticiaB', 'documento requerido', 'Habilitado', 'Parte A', '2015-03-28', '20:31:04');
INSERT INTO `registro` VALUES ('67', 'LeticiaB', 'documento requerido', 'Habilitado', 'Parte Z', '2015-03-28', '20:31:29');
INSERT INTO `registro` VALUES ('68', 'LeticiaB', 'publicaciones', 'Habilitado', 'Convocatoria publica', '2015-03-29', '01:01:34');
INSERT INTO `registro` VALUES ('69', 'Patricia', 'publicaciones', 'Habilitado', 'Lider', '2015-03-29', '01:01:36');
INSERT INTO `registro` VALUES ('70', 'FreeValue', 'documento subido', 'habilitado', 'Parte A', '2015-03-28', '20:20:38');
INSERT INTO `registro` VALUES ('71', 'FreeValue', 'documento subido', 'habilitado', 'Parte Z', '2015-03-28', '20:20:38');
INSERT INTO `registro` VALUES ('72', 'LeticiaB', 'publicaciones', 'Habilitado', 'Notificacion de Conformidad de FreeValue', '2015-03-29', '01:01:39');
INSERT INTO `registro` VALUES ('73', 'FreeValue', 'actividad planificacion', 'en proceso', 'Sprint 0', '2015-03-28', '20:46:44');
INSERT INTO `registro` VALUES ('74', 'FreeValue', 'actividad planificacion', 'en proceso', 'Sprint 1', '2015-03-28', '20:46:45');
INSERT INTO `registro` VALUES ('75', 'FreeValue', 'actividad planificacion', 'en proceso', 'Sprint 2', '2015-03-28', '20:46:45');
INSERT INTO `registro` VALUES ('76', 'FreeValue', 'actividad planificacion', 'en proceso', 'Sprint 3', '2015-03-28', '20:46:45');
INSERT INTO `registro` VALUES ('77', 'FreeValue', 'actividad planificacion', 'en proceso', 'Sprint 4', '2015-03-28', '20:46:45');
INSERT INTO `registro` VALUES ('78', 'FreeValue', 'pago planificacion', 'en proceso', 'Sprint 0', '2015-03-28', '20:49:05');
INSERT INTO `registro` VALUES ('79', 'FreeValue', 'pago planificacion', 'en proceso', 'Sprint 1', '2015-03-28', '20:49:05');
INSERT INTO `registro` VALUES ('80', 'FreeValue', 'pago planificacion', 'en proceso', 'Sprint 2', '2015-03-28', '20:49:06');
INSERT INTO `registro` VALUES ('81', 'FreeValue', 'pago planificacion', 'en proceso', 'Sprint 3', '2015-03-28', '20:49:06');
INSERT INTO `registro` VALUES ('82', 'FreeValue', 'pago planificacion', 'en proceso', 'Sprint 4', '2015-03-28', '20:49:06');
INSERT INTO `registro` VALUES ('83', 'LeticiaB', 'Contrato', 'Habilitado', 'ContratoFreeValue.pdf', '2015-03-29', '01:01:49');
INSERT INTO `registro` VALUES ('84', 'Patricia', 'documento requerido', 'Habilitado', 'Parte R', '2015-03-28', '20:53:11');
INSERT INTO `registro` VALUES ('85', 'Oasis', 'documento subido', 'habilitado', 'Parte R', '2015-03-28', '20:20:57');
INSERT INTO `registro` VALUES ('86', 'Patricia', 'publicaciones', 'Habilitado', 'Orden de Cambio de Oasis', '2015-03-29', '01:01:58');
INSERT INTO `registro` VALUES ('87', 'Power', 'documento subido', 'habilitado', 'Parte R', '2015-03-28', '21:21:02');
INSERT INTO `registro` VALUES ('88', 'LeticiaB', 'publicaciones', 'Habilitado', 'Notificacion de Conformidad de Power', '2015-03-29', '03:03:03');
INSERT INTO `registro` VALUES ('89', 'Power', 'actividad planificacion', 'en proceso', 'Sprint 0', '2015-03-28', '21:05:00');
INSERT INTO `registro` VALUES ('90', 'Power', 'actividad planificacion', 'en proceso', 'Sprint 1', '2015-03-28', '21:05:00');
INSERT INTO `registro` VALUES ('91', 'Power', 'actividad planificacion', 'en proceso', 'Sprint 2', '2015-03-28', '21:05:00');
INSERT INTO `registro` VALUES ('92', 'Power', 'actividad planificacion', 'en proceso', 'Sprint 3', '2015-03-28', '21:05:00');

-- ----------------------------
-- Table structure for `reporte`
-- ----------------------------
DROP TABLE IF EXISTS `reporte`;
CREATE TABLE `reporte` (
  `ID_R` int(11) NOT NULL,
  `ROL_RR` varchar(50) NOT NULL,
  `ACTIVIDAD_R` varchar(100) NOT NULL,
  `HECHO_R` tinyint(1) NOT NULL,
  `RESULTADO_R` varchar(200) NOT NULL,
  `CONCLUSION_R` varchar(200) NOT NULL,
  `OBSERVACION_R` varchar(200) NOT NULL,
  PRIMARY KEY (`ID_R`,`ROL_RR`) USING BTREE,
  KEY `FK_ROL_REPORTE__REPORTE` (`ROL_RR`) USING BTREE,
  CONSTRAINT `FK_REGISTRO__REPORTE` FOREIGN KEY (`ID_R`) REFERENCES `registro` (`ID_R`),
  CONSTRAINT `FK_ROL_REPORTE__REPORTE` FOREIGN KEY (`ROL_RR`) REFERENCES `rol_reporte` (`ROL_RR`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of reporte
-- ----------------------------

-- ----------------------------
-- Table structure for `rol`
-- ----------------------------
DROP TABLE IF EXISTS `rol`;
CREATE TABLE `rol` (
  `ROL_R` varchar(50) NOT NULL,
  PRIMARY KEY (`ROL_R`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rol
-- ----------------------------
INSERT INTO `rol` VALUES ('administrador');
INSERT INTO `rol` VALUES ('asesor');
INSERT INTO `rol` VALUES ('grupoEmpresa');

-- ----------------------------
-- Table structure for `rol_aplicacion`
-- ----------------------------
DROP TABLE IF EXISTS `rol_aplicacion`;
CREATE TABLE `rol_aplicacion` (
  `ROL_R` varchar(50) NOT NULL,
  `APLICACION_A` varchar(50) NOT NULL,
  PRIMARY KEY (`ROL_R`,`APLICACION_A`) USING BTREE,
  KEY `FK_APLICACION__ROL_APLICACION` (`APLICACION_A`) USING BTREE,
  CONSTRAINT `FK_APLICACION__ROL_APLICACION` FOREIGN KEY (`APLICACION_A`) REFERENCES `aplicacion` (`APLICACION_A`),
  CONSTRAINT `FK_ROL__ROL_APLICACION` FOREIGN KEY (`ROL_R`) REFERENCES `rol` (`ROL_R`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rol_aplicacion
-- ----------------------------

-- ----------------------------
-- Table structure for `rol_reporte`
-- ----------------------------
DROP TABLE IF EXISTS `rol_reporte`;
CREATE TABLE `rol_reporte` (
  `ROL_RR` varchar(50) NOT NULL,
  PRIMARY KEY (`ROL_RR`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rol_reporte
-- ----------------------------
INSERT INTO `rol_reporte` VALUES ('asesor');
INSERT INTO `rol_reporte` VALUES ('cliente');
INSERT INTO `rol_reporte` VALUES ('jefe de proyecto');

-- ----------------------------
-- Table structure for `seguimiento`
-- ----------------------------
DROP TABLE IF EXISTS `seguimiento`;
CREATE TABLE `seguimiento` (
  `ID_S` int(5) NOT NULL AUTO_INCREMENT,
  `ID_R` int(11) NOT NULL,
  `ROL_S` varchar(50) NOT NULL,
  `GRUPO_S` varchar(20) NOT NULL,
  `ACTIVIDAD_S` varchar(100) NOT NULL,
  `HECHO_S` tinyint(1) NOT NULL,
  `RESULTADO_S` varchar(200) NOT NULL,
  `CONCLUSION_S` varchar(200) NOT NULL,
  `OBSERVACION_S` varchar(200) NOT NULL,
  `FECHA_S` date NOT NULL,
  PRIMARY KEY (`ID_S`) USING BTREE,
  KEY `FK_ROL_REPORTE__REPORTE` (`ROL_S`) USING BTREE,
  KEY `FK_REGISTRO__SEGUIMIENTO` (`ID_R`),
  CONSTRAINT `FK_REGISTRO__SEGUIMIENTO` FOREIGN KEY (`ID_R`) REFERENCES `registro` (`ID_R`),
  CONSTRAINT `FK_ROL_REPORTE__SEGUIMIENTO` FOREIGN KEY (`ROL_S`) REFERENCES `rol_reporte` (`ROL_RR`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of seguimiento
-- ----------------------------

-- ----------------------------
-- Table structure for `sesion`
-- ----------------------------
DROP TABLE IF EXISTS `sesion`;
CREATE TABLE `sesion` (
  `ID_S` int(11) NOT NULL AUTO_INCREMENT,
  `NOMBRE_U` varchar(50) NOT NULL,
  `FECHA_S` date NOT NULL,
  `HORA_S` time NOT NULL,
  `IP_S` varchar(50) NOT NULL,
  PRIMARY KEY (`ID_S`) USING BTREE,
  KEY `FK_USUARIO_SESION` (`NOMBRE_U`) USING BTREE,
  CONSTRAINT `FK_USUARIO_SESION` FOREIGN KEY (`NOMBRE_U`) REFERENCES `usuario` (`NOMBRE_U`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sesion
-- ----------------------------
INSERT INTO `sesion` VALUES ('53', 'Admin1', '2015-03-29', '01:25:55', '::1');
INSERT INTO `sesion` VALUES ('54', 'Oasis', '2015-03-29', '01:26:22', '::1');
INSERT INTO `sesion` VALUES ('55', 'FreeValue', '2015-03-29', '01:27:20', '::1');
INSERT INTO `sesion` VALUES ('56', 'Camaleon', '2015-03-29', '01:28:30', '::1');
INSERT INTO `sesion` VALUES ('57', 'Admin1', '2015-03-29', '01:29:21', '::1');
INSERT INTO `sesion` VALUES ('58', 'LeticiaB', '2015-03-29', '01:29:32', '::1');
INSERT INTO `sesion` VALUES ('59', 'Camaleon', '2015-03-29', '01:29:42', '::1');
INSERT INTO `sesion` VALUES ('60', 'LeticiaB', '2015-03-29', '01:29:54', '::1');
INSERT INTO `sesion` VALUES ('61', 'Patricia', '2015-03-29', '01:34:42', '::1');
INSERT INTO `sesion` VALUES ('62', 'Patricia', '2015-03-29', '01:36:26', '::1');
INSERT INTO `sesion` VALUES ('63', 'Oasis', '2015-03-29', '01:36:53', '::1');
INSERT INTO `sesion` VALUES ('64', 'FreeValue', '2015-03-29', '01:37:16', '::1');
INSERT INTO `sesion` VALUES ('65', 'LeticiaB', '2015-03-29', '01:39:03', '::1');
INSERT INTO `sesion` VALUES ('66', 'Camaleon', '2015-03-29', '01:44:59', '::1');
INSERT INTO `sesion` VALUES ('67', 'FreeValue', '2015-03-29', '01:45:12', '::1');
INSERT INTO `sesion` VALUES ('68', 'LeticiaB', '2015-03-29', '01:49:15', '::1');
INSERT INTO `sesion` VALUES ('69', 'Admin1', '2015-03-29', '01:50:36', '::1');
INSERT INTO `sesion` VALUES ('70', 'Oasis', '2015-03-29', '01:51:55', '::1');
INSERT INTO `sesion` VALUES ('71', 'Patricia', '2015-03-29', '01:52:09', '::1');
INSERT INTO `sesion` VALUES ('72', 'Oasis', '2015-03-29', '01:53:17', '::1');
INSERT INTO `sesion` VALUES ('73', 'Patricia', '2015-03-29', '01:53:46', '::1');
INSERT INTO `sesion` VALUES ('74', 'Oasis', '2015-03-29', '01:56:53', '::1');
INSERT INTO `sesion` VALUES ('75', 'Patricia', '2015-03-29', '01:57:58', '::1');
INSERT INTO `sesion` VALUES ('76', 'Oasis', '2015-03-29', '01:58:49', '::1');
INSERT INTO `sesion` VALUES ('77', 'Admin1', '2015-03-29', '01:59:46', '::1');
INSERT INTO `sesion` VALUES ('78', 'Power', '2015-03-29', '03:01:19', '::1');
INSERT INTO `sesion` VALUES ('79', 'LeticiaB', '2015-03-29', '03:02:18', '::1');
INSERT INTO `sesion` VALUES ('80', 'Power', '2015-03-29', '03:02:35', '::1');
INSERT INTO `sesion` VALUES ('81', 'LeticiaB', '2015-03-29', '03:03:08', '::1');
INSERT INTO `sesion` VALUES ('82', 'Power', '2015-03-29', '03:04:04', '::1');
INSERT INTO `sesion` VALUES ('83', 'AgileA', '2015-03-29', '03:06:28', '::1');
INSERT INTO `sesion` VALUES ('84', 'LeticiaB', '2015-03-29', '03:07:26', '::1');
INSERT INTO `sesion` VALUES ('85', 'AgileA', '2015-03-29', '03:07:47', '::1');
INSERT INTO `sesion` VALUES ('86', 'Patricia', '2015-03-29', '03:08:54', '::1');
INSERT INTO `sesion` VALUES ('87', 'Patricia', '2015-03-29', '03:10:36', '::1');
INSERT INTO `sesion` VALUES ('88', 'Admin1', '2015-04-15', '02:18:34', '::1');
INSERT INTO `sesion` VALUES ('89', 'LeticiaB', '2015-04-15', '02:30:58', '::1');
INSERT INTO `sesion` VALUES ('90', 'FreeValue', '2015-04-15', '02:31:31', '::1');
INSERT INTO `sesion` VALUES ('91', 'Admin1', '2015-04-15', '02:35:28', '::1');
INSERT INTO `sesion` VALUES ('92', 'Admin1', '2015-04-15', '03:04:17', '::1');
INSERT INTO `sesion` VALUES ('93', 'Admin1', '2015-04-15', '01:11:08', '127.0.0.1');
INSERT INTO `sesion` VALUES ('94', 'Admin1', '2015-04-15', '01:20:39', '127.0.0.1');
INSERT INTO `sesion` VALUES ('95', 'Admin1', '2015-04-15', '01:21:30', '127.0.0.1');
INSERT INTO `sesion` VALUES ('96', 'LeticiaB', '2015-04-15', '02:03:34', '127.0.0.1');
INSERT INTO `sesion` VALUES ('97', 'FreeValue', '2015-04-15', '02:05:35', '127.0.0.1');

-- ----------------------------
-- Table structure for `socio`
-- ----------------------------
DROP TABLE IF EXISTS `socio`;
CREATE TABLE `socio` (
  `CODIGO_S` int(11) NOT NULL AUTO_INCREMENT,
  `NOMBRE_U` varchar(50) NOT NULL,
  `NOMBRES_S` varchar(50) NOT NULL,
  `APELLIDOS_S` varchar(50) NOT NULL,
  PRIMARY KEY (`CODIGO_S`) USING BTREE,
  KEY `FK_GRUPO_EMPRESA__SOCIO` (`NOMBRE_U`) USING BTREE,
  CONSTRAINT `FK_GRUPO_EMPRESA__SOCIO` FOREIGN KEY (`NOMBRE_U`) REFERENCES `grupo_empresa` (`NOMBRE_U`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=819;

-- ----------------------------
-- Records of socio
-- ----------------------------
INSERT INTO `socio` VALUES ('22', 'Oasis', 'Pablo', 'Sahonero');
INSERT INTO `socio` VALUES ('23', 'Oasis', 'Jimmy', 'Rojas');
INSERT INTO `socio` VALUES ('24', 'Oasis', 'Alejandro', 'Guzman');
INSERT INTO `socio` VALUES ('25', 'Oasis', 'Rolando', 'Ro...');
INSERT INTO `socio` VALUES ('26', 'FreeValue', 'Oscar', 'Gamboa Acho');
INSERT INTO `socio` VALUES ('27', 'FreeValue', 'Oscar', 'Torrez Salas');
INSERT INTO `socio` VALUES ('28', 'FreeValue', 'Valeri', 'Crespo Gutierrez');
INSERT INTO `socio` VALUES ('29', 'FreeValue', 'Ruddy', 'Marquina Escobar');
INSERT INTO `socio` VALUES ('30', 'FreeValue', 'Adelio', 'Ayllon Machicado');
INSERT INTO `socio` VALUES ('31', 'Camaleon', 'Jimena', 'Salazar');
INSERT INTO `socio` VALUES ('32', 'Camaleon', 'Victor', 'Nnnn');
INSERT INTO `socio` VALUES ('33', 'Camaleon', 'Socio3', 'ApSocio3');
INSERT INTO `socio` VALUES ('34', 'Power', 'Javier', 'Rojas');
INSERT INTO `socio` VALUES ('35', 'Power', 'Alex', 'fLORES');
INSERT INTO `socio` VALUES ('36', 'Power', 'Alan', 'Fuentes');
INSERT INTO `socio` VALUES ('37', 'AgileA', 'Nombre1', 'Apellido1');
INSERT INTO `socio` VALUES ('38', 'AgileA', 'Nombre2', 'Apellido2');
INSERT INTO `socio` VALUES ('39', 'AgileA', 'Nombre3', 'Apellido3');

-- ----------------------------
-- Table structure for `tipo`
-- ----------------------------
DROP TABLE IF EXISTS `tipo`;
CREATE TABLE `tipo` (
  `TIPO_T` varchar(50) NOT NULL,
  PRIMARY KEY (`TIPO_T`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=8192;

-- ----------------------------
-- Records of tipo
-- ----------------------------
INSERT INTO `tipo` VALUES ('actividad planificacion');
INSERT INTO `tipo` VALUES ('asistencia');
INSERT INTO `tipo` VALUES ('Contrato');
INSERT INTO `tipo` VALUES ('criterio evaluacion');
INSERT INTO `tipo` VALUES ('documento requerido');
INSERT INTO `tipo` VALUES ('documento subido');
INSERT INTO `tipo` VALUES ('notificacion de conformidad');
INSERT INTO `tipo` VALUES ('Orden de Cambio');
INSERT INTO `tipo` VALUES ('pago planificacion');
INSERT INTO `tipo` VALUES ('publicaciones');
INSERT INTO `tipo` VALUES ('seguimiento');

-- ----------------------------
-- Table structure for `usuario`
-- ----------------------------
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `NOMBRE_U` varchar(50) NOT NULL,
  `ESTADO_E` varchar(50) NOT NULL,
  `PASSWORD_U` varchar(50) NOT NULL,
  `TELEFONO_U` varchar(8) NOT NULL,
  `CORREO_ELECTRONICO_U` varchar(50) NOT NULL,
  PRIMARY KEY (`NOMBRE_U`) USING BTREE,
  KEY `FK_ESTADO__USUARIO` (`ESTADO_E`) USING BTREE,
  CONSTRAINT `FK_ESTADO__USUARIO` FOREIGN KEY (`ESTADO_E`) REFERENCES `estado` (`ESTADO_E`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=2048;

-- ----------------------------
-- Records of usuario
-- ----------------------------
INSERT INTO `usuario` VALUES ('Admin1', 'Habilitado', 'dbb050cddf3a78fd6b861eb577d1f5dc', '4442336', 'adm.saetis@gmail.com');
INSERT INTO `usuario` VALUES ('Admin2', 'Habilitado', '62132d33742969b9b1db54e2d4145009', '4329092', 'joaquin@rodriguez.com');
INSERT INTO `usuario` VALUES ('AgileA', 'Habilitado', 'f4326bafda468fdca9511f4468cea9c9', '4443200', 'agile@action.com');
INSERT INTO `usuario` VALUES ('Arkano', 'Habilitado', 'd87b0418cd506677986e7a3ae41b2c54', '4233322', 'arkano@arkanos.com');
INSERT INTO `usuario` VALUES ('Camaleon', 'Habilitado', '88936961971d538e693935a6ffb40a20', '4442299', 'camaleon@soft.com');
INSERT INTO `usuario` VALUES ('Colective', 'Habilitado', 'b9becbb405f0fd5524071709a02b5330', '4432211', 'colectivo@virtual.com');
INSERT INTO `usuario` VALUES ('Corina', 'Deshabilitado', '83175e301fe440e2fa85463a987037ba', '4241122', 'corina@hotmail.com');
INSERT INTO `usuario` VALUES ('David', 'Deshabilitado', '0076fa0d70724c52f22a82f7ed3f5e23', '4443321', 'davides@gmail.com');
INSERT INTO `usuario` VALUES ('FreeValue', 'Habilitado', 'f87f9d72ff9dfb09182cffa68762c2c8', '4329092', 'free@value.com');
INSERT INTO `usuario` VALUES ('LeticiaB', 'Habilitado', '1fec3b9b292b7c95d5287012c1ea3052', '4440099', 'leticia@gmail.com');
INSERT INTO `usuario` VALUES ('MarcoA', 'Deshabilitado', '0c7895d527f7680d6a715fc6a47a720e', '4440099', 'marcoantonio@hotmail.com');
INSERT INTO `usuario` VALUES ('Oasis', 'Habilitado', 'c810a44fc32898ae6ab495d89510d75f', '4331222', 'oasis@oasis.com');
INSERT INTO `usuario` VALUES ('Patricia', 'Habilitado', '1f08de3d6b9e572ba8f5da4c1dd2c30d', '4298765', 'patricia@hotmail.com');
INSERT INTO `usuario` VALUES ('Power', 'Habilitado', '7a4f8e9647073ee9a5564f81cf3a1082', '4329090', 'power@power.com');

-- ----------------------------
-- Table structure for `usuario_rol`
-- ----------------------------
DROP TABLE IF EXISTS `usuario_rol`;
CREATE TABLE `usuario_rol` (
  `NOMBRE_U` varchar(50) NOT NULL,
  `ROL_R` varchar(50) NOT NULL,
  PRIMARY KEY (`NOMBRE_U`,`ROL_R`) USING BTREE,
  KEY `FK_ROL__USUARIO_ROL` (`ROL_R`) USING BTREE,
  CONSTRAINT `FK_ROL__USUARIO_ROL` FOREIGN KEY (`ROL_R`) REFERENCES `rol` (`ROL_R`),
  CONSTRAINT `FK_USUARIO__USUARIO_ROL` FOREIGN KEY (`NOMBRE_U`) REFERENCES `usuario` (`NOMBRE_U`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of usuario_rol
-- ----------------------------
INSERT INTO `usuario_rol` VALUES ('Admin1', 'administrador');
INSERT INTO `usuario_rol` VALUES ('Admin2', 'administrador');
INSERT INTO `usuario_rol` VALUES ('Corina', 'asesor');
INSERT INTO `usuario_rol` VALUES ('David', 'asesor');
INSERT INTO `usuario_rol` VALUES ('LeticiaB', 'asesor');
INSERT INTO `usuario_rol` VALUES ('MarcoA', 'asesor');
INSERT INTO `usuario_rol` VALUES ('Patricia', 'asesor');
INSERT INTO `usuario_rol` VALUES ('AgileA', 'grupoEmpresa');
INSERT INTO `usuario_rol` VALUES ('Arkano', 'grupoEmpresa');
INSERT INTO `usuario_rol` VALUES ('Camaleon', 'grupoEmpresa');
INSERT INTO `usuario_rol` VALUES ('Colective', 'grupoEmpresa');
INSERT INTO `usuario_rol` VALUES ('FreeValue', 'grupoEmpresa');
INSERT INTO `usuario_rol` VALUES ('Oasis', 'grupoEmpresa');
INSERT INTO `usuario_rol` VALUES ('Power', 'grupoEmpresa');
-- ----------------------------
-- Procedure structure for insert_gestion
-- ----------------------------
DROP PROCEDURE IF EXISTS `insert_gestion`;
DELIMITER ;;
CREATE PROCEDURE `insert_gestion`(in gestion varchar(25), f_ini date, f_fin date)
BEGIN
DECLARE anio_actual, anio_f_ini integer;
set anio_actual = YEAR(CURDATE()); 
set anio_f_ini = YEAR(f_ini);

IF(anio_f_ini >= anio_actual)THEN
 IF(f_ini > f_fin) THEN
  SELECT "La fecha de inicio no puede ser mayor a la de fin" as errno;
 ELSE
  SELECT "Se registro la gestion" as errno;
  INSERT INTO GESTION(NOM_G,FECHA_INICIO_G,FECHA_FIN_G) values(gestion,f_ini,f_fin);
 END IF;
ELSE
    SELECT "Las gestiones deben ser posteriores a la fecha actual" as errno;
  END IF;
END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for insert_socio
-- ----------------------------
DROP PROCEDURE IF EXISTS `insert_socio`;
DELIMITER ;;
CREATE PROCEDURE `insert_socio`(in n_u varchar(25), nombre varchar(25) , apellido varchar(25))
BEGIN
DECLARE cantT integer;
DECLARE numSocP integer;
DECLARE rest integer;
SET cantT = (select count(*) from socio where NOMBRE_U=n_u);
SET numSocP = (select NUM_SOCIOS FROM grupo_empresa WHERE  NOMBRE_U=n_u);
SET rest = (numSocP - cantT);
IF (rest > 0) 
THEN
  INSERT INTO socio(NOMBRE_U,NOMBRES_S,APELLIDOS_S) VALUES (n_u,nombre,apellido);
  SELECT "Se registro correctamente" as errno;
 ELSE
  SELECT "Ya se registraron todos los socios" as errno;
 END IF;
END
;;
DELIMITER ;
-- ----------------------------
-- Procedure structure for registro_administrador
-- ----------------------------
DROP PROCEDURE IF EXISTS `registro_administrador`;
DELIMITER ;;
CREATE PROCEDURE `registro_administrador`(in nom varchar(25), ape varchar(25), nom_u varchar(25), telef integer, passwd varchar(25), email varchar(25))
BEGIN

 declare n INTEGER;
 declare a INTEGER;
 declare n_u INTEGER;
 declare t INTEGER;
 declare p INTEGER;
 declare e INTEGER;
 

  set n = (SELECT nom REGEXP '[A-Z]{1}[a-z]{2,20}$');
  set a = (SELECT ape REGEXP '[A-Z]{1}[a-z]{2,20}\s?([A-Z]{1}[a-z]{2,20})?');
  set n_u = (SELECT nom_u REGEXP '^[a-zA-Z]{3}[a-zA-z0-9_\\_\ü]{0,9}$');
  set t = (SELECT telef REGEXP '^(([4][0-9]{6})|([7|6][0-9]{7}))$');
  set p = (select passwd REGEXP '.{8,}');
  set e = (SELECT email REGEXP '^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$');
  
  CASE 0
  
   WHEN n THEN (select "Los nombres deben contener caracteres válidos de 2 a 30 caracteres" as mensaje);
   WHEN a THEN (select "Los apellidos deben contener caracteres válidos de 2 a 30 caracteres" as mensaje);
   WHEN n_u THEN (select "Nombre de usuario debe contener caracteres y numeros validos de 8 a 16 caracteres" as mensaje);
   WHEN t THEN (select "Los numeros telefonicos tiene que empezar por 4,6 o 7 y deben tener un tamaño de 7 a 8 caracteres" as mensaje);
   WHEN p THEN (select "La contraseña debe de ser mayor a 5 caracteres" as mensaje);
   WHEN e THEN (select "Ingrese un correo valido" as mensaje);
   
  ELSE 

   INSERT INTO usuario VALUES(nom_u,'Habilitado',MD5(passwd),telef,email); 
   INSERT INTO usuario_rol VALUES(nom_u,'administrador');  
   INSERT INTO administrador VALUES (nom_u,nom,ape);
  
  SELECT "Se registro correctamente" as mensaje;

  END CASE;
  
  END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for registro_grupo_empresa
-- ----------------------------
DROP PROCEDURE IF EXISTS `registro_grupo_empresa`;
DELIMITER ;;
CREATE PROCEDURE `registro_grupo_empresa`(in nom_u varchar(25), telef integer, passwd varchar(25), email varchar(25), direcc varchar(25),nge_largo varchar(25),nge_corto varchar(25))
BEGIN

 declare t INTEGER;
 declare e INTEGER;
 
 declare n_u INTEGER;
 declare p INTEGER;
 declare n_l INTEGER;
 declare n_c INTEGER;
 
  set n_u = (SELECT nom_u REGEXP '^[a-zA-Z]{3}[a-zA-z0-9_\\_\ü]{0,9}$');
  set t = (SELECT telef REGEXP '^(([4][0-9]{6})|([7|6][0-9]{7}))$');
  set p = (select passwd REGEXP '.{8,}');
  set e = (SELECT email REGEXP '^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$');
  set n_l = (select nge_largo REGEXP '.{3}');
  set n_c = (select nge_corto REGEXP '.{3}');                         
  
  CASE 0

   WHEN n_u THEN (select "Nombre de usuario debe contener caracteres y numeros validos de 8 a 16 caracteres" as mensaje);
   WHEN t THEN (select "Los numeros telefonicos tiene que empezar por 4,6 o 7 y deben tener un tamaño de 7 a 8 caracteres" as mensaje);
   WHEN p THEN (select "La contraseña debe de ser mayor a 8 caracteres" as mensaje);
   WHEN e THEN (select "Ingrese un correo valido" as mensaje);
   WHEN n_l THEN (select "Nombre largo para grupo empresa tiene q tener mas de 3 caracteres" as mensaje);
   WHEN n_c THEN (select "Nombre corto para grupo empresa tiene q tener mas de 3 caracteres" as mensaje);  

  ELSE 

  INSERT INTO usuario VALUES (nom_u,'habilitado',passwd,telef,email);

  INSERT INTO grupo_empresa VALUES (nom_u,nge_corto, nge_largo,direcc,"",5);

  INSERT INTO usuario_rol VALUES (nom_u,'grupoEmpresa');
  
  SELECT "Se registro correctamente" as mensaje;
  END CASE;
  
  END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for registro_usuario
-- ----------------------------
DROP PROCEDURE IF EXISTS `registro_usuario`;
DELIMITER ;;
CREATE PROCEDURE `registro_usuario`(in nom varchar(25), ape varchar(25), nom_u varchar(25), telef integer, passwd varchar(25), email varchar(25), rol varchar(25))
BEGIN

 declare n INTEGER;
 declare a INTEGER;
 declare n_u INTEGER;
 declare t INTEGER;
 declare p INTEGER;
 declare e INTEGER;
 

  set n = (SELECT nom REGEXP '[A-Z]{1}[a-z]{2,20}$');
  set a = (SELECT ape REGEXP '[A-Z]{1}[a-z]{2,20}\s?([A-Z]{1}[a-z]{2,20})?');
  set n_u = (SELECT nom_u REGEXP '^[a-zA-Z]{3}[a-zA-z0-9_\\_\ü]{0,9}$');
  set t = (SELECT telef REGEXP '^(([4][0-9]{6})|([7|6][0-9]{7}))$');
  set p = (select passwd REGEXP '.{8,}');
  set e = (SELECT email REGEXP '^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$');
  
  CASE 0
  
   WHEN n THEN (select "Los nombres deben contener caracteres válidos de 2 a 30 caracteres" as mensaje);
   WHEN a THEN (select "Los apellidos deben contener caracteres válidos de 2 a 30 caracteres" as mensaje);
   WHEN n_u THEN (select "Nombre de usuario debe contener caracteres y numeros validos de 8 a 16 caracteres" as mensaje);
   WHEN t THEN (select "Los numeros telefonicos tiene que empezar por 4,6 o 7 y deben tener un tamaño de 7 a 8 caracteres" as mensaje);
   WHEN p THEN (select "La contraseña debe de ser mayor a 5 caracteres" as mensaje);
   WHEN e THEN (select "Ingrese un correo valido" as mensaje);
   
  ELSE 

   INSERT INTO usuario VALUES(nom_u,'Deshabilitado',MD5(passwd),telef,email); 
   INSERT INTO asesor VALUES(nom_u,nom,ape);  
   INSERT INTO usuario_rol VALUES(nom_u,rol);  
   INSERT INTO criteriocalificacion(NOMBRE_U,NOMBRE_CRITERIO_C,TIPO_CRITERIO) VALUES(nom_u,'PUNTAJE','4');
  
  SELECT "Se registro correctamente" as mensaje;

  END CASE;
  
  END
;;
DELIMITER ;

