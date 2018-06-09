<?php
/* @var $this TrasladosController */
/* @var $model Traslados */
?>

<?php
$this->breadcrumbs=array(
	'Traslados'=>array('admin'),
	'Crear',
);

$this->menu=array(
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar Traslados', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Crear Traslados') ?>

<div ng-app='appmegachorizos'>
	<?php $this->renderPartial('_form', array('model'=>$model)); ?>
</div>