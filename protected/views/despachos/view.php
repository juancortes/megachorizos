<?php
/* @var $this DespachosController */
/* @var $model Despachos */
?>

<?php
$this->breadcrumbs=array(
	'Despachoses'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Crear Despachos', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar Despachos', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Detalles','Despachos '.$model->id) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'id',
		'fecha',
		'responsable',
		'verificado',
	),
)); ?>