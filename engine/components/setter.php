<?php

class Setter extends ShopEngine{
    
    public static function InsertFreeData($sql, $paarms = NULL)
    {
        $db = database::getInstance();
        
        if($params)
        {
            $query = $db->prepare($sql);
            return $query->execute($params);
        }
        else {
            return $db->query($sql);
        }
    }
    
}
