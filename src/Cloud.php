<?php
/**
 * @author oshine <oyjqdlp@126.com>
 */
namespace cloud;

use cloud\core\engines\Engine;
use cloud\core\engines\Io;
use cloud\core\engines\Local;
use cloud\core\engines\Product;

class Cloud extends \Yii
{
    /**
     * 当前平台引擎
     * @var null|Engine
     */
    private static $_engine;

    /**
     * 返回当前平台引擎
     * @return Engine|null
     */
    public static function engine() {
        if ( self::$_engine === null ) {
            if(file_exists(PATH_ROOT."/data/deploy")){
                defined( 'YII_DEBUG' ) or define( 'YII_DEBUG', false );
                self::$_engine = new Product();
            }else{
                defined( 'YII_DEBUG' ) or define( 'YII_DEBUG', true );
                error_reporting( E_ALL | E_STRICT );
                self::$_engine = new Local();
            }
        }

        return self::$_engine;
    }

    /**
     * @return Io
     */
    public static function io(){
        return self::engine()->io();
    }

}