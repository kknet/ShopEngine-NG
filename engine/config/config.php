<?php

class Config { 
    //Database
    public static $db = [
        'host'     => 'localhost',
        'username' => 'root',
        'database' => 'shopify',
        'password' => ''
    ];
    //Other
    public static $config = [
        'admin_email' => 'alexandergrachyov@gmail.com',
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
        'widgets' => [
            'WidgetMenu',
            'WidgetMenuProducts'
        ],
        'points' => 300,
        'orders_location' => 'files/orders/',
        'http_key' => 'asldjfgqwiuyrgoqw8fygsajdhfbos3iurtw0b389r7263b0rucgfalksjdfhacpbe498gydofijahsdofiuay409w8cyefoiasdhgfapw9384yrcbIFUHSDAIFUVYVBW0C498ABEFODISDHFAVPBI4WYBC09WRYbwoeituvayw08r97'
    ];
    
    public static function Password()
    {
        return [
            'salt' => ShopEngine::Help()->generateToken()
        ];
    }
}
