<?php
/**
 * @author oshine <oyjqdlp@126.com>
 * @link https://github.com/ouyangjunqiu/ou.cloud
 * @see https://github.com/ouyangjunqiu/ou.cloud
 */


namespace cloud\core\components;

use cloud\Cloud;
use yii\base\Component;
/**
 * 核心组件------插件管理器组件类，必须继承CApplicationComponent
 * @package cloud.core.components
 * @author oshine <oshine.ouyang@da-mai.com>
 */
abstract class PlugManager extends Component {

    /**
     * 是否已安装
     * @var boolean 
     * @access private
     */
    private $_init = false;

    /**
     * 初始化各自的插件
     * @param string $moduleName 模块名
     */
    public function setInit( $moduleName ) {
        $installedModule = Cloud::app()->getEnabledModule();
        if ( isset( $installedModule[$moduleName] ) ) {
            Cloud::app()->getModule( $moduleName );
            $this->_init = true;
        }
    }

    /**
     * 返回是否已安装标示符
     * @return boolean
     */
    public function getInit() {
        return $this->_init;
    }

}
