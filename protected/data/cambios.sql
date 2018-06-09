

ALTER TABLE recepcion_materia_prima_carnica ADD FOREIGN KEY (materia_prima_insumo) REFERENCES insumo(id);

ALTER TABLE recepcion_materia_prima_carnica ADD FOREIGN KEY (recibido) REFERENCES User(id);

ALTER TABLE `recepcion_materia_prima_carnica` ADD COLUMN lote_externo varchar(100) NULL ;

ALTER TABLE `recepcion_materia_prima_carnica` ADD COLUMN empaque_fecha_vencimiento enum('0','1') NULL ;

ALTER TABLE `recepcion_materia_prima_carnica` ADD COLUMN empaque_condicion enum('0','1') NULL ;

ALTER TABLE `recepcion_materia_prima_no_carnica` ADD COLUMN caract_fisicas_hermeticidad enum('0','1') NULL ;

ALTER TABLE `recepcion_materia_prima_no_carnica` ADD FOREIGN KEY (proveedor_id) REFERENCES proveedor(id);

ALTER TABLE `recepcion_materia_prima_no_carnica` ADD FOREIGN KEY (materia_prima_insumo) REFERENCES insumo(id);

ALTER TABLE `recepcion_materia_prima_no_carnica` ADD FOREIGN KEY (recibido) REFERENCES User(id);

CREATE TABLE recepcion_vegetales
(
   id int AUTO_INCREMENT PRIMARY KEY NOT NULL,
   fecha_lote date NOT NULL,
   lote_interno int DEFAULT 0 NOT NULL,
   fec_vencimiento date,
   proveedor_id int UNSIGNED NOT NULL,
   materia_prima_insumo int UNSIGNED NOT NULL,
   peso_total decimal(10,3) NOT NULL,
   unidades smallint NOT NULL,
   num_lote_externo varchar(100) NOT NULL,
   caract_fisicas_color char(2) NOT NULL,
   caract_fisicas_olor char(2) NOT NULL,
   caract_fisicas_textura char(2) NOT NULL,
   caract_fisicas_limpieza char(2) NOT NULL,
   recibido int NOT NULL,
   observaciones varchar(255)
)
;
ALTER TABLE recepcion_vegetales
ADD CONSTRAINT recepcion_vegetales_ibfk_2
FOREIGN KEY (materia_prima_insumo)
REFERENCES insumo(id)
;
ALTER TABLE recepcion_vegetales
ADD CONSTRAINT recepcion_vegetales_ibfk_3
FOREIGN KEY (recibido)
REFERENCES User(id)
;
ALTER TABLE recepcion_vegetales
ADD CONSTRAINT recepcion_vegetales_ibfk_1
FOREIGN KEY (proveedor_id)
REFERENCES proveedor(id)
;
CREATE UNIQUE INDEX PRIMARY ON recepcion_vegetales(id)
;
CREATE INDEX proveedor_id ON recepcion_vegetales(proveedor_id)
;
CREATE INDEX recepcion_vegetales_ibfk_3 ON recepcion_vegetales(recibido)
;
CREATE INDEX recepcion_vegetales_ibfk_2 ON recepcion_vegetales(materia_prima_insumo)
;
