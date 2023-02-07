<?php

namespace App\Providers;

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\ServiceProvider;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Broadcast::routes();
        // broadcast for all system, will use it in all modules
//        Broadcast::routes(['prefix' => 'api/v1', 'middleware' => ['web']]);
        // TO DO , uncomment the follwing line and  Handle it with laravel sanctum middleware
//        Broadcast::routes(['prefix' => 'api/v1', 'middleware' => ['auth:sanctum']]);
        require base_path('routes/channels.php');
    }
}
