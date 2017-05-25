<?php 

/*
 * 
 * ShopEngine by Alexander Grachyov
 * github.com/Mateil
 */

$start = microtime(true);

//Set error handler
require(__DIR__ . '/../engine/components/errorhandler.php');
(new ErrorHandler);
//require_once '../engine/core/error.php';

require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../engine/startup.php');

//print get_num_queries();

//echo 'Время генерации: ' . ( microtime(true) - $start ) . ' сек.';