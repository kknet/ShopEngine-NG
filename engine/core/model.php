<?php 
class Model extends ShopEngine
{
    protected static $model = null;
    
    public function __cunstruct()
    {
        
    }
    
    public static function getInstance()
    {
        if(self::$model === null) {
            $model = ShopEngine::GetModel();
            self::$model = new $model();
        }
        
        return self::$model;
    }
    
    public function __clone()
    {
        
    }
    
    public function __wakeup() 
    {
        
    }
}
