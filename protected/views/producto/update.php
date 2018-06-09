<?php
/* @var $this ProductoController */
/* @var $model Producto */
?>

<?php
$this->breadcrumbs=array(
	'Productos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Editar',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'Listar Producto', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Crear Producto', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt','label'=>'Detalles Producto', 'url'=>array('view', 'id'=>$model->id)),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar Producto', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Editar','Producto '.$model->id) ?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>