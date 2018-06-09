<?php
/* @var $this RecepcionMateriaPrimaCarnicaController */
/* @var $data RecepcionMateriaPrimaCarnica */
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('proveedor')); ?>:</b>
	<?php echo CHtml::encode($data->proveedor0->nom_proveedor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('materia_prima_insumo')); ?>:</b>
	<?php echo CHtml::encode($data->materiaPrimaInsumo->materia_prima); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('peso')); ?>:</b>
	<?php echo CHtml::encode($data->peso); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('temperatura_llegada')); ?>:</b>
	<?php echo CHtml::encode($data->temperatura_llegada); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('carct_orgleptica_color')); ?>:</b>
	<?php echo CHtml::encode($data->carct_orgleptica_color); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('carct_orgleptica_olor')); ?>:</b>
	<?php echo CHtml::encode($data->carct_orgleptica_olor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('carct_orgleptica_c_temperatura')); ?>:</b>
	<?php echo CHtml::encode($data->carct_orgleptica_c_temperatura); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hgiene_vehiculo')); ?>:</b>
	<?php echo CHtml::encode($data->hgiene_vehiculo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hgiene_canastas')); ?>:</b>
	<?php echo CHtml::encode($data->hgiene_canastas); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('conductor_dotacion')); ?>:</b>
	<?php echo CHtml::encode($data->conductor_dotacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('conductor_higiene')); ?>:</b>
	<?php echo CHtml::encode($data->conductor_higiene); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('devolucion_si_no')); ?>:</b>
	<?php echo CHtml::encode($data->devolucion_si_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('devolucion_peso')); ?>:</b>
	<?php echo CHtml::encode($data->devolucion_peso); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('recibido')); ?>:</b>
	<?php echo CHtml::encode($data->recibido); ?>
	<br />

	*/ ?>

</div>