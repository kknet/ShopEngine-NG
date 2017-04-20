<?php

class Controller_Cart extends Controller
{
    
    public function start() 
    {
        
        if(Request::Post('checkout')) {
            
            $csrf = Request::Post('csrf');
            if(!ShopEngine::Help()->ValidateToken($csrf))
            {
                return false;
            }
            
            $ip = ShopEngine::GetUserIp();
            
            if(Controller::GetModel()->PrepareCheckout($ip)) 
            {
               return ShopEngine::Help()->StrongRedirect('checkout', 'step1');
            }
            else {
                return Route::ErrorPage404();
            }
            
        }
    }
    
    public static function GetData()
    {
        $ip = ShopEngine::GetUserIp();
        $sql = "SELECT c.cart_id, c.cart_price, c.cart_count, p.brand, p.title, p.price, p.handle, p.image FROM cart c RIGHT JOIN products p ON c.products_handle = p.handle AND p.title <> '' WHERE cart_ip=?";
        $array = Getter::GetFreeData($sql, [$ip], false);
        if(count($array) < 1) {
            return Route::ErrorPage404();
        }
        return $array;
    }
    
    public static function GetSum()
    {
        $ip = ShopEngine::GetUserIp();
        $sql = "SELECT cart_count, cart_price FROM cart WHERE cart_ip=?";
        $array = Getter::GetFreeData($sql, [$ip], false);
        $sum = 0;
        foreach ($array as $cur) {
            $sum = $sum + $cur['cart_price'];
        }
        return ShopEngine::Help()->AsPrice($sum);
    }
}
