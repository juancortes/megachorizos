<?php
/* @var $this ProcesoEmbutidoController */
/* @var $model ProcesoEmbutido */
?>

<?php
$this->breadcrumbs=array(
	'Proceso Embutidos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Crear Proceso Embutido', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar Proceso Embutido', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Vista Proceso Embutido ') ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'id',
		'fecha',
		'tanda',
		'cantidad_entrante',
		'averias_totales',
		'observaciones',
	),
)); ?>