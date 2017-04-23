<?php

class Model_Checkout extends Model {
    
    public $errors = [];
    public $array  = [];
    public $id;
    public $key;
    public $shipper_name;
    public $shipper_price;
    
    public function ValidateStep1()
    {
        
        $post = Request::Post();
        
        if(!$post) {
            return true;
        }
             
        // Last name
        if(!$post['checkout_last_name']) {
            $this->errors['last_name'] = [
                'class'   => 'field--error',
                'message' =>  '<p class="field__message field__message--error" id="error-for-last_name">Пожалуйста, введите Вашу фамилию</p>' 
            ];
        }
        
        // Email
        if(!$post['checkout_email'] OR !preg_match("/^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i", trim($post['checkout_email']))) {
            $this->errors['email'] = [
                'class'   => 'field--error',
                'message' =>  '<p class="field__message field__message--error" id="error-for-email">Пожалуйста, введите адрес действующей электронной почты</p>' 
            ];
        }
        
        // Address
        if(!$post['checkout_address']) {
            $this->errors['address'] = [
                'class'   => 'field--error',
                'message' =>  '<p class="field__message field__message--error" id="error-for-address1">Пожалуйста, введите адрес</p>' 
            ];
        }
        
        // City
        if(!$post['checkout_city']) {
            $this->errors['city'] = [
                'class'   => 'field--error',
                'message' =>  '<p class="field__message field__message--error" id="error-for-city">Пожалуйста, введите Ваш город</p>' 
            ];
        }
        
        // Index
        if(!$post['checkout_index']) {
            $this->errors['index'] = [
                'class'   => 'field--error',
                'message' =>  '<p class="field__message field__message--error" id="error-for-zip">Пожалуйста, введите Ваш почтовый индекс</p>' 
            ];
        }
        
        // Phone
        if(!$post['checkout_phone']) {
            $this->errors['phone'] = [
                'class'   => 'field--error',
                'message' =>  '<p class="field__message field__message--error" id="error-for-phone">Пожалуйста, введите действующий номер телефона</p>' 
            ];
        }
        
        // other
            //...
        
        //final
        if(count($this->errors) > 0) {
            return $this->errors;
        }
        else {
            return false;
        }
    }
    
    public function ValidateStep3()
    {
        $post = Request::Post();
        
        if(!$post) {
            return true;
        }
        if($post['checkout_billing_address_payment'] === '0') {
            return false;
        }
        
        //Billing
        
        // Last name
        if(!$post['checkout_billing_last_name']) {
            $this->errors['billing_last_name'] = [
                'class'   => 'field--error',
                'message' =>  '<p class="field__message field__message--error" id="error-for-last_name">Пожалуйста, введите Вашу фамилию</p>' 
            ];
        }
        
        // Address
        if(!$post['checkout_billing_address']) {
            $this->errors['billing_address'] = [
                'class'   => 'field--error',
                'message' =>  '<p class="field__message field__message--error" id="error-for-last_name">Пожалуйста, введите адрес</p>' 
            ];
        }
        
        // City
        if(!$post['checkout_billing_city']) {
            $this->errors['billing_city'] = [
                'class'   => 'field--error',
                'message' =>  '<p class="field__message field__message--error" id="error-for-last_name">Пожалуйста, введите Ваш город</p>' 
            ];
        }
        
        // Index
        if(!$post['checkout_billing_index']) {
            $this->errors['billing_index'] = [
                'class'   => 'field--error',
                'message' =>  '<p class="field__message field__message--error" id="error-for-last_name">Пожалуйста, введите Ваш индекс</p>' 
            ];
        }
        
        // Phone
        if(!$post['checkout_billing_phone']) {
            $this->errors['billing_phone'] = [
                'class'   => 'field--error',
                'message' =>  '<p class="field__message field__message--error" id="error-for-last_name">Пожалуйста, введите Ваш телефон</p>' 
            ];
        }
        
        //final
        if(count($this->errors) > 0) {
            return $this->errors;
        }
        else {
            return false;
        }
        
    }
    
    public function SetShipper()
    {
        $ship_id = Request::Post('checkout_ship_id');
        $sql = "SELECT shipper_id, shipper_type, shipper_price FROM shipper WHERE shipper_id=?";
        $array = Getter::GetFreeData($sql, [$ship_id]);
        Request::SetSession('shipper_name', $array['shipper_type']);
        Request::SetSession('shipper_price', $array['shipper_price']);
        Request::SetSession('shipper_id', $array['shipper_id']);
    }
    
    public function FinishCheckout()
    {
        $db = database::getInstance();
        $ip   = ShopEngine::GetUserIp();
        
        $sql = "INSERT INTO orders ("
                . "orders_users_id, "
                . "orders_price, "
                . "orders_shipping,"
                . "orders_shipping_price,"
                . "orders_name, "
                . "orders_last_name, "
                . "orders_company, "
                . "orders_address, "
                . "orders_region, "
                . "orders_index, "
                . "orders_city, "
                . "orders_country, "
                . "orders_flat, "
                . "orders_email, "
                . "orders_phone, "
                . "orders_note,"
                . "orders_billing_status, "
                . "orders_billing_name, "
                . "orders_billing_last_name, "
                . "orders_billing_company, "
                . "orders_billing_address, "
                . "orders_billing_city, "
                . "orders_billing_country, "
                . "orders_billing_index, "
                . "orders_billing_phone, "
                . "orders_payment, "
                . "orders_ip, "
                . "orders_status,"
                . "orders_date "
                . " ) VALUES("
                . ":user,"
                . ":price,"
                . ":shipping,"
                . ":shipping_price,"
                . ":name,"
                . ":last_name,"
                . ":company, "
                . ":address,"
                . ":region,"
                . ":index,"
                . ":city,"
                . ":country,"
                . ":flat,"
                . ":email,"
                . ":phone,"
                . ":note,"
                . ":bil_status,"
                . ":bil_name,"
                . ":bil_last_name,"
                . ":bil_company,"
                . ":bil_address,"
                . ":bil_city,"
                . ":bil_country,"
                . ":bil_index,"
                . ":bil_phone,"
                . ":payment,"
                . ":ip,"
                . "1,"
                . "NOW()"
                . ")";
        
                //Calculate the price
                $full    = $this->CalulateFullPrice();
                $user_id = Request::GetSession("user_id");
        
                $stmt = $db->prepare($sql);
                
                // Cast
                if(!$user_id) {
                    $user_id = 0;
                }
                
                $checkont_name = Request::GetSession('checkout_name');
                $checkout_last_name = Request::GetSession('checkout_last_name');
                $checkout_company = Request::GetSession('checkout_company');
                $checkout_address = Request::GetSession('checkout_address');
                $checkout_region = Request::GetSession('checkout_region');
                $checkout_index = Request::GetSession('checkout_index');
                $checkout_city = Request::GetSession('checkout_city');
                $checkout_country = Request::GetSession('checkout_country');
                $checkout_flat = Request::GetSession('checkout_flat');
                $checkout_email = Request::GetSession('checkout_email');
                $checkout_phone = Request::GetSession('checkout_phone');
                $checkout_note = Request::GetSession('checkout_note');
                $checkout_billing_address_payment = Request::GetSession('checkout_billing_address_payment');
                $checkout_billing_first_name = Request::GetSession('checkout_billing_first_name');
                $checkout_billing_last_name = Request::GetSession('checkout_billing_last_name');
                $checkout_billing_company = Request::GetSession('checkout_billing_company');
                $checkout_billing_address = Request::GetSession('checkout_billing_address');
                $checkout_billing_city = Request::GetSession('checkout_billing_city');
                $checkout_billing_country = Request::GetSession('checkout_billing_country');
                $checkout_billing_index = Request::GetSession('checkout_billing_index');
                $checkout_billing_phone = Request::GetSession('checkout_billing_phone');
                $checkout_payment_gateway = Request::GetSession('checkout_payment_gateway');
                
                $stmt->bindParam(":price", $full);
                $stmt->bindParam(":shipping", $this->shipper_name);
                $stmt->bindParam(":shipping_price", $this->shipper_price);
                $stmt->bindParam(":user", $user_id);
                $stmt->bindParam(":name", $checkont_name);
                $stmt->bindParam(":last_name", $checkout_last_name);
                $stmt->bindParam(":company", $checkout_company);
                $stmt->bindParam(":address", $checkout_address);
                $stmt->bindParam(":region", $checkout_region);
                $stmt->bindParam(":index", $checkout_index);
                $stmt->bindParam(":city", $checkout_city);
                $stmt->bindParam(":country", $checkout_country);
                $stmt->bindParam(":flat", $checkout_flat);
                $stmt->bindParam(":email", $checkout_email);
                $stmt->bindParam(":phone", $checkout_phone);
                $stmt->bindParam(":note", $checkout_note);
                $stmt->bindParam(":bil_status", $checkout_billing_address_payment);
                $stmt->bindParam(":bil_name", $checkout_billing_first_name);
                $stmt->bindParam(":bil_last_name", $checkout_billing_last_name);
                $stmt->bindParam(":bil_company", $checkout_billing_company);
                $stmt->bindParam(":bil_city", $checkout_billing_city);
                $stmt->bindParam(":bil_country", $checkout_billing_country);
                $stmt->bindParam(":bil_address", $checkout_billing_address);
                $stmt->bindParam(":bil_index", $checkout_billing_index);
                $stmt->bindParam(":bil_phone", $checkout_billing_phone);
                $stmt->bindParam(":payment", $checkout_payment_gateway);
                $stmt->bindParam(":ip", $ip);
                
                if(!$stmt->execute())
                {
                    return false;
                }
                
                $this->id = $db->lastInsertId();
                Request::SetSession('last_order_id', $this->id);
                
                $sql = "UPDATE order_products SET orders_final_id=:id, orders_status='1' WHERE orders_ip=:ip AND orders_status='0'";
                $stmt = $db->prepare($sql);
                $stmt->bindParam(":id", $this->id);
                $stmt->bindParam(":ip", $ip);
                if($stmt->execute())
                {
                    
                    // Add order key
                    $this->key = sha1($this->id).uniqid(20);
                    
                    
                    // Send Email
                    if(!$this->SendEmail($this->id, $this->key))
                    {
                        return false;
                    }               
                    
                    // Erase cart
                    $sql  = "DELETE FROM cart WHERE cart_ip=:ip";
                    $stmt = $db->prepare($sql);
                    $stmt->bindParam(":ip", $ip);
                    $stmt->execute();
                    
                    $sql  = "UPDATE orders SET orders_key=:key WHERE orders_id=:id";
                    $stmt = $db->prepare($sql);
                    $stmt->bindParam(":key", $this->key);
                    $stmt->bindParam(":id", $this->id);
                    $stmt->execute();
                    
                    //CreatePDF
                    $this->CreatePDF($this->id, $this->key);
                    
                    //Update Points
                    $this->updatePoints();
                    
                    //Erase session
                    Request::EraseFullSession();
                    
                    return $this->key;
                }
    }
    
    public function CreatePDF($id, $key)
    {
        //CreatePDF
        ShopEngine::Help()->createPDF();
        
        //Create Link
        $db  = database::getInstance();
        $lnk = Config::$config['orders_location']."order{$id}.pdf";
        $sql = "INSERT INTO orders_documents (orders_id, document_file, orders_key) VALUES (:id, :file, :key)";
        
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":file", $lnk);
        $stmt->bindParam(":key", $key);
        if(!$stmt->execute())
        {
            return false;
        }
    }
    
    public function CalulateFullPrice()
    {
        $shipper_id    = Request::GetSession('shipper_id');
        $sql_temp      = "SELECT shipper_type, shipper_price FROM shipper WHERE shipper_id=?";
        $temp          = Getter::GetFreeData($sql_temp, [$shipper_id]);
        $this->shipper_name  = $temp['shipper_type'];
        $this->shipper_price = $temp['shipper_price'];
        $final = Controller_Checkout::GetPreFinalPrice();
        if(is_array($final))
        {
            $final = $final['final'];
        }
        return $final + $this->shipper_price;
    }
    
    public function updatePoints()
    {
        //Update points
        if(Request::GetSession('checkout_points_enabled'))
        {
            $sql = "UPDATE users SET users_points=:points WHERE users_id=:id";

            $points = Controller_Checkout::GetPreFinalPrice()['points'];
            $points = (int)$points;
            $id     = Request::GetSession('user_id');

            $db = database::getInstance();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":points", $points);
            $stmt->bindParam(":id", $id);
            if(!$stmt->execute())
            {
                return false;
            }
        }
    }
    
    public function SendEmail($id, $key)
    {
        try { 
            $mailfrom = 'info@poterpite.ru';
            $mailto   = Request::GetSession('checkout_email');
            $subject  = 'Спасибо за заказ!';
            
            $mailto_ad  = 'alexandergrachyov@gmail.com';
            $subject_ad = 'Был совершен заказ';
            
            $this->array = Controller_Checkout::GetOrderProducts();
            
            require_once 'widgets/mailbody.php';

            ShopEngine::Help()->SendMaill($mailto, $mailfrom, $subject, $body, $this->array);
            
            ShopEngine::Help()->SendMaill($mailto_ad, $mailfrom, $subject_ad, $body, $this->array);
            
            return true;
        } Catch(Exception $e) {
            ShopEngine::ExceptionToFile($e);
            return false;
        }
    }
        
}
