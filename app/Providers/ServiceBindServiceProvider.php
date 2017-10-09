<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ServiceBindServiceProvider extends ServiceProvider
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
        $this->app->singleton(\App\Services\AdminUserServiceInterface::class,
            \App\Services\Production\AdminUserService::class);

        $this->app->singleton(\App\Services\AsyncServiceInterface::class, \App\Services\Production\AsyncService::class);

        $this->app->singleton(\App\Services\AuthenticatableServiceInterface::class,
            \App\Services\Production\AuthenticatableService::class);

        $this->app->singleton(\App\Services\BaseServiceInterface::class, \App\Services\Production\BaseService::class);

        $this->app->singleton(\App\Services\FileUploadServiceInterface::class,
            \App\Services\Production\FileUploadService::class);

        $this->app->singleton(\App\Services\ImageServiceInterface::class, \App\Services\Production\ImageService::class);

        $this->app->singleton(\App\Services\LanguageDetectionServiceInterface::class,
            \App\Services\Production\LanguageDetectionService::class);

        $this->app->singleton(\App\Services\MailServiceInterface::class, \App\Services\Production\MailService::class);

        $this->app->singleton(\App\Services\MetaInformationServiceInterface::class,
            \App\Services\Production\MetaInformationService::class);

        $this->app->singleton(\App\Services\ServiceAuthenticationServiceInterface::class,
            \App\Services\Production\ServiceAuthenticationService::class);

        $this->app->singleton(\App\Services\SlackServiceInterface::class, \App\Services\Production\SlackService::class);

        $this->app->singleton(\App\Services\UserServiceAuthenticationServiceInterface::class,
            \App\Services\Production\UserServiceAuthenticationService::class);

        $this->app->singleton(\App\Services\UserServiceInterface::class, \App\Services\Production\UserService::class);

        $this->app->singleton(\App\Services\GoogleAnalyticsServiceInterface::class,
            \App\Services\Production\GoogleAnalyticsService::class);

        $this->app->singleton(
            \App\Services\UserNotificationServiceInterface::class,
            \App\Services\Production\UserNotificationService::class
        );

        $this->app->singleton(
            \App\Services\AdminUserNotificationServiceInterface::class,
            \App\Services\Production\AdminUserNotificationService::class
        );

        $this->app->singleton(
            \App\Services\AdvertiserServiceInterface::class,
            \App\Services\Production\AdvertiserService::class
        );

        $this->app->singleton(
            \App\Services\OAuthServiceInterface::class,
            \App\Services\Production\OAuthService::class
        );

        $this->app->singleton(
            \App\Services\APIUserServiceInterface::class,
            \App\Services\Production\APIUserService::class
        );

        $this->app->singleton(
            \App\Services\FirebaseServiceInterface::class,
            \App\Services\Production\FirebaseService::class
        );

        $this->app->singleton(
            \App\Services\MessagingServiceInterface::class,
            \App\Services\Production\MessagingService::class
        );

        $this->app->singleton(
            \App\Services\TrackingLogServiceInterface::class,
            \App\Services\Production\TrackingLogService::class
        );

        $this->app->singleton(
            \App\Services\CampaignImageServiceInterface::class,
            \App\Services\Production\CampaignImageService::class
        );

        $this->app->singleton(
            \App\Services\UserDistanceServiceInterface::class,
            \App\Services\Production\UserDistanceService::class
        );

        /* NEW BINDING */
    }
}
