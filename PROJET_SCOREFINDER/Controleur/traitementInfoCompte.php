<?php

	 require_once(realpath(dirname(__FILE__)) . '/../Modele/DAO/TrackDAO.php');
	 require_once(realpath(dirname(__FILE__)) . '/../Modele/DAO/ArtisteDAO.php');
	 require_once(realpath(dirname(__FILE__)) . '/../Modele/DAO/CompteID.php');
	 require_once(realpath(dirname(__FILE__)) . '/../Modele/DAO/AlbumID.php');
	require_once(realpath(dirname(__FILE__)) . '/../Modele/DAO/ArtisteID.php');

	if(!isset($_SESSION))
	{
		session_start();

	}
	 class traitementPlaylistCompte
	 {

	 		

	 		function recupDataPlaylist(CompteID $compte)
	 		{
	 			$artisteDAO = new ArtisteDAO();
	 			$arrayArtiste = $artisteDAO->read($compte);
	 			$compte->setTabTrack($arrayArtiste);
	 	
	 			return $arrayArtiste;
	 		}
	 }

?>