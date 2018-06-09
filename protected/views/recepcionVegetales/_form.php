<?php
/* @var $this RecepcionVegetalesController */
/* @var $model RecepcionVegetales */
/* @var $form BSActiveForm */

$fecha = date('Y-m-j');
$nuevafecha = strtotime ( '-30 day' , strtotime ( $fecha ) ) ;
$nuevafecha = date ( 'Y-m-j' , $nuevafecha );
?>
<script type="text/javascript">
    $(function()
    {
        $("#fecha_lote").datepicker({
            changeMonth: true,
            changeYear: true,
            numberOfMonths: 1,
            showOn: "both",//button
            buttonImageOnly: false,
            showAnim: "slideDown",
            dateFormat: "yy-mm-dd",
            minDate:'<?php echo $nuevafecha ?>',
        });

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

        $(".select2").select2({
            width:'resolve'
        });

        $('#proveedor_id').change(function()
        {
            $("#insumo").html("");
            $("#insumo").fadeOut(function() {
                $("#insumo").load("getInsumo", {
                    //parametros enviados
                    proveedor:$("#proveedor_id").val(),
                }).fadeIn();
            });
        });
    });
</script>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'recepcion-vegetales-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); ?>
 <?php $max = RecepcionVegetales::model()->findBySql('SELECT MAX(lote_interno) AS id FROM recepcion_vegetales');
        if(isset($max))
            $max = $max->id + 1;
        else
            $max = 1;
    ?>
    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <div class="col-md-3">
            <?php 
                if($model->isNewRecord)
                    echo $form->textFieldControlGroup($model,'fecha_lote',array('id'=>'fecha_lote')); 
                else
                    echo $form->textFieldControlGroup($model,'fecha_lote',array('readonly'=>'readonly')); 
            ?>
        </div>   
        <div class="col-md-3">
            <?php 
                if($model->isNewRecord)
                    echo $form->textFieldControlGroup($model,'lote_interno',array('value'=>$max,'readonly'=>true)); 
                else
                    echo $form->textFieldControlGroup($model,'lote_interno',array('readonly'=>'readonly')); 
        ?>
        </div>
        <div class="col-md-3">
            <?php 
                if($model->isNewRecord)
                    echo $form->dropDownListControlGroup($model, 'proveedor_id', Proveedor::model()->getproveedores(2), array('id' => 'proveedor_id', 'class'=>'select select2 demo ',  'empty' => 'Seleccione una opción',  'style' => 'width: 80%;'));  
                else
                    echo $form->dropDownListControlGroup($model, 'proveedor_id', Proveedor::model()->getproveedores(2), array('id' => 'proveedor_id', 'class'=>'select select2 demo ',  'empty' => 'Seleccione una opción',  'style' => 'width: 80%;','disabled'=>'disabled'));  
            ?>
        </div>
        <div class="col-md-3">
            <div id="insumo">
                
            </div>    
        </div>
    <?php //echo $form->textFieldControlGroup($model,'materia_prima_insumo',array('maxlength'=>10)); ?>
    </div>
    <div class="row">
        <div class="col-md-4">
            <?php echo $form->textFieldControlGroup($model,'peso_total',array('maxlength'=>10)); ?>
        </div>
        <div class="col-md-4">
            <?php 
                if($model->isNewRecord)
                    echo $form->textFieldControlGroup($model,'fec_vencimiento',array('id'=>'fec_vencimiento')); 
                else
                    echo $form->textFieldControlGroup($model,'fec_vencimiento',array('readonly'=>true)); 
            ?>
        </div>   
        <div class="col-md-4">
            <?php //echo $form->textFieldControlGroup($model,'unidades'); ?>
        </div>
        <div class="col-md-4">
            <?php 
                if($model->isNewRecord)
                    echo $form->textFieldControlGroup($model,'num_lote_externo',array('maxlength'=>100)); 
                else
                    echo $form->textFieldControlGroup($model,'num_lote_externo',array('maxlength'=>100,'readonly'=>true)); 
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading"><FONT FACE="arial" SIZE=4 COLOR=white><strong><center>CARACTERÍSTICAS FÍSICAS</center></strong></FONT></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3">
                            <?php 
                                if($model->isNewRecord)
                                    echo $form->textFieldControlGroup($model,'caract_fisicas_color',array('maxlength'=>1,'value'=>1)); 
                                else
                                    echo $form->textFieldControlGroup($model,'caract_fisicas_color',array('maxlength'=>1,'value'=>1,'readonly'=>true)); 
                            ?>
                        </div>
                        <div class="col-md-3">
                            <?php 
                                if($model->isNewRecord)
                                    echo $form->textFieldControlGroup($model,'caract_fisicas_olor',array('maxlength'=>1,'value'=>1)); 
                                else
                                    echo $form->textFieldControlGroup($model,'caract_fisicas_olor',array('maxlength'=>1,'value'=>1,'readonly'=>true)); 
                            ?>
                        </div>
                        <div class="col-md-3">
                            <?php 
                                if($model->isNewRecord)
                                    echo $form->textFieldControlGroup($model,'caract_fisicas_textura',array('maxlength'=>1,'value'=>1)); 
                                else
                                    echo $form->textFieldControlGroup($model,'caract_fisicas_textura',array('maxlength'=>1,'value'=>1,'readonly'=>true)); 
                            ?>
                        </div>
                        <div class="col-md-3">
                            <?php 
                                if($model->isNewRecord)
                                    echo $form->textFieldControlGroup($model,'caract_fisicas_limpieza',array('maxlength'=>1,'value'=>1)); 
                                else
                                    echo $form->textFieldControlGroup($model,'caract_fisicas_limpieza',array('maxlength'=>1,'value'=>1,'readonly'=>true));
                            ?>
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


    <?php echo BsHtml::submitButton('Guardar', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>

<?php $this->endWidget(); ?>
