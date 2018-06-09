<?php

class SeccionarOrderProdccionController extends Controller
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
                'actions' => array('getValores','getProductos','getPesoTanda','admin', 'create', 'index', 'view', 'delete', 'update'),
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

	public function actionGetPesoTanda()
	{
		$model = CtrlProduccionesTrazabilidad::model()->findByPk($_POST['tanda']);
		if(isset($model))
		{
			echo ($model->peso);
		}
		else
			echo (0);
	}

	public function actionGetProductos()
	{		
		$sql = 'SELECT distinct p.id,p.nombre FROM producto p 
				INNER JOIN formulacion f ON p.id = f.producto_id
				WHERE nombre LIKE :materia_prima AND cantidad > 0 order by nombre';
		$producto = Producto::model()->findAllBySql($sql,array(':materia_prima'=>'%'.$_POST['q'].'%')); 
		
		echo CJSON::encode(array(
			'deptos'=>$producto,
			)
		);
	}

	public function actionGetValores()
	{
		$postdata = file_get_contents("php://input");
		$request  = json_decode($postdata);
		$formula  = FormulaEstimado::model()->findByAttributes(array('producto_id'=>$request->producto,'insumo_id'=>$request->insumo));
		if(isset($formula))
			$valores = ['peso'=>$formula->peso,'longitud'=>round($formula->longitud,2)];
		else
			$valores = ['peso'=>0,'longitud'=>0];

		echo json_encode($valores);
	}

	/**
	* Creates a new model.
	* If creation is successful, the browser will be redirected to the 'view' page.
	*/
	public function actionCreate()
	{
        // $transaction = Yii::app()->db->beginTransaction();
        try
        {
			$model = new SeccionarOrderProdccion;

			// Uncomment the following line if AJAX validation is needed
			// $this->performAjaxValidation($model);

			if(isset($_POST['SeccionarOrderProdccion']))
			{
				$model->attributes    = $_POST['SeccionarOrderProdccion'];
				$model->fecha_sistema = date('Y-m-d H:i:s');
				if($model->save())
				{
					$ordenProduccion = CtrlProduccionesTrazabilidad::model()->findByPk($model->orden_produccion_id);
					$ordenProduccion->prioridad = $_POST['SeccionarOrderProdccion']['prioridad'];
					
					if($ordenProduccion->save())
					{
						$detalle = $_POST['SeccionarOrderProdccion']['detalle1'];
						
						foreach ($detalle as $key => $value) 
						{
							$modelDetalle                               = new SeccionarOrderProdccionDetalle;
							$modelDetalle->fecha_sistema                = date('Y-m-d H:i:s');
							$modelDetalle->seccionar_order_prodccion_id = $model->id;
							$modelDetalle->producto_id                  = $value['producto'];
							$modelDetalle->peso_total                   = $value['peso_total'];
							$modelDetalle->peso_unidad                  = $value['peso_unidad'];
							$modelDetalle->longitud                     = $value['longitud'];
							$modelDetalle->estado                       = 1;
							$modelDetalle->insumo_id                    = $value['insumo'];
							$modelDetalle->user_id                      = $model->user_id;

							if(!$modelDetalle->save())
							{
			            		//$transaction->rollback();
            					Yii::log("Error control de producciones trazabilidad :".print_r($modelDetalle->getErrors(),true), 'error', 'application.controllers.TercerosmetasController');
			            		exit();

							}
						}

            			//$transaction->commit();
						$this->redirect(array('view','id'=>$model->id));
					}
				/*	else
					{
						exit("??");
			            $transaction->rollback();
					}*/
				}
				//else
            		//$transaction->rollback();
			}

			$this->render('create',array(
				'model'=>$model,
			));
		}catch (Exception $exc) {
            // $transaction->rollback();
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

		if(isset($_POST['SeccionarOrderProdccion']))
		{
			$model->attributes=$_POST['SeccionarOrderProdccion'];
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
		$dataProvider=new CActiveDataProvider('SeccionarOrderProdccion');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	* Manages all models.
	*/
	public function actionAdmin()
	{
		$model=new SeccionarOrderProdccion('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['SeccionarOrderProdccion']))
			$model->attributes=$_GET['SeccionarOrderProdccion'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	* Returns the data model based on the primary key given in the GET variable.
	* If the data model is not found, an HTTP exception will be raised.
	* @param integer $id the ID of the model to be loaded
	* @return SeccionarOrderProdccion the loaded model
	* @throws CHttpException
	*/
	public function loadModel($id)
	{
		$model=SeccionarOrderProdccion::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	* Performs the AJAX validation.
	* @param SeccionarOrderProdccion $model the model to be validated
	*/
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='seccionar-order-prodccion-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}