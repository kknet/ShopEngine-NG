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
        
//        $sql = "SELECT a.attribute_id, a.attribute_name, v.value_name, av.value_id, c.category_id FROM category c "
//                . "LEFT JOIN category_attributes a ON c.category_id = a.category_id "
//                . "LEFT JOIN attribute_value av ON a.attribute_id = av.attribute_id "
//                . "LEFT JOIN value_names v ON av.value_id = v.value_id "
//                . "WHERE c.category_handle=?";
//        $array = Getter::GetFreeData($sql, [$category], false);
//        
//        if($array) {
//            
//            $values = [];
//            
////            for($i = 0; $i < count($array); $i++) {
////                $values[$array[$i]['attribute_id']]['category_id'] = $array[$i]['category_id'];
////                $values[$array[$i]['attribute_id']]['attribute_name'] = $array[$i]['attribute_name'];
////                $values[$array[$i]['attribute_id']]['values'][] = [$array[$i]['value_id'], $array[$i]['value_name']];
////            }
//            
//            var_dump($values);
//            
//            return $values;
//        }
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
