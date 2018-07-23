
<?php
	if($validacion == 1)
{
?>
<p><strong><font size="3" color="red"><center>No existe inventario para poder continuar!!!</center></font></strong></p>
<br><br><br><br><br>
	
<?php
}
?>
<p><center><strong>INSUMOS A REGISTRAR</strong></center></p>
<div class="CSSTableGenerator" >
	<table width="100%" border="1">
		<tr>
			<td align="left"><strong>INSUMO</strong></td>	
			<td align="center">PESO</td>
			<td align="center">CANTIDAD </td>
			<td align="center">LOTE</td>
			<td align="center">Accion</td>
		</tr>	
		<?php
		if(count($sesion) != 0)
		{
			echo "<pre>";
			print_r($sesion);
			//print_r($insumo);
			//exit;
		}


			foreach ($insumo as $key => $value) 
			{
					echo "<tr class='tr_clone' id='table'>";
					echo "<td align='left'>".$value['insumo']."</td>";
					echo "<td align='left'>".$value['cantidad']."</td>";
					$cant = 0;
					$lote = 0;
					if(isset($value['recepcion']))
					{
						foreach ($sesion as $id => $cantidad) {
							foreach ($value['recepcion'] as $k => $val) {
								if($id == $val->id)
								{
									$cant = $cantidad;
									$lote = $id;
								}
							}
						}
					}
					exit("c=".$cant);
					if($cant != 0)
						echo "<td align='left'><input type='text' name='CtrlProduccionesTrazabilidad[detalle][$value[tipo]][cantidad_".$value['id']."]' value='$cant' ></td>";
					else
						echo "<td align='left'><input type='text' name='CtrlProduccionesTrazabilidad[detalle][$value[tipo]][cantidad_".$value['id']."]' ></td>";
					
					echo "<td align='left'><select name='CtrlProduccionesTrazabilidad[detalle][$value[tipo]][lote_".$value['id']."]' id='lote_".$value['id']."' class='select2'>
												<option value=''>Seleccione una opcion</option>";
					if(isset($value['recepcion']))
					{
						foreach ($value['recepcion'] as $k => $val) {
							if(isset($val->peso))
								echo "<option value='".$val->id."'>".$val->lote_interno." - ". round($val->peso,4) ." Kg</option>";
							else
								echo "<option value='".$val->id."'>".$val->lote_interno." - ". round($val->peso_total,4) ." Kg</option>";
						}
					}
					echo "</select>
						</td>";
					echo "<td align='left'><input type='button' name='add' value='adicionar' class='tr_clone_add btn-primary btn'></td>";
				echo "</tr>";
			}
		?>	
	</table>
</div>
<br>

<script type="text/javascript">
	
	
	function clonarFila(obj)
    {
        var $tableBody = $('#table').find("tbody"),
        		$trLast = $tableBody.find("tr:last"),
        		$trNew = $trLast.clone();
		
    	$trLast.after($trNew);
    }
    $("body").on('click','.tr_clone_add', function() {
	    var $tr    = $(this).closest('.tr_clone');
	    var $clone = $tr.clone();
	    $clone.find(':text').val('');
	    $clone.find(':button').hide();
        console.log($clone.find(':text'));

	    nameText = $clone.find(':text').attr("name");
	    nameSelect = $clone.find('.select2').attr("name");
        console.log("nt="+nameText+" nt0="+nameText.indexOf('[0]'));
	    
	    if(nameText.indexOf('[0]') > -1)
	    {
	    	console.log("s="+nameText.indexOf('[2]'));

			tipo  = "[0]";
			name1 = nameText.split('[0]');
			name3 = nameSelect.split('[0]');
	    }
	    if(nameText.indexOf('[1]') > -1)
	    {
			tipo  = "[1]";
			name1 = nameText.split('[1]');
			name3 = nameSelect.split('[1]');
	    }
	    if(nameText.indexOf('[2]') > -1)
	    {
	    	tipo  = "[2]";
			name1 = nameText.split('[2]');
			name3 = nameSelect.split('[2]');
	    }

		name2      = name1[1].split(']');
		name4      = name3[1].split(']');
		nameText   = name1[0]+tipo+name2[0]+"_"+i+"]";
		nameSelect = name3[0]+tipo+name4[0]+"_"+i+"]";
	    $clone.find(':text').attr('name', nameText);
	    $clone.find('.select2').attr('name', nameSelect);
	    $tr.after($clone);
	    i++;
	});
</script>
 
