<?php

class WidgetMainMenu {
    
    public function __construct()
    {
        
    }
    
    public function GetMenuDentists()
    {
        $db = database::getInstance();
        
        $sql = "SELECT * FROM category WHERE section='dentist'";
        
        return Getter::GetFreeData($sql, null, false);
    }
    
    public function GetMostViewedProduct()
    {
        $db = database::getInstance();
        
        $sql = "SELECT * FROM products WHERE old_price <> 0 ORDER BY viewed DESC LIMIT 1";
        
        return Getter::GetFreeData($sql, null, true);
    }
    
}
