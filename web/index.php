<?php

// comment out the following two lines when deployed to production
defined('PATH_ROOT') or define( 'PATH_ROOT', dirname(__DIR__) );

require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');
$config = array();

$app = (new cloud\core\web\Application($config));
$app->run();