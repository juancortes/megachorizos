 <?php
/* @var $this RecepcionMateriaPrimaNoCarnicaController */
/* @var $model RecepcionMateriaPrimaNoCarnica */
/* @var $form BSActiveForm */
$fecha = date('Y-m-j');
$nuevafecha = strtotime ( '-15 day' , strtotime ( $fecha ) ) ;
?>
<script type="text/javascript">
$(function()
{

    <?php if(!$model->isNewRecord) {?>
        $("#insumo").html("");
        $("#insumo").fadeOut(function() {
            $("#insumo").load("<?php echo Yii::app()->getBaseUrl(true) ?>/recepcionMateriaPrimaNoCarnica/getInsumo", {
                //parametros enviados
                proveedor:$("#proveedor").val(),
            }).fadeIn();
        });
    <?php } ?>

    
    $("#fec_vencimiento").datepicker({
        changeMonth: true,
        changeYear: true,
        numberOfMonths: 1,
        showOn: "both",//button
        buttonImageOnly: false,
        showAnim: "slideDown",
        dateFormat: "yy-mm-dd",
        minDate:'<?php echo date("Y-m-d") ?>',
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

    $(".select2").select2({
        width:'resolve'
    });

    $('#proveedor').change(function()
    {
        $("#insumo").html("");
        $("#insumo").fadeOut(function() {
            $("#insumo").load("getInsumo", {
                //parametros enviados
                proveedor:$("#proveedor").val(),
            }).fadeIn();
        });
    });

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

    $("#peso_total").keydown(function (e) {
        solonumeros(e)
    });
});
</script>
<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'recepcion-materia-prima-no-carnica-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); ?>

    <p class="help-block">Los campos con <span class="required">*</span> son obligatorios.</p>

    <?php echo $form->errorSummary($model); ?>
    <?php $max = RecepcionMateriaPrimaNoCarnica::model()->findBySql('SELECT MAX(lote_interno) AS id FROM recepcion_materia_prima_no_carnica ');
        if(isset($max))
            $max = $max->id + 1;
        else
            $max = 1;
    ?>
    <?php //echo $form->hiddenField($model,'fec_ingreso',array('value'=>date('Y-m-d'))); ?>
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
                    echo $form->textFieldControlGroup($model,'lote_interno',array('maxlength'=>20,'value'=>$max,'id'=>'lote_interno','readonly'=>false)); 
                else
                    echo $form->textFieldControlGroup($model,'lote_interno',array('maxlength'=>20,'value'=>$max,'id'=>'lote_interno','readonly'=>true)); 
                ?>
        </div>    
        <div class="col-md-3">
            <?php 
                if($model->isNewRecord)
                    echo $form->textFieldControlGroup($model,'fec_vencimiento',array('id'=>'fec_vencimiento')); 
                else
                    echo $form->textFieldControlGroup($model,'fec_vencimiento',array('readonly'=>true)); 
            ?>
        </div>    
        <div class="col-md-3">
            <?php 
                if($model->isNewRecord)
                    echo $form->dropDownListControlGroup($model, 'proveedor_id', Proveedor::model()->getproveedores(1), array('id' => 'proveedor', 'class'=>'select select2 demo ',  'empty' => 'Seleccione una opción',  'style' => 'width: 80%;'));  
                else
                    echo $form->dropDownListControlGroup($model, 'proveedor_id', Proveedor::model()->getproveedores(1), array('id' => 'proveedor', 'class'=>'select select2 demo ',  'empty' => 'Seleccione una opción',  'style' => 'width: 80%;', 'disabled'=>true));  
            ?>
        </div>    
        <div class="col-md-3">
            <div id="insumo">
                
            </div>    
        </div>    
    </div>    
    <div class="row">
        <div class="col-md-3">
            <?php 
                $model->peso_total = round($model->peso_total,2);
            echo $form->textFieldControlGroup($model,'peso_total',array('maxlength'=>11,'id'=>'peso_total')); ?>
        </div>   
        <div class="col-md-3">
            <?php echo $form->dropDownListControlGroup($model, 'unidad',JHelper::getUnidad(), array('id' => 'unidad','empty'=>'Seleccione una unidad', 'value'=>'1',  'style' => 'width: 80%;'));  ?>
        </div>  
            <?php echo $form->hiddenField($model,'unidades',array('value'=>0)); ?>
        <div class="col-md-6">
            <?php 
                if($model->isNewRecord)
                    echo $form->textFieldControlGroup($model,'num_lote_externo',array('maxlength'=>100)); 
                else
                    echo $form->textFieldControlGroup($model,'num_lote_externo',array('maxlength'=>100,'readonly'=>true)); 
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
                <div class="panel-heading"><FONT FACE="arial" SIZE=4 COLOR=white><strong><center>CARACTERÍSTICAS FÍSICAS</center></strong></FONT></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4">
                            <?php 
                                if($model->isNewRecord)
                                    $model->caract_fisicas_empaque = 1;
                                echo $form->dropDownListControlGroup($model, 'caract_fisicas_empaque',JHelper::getEstado(),  array('id' => 'caract_fisicas_empaque', 'value'=>'1',  'style' => 'width: 80%;'));  ?>
                        </div>
                        <div class="col-md-4">
                            <?php 
                                if($model->isNewRecord)
                                    $model->caract_fisicas_rotulado = 1;
                                echo $form->dropDownListControlGroup($model, 'caract_fisicas_rotulado',JHelper::getEstado(),  array('id' => 'caract_fisicas_rotulado', 'value'=>'1',  'style' => 'width: 80%;'));  ?>
                        </div>
                        <div class="col-md-4">
                            <?php 
                                if($model->isNewRecord)
                                    $model->caract_fisicas_hermeticidad = 1;
                                echo $form->dropDownListControlGroup($model, 'caract_fisicas_hermeticidad',JHelper::getEstado(),  array('id' => 'caract_fisicas_hermeticidad', 'value'=>'1',  'style' => 'width: 80%;'));  ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>    
        <div class="col-md-6">
           <div class="panel panel-info">
                <div class="panel-heading"><FONT FACE="arial" SIZE=4 COLOR=white><strong><center>DEVOLUCIÓN</center></strong></FONT></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <?php 

                                echo $form->dropDownListControlGroup($model,'devolucion_si_no',JHelper::getPreguntaSiNo1(),array('maxlength'=>1, 'value'=>'0')); ?>
                        </div>
                        <div class="col-md-6">
                            <?php echo $form->textFieldControlGroup($model,'devolucion_peso_unidades',array('maxlength'=>4, 'value'=>'0')); ?>
                        </div>
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
