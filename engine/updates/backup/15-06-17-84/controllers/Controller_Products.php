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
        
        $gallery = Getter::GetFreeData("SELECT * FROM additional_images WHERE products_id = ?", [$this->products['products_id']], false);
        
        return $this->view->render(ShopEngine::GetView(), [
            'product' => $this->products,
            'gallery' => $gallery
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
        
        $widht  = null;
        $height = null;
        
        $imagine = new \Imagine\Gd\Imagine;
        
        if(file_exists($product['image_lnk']))
        {
            $size    = $imagine->open($product['image_lnk'])->getSize();
        
            $width  = $size->getWidth();
            $height = $size->getHeight();
        }
        
        return [
            'property' => [
                'og:type'  => 'product',
                'og:title' => $product['title'],
                'og:image' => ShopEngine::GetHost().'/'.$product['image_lnk'],
                'og:image:width' => $width,
                'og:image:height' => $height,
//                'og:image:secure_url' => ShopEngine::GetHost().'/'.$product['image_lnk'],
                'og:description' => ShopEngine::Help()->Clear($product['description'].'<br>Цена: '.ShopEngine::Help()->AsPrice($product['price_int'])),
                'og:price:amount' => $product['price_int'],
                'og:price:currency' => 'RUB',
                'og:url' => ShopEngine::GetHost().$_SERVER['REQUEST_URI'],
                'og:site_name' => Config::$config['site_name'],
                'fb:app_id' => 220746618429343
            ],
            'name'     => [
                'keywords' => 'none',
                'description' => 'Купить &lt;em&gt;'.$product['title'].'&lt;em&gt;: цена '.ShopEngine::Help()->AsPrice($product['price_int']).'; Продажа с доставкой по Москве и другим городам.',
                'twitter:site' => '@poterpite',
                'twitter:card' => 'summary',
                'twitter:title' => $product['title'],
                'twitter:description' => ShopEngine::Help()->Clear($product['description'].'<br>Цена: '.ShopEngine::Help()->AsPrice($product['price_int'])),
                'twitter:image' => ShopEngine::GetHost().'/'.$product['image_lnk'],
                'twitter:image:width' => '480',
                'twitter:image:height' => '480'
            ]
        ];
    }
}
