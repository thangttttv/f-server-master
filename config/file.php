<?php

return [
    'acceptable' => [
        'file' => [
            'application/pdf' => 'pdf',
            'application/octet-stream' => '',
            'application/zip' => 'zip',
            'text/plain' => 'txt',
        ],
        'image' => [
            'image/png' => 'png',
            'image/jpeg' => 'jpeg',
            'image/gif' => 'gif',
            'image/jpg' => 'jpg',
        ],
    ],
    'categories' => [
        'article-cover-image' => [
            'name' => 'article-cover-image',
            'type' => 'image',
            'region' => env('AWS_IMAGE_REGION'),
            'buckets' => [
                env('AWS_IMAGE_BUCKET'),
            ],
            'size' => [1440, 0],
            'thumbnails' => [
                [400, 300],
                [800, 600],
                [640, 640],  // Instagram
                [735, 1102], // Pinterest
                [1024, 512], // Twitter Card
                [1280, 628], // Facebook OGP
                [1440, 900],
            ],
            'seedPrefix' => 'article-cover',
            'format' => 'jpeg',
        ],
        'article-image' => [
            'name' => 'article-image',
            'type' => 'image',
            'region' => env('AWS_IMAGE_REGION'),
            'buckets' => [
                env('AWS_IMAGE_BUCKET'),
            ],
            'size' => [1440, 0],
            'thumbnails' => [
                [400, 300],
            ],
            'seedPrefix' => 'article',
            'format' => 'jpeg',
        ],
        'ogp-image' => [
            'name' => 'ogp-image',
            'type' => 'image',
            'region' => env('AWS_IMAGE_REGION'),
            'buckets' => [
                env('AWS_IMAGE_BUCKET'),
            ],
            'size' => [1280, 628],
            'thumbnails' => [
            ],
            'seedPrefix' => 'ogp',
            'format' => 'jpeg',
        ],
        'country-flag-image'  => [
            'name'       => 'country-flag-image',
            'type'       => 'image',
            'region'     => env('AWS_IMAGE_REGION'),
            'buckets'    => [
                env('AWS_IMAGE_BUCKET'),
            ],
            'size'       => [104, 76],
            'thumbnails' => [],
            'seedPrefix' => 'country-flag',
            'format'     => 'jpeg',
        ],
        'twitter-card-image' => [
            'name' => 'twitter-card-image',
            'type' => 'image',
            'region' => env('AWS_IMAGE_REGION'),
            'buckets' => [
                env('AWS_IMAGE_BUCKET'),
            ],
            'size' => [1024, 512],
            'thumbnails' => [
            ],
            'seedPrefix' => 'twitter-card',
            'format' => 'jpeg',
        ],
        'advertiser-profile-image' => [
            'name' => 'advertiser-profile-image',
            'type' => 'image',
            'region' => env('AWS_IMAGE_REGION'),
            'buckets' => [
                env('AWS_IMAGE_BUCKET'),
            ],
            'size' => [1440, 0],
            'thumbnails' => [
                [400, 300],
            ],
            'seedPrefix' => 'advertiser-profile',
            'format' => 'png',
            'default-avatar' => 'img/user.png'
        ],
        'user-profile-image' => [
            'name' => 'user-profile-image',
            'type' => 'image',
            'region' => env('AWS_IMAGE_REGION'),
            'buckets' => [
                env('AWS_IMAGE_BUCKET'),
            ],
            'size' => [1440, 0],
            'thumbnails' => [
                [400, 300],
            ],
            'seedPrefix' => 'user-profile',
            'format' => 'jpeg',
            'default-avatar' => 'img/user.png'
        ],
        'campaign-image' => [
            'name' => 'campaign-image',
            'type' => 'image',
            'region' => env('AWS_IMAGE_REGION'),
            'buckets' => [
                env('AWS_IMAGE_BUCKET'),
            ],
            'size' => [1440, 0],
            'thumbnails' => [
                [400, 300],
            ],
            'seedPrefix' => 'campaign-image',
            'format' => 'png',
        ],
        'license-image' => [
            'name' => 'license-image',
            'type' => 'image',
            'region' => env('AWS_IMAGE_REGION'),
            'buckets' => [
                env('AWS_IMAGE_BUCKET'),
            ],
            'size' => [1440, 0],
            'thumbnails' => [
                [400, 300],
            ],
            'seedPrefix' => 'license-image',
            'format' => 'png',
        ],
        'car-image' => [
            'name' => 'car-image',
            'type' => 'image',
            'region' => env('AWS_IMAGE_REGION'),
            'buckets' => [
                env('AWS_IMAGE_BUCKET'),
            ],
            'size' => [1440, 0],
            'thumbnails' => [
                [400, 300],
            ],
            'seedPrefix' => 'car-image',
            'format' => 'png',
        ],
        'licence-image' => [
            'name' => 'licence-image',
            'type' => 'image',
            'region' => env('AWS_IMAGE_REGION'),
            'buckets' => [
                env('AWS_IMAGE_BUCKET'),
            ],
            'size' => [1440, 0],
            'thumbnails' => [
                [400, 300],
            ],
            'seedPrefix' => 'licence-image',
            'format' => 'png',
        ],

        'message-image' => [
            'name' => 'message-image',
            'type' => 'image',
            'region' => env('AWS_IMAGE_REGION'),
            'buckets' => [
                env('AWS_IMAGE_BUCKET'),
            ],
            'size' => [1440, 0],
            'thumbnails' => [
                [400, 300],
            ],
            'seedPrefix' => 'message-image',
            'format' => 'png',
        ],
    ],
];
