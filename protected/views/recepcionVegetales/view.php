<?php
/* @var $this RecepcionVegetalesController */
/* @var $model RecepcionVegetales */
?>

<?php
$this->breadcrumbs=array(
	'Recepcion Vegetales'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Crear Recepcion Materias Vegetales', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar Recepcion Materias Vegetales', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('View','RecepcionVegetales '.$model->id) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'id',
		'fecha_lote',
		'lote_interno',
		'fec_vencimiento',
		array(
			'name'=>'proveedor_id',
			'value'=>$model->proveedor->nom_proveedor
		),
		array(
			'name'=>'materia_prima_insumo',
			'value'=>$model->materiaPrimaInsumo->materia_prima
		),
		array(
			'name'=>'peso_total',
			'value'=>round($model->peso_total,2)
		),
		'num_lote_externo',
		array(
			'name'=>'caract_fisicas_color',
			'value'=>($model->caract_fisicas_color == 1) ? 'Conforme':'No Conforme'
		),
		array(
			'name'=>'caract_fisicas_olor',
			'value'=>($model->caract_fisicas_olor == 1) ? 'Conforme':'No Conforme'
		),
		array(
			'name'=>'caract_fisicas_textura',
			'value'=>($model->caract_fisicas_textura == 1) ? 'Conforme':'No Conforme'
		),
		array(
			'name'=>'caract_fisicas_limpieza',
			'value'=>($model->caract_fisicas_limpieza == 1) ? 'Conforme':'No Conforme'
		),
		array(
			'name'=>'recibido',
			//'header'=>'Centro de Costos',
			'value'=>$model->recibido0->nombres,
			'htmlOptions'=>array('width'=>'100px'),
		),
		'observaciones',
	),
)); ?>