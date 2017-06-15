<?php

class addressdelete {
    
    public function start()
    {
        if ($_SERVER["REQUEST_METHOD"] != "POST") {
            return false;
        }
        
        $db = database::getInstance();
            
        $id    = ShopEngine::Help()->Clear($_POST['id']);
        $csrf  = ShopEngine::Help()->Clear($_POST['csrf']);
        $ip    = ShopEngine::GetUserIp();
        $user_id = Request::GetSession('user_id');
        
        if(!ShopEngine::Help()->ValidateToken($csrf))
        {
            return false;
        }
        
        $sql  = "DELETE from user_addresses WHERE address_id=:id AND address_user=:user";
        $stmt = $db->prepare($sql);
       
        $stmt->bindParam("id", $id);
        $stmt->bindParam("user", $user_id);
        
        if($stmt->execute())
        {
            return 1;
        }
        return 0;
    }
    
    
}
