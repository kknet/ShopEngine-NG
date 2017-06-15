<?php

class Seo extends ShopEngine {
    public static function GetSEO($controller)
    {
        $array = $controller->SEO();
        foreach ($array as $meta => $key) {
            foreach ($key as $prop => $valu) {
                echo ' <meta '.$meta.'="'.$prop.'" content="'.$valu.'">'."\r\n";
            }
        }
    }
}
