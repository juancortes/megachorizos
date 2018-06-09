<?php
/* @var $this ProveedorController */
/* @var $model Proveedor */
?>

<?php
$this->breadcrumbs=array(
	'Proveedors'=>array('index'),
	'Crear',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'Listar Proveedor', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar Proveedor', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Crear','Proveedor') ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>