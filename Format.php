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
        $string = str_replace('　', '', $string);
        return mb_strcut($string, 0, $number,'utf8');
    }
    
    /**
     * 价格处理成保留两位小数
     * @param float $price
     */
    public static function price($price)
    {
        return round($price, 2);
    }
    
    /**
     * 人民币转成美元
     * @param float $price 单位元
     */
    public static function toUSD($price)
    {
        return self::price($price/6.2);
    }
    
    /**
     * 国际运费成本￥
     * @param integer $weight 重量（克）每克9.5分RMB
     * @return 价格（单位分）
     */
    public static function getWeightCost($weight)
    {
        $price = $weight*1.5*9.5;
        
        return ceil($price);
    }
    
    /**
     * 综合计算不包含挂号费的情况下的推荐价
     * 总价大于X元必须挂号，所以利润必须大于挂号费8元
     * @param $cost 成本单价(分)
     */
    public static function breakevenPrice($cost, $x=10)
    {
        $z=$cost; //单个的成本价
        $y=$cost; //用于存储旧的推荐价，初始值等于单价
        $y_next=$y; // 新的推荐价，初始值等于单价+1分

        while( $y<$y_next ){
            $number = ceil($x/$y); // $x元除以单价得到数量并取整
            /**
             * 推荐价减成本价乘以数量得到利润，如果利润低于邮费则继续递增预算的推荐价
             * 否则单价等于旧的推荐价
             */
            if(($y-$z)*$number<800){
                $y_next++;
            }else{
                $cost = $y;
            }
            $y++;
        }
        return ceil($cost);
    }
}