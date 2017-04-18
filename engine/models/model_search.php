<?php 
/**
* 
*/

class Model_Search extends Model
{		
    public function GetPagination() 
    {
       $main = "/".ShopEngine::GetRoute()[1]."/?q=".Request::Get('q').'&';
       return ShopEngine::Help()->GetPagination($main);
    }
}
