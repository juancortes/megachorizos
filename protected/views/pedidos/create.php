<?php
/* @var $this PedidosController */
/* @var $model Pedidos */
?>

<?php
$this->breadcrumbs=array(
	'Pedidoses'=>array('index'),
	'Crear',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'Listar Pedidos', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar Pedidos', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Crear','Pedidos') ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>