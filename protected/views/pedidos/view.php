<?php
/* @var $this PedidosController */
/* @var $model Pedidos */
?>

<?php
$this->breadcrumbs=array(
	'Pedidoses'=>array('index'),
	$model->id_pedidos,
);

$this->menu=array(
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Crear Pedidos', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar Pedidos', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Detalles','Pedidos '.$model->id_pedidos) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'id_pedidos',
		'fecha',
		'responsable',
		'lote',
		'temperatura',
		'id_cliente',
		'id_producto',
	),
)); ?>