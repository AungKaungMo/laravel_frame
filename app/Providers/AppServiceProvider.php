<?php

namespace App\Providers;

use App\Models\Post;
use App\Observers\PostObserver;
use App\Repositories\BaseRepository;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use App\Repositories\BaseRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(BaseRepositoryInterface::class,BaseRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {   
        //
    }
}
