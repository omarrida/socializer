<?php

namespace Audiogram\Socializer;

/**
 * Class Socializable.
 *
 * @package Audiogram\Socializer
 */
class Socializable
{
    /**
     * @var string
     */
    public $textOverlay;
    /**
     * @var string
     */
    public $backgroundImagePath;
    /**
     * @var string
     */
    public $postText;

    /**
     * Set the text overlay to add on the image.
     *
     * @param string $textOverlay
     *
     * @return $this
     */
    public function textOverlay(string $textOverlay): self
    {
        $this->textOverlay = $textOverlay;

        return $this;
    }

    /**
     * Set the path to the desired background image.
     *
     * @param string $path
     *
     * @return $this
     */
    public function backgroundImagePath(string $path): self
    {
        $this->backgroundImagePath = $path;

        return $this;
    }

    /**
     * Set the text that should be used for the post.
     *
     * @param string $postText
     *
     * @return $this
     */
    public function postText(string $postText): self
    {
        $this->postText = $postText;

        return $this;
    }
}
