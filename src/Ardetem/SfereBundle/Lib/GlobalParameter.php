<?php
/**
 * Created by PhpStorm.
 * User: ferdinandfly
 * Date: 3/15/14
 * Time: 6:32 PM
 */

namespace Ardetem\SfereBundle\Lib;


class GlobalParameter {
    private static $locale;
    public static function setLocale($locale){
        self::$locale=$locale;
    }
    public static function getLocale(){
        return self::$locale;
    }
} 