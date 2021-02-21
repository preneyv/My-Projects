<?php
require_once(realpath(dirname(__FILE__)) . '/../DAO/AlbumID.php');
require_once(realpath(dirname(__FILE__)) . '/../DAO/ArtisteID.php');
require_once(realpath(dirname(__FILE__)) . '/../ScoreFinder/Album.php');
require_once(realpath(dirname(__FILE__)) . '/../DAO/CompteID.php');
require_once(realpath(dirname(__FILE__)) . '/../DAO/TrackDAO.php');

/**
 * @access public
 * @author Valère Preney - Lucas Poisse
 * @package DAO
 */
class AlbumDAO {
	
	private $_pdo;
	
	
	public function __construct(){
		
		try{
			$this->_pdo = new PDO('mysql:host=localhost;dbname=scorefinder', "root","");
		}
		
		catch(Exception $e){
			die("Erreur : de connexion");
		}
	}

	/**
	 * @access public
	 * @param DAO.Album aT
	 * @param DAO.ArtisteID aA
	 * @return void
	 * @ParamType aT DAO.Album
	 * @ParamType aA DAO.ArtisteID
	 * @ReturnType void
	 */
	public function add(Album $aT, ArtisteID $aA) {
		$req=$this->_pdo->prepare("INSERT INTO album (titreAlbum, URLImage, idArtiste) VALUES (:title, :URL, :idArtiste)");
		$req->execute(array(
				'title'=>$aT->getTitre(),
				'URL'=>$aT->getURLImage(),
				'idArtiste'=>$aA->getID()

			));
		return new AlbumID($aT->getTitre(), $aT->getURLImage(), $aT->getTracks(), intval($this->_pdo->lastInsertId()));
	}

	/**
	 * @access public
	 * @param DAO.AlbumID aT
	 * @return void
	 * @ParamType aT DAO.AlbumID
	 * @ReturnType void
	 */
	public function remove(AlbumID $aT) {
		$req=$this->_pdo->prepare("DELETE FROM album WHERE idAlbum=:id");
		$req->execute(array(
				'id'=>$aT->getID()
			));
	}

	/**
		Fonction renvoyant la liste des albums d'un artiste
	 */
	public function read(ArtisteID $aA, CompteID $aC) {

		$req=$this->_pdo->prepare("SELECT DISTINCT idAlbum, titreAlbum, URLImage, idArtiste FROM album NATURAL JOIN track NATURAL JOIN ecoute WHERE idCompte=:idC AND idArtiste =:idA");		//On commence par trier en fonction de l'artiste souhaité
		$req->execute(array(
				'idC'=>$aC->getID(),
				'idA'=>$aA->getID()
			));
		$retour = array();
		while($result = $req->fetch(PDO::FETCH_ASSOC))
		{
			
			$retour[] = new AlbumID($result["titreAlbum"], $result["URLImage"], null, $result["idAlbum"]);

					//Instanciation de l'objet
		}
		
		$trackDAO = new TrackDAO();
		foreach ($retour as $value){
			$value->ajouterTrack($trackDAO->readTracks($value, $aC));			//On ajoute les tracks à l'album via un TrackDAO
		}
		
		$req->closeCursor();
		return $retour;

	}
	
	
	/**
	 * Renvoie vrai si un album d'un artiste a le même nom qu'un autre en base de données
	 * @access public
	 * @param ScoreFinder.Track aT
	 * @return boolean
	 * @ParamType aT ScoreFinder.Track
	 * @ReturnType boolean
	 */
	public function existsName(Album $aAl, Artiste $aA) {
		
		$req = $this->_pdo->prepare("SELECT * FROM Album NATURAL JOIN Artiste WHERE nomAlbum=:nomAl AND nomArtiste = :nomA ");
		$req->execute(array(
					'nomAl'=>$al->getTitre(),
					'nomA'=>$aA->getNom()
		));
		
		
		$req->fetchAll(PDO::FETCH_OBJ);
		if($req->rowCount()>=1)
		{
			
			$res=true;
		}
		else{
		
			$res=false;
		}

		return $res;
	}
	
	
		
	/**
	 * Renvoie les albums d'un artiste à partir de son ID
	 * @access public
	 * @param ScoreFinder.Track aT
	 * @return boolean
	 * @ParamType aT ScoreFinder.Track
	 * @ReturnType boolean
	 */
	public function readAlbumsByName(ArtisteID $aA) {

		$req=$this->_pdo->prepare("SELECT DISTINCT idAlbum, titreAlbum, idArtiste, nomArtiste, URLImage FROM album NATURAL JOIN artiste WHERE idArtiste =:idAr");		//On commence par trier en fonction de l'artiste souhaité
		$req->execute(array(
				'idAr'=>$aA->getID()
			));
			
		$retour = array();
		while($result = $req->fetch(PDO::FETCH_ASSOC))
		{
			$retour[] = new AlbumID($result["titreAlbum"], $result["URLImage"], null, $result["idAlbum"]);
		}
		
		$trackDAO = new TrackDAO();
		foreach ($retour as $value){
			$value->ajouterTrack($trackDAO->readTracksByName($value));			//On ajoute les tracks à l'album via un TrackDAO
		}

		
		$req->closeCursor();
		return $retour;

	}
	
}
?>