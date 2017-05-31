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
        
        // First name
        if(!$post['checkout_name']) {
            $this->errors['name'] = [
                'class'   => 'field--error',
                'message' =>  '<p class="field__message field__message--error" id="error-for-last_name">Пожалуйста, введите Ваше имя</p>' 
            ];
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
        
        // Region
        if(!$post['checkout_region']) {
            $this->errors['region'] = [
                'class'   => 'field--error',
                'message' =>  '<p class="field__message field__message--error" id="error-for-city">Пожалуйста, введите Ваш регион</p>' 
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
    
    public function FinishCheckout($price, $products)
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
                $full    = $this->CalulateFullPrice($products);
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
                    $this->updatePoints($products);
                    
                    //Erase session
                    Request::EraseFullSession();
                    
                    return $this->key;
                }
    }
    
    public function CreatePDF($id, $key)
    {
        //CreatePDF
        @ShopEngine::Help()->createPDF();
        
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
    
    public function GetProducts()
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
    
    public function GetOrderProducts($id, $thumb = false)
    {
        $ip = ShopEngine::GetUserIp();
        $sql = "SELECT o.products_handle, o.orders_price, o.orders_count, p.handle, p.title, p.image, p.category_id, p.price, c.name FROM order_products o "
                . "RIGHT JOIN products p ON o.products_handle = p.handle AND p.title <> ''"
                . "RIGHT JOIN category c ON p.category_id = c.category_id "
                . "WHERE orders_final_id=?";
        $order_pr = Getter::GetFreeData($sql, [$id], false);
        if(!$order_pr) {
            return Route::ErrorPage404();
        }
        
        if(!$thumb)
        {
            return $order_pr;
        }
        
        $imagine = new \Imagine\Gd\Imagine;
        
        for($i = 0; $i < count($order_pr); $i++)
        {
            $current = $imagine->open($order_pr[$i]['image']);
            
            $size    = $current->getSize();
            
            if($size->getWidth() > $size->getHeight())
            {
                $width  = $size->getHeight();
                $height = $width;
                
                $orig   = $size->getWidth();
                $offset = ($orig - $width) / 2;
                
                $new_size = new Imagine\Image\Box($width, $height);
                $point    = new Imagine\Image\Point($offset, 0);
                $thumb    = new Imagine\Image\Box(60, 60);
            }
            else {
                $width  = $size->getWidth();
                $height = $width;
                
                $orig   = $size->getHeight();
                $offset = ($orig - $width) / 2;
                
                $new_size = new Imagine\Image\Box($width, $height);
                $point    = new Imagine\Image\Point(0, $offset);
                $thumb    = new Imagine\Image\Box(60, 60);
            }
            
            $thumb_dir = 'thumbnails/temp';
            if(!file_exists($thumb_dir))
            {
                mkdir($thumb_dir);
            }
            
            $filename = $order_pr[$i]['image'];
            
            $ext = substr($filename, strrpos($filename, '.'));
            
            $thumb_name = $thumb_dir.'/temp_'.rand(0,777).$id.$i.$ext;
            
            $current->crop($point, $new_size)->thumbnail($thumb)->save($thumb_name);
            
            $order_pr[$i]['image'] = $thumb_name;
            
        }
        
        return $order_pr;
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
    
    public function CalulateFullPrice($products)
    {
        $shipper_id    = Request::GetSession('shipper_id');
        $sql_temp      = "SELECT shipper_type, shipper_price FROM shipper WHERE shipper_id=?";
        $temp          = Getter::GetFreeData($sql_temp, [$shipper_id]);
        $this->shipper_name  = $temp['shipper_type'];
        $this->shipper_price = $temp['shipper_price'];
        $final = $this->GetProductsPrice($products);
        if(is_array($final))
        {
            $final = $final['final'];
        }
        return $final + $this->shipper_price;
    }
    
    public function updatePoints($products)
    {
        //Update points
        if(Request::GetSession('checkout_points_enabled'))
        {
            $sql = "UPDATE users SET users_points=:points WHERE users_id=:id";

            $points = $this->GetProductsPrice($products)['points'];
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
            $subject  = "Заказ #{$id} принят";
            
            $mailto_ad  = Config::$config['admin_email'];
            $subject_ad = "[".Config::$config['site_email_name']."] Заказ #{$id} ".Request::GetSession('checkout_name').' '.Request::GetSession('checkout_last_name').' '.Request::GetSession('checkout_phone');
            
            $this->array = $this->GetOrderProducts($id, true);
            
            $body    = $this->prepareEmail($id, $key, $this->array);
            $body_ad = $this->prepareEmailAdmin($id, $key, $this->array);

            ShopEngine::Help()->SendMaill($mailto, $mailfrom, $subject, $body, $this->array);
                    
            ShopEngine::Help()->SendMaill($mailto_ad, $mailfrom, $subject_ad, $body_ad, $this->array);

            $this->removeThumb($this->array);
                
            return true;
            
            
        } Catch(Exception $e) {
            
            $this->removeThumb($this->array);
            
            ShopEngine::ExceptionToFile($e);
            return false;
        }
    }
    
    public function removeThumb($array)
    {
        foreach($array as $current)
        {
            @unlink($current['image']);
        }
    }
    
    public function prepareEmail($id, $key, $array)
    {
        $session = Request::GetSession();
        $tpl = file_get_contents(ROOT.'template/mail/ordermail_tpl.php');
        
        $tpl = str_replace("{{ORDERID}}", 'ORDER #'.$id, $tpl);
        $tpl = str_replace("{{ORDER_NAME}}", $session['checkout_name'], $tpl);
        $tpl = str_replace("{{ORDER_LAST_NAME}}", $session['checkout_last_name'], $tpl);
        $tpl = str_replace("{{ORDER_PHONE}}", $session['checkout_phone'], $tpl);
        
        $items = $this->prepareEmailItems($array);
        
        $tpl = str_replace("{{ITEMS}}", $items, $tpl);
        $tpl = str_replace("{{SHIPPER_NAME}}", $session['shipper_name'].' - '. $session['shipper_price'], $tpl);
        $tpl = str_replace("{{SHIPPER_PRICE}}", ShopEngine::Help()->AsPrice($session['shipper_price']), $tpl);
        $tpl = str_replace("{{FULL_PRICE}}", ShopEngine::Help()->AsPrice($session['full_price']), $tpl);
        $tpl = str_replace("{{CHECKOUT_ADDRESS}}", $session['checkout_address'], $tpl);
        $tpl = str_replace("{{CHECKOUT_CITY}}", $session['checkout_city'], $tpl);
        $tpl = str_replace("{{CHECKOUT_REGION}}", $session['checkout_region'], $tpl);
        $tpl = str_replace("{{CHECKOUT_INDEX}}", $session['checkout_index'], $tpl);
        $tpl = str_replace("{{CHECKOUT_COUNTRY}}", $session['checkout_country'], $tpl);
        $tpl = str_replace("{{COMPANY_NAME}}", $session['checkout_company'], $tpl);
        
        if($session['checkout_billing_address_payment'] === '0') {
          
        $tpl = str_replace("{{CHECKOUT_BILLING_NAME}}", $session['checkout_name'], $tpl);    
        $tpl = str_replace("{{CHECKOUT_BILLING_LAST_NAME}}", $session['checkout_last_name'], $tpl);
        $tpl = str_replace("{{CHECKOUT_BILLING_PHONE}}", $session['checkout_phone'], $tpl);
        $tpl = str_replace("{{CHECKOUT_BILLING_ADDRESS}}", $session['checkout_address'], $tpl);
        $tpl = str_replace("{{CHECKOUT_BILLING_CITY}}", $session['checkout_city'], $tpl);
        $tpl = str_replace("{{CHECKOUT_BILLING_REGION}}", $session['checkout_region'], $tpl);
        $tpl = str_replace("{{CHECKOUT_BILLING_INDEX}}", $session['checkout_index'], $tpl);
        $tpl = str_replace("{{CHECKOUT_BILLING_COUNTRY}}", $session['checkout_country'], $tpl);
        $tpl = str_replace("{{COMPANY_BILLING_NAME}}", $session['checkout_company'], $tpl);
        
        } else {
         
            
        $tpl = str_replace("{{CHECKOUT_BILLING_NAME}}", $session['checkout_billing_first_name'], $tpl);    
        $tpl = str_replace("{{CHECKOUT_BILLING_LAST_NAME}}", $session['checkout_billing_last_name'], $tpl);
        $tpl = str_replace("{{CHECKOUT_BILLING_PHONE}}", $session['checkout_billing_phone'], $tpl);
        $tpl = str_replace("{{CHECKOUT_BILLING_ADDRESS}}", $session['checkout_billing_address'], $tpl);
        $tpl = str_replace("{{CHECKOUT_BILLING_CITY}}", $session['checkout_billing_city'], $tpl);
//        $tpl = str_replace("{{CHECKOUT_BILLING_REGION}}", $session['checkout_billing_region'], $tpl);
        $tpl = str_replace("{{CHECKOUT_BILLING_INDEX}}", $session['checkout_billing_index'], $tpl);
        $tpl = str_replace("{{CHECKOUT_BILLING_COUNTRY}}", $session['checkout_billing_country'], $tpl);
        $tpl = str_replace("{{COMPANY_BILLING_NAME}}", $session['checkout_billing_company'], $tpl); 
        
        }
        
        $link = ShopEngine::GetHost()."/checkout/thank_you?orderid={$key}";
        $tpl = str_replace("{{ORDER_LINK}}", $link, $tpl); 
        
        return $tpl;
    }
    
    public function prepareEmailAdmin($id, $key, $array)
    {
        $session = Request::GetSession();
        $tpl = file_get_contents(ROOT.'template/mail/ordermail_tpl_admin.php');
        
        $tpl = str_replace("{{ORDERID}}", 'ORDER #'.$id, $tpl);
        $tpl = str_replace("{{ORDER_NAME}}", $session['checkout_name'], $tpl);
        $tpl = str_replace("{{ORDER_LAST_NAME}}", $session['checkout_last_name'], $tpl);
        $tpl = str_replace("{{ORDER_PHONE}}", $session['checkout_phone'], $tpl);
        
        $items = $this->prepareEmailItems($array);
        
        $tpl = str_replace("{{ITEMS}}", $items, $tpl);
        $tpl = str_replace("{{SHIPPER_NAME}}", $session['shipper_name'].' - '. $session['shipper_price'], $tpl);
        $tpl = str_replace("{{SHIPPER_PRICE}}", ShopEngine::Help()->AsPrice($session['shipper_price']), $tpl);
        $tpl = str_replace("{{FULL_PRICE}}", ShopEngine::Help()->AsPrice($session['full_price']), $tpl);
        $tpl = str_replace("{{CHECKOUT_ADDRESS}}", $session['checkout_address'], $tpl);
        $tpl = str_replace("{{CHECKOUT_CITY}}", $session['checkout_city'], $tpl);
        $tpl = str_replace("{{CHECKOUT_REGION}}", $session['checkout_region'], $tpl);
        $tpl = str_replace("{{CHECKOUT_INDEX}}", $session['checkout_index'], $tpl);
        $tpl = str_replace("{{CHECKOUT_COUNTRY}}", $session['checkout_country'], $tpl);
        $tpl = str_replace("{{COMPANY_NAME}}", $session['checkout_company'], $tpl);
        
        if($session['checkout_billing_address_payment'] === '0') {
          
        $tpl = str_replace("{{CHECKOUT_BILLING_NAME}}", $session['checkout_name'], $tpl);    
        $tpl = str_replace("{{CHECKOUT_BILLING_LAST_NAME}}", $session['checkout_last_name'], $tpl);
        $tpl = str_replace("{{CHECKOUT_BILLING_PHONE}}", $session['checkout_phone'], $tpl);
        $tpl = str_replace("{{CHECKOUT_BILLING_ADDRESS}}", $session['checkout_address'], $tpl);
        $tpl = str_replace("{{CHECKOUT_BILLING_CITY}}", $session['checkout_city'], $tpl);
        $tpl = str_replace("{{CHECKOUT_BILLING_REGION}}", $session['checkout_region'], $tpl);
        $tpl = str_replace("{{CHECKOUT_BILLING_INDEX}}", $session['checkout_index'], $tpl);
        $tpl = str_replace("{{CHECKOUT_BILLING_COUNTRY}}", $session['checkout_country'], $tpl);
        $tpl = str_replace("{{COMPANY_BILLING_NAME}}", $session['checkout_company'], $tpl);
        
        } else {
         
            
        $tpl = str_replace("{{CHECKOUT_BILLING_NAME}}", $session['checkout_billing_first_name'], $tpl);    
        $tpl = str_replace("{{CHECKOUT_BILLING_LAST_NAME}}", $session['checkout_billing_last_name'], $tpl);
        $tpl = str_replace("{{CHECKOUT_BILLING_PHONE}}", $session['checkout_billing_phone'], $tpl);
        $tpl = str_replace("{{CHECKOUT_BILLING_ADDRESS}}", $session['checkout_billing_address'], $tpl);
        $tpl = str_replace("{{CHECKOUT_BILLING_CITY}}", $session['checkout_billing_city'], $tpl);
//        $tpl = str_replace("{{CHECKOUT_BILLING_REGION}}", $session['checkout_billing_region'], $tpl);
        $tpl = str_replace("{{CHECKOUT_BILLING_INDEX}}", $session['checkout_billing_index'], $tpl);
        $tpl = str_replace("{{CHECKOUT_BILLING_COUNTRY}}", $session['checkout_billing_country'], $tpl);
        $tpl = str_replace("{{COMPANY_BILLING_NAME}}", $session['checkout_billing_company'], $tpl); 
        
        }
        
        $link = ShopEngine::GetHost()."/checkout/thank_you?orderid={$key}";
        $tpl = str_replace("{{ORDER_LINK}}", $link, $tpl); 
        
        return $tpl;
    }
    
    public function prepareEmailItems($array)
    {
        $body = null;
        if($array) { 
            foreach ($array as $cur)
            {
                
                $body .= '<tr class="m_-1216999618458073902order-list__item m_-1216999618458073902order-list__item" style="width:100%">'
                        . '<td class="m_-1216999618458073902order-list__item__cell" style="font-family:-apple-system,BlinkMacSystemFont,\''.'Segoe UI'.'\',\''.'Roboto'.'\',\''.'Oxygen'.'\',\''.'Ubuntu'.'\',\''.'Cantarell'.'\',\''.'Fira Sans'.'\',\''.'Droid Sans'.'\',\''.'Helvetica Neue'.'\',sans-serif">
                    <table style="border-collapse:collapse;border-spacing:0">
                      <tbody><tr>
                      <td style="font-family:-apple-system,BlinkMacSystemFont,\''.'Roboto'.'\',\''.'Oxygen'.'\',\''.'Ubuntu'.'\',\''.'Cantarell'.'\',\''.'Fira Sans'.'\',\''.'Droid Sans'.'\',\''.'Helvetica Neue'.'\',sans-serif;">
                          <img src="cid:'.$cur['handle'].'" align="left" width="60px" height="60px" class="m_-1216999618458073902order-list__product-image CToWUd" style="border:1px solid #e5e5e5;border-radius:8px;margin-right:15px;">
                      </td>
                      <td class="m_-1216999618458073902order-list__product-description-cell" style="font-family:-apple-system,BlinkMacSystemFont,\''.'Roboto'.'\',\''.'Oxygen'.'\',\''.'Ubuntu'.'\',\''.'Cantarell'.'\',\''.'Fira Sans'.'\',\''.'Droid Sans'.'\',\''.'Helvetica Neue'.'\',sans-serif;width:75%">

                        <span class="m_-1216999618458073902order-list__item-title" style="color:#555;font-size:16px;font-weight:600;line-height:1.4">'.$cur['title'].'&nbsp;×&nbsp;'.$cur['orders_count'].'</span><br>

                      </td>
                        <td class="m_-1216999618458073902order-list__price-cell" style="font-family:-apple-system,BlinkMacSystemFont,\''.'Roboto'.'\',\''.'Oxygen'.'\',\''.'Ubuntu'.'\',\''.'Cantarell'.'\',\''.'Fira Sans'.'\',\''.'Droid Sans'.'\',\''.'Helvetica Neue'.'\',sans-serif;white-space:nowrap">

                          <p class="m_-1216999618458073902order-list__item-price" style="color:#555;font-size:16px;font-weight:600;line-height:150%;margin:0 0 0 15px" align="right">'.ShopEngine::Help()->AsPrice($cur['orders_price']).'</p>
                        </td>
                    </tr></tbody></table>
                  </td></tr>';
                
            }
            
            return $body;
        }   
    }
        
}
