<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of seo
 *
 * @author Император
 */
class Seo extends ShopEngine {
    public static function GetSEO()
    {
        $array = ShopEngine::GetController()::SEO();
        foreach ($array as $meta => $key) {
            foreach ($key as $prop => $valu) {
                echo ' <meta '.$meta.'="'.$prop.'" content="'.$valu.'">'."\r\n";
            }
        }
    }
}
