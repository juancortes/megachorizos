<?php
/* @var $this PedidosController */
/* @var $model Pedidos */
?>

<?php
$this->breadcrumbs=array(
	'Pedidoses'=>array('index'),
	$model->id_pedidos=>array('view','id'=>$model->id_pedidos),
	'Editar',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'Listar Pedidos', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Crear Pedidos', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt','label'=>'Detalles Pedidos', 'url'=>array('view', 'id'=>$model->id_pedidos)),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar Pedidos', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Editar','Pedidos '.$model->id_pedidos) ?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>