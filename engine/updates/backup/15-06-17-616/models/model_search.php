<?php 
/**
* 
*/

class Model_Search extends Model
{		
    
    public $title;
    public $brand;
    
    public function GetPagination() 
    {
       $main = "/".ShopEngine::GetRoute()[1]."/?q=".Request::Get('q').'&';
       return ShopEngine::Help()->GetPagination($main);
    }
    
    public function GetProducts($array, $str)
    {
        //First step
        $sql = "SELECT * FROM products WHERE title LIKE ? OR brand LIKE ? AND avail='1' AND price <> '0.00'";
        $result = Getter::GetProducts($sql, ['%'.$str.'%', '%'.$str.'%']);
        
        if($result) {
            return $result;
        }
        
        //Second step
        $place   = [];
        
        foreach ($array as $key => $value)
        {
            if(isset($array[$key - 1])) {
                $this->title .= " AND ";
            }
                $this->title .= "title LIKE ?";
                $place[] = "%$value%";
        }
        
         foreach ($array as $key => $value)
        {
            if(isset($array[$key - 1])) {
                $this->brand .= " AND ";
            }
                $this->brand .= "(title LIKE ? OR brand LIKE ?)";
                $place[] = "%$value%";
                $place[] = "%$value%";
        }
        
        $sql = "SELECT * FROM products WHERE {$this->title} OR {$this->brand} AND avail='1' AND price <> '0.00' AND title <> ''";
        $result = Getter::getProducts($sql, $place);
        
        if($result) {
            return $result;
        }
        
        //Last step
        $this->title = null;
        
        $place = [];
        
        foreach ($array as $key => $value)
        {
            if(isset($array[$key - 1])) {
                $string .= " OR ";
            }
                $string .= "(title LIKE ? AND avail='1' AND price <> 0.00 AND title <> '') OR (brand LIKE ? AND avail='1' AND price <> 0.00 AND title <> '')";
                $place[] = "%$value%";
                $place[] = "%$value%";
        }
        
        $sql = "SELECT * FROM products WHERE $string AND avail='1' AND price <> '0.00'";
        
        $result = Getter::getProducts($sql, $place);
        
        if(!$result) {
            //return Route::ErrorPage404();
        }
        return $result;
    }
    
}
