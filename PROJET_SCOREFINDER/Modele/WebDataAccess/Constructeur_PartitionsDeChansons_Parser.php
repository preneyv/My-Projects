<?php
require_once(realpath(dirname(__FILE__)) . '/../WebDataAccess/ConstructeurSiteParser.php');

/**
 * @access public
 * @author Valère Preney - Lucas Poisse
 * @package WebDataAccess
 */
class Constructeur_PartitionsDeChansons_Parser extends ConstructeurSiteParser {

	/**
	 * @access public
	 */
	public function __construct() {
		FabriqueSiteParser::getInstance()->inscrit("Partition de chanson", $this);
	}

	/**
	 * @access public
	 * @param String aNom
	 * @return void
	 * @ParamType aNom String
	 * @ReturnType void
	 */
	public function ConstructParserPDC() {
		return new Partitions_De_Chansons_Parser();
	}
}
?>