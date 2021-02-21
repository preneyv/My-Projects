<?php
/**
 * @access public
 * @author Valère Preney - Lucas Poisse
 * @package DAO
 */
 
 require_once(realpath(dirname(__FILE__)) . '/../ScoreFinder/Genre.php');

class GenreID extends Genre{
	/**
	 * @AttributeType int
	 */
	private $_iD;

	
	public function __construct($libelle, $id){
		
		parent::__construct($libelle);
		$this->_iD = $id;
		
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