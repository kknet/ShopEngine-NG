<?php defined('shopengine') or die('something wrong'); 
class feedback {
	public function __construct() {

	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		$name = clear_string($_POST['name']);
		$email = clear_string($_POST['email']);
		$subject = clear_string($_POST['subject']);
		$message = clear_string($_POST['message']);

		if($name != "" AND $email != "" AND $subject != "" AND $message != "") {
			send_mail($email,'alexandergrachyov@gmail.com',$subject,'От: '.$name.'<br/>Текст сообщения: '.$message.'<br/>Электронная почта отправителя: '.$email);
			echo 'true';
		}
		else {
			echo 'false';
			}
		}
	}
}

?>