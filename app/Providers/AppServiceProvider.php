<?php

namespace App\Providers;

use App\Contracts\Services\QrCodeServiceInterface;
use App\Services\QrCodeService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(QrCodeServiceInterface::class, function($app)
        {
            return new QrCodeService;
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
