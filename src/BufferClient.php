<?php
/**
 * Created by PhpStorm.
 * User: omarrida
 * Date: 4/6/18
 * Time: 7:18 PM
 */

namespace Audiogram\Socializer;

use GuzzleHttp\Client;

class BufferClient
{
    private $token;
    private $facebookId;
    private $twitterId;
    private $profiles;
    private $client;
    private $postText;
    private $imagePath;

    public function __construct()
    {
        $this->setToken();
        $this->setFacebookId();
        $this->setTwitterId();
        $this->setProfiles();
        $this->client = new Client(['base_uri' => 'https://api.bufferapp.com/1/']);
    }

    private function setToken()
    {
        $this->token = config('socializer.buffer_credentials.access_token');
    }

    private function setFacebookId()
    {
        $this->facebookId = config('socializer.buffer_profile_ids.facebook');
    }

    private function setTwitterId()
    {
        $this->twitterId = config('socializer.buffer_profile_ids.twitter');
    }

    private function setProfiles()
    {
        $this->profiles = [$this->facebookId, $this->twitterId];
    }

    public function postText(string $postText)
    {
        $this->postText = $postText;
        return $this;
    }

    public function imagePath(string $imagePath)
    {
        $this->imagePath = $imagePath;
        return $this;
    }

    public function toBuffer()
    {
        $this->client->post('updates/create.json', [
            'headers' => [
                'Authorization' => "Bearer $this->token"
            ],
            'form_params' => [
                'profile_ids' => $this->profiles,
                'text' => $this->postText,
                'media' => [
                    'photo' => $this->imagePath,
                ]
            ]
        ]);
    }
}