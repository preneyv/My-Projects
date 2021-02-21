<?php
require_once(realpath(dirname(__FILE__)) . '/../Modele/WebDataAccess/Spotify PHP API/src/Request.php');
require_once(realpath(dirname(__FILE__)) . '/../Modele/WebDataAccess/Spotify PHP API/src/Session.php');
require_once(realpath(dirname(__FILE__)) . '/../Modele/WebDataAccess/Spotify PHP API/src/SpotifyWebAPI.php');
require_once(realpath(dirname(__FILE__)) . '/../Modele/WebDataAccess/Spotify PHP API/src/SpotifyWebAPIException.php');
require_once(realpath(dirname(__FILE__)) . '/../Modele/DAO/AlbumID.php');
require_once(realpath(dirname(__FILE__)) . '/../Modele/DAO/ArtisteID.php');
require_once(realpath(dirname(__FILE__)) . '/../Modele/DAO/CompteID.php');
require_once(realpath(dirname(__FILE__)) . '/../Modele/DAO/GenreID.php');
require_once(realpath(dirname(__FILE__)) . '/../Modele/DAO/TrackID.php');
require_once(realpath(dirname(__FILE__)) . '/../Modele/DAO/CompteDAO.php');
require_once(realpath(dirname(__FILE__)) . '/../Modele/DAO/AlbumDAO.php');
require_once(realpath(dirname(__FILE__)) . '/../Modele/DAO/ArtisteDAO.php');
require_once(realpath(dirname(__FILE__)) . '/../Modele/DAO/GenreDAO.php');
require_once(realpath(dirname(__FILE__)) . '/../Modele/DAO/TrackDAO.php');
require_once(realpath(dirname(__FILE__)) . '/../Modele/ScoreFinder/Compte.php');
require_once(realpath(dirname(__FILE__)) . '/../Modele/ScoreFinder/Album.php');
require_once(realpath(dirname(__FILE__)) . '/../Modele/ScoreFinder/Artiste.php');
require_once(realpath(dirname(__FILE__)) . '/../Modele/ScoreFinder/Genre.php');
require_once(realpath(dirname(__FILE__)) . '/../Modele/ScoreFinder/Track.php');
require_once(realpath(dirname(__FILE__)) . '/../Modele/ScoreFinder/PresenceFavoris.php');

session_start();


try{
		
		$session = new SpotifyWebAPI\Session('b843fdef71b84f4bb3a72327f7b77b6c', '7d084542900f48d59c9c1620a235be90', 'http://localhost/scoreFinder/Controleur/SpotifyDataUpdate.php');
		$_SESSION['spotifySession'] = $session;
	    $_SESSION['spotifyToken'] = $session->getRefreshToken();
		$session->refreshAccessToken($session->getRefreshToken());
		$accessToken= $session->getAccessToken();
		$session->setAccessToken($accessToken);
	}

	catch(Exception $e){
		header("Location: ../Vue/HTML/pageErreurConnexion.php");
	}

$scopes = array(
    'playlist-read-private',
    'user-read-private'
);

$authorizeUrl = $session->getAuthorizeUrl(array(
    'scope' => $scopes
));



header('Location: ' . $authorizeUrl);
die();

?>