<?php
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');
define("DIR", "/usr/share/nginx/html");


require DIR . '/vendor/autoload.php';
require DIR . '/vendor/yiisoft/yii2/Yii.php';
require DIR . '/common/config/bootstrap.php';
require DIR . '/backend/config/bootstrap.php';


$config = yii\helpers\ArrayHelper::merge(
    require DIR . '/common/config/main.php',
    require DIR . '/common/config/main-local.php',
    require DIR . '/backend/config/main.php',
    require DIR . '/backend/config/main-local.php'
);


//var_dump($config);die;

(new yii\web\Application($config))->run();


