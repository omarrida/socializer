<?php
/**
 * Created by PhpStorm.
 * User: omarrida
 * Date: 4/6/18
 * Time: 7:18 PM.
 */

namespace Audiogram\Socializer;

use GuzzleHttp\Client;

/**
 * Class BufferClient.
 *
 * @package Audiogram\Socializer
 */
class BufferClient
{
    /**
     * @var string
     */
    private $token;
    /**
     * @var string
     */
    private $facebookId;
    /**
     * @var string
     */
    private $twitterId;
    /**
     * @var array
     */
    private $profiles;
    /**
     * @var \GuzzleHttp\Client
     */
    private $client;
    /**
     * @var string
     */
    private $postText;
    /**
     * @var string
     */
    private $imagePath;

    /**
     * BufferClient constructor.
     */
    public function __construct()
    {
        $this->setToken();
        $this->setFacebookId();
        $this->setTwitterId();
        $this->setProfiles();
        $this->client = new Client(['base_uri' => 'https://api.bufferapp.com/1/']);
    }

    /**
     * Set the text that will be used in the social post.
     *
     * @param string $postText
     *
     * @return $this
     */
    public function postText(string $postText)
    {
        $this->postText = $postText;

        return $this;
    }

    /**
     * Set the path for the image to be used in the social post.
     *
     * @param string $imagePath
     *
     * @return $this
     */
    public function imagePath(string $imagePath)
    {
        $this->imagePath = $imagePath;

        return $this;
    }

    /**
     * POST the social media post to the Buffer account.
     */
    public function toBuffer(): void
    {
        $this->client->post('updates/create.json', [
            'headers' => [
                'Authorization' => "Bearer $this->token",
            ],
            'form_params' => [
                'profile_ids' => $this->profiles,
                'text'        => $this->postText,
                'media'       => [
                    'photo' => $this->imagePath,
                ],
            ],
        ]);
    }

    /**
     * Set the Buffer access token.
     */
    private function setToken(): void
    {
        $this->token = config('socializer.buffer_credentials.access_token');
    }

    /**
     * Set the Buffer Facebook ID.
     */
    private function setFacebookId(): void
    {
        $this->facebookId = config('socializer.buffer_profile_ids.facebook');
    }

    /**
     * Set the Buffer Twitter ID.
     */
    private function setTwitterId(): void
    {
        $this->twitterId = config('socializer.buffer_profile_ids.twitter');
    }

    /**
     * Set the target profiles for the post.
     */
    private function setProfiles(): void
    {
        $this->profiles = [$this->facebookId, $this->twitterId];
    }
}
