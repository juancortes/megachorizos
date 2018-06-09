<?php
/* @var $this ProveedorController */
/* @var $data Proveedor */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nom_proveedor')); ?>:</b>
	<?php echo CHtml::encode($data->nom_proveedor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tipo_proveedor')); ?>:</b>
	<?php echo CHtml::encode($data->tipo_proveedor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('correo')); ?>:</b>
	<?php echo CHtml::encode($data->correo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('celular')); ?>:</b>
	<?php echo CHtml::encode($data->celular); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('direccion')); ?>:</b>
	<?php echo CHtml::encode($data->direccion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tipo_doc')); ?>:</b>
	<?php echo CHtml::encode($data->tipo_doc); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('cedula')); ?>:</b>
	<?php echo CHtml::encode($data->cedula); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('municipio_id')); ?>:</b>
	<?php echo CHtml::encode($data->municipio_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('codigo_base')); ?>:</b>
	<?php echo CHtml::encode($data->codigo_base); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tipo')); ?>:</b>
	<?php echo CHtml::encode($data->tipo); ?>
	<br />

	*/ ?>

</div>