<?php
/**
 * @author oshine <oyjqdlp@126.com>
 * @link https://github.com/ouyangjunqiu/ou.cloud
 * @see https://github.com/ouyangjunqiu/ou.cloud
 */
namespace cloud\core\utils;

class Sorter {
    private $field;

    public function __construct($field)
    {
        $this->field = $field;
    }

    public function compare($a,$b){
        return $a[$this->field] == $b[$this->field]?0:($a[$this->field] > $b[$this->field] ? -1 : 1);
    }

    public static function sort(&$data,$field){
        $sorter = new self($field);
        usort($data,array($sorter,"compare"));
    }
}