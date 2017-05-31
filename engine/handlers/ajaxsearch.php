<?php

class ajaxsearch {
    
    public function start() 
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST') 
        {
            // Здесь должен проверяться токен, но пока этого нет
            $csrf = Request::Post('csrf');

            $csrf = Request::Post('csrf');
            if(!ShopEngine::Help()->ValidateToken($csrf))
            {
                return false;
            }
            
            $str    = Request::Post('value');
            
            $array  = explode(' ', trim($str));
            
            $string = null;
            
            $place = [];
        
            foreach ($array as $key => $value)
            {
                if(isset($array[$key - 1])) {
                    $string .= " OR ";
                }
                    $string .= "title LIKE ? OR brand LIKE ?";
                    $place[] = "%$value%";
                    $place[] = "%$value%";
            }

            $sql = "SELECT * FROM products WHERE {$string} AND avail='1' AND price <> 0.00 AND title <> ''";

            $result = Getter::GetFreeData($sql, $place, false);
            
            if($result AND count($result) > 0)
            {
                $count = count($result);
                for($i = 0; $i < ( count($result) < 10 ? count($result) : 10 ); $i++)
                {
                echo
                      '<li class="javascript_no_hide">'
                        . '<a href="/products/'.$result[$i]['handle'].'">'
                            . '<span class="thumbnail"><img src="/'.$result[$i]['image'].'"></span>'
                            . '<span class="title"><strong>'.$result[$i]['title'].'</strong></span>'
                            . '<span class="price">'.ShopEngine::Help()->AsPrice($result[$i]['price']).'</span>'
                        . '</a>'
                    . '</li>';
                }
                
                echo 
                      '<li class="javascript_no_hide">'
                        . '<span class="title">'
                            . '<a href="/search/?q='.trim($str).'">See all results ('.$count.')</a>'
                        . '</span>'
                    . '</li>';
                return;
            }
            
            echo '500';
            return false;
        }
    }
            
    
}
