<?php 

/*
 * 
 * (!ПЕРЕДЕЛАТЬ) - Перехват ошибок
 */

class Slider extends Model 
{
    public static function GetSliderSettings() 
    {
        $db = database::getInstance();
        
        $slider = $db->query("SELECT * FROM slider_conf")->fetchAll(PDO::FETCH_KEY_PAIR);
            $settings = array(
                'speed'  => $slider["speed"], 
                'width'  => $slider['width'], 
                'height' => $slider['height']
            );
        return $settings;
    }
    
        public static function GetSlider() 
        {
            $db = database::getInstance();
            
            $slides = array();
            $slider = $db->query("SELECT * FROM slider");
            if($slider)
            {
                while($cur = $slider->fetch())
                {
                    $image = ShopEngine::Help()->ImageResize($cur["img"], "slider/", false, false, $cur['title']);

                    if(!empty($cur["piclink"])) 
                    {
                        $piclink_start = '<a href="'.$cur["piclink"].'" >';
                        $piclink_end = '</a>';
                    }
                    else 
                    {
                        $piclink_start = '';
                        $piclink_end = '';
                    }

                    $slides[] = $piclink_start.$image.$piclink_end;  
                }
                
                return $slides;
            }
 
        }
}
?>