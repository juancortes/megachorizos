<?php
/* @var $this UserController */
/* @var $model User */
?>

<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->id,
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'Listar User', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Crear User', 'url'=>array('create')),
	array('icon' => 'glyphicon glyphicon-edit','label'=>'Editar User', 'url'=>array('update', 'id'=>$model->id)),
	array('icon' => 'glyphicon glyphicon-minus-sign','label'=>'Eliminar User', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'¿Está seguro de eliminar este ítem?')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar User', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Detalles','User '.$model->id) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'id',
		'username',
		'password',
		'nombres',
	),
)); ?>