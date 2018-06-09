<?php
/* @var $this PersonalController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Personals',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Crear Personal', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar Personal', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Personals') ?>
<?php $this->widget('bootstrap.widgets.BsListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>