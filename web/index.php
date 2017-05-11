<?php 

/*
 * 
 * ShopEngine by Alexander Grachyov
 * github.com/Mateil
 */
session_start();

//Set error handler
require(__DIR__ . '/../engine/components/ErrorHandler.php');
(new ErrorHandler);
//require_once '../engine/core/error.php';

require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../engine/startup.php');
