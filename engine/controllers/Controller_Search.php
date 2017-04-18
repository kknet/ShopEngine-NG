<?php 

class Controller_Search extends Controller
{   
    public static $count;
    
    public static function GetData()
    {    
        $category = ShopEngine::GetAction();
        
        $query = Request::Get('q');
        $array = explode(' ', $query);
        foreach ($array as $key => $value)
        {
            if(isset($array[$key - 1])) {
                $string .= " OR ";
            }
                $string .= "title LIKE ? ";
                $array[$key] = "%$value%";
        }
        
        Request::SetSession('query', $query);
        $sql = "SELECT * FROM products WHERE $string AND avail='1' AND price <> 0.00";
        $result = Getter::getProducts($sql, $array);
        self::$count = ShopEngine::Help()->Count($sql, $array);
        if(!$result) {
            //return Route::ErrorPage404();
        }
        return $result;
    }
    
    public static function GetCategoryName()
    {
        return 'Результаты поиска';
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
