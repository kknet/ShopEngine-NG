<?php 

/*
 * Я максимально старался отделить логику от представления, но в некоторых моментах пришлось этим пренебречь
 * (!ПЕРЕДЕЛАТЬ) - Создать одну таблицу с категориями различной вложенности.
 * 
 */

class RightSidebar extends Model 
{
    
    public static function GetTheMenu() 
    {

        $db = database::getInstance();
        $cat = $db->query("SELECT * FROM category_high_level");

        echo '<ul>';

        while($cur = $cat->fetch())
        {

            echo '<li><a href="">'.$cur["hign_disp_name"].'</a>';

                $id  = $cur["high_id"];
                $sub_cat = $db->query("SELECT * FROM category_middle_level WHERE table_id=$id");
                if($sub_cat)
                {
                    echo '<ul>';
                    while($cur_sub = $sub_cat->fetch())
                    {
                        echo '<a href="/category/'.strtolower($cur_sub["middle_id"]).'"><li>'.$cur_sub["middle_disp_name"].'</li></a>';
                    }
                    echo '</ul>';
                }

            echo '</li>';

        }

        echo '</ul>';

    }
    
    public static function GetCategories()
    {
        $db = database::getInstance();
        
        echo '<option value="" selected>неважно</option>';
        $cat = $db->query("SELECT * FROM category_high_level");
        if($cat)
        {
            while($cur = $cat->fetch())
            {
                
                $id = $cur['high_id'];
                $sub_cat = $db->query("SELECT * FROM category_middle_level WHERE table_id=$id");
                if($sub_cat)
                {
                    while($cur_sub = $sub_cat->fetch())
                    {
                        if ($_GET["select_type"]) 
                        {
                            if ($cat_row_mid["middle_id"] === $_GET["select_type"]) 
                            {
                                $check_list = "selected";
                            }
                        }
                        
                        echo '<option value="'.$cur_sub['middle_id'].' '.$check_list.'">'.$cur_sub['middle_disp_name'].'</option>';
                        $check_list = NULL;
                    }
                }
        
            }
        }
 
    }
    
    public static function GetBrands()
    {
        $db = database::getInstance();
        
        $br = $db->query("SELECT * FROM brands");
        if($br)
        {
            while($cur = $br->fetch())
            {
                if ($_GET["select_model"]) 
                {
                    if (in_array($brand_row["brand_id"],$_GET["select_model"])) 
                    {
                        $check_checkbox = "checked";
                    }
                }
                
                echo '<input type="checkbox" name="select_model[]" value="'.$cur["brand_id"].'" '.$check_checkbox.'><label for="search_checkbox'.$cur["brand_id"].'">'.$cur["brand_name"].'</label><br/>';
                $check_checkbox = NULL;
            }
        }
    }

}
