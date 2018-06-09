<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table>
	<tr>
		<td>LOTE INTERNO</td>
		<td>PROVEEDOR</td>
		<td>PRODUCTO</td>
		<td>PESO</td>
		<td>FECHA DE INGRESO</td>
	</tr>
	<?php 
	if($tipo == 0)
	{
		//$model = RecepcionMateriaPrimaCarnica::model()->findAll();
		foreach ($model as $key => $value) 
		{
			//$producto = Producto::model()->findByPk($value->id);
			echo "<tr>";
				echo "<td>".$value->lote_interno."</td>";
				echo "<td>".$value->proveedor0->nom_proveedor."</td>";
				echo "<td>".$value->materiaPrimaInsumo->materia_prima."</td>";
				echo "<td>".round($value->peso,2)."</td>";
				echo "<td>".$value->fec_ingreso."</td>";				
			echo "</tr>";
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
