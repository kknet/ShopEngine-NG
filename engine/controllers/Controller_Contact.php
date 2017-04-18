<?php

class Controller_Contact extends Controller{
    
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
    
}