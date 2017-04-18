<?php 
/**
* 
*/

class Model_Catalog extends Model
{		
    public function GetPagination() 
    {
       $main = "/".ShopEngine::GetRoute()[1]."/".ShopEngine::GetAction().'?';
       return ShopEngine::Help()->GetPagination($main);
    }
}
