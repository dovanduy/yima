<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Magu.vn',
    'defaultController' => 'home',
    // preloading 'log' component
    'preload' => array('log'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.helpers.*',
        'application.widgets.*',
    ),
    'modules' => array(
    // uncomment the following to enable the Gii tool
    /*
      'gii'=>array(
      'class'=>'system.gii.GiiModule',
      'password'=>'Enter Your Password Here',
      // If removed, Gii defaults to localhost only. Edit carefully to taste.
      'ipFilters'=>array('127.0.0.1','::1'),
      ),
     */
    ),
    // application components
    'components' => array(
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
        ),
        // uncomment the following to enable URLs in path-format
        'urlManager' => array(
            'urlFormat' => 'path',
            'rules' => array(
            /* '<controller:\w+>/<id:\d+>' => '<controller>/view',
              '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
              '<controller:\w+>/<action:\w+>' => '<controller>/<action>', */
            ),
        ),
        /* 'db' => array(
          'connectionString' => 'sqlite:' . dirname(__FILE__) . '/../data/testdrive.db',
          ), */
        // uncomment the following to use a MySQL database

        /*'db' => array(
            'connectionString' => 'mysql:host=127.0.0.1;dbname=yimadb',
            'emulatePrepare' => true,
            //'enableProfiling' => true,
            //'enableParamLogging' => true,
            'username' => 'yima',
            'password' => '8$mdKKq5ngZQ',
            'charset' => 'utf8',
        ),*/
        'db' => array(
            'connectionString' => 'mysql:host=127.0.0.1;dbname=yima',
            'emulatePrepare' => true,
            //'enableProfiling' => true,
            //'enableParamLogging' => true,
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'home/error404',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
                // uncomment the following to show log messages on web pages
                /*
                array(
                    'class' => 'CWebLogRoute',
                    'enabled' => YII_DEBUG_SHOW_PROFILER,
                    'categories' => 'system.db.*',
                ),*/
            ),
        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'webmaster@example.com',
        'token_time' => 1,
        'ppp' => 20,
        'lang' => 'vn',
        'ticket_tax' => 0.1,
        'regx_number' => '/^\d+$/',
        
        'normal_letter' => '/^[A-Za-z0-9]+(?:[_][A-Za-z0-9]+)*$/',
        'speacial_char' => '/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/',
        'business'=>'nhanng_1346818305_biz@htmlfivemedia.com',
        
        //'upload_dir' => '/home/yima/http/hosts/yima.vn/front/upload/',
        //'upload_url' => "http://yima.vn/upload/",
       // 'upload_dir' => '/Applications/XAMPP/xamppfiles/htdocs/yima/front/upload/',        
        //'upload_url' => "/yima/front/upload/",
         'upload_dir'=>'D:/xampp/htdocs/yima/upload/',
        'upload_url'=>"/yima/upload/",
        'domain'=>'/yima/'       
    ),
);