<?php
/**
 * @author oshine <oyjqdlp@126.com>
 * @link https://github.com/ouyangjunqiu/ou.cloud
 * @see https://github.com/ouyangjunqiu/ou.cloud
 */

namespace cloud\core\engines;

/**
 * IO抽象父类,提供本地及云引擎之间的IO读写接口
 * @package application.core.engines
 * @version $Id$
 * @author oshine <oyjqdlp@126.com>
 */

abstract class Io {

    /**
     * @return string
     */
    abstract function getBasePath();

    /**
     * 上传接口
     */
    abstract function upload( $fileArea, $module );

    /**
     * 文件及文件夹处理接口
     */
    abstract function file();
}
