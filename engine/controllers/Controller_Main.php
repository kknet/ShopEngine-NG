<?php 

class Controller_Main extends Controller
{   
    public static function GetData()
    {    
        Self::PageName('Главная');
        $sql = "SELECT * FROM table_products WHERE visible='1'";
        return Controller::GetModel()->getData($sql);
    }

    
    public static function GetPagination() 
    {
        ShopEngine::GetModel()->GetPagination();
    }
    
    public static function GetPageAddress()
    {
        return '/main/';
    }
}
