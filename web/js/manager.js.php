<?php
function compress($buffer) {
    $buffer = preg_replace("/((?:/*(?:[^*]|(?:*+[^*/]))**+/)|(?://.*))/", "", $buffer);
    $buffer = str_replace(array("rn","n","r",'    ','     '), '', $buffer);
    return $buffer;
}
$modified = 0;
$offset = 60 * 60 * 24 * 7;
header ('Content-type: text/javascript; charset=UTF-8');
header ('vary: accept-encoding');
header ('Cache-Control: max-age=' . $offset);
header ('Pragma:');
header ("Last-Modified: ".gmdate("D, d M Y H:i:s", $modified )." GMT");
if(extension_loaded('zlib')){ob_start('ob_gzhandler');}
    ob_start("compress");
        include('jquery-1.9.1.min.js');
        include('main_scripts.js');
        include('theme.js');
        include('jquery.magnific-popup.js');
    ob_end_flush();
if(extension_loaded('zlib')){ob_end_flush();} 
