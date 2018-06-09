<?php
/* @var $this ProveedorInsumoController */
/* @var $model ProveedorInsumo */
/* @var $form BSActiveForm */
?>
<script type="text/javascript">

    $(function()
    {

        $(".select2").select2({
            width:'resolve'
        });
    });
</script>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'proveedor-insumo-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); ?>

    <p class="help-block">Los campos con <span class="required">*</span> son obligatorios.</p>

    <?php echo $form->errorSummary($model); ?> 

    <?php echo $form->dropDownListControlGroup($model,'proveedor_id',Proveedor::model()->getproveedor(),array('maxlength'=>1, 'class'=>'select2')); ?>
    <?php echo $form->dropDownListControlGroup($model,'insumo_id',Insumo::model()->getInsumos(),array('maxlength'=>1, 'class'=>'select2')); ?>
    <?php echo $form->textFieldControlGroup($model,'cantidad',array('maxlength'=>10)); ?>

    <?php echo BsHtml::submitButton('Enviar', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>

<?php $this->endWidget(); ?>
