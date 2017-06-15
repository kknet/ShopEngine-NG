<?php

class ajaxsearch {
    
    public $title;
    public $brand;
    
    public function start() 
    {
        
        if($_SERVER['REQUEST_METHOD'] == 'POST') 
        {
            // Token
            $csrf = Request::Post('csrf');

            $csrf = Request::Post('csrf');
            if(!ShopEngine::Help()->ValidateToken($csrf))
            {
                return false;
            }
            
            $str    = Request::Post('value');
            $array  = explode(' ', $str);
            
            //First step
            $sql = "SELECT * FROM products WHERE title LIKE ? OR brand LIKE ? AND avail='1' AND price <> '0.00'";
            $result = Getter::GetFreeData($sql, ['%'.$str.'%', '%'.$str.'%'], false);

            if($result) {
                return $this->Response($result, $str);
            }

            //Second step
            $place   = [];

            foreach ($array as $key => $value)
            {
                if(isset($array[$key - 1])) {
                    $this->title .= " AND ";
                }
                    $this->title .= "title LIKE ?";
                    $place[] = "%$value%";
            }

             foreach ($array as $key => $value)
            {
                if(isset($array[$key - 1])) {
                    $this->brand .= " AND ";
                }
                    $this->brand .= "(title LIKE ? OR brand LIKE ?)";
                    $place[] = "%$value%";
                    $place[] = "%$value%";
            }

            $sql = "SELECT * FROM products WHERE {$this->title} OR {$this->brand} AND avail='1' AND price <> '0.00' AND title <> ''";
            $result = Getter::GetFreeData($sql, $place, false);

            if($result) {
                return $this->Response($result, $str);
            }

            //Last step
            $this->title = null;

            $place = [];

            foreach ($array as $key => $value)
            {
                if(isset($array[$key - 1])) {
                    $this->title .= " OR ";
                }
                    $this->title .= "(title LIKE ? AND avail='1' AND price <> 0.00 AND title <> '') OR (brand LIKE ? AND avail='1' AND price <> 0.00 AND title <> '')";
                    $place[] = "%$value%";
                    $place[] = "%$value%";
            }

            $sql = "SELECT * FROM products WHERE {$this->title} AND avail='1' AND price <> '0.00'";

            $result = Getter::GetFreeData($sql, $place, false);

            if(!$result) {
                echo '500';
                return false;
            }
            return $this->Response($result, $str);

        }
    }
    
    public function Response($result, $str)
    {
         if($result AND count($result) > 0)
        {
            $count = count($result);
            for($i = 0; $i < ( count($result) < 10 ? count($result) : 10 ); $i++)
            {
            echo
                  '<li class="javascript_no_hide search_results_li">'
                    . '<a href="/products/'.$result[$i]['handle'].'">'
                        . '<span class="thumbnail"><img src="/thumbnails/'.$result[$i]['image'].'"></span>'
                        . '<span class="title"><strong>'.$result[$i]['brand'].' '.$result[$i]['title'].'</strong></span>'
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
