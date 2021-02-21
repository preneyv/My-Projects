<?php
require_once(realpath(dirname(__FILE__)) . '/ConstructeurSiteParser.php');
require_once(realpath(dirname(__FILE__)) . '/SheetDownload.php');

/**
 * @access public
 * @author Valère Preney - Lucas Poisse
 * @package WebDataAccess
 */
class Constructeur_SheetDownload_Parser implements ConstructeurSiteParser {

	/**
	 * @access public
	 */
	public function __construct() {
		FabriqueSiteParser::getInstance()->inscrit("SheetDownload", $this);
	}

	/**
	 * @access public
	 * @param String aNom
	 * @return void
	 * @ParamType aNom String
	 * @ReturnType void
	 */
	public function Construct() {
		return new SheetDownload();
	}
}
?>