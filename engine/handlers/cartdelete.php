<?php 
    class Cartdelete {
    
        public function start() 
        {
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                
                $db = database::getInstance();
            
                $id    = ShopEngine::Help()->Clear($_POST['id']);
                $count = ShopEngine::Help()->Clear($_POST['count']);
                $csrf  = ShopEngine::Help()->Clear($_POST['csrf']);
                $ip    = ShopEngine::GetUserIp();
                
                if(!ShopEngine::Help()->ValidateToken($csrf))
                {
                    return false;
                }
                
                $sql = "DELETE FROM cart WHERE cart_id=:id AND cart_ip=:ip";
                $stmt = $db->prepare($sql);
                $stmt->bindParam(":id", $id);
                $stmt->bindParam(":ip", $ip);
                
                if($stmt->execute())
                {
                    $ok1 = true;
                }
                
                $sql = "DELETE FROM order_products WHERE orders_cart_id=:id AND orders_ip=:ip";
                $stmt = $db->prepare($sql);
                $stmt->bindParam(":id", $id);
                $stmt->bindParam(":ip", $ip);
                
                if($stmt->execute())
                {
                    $ok2 = true;
                } 
                
                if($ok1 AND $ok2)
                {
                    return 1;
                }
                
                return 0;
//                $sql = "SELECT c.cart_count, c.cart_price, p.price FROM cart c RIGHT OUTER JOIN products p ON c.products_handle = p.handle WHERE cart_id=:id AND cart_ip=:ip";               
//                $stmt = $db->prepare($sql);
//
//                $stmt->bindParam(":id", $id);
//                $stmt->bindParam(":ip", $ip);
//                $stmt->execute();
//                
//                $array = $stmt->fetch();
//                if(count($array) > 0) {
//                    $total = $count;
//                    $sum   = $total * $array['price'];
//                    
//                    
//                    $sql = "UPDATE cart SET cart_count=:count, cart_price=:price WHERE cart_id=:id AND cart_ip=:ip";
//                    $stmt = $db->prepare($sql);
//                    
//                    $stmt->bindParam(":count", $total);
//                    $stmt->bindParam(":price", $sum);
//                    $stmt->bindParam(":id", $id);
//                    $stmt->bindParam(":ip", $ip);
//                    
//                    if($stmt->execute()) {
//                        return 1;
//                    }
//                    else {
//                        return 0;
//                    }
//                }
//                
//                return 0;
        }
    }
}