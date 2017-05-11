<?php 
/**
* 
*/

class Model_Section extends Model
{		
    public function GetPagination() 
    {
       $main = "/".ShopEngine::GetRoute()[1]."/".ShopEngine::GetAction().'?';
       return ShopEngine::Help()->GetPagination($main);
    }
    
    public function GetProducts($category)
    {
        $sql = "SELECT * FROM products WHERE avail='1' AND price <> 0.00 AND category_id IN (SELECT category_id FROM category WHERE section=?)";
        $result = Getter::getProducts($sql, [$category]);
        if(!$result) {
            return Route::ErrorPage404();
        }
        return $result;
    }
    
    public function GetCategoryName($category)
    {
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
}
