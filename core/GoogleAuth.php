<?php

namespace app\core;

use Google_Client;

class GoogleAuth
{

    public $google_client;

    public function __construct($config = [])
    {
        $this->google_client = new Google_Client();
        $this->google_client->setClientId($config['client_id'] ?? '');
        $this->google_client->setClientSecret($config['secret'] ?? '');
        $this->google_client->setRedirectUri($config['url']);

        $this->google_client->addScope('email');
        
    }
}
