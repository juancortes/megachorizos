<?php
/* @var $this ProcesoEmbutidoController */
/* @var $data ProcesoEmbutido */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha')); ?>:</b>
	<?php echo CHtml::encode($data->fecha); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tanda')); ?>:</b>
	<?php echo CHtml::encode($data->tanda); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cantidad_entrante')); ?>:</b>
	<?php echo CHtml::encode($data->cantidad_entrante); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('averias_totales')); ?>:</b>
	<?php echo CHtml::encode($data->averias_totales); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('observaciones')); ?>:</b>
	<?php echo CHtml::encode($data->observaciones); ?>
	<br />


</div>