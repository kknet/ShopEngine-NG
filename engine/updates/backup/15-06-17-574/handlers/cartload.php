<?php 

class cartload 
{
    public function start() 
    {

        if($_SERVER['REQUEST_METHOD'] == 'POST') 
        {
            // Здесь должен проверяться токен, но пока этого нет
            $csrf = ShopEngine::Help()->Clear($_POST['csrf']);
            
            $csrf = Request::Post('csrf');
            if(!ShopEngine::Help()->ValidateToken($csrf))
            {
                return false;
            }
            
            $db = database::getInstance();
            $ip = ShopEngine::GetUserIp();
            $result = $db->prepare("SELECT * FROM cart WHERE cart_ip=?");
            $result->execute([$ip]);
            
            $array = $result->fetchAll();
            if(count($array) > 0) {
                echo 1;
            }
            else {
                echo 0;
            }
            
        }

    }
}