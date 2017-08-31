<?php

namespace Tttptd\LaravelCloudpayments;

use CloudPayments\Manager;
use Illuminate\Support\ServiceProvider;

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
            __DIR__ . '/../resources/config/config.php' => config_path('cloudpayments.php'),
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

        $this->app->singleton(Manager::class, function() {
            return new CloudpaymentsManager(
                config('cloudpayments')
            );
        });
    }

    /**
     * @return array
     */
    public function provides():array
    {
        return [
            Manager::class,
        ];
    }

}
