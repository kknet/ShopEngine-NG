<?php

class Config { 
    public static $config = [
        'admin_email' => 'info@poterpite.ru',
        'developer_email' => 'alexandergrachyov@gmail.com',
        'allowed_controllers' => [
            '',
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
            'errorpage',
            'filter'
        ],
        'site_name' => 'Потерпите, пожалуйста!',
        'site_email_name' => 'Потерпите',
        'site_handle' => 'poterpite',
        'protocol'  => 'http://',
        'components' => [
            'getter',
            'setter',
            'paginator',
            'seo',
            'request'
        ],
        'points' => 300,
        'orders_location' => 'files/orders/'
    ];
    
    public static function Password()
    {
        return [
            'salt' => ShopEngine::Help()->generateToken()
        ];
    }
}
