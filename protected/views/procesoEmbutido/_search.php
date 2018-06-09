<?php
/* @var $this ProcesoEmbutidoController */
/* @var $model ProcesoEmbutido */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <?php echo $form->textFieldControlGroup($model,'id'); ?>
    <?php echo $form->textFieldControlGroup($model,'fecha'); ?>
    <?php echo $form->textFieldControlGroup($model,'tanda'); ?>
    <?php echo $form->textFieldControlGroup($model,'cantidad_entrante'); ?>
    <?php echo $form->textFieldControlGroup($model,'averias_totales'); ?>
    <?php echo $form->textFieldControlGroup($model,'observaciones',array('maxlength'=>200)); ?>

    <div class="form-actions">
        <?php echo BsHtml::submitButton('Search',  array('color' => BsHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

<?php $this->endWidget(); ?>
