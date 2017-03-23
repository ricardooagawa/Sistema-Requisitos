<?php

Yii::setPathOfAlias('booster', dirname(__FILE__).'/../extensions/booster');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Sistema de Gerenciamento de Projetos',
	'language'=>'pt_br',
	'charset'=>'ISO-8859-1',
	//'charset'=>'utf-8',
	
	// preloading 'log' component
	'preload'=>array(
		'log', 
		'booster'
	),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		
		//'bootstrap.helpers.TbHtml',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('192.168.0.*','::1'),
			
			//'generatorPaths' => array('bootstrap.gii'),
		),
		
		'generatorPaths'=>array(
			'booster.gii', // boostrap generator
		),
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format
				
		'booster' => array(
			'class' => 'booster.components.Booster',
			'responsiveCss' => true,
		),
		
		'swiftMailer' => array(
			'class' => 'ext.swiftMailer.SwiftMailer',
		),
		
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		
				
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=db_dsv_requisitos',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'latin1',
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
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);
