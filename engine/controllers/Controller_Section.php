<?php 

class Controller_Section extends Controller
{   
    public static function GetData()
    {    
        $category = ShopEngine::GetAction();
        
        $sql = "SELECT * FROM products WHERE avail='1' AND price <> 0.00 AND category_id IN (SELECT category_id FROM category WHERE section=?)";
        $result = Getter::getProducts($sql, [$category]);
        if(!$result) {
            return Route::ErrorPage404();
        }
        return $result;         
    }
    
    public static function SetView() {
        return 'View_Catalog';
    }
    
    public static function GetCategoryName()
    {
        $category = ShopEngine::GetAction();
        
        switch ($category) {
            case 'children':
                return 'Для детей';
                break;
            case 'dentist':
                return 'Для стоматологов';
                break;
            default:
                return 'Для красивой улыбки';
                break;
        }
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
