<?php

class Model_User extends Model {
    
    public function ValidateSignUp()
    {
        $db   = database::getInstance();
        $post = Request::Post();
        Request::SetSession('sign_message_text', 'Регистрационные данные введены неверно.');
        
        if(!$post)
        {
            Request::SetSession('sign_message_text', 'Регистрационные данные введены неверно.');
            return false;
        }
        
        $sql = "SELECT * FROM users WHERE users_email = ?";
        $email = Getter::GetFreeData($sql, [$post['customer_email']], false);
        
        if(count($email) > 0)
        {
            Request::SetSession('sign_message_text', 'Пользователь с таким E-Mail уже существует.');
            return false;
        }
        
        if(!preg_match("/^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i", trim($post['customer_email'])))
        {
            Request::SetSession('sign_message_text', 'E-Mail введён неверно.');
            return false;
        }
        
        if($post['customer_first_name'] AND $post['customer_last_name'] AND $post['customer_email'] AND $post['customer_password'])
        {
            return true;
        }
    }
    
    public function SignUp()
    {    
        
        $db   = database::getInstance();
        $post = Request::Post();
        $ip   = ShopEngine::GetUserIp();
        $op   = Config::Password();
        $this->token = sha1(uniqid(rand(), true).md5($post['customer_email']));
        
        $password = password_hash($post['customer_password'], PASSWORD_BCRYPT, $op);
        
        $sql = "INSERT INTO users (users_name, users_last_name, users_email, users_password, users_datetime, users_ip, users_token) VALUES ("
                . ":name,"
                . ":last_name,"
                . ":email,"
                . ":password,"
                . "NOW(),"
                . ":ip,"
                . ":token"
                . ")";
        
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":name", $post['customer_first_name']);
        $stmt->bindParam(":last_name", $post['customer_last_name']);
        $stmt->bindParam(":email", $post['customer_email']);
        $stmt->bindParam(":password", $password);
        $stmt->bindParam(":ip", $ip);
        $stmt->bindParam(":token", $this->token);
        
        if($stmt->execute())
        {
            //Erase session
            
            if($this->SendMessage())
            {
                Request::EraseFullSession();
                return true;
            }
        }
        
        return false;
    }
    
    public function SendMessage()
    {
        try { 
            $token = $this->token;
            $mailfrom = 'info@poterpite.ru';
            $mailto   = Request::GetSession('customer_email');
            $subject  = 'Регистрация пользователя';

            require_once 'widgets/mailbodysignup.php';

            ShopEngine::Help()->SendMaill($mailto, $mailfrom, $subject, $body);
            return true;
            
        } catch (Exception $e) {
            ShopEngine::ExceptionToFile($e);
            return false;
        }
    }
    
    public function Activate($array)
    {
        if($array['users_active'] === '1')
        {
            return false;
        }
        elseif($array['users_active'] === '0') {
            return true;
        }
        return $array;
    }
    
    public function Finish($post)
    {
        echo strlen($post['activate_password']);
        
        if($post['activate_password'] !== $post['activate_repassword'] OR strlen($post['activate_password']) < 6)
        {
            Request::SetSession('activate_message_bad', 'Пароли должны совпадать и содержать хотя бы 6 символов');
            return false;
        }
        
        $op = Config::Password();
        
        $password = password_hash($post['activate_password'], PASSWORD_BCRYPT, $op);
        $token    = $post['token'];
        
        $db = database::getInstance();
        $sql = "UPDATE users SET users_password=:password, users_active='1' WHERE users_token=:token";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":password", $password);
        $stmt->bindParam(":token", $token);
        
        if($stmt->execute())
        {
            Request::EraseFullSession();
            return true;
        }
        
        Request::SetSession('activate_message_bad', 'Произошла ошибка. Повторите попытку.');
        return false;
        
    }
    
    public function LogIn()
    {
        $db   = database::getInstance();
        $post = Request::Post();
        
        if(!$post)
        {
            return false;
        }
        
        $sql  = "SELECT * FROM users WHERE users_email=?";
        $user = Getter::GetFreeData($sql, [$post['login_email']], true);
        if(count($user) > 0)
        {
            if(password_verify($post['login_password'], $user['users_password']))
            {   
                Request::SetSession('user_id', $user['users_id']);
                Request::SetSession('user_is_logged', true);
                Request::SetSession('user_email', $user['users_email']);
                Request::SetSession('user_name', $user['users_name']);
                Request::SetSession('user_last_name', $user['users_last_name']);
                Request::SetSession('user_patronymic', $user['users_patronymic']);
                Request::SetSession('user_gender', $user['users_gender']);
                Request::SetSession('user_date_of_birth', $user['users_date_of_birth']);
                Request::SetSession('user_email', $user['users_email']);
                Request::SetSession('user_phone', $user['users_phone']);
                Request::SetSession('user_act_phone', $user['users_act_phone']);
                return true;
            }
        }
        return false;
    }
    
    public function UserChange()
    {   
        $db   = database::getInstance();
        $post = Request::Post();
        
        if(!$post)
        {
            return false;
        }
       
        if(!$post['myaccount_name'])
        {
            Request::SetSession('error_account_name', 'Это поле не может быть пустым');
        }
        
        if(!$post['myaccount_email'])
        {
            Request::SetSession('error_account_email', 'Это поле не может быть пустым');
        }
        
        if(!$post['myaccount_name'] OR !$post['myaccount_email'])
        {
            return false;
        }
        
        $data = $post['myaccount_date'];
        
        if(!$data)
        {
            $data = null;
        }
        
        //Optional errors
        
        if($post['myaccount_email'] AND !preg_match("/^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i", trim($post['myaccount_email'])))   
        {
            $opt = true;
            Request::SetSession('error_account_email', 'E-Mail имеет неверный формат');   
        }
        
        $re = '/^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/i';
        
        if($post['myaccount_phone'] AND !preg_match($re, trim($post['myaccount_phone'])))
        {
            $opt = true;
            Request::SetSession('error_account_phone', 'Мобильный телефон имеет неверный формат');   
        }
        
        if($post['myaccount_act_phone'] AND !preg_match($re, trim($post['myaccount_act_phone'])))
        {
            $opt = true;
            Request::SetSession('error_account_act_phone', 'Мобильный телефон имеет неверный формат');   
        }
        
        if($opt)
        {
            return false;
        }
        
        $id   = Request::GetSession('user_id');
        $sql  = "UPDATE users SET users_name=:name, users_patronymic=:patr, users_last_name=:last_name, users_email=:email, users_gender=:gender, users_phone=:phone, users_act_phone=:act_phone, users_date_of_birth=:birth";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":name", $post['myaccount_name']);
        $stmt->bindParam(":patr", $post['myaccount_patr']);
        $stmt->bindParam(":last_name", $post['myaccount_last_name']);
        $stmt->bindParam(":email", $post['myaccount_email']);
        $stmt->bindParam(":phone", $post['myaccount_phone']);
        $stmt->bindParam(":act_phone", $post['myaccount_act_phone']);
        $stmt->bindParam(":gender", $post['myaccount_gender']);
        $stmt->bindParam(":birth", $data);

        if($stmt->execute())
        {
            $sql   = "SELECT * FROM users WHERE users_id=?";
            $user = Getter::GetFreeData($sql, [$id], true);

            if(count($user) < 1)
            {
                return false;
            }

            Request::SetSession('user_is_logged', true);
            Request::SetSession('user_email', $user['users_email']);
            Request::SetSession('user_name', $user['users_name']);
            Request::SetSession('user_last_name', $user['users_last_name']);
            Request::SetSession('user_patronymic', $user['users_patronymic']);
            Request::SetSession('user_gender', $user['users_gender']);
            Request::SetSession('user_date_of_birth', $user['users_date_of_birth']);
            Request::SetSession('user_email', $user['users_email']);
            Request::SetSession('user_phone', $user['users_phone']);
            Request::SetSession('user_act_phone', $user['users_act_phone']);

            Request::PostUnset();
            
            return true;
        }

        return false;
    }
    
    public function PasswordChange()
    {
        $db   = database::getInstance();
        $id   = Request::GetSession('user_id');
        $op   = Config::Password();
        $post = Request::Post();
        
        var_dump($post);
        
        if(!$post['myaccount_old_password'])
        {
            Request::SetSession('error_account_old_password', 'Это поле не может быть пустым');
            return false;
        }
        
        if(!$post['myaccount_new_password'] OR strlen($post['myaccount_new_password']) < 6)
        {
            Request::SetSession('error_account_new_password', 'Это должно содержать минимум 6 символов');
            return false;
        }
        
        if(!$post['myaccount_new_repassword'] OR strlen($post['myaccount_new_repassword']) < 6)
        {
            Request::SetSession('error_account_new_repassword', 'Это должно содержать минимум 6 символов');
            return false;
        }
        
        if(!$post['myaccount_old_password'] OR !$post['myaccount_new_password'] OR !$post['myaccount_new_repassword'])
        {
            return false;
        }
        
        $old = $post['myaccount_old_password'];
        
        $sql  = "SELECT * FROM users WHERE users_id=?";
        $user = Getter::GetFreeData($sql, [$id], true);
        
        if(!password_verify($old, $user['users_password']))
        {
            Request::SetSession('error_account_old_password', 'Неверный пароль');
            return false;
        }
        
        if($post['myaccount_new_password'] !== $post['myaccount_new_repassword'])
        {
            Request::SetSession('error_account_new_repassword', 'Пароли не совпадают');
            return false;
        }
        
        $new = $post['myaccount_new_password'];
        
        $password = password_hash($new, PASSWORD_BCRYPT, $op);
        
        $sql  = "UPDATE users SET users_password=:password WHERE users_id=:id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":password", $password);
        $stmt->bindParam(":id", $id);
        
        if($stmt->execute())
        {
            Request::SetSession('error_account_new_repassword_success', 'Пароль успешно изменен');
            return true;
        }
        
    }
    
    public function GetAddress($id)
    {
        $sql =    "SELECT * FROM user_addresses a "
                . "RIGHT OUTER JOIN countries co ON a.address_country = co.country_handle "
                . "RIGHT OUTER JOIN region r ON a.address_region = r.region_handle "
                . "WHERE address_id=?";
        return  Getter::GetFreeData($sql, [$id]);
    }
    
    public function ChangeAddress($id)
    {
        $db   = database::getInstance();
        $post = Request::Post();
        
        if(!$post)
        {
            return false;
        }
        
        if(!$post['address_address'] OR !$post['address_city'] OR !$post['address_index'] OR !is_int((int)$post['address_new_index']) OR !$post['address_phone'])
        {
            return false;
        }
        
        $sql  = "UPDATE user_addresses SET address_name=:name, address_last_name=:last_name, address_company=:company, address_optional=:optional, address=:address, address_city=:city, address_country=:country, address_region=:region, address_phone=:phone WHERE address_id=:id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":name", $post['address_first_name']);
        $stmt->bindParam(":last_name", $post['address_last_name']);
        $stmt->bindParam(":company", $post['address_company']);
        $stmt->bindParam(":optional", $post['address_optional']);
        $stmt->bindParam(":address", $post['address_address']);
        $stmt->bindParam(":city", $post['address_city']);
        $stmt->bindParam(":country", $post['address_country']);
        $stmt->bindParam(":region", $post['address_region']);
        $stmt->bindParam(":phone", $post['address_phone']);
        $stmt->bindParam(":id", $id);
        
        if($stmt->execute())
        {
            return true;
        }
        
    }
    
    public function NewAddress()
    {
        $db      = database::getInstance();
        $post    = Request::Post();
        $user_id = Request::GetSession('user_id');
        
        if(!$post)
        {
            return false;
        }
        
        if(!$post['address_new_address'] OR !$post['address_new_city'] OR !$post['address_new_index'] OR !is_int((int)$post['address_new_index']) OR !$post['address_new_phone'])
        {
            return false;
        }
        
        $sql = "INSERT INTO user_addresses ("
                . "address_user, "
                . "address_name, "
                . "address_last_name, "
                . "address_company, "
                . "address_optional, "
                . "address, "
                . "address_country, "
                . "address_region, "
                . "address_index, "
                . "address_phone) "
                . "VALUES("
                . ":user,"
                . ":name,"
                . ":last,"
                . ":company,"
                . ":optional,"
                . ":address,"
                . ":country,"
                . ":region,"
                . ":index,"
                . ":phone"
                . ")";
        
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":user", $user_id);
        $stmt->bindParam(":name", $post['address_new_first_name']);
        $stmt->bindParam(":last", $post['address_new_last_name']);
        $stmt->bindParam(":company", $post['address_new_company']);
        $stmt->bindParam(":optional", $post['address_new_optional']);
        $stmt->bindParam(":address", $post['address_new_address']);
        $stmt->bindParam(":country", $post['address_new_country']);
        $stmt->bindParam(":region", $post['address_new_region']);
        $stmt->bindParam(":index", $post['address_new_index']);
        $stmt->bindParam(":phone", $post['address_new_phone']);
        
        if($stmt->execute())
        {
            Request::EraseFullSession('address');
            return true;
        }
    }
    
}
