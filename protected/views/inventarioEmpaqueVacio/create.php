<?php
/* @var $this InventarioEmpaqueVacioController */
/* @var $model InventarioEmpaqueVacio */
?>

<?php
$this->breadcrumbs=array(
	'Inventario Empaque Vacios'=>array('index'),
	'Crear',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'Listar InventarioEmpaqueVacio', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar InventarioEmpaqueVacio', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Crear','InventarioEmpaqueVacio') ?>

<div ng-app='appmegachorizos'>
	<?php $this->renderPartial('_form', array('model'=>$model)); ?>
</div>