<?php
/* @var $this ReporteControlHorneadoController */
/* @var $model ReporteControlHorneado */
?>

<?php
$this->breadcrumbs=array(
	'Reporte Control Horneados'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Editar',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'Listar ReporteControlHorneado', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Crear ReporteControlHorneado', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt','label'=>'Detalles ReporteControlHorneado', 'url'=>array('view', 'id'=>$model->id)),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar ReporteControlHorneado', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Editar','ReporteControlHorneado '.$model->id) ?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>