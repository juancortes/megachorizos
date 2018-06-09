<?php
/* @var $this RecepcionMateriaPrimaNoCarnicaController */
/* @var $model RecepcionMateriaPrimaNoCarnica */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <?php echo $form->textFieldControlGroup($model,'id',array('maxlength'=>11)); ?>
    <?php echo $form->textFieldControlGroup($model,'fec_ingreso'); ?>
    <?php echo $form->textFieldControlGroup($model,'lote_interno',array('maxlength'=>20)); ?>
    <?php echo $form->textFieldControlGroup($model,'fec_vencimiento'); ?>
    <?php echo $form->textFieldControlGroup($model,'proveedor_id',array('maxlength'=>11)); ?>
    <?php echo $form->textFieldControlGroup($model,'materia_prima_insumo',array('maxlength'=>100)); ?>
    <?php echo $form->textFieldControlGroup($model,'peso_total',array('maxlength'=>11)); ?>
    <?php echo $form->textFieldControlGroup($model,'unidades'); ?>
    <?php echo $form->textFieldControlGroup($model,'num_lote_externo',array('maxlength'=>100)); ?>
    <?php echo $form->textFieldControlGroup($model,'caract_fisicas_empaque',array('maxlength'=>1)); ?>
    <?php echo $form->textFieldControlGroup($model,'caract_fisicas_rotulado',array('maxlength'=>1)); ?>
    <?php echo $form->textFieldControlGroup($model,'devolucion_si_no',array('maxlength'=>1)); ?>
    <?php echo $form->textFieldControlGroup($model,'devolucion_peso_unidades',array('maxlength'=>4)); ?>
    <?php echo $form->textFieldControlGroup($model,'recibido'); ?>

    <div class="form-actions">
        <?php echo BsHtml::submitButton('Buscar',  array('color' => BsHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

<?php $this->endWidget(); ?>
