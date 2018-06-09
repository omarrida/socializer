<?php

namespace Audiogram\Socializer;

use Illuminate\Support\ServiceProvider;
use Intervention\Image\ImageManagerStatic as Image;

/**
 * Class SocializerServiceProvider.
 *
 * @package Audiogram\Socializer
 */
class SocializerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
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
     */
    public function register()
    {
        Image::configure(['driver' => 'imagick']);
        require_once __DIR__.'/helpers.php';
    }
}
