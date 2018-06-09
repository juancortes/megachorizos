<?php
/* @var $this ProcesoEmbutidoController */
/* @var $model ProcesoEmbutido */
?>

<?php
$this->breadcrumbs=array(
	'Proceso Embutidos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List ProcesoEmbutido', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create ProcesoEmbutido', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt','label'=>'View ProcesoEmbutido', 'url'=>array('view', 'id'=>$model->id)),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage ProcesoEmbutido', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Update','ProcesoEmbutido '.$model->id) ?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>