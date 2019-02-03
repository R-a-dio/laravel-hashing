<?php namespace hiro\Hashing;

use Illuminate\Hashing\HashServiceProvider as ServiceProvider;

class HashServiceProvider extends ServiceProvider {

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app['hash'] = $this->app->share(function() { return new OsuHasher; });
	}
}
