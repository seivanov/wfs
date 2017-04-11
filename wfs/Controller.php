<?php

namespace wfs;

use wfs\View;

class Controller extends View {
    
    protected $is_ajax = false;
    
    public function __construct($is_ajax) {
        $this->is_ajax = $is_ajax;
    }
    
}