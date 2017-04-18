<?php

class Request extends ShopEngine{
    
    protected static $post = [];
    protected static $get  = [];

    public static function Post($name = null)
    {
        if(self::$post[$name] === null) {
            if($name !== null) {
                if(isset($_POST[$name])) {
                    self::$post[$name] = $_POST[$name];
                }
                return self::$post[$name];
            }
            else {
                // Return full post (add to session)
                if(self::PostToSess($_POST))
                {
                    return $_POST;
                }
                else {
                    ShopEngine::ExceptionToFile('Ошибка сессии');
                    return $_POST;
                }
            }
        }
        return self::$post[$name];
    }
    
    public static function Get($name = null)
    {
        if(self::$get[$name] === null)
        {
            if($name) {
                if(isset($_GET[$name])) {
                    self::$get[$name] = $_GET[$name];
                }
            }
            else {
                return $_GET;
            }
        }
        return self::$get[$name];  
    }
    
    public static function EraseFullSession($word = 'checkout')
    {
        $session = $_SESSION;
        foreach ($session as $key => $value) {
            if(strpos($key, $word) === 0)
            {
                unset($_SESSION[$key]);
            }
        }
    }


    private static function PostToSess($post)
    {
        foreach ($post as $key => $value) 
        {
            if(is_array($value)) 
            {
                continue;
            }
            try {
                $_SESSION[$key] = ShopEngine::Help()->Clear($value);
            } catch (Exception $e) {
                ShopEngine::ExceptionToFile($e);
                continue;
            }
        }
        
        return true;
    }
    
    public static function SetSession($name, $value)
    {   
        return $_SESSION[$name] = ShopEngine::Help()->Clear($value);
    }
    
    public static function GetSession($name) 
    {
        if($name) {
            return ShopEngine::Help()->Clear($_SESSION[$name]);
        }
        else {
            return $_SESSION;
        }
    }
    
    public static function PostUnset()
    {
        unset($_POST);
    }
    
    public static function EraseErrorSession()
    {
        $session = $_SESSION;
        foreach ($session as $key => $value)
        {
            if(strpos($key, 'error') === 0)
            {
                unset($_SESSION[$key]);
            }
        }
    }
    
    public static function EraseUserSession()
    {
        $session = $_SESSION;
        foreach ($session as $key => $value)
        {
            if(strpos($key, 'user') === 0)
            {
                unset($_SESSION[$key]);
            }
        }
    }
    
}
