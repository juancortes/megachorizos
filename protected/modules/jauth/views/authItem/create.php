<?php
/* @var $this AuthitemController */
/* @var $model Authitem */

$this->breadcrumbs=array(
	'Autorizaciones'=>array('index'),
	'Crear',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'Listar Autorizaciones', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar Autorizaciones', 'url'=>array('admin')),
);

?>

<?php echo BsHtml::pageHeader('Crear','Items') ?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>