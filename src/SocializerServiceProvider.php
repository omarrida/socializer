<?php

namespace Audiogram\Socializer;

use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\ServiceProvider;

class SocializerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/fonts' => public_path('vendor/audiogram/fonts'),
        ], 'public');
        $this->publishes([
            __DIR__.'/config.php' => config_path('socializer.php'),
        ]);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        Image::configure(['driver' => 'imagick']);
        require_once __DIR__.'/helpers.php';
    }
}
