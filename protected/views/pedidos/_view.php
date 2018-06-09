<?php
/* @var $this PedidosController */
/* @var $data Pedidos */
?>

<div class="view">

	

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha')); ?>:</b>
	<?php echo CHtml::encode($data->fecha); ?>
	<br />


	<b><?php echo CHtml::encode($data->getAttributeLabel('lote')); ?>:</b>
	<?php echo CHtml::encode($data->lote); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('temperatura')); ?>:</b>
	<?php echo CHtml::encode($data->temperatura); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_cliente')); ?>:</b>
	<?php echo CHtml::encode($data->idCliente->nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_producto')); ?>:</b>
	<?php echo CHtml::encode($data->idProducto->nombre); ?>
	<br />


</div>