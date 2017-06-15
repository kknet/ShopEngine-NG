<?php 

class Controller_Section extends Controller
{   
    public function Action_Basic()
    {    
        //Getting parameter
        $category = ShopEngine::GetAction();
        
        //Getting products
        $products = $this->GetModel()->GetProducts($category);
        
        //Getting Category_name
        $category_name = $this->GetModel()->GetCategoryName($category);
        
        //Getting category_id
        $sql         = "SELECT category_id FROM category WHERE category_handle = ?";
        $category_id = Getter::GetFreeData($sql, [$category], true)['category_id'];
        
        $this->title = $category_name;
        
        return $this->view->render("View_Catalog", [
            'cat_products'  => $products,
            'category_name' => $category_name,
            'category_id'   => $category_id
        ]);
          
    }
    
    public function SEO()
    {
        return [
            'name' => [
                'description' => 'Каталог товаров: '.$this->title
            ]
        ];
    }
    

    public function GetPagination() 
    {
        return $this->GetModel()->GetPagination();
    }
}
