<?php
/* @var $this FormulacionController */
/* @var $model Formulacion */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <?php echo $form->textFieldControlGroup($model,'id',array('maxlength'=>11)); ?>
    <?php echo $form->textFieldControlGroup($model,'producto_id',array('maxlength'=>11)); ?>
    <?php echo $form->textFieldControlGroup($model,'materia_prima',array('maxlength'=>150)); ?>
    <?php echo $form->textFieldControlGroup($model,'peso',array('maxlength'=>10)); ?>

    <div class="form-actions">
        <?php echo BsHtml::submitButton('Buscar',  array('color' => BsHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

<?php $this->endWidget(); ?>
