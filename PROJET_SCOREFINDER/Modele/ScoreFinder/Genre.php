<?php
require_once(realpath(dirname(__FILE__)) . '/../ScoreFinder/Track.php');
require_once(realpath(dirname(__FILE__)) . '/../DAO/TrackID.php');

/**
 * @access public
 * @author Valère Preney - Lucas Poisse
 * @package ScoreFinder
 * Classe représentant un genre de musique
 */
 
 
class Genre {
	/**
	 * Nom du genre
	 * @AttributeType String
	 */
	private $_libelle;

	public function __construct($libelle){
		
		$this->_libelle = $libelle;
		
		
	}
	/**
	 * Liste des tracks du genre
	 * @AssociationType ScoreFinder.Track
	 * @AssociationMultiplicity 0..*
	 * @AssociationKind Aggregation
	 */
	public $_tracks = array();

	/**
	 * Getter du nom du genre
	 * @access public
	 * @return le nom du genre
	 * @ReturnType String
	 */
	public function getLibelle() {
		return $this->_libelle;
	}

	/**
	 * Setter du nom du genre
	 * @access public
	 * @param String aLibellé le nouveau nom du genre
	 * @return void
	 * @ParamType aLibellé String
	 * @ReturnType void
	 */
	public function setLibelle($aLibelle) {
		$this->_libelle = $aLibelle;
	}

	public function addTrack(TrackID $track)
	{
		array_push($this->_tracks, $track);
	}
	
}
?>