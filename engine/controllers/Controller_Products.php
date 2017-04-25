<?php

class Controller_Products extends Controller{
   
    private static $data;
    
    public function start()
    {
        $id = ShopEngine::GetRoute()[2];
        $sql = "SELECT * FROM products WHERE handle=? AND avail='1'";
        if(!Getter::GetFreeData($sql, [$id]))
        {
            return Route::ErrorPage404();
        }
    }
    public static function GetData()
    {
        if(self::$data === NULL) {
            $id = ShopEngine::GetRoute()[2];
            $sql = "SELECT * FROM products WHERE handle=? AND avail='1'";
            self::$data = Getter::GetFreeProducts($sql, [$id]);  
            
            Controller::GetModel()->UpdateCount(self::$data);
        }
        if(!self::$data) {
            //return Route::ErrorPage404();
        }
        return self::$data;
    }
    
    public function GetLink()
    {
        $route = ShopEngine::GetRoute();
        return '/'.$route[1].'/'.$route[2];
    }
    
    public static function SEO()
    {
        $product = Self::GetData();
        return [
            'property' => [
                'og:type'  => 'product',
                'og:title' => $product['title'],
                'og:image' => ShopEngine::GetHost().'/'.$product['image_lnk'],
                'og:image:secure_url' => ShopEngine::GetHost().'/'.$product['image_lnk'],
                'og:description' => ShopEngine::Help()->Clear($product['description']),
                'og:price:amount' => $product['price_int'],
                'og:price:currency' => 'RUB',
                'og:url' => ShopEngine::GetHost().$_SERVER['REQUEST_URI'],
                'og:site_name' => Config::$config['site_name']
            ],
            'name'     => [
                'keywords' => 'none',
                'description' => 'none',
                'twitter:site' => '@poterpite',
                'twitter:card' => 'summary',
                'twitter:title' => $product['title'],
                'twitter:description' => ShopEngine::Help()->Clear($product['description']),
                'twitter:image' => ShopEngine::GetHost().'/'.$product['image_lnk'],
                'twitter:image:width' => '480',
                'twitter:image:height' => '480'
            ]
        ];
    }
}
