<?php
require_once(realpath(dirname(__FILE__)) . '/../ScoreFinder/Compte.php');
require_once(realpath(dirname(__FILE__)) . '/../DAO/CompteID.php');

/**
 * @access public
 * @author Valère Preney - Lucas Poisse
 * @package DAO
 */
class CompteDAO {
	private $_pdo;
	
	
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
	 * @param ScoreFinder.Compte aC
	 * @param String aHmdp
	 * @return void
	 * @ParamType aC ScoreFinder.Compte
	 * @ParamType aHmdp String
	 * @ReturnType void
	 */
	public function add(Compte $aC, $aHmdp) {
		
		$requete = $this->_pdo->prepare("INSERT INTO compte (mdp, mailCompte,userName, prenom, nom, playlistSpotify, playlistDeezer)VALUES (:pw, :mail, :pseudo, :surname, :name, :spotify, :deezer )");
			$requete->execute(array(
				'pw'=> $aHmdp,
				'mail'=>$aC->getMail(),
				'pseudo'=>$aC->getUserName(),
				'surname'=>$aC->getPrenom(),
				'name'=>$aC->getNom(),
				'spotify'=>$aC->getAutorisationSpotify(),
				'deezer'=>$aC->getAutorisationDeezer()
			));
	}

	/**
	 * @access public
	 * @param DAO.CompteID aC
	 * @return void
	 * @ParamType aC DAO.CompteID
	 * @ReturnType void
	 */
	public function remove(CompteID $aC) {
		// Not yet implemented
	}

	/**
	 * @access public
	 * @param DAO.CompteID aC
	 * @return void
	 * @ParamType aC DAO.CompteID
	 * @ReturnType void
	 */
	public function update(CompteID $aC, $itemToChange, $valueToChange) {
		
		$requete = $this->_pdo->prepare("UPDATE compte SET ".$itemToChange."= :newValue WHERE idCompte= :idUser");
			$requete->execute(array(
				'newValue'=>$valueToChange,
				'idUser'=>$aC->getID()
			));
	}

	/**
	 * @access public
	 * @param ScoreFinder.CompteID aC
	 * @return void
	 * @ParamType aC ScoreFinder.CompteID
	 * @ReturnType void
	 */
	public function read(CompteID $aC) {
		// Not yet implemented
	}
	


	/**
	 * @access public
	 * @param ScoreFinder.Compte aC
	 * @return boolean
	 * @ParamType aC ScoreFinder.Compte
	 * @ReturnType boolean
	 */
	public function exists(Compte $aC, $aMdp) {
		var_dump($aC);
		$req = $this->_pdo->prepare("SELECT * FROM compte WHERE userName=:username AND mdp=:pw AND mailCompte=:email");
		$req->execute(array(
					'username'=>$aC->getUserName(),
					'pw'=>$aMdp,
					'email'=>$aC->getMail()
			));
		$req->fetchAll(PDO::FETCH_OBJ);
		if($req->rowCount()>=1)
		{
			echo 'true';
			$res=true;
		}
		else{
			echo 'false';
			$res=false;
		}
		$req->closeCursor();
		return $res;
		
	}
}
?>