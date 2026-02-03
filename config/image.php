<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Image Driver
    |--------------------------------------------------------------------------
    |
    | Image manipulation library to use. Default is GD, but you can also use
    | Imagick if you have it installed on your server.
    |
    | Supported: "gd", "imagick"
    |
    */
    'driver' => env('IMAGE_DRIVER', 'gd'),

    /*
    |--------------------------------------------------------------------------
    | Image Quality
    |--------------------------------------------------------------------------
    |
    | Default quality for image encoding. Lower values result in smaller
    | file sizes but lower image quality.
    |
    */
    'quality' => env('IMAGE_QUALITY', 80),

    /*
    |--------------------------------------------------------------------------
    | Thumbnail Settings
    |--------------------------------------------------------------------------
    |
    | Default dimensions for thumbnail generation.
    |
    */
    'thumbnail' => [
        'width' => env('THUMBNAIL_WIDTH', 800),
        'height' => env('THUMBNAIL_HEIGHT', 600),
    ],

    /*
    |--------------------------------------------------------------------------
    | Image Settings
    |--------------------------------------------------------------------------
    |
    | Default maximum dimensions for regular images.
    |
    */
    'image' => [
        'max_width' => env('IMAGE_MAX_WIDTH', 1200),
        'max_height' => env('IMAGE_MAX_HEIGHT', 800),
    ],
];