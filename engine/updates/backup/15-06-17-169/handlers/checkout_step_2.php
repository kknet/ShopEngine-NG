<?php defined('shopengine') or die('something wrong');  
	class checkout_step_2 {
		public function __construct() {
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		session_start();

		$delivery = clear_string($_POST['delivery']);
		$payment = clear_string($_POST['payment']);

		if ($delivery != "" AND $payment != "") {

		$_SESSION['radio_delivery'] = $delivery;
		$_SESSION['radio_payment'] = $payment;
		echo 'checkout_yes';
	} 
	else {
		echo 'checkout_no';
			}
		}
	}
}
?>