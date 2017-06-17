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
        
        //Module check
        define(VIEWS_PATH, ShopEngine::ModuleCheck() !== ENGINE ? MVC_PATH : "../templates/");
        
        $view_path = VIEWS_PATH . 'views/'.ShopEngine::GetControllerName(true).'/'.$view_str.'.php';
        
        if(!file_exists($view_path))
        {
            return false;
        }
        
        ob_start([$this, "sanitize_output"]);
        
        $layout    = $this->controller->layout;
        require_once '../templates/layout/'.$layout.'.php';

        Request::EraseErrorSession();
        
    }
    
    public function sanitize_output($buffer) {
        
        $search = array(
            '/\>[^\S ]+/s',  
            '/[^\S ]+\</s', 
            '/(\s)+/s',
            '/<!--(.*?)-->/'
        );
        $replace = array(
            '>',
            '<',
            '\\1',
            ''
        );
        $buffer = preg_replace($search, $replace, $buffer);

        return $buffer;     
    }
    
}
