<?php
/* @var $this FormulacionController */
/* @var $model Formulacion */
?>

<?php
$this->breadcrumbs=array(
	'Formulacions'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Editar',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'Listar Formulacion', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Crear Formulacion', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt','label'=>'Detalles Formulacion', 'url'=>array('view', 'id'=>$model->id)),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar Formulacion', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Editar','Formulacion '.$model->id) ?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>