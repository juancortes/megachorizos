<?php
/* @var $this CtrlHorneadoController */
/* @var $model CtrlHorneado */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <?php echo $form->textFieldControlGroup($model,'id',array('maxlength'=>11)); ?>
    <?php echo $form->textFieldControlGroup($model,'fecha'); ?>
    <?php echo $form->textFieldControlGroup($model,'tanda'); ?>
    <?php echo $form->textFieldControlGroup($model,'producto',array('maxlength'=>255)); ?>
    <?php echo $form->textFieldControlGroup($model,'cantidad',array('maxlength'=>10)); ?>
    <?php echo $form->textFieldControlGroup($model,'averias'); ?>
    <?php echo $form->textFieldControlGroup($model,'codigo_reproceso',array('maxlength'=>100)); ?>
    <?php echo $form->textFieldControlGroup($model,'num_programa'); ?>
    <?php echo $form->textFieldControlGroup($model,'temperatura_salida',array('maxlength'=>10)); ?>
    <?php echo $form->textFieldControlGroup($model,'temperatura_coccion',array('maxlength'=>10)); ?>
    <?php echo $form->textFieldControlGroup($model,'sostenimiento_tiempo'); ?>
    <?php echo $form->textFieldControlGroup($model,'sostenimiento_temperatura_interna',array('maxlength'=>10)); ?>
    <?php echo $form->textFieldControlGroup($model,'caract_organolepticas_color'); ?>
    <?php echo $form->textFieldControlGroup($model,'caract_organolepticas_olor'); ?>
    <?php echo $form->textFieldControlGroup($model,'caract_organolepticas_sabor'); ?>
    <?php echo $form->textFieldControlGroup($model,'caract_organolepticas_temperatura'); ?>
    <?php echo $form->textFieldControlGroup($model,'caract_fisicas_tamano'); ?>
    <?php echo $form->textFieldControlGroup($model,'caract_fisicas_forma'); ?>
    <?php echo $form->textFieldControlGroup($model,'responsable',array('maxlength'=>150)); ?>

    <div class="form-actions">
        <?php echo BsHtml::submitButton('Buscar',  array('color' => BsHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

<?php $this->endWidget(); ?>
