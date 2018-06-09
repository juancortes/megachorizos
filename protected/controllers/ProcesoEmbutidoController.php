<?php

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
				'actions'=>array('index','view','admin','create','update','delete','GetProducto','generarTablaInsumos','eliminarTablaInsumos'),
                'expression' => 'Yii::app()->user->checkAccess("Admin1") || Yii::app()->user->checkAccess("admin")',
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
							$modelEmbutidoProductos->cantidad            = $value['cantidad'];
							$modelEmbutidoProductos->producto_id         = $value['producto'];
							$modelEmbutidoProductos->estimado            = $value['estimado'];
							$modelEmbutidoProductos->unidades_salientes  = $value['unidades_salientes'];
							if(!$modelEmbutidoProductos->save())
							{
								$transaction->rollback();
            					Yii::log("Error control de producciones trazabilidad : ".print_f($modelEmbutidoProductos->getErrors(),true), 'error', 'application.controllers.TercerosmetasController');
							}
						}
					}
					$detalle = Yii::app()->user->insumos;		
					foreach ($detalle as $key => $value) {
						$modelEmbutidoInusmos                      = new EmbutidoInsumos;
						$modelEmbutidoInusmos->fecha               = date('Y-m-d H:i:s');
						$modelEmbutidoInusmos->proceso_embutido_id = $model->id;
						$modelEmbutidoInusmos->cantidad            = $value['cantidad'];
						$modelEmbutidoInusmos->porcion             = $value['porcion'];
						$modelEmbutidoInusmos->insumo_id           = $value['insumo'];
						$modelEmbutidoInusmos->estimado            = $value['estimado'];

						$prod = Producto::model()->findByAttributes(array('nombre'=>$value['producto']));
						if(isset($prod))
						{
							$modelEmbutidoInusmos->producto_id = $prod->id;
							if(!$modelEmbutidoInusmos->save())
							{
								$transaction->rollback();
            					Yii::log("Error control de producciones trazabilidad : ".print_f($modelEmbutidoProductos->getErrors(),true), 'error', 'application.controllers.TercerosmetasController');
							}

						}
						else
						{
							$transaction->rollback();
        					Yii::log("no existe produto ", 'error', 'application.controllers.TercerosmetasController');

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
			$model->attributes=$_POST['ProcesoEmbutido'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
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
}