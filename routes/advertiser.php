<?php

\Route::group(['prefix' => 'advertiser', 'middleware' => ['advertiser.values']], function () {
    \Route::get('landing-page', 'Advertiser\LandingController@index');
    \Route::get('terms', 'Advertiser\LandingController@terms');

    \Route::group(['middleware' => ['advertiser.guest']], function () {
        \Route::get('signin', 'Advertiser\AuthController@getSignIn');
        \Route::post('signin', 'Advertiser\AuthController@postSignIn');
    });

    \Route::group(['middleware' => ['advertiser.auth']], function () {
        \Route::get('/', 'Advertiser\DashboardController@index');
        \Route::get('/dashboard', 'Advertiser\DashboardController@index');
        \Route::get('/dashboard/create', 'Advertiser\DashboardController@create');
        \Route::post('/dashboard/create', 'Advertiser\DashboardController@store');
        \Route::get('/dashboard/reports', 'Advertiser\ReportController@index');
        \Route::get('/dashboard/reports/{id}', 'Advertiser\ReportController@detail');
        \Route::get('/dashboard/notifications', 'Advertiser\NotificationController@index');
        \Route::get('/dashboard/drivers', 'Advertiser\DriverController@index');
        \Route::post('signout', 'Advertiser\AuthController@postSignOut');
    });
});



