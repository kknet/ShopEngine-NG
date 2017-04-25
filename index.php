<?php 

/*
 * 
 * ShopEngine by Alexander Grachyov
 * github.com/Mateil
 */
session_start();
//ob_start();

//Set error handler
require_once 'engine/components/ErrorHandler.php';
(new ErrorHandler);

if(isset($_SESSION['ok'])) 
{
    define('ROOT', dirname(__FILE__));
    require_once 'engine/startup.php';
    //require_once 'engine/core/error.php';
}
else {
    require_once 'widgets/blocker.php';
}
