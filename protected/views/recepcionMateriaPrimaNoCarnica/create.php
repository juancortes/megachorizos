<?php
/* @var $this RecepcionMateriaPrimaNoCarnicaController */
/* @var $model RecepcionMateriaPrimaNoCarnica */
?>

<?php
$this->breadcrumbs=array(
	'Recepcion Materia Prima No Carnicas'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar RecepcionMateriaPrimaNoCarnica', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Recepción de Materia Prima No Carnica') ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>