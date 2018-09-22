<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/static/js/jtodo.js"></script>
<?php
/* @var $this ProcesoEmbutidoController */
/* @var $model ProcesoEmbutido */
/* @var $form BSActiveForm */
?>
<style>
    .pic-container {
      width: 1350px;
      margin: 0 auto;
      white-space: nowrap;
    }

    .pic-row {
      /* As wide as it needs to be */
      width: 1300px;
      overflow: auto;
    }

    .pic-row a {
      clear: left;
      display: block;
    }
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

<script type="text/javascript">
    function eliminar(id)
    {
        alertify.confirm('¿Estas seguro que quiere eliminar este producto?', function(e){ 
            if(e)
            {
                $.post('../eliminarDetalle',
                {
                    id: id

                },function(res)
                {
                    if($("#cantidad_entrante").val() != $("#peso").val())
                        $("#btn_enviar").hide('slow');
                    $("#tabla").html(res);

                });
            }
            else
            {
                alertify.error('Ha cancelado')
            }
        });
        
    }

    function validarCantidad(key1)
    {
        cant = 0;
        $('.datos[data-valores]').each(function(k,v){ 
            cant = cant+ parseFloat(v.value);
            
        });
        if($("#peso").val() != cant)
            $("#btn_enviar").hide('slow');
        else
            $("#btn_enviar").show('slow');
        console.log('k='+key1);
        estimado(key1);
    }

    function adicionar()
    {
        var $tabla = $("#tbl_productos");
        var totalCasillas = $tabla.find("tr").length;
        var tipo = 9;
        var $tr = $("<tr></tr>");
        for(var i = 0;i < tipo;i++)
        {
            // creamos la columna o td
            var $td = $("<td>prueba texto</td>")
            // le asignamos su id
            .attr("id", "Casilla-"+totalCasillas+"-"+(i+1));
            $tr.append($td);
        }
        $tabla.append($tr);
    }

    function estimado(key)
    {

        $.post('../Estimado',
        {
            producto : $("#producto_"+key).val(),
            cantidad : $("#cantidad_"+key).val(),   
            tipo     : $("#tipo_"+key).val()

        },function(res)
        {
            if(res != "")
            {
                obj = JSON.parse(res);
                $("#peso_"+key).val(0);
                $("#estimado_"+key).val(0);

                $("#peso_"+key).val(obj.peso);
                $("#estimado_"+key).val(obj.estimado);
            }
            else
            {
                $("#peso_"+key).val(0);
                $("#estimado_"+key).val(0);
            }
        });
    }
</script>

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

    <?php 
        if($model->isNewRecord)
            echo $form->textFieldControlGroup($model,'fecha',array('id'=>'fecha','class'=>"form-control input-lg")); 
        else
            echo $form->textFieldControlGroup($model,'fecha',array('readonly'=>true,'class'=>"form-control input-lg")); 
        if($model->isNewRecord)
        {
    ?>
    <div id="tandaDiv">
        <select name="ProcesoEmbutido[tanda]" id="tanda" class="form-control input-lg">
            <option value="">Seleccione una tanda</option>
        </select>
    </div>
    <?php 
        }
        else
        {
            $tanda = CtrlProduccionesTrazabilidad::model()->findByPk($model->tanda);
            $producto = $tanda->producto0->nombre;
            echo "<input type='text' value='$producto' readonly='readonly' class ='form-control input-lg'>";
            echo $form->hiddenField($model,'tanda',array('readonly'=>true,'class'=>"form-control input-lg")); 

        }
    echo $form->textFieldControlGroup($model,'cantidad_entrante',array('id'=>'cantidad_entrante','readonly'=>true,'class'=>"form-control input-lg")); ?>
    <?php
        if($model->isNewRecord)
        {
    ?>

    <div class="row  pic-container" >
        <div class="pic-row">
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
                                        <td align="center"><FONT FACE="arial" SIZE=3 COLOR=white><strong>Producto&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></FONT></td>
                                        <td align="center"><FONT FACE="arial" SIZE=3 COLOR=white><strong>Lote Producto</strong></FONT></td>
                                        <td align="center"><FONT FACE="arial" SIZE=3 COLOR=white><strong>Cantidad (Kg)</strong></FONT></td>
                                        <td align="center"><FONT FACE="arial" SIZE=3 COLOR=white><strong>Tipo&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></FONT></td>
                                        <td align="center"><FONT FACE="arial" SIZE=3 COLOR=white><strong>Lote Tipo</strong></FONT></td>
                                        <td align="center"><FONT FACE="arial" SIZE=3 COLOR=white><strong>Cantidad (Mts)</strong></FONT></td>
                                        <td align="center"><FONT FACE="arial" SIZE=3 COLOR=white><strong>Peso</strong></FONT></td>
                                        <td align="center"><FONT FACE="arial" SIZE=3 COLOR=white><strong>Longitud</strong></FONT></td>
                                        <td align="center"><FONT FACE="arial" SIZE=3 COLOR=white><strong>Estimado</strong></FONT></td>
                                        <td align="center"><FONT FACE="arial" SIZE=3 COLOR=white><strong>Real</strong></FONT></td>
                                        <td align="center"><FONT FACE="arial" SIZE=3 COLOR=white><strong>Diferencia</strong></FONT></td>
                                    </tr>   
                                </thead>
                                <tbody>
                                    <tr ng-repeat="solicitud in solicitudes">
                                        <td><div align="center"><button type="button" class="btn btn-danger btn-sm delRow" id="1" ng-show="solicitud.fila!=1" ng-click="delSolicitud(solicitud.fila)"><span class="glyphicon glyphicon-remove-sign"></span></button></div></td>                            
                                        <td>
                                            <div align="center">
                                                <input type="text" id="producto_{{solicitud.fila}}" name="ProcesoEmbutido[producto][{{solicitud.fila}}][producto]" class="producto form-control select2-select"  fila={{solicitud.fila}} ng-model=solicitud.producto >
                                            </div>
                                        </td>
                                        <td><div align="center"><input type="text" name="ProcesoEmbutido[producto][{{solicitud.fila}}][lote_producto]"          class="lote_producto" fila={{solicitud.fila}} id="lote_producto_{{solicitud.fila}}"  ng-model=solicitud.lote_producto ng-change="setCantidad(solicitud.fila)" ></div></td>
                                        <td><div align="center"><input type="text" id="cantidad_{{solicitud.fila}}" ng-keyup = "sumarCantidadEntrante(solicitud.fila)" name="ProcesoEmbutido[producto][{{solicitud.fila}}][cantidad]" class="cantidad" style="width:90%" fila={{solicitud.fila}}   ng-model=solicitud.cantidad></div></td>
                                        <td><div align="center">
                                                <select id="tipo_{{solicitud.fila}}" name="ProcesoEmbutido[producto][{{solicitud.fila}}][tipo]" class="tipo form-control select2-select" style="width:90%" fila={{solicitud.fila}}  ng-model=solicitud.tipo ng-change="setTipo(solicitud.fila)">
                                                    <option value="267">Colageno</option>
                                                    <option value="270">Tripa</option>
                                                </select>
                                            </div>
                                        </td>
                                        <td><div align="center"><input type="text" name="ProcesoEmbutido[producto][{{solicitud.fila}}][lote_tipo]"          class="lote_tipo" fila={{solicitud.fila}} id="lote_tipo_{{solicitud.fila}}"  ng-model=solicitud.lote_tipo ></div></td>
                                        <td><div align="center"><input type="text" id="cantidad_tipo_{{solicitud.fila}}"  name="ProcesoEmbutido[producto][{{solicitud.fila}}][cantidad_tipo]" class="cantidad_tipo" style="width:90%" fila={{solicitud.fila}}   ng-model=solicitud.cantidad_tipo></div></td>
                                        <td><div align="center"><div align="center"><input type="text" id="peso_{{solicitud.fila}}" name="ProcesoEmbutido[producto][{{solicitud.fila}}][peso]" class="peso" style="width:90%" fila={{solicitud.fila}}   ng-model=solicitud.peso ></div></div></td>
                                        <td><div align="center"><input type="text" id="longitud_{{solicitud.fila}}"  name="ProcesoEmbutido[producto][{{solicitud.fila}}][longitud_]" class="longitud_" style="width:90%" fila={{solicitud.fila}}   ng-model=solicitud.longitud_></div></td>
                                        <td><div align="center"><input type="text" name="ProcesoEmbutido[producto][{{solicitud.fila}}][estimado]"   class="estimado"    style="width:90%"         readonly = "true"         fila={{solicitud.fila}}   ng-model=solicitud.estimado id="estimado_{{solicitud.fila}}"></div></td>
                                        <td><div align="center"><input type="text" name="ProcesoEmbutido[producto][{{solicitud.fila}}][real]"       class="real"        style="width:90%"         id="peso_real_{{solicitud.fila}}" fila={{solicitud.fila}}   ng-model=solicitud.real></div></td>
                                        <td><div align="center"><input type="text" name="ProcesoEmbutido[producto][{{solicitud.fila}}][diferencia]" class="diferencia"  style="width:90%"         readonly = "true"         fila={{solicitud.fila}}   ng-model=solicitud.diferencia></div></td>
                                    </tr>   
                                </tbody>
                                </table>
                            </td>
                        </tr>
                        
                    </table> 
                </div>
            </div>
        </div>
    </div>


  

    <?php
        }
        else
        {
            $embutidoProductos = EmbutidoProductos::model()->findAllByAttributes(array('proceso_embutido_id'=>$model->id));
            if(isset($embutidoProductos) && !Yii::app()->user->checkAccess("Admin1"))
            {
            ?>
                <table border="1" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad (Kg)</th>
                            <th>Tipo</th>
                            <th>Peso</th>
                            <th>Longitud</th>
                            <th>Estimado</th>
                            <th>Real</th>
                            <th>Diferencia</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        foreach ($embutidoProductos as $key => $value) {
                            echo "<tr>";
                            echo "  <td>".$value->producto->nombre."<input type='hidden'  name='ProcesoEmbutido[producto_id][$key]' value='$value->producto_id'></td>";
                            echo "  <td>".$value->cantidad."</td>";
                            if($value->tipo == 270)
                                $tipo = 'Tripa';
                            else
                                $tipo = 'Colageno';
                            echo "  <td>$tipo</td>";
                            echo "  <td>".$value->peso."</td>";
                            echo "  <td>".$value->longitud."</td>";
                            echo "  <td>".$value->estimado."</td>";

                            echo "  <td><input type='text' id='valor_real_$key' value='$value->valor_real' name='ProcesoEmbutido[valor_real][$key]' onkeyup='calcularDiferencia($key,$value->estimado)'></td>";
                            echo "  <td><input type='text' id='diferencia_$key' value='$value->diferencia' readonly name='ProcesoEmbutido[diferencia][$key]'></td>";
                            echo "</tr>";
                        }
                    ?>
                    </tbody>
                </table>
            <?php
            }
            else
            {
                ?>
                <div id="tabla">
                     <?php include ('tabla.php'); ?>
                </div>
                <?php
            }
        }
    ?>
    <div id='fcarnico'></div>
    <?php echo $form->textFieldControlGroup($model,'averias_totales',array('id'=>'averias_totales')); ?>
    <?php echo $form->textFieldControlGroup($model,'observaciones',array('maxlength'=>200)); ?>

    <?php echo BsHtml::submitButton('Enviar', array('id'=>'btn_enviar','color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>

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

        $('#tanda').change(function() {
            $.post('<?php echo Yii::app()->getBaseUrl(true) ?>/procesoEmbutido/GetCantidadEntranteTanda',
            {
                ordenProduccion:$("#tanda").val(),
            },function(res)
            {
                $("#cantidad_entrante").val(res);
            });
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

    function calcularDiferencia(key,estimado)
    {
        dif = $("#valor_real_"+key).val() - estimado;
        $("#diferencia_"+key).val(dif);
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

        $(".lote_producto[fila='"+fila+"']").select2({
            placeholder: "Buscar lote...",
            minimumInputLength: 0,
            width:'resolve',
            ajax: {  
                url: "../ProcesoEmbutido/getLote",
                dataType: 'json',
                type: 'POST',
                data: function (term, page) {
                    return {
                        q: term, 
                        page_limit: 10,
                        lote: $("#tanda").val(),
                        fecha:$("#fecha").val()
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

        $(".lote_tipo[fila='"+fila+"']").select2({
            placeholder: "Buscar lote...",
            minimumInputLength: 0,
            width:'resolve',
            ajax: {  
                url: "../ProcesoEmbutido/getLoteTipo",
                dataType: 'json',
                type: 'POST',
                data: function (term, page) {
                    return {
                        q: term, 
                        page_limit: 10,
                        tipo: getIdTipo($(this))
                    };
                },
                results: function (data, page) {            
                    return {results: data.deptos};
                }
            },
            formatResult: movieFormatResult2, 
            formatSelection: movieFormatSelection2,  
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
                    estimado = Math.round((cantidad)/(item.peso)) * 1000;
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

    function getIdProducto(element){
        var fila=element.attr('fila');
        var producto=$('.producto[fila="'+fila+'"]');
        var valorProducto=parseInt(producto.val());
        if(isNaN(valorProducto)){
            valorProducto=0;
        }
        return valorProducto;
    }

    function getIdTipo(element){
        var fila=element.attr('fila');
        var tipo=$('.tipo[fila="'+fila+'"]');
        var valorTipo=parseInt(tipo.val());
        if(isNaN(valorTipo)){
            valorTipo = 0;
        }
        return valorTipo;
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

    function movieFormatResult2(lote) {
        var markup = "<table class='movie-result'><tr>";
        markup += "<td class='movie-info'><div class='movie-title'>" + lote.lote_interno + "</div>";
        markup += "</td></tr></table>";
        return markup;
    }

    function movieFormatSelection2(lote) {
        return lote.lote_interno;
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