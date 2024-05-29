<?php

namespace App\Providers;

use App\Modules\Input\Repositories\InputRepository;
use App\Modules\Input\Repositories\InputRepositoryInterface;
use App\Modules\Input\Services\InputService;
use App\Modules\Input\Services\InputServiceInterface;
use Illuminate\Support\ServiceProvider;

class ServiceRepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            InputServiceInterface::class,
            InputService::class,
        );

        $this->app->bind(
            InputRepositoryInterface::class,
            InputRepository::class,
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
