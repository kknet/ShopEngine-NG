<?php 
/**
* 
*/

class Model_Filter extends Model
{		
    
    public $vari;
    public $attributes;
    public $start = 0;
    
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
        
        $sql = "SELECT * FROM category c "
                . "LEFT JOIN category_attributes a ON c.category_id = a.category_id "
                . "WHERE c.category_handle=? ORDER BY a.attribute_id DESC";
        $array = Getter::GetFreeData($sql, [$category], false);
        
        if(!$array[0]['attribute_id']) {
            return;
        }
        
        foreach($array as $current) $this->vari[] = $current['attribute_id'];
        
        $placeholders = implode(',', array_fill(0, count($array), '?'));
        
        $sql = "SELECT * FROM attribute_value av "
                . "LEFT JOIN value_names v on av.value_id = v.value_id "
                . "WHERE attribute_id IN ($placeholders) ORDER BY av.attribute_id DESC";
        
        $values = Getter::GetFreeData($sql, $this->vari, false);
        
        for($i = 0; $i < count($array); $i++) {
            
            $this->attributes[$i]['attribute_id']   = $array[$i]['attribute_id'];
            $this->attributes[$i]['attribute_name'] = $array[$i]['attribute_name'];
            
            for($j = $this->start; $j < count($values); $j++) {
                
                if($values[$j]['attribute_id'] !== $array[$i]['attribute_id']) {
                    continue(1);
                }
                
                $this->attributes[$i]['values'][] = [
                    'value_id'   => $values[$j]['value_id'],
                    'name_id'    => $values[$j]['name_id'], 
                    'value_name' => $values[$j]['value_name']
                ];
                
                $this->start = $j;
                
            }
            
        }
        
        return $this->attributes;
    }
}
