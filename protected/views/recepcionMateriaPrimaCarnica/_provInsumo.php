<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'recepcion-materia-prima-carnica-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); ?>
 
    <div class="col-md-3">
		<?php echo $form->textFieldControlGroup($model, 'prov',  array('id' => 'proveedor','value'=>$prov->nom_proveedor,'readonly'=>'readonly' ,'style' => 'width: 80%;'));  ?>
		<?php echo $form->hiddenField($model, 'proveedor',  array('id' => 'proveedor','value'=>$prov->id ,'style' => 'width: 80%;'));  ?>
    </div>
    <div class="col-md-3">
	    <?php echo $form->dropDownListControlGroup($model, 'materia_prima_insumo', Insumo::model()->getInsumo2(0,$prov->id), array('id' => 'insumo', 'class'=>'select select2 demo ',  'empty' => 'Seleccione una opción',  'style' => 'width: 80%;'));  ?>
    </div>
<?php $this->endWidget(); ?>
