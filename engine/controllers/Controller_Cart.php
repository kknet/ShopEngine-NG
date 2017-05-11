<?php

class Controller_Cart extends Controller
{
    
    public function Action_Basic() 
    {
        $this->title = "Корзина";
        
        if(Request::Post('checkout')) 
        {
            
            $csrf = Request::Post('csrf');
            if(!ShopEngine::Help()->ValidateToken($csrf))
            {
                return false;
            }
            
            $ip = ShopEngine::GetUserIp();
            
            $token = ShopEngine::Help()->generateCheckoutToken();
            
            if(Controller::GetModel()->PrepareCheckout($ip)) 
            {
               return ShopEngine::Help()->StrongRedirect('checkout', 'step1?token='.$token);
            }
            else {
                return Route::ErrorPage404();
            }
            
        }
        
        $ip = ShopEngine::GetUserIp();
        $sql = "SELECT c.cart_id, c.cart_price, c.cart_count, p.brand, p.title, p.price, p.handle, p.image FROM cart c RIGHT JOIN products p ON c.products_handle = p.handle AND p.title <> '' WHERE cart_ip=?";
        $array = Getter::GetFreeData($sql, [$ip], false);
        if(!$array) {
            return ShopEngine::Help()->RegularRedirect('catalog', 'all');
        }
        
        return $this->view->render(ShopEngine::GetView(), [
            'cart' => $array
        ]);
        
    }
    
    public static function GetData()
    {
//        $ip = ShopEngine::GetUserIp();
//        $sql = "SELECT c.cart_id, c.cart_price, c.cart_count, p.brand, p.title, p.price, p.handle, p.image FROM cart c RIGHT JOIN products p ON c.products_handle = p.handle AND p.title <> '' WHERE cart_ip=?";
//        $array = Getter::GetFreeData($sql, [$ip], false);
//        if(!$array) {
//            return Route::ErrorPage404();
//        }
//        return $array;
    }
    
    public static function GetSum()
    {
        $ip = ShopEngine::GetUserIp();
        $sql = "SELECT cart_count, cart_price FROM cart WHERE cart_ip=?";
        $array = Getter::GetFreeData($sql, [$ip], false);
        $sum = 0;
        if(!$array)
        {
            return false;
        }
        foreach ($array as $cur) {
            $sum = $sum + $cur['cart_price'];
        }
        return ShopEngine::Help()->AsPrice($sum);
    }
}
