<?php

class Controller_Filter extends Controller{
    
    public function start()
    {
        if(!Request::Get())
        {
            return ShopEngine::Help()->StrongRedirect('catalog', 'all');
        }
        
        $keys  = Request::Get('filter_keys');
        $type  = Request::Get('filter_category');
        $price = Request::Get('filter_price');
        
        $query  = null;
        $first  = true;
        $params = [];
        
        if($type) {
            $temp      = " category_id=?";
            $params[]  = $type;
            if(!$first) {
                $query .= ' AND'.$temp;
            } else {
                $query .= $temp;
                $first = false;
            }
        }
        
        if($price) {
            $temp      = " price <= ?";
            $params[]  = $price;
            if(!$first) {
                $query    .= ' AND'.$temp;
            } else {
                $query .= $temp;
                $first    = false;
            }
        }
        
        $sql   = "SELECT * FROM products WHERE {$query} AND avail='1' AND price <> 0.00";
        $array['products'] = Getter::getProducts($sql, $params);
        return $array;
    }
    
    public static function GetPagination() 
    {
        if(Request::Get())
        {
            return Self::GetModel()->GetPagination();
        }
    }
    
}
