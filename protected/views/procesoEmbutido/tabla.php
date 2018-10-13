<table border="1" class="table table-striped" id="tbl_productos">
    <thead>
        <tr>
            <th>Producto</th>
            <th>Cantidad <br>(Kg)</th>
            <th>Tipo</th>
            <th>Peso</th>
            <th>Longitud</th>
            <th>Estimado</th>
            <th>Real</th>
            <th>Diferencia</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    <?php
        $cantidad = 0;
        foreach ($embutidoProductos as $key => $value) {
            $productos = Producto::model()->findAll();
            echo "<tr class='tr_clone' id='table'>";
            echo "  <td><select id='producto_$key' name='productos[$key][producto]' data-valores='10' style='width:260px' class=' select3' onchange='estimado($key)'>
                        <option value=''>Seleccione una opción</option>";
                        foreach ($productos as $k => $val) {
                            if($val->id == $value->producto->id)
                                echo "<option value='$val->id' selected >$val->nombre</option>";
                            else  
                                echo "<option value='$val->id' >$val->nombre</option>";
                        }
            echo "   </select>
            
                    <input type='hidden'  name='ProcesoEmbutido[producto_id][$key]' value='$value->producto_id'></td>";
            echo "  <td><input type='text' data-valores='10' class='datos cantidad' id='cantidad_$key' name='productos[$key][cantidad]' style='width:60px' value='$value->cantidad' onchange='validarCantidad($key)'</td>";
            $cantidad += $value->cantidad;
            
            echo "  <td><select id='tipo_$key' data-valores='10'  name='productos[$key][tipo]' style='width:105px' class=' select4' onchange='estimado($key)'>
                            <option value=''>Seleccione una opción</option>";
                            if($value->tipo == 267)
                                echo "<option value='267' selected >Colageno</option>";
                            else 
                                echo "<option value='267'>Colageno</option>";
                            if($value->tipo == 296)
                                echo "<option value='296' selected>tripa</option>";
                            else    
                                echo "<option value='296'>tripa</option>";
            echo        "</select>
                    </td>";
            echo "  <td><input type='text' data-valores='10'  class='peso'       name='productos[$key][peso]'       id='peso_$key'       style='width:60px' value='$value->peso' ></td>";
            echo "  <td><input type='text' data-valores='10'  class='longitud'   name='productos[$key][longitud]'   id='longitud_$key'   style='width:60px' value='$value->longitud' ></td>";
            echo "  <td><input type='text' data-valores='10'  class='estimado'   name='productos[$key][estimado]'   id='estimado_$key'   style='width:60px' value='$value->estimado' ></td>";
            echo "  <td><input type='text' data-valores='10'  class='valor_real' name='productos[$key][valor_real]'  id='valor_real_$key'  style='width:60px' value='$value->valor_real' readonly name='ProcesoEmbutido[valor_real][$key]' onkeyup='calcularDiferencia($key,$value->estimado)'></td>";
            echo "  <td><input type='text' data-valores='10'  class='diferencia' name='productos[$key][diferencia]' id='diferencia_$key' style='width:60px' value='$value->diferencia' readonly name='ProcesoEmbutido[diferencia][$key]'></td>";
            echo "  <td><input type='button' name='eliminar' value='Eliminar' class='btn btn-danger' onclick='eliminar($value->id)'></input>
                        <input type='button' name='add' value='adicionar' class='tr_clone_add btn btn-primary'>
                    </td>";
            echo "</tr>";
        }
    ?>
    <input type='hidden'  name='peso' id="peso" value='<?php  echo $cantidad ?>'>
    <input type='hidden'  name='key' id="key" value='<?php  echo $key ?>'>
    </tbody>
</table>

<script type="text/javascript">
    
    $("body").on('click','.tr_clone_add', function() {
        var tr    = $(this).closest('.tr_clone');
        var clone = tr.clone();
        i = parseInt($('#key').val())+1;

        clone.find(':text').val('');
        clone.find(':button').hide();
        
        nameProd   = 'productos['+i+'][producto]';
        nameCant   = 'productos['+i+'][cantidad]';
        nameTipo   = 'productos['+i+'][tipo]';
        namePeso   = 'productos['+i+'][peso]';
        nameLong   = 'productos['+i+'][longitud]';
        nameEsti   = 'productos['+i+'][estimado]';
        nameVrReal = 'productos['+i+'][valor_real]';
        nameDiff   = 'productos['+i+'][diferencia]';

        clone.find('.select3').attr('name', nameProd);
        clone.find('.select3').attr('id', 'producto_'+i);
        clone.find('.select3').attr('onchange', 'estimado('+i+')');
        clone.find('.cantidad').attr('name', nameCant);
        clone.find('.cantidad').attr('id', 'cantidad_'+i);
        clone.find('.cantidad').attr('onchange', 'validarCantidad('+i+')');
        clone.find('.select4').attr('name', nameTipo);
        clone.find('.select4').attr('id', 'tipo_'+i);
        clone.find('.select4').attr('onchange', 'estimado('+i+')');
        clone.find('.peso').attr('name', namePeso);
        clone.find('.peso').attr('id', 'peso_'+i);
        clone.find('.longitud').attr('name', nameLong);
        clone.find('.longitud').attr('id', 'longitud_'+i);
        clone.find('.estimado').attr('name', nameEsti);
        clone.find('.estimado').attr('id', 'estimado_'+i);
        clone.find('.valor_real').attr('name', nameVrReal);
        clone.find('.valor_real').attr('id', 'valor_real_'+i);
        clone.find('.diferencia').attr('name', nameDiff);
        clone.find('.diferencia').attr('id', 'diferencia_'+i);

        $('.select3').off('change').on('changee',  function(event) {});
        $('.select3').on('change').on('changee',  function(event) {});
        $('.cantidad').off('change').on('changee',  function(event) {});
        $('.cantidad').on('change').on('changee',  function(event) {});
        $('.select4').off('change').on('changee',  function(event) {});
        $('.select4').on('change').on('changee',  function(event) {});
        $('.peso').off('change').on('changee',  function(event) {});
        $('.peso').on('change').on('changee',  function(event) {});
        $('.longitud').off('change').on('changee',  function(event) {});
        $('.longitud').on('change').on('changee',  function(event) {});
        $('.estimado').off('change').on('changee',  function(event) {});
        $('.estimado').on('change').on('changee',  function(event) {});
        $('.valor_real').off('change').on('changee',  function(event) {});
        $('.valor_real').on('change').on('changee',  function(event) {});
        $('.diferencia').off('change').on('changee',  function(event) {});
        $('.diferencia').on('change').on('changee',  function(event) {});

        tr.after(clone);
        
    });
</script>