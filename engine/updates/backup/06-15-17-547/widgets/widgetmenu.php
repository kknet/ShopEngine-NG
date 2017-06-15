<?php

class WidgetMenu {
    
    public $menu;
    
    public function __construct()
    {
        $sql = "SELECT * FROM category WHERE main='1'";
        $this->menu = Getter::GetFreeData($sql,null,false);
    }
    
    public function GetMenu()
    {
        return $this->menu;
    }
    
}
