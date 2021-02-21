<?php

/*
	ATTENTION : certains champs de la base de données n'ont pas une taille assez grande. 
	Pour que ce script marche, il faut redimensionner à 200 et 85 les champs "urlImage" de la table
	"album" et "nomArtiste" de la table "Artiste" (originalement à 25) */

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

if(!isset($_SESSION))
{
		session_start();
}
set_time_limit(0);
	


$test = unserialize(serialize($_SESSION['user']['compte']));
	if(isset($_SESSION['user'])){

		if(isset($_SESSION['user']['compte'])){
			
			
				$session = new SpotifyWebAPI\Session('b843fdef71b84f4bb3a72327f7b77b6c', '7d084542900f48d59c9c1620a235be90', 'http://localhost/scoreFinder/Controleur/SpotifyDataUpdate.php');

			
			$api = new SpotifyWebAPI\SpotifyWebAPI();
			// Envoi de la requête
			$session->requestAccessToken($_GET['code']);
			$accessToken = $session->getAccessToken();
		
			
			
			
			// Récupération du token d'accès
			$api->setAccessToken($accessToken);
			$api->setReturnAssoc(true);
			// L'API est prête à être utilisée
			
			
			
				$id = $api->me()['id'];
				
			for($k=0;$k<count($api->getMyPlaylists()["items"]);$k++){
				$tracksurl = ($api->getMyPlaylists()["items"][$k]["id"]);
			
				//On recherche l'ensemble des playlists utilisateur

				/*********A CE NIVEAU JE PENSE QU'IL Y A UNE ERREUR : $listTracks = $api->getUserPlaylistTracks($api->me()["id"], $tracksurl);***********/
			
				
				$listTracks = $api->getUserPlaylistTracks($api->me()["id"], $tracksurl);
				try{
				$tabTracks = ($listTracks["items"]);
				
				for ($i=0;$i<count($tabTracks);$i++){
					
					$date = substr($tabTracks[$i]["added_at"],0 ,10);
					$artiste = $tabTracks[$i]["track"]["artists"][0]["name"];
					$titre = $tabTracks[$i]["track"]["name"];
					$artisteID = $tabTracks[$i]["track"]["artists"][0]["id"];
					$titreAlbum = $tabTracks[$i]["track"]["album"]["name"];					//Extraction des données depuis Spotify
					$urlImage =  $tabTracks[$i]["track"]["album"]["images"][0]["url"];
					
					if(isset($api->getArtist($artisteID)["genres"][0])){
						$genre= new Genre($api->getArtist($artisteID)["genres"][0]);
					}
					else $genre= new Genre("indetermine");

					$tDAO = new TrackDAO();
					$aDAO = new ArtisteDAO();
					$alDAO = new AlbumDAO();
					$gDAO = new GenreDAO();
					
					$track=new Track($titre, $date, $genre);
					$album = new Album($titreAlbum, $urlImage);
					$artiste = new Artiste($artiste, null);
					
					if(!$aDAO->existsName($artiste)){
						$arID =  $aDAO->add($artiste);					//On commence par instancier l'artiste associé : s'il n'existe pas, on le crée, sinon on le recherche depuis la BDD
					} else{
						$arID = $aDAO->readArtistByName($artiste)[0];
					}
					
					$arID->setAlbums($alDAO->readAlbumsByName($arID));			//On affecte les albums existants en BDD à l'artiste trouvé
					
					$found = false;
					foreach($arID->getAlbums() as $key=> $valAlb){

						if(strcmp($valAlb->getTitre(), $album->getTitre()) == 0) {		//Si l'album à ajouter est déjà existant, on l'instancie depuis l'objet ArtisteID créé en mémoire
							$found = true;
							$album = $valAlb;
						} 

					}
					
					if(!$found){
							$album = $alDAO->add($album, $arID);
							$arID->addAlbum($album);				//Si on n'a pas trouvé l'album, on ajoute un nouvel album à l'artiste et on l'enregistre en BDD
					}
					
					if(!$gDAO->existsName($genre)){			//On gère ensuite le genre : s'il existe en BDD, on le charge depuis celle-ci, sinon on sauvegarde le nouveau genre.
						$gid = $gDAO->add($genre);
					} else {
						$gid =  $gDAO->readGenreByName($genre);
					}	
					
					if(!$tDAO->existsName($track, $album)){			//Enfin, on gère le track : de même, si le track appartenant à l'album de l'artiste existe déjà, on le charge. Sinon, on le sauvegarde en BDD.
						
						$tid = $tDAO->add($album, $track, $gid);
					}else {
						$tid = $tDAO->readTrackByName($album, $track);
					}					

					//On met à jour la playlist utilisateur en base de données
					
					$tDAO->addToPlaylist($tid, $test);

				}
			}catch(Exception $e)
			{
					header("Location: ../Vue/HTML/pageErreurConnexion.php");
			}
			}




		}
		
		header("Location: ../Vue/HTML/Mes_partitions.php");

	}

	
?>