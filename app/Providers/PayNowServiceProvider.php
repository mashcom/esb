<?php namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class PayNowServiceProvider extends ServiceProvider {

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
		$this->app->singleton(Carbon::class, function ($app) {
            return new Carbon(config('riak'));
        });
	}

}
