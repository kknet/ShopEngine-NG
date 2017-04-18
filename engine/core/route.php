<?php 

/*
 * 
 * Роутер. Спасибо сайту Хабрахабр
 */

class Route 
{
    
    private static $controller = NULL;
    
    static function start() 
    {
        
        if(!ShopEngine::AllowControllers()) {
            ShopEngine::Help()->StrongRedirect('catalog', 'all');
        }
        // Редиректим со старых адресов
            ShopEngine::Help()->IndexRedirect();
        //
        
        // Получаем названия контроллера, модели
        $controller_name = ShopEngine::GetController();
        $model_name = ShopEngine::GetModel();
        $action = ShopEngine::GetAction();
        $option = ShopEngine::GetOption();
        
        // Это не очень изящное решение, но я придумаю позже что-нибудь
        if($controller_name === 'Controller_Ajax') {
            return require_once 'engine/ajax/ajax.php';
        }
        //

        //files
        $model_file = strtolower($model_name.'.php');
        $model_path = 'engine/models/'.$model_file;
        if (file_exists($model_path)) {
            include($model_path);
        }
        $controller_file = $controller_name.'.php';
        $controller_path = 'engine/controllers/'.$controller_file;
        if (file_exists($controller_path)) {
            include($controller_path); 
            $controller = new $controller_name;
            if($controller->type() === 'gen') {
                $start = $controller->start();
            }
            elseif($controller->type() === 'act') {
                if(method_exists($controller, $action)) {
                    $start = $controller->$action();
                }
                else {
                    return Route::ErrorPage404();
                }
            }
            elseif($controller->type() === 'act+') {
                if(method_exists($controller, $option)) {
                    $start = $controller->$option();
                }
                else {
                    if(method_exists($controller, $action)) {
                        $start = $controller->$action();
                    }
                    else {
                        return Route::ErrorPage404();
                    }
                }
                        
            }
            
        }
        else {
                Route::ErrorPage404();
        }
        
        // Include view 
        $view_name = ShopEngine::GetController()::SetView();
        //
        
        $view_file = $view_name.'.php';
        $view_path = 'engine/views/'.$view_file;
        if (file_exists($view_path)) {
            $layout = $controller->SetLayout();
            $layout = $layout.'.php';
            require_once 'template/layout/'.$layout;
        }
        else {
            Route::ErrorPage404();
        }

        //$controller = new $controller_name;
        //$action = $action_name;
        Request::EraseErrorSession();
    }

    static function ErrorPage404() 
    {
        // Ошибка 404, пока не работает
        //$host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header( 'Location: /main/', true, 301 );
    }
    
}
