<?php
/* @var $this InsumoController */
/* @var $model Insumo */
?>

<?php
$this->breadcrumbs=array(
	'Insumos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Crear Insumo', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar Insumo', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Detalles','Insumo '.$model->id) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'id',
		'materia_prima',
		'tipo',
		'cantidad',
	),
)); ?>