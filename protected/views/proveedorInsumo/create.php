<?php
/* @var $this ProveedorInsumoController */
/* @var $model ProveedorInsumo */
?>

<?php
$this->breadcrumbs=array(
	'Proveedor Insumos'=>array('index'),
	'Crear',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'Listar ProveedorInsumo', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar ProveedorInsumo', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Crear','ProveedorInsumo') ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>