<?php
/* @var $this RecepcionMateriaPrimaCarnicaController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Recepcion Materia Prima Carnicas',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Crear RecepcionMateriaPrimaCarnica', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar RecepcionMateriaPrimaCarnica', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Recepcion Materia Prima Carnicas') ?>
<?php $this->widget('bootstrap.widgets.BsListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>