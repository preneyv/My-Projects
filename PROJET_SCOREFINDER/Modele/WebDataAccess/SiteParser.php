<?php
require_once("../../dom/simple_html_dom.php");
/**
 * @access public
 * @author Val�re Preney - Lucas Poisse
 * @package WebDataAccess
 */
interface SiteParser {

	/**
	 * @access public
	 */
	public function AnalysePage($infosTrack);
}
?>