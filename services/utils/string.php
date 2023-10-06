<?php
class Str
{


    // Turns strings into uppercase (used in genres and authors)
    public static function toUpperCamelCase($raw)
    {
        $str = ucwords(strtolower($raw), " \t\r\n\f\v.:,");
        return $str;
    }

}
