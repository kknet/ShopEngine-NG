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
            
            $not_first = null;
            $temp      = null;
            $param     = [];
            foreach ($custom as $key => $value) {
                foreach ($value as $key_2 => $value_2) { 
                    $temp .= $not_first." value_id=?";
                    $not_first = " OR";
                    $param[] = $value_2;    
                }
            }
            
            $sql = "SELECT products_id, COUNT(*) FROM products_values WHERE {$temp} GROUP BY products_id";
            
            $array = Getter::GetFreeData($sql, $param, false);
            
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
            
            if($IDs) { 
            
                $sql = "SELECT * FROM products WHERE products_id IN({$temp})";
                return Getter::GetProducts($sql, $IDs);
                
            }
            
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
