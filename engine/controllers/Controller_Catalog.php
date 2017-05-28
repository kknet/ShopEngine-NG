<?php 

class Controller_Catalog extends Controller
{   
    
    public $category_name;
    
    public function Action_Basic()
    {
        
        // Getting parameter
        $category = ShopEngine::GetAction();
        
        //Getting Filter Information
        $filter   = $this->GetModel()->GetFilter($category);
        
        //Getting products
        $products = $this->GetModel()->GetProducts($category);
 
        //Getting category_id
        $sql         = "SELECT * FROM category WHERE category_handle = ?";
        $category    = Getter::GetFreeData($sql, [$category], true);
        
        $category_id = $category['category_id'];
        
        //Getting category name
        $this->category_name = $category['name'] ?? 'Каталог товаров';
        
        //Set title
        $this->title = $this->category_name;
       
        return $this->view->render(ShopEngine::GetView(), [
            'filter'        => $filter,
            'cat_products'  => $products,
            'category_name' => $this->category_name,
            'category_id'   => $category_id
        ]);

    }
    
    public function SEO() {
        return [
            'name' => [
                'description' => 'Каталог товаров: '.$this->category_name
            ]
        ];
    }
    
    public function GetPagination() 
    {
        return $this->GetModel()->GetPagination();
    }
}
