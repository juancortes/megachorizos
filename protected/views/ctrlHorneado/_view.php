<?php
/* @var $this CtrlHorneadoController */
/* @var $data CtrlHorneado */
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('producto')); ?>:</b>
	<?php echo CHtml::encode($data->producto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cantidad')); ?>:</b>
	<?php echo CHtml::encode($data->cantidad); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('averias')); ?>:</b>
	<?php echo CHtml::encode($data->averias); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('codigo_reproceso')); ?>:</b>
	<?php echo CHtml::encode($data->codigo_reproceso); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('num_programa')); ?>:</b>
	<?php echo CHtml::encode($data->num_programa); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('temperatura_salida')); ?>:</b>
	<?php echo CHtml::encode($data->temperatura_salida); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('temperatura_coccion')); ?>:</b>
	<?php echo CHtml::encode($data->temperatura_coccion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sostenimiento_tiempo')); ?>:</b>
	<?php echo CHtml::encode($data->sostenimiento_tiempo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sostenimiento_temperatura_interna')); ?>:</b>
	<?php echo CHtml::encode($data->sostenimiento_temperatura_interna); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('caract_organolepticas_color')); ?>:</b>
	<?php echo CHtml::encode($data->caract_organolepticas_color); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('caract_organolepticas_olor')); ?>:</b>
	<?php echo CHtml::encode($data->caract_organolepticas_dolor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('caract_organolepticas_sabor')); ?>:</b>
	<?php echo CHtml::encode($data->caract_organolepticas_sabor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('caract_organolepticas_temperatura')); ?>:</b>
	<?php echo CHtml::encode($data->caract_organolepticas_temperatura); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('caract_fisicas_tamano')); ?>:</b>
	<?php echo CHtml::encode($data->caract_fisicas_tamano); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('caract_fisicas_forma')); ?>:</b>
	<?php echo CHtml::encode($data->caract_fisicas_forma); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('responsable')); ?>:</b>
	<?php echo CHtml::encode($data->responsable); ?>
	<br />

	*/ ?>

</div>