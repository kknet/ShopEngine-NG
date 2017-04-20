<?php 

/*
 * 
 * ShopEngine by Alexander Grachyov
 * github.com/Mateil
 */
session_start();
ini_set('display_errors',0);
//error_reporting(E_ALL);
if($_SESSION['ok']) 
{
    require_once 'engine/startup.php';
}
else {
    require_once 'widgets/blocker.php';
}
