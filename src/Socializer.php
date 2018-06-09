<?php
/**
 * Created by PhpStorm.
 * User: omarrida
 * Date: 4/6/18
 * Time: 7:19 PM.
 */

namespace Audiogram\Socializer;

/**
 * Class Socializer.
 *
 * @package Audiogram\Socializer
 */
class Socializer
{
    /**
     * @var Socializable
     */
    private $socializable;
    /**
     * @var ImageGenerator
     */
    private $imageGenerator;
    /**
     * @var BufferClient
     */
    private $bufferClient;

    /**
     * Socializer constructor.
     *
     * @param Socializable   $socializable
     * @param ImageGenerator $imageGenerator
     * @param BufferClient   $bufferClient
     */
    public function __construct(Socializable $socializable, ImageGenerator $imageGenerator, BufferClient $bufferClient)
    {
        $this->socializable   = $socializable;
        $this->imageGenerator = $imageGenerator;
        $this->bufferClient   = $bufferClient;
    }

    /**
     * Generate the social media post and send it to Buffer.
     */
    public function post()
    {
        // Generate the image
        $this->imageGenerator->generateSocialImage();
        // Populate the client and hit the POST request
        $this->bufferClient->postText($this->socializable->postText)
            ->imagePath($this->imageGenerator->socialImageUrl)
            ->toBuffer();
    }
}
