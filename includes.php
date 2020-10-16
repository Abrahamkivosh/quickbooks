<?php
require_once(__DIR__ . '/vendor/autoload.php');
use QuickBooksOnline\API\DataService\DataService;


$config = include('config.php');
session_start();
// Prep Data Services
$accessToken =    $_SESSION['sessionAccessToken'];
$companyId =  $_SESSION['QBORealmID'];

$dataService = DataService::Configure(array(
    'auth_mode' => 'oauth2',
    'ClientID' => $config['client_id'],
    'ClientSecret' =>  $config['client_secret'],
    'accessTokenKey' => $accessToken->getAccessToken(),
    'refreshTokenKey' =>  $accessToken->getRefreshToken(),
    'QBORealmID' => $companyId,
    'baseUrl' => "Development"
));



$OAuth2LoginHelper = $dataService->getOAuth2LoginHelper();

$accessToken = $OAuth2LoginHelper->refreshToken();
$_SESSION['sessionAccessToken'] = $accessToken;
$error = $OAuth2LoginHelper->getLastError();
if ($error) {
    echo "The Status code is: " . $error->getHttpStatusCode() . "\n";
    echo "The Helper message is: " . $error->getOAuthHelperError() . "\n";
    echo "The Response message is: " . $error->getResponseBody() . "\n";
    return;
}
$dataService->updateOAuth2Token($accessToken);

