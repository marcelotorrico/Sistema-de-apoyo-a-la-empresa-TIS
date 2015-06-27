/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50527
Source Host           : localhost:3306
Source Database       : saetis

Target Server Type    : MYSQL
Target Server Version : 50527
File Encoding         : 65001

Date: 2015-06-24 16:54:59
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of criteriocalificacion
-- ----------------------------
INSERT INTO `criteriocalificacion` VALUES ('6', 'LeticiaB', 'A(100)B(80)C(60)D(30)', '1');
INSERT INTO `criteriocalificacion` VALUES ('7', 'LeticiaB', 'Verdadero(100)Falso(50)', '2');
INSERT INTO `criteriocalificacion` VALUES ('8', 'LeticiaB', 'Excelente(100)Bueno(80)Regular(50)Malo(30)Pes', '1');
INSERT INTO `criteriocalificacion` VALUES ('9', 'LeticiaB', 'Si(80)No(20)', '3');
INSERT INTO `criteriocalificacion` VALUES ('10', 'LeticiaB', 'Si(90)No(20)', '3');

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
INSERT INTO `descripcion` VALUES ('95', 'el documento contiene las partes A y B que deberan ser presentados..........');
INSERT INTO `descripcion` VALUES ('96', 'Entregar toda la documentacion');
INSERT INTO `descripcion` VALUES ('97', 'E');
INSERT INTO `descripcion` VALUES ('100', 'En este documento......');
INSERT INTO `descripcion` VALUES ('113', 'Orden de Cambio');
INSERT INTO `descripcion` VALUES ('114', 'Orden de Cambio');
INSERT INTO `descripcion` VALUES ('115', 'Orden de Cambio');
INSERT INTO `descripcion` VALUES ('116', 'Orden de Cambio');
INSERT INTO `descripcion` VALUES ('117', 'Orden de Cambio');
INSERT INTO `descripcion` VALUES ('118', 'Orden de Cambio');
INSERT INTO `descripcion` VALUES ('121', 'Notificacion de Conformidad');
INSERT INTO `descripcion` VALUES ('122', 'Notificacion de Conformidad');
INSERT INTO `descripcion` VALUES ('123', 'Notificacion de Conformidad');
INSERT INTO `descripcion` VALUES ('124', 'Notificacion de Conformidad');
INSERT INTO `descripcion` VALUES ('125', 'Notificacion de Conformidad');
INSERT INTO `descripcion` VALUES ('126', 'Notificacion de Conformidad');
INSERT INTO `descripcion` VALUES ('169', 'Contrato');
INSERT INTO `descripcion` VALUES ('200', 'Contrato');
INSERT INTO `descripcion` VALUES ('201', 'Contrato');
INSERT INTO `descripcion` VALUES ('202', 'Contrato');
INSERT INTO `descripcion` VALUES ('203', 'Contrato');
INSERT INTO `descripcion` VALUES ('204', 'Contrato');
INSERT INTO `descripcion` VALUES ('205', 'Orden de Cambio');
INSERT INTO `descripcion` VALUES ('206', 'Orden de Cambio');
INSERT INTO `descripcion` VALUES ('207', 'Orden de Cambio');
INSERT INTO `descripcion` VALUES ('208', 'Orden de Cambio');

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
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of documento
-- ----------------------------
INSERT INTO `documento` VALUES ('27', '98', '1024', '/Repositorio/asesor/CPTIS.pdf', '1', '1');
INSERT INTO `documento` VALUES ('28', '99', '1024', '/Repositorio/asesor/FETIS.pdf', '1', '1');
INSERT INTO `documento` VALUES ('29', '100', '1024', 'http://bittle.cs.umss.edu.bo/Repositorio/asesor/CPTIS.pdf', '0', '0');
INSERT INTO `documento` VALUES ('30', '101', '964992', '/Repositorio/SLOW/ParteA_SLOWCODE.pdf', '1', '1');
INSERT INTO `documento` VALUES ('31', '102', '925210', '/Repositorio/SLOW/ParteB_SLOWCODE.pdf', '1', '1');
INSERT INTO `documento` VALUES ('32', '103', '1447698', '/Repositorio/InnovaTe/ParteA_Innovate.pdf', '1', '1');
INSERT INTO `documento` VALUES ('33', '104', '1327903', '/Repositorio/InnovaTe/ParteB_InnovaTe.pdf', '1', '1');
INSERT INTO `documento` VALUES ('34', '105', '32441', '/Repositorio/SAADS/ActaConstitucion.docx', '1', '1');
INSERT INTO `documento` VALUES ('35', '106', '265360', '/Repositorio/SAADS/PropuestaTecnica.docx', '1', '1');
INSERT INTO `documento` VALUES ('36', '107', '676307', '/Repositorio/NetSky/ParteA_NetSky.pdf', '1', '1');
INSERT INTO `documento` VALUES ('37', '108', '804432', '/Repositorio/NetSky/ParteB_NetSky.pdf', '1', '1');
INSERT INTO `documento` VALUES ('38', '109', '639524', '/Repositorio/MAD/ActaDeConstitucion.pdf', '1', '1');
INSERT INTO `documento` VALUES ('39', '110', '720426', '/Repositorio/MAD/PropuestaTecnica.pdf', '1', '1');
INSERT INTO `documento` VALUES ('40', '111', '607194', '/Repositorio/Devs/DevsGroup_ParteA.pdf', '1', '1');
INSERT INTO `documento` VALUES ('41', '112', '1584338', '/Repositorio/Devs/DevsGroup_parteB.pdf', '1', '1');
INSERT INTO `documento` VALUES ('42', '113', '1024', '../Repositorio/Devs/OC/OrdenCambio.pdf', '0', '0');
INSERT INTO `documento` VALUES ('43', '114', '1024', '../Repositorio/InnovaTe/OC/OrdenCambio.pdf', '0', '0');
INSERT INTO `documento` VALUES ('44', '115', '1024', '../Repositorio/MAD/OC/OrdenCambio.pdf', '0', '0');
INSERT INTO `documento` VALUES ('45', '116', '1024', '../Repositorio/NetSky/OC/OrdenCambio.pdf', '0', '0');
INSERT INTO `documento` VALUES ('46', '117', '1024', '../Repositorio/SAADS/OC/OrdenCambio.pdf', '0', '0');
INSERT INTO `documento` VALUES ('47', '118', '1024', '../Repositorio/SLOW/OC/OrdenCambio.pdf', '0', '0');
INSERT INTO `documento` VALUES ('48', '121', '1024', '../Repositorio/Devs/NC/NotificacionConformidad.pdf', '0', '0');
INSERT INTO `documento` VALUES ('49', '122', '1024', '../Repositorio/InnovaTe/NC/NotificacionConformidad.pdf', '0', '0');
INSERT INTO `documento` VALUES ('50', '123', '1024', '../Repositorio/MAD/NC/NotificacionConformidad.pdf', '0', '0');
INSERT INTO `documento` VALUES ('51', '124', '1024', '../Repositorio/NetSky/NC/NotificacionConformidad.pdf', '0', '0');
INSERT INTO `documento` VALUES ('52', '125', '1024', '../Repositorio/SAADS/NC/NotificacionConformidad.pdf', '0', '0');
INSERT INTO `documento` VALUES ('53', '126', '1024', '../Repositorio/SLOW/NC/NotificacionConformidad.pdf', '0', '0');
INSERT INTO `documento` VALUES ('54', '169', '1024', '../Repositorio/LeticiaB/Contratos/ContratoNetSky.pdf', '0', '0');
INSERT INTO `documento` VALUES ('55', '200', '1024', '../Repositorio/LeticiaB/Contratos/ContratoSAADS.pdf', '0', '0');
INSERT INTO `documento` VALUES ('56', '201', '1024', '../Repositorio/LeticiaB/Contratos/ContratoSLOWCODE.pdf', '0', '0');
INSERT INTO `documento` VALUES ('57', '202', '1024', '../Repositorio/LeticiaB/Contratos/ContratoDevsGroup.pdf', '0', '0');
INSERT INTO `documento` VALUES ('58', '203', '1024', '../Repositorio/LeticiaB/Contratos/ContratoMAD.pdf', '0', '0');
INSERT INTO `documento` VALUES ('59', '204', '1024', '../Repositorio/LeticiaB/Contratos/ContratoInnovaTe.pdf', '0', '0');
INSERT INTO `documento` VALUES ('62', '205', '1024', '/Repositorio/InnovaTe/ParteB_InnovaTe.pdf', '1', '1');
INSERT INTO `documento` VALUES ('63', '206', '1024', '../Repositorio/Innovando Tecnologia SRL/OC/ordenDe', '1', '1');
INSERT INTO `documento` VALUES ('64', '207', '1024', '../Repositorio/Seleccione una grupo empresa/OC/ord', '1', '1');
INSERT INTO `documento` VALUES ('65', '208', '1024', '../Repositorio/DevsGroup SRL/OC/ordenDeCambio.pdf', '1', '1');

-- ----------------------------
-- Table structure for `documento_r`
-- ----------------------------
DROP TABLE IF EXISTS `documento_r`;
CREATE TABLE `documento_r` (
  `ID_R` int(11) NOT NULL AUTO_INCREMENT,
  `CODIGO_P` int(11) NOT NULL,
  PRIMARY KEY (`ID_R`)
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of documento_r
-- ----------------------------
INSERT INTO `documento_r` VALUES ('96', '4');
INSERT INTO `documento_r` VALUES ('97', '4');

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
INSERT INTO `entrega` VALUES ('165', 'documentaciÃƒÂ³n', '0');
INSERT INTO `entrega` VALUES ('166', 'documentaciÃƒÂ³n', '0');
INSERT INTO `entrega` VALUES ('167', 'documentaciÃƒÂ³n', '0');
INSERT INTO `entrega` VALUES ('168', 'documentaciÃƒÂ³n', '0');
INSERT INTO `entrega` VALUES ('170', 'Documento', '0');
INSERT INTO `entrega` VALUES ('171', 'Informe', '0');
INSERT INTO `entrega` VALUES ('172', 'Informe', '0');
INSERT INTO `entrega` VALUES ('173', 'Informe', '0');
INSERT INTO `entrega` VALUES ('174', 'Informe', '0');
INSERT INTO `entrega` VALUES ('175', 'Informe', '0');
INSERT INTO `entrega` VALUES ('176', 'Informe', '0');
INSERT INTO `entrega` VALUES ('177', 'Informe', '0');
INSERT INTO `entrega` VALUES ('178', 'Documento', '1');
INSERT INTO `entrega` VALUES ('179', 'Informe', '1');
INSERT INTO `entrega` VALUES ('180', 'Informe', '1');
INSERT INTO `entrega` VALUES ('181', 'Informe', '1');
INSERT INTO `entrega` VALUES ('182', 'Informe', '1');
INSERT INTO `entrega` VALUES ('183', 'Informe', '1');
INSERT INTO `entrega` VALUES ('184', 'Informe', '0');
INSERT INTO `entrega` VALUES ('185', 'Informe', '0');
INSERT INTO `entrega` VALUES ('186', 'Documento', '0');
INSERT INTO `entrega` VALUES ('187', 'Documento', '0');
INSERT INTO `entrega` VALUES ('188', 'Documento', '0');
INSERT INTO `entrega` VALUES ('189', 'Documento', '0');
INSERT INTO `entrega` VALUES ('190', 'Documento', '0');
INSERT INTO `entrega` VALUES ('191', 'Documento', '0');
INSERT INTO `entrega` VALUES ('192', 'Documento', '0');
INSERT INTO `entrega` VALUES ('192', 'Informe', '0');
INSERT INTO `entrega` VALUES ('193', 'Informe', '0');
INSERT INTO `entrega` VALUES ('194', 'Informe', '0');
INSERT INTO `entrega` VALUES ('195', 'Informe', '0');
INSERT INTO `entrega` VALUES ('196', 'Informe', '0');
INSERT INTO `entrega` VALUES ('197', 'Informe', '0');
INSERT INTO `entrega` VALUES ('198', 'Informe', '0');
INSERT INTO `entrega` VALUES ('199', 'Informe', '0');

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
INSERT INTO `entregable` VALUES ('Devs', 'Documento', 'Documento del contrato');
INSERT INTO `entregable` VALUES ('Devs', 'Informe', 'Informe sobre el estado del proyecto');
INSERT INTO `entregable` VALUES ('InnovaTe', 'CD', 'Ultima versiÃƒÂ³n del cÃƒÂ³digo fuente');
INSERT INTO `entregable` VALUES ('InnovaTe', 'Informe', 'DescripciÃƒÂ³n del sistema actual');
INSERT INTO `entregable` VALUES ('MAD', 'Documento', 'Documento de evaluaciÃƒÂ³n y pruebas');
INSERT INTO `entregable` VALUES ('MAD', 'Informe', 'Informe QC');
INSERT INTO `entregable` VALUES ('NetSky', 'documentaciÃƒÂ³n', 'Protocolo de validaciÃƒÂ³n');
INSERT INTO `entregable` VALUES ('SAADS', 'Informe', 'descripciÃƒÂ³n del sistema actual');
INSERT INTO `entregable` VALUES ('SLOW', 'Documento', 'Protocolo de validaciÃƒÂ³n de los Sprint');
INSERT INTO `entregable` VALUES ('SLOW', 'Informe', 'Informe de la iteraciÃƒÂ³n');

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of evaluacion
-- ----------------------------
INSERT INTO `evaluacion` VALUES ('119', '8', '0', '0');
INSERT INTO `evaluacion` VALUES ('120', '1', '16', '20');
INSERT INTO `evaluacion` VALUES ('159', '2', '4', '5');
INSERT INTO `evaluacion` VALUES ('160', '3', '3', '5');
INSERT INTO `evaluacion` VALUES ('161', '4', '11', '20');
INSERT INTO `evaluacion` VALUES ('162', '5', '13', '20');
INSERT INTO `evaluacion` VALUES ('163', '6', '9', '20');
INSERT INTO `evaluacion` VALUES ('164', '7', '7', '10');

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
INSERT INTO `fecha_realizacion` VALUES ('119', '2015-03-28');
INSERT INTO `fecha_realizacion` VALUES ('120', '2015-04-01');
INSERT INTO `fecha_realizacion` VALUES ('127', '2015-03-27');
INSERT INTO `fecha_realizacion` VALUES ('128', '2015-03-27');
INSERT INTO `fecha_realizacion` VALUES ('129', '2015-04-26');
INSERT INTO `fecha_realizacion` VALUES ('130', '2015-04-02');
INSERT INTO `fecha_realizacion` VALUES ('131', '2015-04-16');
INSERT INTO `fecha_realizacion` VALUES ('132', '2015-04-30');
INSERT INTO `fecha_realizacion` VALUES ('133', '2015-05-14');
INSERT INTO `fecha_realizacion` VALUES ('134', '2015-06-05');
INSERT INTO `fecha_realizacion` VALUES ('135', '2015-06-15');
INSERT INTO `fecha_realizacion` VALUES ('136', '2015-03-26');
INSERT INTO `fecha_realizacion` VALUES ('137', '2015-03-26');
INSERT INTO `fecha_realizacion` VALUES ('138', '2015-03-26');
INSERT INTO `fecha_realizacion` VALUES ('139', '2015-03-16');
INSERT INTO `fecha_realizacion` VALUES ('140', '2015-03-30');
INSERT INTO `fecha_realizacion` VALUES ('141', '2015-04-03');
INSERT INTO `fecha_realizacion` VALUES ('142', '2015-04-17');
INSERT INTO `fecha_realizacion` VALUES ('143', '2015-05-01');
INSERT INTO `fecha_realizacion` VALUES ('144', '2015-05-15');
INSERT INTO `fecha_realizacion` VALUES ('145', '2015-05-29');
INSERT INTO `fecha_realizacion` VALUES ('146', '2015-06-12');
INSERT INTO `fecha_realizacion` VALUES ('147', '2015-03-27');
INSERT INTO `fecha_realizacion` VALUES ('148', '2016-04-10');
INSERT INTO `fecha_realizacion` VALUES ('149', '2015-04-24');
INSERT INTO `fecha_realizacion` VALUES ('150', '2015-05-08');
INSERT INTO `fecha_realizacion` VALUES ('151', '2015-05-22');
INSERT INTO `fecha_realizacion` VALUES ('152', '2015-06-05');
INSERT INTO `fecha_realizacion` VALUES ('153', '2015-06-12');
INSERT INTO `fecha_realizacion` VALUES ('154', '2015-06-19');
INSERT INTO `fecha_realizacion` VALUES ('155', '2015-03-30');
INSERT INTO `fecha_realizacion` VALUES ('156', '2015-04-17');
INSERT INTO `fecha_realizacion` VALUES ('157', '2015-05-16');
INSERT INTO `fecha_realizacion` VALUES ('158', '2015-06-17');
INSERT INTO `fecha_realizacion` VALUES ('159', '2015-03-27');
INSERT INTO `fecha_realizacion` VALUES ('160', '2015-04-03');
INSERT INTO `fecha_realizacion` VALUES ('161', '2015-03-17');
INSERT INTO `fecha_realizacion` VALUES ('162', '2015-05-01');
INSERT INTO `fecha_realizacion` VALUES ('163', '2015-05-15');
INSERT INTO `fecha_realizacion` VALUES ('164', '2015-05-29');
INSERT INTO `fecha_realizacion` VALUES ('165', '0000-00-00');
INSERT INTO `fecha_realizacion` VALUES ('166', '0000-00-00');
INSERT INTO `fecha_realizacion` VALUES ('167', '0000-00-00');
INSERT INTO `fecha_realizacion` VALUES ('168', '0000-00-00');
INSERT INTO `fecha_realizacion` VALUES ('170', '0000-00-00');
INSERT INTO `fecha_realizacion` VALUES ('171', '0000-00-00');
INSERT INTO `fecha_realizacion` VALUES ('172', '0000-00-00');
INSERT INTO `fecha_realizacion` VALUES ('173', '0000-00-00');
INSERT INTO `fecha_realizacion` VALUES ('174', '0000-00-00');
INSERT INTO `fecha_realizacion` VALUES ('175', '0000-00-00');
INSERT INTO `fecha_realizacion` VALUES ('176', '0000-00-00');
INSERT INTO `fecha_realizacion` VALUES ('177', '0000-00-00');
INSERT INTO `fecha_realizacion` VALUES ('178', '0000-00-00');
INSERT INTO `fecha_realizacion` VALUES ('179', '0000-00-00');
INSERT INTO `fecha_realizacion` VALUES ('180', '0000-00-00');
INSERT INTO `fecha_realizacion` VALUES ('181', '0000-00-00');
INSERT INTO `fecha_realizacion` VALUES ('182', '0000-00-00');
INSERT INTO `fecha_realizacion` VALUES ('183', '0000-00-00');
INSERT INTO `fecha_realizacion` VALUES ('184', '0000-00-00');
INSERT INTO `fecha_realizacion` VALUES ('185', '0000-00-00');
INSERT INTO `fecha_realizacion` VALUES ('186', '0000-00-00');
INSERT INTO `fecha_realizacion` VALUES ('187', '0000-00-00');
INSERT INTO `fecha_realizacion` VALUES ('188', '0000-00-00');
INSERT INTO `fecha_realizacion` VALUES ('189', '0000-00-00');
INSERT INTO `fecha_realizacion` VALUES ('190', '0000-00-00');
INSERT INTO `fecha_realizacion` VALUES ('191', '0000-00-00');
INSERT INTO `fecha_realizacion` VALUES ('192', '0000-00-00');
INSERT INTO `fecha_realizacion` VALUES ('193', '0000-00-00');
INSERT INTO `fecha_realizacion` VALUES ('194', '0000-00-00');
INSERT INTO `fecha_realizacion` VALUES ('195', '0000-00-00');
INSERT INTO `fecha_realizacion` VALUES ('196', '0000-00-00');
INSERT INTO `fecha_realizacion` VALUES ('197', '0000-00-00');
INSERT INTO `fecha_realizacion` VALUES ('198', '0000-00-00');
INSERT INTO `fecha_realizacion` VALUES ('199', '0000-00-00');

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=8192;

-- ----------------------------
-- Records of gestion
-- ----------------------------
INSERT INTO `gestion` VALUES ('1', 'I/2015', '2015-01-01', '2015-06-30');
INSERT INTO `gestion` VALUES ('8', 'I/2015', '2015-03-25', '2015-06-25');

-- ----------------------------
-- Table structure for `grupo_empresa`
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
INSERT INTO `grupo_empresa` VALUES ('AgileA', 'Agile', 'AgileAction', 'Calle Agil', 'Nombre1 Apellido1', '5');
INSERT INTO `grupo_empresa` VALUES ('AiraSoft', 'AiraSoft', 'AiraSoft SRL', 'ppppppppp', '', '5');
INSERT INTO `grupo_empresa` VALUES ('Akira', 'Akira', 'Akira Soft', 'dfghjklhgfhkkhhg', '', '5');
INSERT INTO `grupo_empresa` VALUES ('Altec', 'Altec', 'Experiencia y Alata Tecno', 'jnijnijjnjnn', '', '5');
INSERT INTO `grupo_empresa` VALUES ('ANDE', 'ANDESOFT', 'ANDESOFT SRL', 'cbdwciwbcwb', '', '5');
INSERT INTO `grupo_empresa` VALUES ('Angel', 'Angel Fire', 'Angel Fire SRL', 'xkcdbckk', '', '5');
INSERT INTO `grupo_empresa` VALUES ('ANKA', 'ANKA SOFT', 'ANKA SOFT SRL', 'hvvhdov', '', '5');
INSERT INTO `grupo_empresa` VALUES ('Answer', 'Answer', 'Answer SRL', 'usuhbcubus', '', '5');
INSERT INTO `grupo_empresa` VALUES ('Aracorp', 'Aracorp', 'Aracorp SRL', 'bjdbvhbdvb', '', '5');
INSERT INTO `grupo_empresa` VALUES ('ARGOS', 'ARGOS', 'ARGOS SRL', 'ivnfivnidfvndnv', '', '5');
INSERT INTO `grupo_empresa` VALUES ('Arkano', 'Arkano', 'Arkano Soft', 'Av Santa Cruz', '', '5');
INSERT INTO `grupo_empresa` VALUES ('Aska', 'Aska', 'Aska SRL', 'hbvhfdvhdbv', '', '5');
INSERT INTO `grupo_empresa` VALUES ('ASSI', 'ASSI', 'ASSI SRL', 'shhjsbcsb', '', '5');
INSERT INTO `grupo_empresa` VALUES ('Devs', 'Devs Group', 'DevsGroup SRL', 'Av.Ladislao Cabrera NÂ°567', 'Vania Marisela Catorceno Carballo', '5');
INSERT INTO `grupo_empresa` VALUES ('FreeValue', 'FreeValue', 'FreeValue SRL', 'Calle F', 'Oscar Gamboa Acho', '5');
INSERT INTO `grupo_empresa` VALUES ('InnovaTe', 'InnovaTe', 'Innovando Tecnologia SRL', 'C. Tarija NÂ°1520', 'Antonio Alurralde', '5');
INSERT INTO `grupo_empresa` VALUES ('MAD', 'MAD', 'MAD SOFTWARE SRL', 'Av. Rodriguez Morales N&d', 'Juan Manuel Castro Arnez', '5');
INSERT INTO `grupo_empresa` VALUES ('NetSky', 'NetSky', 'NetSky System SRL', 'Sipe Sipe Calle Gualberto', 'Ruben Villca FernÃƒÂ¡ndez', '5');
INSERT INTO `grupo_empresa` VALUES ('SAADS', 'SAADS', 'SAADS SRL', 'Av. Melchor Perez #1312', 'Kenji Gabriel Lozano Rosales', '5');
INSERT INTO `grupo_empresa` VALUES ('SLOW', 'SLOW CODE', 'SLOW CODE SRL', 'C/ Dario Monta&ntilde;o #', 'Rodrigo David Rivera Ortega', '5');

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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

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
INSERT INTO `indicador` VALUES ('12', '9', 'Si', '80');
INSERT INTO `indicador` VALUES ('13', '9', 'No', '20');
INSERT INTO `indicador` VALUES ('14', '10', 'Si', '90');
INSERT INTO `indicador` VALUES ('15', '10', 'No', '20');

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
INSERT INTO `inscripcion` VALUES ('LeticiaB', 'Devs', 'Habilitado');
INSERT INTO `inscripcion` VALUES ('LeticiaB', 'InnovaTe', 'Habilitado');
INSERT INTO `inscripcion` VALUES ('LeticiaB', 'MAD', 'Habilitado');
INSERT INTO `inscripcion` VALUES ('LeticiaB', 'NetSky', 'Habilitado');
INSERT INTO `inscripcion` VALUES ('LeticiaB', 'SAADS', 'Habilitado');
INSERT INTO `inscripcion` VALUES ('LeticiaB', 'SLOW', 'Habilitado');

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
INSERT INTO `inscripcion_proyecto` VALUES ('4', 'Devs', 'Firmado');
INSERT INTO `inscripcion_proyecto` VALUES ('4', 'InnovaTe', 'Firmado');
INSERT INTO `inscripcion_proyecto` VALUES ('4', 'MAD', 'Firmado');
INSERT INTO `inscripcion_proyecto` VALUES ('4', 'NetSky', 'Firmado');
INSERT INTO `inscripcion_proyecto` VALUES ('4', 'SAADS', 'Firmado');
INSERT INTO `inscripcion_proyecto` VALUES ('4', 'SLOW', 'Firmado');

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
INSERT INTO `lista_ge` VALUES ('InnovaTe', 'Innovando Tecnologia SRL', 'C. Tarija N&deg;1520', null);
INSERT INTO `lista_ge` VALUES ('Devs Group', 'DevsGroup SRL', 'Av.Ladislao Cabrera N&deg', null);
INSERT INTO `lista_ge` VALUES ('MAD', 'MAD SOFTWARE SRL', 'Av. Rodriguez Morales N&d', null);
INSERT INTO `lista_ge` VALUES ('SLOW CODE', 'SLOW CODE SRL', 'C/ Dario Monta&ntilde;o #', null);
INSERT INTO `lista_ge` VALUES ('SAADS', 'SAADS SRL', 'Av. Melchor Perez #1312', null);
INSERT INTO `lista_ge` VALUES ('NetSky', 'NetSky System SRL', 'Sipe Sipe Calle Gualberto', null);

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of nota
-- ----------------------------
INSERT INTO `nota` VALUES ('1', '3', 'MAD', '71');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of noticias
-- ----------------------------
INSERT INTO `noticias` VALUES ('2', 'LeticiaB', 'Entrega de Partes A y B', '2015-03-28 20:32:40', '5', 'Subir los documentos hasta la fecha indicada, cualquier duda por aca....<br>', 'LeticiaB');
INSERT INTO `noticias` VALUES ('3', 'Oasis', 'Dudas', '2015-03-28 20:37:07', '9', 'En la parte...<br>', 'Oasis');
INSERT INTO `noticias` VALUES ('4', 'SLOW', 'Parte A', '2015-05-26 07:43:26', '0', 'kdohvifvkdkfvds', 'SLOW');

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
INSERT INTO `pago` VALUES ('165', '11226', '15');
INSERT INTO `pago` VALUES ('166', '22452', '30');
INSERT INTO `pago` VALUES ('167', '26194', '35');
INSERT INTO `pago` VALUES ('168', '14968', '20');
INSERT INTO `pago` VALUES ('170', '13600', '20');
INSERT INTO `pago` VALUES ('171', '6800', '10');
INSERT INTO `pago` VALUES ('172', '6800', '10');
INSERT INTO `pago` VALUES ('173', '8160', '12');
INSERT INTO `pago` VALUES ('174', '8160', '12');
INSERT INTO `pago` VALUES ('175', '8160', '12');
INSERT INTO `pago` VALUES ('176', '9520', '14');
INSERT INTO `pago` VALUES ('177', '6800', '10');
INSERT INTO `pago` VALUES ('178', '24415', '20');
INSERT INTO `pago` VALUES ('179', '6104', '5');
INSERT INTO `pago` VALUES ('180', '6104', '5');
INSERT INTO `pago` VALUES ('181', '24415', '20');
INSERT INTO `pago` VALUES ('182', '24415', '20');
INSERT INTO `pago` VALUES ('183', '24415', '20');
INSERT INTO `pago` VALUES ('184', '12208', '10');
INSERT INTO `pago` VALUES ('185', '7944', '20');
INSERT INTO `pago` VALUES ('186', '3972', '10');
INSERT INTO `pago` VALUES ('187', '5958', '15');
INSERT INTO `pago` VALUES ('188', '5958', '15');
INSERT INTO `pago` VALUES ('189', '3972', '10');
INSERT INTO `pago` VALUES ('190', '3972', '10');
INSERT INTO `pago` VALUES ('191', '3972', '10');
INSERT INTO `pago` VALUES ('192', '3972', '10');
INSERT INTO `pago` VALUES ('193', '11976', '18');
INSERT INTO `pago` VALUES ('194', '11976', '18');
INSERT INTO `pago` VALUES ('195', '11976', '18');
INSERT INTO `pago` VALUES ('196', '11976', '18');
INSERT INTO `pago` VALUES ('197', '6653', '10');
INSERT INTO `pago` VALUES ('198', '3327', '5');
INSERT INTO `pago` VALUES ('199', '8649', '13');

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
INSERT INTO `periodo` VALUES ('95', '2015-03-16', '08:00:00');
INSERT INTO `periodo` VALUES ('100', '2015-05-26', '06:58:00');
INSERT INTO `periodo` VALUES ('113', '2015-05-26', '14:14:28');
INSERT INTO `periodo` VALUES ('114', '2015-05-26', '14:14:35');
INSERT INTO `periodo` VALUES ('115', '2015-05-26', '14:14:44');
INSERT INTO `periodo` VALUES ('116', '2015-05-26', '14:14:55');
INSERT INTO `periodo` VALUES ('117', '2015-05-26', '15:15:23');
INSERT INTO `periodo` VALUES ('118', '2015-05-26', '15:15:26');
INSERT INTO `periodo` VALUES ('121', '2015-05-26', '16:16:11');
INSERT INTO `periodo` VALUES ('122', '2015-05-26', '16:16:13');
INSERT INTO `periodo` VALUES ('123', '2015-05-26', '16:16:14');
INSERT INTO `periodo` VALUES ('124', '2015-05-26', '16:16:15');
INSERT INTO `periodo` VALUES ('125', '2015-05-26', '16:16:16');
INSERT INTO `periodo` VALUES ('126', '2015-05-26', '16:16:17');
INSERT INTO `periodo` VALUES ('205', '2015-06-23', '16:28:49');
INSERT INTO `periodo` VALUES ('206', '2015-06-23', '16:38:28');
INSERT INTO `periodo` VALUES ('207', '2015-06-24', '15:50:01');
INSERT INTO `periodo` VALUES ('208', '2015-06-24', '16:44:43');

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
INSERT INTO `planificacion` VALUES ('Devs', 'planificacion registrada', '2015-03-16', '2015-06-19');
INSERT INTO `planificacion` VALUES ('InnovaTe', 'planificacion registrada', '2015-03-16', '2015-06-19');
INSERT INTO `planificacion` VALUES ('MAD', 'planificacion registrada', '2015-03-16', '2015-06-19');
INSERT INTO `planificacion` VALUES ('NetSky', 'planificacion registrada', '2015-03-16', '2015-06-19');
INSERT INTO `planificacion` VALUES ('SAADS', 'planificacion registrada', '2015-03-16', '2015-06-19');
INSERT INTO `planificacion` VALUES ('SLOW', 'planificacion registrada', '2015-03-16', '2015-06-19');

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
INSERT INTO `plazo` VALUES ('96', '2015-05-26', '2015-05-27', '07:55:00', '17:00:00');
INSERT INTO `plazo` VALUES ('97', '2015-05-26', '2015-05-27', '07:55:00', '17:00:00');

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
INSERT INTO `precio` VALUES ('Devs', '68000', '80');
INSERT INTO `precio` VALUES ('InnovaTe', '27370', '70');
INSERT INTO `precio` VALUES ('MAD', '122075', '70');
INSERT INTO `precio` VALUES ('NetSky', '74840', '75');
INSERT INTO `precio` VALUES ('SAADS', '66532', '70');
INSERT INTO `precio` VALUES ('SLOW', '39718', '75');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=8192;

-- ----------------------------
-- Records of proyecto
-- ----------------------------
INSERT INTO `proyecto` VALUES ('4', '1', 'SAETIS', 'Sistema de apoyo a la empresa TIS', 'CPTIS2015');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of puntaje_ge
-- ----------------------------
INSERT INTO `puntaje_ge` VALUES ('1', '1', '0', '80');
INSERT INTO `puntaje_ge` VALUES ('2', '1', '1', '50');

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
INSERT INTO `receptor` VALUES ('95', 'Todas las Grupo Empresas');
INSERT INTO `receptor` VALUES ('100', 'Todas las Grupo Empresas');
INSERT INTO `receptor` VALUES ('113', 'DevsGroup SRL');
INSERT INTO `receptor` VALUES ('114', 'Innovando Tecnologia SRL');
INSERT INTO `receptor` VALUES ('115', 'MAD SOFTWARE SRL');
INSERT INTO `receptor` VALUES ('116', 'NetSky System SRL');
INSERT INTO `receptor` VALUES ('117', 'SAADS SRL');
INSERT INTO `receptor` VALUES ('118', 'SLOW CODE SRL');
INSERT INTO `receptor` VALUES ('121', 'DevsGroup SRL');
INSERT INTO `receptor` VALUES ('122', 'Innovando Tecnologia SRL');
INSERT INTO `receptor` VALUES ('123', 'MAD SOFTWARE SRL');
INSERT INTO `receptor` VALUES ('124', 'NetSky System SRL');
INSERT INTO `receptor` VALUES ('125', 'SAADS SRL');
INSERT INTO `receptor` VALUES ('126', 'SLOW CODE SRL');
INSERT INTO `receptor` VALUES ('169', 'NetSky System SRL');
INSERT INTO `receptor` VALUES ('200', 'SAADS SRL');
INSERT INTO `receptor` VALUES ('201', 'SLOW CODE SRL');
INSERT INTO `receptor` VALUES ('202', 'DevsGroup SRL');
INSERT INTO `receptor` VALUES ('203', 'MAD SOFTWARE SRL');
INSERT INTO `receptor` VALUES ('204', 'Innovando Tecnologia SRL');
INSERT INTO `receptor` VALUES ('205', 'Innovando Tecnologia SRL');
INSERT INTO `receptor` VALUES ('206', 'Innovando Tecnologia SRL');
INSERT INTO `receptor` VALUES ('207', 'Seleccione una grupo empresa');
INSERT INTO `receptor` VALUES ('208', 'DevsGroup SRL');

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
) ENGINE=InnoDB AUTO_INCREMENT=209 DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=8192;

-- ----------------------------
-- Records of registro
-- ----------------------------
INSERT INTO `registro` VALUES ('94', 'LeticiaB', 'documento subido', 'Habilitado', 'CPTIS.PDF', '2015-05-25', '16:16:31');
INSERT INTO `registro` VALUES ('95', 'LeticiaB', 'publicaciones', 'Habilitado', 'CPTIS', '2015-05-25', '23:23:44');
INSERT INTO `registro` VALUES ('96', 'LeticiaB', 'documento requerido', 'Habilitado', 'Parte A', '2015-05-25', '18:04:41');
INSERT INTO `registro` VALUES ('97', 'LeticiaB', 'documento requerido', 'Habilitado', 'Parte B', '2015-05-25', '18:29:56');
INSERT INTO `registro` VALUES ('98', 'LeticiaB', 'documento subido', 'Habilitado', 'CPTIS.pdf', '2015-05-26', '07:07:47');
INSERT INTO `registro` VALUES ('99', 'LeticiaB', 'documento subido', 'Habilitado', 'FETIS.pdf', '2015-05-26', '07:07:47');
INSERT INTO `registro` VALUES ('100', 'LeticiaB', 'publicaciones', 'Habilitado', 'Partes A y B', '2015-05-26', '13:13:55');
INSERT INTO `registro` VALUES ('101', 'SLOW', 'documento subido', 'habilitado', 'Parte A', '2015-05-26', '07:07:58');
INSERT INTO `registro` VALUES ('102', 'SLOW', 'documento subido', 'habilitado', 'Parte B', '2015-05-26', '07:07:58');
INSERT INTO `registro` VALUES ('103', 'InnovaTe', 'documento subido', 'habilitado', 'Parte A', '2015-05-26', '08:08:00');
INSERT INTO `registro` VALUES ('104', 'InnovaTe', 'documento subido', 'habilitado', 'Parte B', '2015-05-26', '08:08:00');
INSERT INTO `registro` VALUES ('105', 'SAADS', 'documento subido', 'habilitado', 'Parte A', '2015-05-26', '08:08:02');
INSERT INTO `registro` VALUES ('106', 'SAADS', 'documento subido', 'habilitado', 'Parte B', '2015-05-26', '08:08:03');
INSERT INTO `registro` VALUES ('107', 'NetSky', 'documento subido', 'habilitado', 'Parte A', '2015-05-26', '08:08:15');
INSERT INTO `registro` VALUES ('108', 'NetSky', 'documento subido', 'habilitado', 'Parte B', '2015-05-26', '08:08:16');
INSERT INTO `registro` VALUES ('109', 'MAD', 'documento subido', 'habilitado', 'Parte A', '2015-05-26', '08:08:18');
INSERT INTO `registro` VALUES ('110', 'MAD', 'documento subido', 'habilitado', 'Parte B', '2015-05-26', '08:08:19');
INSERT INTO `registro` VALUES ('111', 'Devs', 'documento subido', 'habilitado', 'Parte A', '2015-05-26', '08:08:20');
INSERT INTO `registro` VALUES ('112', 'Devs', 'documento subido', 'habilitado', 'Parte B', '2015-05-26', '08:08:20');
INSERT INTO `registro` VALUES ('113', 'LeticiaB', 'publicaciones', 'Habilitado', 'Orden de Cambio de Devs Group', '2015-05-26', '14:14:28');
INSERT INTO `registro` VALUES ('114', 'LeticiaB', 'publicaciones', 'Habilitado', 'Orden de Cambio de InnovaTe', '2015-05-26', '14:14:35');
INSERT INTO `registro` VALUES ('115', 'LeticiaB', 'publicaciones', 'Habilitado', 'Orden de Cambio de MAD', '2015-05-26', '14:14:44');
INSERT INTO `registro` VALUES ('116', 'LeticiaB', 'publicaciones', 'Habilitado', 'Orden de Cambio de NetSky', '2015-05-26', '14:14:55');
INSERT INTO `registro` VALUES ('117', 'LeticiaB', 'publicaciones', 'Habilitado', 'Orden de Cambio de SAADS', '2015-05-26', '15:15:23');
INSERT INTO `registro` VALUES ('118', 'LeticiaB', 'publicaciones', 'Habilitado', 'Orden de Cambio de SLOW CODE', '2015-05-26', '15:15:26');
INSERT INTO `registro` VALUES ('119', 'Devs', 'actividad planificacion', 'en proceso', 'GestiÃƒÂ³n del pryecto', '2015-05-26', '09:43:40');
INSERT INTO `registro` VALUES ('120', 'MAD', 'actividad planificacion', 'en proceso', 'Firma de contrato', '2015-05-26', '10:06:09');
INSERT INTO `registro` VALUES ('121', 'LeticiaB', 'publicaciones', 'Habilitado', 'Notificacion de Conformidad de Devs Group', '2015-05-26', '16:16:11');
INSERT INTO `registro` VALUES ('122', 'LeticiaB', 'publicaciones', 'Habilitado', 'Notificacion de Conformidad de InnovaTe', '2015-05-26', '16:16:13');
INSERT INTO `registro` VALUES ('123', 'LeticiaB', 'publicaciones', 'Habilitado', 'Notificacion de Conformidad de MAD', '2015-05-26', '16:16:14');
INSERT INTO `registro` VALUES ('124', 'LeticiaB', 'publicaciones', 'Habilitado', 'Notificacion de Conformidad de NetSky', '2015-05-26', '16:16:15');
INSERT INTO `registro` VALUES ('125', 'LeticiaB', 'publicaciones', 'Habilitado', 'Notificacion de Conformidad de SAADS', '2015-05-26', '16:16:16');
INSERT INTO `registro` VALUES ('126', 'LeticiaB', 'publicaciones', 'Habilitado', 'Notificacion de Conformidad de SLOW CODE', '2015-05-26', '16:16:17');
INSERT INTO `registro` VALUES ('127', 'Devs', 'actividad planificacion', 'en proceso', 'PlanificaciÃƒÂ³n', '2015-05-26', '11:35:33');
INSERT INTO `registro` VALUES ('128', 'Devs', 'actividad planificacion', 'en proceso', 'Firma de contrato', '2015-05-26', '11:52:32');
INSERT INTO `registro` VALUES ('129', 'Devs', 'actividad planificacion', 'en proceso', 'Sprint 0', '2015-05-26', '11:52:32');
INSERT INTO `registro` VALUES ('130', 'Devs', 'actividad planificacion', 'en proceso', 'Sprint 1', '2015-05-26', '11:52:32');
INSERT INTO `registro` VALUES ('131', 'Devs', 'actividad planificacion', 'en proceso', 'Sprint 2', '2015-05-26', '11:52:32');
INSERT INTO `registro` VALUES ('132', 'Devs', 'actividad planificacion', 'en proceso', 'Sprint 3', '2015-05-26', '11:52:32');
INSERT INTO `registro` VALUES ('133', 'Devs', 'actividad planificacion', 'en proceso', 'Sprint 4', '2015-05-26', '11:52:32');
INSERT INTO `registro` VALUES ('134', 'Devs', 'actividad planificacion', 'en proceso', 'Sprint 5', '2015-05-26', '11:52:33');
INSERT INTO `registro` VALUES ('135', 'Devs', 'actividad planificacion', 'en proceso', 'Sprint 6', '2015-05-26', '11:52:33');
INSERT INTO `registro` VALUES ('136', 'InnovaTe', 'actividad planificacion', 'en proceso', 'Firma de contrato', '2015-05-26', '12:19:18');
INSERT INTO `registro` VALUES ('137', 'InnovaTe', 'actividad planificacion', 'en proceso', 'firma de contrato', '2015-05-26', '12:33:23');
INSERT INTO `registro` VALUES ('138', 'InnovaTe', 'actividad planificacion', 'en proceso', 'PlanificaciÃƒÂ³n', '2015-05-26', '12:51:32');
INSERT INTO `registro` VALUES ('139', 'InnovaTe', 'actividad planificacion', 'en proceso', 'PlanificaciÃƒÂ³n', '2015-05-26', '12:57:35');
INSERT INTO `registro` VALUES ('140', 'SAADS', 'actividad planificacion', 'en proceso', 'Sprint 0', '2015-05-26', '13:59:53');
INSERT INTO `registro` VALUES ('141', 'SAADS', 'actividad planificacion', 'en proceso', 'Sprint 1', '2015-05-26', '13:59:53');
INSERT INTO `registro` VALUES ('142', 'SAADS', 'actividad planificacion', 'en proceso', 'Sprint 2', '2015-05-26', '13:59:53');
INSERT INTO `registro` VALUES ('143', 'SAADS', 'actividad planificacion', 'en proceso', 'Sprint 3', '2015-05-26', '13:59:53');
INSERT INTO `registro` VALUES ('144', 'SAADS', 'actividad planificacion', 'en proceso', 'Sprint 4', '2015-05-26', '13:59:53');
INSERT INTO `registro` VALUES ('145', 'SAADS', 'actividad planificacion', 'en proceso', 'Sprint 5', '2015-05-26', '13:59:53');
INSERT INTO `registro` VALUES ('146', 'SAADS', 'actividad planificacion', 'en proceso', 'Sprint 6', '2015-05-26', '13:59:53');
INSERT INTO `registro` VALUES ('147', 'SLOW', 'actividad planificacion', 'en proceso', 'EvaluaciÃƒÂ³n', '2015-05-26', '14:15:35');
INSERT INTO `registro` VALUES ('148', 'SLOW', 'actividad planificacion', 'en proceso', 'Sprint 1', '2015-05-26', '14:15:36');
INSERT INTO `registro` VALUES ('149', 'SLOW', 'actividad planificacion', 'en proceso', 'Sprint 2', '2015-05-26', '14:15:36');
INSERT INTO `registro` VALUES ('150', 'SLOW', 'actividad planificacion', 'en proceso', 'Sprint 3', '2015-05-26', '14:15:36');
INSERT INTO `registro` VALUES ('151', 'SLOW', 'actividad planificacion', 'en proceso', 'Sprint 4', '2015-05-26', '14:15:36');
INSERT INTO `registro` VALUES ('152', 'SLOW', 'actividad planificacion', 'en proceso', 'Entrega ', '2015-05-26', '14:15:36');
INSERT INTO `registro` VALUES ('153', 'SLOW', 'actividad planificacion', 'en proceso', 'capacitaciÃƒÂ³n', '2015-05-26', '14:15:36');
INSERT INTO `registro` VALUES ('154', 'SLOW', 'actividad planificacion', 'en proceso', 'ConclusiÃƒÂ³n ', '2015-05-26', '14:15:36');
INSERT INTO `registro` VALUES ('155', 'NetSky', 'actividad planificacion', 'en proceso', 'Sprint 1', '2015-05-26', '14:26:12');
INSERT INTO `registro` VALUES ('156', 'NetSky', 'actividad planificacion', 'en proceso', 'Sprint 2', '2015-05-26', '14:26:12');
INSERT INTO `registro` VALUES ('157', 'NetSky', 'actividad planificacion', 'en proceso', 'Sprint 3', '2015-05-26', '14:26:13');
INSERT INTO `registro` VALUES ('158', 'NetSky', 'actividad planificacion', 'en proceso', 'CapacitaciÃƒÂ³n', '2015-05-26', '14:26:13');
INSERT INTO `registro` VALUES ('159', 'MAD', 'actividad planificacion', 'en proceso', 'Sprint 1', '2015-05-26', '14:46:38');
INSERT INTO `registro` VALUES ('160', 'MAD', 'actividad planificacion', 'en proceso', 'Sprint 2', '2015-05-26', '14:46:38');
INSERT INTO `registro` VALUES ('161', 'MAD', 'actividad planificacion', 'en proceso', 'Sprint 3', '2015-05-26', '14:46:38');
INSERT INTO `registro` VALUES ('162', 'MAD', 'actividad planificacion', 'en proceso', 'Sprint 4', '2015-05-26', '14:46:38');
INSERT INTO `registro` VALUES ('163', 'MAD', 'actividad planificacion', 'en proceso', 'Sprint 5', '2015-05-26', '14:46:38');
INSERT INTO `registro` VALUES ('164', 'MAD', 'actividad planificacion', 'en proceso', 'Sprint 6', '2015-05-26', '14:46:38');
INSERT INTO `registro` VALUES ('165', 'NetSky', 'pago planificacion', 'en proceso', 'Sprint 1', '2015-05-26', '20:42:29');
INSERT INTO `registro` VALUES ('166', 'NetSky', 'pago planificacion', 'en proceso', 'Sprint 2', '2015-05-26', '20:42:29');
INSERT INTO `registro` VALUES ('167', 'NetSky', 'pago planificacion', 'en proceso', 'Sprint 3', '2015-05-26', '20:42:30');
INSERT INTO `registro` VALUES ('168', 'NetSky', 'pago planificacion', 'en proceso', 'CapacitaciÃƒÂ³n', '2015-05-26', '20:42:30');
INSERT INTO `registro` VALUES ('169', 'LeticiaB', 'Contrato', 'Habilitado', 'ContratoNetSky.pdf', '2015-05-27', '02:02:45');
INSERT INTO `registro` VALUES ('170', 'Devs', 'pago planificacion', 'en proceso', 'Firma de contrato', '2015-05-26', '20:56:55');
INSERT INTO `registro` VALUES ('171', 'Devs', 'pago planificacion', 'en proceso', 'Sprint 0', '2015-05-26', '20:56:55');
INSERT INTO `registro` VALUES ('172', 'Devs', 'pago planificacion', 'en proceso', 'Sprint 1', '2015-05-26', '20:56:56');
INSERT INTO `registro` VALUES ('173', 'Devs', 'pago planificacion', 'en proceso', 'Sprint 2', '2015-05-26', '20:56:56');
INSERT INTO `registro` VALUES ('174', 'Devs', 'pago planificacion', 'en proceso', 'Sprint 3', '2015-05-26', '20:56:56');
INSERT INTO `registro` VALUES ('175', 'Devs', 'pago planificacion', 'en proceso', 'Sprint 4', '2015-05-26', '20:56:56');
INSERT INTO `registro` VALUES ('176', 'Devs', 'pago planificacion', 'en proceso', 'Sprint 5', '2015-05-26', '20:56:56');
INSERT INTO `registro` VALUES ('177', 'Devs', 'pago planificacion', 'en proceso', 'Sprint 6', '2015-05-26', '20:56:57');
INSERT INTO `registro` VALUES ('178', 'MAD', 'pago planificacion', 'en proceso', 'Firma de contrato', '2015-05-26', '21:10:18');
INSERT INTO `registro` VALUES ('179', 'MAD', 'pago planificacion', 'en proceso', 'Sprint 1', '2015-05-26', '21:10:18');
INSERT INTO `registro` VALUES ('180', 'MAD', 'pago planificacion', 'en proceso', 'Sprint 2', '2015-05-26', '21:10:18');
INSERT INTO `registro` VALUES ('181', 'MAD', 'pago planificacion', 'en proceso', 'Sprint 3', '2015-05-26', '21:10:19');
INSERT INTO `registro` VALUES ('182', 'MAD', 'pago planificacion', 'en proceso', 'Sprint 4', '2015-05-26', '21:10:19');
INSERT INTO `registro` VALUES ('183', 'MAD', 'pago planificacion', 'en proceso', 'Sprint 5', '2015-05-26', '21:10:19');
INSERT INTO `registro` VALUES ('184', 'MAD', 'pago planificacion', 'en proceso', 'Sprint 6', '2015-05-26', '21:10:19');
INSERT INTO `registro` VALUES ('185', 'SLOW', 'pago planificacion', 'en proceso', 'EvaluaciÃƒÂ³n', '2015-05-26', '21:21:09');
INSERT INTO `registro` VALUES ('186', 'SLOW', 'pago planificacion', 'en proceso', 'Sprint 1', '2015-05-26', '21:21:09');
INSERT INTO `registro` VALUES ('187', 'SLOW', 'pago planificacion', 'en proceso', 'Sprint 2', '2015-05-26', '21:21:09');
INSERT INTO `registro` VALUES ('188', 'SLOW', 'pago planificacion', 'en proceso', 'Sprint 3', '2015-05-26', '21:21:09');
INSERT INTO `registro` VALUES ('189', 'SLOW', 'pago planificacion', 'en proceso', 'Sprint 4', '2015-05-26', '21:21:10');
INSERT INTO `registro` VALUES ('190', 'SLOW', 'pago planificacion', 'en proceso', 'Entrega ', '2015-05-26', '21:21:10');
INSERT INTO `registro` VALUES ('191', 'SLOW', 'pago planificacion', 'en proceso', 'capacitaciÃƒÂ³n', '2015-05-26', '21:21:10');
INSERT INTO `registro` VALUES ('192', 'SLOW', 'pago planificacion', 'en proceso', 'ConclusiÃƒÂ³n ', '2015-05-26', '21:21:10');
INSERT INTO `registro` VALUES ('193', 'SAADS', 'pago planificacion', 'en proceso', 'Sprint 0', '2015-05-26', '21:39:10');
INSERT INTO `registro` VALUES ('194', 'SAADS', 'pago planificacion', 'en proceso', 'Sprint 1', '2015-05-26', '21:39:10');
INSERT INTO `registro` VALUES ('195', 'SAADS', 'pago planificacion', 'en proceso', 'Sprint 2', '2015-05-26', '21:39:10');
INSERT INTO `registro` VALUES ('196', 'SAADS', 'pago planificacion', 'en proceso', 'Sprint 3', '2015-05-26', '21:39:10');
INSERT INTO `registro` VALUES ('197', 'SAADS', 'pago planificacion', 'en proceso', 'Sprint 4', '2015-05-26', '21:39:11');
INSERT INTO `registro` VALUES ('198', 'SAADS', 'pago planificacion', 'en proceso', 'Sprint 5', '2015-05-26', '21:39:11');
INSERT INTO `registro` VALUES ('199', 'SAADS', 'pago planificacion', 'en proceso', 'Sprint 6', '2015-05-26', '21:39:11');
INSERT INTO `registro` VALUES ('200', 'LeticiaB', 'Contrato', 'Habilitado', 'ContratoSAADS.pdf', '2015-05-27', '04:04:00');
INSERT INTO `registro` VALUES ('201', 'LeticiaB', 'Contrato', 'Habilitado', 'ContratoSLOWCODE.pdf', '2015-05-27', '04:04:00');
INSERT INTO `registro` VALUES ('202', 'LeticiaB', 'Contrato', 'Habilitado', 'ContratoDevsGroup.pdf', '2015-05-27', '04:04:00');
INSERT INTO `registro` VALUES ('203', 'LeticiaB', 'Contrato', 'Habilitado', 'ContratoMAD.pdf', '2015-05-27', '04:04:01');
INSERT INTO `registro` VALUES ('204', 'LeticiaB', 'Contrato', 'Habilitado', 'ContratoInnovaTe.pdf', '2015-05-27', '04:04:27');
INSERT INTO `registro` VALUES ('205', 'LeticiaB', 'publicaciones', 'Habilitado', 'Orden de Cambio de', '2015-06-23', '16:28:49');
INSERT INTO `registro` VALUES ('206', 'LeticiaB', 'publicaciones', 'Habilitado', 'Orden de Cambio de', '2015-06-23', '16:38:28');
INSERT INTO `registro` VALUES ('207', 'LeticiaB', 'publicaciones', 'Habilitado', 'Orden de Cambio de', '2015-06-24', '15:50:01');
INSERT INTO `registro` VALUES ('208', 'LeticiaB', 'publicaciones', 'Habilitado', 'Orden de Cambio de', '2015-06-24', '16:44:43');

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
) ENGINE=InnoDB AUTO_INCREMENT=231 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sesion
-- ----------------------------
INSERT INTO `sesion` VALUES ('124', 'LeticiaB', '2015-05-25', '10:02:21', '::1');
INSERT INTO `sesion` VALUES ('125', 'InnovaTe', '2015-05-25', '11:13:38', '::1');
INSERT INTO `sesion` VALUES ('126', 'LeticiaB', '2015-05-25', '11:21:58', '::1');
INSERT INTO `sesion` VALUES ('127', 'InnovaTe', '2015-05-25', '11:24:18', '::1');
INSERT INTO `sesion` VALUES ('128', 'LeticiaB', '2015-05-25', '11:30:26', '::1');
INSERT INTO `sesion` VALUES ('129', 'SAADS', '2015-05-25', '11:45:05', '::1');
INSERT INTO `sesion` VALUES ('130', 'SLOW', '2015-05-25', '11:48:12', '::1');
INSERT INTO `sesion` VALUES ('131', 'LeticiaB', '2015-05-25', '11:53:13', '::1');
INSERT INTO `sesion` VALUES ('132', 'InnovaTe', '2015-05-26', '12:00:03', '::1');
INSERT INTO `sesion` VALUES ('133', 'LeticiaB', '2015-05-26', '12:00:54', '::1');
INSERT INTO `sesion` VALUES ('134', 'InnovaTe', '2015-05-26', '12:07:15', '::1');
INSERT INTO `sesion` VALUES ('135', 'LeticiaB', '2015-05-26', '12:08:26', '::1');
INSERT INTO `sesion` VALUES ('136', 'InnovaTe', '2015-05-26', '12:10:45', '::1');
INSERT INTO `sesion` VALUES ('137', 'LeticiaB', '2015-05-26', '12:11:44', '::1');
INSERT INTO `sesion` VALUES ('138', 'InnovaTe', '2015-05-26', '12:17:06', '::1');
INSERT INTO `sesion` VALUES ('139', 'LeticiaB', '2015-05-26', '12:22:42', '::1');
INSERT INTO `sesion` VALUES ('140', 'InnovaTe', '2015-05-26', '12:32:01', '::1');
INSERT INTO `sesion` VALUES ('141', 'SAADS', '2015-05-26', '12:34:56', '::1');
INSERT INTO `sesion` VALUES ('142', 'LeticiaB', '2015-05-26', '12:36:02', '::1');
INSERT INTO `sesion` VALUES ('143', 'SAADS', '2015-05-26', '12:38:31', '::1');
INSERT INTO `sesion` VALUES ('144', 'Admin1', '2015-05-26', '12:53:14', '::1');
INSERT INTO `sesion` VALUES ('145', 'LeticiaB', '2015-05-26', '12:58:07', '::1');
INSERT INTO `sesion` VALUES ('146', 'LeticiaB', '2015-05-26', '01:05:18', '::1');
INSERT INTO `sesion` VALUES ('147', 'LeticiaB', '2015-05-26', '01:14:35', '::1');
INSERT INTO `sesion` VALUES ('148', 'Camaleon', '2015-05-26', '01:15:20', '::1');
INSERT INTO `sesion` VALUES ('149', 'LeticiaB', '2015-05-26', '01:18:20', '::1');
INSERT INTO `sesion` VALUES ('150', 'LeticiaB', '2015-05-26', '01:30:51', '::1');
INSERT INTO `sesion` VALUES ('151', 'LeticiaB', '2015-05-26', '01:32:17', '::1');
INSERT INTO `sesion` VALUES ('152', 'InnovaTe', '2015-05-26', '01:36:34', '::1');
INSERT INTO `sesion` VALUES ('153', 'Admin1', '2015-05-26', '01:38:17', '::1');
INSERT INTO `sesion` VALUES ('154', 'LeticiaB', '2015-05-26', '01:40:50', '::1');
INSERT INTO `sesion` VALUES ('155', 'SLOW', '2015-05-26', '01:41:58', '::1');
INSERT INTO `sesion` VALUES ('156', 'LeticiaB', '2015-05-26', '01:44:27', '::1');
INSERT INTO `sesion` VALUES ('157', 'SLOW', '2015-05-26', '01:51:24', '::1');
INSERT INTO `sesion` VALUES ('158', 'LeticiaB', '2015-05-26', '01:52:14', '::1');
INSERT INTO `sesion` VALUES ('159', 'SLOW', '2015-05-26', '01:55:56', '::1');
INSERT INTO `sesion` VALUES ('160', 'InnovaTe', '2015-05-26', '01:59:41', '::1');
INSERT INTO `sesion` VALUES ('161', 'SAADS', '2015-05-26', '02:00:45', '::1');
INSERT INTO `sesion` VALUES ('162', 'NetSky', '2015-05-26', '02:08:35', '::1');
INSERT INTO `sesion` VALUES ('163', 'LeticiaB', '2015-05-26', '02:09:27', '::1');
INSERT INTO `sesion` VALUES ('164', 'NetSky', '2015-05-26', '02:10:38', '::1');
INSERT INTO `sesion` VALUES ('165', 'MAD', '2015-05-26', '02:11:33', '::1');
INSERT INTO `sesion` VALUES ('166', 'InnovaTe', '2015-05-26', '02:12:19', '::1');
INSERT INTO `sesion` VALUES ('167', 'LeticiaB', '2015-05-26', '02:12:40', '::1');
INSERT INTO `sesion` VALUES ('168', 'NetSky', '2015-05-26', '02:15:13', '::1');
INSERT INTO `sesion` VALUES ('169', 'MAD', '2015-05-26', '02:17:03', '::1');
INSERT INTO `sesion` VALUES ('170', 'Devs', '2015-05-26', '02:19:50', '::1');
INSERT INTO `sesion` VALUES ('171', 'LeticiaB', '2015-05-26', '02:22:40', '::1');
INSERT INTO `sesion` VALUES ('172', 'Devs', '2015-05-26', '02:50:22', '::1');
INSERT INTO `sesion` VALUES ('173', 'LeticiaB', '2015-05-26', '02:51:34', '::1');
INSERT INTO `sesion` VALUES ('174', 'Devs', '2015-05-26', '03:27:30', '::1');
INSERT INTO `sesion` VALUES ('175', 'LeticiaB', '2015-05-26', '03:30:29', '::1');
INSERT INTO `sesion` VALUES ('176', 'Devs', '2015-05-26', '03:32:56', '::1');
INSERT INTO `sesion` VALUES ('177', 'Devs', '2015-05-26', '03:44:16', '::1');
INSERT INTO `sesion` VALUES ('178', 'InnovaTe', '2015-05-26', '03:53:13', '::1');
INSERT INTO `sesion` VALUES ('179', 'LeticiaB', '2015-05-26', '03:56:10', '::1');
INSERT INTO `sesion` VALUES ('180', 'InnovaTe', '2015-05-26', '03:57:14', '::1');
INSERT INTO `sesion` VALUES ('181', 'MAD', '2015-05-26', '03:58:15', '::1');
INSERT INTO `sesion` VALUES ('182', 'LeticiaB', '2015-05-26', '04:08:25', '::1');
INSERT INTO `sesion` VALUES ('183', 'Devs', '2015-05-26', '04:18:51', '::1');
INSERT INTO `sesion` VALUES ('184', 'LeticiaB', '2015-05-26', '04:48:17', '::1');
INSERT INTO `sesion` VALUES ('185', 'Devs', '2015-05-26', '04:48:52', '::1');
INSERT INTO `sesion` VALUES ('186', 'MAD', '2015-05-26', '05:30:02', '::1');
INSERT INTO `sesion` VALUES ('187', 'Devs', '2015-05-26', '05:31:16', '::1');
INSERT INTO `sesion` VALUES ('188', 'Devs', '2015-05-26', '05:37:21', '::1');
INSERT INTO `sesion` VALUES ('189', 'LeticiaB', '2015-05-26', '05:59:27', '::1');
INSERT INTO `sesion` VALUES ('190', 'Devs', '2015-05-26', '06:00:59', '::1');
INSERT INTO `sesion` VALUES ('191', 'InnovaTe', '2015-05-26', '06:03:30', '::1');
INSERT INTO `sesion` VALUES ('192', 'LeticiaB', '2015-05-26', '06:12:40', '::1');
INSERT INTO `sesion` VALUES ('193', 'InnovaTe', '2015-05-26', '06:13:49', '::1');
INSERT INTO `sesion` VALUES ('194', 'LeticiaB', '2015-05-26', '06:15:35', '::1');
INSERT INTO `sesion` VALUES ('195', 'InnovaTe', '2015-05-26', '06:16:40', '::1');
INSERT INTO `sesion` VALUES ('196', 'LeticiaB', '2015-05-26', '06:27:30', '::1');
INSERT INTO `sesion` VALUES ('197', 'InnovaTe', '2015-05-26', '06:28:38', '::1');
INSERT INTO `sesion` VALUES ('198', 'InnovaTe', '2015-05-26', '06:56:31', '::1');
INSERT INTO `sesion` VALUES ('199', 'Devs', '2015-05-26', '07:23:29', '::1');
INSERT INTO `sesion` VALUES ('200', 'LeticiaB', '2015-05-26', '07:37:18', '::1');
INSERT INTO `sesion` VALUES ('201', 'InnovaTe', '2015-05-26', '07:46:13', '::1');
INSERT INTO `sesion` VALUES ('202', 'SAADS', '2015-05-26', '07:46:52', '::1');
INSERT INTO `sesion` VALUES ('203', 'LeticiaB', '2015-05-26', '08:02:42', '::1');
INSERT INTO `sesion` VALUES ('204', 'SLOW', '2015-05-26', '08:03:32', '::1');
INSERT INTO `sesion` VALUES ('205', 'LeticiaB', '2015-05-26', '08:15:56', '::1');
INSERT INTO `sesion` VALUES ('206', 'NetSky', '2015-05-26', '08:16:51', '::1');
INSERT INTO `sesion` VALUES ('207', 'LeticiaB', '2015-05-26', '08:26:34', '::1');
INSERT INTO `sesion` VALUES ('208', 'MAD', '2015-05-26', '08:29:16', '::1');
INSERT INTO `sesion` VALUES ('209', 'LeticiaB', '2015-05-27', '01:41:11', '::1');
INSERT INTO `sesion` VALUES ('210', 'SAADS', '2015-05-27', '01:43:08', '::1');
INSERT INTO `sesion` VALUES ('211', 'LeticiaB', '2015-05-27', '02:10:12', '::1');
INSERT INTO `sesion` VALUES ('212', 'InnovaTe', '2015-05-27', '02:11:11', '::1');
INSERT INTO `sesion` VALUES ('213', 'Devs', '2015-05-27', '02:19:36', '::1');
INSERT INTO `sesion` VALUES ('214', 'NetSky', '2015-05-27', '02:34:10', '::1');
INSERT INTO `sesion` VALUES ('215', 'LeticiaB', '2015-05-27', '02:45:41', '::1');
INSERT INTO `sesion` VALUES ('216', 'NetSky', '2015-05-27', '02:49:19', '::1');
INSERT INTO `sesion` VALUES ('217', 'Devs', '2015-05-27', '02:50:06', '::1');
INSERT INTO `sesion` VALUES ('218', 'MAD', '2015-05-27', '03:00:50', '::1');
INSERT INTO `sesion` VALUES ('219', 'SLOW', '2015-05-27', '03:11:54', '::1');
INSERT INTO `sesion` VALUES ('220', 'SAADS', '2015-05-27', '03:25:12', '::1');
INSERT INTO `sesion` VALUES ('221', 'LeticiaB', '2015-05-27', '03:39:40', '::1');
INSERT INTO `sesion` VALUES ('222', 'LeticiaB', '2015-05-27', '03:59:50', '::1');
INSERT INTO `sesion` VALUES ('223', 'InnovaTe', '2015-05-27', '04:13:03', '::1');
INSERT INTO `sesion` VALUES ('224', 'LeticiaB', '2015-05-27', '04:26:32', '::1');
INSERT INTO `sesion` VALUES ('225', 'LeticiaB', '2015-05-27', '02:51:19', '::1');
INSERT INTO `sesion` VALUES ('226', 'FreeValue', '2015-06-23', '10:51:48', '::1');
INSERT INTO `sesion` VALUES ('227', 'LeticiaB', '2015-06-23', '14:20:46', '::1');
INSERT INTO `sesion` VALUES ('228', 'LeticiaB', '2015-06-23', '16:35:44', '::1');
INSERT INTO `sesion` VALUES ('229', 'LeticiaB', '2015-06-24', '07:42:26', '::1');
INSERT INTO `sesion` VALUES ('230', 'LeticiaB', '2015-06-24', '15:14:28', '::1');

-- ----------------------------
-- Table structure for `socio`
-- ----------------------------
DROP TABLE IF EXISTS `socio`;
CREATE TABLE `socio` (
  `CODIGO_S` int(11) NOT NULL AUTO_INCREMENT,
  `NOMBRE_U` varchar(50) NOT NULL,
  `NOMBRES_S` varchar(50) NOT NULL,
  `APELLIDOS_S` varchar(50) NOT NULL,
  `CORREO` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`CODIGO_S`) USING BTREE,
  UNIQUE KEY `uniq_correo` (`CORREO`),
  KEY `FK_GRUPO_EMPRESA__SOCIO` (`NOMBRE_U`) USING BTREE,
  CONSTRAINT `FK_GRUPO_EMPRESA__SOCIO` FOREIGN KEY (`NOMBRE_U`) REFERENCES `grupo_empresa` (`NOMBRE_U`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=819;

-- ----------------------------
-- Records of socio
-- ----------------------------
INSERT INTO `socio` VALUES ('40', 'Devs', 'Vania Marisela ', 'Catorceno Carballo', null);
INSERT INTO `socio` VALUES ('41', 'Devs', 'Dan Joel', 'Canqui Aviles', null);
INSERT INTO `socio` VALUES ('42', 'Devs', 'Daniel', 'Rocha Perez', null);
INSERT INTO `socio` VALUES ('43', 'Devs', 'Denis', 'Vazques Flores', null);
INSERT INTO `socio` VALUES ('44', 'Devs', 'Diego Armando', 'Zambrana Arze', null);
INSERT INTO `socio` VALUES ('45', 'InnovaTe', 'Antonio', 'Alurralde', null);
INSERT INTO `socio` VALUES ('46', 'InnovaTe', 'Andreina', 'Cota', null);
INSERT INTO `socio` VALUES ('47', 'InnovaTe', 'Fernando', 'Gutierrez', null);
INSERT INTO `socio` VALUES ('48', 'InnovaTe', 'Marcelo', 'Torrico', null);
INSERT INTO `socio` VALUES ('49', 'InnovaTe', 'Winder', 'Chiri', null);
INSERT INTO `socio` VALUES ('50', 'MAD', 'Juan Manuel', 'Castro Arnez', null);
INSERT INTO `socio` VALUES ('51', 'MAD', 'Alison', 'Fernandez Blanco', null);
INSERT INTO `socio` VALUES ('52', 'MAD', 'Diego Gabriel', 'NuÃ±ez Duran', null);
INSERT INTO `socio` VALUES ('53', 'NetSky', 'Norman', 'Antezana Pinto', null);
INSERT INTO `socio` VALUES ('54', 'NetSky', 'Dario Edson', 'Chacon Paichucama', null);
INSERT INTO `socio` VALUES ('55', 'NetSky', 'Erlinda', 'Chambi Manzano', null);
INSERT INTO `socio` VALUES ('56', 'NetSky', 'Claudia Dolinda', 'Torrico', null);
INSERT INTO `socio` VALUES ('57', 'NetSky', 'Ruben ', 'Villca Fernandez', null);
INSERT INTO `socio` VALUES ('58', 'SAADS', 'Enrique Daniel ', 'Antezana Vargas', null);
INSERT INTO `socio` VALUES ('59', 'SAADS', 'Beimar E. ', 'Huarachi Mamani', null);
INSERT INTO `socio` VALUES ('60', 'SAADS', 'Jorge ', 'Avila Baldiviezo', null);
INSERT INTO `socio` VALUES ('61', 'SAADS', 'Kenji Gabriel ', 'Lozano Rosales', null);
INSERT INTO `socio` VALUES ('62', 'SLOW', 'Melisa Stefani', 'Carballo Valencia', null);
INSERT INTO `socio` VALUES ('63', 'SLOW', 'Cristhian', 'Lima Sarabia', null);
INSERT INTO `socio` VALUES ('64', 'SLOW', 'Santiago', 'Quiroga Turdera', null);
INSERT INTO `socio` VALUES ('65', 'SLOW', 'Rodrigo David', 'Rivera Ortega', null);
INSERT INTO `socio` VALUES ('66', 'FreeValue', 'Fernando', 'Gutierrez', null);
INSERT INTO `socio` VALUES ('67', 'FreeValue', 'Evelin', 'Garcia', 'eve@gmail.com');
INSERT INTO `socio` VALUES ('72', 'FreeValue', 'FF', 'F', null);

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
  UNIQUE KEY `uniq_correo` (`CORREO_ELECTRONICO_U`),
  KEY `FK_ESTADO__USUARIO` (`ESTADO_E`) USING BTREE,
  CONSTRAINT `FK_ESTADO__USUARIO` FOREIGN KEY (`ESTADO_E`) REFERENCES `estado` (`ESTADO_E`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=2048;

-- ----------------------------
-- Records of usuario
-- ----------------------------
INSERT INTO `usuario` VALUES ('Admin1', 'Habilitado', 'dbb050cddf3a78fd6b861eb577d1f5dc', '4442336', 'adm.saetis@gmail.com');
INSERT INTO `usuario` VALUES ('Admin2', 'Habilitado', '62132d33742969b9b1db54e2d4145009', '4329092', 'joaquin@rodriguez.com');
INSERT INTO `usuario` VALUES ('ADSysCorp', 'Habilitado', 'dc5d00cea0d628067d7d5399102233eb', '71494555', 'adsyscorp@gmail.com');
INSERT INTO `usuario` VALUES ('AgileA', 'Habilitado', 'f4326bafda468fdca9511f4468cea9c9', '4443200', 'agile@action.com');
INSERT INTO `usuario` VALUES ('AiraSoft', 'Habilitado', 'fc03609dccb03ed065360c7672f13942', '65353545', 'airasoft@outlook.com');
INSERT INTO `usuario` VALUES ('Akira', 'Habilitado', 'e5f9cfc5526a5933366a943ae344110c', '4564646', 'akira@gmail.com');
INSERT INTO `usuario` VALUES ('Altec', 'Habilitado', '3509fe2708b1d6c4f92e32187d2c19d0', '73722777', 'altec@hotmail.com');
INSERT INTO `usuario` VALUES ('ANDE', 'Habilitado', '73f6d4c77463ff99f74523490bf5d18f', '4454574', 'andesoft@outlook.com');
INSERT INTO `usuario` VALUES ('Angel', 'Habilitado', 'f8878656e7d4b4c750fc4c94cee9a158', '76765754', 'angel.fire@outlook.com');
INSERT INTO `usuario` VALUES ('ANKA', 'Habilitado', 'f6bc2d991dc97bc61729d639e7302efc', '76868763', 'ankasoft@hotmail.com');
INSERT INTO `usuario` VALUES ('Answer', 'Habilitado', '5016a78bc8eec05c82f049deb8f48ccb', '4666734', 'answer@hotmail.com');
INSERT INTO `usuario` VALUES ('Aracorp', 'Habilitado', '92eeb9010bcc6fa962d0dd6ea55729ed', '64343437', 'aracorp@hotmail.com');
INSERT INTO `usuario` VALUES ('ARGOS', 'Habilitado', 'da06de41f4e5c7c64394439f7d103ad1', '4343545', 'argos.srl@gmail.com');
INSERT INTO `usuario` VALUES ('Arkano', 'Habilitado', 'd87b0418cd506677986e7a3ae41b2c54', '4233322', 'arkano@arkanos.com');
INSERT INTO `usuario` VALUES ('Aska', 'Habilitado', '3bb23cff49551b3eca19e9240f725080', '4443443', 'aska@gmail.com');
INSERT INTO `usuario` VALUES ('ASSI', 'Habilitado', '4d999b1200f60196f2c921a9f49563a1', '74242324', 'asii@outlook.com');
INSERT INTO `usuario` VALUES ('Camaleon', 'Habilitado', '88936961971d538e693935a6ffb40a20', '4442299', 'camaleon@soft.com');
INSERT INTO `usuario` VALUES ('Colective', 'Habilitado', 'b9becbb405f0fd5524071709a02b5330', '4432211', 'colectivo@virtual.com');
INSERT INTO `usuario` VALUES ('Corina', 'Deshabilitado', '83175e301fe440e2fa85463a987037ba', '4241122', 'corina@hotmail.com');
INSERT INTO `usuario` VALUES ('David', 'Deshabilitado', '0076fa0d70724c52f22a82f7ed3f5e23', '4443321', 'davides@gmail.com');
INSERT INTO `usuario` VALUES ('Devs', 'Habilitado', '1c9c37e7922d4b506d53bb1fcc7ed107', '67451583', 'devsgroup@outlookl.com');
INSERT INTO `usuario` VALUES ('FreeValue', 'Habilitado', 'f87f9d72ff9dfb09182cffa68762c2c8', '4329092', 'free@value.com');
INSERT INTO `usuario` VALUES ('InnovaTe', 'Habilitado', 'b505ee29745ce8d9fc12fa8af65df9b0', '70751815', 'contacto@innovate.dev.bo');
INSERT INTO `usuario` VALUES ('LeticiaB', 'Habilitado', '1fec3b9b292b7c95d5287012c1ea3052', '4440099', 'leticia@gmail.com');
INSERT INTO `usuario` VALUES ('MAD', 'Habilitado', 'ade8b436f8f320a38a157e56c048a114', '69438193', 'mad.software.srl@gmail.com');
INSERT INTO `usuario` VALUES ('MarcoA', 'Deshabilitado', '0c7895d527f7680d6a715fc6a47a720e', '4440099', 'marcoantonio@hotmail.com');
INSERT INTO `usuario` VALUES ('NetSky', 'Habilitado', '6cc63f8b72596e177a372949437dee50', '79735925', 'netskysystemsrl@outlook.com');
INSERT INTO `usuario` VALUES ('Oasis', 'Habilitado', 'c810a44fc32898ae6ab495d89510d75f', '4331222', 'oasis@oasis.com');
INSERT INTO `usuario` VALUES ('Patricia', 'Habilitado', '1f08de3d6b9e572ba8f5da4c1dd2c30d', '4298765', 'patricia@hotmail.com');
INSERT INTO `usuario` VALUES ('Power', 'Habilitado', '7a4f8e9647073ee9a5564f81cf3a1082', '4329090', 'power@power.com');
INSERT INTO `usuario` VALUES ('SAADS', 'Habilitado', 'f13b522e0c82cd0fa7c24c67436b8e69', '79967675', 'saadssoft@gmail.com');
INSERT INTO `usuario` VALUES ('SLOW', 'Habilitado', 'a73da1d7391398b7d7bf5e13d885fbda', '4251675', 'slow.code.srl@gmail.com');

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
INSERT INTO `usuario_rol` VALUES ('ADSysCorp', 'grupoEmpresa');
INSERT INTO `usuario_rol` VALUES ('AgileA', 'grupoEmpresa');
INSERT INTO `usuario_rol` VALUES ('AiraSoft', 'grupoEmpresa');
INSERT INTO `usuario_rol` VALUES ('Akira', 'grupoEmpresa');
INSERT INTO `usuario_rol` VALUES ('Altec', 'grupoEmpresa');
INSERT INTO `usuario_rol` VALUES ('ANDE', 'grupoEmpresa');
INSERT INTO `usuario_rol` VALUES ('Angel', 'grupoEmpresa');
INSERT INTO `usuario_rol` VALUES ('ANKA', 'grupoEmpresa');
INSERT INTO `usuario_rol` VALUES ('Answer', 'grupoEmpresa');
INSERT INTO `usuario_rol` VALUES ('Aracorp', 'grupoEmpresa');
INSERT INTO `usuario_rol` VALUES ('ARGOS', 'grupoEmpresa');
INSERT INTO `usuario_rol` VALUES ('Arkano', 'grupoEmpresa');
INSERT INTO `usuario_rol` VALUES ('Aska', 'grupoEmpresa');
INSERT INTO `usuario_rol` VALUES ('ASSI', 'grupoEmpresa');
INSERT INTO `usuario_rol` VALUES ('Camaleon', 'grupoEmpresa');
INSERT INTO `usuario_rol` VALUES ('Colective', 'grupoEmpresa');
INSERT INTO `usuario_rol` VALUES ('Devs', 'grupoEmpresa');
INSERT INTO `usuario_rol` VALUES ('FreeValue', 'grupoEmpresa');
INSERT INTO `usuario_rol` VALUES ('InnovaTe', 'grupoEmpresa');
INSERT INTO `usuario_rol` VALUES ('MAD', 'grupoEmpresa');
INSERT INTO `usuario_rol` VALUES ('NetSky', 'grupoEmpresa');
INSERT INTO `usuario_rol` VALUES ('Oasis', 'grupoEmpresa');
INSERT INTO `usuario_rol` VALUES ('Power', 'grupoEmpresa');
INSERT INTO `usuario_rol` VALUES ('SAADS', 'grupoEmpresa');
INSERT INTO `usuario_rol` VALUES ('SLOW', 'grupoEmpresa');

-- ----------------------------
-- Procedure structure for `insert_NotificacionDeConf`
-- ----------------------------
DROP PROCEDURE IF EXISTS `insert_NotificacionDeConf`;
DELIMITER ;;
CREATE PROCEDURE `insert_NotificacionDeConf`(in grupoE varchar(50),ruta varchar(50))
BEGIN  

  DECLARE idd int;
  DECLARE fecha varchar(25);
  DECLARE hora varchar(25);

  
  SET fecha = (SELECT CURDATE());
  SET hora =  (SELECT CURTIME()); 
  
INSERT INTO registro (NOMBRE_U,TIPO_T,ESTADO_E,NOMBRE_R,FECHA_R,HORA_R) VALUES ('LeticiaB','publicaciones','Habilitado','Notificacion de conformidad',fecha,hora);

  SET idd = (SELECT MAX(ID_R) AS id FROM registro);
START TRANSACTION;
  INSERT INTO documento (ID_R,TAMANIO_D,RUTA_D,VISUALIZABLE_D,DESCARGABLE_D) VALUES(idd,'1024',ruta,TRUE,TRUE);
  INSERT INTO descripcion (ID_R,DESCRIPCION_D) VALUES(idd,'Notificacion de Conformidad');
  INSERT INTO receptor (ID_R,RECEPTOR_R) VALUES(idd,grupoE);
  INSERT INTO periodo (ID_R,fecha_p,hora_p) VALUES (idd,fecha,hora);
COMMIT;  
END;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `insert_OrdenDeCambio`
-- ----------------------------
DROP PROCEDURE IF EXISTS `insert_OrdenDeCambio`;
DELIMITER ;;
CREATE PROCEDURE `insert_OrdenDeCambio`(in grupoE varchar(50),ruta varchar(50))
BEGIN  

  DECLARE idd int;
  DECLARE fecha varchar(25);
  DECLARE hora varchar(25);

  
  SET fecha = (SELECT CURDATE());
  SET hora =  (SELECT CURTIME()); 
  
INSERT INTO registro (NOMBRE_U,TIPO_T,ESTADO_E,NOMBRE_R,FECHA_R,HORA_R) VALUES ('LeticiaB','publicaciones','Habilitado','Orden de Cambio',fecha,hora);

  SET idd = (SELECT MAX(ID_R) AS id FROM registro);
START TRANSACTION;
  INSERT INTO documento (ID_R,TAMANIO_D,RUTA_D,VISUALIZABLE_D,DESCARGABLE_D) VALUES(idd,'1024',ruta,TRUE,TRUE);
  INSERT INTO descripcion (ID_R,DESCRIPCION_D) VALUES(idd,'Orden de Cambio');
  INSERT INTO receptor (ID_R,RECEPTOR_R) VALUES(idd,grupoE);
  INSERT INTO periodo (ID_R,fecha_p,hora_p) VALUES (idd,fecha,hora);
COMMIT;  
END;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `insert_socio`
-- ----------------------------
DROP PROCEDURE IF EXISTS `insert_socio`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_socio`(in n_u varchar(25), nombre varchar(25) , apellido varchar(25),corr varchar(50))
BEGIN
DECLARE cantT integer;
DECLARE numSocP integer;
DECLARE rest integer;
SET cantT = (select count(*) from socio where NOMBRE_U=n_u);
SET numSocP = (select NUM_SOCIOS FROM grupo_empresa WHERE  NOMBRE_U=n_u);
SET rest = (numSocP - cantT);
IF (rest > 0) 
THEN
  INSERT INTO socio(NOMBRE_U,NOMBRES_S,APELLIDOS_S,CORREO) VALUES (n_u,nombre,apellido,corr);
  SELECT "Se registro correctamente" as errno;
 ELSE
  SELECT "Ya se registraron todos los socios" as errno;
 END IF;
END;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `registro_administrador`
-- ----------------------------
DROP PROCEDURE IF EXISTS `registro_administrador`;
DELIMITER ;;
CREATE PROCEDURE `registro_administrador`(in nom varchar(25), ape varchar(25), nom_u varchar(25), telef integer, passwd varchar(25), email varchar(50))
BEGIN

 declare n INTEGER;
 declare a INTEGER;
 declare n_u INTEGER;
 declare t INTEGER;
 declare p INTEGER;
 declare e INTEGER;
 

  set n = (SELECT nom REGEXP '[A-Z]{1}[a-záéíóú]{2,20}');
  set a = (SELECT ape REGEXP '[A-Z]{1}[a-záéíóú]{2,20}');
  set n_u = (SELECT nom_u REGEXP '^[a-zA-Z]{3}[a-zA-z0-9_\\_\ü]{0,9}$');
  set t = (SELECT telef REGEXP '^(([4][0-9]{6})|([7|6][0-9]{7}))$');
  set p = (select passwd REGEXP '.{8,}');
  set e = (SELECT email REGEXP '^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$');
  
  CASE 0
  
   WHEN n THEN (select "El nombre debe empezar con mayuscula y como minimio debe poseer 3 caracteres. Ejm: Daniel, Marcelo, Rolando" as mensaje);
   WHEN a THEN (select "El apellido debe empezar con mayuscula y como minimio debe poseer 3 caracteres. Ejm: Vargas, Morales, Medrano" as mensaje);
   WHEN n_u THEN (select "Minimo 3 caracteres y Maximo 12. Los primeros tres caracteres tienen que ser letras. Ejm: Leticia1, Rolando2" as mensaje);
   WHEN t THEN (select "Los numeros telefonicos tiene que empezar por 4,6 o 7 y deben tener un tamaño de 7 a 8 caracteres" as mensaje);
   WHEN p THEN (select "Ingrese una contraseña segura, debe tener como minimo 8 caracteres" as mensaje);
   WHEN e THEN (select "Ingrese un correo valido. Ejm: admin@hotmail.com ,admin@yahoo.com, admin@gmail.com" as mensaje);
   
  ELSE 
START TRANSACTION;
   INSERT INTO usuario VALUES(nom_u,'Habilitado',MD5(passwd),telef,email); 
   INSERT INTO usuario_rol VALUES(nom_u,'administrador');  
   INSERT INTO administrador VALUES (nom_u,nom,ape);
  
  SELECT "Se registro correctamente" as mensaje;

  END CASE;
COMMIT; 
  END;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `registro_grupo_empresa`
-- ----------------------------
DROP PROCEDURE IF EXISTS `registro_grupo_empresa`;
DELIMITER ;;
CREATE PROCEDURE `registro_grupo_empresa`(in nom_u varchar(25), telef integer, passwd varchar(25), email varchar(50), direcc varchar(25),nge_largo varchar(25),nge_corto varchar(25))
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

   WHEN n_u THEN (select "Minimo 3 caracteres y Maximo 12. Los primeros tres caracteres tienen que ser letras. Ejm: Bittle123, Bitle" as mensaje);
   WHEN t THEN (select "Los numeros telefonicos tiene que empezar por 4,6 o 7 y deben tener un tamaño de 7 a 8 caracteres" as mensaje);
   WHEN p THEN (select "Debe tener minimamente 8 caracteres" as mensaje);
   WHEN e THEN (select "Ingrese un correo correcto Ejm: admin@hotmail.com ,admin@yahoo.com, admin@gmail.com" as mensaje);
   WHEN n_l THEN (select "Minimo 3 caracteres" as mensaje);
   WHEN n_c THEN (select "Minimo 3 caracteres" as mensaje);  

  ELSE 
START TRANSACTION;
  INSERT INTO usuario VALUES (nom_u,'Habilitado',MD5(passwd),telef,email);

  INSERT INTO grupo_empresa VALUES (nom_u,nge_corto, nge_largo,direcc,"",5);

  INSERT INTO usuario_rol VALUES (nom_u,'grupoEmpresa');
  
  SELECT "Se registro correctamente" as mensaje;
  END CASE;
COMMIT;
  
  END;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `registro_usuario`
-- ----------------------------
DROP PROCEDURE IF EXISTS `registro_usuario`;
DELIMITER ;;
CREATE PROCEDURE `registro_usuario`(in nom varchar(25), ape varchar(25), nom_u varchar(25), telef integer, passwd varchar(25), email varchar(50), rol varchar(25))
BEGIN

 declare n INTEGER;
 declare a INTEGER;
 declare n_u INTEGER;
 declare t INTEGER;
 declare p INTEGER;
 declare e INTEGER;
 

  set n = (SELECT nom REGEXP '[A-Z]{1}[a-záéíóú]{2,20}');
  set a = (SELECT ape REGEXP '[A-Z]{1}[a-záéíóú]{2,20}');
  set n_u = (SELECT nom_u REGEXP '^[a-zA-Z]{3}[a-zA-z0-9_\\_\ü]{0,9}$');
  set t = (SELECT telef REGEXP '^(([4][0-9]{6})|([7|6][0-9]{7}))$');
  set p = (select passwd REGEXP '.{8,}');
  set e = (SELECT email REGEXP '^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$');
  
  CASE 0
  
   WHEN n THEN (select "El nombre debe empezar con mayuscula y como minimio debe poseer 3 caracteres. Ejm: Daniel, Marcelo, Rolando" as mensaje);
   WHEN a THEN (select "El apellido debe empezar con mayuscula y como minimo debe poseer 3 caracteres. Ejm: Quiroga Santivanez, Suarez" as mensaje);
   WHEN n_u THEN (select "Minimo 3 caracteres y Maximo 12. Los primeros tres caracteres tienen que ser letras. Ejm: Leticia1, Rolando2" as mensaje);
   WHEN t THEN (select "Los numeros telefonicos tiene que empezar por 4,6 o 7 y deben tener un tamaño de 7 a 8 caracteres" as mensaje);
   WHEN p THEN (select "Ingrese una contraseña segura, debe tener como minimo 8 caracteres" as mensaje);
   WHEN e THEN (select "Ingrese un correo valido. Ejm: admin@hotmail.com ,admin@yahoo.com, admin@gmail.com" as mensaje);
   
  ELSE 
START TRANSACTION;

   INSERT INTO usuario VALUES(nom_u,'Deshabilitado',MD5(passwd),telef,email); 
   INSERT INTO asesor VALUES(nom_u,nom,ape);  
   INSERT INTO usuario_rol VALUES(nom_u,rol);  
   INSERT INTO criteriocalificacion(NOMBRE_U,NOMBRE_CRITERIO_C,TIPO_CRITERIO) VALUES(nom_u,'PUNTAJE','4');
  
  SELECT "Se registro correctamente" as mensaje;

  END CASE;
COMMIT; 
  END;;
DELIMITER ;
