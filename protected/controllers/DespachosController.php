<?php

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
                'actions' => array('admin', 'create', 'index', 'view', 'delete', 'update','getCliente','getDestino'),
                'expression' => 'Yii::app()->user->checkAccess("Admin1")',
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'create', 'index', 'view','getCliente','getDestino'),
                'expression' => 'Yii::app()->user->checkAccess("Despachos")',
            ),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionGetLote()
	{
		
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
					$det->cantidad 		= $value['cantidad'];
					$det->destino 		= $value['destino'];
					$det->observaciones = $value['observaciones'];
					$det->id_despacho 	= $model->id;
					$det->save();

					
					$producto = Producto::model()->findByPk($value['producto']);
					$producto->cantidad -= $value['cantidad'];					
					$producto->save();
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
}