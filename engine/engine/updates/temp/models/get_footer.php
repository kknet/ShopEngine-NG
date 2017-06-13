<?php

/*
 * 
 * (!ПЕРЕДЕЛАТЬ) - Перехват ошибок
 */

class Footer extends Model 
{
    public function GetArticles() 
    {
        $db = database::getInstance();
        
        $block = $db->query("SELECT * FROM article_blocks");
        while($block_row = $block->fetch())
        {
            echo '<div class="GetArticle">';
            echo '<p>'.$block_row["title"].'</p>';
            
            $id = $block_row['id'];
            $art = $db->prepare("SELECT * FROM articles WHERE block_id=?");
            $art->execute([$id]);
            
            echo '<ul>';
            
            while($cur = $art->fetch())
            {
                echo '<li><a href="/article/'.$cur["id"].'">'.$cur['name'].'</a></li>';
            }
            
            echo '</ul>';
            
            echo '</div>';
        }   
            
    }
}
?>