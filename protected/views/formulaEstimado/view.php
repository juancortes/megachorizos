<?php
/* @var $this FormulaEstimadoController */
/* @var $model FormulaEstimado */
?>

<?php
$this->breadcrumbs=array(
	'Formula Estimados'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Crear FormulaEstimado', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar FormulaEstimado', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Vista','FormulaEstimado '.$model->id) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'id',
		'fecha',
		array(
			'name'=>'producto_id',
			'value'=>$model->producto->nombre
		),
		array(
			'name'=>'insumo_id',
			'value'=>$model->insumo->materia_prima
		),
		array(
			'name'=>'peso',
			'value'=>round($model->peso,2)
		),
		array(
			'name'=>'longitud',
			'value'=>round($model->longitud,2)
		),
	),
)); ?>