<?php
/* @var $this ClientesController */
/* @var $model Clientes */
?>

<?php
$this->breadcrumbs=array(
	'Clientes'=>array('index'),
	'Crear',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'Listar Clientes', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar Clientes', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Crear','Clientes') ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>