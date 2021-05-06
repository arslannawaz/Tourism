<?php

//config.php
//Include Google Client Library for PHP autoload file
require_once 'vendor/autoload.php';
//Make object of Google API Client for call Google API
$google_client = new Google_Client();
//Set the OAuth 2.0 Client ID
$google_client->setClientId('696716822584-tt1l2m72nvnjl5ff8a0qj8dvtujdl3nu.apps.googleusercontent.com');
//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('eWNnBbdEg8caoyWcL0ja5K37');
//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('http://127.0.0.1/Tourism/editprofile.php');
//
$google_client->addScope('email');
$google_client->addScope('profile');
//start session on web page
session_start();


if (!session_id())
{
    session_start();
}

// Call Facebook API
//997348840659878
//621d896723b8a6dcb89a21024a54941f
$facebook = new \Facebook\Facebook([
    'app_id'      => '221679585709976',
    'app_secret'     => 'a7b655c31f1ec84c67ae3b8620666057',
    'default_graph_version'  => 'v2.10'
]);
