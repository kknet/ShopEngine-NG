<?php 
/**
* 
*/

class Model_Catalog extends Model
{		
    public function GetPagination() 
    {
       $main = "/".ShopEngine::GetRoute()[1]."/".ShopEngine::GetAction().'?';
       return ShopEngine::Help()->GetPagination($main);
    }
    
    public function GetFilter($category)
    {
        $sql = "SELECT * FROM category c "
                . "LEFT OUTER JOIN category_attributes a ON c.category_id = a.category_id "
                . "WHERE c.category_handle=?";
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
                return Route::ErrorPage404();
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
