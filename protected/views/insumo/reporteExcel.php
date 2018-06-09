<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table>
	<tr>
		<td>Producto</td>
		<td>Cantidad Tandas</td>
		<td>Insumos</td>
	</tr>
	<?php 
	foreach ($model as $key => $value) 
	{
		$producto = Producto::model()->findByPk($value->producto);
		echo "<tr>";
			echo "<td>".$producto->nombre."</td>";
			echo "<td>".$value->cant_produccion."</td>";
			echo "<td>";
			?>
				<table>
					<tr>
						<td>Insumo</td>
						<td>Cantidad (Kg)</td>
						<td>Proveedor</td>
					</tr>
					<?php
					$detalles = DetalleCtrlProducciones::model()->findAllByAttributes(array('ctrl_producciones_id'=>$value->id));
					foreach ($detalles as $k => $val) 
					{
						$insumo = Insumo::model()->findByPk($val->insumo_id);
						echo "<tr>";
							echo "<td>".$insumo->materia_prima."</td>";
							echo "<td>".$val->cantidad."</td>";
							$proveedor = Proveedor::model()->findByPk($val->proveedor_id);
							if(isset($proveedor))
								echo "<td>".$proveedor->nom_proveedor."</td>";
							else
								echo "<td></td>";
						echo "</tr>";
					}
					?>
				</table>
			<?php
			echo "</td>";
		echo "</tr>";
	}
	?>
</table>
