<?php 
require_once '../../tools/vendor/autoload.php';
session_start();

use Google\Client;
use Google\Service\Oauth2;

$client = new \Google\Client();
$client->setApplicationName("tools");
// $client->setDeveloperKey("YOUR_APP_KEY");

$client->setScopes('https://www.googleapis.com/auth/userinfo.profile');
$client->setAuthConfig('../../tools/credentials.json');
$client->setRedirectUri('http://localhost/auth/callback.php');
if(isset($_GET['code'])) {
    $accessToken = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    if(time() > $accessToken['expires_in']) {
        $client->setAccessToken($accessToken);  
        $oauth2Service = new Oauth2($client);
        $userInfo = $oauth2Service->userinfo->get();
        $name = $userInfo->getName();
        $email = $userInfo->getEmail();
        header('Location: http://tools/bookings');
        exit();
    }

}  


$redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
$client->setRedirectUri($redirect_uri);
$authUrl = $client->createAuthUrl();
header('Location:'.$authUrl);

    echo "callback";
?>