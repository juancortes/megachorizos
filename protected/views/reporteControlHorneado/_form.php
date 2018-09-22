<?php 
/* @var $this CtrlHorneadoController */
/* @var $model CtrlHorneado */
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

        $('#fecha').change(function() {
            $.post('<?php echo Yii::app()->getBaseUrl(true) ?>/procesoEmbutido/GetTanda',
            {
                fecha:$("#fecha").val(),
            },function(res)
            {
                response = JSON.parse(res);
                //vaciar cantidad entrante
                $("#cantidad_entrante").val("");
                
                //limpiar los options
                $('option', '#tanda').remove();
                $('#tanda').append('<option value="">Seleccione una tanda</option>');
                // Add options
                $.each(response,function(index,data){
                    $('#tanda').append('<option value="'+data['id']+'">'+data['datos']+'</option>');
                });
            });
            
        });
    });

</script>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'ctrl-horneado-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); ?>

    <p class="help-block">Los campos con <span class="required">*</span> son obligatorios.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldControlGroup($model,'fecha',array('id'=>'fecha')); ?>
    <?php echo $form->dropDownListControlGroup($model, 'tanda', [], array('id' => 'tanda','empty'=>'Seleccione una tanda', 'class'=>'select select2 demo ',  'style' => 'width: 80%;'));  ?>
    <?php echo $form->textFieldControlGroup($model,'cantidad',array('maxlength'=>10)); ?>
    <?php echo $form->textFieldControlGroup($model,'averias'); ?>
    <?php echo $form->dropDownListControlGroup($model,'numero_programa',JHelper::getNumeroOpciones(), array('id' => 'numero_programa', 'class'=>'select select2 demo ',  'style' => 'width: 80%;'));  ?>
    <div class="panel panel-info">
        <div class="panel-heading"><center><strong><font color="white" size="4">Temperatura</font></strong></center></div>
        <div class="panel-body">
            <div id="div-izq">
                <?php echo $form->textFieldControlGroup($model, 'temperatura_salida',  array('id' => 'temperatura_salida', 'class'=>'demo ',  'style' => 'width: 80%;'));  ?>
            </div>
            <div id="div-con">
                <div id="div-der">  
                    <?php echo $form->textFieldControlGroup($model, 'temperatura_coccion',  array('id' => 'temperatura_coccion', 'class'=>'demo ',  'style' => 'width: 80%;'));  ?>
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-info">
        <div class="panel-heading"><center><strong><font color="white" size="4">Sostenimiento</font></strong></center></div>
        <div class="panel-body">
            <div id="div-izq">
                    <?php echo $form->textFieldControlGroup($model, 'sostenimiento_tiempo',  array('id' => 'sostenimiento_tiempo', 'class'=>'demo ',  'style' => 'width: 80%;'));  ?>
            </div>
            <div id="div-con">
                <div id="div-der">  
                    <?php echo $form->textFieldControlGroup($model, 'sostenimiento_temperatura_interna',  array('id' => 'sostenimiento_temperatura_interna', 'class'=>'demo ',  'style' => 'width: 80%;'));  ?>
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-info">
        <div class="panel-heading"><center><strong><font color="white" size="4">Características Organolepticas</font></strong></center></div>
        <div class="panel-body">
            <div id="div-izq">
                <?php echo $form->dropDownListControlGroup($model, 'caract_organoleptica_color', JHelper::getOpcion(), array('id' => 'caract_organoleptica_color', 'class'=>'select select2 demo ',  'style' => 'width: 80%;'));  ?>
            </div>
            <div id="div-con">
                <div id="div-der">  
                <?php echo $form->dropDownListControlGroup($model, 'caract_organoleptica_olor', JHelper::getOpcion(), array('id' => 'caract_organoleptica_olor', 'class'=>'select select2 demo ',  'style' => 'width: 80%;'));  ?>
                </div>
                <?php echo $form->dropDownListControlGroup($model, 'caract_organoleptica_sabor', JHelper::getOpcion(), array('id' => 'caract_organoleptica_sabor', 'class'=>'select select2 demo ',  'style' => 'width: 50%;'));  ?>
            </div>
            <?php //echo $form->textFieldControlGroup($model,'caract_organoleptica_textura'); ?>
        </div>
    </div>

    <div class="panel panel-info">
        <div class="panel-heading"><center><strong><font color="white" size="4">Características Físicas</font></strong></center></div>
        <div class="panel-body">
            <div id="div-izq">
                <?php echo $form->dropDownListControlGroup($model, 'caract_fisicas_tamano', JHelper::getOpcion(), array('id' => 'caract_fisicas_tamano', 'class'=>'select select2 demo ',  'style' => 'width: 80%;'));  ?>
            </div>
            <div id="div-con">
                <div id="div-der">  
                <?php echo $form->dropDownListControlGroup($model, 'caract_fisicas_forma', JHelper::getOpcion(), array('id' => 'caract_fisicas_forma', 'class'=>'select select2 demo ',  'style' => 'width: 80%;'));  ?>
                </div>
            </div>
        </div>
    </div>
    <?php 
        $usuario = Yii::app()->user->id;
        $user = User::model()->findByAttributes(array('username'=>$usuario));
        echo $form->hiddenField($model,'responsable_id',array('value'=>$user->id)); ?>

    <?php echo $form->textAreaControlGroup($model,'observaciones'); ?>
    <?php echo $form->textFieldControlGroup($model,'responsable',array('value'=>$user->nombres,'readonly'=>'readonly')); ?>

    <?php echo BsHtml::submitButton('Enviar', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>

<?php $this->endWidget(); ?>
