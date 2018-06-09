<?php
/* @var $this RecepcionMateriaPrimaCarnicaController */
/* @var $model RecepcionMateriaPrimaCarnica */
/* @var $form BSActiveForm */

$fecha = date('Y-m-j');
$nuevafecha = strtotime ( '-30 day' , strtotime ( $fecha ) ) ;
$nuevafecha = date ( 'Y-m-j' , $nuevafecha );

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
            /*$("#factura_interna").keypress(function(e)
            {
                var code = e.which || e.keyCode;
                // 65 - 90 for A-Z and 97 - 122 for a-z 95 for _ 45 for - 46 for .
                if (!((code >= 65 && code <= 90) || (code >= 97 && code <= 122) || code == 95 || code == 46 || code == 45))
                {
                    var text = $("#factura_interna").val();
                    text = text.substring(0,text.length);
                    $("#factura_interna").val(text);
                }
            });*/

            <?php if(!$model->isNewRecord) {?>
                $("#prov_insumo").html("");
                $("#prov_insumo").fadeOut(function() {
                    $("#prov_insumo").load("<?php echo Yii::app()->getBaseUrl(true) ?>/recepcionMateriaPrimaCarnica/getProvInsumo", {
                        //parametros enviados
                        lote_interno:$("#lote_interno").val(),
                    }).fadeIn();
                });
            <?php } ?>

        $("#factura_interna").keydown(function (e) {
            // Allow: backspace, delete, tab, escape and enter
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
                 // Allow: Ctrl+A
                (e.keyCode == 65 && e.ctrlKey === true) || 
                 // Allow: home, end, left, right
                (e.keyCode >= 35 && e.keyCode <= 39)) {
                     // let it happen, don't do anything
                     return;
            }
            //alert(e.keyCode);
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                if((e.keyCode < 64 || e.keyCode > 90))
                {
                    e.preventDefault();
                }
            }
        });

        $("#factura_externa").keydown(function (e) {
            // Allow: backspace, delete, tab, escape and enter
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
                 // Allow: Ctrl+A
                (e.keyCode == 65 && e.ctrlKey === true) || 
                 // Allow: home, end, left, right
                (e.keyCode >= 35 && e.keyCode <= 39)) {
                     // let it happen, don't do anything
                     return;
            }
            //alert(e.keyCode);
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                if((e.keyCode < 64 || e.keyCode > 90))
                {
                    e.preventDefault();
                }
            }
        });

        $("#fec_ingreso").datepicker({
            changeMonth: true,
            changeYear: true,
            numberOfMonths: 1,
            showOn: "both",//button
            buttonImageOnly: false,
            showAnim: "slideDown",
            dateFormat: "yy-mm-dd",
            minDate:'<?php echo $nuevafecha ?>',
        });

        $("#fecha_vencimiento").datepicker({
            changeMonth: true,
            changeYear: true,
            numberOfMonths: 1,
            showOn: "both",//button
            buttonImageOnly: false,
            showAnim: "slideDown",
            dateFormat: "yy-mm-dd",
            minDate:'<?php echo date('Y-m-d') ?>',
        });

        

        $(".select2").select2({
            width:'resolve'
        });

        
        $('#insumo').change(function()
        {
            if($('#insumo').val() == "")
            {
                
            }
        });

        $('#lote_interno').change(function()
        {
            $("#prov_insumo").html("");
            $("#prov_insumo").fadeOut(function() {
                $("#prov_insumo").load("<?php echo Yii::app()->getBaseUrl(true) ?>/recepcionMateriaPrimaCarnica/getProvInsumo", {
                    //parametros enviados
                    lote_interno:$("#lote_interno").val(),
                }).fadeIn();
            });

            $.post('<?php echo Yii::app()->getBaseUrl(true) ?>/recepcionMateriaPrimaCarnica/cargarConsecutivo',
            {
                lote_interno:$("#lote_interno").val(),
            },function(res)
            {
                $("#lote_interno").val(res);
            });
        });

        $("#peso").keydown(function (e) {
            solonumeros(e)
        });

        $("#unidad").keydown(function (e) {
            solonumeros(e)
        });

    });


</script>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'recepcion-materia-prima-carnica-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); ?>
 
    <p class="help-block">Los campos con <span class="required">*</span> son obligatorios.</p>

    <?php echo $form->errorSummary($model); ?>
    <div class="row">
        <div class="col-md-3">
            <?php
                if($model->isNewRecord)
                    echo $form->textFieldControlGroup($model,'fec_ingreso',array('id'=>'fec_ingreso')); 
                else
                    echo $form->textFieldControlGroup($model,'fec_ingreso',array('readonly'=>'readonly')); 
            ?>
        </div> 
        <div class="col-md-3">
            <?php 
                if($model->isNewRecord)
                    echo $form->textFieldControlGroup($model,'lote_interno',array('maxlength'=>100,'id'=>'lote_interno')); 
                else
                    echo $form->textFieldControlGroup($model,'lote_interno',array('readonly'=>true,'id'=>'lote_interno')); 

            ?>
        </div> 
        <div class="col-md-3">
            <?php 
                if($model->isNewRecord)
                    echo $form->textFieldControlGroup($model,'lote_externo',array('maxlength'=>100,'id'=>'lote_externo')); 
                else
                    echo $form->textFieldControlGroup($model,'lote_externo',array('readonly'=>true,'id'=>'lote_externo')); 

            ?>
        </div> 
        <div class="col-md-3">
            <?php 
                if($model->isNewRecord)
                    echo $form->textFieldControlGroup($model,'fecha_vencimiento',array('maxlength'=>100,'id'=>'fecha_vencimiento')); 
                else
                    echo $form->textFieldControlGroup($model,'fecha_vencimiento',array('readonly'=>true)); 

            ?>
        </div> 
       
    </div>
    <div class="row">
            <div id="prov_insumo">
            
            </div> 
    </div>
    <div class="row">
        <div class="col-md-3">
            <?php 
                $model->peso = round($model->peso,2);
                echo $form->textFieldControlGroup($model,'peso',array('maxlength'=>6,'id'=>'peso')); ?>
        </div> 
        <div class="col-md-3">
            <?php echo $form->dropDownListControlGroup($model, 'unidad',JHelper::getUnidad(), array('id' => 'unidad','empty'=>'Seleccione una unidad', 'value'=>'1',  'style' => 'width: 80%;'));  ?>
        </div> 
        <div class="col-md-6">
            <?php 
                if($model->isNewRecord)
                    echo $form->textFieldControlGroup($model,'temperatura_llegada',array('maxlength'=>6)); 
                else
                    echo $form->textFieldControlGroup($model,'temperatura_llegada',array('maxlength'=>6,'readonly'=>true)); 
            ?>
        </div> 
    </div>
    <div class="row">
        <div class="col-md-6">
            <?php 
                if($model->isNewRecord)
                    echo $form->textFieldControlGroup($model, 'factura_interna',array('id'=>'factura_interna'));  
                else
                    echo $form->textFieldControlGroup($model, 'factura_interna',array('id'=>'factura_interna','readonly'=>true));  

            ?>
        </div> 
        <div class="col-md-6">
            <?php 
                if($model->isNewRecord)
                    echo $form->textFieldControlGroup($model,'factura_externa',array('maxlength'=>6)); 
                else
                    echo $form->textFieldControlGroup($model,'factura_externa',array('maxlength'=>6,'readonly'=>true)); 
            ?>
        </div> 
    </div>
    
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading"><FONT FACE="arial" SIZE=4 COLOR=white><strong><center>HIGIENE</center></strong></FONT></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <?php
                                if($model->isNewRecord)
                                    $model->hgiene_vehiculo = 1; 
                                echo $form->dropDownListControlGroup($model, 'hgiene_vehiculo',JHelper::getEstado(), array('id' => 'hgiene_vehiculo', 'value'=>'1',  'style' => 'width: 80%;'));  ?>
                        </div>
                        <div class="col-md-6">
                        <?php 
                            if($model->isNewRecord)
                                $model->hgiene_canastas = 1;
                            echo $form->dropDownListControlGroup($model, 'hgiene_canastas',JHelper::getEstado(), array('id' => 'hgiene_canastas', 'value'=>'1',  'style' => 'width: 80%;'));  ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading"><FONT FACE="arial" SIZE=4 COLOR=white><strong><center>CONDUCTOR</center></strong></FONT></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <?php 
                                if($model->isNewRecord)
                                    $model->conductor_dotacion = 1;
                                echo $form->dropDownListControlGroup($model, 'conductor_dotacion',JHelper::getEstado(), array('id' => 'conductor_dotacion', 'value'=>'1',  'style' => 'width: 80%;'));  ?>
                        </div>
                        <div class="col-md-6">
                            <?php 
                                if($model->isNewRecord)
                                    $model->conductor_higiene = 1;
                                echo $form->dropDownListControlGroup($model, 'conductor_higiene',JHelper::getEstado(),  array('id' => 'conductor_higiene', 'value'=>'1',  'style' => 'width: 80%;'));  ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading"><FONT FACE="arial" SIZE=4 COLOR=white><strong><center>DEVOLUCIÓN</center></strong></FONT></div>
                <div class="panel-body">
                        <div class="col-md-6">
                            <?php echo $form->dropDownListControlGroup($model,'devolucion_si_no',JHelper::getPreguntaSiNo1(),array('maxlength'=>1, 'value'=>'0')); ?>
                        </div>
                        <div class="col-md-6">
                            <?php echo $form->textFieldControlGroup($model,'devolucion_peso',array('maxlength'=>4, 'value'=>'0')); ?>
                        </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading"><FONT FACE="arial" SIZE=4 COLOR=white><strong><center>EMPAQUE</center></strong></FONT></div>
                <div class="panel-body">
                        <div class="col-md-6">
                            <?php echo $form->dropDownListControlGroup($model,'empaque_fecha_vencimiento',JHelper::getPreguntaSiNo1(),array('maxlength'=>1, 'value'=>'0')); ?>
                        </div>
                        <div class="col-md-6">
                            <?php echo $form->dropDownListControlGroup($model,'empaque_condicion',JHelper::getPreguntaSiNo1(),array('maxlength'=>1, 'value'=>'0')); ?>
                        </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php echo $form->textAreaControlGroup($model,'observaciones',array('maxlength'=>255)); ?>
    
    <?php 
        $usuario = Yii::app()->user->id;
        $user = User::model()->findByAttributes(array('username'=>$usuario));
        echo $form->hiddenField($model,'recibido',array('value'=>$user->id)); ?>

    <?php echo $form->textFieldControlGroup($model,'recibido1',array('value'=>$user->nombres,'readonly'=>'readonly')); ?>

    <?php echo BsHtml::submitButton('Enviar', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>

<?php $this->endWidget(); ?>
