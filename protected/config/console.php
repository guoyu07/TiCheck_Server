<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Console Application',

	// preloading 'log' component
	'preload'=>array('log'),

	// application components
	'components'=>array(
		/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		 */
		// uncomment the following to use a MySQL database
		'db'=>array(
			//'connectionString' => 'mysql:host=localhost;dbname=TiCheck',
			'class' => 'CDbConnection',
			'connectionString' => 'mysql:host=127.0.0.1;dbname=TiCheck',
			'emulatePrepare' => true,
			//'username' => 'tac',
			//'password' => 'tongjiappleclub',
			'username' => 'root',
			'password' => '199193',
			'charset' => 'utf8',
		),
		/*
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=TiCheck',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),
		 */
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
			),
		),
	),

	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.apiCtrip.*',
		'application.apiCtrip.Common.*',
		'application.controllers.*',
	),
);
