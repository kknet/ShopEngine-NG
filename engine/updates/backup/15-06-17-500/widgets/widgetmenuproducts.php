<?php

class WidgetMenuProducts {
    
    public $products;
    
    public function __construct() {
        $sql = "SELECT * FROM products WHERE avail='1' LIMIT 3";
        $this->products = Getter::GetFreeProducts($sql);
    }
    
    public function GetProducts()
    {
        return $this->products;
    }
    
}
