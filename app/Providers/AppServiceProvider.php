<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Interface\MovieRepositoryInterface;
use App\Repositories\MovieRepository;
use App\Services\Interface\MovieServiceInterface;
use App\Services\MovieService;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            MovieRepositoryInterface::class,
            MovieRepository::class
        );

        $this->app->bind(
            MovieServiceInterface::class,
            MovieService::class
        );
    }

    public function boot(): void
    {
        Paginator::useBootstrap();
    }
}