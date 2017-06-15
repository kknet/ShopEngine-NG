<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ymlgenerator
 *
 * @author Alexander Grachyov
 */
class YandexYML extends ShopEngine{
    
    public $body;
    public $date;
    public $name;
    public $comp_name;
    public $comp_url;
    public $categories;
    public $deliveries;
    public $offers;
    
    public function GetOffers()
    {
        $db = database::getInstance();
        
        $sql = "SELECT * FROM products p RIGHT OUTER JOIN category c ON p.category_id = c.category_id WHERE avail='1' AND price <> 0.00";
        $array = Getter::GetFreeData($sql);
        if(!$array)
        {
            return false;
        }
        
        
        foreach ($array as $cur)
        {
            
            if($cur['count'] > 0)
            {
                $pickup = 'true';
            }
            elseif($cur['count'] <= 0 AND $cur['pre'] === 1)
            {
                $pickup = 'false'; 
            }
            else {
                continue;
            }
            
            $offer .= '<offer available="'.$pickup.'" type="vendor.model" id="'.$cur['products_id'].'">
                            <price>'. ShopEngine::Help()->AsSimplePrice($cur['price']).'</price>
                            <url>'.ShopEngine::Help()->ReplaceASCII(ShopEngine::GetHost().'/products/'.$cur['handle']).'</url>
                            <currencyId>RUR</currencyId>
                            <pickup>true</pickup>
                            <delivery>true</delivery>
                            <picture>
                                '.ShopEngine::Help()->ReplaceASCII(ShopEngine::GetHost().'/'.$cur['image']).'
                            </picture>
                            <typePrefix>'.ShopEngine::Help()->ReplaceASCII($cur['name']).'</typePrefix>
                            <vendor>'.ShopEngine::Help()->ReplaceASCII($cur['brand']).'</vendor>
                            <model>'.ShopEngine::Help()->ReplaceASCII($cur['title']).'</model>
                            <categoryId>'.$cur['category_id'].'</categoryId>
                            <description>
                            '. ShopEngine::Help()->ReplaceASCII(ShopEngine::Help()->Clear($cur['description'])).'
                            </description>
                            <vendorCode/>
                            <sales_notes>Скидка 30% на профессиональное отбеливание</sales_notes>
                            <delivery-options>
                                '.$this->GetDeliveries().'
                            </delivery-options>
                        </offer>
                        ';
        }
        
        return $offer;
    }
    
    public function GetDeliveries()
    {
        $db = database::getInstance();
        
        $sql = "SELECT shipper_price, shipper_duration FROM shipper WHERE shipper_duration <> 0";
        $array = Getter::GetFreeData($sql, null, false);
        if(!$array)
        {
            return false;
        }
        
        foreach ($array as $cur)
        {
            $deliveries .= '<option cost="'.$cur['shipper_price'].'" days="'.$cur['shipper_duration'].'"/>
                            ';
        }
        
        return $deliveries;
    }
    
    public function GetCategories()
    {
        $db = database::getInstance();
        
        $sql = "SELECT category_id, name FROM category";
        $array = Getter::GetFreeData($sql);
        if(!$array)
        {
            return false;
        }
        
        foreach($array as $cur)
        {
            $categories .= '<category id="'.$cur['category_id'].'">'.ShopEngine::Help()->ReplaceASCII($cur['name']).'</category>
                            ';
        }
        
        return $categories;
    }
    
    public function GenerateYML()
    {
        
        $this->date       = date('Y-m-d H:s:m');
        $this->name       = 'Потерпите, пожалуйста!';
        $this->comp_name  = 'YardCapital';
        $this->comp_url   = 'https://poterpite.ru';
        $this->categories = $this->GetCategories();
        $this->deliveries = $this->GetDeliveries();
        $this->offers     = $this->GetOffers();
        
        
        $this->body = '<?xml version="1.0" encoding="windows-1251"?>
                        <yml_catalog date="'.$this->date.'">
                        <shop>
                        <name>'.$this->name.'</name>
                        <company>'.$this->comp_name.'</company>
                        <url>'.$this->comp_url.'</url>
                        <currencies>
                        <currency id="RUR" rate="1"/>
                        </currencies>
                        <categories>
                            
                            '.$this->categories.'
                        </categories>
                        <delivery-options>
                        
                            '.$this->deliveries.'
                        </delivery-options>
                        <cpa>1</cpa>
                        <offers>
                        
                            '.$this->offers.'
                        </offers>
                        </shop>
                        </yml_catalog>';
        
        return $this->body;
    }
    
}
