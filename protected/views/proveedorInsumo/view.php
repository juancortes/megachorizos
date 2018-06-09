<?php
/* @var $this ProveedorInsumoController */
/* @var $model ProveedorInsumo */
?>

<?php
$this->breadcrumbs=array(
	'Proveedor Insumos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Crear ProveedorInsumo', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar ProveedorInsumo', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Detalles','ProveedorInsumo '.$model->id) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'id',
		'insumo_id',
		'proveedor_id',
		'cantidad',
	),
)); ?>