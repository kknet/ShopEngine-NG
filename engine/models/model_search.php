<?php 
/**
* 
*/

class Model_Search extends Model
{		
    public function GetPagination() 
    {
       $main = "/".ShopEngine::GetRoute()[1]."/?q=".Request::Get('q').'&';
       return ShopEngine::Help()->GetPagination($main);
    }
    
    public function GetProducts($array)
    {
        $string = null;
        foreach ($array as $key => $value)
        {
            if(isset($array[$key - 1])) {
                $string .= " OR ";
            }
                $string .= "title LIKE ? ";
                $array[$key] = "%$value%";
        }
        
        $sql = "SELECT * FROM products WHERE $string AND avail='1' AND price <> 0.00";
        
        $result = Getter::getProducts($sql, $array);
        
        if(!$result) {
            //return Route::ErrorPage404();
        }
        return $result;
    }
    
}
