<?php
/* @var $this PersonalController */
/* @var $model Personal */
?>

<?php
$this->breadcrumbs=array(
	'Personals'=>array('index'),
	$model->id,
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'Listar Personal', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Crear Personal', 'url'=>array('create')),
	array('icon' => 'glyphicon glyphicon-edit','label'=>'Editar Personal', 'url'=>array('update', 'id'=>$model->id)),
	array('icon' => 'glyphicon glyphicon-minus-sign','label'=>'Eliminar Personal', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'¿Está seguro de eliminar este ítem?')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar Personal', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Detalles','Personal '.$model->id) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nombres',
		'cedula',
		'correo',
		'user_id',
	),
)); ?>