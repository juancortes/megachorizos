<?php
/* @var $this RecepcionVegetalesController */
/* @var $model RecepcionVegetales */
?>

<?php
$this->breadcrumbs=array(
	'Recepcion Vegetales'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List RecepcionVegetales', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create RecepcionVegetales', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt','label'=>'View RecepcionVegetales', 'url'=>array('view', 'id'=>$model->id)),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage RecepcionVegetales', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Update','RecepcionVegetales '.$model->id) ?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>