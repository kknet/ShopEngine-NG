<?php 

class Controller_Catalog extends Controller
{   
    public function start()
    {
//        //Getting parameters
//        $category = ShopEngine::GetAction();
//        
//        if($category === 'all' OR $category === '') {
//            return false;
//        }
//        
//        $sql = "SELECT * FROM category c LEFT OUTER JOIN category_parameters p ON c.category_id = p.parameter_category_id WHERE c.category_handle=?";
//        $array = Getter::GetFreeData($sql, [$category], false);
//        if($array[0]['parameter_id']) {
//            
//             for ($i = 0; $i < count($array); $i++) {
//                 $id = $array[$i]['parameter_id'];
//                 
//                 $sql = "SELECT * FROM category_parameters_values WHERE parameter_id=?";
//                 $values = Getter::GetFreeData($sql, [$id], false);
//                 
//                 $array[$i]['values'] = $values;
//            }
//            
//            return $array;
//            
//        }
//        
//        return false;

    }
          
    
    public static function GetData()
    {    
        //ShopEngine::Help()->MakeYML();
        
        $category = ShopEngine::GetAction();
        
        if($category === 'all' OR $category === '') {
            $sql = "SELECT * FROM products WHERE avail='1' AND price <> 0.00 AND category_id BETWEEN 1 AND 13"; 
            return Getter::getProducts($sql);
        }

        Self::PageName('Каталог товаров');
        $sql = "SELECT * FROM products WHERE avail='1' AND price <> 0.00 AND category_id = (SELECT category_id FROM category WHERE category_handle=?)";
        $result = Getter::getProducts($sql, [$category]);
        if(!$result) {
            return Route::ErrorPage404();
        }
        return $result;
    }
    
    public static function GetCategoryName()
    {
        $category = ShopEngine::GetAction();
        $array = Getter::GetFreeData("SELECT name FROM category WHERE category_handle=?", [$category]);
        if($array) { 
            if(array_key_exists('name', $array)) { 
                return $array['name'];
            }
        } 
        return 'Для красивой улыбки';
    }

    
    public static function GetPagination() 
    {
        return Self::GetModel()->GetPagination();
    }
    
    public static function GetPageAddress()
    {
        //return "/".ShopEngine::GetRoute()[1]."/".ShopEngine::GetAction();
    }
}
