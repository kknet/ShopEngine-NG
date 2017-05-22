<?php

class Model_Pages extends Model{
    
    public function Validate()
    {
        $post = Request::Post();
        
        if(!$post) {
            return true;
        }
        
        // Name
        if(!$post['contact_name'] OR !$post['contact_email'] OR !$post['contact_phone'] OR !$post['contact_body'])
        {
            return true;
        }
        
        return false;
        
    }
    
    public function Feedback()
    {
        $post = Request::Post();
        
        if(!$post) {
            return false;
        }
        
        // let's do it
        $db  = database::getInstance();
        $sql = "INSERT INTO feedback(feedback_name, feedback_email, feedback_phone, feedback_body, feedback_datetime) "
                . "VALUES ("
                . ":name, "
                . ":email, "
                . ":phone, "
                . ":body, "
                . "NOW()"
                . ")";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":name", $post['contact_name']);
        $stmt->bindParam(":email", $post['contact_email']);
        $stmt->bindParam(":phone", $post['contact_phone']);
        $stmt->bindParam(":body", $post['contact_body'], PDO::PARAM_STR);
        
        if($stmt->execute())
        {
            return true;
        }
        
        return false;
    }
    
}
