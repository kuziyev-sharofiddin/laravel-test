<?php

namespace App\Providers;

use App\Interface\BaseInterface;
use App\Repository\BaseRepository;
use App\Repository\ProductRepository;
use App\Service\ProductService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind( BaseInterface::class, ProductRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
