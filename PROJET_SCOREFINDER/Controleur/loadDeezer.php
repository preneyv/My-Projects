<?php
require_once(realpath(dirname(__FILE__)) . '/../Modele/WebDataAccess/Deezer PHP API/class.deezerapi.php');
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
	$dzapi = new deezerapi(array(
		'app_id'		=> "174311",
		'app_secret' 	=> "40973eb52a4a0d9ff38609a5c727fafe",
		'my_url' 		=> "http://localhost/ScoreFinder/Vue/HTML/Mes_partitions.php"
	));

	$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

	$accessToken = $_GET['accessToken'];
	$expires = $_GET['expires'];

	$dzapi->setToken($accessToken);
	$user = $dzapi->getUser();

	$playlistsO = $dzapi->getPlaylist();


	foreach($playlistsO as $key=>$playlists){

		for($k=1;$k<count($playlists);$k++){					//Omission volontaire de la liste "coups de coeur"
			
			$playlistID = $playlists[$k]->id;
			$tracks = $dzapi->getPlaylist($playlistID, "tracks");
			$tracks = get_object_vars($tracks)["data"];

			for($i=0;$i<count($tracks);$i++){

				$track = get_object_vars($tracks[$i]);
				$date = date('Y-m-d', $track["time_add"]);
				$artiste = $track["artist"]->name;
				$titre = $track["title"];							//Extraction des données depuis Deezer
				$titreAlbum = $track["album"]->title;
				$urlImage = $track["album"]->cover_big;
				$albumID = $track["album"]->id;
				$albumObject = $dzapi->getAlbum($albumID);
				$nomGenre =$albumObject->genres->data[0]->name; 
				
				if(isset($nomGenre)){
					$genre= new Genre($nomGenre);
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
				$tDAO->addToPlaylist($tid, $_SESSION['user']['compte']);			

				}
			}
		}

		header("Location: ../Vue/HTML/pageDeezerCompleted.php");
}

 catch(Exception $e){
	header("Location : ../Vue/HTML/pageErreurConnexion.php");
}
	
?>

