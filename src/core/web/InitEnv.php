<?php
/**
 * @author oshine <oyjqdlp@126.com>
 * @link https://github.com/ouyangjunqiu/ou.cloud
 * @see https://github.com/ouyangjunqiu/ou.cloud
 */

namespace cloud\core\web;


use cloud\Cloud;
use cloud\core\utils\Convert;
use cloud\core\utils\DateTime;
use cloud\core\utils\Env;

class InitEnv
{
    public static function handle(){
        defined( 'STATICURL') or define( 'STATICURL', Cloud::$app->getUrlManager()->getBaseUrl());

        if ( function_exists( 'ini_get' ) ) {
            $memorylimit = @ini_get( 'memory_limit' );
            if ( $memorylimit && Convert::ConvertBytes( $memorylimit ) < 33554432 && function_exists( 'ini_set' ) ) {
                ini_set( 'memory_limit', '128m' );
            }
        }

        $global = array(
            'clientip' => Env::getClientIp(),
            'referer' => '',
            'charset' => Cloud::$app->charset,
            'authkey' => '',
            'newversion' => 0,
            'config' => array(),
            'setting' => array(),
            'user' => array(),
            'cookie' => array(),
            'session' => array(),
            'staticurl' => STATICURL
        );
        Cloud::$app->getSetting()->copyFrom( $global );
    }

}