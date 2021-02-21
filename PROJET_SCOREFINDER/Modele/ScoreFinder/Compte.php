<?php
require_once(realpath(dirname(__FILE__)) . '/../ScoreFinder/PresenceFavoris.php');

/**
 * @access public
 * @author Val�re Preney - Lucas Poisse
 * @package ScoreFinder
 * Classe repr�sentant un compte d'utilisateur
 */
 
class Compte {
	
	/**
	 * Attribut repr�sentant le pseudo d'utilisateur
	 * @AttributeType String
	 * @access private
	 */
	private $_userName;
	
	/**
	 * Attribut repr�sentant le pr�nom d'utilisateur
	 * @AttributeType String
	 * @access private
	 */
	private $_prenom;
	
	/**
	 * Attribut repr�sentant le nom d'utilisateur
	 * @AttributeType String
	 * @access private
	 */
	private $_nom;
	
	
	/**
	 * Attribut repr�sentant le mail d'utilisateur
	 * @AttributeType String
	 * @access private
	 */
	private $_mail;
	
	/**
	 * Liste des tracks 
	 * @AssociationMultiplicity 0..*
	 * @AssociationKind Aggregation
	 * @access private
	 */
	private $_playlist = array();
	
	/**
	 * Liste des tracks favoris
	 * @AssociationType ScoreFinder.PresenceFavoris
	 * @AssociationMultiplicity 0..*
	 * @AssociationKind Aggregation
	 * @access private
	 */
	private $_favorites = array();

	private $_spotifyAccount;
	private $_deezerAccount;

	
	//Constructeur param�tr�
	public function __construct($pseudo, $prenom, $nom, $mail, $playlist, $fav, $spotify, $deezer){
		
		$this->_userName = $pseudo;
		$this->_prenom = $prenom;
		$this->_nom = $nom;
		$this->_mail = $mail;
		$this->_playlist = $playlist;
		$this->_favorites = $fav;
		$this->_spotifyAccount=$spotify;
		$this->_deezerAccount=$deezer;
		
		
	}

	/**
	 * Getter du pseudo d'utilisateur
	 * @access public
	 * @return le pseudo d'utilisateur
	 * @ReturnType String
	 */
	public function getUserName() {
		return $this->_userName;
	}

	/**
	 * Setter du pseudo utilisateur
	 * @access public
	 * @param String aUserName le nouveau nom utilisateur
	 * @return void
	 * @ParamType aUserName String
	 * @ReturnType void
	 */
	public function setUserName($aUserName) {
		$this->_userName = $aUserName;
	}

	/**
	 * Getter du pr�nom utilisateur
	 * @access public
	 * @return le pr�nom utilisateur
	 * @ReturnType String
	 */
	public function getPrenom() {
		return $this->_prenom;
	}

	/**
	 * Setter du pr�nom utilisateur
	 * @access public
	 * @param String aPrenom le pr�nom utilisateur
	 * @return void
	 * @ParamType aPrenom String
	 * @ReturnType void
	 */
	public function setPrenom($aPrenom) {
		$this->_prenom = $aPrenom;
	}

	/**
	 * Getter du nom de l'utilisateur
	 * @access public
	 * @return le nom de l'utilisateur
	 * @ReturnType String
	 */
	public function getNom() {
		return $this->_nom;
	}

	/**
	 * Setter du nom de l'utilisateur
	 * @access public
	 * @param String aNom le nom de l'utilisateur
	 * @return void
	 * @ParamType aNom String
	 * @ReturnType void
	 */
	public function setNom($aNom) {
		$this->_nom = $aNom;
	}

	/**
	 * Getter du mail de l'utilisateur
	 * @access public
	 * @return le mail de l'utilisateur
	 * @ReturnType String
	 */
	public function getMail() {
		return $this->_mail;
	}

	/**
	 * Setter du mail de l'utilisateur
	 * @access public
	 * @param String aMail le nouveau mail de l'utilisateur
	 * @return void
	 * @ParamType aMail String
	 * @ReturnType void
	 */
	public function setMail($aMail) {
		$this->_mail = $aMail;
	}


	 /**
	 * Getter de l'autorisation du compte spotify de l'utilisateur
	 * @access public
	 * @return la valeur de l'autorisation d'acc�s de l'utilisateur
	 * @ReturnType int
	 */

	public function getAutorisationSpotify() {
		return $this->_spotifyAccount;;
	}

	/**
	 * Setter de l'autorisation du compte spotify de l'utilisateur
	 * @access public
	 * @param String aSpotify la nouvelle valeur de l'autorisation d'acc�s de l'utilisateur
	 * @return void
	 * @ParamType aSpotify String
	 * @ReturnType void
	 */
	public function setAutorisationSpotify($aSpotify) {
		$this->_spotifyAccount = $aSpotify;
	}

	/**
	 * Getter de l'autorisation du compte deezer de l'utilisateur
	 * @access public
	 * @return la valeur de l'autorisation d'acc�s de l'utilisateur
	 * @ReturnType int
	 */

	public function getAutorisationDeezer() {
		return $this->_deezerAccount;
	}

	/**
	 * Setter de l'autorisation du compte deezer de l'utilisateur
	 * @access public
	 * @param String aDeezer la nouvelle valeur de l'autorisation d'acc�s de l'utilisateur
	 * @return void
	 * @ParamType aDeezer String
	 * @ReturnType void
	 */
	public function setAutorisationDeezer($aDeezer) {
		$this->_deezerAccount = $aDeezer;
	}
	
	
	
/**
	 * Fonction ajoutant un track � la playlist utilisateur
	 * @access public
	 * @param Track aTrack le track � ajouter
	 * @return void
	 * @ParamType aTrack Track
	 * @ReturnType void
	 */
	public function addTrack($aTrack) {
		array_push($this->_playlist, aTrack);
	}
	
/**
	 * Fonction enlevant un track � la playlist utilisateur
	 * @access public
	 * @param Track aTrack le track � enlever
	 * @return void
	 * @ParamType aTrack Track
	 * @ReturnType void
	 */
	public function removeTrack($aTrack) {
		
		if(($key = array_search($aTrack, $this->_playlist)) !== false) {
			unset($this->_playlist[$key]);
		}
	}
	
		
/**
	 * Fonction ajoutant un track favori � la playlist utilisateur
	 * @access public
	 * @param Track aTrack le track favori � ajouter
	 * @return void
	 * @ParamType aTrack Track
	 * @ReturnType void
	 */
	public function addFavorite($aTrack) {
		array_push($this->_favorites, aTrack);
	}
	
/**
	 * Fonction enlevant un track favori � la playlist utilisateur
	 * @access public
	 * @param Track aTrack le track favori � enlever
	 * @return void
	 * @ParamType aTrack Track
	 * @ReturnType void
	 */
	public function removeFavorite($aTrack) {
		
		if(($key = array_search($aTrack, $this->_favorites)) !== false) {
			unset($this->_favorites[$key]);
		}
	}
	
	//Setter des tracks
	public function setTabTrack($array){
		$this->_playlist = $array;
	}
	
	
}
?>