<?php
/* @var $this RecepcionVegetalesController */
/* @var $data RecepcionVegetales */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_lote')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_lote); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lote_interno')); ?>:</b>
	<?php echo CHtml::encode($data->lote_interno); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fec_vencimiento')); ?>:</b>
	<?php echo CHtml::encode($data->fec_vencimiento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('proveedor_id')); ?>:</b>
	<?php echo CHtml::encode($data->proveedor_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('materia_prima_insumo')); ?>:</b>
	<?php echo CHtml::encode($data->materia_prima_insumo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('peso_total')); ?>:</b>
	<?php echo CHtml::encode($data->peso_total); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('unidades')); ?>:</b>
	<?php echo CHtml::encode($data->unidades); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('num_lote_externo')); ?>:</b>
	<?php echo CHtml::encode($data->num_lote_externo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('caract_fisicas_color')); ?>:</b>
	<?php echo CHtml::encode($data->caract_fisicas_color); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('caract_fisicas_olor')); ?>:</b>
	<?php echo CHtml::encode($data->caract_fisicas_olor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('caract_fisicas_textura')); ?>:</b>
	<?php echo CHtml::encode($data->caract_fisicas_textura); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('caract_fisicas_limpieza')); ?>:</b>
	<?php echo CHtml::encode($data->caract_fisicas_limpieza); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('recibido')); ?>:</b>
	<?php echo CHtml::encode($data->recibido); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('observaciones')); ?>:</b>
	<?php echo CHtml::encode($data->observaciones); ?>
	<br />

	*/ ?>

</div>