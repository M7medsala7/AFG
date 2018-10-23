<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class FacebookServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Facebook::class, function ($app) {
            $config = config('services.facebook');
            return new Facebook([
                'app_id' => $config['178421959668479'],
                'app_secret' => $config['0201f406a20a9abcf8f846c151bc2f03'],
                'default_graph_version' => 'v2.6',
            ]);
        });
    }
}
