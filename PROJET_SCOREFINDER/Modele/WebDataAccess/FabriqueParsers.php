<?php
require_once(realpath(dirname(__FILE__)) . '/../WebDataAccess/ConstructeurParser.php');
require_once(realpath(dirname(__FILE__)) . '/../WebDataAccess/FileParser.php');

/**
 * @access public
 * @author Valère Preney - Lucas Poisse
 * @package WebDataAccess
 */
class FabriqueParsers {
	/**
	 * @AttributeType WebDataAccess.FabriqueParsers
	 */
	private static $_instance = null;
	/**
	 * @AttributeType String[]
	 */
	private $_dico=array();
	
	/**
	Constructeur privé
	**/
	private function __construct()
    {
    }
	
	
	/**
	 * @access public
	 * @return WebDataAccess.FabriqueParsers
	 * @static
	 * @ReturnType WebDataAccess.FabriqueParsers
	 */
	public static function getInstance() {
		
		if(!isset(FabriqueParsers::$instance))
        {
            FabriqueParsers::$instance = new FabriqueParsers();
        }

        return FabriqueParsers::$instance;
	}

	/**
	 * @access public
	 * @param String aType
	 * @return WebDataAccess.FileParser
	 * @ParamType aType String
	 * @ReturnType WebDataAccess.FileParser
	 */
	public function Construct($aType) {
		
		if(!array_key_exists(aType, $this->_dico)){
			throw new Exception('Type de parser spécifié inconnu !');
		}
		
		return $this->_dico[aType]->Construct();
		
	}

	/**
	 * Fonction renvoyant les types reconnus par la fabrique
	 * @access public
	 * @return String[] le tableau des clés reconnues (types de la fabrique)
	 * @ReturnType String[] 
	 */
	public function Types() {
		return array_keys($this->_dico);
		
	}

	/**
	 * Fonction d'inscription à la fabrique
	 * @access public
	 * @param String aType
	 * @param WebDataAccess.ConstructeurParser aC
	 * @ParamType aType String
	 * @ParamType aC WebDataAccess.ConstructeurParser
	 */
	public function inscrit($aType, ConstructeurParser $aC) {
		$this->_dico[aType] = aC;
	}
}
?>