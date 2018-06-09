-- phpMyAdmin SQL Dump
-- version 4.3.8
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 16-08-2016 a las 20:47:18
-- Versión del servidor: 5.5.48-37.8
-- Versión de PHP: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `megachor_megachorizos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `AuthAssignment`
--

CREATE TABLE IF NOT EXISTS `AuthAssignment` (
  `itemname` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `userid` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `bizrule` text COLLATE utf8_unicode_ci,
  `data` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `AuthAssignment`
--

INSERT INTO `AuthAssignment` (`itemname`, `userid`, `bizrule`, `data`) VALUES
('admin', '1024582122', NULL, NULL),
('admin', 'admin', NULL, NULL),
('Admin1', '31', NULL, 's:2:"N;";'),
('Admin1', '33', NULL, 's:2:"N;";'),
('Admin1', 'jadmin', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `AuthItem`
--

CREATE TABLE IF NOT EXISTS `AuthItem` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `bizrule` text COLLATE utf8_unicode_ci,
  `data` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `AuthItem`
--

INSERT INTO `AuthItem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES
('admin', 2, '', NULL, NULL),
('Admin1', 0, NULL, NULL, NULL),
('despachos', 0, '', NULL, NULL),
('embutidor', 0, '', NULL, NULL),
('horneador', 0, '', NULL, NULL),
('liderarea', 0, '', NULL, NULL),
('mezclador', 0, '', NULL, NULL),
('recepcion', 0, '', NULL, NULL),
('recepcionista', 0, '', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `AuthItemChild`
--

CREATE TABLE IF NOT EXISTS `AuthItemChild` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `User`
--

CREATE TABLE IF NOT EXISTS `User` (
  `id` int(11) NOT NULL,
  `username` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(254) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nombres` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tipo_doc` int(11) DEFAULT NULL,
  `num_doc` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `typeUser` int(11) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estado` enum('0','1') COLLATE utf8_unicode_ci DEFAULT '1' COMMENT '0 = Inactivo\n1 = Activo'
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `User`
--

INSERT INTO `User` (`id`, `username`, `password`, `nombres`, `tipo_doc`, `num_doc`, `typeUser`, `email`, `estado`) VALUES
(22, 'jadmin', 'f09b67d2589465a9d35505b9549fde70', 'juanito', NULL, '', NULL, NULL, ''),
(23, 'admin', '123', 'Usuario Mega', NULL, '', NULL, NULL, '1'),
(27, '12222', '202cb962ac59075b964b07152d234b70', 'juanc', NULL, '', NULL, 'asfq12@asf.com', '1'),
(28, '12222', '202cb962ac59075b964b07152d234b70', 'juanc', NULL, '', NULL, 'asfq12@asf.com', '1'),
(29, '12222', '202cb962ac59075b964b07152d234b70', 'juanc', NULL, '', NULL, 'asfq12@asf.com', '1'),
(30, '12222', '202cb962ac59075b964b07152d234b70', 'juanc', NULL, '', NULL, 'asfq12@asf.com', '1'),
(31, '12222', '202cb962ac59075b964b07152d234b70', 'juanc', NULL, '', NULL, 'asfq12@asf.com', '1'),
(32, '1022412942', '827ccb0eea8a706c4c34a16891f84e7b', 'BRAYAN GONZALEZ', NULL, '', NULL, 'brayangmega@gmail.com', '1'),
(33, '79632804', 'f2cb3e71a6465e8602da937dcb4492f3', 'carlos carrasquilla', NULL, '', NULL, 'jklidcarrasquilla@hotmail.com', '1'),
(34, '1024582122', '0db503720590329fbd48507324c03f69', 'daniel tellez', NULL, '', NULL, 'tellezdaniel@misena.edu.co', '1'),
(35, '1024582122', '2aec5babf2d05254900f19897efc5089', 'ANDRES', NULL, '', NULL, 'tellezdaniel@misena.edu.co', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `averias`
--

CREATE TABLE IF NOT EXISTS `averias` (
  `id` int(11) unsigned NOT NULL,
  `fecha` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `responsable_punto` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `conductor_responsable` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `destino` varchar(150) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int(11) unsigned NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `direccion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `telefono` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `celular` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=148 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `direccion`, `telefono`, `celular`, `email`) VALUES
(5, 'BOSA ALAMEDA (GLORIA)', 'CLL 74 # 83 A 45 ', '', '3209366406', ''),
(6, 'BOSA ASUSENA', 'CLL 65 C BIS # 77-5 14 ', '', '3223943824', ''),
(7, 'BOSA BRASILIA', 'CLL 51 # 87K -15 SUR', '3551732', '3209881117-3214511162', ''),
(8, 'BOSA LLANITO', 'CR 78 B # 69 B 33', '', '4797989', ''),
(9, 'BOSA NUEVA GRANADA CARPA', 'CLL 70 B SUR # 78 A 30', '7772128', '3103198895-3192748782', ''),
(10, 'BOSA NUEVA GRANADA MILLER', 'CR.78 C Nº 70 B 10', '', '7776708', ''),
(11, 'BOSA OLANDA', 'CR 87 J # 57 SUR 6-11 ', '', '3202364791', ''),
(12, 'BOSA PABLO VI FRENTE HOSPITAL', 'CR 77 CON CLL 70 A SUR ', '', '3132949048', ''),
(13, 'BOSA RECREO CANCHAS', 'CLL 72 SUR # 104-41 BLOQUE 3 CANCHAS', '', '3108557634', ''),
(14, 'BOSA VILLA DE LA LOMA(FLOR MURCIA', 'CR 82 A # 42 H SUR 24', '', '3143085339', ''),
(15, 'BRASA Y SABOR(MARIA MARTINEZ)', 'CR 7 # 20-02', '', '3214657280', ''),
(16, 'CAREFOUR ARENERA(ANA LUCIA BORDES)', 'CR 43 A # 59 A 08 ', '', '3125415410', ''),
(17, ' DEISY MARTINEZ', 'CLL 42 # 86 E 14', '', '3132090876', ''),
(18, 'CASTILLA(RICHARD)', 'CR 78 # 8 B 34', '', '3218583678', ''),
(19, 'CATALINA 2', 'CLL 42 # 86 F 14 SUR BARRIO CUIDAD CALI- CAREFOUR TINTALITO', '4540051', '3123428367', ''),
(20, 'CHUNIZA', 'CLL 54 SUR 77 T 49 CERCA AL SOCORRO', '2000990', '3214144758', ''),
(21, 'CLAS ROMA NUEVO DROGUERIA', 'CR 81 J # 57-17 SUR VEGA DE SANTAANA', '7964420', '3133393462', ''),
(22, 'COMPARTIR MARGARITA(AMPARO)', 'CR 17 # 28-28 SUR', '', '7235939', ''),
(23, 'DIANA CULTIVOS(YESID)', 'DIG. 57 Nº 81 J 19', '', '3105811893', ''),
(24, 'DIANA TURBAY CASA VERDE HERMANA', 'CLL 45 A SUR Nº 89 B 45', '', '3123423453', ''),
(25, 'ESCUELA PANAMERICANA ', 'CR.11 A Nº 49 D  60 SUR', '', '7262414', ''),
(26, 'HOGAR DEL SOL', 'CR 17 A #53-12"SAN CARLOS"', '', '3168283984', ''),
(27, 'JOSE ISIDRO RIAÑO', 'TRANS 31 - 24 ', '', '3202706167', ''),
(28, 'KENNEDY BRITALIA (EDWIN LIZARAZO)', 'PATIO BONITO', '', '3214222076', ''),
(29, 'KENNEDY LUCERNA CARIMAGUA(NANCY CAMARGO)', 'CLL 41 D SUR # 78 P 16', '', '3005683345', ''),
(30, 'LA ESTANCIA', 'CLL. 54 Nº 81 A 15', '', '3118453161', ''),
(31, 'LA ESTANCIA ( LUIS JAIME)', 'CLL 38 A # 72 M 07 ESQUINERO PANADERIA ', '', '3134909517', ''),
(32, 'LEON XIII BEATRIZ', 'CLL 47 #10-31', '', '3142142735', ''),
(33, 'LEON XIII COLISEO(MARIA)', 'CLL 60 A # 75 B 16 SUR ', '', '3212898548-3147373232', ''),
(34, 'LEON XIII COMANDO(SOACHA)	', 'CR 7 # 21-18 FRENTE CORATIENDAS	', '', '3223381676', ''),
(35, 'LEON XIII DIEGO', 'CLL 43 # 9-15', '', '3128810520', ''),
(36, 'LUIS FERNANDO LOPEZ', 'CR 8#40-38 NUEVA Y SOACHA CR 7#21-18', '', '3142722612', ''),
(37, 'MADEIRO(MIGUEL ANGEL)', 'DIAG 49 SUR # 85-17', '', '3175041532 ', ''),
(38, 'MANZANARES SOACHA (CECILIA)', 'DIAG 49 SUR Nº 85-17', '', '3213232592', ''),
(39, 'MARCOS ATALAYAS', 'CLL 72 # 18 N 15', '', '3124188740-', ''),
(40, 'MONTEBLANCO (LUCY)', 'CR 86 D # 40 C 34 VILLA HERMOSA', '', '3133906433', ''),
(41, 'MONTEBLANCO NUEVO', 'CLL.49 A BIS SUR Nº 5 N 74', '', '7613903', ''),
(42, 'NUEVA GRANADA(JAVIER)', 'CLL 96 A SUR # 14 B 30', '', '3134548209', ''),
(43, 'NUTIVARA GERMAN', 'CLL 70 B SUR #78 A 30', '', '7618336', ''),
(44, 'OLIVOS(PEDRO)', 'CR 77 J # 70 A 03', '', '3144729146-3134640008', ''),
(45, 'PATIO BONITO LLANO GRANDE', 'CLL 70 L BIS SUR # 18 N  28', '', '3134227284', ''),
(46, 'PATIO BONITO UNIR 1', 'diag 41 d # 16 a 14 barrio olivos 4 sector cra 9 bis # 4-14 centro salud olivos ', '', '3123695819', ''),
(47, 'PATIO BONITO', 'CR 88 D # 41-24 SUR ', '', '3202706167', ''),
(48, 'PATIO BONITO ASADERO', 'CLL 38 SUR # 87 D 19', '', '3132487721', ''),
(49, 'PINAR DEL RIO(YURANY VARGAS)', 'CLL 38 D # 82-33 SUR', '', '3102700827', ''),
(50, 'PIQUETEADERO SAN MATEO', 'CLL 32 SUR # 91-16 ', '', '7292591', ''),
(51, 'POLIDEPORTIVO KENNEDY', 'CLL 40 BIS SUR # 83-32 PISO 1', '', '4547229', ''),
(52, 'QUINTA ANA ESTUPIÑAN', 'AV 30 # 8 A 20', '', '3133314333', ''),
(53, 'QUINTAS ALTAVISTA PORTAL 3 (LUZ MERY GUEVARA)', 'CLL 2 SUR # 49-05', '', '3132582585', ''),
(54, 'QUINTAS LAGUNA SOACHA', 'CR 1 ESTE # 67 A 66 SUR', '', '3125263699', ''),
(55, 'RECREO RESERVADO 3	', 'CLL 65 SUR # 102-40 CASA 130	', '', '3102948795', ''),
(56, 'RIVERA TIERRA BUENA', 'CLL 33 BIS # 93-28', '', '3108010446', ''),
(57, 'RUTH MORA GARZON', 'CLL 65 SUR # 102-40 CASA 130 ', '', '3102948795', ''),
(58, 'SABOR DEL CARBON (CARLOS)', 'CLL 33 BIS # 93-28', '', '4545383', ''),
(59, 'SANTA LIBRADA 2 CUADRAS DE LA BOMBA (EDWIN CLAVIJO)', 'CLL 51 SUR # 18 A 37 CERCA A LA PLAZA ', '', '3193507742', ''),
(60, 'SANTA LIBRADA ALMACEN', 'CLL 66 BIS # 18 Q 89', '', '3193507742', ''),
(61, 'SANTA LIBRADA ALONSO', 'CLL 75 SUR # 1 A 91 ESTE ', '', '3142181814', ''),
(62, 'SANTA LIBRADA BOMBA', 'EN LA ESQUINA BOMBA', '', '3193507742', ''),
(63, 'SANTA LIBRADA BOMBA ARRIBA DE LA AURORA', 'DIAG 71 F # 1-29 SUR ', '', '7621580', ''),
(64, 'SIMEON', 'CLL 64 C # 1-41 ESTE ', '', '3213731167', ''),
(65, 'SOACHA CENTRO', 'CLL 14 # 18 R 18- PRADO VEGA', '', '5759344', ''),
(66, 'SOACHA CENTRO PRADO VEGA ', 'CLL 60 SUR 97 B 18 BOSA ATALAYAS', '', '5759344', ''),
(67, 'SOACHA COMPARTIR (JENNY)', 'CLL 16 A SUR # 10 B 05', '', '3208568884 ', ''),
(68, 'SOACHA LA AMISTAD(ANTONIO)', 'CLL 14 # 18 R 18', '', '3195090731', ''),
(69, 'SOACHA LAGUNA NUEVA', 'CLL 16 A SUR # 10 B 05 ', '', '7324579', ''),
(70, 'SOACHA QUINTAS PANADERIA', 'CLL 26 # 12-17 AL LADO DEL YUMBO', '', '3046615923', ''),
(71, 'SOACHA SAN CARLOS(DORIS PEREZ)', 'CLL 1 # 4 J 84 BARRIO SAN ANDRES', '', '7819673', ''),
(72, 'TIERRA BUENA (RODOLFO CASTEBLANCO)', 'CR. 5 ESTE Nº 13-33', '', '3122174589', ''),
(73, 'TINTAL 143 HERNANDO', 'CLL 6 A #94 A 26 CIUDAD TINTAL', '', '4775854', ''),
(74, 'TINTAL 6 CASA 465', 'CLL 26 SUR Nº 95 A 49', '', '3013700', ''),
(75, 'TINTAL RUBI', 'CLL 6 A # 89-47 TINTALA BASE 6', '', '3132964384', ''),
(76, 'TRIBUNA CALIENTE KENEDY (ANDREA)', 'CLL 6 A Nº 89-47', '', '3213329263-3142829922', ''),
(77, 'TUNJUELITO(CESAR MILLAN)', 'CLL 6 A Nº 89-47 PIZERIA', '', '3103435093', ''),
(78, 'ULISES ', '(CR 81 C BIS 54-52 SUR) cr 81 c bis # 54 a 69 - cll 54 # 81 a 15 kenedy carmelo', '', '4807630', ''),
(79, 'VILLA SALSIA (JOSE)', 'CR 10 # 53 A 24 SUR ', '', '3134453433', ''),
(80, 'VILLAS DE KENEDY CIRCO (LUIS DAVID ARANDA)', 'CLL 60 SUR 97 B  20 BOSA ATALAYAS', '', '3124170824', ''),
(81, 'VISION COLOMBIA', 'CR 72 A #11 A 15', '', '3134521623-3105186482', ''),
(82, '07-ago(JAIR PEÑALOZA)', 'CR 24 # 65-59', '', '3202016596', ''),
(83, '07-ago(DISCARPOL)', 'CLL 66 # 23-12', '', '2111610', ''),
(84, 'ALTAMIRA BARBARA ', 'CR 12 A # 42-85', '', '3116098298', ''),
(85, 'ALTAMIRA FAMA (ANGEL)', 'CLL 46 SUR # 11 A 36 SALSAMENTARIA ', '', '3112003803', ''),
(86, 'AV CRA 50', 'AV CRA 50 # 17 -13 SUR ROMBOY 1 MAYO', '', '3132503581', ''),
(87, 'BARRIO ALQUERIA (JHON MARQUEZ)', 'CLL 37 SUR # 54-25 ', '7024150', '3144237061', ''),
(88, 'BARRIO CARVAJAL', 'CLL 38 #72 M 07 SUR  CERCA AL TIMIZA ', '', '2652825', ''),
(89, 'CARCEL MODELO PUENTE ARANDA', 'CR 58 # 17-49', '', '3206673034', ''),
(90, 'CHAPINERO (VERSEL VELASCO)', 'CLL 52# 15-98', '', '3123119021', ''),
(91, 'CHORRO DE QUEVEDO (CANDELARIA) ALFREDO ORTIZ', 'ANTES DEL CALLEJON DEL EMBUDO INTERIOR 5', '', '3107626814', ''),
(92, 'CIUDAD MONTES', 'CLL 8 SUR # 38 A 35', '', '3203433306', ''),
(93, 'CIUDAD MONTES ( LATINOS) OSCAR DAVID', 'CALLE 8 SUR # 35 A 35 ', '', '3203433306', ''),
(94, 'DON PEPE (ANTONIO)', 'CR 13 #45 A 11', '', '3157984369', ''),
(95, 'EL CLARET (EDILMA MORENO)', 'dg 43 a #  29-11', '7111100', '3133862930', ''),
(96, 'GUSTAVO RESTREPO CAI (ADIELA)', 'CLL31A #13 A 41 SUR', '', '3104782135', ''),
(97, 'JAVERIANA LA 8', 'CR 8 # 41-39 FRENTE A LA 8 TERRAZA STEIK HOUSE', '', '3176989985', ''),
(98, 'LA ESTRADA', 'CR 69 I # 66-88 ', '', '3122732437', ''),
(99, 'LA ESTRADA-COLEGIO CAFAM (OTILIA)', 'CR 68 G Nº 64 D 36', '', '2400737', ''),
(100, 'PLAZA DE LAS NIEVES', 'CR 20 # 8-73 INTERIOR 51', '', '3132875574', ''),
(101, 'POLICARPA (GRACIELA CARO)', 'CR 11 # 4 -36 ', '', '3214300334', ''),
(102, 'RESTAURANTE EL MIO', 'CLL 25 C # 36-39  (CLINICA FUNDADORES)', '', '2441984', ''),
(103, 'RESTAURANTE OCCIDENTE ', 'AV AMERICAS  # 71 B 46', '', '4202617', ''),
(104, 'RICAURTE (ANGELICA)', 'CR 1 # 21-00 ', '', '3146818354', ''),
(105, 'RICAURTE BILLAR (OSCAR)', 'CR 28 #9-18', '', '3114899269', ''),
(106, 'SAN ANDRESITO (PAOLA ARENA)', 'CRA 20 CALLE 14 # 20-05', '', '3193562951', ''),
(107, 'SAN JORGE CENTRAL (MARCELA)', 'AV 1 MAYO Nº 34-17 SUR ', '', '3185272734', ''),
(108, 'TEUSAQUILLO ', 'DIAG 40 # 15-20', '', 'DIAG 40 # 15-20', ''),
(109, 'TEUSAQUILLO DESAYUNADERO', 'CR 13 # 34-27 ALIANZA', '2321705', '3108561994', ''),
(110, 'CORUÑA (MARY)', 'KR 48 G 59-42 SUR', '', '3112717712', ''),
(111, 'ALQUERIA (OSCAR)', 'cra 54 # 37 a 18 alqueria', '', '3138636973', ''),
(112, 'BOSA TROPEZON', 'CRA 87 C # 61 A 07 LOCAL MR OSCAR POR LA PRINCIPAL', '', '3204208884', ''),
(113, 'CHORIZO SANTA ROSANO', 'CLL 70 # 69P16', '', '2310389', ''),
(114, 'FONTIBON', 'MARINO- CERCA AL RIO BOGOTA - PUENTE GRANDE', '', '3213648508', ''),
(115, 'GUATEQUE -BOYACA (CAMILO ROMERO C.C 74,283,084)', 'FLOTA MACARENA', '', '3112039531', ''),
(116, 'LOS CEREZOS (MARLEN URIBE)', 'CLL 89 # 87-27', '', '2523525', ''),
(117, 'MODELIA', 'cll 25 f 84 b 84', '', '3203893902', ''),
(118, 'SANTA CECILIA MODELIA (YURLEY HERNANDEZ)', 'CR 25 F # 84 B 84', '', '3203893902', ''),
(119, 'SANTA MARTA (DIANA)', 'AV LIBERTADOR', '', '3138371984', ''),
(120, 'SIBATE ALICIA (CH)', 'transv 13 # 10 b 19 barrio san martin cerca parabolica', '', '3142466277', ''),
(121, 'SUBA CENTRO- PAPA A LA LATA', 'CALLE 146 C #92-23', '', '3192087647', ''),
(122, 'TOTOPOS (JHON ZUÑIGA)', 'CLL 70 F 106 A 11 casa cll 71 a 3 16 a 21', '4352600', '3142941425', ''),
(123, 'VIVIANA RUBIANO', 'DIAG 52 # 54-22 SUR VENECIA', '', '7133708-4208501', ''),
(124, 'MONTEBLANCO MARTA ', 'CR 14 J # 94-50', '', '3143678443', ''),
(125, 'BOSA (MANZANARES)', 'CR 78 D BIS # 73 H 14', '', '3112386800-3115550857', ''),
(126, 'BOSA BETANIA CONJUNTO AMERICAS', 'CLL 49 SUR 87 A 51 INT3 APT 301 ', '', '3144710059', ''),
(127, 'BOSA CARBONEL LA CARPA', 'TRANSV 77 R BIS #71 B 54 SUR', '', '3144359922', ''),
(128, 'BOSA LA PAZ', 'CLL 62 SUR 83 A 04', '', '3144359922', ''),
(129, 'BOSA LAURELES', 'CRA 80 M #75 SUR 32 ', '4595834', '3107742929', ''),
(130, 'BOSA MARIPAN', 'CLL 40 D SUR # 87-39', '', '3147978295', ''),
(131, 'BOSA NARANJO', 'CRA 80 # 70 C SUR 28', '', '3144065673', ''),
(132, 'BOSA NUEVA GRANADA JAVIER SOSA', 'CLL 70 BIS SUR # 78-03', '7772128', '3123945045', ''),
(133, 'BOSA PABLO VI', 'CLL 77 J # 70 A SUR CERCA HOSPITAL', '', '3123235727', ''),
(134, 'BRITALIA NUEVO', 'CR 81 H #49-02', '', '3133182002', ''),
(135, 'CARNES EL BARCINO', 'CLL 40 # 90 D 15', '', '3157692139-ALBERTO', ''),
(136, 'Megachorizos', 'frigorifio', '', '123', ''),
(137, 'SOCORRO TUNJUELITO', 'cra 15 a # 50 c 30 sur', '', '3138000874', ''),
(138, 'PATIO BONITO TAIRONA', 'CLL 2 A # 86 F 30', '', '3153238500', ''),
(139, 'PATIO B BARRANQUILLITA', 'CR 86 C BIS # 40-37', '', '3142104244', ''),
(140, 'KAREN TINTAL', 'cll 8 a # 92-71 casa 244', '', '3123733267', ''),
(141, 'SOACHA OLIVOS', 'transv 12 a 42 a 63', '', '3214881763', ''),
(142, 'BARRIO CECILIA ', 'CR 67 H # 57 I SUR 20', '', '3144306339', ''),
(143, 'ANA ESTUPIÑAN QUINTA LAGUNA', 'CLL 2 SUR 4 G 05', '', 'CEL:3133314333', ''),
(144, 'SOACHA DELICIAS VALLUNAS', 'CLL 13 # 9-06', '', 'CEL:3133354323', ''),
(145, 'TINTAL NUEVO', 'CLL 6 BIS A # 90 A 50 ', '', 'CEL:3016705667', ''),
(146, 'CLASS ROMA DROGUERIA', 'CR 81 J # 57-17 SUR VEGA DE SANTAANA', '7964420', '3133393462', ''),
(147, 'OTILIA DAZA - BOSQUE POPULAR', 'CR 68 G # 64 D 36', '2400737', '3112790425', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ctrl_producciones_trazabilidad`
--

CREATE TABLE IF NOT EXISTS `ctrl_producciones_trazabilidad` (
  `id` int(11) unsigned NOT NULL,
  `orden_produccion` int(11) unsigned NOT NULL,
  `fecha` date NOT NULL,
  `producto` int(11) unsigned NOT NULL,
  `responsable` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cant_produccion` tinyint(11) unsigned NOT NULL DEFAULT '1',
  `unidades_producidas` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `ctrl_producciones_trazabilidad`
--

INSERT INTO `ctrl_producciones_trazabilidad` (`id`, `orden_produccion`, `fecha`, `producto`, `responsable`, `cant_produccion`, `unidades_producidas`) VALUES
(16, 1, '2016-08-16', 41, '22', 1, 11800),
(17, 1, '2016-08-16', 41, '22', 1, 11800);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `despachos`
--

CREATE TABLE IF NOT EXISTS `despachos` (
  `id` int(11) unsigned NOT NULL,
  `fecha` date NOT NULL,
  `responsable` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `verificado` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `despachos`
--

INSERT INTO `despachos` (`id`, `fecha`, `responsable`, `verificado`) VALUES
(3, '2016-08-16', 'DAVID', 'GUSTAVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_averias`
--

CREATE TABLE IF NOT EXISTS `detalle_averias` (
  `id` int(11) unsigned NOT NULL,
  `fecha_reporte` date NOT NULL,
  `producto_id` int(11) unsigned NOT NULL,
  `cantidad` decimal(5,2) NOT NULL,
  `lote` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `observaciones` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `averia_id` int(11) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_ctrl_producciones`
--

CREATE TABLE IF NOT EXISTS `detalle_ctrl_producciones` (
  `id` int(11) unsigned NOT NULL,
  `tipo` enum('0','1') COLLATE utf8_unicode_ci NOT NULL COMMENT '0 = No carnica\n1 = Carnica\n',
  `lote_interno` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ctrl_producciones_id` int(11) unsigned NOT NULL,
  `cantidad` double(10,2) unsigned NOT NULL,
  `insumo_id` int(11) unsigned NOT NULL,
  `proveedor_id` int(11) unsigned DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=190 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `detalle_ctrl_producciones`
--

INSERT INTO `detalle_ctrl_producciones` (`id`, `tipo`, `lote_interno`, `ctrl_producciones_id`, `cantidad`, `insumo_id`, `proveedor_id`) VALUES
(169, '0', '157', 16, 14.00, 56, 44),
(170, '0', '158', 16, 14.00, 96, 45),
(171, '0', '159', 16, 20.00, 112, 45),
(172, '0', '160', 16, 12.60, 60, 45),
(173, '0', '161', 16, 0.70, 122, 72),
(174, '0', '162', 16, 7.00, 7, 35),
(175, '0', '163', 16, 14.00, 73, 39),
(176, '0', '164', 16, 14.00, 120, 40),
(177, '0', '165', 16, 196.00, 5, 78),
(178, '0', '156', 16, 3.50, 63, 58),
(179, '0', '', 16, 14.00, 120, 40),
(180, '0', '157', 17, 14.00, 56, 44),
(181, '0', '158', 17, 14.00, 96, 45),
(182, '0', '159', 17, 20.00, 112, 45),
(183, '0', '160', 17, 12.60, 60, 45),
(184, '0', '161', 17, 0.70, 122, 72),
(185, '0', '162', 17, 7.00, 7, 35),
(186, '0', '163', 17, 14.00, 73, 39),
(187, '0', '164', 17, 14.00, 120, 40),
(188, '0', '165', 17, 196.00, 5, 78),
(189, '0', '156', 17, 3.50, 63, 58);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_despacho`
--

CREATE TABLE IF NOT EXISTS `detalle_despacho` (
  `id` int(11) unsigned NOT NULL,
  `producto` int(11) unsigned NOT NULL,
  `cliente_id` int(11) unsigned NOT NULL,
  `lote` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `cantidad` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `destino` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `observaciones` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_despacho` int(11) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_inventario_empaque_vacio`
--

CREATE TABLE IF NOT EXISTS `detalle_inventario_empaque_vacio` (
  `id` int(11) unsigned NOT NULL,
  `producto_id` int(11) unsigned NOT NULL,
  `unidad` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `lote` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `reproceso` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `observaciones` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `inventario_empaque_vacio_id` int(11) unsigned NOT NULL,
  `cantidad` decimal(2,0) NOT NULL DEFAULT '5'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formulacion`
--

CREATE TABLE IF NOT EXISTS `formulacion` (
  `id` int(11) unsigned NOT NULL,
  `producto_id` int(11) unsigned NOT NULL,
  `materia_prima` int(11) unsigned NOT NULL,
  `peso` decimal(10,2) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=753 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `formulacion`
--

INSERT INTO `formulacion` (`id`, `producto_id`, `materia_prima`, `peso`) VALUES
(357, 61, 60, '0.30'),
(358, 61, 28, '0.50'),
(359, 61, 56, '0.20'),
(360, 61, 8, '0.20'),
(361, 61, 63, '0.08'),
(362, 61, 51, '1.00'),
(363, 61, 38, '4.00'),
(365, 31, 60, '0.30'),
(366, 31, 28, '0.50'),
(367, 31, 56, '0.20'),
(368, 31, 8, '0.20'),
(369, 31, 63, '0.08'),
(370, 31, 51, '1.00'),
(371, 31, 38, '2.00'),
(372, 31, 5, '3.00'),
(374, 43, 18, '9.20'),
(375, 43, 95, '9.20'),
(376, 43, 60, '8.20'),
(377, 43, 112, '0.00'),
(378, 43, 122, '0.60'),
(379, 43, 56, '9.20'),
(380, 43, 5, '151.10'),
(381, 43, 8, '29.80'),
(382, 43, 73, '4.60'),
(383, 43, 49, '9.20'),
(384, 43, 63, '1.40'),
(385, 43, 7, '29.80'),
(387, 41, 56, '14.00'),
(388, 41, 96, '14.00'),
(389, 41, 112, '20.00'),
(390, 41, 60, '12.60'),
(391, 41, 122, '0.70'),
(392, 41, 7, '7.00'),
(393, 41, 73, '14.00'),
(394, 41, 120, '14.00'),
(395, 41, 5, '196.00'),
(396, 41, 63, '3.50'),
(400, 45, 18, '2.00'),
(401, 45, 28, '2.00'),
(402, 45, 60, '1.80'),
(403, 45, 23, '25.00'),
(404, 45, 40, '0.10'),
(405, 45, 81, '2.00'),
(406, 45, 5, '33.00'),
(407, 45, 8, '6.50'),
(408, 45, 73, '2.00'),
(409, 45, 49, '2.00'),
(410, 45, 63, '0.30'),
(411, 45, 7, '6.50'),
(413, 3, 8, '26.00'),
(414, 3, 56, '4.00'),
(415, 3, 73, '4.00'),
(416, 3, 54, '1.10'),
(417, 3, 5, '66.00'),
(418, 3, 60, '2.00'),
(419, 3, 28, '6.20'),
(420, 3, 49, '5.00'),
(421, 3, 18, '5.00'),
(422, 3, 49, '5.00'),
(423, 3, 40, '0.20'),
(424, 3, 54, '0.55'),
(425, 3, 18, '2.50'),
(426, 3, 49, '2.50'),
(428, 4, 28, '2.00'),
(429, 4, 60, '1.20'),
(430, 4, 112, '2.70'),
(431, 4, 40, '0.10'),
(432, 4, 81, '2.00'),
(433, 4, 5, '14.00'),
(434, 4, 73, '2.00'),
(435, 4, 54, '0.36'),
(436, 4, 22, '1.00'),
(438, 54, 8, '12.00'),
(439, 54, 56, '2.00'),
(440, 54, 73, '2.00'),
(441, 54, 63, '0.30'),
(442, 54, 5, '25.00'),
(443, 54, 40, '0.10'),
(444, 54, 60, '1.80'),
(445, 54, 28, '2.00'),
(446, 54, 20, '0.50'),
(447, 54, 49, '0.30'),
(449, 1, 49, '2.50'),
(450, 1, 28, '2.00'),
(451, 1, 60, '1.80'),
(452, 1, 23, '34.00'),
(453, 1, 40, '0.10'),
(454, 1, 81, '2.00'),
(455, 1, 73, '3.00'),
(456, 1, 57, '1.00'),
(457, 1, 5, '24.00'),
(458, 1, 8, '10.00'),
(459, 1, 18, '1.50'),
(460, 1, 54, '0.49'),
(461, 1, 13, '390.00'),
(463, 50, 73, '1.00'),
(464, 50, 56, '3.00'),
(465, 50, 120, '1.00'),
(466, 50, 57, '6.00'),
(467, 50, 43, '3.00'),
(468, 50, 8, '6.00'),
(469, 50, 18, '5.00'),
(470, 50, 5, '40.00'),
(471, 50, 28, '5.00'),
(472, 50, 40, '0.10'),
(473, 50, 60, '1.00'),
(474, 50, 54, '0.53'),
(475, 50, 49, '5.00'),
(477, 47, 73, '3.00'),
(478, 47, 56, '3.00'),
(479, 47, 49, '5.00'),
(480, 47, 57, '5.00'),
(481, 47, 43, '3.00'),
(482, 47, 8, '6.00'),
(483, 47, 18, '5.00'),
(484, 47, 5, '25.00'),
(485, 47, 28, '5.00'),
(486, 47, 40, '0.10'),
(487, 47, 60, '1.00'),
(488, 47, 54, '0.49'),
(489, 47, 13, '320.00'),
(491, 52, 14, '90.00'),
(492, 52, 46, '10.00'),
(493, 52, 50, '16.00'),
(494, 52, 60, '1.20'),
(495, 52, 28, '3.50'),
(496, 52, 81, '4.00'),
(497, 52, 8, '12.00'),
(498, 52, 63, '0.20'),
(499, 52, 68, '0.06'),
(500, 52, 5, '16.00'),
(501, 52, 38, '9.00'),
(502, 55, 14, '225.00'),
(503, 55, 5, '6.00'),
(504, 55, 81, '4.00'),
(505, 55, 40, '0.20'),
(506, 55, 60, '3.50'),
(507, 55, 29, '0.15'),
(508, 55, 63, '0.30'),
(509, 55, 28, '2.60'),
(510, 55, 50, '8.00'),
(511, 55, 38, '11.00'),
(512, 55, 67, '0.45'),
(514, 53, 60, '1.20'),
(515, 53, 28, '3.50'),
(516, 53, 29, '0.30'),
(517, 53, 38, '15.00'),
(518, 53, 8, '12.00'),
(519, 53, 81, '4.00'),
(520, 53, 50, '16.00'),
(521, 53, 5, '10.00'),
(522, 53, 63, '0.20'),
(523, 53, 37, '0.05'),
(525, 15, 69, '3.00'),
(526, 15, 60, '1.80'),
(527, 15, 73, '2.00'),
(528, 15, 56, '2.00'),
(529, 15, 40, '0.10'),
(530, 15, 19, '2.00'),
(531, 15, 54, '0.36'),
(532, 15, 28, '2.00'),
(533, 15, 5, '18.00'),
(534, 15, 39, '2.00'),
(535, 15, 13, '286.00'),
(537, 16, 60, '0.30'),
(538, 16, 28, '0.38'),
(539, 16, 81, '2.00'),
(540, 16, 121, '1.00'),
(541, 16, 8, '1.00'),
(542, 16, 63, '0.08'),
(543, 16, 5, '6.00'),
(544, 16, 38, '4.00'),
(545, 16, 24, '0.30'),
(547, 57, 60, '0.30'),
(548, 57, 81, '1.00'),
(549, 57, 8, '4.00'),
(550, 57, 63, '0.08'),
(551, 57, 38, '7.00'),
(553, 56, 60, '0.30'),
(554, 56, 81, '1.00'),
(555, 56, 8, '4.00'),
(556, 56, 63, '0.08'),
(557, 56, 5, '6.00'),
(558, 56, 38, '6.00'),
(560, 58, 60, '1.20'),
(561, 58, 27, '2.50'),
(562, 58, 8, '4.00'),
(563, 58, 55, '1.00'),
(564, 58, 64, '0.05'),
(565, 58, 63, '0.30'),
(566, 58, 30, '114.00'),
(568, 32, 60, '0.35'),
(569, 32, 28, '0.50'),
(570, 32, 81, '2.00'),
(571, 32, 121, '1.00'),
(572, 32, 8, '1.00'),
(573, 32, 63, '0.08'),
(574, 32, 5, '6.00'),
(575, 32, 38, '4.00'),
(577, 51, 60, '0.30'),
(578, 51, 28, '0.50'),
(579, 51, 81, '1.50'),
(580, 51, 121, '1.00'),
(581, 51, 8, '1.50'),
(582, 51, 63, '0.08'),
(583, 51, 5, '6.00'),
(584, 51, 38, '4.00'),
(586, 59, 60, '0.60'),
(587, 59, 28, '0.50'),
(588, 59, 81, '2.00'),
(589, 59, 121, '1.00'),
(590, 59, 8, '1.00'),
(591, 59, 63, '0.16'),
(592, 59, 5, '6.00'),
(593, 59, 38, '4.00'),
(595, 60, 60, '3.40'),
(596, 60, 28, '8.00'),
(597, 60, 63, '0.20'),
(598, 60, 68, '0.16'),
(599, 60, 5, '12.00'),
(601, 49, 73, '1.00'),
(602, 49, 56, '3.00'),
(603, 49, 120, '1.00'),
(605, 49, 43, '3.00'),
(606, 49, 8, '6.00'),
(607, 49, 18, '5.00'),
(608, 49, 5, '40.00'),
(609, 49, 127, '5.00'),
(611, 49, 122, '0.10'),
(612, 49, 60, '1.00'),
(613, 49, 54, '0.53'),
(614, 49, 49, '5.00'),
(615, 7, 124, '10.90'),
(616, 7, 60, '12.70'),
(617, 7, 112, '15.00'),
(618, 7, 122, '0.50'),
(619, 7, 56, '10.90'),
(620, 7, 49, '10.90'),
(621, 7, 7, '35.20'),
(622, 7, 8, '35.90'),
(623, 7, 5, '180.50'),
(624, 7, 73, '5.50'),
(625, 7, 63, '1.60'),
(626, 7, 18, '10.90'),
(627, 6, 28, '2.00'),
(628, 6, 60, '1.80'),
(629, 6, 69, '3.30'),
(630, 6, 40, '0.10'),
(631, 6, 56, '2.00'),
(632, 6, 49, '2.00'),
(633, 6, 7, '6.50'),
(634, 6, 8, '6.50'),
(635, 6, 5, '33.00'),
(636, 6, 73, '2.00'),
(637, 6, 63, '0.30'),
(638, 6, 18, '2.00'),
(639, 13, 63, '0.80'),
(640, 13, 56, '3.10'),
(641, 13, 96, '3.10'),
(642, 13, 112, '7.00'),
(643, 13, 60, '2.80'),
(644, 13, 122, '0.20'),
(645, 13, 120, '3.10'),
(646, 13, 73, '3.00'),
(647, 13, 5, '42.90'),
(648, 13, 7, '1.50'),
(649, 5, 8, '13.00'),
(650, 5, 56, '2.00'),
(651, 5, 73, '2.00'),
(652, 5, 54, '0.55'),
(653, 5, 5, '35.00'),
(654, 5, 45, '20.00'),
(655, 5, 60, '2.00'),
(656, 5, 28, '2.00'),
(657, 5, 19, '3.00'),
(658, 5, 49, '3.00'),
(659, 5, 31, '20.00'),
(660, 5, 40, '0.10'),
(661, 2, 40, '0.10'),
(662, 2, 55, '2.00'),
(663, 2, 8, '0.00'),
(664, 2, 31, '0.00'),
(665, 2, 60, '0.00'),
(666, 2, 23, '0.00'),
(667, 2, 18, '0.00'),
(668, 2, 73, '0.00'),
(669, 2, 49, '0.00'),
(670, 2, 28, '0.00'),
(671, 2, 54, '0.00'),
(672, 2, 5, '0.00'),
(673, 2, 13, '0.00'),
(687, 66, 2, '20.00'),
(688, 66, 8, '30.00'),
(689, 70, 60, '1.80'),
(690, 70, 18, '2.00'),
(691, 70, 95, '2.00'),
(692, 70, 193, '3.00'),
(693, 70, 40, '0.10'),
(694, 70, 56, '2.00'),
(695, 70, 5, '33.00'),
(696, 70, 8, '6.50'),
(697, 70, 73, '2.00'),
(698, 70, 49, '2.00'),
(699, 70, 63, '0.30'),
(700, 70, 7, '6.50'),
(701, 12, 56, '1.90'),
(703, 12, 73, '2.00'),
(704, 12, 112, '3.00'),
(705, 12, 60, '1.70'),
(706, 12, 122, '0.10'),
(707, 12, 120, '1.90'),
(709, 12, 5, '70.00'),
(710, 12, 7, '1.00'),
(711, 12, 63, '0.50'),
(712, 12, 96, '1.90'),
(716, 11, 8, '9.20'),
(717, 11, 7, '9.20'),
(718, 11, 56, '2.80'),
(719, 11, 73, '1.40'),
(720, 11, 63, '0.40'),
(721, 11, 5, '46.90'),
(722, 11, 60, '2.60'),
(723, 11, 95, '2.80'),
(724, 11, 49, '2.80'),
(725, 11, 18, '2.80'),
(726, 11, 122, '0.10'),
(727, 62, 8, '8.00'),
(728, 62, 56, '12.00'),
(729, 62, 194, '8.00'),
(730, 62, 73, '8.00'),
(731, 49, 63, '2.00'),
(732, 62, 5, '120.00'),
(733, 62, 60, '7.20'),
(734, 62, 122, '0.40'),
(735, 62, 112, '10.00'),
(736, 62, 193, '15.00'),
(737, 43, 194, '4.60'),
(738, 11, 194, '1.40'),
(739, 7, 194, '5.50'),
(740, 7, 193, '43.00'),
(741, 10, 8, '10.10'),
(742, 10, 56, '3.10'),
(743, 10, 7, '9.80'),
(744, 10, 194, '1.50'),
(745, 10, 73, '1.50'),
(746, 10, 63, '0.50'),
(747, 10, 5, '50.50'),
(748, 10, 60, '3.50'),
(749, 10, 124, '3.10'),
(750, 10, 49, '3.10'),
(751, 10, 18, '3.10'),
(752, 10, 122, '0.20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `insumo`
--

CREATE TABLE IF NOT EXISTS `insumo` (
  `id` int(11) unsigned NOT NULL,
  `materia_prima` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tipo` enum('0','1','2') COLLATE utf8_unicode_ci NOT NULL COMMENT '0 = Carnica\n1 = No Carnica\n2 = Insumo',
  `cantidad` decimal(10,2) unsigned NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB AUTO_INCREMENT=196 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `insumo`
--

INSERT INTO `insumo` (`id`, `materia_prima`, `tipo`, `cantidad`) VALUES
(2, 'CEBOLLA MOLIDA', '1', '0.00'),
(4, 'CARNE DE RES', '0', '0.00'),
(5, 'AGUA', '1', '0.00'),
(7, 'ALMIDON DE TRIGO', '1', '0.00'),
(8, 'ALMIDON DE PAPA', '1', '0.00'),
(13, 'BOLSAS AL VACIO', '1', '0.00'),
(14, 'CARNE DE CERDO', '0', '0.00'),
(15, 'CARNE DE GALLINA', '0', '0.00'),
(16, 'CARNE DE POLLO', '0', '0.00'),
(17, 'CARNE DE TERNERA', '0', '0.00'),
(18, 'CEBOLLA', '1', '0.00'),
(19, 'CEBOLLA LARGA', '1', '0.00'),
(20, 'CEBOLLA PUERRO', '1', '0.00'),
(21, 'CERDO', '0', '254.00'),
(22, 'CILANTRO', '1', '0.00'),
(23, 'COLAGENO', '1', '0.00'),
(24, 'COLOR', '1', '0.00'),
(25, 'COLOR NARANJA', '1', '0.00'),
(26, 'CONCENTRADO', '1', '0.00'),
(27, 'CONDIMENTO PAVO', '1', '0.00'),
(28, 'CONDIMENTOS', '1', '0.00'),
(29, 'CONSENTRADO', '1', '0.00'),
(30, 'CUEROS', '1', '0.00'),
(31, 'DESPALME', '0', '0.00'),
(33, 'EMPAQUE', '1', '0.00'),
(37, 'GLUTAMINASA', '1', '0.00'),
(38, 'HIELO', '0', '0.00'),
(39, 'HIERVAS', '1', '0.00'),
(40, 'HUMO', '1', '0.00'),
(42, 'MERMA', '0', '0.00'),
(43, 'MIGA BLANCA', '1', '0.00'),
(44, 'MOTA', '0', '0.00'),
(45, 'PASTA', '0', '0.00'),
(46, 'PASTA DE POLLO', '0', '0.00'),
(47, 'PASTA DE RES', '0', '0.00'),
(48, 'PECHO', '0', '0.00'),
(49, 'PIMENTON', '1', '0.00'),
(51, 'PLASMA LIQUIDO', '0', '0.00'),
(52, 'POLLO', '0', '0.00'),
(54, 'PROTECTA', '1', '0.00'),
(55, 'PROTEINA AL 90', '1', '0.00'),
(56, 'PROTEINA ARCON', '1', '0.00'),
(57, 'RESPONSE', '1', '0.00'),
(60, 'SAL NITRADA', '1', '0.00'),
(63, 'STERMAX', '1', '153.00'),
(64, 'SUPER SMOL', '1', '0.00'),
(67, 'TRASGLUTAMINAZA', '1', '0.00'),
(69, 'TRIPA NATURAL DE CERDO', '1', '0.00'),
(70, 'UNIDADES', '0', '0.00'),
(71, 'UTILIDAD', '1', '0.00'),
(72, 'UTILIDAD UNIDAD', '1', '0.00'),
(73, 'VITACEL', '1', '0.00'),
(74, 'RECORTE DE RES', '0', '0.00'),
(75, 'GRASA DE RES', '0', '0.00'),
(76, 'CABEZA DE LOMO', '0', '0.00'),
(77, 'CUERO DE CERDO', '0', '0.00'),
(78, 'CARNE INDUSTRIAL', '0', '0.00'),
(81, 'PROTEINA', '1', '0.00'),
(82, 'RES', '0', '0.00'),
(83, 'RECICLE', '0', '0.00'),
(84, 'grasa de cerdo', '0', '0.00'),
(85, 'promul', '1', '0.00'),
(86, 'granulos', '1', '0.00'),
(87, 'COSTILLA', '0', '0.00'),
(88, 'bolsas', '1', '0.00'),
(89, 'PROTEINA AL 70', '1', '0.00'),
(90, 'COND. LONGANIZA', '1', '0.00'),
(91, 'COND. TOCINETA', '1', '0.00'),
(92, 'COND. MANGUERA', '1', '0.00'),
(93, 'CARNAL', '1', '0.00'),
(95, 'COND. CERDO AHUMADO', '1', '0.00'),
(96, 'COND. MEGA', '1', '0.00'),
(98, 'COND. CHORIZO POLLO', '1', '0.00'),
(99, 'COND. PERNIL CERDO', '1', '0.00'),
(101, 'COND. MORTADELA', '1', '0.00'),
(102, 'COND. JAMÓN', '1', '0.00'),
(103, 'CARRAGEL', '1', '0.00'),
(104, 'COND. PUERRO', '1', '0.00'),
(107, 'COND. SALCHICHA AMERICANA', '1', '0.00'),
(109, 'COND. HAMBURG. POLLO', '1', '0.00'),
(110, 'COND. CAHUMADO', '1', '0.00'),
(111, 'COND. RH', '1', '0.00'),
(112, 'MADEJA DE CERDO', '1', '0.00'),
(113, 'CORIA 18*20', '1', '0.00'),
(114, 'HILO GRUESO', '1', '0.00'),
(115, 'EMPAQUE JAMON', '1', '0.00'),
(116, 'EMPAQUE SALCHICHON', '1', '0.00'),
(117, 'DEBRO 30', '1', '0.00'),
(118, 'PROTEINA DE SOYA', '1', '0.00'),
(119, 'FIBRA DE COLAGENO', '1', '0.00'),
(120, 'TEXTURIZADO DE SOYA', '1', '0.00'),
(121, 'HARINA DE TRIGO', '1', '0.00'),
(122, 'SMOKE OIL', '1', '0.00'),
(123, 'NATURSOL', '1', '0.00'),
(124, 'CONDIMENTO MIXTO PRECOCIDO', '1', '0.00'),
(125, 'FOSFATO', '1', '0.00'),
(126, 'CONDIMENTO SALCHICHA MANGUERA', '1', '0.00'),
(127, 'COND. HAMBURGUESA RES', '1', '0.00'),
(128, 'PUERRO', '1', '0.00'),
(129, 'CONDIMENTO CHORIZO CRIOLLO', '1', '0.00'),
(130, 'CONDIMENTO CHORIZO TERNERA', '1', '0.00'),
(131, 'CONDIMENTO CHORIZO COCTEL CERDO', '1', '0.00'),
(132, 'CONDIMENTO SALCHICHÓN', '1', '0.00'),
(133, 'CONDIMENTO SALCHICHA HOT DOG', '1', '0.00'),
(134, 'CODIMENTO CHORIZO PICANTE', '1', '0.00'),
(135, 'CONDIMENTO SALCHICHA RANCHERA', '1', '0.00'),
(137, 'BOLSA TOCINETA LIBRA', '2', '0.00'),
(140, 'BOLSA TOCINETA MEDIA', '2', '0.00'),
(141, 'BOLSA TOCINETA CUARTO', '2', '0.00'),
(142, 'BOLSA CHORIZO MEGA CUNCIA', '2', '0.00'),
(143, 'BOLSA CHORIZO POLLO', '2', '0.00'),
(144, 'BOLSA CHORIZO CRIOLLO', '2', '0.00'),
(145, 'BOLSA CHORIZO PICANTE', '2', '0.00'),
(146, 'BOLSA CHORIZO PREMIUM', '2', '0.00'),
(147, 'BOLSA CHORIZO TERNERA', '2', '0.00'),
(148, 'BOLSA JAMON LIBRA', '2', '0.00'),
(149, 'BOLSA JAMON MEDIA', '2', '0.00'),
(150, 'BOLSA JAMON BLOQUE', '2', '0.00'),
(151, 'BOLSA HAMBURGUESA * 22', '2', '0.00'),
(152, 'BOLSA HAMBURGUESA * 5', '2', '0.00'),
(153, 'CHORIZO TRADICIONAL', '0', '0.00'),
(154, 'BOLSA LONGANIZA', '2', '0.00'),
(155, 'BOLSA TOCINETA LIBRA BLANCA', '2', '0.00'),
(156, 'BOLSA TOCINETA MEDIA BLANCA', '2', '0.00'),
(157, 'BOLSA CHORIZO BLANCA 19*28', '2', '0.00'),
(158, 'BOLSA COCTEL', '2', '0.00'),
(159, 'BOLSA 35*50', '2', '0.00'),
(160, 'BOLSA HAMBURGUESA DE POLLO', '2', '0.00'),
(161, 'BOLSA 20*30', '2', '0.00'),
(162, 'BOLSA 25*30', '2', '0.00'),
(163, 'BOLSA 25*45', '2', '0.00'),
(164, 'BOLSA 18*25', '2', '0.00'),
(165, 'BOLSA 50*35', '2', '0.00'),
(166, 'BOLSA 18*30', '2', '0.00'),
(167, 'BOLSA 18*22', '2', '0.00'),
(168, 'BOLSA 15*18', '2', '0.00'),
(169, 'DEVRO', '2', '0.00'),
(170, 'HOT DOG 18/20', '2', '0.00'),
(171, 'EMPAQUE AMERICANA 26/28', '1', '0.00'),
(172, 'BOLSA JAMON', '2', '0.00'),
(175, 'CORIA 19/50', '2', '0.00'),
(176, 'CORIA 26/50', '2', '0.00'),
(177, 'EMPAQUE MANGUERA', '2', '0.00'),
(179, 'FALDA RES', '0', '0.00'),
(181, 'CONDIMENTO MEGACUNCIA', '1', '0.00'),
(182, 'MEXICANO', '1', '0.00'),
(183, 'COND. HAMBURGUESA DE POLLO', '1', '0.00'),
(184, 'RECORTE  DE RES 80/10', '0', '0.00'),
(185, 'CERDO-MURILLO', '0', '0.00'),
(186, 'rabos de cebolla', '1', '0.00'),
(187, 'BRAZO', '0', '0.00'),
(188, ' CON. SANTA ROSANO', '1', '0.00'),
(189, 'CON.ALBONDIGA', '1', '0.00'),
(190, 'COND.JAMON', '1', '0.00'),
(193, 'DISCOFAN 28*50', '1', '0.00'),
(194, 'FIBRA DE TRIGO', '1', '0.00'),
(195, 'COND.COSTILLA', '1', '0.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario_empaque_vacio`
--

CREATE TABLE IF NOT EXISTS `inventario_empaque_vacio` (
  `id` int(11) unsigned NOT NULL,
  `fecha` varchar(150) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `inventario_empaque_vacio`
--

INSERT INTO `inventario_empaque_vacio` (`id`, `fecha`) VALUES
(1, '2016-08-16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipio`
--

CREATE TABLE IF NOT EXISTS `municipio` (
  `coddane` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `municipio` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `departamento` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal`
--

CREATE TABLE IF NOT EXISTS `personal` (
  `id` int(255) unsigned NOT NULL,
  `nombres` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cedula` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `correo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Personas que van a utilizar el aplicativo';

--
-- Volcado de datos para la tabla `personal`
--

INSERT INTO `personal` (`id`, `nombres`, `cedula`, `correo`, `user_id`) VALUES
(5, 'juan', '1234', 'j@as.com', 22),
(6, 'juanc', '12222', 'asfq12@asf.com', 31),
(7, 'BRAYAN GONZALEZ', '1022412942', 'brayangmega@gmail.com', 32),
(8, 'carlos carrasquilla', '79632804', 'jklidcarrasquilla@hotmail.com', 33),
(9, 'ANDRES', '1024582122', 'tellezdaniel@misena.edu.co', 1024582122);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE IF NOT EXISTS `producto` (
  `id` int(11) unsigned NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cantidad` decimal(10,0) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `nombre`, `cantidad`) VALUES
(1, 'CHORIZO DE TERNERA', '0'),
(2, 'CHORIZO DE POLLO', '0'),
(3, 'CHORIZO PICANTE', '0'),
(4, 'CHORIZO PREMIUM', '0'),
(5, 'CHORIZO CRIOLLO', '0'),
(6, 'CHORIZO TRADICIONAL AHUMADO', '0'),
(7, 'CHORIZO MIXTO AHUMADO', '0'),
(10, 'CHORIZO PAISA', '0'),
(11, 'CHORIZO ESPECIAL AHUMADO', '0'),
(12, 'CHORIZO ESPECIAL CRUDO', '0'),
(13, 'CHORIZO CERDO CRUDO', '0'),
(15, 'LONGANIZA', '0'),
(16, 'MORTADELA', '0'),
(17, 'JAMON', '0'),
(18, 'JAMON MEDIA', '0'),
(19, 'JAMON 2,5', '0'),
(20, 'JAMON PIERNA', '0'),
(23, 'TOCINETA LIBRA', '0'),
(24, 'TOCINETA MEDIA', '0'),
(25, 'TOCINETA CUARTO', '0'),
(26, 'VILLAO POR 3', '0'),
(27, 'VILLAO POR 5', '0'),
(28, 'VILLAO POR 6', '0'),
(29, 'COSTILLA MEDIA', '0'),
(30, 'COSTILLA LIBRA', '0'),
(31, 'SALCHICHA TIPO AMERICANA', '0'),
(32, 'SALCHICHA HOT DOG', '0'),
(33, 'SALCHICHA TIPO RANCHERA', '0'),
(34, 'SALCHICHA MANGUERA X 8', '0'),
(35, 'SALCHICHA MINI MANGUERA', '0'),
(36, 'SALCHICHA MANGUERA X 16', '0'),
(37, 'SALCHICHON KILO', '0'),
(38, 'SALCHICHON 500', '0'),
(39, 'POLLO RELLENO', '0'),
(40, 'CENAS NAVIDEÑAS', '0'),
(41, 'CHORIZO MIXTO CLASICO CRUDO', '23480'),
(43, 'CHORIZO CERDO AHUMADO', '0'),
(45, 'CHORIZO CLASICO PRECOCIDO', '0'),
(47, 'HAMBURGUESA DE POLLO', '0'),
(48, 'CHORIZO COCTEL', '0'),
(49, 'ALBONDIGA ', '0'),
(50, 'HAMBURGUESA DE RES', '0'),
(51, 'SALCHICHA MANGUERA', '0'),
(52, 'JAMON DE CERDO', '0'),
(53, 'JAMON YORK', '0'),
(54, 'CHORIZO VILLAVICECIO NARANJA', '0'),
(55, 'JAMON DE PERNIL', '0'),
(56, 'PASTA DE CARNE', '0'),
(57, 'PASTA DE POLLO', '0'),
(58, 'PAVO RELLENO', '0'),
(59, 'SALCHICHON', '0'),
(60, 'TOCINETA', '0'),
(61, 'SALCHICHA RANCHERA', '0'),
(62, 'CHORIZO MEGA CUNCIA', '0'),
(63, 'santa rosano x 10', '0'),
(64, 'megacuncia', '0'),
(65, 'PIMENTON', '0'),
(66, 'PAPAS FRITAS', '0'),
(68, 'FIBRA DE TRIGO', '0'),
(69, 'SANTA ROSANO', '0'),
(70, 'CERDO AHUMADO COLAGENO', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE IF NOT EXISTS `proveedor` (
  `id` int(11) unsigned NOT NULL,
  `nom_proveedor` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `tipo_proveedor` enum('0','1') COLLATE utf8_unicode_ci NOT NULL COMMENT '0 = empresa\n1 = particular',
  `correo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `celular` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `direccion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tipo_doc` enum('0','1','2') COLLATE utf8_unicode_ci NOT NULL COMMENT '0 = cedula\n1 = extranjeria\n2 = otro',
  `cedula` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `municipio_id` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `codigo_base` char(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tipo` enum('0','1') COLLATE utf8_unicode_ci NOT NULL COMMENT '0 = Carnico\n1 = No Carnico',
  `estado` enum('0','1') CHARACTER SET latin1 NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`id`, `nom_proveedor`, `tipo_proveedor`, `correo`, `celular`, `direccion`, `tipo_doc`, `cedula`, `municipio_id`, `codigo_base`, `tipo`, `estado`) VALUES
(2, 'ALIRIO CASALLAS', '0', '', '', '', '0', '', '', 'CS', '0', '1'),
(3, 'CANTABRIA', '0', '', '', '', '0', '', '', 'CT', '0', '1'),
(4, 'DANIEL PACHON', '0', NULL, NULL, NULL, '0', NULL, NULL, 'DP', '0', '1'),
(5, 'PORCINARNES', '0', NULL, NULL, NULL, '0', NULL, NULL, 'PC', '0', '1'),
(6, 'TORETOS', '0', NULL, NULL, NULL, '0', NULL, NULL, 'TR', '0', '1'),
(7, 'WILMER GORDILLO', '0', NULL, NULL, NULL, '0', NULL, NULL, 'WG', '0', '1'),
(9, 'CIALTA', '0', NULL, NULL, NULL, '0', NULL, NULL, 'CL', '0', '1'),
(10, 'ORLANDO MORENO', '0', NULL, NULL, NULL, '0', NULL, NULL, 'OM', '0', '1'),
(11, 'WILIAM RODRIGUEZ', '0', NULL, NULL, NULL, '0', NULL, NULL, 'WR', '0', '1'),
(12, 'MIILLER VARGAS', '0', NULL, NULL, NULL, '0', NULL, NULL, 'MV', '0', '1'),
(13, 'JORGE CASTIBLANCO', '0', NULL, NULL, NULL, '0', NULL, NULL, 'JC', '0', '1'),
(14, 'GENUINOS', '0', NULL, NULL, NULL, '0', NULL, NULL, 'GN', '0', '1'),
(15, 'CERCAFE', '0', NULL, NULL, NULL, '0', NULL, NULL, 'CR', '0', '1'),
(16, 'FREDY ACEVEDO', '0', NULL, NULL, NULL, '0', NULL, NULL, 'FA', '0', '1'),
(17, 'ABASTOS', '0', NULL, NULL, NULL, '0', NULL, NULL, 'CB', '0', '1'),
(19, 'HIELOS IGLU/ ARTICO', '0', NULL, NULL, NULL, '0', NULL, NULL, 'HI', '0', '1'),
(20, 'BUCANERO', '0', NULL, NULL, NULL, '0', NULL, NULL, 'BC', '0', '1'),
(21, 'EDWARD PATIÑO', '0', NULL, NULL, NULL, '0', NULL, NULL, 'EP', '0', '1'),
(22, 'SURTIVALE', '0', NULL, NULL, NULL, '0', NULL, NULL, 'SV', '0', '1'),
(23, 'EDGAR PEREZ', '0', NULL, NULL, NULL, '0', NULL, NULL, 'XP', '0', '1'),
(24, 'GRUPO AL', '0', NULL, NULL, NULL, '0', NULL, NULL, 'GA', '0', '1'),
(25, 'POLO JARA', '0', NULL, NULL, NULL, '0', NULL, NULL, 'PJ', '0', '1'),
(26, 'SANTA SOFIA', '0', NULL, NULL, NULL, '0', NULL, NULL, 'SF', '0', '1'),
(27, 'MARK POLLO', '0', NULL, NULL, NULL, '0', NULL, NULL, 'MK', '0', '1'),
(28, 'INDUSTRIAS ESPINOSA', '0', NULL, NULL, NULL, '0', NULL, NULL, 'IE', '0', '1'),
(29, 'PLASMALIQ', '0', NULL, NULL, NULL, '0', NULL, NULL, 'PL', '0', '1'),
(30, 'JORGE CASTIBLANCO', '0', NULL, NULL, NULL, '0', NULL, NULL, 'JC', '0', '1'),
(31, 'TECNAS', '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, '1', '1'),
(33, 'CI TALSA', '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, '1', '1'),
(34, 'DELTAGEN', '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, '1', '1'),
(35, 'TECNO FOOD', '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, '1', '1'),
(36, 'GLORIA JIMENEZ', '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, '1', '1'),
(37, 'A&R EXPORT', '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, '1', '1'),
(38, 'CONDITA', '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, '1', '1'),
(39, 'AGRO LECHERO', '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, '1', '1'),
(40, 'CIMPA', '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, '1', '1'),
(41, 'QUIMICA AROMATICA', '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, '1', '1'),
(42, 'SURTI QUIMICOS', '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, '1', '1'),
(43, 'SOLUCIONES ALIMENTARIAS', '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, '1', '1'),
(44, 'CALIER DE COLOMBIA', '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, '1', '1'),
(45, 'CONDIMPORTADOS', '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, '1', '1'),
(46, 'GYC', '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, '1', '1'),
(47, 'ELIZABETH NUÑEZ', '0', '', '', '', '0', '', '', 'EN', '0', '1'),
(48, 'JUAN DIEGO', '0', NULL, NULL, NULL, '0', NULL, NULL, 'JD', '0', '1'),
(49, 'FENTEX', '0', NULL, NULL, NULL, '0', NULL, NULL, 'FX', '0', '1'),
(50, 'LA FAZENDA', '0', NULL, NULL, NULL, '0', NULL, NULL, 'FZ', '0', '1'),
(51, 'LUCY POLLO', '0', NULL, NULL, NULL, '0', NULL, NULL, 'LY', '0', '1'),
(52, 'JUAN CARLOS GONZALEZ', '0', NULL, NULL, NULL, '0', NULL, NULL, 'JK', '0', '1'),
(54, 'DON POLO', '0', NULL, NULL, NULL, '0', NULL, NULL, 'PJ', '0', '1'),
(55, 'HIELOS DEL SUR', '0', NULL, NULL, NULL, '0', NULL, NULL, 'HL', '0', '1'),
(56, 'ANDRES MARTINEZ', '0', NULL, NULL, NULL, '0', NULL, NULL, 'AM', '0', '1'),
(57, 'LA PREMIUM', '0', NULL, NULL, NULL, '0', NULL, NULL, 'LP', '0', '1'),
(58, 'CENTRO AGROLECHERO', '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, '1', '1'),
(59, 'LA NIEVE', '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, '1', '1'),
(62, 'PLASTICOS GYC', '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, '1', '1'),
(63, 'TAUSSING', '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, '1', '1'),
(64, 'FREDY MORENO', '0', NULL, NULL, NULL, '0', NULL, NULL, 'FM', '0', '1'),
(65, 'MEGA', '0', '', '', '', '0', '', '', 'MEG', '0', '1'),
(70, ' MAGROS CARNES', '0', NULL, NULL, NULL, '0', NULL, NULL, 'MC', '0', '1'),
(71, 'BONANZA ', '0', NULL, NULL, NULL, '', NULL, NULL, 'BN', '0', '1'),
(72, 'mercantil continental', '0', '', '', '', '0', '', '', '', '1', '1'),
(73, 'CORABASTOS', '0', '', '', '', '0', '', '', '', '1', '1'),
(74, 'CELO', '0', '', '', '', '0', '', '', 'CC', '0', '1'),
(75, 'OWALVO GUARIN', '0', '', '', '', '0', '', '', 'OG', '0', '1'),
(76, 'CARLOS FORERO', '0', '', '', '', '0', '', '', 'CF', '0', '1'),
(77, 'RAPIPAPA', '0', '', '', '', '0', '', '', '', '1', '1'),
(78, 'MEGAS', '0', '', '', '', '0', '', '', '', '1', '1'),
(79, 'PERLA DEL OTUM', '0', '', '', '', '0', '', '', 'PO', '1', '1'),
(80, 'COMESTIBLES RICOS SAS', '0', '', '', '', '0', '', '', 'CR', '1', '1'),
(82, 'RETAIL', '0', '', '', '', '0', '', '', 'RR', '0', '1'),
(83, 'LELO', '0', '', '', '', '0', '', '', 'LL', '0', '1'),
(84, 'TULIO PRIETO', '0', '', '', '', '0', '', '', 'TP', '0', '1'),
(85, 'SARMICARNES', '0', '', '', '', '0', '', '', 'SC', '0', '1'),
(86, 'PASTA RES', '0', '', '', '', '0', '', '', 'PR', '0', '1'),
(87, 'MEGA PASTA', '0', '', '', '', '0', '', '', 'MP', '0', '1'),
(88, 'MIGUEL GARZON', '0', '', '', '', '0', '', '', 'MG', '0', '1'),
(89, 'GUADALUPE', '0', '', '', '', '0', '', '', 'GL', '0', '1'),
(90, 'VALERIA', '0', '', '', '', '0', '', '', 'VD', '0', '1'),
(91, 'ALEJANDRO', '0', '', '', '', '0', '', '', 'AL', '0', '1'),
(92, 'ALICO', '0', '', '', '', '0', '', '', 'ALI', '1', '1'),
(93, 'SAN LUIS', '0', '', '', '', '0', '', '', 'SL', '1', '1'),
(94, 'ANDRES', '0', '', '', '', '0', '', '', 'AC', '0', '1'),
(95, 'HARINA DE TRIGO', '0', '', '', '', '0', '', '', '', '1', '1'),
(96, 'TRICOLSAS', '0', '', '', '', '0', '', '', '', '1', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor_insumo`
--

CREATE TABLE IF NOT EXISTS `proveedor_insumo` (
  `id` int(11) unsigned NOT NULL,
  `insumo_id` int(11) unsigned NOT NULL,
  `proveedor_id` int(11) unsigned NOT NULL,
  `cantidad` decimal(10,2) unsigned NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB AUTO_INCREMENT=383 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `proveedor_insumo`
--

INSERT INTO `proveedor_insumo` (`id`, `insumo_id`, `proveedor_id`, `cantidad`) VALUES
(149, 14, 7, '0.00'),
(159, 46, 52, '0.00'),
(162, 1, 47, '0.00'),
(168, 78, 11, '0.00'),
(175, 31, 50, '0.00'),
(181, 75, 4, '0.00'),
(229, 75, 50, '0.00'),
(230, 14, 47, '0.00'),
(231, 74, 7, '0.00'),
(232, 1, 7, '0.00'),
(233, 74, 23, '0.00'),
(234, 1, 23, '0.00'),
(235, 74, 4, '0.00'),
(236, 1, 4, '0.00'),
(238, 1, 11, '0.00'),
(239, 76, 3, '0.00'),
(240, 1, 3, '0.00'),
(241, 21, 10, '0.00'),
(242, 1, 10, '0.00'),
(243, 1, 50, '0.00'),
(244, 185, 47, '0.00'),
(245, 21, 74, '0.00'),
(246, 1, 74, '0.00'),
(247, 21, 26, '0.00'),
(248, 1, 26, '0.00'),
(249, 21, 75, '254.00'),
(250, 1, 75, '0.00'),
(251, 21, 64, '0.00'),
(252, 1, 64, '0.00'),
(253, 31, 7, '0.00'),
(254, 31, 47, '0.00'),
(255, 31, 76, '0.00'),
(256, 1, 76, '0.00'),
(257, 31, 9, '0.00'),
(258, 1, 9, '0.00'),
(259, 75, 7, '0.00'),
(260, 75, 23, '0.00'),
(261, 73, 38, '0.00'),
(262, 56, 44, '0.00'),
(263, 120, 40, '0.00'),
(264, 43, 31, '0.00'),
(265, 8, 77, '0.00'),
(266, 18, 73, '0.00'),
(268, 5, 78, '0.00'),
(269, 127, 45, '0.00'),
(270, 122, 72, '0.00'),
(271, 60, 45, '0.00'),
(272, 54, 39, '0.00'),
(273, 49, 73, '0.00'),
(274, 78, 7, '0.00'),
(275, 186, 73, '0.00'),
(276, 51, 29, '0.00'),
(278, 112, 45, '0.00'),
(279, 112, 79, '0.00'),
(280, 95, 45, '0.00'),
(281, 69, 79, '0.00'),
(282, 40, 72, '0.00'),
(283, 28, 45, '0.00'),
(284, 7, 35, '0.00'),
(285, 8, 35, '0.00'),
(286, 63, 58, '153.00'),
(288, 73, 39, '0.00'),
(289, 74, 28, '0.00'),
(290, 31, 10, '0.00'),
(291, 8, 80, '0.00'),
(292, 112, 36, '0.00'),
(293, 74, 11, '0.00'),
(294, 76, 50, '0.00'),
(295, 187, 50, '0.00'),
(296, 17, 81, '0.00'),
(299, 31, 75, '0.00'),
(300, 2, 24, '0.00'),
(301, 45, 24, '0.00'),
(302, 52, 82, '0.00'),
(303, 17, 25, '0.00'),
(304, 21, 4, '0.00'),
(305, 75, 11, '0.00'),
(306, 21, 83, '0.00'),
(307, 31, 56, '0.00'),
(308, 75, 84, '0.00'),
(309, 31, 85, '0.00'),
(310, 47, 86, '0.00'),
(311, 46, 87, '0.00'),
(312, 31, 88, '0.00'),
(313, 8, 40, '0.00'),
(314, 57, 31, '0.00'),
(318, 124, 45, '0.00'),
(320, 96, 45, '0.00'),
(321, 101, 45, '0.00'),
(322, 107, 45, '0.00'),
(323, 135, 45, '0.00'),
(325, 90, 45, '0.00'),
(326, 129, 45, '0.00'),
(327, 131, 45, '0.00'),
(328, 132, 45, '0.00'),
(329, 98, 45, '0.00'),
(330, 109, 45, '0.00'),
(331, 134, 45, '0.00'),
(332, 181, 45, '0.00'),
(333, 188, 45, '0.00'),
(334, 92, 45, '0.00'),
(335, 189, 45, '0.00'),
(336, 130, 45, '0.00'),
(337, 102, 45, '0.00'),
(338, 20, 73, '0.00'),
(339, 74, 84, '0.00'),
(340, 38, 55, '0.00'),
(341, 21, 85, '0.00'),
(342, 31, 83, '0.00'),
(343, 74, 2, '0.00'),
(344, 75, 2, '0.00'),
(346, 17, 88, '0.00'),
(347, 21, 52, '0.00'),
(348, 75, 89, '0.00'),
(349, 78, 4, '0.00'),
(350, 78, 25, '0.00'),
(351, 75, 28, '0.00'),
(352, 31, 28, '0.00'),
(353, 21, 50, '0.00'),
(354, 21, 90, '0.00'),
(355, 31, 91, '0.00'),
(356, 21, 7, '0.00'),
(358, 152, 70, '0.00'),
(360, 176, 36, '0.00'),
(361, 113, 36, '0.00'),
(364, 175, 36, '0.00'),
(365, 193, 36, '0.00'),
(366, 21, 71, '0.00'),
(367, 31, 21, '0.00'),
(368, 121, 93, '0.00'),
(369, 63, 39, '0.00'),
(370, 194, 39, '0.00'),
(371, 195, 45, '0.00'),
(372, 74, 9, '0.00'),
(373, 75, 94, '0.00'),
(374, 21, 82, '0.00'),
(375, 194, 35, '0.00'),
(376, 123, 72, '0.00'),
(377, 121, 95, '0.00'),
(378, 91, 45, '0.00'),
(379, 112, 96, '0.00'),
(380, 86, 31, '0.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recepcion_materia_prima_carnica`
--

CREATE TABLE IF NOT EXISTS `recepcion_materia_prima_carnica` (
  `id` int(11) unsigned NOT NULL,
  `fec_ingreso` date NOT NULL,
  `lote_interno` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `proveedor` int(11) unsigned NOT NULL,
  `materia_prima_insumo` int(11) unsigned NOT NULL,
  `peso` decimal(15,8) DEFAULT NULL,
  `temperatura_llegada` varchar(10) CHARACTER SET latin1 NOT NULL,
  `carct_orgleptica_color` enum('0','1','NA') COLLATE utf8_unicode_ci NOT NULL,
  `carct_orgleptica_olor` enum('0','1','NA') COLLATE utf8_unicode_ci NOT NULL,
  `carct_orgleptica_c_temperatura` enum('0','1','NA') COLLATE utf8_unicode_ci NOT NULL,
  `hgiene_vehiculo` enum('0','1') COLLATE utf8_unicode_ci NOT NULL,
  `hgiene_canastas` enum('0','1') COLLATE utf8_unicode_ci NOT NULL,
  `conductor_dotacion` enum('0','1','NA') COLLATE utf8_unicode_ci NOT NULL,
  `conductor_higiene` enum('0','1','NA') COLLATE utf8_unicode_ci NOT NULL,
  `devolucion_si_no` enum('0','1') COLLATE utf8_unicode_ci NOT NULL,
  `devolucion_peso` enum('0','1','NA') COLLATE utf8_unicode_ci DEFAULT NULL,
  `recibido` int(11) NOT NULL,
  `observaciones` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=408 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `recepcion_materia_prima_carnica`
--

INSERT INTO `recepcion_materia_prima_carnica` (`id`, `fec_ingreso`, `lote_interno`, `proveedor`, `materia_prima_insumo`, `peso`, `temperatura_llegada`, `carct_orgleptica_color`, `carct_orgleptica_olor`, `carct_orgleptica_c_temperatura`, `hgiene_vehiculo`, `hgiene_canastas`, `conductor_dotacion`, `conductor_higiene`, `devolucion_si_no`, `devolucion_peso`, `recibido`, `observaciones`) VALUES
(407, '2016-08-02', 'OG1', 75, 21, '254.00000000', '3.4', '1', '1', '1', '1', '1', '1', '1', '', '0', 22, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recepcion_materia_prima_no_carnica`
--

CREATE TABLE IF NOT EXISTS `recepcion_materia_prima_no_carnica` (
  `id` int(11) unsigned NOT NULL,
  `fec_ingreso` date NOT NULL,
  `lote_interno` int(11) unsigned NOT NULL DEFAULT '0',
  `fec_vencimiento` date NOT NULL,
  `proveedor_id` int(11) unsigned NOT NULL,
  `materia_prima_insumo` int(11) unsigned NOT NULL,
  `peso_total` decimal(10,3) unsigned NOT NULL,
  `unidades` smallint(11) unsigned NOT NULL,
  `num_lote_externo` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `caract_fisicas_empaque` enum('0','1') COLLATE utf8_unicode_ci NOT NULL,
  `caract_fisicas_rotulado` enum('0','1') COLLATE utf8_unicode_ci NOT NULL,
  `devolucion_si_no` enum('0','1') COLLATE utf8_unicode_ci NOT NULL COMMENT '0 = no\n1 = si',
  `devolucion_peso_unidades` decimal(4,1) unsigned NOT NULL,
  `recibido` int(11) NOT NULL,
  `observaciones` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=166 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `recepcion_materia_prima_no_carnica`
--

INSERT INTO `recepcion_materia_prima_no_carnica` (`id`, `fec_ingreso`, `lote_interno`, `fec_vencimiento`, `proveedor_id`, `materia_prima_insumo`, `peso_total`, `unidades`, `num_lote_externo`, `caract_fisicas_empaque`, `caract_fisicas_rotulado`, `devolucion_si_no`, `devolucion_peso_unidades`, `recibido`, `observaciones`) VALUES
(156, '2016-08-16', 1, '2017-03-06', 58, 63, '160.000', 6, '2082963', '1', '1', '', '0.0', 22, ''),
(157, '2016-08-16', 2, '2016-08-19', 44, 56, '15.000', 4, '5247969', '1', '1', '', '0.0', 22, ''),
(158, '2016-08-16', 3, '2016-08-31', 45, 96, '18.000', 6, 'CONDIMENTO', '1', '1', '', '0.0', 22, ''),
(159, '2016-08-16', 4, '2016-08-31', 45, 112, '21.000', 2, 'MADEJA', '1', '1', '', '0.0', 22, ''),
(160, '2016-08-16', 5, '2016-08-23', 45, 60, '13.000', 3, 'SAL ', '1', '1', '', '0.0', 22, ''),
(161, '2016-08-16', 6, '2016-08-24', 72, 122, '1.000', 1, 'SMOK', '1', '1', '', '0.0', 22, ''),
(162, '2016-08-16', 7, '2016-08-31', 35, 7, '8.000', 3, 'VDFV', '1', '1', '', '0.0', 22, ''),
(163, '2016-08-16', 8, '2016-08-31', 39, 73, '15.000', 2, 'VITACEL', '1', '1', '', '0.0', 22, ''),
(164, '2016-08-16', 9, '2016-08-31', 40, 120, '15.000', 2, 'SOYA', '1', '1', '', '0.0', 22, ''),
(165, '2016-08-16', 10, '2016-08-31', 78, 5, '200.000', 1, 'AGUA', '1', '1', '', '0.0', 22, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rel_reporte_despachos_producto`
--

CREATE TABLE IF NOT EXISTS `rel_reporte_despachos_producto` (
  `id_reporte_despachos` int(11) unsigned NOT NULL,
  `id_producto` int(11) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reporte_control_horneado`
--

CREATE TABLE IF NOT EXISTS `reporte_control_horneado` (
  `id` int(11) unsigned NOT NULL,
  `fecha` date NOT NULL,
  `tanda` smallint(11) unsigned NOT NULL,
  `producto` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `cantidad` int(11) unsigned DEFAULT NULL,
  `averias` smallint(11) unsigned DEFAULT NULL,
  `codigo_reproceso` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `numero_programa` varchar(2) COLLATE utf8_unicode_ci DEFAULT '6',
  `temperatura_salida` int(11) unsigned DEFAULT '63',
  `temperatura_coccion` int(11) unsigned DEFAULT '75',
  `sostenimiento_tiempo` int(11) unsigned DEFAULT '3',
  `sostenimiento_temperatura_interna` int(11) unsigned DEFAULT '74',
  `caract_organoleptica_color` varchar(2) COLLATE utf8_unicode_ci DEFAULT '1',
  `caract_organoleptica_olor` varchar(2) COLLATE utf8_unicode_ci DEFAULT '1',
  `caract_organoleptica_sabor` varchar(2) COLLATE utf8_unicode_ci DEFAULT '1',
  `caract_organoleptica_textura` varchar(2) COLLATE utf8_unicode_ci DEFAULT '1',
  `caract_fisicas_tamano` varchar(2) COLLATE utf8_unicode_ci DEFAULT '1',
  `caract_fisicas_forma` varchar(2) COLLATE utf8_unicode_ci DEFAULT '1',
  `responsable_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `reporte_control_horneado`
--

INSERT INTO `reporte_control_horneado` (`id`, `fecha`, `tanda`, `producto`, `cantidad`, `averias`, `codigo_reproceso`, `numero_programa`, `temperatura_salida`, `temperatura_coccion`, `sostenimiento_tiempo`, `sostenimiento_temperatura_interna`, `caract_organoleptica_color`, `caract_organoleptica_olor`, `caract_organoleptica_sabor`, `caract_organoleptica_textura`, `caract_fisicas_tamano`, `caract_fisicas_forma`, `responsable_id`) VALUES
(1, '2016-08-16', 2016, '41', 11800, 3, '000', '6', 63, 75, 2, 74, '1', '1', '1', '1', '1', '1', 22);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reporte_despachos`
--

CREATE TABLE IF NOT EXISTS `reporte_despachos` (
  `id` int(11) unsigned NOT NULL,
  `fecha_reporte` date NOT NULL,
  `destino` varchar(150) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reporte_empaque_vacio`
--

CREATE TABLE IF NOT EXISTS `reporte_empaque_vacio` (
  `id` int(11) unsigned NOT NULL,
  `fecha` date NOT NULL,
  `producto` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `total_paquetes` smallint(11) unsigned NOT NULL,
  `peso` smallint(11) unsigned NOT NULL,
  `numero_lote` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `carac_fisicas_color` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `carac_fisicas_olor` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `carac_fisicas_tamano` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `carac_fisicas_forma` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `carac_fisicas_exur` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `responsable_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vs_database_diagrams`
--

CREATE TABLE IF NOT EXISTS `vs_database_diagrams` (
  `name` char(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `diadata` text COLLATE utf8_unicode_ci,
  `comment` varchar(1022) COLLATE utf8_unicode_ci DEFAULT NULL,
  `preview` text COLLATE utf8_unicode_ci,
  `lockinfo` char(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `locktime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `version` char(80) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `AuthAssignment`
--
ALTER TABLE `AuthAssignment`
  ADD PRIMARY KEY (`itemname`,`userid`);

--
-- Indices de la tabla `AuthItem`
--
ALTER TABLE `AuthItem`
  ADD PRIMARY KEY (`name`);

--
-- Indices de la tabla `AuthItemChild`
--
ALTER TABLE `AuthItemChild`
  ADD PRIMARY KEY (`parent`,`child`), ADD UNIQUE KEY `child` (`child`), ADD UNIQUE KEY `parent` (`parent`);

--
-- Indices de la tabla `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `averias`
--
ALTER TABLE `averias`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ctrl_producciones_trazabilidad`
--
ALTER TABLE `ctrl_producciones_trazabilidad`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `despachos`
--
ALTER TABLE `despachos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_averias`
--
ALTER TABLE `detalle_averias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_ctrl_producciones`
--
ALTER TABLE `detalle_ctrl_producciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_despacho`
--
ALTER TABLE `detalle_despacho`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_inventario_empaque_vacio`
--
ALTER TABLE `detalle_inventario_empaque_vacio`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `formulacion`
--
ALTER TABLE `formulacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `insumo`
--
ALTER TABLE `insumo`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `materia_prima` (`materia_prima`);

--
-- Indices de la tabla `inventario_empaque_vacio`
--
ALTER TABLE `inventario_empaque_vacio`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `municipio`
--
ALTER TABLE `municipio`
  ADD PRIMARY KEY (`coddane`);

--
-- Indices de la tabla `personal`
--
ALTER TABLE `personal`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `unique_cedula` (`cedula`), ADD UNIQUE KEY `unique_correo` (`correo`), ADD UNIQUE KEY `unique_user_id` (`user_id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proveedor_insumo`
--
ALTER TABLE `proveedor_insumo`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `unico` (`insumo_id`,`proveedor_id`);

--
-- Indices de la tabla `recepcion_materia_prima_carnica`
--
ALTER TABLE `recepcion_materia_prima_carnica`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `recepcion_materia_prima_no_carnica`
--
ALTER TABLE `recepcion_materia_prima_no_carnica`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rel_reporte_despachos_producto`
--
ALTER TABLE `rel_reporte_despachos_producto`
  ADD PRIMARY KEY (`id_producto`,`id_reporte_despachos`), ADD UNIQUE KEY `id_producto` (`id_producto`), ADD UNIQUE KEY `id_reporte_despachos` (`id_reporte_despachos`);

--
-- Indices de la tabla `reporte_control_horneado`
--
ALTER TABLE `reporte_control_horneado`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reporte_despachos`
--
ALTER TABLE `reporte_despachos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reporte_empaque_vacio`
--
ALTER TABLE `reporte_empaque_vacio`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `User`
--
ALTER TABLE `User`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT de la tabla `averias`
--
ALTER TABLE `averias`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=148;
--
-- AUTO_INCREMENT de la tabla `ctrl_producciones_trazabilidad`
--
ALTER TABLE `ctrl_producciones_trazabilidad`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `despachos`
--
ALTER TABLE `despachos`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `detalle_averias`
--
ALTER TABLE `detalle_averias`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `detalle_ctrl_producciones`
--
ALTER TABLE `detalle_ctrl_producciones`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=190;
--
-- AUTO_INCREMENT de la tabla `detalle_despacho`
--
ALTER TABLE `detalle_despacho`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `detalle_inventario_empaque_vacio`
--
ALTER TABLE `detalle_inventario_empaque_vacio`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `formulacion`
--
ALTER TABLE `formulacion`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=753;
--
-- AUTO_INCREMENT de la tabla `insumo`
--
ALTER TABLE `insumo`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=196;
--
-- AUTO_INCREMENT de la tabla `inventario_empaque_vacio`
--
ALTER TABLE `inventario_empaque_vacio`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `personal`
--
ALTER TABLE `personal`
  MODIFY `id` int(255) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=73;
--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=97;
--
-- AUTO_INCREMENT de la tabla `proveedor_insumo`
--
ALTER TABLE `proveedor_insumo`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=383;
--
-- AUTO_INCREMENT de la tabla `recepcion_materia_prima_carnica`
--
ALTER TABLE `recepcion_materia_prima_carnica`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=408;
--
-- AUTO_INCREMENT de la tabla `recepcion_materia_prima_no_carnica`
--
ALTER TABLE `recepcion_materia_prima_no_carnica`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=166;
--
-- AUTO_INCREMENT de la tabla `reporte_control_horneado`
--
ALTER TABLE `reporte_control_horneado`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `reporte_despachos`
--
ALTER TABLE `reporte_despachos`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `reporte_empaque_vacio`
--
ALTER TABLE `reporte_empaque_vacio`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
