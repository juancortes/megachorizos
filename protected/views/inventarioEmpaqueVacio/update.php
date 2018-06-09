<?php
/* @var $this InventarioEmpaqueVacioController */
/* @var $model InventarioEmpaqueVacio */
?>

<?php
$this->breadcrumbs=array(
	'Inventario Empaque Vacios'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Editar',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'Listar InventarioEmpaqueVacio', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Crear InventarioEmpaqueVacio', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt','label'=>'Detalles InventarioEmpaqueVacio', 'url'=>array('view', 'id'=>$model->id)),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar InventarioEmpaqueVacio', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Editar','InventarioEmpaqueVacio '.$model->id) ?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>