<?php
require_once(realpath(dirname(__FILE__)) . '/ConstructeurSiteParser.php');
require_once(realpath(dirname(__FILE__)) . '/TheBassment.php');

/**
 * @access public
 * @author Valère Preney - Lucas Poisse
 * @package WebDataAccess
 */
class Constructeur_TheBassment_Parser implements ConstructeurSiteParser {

	/**
	 * @access public
	 */
	public function __construct() {
		FabriqueSiteParser::getInstance()->inscrit("TheBassment", $this);
	}

	/**
	 * @access public
	 * @param String aNom
	 * @return void
	 * @ParamType aNom String
	 * @ReturnType void
	 */
	public function Construct() {
		return new TheBassment();
	}
}
?>