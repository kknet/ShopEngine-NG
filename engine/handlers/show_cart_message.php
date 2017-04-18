<?php defined('shopengine') or die('something wrong'); 
	class show_cart_message {

		public function __construct() {

	if($_SERVER['REQUEST_METHOD'] == 'POST') {

		$id_vari = clear_string($_POST['id']);

		$result = mysql_query("SELECT * FROM table_products WHERE products_id='$id_vari'");
		if(mysql_num_rows($result) > 0) {
			$row = mysql_fetch_array($result);

			if ($row['availability'] == 1) {
				$availability_vari = "Есть в наличии";
			}
			else {
				$availability_vari = "Нет в наличии";
			}

			$image = ImageReSize($row["image"], "../../products_img/".$row["type_of_product"], 90, 90, NULL);

			include '../../template/mini/cart_message.php';
		}
		else {
			echo 0;
			}
		}
	}
}
?>