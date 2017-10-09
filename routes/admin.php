<?php

\Route::group(['prefix' => 'admin', 'middleware' => ['admin.values']], function () {

    \Route::group(['middleware' => ['admin.guest']], function () {
        \Route::get('signin', 'Admin\AuthController@getSignIn');
        \Route::post('signin', 'Admin\AuthController@postSignIn');
        \Route::get('forgot-password', 'Admin\PasswordController@getForgotPassword');
        \Route::post('forgot-password', 'Admin\PasswordController@postForgotPassword');
        \Route::get('reset-password/{token}', 'Admin\PasswordController@getResetPassword');
        \Route::post('reset-password', 'Admin\PasswordController@postResetPassword');
    });

    \Route::group(['middleware' => ['admin.auth']], function () {
        \Route::get('/', 'Admin\IndexController@index');

        \Route::get('/me', 'Admin\MeController@index');
        \Route::put('/me', 'Admin\MeController@update');
        \Route::get('/me/notifications', 'Admin\MeController@notifications');

        \Route::post('signout', 'Admin\AuthController@postSignOut');
        \Route::get('user/{id}', 'Admin\UserController@loadUserAjax');
        \Route::resource('users', 'Admin\UserController');
        \Route::resource('admin-users', 'Admin\AdminUserController');
        \Route::resource('site-configurations', 'Admin\SiteConfigurationController');
        \Route::delete('images/delete', 'Admin\ImageController@deleteByUrl');

        \Route::resource('user-notifications', 'Admin\UserNotificationController');
        \Route::resource('admin-user-notifications', 'Admin\AdminUserNotificationController');
        \Route::resource('images', 'Admin\ImageController');
        \Route::resource('countries', 'Admin\CountryController');
        \Route::resource('cities', 'Admin\CityController');
        \Route::resource('advertisers', 'Admin\AdvertiserController');
        \Route::resource('areas', 'Admin\AreaController');
        \Route::resource('oauth-clients', 'Admin\OauthClientController');
        \Route::resource('campaigns', 'Admin\CampaignController');
        \Route::resource('campaign-images', 'Admin\CampaignImageController');
        \Route::resource('campaigns', 'Admin\CampaignController');
        \Route::resource('area-weights', 'Admin\AreaWeightController');
        \Route::resource('area-weight-logs', 'Admin\AreaWeightLogController');
        \Route::get('chats', 'Admin\ChatController@index');
        \Route::get('chats/{user_id}', 'Admin\ChatController@chat');
        \Route::resource('advertiser-notifications', 'Admin\AdvertiserNotificationController');
        \Route::resource('payment-logs', 'Admin\PaymentLogController');
        \Route::resource('banks', 'Admin\BankController');
        \Route::resource('bank-accounts', 'Admin\BankAccountController');
        \Route::get('chats/{user_id}/{campaign_id}', 'Admin\ChatController@chat');
        \Route::resource('campaign-users', 'Admin\CampaignUserController');
        \Route::post('campaign-users/{campaign_user_id}/approve', 'Admin\CampaignUserController@approve');
        \Route::get('campaign-users/{campaign_user_id}/approve', 'Admin\CampaignUserController@approve');
        /* NEW ADMIN RESOURCE ROUTE */
    });
});
