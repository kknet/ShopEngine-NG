<?php 

/*
 * 
 * ShopEngine by Alexander Grachyov
 * github.com/Mateil
 */
session_start();

//Set error handler
require_once 'engine/components/ErrorHandler.php';
(new ErrorHandler);

if(isset($_SESSION['ok'])) 
{
    require_once 'engine/startup.php';
    require_once 'engine/core/error.php';
}
else {
    require_once 'widgets/blocker.php';
}
