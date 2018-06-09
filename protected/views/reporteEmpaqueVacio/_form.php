<?php
/* @var $this ReporteEmpaqueVacioController */
/* @var $model ReporteEmpaqueVacio */
/* @var $form BSActiveForm */
?>
<style type="text/css">
    #div-con{
        float:right;
        width:69%;
    }
    #div-der{
        float:left;
        width:48%;
        margin-left: -16px;
    }
    #div-izq{
        float:left;
        width:29%;
    }
</style>   
<script type="text/javascript">
    $(function()
    {
        $("#fecha").datepicker({
            changeMonth: true,
            changeYear: true,
            numberOfMonths: 1,
            showOn: "both",//button
            buttonImageOnly: false,
            showAnim: "slideDown",
            dateFormat: "yy-mm-dd",
            
        });
    });

</script>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'reporte-empaque-vacio-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); ?>

    <p class="help-block">Los campos con <span class="required">*</span> son obligatorios.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldControlGroup($model,'fecha',array('id'=>'fecha')); ?>
    <?php echo $form->dropDownListControlGroup($model, 'producto', ReporteControlHorneado::model()->getTandaProducto(), array('id' => 'producto', 'class'=>'select select2 demo ',  'style' => 'width: 80%;'));  ?>
    <?php echo $form->dropDownListControlGroup($model, 'referencia', JHelper::getRefencia(), array('id' => 'referencia', 'class'=>'select select2 demo ',  'style' => 'width: 80%;'));  ?>
    <?php echo $form->textFieldControlGroup($model,'total_paquetes',array('class' => 'soloNumeros')); ?>
    <?php echo $form->textFieldControlGroup($model,'peso',array('class' => 'soloNumeros')); ?>
    <?php echo $form->textFieldControlGroup($model,'numero_lote',array('maxlength'=>100)); ?>
    <div class="panel panel-info">
        <div class="panel-heading">Características Físicas</div>
        <div class="panel-body">
            <div id="div-izq">
                <?php echo $form->dropDownListControlGroup($model, 'carac_fisicas_color', JHelper::getOpcion(), array('id' => 'carac_fisicas_color', 'class'=>'select select2 demo ',  'style' => 'width: 80%;'));  ?>
            </div>
            <div id="div-con">
                <div id="div-der">  
                <?php echo $form->dropDownListControlGroup($model, 'carac_fisicas_olor', JHelper::getOpcion(), array('id' => 'carac_fisicas_olor', 'class'=>'select select2 demo ',  'style' => 'width: 80%;'));  ?>
                <?php echo $form->dropDownListControlGroup($model, 'carac_fisicas_tamano', JHelper::getOpcion(), array('id' => 'carac_fisicas_tamano', 'class'=>'select select2 demo ',  'style' => 'width: 80%;'));  ?>
                </div>
                <?php echo $form->dropDownListControlGroup($model, 'carac_fisicas_forma', JHelper::getOpcion(), array('id' => 'carac_fisicas_forma', 'class'=>'select select2 demo ',  'style' => 'width: 50%;'));  ?>
            </div>

            <div id="div-izq">
                <?php echo $form->dropDownListControlGroup($model, 'carac_fisicas_exur', JHelper::getOpcion(), array('id' => 'carac_fisicas_exur', 'class'=>'select select2 demo ',  'style' => 'width: 80%;'));  ?>
            </div>
            
        </div>
    </div>
    <?php 
        $usuario = Yii::app()->user->id;
        $user = User::model()->findByAttributes(array('username'=>$usuario));
        echo $form->hiddenField($model,'responsable_id',array('value'=>$user->id)); ?>

    <?php echo $form->textFieldControlGroup($model,'responsable',array('value'=>$user->nombres,'readonly'=>'readonly')); ?>
    <?php echo BsHtml::submitButton('Enviar', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>

<?php $this->endWidget(); ?>
