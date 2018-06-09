<?php
/* @var $this FormulaEstimadoController */
/* @var $model FormulaEstimado */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <?php echo $form->textFieldControlGroup($model,'id'); ?>
    <?php echo $form->textFieldControlGroup($model,'fecha'); ?>
    <?php echo $form->textFieldControlGroup($model,'producto_id',array('maxlength'=>10)); ?>
    <?php echo $form->textFieldControlGroup($model,'peso'); ?>
    <?php echo $form->textFieldControlGroup($model,'longitud'); ?>
    <?php echo $form->textFieldControlGroup($model,'insumo_id',array('maxlength'=>10)); ?>

    <div class="form-actions">
        <?php echo BsHtml::submitButton('Search',  array('color' => BsHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

<?php $this->endWidget(); ?>
