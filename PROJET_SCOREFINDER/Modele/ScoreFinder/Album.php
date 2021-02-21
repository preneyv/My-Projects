<?php
require_once(realpath(dirname(__FILE__)) . '/../ScoreFinder/Track.php');

/**
 * @access public
 * @author Val�re Preney - Lucas Poisse
 * @package ScoreFinder
 * Classe repr�sentant un album
 */
class Album {
	/**
	 * Attribut repr�sentant le titre de l'album
	 * @AttributeType String
	 * @access private
	 */
	private $_titre;
	
	/**
	 * Attribut repr�sentant l'URL de l'image de l'album
	 * @AttributeType String
	 * @access private
	 */
	private $_uRLImage;
	
	
	/**
	 * Attribut repr�sentant la liste des tracks de l'album
	 * @AssociationType ScoreFinder.Track
	 * @AssociationMultiplicity 1..*
	 * @AssociationKind Aggregation
	 * @access private
	 */
	private $_tracks = array();

	//Constructeur
	public function __construct($aTitle, $aURL){
		$this->_titre = $aTitle;
		$this->_uRLImage = $aURL;
	}
	
	
	
	/**
	 * Getter de l'URL de l'image de l'album
	 * @access public
	 * @return l'URL de l'image
	 * @ReturnType String
	 */
	public function getURLImage() {
		return $this->_uRLImage;
	}

	/**
	 * Setter de l'URL de l'image de l'album
	 * @access public
	 * @param String aURLImage la nouvelle URL
	 * @return void
	 * @ParamType aURLImage String
	 * @ReturnType void
	 */
	public function setURLImage($aURLImage) {
		$this->_uRLImage = $aURLImage;
	}

	/**
	 * Getter du titre de l'album
	 * @access public
	 * @return le titre de l'album
	 * @ReturnType String
	 */
	public function getTitre() {
		return $this->_titre;
	}

	/**
	 * Setter du titre de l'album
	 * @access public
	 * @param String aTitre le nouveau titre
	 * @return void
	 * @ParamType aTitre String
	 * @ReturnType void
	 */
	public function setTitre($aTitre) {
		$this->_titre = $aTitre;
	}

	public function ajouterTrack($arrayTrack)
	{
		
			$this->_tracks =  $arrayTrack;
			
	
	}

	public function getTracks()
	{
		return $this->_tracks;
	}
}
?>