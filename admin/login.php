<?php
    define('shopengine',true);
    include("includes/db_connect.php"); 
    include("functions/functions.php");
    include("functions/variables.php");
    session_start(); 

    if ($_SESSION['admin_autorization'] == 'autorization_yes') {
        header('Location: index.php', true, 301);
        exit();
    }
    else {

    if($_POST['login_button']) {
        $login = clear_string($_POST['login_login']);
        $password = clear_string($_POST['login_password']);

        if (!empty($login) AND !empty($password)) {

            $password = md5($password);
            $password = strrev($password);
            $password = strtolower('wejkfgiq23thsdsdfhauiw3yrtisudyfgaksf'.$password.'skdfjgqi83wyrgfdagskfaywtekjgkfuyst');

            $result = mysql_query("SELECT * FROM admins WHERE login='$login' AND password='$password'");

            if(mysql_num_rows($result) > 0) {
                $row = mysql_fetch_array($result);

                $_SESSION['admin_autorization'] = 'autorization_yes';
                $_SESSION['chk_products'] = $row['chk_products'];
                $_SESSION['chk_reviews'] = $row['chk_reviews'];
                $_SESSION['chk_orders'] = $row['chk_orders'];
                $_SESSION['chk_settings'] = $row['chk_settings'];
                $_SESSION['chk_administration'] = $row['chk_administration'];
                $_SESSION['chk_slider'] = $row['chk_slider'];
                $_SESSION['chk_users'] = $row['chk_users'];
                $_SESSION['chk_articles'] = $row['chk_articles'];

                $error = "";

                header('Location: index.php', true, 301);
                exit();
            }
            else {
                $error = '<p class="login_error_message">Логин или пароль введен неверно</p>';
            }
        }
        else {
            $error = '<p class="login_error_message">Логин или пароль введен неверно</p>';
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Панель управления - вход</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/css.css">
	<script type="text/javascript" href="js/js.js"></script>
    <!--<link href='https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900' rel='stylesheet' type='text/css'>-->
    <link rel="stylesheet" type="text/css" href="../fonts/fonts.css">
</head>
<body>
<?php echo $error; ?>
    
    <div class="login_block">
    <?php 

    ?>
        <div class="login_logo"><img id="m_logo" src="../img/Logo.png" /></div>
        <p class="login_title">Войти в панель управления</p>
        <form id="login_form" method="post">
                <label for="login_login">Ваш Логин</label>
                <input type="text" id="login_login" name="login_login" placeholder="" /></br>
                <label for="login_password">Ваш пароль</label>
                <input type="password" id="login_password" name="login_password" /></br>
                <input type="submit" id="login_button" name="login_button" value="Войти"/>
            </form>
    </div>

</body>
</html>
<?php } ?>