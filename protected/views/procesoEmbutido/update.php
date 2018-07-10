<?php
/* @var $this ProcesoEmbutidoController */
/* @var $model ProcesoEmbutido */
?>

<?php
$this->breadcrumbs=array(
	'Proceso Embutidos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Actualizar',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar Proceso Embutido', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Actualizar Proceso Embutido ') ?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>