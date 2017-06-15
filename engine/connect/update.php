<?php

class Update {
    
    public $dirs;
    public $hash;
    public $updates = '../engine/updates/';
    public $temp    = '../engine/updates/temp/';
    
    public function start()
    {   
        
        //include config
        require('../engine/config/config.php');
        
        if($_SERVER['REQUEST_METHOD'] !== "POST")
        {
            return false;
        }
        
        if(Config::$config['http_key'] !== $_POST['http_key'])
        {
            return false;
        }
        
        if(!$_FILES['file'])
        {
            return false;
        }
        
        $trans_key = $_POST['trans_key'];
        
        if(!$trans_key)
        {
            return false;
        }
        
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
        //$password = Config::$dev['zip_config'];
        
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

        if(!$this->updateEngine($temp_dest))
        {
            return false;
        }
       
        echo 'success!';
        
        return true;
    }
    
    public function updateEngine($temp_dest)
    {
        //Make backup
        $this->makeBackup();
        
        $array = scandir($temp_dest);
        
        $temp = [];
        
        for($i = 2, $c = count($array); $i < $c; $i++)
        {
            $temp[$array[$i]] = scandir($temp_dest.$array[$i]);
        }
        
        //Delete and put
        foreach ($temp as $dir_name => $dir_array)
        {
            
            for($i = 2, $c = count($dir_array); $i < $c; $i++)
            {   
                //unlink old
                unlink('../engine/'.$dir_name.'/'.$dir_array[$i]);
                
                //put new
                copy($temp_dest.$dir_name.'/'.$dir_array[$i], '../engine/'.$dir_name.'/'.$dir_array[$i]);
                
            }
            
        }
        
        //Delete temp
        if(file_exists($this->temp))
        {
            $this->deleteDir($this->temp);
        }
        
        return true;
        
    }
    
    public function makeBackup()
    {
        
        $backup_dir = '../engine/updates/backup/';
        
        $array = scandir('../engine/');
        
        //create local array
        $dirs = [];
        
        for($i = 2, $c = count($array); $i < $c; $i++)
        {
            
            $dirs[$array[$i]] = scandir('../engine/'.$array[$i]);
            
        }
        
        //unset non-updatable directories
        unset($dirs['connect']);
        unset($dirs['config']);
        
        if(!file_exists($backup_dir))
        {
            mkdir($backup_dir);
        }
        
        //Create new directory
        $new_backup_name = $backup_dir.date("d-m-y").'-'.rand(0,777).'/';
        
        mkdir($new_backup_name);
        
        foreach($dirs as $dir_name => $dir_files)
        {
            
            for($i = 2, $c = count($dir_files); $i < $c; $i++) { 
            
                if(!file_exists($new_backup_name.$dir_name))
                {
                    mkdir($new_backup_name.$dir_name);
                }
                
                copy('../engine/'.$dir_name.'/'.$dir_files[$i], $new_backup_name.$dir_name.'/'.$dir_files[$i]);
            
            }
            
        }
        
        
        
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
