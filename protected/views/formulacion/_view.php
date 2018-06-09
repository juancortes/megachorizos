<?php
/* @var $this FormulacionController */
/* @var $data Formulacion */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('producto_id')); ?>:</b>
	<?php echo CHtml::encode($data->producto_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('materia_prima')); ?>:</b>
	<?php echo CHtml::encode($data->materia_prima); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('peso')); ?>:</b>
	<?php echo CHtml::encode($data->peso); ?>
	<br />


</div>