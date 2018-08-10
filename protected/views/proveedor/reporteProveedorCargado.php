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

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->dropDownListControlGroup($model,'nom_proveedor',Proveedor::model()->getproveedor(),array('empty'=>'Seleccione una opcion','id'=>'tiṕo')); ?>
    <?php echo $form->dropDownListControlGroup($model,'insumo',Insumo::model()->getInsumos(),array('empty'=>'Seleccione una opcion','id'=>'tiṕo')); ?>
    <?php echo $form->textFieldControlGroup($model,'fecha_inicial',array('id'=>'fecha_inicial')); ?>
    <?php echo $form->textFieldControlGroup($model,'fecha_final',array('id'=>'fecha_final')); ?>
    <?php if($inicio == 1) {?>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead> 
                    <tr bgcolor="#A03233">
                        <td></td>
                        <td scope="col"><FONT FACE="arial" SIZE=3 COLOR=white><strong>Insumo         </strong></FONT></td>
                        <td scope="col"><FONT FACE="arial" SIZE=3 COLOR=white><strong>Proveedor      </strong></FONT></td>
                        <td scope="col"><FONT FACE="arial" SIZE=3 COLOR=white><strong>Cantidad       </strong></FONT></td>
                        <td scope="col"><FONT FACE="arial" SIZE=3 COLOR=white><strong>Fecha          </strong></FONT></td>
                    </tr>   
                </thead>
                <tbody>
                    <?php foreach ($model1 as $key => $value) {?>
                        <tr>
                            <td><?php echo $value->id ?></td>
                            <td><?php echo $value->insumo['materia_prima'] ?></td>
                            <td><?php echo $value->proveedor['nom_proveedor'] ?></td>
                            <td><?php echo $value->cantidad ?></td>
                            <td><?php echo $value->fecha_ingreso ?></td>
                        </tr>
                    <?php } ?>
                    
                </tbody>
            </table>
        </div>
    <?php } ?>

    <?php echo BsHtml::SubmitButton('Generar', array('color' => BsHtml::BUTTON_COLOR_PRIMARY,'onclick'=>'generar()')); ?>
<?php $this->endWidget(); ?>
<script type="text/javascript"> 
    $(function()
    {
        $("#fecha_inicial").datepicker({
            changeMonth: true,
            changeYear: true,
            numberOfMonths: 1,
            showOn: "both",//button
            buttonImageOnly: false,
            showAnim: "slideDown",
            dateFormat: "yy-mm-dd",            
        });

        $("#fecha_final").datepicker({
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