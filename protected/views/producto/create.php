<?php
/* @var $this ProductoController */
/* @var $model Producto */
?>

<?php
$this->breadcrumbs=array(
	'Productos'=>array('index'),
	'Crear',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'Listar Producto', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar Producto', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Crear','Producto') ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>