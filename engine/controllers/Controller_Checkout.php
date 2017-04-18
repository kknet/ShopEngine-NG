<?php

class Controller_Checkout extends Controller{
    
    protected static $data;
    protected static $order_pr;
    protected static $price     = null;
    protected static $pre_price = null;
    public    static $errors    = null;
    public    static $shippers;
    
    public function type()
    {
        return 'act';
    }

    public function step1()
    {
        $ip = ShopEngine::GetUserIp();
        $sql = "SELECT * FROM order_products WHERE orders_ip=? AND orders_status='0'";
        if(!Getter::GetFreeData($sql, [$ip]))
        {
            Route::ErrorPage404();   
        }
        
        if(Request::Post('checkout_step1')) 
        {
            
            $csrf = Request::Post('csrf');
            if(!ShopEngine::Help()->ValidateToken($csrf))
            {
                return false;
            }

            self::$errors = Controller::GetModel()->ValidateStep1();
            
            if(!self::$errors) {
                Request::SetSession('step1', true);
                return ShopEngine::Help()->StrongRedirect('checkout', 'step2');
            }
            $errors = self::$errors;

        }
        
        if(Request::GetSession('user_is_logged'))
        {
            $id  = Request::GetSession('user_id');
            $sql = "SELECT * FROM user_addresses a "
                 . "RIGHT OUTER JOIN countries co ON a.address_country = co.country_handle "
                 . "RIGHT OUTER JOIN region r ON a.address_region = r.region_handle "
                 . "WHERE address_user=?";
            $addresses = Getter::GetFreeData($sql, [$id], false);
        }
        
        return [
            'errors' => $errors,
            'addresses' => $addresses
        ];
    }
    
    public function step2()
    {
        if(Request::Post('checkout_step2')) 
        {
            $csrf = Request::Post('csrf');
            if(!ShopEngine::Help()->ValidateToken($csrf))
            {
                return false;
            }
            
            // Shipping price and type
            
            $ship_id = Request::Post('checkout_ship_id');
            $sql = "SELECT shipper_type, shipper_price FROM shipper WHERE shipper_id=?";
            $array = Getter::GetFreeData($sql, [$ship_id]);
            Request::SetSession('shipper_name', $array['shipper_type']);
            Request::SetSession('shipper_price', $array['shipper_price']);
            
            // Full Price
            $full = self::GetCheckoutPrice();
            Request::SetSession('full_price', $full + $array['shipper_price']);
            //
            
            Request::SetSession('step2', true);
            return ShopEngine::Help()->StrongRedirect('checkout', 'step3');
        }

        if(!Request::GetSession('step1')) 
        {
            return ShopEngine::Help()->StrongRedirect('checkout', 'step1');
        }
        $city = Request::GetSession('checkout_region');
        $sql = "SELECT r.region_shipper, s.shipper_id, r.region_name, s.shipper_type, s.shipper_price FROM region_ship r RIGHT JOIN shipper s ON r.region_shipper = s.shipper_id WHERE region_handle=?";

        return Getter::GetFreeData($sql, [$city]);
    }
    
    public function step3()
    {
        if(!Request::GetSession('step2')) 
        {
            return ShopEngine::Help()->StrongRedirect('checkout', 'step2');
        }
        
        $price = self::GetPreFinalPrice();
        $shipp = Request::GetSession('shipper_price');
        Request::SetSession('full_price', $price + $shipp);
        
        if(Request::Post('checkout_step3'))
        {
            $csrf = Request::Post('csrf');
            if(!ShopEngine::Help()->ValidateToken($csrf))
            {
                return false;
            }
            
            self::$errors = Controller::GetModel()->ValidateStep3();
            if(!self::$errors)
            {
                $price = Self::GetCheckoutPrice();
                if($key = Controller::GetModel()->FinishCheckout($price))
                {   
                    //Mailer returns strings
                    return ShopEngine::Help()->StrongRedirect('checkout', 'thank_you?orderid='.$key); 
                }
            }
            return self::$errors;
        }
        
    }
    
    public function thank_you()
    {
        $key = ShopEngine::Help()->Clear($_GET['orderid']);
        if(!$key) {
            return ShopEngine::Help()->StrongRedirect('checkout', 'step3'); 
        }
        $sql = "SELECT * FROM orders o RIGHT JOIN payment p ON o.orders_payment = p.payment_id WHERE orders_key=? AND orders_ip=? AND orders_status='1'";
        $array = Getter::GetFreeData($sql, [$key, ShopEngine::GetUserIp()]);
        if(count($array) < 1)
        {
            return ShopEngine::Help()->StrongRedirect('checkout', 'step3'); 
        }
        return $array;
    }
    
    public static function GetErrors()
    {
        return self::$errors;
    }
    
    public static function GetOrderProducts()
    {
        if(self::$order_pr === null) {
            $id = Request::GetSession('last_order_id');
            $ip = ShopEngine::GetUserIp();
            $sql = "SELECT o.products_handle, o.orders_price, o.orders_count, p.handle, p.title, p.image, p.category_id, c.name FROM order_products o "
                    . "RIGHT JOIN products p ON o.products_handle = p.handle AND p.title <> ''"
                    . "RIGHT JOIN category c ON p.category_id = c.category_id "
                    . "WHERE orders_ip=? AND orders_final_id=?";
            self::$order_pr = Getter::GetFreeData($sql, [$ip, $id], false);
            if(!self::$order_pr) {
                return Route::ErrorPage404();
            }
        }
        return self::$order_pr;
    }
    
    public static function GetData()
    {
        if(self::$data === null) {
            $ip = ShopEngine::GetUserIp();
            $sql = "SELECT o.products_handle, o.orders_price, o.orders_count, p.handle, p.title, p.image, p.category_id, c.name FROM order_products o "
                    . "RIGHT JOIN products p ON o.products_handle = p.handle AND p.title <> ''"
                    . "RIGHT JOIN category c ON p.category_id = c.category_id "
                    . "WHERE orders_ip=? AND orders_status='0'";
            self::$data = Getter::GetFreeData($sql, [$ip], false);
            if(!self::$data) {
                //return Route::ErrorPage404();
            }
        }
        return self::$data;
    }
    
    public static function SetView() {
        
        $action = ShopEngine::GetAction();
        switch ($action) {
            case 'step1':
                return 'View_Checkout_Step1';
                break;
            case 'step2':
                return 'View_Checkout_Step2';
                break;
            case 'step3':
                return 'View_Checkout_Step3';
                break;
            case 'thank_you':
                return 'View_Checkout_Final';
                break;
            default:
                return Route::ErrorPage404();
                break;
        }
        
    }
    
    public static function GetCountry()
    {
        $country = Request::GetSession('checkout_country');
        $sql = "SELECT country_name FROM countries WHERE country_handle=?";
        return Getter::GetFreeData($sql, [$country])['country_name'] !== NULL ? Getter::GetFreeData($sql, [$country])['country_name'] : $country;
    }
    
    public static function GetRegion()
    {
        $region = Request::GetSession('checkout_region');
        $sql = "SELECT region_name FROM region WHERE region_handle=?";
        return Getter::GetFreeData($sql, [$region])['region_name'] !== NULL ? Getter::GetFreeData($sql, [$region])['region_name'] : $region;
    }
    
    public static function SetLayout()
    {
        return 'checkout';
    }
    
    public static function GetPreFinalPrice()
    {
        if(Self::$pre_price === null) {
            $array = self::GetData();
            foreach ($array as $cur) {
                Self::$pre_price = Self::$pre_price + $cur['orders_price'];
            }
            if(Request::GetSession('checkout_points_enabled')) { 
                Self::$pre_price = ShopEngine::Business()->UsePoints(Self::$pre_price);
            }
        }
        return Self::$pre_price;
    }
    
    public static function GetCheckoutPrice()
    {
        if(Self::$price === null) {
            $array = self::GetData();
            foreach ($array as $cur) {
                Self::$price = Self::$price + $cur['orders_price'];
            }
        }
        return Self::$price;
    }
    
    public static function GetFinalPrice()
    {
        if(Self::$price === null) {
            $array = self::GetOrderProducts();
            foreach ($array as $cur) {
                Self::$price = Self::$price + $cur['orders_price'];
            }
            if(Request::GetSession('checkout_points_enabled')) { 
                Self::$price = ShopEngine::Business()->UsePoints(Self::$price);
            }
        }
        return Self::$price;
    }
    
}
