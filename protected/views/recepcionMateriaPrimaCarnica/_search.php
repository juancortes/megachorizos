<?php
/* @var $this RecepcionMateriaPrimaCarnicaController */
/* @var $model RecepcionMateriaPrimaCarnica */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <?php echo $form->textFieldControlGroup($model,'id',array('maxlength'=>11)); ?>
    <?php echo $form->textFieldControlGroup($model,'fec_ingreso'); ?>
    <?php echo $form->textFieldControlGroup($model,'lote_interno',array('maxlength'=>100)); ?>
    <?php echo $form->textFieldControlGroup($model,'proveedor',array('maxlength'=>11)); ?>
    <?php echo $form->textFieldControlGroup($model,'materia_prima_insumo',array('maxlength'=>100)); ?>
    <?php echo $form->textFieldControlGroup($model,'peso',array('maxlength'=>4)); ?>
    <?php echo $form->textFieldControlGroup($model,'temperatura_llegada',array('maxlength'=>2)); ?>
    <?php echo $form->textFieldControlGroup($model,'carct_orgleptica_color',array('maxlength'=>1)); ?>
    <?php echo $form->textFieldControlGroup($model,'carct_orgleptica_olor',array('maxlength'=>1)); ?>
    <?php echo $form->textFieldControlGroup($model,'carct_orgleptica_c_temperatura',array('maxlength'=>1)); ?>
    <?php echo $form->textFieldControlGroup($model,'hgiene_vehiculo',array('maxlength'=>1)); ?>
    <?php echo $form->textFieldControlGroup($model,'hgiene_canastas',array('maxlength'=>1)); ?>
    <?php echo $form->textFieldControlGroup($model,'conductor_dotacion',array('maxlength'=>1)); ?>
    <?php echo $form->textFieldControlGroup($model,'conductor_higiene',array('maxlength'=>1)); ?>
    <?php echo $form->textFieldControlGroup($model,'devolucion_si_no',array('maxlength'=>1)); ?>
    <?php echo $form->textFieldControlGroup($model,'devolucion_peso',array('maxlength'=>1)); ?>
    <?php echo $form->textFieldControlGroup($model,'recibido'); ?>

    <div class="form-actions">
        <?php echo BsHtml::submitButton('Buscar',  array('color' => BsHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

<?php $this->endWidget(); ?>
