<?php
/* @var $this ProductoController */
/* @var $model Producto */
?>

<?php
$this->breadcrumbs=array(
	'Productos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Crear Producto', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar Producto', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Detalles','Producto '.$model->id) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nombre',
		'cantidad',
	),
)); ?>