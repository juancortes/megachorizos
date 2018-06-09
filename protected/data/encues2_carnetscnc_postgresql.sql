--
-- Generated from mysql2pgsql.perl
-- http://gborg.postgresql.org/project/mysql2psql/
-- (c) 2001 - 2007 Jose M. Duarte, Joseph Speigle
--

-- warnings are printed for drop tables if they do not exist
-- please see http://archives.postgresql.org/pgsql-novice/2004-10/msg00158.php

-- ##############################################################
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
-- MySQL dump 10.13  Distrib 5.5.37, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: encues2_carnetscnc
-- ------------------------------------------------------
-- Server version	5.5.37-0ubuntu0.14.04.1


--
-- Table structure for table AuthAssignment
--

CREATE TABLE  "authassignment" (
   "itemname"   varchar(64) NOT NULL, 
   "userid"   varchar(64) NOT NULL, 
   "bizrule"   text, 
   "data"   text, 
   primary key ("itemname", "userid")
)  ;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
ALTER TABLE "authassignment" ADD FOREIGN KEY ("itemname") REFERENCES "authitem" ("name");

--
-- Table structure for table AuthItem
--

CREATE TABLE  "authitem" (
   "name"   varchar(64) NOT NULL, 
   "type"   int NOT NULL, 
   "description"   text, 
   "bizrule"   text, 
   "data"   text, 
   primary key ("name")
)  ;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;

--
-- Table structure for table AuthItemChild
--

CREATE TABLE  "authitemchild" (
   "parent"   varchar(64) NOT NULL, 
   "child"   varchar(64) NOT NULL, 
   primary key ("parent", "child")
)  ;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE INDEX "authitemchild_child_idx" ON "authitemchild" USING btree ("child");
ALTER TABLE "authitemchild" ADD FOREIGN KEY ("parent") REFERENCES "authitem" ("name");
ALTER TABLE "authitemchild" ADD FOREIGN KEY ("child") REFERENCES "authitem" ("name");

--
-- Table structure for table User
--

DROP SEQUENCE "user_id_seq" CASCADE ;

CREATE SEQUENCE "user_id_seq"  START WITH 5 ;

CREATE TABLE  "user" (
   "id" integer DEFAULT nextval('"user_id_seq"') NOT NULL,
   "username"   varchar(45) DEFAULT NULL, 
   "password"   varchar(254) DEFAULT NULL, 
   "nombre"   varchar(500) DEFAULT NULL, 
   primary key ("id")
)   ;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;

--
-- Table structure for table persona
--

DROP SEQUENCE "persona_id_seq" CASCADE ;

CREATE SEQUENCE "persona_id_seq"  START WITH 56 ;

CREATE TABLE  "persona" (
   "id" integer DEFAULT nextval('"persona_id_seq"') NOT NULL,
   "nombres"   varchar(100) NOT NULL, 
   "apellidos"   varchar(100) NOT NULL, 
   "cedula"   bigint NOT NULL, 
   "tipo_persona"   int NOT NULL DEFAULT '1' , 
   "f_validez_inicial"   date DEFAULT NULL , 
   "f_caducidad"   date DEFAULT NULL , 
   "foto"   varchar(100) DEFAULT NULL , 
   "ciudad_encuesta"   varchar(100) NOT NULL, 
   "dir_domicilio"   varchar(100) NOT NULL, 
   "ciudad_domicilio"   varchar(100) DEFAULT NULL, 
   "fec_nacimiento"   date NOT NULL, 
   "lugar_nacimiento"   varchar(100) NOT NULL, 
 "genero" varchar CHECK ("genero" IN ( 'M','F' )) NOT NULL,
   "telefono"   varchar(25) DEFAULT NULL, 
   "celular"   varchar(25) DEFAULT NULL, 
   "ocupacion"   varchar(150) NOT NULL, 
   "estado_civil"   char(2) NOT NULL, 
 "tiene_experiencia_encuestador" varchar CHECK ("tiene_experiencia_encuestador" IN ( 'S','N' )) NOT NULL,
   "tiempo_experiencia_encuestador"   varchar(50) DEFAULT NULL, 
   "bachiller_titulo"   varchar(180) DEFAULT NULL, 
 "bachiller_estado" varchar CHECK ("bachiller_estado" IN ( 'C','N' )) NOT NULL,
   "bachiller_grado"   varchar(255) DEFAULT NULL, 
   "tecnico_titulo"   varchar(150) DEFAULT NULL, 
 "tecnico_estado" varchar CHECK ("tecnico_estado" IN ( 'C','N' )) NOT NULL ,
   "tecnico_grado"   varchar(150) DEFAULT NULL, 
   "profesional_titulo"   varchar(150) DEFAULT NULL, 
 "profesional_estado" varchar CHECK ("profesional_estado" IN ( 'C','N' )) NOT NULL,
   "profesional_grado"   varchar(150) DEFAULT NULL, 
   "postgrados_titulo"   varchar(150) DEFAULT NULL, 
 "postgrados_estado" varchar CHECK ("postgrados_estado" IN ( 'C','N' )) NOT NULL,
   "postgrados_grado"   varchar(150) DEFAULT NULL, 
 "actualmente_estudia" varchar CHECK ("actualmente_estudia" IN ( 'S','N' )) NOT NULL,
   "horario_estudio"   timestamp NULL DEFAULT NULL, 
   "experiencia_empresa1"   varchar(255) DEFAULT NULL, 
   "cargo_empresa1"   varchar(255) DEFAULT NULL, 
   "telefono_empresa1"   varchar(255) DEFAULT NULL, 
   "ciudad_empresa1"   varchar(255) DEFAULT NULL, 
   "tipo_contrato_empresa1"   varchar(255) DEFAULT NULL, 
   "fec_ingreso_empresa1"   date DEFAULT NULL, 
   "fec_retiro_empresa1"   date DEFAULT NULL, 
   "tiempo_total_empresa1"   varchar(150) DEFAULT NULL, 
   "motivo_retiro_empresa1"   varchar(255) DEFAULT NULL, 
   "funciones_realizadas_empresa1"   varchar(255) DEFAULT NULL, 
   "nombre_empresa1"   varchar(150) DEFAULT NULL, 
   "nombre_empresa2"   varchar(150) DEFAULT NULL, 
   "cargo_empresa2"   varchar(150) DEFAULT NULL, 
   "telefono_empresa2"   varchar(150) DEFAULT NULL, 
   "ciudad_empresa2"   varchar(150) DEFAULT NULL, 
   "tipo_contrato_empresa2"   varchar(150) DEFAULT NULL, 
   "fec_ingreso_empresa2"   date DEFAULT NULL, 
   "fec_retiro_empresa2"   date DEFAULT NULL, 
   "tiempo_total_empresa2"   varchar(150) DEFAULT NULL, 
   "motivo_retiro_empresa2"   varchar(255) DEFAULT NULL, 
   "funciones_realizadas_empresa2"   varchar(255) DEFAULT NULL, 
   "nombre_empresa3"   varchar(150) DEFAULT NULL, 
   "cargo_empresa3"   varchar(150) DEFAULT NULL, 
   "telefono_empresa3"   varchar(150) DEFAULT NULL, 
   "ciudad_empresa3"   varchar(150) DEFAULT NULL, 
   "tipo_contrato_empresa3"   varchar(150) DEFAULT NULL, 
   "fec_ingreso_empresa3"   date DEFAULT NULL, 
   "fec_retiro_empresa3"   date DEFAULT NULL, 
   "tiempo_total_empresa3"   varchar(150) DEFAULT NULL, 
   "motivo_retiro_empresa3"   varchar(255) DEFAULT NULL, 
   "funciones_realizadas_empresa3"   varchar(255) DEFAULT NULL, 
   "fecha_trabajo_cnc"   date DEFAULT NULL, 
 "servicios_cnc" varchar CHECK ("servicios_cnc" IN ( 'S','N' )) NOT NULL ,
 "tipo_servicio_cnc" varchar CHECK ("tipo_servicio_cnc" IN ( 'T','C' )) DEFAULT NULL ,
   "nombre_coordinadora"   varchar(120) DEFAULT NULL, 
   "experiencia_tiempo"   varchar(255) DEFAULT NULL, 
   "bachiller_institucion"   varchar(255) DEFAULT NULL, 
   "tecnico_institucion"   varchar(255) DEFAULT NULL, 
   "tecnologo_institucion"   varchar(255) DEFAULT NULL, 
   "profecional_institucion"   varchar(255) DEFAULT NULL, 
   "postgrado_institucion"   varchar(255) DEFAULT NULL, 
 "tecnologo_estado" varchar CHECK ("tecnologo_estado" IN ( 'C','N' )) NOT NULL ,
   "tecnologo_grado"   varchar(120) NOT NULL , 
   "tecnologo_titulo"   varchar(120) NOT NULL , 
   primary key ("id")
)   ;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
COMMENT ON COLUMN "persona". "tipo_persona" IS '1:encuestador, 2:supervisor';
COMMENT ON COLUMN "persona". "f_validez_inicial" IS 'Válido desde';
COMMENT ON COLUMN "persona". "f_caducidad" IS 'Válido hasta';
COMMENT ON COLUMN "persona". "foto" IS 'Foto';
COMMENT ON COLUMN "persona". "tecnico_estado" IS 'C= culminado,\nN = No culminado';
COMMENT ON COLUMN "persona". "servicios_cnc" IS 'S= si presento servicios en la cnc,\nN= no presento servicios en la cnn';
COMMENT ON COLUMN "persona". "tipo_servicio_cnc" IS 'T=telefonico , C = Campo';
COMMENT ON COLUMN "persona". "tecnologo_estado" IS 'C= culminado, N = No culminado';
COMMENT ON COLUMN "persona". "tecnologo_grado" IS 'C= culminado, N = No culminado';
COMMENT ON COLUMN "persona". "tecnologo_titulo" IS 'C= culminado, N = No culminado';

--
-- Table structure for table referencias_laborales
--

DROP SEQUENCE "referencias_laborales_id_seq" CASCADE ;

CREATE SEQUENCE "referencias_laborales_id_seq"  START WITH 2 ;

CREATE TABLE  "referencias_laborales" (
   "id" integer DEFAULT nextval('"referencias_laborales_id_seq"') NOT NULL,
   "compañia"   varchar(150) NOT NULL, 
   "cargo"   varchar(150) NOT NULL, 
   "telefono"   varchar(100) NOT NULL, 
   "id_persona"   bigint NOT NULL, 
   primary key ("id"),
 unique ("id") 
)   ;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE INDEX "referencias_laborales_id_idx" ON "referencias_laborales" USING btree ("id");
CREATE INDEX "referencias_laborales_id_persona_idx" ON "referencias_laborales" USING btree ("id_persona");
ALTER TABLE "referencias_laborales" ADD FOREIGN KEY ("id_persona") REFERENCES "persona" ("id");

--
-- Table structure for table referencias_personales
--

DROP SEQUENCE "referencias_personales_id_seq" CASCADE ;

CREATE SEQUENCE "referencias_personales_id_seq"  START WITH 3 ;

CREATE TABLE  "referencias_personales" (
   "id" integer DEFAULT nextval('"referencias_personales_id_seq"') NOT NULL,
   "nombre"   varchar(100) NOT NULL, 
   "ocupacion"   varchar(100) NOT NULL, 
   "telefono"   varchar(50) NOT NULL, 
   "id_persona"   bigint NOT NULL, 
   primary key ("id")
)   ;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
CREATE INDEX "referencias_personales_id_persona_idx" ON "referencias_personales" USING btree ("id_persona");
ALTER TABLE "referencias_personales" ADD FOREIGN KEY ("id_persona") REFERENCES "persona" ("id");
