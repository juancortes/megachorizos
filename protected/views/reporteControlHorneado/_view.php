<?php
/* @var $this ReporteControlHorneadoController */
/* @var $data ReporteControlHorneado */
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
	<b><?php echo CHtml::encode($data->getAttributeLabel('numero_programa')); ?>:</b>
	<?php echo CHtml::encode($data->numero_programa); ?>
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('caract_organoleptica_color')); ?>:</b>
	<?php echo CHtml::encode($data->caract_organoleptica_color); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('caract_organoleptica_olor')); ?>:</b>
	<?php echo CHtml::encode($data->caract_organoleptica_olor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('caract_organoleptica_sabor')); ?>:</b>
	<?php echo CHtml::encode($data->caract_organoleptica_sabor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('caract_organoleptica_textura')); ?>:</b>
	<?php echo CHtml::encode($data->caract_organoleptica_textura); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('caract_fisicas_tamano')); ?>:</b>
	<?php echo CHtml::encode($data->caract_fisicas_tamano); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('caract_fisicas_forma')); ?>:</b>
	<?php echo CHtml::encode($data->caract_fisicas_forma); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('responsable_id')); ?>:</b>
	<?php echo CHtml::encode($data->responsable_id); ?>
	<br />

	*/ ?>

</div>