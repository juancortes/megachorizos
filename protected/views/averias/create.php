<?php
/* @var $this AveriasController */
/* @var $model Averias */
?>

<?php
$this->breadcrumbs=array(
	'producto no conforme planta de produccion'=>array('index'),
	'Crear',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'Listar producto no conforme', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar producto no conforme', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Crear','producto no conforme planta de produccion') ?>
<div ng-app='appmegachorizos'> 
	<?php $this->renderPartial('_form', array('model'=>$model)); ?>
</div>