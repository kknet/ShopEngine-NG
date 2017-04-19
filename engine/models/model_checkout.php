<?php

class Model_Checkout extends Model {
    
    public function ValidateStep1()
    {
        
        $post = Request::Post();
        
        if(!$post) {
            return true;
        }
             
        // Last name
        if(!$post['checkout_last_name']) {
            $errors['last_name'] = [
                'class'   => 'field--error',
                'message' =>  '<p class="field__message field__message--error" id="error-for-last_name">Пожалуйста, введите Вашу фамилию</p>' 
            ];
        }
        
        // Email
        if(!$post['checkout_email'] OR !preg_match("/^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i", trim($post['checkout_email']))) {
            $errors['email'] = [
                'class'   => 'field--error',
                'message' =>  '<p class="field__message field__message--error" id="error-for-email">Пожалуйста, введите адрес действующей электронной почты</p>' 
            ];
        }
        
        // Address
        if(!$post['checkout_address']) {
            $errors['address'] = [
                'class'   => 'field--error',
                'message' =>  '<p class="field__message field__message--error" id="error-for-address1">Пожалуйста, введите адрес</p>' 
            ];
        }
        
        // City
        if(!$post['checkout_city']) {
            $errors['city'] = [
                'class'   => 'field--error',
                'message' =>  '<p class="field__message field__message--error" id="error-for-city">Пожалуйста, введите Ваш город</p>' 
            ];
        }
        
        // Index
        if(!$post['checkout_index']) {
            $errors['index'] = [
                'class'   => 'field--error',
                'message' =>  '<p class="field__message field__message--error" id="error-for-zip">Пожалуйста, введите Ваш почтовый индекс</p>' 
            ];
        }
        
        // Phone
        if(!$post['checkout_phone']) {
            $errors['phone'] = [
                'class'   => 'field--error',
                'message' =>  '<p class="field__message field__message--error" id="error-for-phone">Пожалуйста, введите действующий номер телефона</p>' 
            ];
        }
        
        // other
            //...
        
        //final
        if(count($errors) > 0) {
            return $errors;
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
            $errors['billing_last_name'] = [
                'class'   => 'field--error',
                'message' =>  '<p class="field__message field__message--error" id="error-for-last_name">Пожалуйста, введите Вашу фамилию</p>' 
            ];
        }
        
        // Address
        if(!$post['checkout_billing_address']) {
            $errors['billing_address'] = [
                'class'   => 'field--error',
                'message' =>  '<p class="field__message field__message--error" id="error-for-last_name">Пожалуйста, введите адрес</p>' 
            ];
        }
        
        // City
        if(!$post['checkout_billing_city']) {
            $errors['billing_city'] = [
                'class'   => 'field--error',
                'message' =>  '<p class="field__message field__message--error" id="error-for-last_name">Пожалуйста, введите Ваш город</p>' 
            ];
        }
        
        // Index
        if(!$post['checkout_billing_index']) {
            $errors['billing_index'] = [
                'class'   => 'field--error',
                'message' =>  '<p class="field__message field__message--error" id="error-for-last_name">Пожалуйста, введите Ваш индекс</p>' 
            ];
        }
        
        // Phone
        if(!$post['checkout_billing_phone']) {
            $errors['billing_phone'] = [
                'class'   => 'field--error',
                'message' =>  '<p class="field__message field__message--error" id="error-for-last_name">Пожалуйста, введите Ваш телефон</p>' 
            ];
        }
        
        //final
        if(count($errors) > 0) {
            return $errors;
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
        
        $sql = "INSERT INTO orders ("
                . "orders_users_id, "
                . "orders_price, "
                . "orders_shipping,"
                . "orders_name, "
                . "orders_last_name, "
                . "orders_company, "
                . "orders_address, "
                . "orders_region, "
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
                . ":name,"
                . ":last_name,"
                . ":company, "
                . ":address,"
                . ":region,"
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
                . ":bil_city,"
                . ":bil_country,"
                . ":bil_index,"
                . ":bil_phone,"
                . ":payment,"
                . ":ip,"
                . "1,"
                . "NOW()"
                . ")";
        
                
                //calculating full checkout price
                $shipper_id    = Request::GetSession('shipper_id');
                $sql_temp      = "SELECT shipper_type, shipper_price FROM shipper WHERE shipper_id=?";
                $temp          = Getter::GetFreeData($sql_temp, [$shipper_id]);
                $shipper_name  = $temp['shipper_type'];
                $shipper_price = $temp['shipper_price'];
                $final = Controller_Checkout::GetPreFinalPrice();
                if(is_array($final))
                {
                    $final = $final['final'];
                }
                $full          = $final + $shipper_price;
                $user_id = Request::GetSession("user_id");
        
                $stmt = $db->prepare($sql);
                if(!$user_id) {
                    $user_id = 0;
                }
                $stmt->bindParam(":price", $full);
                $stmt->bindParam(":shipping", $shipper_name);
                $stmt->bindParam(":user", $user_id);
                $stmt->bindParam(":name", Request::GetSession('checkout_name'));
                $stmt->bindParam(":last_name", Request::GetSession('checkout_last_name'));
                $stmt->bindParam(":company", Request::GetSession('checkout_company'));
                $stmt->bindParam(":address", Request::GetSession('checkout_address'));
                $stmt->bindParam(":region", Request::GetSession('checkout_region'));
                $stmt->bindParam(":city", Request::GetSession('checkout_city'));
                $stmt->bindParam(":country", Request::GetSession('checkout_country'));
                $stmt->bindParam(":flat", Request::GetSession('checkout_flat'));
                $stmt->bindParam(":email", Request::GetSession('checkout_email'));
                $stmt->bindParam(":phone", Request::GetSession('checkout_phone'));
                $stmt->bindParam(":note", Request::GetSession('checkout_note'));
                $stmt->bindParam(":bil_status", Request::GetSession('checkout_billing_address_payment'));
                $stmt->bindParam(":bil_name", Request::GetSession('checkout_billing_first_name'));
                $stmt->bindParam(":bil_last_name", Request::GetSession('checkout_billing_last_name'));
                $stmt->bindParam(":bil_company", Request::GetSession('checkout_billing_company'));
                $stmt->bindParam(":bil_city", Request::GetSession('checkout_billing_city'));
                $stmt->bindParam(":bil_country", Request::GetSession('checkout_billing_country'));
                $stmt->bindParam(":bil_index", Request::GetSession('checkout_billing_index'));
                $stmt->bindParam(":bil_phone", Request::GetSession('checkout_billing_phone'));
                $stmt->bindParam(":payment", Request::GetSession('checkout_payment_gateway'));
                $stmt->bindParam(":ip", ShopEngine::GetUserIp());
                
                if(!$stmt->execute())
                {
                    return false;
                }
                
                $id = $db->lastInsertId();
                Request::SetSession('last_order_id', $id);
                
                $sql = "UPDATE order_products SET orders_final_id=:id, orders_status='1' WHERE orders_ip=:ip AND orders_status='0'";
                $stmt = $db->prepare($sql);
                $stmt->bindParam(":id", $id);
                $stmt->bindParam(":ip", ShopEngine::GetUserIp());
                if($stmt->execute())
                {
                    
                    // Add order key
                    $key = sha1($id).uniqid(20);
                    
                    
                    // Send Email
                    $mailfrom = 'info@poterpite.ru';
                    $mailto   = Request::GetSession('checkout_email');
                    $subject  = 'Спасибо за заказ!';
                    require_once 'widgets/mailbody.php';
                    
                    $array = Controller_Checkout::GetOrderProducts();

                    ShopEngine::Help()->SendMaill($mailto, $mailfrom, $subject, $body, $array);
                    
                    // Erase cart
                    $sql  = "DELETE FROM cart WHERE cart_ip=:ip";
                    $stmt = $db->prepare($sql);
                    $stmt->bindParam(":ip", ShopEngine::GetUserIp());
                    $stmt->execute();
                    
                    $sql  = "UPDATE orders SET orders_key=:key WHERE orders_id=:id";
                    $stmt = $db->prepare($sql);
                    $stmt->bindParam(":key", $key);
                    $stmt->bindParam(":id", $id);
                    $stmt->execute();
                    
                    //Update points
                    
                    if(Request::GetSession('checkout_points_enabled'))
                    {
                        $sql = "UPDATE users SET users_points=:points WHERE users_id=:id";
                    
                        $points = Controller_Checkout::GetPreFinalPrice()['points'];
                        $points = (int)$points;
                        $id     = Request::GetSession('user_id');

                        $stmt = $db->prepare($sql);
                        $stmt->bindParam(":points", $points);
                        $stmt->bindParam(":id", $id);
                        if(!$stmt->execute())
                        {
                            return false;
                        }
                    }
                    
                    //Erase session
                    Request::EraseFullSession();
                    
                    return $key;
                }
    }
}
