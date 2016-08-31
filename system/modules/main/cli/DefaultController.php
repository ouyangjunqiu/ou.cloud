<?php
namespace app\modules\main\cli;
use cloud\core\cli\Controller;

/**
 * @file DefaultController.php
 * @author ouyangjunqiu
 * @version Created by 16/8/30 14:07
 */
class DefaultController extends Controller
{
    public function actionIndex(){
        echo "hello! cli";
    }

}