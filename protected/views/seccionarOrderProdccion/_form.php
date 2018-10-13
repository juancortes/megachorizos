<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/static/js/jtodo.js"></script>
<?php
/* @var $this SeccionarOrderProdccionController */
/* @var $model SeccionarOrderProdccion */
/* @var $form BSActiveForm */
?>
<script type="text/javascript">
    $(function()
    {
        $(".select2").select2({
            width:'resolve'
        });

        $('#tanda').change(function()
        {
            $.post('getPesoTanda',
            {
                tanda:$("#tanda").val()

            },function(res)
            {
                $("#peso_orden_produccion").val(res);
            });
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

        /*$('#producto_'+i).change(function()
        {
            cargarValores(i);
        });

        $('#insumo_'+i).change(function()
        {
            cargarValores(i);
        });*/

       
    });

    

    function cargarValores(i)
    {
        if($("#producto_"+i).val() != "" && $("#producto_"+i).val() != 'undefined' && $("#insumo_"+i).val() != "" && $("#insumo_"+i).val() != 'undefined')
        {
            $.post('getValores',
            {
                producto:$("#producto_"+i).val(),
                insumo:$("#insumo_"+i).val()

            },function(res)
            {
                obj = JSON.parse(res);
                $("#peso_unidad_"+i).val(obj.peso);
                $("#longitud_"+i).val(obj.longitud);
            });
        }
    }

    function aplicarSelect2(fila)
    {   
        $(".insumo[fila='"+fila+"']").select2({
            placeholder: "Buscar insumo...",
            width:'resolve', 
            dropdownCssClass: "bigdrop",
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
    }

    function movieFormatResult(producto) {
        var markup = "<table class='movie-result'><tr>";
        markup += "<td class='movie-info'><div class='movie-title'>" + producto.nombre + "</div>";
        markup += "</td></tr></table>";
        return markup;
    }

    function movieFormatSelection(producto) {
        return producto.nombre;
    }
</script>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'seccionar-order-prodccion-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>
    <div class="row">
        <div class="col-md-3">
            <?php echo $form->dropDownListControlGroup($model, 'orden_produccion_id', CtrlProduccionesTrazabilidad::model()->getTanda(), array('empty'=>'Seleccione una order de produccion','id' => 'tanda', 'class'=>'select select2 demo ',  'style' => 'width: 80%;'));  ?>
        </div>
        <div class="col-md-3">
            <?php echo $form->textFieldControlGroup($model,'peso_orden_produccion',array('ng-model'=>'solicitud.peso_orden_produccion','maxlength'=>10,'readonly'=>'true','id'=>'peso_orden_produccion')); ?>
        </div>
        <div class="col-md-3">
            <?php echo $form->dropDownListControlGroup($model,'estado',JHelper::getEstadoProveedor(),array('maxlength'=>1,'empty'=>'Seleccione un Estado')); ?>
        </div>
        <div class="col-md-3">
            <?php echo $form->dropDownListControlGroup($model,'prioridad',JHelper::getPrioridad(),array('maxlength'=>1,'empty'=>'Seleccione una prioridad')); ?>
        </div>
        <div class="form" ng-controller="jCtrl"> 
        <table class="table table-bordered">
            <tr bgcolor="#A03233">
                <td width="16%" >
                    <div class="form-group">
                        <button type="button" class="btn btn-success btn-sm addRow" ng-click="addSolicitud()"><span class="glyphicon glyphicon-plus-sign"></span></button>
                    </div>
                </td>
                <td width="84%" align="center"><FONT FACE="arial" SIZE=4 COLOR=white><strong>SECCIONAMIENTO</strong></FONT></td>
            </tr>
            <tr>
                <td colspan="2"> 
                    <table class="table table-bordered" id ="solicitud">
                    <thead> 
                        <tr bgcolor="#A03233">
                            <td></td>
                            <td align="center"><FONT FACE="arial" SIZE=3 COLOR=white><strong>Producto</strong></FONT></td>
                            <td align="center"><FONT FACE="arial" SIZE=3 COLOR=white><strong>INSUMO</strong></FONT></td>
                            <td align="center"><FONT FACE="arial" SIZE=3 COLOR=white><strong>PESO UNIDAD</strong></FONT></td>
                            <td align="center"><FONT FACE="arial" SIZE=3 COLOR=white><strong>LONGITUD</strong></FONT></td>
                            <td align="center"><FONT FACE="arial" SIZE=3 COLOR=white><strong>PESO TOTAL</strong></FONT></td>
                        </tr>   
                    </thead>
                    <tbody>
                        <tr ng-repeat="solicitud in solicitudes">
                            <td><div align="center"><button type="button" class="btn btn-danger btn-sm delRow" id="1" ng-show="solicitud.fila!=1" ng-click="delSolicitud(solicitud.fila)"><span class="glyphicon glyphicon-remove-sign"></span></button></div></td>                                                        
                            <td><div align="center"><input type="text" id="producto_{{solicitud.fila}}" name="SeccionarOrderProdccion[detalle1][{{solicitud.fila}}][producto]" class="producto" ng-change="cargarDatos(solicitud.fila)" fila={{solicitud.fila}}  ng-model=solicitud.producto></div></td>
                            <td><div align="center"><select id="insumo_{{solicitud.fila}}" name="SeccionarOrderProdccion[detalle1][{{solicitud.fila}}][insumo]" class="insumo" fila={{solicitud.fila}} ng-change="cargarDatos(solicitud.fila)"  ng-model=solicitud.insumo>
                                    <option value="" selected="true">Seleccione un insumo</option>
                                    <option value="267">Colageno</option>
                                    <option value="296">Tripa</option>
                                </select>
                                </div></td>
                            <td><div align="center"><input type="text" id="peso_unidad_{{solicitud.fila}}" name="SeccionarOrderProdccion[detalle1][{{solicitud.fila}}][peso_unidad]" class="peso_unidad" fila={{solicitud.fila}}  ng-model=solicitud.peso_unidad></div></td>
                            <td><div align="center"><input type="text" id="longitud_{{solicitud.fila}}" name="SeccionarOrderProdccion[detalle1][{{solicitud.fila}}][longitud]" class="longitud" fila={{solicitud.fila}}  ng-model=solicitud.longitud></div></td>
                            <td><div align="center"><input type="text" id="peso_total_{{solicitud.fila}}" name="SeccionarOrderProdccion[detalle1][{{solicitud.fila}}][peso_total]" class="peso_total" fila={{solicitud.fila}} ng-keyup="sumarTotal(solicitud.fila)"  ng-model=solicitud.peso_total></div></td>
                        </tr>   
                    </tbody>
                    </table>
                </td>
            </tr>
        </table> 
    </div>
        <?php 
            $usuario = Yii::app()->user->id;
            $user = User::model()->findByAttributes(array('username'=>$usuario));
            echo $form->hiddenField($model,'user_id',array('value'=>$user->id)); 
        ?>
    </div>

    <?php echo BsHtml::submitButton('Ingresar', array('id'=>'btn_ingresar','color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>

<?php $this->endWidget(); ?>
