<?php

namespace wfs;

class Loader {
    
    public function __construct() {
        
        spl_autoload_register(function ($class_name) {
            
            $init_method_name = 'init';
            $orig_class_name = $class_name;
            
            $class_name = str_replace('\\', '/', $class_name);
            $file = __DIR__ . '/../' . $class_name . '.php';
            
            if(file_exists($file)) {
                
                require($file);
                
                if(class_exists($orig_class_name) 
                        && method_exists($orig_class_name, $init_method_name))
                {
                    
                    $reflection_class = new \ReflectionClass($orig_class_name);
                    $reflection_method = new \ReflectionMethod($orig_class_name, $init_method_name);
                                        
                    if($reflection_method->isPublic() && !$reflection_class->isAbstract())
                        $orig_class_name::$init_method_name();
                }
                
            } else
                throw new \Exception("Невозможно загрузить $class_name.");
            
        });
        
    }
    
}

(new Loader());