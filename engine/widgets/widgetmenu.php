<?php

/*
 * 
 * 
 * Временное решение!
 */


class WidgetMenu {
    
    public $controller_main;
    public $controller_products;
    public $controller_admin;
    public $controller_orders;
    public $controller_category;
    public $controller_filters;
    public $controller_delivery;
    
    public $action_products;
    public $action_new_prod;
    public $action_export;
    public $action_import;
    public $action_categories;
    public $action_category_list;
    public $action_category_add;
    public $action_filters;
    public $action_filters_list;
    public $action_filters_add;
    public $action_delivery_regions;
    public $action_delivery_list;
    public $action_delivery_add;
    
    public function __construct() {
        $controller = ShopEngine::GetController();
        $action     = ShopEngine::GetAction();
        
        switch ($controller) {
            case 'Controller_Main' :
                $this->controller_main = 'open';
                break;
            case 'Controller_Products' :
                $this->controller_products = 'open';
                
                switch ($action) {
                    case 'change' :
                    $this->action_products = 'active';
                    break;
                    case 'list' :
                    $this->action_products = 'active';
                    break;
                    case 'add' :
                    $this->action_new_prod = 'active';
                    break;
                }
                
                break;
            case 'Controller_Admin' :
                $this->controller_admin = 'open';
                break;
            case 'Controller_Orders' :
                $this->controller_orders = 'open';
                break;
            case 'Controller_Category' :
                $this->controller_category = 'open';
                
                    switch($action) {
                    case 'list' :
                    $this->action_category_list = 'active';
                    break;
                    case 'add' :
                    $this->action_category_add = 'active';
                    break;
                
                }
                break;
            case 'Controller_Filters' :
                $this->controller_filters = 'open';
                
                    switch($action) {
                    case 'list' :
                    $this->action_filters_list = 'active';
                    break;
                    case 'add' :
                    $this->action_filters_add = 'active';
                    break;
                
                }
                break;
            case 'Controller_Delivery' : 
                $this->controller_delivery = 'open';
                
                    switch($action) {
                    case 'regions' :
                    $this->action_delivery_regions = 'active';
                    break;
                    case 'list' :
                    $this->action_delivery_list = 'active';
                    break;
                    case 'add' :
                    $this->action_delivery_add = 'active';
                    break;
                
                }
                break;
            default :
                break;
        }
        
        switch($action) {
            case 'export' :
                $this->action_export = 'active';
                break;
            case 'import' :
                $this->action_import = 'active';
                break;
            case 'categories' :
                $this->action_categories = 'active';
                break;
            case 'add_category' :
                $this->action_categories = 'active';
                break;
            case 'change_category' :
                $this->action_categories = 'active';
                break;
            case 'filters' :
                $this->action_filters = 'active';
                break;
            default :
                break;
        }
    }
    
    
    //Controllers
    public function Controller_Main()
    {
        return $this->controller_main;
    }
    
    public function Controller_Products()
    {
        return $this->controller_products;
    }
    
    public function Controller_Category()
    {
        return $this->controller_category;
    }
    
    public function Controller_Admin()
    {
        return $this->controller_admin;
    }
    
    public function Controller_Orders()
    {
        return $this->controller_orders;
    }
    
    public function Controller_Filters()
    {
        return $this->controller_filters;
    }
    
    public function Controller_Delivery()
    {
        return $this->controller_delivery;
    }
    
    //Actions
    public function Action_Products()
    {
        return $this->action_products;
    }
    
    public function Action_New_Prod()
    {
        return $this->action_new_prod;
    }
    
    public function Action_Export()
    {
        return $this->action_export;
    }
    
    public function Action_Import()
    {
        return $this->action_import;
    }
    
    public function Action_Categories()
    {
        return $this->action_categories;
    }
    
    public function Action_Filters()
    {
        return $this->action_filters;
    }
    
    public function Action_Filters_List()
    {
        return $this->action_filters_list;
    }
    
    public function Action_Filters_Add()
    {
        return $this->action_filters_add;
    }
    
    public function Action_Category_List()
    {
        return $this->action_category_list;
    }
    
    public function Action_Category_Add()
    {
        return $this->action_category_add;
    }
    
    public function Action_Delivery_Regions()
    {
        return $this->action_delivery_regions;
    }
    
    public function Action_Delivery_List()
    {
        return $this->action_delivery_list;
    }
    
    public function Action_Delivery_Add()
    {
        return $this->action_delivery_add;
    }
    
}
