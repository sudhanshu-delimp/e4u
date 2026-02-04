<?php

return [

    'disk' => env('IMAGE_DISK', 'public'),

    'default' => [
        'original' => 'uploads/common/original/',
        'thumb' => 'uploads/common/thumb/',
    ],

    'modules' => [

        'blog' => [
            'original' => 'uploads/blog/original/',
            'thumb' => 'uploads/blog/thumb',
        ],
        
        // just copy pest and put path according path
       
    ],
  


    'paths' => [
        'original' => 'publications/blog/original',
        'thumb' => 'publications/blog/thumb',
    ],

    'thumb_size' => [
        'width' => 120,
        'height' => 120
    ],
];




