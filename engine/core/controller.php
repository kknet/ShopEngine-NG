<?php

class Controller 
{
    protected static $array = NULL;
    protected static $model = NULL;
    protected static $name  = NULL;
    
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
            $catalog = 'site-nav--active';
        }
        elseif ($route[1] === 'section') {
            
            switch ($route[2]) {
                case 'children':
                    $children = 'site-nav--active';    
                    break;
                case 'dentist':
                    $dentist = 'site-nav--active';
                    break;
                default:
                    break;
            }
            
        }
        
        return [
            'catalog'  => $catalog,
            'children' => $children,
            'dentist'  => $dentist
        ];
    }
    
}