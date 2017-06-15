<?php

class Model_Products extends Model{
    
    public function UpdateCount($data)
    {
        if(Request::GetSession("viewed_{$data['handle']}"))
        {
            return false;
        }
        
        $new_viewed = ++$data['viewed'];
        
        $db  = database::getInstance();
        $sql = "UPDATE products SET viewed=:viewed WHERE handle=:handle";
        $stmt= $db->prepare($sql);
        $stmt->bindParam(":viewed", $new_viewed);
        $stmt->bindParam(":handle", $data['handle']);
        
        if(!$stmt->execute())
        {
            return faslse;
        }
        
        Request::SetSession("viewed_{$data['handle']}", true);
    }
    
}
