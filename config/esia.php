<?php

return [
    'esia_mnimonica' => env("ESIA_MNIMONICA", null),
    'esia_url' => env("ESIA_URL", "https://esia-portal1.test.gosuslugi.ru"),
    'esia_redirect_url' => env("ESIA_REDIRECT_URL", ""),
    'esia_auth_url_sufix' => env("ESIA_AUTH_URL_SUFIX", "/aas/oauth2/ac"),
    'esia_token_url_sufix' => env("ESIA_AUTH_URL_SUFIX", "/aas/oauth2/te"),
    'esia_access_type' => env("ESIA_ACCESS_TYPE", "online"),
    'esia_response_type' => env("ESIA_RESPONSE_TYPE", "code"),
    'esia_scope' => env("ESIA_SCOPE", ['fullname','email', 'mobile', 'snils']),
    'signer_token' => env("CRUPTO_SERVICE_TOKEN", null),
    'signer_url' => env("CRUPTO_SERVICE_URL", null),
];
