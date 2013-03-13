<?php

// change the following paths if necessary
$yii = dirname(__FILE__) . '/../framework/yii.php';
$config = dirname(__FILE__) . '/protected/config/main.php';


// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG', true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);

//set error display and reporting. COmmand 2 lines below if don't want to display in hosting
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once($yii);
date_default_timezone_set('Asia/Saigon');
Yii::createWebApplication($config)->run();

