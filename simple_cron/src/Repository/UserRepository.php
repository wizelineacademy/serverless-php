<?php

namespace App\Repository;
use GuzzleHttp\Client;

class UserRepository{
    private $host='https://my-json-server.typicode.com/wizelineacademy/serverless-php';

    public function __construct(){
        $this->client = new Client();
    }
    
    public function getUsers(){
        $response = $this->client->request('GET', "{$this->host}/users");
        if ($response->getStatusCode()!=200){
            throw new Exception("The service is unavailable");
        }
        return json_decode($response->getBody(),true);
    }
}