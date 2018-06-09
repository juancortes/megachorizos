<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'		=> 'Megachorizos',
	'language'	=> 'es',
	'theme' 	=> 'bootstrap3',
	'aliases'=>array(
		'bootstrap'=>'ext.yiibootstrap3'
		),
	// preloading 'log' component
	'preload'=>array('log','kint'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		// 'application.modules.rights.*',
		// 'application.modules.rights.components.*',
		'application.vendors.phpexcel.PHPExcel',
		'application.modules.JCGridView',
		'application.modules.JCLinkPager',
		// 'bootstrap.*',
		'bootstrap.behaviors.*',
		'bootstrap.helpers.*',
		'bootstrap.widgets.*',
		),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'jauth',
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'123',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
			'generatorPaths' => array('bootstrap.jgii'),
			),

		// 'rights'=>array(
		// 	'install'=>false,
		// 	),

		),

	// application components
	'components'=>array(
		 /*'ePdf' => array(
	        'class'         => 'ext.yii-pdf.EYiiPdf',
	        'params'        => array(
	            'mpdf'     => array(
	                'librarySourcePath' => 'application.vendors.mpdf.*',
	                'constants'         => array(
	                    '_MPDF_TEMP_PATH' => Yii::getPathOfAlias('application.runtime'),
	                ),
	                'class'=>'mpdf', // the literal class filename to be loaded from the vendors folder
	                'defaultParams'     => array( // More info: http://mpdf1.com/manual/index.php?tid=184
	                    'mode'              => '', //  This parameter specifies the mode of the new document.
	                    'format'            => 'LETTER', // format A4, A5, ...
	                    'default_font_size' => 0, // Sets the default document font size in points (pt)
	                    'default_font'      => '', // Sets the default font-family for the new document.
	                    'mgl'               => 5, // margin_left. Sets the page margins for the new document.
	                    'mgr'               => 0, // margin_right
	                    'mgt'               => 10, // margin_top
	                    'mgb'               => 0, // margin_bottom
	                    'mgh'               => 0, // margin_header
	                    'mgf'               => 0, // margin_footer
	                    'orientation'       => 'P', // landscape or portrait orientation
	                )
	            ),
	            'HTML2PDF' => array(
	                'librarySourcePath' => 'application.vendors.html2pdf.*',
	                'classFile'         => 'html2pdf.class.php', // For adding to Yii::$classMap
	                /*'defaultParams'     => array( // More info: http://wiki.spipu.net/doku.php?id=html2pdf:en:v4:accueil
	                    'orientation' => 'P', // landscape or portrait orientation
	                    'format'      => 'A4', // format A4, A5, ...
	                    'language'    => 'en', // language: fr, en, it ...
	                    'unicode'     => true, // TRUE means clustering the input text IS unicode (default = true)
	                    'encoding'    => 'UTF-8', // charset encoding; Default is UTF-8
	                    'marges'      => array(5, 5, 5, 8), // margins by default, in order (left, top, right, bottom)
	                )*/
	           /* )
	        ),
    	),*/
		'bootstrap'=>array(
			'class'=>'bootstrap.components.BsApi',
			),
		'session' => array(
			'class'     => 'CDbHttpSession',
            'timeout'   => 60*60*24, // 24 horas de sesion activa
            ),

		'kint' => array(
			'class' => 'ext.Kint.Kint',
			),

		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
			// 'class'=>'RWebUser',
			),
		'authManager'=>array(
			'class'=>'CDbAuthManager',
			'connectionID' => 'db',
			// 'class'=>'RDbAuthManager',
			),
		// uncomment the following to enable URLs in path-format

		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName' => false,
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
				),
			),

		'db'=>array(
			'connectionString' => 'mysql:host=127.0.0.1;port=3306;dbname=megachorizos',
			'emulatePrepare' => true,			
			'username' => 'root',
			'password' => '123456',
			'charset' => 'utf8',
			),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
			),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
					),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
			),
		),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
'params'=>array(
	'subtitulo'     => 'Gestion de carnets.',
	'adminEmail'	=> 'juan.cortes.c@gmail.com',
	'login' 		=> array(
		'telefono' 	=> '339 4888',
		'ciudad' 	=> 'Bogotá',
		'ext' 	 	=> '2215',
		'intro' 	=> 'Lo invitamos a contestar esta encuesta, la cual es una manera de opinar de forma confidencial y así dar a conocer su percepción y punto de vista.'
		),
	//colageno
	'267' => array(
			'1' => array(
						'peso'     => '120',
						'longitud' => '15',
						'nombre'   => 'CHORIZO MIXTO DE TERNERA Y CERDO'
					),
			'2' => array(
						'peso'     => '120',
						'longitud' => '15',
						'nombre'   => 'CHORIZO DE POLLO'
					),
			'3' => array(
						'peso'     => '120',
						'longitud' => '15',
						'nombre'   => 'CHORIZO PICANTE'
					),
			'5' => array(
						'peso'     => '120',
						'longitud' => '15',
						'nombre'   => 'CHORIZO MIXTO CRIOLLO  DE RES Y CERDO'
					),
			'6' => array(
						'peso'     => '110',
						'longitud' => '15',
						'nombre'   => 'CHORIZO TRADICIONAL PRECOCIDO'
					),
			'7' => array(
						'peso'     => '110',
						'longitud' => '15',
						'nombre'   => 'CHORIZO MIXTO CLASICO PRECOCIDO'
					),
			'39' => array(
						'peso'     => '120',
						'longitud' => '15',
						'nombre'   => 'POLLO RELLENO'
					),
			'45' => array(
						'peso'     => '110',
						'longitud' => '15',
						'nombre'   => 'CHORIZO CLASICO PRECOCIDO'
					),
			'47' => array(
						'peso'     => '120',
						'longitud' => '15',
						'nombre'   => 'HAMBURGUESA DE POLLO'
					),
			'57' => array(
						'peso'     => '120',
						'longitud' => '15',
						'nombre'   => 'PASTA DE POLLO'
					),
			'62' => array(
						'peso'     => '120',
						'longitud' => '15',
						'nombre'   => 'CHORIZO MEGA CUNCIA'
					),
			'69' => array(
						'peso'     => '90',
						'longitud' => '12',
						'nombre'   => 'SANTA ROSANO X 5'
					),
			'62' => array(
						'peso'     => '90',
						'longitud' => '12',
						'nombre'   => 'SANTARROSANO '
					),
			'76' => array(
						'peso'     => '90',
						'longitud' => '12',
						'nombre'   => 'PARRILLERO'
					),
			'77' => array(
						'peso'     => '110',
						'longitud' => '15',
						'nombre'   => 'CERDO PRECOCIDO'
					),
		),
	//tripa
	'270' => array(
			'11' => array(
						'peso'     => '150',
						'longitud' => '24',
						'nombre'   => 'CHORIZO ESPECIAL AHUMADO'
					),
			'12' => array(
						'peso'     => '145',
						'longitud' => '23',
						'nombre'   => 'CHORIZO ESPECIAL CRUDO'
					),
			'13' => array(
						'peso'     => '120',
						'longitud' => '17',
						'nombre'   => 'CHORIZO CERDO CRUDO'
					),
			'15' => array(
						'peso'     => '120',
						'longitud' => '16',
						'nombre'   => 'LONGANIZA'
					),
			'41' => array(
						'peso'     => '120',
						'longitud' => '17',
						'nombre'   => 'CHORIZO MIXTO CLASICO CRUDO'
					),
			'43' => array(
						'peso'     => '120',
						'longitud' => '17',
						'nombre'   => 'CHORIZO CERDO AHUMADO'
					),
			'79' => array(
						'peso'     => '110',
						'longitud' => '15',
						'nombre'   => 'CHORIZO TRADICIONAL MIXTO RES Y CERDO AHUMADO'
					),
		),
	),
);