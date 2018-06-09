<?php
/* @var $this PersonalController */
/* @var $model Personal */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <?php echo $form->textFieldControlGroup($model,'id',array('maxlength'=>255)); ?>
    <?php echo $form->textFieldControlGroup($model,'nombres',array('maxlength'=>255)); ?>
    <?php echo $form->textFieldControlGroup($model,'cedula',array('maxlength'=>20)); ?>
    <?php echo $form->textFieldControlGroup($model,'correo',array('maxlength'=>255)); ?>
    <?php echo $form->textFieldControlGroup($model,'user_id'); ?>

    <div class="form-actions">
        <?php echo BsHtml::submitButton('Buscar',  array('color' => BsHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

<?php $this->endWidget(); ?>
