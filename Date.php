<?php

class Date{
    private static $db = null;

    function __construct($timezone = null)
    {
        if ($timezone){
            date_default_timezone_set($timezone);
        }
    }

    public static function getInstance($timezone = null){
        if (!self::$db){
            self::$db = new Date($timezone);
            return self::$db;
        }
        return self::$db;
    }

    public function today(){
        return date('Y-m-d h:i:s');
    }

}