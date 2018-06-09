<?php
/* @var $this ReporteControlHorneadoController */
/* @var $model ReporteControlHorneado */
?>

<?php
$this->breadcrumbs=array(
	'Reporte Control Horneados'=>array('index'),
	'Crear',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'Listar ReporteControlHorneado', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar ReporteControlHorneado', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Crear','ReporteControlHorneado') ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>