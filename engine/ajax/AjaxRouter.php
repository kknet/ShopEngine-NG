<?php

class AjaxRouter {
    
    public static function start() 
    {
        session_start();
        $routes = ShopEngine::GetRoute();

        if(!empty($routes[2])) 
        {
            $handler_class = ucfirst($routes[2]);
            $handler_name  = $routes[2].'.php';
        }

        require_once 'engine/handlers/'.$handler_name;
        
        $handler = new $handler_class;
        
        echo $handler->start();
    }
    
}
