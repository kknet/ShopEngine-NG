<?php

class buybypoints {
    
    public function start()
    {
        if ($_SERVER["REQUEST_METHOD"] != "POST") {
            return false;
        }
        
        $csrf  = ShopEngine::Help()->Clear($_POST['csrf']);
        
        if(!ShopEngine::Help()->ValidateToken($csrf))
        {
            return false;
        }
        
        Request::SetSession('checkout_points_enabled', true);
        
        return 1;
    }
    
}
