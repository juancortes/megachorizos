<?php
/* @var $this ReporteDespachosController */
/* @var $model ReporteDespachos */
?>

<?php
$this->breadcrumbs=array(
	'Reporte Despachoses'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Editar',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'Listar ReporteDespachos', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Crear ReporteDespachos', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt','label'=>'Detalles ReporteDespachos', 'url'=>array('view', 'id'=>$model->id)),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar ReporteDespachos', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Editar','ReporteDespachos '.$model->id) ?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>