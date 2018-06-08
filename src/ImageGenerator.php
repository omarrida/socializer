<?php
/**
 * Created by PhpStorm.
 * User: omarrida
 * Date: 4/6/18
 * Time: 7:37 PM
 */

namespace Audiogram\Socializer;

use Intervention\Image\Facades\Image;

class ImageGenerator
{
    private $textOverlay;
    private $backgroundImagePath;
    private $backgroundImage;
    private $socialImage;
    private $socialImageFileName;
    private $socialImageFilePath;
    public $socialImageUrl;

    public function __construct(Socializable $socializable)
    {
        $this->textOverlay = $socializable->textOverlay;
        $this->backgroundImagePath = $socializable->backgroundImagePath;
        $this->setSocialImageFilePath();
    }

    private function generateBackgroundImage()
    {
        $this->backgroundImage = Image::make($this->backgroundImagePath)->resize(800, 800)->opacity(30);
    }

    private function setSocialImageFilePath()
    {
        $this->setSocialImageFileName();
        $this->socialImageFilePath = storage_path('app/public/' . $this->socialImageFileName);
    }

    private function setSocialImageFileName()
    {
        $this->socialImageFileName = uniqid('socializer_', true).'.jpg';
    }

    public function generateSocialImage()
    {
        $this->generateBackgroundImage();
        $this->socialImage = Image::canvas(800, 800, '#000')
            ->insert($this->backgroundImage)
            ->text($this->textOverlay, 400, 650, function ($font) {
                $font->file(public_path('vendor/audiogram/fonts/OpenSans-SemiBold.ttf'));
                $font->size(48);
                $font->color('#FFF');
                $font->align('center');
            });
        $this->storeSocialImage();
    }

    private function storeSocialImage()
    {
        $this->socialImage->save($this->socialImageFilePath);
        $this->setSocialImageUrl();
    }

    public function setSocialImageUrl()
    {
        $this->socialImageUrl = asset("storage/$this->socialImageFileName");
    }
}