<?php
/* @var $this ClientesController */
/* @var $model Clientes */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <?php echo $form->textFieldControlGroup($model,'id',array('maxlength'=>11)); ?>
    <?php echo $form->textFieldControlGroup($model,'nombre',array('maxlength'=>255)); ?>
    <?php echo $form->textFieldControlGroup($model,'direccion',array('maxlength'=>255)); ?>
    <?php echo $form->textFieldControlGroup($model,'telefono',array('maxlength'=>255)); ?>
    <?php echo $form->textFieldControlGroup($model,'celular',array('maxlength'=>255)); ?>
    <?php echo $form->textFieldControlGroup($model,'email',array('maxlength'=>255)); ?>

    <div class="form-actions">
        <?php echo BsHtml::submitButton('Buscar',  array('color' => BsHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

<?php $this->endWidget(); ?>
