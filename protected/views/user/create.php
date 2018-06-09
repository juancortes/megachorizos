<?php
/* @var $this UserController */
/* @var $model User */
?>

<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Crear',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'Listar User', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar User', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Crear','User') ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>