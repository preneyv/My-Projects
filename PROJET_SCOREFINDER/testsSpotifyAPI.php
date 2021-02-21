<?php

require_once(realpath(dirname(__FILE__)) . '/Modele/WebDataAccess/Spotify PHP API/src/Request.php');
require_once(realpath(dirname(__FILE__)) . '/Modele/WebDataAccess/Spotify PHP API/src/Session.php');
require_once(realpath(dirname(__FILE__)) . '/Modele/WebDataAccess/Spotify PHP API/src/SpotifyWebAPI.php');
require_once(realpath(dirname(__FILE__)) . '/Modele/WebDataAccess/Spotify PHP API/src/SpotifyWebAPIException.php');



$session = new SpotifyWebAPI\Session('b843fdef71b84f4bb3a72327f7b77b6c', '7d084542900f48d59c9c1620a235be90', 'http://localhost/scoreFinder/testsSpotifyAPI.php');
$api = new SpotifyWebAPI\SpotifyWebAPI();

// Request a access token using the code from Spotify
$session->requestAccessToken($_GET['code']);
$accessToken = $session->getAccessToken();

// Set the access token on the API wrapper
$api->setAccessToken($accessToken);

// Start using the API!

echo $session->getClientSecret();



?>