<?php
	defined('shopengine') or die('something wrong');
	function clear_string($str_vari) {
		$str_vari = strip_tags($str_vari);
		$str_vari = mysql_real_escape_string($str_vari);
		$str_vari = trim($str_vari);

		return $str_vari;
	}

	function generate_random() {

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

	function send_mail($from,$to,$subject,$body) {
		$charset  = 'utf-8';
		mb_language("ru");
		$headers  = "MIME-version: 1.0 \n";
		$headers .= "From: <".$from."> \n";
		$headers .= "Reply-To: <".$from."> \n";
		$headers .= "Content-Type: text/html; charset=$charset \n";

		$subject = '=?'.$charset.'?B?'.base64_encode($subject).'?=';

		mail($to,$subject,$body,$headers);
	}

	function number_rank($int) {
		switch (strlen($int)) {
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

function my_copy_all($from, $to, $rewrite = true) {
	rmdir('../../style');
if (is_dir($from)) {
@mkdir($to);
$d = dir($from);
while (false !== ($entry = $d->read())) {
if ($entry == "." || $entry == "..") continue;
my_copy_all("$from/$entry", "$to/$entry", $rewrite);
}
$d->close();
} else {
if (!file_exists($to) || $rewrite)
copy($from, $to);
}
}


function removeDirectory($dir) {
    if ($objs = glob($dir."/*")) {
       foreach($objs as $obj) {
         is_dir($obj) ? removeDirectory($obj) : unlink($obj);
       }
    }
    rmdir($dir);
  }

?>