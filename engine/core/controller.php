<?php

class Controller 
{
    protected static $array = NULL;
    protected static $model = NULL;
    protected static $name  = NULL;
    public static $children;
    public static $dentist;
    public static $catalog;
    
    public function __construct() 
    {
        //This method from Habrahabr.ru
        
        //Registering Errors
        set_error_handler(array($this, 'ErrorCatcher'));
        
        //Catch fatal errors
        register_shutdown_function(array($this, 'FatalErrorCatcher'));
        
        ob_start();
        
    }
    
    public function ErrorCatcher($errno, $errstr, $errfile, $errline)
    {
        ShopEngine::SetException($errstr, $errfile, $errline);
        return false;
    }
    
    public function FatalErrorCatcher()
    {
        $error = error_get_last();
        if ($error !== null)
        { 
            if($error['type'] == E_ERROR
                    || $error['type'] == E_PARSE
                    || $error['type'] == E_COMPILE_ERROR
                    || $error['type'] == E_CORE_ERROR)
            {
                    ob_end_clean();	// сбросить буфер, завершить работу буфера

                    // контроль критических ошибок:
                    // - записать в лог
                    // - вернуть заголовок 500
                    // - вернуть после заголовка данные для пользователя
                    
                    //Temporary
                    ShopEngine::FatalException($error);
                    header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
                    return ShopEngine::Help()->Regularredirect('errorpage', 'site');
            }
            else
            {
                    ob_end_flush();	// вывод буфера, завершить работу буфера
            }
        }
            else
            {
                    ob_end_flush();	// вывод буфера, завершить работу буфера
            }
    }
    
    
    public function type()
    {
        return 'gen';
    }

    protected static function GetModel()
    {
        if(Controller::$model === NULL)
        {
            $model_name = ShopEngine::GetModel();
            Controller::$model = new $model_name();
        }
        return Controller::$model;
    }
    
    public static function SetLayout()
    {
        return 'main';
    }
    
    public static function SetView()
    {
        return ShopEngine::GetView();
    }
    
    public static function GetMenuProducts()
    {
        $sql = "SELECT * FROM products WHERE avail='1' LIMIT 3";
        return Getter::GetFreeProducts($sql);
    }

    public static function PageName()
    {
        return 'Главная';
    }
    
    public static function SEO()
    {
        return [
            
        ];
    }
    
    public static function GetMenu()
    {
        $sql = "SELECT * FROM category WHERE main='1'";
        return Getter::GetFreeData($sql);
    }
    
    public function start()
    {
        // some...
    }
    
    public static function IsActive()
    {
        $route = ShopEngine::GetRoute();
        
        if($route[1] === 'catalog')
        {
            Self::$catalog = 'site-nav--active';
        }
        elseif ($route[1] === 'section') {
            
            switch ($route[2]) {
                case 'children':
                    Self::$children = 'site-nav--active';    
                    break;
                case 'dentist':
                    Self::$dentist = 'site-nav--active';
                    break;
                default:
                    break;
            }
            
        }
        
        return [
            'catalog'  => Self::$catalog,
            'children' => Self::$children,
            'dentist'  => Self::$dentist
        ];
    }
    
}