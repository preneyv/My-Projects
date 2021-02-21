<?php

require_once(realpath(dirname(__FILE__)) . '/../ScoreFinder/Compte.php');
/**
 * @access public
 * @author Valère Preney - Lucas Poisse
 * @package DAO
 */
class CompteID extends Compte{
	/**
	 * @AttributeType int
	 */
	private $_iD;
	public function __construct($id,$pseudo, $prenom, $nom, $mail, $playlist, $fav, $spotify, $deezer)
	{
		$this->_iD = $id;
		parent::__construct($pseudo, $prenom, $nom, $mail, $playlist, $fav, $spotify, $deezer);
		
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