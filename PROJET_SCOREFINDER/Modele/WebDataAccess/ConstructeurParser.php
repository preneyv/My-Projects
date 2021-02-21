<?php
require_once(realpath(dirname(__FILE__)) . '/../WebDataAccess/FabriqueParsers.php');
require_once(realpath(dirname(__FILE__)) . '/../WebDataAccess/FileParser.php');

/**
 * @access public
 * @author Valère Preney - Lucas Poisse
 * @package WebDataAccess
 * 
 */
abstract class ConstructeurParser {

	/**
	 * Méthode abstraite d'instanciation des parsers
	 */
	abstract public function Construct();
}
?>