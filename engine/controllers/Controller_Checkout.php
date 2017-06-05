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
    public    $errors    = null;
    public    static $shippers;
    
    public function type()
    {
        return 'act';
    }

    public function Action_Step1()
    {
        
        /*
         * 
         *    First step
         * 1. Getting information about products in cart;
         * 2. Getting information from user (address, phone etc.);
         * 3. Entering all information into session;
         */
        
        $token = Request::Get('token');
        if(!ShopEngine::Help()->validateCheckoutToken($token))
        {
            return ShopEngine::Help()->RegularRedirect('catalog', 'all');  
        }
        
        $this->title = "Оформление заказа. Шаг 1";
        
        $this->layout = "checkout";
        
        $ip = ShopEngine::GetUserIp();
        
        if(!$this->GetModel()->GetProducts($ip))
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

            $this->errors = Controller::GetModel()->ValidateStep1();
            
            if(!$this->errors) {
                Request::SetSession('checkout_complete_step1', true);
                return ShopEngine::Help()->StrongRedirect('checkout', 'step2?token='.$token);
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
        
        $products = $this->GetModel()->GetProducts();
        if(!$products)
        {
            //return false;
        }
        $price = $this->GetModel()->GetProductsPrice($products);
        
        $regions = null;
        
        if($country_handle = Request::GetSession('checkout_country')) { 
            $sql = "SELECT * FROM countries c "
                    . "RIGHT JOIN region r ON c.country_id = r.country_id "
                    . "WHERE c.country_handle = ? AND r.region_avail = '1'";
            
            $regions = Getter::GetFreeData($sql,[$country_handle],false);
        }
        
        $sql = "SELECT * FROM countries WHERE country_avail = '1'";
        $countries = Getter::GetFreeData($sql,null,false);
        
        return $this->view->render("View_Checkout_Step1", [
            'error'          => $this->errors,
            'addresses'      => $addresses,
            'order_products' => $products,
            'order_price'    => $price,
            'regions'        => $regions,
            'countries'      => $countries
        ]);
    }
    
    public function Action_Step2()
    {
        /* 
         * Second step
         * 1. Get information about delivery method in selected place;
         * 2. Show this information to user;
         * 3. Get new information from user;
         * 4. Recalculate price;
         */
        
        $token = Request::Get('token');
        if(!ShopEngine::Help()->validateCheckoutToken($token))
        {
            //return ShopEngine::Help()->RegularRedirect('catalog', 'all');  
        }
        
        $this->title = "Оформление заказа. Шаг 2";
        
        $this->layout = "checkout";
        
        $ip = ShopEngine::GetUserIp();
        
        if(!$products = $this->GetModel()->GetProducts($ip))
        {
            return ShopEngine::Help()->RegularRedirect('catalog', 'all');  
        }
        
        // Full Price   
        $full     = $this->GetModel()->GetProductsPrice($products);
        
        if(Request::Post('checkout_step2')) 
        {
            $csrf = Request::Post('csrf');
            if(!ShopEngine::Help()->ValidateToken($csrf))
            {
                return false;
            }
            
            // Shipping price and type
            
            $this->GetModel()->SetShipper();
            
            // Set into session
            Request::SetSession('full_price', $full + Request::GetSession('shipper_price'));
            //
            
            Request::SetSession('checkout_complete_step2', true);
            return ShopEngine::Help()->StrongRedirect('checkout', 'step3?token='.$token);
        }
        
        if(!Request::GetSession('checkout_complete_step1')) 
        {
            return ShopEngine::Help()->StrongRedirect('checkout', 'step1');
        }
        $city = Request::GetSession('checkout_region');
        $sql = "SELECT r.region_shipper, s.shipper_id, r.region_name, s.shipper_type, s.shipper_price FROM region_ship r RIGHT JOIN shipper s ON r.region_shipper = s.shipper_id WHERE region_handle=?";

        $shipping = Getter::GetFreeData($sql, [$city], false);
        
        return $this->view->render("View_Checkout_Step2", [
            'shipping' => $shipping,
            'checkout_products' => $products,
            'checkout_price'    => $full
        ]);
    }
    
    public function ACtion_Step3()
    {
        /*
         * 
         * Pre final step
         * 1. Show information about payment methods;
         * 2. Get method from user;
         * 3. If user wants to use his poits to pay, recalculate full price and amount of points;
         */
        
        $token = Request::Get('token');
        if(!ShopEngine::Help()->validateCheckoutToken($token))
        {
            return ShopEngine::Help()->RegularRedirect('catalog', 'all');  
        }
        
        $this->title = "Оформление заказа. Шаг 3";
        
        $this->layout = "checkout";
        
        $ip = ShopEngine::GetUserIp();
        
        if(!$products = $this->GetModel()->GetProducts($ip))
        {
            return ShopEngine::Help()->RegularRedirect('catalog', 'all');  
        }
        
        if(!Request::GetSession('checkout_complete_step2')) 
        {
            return ShopEngine::Help()->StrongRedirect('checkout', 'step2');
        }
        
        $price = $this->GetModel()->GetProductsPrice($products, true);
        if(is_array($price))
        {   
            $price = $price['final'];
        } 
        
        $shipp = Request::GetSession('shipper_price');
        $full_price = $price + $shipp;
        Request::SetSession('full_price', $full_price);
        
        $errors = null;
        
        if(Request::Post('checkout_step3'))
        {
            $csrf = Request::Post('csrf');
            if(!ShopEngine::Help()->ValidateToken($csrf))
            {
                return false;
            }
            
            $errors = $this->GetModel()->ValidateStep3();
            if(!$errors)
            {
                $price = $this->GetModel()->GetProductsPrice($products);
                if($key = $this->GetModel()->FinishCheckout($price, $products))
                {   
                    //Mailer returns strings
                    return ShopEngine::Help()->StrongRedirect('checkout', 'thank_you?orderid='.$key); 
                }
                else {
                    $post = Request::Post();
                    return ShopEngine::Help()->StrongRedirect('errorpage', 'checkout?checkoutip='.ShopEngine::GetUserIp()); 
                }
            }
        }
        
        return $this->view->render("View_Checkout_Step3", [
            'full_price'        => $full_price,
            'shipper_price'     => $shipp,
            'checkout_price'    => $price,
            'checkout_products' => $products,
            'error'             => $errors
        ]);
        
    }
    
    public function Action_Thank_you()
    {
        /*
         * 
         * Final step
         * 1. Show full information about purchase;
         * 2. Generate link to this page;
         * 3. Generate bill for payment;
         */
        
        $this->layout = "checkout";
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
        $products = $this->GetModel()->GetOrderProducts($array['orders_id']);
        $final    = $this->GetModel()->GetProductsPrice($products);
        
        $this->title = "Заказ №{$array['orders_id']}";
        
        return $this->view->render("View_Checkout_Final", [
            'info'              => $array,
            'checkout_products' => $products,
            'final'             => $final
        ]);
    }
    
    public function Action_Download()
    {
        $this->layout = "checkout";
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
        return ShopEngine::Help()->ForcedDownload(ROOT.$array['document_file']);
    }
    
    public static function GetErrors()
    {
        return self::$errors;
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
    
}
