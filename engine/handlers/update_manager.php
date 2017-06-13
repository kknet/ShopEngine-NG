<?php

class update_manager {
    
    public function start()
    {   
        if($_SERVER['REQUEST_METHOD'] !== "POST")
        {
            return false;
        }
        
        $http_key = Request::Post('http_key');
        if($http_key !== Config::$config['http_key'])
        {
            return false;
        }
        
        if(!$_FILES['file'])
        {
            return false;
        }
        
        //if smth
        
        if(!file_exists('../engine/updates/'))
        {
            mkdir('../engine/updates/');
        }
        
        if(file_exists('../engine/updates/last_update.zip'))
        {
            unlink('../engine/updates/last_update.zip');
        }
        
        //Put file
        $new_file = '../engine/updates/'.$_FILES['file']['name'];
        
        copy($_FILES['file']['tmp_name'], $new_file);
        
        //Unzip
        $password = Config::$dev['zip_config'];
        
        if(file_exists('../engine/updates/'))
        {
            $this->deleteDir('../engine/updates/');
        }
        
        system("unzip -P $password $new_file");
    }
    
    public function deleteDir($dirPath)
    {
        if (!is_dir($dirPath)) {
            //
        }
        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
            $dirPath .= '/';
        }
        $files = glob($dirPath . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                $this->deleteDir($file);
            } else {
                unlink($file);
            }
        }
        rmdir($dirPath);
    }
    
}
