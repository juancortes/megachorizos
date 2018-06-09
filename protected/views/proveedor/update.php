<?php
/* @var $this ProveedorController */
/* @var $model Proveedor */
?>

<?php
$this->breadcrumbs=array(
	'Proveedors'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Editar',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'Listar Proveedor', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Crear Proveedor', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt','label'=>'Detalles Proveedor', 'url'=>array('view', 'id'=>$model->id)),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar Proveedor', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Editar','Proveedor '.$model->id) ?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>