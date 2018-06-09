<?php
/* @var $this RecepcionMateriaPrimaCarnicaController */
/* @var $model RecepcionMateriaPrimaCarnica */
?>

<?php
$this->breadcrumbs=array(
	'Recepción de Materia Prima Carnicas'=>array('index'),
	'Editar',
);

$this->menu=array(
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Crear RecepcionMateriaPrimaCarnica', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar RecepcionMateriaPrimaCarnica', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Edición Recepción de Materia Prima Carnica ') ?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>