<?php
/**
 * Created by PhpStorm.
 * User: omarrida
 * Date: 4/6/18
 * Time: 7:19 PM
 */

namespace Audiogram\Socializer;

class Socializer
{
    private $socializable;
    private $imageGenerator;
    private $bufferClient;

    public function __construct(Socializable $socializable, ImageGenerator $imageGenerator, BufferClient $bufferClient)
    {
        $this->socializable = $socializable;
        $this->imageGenerator = $imageGenerator;
        $this->bufferClient = $bufferClient;
    }

    public function post()
    {
        // Generate the image
        $this->imageGenerator->generateSocialImage();
        // Populate the client
        $this->bufferClient->postText($this->socializable->postText)
            ->imagePath($this->imageGenerator->socialImageUrl)
            ->toBuffer();
    }
}