<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(-1);
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods:GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers:Content-type, X-Requested-With");
class CtrlProduccionesTrazabilidadController extends Controller {
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout = '//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters() {
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules() {
		return array(
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'    => array('validarFormulacion','getTraerFormulacion','getTablaIngresoFormulacion','anular', 'getOrdenProduccion', 'getProductosnc', 'getLote', 'admin', 'create', 'index', 'view', 'delete', 'update', 'getFormulacion', 'getProveedor', 'getProductos', 'generarTablaCarnicos', 'eliminarTablaCarnicos', 'guardarSesion', 'quitarSesion', 'cargarSesion', 'eliminarSesionNCarnicos', 'EliminarSesionCarnicos', 'GetCalcularPeso', 'cargarEstimado'),
				'expression' => 'Yii::app()->user->checkAccess("Admin1") || Yii::app()->user->checkAccess("admin")',
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'    => array('validarFormulacion','getTraerFormulacion','getOrdenProduccion', 'getProductosnc', 'getLote', 'admin', 'create', 'index', 'view', 'getFormulacion', 'getProveedor', 'getProductos', 'generarTablaCarnicos', 'eliminarTablaCarnicos', 'guardarSesion', 'quitarSesion', 'cargarSesion', 'eliminarSesionNCarnicos', 'EliminarSesionCarnicos', 'GetCalcularPeso', 'cargarEstimado'),
				'expression' => 'Yii::app()->user->checkAccess("Mezclador") || Yii::app()->user->checkAccess("embutidor")',
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'    => array('getLote'),
				'expression' => 'Yii::app()->user->checkAccess("Traslados") || Yii::app()->user->checkAccess("Recepcion")',
			),
			array('deny', // deny all users
				'users' => array('*'),
			),
		);
	}

	public function actionValidarFormulacion() 
	{
		$form     = explode('CtrlProduccionesTrazabilidad', $_POST['form']);
		$producto = $_POST['producto'];
		$cantidad = $_POST['cantidad'];
		$i        = 0;
		$v        = true;
		$datos    = [];
		$validar  = true;

		foreach ($form as $key ) {
			if($i > 5 && $v === true)
			{
				$valor = explode('detalle', $key);
				if(isset($valor[1]))
					$valor = explode('[', $valor[1]);
				else
					$valor = explode('[', $valor[0]);
				
				$valor = explode('=', $valor[0]);
				$valor[1] = substr($valor[1], 0, -1);
				
				$d = strpos($valor[0], 'proveedor');
				if($d === false){ }
				else { echo $v = false;}
				
				$d1 = strpos($valor[0], 'cantidad');
				if($d1 === false && $v === true){ 
					$d = explode('lote_', $valor[0]);
			   		$d = explode('%', $d[1])[0];
			   		$datos[$d]['lote'] = $valor[1];
			   		if($valor[1] == "")
			   		{
			   			//$validar = false;
			   			unset($datos[$d]);
			   		}
				}
				else {
				   	if($v === true)
				   	{
				   		$d = explode('cantidad_', $valor[0]);
				   		$d = explode('%', $d[1])[0];
				   		$datos[$d]['cantidad'] = $valor[1];
				   		if($valor[1] == "")
				   		{
			   				unset($datos[$d]);
				   		}
				   	} 
				}
			}
			$i++;
		}

		
		if($validar === false)
			echo json_encode(['success'=>false,'mensaje'=>'No ha ingresado la totalidad de los datos de la formula!!!']);
		else
		{
			$datos2 = [];
			$formulacion = Formulacion::model()->findAllByAttributes(array('producto_id'=>$producto));
			if(isset($formulacion))
			{
				foreach ($datos as $insumo => $value) {
					$pos = strpos($insumo, '_');
					if($pos === false){ 
						$datos2[$insumo] = $value;
					}
					else
					{
						$d = explode('_', $insumo)[0];
						$datos2[$d]['cantidad'] += $value['cantidad'];
					}
				}
				$datos  = $datos2;
				$datos2 = null;

			}
			else
				echo json_encode(['success'=>false,'mensaje'=>'Error en la formulacion!!!']);

			$errores = [];

			foreach ($formulacion as $key => $value) {
				if(isset($datos[$value->materia_prima]))
				{
					if(round($cantidad * $value->peso,2) != round($datos[$value->materia_prima]['cantidad'],2))
					{
						$validar = false;
						$insumo_falta = $value->materiaPrima->materia_prima;
						$cant_ingresada = $value->peso;
						if($value->materiaPrima->tipo == 0) //carnico
						{
							$mod = RecepcionMateriaPrimaCarnica::model()->findByPk($datos[$value->materia_prima]['lote']);
							$peso = $mod->peso;
						}
						else if($value->materiaPrima->tipo == 1) //no carnico
						{
							$mod = RecepcionMateriaPrimaNoCarnica::model()->findByPk($datos[$value->materia_prima]['lote']);
							$peso = $mod->peso_total;
						}
						else 
						{
							$mod = RecepcionVegetales::model()->findByPk($datos[$value->materia_prima]['lote']);
							$peso = $mod->peso_total;
						}

						
						$lote = $mod->lote_interno;
						$errores[$insumo_falta] = ['lote'=>$lote,'peso_lote'=>round($peso,2),'insumo'=>$insumo_falta,'cant_solicitada'=>($cantidad * $cant_ingresada),'cant_ingresada'=>round($datos[$value->materia_prima]['cantidad'],2)];
					}
				}
			}


			if($validar === false)
			{
				$table = "cantidad solicitada de algun insumo incorrecto!!!<br>";
				$table .= "<table border=1>";
				$table .= "<tr>";
				$table .= "		<td>Inusmo</td>";
				$table .= "		<td>Cantidad Solicitada</td>";
				$table .= "		<td>Cantidad Ingresada</td>";
				$table .= "		<td>Lote</td>";
				$table .= "		<td>Lote Cantidad</td>";
				$table .= "</tr>";
				foreach ($errores as $key => $value) {
					$table .= "<tr>";
					$table .= "		<td>$value[insumo]</td>";
					$table .= "		<td>$value[cant_solicitada]</td>";
					$table .= "		<td>$value[cant_ingresada]</td>";
					$table .= "		<td>$value[lote]</td>";
					$table .= "		<td>$value[peso_lote]</td>";
					$table .= "</tr>";
				}
				$table .= "</table>";
				
				echo json_encode(['success'=>false,'mensaje'=>'cantidad solicitada de algun insumo incorrecto!!!','tabla'=>$table]);
			}
			else
				echo json_encode(['success'=>true,'mensaje'=>'ok']);
		}
	}

	public function actionGetOrdenProduccion() {
		$fecha        = $_POST['fecha'];
		$trazabilidad = CtrlProduccionesTrazabilidad::model()->findAllBySql("SELECT orden_produccion, fecha FROM ctrl_producciones_trazabilidad WHERE fecha='".$fecha."'");
		if (isset($trazabilidad)) {
			$cant = count($trazabilidad);
			if ($cant == 0) {
				echo 1;
			} else {

				echo $cant+1;
			}
		} else {
			echo 1;
		}
	}

	public function actionGetTraerFormulacion() {
		$prod     = $_POST['producto'];
		$cantidad = $_POST['cantidad'];
		$sesion   = $_POST['sesion'];

		$formulacion = Formulacion::model()->findAllByAttributes(array('producto_id' => $prod));
		$v       = 1;
		$insumos = array();
		$insumo1 = [];
		foreach ($formulacion as $key => $value) {
			$peso     = $cantidad*$value['peso'];
			$matPrima = $value['materia_prima'];

			$insumo = Insumo::model()->findByPk($matPrima); 
			if($insumo->tipo == 0)
				$recepcion = RecepcionMateriaPrimaCarnica::model()->findAll(array(
																			'condition'=>'materia_prima_insumo = :mpi AND peso > :peso',
																			'params'=>array(':mpi'=>$matPrima,':peso'=>0)
																		));
			else if($insumo->tipo == 1)
				$recepcion = RecepcionMateriaPrimaNoCarnica::model()->findAll(array(
																			'condition'=>'materia_prima_insumo =:mpi AND peso_total > :peso',
																			'params'=> array(':mpi'=>$matPrima,':peso'=>0)
																		));
			else	
				$recepcion = RecepcionVegetales::model()->findAll(array(
																			'condition'=>'materia_prima_insumo =:mpi AND peso_total > :peso',
																			'params'=> array(':mpi'=>$matPrima,':peso'=>0)
																		));


			if(count(Yii::app()->user->insumos) > 0)
				$sesion = Yii::app()->user->insumos;
			else	
				$sesion = [];


			$v         = 0;
			$insumo1[] = array( 'insumo'       => $insumo->materia_prima,
								'total_insumo' => $insumo->cantidad,
								'cantidad'     => $peso,
								'tipo'         => $insumo->tipo, // 0 carnico - 1 no carnico - 2 vegetales
								'id'           => $matPrima,
								'recepcion'    => $recepcion,
								'sesion'	   => $sesion
							);
		}
 		
 		Yii::log("datos insumo1 : ".print_r($insumo1,true), 'error', 'application.controllers.TercerosmetasController');
		
		$this->renderPartial('_tablaIngresoFormulacion', array('model' => $formulacion, 'validacion' => $v, 'insumo' => $insumo1,'sesion'=>$sesion),false,true);
	}

	public function actionAnular() {
		$transaction = Yii::app()->db->beginTransaction();
		try
		{
			$model = CtrlProduccionesTrazabilidad::model()->findByPk($_POST['orden']);
			if (isset($model)) {
				$model->estado = 0;
				if($model->save())
				{
					$dlleCtrlProducciones = DetalleCtrlProducciones::model()->findAllByAttributes(array('ctrl_producciones_id' => $_POST['orden']));
					if (isset($dlleCtrlProducciones)) {
						foreach ($dlleCtrlProducciones as $key => $value) {
							$cantidad = $model->cant_produccion;
							
							$formulacion = Formulacion::model()->findByAttributes(array('producto_id' => $model->producto, 'materia_prima' => $value->insumo_id));
							$insumo = Insumo::model()->findByPk($formulacion->materia_prima);
							if (isset($insumo)) {
								$insumo->cantidad += ($formulacion->peso*$model->cant_produccion);
								if (!$insumo->save()) {
									$transaction->rollback();
									print_r($insumo->getErrors());
									echo "insumo<br>";
									echo "<br>";
									exit;
								}


								$provInsumo = ProveedorInsumo::model()->findByAttributes(array('insumo_id' => $formulacion->materia_prima,'proveedor_id'=>$value->proveedor_id), array('order' => 'cantidad DESC'));
								if (isset($provInsumo)) {
									$proveedor = $provInsumo->proveedor_id;
									$provInsumo->cantidad += ($formulacion->peso*$model->cant_produccion);
									
									/*echo "cant=".$provInsumo->cantidad;
									if (!$provInsumo->save()) {
										var_dump($provInsumo->getErrors());
										echo "provInsumo<br>";
										echo "<br>";
										$transaction->rollback();
										exit;
									}*/
									$connection = Yii::app()->db;
									$sql        = "UPDATE proveedor_insumo SET cantidad = $provInsumo->cantidad WHERE insumo_id = $formulacion->materia_prima AND proveedor_id = $value->proveedor_id";
									$command    = $connection->createCommand($sql);
									$command->execute();
								}

								
								if($value->tipo == 0) // carnica
								{
									$rmpc = RecepcionMateriaPrimaCarnica::model()->findByPk($value->lote_interno);
									
									if(isset($rmpc)) //carnica
									{
										$rmpc->peso             = $rmpc->peso+$cantidad;
										$rmpc->devolucion_si_no = 0;
										$rmpc->unidad           = 0;
										if (!$rmpc->save()) {
											$transaction->rollback();
											print_r($rmpc->getErrors());
											echo "<br>rmpc 22<br>";
											echo "<br>";
											exit;
										}
										$cantidad = 0;				
									}								
									
								}
								else if($value->tipo == 1) // no carnica
								{
									$rmpnc = RecepcionMateriaPrimaNoCarnica::model()->findByPk($value->lote_interno);
									if(isset($rmpnc)) //no carnica
									{
										$rmpnc->peso_total       = $rmpnc->peso_total+$cantidad;
										$rmpnc->devolucion_si_no = 0;
										$rmpnc->unidad           = 0;
										if (!$rmpnc->save()) {
											$transaction->rollback();
											print_r($rmpnc->getErrors());
											echo "<br>rmpnc 22<br>";
											echo "<br>";
											exit;
										}
										$cantidad = 0;		
									}
									
								}
								else //vegetales
								{
									$rveg = RecepcionVegetales::model()->findByPk($value->lote_interno);
									$rveg->peso_total       = $rveg->peso_total+$cantidad;
									$rveg->devolucion_si_no = 0;
									$rveg->unidad           = 0;
									if (!$rveg->save()) {
										$transaction->rollback();
										print_r($rveg->getErrors());
										echo "<br>rveg 22<br>";
										echo "<br>";
										exit;
									}
									$cantidad = 0;	
								}
							}
						}
					}
					$transaction->commit();
					echo "Se actualizo correctamente";
				}
				else
				{
					echo "<pre>";
					print_r($model->getErrors());
					exit;
				}
			}
		}
		catch (Exception $exc) {
			$transaction->rollback();
			Yii::log("Error control de producciones anular : $exc", 'error', 'application.controllers.TercerosmetasController');
			return $exc;
		}
	}

	public function actionEliminarSesionNCarnicos() {
		$id  = $_REQUEST['id'];
		$arr = Yii::app()->user->nocarnico;
		unset($arr[$id]);
		ksort($arr);
		Yii::app()->user->setState('nocarnico', $arr);
		if (count($arr) == 0) {
			Yii::app()->user->setState('nocarnico', array());
		}

		$ncarnico = Yii::app()->user->nocarnico;

		$tncarnico = "<br><table with='100%' border='1' class='table table-bordered'>
	 	<tr>
	 		<td colspan='5' bgcolor='#A03233'><center><strong><FONT FACE='arial' SIZE=5 COLOR=white>FORMULACION NO CARNICA</font></strong></center></td>
	 	</tr>
	 	<tr>
	    	<td align='center'  bgcolor='#A03233'><FONT FACE='arial' SIZE=3 COLOR=white><strong>#</strong></td>
		    <td align='center'  bgcolor='#A03233'><FONT FACE='arial' SIZE=3 COLOR=white><strong>Producto</font></strong></td>
		    <td align='center'  bgcolor='#A03233'><FONT FACE='arial' SIZE=3 COLOR=white><strong>Cantidad</font></strong></td>
		    <td align='center'  bgcolor='#A03233'><FONT FACE='arial' SIZE=3 COLOR=white><strong>Lote</font></strong></td>
		    <td align='center'  bgcolor='#A03233'><FONT FACE='arial' SIZE=3 COLOR=white><strong>Quitar</font></strong></td>
	  	</tr>";
		foreach ($ncarnico as $key => $value) {

			$prod = Insumo::model()->findByPk($value['productonc']);
			$lote = RecepcionMateriaPrimaNoCarnica::model()->findByPk($value['lote']);
			$tncarnico .= "<tr>";
			$tncarnico .= "<td align='center' bgcolor='WHITE'>".$key."</td>";
			$tncarnico .= "<td align='center' bgcolor='WHITE'>".$prod['materia_prima']."</td>";
			$tncarnico .= "<td align='center' bgcolor='WHITE'>".$lote['cantidad']."</td>";
			$tncarnico .= "<td align='center' bgcolor='WHITE'>".$lote['lote_interno']."-".$lote['fec_ingreso']."</td>";
			$tncarnico .= "<td align='center' bgcolor='WHITE'><a href='#' onclick='eliminarElementoNCarnico(".$key.")'><img src='../images/borrar.png'></a></td>";
			$tncarnico .= "</tr>";
		}
		$tncarnico .= "<table>";
		echo $tncarnico;

	} 

	public function actionEliminarSesionCarnicos() {
		$id  = $_REQUEST['id'];
		$arr = Yii::app()->user->carnico;
		unset($arr[$id]);
		ksort($arr);
		Yii::app()->user->setState('carnico', $arr);
		if (count($arr) == 0) {
			Yii::app()->user->setState('carnico', array());
		}

		$carnico  = Yii::app()->user->carnico;
		$tcarnico = "<br><table with='100%' border='1' class='table table-bordered'>
		 	<tr>
		 		<td colspan='5' bgcolor='#A03233'><center><strong><FONT FACE='arial' SIZE=4 COLOR=white>FORMULACION CARNICA</font></strong></center></td>
		 	</tr>
		 	<tr>
		    	<td align='center'  bgcolor='#A03233'><FONT FACE='arial' SIZE=3 COLOR=white><strong>#</strong></td>
			    <td align='center'  bgcolor='#A03233'><FONT FACE='arial' SIZE=3 COLOR=white><strong>Proveedor</font></strong></td>
			    <td align='center'  bgcolor='#A03233'><FONT FACE='arial' SIZE=3 COLOR=white><strong>Producto</font></strong></td>
			    <td align='center'  bgcolor='#A03233'><FONT FACE='arial' SIZE=3 COLOR=white><strong>cantidad</font></strong></td>
			    <td align='center'  bgcolor='#A03233'><FONT FACE='arial' SIZE=3 COLOR=white><strong>Quitar</font></strong></td>
		  	</tr>";
		foreach ($carnico as $key => $value) {
			$proveedor = Proveedor::model()->findByPk($value['proveedor']);
			$producto  = Insumo::model()->findByPk($value['producto']);
			$tcarnico .= "<tr>
					    	<td align='center' bgcolor='WHITE'>".$key."</td>
						    <td align='center' bgcolor='WHITE'>".$proveedor->nom_proveedor."</td>
						    <td align='center' bgcolor='WHITE'>".$producto->materia_prima."</td>
						    <td align='center' bgcolor='WHITE'>".$value['cantidad']."</td>
						    <td align='center' bgcolor='WHITE'><a href='#' onclick='eliminarElementoCarnico(".$key.")'><img src='../images/borrar.png'></a></td>
					  	</tr>";

		}
		$tcarnico .= "</table>";

		echo $tcarnico;
	}

	public function actionCargarSesion() {
		$tcarnico  = "";
		$tncarnico = "";
		$cant      = count(Yii::app()->user->insumos);
		if ($cant != 0) {
			$insumos = Yii::app()->user->insumos;

			$tncarnico = "<br><table with='100%' border='1' class='table table-bordered'>
		 	<tr>
		 		<td colspan='5' bgcolor='#A03233'><center><strong><FONT FACE='arial' SIZE=5 COLOR=white>FORMULACION NO CARNICA</font></strong></center></td>
		 	</tr>
		 	<tr>
		    	<td align='center'  bgcolor='#A03233'><FONT FACE='arial' SIZE=3 COLOR=white><strong>#</strong></td>
			    <td align='center'  bgcolor='#A03233'><FONT FACE='arial' SIZE=3 COLOR=white><strong>Producto</font></strong></td>
			    <td align='center'  bgcolor='#A03233'><FONT FACE='arial' SIZE=3 COLOR=white><strong>Cantidad</font></strong></td>
			    <td align='center'  bgcolor='#A03233'><FONT FACE='arial' SIZE=3 COLOR=white><strong>Lote</font></strong></td>
			    <td align='center'  bgcolor='#A03233'><FONT FACE='arial' SIZE=3 COLOR=white><strong>Quitar</font></strong></td>
		  	</tr>";
				/*foreach ($ncarnico as $key => $value) {

					$prod = Insumo::model()->findByPk($value['productonc']);
					$lote = RecepcionMateriaPrimaNoCarnica::model()->findByPk($value['lote']);
					$tncarnico .= "<tr>";
					$tncarnico .= "<td align='center' bgcolor='WHITE'>".$key."</td>";
					$tncarnico .= "<td align='center' bgcolor='WHITE'>".$prod['materia_prima']."</td>";
					$tncarnico .= "<td align='center' bgcolor='WHITE'>".$value['cantidad']."</td>";
					$tncarnico .= "<td align='center' bgcolor='WHITE'>".$lote['lote_interno']."-".$lote['fec_ingreso']."</td>";
					$tncarnico .= "<td align='center' bgcolor='WHITE'><a href='#' onclick='eliminarElementoNCarnico(".$key.")'><img src='../images/borrar.png'></a></td>";
					$tncarnico .= "</tr>";
				}
				$tncarnico .= "<table>";*/
		}

		/*$cant = count(Yii::app()->user->carnico);
		if ($cant != 0) {
			$carnico  = Yii::app()->user->carnico;
			$tcarnico = "<br><table with='100%' border='1' class='table table-bordered'>
		 	<tr>
		 		<td colspan='5' bgcolor='#A03233'><center><strong><FONT FACE='arial' SIZE=4 COLOR=white>FORMULACION CARNICA</font></strong></center></td>
		 	</tr>
		 	<tr>
		    	<td align='center'  bgcolor='#A03233'><FONT FACE='arial' SIZE=3 COLOR=white><strong>#</strong></td>
			    <td align='center'  bgcolor='#A03233'><FONT FACE='arial' SIZE=3 COLOR=white><strong>Proveedor</font></strong></td>
			    <td align='center'  bgcolor='#A03233'><FONT FACE='arial' SIZE=3 COLOR=white><strong>Producto</font></strong></td>
			    <td align='center'  bgcolor='#A03233'><FONT FACE='arial' SIZE=3 COLOR=white><strong>cantidad</font></strong></td>
			    <td align='center'  bgcolor='#A03233'><FONT FACE='arial' SIZE=3 COLOR=white><strong>Quitar</font></strong></td>
		  	</tr>";
			foreach ($carnico as $key => $value) {
				$proveedor = Proveedor::model()->findByPk($value['proveedor']);
				//$producto  = Insumo::model()->findByPk($value['producto']);
				$tcarnico .= "<tr>
					    	<td align='center' bgcolor='WHITE'>".$key."</td>
						    <td align='center' bgcolor='WHITE'>".$proveedor->nom_proveedor."</td>
						    <td align='center' bgcolor='WHITE'>".$value['producto']."</td>
						    <td align='center' bgcolor='WHITE'>".$value['cantidad']."</td>
						    <td align='center' bgcolor='WHITE'><a href='#' onclick='eliminarElementoCarnico(".$key.")'><img src='../images/borrar.png'></a></td>
					  	</tr>";

			}
			$tcarnico .= "</table>";
		}

		$env = array('nocarnico' => $tncarnico, 'carnico' => $tcarnico);
		echo json_encode($env);*/
	}

	public function actionGetCalcularPeso() {
		$prod            = $_POST['producto'];
		$cant_produccion = $_POST['cant_produccion'];

		$formulacion = Formulacion::model()->findAllByAttributes(array('producto_id' => $prod));

		$cantidad = 0;
		foreach ($formulacion as $key => $value) {
			$cantidad += $value->peso;
		}
		echo $cantidad*$cant_produccion;
	}

	public function actionQuitarSesion() {
		Yii::app()->user->setState('insumos', []);
		Yii::app()->user->setState('nocarnico', array());
print_r(Yii::app()->user->insumos);
	}

	public function actionEliminarTablaCarnicos() {
		$id  = $_POST['id'];
		$arr = Yii::app()->user->arreglo;
		unset($arr[$id]);
		Yii::app()->user->setState('arreglo', $arr);
		$this->dibujarTabla($arr);

	}

	public function actionGenerarTablaCarnicos() {
		$proveedor = $_POST['proveedor'];
		$producto  = $_POST['producto'];
		$cantidad  = $_POST['cantidad'];
		$arr       = array();
		$cant      = count(Yii::app()->user->arreglo);
		if ($cant != 0) {
			$arr = Yii::app()->user->arreglo;
		}

		$sql = "SELECT DISTINCT `insumo`.`id`, concat(lote_interno,' - ', insumo.materia_prima) AS nom_proveedor
			FROM `proveedor_insumo` `pi`
			INNER JOIN insumo ON insumo.id = pi.insumo_id
			INNER JOIN recepcion_materia_prima_carnica r ON r.materia_prima_insumo = insumo.id
			INNER JOIN proveedor p ON p.id = pi.proveedor_id
			WHERE pi.proveedor_id = $proveedor
				AND r.proveedor = $proveedor
				AND `insumo`.`id` = $producto
				AND pi.cantidad > 0
			ORDER BY `fec_ingreso`";
		$result = Yii::app()->db->createCommand($sql)->queryRow();

		$array = array(
			"proveedor" => $proveedor,
			"producto"  => $result['nom_proveedor'],
			"cantidad"  => $cantidad,
			"insumo_id" => $result['id'],
		);
		$arr[$cant] = $array;
		Yii::app()->user->setState('arreglo', $arr);
		Yii::app()->user->setState('carnico', $arr);

		$i = 1;
		$this->dibujarTabla($arr);
	}

	private function dibujarTabla($arr) {
		echo "<br><table with='100%' border='1' class='table table-bordered'>
		 	<tr>
		 		<td colspan='5' bgcolor='#A03233'><center><strong><FONT FACE='arial' SIZE=3 COLOR=white>FORMULACION CARNICA</font></strong></center></td>
		 	</tr>
		 	<tr>
		    	<td align='center'  bgcolor='#A03233'><FONT FACE='arial' SIZE=3 COLOR=white><strong>#</strong></td>
			    <td align='center'  bgcolor='#A03233'><FONT FACE='arial' SIZE=3 COLOR=white><strong>Proveedor</font></strong></td>
			    <td align='center'  bgcolor='#A03233'><FONT FACE='arial' SIZE=3 COLOR=white><strong>Producto</font></strong></td>
			    <td align='center'  bgcolor='#A03233'><FONT FACE='arial' SIZE=3 COLOR=white><strong>cantidad</font></strong></td>
			    <td align='center'  bgcolor='#A03233'><FONT FACE='arial' SIZE=3 COLOR=white><strong>Quitar</font></strong></td>
		  	</tr>";
		foreach ($arr as $key => $value) {
			$proveedor = Proveedor::model()->findByPk($value['proveedor']);
			//$producto  = Insumo::model()->findByPk($value['producto']);
			echo "<tr>
				    	<td align='center' bgcolor='WHITE'>".$key."</td>
					    <td align='center' bgcolor='WHITE'>".$proveedor->nom_proveedor."</td>
					    <td align='center' bgcolor='WHITE'>".$value['producto']."</td>
					    <td align='center' bgcolor='WHITE'>".$value['cantidad']."</td>
					    <td align='center' bgcolor='WHITE'><a href='#' onclick='eliminarFormula(".$key.")'><img src='../images/borrar.png'></a></td>
				  	</tr>";

		}
		echo "</table>";
	}

	

	public function actionGetFormulacion() {
		$prod     = $_POST['producto'];
		$cantidad = $_POST['cantidad'];

		$formulacion = Formulacion::model()->findAllByAttributes(array('producto_id' => $prod));
		$v       = 0;
		$insumos = array();

		$insumo1 = "";

		foreach ($formulacion as $key => $value) {
			$peso     = $cantidad*$value['peso'];
			$matPrima = $value['materia_prima'];

			$insumo = Insumo::model()->findByPk($matPrima);
			if (isset($insumo) && $insumo->cantidad < $peso) {
				$v         = 1;

				$insumo1[] = array('insumo'   => $insumo->materia_prima,
								   'cantidad' => ($peso-$insumo->cantidad)
								);
			}
		}

		$this->renderPartial('_formulacion', array('model' => $formulacion, 'validacion' => $v, 'insumo' => $insumo1));
	}

	public function actionGetProductosnc() {
		$sql      = 'SELECT id,materia_prima FROM insumo WHERE materia_prima LIKE :materia_prima AND (tipo = "1" OR tipo = "2")AND cantidad > 0 order by materia_prima';
		$producto = Insumo::model()->findAllBySql($sql, array(':materia_prima' => '%'.$_POST['q'].'%'));

		echo CJSON::encode(array(
				'deptos' => $producto,
			)
		);
	}

	public function actionGetLote() {
		$producto = $_POST['producto'];
		$sql      = 'SELECT rmnc.id, concat(lote_interno," - ",fec_ingreso," - ", round(peso_total,2)) AS lote_interno
					FROM recepcion_materia_prima_no_carnica rmnc
					INNER JOIN insumo i ON i.id = rmnc.materia_prima_insumo
			       	WHERE materia_prima_insumo = :insumo
			       		AND peso_total > 0		       		
			       	UNION
			       	SELECT rv.id, concat(lote_interno," - ",fecha_lote," - ", round(peso_total,2)) AS lote_interno
					FROM recepcion_vegetales rv
					INNER JOIN insumo i ON i.id = rv.materia_prima_insumo
			       	WHERE materia_prima_insumo = :insumo
			       		AND peso_total > 0
			       	UNION
			       	SELECT rmc.id, concat(lote_interno," - ",fec_ingreso," - ", round(peso,2)) AS lote_interno
					FROM recepcion_materia_prima_carnica rmc
					INNER JOIN insumo i ON i.id = rmc.materia_prima_insumo
			       	WHERE materia_prima_insumo = :insumo
			       		AND peso > 0
		       	';
		$lote = RecepcionMateriaPrimaNoCarnica::model()->findAllBySql($sql, array(':insumo' => $producto));
		echo CJSON::encode(array(
				'deptos' => $lote,
			)
		);
	}

	public function actionGetProveedor() {
		$prov = Proveedor::model()->findAllBySql('SELECT id,CONCAT(nom_proveedor," ",codigo_base) AS nom_proveedor FROM  proveedor WHERE tipo = "0" AND nom_proveedor like :nprov OR codigo_base like :cbase ORDER BY nom_proveedor ', array(':nprov' => '%'.$_POST['q'].'%', ':cbase' => '%'.$_POST['q'].'%'));
		echo CJSON::encode(array(
				'deptos' => $prov,
			)
		);
	}

	public function actionGetProductos() {
		$proveedor = $_POST['CtrlProduccionesTrazabilidad']['proveedor'];

		$model = "";
		$sql   = "SELECT DISTINCT `insumo`.`id`, concat(lote_interno,' - ', insumo.materia_prima) AS nom_proveedor
			FROM `proveedor_insumo` `pi`
			INNER JOIN insumo ON insumo.id = pi.insumo_id
			INNER JOIN recepcion_materia_prima_carnica r ON r.materia_prima_insumo = insumo.id
			INNER JOIN proveedor p ON p.id = pi.proveedor_id
			WHERE pi.proveedor_id =".$proveedor." AND r.proveedor =".$proveedor." AND pi.cantidad > 0
			ORDER BY `fec_ingreso`";
		$model = ProveedorInsumo::model()->findAllBySql($sql);

		$data = CHtml::listData($model, 'id', 'nom_proveedor');

		echo CHtml::tag('option', array('value'  => ''), 'Seleccione un producto...', true);
		foreach ($data as $id                    => $value) {
			echo CHtml::tag('option', array('value' => $id), CHtml::encode($value), true);
		}
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id) {
		$model = $this->loadModel($id);

		$detalle = new DetalleCtrlProducciones('search');
		$detalle->unsetAttributes();// clear any default values
		$detalle->ctrl_producciones_id = $model->id;
		if (isset($_GET['CtrlProduccionesTrazabilidad'])) {
			$model->attributes = $_GET['CtrlProduccionesTrazabilidad'];
		}

		$this->render('view', array(
				'model'   => $model,
				'detalle' => $detalle,
			));
	}

	public function actionGuardarSesion() {
		$postdata   = file_get_contents("php://input");

		$request    = json_decode($postdata);
		$lote       = $request->lote;
		$productonc = $request->productonc;
		$cantidad   = $request->cantidad;

		$arr        = Yii::app()->user->nocarnico;
		$cant       = count($arr)+1;
		$arr[$cant] = array('lote' => $lote, 'productonc' => $productonc,'cantidad'=>$cantidad);
		Yii::app()->user->setState('nocarnico', $arr);

	}

	


	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate() {
		$transaction = Yii::app()->db->beginTransaction();
		try
		{
			Yii::app()->user->setState('arreglo', array());
			$sesion = 0;
			/*$cant   = count(Yii::app()->user->nocarnico);
			$cant1  = count(Yii::app()->user->carnico);
			$sesion += $cant;
			$sesion += $cant1;*/

			$model                     = new CtrlProduccionesTrazabilidad;
			$dlleCtrlProducciones      = new DetalleCtrlProducciones;
			$dlleCtrlProduccionesAdmin = new DetalleCtrlProducciones('search');
			// Uncomment the following line if AJAX validation is needed
			// $this->performAjaxValidation($model);

			if (isset($_POST['CtrlProduccionesTrazabilidad'])) {

				$model->attributes = $_POST['CtrlProduccionesTrazabilidad'];
				$detalle           = Yii::app()->user->carnico;
				$guardado          = 0;
				if ($model->save()) {
					$productos = array();
					$detalle     = $_POST['CtrlProduccionesTrazabilidad']['detalle'];
					$ingreso     = $_POST['CtrlProduccionesTrazabilidad']['detalle'];
					foreach ($ingreso as $key => $value) {
						
							foreach ($value as $insumo => $lote) {
								$ins = explode('_', $insumo);

								if($ins[0] == 'lote')
								{
									if(!isset($datos[$key][$lote]))
										$datos[$key][$lote] = $cant;
								}
								else
								{
									$cant = $lote;

								}
							}
					}

 					Yii::log("datos formula : ".print_r($datos,true), 'error', 'application.controllers.TercerosmetasController');
					foreach ($datos as $key => $value) {						
						foreach ($value as $lote => $valorCantidad) {
							if($lote != "")
							{
								if($key == 0) //carnico
								{
									$rmpc   = RecepcionMateriaPrimaCarnica::model()->findByPk($lote);
									if(isset($rmpc))
									{
										$insumo = $rmpc->materia_prima_insumo;
										$proveedor = $rmpc->proveedor;
										$rmpc->peso -= $valorCantidad;
										$rmpc->devolucion_si_no = 0;
										if($rmpc->save())
 											Yii::log("insummo: $insumo lote: $lote rmpc=".print_r($rmpc,true), 'error', 'application.controllers.TercerosmetasController');
 										else
 											Yii::log("error rmpc=".print_r($rmpc->getErrors(),true), 'error', 'application.controllers.TercerosmetasController');

									}
									else
									{
										echo "<pre>";
									print_r("l=".$lote);
									exit;
									}
								}
								else if($key == 1)
								{
									$rmpnc  = RecepcionMateriaPrimaNoCarnica::model()->findByPk($lote);
									if(isset($rmpnc))
									{
										$insumo = $rmpnc->materia_prima_insumo;
										$proveedor = $rmpnc->proveedor_id;
										$rmpnc->peso_total -= $valorCantidad;
										$rmpnc->devolucion_si_no = 0;
										$rmpnc->save();

									}
									else
									{
										echo "<pre>";
									print_r($lote);
									exit;
									}
								}
								else
								{
									$rveg   = RecepcionVegetales::model()->findByPk($lote);
									$insumo = $rveg->materia_prima_insumo;
									$proveedor = $rveg->proveedor_id;
									$rveg->peso_total -= $valorCantidad;
									$rveg->save();
								}

								$provInsumo = ProveedorInsumo::model()->findByAttributes(array('insumo_id' => $insumo), array('order' => 'cantidad DESC'));
								if (isset($provInsumo)) {
									/*$provInsumo->cantidad -= $valorCantidad;
									if (!$provInsumo->save()) {
										$transaction->rollback();
										var_dump($provInsumo->getErrors());
										echo "provInsumo 2<br>";
										exit;
									}*/
									$connection = Yii::app()->db;
									$sql        = "UPDATE proveedor_insumo SET cantidad = cantidad - $provInsumo->cantidad WHERE insumo_id = $insumo AND proveedor_id = $proveedor";
									$command    = $connection->createCommand($sql);
									$command->execute();

									$ins = Insumo::model()->findByPk($insumo);
									$ins->cantidad -= $value['cantidad_tipo'];
									$ins->save();

									$dlleCtrlProducciones                       = new DetalleCtrlProducciones;
									$dlleCtrlProducciones->ctrl_producciones_id = $model->id;
									$dlleCtrlProducciones->tipo                 = $key;  //0 carnico 1 no carnico y 2 vegetales
									$dlleCtrlProducciones->insumo_id            = $insumo;
									$dlleCtrlProducciones->cantidad             = $valorCantidad;
									$dlleCtrlProducciones->proveedor_id         = $proveedor;
									$dlleCtrlProducciones->lote_interno         = $lote;
									if ($dlleCtrlProducciones->save()) {
										
									} else {
										$transaction->rollback();
										print_r($provInsumo->getErrors());
										foreach ($dlleCtrlProducciones->errors as $key => $value) {
											foreach ($value as $k                         => $val) {
												echo "error=".$val." insumo=".$value->materia_prima;
											}
											# code...
										}
										exit;
									}
								}

								
							}
						}
						
						
					}

					
					$producto = Producto::model()->findByPk($model->producto);
					$producto->cantidad += $model->peso;
					if (!$producto->save()) {
						$transaction->rollback();
						print_r($producto->getErrors());
						echo "producto 4<br>";
						exit;
					} else {
						$transaction->commit();
						$this->redirect(array('view', 'id' => $model->id));
					}
				}
			}

			$fecha        = date('Y-m-d H:i:s');
			$trazabilidad = CtrlProduccionesTrazabilidad::model()->findAllBySql("SELECT orden_produccion, fecha FROM ctrl_producciones_trazabilidad WHERE fecha='".$fecha."'");
			if (isset($trazabilidad)) {
				$cant = count($trazabilidad);
				if ($cant == 0) {
					$model->orden_produccion = 1;
				} else {

					$model->orden_produccion = $cant+1;
				}
			} else {
				$model->orden_produccion = 1;
			}

			if(isset(Yii::app()->user->insumos))
			{
    			if(count(Yii::app()->user->insumos) == 0)
    				Yii::app()->user->setState('insumos', []);
			}
			else
			    Yii::app()->user->setState('insumos', []);

			$this->render('create', array(
					'model'                     => $model,
					'dlleCtrlProducciones'      => $dlleCtrlProducciones,
					'dlleCtrlProduccionesAdmin' => $dlleCtrlProduccionesAdmin,
					//'sesion'                    => count($sesion),
				));
		} catch (Exception $exc) {
			$transaction->rollback();
			Yii::log("Error control de producciones trazabilidad : $exc", 'error', 'application.controllers.TercerosmetasController');
			return $exc;
		}
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id) {
		$model                     = $this->loadModel($id);
		$dlleCtrlProducciones      = new DetalleCtrlProducciones;
		$dlleCtrlProduccionesAdmin = new DetalleCtrlProducciones('search');

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['CtrlProduccionesTrazabilidad'])) {
			$model->attributes = $_POST['CtrlProduccionesTrazabilidad'];
			if ($model->save()) {
				$this->redirect(array('view', 'id' => $model->id));
			}
		}

		$this->render('update', array(
				'model'                     => $model,
				'dlleCtrlProducciones'      => $dlleCtrlProducciones,
				'dlleCtrlProduccionesAdmin' => $dlleCtrlProduccionesAdmin,
			));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id) {
		if (Yii::app()->request->isPostRequest) {
			$detalle = DetalleCtrlProducciones::model()->deleteAll('ctrl_producciones_id=:ctrl', array(':ctrl' => $id));

			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if (!isset($_GET['ajax'])) {
				$this->redirect(isset($_POST['returnUrl'])?$_POST['returnUrl']:array('admin'));
			}
		} else {

			throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
		}
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('CtrlProduccionesTrazabilidad');
		$this->render('index', array(
				'dataProvider' => $dataProvider,
			));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin() {
		$model = new CtrlProduccionesTrazabilidad('search');
		$model->unsetAttributes();// clear any default values
		if (isset($_GET['CtrlProduccionesTrazabilidad'])) {
			$model->attributes = $_GET['CtrlProduccionesTrazabilidad'];
		}

		$this->render('admin', array(
				'model' => $model,
			));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return CtrlProduccionesTrazabilidad the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id) {
		$model = CtrlProduccionesTrazabilidad::model()->findByPk($id);
		if ($model === null) {
			throw new CHttpException(404, 'The requested page does not exist.');
		}

		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CtrlProduccionesTrazabilidad $model the model to be validated
	 */
	protected function performAjaxValidation($model) {
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'ctrl-producciones-trazabilidad-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}