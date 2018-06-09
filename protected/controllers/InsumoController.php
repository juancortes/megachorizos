<?php

class InsumoController extends Controller
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
                'actions' => array('generarExcel','admin', 'create', 'index', 'view', 'delete', 'update','reporteProduccion'),
                'expression' => 'Yii::app()->user->checkAccess("Admin1") || Yii::app()->user->checkAccess("admin")',
            ),
            array('allow',
            	  'actions' => array('vaciar'),
            	  'expression' => 'Yii::app()->user->checkAccess("Admin1") || Yii::app()->user->checkAccess("admin")',
            ),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionReporteProduccion()
	{
		$model=new CtrlProduccionesTrazabilidad;
		
		if(isset($_POST['CtrlProduccionesTrazabilidad']))
		{
			$model->attributes=$_POST['CtrlProduccionesTrazabilidad'];
			$model = CtrlProduccionesTrazabilidad::model()->findAll('fecha >= "'.$model->fecha.'"');
			
			if(isset($model))
			{
				$fecha = date('d-m-Y h:i:s'); 
				$filename = "REPORTE_PRODUCCION_".$fecha.".xls";
				Yii::app()->request->sendFile(
					$filename,
					$this->renderPartial(
						'reporteExcel',  
						array(
							'model'=>$model,
							), 
						true)
				);
			}
		}	

		$this->render('reporteProduccion',array(
			'model'=>$model,
		)); 
	}

	public function actionGenerarExcel()
	{
		$fecha = $_POST["fecha"];
		$model = CtrlProduccionesTrazabilidad::model()->findAllByAttributes(array('fecha'=>$fecha));
		if(isset($model))
		{
			$fecha = date('d-m-Y h:i:s');
			$filename = "REPORTE_PRODUCCION_".$fecha.".xls";
			Yii::app()->request->sendFile(
				$filename,
				$this->renderPartial(
					'reporteExcel',  
					array(
						'model'=>$model,
						), 
					true)
			);
		}
	}

	public function actionVaciar()
	{
		if(Yii::app()->request->isPostRequest)
		{
			$insumo = Insumo::model()->updateAll(array('cantidad'=>0));
			$proveedorInsumo =  ProveedorInsumo::model()->updateAll(array('cantidad'=>0));
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
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
		$model=new Insumo;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Insumo']))
		{
			$model->attributes=$_POST['Insumo'];
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

		if(isset($_POST['Insumo']))
		{
			$model->attributes=$_POST['Insumo'];
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
			try{
				$this->loadModel($id)->delete();
			}
			catch(CDbException $e){
			   /* if(!isset($_GET['ajax']))
			        Yii::app()->user->setFlash('error','Normal - error message');
			    else
			        echo "<div class='flash-error'>Ajax - error message <pre>".print_r($e)."</pre></div>"; *///for ajax
			    $error = $e->errorInfo['2'];
			    $resultado = strpos($error,"formulacion");
			    if($resultado !== FALSE)
			    {
			    	echo "<div class='flash-error' ><font size=3 color=red>Primero debe cambiar la formulación que no contenga este Insumo</div></div>"; //for ajax
			    }
			    else
			    {
			    	$resultado = strpos($error,"proveedor_insumo");
			    	echo "<div class='flash-error' ><font size=3 color=red>Primero debe borror la asignacipon de este insumo al  proveedor </div></div>"; //for ajax
			    }


			}

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
		$dataProvider=new CActiveDataProvider('Insumo');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	* Manages all models.
	*/
	public function actionAdmin()
	{
		$model=new Insumo('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Insumo']))
			$model->attributes=$_GET['Insumo'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	* Returns the data model based on the primary key given in the GET variable.
	* If the data model is not found, an HTTP exception will be raised.
	* @param integer $id the ID of the model to be loaded
	* @return Insumo the loaded model
	* @throws CHttpException
	*/
	public function loadModel($id)
	{
		$model=Insumo::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	* Performs the AJAX validation.
	* @param Insumo $model the model to be validated
	*/
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='insumo-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}