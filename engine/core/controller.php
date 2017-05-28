<?php

class Controller 
{
    protected static $array = NULL;
    protected $model = NULL;
    protected static $name  = NULL;
    public static $children;
    public static $dentist;
    public static $catalog;
    public $view;
    public $layout = "main";
    
    public function __construct() 
    {
        $this->view = new View($this);
        $this->title = Config::$config['site_name'];
    }
    
    public function type()
    {
        return 'gen';
    }

    protected function GetModel()
    {
        return ShopEngine::GetModel()::getInstance();
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
    
    public function SEO()
    {
        return [
            'name' => [
                'description' => 'Добро пожаловать в интернет-магазин &quot;Потерпите, пожалуйста!&quot;'
            ]
        ];
    }
    
    public static function GetMenu()
    {
        return false;
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
    
    public function GetPagination()
    {
        return $this->GetModel()->GetPagination();
    }
    
}