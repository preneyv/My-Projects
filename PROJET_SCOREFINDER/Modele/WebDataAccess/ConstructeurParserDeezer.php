<?php
require_once(realpath(dirname(__FILE__)) . '/../WebDataAccess/ConstructeurParser.php');

/**
 * @access public
 * @author Valère Preney - Lucas Poisse
 * @package WebDataAccess
 */
class ConstructeurParserDeezer extends ConstructeurParser {

	/**
	 * Instanciation d'un parser Deezer
	 * @access public
	 * @param String aNom
	 * @return void
	 * @ParamType aNom String
	 * @ReturnType void
	 */
	public function ConstructDeezerParser() {
		return new DeezerFileParser();
	}

	/**
	 * Constructeur instanciant l'objet à la fabrique
	 * @access public
	 */
	public function __construct() {
		FabriqueParsers::getInstance()->inscrit("deezer", $this);
	}
}
?>