<?php
/**
 * @file InitEnvEvent.php
 * @author ouyangjunqiu
 * @version Created by 16/8/30 09:18
 */

namespace cloud\core\web;


use cloud\Cloud;
use cloud\core\utils\Convert;
use cloud\core\utils\Env;

class InitEnv
{
    public static function handle(){

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
        );

        Cloud::$app->setting->copyFrom( $global );
    }

}