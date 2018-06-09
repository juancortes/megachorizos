<?php
/* @var $this PedidosController */
/* @var $model Pedidos */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <?php echo $form->textFieldControlGroup($model,'id_pedidos',array('maxlength'=>10)); ?>
    <?php echo $form->textFieldControlGroup($model,'fecha'); ?>
    <?php echo $form->textFieldControlGroup($model,'responsable'); ?>
    <?php echo $form->textFieldControlGroup($model,'lote',array('maxlength'=>255)); ?>
    <?php echo $form->textFieldControlGroup($model,'temperatura',array('maxlength'=>255)); ?>
    <?php echo $form->textFieldControlGroup($model,'id_cliente'); ?>
    <?php echo $form->textFieldControlGroup($model,'id_producto',array('maxlength'=>10)); ?>

    <div class="form-actions">
        <?php echo BsHtml::submitButton('Buscar',  array('color' => BsHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

<?php $this->endWidget(); ?>
