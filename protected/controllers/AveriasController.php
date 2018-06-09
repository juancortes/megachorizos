<?php

class AveriasController extends Controller
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
                'actions' => array('admin', 'create', 'index', 'view', 'delete', 'update'),
                'expression' => 'Yii::app()->user->checkAccess("Admin1")',
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
		$model=new Averias;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Averias']))
		{
			$model->attributes=$_POST['Averias'];
			if($model->save())
			{
				$detalles = $_POST['Averias']['detalle'];
				foreach ($detalles as $key => $value) {
					$det = new DetalleAverias;
					$det->fecha_reporte = $value['fecha_reporte'];
					$det->producto_id   = $value['producto'];
					$det->lote 			= $value['lote'];
					$det->cantidad 		= $value['cantidad'];
					$det->observaciones = $value['observaciones'];
					$det->averia_id 	= $model->id;

					$orden1 = explode('-', $value['lote']);
					$orden  = $orden1[0];
					$fecha  = $orden1[1]."-".$orden1[2]."-".$orden1[3];
					
					$producto = Producto::model()->findByPk($value['producto']);
					$producto->cantidad -= $value['cantidad'];					
					$producto->save();

					if(!$det->save())
					{
						echo "<pre>";
						print_r($det->getErrors());
						echo "</pre>";
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

		if(isset($_POST['Averias']))
		{
			$model->attributes=$_POST['Averias'];
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
		$dataProvider=new CActiveDataProvider('Averias');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	* Manages all models.
	*/
	public function actionAdmin()
	{
		$model=new Averias('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Averias']))
			$model->attributes=$_GET['Averias'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	* Returns the data model based on the primary key given in the GET variable.
	* If the data model is not found, an HTTP exception will be raised.
	* @param integer $id the ID of the model to be loaded
	* @return Averias the loaded model
	* @throws CHttpException
	*/
	public function loadModel($id)
	{
		$model=Averias::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	* Performs the AJAX validation.
	* @param Averias $model the model to be validated
	*/
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='averias-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}