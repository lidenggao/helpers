<?php
/**
 * ==============================================
 * Copy right 2015-2016
 * ----------------------------------------------
 * This is not a free software, without any authorization is not allowed to use and spread.
 * ==============================================
 * @param unknowtype
 * @return return_type
 * @author: CoLee
 */

namespace colee\helpers;

class Format
{
    // 截字
    public static function substr($string, $number)
    {
        $string = preg_replace('/\s/', '', strip_tags($string));
        return mb_substr($string, 0, $number,'utf8');
    }
}