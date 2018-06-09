<?php
/* @var $this FormulacionController */
/* @var $model Formulacion */
?>

<?php
$this->breadcrumbs=array(
	'Formulacions'=>array('index'),
	'Crear',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'Listar Formulacion', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar Formulacion', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Crear','Formulacion') ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>