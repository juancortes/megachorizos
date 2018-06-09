<?php
/* @var $this CtrlProduccionesTrazabilidadController */
/* @var $data CtrlProduccionesTrazabilidad */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('orden_produccion')); ?>:</b>
	<?php echo CHtml::encode($data->orden_produccion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha')); ?>:</b>
	<?php echo CHtml::encode($data->fecha); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('producto')); ?>:</b>
	<?php echo CHtml::encode($data->producto0->nombre); ?>
	<br />

	

	<b><?php echo CHtml::encode($data->getAttributeLabel('responsable')); ?>:</b>
	<?php echo CHtml::encode($data->responsable); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('destino')); ?>:</b>
	<?php echo CHtml::encode($data->destino); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cantidad')); ?>:</b>
	<?php echo CHtml::encode($data->cantidad); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lote_madeja')); ?>:</b>
	<?php echo CHtml::encode($data->lote_madeja); ?>
	<br />

	*/ ?>

</div>