<?php 

class Addtocart 
{

    public function start() 
    {

        $db = database::getInstance();
        
	if($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Getting info
            $handle   = ShopEngine::Help()->Clear($_POST['hand']);
            $csrf     = ShopEngine::Help()->Clear($_POST['csrf']);
            $count    = ShopEngine::Help()->Clear($_POST['coun']);
            $ip       = ShopEngine::GetUserIp();
            
            if(!ShopEngine::Help()->ValidateToken($csrf))
            {
                return false;
            }
            
            // If smth wrong
            if($count < 1 OR $handle === NULL) {
                return 0;
            }
            
            $stmt     = $db->prepare("SELECT price FROM products WHERE handle=?");
            $stmt->execute([$handle]);
            $product  = $stmt->fetch();
            $price    = $product['price'];
            
            $stmt     = null;
            
            $stmt     = $db->prepare("SELECT * FROM cart WHERE cart_ip=:ip AND products_handle=:handle");
            $stmt->bindParam(":ip", $ip);
            $stmt->bindParam(":handle", $handle);
            $stmt->execute();
            $products = $stmt->fetchAll();
            
            $stmt     = null;
            // If product already exist 
            if(count($products) >= 1) {
                
                $total = $products[0]['cart_count'] + $count;
                $id    = $products[0]['cart_id'];
                $sum   = $total * $price;
                
                $stmt  = $db->prepare("UPDATE cart SET cart_count=:count, cart_price=:sum WHERE cart_id=:id");
                $stmt->bindParam(":count", $total);
                $stmt->bindParam(":sum", $sum);
                $stmt->bindParam(":id", $id);
                
                $result = $stmt->execute();
                if($result) {
                    return 1;
                }
                
            }
            elseif(count($product) > 1) {
                // Throw error and delete other products (later)
                return 0;
            }
            // If no
            else {
                $sum     = $count * $price;
                
                $sql = "INSERT INTO cart (products_handle, cart_price, cart_count, cart_datetime, cart_ip)"
                    . "VALUES ("
                    . ":handle,"
                    . ":sum,"
                    . ":count,"
                    . "NOW(),"
                    . ":ip"
                    . ")";
            
                $stmt = $db->prepare($sql);
                $stmt->bindParam(":handle", $handle);
                $stmt->bindParam(":sum", $sum);
                $stmt->bindParam(":count", $count);
                $stmt->bindParam(":ip", $ip);

                $result = $stmt->execute();

                if($result) {
                    return 1;
                }
            }

            return 0;
            
            
            /*
            $id_vari = clear_string($_POST['id']);

            $result = mysql_query("SELECT * FROM cart WHERE cart_ip = '{$_SERVER['REMOTE_ADDR']}' AND cart_id_products = '$id_vari'");

            if(mysql_num_rows($result) > 0) {
                    $row = mysql_fetch_array($result);
                    $new_count = $row["cart_count"] + 1;
                    $update = mysql_query("UPDATE cart SET cart_count='$new_count' WHERE cart_ip = '{$_SERVER['REMOTE_ADDR']}' AND cart_id_products = '$id_vari'");
            }
            else {
                    $result = mysql_query("SELECT * FROM table_products WHERE products_id='$id_vari'");
                    $row = mysql_fetch_array($result);

                    mysql_query("INSERT INTO cart(cart_id_products,cart_price,cart_datetime,cart_ip) 
                            VALUES(
                            '".$row['products_id']."',
                            '".$row['price']."',
                            NOW(),
                            '".$_SERVER['REMOTE_ADDR']."')
                            ");
                    }
            }

            echo 1;
             
             */
        }
    }
}
