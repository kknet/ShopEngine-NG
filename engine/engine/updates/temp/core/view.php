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
        
        ob_start([$this, "sanitize_output"]);
        
        $layout    = $this->controller->layout;
        require_once '../template/layout/'.$layout.'.php';

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
