<?php

class Business {
    
    public function UsePoints($price)
    {
        if(!Request::GetSession('user_is_logged'))
        {
            return $price;
        }
      
        $id = Request::GetSession('user_id');
        
        $sql  = "SELECT * FROM users WHERE users_id=?";
        $user = Getter::GetFreeData($sql, [$id]);
        
        $points = $user['users_points'];
        
        //60% of price
        $p60 = ($price / 100) * 60;
        
        if($p60 >= $points)
        {
            $final  = $price - $points;
            $points = 0;
        }
        elseif($p60 < $points)
        {
            $final  = $price - $p60;
            $points = $points - ceil($p60);
        }
        
        Request::SetSession('checkout_new_points', $points);
        
        return $final;
        
    }
    
}
