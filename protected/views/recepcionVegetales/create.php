<?php
/* @var $this RecepcionVegetalesController */
/* @var $model RecepcionVegetales */
?>

<?php
$this->breadcrumbs=array(
	'Recepcion Vegetales'=>array('index'),
	'Recepcionar',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'Listar Recepcion de Vegetales', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar Recepcion de Vegetales', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Recepcion de Vegetales') ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>