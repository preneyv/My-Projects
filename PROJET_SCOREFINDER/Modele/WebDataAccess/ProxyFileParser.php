<?php
require_once(realpath(dirname(__FILE__)) . '/../WebDataAccess/FileParser.php');

/**
 * @access public
 * @author Valère Preney - Lucas Poisse
 * @package WebDataAccess
 */
class ProxyFileParser {
	/**
	 * @AssociationType WebDataAccess.FileParser
	 * @AssociationKind Composition
	 */
	private $_fileParser;

	/**
	 * @access public
	 * @param WebDataAccess.FileParser aF
	 * @return void
	 * @ParamType aF WebDataAccess.FileParser
	 * @ReturnType void
	 */
	public function addFileParser(FileParser $aF) {
		// Not yet implemented
	}

	/**
	 * @access public
	 * @param WebDataAccess.FileParser aF
	 * @return void
	 * @ParamType aF WebDataAccess.FileParser
	 * @ReturnType void
	 */
	public function removeFileParser(FileParser $aF) {
		// Not yet implemented
	}
}
?>