<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
  
    'facebook' => [
        'client_id' => '1289309917880514',        // Your GitHub Client ID
        'client_secret' => 'd0806c15232ece817dcab3d9ac61f965', // Your GitHub Client Secret
        'redirect' => 'http://localhost:8000/facebook/callback',
    ],
    'google' => [
        'client_id'     => '264216543307-bs7fj5ot6maten3pn8n5pbo18i5uvlkv.apps.googleusercontent.com',
        'client_secret' => 'i-e4Fb9gON5Fn_myFpQmQbj1',
        'redirect'      => 'http://localhost:8000/google/callback'
    ],
     'twitter' => [
        'client_id'        => 'S3L6C4TE2xasIIKV34rkF2yYS',
        'client_secret'    => 'zlMV2lQsqf5Lsx2G7tVvFranBatXnXCXnQzj0nYyiBtUbVmTTs',
        'access_token'     => '991363404387487747-zfu9bdPReEQuwphvHCvrB2SmzpRgiUL',
        'access_token_key' => 't24SaBtvUjFhHxxZjryTGjiq3AzA1Kx6fGdEb417VveL6',
        'redirect'         => 'http://yallae7gez.com/twitter/callback',
    ]

];
