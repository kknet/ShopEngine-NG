<?php 

class Controller_Search extends Controller
{   
    public static $count;
    
    public function Action_Basic()
    {    
        //Getting parameter
        $query = Request::Get('q');
        $array = explode(' ', $query);
        
        //Getting products
        $products = $this->GetModel()->GetProducts($array);
        
        //Entering into session
        Request::SetSession('query', $query);
        
        //Getting count
        if($products) { 
            $count = count($products);
        }
        
        
        return $this->view->render(ShopEngine::GetView(), [
            'search_products' => $products,
            'search_count'    => $count
        ]);
    }
    
    public function GetPagination() 
    {
        return $this->GetModel()->GetPagination();
    }
}
