<?php

class Image {
    
    public function start()
    {
        if(Request::Post('img')) {
            
            $img_str = Request::Post('img');
            $key     = Request::Post('http_key');
            
            if($key !== Config::$config['http_key'])
            {
                echo 400;
                return false;
            }
            
            $dir      = Request::Post('img_path'); 
            $filename = Request::Post('img_name');
            
            if(file_exists('products_img/'.$dir)) {
                $path = 'products_img/'.$dir.'/';
            }
            else {
                mkdir('products_img/'.$dir.'/');
                $path = 'products_img/'.$dir.'/';
            }
            if(!$dir) {
                if(file_exists('products_img/Uncategorized/')) {
                    $path = 'products_img/Uncategorized/';
                }
                else {
                    mkdir('products_img/Uncategorized/');
                    $path = 'products_img/Uncategorized/';
                }
            }
            
            $path = $path.$filename;
            
            if(file_put_contents($path, base64_decode($img_str)))
            {
                echo 200;
            } else {
                echo 400;
            }
            
        }
    }
    
}