<?php

return [
    'massage_default_icon' => 'default/default_massage.png',
    'escort_default_icon' => 'default/default_escort.png',
    'socket_url' => (env('APP_ENV') === 'production' ? 'https' : 'http') . '://' .env('SOCKET_HOST').':'.env('SOCKET_PORT'),

];





