<?php

use Audiogram\Socializer\Socializer;
use Audiogram\Socializer\BufferClient;
use Audiogram\Socializer\ImageGenerator;
use Audiogram\Socializer\SocializableInterface;

if (!function_exists("socialize")) {
    function socialize(SocializableInterface $instance)
    {
        $socializable = $instance->toSocializable();
        $imageGenerator = new ImageGenerator($socializable);
        $client = new BufferClient();
        $socializer = new Socializer($socializable, $imageGenerator, $client);
        $socializer->post();
    }
}
