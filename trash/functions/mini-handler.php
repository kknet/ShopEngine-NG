<?php 
/*
 * 
 * Некоторые вспомогательные функции
 */

function GenerateToken()
{
    return sha1(uniqid(rand(), true));
}

function clear_string($str_vari) 
{
    $str_vari = strip_tags($str_vari);
    $str_vari = trim($str_vari);

    return $str_vari;
}

function ImageReSize($row, $path, $oNwidth, $oNheight, $title) 
{
    if ($row != "" && file_exists($path.'/'.$row)) {
        $img_path = $path.'/'.$row;
        $max_width = $oNwidth;
        $max_height = $oNheight;
        list($width, $height) = getimagesize($img_path);
        $ratioh = $max_height/$height;
        $ratiow = $max_width/$width;
        $ratio = min($ratioh, $ratiow);
        $width = intval($ratio*$width);
        $height = intval($ratio*$height);
        $image = '<img src="/'.$img_path.'" title="'.$title.'" width="'.$width.'%" height="'.$height.'%" alt="image"/>';
        return $image;
    }
    else {
        $img_path = "/img/no_image.png";
        $width = $oNwidth;
        $height = $oNheight;
        $image = '<img src="'.$img_path.'" title="'.$title.'" width="'.$width.'%" height="'.$height.'%" alt="image"/>';
        return $image;
    }
}

function number_rank($int) 
{
    switch (strlen($int)) 
    {
        case '4':
        $price = substr($int,0,1).' '.substr($int,1,4);
        break;

        case '5':
        $price = substr($int,0,2).' '.substr($int,2,5);
        break;

        case '6':
        $price = substr($int,0,3).' '.substr($int,3,6);
        break;

        case '7':
        $price = substr($int,0,1).' '.substr($int,1,3).' '.substr($int,4,7);
        break;

        default:
        $price = $int;
        break;
    }
    return $price;
}

function send_mail($from,$to,$subject,$body) 
{
    $charset  = 'utf-8';
    mb_language("ru");
    $headers  = "MIME-version: 1.0 \n";
    $headers .= "From: <".$from."> \n";
    $headers .= "Reply-To: <".$from."> \n";
    $headers .= "Content-Type: text/html; charset=$charset \n";

    $subject = '=?'.$charset.'?B?'.base64_encode($subject).'?=';

    mail($to,$subject,$body,$headers);
}

function generate_random() 
{

    $number = 11;

    $arr = array('a','b','c','d','e','f',

         'g','h','i','j','k','l',

         'm','n','o','p','r','s',

         't','u','v','x','y','z',

         '1','2','3','4','5','6',

         '7','8','9','0');

    $password = "";

    for($i = 0; $i < $number; $i++)
    {
        $index = rand(0, count($arr) - 1);
        $password .= $arr[$index];
    }

    return $password;
}
