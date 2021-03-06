<?php

namespace App\Providers;

use Binance\API;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Facades\Schema;
use VIACreative\SudoSu\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (app()->isLocal()) {
            $this->app->register(ServiceProvider::class);
        }
        $this->app->singleton('binance', function () {
            return new API(config('market.binance.api_key'), config('market.binance.secret'));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
	{
		\App\Models\User::observe(\App\Observers\UserObserver::class);
		\App\Models\Reply::observe(\App\Observers\ReplyObserver::class);
		\App\Models\Topic::observe(\App\Observers\TopicObserver::class);
        \App\Models\Link::observe(\App\Observers\LinkObserver::class);
        //
        Resource::withoutWrapping();
    }
}
