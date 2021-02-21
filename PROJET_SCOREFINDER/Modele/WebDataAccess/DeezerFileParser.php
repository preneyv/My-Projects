<?php
require_once(realpath(dirname(__FILE__)) . '/../ScoreFinder/Compte.php');
require_once(realpath(dirname(__FILE__)) . '/../WebDataAccess/FileParser.php');

/**
 * @access public
 * @author Valère Preney - Lucas Poisse
 * @package WebDataAccess
 */
class DeezerFileParser extends FileParser {
	/**
	 * @AttributeType int
	 */
	private static $_app_id;

	/**
	 * @access public
	 */
	public function __construct() {
		
	}

	/**
	 * @access public
	 * @param ScoreFinder.Compte aC
	 * @return void
	 * @ParamType aC ScoreFinder.Compte
	 * @ReturnType void
	 */
	public function parseFile(Compte $aC) {
		// Not yet implemented
	}

	/**
	 * @access public
	 * @return void
	 * @ReturnType void
	 */
	public function createTokenRequest() {
		// Not yet implemented
	}

	/**
	 * @access public
	 * @return int
	 * @static
	 * @ReturnType int
	 */
	public static function getApp_id() {
		return self::$_app_id;
	}

	/**
	 * @access public
	 * @param int aApp_id
	 * @return void
	 * @static
	 * @ParamType aApp_id int
	 * @ReturnType void
	 */
	public static function setApp_id($aApp_id) {
		self::$_app_id = $aApp_id;
	}
}
?>