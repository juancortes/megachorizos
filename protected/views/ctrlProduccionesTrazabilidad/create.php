<?php
/* @var $this CtrlProduccionesTrazabilidadController */
/* @var $model CtrlProduccionesTrazabilidad */
?>

<?php
$this->breadcrumbs=array(
	'Orden de Producción'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar Orden de Producción', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Crear Orden de Producción') ?>

<div ng-app='appmegachorizos'>
	<?php $this->renderPartial('_form', array('model'=>$model,
		'dlleCtrlProducciones' => $dlleCtrlProducciones,
		'dlleCtrlProduccionesAdmin'=> $dlleCtrlProduccionesAdmin,
		//'sesion'=>$sesion
	)); ?>
</div>