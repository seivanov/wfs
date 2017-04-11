<?php

namespace wfs;

use wfs\Router;

class App {
    
    private $is_ajax = false;
    
    public function start() {
        
        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) 
                && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
            $this->is_ajax = true;
        
        Router::set($_SERVER);
        Router::add('/', 'MainController', 'actionIndex');
        Router::add('/admin/', 'MainController', 'actionAdmin');
        
        $controller = Router::getController();
        $action = Router::getAction();
        
        $cname = '\\app\\controllers\\'.$controller;
        $controller = new $cname($this->is_ajax);
        $controller->$action();
        
    }
    
}