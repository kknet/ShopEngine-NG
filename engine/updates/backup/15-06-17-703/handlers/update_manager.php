<?php

class update_manager {
    
    public $dirs;
    public $hash;
    public $updates = '../engine/updates/';
    public $temp    = '../engine/updates/temp/';
    
    public function start()
    {   
        if($_SERVER['REQUEST_METHOD'] !== "POST")
        {
            return false;
        }
        
        if(!$_FILES['file'])
        {
            return false;
        }
        
        $trans_key = Request::Post('trans_key');
        
        //if smth
        
        if(!file_exists($this->updates))
        {
            mkdir($this->updates);
        }
        
        if(file_exists($this->updates.'last_update.zip'))
        {
            unlink($this->updates.'/last_update.zip');
        }
        
        //Put file
        $new_file = $this->updates.$_FILES['file']['name'];
        
        copy($_FILES['file']['tmp_name'], $new_file);
        
        //Unzip
        $password = Config::$dev['zip_config'];
        
        if(file_exists($this->temp))
        {
            $this->deleteDir($this->temp);
        }
        
        mkdir($this->temp);
       
        $zip = new ZipArchive();
        $zip->open($new_file);
        $result = $zip->extractTo($this->temp);
        if(!$result)
        {
            return false;
        }
        
        //I'll fix it :D
        $temp_dest = "../engine/updates/temp/engine/updates/temp/";
        
        $temp = scandir($temp_dest);
        
        for($i = 2, $c = count($temp); $i < $c; $i++)
        {
            $this->dirs[$temp[$i]] = scandir($temp_dest.$temp[$i]); 
        }
        
        $hash = $this->makeHash(Config::$dev, $this->dirs, $temp_dest);
        
        if($hash !== $trans_key)
        {
            $this->deleteTemp();
            return false;
        }
        
        //$this->updateEngine($temp_dest);
        //$this->deleteTemp();
        return true;
    }
    
    public function updateEngine($temp_dest)
    {
        //Some...
    }
    
    public function deleteTemp()
    {
        $this->deleteDir($this->temp);
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
    
    public function makeHash($site, $dirs, $dist)
    {
        
        asort($dirs);
        
        foreach($dirs as $key => $value)
        {
            
            for($i = 2, $c = count($value); $i < $c; $i++) {
                
                $content = $this->hash.file_get_contents($dist.$key.'/'.$value[$i]).$site['app_key'];
                
                $this->hash = hash("sha256", $content);
                
            }
            
        }
        
        return $this->hash;
    }
    
}
