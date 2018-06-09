<?php
/* @var $this RecepcionMateriaPrimaCarnicaController */
/* @var $model RecepcionMateriaPrimaCarnica */
?>

<?php
$this->breadcrumbs=array(
	'Recepcion Materia Prima Carnicas'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Crear RecepcionMateriaPrimaCarnica', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Administrar RecepcionMateriaPrimaCarnica', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Detalles','RecepcionMateriaPrimaCarnica '.$model->id) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data'=>$model,
	'attributes'=>array(
		'id',
		'fec_ingreso',
		'lote_interno',
		'proveedor',
		array(
			'name' =>'materia_prima_insumo',
			'value'=> $model->materiaPrimaInsumo->materia_prima
		),
		array(
			'name'=>'peso',
			'value'=>round($model->peso,2)
		),
		'temperatura_llegada',
		array(
			'name'  => 'carct_orgleptica_color',
			'value' => ($model->carct_orgleptica_color === '1') ? 'Si':'No'
		),
		array(
			'name'  => 'carct_orgleptica_olor',
			'value' => ($model->carct_orgleptica_olor === '1') ? 'Si':'No'
		),
		array(
			'name'  => 'carct_orgleptica_c_temperatura',
			'value' => ($model->carct_orgleptica_c_temperatura === '1') ? 'Si':'No'
		),
		array(
			'name'  => 'hgiene_vehiculo',
			'value' => ($model->hgiene_vehiculo === '1') ? 'Si':'No'
		),
		array(
			'name'  => 'hgiene_canastas',
			'value' => ($model->hgiene_canastas === '1') ? 'Si':'No'
		),
		array(
			'name'  => 'conductor_dotacion',
			'value' => ($model->conductor_dotacion === '1') ? 'Si':'No'
		),
		array(
			'name'  => 'conductor_higiene',
			'value' => ($model->conductor_higiene === '1') ? 'Si':'No'
		),
		array(
			'name'  => 'devolucion_si_no',
			'value' => ($model->devolucion_si_no === '1') ? 'Si':'No'
		),
		'devolucion_peso',
		array(
			'name'=>'recibido',
			//'header'=>'Centro de Costos',
			'value'=>$model->recibido0->nombres,
			'htmlOptions'=>array('width'=>'100px'),
		),
	),
)); ?>