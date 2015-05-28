-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-05-2015 a las 16:04:12
-- Versión del servidor: 5.6.24
-- Versión de PHP: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `saetis`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_gestion`(in gestion varchar(25), f_ini date, f_fin date)
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
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_socio`(in n_u varchar(25), nombre varchar(25) , apellido varchar(25))
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
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `registro_administrador`(in nom varchar(25), ape varchar(25), nom_u varchar(25), telef integer, passwd varchar(25), email varchar(50))
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

   INSERT INTO usuario VALUES(nom_u,'Habilitado',MD5(passwd),telef,email); 
   INSERT INTO usuario_rol VALUES(nom_u,'administrador');  
   INSERT INTO administrador VALUES (nom_u,nom,ape);
  
  SELECT "Se registro correctamente" as mensaje;

  END CASE;
  
  END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `registro_grupo_empresa`(in nom_u varchar(25), telef integer, passwd varchar(25), email varchar(50), direcc varchar(25),nge_largo varchar(25),nge_corto varchar(25))
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

  INSERT INTO usuario VALUES (nom_u,'Habilitado',MD5(passwd),telef,email);

  INSERT INTO grupo_empresa VALUES (nom_u,nge_corto, nge_largo,direcc,"",5);

  INSERT INTO usuario_rol VALUES (nom_u,'grupoEmpresa');
  
  SELECT "Se registro correctamente" as mensaje;
  END CASE;
  
  END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `registro_usuario`(in nom varchar(25), ape varchar(25), nom_u varchar(25), telef integer, passwd varchar(25), email varchar(50), rol varchar(25))
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

   INSERT INTO usuario VALUES(nom_u,'Deshabilitado',MD5(passwd),telef,email); 
   INSERT INTO asesor VALUES(nom_u,nom,ape);  
   INSERT INTO usuario_rol VALUES(nom_u,rol);  
   INSERT INTO criteriocalificacion(NOMBRE_U,NOMBRE_CRITERIO_C,TIPO_CRITERIO) VALUES(nom_u,'PUNTAJE','4');
  
  SELECT "Se registro correctamente" as mensaje;

  END CASE;
  
  END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE IF NOT EXISTS `administrador` (
  `NOMBRE_U` varchar(50) NOT NULL,
  `NOMBRES_AD` varchar(45) NOT NULL,
  `APELLIDOS_AD` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`NOMBRE_U`, `NOMBRES_AD`, `APELLIDOS_AD`) VALUES
('Admin1', 'Ivan', 'Morales'),
('Admin2', 'Joaquin ', 'Rodriguez');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aplicacion`
--

CREATE TABLE IF NOT EXISTS `aplicacion` (
  `APLICACION_A` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asesor`
--

CREATE TABLE IF NOT EXISTS `asesor` (
  `NOMBRE_U` varchar(50) NOT NULL,
  `NOMBRES_A` varchar(50) NOT NULL,
  `APELLIDOS_A` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=4096;

--
-- Volcado de datos para la tabla `asesor`
--

INSERT INTO `asesor` (`NOMBRE_U`, `NOMBRES_A`, `APELLIDOS_A`) VALUES
('Corina', 'Corina', 'Flores Villarroel'),
('David', 'David', 'Escalera Fernandez'),
('LeticiaB', 'Leticia', 'Blanco Coca'),
('MarcoA', 'Marco Antonio', 'Montecinos Choque'),
('Patricia', 'Patricia', 'Rodriguez Bilbao');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignacion`
--

CREATE TABLE IF NOT EXISTS `asignacion` (
  `ID_R` int(11) NOT NULL,
  `EMISOR_A` varchar(30) NOT NULL,
  `RECEPTOR_A` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE IF NOT EXISTS `asistencia` (
  `ID_R` int(11) NOT NULL,
  `CODIGO_SOCIO_A` int(11) NOT NULL,
  `ASISTENCIA_A` tinyint(1) NOT NULL,
  `LICENCIA_A` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia_semanal`
--

CREATE TABLE IF NOT EXISTS `asistencia_semanal` (
  `ID_AS` int(11) NOT NULL,
  `ID_R` int(11) NOT NULL,
  `GRUPO_AS` varchar(25) NOT NULL,
  `CODIGO_SOCIO_AS` int(11) NOT NULL,
  `ASISTENCIA_AS` tinyint(1) NOT NULL,
  `LICENCIA_AS` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE IF NOT EXISTS `comentarios` (
  `ID_C` int(11) NOT NULL,
  `NOMBRE_U` varchar(50) NOT NULL,
  `ID_N` int(11) NOT NULL,
  `COMENTARIO` text NOT NULL,
  `FECHA_C` datetime NOT NULL,
  `AUTOR_C` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`ID_C`, `NOMBRE_U`, `ID_N`, `COMENTARIO`, `FECHA_C`, `AUTOR_C`) VALUES
(1, 'LeticiaB', 2, 'Leer PTIS<br>', '2015-03-28 20:36:42', 'Patricia'),
(2, 'Oasis', 3, 'Que parte de que proyecto?<br>', '2015-03-28 20:50:23', 'LeticiaB');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `criteriocalificacion`
--

CREATE TABLE IF NOT EXISTS `criteriocalificacion` (
  `ID_CRITERIO_C` int(11) NOT NULL,
  `NOMBRE_U` varchar(50) NOT NULL,
  `NOMBRE_CRITERIO_C` varchar(45) NOT NULL,
  `TIPO_CRITERIO` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `criteriocalificacion`
--

INSERT INTO `criteriocalificacion` (`ID_CRITERIO_C`, `NOMBRE_U`, `NOMBRE_CRITERIO_C`, `TIPO_CRITERIO`) VALUES
(6, 'LeticiaB', 'A(100)B(80)C(60)D(30)', 1),
(7, 'LeticiaB', 'Verdadero(100)Falso(50)', 2),
(8, 'LeticiaB', 'Excelente(100)Bueno(80)Regular(50)Malo(30)Pes', 1),
(9, 'LeticiaB', 'Si(80)No(20)', 3),
(10, 'LeticiaB', 'Si(90)No(20)', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `criterio_evaluacion`
--

CREATE TABLE IF NOT EXISTS `criterio_evaluacion` (
  `ID_CRITERIO_E` int(11) NOT NULL,
  `NOMBRE_U` varchar(50) NOT NULL,
  `NOMBRE_CRITERIO_E` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `criterio_evaluacion`
--

INSERT INTO `criterio_evaluacion` (`ID_CRITERIO_E`, `NOMBRE_U`, `NOMBRE_CRITERIO_E`) VALUES
(1, 'LeticiaB', 'Puntualidad'),
(2, 'LeticiaB', 'Cumplimiento'),
(3, 'LeticiaB', 'Organizacion\r\n');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `descripcion`
--

CREATE TABLE IF NOT EXISTS `descripcion` (
  `ID_R` int(11) NOT NULL,
  `DESCRIPCION_D` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=8192;

--
-- Volcado de datos para la tabla `descripcion`
--

INSERT INTO `descripcion` (`ID_R`, `DESCRIPCION_D`) VALUES
(66, 'Descripcion'),
(67, 'Descripcionn'),
(68, '<b>Ya salio la convocatoria....</b> CPETIS<br>'),
(69, 'Leer el pdf de liderazgo.<br>'),
(72, 'Notificacion de Conformidad'),
(83, 'Contrato'),
(84, 'Parte R Descripicion'),
(86, 'Orden de Cambio'),
(88, 'Notificacion de Conformidad'),
(95, 'el documento contiene las partes A y B que deberan ser presentados..........'),
(96, 'Entregar toda la documentacion'),
(97, 'E'),
(100, 'En este documento......'),
(113, 'Orden de Cambio'),
(114, 'Orden de Cambio'),
(115, 'Orden de Cambio'),
(116, 'Orden de Cambio'),
(117, 'Orden de Cambio'),
(118, 'Orden de Cambio'),
(121, 'Notificacion de Conformidad'),
(122, 'Notificacion de Conformidad'),
(123, 'Notificacion de Conformidad'),
(124, 'Notificacion de Conformidad'),
(125, 'Notificacion de Conformidad'),
(126, 'Notificacion de Conformidad'),
(169, 'Contrato'),
(200, 'Contrato'),
(201, 'Contrato'),
(202, 'Contrato'),
(203, 'Contrato'),
(204, 'Contrato');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documento`
--

CREATE TABLE IF NOT EXISTS `documento` (
  `ID_D` int(11) NOT NULL,
  `ID_R` int(11) NOT NULL,
  `TAMANIO_D` int(11) NOT NULL,
  `RUTA_D` varchar(100) NOT NULL,
  `VISUALIZABLE_D` tinyint(1) NOT NULL,
  `DESCARGABLE_D` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `documento`
--

INSERT INTO `documento` (`ID_D`, `ID_R`, `TAMANIO_D`, `RUTA_D`, `VISUALIZABLE_D`, `DESCARGABLE_D`) VALUES
(27, 98, 1024, '/Repositorio/asesor/CPTIS.pdf', 1, 1),
(28, 99, 1024, '/Repositorio/asesor/FETIS.pdf', 1, 1),
(29, 100, 1024, 'http://bittle.cs.umss.edu.bo/Repositorio/asesor/CPTIS.pdf', 0, 0),
(30, 101, 964992, '/Repositorio/SLOW/ParteA_SLOWCODE.pdf', 1, 1),
(31, 102, 925210, '/Repositorio/SLOW/ParteB_SLOWCODE.pdf', 1, 1),
(32, 103, 1447698, '/Repositorio/InnovaTe/ParteA_Innovate.pdf', 1, 1),
(33, 104, 1327903, '/Repositorio/InnovaTe/ParteB_InnovaTe.pdf', 1, 1),
(34, 105, 32441, '/Repositorio/SAADS/ActaConstitucion.docx', 1, 1),
(35, 106, 265360, '/Repositorio/SAADS/PropuestaTecnica.docx', 1, 1),
(36, 107, 676307, '/Repositorio/NetSky/ParteA_NetSky.pdf', 1, 1),
(37, 108, 804432, '/Repositorio/NetSky/ParteB_NetSky.pdf', 1, 1),
(38, 109, 639524, '/Repositorio/MAD/ActaDeConstitucion.pdf', 1, 1),
(39, 110, 720426, '/Repositorio/MAD/PropuestaTecnica.pdf', 1, 1),
(40, 111, 607194, '/Repositorio/Devs/DevsGroup_ParteA.pdf', 1, 1),
(41, 112, 1584338, '/Repositorio/Devs/DevsGroup_parteB.pdf', 1, 1),
(42, 113, 1024, '../Repositorio/Devs/OC/OrdenCambio.pdf', 0, 0),
(43, 114, 1024, '../Repositorio/InnovaTe/OC/OrdenCambio.pdf', 0, 0),
(44, 115, 1024, '../Repositorio/MAD/OC/OrdenCambio.pdf', 0, 0),
(45, 116, 1024, '../Repositorio/NetSky/OC/OrdenCambio.pdf', 0, 0),
(46, 117, 1024, '../Repositorio/SAADS/OC/OrdenCambio.pdf', 0, 0),
(47, 118, 1024, '../Repositorio/SLOW/OC/OrdenCambio.pdf', 0, 0),
(48, 121, 1024, '../Repositorio/Devs/NC/NotificacionConformidad.pdf', 0, 0),
(49, 122, 1024, '../Repositorio/InnovaTe/NC/NotificacionConformidad.pdf', 0, 0),
(50, 123, 1024, '../Repositorio/MAD/NC/NotificacionConformidad.pdf', 0, 0),
(51, 124, 1024, '../Repositorio/NetSky/NC/NotificacionConformidad.pdf', 0, 0),
(52, 125, 1024, '../Repositorio/SAADS/NC/NotificacionConformidad.pdf', 0, 0),
(53, 126, 1024, '../Repositorio/SLOW/NC/NotificacionConformidad.pdf', 0, 0),
(54, 169, 1024, '../Repositorio/LeticiaB/Contratos/ContratoNetSky.pdf', 0, 0),
(55, 200, 1024, '../Repositorio/LeticiaB/Contratos/ContratoSAADS.pdf', 0, 0),
(56, 201, 1024, '../Repositorio/LeticiaB/Contratos/ContratoSLOWCODE.pdf', 0, 0),
(57, 202, 1024, '../Repositorio/LeticiaB/Contratos/ContratoDevsGroup.pdf', 0, 0),
(58, 203, 1024, '../Repositorio/LeticiaB/Contratos/ContratoMAD.pdf', 0, 0),
(59, 204, 1024, '../Repositorio/LeticiaB/Contratos/ContratoInnovaTe.pdf', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documento_r`
--

CREATE TABLE IF NOT EXISTS `documento_r` (
  `ID_R` int(11) NOT NULL,
  `CODIGO_P` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `documento_r`
--

INSERT INTO `documento_r` (`ID_R`, `CODIGO_P`) VALUES
(96, 4),
(97, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrega`
--

CREATE TABLE IF NOT EXISTS `entrega` (
  `ID_R` int(11) NOT NULL,
  `ENTREGABLE_P` varchar(30) NOT NULL,
  `ENTREGADO_P` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `entrega`
--

INSERT INTO `entrega` (`ID_R`, `ENTREGABLE_P`, `ENTREGADO_P`) VALUES
(165, 'documentaciÃ³n', 0),
(166, 'documentaciÃ³n', 0),
(167, 'documentaciÃ³n', 0),
(168, 'documentaciÃ³n', 0),
(170, 'Documento', 0),
(171, 'Informe', 0),
(172, 'Informe', 0),
(173, 'Informe', 0),
(174, 'Informe', 0),
(175, 'Informe', 0),
(176, 'Informe', 0),
(177, 'Informe', 0),
(178, 'Documento', 1),
(179, 'Informe', 1),
(180, 'Informe', 1),
(181, 'Informe', 1),
(182, 'Informe', 1),
(183, 'Informe', 1),
(184, 'Informe', 0),
(185, 'Informe', 0),
(186, 'Documento', 0),
(187, 'Documento', 0),
(188, 'Documento', 0),
(189, 'Documento', 0),
(190, 'Documento', 0),
(191, 'Documento', 0),
(192, 'Documento', 0),
(192, 'Informe', 0),
(193, 'Informe', 0),
(194, 'Informe', 0),
(195, 'Informe', 0),
(196, 'Informe', 0),
(197, 'Informe', 0),
(198, 'Informe', 0),
(199, 'Informe', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entregable`
--

CREATE TABLE IF NOT EXISTS `entregable` (
  `NOMBRE_U` varchar(50) NOT NULL,
  `ENTREGABLE_E` char(30) NOT NULL,
  `DESCRIPCION_E` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `entregable`
--

INSERT INTO `entregable` (`NOMBRE_U`, `ENTREGABLE_E`, `DESCRIPCION_E`) VALUES
('Devs', 'Documento', 'Documento del contrato'),
('Devs', 'Informe', 'Informe sobre el estado del proyecto'),
('InnovaTe', 'CD', 'Ultima versiÃ³n del cÃ³digo fuente'),
('InnovaTe', 'Informe', 'DescripciÃ³n del sistema actual'),
('MAD', 'Documento', 'Documento de evaluaciÃ³n y pruebas'),
('MAD', 'Informe', 'Informe QC'),
('NetSky', 'documentaciÃ³n', 'Protocolo de validaciÃ³n'),
('SAADS', 'Informe', 'descripciÃ³n del sistema actual'),
('SLOW', 'Documento', 'Protocolo de validaciÃ³n de los Sprint'),
('SLOW', 'Informe', 'Informe de la iteraciÃ³n');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE IF NOT EXISTS `estado` (
  `ESTADO_E` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=8192;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`ESTADO_E`) VALUES
('asistencia registrada'),
('Deshabilitado'),
('en proceso'),
('Habilitado'),
('planificacion registrada'),
('registrar costo total proyecto'),
('registrar entregables'),
('registrar plan pagos'),
('registrar planificacion'),
('seguimiento registrado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluacion`
--

CREATE TABLE IF NOT EXISTS `evaluacion` (
  `ID_R` int(11) NOT NULL,
  `ID_E` bigint(20) unsigned NOT NULL,
  `NOTA_E` int(11) NOT NULL,
  `PORCENTAJE` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `evaluacion`
--

INSERT INTO `evaluacion` (`ID_R`, `ID_E`, `NOTA_E`, `PORCENTAJE`) VALUES
(120, 1, 16, 20),
(159, 2, 4, 5),
(160, 3, 3, 5),
(161, 4, 11, 20),
(162, 5, 13, 20),
(163, 6, 9, 20),
(164, 7, 7, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fecha_realizacion`
--

CREATE TABLE IF NOT EXISTS `fecha_realizacion` (
  `ID_R` int(11) NOT NULL,
  `FECHA_FR` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `fecha_realizacion`
--

INSERT INTO `fecha_realizacion` (`ID_R`, `FECHA_FR`) VALUES
(119, '2015-03-28'),
(120, '2015-04-01'),
(127, '2015-03-27'),
(128, '2015-03-27'),
(129, '2015-04-26'),
(130, '2015-04-02'),
(131, '2015-04-16'),
(132, '2015-04-30'),
(133, '2015-05-14'),
(134, '2015-06-05'),
(135, '2015-06-15'),
(136, '2015-03-26'),
(137, '2015-03-26'),
(138, '2015-03-26'),
(139, '2015-03-16'),
(140, '2015-03-30'),
(141, '2015-04-03'),
(142, '2015-04-17'),
(143, '2015-05-01'),
(144, '2015-05-15'),
(145, '2015-05-29'),
(146, '2015-06-12'),
(147, '2015-03-27'),
(148, '2016-04-10'),
(149, '2015-04-24'),
(150, '2015-05-08'),
(151, '2015-05-22'),
(152, '2015-06-05'),
(153, '2015-06-12'),
(154, '2015-06-19'),
(155, '2015-03-30'),
(156, '2015-04-17'),
(157, '2015-05-16'),
(158, '2015-06-17'),
(159, '2015-03-27'),
(160, '2015-04-03'),
(161, '2015-03-17'),
(162, '2015-05-01'),
(163, '2015-05-15'),
(164, '2015-05-29'),
(165, '0000-00-00'),
(166, '0000-00-00'),
(167, '0000-00-00'),
(168, '0000-00-00'),
(170, '0000-00-00'),
(171, '0000-00-00'),
(172, '0000-00-00'),
(173, '0000-00-00'),
(174, '0000-00-00'),
(175, '0000-00-00'),
(176, '0000-00-00'),
(177, '0000-00-00'),
(178, '0000-00-00'),
(179, '0000-00-00'),
(180, '0000-00-00'),
(181, '0000-00-00'),
(182, '0000-00-00'),
(183, '0000-00-00'),
(184, '0000-00-00'),
(185, '0000-00-00'),
(186, '0000-00-00'),
(187, '0000-00-00'),
(188, '0000-00-00'),
(189, '0000-00-00'),
(190, '0000-00-00'),
(191, '0000-00-00'),
(192, '0000-00-00'),
(193, '0000-00-00'),
(194, '0000-00-00'),
(195, '0000-00-00'),
(196, '0000-00-00'),
(197, '0000-00-00'),
(198, '0000-00-00'),
(199, '0000-00-00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formulario`
--

CREATE TABLE IF NOT EXISTS `formulario` (
  `ID_FORM` int(11) NOT NULL,
  `NOMBRE_U` varchar(50) NOT NULL,
  `NOMBRE_FORM` varchar(45) NOT NULL,
  `ESTADO_FORM` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `formulario`
--

INSERT INTO `formulario` (`ID_FORM`, `NOMBRE_U`, `NOMBRE_FORM`, `ESTADO_FORM`) VALUES
(3, 'LeticiaB', 'formulario1', 'Habilitado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `form_crit_e`
--

CREATE TABLE IF NOT EXISTS `form_crit_e` (
  `ID_FORM_CRIT_E` int(11) NOT NULL,
  `ID_FORM` int(11) NOT NULL,
  `ID_CRITERIO_E` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `form_crit_e`
--

INSERT INTO `form_crit_e` (`ID_FORM_CRIT_E`, `ID_FORM`, `ID_CRITERIO_E`) VALUES
(7, 3, 2),
(8, 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `from_crit_c`
--

CREATE TABLE IF NOT EXISTS `from_crit_c` (
  `ID_FORM_CRIT_C` int(11) NOT NULL,
  `ID_CRITERIO_C` int(11) NOT NULL,
  `ID_FORM` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `from_crit_c`
--

INSERT INTO `from_crit_c` (`ID_FORM_CRIT_C`, `ID_CRITERIO_C`, `ID_FORM`) VALUES
(5, 8, 3),
(6, 7, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gestion`
--

CREATE TABLE IF NOT EXISTS `gestion` (
  `ID_G` int(11) NOT NULL,
  `NOM_G` varchar(45) NOT NULL,
  `FECHA_INICIO_G` date NOT NULL,
  `FECHA_FIN_G` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=8192;

--
-- Volcado de datos para la tabla `gestion`
--

INSERT INTO `gestion` (`ID_G`, `NOM_G`, `FECHA_INICIO_G`, `FECHA_FIN_G`) VALUES
(1, 'I/2015', '2015-01-01', '2015-06-30'),
(8, 'I/2015', '2015-03-25', '2015-06-25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo_empresa`
--

CREATE TABLE IF NOT EXISTS `grupo_empresa` (
  `NOMBRE_U` varchar(50) NOT NULL,
  `NOMBRE_CORTO_GE` char(50) NOT NULL,
  `NOMBRE_LARGO_GE` varchar(50) NOT NULL,
  `DIRECCION_GE` varchar(50) NOT NULL,
  `REPRESENTANTE_LEGAL_GE` varchar(45) DEFAULT NULL,
  `NUM_SOCIOS` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=4096;

--
-- Volcado de datos para la tabla `grupo_empresa`
--

INSERT INTO `grupo_empresa` (`NOMBRE_U`, `NOMBRE_CORTO_GE`, `NOMBRE_LARGO_GE`, `DIRECCION_GE`, `REPRESENTANTE_LEGAL_GE`, `NUM_SOCIOS`) VALUES
('AgileA', 'Agile', 'AgileAction', 'Calle Agil', 'Nombre1 Apellido1', 5),
('AiraSoft', 'AiraSoft', 'AiraSoft SRL', 'ppppppppp', '', 5),
('Akira', 'Akira', 'Akira Soft', 'dfghjklhgfhkkhhg', '', 5),
('Altec', 'Altec', 'Experiencia y Alata Tecno', 'jnijnijjnjnn', '', 5),
('ANDE', 'ANDESOFT', 'ANDESOFT SRL', 'cbdwciwbcwb', '', 5),
('Angel', 'Angel Fire', 'Angel Fire SRL', 'xkcdbckk', '', 5),
('ANKA', 'ANKA SOFT', 'ANKA SOFT SRL', 'hvvhdov', '', 5),
('Answer', 'Answer', 'Answer SRL', 'usuhbcubus', '', 5),
('Aracorp', 'Aracorp', 'Aracorp SRL', 'bjdbvhbdvb', '', 5),
('ARGOS', 'ARGOS', 'ARGOS SRL', 'ivnfivnidfvndnv', '', 5),
('Arkano', 'Arkano', 'Arkano Soft', 'Av Santa Cruz', '', 5),
('Aska', 'Aska', 'Aska SRL', 'hbvhfdvhdbv', '', 5),
('ASSI', 'ASSI', 'ASSI SRL', 'shhjsbcsb', '', 5),
('Devs', 'Devs Group', 'DevsGroup SRL', 'Av.Ladislao Cabrera N°567', 'Vania Marisela Catorceno Carballo', 5),
('FreeValue', 'FreeValue', 'FreeValue SRL', 'Calle F', 'Oscar Gamboa Acho', 5),
('InnovaTe', 'InnovaTe', 'Innovando Tecnologia SRL', 'C. Tarija N°1520', 'Antonio Alurralde', 5),
('MAD', 'MAD', 'MAD SOFTWARE SRL', 'Av. Rodriguez Morales N&d', 'Juan Manuel Castro Arnez', 5),
('NetSky', 'NetSky', 'NetSky System SRL', 'Sipe Sipe Calle Gualberto', 'Ruben Villca FernÃ¡ndez', 5),
('SAADS', 'SAADS', 'SAADS SRL', 'Av. Melchor Perez #1312', 'Kenji Gabriel Lozano Rosales', 5),
('SLOW', 'SLOW CODE', 'SLOW CODE SRL', 'C/ Dario Monta&ntilde;o #', 'Rodrigo David Rivera Ortega', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `indicador`
--

CREATE TABLE IF NOT EXISTS `indicador` (
  `ID_INDICADOR` int(11) NOT NULL,
  `ID_CRITERIO_C` int(11) NOT NULL,
  `NOMBRE_INDICADOR` varchar(45) NOT NULL,
  `PUNTAJE_INDICADOR` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `indicador`
--

INSERT INTO `indicador` (`ID_INDICADOR`, `ID_CRITERIO_C`, `NOMBRE_INDICADOR`, `PUNTAJE_INDICADOR`) VALUES
(1, 6, 'A', 100),
(2, 6, 'B', 80),
(3, 6, 'C', 60),
(4, 6, 'D', 30),
(5, 7, 'Verdadero', 100),
(6, 7, 'Falso', 50),
(7, 8, 'Excelente', 100),
(8, 8, 'Bueno', 80),
(9, 8, 'Regular', 50),
(10, 8, 'Malo', 30),
(11, 8, 'Pesimo', 10),
(12, 9, 'Si', 80),
(13, 9, 'No', 20),
(14, 10, 'Si', 90),
(15, 10, 'No', 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripcion`
--

CREATE TABLE IF NOT EXISTS `inscripcion` (
  `NOMBRE_UA` varchar(50) NOT NULL,
  `NOMBRE_UGE` varchar(50) NOT NULL,
  `ESTADO_INSCRIPCION` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=4096;

--
-- Volcado de datos para la tabla `inscripcion`
--

INSERT INTO `inscripcion` (`NOMBRE_UA`, `NOMBRE_UGE`, `ESTADO_INSCRIPCION`) VALUES
('LeticiaB', 'Devs', 'Habilitado'),
('LeticiaB', 'InnovaTe', 'Habilitado'),
('LeticiaB', 'MAD', 'Habilitado'),
('LeticiaB', 'NetSky', 'Habilitado'),
('LeticiaB', 'SAADS', 'Habilitado'),
('LeticiaB', 'SLOW', 'Habilitado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripcion_proyecto`
--

CREATE TABLE IF NOT EXISTS `inscripcion_proyecto` (
  `CODIGO_P` int(11) NOT NULL,
  `NOMBRE_U` varchar(50) NOT NULL,
  `ESTADO_CONTRATO` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `inscripcion_proyecto`
--

INSERT INTO `inscripcion_proyecto` (`CODIGO_P`, `NOMBRE_U`, `ESTADO_CONTRATO`) VALUES
(4, 'Devs', 'Firmado'),
(4, 'InnovaTe', 'Firmado'),
(4, 'MAD', 'Firmado'),
(4, 'NetSky', 'Firmado'),
(4, 'SAADS', 'Firmado'),
(4, 'SLOW', 'Firmado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lista_ge`
--

CREATE TABLE IF NOT EXISTS `lista_ge` (
  `NOMBRE_CORTO` varchar(100) NOT NULL,
  `NOMBRE_LARGO` varchar(100) NOT NULL,
  `DIRECCION` varchar(100) NOT NULL,
  `REPRESENTANTE_LEGAL` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `lista_ge`
--

INSERT INTO `lista_ge` (`NOMBRE_CORTO`, `NOMBRE_LARGO`, `DIRECCION`, `REPRESENTANTE_LEGAL`) VALUES
('FreeValue', 'FreeValue SRL', 'Calle F', NULL),
('Oasis', 'Oasis SRL', 'Calle Jordan', NULL),
('Power', 'Power Soft SRL', 'Calle Power', NULL),
('Agile', 'AgileAction', 'Calle Agil', NULL),
('InnovaTe', 'Innovando Tecnologia SRL', 'C. Tarija N&deg;1520', NULL),
('Devs Group', 'DevsGroup SRL', 'Av.Ladislao Cabrera N&deg', NULL),
('MAD', 'MAD SOFTWARE SRL', 'Av. Rodriguez Morales N&d', NULL),
('SLOW CODE', 'SLOW CODE SRL', 'C/ Dario Monta&ntilde;o #', NULL),
('SAADS', 'SAADS SRL', 'Av. Melchor Perez #1312', NULL),
('NetSky', 'NetSky System SRL', 'Sipe Sipe Calle Gualberto', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensaje`
--

CREATE TABLE IF NOT EXISTS `mensaje` (
  `ID_R` int(11) NOT NULL,
  `ASUNTO_M` varchar(30) NOT NULL,
  `MENSAJE_M` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id_menu` int(11) NOT NULL,
  `nom_menu` varchar(45) NOT NULL,
  `url` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nota`
--

CREATE TABLE IF NOT EXISTS `nota` (
  `ID_N` int(11) NOT NULL,
  `ID_FORM` int(50) NOT NULL,
  `NOMBRE_U` varchar(50) NOT NULL,
  `CALIF_N` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `nota`
--

INSERT INTO `nota` (`ID_N`, `ID_FORM`, `NOMBRE_U`, `CALIF_N`) VALUES
(1, 3, 'MAD', 71);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nota_final`
--

CREATE TABLE IF NOT EXISTS `nota_final` (
  `ID_NF` int(11) NOT NULL,
  `NOMBRE_U` varchar(50) NOT NULL,
  `NOTA_F` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE IF NOT EXISTS `noticias` (
  `ID_N` int(11) NOT NULL,
  `NOMBRE_U` varchar(50) NOT NULL,
  `TITULO` text NOT NULL,
  `FECHA_N` datetime NOT NULL,
  `VIEWS` int(11) NOT NULL,
  `TEXTO` text NOT NULL,
  `POSTEADO` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `noticias`
--

INSERT INTO `noticias` (`ID_N`, `NOMBRE_U`, `TITULO`, `FECHA_N`, `VIEWS`, `TEXTO`, `POSTEADO`) VALUES
(2, 'LeticiaB', 'Entrega de Partes A y B', '2015-03-28 20:32:40', 5, 'Subir los documentos hasta la fecha indicada, cualquier duda por aca....<br>', 'LeticiaB'),
(3, 'Oasis', 'Dudas', '2015-03-28 20:37:07', 9, 'En la parte...<br>', 'Oasis'),
(4, 'SLOW', 'Parte A', '2015-05-26 07:43:26', 0, 'kdohvifvkdkfvds', 'SLOW');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago`
--

CREATE TABLE IF NOT EXISTS `pago` (
  `ID_R` int(11) NOT NULL,
  `MONTO_P` decimal(10,0) NOT NULL,
  `PORCENTAJE_DEL_TOTAL_P` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `pago`
--

INSERT INTO `pago` (`ID_R`, `MONTO_P`, `PORCENTAJE_DEL_TOTAL_P`) VALUES
(165, '11226', 15),
(166, '22452', 30),
(167, '26194', 35),
(168, '14968', 20),
(170, '13600', 20),
(171, '6800', 10),
(172, '6800', 10),
(173, '8160', 12),
(174, '8160', 12),
(175, '8160', 12),
(176, '9520', 14),
(177, '6800', 10),
(178, '24415', 20),
(179, '6104', 5),
(180, '6104', 5),
(181, '24415', 20),
(182, '24415', 20),
(183, '24415', 20),
(184, '12208', 10),
(185, '7944', 20),
(186, '3972', 10),
(187, '5958', 15),
(188, '5958', 15),
(189, '3972', 10),
(190, '3972', 10),
(191, '3972', 10),
(192, '3972', 10),
(193, '11976', 18),
(194, '11976', 18),
(195, '11976', 18),
(196, '11976', 18),
(197, '6653', 10),
(198, '3327', 5),
(199, '8649', 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periodo`
--

CREATE TABLE IF NOT EXISTS `periodo` (
  `ID_R` int(11) NOT NULL,
  `fecha_p` date NOT NULL,
  `hora_p` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `periodo`
--

INSERT INTO `periodo` (`ID_R`, `fecha_p`, `hora_p`) VALUES
(95, '2015-03-16', '08:00:00'),
(100, '2015-05-26', '06:58:00'),
(113, '2015-05-26', '14:14:28'),
(114, '2015-05-26', '14:14:35'),
(115, '2015-05-26', '14:14:44'),
(116, '2015-05-26', '14:14:55'),
(117, '2015-05-26', '15:15:23'),
(118, '2015-05-26', '15:15:26'),
(121, '2015-05-26', '16:16:11'),
(122, '2015-05-26', '16:16:13'),
(123, '2015-05-26', '16:16:14'),
(124, '2015-05-26', '16:16:15'),
(125, '2015-05-26', '16:16:16'),
(126, '2015-05-26', '16:16:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE IF NOT EXISTS `permisos` (
  `ROL_R` varchar(50) NOT NULL,
  `id_permiso` int(11) NOT NULL,
  `menu_id_menu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planificacion`
--

CREATE TABLE IF NOT EXISTS `planificacion` (
  `NOMBRE_U` varchar(50) NOT NULL,
  `ESTADO_E` varchar(50) NOT NULL,
  `FECHA_INICIO_P` date NOT NULL,
  `FECHA_FIN_P` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `planificacion`
--

INSERT INTO `planificacion` (`NOMBRE_U`, `ESTADO_E`, `FECHA_INICIO_P`, `FECHA_FIN_P`) VALUES
('Devs', 'planificacion registrada', '2015-03-16', '2015-06-19'),
('InnovaTe', 'planificacion registrada', '2015-03-16', '2015-06-19'),
('MAD', 'planificacion registrada', '2015-03-16', '2015-06-19'),
('NetSky', 'planificacion registrada', '2015-03-16', '2015-06-19'),
('SAADS', 'planificacion registrada', '2015-03-16', '2015-06-19'),
('SLOW', 'planificacion registrada', '2015-03-16', '2015-06-19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plazo`
--

CREATE TABLE IF NOT EXISTS `plazo` (
  `ID_R` int(11) NOT NULL,
  `FECHA_INICIO_PL` date NOT NULL,
  `FECHA_FIN_PL` date NOT NULL,
  `HORA_INICIO_PL` time NOT NULL,
  `HORA_FIN_PL` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=8192;

--
-- Volcado de datos para la tabla `plazo`
--

INSERT INTO `plazo` (`ID_R`, `FECHA_INICIO_PL`, `FECHA_FIN_PL`, `HORA_INICIO_PL`, `HORA_FIN_PL`) VALUES
(96, '2015-05-26', '2015-05-27', '07:55:00', '17:00:00'),
(97, '2015-05-26', '2015-05-27', '07:55:00', '17:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `precio`
--

CREATE TABLE IF NOT EXISTS `precio` (
  `NOMBRE_U` varchar(50) NOT NULL,
  `PRECIO_P` decimal(10,0) NOT NULL,
  `PORCENTAJE_A` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `precio`
--

INSERT INTO `precio` (`NOMBRE_U`, `PRECIO_P`, `PORCENTAJE_A`) VALUES
('Devs', '68000', 80),
('InnovaTe', '27370', 70),
('MAD', '122075', 70),
('NetSky', '74840', 75),
('SAADS', '66532', 70),
('SLOW', '39718', 75);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto`
--

CREATE TABLE IF NOT EXISTS `proyecto` (
  `CODIGO_P` int(11) NOT NULL,
  `ID_G` int(11) NOT NULL,
  `NOMBRE_P` varchar(50) NOT NULL,
  `DESCRIPCION_P` varchar(200) NOT NULL,
  `CONVOCATORIA` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=8192;

--
-- Volcado de datos para la tabla `proyecto`
--

INSERT INTO `proyecto` (`CODIGO_P`, `ID_G`, `NOMBRE_P`, `DESCRIPCION_P`, `CONVOCATORIA`) VALUES
(4, 1, 'SAETIS', 'Sistema de apoyo a la empresa TIS', 'CPTIS2015');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puntaje`
--

CREATE TABLE IF NOT EXISTS `puntaje` (
  `PUNTAJE_ID` int(11) NOT NULL,
  `ID_FORM` int(11) NOT NULL,
  `PUNTAJE` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `puntaje`
--

INSERT INTO `puntaje` (`PUNTAJE_ID`, `ID_FORM`, `PUNTAJE`) VALUES
(5, 3, 70),
(6, 3, 30);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puntaje_ge`
--

CREATE TABLE IF NOT EXISTS `puntaje_ge` (
  `ID_PGE` int(50) NOT NULL,
  `ID_N` int(50) NOT NULL,
  `NUM_CE` int(50) NOT NULL,
  `CALIFICACION` int(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `puntaje_ge`
--

INSERT INTO `puntaje_ge` (`ID_PGE`, `ID_N`, `NUM_CE`, `CALIFICACION`) VALUES
(1, 1, 0, 80),
(2, 1, 1, 50);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `receptor`
--

CREATE TABLE IF NOT EXISTS `receptor` (
  `ID_R` int(11) NOT NULL,
  `RECEPTOR_R` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `receptor`
--

INSERT INTO `receptor` (`ID_R`, `RECEPTOR_R`) VALUES
(95, 'Todas las Grupo Empresas'),
(100, 'Todas las Grupo Empresas'),
(113, 'DevsGroup SRL'),
(114, 'Innovando Tecnologia SRL'),
(115, 'MAD SOFTWARE SRL'),
(116, 'NetSky System SRL'),
(117, 'SAADS SRL'),
(118, 'SLOW CODE SRL'),
(121, 'DevsGroup SRL'),
(122, 'Innovando Tecnologia SRL'),
(123, 'MAD SOFTWARE SRL'),
(124, 'NetSky System SRL'),
(125, 'SAADS SRL'),
(126, 'SLOW CODE SRL'),
(169, 'NetSky System SRL'),
(200, 'SAADS SRL'),
(201, 'SLOW CODE SRL'),
(202, 'DevsGroup SRL'),
(203, 'MAD SOFTWARE SRL'),
(204, 'Innovando Tecnologia SRL');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro`
--

CREATE TABLE IF NOT EXISTS `registro` (
  `ID_R` int(11) NOT NULL,
  `NOMBRE_U` varchar(50) NOT NULL,
  `TIPO_T` varchar(50) NOT NULL,
  `ESTADO_E` varchar(50) NOT NULL,
  `NOMBRE_R` varchar(50) NOT NULL,
  `FECHA_R` date NOT NULL,
  `HORA_R` time NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=205 DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=8192;

--
-- Volcado de datos para la tabla `registro`
--

INSERT INTO `registro` (`ID_R`, `NOMBRE_U`, `TIPO_T`, `ESTADO_E`, `NOMBRE_R`, `FECHA_R`, `HORA_R`) VALUES
(94, 'LeticiaB', 'documento subido', 'Habilitado', 'CPTIS.PDF', '2015-05-25', '16:16:31'),
(95, 'LeticiaB', 'publicaciones', 'Habilitado', 'CPTIS', '2015-05-25', '23:23:44'),
(96, 'LeticiaB', 'documento requerido', 'Habilitado', 'Parte A', '2015-05-25', '18:04:41'),
(97, 'LeticiaB', 'documento requerido', 'Habilitado', 'Parte B', '2015-05-25', '18:29:56'),
(98, 'LeticiaB', 'documento subido', 'Habilitado', 'CPTIS.pdf', '2015-05-26', '07:07:47'),
(99, 'LeticiaB', 'documento subido', 'Habilitado', 'FETIS.pdf', '2015-05-26', '07:07:47'),
(100, 'LeticiaB', 'publicaciones', 'Habilitado', 'Partes A y B', '2015-05-26', '13:13:55'),
(101, 'SLOW', 'documento subido', 'habilitado', 'Parte A', '2015-05-26', '07:07:58'),
(102, 'SLOW', 'documento subido', 'habilitado', 'Parte B', '2015-05-26', '07:07:58'),
(103, 'InnovaTe', 'documento subido', 'habilitado', 'Parte A', '2015-05-26', '08:08:00'),
(104, 'InnovaTe', 'documento subido', 'habilitado', 'Parte B', '2015-05-26', '08:08:00'),
(105, 'SAADS', 'documento subido', 'habilitado', 'Parte A', '2015-05-26', '08:08:02'),
(106, 'SAADS', 'documento subido', 'habilitado', 'Parte B', '2015-05-26', '08:08:03'),
(107, 'NetSky', 'documento subido', 'habilitado', 'Parte A', '2015-05-26', '08:08:15'),
(108, 'NetSky', 'documento subido', 'habilitado', 'Parte B', '2015-05-26', '08:08:16'),
(109, 'MAD', 'documento subido', 'habilitado', 'Parte A', '2015-05-26', '08:08:18'),
(110, 'MAD', 'documento subido', 'habilitado', 'Parte B', '2015-05-26', '08:08:19'),
(111, 'Devs', 'documento subido', 'habilitado', 'Parte A', '2015-05-26', '08:08:20'),
(112, 'Devs', 'documento subido', 'habilitado', 'Parte B', '2015-05-26', '08:08:20'),
(113, 'LeticiaB', 'publicaciones', 'Habilitado', 'Orden de Cambio de Devs Group', '2015-05-26', '14:14:28'),
(114, 'LeticiaB', 'publicaciones', 'Habilitado', 'Orden de Cambio de InnovaTe', '2015-05-26', '14:14:35'),
(115, 'LeticiaB', 'publicaciones', 'Habilitado', 'Orden de Cambio de MAD', '2015-05-26', '14:14:44'),
(116, 'LeticiaB', 'publicaciones', 'Habilitado', 'Orden de Cambio de NetSky', '2015-05-26', '14:14:55'),
(117, 'LeticiaB', 'publicaciones', 'Habilitado', 'Orden de Cambio de SAADS', '2015-05-26', '15:15:23'),
(118, 'LeticiaB', 'publicaciones', 'Habilitado', 'Orden de Cambio de SLOW CODE', '2015-05-26', '15:15:26'),
(119, 'Devs', 'actividad planificacion', 'en proceso', 'GestiÃ³n del pryecto', '2015-05-26', '09:43:40'),
(120, 'MAD', 'actividad planificacion', 'en proceso', 'Firma de contrato', '2015-05-26', '10:06:09'),
(121, 'LeticiaB', 'publicaciones', 'Habilitado', 'Notificacion de Conformidad de Devs Group', '2015-05-26', '16:16:11'),
(122, 'LeticiaB', 'publicaciones', 'Habilitado', 'Notificacion de Conformidad de InnovaTe', '2015-05-26', '16:16:13'),
(123, 'LeticiaB', 'publicaciones', 'Habilitado', 'Notificacion de Conformidad de MAD', '2015-05-26', '16:16:14'),
(124, 'LeticiaB', 'publicaciones', 'Habilitado', 'Notificacion de Conformidad de NetSky', '2015-05-26', '16:16:15'),
(125, 'LeticiaB', 'publicaciones', 'Habilitado', 'Notificacion de Conformidad de SAADS', '2015-05-26', '16:16:16'),
(126, 'LeticiaB', 'publicaciones', 'Habilitado', 'Notificacion de Conformidad de SLOW CODE', '2015-05-26', '16:16:17'),
(127, 'Devs', 'actividad planificacion', 'en proceso', 'PlanificaciÃ³n', '2015-05-26', '11:35:33'),
(128, 'Devs', 'actividad planificacion', 'en proceso', 'Firma de contrato', '2015-05-26', '11:52:32'),
(129, 'Devs', 'actividad planificacion', 'en proceso', 'Sprint 0', '2015-05-26', '11:52:32'),
(130, 'Devs', 'actividad planificacion', 'en proceso', 'Sprint 1', '2015-05-26', '11:52:32'),
(131, 'Devs', 'actividad planificacion', 'en proceso', 'Sprint 2', '2015-05-26', '11:52:32'),
(132, 'Devs', 'actividad planificacion', 'en proceso', 'Sprint 3', '2015-05-26', '11:52:32'),
(133, 'Devs', 'actividad planificacion', 'en proceso', 'Sprint 4', '2015-05-26', '11:52:32'),
(134, 'Devs', 'actividad planificacion', 'en proceso', 'Sprint 5', '2015-05-26', '11:52:33'),
(135, 'Devs', 'actividad planificacion', 'en proceso', 'Sprint 6', '2015-05-26', '11:52:33'),
(136, 'InnovaTe', 'actividad planificacion', 'en proceso', 'Firma de contrato', '2015-05-26', '12:19:18'),
(137, 'InnovaTe', 'actividad planificacion', 'en proceso', 'firma de contrato', '2015-05-26', '12:33:23'),
(138, 'InnovaTe', 'actividad planificacion', 'en proceso', 'PlanificaciÃ³n', '2015-05-26', '12:51:32'),
(139, 'InnovaTe', 'actividad planificacion', 'en proceso', 'PlanificaciÃ³n', '2015-05-26', '12:57:35'),
(140, 'SAADS', 'actividad planificacion', 'en proceso', 'Sprint 0', '2015-05-26', '13:59:53'),
(141, 'SAADS', 'actividad planificacion', 'en proceso', 'Sprint 1', '2015-05-26', '13:59:53'),
(142, 'SAADS', 'actividad planificacion', 'en proceso', 'Sprint 2', '2015-05-26', '13:59:53'),
(143, 'SAADS', 'actividad planificacion', 'en proceso', 'Sprint 3', '2015-05-26', '13:59:53'),
(144, 'SAADS', 'actividad planificacion', 'en proceso', 'Sprint 4', '2015-05-26', '13:59:53'),
(145, 'SAADS', 'actividad planificacion', 'en proceso', 'Sprint 5', '2015-05-26', '13:59:53'),
(146, 'SAADS', 'actividad planificacion', 'en proceso', 'Sprint 6', '2015-05-26', '13:59:53'),
(147, 'SLOW', 'actividad planificacion', 'en proceso', 'EvaluaciÃ³n', '2015-05-26', '14:15:35'),
(148, 'SLOW', 'actividad planificacion', 'en proceso', 'Sprint 1', '2015-05-26', '14:15:36'),
(149, 'SLOW', 'actividad planificacion', 'en proceso', 'Sprint 2', '2015-05-26', '14:15:36'),
(150, 'SLOW', 'actividad planificacion', 'en proceso', 'Sprint 3', '2015-05-26', '14:15:36'),
(151, 'SLOW', 'actividad planificacion', 'en proceso', 'Sprint 4', '2015-05-26', '14:15:36'),
(152, 'SLOW', 'actividad planificacion', 'en proceso', 'Entrega ', '2015-05-26', '14:15:36'),
(153, 'SLOW', 'actividad planificacion', 'en proceso', 'capacitaciÃ³n', '2015-05-26', '14:15:36'),
(154, 'SLOW', 'actividad planificacion', 'en proceso', 'ConclusiÃ³n ', '2015-05-26', '14:15:36'),
(155, 'NetSky', 'actividad planificacion', 'en proceso', 'Sprint 1', '2015-05-26', '14:26:12'),
(156, 'NetSky', 'actividad planificacion', 'en proceso', 'Sprint 2', '2015-05-26', '14:26:12'),
(157, 'NetSky', 'actividad planificacion', 'en proceso', 'Sprint 3', '2015-05-26', '14:26:13'),
(158, 'NetSky', 'actividad planificacion', 'en proceso', 'CapacitaciÃ³n', '2015-05-26', '14:26:13'),
(159, 'MAD', 'actividad planificacion', 'en proceso', 'Sprint 1', '2015-05-26', '14:46:38'),
(160, 'MAD', 'actividad planificacion', 'en proceso', 'Sprint 2', '2015-05-26', '14:46:38'),
(161, 'MAD', 'actividad planificacion', 'en proceso', 'Sprint 3', '2015-05-26', '14:46:38'),
(162, 'MAD', 'actividad planificacion', 'en proceso', 'Sprint 4', '2015-05-26', '14:46:38'),
(163, 'MAD', 'actividad planificacion', 'en proceso', 'Sprint 5', '2015-05-26', '14:46:38'),
(164, 'MAD', 'actividad planificacion', 'en proceso', 'Sprint 6', '2015-05-26', '14:46:38'),
(165, 'NetSky', 'pago planificacion', 'en proceso', 'Sprint 1', '2015-05-26', '20:42:29'),
(166, 'NetSky', 'pago planificacion', 'en proceso', 'Sprint 2', '2015-05-26', '20:42:29'),
(167, 'NetSky', 'pago planificacion', 'en proceso', 'Sprint 3', '2015-05-26', '20:42:30'),
(168, 'NetSky', 'pago planificacion', 'en proceso', 'CapacitaciÃ³n', '2015-05-26', '20:42:30'),
(169, 'LeticiaB', 'Contrato', 'Habilitado', 'ContratoNetSky.pdf', '2015-05-27', '02:02:45'),
(170, 'Devs', 'pago planificacion', 'en proceso', 'Firma de contrato', '2015-05-26', '20:56:55'),
(171, 'Devs', 'pago planificacion', 'en proceso', 'Sprint 0', '2015-05-26', '20:56:55'),
(172, 'Devs', 'pago planificacion', 'en proceso', 'Sprint 1', '2015-05-26', '20:56:56'),
(173, 'Devs', 'pago planificacion', 'en proceso', 'Sprint 2', '2015-05-26', '20:56:56'),
(174, 'Devs', 'pago planificacion', 'en proceso', 'Sprint 3', '2015-05-26', '20:56:56'),
(175, 'Devs', 'pago planificacion', 'en proceso', 'Sprint 4', '2015-05-26', '20:56:56'),
(176, 'Devs', 'pago planificacion', 'en proceso', 'Sprint 5', '2015-05-26', '20:56:56'),
(177, 'Devs', 'pago planificacion', 'en proceso', 'Sprint 6', '2015-05-26', '20:56:57'),
(178, 'MAD', 'pago planificacion', 'en proceso', 'Firma de contrato', '2015-05-26', '21:10:18'),
(179, 'MAD', 'pago planificacion', 'en proceso', 'Sprint 1', '2015-05-26', '21:10:18'),
(180, 'MAD', 'pago planificacion', 'en proceso', 'Sprint 2', '2015-05-26', '21:10:18'),
(181, 'MAD', 'pago planificacion', 'en proceso', 'Sprint 3', '2015-05-26', '21:10:19'),
(182, 'MAD', 'pago planificacion', 'en proceso', 'Sprint 4', '2015-05-26', '21:10:19'),
(183, 'MAD', 'pago planificacion', 'en proceso', 'Sprint 5', '2015-05-26', '21:10:19'),
(184, 'MAD', 'pago planificacion', 'en proceso', 'Sprint 6', '2015-05-26', '21:10:19'),
(185, 'SLOW', 'pago planificacion', 'en proceso', 'EvaluaciÃ³n', '2015-05-26', '21:21:09'),
(186, 'SLOW', 'pago planificacion', 'en proceso', 'Sprint 1', '2015-05-26', '21:21:09'),
(187, 'SLOW', 'pago planificacion', 'en proceso', 'Sprint 2', '2015-05-26', '21:21:09'),
(188, 'SLOW', 'pago planificacion', 'en proceso', 'Sprint 3', '2015-05-26', '21:21:09'),
(189, 'SLOW', 'pago planificacion', 'en proceso', 'Sprint 4', '2015-05-26', '21:21:10'),
(190, 'SLOW', 'pago planificacion', 'en proceso', 'Entrega ', '2015-05-26', '21:21:10'),
(191, 'SLOW', 'pago planificacion', 'en proceso', 'capacitaciÃ³n', '2015-05-26', '21:21:10'),
(192, 'SLOW', 'pago planificacion', 'en proceso', 'ConclusiÃ³n ', '2015-05-26', '21:21:10'),
(193, 'SAADS', 'pago planificacion', 'en proceso', 'Sprint 0', '2015-05-26', '21:39:10'),
(194, 'SAADS', 'pago planificacion', 'en proceso', 'Sprint 1', '2015-05-26', '21:39:10'),
(195, 'SAADS', 'pago planificacion', 'en proceso', 'Sprint 2', '2015-05-26', '21:39:10'),
(196, 'SAADS', 'pago planificacion', 'en proceso', 'Sprint 3', '2015-05-26', '21:39:10'),
(197, 'SAADS', 'pago planificacion', 'en proceso', 'Sprint 4', '2015-05-26', '21:39:11'),
(198, 'SAADS', 'pago planificacion', 'en proceso', 'Sprint 5', '2015-05-26', '21:39:11'),
(199, 'SAADS', 'pago planificacion', 'en proceso', 'Sprint 6', '2015-05-26', '21:39:11'),
(200, 'LeticiaB', 'Contrato', 'Habilitado', 'ContratoSAADS.pdf', '2015-05-27', '04:04:00'),
(201, 'LeticiaB', 'Contrato', 'Habilitado', 'ContratoSLOWCODE.pdf', '2015-05-27', '04:04:00'),
(202, 'LeticiaB', 'Contrato', 'Habilitado', 'ContratoDevsGroup.pdf', '2015-05-27', '04:04:00'),
(203, 'LeticiaB', 'Contrato', 'Habilitado', 'ContratoMAD.pdf', '2015-05-27', '04:04:01'),
(204, 'LeticiaB', 'Contrato', 'Habilitado', 'ContratoInnovaTe.pdf', '2015-05-27', '04:04:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reporte`
--

CREATE TABLE IF NOT EXISTS `reporte` (
  `ID_R` int(11) NOT NULL,
  `ROL_RR` varchar(50) NOT NULL,
  `ACTIVIDAD_R` varchar(100) NOT NULL,
  `HECHO_R` tinyint(1) NOT NULL,
  `RESULTADO_R` varchar(200) NOT NULL,
  `CONCLUSION_R` varchar(200) NOT NULL,
  `OBSERVACION_R` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE IF NOT EXISTS `rol` (
  `ROL_R` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`ROL_R`) VALUES
('administrador'),
('asesor'),
('grupoEmpresa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_aplicacion`
--

CREATE TABLE IF NOT EXISTS `rol_aplicacion` (
  `ROL_R` varchar(50) NOT NULL,
  `APLICACION_A` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_reporte`
--

CREATE TABLE IF NOT EXISTS `rol_reporte` (
  `ROL_RR` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `rol_reporte`
--

INSERT INTO `rol_reporte` (`ROL_RR`) VALUES
('asesor'),
('cliente'),
('jefe de proyecto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguimiento`
--

CREATE TABLE IF NOT EXISTS `seguimiento` (
  `ID_S` int(5) NOT NULL,
  `ID_R` int(11) NOT NULL,
  `ROL_S` varchar(50) NOT NULL,
  `GRUPO_S` varchar(20) NOT NULL,
  `ACTIVIDAD_S` varchar(100) NOT NULL,
  `HECHO_S` tinyint(1) NOT NULL,
  `RESULTADO_S` varchar(200) NOT NULL,
  `CONCLUSION_S` varchar(200) NOT NULL,
  `OBSERVACION_S` varchar(200) NOT NULL,
  `FECHA_S` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sesion`
--

CREATE TABLE IF NOT EXISTS `sesion` (
  `ID_S` int(11) NOT NULL,
  `NOMBRE_U` varchar(50) NOT NULL,
  `FECHA_S` date NOT NULL,
  `HORA_S` time NOT NULL,
  `IP_S` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=226 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sesion`
--

INSERT INTO `sesion` (`ID_S`, `NOMBRE_U`, `FECHA_S`, `HORA_S`, `IP_S`) VALUES
(124, 'LeticiaB', '2015-05-25', '10:02:21', '::1'),
(125, 'InnovaTe', '2015-05-25', '11:13:38', '::1'),
(126, 'LeticiaB', '2015-05-25', '11:21:58', '::1'),
(127, 'InnovaTe', '2015-05-25', '11:24:18', '::1'),
(128, 'LeticiaB', '2015-05-25', '11:30:26', '::1'),
(129, 'SAADS', '2015-05-25', '11:45:05', '::1'),
(130, 'SLOW', '2015-05-25', '11:48:12', '::1'),
(131, 'LeticiaB', '2015-05-25', '11:53:13', '::1'),
(132, 'InnovaTe', '2015-05-26', '12:00:03', '::1'),
(133, 'LeticiaB', '2015-05-26', '12:00:54', '::1'),
(134, 'InnovaTe', '2015-05-26', '12:07:15', '::1'),
(135, 'LeticiaB', '2015-05-26', '12:08:26', '::1'),
(136, 'InnovaTe', '2015-05-26', '12:10:45', '::1'),
(137, 'LeticiaB', '2015-05-26', '12:11:44', '::1'),
(138, 'InnovaTe', '2015-05-26', '12:17:06', '::1'),
(139, 'LeticiaB', '2015-05-26', '12:22:42', '::1'),
(140, 'InnovaTe', '2015-05-26', '12:32:01', '::1'),
(141, 'SAADS', '2015-05-26', '12:34:56', '::1'),
(142, 'LeticiaB', '2015-05-26', '12:36:02', '::1'),
(143, 'SAADS', '2015-05-26', '12:38:31', '::1'),
(144, 'Admin1', '2015-05-26', '12:53:14', '::1'),
(145, 'LeticiaB', '2015-05-26', '12:58:07', '::1'),
(146, 'LeticiaB', '2015-05-26', '01:05:18', '::1'),
(147, 'LeticiaB', '2015-05-26', '01:14:35', '::1'),
(148, 'Camaleon', '2015-05-26', '01:15:20', '::1'),
(149, 'LeticiaB', '2015-05-26', '01:18:20', '::1'),
(150, 'LeticiaB', '2015-05-26', '01:30:51', '::1'),
(151, 'LeticiaB', '2015-05-26', '01:32:17', '::1'),
(152, 'InnovaTe', '2015-05-26', '01:36:34', '::1'),
(153, 'Admin1', '2015-05-26', '01:38:17', '::1'),
(154, 'LeticiaB', '2015-05-26', '01:40:50', '::1'),
(155, 'SLOW', '2015-05-26', '01:41:58', '::1'),
(156, 'LeticiaB', '2015-05-26', '01:44:27', '::1'),
(157, 'SLOW', '2015-05-26', '01:51:24', '::1'),
(158, 'LeticiaB', '2015-05-26', '01:52:14', '::1'),
(159, 'SLOW', '2015-05-26', '01:55:56', '::1'),
(160, 'InnovaTe', '2015-05-26', '01:59:41', '::1'),
(161, 'SAADS', '2015-05-26', '02:00:45', '::1'),
(162, 'NetSky', '2015-05-26', '02:08:35', '::1'),
(163, 'LeticiaB', '2015-05-26', '02:09:27', '::1'),
(164, 'NetSky', '2015-05-26', '02:10:38', '::1'),
(165, 'MAD', '2015-05-26', '02:11:33', '::1'),
(166, 'InnovaTe', '2015-05-26', '02:12:19', '::1'),
(167, 'LeticiaB', '2015-05-26', '02:12:40', '::1'),
(168, 'NetSky', '2015-05-26', '02:15:13', '::1'),
(169, 'MAD', '2015-05-26', '02:17:03', '::1'),
(170, 'Devs', '2015-05-26', '02:19:50', '::1'),
(171, 'LeticiaB', '2015-05-26', '02:22:40', '::1'),
(172, 'Devs', '2015-05-26', '02:50:22', '::1'),
(173, 'LeticiaB', '2015-05-26', '02:51:34', '::1'),
(174, 'Devs', '2015-05-26', '03:27:30', '::1'),
(175, 'LeticiaB', '2015-05-26', '03:30:29', '::1'),
(176, 'Devs', '2015-05-26', '03:32:56', '::1'),
(177, 'Devs', '2015-05-26', '03:44:16', '::1'),
(178, 'InnovaTe', '2015-05-26', '03:53:13', '::1'),
(179, 'LeticiaB', '2015-05-26', '03:56:10', '::1'),
(180, 'InnovaTe', '2015-05-26', '03:57:14', '::1'),
(181, 'MAD', '2015-05-26', '03:58:15', '::1'),
(182, 'LeticiaB', '2015-05-26', '04:08:25', '::1'),
(183, 'Devs', '2015-05-26', '04:18:51', '::1'),
(184, 'LeticiaB', '2015-05-26', '04:48:17', '::1'),
(185, 'Devs', '2015-05-26', '04:48:52', '::1'),
(186, 'MAD', '2015-05-26', '05:30:02', '::1'),
(187, 'Devs', '2015-05-26', '05:31:16', '::1'),
(188, 'Devs', '2015-05-26', '05:37:21', '::1'),
(189, 'LeticiaB', '2015-05-26', '05:59:27', '::1'),
(190, 'Devs', '2015-05-26', '06:00:59', '::1'),
(191, 'InnovaTe', '2015-05-26', '06:03:30', '::1'),
(192, 'LeticiaB', '2015-05-26', '06:12:40', '::1'),
(193, 'InnovaTe', '2015-05-26', '06:13:49', '::1'),
(194, 'LeticiaB', '2015-05-26', '06:15:35', '::1'),
(195, 'InnovaTe', '2015-05-26', '06:16:40', '::1'),
(196, 'LeticiaB', '2015-05-26', '06:27:30', '::1'),
(197, 'InnovaTe', '2015-05-26', '06:28:38', '::1'),
(198, 'InnovaTe', '2015-05-26', '06:56:31', '::1'),
(199, 'Devs', '2015-05-26', '07:23:29', '::1'),
(200, 'LeticiaB', '2015-05-26', '07:37:18', '::1'),
(201, 'InnovaTe', '2015-05-26', '07:46:13', '::1'),
(202, 'SAADS', '2015-05-26', '07:46:52', '::1'),
(203, 'LeticiaB', '2015-05-26', '08:02:42', '::1'),
(204, 'SLOW', '2015-05-26', '08:03:32', '::1'),
(205, 'LeticiaB', '2015-05-26', '08:15:56', '::1'),
(206, 'NetSky', '2015-05-26', '08:16:51', '::1'),
(207, 'LeticiaB', '2015-05-26', '08:26:34', '::1'),
(208, 'MAD', '2015-05-26', '08:29:16', '::1'),
(209, 'LeticiaB', '2015-05-27', '01:41:11', '::1'),
(210, 'SAADS', '2015-05-27', '01:43:08', '::1'),
(211, 'LeticiaB', '2015-05-27', '02:10:12', '::1'),
(212, 'InnovaTe', '2015-05-27', '02:11:11', '::1'),
(213, 'Devs', '2015-05-27', '02:19:36', '::1'),
(214, 'NetSky', '2015-05-27', '02:34:10', '::1'),
(215, 'LeticiaB', '2015-05-27', '02:45:41', '::1'),
(216, 'NetSky', '2015-05-27', '02:49:19', '::1'),
(217, 'Devs', '2015-05-27', '02:50:06', '::1'),
(218, 'MAD', '2015-05-27', '03:00:50', '::1'),
(219, 'SLOW', '2015-05-27', '03:11:54', '::1'),
(220, 'SAADS', '2015-05-27', '03:25:12', '::1'),
(221, 'LeticiaB', '2015-05-27', '03:39:40', '::1'),
(222, 'LeticiaB', '2015-05-27', '03:59:50', '::1'),
(223, 'InnovaTe', '2015-05-27', '04:13:03', '::1'),
(224, 'LeticiaB', '2015-05-27', '04:26:32', '::1'),
(225, 'LeticiaB', '2015-05-27', '02:51:19', '::1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `socio`
--

CREATE TABLE IF NOT EXISTS `socio` (
  `CODIGO_S` int(11) NOT NULL,
  `NOMBRE_U` varchar(50) NOT NULL,
  `NOMBRES_S` varchar(50) NOT NULL,
  `APELLIDOS_S` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=819;

--
-- Volcado de datos para la tabla `socio`
--

INSERT INTO `socio` (`CODIGO_S`, `NOMBRE_U`, `NOMBRES_S`, `APELLIDOS_S`) VALUES
(40, 'Devs', 'Vania Marisela ', 'Catorceno Carballo'),
(41, 'Devs', 'Dan Joel', 'Canqui Aviles'),
(42, 'Devs', 'Daniel', 'Rocha Perez'),
(43, 'Devs', 'Denis', 'Vazques Flores'),
(44, 'Devs', 'Diego Armando', 'Zambrana Arze'),
(45, 'InnovaTe', 'Antonio', 'Alurralde'),
(46, 'InnovaTe', 'Andreina', 'Cota'),
(47, 'InnovaTe', 'Fernando', 'Gutierrez'),
(48, 'InnovaTe', 'Marcelo', 'Torrico'),
(49, 'InnovaTe', 'Winder', 'Chiri'),
(50, 'MAD', 'Juan Manuel', 'Castro Arnez'),
(51, 'MAD', 'Alison', 'Fernandez Blanco'),
(52, 'MAD', 'Diego Gabriel', 'Nuñez Duran'),
(53, 'NetSky', 'Norman', 'Antezana Pinto'),
(54, 'NetSky', 'Dario Edson', 'Chacon Paichucama'),
(55, 'NetSky', 'Erlinda', 'Chambi Manzano'),
(56, 'NetSky', 'Claudia Dolinda', 'Torrico'),
(57, 'NetSky', 'Ruben ', 'Villca Fernandez'),
(58, 'SAADS', 'Enrique Daniel ', 'Antezana Vargas'),
(59, 'SAADS', 'Beimar E. ', 'Huarachi Mamani'),
(60, 'SAADS', 'Jorge ', 'Avila Baldiviezo'),
(61, 'SAADS', 'Kenji Gabriel ', 'Lozano Rosales'),
(62, 'SLOW', 'Melisa Stefani', 'Carballo Valencia'),
(63, 'SLOW', 'Cristhian', 'Lima Sarabia'),
(64, 'SLOW', 'Santiago', 'Quiroga Turdera'),
(65, 'SLOW', 'Rodrigo David', 'Rivera Ortega');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo`
--

CREATE TABLE IF NOT EXISTS `tipo` (
  `TIPO_T` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=8192;

--
-- Volcado de datos para la tabla `tipo`
--

INSERT INTO `tipo` (`TIPO_T`) VALUES
('actividad planificacion'),
('asistencia'),
('Contrato'),
('criterio evaluacion'),
('documento requerido'),
('documento subido'),
('notificacion de conformidad'),
('Orden de Cambio'),
('pago planificacion'),
('publicaciones'),
('seguimiento');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `NOMBRE_U` varchar(50) NOT NULL,
  `ESTADO_E` varchar(50) NOT NULL,
  `PASSWORD_U` varchar(50) NOT NULL,
  `TELEFONO_U` varchar(8) NOT NULL,
  `CORREO_ELECTRONICO_U` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=2048;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`NOMBRE_U`, `ESTADO_E`, `PASSWORD_U`, `TELEFONO_U`, `CORREO_ELECTRONICO_U`) VALUES
('Admin1', 'Habilitado', 'dbb050cddf3a78fd6b861eb577d1f5dc', '4442336', 'adm.saetis@gmail.com'),
('Admin2', 'Habilitado', '62132d33742969b9b1db54e2d4145009', '4329092', 'joaquin@rodriguez.com'),
('ADSysCorp', 'Habilitado', 'dc5d00cea0d628067d7d5399102233eb', '71494555', 'adsyscorp@gmail.com'),
('AgileA', 'Habilitado', 'f4326bafda468fdca9511f4468cea9c9', '4443200', 'agile@action.com'),
('AiraSoft', 'Habilitado', 'fc03609dccb03ed065360c7672f13942', '65353545', 'airasoft@outlook.com'),
('Akira', 'Habilitado', 'e5f9cfc5526a5933366a943ae344110c', '4564646', 'akira@gmail.com'),
('Altec', 'Habilitado', '3509fe2708b1d6c4f92e32187d2c19d0', '73722777', 'altec@hotmail.com'),
('ANDE', 'Habilitado', '73f6d4c77463ff99f74523490bf5d18f', '4454574', 'andesoft@outlook.com'),
('Angel', 'Habilitado', 'f8878656e7d4b4c750fc4c94cee9a158', '76765754', 'angel.fire@outlook.com'),
('ANKA', 'Habilitado', 'f6bc2d991dc97bc61729d639e7302efc', '76868763', 'ankasoft@hotmail.com'),
('Answer', 'Habilitado', '5016a78bc8eec05c82f049deb8f48ccb', '4666734', 'answer@hotmail.com'),
('Aracorp', 'Habilitado', '92eeb9010bcc6fa962d0dd6ea55729ed', '64343437', 'aracorp@hotmail.com'),
('ARGOS', 'Habilitado', 'da06de41f4e5c7c64394439f7d103ad1', '4343545', 'argos.srl@gmail.com'),
('Arkano', 'Habilitado', 'd87b0418cd506677986e7a3ae41b2c54', '4233322', 'arkano@arkanos.com'),
('Aska', 'Habilitado', '3bb23cff49551b3eca19e9240f725080', '4443443', 'aska@gmail.com'),
('ASSI', 'Habilitado', '4d999b1200f60196f2c921a9f49563a1', '74242324', 'asii@outlook.com'),
('Camaleon', 'Habilitado', '88936961971d538e693935a6ffb40a20', '4442299', 'camaleon@soft.com'),
('Colective', 'Habilitado', 'b9becbb405f0fd5524071709a02b5330', '4432211', 'colectivo@virtual.com'),
('Corina', 'Deshabilitado', '83175e301fe440e2fa85463a987037ba', '4241122', 'corina@hotmail.com'),
('David', 'Deshabilitado', '0076fa0d70724c52f22a82f7ed3f5e23', '4443321', 'davides@gmail.com'),
('Devs', 'Habilitado', '1c9c37e7922d4b506d53bb1fcc7ed107', '67451583', 'devsgroup@outlookl.com'),
('FreeValue', 'Habilitado', 'f87f9d72ff9dfb09182cffa68762c2c8', '4329092', 'free@value.com'),
('InnovaTe', 'Habilitado', 'b505ee29745ce8d9fc12fa8af65df9b0', '70751815', 'contacto@innovate.dev.bo'),
('LeticiaB', 'Habilitado', '1fec3b9b292b7c95d5287012c1ea3052', '4440099', 'leticia@gmail.com'),
('MAD', 'Habilitado', 'ade8b436f8f320a38a157e56c048a114', '69438193', 'mad.software.srl@gmail.com'),
('MarcoA', 'Deshabilitado', '0c7895d527f7680d6a715fc6a47a720e', '4440099', 'marcoantonio@hotmail.com'),
('NetSky', 'Habilitado', '6cc63f8b72596e177a372949437dee50', '79735925', 'netskysystemsrl@outlook.com'),
('Oasis', 'Habilitado', 'c810a44fc32898ae6ab495d89510d75f', '4331222', 'oasis@oasis.com'),
('Patricia', 'Habilitado', '1f08de3d6b9e572ba8f5da4c1dd2c30d', '4298765', 'patricia@hotmail.com'),
('Power', 'Habilitado', '7a4f8e9647073ee9a5564f81cf3a1082', '4329090', 'power@power.com'),
('SAADS', 'Habilitado', 'f13b522e0c82cd0fa7c24c67436b8e69', '79967675', 'saadssoft@gmail.com'),
('SLOW', 'Habilitado', 'a73da1d7391398b7d7bf5e13d885fbda', '4251675', 'slow.code.srl@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_rol`
--

CREATE TABLE IF NOT EXISTS `usuario_rol` (
  `NOMBRE_U` varchar(50) NOT NULL,
  `ROL_R` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario_rol`
--

INSERT INTO `usuario_rol` (`NOMBRE_U`, `ROL_R`) VALUES
('Admin1', 'administrador'),
('Admin2', 'administrador'),
('Corina', 'asesor'),
('David', 'asesor'),
('LeticiaB', 'asesor'),
('MarcoA', 'asesor'),
('Patricia', 'asesor'),
('ADSysCorp', 'grupoEmpresa'),
('AgileA', 'grupoEmpresa'),
('AiraSoft', 'grupoEmpresa'),
('Akira', 'grupoEmpresa'),
('Altec', 'grupoEmpresa'),
('ANDE', 'grupoEmpresa'),
('Angel', 'grupoEmpresa'),
('ANKA', 'grupoEmpresa'),
('Answer', 'grupoEmpresa'),
('Aracorp', 'grupoEmpresa'),
('ARGOS', 'grupoEmpresa'),
('Arkano', 'grupoEmpresa'),
('Aska', 'grupoEmpresa'),
('ASSI', 'grupoEmpresa'),
('Camaleon', 'grupoEmpresa'),
('Colective', 'grupoEmpresa'),
('Devs', 'grupoEmpresa'),
('FreeValue', 'grupoEmpresa'),
('InnovaTe', 'grupoEmpresa'),
('MAD', 'grupoEmpresa'),
('NetSky', 'grupoEmpresa'),
('Oasis', 'grupoEmpresa'),
('Power', 'grupoEmpresa'),
('SAADS', 'grupoEmpresa'),
('SLOW', 'grupoEmpresa');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`NOMBRE_U`);

--
-- Indices de la tabla `aplicacion`
--
ALTER TABLE `aplicacion`
  ADD PRIMARY KEY (`APLICACION_A`) USING BTREE;

--
-- Indices de la tabla `asesor`
--
ALTER TABLE `asesor`
  ADD PRIMARY KEY (`NOMBRE_U`) USING BTREE;

--
-- Indices de la tabla `asignacion`
--
ALTER TABLE `asignacion`
  ADD PRIMARY KEY (`ID_R`) USING BTREE;

--
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD PRIMARY KEY (`ID_R`,`CODIGO_SOCIO_A`) USING BTREE;

--
-- Indices de la tabla `asistencia_semanal`
--
ALTER TABLE `asistencia_semanal`
  ADD PRIMARY KEY (`ID_AS`) USING BTREE, ADD KEY `FK_REGISTRO__ASISTENCIA_SEMANAL` (`ID_R`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`ID_C`,`NOMBRE_U`,`ID_N`), ADD KEY `fk_comentarios_noticias1_idx` (`ID_N`,`NOMBRE_U`);

--
-- Indices de la tabla `criteriocalificacion`
--
ALTER TABLE `criteriocalificacion`
  ADD PRIMARY KEY (`ID_CRITERIO_C`,`NOMBRE_U`), ADD KEY `fk_criterioCalificacion_asesor1_idx` (`NOMBRE_U`);

--
-- Indices de la tabla `criterio_evaluacion`
--
ALTER TABLE `criterio_evaluacion`
  ADD PRIMARY KEY (`ID_CRITERIO_E`,`NOMBRE_U`), ADD KEY `fk_criterio_evaluacion_asesor1_idx` (`NOMBRE_U`);

--
-- Indices de la tabla `descripcion`
--
ALTER TABLE `descripcion`
  ADD PRIMARY KEY (`ID_R`) USING BTREE;

--
-- Indices de la tabla `documento`
--
ALTER TABLE `documento`
  ADD PRIMARY KEY (`ID_D`) USING BTREE, ADD KEY `FK_REGISTRO_DOCUMENTO` (`ID_R`) USING BTREE;

--
-- Indices de la tabla `documento_r`
--
ALTER TABLE `documento_r`
  ADD PRIMARY KEY (`ID_R`);

--
-- Indices de la tabla `entrega`
--
ALTER TABLE `entrega`
  ADD PRIMARY KEY (`ID_R`,`ENTREGABLE_P`) USING BTREE;

--
-- Indices de la tabla `entregable`
--
ALTER TABLE `entregable`
  ADD PRIMARY KEY (`NOMBRE_U`,`ENTREGABLE_E`) USING BTREE;

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`ESTADO_E`) USING BTREE;

--
-- Indices de la tabla `evaluacion`
--
ALTER TABLE `evaluacion`
  ADD PRIMARY KEY (`ID_R`,`ID_E`) USING BTREE, ADD UNIQUE KEY `ID_E` (`ID_E`);

--
-- Indices de la tabla `fecha_realizacion`
--
ALTER TABLE `fecha_realizacion`
  ADD PRIMARY KEY (`ID_R`) USING BTREE;

--
-- Indices de la tabla `formulario`
--
ALTER TABLE `formulario`
  ADD PRIMARY KEY (`ID_FORM`,`NOMBRE_U`), ADD KEY `fk_formulario_asesor1_idx` (`NOMBRE_U`);

--
-- Indices de la tabla `form_crit_e`
--
ALTER TABLE `form_crit_e`
  ADD PRIMARY KEY (`ID_FORM_CRIT_E`), ADD KEY `fk_formulario_has_criterio_evaluacion_criterio_evaluacion1_idx` (`ID_CRITERIO_E`), ADD KEY `fk_formulario_has_criterio_evaluacion_formulario1_idx` (`ID_FORM`);

--
-- Indices de la tabla `from_crit_c`
--
ALTER TABLE `from_crit_c`
  ADD PRIMARY KEY (`ID_FORM_CRIT_C`), ADD KEY `fk_criterioCalificacion_has_formulario_formulario1_idx` (`ID_FORM`), ADD KEY `fk_criterioCalificacion_has_formulario_criterioCalificacion_idx` (`ID_CRITERIO_C`);

--
-- Indices de la tabla `gestion`
--
ALTER TABLE `gestion`
  ADD PRIMARY KEY (`ID_G`) USING BTREE;

--
-- Indices de la tabla `grupo_empresa`
--
ALTER TABLE `grupo_empresa`
  ADD PRIMARY KEY (`NOMBRE_U`) USING BTREE;

--
-- Indices de la tabla `indicador`
--
ALTER TABLE `indicador`
  ADD PRIMARY KEY (`ID_INDICADOR`,`ID_CRITERIO_C`), ADD KEY `fk_indicador_criterioCalificacion1_idx` (`ID_CRITERIO_C`);

--
-- Indices de la tabla `inscripcion`
--
ALTER TABLE `inscripcion`
  ADD PRIMARY KEY (`NOMBRE_UA`,`NOMBRE_UGE`) USING BTREE, ADD KEY `FK_ASESOR__INSCRIPCION` (`NOMBRE_UA`) USING BTREE, ADD KEY `FK_GRUPO_EMPRESA__INSCRIPCION` (`NOMBRE_UGE`);

--
-- Indices de la tabla `inscripcion_proyecto`
--
ALTER TABLE `inscripcion_proyecto`
  ADD PRIMARY KEY (`CODIGO_P`,`NOMBRE_U`), ADD KEY `fk_inscripcion_proyecto_proyecto1_idx` (`CODIGO_P`), ADD KEY `fk_inscripcion_proyecto_grupo_empresa1_idx` (`NOMBRE_U`);

--
-- Indices de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD PRIMARY KEY (`ID_R`) USING BTREE;

--
-- Indices de la tabla `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indices de la tabla `nota`
--
ALTER TABLE `nota`
  ADD PRIMARY KEY (`ID_N`,`NOMBRE_U`), ADD KEY `fk_nota_grupo_empresa1_idx` (`NOMBRE_U`), ADD KEY `fk_nota_formulario_idx` (`ID_FORM`);

--
-- Indices de la tabla `nota_final`
--
ALTER TABLE `nota_final`
  ADD PRIMARY KEY (`ID_NF`,`NOMBRE_U`), ADD KEY `fk_nota_final_grupo_empresa1_idx` (`NOMBRE_U`);

--
-- Indices de la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`ID_N`,`NOMBRE_U`), ADD KEY `fk_noticias_usuario1_idx` (`NOMBRE_U`);

--
-- Indices de la tabla `pago`
--
ALTER TABLE `pago`
  ADD PRIMARY KEY (`ID_R`) USING BTREE;

--
-- Indices de la tabla `periodo`
--
ALTER TABLE `periodo`
  ADD PRIMARY KEY (`ID_R`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id_permiso`), ADD KEY `fk_rol_has_menu_rol1_idx` (`ROL_R`), ADD KEY `fk_permisos_menu1_idx` (`menu_id_menu`);

--
-- Indices de la tabla `planificacion`
--
ALTER TABLE `planificacion`
  ADD PRIMARY KEY (`NOMBRE_U`) USING BTREE, ADD KEY `FK_ESTADO__PLANIFICACION` (`ESTADO_E`) USING BTREE;

--
-- Indices de la tabla `plazo`
--
ALTER TABLE `plazo`
  ADD PRIMARY KEY (`ID_R`) USING BTREE;

--
-- Indices de la tabla `precio`
--
ALTER TABLE `precio`
  ADD PRIMARY KEY (`NOMBRE_U`) USING BTREE;

--
-- Indices de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  ADD PRIMARY KEY (`CODIGO_P`,`ID_G`) USING BTREE, ADD KEY `fk_proyecto_gestion1_idx` (`ID_G`);

--
-- Indices de la tabla `puntaje`
--
ALTER TABLE `puntaje`
  ADD PRIMARY KEY (`PUNTAJE_ID`,`ID_FORM`), ADD KEY `fk_puntaje_formulario1_idx` (`ID_FORM`);

--
-- Indices de la tabla `puntaje_ge`
--
ALTER TABLE `puntaje_ge`
  ADD PRIMARY KEY (`ID_PGE`), ADD KEY `fk_ PUNTAJE_GE_nota_idx` (`ID_N`);

--
-- Indices de la tabla `receptor`
--
ALTER TABLE `receptor`
  ADD PRIMARY KEY (`ID_R`);

--
-- Indices de la tabla `registro`
--
ALTER TABLE `registro`
  ADD PRIMARY KEY (`ID_R`) USING BTREE, ADD KEY `FK_ESTADO__REGISTRO` (`ESTADO_E`) USING BTREE, ADD KEY `FK_TIPO__REGISTRO` (`TIPO_T`) USING BTREE, ADD KEY `FK_USUARIO_REGISTRO` (`NOMBRE_U`) USING BTREE;

--
-- Indices de la tabla `reporte`
--
ALTER TABLE `reporte`
  ADD PRIMARY KEY (`ID_R`,`ROL_RR`) USING BTREE, ADD KEY `FK_ROL_REPORTE__REPORTE` (`ROL_RR`) USING BTREE;

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`ROL_R`) USING BTREE;

--
-- Indices de la tabla `rol_aplicacion`
--
ALTER TABLE `rol_aplicacion`
  ADD PRIMARY KEY (`ROL_R`,`APLICACION_A`) USING BTREE, ADD KEY `FK_APLICACION__ROL_APLICACION` (`APLICACION_A`) USING BTREE;

--
-- Indices de la tabla `rol_reporte`
--
ALTER TABLE `rol_reporte`
  ADD PRIMARY KEY (`ROL_RR`) USING BTREE;

--
-- Indices de la tabla `seguimiento`
--
ALTER TABLE `seguimiento`
  ADD PRIMARY KEY (`ID_S`) USING BTREE, ADD KEY `FK_ROL_REPORTE__REPORTE` (`ROL_S`) USING BTREE, ADD KEY `FK_REGISTRO__SEGUIMIENTO` (`ID_R`);

--
-- Indices de la tabla `sesion`
--
ALTER TABLE `sesion`
  ADD PRIMARY KEY (`ID_S`) USING BTREE, ADD KEY `FK_USUARIO_SESION` (`NOMBRE_U`) USING BTREE;

--
-- Indices de la tabla `socio`
--
ALTER TABLE `socio`
  ADD PRIMARY KEY (`CODIGO_S`) USING BTREE, ADD KEY `FK_GRUPO_EMPRESA__SOCIO` (`NOMBRE_U`) USING BTREE;

--
-- Indices de la tabla `tipo`
--
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`TIPO_T`) USING BTREE;

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`NOMBRE_U`) USING BTREE, ADD KEY `FK_ESTADO__USUARIO` (`ESTADO_E`) USING BTREE;

--
-- Indices de la tabla `usuario_rol`
--
ALTER TABLE `usuario_rol`
  ADD PRIMARY KEY (`NOMBRE_U`,`ROL_R`) USING BTREE, ADD KEY `FK_ROL__USUARIO_ROL` (`ROL_R`) USING BTREE;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asistencia_semanal`
--
ALTER TABLE `asistencia_semanal`
  MODIFY `ID_AS` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `ID_C` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `criteriocalificacion`
--
ALTER TABLE `criteriocalificacion`
  MODIFY `ID_CRITERIO_C` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `criterio_evaluacion`
--
ALTER TABLE `criterio_evaluacion`
  MODIFY `ID_CRITERIO_E` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `documento`
--
ALTER TABLE `documento`
  MODIFY `ID_D` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT de la tabla `documento_r`
--
ALTER TABLE `documento_r`
  MODIFY `ID_R` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=98;
--
-- AUTO_INCREMENT de la tabla `evaluacion`
--
ALTER TABLE `evaluacion`
  MODIFY `ID_E` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `formulario`
--
ALTER TABLE `formulario`
  MODIFY `ID_FORM` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `form_crit_e`
--
ALTER TABLE `form_crit_e`
  MODIFY `ID_FORM_CRIT_E` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `from_crit_c`
--
ALTER TABLE `from_crit_c`
  MODIFY `ID_FORM_CRIT_C` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `gestion`
--
ALTER TABLE `gestion`
  MODIFY `ID_G` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `indicador`
--
ALTER TABLE `indicador`
  MODIFY `ID_INDICADOR` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `nota`
--
ALTER TABLE `nota`
  MODIFY `ID_N` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `nota_final`
--
ALTER TABLE `nota_final`
  MODIFY `ID_NF` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
  MODIFY `ID_N` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id_permiso` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  MODIFY `CODIGO_P` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `puntaje`
--
ALTER TABLE `puntaje`
  MODIFY `PUNTAJE_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `puntaje_ge`
--
ALTER TABLE `puntaje_ge`
  MODIFY `ID_PGE` int(50) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `registro`
--
ALTER TABLE `registro`
  MODIFY `ID_R` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=205;
--
-- AUTO_INCREMENT de la tabla `seguimiento`
--
ALTER TABLE `seguimiento`
  MODIFY `ID_S` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `sesion`
--
ALTER TABLE `sesion`
  MODIFY `ID_S` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=226;
--
-- AUTO_INCREMENT de la tabla `socio`
--
ALTER TABLE `socio`
  MODIFY `CODIGO_S` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=66;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `administrador`
--
ALTER TABLE `administrador`
ADD CONSTRAINT `fk_Administrador_usuario1` FOREIGN KEY (`NOMBRE_U`) REFERENCES `usuario` (`NOMBRE_U`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `asesor`
--
ALTER TABLE `asesor`
ADD CONSTRAINT `FK_USUARIO__ASESOR` FOREIGN KEY (`NOMBRE_U`) REFERENCES `usuario` (`NOMBRE_U`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `asignacion`
--
ALTER TABLE `asignacion`
ADD CONSTRAINT `FK_REGISTRO__ASIGNACION` FOREIGN KEY (`ID_R`) REFERENCES `registro` (`ID_R`);

--
-- Filtros para la tabla `asistencia`
--
ALTER TABLE `asistencia`
ADD CONSTRAINT `FK_REGISTRO__ASISTENCIA` FOREIGN KEY (`ID_R`) REFERENCES `registro` (`ID_R`);

--
-- Filtros para la tabla `asistencia_semanal`
--
ALTER TABLE `asistencia_semanal`
ADD CONSTRAINT `FK_REGISTRO__ASISTENCIA_SEMANAL` FOREIGN KEY (`ID_R`) REFERENCES `registro` (`ID_R`);

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
ADD CONSTRAINT `fk_comentarios_noticias1` FOREIGN KEY (`ID_N`, `NOMBRE_U`) REFERENCES `noticias` (`ID_N`, `NOMBRE_U`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `criteriocalificacion`
--
ALTER TABLE `criteriocalificacion`
ADD CONSTRAINT `fk_criterioCalificacion_asesor1` FOREIGN KEY (`NOMBRE_U`) REFERENCES `asesor` (`NOMBRE_U`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `criterio_evaluacion`
--
ALTER TABLE `criterio_evaluacion`
ADD CONSTRAINT `fk_criterio_evaluacion_asesor1` FOREIGN KEY (`NOMBRE_U`) REFERENCES `asesor` (`NOMBRE_U`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `documento`
--
ALTER TABLE `documento`
ADD CONSTRAINT `FK_REGISTRO_DOCUMENTO` FOREIGN KEY (`ID_R`) REFERENCES `registro` (`ID_R`);

--
-- Filtros para la tabla `entrega`
--
ALTER TABLE `entrega`
ADD CONSTRAINT `FK_REGISTRO__PRESENTACION` FOREIGN KEY (`ID_R`) REFERENCES `registro` (`ID_R`);

--
-- Filtros para la tabla `entregable`
--
ALTER TABLE `entregable`
ADD CONSTRAINT `FK_PLANIFICACION__ENTREGABLE` FOREIGN KEY (`NOMBRE_U`) REFERENCES `planificacion` (`NOMBRE_U`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `evaluacion`
--
ALTER TABLE `evaluacion`
ADD CONSTRAINT `FK_REGISTRO__EVALUACION` FOREIGN KEY (`ID_R`) REFERENCES `registro` (`ID_R`);

--
-- Filtros para la tabla `fecha_realizacion`
--
ALTER TABLE `fecha_realizacion`
ADD CONSTRAINT `FK_REGISTRO__FECHA_REALIZACION` FOREIGN KEY (`ID_R`) REFERENCES `registro` (`ID_R`);

--
-- Filtros para la tabla `formulario`
--
ALTER TABLE `formulario`
ADD CONSTRAINT `fk_formulario_asesor1` FOREIGN KEY (`NOMBRE_U`) REFERENCES `asesor` (`NOMBRE_U`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `form_crit_e`
--
ALTER TABLE `form_crit_e`
ADD CONSTRAINT `fk_formulario_has_criterio_evaluacion_criterio_evaluacion1` FOREIGN KEY (`ID_CRITERIO_E`) REFERENCES `criterio_evaluacion` (`ID_CRITERIO_E`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_formulario_has_criterio_evaluacion_formulario1` FOREIGN KEY (`ID_FORM`) REFERENCES `formulario` (`ID_FORM`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `from_crit_c`
--
ALTER TABLE `from_crit_c`
ADD CONSTRAINT `fk_criterioCalificacion_has_formulario_criterioCalificacion1` FOREIGN KEY (`ID_CRITERIO_C`) REFERENCES `criteriocalificacion` (`ID_CRITERIO_C`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_criterioCalificacion_has_formulario_formulario1` FOREIGN KEY (`ID_FORM`) REFERENCES `formulario` (`ID_FORM`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `grupo_empresa`
--
ALTER TABLE `grupo_empresa`
ADD CONSTRAINT `FK_USUARIO__GRUPO_EMPRESA` FOREIGN KEY (`NOMBRE_U`) REFERENCES `usuario` (`NOMBRE_U`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `indicador`
--
ALTER TABLE `indicador`
ADD CONSTRAINT `fk_indicador_criterioCalificacion1` FOREIGN KEY (`ID_CRITERIO_C`) REFERENCES `criteriocalificacion` (`ID_CRITERIO_C`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `inscripcion`
--
ALTER TABLE `inscripcion`
ADD CONSTRAINT `FK_ASESOR__INSCRIPCION` FOREIGN KEY (`NOMBRE_UA`) REFERENCES `asesor` (`NOMBRE_U`) ON UPDATE CASCADE,
ADD CONSTRAINT `FK_GRUPO_EMPRESA__INSCRIPCION` FOREIGN KEY (`NOMBRE_UGE`) REFERENCES `grupo_empresa` (`NOMBRE_U`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `inscripcion_proyecto`
--
ALTER TABLE `inscripcion_proyecto`
ADD CONSTRAINT `fk_inscripcion_proyecto_grupo_empresa1` FOREIGN KEY (`NOMBRE_U`) REFERENCES `grupo_empresa` (`NOMBRE_U`) ON UPDATE CASCADE,
ADD CONSTRAINT `fk_inscripcion_proyecto_proyecto1` FOREIGN KEY (`CODIGO_P`) REFERENCES `proyecto` (`CODIGO_P`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `mensaje`
--
ALTER TABLE `mensaje`
ADD CONSTRAINT `FK_REGISTRO__MENSAJE` FOREIGN KEY (`ID_R`) REFERENCES `registro` (`ID_R`);

--
-- Filtros para la tabla `nota`
--
ALTER TABLE `nota`
ADD CONSTRAINT `fk_nota_formulario` FOREIGN KEY (`ID_FORM`) REFERENCES `formulario` (`ID_FORM`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_nota_grupo_empresa1` FOREIGN KEY (`NOMBRE_U`) REFERENCES `grupo_empresa` (`NOMBRE_U`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `nota_final`
--
ALTER TABLE `nota_final`
ADD CONSTRAINT `fk_nota_final_grupo_empresa1` FOREIGN KEY (`NOMBRE_U`) REFERENCES `grupo_empresa` (`NOMBRE_U`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `noticias`
--
ALTER TABLE `noticias`
ADD CONSTRAINT `fk_noticias_usuario1` FOREIGN KEY (`NOMBRE_U`) REFERENCES `usuario` (`NOMBRE_U`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `pago`
--
ALTER TABLE `pago`
ADD CONSTRAINT `FK_REGISTRO__PAGO` FOREIGN KEY (`ID_R`) REFERENCES `registro` (`ID_R`);

--
-- Filtros para la tabla `periodo`
--
ALTER TABLE `periodo`
ADD CONSTRAINT `fk_periodo_registro1` FOREIGN KEY (`ID_R`) REFERENCES `registro` (`ID_R`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `permisos`
--
ALTER TABLE `permisos`
ADD CONSTRAINT `fk_permisos_menu1` FOREIGN KEY (`menu_id_menu`) REFERENCES `menu` (`id_menu`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `id_menu` FOREIGN KEY (`ROL_R`) REFERENCES `rol` (`ROL_R`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `planificacion`
--
ALTER TABLE `planificacion`
ADD CONSTRAINT `FK_ESTADO__PLANIFICACION` FOREIGN KEY (`ESTADO_E`) REFERENCES `estado` (`ESTADO_E`),
ADD CONSTRAINT `FK_GRUPO_EMPRESA__PLANIFICACION` FOREIGN KEY (`NOMBRE_U`) REFERENCES `grupo_empresa` (`NOMBRE_U`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `plazo`
--
ALTER TABLE `plazo`
ADD CONSTRAINT `FK_REGISTRO__PLAZO` FOREIGN KEY (`ID_R`) REFERENCES `registro` (`ID_R`);

--
-- Filtros para la tabla `precio`
--
ALTER TABLE `precio`
ADD CONSTRAINT `FK_PLANIFICACION__PRECIO` FOREIGN KEY (`NOMBRE_U`) REFERENCES `planificacion` (`NOMBRE_U`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `proyecto`
--
ALTER TABLE `proyecto`
ADD CONSTRAINT `fk_proyecto_gestion1` FOREIGN KEY (`ID_G`) REFERENCES `gestion` (`ID_G`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `puntaje`
--
ALTER TABLE `puntaje`
ADD CONSTRAINT `fk_puntaje_formulario1` FOREIGN KEY (`ID_FORM`) REFERENCES `formulario` (`ID_FORM`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `puntaje_ge`
--
ALTER TABLE `puntaje_ge`
ADD CONSTRAINT `fk_PUNTAJE_GE_nota` FOREIGN KEY (`ID_N`) REFERENCES `nota` (`ID_N`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `receptor`
--
ALTER TABLE `receptor`
ADD CONSTRAINT `fk_receptor_registro1` FOREIGN KEY (`ID_R`) REFERENCES `registro` (`ID_R`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `registro`
--
ALTER TABLE `registro`
ADD CONSTRAINT `FK_ESTADO__REGISTRO` FOREIGN KEY (`ESTADO_E`) REFERENCES `estado` (`ESTADO_E`),
ADD CONSTRAINT `FK_TIPO__REGISTRO` FOREIGN KEY (`TIPO_T`) REFERENCES `tipo` (`TIPO_T`),
ADD CONSTRAINT `FK_USUARIO_REGISTRO` FOREIGN KEY (`NOMBRE_U`) REFERENCES `usuario` (`NOMBRE_U`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `reporte`
--
ALTER TABLE `reporte`
ADD CONSTRAINT `FK_REGISTRO__REPORTE` FOREIGN KEY (`ID_R`) REFERENCES `registro` (`ID_R`),
ADD CONSTRAINT `FK_ROL_REPORTE__REPORTE` FOREIGN KEY (`ROL_RR`) REFERENCES `rol_reporte` (`ROL_RR`);

--
-- Filtros para la tabla `rol_aplicacion`
--
ALTER TABLE `rol_aplicacion`
ADD CONSTRAINT `FK_APLICACION__ROL_APLICACION` FOREIGN KEY (`APLICACION_A`) REFERENCES `aplicacion` (`APLICACION_A`),
ADD CONSTRAINT `FK_ROL__ROL_APLICACION` FOREIGN KEY (`ROL_R`) REFERENCES `rol` (`ROL_R`);

--
-- Filtros para la tabla `seguimiento`
--
ALTER TABLE `seguimiento`
ADD CONSTRAINT `FK_REGISTRO__SEGUIMIENTO` FOREIGN KEY (`ID_R`) REFERENCES `registro` (`ID_R`),
ADD CONSTRAINT `FK_ROL_REPORTE__SEGUIMIENTO` FOREIGN KEY (`ROL_S`) REFERENCES `rol_reporte` (`ROL_RR`);

--
-- Filtros para la tabla `sesion`
--
ALTER TABLE `sesion`
ADD CONSTRAINT `FK_USUARIO_SESION` FOREIGN KEY (`NOMBRE_U`) REFERENCES `usuario` (`NOMBRE_U`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `socio`
--
ALTER TABLE `socio`
ADD CONSTRAINT `FK_GRUPO_EMPRESA__SOCIO` FOREIGN KEY (`NOMBRE_U`) REFERENCES `grupo_empresa` (`NOMBRE_U`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
ADD CONSTRAINT `FK_ESTADO__USUARIO` FOREIGN KEY (`ESTADO_E`) REFERENCES `estado` (`ESTADO_E`);

--
-- Filtros para la tabla `usuario_rol`
--
ALTER TABLE `usuario_rol`
ADD CONSTRAINT `FK_ROL__USUARIO_ROL` FOREIGN KEY (`ROL_R`) REFERENCES `rol` (`ROL_R`),
ADD CONSTRAINT `FK_USUARIO__USUARIO_ROL` FOREIGN KEY (`NOMBRE_U`) REFERENCES `usuario` (`NOMBRE_U`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
