<?php
/* @var $this RecepcionVegetalesController */
/* @var $model RecepcionVegetales */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <?php echo $form->textFieldControlGroup($model,'id'); ?>
    <?php echo $form->textFieldControlGroup($model,'fecha_lote'); ?>
    <?php echo $form->textFieldControlGroup($model,'lote_interno'); ?>
    <?php echo $form->textFieldControlGroup($model,'fec_vencimiento'); ?>
    <?php echo $form->textFieldControlGroup($model,'proveedor_id',array('maxlength'=>10)); ?>
    <?php echo $form->textFieldControlGroup($model,'materia_prima_insumo',array('maxlength'=>10)); ?>
    <?php echo $form->textFieldControlGroup($model,'peso_total',array('maxlength'=>10)); ?>
    <?php echo $form->textFieldControlGroup($model,'unidades'); ?>
    <?php echo $form->textFieldControlGroup($model,'num_lote_externo',array('maxlength'=>100)); ?>
    <?php echo $form->textFieldControlGroup($model,'caract_fisicas_color',array('maxlength'=>1)); ?>
    <?php echo $form->textFieldControlGroup($model,'caract_fisicas_olor',array('maxlength'=>1)); ?>
    <?php echo $form->textFieldControlGroup($model,'caract_fisicas_textura',array('maxlength'=>1)); ?>
    <?php echo $form->textFieldControlGroup($model,'caract_fisicas_limpieza',array('maxlength'=>1)); ?>
    <?php echo $form->textFieldControlGroup($model,'recibido'); ?>
    <?php echo $form->textFieldControlGroup($model,'observaciones',array('maxlength'=>255)); ?>

    <div class="form-actions">
        <?php echo BsHtml::submitButton('Search',  array('color' => BsHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

<?php $this->endWidget(); ?>
