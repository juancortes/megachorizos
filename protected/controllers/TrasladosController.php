<?php

class TrasladosController extends Controller {
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout = '//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters() {
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
	public function accessRules() {
		return array(
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'    => array('anular','admin', 'create', 'index', 'view', 'delete', 'update', 'getInsumo','reporteTraslados'),
				'expression' => 'Yii::app()->user->checkAccess("Recepcion") || Yii::app()->user->checkAccess("Admin1") || Yii::app()->user->checkAccess("admin")',
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'    => array('admin', 'create', 'index', 'view', 'delete', 'update', 'getInsumo','reporteTraslados'),
				'expression' => 'Yii::app()->user->checkAccess("Traslados") || Yii::app()->user->checkAccess("Recepcion")',
			),
			array('deny', // deny all users
				'users' => array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id) {
		$this->render('view', array(
				'model' => $this->loadModel($id),
			));
	}

	

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate() {
		$model = new Traslados;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Traslados'])) {
			
			$model->attributes = $_POST['Traslados'];
			if ($model->save()) {
				$detalles = $_POST['Traslados']['detalle'];
				foreach ($detalles as $key => $value) {
					$det                = new DetalleTralados;
					$det->insumo_id     = $value['insumo'];
					$det->cantidad      = $value['cantidad'];
					$det->observaciones = $value['observaciones'];
					$det->cliente_id    = 88;
					$det->id_ctrl_producciones_trazabilidad    = $value['lote'];
					$det->traslado_id   = $model->id;
					if($det->save())
					{
						$insumo = Insumo::model()->findByPk($value['insumo']);
						$insumo->cantidad -= $value['cantidad'];
						if($insumo->save())
						{
							$materiaPrima = RecepcionMateriaPrimaCarnica::model()->findByPk($value['lote']);
							if(isset($materiaPrima))
								$materiaPrima->peso -= $value['cantidad'];
							if(!isset($materiaPrima))
							{
								$materiaPrima = RecepcionMateriaPrimaNoCarnica::model()->findByPk($value['lote']);
								if(isset($materiaPrima))
									$materiaPrima->peso_total -= $value['cantidad'];
							}
							if(!isset($materiaPrima))
							{
								$materiaPrima = RecepcionVegetales::model()->findByPk($value['lote']);
								$materiaPrima->peso_total -= $value['cantidad'];
							}

							if($materiaPrima->save())
							{
								$this->redirect(array('view', 'id' => $model->id));
							}
							else
							{
								echo "<pre> materiaPrima error";
								print_r($materiaPrima->getErrors());
								exit;
							}
						}
						else
						{
							echo "<pre> insumo error";
							print_r($insumo->getErrors());
							exit;
						}
					}
					else
					{
						echo "<pre> detalle traslados error";
						print_r($det->getErrors());
						exit;
					}
				}
			}
		}

		$this->render('create', array(
				'model' => $model,
			));
	}

	/**
	 * consigue insumos con cantidad mayor a cero
	 * @return [json]
	 */
	public function actionGetInsumo() {
		$insumos = Insumo::model()->findAllBySql('SELECT id, materia_prima, cantidad  FROM insumo WHERE  materia_prima like :nombre AND cantidad > 0 ORDER BY materia_prima ', array(':nombre' => '%'.$_POST['q'].'%'));
		echo CJSON::encode(array(
				'deptos' => $insumos,
			)
		);
	}

	/**
	 * consigue insumos con cantidad mayor a cero
	 * @return [json]
	 */
	public function actionAnular() {
		$transaction = Yii::app()->db->beginTransaction();
		try
		{
			$id               = $_POST['traslado'];
			$traslados        = Traslados::model()->findByPk($id);
			$traslados->estado = 0;

			if($traslados->save())
			{
				$detalle = DetalleTralados::model()->findAllByAttributes(array('traslado_id'=>$id));
				if(isset($detalle))
				{
					foreach ($detalle as $key => $value) {
						$insumo = Insumo::model()->findByPk($value->insumo_id);
						$insumo->cantidad += $value->cantidad;
						if($insumo->save())
						{

							$materiaPrima = RecepcionMateriaPrimaCarnica::model()->findByPk($value->id_ctrl_producciones_trazabilidad);
							if(isset($materiaPrima))
								$materiaPrima->peso -= $value->cantidad;

							if(!isset($materiaPrima))
							{
								$materiaPrima = RecepcionMateriaPrimaNoCarnica::model()->findByPk($value->id_ctrl_producciones_trazabilidad);
								if(isset($materiaPrima))
									$materiaPrima->peso_total -= $value->cantidad;								
							}
							if(!isset($materiaPrima))
							{
								$materiaPrima = RecepcionVegetales::model()->findByPk($value->id_ctrl_producciones_trazabilidad);
								$materiaPrima->peso_total -= $value->cantidad;
							}


							if($materiaPrima->save())
							{
								$transaction->commit();

								
							}
							else
							{
								echo "<pre> materiaPrima error";
								print_r($materiaPrima->getErrors());
								exit;
							}
						}
					}
				}
			}
		}
		catch (Exception $exc) {
			$transaction->rollback();
			Yii::log("Error traslados anular : $exc", 'error', 'application.controllers.TercerosmetasController');
			return $exc;
		}		
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id) {
		$model = $this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Traslados'])) {
			
			$model->attributes = $_POST['Traslados'];
			if ($model->save()) {
				$detalles = $_POST['Traslados']['detalle'];
				foreach ($detalles as $key => $value) {
					$det                = new DetalleTralados;
					$det->insumos_id    = $value['insumo'];
					$det->cantidad      = $value['cantidad'];
					$det->observaciones = $value['observaciones'];
					$det->traslado_id   = $model->id;
					$det->save();

					$insumo = Insumo::model()->findByPk($value['insumo']);
					$insumo->cantidad -= $value['cantidad'];
					$insumo->save();
				}
				$this->redirect(array('view', 'id' => $model->id));
			}
		}

		$this->render('update', array(
				'model' => $model,
			));
	}

	public function actionReporteTraslados() {
		$model = new Traslados();

		if(isset($_POST['Traslados']))
		{
			$model = Traslados::model()->findAll('fecha >= "'.$_POST["Traslados"]["fecha"].'"');			
			if(isset($model))
			{
				$fecha = date('d-m-Y h:i:s');
				$filename = "REPORTE_TRASLADO_".$fecha.".xls";
				Yii::app()->request->sendFile(
					$filename,
					$this->renderPartial(
						'reporteExcel',  
						array(
							'model'=>$model
							), 
						true)
				);
			}
		}

		$this->render('reporteTraslados',array(
			'model'=>$model,
		)); 
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id) {
		if (Yii::app()->request->isPostRequest) {
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if (!isset($_GET['ajax'])) {
				$this->redirect(isset($_POST['returnUrl'])?$_POST['returnUrl']:array('admin'));
			}
		} else {

			throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
		}
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('Traslados');
		$this->render('index', array(
				'dataProvider' => $dataProvider,
			));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin() {
		$model = new Traslados('search');
		$model->unsetAttributes();// clear any default values
		if (isset($_GET['Traslados'])) {
			$model->attributes = $_GET['Traslados'];
		}

		$this->render('admin', array(
				'model' => $model,
			));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Traslados the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id) {
		$model = Traslados::model()->findByPk($id);
		if ($model === null) {
			throw new CHttpException(404, 'The requested page does not exist.');
		}

		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Traslados $model the model to be validated
	 */
	protected function performAjaxValidation($model) {
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'traslados-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}