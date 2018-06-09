<?php
/* @var $this PersonalController */
/* @var $model Personal */
?>

<?php
$this->breadcrumbs=array(
	'Personals'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Editar',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'Listar Personal', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Crear Personal', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt','label'=>'Detalles Personal', 'url'=>array('view', 'id'=>$model->id)),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar Personal', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Editar','Personal '.$model->id) ?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>