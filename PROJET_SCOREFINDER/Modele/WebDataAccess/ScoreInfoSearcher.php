<?php
/**
 * @access public
 * @author Valère Preney - Lucas Poisse
 * @package WebDataAccess
 */
class ScoreInfoSearcher {
	/**
	 * @AttributeType String[]
	 * Regroupe toutes les URL possibles pour la partiton voulu et qui vont être analysées.
	 */
	private $_listeURLPossible;
	/**
	 * @AttributeType String
	 * Correspond à la bonne URL pour la partition souhaitée
	 */
	private $_uRL;

	/**
	 * Fait une recherche sur internet pour trouver les sites qui sont susceptible de transmettre la partition
	 * @access public
	 * @param String aNom
	 * @return void
	 * @ParamType aNom String
	 * @ReturnType void
	 */
	public function searchScore($aNom) {
		// Not yet implemented
	}

	/**
	 * Cette méthode va permettre de traiter tour à tour toutes les URL contenues dans la liste, en appelant la classe pageParser.
	 * @access public
	 * @return void
	 * @ReturnType void
	 */
	public function testURL() {
		// Not yet implemented
	}

	/**
	 * @access public
	 * @return String
	 * @ReturnType String
	 */
	public function getURL() {
		return $this->_uRL;
	}
}
?>