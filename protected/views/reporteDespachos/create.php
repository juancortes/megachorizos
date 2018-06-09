<?php
/* @var $this ReporteDespachosController */
/* @var $model ReporteDespachos */
?>

<?php
$this->breadcrumbs=array(
	'Reporte Despachoses'=>array('index'),
	'Crear',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'Listar ReporteDespachos', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar ReporteDespachos', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Crear','ReporteDespachos') ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>