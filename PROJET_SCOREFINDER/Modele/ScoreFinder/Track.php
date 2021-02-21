<?php
require_once(realpath(dirname(__FILE__)) . '/../ScoreFinder/Artiste.php');
require_once(realpath(dirname(__FILE__)) . '/../DAO/GenreID.php');

/**
 * @access public
 * @author Valère Preney - Lucas Poisse
 * @package ScoreFinder
 * Classe représentant un track de musique
 */
class Track {
	
	/**
	 * Le nom du track
	 * @AttributeType String
	 */
	private $_nom;
	
	/**
	 * La date du track
	 * @AttributeType Date
	 */
	private $_trackdate;
	private $_genre;

	public function __construct($nom, $date, $genre){
		$this->_nom = $nom;
		$this->_trackdate = $date;
		$this->_genre = $genre;
	}

	/**
	 * Getter du nom du track
	 * @access public
	 * @return le nom du track
	 * @ReturnType String
	 */
	public function getNom() {
		return $this->_nom;
	}

	/**
	 * Setter du nom du track
	 * @access public
	 * @param String aNom le nouveau nom du track
	 * @return void
	 * @ParamType aNom String
	 * @ReturnType void
	 */
	public function setNom($aNom) {
		$this->_nom = $aNom;
	}

	/**
	 * Getter de la date du track
	 * @access public
	 * @return la date du track
	 * @ReturnType Date
	 */
	public function getTrackDate() {
		return $this->_trackdate;
	}

	/**
	 * Setter de la date du track
	 * @access public
	 * @param Date aDate la nouvelle date du track
	 * @return void
	 * @ParamType aDate Date
	 * @ReturnType void
	 */
	public function setTrackDate(Date $aDate) {
		$this->_trackdate = $aDate;
	}


	public function getGenre()
	{
		return $this->_genre;
	}
	public function setGenre(GenreID $genre)
	{
		$this->_genre = $genre;
	}
}
?>