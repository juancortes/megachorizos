<?php
/* @var $this ReporteEmpaqueVacioController */
/* @var $model ReporteEmpaqueVacio */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <?php echo $form->textFieldControlGroup($model,'id',array('maxlength'=>11)); ?>
    <?php echo $form->textFieldControlGroup($model,'fecha'); ?>
    <?php echo $form->textFieldControlGroup($model,'producto',array('maxlength'=>100)); ?>
    <?php echo $form->textFieldControlGroup($model,'total_paquetes'); ?>
    <?php echo $form->textFieldControlGroup($model,'peso'); ?>
    <?php echo $form->textFieldControlGroup($model,'numero_lote',array('maxlength'=>100)); ?>
    <?php echo $form->textFieldControlGroup($model,'carac_fisicas_color',array('maxlength'=>2)); ?>
    <?php echo $form->textFieldControlGroup($model,'carac_fisicas_olor',array('maxlength'=>2)); ?>
    <?php echo $form->textFieldControlGroup($model,'carac_fisicas_tamano',array('maxlength'=>2)); ?>
    <?php echo $form->textFieldControlGroup($model,'carac_fisicas_forma',array('maxlength'=>2)); ?>
    <?php echo $form->textFieldControlGroup($model,'carac_fisicas_exur',array('maxlength'=>2)); ?>
    <?php echo $form->textFieldControlGroup($model,'responsable_id'); ?>

    <div class="form-actions">
        <?php echo BsHtml::submitButton('Buscar',  array('color' => BsHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

<?php $this->endWidget(); ?>
