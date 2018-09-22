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
    <?php echo $form->textFieldControlGroup($model,'tanda'); ?>
    <?php echo $form->textFieldControlGroup($model,'producto',array('maxlength'=>255)); ?>
    <?php echo $form->textFieldControlGroup($model,'cantidad',array('maxlength'=>10)); ?>
    <?php echo $form->textFieldControlGroup($model,'averias'); ?>
    <?php echo $form->textFieldControlGroup($model,'codigo_reproceso',array('maxlength'=>100)); ?>
    <?php echo $form->textFieldControlGroup($model,'num_programa'); ?>
    <div class="panel panel-info">
        <div class="panel-heading">Temperatura</div>
        <div class="panel-body">
            <div id="div-izq">
                <?php echo $form->textFieldControlGroup($model,'temperatura_salida',array('maxlength'=>10)); ?>
            </div>
            <div id="div-con">
                <div id="div-der">  
                    <?php echo $form->textFieldControlGroup($model,'temperatura_coccion',array('maxlength'=>10)); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-info">
        <div class="panel-heading">Sostenimiento</div>
        <div class="panel-body">
            <div id="div-izq">
                <?php echo $form->textFieldControlGroup($model,'sostenimiento_tiempo'); ?>
            </div>
            <div id="div-con">
                <div id="div-der">  
                    <?php echo $form->textFieldControlGroup($model,'sostenimiento_temperatura_interna',array('maxlength'=>10)); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-info">
        <div class="panel-heading">Características Organolepticas</div>
        <div class="panel-body">
            <div id="div-izq">
                <?php echo $form->textFieldControlGroup($model,'caract_organolepticas_color'); ?>
            </div>
            <div id="div-con">
                <div id="div-der">  
                    <?php echo $form->textFieldControlGroup($model,'caract_organolepticas_olor'); ?>
                </div>
                <?php echo $form->textFieldControlGroup($model,'caract_organolepticas_sabor',array('width'=>'10%')); ?>
            </div>
            <?php echo $form->textFieldControlGroup($model,'caract_organolepticas_temperatura'); ?>
        </div>
    </div>

    <div class="panel panel-info">
        <div class="panel-heading">Características Físicas</div>
        <div class="panel-body">
            <div id="div-izq">
                <?php echo $form->textFieldControlGroup($model,'caract_fisicas_tamano'); ?>
            </div>
            <div id="div-con">
                <div id="div-der">  
                    <?php echo $form->textFieldControlGroup($model,'caract_fisicas_forma'); ?>
                </div>
            </div>
        </div>
    </div>
    <?php echo $form->textFieldControlGroup($model,'responsable',array('maxlength'=>150)); ?>

    <?php echo BsHtml::submitButton('Enviar', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>

<?php $this->endWidget(); ?>
