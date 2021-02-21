<?php
require_once(realpath(dirname(__FILE__)) . '/../ScoreFinder/Compte.php');

/**
 * @access public
 * @author Val�re Preney - Lucas Poisse
 * @package WebDataAccess
 */
abstract class FileParser {
	/**
	 * @AttributeType String
	 */
	private $_requestToken;
	/**
	 * @AttributeType String
	 * Correspond aux donn�es t�l�charg�es de l'utilisateur (type encore inconnu pour le moment). Cet attribut sera utilis� par le proxy pour ne pas avoir � re-t�l�charger en permanence les donn�es utilisateur.
	 */
	private $_data;

	/**
	 * @access public
	 */
	public function __construct() {
		// Not yet implemented
	}

	/**
	 * Parse les donn�es t�l�charg�es et met � jour le compte si besoin est
	 * @access public
	 * @param ScoreFinder.Compte aC
	 * @return void
	 * @ParamType aC ScoreFinder.Compte
	 * @ReturnType void
	 */
	public abstract function parseFile(Compte $aC);

	/**
	 * M�thode cr�ant le "token request" (code n�cessaire � la connexion aux API externes)
	 * @access public
	 * @return void
	 * @ReturnType void
	 */
	public abstract function createTokenRequest();

	/**
	 * Met � jour les donn�es du compte (objet en m�moire et base de donn�es) � partir de celles t�l�charg�es.
	 * @access public
	 * @param ScoreFinder.Compte aC
	 * @return void
	 * @ParamType aC ScoreFinder.Compte
	 * @ReturnType void
	 */
	public function updateAccount(Compte $aC) {
		// Not yet implemented
	}

	/**
	 * @access public
	 * @return String
	 * @ReturnType String
	 */
	public function getData() {
		return $this->_data;
	}

	/**
	 * @access public
	 * @param String aData
	 * @return void
	 * @ParamType aData String
	 * @ReturnType void
	 */
	public function setData($aData) {
		$this->_data = $aData;
	}
}
?>