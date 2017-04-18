<?php 

class Controller_Catalog extends Controller
{   
    public static function GetData()
    {    
        ShopEngine::Help()->MakeYML();
        
        $category = ShopEngine::GetAction();
        
        if($category === 'all' OR $category === '') {
            $sql = "SELECT * FROM products WHERE avail='1' AND price <> 0.00"; 
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
        $name = Getter::GetFreeData("SELECT name FROM category WHERE category_handle=?", [$category])['name'];
        if($name) return $name;
        else return 'Для красивой улыбки';
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
