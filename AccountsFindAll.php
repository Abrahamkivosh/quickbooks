<?php
require_once(__DIR__ . '/vendor/autoload.php');
use QuickBooksOnline\API\Core\ServiceContext;
use QuickBooksOnline\API\DataService\DataService;
use QuickBooksOnline\API\PlatformService\PlatformService;
use QuickBooksOnline\API\Core\Http\Serialization\XmlObjectSerializer;
use QuickBooksOnline\API\Facades\Account;

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

// Iterate through all Accounts, even if it takes multiple pages
$i = 1;
while (1) {
    $allAccounts = $dataService->FindAll('Account', $i, 500);
    $error = $dataService->getLastError();
    if ($error) {
        echo "The Status code is: " . $error->getHttpStatusCode() . "\n";
        echo "The Helper message is: " . $error->getOAuthHelperError() . "\n";
        echo "The Response message is: " . $error->getResponseBody() . "\n";
        exit();
    }

    if (!$allAccounts || (0==count($allAccounts))) {
        break;
    }

    foreach ($allAccounts as $oneAccount) {
        echo "Account[".($i++)."]: {$oneAccount->Name}\n";
        echo "\t * Id: [{$oneAccount->Id}]\n";
        echo "\t * AccountType: [{$oneAccount->AccountType}]\n";
        echo "\t * AccountSubType: [{$oneAccount->AccountSubType}]\n";
        echo "\t * Active: [{$oneAccount->Active}]\n";
        echo "\n";
    }
}