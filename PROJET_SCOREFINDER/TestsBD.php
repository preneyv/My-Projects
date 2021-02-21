<?php

/**
					---  Ce fichier regroupe les tests des fonctions du DAO ---
	Attention : les fonctions nécessitant l'utilisation des comptes utilisateur ne sont pas encore testées

**/


require_once("/Modele/DAO/CompteID.php");
require_once("/Modele/DAO/CompteDAO.php");
require_once("/Modele/DAO/TrackID.php");
require_once("/Modele/DAO/TrackDAO.php");
require_once("/Modele/DAO/AlbumID.php");
require_once("/Modele/DAO/AlbumDAO.php");
require_once("/Modele/DAO/ArtisteID.php");
require_once("/Modele/DAO/ArtisteDAO.php");
require_once("/Modele/DAO/GenreID.php");
require_once("/Modele/DAO/GenreDAO.php");

require_once("/Modele/Scorefinder/Album.php");
require_once("/Modele/Scorefinder/Artiste.php");
require_once("/Modele/Scorefinder/Compte.php");
require_once("/Modele/Scorefinder/Genre.php");
require_once("/Modele/Scorefinder/Track.php");

echo "Données en mémoire :"."<br/>";

$genre = new Genre("Musique classique");
echo "Genre : ".$genre->getLibelle()."<br/>";


$track = new Track("La Lettre à Elise", "1810-01-01", $genre);
echo "Track : ".$track->getNom()."<br/>";

$trackarray = array();
$trackarray[] = $track;

$album = new Album("Musique classique : Best of", null, $trackarray);
echo "Album : ".$album->getTitre()."<br/>";


$albumsarray = array();
$albumsarray[] = $album;

$Artiste = new Artiste("Ludwig Van Beethoven", $albumsarray);
echo "Artiste : ".$Artiste->getNom()."<br/>";

echo"<br/>Sauvegarde des données...<br/>";


/**
	Tests du DAO de Genres
**/
$gDAO = new GenreDAO();
$gid = $gDAO->add($genre);				//Les fonctions add() de chaque DAO renvoient l'objet xxID correspondant. 
						    // En effet, on ne peut pas accéder à un autre moyen d'identification comme pour les comptes pour déterminer l'ID en BDD. 


echo "Le genre a été ajouté dans la base de données.<br/>";

// $gDAO->remove($gid);																//Fonctions de suppression et de vérification de la présence d'éléments en BDD
// echo "Genre supprimé de la BDD. <br/>";
// if(!$gDAO->exists($gid)) echo "Suppression du genre réussie. <br/>";
// else echo "Erreur : genre non supprimé !<br/>";

/**
	Tests du DAO d'Artiste
**/
$arDAO = new ArtisteDAO();
$arID = $arDAO->add($Artiste);
echo "L'artiste a été ajouté dans la base de données.<br/>";

 // $arDAO->remove($arID);
 // echo "Artiste supprimé <br/>";
 
// if(!$gDAO->exists($gid)) echo "Suppression de l'artiste réussie. <br/>";
// else echo "Erreur : artiste non supprimé !<br/>";



/**
	Tests du DAO d'Album
**/

$albumDAO = new AlbumDAO();
$albumID = $albumDAO->add($album, $arID);
echo "L'album est enregistré en base de données <br/>";
// $albumDAO->remove($albumID);
// echo "Album supprimé <br/>";


/**
	Tests du DAO de Track
**/
$tDAO = new TrackDAO();
$trackID = $tDAO->add($albumID, $track, $gid);
echo "Track ajouté à la base de données <br/>";

// $tDAO->remove($trackID);
// echo "Track supprimé";




/**
	Note : d'autres fonctions sont à tester avec les comptes (exemple : TrackDAO::addToPlaylist qui met à jour la table "ecoute" de la base de données)
**/


?>