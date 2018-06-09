<?php
/* @var $this ReporteControlHorneadoController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Reporte Control Horneados',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Crear ReporteControlHorneado', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar ReporteControlHorneado', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Reporte Control Horneados') ?>
<?php $this->widget('bootstrap.widgets.BsListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>