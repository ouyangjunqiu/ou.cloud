<?php
/**
 * @author oshine <oyjqdlp@126.com>
 */
namespace cloud;

use cloud\core\engines\Engine;
use cloud\core\engines\Io;
use yii\base\Exception;

require __DIR__."defines.php";

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
        return self::$_engine;
    }

    /**
     * @return null|Io
     */
    public static function io(){
        return self::engine() == null?null:self::engine()->io();
    }

    /**
     * 设置当前平台引擎,如果已经设置或为空会抛出一个异常
     * @param object $engine
     * @throws Exception
     */
    public static function setEngine( $engine ) {
        if ( self::$_engine === null || $engine === null ) {
            self::$_engine = $engine;
        } else {
            throw new Exception( self::t( 'engine can only be created once.', 'error' ) );
        }
    }
}