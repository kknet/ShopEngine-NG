<?php

class Widgets {
    
    public function LoadWidgets($widget)
    {
        $this->$widget = new $widget;
    }
    
}
