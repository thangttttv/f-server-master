<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'mandrill' => [
        'secret' => env('MANDRILL_SECRET'),
    ],

    'ses' => [
        'key'    => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model'  => \App\Models\User::class,
        'key'    => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'facebook' => [
        'client_id'       => env('FACEBOOK_APP_ID'),
        'client_secret'   => env('FACEBOOK_SECRET'),
        'redirect_action' => 'User\FacebookServiceAuthController@callback',
    ],

    'twitter' => [
        'client_id'       => '',
        'client_secret'   => '',
        'redirect_action' => '',
    ],

    'google'   => [
        'client_id'       => '',
        'client_secret'   => '',
        'redirect_action' => '',
    ],
    'firebase' => [
        'firebase_url' => env('FIREBASE_URL', 'https://flare-b0fab.firebaseio.com/'),
    ],

    'github' => [
        'client_id'       => '',
        'client_secret'   => '',
        'redirect_action' => '',
    ],

    'dynamodb' => [
        'key'            => env('AWS_KEY', 'KEY'),
        'secret'         => env('AWS_SECRET', 'SECRET'),
        'region'         => env('DYNAMODB_REGION', 'ap-northeast-1'),
        'local_endpoint' => env('DYNAMODB_LOCAL_ENDPOINT', 'https://dynamodb.ap-northeast-1.amazonaws.com/'),
        // see http://docs.aws.amazon.com/amazondynamodb/latest/developerguide/Tools.DynamoDBLocal.html
        'local'          => env('DYNAMODB_LOCAL', false),
        // true or false? should use dynamodb_local or not?
    ],

];
