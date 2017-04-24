<?php
/*
 * This is Checkout Controller. 
 * At this step we need to:
 * 1. Get products from cart;
 * 2. Get contact information and payment method from user;
 * 3. Calculate full price;
 * 4. Set all information to database and generate page with information;
 */

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
        /*
         * 
         *    First step
         * 1. Getting information about products in cart;
         * 2. Getting information from user (address, phone etc.);
         * 3. Entering all information into session;
         */
        
        $ip = ShopEngine::GetUserIp();
        $sql = "SELECT * FROM order_products WHERE orders_ip=? AND orders_status='0'";
        //If we have no products in cart
        $array = Getter::GetFreeData($sql, [$ip]);
        if(!$array)
        {
            return ShopEngine::Help()->RegularRedirect('catalog', 'all');  
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
                Request::SetSession('checkout_complete_step1', true);
                return ShopEngine::Help()->StrongRedirect('checkout', 'step2');
            }
        }
        
        //If user is logged we have to get all contact information about him
        if(Request::GetSession('user_is_logged'))
        {
            $id  = Request::GetSession('user_id');
            $sql = "SELECT * FROM user_addresses a "
                 . "RIGHT OUTER JOIN countries co ON a.address_country = co.country_handle "
                 . "RIGHT OUTER JOIN region r ON a.address_region = r.region_handle "
                 . "WHERE address_user=?";
            $addresses = Getter::GetFreeData($sql, [$id], false);
        } else {
            $addresses = null;
        }
        
        return [
            'errors' => self::$errors,
            'addresses' => $addresses
        ];
    }
    
    public function step2()
    {
        /* 
         * Second step
         * 1. Get information about delivery method in selected place;
         * 2. Show this information to user;
         * 3. Get new information from user;
         * 4. Recalculate price;
         */
        if(Request::Post('checkout_step2')) 
        {
            $csrf = Request::Post('csrf');
            if(!ShopEngine::Help()->ValidateToken($csrf))
            {
                return false;
            }
            
            // Shipping price and type
            
            Controller::GetModel()->SetShipper();
            
            // Full Price
            $full = self::GetCheckoutPrice();
            Request::SetSession('full_price', $full + Request::GetSession('shipper_price'));
            //
            
            Request::SetSession('checkout_complete_step2', true);
            return ShopEngine::Help()->StrongRedirect('checkout', 'step3');
        }
        
        if(!Request::GetSession('checkout_complete_step1')) 
        {
            return ShopEngine::Help()->StrongRedirect('checkout', 'step1');
        }
        $city = Request::GetSession('checkout_region');
        $sql = "SELECT r.region_shipper, s.shipper_id, r.region_name, s.shipper_type, s.shipper_price FROM region_ship r RIGHT JOIN shipper s ON r.region_shipper = s.shipper_id WHERE region_handle=?";

        return Getter::GetFreeData($sql, [$city]);
    }
    
    public function step3()
    {
        /*
         * 
         * Pre final step
         * 1. Show information about payment methods;
         * 2. Get method from user;
         * 3. If user wants to use his poits to pay, recalculate full price and amount of points;
         */
        
        if(!Request::GetSession('checkout_complete_step2')) 
        {
            return ShopEngine::Help()->StrongRedirect('checkout', 'step2');
        }
        
        $price = self::GetPreFinalPrice();
        if(is_array($price))
        {   
            $price = $price['final'];
        } 
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
                else {
                    $post = Request::Post();
                    return ShopEngine::Help()->StrongRedirect('errorpage', 'checkout?checkoutip='.ShopEngine::GetUserIp()); 
                }
            }
            return self::$errors;
        }
        
    }
    
    public function thank_you()
    {
        /*
         * 
         * Final step
         * 1. Show full information about purchase;
         * 2. Generate link to this page;
         * 3. Generate bill for payment;
         */
        $key = Request::Get('orderid');
        if(!$key) {
            return ShopEngine::Help()->RegularRedirect('checkout', 'step3'); 
        }
        $sql = "SELECT * FROM orders o RIGHT JOIN payment p ON o.orders_payment = p.payment_id WHERE orders_key=? AND orders_status='1'";
        $array = Getter::GetFreeData($sql, [$key]);
        if(count($array) < 1)
        {
            return ShopEngine::Help()->StrongRedirect('checkout', 'step3'); 
        }
        $products = Controller_Checkout::GetOrderProducts($array['orders_id']);
        $final    = Controller_Checkout::GetFinalPrice($array['orders_id']);
        return [
            'info'     => $array,
            'products' => $products,
            'final'    => $final
        ];
    }
    
    public function download()
    {
        $key = Request::Get('orderid');
        if(!$key) {
            return ShopEngine::Help()->RegularRedirect('checkout', 'thank_you'); 
        }
        
        $sql   = "SELECT * FROM orders_documents WHERE orders_key=?";
        $array = Getter::GetFreeData($sql, [$key], true);
        if(count($array) < 1)
        {
            return ShopEngine::Help()->RegularRedirect('checkout', 'thank_you'); 
        }
        return ShopEngine::Help()->ForcedDownload($array['document_file']);
    }
    
    public static function GetErrors()
    {
        return self::$errors;
    }
    
    public static function GetOrderProducts($id)
    {
        if(self::$order_pr === null) {
            $ip = ShopEngine::GetUserIp();
            $sql = "SELECT o.products_handle, o.orders_price, o.orders_count, p.handle, p.title, p.image, p.category_id, p.price, c.name FROM order_products o "
                    . "RIGHT JOIN products p ON o.products_handle = p.handle AND p.title <> ''"
                    . "RIGHT JOIN category c ON p.category_id = c.category_id "
                    . "WHERE orders_final_id=?";
            self::$order_pr = Getter::GetFreeData($sql, [$id], false);
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
            $sql = "SELECT o.products_handle, o.orders_price, o.orders_count, p.handle, p.title, p.image, p.category_id, p.price, c.name FROM order_products o "
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
            case 'step2':
                return 'View_Checkout_Step2';
            case 'step3':
                return 'View_Checkout_Step3';
            case 'thank_you':
                return 'View_Checkout_Final';
            case 'download':
                return 'View_Checkout_Download';
            default:
                return Route::ErrorPage404();
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
            if($array) { 
                foreach ($array as $cur) {
                    Self::$pre_price = Self::$pre_price + $cur['orders_price'];
                }
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
            if($array) { 
                foreach ($array as $cur) {
                    Self::$price = Self::$price + $cur['orders_price'];
                }
            }
        }
        return Self::$price;
    }
    
    public static function GetFinalPrice($id)
    {
        if(Self::$price === null) {
            $array = self::GetOrderProducts($id);
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
