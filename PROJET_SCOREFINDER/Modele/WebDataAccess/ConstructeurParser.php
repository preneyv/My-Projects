<?php
require_once(realpath(dirname(__FILE__)) . '/../WebDataAccess/FabriqueParsers.php');
require_once(realpath(dirname(__FILE__)) . '/../WebDataAccess/FileParser.php');

/**
 * @access public
 * @author Val�re Preney - Lucas Poisse
 * @package WebDataAccess
 * 
 */
abstract class ConstructeurParser {

	/**
	 * M�thode abstraite d'instanciation des parsers
	 */
	abstract public function Construct();
}
?>