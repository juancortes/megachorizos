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
    array('icon' => 'glyphicon glyphicon-list','label'=>'List ProcesoEmbutido', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create ProcesoEmbutido', 'url'=>array('create')),
	array('icon' => 'glyphicon glyphicon-edit','label'=>'Update ProcesoEmbutido', 'url'=>array('update', 'id'=>$model->id)),
	array('icon' => 'glyphicon glyphicon-minus-sign','label'=>'Delete ProcesoEmbutido', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage ProcesoEmbutido', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('View','ProcesoEmbutido '.$model->id) ?>

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