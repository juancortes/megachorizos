<?php
/* @var $this ProveedorInsumoController */
/* @var $model ProveedorInsumo */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <?php echo $form->textFieldControlGroup($model,'id',array('maxlength'=>11)); ?>
    <?php echo $form->textFieldControlGroup($model,'insumo_id',array('maxlength'=>11)); ?>
    <?php echo $form->textFieldControlGroup($model,'proveedor_id',array('maxlength'=>11)); ?>
    <?php echo $form->textFieldControlGroup($model,'cantidad',array('maxlength'=>10)); ?>

    <div class="form-actions">
        <?php echo BsHtml::submitButton('Buscar',  array('color' => BsHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

<?php $this->endWidget(); ?>
