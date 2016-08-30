<?php
/**
 * @file InitEnvEvent.php
 * @author ouyangjunqiu
 * @version Created by 16/8/30 09:18
 */

namespace cloud\core\web;


use cloud\Cloud;
use cloud\core\utils\Convert;
use cloud\core\utils\DateTime;
use cloud\core\utils\Env;

class InitEnv
{
    public static function handle(){
        define( 'STATICURL', Cloud::$app->assetManager->getBaseUrl() );

        define( 'IN_MOBILE', Env::checkInMobile() );
        define( 'TIMESTAMP', time() );
        define( 'IN_APP', Env::checkInApp() );

        if ( function_exists( 'ini_get' ) ) {
            $memorylimit = @ini_get( 'memory_limit' );
            if ( $memorylimit && Convert::ConvertBytes( $memorylimit ) < 33554432 && function_exists( 'ini_set' ) ) {
                ini_set( 'memory_limit', '128m' );
            }
        }

        $global = array(
            'timestamp' => TIMESTAMP,
            'version' => VERSION,
            'clientip' => Env::getClientIp(),
            'referer' => '',
            'charset' => CHARSET,
            'authkey' => '',
            'newversion' => 0,
            'config' => array(),
            'setting' => array(),
            'user' => array(),
            'cookie' => array(),
            'session' => array(),
            'lunar' => DateTime::getlunarCalendar(),
            'staticurl' => STATICURL
        );

        $global['phpself'] = Env::getScriptUrl();
        $sitePath = substr( $global['phpself'], 0, strrpos( $global['phpself'], '/' ) );
        $global['isHTTPS'] = Env::isHttps();
        $global['siteurl'] = Env::getSiteUrl( $global['isHTTPS'], $sitePath );
        $url = parse_url( $global['siteurl'] );
        $global['siteroot'] = isset( $url['path'] ) ? $url['path'] : '';
        $global['siteport'] = empty( $_SERVER['SERVER_PORT'] ) || $_SERVER['SERVER_PORT'] == '80' || $_SERVER['SERVER_PORT'] == '443' ? '' : ':' . $_SERVER['SERVER_PORT'];

        Cloud::$app->setting->copyFrom( $global );
    }

}