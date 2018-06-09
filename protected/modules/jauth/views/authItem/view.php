<?php
/* @var $this AuthitemController */
/* @var $model Authitem */

$this->breadcrumbs=array(
	'Autorizaciones'=>array('index'),
	$model->name,
	);
$this->menu=array(
	array('icon' => 'glyphicon glyphicon-list','label'=>'Listar Autorizaciones', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Crear Autorización', 'url'=>array('create')),
	array('icon' => 'glyphicon glyphicon-edit','label'=>'Editar Autorización', 'url'=>array('update', 'id'=>$model->name)),
	array('icon' => 'glyphicon glyphicon-minus-sign','label'=>'Eliminar Autorización', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->name),'confirm'=>'¿Está seguro de eliminar este ítem?')),
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar Autorización', 'url'=>array('admin')),
	);
	?>

	<?php echo BsHtml::pageHeader('Detalles','Autorización '.$model->name) ?>
	<?php 
	$this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'htmlOptions' => array(
			'class' => 'table table-striped table-condensed table-hover',
			),
		'attributes'=>array(
			'name',
			'type',
			'description',
			'bizrule',
			'data',
			),
		)
	); 
	?>
