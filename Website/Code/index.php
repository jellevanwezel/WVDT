<?php

if (isset($_GET['sessionId']))
{
   $_COOKIE['PHPSESSID'] = $_GET['sessionId'];
}

// change the following paths if necessary
$yii=dirname(__FILE__).'/../Framework/Yii 1.1.14/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);
Yii::createWebApplication($config)->run();
