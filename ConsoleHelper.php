<?php
/**
 * @author CoLee
 */
namespace colee\helpers;

class ConsoleHelper
{
    /**
     * 格式化字符
     * @param string $string
     * @param array $params
     * eg: ConsoleHelper::log('截至昨日已结束但未处理的任务（%s）个', [count($tasks)]);
     */
    public static function format($string, $params=[])
    {
        array_unshift($params, $string);
        $str = call_user_func_array('sprintf', $params);
        if(DIRECTORY_SEPARATOR=='\\'){
            return mb_convert_encoding($str, 'gbk','utf8');
        }else{
            return $str;
        }
    }
    
    /**
     * @param  [type]
     * @param  array
     * @return [type]
     */
    public static function log($string, $params=[])
    {
        echo self::format($string, $params).PHP_EOL;
    }
}