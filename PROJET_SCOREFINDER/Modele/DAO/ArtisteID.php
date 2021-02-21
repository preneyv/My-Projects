<?php
/**
 * @access public
 * @author Val�re Preney - Lucas Poisse
 * @package DAO
 */
 
 require_once(realpath(dirname(__FILE__)) . '/../ScoreFinder/Artiste.php');
class ArtisteID extends Artiste {
	/**
	 * @AttributeType int
	 */
	private $_iD;
	
	public function __construct($nom, $albums, $id){
		
		$this->_iD = $id;
		parent::__construct($nom, $albums);
	}

	public function __clone() {
    	$this->_iD=clone $this->_iD;
    	parent::__construct(clone $this->_nom, clone $this->_albums);
    	
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