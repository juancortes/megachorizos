<?php

class ReporteControlHorneadoController extends Controller
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
                'actions' => array('admin', 'create', 'index', 'view', 'delete', 'update','GetTanda'),
                'expression' => 'Yii::app()->user->checkAccess("Admin1") || Yii::app()->user->checkAccess("admin")',
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'create', 'index', 'view','GetTanda'),
                'expression' => 'Yii::app()->user->checkAccess("Horneador")',
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
		$model=new ReporteControlHorneado;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ReporteControlHorneado']))
		{
			$model->attributes=$_POST['ReporteControlHorneado'];
			
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

		if(isset($_POST['ReporteControlHorneado']))
		{
			$model->attributes=$_POST['ReporteControlHorneado'];
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
		$dataProvider=new CActiveDataProvider('ReporteControlHorneado');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	* Manages all models.
	*/
	public function actionAdmin()
	{
		$model=new ReporteControlHorneado('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ReporteControlHorneado']))
			$model->attributes=$_GET['ReporteControlHorneado'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	* Returns the data model based on the primary key given in the GET variable.
	* If the data model is not found, an HTTP exception will be raised.
	* @param integer $id the ID of the model to be loaded
	* @return ReporteControlHorneado the loaded model
	* @throws CHttpException
	*/
	public function loadModel($id)
	{
		$model=ReporteControlHorneado::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	* Performs the AJAX validation.
	* @param ReporteControlHorneado $model the model to be validated
	*/
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='reporte-control-horneado-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
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
				    FROM reporte_control_horneado 
				  ) 
				  AND cpt.fecha =:fecha 
				  AND p.nombre not like '%CRUDO%'
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
}