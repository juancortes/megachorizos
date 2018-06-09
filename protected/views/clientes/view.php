<?php
/* @var $this ClientesController */
/* @var $model Clientes */
?>

<?php
$this->breadcrumbs=array(
	'Clientes'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Crear Clientes', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar Clientes', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Detalles','Clientes '.$model->id) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nombre',
		'direccion',
		'telefono',
		'celular',
		'email',
	),
)); ?>