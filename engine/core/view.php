<?php 


class View {
    
    public $controller;
    
    public function __construct($controller) {
        $this->controller = $controller;
        ShopEngine::Help()->UpdateCount();
    }

    public function render($view_str, $data = array())
    {
        if($data) 
        {
            foreach ($data as $key => $value) {
                $$key = $value;
            }
        }
        
        $view_path = ENGINE.'views/'.$view_str.'.php';
        if(!file_exists($view_path))
        {
            return false;
        }
        
        $layout    = $this->controller->layout;
        require_once '../template/layout/'.$layout.'.php';
        
        $view_path = ENGINE.'views/'.$view_path.'.php';
        
        Request::EraseErrorSession();
        
    }
    
}
