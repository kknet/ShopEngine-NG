<?php defined('shopengine') or die('something wrong'); 

class add_comment {
	public function __construct() {

if ($_SERVER["REQUEST_METHOD"] == "POST") {

		session_start(); 

		$id_vari = clear_string($_POST['id']);
		$name = clear_string($_POST['name']);
		$good = clear_string($_POST['dignities']);
		$bad = clear_string($_POST['limitations']);
		$comment = clear_string($_POST['comment']);
		$rating = clear_string($_POST['rating']);

			if ($_SESSION['autorization'] == 'autorization_yes') {


				$email = $_SESSION["autorization_email"];
				$password = $_SESSION["autorization_password"];

				$auth_result = mysql_query("SELECT * FROM users WHERE user_email='$email' AND user_password='$password'");
					if (mysql_num_rows($auth_result) > 0) {
						$auth_row = mysql_fetch_array($auth_result);

						$new_comment = $auth_row['user_comments'] + 1;
						$user_id = $auth_row['user_id'];

						mysql_query("UPDATE users SET user_comments='$new_comment' WHERE user_email='$email' AND user_password='$password'");

						$_SESSION['autorization_comments'] = $new_comment;

						if ($name != "" AND $good != "" AND $bad != "" AND $comment != "") {
			mysql_query("INSERT INTO reviews_table(products_id,name,dignities,limitations,comment,datetime,vote,user_id) 
				VALUES (
					'".$id_vari."',
					'".$name."',
					'".$good."',
					'".$bad."',
					'".$comment."',
					NOW(),
					'".$rating."','".$user_id."')");
						setcookie('review_id',$id_vari,time()+3600*24*31, "/");
						
				echo '1';
			}
				else {
				echo '0';
				}
		}
	}
			else {
					if ($name != "" AND $good != "" AND $bad != "" AND $comment != "") {
			mysql_query("INSERT INTO reviews_table(products_id,name,dignities,limitations,comment,datetime,vote) 
				VALUES (
					'".$id_vari."',
					'".$name."',
					'".$good."',
					'".$bad."',
					'".$comment."',
					NOW(),
					'".$rating."')");
						setcookie('review_id',$id_vari,time()+3600*24*31, "/");
			echo '1';
			}
			else {
			echo '0';
				}
			}
		}
	}
}

?>