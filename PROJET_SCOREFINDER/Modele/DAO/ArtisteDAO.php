<?php
require_once(realpath(dirname(__FILE__)) . '/../DAO/ArtisteID.php');
require_once(realpath(dirname(__FILE__)) . '/../ScoreFinder/Artiste.php');
require_once(realpath(dirname(__FILE__)) . '/../DAO/CompteID.php');
require_once(realpath(dirname(__FILE__)) . '/../DAO/AlbumDAO.php');
require_once(realpath(dirname(__FILE__)) . '/../DAO/AlbumID.php');

/**
 * @access public
 * @author Valère Preney - Lucas Poisse
 * @package DAO
 */
class ArtisteDAO {
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
	 * @param DAO.ArtisteID aA
	 * @return void
	 * @ParamType aA DAO.ArtisteID
	 * @ReturnType void
	 */
	public function add(Artiste $aA) {
		
		$request = $this->_pdo->prepare("INSERT INTO Artiste (nomArtiste) VALUES (:nom)");
		$request->execute(array(
			'nom'=> $aA->getNom()
		));
		return new ArtisteID($aA->getNom(), $aA->getAlbums(), intval($this->_pdo->lastInsertId()));
		
	}

	/**
	 * @access public
	 * @param DAO.ArtisteID aA
	 * @return void
	 * @ParamType aA DAO.ArtisteID
	 * @ReturnType void
	 */
	public function remove(ArtisteID $aA) {
		
		$req=$this->_pdo->prepare("DELETE FROM Artiste WHERE idArtiste=:id");
		$req->execute(array(
				'id'=>$aA->getID()
			));
			
	}

	/**
	 * Retourne tous les artistes écoutés par un compte
	 * @access public
	 * @param DAO.CompteID aC
	 * @return ScoreFinder.ArtisteID[]
	 * @ParamType aC DAO.CompteID
	 * @ReturnType ScoreFinder.ArtisteID[]
	 */
	public function read(CompteID $aC) {
		$req=$this->_pdo->prepare("SELECT DISTINCT nomArtiste, idArtiste FROM artiste NATURAL JOIN album NATURAL JOIN track NATURAL JOIN ecoute NATURAL JOIN compte WHERE idCompte=:idC");
		$req->execute(array(
				'idC'=>$aC->getID()
			));
		$retour = array();
		while($result = $req->fetch(PDO::FETCH_ASSOC))
		{
			
			$retour[] = new ArtisteID($result["nomArtiste"], null,$result["idArtiste"]);
		}
		
		$albums =array();
		foreach ($retour as $value) {								//Pour tous les artistes écoutés par le compte, on initialise leurs albums via un albumDAO

			$albumDAO = new AlbumDAO();
			$value->setAlbums($albumDAO->read($value, $aC));
		}
		$req->closeCursor();
		return $retour;
	}
	
	/**
	 * Renvoie vrai si un artiste a le même nom qu'un autre en base de données
	 * @access public
	 * @param ScoreFinder.Track aT
	 * @return boolean
	 * @ParamType aT ScoreFinder.Track
	 * @ReturnType boolean
	 */
	public function existsName(Artiste $aA) {
		
		$req = $this->_pdo->prepare("SELECT * FROM artiste WHERE nomArtiste = :nomA ");
		$req->execute(array(
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
	
	
	//Retourne une liste d'artisteID (1ere occurence = artiste recherché) à partir d'un objet artiste
	public function readArtistByName(Artiste $aA) {
		
		$req=$this->_pdo->prepare("SELECT DISTINCT nomArtiste, idArtiste FROM artiste WHERE nomArtiste=:nomA");
		$req->execute(array(
				'nomA'=>$aA->getNom()
			));
		$retour = array();
		while($result = $req->fetch(PDO::FETCH_ASSOC))
		{
			
			$retour[] = new ArtisteID($result["nomArtiste"], null,$result["idArtiste"]);
		}
		
		$albums =array();
		foreach ($retour as $value) {								//Pour tous les artistes écoutés par le compte, on initialise leurs albums via un albumDAO

			$albumDAO = new AlbumDAO();
			$value->setAlbums($albumDAO->readAlbumsByName($value));
			
			
		}
		$req->closeCursor();
		return $retour;
	
	}
	
	
	
}
?>