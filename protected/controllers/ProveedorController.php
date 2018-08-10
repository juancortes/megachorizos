<?php

class ProveedorController extends Controller
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
                'actions' => array('admin', 'create', 'index', 'view', 'delete', 'update','reporteProveedor','reporteProveedorCargado'),
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
		$model=new Proveedor;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Proveedor']))
		{
			$model->attributes=$_POST['Proveedor'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
		'model'=>$model,
		));
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

		if(isset($_POST['Proveedor']))
		{
			$model->attributes=$_POST['Proveedor'];
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
		$dataProvider=new CActiveDataProvider('Proveedor');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	* Manages all models.
	*/
	public function actionAdmin()
	{
		$model=new Proveedor('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Proveedor']))
			$model->attributes=$_GET['Proveedor'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	* Returns the data model based on the primary key given in the GET variable.
	* If the data model is not found, an HTTP exception will be raised.
	* @param integer $id the ID of the model to be loaded
	* @return Proveedor the loaded model
	* @throws CHttpException
	*/
	public function loadModel($id)
	{
		$model=Proveedor::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	* Performs the AJAX validation.
	* @param Proveedor $model the model to be validated
	*/
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='proveedor-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionReporteProveedor()
	{
		$model = new Proveedor;
		if(isset($_POST['Proveedor']))
		{
			$sql = "SELECT * FROM proveedor_insumo WHERE date(fecha_ingreso) BETWEEN  :fecha_inicio AND :fecha_fin AND proveedor_id =:proveedor";
			$model1 = ProveedorInsumo::model()->findAllBySql($sql,array(':fecha_inicio'=>$_POST['Proveedor']['fecha_inicial'],':fecha_fin'=>$_POST['Proveedor']['fecha_final'],':proveedor'=>$_POST['Proveedor']['nom_proveedor']));
			$this->render('reporteProveedor',array(
				'model'=>$model,
				'model1'=>$model1,
				'inicio'=>1
			)); 
			exit;
		}

		$this->render('reporteProveedor',array(
			'model'=>$model,
			'inicio'=>0
		)); 
	}

	public function actionReporteProveedorCargado()
	{
		$model = new Proveedor;
		if(isset($_POST['Proveedor'])  )
		{
			if($_POST['Proveedor']['nom_proveedor'] != "")
			{
				$sql = "SELECT * FROM proveedor_insumo_historico WHERE date(fecha_ingreso) BETWEEN  :fecha_inicio AND :fecha_fin AND proveedor_id =:proveedor";
				$model1 = ProveedorInsumoHistorico::model()->findAllBySql($sql,array(':fecha_inicio'=>$_POST['Proveedor']['fecha_inicial'],':fecha_fin'=>$_POST['Proveedor']['fecha_final'],':proveedor'=>$_POST['Proveedor']['nom_proveedor']));
				$this->render('reporteProveedorCargado',array(
					'model'=>$model,
					'model1'=>$model1,
					'inicio'=>1
				)); 
			}
			else if($_POST['Proveedor']['insumo'] != "")
			{
				$sql = "SELECT * 
						FROM proveedor_insumo_historico 
						WHERE date(fecha_ingreso) BETWEEN  :fecha_inicio AND :fecha_fin 
							AND insumo_id =:insumo";
				$model1 = ProveedorInsumoHistorico::model()->findAllBySql($sql,array(':fecha_inicio'=>$_POST['Proveedor']['fecha_inicial'],':fecha_fin'=>$_POST['Proveedor']['fecha_final'],':insumo'=>$_POST['Proveedor']['insumo']));
				$this->render('reporteProveedorCargado',array(
					'model'=>$model,
					'model1'=>$model1,
					'inicio'=>1
				)); 
			}
			else
			{
				$sql = "SELECT * 
						FROM proveedor_insumo_historico 
						WHERE date(fecha_ingreso) BETWEEN  :fecha_inicio AND :fecha_fin 
							";
				$model1 = ProveedorInsumoHistorico::model()->findAllBySql($sql,array(':fecha_inicio'=>$_POST['Proveedor']['fecha_inicial'],':fecha_fin'=>$_POST['Proveedor']['fecha_final']));
				$this->render('reporteProveedorCargado',array(
					'model'=>$model,
					'model1'=>$model1,
					'inicio'=>1
				)); 
			}
			exit;
		}

		$this->render('reporteProveedorCargado',array(
			'model'=>$model,
			'inicio'=>0
		)); 
	}
}