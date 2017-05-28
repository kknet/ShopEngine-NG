<?php

class Controller_404 extends Controller{
    
    public function Action_Basic()
    {
        header("HTTP/1.1 404 Not Found");
        return $this->view->render("404");
    }
    
}
