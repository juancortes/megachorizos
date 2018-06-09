<?php

class JauthModule extends CWebModule
{
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'jauth.models.*',
			'jauth.components.*',
			));
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
	public function registerScripts(){
		$urlScript = Yii::app()->assetManager->publish(Yii::getPathOfAlias('jauth').'/static/css/custom.css');
		Yii::app()->clientScript->registerScriptFile($urlScript, CClientScript::POS_HEAD);
	}
}
