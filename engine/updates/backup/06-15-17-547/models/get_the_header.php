<?php 

class HeaderInform extends Model 
{
    public static function GetInformation()
    {
        return ShopEngine::GetInformation();
    }

    public static function UserEntry()
    {
        if($_SESSION['autorization'] == 'autorization_yes') {
            echo '<p id="p_authorization">Здравствуйте, <span class="user" href="">'.$_SESSION['autorization_name'].'</span></p>';
        }

        else {
            echo '<p id="p_authorization"><span class="log" >Вход</span> \ <span class="reg">Регистрация</span></p>';
        }
    }

    public static function GetThePhone() 
    {
        $temp = Self::GetInformation();
        return $temp['phone'];
    }
    
    public static function GetThePhoneTitle() 
    {
        $temp = Self::GetInformation();
        return $temp['phone_title'];
    }
    
    public static function GetTheLogo() 
    {
        $temp = Self::GetInformation();
        return $temp['logo'];
    }
    
    public static function GetTheIcon() 
    {
        $temp = Self::GetInformation();
        return $temp['icon'];
    }
    
    public static function GetName() 
    {
        $temp = Self::GetInformation();
        return $temp['sitename'];
    }
    
    public static function GetCopyTitle() 
    {
        $temp = Self::GetInformation();
        return $temp['copy_title'];
    }
    
    public static function GetCopy() 
    {
        $temp = Self::GetInformation();
        return $temp['copy_text'];
    }

    public static function CountOfProducts() 
    {
        $db = database::getInstance();
        return $db->query("SELECT COUNT(*) FROM table_products")->fetchColumn();
    }

    public static function GetSeoKeywords() 
    {
        $temp = Self::GetInformation();
        echo '<meta name="keywords" content="'.$temp['seo_keys'].'" />';
    }
    
    public static function GetSeoDescription() 
    {
        $temp = Self::GetInformation();
        echo '<meta name="keywords" content="'.$temp['seo_desc'].'" />';
    }
    
    
}
