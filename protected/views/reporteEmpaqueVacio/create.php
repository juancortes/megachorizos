<?php
/* @var $this ReporteEmpaqueVacioController */
/* @var $model ReporteEmpaqueVacio */
?>

<?php
$this->breadcrumbs=array(
	'Reporte Empaque Vacios'=>array('index'),
	'Crear',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'Listar ReporteEmpaqueVacio', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar ReporteEmpaqueVacio', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Crear','ReporteEmpaqueVacio') ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>