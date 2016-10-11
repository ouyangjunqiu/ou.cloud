# ou.cloud
cloud framework 2.0，使用yii2.0

使用yii2.0

>Yii 是一个高性能的，适用于开发 WEB2.0 应用的 PHP 框架。

>Yii 自带了丰富的功能 ，包括 MVC，DAO/ActiveRecord，I18N/L10N，缓存，身份验证和基于角色的访问控制，脚手架，测试等，可显著缩短开发时间。

下载：

	git clone https://github.com/ouyangjunqiu/ou.cloud.git
	
安装：
	
	composer global require "fxp/composer-asset-plugin:~1.1.1"
	
	cd ou.cloud/
	
	composer install
	
#####使用：

1. 创建一个web项目,项目的目录结构为

     |- data *运行后的资源目录*
     
     |- src *cloud框架目录*
     
     |- system *应用程序目录*
     
     |- web  *web入口文件目录*	
     
     |- vendor  *第三方扩展目录*	
     
 2. 创建一个项目,入口文件: web/index.php

	~~~
	<?php
	
	defined('PATH_ROOT') or define( 'PATH_ROOT', dirname(__DIR__) );
	
	require(__DIR__ . '/../vendor/autoload.php');
	require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');
	$config = array();
	
	$app = (new cloud\core\web\Application($config));
	$app->run(); 		  
	~~~

3. 创建一个module,案例main.

	* 创建 system/modules/main/MainModule.php
	
		~~~
   	 	<?php
    
       namespace app\modules\main;
       use cloud\core\modules\Module;
       class MainModule extends Module {
       }
		~~~
    * 创建 system/modules/main/install/config.php 为模块配置文件

  	 ~~~
		<?php
		
		return array(
		    'config' => array(
		        'modules' => array(
		            'main' => array(
		                'class' => 'app\modules\main\MainModule'
		            )
		        ),
		    ),
		);
    
		~~~

    * 创建 system/modules/main/controllers/DefaultController.php 为控制器文件
     
     ~~~
    <?php
        namespace app\modules\main\controllers;
        use cloud\core\controllers\Controller;
        class DefaultController extends Controller
        {
            public function actionIndex(){
                echo “hello world！”;
            }
        }
 	~~~
 	
   * 访问:http://localhost/web/index.php?r=main/default/index


     
   
