<?php
/* @var $this SeccionarOrderProdccionController */
/* @var $model SeccionarOrderProdccion */
?>

<?php
$this->breadcrumbs=array(
	'Seccionar Order Prodccions'=>array('index'),
	$model->id,
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List SeccionarOrderProdccion', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create SeccionarOrderProdccion', 'url'=>array('create')),
	array('icon' => 'glyphicon glyphicon-edit','label'=>'Update SeccionarOrderProdccion', 'url'=>array('update', 'id'=>$model->id)),
	array('icon' => 'glyphicon glyphicon-minus-sign','label'=>'Delete SeccionarOrderProdccion', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage SeccionarOrderProdccion', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('View','SeccionarOrderProdccion '.$model->id) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'id',
		'fecha_sistema',
		'orden_produccion_id',
		'producto_id',
		'peso_total',
		'peso_unidad',
		'longitud',
		'estado',
		'user_id',
	),
)); ?>