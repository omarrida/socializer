<?php

namespace Audiogram\Socializer;

class Socializable {

    public $textOverlay;
    public $backgroundImagePath;
    public $postText;

    public function textOverlay(string $textOverlay)
    {
        $this->textOverlay = $textOverlay;
        return $this;
    }

    public function backgroundImagePath(string $path)
    {
        $this->backgroundImagePath = $path;
        return $this;
    }

    public function postText(string $postText)
    {
        $this->postText = $postText;
        return $this;
    }
}
