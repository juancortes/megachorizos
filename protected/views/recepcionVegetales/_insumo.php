<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'recepcion-vegetales-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); ?>


	
    <?php echo $form->dropDownListControlGroup($model, 'materia_prima_insumo', Insumo::model()->getInsumo2(2,$prov->id), array('id' => 'insumo', 'class'=>'select select2 demo ',  'empty' => 'Seleccione una opción',  'style' => 'width: 80%;'));  ?>

<?php $this->endWidget(); ?>