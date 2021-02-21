<?php
require_once(realpath(dirname(__FILE__)) . '/../ScoreFinder/Compte.php');

/**
 * @access public
 * @author Valère Preney - Lucas Poisse
 * @package WebDataAccess
 */
abstract class FileParser {
	/**
	 * @AttributeType String
	 */
	private $_requestToken;
	/**
	 * @AttributeType String
	 * Correspond aux données téléchargées de l'utilisateur (type encore inconnu pour le moment). Cet attribut sera utilisé par le proxy pour ne pas avoir à re-télécharger en permanence les données utilisateur.
	 */
	private $_data;

	/**
	 * @access public
	 */
	public function __construct() {
		// Not yet implemented
	}

	/**
	 * Parse les données téléchargées et met à jour le compte si besoin est
	 * @access public
	 * @param ScoreFinder.Compte aC
	 * @return void
	 * @ParamType aC ScoreFinder.Compte
	 * @ReturnType void
	 */
	public abstract function parseFile(Compte $aC);

	/**
	 * Méthode créant le "token request" (code nécessaire à la connexion aux API externes)
	 * @access public
	 * @return void
	 * @ReturnType void
	 */
	public abstract function createTokenRequest();

	/**
	 * Met à jour les données du compte (objet en mémoire et base de données) à partir de celles téléchargées.
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