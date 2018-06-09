ALTER TABLE `recepcion_materia_prima_carnica` ADD COLUMN factura_interna varchar(10) NOT NULL ;

ALTER TABLE `recepcion_materia_prima_carnica` ADD COLUMN factura_externa varchar(10)  NULL ;

ALTER TABLE `recepcion_materia_prima_no_carnica` ADD COLUMN factura_interna varchar(10) NOT NULL ;

ALTER TABLE `recepcion_materia_prima_no_carnica` ADD COLUMN factura_externa varchar(10)  NULL ;



ALTER TABLE ctrl_producciones_trazabilidad ADD COLUMN peso smallint NOT NULL ;


DELETE FROM formulacion 
WHERE id 
IN(
	SELECT id FROM formulacion where producto_id not in (
		SELECT distinct f.producto_id
		FROM formulacion f 
		INNER JOIN producto p ON p.id = f.producto_id
	)
);

ALTER TABLE formulacion ADD CONSTRAINT fk_producto_for FOREIGN KEY ( producto_id ) REFERENCES producto ( id );

CREATE   INDEX fk_child_idx ON formulacion ( producto_id );

delete from formulacion 
where id 
in(
	select id from formulacion where materia_prima not in (
	SELECT distinct f.producto_id
	FROM formulacion f 
	INNER JOIN insumo i ON i.id = f.materia_prima
	)
);

ALTER TABLE formulacion ADD CONSTRAINT fk_insumo_form FOREIGN KEY ( materia_prima ) REFERENCES insumo ( id );

CREATE   INDEX fk_child_idx22 ON formulacion ( materia_prima );

CREATE TABLE proceso_embutido
(
   id int PRIMARY KEY NOT NULL AUTO_INCREMENT,
   fecha date NOT NULL,
   tanda smallint NOT NULL,
   cantidad_entrante int,
   averias_totales smallint,
   observaciones varchar(200)
)
;

CREATE TABLE embutido_productos
(
	id int PRIMARY KEY NOT NULL AUTO_INCREMENT,
	fecha timestamp NOT NULL DEFAULT now(),
	proceso_embutido_id int not null, 
	producto_id INT UNSIGNED NOT NULL,
	cantidad INT NOT NULL,
	unidades_salientes int not null,
	estimado int not null
);


ALTER TABLE embutido_productos ADD CONSTRAINT fk_embutido FOREIGN KEY ( proceso_embutido_id ) REFERENCES proceso_embutido ( id );

CREATE   INDEX fk_child_idx ON embutido_productos ( proceso_embutido_id );

ALTER TABLE embutido_productos ADD CONSTRAINT fk_productos_embutido FOREIGN KEY ( producto_id ) REFERENCES producto ( id );

CREATE   INDEX fk_child_idx2 ON embutido_productos ( producto_id );

CREATE TABLE embutido_insumos
(
	id int PRIMARY KEY NOT NULL AUTO_INCREMENT,
	fecha timestamp NOT NULL DEFAULT now(),
	proceso_embutido_id int not null, 
	insumo_id INT UNSIGNED NOT NULL,
	cantidad INT NOT NULL,
	porcion int not null
);


ALTER TABLE embutido_insumos ADD CONSTRAINT fk_ FOREIGN KEY ( proceso_embutido_id ) REFERENCES proceso_embutido ( id );

CREATE   INDEX fk_child_idx ON embutido_insumos ( proceso_embutido_id );

ALTER TABLE embutido_insumos ADD CONSTRAINT fk_insumos_embutido FOREIGN KEY ( insumo_id ) REFERENCES insumo ( id );

CREATE   INDEX fk_child_idxff ON embutido_insumos ( insumo_id );


ALTER TABLE `megachorizos`.`embutido_insumos` ADD producto_id int unsigned NOT NULL ;



ALTER TABLE embutido_insumos ADD CONSTRAINT fk FOREIGN KEY ( producto_id ) REFERENCES producto ( id );

CREATE   INDEX fk_child_idx22 ON embutido_insumos ( producto_id );


ALTER TABLE `megachorizos`.`embutido_insumos` ADD COLUMN estimado int NULL ;

drop table formula_estimado

CREATE TABLE formula_estimado
(
   id int PRIMARY KEY NOT NULL,
   fecha timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL,
   producto_id int unsigned NOT NULL,
   peso int NOT NULL,
   longitud int NOT NULL,
   insumo_id int unsigned NOT NULL
)
;

ALTER TABLE formula_estimado
ADD CONSTRAINT fk_insumos_formula_estimado
FOREIGN KEY (insumo_id)
REFERENCES insumo(id)
;

ALTER TABLE formula_estimado
ADD CONSTRAINT fk33
FOREIGN KEY (producto_id)
REFERENCES producto(id)
;

CREATE INDEX fk_child_idx2122 ON formula_estimado(producto_id)
;

CREATE UNIQUE INDEX PRIMARY ON formula_estimado(id)
;
CREATE INDEX fk_child_idxff2 ON formula_estimado(insumo_id)