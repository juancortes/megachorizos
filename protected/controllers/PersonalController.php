<?php

class PersonalController extends Controller
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
		$model=new Personal;

		// Uncomment the following line if AJAX validation is needed
		 $this->performAjaxValidation($model);

		if(isset($_POST['Personal']))
		{

			$model->attributes=$_POST['Personal'];
			$model->user_id = 1;
			if($model->validate())
			{
				$user           = new User;
				$user->nombres  = $model->nombres;
				$user->username = $model->cedula;
				$user->email    = $model->correo;
				$user->password = md5($model->clave);
				if($user->save())
				{
					//$this->crearBitacora($user->tableName(),'1',$model->username);

					$itemName = $model->rol;
						
					$userId  = $user->username;

					//exit('item='.$itemName.' us='.$userId);
					$data = 'N;';
					$bizRule = null;
					Yii::app()->db->createCommand()
						->insert('AuthAssignment', array(
								'itemname'=>$itemName,
								'userid'=>$userId,
								'bizrule'=>$bizRule,
								'data'=>serialize($data)
						));
					$model->username = "44";
					$model->user_id = $userId;
					if($model->save())
					{
						//$this->crearBitacora($model->tableName(),'1',$model->cedula	);
						$this->redirect(array('view','id'=>$model->id));
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
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Personal']))
		{
			$model->attributes=$_POST['Personal'];
			if($model->save())
			{
				if($model->rol != '')
				{
					$itemName = $model->rol;
					$data     = 'N;';
					$bizRule  = null;
					Yii::app()->db->createCommand()
						->update('AuthAssignment', array(
								'itemname' => $itemName,
								'bizrule'  => $bizRule,
								'data'     => serialize($data)
						),'userid =:id',array(':id'=>$model->cedula));

					


				}
				if($model->clave != "")
				{
					$user = User::model()->findByAttributes(array('username'=>$model->cedula));
					$user->password = md5($model->clave);
					$user->save();
				}
				$this->redirect(array('view','id'=>$model->id));
			}
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
		$dataProvider=new CActiveDataProvider('Personal');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	* Manages all models.
	*/
	public function actionAdmin()
	{
		$model=new Personal('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Personal']))
			$model->attributes=$_GET['Personal'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	* Returns the data model based on the primary key given in the GET variable.
	* If the data model is not found, an HTTP exception will be raised.
	* @param integer $id the ID of the model to be loaded
	* @return Personal the loaded model
	* @throws CHttpException
	*/
	public function loadModel($id)
	{
		$model=Personal::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	* Performs the AJAX validation.
	* @param Personal $model the model to be validated
	*/
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='personal-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}