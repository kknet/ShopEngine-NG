<?php

class ErrorHandler {
    
    public function __construct()
    {
        session_start();
        
        //track all errors
        ini_set('display_errors', 1);
        error_reporting(E_ALL | E_STRICT);
        
        //set basic error handler
        set_error_handler([$this, 'errorCatcher']);
        
        //set exception handler
        set_exception_handler([$this, 'exceptionCatcher']);
        
        //set fatal error handler
        register_shutdown_function([$this, 'fatalErrorCatcher']);
    }    
    
    public function errorCatcher($errno, $errstr, $errfile, $errline)
    {
        if(error_reporting()) { 
            $this->errorToFile($errno, $errstr, $errfile, $errline, 'errorCatcher');
        }
        
        return true;
    }
    
    public function exceptionCatcher($e)
    {
        $this->errorToFile(get_class($e), $e->getMessage(), $e->getFile(), $e->getLine(), 'exceptionCatcher', 500);
    }
    
    public function fatalErrorCatcher()
    {
        if ($error = error_get_last() AND $error['type'] & (E_ERROR | E_PARSE | E_COMPILE_ERROR | E_CORE_ERROR)) {
            //ob_end_clean();
            $this->errorToFile($error['type'], $error['message'], $error['file'], $error['line'], 'fatalErrorCatcher', 500);
            //$this->errorToEmail($errno, $errstr, $errfile, $errline, $funcname);
            exit();
        }
    }
    
    public function errorToFile($errno, $errstr, $errfile, $errline, $funcname, $code = null)
    {
        header("HTTP/1.1 $code");
        
        $text = "( ".date('Y-m-d H:i:s (T)')." ) Сработала функция ".$funcname."; Сбой в работе сайта. Код ошибки/Класс ошибки: ".$errno."; Информация об ошибке: ".$errstr."; Файл: ".$errfile."; Строка: ".$errline."\r\n";
        if(file_exists('../engine/errlog.txt'))
        {
            $err = fopen('../engine/errlog.txt', 'a');
            fwrite($err, $text);
            fclose($err);
        } 
        else {
            $this->errorToEmail($errno, $errstr, $errfile, $errline, $funcname);
        } 
    }
    
    public function errorToEmail($errno, $errstr, $errfile, $errline, $funcname)
    {
        $from     = 'error@poterpite.ru';
        $to       = 'alexandergrachyov@gmail.com';
        $subject = 'Ошибка на сайте';
        $text     = "( ".date('Y-m-d H:i:s (T)')." ) Сработала функция ".$funcname."; Сбой в работе сайта. Код ошибки/Класс ошибки: ".$errno."; Информация об ошибке: ".$errstr."; Файл: ".$errfile."; Строка: ".$errline."\r\n";
        
//        $charset  = 'utf-8';
//        mb_language("ru");
//        $headers  = "MIME-version: 1.0 \n";
//        $headers .= "From: <".$from."> \n";
//        $headers .= "Reply-To: <".$from."> \n";
//        $headers .= "Content-Type: text/html; charset=$charset \n";
//
//        $subject = '=?'.$charset.'?B?'.base64_encode($subject).'?=';

        ShopEngine::Help()->SendMaill($to, $from, $subject, $text);
    }
}
