<?php
require_once(realpath(dirname(__FILE__)) . '/../DAO/AlbumID.php');
require_once(realpath(dirname(__FILE__)) . '/../DAO/TrackID.php');
require_once(realpath(dirname(__FILE__)) . '/../ScoreFinder/Track.php');
require_once(realpath(dirname(__FILE__)) . '/../DAO/CompteID.php');
require_once(realpath(dirname(__FILE__)) . '/../DAO/CompteDAO.php');
require_once(realpath(dirname(__FILE__)) . '/../DAO/GenreDAO.php');

/**
 * @access public
 * @author Valère Preney - Lucas Poisse
 * @package DAO
 */
class TrackDAO {
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
	 * @param DAO.AlbumID aA
	 * @param DAO.Track aT
	 * @return void
	 * @ParamType aA DAO.AlbumID
	 * @ParamType aT DAO.Track
	 * @ReturnType void
	 */
	public function add(AlbumID $aA, Track $aT, GenreID $aG) {
	
		$request = $this->_pdo->prepare("INSERT INTO track (nomTrack, dateTrack,idGenre, idAlbum) VALUES (:nom, :date, :genre, :album)");
		$request->execute(array(
			'nom'=> $aT->getNom(),
			'date'=>$aT->getTrackDate(),
			'genre'=>$aG->getID(),
			'album'=>$aA->getID()
		));
		return new TrackID($aT->getNom(), $aT->getTrackDate(), $aG, intval($this->_pdo->lastInsertId()));
		
	}

	/**
	 * @access public
	 * @param DAO.TrackID aT
	 * @return void
	 * @ParamType aT DAO.TrackID
	 * @ReturnType void
	 */
	public function remove(TrackID $aT) {
		$request = $this->_pdo->prepare("DELETE FROM  track WHERE idTrack = :id");
		$request->execute(array(
			'id'=> $aT->getID()
		));
	}

	//Fonction ajoutant un track dans une playlist utilisateur
	public function addToPlaylist(TrackID $aT, CompteID $aC) {
		if(!$this->exists($aT)) 
			throw new Exception('Track non référencé dans la base de données.');
		
		$request = $this->_pdo->prepare("INSERT INTO ecoute (idTrack, idCompte) VALUES (:track, :compte)");
		$request->execute(array(
			'track'=> $aT->getID(),
			'compte' => $aC->getID()
		));
			

	}
	
	/**
	 * @access public
	 * @param DAO.CompteID aC
	 * @return ScoreFinder.TrackID[]
	 * @ParamType aC DAO.CompteID
	 * @ReturnType ScoreFinder.TrackID[]
	 */
	public function readPlaylist(CompteID $aC) {
		
		$CDAO = new CompteDAO();
		if (!$CDAO->exists($aC))
			throw new Exception('Compte non référencé dans la base de données.');
		
		$tracks = array();
		$request = $this->_pdo->prepare("SELECT * FROM compte NATURAL JOIN ecoute NATURAL JOIN track WHERE idCompte = :id");
		
		$request->execute(array(
			'id'=> $aC->getID()
		));
		
		while($data = $request->fetch(PDO::FETCH_ASSOC)){
			
			$tracks[] = new TrackID($request["nomTrack"],$request["dateTrack"], $request["idTrack"]);
			
		}
		
		$request->closeCursor();
		return $tracks;
	}
	
	/**
		Fonction renvoyant les tracks d'un albumID écouté par un compte
	**/
	
		public function readTracks(AlbumID $aA, CompteID $aC) {
		
		
			$req2=$this->_pdo->prepare("SELECT * FROM track NATURAL JOIN ecoute NATURAL JOIN compte WHERE idCompte=:idC AND idAlbum=:idA");
			$req2->execute(array(
				'idC'=>$aC->getID(),
				'idA'=>$aA->getID()
				
			));
			$retour = array();
			while($result2 = $req2->fetch(PDO::FETCH_ASSOC))
			{
				$gDAO = new GenreDAO();
				$track= new TrackID($result2["nomTrack"], $result2["dateTrack"],null, $result2["idTrack"]);
				$gID = $gDAO->readGenreTrack($track);
				$track->setGenre($gID);
				$gID->addTrack($track);
				$retour[] = $track;		//On rassemble les tracks de l'album et on le renvoie
			}
			
		
		$req2->closeCursor();
		return $retour;
		}
	

	/**
	 * @access public
	 * @param ScoreFinder.Track aT
	 * @return boolean
	 * @ParamType aT ScoreFinder.Track
	 * @ReturnType boolean
	 */
	public function exists(TrackID $aT) {
		
		$req = $this->_pdo->prepare("SELECT * FROM track WHERE idTrack=:id");
		$req->execute(array(
					'id'=>$aT->getID()
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
	 * Renvoie vrai si un track a le même nom qu'un autre en base de données
	 * @access public
	 * @param ScoreFinder.Track aT
	 * @return boolean
	 * @ParamType aT ScoreFinder.Track
	 * @ReturnType boolean
	 */
	public function existsName(Track $aT, AlbumID $aA) {
		
		$req = $this->_pdo->prepare("SELECT * FROM track NATURAL JOIN Album WHERE nomTrack=:nomT AND idAlbum = :idA ");
		$req->execute(array(
					'nomT'=>$aT->getNom(),
					'idA'=>$aA->getID()
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
		Fonction renvoyant les tracks d'un albumID 
	**/
	
		public function readTracksByName(AlbumID $aA) {
		
		
			$req2=$this->_pdo->prepare("SELECT * FROM track NATURAL JOIN album WHERE idAlbum=:idAl");
			$req2->execute(array(
				'idAl'=>$aA->getID()
				
			));
			$retour = array();
			while($result2 = $req2->fetch(PDO::FETCH_ASSOC))
			{
				$gDAO = new GenreDAO();
				$track= new TrackID($result2["nomTrack"], $result2["dateTrack"],null, $result2["idTrack"]);
				$gID = $gDAO->readGenreTrack($track);
				$track->setGenre($gID);
				$gID->addTrack($track);
				$retour[] = $track;		//On rassemble les tracks de l'album et on le renvoie
			}
			
		
		$req2->closeCursor();
		return $retour;
		}
		
	/**
		Fonction renvoyant le trackID à partir d'un track d'un album
	**/
	
		public function readTrackByName(AlbumID $aA, Track $aT) {
		
		
			$req2=$this->_pdo->prepare("SELECT * FROM track NATURAL JOIN album WHERE idAlbum=:idAl AND nomTrack=:nT");
			$req2->execute(array(
				'idAl'=>$aA->getID(),
				'nT' => $aT->getNom()
				
			));
			
			$retour = array();
			while($result2 = $req2->fetch(PDO::FETCH_ASSOC))
			{
				$gDAO = new GenreDAO();
				$track= new TrackID($result2["nomTrack"], $result2["dateTrack"],null, $result2["idTrack"]);
				$gID = $gDAO->readGenreTrack($track);
				$track->setGenre($gID);
				$gID->addTrack($track);
				$retour[] = $track;		//On rassemble les tracks de l'album et on le renvoie
			}
			
		
		$req2->closeCursor();
		return $retour[0];
		}
	
}
?>