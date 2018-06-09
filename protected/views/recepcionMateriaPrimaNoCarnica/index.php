<?php
/* @var $this RecepcionMateriaPrimaNoCarnicaController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Recepcion Materia Prima No Carnicas',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Crear RecepcionMateriaPrimaNoCarnica', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar RecepcionMateriaPrimaNoCarnica', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Recepcion Materia Prima No Carnicas') ?>
<?php $this->widget('bootstrap.widgets.BsListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>