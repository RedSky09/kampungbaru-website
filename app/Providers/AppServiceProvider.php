<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Submission;
use App\Observers\SubmissionObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Submission::observe(SubmissionObserver::class);
    }
}
