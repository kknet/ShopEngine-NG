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
            
            $dir      = ShopEngine::Help()->MakeHandle(Request::Post('img_path')); 
            $filename = Request::Post('img_name');
            
            if($dir) { 
            
                if(file_exists('products_img/'.$dir)) {
                    $path = 'products_img/'.$dir.'/';
                }
                else {
                    mkdir('products_img/'.$dir.'/');
                    $path = 'products_img/'.$dir.'/';
                }
                
            }
            else {
                
                if(file_exists('products_img/Uncategorized/')) {
                    $path = 'products_img/Uncategorized/';
                }
                else {
                    mkdir('products_img/Uncategorized/');
                    $path = 'products_img/Uncategorized/';
                }
                
            }
            
            $image = $path.$filename;
            
            if(file_put_contents($image, base64_decode($img_str)))
            {
                
                
                $imagine = new \Imagine\Gd\Imagine;
                
                //Image Resize
                $current = $imagine->open($image);
                if($current->getSize()->getWidth() > 1920 OR $current->getSize()->getWidth() > 1920) {
                    
                    $new_size = new Imagine\Image\Box(1920, 1920);
                    
                    $current->thumbnail($new_size)->save($image);
                    
                }
                
                
                //Thumbnail
                $size    = new Imagine\Image\Box(250, 250);
                
                $thumb = 'thumbnails/'.$path;
                if(!file_exists($thumb))
                {
                    mkdir($thumb, 0777, true);
                }
                
                $imagine->open($image)->thumbnail($size)->save($thumb.$filename);
                
                
                echo 200;
            } else {
                echo 400;
            }
            
        }
    }
    
}