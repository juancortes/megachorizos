<?php
/* @var $this ReporteEmpaqueVacioController */
/* @var $model ReporteEmpaqueVacio */
?>

<?php
$this->breadcrumbs=array(
	'Reporte Empaque Vacios'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Editar',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'Listar ReporteEmpaqueVacio', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Crear ReporteEmpaqueVacio', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt','label'=>'Detalles ReporteEmpaqueVacio', 'url'=>array('view', 'id'=>$model->id)),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar ReporteEmpaqueVacio', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Editar','ReporteEmpaqueVacio '.$model->id) ?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>