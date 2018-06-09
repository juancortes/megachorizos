<?php
/* @var $this AveriasController */
/* @var $model Averias */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <?php echo $form->textFieldControlGroup($model,'id',array('maxlength'=>11)); ?>
    <?php echo $form->textFieldControlGroup($model,'fecha'); ?>
    <?php echo $form->textFieldControlGroup($model,'responsable_punto',array('maxlength'=>255)); ?>
    <?php echo $form->textFieldControlGroup($model,'conductor_responsable',array('maxlength'=>255)); ?>
    <?php echo $form->textFieldControlGroup($model,'destino',array('maxlength'=>150)); ?>

    <div class="form-actions">
        <?php echo BsHtml::submitButton('Buscar',  array('color' => BsHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

<?php $this->endWidget(); ?>
