<?php
/* @var $this DespachosController */
/* @var $model Despachos */
?>

<?php
$this->breadcrumbs=array(
	'Despachoses'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Editar',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'Listar Despachos', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Crear Despachos', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt','label'=>'Detalles Despachos', 'url'=>array('view', 'id'=>$model->id)),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar Despachos', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Editar','Despachos '.$model->id) ?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>