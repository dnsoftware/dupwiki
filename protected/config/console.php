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
        'db'=>array(
            'connectionString' => 'mysql:host=localhost;dbname=moda',
            'emulatePrepare' => true,
            'username' => 'moda',
            'password' => 'moda',
            'charset' => 'utf8',
            'tablePrefix' => 'tbl_',
        ),
		// uncomment the following to use a MySQL database
		/*
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=testdrive',
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

    'modules'=>array(
        'user' => array(
            // названия таблиц взяты по умолчанию, их можно изменить
            'tableUsers' => 'tbl_users',
            'tableProfiles' => 'tbl_profiles',
            'tableProfileFields' => 'tbl_profiles_fields',
        ),
    ),
);