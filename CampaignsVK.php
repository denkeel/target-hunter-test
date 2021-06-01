<?php

spl_autoload_register();

class CampaignsVK implements ICampaigns
{
    public AuthVK $vkAuth;
    public string $apiVersion;
    public string $code;
    public string $accountId;

    public string $accessToken;

    public function __construct(AuthVK $vkAuth, string $vkApiVersion, string $code, string $accountId)
    {
        $this->vkAuth = $vkAuth;
        $this->apiVersion = $vkApiVersion;
        $this->code = $code;
        $this->accountId = $accountId;
        $this->accessToken = $this->vkAuth->getAccessToken($this->code);
    }

    public function getCampaigns()
    {
        $vkApi = new ApiRequestVK($this->apiVersion);
        
        $methodName = "ads.getCampaigns";
        $parameters = ["account_id" => $this->accountId];
        
        $response = $vkApi->makeRequest($methodName, $parameters, $this->accessToken);
        
        return $this->standardizeCampaignsData($response);
    }
    
    public function standardizeCampaignsData(string $responseJson)
    {
        $response = json_decode($responseJson);
        $campaigns = $response->response;

        $standardizedCampaigns = [];
        foreach($campaigns as $campaign) {
            $standardizedCampaigns[] = ['campaign_id' => $campaign->id, 'campaign_name' => $campaign->name];
        }

        return $standardizedCampaigns;
    }
}
