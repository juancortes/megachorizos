<?php
/* @var $this ClientesController */
/* @var $model Clientes */
?>

<?php
$this->breadcrumbs=array(
	'Clientes'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Editar',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'Listar Clientes', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Crear Clientes', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt','label'=>'Detalles Clientes', 'url'=>array('view', 'id'=>$model->id)),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar Clientes', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Editar','Clientes '.$model->id) ?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>