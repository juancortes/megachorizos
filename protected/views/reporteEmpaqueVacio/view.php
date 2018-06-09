<?php
/* @var $this ReporteEmpaqueVacioController */
/* @var $model ReporteEmpaqueVacio */
?>

<?php
$this->breadcrumbs=array(
	'Reporte Empaque Vacios'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Crear ReporteEmpaqueVacio', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar ReporteEmpaqueVacio', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Detalles','ReporteEmpaqueVacio '.$model->id) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'id',
		'fecha',
		'producto',
		'total_paquetes',
		'peso',
		'numero_lote',
		'carac_fisicas_color',
		'carac_fisicas_olor',
		'carac_fisicas_tamano',
		'carac_fisicas_forma',
		'carac_fisicas_exur',
		'responsable_id',
	),
)); ?>