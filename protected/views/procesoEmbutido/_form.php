<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/static/js/jtodo.js"></script>
<?php
/* @var $this ProcesoEmbutidoController */
/* @var $model ProcesoEmbutido */
/* @var $form BSActiveForm */
?>
<style>
    .typeahead { border: 2px solid #FFF;
            border-radius: 4px;
            padding: 8px 12px;
            max-width: 100%;
            min-width: 290px;
            background: rgba(232, 204, 109, 0.5);color: #000;
        }
    .tt-menu { width:300px; }
    ul.typeahead{margin:0px;padding:10px 0px;}
    ul.typeahead.dropdown-menu li a {padding: 10px !important;  border-bottom:#CCC 1px solid;}
    ul.typeahead.dropdown-menu li:last-child a { border-bottom:0px !important; }
    .bgcolor {max-width: 550px;min-width: 290px;max-height:340px;background:url("world-contries.jpg") no-repeat center center;padding: 100px 10px 130px;border-radius:4px;text-align:center;margin:10px;}
    .demo-label {font-size:1.5em;color: #686868;font-weight: 500;color:#FFF;}
    .dropdown-menu>.active>a, .dropdown-menu>.active>a:focus, .dropdown-menu>.active>a:hover {
        text-decoration: none;
        background-color: #1f3f41;
        outline: 0;
    }
</style>


<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'proceso-embutido-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldControlGroup($model,'fecha',array('id'=>'fecha')); ?>
    <?php echo $form->dropDownListControlGroup($model, 'tanda', CtrlProduccionesTrazabilidad::model()->getTanda(), array('id' => 'tanda', 'class'=>'select select2 demo ',  'style' => 'width: 80%;'));  ?>
    <?php echo $form->textFieldControlGroup($model,'cantidad_entrante',array('id'=>'cantidad_entrante')); ?>
    <div id="productos" ng-app='appProductos' ng-controller="ProductosController">
        <div class="form" >
            <table class="table table-bordered">
                <tr bgcolor="#A03233">
                    <td width="16%" >
                        <div class="form-group">
                            <button type="button" class="btn btn-success btn-sm addRow" ng-click="addSolicitud()"><span class="glyphicon glyphicon-plus-sign"></span></button>
                        </div>
                    </td>
                    <td width="84%" align="center"><FONT FACE="arial" SIZE=5 COLOR=white><strong>Productos</strong></FONT></td>
                </tr>
                <tr>
                    <td colspan="2"> 
                        <table class="table table-bordered" id ="solicitud">
                        <thead> 
                            <tr bgcolor="#A03233">
                                <td></td>
                                <td align="center"><FONT FACE="arial" SIZE=3 COLOR=white><strong>Producto</strong></FONT></td>
                                <td align="center"><FONT FACE="arial" SIZE=3 COLOR=white><strong>cantidad (Kg)</strong></FONT></td>
                                <td align="center"><FONT FACE="arial" SIZE=3 COLOR=white><strong>Lote</strong></FONT></td>
                                <td align="center"><FONT FACE="arial" SIZE=3 COLOR=white><strong>Unidades Salientes</strong></FONT></td>
                                <td align="center"><FONT FACE="arial" SIZE=3 COLOR=white><strong>Estimado</strong></FONT></td>
                            </tr>   
                        </thead>
                        <tbody>
                            <tr ng-repeat="solicitud in solicitudes">
                                <td><div align="center"><button type="button" class="btn btn-danger btn-sm delRow" id="1" ng-show="solicitud.fila!=1" ng-click="delSolicitud(solicitud.fila)"><span class="glyphicon glyphicon-remove-sign"></span></button></div></td>                            
                                <td>
                                    <div align="center">
                                        <input type="text" name="ProcesoEmbutido[producto][{{solicitud.fila}}][producto]" class="producto form-control select2-select"  fila={{solicitud.fila}} ng-model=solicitud.producto >
                                    </div>
                                </td>
                                <td><div align="center"><input type="text" name="ProcesoEmbutido[producto][{{solicitud.fila}}][cantidad]" class="cantidad" fila={{solicitud.fila}}   ng-model=solicitud.cantidad></div></td>
                                <td>
                                    <div align="center">
                                        <div align="center"><input type="text" name="ProcesoEmbutido[producto][{{solicitud.fila}}][lote]" class="lote" fila={{solicitud.fila}}   ng-model=solicitud.lote ng-change="setLote()"></div>
                                    </div>
                                </td>
                                
                                <td><div align="center"><input type="text" name="ProcesoEmbutido[producto][{{solicitud.fila}}][unidades_salientes]" class="unidades_salientes" fila={{solicitud.fila}}   ng-model=solicitud.unidades_salientes></div></td>
                                <td><div align="center"><input type="text" name="ProcesoEmbutido[producto][{{solicitud.fila}}][estimado]" class="estimado" readonly="true" fila={{solicitud.fila}}   ng-model=solicitud.estimado></div></td>
                            </tr>   
                        </tbody>
                        </table>
                    </td>
                </tr>
                
            </table> 
        </div>
    </div>
     <button class="btn btn-primary btn-lg" data-toggle="modal"  data-target="#myModalEncuestador">
      Ingresar INSUMO(S)
    </button>
    <!-- Modal -->
    <div class="modal fade" id="myModalEncuestador" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
            <h4 class="modal-title" id="myModalLabel"><center>INGRESO INSUMOS</center></h4>
          </div>
            <div class="modal-body">
                    <?php echo $form->textFieldControlGroup($model,'producto1',array('id'=>'producto','class'=>'typeahead')); ?>
                    <?php echo $form->dropDownListControlGroup($model,'insumo',array('267'=>'Colageno','270'=>'Tripa'),  
                        array('id'=>'insumo',                         
                            'prompt' => 'Seleccione un insumo...',
                            'class'=>'insumoSelect2' )); ?>
                    <?php echo $form->textFieldControlGroup($model,'cantidad',array('id'=>'cantidad')); ?>
                    <?php echo $form->textFieldControlGroup($model,'porcion',array('id'=>'porcion')); ?>
                    <?php echo $form->textFieldControlGroup($model,'estimado',array('id'=>'estimado', 'readonly'=>true)); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" id="boton_subir" data-dismiss="modal">Cerrar</button> <br>
                <button type="button" class="btn btn-primary" id="agregar" onclick="ingresarInsumo();">Ingresar</button>
                
            </div>
        </div>
      </div>
    </div>  
    <div id='fcarnico'></div>
    <?php echo $form->textFieldControlGroup($model,'averias_totales',array('id'=>'averias_totales')); ?>
    <?php echo $form->textFieldControlGroup($model,'observaciones',array('maxlength'=>200)); ?>

    <?php echo BsHtml::submitButton('Enviar', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>

<?php $this->endWidget(); ?>
<script type="text/javascript">
    var i = 1;
    $(document).ready(function() 
    {
        $("#cantidad").change(function() {
            calcularEstimadoInsumos();
        });

        $("#insumo").change(function() {
            calcularEstimadoInsumos();
        });

        $('#producto').typeahead({
            source: function (query, result) {
                $.ajax({
                    url: "GetProducto",
                    data: 'query=' + query,            
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
                        result($.map(data, function (item,i) {
                            $("#producto1").val(i);
                            return item;
                        }));
                    }
                });
            }
        });

        $(".select2").select2({
            width:'resolve'
        });

        aplicarSelect2(1);
        $('.addRow').click(function(event) {
            i++;
            // $('#solicitud tr:last').after('<tr id="'+i+'"><td><button type="button" class="btn btn-danger btn-sm delRow" id="'+i+'"><span class="glyphicon glyphicon-remove-sign"></span></button></td><td><input type="text" id="'+i+'" class="depto"></td><td><input type="text" id="'+i+'" class="municipio"></td><td><input type="text" name="SolicitudRegistros['+i+'][estrato1]" value="0" class="estrato"></td><td><input type="text" name="SolicitudRegistros['+i+'][estrato2]" value="0" class="estrato"></td><td><input type="text" name="SolicitudRegistros['+i+'][estrato3]" value="0" class="estrato"></td><td><input type="text" name="SolicitudRegistros['+i+'][estrato4]" value="0" class="estrato"></td><td><input type="text" name="SolicitudRegistros['+i+'][estrato5]" value="0" class="estrato"></td><td><input type="text" name="SolicitudRegistros['+i+'][estrato6]" value="0" class="estrato"></td><td>0</td></tr>');
            aplicarSelect2(i);
        });

        $("#fecha").datepicker({
            changeMonth: true,
            changeYear: true,
            numberOfMonths: 1,
            showOn: "both",//button
            buttonImageOnly: false,
            showAnim: "slideDown",
            dateFormat: "yy-mm-dd",
        });

        $("#cantidad_entrante").keydown(function (e) {
            solonumeros(e)
        });

        $("#averias_totales").keydown(function (e) {
            solonumeros(e)
        });
    });    

    function aplicarSelect2(fila)
    {
        $(".producto[fila='"+fila+"']").select2({
            placeholder: "Buscar producto...",
            minimumInputLength: 1,
            width:'resolve',
            ajax: {  
                url: "../inventarioEmpaqueVacio/getProducto",
                dataType: 'json',
                type: 'POST',
                data: function (term, page) {
                    return {
                        q: term, 
                        page_limit: 10
                    };
                },
                results: function (data, page) {            
                    return {results: data.deptos};
                }
            },
            formatResult: movieFormatResult, 
            formatSelection: movieFormatSelection,  
            dropdownCssClass: "bigdrop", 
            escapeMarkup: function (m) { return m; } 
        });

        $(".lote[fila='"+fila+"']").select2({
            placeholder: "Buscar lote...",
            minimumInputLength: 0,
            width:'resolve',
            ajax: {  
                url: "../inventarioEmpaqueVacio/getLote",
                dataType: 'json',
                type: 'POST',
                data: function (term, page) {
                    return {
                        q: term, 
                        page_limit: 10,
                        producto: getIdProducto($(this))
                    };
                },
                results: function (data, page) {            
                    return {results: data.deptos};
                }
            },
            formatResult: movieFormatResult, 
            formatSelection: movieFormatSelection,  
            dropdownCssClass: "bigdrop", 
            escapeMarkup: function (m) { return m; } 
        });
    }

    function calcularEstimadoInsumos()
    {
        estimado = 0;
        producto = $("#producto").val();
        insumo   = $("#insumo").val();
        cantidad = $("#cantidad").val();
        if(cantidad != '' && producto != '')
        {
            formula  = <?php echo Yii::app()->user->formulaEstimado; ?>;

            $.each(formula, function(i, item) {
                if(producto == item.producto && item.insumo_id == insumo)
                    estimado = Math.round((cantidad)/(item.peso)) * item.longitud ;
                else 
                    estimado = 0;
            });

            $("#estimado").val(estimado);
            if(estimado == 0)
            {
                reset();
                alertify.alert("No se ha ingresado la formula de estimados");
                $("#agregar").hide('slow');
            }
            else
                $("#agregar").show('slow');
        }
        else
        {
            $("#agregar").hide('slow');
        }
    }

    function getIdProducto(element)
    {
        var fila          = element.attr('fila');
        var producto      = $('.producto[fila="'+fila+'"]');
        var cantidad      = $('.cantidad[fila="'+fila+'"]');
        var valorProducto = parseInt(producto.val());
        var cantidad      = parseInt(cantidad.val());

        if(isNaN(valorProducto)){
            valorProducto=0;
        }

        if(cantidad != '' && valorProducto != '')
        {
            formula  = <?php echo Yii::app()->user->formulaEstimado; ?>;

            $.each(formula, function(i, item) {
                if(valorProducto == item.producto_id)
                    estimado = Math.round((cantidad)/(item.peso));
                else 
                    estimado = 0;
            });

            $('.estimado[fila="'+fila+'"]').val(estimado);
            if(estimado == 0)
            {
                reset();
                alertify.alert("No se ha ingresado la formula de estimados");
            }
        }

        return valorProducto;
    }
    
    function movieFormatResult(producto) {

        var markup = "<table class='movie-result'><tr>";
        markup += "<td class='movie-info'><div class='movie-title'>" + producto.nombre + "</div>";
        markup += "</td></tr></table>";
        return markup;
    }

    function movieFormatSelection(producto) {
        cantExistente = producto.cantidad;
        return producto.nombre;
    }

    function ingresarInsumo()
    {
        producto = $("#producto").val();
        insumo   = $("#insumo").val();
        cantidad = $("#cantidad").val();
        porcion  = $("#porcion").val();
        estimado = $("#estimado").val();

        if(producto != ''  && insumo != ''&& cantidad > 0 && porcion != '' && estimado != '')
        {
            $("#fcarnico").html("");
            $("#fcarnico").fadeOut(function() {
                $("#fcarnico").load("generarTablaInsumos", {
                    //parametros enviados
                    insumo:insumo,
                    producto:producto,
                    cantidad:cantidad,
                    porcion:porcion,
                    estimado:estimado,
                }).fadeIn();
            });
            $("#fcarnico").html("");
        }
        else
        {
            reset();
            alertify.alert("Debes ingresar todos los datos");
        }
    }

    function eliminarFormula(id)
    {
        alertify.confirm('Quiere eliminar el elemento reamente?', function(e){
            if(e)
            {
                $("#fcarnico").html("");
                $("#fcarnico").fadeOut(function() {
                    $("#fcarnico").load("eliminarTablaInsumos", {
                        //parametros enviados
                        id:id
                    }).fadeIn();
                });
                $("#fcarnico").html("");
                alertify.success('Ok');
            }
            else
            {
                alertify.error('Ha cancelado')
            }
        });        
    }

    function reset ()
    {
        $("#toggleCSS").attr("href", "../static/css/alertify.default.css");
        alertify.set({
            labels : {
                ok     : "OK",
                cancel : "Cancel"
            },
            delay : 3000,
            buttonReverse : false,
            buttonFocus   : "ok"
        });
    }

</script>