<?php defined('shopengine') or die('something wrong'); 

class check_email {
	function __construct() {

	if ($_SERVER["REQUEST_METHOD"] == "POST") {

			$email = clear_string($_POST['email']);

			$result = mysql_query("SELECT user_email FROM users WHERE user_email = '$email'",$link);
			if (mysql_num_rows($result) > 0) {
				echo 'false';
			}
			else {
				echo 'true';
			}
		}
	}
}

?>