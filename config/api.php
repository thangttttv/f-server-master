<?php

return [
    'errors'  => [
        'unknown'        => [
            'code'       => 1000,
            'message'    => 'Unknown Error',
            'statusCode' => 400,
        ],
        'notFound'       => [
            'code'       => 1001,
            'message'    => 'Not Found',
            'statusCode' => 400,
        ],
        'notFoundWrappingImage'       => [
            'code'       => 1011,
            'message'    => 'Wrapping image not found, please contact admin.',
            'statusCode' => 400,
        ],
        'authFailed'     => [
            'code'       => 1002,
            'message'    => 'Auth Failed',
            'statusCode' => 401,
        ],
        'signInFailed'     => [
            'code'       => 1012,
            'message'    => 'Please check username or password',
            'statusCode' => 401,
        ],
        'signInRequired' => [
            'code'       => 1003,
            'message'    => 'Sign In Required',
            'statusCode' => 401,
        ],
        'wrongParameter' => [
            'code'        => 1004,
            'message'     => 'Wrong Parameters',
            'statusCode' => 400,
        ],
        'severError'     => [
            'code'       => 1005,
            'message'    => 'Server error',
            'statusCode' => 500,
        ],
        'driverLicenceEmpty' => [
            'code'        => 4060,
            'message'     => 'Driver licence was empty, you must upload driver licence',
            'statusCode' => 406,
        ],
        'carEmpty' => [
            'code'        => 4064,
            'message'     => 'Car image is empty',
            'statusCode' => 406,
        ],
        'campaignAlreadyApply' => [
            'code'        => 4061,
            'message'     => 'You\'ve already applied for this campaign',
            'statusCode' => 406,
        ],
        'cancelCampaignPermissionDenied' => [
            'code'        => 4062,
            'message'     => 'Cancel campaign failed due permission',
            'statusCode' => 406,
        ],
        'trackingPostDuplicate' => [
            'code'        => 4063,
            'message'     => 'Tracking logs duplicate',
            'statusCode' => 406,
        ],
        'authFacebookFailed'     => [
            'code'       => 4101,
            'message'    => 'Cannot get user email from facebook',
            'statusCode' => 401,
        ],
    ],
    'validateErrors' => [
        'clientValidate' => [
            'code'        => 2011,
            'message'     => 'Invalid client id or client secret',
        ],
        'required' => [
            'code'        => 4001,
            'message'     => 'The :attribute is required',
        ],
        'email' => [
            'code'        => 4002,
            'message'     => 'Invalid format email',
        ],
        'unique' => [
            'code'        => 4003,
            'message'     => 'This field value already exist',
        ],
        'min' => [
            'code'        => 4004,
            'message'     => 'This field need min length',
        ],
        'image' => [
            'code'        => 4005,
            'message'     => 'Invalid image type',
        ],
        'date' => [
            'code'        => 4006,
            'message'     => 'Invalid date format',
        ],
        'dateFormat' => [
            'code'        => 4007,
            'message'     => 'Invalid date format Y-m-d',
        ],
        'before' => [
            'code'        => 4008,
            'message'     => 'Invalid date, before now',
        ],
        'exists' => [
            'code'        => 4009,
            'message'     => 'The :attribute doesn\' exists',
        ],
    ],
    'headers' => [
        'locale'    => 'X-FLARE-LOCALE',
        'version'   => 'X-FLARE-VERSION',
        'osType'    => 'X-FLARE-OS-VERSION',
        'osVersion' => 'X-FLARE-OS-TYPE',
    ],
];
