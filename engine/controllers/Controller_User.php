<?php
/*
 * 
 * This is User Controller
 */

class Controller_User extends Controller{
   
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
//        if(!Request::GetSession('user_is_logged'))
//        {
//            ShopEngine::Help()->RegularRedirect('user', 'login');
//        }
//        
//        if(!ShopEngine::Help()->ValidateUser())
//        {
//            return ShopEngine::Help()->RegularRedirect("user", 'logout');
//        }
//        
      
        if(!Request::GetSession('user_id'))
        {
            return false;
        }
        $id   = Request::GetSession('user_id');
        $sql  = "SELECT * FROM users WHERE users_id=?";
        return Getter::GetFreeData($sql, [$id]);
    }
    
    //Actions
    public function LogIn()
    {
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
            
            if(controller::GetModel()->Login())
            {
                return ShopEngine::Help()->RegularRedirect("user", 'account');
            }
            else {
                Request::SetSession('error_login_message', 'error');
            }  
        }
    }
    
    public function SignUp()
    {
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
            
            if(Controller::GetModel()->ValidateSignUp())
            {
                if(Controller::getModel()->SignUp())
                {
                    Request::SetSession('sign_message', 'success');
                }
            }
            else {
                    Request::SetSession('sign_message', 'error');
            }   
        }
    }
    
    // Проверить!
    public function Activate()
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
                if(Controller::getModel()->Activate($array))
                {
                    
                    if(Request::Post('activate'))
                    {
                        $csrf = Request::Post('csrf');

                        if(!ShopEngine::Help()->ValidateToken($csrf))
                        {
                            return Route::ErrorPage404();
                        }
                        $post = Request::Post();

                        if(Controller::getModel()->Finish($post))
                        {
                            return ShopEngine::Help()->RegularRedirect("user", 'login');
                        }
                    } 
                    return true;
                }
                return false;
            }
        }
        return Route::ErrorPage404();   
    }
    
    public function Account()
    {
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
                if(!Controller::GetModel()->PasswordChange())
                {
                    return false;
                }
            }
            
            if(!Controller::GetModel()->UserChange())
            {
                return false;
            }
            
            return ShopEngine::Help()->RegularRedirect('user', 'account');
        }
        
    }
    
    public function Orders()
    {
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
        
        return [
            'orders'  => $orders,
            'addresses' => $addresses
        ];
    }
    
    public function Addresses()
    {
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
            
            if(Controller::GetModel()->ChangeAddress($addid))
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
            
            if(Controller::GetModel()->NewAddress())
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
        
        return [
            'addresses' => $addresses,
            'red'       => $red,
        ];
        
    }
    
    public function Red()
    {
        $red_id = Request::Get('addid');
            
        if(!$red_id)
        {
            $red = false;
        }

        $red = Controller::GetModel()->GetAddress($red_id);

        if(count($red) < 1)
        {
            $red = false;
        }
        
        $return = $this->Addresses();
        
        $return['red'] = $red;
        
        return $return;
    }
    
    public function Add()
    {
        $new = true;
        
        $return = $this->Addresses();
        
        $return['new'] = $new;
        
        return $return;
    }
    
    public function logout()
    {
        if(!Request::GetSession('user_is_logged'))
        {
            return ShopEngine::Help()->RegularRedirect('user', 'login');
        }
        
        Request::EraseUserSession();
        
        var_dump($_SESSION);
        
        if(Request::EraseUserSession())
        {
            return ShopEngine::Help()->RegularRedirect('user', 'login');
        }
        
        return ShopEngine::Help()->RegularRedirect('user', 'login');
    }
    
    public function invite()
    {
        if(!Request::GetSession('user_is_logged'))
        {
            return ShopEngine::Help()->RegularRedirect('user', 'login');
        }
        
        if(!ShopEngine::Help()->ValidateUser())
        {
            return false;
        }
        
        if(Request::Post('invite'))
        {
            $csrf = Request::Post('csrf');
            
            if(!ShopEngine::Help()->ValidateToken($csrf))
            {
                return ShopEngine::GoHome();
            }
            
            if(!Controller::GetModel()->SendInvite())
            {
                return false;
            }
            
            return true;
        }
    }

    //Set view name
    public static function SetView()
    {
        $action = ShopEngine::GetAction();
        
        switch ($action) 
        {
            case 'login':
                return 'View_Login';
            case 'signup':
                return 'View_SignUp';
            case 'activate':
                return 'View_Activate';
            case 'account':
                return 'View_MyAccount';
            case 'logout':
                return 'View_Login';
            case 'orders':
                return 'View_Orders';
            case 'addresses':
                return 'View_Addresses';
            case 'invite':
                return 'View_Invite';
            default:
                return Route::ErrorPage404();
        }
    }
    
}
