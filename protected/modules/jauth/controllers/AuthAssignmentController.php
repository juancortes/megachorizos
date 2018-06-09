<?php

class AuthAssignmentController extends Controller {

    public $layout = '//layouts/column2';

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete update', // we only allow deletion via POST request
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
                'actions' => array('admin', 'create', 'index', 'view', 'delete', 'update'),
                'expression' => 'Yii::app()->user->checkAccess("Admin1")',
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('AuthAssignment');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionCreate() {
        $model = new AuthAssignment;

        if (isset($_POST['AuthAssignment'])) {
            $model->attributes = $_POST['AuthAssignment'];
            if ($model->save())
                $this->redirect(array('admin'));
        }
//        var_dump($_POST);
//        exit(0);
        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function actionAdmin() {
        $model = new AuthAssignment('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['AuthAssignment']))
            $model->attributes = $_GET['AuthAssignment'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function actionView($itemname, $userid) {
        $model = AuthAssignment::model()->getElement($itemname, $userid);
        if (!empty($model)) {
            $this->render('view', array(
                'model' => $model,
            ));
        } else {
            throw new CHttpException('El elemento no existe.');
        }
    }

    public function actionDelete($itemname, $userid) {
        $this->loadModel2($itemname, $userid)->delete();
        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    public function loadModel2($itemname, $userid) {
        $model = AuthAssignment::model()->getElement($itemname, $userid);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function actionUpdate($itemname, $userid) {

        $model = $this->loadModel2($itemname, $userid);
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if (isset($_POST['AuthAssignment'])) {
            $model->attributes = $_POST['AuthAssignment'];
            if ($model->save()) {
                $itemname = $model->itemname;
                $userid = $model->userid;
                $this->redirect(array('view', 'itemname' => $itemname, 'userid' => $userid));
            }
        }
        $this->render('update', array(
            'model' => $model,
        ));
    }

}