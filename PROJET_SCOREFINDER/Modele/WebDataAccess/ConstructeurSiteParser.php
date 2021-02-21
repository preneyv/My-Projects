<?php
require_once(realpath(dirname(__FILE__)) . '/FabriqueSiteParser.php');
require_once(realpath(dirname(__FILE__)) . '/SiteParser.php');

/**
 * @access public
 * @author Valère Preney - Lucas Poisse
 * @package WebDataAccess
 */
interface ConstructeurSiteParser {

	
	/**
	 * Méthode abstraite d'instanciation des parsers
	 */
	 public function Construct();
}
?>