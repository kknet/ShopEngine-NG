<?php 

class Controller_Main extends Controller
{   
    public function Action_Basic()
    {
        $sql = "SELECT * FROM products WHERE avail <> '0' AND price <> 0.00 AND category_id BETWEEN 1 AND 13"; 
        $products = Getter::getProducts($sql, null, 10);
        
        return $this->view->render(ShopEngine::GetView(), [
            'main_products' => $products
        ]);
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

    
    public function GetPagination() 
    {
        return $this->GetModel()->GetPagination();
    }
    
    public static function GetPageAddress()
    {
        //return "/".ShopEngine::GetRoute()[1]."/".ShopEngine::GetAction();
    }
}
