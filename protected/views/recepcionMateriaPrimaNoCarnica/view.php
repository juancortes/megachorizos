<?php
/* @var $this RecepcionMateriaPrimaNoCarnicaController */
/* @var $model RecepcionMateriaPrimaNoCarnica */
?>

<?php
$this->breadcrumbs=array(
	'Recepcion Materia Prima No Carnicas'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Crear RecepcionMateriaPrimaNoCarnica', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar RecepcionMateriaPrimaNoCarnica', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Detalles','RecepcionMateriaPrimaNoCarnica '.$model->id) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'id',
		'fec_ingreso',
		'lote_interno',
		'fec_vencimiento',
		array(
			'name' =>'proveedor_id',
			'value'=> $model->proveedor->nom_proveedor
		),
		array(
			'name' =>'materia_prima_insumo',
			'value'=> $model->materiaPrimaInsumo->materia_prima
		),
		array(
			'name' => 'peso_total',
			'value' => round($model->peso_total,2)
		),
		'unidades',
		'num_lote_externo',
		array(
			'name'  => 'caract_fisicas_empaque',
			'value' => ($model->caract_fisicas_empaque === '1') ? 'Si':'No'
		),
		array(
			'name'  => 'caract_fisicas_rotulado',
			'value' => ($model->caract_fisicas_rotulado === '1') ? 'Si':'No'
		),
		array(
			'name'  => 'devolucion_si_no',
			'value' => ($model->devolucion_si_no === '1') ? 'Si':'No'
		),
		'devolucion_peso_unidades',
		array(
			'name'=>'recibido',
			//'header'=>'Centro de Costos',
			'value'=>$model->recibido0->nombres,
			'htmlOptions'=>array('width'=>'100px'),
		),
	),
)); ?>