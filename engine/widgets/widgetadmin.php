<?php

class WidgetAdmin {
    
    public $admin;
    
    public function __construct() {
        $id    = Request::GetSession('admin_id');
        $token = Request::GetSession('admin_token');
        
        $sql   = "SELECT * FROM admin WHERE admin_id=?";
        $admin = Getter::GetFreeData($sql, [$id], true);
        if($admin['admin_session_token'] !== $token)
        {
            return false;
        }
        
        $this->admin = $admin;
    }
    
    public function AdminName()
    {
        return $this->admin['admin_name'];
    }
    
    public function AdminPosition()
    {
        return $this->admin['admin_position'];
    }
    
}
