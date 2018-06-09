<?php
/* @var $this AveriasController */
/* @var $model Averias */
?>

<?php
$this->breadcrumbs=array(
	'Averiases'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Editar',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'Listar Averias', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Crear Averias', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt','label'=>'Detalles Averias', 'url'=>array('view', 'id'=>$model->id)),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar Averias', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Editar','Averias '.$model->id) ?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>