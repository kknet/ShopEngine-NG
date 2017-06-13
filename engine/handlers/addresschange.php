<?php

class AddressChange {
    
    public $countries_html;
    public $regions_html;
    
    public function start()
    {
        if ($_SERVER["REQUEST_METHOD"] != "POST") {
            return false;
        }
            
        $id    = Request::Post('id');
        $csrf  = Request::Post('csrf');

        $user_id = Request::GetSession('user_id');
        
        if(!ShopEngine::Help()->ValidateToken($csrf))
        {
            return false;
        }
        
        $sql    = "SELECT * FROM user_addresses WHERE address_id=? AND address_user=?";
        $result = Getter::GetFreeData($sql, [$id, $user_id]);
        
        $sql = "SELECT * FROM countries WHERE country_avail = '1'";
        $countries = Getter::GetFreeData($sql,null,false);
        
        //TEMPORARY!
        
            $sql     = "SELECT * FROM region WHERE country_id IN ("
                     . "SELECT country_id FROM countries WHERE country_handle = ?) AND region_avail = '1'";
            $regions = Getter::GetFreeData($sql, [$result['address_country']],false);
            
        foreach($countries as $country) {
            
            $selected = $country['country_handle'] === $result['address_country'] ? 'selected' : '';
            
            $this->countries_html .= '<option '.$selected.' class="select_country" value="'.$country['country_handle'].'" >'.$country['country_name'].'</option>';
            
        }
        
        $result['countries_html'] = $this->countries_html;
        
        foreach($regions as $region) {
            
            $selected = $region['region_handle'] === $result['address_region'] ? 'selected' : '';
            
            $this->regions_html .= '<option '.$selected.' class="select_country" value="'.$region['region_handle'].'" >'.$region['region_name'].'</option>';
            
        }
        
        $result['regions_html'] = $this->regions_html;
            
        if($result) 
        {
            return json_encode($result, JSON_UNESCAPED_UNICODE);
        }
    }
    
}
