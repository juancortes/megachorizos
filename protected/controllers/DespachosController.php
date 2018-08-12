<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(-1);
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods:GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers:Content-type, X-Requested-With");
class DespachosController extends Controller
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

	/**
	* Specifies the access control rules.
	* This method is used by the 'accessControl' filter.
	* @return array access control rules
	*/
	public function accessRules()
	{
		return array(
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('getCantidad','admin', 'create', 'index', 'view', 'delete', 'update','getCliente','getDestino','getLote'),
                'expression' => 'Yii::app()->user->checkAccess("Admin1")',
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'create', 'index', 'view','getCliente','getDestino','getLote'),
                'expression' => 'Yii::app()->user->checkAccess("Despachos")',
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
		$model=new Despachos;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Despachos']))
		{
			$model->attributes=$_POST['Despachos'];

			if($model->save())
			{ 
				$detalles = $_POST['Despachos']['detalle'];
				foreach ($detalles as $key => $value) 
				{
					$det = new DetalleDespacho;
					$det->producto 		= $value['producto'];
					$det->lote 			= $value['lote'];
					$det->cliente_id    = $value['cliente'];
					$det->cantidad 		= $value['cantidad'];
					$det->observaciones = $value['observaciones'];
					$det->destino       = ' ';
					$det->id_despacho 	= $model->id;
					if($det->save())
					{
						$producto = Producto::model()->findByPk($value['producto']);
						$producto->cantidad -= $value['cantidad'];					
						if($producto->save())
						{
							$embutido = ProcesoEmbutido::model()->findByAttributes(array('tanda'=>$value['lote']));
							$detalle = EmbutidoProductos::model()->findByAttributes(array('proceso_embutido_id'=>$embutido->id,'producto_id'=>$value['producto']));
							
							if(isset($detalle))
							{
								$detalle->valor_real -= $value['cantidad'];
								if(!$detalle->save())
								{
									echo "<pre>22";
									print_r($detalle->getErrors());
									exit;
								}
							}
							else
							{
								exit("no encontre");
							}
						}
						else
						{
							echo "<pre>11";
							print_r($producto->getErrors());
							exit;
						}
					}
					else
					{
						echo "<pre>333";
						print_r($det->getErrors());
						exit;
					}
				}
				
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('create',array(
		'model'=>$model,
		));
	}

	public function actionGetCliente()
	{
		$cliente = Clientes::model()->findAllBySql('SELECT id, nombre FROM clientes WHERE  nombre like :nombre  ORDER BY nombre ',array(':nombre'=>'%'.$_POST['q'].'%'));
		echo CJSON::encode(array(
			'deptos'=>$cliente,
			)
		);
	}

	public function actiongetDestino()
	{
		$env = array(
			array(
				'id'=>'galan',
				'nombre'=>'galan'
			),
			array(
				'id'=>'paloquemao',
				'nombre'=>'paloquemao'
			),
			array(
				'id'=>'guadalupe',
				'nombre'=>'guadalupe'
			),
			array(
				'id'=>'suba',
				'nombre'=>'suba'
			),
			array(
				'id'=>'codabas',
				'nombre'=>'codabas'
			),
			array(
				'id'=>'pedidos',
				'nombre'=>'pedidos'
			),
			array(
				'id'=>'empaque',
				'nombre'=>'empaque'
			),
			array(
				'id'=>'planta1',
				'nombre'=>'planta 1'
			),
			array(
				'id'=>'planta2',
				'nombre'=>'planta 2'
			),
		);

		echo CJSON::encode(array(
			'deptos'=>$env,
			)
		);
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

		if(isset($_POST['Despachos']))
		{
			$model->attributes=$_POST['Despachos'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
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

	/**
	* Lists all models.
	*/
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Despachos');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	* Manages all models.
	*/
	public function actionAdmin()
	{
		$model=new Despachos('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Despachos']))
			$model->attributes=$_GET['Despachos'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	* Returns the data model based on the primary key given in the GET variable.
	* If the data model is not found, an HTTP exception will be raised.
	* @param integer $id the ID of the model to be loaded
	* @return Despachos the loaded model
	* @throws CHttpException
	*/
	public function loadModel($id)
	{
		$model=Despachos::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	* Performs the AJAX validation.
	* @param Despachos $model the model to be validated
	*/
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='despachos-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionGetCantidad()
	{
		$postdata        = file_get_contents("php://input");
		$request         = json_decode($postdata);
		$ordenProduccion = $request->orden;
		$producto_id     = $request->producto_id;
		$ordenProduccion = explode('-', $ordenProduccion);

		$sql = "SELECT ep.valor_real 
				FROM  proceso_embutido pe
				INNER JOIN embutido_productos ep ON ep.proceso_embutido_id = pe.id
				WHERE tanda = $ordenProduccion[0]
					AND  ep.producto_id = $producto_id";
		$results = Yii::app()->db->createCommand($sql)->queryRow();
		$envio = ['cantidad'=>$results['valor_real']];
		echo json_encode($envio);
		exit;
	}

	public function actionGetLote()
	{
		
		$producto = $_POST['producto'];
		$fecha    = $_POST['fecha'];
		$criteria = new CDbCriteria(array('order'=>'id ASC'));
		$sql   = "SELECT cpt.*, concat(cpt.id,'-',cpt.fecha) AS id1
				  FROM ctrl_producciones_trazabilidad cpt
				  INNER JOIN proceso_embutido pe ON pe.tanda = cpt.id				  
				  WHERE 
				   cpt.fecha =:fecha
				  AND cpt.producto =:producto 
				  ORDER BY cpt.id ASC";
		$datos = CtrlProduccionesTrazabilidad::model()->findAllBySql($sql,array(':producto'=>$producto,':fecha'=>$fecha));
		
		if(isset($datos))
		{
			$arreglo = [];
			foreach ($datos as $key => $value) {
				$n = $key +1;
				$arreglo[$key]['id']    = $value['id1'];
				$arreglo[$key]['nombre'] = $value['id1']." ".(int)$n." ".$value['producto0']->nombre;
			}
			// echo json_encode($arreglo);
			echo CJSON::encode(array(
				'deptos'=>$arreglo,
				)
			);
			// $model = new ProcesoEmbutido;
			// $this->renderPartial('_getTanda', array('ordenProduccion'=>$datos,'model'=>$model));
		}
	
	}
}