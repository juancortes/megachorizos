-- Valentina Studio --
-- MySQL dump --
-- ---------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
-- ---------------------------------------------------------


-- CREATE TABLE "AuthAssignment" ---------------------------
CREATE TABLE `AuthAssignment` ( 
	`itemname` VarChar( 64 ) NOT NULL UNIQUE,
	`userid` VarChar( 64 ) NOT NULL UNIQUE,
	`bizrule` Text NULL,
	`data` Text NULL,
	PRIMARY KEY ( `itemname`, `userid` ) )
ENGINE = InnoDB;
-- ---------------------------------------------------------


-- CREATE TABLE "AuthItem" ---------------------------------
CREATE TABLE `AuthItem` ( 
	`name` VarChar( 64 ) NOT NULL,
	`type` Int( 11 ) NOT NULL,
	`description` Text NULL,
	`bizrule` Text NULL,
	`data` Text NULL,
	PRIMARY KEY ( `name` ) )
ENGINE = InnoDB;
-- ---------------------------------------------------------


-- CREATE TABLE "AuthItemChild" ----------------------------
CREATE TABLE `AuthItemChild` ( 
	`parent` VarChar( 64 ) NOT NULL UNIQUE,
	`child` VarChar( 64 ) NOT NULL UNIQUE,
	PRIMARY KEY ( `parent`, `child` ) )
ENGINE = InnoDB;
-- ---------------------------------------------------------


-- CREATE TABLE "User" -------------------------------------
CREATE TABLE `User` ( 
	`id` Int( 11 ) AUTO_INCREMENT NOT NULL,
	`username` VarChar( 45 ) NULL,
	`password` VarChar( 254 ) NULL,
	`nombres` VarChar( 500 ) NULL,
	`tipo_doc` Int( 11 ) NULL,
	`num_doc` VarChar( 50 ) NOT NULL,
	`typeUser` Int( 11 ) NULL,
	`email` VarChar( 255 ) NULL,
	`estado` Enum( '0', '1' ) NULL DEFAULT '1' COMMENT '0 = Inactivo
1 = Activo',
	PRIMARY KEY ( `id` ) )
ENGINE = InnoDB
AUTO_INCREMENT = 24;
-- ---------------------------------------------------------


-- CREATE TABLE "ctrl_producciones_trazabilidad" -----------
CREATE TABLE `ctrl_producciones_trazabilidad` ( 
	`id` Int( 11 ) UNSIGNED AUTO_INCREMENT NOT NULL,
	`orden_produccion` Int( 11 ) UNSIGNED NOT NULL,
	`fecha` Date NOT NULL,
	`producto` Int( 11 ) UNSIGNED NOT NULL,
	`responsable` VarChar( 255 ) NOT NULL,
	`cant_produccion` TinyInt( 11 ) UNSIGNED NOT NULL DEFAULT '1',
	PRIMARY KEY ( `id` ) )
CHARACTER SET = utf8
COLLATE = utf8_general_ci
ENGINE = InnoDB
AUTO_INCREMENT = 1;
-- ---------------------------------------------------------


-- CREATE TABLE "detalle_ctrl_producciones" ----------------
CREATE TABLE `detalle_ctrl_producciones` ( 
	`id` Int( 11 ) UNSIGNED AUTO_INCREMENT NOT NULL,
	`tipo` Enum( '0', '1' ) NOT NULL COMMENT '0 = No carnica
1 = Carnica
',
	`lote_interno` VarChar( 255 ) NULL,
	`ctrl_producciones_id` Int( 11 ) UNSIGNED NOT NULL,
	`cantidad` Double( 10, 2 ) UNSIGNED NOT NULL,
	`insumo_id` Int( 11 ) UNSIGNED NOT NULL,
	`proveedor_id` Int( 11 ) UNSIGNED NULL,
	PRIMARY KEY ( `id` ) )
CHARACTER SET = utf8
COLLATE = utf8_general_ci
ENGINE = InnoDB
AUTO_INCREMENT = 1;
-- ---------------------------------------------------------


-- CREATE TABLE "formulacion" ------------------------------
CREATE TABLE `formulacion` ( 
	`id` Int( 11 ) UNSIGNED AUTO_INCREMENT NOT NULL,
	`producto_id` Int( 11 ) UNSIGNED NOT NULL,
	`materia_prima` Int( 11 ) UNSIGNED NOT NULL,
	`peso` Decimal( 10, 2 ) UNSIGNED NOT NULL,
	PRIMARY KEY ( `id` ) )
CHARACTER SET = utf8
COLLATE = utf8_general_ci
ENGINE = InnoDB
AUTO_INCREMENT = 684;
-- ---------------------------------------------------------


-- CREATE TABLE "insumo" -----------------------------------
CREATE TABLE `insumo` ( 
	`id` Int( 11 ) UNSIGNED AUTO_INCREMENT NOT NULL,
	`materia_prima` VarChar( 255 ) NOT NULL,
	`tipo` Enum( '0', '1', '2' ) NOT NULL COMMENT '0 = Carnica
1 = No Carnica
2 = Insumo',
	`cantidad` Decimal( 10, 2 ) UNSIGNED NOT NULL DEFAULT '0.00',
	PRIMARY KEY ( `id` ),
	CONSTRAINT `materia_prima` UNIQUE( `materia_prima` ) )
CHARACTER SET = utf8
COLLATE = utf8_general_ci
ENGINE = InnoDB
AUTO_INCREMENT = 184;
-- ---------------------------------------------------------


-- CREATE TABLE "inventario_empaque_vacio" -----------------
CREATE TABLE `inventario_empaque_vacio` ( 
	`id` Int( 11 ) UNSIGNED AUTO_INCREMENT NOT NULL,
	`producto` VarChar( 50 ) NOT NULL,
	`unidad` Int( 11 ) UNSIGNED NOT NULL,
	`lote` VarChar( 20 ) NOT NULL,
	`a` VarChar( 2 ) NOT NULL,
	PRIMARY KEY ( `id` ) )
CHARACTER SET = utf8
COLLATE = utf8_general_ci
ENGINE = InnoDB
AUTO_INCREMENT = 1;
-- ---------------------------------------------------------


-- CREATE TABLE "municipio" --------------------------------
CREATE TABLE `municipio` ( 
	`coddane` VarChar( 8 ) NOT NULL,
	`municipio` VarChar( 255 ) NOT NULL,
	`departamento` VarChar( 255 ) NOT NULL,
	PRIMARY KEY ( `coddane` ) )
CHARACTER SET = utf8
COLLATE = utf8_general_ci
ENGINE = InnoDB;
-- ---------------------------------------------------------


-- CREATE TABLE "producto" ---------------------------------
CREATE TABLE `producto` ( 
	`id` Int( 11 ) UNSIGNED AUTO_INCREMENT NOT NULL,
	`nombre` VarChar( 255 ) NOT NULL,
	`cantidad` Decimal( 10, 0 ) UNSIGNED NOT NULL DEFAULT '0',
	PRIMARY KEY ( `id` ),
	CONSTRAINT `nombre` UNIQUE( `nombre` ) )
CHARACTER SET = utf8
COLLATE = utf8_general_ci
ENGINE = InnoDB
AUTO_INCREMENT = 63;
-- ---------------------------------------------------------


-- CREATE TABLE "proveedor" --------------------------------
CREATE TABLE `proveedor` ( 
	`id` Int( 11 ) UNSIGNED AUTO_INCREMENT NOT NULL,
	`nom_proveedor` VarChar( 100 ) NOT NULL,
	`tipo_proveedor` Enum( '0', '1' ) NOT NULL COMMENT '0 = empresa
1 = particular',
	`correo` VarChar( 255 ) NULL,
	`celular` VarChar( 30 ) NULL,
	`direccion` VarChar( 255 ) NULL,
	`tipo_doc` Enum( '0', '1', '2' ) NOT NULL COMMENT '0 = cedula
1 = extranjeria
2 = otro',
	`cedula` VarChar( 50 ) NULL,
	`municipio_id` VarChar( 8 ) NULL,
	`codigo_base` Char( 3 ) NULL,
	`tipo` Enum( '0', '1' ) NOT NULL COMMENT '0 = Carnico
1 = No Carnico',
	PRIMARY KEY ( `id` ) )
CHARACTER SET = utf8
COLLATE = utf8_general_ci
ENGINE = InnoDB
AUTO_INCREMENT = 72;
-- ---------------------------------------------------------


-- CREATE TABLE "proveedor_insumo" -------------------------
CREATE TABLE `proveedor_insumo` ( 
	`id` Int( 11 ) UNSIGNED AUTO_INCREMENT NOT NULL,
	`insumo_id` Int( 11 ) UNSIGNED NOT NULL UNIQUE,
	`proveedor_id` Int( 11 ) UNSIGNED NOT NULL UNIQUE,
	`cantidad` Decimal( 10, 2 ) UNSIGNED NOT NULL DEFAULT '0.00',
	PRIMARY KEY ( `id` ),
	CONSTRAINT `unico` UNIQUE( `insumo_id`, `proveedor_id` ) )
CHARACTER SET = utf8
COLLATE = utf8_general_ci
ENGINE = InnoDB
AUTO_INCREMENT = 293;
-- ---------------------------------------------------------


-- CREATE TABLE "recepcion_materia_prima_carnica" ----------
CREATE TABLE `recepcion_materia_prima_carnica` ( 
	`id` Int( 11 ) UNSIGNED AUTO_INCREMENT NOT NULL,
	`fec_ingreso` Date NOT NULL,
	`lote_interno` VarChar( 100 ) NOT NULL,
	`proveedor` Int( 11 ) UNSIGNED NOT NULL,
	`materia_prima_insumo` Int( 11 ) UNSIGNED NOT NULL,
	`peso` Decimal( 4, 1 ) UNSIGNED NOT NULL,
	`temperatura_llegada` Decimal( 2, 1 ) NOT NULL,
	`carct_orgleptica_color` Enum( '0', '1', 'NA' ) NOT NULL,
	`carct_orgleptica_olor` Enum( '0', '1', 'NA' ) NOT NULL,
	`carct_orgleptica_c_temperatura` Enum( '0', '1', 'NA' ) NOT NULL,
	`hgiene_vehiculo` Enum( '0', '1' ) NOT NULL,
	`hgiene_canastas` Enum( '0', '1' ) NOT NULL,
	`conductor_dotacion` Enum( '0', '1', 'NA' ) NOT NULL,
	`conductor_higiene` Enum( '0', '1', 'NA' ) NOT NULL,
	`devolucion_si_no` Enum( '0', '1' ) NOT NULL,
	`devolucion_peso` Enum( '0', '1', 'NA' ) NULL,
	`recibido` Int( 11 ) NOT NULL,
	`observaciones` VarChar( 255 ) NULL,
	PRIMARY KEY ( `id` ) )
CHARACTER SET = utf8
COLLATE = utf8_general_ci
ENGINE = InnoDB
AUTO_INCREMENT = 11;
-- ---------------------------------------------------------


-- CREATE TABLE "recepcion_materia_prima_no_carnica" -------
CREATE TABLE `recepcion_materia_prima_no_carnica` ( 
	`id` Int( 11 ) UNSIGNED AUTO_INCREMENT NOT NULL,
	`fec_ingreso` Date NOT NULL,
	`lote_interno` Int( 11 ) UNSIGNED NOT NULL DEFAULT '0',
	`fec_vencimiento` Date NOT NULL,
	`proveedor_id` Int( 11 ) UNSIGNED NOT NULL,
	`materia_prima_insumo` Int( 11 ) UNSIGNED NOT NULL,
	`peso_total` Int( 11 ) UNSIGNED NOT NULL,
	`unidades` Smallint( 11 ) UNSIGNED NOT NULL,
	`num_lote_externo` VarChar( 100 ) NOT NULL,
	`caract_fisicas_empaque` Enum( '0', '1' ) NOT NULL,
	`caract_fisicas_rotulado` Enum( '0', '1' ) NOT NULL,
	`devolucion_si_no` Enum( '0', '1' ) NOT NULL COMMENT '0 = no
1 = si',
	`devolucion_peso_unidades` Decimal( 4, 1 ) UNSIGNED NOT NULL,
	`recibido` Int( 11 ) NOT NULL,
	`observaciones` VarChar( 255 ) NULL,
	PRIMARY KEY ( `id` ) )
CHARACTER SET = utf8
COLLATE = utf8_general_ci
ENGINE = InnoDB
AUTO_INCREMENT = 2;
-- ---------------------------------------------------------


-- CREATE TABLE "reporte_control_horneado" -----------------
CREATE TABLE `reporte_control_horneado` ( 
	`id` Int( 11 ) UNSIGNED AUTO_INCREMENT NOT NULL,
	`fecha` Date NOT NULL,
	`tanda` Smallint( 11 ) UNSIGNED NOT NULL,
	`producto` VarChar( 100 ) NOT NULL,
	`cantidad` Int( 11 ) UNSIGNED NULL,
	`averias` Smallint( 11 ) UNSIGNED NULL,
	`codigo_reproceso` VarChar( 50 ) NULL,
	`numero_programa` VarChar( 2 ) NULL DEFAULT '6',
	`temperatura_salida` Int( 11 ) UNSIGNED NULL DEFAULT '63',
	`temperatura_coccion` Int( 11 ) UNSIGNED NULL DEFAULT '75',
	`sostenimiento_tiempo` Int( 11 ) UNSIGNED NULL DEFAULT '3',
	`sostenimiento_temperatura_interna` Int( 11 ) UNSIGNED NULL DEFAULT '74',
	`caract_organoleptica_color` VarChar( 2 ) NULL DEFAULT '1',
	`caract_organoleptica_olor` VarChar( 2 ) NULL DEFAULT '1',
	`caract_organoleptica_sabor` VarChar( 2 ) NULL DEFAULT '1',
	`caract_organoleptica_textura` VarChar( 2 ) NULL DEFAULT '1',
	`caract_fisicas_tamano` VarChar( 2 ) NULL DEFAULT '1',
	`caract_fisicas_forma` VarChar( 2 ) NULL DEFAULT '1',
	`responsable_id` Int( 11 ) NOT NULL,
	PRIMARY KEY ( `id` ) )
CHARACTER SET = utf8
COLLATE = utf8_general_ci
ENGINE = InnoDB
AUTO_INCREMENT = 2;
-- ---------------------------------------------------------


-- CREATE TABLE "reporte_empaque_vacio" --------------------
CREATE TABLE `reporte_empaque_vacio` ( 
	`id` Int( 11 ) UNSIGNED AUTO_INCREMENT NOT NULL,
	`fecha` Date NOT NULL,
	`producto` VarChar( 100 ) NOT NULL,
	`total_paquetes` Smallint( 11 ) UNSIGNED NOT NULL,
	`peso` Smallint( 11 ) UNSIGNED NOT NULL,
	`numero_lote` VarChar( 100 ) NOT NULL,
	`carac_fisicas_color` VarChar( 2 ) NOT NULL,
	`carac_fisicas_olor` VarChar( 2 ) NOT NULL,
	`carac_fisicas_tamano` VarChar( 2 ) NOT NULL,
	`carac_fisicas_forma` VarChar( 2 ) NOT NULL,
	`carac_fisicas_exur` VarChar( 2 ) NOT NULL,
	`responsable_id` Int( 11 ) NOT NULL,
	PRIMARY KEY ( `id` ) )
CHARACTER SET = utf8
COLLATE = utf8_general_ci
ENGINE = InnoDB
AUTO_INCREMENT = 2;
-- ---------------------------------------------------------


-- CREATE TABLE "vs_database_diagrams" ---------------------
CREATE TABLE `vs_database_diagrams` ( 
	`name` Char( 80 ) NULL,
	`diadata` Text NULL,
	`comment` VarChar( 1022 ) NULL,
	`preview` Text NULL,
	`lockinfo` Char( 80 ) NULL,
	`locktime` Timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	`version` Char( 80 ) NULL )
ENGINE = MyISAM;
-- ---------------------------------------------------------


-- Dump data of "AuthAssignment" ---------------------------
INSERT INTO `AuthAssignment`(`itemname`,`userid`,`bizrule`,`data`) VALUES ( 'admin', 'admin', NULL, NULL );
INSERT INTO `AuthAssignment`(`itemname`,`userid`,`bizrule`,`data`) VALUES ( 'Admin1', 'jadmin', NULL, NULL );
-- ---------------------------------------------------------


-- Dump data of "AuthItem" ---------------------------------
INSERT INTO `AuthItem`(`name`,`type`,`description`,`bizrule`,`data`) VALUES ( 'admin', '2', '', NULL, NULL );
INSERT INTO `AuthItem`(`name`,`type`,`description`,`bizrule`,`data`) VALUES ( 'Admin1', '0', NULL, NULL, NULL );
-- ---------------------------------------------------------


-- Dump data of "AuthItemChild" ----------------------------
-- ---------------------------------------------------------


-- Dump data of "User" -------------------------------------
INSERT INTO `User`(`id`,`username`,`password`,`nombres`,`tipo_doc`,`num_doc`,`typeUser`,`email`,`estado`) VALUES ( '22', 'jadmin', 'Asdf1234$', 'juanito', NULL, '', NULL, NULL, '' );
INSERT INTO `User`(`id`,`username`,`password`,`nombres`,`tipo_doc`,`num_doc`,`typeUser`,`email`,`estado`) VALUES ( '23', 'admin', '123', 'Usuario Mega', NULL, '', NULL, NULL, '1' );
-- ---------------------------------------------------------


-- Dump data of "ctrl_producciones_trazabilidad" -----------
-- ---------------------------------------------------------


-- Dump data of "detalle_ctrl_producciones" ----------------
-- ---------------------------------------------------------


-- Dump data of "formulacion" ------------------------------
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '357', '61', '60', '0.30' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '358', '61', '28', '0.50' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '359', '61', '94', '0.20' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '360', '61', '8', '0.20' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '361', '61', '63', '0.08' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '362', '61', '51', '1.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '363', '61', '38', '4.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '365', '31', '60', '0.30' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '366', '31', '28', '0.50' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '367', '31', '94', '0.20' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '368', '31', '8', '0.20' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '369', '31', '63', '0.08' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '370', '31', '51', '1.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '371', '31', '38', '2.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '372', '31', '5', '3.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '374', '43', '18', '2.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '375', '43', '28', '2.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '376', '43', '60', '1.80' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '377', '43', '69', '3.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '378', '43', '40', '0.10' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '379', '43', '56', '2.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '380', '43', '5', '33.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '381', '43', '8', '6.50' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '382', '43', '73', '2.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '383', '43', '49', '2.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '384', '43', '63', '0.30' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '385', '43', '7', '6.50' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '387', '41', '56', '2.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '388', '41', '28', '2.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '389', '41', '60', '1.80' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '390', '41', '69', '3.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '391', '41', '40', '0.10' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '392', '41', '7', '1.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '393', '41', '73', '2.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '394', '41', '120', '2.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '395', '41', '5', '28.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '396', '41', '63', '0.30' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '400', '45', '18', '2.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '401', '45', '28', '2.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '402', '45', '60', '1.80' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '403', '45', '23', '25.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '404', '45', '40', '0.10' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '405', '45', '81', '2.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '406', '45', '5', '33.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '407', '45', '8', '6.50' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '408', '45', '73', '2.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '409', '45', '49', '2.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '410', '45', '63', '0.30' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '411', '45', '7', '6.50' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '413', '3', '8', '26.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '414', '3', '56', '4.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '415', '3', '73', '4.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '416', '3', '54', '1.10' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '417', '3', '5', '66.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '418', '3', '60', '2.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '419', '3', '28', '6.20' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '420', '3', '49', '5.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '421', '3', '18', '5.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '422', '3', '49', '5.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '423', '3', '40', '0.20' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '424', '3', '54', '0.55' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '425', '3', '18', '2.50' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '426', '3', '49', '2.50' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '428', '4', '28', '2.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '429', '4', '60', '1.20' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '430', '4', '112', '2.70' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '431', '4', '40', '0.10' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '432', '4', '81', '2.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '433', '4', '5', '14.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '434', '4', '73', '2.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '435', '4', '54', '0.36' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '436', '4', '22', '1.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '438', '54', '8', '12.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '439', '54', '56', '2.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '440', '54', '73', '2.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '441', '54', '63', '0.30' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '442', '54', '5', '25.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '443', '54', '40', '0.10' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '444', '54', '60', '1.80' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '445', '54', '28', '2.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '446', '54', '20', '0.50' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '447', '54', '49', '0.30' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '449', '1', '49', '2.50' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '450', '1', '28', '2.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '451', '1', '60', '1.80' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '452', '1', '23', '34.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '453', '1', '40', '0.10' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '454', '1', '81', '2.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '455', '1', '73', '3.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '456', '1', '57', '1.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '457', '1', '5', '24.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '458', '1', '8', '10.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '459', '1', '18', '1.50' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '460', '1', '54', '0.49' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '461', '1', '13', '390.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '463', '50', '73', '1.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '464', '50', '56', '3.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '465', '50', '120', '1.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '466', '50', '57', '6.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '467', '50', '43', '3.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '468', '50', '8', '6.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '469', '50', '18', '5.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '470', '50', '5', '40.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '471', '50', '28', '5.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '472', '50', '40', '0.10' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '473', '50', '60', '1.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '474', '50', '54', '0.53' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '475', '50', '49', '5.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '477', '47', '73', '3.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '478', '47', '56', '3.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '479', '47', '49', '5.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '480', '47', '57', '5.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '481', '47', '43', '3.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '482', '47', '8', '6.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '483', '47', '18', '5.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '484', '47', '5', '25.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '485', '47', '28', '5.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '486', '47', '40', '0.10' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '487', '47', '60', '1.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '488', '47', '54', '0.49' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '489', '47', '13', '320.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '491', '52', '14', '90.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '492', '52', '46', '10.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '493', '52', '50', '16.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '494', '52', '60', '1.20' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '495', '52', '28', '3.50' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '496', '52', '81', '4.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '497', '52', '8', '12.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '498', '52', '63', '0.20' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '499', '52', '68', '0.06' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '500', '52', '5', '16.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '501', '52', '38', '9.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '502', '55', '14', '225.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '503', '55', '5', '6.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '504', '55', '81', '4.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '505', '55', '40', '0.20' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '506', '55', '60', '3.50' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '507', '55', '29', '0.15' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '508', '55', '63', '0.30' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '509', '55', '28', '2.60' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '510', '55', '50', '8.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '511', '55', '38', '11.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '512', '55', '67', '0.45' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '514', '53', '60', '1.20' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '515', '53', '28', '3.50' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '516', '53', '29', '0.30' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '517', '53', '38', '15.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '518', '53', '8', '12.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '519', '53', '81', '4.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '520', '53', '50', '16.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '521', '53', '5', '10.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '522', '53', '63', '0.20' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '523', '53', '37', '0.05' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '525', '15', '69', '3.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '526', '15', '60', '1.80' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '527', '15', '73', '2.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '528', '15', '56', '2.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '529', '15', '40', '0.10' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '530', '15', '19', '2.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '531', '15', '54', '0.36' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '532', '15', '28', '2.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '533', '15', '5', '18.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '534', '15', '39', '2.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '535', '15', '13', '286.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '537', '16', '60', '0.30' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '538', '16', '28', '0.38' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '539', '16', '81', '2.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '540', '16', '121', '1.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '541', '16', '8', '1.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '542', '16', '63', '0.08' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '543', '16', '5', '6.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '544', '16', '38', '4.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '545', '16', '24', '0.30' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '547', '57', '60', '0.30' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '548', '57', '81', '1.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '549', '57', '8', '4.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '550', '57', '63', '0.08' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '551', '57', '38', '7.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '553', '56', '60', '0.30' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '554', '56', '81', '1.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '555', '56', '8', '4.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '556', '56', '63', '0.08' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '557', '56', '5', '6.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '558', '56', '38', '6.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '560', '58', '60', '1.20' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '561', '58', '27', '2.50' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '562', '58', '8', '4.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '563', '58', '55', '1.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '564', '58', '64', '0.05' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '565', '58', '63', '0.30' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '566', '58', '30', '114.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '568', '32', '60', '0.35' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '569', '32', '28', '0.50' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '570', '32', '81', '2.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '571', '32', '121', '1.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '572', '32', '8', '1.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '573', '32', '63', '0.08' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '574', '32', '5', '6.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '575', '32', '38', '4.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '577', '51', '60', '0.30' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '578', '51', '28', '0.50' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '579', '51', '81', '1.50' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '580', '51', '121', '1.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '581', '51', '8', '1.50' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '582', '51', '63', '0.08' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '583', '51', '5', '6.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '584', '51', '38', '4.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '586', '59', '60', '0.60' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '587', '59', '28', '0.50' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '588', '59', '81', '2.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '589', '59', '121', '1.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '590', '59', '8', '1.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '591', '59', '63', '0.16' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '592', '59', '5', '6.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '593', '59', '38', '4.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '595', '60', '60', '3.40' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '596', '60', '28', '8.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '597', '60', '63', '0.20' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '598', '60', '68', '0.16' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '599', '60', '5', '12.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '601', '49', '73', '1.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '602', '49', '56', '3.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '603', '49', '120', '1.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '604', '49', '57', '6.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '605', '49', '43', '3.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '606', '49', '8', '6.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '607', '49', '18', '5.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '608', '49', '5', '40.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '609', '49', '28', '5.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '610', '49', '31', '10.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '611', '49', '40', '0.10' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '612', '49', '60', '1.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '613', '49', '54', '0.53' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '614', '49', '49', '5.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '615', '7', '28', '2.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '616', '7', '60', '1.80' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '617', '7', '23', '25.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '618', '7', '40', '0.10' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '619', '7', '81', '2.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '620', '7', '49', '2.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '621', '7', '7', '6.50' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '622', '7', '8', '6.50' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '623', '7', '5', '33.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '624', '7', '73', '2.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '625', '7', '63', '0.30' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '626', '7', '18', '2.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '627', '6', '28', '2.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '628', '6', '60', '1.80' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '629', '6', '69', '3.30' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '630', '6', '40', '0.10' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '631', '6', '56', '2.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '632', '6', '49', '2.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '633', '6', '7', '6.50' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '634', '6', '8', '6.50' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '635', '6', '5', '33.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '636', '6', '73', '2.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '637', '6', '63', '0.30' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '638', '6', '18', '2.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '639', '13', '63', '0.50' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '640', '13', '56', '2.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '641', '13', '28', '2.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '642', '13', '69', '3.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '643', '13', '60', '1.80' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '644', '13', '40', '0.10' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '645', '13', '120', '2.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '646', '13', '73', '2.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '647', '13', '5', '28.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '648', '13', '7', '1.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '649', '5', '8', '13.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '650', '5', '56', '2.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '651', '5', '73', '2.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '652', '5', '54', '0.55' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '653', '5', '5', '35.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '654', '5', '45', '20.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '655', '5', '60', '2.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '656', '5', '28', '2.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '657', '5', '19', '3.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '658', '5', '49', '3.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '659', '5', '31', '20.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '660', '5', '40', '0.10' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '661', '2', '40', '0.10' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '662', '2', '55', '2.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '663', '2', '8', '0.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '664', '2', '31', '0.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '665', '2', '60', '0.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '666', '2', '23', '0.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '667', '2', '18', '0.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '668', '2', '73', '0.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '669', '2', '49', '0.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '670', '2', '28', '0.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '671', '2', '54', '0.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '672', '2', '5', '0.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '673', '2', '13', '0.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '674', '62', '120', '2.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '675', '62', '73', '2.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '676', '62', '56', '2.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '677', '62', '7', '1.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '678', '62', '63', '0.30' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '679', '62', '5', '28.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '680', '62', '60', '1.80' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '681', '62', '28', '2.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '682', '62', '18', '4.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '683', '62', '22', '1.00' );
-- ---------------------------------------------------------


-- Dump data of "insumo" -----------------------------------
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '1', 'Recorte de res 80/20', '0', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '2', 'CEBOLLA MOLIDA', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '4', 'CARNE DE RES', '0', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '5', 'AGUA', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '7', 'ALMIDON DE TRIGO', '1', '317.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '8', 'ALMIDON DE PAPA', '1', '288.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '13', 'BOLSAS AL VACIO', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '14', 'CARNE DE CERDO', '0', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '15', 'CARNE DE GALLINA', '0', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '16', 'CARNE DE POLLO', '0', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '17', 'CARNE DE TERNERA', '0', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '18', 'CEBOLLA', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '19', 'CEBOLLA LARGA', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '20', 'CEBOLLA PUERRO', '1', '3.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '21', 'CERDO', '0', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '22', 'CILANTRO', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '23', 'COLAGENO', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '24', 'COLOR', '0', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '25', 'COLOR NARANJA', '0', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '26', 'CONCENTRADO', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '27', 'CONDIMENTO PAVO', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '28', 'CONDIMENTOS', '0', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '29', 'CONSENTRADO', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '30', 'CUEROS', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '31', 'DESPALME', '0', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '32', 'DESPALME 8', '0', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '33', 'EMPAQUE', '0', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '37', 'GLUTAMINASA', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '38', 'HIELO', '0', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '39', 'HIERVAS', '0', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '40', 'HUMO', '1', '38.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '42', 'MERMA', '0', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '43', 'MIGA BLANCA', '0', '122.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '44', 'MOTA', '0', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '45', 'PASTA', '0', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '46', 'PASTA DE POLLO', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '47', 'PASTA DE RES', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '48', 'PECHO', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '49', 'PIMENTON', '0', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '50', 'PLAMA', '0', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '51', 'PLASMA LIQUIDO', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '52', 'POLLO', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '53', 'PRECIO UNIDADES', '0', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '54', 'PROTECTA', '1', '15.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '55', 'PROTEINA AL 90', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '56', 'PROTEINA ARCON', '1', '196.20' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '57', 'RESPONSE', '1', '123.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '60', 'SAL NITRADA', '1', '154.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '63', 'STERMAX', '1', '131.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '64', 'SUPER SMOL', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '67', 'TRASGLUTAMINAZA', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '68', 'TRASGRUTAMINASA', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '69', 'TRIPA NATURAL DE CERDO', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '70', 'UNIDADES', '0', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '71', 'UTILIDAD', '0', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '72', 'UTILIDAD UNIDAD', '0', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '73', 'VITACEL', '1', '302.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '74', 'RECORTE DE RES', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '75', 'GRASA DE RES', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '76', 'CABEZA DE LOMO', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '77', 'CUERO DE CERDO', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '78', 'CARNE INDUSTRIAL', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '81', 'PROTEINA', '0', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '82', 'RES', '0', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '83', 'RECICLE', '0', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '84', 'grasa de cerdo', '0', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '85', 'promul', '0', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '86', 'granulos', '0', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '87', 'COSTILLA', '0', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '88', 'bolsas', '0', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '89', 'PROTEINA AL 70', '0', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '90', 'COND. LONGANIZA', '1', '28.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '91', 'COND. TOCINETA', '1', '39.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '92', 'COND. MANGUERA', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '93', 'CARNAL', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '94', 'ARCON', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '95', 'COND. CERDO AHUMADO', '1', '72.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '96', 'COND. MEGA', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '98', 'COND. CHORIZO POLLO', '1', '44.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '99', 'COND. PERNIL CERDO', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '100', 'COND. HAMBURG. RES', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '101', 'COND. MORTADELA', '1', '3.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '102', 'COND. JAMÓN', '1', '39.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '103', 'CARRAGEL', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '104', 'COND. PUERRO', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '107', 'COND. SALCHICHA AMERICANA', '1', '16.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '109', 'COND. HAMBURG. POLLO', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '110', 'COND. CAHUMADO', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '111', 'COND. RH', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '112', 'MADEJA DE CERDO', '1', '180.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '113', 'CORIA 18*20', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '114', 'HILO GRUESO', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '115', 'EMPAQUE JAMON', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '116', 'EMPAQUE SALCHICHON', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '117', 'DEBRO 30', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '118', 'PROTEINA DE SOYA', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '119', 'FIBRA DE COLAGENO', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '120', 'TEXTURIZADO DE SOYA', '1', '195.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '121', 'HARINA DE TRIGO', '1', '43.50' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '122', 'SMOKE OIL', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '123', 'NATURSOL', '1', '206.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '124', 'CONDIMENTO MIXTO PRECOCIDO', '1', '38.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '125', 'FOSFATO', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '126', 'CONDIMENTO SALCHICHA MANGUERA', '1', '15.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '127', 'COND. HAMBURGUESA RES', '1', '18.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '128', 'PUERRO', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '129', 'CONDIMENTO CHORIZO CRIOLLO', '1', '18.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '130', 'CONDIMENTO CHORIZO TERNERA', '1', '10.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '131', 'CONDIMENTO CHORIZO COCTEL CERDO', '1', '3.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '132', 'CONDIMENTO SALCHICHÓN', '1', '16.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '133', 'CONDIMENTO SALCHICHA HOT DOG', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '134', 'CODIMENTO CHORIZO PICANTE', '1', '28.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '135', 'CONDIMENTO SALCHICHA RANCHERA', '1', '8.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '137', 'BOLSA TOCINETA LIBRA', '2', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '140', 'BOLSA TOCINETA MEDIA', '2', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '141', 'BOLSA TOCINETA CUARTO', '2', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '142', 'BOLSA CHORIZO MEGA CUNCIA', '2', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '143', 'BOLSA CHORIZO POLLO', '2', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '144', 'BOLSA CHORIZO CRIOLLO', '2', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '145', 'BOLSA CHORIZO PICANTE', '2', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '146', 'BOLSA CHORIZO PREMIUM', '2', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '147', 'BOLSA CHORIZO TERNERA', '2', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '148', 'BOLSA JAMON LIBRA', '2', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '149', 'BOLSA JAMON MEDIA', '2', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '150', 'BOLSA JAMON BLOQUE', '2', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '151', 'BOLSA HAMBURGUESA * 22', '2', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '152', 'BOLSA HAMBURGUESA * 5', '2', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '153', 'CHORIZO TRADICIONAL', '0', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '154', 'BOLSA LONGANIZA', '2', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '155', 'BOLSA TOCINETA LIBRA BLANCA', '2', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '156', 'BOLSA TOCINETA MEDIA BLANCA', '2', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '157', 'BOLSA CHORIZO BLANCA 19*28', '2', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '158', 'BOLSA COCTEL', '2', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '159', 'BOLSA 35*50', '2', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '160', 'BOLSA HAMBURGUESA DE POLLO', '2', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '161', 'BOLSA 20*30', '2', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '162', 'BOLSA 25*30', '2', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '163', 'BOLSA 25*45', '2', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '164', 'BOLSA 18*25', '2', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '165', 'BOLSA 50*35', '2', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '166', 'BOLSA 18*30', '2', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '167', 'BOLSA 18*22', '2', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '168', 'BOLSA 15*18', '2', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '169', 'DEVRO', '2', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '170', 'HOT DOG 18/20', '2', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '171', 'EMPAQUE AMERICANA 26/28', '0', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '172', 'BOLSA JAMON', '2', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '175', 'CORIA 19/50', '2', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '176', 'CORIA 26/50', '2', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '177', 'EMPAQUE MANGUERA', '2', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '179', 'FALDA RES', '0', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '181', 'CONDIMENTO MEGACUNCIA', '1', '9.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '182', 'MEXICANO', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '183', 'COND. HAMBURGUESA DE POLLO', '1', '10.00' );
-- ---------------------------------------------------------


-- Dump data of "inventario_empaque_vacio" -----------------
-- ---------------------------------------------------------


-- Dump data of "municipio" --------------------------------
-- ---------------------------------------------------------


-- Dump data of "producto" ---------------------------------
INSERT INTO `producto`(`id`,`nombre`,`cantidad`) VALUES ( '1', 'CHORIZO DE TERNERA', '0' );
INSERT INTO `producto`(`id`,`nombre`,`cantidad`) VALUES ( '2', 'CHORIZO DE POLLO', '0' );
INSERT INTO `producto`(`id`,`nombre`,`cantidad`) VALUES ( '3', 'CHORIZO PICANTE', '0' );
INSERT INTO `producto`(`id`,`nombre`,`cantidad`) VALUES ( '4', 'CHORIZO PREMIUM', '0' );
INSERT INTO `producto`(`id`,`nombre`,`cantidad`) VALUES ( '5', 'CHORIZO CRIOLLO', '0' );
INSERT INTO `producto`(`id`,`nombre`,`cantidad`) VALUES ( '6', 'CHORIZO TRADICIONAL AHUMADO', '0' );
INSERT INTO `producto`(`id`,`nombre`,`cantidad`) VALUES ( '7', 'CHORIZO TRADICIONAL PRECOCIDO', '0' );
INSERT INTO `producto`(`id`,`nombre`,`cantidad`) VALUES ( '10', 'CHORIZO PAISA', '0' );
INSERT INTO `producto`(`id`,`nombre`,`cantidad`) VALUES ( '11', 'CHORIZO ESPECIAL AHUMADO', '0' );
INSERT INTO `producto`(`id`,`nombre`,`cantidad`) VALUES ( '12', 'CHORIZO ESPECIAL CRUDO', '0' );
INSERT INTO `producto`(`id`,`nombre`,`cantidad`) VALUES ( '13', 'CHORIZO TRADICIONAL CRUDO', '0' );
INSERT INTO `producto`(`id`,`nombre`,`cantidad`) VALUES ( '15', 'LONGANIZA', '0' );
INSERT INTO `producto`(`id`,`nombre`,`cantidad`) VALUES ( '16', 'MORTADELA', '0' );
INSERT INTO `producto`(`id`,`nombre`,`cantidad`) VALUES ( '17', 'JAMON', '0' );
INSERT INTO `producto`(`id`,`nombre`,`cantidad`) VALUES ( '18', 'JAMON MEDIA', '0' );
INSERT INTO `producto`(`id`,`nombre`,`cantidad`) VALUES ( '19', 'JAMON 2,5', '0' );
INSERT INTO `producto`(`id`,`nombre`,`cantidad`) VALUES ( '20', 'JAMON PIERNA', '0' );
INSERT INTO `producto`(`id`,`nombre`,`cantidad`) VALUES ( '21', 'TOCINETA 4 KILOS', '0' );
INSERT INTO `producto`(`id`,`nombre`,`cantidad`) VALUES ( '22', 'TOCINETA 2 KILOS', '0' );
INSERT INTO `producto`(`id`,`nombre`,`cantidad`) VALUES ( '23', 'TOCINETA LIBRA', '0' );
INSERT INTO `producto`(`id`,`nombre`,`cantidad`) VALUES ( '24', 'TOCINETA MEDIA', '0' );
INSERT INTO `producto`(`id`,`nombre`,`cantidad`) VALUES ( '25', 'TOCINETA CUARTO', '0' );
INSERT INTO `producto`(`id`,`nombre`,`cantidad`) VALUES ( '26', 'VILLAO POR 3', '0' );
INSERT INTO `producto`(`id`,`nombre`,`cantidad`) VALUES ( '27', 'VILLAO POR 5', '0' );
INSERT INTO `producto`(`id`,`nombre`,`cantidad`) VALUES ( '28', 'VILLAO POR 6', '0' );
INSERT INTO `producto`(`id`,`nombre`,`cantidad`) VALUES ( '29', 'COSTILLA MEDIA', '0' );
INSERT INTO `producto`(`id`,`nombre`,`cantidad`) VALUES ( '30', 'COSTILLA LIBRA', '0' );
INSERT INTO `producto`(`id`,`nombre`,`cantidad`) VALUES ( '31', 'SALCHICHA TIPO AMERICANA', '0' );
INSERT INTO `producto`(`id`,`nombre`,`cantidad`) VALUES ( '32', 'SALCHICHA HOT DOG', '0' );
INSERT INTO `producto`(`id`,`nombre`,`cantidad`) VALUES ( '33', 'SALCHICHA TIPO RANCHERA', '0' );
INSERT INTO `producto`(`id`,`nombre`,`cantidad`) VALUES ( '34', 'SALCHICHA MANGUERA X 8', '0' );
INSERT INTO `producto`(`id`,`nombre`,`cantidad`) VALUES ( '35', 'SALCHICHA MINI MANGUERA', '0' );
INSERT INTO `producto`(`id`,`nombre`,`cantidad`) VALUES ( '36', 'SALCHICHA MANGUERA X 16', '0' );
INSERT INTO `producto`(`id`,`nombre`,`cantidad`) VALUES ( '37', 'SALCHICHON KILO', '0' );
INSERT INTO `producto`(`id`,`nombre`,`cantidad`) VALUES ( '38', 'SALCHICHON 500', '0' );
INSERT INTO `producto`(`id`,`nombre`,`cantidad`) VALUES ( '39', 'POLLO RELLENO', '0' );
INSERT INTO `producto`(`id`,`nombre`,`cantidad`) VALUES ( '40', 'CENAS NAVIDEÑAS', '0' );
INSERT INTO `producto`(`id`,`nombre`,`cantidad`) VALUES ( '41', 'CHORIZO CLASICO CRUDO', '0' );
INSERT INTO `producto`(`id`,`nombre`,`cantidad`) VALUES ( '43', 'CHORIZO CLASICO AHUMADO', '0' );
INSERT INTO `producto`(`id`,`nombre`,`cantidad`) VALUES ( '45', 'CHORIZO CLASICO PRECOCIDO', '0' );
INSERT INTO `producto`(`id`,`nombre`,`cantidad`) VALUES ( '47', 'HAMBURGUESA DE POLLO', '0' );
INSERT INTO `producto`(`id`,`nombre`,`cantidad`) VALUES ( '48', 'CHORIZO COCTEL', '0' );
INSERT INTO `producto`(`id`,`nombre`,`cantidad`) VALUES ( '49', 'ALBONDIGA ', '0' );
INSERT INTO `producto`(`id`,`nombre`,`cantidad`) VALUES ( '50', 'HAMBURGUESA DE RES', '0' );
INSERT INTO `producto`(`id`,`nombre`,`cantidad`) VALUES ( '51', 'SALCHICHA MANGUERA', '0' );
INSERT INTO `producto`(`id`,`nombre`,`cantidad`) VALUES ( '52', 'JAMON DE CERDO', '0' );
INSERT INTO `producto`(`id`,`nombre`,`cantidad`) VALUES ( '53', 'JAMON YORK', '0' );
INSERT INTO `producto`(`id`,`nombre`,`cantidad`) VALUES ( '54', 'CHORIZO VILLAVICECIO NARANJA', '0' );
INSERT INTO `producto`(`id`,`nombre`,`cantidad`) VALUES ( '55', 'JAMON DE PERNIL', '0' );
INSERT INTO `producto`(`id`,`nombre`,`cantidad`) VALUES ( '56', 'PASTA DE CARNE', '0' );
INSERT INTO `producto`(`id`,`nombre`,`cantidad`) VALUES ( '57', 'PASTA DE POLLO', '0' );
INSERT INTO `producto`(`id`,`nombre`,`cantidad`) VALUES ( '58', 'PAVO RELLENO', '0' );
INSERT INTO `producto`(`id`,`nombre`,`cantidad`) VALUES ( '59', 'SALCHICHON', '0' );
INSERT INTO `producto`(`id`,`nombre`,`cantidad`) VALUES ( '60', 'TOCINETA', '0' );
INSERT INTO `producto`(`id`,`nombre`,`cantidad`) VALUES ( '61', 'SALCHICHA RANCHERA', '0' );
INSERT INTO `producto`(`id`,`nombre`,`cantidad`) VALUES ( '62', 'CHORIZO MEGA CUNCIA', '0' );
-- ---------------------------------------------------------


-- Dump data of "proveedor" --------------------------------
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`) VALUES ( '2', 'ALIRIO CASALLAS', '0', NULL, NULL, NULL, '0', NULL, NULL, 'CS', '0' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`) VALUES ( '3', 'CANTABRIA', '0', NULL, NULL, NULL, '0', NULL, NULL, 'CT', '0' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`) VALUES ( '4', 'DANIEL PACHON', '0', NULL, NULL, NULL, '0', NULL, NULL, 'DP', '0' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`) VALUES ( '5', 'PORCINARNES', '0', NULL, NULL, NULL, '0', NULL, NULL, 'PC', '0' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`) VALUES ( '6', 'TORETOS', '0', NULL, NULL, NULL, '0', NULL, NULL, 'TR', '0' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`) VALUES ( '7', 'WILMER GORDILLO', '0', NULL, NULL, NULL, '0', NULL, NULL, 'WG', '0' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`) VALUES ( '9', 'CIALTA', '0', NULL, NULL, NULL, '0', NULL, NULL, 'CL', '0' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`) VALUES ( '10', 'ORLANDO MORENO', '0', NULL, NULL, NULL, '0', NULL, NULL, 'OM', '0' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`) VALUES ( '11', 'WILIAM RODRIGUEZ', '0', NULL, NULL, NULL, '0', NULL, NULL, 'WR', '0' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`) VALUES ( '12', 'MIILLER VARGAS', '0', NULL, NULL, NULL, '0', NULL, NULL, 'MV', '0' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`) VALUES ( '13', 'JORGE CASTIBLANCO', '0', NULL, NULL, NULL, '0', NULL, NULL, 'JC', '0' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`) VALUES ( '14', 'GENUINOS', '0', NULL, NULL, NULL, '0', NULL, NULL, 'GN', '0' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`) VALUES ( '15', 'CERCAFE', '0', NULL, NULL, NULL, '0', NULL, NULL, 'CR', '0' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`) VALUES ( '16', 'FREDY ACEVEDO', '0', NULL, NULL, NULL, '0', NULL, NULL, 'FA', '0' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`) VALUES ( '17', 'CEBOLLA', '0', NULL, NULL, NULL, '0', NULL, NULL, 'CB', '0' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`) VALUES ( '18', 'PIMENTON', '0', NULL, NULL, NULL, '0', NULL, NULL, 'PM', '0' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`) VALUES ( '19', 'HIELOS IGLU/ ARTICO', '0', NULL, NULL, NULL, '0', NULL, NULL, 'HI', '0' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`) VALUES ( '20', 'BUCANERO', '0', NULL, NULL, NULL, '0', NULL, NULL, 'BC', '0' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`) VALUES ( '21', 'EDWARD PATIÑO', '0', NULL, NULL, NULL, '0', NULL, NULL, 'EP', '0' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`) VALUES ( '22', 'SURTIVALE', '0', NULL, NULL, NULL, '0', NULL, NULL, 'SV', '0' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`) VALUES ( '23', 'EDGAR PEREZ', '0', NULL, NULL, NULL, '0', NULL, NULL, 'XP', '0' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`) VALUES ( '24', 'GRUPO AL', '0', NULL, NULL, NULL, '0', NULL, NULL, 'GA', '0' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`) VALUES ( '25', 'POLO JARA', '0', NULL, NULL, NULL, '0', NULL, NULL, 'PJ', '0' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`) VALUES ( '26', 'SANTA SOFIA', '0', NULL, NULL, NULL, '0', NULL, NULL, 'SF', '0' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`) VALUES ( '27', 'MARK POLLO', '0', NULL, NULL, NULL, '0', NULL, NULL, 'MK', '0' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`) VALUES ( '28', 'INDUSTRIAS ESPINOSA', '0', NULL, NULL, NULL, '0', NULL, NULL, 'IE', '0' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`) VALUES ( '29', 'PLASMALIQ', '0', NULL, NULL, NULL, '0', NULL, NULL, 'PL', '0' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`) VALUES ( '30', 'JORGE CASTIBLANCO', '0', NULL, NULL, NULL, '0', NULL, NULL, 'JC', '0' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`) VALUES ( '31', 'TECNAS', '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`) VALUES ( '32', 'ALICO', '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`) VALUES ( '33', 'CI TALSA', '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`) VALUES ( '34', 'DELTAGEN', '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`) VALUES ( '35', 'TECNO FOOD', '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`) VALUES ( '36', 'GLORIA JIMENEZ', '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`) VALUES ( '37', 'A&R EXPORT', '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`) VALUES ( '38', 'CONDITA', '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`) VALUES ( '39', 'AGRO LECHERO', '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`) VALUES ( '40', 'CIMPA', '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`) VALUES ( '41', 'QUIMICA AROMATICA', '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`) VALUES ( '42', 'SURTI QUIMICOS', '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`) VALUES ( '43', 'SOLUCIONES ALIMENTARIAS', '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`) VALUES ( '44', 'CALIER DE COLOMBIA', '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`) VALUES ( '45', 'CONDIMPORTADOS', '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`) VALUES ( '46', 'GYC', '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`) VALUES ( '47', 'ELIZABETH NUÑEZ', '0', NULL, NULL, NULL, '0', NULL, NULL, 'EN', '0' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`) VALUES ( '48', 'JUAN DIEGO', '0', NULL, NULL, NULL, '0', NULL, NULL, 'JD', '0' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`) VALUES ( '49', 'FENTEX', '0', NULL, NULL, NULL, '0', NULL, NULL, 'FX', '0' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`) VALUES ( '50', 'LA FAZENDA', '0', NULL, NULL, NULL, '0', NULL, NULL, 'FZ', '0' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`) VALUES ( '51', 'LUCY POLLO', '0', NULL, NULL, NULL, '0', NULL, NULL, 'LY', '0' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`) VALUES ( '52', 'JUAN CARLOS GONZALEZ', '0', NULL, NULL, NULL, '0', NULL, NULL, 'JK', '0' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`) VALUES ( '53', 'GUADALUPE', '0', NULL, NULL, NULL, '0', NULL, NULL, 'GD', '0' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`) VALUES ( '54', 'DON POLO', '0', NULL, NULL, NULL, '0', NULL, NULL, 'PJ', '0' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`) VALUES ( '55', 'HIELOS DEL SUR', '0', NULL, NULL, NULL, '0', NULL, NULL, 'HL', '0' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`) VALUES ( '56', 'ANDRES MARTINEZ', '0', NULL, NULL, NULL, '0', NULL, NULL, 'AM', '0' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`) VALUES ( '57', 'LA PREMIUM', '0', NULL, NULL, NULL, '0', NULL, NULL, 'LP', '0' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`) VALUES ( '58', 'CENTRO AGROLECHERO', '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`) VALUES ( '59', 'LA NIEVE', '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`) VALUES ( '60', 'MERCANTIL CONTINENTAL', '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`) VALUES ( '61', 'ABASTPS', '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`) VALUES ( '62', 'PLASTICOS GYC', '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`) VALUES ( '63', 'TAUSSING', '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`) VALUES ( '64', 'FREDY MORENO', '0', NULL, NULL, NULL, '0', NULL, NULL, 'FM', '0' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`) VALUES ( '65', 'MEGA', '0', NULL, NULL, NULL, '0', NULL, NULL, 'MEG', '0' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`) VALUES ( '70', ' MAGROS CARNES', '0', NULL, NULL, NULL, '0', NULL, NULL, 'MC', '0' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`) VALUES ( '71', 'BONANZA ', '0', NULL, NULL, NULL, '', NULL, NULL, 'BN', '0' );
-- ---------------------------------------------------------


-- Dump data of "proveedor_insumo" -------------------------
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '147', '7', '35', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '148', '8', '41', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '149', '14', '7', '5.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '150', '14', '9', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '151', '14', '10', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '152', '14', '14', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '153', '14', '26', '132.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '154', '14', '47', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '155', '14', '50', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '156', '14', '52', '290.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '157', '31', '3', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '158', '31', '7', '59.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '159', '31', '9', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '160', '31', '10', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '161', '31', '13', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '162', '31', '14', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '163', '31', '28', '586.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '164', '31', '50', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '165', '31', '53', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '166', '31', '56', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '167', '31', '64', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '168', '38', '55', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '169', '46', '24', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '170', '46', '52', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '171', '47', '52', '25.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '172', '51', '29', '36.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '173', '52', '48', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '174', '52', '51', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '175', '54', '44', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '176', '57', '31', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '177', '60', '31', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '178', '60', '45', '125.70' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '179', '63', '58', '14.28' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '180', '17', '54', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '182', '68', '41', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '183', '73', '38', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '184', '74', '4', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '185', '74', '6', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '186', '74', '7', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '187', '74', '23', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '188', '74', '28', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '189', '75', '4', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '190', '75', '7', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '191', '75', '28', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '192', '76', '3', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '193', '76', '5', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '194', '76', '24', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '195', '76', '49', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '196', '76', '57', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '197', '77', '52', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '198', '78', '11', '694.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '199', '90', '45', '13.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '200', '91', '45', '19.20' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '201', '92', '45', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '202', '93', '45', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '203', '94', '44', '430.40' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '204', '94', '45', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '205', '95', '45', '50.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '206', '96', '45', '108.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '208', '98', '45', '17.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '209', '99', '45', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '210', '100', '45', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '211', '101', '45', '14.50' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '212', '102', '45', '27.70' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '213', '103', '45', '1.65' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '214', '104', '45', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '217', '107', '45', '8.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '219', '109', '45', '20.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '220', '110', '45', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '221', '111', '45', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '222', '112', '36', '180.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '223', '113', '36', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '224', '114', '36', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '225', '115', '36', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '226', '116', '36', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '227', '117', '36', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '228', '118', '41', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '229', '119', '41', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '230', '120', '40', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '231', '121', '59', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '232', '121', '61', '109.50' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '233', '122', '60', '96.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '234', '123', '60', '140.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '235', '124', '45', '36.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '236', '125', '45', '12.90' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '237', '126', '45', '15.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '238', '127', '45', '20.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '239', '128', '45', '0.75' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '240', '129', '45', '22.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '241', '130', '45', '18.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '242', '131', '45', '9.50' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '243', '132', '45', '10.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '244', '133', '45', '13.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '245', '134', '45', '6.20' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '246', '135', '45', '11.50' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '247', '137', '62', '5082.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '248', '140', '62', '8448.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '249', '141', '62', '9180.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '250', '142', '62', '6125.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '251', '143', '62', '8425.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '252', '144', '62', '8149.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '253', '145', '62', '4896.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '254', '146', '62', '2123.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '255', '147', '62', '2467.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '256', '148', '62', '10082.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '257', '149', '62', '9600.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '258', '150', '62', '5817.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '259', '151', '32', '21772.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '260', '152', '32', '15614.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '261', '153', '62', '3004.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '262', '154', '62', '8800.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '263', '155', '62', '98.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '264', '156', '62', '149.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '265', '157', '62', '2229.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '266', '158', '62', '94.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '267', '159', '62', '140.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '268', '160', '62', '30.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '269', '161', '62', '3800.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '270', '162', '62', '4200.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '271', '163', '62', '1200.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '272', '164', '62', '3400.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '273', '165', '62', '1600.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '274', '166', '62', '2000.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '275', '167', '62', '3200.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '276', '168', '62', '4000.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '277', '169', '63', '46.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '278', '170', '63', '34.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '279', '171', '63', '43.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '280', '172', '36', '15.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '283', '175', '36', '566.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '284', '176', '36', '184.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '285', '177', '63', '540.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '288', '28', '65', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '289', '74', '65', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '290', '14', '64', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '291', '31', '70', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '292', '31', '71', '0.00' );
-- ---------------------------------------------------------


-- Dump data of "recepcion_materia_prima_carnica" ----------
INSERT INTO `recepcion_materia_prima_carnica`(`id`,`fec_ingreso`,`lote_interno`,`proveedor`,`materia_prima_insumo`,`peso`,`temperatura_llegada`,`carct_orgleptica_color`,`carct_orgleptica_olor`,`carct_orgleptica_c_temperatura`,`hgiene_vehiculo`,`hgiene_canastas`,`conductor_dotacion`,`conductor_higiene`,`devolucion_si_no`,`devolucion_peso`,`recibido`,`observaciones`) VALUES ( '8', '2016-02-17', 'wg1', '7', '31', '1.0', '1.0', '1', '1', '1', '1', '1', '1', '1', '', '0', '22', '' );
INSERT INTO `recepcion_materia_prima_carnica`(`id`,`fec_ingreso`,`lote_interno`,`proveedor`,`materia_prima_insumo`,`peso`,`temperatura_llegada`,`carct_orgleptica_color`,`carct_orgleptica_olor`,`carct_orgleptica_c_temperatura`,`hgiene_vehiculo`,`hgiene_canastas`,`conductor_dotacion`,`conductor_higiene`,`devolucion_si_no`,`devolucion_peso`,`recibido`,`observaciones`) VALUES ( '9', '2016-02-18', 'wg2', '7', '14', '2.0', '2.0', '1', '1', '1', '1', '1', '1', '1', '', '0', '22', '' );
INSERT INTO `recepcion_materia_prima_carnica`(`id`,`fec_ingreso`,`lote_interno`,`proveedor`,`materia_prima_insumo`,`peso`,`temperatura_llegada`,`carct_orgleptica_color`,`carct_orgleptica_olor`,`carct_orgleptica_c_temperatura`,`hgiene_vehiculo`,`hgiene_canastas`,`conductor_dotacion`,`conductor_higiene`,`devolucion_si_no`,`devolucion_peso`,`recibido`,`observaciones`) VALUES ( '10', '2016-02-18', 'ie3', '28', '31', '4.0', '4.0', '1', '1', '1', '1', '1', '1', '1', '', '0', '22', '' );
-- ---------------------------------------------------------


-- Dump data of "recepcion_materia_prima_no_carnica" -------
INSERT INTO `recepcion_materia_prima_no_carnica`(`id`,`fec_ingreso`,`lote_interno`,`fec_vencimiento`,`proveedor_id`,`materia_prima_insumo`,`peso_total`,`unidades`,`num_lote_externo`,`caract_fisicas_empaque`,`caract_fisicas_rotulado`,`devolucion_si_no`,`devolucion_peso_unidades`,`recibido`,`observaciones`) VALUES ( '1', '2016-02-02', '1', '2016-02-17', '61', '121', '12', '2', '23', '1', '1', '0', '0.0', '22', '' );
-- ---------------------------------------------------------


-- Dump data of "reporte_control_horneado" -----------------
INSERT INTO `reporte_control_horneado`(`id`,`fecha`,`tanda`,`producto`,`cantidad`,`averias`,`codigo_reproceso`,`numero_programa`,`temperatura_salida`,`temperatura_coccion`,`sostenimiento_tiempo`,`sostenimiento_temperatura_interna`,`caract_organoleptica_color`,`caract_organoleptica_olor`,`caract_organoleptica_sabor`,`caract_organoleptica_textura`,`caract_fisicas_tamano`,`caract_fisicas_forma`,`responsable_id`) VALUES ( '1', '2015-05-22', '111', 'ññlñ', '12', '11', '2', '2', '1', '1', '1', '1', '1', '1', '1', NULL, '1', '1', '22' );
-- ---------------------------------------------------------


-- Dump data of "reporte_empaque_vacio" --------------------
INSERT INTO `reporte_empaque_vacio`(`id`,`fecha`,`producto`,`total_paquetes`,`peso`,`numero_lote`,`carac_fisicas_color`,`carac_fisicas_olor`,`carac_fisicas_tamano`,`carac_fisicas_forma`,`carac_fisicas_exur`,`responsable_id`) VALUES ( '1', '2015-05-12', '14114', '12', '12', '154548', '1', '1', '1', '1', '1', '22' );
-- ---------------------------------------------------------


-- Dump data of "vs_database_diagrams" ---------------------
INSERT INTO `vs_database_diagrams`(`name`,`diadata`,`comment`,`preview`,`lockinfo`,`locktime`,`version`) VALUES ( 'p', 'PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4KPHByb3BlcnRpZXM+Cgk8Q29udHJvbHM+CgkJPFRhYmxlPgoJCQk8UGFyZW50IHZhbHVlPSIjVE9QIi8+CgkJCTxQcm9wZXJ0aWVzPgoJCQkJPF5jaGVja3MgdmFsdWU9IjAiLz4KCQkJCTxeZ3JvdXAgdmFsdWU9Ii0xIi8+CgkJCQk8XmhlaWdodCB2YWx1ZT0iLTEiLz4KCQkJCTxeaW5kZXhlcyB2YWx1ZT0iMCIvPgoJCQkJPF5sZXZlbCB2YWx1ZT0iMyIvPgoJCQkJPF5saW5rcyB2YWx1ZT0iMCIvPgoJCQkJPF5sb2NrIHZhbHVlPSIwIi8+CgkJCQk8Xm1ldGhvZHMgdmFsdWU9IjAiLz4KCQkJCTxebWluaW1pemVkIHZhbHVlPSIwIi8+CgkJCQk8XnByb3BlcnRpZXMgdmFsdWU9IjAiLz4KCQkJCTxedHJpZ2dlcnMgdmFsdWU9IjAiLz4KCQkJCTxedW5pcXVlcyB2YWx1ZT0iMCIvPgoJCQkJPGJhY2tfY29sb3IgdmFsdWU9IkI0RDY0NzAwIi8+CgkJCQk8bmFtZSB2YWx1ZT0iVGFibGUiLz4KCQkJCTxwb3NpdGlvbiB2YWx1ZT0iNTkzOzM2Ii8+CgkJCQk8c2l6ZSB2YWx1ZT0iMjUwOzMyMCIvPgoJCQk8L1Byb3BlcnRpZXM+CgkJCTxUeXBlIHZhbHVlPSJUYWJsZSIvPgoJCTwvVGFibGU+CgkJPFRhYmxlMT4KCQkJPFBhcmVudCB2YWx1ZT0iI1RPUCIvPgoJCQk8UHJvcGVydGllcz4KCQkJCTxeY2hlY2tzIHZhbHVlPSIwIi8+CgkJCQk8Xmdyb3VwIHZhbHVlPSItMSIvPgoJCQkJPF5oZWlnaHQgdmFsdWU9Ii0xIi8+CgkJCQk8XmluZGV4ZXMgdmFsdWU9IjAiLz4KCQkJCTxebGV2ZWwgdmFsdWU9IjIiLz4KCQkJCTxebGlua3MgdmFsdWU9IjAiLz4KCQkJCTxebG9jayB2YWx1ZT0iMCIvPgoJCQkJPF5tZXRob2RzIHZhbHVlPSIwIi8+CgkJCQk8Xm1pbmltaXplZCB2YWx1ZT0iMCIvPgoJCQkJPF5wcm9wZXJ0aWVzIHZhbHVlPSIwIi8+CgkJCQk8XnRyaWdnZXJzIHZhbHVlPSIwIi8+CgkJCQk8XnVuaXF1ZXMgdmFsdWU9IjAiLz4KCQkJCTxiYWNrX2NvbG9yIHZhbHVlPSJCNEQ2NDcwMCIvPgoJCQkJPG5hbWUgdmFsdWU9IlRhYmxlMSIvPgoJCQkJPHBvc2l0aW9uIHZhbHVlPSIyMTs1MCIvPgoJCQkJPHNpemUgdmFsdWU9IjIwOTsyMzAiLz4KCQkJPC9Qcm9wZXJ0aWVzPgoJCQk8VHlwZSB2YWx1ZT0iVGFibGUiLz4KCQk8L1RhYmxlMT4KCQk8VGFibGUyPgoJCQk8UGFyZW50IHZhbHVlPSIjVE9QIi8+CgkJCTxQcm9wZXJ0aWVzPgoJCQkJPF5jaGVja3MgdmFsdWU9IjAiLz4KCQkJCTxeZ3JvdXAgdmFsdWU9Ii0xIi8+CgkJCQk8XmhlaWdodCB2YWx1ZT0iLTEiLz4KCQkJCTxeaW5kZXhlcyB2YWx1ZT0iMCIvPgoJCQkJPF5sZXZlbCB2YWx1ZT0iMSIvPgoJCQkJPF5saW5rcyB2YWx1ZT0iMCIvPgoJCQkJPF5sb2NrIHZhbHVlPSIwIi8+CgkJCQk8Xm1ldGhvZHMgdmFsdWU9IjAiLz4KCQkJCTxebWluaW1pemVkIHZhbHVlPSIwIi8+CgkJCQk8XnByb3BlcnRpZXMgdmFsdWU9IjAiLz4KCQkJCTxedHJpZ2dlcnMgdmFsdWU9IjAiLz4KCQkJCTxedW5pcXVlcyB2YWx1ZT0iMCIvPgoJCQkJPGJhY2tfY29sb3IgdmFsdWU9IkI0RDY0NzAwIi8+CgkJCQk8bmFtZSB2YWx1ZT0iVGFibGUyIi8+CgkJCQk8cG9zaXRpb24gdmFsdWU9IjMyMTsxOTciLz4KCQkJCTxzaXplIHZhbHVlPSIyNTU7Mzc0Ii8+CgkJCTwvUHJvcGVydGllcz4KCQkJPFR5cGUgdmFsdWU9IlRhYmxlIi8+CgkJPC9UYWJsZTI+CgkJPHA+CgkJCTxQcm9wZXJ0aWVzPgoJCQkJPF5sb2NrIHZhbHVlPSIwIi8+CgkJCQk8YmFja19jb2xvciB2YWx1ZT0iRkZGRkZGIi8+CgkJCQk8Z2FtbWEgdmFsdWU9IjAiLz4KCQkJCTxuYW1lIHZhbHVlPSJwIi8+CgkJCQk8c2l6ZSB2YWx1ZT0iMjA0ODsyMDQ4Ii8+CgkJCQk8c3R5bGUgdmFsdWU9IjQiLz4KCQkJCTxzdHlsZV9saW5rcyB2YWx1ZT0iMCIvPgoJCQkJPHVuaXRzIHZhbHVlPSI1Ii8+CgkJCTwvUHJvcGVydGllcz4KCQkJPFR5cGUgdmFsdWU9IkRpYWdyYW0iLz4KCQk8L3A+Cgk8L0NvbnRyb2xzPgoJPEdVST4KCQk8RnVsbFRvb2xiYXJMZWZ0IHZhbHVlPSIxIi8+CgkJPEZ1bGxUb29sYmFyUmlnaHQgdmFsdWU9IjEiLz4KCQk8UGFnZUVkaXRvciB2YWx1ZT0iLTEiLz4KCQk8UGFnZUVkaXRvckggdmFsdWU9IjAiLz4KCQk8UGFnZVRvb2xiYXJMZWZ0IHZhbHVlPSIwIi8+CgkJPFBhZ2VUb29sYmFyUkIgdmFsdWU9IjAiLz4KCQk8UGFnZVRvb2xiYXJSaWdodCB2YWx1ZT0iMCIvPgoJCTxQYW5lQ2xpcGJvYXJkIHZhbHVlPSIwIi8+CgkJPFBhbmVMYXlvdXQgdmFsdWU9IjAiLz4KCQk8UGFuZVZpZXcgdmFsdWU9IjAiLz4KCQk8U2Nyb2xsWCB2YWx1ZT0iMCIvPgoJCTxTY3JvbGxZIHZhbHVlPSIwIi8+CgkJPFNlbGVjdGlvbiB2YWx1ZT0iVkdGaWJHVXkiLz4KCQk8U2hvd0FsbCB2YWx1ZT0iMSIvPgoJCTxTaG93Q2hhbmdlcyB2YWx1ZT0iMSIvPgoJCTxTaG93R0wgdmFsdWU9IjEiLz4KCQk8U2hvd0dyaWQgdmFsdWU9IjEiLz4KCQk8VXNlR3JpZCB2YWx1ZT0iMCIvPgoJPC9HVUk+Cgk8TW9kZWw+CgkJPG1lZ2FjaG9yaXpvcz4KCQkJPGxpbms+CgkJCQk8bzA+CgkJCQkJPENoYW5nZXMgdmFsdWU9IiIvPgoJCQkJCTxQcm9wZXJ0aWVzPgoJCQkJCQk8Q2FyZGluYWxpdHkgdmFsdWU9Ik9ORSB0byBNQU5ZIi8+CgkJCQkJCTxDaGlsZF9UYWJsZSB2YWx1ZT0icmVjZXBjaW9uX21hdGVyaWFfcHJpbWFfY2FybmljYSIvPgoJCQkJCQk8Rm9yZWlnbl9LZXkgdmFsdWU9ImNISnZkbVZsWkc5eSIvPgoJCQkJCQk8TmFtZSB2YWx1ZT0ibG5rX3JlY2VwY2lvbl9tYXRlcmlhX3ByaW1hX2Nhcm5pY2FfcHJvdmVlZG9yIi8+CgkJCQkJCTxPbl9EZWxldGUgdmFsdWU9Ik5vIEFjdGlvbiIvPgoJCQkJCQk8T25fVXBkYXRlIHZhbHVlPSJDYXNjYWRlIi8+CgkJCQkJCTxQYXJlbnRfVGFibGUgdmFsdWU9InByb3ZlZWRvciIvPgoJCQkJCQk8UHJpbWFyeV9LZXkgdmFsdWU9ImFXUT0iLz4KCQkJCQk8L1Byb3BlcnRpZXM+CgkJCQkJPGNvbnRyb2wgdmFsdWU9IiIvPgoJCQkJCTxkZWxldGUgdmFsdWU9IjAiLz4KCQkJCQk8bmFtZSB2YWx1ZT0ibG5rX3JlY2VwY2lvbl9tYXRlcmlhX3ByaW1hX2Nhcm5pY2FfcHJvdmVlZG9yIi8+CgkJCQk8L28wPgoJCQkJPG8xPgoJC
QkJCTxDaGFuZ2VzIHZhbHVlPSIiLz4KCQkJCQk8UHJvcGVydGllcz4KCQkJCQkJPENhcmRpbmFsaXR5IHZhbHVlPSJPTkUgdG8gTUFOWSIvPgoJCQkJCQk8Q2hpbGRfVGFibGUgdmFsdWU9InJlY2VwY2lvbl9tYXRlcmlhX3ByaW1hX25vX2Nhcm5pY2EiLz4KCQkJCQkJPEZvcmVpZ25fS2V5IHZhbHVlPSJjSEp2ZG1WbFpHOXlYMmxrIi8+CgkJCQkJCTxOYW1lIHZhbHVlPSJsbmtfcmVjZXBjaW9uX21hdGVyaWFfcHJpbWFfbm9fY2FybmljYV9wcm92ZWVkb3IiLz4KCQkJCQkJPE9uX0RlbGV0ZSB2YWx1ZT0iTm8gQWN0aW9uIi8+CgkJCQkJCTxPbl9VcGRhdGUgdmFsdWU9IkNhc2NhZGUiLz4KCQkJCQkJPFBhcmVudF9UYWJsZSB2YWx1ZT0icHJvdmVlZG9yIi8+CgkJCQkJCTxQcmltYXJ5X0tleSB2YWx1ZT0iYVdRPSIvPgoJCQkJCTwvUHJvcGVydGllcz4KCQkJCQk8Y29udHJvbCB2YWx1ZT0iIi8+CgkJCQkJPGRlbGV0ZSB2YWx1ZT0iMCIvPgoJCQkJCTxuYW1lIHZhbHVlPSJsbmtfcmVjZXBjaW9uX21hdGVyaWFfcHJpbWFfbm9fY2FybmljYV9wcm92ZWVkb3IiLz4KCQkJCTwvbzE+CgkJCTwvbGluaz4KCQkJPHRhYmxlPgoJCQkJPG8wPgoJCQkJCTxDaGFuZ2VzIHZhbHVlPSIiLz4KCQkJCQk8UHJvcGVydGllcz4KCQkJCQkJPEF1dG9pbmNyZW1lbnQgdmFsdWU9IjAiLz4KCQkJCQkJPEF2ZXJhZ2VfUm93X1NpemUgdmFsdWU9IjAiLz4KCQkJCQkJPENoYXJzZXQgdmFsdWU9InV0ZjgiLz4KCQkJCQkJPENvbGxhdGlvbiB2YWx1ZT0idXRmOF9nZW5lcmFsX2NpIi8+CgkJCQkJCTxDb21tZW50IHZhbHVlPSIiLz4KCQkJCQkJPENyZWF0ZV9UaW1lIHZhbHVlPSIyMDE1LTAzLTIzIDIwOjQxOjAwIi8+CgkJCQkJCTxFbmdpbmUgdmFsdWU9Iklubm9EQiIvPgoJCQkJCQk8RmllbGRfQ291bnQgdmFsdWU9IjkiLz4KCQkJCQkJPEluZGV4X0NvdW50IHZhbHVlPSIyIi8+CgkJCQkJCTxOYW1lIHZhbHVlPSJwcm92ZWVkb3IiLz4KCQkJCQkJPFByaW1hcnlfS2V5IHZhbHVlPSJhV1E9Ii8+CgkJCQkJCTxTaXplIHZhbHVlPSIzMi4wMCBLYiIvPgoJCQkJCQk8VHJpZ2dlcl9Db3VudCB2YWx1ZT0iMCIvPgoJCQkJCQk8VW5pcXVlX0NvdW50IHZhbHVlPSIxIi8+CgkJCQkJCTxVcGRhdGVfVGltZSB2YWx1ZT0iIi8+CgkJCQkJPC9Qcm9wZXJ0aWVzPgoJCQkJCTxjb250cm9sIHZhbHVlPSJUYWJsZTEiLz4KCQkJCQk8ZGVsZXRlIHZhbHVlPSIwIi8+CgkJCQkJPGZpZWxkPgoJCQkJCQk8bzA+CgkJCQkJCQk8Q2hhbmdlcyB2YWx1ZT0iIi8+CgkJCQkJCQk8UHJvcGVydGllcz4KCQkJCQkJCQk8QXV0b2luY3JlbWVudCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxDaGFyc2V0IHZhbHVlPSJ1dGY4Ii8+CgkJCQkJCQkJPENvbGxhdGlvbiB2YWx1ZT0idXRmOF9nZW5lcmFsX2NpIi8+CgkJCQkJCQkJPENvbW1lbnQgdmFsdWU9IiIvPgoJCQkJCQkJCTxEZWZhdWx0X1ZhbHVlIHZhbHVlPSIiLz4KCQkJCQkJCQk8RmllbGRfUG9zaXRpb24gdmFsdWU9IjgiLz4KCQkJCQkJCQk8SW5kZXhlZCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxMZW5ndGggdmFsdWU9IjUwIi8+CgkJCQkJCQkJPE5hbWUgdmFsdWU9ImNlZHVsYSIvPgoJCQkJCQkJCTxOdWxsYWJsZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxPbl9VcGRhdGVfU2V0X0N1cnJlbnQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8UHJlY2lzaW9uIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFNjYWxlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFR5cGUgdmFsdWU9IlZhckNoYXIiLz4KCQkJCQkJCQk8VW5pcXVlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFVuc2lnbmVkIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFplcm9maWxsIHZhbHVlPSIwIi8+CgkJCQkJCQk8L1Byb3BlcnRpZXM+CgkJCQkJCQk8Y29udHJvbCB2YWx1ZT0iIi8+CgkJCQkJCQk8ZGVsZXRlIHZhbHVlPSIwIi8+CgkJCQkJCQk8bmFtZSB2YWx1ZT0iY2VkdWxhIi8+CgkJCQkJCTwvbzA+CgkJCQkJCTxvMT4KCQkJCQkJCTxDaGFuZ2VzIHZhbHVlPSIiLz4KCQkJCQkJCTxQcm9wZXJ0aWVzPgoJCQkJCQkJCTxBdXRvaW5jcmVtZW50IHZhbHVlPSIwIi8+CgkJCQkJCQkJPENoYXJzZXQgdmFsdWU9InV0ZjgiLz4KCQkJCQkJCQk8Q29sbGF0aW9uIHZhbHVlPSJ1dGY4X2dlbmVyYWxfY2kiLz4KCQkJCQkJCQk8Q29tbWVudCB2YWx1ZT0iIi8+CgkJCQkJCQkJPERlZmF1bHRfVmFsdWUgdmFsdWU9IiIvPgoJCQkJCQkJCTxGaWVsZF9Qb3NpdGlvbiB2YWx1ZT0iNSIvPgoJCQkJCQkJCTxJbmRleGVkIHZhbHVlPSIwIi8+CgkJCQkJCQkJPExlbmd0aCB2YWx1ZT0iMzAiLz4KCQkJCQkJCQk8TmFtZSB2YWx1ZT0iY2VsdWxhciIvPgoJCQkJCQkJCTxOdWxsYWJsZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxPbl9VcGRhdGVfU2V0X0N1cnJlbnQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8UHJlY2lzaW9uIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFNjYWxlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFR5cGUgdmFsdWU9IlZhckNoYXIiLz4KCQkJCQkJCQk8VW5pcXVlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFVuc2lnbmVkIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFplcm9maWxsIHZhbHVlPSIwIi8+CgkJCQkJCQk8L1Byb3BlcnRpZXM+CgkJCQkJCQk8Y29udHJvbCB2YWx1ZT0iIi8+CgkJCQkJCQk8ZGVsZXRlIHZhbHVlPSIwIi8+CgkJCQkJCQk8bmFtZSB2YWx1ZT0iY2VsdWxhciIvPgoJCQkJCQk8L28xPgoJCQkJCQk8bzI+CgkJCQkJCQk8Q2hhbmdlcyB2YWx1ZT0iIi8+CgkJCQkJCQk8UHJvcGVydGllcz4KCQkJCQkJCQk8QXV0b2luY3JlbWVudCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxDaGFyc2V0IHZhbHVlPSJ1dGY4Ii8+CgkJCQkJCQkJPENvbGxhdGlvbiB2YWx1ZT0idXRmOF9nZW5lcmFsX2NpIi8+CgkJCQkJCQkJPENvbW1lbnQgdmFsdWU9IiIvPgoJCQkJCQkJCTxEZWZhdWx0X1ZhbHVlIHZhbHVlPSIiLz4KCQkJCQkJCQk8RmllbGRfUG9zaXRpb24gdmFsdWU9IjQiLz4KCQkJCQkJCQk8SW5kZXhlZCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxMZW5ndGggdmFsdWU9IjI1NSIvPgoJCQkJCQkJCTxOYW1lIHZhbHVlPSJjb3JyZW8iLz4KCQkJCQkJCQk8TnVsbGFibGUgdmFsdWU9IjAiLz4KCQkJCQkJCQk8T
25fVXBkYXRlX1NldF9DdXJyZW50IHZhbHVlPSIwIi8+CgkJCQkJCQkJPFByZWNpc2lvbiB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxTY2FsZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxUeXBlIHZhbHVlPSJWYXJDaGFyIi8+CgkJCQkJCQkJPFVuaXF1ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxVbnNpZ25lZCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxaZXJvZmlsbCB2YWx1ZT0iMCIvPgoJCQkJCQkJPC9Qcm9wZXJ0aWVzPgoJCQkJCQkJPGNvbnRyb2wgdmFsdWU9IiIvPgoJCQkJCQkJPGRlbGV0ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPG5hbWUgdmFsdWU9ImNvcnJlbyIvPgoJCQkJCQk8L28yPgoJCQkJCQk8bzM+CgkJCQkJCQk8Q2hhbmdlcyB2YWx1ZT0iIi8+CgkJCQkJCQk8UHJvcGVydGllcz4KCQkJCQkJCQk8QXV0b2luY3JlbWVudCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxDaGFyc2V0IHZhbHVlPSJ1dGY4Ii8+CgkJCQkJCQkJPENvbGxhdGlvbiB2YWx1ZT0idXRmOF9nZW5lcmFsX2NpIi8+CgkJCQkJCQkJPENvbW1lbnQgdmFsdWU9IiIvPgoJCQkJCQkJCTxEZWZhdWx0X1ZhbHVlIHZhbHVlPSIiLz4KCQkJCQkJCQk8RmllbGRfUG9zaXRpb24gdmFsdWU9IjYiLz4KCQkJCQkJCQk8SW5kZXhlZCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxMZW5ndGggdmFsdWU9IjI1NSIvPgoJCQkJCQkJCTxOYW1lIHZhbHVlPSJkaXJlY2Npb24iLz4KCQkJCQkJCQk8TnVsbGFibGUgdmFsdWU9IjAiLz4KCQkJCQkJCQk8T25fVXBkYXRlX1NldF9DdXJyZW50IHZhbHVlPSIwIi8+CgkJCQkJCQkJPFByZWNpc2lvbiB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxTY2FsZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxUeXBlIHZhbHVlPSJWYXJDaGFyIi8+CgkJCQkJCQkJPFVuaXF1ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxVbnNpZ25lZCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxaZXJvZmlsbCB2YWx1ZT0iMCIvPgoJCQkJCQkJPC9Qcm9wZXJ0aWVzPgoJCQkJCQkJPGNvbnRyb2wgdmFsdWU9IiIvPgoJCQkJCQkJPGRlbGV0ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPG5hbWUgdmFsdWU9ImRpcmVjY2lvbiIvPgoJCQkJCQk8L28zPgoJCQkJCQk8bzQ+CgkJCQkJCQk8Q2hhbmdlcyB2YWx1ZT0iIi8+CgkJCQkJCQk8UHJvcGVydGllcz4KCQkJCQkJCQk8QXV0b2luY3JlbWVudCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxDaGFyc2V0IHZhbHVlPSIiLz4KCQkJCQkJCQk8Q29sbGF0aW9uIHZhbHVlPSIiLz4KCQkJCQkJCQk8Q29tbWVudCB2YWx1ZT0iIi8+CgkJCQkJCQkJPERlZmF1bHRfVmFsdWUgdmFsdWU9IiIvPgoJCQkJCQkJCTxGaWVsZF9Qb3NpdGlvbiB2YWx1ZT0iMSIvPgoJCQkJCQkJCTxJbmRleGVkIHZhbHVlPSIxIi8+CgkJCQkJCQkJPExlbmd0aCB2YWx1ZT0iMTEiLz4KCQkJCQkJCQk8TmFtZSB2YWx1ZT0iaWQiLz4KCQkJCQkJCQk8TnVsbGFibGUgdmFsdWU9IjAiLz4KCQkJCQkJCQk8T25fVXBkYXRlX1NldF9DdXJyZW50IHZhbHVlPSIwIi8+CgkJCQkJCQkJPFByZWNpc2lvbiB2YWx1ZT0iMTAiLz4KCQkJCQkJCQk8U2NhbGUgdmFsdWU9IjAiLz4KCQkJCQkJCQk8VHlwZSB2YWx1ZT0iSW50Ii8+CgkJCQkJCQkJPFVuaXF1ZSB2YWx1ZT0iMSIvPgoJCQkJCQkJCTxVbnNpZ25lZCB2YWx1ZT0iMSIvPgoJCQkJCQkJCTxaZXJvZmlsbCB2YWx1ZT0iMCIvPgoJCQkJCQkJPC9Qcm9wZXJ0aWVzPgoJCQkJCQkJPGNvbnRyb2wgdmFsdWU9IiIvPgoJCQkJCQkJPGRlbGV0ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPG5hbWUgdmFsdWU9ImlkIi8+CgkJCQkJCTwvbzQ+CgkJCQkJCTxvNT4KCQkJCQkJCTxDaGFuZ2VzIHZhbHVlPSIiLz4KCQkJCQkJCTxQcm9wZXJ0aWVzPgoJCQkJCQkJCTxBdXRvaW5jcmVtZW50IHZhbHVlPSIwIi8+CgkJCQkJCQkJPENoYXJzZXQgdmFsdWU9InV0ZjgiLz4KCQkJCQkJCQk8Q29sbGF0aW9uIHZhbHVlPSJ1dGY4X2dlbmVyYWxfY2kiLz4KCQkJCQkJCQk8Q29tbWVudCB2YWx1ZT0iIi8+CgkJCQkJCQkJPERlZmF1bHRfVmFsdWUgdmFsdWU9IiIvPgoJCQkJCQkJCTxGaWVsZF9Qb3NpdGlvbiB2YWx1ZT0iOSIvPgoJCQkJCQkJCTxJbmRleGVkIHZhbHVlPSIxIi8+CgkJCQkJCQkJPExlbmd0aCB2YWx1ZT0iOCIvPgoJCQkJCQkJCTxOYW1lIHZhbHVlPSJtdW5pY2lwaW9faWQiLz4KCQkJCQkJCQk8TnVsbGFibGUgdmFsdWU9IjAiLz4KCQkJCQkJCQk8T25fVXBkYXRlX1NldF9DdXJyZW50IHZhbHVlPSIwIi8+CgkJCQkJCQkJPFByZWNpc2lvbiB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxTY2FsZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxUeXBlIHZhbHVlPSJWYXJDaGFyIi8+CgkJCQkJCQkJPFVuaXF1ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxVbnNpZ25lZCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxaZXJvZmlsbCB2YWx1ZT0iMCIvPgoJCQkJCQkJPC9Qcm9wZXJ0aWVzPgoJCQkJCQkJPGNvbnRyb2wgdmFsdWU9IiIvPgoJCQkJCQkJPGRlbGV0ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPG5hbWUgdmFsdWU9Im11bmljaXBpb19pZCIvPgoJCQkJCQk8L281PgoJCQkJCQk8bzY+CgkJCQkJCQk8Q2hhbmdlcyB2YWx1ZT0iIi8+CgkJCQkJCQk8UHJvcGVydGllcz4KCQkJCQkJCQk8QXV0b2luY3JlbWVudCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxDaGFyc2V0IHZhbHVlPSJ1dGY4Ii8+CgkJCQkJCQkJPENvbGxhdGlvbiB2YWx1ZT0idXRmOF9nZW5lcmFsX2NpIi8+CgkJCQkJCQkJPENvbW1lbnQgdmFsdWU9IiIvPgoJCQkJCQkJCTxEZWZhdWx0X1ZhbHVlIHZhbHVlPSIiLz4KCQkJCQkJCQk8RmllbGRfUG9zaXRpb24gdmFsdWU9IjIiLz4KCQkJCQkJCQk8SW5kZXhlZCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxMZW5ndGggdmFsdWU9IjEwMCIvPgoJCQkJCQkJCTxOYW1lIHZhbHVlPSJub21fcHJvdmVlZG9yIi8+CgkJCQkJCQkJPE51bGxhYmxlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPE9uX1VwZGF0ZV9TZXRfQ3VycmVudCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxQcmVjaXNpb24gdmFsdWU9IjAiLz4KCQkJCQkJCQk8U2NhbGUgdmFsdWU9IjAiLz4KCQkJCQkJCQk8VHlwZSB2YWx1ZT0iVmFyQ2hhciIvPgoJCQkJCQkJCTxVbmlxdWUgdmFsdWU9IjAiLz4KCQkJCQkJCQk8VW5zaWduZWQgdmFsdWU9I
jAiLz4KCQkJCQkJCQk8WmVyb2ZpbGwgdmFsdWU9IjAiLz4KCQkJCQkJCTwvUHJvcGVydGllcz4KCQkJCQkJCTxjb250cm9sIHZhbHVlPSIiLz4KCQkJCQkJCTxkZWxldGUgdmFsdWU9IjAiLz4KCQkJCQkJCTxuYW1lIHZhbHVlPSJub21fcHJvdmVlZG9yIi8+CgkJCQkJCTwvbzY+CgkJCQkJCTxvNz4KCQkJCQkJCTxDaGFuZ2VzIHZhbHVlPSIiLz4KCQkJCQkJCTxQcm9wZXJ0aWVzPgoJCQkJCQkJCTxBdXRvaW5jcmVtZW50IHZhbHVlPSIwIi8+CgkJCQkJCQkJPENoYXJzZXQgdmFsdWU9InV0ZjgiLz4KCQkJCQkJCQk8Q29sbGF0aW9uIHZhbHVlPSJ1dGY4X2dlbmVyYWxfY2kiLz4KCQkJCQkJCQk8Q29tbWVudCB2YWx1ZT0iMCA9IGNlZHVsYQoxID0gZXh0cmFuamVyaWEKMiA9IG90cm8iLz4KCQkJCQkJCQk8RGVmYXVsdF9WYWx1ZSB2YWx1ZT0iIi8+CgkJCQkJCQkJPEVsZW1lbnRzIHZhbHVlPSIiLz4KCQkJCQkJCQk8RmllbGRfUG9zaXRpb24gdmFsdWU9IjciLz4KCQkJCQkJCQk8SW5kZXhlZCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxMZW5ndGggdmFsdWU9Ii0xIi8+CgkJCQkJCQkJPE5hbWUgdmFsdWU9InRpcG9fZG9jIi8+CgkJCQkJCQkJPE51bGxhYmxlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPE9uX1VwZGF0ZV9TZXRfQ3VycmVudCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxQcmVjaXNpb24gdmFsdWU9IjAiLz4KCQkJCQkJCQk8U2NhbGUgdmFsdWU9IjAiLz4KCQkJCQkJCQk8VHlwZSB2YWx1ZT0iRW51bSIvPgoJCQkJCQkJCTxVbmlxdWUgdmFsdWU9IjAiLz4KCQkJCQkJCQk8VW5zaWduZWQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8WmVyb2ZpbGwgdmFsdWU9IjAiLz4KCQkJCQkJCTwvUHJvcGVydGllcz4KCQkJCQkJCTxjb250cm9sIHZhbHVlPSIiLz4KCQkJCQkJCTxkZWxldGUgdmFsdWU9IjAiLz4KCQkJCQkJCTxuYW1lIHZhbHVlPSJ0aXBvX2RvYyIvPgoJCQkJCQk8L283PgoJCQkJCQk8bzg+CgkJCQkJCQk8Q2hhbmdlcyB2YWx1ZT0iIi8+CgkJCQkJCQk8UHJvcGVydGllcz4KCQkJCQkJCQk8QXV0b2luY3JlbWVudCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxDaGFyc2V0IHZhbHVlPSJ1dGY4Ii8+CgkJCQkJCQkJPENvbGxhdGlvbiB2YWx1ZT0idXRmOF9nZW5lcmFsX2NpIi8+CgkJCQkJCQkJPENvbW1lbnQgdmFsdWU9IjAgPSBlbXByZXNhCjEgPSBwYXJ0aWN1bGFyIi8+CgkJCQkJCQkJPERlZmF1bHRfVmFsdWUgdmFsdWU9IiIvPgoJCQkJCQkJCTxFbGVtZW50cyB2YWx1ZT0iTUE9PSBNUT09Ii8+CgkJCQkJCQkJPEZpZWxkX1Bvc2l0aW9uIHZhbHVlPSIzIi8+CgkJCQkJCQkJPEluZGV4ZWQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8TGVuZ3RoIHZhbHVlPSItMSIvPgoJCQkJCQkJCTxOYW1lIHZhbHVlPSJ0aXBvX3Byb3ZlZWRvciIvPgoJCQkJCQkJCTxOdWxsYWJsZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxPbl9VcGRhdGVfU2V0X0N1cnJlbnQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8UHJlY2lzaW9uIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFNjYWxlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFR5cGUgdmFsdWU9IkVudW0iLz4KCQkJCQkJCQk8VW5pcXVlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFVuc2lnbmVkIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFplcm9maWxsIHZhbHVlPSIwIi8+CgkJCQkJCQk8L1Byb3BlcnRpZXM+CgkJCQkJCQk8Y29udHJvbCB2YWx1ZT0iIi8+CgkJCQkJCQk8ZGVsZXRlIHZhbHVlPSIwIi8+CgkJCQkJCQk8bmFtZSB2YWx1ZT0idGlwb19wcm92ZWVkb3IiLz4KCQkJCQkJPC9vOD4KCQkJCQk8L2ZpZWxkPgoJCQkJCTxpbmRleD4KCQkJCQkJPG8wPgoJCQkJCQkJPENoYW5nZXMgdmFsdWU9IiIvPgoJCQkJCQkJPFByb3BlcnRpZXM+CgkJCQkJCQkJPENvbW1lbnQgdmFsdWU9IiIvPgoJCQkJCQkJCTxGaWVsZHMgdmFsdWU9ImJYVnVhV05wY0dsdlgybGsiLz4KCQkJCQkJCQk8TmFtZSB2YWx1ZT0ibG5rX3Byb3ZlZWRvcl9tdW5pY2lwaW8iLz4KCQkJCQkJCQk8VHlwZSB2YWx1ZT0iQlRSRUUiLz4KCQkJCQkJCQk8VW5pcXVlIHZhbHVlPSIwIi8+CgkJCQkJCQk8L1Byb3BlcnRpZXM+CgkJCQkJCQk8Y29udHJvbCB2YWx1ZT0iIi8+CgkJCQkJCQk8ZGVsZXRlIHZhbHVlPSIwIi8+CgkJCQkJCQk8bmFtZSB2YWx1ZT0ibG5rX3Byb3ZlZWRvcl9tdW5pY2lwaW8iLz4KCQkJCQkJPC9vMD4KCQkJCQkJPG8xPgoJCQkJCQkJPENoYW5nZXMgdmFsdWU9IiIvPgoJCQkJCQkJPFByb3BlcnRpZXM+CgkJCQkJCQkJPENvbW1lbnQgdmFsdWU9IiIvPgoJCQkJCQkJCTxGaWVsZHMgdmFsdWU9ImFXUT0iLz4KCQkJCQkJCQk8TmFtZSB2YWx1ZT0iUFJJTUFSWSIvPgoJCQkJCQkJCTxUeXBlIHZhbHVlPSJCVFJFRSIvPgoJCQkJCQkJCTxVbmlxdWUgdmFsdWU9IjEiLz4KCQkJCQkJCTwvUHJvcGVydGllcz4KCQkJCQkJCTxjb250cm9sIHZhbHVlPSIiLz4KCQkJCQkJCTxkZWxldGUgdmFsdWU9IjAiLz4KCQkJCQkJCTxuYW1lIHZhbHVlPSJQUklNQVJZIi8+CgkJCQkJCTwvbzE+CgkJCQkJPC9pbmRleD4KCQkJCQk8bmFtZSB2YWx1ZT0icHJvdmVlZG9yIi8+CgkJCQkJPHVuaXF1ZT4KCQkJCQkJPG8wPgoJCQkJCQkJPENoYW5nZXMgdmFsdWU9IiIvPgoJCQkJCQkJPFByb3BlcnRpZXM+CgkJCQkJCQkJPEZpZWxkcyB2YWx1ZT0iYVdRPSIvPgoJCQkJCQkJCTxOYW1lIHZhbHVlPSJQUklNQVJZIi8+CgkJCQkJCQk8L1Byb3BlcnRpZXM+CgkJCQkJCQk8Y29udHJvbCB2YWx1ZT0iIi8+CgkJCQkJCQk8ZGVsZXRlIHZhbHVlPSIwIi8+CgkJCQkJCQk8bmFtZSB2YWx1ZT0iUFJJTUFSWSIvPgoJCQkJCQk8L28wPgoJCQkJCTwvdW5pcXVlPgoJCQkJPC9vMD4KCQkJCTxvMT4KCQkJCQk8Q2hhbmdlcyB2YWx1ZT0iIi8+CgkJCQkJPFByb3BlcnRpZXM+CgkJCQkJCTxBdXRvaW5jcmVtZW50IHZhbHVlPSIxIi8+CgkJCQkJCTxBdmVyYWdlX1Jvd19TaXplIHZhbHVlPSIwIi8+CgkJCQkJCTxDaGFyc2V0IHZhbHVlPSJ1dGY4Ii8+CgkJCQkJCTxDb2xsYXRpb24gdmFsdWU9InV0ZjhfZ2VuZXJhbF9jaSIvPgoJCQkJCQk8Q29tbWVudCB2YWx1ZT0iIi8+CgkJCQkJCTxDcmVhdGVfVGltZSB2YWx1ZT0iMjAxNS0wNC0yNyAyMDozNDoxMiIvPgoJCQkJCQk8R
W5naW5lIHZhbHVlPSJJbm5vREIiLz4KCQkJCQkJPEZpZWxkX0NvdW50IHZhbHVlPSIxNyIvPgoJCQkJCQk8SW5kZXhfQ291bnQgdmFsdWU9IjQiLz4KCQkJCQkJPExpbmtfQ291bnQgdmFsdWU9IjMiLz4KCQkJCQkJPE5hbWUgdmFsdWU9InJlY2VwY2lvbl9tYXRlcmlhX3ByaW1hX2Nhcm5pY2EiLz4KCQkJCQkJPFByaW1hcnlfS2V5IHZhbHVlPSJhV1E9Ii8+CgkJCQkJCTxSZWNvcmRfQ291bnQgdmFsdWU9IjAiLz4KCQkJCQkJPFNpemUgdmFsdWU9IjY0LjAwIEtiIi8+CgkJCQkJCTxUcmlnZ2VyX0NvdW50IHZhbHVlPSIwIi8+CgkJCQkJCTxVbmlxdWVfQ291bnQgdmFsdWU9IjEiLz4KCQkJCQkJPFVwZGF0ZV9UaW1lIHZhbHVlPSIiLz4KCQkJCQk8L1Byb3BlcnRpZXM+CgkJCQkJPGNvbnRyb2wgdmFsdWU9IlRhYmxlMiIvPgoJCQkJCTxkZWxldGUgdmFsdWU9IjAiLz4KCQkJCQk8ZmllbGQ+CgkJCQkJCTxvMD4KCQkJCQkJCTxDaGFuZ2VzIHZhbHVlPSIiLz4KCQkJCQkJCTxQcm9wZXJ0aWVzPgoJCQkJCQkJCTxBdXRvaW5jcmVtZW50IHZhbHVlPSIwIi8+CgkJCQkJCQkJPENoYXJzZXQgdmFsdWU9InV0ZjgiLz4KCQkJCQkJCQk8Q29sbGF0aW9uIHZhbHVlPSJ1dGY4X2dlbmVyYWxfY2kiLz4KCQkJCQkJCQk8Q29tbWVudCB2YWx1ZT0iIi8+CgkJCQkJCQkJPERlZmF1bHRfVmFsdWUgdmFsdWU9IiIvPgoJCQkJCQkJCTxFbGVtZW50cyB2YWx1ZT0iTUE9PSBNUT09Ii8+CgkJCQkJCQkJPEZpZWxkX1Bvc2l0aW9uIHZhbHVlPSIxMCIvPgoJCQkJCQkJCTxJbmRleGVkIHZhbHVlPSIwIi8+CgkJCQkJCQkJPExlbmd0aCB2YWx1ZT0iLTEiLz4KCQkJCQkJCQk8TmFtZSB2YWx1ZT0iY2FyY3Rfb3JnbGVwdGljYV9jX3RlbXBlcmF0dXJhIi8+CgkJCQkJCQkJPE51bGxhYmxlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPE9uX1VwZGF0ZV9TZXRfQ3VycmVudCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxQcmVjaXNpb24gdmFsdWU9IjAiLz4KCQkJCQkJCQk8U2NhbGUgdmFsdWU9IjAiLz4KCQkJCQkJCQk8VHlwZSB2YWx1ZT0iRW51bSIvPgoJCQkJCQkJCTxVbmlxdWUgdmFsdWU9IjAiLz4KCQkJCQkJCQk8VW5zaWduZWQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8WmVyb2ZpbGwgdmFsdWU9IjAiLz4KCQkJCQkJCTwvUHJvcGVydGllcz4KCQkJCQkJCTxjb250cm9sIHZhbHVlPSIiLz4KCQkJCQkJCTxkZWxldGUgdmFsdWU9IjAiLz4KCQkJCQkJCTxuYW1lIHZhbHVlPSJjYXJjdF9vcmdsZXB0aWNhX2NfdGVtcGVyYXR1cmEiLz4KCQkJCQkJPC9vMD4KCQkJCQkJPG8xPgoJCQkJCQkJPENoYW5nZXMgdmFsdWU9IiIvPgoJCQkJCQkJPFByb3BlcnRpZXM+CgkJCQkJCQkJPEF1dG9pbmNyZW1lbnQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8Q2hhcnNldCB2YWx1ZT0idXRmOCIvPgoJCQkJCQkJCTxDb2xsYXRpb24gdmFsdWU9InV0ZjhfZ2VuZXJhbF9jaSIvPgoJCQkJCQkJCTxDb21tZW50IHZhbHVlPSIiLz4KCQkJCQkJCQk8RGVmYXVsdF9WYWx1ZSB2YWx1ZT0iIi8+CgkJCQkJCQkJPEVsZW1lbnRzIHZhbHVlPSJNQT09IE1RPT0iLz4KCQkJCQkJCQk8RmllbGRfUG9zaXRpb24gdmFsdWU9IjgiLz4KCQkJCQkJCQk8SW5kZXhlZCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxMZW5ndGggdmFsdWU9Ii0xIi8+CgkJCQkJCQkJPE5hbWUgdmFsdWU9ImNhcmN0X29yZ2xlcHRpY2FfY29sb3IiLz4KCQkJCQkJCQk8TnVsbGFibGUgdmFsdWU9IjAiLz4KCQkJCQkJCQk8T25fVXBkYXRlX1NldF9DdXJyZW50IHZhbHVlPSIwIi8+CgkJCQkJCQkJPFByZWNpc2lvbiB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxTY2FsZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxUeXBlIHZhbHVlPSJFbnVtIi8+CgkJCQkJCQkJPFVuaXF1ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxVbnNpZ25lZCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxaZXJvZmlsbCB2YWx1ZT0iMCIvPgoJCQkJCQkJPC9Qcm9wZXJ0aWVzPgoJCQkJCQkJPGNvbnRyb2wgdmFsdWU9IiIvPgoJCQkJCQkJPGRlbGV0ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPG5hbWUgdmFsdWU9ImNhcmN0X29yZ2xlcHRpY2FfY29sb3IiLz4KCQkJCQkJPC9vMT4KCQkJCQkJPG8xMD4KCQkJCQkJCTxDaGFuZ2VzIHZhbHVlPSIiLz4KCQkJCQkJCTxQcm9wZXJ0aWVzPgoJCQkJCQkJCTxBdXRvaW5jcmVtZW50IHZhbHVlPSIxIi8+CgkJCQkJCQkJPENoYXJzZXQgdmFsdWU9IiIvPgoJCQkJCQkJCTxDb2xsYXRpb24gdmFsdWU9IiIvPgoJCQkJCQkJCTxDb21tZW50IHZhbHVlPSIiLz4KCQkJCQkJCQk8RGVmYXVsdF9WYWx1ZSB2YWx1ZT0iIi8+CgkJCQkJCQkJPEZpZWxkX1Bvc2l0aW9uIHZhbHVlPSIxIi8+CgkJCQkJCQkJPEluZGV4ZWQgdmFsdWU9IjEiLz4KCQkJCQkJCQk8TGVuZ3RoIHZhbHVlPSIxMSIvPgoJCQkJCQkJCTxOYW1lIHZhbHVlPSJpZCIvPgoJCQkJCQkJCTxOdWxsYWJsZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxPbl9VcGRhdGVfU2V0X0N1cnJlbnQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8UHJlY2lzaW9uIHZhbHVlPSIxMCIvPgoJCQkJCQkJCTxTY2FsZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxUeXBlIHZhbHVlPSJJbnQiLz4KCQkJCQkJCQk8VW5pcXVlIHZhbHVlPSIxIi8+CgkJCQkJCQkJPFVuc2lnbmVkIHZhbHVlPSIxIi8+CgkJCQkJCQkJPFplcm9maWxsIHZhbHVlPSIwIi8+CgkJCQkJCQk8L1Byb3BlcnRpZXM+CgkJCQkJCQk8Y29udHJvbCB2YWx1ZT0iIi8+CgkJCQkJCQk8ZGVsZXRlIHZhbHVlPSIwIi8+CgkJCQkJCQk8bmFtZSB2YWx1ZT0iaWQiLz4KCQkJCQkJPC9vMTA+CgkJCQkJCTxvMTE+CgkJCQkJCQk8Q2hhbmdlcyB2YWx1ZT0iIi8+CgkJCQkJCQk8UHJvcGVydGllcz4KCQkJCQkJCQk8QXV0b2luY3JlbWVudCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxDaGFyc2V0IHZhbHVlPSJ1dGY4Ii8+CgkJCQkJCQkJPENvbGxhdGlvbiB2YWx1ZT0idXRmOF9nZW5lcmFsX2NpIi8+CgkJCQkJCQkJPENvbW1lbnQgdmFsdWU9IiIvPgoJCQkJCQkJCTxEZWZhdWx0X1ZhbHVlIHZhbHVlPSIiLz4KCQkJCQkJCQk8RmllbGRfUG9zaXRpb24gdmFsdWU9IjMiLz4KCQkJCQkJCQk8SW5kZXhlZCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxMZW5ndGggdmFsdWU9IjEwM
CIvPgoJCQkJCQkJCTxOYW1lIHZhbHVlPSJsb3RlX2ludGVybm8iLz4KCQkJCQkJCQk8TnVsbGFibGUgdmFsdWU9IjAiLz4KCQkJCQkJCQk8T25fVXBkYXRlX1NldF9DdXJyZW50IHZhbHVlPSIwIi8+CgkJCQkJCQkJPFByZWNpc2lvbiB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxTY2FsZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxUeXBlIHZhbHVlPSJWYXJDaGFyIi8+CgkJCQkJCQkJPFVuaXF1ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxVbnNpZ25lZCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxaZXJvZmlsbCB2YWx1ZT0iMCIvPgoJCQkJCQkJPC9Qcm9wZXJ0aWVzPgoJCQkJCQkJPGNvbnRyb2wgdmFsdWU9IiIvPgoJCQkJCQkJPGRlbGV0ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPG5hbWUgdmFsdWU9ImxvdGVfaW50ZXJubyIvPgoJCQkJCQk8L28xMT4KCQkJCQkJPG8xMj4KCQkJCQkJCTxDaGFuZ2VzIHZhbHVlPSIiLz4KCQkJCQkJCTxQcm9wZXJ0aWVzPgoJCQkJCQkJCTxBdXRvaW5jcmVtZW50IHZhbHVlPSIwIi8+CgkJCQkJCQkJPENoYXJzZXQgdmFsdWU9IiIvPgoJCQkJCQkJCTxDb2xsYXRpb24gdmFsdWU9IiIvPgoJCQkJCQkJCTxDb21tZW50IHZhbHVlPSIiLz4KCQkJCQkJCQk8RGVmYXVsdF9WYWx1ZSB2YWx1ZT0iIi8+CgkJCQkJCQkJPEZpZWxkX1Bvc2l0aW9uIHZhbHVlPSI1Ii8+CgkJCQkJCQkJPEluZGV4ZWQgdmFsdWU9IjEiLz4KCQkJCQkJCQk8TGVuZ3RoIHZhbHVlPSIxMSIvPgoJCQkJCQkJCTxOYW1lIHZhbHVlPSJtYXRlcmlhX3ByaW1hX2luc3VtbyIvPgoJCQkJCQkJCTxOdWxsYWJsZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxPbl9VcGRhdGVfU2V0X0N1cnJlbnQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8UHJlY2lzaW9uIHZhbHVlPSIxMCIvPgoJCQkJCQkJCTxTY2FsZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxUeXBlIHZhbHVlPSJJbnQiLz4KCQkJCQkJCQk8VW5pcXVlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFVuc2lnbmVkIHZhbHVlPSIxIi8+CgkJCQkJCQkJPFplcm9maWxsIHZhbHVlPSIwIi8+CgkJCQkJCQk8L1Byb3BlcnRpZXM+CgkJCQkJCQk8Y29udHJvbCB2YWx1ZT0iIi8+CgkJCQkJCQk8ZGVsZXRlIHZhbHVlPSIwIi8+CgkJCQkJCQk8bmFtZSB2YWx1ZT0ibWF0ZXJpYV9wcmltYV9pbnN1bW8iLz4KCQkJCQkJPC9vMTI+CgkJCQkJCTxvMTM+CgkJCQkJCQk8Q2hhbmdlcyB2YWx1ZT0iIi8+CgkJCQkJCQk8UHJvcGVydGllcz4KCQkJCQkJCQk8QXV0b2luY3JlbWVudCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxDaGFyc2V0IHZhbHVlPSIiLz4KCQkJCQkJCQk8Q29sbGF0aW9uIHZhbHVlPSIiLz4KCQkJCQkJCQk8Q29tbWVudCB2YWx1ZT0iIi8+CgkJCQkJCQkJPERlZmF1bHRfVmFsdWUgdmFsdWU9IiIvPgoJCQkJCQkJCTxGaWVsZF9Qb3NpdGlvbiB2YWx1ZT0iNiIvPgoJCQkJCQkJCTxJbmRleGVkIHZhbHVlPSIwIi8+CgkJCQkJCQkJPExlbmd0aCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxOYW1lIHZhbHVlPSJwZXNvIi8+CgkJCQkJCQkJPE51bGxhYmxlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPE9uX1VwZGF0ZV9TZXRfQ3VycmVudCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxQcmVjaXNpb24gdmFsdWU9IjQiLz4KCQkJCQkJCQk8U2NhbGUgdmFsdWU9IjEiLz4KCQkJCQkJCQk8VHlwZSB2YWx1ZT0iRGVjaW1hbCIvPgoJCQkJCQkJCTxVbmlxdWUgdmFsdWU9IjAiLz4KCQkJCQkJCQk8VW5zaWduZWQgdmFsdWU9IjEiLz4KCQkJCQkJCQk8WmVyb2ZpbGwgdmFsdWU9IjAiLz4KCQkJCQkJCTwvUHJvcGVydGllcz4KCQkJCQkJCTxjb250cm9sIHZhbHVlPSIiLz4KCQkJCQkJCTxkZWxldGUgdmFsdWU9IjAiLz4KCQkJCQkJCTxuYW1lIHZhbHVlPSJwZXNvIi8+CgkJCQkJCTwvbzEzPgoJCQkJCQk8bzE0PgoJCQkJCQkJPENoYW5nZXMgdmFsdWU9IiIvPgoJCQkJCQkJPFByb3BlcnRpZXM+CgkJCQkJCQkJPEF1dG9pbmNyZW1lbnQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8Q2hhcnNldCB2YWx1ZT0iIi8+CgkJCQkJCQkJPENvbGxhdGlvbiB2YWx1ZT0iIi8+CgkJCQkJCQkJPENvbW1lbnQgdmFsdWU9IiIvPgoJCQkJCQkJCTxEZWZhdWx0X1ZhbHVlIHZhbHVlPSIiLz4KCQkJCQkJCQk8RmllbGRfUG9zaXRpb24gdmFsdWU9IjQiLz4KCQkJCQkJCQk8SW5kZXhlZCB2YWx1ZT0iMSIvPgoJCQkJCQkJCTxMZW5ndGggdmFsdWU9IjExIi8+CgkJCQkJCQkJPE5hbWUgdmFsdWU9InByb3ZlZWRvciIvPgoJCQkJCQkJCTxOdWxsYWJsZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxPbl9VcGRhdGVfU2V0X0N1cnJlbnQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8UHJlY2lzaW9uIHZhbHVlPSIxMCIvPgoJCQkJCQkJCTxTY2FsZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxUeXBlIHZhbHVlPSJJbnQiLz4KCQkJCQkJCQk8VW5pcXVlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFVuc2lnbmVkIHZhbHVlPSIxIi8+CgkJCQkJCQkJPFplcm9maWxsIHZhbHVlPSIwIi8+CgkJCQkJCQk8L1Byb3BlcnRpZXM+CgkJCQkJCQk8Y29udHJvbCB2YWx1ZT0iIi8+CgkJCQkJCQk8ZGVsZXRlIHZhbHVlPSIwIi8+CgkJCQkJCQk8bmFtZSB2YWx1ZT0icHJvdmVlZG9yIi8+CgkJCQkJCTwvbzE0PgoJCQkJCQk8bzE1PgoJCQkJCQkJPENoYW5nZXMgdmFsdWU9IiIvPgoJCQkJCQkJPFByb3BlcnRpZXM+CgkJCQkJCQkJPEF1dG9pbmNyZW1lbnQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8Q2hhcnNldCB2YWx1ZT0iIi8+CgkJCQkJCQkJPENvbGxhdGlvbiB2YWx1ZT0iIi8+CgkJCQkJCQkJPENvbW1lbnQgdmFsdWU9IiIvPgoJCQkJCQkJCTxEZWZhdWx0X1ZhbHVlIHZhbHVlPSIiLz4KCQkJCQkJCQk8RmllbGRfUG9zaXRpb24gdmFsdWU9IjE3Ii8+CgkJCQkJCQkJPEluZGV4ZWQgdmFsdWU9IjEiLz4KCQkJCQkJCQk8TGVuZ3RoIHZhbHVlPSIxMSIvPgoJCQkJCQkJCTxOYW1lIHZhbHVlPSJyZWNpYmlkbyIvPgoJCQkJCQkJCTxOdWxsYWJsZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxPbl9VcGRhdGVfU2V0X0N1cnJlbnQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8UHJlY2lzaW9uIHZhbHVlPSIxMCIvPgoJCQkJCQkJCTxTY2FsZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxUeXBlIHZhbHVlPSJJbnQiLz4KCQkJCQkJC
Qk8VW5pcXVlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFVuc2lnbmVkIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFplcm9maWxsIHZhbHVlPSIwIi8+CgkJCQkJCQk8L1Byb3BlcnRpZXM+CgkJCQkJCQk8Y29udHJvbCB2YWx1ZT0iIi8+CgkJCQkJCQk8ZGVsZXRlIHZhbHVlPSIwIi8+CgkJCQkJCQk8bmFtZSB2YWx1ZT0icmVjaWJpZG8iLz4KCQkJCQkJPC9vMTU+CgkJCQkJCTxvMTY+CgkJCQkJCQk8Q2hhbmdlcyB2YWx1ZT0iIi8+CgkJCQkJCQk8UHJvcGVydGllcz4KCQkJCQkJCQk8QXV0b2luY3JlbWVudCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxDaGFyc2V0IHZhbHVlPSIiLz4KCQkJCQkJCQk8Q29sbGF0aW9uIHZhbHVlPSIiLz4KCQkJCQkJCQk8Q29tbWVudCB2YWx1ZT0iIi8+CgkJCQkJCQkJPERlZmF1bHRfVmFsdWUgdmFsdWU9IiIvPgoJCQkJCQkJCTxGaWVsZF9Qb3NpdGlvbiB2YWx1ZT0iNyIvPgoJCQkJCQkJCTxJbmRleGVkIHZhbHVlPSIwIi8+CgkJCQkJCQkJPExlbmd0aCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxOYW1lIHZhbHVlPSJ0ZW1wZXJhdHVyYV9sbGVnYWRhIi8+CgkJCQkJCQkJPE51bGxhYmxlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPE9uX1VwZGF0ZV9TZXRfQ3VycmVudCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxQcmVjaXNpb24gdmFsdWU9IjIiLz4KCQkJCQkJCQk8U2NhbGUgdmFsdWU9IjEiLz4KCQkJCQkJCQk8VHlwZSB2YWx1ZT0iRGVjaW1hbCIvPgoJCQkJCQkJCTxVbmlxdWUgdmFsdWU9IjAiLz4KCQkJCQkJCQk8VW5zaWduZWQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8WmVyb2ZpbGwgdmFsdWU9IjAiLz4KCQkJCQkJCTwvUHJvcGVydGllcz4KCQkJCQkJCTxjb250cm9sIHZhbHVlPSIiLz4KCQkJCQkJCTxkZWxldGUgdmFsdWU9IjAiLz4KCQkJCQkJCTxuYW1lIHZhbHVlPSJ0ZW1wZXJhdHVyYV9sbGVnYWRhIi8+CgkJCQkJCTwvbzE2PgoJCQkJCQk8bzI+CgkJCQkJCQk8Q2hhbmdlcyB2YWx1ZT0iIi8+CgkJCQkJCQk8UHJvcGVydGllcz4KCQkJCQkJCQk8QXV0b2luY3JlbWVudCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxDaGFyc2V0IHZhbHVlPSJ1dGY4Ii8+CgkJCQkJCQkJPENvbGxhdGlvbiB2YWx1ZT0idXRmOF9nZW5lcmFsX2NpIi8+CgkJCQkJCQkJPENvbW1lbnQgdmFsdWU9IiIvPgoJCQkJCQkJCTxEZWZhdWx0X1ZhbHVlIHZhbHVlPSIiLz4KCQkJCQkJCQk8RWxlbWVudHMgdmFsdWU9Ik1BPT0gTVE9PSIvPgoJCQkJCQkJCTxGaWVsZF9Qb3NpdGlvbiB2YWx1ZT0iOSIvPgoJCQkJCQkJCTxJbmRleGVkIHZhbHVlPSIwIi8+CgkJCQkJCQkJPExlbmd0aCB2YWx1ZT0iLTEiLz4KCQkJCQkJCQk8TmFtZSB2YWx1ZT0iY2FyY3Rfb3JnbGVwdGljYV9vbG9yIi8+CgkJCQkJCQkJPE51bGxhYmxlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPE9uX1VwZGF0ZV9TZXRfQ3VycmVudCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxQcmVjaXNpb24gdmFsdWU9IjAiLz4KCQkJCQkJCQk8U2NhbGUgdmFsdWU9IjAiLz4KCQkJCQkJCQk8VHlwZSB2YWx1ZT0iRW51bSIvPgoJCQkJCQkJCTxVbmlxdWUgdmFsdWU9IjAiLz4KCQkJCQkJCQk8VW5zaWduZWQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8WmVyb2ZpbGwgdmFsdWU9IjAiLz4KCQkJCQkJCTwvUHJvcGVydGllcz4KCQkJCQkJCTxjb250cm9sIHZhbHVlPSIiLz4KCQkJCQkJCTxkZWxldGUgdmFsdWU9IjAiLz4KCQkJCQkJCTxuYW1lIHZhbHVlPSJjYXJjdF9vcmdsZXB0aWNhX29sb3IiLz4KCQkJCQkJPC9vMj4KCQkJCQkJPG8zPgoJCQkJCQkJPENoYW5nZXMgdmFsdWU9IiIvPgoJCQkJCQkJPFByb3BlcnRpZXM+CgkJCQkJCQkJPEF1dG9pbmNyZW1lbnQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8Q2hhcnNldCB2YWx1ZT0idXRmOCIvPgoJCQkJCQkJCTxDb2xsYXRpb24gdmFsdWU9InV0ZjhfZ2VuZXJhbF9jaSIvPgoJCQkJCQkJCTxDb21tZW50IHZhbHVlPSIiLz4KCQkJCQkJCQk8RGVmYXVsdF9WYWx1ZSB2YWx1ZT0iIi8+CgkJCQkJCQkJPEVsZW1lbnRzIHZhbHVlPSJNQT09IE1RPT0iLz4KCQkJCQkJCQk8RmllbGRfUG9zaXRpb24gdmFsdWU9IjEzIi8+CgkJCQkJCQkJPEluZGV4ZWQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8TGVuZ3RoIHZhbHVlPSItMSIvPgoJCQkJCQkJCTxOYW1lIHZhbHVlPSJjb25kdWN0b3JfZG90YWNpb24iLz4KCQkJCQkJCQk8TnVsbGFibGUgdmFsdWU9IjAiLz4KCQkJCQkJCQk8T25fVXBkYXRlX1NldF9DdXJyZW50IHZhbHVlPSIwIi8+CgkJCQkJCQkJPFByZWNpc2lvbiB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxTY2FsZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxUeXBlIHZhbHVlPSJFbnVtIi8+CgkJCQkJCQkJPFVuaXF1ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxVbnNpZ25lZCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxaZXJvZmlsbCB2YWx1ZT0iMCIvPgoJCQkJCQkJPC9Qcm9wZXJ0aWVzPgoJCQkJCQkJPGNvbnRyb2wgdmFsdWU9IiIvPgoJCQkJCQkJPGRlbGV0ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPG5hbWUgdmFsdWU9ImNvbmR1Y3Rvcl9kb3RhY2lvbiIvPgoJCQkJCQk8L28zPgoJCQkJCQk8bzQ+CgkJCQkJCQk8Q2hhbmdlcyB2YWx1ZT0iIi8+CgkJCQkJCQk8UHJvcGVydGllcz4KCQkJCQkJCQk8QXV0b2luY3JlbWVudCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxDaGFyc2V0IHZhbHVlPSJ1dGY4Ii8+CgkJCQkJCQkJPENvbGxhdGlvbiB2YWx1ZT0idXRmOF9nZW5lcmFsX2NpIi8+CgkJCQkJCQkJPENvbW1lbnQgdmFsdWU9IiIvPgoJCQkJCQkJCTxEZWZhdWx0X1ZhbHVlIHZhbHVlPSIiLz4KCQkJCQkJCQk8RWxlbWVudHMgdmFsdWU9Ik1BPT0gTVE9PSIvPgoJCQkJCQkJCTxGaWVsZF9Qb3NpdGlvbiB2YWx1ZT0iMTQiLz4KCQkJCQkJCQk8SW5kZXhlZCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxMZW5ndGggdmFsdWU9Ii0xIi8+CgkJCQkJCQkJPE5hbWUgdmFsdWU9ImNvbmR1Y3Rvcl9oaWdpZW5lIi8+CgkJCQkJCQkJPE51bGxhYmxlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPE9uX1VwZGF0ZV9TZXRfQ3VycmVudCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxQcmVjaXNpb24gdmFsdWU9IjAiLz4KCQkJCQkJCQk8U2NhbGUgdmFsdWU9IjAiLz4KCQkJCQkJCQk8VHlwZSB2YWx1ZT0iRW51b
SIvPgoJCQkJCQkJCTxVbmlxdWUgdmFsdWU9IjAiLz4KCQkJCQkJCQk8VW5zaWduZWQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8WmVyb2ZpbGwgdmFsdWU9IjAiLz4KCQkJCQkJCTwvUHJvcGVydGllcz4KCQkJCQkJCTxjb250cm9sIHZhbHVlPSIiLz4KCQkJCQkJCTxkZWxldGUgdmFsdWU9IjAiLz4KCQkJCQkJCTxuYW1lIHZhbHVlPSJjb25kdWN0b3JfaGlnaWVuZSIvPgoJCQkJCQk8L280PgoJCQkJCQk8bzU+CgkJCQkJCQk8Q2hhbmdlcyB2YWx1ZT0iIi8+CgkJCQkJCQk8UHJvcGVydGllcz4KCQkJCQkJCQk8QXV0b2luY3JlbWVudCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxDaGFyc2V0IHZhbHVlPSJ1dGY4Ii8+CgkJCQkJCQkJPENvbGxhdGlvbiB2YWx1ZT0idXRmOF9nZW5lcmFsX2NpIi8+CgkJCQkJCQkJPENvbW1lbnQgdmFsdWU9IiIvPgoJCQkJCQkJCTxEZWZhdWx0X1ZhbHVlIHZhbHVlPSIiLz4KCQkJCQkJCQk8RWxlbWVudHMgdmFsdWU9Ik1BPT0gTVE9PSIvPgoJCQkJCQkJCTxGaWVsZF9Qb3NpdGlvbiB2YWx1ZT0iMTYiLz4KCQkJCQkJCQk8SW5kZXhlZCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxMZW5ndGggdmFsdWU9Ii0xIi8+CgkJCQkJCQkJPE5hbWUgdmFsdWU9ImRldm9sdWNpb25fcGVzbyIvPgoJCQkJCQkJCTxOdWxsYWJsZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxPbl9VcGRhdGVfU2V0X0N1cnJlbnQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8UHJlY2lzaW9uIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFNjYWxlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFR5cGUgdmFsdWU9IkVudW0iLz4KCQkJCQkJCQk8VW5pcXVlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFVuc2lnbmVkIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFplcm9maWxsIHZhbHVlPSIwIi8+CgkJCQkJCQk8L1Byb3BlcnRpZXM+CgkJCQkJCQk8Y29udHJvbCB2YWx1ZT0iIi8+CgkJCQkJCQk8ZGVsZXRlIHZhbHVlPSIwIi8+CgkJCQkJCQk8bmFtZSB2YWx1ZT0iZGV2b2x1Y2lvbl9wZXNvIi8+CgkJCQkJCTwvbzU+CgkJCQkJCTxvNj4KCQkJCQkJCTxDaGFuZ2VzIHZhbHVlPSIiLz4KCQkJCQkJCTxQcm9wZXJ0aWVzPgoJCQkJCQkJCTxBdXRvaW5jcmVtZW50IHZhbHVlPSIwIi8+CgkJCQkJCQkJPENoYXJzZXQgdmFsdWU9InV0ZjgiLz4KCQkJCQkJCQk8Q29sbGF0aW9uIHZhbHVlPSJ1dGY4X2dlbmVyYWxfY2kiLz4KCQkJCQkJCQk8Q29tbWVudCB2YWx1ZT0iIi8+CgkJCQkJCQkJPERlZmF1bHRfVmFsdWUgdmFsdWU9IiIvPgoJCQkJCQkJCTxFbGVtZW50cyB2YWx1ZT0iTUE9PSBNUT09Ii8+CgkJCQkJCQkJPEZpZWxkX1Bvc2l0aW9uIHZhbHVlPSIxNSIvPgoJCQkJCQkJCTxJbmRleGVkIHZhbHVlPSIwIi8+CgkJCQkJCQkJPExlbmd0aCB2YWx1ZT0iLTEiLz4KCQkJCQkJCQk8TmFtZSB2YWx1ZT0iZGV2b2x1Y2lvbl9zaV9ubyIvPgoJCQkJCQkJCTxOdWxsYWJsZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxPbl9VcGRhdGVfU2V0X0N1cnJlbnQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8UHJlY2lzaW9uIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFNjYWxlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFR5cGUgdmFsdWU9IkVudW0iLz4KCQkJCQkJCQk8VW5pcXVlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFVuc2lnbmVkIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFplcm9maWxsIHZhbHVlPSIwIi8+CgkJCQkJCQk8L1Byb3BlcnRpZXM+CgkJCQkJCQk8Y29udHJvbCB2YWx1ZT0iIi8+CgkJCQkJCQk8ZGVsZXRlIHZhbHVlPSIwIi8+CgkJCQkJCQk8bmFtZSB2YWx1ZT0iZGV2b2x1Y2lvbl9zaV9ubyIvPgoJCQkJCQk8L282PgoJCQkJCQk8bzc+CgkJCQkJCQk8Q2hhbmdlcyB2YWx1ZT0iIi8+CgkJCQkJCQk8UHJvcGVydGllcz4KCQkJCQkJCQk8QXV0b2luY3JlbWVudCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxDaGFyc2V0IHZhbHVlPSIiLz4KCQkJCQkJCQk8Q29sbGF0aW9uIHZhbHVlPSIiLz4KCQkJCQkJCQk8Q29tbWVudCB2YWx1ZT0iIi8+CgkJCQkJCQkJPERlZmF1bHRfVmFsdWUgdmFsdWU9IiIvPgoJCQkJCQkJCTxGaWVsZF9Qb3NpdGlvbiB2YWx1ZT0iMiIvPgoJCQkJCQkJCTxJbmRleGVkIHZhbHVlPSIwIi8+CgkJCQkJCQkJPExlbmd0aCB2YWx1ZT0iLTEiLz4KCQkJCQkJCQk8TmFtZSB2YWx1ZT0iZmVjX2luZ3Jlc28iLz4KCQkJCQkJCQk8TnVsbGFibGUgdmFsdWU9IjAiLz4KCQkJCQkJCQk8T25fVXBkYXRlX1NldF9DdXJyZW50IHZhbHVlPSIwIi8+CgkJCQkJCQkJPFByZWNpc2lvbiB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxTY2FsZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxUeXBlIHZhbHVlPSJEYXRlIi8+CgkJCQkJCQkJPFVuaXF1ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxVbnNpZ25lZCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxaZXJvZmlsbCB2YWx1ZT0iMCIvPgoJCQkJCQkJPC9Qcm9wZXJ0aWVzPgoJCQkJCQkJPGNvbnRyb2wgdmFsdWU9IiIvPgoJCQkJCQkJPGRlbGV0ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPG5hbWUgdmFsdWU9ImZlY19pbmdyZXNvIi8+CgkJCQkJCTwvbzc+CgkJCQkJCTxvOD4KCQkJCQkJCTxDaGFuZ2VzIHZhbHVlPSIiLz4KCQkJCQkJCTxQcm9wZXJ0aWVzPgoJCQkJCQkJCTxBdXRvaW5jcmVtZW50IHZhbHVlPSIwIi8+CgkJCQkJCQkJPENoYXJzZXQgdmFsdWU9InV0ZjgiLz4KCQkJCQkJCQk8Q29sbGF0aW9uIHZhbHVlPSJ1dGY4X2dlbmVyYWxfY2kiLz4KCQkJCQkJCQk8Q29tbWVudCB2YWx1ZT0iIi8+CgkJCQkJCQkJPERlZmF1bHRfVmFsdWUgdmFsdWU9IiIvPgoJCQkJCQkJCTxFbGVtZW50cyB2YWx1ZT0iTUE9PSBNUT09Ii8+CgkJCQkJCQkJPEZpZWxkX1Bvc2l0aW9uIHZhbHVlPSIxMiIvPgoJCQkJCQkJCTxJbmRleGVkIHZhbHVlPSIwIi8+CgkJCQkJCQkJPExlbmd0aCB2YWx1ZT0iLTEiLz4KCQkJCQkJCQk8TmFtZSB2YWx1ZT0iaGdpZW5lX2NhbmFzdGFzIi8+CgkJCQkJCQkJPE51bGxhYmxlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPE9uX1VwZGF0ZV9TZXRfQ3VycmVudCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxQcmVjaXNpb24gdmFsdWU9IjAiLz4KCQkJCQkJCQk8U2NhbGUgdmFsdWU9IjAiLz4KCQkJCQkJCQk8VHlwZSB2YWx1ZT0iRW51bSIvPgoJCQkJCQkJCTxVbmlxd
WUgdmFsdWU9IjAiLz4KCQkJCQkJCQk8VW5zaWduZWQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8WmVyb2ZpbGwgdmFsdWU9IjAiLz4KCQkJCQkJCTwvUHJvcGVydGllcz4KCQkJCQkJCTxjb250cm9sIHZhbHVlPSIiLz4KCQkJCQkJCTxkZWxldGUgdmFsdWU9IjAiLz4KCQkJCQkJCTxuYW1lIHZhbHVlPSJoZ2llbmVfY2FuYXN0YXMiLz4KCQkJCQkJPC9vOD4KCQkJCQkJPG85PgoJCQkJCQkJPENoYW5nZXMgdmFsdWU9IiIvPgoJCQkJCQkJPFByb3BlcnRpZXM+CgkJCQkJCQkJPEF1dG9pbmNyZW1lbnQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8Q2hhcnNldCB2YWx1ZT0idXRmOCIvPgoJCQkJCQkJCTxDb2xsYXRpb24gdmFsdWU9InV0ZjhfZ2VuZXJhbF9jaSIvPgoJCQkJCQkJCTxDb21tZW50IHZhbHVlPSIiLz4KCQkJCQkJCQk8RGVmYXVsdF9WYWx1ZSB2YWx1ZT0iIi8+CgkJCQkJCQkJPEVsZW1lbnRzIHZhbHVlPSJNQT09IE1RPT0iLz4KCQkJCQkJCQk8RmllbGRfUG9zaXRpb24gdmFsdWU9IjExIi8+CgkJCQkJCQkJPEluZGV4ZWQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8TGVuZ3RoIHZhbHVlPSItMSIvPgoJCQkJCQkJCTxOYW1lIHZhbHVlPSJoZ2llbmVfdmVoaWN1bG8iLz4KCQkJCQkJCQk8TnVsbGFibGUgdmFsdWU9IjAiLz4KCQkJCQkJCQk8T25fVXBkYXRlX1NldF9DdXJyZW50IHZhbHVlPSIwIi8+CgkJCQkJCQkJPFByZWNpc2lvbiB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxTY2FsZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxUeXBlIHZhbHVlPSJFbnVtIi8+CgkJCQkJCQkJPFVuaXF1ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxVbnNpZ25lZCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxaZXJvZmlsbCB2YWx1ZT0iMCIvPgoJCQkJCQkJPC9Qcm9wZXJ0aWVzPgoJCQkJCQkJPGNvbnRyb2wgdmFsdWU9IiIvPgoJCQkJCQkJPGRlbGV0ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPG5hbWUgdmFsdWU9ImhnaWVuZV92ZWhpY3VsbyIvPgoJCQkJCQk8L285PgoJCQkJCTwvZmllbGQ+CgkJCQkJPGluZGV4PgoJCQkJCQk8bzA+CgkJCQkJCQk8Q2hhbmdlcyB2YWx1ZT0iIi8+CgkJCQkJCQk8UHJvcGVydGllcz4KCQkJCQkJCQk8Q29tbWVudCB2YWx1ZT0iIi8+CgkJCQkJCQkJPEZpZWxkcyB2YWx1ZT0iYldGMFpYSnBZVjl3Y21sdFlWOXBibk4xYlc4PSIvPgoJCQkJCQkJCTxOYW1lIHZhbHVlPSJsbmtfcmVjZXBjaW9uX21hdGVyaWFfcHJpbWFfY2FybmljYV9pbnN1bW8iLz4KCQkJCQkJCQk8VHlwZSB2YWx1ZT0iQlRSRUUiLz4KCQkJCQkJCQk8VW5pcXVlIHZhbHVlPSIwIi8+CgkJCQkJCQk8L1Byb3BlcnRpZXM+CgkJCQkJCQk8Y29udHJvbCB2YWx1ZT0iIi8+CgkJCQkJCQk8ZGVsZXRlIHZhbHVlPSIwIi8+CgkJCQkJCQk8bmFtZSB2YWx1ZT0ibG5rX3JlY2VwY2lvbl9tYXRlcmlhX3ByaW1hX2Nhcm5pY2FfaW5zdW1vIi8+CgkJCQkJCTwvbzA+CgkJCQkJCTxvMT4KCQkJCQkJCTxDaGFuZ2VzIHZhbHVlPSIiLz4KCQkJCQkJCTxQcm9wZXJ0aWVzPgoJCQkJCQkJCTxDb21tZW50IHZhbHVlPSIiLz4KCQkJCQkJCQk8RmllbGRzIHZhbHVlPSJjSEp2ZG1WbFpHOXkiLz4KCQkJCQkJCQk8TmFtZSB2YWx1ZT0ibG5rX3JlY2VwY2lvbl9tYXRlcmlhX3ByaW1hX2Nhcm5pY2FfcHJvdmVlZG9yIi8+CgkJCQkJCQkJPFR5cGUgdmFsdWU9IkJUUkVFIi8+CgkJCQkJCQkJPFVuaXF1ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPC9Qcm9wZXJ0aWVzPgoJCQkJCQkJPGNvbnRyb2wgdmFsdWU9IiIvPgoJCQkJCQkJPGRlbGV0ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPG5hbWUgdmFsdWU9Imxua19yZWNlcGNpb25fbWF0ZXJpYV9wcmltYV9jYXJuaWNhX3Byb3ZlZWRvciIvPgoJCQkJCQk8L28xPgoJCQkJCQk8bzI+CgkJCQkJCQk8Q2hhbmdlcyB2YWx1ZT0iIi8+CgkJCQkJCQk8UHJvcGVydGllcz4KCQkJCQkJCQk8Q29tbWVudCB2YWx1ZT0iIi8+CgkJCQkJCQkJPEZpZWxkcyB2YWx1ZT0iY21WamFXSnBaRzg9Ii8+CgkJCQkJCQkJPE5hbWUgdmFsdWU9Imxua19yZWNlcGNpb25fbWF0ZXJpYV9wcmltYV9jYXJuaWNhX1VzZXIiLz4KCQkJCQkJCQk8VHlwZSB2YWx1ZT0iQlRSRUUiLz4KCQkJCQkJCQk8VW5pcXVlIHZhbHVlPSIwIi8+CgkJCQkJCQk8L1Byb3BlcnRpZXM+CgkJCQkJCQk8Y29udHJvbCB2YWx1ZT0iIi8+CgkJCQkJCQk8ZGVsZXRlIHZhbHVlPSIwIi8+CgkJCQkJCQk8bmFtZSB2YWx1ZT0ibG5rX3JlY2VwY2lvbl9tYXRlcmlhX3ByaW1hX2Nhcm5pY2FfVXNlciIvPgoJCQkJCQk8L28yPgoJCQkJCQk8bzM+CgkJCQkJCQk8Q2hhbmdlcyB2YWx1ZT0iIi8+CgkJCQkJCQk8UHJvcGVydGllcz4KCQkJCQkJCQk8Q29tbWVudCB2YWx1ZT0iIi8+CgkJCQkJCQkJPEZpZWxkcyB2YWx1ZT0iYVdRPSIvPgoJCQkJCQkJCTxOYW1lIHZhbHVlPSJQUklNQVJZIi8+CgkJCQkJCQkJPFR5cGUgdmFsdWU9IkJUUkVFIi8+CgkJCQkJCQkJPFVuaXF1ZSB2YWx1ZT0iMSIvPgoJCQkJCQkJPC9Qcm9wZXJ0aWVzPgoJCQkJCQkJPGNvbnRyb2wgdmFsdWU9IiIvPgoJCQkJCQkJPGRlbGV0ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPG5hbWUgdmFsdWU9IlBSSU1BUlkiLz4KCQkJCQkJPC9vMz4KCQkJCQk8L2luZGV4PgoJCQkJCTxuYW1lIHZhbHVlPSJyZWNlcGNpb25fbWF0ZXJpYV9wcmltYV9jYXJuaWNhIi8+CgkJCQkJPHVuaXF1ZT4KCQkJCQkJPG8wPgoJCQkJCQkJPENoYW5nZXMgdmFsdWU9IiIvPgoJCQkJCQkJPFByb3BlcnRpZXM+CgkJCQkJCQkJPEZpZWxkcyB2YWx1ZT0iYVdRPSIvPgoJCQkJCQkJCTxOYW1lIHZhbHVlPSJQUklNQVJZIi8+CgkJCQkJCQk8L1Byb3BlcnRpZXM+CgkJCQkJCQk8Y29udHJvbCB2YWx1ZT0iIi8+CgkJCQkJCQk8ZGVsZXRlIHZhbHVlPSIwIi8+CgkJCQkJCQk8bmFtZSB2YWx1ZT0iUFJJTUFSWSIvPgoJCQkJCQk8L28wPgoJCQkJCTwvdW5pcXVlPgoJCQkJPC9vMT4KCQkJCTxvMj4KCQkJCQk8Q2hhbmdlcyB2YWx1ZT0iIi8+CgkJCQkJPFByb3BlcnRpZXM+CgkJCQkJCTxBdXRvaW5jcmVtZW50IHZhbHVlPSIxIi8+CgkJCQkJCTxBdmVyYWdlX1Jvd19TaXplIHZhbHVlPSIwIi8+CgkJCQkJCTxDaGFyc2V0IHZhbHVlPSJ1dGY4Ii8+CgkJCQkJCTxDb2xsYXRpb24gd
mFsdWU9InV0ZjhfZ2VuZXJhbF9jaSIvPgoJCQkJCQk8Q29tbWVudCB2YWx1ZT0iIi8+CgkJCQkJCTxDcmVhdGVfVGltZSB2YWx1ZT0iMjAxNS0wNC0yNyAyMDozOTozMyIvPgoJCQkJCQk8RW5naW5lIHZhbHVlPSJJbm5vREIiLz4KCQkJCQkJPEZpZWxkX0NvdW50IHZhbHVlPSIxNCIvPgoJCQkJCQk8SW5kZXhfQ291bnQgdmFsdWU9IjQiLz4KCQkJCQkJPE5hbWUgdmFsdWU9InJlY2VwY2lvbl9tYXRlcmlhX3ByaW1hX25vX2Nhcm5pY2EiLz4KCQkJCQkJPFByaW1hcnlfS2V5IHZhbHVlPSJhV1E9Ii8+CgkJCQkJCTxTaXplIHZhbHVlPSI2NC4wMCBLYiIvPgoJCQkJCQk8VHJpZ2dlcl9Db3VudCB2YWx1ZT0iMCIvPgoJCQkJCQk8VW5pcXVlX0NvdW50IHZhbHVlPSIxIi8+CgkJCQkJCTxVcGRhdGVfVGltZSB2YWx1ZT0iIi8+CgkJCQkJPC9Qcm9wZXJ0aWVzPgoJCQkJCTxjb250cm9sIHZhbHVlPSJUYWJsZSIvPgoJCQkJCTxkZWxldGUgdmFsdWU9IjAiLz4KCQkJCQk8ZmllbGQ+CgkJCQkJCTxvMD4KCQkJCQkJCTxDaGFuZ2VzIHZhbHVlPSIiLz4KCQkJCQkJCTxQcm9wZXJ0aWVzPgoJCQkJCQkJCTxBdXRvaW5jcmVtZW50IHZhbHVlPSIwIi8+CgkJCQkJCQkJPENoYXJzZXQgdmFsdWU9InV0ZjgiLz4KCQkJCQkJCQk8Q29sbGF0aW9uIHZhbHVlPSJ1dGY4X2dlbmVyYWxfY2kiLz4KCQkJCQkJCQk8Q29tbWVudCB2YWx1ZT0iIi8+CgkJCQkJCQkJPERlZmF1bHRfVmFsdWUgdmFsdWU9IiIvPgoJCQkJCQkJCTxFbGVtZW50cyB2YWx1ZT0iTUE9PSBNUT09Ii8+CgkJCQkJCQkJPEZpZWxkX1Bvc2l0aW9uIHZhbHVlPSIxMCIvPgoJCQkJCQkJCTxJbmRleGVkIHZhbHVlPSIwIi8+CgkJCQkJCQkJPExlbmd0aCB2YWx1ZT0iLTEiLz4KCQkJCQkJCQk8TmFtZSB2YWx1ZT0iY2FyYWN0X2Zpc2ljYXNfZW1wYXF1ZSIvPgoJCQkJCQkJCTxOdWxsYWJsZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxPbl9VcGRhdGVfU2V0X0N1cnJlbnQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8UHJlY2lzaW9uIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFNjYWxlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFR5cGUgdmFsdWU9IkVudW0iLz4KCQkJCQkJCQk8VW5pcXVlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFVuc2lnbmVkIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFplcm9maWxsIHZhbHVlPSIwIi8+CgkJCQkJCQk8L1Byb3BlcnRpZXM+CgkJCQkJCQk8Y29udHJvbCB2YWx1ZT0iIi8+CgkJCQkJCQk8ZGVsZXRlIHZhbHVlPSIwIi8+CgkJCQkJCQk8bmFtZSB2YWx1ZT0iY2FyYWN0X2Zpc2ljYXNfZW1wYXF1ZSIvPgoJCQkJCQk8L28wPgoJCQkJCQk8bzE+CgkJCQkJCQk8Q2hhbmdlcyB2YWx1ZT0iIi8+CgkJCQkJCQk8UHJvcGVydGllcz4KCQkJCQkJCQk8QXV0b2luY3JlbWVudCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxDaGFyc2V0IHZhbHVlPSJ1dGY4Ii8+CgkJCQkJCQkJPENvbGxhdGlvbiB2YWx1ZT0idXRmOF9nZW5lcmFsX2NpIi8+CgkJCQkJCQkJPENvbW1lbnQgdmFsdWU9IiIvPgoJCQkJCQkJCTxEZWZhdWx0X1ZhbHVlIHZhbHVlPSIiLz4KCQkJCQkJCQk8RWxlbWVudHMgdmFsdWU9Ik1BPT0gTVE9PSIvPgoJCQkJCQkJCTxGaWVsZF9Qb3NpdGlvbiB2YWx1ZT0iMTEiLz4KCQkJCQkJCQk8SW5kZXhlZCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxMZW5ndGggdmFsdWU9Ii0xIi8+CgkJCQkJCQkJPE5hbWUgdmFsdWU9ImNhcmFjdF9maXNpY2FzX3JvdHVsYWRvIi8+CgkJCQkJCQkJPE51bGxhYmxlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPE9uX1VwZGF0ZV9TZXRfQ3VycmVudCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxQcmVjaXNpb24gdmFsdWU9IjAiLz4KCQkJCQkJCQk8U2NhbGUgdmFsdWU9IjAiLz4KCQkJCQkJCQk8VHlwZSB2YWx1ZT0iRW51bSIvPgoJCQkJCQkJCTxVbmlxdWUgdmFsdWU9IjAiLz4KCQkJCQkJCQk8VW5zaWduZWQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8WmVyb2ZpbGwgdmFsdWU9IjAiLz4KCQkJCQkJCTwvUHJvcGVydGllcz4KCQkJCQkJCTxjb250cm9sIHZhbHVlPSIiLz4KCQkJCQkJCTxkZWxldGUgdmFsdWU9IjAiLz4KCQkJCQkJCTxuYW1lIHZhbHVlPSJjYXJhY3RfZmlzaWNhc19yb3R1bGFkbyIvPgoJCQkJCQk8L28xPgoJCQkJCQk8bzEwPgoJCQkJCQkJPENoYW5nZXMgdmFsdWU9IiIvPgoJCQkJCQkJPFByb3BlcnRpZXM+CgkJCQkJCQkJPEF1dG9pbmNyZW1lbnQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8Q2hhcnNldCB2YWx1ZT0iIi8+CgkJCQkJCQkJPENvbGxhdGlvbiB2YWx1ZT0iIi8+CgkJCQkJCQkJPENvbW1lbnQgdmFsdWU9IiIvPgoJCQkJCQkJCTxEZWZhdWx0X1ZhbHVlIHZhbHVlPSIiLz4KCQkJCQkJCQk8RmllbGRfUG9zaXRpb24gdmFsdWU9IjciLz4KCQkJCQkJCQk8SW5kZXhlZCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxMZW5ndGggdmFsdWU9IjExIi8+CgkJCQkJCQkJPE5hbWUgdmFsdWU9InBlc29fdG90YWwiLz4KCQkJCQkJCQk8TnVsbGFibGUgdmFsdWU9IjAiLz4KCQkJCQkJCQk8T25fVXBkYXRlX1NldF9DdXJyZW50IHZhbHVlPSIwIi8+CgkJCQkJCQkJPFByZWNpc2lvbiB2YWx1ZT0iMTAiLz4KCQkJCQkJCQk8U2NhbGUgdmFsdWU9IjAiLz4KCQkJCQkJCQk8VHlwZSB2YWx1ZT0iSW50Ii8+CgkJCQkJCQkJPFVuaXF1ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxVbnNpZ25lZCB2YWx1ZT0iMSIvPgoJCQkJCQkJCTxaZXJvZmlsbCB2YWx1ZT0iMCIvPgoJCQkJCQkJPC9Qcm9wZXJ0aWVzPgoJCQkJCQkJPGNvbnRyb2wgdmFsdWU9IiIvPgoJCQkJCQkJPGRlbGV0ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPG5hbWUgdmFsdWU9InBlc29fdG90YWwiLz4KCQkJCQkJPC9vMTA+CgkJCQkJCTxvMTE+CgkJCQkJCQk8Q2hhbmdlcyB2YWx1ZT0iIi8+CgkJCQkJCQk8UHJvcGVydGllcz4KCQkJCQkJCQk8QXV0b2luY3JlbWVudCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxDaGFyc2V0IHZhbHVlPSIiLz4KCQkJCQkJCQk8Q29sbGF0aW9uIHZhbHVlPSIiLz4KCQkJCQkJCQk8Q29tbWVudCB2YWx1ZT0iIi8+CgkJCQkJCQkJPERlZmF1bHRfVmFsdWUgdmFsdWU9IiIvPgoJCQkJCQkJCTxGaWVsZF9Qb3NpdGlvbiB2YWx1ZT0iNSIvPgoJCQkJCQkJCTxJbmRleGVkIHZhbHVlP
SIxIi8+CgkJCQkJCQkJPExlbmd0aCB2YWx1ZT0iMTEiLz4KCQkJCQkJCQk8TmFtZSB2YWx1ZT0icHJvdmVlZG9yX2lkIi8+CgkJCQkJCQkJPE51bGxhYmxlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPE9uX1VwZGF0ZV9TZXRfQ3VycmVudCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxQcmVjaXNpb24gdmFsdWU9IjEwIi8+CgkJCQkJCQkJPFNjYWxlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFR5cGUgdmFsdWU9IkludCIvPgoJCQkJCQkJCTxVbmlxdWUgdmFsdWU9IjAiLz4KCQkJCQkJCQk8VW5zaWduZWQgdmFsdWU9IjEiLz4KCQkJCQkJCQk8WmVyb2ZpbGwgdmFsdWU9IjAiLz4KCQkJCQkJCTwvUHJvcGVydGllcz4KCQkJCQkJCTxjb250cm9sIHZhbHVlPSIiLz4KCQkJCQkJCTxkZWxldGUgdmFsdWU9IjAiLz4KCQkJCQkJCTxuYW1lIHZhbHVlPSJwcm92ZWVkb3JfaWQiLz4KCQkJCQkJPC9vMTE+CgkJCQkJCTxvMTI+CgkJCQkJCQk8Q2hhbmdlcyB2YWx1ZT0iIi8+CgkJCQkJCQk8UHJvcGVydGllcz4KCQkJCQkJCQk8QXV0b2luY3JlbWVudCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxDaGFyc2V0IHZhbHVlPSIiLz4KCQkJCQkJCQk8Q29sbGF0aW9uIHZhbHVlPSIiLz4KCQkJCQkJCQk8Q29tbWVudCB2YWx1ZT0iIi8+CgkJCQkJCQkJPERlZmF1bHRfVmFsdWUgdmFsdWU9IiIvPgoJCQkJCQkJCTxGaWVsZF9Qb3NpdGlvbiB2YWx1ZT0iMTQiLz4KCQkJCQkJCQk8SW5kZXhlZCB2YWx1ZT0iMSIvPgoJCQkJCQkJCTxMZW5ndGggdmFsdWU9IjExIi8+CgkJCQkJCQkJPE5hbWUgdmFsdWU9InJlY2liaWRvIi8+CgkJCQkJCQkJPE51bGxhYmxlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPE9uX1VwZGF0ZV9TZXRfQ3VycmVudCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxQcmVjaXNpb24gdmFsdWU9IjEwIi8+CgkJCQkJCQkJPFNjYWxlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFR5cGUgdmFsdWU9IkludCIvPgoJCQkJCQkJCTxVbmlxdWUgdmFsdWU9IjAiLz4KCQkJCQkJCQk8VW5zaWduZWQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8WmVyb2ZpbGwgdmFsdWU9IjAiLz4KCQkJCQkJCTwvUHJvcGVydGllcz4KCQkJCQkJCTxjb250cm9sIHZhbHVlPSIiLz4KCQkJCQkJCTxkZWxldGUgdmFsdWU9IjAiLz4KCQkJCQkJCTxuYW1lIHZhbHVlPSJyZWNpYmlkbyIvPgoJCQkJCQk8L28xMj4KCQkJCQkJPG8xMz4KCQkJCQkJCTxDaGFuZ2VzIHZhbHVlPSIiLz4KCQkJCQkJCTxQcm9wZXJ0aWVzPgoJCQkJCQkJCTxBdXRvaW5jcmVtZW50IHZhbHVlPSIwIi8+CgkJCQkJCQkJPENoYXJzZXQgdmFsdWU9IiIvPgoJCQkJCQkJCTxDb2xsYXRpb24gdmFsdWU9IiIvPgoJCQkJCQkJCTxDb21tZW50IHZhbHVlPSIiLz4KCQkJCQkJCQk8RGVmYXVsdF9WYWx1ZSB2YWx1ZT0iIi8+CgkJCQkJCQkJPEZpZWxkX1Bvc2l0aW9uIHZhbHVlPSI4Ii8+CgkJCQkJCQkJPEluZGV4ZWQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8TGVuZ3RoIHZhbHVlPSIxMSIvPgoJCQkJCQkJCTxOYW1lIHZhbHVlPSJ1bmlkYWRlcyIvPgoJCQkJCQkJCTxOdWxsYWJsZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxPbl9VcGRhdGVfU2V0X0N1cnJlbnQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8UHJlY2lzaW9uIHZhbHVlPSI1Ii8+CgkJCQkJCQkJPFNjYWxlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFR5cGUgdmFsdWU9IlNtYWxsaW50Ii8+CgkJCQkJCQkJPFVuaXF1ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxVbnNpZ25lZCB2YWx1ZT0iMSIvPgoJCQkJCQkJCTxaZXJvZmlsbCB2YWx1ZT0iMCIvPgoJCQkJCQkJPC9Qcm9wZXJ0aWVzPgoJCQkJCQkJPGNvbnRyb2wgdmFsdWU9IiIvPgoJCQkJCQkJPGRlbGV0ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPG5hbWUgdmFsdWU9InVuaWRhZGVzIi8+CgkJCQkJCTwvbzEzPgoJCQkJCQk8bzI+CgkJCQkJCQk8Q2hhbmdlcyB2YWx1ZT0iIi8+CgkJCQkJCQk8UHJvcGVydGllcz4KCQkJCQkJCQk8QXV0b2luY3JlbWVudCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxDaGFyc2V0IHZhbHVlPSIiLz4KCQkJCQkJCQk8Q29sbGF0aW9uIHZhbHVlPSIiLz4KCQkJCQkJCQk8Q29tbWVudCB2YWx1ZT0iIi8+CgkJCQkJCQkJPERlZmF1bHRfVmFsdWUgdmFsdWU9IiIvPgoJCQkJCQkJCTxGaWVsZF9Qb3NpdGlvbiB2YWx1ZT0iMTMiLz4KCQkJCQkJCQk8SW5kZXhlZCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxMZW5ndGggdmFsdWU9IjAiLz4KCQkJCQkJCQk8TmFtZSB2YWx1ZT0iZGV2b2x1Y2lvbl9wZXNvX3VuaWRhZGVzIi8+CgkJCQkJCQkJPE51bGxhYmxlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPE9uX1VwZGF0ZV9TZXRfQ3VycmVudCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxQcmVjaXNpb24gdmFsdWU9IjQiLz4KCQkJCQkJCQk8U2NhbGUgdmFsdWU9IjEiLz4KCQkJCQkJCQk8VHlwZSB2YWx1ZT0iRGVjaW1hbCIvPgoJCQkJCQkJCTxVbmlxdWUgdmFsdWU9IjAiLz4KCQkJCQkJCQk8VW5zaWduZWQgdmFsdWU9IjEiLz4KCQkJCQkJCQk8WmVyb2ZpbGwgdmFsdWU9IjAiLz4KCQkJCQkJCTwvUHJvcGVydGllcz4KCQkJCQkJCTxjb250cm9sIHZhbHVlPSIiLz4KCQkJCQkJCTxkZWxldGUgdmFsdWU9IjAiLz4KCQkJCQkJCTxuYW1lIHZhbHVlPSJkZXZvbHVjaW9uX3Blc29fdW5pZGFkZXMiLz4KCQkJCQkJPC9vMj4KCQkJCQkJPG8zPgoJCQkJCQkJPENoYW5nZXMgdmFsdWU9IiIvPgoJCQkJCQkJPFByb3BlcnRpZXM+CgkJCQkJCQkJPEF1dG9pbmNyZW1lbnQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8Q2hhcnNldCB2YWx1ZT0idXRmOCIvPgoJCQkJCQkJCTxDb2xsYXRpb24gdmFsdWU9InV0ZjhfZ2VuZXJhbF9jaSIvPgoJCQkJCQkJCTxDb21tZW50IHZhbHVlPSIwID0gbm8KMSA9IHNpIi8+CgkJCQkJCQkJPERlZmF1bHRfVmFsdWUgdmFsdWU9IiIvPgoJCQkJCQkJCTxFbGVtZW50cyB2YWx1ZT0iTUE9PSBNUT09Ii8+CgkJCQkJCQkJPEZpZWxkX1Bvc2l0aW9uIHZhbHVlPSIxMiIvPgoJCQkJCQkJCTxJbmRleGVkIHZhbHVlPSIwIi8+CgkJCQkJCQkJPExlbmd0aCB2YWx1ZT0iLTEiLz4KCQkJCQkJCQk8TmFtZSB2YWx1ZT0iZGV2b2x1Y2lvbl9zaV9ubyIvPgoJCQkJCQkJCTxOdWxsYWJsZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxPbl9Vc
GRhdGVfU2V0X0N1cnJlbnQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8UHJlY2lzaW9uIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFNjYWxlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFR5cGUgdmFsdWU9IkVudW0iLz4KCQkJCQkJCQk8VW5pcXVlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFVuc2lnbmVkIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFplcm9maWxsIHZhbHVlPSIwIi8+CgkJCQkJCQk8L1Byb3BlcnRpZXM+CgkJCQkJCQk8Y29udHJvbCB2YWx1ZT0iIi8+CgkJCQkJCQk8ZGVsZXRlIHZhbHVlPSIwIi8+CgkJCQkJCQk8bmFtZSB2YWx1ZT0iZGV2b2x1Y2lvbl9zaV9ubyIvPgoJCQkJCQk8L28zPgoJCQkJCQk8bzQ+CgkJCQkJCQk8Q2hhbmdlcyB2YWx1ZT0iIi8+CgkJCQkJCQk8UHJvcGVydGllcz4KCQkJCQkJCQk8QXV0b2luY3JlbWVudCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxDaGFyc2V0IHZhbHVlPSIiLz4KCQkJCQkJCQk8Q29sbGF0aW9uIHZhbHVlPSIiLz4KCQkJCQkJCQk8Q29tbWVudCB2YWx1ZT0iIi8+CgkJCQkJCQkJPERlZmF1bHRfVmFsdWUgdmFsdWU9IiIvPgoJCQkJCQkJCTxGaWVsZF9Qb3NpdGlvbiB2YWx1ZT0iMiIvPgoJCQkJCQkJCTxJbmRleGVkIHZhbHVlPSIwIi8+CgkJCQkJCQkJPExlbmd0aCB2YWx1ZT0iLTEiLz4KCQkJCQkJCQk8TmFtZSB2YWx1ZT0iZmVjX2luZ3Jlc28iLz4KCQkJCQkJCQk8TnVsbGFibGUgdmFsdWU9IjAiLz4KCQkJCQkJCQk8T25fVXBkYXRlX1NldF9DdXJyZW50IHZhbHVlPSIwIi8+CgkJCQkJCQkJPFByZWNpc2lvbiB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxTY2FsZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxUeXBlIHZhbHVlPSJEYXRlIi8+CgkJCQkJCQkJPFVuaXF1ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxVbnNpZ25lZCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxaZXJvZmlsbCB2YWx1ZT0iMCIvPgoJCQkJCQkJPC9Qcm9wZXJ0aWVzPgoJCQkJCQkJPGNvbnRyb2wgdmFsdWU9IiIvPgoJCQkJCQkJPGRlbGV0ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPG5hbWUgdmFsdWU9ImZlY19pbmdyZXNvIi8+CgkJCQkJCTwvbzQ+CgkJCQkJCTxvNT4KCQkJCQkJCTxDaGFuZ2VzIHZhbHVlPSIiLz4KCQkJCQkJCTxQcm9wZXJ0aWVzPgoJCQkJCQkJCTxBdXRvaW5jcmVtZW50IHZhbHVlPSIwIi8+CgkJCQkJCQkJPENoYXJzZXQgdmFsdWU9IiIvPgoJCQkJCQkJCTxDb2xsYXRpb24gdmFsdWU9IiIvPgoJCQkJCQkJCTxDb21tZW50IHZhbHVlPSIiLz4KCQkJCQkJCQk8RGVmYXVsdF9WYWx1ZSB2YWx1ZT0iIi8+CgkJCQkJCQkJPEZpZWxkX1Bvc2l0aW9uIHZhbHVlPSI0Ii8+CgkJCQkJCQkJPEluZGV4ZWQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8TGVuZ3RoIHZhbHVlPSItMSIvPgoJCQkJCQkJCTxOYW1lIHZhbHVlPSJmZWNfdmVuY2ltaWVudG8iLz4KCQkJCQkJCQk8TnVsbGFibGUgdmFsdWU9IjAiLz4KCQkJCQkJCQk8T25fVXBkYXRlX1NldF9DdXJyZW50IHZhbHVlPSIwIi8+CgkJCQkJCQkJPFByZWNpc2lvbiB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxTY2FsZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxUeXBlIHZhbHVlPSJEYXRlIi8+CgkJCQkJCQkJPFVuaXF1ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxVbnNpZ25lZCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxaZXJvZmlsbCB2YWx1ZT0iMCIvPgoJCQkJCQkJPC9Qcm9wZXJ0aWVzPgoJCQkJCQkJPGNvbnRyb2wgdmFsdWU9IiIvPgoJCQkJCQkJPGRlbGV0ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPG5hbWUgdmFsdWU9ImZlY192ZW5jaW1pZW50byIvPgoJCQkJCQk8L281PgoJCQkJCQk8bzY+CgkJCQkJCQk8Q2hhbmdlcyB2YWx1ZT0iIi8+CgkJCQkJCQk8UHJvcGVydGllcz4KCQkJCQkJCQk8QXV0b2luY3JlbWVudCB2YWx1ZT0iMSIvPgoJCQkJCQkJCTxDaGFyc2V0IHZhbHVlPSIiLz4KCQkJCQkJCQk8Q29sbGF0aW9uIHZhbHVlPSIiLz4KCQkJCQkJCQk8Q29tbWVudCB2YWx1ZT0iIi8+CgkJCQkJCQkJPERlZmF1bHRfVmFsdWUgdmFsdWU9IiIvPgoJCQkJCQkJCTxGaWVsZF9Qb3NpdGlvbiB2YWx1ZT0iMSIvPgoJCQkJCQkJCTxJbmRleGVkIHZhbHVlPSIxIi8+CgkJCQkJCQkJPExlbmd0aCB2YWx1ZT0iMTEiLz4KCQkJCQkJCQk8TmFtZSB2YWx1ZT0iaWQiLz4KCQkJCQkJCQk8TnVsbGFibGUgdmFsdWU9IjAiLz4KCQkJCQkJCQk8T25fVXBkYXRlX1NldF9DdXJyZW50IHZhbHVlPSIwIi8+CgkJCQkJCQkJPFByZWNpc2lvbiB2YWx1ZT0iMTAiLz4KCQkJCQkJCQk8U2NhbGUgdmFsdWU9IjAiLz4KCQkJCQkJCQk8VHlwZSB2YWx1ZT0iSW50Ii8+CgkJCQkJCQkJPFVuaXF1ZSB2YWx1ZT0iMSIvPgoJCQkJCQkJCTxVbnNpZ25lZCB2YWx1ZT0iMSIvPgoJCQkJCQkJCTxaZXJvZmlsbCB2YWx1ZT0iMCIvPgoJCQkJCQkJPC9Qcm9wZXJ0aWVzPgoJCQkJCQkJPGNvbnRyb2wgdmFsdWU9IiIvPgoJCQkJCQkJPGRlbGV0ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPG5hbWUgdmFsdWU9ImlkIi8+CgkJCQkJCTwvbzY+CgkJCQkJCTxvNz4KCQkJCQkJCTxDaGFuZ2VzIHZhbHVlPSIiLz4KCQkJCQkJCTxQcm9wZXJ0aWVzPgoJCQkJCQkJCTxBdXRvaW5jcmVtZW50IHZhbHVlPSIwIi8+CgkJCQkJCQkJPENoYXJzZXQgdmFsdWU9InV0ZjgiLz4KCQkJCQkJCQk8Q29sbGF0aW9uIHZhbHVlPSJ1dGY4X2dlbmVyYWxfY2kiLz4KCQkJCQkJCQk8Q29tbWVudCB2YWx1ZT0iIi8+CgkJCQkJCQkJPERlZmF1bHRfVmFsdWUgdmFsdWU9IiIvPgoJCQkJCQkJCTxGaWVsZF9Qb3NpdGlvbiB2YWx1ZT0iMyIvPgoJCQkJCQkJCTxJbmRleGVkIHZhbHVlPSIwIi8+CgkJCQkJCQkJPExlbmd0aCB2YWx1ZT0iMjAiLz4KCQkJCQkJCQk8TmFtZSB2YWx1ZT0ibG90ZV9pbnRlcm5vIi8+CgkJCQkJCQkJPE51bGxhYmxlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPE9uX1VwZGF0ZV9TZXRfQ3VycmVudCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxQcmVjaXNpb24gdmFsdWU9IjAiLz4KCQkJCQkJCQk8U2NhbGUgdmFsdWU9IjAiLz4KCQkJCQkJCQk8VHlwZSB2YWx1ZT0iVmFyQ2hhciIvPgoJCQkJCQkJCTxVbmlxdWUgdmFsdWU9IjAiLz4KCQkJCQkJCQk8VW5zaWduZWQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8WmVyb2ZpbGwgdmFsdWU9IjAiL
z4KCQkJCQkJCTwvUHJvcGVydGllcz4KCQkJCQkJCTxjb250cm9sIHZhbHVlPSIiLz4KCQkJCQkJCTxkZWxldGUgdmFsdWU9IjAiLz4KCQkJCQkJCTxuYW1lIHZhbHVlPSJsb3RlX2ludGVybm8iLz4KCQkJCQkJPC9vNz4KCQkJCQkJPG84PgoJCQkJCQkJPENoYW5nZXMgdmFsdWU9IiIvPgoJCQkJCQkJPFByb3BlcnRpZXM+CgkJCQkJCQkJPEF1dG9pbmNyZW1lbnQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8Q2hhcnNldCB2YWx1ZT0iIi8+CgkJCQkJCQkJPENvbGxhdGlvbiB2YWx1ZT0iIi8+CgkJCQkJCQkJPENvbW1lbnQgdmFsdWU9IiIvPgoJCQkJCQkJCTxEZWZhdWx0X1ZhbHVlIHZhbHVlPSIiLz4KCQkJCQkJCQk8RmllbGRfUG9zaXRpb24gdmFsdWU9IjYiLz4KCQkJCQkJCQk8SW5kZXhlZCB2YWx1ZT0iMSIvPgoJCQkJCQkJCTxMZW5ndGggdmFsdWU9IjExIi8+CgkJCQkJCQkJPE5hbWUgdmFsdWU9Im1hdGVyaWFfcHJpbWFfaW5zdW1vIi8+CgkJCQkJCQkJPE51bGxhYmxlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPE9uX1VwZGF0ZV9TZXRfQ3VycmVudCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxQcmVjaXNpb24gdmFsdWU9IjEwIi8+CgkJCQkJCQkJPFNjYWxlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFR5cGUgdmFsdWU9IkludCIvPgoJCQkJCQkJCTxVbmlxdWUgdmFsdWU9IjAiLz4KCQkJCQkJCQk8VW5zaWduZWQgdmFsdWU9IjEiLz4KCQkJCQkJCQk8WmVyb2ZpbGwgdmFsdWU9IjAiLz4KCQkJCQkJCTwvUHJvcGVydGllcz4KCQkJCQkJCTxjb250cm9sIHZhbHVlPSIiLz4KCQkJCQkJCTxkZWxldGUgdmFsdWU9IjAiLz4KCQkJCQkJCTxuYW1lIHZhbHVlPSJtYXRlcmlhX3ByaW1hX2luc3VtbyIvPgoJCQkJCQk8L284PgoJCQkJCQk8bzk+CgkJCQkJCQk8Q2hhbmdlcyB2YWx1ZT0iIi8+CgkJCQkJCQk8UHJvcGVydGllcz4KCQkJCQkJCQk8QXV0b2luY3JlbWVudCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxDaGFyc2V0IHZhbHVlPSJ1dGY4Ii8+CgkJCQkJCQkJPENvbGxhdGlvbiB2YWx1ZT0idXRmOF9nZW5lcmFsX2NpIi8+CgkJCQkJCQkJPENvbW1lbnQgdmFsdWU9IiIvPgoJCQkJCQkJCTxEZWZhdWx0X1ZhbHVlIHZhbHVlPSIiLz4KCQkJCQkJCQk8RmllbGRfUG9zaXRpb24gdmFsdWU9IjkiLz4KCQkJCQkJCQk8SW5kZXhlZCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxMZW5ndGggdmFsdWU9IjEwMCIvPgoJCQkJCQkJCTxOYW1lIHZhbHVlPSJudW1fbG90ZV9leHRlcm5vIi8+CgkJCQkJCQkJPE51bGxhYmxlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPE9uX1VwZGF0ZV9TZXRfQ3VycmVudCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxQcmVjaXNpb24gdmFsdWU9IjAiLz4KCQkJCQkJCQk8U2NhbGUgdmFsdWU9IjAiLz4KCQkJCQkJCQk8VHlwZSB2YWx1ZT0iVmFyQ2hhciIvPgoJCQkJCQkJCTxVbmlxdWUgdmFsdWU9IjAiLz4KCQkJCQkJCQk8VW5zaWduZWQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8WmVyb2ZpbGwgdmFsdWU9IjAiLz4KCQkJCQkJCTwvUHJvcGVydGllcz4KCQkJCQkJCTxjb250cm9sIHZhbHVlPSIiLz4KCQkJCQkJCTxkZWxldGUgdmFsdWU9IjAiLz4KCQkJCQkJCTxuYW1lIHZhbHVlPSJudW1fbG90ZV9leHRlcm5vIi8+CgkJCQkJCTwvbzk+CgkJCQkJPC9maWVsZD4KCQkJCQk8aW5kZXg+CgkJCQkJCTxvMD4KCQkJCQkJCTxDaGFuZ2VzIHZhbHVlPSIiLz4KCQkJCQkJCTxQcm9wZXJ0aWVzPgoJCQkJCQkJCTxDb21tZW50IHZhbHVlPSIiLz4KCQkJCQkJCQk8RmllbGRzIHZhbHVlPSJiV0YwWlhKcFlWOXdjbWx0WVY5cGJuTjFiVzg9Ii8+CgkJCQkJCQkJPE5hbWUgdmFsdWU9Imxua19yZWNlcGNpb25fbWF0ZXJpYV9wcmltYV9ub19jYXJuaWNhX2luc3VtbyIvPgoJCQkJCQkJCTxUeXBlIHZhbHVlPSJCVFJFRSIvPgoJCQkJCQkJCTxVbmlxdWUgdmFsdWU9IjAiLz4KCQkJCQkJCTwvUHJvcGVydGllcz4KCQkJCQkJCTxjb250cm9sIHZhbHVlPSIiLz4KCQkJCQkJCTxkZWxldGUgdmFsdWU9IjAiLz4KCQkJCQkJCTxuYW1lIHZhbHVlPSJsbmtfcmVjZXBjaW9uX21hdGVyaWFfcHJpbWFfbm9fY2FybmljYV9pbnN1bW8iLz4KCQkJCQkJPC9vMD4KCQkJCQkJPG8xPgoJCQkJCQkJPENoYW5nZXMgdmFsdWU9IiIvPgoJCQkJCQkJPFByb3BlcnRpZXM+CgkJCQkJCQkJPENvbW1lbnQgdmFsdWU9IiIvPgoJCQkJCQkJCTxGaWVsZHMgdmFsdWU9ImNISnZkbVZsWkc5eVgybGsiLz4KCQkJCQkJCQk8TmFtZSB2YWx1ZT0ibG5rX3JlY2VwY2lvbl9tYXRlcmlhX3ByaW1hX25vX2Nhcm5pY2FfcHJvdmVlZG9yIi8+CgkJCQkJCQkJPFR5cGUgdmFsdWU9IkJUUkVFIi8+CgkJCQkJCQkJPFVuaXF1ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPC9Qcm9wZXJ0aWVzPgoJCQkJCQkJPGNvbnRyb2wgdmFsdWU9IiIvPgoJCQkJCQkJPGRlbGV0ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPG5hbWUgdmFsdWU9Imxua19yZWNlcGNpb25fbWF0ZXJpYV9wcmltYV9ub19jYXJuaWNhX3Byb3ZlZWRvciIvPgoJCQkJCQk8L28xPgoJCQkJCQk8bzI+CgkJCQkJCQk8Q2hhbmdlcyB2YWx1ZT0iIi8+CgkJCQkJCQk8UHJvcGVydGllcz4KCQkJCQkJCQk8Q29tbWVudCB2YWx1ZT0iIi8+CgkJCQkJCQkJPEZpZWxkcyB2YWx1ZT0iY21WamFXSnBaRzg9Ii8+CgkJCQkJCQkJPE5hbWUgdmFsdWU9Imxua19yZWNlcGNpb25fbWF0ZXJpYV9wcmltYV9ub19jYXJuaWNhX1VzZXIiLz4KCQkJCQkJCQk8VHlwZSB2YWx1ZT0iQlRSRUUiLz4KCQkJCQkJCQk8VW5pcXVlIHZhbHVlPSIwIi8+CgkJCQkJCQk8L1Byb3BlcnRpZXM+CgkJCQkJCQk8Y29udHJvbCB2YWx1ZT0iIi8+CgkJCQkJCQk8ZGVsZXRlIHZhbHVlPSIwIi8+CgkJCQkJCQk8bmFtZSB2YWx1ZT0ibG5rX3JlY2VwY2lvbl9tYXRlcmlhX3ByaW1hX25vX2Nhcm5pY2FfVXNlciIvPgoJCQkJCQk8L28yPgoJCQkJCQk8bzM+CgkJCQkJCQk8Q2hhbmdlcyB2YWx1ZT0iIi8+CgkJCQkJCQk8UHJvcGVydGllcz4KCQkJCQkJCQk8Q29tbWVudCB2YWx1ZT0iIi8+CgkJCQkJCQkJPEZpZWxkcyB2YWx1ZT0iYVdRPSIvPgoJCQkJCQkJCTxOYW1lIHZhbHVlPSJQUklNQVJZIi8+CgkJCQkJCQkJPFR5cGUgdmFsdWU9IkJUUkVFIi8+CgkJCQkJCQkJPFVuaXF1Z
SB2YWx1ZT0iMSIvPgoJCQkJCQkJPC9Qcm9wZXJ0aWVzPgoJCQkJCQkJPGNvbnRyb2wgdmFsdWU9IiIvPgoJCQkJCQkJPGRlbGV0ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPG5hbWUgdmFsdWU9IlBSSU1BUlkiLz4KCQkJCQkJPC9vMz4KCQkJCQk8L2luZGV4PgoJCQkJCTxuYW1lIHZhbHVlPSJyZWNlcGNpb25fbWF0ZXJpYV9wcmltYV9ub19jYXJuaWNhIi8+CgkJCQkJPHVuaXF1ZT4KCQkJCQkJPG8wPgoJCQkJCQkJPENoYW5nZXMgdmFsdWU9IiIvPgoJCQkJCQkJPFByb3BlcnRpZXM+CgkJCQkJCQkJPEZpZWxkcyB2YWx1ZT0iYVdRPSIvPgoJCQkJCQkJCTxOYW1lIHZhbHVlPSJQUklNQVJZIi8+CgkJCQkJCQk8L1Byb3BlcnRpZXM+CgkJCQkJCQk8Y29udHJvbCB2YWx1ZT0iIi8+CgkJCQkJCQk8ZGVsZXRlIHZhbHVlPSIwIi8+CgkJCQkJCQk8bmFtZSB2YWx1ZT0iUFJJTUFSWSIvPgoJCQkJCQk8L28wPgoJCQkJCTwvdW5pcXVlPgoJCQkJPC9vMj4KCQkJPC90YWJsZT4KCQk8L21lZ2FjaG9yaXpvcz4KCTwvTW9kZWw+CjwvcHJvcGVydGllcz4KCg==', NULL, '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', 'root*849', '2015-05-14 05:22:00', '4' );
-- ---------------------------------------------------------


-- CREATE INDEX "child" ------------------------------------
CREATE INDEX `child` USING BTREE ON `AuthItemChild`( `child` );
-- ---------------------------------------------------------


-- CREATE INDEX "lnk_ctrl_producciones_trazabilidad_pruducto" 
CREATE INDEX `lnk_ctrl_producciones_trazabilidad_pruducto` USING BTREE ON `ctrl_producciones_trazabilidad`( `producto` );
-- ---------------------------------------------------------


-- CREATE INDEX "lnk_detalle_ctrl_producciones_ctrl_producciones_trazabilidad" 
CREATE INDEX `lnk_detalle_ctrl_producciones_ctrl_producciones_trazabilidad` USING BTREE ON `detalle_ctrl_producciones`( `ctrl_producciones_id` );
-- ---------------------------------------------------------


-- CREATE INDEX "lnk_detalle_ctrl_producciones_insumo" -----
CREATE INDEX `lnk_detalle_ctrl_producciones_insumo` USING BTREE ON `detalle_ctrl_producciones`( `insumo_id` );
-- ---------------------------------------------------------


-- CREATE INDEX "lnk_detalle_ctrl_producciones_proveedor" --
CREATE INDEX `lnk_detalle_ctrl_producciones_proveedor` USING BTREE ON `detalle_ctrl_producciones`( `proveedor_id` );
-- ---------------------------------------------------------


-- CREATE INDEX "lnk_formulacion_insumo" -------------------
CREATE INDEX `lnk_formulacion_insumo` USING BTREE ON `formulacion`( `materia_prima` );
-- ---------------------------------------------------------


-- CREATE INDEX "lnk_formulacion_producto" -----------------
CREATE INDEX `lnk_formulacion_producto` USING BTREE ON `formulacion`( `producto_id` );
-- ---------------------------------------------------------


-- CREATE INDEX "lnk_proveedor_municipio" ------------------
CREATE INDEX `lnk_proveedor_municipio` USING BTREE ON `proveedor`( `municipio_id` );
-- ---------------------------------------------------------


-- CREATE INDEX "lnk_proveedor_insumo_proveedor" -----------
CREATE INDEX `lnk_proveedor_insumo_proveedor` USING BTREE ON `proveedor_insumo`( `proveedor_id` );
-- ---------------------------------------------------------


-- CREATE INDEX "lnk_recepcion_materia_prima_carnica_insumo" 
CREATE INDEX `lnk_recepcion_materia_prima_carnica_insumo` USING BTREE ON `recepcion_materia_prima_carnica`( `materia_prima_insumo` );
-- ---------------------------------------------------------


-- CREATE INDEX "lnk_recepcion_materia_prima_carnica_proveedor" 
CREATE INDEX `lnk_recepcion_materia_prima_carnica_proveedor` USING BTREE ON `recepcion_materia_prima_carnica`( `proveedor` );
-- ---------------------------------------------------------


-- CREATE INDEX "lnk_recepcion_materia_prima_carnica_User" -
CREATE INDEX `lnk_recepcion_materia_prima_carnica_User` USING BTREE ON `recepcion_materia_prima_carnica`( `recibido` );
-- ---------------------------------------------------------


-- CREATE INDEX "lnk_recepcion_materia_prima_no_carnica_insumo" 
CREATE INDEX `lnk_recepcion_materia_prima_no_carnica_insumo` USING BTREE ON `recepcion_materia_prima_no_carnica`( `materia_prima_insumo` );
-- ---------------------------------------------------------


-- CREATE INDEX "lnk_recepcion_materia_prima_no_carnica_proveedor" 
CREATE INDEX `lnk_recepcion_materia_prima_no_carnica_proveedor` USING BTREE ON `recepcion_materia_prima_no_carnica`( `proveedor_id` );
-- ---------------------------------------------------------


-- CREATE INDEX "lnk_recepcion_materia_prima_no_carnica_User" 
CREATE INDEX `lnk_recepcion_materia_prima_no_carnica_User` USING BTREE ON `recepcion_materia_prima_no_carnica`( `recibido` );
-- ---------------------------------------------------------


-- CREATE INDEX "lnk_reporte_control_horneado_User" --------
CREATE INDEX `lnk_reporte_control_horneado_User` USING BTREE ON `reporte_control_horneado`( `responsable_id` );
-- ---------------------------------------------------------


-- CREATE INDEX "lnk_reporte_empaque_vacio_User" -----------
CREATE INDEX `lnk_reporte_empaque_vacio_User` USING BTREE ON `reporte_empaque_vacio`( `responsable_id` );
-- ---------------------------------------------------------


-- CREATE LINK "AuthAssignment_ibfk_1" ---------------------
ALTER TABLE `AuthAssignment`
	ADD CONSTRAINT `AuthAssignment_ibfk_1` FOREIGN KEY ( `itemname` )
	REFERENCES `AuthItem`( `name` )
	ON DELETE Cascade
	ON UPDATE Cascade;
-- ---------------------------------------------------------


-- CREATE LINK "AuthItemChild_ibfk_1" ----------------------
ALTER TABLE `AuthItemChild`
	ADD CONSTRAINT `AuthItemChild_ibfk_1` FOREIGN KEY ( `parent` )
	REFERENCES `AuthItem`( `name` )
	ON DELETE Cascade
	ON UPDATE Cascade;
-- ---------------------------------------------------------


-- CREATE LINK "AuthItemChild_ibfk_2" ----------------------
ALTER TABLE `AuthItemChild`
	ADD CONSTRAINT `AuthItemChild_ibfk_2` FOREIGN KEY ( `child` )
	REFERENCES `AuthItem`( `name` )
	ON DELETE Cascade
	ON UPDATE Cascade;
-- ---------------------------------------------------------


-- CREATE LINK "lnk_ctrl_producciones_trazabilidad_pruducto" 
ALTER TABLE `ctrl_producciones_trazabilidad`
	ADD CONSTRAINT `lnk_ctrl_producciones_trazabilidad_pruducto` FOREIGN KEY ( `producto` )
	REFERENCES `producto`( `id` )
	ON DELETE No Action
	ON UPDATE Cascade;
-- ---------------------------------------------------------


-- CREATE LINK "lnk_detalle_ctrl_producciones_ctrl_producciones_trazabilidad" 
ALTER TABLE `detalle_ctrl_producciones`
	ADD CONSTRAINT `lnk_detalle_ctrl_producciones_ctrl_producciones_trazabilidad` FOREIGN KEY ( `ctrl_producciones_id` )
	REFERENCES `ctrl_producciones_trazabilidad`( `id` )
	ON DELETE No Action
	ON UPDATE Cascade;
-- ---------------------------------------------------------


-- CREATE LINK "lnk_detalle_ctrl_producciones_insumo" ------
ALTER TABLE `detalle_ctrl_producciones`
	ADD CONSTRAINT `lnk_detalle_ctrl_producciones_insumo` FOREIGN KEY ( `insumo_id` )
	REFERENCES `insumo`( `id` )
	ON DELETE No Action
	ON UPDATE Cascade;
-- ---------------------------------------------------------


-- CREATE LINK "lnk_detalle_ctrl_producciones_proveedor" ---
ALTER TABLE `detalle_ctrl_producciones`
	ADD CONSTRAINT `lnk_detalle_ctrl_producciones_proveedor` FOREIGN KEY ( `proveedor_id` )
	REFERENCES `proveedor`( `id` )
	ON DELETE No Action
	ON UPDATE Cascade;
-- ---------------------------------------------------------


-- CREATE LINK "lnk_formulacion_insumo" --------------------
ALTER TABLE `formulacion`
	ADD CONSTRAINT `lnk_formulacion_insumo` FOREIGN KEY ( `materia_prima` )
	REFERENCES `insumo`( `id` )
	ON DELETE No Action
	ON UPDATE Cascade;
-- ---------------------------------------------------------


-- CREATE LINK "lnk_formulacion_producto" ------------------
ALTER TABLE `formulacion`
	ADD CONSTRAINT `lnk_formulacion_producto` FOREIGN KEY ( `producto_id` )
	REFERENCES `producto`( `id` )
	ON DELETE No Action
	ON UPDATE Cascade;
-- ---------------------------------------------------------


-- CREATE LINK "lnk_proveedor_municipio" -------------------
ALTER TABLE `proveedor`
	ADD CONSTRAINT `lnk_proveedor_municipio` FOREIGN KEY ( `municipio_id` )
	REFERENCES `municipio`( `coddane` )
	ON DELETE No Action
	ON UPDATE Cascade;
-- ---------------------------------------------------------


-- CREATE LINK "lnk_proveedor_insumo_insumo" ---------------
ALTER TABLE `proveedor_insumo`
	ADD CONSTRAINT `lnk_proveedor_insumo_insumo` FOREIGN KEY ( `insumo_id` )
	REFERENCES `insumo`( `id` )
	ON DELETE No Action
	ON UPDATE Cascade;
-- ---------------------------------------------------------


-- CREATE LINK "lnk_proveedor_insumo_proveedor" ------------
ALTER TABLE `proveedor_insumo`
	ADD CONSTRAINT `lnk_proveedor_insumo_proveedor` FOREIGN KEY ( `proveedor_id` )
	REFERENCES `proveedor`( `id` )
	ON DELETE Cascade
	ON UPDATE Cascade;
-- ---------------------------------------------------------


-- CREATE LINK "lnk_recepcion_materia_prima_carnica_insumo" 
ALTER TABLE `recepcion_materia_prima_carnica`
	ADD CONSTRAINT `lnk_recepcion_materia_prima_carnica_insumo` FOREIGN KEY ( `materia_prima_insumo` )
	REFERENCES `insumo`( `id` )
	ON DELETE No Action
	ON UPDATE Cascade;
-- ---------------------------------------------------------


-- CREATE LINK "lnk_recepcion_materia_prima_carnica_proveedor" 
ALTER TABLE `recepcion_materia_prima_carnica`
	ADD CONSTRAINT `lnk_recepcion_materia_prima_carnica_proveedor` FOREIGN KEY ( `proveedor` )
	REFERENCES `proveedor`( `id` )
	ON DELETE No Action
	ON UPDATE Cascade;
-- ---------------------------------------------------------


-- CREATE LINK "lnk_recepcion_materia_prima_carnica_User" --
ALTER TABLE `recepcion_materia_prima_carnica`
	ADD CONSTRAINT `lnk_recepcion_materia_prima_carnica_User` FOREIGN KEY ( `recibido` )
	REFERENCES `User`( `id` )
	ON DELETE No Action
	ON UPDATE Cascade;
-- ---------------------------------------------------------


-- CREATE LINK "lnk_recepcion_materia_prima_no_carnica_insumo" 
ALTER TABLE `recepcion_materia_prima_no_carnica`
	ADD CONSTRAINT `lnk_recepcion_materia_prima_no_carnica_insumo` FOREIGN KEY ( `materia_prima_insumo` )
	REFERENCES `insumo`( `id` )
	ON DELETE Cascade
	ON UPDATE Cascade;
-- ---------------------------------------------------------


-- CREATE LINK "lnk_recepcion_materia_prima_no_carnica_proveedor" 
ALTER TABLE `recepcion_materia_prima_no_carnica`
	ADD CONSTRAINT `lnk_recepcion_materia_prima_no_carnica_proveedor` FOREIGN KEY ( `proveedor_id` )
	REFERENCES `proveedor`( `id` )
	ON DELETE No Action
	ON UPDATE Cascade;
-- ---------------------------------------------------------


-- CREATE LINK "lnk_recepcion_materia_prima_no_carnica_User" 
ALTER TABLE `recepcion_materia_prima_no_carnica`
	ADD CONSTRAINT `lnk_recepcion_materia_prima_no_carnica_User` FOREIGN KEY ( `recibido` )
	REFERENCES `User`( `id` )
	ON DELETE No Action
	ON UPDATE Cascade;
-- ---------------------------------------------------------


-- CREATE LINK "lnk_reporte_control_horneado_User" ---------
ALTER TABLE `reporte_control_horneado`
	ADD CONSTRAINT `lnk_reporte_control_horneado_User` FOREIGN KEY ( `responsable_id` )
	REFERENCES `User`( `id` )
	ON DELETE No Action
	ON UPDATE Cascade;
-- ---------------------------------------------------------


-- CREATE LINK "lnk_reporte_empaque_vacio_User" ------------
ALTER TABLE `reporte_empaque_vacio`
	ADD CONSTRAINT `lnk_reporte_empaque_vacio_User` FOREIGN KEY ( `responsable_id` )
	REFERENCES `User`( `id` )
	ON DELETE No Action
	ON UPDATE Cascade;
-- ---------------------------------------------------------


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
-- ---------------------------------------------------------


