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
	`itemname` VarChar( 64 ) NOT NULL,
	`userid` VarChar( 64 ) NOT NULL,
	`bizrule` Text NULL,
	`data` Text NULL,
	PRIMARY KEY ( `itemname`, `userid` ) )
COLLATE = utf8_unicode_ci
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
COLLATE = utf8_unicode_ci
ENGINE = InnoDB;
-- ---------------------------------------------------------


-- CREATE TABLE "AuthItemChild" ----------------------------
CREATE TABLE `AuthItemChild` ( 
	`parent` VarChar( 64 ) NOT NULL,
	`child` VarChar( 64 ) NOT NULL,
	PRIMARY KEY ( `parent`, `child` ),
	CONSTRAINT `child` UNIQUE( `child` ),
	CONSTRAINT `parent` UNIQUE( `parent` ) )
COLLATE = utf8_unicode_ci
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
COLLATE = utf8_unicode_ci
ENGINE = InnoDB
AUTO_INCREMENT = 35;
-- ---------------------------------------------------------


-- CREATE TABLE "averias" ----------------------------------
CREATE TABLE `averias` ( 
	`id` Int( 11 ) UNSIGNED AUTO_INCREMENT NOT NULL,
	`fecha` VarChar( 150 ) NOT NULL,
	`responsable_punto` VarChar( 255 ) NOT NULL,
	`conductor_responsable` VarChar( 255 ) NOT NULL,
	`destino` VarChar( 150 ) NOT NULL,
	PRIMARY KEY ( `id` ),
	CONSTRAINT `id` UNIQUE( `id` ) )
COLLATE = utf8_unicode_ci
ENGINE = InnoDB
AUTO_INCREMENT = 1;
-- ---------------------------------------------------------


-- CREATE TABLE "clientes" ---------------------------------
CREATE TABLE `clientes` ( 
	`id` Int( 11 ) UNSIGNED AUTO_INCREMENT NOT NULL,
	`nombre` VarChar( 255 ) NOT NULL,
	`direccion` VarChar( 255 ) NOT NULL,
	`telefono` VarChar( 255 ) NULL,
	`celular` VarChar( 255 ) NOT NULL,
	`email` VarChar( 255 ) NULL,
	PRIMARY KEY ( `id` ) )
COLLATE = utf8_unicode_ci
ENGINE = InnoDB
AUTO_INCREMENT = 136;
-- ---------------------------------------------------------


-- CREATE TABLE "ctrl_producciones_trazabilidad" -----------
CREATE TABLE `ctrl_producciones_trazabilidad` ( 
	`id` Int( 11 ) UNSIGNED AUTO_INCREMENT NOT NULL,
	`orden_produccion` Int( 11 ) UNSIGNED NOT NULL,
	`fecha` Date NOT NULL,
	`producto` Int( 11 ) UNSIGNED NOT NULL,
	`responsable` VarChar( 255 ) NOT NULL,
	`cant_produccion` TinyInt( 11 ) UNSIGNED NOT NULL DEFAULT '1',
	`unidades_producidas` Int( 10 ) UNSIGNED NOT NULL,
	PRIMARY KEY ( `id` ) )
ENGINE = InnoDB
AUTO_INCREMENT = 1;
-- ---------------------------------------------------------


-- CREATE TABLE "despachos" --------------------------------
CREATE TABLE `despachos` ( 
	`id` Int( 11 ) UNSIGNED AUTO_INCREMENT NOT NULL,
	`fecha` Date NOT NULL,
	`responsable` VarChar( 150 ) NOT NULL,
	`verificado` VarChar( 150 ) NULL,
	PRIMARY KEY ( `id` ) )
COLLATE = utf8_unicode_ci
ENGINE = InnoDB
AUTO_INCREMENT = 1;
-- ---------------------------------------------------------


-- CREATE TABLE "detalle_averias" --------------------------
CREATE TABLE `detalle_averias` ( 
	`id` Int( 11 ) UNSIGNED AUTO_INCREMENT NOT NULL,
	`fecha_reporte` Date NOT NULL,
	`producto_id` Int( 11 ) UNSIGNED NOT NULL,
	`cantidad` Decimal( 5, 2 ) NOT NULL,
	`lote` VarChar( 255 ) NOT NULL,
	`observaciones` VarChar( 150 ) NULL,
	`averia_id` Int( 11 ) UNSIGNED NOT NULL,
	PRIMARY KEY ( `id` ) )
COLLATE = utf8_unicode_ci
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
ENGINE = InnoDB
AUTO_INCREMENT = 1;
-- ---------------------------------------------------------


-- CREATE TABLE "detalle_despacho" -------------------------
CREATE TABLE `detalle_despacho` ( 
	`id` Int( 11 ) UNSIGNED AUTO_INCREMENT NOT NULL,
	`producto` Int( 11 ) UNSIGNED NOT NULL,
	`cliente_id` Int( 11 ) UNSIGNED NOT NULL,
	`lote` VarChar( 80 ) NOT NULL,
	`cantidad` VarChar( 50 ) NOT NULL,
	`destino` VarChar( 150 ) NOT NULL,
	`observaciones` VarChar( 200 ) NULL,
	`id_despacho` Int( 11 ) UNSIGNED NOT NULL,
	PRIMARY KEY ( `id` ) )
COLLATE = utf8_unicode_ci
ENGINE = InnoDB
AUTO_INCREMENT = 1;
-- ---------------------------------------------------------


-- CREATE TABLE "detalle_inventario_empaque_vacio" ---------
CREATE TABLE `detalle_inventario_empaque_vacio` ( 
	`id` Int( 11 ) UNSIGNED AUTO_INCREMENT NOT NULL,
	`producto_id` Int( 11 ) UNSIGNED NOT NULL,
	`unidad` VarChar( 11 ) NOT NULL,
	`lote` VarChar( 100 ) NOT NULL,
	`reproceso` VarChar( 255 ) NOT NULL,
	`observaciones` VarChar( 150 ) NULL,
	`inventario_empaque_vacio_id` Int( 11 ) UNSIGNED NOT NULL,
	`cantidad` Decimal( 2, 0 ) NOT NULL DEFAULT '5',
	PRIMARY KEY ( `id` ) )
COLLATE = utf8_unicode_ci
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
ENGINE = InnoDB
AUTO_INCREMENT = 689;
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
ENGINE = InnoDB
AUTO_INCREMENT = 187;
-- ---------------------------------------------------------


-- CREATE TABLE "inventario_empaque_vacio" -----------------
CREATE TABLE `inventario_empaque_vacio` ( 
	`id` Int( 11 ) UNSIGNED AUTO_INCREMENT NOT NULL,
	`fecha` VarChar( 150 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
	PRIMARY KEY ( `id` ) )
ENGINE = InnoDB
AUTO_INCREMENT = 1;
-- ---------------------------------------------------------


-- CREATE TABLE "municipio" --------------------------------
CREATE TABLE `municipio` ( 
	`coddane` VarChar( 8 ) NOT NULL,
	`municipio` VarChar( 255 ) NOT NULL,
	`departamento` VarChar( 255 ) NOT NULL,
	PRIMARY KEY ( `coddane` ) )
ENGINE = InnoDB;
-- ---------------------------------------------------------


-- CREATE TABLE "personal" ---------------------------------
CREATE TABLE `personal` ( 
	`id` Int( 255 ) UNSIGNED AUTO_INCREMENT NOT NULL,
	`nombres` VarChar( 255 ) NOT NULL,
	`cedula` VarChar( 20 ) NOT NULL,
	`correo` VarChar( 255 ) NOT NULL,
	`user_id` Int( 255 ) NOT NULL,
	PRIMARY KEY ( `id` ),
	CONSTRAINT `unique_cedula` UNIQUE( `cedula` ),
	CONSTRAINT `unique_correo` UNIQUE( `correo` ),
	CONSTRAINT `unique_user_id` UNIQUE( `user_id` ) )
COLLATE = utf8_unicode_ci
COMMENT 'Personas que van a utilizar el aplicativo'
ENGINE = InnoDB
AUTO_INCREMENT = 9;
-- ---------------------------------------------------------


-- CREATE TABLE "producto" ---------------------------------
CREATE TABLE `producto` ( 
	`id` Int( 11 ) UNSIGNED AUTO_INCREMENT NOT NULL,
	`nombre` VarChar( 255 ) NOT NULL,
	`cantidad` Decimal( 10, 0 ) UNSIGNED NOT NULL DEFAULT '0',
	PRIMARY KEY ( `id` ),
	CONSTRAINT `nombre` UNIQUE( `nombre` ) )
ENGINE = InnoDB
AUTO_INCREMENT = 67;
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
	`estado` Enum( '0', '1' ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '1',
	PRIMARY KEY ( `id` ) )
ENGINE = InnoDB
AUTO_INCREMENT = 81;
-- ---------------------------------------------------------


-- CREATE TABLE "proveedor_insumo" -------------------------
CREATE TABLE `proveedor_insumo` ( 
	`id` Int( 11 ) UNSIGNED AUTO_INCREMENT NOT NULL,
	`insumo_id` Int( 11 ) UNSIGNED NOT NULL,
	`proveedor_id` Int( 11 ) UNSIGNED NOT NULL,
	`cantidad` Decimal( 10, 2 ) UNSIGNED NOT NULL DEFAULT '0.00',
	PRIMARY KEY ( `id` ),
	CONSTRAINT `unico` UNIQUE( `insumo_id`, `proveedor_id` ) )
ENGINE = InnoDB
AUTO_INCREMENT = 292;
-- ---------------------------------------------------------


-- CREATE TABLE "recepcion_materia_prima_carnica" ----------
CREATE TABLE `recepcion_materia_prima_carnica` ( 
	`id` Int( 11 ) UNSIGNED AUTO_INCREMENT NOT NULL,
	`fec_ingreso` Date NOT NULL,
	`lote_interno` VarChar( 100 ) NOT NULL,
	`proveedor` Int( 11 ) UNSIGNED NOT NULL,
	`materia_prima_insumo` Int( 11 ) UNSIGNED NOT NULL,
	`peso` Decimal( 4, 1 ) UNSIGNED NOT NULL,
	`temperatura_llegada` VarChar( 10 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
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
ENGINE = InnoDB
AUTO_INCREMENT = 1;
-- ---------------------------------------------------------


-- CREATE TABLE "recepcion_materia_prima_no_carnica" -------
CREATE TABLE `recepcion_materia_prima_no_carnica` ( 
	`id` Int( 11 ) UNSIGNED AUTO_INCREMENT NOT NULL,
	`fec_ingreso` Date NOT NULL,
	`lote_interno` Int( 11 ) UNSIGNED NOT NULL DEFAULT '0',
	`fec_vencimiento` Date NOT NULL,
	`proveedor_id` Int( 11 ) UNSIGNED NOT NULL,
	`materia_prima_insumo` Int( 11 ) UNSIGNED NOT NULL,
	`peso_total` Decimal( 10, 3 ) UNSIGNED NOT NULL,
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
ENGINE = InnoDB
AUTO_INCREMENT = 1;
-- ---------------------------------------------------------


-- CREATE TABLE "rel_reporte_despachos_producto" -----------
CREATE TABLE `rel_reporte_despachos_producto` ( 
	`id_reporte_despachos` Int( 11 ) UNSIGNED NOT NULL,
	`id_producto` Int( 11 ) UNSIGNED NOT NULL,
	PRIMARY KEY ( `id_producto`, `id_reporte_despachos` ),
	CONSTRAINT `id_producto` UNIQUE( `id_producto` ),
	CONSTRAINT `id_reporte_despachos` UNIQUE( `id_reporte_despachos` ) )
COLLATE = utf8_unicode_ci
ENGINE = InnoDB;
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
ENGINE = InnoDB
AUTO_INCREMENT = 1;
-- ---------------------------------------------------------


-- CREATE TABLE "reporte_despachos" ------------------------
CREATE TABLE `reporte_despachos` ( 
	`id` Int( 11 ) UNSIGNED AUTO_INCREMENT NOT NULL,
	`fecha_reporte` Date NOT NULL,
	`destino` VarChar( 150 ) NOT NULL,
	PRIMARY KEY ( `id` ) )
COLLATE = utf8_unicode_ci
ENGINE = InnoDB
AUTO_INCREMENT = 1;
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
ENGINE = InnoDB
AUTO_INCREMENT = 1;
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
COLLATE = utf8_unicode_ci
ENGINE = MyISAM;
-- ---------------------------------------------------------


-- Dump data of "AuthAssignment" ---------------------------
INSERT INTO `AuthAssignment`(`itemname`,`userid`,`bizrule`,`data`) VALUES ( 'admin', 'admin', NULL, NULL );
INSERT INTO `AuthAssignment`(`itemname`,`userid`,`bizrule`,`data`) VALUES ( 'Admin1', '1024582122', NULL, 's:2:"N;";' );
INSERT INTO `AuthAssignment`(`itemname`,`userid`,`bizrule`,`data`) VALUES ( 'Admin1', '31', NULL, 's:2:"N;";' );
INSERT INTO `AuthAssignment`(`itemname`,`userid`,`bizrule`,`data`) VALUES ( 'Admin1', '33', NULL, 's:2:"N;";' );
INSERT INTO `AuthAssignment`(`itemname`,`userid`,`bizrule`,`data`) VALUES ( 'Admin1', 'jadmin', NULL, NULL );
-- ---------------------------------------------------------


-- Dump data of "AuthItem" ---------------------------------
INSERT INTO `AuthItem`(`name`,`type`,`description`,`bizrule`,`data`) VALUES ( 'admin', '2', '', NULL, NULL );
INSERT INTO `AuthItem`(`name`,`type`,`description`,`bizrule`,`data`) VALUES ( 'Admin1', '0', NULL, NULL, NULL );
INSERT INTO `AuthItem`(`name`,`type`,`description`,`bizrule`,`data`) VALUES ( 'despachos', '0', '', NULL, NULL );
INSERT INTO `AuthItem`(`name`,`type`,`description`,`bizrule`,`data`) VALUES ( 'embutidor', '0', '', NULL, NULL );
INSERT INTO `AuthItem`(`name`,`type`,`description`,`bizrule`,`data`) VALUES ( 'horneador', '0', '', NULL, NULL );
INSERT INTO `AuthItem`(`name`,`type`,`description`,`bizrule`,`data`) VALUES ( 'liderarea', '0', '', NULL, NULL );
INSERT INTO `AuthItem`(`name`,`type`,`description`,`bizrule`,`data`) VALUES ( 'mezclador', '0', '', NULL, NULL );
INSERT INTO `AuthItem`(`name`,`type`,`description`,`bizrule`,`data`) VALUES ( 'recepcion', '0', '', NULL, NULL );
INSERT INTO `AuthItem`(`name`,`type`,`description`,`bizrule`,`data`) VALUES ( 'recepcionista', '0', '', NULL, NULL );
-- ---------------------------------------------------------


-- Dump data of "AuthItemChild" ----------------------------
-- ---------------------------------------------------------


-- Dump data of "User" -------------------------------------
INSERT INTO `User`(`id`,`username`,`password`,`nombres`,`tipo_doc`,`num_doc`,`typeUser`,`email`,`estado`) VALUES ( '22', 'jadmin', 'f09b67d2589465a9d35505b9549fde70', 'juanito', NULL, '', NULL, NULL, '' );
INSERT INTO `User`(`id`,`username`,`password`,`nombres`,`tipo_doc`,`num_doc`,`typeUser`,`email`,`estado`) VALUES ( '23', 'admin', '123', 'Usuario Mega', NULL, '', NULL, NULL, '1' );
INSERT INTO `User`(`id`,`username`,`password`,`nombres`,`tipo_doc`,`num_doc`,`typeUser`,`email`,`estado`) VALUES ( '27', '12222', '202cb962ac59075b964b07152d234b70', 'juanc', NULL, '', NULL, 'asfq12@asf.com', '1' );
INSERT INTO `User`(`id`,`username`,`password`,`nombres`,`tipo_doc`,`num_doc`,`typeUser`,`email`,`estado`) VALUES ( '28', '12222', '202cb962ac59075b964b07152d234b70', 'juanc', NULL, '', NULL, 'asfq12@asf.com', '1' );
INSERT INTO `User`(`id`,`username`,`password`,`nombres`,`tipo_doc`,`num_doc`,`typeUser`,`email`,`estado`) VALUES ( '29', '12222', '202cb962ac59075b964b07152d234b70', 'juanc', NULL, '', NULL, 'asfq12@asf.com', '1' );
INSERT INTO `User`(`id`,`username`,`password`,`nombres`,`tipo_doc`,`num_doc`,`typeUser`,`email`,`estado`) VALUES ( '30', '12222', '202cb962ac59075b964b07152d234b70', 'juanc', NULL, '', NULL, 'asfq12@asf.com', '1' );
INSERT INTO `User`(`id`,`username`,`password`,`nombres`,`tipo_doc`,`num_doc`,`typeUser`,`email`,`estado`) VALUES ( '31', '12222', '202cb962ac59075b964b07152d234b70', 'juanc', NULL, '', NULL, 'asfq12@asf.com', '1' );
INSERT INTO `User`(`id`,`username`,`password`,`nombres`,`tipo_doc`,`num_doc`,`typeUser`,`email`,`estado`) VALUES ( '32', '1022412942', '827ccb0eea8a706c4c34a16891f84e7b', 'BRAYAN GONZALEZ', NULL, '', NULL, 'brayangmega@gmail.com', '1' );
INSERT INTO `User`(`id`,`username`,`password`,`nombres`,`tipo_doc`,`num_doc`,`typeUser`,`email`,`estado`) VALUES ( '33', '79632804', 'f2cb3e71a6465e8602da937dcb4492f3', 'carlos carrasquilla', NULL, '', NULL, 'jklidcarrasquilla@hotmail.com', '1' );
INSERT INTO `User`(`id`,`username`,`password`,`nombres`,`tipo_doc`,`num_doc`,`typeUser`,`email`,`estado`) VALUES ( '34', '1024582122', '0db503720590329fbd48507324c03f69', 'daniel tellez', NULL, '', NULL, 'tellezdaniel@misena.edu.co', '1' );
-- ---------------------------------------------------------


-- Dump data of "averias" ----------------------------------
-- ---------------------------------------------------------


-- Dump data of "clientes" ---------------------------------
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '4', 'BARRIO KENNEDY PAÑALERA (NANCY CAMARGO)', 'CRA 73 # 38 C 19SUR', '', '3005683345', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '5', 'BOSA ALAMEDA (GLORIA)', 'CLL 74 # 83 A 45 ', '', '3209366406', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '6', 'BOSA ASUSENA', 'CLL 65 C BIS # 77-5 14 ', '', '3223943824', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '7', 'BOSA BRASILIA', 'CLL 51 # 87K -15 SUR', '3551732', '3209881117-3214511162', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '8', 'BOSA LLANITO', 'CR 78 B # 69 B 33', '', '4797989', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '9', 'BOSA NUEVA GRANADA CARPA', 'CLL 70 B SUR # 78 A 30', '7772128', '3103198895-3192748782', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '10', 'BOSA NUEVA GRANADA MILLER', 'CR.78 C Nº 70 B 10', '', '7776708', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '11', 'BOSA OLANDA', 'CR 87 J # 57 SUR 6-11 ', '', '3202364791', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '12', 'BOSA PABLO VI FRENTE HOSPITAL', 'CR 77 CON CLL 70 A SUR ', '', '3132949048', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '13', 'BOSA RECREO CANCHAS', 'CLL 72 SUR # 104-41 BLOQUE 3 CANCHAS', '', '3108557634', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '14', 'BOSA VILLA DE LA LOMA(FLOR MURCIA', 'CR 82 A # 42 H SUR 24', '', '3143085339', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '15', 'BRASA Y SABOR(MARIA MARTINEZ)', 'CR 7 # 20-02', '', '3214657280', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '16', 'CAREFOUR ARENERA(ANA LUCIA BORDES)', 'CR 43 A # 59 A 08 ', '', '3125415410', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '17', 'CAREFOUR DEISY MARTINEZ', 'CRA 28 # 63 A 50 SUR ', '', '3133090876', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '18', 'CASTILLA(RICHARD)', 'CR 78 # 8 B 34', '', '3218583678', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '19', 'CATALINA 2', 'CLL 42 # 86 F 14 SUR BARRIO CUIDAD CALI- CAREFOUR TINTALITO', '4540051', '3123428367', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '20', 'CHUNIZA', 'CLL 54 SUR 77 T 49 CERCA AL SOCORRO', '2000990', '3214144758', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '21', 'CLAS ROMA NUEVO DROGUERIA', 'CR 81 J # 57-17 SUR VEGA DE SANTAANA', '7964420', '3133393462', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '22', 'COMPARTIR MARGARITA(AMPARO)', 'CR 17 # 28-28 SUR', '', '7235939', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '23', 'DIANA CULTIVOS(YESID)', 'DIG. 57 Nº 81 J 19', '', '3105811893', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '24', 'DIANA TURBAY CASA VERDE HERMANA', 'CLL 45 A SUR Nº 89 B 45', '', '3123423453', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '25', 'ESCUELA PANAMERICANA ', 'CR.11 A Nº 49 D  60 SUR', '', '7262414', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '26', 'HOGAR DEL SOL', 'CR 17 A #53-12"SAN CARLOS"', '', '3168283984', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '27', 'JOSE ISIDRO RIAÑO', 'TRANS 31 - 24 ', '', '3202706167', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '28', 'KENNEDY BRITALIA (EDWIN LIZARAZO)', 'PATIO BONITO', '', '3214222076', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '29', 'KENNEDY LUCERNA CARIMAGUA(NANCY CAMARGO)', 'CLL 41 D SUR # 78 P 16', '', '3005683345', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '30', 'LA ESTANCIA', 'CLL. 54 Nº 81 A 15', '', '3118453161', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '31', 'LA ESTANCIA ( LUIS JAIME)', 'CLL 38 A # 72 M 07 ESQUINERO PANADERIA ', '', '3134909517', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '32', 'LEON XIII BEATRIZ', 'CLL 47 #10-31', '', '3142142735', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '33', 'LEON XIII COLISEO(MARIA)', 'CLL 60 A # 75 B 16 SUR ', '', '3212898548-3147373232', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '34', 'LEON XIII COMANDO(SOACHA)	', 'CR 7 # 21-18 FRENTE CORATIENDAS	', '', '3223381676', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '35', 'LEON XIII DIEGO', 'CLL 43 # 9-15', '', '3128810520', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '36', 'LUIS FERNANDO LOPEZ', 'CR 8#40-38 NUEVA Y SOACHA CR 7#21-18', '', '3142722612', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '37', 'MADEIRO(MIGUEL ANGEL)', 'DIAG 49 SUR # 85-17', '', '3175041532 ', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '38', 'MANZANARES SOACHA (CECILIA)', 'DIAG 49 SUR Nº 85-17', '', '3213232592', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '39', 'MARCOS ATALAYAS', 'CLL 72 # 18 N 15', '', '3124188740-', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '40', 'MONTEBLANCO (LUCY)', 'CR 86 D # 40 C 34 VILLA HERMOSA', '', '3133906433', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '41', 'MONTEBLANCO NUEVO', 'CLL.49 A BIS SUR Nº 5 N 74', '', '7613903', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '42', 'NUEVA GRANADA(JAVIER)', 'CLL 96 A SUR # 14 B 30', '', '3134548209', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '43', 'NUTIVARA GERMAN', 'CLL 70 B SUR #78 A 30', '', '7618336', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '44', 'OLIVOS(PEDRO)', 'CR 77 J # 70 A 03', '', '3144729146-3134640008', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '45', 'PATIO BONITO LLANO GRANDE', 'CLL 70 L BIS SUR # 18 N  28', '', '3134227284', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '46', 'PATIO BONITO UNIR 1', 'diag 41 d # 16 a 14 barrio olivos 4 sector cra 9 bis # 4-14 centro salud olivos ', '', '3123695819', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '47', 'PATIO BONITO', 'CR 88 D # 41-24 SUR ', '', '3202706167', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '48', 'PATIO BONITO ASADERO', 'CLL 38 SUR # 87 D 19', '', '3132487721', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '49', 'PINAR DEL RIO(YURANY VARGAS)', 'CLL 38 D # 82-33 SUR', '', '3102700827', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '50', 'PIQUETEADERO SAN MATEO', 'CLL 32 SUR # 91-16 ', '', '7292591', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '51', 'POLIDEPORTIVO KENNEDY', 'CLL 40 BIS SUR # 83-32 PISO 1', '', '4547229', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '52', 'QUINTA ANA ESTUPIÑAN', 'AV 30 # 8 A 20', '', '3133314333', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '53', 'QUINTAS ALTAVISTA PORTAL 3 (LUZ MERY GUEVARA)', 'CLL 2 SUR # 49-05', '', '3132582585', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '54', 'QUINTAS LAGUNA SOACHA', 'CR 1 ESTE # 67 A 66 SUR', '', '3125263699', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '55', 'RECREO RESERVADO 3	', 'CLL 65 SUR # 102-40 CASA 130	', '', '3102948795', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '56', 'RIVERA TIERRA BUENA', 'CLL 33 BIS # 93-28', '', '3108010446', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '57', 'RUTH MORA GARZON', 'CLL 65 SUR # 102-40 CASA 130 ', '', '3102948795', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '58', 'SABOR DEL CARBON (CARLOS)', 'CLL 33 BIS # 93-28', '', '4545383', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '59', 'SANTA LIBRADA 2 CUADRAS DE LA BOMBA (EDWIN CLAVIJO)', 'CLL 51 SUR # 18 A 37 CERCA A LA PLAZA ', '', '3193507742', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '60', 'SANTA LIBRADA ALMACEN', 'CLL 66 BIS # 18 Q 89', '', '3193507742', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '61', 'SANTA LIBRADA ALONSO', 'CLL 75 SUR # 1 A 91 ESTE ', '', '3142181814', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '62', 'SANTA LIBRADA BOMBA', 'EN LA ESQUINA BOMBA', '', '3193507742', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '63', 'SANTA LIBRADA BOMBA ARRIBA DE LA AURORA', 'DIAG 71 F # 1-29 SUR ', '', '7621580', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '64', 'SIMEON', 'CLL 64 C # 1-41 ESTE ', '', '3213731167', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '65', 'SOACHA CENTRO', 'CLL 14 # 18 R 18- PRADO VEGA', '', '5759344', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '66', 'SOACHA CENTRO PRADO VEGA ', 'CLL 60 SUR 97 B 18 BOSA ATALAYAS', '', '5759344', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '67', 'SOACHA COMPARTIR (JENNY)', 'CLL 16 A SUR # 10 B 05', '', '3208568884 ', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '68', 'SOACHA LA AMISTAD(ANTONIO)', 'CLL 14 # 18 R 18', '', '3195090731', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '69', 'SOACHA LAGUNA NUEVA', 'CLL 16 A SUR # 10 B 05 ', '', '7324579', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '70', 'SOACHA QUINTAS PANADERIA', 'CLL 26 # 12-17 AL LADO DEL YUMBO', '', '3046615923', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '71', 'SOACHA SAN CARLOS(DORIS PEREZ)', 'CLL 1 # 4 J 84 BARRIO SAN ANDRES', '', '7819673', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '72', 'TIERRA BUENA (RODOLFO CASTEBLANCO)', 'CR. 5 ESTE Nº 13-33', '', '3122174589', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '73', 'TINTAL 143 HERNANDO', 'CLL 6 A #94 A 26 CIUDAD TINTAL', '', '4775854', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '74', 'TINTAL 6 CASA 465', 'CLL 26 SUR Nº 95 A 49', '', '3013700', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '75', 'TINTAL RUBI', 'CLL 6 A # 89-47 TINTALA BASE 6', '', '3132964384', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '76', 'TRIBUNA CALIENTE KENEDY (ANDREA)', 'CLL 6 A Nº 89-47', '', '3213329263-3142829922', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '77', 'TUNJUELITO(CESAR MILLAN)', 'CLL 6 A Nº 89-47 PIZERIA', '', '3103435093', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '78', 'ULISES ', 'CLL 61 SUR # 97 D 20', '', '4807630', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '79', 'VILLA SALSIA (JOSE)', 'CR 10 # 53 A 24 SUR ', '', '3134453433', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '80', 'VILLAS DE KENEDY CIRCO (LUIS DAVID ARANDA)', 'CLL 60 SUR 97 B  20 BOSA ATALAYAS', '', '3124170824', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '81', 'VISION COLOMBIA', 'CR 72 A #11 A 15', '', '3134521623-3105186482', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '82', '07-ago(JAIR PEÑALOZA)', 'CR 24 # 65-59', '', '3202016596', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '83', '07-ago(DISCARPOL)', 'CLL 66 # 23-12', '', '2111610', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '84', 'ALTAMIRA BARBARA ', 'CR 12 A # 42-85', '', '3116098298', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '85', 'ALTAMIRA FAMA (ANGEL)', 'CLL 46 SUR # 11 A 36 SALSAMENTARIA ', '', '3112003803', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '86', 'AV CRA 50', 'AV CRA 50 # 17 -13 SUR ROMBOY 1 MAYO', '', '3132503581', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '87', 'BARRIO ALQUERIA (JHON MARQUEZ)', 'CLL 37 SUR # 54-25 ', '7024150', '3144237061', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '88', 'BARRIO CARVAJAL', 'CLL 38 #72 M 07 SUR  CERCA AL TIMIZA ', '', '2652825', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '89', 'CARCEL MODELO PUENTE ARANDA', 'CR 58 # 17-49', '', '3206673034', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '90', 'CHAPINERO (VERSEL VELASCO)', 'CLL 52# 15-98', '', '3123119021', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '91', 'CHORRO DE QUEVEDO (CANDELARIA) ALFREDO ORTIZ', 'ANTES DEL CALLEJON DEL EMBUDO INTERIOR 5', '', '3107626814', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '92', 'CIUDAD MONTES', 'CLL 8 SUR # 38 A 35', '', '3203433306', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '93', 'CIUDAD MONTES ( LATINOS) OSCAR DAVID', 'CALLE 8 SUR # 35 A 35 ', '', '3203433306', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '94', 'DON PEPE (ANTONIO)', 'CR 13 #45 A 11', '', '3157984369', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '95', 'EL CLARET (EDILMA MORENO)', 'dg 43 a #  29-11', '7111100', '3133862930', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '96', 'GUSTAVO RESTREPO CAI (ADIELA)', 'CLL31A #13 A 41 SUR', '', '3104782135', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '97', 'JAVERIANA LA 8', 'CR 8 # 41-39 FRENTE A LA 8 TERRAZA STEIK HOUSE', '', '3176989985', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '98', 'LA ESTRADA', 'CR 69 I # 66-88 ', '', '3122732437', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '99', 'LA ESTRADA-COLEGIO CAFAM (OTILIA)', 'CR 68 G Nº 64 D 36', '', '2400737', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '100', 'PLAZA DE LAS NIEVES', 'CR 20 # 8-73 INTERIOR 51', '', '3132875574', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '101', 'POLICARPA (GRACIELA CARO)', 'CR 11 # 4 -36 ', '', '3214300334', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '102', 'RESTAURANTE EL MIO', 'CLL 25 C # 36-39  (CLINICA FUNDADORES)', '', '2441984', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '103', 'RESTAURANTE OCCIDENTE ', 'AV AMERICAS  # 71 B 46', '', '4202617', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '104', 'RICAURTE (ANGELICA)', 'CR 1 # 21-00 ', '', '3146818354', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '105', 'RICAURTE BILLAR (OSCAR)', 'CR 28 #9-18', '', '3114899269', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '106', 'SAN ANDRESITO (PAOLA ARENA)', 'CRA 20 CALLE 14 # 20-05', '', '3193562951', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '107', 'SAN JORGE CENTRAL (MARCELA)', 'AV 1 MAYO Nº 34-17 SUR ', '', '3185272734', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '108', 'TEUSAQUILLO ', 'DIAG 40 # 15-20', '', 'DIAG 40 # 15-20', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '109', 'TEUSAQUILLO DESAYUNADERO', 'CR 13 # 34-27 ALIANZA', '2321705', '3108561994', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '110', 'CORUÑA (MARY)', 'KR 48 G 59-42 SUR', '', '3112717712', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '111', 'ALQUERIA (OSCAR)', 'cra 54 # 37 a 18 alqueria', '', '3138636973', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '112', 'BOSA TROPEZON', 'CRA 87 C # 61 A 07 LOCAL MR OSCAR POR LA PRINCIPAL', '', '3204208884', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '113', 'CHORIZO SANTA ROSANO', 'CLL 70 # 69P16', '', '2310389', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '114', 'FONTIBON', 'MARINO- CERCA AL RIO BOGOTA - PUENTE GRANDE', '', '3213648508', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '115', 'GUATEQUE -BOYACA (CAMILO ROMERO C.C 74,283,084)', 'FLOTA MACARENA', '', '3112039531', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '116', 'LOS CEREZOS (MARLEN URIBE)', 'CLL 89 # 87-27', '', '2523525', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '117', 'MODELIA', 'cll 25 f 84 b 84', '', '3203893902', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '118', 'SANTA CECILIA MODELIA (YURLEY HERNANDEZ)', 'CR 25 F # 84 B 84', '', '3203893902', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '119', 'SANTA MARTA (DIANA)', 'AV LIBERTADOR', '', '3138371984', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '120', 'SIBATE ALICIA (CH)', 'transv 13 # 10 b 19 barrio san martin cerca parabolica', '', '3142466277', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '121', 'SUBA CENTRO- PAPA A LA LATA', 'CALLE 146 C #92-23', '', '3192087647', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '122', 'TOTOPOS (JHON ZUÑIGA)', 'CLL 70 F 106 A 11 casa cll 71 a 3 16 a 21', '4352600', '3142941425', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '123', 'VIVIANA RUBIANO', 'DIAG 52 # 54-22 SUR VENECIA', '', '7133708-4208501', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '124', 'MONTEBLANCO MARTA ', 'CR 14 J # 94-50', '', '3143678443', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '125', 'BOSA (MANZANARES)', 'CR 78 D BIS # 73 H 14', '', '3112386800-3115550857', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '126', 'BOSA BETANIA CONJUNTO AMERICAS', 'CLL 49 SUR 87 A 51 INT3 APT 301 ', '', '3144710059', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '127', 'BOSA CARBONEL LA CARPA', 'TRANSV 77 R BIS #71 B 54 SUR', '', '3144359922', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '128', 'BOSA LA PAZ', 'CLL 62 SUR 83 A 04', '', '3144359922', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '129', 'BOSA LAURELES', 'CRA 80 M #75 SUR 32 ', '4595834', '3107742929', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '130', 'BOSA MARIPAN', 'CLL 40 D SUR # 87-39', '', '3147978295', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '131', 'BOSA NARANJO', 'CRA 80 # 70 C SUR 28', '', '3144065673', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '132', 'BOSA NUEVA GRANADA JAVIER SOSA', 'CLL 70 BIS SUR # 78-03', '7772128', '3123945045', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '133', 'BOSA PABLO VI', 'CLL 77 J # 70 A SUR CERCA HOSPITAL', '', '3123235727', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '134', 'BRITALIA NUEVO', 'CR 81 H #49-02', '', '3133182002', '' );
INSERT INTO `clientes`(`id`,`nombre`,`direccion`,`telefono`,`celular`,`email`) VALUES ( '135', 'CARNES EL BARCINO', 'CLL 40 # 90 D 15', '', '3157692139-ALBERTO', '' );
-- ---------------------------------------------------------


-- Dump data of "ctrl_producciones_trazabilidad" -----------
-- ---------------------------------------------------------


-- Dump data of "despachos" --------------------------------
-- ---------------------------------------------------------


-- Dump data of "detalle_averias" --------------------------
-- ---------------------------------------------------------


-- Dump data of "detalle_ctrl_producciones" ----------------
-- ---------------------------------------------------------


-- Dump data of "detalle_despacho" -------------------------
-- ---------------------------------------------------------


-- Dump data of "detalle_inventario_empaque_vacio" ---------
-- ---------------------------------------------------------


-- Dump data of "formulacion" ------------------------------
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '357', '61', '60', '0.30' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '358', '61', '28', '0.50' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '359', '61', '56', '0.20' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '360', '61', '8', '0.20' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '361', '61', '63', '0.08' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '362', '61', '51', '1.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '363', '61', '38', '4.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '365', '31', '60', '0.30' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '366', '31', '28', '0.50' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '367', '31', '56', '0.20' );
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
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '605', '49', '43', '3.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '606', '49', '8', '6.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '607', '49', '18', '5.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '608', '49', '5', '40.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '609', '49', '127', '5.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '611', '49', '122', '0.10' );
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
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '684', '64', '14', '50.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '685', '64', '4', '20.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '686', '64', '8', '10.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '687', '66', '2', '20.00' );
INSERT INTO `formulacion`(`id`,`producto_id`,`materia_prima`,`peso`) VALUES ( '688', '66', '8', '30.00' );
-- ---------------------------------------------------------


-- Dump data of "insumo" -----------------------------------
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '2', 'CEBOLLA MOLIDA', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '4', 'CARNE DE RES', '0', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '5', 'AGUA', '1', '5.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '7', 'ALMIDON DE TRIGO', '1', '34.50' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '8', 'ALMIDON DE PAPA', '1', '1193.50' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '13', 'BOLSAS AL VACIO', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '14', 'CARNE DE CERDO', '0', '903.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '15', 'CARNE DE GALLINA', '0', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '16', 'CARNE DE POLLO', '0', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '17', 'CARNE DE TERNERA', '0', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '18', 'CEBOLLA', '1', '3.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '19', 'CEBOLLA LARGA', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '20', 'CEBOLLA PUERRO', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '21', 'CERDO', '0', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '22', 'CILANTRO', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '23', 'COLAGENO', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '24', 'COLOR', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '25', 'COLOR NARANJA', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '26', 'CONCENTRADO', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '27', 'CONDIMENTO PAVO', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '28', 'CONDIMENTOS', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '29', 'CONSENTRADO', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '30', 'CUEROS', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '31', 'DESPALME', '0', '194.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '33', 'EMPAQUE', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '37', 'GLUTAMINASA', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '38', 'HIELO', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '39', 'HIERVAS', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '40', 'HUMO', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '42', 'MERMA', '0', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '43', 'MIGA BLANCA', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '44', 'MOTA', '0', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '45', 'PASTA', '0', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '46', 'PASTA DE POLLO', '0', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '47', 'PASTA DE RES', '0', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '48', 'PECHO', '0', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '49', 'PIMENTON', '1', '4.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '51', 'PLASMA LIQUIDO', '0', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '52', 'POLLO', '0', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '54', 'PROTECTA', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '55', 'PROTEINA AL 90', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '56', 'PROTEINA ARCON', '1', '30.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '57', 'RESPONSE', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '60', 'SAL NITRADA', '1', '32.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '63', 'STERMAX', '1', '0.20' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '64', 'SUPER SMOL', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '67', 'TRASGLUTAMINAZA', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '69', 'TRIPA NATURAL DE CERDO', '1', '9.70' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '70', 'UNIDADES', '0', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '71', 'UTILIDAD', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '72', 'UTILIDAD UNIDAD', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '73', 'VITACEL', '1', '27.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '74', 'RECORTE DE RES', '0', '615.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '75', 'GRASA DE RES', '0', '293.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '76', 'CABEZA DE LOMO', '0', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '77', 'CUERO DE CERDO', '0', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '78', 'CARNE INDUSTRIAL', '0', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '81', 'PROTEINA', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '82', 'RES', '0', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '83', 'RECICLE', '0', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '84', 'grasa de cerdo', '0', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '85', 'promul', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '86', 'granulos', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '87', 'COSTILLA', '0', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '88', 'bolsas', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '89', 'PROTEINA AL 70', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '90', 'COND. LONGANIZA', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '91', 'COND. TOCINETA', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '92', 'COND. MANGUERA', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '93', 'CARNAL', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '95', 'COND. CERDO AHUMADO', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '96', 'COND. MEGA', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '98', 'COND. CHORIZO POLLO', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '99', 'COND. PERNIL CERDO', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '101', 'COND. MORTADELA', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '102', 'COND. JAMÓN', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '103', 'CARRAGEL', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '104', 'COND. PUERRO', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '107', 'COND. SALCHICHA AMERICANA', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '109', 'COND. HAMBURG. POLLO', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '110', 'COND. CAHUMADO', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '111', 'COND. RH', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '112', 'MADEJA DE CERDO', '1', '36.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '113', 'CORIA 18*20', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '114', 'HILO GRUESO', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '115', 'EMPAQUE JAMON', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '116', 'EMPAQUE SALCHICHON', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '117', 'DEBRO 30', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '118', 'PROTEINA DE SOYA', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '119', 'FIBRA DE COLAGENO', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '120', 'TEXTURIZADO DE SOYA', '1', '3.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '121', 'HARINA DE TRIGO', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '122', 'SMOKE OIL', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '123', 'NATURSOL', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '124', 'CONDIMENTO MIXTO PRECOCIDO', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '125', 'FOSFATO', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '126', 'CONDIMENTO SALCHICHA MANGUERA', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '127', 'COND. HAMBURGUESA RES', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '128', 'PUERRO', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '129', 'CONDIMENTO CHORIZO CRIOLLO', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '130', 'CONDIMENTO CHORIZO TERNERA', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '131', 'CONDIMENTO CHORIZO COCTEL CERDO', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '132', 'CONDIMENTO SALCHICHÓN', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '133', 'CONDIMENTO SALCHICHA HOT DOG', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '134', 'CODIMENTO CHORIZO PICANTE', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '135', 'CONDIMENTO SALCHICHA RANCHERA', '1', '0.00' );
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
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '171', 'EMPAQUE AMERICANA 26/28', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '172', 'BOLSA JAMON', '2', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '175', 'CORIA 19/50', '2', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '176', 'CORIA 26/50', '2', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '177', 'EMPAQUE MANGUERA', '2', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '179', 'FALDA RES', '0', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '181', 'CONDIMENTO MEGACUNCIA', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '182', 'MEXICANO', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '183', 'COND. HAMBURGUESA DE POLLO', '1', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '184', 'RECORTE  DE RES 80/10', '0', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '185', 'CERDO-MURILLO', '0', '0.00' );
INSERT INTO `insumo`(`id`,`materia_prima`,`tipo`,`cantidad`) VALUES ( '186', 'rabos de cebolla', '1', '0.00' );
-- ---------------------------------------------------------


-- Dump data of "inventario_empaque_vacio" -----------------
-- ---------------------------------------------------------


-- Dump data of "municipio" --------------------------------
-- ---------------------------------------------------------


-- Dump data of "personal" ---------------------------------
INSERT INTO `personal`(`id`,`nombres`,`cedula`,`correo`,`user_id`) VALUES ( '5', 'juan', '1234', 'j@as.com', '22' );
INSERT INTO `personal`(`id`,`nombres`,`cedula`,`correo`,`user_id`) VALUES ( '6', 'juanc', '12222', 'asfq12@asf.com', '31' );
INSERT INTO `personal`(`id`,`nombres`,`cedula`,`correo`,`user_id`) VALUES ( '7', 'BRAYAN GONZALEZ', '1022412942', 'brayangmega@gmail.com', '32' );
INSERT INTO `personal`(`id`,`nombres`,`cedula`,`correo`,`user_id`) VALUES ( '8', 'carlos carrasquilla', '79632804', 'jklidcarrasquilla@hotmail.com', '33' );
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
INSERT INTO `producto`(`id`,`nombre`,`cantidad`) VALUES ( '63', 'santa rosano x 10', '0' );
INSERT INTO `producto`(`id`,`nombre`,`cantidad`) VALUES ( '64', 'megacuncia', '0' );
INSERT INTO `producto`(`id`,`nombre`,`cantidad`) VALUES ( '65', 'PIMENTON', '0' );
INSERT INTO `producto`(`id`,`nombre`,`cantidad`) VALUES ( '66', 'PAPAS FRITAS', '0' );
-- ---------------------------------------------------------


-- Dump data of "proveedor" --------------------------------
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`,`estado`) VALUES ( '2', 'ALIRIO CASALLAS', '0', '', '', '', '0', '', '', 'CS', '0', '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`,`estado`) VALUES ( '3', 'CANTABRIA', '0', '', '', '', '0', '', '', 'CT', '0', '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`,`estado`) VALUES ( '4', 'DANIEL PACHON', '0', NULL, NULL, NULL, '0', NULL, NULL, 'DP', '0', '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`,`estado`) VALUES ( '5', 'PORCINARNES', '0', NULL, NULL, NULL, '0', NULL, NULL, 'PC', '0', '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`,`estado`) VALUES ( '6', 'TORETOS', '0', NULL, NULL, NULL, '0', NULL, NULL, 'TR', '0', '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`,`estado`) VALUES ( '7', 'WILMER GORDILLO', '0', NULL, NULL, NULL, '0', NULL, NULL, 'WG', '0', '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`,`estado`) VALUES ( '9', 'CIALTA', '0', NULL, NULL, NULL, '0', NULL, NULL, 'CL', '0', '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`,`estado`) VALUES ( '10', 'ORLANDO MORENO', '0', NULL, NULL, NULL, '0', NULL, NULL, 'OM', '0', '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`,`estado`) VALUES ( '11', 'WILIAM RODRIGUEZ', '0', NULL, NULL, NULL, '0', NULL, NULL, 'WR', '0', '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`,`estado`) VALUES ( '12', 'MIILLER VARGAS', '0', NULL, NULL, NULL, '0', NULL, NULL, 'MV', '0', '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`,`estado`) VALUES ( '13', 'JORGE CASTIBLANCO', '0', NULL, NULL, NULL, '0', NULL, NULL, 'JC', '0', '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`,`estado`) VALUES ( '14', 'GENUINOS', '0', NULL, NULL, NULL, '0', NULL, NULL, 'GN', '0', '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`,`estado`) VALUES ( '15', 'CERCAFE', '0', NULL, NULL, NULL, '0', NULL, NULL, 'CR', '0', '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`,`estado`) VALUES ( '16', 'FREDY ACEVEDO', '0', NULL, NULL, NULL, '0', NULL, NULL, 'FA', '0', '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`,`estado`) VALUES ( '17', 'ABASTOS', '0', NULL, NULL, NULL, '0', NULL, NULL, 'CB', '0', '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`,`estado`) VALUES ( '19', 'HIELOS IGLU/ ARTICO', '0', NULL, NULL, NULL, '0', NULL, NULL, 'HI', '0', '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`,`estado`) VALUES ( '20', 'BUCANERO', '0', NULL, NULL, NULL, '0', NULL, NULL, 'BC', '0', '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`,`estado`) VALUES ( '21', 'EDWARD PATIÑO', '0', NULL, NULL, NULL, '0', NULL, NULL, 'EP', '0', '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`,`estado`) VALUES ( '22', 'SURTIVALE', '0', NULL, NULL, NULL, '0', NULL, NULL, 'SV', '0', '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`,`estado`) VALUES ( '23', 'EDGAR PEREZ', '0', NULL, NULL, NULL, '0', NULL, NULL, 'XP', '0', '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`,`estado`) VALUES ( '24', 'GRUPO AL', '0', NULL, NULL, NULL, '0', NULL, NULL, 'GA', '0', '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`,`estado`) VALUES ( '25', 'POLO JARA', '0', NULL, NULL, NULL, '0', NULL, NULL, 'PJ', '0', '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`,`estado`) VALUES ( '26', 'SANTA SOFIA', '0', NULL, NULL, NULL, '0', NULL, NULL, 'SF', '0', '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`,`estado`) VALUES ( '27', 'MARK POLLO', '0', NULL, NULL, NULL, '0', NULL, NULL, 'MK', '0', '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`,`estado`) VALUES ( '28', 'INDUSTRIAS ESPINOSA', '0', NULL, NULL, NULL, '0', NULL, NULL, 'IE', '0', '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`,`estado`) VALUES ( '29', 'PLASMALIQ', '0', NULL, NULL, NULL, '0', NULL, NULL, 'PL', '0', '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`,`estado`) VALUES ( '30', 'JORGE CASTIBLANCO', '0', NULL, NULL, NULL, '0', NULL, NULL, 'JC', '0', '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`,`estado`) VALUES ( '31', 'TECNAS', '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, '1', '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`,`estado`) VALUES ( '32', 'ALICO', '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, '1', '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`,`estado`) VALUES ( '33', 'CI TALSA', '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, '1', '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`,`estado`) VALUES ( '34', 'DELTAGEN', '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, '1', '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`,`estado`) VALUES ( '35', 'TECNO FOOD', '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, '1', '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`,`estado`) VALUES ( '36', 'GLORIA JIMENEZ', '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, '1', '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`,`estado`) VALUES ( '37', 'A&R EXPORT', '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, '1', '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`,`estado`) VALUES ( '38', 'CONDITA', '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, '1', '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`,`estado`) VALUES ( '39', 'AGRO LECHERO', '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, '1', '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`,`estado`) VALUES ( '40', 'CIMPA', '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, '1', '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`,`estado`) VALUES ( '41', 'QUIMICA AROMATICA', '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, '1', '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`,`estado`) VALUES ( '42', 'SURTI QUIMICOS', '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, '1', '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`,`estado`) VALUES ( '43', 'SOLUCIONES ALIMENTARIAS', '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, '1', '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`,`estado`) VALUES ( '44', 'CALIER DE COLOMBIA', '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, '1', '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`,`estado`) VALUES ( '45', 'CONDIMPORTADOS', '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, '1', '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`,`estado`) VALUES ( '46', 'GYC', '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, '1', '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`,`estado`) VALUES ( '47', 'ELIZABETH NUÑEZ', '0', '', '', '', '0', '', '', 'EN', '0', '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`,`estado`) VALUES ( '48', 'JUAN DIEGO', '0', NULL, NULL, NULL, '0', NULL, NULL, 'JD', '0', '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`,`estado`) VALUES ( '49', 'FENTEX', '0', NULL, NULL, NULL, '0', NULL, NULL, 'FX', '0', '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`,`estado`) VALUES ( '50', 'LA FAZENDA', '0', NULL, NULL, NULL, '0', NULL, NULL, 'FZ', '0', '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`,`estado`) VALUES ( '51', 'LUCY POLLO', '0', NULL, NULL, NULL, '0', NULL, NULL, 'LY', '0', '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`,`estado`) VALUES ( '52', 'JUAN CARLOS GONZALEZ', '0', NULL, NULL, NULL, '0', NULL, NULL, 'JK', '0', '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`,`estado`) VALUES ( '53', 'GUADALUPE', '0', NULL, NULL, NULL, '0', NULL, NULL, 'GD', '0', '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`,`estado`) VALUES ( '54', 'DON POLO', '0', NULL, NULL, NULL, '0', NULL, NULL, 'PJ', '0', '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`,`estado`) VALUES ( '55', 'HIELOS DEL SUR', '0', NULL, NULL, NULL, '0', NULL, NULL, 'HL', '0', '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`,`estado`) VALUES ( '56', 'ANDRES MARTINEZ', '0', NULL, NULL, NULL, '0', NULL, NULL, 'AM', '0', '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`,`estado`) VALUES ( '57', 'LA PREMIUM', '0', NULL, NULL, NULL, '0', NULL, NULL, 'LP', '0', '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`,`estado`) VALUES ( '58', 'CENTRO AGROLECHERO', '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, '1', '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`,`estado`) VALUES ( '59', 'LA NIEVE', '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, '1', '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`,`estado`) VALUES ( '62', 'PLASTICOS GYC', '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, '1', '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`,`estado`) VALUES ( '63', 'TAUSSING', '0', NULL, NULL, NULL, '0', NULL, NULL, NULL, '1', '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`,`estado`) VALUES ( '64', 'FREDY MORENO', '0', NULL, NULL, NULL, '0', NULL, NULL, 'FM', '0', '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`,`estado`) VALUES ( '65', 'MEGA', '0', '', '', '', '0', '', '', 'MEG', '0', '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`,`estado`) VALUES ( '70', ' MAGROS CARNES', '0', NULL, NULL, NULL, '0', NULL, NULL, 'MC', '0', '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`,`estado`) VALUES ( '71', 'BONANZA ', '0', NULL, NULL, NULL, '', NULL, NULL, 'BN', '0', '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`,`estado`) VALUES ( '72', 'mercantil continental', '0', '', '', '', '0', '', '', '', '1', '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`,`estado`) VALUES ( '73', 'CORABASTOS', '0', '', '', '', '0', '', '', '', '1', '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`,`estado`) VALUES ( '74', 'CELO', '0', '', '', '', '0', '', '', 'CC', '0', '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`,`estado`) VALUES ( '75', 'OWALVO GUARIN', '0', '', '', '', '0', '', '', 'OG', '0', '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`,`estado`) VALUES ( '76', 'CARLOS FORERO', '0', '', '', '', '0', '', '', 'CF', '0', '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`,`estado`) VALUES ( '77', 'RAPIPAPA', '0', '', '', '', '0', '', '', '', '1', '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`,`estado`) VALUES ( '78', 'MEGAS', '0', '', '', '', '0', '', '', '', '1', '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`,`estado`) VALUES ( '79', 'PERLA DEL OTUM', '0', '', '', '', '0', '', '', 'PO', '1', '1' );
INSERT INTO `proveedor`(`id`,`nom_proveedor`,`tipo_proveedor`,`correo`,`celular`,`direccion`,`tipo_doc`,`cedula`,`municipio_id`,`codigo_base`,`tipo`,`estado`) VALUES ( '80', 'COMESTIBLES RICOS SAS', '0', '', '', '', '0', '', '', 'CR', '1', '1' );
-- ---------------------------------------------------------


-- Dump data of "proveedor_insumo" -------------------------
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '149', '14', '7', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '159', '46', '52', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '162', '1', '47', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '168', '78', '11', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '175', '31', '50', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '181', '75', '4', '16.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '229', '75', '50', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '230', '14', '47', '903.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '231', '74', '7', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '232', '1', '7', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '233', '74', '23', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '234', '1', '23', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '235', '74', '4', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '236', '1', '4', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '238', '1', '11', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '239', '76', '3', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '240', '1', '3', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '241', '14', '10', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '242', '1', '10', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '243', '1', '50', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '244', '185', '47', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '245', '21', '74', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '246', '1', '74', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '247', '21', '26', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '248', '1', '26', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '249', '21', '75', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '250', '1', '75', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '251', '21', '64', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '252', '1', '64', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '253', '31', '7', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '254', '31', '47', '119.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '255', '31', '76', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '256', '1', '76', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '257', '31', '9', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '258', '1', '9', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '259', '75', '7', '235.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '260', '75', '23', '42.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '261', '73', '38', '13.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '262', '56', '44', '30.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '263', '120', '40', '3.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '264', '43', '31', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '265', '8', '77', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '266', '18', '73', '3.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '268', '5', '78', '5.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '269', '127', '45', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '270', '122', '72', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '271', '60', '45', '32.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '272', '54', '39', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '273', '49', '73', '4.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '274', '78', '7', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '275', '186', '73', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '276', '51', '29', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '278', '112', '45', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '279', '112', '79', '36.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '280', '95', '45', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '281', '69', '79', '9.70' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '282', '40', '72', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '283', '28', '45', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '284', '7', '35', '34.50' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '285', '8', '35', '0.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '286', '63', '58', '0.20' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '288', '73', '39', '14.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '289', '74', '28', '245.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '290', '31', '10', '75.00' );
INSERT INTO `proveedor_insumo`(`id`,`insumo_id`,`proveedor_id`,`cantidad`) VALUES ( '291', '8', '80', '1193.50' );
-- ---------------------------------------------------------


-- Dump data of "recepcion_materia_prima_carnica" ----------
-- ---------------------------------------------------------


-- Dump data of "recepcion_materia_prima_no_carnica" -------
-- ---------------------------------------------------------


-- Dump data of "rel_reporte_despachos_producto" -----------
-- ---------------------------------------------------------


-- Dump data of "reporte_control_horneado" -----------------
-- ---------------------------------------------------------


-- Dump data of "reporte_despachos" ------------------------
-- ---------------------------------------------------------


-- Dump data of "reporte_empaque_vacio" --------------------
-- ---------------------------------------------------------


-- Dump data of "vs_database_diagrams" ---------------------
-- ---------------------------------------------------------


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
-- ---------------------------------------------------------


