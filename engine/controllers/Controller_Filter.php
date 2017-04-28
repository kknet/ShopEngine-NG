<?php

class Controller_Filter extends Controller{
    
    public function start()
    {
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
        $filter['products'] = Controller::GetModel()->Filter();
        
        //Getting Category Name
        $category = Request::Get('category_name');
        $filter['category_name'] = $category;
        
        //Getting Categories
        $filter['filter'] = Controller::GetModel()->FilterCategories();
        
        return $filter;
            
            
    }
    
    public static function GetPagination() 
    {
        if(Request::Get())
        {
            return Self::GetModel()->GetPagination();
        }
    }
    
}
