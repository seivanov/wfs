<?php

namespace wfs;

class MySql {
    
    private static $connect;
    
    static function getRow($sql) {
        
        $result = mysqli_query(self::$connect, $sql);
        return mysqli_fetch_object($result);
        
    }
    
    static function getRows($sql) {
        
        $rows = [];
        $result = mysqli_query(self::$connect, $sql);
        while($obj = mysqli_fetch_object($result))
                $rows[] = $obj;
        
        return $rows;
        
    }    
    
    static function init() {
        
        self::$connect = mysqli_connect('localhost', 'root', '123456', 'wfs');
        
    }
    
}