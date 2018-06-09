<?php
/* @var $this InsumoController */
/* @var $model Insumo */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'insumo-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); ?>

    <p class="help-block">Los campos con <span class="required">*</span> son obligatorios.</p>

    <?php echo $form->errorSummary($model1); ?>

    <?php echo $form->textFieldControlGroup($model1,'fec_ingreso',array('id'=>'fecha')); ?>
    <?php echo $form->dropDownListControlGroup($model1,'tipo',array('0'=>'Carnico','1'=>'No Carnico','2'=>'Vegetales'),array('empty'=>'Seleccione una opcion','id'=>'tiṕo')); ?>
    

    <?php echo BsHtml::SubmitButton('Generar', array('color' => BsHtml::BUTTON_COLOR_PRIMARY,'onclick'=>'generar()')); ?>

<?php $this->endWidget(); ?>
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
    function generar()
    {
        fecha = {
            fecha:$("#fecha").val()
          };
          //jsonObj.push(item);

        

        //console.log(personas);

 
      $.ajax({
          data: fecha,
          //Cambiar a type: POST si necesario
          type: "POST",
          dataType: "json",
          url: "generarExcel",
      })
       .done(function( data, textStatus, jqXHR ) {
           if ( console && console.log ) {
              //reset();
                //alertify.success("Notas guardadas correctamente");
                alert("Reporte Generado");
              refreshIntervalId =self.setInterval("cargarEstudiantes()",3000);
           }
       })
       /*.fail(function( jqXHR, textStatus, errorThrown ) {
           if ( console && console.log ) {
              /*reset();
                alertify.error("Error al  guardar Notas" + textStatus);*/
               /* alert("Error al generar el Excel "+ textStatus);
               console.log( "La solicitud a fallado: " +  textStatus);
           }
      });*/
    }
</script>