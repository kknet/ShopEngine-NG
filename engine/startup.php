<?php 

/*
 * 
 * Startup
 */

define('ENGINE', __DIR__.'/');

require_once '../root.php';

require_once ENGINE.'config/config.php';   // Config

require_once ENGINE.'config/db.php';       // Connect to database

require_once ENGINE.'core/widgets.php';    // Widget's component

require_once ENGINE.'core/shopengine.php'; // Служебные функции
ShopEngine::LoadComponents();              // Loading components

require_once ENGINE.'core/model.php';      // Main model's component
require_once ENGINE.'core/view.php';       // Main view's component
require_once ENGINE.'core/controller.php'; // Main controllers's component
require_once ENGINE.'core/route.php';      // Router

require_once ENGINE.'core/SECore.php';     // Main app's component

Route::start();
