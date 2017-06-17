<?php 

/*
 * 
 * Simple router
 */

class Route 
{
    static function ErrorPage404() 
    {        
        header("HTTP/1.1 404 Not Found");
        
        require_once (ROOT.'templates/layout/404.php');
        exit();
    }
    
    
    static function start() 
    {   
        if(!ShopEngine::AllowControllers()) {
            Route::ErrorPage404();
        }
        // Redirect
            ShopEngine::Help()->IndexRedirect();
        //
        
        // Getting names of model, controller, action
        $controller_name = ShopEngine::GetController();
        $model_name      = ShopEngine::GetModel();
        $action          = ShopEngine::GetAction(true);
        $option          = ShopEngine::GetOption();
        
        // Это не очень изящное решение, но я придумаю позже что-нибудь
        if($controller_name === 'Controller_Ajax') {
            return require_once ENGINE.'ajax/ajax.php';
        }
        //

        //files
        $model_file = strtolower($model_name.'.php');
        $model_path = ENGINE.'models/'.$model_file;
        if (file_exists($model_path)) {
            require_once($model_path);
        }
        $controller_file = $controller_name.'.php';
        $controller_path = ENGINE.'controllers/'.$controller_file;
        
        file_exists($controller_path) ? require_once($controller_path) : Route::ErrorPage404();
         
        $controller = new $controller_name;
        
        if($controller->type() === 'gen' AND method_exists($controller, 'Action_Basic')) 
        {
                
            return $controller->Action_Basic();
  
        }
        elseif($controller->type() === 'act' AND method_exists($controller, $action)) 
        {
                
            return $controller->$action();
            
        }
        elseif($controller->type() === 'act+') 
        {
            if(method_exists($controller, $option)) 
            {
                
                return $controller->$option();
                
            }
            elseif(method_exists($controller, $action)) 
            {

                $controller->$action();

            }
                            
        } 
        
        return Route::ErrorPage404();
        //Request::EraseErrorSession();
    }
    
}
