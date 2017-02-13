<?php
/**
 * @author oshine <oyjqdlp@126.com>
 * @link https://github.com/ouyangjunqiu/ou.cloud
 * @see https://github.com/ouyangjunqiu/ou.cloud
 */

/**
 * 缓存工具类，提供AppCloud缓存组件的简短写法及系统缓存方法封装
 * @package cloud.core.utils
 */

namespace cloud\core\utils;

use CEvent;
use cloud\Cloud;
use yii\caching\FileCache;

class Cache {

    /**
     * 检查缓存组件
     * @return string
     */

    public static function check() {
        return true;
    }

    /**
     * 设置一个缓存值
     * @param string $key 缓存的key
     * @param mixed $value 缓存的值
     * @param mixed $ttl 缓存的有效期
     * @return boolean
     */
    public static function set( $key, $value, $ttl = null ) {
        return Cloud::$app->cache->set( $key, $value, $ttl );
    }

    /**
     * 根据$id获取一个缓存值
     * @param string $key 缓存的key
     * @return boolean
     */
    public static function get( $key ) {
        return Cloud::$app->cache->get( $key );
    }

    /**
     * 根据$key移除一个缓存值
     * @param string $key 缓存的key
     * @return boolean
     */
    public static function rm( $key ) {
        return Cloud::$app->cache->delete( $key );
    }

    /**
     * 清空缓存接口
     * @return boolean
     */
    public static function clear() {
        Cloud::$app->cache->flush();
    }

}
