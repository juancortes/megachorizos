<?php
/* @var $this CtrlHorneadoController */
/* @var $model CtrlHorneado */
?>

<?php
$this->breadcrumbs=array(
	'Ctrl Horneados'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Crear CtrlHorneado', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar CtrlHorneado', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Detalles','CtrlHorneado '.$model->id) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'id',
		'fecha',
		'tanda',
		'producto',
		'cantidad',
		'averias',
		'codigo_reproceso',
		'num_programa',
		'temperatura_salida',
		'temperatura_coccion',
		'sostenimiento_tiempo',
		'sostenimiento_temperatura_interna',
		'caract_organolepticas_color',
		'caract_organolepticas_olor',
		'caract_organolepticas_sabor',
		'caract_organolepticas_temperatura',
		'caract_fisicas_tamano',
		'caract_fisicas_forma',
		'responsable',
	),
)); ?>