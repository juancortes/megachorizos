<?php
/* @var $this SeccionarOrderProdccionController */
/* @var $model SeccionarOrderProdccion */
?>

<?php
$this->breadcrumbs=array(
	'Seccionar Order Prodccions'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List SeccionarOrderProdccion', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create SeccionarOrderProdccion', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt','label'=>'View SeccionarOrderProdccion', 'url'=>array('view', 'id'=>$model->id)),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage SeccionarOrderProdccion', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Update','SeccionarOrderProdccion '.$model->id) ?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>