<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'recepcion-materia-prima-carnica-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); ?> 
    
    <div class="col-md-3">
	    <?php echo $form->dropDownListControlGroup($model, 'tanda', CtrlProduccionesTrazabilidad::model()->getTanda($ordenProduccion), array('id' => 'tanda', 'class'=>'select select2 demo ',  'empty' => 'Seleccione una opción',  'style' => 'width: 80%;','onclick'=>'calcularValor(this)'));  ?>
    </div><br><br><br><br>
<?php $this->endWidget(); ?>
