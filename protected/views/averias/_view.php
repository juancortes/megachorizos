<?php
/* @var $this AveriasController */
/* @var $data Averias */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha')); ?>:</b>
	<?php echo CHtml::encode($data->fecha); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('responsable_punto')); ?>:</b>
	<?php echo CHtml::encode($data->responsable_punto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('conductor_responsable')); ?>:</b>
	<?php echo CHtml::encode($data->conductor_responsable); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('destino')); ?>:</b>
	<?php echo CHtml::encode($data->destino); ?>
	<br />


</div>