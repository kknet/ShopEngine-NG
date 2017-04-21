<?
/**
 * Set the default time zone.
 *
 * @link http://kohanaframework.org/guide/using.configuration
 * @link http://www.php.net/manual/timezones
 */
date_default_timezone_set('Europe/Moscow');

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/lib/template.php';
require_once __DIR__ . '/lib/config.php';
require_once __DIR__ . '/lib/getdata.php';
require_once __DIR__ . '/lib/generator.php';


$generator = new generator((!empty($_GET['id']) ? $_GET['id'] : false), (!empty($_GET['site']) ? $_GET['site'] : 'blackberry'), true, (!empty($_GET['ur']) ? true : false));
$html = $generator->render();
?>