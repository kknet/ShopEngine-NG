<?php 

/*
 * 
 * Стартёр
 */

require_once 'config/config.php';   // Config

require_once 'config/db.php';       // Connect to database
require_once 'core/shopengine.php'; // Служебные функции
ShopEngine::LoadComponents();       // Loading components

require_once 'core/model.php';      // Main model's component
require_once 'core/controller.php'; // Main controllers's component
require_once 'core/route.php';      // Router

require_once 'core/SECore.php';     // Main app's component

Route::start();

//ShopEngine::Help()->ImportCSV('files/csv.csv'); // Import CSV


//ShopEngine::Help()->UpdateCount();
