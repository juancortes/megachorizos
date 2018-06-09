<?php
/* @var $this RecepcionMateriaPrimaCarnicaController */
/* @var $model RecepcionMateriaPrimaCarnica */
?>

<?php
$this->breadcrumbs=array(
	'Recepcion Materia Prima Carnicas'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar RecepcionMateriaPrimaCarnica', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Recepción de Materia Prima Carnica') ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>