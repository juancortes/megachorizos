<?php
/* @var $this RecepcionVegetalesController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Recepcion Vegetales',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create RecepcionVegetales', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage RecepcionVegetales', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Recepcion Vegetales') ?>
<?php $this->widget('bootstrap.widgets.BsListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>