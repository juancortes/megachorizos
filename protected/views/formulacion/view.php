/* @var $this FormulacionController */
/* @var $model Formulacion */
?>

<?php
$this->breadcrumbs=array(
	'Formulacions'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Crear Formulacion', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar Formulacion', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Detalles','Formulacion '.$model->id) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'id',
		'producto_id',
		'materia_prima',
		'peso',
	),
)); ?>