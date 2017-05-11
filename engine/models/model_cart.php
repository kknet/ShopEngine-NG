<?php

class Model_Cart extends Model{
    
    public function PrepareCheckout($ip)
    {
        
        $db = database::getInstance();
        
        $sql = "SELECT * FROM cart WHERE cart_ip =?";
        $array = Getter::GetFreeData($sql, [$ip], false);
        
        if(!$array) {
            return false;
        }
        
        try {
            foreach ($array as $cur) {
                
                $sql = "SELECT * FROM order_products WHERE orders_ip=:ip AND products_handle=:handle AND orders_status='0'";
                $stmt = $db->prepare($sql);
                $stmt->bindParam(":ip", $ip);
                $stmt->bindParam(":handle", $cur['products_handle']);
                $stmt->execute();
                $temp = $stmt->fetch();
                if($temp) {
                   
                    $sql = "UPDATE order_products SET orders_count=:count, orders_price=:price WHERE products_handle=:handle AND orders_ip=:ip AND orders_status='0'";
                    $stmt = $db->prepare($sql);
                   
                    $stmt->bindParam(":count", $cur['cart_count']);
                    $stmt->bindParam(":price", $cur['cart_price']);
                    $stmt->bindParam(":handle", $cur['products_handle']);
                    $stmt->bindParam(":ip", $ip);
                    
                    $stmt->execute();
                }
                else {
                    $sql = "INSERT INTO order_products(products_handle, orders_cart_id, orders_price, orders_count, orders_datetime, orders_ip) VALUES("
                            . ":handle,"
                            . "0,"
                            . ":price,"
                            . ":count,"
                            . "NOW(),"
                            . ":ip)";
                   $stmt = $db->prepare($sql);
                   $stmt->bindParam(":handle", $cur['products_handle']);
                   $stmt->bindParam(":price", $cur['cart_price']);
                   $stmt->bindParam(":count", $cur['cart_count']);
                   $stmt->bindParam(":ip", $ip);

                   $stmt->execute();
                }
            }
            
            // Note
            Request::SetSession('note', Request::Post('note'));
            return true;
            
        } catch (Exception $e) {
            ShopEngine::ExceptionToFile($e);
        }
        
    }
    
}
