<?php
/* @var $this InventarioEmpaqueVacioController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Inventario Empaque Vacios',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Crear InventarioEmpaqueVacio', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar InventarioEmpaqueVacio', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Inventario Empaque Vacios') ?>
<?php $this->widget('bootstrap.widgets.BsListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>