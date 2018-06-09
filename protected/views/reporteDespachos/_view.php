<?php
/* @var $this ReporteDespachosController */
/* @var $data ReporteDespachos */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_reporte')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_reporte); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('destino')); ?>:</b>
	<?php echo CHtml::encode($data->destino); ?>
	<br />


</div>