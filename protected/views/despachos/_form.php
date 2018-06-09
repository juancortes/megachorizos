<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/static/js/jtodo.js"></script>
<?php
/* @var $this DespachosController */
/* @var $model Despachos */
/* @var $form BSActiveForm */
?>
<script type="text/javascript"> 
    var cantExistente = 0; 
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

        $(".select2").select2({
            width:'resolve'
        });

        aplicarSelect2(1);
        aplicarEventoUnidad(1);
        var i=1;
        $('.addRow').click(function(event) {
            i++;
            // $('#solicitud tr:last').after('<tr id="'+i+'"><td><button type="button" class="btn btn-danger btn-sm delRow" id="'+i+'"><span class="glyphicon glyphicon-remove-sign"></span></button></td><td><input type="text" id="'+i+'" class="depto"></td><td><input type="text" id="'+i+'" class="municipio"></td><td><input type="text" name="SolicitudRegistros['+i+'][estrato1]" value="0" class="estrato"></td><td><input type="text" name="SolicitudRegistros['+i+'][estrato2]" value="0" class="estrato"></td><td><input type="text" name="SolicitudRegistros['+i+'][estrato3]" value="0" class="estrato"></td><td><input type="text" name="SolicitudRegistros['+i+'][estrato4]" value="0" class="estrato"></td><td><input type="text" name="SolicitudRegistros['+i+'][estrato5]" value="0" class="estrato"></td><td><input type="text" name="SolicitudRegistros['+i+'][estrato6]" value="0" class="estrato"></td><td>0</td></tr>');
            aplicarSelect2(i);
            aplicarEventoUnidad(i);
        });
        //eliminar
        $('tbody tr td button.delRow').on('click', function(event) {
            var fila=$(this).attr('id');
            $('tr[id="'+fila+'"]').remove();
        });
    });

    function validarUnidad(cantidad)
    {
        if(isNaN(cantidad.value))
        {
            alert("debe seleccionar un número");
            $("#btn").hide();
        }
        else
        {
            if(cantExistente < cantidad.value)
            {
                alert("No existen tantas cantidades");
                $("#btn").hide();
            }
            else
            {
                $("#btn").show();
            }
        }
    }

    function aplicarEventoUnidad(fila)
    {
        $(".cantidad[fila='"+fila+"']").attr("onChange", "validarUnidad(this);" );
    }

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

        $(".cliente[fila='"+fila+"']").select2({
            placeholder: "Buscar cliente...",
            minimumInputLength: 1,
            width:'resolve',
            ajax: {  
                url: "getCliente",
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

        $(".destino[fila='"+fila+"']").select2({
            placeholder: "Buscar destino...",
            minimumInputLength: 0,
            width:'resolve',
            ajax: {  
                url: "getDestino",
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

    function getIdProducto(element){
        var fila=element.attr('fila');
        var producto=$('.producto[fila="'+fila+'"]');
        var valorProducto=parseInt(producto.val());
        if(isNaN(valorProducto)){
            valorProducto=0;
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
</script>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'despachos-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); ?>

    <p class="help-block">Los campos con <span class="required">*</span> son obligatorios.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldControlGroup($model,'fecha',array('id'=>'fecha')); ?>
    <div class="form" ng-controller="jCtrl">
        <table class="table table-bordered">
            <tr bgcolor="#A03233">
                <td width="16%" >
                    <div class="form-group">
                        <button type="button" class="btn btn-success btn-sm addRow" ng-click="addSolicitud()"><span class="glyphicon glyphicon-plus-sign"></span></button>
                    </div>
                </td>
                <td width="84%" align="center"><FONT FACE="arial" SIZE=5 COLOR=white><strong>Despachos Pedido</strong></FONT></td>
            </tr>
            <tr>
                <td colspan="2"> 
                    <table class="table table-bordered" id ="solicitud">
                    <thead> 
                        <tr bgcolor="#A03233">
                            <td></td>
                            <td align="center"><FONT FACE="arial" SIZE=3 COLOR=white><strong>Cliente</strong></FONT></td>
                            <td align="center"><FONT FACE="arial" SIZE=3 COLOR=white><strong>Producto</strong></FONT></td>
                            <td align="center"><FONT FACE="arial" SIZE=3 COLOR=white><strong>Lote</strong></FONT></td>
                            <td align="center"><FONT FACE="arial" SIZE=3 COLOR=white><strong>Cantidad</strong></FONT></td>
                            <td align="center"><FONT FACE="arial" SIZE=3 COLOR=white><strong>Observaciones</strong></FONT></td>
                        </tr>   
                    </thead>
                    <tbody>
                        <tr ng-repeat="solicitud in solicitudes">
                            <td><div align="center"><button type="button" class="btn btn-danger btn-sm delRow" id="1" ng-show="solicitud.fila!=1" ng-click="delSolicitud(solicitud.fila)"><span class="glyphicon glyphicon-remove-sign"></span></button></div></td>                            
                            <td> 
                                <div align="center">
                                    <input type="text" name="Despachos[detalle][{{solicitud.fila}}][cliente]" class="cliente form-control select2-select"  fila={{solicitud.fila}} ng-model=solicitud.cliente ng-change="setCliente()">                                       
                                </div>
                            </td>
                            <td>
                                <div align="center">
                                    <input type="text" name="Despachos[detalle][{{solicitud.fila}}][producto]" class="producto form-control select2-select"  fila={{solicitud.fila}} ng-model=solicitud.producto ng-change="setProducto()">                                       
                                </div>
                            </td>
                            <td><div align="center"><input type="text" name="Despachos[detalle][{{solicitud.fila}}][lote]" class="lote" fila={{solicitud.fila}}   ng-model=solicitud.lote></div></td>
                            <td><div align="center"><input type="text" name="Despachos[detalle][{{solicitud.fila}}][cantidad]" class="cantidad" fila={{solicitud.fila}}   ng-model=solicitud.cantidad></div></td>
                            <td><div align="center"><input type="text" name="Despachos[detalle][{{solicitud.fila}}][observaciones]" class="observaciones" fila={{solicitud.fila}}   ng-model=solicitud.observaciones></div></td>
                        </tr>   
                    </tbody>
                    </table>
                </td>
            </tr>
            
        </table> 
    </div>
    <?php echo $form->textFieldControlGroup($model,'responsable',array('maxlength'=>150)); ?>
    <?php echo $form->textFieldControlGroup($model,'verificado',array('maxlength'=>150)); ?>

    <div id="btn">
        <?php echo BsHtml::submitButton('Enviar', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>
    </div>
<?php $this->endWidget(); ?>
