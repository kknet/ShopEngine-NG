<?php

class Controller_Pages extends Controller{
    
    public $errors;
    
    public function start()
    {
        if(Request::Post('contact'))
        {
            $csrf = Request::Post('csrf');
            if(!ShopEngine::Help()->ValidateToken($csrf))
            {
                return false;
            }
            
            $this->errors = Controller::GetModel()->Validate();
            if(!$this->errors) {
                
                if(!Controller::GetModel()->Feedback()) 
                {
                    return false;
                }
                
                Request::SetSession('contact_message', 'success');
                
            } else {
                Request::SetSession('contact_message', 'error');
            }
            
            return ShopEngine::Help()->StrongRedirect('pages', 'contact');
            
        }
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
    
}
