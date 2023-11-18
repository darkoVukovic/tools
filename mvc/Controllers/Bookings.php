<?php namespace mvc\Controllers;

use core\MainController;
use Google\Client;
use Google\Service\Oauth2;
use mvc\Models\User_Model;
use core\Security;

    class Bookings extends MainController {
        

        public function index () {
            if($this->auth->checkAuth()) {
                $security = new Security;
                $username = $security->filterVar($_SESSION['username']);
                $username = str_replace('-', ' ', $username);
                $data['links'] = [
                    ['href' => 'auth/logout','name' => 'logout'],
                    ['href' => '#','name' => $username]
                ];

            }
            else {
                $data['links'] = [
                   ['href' => 'http://localhost/auth/login','name' => 'google login']
                ];
            }
            $this->view->renderView('bookings', $data);
            
        } 
        
        public function login () {
            $client = new \Google\Client();
            $client->setApplicationName("tools");
            // $client->setDeveloperKey("YOUR_APP_KEY");

            $client->setScopes(['https://www.googleapis.com/auth/userinfo.profile', 'https://www.googleapis.com/auth/userinfo.email']);
            $client->setAuthConfig(ROOTDIR.'/credentials.json');
         if(isset($_GET['code'])) {
                $accessToken = $client->fetchAccessTokenWithAuthCode($_GET['code']);
                if(time() > $accessToken['expires_in']) {
                    $client->setAccessToken($accessToken);  
                    $oauth2Service = new Oauth2($client);
                    $userInfo = $oauth2Service->userinfo->get();
                    $name = $userInfo->getName();
                    $email = $userInfo->getEmail();
                    $userModel = new User_Model();
                    if($userModel->storeUser($name, $email)) {
                        $expirationTime = time() + $accessToken['expires_in'];
                        $name = str_replace(' ', '-', $name);
                        if(setcookie('username', $name, $expirationTime, '/', 'localhost', false)) {
                            $_SESSION['username'] = $name;
                            header('Location: http://localhost/bookings');
                            exit();
                        }
                        else {
                            echo "error setting cookie";
                            die();
                        }
                       
                    }
                    else {
                        echo "error during user storing";
                    }
                
                }
                
            }  
            $redirect_uri = 'http://localhost/auth/login';
            $client->setRedirectUri(trim($redirect_uri));
            $authUrl = $client->createAuthUrl();
            header('Location:'.$authUrl);
            
        } 
        public function logout () {
            if($this->auth->logOut()) {
                header('Location: http://localhost/bookings');
            }

        } 
    }   