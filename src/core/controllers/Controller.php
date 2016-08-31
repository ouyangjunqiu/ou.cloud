<?php
/**
 * 全局控制器必须继承自CController
 * @package cloud.core.controllers
 * @author oshine <oshine.ouyang@da-mai.com>
 */

namespace cloud\core\controllers;

use cloud\Cloud;
use cloud\core\web\Application;
use yii\helpers\Json;

class Controller extends \yii\web\Controller {

    /**
     * 默认Jsonp回调函数
     */
    const DEFAULT_JSONP_HANDLER = 'jsonpReturn';

    /**
     * 布局类型
     * @var string 
     */
    public $layout = '';



    /**
     * 错误异常处理
     * @return void 
     */
    public function actionError() {
        $error = Cloud::$app->getErrorHandler()->exception;
        if ( $error ) {
            $isAjaxRequest = Cloud::$app->request->getIsAjax();
            $this->error( $error['message'], '', array(), $isAjaxRequest );
        }
    }

    /**
     * 覆盖父类渲染视图方法，在视图变量处增加静态资源路径，合并语言包文件方法
     * @param string $view @see \yii\web\Controller::render
     * @param array $params @see \yii\web\Controller::render
     * @return mixed @see \yii\web\Controller::render
     */
    public function render( $view, $params = []) {
        return parent::render( $view, $params);
    }

    /**
     * Ajax方式返回数据到客户端
     * @param mixed $data 要返回的数据
     * @param String $type AJAX返回数据格式
     * @return void
     */
    public function ajaxReturn( $data, $type = '' ) {
        /**
         * @var Application $app
         */
        $app = Cloud::$app;
        $charset = $app->charset;

        if ( empty( $type ) ) {
            $type = 'json';
        }
        
        switch ( strtoupper( $type ) ) {
            case 'JSON' :
                // 返回JSON数据格式到客户端 包含状态信息
                header( 'Content-Type:application/json; charset=' . $charset );
                exit( JSON::encode( $data ) );
                break;
            case 'XML' :
                // 返回xml格式数据
                header( 'Content-Type:text/xml; charset=' . $charset );
                exit( xml_encode( $data ) );
                break;
            case 'JSONP':
                // 返回JSONP数据格式到客户端 包含状态信息
                header( 'Content-Type:text/html; charset=' . $charset );
                $handler = isset( $_GET['callback'] ) ? $_GET['callback'] : self::DEFAULT_JSONP_HANDLER;
                exit( $handler . '(' . (!empty( $data ) ? JSON::encode( $data ) : '') . ');' );
                break;
            case 'EVAL' :
                // 返回可执行的js脚本
                header( 'Content-Type:text/html; charset=' . $charset );
                exit( $data );
                break;
            default :
                exit( $data );
                break;
        }
    }

    /**
     * 操作错误跳转的快捷方法
     * @param string $message 错误信息
     * @param string $jumpUrl 页面跳转地址
     * @param array $params	 输出页面配置数组
     * <pre>
     * 	$params = array(
     * 		// 操作信息类型【success | error | info】 默认为success
     * 		'messageType' => 'success',	
     * 		// 是否自动跳转 默认为true
     * 		'autoJump' => true,			
     * 		// 等待自动跳转时间，只有在autoJump为true时才有效
     * 		'timeout' => 3,				
     * 		// 供给选择的跳转链接地址，最多三个。只有在autoJump=false时才有效
     * 		'jumpLinksOptions' => array( '地址名1' => 'url1','地址名2' => 'url2' )
     * 		// 额外js代码
     * 		'script' = 'function ddd(){}', 
     * 	);
     * </pre>
     * @param boolean $ajax 是否为Ajax方式
     * @return void
     */
    public function error( $message = '', $jumpUrl = '', $params = array(), $ajax = false ) {
        $this->showMessage( $message, $jumpUrl, $params, 0, $ajax );
    }

    /**
     * 操作成功跳转的快捷方法
     * @param string $message 提示信息
     * @param string $jumpUrl 页面跳转地址
     * @param array $params	 输出页面配置数组
     * <pre>
     * 	$params = array(
     * 		// 操作信息类型【success | error | info】 默认为success
     * 		'messageType' => 'success',	
     * 		// 是否自动跳转 默认为true
     * 		'autoJump' => true,			
     * 		// 等待自动跳转时间，只有在autoJump为true时才有效
     * 		'timeout' => 3,				
     * 		// 供给选择的跳转链接地址，最多三个。只有在autoJump=false时才有效
     * 		'jumpLinksOptions' => array( '地址名1' => 'url1','地址名2' => 'url2' )
     * 		// 额外js代码
     * 		'script' = 'function ddd(){}', 
     * 	);
     * </pre>
     * @param boolean $ajax 是否为Ajax方式
     * @return void
     */
    public function success( $message = '', $jumpUrl = '', $params = array(), $ajax = false ) {
        $this->showMessage( $message, $jumpUrl, $params, 1, $ajax );
    }

    /**
     * 输出信息
     * @param string $message 要输出的信息
     * @param string $jumpUrl 页面跳转地址
     * @param array $params	 输出页面配置数组
     * <pre>
     * 	$params = array(
     * 		// 操作信息类型【success | error | info】 默认为success
     * 		'messageType' => 'success',	
     * 		// 是否自动跳转 默认为true
     * 		'autoJump' => true,			
     * 		// 等待自动跳转时间，只有在autoJump为true时才有效
     * 		'timeout' => 3,				
     * 		// 供给选择的跳转链接地址，最多三个。只有在autoJump=false时才有效
     * 		'jumpLinksOptions' => array( '地址名1' => 'url1','地址名2' => 'url2' )
     * 		// 额外js代码
     * 		'script' = 'function ddd(){}', 
     * 	);
     * </pre>
     * @param integer $status 快捷处理信息状态，1为成功，0为错误，目前只提供了这两种方式
     * @param boolean $ajax 是否为Ajax方式
     * @return void 
     */
    public function showMessage( $message, $jumpUrl = '', $params = array(), $status = 1, $ajax = false ) {
		
        // AJAX提交方式的处理
        if ( $ajax === true || Cloud::$app->request->getIsAjax() ) {
            $data = is_array( $ajax ) ? $ajax : array();
            $data['msg'] = $message;
            $data['isSuccess'] = $status;
            $data['url'] = $jumpUrl;
            $this->ajaxReturn( $data );
        }
        $params['message'] = $message;
        // autoJump : 是否自动跳转
        $params['autoJump'] = isset( $params['autoJump'] ) ? $params['autoJump'] : true;
        // jumpLinksOptions : 不自动跳转的情况下，供选择跳转的url
        if ( !$params['autoJump'] ) {
            $params['jumpLinksOptions'] = isset( $params['jumpLinksOptions'] ) && is_array( $params['jumpLinksOptions'] ) ?
                    $params['jumpLinksOptions'] : array();
        } else {
            $params['jumpLinksOptions'] = array();
        }
        // 跳转url
        if ( !empty( $jumpUrl ) ) {
            $params['jumpUrl'] = $jumpUrl;
        } else {
            $params['jumpUrl'] = isset( $_SERVER["HTTP_REFERER"] ) ? $_SERVER["HTTP_REFERER"] : '';
        }
        // timeout ：自动跳转超时时间
        if ( !isset( $params['timeout'] ) ) {
            if ( $status ) {
                // 成功操作后默认停留1秒
                $params['timeout'] = 1;
            } else {
                // 发生错误时候默认停留3秒
                $params['timeout'] = 5;
            }
        }
        // 提示标题
        $params['msgTitle'] = $status ? Cloud::t('cloud', 'Operation successful') :
            Cloud::t('cloud', 'Operation failure');
        // 如果设置了关闭窗口，则提示完毕后自动关闭窗口
        if ( isset( $params['closeWin'] ) ) {
            $params['jumpUrl'] = 'javascript:window.close();';
        }
        // 自带脚本执行
        $params['script'] = isset( $params['script'] ) ? trim( $params['script'] ) : null;
        // 消息类型
        if ( !isset( $params['messageType'] ) ) {
            $params['messageType'] = $status ? 'success' : 'error';
        }
		
        if ( $status ) {
            $this->redirect( $params['jumpUrl'] );
        } else {
            $output = $this->renderFile( '@app/theme/showMessage', $params);
            echo $output;
        }
        \Yii::$app->end();
    }

    public function renderJson($data)
    {
        $this->ajaxReturn($data,"json");
    }
}
