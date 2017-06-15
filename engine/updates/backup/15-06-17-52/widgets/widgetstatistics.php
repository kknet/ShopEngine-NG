<?php


class WidgetStatistics {
    
    public $orders;
    public $views;
   
    public function __construct() {
        $sql = "SELECT COUNT(*) FROM orders WHERE orders_status='1'"; 
        $this->orders = Getter::GetFreeData($sql)['COUNT(*)'];
        
        $sql = "SELECT * FROM info WHERE name='views'";
        $this->views = Getter::GetFreeData($sql)['val_int'];
    }
    
    public function GetOrderCount()
    {
        return $this->orders;
    }
    
    public function GetViewCount()
    {
        return $this->views;
    }
    
}
