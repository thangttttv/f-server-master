<?php

\Route::group(['middleware' => ['user.values']], function () {
    \Route::get('/', 'User\IndexController@index');
    \Route::get('/landing-page', 'User\IndexController@index');
    \Route::get('/about', 'User\IndexController@about');
    \Route::get('/policy', 'User\IndexController@policy');
    \Route::get('/terms', 'User\IndexController@terms');
    \Route::get('/faq', 'User\IndexController@faq');
    \Route::get('/contact', 'User\IndexController@contact');


    \Route::group(['middleware' => ['user.guest']], function () {
        \Route::get('signin', 'User\AuthController@getSignIn');
        \Route::post('signin', 'User\AuthController@postSignIn');

        \Route::get('signin/facebook', 'User\FacebookServiceAuthController@redirect');
        \Route::get('signin/facebook/callback', 'User\FacebookServiceAuthController@callback');

        \Route::get('forgot-password', 'User\PasswordController@getForgotPassword');
        \Route::post('forgot-password', 'User\PasswordController@postForgotPassword');

        \Route::get('reset-password/{token}', 'User\PasswordController@getResetPassword');
        \Route::post('reset-password', 'User\PasswordController@postResetPassword');

        \Route::get('signup', 'User\AuthController@getSignUp');
        \Route::post('signup', 'User\AuthController@postSignUp');

    });

    \Route::group(['middleware' => ['user.auth']], function () {

    });
});
