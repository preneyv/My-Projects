<?php
require_once(realpath(dirname(__FILE__)) . '/../WebDataAccess/ConstructeurParser.php');

/**
 * @access public
 * @author Valère Preney - Lucas Poisse
 * @package WebDataAccess
 */
class ConstructeurParserSpotify extends ConstructeurParser {

	/**
	 * Instanciation d'un parser Spotify
	 * @access public
	 * @param String aNom
	 * @return void
	 * @ParamType aNom String
	 * @ReturnType void
	 */
	public function ConstructSpotifyParser() {
		return new SpotifyFileParser();
	}

	/**
	 * Constructeur d'inscription à la fabrique
	 * @access public
	 */
	public function __construct() {
		FabriqueParsers::getInstance()->inscrit("spotify", $this);
	}
}
?>