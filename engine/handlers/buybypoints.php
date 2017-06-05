<?php

class buybypoints {
    
    public function start()
    {
        if ($_SERVER["REQUEST_METHOD"] != "POST") {
            return false;
        }
        
        $ip = ShopEngine::GetUserIp();
        
        $csrf  = ShopEngine::Help()->Clear($_POST['csrf']);
        
        if(!ShopEngine::Help()->ValidateToken($csrf))
        {
            return false;
        }
        
        Request::SetSession('checkout_points_enabled', true);
        
        $products = $this->GetProducts($ip);
        
        $price    = $this->GetProductsPrice($products, true);
        
        $price['final'] = ShopEngine::Help()->AsPrice($price['final']);
        $price['delta'] = '-'.ShopEngine::Help()->AsPrice($price['delta']);
        
        return json_encode($price, JSON_UNESCAPED_UNICODE);
    }
    
    public function GetProducts($ip)
    {
        
        $ip = ShopEngine::GetUserIp();
        $sql = "SELECT o.products_handle, o.orders_price, o.orders_count, p.handle, p.title, p.image, p.category_id, p.price, c.name FROM order_products o "
                . "RIGHT JOIN products p ON o.products_handle = p.handle AND p.title <> ''"
                . "RIGHT JOIN category c ON p.category_id = c.category_id "
                . "WHERE orders_ip=? AND orders_status='0'";
        $array = Getter::GetFreeData($sql, [$ip], false);
        if(!$array)
        {
            return false;
        }
        
        return $array;
        
    }
    
    public function GetProductsPrice($products, $setpoints = false)
    {
        
        $pre_price = null;
        if($products) { 
            foreach ($products as $cur) {
                $pre_price = $pre_price + $cur['orders_price'];
            }
        }
        if(Request::GetSession('checkout_points_enabled') AND $setpoints === true) { 
            $pre_price = ShopEngine::Business()->UsePoints($pre_price);
        }
        
        return $pre_price;
        
    }
    
}
