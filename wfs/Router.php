<?php

namespace wfs;

class Router {
    
    static $request;
    static $pathList = [];
    
    public static function set($request) {       
        self::$request = $request['REQUEST_URI'];
    }
    
    public static function add($path, $controller, $action) {       
        self::$pathList[] = [
            'path' => $path,
            'controller' => $controller,
            'action' => $action
        ];
    }    
    
    public static function getController() {
        
        foreach(self::$pathList as $path) {
            if($path['path'] == self::$request) {
                return $path['controller'];
            }
        }
        
        return 'MainController';
    }    
    
    public static function getAction() {
        
        foreach(self::$pathList as $path) {
            if($path['path'] == self::$request) {
                return $path['action'];
            }
        }
        
        return 'actionIndex';
        
    }
    
}