<?php

class Controller_Pages extends Controller{
    
    public $errors;
    
    public function Action_Basic()
    {
        if(Request::Post('contact'))
        {
            $csrf = Request::Post('csrf');
            if(!ShopEngine::Help()->ValidateToken($csrf))
            {
                return false;
            }
            
            $this->errors = $this->GetModel()->Validate();
            if(!$this->errors) {
                
                if(!$this->GetModel()->Feedback()) 
                {
                    return false;
                }
                
                Request::SetSession('contact_message', 'success');
                
            } else {
                Request::SetSession('contact_message', 'error');
            }
            
        }
        
        $handle = ShopEngine::GetAction();
        
        $sql = "SELECT * FROM pages WHERE pages_handle=?";
        $content = Getter::GetFreeData($sql, [$handle]);
        if(!$content) 
        {
            Route::ErrorPage404();
        }
        
        $this->title = $content['pages_title'];
        
        return $this->view->render(ShopEngine::GetView(), [
            'content' => $content
        ]);
    }
        
    public static function GetData()
    {
        $handle = ShopEngine::GetAction();
        
        $sql = "SELECT * FROM pages WHERE pages_handle=?";
        $content = Getter::GetFreeData($sql, [$handle]);
        if(count($content) < 1 OR !$handle) 
        {
            Route::ErrorPage404();
        }
        return $content;
    }
    
    public static function GetForm()
    {
        $handle = ShopEngine::GetAction();
        
        
        // i'll get rule in config later
        if($handle === 'contact')
        {
            return true;
        }
    }
    
    public function SEO() {
        return [
            'name' => [
                'description' => 'Информация для покупателей: '.$this->title
            ]
        ];
    }
    
}
