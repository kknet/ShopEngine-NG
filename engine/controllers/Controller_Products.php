<?php

class Controller_Products extends Controller{
   
    public $products;
    
    public function Action_Basic()
    {
        $id = ShopEngine::GetRoute()[2];
        $sql = "SELECT * FROM products WHERE handle=? AND avail='1'";
        $this->products = Getter::GetFreeProducts($sql, [$id]);  
        
        if(!$this->products)
        {
            return Route::ErrorPage404();
        }
        
        $this->GetModel()->UpdateCount($this->products);
        
        $this->title = $this->products['title'];
        
        return $this->view->render(ShopEngine::GetView(), [
            'product' => $this->products
        ]);
    }
    
    public function GetLink()
    {
        $route = ShopEngine::GetRoute();
        return '/'.$route[1].'/'.$route[2];
    }
    
    public function SEO()
    {
        $product = $this->products;
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
