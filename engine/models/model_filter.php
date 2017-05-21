<?php 
/**
* 
*/

class Model_Filter extends Model
{		
    public function GetPagination() 
    {
       $main = "/".ShopEngine::GetRoute()[1]."/".ShopEngine::GetAction().'&';
       return ShopEngine::Help()->GetPagination($main);
    }
    
    public function Filter()
    {
        if($custom = Request::Get('custom'))
        {
            $price = Request::Get('filter_price');
            $cat   = Request::Get('filter_category');
            $keys  = explode(',', Request::Get('filter_keys'));
            
            $filter_start = null;
            
            $query  = null;
           
            $not_first = null;
            $temp      = null;
            $str       = null;
            $param     = [];
            foreach ($custom as $key => $value) {
                foreach ($value as $key_2 => $value_2) { 
                   
                    $param[] = $value_2;    
                    
                    //Set price and category
                    if($price){
                        $query    .= $filter_start." p.price <= ?";
                        $param[] = $price;
                        $filter_start = " AND";
                    }
                    if($cat) {
                        $query    .= $filter_start." p.category_id = ?";
                        $param[] = $cat;
                        $filter_start = " AND";
                    }
                    
                    //Set keys
                    for($i = 0; $i < count($keys); $i++) {
                        $key = trim($keys[$i]);
                        
                        $str .= " AND p.title LIKE ?";
                        $param[] = "%".$key."%";
                    }
                    
                    $temp .= $not_first." (v.value_id=? AND {$query} {$str})";  
                    $str   = null;
                    
                    $query = null;
                    $filter_start = null;
                    
                    $not_first = " OR";
                }
            }

            $sql = "SELECT v.products_id, COUNT(*) FROM products_values v RIGHT JOIN products p ON v.products_id = p.products_id WHERE {$temp} GROUP BY products_id";
            
            $array = Getter::GetFreeData($sql, $param, false);           
            if(!$array)
            {
                return false;
            }
            
            $count = count($custom);
            
            $not_first = null;
            $temp      = null;
            foreach ($array as $cur) 
            {
                if((int)$cur['COUNT(*)'] === $count) 
                {
                    $IDs[] = $cur['products_id'];
                    $temp .= $not_first." ?";
                    $not_first = ",";
                }
                
            } 
            
            if(isset($IDs) AND $IDs) {
                
                $sql = "SELECT * FROM products WHERE products_id IN({$temp})";
                return Getter::GetProducts($sql, $IDs);
                
            }
            
        }
        
        else {
            $price = Request::Get('filter_price');
            $cat   = Request::Get('filter_category');
            $keys  = explode(',', Request::Get('filter_keys'));
            
            $filter_start = null;
            
            $param = [];
            $query  = null;
            $str    = null;
            
            if($price){
                $query    .= $filter_start." price <= ?";
                $param[] = $price;
                $filter_start = " AND";
            }
            if($cat) {
                $query    .= $filter_start." category_id = ?";
                $param[] = $cat;
                $filter_start = " AND";
            }
            
            for($i = 0; $i < count($keys); $i++) {
                $key = trim($keys[$i]);

                $str .= $filter_start." title LIKE ?";
                $param[] = "%".$key."%";
            }
            
            $sql = "SELECT * FROM products WHERE {$query} {$str} AND title <> '' AND avail = '1'";
            return Getter::GetProducts($sql, $param);
        }

    }
    
    public function FilterCategories()
    {
        $category = Request::Get('category_name');
        
        if($category === 'all' OR $category === '') {
            return false;
        }
        
        $sql = "SELECT * FROM category c LEFT OUTER JOIN category_attributes a ON c.category_id = a.category_id WHERE c.category_handle=?";
        $array = Getter::GetFreeData($sql, [$category], false);
        
        if($array[0]['attribute_id']) {
            
            for($i = 0; $i < count($array); $i++) {
                $id = $array[$i]['attribute_id'];
                
                $sql = "SELECT * FROM attribute_value a RIGHT OUTER JOIN value_names n ON a.value_id = n.value_id WHERE attribute_id=?";
                
                $values = Getter::GetFreeData($sql, [$id], false);
                
                $array[$i]['values'] = $values;
            }
            
            return $array;
            
        }
    }
}
