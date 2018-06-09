<?php
/* @var $this AveriasController */
/* @var $model Averias */
?>

<?php
$this->breadcrumbs=array(
	'producto no conforme'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Crear producto no conforme', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar producto no conforme', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Detalles','producto no conforme '.$model->id) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'id',
		'fecha',
		'responsable_punto',
		'conductor_responsable',
		'destino',
	),
)); ?>