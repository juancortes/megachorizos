<?php
date_default_timezone_set('America/Bogota');

// change the following paths if necessary
$yii=dirname(__FILE__).'/../yii/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);
// do not run app before register YiiExcel autoload
// Yii::createWebApplication($config)->run();

$app = Yii::createWebApplication($config);


    // Optional:
    //  As we always try to run the autoloader before anything else, we can use it to do a few
    //      simple checks and initialisations

if (ini_get('mbstring.func_overload') & 2) {
	throw new Exception('Multibyte function overloading in PHP must be disabled for string functions (2).');
}

    //Now you can run application
$app->run();
