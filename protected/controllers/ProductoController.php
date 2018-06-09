<?php

class ProductoController extends Controller
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
                'actions' => array('upload','subirArchivo','prueba','admin', 'create', 'index', 'view', 'delete', 'update','reporteProducto'),
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

	public function actionReporteProducto() 
	{
		$model1 = new RecepcionMateriaPrimaCarnica;
		$model2 = new RecepcionMateriaPrimaNoCarnica;
		if(isset($_POST['RecepcionMateriaPrimaCarnica']))
		{
			if($_POST['RecepcionMateriaPrimaCarnica']['tipo'] == '0') //carnico
			{
				$model = RecepcionMateriaPrimaCarnica::model()->findAll('fec_ingreso >= "'.$_POST["RecepcionMateriaPrimaCarnica"]["fec_ingreso"].'"');			

			}
			else if($_POST['RecepcionMateriaPrimaCarnica']['tipo'] == '1')
				$model = RecepcionMateriaPrimaNoCarnica::model()->findAll('fec_ingreso >= "'.$_POST["RecepcionMateriaPrimaCarnica"]["fec_ingreso"].'"');			
			else	
				$model = RecepcionVegetales::model()->findAll('fec_ingreso >= "'.$_POST["RecepcionMateriaPrimaCarnica"]["fec_ingreso"].'"');			

			if(isset($model))
			{
				$fecha = date('d-m-Y h:i:s');
				$filename = "REPORTE_PRODUCTO_".$fecha.".xls";
				Yii::app()->request->sendFile(
					$filename,
					$this->renderPartial(
						'reporteExcel',  
						array(
							'model'=>$model,
							'tipo' => $_POST['RecepcionMateriaPrimaCarnica']['tipo']
							), 
						true)
				);
			}
		}

		$this->render('reporteProducto',array(
			'model1'=>$model1,
			'model2'=>$model2,
		)); 
		
	}

	/**
	* Creates a new model.
	* If creation is successful, the browser will be redirected to the 'view' page.
	*/
	public function actionCreate()
	{
		$model=new Producto;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Producto']))
		{
			$model->attributes=$_POST['Producto'];
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

		if(isset($_POST['Producto']))
		{
			$model->attributes=$_POST['Producto'];
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
		$dataProvider=new CActiveDataProvider('Producto');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	* Manages all models.
	*/
	public function actionAdmin()
	{
		$model=new Producto('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Producto']))
			$model->attributes=$_GET['Producto'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	* Returns the data model based on the primary key given in the GET variable.
	* If the data model is not found, an HTTP exception will be raised.
	* @param integer $id the ID of the model to be loaded
	* @return Producto the loaded model
	* @throws CHttpException
	*/
	public function loadModel($id)
	{
		$model=Producto::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	* Performs the AJAX validation.
	* @param Producto $model the model to be validated
	*/
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='producto-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionPrueba()
	{
		$model = new Producto;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Txtatencioncreadas']))
		{
			
		}

		$this->render('prueba',array(
		'model'=>$model,
		));
	}

	public function actionUpload()
	{
	        Yii::import("ext.EAjaxUpload.qqFileUploader");
	 
	        $folder='archivos/';// folder for uploaded files
	        $allowedExtensions = array("txt");//array("jpg","jpeg","gif","exe","mov" and etc...
	        $sizeLimit = 10 * 1024 * 1024;// maximum file size in bytes
	        $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
	        $result = $uploader->handleUpload($folder);
	        $return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);
	 
	        $fileSize=filesize($folder.$result['filename']);//GETTING FILE SIZE
	        $fileName=$result['filename'];//GETTING FILE NAME
	 
	        echo $return;// it's array
	}

	public function actionSubirArchivo()
	{
		$archivo = 'archivos/'.$_POST['nombre'];
		$datos = $this->leerCsv($archivo);
		//print_r($datos);
		echo "si";
	}

	function leerCsv($archivo)
    {
        $registros = array();
        if (($fichero = fopen($archivo, "r")) !== FALSE) 
        {
            // Lee los nombres de los campos
            $nombres_campos = fgetcsv($fichero, 0, "\t", "\"", "\"");
            $num_campos = count($nombres_campos);
            // Lee los registros
            while (($datos = fgetcsv($fichero, 0, "\t", "\"", "\"")) !== FALSE) {
                // Crea un array asociativo con los nombres y valores de los campos      
                      
                for ($icampo = 0; $icampo < $num_campos-1; $icampo++) {

                	
                    	$registro[$nombres_campos[$icampo]] = $datos[$icampo];
                	
                }
                // Añade el registro leido al array de registros
                $registros[] = $registro;
            }
            fclose($fichero);
         
            echo "Leidos " . count($registros) . " registros\n";
            print_r($registros);
         
            /*for ($i = 0; $i < count($registros); $i++) {
                echo "Nombre: " . $registros[$i]["nombre"] . "\n";
            }*/
            return $registros;
        }
    }
}