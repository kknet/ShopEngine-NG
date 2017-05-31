<?php
/*
 * 
 * This is User Controller
 */

class Controller_User extends Controller{
    
    public $change_password;
    public $change_information;
   
    //Make this controller actionable
    public function type()
    {
        return 'act+';
    }
    
    //Displaying user information
    public static function GetUserInfo()
    {
        /*
         * 
         * In some cases, it is more appropriate to create a separate methods for manipulating data and displaying this data to the user
         */       
      
        if(!Request::GetSession('user_id'))
        {
            return false;
        }
        $id   = Request::GetSession('user_id');
        $sql  = "SELECT * FROM users WHERE users_id=?";
        return Getter::GetFreeData($sql, [$id]);
    }
    
    //Actions
    public function Action_LogIn()
    {
        $this->title = "Вход";
        
        if(Request::GetSession('user_is_logged'))
        {
            ShopEngine::Help()->RegularRedirect('user', 'account');
        }
        
        if(Request::Post('login'))
        {
            $csrf = Request::Post('csrf');
            
            if(!ShopEngine::Help()->ValidateToken($csrf))
            {
                return false;
            }
            
            if($this->GetModel()->Login())
            {
                return ShopEngine::Help()->RegularRedirect("user", 'account');
            }
            else {
                Request::SetSession('error_login_message', 'error');
            }  
        }
        
        return $this->view->render("View_Login", [
            
        ]);
    }
    
    public function Action_SignUp()
    {
        $this->title = "Регистрация";
        
        if(Request::GetSession('user_is_logged'))
        {
            ShopEngine::Help()->RegularRedirect('user', 'account');
        }
        
        if(Request::Post('signup'))
        {
            
            $csrf = Request::Post('csrf');
            
            if(!ShopEngine::Help()->ValidateToken($csrf))
            {
                return false;
            }
            
            if($this->GetModel()->ValidateSignUp())
            {
                if($this->getModel()->SignUp())
                {
                    Request::SetSession('sign_message', 'success');
                }
            }
            else {
                    Request::SetSession('sign_message', 'error');
            }   
        }
        
        return $this->view->render("View_SignUp", [
            
        ]);
    }
    
    // Проверить!
    public function Action_Activate()
    {    
        if(Request::GetSession('user_is_logged'))
        {
            ShopEngine::Help()->RegularRedirect('user', 'account');
        }
        
        if(Request::Get('token')) 
        {
            $token = Request::Get('token');

            $sql   = "SELECT * FROM users WHERE users_token=?";
            $array = Getter::GetFreeData($sql, [$token], true);
            if(count($array) > 0)
            {
                if($this->GetModel()->Activate($array))
                {
                    $activate = true;
                    if(Request::Post('activate'))
                    {
                        $csrf = Request::Post('csrf');

                        if(!ShopEngine::Help()->ValidateToken($csrf))
                        {
                            return Route::ErrorPage404();
                        }
                        $post = Request::Post();

                        if($this->GetModel()->Finish($post))
                        {
                            return ShopEngine::Help()->RegularRedirect("user", 'login');
                        }
                    } 
                } 
                else {
                    $activate = false;
                }
            }
        } else {
            return Route::ErrorPage404();   
        }
        
        return $this->view->render("View_Activate", [
            'activate' => $activate
        ]);
    }
    
    public function Action_Account()
    {
        $this->title = "Аккаунт";
        
        if(!Request::GetSession('user_is_logged'))
        {
            return ShopEngine::Help()->RegularRedirect('user', 'login');
        }
        
        if(!ShopEngine::Help()->ValidateUser())
        {
            return ShopEngine::Help()->RegularRedirect("user", 'logout');
        }
        
        if(Request::Post('user_account_change'))
        {
            $csrf = Request::Post('csrf');
            
            if(!ShopEngine::Help()->ValidateToken($csrf))
            {
                return ShopEngine::Help()->RegularRedirect("user", 'logout');
            }
        
            if(Request::Post('myaccount_new_password') OR Request::Post('myaccount_old_password') OR Request::Post('myaccount_new_repassword'))
            {
                if(Controller::GetModel()->PasswordChange())
                {
                    $this->change_password = true;
                }
            }
            
            if(Controller::GetModel()->UserChange())
            {
                $this->change_information = true;
            }
            
            return ShopEngine::Help()->RegularRedirect('user', 'account');
            
        }
        
        if(!Request::GetSession('user_id'))
        {
            return ShopEngine::Help()->RegularRedirect('user', 'login');
        }
        
        $id   = Request::GetSession('user_id');
        $sql  = "SELECT * FROM users WHERE users_id=?";
        $user = Getter::GetFreeData($sql, [$id]);
        
        return $this->view->render("View_MyAccount", [
            'password'    => $this->change_password,
            'information' => $this->change_information,
            'user'        => $user
        ]);
        
    }
    
    public function Action_Orders()
    {
        $this->title = "Мои заказы";
        
        if(!Request::GetSession('user_is_logged'))
        {
            ShopEngine::Help()->RegularRedirect('user', 'login');
        }
        
        if(!ShopEngine::Help()->ValidateUser())
        {
            return false;
        }
        
        $id     = Request::GetSession('user_id');
        $sql    = "SELECT * FROM orders WHERE orders_users_id=? AND orders_status <> 0";
        $orders = Getter::GetFreeData($sql, [$id], false);
        
        if(count($orders) < 1)
        {
            $orders = false;
        }
        
        $sql       = "SELECT * FROM user_addresses a "
                . "RIGHT OUTER JOIN countries co ON a.address_country = co.country_handle "
                . "RIGHT OUTER JOIN region r ON a.address_region = r.region_handle "
                . "WHERE address_user=?";
        $addresses = Getter::GetFreeData($sql, [$id], false);
        
        if(count($addresses) < 1)
        {
            $addresses = false;
        }
        
        return $this->view->render("View_Orders", [
            'orders'    => $orders,
            'addresses' => $addresses
        ]);

    }
    
    public function Action_Addresses(bool $option = false)
    {
        $this->title = "Мои адреса";
        
        if(!ShopEngine::Help()->ValidateUser())
        {
            return false;
        }
        
        $id  = Request::GetSession('user_id');
        $opt = ShopEngine::GetOption();
        
        if(!Request::GetSession('user_is_logged'))
        {
            ShopEngine::Help()->RegularRedirect('user', 'login');
        }
        
        //If sended form "address_chenge"
        $red = null;
        if(Request::Post('address_change'))
        {
            $csrf = Request::Post('csrf');
            
            if(!ShopEngine::Help()->ValidateToken($csrf))
            {
                return ShopEngine::GoHome();
            }
            
            $addid = Request::Post('address_change');
            
            if($this->GetModel()->ChangeAddress($addid))
            {
                return ShopEngine::Help()->RegularRedirect('user', 'addresses');
            }
            
            $red = false;
            
        }
        
        if(Request::Post('address_new'))
        {
            $csrf = Request::Post('csrf');
            
            if(!ShopEngine::Help()->ValidateToken($csrf))
            {
                return ShopEngine::GoHome();
            }
            
            if($this->GetModel()->NewAddress())
            {
                return ShopEngine::Help()->RegularRedirect('user', 'addresses');
            }
            
            $new = false;
        }
        
        $sql    = "SELECT * FROM user_addresses a "
                . "RIGHT OUTER JOIN countries co ON a.address_country = co.country_handle "
                . "RIGHT OUTER JOIN region r ON a.address_region = r.region_handle "
                . "WHERE address_user=?";
        $addresses = Getter::GetFreeData($sql, [$id], false);
        
        $start = [
            'addresses' => $addresses,
            'red'       => $red
        ];
        
        if($option) {
            return $start;
        }
        
        return $this->view->render("View_Addresses", [
            'start' => $start
        ]);
        
    }
    
    public function Red()
    {
        $red_id = Request::Get('addid');
            
        if(!$red_id)
        {
            $red = false;
        }

        $red = $this->GetModel()->GetAddress($red_id);

        if(count($red) < 1)
        {
            $red = false;
        }
        
        $return = $this->Action_Addresses(true);
        
        $return['red'] = $red;
        
        return $this->view->render("View_Addresses", [
            'start'     => $return
        ]);
    }
    
    public function Add()
    {
        $new = true;
        
        $return = $this->Action_Addresses(true);
        
        $return['new'] = $new;
        
        $sql = "SELECT * FROM countries WHERE country_avail = '1'";
        $countries = Getter::GetFreeData($sql, null, false);
        
        return $this->view->render("View_Addresses", [
            'start' => $return,
            'countries' => $countries
        ]);
    }
    
    public function Action_Logout()
    {
        if(!Request::GetSession('user_is_logged'))
        {
            return ShopEngine::Help()->RegularRedirect('user', 'login');
        }
        
        if(Request::EraseUserSession())
        {
            return ShopEngine::Help()->RegularRedirect('user', 'login');
        }
        
        return ShopEngine::Help()->RegularRedirect('user', 'login');
    }
    
    public function Action_Invite()
    {
        $this->title = "Пригласить друга";
        
        if(!Request::GetSession('user_is_logged'))
        {
            return ShopEngine::Help()->RegularRedirect('user', 'login');
        }
        
        if(!ShopEngine::Help()->ValidateUser())
        {
            return false;
        }
        
        $error = false;
        
        if(Request::Post('invite'))
        {
            $csrf = Request::Post('csrf');
            
            if(!ShopEngine::Help()->ValidateToken($csrf))
            {
                return ShopEngine::GoHome();
            }
            
            if(!$this->GetModel()->SendInvite())
            {
                $error = true;
            }

        }
        
        return $this->view->render("View_Invite",[
            'error' => $error
        ]);
    }
    
    public function Action_Restore(bool $option = false)
    {
        $this->title = "Восстановление пароля";
        
        if(Request::GetSession('user_is_logged'))
        {
            return ShopEngine::Help()->RegularRedirect('user', 'account');
        }
        
        $start  = false;
        
        if(Request::Post('restore')) { 
        
            $csrf = Request::Post('csrf');

            if(!ShopEngine::Help()->ValidateToken($csrf))
            {
                return ShopEngine::GoHome();
            }
            
            $errors = false;
            
            if(!$errors = Controller::GetModel()->Restore())
            {
                $start  = true;
            }
        
        }
        
        if($option)
        {
            return true;
        }
        
        return $this->view->render("View_Restore", [
            'errors' => $errors,
            'start'  => $start
        ]);
    }
    
    public function new_password()
    {
        $this->title = "Восстановление пароля";
        
        $this->Action_Restore(true);
        
        if(Request::Post('restore_new'))
        {
            $token = Request::Get('token');
            
            if($errors = $this->GetModel()->NewPassword($token))
            {
                return $this->view->render("View_Restore", [
                    'status' => 'new_password',
                    'errors' => $errors
                ]);
            }
            return ShopEngine::Help()->RegularRedirect('user', 'login');
        }
        
        if($token = Request::Get('token'))
        {
            if($this->GetModel()->NewPasswordValidate($token))
            {
                return $this->view->render("View_Restore", [
                    'status' => 'new_password'
                ]);
            }
        }
        
        return ShopEngine::GoHome();
        
    }
    
}
