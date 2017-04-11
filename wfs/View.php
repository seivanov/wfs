<?php

namespace wfs;

class View {
    
    public function render(Array $data, $is_ajax = false) {
        
        extract($data);

        ob_start();
        
            include( __DIR__ . '/../app/views/base/' . $this->page);
            $content = ob_get_contents();
            
        ob_end_clean();
        
        ob_start();
        
            include( __DIR__ . '/../app/views/layouts/' . $this->template);
            $page = ob_get_contents();
            
        ob_end_clean();        
        
        if($is_ajax)
            echo $content;
        else
            echo $page;
        
    }
    
}