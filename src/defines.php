<?php

/**
 * 全局常量定义文件
 *
 * @author oShine
 */
define( 'PATH_SYSTEM', PATH_ROOT . DIRECTORY_SEPARATOR . 'system');
define( 'PATH_DATA', PATH_ROOT . DIRECTORY_SEPARATOR . 'data');
define( 'PATH_MODULES', PATH_SYSTEM . DIRECTORY_SEPARATOR . 'modules');

if(file_exists(PATH_DATA."/deploy")){
    defined( 'DEBUG' ) or define( 'DEBUG', false );

    defined( 'ENGINE' ) or define( 'ENGINE', 'PROD' );            // 引擎 默认为本地引擎

}else{
    defined( 'DEBUG' ) or define( 'DEBUG', true );
    defined( 'ENGINE' ) or define( 'ENGINE', 'LOCAL' );            // 引擎 默认为本地引擎

    defined('YII_ENV') or define('YII_ENV', 'dev');
    error_reporting( E_ALL | E_STRICT );
}

// 字符编码
define( 'CHARSET', 'utf-8' );
// 调试模式
defined( 'YII_DEBUG' ) or define( 'YII_DEBUG', DEBUG );

// 错误等级
define( 'YII_TRACE_LEVEL', DEBUG ? 3 : 0  );

define('VERSION', '2.0.1');

define('PAGE_SIZE',20);

