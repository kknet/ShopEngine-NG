<?php

class AddressChange {
    
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
        
        $sql    = "SELECT * FROM user_addresses WHERE address_id=? AND address_user=?";
        $result = Getter::GetFreeData($sql, [$id, $user_id]);
        if($result) 
        {
            return json_encode($result, JSON_UNESCAPED_UNICODE);
        }
    }
    
}
