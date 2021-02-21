<?php
/**
 * @access public
 * @author Valère Preney - Lucas Poisse
 * @package DAO
 */
 
require_once(realpath(dirname(__FILE__)) . '/../ScoreFinder/Track.php');
 
class TrackID extends Track {
	/**
	 * @AttributeType int
	 */
	private $_iD;

	public function __construct($nom, $date, $genre, $id){
	
		$this->_iD = $id;
		parent::__construct($nom, $date, $genre);
		
	}

	public function __clone(){
    	$this->_iD=clone $this->getID();
    	parent::__construct(clone $this->_nom, clone $this->_trackdate, clone $this->_genre);
    	
  	}
	/**
	 * @access public
	 * @return int
	 * @ReturnType int
	 */
	public function getID() {
		return $this->_iD;
	}

	/**
	 * @access public
	 * @param int aID
	 * @return void
	 * @ParamType aID int
	 * @ReturnType void
	 */
	public function setID($aID) {
		$this->_iD = $aID;
	}
}
?>