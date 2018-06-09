<?php
/* @var $this InsumoController */
/* @var $model Insumo */
?>

<?php
$this->breadcrumbs=array(
	'Insumos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Editar',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'Listar Insumo', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Crear Insumo', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt','label'=>'Detalles Insumo', 'url'=>array('view', 'id'=>$model->id)),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar Insumo', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Editar','Insumo '.$model->id) ?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>