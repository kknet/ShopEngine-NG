<?php 
/**
* 
*/

class Model_Catalog extends Model
{		
    
    public $vari;
    public $attributes;
    public $start = 0;
    
    public function GetPagination() 
    {
       $main = "/".ShopEngine::GetRoute()[1]."/".ShopEngine::GetAction().'?';
       return ShopEngine::Help()->GetPagination($main);
    }
    
    public function GetFilter($category)
    {   
        //Temporary
        
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
    
    public function GetProducts($category)
    {
        if($category === 'all' OR $category === '') {
            $sql = "SELECT * FROM products WHERE avail='1' AND price <> 0.00 AND category_id BETWEEN 1 AND 13"; 
            $products = Getter::getProducts($sql);
        }
        else {
            $sql = "SELECT * FROM products WHERE avail='1' AND price <> 0.00 AND category_id = (SELECT category_id FROM category WHERE category_handle=?)";
            $products = Getter::getProducts($sql, [$category]);
            if(!$products) {
                return false;
            }
        }
        
        return $products;
    }
    
    public function GetCategoryName($category)
    {
        $array = Getter::GetFreeData("SELECT name FROM category WHERE category_handle=?", [$category]);
        if($array) { 
            if(array_key_exists('name', $array)) { 
                $category_name = $array['name'];
            }
        }
        else {
            $category_name = 'Для красивой улыбки';
        }
        
        return $category_name;
    }
}
