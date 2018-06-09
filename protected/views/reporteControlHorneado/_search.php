<?php
/* @var $this ReporteControlHorneadoController */
/* @var $model ReporteControlHorneado */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <?php echo $form->textFieldControlGroup($model,'id',array('maxlength'=>11)); ?>
    <?php echo $form->textFieldControlGroup($model,'fecha'); ?>
    <?php echo $form->textFieldControlGroup($model,'tanda'); ?>
    <?php echo $form->textFieldControlGroup($model,'producto',array('maxlength'=>100)); ?>
    <?php echo $form->textFieldControlGroup($model,'cantidad',array('maxlength'=>11)); ?>
    <?php echo $form->textFieldControlGroup($model,'averias'); ?>
    <?php echo $form->textFieldControlGroup($model,'codigo_reproceso',array('maxlength'=>50)); ?>
    <?php echo $form->textFieldControlGroup($model,'numero_programa',array('maxlength'=>2)); ?>
    <?php echo $form->textFieldControlGroup($model,'temperatura_salida',array('maxlength'=>11)); ?>
    <?php echo $form->textFieldControlGroup($model,'temperatura_coccion',array('maxlength'=>11)); ?>
    <?php echo $form->textFieldControlGroup($model,'sostenimiento_tiempo',array('maxlength'=>11)); ?>
    <?php echo $form->textFieldControlGroup($model,'sostenimiento_temperatura_interna',array('maxlength'=>11)); ?>
    <?php echo $form->textFieldControlGroup($model,'caract_organoleptica_color',array('maxlength'=>2)); ?>
    <?php echo $form->textFieldControlGroup($model,'caract_organoleptica_olor',array('maxlength'=>2)); ?>
    <?php echo $form->textFieldControlGroup($model,'caract_organoleptica_sabor',array('maxlength'=>2)); ?>
    <?php echo $form->textFieldControlGroup($model,'caract_organoleptica_textura',array('maxlength'=>2)); ?>
    <?php echo $form->textFieldControlGroup($model,'caract_fisicas_tamano',array('maxlength'=>2)); ?>
    <?php echo $form->textFieldControlGroup($model,'caract_fisicas_forma',array('maxlength'=>2)); ?>
    <?php echo $form->textFieldControlGroup($model,'responsable_id'); ?>

    <div class="form-actions">
        <?php echo BsHtml::submitButton('Buscar',  array('color' => BsHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

<?php $this->endWidget(); ?>
