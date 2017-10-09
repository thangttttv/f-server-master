<?php

Route::group(['prefix' => 'api','namespace' => 'API'], function() {
    Route::group(['prefix' => 'v1', 'namespace' => 'V1'], function() {

        // Status Check
        Route::get('status', 'IndexController@status');

        // Authentication
        Route::post('signup', 'AuthController@postSignUp');
        Route::post('token', 'AuthController@postSignIn');
        Route::post('token/refresh', 'AuthController@postRefreshToken');

        Route::post('facebook-signin', 'FacebookAuthController@facebookSignIn');
        Route::post('forgot-password', 'PasswordController@postForgotPasswordApi');

        Route::get('countries', 'CountryController@allCountries');
        Route::get('cities/{country_code}', 'CityController@getCities');
        Route::get('areas/{city_id}', 'AreaController@getAreas');

        Route::group(['middleware' => 'api.auth'], function() {
            Route::group(['prefix' => 'me'], function() {
                Route::get('/', 'MeController@getMe');
                Route::put('/', 'MeController@updateProfile');

                Route::post('avatar', 'MeController@updateProfileImage');
                Route::put('avatar', 'MeController@updateProfileImage');

                Route::post('driver-licence', 'IndexController@postDriverLicenceImage');
                Route::post('message-image', 'MeController@postMessageImage');
                Route::get('trackings/{date}', 'CampaignController@countDistance');
                Route::get('trackings/{month}', 'CampaignController@countDistance');

                Route::post('bank-account', 'MeController@postBankAccount');

                Route::get('car', 'CarController@myCar');
                Route::post('car', 'CarController@postCar');

                Route::get('campaign', 'CampaignController@getMyCampaign');
                Route::get('payment-logs', 'PaymentLogController@index');
                Route::post('trackings', 'TrackingLogController@postTrackingLog');

            });

            Route::get('banks', 'BankController@getBanks');

            Route::get('campaigns', 'CampaignController@getCampaigns');
            Route::get('campaigns/{id}', 'CampaignController@campaignDetail');
            Route::delete('campaigns/{id}', 'CampaignController@cancelCampaign');
            Route::post('campaigns/{id}/apply', 'CampaignController@applyCampaign');

        });
    });
});
