<?php

return [
    'wsdl_url' => env('GOSKEY_WSDL_URL', 'http://smev3-n0.test.gosuslugi.ru:7500/smev/v1.2/ws?wsdl'),
    'backlink' => env('GOSKEY_BACKLINK','https://invest.rkursk.ru/'),
    'is_contur' => env('GOSKEY_IS_CONTUR','MNSV05'),
    'ftp' => [
        'host' => env('GOSKEY_FTP_HOST', 'smev3-n0.test.gosuslugi.ru'),
        'port' => env('GOSKEY_FTP_PORT', 21),
    ],
];
