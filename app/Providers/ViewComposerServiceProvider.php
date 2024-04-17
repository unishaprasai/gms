<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Announcement;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
    View::composer('*', function ($view) {
        $notifications = Announcement::all(); // Fetch notifications data
        $view->with('notifications', $notifications);
    });
    }

}
