<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/static/js/jtodo.js"></script>
 
<?php
/* @var $this CtrlProduccionesTrazabilidadController */
/* @var $model CtrlProduccionesTrazabilidad */
/* @var $form BSActiveForm */
?>
<style type="text/css">

</style>
<script type="text/javascript"> 
    var arrayProveedor   = [];
    var arrayProducto    = [];
    var arrayCantidad    = [];
    var arrayFCarnica    = new Array();
    var i = 0;

    $(function()
    {
        validar();
        $(".select2").select2({
            width:'resolve'
        });

        $("#fecha").datepicker({
            inline: true,
            changeMonth: true,
            changeYear: true,
            numberOfMonths: 1,
            showOn: "both",//button
            buttonImageOnly: false,
            showAnim: "slideDown",
            dateFormat: "yy-mm-dd",            
        });

        $("#producto").change(function() {
            calcularUnidadesProducidas();
        });

        $('#fecha').change(function() 
        {
            $.post('getOrdenProduccion',
            {
                fecha: $("#fecha").val()

            },function(res)
            {
                $("#orden_produccion").val(res);
            });
        });

        $('#cant_produccion').change(function() 
        {
            if($("#producto").val() != "" && $("#cant_produccion").val() > 0)
            {
                $.post('getFormulacion',
                {
                    producto: $("#producto").val(),
                    cantidad: $("#cant_produccion").val()

                },function(res)
                {
                    if(res.search("No existe inventario para poder continuar!!!") != -1 )
                        $("#btn_enviar").hide();
                    else
                        $("#btn_enviar").show();

                    $("#formulacion").html("");
                    $("#formulacion").html(res);
                });
                calcularUnidadesProducidas();
                traerFormulacion();
            }            
        });


        $('#producto').click(function() 
        {
            if($("#producto").val() != "" && $("#cant_produccion").val() > 0)
            {
                $.post('getFormulacion',
                {
                    producto: $("#producto").val(),
                    cantidad: $("#cant_produccion").val()
                },function(res)
                {
                    if(res.search("No existe inventario para poder continuar!!!") != -1 )
                    {
                        $("#btn_enviar").hide();
                    }
                    else
                    {
                        $("#btn_enviar").show();
                    }

                    $("#div_unidades").show();
                    $("#formulacion").html("");
                    $("#formulacion").html(res);
                });
                traerFormulacion();
            }    
            else
                $("#div_unidades").hide();
        });

        aplicarSelect2(1);
        var i=1;
        $('.addRow').click(function(event) {
            i++;
            // $('#solicitud tr:last').after('<tr id="'+i+'"><td><button type="button" class="btn btn-danger btn-sm delRow" id="'+i+'"><span class="glyphicon glyphicon-remove-sign"></span></button></td><td><input type="text" id="'+i+'" class="depto"></td><td><input type="text" id="'+i+'" class="municipio"></td><td><input type="text" name="SolicitudRegistros['+i+'][estrato1]" value="0" class="estrato"></td><td><input type="text" name="SolicitudRegistros['+i+'][estrato2]" value="0" class="estrato"></td><td><input type="text" name="SolicitudRegistros['+i+'][estrato3]" value="0" class="estrato"></td><td><input type="text" name="SolicitudRegistros['+i+'][estrato4]" value="0" class="estrato"></td><td><input type="text" name="SolicitudRegistros['+i+'][estrato5]" value="0" class="estrato"></td><td><input type="text" name="SolicitudRegistros['+i+'][estrato6]" value="0" class="estrato"></td><td>0</td></tr>');
            aplicarSelect2(i);
        });
        //eliminar
        $('tbody tr td button.delRow').on('click', function(event) {
            var fila=$(this).attr('id');
            $('tr[id="'+fila+'"]').remove();
        });        

    });

    function validar()
    {
        <?php 
            if(isset(Yii::app()->user->insumos))
                $cant = count(Yii::app()->user->insumos); 
            else
                $cant = count(Yii::app()->user->insumos);
        ?>
        if(<?php echo $cant ?> > 0)
        {
            alertify.confirm('¿Quiere volver a cargar los datos?', function(e){ 
                if(e)
                {
                    // traerFormulacion(1);
                }
                else
                {
                    $.post('quitarSesion',
                    {
                        

                    },function(res)
                    {
                        
                    });
                }
            });

        }
    }

    function traerFormulacion(sesion = 0)
    {
        $.post('getTraerFormulacion',
        {
            producto: $("#producto").val(),
            cantidad: $("#cant_produccion").val(),
            sesion: sesion
        },function(res)
        {
            if(res.search("No existe inventario para poder continuar!!!") != -1 )
            {
                $("#btn_enviar").hide();
            }
            else
            {
                $("#btn_enviar").show();
            }

            $("#ordenProd").html(res);
        });
    }

    function calcularUnidadesProducidas()
    {
        $.post('GetCalcularPeso',
        {
            producto: $("#producto").val(),
            cant_produccion: $("#cant_produccion").val()
        },function(res)
        {
            
            $("#peso").val(res);
        });
    }

    function aplicarSelect2(fila)
    {
        $(".productonc[fila='"+fila+"']").select2({
            placeholder: "Buscar producto...",
            minimumInputLength: 0,
            width:'resolve', 
            // multiple: true,
            ajax: { 
                url: "getProductosnc",
                dataType: 'json',
                type: 'POST',
                data: function (term, page) {
                    return {
                        q: term, 
                        page_limit: 10,
                    };
                },
                results: function (data, page) {  
                    return {results: data.deptos};
                }
            },
            formatResult: movieFormatResult1, 
            formatSelection: movieFormatSelection1,  
            dropdownCssClass: "bigdrop", 
            escapeMarkup: function (m) { return m; } 
        });
        $(".lote[fila='"+fila+"']").select2({
            placeholder: "Buscar lote...",
            minimumInputLength: 0,
            width:'resolve', 
            // multiple: true,
            ajax: { 
                url: "getLote",
                dataType: 'json',
                type: 'POST',
                data: function (term, page) {
                    return {
                        q: term, 
                        page_limit: 10,
                        producto: getIdProductonc($(this))
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


        $(".proveedor[fila='"+fila+"']").select2({
            placeholder: "Buscar proveedor...",
            minimumInputLength: 1,
            width:'resolve',
            ajax: {  
                url: "getProveedor",
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
        $(".producto[fila='"+fila+"']").select2({
            placeholder: "Buscar producto...",
            minimumInputLength: 0,
            width:'resolve', 
            // multiple: true,
            ajax: { 
                url: "getProductos",
                dataType: 'json',
                type: 'POST',
                data: function (term, page) {
                    return {
                        q: term, 
                        page_limit: 10,
                        proveedor: getIdProveedor($(this))
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

    function getIdProveedor(element){
        var fila=element.attr('fila');
        var proveedor=$('.proveedor[fila="'+fila+'"]');
        var valorProveedor=parseInt(proveedor.val());
        if(isNaN(valorProveedor)){
            valorProveedor=0;
        }
        return valorProveedor;
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

    function getIdProductonc(element){
        var fila=element.attr('fila');
        var productonc=$('.productonc[fila="'+fila+'"]');
        var valorProductonc=parseInt(productonc.val());
        if(isNaN(valorProductonc)){
            valorProductonc=0;
        }
        return valorProductonc;
    }

    function movieFormatResult3(producto) {
        var markup = "<table class='movie-result'><tr>";
        markup += "<td class='movie-info'><div class='movie-title'>" + producto.nom_proveedor + "</div>";
        markup += "</td></tr></table>";
        return producto;
    }

    function movieFormatSelection3(producto) {
        return producto.nom_proveedor;
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

    function movieFormatResult1(producto) {
        var markup = "<table class='movie-result'><tr>";
        markup += "<td class='movie-info'><div class='movie-title'>" + producto.materia_prima + "</div>";
        markup += "</td></tr></table>";
        return markup;
    }

    function movieFormatSelection1(producto) {
        return producto.materia_prima;
    }

    function movieFormatResult(proveedor) {
        var markup = "<table class='movie-result'><tr>";
        markup += "<td class='movie-info'><div class='movie-title'>" + proveedor.nom_proveedor + "</div>";
        markup += "</td></tr></table>";
        return markup;
    }

    function movieFormatSelection(proveedor) {
        return proveedor.nom_proveedor;
    }
    

    function preguntar()
    { 
        var form = document.getElementById("ctrl-producciones-trazabilidad-form");
        alertify.confirm('¿Estas seguro de enviar este formulario?', function(e){ 
            if(e)
            {
                var datastring = $("#ctrl-producciones-trazabilidad-form").serialize();
                $.post('validarFormulacion',
                {
                    form: datastring,
                    producto:$("#producto").val(),
                    cantidad:$("#cant_produccion").val()
                },function(res)
                {
                    obj = JSON.parse(res);
                    if(obj.success == false)
                        alertify.alert(obj.tabla);
                    else
                        form.submit()
                });
            }
            else
            {
                alertify.error('Ha cancelado')
            }
        });
        
    } 

    function ingresarFormalaCarnica()
    {
        proveedor = $("#proveedor").val();
        producto  = $("#producto1").val();
        cantidad  = $("#cantidad").val();

        if(proveedor != '' && producto != '' && cantidad != ''&& cantidad > 0)
        {
            $("#fcarnico").html("");
            $("#fcarnico").fadeOut(function() {
                $("#fcarnico").load("generarTablaCarnicos", {
                    //parametros enviados
                    proveedor:proveedor,
                    producto:producto,
                    cantidad:cantidad,
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
                    $("#fcarnico").load("eliminarTablaCarnicos", {
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

    function eliminarElementoNCarnico(key)
    {
        alertify.confirm('Quiere eliminar el elemento reamente?', function(e){
            $("#mncarnico").html("");
            $("#mncarnico").fadeOut(function() {
                $("#mncarnico").load("eliminarSesionNCarnicos", {
                    //parametros enviados
                    id:key
                }).fadeIn();
            });
        });
    }

    function eliminarElementoCarnico(key) 
    {
        alertify.confirm('Quiere eliminar el elemento reamente?', function(e){
            $("#mcarnico").html("");
            $("#mcarnico").fadeOut(function() {
                $("#mcarnico").load("eliminarSesionCarnicos", {
                    //parametros enviados
                    id:key
                }).fadeIn();
            });
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

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'ctrl-producciones-trazabilidad-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); ?>

    <p class="help-block">Los campos con <span class="required">*</span> son obligatorios.</p>

    <?php echo $form->errorSummary($model); ?>
    <div class="row">
        <div class="col-md-4">
            <?php echo $form->textFieldControlGroup($model,'orden_produccion',array('id'=>'orden_produccion','maxlength'=>255,'readonly'=>true)); ?>
        </div>
        <div class="col-md-4">
            <?php echo $form->textFieldControlGroup($model,'fecha',array('id'=>'fecha','value'=>date('Y-m-d'))); ?>
        </div>
        <div class="col-md-4">
            <?php echo $form->textFieldControlGroup($model,'cant_produccion',array('maxlength'=>11,'id'=>'cant_produccion')); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?php echo $form->dropDownListControlGroup($model, 'producto', Producto::model()->getProductos(), array('id' => 'producto', 'class'=>'select2','empty'=>'Seleccione un producto', 'class'=>'select select2 demo ',  'style' => 'width: 80%;'));  ?>
        </div>
        <div id="div_unidades" style="display: none">
            <div class="col-md-6">
                <?php echo $form->textFieldControlGroup($model,'peso',array('maxlength'=>11,'id'=>'peso', 'readonly'=>true)); ?>
            </div>
        </div>
    </div>
    
    <div id="formulacion"></div>
    <div id="mncarnico"></div>

    


    <div id="mcarnico"></div>
    <div id='fcarnico'></div>
    <div id="ordenProd"></div>

    <?php echo $form->hiddenField($model,'aproveedor',array('id'=>'aproveedor')); ?>        
    <?php echo $form->hiddenField($model,'aproducto1',array('id'=>'aproducto1')); ?>        
    <?php echo $form->hiddenField($model,'acantidad',array('id'=>'acantidad')); ?>        
    
    <?php
        if(!$model->isNewRecord)
        {
            $this->widget('bootstrap.widgets.BsGridView', array(
                'id'               => 'detCenso-grid',
                'cssFile'          => Yii::app()->baseUrl.'/static/css/gridView.css',
                'dataProvider'     => $dlleCtrlProduccionesAdmin->search($model->id),
                //'filter'           => $detCensoAdmin,
               // 'selectionChanged' => 'cambDetCenso',
                'columns'          => array(
                    array(
                        'name'        => 'insumo_id',
                        'value'       => '$data->insumo->materia_prima',
                        'htmlOptions' => array('width' => '30%'),
                    ),
                    array(
                        'name'        => 'tipo',
                        'header'      => 'Tipo',
                        'value'       => '($data->tipo == 0) ? "Carnica" : "No Carnica"',
                        'htmlOptions' => array('width' => '20%'),
                    ),
                    array(
                        'name'        => 'lote_interno',
                        'header'      => 'lote Interno',
                    ),
                    array(
                        'name'        => 'cantidad',
                        'header'      => 'Cantidad',
                       // 'value'       => '($data->tecnica_internet == 0) ? "No" : "Si"',
                        'htmlOptions' => array('width' => '50%'),
                    ),
                    
                    
                    
                   /* array(
                        'class'     => 'CButtonColumn',
                        'header'    => "Acciones",
                        
                    ),*/
                ),
            ));
        }
    ?>

    <?php 
        $usuario = Yii::app()->user->id;
        $user = User::model()->findByAttributes(array('username'=>$usuario));
        echo $form->hiddenField($model,'responsable',array('value'=>$user->id)); 
    ?>
    <div id="btn_enviar">
        <?php echo BsHtml::button('Enviar', array('onclick'=>'preguntar()','color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>
    </div>
<?php $this->endWidget(); ?>

