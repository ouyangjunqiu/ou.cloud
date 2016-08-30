<?php

// comment out the following two lines when deployed to production
defined('PATH_ROOT') or define( 'PATH_ROOT', dirname(__DIR__) );

require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/cloud/Cloud.php');

(new cloud\core\web\Application(array()))->run();