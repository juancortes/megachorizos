<?php
/* @var $this FormulaEstimadoController */
/* @var $model FormulaEstimado */
?>

<?php
$this->breadcrumbs=array(
	'Formula Estimados'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List FormulaEstimado', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create FormulaEstimado', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt','label'=>'View FormulaEstimado', 'url'=>array('view', 'id'=>$model->id)),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage FormulaEstimado', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Update','FormulaEstimado '.$model->id) ?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>