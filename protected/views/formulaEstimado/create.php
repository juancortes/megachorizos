<?php
/* @var $this FormulaEstimadoController */
/* @var $model FormulaEstimado */
?>

<?php
$this->breadcrumbs=array(
	'Formula Estimados'=>array('index'),
	'Create',
);

$this->menu=array(
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar FormulaEstimado', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Crear','Formula de Estimado') ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>