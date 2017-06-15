<?php

class Config { 
    //Database
    public static $db = [
        'host'     => 'localhost',
        'username' => 'root',
        'database' => 'poterpite',
        'password' => '1234'
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
    
    //Development and updates
    public static $dev = [
        'zip_password' => 'hdfuidytfiw837tsgkdjhfqg2i387twd8oiufba',
        'app_key'      => 'fkdsjhgpw938e4phaf;kjdchg'
    ];
    
    public static function Password()
    {
        return [
            'salt' => ShopEngine::Help()->generateToken()
        ];
    }
}
