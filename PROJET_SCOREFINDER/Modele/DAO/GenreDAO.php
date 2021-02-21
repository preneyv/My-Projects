<?php
require_once(realpath(dirname(__FILE__)) . '/../DAO/AlbumID.php');
require_once(realpath(dirname(__FILE__)) . '/../DAO/TrackID.php');
require_once(realpath(dirname(__FILE__)) . '/../ScoreFinder/Track.php');
require_once(realpath(dirname(__FILE__)) . '/../DAO/CompteID.php');


/**
 * @access public
 * @author Valère Preney - Lucas Poisse
 * @package DAO
 */
class GenreDAO {
	private $_pdo;
	
	//Constructeur
	public function __construct(){
		
		try{
			$this->_pdo = new PDO('mysql:host=localhost;dbname=scorefinder','root' ,'');
		}
		
		catch(Exception $e){
			die("Erreur : de connexion");
		}
	}
	/**
	 * @access public
	 * Retourne le genreID correspondant au genre ajouté
	 */
	public function add(Genre $aG) {
		
		$request = $this->_pdo->prepare("INSERT INTO Genre (nomGenre) VALUES (:nom)");
		$request->execute(array(
			'nom'=> $aG->getLibelle()
		));
		return new GenreID($aG->getLibelle(), intval($this->_pdo->lastInsertId()));
	}

	/**
	 * @access public
	 * @param DAO.TrackID aT
	 * @return void
	 * @ParamType aT DAO.TrackID
	 * @ReturnType void
	 */
	public function remove(GenreID $aG) {
		
		$req=$this->_pdo->prepare("DELETE FROM Genre WHERE idGenre=:id");
		$req->execute(array(
				'id'=>$aG->getID()
			));

	}

	public function readGenreTrack(TrackID $aT) {
		
		$req=$this->_pdo->prepare("SELECT *  FROM Genre NATURAL JOIN track WHERE idTrack=:id");
		$req->execute(array(
				'id'=>$aT->getID()
			));
		
		$result = $req->fetch(PDO::FETCH_ASSOC);
		
		$ret = new GenreID($result["nomGenre"], $result["idGenre"]);
		
		
		
		return $ret;
	}

	/**
	 * @access public
	 * @param ScoreFinder.Track aT
	 * @return boolean
	 * @ParamType aT ScoreFinder.Track
	 * @ReturnType boolean
	 */
	public function exists(GenreID $aG) {
		$req = $this->_pdo->prepare("SELECT * FROM Genre WHERE idGenre=:id");
		$req->execute(array(
					'id'=>$aG->getID()
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
	 * Renvoie vrai si un genre a le même nom qu'un autre en base de données
	 * @access public
	 * @param ScoreFinder.Track aT
	 * @return boolean
	 * @ParamType aT ScoreFinder.Track
	 * @ReturnType boolean
	 */
	public function existsName(Genre $aG) {
		
		$req = $this->_pdo->prepare("SELECT * FROM Genre WHERE nomGenre=:nomG");
		$req->execute(array(
					'nomG'=>$aG->getLibelle()
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
	
	//Retourne un genre à partir de son nom
	public function readGenreByName(Genre $aG) {
		
		$req=$this->_pdo->prepare("SELECT *  FROM Genre WHERE nomGenre=:nG");
		$req->execute(array(
				'nG'=>$aG->getLibelle()
			));
		
		$result = $req->fetch(PDO::FETCH_ASSOC);
		
		$ret = new GenreID($result["nomGenre"], $result["idGenre"]);
		
		return $ret;
	}
	
	
	
}
?>