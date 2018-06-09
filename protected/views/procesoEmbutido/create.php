<?php
/* @var $this ProcesoEmbutidoController */
/* @var $model ProcesoEmbutido */
?>

<?php
$this->breadcrumbs=array(
	'Proceso Embutidos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar ProcesoEmbutido', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Create Proceso de Embutido') ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
