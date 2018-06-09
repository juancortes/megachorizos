<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'user-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); ?>

    <p class="help-block">Los campos con <span class="required">*</span> son obligatorios.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldControlGroup($model,'username',array('maxlength'=>45)); ?>
    <?php echo $form->passwordFieldControlGroup($model,'password',array('maxlength'=>254)); ?>
    <?php echo $form->textFieldControlGroup($model,'nombres',array('maxlength'=>500)); ?>

    <?php echo BsHtml::submitButton('Enviar', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>
  
<?php $this->endWidget(); ?>
