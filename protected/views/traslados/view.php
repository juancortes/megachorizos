<?php
/* @var $this TrasladosController */
/* @var $model Traslados */
?>

<?php
$this->breadcrumbs=array(
	'Trasladoses'=>array('index'),
	$model->id,
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Traslados', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Traslados', 'url'=>array('create')),
	array('icon' => 'glyphicon glyphicon-edit','label'=>'Update Traslados', 'url'=>array('update', 'id'=>$model->id)),
	array('icon' => 'glyphicon glyphicon-minus-sign','label'=>'Delete Traslados', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Traslados', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('View','Traslados '.$model->id) ?>

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