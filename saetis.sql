/*
Navicat MySQL Data Transfer
Source Server         : localhost_3306
Source Server Version : 50527
Source Host           : localhost:3306
Source Database       : saetis
Target Server Type    : MYSQL
Target Server Version : 50527
File Encoding         : 65001
Date: 2015-07-13 20:35:17
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
INSERT INTO `asistencia` VALUES ('232', '40', '1', '0');
INSERT INTO `asistencia` VALUES ('232', '41', '1', '0');
INSERT INTO `asistencia` VALUES ('232', '42', '1', '0');
INSERT INTO `asistencia` VALUES ('232', '43', '1', '0');
INSERT INTO `asistencia` VALUES ('232', '44', '1', '0');
INSERT INTO `asistencia` VALUES ('233', '40', '1', '0');
INSERT INTO `asistencia` VALUES ('233', '41', '1', '0');
INSERT INTO `asistencia` VALUES ('233', '42', '1', '0');
INSERT INTO `asistencia` VALUES ('233', '43', '1', '0');
INSERT INTO `asistencia` VALUES ('233', '44', '1', '0');
INSERT INTO `asistencia` VALUES ('234', '40', '1', '0');
INSERT INTO `asistencia` VALUES ('234', '41', '1', '0');
INSERT INTO `asistencia` VALUES ('234', '42', '1', '0');
INSERT INTO `asistencia` VALUES ('234', '43', '1', '0');
INSERT INTO `asistencia` VALUES ('234', '44', '1', '0');
INSERT INTO `asistencia` VALUES ('235', '40', '1', '0');
INSERT INTO `asistencia` VALUES ('235', '41', '1', '0');
INSERT INTO `asistencia` VALUES ('235', '42', '1', '0');
INSERT INTO `asistencia` VALUES ('235', '43', '1', '0');
INSERT INTO `asistencia` VALUES ('235', '44', '1', '0');
INSERT INTO `asistencia` VALUES ('236', '40', '1', '0');
INSERT INTO `asistencia` VALUES ('236', '41', '1', '0');
INSERT INTO `asistencia` VALUES ('236', '42', '1', '0');
INSERT INTO `asistencia` VALUES ('236', '43', '1', '0');
INSERT INTO `asistencia` VALUES ('236', '44', '1', '0');
INSERT INTO `asistencia` VALUES ('237', '40', '1', '0');
INSERT INTO `asistencia` VALUES ('237', '41', '1', '0');
INSERT INTO `asistencia` VALUES ('237', '42', '1', '0');
INSERT INTO `asistencia` VALUES ('237', '43', '1', '0');
INSERT INTO `asistencia` VALUES ('237', '44', '1', '0');
INSERT INTO `asistencia` VALUES ('238', '40', '1', '0');
INSERT INTO `asistencia` VALUES ('238', '41', '1', '0');
INSERT INTO `asistencia` VALUES ('238', '42', '1', '0');
INSERT INTO `asistencia` VALUES ('238', '43', '1', '0');
INSERT INTO `asistencia` VALUES ('238', '44', '1', '0');
INSERT INTO `asistencia` VALUES ('239', '40', '1', '0');
INSERT INTO `asistencia` VALUES ('239', '41', '1', '0');
INSERT INTO `asistencia` VALUES ('239', '42', '1', '0');
INSERT INTO `asistencia` VALUES ('239', '43', '1', '0');
INSERT INTO `asistencia` VALUES ('239', '44', '1', '0');
INSERT INTO `asistencia` VALUES ('248', '45', '1', '0');
INSERT INTO `asistencia` VALUES ('248', '46', '1', '0');
INSERT INTO `asistencia` VALUES ('248', '47', '1', '0');
INSERT INTO `asistencia` VALUES ('248', '48', '1', '0');
INSERT INTO `asistencia` VALUES ('248', '49', '1', '0');
INSERT INTO `asistencia` VALUES ('249', '45', '0', '0');
INSERT INTO `asistencia` VALUES ('249', '46', '1', '0');
INSERT INTO `asistencia` VALUES ('249', '47', '1', '0');
INSERT INTO `asistencia` VALUES ('249', '48', '1', '0');
INSERT INTO `asistencia` VALUES ('249', '49', '1', '0');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of comentarios
-- ----------------------------

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
INSERT INTO `criterio_evaluacion` VALUES ('3', 'LeticiaB', 'Organizacion');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of criteriocalificacion
-- ----------------------------
INSERT INTO `criteriocalificacion` VALUES ('1', 'LeticiaB', 'Verdadero(90)Falso(10)', '2');
INSERT INTO `criteriocalificacion` VALUES ('2', 'LeticiaB', 'Si(90)No(20)', '3');

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
INSERT INTO `descripcion` VALUES ('211', '<p>La presente invitacion publica describe los elementos centrales de las condiciones&nbsp;<span s');
INSERT INTO `descripcion` VALUES ('212', 'Entregar toda la documentacion correspondiente');
INSERT INTO `descripcion` VALUES ('213', 'Entregar toda la documentacion correspondiente');
INSERT INTO `descripcion` VALUES ('226', 'Orden de Cambio');
INSERT INTO `descripcion` VALUES ('227', 'Orden de Cambio');
INSERT INTO `descripcion` VALUES ('228', 'Orden de Cambio');
INSERT INTO `descripcion` VALUES ('229', 'Orden de Cambio');
INSERT INTO `descripcion` VALUES ('230', 'Orden de Cambio');
INSERT INTO `descripcion` VALUES ('231', 'Orden de Cambio');
INSERT INTO `descripcion` VALUES ('413', 'Contrato');
INSERT INTO `descripcion` VALUES ('414', 'Contrato');
INSERT INTO `descripcion` VALUES ('415', 'Contrato');
INSERT INTO `descripcion` VALUES ('416', 'Contrato');
INSERT INTO `descripcion` VALUES ('417', 'Contrato');
INSERT INTO `descripcion` VALUES ('418', 'Contrato');
INSERT INTO `descripcion` VALUES ('424', 'Orden de Cambio');

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
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of documento
-- ----------------------------
INSERT INTO `documento` VALUES ('68', '211', '1024', 'http://bittle.cs.umss.edu.bo/Repositorio/asesor/InvitacionPublica012015.pdf', '0', '0');
INSERT INTO `documento` VALUES ('69', '214', '607194', '/Repositorio/Devs/DevsGroup_ParteA.pdf', '1', '1');
INSERT INTO `documento` VALUES ('70', '215', '1584338', '/Repositorio/Devs/DevsGroup_parteB.pdf', '1', '1');
INSERT INTO `documento` VALUES ('71', '216', '2275', '/Repositorio/InnovaTe/ParteA_Innovate.pdf', '1', '1');
INSERT INTO `documento` VALUES ('72', '217', '1327903', '/Repositorio/InnovaTe/ParteB_InnovaTe.pdf', '1', '1');
INSERT INTO `documento` VALUES ('73', '218', '1457477', '/Repositorio/MAD/parteA.rar', '1', '1');
INSERT INTO `documento` VALUES ('74', '219', '373204', '/Repositorio/MAD/parteB.rar', '1', '1');
INSERT INTO `documento` VALUES ('75', '220', '676307', '/Repositorio/NetSky/ParteA_NetSky.pdf', '1', '1');
INSERT INTO `documento` VALUES ('76', '221', '804432', '/Repositorio/NetSky/ParteB_NetSky.pdf', '1', '1');
INSERT INTO `documento` VALUES ('77', '222', '82200', '/Repositorio/SAADS/ParteA.rar', '1', '1');
INSERT INTO `documento` VALUES ('78', '223', '251534', '/Repositorio/SAADS/ParteB.rar', '1', '1');
INSERT INTO `documento` VALUES ('79', '224', '964992', '/Repositorio/SLOW/ParteA_SLOWCODE.pdf', '1', '1');
INSERT INTO `documento` VALUES ('80', '225', '925210', '/Repositorio/SLOW/ParteB_SLOWCODE.pdf', '1', '1');
INSERT INTO `documento` VALUES ('81', '226', '1024', '../Repositorio/DevsGroup SRL/OC/ordenDeCambio.pdf', '1', '1');
INSERT INTO `documento` VALUES ('82', '227', '1024', '../Repositorio/Innovando Tecnologia SRL/OC/ordenDe', '1', '1');
INSERT INTO `documento` VALUES ('83', '228', '1024', '../Repositorio/MAD SOFTWARE SRL/OC/ordenDeCambio.p', '1', '1');
INSERT INTO `documento` VALUES ('84', '229', '1024', '../Repositorio/NetSky System SRL/OC/ordenDeCambio.', '1', '1');
INSERT INTO `documento` VALUES ('85', '230', '1024', '../Repositorio/SAADS SRL/OC/ordenDeCambio.pdf', '1', '1');
INSERT INTO `documento` VALUES ('86', '231', '1024', '../Repositorio/SLOW CODE SRL/OC/ordenDeCambio.pdf', '1', '1');
INSERT INTO `documento` VALUES ('87', '413', '1024', '../Repositorio/Contratos/CDevsGroup SRL.pdf', '0', '0');
INSERT INTO `documento` VALUES ('88', '414', '1024', '../Repositorio/Contratos/CInnovando Tecnologia SRL.pdf', '0', '0');
INSERT INTO `documento` VALUES ('89', '415', '1024', '../Repositorio/Contratos/CMAD SOFTWARE SRL.pdf', '0', '0');
INSERT INTO `documento` VALUES ('90', '416', '1024', '../Repositorio/Contratos/CNetSky System SRL.pdf', '0', '0');
INSERT INTO `documento` VALUES ('91', '417', '1024', '../Repositorio/Contratos/CSAADS SRL.pdf', '0', '0');
INSERT INTO `documento` VALUES ('92', '418', '1024', '../Repositorio/Contratos/CSLOW CODE SRL.pdf', '0', '0');
INSERT INTO `documento` VALUES ('93', '419', '1024', '/Repositorio/asesor/CPTIS.pdf', '1', '1');
INSERT INTO `documento` VALUES ('94', '420', '1024', '/Repositorio/asesor/PliegoEspecificaciones012015.pdf', '1', '1');
INSERT INTO `documento` VALUES ('95', '421', '228755', '/Repositorio/MAD/apendicea.docx', '1', '1');
INSERT INTO `documento` VALUES ('96', '422', '616990', '/Repositorio/Aska/CodigoComercio.pdf', '1', '1');
INSERT INTO `documento` VALUES ('97', '423', '151788', '/Repositorio/Aska/CPTIS.pdf', '1', '1');
INSERT INTO `documento` VALUES ('98', '424', '1024', '../Repositorio/Aska SRL/OC/ordenDeCambio.pdf', '1', '1');

-- ----------------------------
-- Table structure for `documento_r`
-- ----------------------------
DROP TABLE IF EXISTS `documento_r`;
CREATE TABLE `documento_r` (
  `ID_R` int(11) NOT NULL AUTO_INCREMENT,
  `CODIGO_P` int(11) NOT NULL,
  PRIMARY KEY (`ID_R`)
) ENGINE=InnoDB AUTO_INCREMENT=214 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of documento_r
-- ----------------------------
INSERT INTO `documento_r` VALUES ('212', '4');
INSERT INTO `documento_r` VALUES ('213', '4');

-- ----------------------------
-- Table structure for `entrega`
-- ----------------------------
DROP TABLE IF EXISTS `entrega`;
CREATE TABLE `entrega` (
  `ID_R` int(11) NOT NULL,
  `ENTREGABLE_P` varchar(30) NOT NULL,
  `ENTREGADO_P` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID_R`,`ENTREGABLE_P`) USING BTREE,
  KEY `ENTREGABLE_P` (`ENTREGABLE_P`),
  CONSTRAINT `FK_REGISTRO__PRESENTACION` FOREIGN KEY (`ID_R`) REFERENCES `registro` (`ID_R`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of entrega
-- ----------------------------
INSERT INTO `entrega` VALUES ('240', 'Documento', '1');
INSERT INTO `entrega` VALUES ('241', 'Informe', '1');
INSERT INTO `entrega` VALUES ('242', 'Informe', '1');
INSERT INTO `entrega` VALUES ('243', 'Informe', '1');
INSERT INTO `entrega` VALUES ('244', 'Informe', '1');
INSERT INTO `entrega` VALUES ('245', 'Informe', '1');
INSERT INTO `entrega` VALUES ('246', 'Informe', '0');
INSERT INTO `entrega` VALUES ('246', 'Manual', '1');
INSERT INTO `entrega` VALUES ('247', 'Informe', '1');
INSERT INTO `entrega` VALUES ('257', 'Documento', '0');
INSERT INTO `entrega` VALUES ('258', 'Informe', '0');
INSERT INTO `entrega` VALUES ('259', 'Informe', '0');
INSERT INTO `entrega` VALUES ('260', 'Informe', '0');
INSERT INTO `entrega` VALUES ('261', 'Informe', '0');
INSERT INTO `entrega` VALUES ('262', 'Informe', '0');
INSERT INTO `entrega` VALUES ('263', 'Informe', '0');
INSERT INTO `entrega` VALUES ('264', 'Manual', '0');
INSERT INTO `entrega` VALUES ('264', 'Manual de usuario', '0');
INSERT INTO `entrega` VALUES ('264', 'Manual del sist.', '0');
INSERT INTO `entrega` VALUES ('265', 'Informe', '0');
INSERT INTO `entrega` VALUES ('273', 'Documento', '0');
INSERT INTO `entrega` VALUES ('274', 'Informe QC', '0');
INSERT INTO `entrega` VALUES ('275', 'Informe QC', '0');
INSERT INTO `entrega` VALUES ('276', 'Informe QC', '0');
INSERT INTO `entrega` VALUES ('277', 'Informe QC', '0');
INSERT INTO `entrega` VALUES ('278', 'Informe QC', '0');
INSERT INTO `entrega` VALUES ('279', 'Manuales', '0');
INSERT INTO `entrega` VALUES ('286', 'DocumentaciÃ³n', '0');
INSERT INTO `entrega` VALUES ('286', 'H.U.', '0');
INSERT INTO `entrega` VALUES ('287', 'DocumentaciÃ³n', '0');
INSERT INTO `entrega` VALUES ('287', 'H.U.', '0');
INSERT INTO `entrega` VALUES ('288', 'DocumentaciÃ³n', '0');
INSERT INTO `entrega` VALUES ('288', 'H.U.', '0');
INSERT INTO `entrega` VALUES ('289', 'Manual de Inst.', '0');
INSERT INTO `entrega` VALUES ('289', 'Manual de usuario', '0');
INSERT INTO `entrega` VALUES ('289', 'Manual tÃ©cnico', '0');
INSERT INTO `entrega` VALUES ('290', 'Manual de Inst.', '0');
INSERT INTO `entrega` VALUES ('290', 'Manual de usuario', '0');
INSERT INTO `entrega` VALUES ('290', 'Manual tÃ©cnico', '0');
INSERT INTO `entrega` VALUES ('299', 'Documento', '0');
INSERT INTO `entrega` VALUES ('300', 'Entregable bÃ¡sico', '0');
INSERT INTO `entrega` VALUES ('301', 'Entregable bÃ¡sico', '0');
INSERT INTO `entrega` VALUES ('302', 'Entregable bÃ¡sico', '0');
INSERT INTO `entrega` VALUES ('302', 'H.U.', '0');
INSERT INTO `entrega` VALUES ('303', 'Entregable bÃ¡sico', '0');
INSERT INTO `entrega` VALUES ('303', 'H.U.', '0');
INSERT INTO `entrega` VALUES ('304', 'Entregable bÃ¡sico', '0');
INSERT INTO `entrega` VALUES ('304', 'H.U.', '0');
INSERT INTO `entrega` VALUES ('305', 'Entregable bÃ¡sico', '0');
INSERT INTO `entrega` VALUES ('305', 'H.U.', '0');
INSERT INTO `entrega` VALUES ('306', 'Manuales', '0');
INSERT INTO `entrega` VALUES ('405', 'Documento', '0');
INSERT INTO `entrega` VALUES ('406', 'Informe', '0');
INSERT INTO `entrega` VALUES ('407', 'VersiÃ³n', '0');
INSERT INTO `entrega` VALUES ('408', 'VersiÃ³n', '0');
INSERT INTO `entrega` VALUES ('409', 'VersiÃ³n', '0');
INSERT INTO `entrega` VALUES ('410', 'Informe', '0');
INSERT INTO `entrega` VALUES ('411', 'DocumentaciÃ³n', '0');
INSERT INTO `entrega` VALUES ('412', 'Informe', '0');

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
INSERT INTO `entregable` VALUES ('Devs', 'Manual', 'Manual de usuario');
INSERT INTO `entregable` VALUES ('InnovaTe', 'Documento', 'Documento del contrato');
INSERT INTO `entregable` VALUES ('InnovaTe', 'Informe', 'Informe de la iteracion');
INSERT INTO `entregable` VALUES ('InnovaTe', 'Manual', 'Manual de instalaciÃ³n');
INSERT INTO `entregable` VALUES ('InnovaTe', 'Manual de usuario', 'Guia para el correcto uso del sistema');
INSERT INTO `entregable` VALUES ('InnovaTe', 'Manual del sist.', 'Diagramas creados a lo largo del des.');
INSERT INTO `entregable` VALUES ('MAD', 'Documento', 'Documento del contrato');
INSERT INTO `entregable` VALUES ('MAD', 'Informe QC', 'Incremento de producto terminado');
INSERT INTO `entregable` VALUES ('MAD', 'Manuales', 'Informe QC');
INSERT INTO `entregable` VALUES ('NetSky', 'DocumentaciÃ³n', 'Protocolo de validaciÃ³n de Sprint');
INSERT INTO `entregable` VALUES ('NetSky', 'H.U.', 'Historias de Usuario');
INSERT INTO `entregable` VALUES ('NetSky', 'Manual de Inst.', 'Manual de instalaciÃ³n');
INSERT INTO `entregable` VALUES ('NetSky', 'Manual de usuario', 'Es un documento de ayuda para el usuario');
INSERT INTO `entregable` VALUES ('NetSky', 'Manual tÃ©cnico', 'Manual tÃ©cnico');
INSERT INTO `entregable` VALUES ('SAADS', 'Documento', 'Documento del contrato');
INSERT INTO `entregable` VALUES ('SAADS', 'Entregable bÃ¡sico', 'Correcciones sugeridas del sprint ant.');
INSERT INTO `entregable` VALUES ('SAADS', 'H.U.', 'Historias de Usuario');
INSERT INTO `entregable` VALUES ('SAADS', 'Manuales', 'Manual de usuario');
INSERT INTO `entregable` VALUES ('SLOW', 'DocumentaciÃ³n', 'solicitada en el pliego de peticiones.');
INSERT INTO `entregable` VALUES ('SLOW', 'Documento', 'Documento del contrato');
INSERT INTO `entregable` VALUES ('SLOW', 'Informe', 'Informe del sistema actual');
INSERT INTO `entregable` VALUES ('SLOW', 'VersiÃ³n', 'Nueva versiÃ³n del sistema');

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
INSERT INTO `evaluacion` VALUES ('232', '1', '12', '20');
INSERT INTO `evaluacion` VALUES ('233', '2', '7', '10');
INSERT INTO `evaluacion` VALUES ('234', '3', '8', '10');
INSERT INTO `evaluacion` VALUES ('235', '4', '4', '12');
INSERT INTO `evaluacion` VALUES ('236', '5', '5', '12');
INSERT INTO `evaluacion` VALUES ('237', '6', '6', '12');
INSERT INTO `evaluacion` VALUES ('238', '7', '7', '14');
INSERT INTO `evaluacion` VALUES ('239', '8', '7', '10');

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
INSERT INTO `fecha_realizacion` VALUES ('232', '2015-03-27');
INSERT INTO `fecha_realizacion` VALUES ('233', '2015-03-27');
INSERT INTO `fecha_realizacion` VALUES ('234', '2015-04-02');
INSERT INTO `fecha_realizacion` VALUES ('235', '2015-04-16');
INSERT INTO `fecha_realizacion` VALUES ('236', '2015-03-30');
INSERT INTO `fecha_realizacion` VALUES ('237', '2015-05-14');
INSERT INTO `fecha_realizacion` VALUES ('238', '2015-06-05');
INSERT INTO `fecha_realizacion` VALUES ('239', '2015-06-15');
INSERT INTO `fecha_realizacion` VALUES ('240', '2015-03-27');
INSERT INTO `fecha_realizacion` VALUES ('241', '2015-03-27');
INSERT INTO `fecha_realizacion` VALUES ('242', '2015-04-02');
INSERT INTO `fecha_realizacion` VALUES ('243', '2015-04-16');
INSERT INTO `fecha_realizacion` VALUES ('244', '2015-03-30');
INSERT INTO `fecha_realizacion` VALUES ('245', '2015-05-14');
INSERT INTO `fecha_realizacion` VALUES ('246', '2015-06-05');
INSERT INTO `fecha_realizacion` VALUES ('247', '2015-06-15');
INSERT INTO `fecha_realizacion` VALUES ('248', '2015-03-27');
INSERT INTO `fecha_realizacion` VALUES ('249', '2015-03-27');
INSERT INTO `fecha_realizacion` VALUES ('250', '2015-04-03');
INSERT INTO `fecha_realizacion` VALUES ('251', '2015-04-17');
INSERT INTO `fecha_realizacion` VALUES ('252', '2015-05-01');
INSERT INTO `fecha_realizacion` VALUES ('253', '2015-05-15');
INSERT INTO `fecha_realizacion` VALUES ('254', '2015-05-29');
INSERT INTO `fecha_realizacion` VALUES ('255', '2015-06-12');
INSERT INTO `fecha_realizacion` VALUES ('256', '2015-06-19');
INSERT INTO `fecha_realizacion` VALUES ('257', '2015-03-27');
INSERT INTO `fecha_realizacion` VALUES ('258', '2015-03-27');
INSERT INTO `fecha_realizacion` VALUES ('259', '2015-04-03');
INSERT INTO `fecha_realizacion` VALUES ('260', '2015-04-17');
INSERT INTO `fecha_realizacion` VALUES ('261', '2015-05-01');
INSERT INTO `fecha_realizacion` VALUES ('262', '2015-05-15');
INSERT INTO `fecha_realizacion` VALUES ('263', '2015-05-29');
INSERT INTO `fecha_realizacion` VALUES ('264', '2015-06-12');
INSERT INTO `fecha_realizacion` VALUES ('265', '2015-06-19');
INSERT INTO `fecha_realizacion` VALUES ('266', '2015-03-27');
INSERT INTO `fecha_realizacion` VALUES ('267', '2015-03-27');
INSERT INTO `fecha_realizacion` VALUES ('268', '2015-04-01');
INSERT INTO `fecha_realizacion` VALUES ('269', '2015-05-06');
INSERT INTO `fecha_realizacion` VALUES ('270', '2015-05-20');
INSERT INTO `fecha_realizacion` VALUES ('271', '2015-06-03');
INSERT INTO `fecha_realizacion` VALUES ('272', '2015-06-17');
INSERT INTO `fecha_realizacion` VALUES ('273', '2015-03-27');
INSERT INTO `fecha_realizacion` VALUES ('274', '2015-03-27');
INSERT INTO `fecha_realizacion` VALUES ('275', '2015-04-01');
INSERT INTO `fecha_realizacion` VALUES ('276', '2015-05-06');
INSERT INTO `fecha_realizacion` VALUES ('277', '2015-05-20');
INSERT INTO `fecha_realizacion` VALUES ('278', '2015-06-03');
INSERT INTO `fecha_realizacion` VALUES ('279', '2015-06-17');
INSERT INTO `fecha_realizacion` VALUES ('280', '2015-03-31');
INSERT INTO `fecha_realizacion` VALUES ('281', '2015-04-20');
INSERT INTO `fecha_realizacion` VALUES ('282', '2015-05-18');
INSERT INTO `fecha_realizacion` VALUES ('283', '2015-06-17');
INSERT INTO `fecha_realizacion` VALUES ('284', '2015-06-17');
INSERT INTO `fecha_realizacion` VALUES ('286', '2015-03-31');
INSERT INTO `fecha_realizacion` VALUES ('287', '2015-04-20');
INSERT INTO `fecha_realizacion` VALUES ('288', '2015-05-18');
INSERT INTO `fecha_realizacion` VALUES ('289', '2015-06-17');
INSERT INTO `fecha_realizacion` VALUES ('290', '2015-06-17');
INSERT INTO `fecha_realizacion` VALUES ('291', '2015-03-27');
INSERT INTO `fecha_realizacion` VALUES ('292', '2015-03-27');
INSERT INTO `fecha_realizacion` VALUES ('293', '2015-04-03');
INSERT INTO `fecha_realizacion` VALUES ('294', '2015-04-17');
INSERT INTO `fecha_realizacion` VALUES ('295', '2015-05-01');
INSERT INTO `fecha_realizacion` VALUES ('296', '2015-05-15');
INSERT INTO `fecha_realizacion` VALUES ('297', '2015-05-29');
INSERT INTO `fecha_realizacion` VALUES ('298', '2015-06-12');
INSERT INTO `fecha_realizacion` VALUES ('299', '2015-03-27');
INSERT INTO `fecha_realizacion` VALUES ('300', '2015-03-27');
INSERT INTO `fecha_realizacion` VALUES ('301', '2015-04-03');
INSERT INTO `fecha_realizacion` VALUES ('302', '2015-04-17');
INSERT INTO `fecha_realizacion` VALUES ('303', '2015-05-01');
INSERT INTO `fecha_realizacion` VALUES ('304', '2015-05-15');
INSERT INTO `fecha_realizacion` VALUES ('305', '2015-05-29');
INSERT INTO `fecha_realizacion` VALUES ('306', '2015-06-12');
INSERT INTO `fecha_realizacion` VALUES ('307', '2015-03-27');
INSERT INTO `fecha_realizacion` VALUES ('308', '2015-03-27');
INSERT INTO `fecha_realizacion` VALUES ('309', '2015-04-10');
INSERT INTO `fecha_realizacion` VALUES ('400', '2015-04-24');
INSERT INTO `fecha_realizacion` VALUES ('401', '2015-05-08');
INSERT INTO `fecha_realizacion` VALUES ('402', '2015-05-22');
INSERT INTO `fecha_realizacion` VALUES ('403', '2015-06-05');
INSERT INTO `fecha_realizacion` VALUES ('404', '2015-06-12');
INSERT INTO `fecha_realizacion` VALUES ('405', '2015-03-27');
INSERT INTO `fecha_realizacion` VALUES ('406', '2015-03-27');
INSERT INTO `fecha_realizacion` VALUES ('407', '2015-04-10');
INSERT INTO `fecha_realizacion` VALUES ('408', '2015-04-24');
INSERT INTO `fecha_realizacion` VALUES ('409', '2015-05-08');
INSERT INTO `fecha_realizacion` VALUES ('410', '2015-05-22');
INSERT INTO `fecha_realizacion` VALUES ('411', '2015-06-05');
INSERT INTO `fecha_realizacion` VALUES ('412', '2015-06-12');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of form_crit_e
-- ----------------------------
INSERT INTO `form_crit_e` VALUES ('1', '4', '1');
INSERT INTO `form_crit_e` VALUES ('2', '4', '2');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of formulario
-- ----------------------------
INSERT INTO `formulario` VALUES ('3', 'LeticiaB', 'formulario1', 'Deshabilitado');
INSERT INTO `formulario` VALUES ('4', 'LeticiaB', 'formulario2', 'Habilitado');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of from_crit_c
-- ----------------------------
INSERT INTO `from_crit_c` VALUES ('1', '2', '4');
INSERT INTO `from_crit_c` VALUES ('2', '2', '4');

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
INSERT INTO `gestion` VALUES ('1', 'I/2015', '2015-01-01', '2015-07-30');
INSERT INTO `gestion` VALUES ('8', 'I/2015', '2015-03-25', '2015-07-30');

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
INSERT INTO `grupo_empresa` VALUES ('AiraSoft', 'AiraSoft', 'AiraSoft SRL', 'Anónimo', '', '5');
INSERT INTO `grupo_empresa` VALUES ('Akira', 'Akira', 'Akira Soft', 'Anónimo', '', '5');
INSERT INTO `grupo_empresa` VALUES ('Altec', 'Altec', 'Experiencia y Alata Tecno', 'Anónimo', '', '5');
INSERT INTO `grupo_empresa` VALUES ('ANDE', 'ANDESOFT', 'ANDESOFT SRL', 'Anónimo', '', '5');
INSERT INTO `grupo_empresa` VALUES ('ANKA', 'ANKA SOFT', 'ANKA SOFT SRL', 'Anónimo', '', '5');
INSERT INTO `grupo_empresa` VALUES ('Answer', 'Answer', 'Answer SRL', 'Anónimo', '', '5');
INSERT INTO `grupo_empresa` VALUES ('Aracorp', 'Aracorp', 'Aracorp SRL', 'Anónimo', '', '5');
INSERT INTO `grupo_empresa` VALUES ('ARGOS', 'ARGOS', 'ARGOS SRL', 'Anónimo', '', '5');
INSERT INTO `grupo_empresa` VALUES ('Arkano', 'Arkano', 'Arkano Soft', 'Anónimo', '', '5');
INSERT INTO `grupo_empresa` VALUES ('Aska', 'Aska', 'Aska SRL', 'Anónimo', 'Ricardo Fuentes', '5');
INSERT INTO `grupo_empresa` VALUES ('ASSI', 'ASSI', 'ASSI SRL', 'Anónimo', '', '5');
INSERT INTO `grupo_empresa` VALUES ('Devs', 'Devs Group', 'DevsGroup SRL', 'Av.Ladislao Cabrera NÂ°567', 'Vania Marisela Catorceno Carballo', '5');
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of indicador
-- ----------------------------
INSERT INTO `indicador` VALUES ('1', '1', 'Verdadero', '90');
INSERT INTO `indicador` VALUES ('2', '1', 'Falso', '10');
INSERT INTO `indicador` VALUES ('3', '2', 'Si', '90');
INSERT INTO `indicador` VALUES ('4', '2', 'No', '20');

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
INSERT INTO `inscripcion` VALUES ('LeticiaB', 'Aska', 'Habilitado');
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
INSERT INTO `inscripcion_proyecto` VALUES ('4', 'Aska', 'Sin Firmar');
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
INSERT INTO `lista_ge` VALUES ('InnovaTe', 'Innovando Tecnologia SRL', 'C. Tarija N&deg;1520', null);
INSERT INTO `lista_ge` VALUES ('Devs Group', 'DevsGroup SRL', 'Av.Ladislao Cabrera N&deg', null);
INSERT INTO `lista_ge` VALUES ('MAD', 'MAD SOFTWARE SRL', 'Av. Rodriguez Morales N&d', null);
INSERT INTO `lista_ge` VALUES ('SLOW CODE', 'SLOW CODE SRL', 'C/ Dario Monta&ntilde;o #', null);
INSERT INTO `lista_ge` VALUES ('SAADS', 'SAADS SRL', 'Av. Melchor Perez #1312', null);
INSERT INTO `lista_ge` VALUES ('NetSky', 'NetSky System SRL', 'Sipe Sipe Calle Gualberto', null);
INSERT INTO `lista_ge` VALUES ('Aska', 'Aska SRL', 'Anónimo', null);

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
INSERT INTO `nota` VALUES ('1', '4', 'Devs', '48');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of nota_final
-- ----------------------------
INSERT INTO `nota_final` VALUES ('1', 'Devs', '52.8');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of noticias
-- ----------------------------

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
INSERT INTO `pago` VALUES ('240', '13600', '20');
INSERT INTO `pago` VALUES ('241', '6800', '10');
INSERT INTO `pago` VALUES ('242', '6800', '10');
INSERT INTO `pago` VALUES ('243', '8160', '12');
INSERT INTO `pago` VALUES ('244', '8160', '12');
INSERT INTO `pago` VALUES ('245', '8160', '12');
INSERT INTO `pago` VALUES ('246', '9520', '14');
INSERT INTO `pago` VALUES ('247', '6800', '10');
INSERT INTO `pago` VALUES ('257', '8211', '30');
INSERT INTO `pago` VALUES ('258', '2737', '10');
INSERT INTO `pago` VALUES ('259', '2737', '10');
INSERT INTO `pago` VALUES ('260', '2737', '10');
INSERT INTO `pago` VALUES ('261', '2737', '10');
INSERT INTO `pago` VALUES ('262', '2737', '10');
INSERT INTO `pago` VALUES ('263', '2737', '10');
INSERT INTO `pago` VALUES ('264', '1369', '5');
INSERT INTO `pago` VALUES ('265', '1369', '5');
INSERT INTO `pago` VALUES ('273', '24415', '20');
INSERT INTO `pago` VALUES ('274', '0', '0');
INSERT INTO `pago` VALUES ('275', '0', '0');
INSERT INTO `pago` VALUES ('276', '24415', '20');
INSERT INTO `pago` VALUES ('277', '24415', '20');
INSERT INTO `pago` VALUES ('278', '24415', '20');
INSERT INTO `pago` VALUES ('279', '24415', '20');
INSERT INTO `pago` VALUES ('286', '11226', '15');
INSERT INTO `pago` VALUES ('287', '22452', '30');
INSERT INTO `pago` VALUES ('288', '26194', '35');
INSERT INTO `pago` VALUES ('289', '11226', '15');
INSERT INTO `pago` VALUES ('290', '3742', '5');
INSERT INTO `pago` VALUES ('299', '11089', '17');
INSERT INTO `pago` VALUES ('300', '0', '0');
INSERT INTO `pago` VALUES ('301', '0', '0');
INSERT INTO `pago` VALUES ('302', '11089', '17');
INSERT INTO `pago` VALUES ('303', '11089', '17');
INSERT INTO `pago` VALUES ('304', '11089', '17');
INSERT INTO `pago` VALUES ('305', '11089', '17');
INSERT INTO `pago` VALUES ('306', '11089', '17');
INSERT INTO `pago` VALUES ('405', '2430', '25');
INSERT INTO `pago` VALUES ('406', '972', '10');
INSERT INTO `pago` VALUES ('407', '972', '10');
INSERT INTO `pago` VALUES ('408', '1458', '15');
INSERT INTO `pago` VALUES ('409', '972', '10');
INSERT INTO `pago` VALUES ('410', '972', '10');
INSERT INTO `pago` VALUES ('411', '972', '10');
INSERT INTO `pago` VALUES ('412', '972', '10');

-- ----------------------------
-- Table structure for `parte_entregable`
-- ----------------------------
DROP TABLE IF EXISTS `parte_entregable`;
CREATE TABLE `parte_entregable` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_R` int(11) NOT NULL,
  `ENTREGABLE_P` varchar(30) NOT NULL,
  `NOMBRE` varchar(75) NOT NULL,
  `NOTA` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_ID_R` (`ID_R`),
  KEY `FK_ENTREGABLE` (`ENTREGABLE_P`),
  CONSTRAINT `FK_ENTREGABLE` FOREIGN KEY (`ENTREGABLE_P`) REFERENCES `entrega` (`ENTREGABLE_P`),
  CONSTRAINT `FK_ID_R` FOREIGN KEY (`ID_R`) REFERENCES `entrega` (`ID_R`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of parte_entregable
-- ----------------------------
INSERT INTO `parte_entregable` VALUES ('1', '302', 'H.U.', 'HU1', '30');

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
INSERT INTO `periodo` VALUES ('211', '2015-03-12', '08:00:00');
INSERT INTO `periodo` VALUES ('226', '2015-07-01', '16:15:52');
INSERT INTO `periodo` VALUES ('227', '2015-07-01', '16:20:35');
INSERT INTO `periodo` VALUES ('228', '2015-07-01', '16:23:57');
INSERT INTO `periodo` VALUES ('229', '2015-07-01', '16:25:34');
INSERT INTO `periodo` VALUES ('230', '2015-07-01', '16:27:20');
INSERT INTO `periodo` VALUES ('231', '2015-07-01', '16:29:25');
INSERT INTO `periodo` VALUES ('424', '2015-07-06', '13:14:31');

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
INSERT INTO `planificacion` VALUES ('Aska', 'registrar planificacion', '2014-12-12', '2020-12-12');
INSERT INTO `planificacion` VALUES ('Devs', 'planificacion registrada', '2015-03-16', '2015-07-30');
INSERT INTO `planificacion` VALUES ('InnovaTe', 'planificacion registrada', '2015-03-16', '2015-07-30');
INSERT INTO `planificacion` VALUES ('MAD', 'planificacion registrada', '2015-03-16', '2015-07-30');
INSERT INTO `planificacion` VALUES ('NetSky', 'planificacion registrada', '2015-03-16', '2015-07-30');
INSERT INTO `planificacion` VALUES ('SAADS', 'planificacion registrada', '2015-03-16', '2015-07-30');
INSERT INTO `planificacion` VALUES ('SLOW', 'planificacion registrada', '2015-03-16', '2015-07-30');

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
INSERT INTO `plazo` VALUES ('212', '2015-03-12', '2015-07-06', '08:00:00', '17:00:00');
INSERT INTO `plazo` VALUES ('213', '2015-03-12', '2015-07-06', '08:00:00', '17:00:00');

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
INSERT INTO `precio` VALUES ('SLOW', '9718', '75');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of puntaje
-- ----------------------------
INSERT INTO `puntaje` VALUES ('1', '4', '40');
INSERT INTO `puntaje` VALUES ('2', '4', '60');

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
INSERT INTO `puntaje_ge` VALUES ('1', '1', '0', '90');
INSERT INTO `puntaje_ge` VALUES ('2', '1', '1', '20');

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
INSERT INTO `receptor` VALUES ('211', 'PUBLICO');
INSERT INTO `receptor` VALUES ('226', 'DevsGroup SRL');
INSERT INTO `receptor` VALUES ('227', 'Innovando Tecnologia SRL');
INSERT INTO `receptor` VALUES ('228', 'MAD SOFTWARE SRL');
INSERT INTO `receptor` VALUES ('229', 'NetSky System SRL');
INSERT INTO `receptor` VALUES ('230', 'SAADS SRL');
INSERT INTO `receptor` VALUES ('231', 'SLOW CODE SRL');
INSERT INTO `receptor` VALUES ('413', 'DevsGroup SRL');
INSERT INTO `receptor` VALUES ('414', 'Innovando Tecnologia SRL');
INSERT INTO `receptor` VALUES ('415', 'MAD SOFTWARE SRL');
INSERT INTO `receptor` VALUES ('416', 'NetSky System SRL');
INSERT INTO `receptor` VALUES ('417', 'SAADS SRL');
INSERT INTO `receptor` VALUES ('418', 'SLOW CODE SRL');
INSERT INTO `receptor` VALUES ('424', 'Aska SRL');

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
) ENGINE=InnoDB AUTO_INCREMENT=425 DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=8192;

-- ----------------------------
-- Records of registro
-- ----------------------------
INSERT INTO `registro` VALUES ('209', 'LeticiaB', 'documento subido', 'Habilitado', 'CPTIS.PDF', '2015-07-01', '15:15:57');
INSERT INTO `registro` VALUES ('210', 'LeticiaB', 'documento subido', 'Habilitado', 'FETIS.pdf', '2015-07-01', '15:15:58');
INSERT INTO `registro` VALUES ('211', 'LeticiaB', 'publicaciones', 'Habilitado', 'CPTIS', '2015-07-01', '21:21:59');
INSERT INTO `registro` VALUES ('212', 'LeticiaB', 'documento requerido', 'Habilitado', 'Parte A', '2015-07-01', '16:05:36');
INSERT INTO `registro` VALUES ('213', 'LeticiaB', 'documento requerido', 'Habilitado', 'Parte B', '2015-07-01', '16:06:08');
INSERT INTO `registro` VALUES ('214', 'Devs', 'documento subido', 'habilitado', 'Parte A', '2015-07-01', '16:07:04');
INSERT INTO `registro` VALUES ('215', 'Devs', 'documento subido', 'habilitado', 'Parte B', '2015-07-01', '16:07:45');
INSERT INTO `registro` VALUES ('216', 'InnovaTe', 'documento subido', 'habilitado', 'Parte A', '2015-07-05', '23:15:02');
INSERT INTO `registro` VALUES ('217', 'InnovaTe', 'documento subido', 'habilitado', 'Parte B', '2015-07-01', '16:08:25');
INSERT INTO `registro` VALUES ('218', 'MAD', 'documento subido', 'habilitado', 'Parte A', '2015-07-01', '16:08:50');
INSERT INTO `registro` VALUES ('219', 'MAD', 'documento subido', 'habilitado', 'Parte B', '2015-07-01', '16:09:01');
INSERT INTO `registro` VALUES ('220', 'NetSky', 'documento subido', 'habilitado', 'Parte A', '2015-07-01', '16:09:24');
INSERT INTO `registro` VALUES ('221', 'NetSky', 'documento subido', 'habilitado', 'Parte B', '2015-07-01', '16:09:36');
INSERT INTO `registro` VALUES ('222', 'SAADS', 'documento subido', 'habilitado', 'Parte A', '2015-07-01', '16:09:53');
INSERT INTO `registro` VALUES ('223', 'SAADS', 'documento subido', 'habilitado', 'Parte B', '2015-07-01', '16:10:03');
INSERT INTO `registro` VALUES ('224', 'SLOW', 'documento subido', 'habilitado', 'Parte A', '2015-07-01', '16:10:31');
INSERT INTO `registro` VALUES ('225', 'SLOW', 'documento subido', 'habilitado', 'Parte B', '2015-07-01', '16:10:39');
INSERT INTO `registro` VALUES ('226', 'LeticiaB', 'publicaciones', 'Habilitado', 'Orden de Cambio', '2015-07-01', '16:15:52');
INSERT INTO `registro` VALUES ('227', 'LeticiaB', 'publicaciones', 'Habilitado', 'Orden de Cambio', '2015-07-01', '16:20:35');
INSERT INTO `registro` VALUES ('228', 'LeticiaB', 'publicaciones', 'Habilitado', 'Orden de Cambio', '2015-07-01', '16:23:57');
INSERT INTO `registro` VALUES ('229', 'LeticiaB', 'publicaciones', 'Habilitado', 'Orden de Cambio', '2015-07-01', '16:25:34');
INSERT INTO `registro` VALUES ('230', 'LeticiaB', 'publicaciones', 'Habilitado', 'Orden de Cambio', '2015-07-01', '16:27:20');
INSERT INTO `registro` VALUES ('231', 'LeticiaB', 'publicaciones', 'Habilitado', 'Orden de Cambio', '2015-07-01', '16:29:25');
INSERT INTO `registro` VALUES ('232', 'Devs', 'actividad planificacion', 'en proceso', 'Firma de contrato', '2015-07-01', '16:40:02');
INSERT INTO `registro` VALUES ('233', 'Devs', 'actividad planificacion', 'en proceso', 'Sprint 0', '2015-07-01', '16:40:03');
INSERT INTO `registro` VALUES ('234', 'Devs', 'actividad planificacion', 'en proceso', 'Sprint 1', '2015-07-01', '16:40:03');
INSERT INTO `registro` VALUES ('235', 'Devs', 'actividad planificacion', 'en proceso', 'Sprint 2', '2015-07-01', '16:40:03');
INSERT INTO `registro` VALUES ('236', 'Devs', 'actividad planificacion', 'en proceso', 'Sprint 3', '2015-07-01', '16:40:03');
INSERT INTO `registro` VALUES ('237', 'Devs', 'actividad planificacion', 'en proceso', 'Sprint 4', '2015-07-01', '16:40:03');
INSERT INTO `registro` VALUES ('238', 'Devs', 'actividad planificacion', 'en proceso', 'Transferencia de Tec', '2015-07-01', '16:40:03');
INSERT INTO `registro` VALUES ('239', 'Devs', 'actividad planificacion', 'en proceso', 'Capacitacion', '2015-07-01', '16:40:03');
INSERT INTO `registro` VALUES ('240', 'Devs', 'pago planificacion', 'en proceso', 'Firma de contrato', '2015-07-01', '16:58:31');
INSERT INTO `registro` VALUES ('241', 'Devs', 'pago planificacion', 'en proceso', 'Sprint 0', '2015-07-01', '16:58:31');
INSERT INTO `registro` VALUES ('242', 'Devs', 'pago planificacion', 'en proceso', 'Sprint 1', '2015-07-01', '16:58:31');
INSERT INTO `registro` VALUES ('243', 'Devs', 'pago planificacion', 'en proceso', 'Sprint 2', '2015-07-01', '16:58:32');
INSERT INTO `registro` VALUES ('244', 'Devs', 'pago planificacion', 'en proceso', 'Sprint 3', '2015-07-01', '16:58:32');
INSERT INTO `registro` VALUES ('245', 'Devs', 'pago planificacion', 'en proceso', 'Sprint 4', '2015-07-01', '16:58:32');
INSERT INTO `registro` VALUES ('246', 'Devs', 'pago planificacion', 'en proceso', 'Transferencia de Tec', '2015-07-01', '16:58:32');
INSERT INTO `registro` VALUES ('247', 'Devs', 'pago planificacion', 'en proceso', 'Capacitacion', '2015-07-01', '16:58:32');
INSERT INTO `registro` VALUES ('248', 'InnovaTe', 'actividad planificacion', 'en proceso', 'Firma de contrato', '2015-07-01', '17:03:55');
INSERT INTO `registro` VALUES ('249', 'InnovaTe', 'actividad planificacion', 'en proceso', 'IteraciÃ³n 1', '2015-07-01', '17:03:56');
INSERT INTO `registro` VALUES ('250', 'InnovaTe', 'actividad planificacion', 'en proceso', 'IteraciÃ³n 2', '2015-07-01', '17:03:56');
INSERT INTO `registro` VALUES ('251', 'InnovaTe', 'actividad planificacion', 'en proceso', 'IteraciÃ³n 3', '2015-07-01', '17:03:56');
INSERT INTO `registro` VALUES ('252', 'InnovaTe', 'actividad planificacion', 'en proceso', 'IteraciÃ³n 4', '2015-07-01', '17:03:56');
INSERT INTO `registro` VALUES ('253', 'InnovaTe', 'actividad planificacion', 'en proceso', 'IteraciÃ³n 5', '2015-07-01', '17:03:56');
INSERT INTO `registro` VALUES ('254', 'InnovaTe', 'actividad planificacion', 'en proceso', 'IteraciÃ³n 6', '2015-07-01', '17:03:56');
INSERT INTO `registro` VALUES ('255', 'InnovaTe', 'actividad planificacion', 'en proceso', 'Entrega', '2015-07-01', '17:03:56');
INSERT INTO `registro` VALUES ('256', 'InnovaTe', 'actividad planificacion', 'en proceso', 'EvaluaciÃ³n', '2015-07-01', '17:07:19');
INSERT INTO `registro` VALUES ('257', 'InnovaTe', 'pago planificacion', 'en proceso', 'Firma de contrato', '2015-07-01', '17:21:54');
INSERT INTO `registro` VALUES ('258', 'InnovaTe', 'pago planificacion', 'en proceso', 'IteraciÃ³n 1', '2015-07-01', '17:21:55');
INSERT INTO `registro` VALUES ('259', 'InnovaTe', 'pago planificacion', 'en proceso', 'IteraciÃ³n 2', '2015-07-01', '17:21:55');
INSERT INTO `registro` VALUES ('260', 'InnovaTe', 'pago planificacion', 'en proceso', 'IteraciÃ³n 3', '2015-07-01', '17:21:55');
INSERT INTO `registro` VALUES ('261', 'InnovaTe', 'pago planificacion', 'en proceso', 'IteraciÃ³n 4', '2015-07-01', '17:21:55');
INSERT INTO `registro` VALUES ('262', 'InnovaTe', 'pago planificacion', 'en proceso', 'IteraciÃ³n 5', '2015-07-01', '17:21:56');
INSERT INTO `registro` VALUES ('263', 'InnovaTe', 'pago planificacion', 'en proceso', 'IteraciÃ³n 6', '2015-07-01', '17:21:56');
INSERT INTO `registro` VALUES ('264', 'InnovaTe', 'pago planificacion', 'en proceso', 'Entrega', '2015-07-01', '17:21:56');
INSERT INTO `registro` VALUES ('265', 'InnovaTe', 'pago planificacion', 'en proceso', 'EvaluaciÃ³n', '2015-07-01', '17:21:56');
INSERT INTO `registro` VALUES ('266', 'MAD', 'actividad planificacion', 'en proceso', 'Firma de contrato', '2015-07-01', '17:26:56');
INSERT INTO `registro` VALUES ('267', 'MAD', 'actividad planificacion', 'en proceso', 'Sprint 1', '2015-07-01', '17:26:56');
INSERT INTO `registro` VALUES ('268', 'MAD', 'actividad planificacion', 'en proceso', 'Sprint 2', '2015-07-01', '17:29:00');
INSERT INTO `registro` VALUES ('269', 'MAD', 'actividad planificacion', 'en proceso', 'Sprint 3', '2015-07-01', '17:29:55');
INSERT INTO `registro` VALUES ('270', 'MAD', 'actividad planificacion', 'en proceso', 'Sprint 4', '2015-07-01', '17:30:50');
INSERT INTO `registro` VALUES ('271', 'MAD', 'actividad planificacion', 'en proceso', 'Sprint 5', '2015-07-01', '17:31:29');
INSERT INTO `registro` VALUES ('272', 'MAD', 'actividad planificacion', 'en proceso', 'Sprint 6', '2015-07-01', '17:32:08');
INSERT INTO `registro` VALUES ('273', 'MAD', 'pago planificacion', 'en proceso', 'Firma de contrato', '2015-07-01', '17:42:35');
INSERT INTO `registro` VALUES ('274', 'MAD', 'pago planificacion', 'en proceso', 'Sprint 1', '2015-07-01', '17:42:35');
INSERT INTO `registro` VALUES ('275', 'MAD', 'pago planificacion', 'en proceso', 'Sprint 2', '2015-07-01', '17:42:35');
INSERT INTO `registro` VALUES ('276', 'MAD', 'pago planificacion', 'en proceso', 'Sprint 3', '2015-07-01', '17:42:35');
INSERT INTO `registro` VALUES ('277', 'MAD', 'pago planificacion', 'en proceso', 'Sprint 4', '2015-07-01', '17:42:36');
INSERT INTO `registro` VALUES ('278', 'MAD', 'pago planificacion', 'en proceso', 'Sprint 5', '2015-07-01', '17:42:36');
INSERT INTO `registro` VALUES ('279', 'MAD', 'pago planificacion', 'en proceso', 'Sprint 6', '2015-07-01', '17:42:36');
INSERT INTO `registro` VALUES ('280', 'NetSky', 'actividad planificacion', 'en proceso', 'Sprint 1', '2015-07-01', '17:46:24');
INSERT INTO `registro` VALUES ('281', 'NetSky', 'actividad planificacion', 'en proceso', 'Sprint 2', '2015-07-01', '17:46:56');
INSERT INTO `registro` VALUES ('282', 'NetSky', 'actividad planificacion', 'en proceso', 'Sprint 3', '2015-07-01', '17:47:32');
INSERT INTO `registro` VALUES ('283', 'NetSky', 'actividad planificacion', 'en proceso', 'Tranferencia de Tecnologia', '2015-07-01', '17:48:20');
INSERT INTO `registro` VALUES ('284', 'NetSky', 'actividad planificacion', 'en proceso', 'Capacitacion', '2015-07-01', '17:49:15');
INSERT INTO `registro` VALUES ('286', 'NetSky', 'pago planificacion', 'en proceso', 'Sprint 1', '2015-07-01', '18:01:13');
INSERT INTO `registro` VALUES ('287', 'NetSky', 'pago planificacion', 'en proceso', 'Sprint 2', '2015-07-01', '18:01:13');
INSERT INTO `registro` VALUES ('288', 'NetSky', 'pago planificacion', 'en proceso', 'Sprint 3', '2015-07-01', '18:01:14');
INSERT INTO `registro` VALUES ('289', 'NetSky', 'pago planificacion', 'en proceso', 'Tranferencia de Tecnologia', '2015-07-01', '18:01:14');
INSERT INTO `registro` VALUES ('290', 'NetSky', 'pago planificacion', 'en proceso', 'Capacitaciï¿½n', '2015-07-01', '18:01:14');
INSERT INTO `registro` VALUES ('291', 'SAADS', 'actividad planificacion', 'en proceso', 'Firma de contrato', '2015-07-01', '18:08:53');
INSERT INTO `registro` VALUES ('292', 'SAADS', 'actividad planificacion', 'en proceso', 'Sprint 0', '2015-07-01', '18:09:50');
INSERT INTO `registro` VALUES ('293', 'SAADS', 'actividad planificacion', 'en proceso', 'Sprint 1', '2015-07-01', '18:10:35');
INSERT INTO `registro` VALUES ('294', 'SAADS', 'actividad planificacion', 'en proceso', 'Sprint 2', '2015-07-01', '18:11:25');
INSERT INTO `registro` VALUES ('295', 'SAADS', 'actividad planificacion', 'en proceso', 'Sprint 3', '2015-07-01', '18:12:03');
INSERT INTO `registro` VALUES ('296', 'SAADS', 'actividad planificacion', 'en proceso', 'Sprint 4', '2015-07-01', '18:12:54');
INSERT INTO `registro` VALUES ('297', 'SAADS', 'actividad planificacion', 'en proceso', 'Sprint 5', '2015-07-01', '18:13:53');
INSERT INTO `registro` VALUES ('298', 'SAADS', 'actividad planificacion', 'en proceso', 'Sprint 6', '2015-07-01', '18:16:47');
INSERT INTO `registro` VALUES ('299', 'SAADS', 'pago planificacion', 'en proceso', 'Firma de contrato', '2015-07-01', '18:29:51');
INSERT INTO `registro` VALUES ('300', 'SAADS', 'pago planificacion', 'en proceso', 'Sprint 0', '2015-07-01', '18:29:51');
INSERT INTO `registro` VALUES ('301', 'SAADS', 'pago planificacion', 'en proceso', 'Sprint 1', '2015-07-01', '18:29:51');
INSERT INTO `registro` VALUES ('302', 'SAADS', 'pago planificacion', 'en proceso', 'Sprint 2', '2015-07-01', '18:29:51');
INSERT INTO `registro` VALUES ('303', 'SAADS', 'pago planificacion', 'en proceso', 'Sprint 3', '2015-07-01', '18:29:51');
INSERT INTO `registro` VALUES ('304', 'SAADS', 'pago planificacion', 'en proceso', 'Sprint 4', '2015-07-01', '18:29:52');
INSERT INTO `registro` VALUES ('305', 'SAADS', 'pago planificacion', 'en proceso', 'Sprint 5', '2015-07-01', '18:29:52');
INSERT INTO `registro` VALUES ('306', 'SAADS', 'pago planificacion', 'en proceso', 'Sprint 6', '2015-07-01', '18:29:52');
INSERT INTO `registro` VALUES ('307', 'SLOW', 'actividad planificacion', 'en proceso', 'Firma de contrato', '2015-07-01', '18:32:52');
INSERT INTO `registro` VALUES ('308', 'SLOW', 'actividad planificacion', 'en proceso', 'Evaluacion', '2015-07-01', '18:33:27');
INSERT INTO `registro` VALUES ('309', 'SLOW', 'actividad planificacion', 'en proceso', 'Sprint 1', '2015-07-01', '18:33:56');
INSERT INTO `registro` VALUES ('400', 'SLOW', 'actividad planificacion', 'en proceso', 'Sprint 2', '2015-07-01', '18:34:32');
INSERT INTO `registro` VALUES ('401', 'SLOW', 'actividad planificacion', 'en proceso', 'Sprint 3', '2015-07-01', '18:35:06');
INSERT INTO `registro` VALUES ('402', 'SLOW', 'actividad planificacion', 'en proceso', 'Sprint 4', '2015-07-01', '18:35:59');
INSERT INTO `registro` VALUES ('403', 'SLOW', 'actividad planificacion', 'en proceso', 'Finalizacion y entrega', '2015-07-01', '18:36:37');
INSERT INTO `registro` VALUES ('404', 'SLOW', 'actividad planificacion', 'en proceso', 'Capacitacion', '2015-07-01', '18:40:52');
INSERT INTO `registro` VALUES ('405', 'SLOW', 'pago planificacion', 'en proceso', 'Firma de contrato', '2015-07-01', '18:53:30');
INSERT INTO `registro` VALUES ('406', 'SLOW', 'pago planificacion', 'en proceso', 'Evaluacion', '2015-07-01', '18:53:31');
INSERT INTO `registro` VALUES ('407', 'SLOW', 'pago planificacion', 'en proceso', 'Sprint 1', '2015-07-01', '18:53:31');
INSERT INTO `registro` VALUES ('408', 'SLOW', 'pago planificacion', 'en proceso', 'Sprint 2', '2015-07-01', '18:53:31');
INSERT INTO `registro` VALUES ('409', 'SLOW', 'pago planificacion', 'en proceso', 'Sprint 3', '2015-07-01', '18:53:31');
INSERT INTO `registro` VALUES ('410', 'SLOW', 'pago planificacion', 'en proceso', 'Sprint 4', '2015-07-01', '18:53:31');
INSERT INTO `registro` VALUES ('411', 'SLOW', 'pago planificacion', 'en proceso', 'Finalizacion y entrega', '2015-07-01', '18:53:32');
INSERT INTO `registro` VALUES ('412', 'SLOW', 'pago planificacion', 'en proceso', 'Capacitacion', '2015-07-01', '18:53:32');
INSERT INTO `registro` VALUES ('413', 'LeticiaB', 'Contrato', 'Habilitado', 'ContratoDevs Group.pdf', '2015-07-02', '00:00:55');
INSERT INTO `registro` VALUES ('414', 'LeticiaB', 'Contrato', 'Habilitado', 'ContratoInnovaTe.pdf', '2015-07-02', '00:00:55');
INSERT INTO `registro` VALUES ('415', 'LeticiaB', 'Contrato', 'Habilitado', 'ContratoMAD.pdf', '2015-07-02', '00:00:55');
INSERT INTO `registro` VALUES ('416', 'LeticiaB', 'Contrato', 'Habilitado', 'ContratoNetSky.pdf', '2015-07-02', '00:00:55');
INSERT INTO `registro` VALUES ('417', 'LeticiaB', 'Contrato', 'Habilitado', 'ContratoSAADS.pdf', '2015-07-02', '00:00:55');
INSERT INTO `registro` VALUES ('418', 'LeticiaB', 'Contrato', 'Habilitado', 'ContratoSLOW CODE.pdf', '2015-07-02', '00:00:55');
INSERT INTO `registro` VALUES ('419', 'LeticiaB', 'documento subido', 'Habilitado', 'CPTIS.pdf', '2015-07-06', '11:11:33');
INSERT INTO `registro` VALUES ('420', 'LeticiaB', 'documento subido', 'Habilitado', 'PliegoEspecificaciones012015.pdf', '2015-07-06', '11:11:33');
INSERT INTO `registro` VALUES ('421', 'MAD', 'documento subido', 'habilitado', 'Sprint 1', '2015-07-06', '12:48:45');
INSERT INTO `registro` VALUES ('422', 'Aska', 'documento subido', 'habilitado', 'Parte A', '2015-07-06', '13:12:19');
INSERT INTO `registro` VALUES ('423', 'Aska', 'documento subido', 'habilitado', 'Parte B', '2015-07-06', '13:12:39');
INSERT INTO `registro` VALUES ('424', 'LeticiaB', 'publicaciones', 'Habilitado', 'Orden de Cambio', '2015-07-06', '13:14:31');

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
) ENGINE=InnoDB AUTO_INCREMENT=303 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sesion
-- ----------------------------
INSERT INTO `sesion` VALUES ('231', 'Devs', '2015-07-01', '15:59:27', '::1');
INSERT INTO `sesion` VALUES ('232', 'Devs', '2015-07-01', '16:01:58', '::1');
INSERT INTO `sesion` VALUES ('233', 'LeticiaB', '2015-07-01', '16:02:17', '::1');
INSERT INTO `sesion` VALUES ('234', 'Devs', '2015-07-01', '16:03:05', '::1');
INSERT INTO `sesion` VALUES ('235', 'LeticiaB', '2015-07-01', '16:03:22', '::1');
INSERT INTO `sesion` VALUES ('236', 'Devs', '2015-07-01', '16:06:26', '::1');
INSERT INTO `sesion` VALUES ('237', 'LeticiaB', '2015-07-01', '16:07:20', '::1');
INSERT INTO `sesion` VALUES ('238', 'Devs', '2015-07-01', '16:07:36', '::1');
INSERT INTO `sesion` VALUES ('239', 'InnovaTe', '2015-07-01', '16:08:02', '::1');
INSERT INTO `sesion` VALUES ('240', 'MAD', '2015-07-01', '16:08:38', '::1');
INSERT INTO `sesion` VALUES ('241', 'NetSky', '2015-07-01', '16:09:10', '::1');
INSERT INTO `sesion` VALUES ('242', 'SAADS', '2015-07-01', '16:09:43', '::1');
INSERT INTO `sesion` VALUES ('243', 'SLOW', '2015-07-01', '16:10:18', '::1');
INSERT INTO `sesion` VALUES ('244', 'LeticiaB', '2015-07-01', '16:10:53', '::1');
INSERT INTO `sesion` VALUES ('245', 'Devs', '2015-07-01', '16:16:01', '::1');
INSERT INTO `sesion` VALUES ('246', 'LeticiaB', '2015-07-01', '16:16:18', '::1');
INSERT INTO `sesion` VALUES ('247', 'Devs', '2015-07-01', '16:30:34', '::1');
INSERT INTO `sesion` VALUES ('248', 'LeticiaB', '2015-07-01', '16:58:45', '::1');
INSERT INTO `sesion` VALUES ('249', 'InnovaTe', '2015-07-01', '16:59:14', '::1');
INSERT INTO `sesion` VALUES ('250', 'MAD', '2015-07-01', '17:23:06', '::1');
INSERT INTO `sesion` VALUES ('251', 'NetSky', '2015-07-01', '17:53:19', '::1');
INSERT INTO `sesion` VALUES ('252', 'LeticiaB', '2015-07-01', '18:01:26', '::1');
INSERT INTO `sesion` VALUES ('253', 'LeticiaB', '2015-07-01', '18:04:15', '::1');
INSERT INTO `sesion` VALUES ('254', 'SAADS', '2015-07-01', '18:04:31', '::1');
INSERT INTO `sesion` VALUES ('255', 'LeticiaB', '2015-07-01', '18:30:09', '::1');
INSERT INTO `sesion` VALUES ('256', 'SLOW', '2015-07-01', '18:46:52', '::1');
INSERT INTO `sesion` VALUES ('257', 'LeticiaB', '2015-07-01', '18:53:50', '::1');
INSERT INTO `sesion` VALUES ('258', 'Devs', '2015-07-01', '18:54:51', '::1');
INSERT INTO `sesion` VALUES ('259', 'LeticiaB', '2015-07-01', '18:55:20', '::1');
INSERT INTO `sesion` VALUES ('260', 'InnovaTe', '2015-07-02', '19:15:09', '::1');
INSERT INTO `sesion` VALUES ('261', 'InnovaTe', '2015-07-03', '10:23:32', '::1');
INSERT INTO `sesion` VALUES ('262', 'LeticiaB', '2015-07-03', '10:24:21', '::1');
INSERT INTO `sesion` VALUES ('263', 'LeticiaB', '2015-07-03', '11:05:23', '::1');
INSERT INTO `sesion` VALUES ('264', 'LeticiaB', '2015-07-03', '12:26:26', '::1');
INSERT INTO `sesion` VALUES ('265', 'InnovaTe', '2015-07-03', '12:27:33', '::1');
INSERT INTO `sesion` VALUES ('266', 'LeticiaB', '2015-07-05', '23:04:46', '127.0.0.1');
INSERT INTO `sesion` VALUES ('267', 'InnovaTe', '2015-07-05', '23:05:00', '127.0.0.1');
INSERT INTO `sesion` VALUES ('268', 'LeticiaB', '2015-07-05', '23:07:55', '127.0.0.1');
INSERT INTO `sesion` VALUES ('269', 'InnovaTe', '2015-07-05', '23:10:16', '127.0.0.1');
INSERT INTO `sesion` VALUES ('270', 'LeticiaB', '2015-07-05', '23:12:02', '127.0.0.1');
INSERT INTO `sesion` VALUES ('271', 'InnovaTe', '2015-07-05', '23:14:08', '127.0.0.1');
INSERT INTO `sesion` VALUES ('272', 'LeticiaB', '2015-07-06', '11:32:11', '127.0.0.1');
INSERT INTO `sesion` VALUES ('273', 'Admin1', '2015-07-06', '12:13:05', '127.0.0.1');
INSERT INTO `sesion` VALUES ('274', 'InnovaTe', '2015-07-06', '12:19:03', '127.0.0.1');
INSERT INTO `sesion` VALUES ('275', 'Aska', '2015-07-06', '12:34:48', '127.0.0.1');
INSERT INTO `sesion` VALUES ('276', 'LeticiaB', '2015-07-06', '12:35:14', '127.0.0.1');
INSERT INTO `sesion` VALUES ('277', 'LeticiaB', '2015-07-06', '12:38:31', '127.0.0.1');
INSERT INTO `sesion` VALUES ('278', 'InnovaTe', '2015-07-06', '12:41:35', '127.0.0.1');
INSERT INTO `sesion` VALUES ('279', 'MAD', '2015-07-06', '12:43:27', '127.0.0.1');
INSERT INTO `sesion` VALUES ('280', 'Devs', '2015-07-06', '12:46:06', '127.0.0.1');
INSERT INTO `sesion` VALUES ('281', 'MAD', '2015-07-06', '12:47:47', '127.0.0.1');
INSERT INTO `sesion` VALUES ('282', 'LeticiaB', '2015-07-06', '12:49:26', '127.0.0.1');
INSERT INTO `sesion` VALUES ('283', 'Aska', '2015-07-06', '13:10:56', '127.0.0.1');
INSERT INTO `sesion` VALUES ('284', 'LeticiaB', '2015-07-06', '13:11:40', '127.0.0.1');
INSERT INTO `sesion` VALUES ('285', 'InnovaTe', '2015-07-06', '13:16:25', '127.0.0.1');
INSERT INTO `sesion` VALUES ('286', 'LeticiaB', '2015-07-06', '13:31:11', '127.0.0.1');
INSERT INTO `sesion` VALUES ('287', 'Admin1', '2015-07-06', '13:32:17', '127.0.0.1');
INSERT INTO `sesion` VALUES ('288', 'LeticiaB', '2015-07-06', '13:36:41', '127.0.0.1');
INSERT INTO `sesion` VALUES ('289', 'LeticiaB', '2015-07-06', '14:56:27', '127.0.0.1');
INSERT INTO `sesion` VALUES ('290', 'Admin1', '2015-07-06', '15:01:25', '127.0.0.1');
INSERT INTO `sesion` VALUES ('291', 'Aska', '2015-07-06', '15:06:33', '127.0.0.1');
INSERT INTO `sesion` VALUES ('292', 'LeticiaB', '2015-07-06', '15:10:23', '127.0.0.1');
INSERT INTO `sesion` VALUES ('293', 'InnovaTe', '2015-07-06', '15:15:11', '127.0.0.1');
INSERT INTO `sesion` VALUES ('294', 'InnovaTe', '2015-07-06', '15:21:56', '127.0.0.1');
INSERT INTO `sesion` VALUES ('295', 'Devs', '2015-07-06', '15:24:36', '127.0.0.1');
INSERT INTO `sesion` VALUES ('296', 'Devs', '2015-07-06', '15:25:36', '127.0.0.1');
INSERT INTO `sesion` VALUES ('297', 'Admin1', '2015-07-06', '15:37:08', '127.0.0.1');
INSERT INTO `sesion` VALUES ('298', 'LeticiaB', '2015-07-06', '15:37:41', '127.0.0.1');
INSERT INTO `sesion` VALUES ('299', 'InnovaTe', '2015-07-06', '15:38:06', '127.0.0.1');
INSERT INTO `sesion` VALUES ('300', 'InnovaTe', '2015-07-06', '15:52:27', '127.0.0.1');
INSERT INTO `sesion` VALUES ('301', 'InnovaTe', '2015-07-13', '15:29:09', '127.0.0.1');
INSERT INTO `sesion` VALUES ('302', 'LeticiaB', '2015-07-13', '15:29:32', '127.0.0.1');

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
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=819;

-- ----------------------------
-- Records of socio
-- ----------------------------
INSERT INTO `socio` VALUES ('40', 'Devs', 'Vania Marisela ', 'Catorceno Carballo', null);
INSERT INTO `socio` VALUES ('41', 'Devs', 'Dan Joel', 'Canqui Aviles', null);
INSERT INTO `socio` VALUES ('42', 'Devs', 'Daniel', 'Rocha Perez', '');
INSERT INTO `socio` VALUES ('43', 'Devs', 'Denis', 'Vazques Flores', 'vasquez.w7@gmail.com');
INSERT INTO `socio` VALUES ('44', 'Devs', 'Diego Armando', 'Zambrana Arze', 'contacto@diegozambrana.com');
INSERT INTO `socio` VALUES ('45', 'InnovaTe', 'Antonio', 'Alurralde', 'teo.dev.bo@gmail.com');
INSERT INTO `socio` VALUES ('46', 'InnovaTe', 'Andreina', 'Cota', 'cotvyanghy@gmail.com');
INSERT INTO `socio` VALUES ('47', 'InnovaTe', 'Fernando', 'Gutierrez', 'fernando279@gmail.com');
INSERT INTO `socio` VALUES ('48', 'InnovaTe', 'Marcelo', 'Torrico', 'marcelo.torrico34@gmail.com');
INSERT INTO `socio` VALUES ('49', 'InnovaTe', 'Winder', 'Chiri', 'winder_hardik_19@gmail.com');
INSERT INTO `socio` VALUES ('50', 'MAD', 'Juan Manuel', 'Castro Arnez', null);
INSERT INTO `socio` VALUES ('51', 'MAD', 'Alison', 'Fernandez Blanco', null);
INSERT INTO `socio` VALUES ('52', 'MAD', 'Diego Gabriel', 'NuÃ±ez Duran', null);
INSERT INTO `socio` VALUES ('53', 'NetSky', 'Norman', 'Antezana Pinto', 'norman9_182@hotmail.com');
INSERT INTO `socio` VALUES ('54', 'NetSky', 'Dario Edson', 'Chacon Paichucama', 'eddarion6@gmail.com');
INSERT INTO `socio` VALUES ('55', 'NetSky', 'Erlinda', 'Chambi Manzano', 'lindacm18@hotmail.com');
INSERT INTO `socio` VALUES ('56', 'NetSky', 'Claudia Dolinda', 'Torrico', 'the_girls_happy_islove17@hotmail.com');
INSERT INTO `socio` VALUES ('57', 'NetSky', 'Ruben ', 'Villca Fernandez', 'ruben_wolf_9@hotmail.com');
INSERT INTO `socio` VALUES ('58', 'SAADS', 'Enrique Daniel ', 'Antezana Vargas', null);
INSERT INTO `socio` VALUES ('59', 'SAADS', 'Beimar E. ', 'Huarachi Mamani', null);
INSERT INTO `socio` VALUES ('60', 'SAADS', 'Jorge ', 'Avila Baldiviezo', null);
INSERT INTO `socio` VALUES ('61', 'SAADS', 'Kenji Gabriel ', 'Lozano Rosales', null);
INSERT INTO `socio` VALUES ('62', 'SLOW', 'Melisa Stefani', 'Carballo Valencia', null);
INSERT INTO `socio` VALUES ('63', 'SLOW', 'Cristhian', 'Lima Sarabia', null);
INSERT INTO `socio` VALUES ('64', 'SLOW', 'Santiago', 'Quiroga Turdera', null);
INSERT INTO `socio` VALUES ('65', 'SLOW', 'Rodrigo David', 'Rivera Ortega', null);
INSERT INTO `socio` VALUES ('66', 'Aska', 'Pablo', 'Guitierrez', 'pablo@gmail.com');
INSERT INTO `socio` VALUES ('67', 'Aska', 'Ricardo', 'Fuentes', 'ricardo@gmail.com');
INSERT INTO `socio` VALUES ('68', 'Aska', 'Lionel', 'Messi', 'lionel@gmail.com');

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
INSERT INTO `usuario` VALUES ('AiraSoft', 'Habilitado', 'fc03609dccb03ed065360c7672f13942', '65353545', 'airasoft@outlook.com');
INSERT INTO `usuario` VALUES ('Akira', 'Habilitado', 'e5f9cfc5526a5933366a943ae344110c', '4564646', 'akira@gmail.com');
INSERT INTO `usuario` VALUES ('Altec', 'Habilitado', '3509fe2708b1d6c4f92e32187d2c19d0', '73722777', 'altec@hotmail.com');
INSERT INTO `usuario` VALUES ('ANDE', 'Habilitado', '73f6d4c77463ff99f74523490bf5d18f', '4454574', 'andesoft@outlook.com');
INSERT INTO `usuario` VALUES ('ANKA', 'Habilitado', 'f6bc2d991dc97bc61729d639e7302efc', '76868763', 'ankasoft@hotmail.com');
INSERT INTO `usuario` VALUES ('Answer', 'Habilitado', '5016a78bc8eec05c82f049deb8f48ccb', '4666734', 'answer@hotmail.com');
INSERT INTO `usuario` VALUES ('Aracorp', 'Habilitado', '92eeb9010bcc6fa962d0dd6ea55729ed', '64343437', 'aracorp@hotmail.com');
INSERT INTO `usuario` VALUES ('ARGOS', 'Habilitado', 'da06de41f4e5c7c64394439f7d103ad1', '4343545', 'argos.srl@gmail.com');
INSERT INTO `usuario` VALUES ('Arkano', 'Habilitado', 'd87b0418cd506677986e7a3ae41b2c54', '4233322', 'arkano@arkanos.com');
INSERT INTO `usuario` VALUES ('Aska', 'Habilitado', '3bb23cff49551b3eca19e9240f725080', '4443443', 'aska@gmail.com');
INSERT INTO `usuario` VALUES ('ASSI', 'Habilitado', '4d999b1200f60196f2c921a9f49563a1', '74242324', 'asii@outlook.com');
INSERT INTO `usuario` VALUES ('Corina', 'Deshabilitado', '83175e301fe440e2fa85463a987037ba', '4241122', 'corina@hotmail.com');
INSERT INTO `usuario` VALUES ('David', 'Deshabilitado', '0076fa0d70724c52f22a82f7ed3f5e23', '4443321', 'davides@gmail.com');
INSERT INTO `usuario` VALUES ('Devs', 'Habilitado', '1c9c37e7922d4b506d53bb1fcc7ed107', '67451583', 'devsgroup@outlookl.com');
INSERT INTO `usuario` VALUES ('InnovaTe', 'Habilitado', 'b505ee29745ce8d9fc12fa8af65df9b0', '70751815', 'contacto@innovate.dev.bo');
INSERT INTO `usuario` VALUES ('LeticiaB', 'Habilitado', '1fec3b9b292b7c95d5287012c1ea3052', '4440099', 'leticia@gmail.com');
INSERT INTO `usuario` VALUES ('MAD', 'Habilitado', 'ade8b436f8f320a38a157e56c048a114', '69438193', 'mad.software.srl@gmail.com');
INSERT INTO `usuario` VALUES ('MarcoA', 'Deshabilitado', '0c7895d527f7680d6a715fc6a47a720e', '4440099', 'marcoantonio@hotmail.com');
INSERT INTO `usuario` VALUES ('NetSky', 'Habilitado', '6cc63f8b72596e177a372949437dee50', '79735925', 'netskysystemsrl@outlook.com');
INSERT INTO `usuario` VALUES ('Patricia', 'Habilitado', '1f08de3d6b9e572ba8f5da4c1dd2c30d', '4298765', 'patricia@hotmail.com');
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
INSERT INTO `usuario_rol` VALUES ('AiraSoft', 'grupoEmpresa');
INSERT INTO `usuario_rol` VALUES ('Akira', 'grupoEmpresa');
INSERT INTO `usuario_rol` VALUES ('Altec', 'grupoEmpresa');
INSERT INTO `usuario_rol` VALUES ('ANDE', 'grupoEmpresa');
INSERT INTO `usuario_rol` VALUES ('ANKA', 'grupoEmpresa');
INSERT INTO `usuario_rol` VALUES ('Answer', 'grupoEmpresa');
INSERT INTO `usuario_rol` VALUES ('Aracorp', 'grupoEmpresa');
INSERT INTO `usuario_rol` VALUES ('ARGOS', 'grupoEmpresa');
INSERT INTO `usuario_rol` VALUES ('Arkano', 'grupoEmpresa');
INSERT INTO `usuario_rol` VALUES ('Aska', 'grupoEmpresa');
INSERT INTO `usuario_rol` VALUES ('ASSI', 'grupoEmpresa');
INSERT INTO `usuario_rol` VALUES ('Devs', 'grupoEmpresa');
INSERT INTO `usuario_rol` VALUES ('InnovaTe', 'grupoEmpresa');
INSERT INTO `usuario_rol` VALUES ('MAD', 'grupoEmpresa');
INSERT INTO `usuario_rol` VALUES ('NetSky', 'grupoEmpresa');
INSERT INTO `usuario_rol` VALUES ('SAADS', 'grupoEmpresa');
INSERT INTO `usuario_rol` VALUES ('SLOW', 'grupoEmpresa');

-- ----------------------------
-- Procedure structure for `insert_gestion`
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
END;;
DELIMITER ;

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
CREATE PROCEDURE `insert_socio`(in n_u varchar(25), nombre varchar(25) , apellido varchar(25),corr varchar(50))
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
