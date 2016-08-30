<?php
/**
 * 重写UrlManager
 * @package cloud.core.components
 * @author oshine <oshine.ouyang@da-mai.com>
 */

namespace cloud\core\components;


class UrlManager extends \yii\web\UrlManager
{
    public function createUrl($params)
    {
        if(!isset($params["_t"])){
            $params["_t"] = time();
        }
        return parent::createUrl($params);
    }

}