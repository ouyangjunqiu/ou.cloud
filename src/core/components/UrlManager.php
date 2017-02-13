<?php
/**
 * @author oshine <oyjqdlp@126.com>
 * @link https://github.com/ouyangjunqiu/ou.cloud
 * @see https://github.com/ouyangjunqiu/ou.cloud
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