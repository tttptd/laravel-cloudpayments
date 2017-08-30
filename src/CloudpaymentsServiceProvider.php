<?php

namespace Tttptd\LaravelCloudpayments;

use Illuminate\Support\ServiceProvider;
use CloudPayments\Manager;

class CloudpaymentsServiceProvider extends ServiceProvider
{

    /**
     * @var bool
     */
    protected /** @noinspection ClassOverridesFieldOfSuperClassInspection */
        $defer = true;

    /**
     *
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../resources/config/config.php' => config_path('cloudpayments.php')
        ], 'config');
    }

    /**
     *
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../resources/config/config.php', 'cloudpayments'
        );

        /** @noinspection PhpUndefinedMethodInspection */
        $this->app->singleton(Manager::class, function ($app) {
            return new Manager(
                config('cloudpayments.publicId'),
                config('cloudpayments.apiPassword')
            );
        });
    }

    /**
     * @return array
     */
    public function provides():array
    {
        return [
            Manager::class
        ];
    }

}
