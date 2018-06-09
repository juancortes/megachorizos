<?php
/* @var $this CtrlProduccionesTrazabilidadController */
/* @var $model CtrlProduccionesTrazabilidad */
?>

<?php
$this->breadcrumbs=array(
	'Orden de Producción'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Editar',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'Listar Orden de Producción', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Crear Orden de Producción', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt','label'=>'Detalles Orden de Producción', 'url'=>array('view', 'id'=>$model->id)),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar Orden de Producción', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Editar Orden de Producción') ?>
<div ng-app='appmegachorizos'>
<?php $this->renderPartial('_form', array('model'=>$model,
		'dlleCtrlProducciones' => $dlleCtrlProducciones,
		'dlleCtrlProduccionesAdmin'=> $dlleCtrlProduccionesAdmin,
	)); ?>
</div>