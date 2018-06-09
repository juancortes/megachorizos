<?php
/* @var $this ReporteDespachosController */
/* @var $model ReporteDespachos */
?>

<?php
$this->breadcrumbs=array(
	'Reporte Despachoses'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Crear ReporteDespachos', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar ReporteDespachos', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Detalles','ReporteDespachos '.$model->id) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'id',
		'fecha_reporte',
		'destino',
	),
)); ?>