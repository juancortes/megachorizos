<?php
/* @var $this DespachosController */
/* @var $model Despachos */
?>

<?php
$this->breadcrumbs=array(
	'Despachoses'=>array('index'),
	'Crear',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'Listar Despachos', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar Despachos', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Crear Despachos') ?>

<div ng-app='appmegachorizos'>
	<?php $this->renderPartial('_form', array('model'=>$model)); ?>
</div>