<?php

class imagedropper {
    
    public function start()
    {
        if(isset($_POST['img_name']) AND $_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $key = Request::Post('http_key');
            
            if($key !== Config::$config['http_key'])
            {
                return false;
            }
            
            $img_dir = Request::Post('img_name');
            $thumb   = 'thumbnails/'.$img_dir;
            
            if(file_exists($img_dir))
            {
                unlink($img_dir);
                unlink($thumb);
                echo 200;return;
            }
            echo 400;return;
        }
        echo 500;
    }
    
}
