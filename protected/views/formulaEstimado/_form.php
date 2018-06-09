<?php
/* @var $this FormulaEstimadoController */
/* @var $model FormulaEstimado */
/* @var $form BSActiveForm */
?>
<script type="text/javascript">
    $(document).ready(function() 
    {
        $(".select2").select2({
            width:'resolve'
        });
    });
</script>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'formula-estimado-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->dropDownListControlGroup($model,'insumo_id',array('267'=>'Colageno','270'=>'Tripa'),  
                        array('id'=>'insumo',                         
                            'prompt' => 'Seleccione un insumo...',
                            'class'=>'select2' )); ?>
    <?php echo $form->dropDownListControlGroup($model,'producto_id',CHtml::listData(Producto::model()->findAll(array('order' => 'nombre')),'id','nombre'),  
                        array('id'=>'producto_id',                         
                            'prompt' => 'Seleccione un producto...',
                            'class'=>'select2' )); ?>
    <?php echo $form->textFieldControlGroup($model,'peso'); ?>
    <?php echo $form->textFieldControlGroup($model,'longitud'); ?>

    <?php echo BsHtml::submitButton('Submit', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>

<?php $this->endWidget(); ?>
