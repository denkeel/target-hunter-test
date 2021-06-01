<?php

class ApiRequestVK
{
    public string $apiVersion;

    public function __construct($apiVersion)
    {
        $this->apiVersion = $apiVersion;
    }

    public function makeRequest(string $methodName, array $parameters, string $accessToken)
    {
        $parametersHttpEncoded = http_build_query($parameters);
        $url = "https://api.vk.com/method/$methodName?$parametersHttpEncoded&access_token=$accessToken&v=$this->apiVersion";
        $result = file_get_contents($url);
        
        return $result;
    }
}
