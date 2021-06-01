<?php

class AuthVK
{
    public string $scope;

    public string $clientId;
    public string $clientSecret;
    public string $apiVersion;

    public string $redirectUri;

    public function __construct($scope, $config)
    {
        $this->scope = $scope;
        $this->clientId = $config->vkClientId;
        $this->clientSecret = $config->vkClientSecret;
        $this->apiVersion = $config->vkApiVersion;
        $this->redirectUri = $config->redirectUri;
    }

    public function getAuthUrl()
    {
        return "https://oauth.vk.com/authorize?client_id=$this->clientId&display=page&redirect_uri=$this->redirectUri&scope=$this->scope&response_type=code&v=$this->apiVersion";
    }

    public function getAccessToken(string $code)
    {
        $accessTokenUrl = "https://oauth.vk.com/access_token?client_id=$this->clientId&client_secret=$this->clientSecret&redirect_uri=$this->redirectUri&code=$code";
        $result = json_decode(file_get_contents($accessTokenUrl));

        return $result->access_token;
    }
}
