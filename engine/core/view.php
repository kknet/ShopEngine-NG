<?php 


class View {
    
    public $controller;
    public $widgets;
    
    public function __construct($controller) {
        $this->controller = $controller;
        $this->widgets    = ShopEngine::LoadWidgets();
    }

    public function render($view_str, $data = array())
    {
        if($data) 
        {
            foreach ($data as $key => $value) {
                $$key = $value;
            }
        }
        
        $view_path = ENGINE.'views/'.ShopEngine::GetControllerName(true).'/'.$view_str.'.php';
        
        if(!file_exists($view_path))
        {
            return false;
        }
        
        $layout    = $this->controller->layout;
        require_once '../template/layout/'.$layout.'.php';
        
        Request::EraseErrorSession();
        
    }
    
}
