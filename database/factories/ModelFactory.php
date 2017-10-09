<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    return [
        'first_name'               => $faker->name,
        'last_name'                => $faker->name,
        'phone_number'             => $faker->phoneNumber,
        'country_code'             => $faker->countryCode,
        'current_latitude'         => $faker->latitude,
        'current_longitude'        => $faker->longitude,
        'email'                    => $faker->email,
        'password'                 => bcrypt(str_random(10)),
        'remember_token'           => str_random(10),
        'locale'                   => $faker->languageCode,
        'profile_image_id'         => 0,
        'drivers_licence_image_id' => 0,
        'city_id'                  => 0,
        'main_area_id'             => 0,
        'date_of_birth'            => $faker->date(),
    ];
});


$factory->define(App\Models\AdminUser::class, function (Faker\Generator $faker) {
    return [
        'name'             => $faker->name,
        'email'            => $faker->email,
        'password'         => bcrypt(str_random(10)),
        'remember_token'   => str_random(10),
        'locale'           => $faker->languageCode,
        'profile_image_id' => 0,
    ];
});

$factory->define(App\Models\SiteConfiguration::class, function (Faker\Generator $faker) {
    return [
        'locale'                => 'ja',
        'name'                  => $faker->name,
        'title'                 => $faker->sentence,
        'keywords'              => implode(',', $faker->words(5)),
        'description'           => $faker->sentences(3, true),
        'ogp_image_id'          => 0,
        'twitter_card_image_id' => 0,
    ];
});

$factory->define(App\Models\Image::class, function (Faker\Generator $faker) {
    return [
        'url'                => $faker->imageUrl(),
        'title'              => $faker->sentence,
        'is_local'           => false,
        'entity_type'        => 'something',
        'entity_id'          => 0,
        'file_category_type' => 'something',
        's3_key'             => '',
        's3_bucket'          => '',
        's3_region'          => '',
        's3_extension'       => 'png',
        'media_type'         => 'image/png',
        'format'             => 'png',
        'file_size'          => 0,
        'width'              => 100,
        'height'             => 100,
        'is_enabled'         => true,
    ];
});

$factory->define(App\Models\UserNotification::class, function (Faker\Generator $faker) {
    return [
        'user_id'       => \App\Models\UserNotification::BROADCAST_USER_ID,
        'category_type' => \App\Models\UserNotification::CATEGORY_TYPE_SYSTEM_MESSAGE,
        'type'          => \App\Models\UserNotification::TYPE_GENERAL_MESSAGE,
        'data'          => '',
        'locale'        => 'en',
        'content'       => 'TEST',
        'read'          => false,
        'sent_at'       => $faker->dateTime,
    ];
});

$factory->define(App\Models\AdminUserNotification::class, function (Faker\Generator $faker) {
    return [
        'user_id'       => \App\Models\AdminUserNotification::BROADCAST_USER_ID,
        'category_type' => \App\Models\AdminUserNotification::CATEGORY_TYPE_SYSTEM_MESSAGE,
        'type'          => \App\Models\AdminUserNotification::TYPE_GENERAL_MESSAGE,
        'data'          => '',
        'locale'        => 'en',
        'content'       => 'TEST',
        'read'          => false,
        'sent_at'       => $faker->dateTime,
    ];
});

$factory->define(App\Models\Advertiser::class, function (Faker\Generator $faker) {
    return [
        'name'             => $faker->name,
        'email'            => $faker->email,
        'password'         => $faker->word,
        'locale'           => 'en',
        'profile_image_id' => 0,
        'remember_token'   => '',
    ];
});

$factory->define(App\Models\TrackingLog::class, function (Faker\Generator $faker) {
    return [
        'user_id'               => 0,
        'date'                  => $faker->date(),
        'campaign_id'           => 0,
        'distance'              => 0.0,
        'revenue'               => 0.0,
        'revenue_currency_code' => '',
        'trajectory'            => null,
    ];
});

$factory->define(App\Models\CampaignUser::class, function (Faker\Generator $faker) {
    return [
        'campaign_id'       => 0,
        'user_id'           => 0,
        'wrapping_image_id' => 0,
        'status'            => 'pending',
        'finished_at'       => null,
    ];
});

$factory->define(App\Models\Campaign::class, function (Faker\Generator $faker) {
    return [
        'name'                 => $faker->name,
        'description'          => $faker->sentence,
        'distance'             => 0,
        'minimum_revenue'      => 0,
        'maximum_revenue'      => 0,
        'budget_currency_code' => $faker->currencyCode,
        'budget'               => 0,
        'spend'                => 0,
        'total_impression'     => 0,
        'start_date'           => $faker->date(),
        'end_date'             => $faker->date(),
        'country_code'         => $faker->countryCode,
        'city_id'              => 0,
        'advertiser_id'        => 0,
        'brand_image_id'       => 0,
        'status'               => 'pending',
    ];
});

$factory->define(App\Models\Country::class, function (Faker\Generator $faker) {
    return [
        'code'          => $faker->countryCode,
        'name_en'       => $faker->country,
        'name_local'    => $faker->country,
        'flag_image_id' => 0,
        'order'         => 0,
    ];
});

$factory->define(App\Models\City::class, function (Faker\Generator $faker) {
    return [
        'name_en'      => $faker->name,
        'name_local'   => $faker->name,
        'country_code' => $faker->countryCode,
        'order'        => 0,
    ];
});

$factory->define(App\Models\Area::class, function (Faker\Generator $faker) {
    return [
        'name_en'       => $faker->name,
        'name_local'    => $faker->name,
        'city_id'       => 0,
        'country_code'  => $faker->countryCode,
        'location_data' => 'test',
        'order'         => 1,
    ];
});

$factory->define(App\Models\CampaignImage::class, function (Faker\Generator $faker) {
    return [
        'base_revenue'  => 100,
        'image_type'    => 'full',
        'currency_code' => 'VND',
        'campaign_id'   => 1,
        'image_id'      => 0,
    ];
});

$factory->define(App\Models\CampaignArea::class, function (Faker\Generator $faker) {
    return [
        'campaign_id' => 0,
        'area_id'     => 0,
    ];
});

$factory->define(App\Models\CurrentLocation::class, function (Faker\Generator $faker) {
    return [
        'longitude'   => 0,
        'latitude'    => 0,
        'recorded_at' => $faker->dateTime,
        'user_id'     => 0,
        'campaign_id' => 0,
    ];
});

$factory->define(App\Models\Bank::class, function (Faker\Generator $faker) {
    return [
        'name'        => $faker->name,
        'description' => 'test',
        'order'       => 0,
    ];
});

$factory->define(App\Models\PaymentLog::class, function (Faker\Generator $faker) {
    return [
        'user_id'         => 0,
        'bank_account_id' => 0,
        'status'          => 'paid',
        'paid_amount'     => 300,
        'paid_for_month'  => $faker->date('Y-m'),
        'currency_code'   => 'thb',
        'paid_at'         => $faker->date(),
        'note'            => 'note',
    ];
});

$factory->define(App\Models\BankAccount::class, function (Faker\Generator $faker) {
    return [
        'user_id'      => 0,
        'bank_id'      => 0,
        'owner_name'   => $faker->name,
        'branch_name'  => $faker->name,
        'account_info' => 'test',
    ];
});

$factory->define(App\Models\Car::class, function (Faker\Generator $faker) {
    return [
        'name'                 => '',
        'car_model'            => '',
        'license_plate_number' => '',
        'year_of_manufacture'  => 2017,
        'user_id'              => 0,
        'image_id'             => 0,
    ];
});

$factory->define(App\Models\OauthClient::class, function (Faker\Generator $faker) {
    return [
        'user_id'                => 0,
        'name'                   => $faker->name,
        'secret'                 => rand(11111, 99999),
        'redirect'               => 'localhost',
        'personal_access_client' => 0,
        'password_client'        => 1,
        'revoked'                => '',
    ];
});
$factory->define(App\Models\AreaWeight::class, function (Faker\Generator $faker) {
    return [
        'area_id'     => 1,
        'day_of_week' => 1,
        'start_time'  => 0,
        'end_time'    => 8,
        'weight'      => 1.5,
    ];
});

$factory->define(App\Models\AreaWeightLog::class, function (Faker\Generator $faker) {
    return [
        'area_id'     => 0,
        'day_of_week' => 1,
        'start_time'  => 0,
        'end_time'    => 8,
        'weight'      => 1.5,
        'active_to'   => $faker->dateTime,
    ];
});


$factory->define(App\Models\OauthAccessToken::class, function (Faker\Generator $faker) {
    return [
        'user_id' => 0,
        'client_id' => 0,
        'name' => 'test',
        'scopes' => 'test',
        'revoked' => 1,
        'expires_at' => $faker->dateTime,
    ];
});

$factory->define(App\Models\OauthRefreshToken::class, function (Faker\Generator $faker) {
    return [
        'access_token_id' => 0,
        'revoked' => 1,
        'expires_at' => $faker->dateTime,
    ];
});

$factory->define(App\Models\AdvertiserNotification::class, function (Faker\Generator $faker) {
    return [
        'advertiser_id' => \App\Models\AdvertiserNotification::BROADCAST_ADVERTISER_ID,
        'category_type' => \App\Models\AdvertiserNotification::CATEGORY_TYPE_SYSTEM_MESSAGE,
        'type'          => \App\Models\AdvertiserNotification::TYPE_GENERAL_MESSAGE,
        'data'          => '',
        'locale'        => 'en',
        'content'       => 'TEST',
        'read'          => false,
        'sent_at'       => $faker->dateTime,
    ];
});

$factory->define(App\Models\UserDistance::class, function (Faker\Generator $faker) {
    return [
        'user_id'          => 0,
        'campaign_id'      => 0,
        'area_id'          => 0,
        'distance'         => 0,
        'total_cost'       => 0,
        'total_impression' => 0,
        'date'             => $faker->date(),
    ];
});

$factory->define(App\Models\AreaImpression::class, function (Faker\Generator $faker) {
    return [
        'campaign_area_id' => 0,
        'campaign_id'      => 0,
        'total_impression' => 0,
        'total_cost'       => 0,
        'date'             => $faker->date(),
    ];
});

$factory->define(App\Models\CampaignImpression::class, function (Faker\Generator $faker) {
    return [
        'campaign_id'      => 0,
        'total_impression' => 0,
        'total_cost'       => 0,
        'date'             => $faker->date(),
    ];
});

/* NEW MODEL FACTORY */
