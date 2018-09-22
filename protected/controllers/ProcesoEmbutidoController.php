<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(-1);
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods:GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers:Content-type, X-Requested-With");

class ProcesoEmbutidoController extends Controller
{
	/**
	* @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	* using two-column layout. See 'protected/views/layouts/column2.php'.
	*/
	public $layout='//layouts/column2';

	/**
	* @return array action filters
	*/
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	public function init()
	{
		$formulaEstimados = FormulaEstimado::model()->with('producto')->findAll();
		foreach ($formulaEstimados as $key => $value) {
			
			$formulaEstimado[$key] = [
								'producto_id' => $value->producto_id,
								'producto'    => $value->producto->nombre,
								'peso'        => $value->peso,
								'longitud'    => $value->longitud,
								'insumo_id'   => $value->insumo_id,
							];
		}
		
		if(isset($formulaEstimado))
			Yii::app()->user->setState('formulaEstimado',json_encode($formulaEstimado));
	} 

	/**
	* Specifies the access control rules.
	* This method is used by the 'accessControl' filter.
	* @return array access control rules
	*/
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('delete'),
                'expression' => 'Yii::app()->user->checkAccess("Admin1") || Yii::app()->user->checkAccess("admin") || Yii::app()->user->checkAccess("Embutidor1")',
			),
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('getLoteTipo','getLote','Estimado','eliminarDetalle','index','view','admin','create','update','GetProducto','generarTablaInsumos','eliminarTablaInsumos','GetTanda','GetCantidadEntranteTanda','getEstimado'),
                'expression' => 'Yii::app()->user->checkAccess("Admin1") || Yii::app()->user->checkAccess("admin") || Yii::app()->user->checkAccess("Embutidor1")',
			),
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('getLoteTipo','getLote','Estimado','index','view','admin','update','GetProducto','generarTablaInsumos','eliminarTablaInsumos','GetTanda','GetCantidadEntranteTanda','getEstimado'),
                'expression' => 'Yii::app()->user->checkAccess("Embutidor1")',
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	* Displays a particular model.
	* @param integer $id the ID of the model to be displayed
	*/
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	* Creates a new model.
	* If creation is successful, the browser will be redirected to the 'view' page.
	*/
	public function actionCreate()
	{
		$transaction = Yii::app()->db->beginTransaction();
        try
        {
        	
			$model=new ProcesoEmbutido;

			// Uncomment the following line if AJAX validation is needed
			// $this->performAjaxValidation($model);

			if(isset($_POST['ProcesoEmbutido']))
			{

				$model->attributes = $_POST['ProcesoEmbutido'];
				if($model->save())
				{
					$productos = $_POST['ProcesoEmbutido']['producto'];
					$detalle = Yii::app()->user->insumos;		
					foreach ($productos as $key => $value) {
						if($value['producto'] != "")
						{
							$modelEmbutidoProductos                      = new EmbutidoProductos;
							$modelEmbutidoProductos->fecha               = date('Y-m-d H:i:s');
							$modelEmbutidoProductos->proceso_embutido_id = $model->id;
							$modelEmbutidoProductos->producto_id         = $value['producto'];
							$modelEmbutidoProductos->lote_producto       = $value['lote_producto'];
							$modelEmbutidoProductos->cantidad            = $value['cantidad'];
							$modelEmbutidoProductos->estimado            = $value['estimado'];
							$modelEmbutidoProductos->tipo                = $value['tipo'];
							$modelEmbutidoProductos->lote_tipo           = $value['lote_tipo'];
							$modelEmbutidoProductos->cantidad_tipo       = $value['cantidad_tipo'];
							$modelEmbutidoProductos->peso                = $value['peso'];
							$modelEmbutidoProductos->longitud            = $value['longitud_'];
							$modelEmbutidoProductos->valor_real          = $value['real'];
							$modelEmbutidoProductos->diferencia          = $value['diferencia'];

							if(!$modelEmbutidoProductos->save())
							{
								$transaction->rollback();
            					Yii::log("Error control de producciones trazabilidad : ".print_r($modelEmbutidoProductos->getErrors(),true), 'error', 'application.controllers.TercerosmetasController');
							}
						}
					}
					
					
        			$transaction->commit();
					$this->redirect(array('view','id'=>$model->id));
				}
			}
			else
				Yii::app()->user->setState('insumos',array());


			$this->render('create',array(
				'model'=>$model,
			));
		}catch (Exception $exc) {
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
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ProcesoEmbutido']))
		{
			
			if(!Yii::app()->user->checkAccess("Admin1"))
			{
				$datos = [];
				$producto_ids = $_POST['ProcesoEmbutido']['producto_id'];
				foreach ($producto_ids as $key => $producto_id) {
					if(!isset($datos[$producto_id]))
						$datos[$producto_id] = [
												'valor_real'  => $_POST['ProcesoEmbutido']['valor_real'][$key],
												'diferencias' => $_POST['ProcesoEmbutido']['diferencia'][$key]
											];
					
				}

				$model->attributes=$_POST['ProcesoEmbutido'];
				if($model->save())
				{

					foreach ($datos as $producto_id => $value) {
						$modelEmbutidoProductos             = EmbutidoProductos::model()->findByAttributes(array('proceso_embutido_id' => $model->id,'producto_id'=>$producto_id));
						$modelEmbutidoProductos->valor_real = round($value['valor_real'],2);
						$modelEmbutidoProductos->diferencia = round($value['diferencias'],2);
						if(!$modelEmbutidoProductos->save())
						{
							print_r($modelEmbutidoProductos->getErrors());
							exit;
						}
					}

					$this->redirect(array('view','id'=>$model->id));
				}
			}
			else
			{
				$model->attributes = $_POST['ProcesoEmbutido'];
				$productos         = $_POST['productos'];
				
				if($model->save())
				{
					foreach ($productos as $key => $producto) {
						$modelEmbutidoProductos = EmbutidoProductos::model()->findByAttributes(array('proceso_embutido_id' => $model->id,'producto_id'=>$producto['producto']));
						if(isset($modelEmbutidoProductos))
						{
							$modelEmbutidoProductos                      = new EmbutidoProductos;
							$modelEmbutidoProductos->fecha               = date('Y-m-d H:i:s');
							$modelEmbutidoProductos->proceso_embutido_id = $model->id;
							$modelEmbutidoProductos->producto_id         = $value['producto'];
							$modelEmbutidoProductos->lote_producto       = $value['lote_producto'];
							$modelEmbutidoProductos->cantidad            = $value['cantidad'];
							$modelEmbutidoProductos->estimado            = $value['estimado'];
							$modelEmbutidoProductos->tipo                = $value['tipo'];
							$modelEmbutidoProductos->lote_tipo           = $value['lote_tipo'];
							$modelEmbutidoProductos->cantidad_tipo       = $value['cantidad_tipo'];
							$modelEmbutidoProductos->peso                = $value['peso'];
							$modelEmbutidoProductos->longitud            = $value['longitud'];
							$modelEmbutidoProductos->valor_real          = $value['real'];
							$modelEmbutidoProductos->diferencia          = $value['diferencia'];
							$modelEmbutidoProductos->save();
							$this->redirect(array('view','id'=>$model->id));
						}
						else
						{
							$modelEmbutidoProductos                      = new EmbutidoProductos;
							$modelEmbutidoProductos->fecha               = date('Y-m-d H:i:s');
							$modelEmbutidoProductos->proceso_embutido_id = $model->id;
							$modelEmbutidoProductos->producto_id         = $value['producto'];
							$modelEmbutidoProductos->lote_producto       = $value['lote_producto'];
							$modelEmbutidoProductos->cantidad            = $value['cantidad'];
							$modelEmbutidoProductos->estimado            = $value['estimado'];
							$modelEmbutidoProductos->tipo                = $value['tipo'];
							$modelEmbutidoProductos->lote_tipo           = $value['lote_tipo'];
							$modelEmbutidoProductos->cantidad_tipo       = $value['cantidad_tipo'];
							$modelEmbutidoProductos->peso                = $value['peso'];
							$modelEmbutidoProductos->longitud            = $value['longitud'];
							$modelEmbutidoProductos->valor_real          = $value['real'];
							$modelEmbutidoProductos->diferencia          = $value['diferencia'];
							$modelEmbutidoProductos->save();
							$this->redirect(array('view','id'=>$model->id));
						}
					}
				}
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	public function actionGetEstimado()
	{
		$postdata = file_get_contents("php://input");
		$request  = json_decode($postdata);
		$producto = $request->producto;
		$cantidad = $request->cantidad;		
		$tipo     = $request->tipo;

		$model = FormulaEstimado::model()->findByAttributes(array('producto_id'=>$producto,'insumo_id'=>$tipo));
		if(isset($model))
		{
			$estimado = ($cantidad/$model->peso) * 1000;
			$envio = ['estimado'=>round($estimado,2),'peso'=>$model->peso,'longitud'=>round($model->longitud,2)];
			echo json_encode($envio);
		}
	}

	public function actionEstimado()
	{
		$producto = $_POST['producto'];
		$cantidad = $_POST['cantidad'];		
		$tipo     = $_POST['tipo'];

		$model = FormulaEstimado::model()->findByAttributes(array('producto_id'=>$producto,'insumo_id'=>$tipo));
		if(isset($model))
		{
			$estimado = ($cantidad/$model->peso) * 1000;
			$envio = ['estimado'=>round($estimado,2),'peso'=>$model->peso,'longitud'=>round($model->longitud,2)];
			echo json_encode($envio);
		}
	}

	public function actionGetLote()
	{
		$lote = $_POST['lote'];
		

		$datos    = CtrlProduccionesTrazabilidad::model()->findByPk($lote);
		
		if(isset($datos))
		{
			$arreglo[0]['id']     = $datos['id'];
			$arreglo[0]['nombre'] = $datos['fecha']." ".$datos['orden_produccion']." ".$datos['producto0']->nombre;
			// echo json_encode($arreglo);
			echo CJSON::encode(array(
			'deptos'=>$arreglo,
			)
		);
			// $model = new ProcesoEmbutido;
			// $this->renderPartial('_getTanda', array('ordenProduccion'=>$datos,'model'=>$model));
		}
		
	}

	public function actionGetLoteTipo()
	{
		$tipo = $_POST['tipo'];
		$criteria = new CDbCriteria(array('order'=>'id ASC'));
		$sql      = 'SELECT rmnc.id, concat(lote_interno," - ",fec_ingreso," - ", round(peso_total,2)) AS lote_interno
					FROM recepcion_materia_prima_no_carnica rmnc
					INNER JOIN insumo i ON i.id = rmnc.materia_prima_insumo
			       	WHERE materia_prima_insumo = :insumo
			       		AND peso_total > 0';

		$lote = RecepcionMateriaPrimaNoCarnica::model()->findAllBySql($sql, array(':insumo' => $tipo));
		echo CJSON::encode(array(
				'deptos' => $lote,
			)
		);
		
	}

	public function actionGetTanda()
	{
		$fecha    = $_POST['fecha'];
		$criteria = new CDbCriteria(array('order'=>'id ASC'));
		$sql   = "SELECT cpt.*
				  FROM ctrl_producciones_trazabilidad cpt
				  INNER JOIN producto p ON p.id = cpt.producto
				  WHERE cpt.id NOT IN (
				  	SELECT tanda
				    FROM proceso_embutido 
				  ) 
				  AND cpt.fecha =:fecha 
				  ORDER BY cpt.id ASC";

		$datos    = CtrlProduccionesTrazabilidad::model()->findAllBySql($sql,array(':fecha'=>$fecha));
		
		if(isset($datos))
		{
			$arreglo = [];
			foreach ($datos as $key => $value) {
				$n = $key +1;
				$arreglo[$key]['id']    = $value['id'];
				$arreglo[$key]['datos'] = $value['fecha']." ".$value['orden_produccion']." ".$value['producto0']->nombre;
			}
			echo json_encode($arreglo);
			// $model = new ProcesoEmbutido;
			// $this->renderPartial('_getTanda', array('ordenProduccion'=>$datos,'model'=>$model));
		}
		
	}

	public function actionGetCantidadEntranteTanda()
	{
		$ordenProduccion = $_POST['ordenProduccion'];
		$model = CtrlProduccionesTrazabilidad::model()->findByPk($ordenProduccion);
		echo $model->peso;
	}

	public function actionGenerarTablaInsumos()
	{
		$insumo   = $_POST['insumo'];
		$producto = $_POST['producto'];
		$cantidad = $_POST['cantidad'];
		$porcion  = $_POST['porcion'];
		$estimado = $_POST['estimado'];
		$arr      = array();
		$cant     = count(Yii::app()->user->insumos);

		if($cant != 0)
			$arr = Yii::app()->user->insumos;

		$array = array(
			"insumo"   => $insumo,
			"producto" => $producto,
			"cantidad" => $cantidad,
			"porcion"  => $porcion,
			"estimado" => $estimado
		);

		$arr[$cant] = $array;
		Yii::app()->user->setState('insumos',$arr);

		$this->dibujarTabla($arr);
 	}

 	private function dibujarTabla($arr) 
 	{
 		echo "<br><table with='100%' border='1' class='table table-bordered'>
		 	<tr>
		 		<td colspan='7' bgcolor='#A03233'><center><strong><FONT FACE='arial' SIZE=3 COLOR=white>INSUMOS</font></strong></center></td>
		 	</tr>
		 	<tr>		 		
		    	<td align='center'  bgcolor='#A03233'><FONT FACE='arial' SIZE=3 COLOR=white><strong>#</strong></td>
			    <td align='center'  bgcolor='#A03233'><FONT FACE='arial' SIZE=3 COLOR=white><strong>Producto</font></strong></td> 
			    <td align='center'  bgcolor='#A03233'><FONT FACE='arial' SIZE=3 COLOR=white><strong>Insumo</font></strong></td> 
			    <td align='center'  bgcolor='#A03233'><FONT FACE='arial' SIZE=3 COLOR=white><strong>Cantidad</font></strong></td> 
			    <td align='center'  bgcolor='#A03233'><FONT FACE='arial' SIZE=3 COLOR=white><strong>Porcion</font></strong></td>
			    <td align='center'  bgcolor='#A03233'><FONT FACE='arial' SIZE=3 COLOR=white><strong>Estimado</font></strong></td>
			    <td align='center'  bgcolor='#A03233'><FONT FACE='arial' SIZE=3 COLOR=white><strong>Quitar</font></strong></td>
		  	</tr>";
		foreach ($arr as $key => $value) {
				if($value['insumo'] == 267)
					$insumo = 'Colageno';
				else
					$insumo = 'Tripa';
				echo "<tr>
				    	<td align='center' bgcolor='WHITE'>". $key ."</td>
					    <td align='center' bgcolor='WHITE'>". $value['producto'] ."</td> 
					    <td align='center' bgcolor='WHITE'>". $insumo ."</td> 
					    <td align='center' bgcolor='WHITE'>". $value['cantidad'] ."</td> 
					    <td align='center' bgcolor='WHITE'>". $value['porcion'] ."</td> 
					    <td align='center' bgcolor='WHITE'>". $value['estimado'] ."</td> 
					    <td align='center' bgcolor='WHITE'><a href='#' onclick='eliminarFormula(".$key.")'><img src='../images/borrar.png'></a></td>
				  	</tr>";
				
			
		}
		echo "</table>";
 	}

 	public function actionEliminarTablaInsumos()
	{
		$id  = $_POST['id'];
		$arr = Yii::app()->user->insumos;
		unset($arr[$id]);
		Yii::app()->user->setState('insumos',$arr);
		$this->dibujarTabla($arr);

	}

	/**
	* Deletes a particular model.
	* If deletion is successful, the browser will be redirected to the 'admin' page.
	* @param integer $id the ID of the model to be deleted
	*/
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	public function actionGetProducto()
	{
		$productos = Producto::model()->findAll("nombre like '%".$_POST['query']."%'");
		$prod = array();
		foreach ($productos as $key => $value) {
			$prod[$value->id]=$value->nombre;
		}
		echo json_encode($prod);

	}

	/**
	* Lists all models.
	*/
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('ProcesoEmbutido');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	* Manages all models.
	*/
	public function actionAdmin()
	{
		$model=new ProcesoEmbutido('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ProcesoEmbutido']))
			$model->attributes=$_GET['ProcesoEmbutido'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	* Returns the data model based on the primary key given in the GET variable.
	* If the data model is not found, an HTTP exception will be raised.
	* @param integer $id the ID of the model to be loaded
	* @return ProcesoEmbutido the loaded model
	* @throws CHttpException
	*/
	public function loadModel($id)
	{
		$model=ProcesoEmbutido::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	* Performs the AJAX validation.
	* @param ProcesoEmbutido $model the model to be validated
	*/
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='proceso-embutido-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}


	public function actionEliminarDetalle()
	{
		$id = $_POST['id'];
		$detalle = EmbutidoProductos::model()->findByPk($id);
		$id = $detalle->proceso_embutido_id;
		$detalle->delete();
        $embutidoProductos = EmbutidoProductos::model()->findAllByAttributes(array('proceso_embutido_id'=>$id));
		echo $this->renderPartial('tabla', array('embutidoProductos'=>$embutidoProductos));
	}
}