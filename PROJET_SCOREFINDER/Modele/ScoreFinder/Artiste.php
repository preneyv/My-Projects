
<?php
require_once(realpath(dirname(__FILE__)) . '/../ScoreFinder/Album.php');

/**
 * @access public
 * @author Valère Preney - Lucas Poisse
 * @package ScoreFinder
 * Classe représentant un artiste
 */
 
class Artiste {
	
	
	
	
	/**
	 * Attribut représentant le nom de l'artiste
	 * @AttributeType String
	 * @access private
	 */
	private $_nom;


	
	/**
	 * La liste des albums de l'artiste
	 * @AssociationType ScoreFinder.Album
	 * @AssociationMultiplicity 0..*
	 * @AssociationKind Aggregation
	 * @access private
	 */
	private $_albums = array();

	public function __construct($name, $albums){
		
		$this->_nom = $name;
		$this->_albums=$albums;
	}

	/**
	 * Getter du nom de l'artiste
	 * @access public
	 * @return le nom de l'artiste
	 * @ReturnType String
	 */
	public function getNom() {
		return $this->_nom;
	}

	/**
	 * Setter du nom de l'artiste
	 * @access public
	 * @param String aNom le nom de l'artiste
	 * @return void
	 * @ParamType aNom String 
	 * @ReturnType void
	 */
	public function setNom($aNom) {
		$this->_nom = $aNom;
	}
	
	/**
	 * Getter de la liste des albums
	 * @access public
	 * @return les albums de l'artiste
	 * @ReturnType array()
	 */
	public function getAlbums() {
		return $this->_albums;
	}

	/**
	 * Setter de la liste des albums
	 * @access public
	 * @param String aAlbums la liste d'albums de l'artiste
	 * @return void
	 * @ParamType aAlbums array()
	 * @ReturnType void
	 */
	public function setAlbums($aAlbums) {

		$this->_albums =$aAlbums;
	}
	
	
	/**
	 * Ajoute un album à un artiste
	 * @access public
	 * @param String aAlbums la liste d'albums de l'artiste
	 * @return void
	 * @ParamType aAlbums array()
	 * @ReturnType void
	 */
	public function addAlbum($aAlbum) {

		$this->_albums[] = $aAlbum;
	}
}
?>