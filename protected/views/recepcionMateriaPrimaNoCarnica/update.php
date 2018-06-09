<?php
/* @var $this RecepcionMateriaPrimaNoCarnicaController */
/* @var $model RecepcionMateriaPrimaNoCarnica */
?>

<?php
$this->breadcrumbs=array(
	'Recepcion Materia Prima No Carnicas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Editar',
);

$this->menu=array(
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Crear RecepcionMateriaPrimaNoCarnica', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar RecepcionMateriaPrimaNoCarnica', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Editar','RecepcionMateriaPrimaNoCarnica ') ?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>