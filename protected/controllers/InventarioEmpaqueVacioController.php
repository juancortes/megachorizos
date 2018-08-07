<?php

class InventarioEmpaqueVacioController extends Controller
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
                'actions' => array('validarCantidad','admin', 'create', 'index', 'view', 'delete', 'update','getProducto','getLote'),
                'expression' => 'Yii::app()->user->checkAccess("Admin1")',
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('validarCantidad','admin', 'create', 'index', 'view','getProducto','getLote'),
                'expression' => 'Yii::app()->user->checkAccess("lider_area")',
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
		$model=new InventarioEmpaqueVacio;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['InventarioEmpaqueVacio']))
		{
			$model->attributes=$_POST['InventarioEmpaqueVacio'];
			if($model->save())
			{
		
				$detalles = $_POST['InventarioEmpaqueVacio']['detalle'];
				foreach ($detalles as $key => $value) {
					$m            = new DetalleInventarioEmpaqueVacio;
					$m->producto  = $value['producto'];
					$m->cantidad  = $value['cantidad'];
					$m->unidad    = $value['unidad'];
					$m->lote      = $value['lote'];
					$m->reproceso = $value['reproceso'];
					$m->inventario_empaque_vacio_id = $model->id;
					$m->save();

					$orden1 = explode('-', $value['lote']);
					$orden  = $orden1[0];
					$fecha  = $orden1[1]."-".$orden1[2]."-".$orden1[3];
					
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

	public function actionValidarCantidad()
	{
		$cantidad = $_POST['cantidad'];
		$lote = Producto::model()->findAllBySql('SELECT cant_produccion AS cantidad FROM  ctrl_producciones_trazabilidad WHERE  producto LIKE :producto  ORDER BY producto ',array(':producto'=>'%'.$_POST['producto'].'%'));
		if($lote->cantidad >= $cantidad)
			echo 1;
		else
			echo 0;
	}

	public function actionGetProducto() 
	{
		$prov = Producto::model()->findAllBySql('SELECT id, nombre FROM  producto WHERE  nombre like :nombre  ORDER BY nombre ',array(':nombre'=>'%'.$_POST['q'].'%'));
		echo CJSON::encode(array(
			'deptos'=>$prov,
			)
		);
	}

	public function actionGetLote()
	{
		$lote = Producto::model()->findAllBySql('SELECT concat(c.id,"-",fecha) AS id, concat(c.id,"-",fecha) AS nombre, p.cantidad  FROM  ctrl_producciones_trazabilidad c inner join producto p on p.id = c.producto WHERE  producto LIKE :producto AND cant_produccion > 0  ORDER BY producto ',array(':producto'=>'%'.$_POST['producto'].'%'));
		echo CJSON::encode(array(
			'deptos'=>$lote,
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

		if(isset($_POST['InventarioEmpaqueVacio']))
		{
			$model->attributes=$_POST['InventarioEmpaqueVacio'];
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
		$dataProvider=new CActiveDataProvider('InventarioEmpaqueVacio');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	* Manages all models.
	*/
	public function actionAdmin()
	{
		$model=new InventarioEmpaqueVacio('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['InventarioEmpaqueVacio']))
			$model->attributes=$_GET['InventarioEmpaqueVacio'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	* Returns the data model based on the primary key given in the GET variable.
	* If the data model is not found, an HTTP exception will be raised.
	* @param integer $id the ID of the model to be loaded
	* @return InventarioEmpaqueVacio the loaded model
	* @throws CHttpException
	*/
	public function loadModel($id)
	{
		$model=InventarioEmpaqueVacio::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	* Performs the AJAX validation.
	* @param InventarioEmpaqueVacio $model the model to be validated
	*/
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='inventario-empaque-vacio-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}