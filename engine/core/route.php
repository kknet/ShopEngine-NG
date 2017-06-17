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
            
        //Modules have priority
        define(MVC_PATH, ShopEngine::ModuleCheck());
        
        // Getting names of model, controller, action
        $controller_name = ShopEngine::GetController();
        $model_name      = ShopEngine::GetModel();
        $action          = ShopEngine::GetAction(true);
        $option          = ShopEngine::GetOption();
        
        // AJAX handlers
        if($controller_name === 'Controller_Ajax') {
            return require_once ENGINE.'ajax/ajax.php';
        }

        //files
        $model_file = strtolower($model_name.'.php');
        $model_path = MVC_PATH . 'models/'.$model_file;
        if (file_exists($model_path)) {
            require_once($model_path);
        }
        $controller_file = $controller_name.'.php';
        $controller_path = MVC_PATH . 'controllers/'.$controller_file;
        
        file_exists($controller_path) ? require_once($controller_path) : Route::ErrorPage404();
         
        $controller = new $controller_name;
        
        //Basic type of controller. Starting basic action...
        if($controller->type() === 'gen' AND method_exists($controller, 'Action_Basic')) 
        {
                
            return $controller->Action_Basic();
  
        }
        
        //Extended type of controller. You can create actions
        elseif($controller->type() === 'act' AND method_exists($controller, $action)) 
        {
                
            return $controller->$action();
            
        }
        
        //Extended+. You can create actions and options
        elseif($controller->type() === 'act+') 
        {
            //If option exsists
            if(method_exists($controller, $option)) 
            {
                
                return $controller->$option();
                
            }
            
            //Standart procedure
            elseif(method_exists($controller, $action)) 
            {

                $controller->$action();

            }
                            
        } 
        
        return Route::ErrorPage404();
        //Request::EraseErrorSession();
    }
    
}
