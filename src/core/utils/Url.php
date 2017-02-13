<?php
/**
 * @author oshine <oyjqdlp@126.com>
 * @link https://github.com/ouyangjunqiu/ou.cloud
 * @see https://github.com/ouyangjunqiu/ou.cloud
 */

/**
 * 提供url处理
 * 
 * @package application.core.utils
 */

namespace cloud\core\utils;

use cloud\Cloud;

class Url {

    /**
     * 根据路由获取站内或者站外地址
     * @param string $url 路由地址
     * @return string
     */
    public static function getUrl( $url ) {
        if ( count( explode( '/', $url ) ) == 3 && !preg_match( "/^http/iUs", $url ) ) {
            $url = Cloud::$app->urlManager->createUrl( $url );
        } else {
            $urlInfo = parse_url( $url );
            $url = isset( $urlInfo['scheme'] ) ? $url : 'http://' . $url;
        }
        return str_replace( '"', "'", $url );
    }

}
