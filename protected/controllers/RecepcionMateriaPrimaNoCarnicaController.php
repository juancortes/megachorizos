<?php

class RecepcionMateriaPrimaNoCarnicaController extends Controller
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
                'actions' => array('getInsumo','admin', 'create', 'index', 'view', 'delete', 'update'),
                'expression' => 'Yii::app()->user->checkAccess("Admin1") || Yii::app()->user->checkAccess("admin")',
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('getInsumo','admin', 'create', 'index', 'view'),
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

	public function actionGetInsumo()
	{
		$model     = new RecepcionMateriaPrimaNoCarnica;
		$proveedor = $_POST['proveedor'];
		
		$proveedor = Proveedor::model()->findByPk($proveedor);
		if(isset($proveedor))
		{
			$this->renderPartial('_insumo', array('prov'=>$proveedor,'model'=>$model));
		}
		
	}

	/**
	* Creates a new model.
	* If creation is successful, the browser will be redirected to the 'view' page.
	*/
	public function actionCreate()
	{
		$model=new RecepcionMateriaPrimaNoCarnica;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['RecepcionMateriaPrimaNoCarnica']))
		{
			$model->attributes=$_POST['RecepcionMateriaPrimaNoCarnica'];
			if($model->unidad == 1)//escogio gr
				$model->peso_total = $model->peso_total/1000;
			if($model->save())
			{
				
				$provInsumo = ProveedorInsumo::model()->findByAttributes(array('proveedor_id'=>$model->proveedor_id,'insumo_id'=>$model->materia_prima_insumo));
				if(isset($provInsumo))
				{
					$provInsumo->cantidad += $model->peso_total;
					$provInsumo->save();
				}
				else
				{
					$provInsumo = new ProveedorInsumo;
					$provInsumo->proveedor_id = $model->proveedor_id;
					$provInsumo->insumo_id = $model->materia_prima_insumo;
					$provInsumo->cantidad = $model->peso_total;
					$provInsumo->save();
				}

				$provInsumo                = new ProveedorInsumoHistorico;
				$provInsumo->proveedor_id  = $model->proveedor;
				$provInsumo->insumo_id     = $model->materia_prima_insumo;
				$provInsumo->cantidad      = $model->peso_total;
				$provInsumo->fecha_ingreso = date('Y-m-d H:i:s');
				$provInsumo->accion        = 'I';
				$provInsumo->save();

				$insumo = Insumo::model()->findByPk($model->materia_prima_insumo);
				$insumo->cantidad += $model->peso_total;
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

			if(isset($_POST['RecepcionMateriaPrimaNoCarnica']))
			{
				$pesoAnterior = $model->peso_total;
				$insumoAnterior = $model->materia_prima_insumo;
				$proveedorAnterior = $model->proveedor;
				$model->attributes=$_POST['RecepcionMateriaPrimaNoCarnica'];
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


							//adicionar el nuevo insumo 
							$insumo = Insumo::model()->findByPk($model->materia_prima_insumo);
							$insumo->cantidad += $pesoAnterior;
							$insumo->save();

							$proveedorInsumo = ProveedorInsumo::model()->findByAttributes(array('proveedor_id'=>$model->proveedor,'insumo_id'=>$model->materia_prima_insumo));
							$proveedorInsumo->cantidad += $pesoAnterior;
							$proveedorInsumo->save();
						}
					}

					if($pesoAnterior != $model->peso_total)
					{
						$dif = $pesoAnterior - $model->peso_total;
						$insumo = Insumo::model()->findByPk($model->materia_prima_insumo);
						$insumo->cantidad += $dif;
						$insumo->save();
    				}
    				
    				$transaction->commit();
					$this->redirect(array('view','id'=>$model->id));
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
			$model = $this->loadModel($id);
			$this->loadModel($id)->delete();

			if($model->devolucion_si_no == 1)
			{
				$model->peso_total += $model->devolucion_peso_unidades;
			}
			
			$provInsumo = ProveedorInsumo::model()->findByAttributes(array('proveedor_id'=>$model->proveedor_id,'insumo_id'=>$model->materia_prima_insumo));
			if(isset($provInsumo))
			{
				$provInsumo->cantidad -= $model->peso_total;
				$provInsumo->save();
			}
			

			$insumo = Insumo::model()->findByPk($model->materia_prima_insumo);
			$insumo->cantidad -= $model->peso_total;
			if($insumo->save())
			{
				
			}
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
		$dataProvider=new CActiveDataProvider('RecepcionMateriaPrimaNoCarnica');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	* Manages all models.
	*/
	public function actionAdmin()
	{
		$model=new RecepcionMateriaPrimaNoCarnica('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['RecepcionMateriaPrimaNoCarnica']))
			$model->attributes=$_GET['RecepcionMateriaPrimaNoCarnica'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	* Returns the data model based on the primary key given in the GET variable.
	* If the data model is not found, an HTTP exception will be raised.
	* @param integer $id the ID of the model to be loaded
	* @return RecepcionMateriaPrimaNoCarnica the loaded model
	* @throws CHttpException
	*/
	public function loadModel($id)
	{
		$model=RecepcionMateriaPrimaNoCarnica::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	* Performs the AJAX validation.
	* @param RecepcionMateriaPrimaNoCarnica $model the model to be validated
	*/
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='recepcion-materia-prima-no-carnica-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}