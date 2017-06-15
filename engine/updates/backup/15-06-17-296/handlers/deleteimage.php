<?php

class Deleteimage {
   
    public function start()
    {
        if(isset($_POST['img']) AND $_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $key = Request::Post('http_key');
            
            if($key !== Config::$config['http_key'])
            {
                return false;
            }
            
            $img = Request::Post('img');
            
            if(file_exists($img))
            {
                unlink($img);
                echo 200;
                return;
            }
            
            echo 400;
        }
    }
    
}
