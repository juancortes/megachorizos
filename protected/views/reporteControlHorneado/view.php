<?php
/* @var $this ReporteControlHorneadoController */
/* @var $model ReporteControlHorneado */
?>

<?php
$this->breadcrumbs=array(
	'Reporte Control Horneados'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Crear ReporteControlHorneado', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar ReporteControlHorneado', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Detalles','ReporteControlHorneado '.$model->id) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'id',
		'fecha',
		'tanda',
		'producto',
		'cantidad',
		'averias',
		'codigo_reproceso',
		'numero_programa',
		'temperatura_salida',
		'temperatura_coccion',
		'sostenimiento_tiempo',
		'sostenimiento_temperatura_interna',
		'caract_organoleptica_color',
		'caract_organoleptica_olor',
		'caract_organoleptica_sabor',
		'caract_organoleptica_textura',
		'caract_fisicas_tamano',
		'caract_fisicas_forma',
		'responsable_id',
	),
)); ?>