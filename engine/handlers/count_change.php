<?php defined('shopengine') or die('something wrong'); 
	class count_change {
		public function __construct() {
		if ($_SERVER["REQUEST_METHOD"] == "POST") {

		$id_vari = clear_string($_POST['cid']);
		$p_count = clear_string($_POST['count']);

			$result = mysql_query("SELECT * FROM cart WHERE cart_ip = '{$_SERVER['REMOTE_ADDR']}' AND cart_id_products = '$id_vari'");
			if(mysql_num_rows($result) > 0 ) {
			$row = mysql_fetch_array($result);
			$count = $row['cart_count'];
			$new_count = $p_count;
			if ($new_count > 99) $new_count = 99;
			if ($new_count < 1) $new_count = 1;
			
			$update = mysql_query("UPDATE cart SET cart_count='$new_count' WHERE cart_ip = '{$_SERVER['REMOTE_ADDR']}' AND cart_id_products = '$id_vari'");
			echo $new_count;
		}

		else {
			echo 'err';
			}
		}
	}
}
?>