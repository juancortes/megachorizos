<?php

class RecepcionMateriaPrimaCarnicaController extends Controller
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
                'actions' => array('cargarConsecutivo','getProvInsumo','admin', 'create', 'index', 'view', 'delete', 'update'),
                'expression' => 'Yii::app()->user->checkAccess("Admin1") || Yii::app()->user->checkAccess("admin")',
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('cargarConsecutivo','getProvInsumo','admin', 'create', 'index', 'view'),
                'expression' => 'Yii::app()->user->checkAccess("Recepcion")',
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'index', 'view'),
                'expression' => 'Yii::app()->user->checkAccess("Mezclador")',
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

	public function actionCargarConsecutivo()
	{
		$lote = $_POST['lote_interno'];

		$model = RecepcionMateriaPrimaCarnica::model()->findBySql("SELECT max(CONVERT(SUBSTRING(lote_interno,3),UNSIGNED INTEGER)) + 1 AS lote_interno FROM recepcion_materia_prima_carnica");
		if(isset($model))
		{
			if($model['lote_interno'] == 1 || $model['lote_interno'] == '')
				$linterno = "1";
			else
				$linterno = $model['lote_interno'];

			$cod  = str_split($lote, 2);
			$lote = $cod[0].$linterno;
		}
		else
		{
			$cod  = str_split($lote, 2);
			$lote = $cod[0]."1";
		}
		echo $lote;
	}

	public function actionGetProvInsumo()
	{
		$model = new RecepcionMateriaPrimaCarnica;
		$lote  = strtoupper($_POST['lote_interno']);
		if(strlen($lote) > 1)
		{
			if(strlen($lote) != 2)
			{
				
				$cod = str_split($lote, 2);
				$cod = $cod[0];
				
			}
			else
				$cod = $lote;
			
			$proveedor = Proveedor::model()->findByAttributes(array('codigo_base'=>$cod));
			if(isset($proveedor))
			{
				$this->renderPartial('_provInsumo', array('prov'=>$proveedor,'model'=>$model));
			}
		}
	}

	/**
	* Creates a new model.
	* If creation is successful, the browser will be redirected to the 'view' page.
	*/
	public function actionCreate()
	{
		$model=new RecepcionMateriaPrimaCarnica;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['RecepcionMateriaPrimaCarnica']))
		{
			$model->attributes                     =$_POST['RecepcionMateriaPrimaCarnica'];
			$model->carct_orgleptica_color         = 1;
			$model->carct_orgleptica_olor          = 1;
			$model->carct_orgleptica_c_temperatura = 1;
			if($model->unidad == 1)//escogio gr
				$model->peso = $model->peso/1000;
			
			if($model->save())
			{
				

				$provInsumo = ProveedorInsumo::model()->findByAttributes(array('proveedor_id'=>$model->proveedor,'insumo_id'=>$model->materia_prima_insumo));
				if(isset($provInsumo))
				{
					$provInsumo->cantidad += $model->peso;
					$provInsumo->save();
				}
				else
				{
					$provInsumo = new ProveedorInsumo;
					$provInsumo->proveedor_id = $model->proveedor;
					$provInsumo->insumo_id = $model->materia_prima_insumo;
					$provInsumo->cantidad = $model->peso;
					$provInsumo->save();
				}

				$provInsumo                = new ProveedorInsumoHistorico;
				$provInsumo->proveedor_id  = $model->proveedor;
				$provInsumo->insumo_id     = $model->materia_prima_insumo;
				$provInsumo->cantidad      = $model->peso;
				$provInsumo->fecha_ingreso = date('Y-m-d H:i:s');
				$provInsumo->accion        = 'I';
				if(!$provInsumo->save())
				{
					echo "<pre>";
					print_r($provInsumo->getErrors());
					exit;
				}

				$insumo = Insumo::model()->findByPk($model->materia_prima_insumo);
				$insumo->cantidad += $model->peso;
				if($insumo->save())
					$this->redirect(array('view','id'=>$model->id));
				else
				{
					foreach ($insumo->errors as $key => $value) 
					{
						foreach ($value as $k => $val) 
						{
							echo "error=".$val;
						}
					}
				}
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
        $transaction = Yii::app()->db->beginTransaction();
		try
		{
			$model=$this->loadModel($id);

			// Uncomment the following line if AJAX validation is needed
			// $this->performAjaxValidation($model);

			if(isset($_POST['RecepcionMateriaPrimaCarnica']))
			{
				$pesoAnterior = $model->peso;
				$insumoAnterior = $model->materia_prima_insumo;
				$proveedorAnterior = $model->proveedor;
				$model->attributes=$_POST['RecepcionMateriaPrimaCarnica'];
				if($model->save())
				{
					if($insumoAnterior != $model->materia_prima_insumo)
					{
						$insumo = Insumo::model()->findByPk($insumoAnterior);
						$insumo->cantidad -= $pesoAnterior;
						if($insumo->cantidad < 0)
						{
							$transaction->rollback();
							throw new Exception("insumo negativo", 1);
						}
						else
						{
							$insumo->save();

							$proveedorInsumo = ProveedorInsumo::model()->findByAttributes(array('proveedor_id'=>$proveedorAnterior,'insumo_id'=>$insumoAnterior));
							$proveedorInsumo->cantidad -= $pesoAnterior;
							$proveedorInsumo->save(); 

							$provInsumo                = new ProveedorInsumoHistorico;
							$provInsumo->proveedor_id  = $model->proveedor;
							$provInsumo->insumo_id     = $model->materia_prima_insumo;
							$provInsumo->cantidad      = -$model->peso;
							$provInsumo->fecha_ingreso = date('Y-m-d H:i:s');
							$provInsumo->accion        = 'U';
							if(!$provInsumo->save())
							{
								echo "<pre>";
								print_r($provInsumo->getErrors());
								exit;
							}

							//adicionar el nuevo insumo 
							$insumo = Insumo::model()->findByPk($model->materia_prima_insumo);
							$insumo->cantidad += $pesoAnterior;
							$insumo->save();

							$proveedorInsumo = ProveedorInsumo::model()->findByAttributes(array('proveedor_id'=>$model->proveedor,'insumo_id'=>$model->materia_prima_insumo));
							$proveedorInsumo->cantidad += $pesoAnterior;
							$proveedorInsumo->save();

							$provInsumo                = new ProveedorInsumoHistorico;
							$provInsumo->proveedor_id  = $model->proveedor;
							$provInsumo->insumo_id     = $model->materia_prima_insumo;
							$provInsumo->cantidad      = $model->peso;
							$provInsumo->fecha_ingreso = date('Y-m-d H:i:s');
							$provInsumo->accion        = 'I';
							if(!$provInsumo->save())
							{
								echo "<pre>";
								print_r($provInsumo->getErrors());
								exit;
							}


						}
					}

					if($pesoAnterior != $model->peso)
					{
						$dif = $pesoAnterior - $model->peso;
						$insumo = Insumo::model()->findByPk($model->materia_prima_insumo);
						$insumo->cantidad += $dif;
						$insumo->save();

						$proveedorInsumo = ProveedorInsumo::model()->findByAttributes(array('proveedor_id'=>$model->proveedor,'insumo_id'=>$model->materia_prima_insumo));
						$proveedorInsumo->cantidad += $dif;
						$proveedorInsumo->save();

						$provInsumo                = new ProveedorInsumoHistorico;
						$provInsumo->proveedor_id  = $model->proveedor;
						$provInsumo->insumo_id     = $model->materia_prima_insumo;
						$provInsumo->cantidad      = $model->peso;
						$provInsumo->fecha_ingreso = date('Y-m-d H:i:s');
						$provInsumo->accion        = 'U';
						if(!$provInsumo->save())
						{
							echo "<pre>";
							print_r($provInsumo->getErrors());
							exit;
						}

					}
					
        			$transaction->commit();
					$this->redirect(array('view','id'=>$model->id));
					
				}
				else
				{
					$transaction->rollback();
					throw new Exception("error modelo ".print_r($model->getErrors(),true), 1);
				}
			}

			$this->render('update',array(
				'model'=>$model,
			));
		}
		catch (Exception $e) {
			echo "<pre>";
			print_r($e);
			echo  json_encode(array('error'=>'true','mensaje'=>'no puede cambiar el valor y/o insumo primero anule la orde de producción'));
		}
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
		$dataProvider=new CActiveDataProvider('RecepcionMateriaPrimaCarnica');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	* Manages all models.
	*/
	public function actionAdmin()
	{
		$model=new RecepcionMateriaPrimaCarnica('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['RecepcionMateriaPrimaCarnica']))
			$model->attributes=$_GET['RecepcionMateriaPrimaCarnica'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	

	/**
	* Returns the data model based on the primary key given in the GET variable.
	* If the data model is not found, an HTTP exception will be raised.
	* @param integer $id the ID of the model to be loaded
	* @return RecepcionMateriaPrimaCarnica the loaded model
	* @throws CHttpException
	*/
	public function loadModel($id)
	{
		$model=RecepcionMateriaPrimaCarnica::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	* Performs the AJAX validation.
	* @param RecepcionMateriaPrimaCarnica $model the model to be validated
	*/
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='recepcion-materia-prima-carnica-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}