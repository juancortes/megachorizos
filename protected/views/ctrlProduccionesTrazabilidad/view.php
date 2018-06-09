<?php
/* @var $this CtrlProduccionesTrazabilidadController */
/* @var $model CtrlProduccionesTrazabilidad */
?>

<?php
$this->breadcrumbs=array(
	'Orden de Producción'=>array('index'),
);

$this->menu=array(
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Crear Orden de Producción', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar Orden de Producción', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Detalles','Orden de Producción ') ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'orden_produccion',
		'fecha',
		array( 
			'name'=>'producto',
			//'header'=>'Centro de Costos',
			'value'=>$model->producto0->nombre,
		),
		'cant_produccion',
		'unidades_producidas',  
	),
)); 
?>
<?php $this->widget('bootstrap.widgets.BsGridView',array(
			'id'=>'detalletrl-producciones-trazabilidad-grid',
			'dataProvider'=>$detalle->search($model->id),
			'filter'=>$detalle,
			'columns'=>array(
		array(
			'name'=>'insumo_id',
			//'header'=>'Centro de Costos',
			//'value'=>'$data->insumo->materia_prima',
			'htmlOptions'=>array('width'=>'450px'),
		),
		'cantidad',
		/*
		'responsable',
		'destino',
		'cantidad',
		*/
				
			),
        )); ?>