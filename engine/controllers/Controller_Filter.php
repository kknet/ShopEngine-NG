<?php

class Controller_Filter extends Controller{
    
    public function Action_Basic()
    {
        $this->title = "Фильтр";
        
        if(!Request::Get())
        {
            return ShopEngine::Help()->StrongRedirect('catalog', 'all');
        }
        
        $csrf = Request::Get('csrf');
        
        if(!ShopEngine::Help()->ValidateToken($csrf))
        {
            return false;
        }
        
        //Getting products
        $products = $this->GetModel()->Filter();
        
        //Getting Category Name
        $category = Request::Get('category_name');
        
        //Getting Categories
        $filter = $this->GetModel()->FilterCategories();
        
        return $this->view->render(ShopEngine::GetView(), [
            'filter_products' => $products,
            'category_name'   => $category,
            'filter'          => $filter
        ]);
            
            
    }
    
    public function GetPagination() 
    {
        if(Request::Get())
        {
            return $this->GetModel()->GetPagination();
        }
    }
    
}
