<?php
require_once(__DIR__ . '/vendor/autoload.php');

use QuickBooksOnline\API\DataService\DataService;

$config = include('config.php');

session_start();
// Prep Data Services
$dataService = DataService::Configure(array(
    'auth_mode' => 'oauth2',
    'ClientID' => $config['client_id'],
    'ClientSecret' =>  $config['client_secret'],
    'RedirectURI' => $config['oauth_redirect_uri'],
    'scope' => $config['oauth_scope'],
    'baseUrl' => "development"
));

$dataService->disableLog(); //disable logs

// print_r($dataService) ;

// To throw exceptions when a request failed
$dataService->throwExceptionOnError(true);

$error = $dataService->getLastError(); //check if there is any error on response send
if ($error) {
    echo "<h2>Error occurred : </h2>  " .  $error;
} else {
    // print_r($dataService) ; 

    // ServiceContext contains all the information associated with the DataService, like OAuth values, Log location, etc
    $serviceContext = $dataService->getServiceContext();

    $OAuth2LoginHelper = $dataService->getOAuth2LoginHelper();
    $authorizationCodeUrl = $OAuth2LoginHelper->getAuthorizationCodeURL();

    // Store the url in PHP Session Object;
    $_SESSION['authUrl'] = $authorizationCodeUrl;

    header("Location:" . $authorizationCodeUrl);
}
