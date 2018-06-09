<?php
/* @var $this ReporteEmpaqueVacioController */
/* @var $data ReporteEmpaqueVacio */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha')); ?>:</b>
	<?php echo CHtml::encode($data->fecha); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('producto')); ?>:</b>
	<?php echo CHtml::encode($data->producto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total_paquetes')); ?>:</b>
	<?php echo CHtml::encode($data->total_paquetes); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('peso')); ?>:</b>
	<?php echo CHtml::encode($data->peso); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('numero_lote')); ?>:</b>
	<?php echo CHtml::encode($data->numero_lote); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('carac_fisicas_color')); ?>:</b>
	<?php echo CHtml::encode($data->carac_fisicas_color); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('carac_fisicas_olor')); ?>:</b>
	<?php echo CHtml::encode($data->carac_fisicas_olor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('carac_fisicas_tamano')); ?>:</b>
	<?php echo CHtml::encode($data->carac_fisicas_tamano); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('carac_fisicas_forma')); ?>:</b>
	<?php echo CHtml::encode($data->carac_fisicas_forma); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('carac_fisicas_exur')); ?>:</b>
	<?php echo CHtml::encode($data->carac_fisicas_exur); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('responsable_id')); ?>:</b>
	<?php echo CHtml::encode($data->responsable_id); ?>
	<br />

	*/ ?>

</div>