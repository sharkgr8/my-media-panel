<?php

namespace Shark\Media;

use Illuminate\Support\ServiceProvider;

/**
 * Description of MediaServiceProvider
 *
 * @author shark
 */
class MediaServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot() {
        $this->package('shark/media');
        include __DIR__ . '/routes.php';
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
        $this->app->bind('foo', function() {
            return new Foo;
        });
    }

}
