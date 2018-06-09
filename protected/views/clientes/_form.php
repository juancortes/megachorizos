<?php
/* @var $this ClientesController */
/* @var $model Clientes */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'clientes-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); ?>

    <p class="help-block">Los campos con <span class="required">*</span> son obligatorios.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldControlGroup($model,'nombre',array('maxlength'=>255)); ?>
    <?php echo $form->textFieldControlGroup($model,'direccion',array('maxlength'=>255)); ?>
    <?php echo $form->textFieldControlGroup($model,'telefono',array('maxlength'=>255)); ?>
    <?php echo $form->textFieldControlGroup($model,'celular',array('maxlength'=>255)); ?>
    <?php echo $form->textFieldControlGroup($model,'email',array('maxlength'=>255)); ?>

    <?php echo BsHtml::submitButton('Enviar', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>

<?php $this->endWidget(); ?>
