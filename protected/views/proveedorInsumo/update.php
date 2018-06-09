<?php
/* @var $this ProveedorInsumoController */
/* @var $model ProveedorInsumo */
?>

<?php
$this->breadcrumbs=array(
	'Proveedor Insumos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Editar',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'Listar ProveedorInsumo', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Crear ProveedorInsumo', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt','label'=>'Detalles ProveedorInsumo', 'url'=>array('view', 'id'=>$model->id)),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar ProveedorInsumo', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Editar','ProveedorInsumo '.$model->id) ?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>