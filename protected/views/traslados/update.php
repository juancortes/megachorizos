<?php
/* @var $this TrasladosController */
/* @var $model Traslados */
?>

<?php
$this->breadcrumbs=array(
	'Trasladoses'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Traslados', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Traslados', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt','label'=>'View Traslados', 'url'=>array('view', 'id'=>$model->id)),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Traslados', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Update','Traslados '.$model->id) ?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>