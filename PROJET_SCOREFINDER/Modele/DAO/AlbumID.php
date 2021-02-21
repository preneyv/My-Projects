<?php
/**
 * @access public
 * @author Valère Preney - Lucas Poisse
 * @package DAO
 */
 
 require_once(realpath(dirname(__FILE__)) . '/../ScoreFinder/Album.php');
 
class AlbumID extends Album{
	/**
	 * @AttributeType int
	 */
	private $_iD;

	public function __construct($aTitle, $aURL, $aTracks, $id){
		$this->_iD = $id;
		parent::__construct($aTitle, $aURL, $aTracks);
		
		
	}

	public function __clone() {
    	$this->_iD= clone $this->_iD;
    	parent::__construct(clone $this->_titre, clone $this->_uRLImage, clone $this->_tracks);
    	
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