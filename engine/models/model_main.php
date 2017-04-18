<?php 
/**
* 
*/

class Model_Main extends Model
{		
    public function GetPagination() 
    {
       $main = '/main/?';
       return ShopEngine::Help()->GetPagination($main);
    }
}
