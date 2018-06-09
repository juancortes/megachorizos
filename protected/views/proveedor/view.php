<?php
/* @var $this ProveedorController */
/* @var $model Proveedor */
?>

<?php
$this->breadcrumbs=array(
	'Proveedors'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Crear Proveedor', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar Proveedor', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Detalles','Proveedor '.$model->id) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nom_proveedor',
		'tipo_proveedor',
		'correo',
		'celular',
		'direccion',
		'tipo_doc',
		'cedula',
		'municipio_id',
		'codigo_base',
		'tipo',
	),
)); ?>