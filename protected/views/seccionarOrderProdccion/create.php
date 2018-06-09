<?php
/* @var $this SeccionarOrderProdccionController */
/* @var $model SeccionarOrderProdccion */
?>

<?php
$this->breadcrumbs=array(
	'Seccionar Order Prodccion'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar SeccionarOrderProdccion', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Crear SeccionarOrderProdccion') ?>

<div ng-app='appmegachorizos'>
	<?php $this->renderPartial('_form', array('model'=>$model)); ?>
</div>