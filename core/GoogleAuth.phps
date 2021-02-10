<?php

namespace app\core;

use Google_Client;
use Google_Service_Oauth2;


class GoogleAuth
{

    public $google_client;

    public function __construct($config = [])
    {
        $this->google_client = new Google_Client();
        $this->google_client->setClientId($config['client_id'] ?? '');
        $this->google_client->setClientSecret($config['secret'] ?? '');
        $this->google_client->setRedirectUri($config['uri']);
        $this->google_client->addScope('email');
        $this->google_client->addScope('profile');
    }

    public function auth()
    {
        // authenticate code from Google OAuth Flow
        if (isset($_GET['code'])) {
            $token = $this->google_client->fetchAccessTokenWithAuthCode($_GET['code']);
            $this->google_client->setAccessToken($token['access_token']);

            // get profile info
            $google_oauth = new Google_Service_Oauth2($this->google_client);
            $google_account_info = $google_oauth->userinfo->get();
            $email =  $google_account_info->email;
            $name =  $google_account_info->name;

            // now you can use this profile info to create account in your website and make user logged in.
        } else {
            Application::$app->response->redirect($this->google_client->createAuthUrl());
        }
    }
}
