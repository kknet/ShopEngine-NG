<?php

class selectregion {
    
    public function start() 
        {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                
                $db = database::getInstance();
            
                $id    = Request::Post('id');
                $csrf  = Request::Post('csrf');
                
                if(!ShopEngine::Help()->ValidateToken($csrf))
                {
                    return false;
                }
                
                $sql     = "SELECT * FROM region WHERE country_id IN ("
                         . "SELECT country_id FROM countries WHERE country_handle = ?) AND region_avail = '1'";
                
                $region = Getter::GetFreeData($sql, [$id], false);
                
                if(!$region) {
                    echo 500; return;
                }
                
                echo '<option selected value="" disabled="">Регион</option>';
                
                foreach ($region as $reg) { 
                    echo '<option value="'.$reg["region_handle"].'" >'.$reg["region_name"].'</option>';
                }
            }
        }
    
}
