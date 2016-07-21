<?php
/**
 * @author CoLee
 */
namespace colee\helpers;

use yii\helpers\Console;
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
        if(DIRECTORY_SEPARATOR=='\\' && mb_detect_encoding($str)=='GBK'){//通过window下的分隔符判断win平台
            return mb_convert_encoding($str, 'gbk','utf8');
        }else{
            return $str;
        }
    }
    
    /**
     * @param string $string
     * @param array $params
     * @param string $color
     *   text      text            background
     *   ------------------------------------------------
     *   %k %K %0    black     dark grey       black
     *   %r %R %1    red       bold red        red
     *   %g %G %2    green     bold green      green
     *   %y %Y %3    yellow    bold yellow     yellow
     *   %b %B %4    blue      bold blue       blue
     *   %m %M %5    magenta   bold magenta    magenta
     *   %p %P       magenta (think: purple)
     *   %c %C %6    cyan      bold cyan       cyan
     *   %w %W %7    white     bold white      white
     *   %F     Blinking, Flashing
     *   %U     Underline
     *   %8     Reverse
     *   %_,%9  Bold
     *   %n     Resets the color
     *   %%     A single %
     * @return [type]
     */
    public static function log($string, $params=[], $color=false)
    {
        $string = self::format($string, $params).PHP_EOL;
        if ($color) {
            $string = Console::renderColoredString('%'.$color.$string);
        }
        
        echo $string;
    }
}