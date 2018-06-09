
<?php
	if($validacion == 1)
{
?>
<p><strong><font size="3" color="red"><center>No existe inventario para poder continuar!!!</center></font></strong></p>
	<div class="CSSTableGenerator" >
		<table border="1">
			
			<tr>
				<td>Insumo</td>
				<td>Cantidad</td>
				<td>Proveedores</td>
			</tr>
		<?php
		foreach ($insumo as $key => $value) {
   			$sql = "SELECT GROUP_CONCAT(p.nom_proveedor) AS proveedores 
					FROM proveedor p
					INNER JOIN proveedor_insumo pi ON p.id = pi.proveedor_id
					INNER JOIN insumo i ON i.id = pi.insumo_id
					WHERE i.materia_prima ='$value[insumo]'";
   			$proveedor = Yii::app()->db->createCommand($sql)->queryRow();

			echo "<tr>";
				echo "<td>".$value['insumo']."</td>";
				echo "<td>".$value['cantidad']."</td>";
				echo "<td>".$proveedor['proveedores']."</td>";
			echo "</tr>";
		}
		?>
		</table>
	</div>
<br><br><br><br><br>
<?php
}
?>
<p><center><strong>INSUMOS NECESARIOS</strong></center></p>
<div class="CSSTableGenerator" >
	<table width="100%" border="1">
		<tr>
			<td align="left"><strong>INSUMO</strong></td>	
			<td align="center">PESO</td>
		</tr>		
		<?php
		$cant = 0;
		foreach ($model as $key => $value) 
		{
			$insumo = Insumo::model()->findByPk($value->materia_prima);
			if(isset($insumo))
			{
				echo "<tr>";
					echo "<td align='left'>".$insumo->materia_prima."</td>";
					echo "<td align='left'>".$value->peso."</td>";
				echo "</tr>";
				$cant += $value->peso;
			}
		}
		?>
		<tr>
			<td align="right"><p align="right"><strong>Peso Mezcla</strong></p></td>	
			<td align="center"><?= $cant ?></td>
		</tr>	
	</table>
</div>
    <br>
 
