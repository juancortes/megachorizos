<?php
/* @var $this SeccionarOrderProdccionController */
/* @var $data SeccionarOrderProdccion */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_sistema')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_sistema); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('orden_produccion_id')); ?>:</b>
	<?php echo CHtml::encode($data->orden_produccion_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('producto_id')); ?>:</b>
	<?php echo CHtml::encode($data->producto_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('peso_total')); ?>:</b>
	<?php echo CHtml::encode($data->peso_total); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('peso_unidad')); ?>:</b>
	<?php echo CHtml::encode($data->peso_unidad); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('longitud')); ?>:</b>
	<?php echo CHtml::encode($data->longitud); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('estado')); ?>:</b>
	<?php echo CHtml::encode($data->estado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	*/ ?>

</div>