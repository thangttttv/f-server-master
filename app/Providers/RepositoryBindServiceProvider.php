<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryBindServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
    }

    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->singleton(\App\Repositories\AdminUserRepositoryInterface::class,
            \App\Repositories\Eloquent\AdminUserRepository::class);

        $this->app->singleton(\App\Repositories\AdminUserRoleRepositoryInterface::class,
            \App\Repositories\Eloquent\AdminUserRoleRepository::class);

        $this->app->singleton(\App\Repositories\UserRepositoryInterface::class, \App\Repositories\Eloquent\UserRepository::class);

        $this->app->singleton(\App\Repositories\FileRepositoryInterface::class, \App\Repositories\Eloquent\FileRepository::class);

        $this->app->singleton(\App\Repositories\ImageRepositoryInterface::class, \App\Repositories\Eloquent\ImageRepository::class);

        $this->app->singleton(\App\Repositories\SiteConfigurationRepositoryInterface::class,
            \App\Repositories\Eloquent\SiteConfigurationRepository::class);

        $this->app->singleton(\App\Repositories\UserServiceAuthenticationRepositoryInterface::class,
            \App\Repositories\Eloquent\UserServiceAuthenticationRepository::class);

        $this->app->singleton(\App\Repositories\PasswordResettableRepositoryInterface::class,
            \App\Repositories\Eloquent\PasswordResettableRepository::class);

        $this->app->singleton(\App\Repositories\UserPasswordResetRepositoryInterface::class,
            \App\Repositories\Eloquent\UserPasswordResetRepository::class);

        $this->app->singleton(\App\Repositories\AdminPasswordResetRepositoryInterface::class,
            \App\Repositories\Eloquent\AdminPasswordResetRepository::class);

        $this->app->singleton(
            \App\Repositories\SiteConfigurationRepositoryInterface::class,
            \App\Repositories\Eloquent\SiteConfigurationRepository::class
        );

        $this->app->singleton(
            \App\Repositories\SiteConfigurationRepositoryInterface::class,
            \App\Repositories\Eloquent\SiteConfigurationRepository::class
        );

        $this->app->singleton(
            \App\Repositories\NotificationRepositoryInterface::class,
            \App\Repositories\Eloquent\NotificationRepository::class
        );

        $this->app->singleton(
            \App\Repositories\UserNotificationRepositoryInterface::class,
            \App\Repositories\Eloquent\UserNotificationRepository::class
        );

        $this->app->singleton(
            \App\Repositories\AdminUserNotificationRepositoryInterface::class,
            \App\Repositories\Eloquent\AdminUserNotificationRepository::class
        );

        $this->app->singleton(
            \App\Repositories\AdvertiserPasswordResetRepositoryInterface::class,
            \App\Repositories\Eloquent\AdvertiserPasswordResetRepository::class
        );

        $this->app->singleton(
            \App\Repositories\AdvertiserRepositoryInterface::class,
            \App\Repositories\Eloquent\AdvertiserRepository::class
        );
        $this->app->singleton(
            \App\Services\ServiceAuthenticationServiceInterface::class,
            \App\Services\Production\ServiceAuthenticationService::class
        );
        $this->app->singleton(
            \App\Repositories\AuthenticatableRepositoryInterface::class,
            \App\Repositories\Eloquent\AuthenticatableRepository::class
        );
        $this->app->singleton(
            \App\Repositories\ServiceAuthenticationRepositoryInterface::class,
            \App\Repositories\Eloquent\ServiceAuthenticationRepository::class
        );

        $this->app->singleton(
            \App\Repositories\CampaignUserRepositoryInterface::class,
            \App\Repositories\Eloquent\CampaignUserRepository::class
        );

        $this->app->singleton(
            \App\Repositories\TrackingLogRepositoryInterface::class,
            \App\Repositories\Eloquent\TrackingLogRepository::class
        );

        $this->app->singleton(
            \App\Repositories\CampaignRepositoryInterface::class,
            \App\Repositories\Eloquent\CampaignRepository::class
        );

        $this->app->singleton(
            \App\Repositories\CountryRepositoryInterface::class,
            \App\Repositories\Eloquent\CountryRepository::class
        );

        $this->app->singleton(
            \App\Repositories\CityRepositoryInterface::class,
            \App\Repositories\Eloquent\CityRepository::class
        );

        $this->app->singleton(
            \App\Repositories\AreaRepositoryInterface::class,
            \App\Repositories\Eloquent\AreaRepository::class
        );

        $this->app->singleton(
            \App\Repositories\CampaignImageRepositoryInterface::class,
            \App\Repositories\Eloquent\CampaignImageRepository::class
        );

        $this->app->singleton(
            \App\Repositories\CampaignAreaRepositoryInterface::class,
            \App\Repositories\Eloquent\CampaignAreaRepository::class
        );

        $this->app->singleton(
            \App\Repositories\CurrentLocationRepositoryInterface::class,
            \App\Repositories\Eloquent\CurrentLocationRepository::class
        );

        $this->app->singleton(
            \App\Repositories\BankRepositoryInterface::class,
            \App\Repositories\Eloquent\BankRepository::class
        );

        $this->app->singleton(
            \App\Repositories\BankAccountRepositoryInterface::class,
            \App\Repositories\Eloquent\BankAccountRepository::class
        );

        $this->app->singleton(
            \App\Repositories\CarRepositoryInterface::class,
            \App\Repositories\Eloquent\CarRepository::class
        );

        $this->app->singleton(
            \App\Repositories\OauthClientRepositoryInterface::class,
            \App\Repositories\Eloquent\OauthClientRepository::class
        );

        $this->app->singleton(
            \App\Repositories\AreaWeightRepositoryInterface::class,
            \App\Repositories\Eloquent\AreaWeightRepository::class
        );

        $this->app->singleton(
            \App\Repositories\AreaWeightLogRepositoryInterface::class,
            \App\Repositories\Eloquent\AreaWeightLogRepository::class
        );

        $this->app->singleton(
            \App\Repositories\AdvertiserNotificationRepositoryInterface::class,
            \App\Repositories\Eloquent\AdvertiserNotificationRepository::class
        );

        $this->app->singleton(
            \App\Repositories\PaymentLogRepositoryInterface::class,
            \App\Repositories\Eloquent\PaymentLogRepository::class
        );

        $this->app->singleton(
            \App\Repositories\OauthAccessTokenRepositoryInterface::class,
            \App\Repositories\Eloquent\OauthAccessTokenRepository::class
        );

        $this->app->singleton(
            \App\Repositories\OauthRefreshTokenRepositoryInterface::class,
            \App\Repositories\Eloquent\OauthRefreshTokenRepository::class
        );

        $this->app->singleton(
            \App\Repositories\UserDistanceRepositoryInterface::class,
            \App\Repositories\Eloquent\UserDistanceRepository::class
        );

        $this->app->singleton(
            \App\Repositories\AreaImpressionRepositoryInterface::class,
            \App\Repositories\Eloquent\AreaImpressionRepository::class
        );

        $this->app->singleton(
            \App\Repositories\CampaignImpressionRepositoryInterface::class,
            \App\Repositories\Eloquent\CampaignImpressionRepository::class
        );
        $this->app->singleton(
            \App\Repositories\DynamoDB\TrackingLogRepositoryInterface::class,
            \App\Repositories\DynamoDB\Eloquent\TrackingLogRepository::class
        );

        /* NEW BINDING */
    }
}
