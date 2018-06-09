<?php
/* @var $this ProveedorController */
/* @var $model Proveedor */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <?php echo $form->textFieldControlGroup($model,'id',array('maxlength'=>11)); ?>
    <?php echo $form->textFieldControlGroup($model,'nom_proveedor',array('maxlength'=>100)); ?>
    <?php echo $form->textFieldControlGroup($model,'tipo_proveedor',array('maxlength'=>1)); ?>
    <?php echo $form->textFieldControlGroup($model,'correo',array('maxlength'=>255)); ?>
    <?php echo $form->textFieldControlGroup($model,'celular',array('maxlength'=>30)); ?>
    <?php echo $form->textFieldControlGroup($model,'direccion',array('maxlength'=>255)); ?>
    <?php echo $form->textFieldControlGroup($model,'tipo_doc',array('maxlength'=>1)); ?>
    <?php echo $form->textFieldControlGroup($model,'cedula',array('maxlength'=>50)); ?>
    <?php echo $form->textFieldControlGroup($model,'municipio_id',array('maxlength'=>8)); ?>
    <?php echo $form->textFieldControlGroup($model,'codigo_base',array('maxlength'=>3)); ?>
    <?php echo $form->textFieldControlGroup($model,'tipo',array('maxlength'=>1)); ?>

    <div class="form-actions">
        <?php echo BsHtml::submitButton('Buscar',  array('color' => BsHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

<?php $this->endWidget(); ?>
