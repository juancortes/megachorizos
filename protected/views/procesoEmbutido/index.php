<?php
/* @var $this ProcesoEmbutidoController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Proceso Embutidos',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create ProcesoEmbutido', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage ProcesoEmbutido', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Proceso Embutidos') ?>
<?php $this->widget('bootstrap.widgets.BsListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>