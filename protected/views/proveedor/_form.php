<?php
/* @var $this ProveedorController */
/* @var $model Proveedor */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'proveedor-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); ?>

    <p class="help-block">Los campos con <span class="required">*</span> son obligatorios.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldControlGroup($model,'nom_proveedor',array('maxlength'=>100)); ?>
    <?php echo $form->hiddenField($model,'tipo_proveedor',array('maxlength'=>1,'value'=>'0')); ?>
    <?php echo $form->textFieldControlGroup($model,'correo',array('maxlength'=>255)); ?>
    <?php echo $form->textFieldControlGroup($model,'celular',array('maxlength'=>30)); ?>
    <?php echo $form->textFieldControlGroup($model,'direccion',array('maxlength'=>255)); ?>
    <?php echo $form->hiddenField($model,'tipo_doc',array('maxlength'=>1,'value'=>'0')); ?>
    <?php echo $form->textFieldControlGroup($model,'cedula',array('maxlength'=>50)); ?>
    <?php echo $form->textFieldControlGroup($model,'municipio_id',array('maxlength'=>8)); ?>
    <?php echo $form->textFieldControlGroup($model,'codigo_base',array('maxlength'=>3)); ?>
    <?php echo $form->dropDownListControlGroup($model,'tipo',JHelper::getTipo(),array('maxlength'=>1)); ?>
    <?php echo $form->dropDownListControlGroup($model,'estado',JHelper::getEstadoProveedor(),array('maxlength'=>1)); ?>

    <?php echo BsHtml::submitButton('Enviar', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>

<?php $this->endWidget(); ?>
