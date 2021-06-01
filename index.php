<?php

spl_autoload_register();

$config = include('config.php');

$vkAuth = new AuthVK('ads', $config);

echo "<a href=" . $vkAuth->getAuthUrl() . ">Авторизоваться через VK</a>";
echo "<br>";

if (isset($_GET['code'])) {
    $code = $_GET['code'];

    $campaigns = new Campaigns();
    $html = $campaigns->renderCampaigns(new CampaignsVK($vkAuth, $config->vkApiVersion, $code, '1606841050'));
    echo $html;
}
