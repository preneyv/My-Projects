<?php
require_once(realpath(dirname(__FILE__)) . '/../ScoreFinder/Track.php');

/**
 * @access public
 * @author Valère Preney - Lucas Poisse
 * @package ScoreFinder
 * Classe représentant un track favori
 */
 
class PresenceFavoris {
	
	/**
	 * Rang de notation dans les favoris (de 1 à 5 ?)
	 * @AttributeType int
	 */
	private $_rank;

	/**
	 * Track du PresenceTrack
	 * @AssociationType ScoreFinder.Track
	 * @AssociationMultiplicity 0..*
	 * @AssociationKind Aggregation
	 */
	private $_track;

	/**
	 * Getter du rang dans les favoris
	 * @access public
	 * @return le rang du track dans les favoris
	 * @ReturnType int
	 */
	public function getRank() {
		return $this->_rank;
	}

	/**
	 * Setter du rang dans les favoris
	 * @access public
	 * @param int le nouveau rang dans les favoris
	 * @return void
	 * @ParamType aRank int
	 * @ReturnType void
	 */
	public function setRank($aRank) {
		$this->_rank = $aRank;
	}

	/**
	 * Setter du track du PresenceTrack
	 * @access public
	 * @param aTrack le track du PresenceTrack
	 * @return void
	 * @ParamType aTrack ScoreFinder.Track
	 * @ReturnType void
	 */
	public function setTrack($aTrack) {
		$this->_track = $aTrack;
	}

	/**
	 * Getter du Track du PresenceTrack
	 * @access public
	 * @return le track du PresenceTrack
	 * @ReturnType ScoreFinder.Track
	 */
	public function getTrack() {
		return $this->_track;
	}
}
?>