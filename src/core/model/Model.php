<?php

/**
 * 数据层操作的抽象基类,提供给所有Model封装过的基本操作
 * 
 * @package cloud.core.model
 * @version $Id$
 * @author oShine
 */

namespace cloud\core\model;

use yii\db\ActiveRecord;

class Model extends ActiveRecord {

    /**
     * 查询一条符合条件的数据，返回数组 不缓存
     * @param mixed $condition 条件字符串 || 数组 || criteria对象{@link CDbCriteria}
     * @param array $params 参数绑定到SQL语句
     * @return array 
     */
    public static function fetch($condition = '', $params = array() ) {

        $find = self::find();
        return $find->where($condition,$params)->asArray()->one();
    }

    /**
     * @param $sql
     * @param array $params
     * @return $this
     */
    public static function fetchBySql($sql, $params = []){

        return self::findBySql($sql,$params)->asArray()->all();
    }

    /**
     * 查询所有数据，返回一个数组集合 不缓存 
     * @param mixed $condition 条件字符串 || 数组 || criteria对象{@link CDbCriteria}
     * @param array $params 参数绑定到SQL语句
     * @return array 
     */
    public function fetchAll( $condition = '', $params = array() ) {

        $find = self::find();
        return $find->where($condition,$params)->asArray()->all();
    }

    /**
     * @param string $separator
     * @return string
     */
    public function formatError($separator = '<br/>')
    {
        $messages = array();
        $errors = $this->getErrors();
        foreach ($errors as $error)
            $messages[] = pos($error);
        return implode($separator, $messages);
    }

}
