<?php
/**
 * Set the default time zone.
 *
 * @link http://kohanaframework.org/guide/using.configuration
 * @link http://www.php.net/manual/timezones
 */
date_default_timezone_set('Europe/Moscow');

require_once __DIR__ . '/lib/template.php';
require_once __DIR__ . '/lib/config.php';
require_once __DIR__ . '/lib/getdata.php';
require_once __DIR__ . '/lib/generator.php';


$generator = new generator2((Request::GetSession('last_order_id')), Config::$config['site_handle'], false, (!empty($_GET['ur']) ? true : false));
$html = $generator->render();