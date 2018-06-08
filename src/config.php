<?php
/**
 * Created by PhpStorm.
 * User: omarrida
 * Date: 4/6/18
 * Time: 1:58 PM.
 */

return [
    'buffer_credentials' => [
        'client_id'     => env('BUFFER_CLIENT_ID'),
        'client_secret' => env('BUFFER_CLIENT_SECRET'),
        'access_token'  => env('BUFFER_ACCESS_TOKEN'),
    ],

    'buffer_profile_ids' => [
        'facebook' => env('BUFFER_FACEBOOK_PROFILE_ID'),
        'twitter'  => env('BUFFER_TWITTER_PROFILE_ID'),
    ],
];
