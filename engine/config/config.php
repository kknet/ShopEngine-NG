<?php

class Config { 
    public static $config = [
        'allowed_controllers' => [
            'catalog',
            'products',
            'collections',
            'ajax',
            'cart',
            'checkout',
            'pages',
            'section',
            'search',
            'user',
            'errorpage'
        ],
        'site_name' => 'Потерпите, пожалуйста!',
        'protocol'  => 'http://',
        'components' => [
            'getter',
            'setter',
            'paginator',
            'seo',
            'request'
        ]
    ];
    
    public static function Password()
    {
        return [
            'salt' => ShopEngine::Help()->generateToken()
        ];
    }
}
