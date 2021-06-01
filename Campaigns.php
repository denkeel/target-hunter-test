<?php

class Campaigns
{

    public function renderCampaigns(ICampaigns $campaignsApi)
    {
        return $this->renderHtml($campaignsApi->getCampaigns(), $campaignsApi->getAds());
    }

    public function renderHtml(array $campaigns, array $ads)
    {
        $html = '<ul>';
        foreach ($campaigns as $campaign) {
            $html .= "<li>" . $campaign['campaign_name'] . "</li>";
            $html .= '<ul>';
            if (isset($ads[$campaign['campaign_id']])) {
                foreach ($ads[$campaign['campaign_id']] as $ad) {
                    $html .= "<li>" . $ad['ad_name'] . "</li>";
                }
            }
            $html .= '</ul>';
        }
        $html .= '</ul>';

        return $html;
    }
}
