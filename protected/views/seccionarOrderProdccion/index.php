<?php
/* @var $this SeccionarOrderProdccionController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Seccionar Order Prodccions',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create SeccionarOrderProdccion', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage SeccionarOrderProdccion', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Seccionar Order Prodccions') ?>
<?php $this->widget('bootstrap.widgets.BsListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>