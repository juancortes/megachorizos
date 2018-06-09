<?php
/* @var $this InsumoController */
/* @var $model Insumo */
?>

<?php
$this->breadcrumbs=array(
	'Insumos'=>array('index'),
	'Crear',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'Listar Insumo', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar Insumo', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Crear','Insumo') ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>