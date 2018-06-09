<?php
/* @var $this PersonalController */
/* @var $model Personal */
?>

<?php
$this->breadcrumbs=array(
	'Personals'=>array('index'),
	'Crear',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'Listar Personal', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar Personal', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Crear','Personal') ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>