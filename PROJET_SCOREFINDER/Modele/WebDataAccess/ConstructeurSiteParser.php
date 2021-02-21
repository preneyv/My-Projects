<?php
require_once(realpath(dirname(__FILE__)) . '/FabriqueSiteParser.php');
require_once(realpath(dirname(__FILE__)) . '/SiteParser.php');

/**
 * @access public
 * @author Val�re Preney - Lucas Poisse
 * @package WebDataAccess
 */
interface ConstructeurSiteParser {

	
	/**
	 * M�thode abstraite d'instanciation des parsers
	 */
	 public function Construct();
}
?>