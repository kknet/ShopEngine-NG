<?php 

/*
 * 
 * ShopEngine by Alexander Grachyov
 * github.com/Mateil
 */
session_start();
ob_start();
ini_set('display_errors',1);
if($_SESSION['ok']) {
    try {
        require_once 'engine/startup.php';
    } catch (Exception $e) {
        //standart error function (non set yet)
        header( 'Location: /catalog/', true, 301 );
    }
}
else {
    require_once 'widgets/blocker.php';
}
