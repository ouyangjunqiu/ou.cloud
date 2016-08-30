<?php
/**
 * 引擎驱动抽象父类,初始化程序配置文件，提供IO与初始化配置接口给子类扩展
 * 
 * @package cloud.core.components
 * @author oshine <oshine.ouyang@da-mai.com>
 * @version $Id$
 */

namespace cloud\core\engines;

use yii\helpers\ArrayHelper;

abstract class Engine {

    /**
     * 当前引擎处理过后的配置文件
     * @var array 
     */
    protected $_engineConfig;

    /**
     * 构造方法，初始化安装config与程序config,调用子类特定的引擎配置方法
     */
    final function __construct() {
        $this->_engineConfig = array();
        $this->init();
    }

    /**
     * 获取当前引擎处理过后的配置文件
     * @return array
     */
    public function getConfig() {
        return (array) $this->_engineConfig;
    }

    /**
     * @param $config
     */
    public function setConfig($config) {
        $this->_engineConfig = $config;
    }

    /**
     * @param $config
     */
    public function configure($config){
        $this->_engineConfig = ArrayHelper::merge($this->_engineConfig,$config);
    }

    /**
     * 开始配置前的预处理，子类应重新实现该方法
     * @return void
     */
    protected function init() {
        
    }

    /**
     *
     */
    public function bootstrap(){

    }

    /**
     * io 接口
     */
    abstract public function io();
}
