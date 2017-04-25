<?php

class Paginator extends ShopEngine {
    
    public static function PreparePagination($sql, $params = NULL, $num = 20)
    {
        if(Self::$query === NULL OR Self::$sort === NULL)
        {
            $params = $params;
            
            $array = ShopEngine::Help()->Sorting();
            Self::$qsort = $array['sorting_db'];	
            Self::$sort = $array['sorting'];
            
            if(array_key_exists("page", $_GET)) { 
                $page = (int)$_GET["page"];
            } else {
                $page = 1;
            }
            $count = ShopEngine::Help()->Count($sql, $params);
            
            if($count > 0) 
            {

                $total = (($count - 1) / $num) + 1;
                $total = intval($total);

                Self::$page = intval($page);

                if(empty(Self::$page) or Self::$page < 0) 
                {
                    Self::$page = 1;
                }
                if(Self::$page > $total) 
                {
                    Self::$page = $total;
                }

                $start = Self::$page * $num - $num;

                Self::$query = " LIMIT $start, $num";
                
                $uri = null;

                if (Self::$page < 10) 
                {
                    $uri = substr($uri,0,-7);
                }

                if ($page >= 10) 
                {
                    $uri = substr($uri,0,-8);
                }
                
                parent::$total = $total;
            }
        }
        
        return [Self::$sort, Self::$query, Self::$page, Self::$total, Self::$qsort];
    }
    
}
