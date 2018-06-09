<?php
/* @var $this InventarioEmpaqueVacioController */
/* @var $model InventarioEmpaqueVacio */
?>

<?php
$this->breadcrumbs=array(
	'Inventario Empaque Vacios'=>array('index'),
	$model->id,
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'Listar InventarioEmpaqueVacio', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Crear InventarioEmpaqueVacio', 'url'=>array('create')),
	array('icon' => 'glyphicon glyphicon-edit','label'=>'Editar InventarioEmpaqueVacio', 'url'=>array('update', 'id'=>$model->id)),
	array('icon' => 'glyphicon glyphicon-minus-sign','label'=>'Eliminar InventarioEmpaqueVacio', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'¿Está seguro de eliminar este ítem?')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar InventarioEmpaqueVacio', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Detalles','InventarioEmpaqueVacio '.$model->id) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'id',
		'fecha',
	),
)); ?>