<?php
/* @var $this SeccionarOrderProdccionController */
/* @var $model SeccionarOrderProdccion */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <?php echo $form->textFieldControlGroup($model,'id',array('maxlength'=>10)); ?>
    <?php echo $form->textFieldControlGroup($model,'fecha_sistema'); ?>
    <?php echo $form->textFieldControlGroup($model,'orden_produccion_id',array('maxlength'=>10)); ?>
    <?php echo $form->textFieldControlGroup($model,'producto_id',array('maxlength'=>10)); ?>
    <?php echo $form->textFieldControlGroup($model,'peso_total',array('maxlength'=>10)); ?>
    <?php echo $form->textFieldControlGroup($model,'peso_unidad',array('maxlength'=>10)); ?>
    <?php echo $form->textFieldControlGroup($model,'longitud',array('maxlength'=>10)); ?>
    <?php echo $form->textFieldControlGroup($model,'estado'); ?>
    <?php echo $form->textFieldControlGroup($model,'user_id'); ?>

    <div class="form-actions">
        <?php echo BsHtml::submitButton('Search',  array('color' => BsHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

<?php $this->endWidget(); ?>
