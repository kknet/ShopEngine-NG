<?php 

/*
 * 
 * (!ПЕРЕДЕЛАТЬ) - Перехват ошибок, разбить на несколько методов
 */

class leftSidebar extends Model 
{
    public static function GetLeftSidebar() 
    {
        $sql = "SELECT * FROM table_products WHERE new='1' OR leader='1' OR sale='1' AND visible='1'";
        $count = 3;
        return ShopEngine::GetRandomData($sql, $count);
    }
}
