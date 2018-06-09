<?php
/* @var $this AuthitemController */
/* @var $model Authitem */

$this->breadcrumbs=array(
	'Autorización'=>array('index'),
	$model->name=>array('view','id'=>$model->name),
	'Editar',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'Listar Autorizaciones', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Crear Autorización', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt','label'=>'Detalles Autorización', 'url'=>array('view', 'id'=>$model->name)),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar Autorización', 'url'=>array('admin')),
);
?>
<?php echo BsHtml::pageHeader('Editar','Autorización '.$model->name) ?>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>