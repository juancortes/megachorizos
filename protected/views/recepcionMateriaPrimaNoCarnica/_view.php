<?php
/* @var $this RecepcionMateriaPrimaNoCarnicaController */
/* @var $data RecepcionMateriaPrimaNoCarnica */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fec_ingreso')); ?>:</b>
	<?php echo CHtml::encode($data->fec_ingreso); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lote_interno')); ?>:</b>
	<?php echo CHtml::encode($data->lote_interno); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fec_vencimiento')); ?>:</b>
	<?php echo CHtml::encode($data->fec_vencimiento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('proveedor_id')); ?>:</b>
	<?php echo CHtml::encode($data->proveedor->nom_proveedor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('materia_prima_insumo')); ?>:</b>
	<?php echo CHtml::encode($data->materiaPrimaInsumo->materia_prima); ?>
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('caract_fisicas_empaque')); ?>:</b>
	<?php echo CHtml::encode($data->caract_fisicas_empaque); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('caract_fisicas_rotulado')); ?>:</b>
	<?php echo CHtml::encode($data->caract_fisicas_rotulado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('devolucion_si_no')); ?>:</b>
	<?php echo CHtml::encode($data->devolucion_si_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('devolucion_peso_unidades')); ?>:</b>
	<?php echo CHtml::encode($data->devolucion_peso_unidades); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('recibido')); ?>:</b>
	<?php echo CHtml::encode($data->recibido); ?>
	<br />

	*/ ?>

</div>