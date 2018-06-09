<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table>
	<tr>
		<td>INSUMO</td>
		<td>CLIENTE</td>
		<td>CANTIDAD</td>
		<td>OBSERVACIONES</td>
		<td>FECHA</td>
	</tr>
	<?php 
	if($tipo == 0)
	{
		foreach ($model as $key => $value) 
		{
			$detalles = DetalleTraslados::model()->findAllByAttributes(array('traslado_id'=>$value->id));
			foreach ($detalles as $k => $val) {
				echo "<tr>";
					echo "<td>".$val->insumo->materia_prima."</td>";
					echo "<td>".$val->cliente->nombre."</td>";
					echo "<td>".round($val->cantidad,2)."</td>";
					echo "<td>".$val->observaciones."</td>";
					echo "<td>".$value->fecha."</td>";				
				echo "</tr>";
			}
			
		}
	}
	else
	{
		//$model = RecepcionMateriaPrimaNoCarnica::model()->findAll();
		foreach ($model as $key => $value) 
		{
			//$producto = Producto::model()->findByPk($value->id);
			echo "<tr>";
				echo "<td>".$value->lote_interno." - ".$value->fec_ingreso."</td>";
				echo "<td>".$value->proveedor->nom_proveedor."</td>";
				echo "<td>".$value->materiaPrimaInsumo->materia_prima."</td>";
				echo "<td>".ROUND($value->peso_total,2)."</td>";
				echo "<td>".$value->fec_ingreso."</td>";				
			echo "</tr>";
		}
	}
	?>
</table>
