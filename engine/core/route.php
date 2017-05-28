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
        
        require_once (ROOT.'template/layout/404.php');
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
        if (file_exists($controller_path)) {
            require_once($controller_path); 
            $controller = new $controller_name;
            if($controller->type() === 'gen') {
                if(method_exists($controller, 'Action_Basic')) { 
                    $controller->Action_Basic();
                }
                else {
                    return Route::ErrorPage404();
                }
            }
            elseif($controller->type() === 'act') {
                if(method_exists($controller, $action)) {
                    $controller->$action();
                }
                else {
                    return Route::ErrorPage404();
                }
            }
            elseif($controller->type() === 'act+') {
                if(method_exists($controller, $option)) {
                    $controller->$option();
                }
                else {
                    if(method_exists($controller, $action)) {
                        $controller->$action();
                    }
                    else {
                        return Route::ErrorPage404();
                    }
                }          
            } 
        }
        else {
                return Route::ErrorPage404();
        }
        
        //Request::EraseErrorSession();
    }
    
}
