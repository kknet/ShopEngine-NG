<?php 

/*
 * 
 * ShopEngine by Alexander Grachyov
 * github.com/Mateil
 */

$start = microtime(true);

//External connection
require(__DIR__ . '/../engine/connect/connect.php');

$version = phpversion();

if((int)$version < 7) {
    echo 'Version required: 7.0, but installed: '.$version;
    exit();
}

//Set error handler
require(__DIR__ . '/../engine/components/errorhandler.php');
(new ErrorHandler);
//require_once '../engine/core/error.php';

require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../engine/startup.php');

//print get_num_queries();

if(ShopEngine::GetControllerName() !== 'ajax') { 
    echo '<span style="display:none" class="debug-info">Количество запросов: ' . Getter::$count . ' </span>';
    echo '<span style="display:none" class="debug-info">Запросы: <ul>' . Getter::$queries . ' </ul></span>';
    echo '<span style="display:none" class="debug-info">Время генерации: ' . ( microtime(true) - $start ) . ' сек.</span>';
}