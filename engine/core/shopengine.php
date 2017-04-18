<?php

/*
 * 
 * Все служебные функции здесь
 */


class ShopEngine {
    
    protected static $info       = NULL;
    protected static $controller = NULL;
    protected static $model      = NULL;
    protected static $view       = NULL;
    protected static $help       = NULL;
    protected static $route      = NULL;
    protected static $act        = NULL;
    protected static $ip         = NULL;
    
    protected static $query      = NULL;
    protected static $sort       = NULL;
    protected static $qsort      = NULL;
    protected static $page       = NULL;
    protected static $main       = NULL;
    protected static $total;
    public static $sql;
    public static $params;
    
    // Получить информацию
    public static function GetInformation()
    {
        $db = database::getInstance();
        
        if(Self::$info === NULL)
        {
            Self::$info = $db->query("SELECT name,value FROM info")->fetchAll(PDO::FETCH_KEY_PAIR);
        }
        return Self::$info;
    }
    
    // Получить маршрут
    public static function GetRoute()
    {
        if(Self::$route === NULL)
        {                 
            Self::$route = explode('/', $_SERVER['REQUEST_URI']);
        }
        
        for($i = 0; $i < count(Self::$route); $i++) {
            Self::$route[$i] = ShopEngine::Help()->Clear(Self::$route[$i]);
        }
        
        return Self::$route;
    }
    
    public static function GetHost()
    {
        return Config::$config['protocol'].$_SERVER['HTTP_HOST'];
    }

    // Получить контроллер
    public static function GetController()
    {
        
        if(Self::$controller === NULL)
        {
            $routes = ShopEngine::GetRoute();

            if(!empty($routes[1])) 
            {
                Self::$controller = 'Controller_'.ucfirst(ShopEngine::Help()->Clear($routes[1]));
            }
            else 
            {
                Self::$controller = 'Controller_Main';
            }
        }
        return Self::$controller;
    }
    
    // Получить модель
    public static function GetModel()
    {
        if(Self::$model === NULL)
        {
            $routes = ShopEngine::GetRoute();

            if(!empty($routes[1])) 
            {
                Self::$model = 'Model_'.ucfirst(ShopEngine::Help()->Clear($routes[1]));
            }
            else 
            {
                Self::$model = 'Model_Main';
            }
        }
        return Self::$model;
    }
    
    // Получить вид
    public static function GetView()
    {
        if(Self::$view === NULL)
        {
            $routes = ShopEngine::GetRoute();

            if(!empty($routes[1])) 
            {
                Self::$view = 'View_'.ucfirst(ShopEngine::Help()->Clear($routes[1]));
            }
            else 
            {
                Self::$view = 'View_Main';
            }
        }
        return Self::$view;
    }
    
    public static function GetAction()
    {
        if(Self::$act === NULL)
        {
            $routes = ShopEngine::GetRoute();

            if(!empty($routes[2])) 
            {
                $get = strpos($routes[2], '?');
                if(!$get) {
                    Self::$act = ShopEngine::Help()->Clear($routes[2]);
                } else {
                    Self::$act = ShopEngine::Help()->Clear(substr($routes[2], 0, $get));
                }
            }
            else 
            {
                Self::$act = NULL;
            }
        }
        return Self::$act;
    }
    
    public static function GetUserIp()
    {
        if(Self::$ip === NULL) 
        {
            Self::$ip = ShopEngine::Help()->Clear($_SERVER['REMOTE_ADDR']);
        }
        return Self::$ip;
    }
    
    public static function LoadComponents()
    {
        $array = Config::$config['components'];
        foreach ($array as $comp) {
            $comp_name = strtolower($comp.'.php');
            require_once 'engine/components/'.$comp_name;
        }
    }
    
    // Вспомогательные методы
    public static function Help()
    {
        if(Self::$help === NULL)
        {
            require_once 'engine/components/help.php';
            Self::$help = new Help();
        }
        return Self::$help;
    }
    
    public static function AllowControllers() {
        $cons = Config::$config['allowed_controllers'];
        $con  = ShopEngine::GetRoute()[1];
        return in_array($con, $cons);
    }
    
    public static function ExceptionToFile($ex)
    {
        if(is_string($ex)) {
            $text = "( ".date('Y-m-d H:i:s (T)')." ) Выброшено исключение: ".$ex."\r\n";
        } else {
            $text = "( ".date('Y-m-d H:i:s (T)')." ) Выброшено исключение: ".$ex->getMessage()."\r\n";
        }
        $err = fopen('engine/errlog.txt', 'a');
        fwrite($err, $text);
        fclose($err);
    }
    
}
