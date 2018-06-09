<?php
/**
 * Created by PhpStorm.
 * User: omarrida
 * Date: 4/6/18
 * Time: 7:37 PM.
 */

namespace Audiogram\Socializer;

use Intervention\Image\Facades\Image;

/**
 * Class ImageGenerator.
 *
 * @package Audiogram\Socializer
 */
class ImageGenerator
{
    /**
     * @var string
     */
    public $socialImageUrl;
    /**
     * @var string
     */
    private $textOverlay;
    /**
     * @var string
     */
    private $backgroundImagePath;
    /**
     * @var \Intervention\Image\Image
     */
    private $backgroundImage;
    /**
     * @var \Intervention\Image\Image
     */
    private $socialImage;
    /**
     * @var string
     */
    private $socialImageFileName;
    /**
     * @var string
     */
    private $socialImageFilePath;

    /**
     * ImageGenerator constructor.
     *
     * @param Socializable $socializable
     */
    public function __construct(Socializable $socializable)
    {
        $this->textOverlay         = $socializable->textOverlay;
        $this->backgroundImagePath = $socializable->backgroundImagePath;
        $this->setSocialImageFilePath();
    }

    /**
     * Put the background image and overlay together to produce the final image.
     * Afterwards, store the image at the predefined local storage path.
     */
    public function generateSocialImage(): void
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

    /**
     * Set the asset url at which the final image can be accessed.
     */
    public function setSocialImageUrl(): void
    {
        $this->socialImageUrl = asset("storage/$this->socialImageFileName");
    }

    /**
     * Set the desired background image with resizing and opacity.
     */
    private function generateBackgroundImage(): void
    {
        $this->backgroundImage = Image::make($this->backgroundImagePath)->resize(800, 800)->opacity(30);
    }

    /**
     * Set the local storage path for the resulting image.
     */
    private function setSocialImageFilePath(): void
    {
        $this->setSocialImageFileName();
        $this->socialImageFilePath = storage_path('app/public/'.$this->socialImageFileName);
    }

    /**
     * Generate a unique name for the final image.
     */
    private function setSocialImageFileName(): void
    {
        $this->socialImageFileName = uniqid('socializer_', true).'.jpg';
    }

    /**
     * Store the final image at the local storage path.
     */
    private function storeSocialImage(): void
    {
        $this->socialImage->save($this->socialImageFilePath);
        $this->setSocialImageUrl();
    }
}
